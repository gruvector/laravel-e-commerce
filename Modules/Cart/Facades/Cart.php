<?php

namespace Modules\Cart\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \Modules\Cart\Cart instance()
 * @method static void clear()
 * @method static void store(int $productId, int $qty, array $options = [])
 * @method static void updateQuantity(string $id, int $qty)
 * @method static \Darryldecode\Cart\CartCollection items()
 * @method static int addedQty(int $productId)
 * @method static int findByProductId(int $productId)
 * @method static \Illuminate\Database\Eloquent\Collection crossSellProducts()
 * @method static \Illuminate\Database\Eloquent\Collection getAllProducts()
 * @method static void reduceStock()
 * @method static void restoreStock()
 * @method static int quantity()
 * @method static bool hasAvailableShippingMethod()
 * @method static \Illuminate\Support\Collection availableShippingMethods()
 * @method static bool hasShippingMethod()
 * @method static \Modules\Cart\CartShippingMethod shippingMethod()
 * @method static \Modules\Support\Money shippingCost()
 * @method static \Modules\Support\Money addShippingMethod(\Modules\Shipping\Method $shippingMethod)
 * @method static void removeShippingMethod()
 * @method static bool hasCoupon()
 * @method static bool couponAlreadyApplied()
 * @method static \Modules\Cart\CartCoupon coupon()
 * @method static \Modules\Support\Money discount()
 * @method static void applyCoupon(\Modules\Coupon\Entities\Coupon $coupon)
 * @method static void removeCoupon()
 * @method static void hasTax()
 * @method static \Darryldecode\Cart\CartConditionCollection taxes()
 * @method static \Modules\Support\Money tax()
 * @method static void addTaxes(\Illuminate\Http\Request $request)
 * @method static void removeTaxes()
 * @method static \Modules\Support\Money subTotal()
 * @method static \Modules\Support\Money total()
 * @method static array toArray()
 * @method static array jsonSerialize()
 *
 * @see \Modules\Cart\Cart
 */
class Cart extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return \Modules\Cart\Cart::class;
    }
}
