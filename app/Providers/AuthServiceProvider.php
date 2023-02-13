<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Comment' => 'App\Policies\CommentPolicy',
        'App\User' => 'App\Policies\UserPolicy'
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('manage posts', function ($user) {
            return (bool) $user->is_admin;
        });
        
      /*   Gate::define('favorite', function ($post) {
            
            if(Favorite::where('post_id', $post->id)->where('user_id',9)->exists()) {
                return true;}
        }); */
     /*    Gate::define('store-favorite', function($post) {
            
            if (App\Favorite::where('post_id', $post->id)->where('user_id',auth()->user()->id)->exists()) {
                return false;
            }
            return true;


        }); */
       
        Gate::before(function($user, $ability) {
            if($user->is_admin && in_array($ability, ["update", "delete"])) {
                return true;}
            });
        }}
