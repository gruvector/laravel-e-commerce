<?php

namespace Modules\Support\Providers;

use Illuminate\Database\Query\Builder;
use Illuminate\Support\ServiceProvider;

class EloquentMacroServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Builder::macro('resetOrders', function () {
            $this->{$this->unions ? 'unionOrders' : 'orders'} = null;

            return $this;
        });
    }
}
