<?php

namespace Database\Seeders;

use App\Models\Order_item;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            PermissionSeeder::class,
            UserSeeder::class,
            // PostSeeder::class,
            // SliderSeeder::class,

            // categories::class,
            Permission::class,
            // Products::class,

            // CustomerSeeder::class,
            // OrderSeeder::class,
            // Order_itemSeeder::class,
            LocationmenuSeeder::class,

            // VoteSeeder::class,
            // CategoryRelationships::class,
        ]);
    }
}
