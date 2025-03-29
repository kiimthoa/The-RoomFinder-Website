-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th6 08, 2018 lúc 04:19 PM
-- Phiên bản máy phục vụ: 10.1.29-MariaDB
-- Phiên bản PHP: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `phongtro_laravel`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Phòng trọ cho thuê', 'phong-tro-cho-thue', NULL, NULL),
(2, 'Ở ghép', 'o-ghep', NULL, NULL),
(3, 'Nhà cấp 4', 'nha-nguyen-can', NULL, NULL),
(4, 'Chung cư mini', 'chung-cu', NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `districts`
--

CREATE TABLE `districts` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `districts`
--

INSERT INTO `districts` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Bến Thủy', 'ben-thuy', NULL, NULL),
(2, 'Trường Thi', 'truong-thi', NULL, NULL),
(3, 'Phượng Hoàng', 'phuong-hoang', NULL, NULL),
(4, 'Trung Đô', 'trung-do', NULL, NULL),
(5, 'Đội Cung', 'doi-cung', NULL, NULL),
(6, 'Quang Trung', 'quang-trung', NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2018_03_11_083541_create_table_motel_rooms', 1),
(4, '2018_03_11_085624_create_table_districts', 1),
(5, '2018_03_11_085744_create_table_categories', 1),
(6, '2018_04_22_122641_add_column__status_for_user', 1),
(7, '2018_04_22_152143_add_ondelete_cascade_for_motelroom', 1),
(8, '2018_05_06_030849_add_col_phone_for__motelroom_table', 1),
(9, '2018_05_12_063610_add_column_approve_for_motelroom', 1),
(10, '2018_05_13_064120_add_table_report', 1),
(11, '2018_05_19_033745_add_column_slug_table_motelroom', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `motelrooms`
--

CREATE TABLE `motelrooms` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `area` int(11) NOT NULL,
  `count_view` int(11) NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `latlng` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `images` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `category_id` int(11) NOT NULL,
  `district_id` int(11) NOT NULL,
  `utilities` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `approve` int(11) NOT NULL DEFAULT '0',
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `motelrooms`
--

INSERT INTO `motelrooms` (`id`, `title`, `description`, `price`, `area`, `count_view`, `address`, `latlng`, `images`, `user_id`, `category_id`, `district_id`, `utilities`, `created_at`, `updated_at`, `phone`, `approve`, `slug`) VALUES
(1, 'Cho thuê phòng trọ 25m2, ngã tư trần văn giảng và Nguyễn duy trinh', 'Cho thuê phòng trọ, 25m2, ngã tư trần văn giảng và Nguyễn duy trinh. \r\nGiá 1,3tr/1 tháng, điện Nước tự lo \r\n* không chung chủ, phòng có nhà vs riêng *gần biển, phòng sạch sẽ, thoáng mát. \r\n* Wi-Fi free', 1300000, 25, 8, 'Trần Văn Giảng, Hòa Hải, Bến Thủy, Vinh, Việt Nam', '{\"0\":\"15.985249429644863\",\"1\":\"108.27054466270442\"}', '{\"0\":\"phongtro-6O7N4-32783828_1207853946018675_1556571610645790720_n.jpg\"}', 1, 1, 4, '{\"0\":\"Wifi mi\\u1ec5n ph\\u00ed\",\"1\":\"C\\u00f3 g\\u00e1c l\\u1eedng\",\"2\":\"Kh\\u00f4ng chung ch\\u1ee7\",\"3\":\"V\\u1ec7 sinh ri\\u00eang\"}', '2018-05-18 22:50:01', '2018-05-24 07:24:34', '0915325634', 1, 'cho-thue-phong-tro-25m2-nga-tu-tran-van-giang-va-nguyen-duy-trinh'),
(2, 'Cho thuê phòng trọ gần trường Đại Học Kinh Tế', '📌📌📌CHO THUÊ PHÒNG TRỌ📌📌📌\r\nNhà mình hiện còn 1 phòng 20m2( toilet riêng) thoáng mát có cửa sổ, sân phơi đồ, sân để xe. \r\n📍Gần chợ Bắc Mỹ An, gần trường Đại Học Kinh Tế, gần biển \r\n♦️Chỉ cho Nữ thuê\r\n🆙 Phòng 1 người ở 1tr5, 2 người ở 1tr6, 3 người ở 1tr7( ko bao gồm điện nước)- Giờ giấc thoải mái\r\n📱 ‭0128 2585079‬( cô Hường)', 1500000, 20, 19, '83 Bến Thủy, Mỹ An, Bến Thủy, Vinh, Việt Nam', '{\"0\":\"16.047517\",\"1\":\"108.23898009999994\"}', '{\"0\":\"phongtro-UKRmv-phongtro2.jpg\"}', 1, 1, 1, '{\"0\":\"Wifi mi\\u1ec5n ph\\u00ed\",\"1\":\"V\\u1ec7 sinh ri\\u00eang\",\"2\":\"Gi\\u1edd gi\\u1ea5c t\\u1ef1 do\"}', '2018-05-19 00:45:03', '2018-05-24 07:13:16', '01282585079', 1, 'cho-thue-phong-tro-gan-truong-dai-hoc-kinh-te'),
(3, 'Phòng trọ cho thuê số 02-04 TÔN ĐẢN cạnh sát ngã ba huế', 'CHO THUÊ PHÒNG TRỌ.\r\nĐịa chỉ:số 02-04 Bạch Liêu 👉 Có thể ở từ 2 - 4 người.\r\n👉 Phòng rộng rãi.\r\n👉 Phòng có nhà WC riêng.\r\n👉 Có camera an ninh.\r\n👉 Có chỗ để xe thoải mái.\r\n👉 Giờ giấc tự do ( kg chung chủ).\r\nGiá: 1.200.000đ\r\nLiên hệ: 01677.661.114-0236.6542.111 để xem và đặt phòng', 1200000, 25, 2, '2 Tôn Đản, Hòa An, Cẩm Lệ, Vinh, Việt Nam', '{\"0\":\"16.0600903\",\"1\":\"108.17674770000008\"}', '{\"0\":\"phongtro-gyGbK-phongtro3.jpg\",\"1\":\"phongtro-pt1t9-phongtro4.jpg\"}', 2, 1, 6, '{\"0\":\"Wifi mi\\u1ec5n ph\\u00ed\",\"1\":\"Kh\\u00f4ng chung ch\\u1ee7\",\"2\":\"Gi\\u1edd gi\\u1ea5c t\\u1ef1 do\",\"3\":\"V\\u1ec7 sinh ri\\u00eang\"}', '2018-05-19 00:53:43', '2018-05-19 01:06:57', '01677661114', 1, 'phong-tro-cho-thue-so-02-04-ton-dan-canh-sat-nga-ba-vinh'),
(4, 'Phòng trọ 93 Phạm Kinh Vỹ, tại Vinh', 'Góc nhượng trọ \r\nDo có việc nên mình phải chuyển đi cần nhượng trọ 93 phan thanh đã đóng tiền 1 tháng và ở 10 ngày. Phòng có thể ở 1 đn 2 người giờ giấc thoải mái. \r\nBạn nào cần có thể liên hệ \r\nCảm ơn đã đọc tin !', 1200000, 20, 1, '93 Phan Thanh, Thanh Khê, Q. Thanh Khê, Vinh, Việt Nam', '{\"0\":\"16.063204\",\"1\":\"108.20853299999999\"}', '{\"0\":\"no_img_room.png\"}', 2, 1, 2, '{\"0\":\"Wifi mi\\u1ec5n ph\\u00ed\",\"1\":\"C\\u00f3 g\\u00e1c l\\u1eedng\",\"2\":\"Kh\\u00f4ng chung ch\\u1ee7\",\"3\":\"Gi\\u1edd gi\\u1ea5c t\\u1ef1 do\",\"4\":\"V\\u1ec7 sinh ri\\u00eang\"}', '2018-05-19 01:00:17', '2018-05-19 01:00:41', '0912425617', 1, 'phong-tro-93-phan-thanh-thanh-khe-tai-da-nang'),
(6, 'Cho thuê trọ ở đường Cù Chính Lan đi vào 5m', 'Diện tích : 30 m2 _ PHÙ HỢP CHO VỢ CHỒNG MỚI CƯỚI, NGƯỜI ĐI LÀM.\r\n* Vị Trí: Đường Cù Chính Lan đi vào đường 5.5m\r\n* Giá thuê:\r\n+ Phòng : 4 triệu / tháng.\r\n+ Có wifi\r\n+ Toilet riêng\r\n+ Sân phơi\r\n+ Đường 5,5m khu dân cư yên tĩnh. Có chỗ để xe riêng.\r\n+ Cách cầu vượt ngã 3 Huế 50m.\r\n+ Ngay trung tâm thuận tiện cho việc đi làm. đi học.\r\n+ Phòng ở được đến 4-5 người', 3999999, 30, 2, '212 Cù Chính Lan, Thanh Khê, Vinh, Việt Nam', '{\"0\":\"16.0650124\",\"1\":\"108.18574539999997\"}', '{\"0\":\"phongtro-syCRY-phongtro6.jpg\",\"1\":\"phongtro-HiKhQ-phongtro7.jpg\"}', 3, 1, 1, '{\"0\":\"Wifi mi\\u1ec5n ph\\u00ed\",\"1\":\"Gi\\u1edd gi\\u1ea5c t\\u1ef1 do\",\"2\":\"V\\u1ec7 sinh ri\\u00eang\"}', '2018-05-19 01:10:14', '2018-05-19 01:15:14', '0935441138', 1, 'cho-thue-tro-o-duong-cu-chinh-lan-di-vao-5m'),
(7, 'Cần ghép người ở chung phòng trọ Hoàng Hoa Thám', 'Cần tìm một bạn nữ ở ghép, tiền phòng và điện nước chia đôi.\r\nYêu cầu thật thà, không tính toán, vui vẻ.\r\nMình đi làm cả ngày nên chỉ về phòng ở buổi tối thôi.', 1500000, 14, 18, '1 Hoàng Hoa Thám, Thanh Khê, Vinh, Việt Nam', '{\"0\":\"16.069526612710362\",\"1\":\"108.2096887698059\"}', '{\"0\":\"no_img_room.png\"}', 4, 2, 2, '{\"0\":\"Wifi mi\\u1ec5n ph\\u00ed\",\"1\":\"C\\u00f3 g\\u00e1c l\\u1eedng\",\"2\":\"Kh\\u00f4ng chung ch\\u1ee7\",\"3\":\"Gi\\u1edd gi\\u1ea5c t\\u1ef1 do\",\"4\":\"V\\u1ec7 sinh ri\\u00eang\"}', '2018-05-19 01:13:40', '2018-05-24 07:24:17', '0934162386', 1, 'can-ghep-nguoi-o-chung-phong-tro-hoang-hoa-tham');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `reports`
--

CREATE TABLE `reports` (
  `id` int(10) UNSIGNED NOT NULL,
  `ip_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_motelroom` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `reports`
--

INSERT INTO `reports` (`id`, `ip_address`, `id_motelroom`, `status`, `created_at`, `updated_at`) VALUES
(1, '127.0.0.1', 7, 2, '2018-05-19 01:30:32', '2018-05-19 01:30:32'),
(2, '127.0.0.1', 7, 1, '2018-05-24 07:24:17', '2018-05-24 07:24:17'),
(3, '127.0.0.1', 1, 2, '2018-05-24 07:24:33', '2018-05-24 07:24:33');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `right` int(11) NOT NULL DEFAULT '0',
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'no-avatar.jpg',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tinhtrang` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `password`, `right`, `phone`, `avatar`, `remember_token`, `created_at`, `updated_at`, `tinhtrang`) VALUES
(1, 'Hoàng Văn Công', 'admin', 'conghoang.dev@gmail.com', '$2y$10$0U/rTGgDXcZFEz0VCRAX2umuSMpYCIWCfBj8WdPx6wj1eCf20P9ga', 1, NULL, 'no-avatar.jpg', 'NRwQx67cNhuCY0Zs92qKRusGZmYMA40QB0RrOdroYDLcMZOSnqDVrBJPUCRJ', '2018-05-18 22:44:01', '2018-05-18 22:44:59', 1),
(2, 'Nguyễn Ngọc Hoàng', 'nguyenngoc', 'tatnhac@gmail.com', '$2y$10$w68K356705u4SR1HUmzchOBR1nklo6yDvZ/VzvG0bhQRB9j4QFzwK', 0, NULL, 'no-avatar.jpg', 'j4m9NmrzLAKw6E6MxKE067XbMQegswMBoAjuC5PvnUcAjrF7FpZcPkfrqLbR', '2018-05-19 00:50:52', '2018-05-19 00:50:52', 1),
(3, 'Định Văn Tú', 'vanphuc', 'vantu@gmail.com', '$2y$10$Dbd1QmmlWGV.uYqi9KpTVuD2yKMgqs5fbHVNn5jMeOReaqh79T7gq', 0, NULL, 'no-avatar.jpg', 'BxvBGC60U40Wu1TADa2zk3MrPujWPoaymjboNSoCk9jQethQp2TXEXWO9EbG', '2018-05-19 01:02:17', '2018-05-19 01:02:17', 1),
(4, 'Lê Bảo Ngọc', 'baongoc', 'baongoc@gmail.com', '$2y$10$eMiGI1HA.u0IWJpLT1Wjlec3ojGbDhAmmnITN5Erga6t/GUpzjex.', 0, NULL, 'avatar-baongoc-1526717688.png', 'o9qTtYf2aoyY3imWqUmqLBkNoR7luVz3qoD3JslTmVpQyfapdx6JnZ0r3A9e', '2018-05-19 01:11:11', '2018-05-19 01:14:48', 1);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `districts`
--
ALTER TABLE `districts`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `motelrooms`
--
ALTER TABLE `motelrooms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `motelrooms_user_id_foreign` (`user_id`);

--
-- Chỉ mục cho bảng `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `districts`
--
ALTER TABLE `districts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `motelrooms`
--
ALTER TABLE `motelrooms`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `reports`
--
ALTER TABLE `reports`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `motelrooms`
--
ALTER TABLE `motelrooms`
  ADD CONSTRAINT `motelrooms_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
