<?php

namespace Modules\Cart;

use JsonSerializable;
use Modules\Support\Money;
use Modules\Product\Entities\Product;

class CartItem implements JsonSerializable
{
    public $id;
    public $qty;
    public $product;
    public $options;

    public function __construct($item)
    {
        $this->id = $item->id;
        $this->qty = $item->quantity;
        $this->product = $item->attributes['product'];
        $this->options = $item->attributes['options'];
    }

    public function unitPrice()
    {
        return $this->product->selling_price->add($this->optionsPrice());
    }

    public function total()
    {
        return $this->unitPrice()->multiply($this->qty);
    }

    public function optionsPrice()
    {
        return Money::inDefaultCurrency($this->calculateOptionsPrice());
    }

    public function calculateOptionsPrice()
    {
        return $this->options->sum(function ($option) {
            return $this->valuesSum($option->values);
        });
    }

    private function valuesSum($values)
    {
        return $values->sum(function ($value) {
            if ($value->price_type === 'fixed') {
                return $value->price->amount();
            }

            return ($value->price / 100) * $this->product->selling_price->amount();
        });
    }

    public function refreshStock()
    {
        $product = Product::select(['manage_stock', 'in_stock', 'qty'])->find($this->product->id);

        $this->product->fill([
            'manage_stock' => $product->manage_stock,
            'in_stock' => $product->in_stock,
            'qty' => $product->qty,
        ]);

        return $this;
    }

    public function findTax(array $addresses)
    {
        return $this->product->taxClass->findTaxRate($addresses);
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'qty' => $this->qty,
            'product' => $this->product->clean(),
            'options' => $this->options->keyBy('position'),
            'unitPrice' => $this->unitPrice(),
            'total' => $this->total(),
        ];
    }

    public function __toString()
    {
        return json_encode($this->jsonSerialize());
    }
}
