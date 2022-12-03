<?php

namespace Modules\Cart\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Modules\Cart\Facades\Cart;
use Modules\Product\Entities\Product;
use Modules\FlashSale\Entities\FlashSale;

class CheckProductIsInStock
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $product = Product::withName()
            ->addSelect('id', 'in_stock', 'manage_stock', 'qty')
            ->where('id', $this->getProductId($request))
            ->firstOrFail();

        if ($product->isOutOfStock()) {
            abort(400, trans('cart::messages.out_of_stock'));
        }

        if (! $this->hasFlashSaleStock($product, $request)) {
            abort(400, trans('cart::messages.not_have_enough_quantity_in_stock', [
                'stock' => FlashSale::remainingQty($product),
            ]));
        }

        if (! $this->hasStock($product, $request)) {
            abort(400, trans('cart::messages.not_have_enough_quantity_in_stock', [
                'stock' => $product->qty,
            ]));
        }

        return $next($request);
    }

    private function getProductId(Request $request)
    {
        if ($request->routeIs('cart.items.store')) {
            return $request->product_id;
        }

        $cartItem = $this->getCartItemForUpdateRequest($request);

        if (! is_null($cartItem)) {
            return $cartItem->product->id;
        }
    }

    private function getCartItemForUpdateRequest(Request $request)
    {
        return Cart::items()->get($request->route()->parameter('cartItemId'));
    }

    private function hasFlashSaleStock(Product $product, Request $request)
    {
        if (! FlashSale::contains($product)) {
            return true;
        }

        $remainingQty = FlashSale::remainingQty($product);
        $addedCartQty = Cart::addedQty($product->id);

        // Exclude current cart item quantity from the total added cart quantity
        // So, that current quantity is not added with the updated quantity.
        $addedCartQty -= $this->currentCartItemQuantity($request);

        return ($remainingQty - $addedCartQty) >= $request->qty;
    }

    private function hasStock(Product $product, Request $request)
    {
        if (! $product->manage_stock) {
            return true;
        }

        $addedCartQty = Cart::addedQty($product->id);

        // Exclude current cart item quantity from the total added cart quantity
        // So, that current quantity is not added with the updated quantity.
        $addedCartQty -= $this->currentCartItemQuantity($request);

        return ($product->qty - $addedCartQty) >= $request->qty;
    }

    private function currentCartItemQuantity(Request $request)
    {
        if ($request->routeIs('cart.items.update')) {
            return $this->getCartItemForUpdateRequest($request)->qty;
        }

        return 0;
    }
}
