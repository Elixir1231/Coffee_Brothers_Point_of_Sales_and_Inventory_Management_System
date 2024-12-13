-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 13, 2024 at 09:27 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pointofsale`
--

-- --------------------------------------------------------

--
-- Table structure for table `cashflow`
--

CREATE TABLE `cashflow` (
  `transaction_id` int(11) NOT NULL,
  `description` text DEFAULT NULL,
  `amount` decimal(18,2) DEFAULT NULL,
  `username` varchar(30) DEFAULT NULL,
  `transaction_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `cashflow`
--

INSERT INTO `cashflow` (`transaction_id`, `description`, `amount`, `username`, `transaction_date`) VALUES
(1, 'Cash-in', 10000.00, 'admin', '2019-04-08 15:51:58');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL,
  `firstname` varchar(30) DEFAULT NULL,
  `lastname` varchar(30) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `contact_number` varchar(30) DEFAULT NULL,
  `image` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `firstname`, `lastname`, `address`, `contact_number`, `image`) VALUES
(12, 'Random', 'Customer', 'Polomolok', '+63(09)1234-1234', ''),
(16, 'jersel', 'Bill', 'Philippines', '+63(09)1234-1234', 'user.png');

-- --------------------------------------------------------

--
-- Table structure for table `delivery`
--

