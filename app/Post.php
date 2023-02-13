<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    protected $fillable = ['title', 'content','slug','user_id','post_id','youtube'];
    
    public function user() {
        return $this->belongsTo(User::class);
    }
    public function favorite() {
        return $this->belongsTo(Favorite::class);
    }
    public function tags() {
        return $this->morphToMany('App\Tag', 'taggable')->withTimestamps();
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
    public function scopeMostCommentedThisMounth(Builder $query) 
    {
        return $query->whereHas('comments', function (Builder $query){
            $query->whereBetween('created_at', 
            [Carbon::now()->subMonth(), Carbon::now()]
        );
        })->withCount('comments')->orderBy('comments_count', 'desc');
    } 

}
