<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable =[
        'name',
    ];

    public function dishes() {
        return $this->hasMany('App\Model\Dish');
    }
}
