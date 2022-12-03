<?php

namespace Modules\Support\Eloquent;

use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model as Eloquent;

abstract class Model extends Eloquent
{
    /**
     * Perform any actions required before the model boots.
     *
     * @return void
     */
    protected static function booting()
    {
        static::saved(function ($entity) {
            $entity->clearEntityTaggedCache();
        });

        static::deleted(function ($entity) {
            $entity->clearEntityTaggedCache();
        });
    }

    public static function queryWithoutEagerRelations()
    {
        return (new static)->newQueryWithoutEagerRelations();
    }

    public function newQueryWithoutEagerRelations()
    {
        return $this->registerGlobalScopes(
            $this->newModelQuery()->withCount($this->withCount)
        );
    }

    public function clearEntityTaggedCache()
    {
        Cache::tags($this->getTable())->flush();
    }

    /**
     * Register a new active global scope on the model.
     *
     * @return void
     */
    public static function addActiveGlobalScope()
    {
        static::addGlobalScope('active', function ($query) {
            $query->where('is_active', true);
        });
    }
}
