<?php

namespace Modules\Option\Entities;

use Modules\Support\Eloquent\Model;
use Modules\Option\Admin\OptionTable;
use Modules\Support\Eloquent\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Option extends Model
{
    use Translatable, SoftDeletes;

    /**
     * Available option types.
     *
     * @var array
     */
    const TYPES = [
        'field', 'textarea', 'dropdown', 'checkbox', 'checkbox_custom',
        'radio', 'radio_custom', 'multiple_select', 'date', 'date_time', 'time',
    ];

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['translations', 'values'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['option', 'type', 'is_required', 'is_global', 'position'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_required' => 'boolean',
        'is_global' => 'boolean',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * The attributes that are translatable.
     *
     * @var array
     */
    protected $translatedAttributes = ['name'];

    /**
     * Perform any actions required after the model boots.
     *
     * @return void
     */
    protected static function booted()
    {
        static::saved(function ($option) {
            if (request()->routeIs('admin.options.*')) {
                $option->saveValues(request('values', []));
            }
        });
    }

    public function isFieldType()
    {
        return in_array($this->type, ['field', 'textarea', 'dropdown', 'radio', 'date', 'date_time', 'time']);
    }

    /**
     * Get the values for the option.
     *
     * @return mixed
     */
    public function values()
    {
        return $this->hasMany(OptionValue::class)->orderBy('position');
    }

    /**
     * Scope a query to only include global options.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeGlobals($query)
    {
        return $query->where('is_global', true);
    }

    /**
     * Get table data for the resource
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function table()
    {
        return new OptionTable($this->newQuery()->globals());
    }

    /**
     * Save values for the option.
     *
     * @param array $values
     * @return void
     */
    public function saveValues($values = [])
    {
        $ids = $this->getDeleteCandidates($values);

        if ($ids->isNotEmpty()) {
            $this->values()->whereIn('id', $ids)->delete();
        }

        foreach (array_reset_index($values) as $index => $attributes) {
            $attributes += ['position' => $index];

            $this->values()->updateOrCreate([
                'id' => array_get($attributes, 'id'),
            ], $attributes);
        }
    }

    private function getDeleteCandidates($values)
    {
        return $this->values()
            ->pluck('id')
            ->diff(array_pluck($values, 'id'));
    }
}
