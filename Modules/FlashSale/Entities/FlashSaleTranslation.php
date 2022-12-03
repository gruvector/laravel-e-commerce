<?php

namespace Modules\FlashSale\Entities;

use Modules\Support\Eloquent\TranslationModel;

class FlashSaleTranslation extends TranslationModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['campaign_name'];
}
