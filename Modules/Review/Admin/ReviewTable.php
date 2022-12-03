<?php

namespace Modules\Review\Admin;

use Modules\Admin\Ui\AdminTable;

class ReviewTable extends AdminTable
{
    /**
     * Make table response for the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function make()
    {
        return $this->newTable()
            ->editColumn('product', function ($review) {
                return $review->product->name;
            })
            ->editColumn('status', function ($review) {
                return $review->is_approved
                    ? '<span class="dot green"></span>'
                    : '<span class="dot red"></span>';
            });
    }
}