CREATE TABLE `delivery` (
  `transaction_no` varchar(20) NOT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `username` varchar(20) DEFAULT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `delivery`
--

INSERT INTO `delivery` (`transaction_no`, `supplier_id`, `username`, `date`) VALUES
('5CAAFDA8CD697', 21, 'admin', '2024-05-20 15:52:40'),
('5CAAFDEEDB333', 22, 'admin', '2024-05-20 15:54:19'),
('5CAAFE37D21E8', 21, 'admin', '2024-05-20 15:55:28'),
('5E7F00084C934', 22, 'admin', '2024-05-20 15:43:22'),
('5E81DF2B7B8F7', 22, 'admin', '2024-05-20 20:00:48');

-- --------------------------------------------------------

--
-- Table structure for table `ingredients`
--

CREATE TABLE `ingredients` (
  `ingredient_id` int(11) NOT NULL,
  `ingredient_name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `quantity` int(11) NOT NULL,
  `unit` varchar(20) NOT NULL,
  `min_stocks` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ingredients`
--

INSERT INTO `ingredients` (`ingredient_id`, `ingredient_name`, `description`, `quantity`, `unit`, `min_stocks`) VALUES
(1, 'Arabica', 'Coffee Beans', 75, 'grams', 18),
(2, 'Arabica-Robusta', 'Coffee Beans', 982, 'grams', 18),
(3, 'Chocolate syrup', 'Syrup', 1000, 'ml', 30),
(4, 'Milk', 'Milk', 9800, 'ml', 100),
(9, 'Whipped cream', 'Cream', 10000, 'grams', 100),
(10, ' Vanilla Ice-Cream', 'ice-cream', 1000, 'grams', 66),
(11, 'Sugar', 'Sugar', 1000, 'grams', 4),
(12, 'Irish Whiskey', 'Whiskey', 1000, 'ml', 45),
(15, 'dfwe', 'SDGG', 1413, 'DF', 124);

-- --------------------------------------------------------

--
-- Table structure for table `ingredient_delivered`
--

CREATE TABLE `ingredient_delivered` (
  `transaction_no` varchar(30) NOT NULL,
  `ingredient_id` int(11) NOT NULL,
  `delivered_quantity` int(11) NOT NULL,
  `unit_price` decimal(18,2) NOT NULL,
  `tax_rate` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ingredient_delivered`
--

INSERT INTO `ingredient_delivered` (`transaction_no`, `ingredient_id`, `delivered_quantity`, `unit_price`, `tax_rate`) VALUES
('664B0CE24791D', 9, 212, 12.00, 1),
('664B23252C789', 10, 231, 12.00, 1),
('664B25B7A46B9', 11, 123, 21.00, 1),
('664B51AB4CD10', 12, 1, 21.00, 1),
('664B599F6E768', 13, 0, 0.00, 0);

-- --------------------------------------------------------

--
-- Table structure for table `initial_products`
--

CREATE TABLE `initial_products` (
  `id` varchar(50) NOT NULL,
  `initial_quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `initial_products`
--

INSERT INTO `initial_products` (`id`, `initial_quantity`) VALUES
('1001', 100),
('10011', 200),
('10012', 100),
('1', 100),
('2', 200),
('3', 150),
('4', 125),
('5', 100),
('23213', 23),
('10000', 21);

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `purpose` varchar(30) NOT NULL,
  `logs_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`id`, `username`, `purpose`, `logs_time`) VALUES
(851, 'admin', 'User admin login', '2019-04-08 15:48:04'),
(854, 'admin', 'User admin logout', '2019-04-08 15:49:48'),
(855, 'admin', 'User admin login', '2019-04-08 15:50:04'),
(856, 'admin', 'Supplier OrangeCompany added', '2019-04-08 15:50:54'),
(857, 'admin', 'Customer jersel Added', '2019-04-08 15:51:25'),
(858, 'admin', 'Cash-in', '2019-04-08 15:51:58'),
(859, 'admin', 'Delivery Added', '2019-04-08 15:52:40'),
(860, 'admin', 'Customer Bill Added', '2019-04-08 15:53:18'),
(861, 'admin', 'Delivery Added', '2019-04-08 15:54:19'),
(862, 'admin', 'Delivery Added', '2019-04-08 15:55:29'),
(863, 'admin', 'Product sold', '2019-04-08 15:56:39'),
(864, 'admin', 'User admin logout', '2019-04-08 15:57:38'),
(865, 'admin', 'User admin login', '2019-04-08 16:06:54'),
(866, 'admin', 'User admin login', '2019-04-08 20:28:36'),
(867, 'admin', 'Product sold', '2019-04-08 20:29:27'),
(868, 'admin', 'User admin login', '2020-03-23 16:04:06'),
(869, 'admin', 'User admin logout', '2020-03-23 16:04:24'),
(870, 'admin', 'User admin login', '2020-03-28 12:58:34'),
(871, 'admin', 'User admin logout', '2020-03-28 13:02:20'),
(872, 'admin', 'User admin login', '2020-03-28 13:02:26'),
(873, 'admin', 'User admin logout', '2020-03-28 13:02:59'),
(874, 'admin', 'User admin login', '2020-03-28 13:05:48'),
(875, 'admin', 'Product sold', '2020-03-28 14:06:26'),
(876, 'admin', 'Product sold', '2020-03-28 14:07:27'),
(877, 'admin', 'Product sold', '2020-03-28 14:08:09'),
(878, 'admin', 'Product sold', '2020-03-28 14:14:46'),
(879, 'admin', 'Product sold', '2020-03-28 14:22:55'),
(880, 'admin', 'Product sold', '2020-03-28 14:27:51'),
(881, 'admin', 'Delivery Added', '2020-03-28 15:43:22'),
(882, 'admin', 'Product sold', '2020-03-28 16:14:30'),
(883, 'admin', 'User admin login', '2020-03-29 09:26:29'),
(884, 'admin', 'User admin login', '2020-03-29 09:40:46'),
(885, 'admin', 'Product Coffee updated', '2020-03-29 09:53:36'),
(886, 'admin', 'Product Coffee updated', '2020-03-29 09:53:51'),
(887, 'admin', 'User admin login', '2020-03-30 09:05:52'),
(888, 'admin', 'Product sold', '2020-03-30 09:07:10'),
(889, 'admin', 'User admin login', '2020-03-30 19:59:24'),
(890, 'admin', 'Delivery Added', '2020-03-30 20:00:48'),
(891, 'admin', 'User admin login', '2020-03-30 22:26:03'),
(892, 'user', 'User user login', '2024-05-13 22:14:27'),
(893, 'user', 'User user logout', '2024-05-13 22:14:32'),
(894, 'admin', 'User admin login', '2024-05-13 22:14:38'),
(895, 'admin', 'User admin login', '2024-05-13 22:18:08'),
(897, 'admin', 'User admin logout', '2024-05-13 22:19:47'),
(898, 'kyle', 'User kyle login', '2024-05-13 22:19:56'),
(899, 'kyle', 'User kyle logout', '2024-05-13 22:19:58'),
(900, 'kyle', 'User kyle login', '2024-05-15 03:02:09'),
(901, 'kyle', 'Product Americano updated', '2024-05-15 03:07:13'),
(902, 'kyle', 'Product sold', '2024-05-15 03:22:41'),
(903, 'kyle', 'User kyle logout', '2024-05-15 06:12:02'),
(904, 'user', 'User user login', '2024-05-15 06:12:12'),
(905, 'user', 'User user logout', '2024-05-15 06:12:29'),
(906, 'kyle', 'User kyle login', '2024-05-16 08:05:08'),
(907, 'kyle', 'Product Americano updated', '2024-05-18 16:00:00'),
(908, 'kyle', 'Product Americano updated', '2024-05-18 16:46:08'),
(909, 'kyle', 'Product Americano updated', '2024-05-18 16:50:21'),
(910, 'kyle', 'Product Americano updated', '2024-05-18 17:01:05'),
(911, 'kyle', 'Product Americano updated', '2024-05-18 17:04:06'),
(912, 'kyle', 'Product Americano updated', '2024-05-18 17:04:22'),
(913, 'kyle', 'Product Americano updated', '2024-05-18 17:11:14'),
(914, 'kyle', 'Product Americano updated', '2024-05-18 17:19:36'),
(915, 'kyle', 'Product Americano updated', '2024-05-18 17:19:51'),
(916, 'kyle', 'Product Americano updated', '2024-05-18 17:29:32'),
(917, 'kyle', 'Product Americano updated', '2024-05-18 17:30:01'),
(918, 'kyle', 'Product Americano updated', '2024-05-18 17:30:14'),
(919, 'kyle', 'Product Americano updated', '2024-05-18 17:30:20'),
(920, 'kyle', 'Product Americano updated', '2024-05-18 17:30:26'),
(921, 'kyle', 'Product Americano updated', '2024-05-18 17:30:35'),
(922, 'kyle', 'Product Americano updated', '2024-05-18 17:37:09'),
(923, 'kyle', 'Product Americano updated', '2024-05-18 17:37:17'),
(924, 'kyle', 'Product Americano updated', '2024-05-18 17:37:23'),
(925, 'kyle', 'Product Americano updated', '2024-05-18 17:39:57'),
(926, 'kyle', 'Product Americano updated', '2024-05-18 17:53:31'),
(927, 'kyle', 'Product Americano updated', '2024-05-18 18:25:26'),
(928, 'kyle', 'Product Americano updated', '2024-05-18 18:49:29'),
(929, 'kyle', 'Product Americano updated', '2024-05-18 18:50:20'),
(930, 'kyle', 'Product Americano updated', '2024-05-18 18:51:53'),
(931, 'kyle', 'Product Americano updated', '2024-05-18 18:56:54'),
(932, 'kyle', 'Product Americano updated', '2024-05-18 18:59:28'),
(933, 'kyle', 'Product Americano updated', '2024-05-18 19:03:05'),
(934, 'kyle', 'Product Americano updated', '2024-05-18 19:23:30'),
(935, 'kyle', 'Product Americano updated', '2024-05-18 19:47:41'),
(936, 'kyle', 'Product Americano updated', '2024-05-18 19:50:36'),
(937, 'kyle', 'Product Americano updated', '2024-05-18 20:02:07'),
(938, 'kyle', 'Product Americano updated', '2024-05-18 20:11:46'),
(939, 'kyle', 'Product Americano updated', '2024-05-18 20:16:08'),
(940, 'kyle', 'Product Americano updated', '2024-05-18 20:18:15'),
(941, 'kyle', 'Product Americano updated', '2024-05-18 20:23:23'),
(942, 'kyle', 'Product Americano updated', '2024-05-18 20:23:31'),
(943, 'kyle', 'Product Americano updated', '2024-05-18 20:34:05'),
(944, 'kyle', 'Product Americano updated', '2024-05-18 20:36:00'),
(945, 'kyle', 'Product Americano updated', '2024-05-18 20:42:18'),
(946, 'kyle', 'Product Americano updated', '2024-05-18 20:43:23'),
(947, 'kyle', 'Product Americano updated', '2024-05-18 20:43:34'),
(948, 'kyle', 'Product Americano updated', '2024-05-18 21:35:19'),
(949, 'kyle', 'Product Americano updated', '2024-05-18 21:46:17'),
(950, 'kyle', 'Product Americano updated', '2024-05-18 22:01:16'),
(951, 'kyle', 'Product Americano updated', '2024-05-18 22:11:53'),
(952, 'kyle', 'Product Americano updated', '2024-05-19 08:09:49'),
(953, 'kyle', 'Product Americano updated', '2024-05-19 08:25:12'),
(954, 'kyle', 'Product Americano updated', '2024-05-19 08:28:25'),
(955, 'kyle', 'Product Americano updated', '2024-05-19 08:32:48'),
(956, 'kyle', 'Product Americano updated', '2024-05-19 08:35:44'),
(957, 'kyle', 'Product Americano updated', '2024-05-19 08:47:43'),
(958, 'kyle', 'Product Americano updated', '2024-05-19 08:52:00'),
(959, 'kyle', 'Product Americano updated', '2024-05-19 09:10:11'),
(960, 'kyle', 'Product Americano updated', '2024-05-19 09:10:22'),
(961, 'kyle', 'Product Americano updated', '2024-05-19 09:13:43'),
(962, 'kyle', 'Product Americano updated', '2024-05-19 09:37:12'),
(963, 'kyle', 'Product Americano updated', '2024-05-19 09:37:59'),
(964, 'kyle', 'Product Americano updated', '2024-05-19 09:41:00'),
(965, 'kyle', 'Product Americano updated', '2024-05-19 09:46:20'),
(966, 'kyle', 'User kyle logout', '2024-05-19 13:09:47'),
(967, 'kyle', 'User kyle login', '2024-05-19 13:09:55'),
(968, 'kyle', 'Product sold', '2024-05-19 13:34:04'),
(969, 'kyle', 'Product sold', '2024-05-19 13:54:00'),
(970, 'kyle', 'Product sold', '2024-05-19 13:59:22'),
(971, 'kyle', 'Product sold', '2024-05-19 14:26:06'),
(972, 'kyle', 'Product sold', '2024-05-19 14:44:50'),
(973, 'kyle', 'Product sold', '2024-05-19 14:45:36'),
(974, 'kyle', 'User kyle logout', '2024-05-19 17:58:52'),
(975, 'user', 'User user login', '2024-05-19 17:58:59'),
(976, 'user', 'User user logout', '2024-05-19 18:02:36'),
(977, 'user', 'User user login', '2024-05-19 18:02:43'),
(978, 'user', 'Product sold', '2024-05-19 18:05:59'),
(979, 'user', 'User user logout', '2024-05-19 18:10:51'),
(980, 'kyle', 'User kyle login', '2024-05-19 18:10:59'),
(981, 'kyle', 'User kyle logout', '2024-05-19 18:52:53'),
(982, 'user', 'User user login', '2024-05-19 18:52:59'),
(983, 'user', 'User user logout', '2024-05-19 18:55:20'),
(984, 'kyle', 'User kyle login', '2024-05-19 18:55:34'),
(985, 'kyle', 'User kyle logout', '2024-05-19 19:08:34'),
(986, 'user', 'User user login', '2024-05-19 19:08:42'),
(987, 'user', 'Product sold', '2024-05-19 19:15:36'),
(988, 'user', 'User user logout', '2024-05-19 19:15:52'),
(989, 'kyle', 'User kyle login', '2024-05-19 19:16:02'),
(990, 'kyle', 'Product sold', '2024-05-20 07:08:29'),
(991, 'kyle', 'Product sold', '2024-05-20 07:09:41'),
(992, 'kyle', 'Product sold', '2024-05-20 07:19:26'),
(993, 'kyle', 'Product sold', '2024-05-20 07:33:49'),
(994, 'kyle', 'User kyle logout', '2024-05-20 07:35:17'),
(995, 'user', 'User user login', '2024-05-20 07:35:25'),
(996, 'user', 'Product sold', '2024-05-20 07:35:34'),
(997, 'user', 'Product sold', '2024-05-20 07:41:48'),
(998, 'user', 'Product sold', '2024-05-20 07:42:03'),
(999, 'user', 'Product sold', '2024-05-20 13:57:10'),
(1000, 'user', 'Product sold', '2024-05-20 13:57:26'),
(1001, 'user', 'User user logout', '2024-05-20 14:09:10'),
(1002, 'user', 'User user login', '2024-05-20 14:09:22'),
(1003, 'user', 'User user logout', '2024-05-20 14:09:25'),
(1004, 'kyle', 'User kyle login', '2024-05-20 14:09:33'),
(1005, 'kyle', 'Product sold', '2024-05-20 22:35:37'),
(1006, 'kyle', 'User kyle logout', '2024-05-20 22:46:59'),
(1007, 'user', 'User user login', '2024-05-20 22:47:06'),
(1008, 'user', 'Product sold', '2024-05-20 23:10:21'),
(1009, 'user', 'Product sold', '2024-05-20 23:12:54'),
(1010, 'user', 'Product sold', '2024-05-20 23:14:27'),
(1011, 'user', 'User user logout', '2024-05-20 23:37:03'),
(1012, 'kyle', 'User kyle login', '2024-05-20 23:37:22'),
(1013, 'kyle', 'User kyle login', '2024-05-21 05:21:09'),
(1014, 'kyle', 'User kyle logout', '2024-05-21 07:02:56'),
(1015, 'user', 'User user login', '2024-05-21 07:03:04'),
(1016, 'user', 'User user logout', '2024-05-21 07:29:27'),
(1017, 'user', 'User user login', '2024-05-21 07:43:34'),
(1018, 'user', 'User user logout', '2024-05-21 07:46:27'),
(1019, 'kyle', 'User kyle login', '2024-05-21 07:46:39'),
(1020, 'kyle', 'Product Espresso updated', '2024-05-21 08:03:06'),
(1021, 'kyle', 'Product Cappuccino updated', '2024-05-21 08:05:30'),
(1022, 'kyle', 'Product Latte updated', '2024-05-21 08:07:29'),
(1023, 'kyle', 'Product Americano updated', '2024-05-21 08:08:05'),
(1024, 'kyle', 'Product Mocha updated', '2024-05-21 08:09:52'),
(1025, 'kyle', 'Product Cappuccino updated', '2024-05-21 08:13:46'),
(1026, 'kyle', 'Product Macchiato updated', '2024-05-21 08:16:26'),
(1027, 'kyle', 'Product Flat White updated', '2024-05-21 08:17:32'),
(1028, 'kyle', 'Product Affogato updated', '2024-05-21 08:18:31'),
(1029, 'kyle', 'Product Turkish Coffee updated', '2024-05-21 08:19:40'),
(1030, 'kyle', 'Product Irish Coffee updated', '2024-05-21 08:21:13'),
(1031, 'kyle', 'User kyle logout', '2024-05-21 08:21:29'),
(1032, 'user', 'User user login', '2024-05-21 08:21:40'),
(1033, 'user', 'User user logout', '2024-05-21 09:06:08'),
(1034, 'kyle', 'User kyle login', '2024-05-21 09:06:18'),
(1035, 'kyle', 'User kyle logout', '2024-05-21 12:59:45'),
(1036, 'user', 'User user login', '2024-05-21 13:00:02'),
(1037, 'user', 'User user logout', '2024-05-21 13:01:31'),
(1038, 'kyle', 'User kyle login', '2024-05-21 14:56:11'),
(1039, 'kyle', 'User kyle logout', '2024-05-21 15:20:16'),
(1040, 'user', 'User user login', '2024-05-21 15:20:24'),
(1041, 'user', 'User user logout', '2024-05-21 16:04:50'),
(1042, 'user', 'User user login', '2024-05-21 16:06:31'),
(1043, 'user', 'Product sold', '2024-05-21 16:07:08'),
(1044, 'user', 'User user logout', '2024-05-21 16:08:58'),
(1045, 'kyle', 'User kyle login', '2024-05-21 16:09:09'),
(1046, 'kyle', 'User kyle logout', '2024-05-21 18:01:22'),
(1047, 'user', 'User user login', '2024-05-21 18:01:31'),
(1048, 'user', 'User user logout', '2024-05-21 18:01:35'),
(1049, 'user', 'User user login', '2024-06-16 19:33:59'),
(1050, 'user', 'User user logout', '2024-06-16 19:34:32'),
(1051, 'kyle', 'User kyle login', '2024-06-16 19:34:44'),
(1052, 'kyle', 'Product sold', '2024-06-16 19:35:33'),
(1055, 'kyle', 'User kyle logout', '2024-09-12 21:37:57'),
(1056, 'admin', 'User admin login', '2024-09-12 21:39:57'),
(1057, 'user', 'User user login', '2024-09-12 21:43:48'),
(1058, 'user', 'User user logout', '2024-09-12 21:45:06'),
(1059, 'admin', 'User admin login', '2024-09-12 21:45:16'),
(1060, 'admin', 'User admin login', '2024-09-12 21:52:11'),
(1061, 'admin', 'User admin logout', '2024-09-12 21:52:41'),
(1062, 'admin', 'User admin login', '2024-09-12 21:53:15'),
(1063, 'admin', 'Product sold', '2024-09-12 22:03:38'),
(1064, 'admin', 'User admin logout', '2024-09-12 22:10:52'),
(1065, 'admin', 'User admin login', '2024-09-12 22:12:14'),
(1066, 'admin', 'Product sold', '2024-09-12 22:13:12');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_no` varchar(50) NOT NULL,
  `product_name` varchar(30) DEFAULT NULL,
  `sell_price` decimal(18,2) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `unit` varchar(30) DEFAULT NULL,
  `min_stocks` int(11) DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `location` varchar(50) DEFAULT NULL,
  `images` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_no`, `product_name`, `sell_price`, `quantity`, `unit`, `min_stocks`, `remarks`, `location`, `images`) VALUES
('1', 'Espresso', 115.00, 78, '12', 12, 'A concentrated coffee brewed by forcing a small amount of nearly boiling water through finely-ground coffee beans. Known for its rich flavor and crema on top.', 'Coffee Brothers Co. Polomolok', 'Americano.webp'),
('10000', 'Flat White', 115.00, 21, '12', 29, 'An espresso-based drink similar to a latte but with a higher coffee-to-milk ratio and a velvety microfoam texture.', 'Coffee Brothers Co. Polomolok', NULL),
('1001', 'Macchiato', 115.00, 100, '12', 20, ' A strong and flavorful coffee drink consisting of a shot of espresso \"stained\" with a small amount of milk foam.', 'Coffee Brothers Co. Polomolok', NULL),
('10011', 'Affogato', 115.00, 197, '12', 20, ' A delicious dessert-coffee combination where a scoop of vanilla ice cream is \"drowned\" in a shot of hot espresso.', 'Coffee Brothers Co. Polomolok', NULL),
('10012', 'Turkish Coffee', 115.00, 91, '12', 20, 'A traditional Middle Eastern coffee preparation where finely ground coffee is simmered with water (and optional sugar) in a special pot called a cezve.', 'Coffee Brothers Co. Polomolok', NULL),
('2', 'Cappuccino', 115.00, 199, '12', 10, 'A classic Italian coffee drink made with equal parts espresso, steamed milk, and milk foam, often enjoyed for its balanced flavor and creamy texture.', 'Coffee Brothers Co. Polomolok', NULL),
('23213', 'Irish Coffee', 115.00, 19, '12', 23, 'A classic cocktail combining hot coffee, Irish whiskey, and sugar, topped with a layer of thick cream, typically served in a glass.', 'Coffee Brothers Co. Polomolok', NULL),
('3', 'Latte', 115.00, 147, '11', 20, 'A smooth and creamy coffee beverage made with a shot of espresso and steamed milk, topped with a small amount of milk foam.', 'Coffee Brothers Co. Polomolok', NULL),
('4', 'Americano', 115.00, 122, '12', 20, 'A simple coffee drink made by diluting a shot of espresso with hot water, resulting in a coffee similar to drip but with a richer flavor.', 'Coffee Brothers Co. Polomolok', NULL),
('5', 'Mocha', 115.00, 99, '12', 10, 'A delightful blend of espresso, chocolate syrup, and steamed milk, often topped with whipped cream for a sweet and indulgent treat.', 'Coffee Brothers Co. Polomolok', NULL);

--
-- Triggers `products`
--
DELIMITER $$
CREATE TRIGGER `delete` BEFORE DELETE ON `products` FOR EACH ROW DELETE FROM initial_products WHERE id=old.product_no
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `insert` AFTER INSERT ON `products` FOR EACH ROW INSERT INTO initial_products(id,initial_quantity) VALUES(new.product_no,new.quantity)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `product_delivered`
--

CREATE TABLE `product_delivered` (
  `transaction_no` varchar(30) NOT NULL,
  `product_id` varchar(30) NOT NULL,
  `total_qty` int(11) NOT NULL,
  `buy_price` decimal(18,2) NOT NULL,
  `tax_rate` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `product_delivered`
--

INSERT INTO `product_delivered` (`transaction_no`, `product_id`, `total_qty`, `buy_price`, `tax_rate`) VALUES
('5CAAFDA8CD697', '1001', 100, 20.00, 10),
('5CAAFDEEDB333', '10011', 200, 500.00, 20),
('5CAAFDEEDB333', '10012', 100, 2000.00, 20),
('5CAAFE37D21E8', '1', 100, 10.00, 20),
('5CAAFE37D21E8', '2', 200, 20.00, 20),
('5CAAFE37D21E8', '3', 150, 6.00, 10),
('5CAAFE37D21E8', '4', 125, 15.00, 15),
('5CAAFE37D21E8', '5', 100, 10.00, 20),
('5E7F00084C934', '23213', 23, 32.00, 32),
('5E81DF2B7B8F7', '10000', 21, 21313.00, 20);

-- --------------------------------------------------------

--
-- Table structure for table `product_ingredients`
--

CREATE TABLE `product_ingredients` (
  `id` int(11) NOT NULL,
  `product_id` varchar(50) NOT NULL,
  `ingredient_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `product_ingredients`
--

INSERT INTO `product_ingredients` (`id`, `product_id`, `ingredient_id`, `quantity`) VALUES
(10, '1', 1, 18),
(11, '4', 1, 18),
(12, '3', 1, 18),
(13, '3', 4, 150),
(14, '5', 1, 18),
(15, '5', 3, 30),
(16, '5', 4, 150),
(17, '5', 9, 1),
(18, '2', 2, 18),
(19, '2', 4, 200);

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `reciept_no` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL DEFAULT 0,
  `username` varchar(30) NOT NULL,
  `discount` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`reciept_no`, `customer_id`, `username`, `discount`, `total`, `date`) VALUES
(20, 16, 'admin', 0, 0, '2019-04-08 07:56:39'),
(21, 16, 'admin', 0, 0, '2019-04-08 12:29:27'),
(22, 16, 'admin', 0, 0, '2020-03-28 06:06:26'),
(23, 16, 'admin', 0, 0, '2020-03-28 06:07:27'),
(24, 16, 'admin', 0, 0, '2020-03-28 06:08:08'),
(25, 16, 'admin', 10, 0, '2020-03-28 06:14:46'),
(26, 16, 'admin', 10, 0, '2020-03-28 06:22:55'),
(27, 16, 'admin', 10, 2160, '2020-03-28 06:27:51'),
(28, 16, 'admin', 20, 1920, '2020-03-28 08:14:30'),
(29, 16, 'admin', 20, 4017, '2020-03-30 01:07:10'),
(30, 12, 'kyle', 0, 115, '2024-05-14 19:22:41'),
(31, 12, 'kyle', 0, 12, '2024-05-19 05:34:04'),
(32, 12, 'kyle', 0, 114, '2024-05-19 05:54:00'),
(33, 12, 'kyle', 0, 114, '2024-05-19 05:59:22'),
(34, 12, 'kyle', 0, 114, '2024-05-19 06:26:06'),
(35, 12, 'kyle', 0, 114, '2024-05-19 06:44:50'),
(36, 12, 'kyle', 0, 228, '2024-05-19 06:45:36'),
(37, 12, 'user', 0, 114, '2024-05-19 10:05:59'),
(38, 12, 'user', 0, 114, '2024-05-19 11:15:36'),
(39, 12, 'kyle', 0, 114, '2024-05-19 23:08:29'),
(40, 12, 'kyle', 0, 114, '2024-05-19 23:09:41'),
(41, 12, 'kyle', 0, 114, '2024-05-19 23:19:26'),
(42, 12, 'kyle', 0, 114, '2024-05-19 23:33:49'),
(43, 12, 'user', 0, 114, '2024-05-19 23:35:34'),
(44, 12, 'user', 0, 114, '2024-05-19 23:41:48'),
(45, 12, 'user', 0, 7, '2024-05-19 23:42:03'),
(46, 12, 'user', 0, 114, '2024-05-20 05:57:10'),
(47, 12, 'user', 0, 114, '2024-05-20 05:57:26'),
(48, 12, 'kyle', 0, 228, '2024-05-20 14:35:37'),
(49, 12, 'user', 0, 114, '2024-05-20 15:10:21'),
(50, 12, 'user', 0, 114, '2024-05-20 15:12:54'),
(51, 12, 'user', 0, 2400, '2024-05-20 15:14:27'),
(52, 12, 'user', 0, 115, '2024-05-21 08:07:08'),
(53, 12, 'kyle', 0, 115, '2024-06-16 11:35:33'),
(54, 12, 'admin', 0, 115, '2024-09-12 14:03:38'),
(55, 12, 'admin', 0, 115, '2024-09-12 14:13:12');

-- --------------------------------------------------------

--
-- Table structure for table `sales_product`
--

CREATE TABLE `sales_product` (
  `reciept_no` int(11) NOT NULL,
  `product_id` varchar(20) NOT NULL,
  `price` decimal(18,2) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `sales_product`
--

INSERT INTO `sales_product` (`reciept_no`, `product_id`, `price`, `qty`) VALUES
(20, '1', 12.00, 10),
(20, '10011', 600.00, 2),
(21, '1', 12.00, 20),
(22, '10012', 2400.00, 1),
(23, '3', 6.60, 2),
(24, '10012', 2400.00, 1),
(25, '10012', 2400.00, 1),
(26, '10012', 2400.00, 1),
(27, '10012', 2400.00, 1),
(28, '10012', 2400.00, 1),
(29, '10012', 2400.00, 2),
(29, '4', 17.25, 3),
(29, '23213', 42.24, 4),
(30, '1', 115.00, 1),
(31, '5', 12.00, 1),
(32, '1', 114.00, 1),
(33, '1', 114.00, 1),
(34, '1', 114.00, 1),
(35, '1', 114.00, 1),
(36, '1', 114.00, 2),
(37, '1', 114.00, 1),
(38, '1', 114.00, 1),
(40, '1', 114.00, 1),
(41, '1', 114.00, 1),
(42, '1', 114.00, 1),
(43, '1', 114.00, 1),
(44, '1', 114.00, 1),
(45, '3', 6.60, 1),
(46, '1', 114.00, 1),
(47, '1', 114.00, 1),
(48, '1', 114.00, 2),
(49, '1', 114.00, 1),
(50, '1', 114.00, 1),
(51, '10012', 2400.00, 1),
(52, '2', 115.00, 1),
(53, '10011', 115.00, 1),
(54, '1', 115.00, 1),
(55, '1', 115.00, 1);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `supplier_id` int(11) NOT NULL,
  `company_name` varchar(30) DEFAULT NULL,
  `firstname` varchar(30) DEFAULT NULL,
  `lastname` varchar(30) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `contact_number` varchar(30) DEFAULT NULL,
  `image` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`supplier_id`, `company_name`, `firstname`, `lastname`, `address`, `contact_number`, `image`) VALUES
(21, 'OrangeCompany', 'Oracle', 'LTD', 'USA', '+63(09)1234-1234', 'Internship-Web-Graphic-01.png'),
(22, 'BrandName', 'Bill', 'Joe', 'Africa', '+63(09)1234-1234', 'multi-user-icon.png');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `position` varchar(20) NOT NULL,
  `contact_number` varchar(30) NOT NULL,
  `image` varchar(30) NOT NULL,
  `password` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `firstname`, `lastname`, `position`, `contact_number`, `image`, `password`) VALUES
(7, 'admin', 'Juan', 'Cruz', 'Admin', '+63(09)1234-1234', 'Myprofile.jpg', '21232f297a57a5a743894a0e4a801fc3'),
(13, 'user', 'Chris', 'Doe', 'Employee', '+63(09)1234-1234', 'men-in-black.png', 'ee11cbb19052e40b07aac0ca060c23ee'),
(15, 'kyle', 'Adrian', 'Kyle', 'Admin', '+63(09)1234-1234', '1689082473963.jpg', '49c9ca966b737f1a1a616a4ee4d2f210');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cashflow`
--
ALTER TABLE `cashflow`
  ADD PRIMARY KEY (`transaction_id`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `delivery`
--
ALTER TABLE `delivery`
  ADD PRIMARY KEY (`transaction_no`),
  ADD KEY `supplier_id` (`supplier_id`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `ingredients`
--
ALTER TABLE `ingredients`
  ADD PRIMARY KEY (`ingredient_id`);

--
-- Indexes for table `initial_products`
--
ALTER TABLE `initial_products`
  ADD KEY `id` (`id`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_no`);

