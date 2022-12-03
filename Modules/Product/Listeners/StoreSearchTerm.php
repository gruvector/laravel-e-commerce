<?php

namespace Modules\Product\Listeners;

use Modules\Product\Entities\SearchTerm;
use Modules\Product\Events\ShowingProductList;

class StoreSearchTerm
{
    /**
     * Handle the event.
     *
     * @param \Modules\Product\Events\ShowingProductList $event
     * @return void
     */
    public function handle(ShowingProductList $event)
    {
        if (! request()->filled('query')) {
            return;
        }

        SearchTerm::updateOrCreate(
            ['term' => request('query')],
            ['results' => $event->products->count()]
        )->increment('hits');
    }
}
