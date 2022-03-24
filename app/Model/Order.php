<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'date',
        'customer_email',
        'delivery_address',
        'payment_method',
        'total_amount',
    ];

    public function dishes() {
        return $this->belongsToMany('App\Model\Dish')->withTimestamps();
    }
}
