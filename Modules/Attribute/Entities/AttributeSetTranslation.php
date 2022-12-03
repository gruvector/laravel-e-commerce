<?php

namespace Modules\Attribute\Entities;

use Modules\Support\Eloquent\TranslationModel;

class AttributeSetTranslation extends TranslationModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];
}
