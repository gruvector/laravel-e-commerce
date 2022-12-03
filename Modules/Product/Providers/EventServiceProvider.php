<?php

namespace Modules\Product\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        \Modules\Product\Events\ProductViewed::class => [
            \Modules\Product\Listeners\IncrementProductView::class,
            \Modules\Product\Listeners\AddToRecentlyViewed::class,
        ],
        \Modules\Product\Events\ShowingProductList::class => [
            \Modules\Product\Listeners\StoreSearchTerm::class,
        ],
    ];
}
