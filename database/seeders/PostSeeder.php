<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 0; $i < 20; $i++){
            $faker = \Faker\Factory::create();
            DB::table("posts")->insert([
                "title" => $faker->text(50),
                "slug" => Str::slug($faker->text(50),'-'),
                "excerpt" => $faker->text(70),
                "content" => $faker->text(200),
                "thumb" => rand(1,4).'.jpg',
                "status" => 1,
                "user_id" => $faker->numberBetween(1, 2),
                "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
                "updated_at" => Carbon::now()->format('Y-m-d H:i:s')
            ]);
        };
    }
}
