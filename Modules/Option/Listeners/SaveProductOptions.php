<?php

namespace Modules\Option\Listeners;

class SaveProductOptions
{
    /**
     * Handle the event.
     *
     * @param \Modules\Product\Entities\Product $product
     * @return void
     */
    public function handle($product)
    {
        $ids = $this->getDeleteCandidates($product);

        if ($ids->isNotEmpty()) {
            $product->options()->detach($ids);
        }

        $this->saveOptions($product);
    }

    private function getDeleteCandidates($product)
    {
        return $product->options()
            ->pluck('id')
            ->diff(array_pluck($this->options(), 'id'));
    }

    private function saveOptions($product)
    {
        foreach (array_reset_index($this->options()) as $index => $attributes) {
            $attributes += ['is_global' => false, 'position' => $index];

            $option = $product->options()->updateOrCreate(['id' => $attributes['id'] ?? null], $attributes);

            $option->saveValues($attributes['values'] ?? []);
        }
    }

    private function options()
    {
        return array_filter(request('options', []), function ($option) {
            return ! is_null($option['name']);
        });
    }
}
