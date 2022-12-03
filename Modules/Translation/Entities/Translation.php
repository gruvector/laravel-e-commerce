<?php

namespace Modules\Translation\Entities;

use Modules\Support\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Modules\Support\Eloquent\Translatable;

class Translation extends Model
{
    use Translatable;

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['translations'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['key'];

    /**
     * The attributes that are translatable.
     *
     * @var array
     */
    protected $translatedAttributes = ['value'];

    /**
     * Retrieve all translations.
     *
     * @return void
     */
    public static function retrieve()
    {
        if (! config('app.cache')) {
            return self::getTranslations();
        }

        return Cache::tags('translations')->rememberForever(md5('translations.all'), function () {
            return self::getTranslations();
        });
    }

    protected static function getTranslations()
    {
        return array_replace_recursive(static::getFileTranslations(), static::getDatabaseTranslations());
    }

    /**
     * Get file translations.
     *
     * @return array
     */
    public static function getFileTranslations()
    {
        $translations = [];

        foreach (resolve('translation.loader')->paths() as $hint => $path) {
            foreach (supported_locales() as $locale => $language) {
                foreach (glob("{$path}/{$locale}/*.php") as $file) {
                    foreach (array_dot(require $file) as $key => $value) {
                        $group = str_replace('.php', '', basename($file));

                        $translations["{$hint}::{$group}.{$key}"][$locale] = $value;
                    }
                }
            }
        }

        return $translations;
    }

    /**
     * Get database translations.
     *
     * @return array
     */
    public static function getDatabaseTranslations()
    {
        $translations = [];

        foreach (static::all() as $translation) {
            foreach ($translation->translations as $translationTranslation) {
                $translations[$translation->key][$translationTranslation->locale] = $translationTranslation->value;
            }
        }

        return $translations;
    }
}
