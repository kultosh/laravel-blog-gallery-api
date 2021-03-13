<?php

use Illuminate\Database\Seeder;
// use Faker\Generator as Faker;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Blog::class, 10)->create();
        // $faker = Faker::create();
        // $blogs = App\Blog::all()->pluck('id')->toArray();
        for($i=0; $i<10; $i++)
        {
            factory(App\BlogCategory::class)->create();
        }
    }
}
