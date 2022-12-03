<?php

namespace Modules\Option\Entities;

use Modules\Support\Eloquent\TranslationModel;

class OptionValueTranslation extends TranslationModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['label'];
}
