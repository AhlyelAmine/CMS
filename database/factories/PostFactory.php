<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Post::class, function (Faker $faker) {

    return [
        'title' => $faker->sentence(10),
        'content' => $faker->paragraphs(5, true),
        'active' => false,
        'updated_at'=> $faker->dateTimeBetween('-3 years'),
        'created_at'=> $faker->dateTimeBetween('-3 years'),
        'slug' =>  Str::slug('title','-')
    ];
});
