<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'content','post_id','user_id',
    ];
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
    public function tags() {
        return $this->morphToMany('App\Tag', 'taggable')->withTimestamps();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
