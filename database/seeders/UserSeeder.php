<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory;


class UserSeeder extends Seeder
{


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->defaultUser();
        $faker = Factory::create();
        foreach (range(1,20) as $index) {
            DB::table('users')->insert([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail(),
                'password' =>bcrypt($faker->password),
            ]);
        }

    }

    public function defaultUser(){
        DB::table('users')->insert([
            'name' => "admin",
            'email' => "blog@blog.com",
            'password' =>bcrypt('12345678'),
        ]);
    }
}
