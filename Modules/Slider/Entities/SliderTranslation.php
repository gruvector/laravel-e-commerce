<?php

namespace Modules\Slider\Entities;

use Modules\Support\Eloquent\TranslationModel;

class SliderTranslation extends TranslationModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];
}
