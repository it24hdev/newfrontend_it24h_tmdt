<?php

namespace Database\Seeders;
use App\Models\Locationmenu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class LocationmenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       DB::statement("INSERT INTO `locationmenus` (`id`, `name`, `name2`, `category_id`, `menu_id`, `sidebar_location`, `footer_location`, `menu_location`, `rightmenu_location`, `position`, `slug`, `parent_id`, `created_at`, `updated_at`) VALUES (1, '', '', NULL, NULL, 0, 0, 0, 0, 0, '0', 0, NULL, '2022-09-14 10:05:30'),(2, '', '', NULL, NULL, 0, 0, 0, 0, 0, '0', 0, NULL, '2022-09-14 11:57:19'),(3, '', '', NULL, NULL, 0, 0, 0, 0, 0, '0', 0, NULL, '2022-09-14 10:01:47'),(4, '', '', NULL, NULL, 0, 0, 0, 0, 0, '0', 0, NULL, NULL);");
    }
}
