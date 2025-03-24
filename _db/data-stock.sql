-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 24, 2025 at 09:55 AM
-- Server version: 8.0.30
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `data-stock`
--

-- --------------------------------------------------------

--
-- Table structure for table `equipment`
--

CREATE TABLE `equipment` (
  `id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `stock` int NOT NULL DEFAULT '0',
  `low_stock_level` int DEFAULT '10',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `equipment`
--

INSERT INTO `equipment` (`id`, `name`, `stock`, `low_stock_level`, `created_at`) VALUES
(1, 'ปากกา', 18, 5, '2025-03-24 03:58:39'),
(2, 'กระดาษ A4', 10, 5, '2025-03-24 03:58:39'),
(3, 'ที่เย็บกระดาษ', 55, 5, '2025-03-24 03:58:39'),
(4, 'หมึกพิมพ์', 3, 5, '2025-03-24 03:58:39'),
(5, 'คลิปหนีบกระดาษ', 8, 5, '2025-03-24 03:58:39');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_order`
--

CREATE TABLE `purchase_order` (
  `id` int NOT NULL,
  `equipment_id` int NOT NULL,
  `quantity` int NOT NULL,
  `status` enum('pending','ordered','received') DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `ordered_at` timestamp NULL DEFAULT NULL,
  `received_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `requisition`
--

CREATE TABLE `requisition` (
  `id` int NOT NULL,
  `equipment_id` int NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `quantity` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `approved_by` varchar(100) DEFAULT NULL,
  `approved_at` timestamp NULL DEFAULT NULL,
  `status_id` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `requisition`
--

INSERT INTO `requisition` (`id`, `equipment_id`, `user_name`, `quantity`, `created_at`, `approved_by`, `approved_at`, `status_id`) VALUES
(9, 2, 'Sam', 1, '2025-03-24 08:32:26', 'Admin', '2025-03-24 09:54:22', 2),
(10, 1, 'Sam', 1, '2025-03-24 09:26:07', NULL, NULL, 4),
(11, 1, 'Sam', 1, '2025-03-24 09:26:57', 'Admin', '2025-03-24 09:51:42', 2),
(12, 2, 'Sam', 2, '2025-03-24 09:27:24', NULL, NULL, 4);

-- --------------------------------------------------------

--
-- Table structure for table `requisition_status`
--

CREATE TABLE `requisition_status` (
  `id` int NOT NULL,
  `code` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `is_active` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `requisition_status`
--

INSERT INTO `requisition_status` (`id`, `code`, `name`, `is_active`) VALUES
(1, 'pending', 'รออนุมัติ', 1),
(2, 'approved', 'อนุมัติแล้ว', 1),
(3, 'rejected', 'ปฏิเสธ', 1),
(4, 'cancel', 'ยกเลิก', 1);

-- --------------------------------------------------------

--
-- Table structure for table `stock_history`
--

CREATE TABLE `stock_history` (
  `id` int NOT NULL,
  `equipment_id` int NOT NULL,
  `quantity_change` int NOT NULL,
  `reason` varchar(255) DEFAULT NULL,
  `updated_by` varchar(100) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `stock_history`
--

INSERT INTO `stock_history` (`id`, `equipment_id`, `quantity_change`, `reason`, `updated_by`, `updated_at`) VALUES
(1, 2, 5, 'ทดสอบ', 'nfc0268', '2025-03-24 08:23:48'),
(2, 5, 8, NULL, 'nfc0268', '2025-03-24 08:25:19'),
(3, 3, 55, NULL, 'nfc0268', '2025-03-24 09:20:59'),
(4, 1, 20, NULL, 'nfc0268', '2025-03-24 09:21:05'),
(5, 4, 3, NULL, 'nfc0268', '2025-03-24 09:21:11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `equipment`
--
ALTER TABLE `equipment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_order`
--
ALTER TABLE `purchase_order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `equipment_id` (`equipment_id`);

--
-- Indexes for table `requisition`
--
ALTER TABLE `requisition`
  ADD PRIMARY KEY (`id`),
  ADD KEY `equipment_id` (`equipment_id`),
  ADD KEY `status_id` (`status_id`);

--
-- Indexes for table `requisition_status`
--
ALTER TABLE `requisition_status`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Indexes for table `stock_history`
--
ALTER TABLE `stock_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `equipment_id` (`equipment_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `equipment`
--
ALTER TABLE `equipment`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `purchase_order`
--
ALTER TABLE `purchase_order`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `requisition`
--
ALTER TABLE `requisition`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `requisition_status`
--
ALTER TABLE `requisition_status`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `stock_history`
--
ALTER TABLE `stock_history`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `purchase_order`
--
ALTER TABLE `purchase_order`
  ADD CONSTRAINT `purchase_order_ibfk_1` FOREIGN KEY (`equipment_id`) REFERENCES `equipment` (`id`);

--
-- Constraints for table `requisition`
--
ALTER TABLE `requisition`
  ADD CONSTRAINT `requisition_ibfk_1` FOREIGN KEY (`equipment_id`) REFERENCES `equipment` (`id`),
  ADD CONSTRAINT `requisition_ibfk_2` FOREIGN KEY (`status_id`) REFERENCES `requisition_status` (`id`);

--
-- Constraints for table `stock_history`
--
ALTER TABLE `stock_history`
  ADD CONSTRAINT `stock_history_ibfk_1` FOREIGN KEY (`equipment_id`) REFERENCES `equipment` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
