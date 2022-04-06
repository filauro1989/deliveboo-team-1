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
        return $this->belongsToMany('App\Model\Order')->withPivot('quantity')->withTimestamps();
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function createSlug($title)
    {
        $slug = Str::slug($title, '-');

        $notTrashed = Dish::where('slug', $slug)->first();
        $trashed = Dish::onlyTrashed()->where('slug', $slug)->first();

        $counter = 0;
        while ($notTrashed || $trashed) {
            $newSlug = $slug . '-' . $counter;
            $notTrashed = Dish::where('slug', $newSlug)->first();
            $trashed = Dish::onlyTrashed()->where('slug', $newSlug)->first();
            $counter++;
        }

        return (empty($newSlug)) ? $slug : $newSlug;

    }
}
