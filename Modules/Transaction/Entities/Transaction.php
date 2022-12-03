<?php

namespace Modules\Transaction\Entities;

use Modules\Order\Entities\Order;
use Modules\Support\Eloquent\Model;
use Modules\Payment\Facades\Gateway;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Transaction\Admin\TransactionTable;

class Transaction extends Model
{
    use SoftDeletes;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'data' => 'array',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function getPaymentMethodAttribute($paymentMethod)
    {
        return Gateway::get($paymentMethod)->label ?? '';
    }

    public function table()
    {
        return new TransactionTable($this->newQuery());
    }
}
