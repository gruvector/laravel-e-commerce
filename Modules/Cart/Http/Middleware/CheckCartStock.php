<?php

namespace Modules\Cart\Http\Middleware;

use Closure;
use Exception;
use Modules\Cart\CartItem;
use Illuminate\Http\Request;
use Modules\Cart\Facades\Cart;
use Modules\FlashSale\Entities\FlashSale;

class CheckCartStock
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
        try {
            Cart::items()->each(function (CartItem $cartItem) {
                $cartItem->refreshStock();

                $this->checkQuantity($cartItem);
            });
        } catch (Exception $e) {
            return redirect()->route('cart.index')->with('error', $e->getMessage());
        }

        return $next($request);
    }

    private function checkQuantity(CartItem $cartItem)
    {
        if ($cartItem->product->isOutOfStock()) {
            throw new Exception(trans('cart::messages.one_or_more_product_is_out_of_stock'));
        }

        if (! $this->hasFlashSaleStock($cartItem)) {
            throw new Exception(trans('cart::messages.one_or_more_product_doesn\'t_have_enough_stock'));
        }

        if (! $this->hasStock($cartItem)) {
            throw new Exception(trans('cart::messages.one_or_more_product_doesn\'t_have_enough_stock'));
        }
    }

    private function hasFlashSaleStock(CartItem $cartItem)
    {
        if (! FlashSale::contains($cartItem->product)) {
            return true;
        }

        $remainingQty = FlashSale::remainingQty($cartItem->product);
        $addedCartQty = Cart::addedQty($cartItem->product->id);

        return ($remainingQty - $addedCartQty) >= 0;
    }

    private function hasStock(CartItem $cartItem)
    {
        if (! $cartItem->product->manage_stock) {
            return true;
        }

        $addedCartQty = Cart::addedQty($cartItem->product->id);

        return ($cartItem->product->qty - $addedCartQty) >= 0;
    }
}
