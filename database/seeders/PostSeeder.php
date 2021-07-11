<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory;


class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        foreach (range(1,50) as $index) {
            DB::table('posts')->insert([
                'user_id' => rand(1, 20),
                'category_id' => rand(1, 10),
                'title' => $faker->sentence,
                'content' => $faker->paragraph,
                'slug' => $faker->slug,
                'thumbnail' => $faker->image('public/admin/media/images/post', 400, 300, null, false),
                'content' => $faker->paragraph,
                'status' =>rand(0, 1),
            ]);
        }
    }

}
