<?php

namespace Modules\User\Entities;

use Modules\Support\Eloquent\TranslationModel;

class RoleTranslation extends TranslationModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];
}
