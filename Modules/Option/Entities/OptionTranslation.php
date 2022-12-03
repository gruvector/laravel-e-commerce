<?php

namespace Modules\Option\Entities;

use Modules\Support\Eloquent\TranslationModel;

class OptionTranslation extends TranslationModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];
}