--
-- Indexes for table `product_delivered`
--
ALTER TABLE `product_delivered`
  ADD KEY `product_id` (`product_id`),
  ADD KEY `transaction_no` (`transaction_no`);

--
-- Indexes for table `product_ingredients`
--
ALTER TABLE `product_ingredients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `ingredient_id` (`ingredient_id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`reciept_no`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `sales_product`
--
ALTER TABLE `sales_product`
  ADD KEY `product_id` (`product_id`),
  ADD KEY `reciept_no` (`reciept_no`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`supplier_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD UNIQUE KEY `user_id` (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cashflow`
--
ALTER TABLE `cashflow`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `ingredients`
--
ALTER TABLE `ingredients`
  MODIFY `ingredient_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1067;

--
-- AUTO_INCREMENT for table `product_ingredients`
--
ALTER TABLE `product_ingredients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `reciept_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `sales_product`
--
ALTER TABLE `sales_product`
  MODIFY `reciept_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `supplier_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cashflow`
--
ALTER TABLE `cashflow`
  ADD CONSTRAINT `cashflow_ibfk_1` FOREIGN KEY (`username`) REFERENCES `users` (`username`);

--
-- Constraints for table `delivery`
--
ALTER TABLE `delivery`
  ADD CONSTRAINT `delivery_ibfk_1` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`supplier_id`),
  ADD CONSTRAINT `delivery_ibfk_2` FOREIGN KEY (`username`) REFERENCES `users` (`username`);

