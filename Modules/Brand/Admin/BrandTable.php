<?php

namespace Modules\Brand\Admin;

use Modules\Admin\Ui\AdminTable;
use Modules\Brand\Entities\Brand;

class BrandTable extends AdminTable
{
    /**
     * Make table response for the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function make()
    {
        return $this->newTable()
            ->addColumn('logo', function (Brand $brand) {
                return view('admin::partials.table.image', [
                    'file' => $brand->logo,
                ]);
            });
    }
}
