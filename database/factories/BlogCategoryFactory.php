<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\BlogCategory;
use Faker\Generator as Faker;

$factory->define(BlogCategory::class, function (Faker $faker) {
    $blogs = App\Blog::all()->pluck('id')->toArray();
    $categories = App\Category::all()->pluck('id')->toArray();
    return [
        'blogs_id' => $faker->randomElement($blogs),
        'categories_id' => $faker->randomElement($categories),
    ];
});
