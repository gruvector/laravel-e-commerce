<?php

namespace Modules\Attribute\Entities;

use Modules\Support\Eloquent\Model;

class ProductAttributeValue extends Model
{
    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['attributeValue'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['product_attribute_id', 'attribute_id'];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['value'];

    public function exists()
    {
        return ! is_null($this->attributeValue);
    }

    public function attributeValue()
    {
        return $this->belongsTo(AttributeValue::class, 'attribute_value_id');
    }

    public function getIdAttribute()
    {
        return $this->attributeValue->id;
    }

    public function getValueAttribute()
    {
        return $this->attributeValue->value;
    }
}
