<?php

use App\Post;
use App\Tag;
use Illuminate\Database\Seeder;

class TaggableTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tagsCount = Tag::count();

        Post::all()->each(function($post) use($tagsCount){
            
            $take = random_int(1, 1);

            $tagsIds = Tag::inRandomOrder()->take($take)->get()->pluck('id');

            $post->tags()->sync($tagsIds);
            
        });
    }
    }

