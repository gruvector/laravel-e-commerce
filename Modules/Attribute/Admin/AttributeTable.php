<?php

namespace Modules\Attribute\Admin;

use Modules\Admin\Ui\AdminTable;

class AttributeTable extends AdminTable
{
    /**
     * Make table response for the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function make()
    {
        return $this->newTable()
            ->addColumn('attribute_set', function ($attribute) {
                return $attribute->attributeSet->name;
            })
            ->addColumn('is_filterable', function ($attribute) {
                return $attribute->is_filterable
                    ? trans('attribute::admin.table.yes')
                    : trans('attribute::admin.table.no');
            });
    }
}
