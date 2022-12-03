<?php

namespace Modules\Tax\Entities;

use Modules\Support\Eloquent\TranslationModel;

class TaxRateTranslation extends TranslationModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];
}
