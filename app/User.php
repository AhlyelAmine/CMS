<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','is_admin',
    ];

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

    
    public function posts() {
        return $this->hasMany(Post::class);
    }
    public function comments() {
        return $this->hasMany(Comment::class);
    }
    public function image() {
        return $this->morphOne('App\Image', 'imageable');
    }
    public function scopeMostCommented(Builder $query) 
    {
        return $query->withCount('comments')->orderBy('comments_count', 'desc');
    } 
    public function favorite()
    {
        return $this->hasMany(Favorite::class);
    }
}
