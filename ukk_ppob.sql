-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 02, 2019 at 10:44 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ukk_ppob`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `getLevel` ()  NO SQL
    COMMENT 'get data level'
SELECT * FROM level$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_level` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `username`, `password`, `id_level`, `created_at`, `updated_at`) VALUES
(1, 'Alfian', 'alfian', '$2y$10$dpVGbPhUBQZWC/zE6gFKjOx/4OxK1j0wZY5d.JTSkKfOUgoc9uB.K', 1, '2019-03-31 17:00:00', '2019-04-01 17:00:00'),
(2, 'Scarlet', 'scarlet', '$2y$10$lw8KdoXAojFvZj5t7bd9Xu.hhKmBWJUvK6BVET68jY9jNYYXBVqJG', 2, '2019-03-31 17:00:00', '2019-04-01 17:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `bill`
--

CREATE TABLE `bill` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_usage` int(10) UNSIGNED NOT NULL,
  `month` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `year` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_meter` double(8,2) NOT NULL,
  `status` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bill`
--

INSERT INTO `bill` (`id`, `id_usage`, `month`, `year`, `total_meter`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, '1', '2019', 10.00, 'r', '2019-04-02 00:45:16', '2019-04-02 01:22:47'),
(2, 2, '2', '2019', 20.00, 'p', '2019-04-02 00:45:27', '2019-04-02 01:26:41'),
(3, 3, '1', '2019', 10.00, 'n', '2019-04-02 00:45:39', '2019-04-02 00:45:39'),
(4, 4, '2', '2019', 20.00, 'n', '2019-04-02 00:45:49', '2019-04-02 00:45:49'),
(5, 5, '3', '2019', 40.00, 'n', '2019-04-02 01:27:00', '2019-04-02 01:27:00');

-- --------------------------------------------------------

--
-- Table structure for table `cost`
--

CREATE TABLE `cost` (
  `id` int(10) UNSIGNED NOT NULL,
  `power` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cost` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cost`
--

INSERT INTO `cost` (`id`, `power`, `cost`, `created_at`, `updated_at`) VALUES
(1, '450', 900.00, '2019-04-02 00:44:04', '2019-04-02 00:44:04'),
(2, '900', 1800.00, '2019-04-02 00:44:11', '2019-04-02 00:44:11'),
(3, '3600', 7600.00, '2019-04-02 00:44:22', '2019-04-02 00:44:22');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kwh_number` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_cost` int(10) UNSIGNED NOT NULL,
  `status` enum('delete','active') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `name`, `username`, `password`, `kwh_number`, `address`, `id_cost`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Dimas', 'dimas', '$2y$10$Z3msOCWcNMRzXK509Z4nk.bOtrkszOp0MMmMKVsGIPIA1YrxQS9iy', '20020708', 'Kepanjen', 1, 'active', '2019-04-02 00:44:44', '2019-04-02 00:44:44'),
(2, 'Sugara', 'sugara', '$2y$10$vKgufPaaDwHpM7E6N0ggr.tDST6zUaJRgcTEdF/8rks0jhh2na60a', '20020709', 'Kepanjen', 2, 'active', '2019-04-02 00:45:03', '2019-04-02 00:45:03');

-- --------------------------------------------------------

--
-- Table structure for table `level`
--

CREATE TABLE `level` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `level`
--

INSERT INTO `level` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Manager', '2019-03-31 18:03:02', '2019-03-31 18:03:02'),
(2, 'Teller', '2019-03-31 21:06:06', '2019-03-31 20:06:26');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2019_04_01_002715_create_levels_table', 1),
(2, '2019_04_01_002724_create_costs_table', 1),
(3, '2019_04_01_002728_create_customers_table', 1),
(4, '2019_04_01_002732_create_usages_table', 1),
(5, '2019_04_01_002743_create_bills_table', 1),
(6, '2019_04_01_002748_create_admins_table', 1),
(7, '2019_04_01_002749_create_payments_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `month`
--

CREATE TABLE `month` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `month`
--

INSERT INTO `month` (`id`, `name`) VALUES
(1, 'Januari'),
(2, 'Februari'),
(3, 'Maret'),
(4, 'April'),
(5, 'Mei'),
(6, 'Juni'),
(7, 'Juli'),
(8, 'Agustus'),
(9, 'September'),
(10, 'Oktober'),
(11, 'November'),
(12, 'Desember');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_bill` int(10) UNSIGNED NOT NULL,
  `date_pay` date NOT NULL,
  `month` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `year` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cost_admin` int(11) NOT NULL,
  `total_pay` int(11) NOT NULL,
  `status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_admin` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `id_bill`, `date_pay`, `month`, `year`, `cost_admin`, `total_pay`, `status`, `image`, `id_admin`, `created_at`, `updated_at`) VALUES
(1, 2, '2019-04-02', '2', '2019', 5000, 23000, 'p', '1554193601-siap.jpg', 2, '2019-04-02 00:47:13', '2019-04-02 01:26:41'),
(2, 1, '2019-04-02', '1', '2019', 5000, 14000, 'r', '1554191242-ashiaaaaaaaaaaaaaaaaaaaaaaaaaaappppppppppp.jpg', 2, '2019-04-02 00:47:22', '2019-04-02 01:22:47');

-- --------------------------------------------------------

--
-- Table structure for table `usage`
--

CREATE TABLE `usage` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_customer` int(10) UNSIGNED NOT NULL,
  `month` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `year` year(4) NOT NULL,
  `start_meter` int(10) NOT NULL,
  `finish_meter` int(10) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `usage`
--

INSERT INTO `usage` (`id`, `id_customer`, `month`, `year`, `start_meter`, `finish_meter`, `created_at`, `updated_at`) VALUES
(1, 1, '1', 2019, 10, 20, '2019-04-02 00:45:16', '2019-04-02 00:45:16'),
(2, 1, '2', 2019, 20, 40, '2019-04-02 00:45:27', '2019-04-02 00:45:27'),
(3, 2, '1', 2019, 10, 20, '2019-04-02 00:45:39', '2019-04-02 00:45:39'),
(4, 2, '2', 2019, 20, 40, '2019-04-02 00:45:49', '2019-04-02 00:45:49'),
(5, 1, '3', 2019, 40, 80, '2019-04-02 01:27:00', '2019-04-02 01:27:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admin_id_unique` (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `admin_id_level_index` (`id_level`);

--
-- Indexes for table `bill`
--
ALTER TABLE `bill`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `bill_id_unique` (`id`),
  ADD KEY `bill_id_usage_index` (`id_usage`);

--
-- Indexes for table `cost`
--
ALTER TABLE `cost`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `customer_id_unique` (`id`),
  ADD KEY `customer_id_cost_index` (`id_cost`);

--
-- Indexes for table `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `level_id_unique` (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `month`
--
ALTER TABLE `month`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payments_id_bill_index` (`id_bill`),
  ADD KEY `payments_id_admin_index` (`id_admin`);

--
-- Indexes for table `usage`
--
ALTER TABLE `usage`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usage_id_unique` (`id`),
  ADD KEY `usage_id_customer_index` (`id_customer`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `bill`
--
ALTER TABLE `bill`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `cost`
--
ALTER TABLE `cost`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `level`
--
ALTER TABLE `level`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `month`
--
ALTER TABLE `month`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `usage`
--
ALTER TABLE `usage`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_id_level_foreign` FOREIGN KEY (`id_level`) REFERENCES `level` (`id`);

--
-- Constraints for table `bill`
--
ALTER TABLE `bill`
  ADD CONSTRAINT `bill_id_usage_foreign` FOREIGN KEY (`id_usage`) REFERENCES `usage` (`id`);

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `customer_id_cost_foreign` FOREIGN KEY (`id_cost`) REFERENCES `cost` (`id`);

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_id_admin_foreign` FOREIGN KEY (`id_admin`) REFERENCES `admin` (`id`),
  ADD CONSTRAINT `payments_id_bill_foreign` FOREIGN KEY (`id_bill`) REFERENCES `bill` (`id`);

--
-- Constraints for table `usage`
--
ALTER TABLE `usage`
  ADD CONSTRAINT `usage_id_customer_foreign` FOREIGN KEY (`id_customer`) REFERENCES `customer` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
