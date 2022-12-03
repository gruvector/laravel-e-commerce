<?php

namespace Modules\Attribute\Entities;

use Modules\Support\Eloquent\TranslationModel;

class AttributeValueTranslation extends TranslationModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['value'];
}
