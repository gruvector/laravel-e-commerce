<?php

namespace Modules\Product\Services;

use Modules\Option\Entities\Option;
use Modules\Product\Entities\Product;

class ChosenProductOptions
{
    private $product;
    private $chosenOptions;

    public function __construct(Product $product, array $chosenOptions = [])
    {
        $this->product = $product;
        $this->chosenOptions = array_filter($chosenOptions);
    }

    public function getEntities()
    {
        $productOptions = $this->product->options()
            ->with(['values' => function ($query) {
                $query->whereIn('id', array_flatten($this->chosenOptions));
            }])
            ->whereIn('id', array_keys($this->chosenOptions))
            ->get()
            ->filter(function ($productOption) {
                return $productOption->values->isNotEmpty();
            });

        return $this->mergeTextTypeOptions($productOptions);
    }

    private function mergeTextTypeOptions($productOptions)
    {
        $filteredOptions = collect($this->chosenOptions)->reject(function ($_, $optionId) use ($productOptions) {
            return $productOptions->contains('id', $optionId);
        });

        $textTypeOptions = Option::with('values')
            ->whereIn('id', $filteredOptions->keys())
            ->get();

        return $filteredOptions->map(function ($value, $optionId) use ($textTypeOptions) {
            return optional($textTypeOptions->where('id', $optionId)->first(), function ($option) use ($value) {
                $option->values->first()->fill(['label' => $value]);

                return $option;
            });
        })->merge($productOptions);
    }
}
