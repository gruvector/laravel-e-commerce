<?php

namespace Modules\Product\Listeners;

use Exception;
use Modules\Product\RecentlyViewed;
use Modules\Product\Events\ProductViewed;

class AddToRecentlyViewed
{
    /**
     * The recently viewed instance.
     *
     * @var \Modules\Product\RecentlyViewed
     */
    private $recentlyViewed;

    /**
     * Create a new event listener.
     *
     * @param \Modules\Product\RecentlyViewed $recentlyViewed
     */
    public function __construct(RecentlyViewed $recentlyViewed)
    {
        $this->recentlyViewed = $recentlyViewed;
    }

    /**
     * Handle the event.
     *
     * @param \Modules\Product\Events\ProductViewed $event
     * @return void
     */
    public function handle(ProductViewed $event)
    {
        try {
            $this->recentlyViewed->store($event->product);
        } catch (Exception $e) {
            //
        }
    }
}
