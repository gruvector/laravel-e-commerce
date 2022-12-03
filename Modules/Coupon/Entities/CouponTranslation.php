<?php

namespace Modules\Coupon\Entities;

use Modules\Support\Eloquent\TranslationModel;

class CouponTranslation extends TranslationModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];
}
