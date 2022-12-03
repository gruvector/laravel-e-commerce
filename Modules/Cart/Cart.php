<?php

namespace Modules\Cart;

use JsonSerializable;
use Modules\Support\Money;
use Modules\Tax\Entities\TaxRate;
use Illuminate\Support\Collection;
use Modules\Coupon\Entities\Coupon;
use Modules\Product\Entities\Product;
use Modules\Shipping\Facades\ShippingMethod;
use Darryldecode\Cart\Cart as DarryldecodeCart;
use Modules\Product\Services\ChosenProductOptions;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;

class Cart extends DarryldecodeCart implements JsonSerializable
{
    /**
     * Get the current instance.
     *
     * @return $this
     */
    public function instance()
    {
        return $this;
    }

    /**
     * Clear the cart.
     *
     * @return void
     */
    public function clear()
    {
        parent::clear();

        $this->clearCartConditions();
    }

    /**
     * Store a new item to the cart.
     *
     * @param int $productId
     * @param int $qty
     * @param array $options
     * @return void
     */
    public function store($productId, $qty, $options = [])
    {
        $options = array_filter($options);
        $product = Product::with('files', 'categories', 'taxClass')->findOrFail($productId);
        $chosenOptions = new ChosenProductOptions($product, $options);

        $this->add([
            'id' => md5("product_id.{$product->id}:options." . serialize($options)),
            'name' => $product->name,
            'price' => $product->selling_price->amount(),
            'quantity' => $qty,
            'attributes' => [
                'product' => $product,
                'options' => $chosenOptions->getEntities(),
                'created_at' => time(),
            ],
        ]);
    }

    public function updateQuantity($id, $qty)
    {
        $this->update($id, [
            'quantity' => [
                'relative' => false,
                'value' => $qty,
            ],
        ]);
    }

    public function items()
    {
        return $this->getContent()->sortBy('attributes.created_at')->map(function ($item) {
            return new CartItem($item);
        });
    }

    public function addedQty($productId)
    {
        return $this->findByProductId($productId)->sum('qty');
    }

    public function findByProductId($productId)
    {
        return $this->items()->filter(function ($cartItem) use ($productId) {
            return $cartItem->product->id == $productId;
        });
    }

    public function crossSellProducts()
    {
        return $this->getAllProducts()->load(['crossSellProducts' => function ($query) {
            $query->forCard();
        }])->pluck('crossSellProducts')->flatten();
    }

    public function getAllProducts()
    {
        return $this->items()->map(function ($cartItem) {
            return $cartItem->product;
        })->flatten()->pipe(function ($products) {
            return new EloquentCollection($products);
        });
    }

    public function reduceStock()
    {
        $this->manageStock(function ($cartItem) {
            $cartItem->product->decrement('qty', $cartItem->qty);

            if ($cartItem->refreshStock()->product->qty === 0) {
                $cartItem->product->outOfStock();
            }
        });
    }

    public function restoreStock()
    {
        $this->manageStock(function ($cartItem) {
            $cartItem->product->increment('qty', $cartItem->qty);
        });
    }

    private function manageStock($callback)
    {
        $this->items()->filter(function ($cartItem) {
            return $cartItem->product->manage_stock;
        })->each($callback);
    }

    public function quantity()
    {
        return $this->getTotalQuantity();
    }

    public function hasAvailableShippingMethod()
    {
        return $this->availableShippingMethods()->isNotEmpty();
    }

    public function availableShippingMethods()
    {
        if ($this->allItemsAreVirtual()) {
            return collect();
        }

        return ShippingMethod::available();
    }

    public function allItemsAreVirtual()
    {
        return $this->items()->every(function (CartItem $cartItem) {
            return $cartItem->product->virtual;
        });
    }

    public function hasShippingMethod()
    {
        return $this->getConditionsByType('shipping_method')->isNotEmpty();
    }

    public function shippingMethod()
    {
        if (! $this->hasShippingMethod()) {
            return new NullCartShippingMethod;
        }

        return new CartShippingMethod($this, $this->getConditionsByType('shipping_method')->first());
    }

    public function shippingCost()
    {
        return $this->shippingMethod()->cost();
    }

    public function addShippingMethod($shippingMethod)
    {
        $this->removeShippingMethod();

        $this->condition(new CartCondition([
            'name' => $shippingMethod->label,
            'type' => 'shipping_method',
            'target' => 'total',
            'value' => "+{$shippingMethod->cost->amount()}",
            'order' => 1,
            'attributes' => [
                'shipping_method' => $shippingMethod,
            ],
        ]));

        $this->refreshFreeShippingCoupon();

        return $this->shippingMethod();
    }

    public function removeShippingMethod()
    {
        $this->removeConditionsByType('shipping_method');
    }

