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
       DB::statement("INSERT INTO `locationmenus` (`id`, `name`, `name2`, `category_id`, `sidebar`, `footer`, `menu`, `rightmenu`, `position`, `slug`, `parent_id`, `created_at`, `updated_at`) VALUES
(32, 'Laptop, Tablet, Moblie', 'Laptop, Tablet, Moblie', 40, 1, 1, 1, 1, NULL, 'laptop-tablet-moblie', 0, '2022-07-20 07:03:06', '2022-07-20 07:03:06'),
(34, 'Laptop Theo Hãng', 'Laptop By Brand', 41, 1, 1, 1, 1, NULL, 'laptop-theo-hang', 40, '2022-07-20 07:13:04', '2022-07-20 07:13:04'),
(35, 'Laptop Acer', 'Laptop Acer', 42, 1, 1, 1, 1, NULL, 'laptop-acer', 41, '2022-07-20 07:14:24', '2022-07-20 07:14:24'),
(36, 'Laptop Asus', 'Laptop Asus', 43, 1, 1, 1, 1, NULL, 'laptop-asus', 41, '2022-07-20 07:14:54', '2022-07-20 07:14:54'),
(37, 'Laptop Acer Aspire', 'Laptop Acer Aspire', 44, 1, 1, 1, 1, NULL, 'laptop-acer-aspire', 42, '2022-07-20 07:15:12', '2022-07-20 07:15:12'),
(38, 'Laptop Acer Intro', 'Laptop Acer Intro', 45, 1, 1, 1, 1, NULL, 'laptop-acer-intro', 42, '2022-07-20 07:15:29', '2022-07-20 07:15:29'),
(39, 'Phụ Kiện Laptop, PC, Mobile', 'Laptop, PC, Mobile Accessories', 46, 1, 1, 1, 1, NULL, 'phu-kien-laptop-pc-mobile', 0, '2022-07-20 07:23:44', '2022-07-20 07:23:44'),
(40, 'PC Gaming, Streaming', 'PC Gaming, Streaming', 47, 1, 1, 1, 1, NULL, 'pc-gaming-streaming', 0, '2022-07-20 07:25:16', '2022-07-20 07:25:16'),
(41, 'PC Đồ Họa, Render, Máy Chủ', 'PC Graphics, Render, Server', 48, 1, 1, 1, 1, NULL, 'pc-do-hoa-render-may-chu', 0, '2022-07-20 07:26:23', '2022-07-20 07:26:23'),
(42, 'PC Văn Phòng, AIO, Mini PC', 'Office PC, AIO, Mini PC', 49, 1, 1, 1, 1, NULL, 'pc-van-phong-aio-mini-pc', 0, '2022-07-20 07:27:21', '2022-07-20 07:27:21'),
(43, 'Linh Kiện Máy Tính', 'Computer Components', 50, 1, 1, 1, 1, NULL, 'linh-kien-may-tinh', 0, '2022-07-20 07:38:22', '2022-07-20 07:38:22'),
(44, 'Tản Nhiệt PC, Cooling', 'PC Heatsink, Cooling', 51, 1, 1, 1, 1, NULL, 'tan-nhiet-pc-cooling', 0, '2022-07-20 07:39:17', '2022-07-20 07:39:17'),
(45, 'Màn Hình Máy Tính', 'Computer Display', 52, 1, 1, 1, 1, NULL, 'man-hinh-may-tinh', 0, '2022-07-20 07:40:37', '2022-07-20 07:40:37'),
(46, 'Phím Chuột, Ghế Game, Gear', 'Mouse Keys, Game Chair, Gear', 53, 1, 1, 1, 1, NULL, 'phim-chuot-ghe-game-gear', 0, '2022-07-20 07:41:24', '2022-07-20 07:41:24'),
(47, 'Máy Chơi Game, Tay Game', 'Game Consoles, Gamepads', 54, 1, 1, 1, 1, NULL, 'may-choi-game-tay-game', 0, '2022-07-20 07:42:08', '2022-07-20 07:42:08'),
(48, 'Loa, Tai Nghe, Mic, Webcam', 'Speakers, Headphones, Mic, Webcam', 55, 1, 1, 1, 1, NULL, 'loa-tai-nghe-mic-webcam', 0, '2022-07-20 07:43:03', '2022-07-20 07:43:03'),
(49, 'Camera Quan Sát', 'CCTV Camera', 56, 1, 1, 1, 1, NULL, 'camera-quan-sat', 0, '2022-07-20 07:44:25', '2022-07-20 07:44:25'),
(50, 'Máy tính bảng', 'Tablet', 57, 1, 1, 1, 1, NULL, 'may-tinh-bang', 40, '2022-07-20 10:03:52', '2022-07-20 10:03:52'),
(51, 'Máy tính bảng Apple', 'Apple tablet', 58, 1, 1, 1, 1, NULL, 'may-tinh-bang-apple', 57, '2022-07-20 10:04:28', '2022-07-20 10:04:28'),
(52, 'Máy tính bảng Samsung', 'Samsung tablets', 59, 1, 1, 1, 1, NULL, 'may-tinh-bang-samsung', 57, '2022-07-20 10:05:05', '2022-07-20 10:05:05'),
(53, 'Máy tính bảng Apple Core i 7', 'Apple Core i 7 Tablet', 60, 1, 1, 1, 1, NULL, 'may-tinh-bang-apple-core-i-7', 58, '2022-07-20 10:23:16', '2022-07-20 10:23:16'),
(54, 'Máy tính bảng Apple Core i 9', 'Apple Core i 9 Tablet', 61, 1, 1, 1, 1, NULL, 'may-tinh-bang-apple-core-i-9', 58, '2022-07-20 10:23:43', '2022-07-20 10:23:43'),
(55, 'Laptop Theo Giá', 'Laptop By Price', 62, 1, 1, 1, 1, NULL, 'laptop-theo-gia', 40, '2022-07-20 10:30:23', '2022-07-20 10:30:23'),
(56, 'Dưới 10 triệu', 'Under 500 $', 63, 1, 1, 1, 1, NULL, 'laptop-duoi-10-trieu', 62, '2022-07-20 10:30:56', '2022-07-20 10:30:56'),
(57, 'Laptop theo nhu cầu', 'Laptop on demand', 64, 1, 1, 1, 1, NULL, 'laptop-theo-nhu-cau', 40, '2022-07-20 10:42:12', '2022-07-20 10:42:46'),
(58, 'Máy In, Máy Chấm Công', 'Printers, Timekeepers', 65, 1, 1, 1, 1, NULL, 'may-in-may-cham-cong', 0, '2022-07-20 10:44:34', '2022-07-20 10:44:34'),
(59, 'Thiết Bị Văn Phòng Khác', 'Other Office Equipment', 66, 1, 1, 1, 1, NULL, 'thiet-bi-van-phong-khac', 0, '2022-07-20 10:45:28', '2022-07-20 10:45:28'),
(60, 'Điện Thoại', 'Mobile', 68, 1, 1, 1, 1, NULL, 'dien-thoai', 40, '2022-07-25 02:08:36', '2022-07-25 02:08:36'),
(61, 'Laptop Apple', 'Laptop Apple', 73, 1, 1, 1, 1, NULL, 'laptop-apple', 41, '2022-07-25 07:01:42', '2022-07-25 07:01:42')");
    }
}
