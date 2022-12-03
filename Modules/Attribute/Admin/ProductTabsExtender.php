<?php

namespace Modules\Attribute\Admin;

use Modules\Admin\Ui\Tab;
use Modules\Admin\Ui\Tabs;
use Modules\Attribute\Entities\Attribute;
use Modules\Attribute\Entities\AttributeSet;

class ProductTabsExtender
{
    public function extend(Tabs $tabs)
    {
        $tabs->group('advanced_information')
            ->add($this->attributes());
    }

    private function attributes()
    {
        if (! auth()->user()->hasAccess(['admin.attributes.index'])) {
            return;
        }

        return tap(new Tab('attributes', trans('attribute::admin.tabs.product.attributes')), function (Tab $tab) {
            $tab->weight(30);
            $tab->fields(['attributes.*.attribute_id', 'attributes.*.values']);
            $tab->view(function ($data) {
                return view('attribute::admin.products.tabs.attributes', [
                    'productAttributes' => $this->getProductAttributes($data['product']),
                    'attributeSets' => $this->getAttributeSets(),
                ]);
            });
        });
    }

    private function getProductAttributes($product)
    {
        $old = old('attributes');

        if (is_null($old)) {
            return $product->load('attributes')->attributes;
        }

        return $this->getOldAttributes($old);
    }

    public function getOldAttributes($old)
    {
        return Attribute::with(['values' => function ($query) use ($old) {
            $query->whereIn('id', array_flatten(array_pluck($old, 'values')));
        }])
        ->whereIn('id', array_pluck($old, 'attribute_id'))
        ->get();
    }

    private function getAttributeSets()
    {
        return AttributeSet::with('attributes.values')->get()->sortBy('name');
    }
}
