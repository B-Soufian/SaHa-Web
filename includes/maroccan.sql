-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: Jun 20, 2025 at 11:12 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `maroccan`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `status` enum('pending','delivered','cancelled') NOT NULL DEFAULT 'pending',
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `price`, `status`, `created_at`) VALUES
(4, 5, 35.00, 'cancelled', '2025-06-09 16:30:44'),
(5, 5, 12.00, 'pending', '2025-06-09 19:40:37'),
(6, 6, 18.00, 'delivered', '2025-06-09 23:33:46'),
(7, 6, 82.00, 'delivered', '2025-06-09 23:34:31'),
(9, 4, 30.00, 'pending', '2025-06-13 13:36:36'),
(10, 4, 6.00, 'delivered', '2025-06-13 13:56:19'),
(11, 10, 48.00, 'delivered', '2025-06-14 20:03:16'),
(12, 10, 30.00, 'pending', '2025-06-14 20:25:09'),
(13, 4, 45.00, 'pending', '2025-06-15 13:48:58'),
(14, 11, 36.00, 'delivered', '2025-06-15 15:04:41'),
(17, 11, 340.00, 'pending', '2025-06-15 15:14:30'),
(18, 4, 240.00, 'pending', '2025-06-18 16:30:58');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(10) UNSIGNED NOT NULL,
  `order_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `price`) VALUES
(6, 4, 16, 1, 15.00),
(7, 4, 12, 2, 10.00),
(8, 5, 5, 2, 6.00),
(9, 6, 5, 3, 6.00),
(10, 7, 10, 1, 30.00),
(11, 7, 11, 2, 5.00),
(12, 7, 15, 1, 30.00),
(13, 7, 5, 2, 6.00),
(16, 9, 9, 1, 30.00),
(17, 10, 5, 1, 6.00),
(18, 11, 5, 3, 6.00),
(19, 11, 15, 1, 30.00),
(20, 12, 7, 1, 10.00),
(21, 12, 6, 2, 10.00),
(22, 13, 10, 1, 30.00),
(23, 13, 16, 1, 15.00),
(24, 14, 5, 1, 6.00),
(25, 14, 4, 1, 30.00),
(26, 17, 14, 2, 120.00),
(27, 17, 13, 1, 100.00),
(28, 18, 4, 3, 80.00);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  `quantity` int(11) NOT NULL DEFAULT 0,
  `is_featured` int(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `image`, `category`, `quantity`, `is_featured`) VALUES
(4, 'tajine', 80.00, 'https://visitruralmorocco.com/wp-content/uploads/2023/07/tajine-4.jpg', 'Main Courses', 50, 0),
(5, 'Baghrir', 10.00, 'https://africa-cuisine.com/wp-content/uploads/2023/09/baghrir.jpg', 'Moroccan Desserts', 100, 0),
(6, 'Batbout', 10.00, 'https://img.cuisineaz.com/660x495/2016/06/16/i26651-batbout.jpeg', 'Moroccan Desserts', 100, 0),
(7, 'Bissara', 15.00, 'https://imag.bonviveur.com/bissara.jpg', 'Main Courses', 100, 0),
(8, 'Chebakia', 20.00, 'https://egyptianrecipe.com/wp-content/uploads/2024/09/Chebakia-Sesame-Cookies.jpg', 'Moroccan Desserts', 100, 0),
(9, 'Couscous', 50.00, 'https://i0.wp.com/moroccanfoodtour.com/wp-content/uploads/2019/03/Moroccan-Food-Tours-Blog-Pictures-7.jpg', 'Main Courses', 100, 0),
(10, 'Egg Khli3', 30.00, 'https://pbs.twimg.com/media/DDt-Md0XsAA35-1.jpg', 'Main Courses', 100, 0),
(11, 'Harcha', 8.00, 'https://www.la-cuisine-marocaine.com/photos-recettes/Mini-Harcha.jpg', 'Moroccan Desserts', 19, 0),
(12, 'Harira', 14.00, 'https://www.grandmoroccanbazaar.com/wp-content/uploads/2022/12/Harira-Moroccan-soup-2.jpg', 'Main Courses', 100, 0),
(13, 'Kaab el Ghazal', 20.00, 'https://thumbs.dreamstime.com/b/kaab-al-ghazal-moroccan-sweets-detail-shot-fresh-baked-el-sweet-also-known-as-gazzele-horns-due-to-his-peculiar-shape-made-111942385.jpg', 'Moroccan Desserts', 200, 0),
(14, 'Tanjia', 120.00, 'https://cateringeventmarrakech.com/wp-content/uploads/2022/11/Tanjia-1.jpg', 'Main Courses', 30, 0),
(15, 'Atay', 15.00, 'https://roadofkitchen.com/wp-content/uploads/2023/04/41-1.jpg', 'Beverages', 300, 0),
(16, 'Cafe', 15.00, 'https://torrefactory.coffee/cdn/shop/articles/americano.png?v=1677058023', 'Beverages', 90, 0),
(18, 'Tajine djaj', 50.00, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS-_JokX8jZfAVF2hHdu_OA5brlSJ1nSbAyLg&s', 'Main Courses', 100, 0),
(19, 'Tajine l7out', 40.00, 'https://assets.afcdn.com/recipe/20160802/33957_w1024h1024c1cx1500cy1000.jpg', 'Main Courses', 10, 0),
(20, 'Rfissa', 80.00, 'https://www.samia.fr/wp-content/uploads/2015/06/ob_693da6_jkih.jpg', 'Main Courses', 20, 1),
(21, 'Seffa ', 10.00, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSXzefWlQ4-6eIPF7cZR2S97T9u_3DGp_22pg&s', 'Main Courses', 100, 0),
(22, 'Kefta', 90.00, 'https://jecuisine.info/kefta.1.jpg', 'Main Courses', 100, 0),
(23, 'djaj mhamer', 110.00, 'https://flavorsofmorocco.com/wp-content/uploads/2023/09/Bundles-Photos-Banner-39-1024x512-1.webp', 'Main Courses', 90, 1),
(24, 'BM', 20.00, 'https://www.thermorecetas.com/wp-content/uploads/2024/03/DSC05038-2-min-scaled-e1709837674720.jpg', 'Main Courses', 100, 0),
(25, 'Loubia', 25.00, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcROue6GHB17yAC3Ox_S2hMqhAYF_1_Flg97yQ&s', 'Main Courses', 201, 1),
(26, 'nuss nuss', 12.00, 'https://moroccobytours.com/wp-content/uploads/2023/12/coffe-in-morocco.jpg', 'Beverages', 19, 0),
(27, 'Lben', 8.00, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSRZVdq8VggSbYIBaKGccLBggQFr-zck0SRqqlZHsUSbUQhXBn7Gm3FR_LOTbdg3H0ce20&usqp=CAU', 'Beverages', 19, 0),
(29, 'Sellou (Sfouf)', 20.00, 'https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEiW221Yq6XXCFFu5YJO_KLze8fXnnrJj0TU7oMQZAjIdjIetFLUo7C9glM65TF5n7LzGepCAKTnmDMneqr66K56dNWa7oS6QUJoHZzFPyN27aVIjqqlnlxvRBmxuZQkiUqe9CeuvA-TdkFC/w1200-h630-p-k-no-nu/MOROCCAN+SELLOU+SFOUF+Zammita.jp', 'Moroccan Desserts', 209, 0),
(30, 'Ghriba ', 15.00, 'https://sugaryums.com/wp-content/uploads/2021/02/Moroccan-Cookies-Ghriba-Cover-SugarYums.jpg', 'Moroccan Desserts', 80, 0),
(31, 'Fekkas ', 20.00, 'https://odelices.ouest-france.fr/images/recettes/2012/fekqas-aux-fruits-secs-feqqas-fekkas.jpg', 'Moroccan Desserts', 100, 0),
(32, 'Briwat', 11.00, 'https://kookmutsjes.com/wp-content/uploads/2021/06/Kip-briwat-Kookmutsjes-1024x754-1.jpg.webp', 'Moroccan Desserts', 100, 0),
(33, 'Msemen', 6.00, 'https://butfirstchai.com/wp-content/uploads/2016/10/msemen-bread-recipe.jpg', 'Moroccan Desserts', 100, 0),
(34, 'Zaalouk', 10.00, 'https://www.thedeliciouscrescent.com/wp-content/uploads/2021/09/Zaalouk-5.jpg', 'Salads', 190, 0),
(35, 'Taktouka ', 10.00, 'https://www.thefooddictator.com/wp-content/uploads/2022/08/taktouka-225x225.jpg', 'Salads', 100, 0),
(36, 'Salata khadra', 18.00, 'https://i.pinimg.com/originals/05/51/96/0551968b4f0dd5796e63ed3ee9375ca6.jpg', 'Salads', 190, 0),
(37, 'Salata b chiflor', 17.00, 'https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEhwiDjnb1Qgay9AG-GIjy5lPX5dpWDLx-zTPH2xM0oilFQk9y4zteNcSDUzrKvsgjptnD3M8JLPl6fi91tRGIGlRMlmkx1fHr1pnl2Dp8KG6rFCwZfCbGyXAQZF_bV9oYJPcowXyaLPW73y/s1600/salada+de+acelga.jpg', 'Salads', 190, 0),
(38, 'Salata de batata', 18.00, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQeX9eLdf1c4rHe0MQThLL6VKwHNUNveGUjUw&s', 'Salads', 180, 0),
(39, 'Maakouda', 10.00, 'https://cuisinedefadila.com/wp-content/uploads/2016/03/Maakouda-3-sur-16.jpg', 'Salads', 170, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('user','admin') NOT NULL DEFAULT 'user',
  `statu` enum('Active','banned') NOT NULL DEFAULT 'Active',
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `phone` varchar(100) DEFAULT '0600000000',
  `address` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `role`, `statu`, `first_name`, `last_name`, `phone`, `address`) VALUES
(4, 'bouhmadsoufian@gmail.com', 'soufian', 'user', 'Active', 'soufian', 'bouhmad', '0629879964', '123 mansour temsna'),
(5, 'bouhmadsoufian16@gmail.com', 'soufian', 'admin', 'Active', 'hamid', 'lamba', '0600000000', 'rabat'),
(6, 'smithjustine360@gmail.com', 'salah', 'user', 'Active', 'salah', 'ouali', '0600000000', 'agadir'),
(9, 'admin@gmail.com', 'admin@105', 'admin', 'Active', 'admin', '.', '0600000000', 'casa'),
(10, 'fatima.wa@gmail.com', 'fatima', 'user', 'Active', 'fatima', 'alawi', '', 'rabat hay lfath'),
(11, 'aboflahhasa@gmail.com', 'falah', 'user', 'Active', 'ahmad', 'hamdawi', '0529879866', 'agadir dshara'),
(13, 'soufianbouhmad@gmail.com', 'youssef', 'user', 'Active', 'youssef', 'amjad', '0628192838', '123 tanger');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
