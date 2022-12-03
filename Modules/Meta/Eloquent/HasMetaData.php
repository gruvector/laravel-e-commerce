<?php

namespace Modules\Meta\Eloquent;

use Modules\Meta\Entities\MetaData;

trait HasMetaData
{
    /**
     * The "booting" method of the trait.
     *
     * @return void
     */
    public static function bootHasMetaData()
    {
        static::saved(function ($entity) {
            $entity->saveMetaData(request('meta', []));
        });
    }

    /**
     * Get the meta for the entity.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function meta()
    {
        return $this->morphOne(MetaData::class, 'entity')->withDefault();
    }

    /**
     * Save meta data for the entity.
     *
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function saveMetaData($data = [])
    {
        $this->meta->fill([locale() => $data])->save();
    }
}
