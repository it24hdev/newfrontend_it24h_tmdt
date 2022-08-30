<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class categories extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // for($i = 1; $i < 5; $i++){
        // $faker = \Faker\Factory::create();
        // DB::table("categories")->insert([
        //     "name" => $faker->unique()->name(),
        //     "slug" => Str::slug($faker->unique()->name(),'-'),
        //     "taxonomy" => '0',
        //     "parent_id" => 0,
        //     "user_id" => $faker->numberBetween(1, 100),
        //     "status" => '1',
        //     ]);
        // };
        // for($i = 5; $i < 15; $i++){
        //     $faker = \Faker\Factory::create();
        //     DB::table("categories")->insert([
        //         "name" => $faker->unique()->name(),
        //         "slug" => Str::slug($faker->unique()->name(),'-'),
        //         "taxonomy" => '0',
        //         "parent_id" => $faker->numberBetween(1, 4),
        //         "user_id" => $faker->numberBetween(1, 100),
        //         "status" => '1',
        //     ]);
        // };

        // for($i = 15; $i < 19; $i++){
        //     $faker = \Faker\Factory::create();
        //     DB::table("categories")->insert([
        //         "name" => $faker->unique()->name(),
        //         "slug" => Str::slug($faker->unique()->name(),'-'),
        //         "taxonomy" => '1',
        //         "parent_id" => 0,
        //         "user_id" => $faker->numberBetween(1, 4),
        //         "status" => '1',
        //     ]);
        // };
        // for($i = 19; $i < 30; $i++){
        //     $faker = \Faker\Factory::create();
        //     DB::table("categories")->insert([
        //         "name" => $faker->unique()->name(),
        //         "slug" => Str::slug($faker->unique()->name(),'-'),
        //         "taxonomy" => '1',
        //         "parent_id" => $faker->numberBetween(15, 18),
        //         "user_id" => $faker->numberBetween(1, 4),
        //         "status" => '1',
        //     ]);
        // };
        // for($i = 30; $i < 40; $i++){
        //     $faker = \Faker\Factory::create();
        //     DB::table("categories")->insert([
        //         "name" => $faker->unique()->name(),
        //         "slug" => Str::slug($faker->unique()->name(),'-'),
        //         "taxonomy" => '0',
        //         "parent_id" => $faker->numberBetween(5, 6),
        //         "user_id" => $faker->numberBetween(1, 100),
        //         "status" => '1',
        //     ]);
        // };
    }
}
