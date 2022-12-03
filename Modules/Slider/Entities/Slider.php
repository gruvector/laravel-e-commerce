<?php

namespace Modules\Slider\Entities;

use Modules\Admin\Ui\AdminTable;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Modules\Support\Eloquent\Translatable;

class Slider extends Model
{
    use Translatable;

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['translations', 'slides'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['speed', 'autoplay', 'autoplay_speed', 'fade', 'dots', 'arrows'];

    /**
     * The attributes that are translatable.
     *
     * @var array
     */
    public $translatedAttributes = ['name'];

    /**
     * Perform any actions required after the model boots.
     *
     * @return void
     */
    protected static function booted()
    {
        static::saved(function ($slider) {
            $slider->saveSlides(request('slides', []));
            $slider->clearCache();
        });
    }

    public function shouldAutoPlay()
    {
        return $this->autoplay ? 'true' : 'false';
    }

    public function clearCache()
    {
        Cache::tags("sliders.{$this->id}")->flush();
    }

    public static function findWithSlides($id)
    {
        if (is_null($id)) {
            return;
        }

        return Cache::tags("sliders.{$id}")
            ->rememberForever(md5("sliders.{$id}:" . locale()), function () use ($id) {
                return static::with('slides')->find($id);
            });
    }

    public function slides()
    {
        return $this->hasMany(SliderSlide::class)->orderBy('position');
    }

    public function getAutoplaySpeedAttribute($autoplaySpeed)
    {
        return $autoplaySpeed ?: 3000;
    }

    public function table()
    {
        return new AdminTable($this->newQuery());
    }

    /**
     * Save slides for the slider.
     *
     * @param array $slides
     * @return void
     */
    public function saveSlides($slides)
    {
        $ids = $this->getDeleteCandidates($slides);

        if ($ids->isNotEmpty()) {
            $this->slides()->whereIn('id', $ids)->delete();
        }

        foreach (array_reset_index($slides) as $index => $slide) {
            $this->slides()->updateOrCreate(
                ['id' => $slide['id']],
                $slide + ['position' => $index]
            );
        }
    }

    private function getDeleteCandidates($slides = [])
    {
        return $this->slides()
            ->pluck('id')
            ->diff(array_pluck($slides, 'id'));
    }
}
