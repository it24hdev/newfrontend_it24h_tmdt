<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Products extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1; $i < 50; $i++){
            $faker = \Faker\Factory::create();
            DB::table("products")->insert([
                "name" => $faker->name(),
                "slug" => Str::slug($faker->name(),'-'),
                "price" => $faker->numberBetween($min = 10000, $max = 16000000),
                "onsale" => $faker->numberBetween($min = 0, $max = 15),
                "price_onsale" => $faker->numberBetween($min = 10000, $max = 16000000),
                "quantity" => $faker->numberBetween($min = 10, $max = 1000),
                "content" => $faker->word,
                "thumb" => rand(1,16).'.jpg',
                "image" => 'no-images.jpg',
                'trend' => $faker->numberBetween(0, 1),
                'recommend' => $faker->numberBetween(0, 1),
                'deals' => $faker->numberBetween(0, 1),
                'status' => 1,
                "user_id" => $faker->numberBetween(1, 2),
                "brand" => $faker->name(),
                "cat_id" => "",
                "limit_amount" => $faker->numberBetween(0, 10),
                "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
                "updated_at" => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
        };
    }
}
