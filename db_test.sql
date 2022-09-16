-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th9 13, 2022 lúc 11:27 AM
-- Phiên bản máy phục vụ: 10.4.24-MariaDB
-- Phiên bản PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `laravel`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admin_menus`
--

CREATE TABLE `admin_menus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admin_menu_items`
--

CREATE TABLE `admin_menu_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `label` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `parent` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `sort` int(11) NOT NULL DEFAULT 0,
  `class` varchar(255) DEFAULT NULL,
  `menu` bigint(20) UNSIGNED NOT NULL,
  `depth` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role_id` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `attribute_products`
--

CREATE TABLE `attribute_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `attr` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `color` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `name2` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `taxonomy` bigint(20) UNSIGNED NOT NULL,
  `parent_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `thumb` varchar(255) DEFAULT NULL,
  `banner` varchar(255) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `show_push_product` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category_relationships`
--

CREATE TABLE `category_relationships` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cat_id` bigint(20) UNSIGNED NOT NULL,
  `post_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone_number` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `reset_password` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `locationmenus`
--

CREATE TABLE `locationmenus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `name2` varchar(255) NOT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `sidebar` tinyint(1) NOT NULL DEFAULT 1,
  `footer` tinyint(1) NOT NULL DEFAULT 1,
  `menu` tinyint(1) NOT NULL DEFAULT 1,
  `rightmenu` tinyint(1) NOT NULL DEFAULT 1,
  `position` int(11) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `locationmenus`
--

