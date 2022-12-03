<?php

namespace Modules\Page\Entities;

use Modules\Support\Eloquent\TranslationModel;

class PageTranslation extends TranslationModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'body'];
}
