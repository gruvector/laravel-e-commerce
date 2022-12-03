<?php

namespace Modules\Menu\Entities;

use Modules\Support\Eloquent\TranslationModel;

class MenuTranslation extends TranslationModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];
}
