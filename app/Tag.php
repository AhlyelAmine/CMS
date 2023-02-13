<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    public function parent()
    {
        return $this->morphedByMany('App\Tag', 'taggable')->withTimestamps();
    }

    public function children()
    {
        return $this->morphToMany('App\Tag', 'taggable')->withTimestamps();
    }
    public function posts() {
        return $this->morphedByMany('App\Post', 'taggable')->withTimestamps();
    }

    public function comments() {
        return $this->morphedByMany('App\Comment', 'taggable')->withTimestamps();
    }
}
