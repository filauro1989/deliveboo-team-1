<?php

namespace App\Model;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Dish extends Model
{
    use SoftDeletes;
    
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
        return $this->belongsToMany('App\Model\Order')->withTimestamps();
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function createSlug($title)
    {
        $slug = Str::slug($title, '-');

        $oldDish = Dish::where('slug', $slug)->first();

        $counter = 0;
        while ($oldDish) {
            $newSlug = $slug . '-' . $counter;
            $oldDish = Dish::where('slug', $newSlug)->first();
            $counter++;
        }

        return (empty($newSlug)) ? $slug : $newSlug;
    }
}
