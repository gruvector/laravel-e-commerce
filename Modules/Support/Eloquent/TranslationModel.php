<?php

namespace Modules\Support\Eloquent;

use Illuminate\Database\Eloquent\Model;

abstract class TranslationModel extends Model
{
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Perform any actions required before the model boots.
     *
     * @return void
     */
    public static function booting()
    {
        static::addGlobalScope('locale', function ($query) {
            $query->whereIn('locale', [locale(), config('app.fallback_locale')]);
        });
    }
}
