<?php

namespace Modules\Tag\Entities;

use Modules\Support\Eloquent\TranslationModel;

class TagTranslation extends TranslationModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];
}
