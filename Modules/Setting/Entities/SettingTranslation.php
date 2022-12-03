<?php

namespace Modules\Setting\Entities;

use Modules\Support\Eloquent\TranslationModel;

class SettingTranslation extends TranslationModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['value'];

    /**
     * Get the value of the setting.
     *
     * @param mixed $value
     * @return mixed
     */
    public function getValueAttribute($value)
    {
        return unserialize($value);
    }

    /**
     * Set the value of the setting.
     *
     * @param mixed $value
     * @return mixed
     */
    public function setValueAttribute($value)
    {
        $this->attributes['value'] = serialize($value);
    }
}