--
-- Constraints for table `initial_products`
--
ALTER TABLE `initial_products`
  ADD CONSTRAINT `initial_products_ibfk_1` FOREIGN KEY (`id`) REFERENCES `products` (`product_no`);

--
-- Constraints for table `logs`
--
ALTER TABLE `logs`
  ADD CONSTRAINT `logs_ibfk_1` FOREIGN KEY (`username`) REFERENCES `users` (`username`);

--
-- Constraints for table `product_delivered`
--
ALTER TABLE `product_delivered`
  ADD CONSTRAINT `product_delivered_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_no`),
  ADD CONSTRAINT `product_delivered_ibfk_2` FOREIGN KEY (`transaction_no`) REFERENCES `delivery` (`transaction_no`);

--
-- Constraints for table `product_ingredients`
--
ALTER TABLE `product_ingredients`
  ADD CONSTRAINT `product_ingredients_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_no`),
  ADD CONSTRAINT `product_ingredients_ibfk_2` FOREIGN KEY (`ingredient_id`) REFERENCES `ingredients` (`ingredient_id`);

--
-- Constraints for table `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `sales_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`),
  ADD CONSTRAINT `sales_ibfk_3` FOREIGN KEY (`username`) REFERENCES `users` (`username`);

--
-- Constraints for table `sales_product`
--
ALTER TABLE `sales_product`
  ADD CONSTRAINT `sales_product_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_no`),
  ADD CONSTRAINT `sales_product_ibfk_3` FOREIGN KEY (`reciept_no`) REFERENCES `sales` (`reciept_no`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
