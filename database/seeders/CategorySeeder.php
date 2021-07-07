<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = Factory::create();


        foreach (range(1, 10) as $index) {
            DB::table('categories')->insert([
                'name' => $faker->unique()->name,
                'slug' => $faker->slug,
                'status' =>rand(0, 1),
            ]);
        }
    }
}
