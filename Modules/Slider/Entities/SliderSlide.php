<?php

namespace Modules\Slider\Entities;

use Modules\Media\Entities\File;
use Modules\Support\Eloquent\Model;
use Modules\Support\Eloquent\Translatable;

class SliderSlide extends Model
{
    use Translatable;

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['translations', 'file'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['options', 'call_to_action_url', 'open_in_new_window', 'position'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'options' => 'array',
        'open_in_new_window' => 'boolean',
    ];

    /**
     * The attributes that are translatable.
     *
     * @var array
     */
    public $translatedAttributes = [
        'file_id',
        'caption_1',
        'caption_2',
        'direction',
        'call_to_action_text',
    ];

    public function isAlignedLeft()
    {
        return $this->direction === 'left';
    }

    public function isAlignedRight()
    {
        return $this->direction === 'right';
    }

    public function file()
    {
        return $this->belongsTo(File::class)->withDefault();
    }
}
