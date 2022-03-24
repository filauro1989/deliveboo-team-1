<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'restaurant_name',
        'email', 
        'password',
        'address',
        'phone',
        'vat',
        'image',
        'description',
        'opening_time',
        'closing_time',
        'open',
        'slug',
    ];

    public function categories() {
        return $this->belongsToMany('App\Model\Category')->withTimestamps();
    }

    public function dishes() {
        return $this->hasMany('App\Model\Dish');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
    
    // public function createSlug($title)
    // {
    //     $slug = Str::slug($title, '-');

    //     $oldPost = Post::where('slug', $slug)->first();

    //     $counter = 0;
    //     while ($oldPost) {
    //         $newSlug = $slug . '-' . $counter;
    //         $oldPost = Post::where('slug', $newSlug)->first();
    //         $counter++;
    //     }

    //     return (empty($newSlug)) ? $slug : $newSlug;
    // }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
