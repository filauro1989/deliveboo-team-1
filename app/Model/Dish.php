<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
    protected $fillable = [
        'user_id',
        'course_id',
        'name',
        'description',
        'price',
        'image',
        'visible',
    ];

    public function user() {
        return $this->belongsTo('App\User');
    }
    public function course() {
        return $this->belongsTo('App\Model\Course');
    }
    public function orders() {
        return $this->belongsToMany('App\Model\Order')->withTimestamps()();
    }
}
