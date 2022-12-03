<?php

namespace Modules\Order\Entities;

use Modules\Media\Entities\File;
use Modules\Support\Eloquent\Model;

class OrderDownload extends Model
{
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['file'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['file_id'];

    public function getRealPathAttribute()
    {
        return $this->file->realPath();
    }

    public function getFilenameAttribute()
    {
        return $this->file->file_name;
    }

    public function file()
    {
        return $this->belongsTo(File::class);
    }
}