INSERT INTO `locationmenus` (`id`, `name`, `name2`, `category_id`, `sidebar`, `footer`, `menu`, `rightmenu`, `position`, `slug`, `parent_id`, `created_at`, `updated_at`) VALUES
(32, 'Laptop, Tablet, Moblie', 'Laptop, Tablet, Moblie', 40, 1, 1, 1, 1, NULL, 'laptop-tablet-moblie', 0, '2022-07-20 00:03:06', '2022-07-20 00:03:06'),
(34, 'Laptop Theo Hãng', 'Laptop By Brand', 41, 1, 1, 1, 1, NULL, 'laptop-theo-hang', 40, '2022-07-20 00:13:04', '2022-07-20 00:13:04'),
(35, 'Laptop Acer', 'Laptop Acer', 42, 1, 1, 1, 1, NULL, 'laptop-acer', 41, '2022-07-20 00:14:24', '2022-07-20 00:14:24'),
(36, 'Laptop Asus', 'Laptop Asus', 43, 1, 1, 1, 1, NULL, 'laptop-asus', 41, '2022-07-20 00:14:54', '2022-07-20 00:14:54'),
(37, 'Laptop Acer Aspire', 'Laptop Acer Aspire', 44, 1, 1, 1, 1, NULL, 'laptop-acer-aspire', 42, '2022-07-20 00:15:12', '2022-07-20 00:15:12'),
(38, 'Laptop Acer Intro', 'Laptop Acer Intro', 45, 1, 1, 1, 1, NULL, 'laptop-acer-intro', 42, '2022-07-20 00:15:29', '2022-07-20 00:15:29'),
(39, 'Phụ Kiện Laptop, PC, Mobile', 'Laptop, PC, Mobile Accessories', 46, 1, 1, 1, 1, NULL, 'phu-kien-laptop-pc-mobile', 0, '2022-07-20 00:23:44', '2022-07-20 00:23:44'),
(40, 'PC Gaming, Streaming', 'PC Gaming, Streaming', 47, 1, 1, 1, 1, NULL, 'pc-gaming-streaming', 0, '2022-07-20 00:25:16', '2022-07-20 00:25:16'),
(41, 'PC Đồ Họa, Render, Máy Chủ', 'PC Graphics, Render, Server', 48, 1, 1, 1, 1, NULL, 'pc-do-hoa-render-may-chu', 0, '2022-07-20 00:26:23', '2022-07-20 00:26:23'),
(42, 'PC Văn Phòng, AIO, Mini PC', 'Office PC, AIO, Mini PC', 49, 1, 1, 1, 1, NULL, 'pc-van-phong-aio-mini-pc', 0, '2022-07-20 00:27:21', '2022-07-20 00:27:21'),
(43, 'Linh Kiện Máy Tính', 'Computer Components', 50, 1, 1, 1, 1, NULL, 'linh-kien-may-tinh', 0, '2022-07-20 00:38:22', '2022-07-20 00:38:22'),
(44, 'Tản Nhiệt PC, Cooling', 'PC Heatsink, Cooling', 51, 1, 1, 1, 1, NULL, 'tan-nhiet-pc-cooling', 0, '2022-07-20 00:39:17', '2022-07-20 00:39:17'),
(45, 'Màn Hình Máy Tính', 'Computer Display', 52, 1, 1, 1, 1, NULL, 'man-hinh-may-tinh', 0, '2022-07-20 00:40:37', '2022-07-20 00:40:37'),
(46, 'Phím Chuột, Ghế Game, Gear', 'Mouse Keys, Game Chair, Gear', 53, 1, 1, 1, 1, NULL, 'phim-chuot-ghe-game-gear', 0, '2022-07-20 00:41:24', '2022-07-20 00:41:24'),
(47, 'Máy Chơi Game, Tay Game', 'Game Consoles, Gamepads', 54, 1, 1, 1, 1, NULL, 'may-choi-game-tay-game', 0, '2022-07-20 00:42:08', '2022-07-20 00:42:08'),
(48, 'Loa, Tai Nghe, Mic, Webcam', 'Speakers, Headphones, Mic, Webcam', 55, 1, 1, 1, 1, NULL, 'loa-tai-nghe-mic-webcam', 0, '2022-07-20 00:43:03', '2022-07-20 00:43:03'),
(49, 'Camera Quan Sát', 'CCTV Camera', 56, 1, 1, 1, 1, NULL, 'camera-quan-sat', 0, '2022-07-20 00:44:25', '2022-07-20 00:44:25'),
(50, 'Máy tính bảng', 'Tablet', 57, 1, 1, 1, 1, NULL, 'may-tinh-bang', 40, '2022-07-20 03:03:52', '2022-07-20 03:03:52'),
(51, 'Máy tính bảng Apple', 'Apple tablet', 58, 1, 1, 1, 1, NULL, 'may-tinh-bang-apple', 57, '2022-07-20 03:04:28', '2022-07-20 03:04:28'),
(52, 'Máy tính bảng Samsung', 'Samsung tablets', 59, 1, 1, 1, 1, NULL, 'may-tinh-bang-samsung', 57, '2022-07-20 03:05:05', '2022-07-20 03:05:05'),
(53, 'Máy tính bảng Apple Core i 7', 'Apple Core i 7 Tablet', 60, 1, 1, 1, 1, NULL, 'may-tinh-bang-apple-core-i-7', 58, '2022-07-20 03:23:16', '2022-07-20 03:23:16'),
(54, 'Máy tính bảng Apple Core i 9', 'Apple Core i 9 Tablet', 61, 1, 1, 1, 1, NULL, 'may-tinh-bang-apple-core-i-9', 58, '2022-07-20 03:23:43', '2022-07-20 03:23:43'),
(55, 'Laptop Theo Giá', 'Laptop By Price', 62, 1, 1, 1, 1, NULL, 'laptop-theo-gia', 40, '2022-07-20 03:30:23', '2022-07-20 03:30:23'),
(56, 'Dưới 10 triệu', 'Under 500 $', 63, 1, 1, 1, 1, NULL, 'laptop-duoi-10-trieu', 62, '2022-07-20 03:30:56', '2022-07-20 03:30:56'),
(57, 'Laptop theo nhu cầu', 'Laptop on demand', 64, 1, 1, 1, 1, NULL, 'laptop-theo-nhu-cau', 40, '2022-07-20 03:42:12', '2022-07-20 03:42:46'),
(58, 'Máy In, Máy Chấm Công', 'Printers, Timekeepers', 65, 1, 1, 1, 1, NULL, 'may-in-may-cham-cong', 0, '2022-07-20 03:44:34', '2022-07-20 03:44:34'),
(59, 'Thiết Bị Văn Phòng Khác', 'Other Office Equipment', 66, 1, 1, 1, 1, NULL, 'thiet-bi-van-phong-khac', 0, '2022-07-20 03:45:28', '2022-07-20 03:45:28'),
(60, 'Điện Thoại', 'Mobile', 68, 1, 1, 1, 1, NULL, 'dien-thoai', 40, '2022-07-24 19:08:36', '2022-07-24 19:08:36'),
(61, 'Laptop Apple', 'Laptop Apple', 73, 1, 1, 1, 1, NULL, 'laptop-apple', 41, '2022-07-25 00:01:42', '2022-07-25 00:01:42');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(302, '2014_10_12_000000_create_users_table', 1),
(303, '2014_10_12_100000_create_password_resets_table', 1),
(304, '2017_08_11_073824_create_menus_wp_table', 1),
(305, '2017_08_11_074006_create_menu_items_wp_table', 1),
(306, '2019_01_05_293551_add-role-id-to-menu-items-table', 1),
(307, '2019_08_19_000000_create_failed_jobs_table', 1),
(308, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(309, '2022_06_02_094824_add_column_to_table_users', 1),
(310, '2022_06_02_095118_create_permissions_table', 1),
(311, '2022_06_02_095240_create_roles_table', 1),
(312, '2022_06_02_095355_create_permission_roles_table', 1),
(313, '2022_06_03_011428_create_posts_table', 1),
(314, '2022_06_03_014612_create_categories_table', 1),
(315, '2022_06_03_014740_create_category_relationships_table', 1),
(316, '2022_06_10_133344_create_products_table', 1),
(317, '2022_06_11_011529_create_votes_table', 1),
(318, '2022_06_11_013807_create_sliders_table', 1),
(319, '2022_06_11_014759_create_customers_table', 1),
(320, '2022_06_11_085221_create_orders_table', 1),
(321, '2022_06_13_032557_create_order_items_table', 1),
(322, '2022_07_05_011440_add_column_to_table_sliders', 1),
(323, '2022_07_12_030007_create_locationmenus_table', 1),
(324, '2022_07_19_045218_create_attribute_products_table', 1),
(325, '2022_07_27_145019_create_tbl_social_table', 1),
(326, '2022_08_29_081738_create_brands_table', 1),
(327, '2022_08_29_111753_create_tag_events_table', 1),
(328, '2022_08_31_162626_recruit', 1),
(329, '2022_09_04_165140_recruit_register', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `customer_name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `address` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `note` text DEFAULT NULL,
  `payment_method` varchar(255) NOT NULL,
  `total` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_name` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `key_code` varchar(255) DEFAULT NULL,
  `parent_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `key_code`, `parent_id`, `created_at`, `updated_at`) VALUES
(69, 'User', NULL, 0, NULL, NULL),
(70, 'Xem', 'view_user', 69, NULL, NULL),
(71, 'Thêm', 'create_user', 69, NULL, NULL),
(72, 'Sửa', 'update_user', 69, NULL, NULL),
(73, 'Xóa', 'delete_user', 69, NULL, NULL),
(74, 'Phân quyền', 'role_user', 69, NULL, NULL),
(84, 'Quyền quản trị', NULL, 0, NULL, NULL),
(85, 'Xem', 'view_role', 84, NULL, NULL),
(86, 'Thêm', 'create_role', 84, NULL, NULL),
(87, 'Sửa', 'update_role', 84, NULL, NULL),
(88, 'Xóa', 'delete_role', 84, NULL, NULL),
(89, 'Bài viết', NULL, 0, NULL, NULL),
(91, 'Xem chi tiết', 'view_post', 89, NULL, NULL),
(92, 'Thêm', 'create_post', 89, NULL, NULL),
(93, 'Sửa', 'update_post', 89, NULL, NULL),
(94, 'Xóa', 'delete_post', 89, NULL, NULL),
(200, 'Khách hàng', NULL, 0, NULL, NULL),
(201, 'Xem', 'view_customer', 200, NULL, NULL),
(202, 'Thêm', 'create_customer', 200, NULL, NULL),
(203, 'Sửa', 'update_customer', 200, NULL, NULL),
(204, 'Xoá', 'delete_customer', 200, NULL, NULL),
(250, 'Đơn hàng', NULL, 0, NULL, NULL),
(251, 'Xem', 'view_order', 250, NULL, NULL),
(252, 'Xem chi tiết', 'show_order', 250, NULL, NULL),
(253, 'Cập nhật', 'update_order', 250, NULL, NULL),
(254, 'Xoá', 'delete_order', 250, NULL, NULL),
(300, 'Slider', NULL, 0, NULL, NULL),
(301, 'Xem', 'view_slider', 300, NULL, NULL),
(302, 'Thêm', 'create_slider', 300, NULL, NULL),
(303, 'Sửa', 'update_slider', 300, NULL, NULL),
(304, 'Xoá', 'delete_slider', 300, NULL, NULL),
(305, 'Đánh giá, bình luận', NULL, 0, NULL, NULL),
(306, 'Xem đánh giá bài viết', 'view_vote_post', 305, NULL, NULL),
(307, 'Thêm đánh giá bài viết', 'create_vote_post', 305, NULL, NULL),
(308, 'Sửa đánh giá bài viết', 'update_vote_post', 305, NULL, NULL),
(309, 'Xóa đánh giá bài viết', 'delete_vote_post', 305, NULL, NULL),
(310, 'Xem đánh giá sản phẩm', 'view_vote_product', 305, NULL, NULL),
(311, 'Thêm đánh giá sản phẩm', 'create_vote_product', 305, NULL, NULL),
(312, 'Sửa đánh giá sản phẩm', 'update_vote_product', 305, NULL, NULL),
(313, 'Xóa đánh giá sản phẩm', 'delete_vote_product', 305, NULL, NULL),
(500, 'Danh mục sản phẩm', NULL, 0, NULL, NULL),
(501, 'Xem', 'view_category', 500, NULL, NULL),
(502, 'Thêm', 'update_category', 500, NULL, NULL),
(503, 'Sửa', 'delete_category', 500, NULL, NULL),
(504, 'Xóa', 'create_category', 500, NULL, NULL),
(520, 'Sản phẩm', NULL, 0, NULL, NULL),
(521, 'Xem', 'view_products', 520, NULL, NULL),
(522, 'Thêm', 'create_products', 520, NULL, NULL),
(523, 'Sửa', 'update_products', 520, NULL, NULL),
(524, 'Xóa', 'delete_products', 520, NULL, NULL),
(530, 'Danh mục bài viết', NULL, 0, NULL, NULL),
(531, 'Xem', 'view_categorypost', 530, NULL, NULL),
(532, 'Thêm', 'update_categorypost', 530, NULL, NULL),
(533, 'Sửa', 'delete_categorypost', 530, NULL, NULL),
(534, 'Xóa', 'create_categorypost', 530, NULL, NULL),
(540, 'Vị trí menu', NULL, 0, NULL, NULL),
(541, 'Xem', 'view_locationmenu', 540, NULL, NULL),
(542, 'Sửa', 'update_locationmenu', 540, NULL, NULL),
(780, 'Tuyển dụng', NULL, 0, NULL, NULL),
(781, 'Xem', 'view_recruit', 780, NULL, NULL),
(782, 'Thêm', 'create_recruit', 780, NULL, NULL),
(783, 'Sửa', 'update_recruit', 780, NULL, NULL),
(784, 'Xóa', 'delete_recruit', 780, NULL, NULL),
(790, 'Ứng tuyển', NULL, 0, NULL, NULL),
(791, 'Xem', 'view_recruit_register', 790, NULL, NULL),
(792, 'Sửa', 'update_recruit_register', 790, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `permission_roles`
--

CREATE TABLE `permission_roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(300) NOT NULL,
  `slug` varchar(300) NOT NULL,
  `excerpt` text DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `thumb` varchar(300) DEFAULT 'no-images.jpg',
  `status` int(11) NOT NULL DEFAULT 0,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(300) NOT NULL,
  `slug` varchar(300) NOT NULL,
  `price` bigint(20) UNSIGNED DEFAULT NULL,
  `quantity` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `thumb` varchar(300) DEFAULT 'no-image.jpg',
  `image` text DEFAULT 'no-image.jpg',
  `content` longtext DEFAULT NULL,
  `short_content` longtext DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `cat_id` varchar(255) DEFAULT NULL,
  `brand` bigint(20) UNSIGNED DEFAULT NULL,
  `unit` varchar(32) DEFAULT NULL,
  `onsale` int(11) DEFAULT 0,
  `price_onsale` bigint(20) DEFAULT 0,
  `new` int(11) DEFAULT 0,
  `hot_sale` int(11) DEFAULT 0,
  `time_deal` timestamp NULL DEFAULT NULL,
  `specifications` text DEFAULT NULL,
  `event` varchar(255) DEFAULT NULL,
  `installment` varchar(255) DEFAULT NULL,
  `year` varchar(255) DEFAULT NULL,
  `gift` longtext DEFAULT NULL,
  `sold` int(11) DEFAULT NULL,
  `property` longtext DEFAULT NULL,
  `property_short` longtext DEFAULT NULL,
  `attr` text DEFAULT NULL,
  `still_stock` varchar(255) DEFAULT NULL,
  `youtube` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `recruits`
--

CREATE TABLE `recruits` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `location` varchar(255) NOT NULL,
  `location_name` varchar(255) NOT NULL,
  `vacancies` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `income` varchar(255) NOT NULL,
  `quantum` varchar(255) NOT NULL,
  `deadline` date NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `recruit_registers`
--

CREATE TABLE `recruit_registers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `phone_number` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `vitriungtuyen` varchar(255) NOT NULL,
  `fileupload` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `desc` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sliders`
--

CREATE TABLE `sliders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` text DEFAULT NULL,
  `location` int(11) NOT NULL DEFAULT 0,
  `link_target` varchar(300) DEFAULT '#',
  `image` varchar(300) DEFAULT 'no-images.jpg',
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `position` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `subtitle` varchar(300) DEFAULT NULL,
  `description` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tag_events`
--

CREATE TABLE `tag_events` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `color_left` varchar(255) NOT NULL,
  `color_right` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_social`
--

CREATE TABLE `tbl_social` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `provider_user_id` varchar(255) NOT NULL,
  `provider` varchar(255) NOT NULL,
  `user` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone_number` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `role_id` bigint(20) UNSIGNED DEFAULT NULL,
  `is_admin` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `avatar`, `address`, `phone_number`, `gender`, `birthday`, `role_id`, `is_admin`, `deleted_at`) VALUES
(1, 'Admin', 'admin@gmail.com', NULL, '$2y$10$cQcZcl/MaWZfiGcPABYBZeD51yMD8A.DcVahYREO8o14eCBEdKxPq', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `votes`
--

CREATE TABLE `votes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `level` int(11) DEFAULT NULL,
  `comment` text DEFAULT NULL,
  `name_user` varchar(300) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `post_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `admin_menus`
--
ALTER TABLE `admin_menus`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `admin_menu_items`
--
ALTER TABLE `admin_menu_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_menu_items_menu_foreign` (`menu`);

--
-- Chỉ mục cho bảng `attribute_products`
--
ALTER TABLE `attribute_products`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_name_unique` (`name`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`);

--
-- Chỉ mục cho bảng `category_relationships`
--
ALTER TABLE `category_relationships`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_relationships_cat_id_foreign` (`cat_id`),
  ADD KEY `category_relationships_post_id_foreign` (`post_id`);

--
-- Chỉ mục cho bảng `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `customers_email_unique` (`email`);

--
-- Chỉ mục cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Chỉ mục cho bảng `locationmenus`
--
ALTER TABLE `locationmenus`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_customer_id_foreign` (`customer_id`);

--
-- Chỉ mục cho bảng `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`),
  ADD KEY `order_items_product_id_foreign` (`product_id`);

--
-- Chỉ mục cho bảng `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Chỉ mục cho bảng `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `permission_roles`
--
ALTER TABLE `permission_roles`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Chỉ mục cho bảng `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `posts_title_unique` (`title`),
  ADD KEY `posts_user_id_foreign` (`user_id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_name_unique` (`name`),
  ADD UNIQUE KEY `products_slug_unique` (`slug`);

--
-- Chỉ mục cho bảng `recruits`
--
ALTER TABLE `recruits`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `recruit_registers`
--
ALTER TABLE `recruit_registers`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sliders_user_id_foreign` (`user_id`);

--
-- Chỉ mục cho bảng `tag_events`
--
ALTER TABLE `tag_events`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tbl_social`
--
ALTER TABLE `tbl_social`
  ADD PRIMARY KEY (`user_id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_role_id_foreign` (`role_id`);

--
-- Chỉ mục cho bảng `votes`
--
ALTER TABLE `votes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `votes_post_id_foreign` (`post_id`),
  ADD KEY `votes_product_id_foreign` (`product_id`),
  ADD KEY `votes_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `admin_menus`
--
ALTER TABLE `admin_menus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `admin_menu_items`
--
ALTER TABLE `admin_menu_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `attribute_products`
--
ALTER TABLE `attribute_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `category_relationships`
--
ALTER TABLE `category_relationships`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `locationmenus`
--
ALTER TABLE `locationmenus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=330;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=793;

--
-- AUTO_INCREMENT cho bảng `permission_roles`
--
ALTER TABLE `permission_roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `recruits`
--
ALTER TABLE `recruits`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `recruit_registers`
--
ALTER TABLE `recruit_registers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tag_events`
--
ALTER TABLE `tag_events`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tbl_social`
--
ALTER TABLE `tbl_social`
  MODIFY `user_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `votes`
--
ALTER TABLE `votes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `admin_menu_items`
--
ALTER TABLE `admin_menu_items`
  ADD CONSTRAINT `admin_menu_items_menu_foreign` FOREIGN KEY (`menu`) REFERENCES `admin_menus` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `category_relationships`
--
ALTER TABLE `category_relationships`
  ADD CONSTRAINT `category_relationships_cat_id_foreign` FOREIGN KEY (`cat_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `category_relationships_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`);

--
-- Các ràng buộc cho bảng `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `sliders`
--
ALTER TABLE `sliders`
  ADD CONSTRAINT `sliders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `votes`
--
ALTER TABLE `votes`
  ADD CONSTRAINT `votes_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `votes_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `votes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
