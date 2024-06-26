<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
     
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'post_id','user_id',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function post()
    {
        return $this->hasOne(Post::class);
    }
}
