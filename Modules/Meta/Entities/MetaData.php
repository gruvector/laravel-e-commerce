<?php

namespace Modules\Meta\Entities;

use Modules\Support\Eloquent\Model;
use Modules\Support\Eloquent\Translatable;

class MetaData extends Model
{
    use Translatable;

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['translations'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['entity_id', 'entity_type'];

    /**
     * The attributes that are translatable.
     *
     * @var array
     */
    protected $translatedAttributes = ['meta_title', 'meta_description'];

    public function getMetaKeywordsAttribute($keywords)
    {
        return is_array($keywords) ? $keywords : [];
    }
}
