<?php

namespace Modules\Checkout\Listeners;

class AddPlacedOrderToSession
{
    /**
     * Handle the event.
     *
     * @param \Modules\Checkout\Events\OrderPlaced $event
     * @return void
     */
    public function handle($event)
    {
        session()->flash('placed_order', $event->order);
    }
}
