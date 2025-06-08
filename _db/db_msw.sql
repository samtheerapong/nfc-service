-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 08, 2025 at 07:47 AM
-- Server version: 5.7.33
-- PHP Version: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_msw`
--

-- --------------------------------------------------------

--
-- Table structure for table `budget`
--

CREATE TABLE `budget` (
  `id` int(11) NOT NULL,
  `fiscal_year` year(4) NOT NULL,
  `project_name` varchar(255) NOT NULL,
  `description` text,
  `total_amount` decimal(12,2) NOT NULL DEFAULT '0.00',
  `created_by` int(11) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `budget`
--

INSERT INTO `budget` (`id`, `fiscal_year`, `project_name`, `description`, `total_amount`, `created_by`, `created_at`, `updated_at`, `status`) VALUES
(1, '2025', 'โครงการพัฒนานักเรียน', NULL, 500000.00, 1, '2025-06-08 13:30:19', '2025-06-08 14:29:29', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `budget_item`
--

CREATE TABLE `budget_item` (
  `id` int(11) NOT NULL,
  `budget_id` int(11) NOT NULL,
  `category` varchar(100) NOT NULL,
  `sub_category` varchar(100) DEFAULT NULL,
  `amount_allocated` decimal(12,2) NOT NULL DEFAULT '0.00',
  `amount_used` decimal(12,2) NOT NULL DEFAULT '0.00',
  `note` text,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `budget_item`
--

INSERT INTO `budget_item` (`id`, `budget_id`, `category`, `sub_category`, `amount_allocated`, `amount_used`, `note`, `created_at`, `updated_at`) VALUES
(1, 1, 'บุคลากร', 'ค่าเบี้ยเลี้ยง', 200000.00, 0.00, NULL, '2025-06-08 13:30:19', '2025-06-08 13:30:19'),
(2, 1, 'กิจกรรม', 'ค่ายอบรม', 150000.00, 0.00, NULL, '2025-06-08 13:30:19', '2025-06-08 13:30:19'),
(3, 1, 'วัสดุ', 'อุปกรณ์การเรียน', 150000.00, 0.00, NULL, '2025-06-08 13:30:19', '2025-06-08 13:30:19'),
(4, 1, 'อุปกรณ์', NULL, 10000.00, 0.00, NULL, '2025-06-08 14:41:32', '2025-06-08 14:41:32');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `budget`
--
ALTER TABLE `budget`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`);

--
-- Indexes for table `budget_item`
--
ALTER TABLE `budget_item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `budget_id` (`budget_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `budget`
--
ALTER TABLE `budget`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `budget_item`
--
ALTER TABLE `budget_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `budget`
--
ALTER TABLE `budget`
  ADD CONSTRAINT `budget_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`);

--
-- Constraints for table `budget_item`
--
ALTER TABLE `budget_item`
  ADD CONSTRAINT `budget_item_ibfk_1` FOREIGN KEY (`budget_id`) REFERENCES `budget` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
