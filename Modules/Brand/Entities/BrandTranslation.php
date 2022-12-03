<?php

namespace Modules\Brand\Entities;

use Modules\Support\Eloquent\TranslationModel;

class BrandTranslation extends TranslationModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];
}