    private function refreshFreeShippingCoupon()
    {
        if ($this->coupon()->isFreeShipping()) {
            $this->applyCoupon($this->coupon()->entity());
        }
    }

    public function hasCoupon()
    {
        if ($this->getConditionsByType('coupon')->isEmpty()) {
            return false;
        }

        $couponId = $this->getConditionsByType('coupon')->first()->getAttribute('coupon_id');

        return Coupon::where('id', $couponId)->exists();
    }

    public function couponAlreadyApplied(Coupon $coupon)
    {
        return $this->coupon()->code() === $coupon->code;
    }

    public function coupon()
    {
        if (! $this->hasCoupon()) {
            return new NullCartCoupon;
        }

        $couponCondition = $this->getConditionsByType('coupon')->first();
        $coupon = Coupon::with('products', 'categories')->find($couponCondition->getAttribute('coupon_id'));

        return new CartCoupon($this, $coupon, $couponCondition);
    }

    public function discount()
    {
        return $this->coupon()->value();
    }

    public function applyCoupon(Coupon $coupon)
    {
        $this->removeCoupon();

        $this->condition(new CartCondition([
            'name' => $coupon->code,
            'type' => 'coupon',
            'target' => 'total',
            'value' => $this->getCouponValue($coupon),
            'order' => 2,
            'attributes' => [
                'coupon_id' => $coupon->id,
            ],
        ]));
    }

    private function getCouponValue($coupon)
    {
        if ($coupon->free_shipping) {
            return "-{$this->shippingMethod()->cost()->amount()}";
        }

        if ($coupon->is_percent) {
            return "-{$coupon->value}%";
        }

        return "-{$coupon->value->amount()}";
    }

    public function removeCoupon()
    {
        $this->removeConditionsByType('coupon');
    }

    public function hasTax()
    {
        return $this->getConditionsByType('tax')->isNotEmpty();
    }

    public function taxes()
    {
        if (! $this->hasTax()) {
            return new Collection;
        }

        $taxConditions = $this->getConditionsByType('tax');
        $taxRates = TaxRate::whereIn('id', $this->getTaxRateIds($taxConditions))->get();

        return $taxConditions->map(function ($taxCondition) use ($taxRates) {
            $taxRate = $taxRates->where('id', $taxCondition->getAttribute('tax_rate_id'))->first();

            return new CartTax($this, $taxRate, $taxCondition);
        });
    }

    private function getTaxRateIds($taxConditions)
    {
        return $taxConditions->map(function ($taxCondition) {
            return $taxCondition->getAttribute('tax_rate_id');
        });
    }

    public function tax()
    {
        return Money::inDefaultCurrency($this->calculateTax());
    }

    private function calculateTax()
    {
        return $this->taxes()->sum(function ($cartTax) {
            return $cartTax->amount()->amount();
        });
    }

    public function addTaxes($request)
    {
        $this->removeTaxes();

        $this->findTaxes($request)->each(function ($taxRate) {
            $this->condition(new CartCondition([
                'name' => $taxRate->id,
                'type' => 'tax',
                'target' => 'total',
                'value' => "+{$taxRate->rate}%",
                'order' => 3,
                'attributes' => [
                    'tax_rate_id' => $taxRate->id,
                ],
            ]));
        });
    }

    public function removeTaxes()
    {
        $this->removeConditionsByType('tax');
    }

    private function findTaxes($request)
    {
        return $this->items()
            ->groupBy('tax_class_id')
            ->flatten()
            ->map(function (CartItem $cartItem) use ($request) {
                return $cartItem->findTax($request->only(['billing', 'shipping']));
            })
            ->filter();
    }

    public function subTotal()
    {
        return Money::inDefaultCurrency($this->getSubTotal())
            ->add($this->optionsPrice());
    }

    private function optionsPrice()
    {
        return Money::inDefaultCurrency($this->calculateOptionsPrice());
    }

    private function calculateOptionsPrice()
    {
        return $this->items()->sum(function ($cartItem) {
            return $cartItem->optionsPrice()->multiply($cartItem->qty)->amount();
        });
    }

    public function total()
    {
        return $this->subTotal()
            ->add($this->shippingMethod()->cost())
            ->subtract($this->coupon()->value())
            ->add($this->tax());
    }

    public function toArray()
    {
        return [
            'items' => $this->items(),
            'quantity' => $this->quantity(),
            'availableShippingMethods' => $this->availableShippingMethods(),
            'subTotal' => $this->subTotal(),
            'shippingCost' => $this->shippingMethod(),
            'coupon' => $this->coupon(),
            'taxes' => $this->taxes(),
            'total' => $this->total(),
        ];
    }

    public function jsonSerialize()
    {
        return $this->toArray();
    }

    public function __toString()
    {
        return json_encode($this->jsonSerialize());
    }
}
