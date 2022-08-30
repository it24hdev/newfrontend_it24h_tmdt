<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        DB::table("sliders")->insert([
            "name" => $faker->name(),
            "location" => 1,
            "link_target" => $faker->word,
            "image" => 'h2-banner1.jpg',
            'position' => $faker->numberBetween(1, 3),
            'status' => 1,
            "user_id" => $faker->numberBetween(1, 2),
            "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
            "updated_at" => Carbon::now()->format('Y-m-d H:i:s'),
            "subtitle" => $faker->word,
            "description" => $faker->word,
        ]);
        DB::table("sliders")->insert([
            "name" => $faker->name(),
            "location" => 2,
            "link_target" => $faker->word,
            "image" => 'h2-banner4.jpg',
            'position' => $faker->numberBetween(1, 3),
            'status' => 1,
            "user_id" => $faker->numberBetween(1, 2),
            "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
            "updated_at" => Carbon::now()->format('Y-m-d H:i:s'),
            "subtitle" => $faker->word,
            "description" => $faker->word,
        ]);
        DB::table("sliders")->insert([
            "name" => $faker->name(),
            "location" => 3,
            "link_target" => $faker->word,
            "image" => 'h2-banner2.jpg',
            'position' => $faker->numberBetween(1, 3),
            'status' => 1,
            "user_id" => $faker->numberBetween(1, 2),
            "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
            "updated_at" => Carbon::now()->format('Y-m-d H:i:s'),
            "subtitle" => $faker->word,
            "description" => $faker->word,
        ]);
        DB::table("sliders")->insert([
            "name" => $faker->name(),
            "location" => 4,
            "link_target" => $faker->word,
            "image" => 'h2-banner3.jpg',
            'position' => $faker->numberBetween(1, 3),
            'status' => 1,
            "user_id" => $faker->numberBetween(1, 2),
            "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
            "updated_at" => Carbon::now()->format('Y-m-d H:i:s'),
            "subtitle" => $faker->word,
            "description" => $faker->word,
        ]);
        DB::table("sliders")->insert([
            "name" => $faker->name(),
            "location" => 5,
            "link_target" => $faker->word,
            "image" => 'h2-bg1.jpg',
            'position' => $faker->numberBetween(1, 3),
            'status' => 1,
            "user_id" => $faker->numberBetween(1, 2),
            "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
            "updated_at" => Carbon::now()->format('Y-m-d H:i:s'),
            "subtitle" => $faker->word,
            "description" => $faker->word,
        ]);
    }
}
