<?php

namespace Modules\Meta\Entities;

use Modules\Support\Eloquent\TranslationModel;

class MetaDataTranslation extends TranslationModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['meta_title', 'meta_description'];
}
