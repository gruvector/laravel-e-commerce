<?php

namespace Modules\Product\Admin;

use Modules\Admin\Ui\Tab;
use Modules\Admin\Ui\Tabs;
use Modules\Tag\Entities\Tag;
use Modules\Brand\Entities\Brand;
use Modules\Tax\Entities\TaxClass;
use Modules\Category\Entities\Category;

class ProductTabs extends Tabs
{
    public function make()
    {
        $this->group('basic_information', trans('product::products.tabs.group.basic_information'))
            ->active()
            ->add($this->general())
            ->add($this->price())
            ->add($this->inventory())
            ->add($this->images())
            ->add($this->downloads())
            ->add($this->seo());

        $this->group('advanced_information', trans('product::products.tabs.group.advanced_information'))
            ->add($this->relatedProducts())
            ->add($this->upSells())
            ->add($this->crossSells())
            ->add($this->additional());
    }

    private function general()
    {
        return tap(new Tab('general', trans('product::products.tabs.general')), function (Tab $tab) {
            $tab->active();
            $tab->weight(5);
            $tab->fields(['name', 'description', 'brand_id', 'tax_class_id', 'is_active']);
            $tab->view('product::admin.products.tabs.general', [
                'brands' => $this->brands(),
                'categories' => Category::treeList(),
                'taxClasses' => $this->taxClasses(),
                'tags' => Tag::list(),
            ]);
        });
    }

    private function brands()
    {
        return Brand::list()->prepend(trans('admin::admin.form.please_select'), '');
    }

    private function taxClasses()
    {
        return TaxClass::list()->prepend(trans('admin::admin.form.please_select'), '');
    }

    private function price()
    {
        return tap(new Tab('price', trans('product::products.tabs.price')), function (Tab $tab) {
            $tab->weight(10);

            $tab->fields([
                'price',
                'special_price',
                'special_price_type',
                'special_price_start',
                'special_price_end',
            ]);

            $tab->view('product::admin.products.tabs.price');
        });
    }

    private function inventory()
    {
        return tap(new Tab('inventory', trans('product::products.tabs.inventory')), function (Tab $tab) {
            $tab->weight(15);
            $tab->fields(['manage_stock', 'qty', 'in_stock']);
            $tab->view('product::admin.products.tabs.inventory');
        });
    }

    private function images()
    {
        if (! auth()->user()->hasAccess('admin.media.index')) {
            return;
        }

        return tap(new Tab('images', trans('product::products.tabs.images')), function (Tab $tab) {
            $tab->weight(20);
            $tab->view('product::admin.products.tabs.images');
        });
    }

    private function downloads()
    {
        return tap(new Tab('downloads', trans('product::products.tabs.downloads')), function (Tab $tab) {
            $tab->weight(22);
            $tab->view('product::admin.products.tabs.downloads');
        });
    }

    private function seo()
    {
        return tap(new Tab('seo', trans('product::products.tabs.seo')), function (Tab $tab) {
            $tab->weight(25);
            $tab->fields(['slug']);
            $tab->view('product::admin.products.tabs.seo');
        });
    }

    private function relatedProducts()
    {
        return tap(new Tab('related_products', trans('product::products.tabs.related_products')), function (Tab $tab) {
            $tab->weight(40);
            $tab->view('product::admin.products.tabs.products', ['name' => 'related_products']);
        });
    }

    private function upSells()
    {
        return tap(new Tab('up_sells', trans('product::products.tabs.up_sells')), function (Tab $tab) {
            $tab->weight(45);
            $tab->view('product::admin.products.tabs.products', ['name' => 'up_sells']);
        });
    }

    private function crossSells()
    {
        return tap(new Tab('cross_sells', trans('product::products.tabs.cross_sells')), function (Tab $tab) {
            $tab->weight(45);
            $tab->view('product::admin.products.tabs.products', ['name' => 'cross_sells']);
        });
    }

    private function additional()
    {
        return tap(new Tab('additional', trans('product::products.tabs.additional')), function (Tab $tab) {
            $tab->weight(55);
            $tab->fields(['new_from', 'new_to']);
            $tab->view('product::admin.products.tabs.additional');
        });
    }
}
