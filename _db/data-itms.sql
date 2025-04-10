-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 10, 2025 at 09:57 AM
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
-- Database: `data-itms`
--

-- --------------------------------------------------------

--
-- Table structure for table `accessories`
--

CREATE TABLE `accessories` (
  `id` int NOT NULL,
  `computer_id` int NOT NULL,
  `asset_code` varchar(45) DEFAULT NULL,
  `type_id` int DEFAULT NULL,
  `accessory_name` varchar(100) NOT NULL COMMENT 'ส่วนประกอบ',
  `brand` varchar(100) DEFAULT NULL COMMENT 'ยี่ห้อ',
  `model` varchar(100) DEFAULT NULL COMMENT 'รุ่น',
  `serial_number` varchar(100) DEFAULT NULL COMMENT 'S/N',
  `purchase_date` varchar(45) DEFAULT NULL COMMENT 'วันที่ซื้อ',
  `warranty_expiry` varchar(45) DEFAULT NULL COMMENT 'วันที่หมดประกัน',
  `created_at` varchar(45) DEFAULT NULL,
  `updated_at` varchar(45) DEFAULT NULL,
  `status_id` int DEFAULT '1' COMMENT 'รหัสสินทรัพย์',
  `ref_code` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `accessories`
--

INSERT INTO `accessories` (`id`, `computer_id`, `asset_code`, `type_id`, `accessory_name`, `brand`, `model`, `serial_number`, `purchase_date`, `warranty_expiry`, `created_at`, `updated_at`, `status_id`, `ref_code`) VALUES
(1, 1, NULL, NULL, 'Mouse', 'Logitech', 'M510', 'SN-MOUSE-001', '2023-01-01', '2025-01-01', '2025-02-22 09:04:47', '2025-02-22 09:04:47', 1, NULL),
(2, 1, NULL, NULL, 'Keyboard', 'Dell', 'KB216', 'SN-KB-001', '2023-01-01', '2025-01-01', '2025-02-22 09:04:47', '2025-02-22 09:04:47', 1, NULL),
(3, 2, NULL, NULL, 'External HDD', 'Seagate', 'Backup Plus', 'SN-HDD-002', '2022-06-15', '2024-06-15', '2025-02-22 09:04:47', '2025-02-22 09:04:47', 1, NULL),
(4, 3, NULL, NULL, 'Monitor', 'HP', 'Pavilion 27', 'SN-MON-003', '2023-03-01', '2026-03-01', '2025-02-22 09:04:47', '2025-02-22 09:04:47', 1, NULL),
(5, 4, NULL, NULL, 'Docking Station', 'ThinkPad', 'Ultra Dock', 'SN-DOCK-004', '2020-11-20', '2023-11-20', '2025-02-22 09:04:47', '2025-02-22 09:04:47', 1, NULL),
(6, 5, NULL, NULL, 'Headset', 'Jabra', 'Evolve2 65', 'SN-HSET-005', '2022-05-10', '2025-05-10', '2025-02-22 09:04:47', '2025-02-22 09:04:47', 1, NULL),
(7, 6, NULL, NULL, 'Printer', 'Canon', 'PIXMA G6020', 'SN-PRNT-006', '2021-09-30', '2024-09-30', '2025-02-22 09:04:47', '2025-02-22 09:04:47', 1, NULL),
(8, 7, NULL, NULL, 'Webcam', 'Logitech', 'C920', 'SN-WCAM-007', '2020-12-25', '2023-12-25', '2025-02-22 09:04:47', '2025-02-22 09:04:47', 1, NULL),
(9, 8, NULL, NULL, 'UPS', 'APC', 'Back-UPS BX1100', 'SN-UPS-008', '2019-08-15', '2022-08-15', '2025-02-22 09:04:47', '2025-02-22 09:04:47', 1, NULL),
(10, 9, NULL, NULL, 'VR Headset', 'Oculus', 'Rift S', 'SN-VR-009', '2021-10-05', '2024-10-05', '2025-02-22 09:04:47', '2025-02-22 09:04:47', 1, NULL),
(11, 10, NULL, NULL, 'Gaming Mouse', 'Razer', 'DeathAdder V2', 'SN-GM-010', '2023-01-01', '2026-01-01', '2025-02-22 09:04:47', '2025-02-22 09:04:47', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `accessory_types`
--

CREATE TABLE `accessory_types` (
  `id` int NOT NULL,
  `name` varchar(45) NOT NULL,
  `description` text,
  `color` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `accessory_types`
--

INSERT INTO `accessory_types` (`id`, `name`, `description`, `color`) VALUES
(1, 'CPU', NULL, '#FF5733'),
(2, 'RAM', NULL, '#33FF57'),
(3, 'HDD 3.5', NULL, '#3357FF'),
(4, 'HDD 2.5', NULL, '#FF33A1'),
(5, 'SSD SATA', NULL, '#57FF33'),
(6, 'SSD M2', NULL, '#FF8C33'),
(7, 'VGA CARD', NULL, '#8C33FF');

-- --------------------------------------------------------

--
-- Table structure for table `auto_number`
--

CREATE TABLE `auto_number` (
  `group` varchar(32) NOT NULL,
  `number` int DEFAULT NULL,
  `optimistic_lock` int DEFAULT NULL,
  `update_time` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `auto_number`
--

INSERT INTO `auto_number` (`group`, `number`, `optimistic_lock`, `update_time`) VALUES
('UC2504????', 1, 1, 1744269073);

-- --------------------------------------------------------

--
-- Table structure for table `computers`
--

CREATE TABLE `computers` (
  `id` int NOT NULL,
  `profile_id` int NOT NULL COMMENT 'ผู้ครอบครอง',
  `asset_code` varchar(45) DEFAULT NULL COMMENT 'รหัสสินทรัพย์',
  `computer_name` varchar(100) NOT NULL COMMENT 'ชื่อคอมพิวเตอร์',
  `brand` varchar(100) DEFAULT NULL COMMENT 'ยี่ห้อ',
  `model` varchar(100) DEFAULT NULL COMMENT 'รุ่น',
  `serial_number` varchar(100) DEFAULT NULL COMMENT 'S/N',
  `purchase_date` varchar(45) DEFAULT NULL COMMENT 'วันที่ซื้อ',
  `warranty_expiry` varchar(45) DEFAULT NULL COMMENT 'วันหมดอายุ',
  `cpu` varchar(45) DEFAULT NULL COMMENT 'ซีพียู',
  `ram` varchar(45) DEFAULT NULL COMMENT 'แรม',
  `capacity_storage` varchar(45) DEFAULT NULL COMMENT 'ความจุ',
  `lan` varchar(45) DEFAULT NULL COMMENT 'LAN:',
  `wifi` varchar(45) DEFAULT NULL COMMENT 'Wireless:',
  `network_ip` varchar(45) DEFAULT NULL COMMENT 'IP address:',
  `nework_mac_addr` varchar(45) DEFAULT NULL COMMENT 'MAC address:',
  `status_id` int DEFAULT '1' COMMENT 'สถานะ',
  `created_at` varchar(45) DEFAULT NULL,
  `updated_at` varchar(45) DEFAULT NULL,
  `ref_code` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `computers`
--

INSERT INTO `computers` (`id`, `profile_id`, `asset_code`, `computer_name`, `brand`, `model`, `serial_number`, `purchase_date`, `warranty_expiry`, `cpu`, `ram`, `capacity_storage`, `lan`, `wifi`, `network_ip`, `nework_mac_addr`, `status_id`, `created_at`, `updated_at`, `ref_code`) VALUES
(1, 1, NULL, 'Office PC', 'Dell', 'Inspiron 15', 'SN123456789', '2022-01-01', '2025-01-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-02-22 08:59:42', '2025-02-22 10:40:06', NULL),
(2, 2, NULL, 'Gaming Laptop', 'ASUS', 'ROG Strix', 'SN987654321', '2021-06-15', '2024-06-15', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-02-22 08:59:42', '2025-02-22 08:59:42', NULL),
(3, 3, NULL, 'Workstation', 'HP', 'ZBook G7', 'SN1122334455', '2023-03-01', '2026-03-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-02-22 08:59:42', '2025-02-22 08:59:42', NULL),
(4, 4, NULL, 'Development PC', 'Lenovo', 'ThinkPad X1', 'SN6655443322', '2020-11-20', '2023-11-20', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-02-22 08:59:42', '2025-02-22 08:59:42', NULL),
(5, 5, NULL, 'Design Laptop', 'Apple', 'MacBook Pro', 'SN9988776655', '2022-05-10', '2025-05-10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-02-22 08:59:42', '2025-02-22 08:59:42', NULL),
(6, 6, NULL, 'Server Machine', 'Dell', 'PowerEdge T40', 'SN7788990011', '2021-09-30', '2024-09-30', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-02-22 08:59:42', '2025-02-22 08:59:42', NULL),
(7, 7, NULL, 'Personal Laptop', 'Acer', 'Aspire E15', 'SN4455667788', '2020-12-25', '2023-12-25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-02-22 08:59:42', '2025-02-22 08:59:42', NULL),
(8, 8, NULL, 'Office Laptop', 'HP', 'Pavilion 14', 'SN3344556677', '2019-08-15', '2022-08-15', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-02-22 08:59:42', '2025-02-22 08:59:42', NULL),
(9, 9, NULL, 'Gaming Desktop', 'MSI', 'Infinite A', 'SN2233445566', '2021-10-05', '2024-10-05', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-02-22 08:59:42', '2025-02-22 08:59:42', NULL),
(10, 10, NULL, 'Backup Server', 'Lenovo', 'ThinkCentre M920', 'SN1123581321', '2023-01-01', '2026-01-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-02-22 08:59:42', '2025-02-22 08:59:42', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `connectivity_types`
--

CREATE TABLE `connectivity_types` (
  `id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `category` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `monitors`
--

CREATE TABLE `monitors` (
  `id` int NOT NULL,
  `computer_id` int NOT NULL,
  `asset_code` varchar(45) DEFAULT NULL COMMENT 'รหัสสินทรัพย์',
  `monitor_name` varchar(100) NOT NULL COMMENT 'ชื่อ',
  `monitor_type` varchar(100) DEFAULT NULL COMMENT 'ประเภทจอ',
  `screen_size_inch` float DEFAULT NULL COMMENT 'ขนาดจอ',
  `connectivity_types_id` int NOT NULL COMMENT 'การเชื่อมต่อ',
  `brand` varchar(100) DEFAULT NULL COMMENT 'ยี่ห้อ',
  `model` varchar(100) DEFAULT NULL COMMENT 'รุ่น',
  `serial_number` varchar(100) DEFAULT NULL,
  `purchase_date` varchar(45) DEFAULT NULL COMMENT 'วันที่ซื้อ',
  `warranty_expiry` varchar(45) DEFAULT NULL COMMENT 'วันหมดอายุ',
  `created_at` varchar(45) DEFAULT NULL,
  `updated_at` varchar(45) DEFAULT NULL,
  `status_id` int DEFAULT '1' COMMENT 'สถานะ',
  `ref_code` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `monitors`
--

INSERT INTO `monitors` (`id`, `computer_id`, `asset_code`, `monitor_name`, `monitor_type`, `screen_size_inch`, `connectivity_types_id`, `brand`, `model`, `serial_number`, `purchase_date`, `warranty_expiry`, `created_at`, `updated_at`, `status_id`, `ref_code`) VALUES
(1, 1, NULL, 'Primary Monitor', NULL, 27, 0, 'Dell', 'UltraSharp U2723QE', 'SN-MON-001', '2022-01-01', '2025-01-01', '2025-02-22 09:08:15', '2025-02-22 09:08:15', 1, NULL),
(2, 1, NULL, 'Secondary Monitor', NULL, 27, 0, 'LG', '27UK850-W', 'SN-MON-002', '2021-06-15', '2024-06-15', '2025-02-22 09:08:15', '2025-02-22 09:08:15', 1, NULL),
(3, 2, NULL, 'Office Monitor', NULL, 32, 0, 'Samsung', 'Smart Monitor M7', 'SN-MON-003', '2023-03-01', '2026-03-01', '2025-02-22 09:08:15', '2025-02-22 09:08:15', 1, NULL),
(4, 3, NULL, 'Home Monitor', NULL, 24, 0, 'HP', 'EliteDisplay E243', 'SN-MON-004', '2020-11-20', '2023-11-20', '2025-02-22 09:08:15', '2025-02-22 09:08:15', 1, NULL),
(5, 4, NULL, 'Gaming Monitor', NULL, 27, 0, 'MSI', 'Optix MAG272CQR', 'SN-MON-005', '2022-05-10', '2025-05-10', '2025-02-22 09:08:15', '2025-02-22 09:08:15', 1, NULL),
(6, 5, NULL, 'Design Monitor', NULL, 32, 0, 'BenQ', 'PD3220U', 'SN-MON-006', '2021-09-30', '2024-09-30', '2025-02-22 09:08:15', '2025-02-22 09:08:15', 1, NULL),
(7, 6, NULL, 'Portable Monitor', NULL, 15.6, 0, 'ASUS', 'ZenScreen MB16AC', 'SN-MON-007', '2020-12-25', '2023-12-25', '2025-02-22 09:08:15', '2025-02-22 09:08:15', 1, NULL),
(8, 7, NULL, 'Public Display', NULL, 50, 0, 'Sony', 'Bravia FW-50BZ30J', 'SN-MON-008', '2019-08-15', '2022-08-15', '2025-02-22 09:08:15', '2025-02-22 09:08:15', 1, NULL),
(9, 8, NULL, 'Curved Monitor', NULL, 49, 0, 'Samsung', 'Odyssey G9', 'SN-MON-009', '2021-10-05', '2024-10-05', '2025-02-22 09:08:15', '2025-02-22 09:08:15', 1, NULL),
(10, 9, NULL, 'VR-Compatible Monitor', NULL, 34, 0, 'LG', '34GN850-B', 'SN-MON-010', '2023-01-01', '2026-01-01', '2025-02-22 09:08:15', '2025-02-22 09:08:15', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `parts`
--

CREATE TABLE `parts` (
  `id` int NOT NULL,
  `part_name` varchar(100) NOT NULL,
  `part_category` varchar(50) DEFAULT NULL,
  `brand` varchar(50) DEFAULT NULL,
  `model` varchar(50) DEFAULT NULL,
  `serial_number` varchar(100) DEFAULT NULL,
  `purchase_date` date DEFAULT NULL,
  `warranty_expiry` date DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `description` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `parts`
--

INSERT INTO `parts` (`id`, `part_name`, `part_category`, `brand`, `model`, `serial_number`, `purchase_date`, `warranty_expiry`, `price`, `description`, `created_at`, `updated_at`) VALUES
(1, '8GB RAM Module', 'Memory', 'Kingston', 'HX426C16FB3/8', NULL, '2022-01-01', '2025-01-01', '50.00', 'DDR4 2666MHz single RAM stick', '2025-02-22 02:10:46', '2025-02-22 02:10:46'),
(2, '500GB SSD', 'Storage', 'Samsung', '870 EVO', NULL, '2022-03-05', '2025-03-05', '100.00', 'SATA SSD for desktop and laptop', '2025-02-22 02:10:46', '2025-02-22 02:10:46'),
(3, 'Motherboard', 'Motherboard', 'ASUS', 'PRIME H510M-E', NULL, '2023-05-10', '2026-05-10', '120.00', 'Compatible with Intel 10th/11th Gen processors', '2025-02-22 02:10:46', '2025-02-22 02:10:46'),
(4, 'Gaming Mouse', 'Peripheral', 'Logitech', 'G502 HERO', NULL, '2023-07-01', '2025-07-01', '45.00', 'High-performance gaming mouse with adjustable DPI', '2025-02-22 02:10:46', '2025-02-22 02:10:46'),
(5, '500W Power Supply', 'Power Supply', 'Corsair', 'CX500', NULL, '2022-10-15', '2024-10-15', '80.00', '500 Watt power supply unit for modular computers', '2025-02-22 02:10:46', '2025-02-22 02:10:46');

-- --------------------------------------------------------

--
-- Table structure for table `printers`
--

CREATE TABLE `printers` (
  `id` int NOT NULL,
  `profile_id` int NOT NULL,
  `asset_code` varchar(45) DEFAULT NULL COMMENT 'รหัสสินทรัพย์',
  `printer_name` varchar(100) NOT NULL COMMENT 'ชื่อ',
  `connectivity_types_id` int NOT NULL COMMENT 'การเชื่อมต่อ',
  `brand` varchar(100) DEFAULT NULL COMMENT 'ยี่ห้อ',
  `model` varchar(100) DEFAULT NULL COMMENT 'รุ่น',
  `serial_number` varchar(100) DEFAULT NULL COMMENT 'S/N',
  `location` varchar(100) DEFAULT NULL COMMENT 'สถานที่ติดตั้ง',
  `purchase_date` varchar(45) DEFAULT NULL COMMENT 'วันที่ซื้อ',
  `warranty_expiry` varchar(45) DEFAULT NULL COMMENT 'วันที่หมดประกัน',
  `created_at` varchar(45) DEFAULT NULL,
  `updated_at` varchar(45) DEFAULT NULL,
  `status_id` int DEFAULT '1' COMMENT 'สถานะ',
  `ref_code` varchar(45) DEFAULT NULL COMMENT 'REF'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `printers`
--

INSERT INTO `printers` (`id`, `profile_id`, `asset_code`, `printer_name`, `connectivity_types_id`, `brand`, `model`, `serial_number`, `location`, `purchase_date`, `warranty_expiry`, `created_at`, `updated_at`, `status_id`, `ref_code`) VALUES
(1, 0, NULL, 'Office Printer', 0, 'Canon', 'PIXMA G1020', 'SN-PRN-001', 'Office Floor 1', '2022-03-01', '2025-03-01', '2025-02-22 09:09:14', '2025-02-22 09:09:14', 1, NULL),
(2, 0, NULL, 'Warehouse Printer', 0, 'HP', 'LaserJet Pro MFP M227fdw', 'SN-PRN-002', 'Warehouse', '2021-01-15', '2023-01-15', '2025-02-22 09:09:14', '2025-02-22 09:09:14', 1, NULL),
(3, 0, NULL, 'Manager\'s Printer', 0, 'Epson', 'EcoTank L14150', 'SN-PRN-003', 'Manager\'s Office', '2022-05-10', '2025-05-10', '2025-02-22 09:09:14', '2025-02-22 09:09:14', 1, NULL),
(4, 0, NULL, 'Accounts Printer', 0, 'Brother', 'HL-L2350DW', 'SN-PRN-004', 'Accounts Room', '2020-11-20', '2023-11-20', '2025-02-22 09:09:14', '2025-02-22 09:09:14', 1, NULL),
(5, 0, NULL, 'IT Department Printer', 0, 'Kyocera', 'TASKalfa 6002i', 'SN-PRN-005', 'IT Department', '2023-02-10', '2026-02-10', '2025-02-22 09:09:14', '2025-02-22 09:09:14', 1, NULL),
(6, 0, NULL, 'Reception Printer', 0, 'Samsung', 'ML-2165', 'SN-PRN-006', 'Reception', '2021-10-01', '2024-10-01', '2025-02-22 09:09:14', '2025-02-22 09:09:14', 1, NULL),
(7, 0, NULL, 'Team Printer', 0, 'Lexmark', 'MB2236adw', 'SN-PRN-007', 'Team Workspace', '2020-12-15', '2023-12-15', '2025-02-22 09:09:14', '2025-02-22 09:09:14', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE `profile` (
  `id` int NOT NULL,
  `user_id` int DEFAULT NULL COMMENT 'รหัสพนักงาน',
  `title_name` int DEFAULT NULL COMMENT 'คำนำหน้าชื่อ',
  `thai_name` varchar(200) DEFAULT NULL COMMENT 'ชื่อ-สกุล',
  `english_name` varchar(200) DEFAULT NULL COMMENT 'English Name',
  `nickname` varchar(45) DEFAULT NULL COMMENT 'ชื่อเล่น',
  `date_of_birth` varchar(100) DEFAULT NULL COMMENT 'วันเกิด',
  `start_date` varchar(45) DEFAULT NULL COMMENT 'วันเริ่มงาน',
  `position` varchar(200) DEFAULT NULL COMMENT 'ตำแหน่ง',
  `department_id` int DEFAULT NULL COMMENT 'แผนก',
  `email` varchar(45) DEFAULT NULL COMMENT 'อีเมล',
  `line_id` varchar(45) DEFAULT NULL COMMENT 'ไลน์',
  `phone_number` varchar(15) DEFAULT NULL COMMENT 'เบอร์ติดต่อ',
  `employee_id` varchar(45) DEFAULT NULL COMMENT 'รหัสพนักงาน',
  `role_id` int DEFAULT '1' COMMENT 'สิทธิ์ใช้งาน',
  `pdpa` int DEFAULT '1',
  `reason` varchar(200) DEFAULT NULL COMMENT 'เหตุผล',
  `created_at` varchar(45) DEFAULT NULL COMMENT 'วันที่ขอ',
  `updated_at` varchar(45) DEFAULT NULL COMMENT 'วันที่บันทึก',
  `status_id` int DEFAULT '1' COMMENT 'สถานะ',
  `leave_date` varchar(45) DEFAULT NULL COMMENT 'วันที่ลาออก',
  `approve_name` varchar(45) DEFAULT NULL COMMENT 'ผู้อนุมัติ',
  `approve_date` varchar(45) DEFAULT NULL COMMENT 'วันที่อนุมัติ',
  `ref_code` varchar(45) DEFAULT NULL COMMENT 'REF.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`id`, `user_id`, `title_name`, `thai_name`, `english_name`, `nickname`, `date_of_birth`, `start_date`, `position`, `department_id`, `email`, `line_id`, `phone_number`, `employee_id`, `role_id`, `pdpa`, `reason`, `created_at`, `updated_at`, `status_id`, `leave_date`, `approve_name`, `approve_date`, `ref_code`) VALUES
(1, 1, 1, 'ธีรพงศ์ ขันตา', 'theerapong khanta', 'แซม', '1990-01-01', '1990-01-01', 'IT', 1, 'itnfc@northernfoodcomplex.com', 'sam-it', '0870873830', 'nfc0268', 1, 1, NULL, '2025-02-22 08:57:52', '2025-02-22 08:57:52', 1, NULL, NULL, NULL, NULL),
(2, 2, NULL, 'Jane', NULL, NULL, '1985-05-15', NULL, 'Doe', NULL, NULL, NULL, '987654321', NULL, 1, 1, NULL, '2025-02-22 08:57:52', '2025-02-22 08:57:52', 1, NULL, NULL, NULL, NULL),
(3, 3, NULL, 'Alice', NULL, NULL, '1993-03-22', NULL, 'Wonder', NULL, NULL, NULL, '555777888', NULL, 1, 1, NULL, '2025-02-22 08:57:52', '2025-02-22 08:57:52', 1, NULL, NULL, NULL, NULL),
(4, 4, NULL, 'Bob', NULL, NULL, '1988-11-12', NULL, 'Builder', NULL, NULL, NULL, '1213141516', NULL, 1, 1, NULL, '2025-02-22 08:57:52', '2025-02-22 08:57:52', 1, NULL, NULL, NULL, NULL),
(5, 5, NULL, 'Charlie', NULL, NULL, '1995-07-18', NULL, 'Brown', NULL, NULL, NULL, '1718192021', NULL, 1, 1, NULL, '2025-02-22 08:57:52', '2025-02-22 08:57:52', 1, NULL, NULL, NULL, NULL),
(6, 6, NULL, 'David', NULL, NULL, '1992-09-09', NULL, 'Smith', NULL, NULL, NULL, '111222333', NULL, 1, 1, NULL, '2025-02-22 08:57:52', '2025-02-22 08:57:52', 1, NULL, NULL, NULL, NULL),
(7, 7, NULL, 'Eve', NULL, NULL, '1996-12-25', NULL, 'Hacker', NULL, NULL, NULL, '444555666', NULL, 1, 1, NULL, '2025-02-22 08:57:52', '2025-02-22 08:57:52', 1, NULL, NULL, NULL, NULL),
(8, 8, NULL, 'Frank', NULL, NULL, '1989-06-06', NULL, 'Cat', NULL, NULL, NULL, '777888999', NULL, 1, 1, NULL, '2025-02-22 08:57:52', '2025-02-22 08:57:52', 1, NULL, NULL, NULL, NULL),
(9, 9, NULL, 'Grace', NULL, NULL, '1980-12-09', NULL, 'Hopper', NULL, NULL, NULL, '333333333', NULL, 1, 1, NULL, '2025-02-22 08:57:52', '2025-02-22 08:57:52', 1, NULL, NULL, NULL, NULL),
(10, 10, NULL, 'Heidi', NULL, NULL, '1979-01-10', NULL, 'Klum', NULL, NULL, NULL, '1010101010', NULL, 1, 1, NULL, '2025-02-22 08:57:52', '2025-02-22 08:57:52', 1, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `repairs`
--

CREATE TABLE `repairs` (
  `id` int NOT NULL,
  `repair_request_id` int NOT NULL,
  `repair_start_date` date DEFAULT NULL,
  `repair_end_date` date DEFAULT NULL,
  `technician_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `repairNotes` text COLLATE utf8mb4_unicode_ci,
  `total_cost` decimal(10,2) DEFAULT NULL,
  `repair_status` enum('Not-Started','In-Progress','Waiting-Parts','Completed','Cancelled') COLLATE utf8mb4_unicode_ci DEFAULT 'Not-Started',
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `repairs`
--

INSERT INTO `repairs` (`id`, `repair_request_id`, `repair_start_date`, `repair_end_date`, `technician_name`, `repairNotes`, `total_cost`, `repair_status`, `created_at`, `updated_at`) VALUES
(1, 1, '2025-02-22', '2025-02-22', 'vcvbcvb', 'cvbcvbcvb', '222.00', 'Cancelled', '2025-02-22 06:02:59', '2025-02-22 06:02:59');

-- --------------------------------------------------------

--
-- Table structure for table `repair_costs`
--

CREATE TABLE `repair_costs` (
  `id` int NOT NULL,
  `repair_id` int NOT NULL,
  `cost_description` varchar(100) DEFAULT NULL,
  `amount` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `repair_costs`
--

INSERT INTO `repair_costs` (`id`, `repair_id`, `cost_description`, `amount`, `created_at`, `updated_at`) VALUES
(1, 1, 'Motherboard replacement', '150.00', '2025-02-22 02:14:20', '2025-02-22 02:14:20'),
(2, 1, 'Labor cost', '50.00', '2025-02-22 02:14:20', '2025-02-22 02:14:20'),
(3, 1, 'Mouse PCB replacement', '30.00', '2025-02-22 02:14:20', '2025-02-22 06:07:26'),
(4, 1, 'Labor cost', '20.00', '2025-02-22 02:14:20', '2025-02-22 06:07:28');

-- --------------------------------------------------------

--
-- Table structure for table `repair_requests`
--

CREATE TABLE `repair_requests` (
  `id` int NOT NULL,
  `request_by` varchar(100) NOT NULL,
  `request_date` date NOT NULL,
  `item_name` varchar(100) NOT NULL,
  `issue_description` text,
  `status` enum('Pending','In-Progress','Completed','Cancelled') DEFAULT 'Pending',
  `approval_status` enum('Pending','Approved','Rejected') DEFAULT 'Pending',
  `approved_by` varchar(100) DEFAULT NULL,
  `approved_at` timestamp NULL DEFAULT NULL,
  `approval_comment` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `repair_requests`
--

INSERT INTO `repair_requests` (`id`, `request_by`, `request_date`, `item_name`, `issue_description`, `status`, `approval_status`, `approved_by`, `approved_at`, `approval_comment`, `created_at`, `updated_at`) VALUES
(1, 'John Doe', '2023-10-01', 'Laptop HP Pavilion', 'Laptop does not turn on.', 'Pending', 'Pending', NULL, NULL, NULL, '2025-02-22 02:14:06', '2025-02-22 02:14:06'),
(2, 'Jane Smith', '2023-10-02', 'Dell Monitor', 'Flickering screen during use.', 'In-Progress', 'Pending', NULL, NULL, NULL, '2025-02-22 02:14:06', '2025-02-22 02:14:06'),
(3, 'Michael Tan', '2023-10-05', 'Gaming Mouse', 'Left and right buttons not responsive.', 'Completed', 'Pending', NULL, NULL, NULL, '2025-02-22 02:14:06', '2025-02-22 02:14:06'),
(4, 'Sarah Lee', '2023-10-06', 'Printer Canon LBP6030', 'Paper jam error.', 'Pending', 'Pending', NULL, NULL, NULL, '2025-02-22 02:14:06', '2025-02-22 02:14:06'),
(5, 'Kevin Wong', '2023-10-07', 'External SSD Samsung 870 EVO', 'Not detected by PC.', 'Cancelled', 'Pending', NULL, NULL, NULL, '2025-02-22 02:14:06', '2025-02-22 02:14:06'),
(6, 'John Doe', '2023-10-01', 'Laptop HP Pavilion', 'Laptop does not turn on.', 'Pending', 'Approved', 'Manager A', '2023-10-02 03:30:00', NULL, '2025-02-22 02:20:51', '2025-02-22 02:20:51'),
(7, 'Jane Smith', '2023-10-02', 'Dell Monitor', 'Flickering screen during use.', 'In-Progress', 'Pending', NULL, NULL, NULL, '2025-02-22 02:20:51', '2025-02-22 02:20:51'),
(8, 'Michael Tan', '2023-10-05', 'Gaming Mouse', 'Left and right buttons not responsive.', 'Completed', 'Approved', 'Manager B', '2023-10-06 08:20:00', NULL, '2025-02-22 02:20:51', '2025-02-22 02:20:51'),
(9, 'Sarah Lee', '2023-10-06', 'Printer Canon LBP6030', 'Paper jam error.', 'Pending', 'Rejected', 'Manager A', '2023-10-07 02:00:00', NULL, '2025-02-22 02:20:51', '2025-02-22 02:20:51'),
(10, 'Kevin Wong', '2023-10-07', 'External SSD Samsung 870 EVO', 'Not detected by PC.', 'Cancelled', 'Pending', NULL, NULL, NULL, '2025-02-22 02:20:51', '2025-02-22 02:20:51'),
(11, 'John Doe', '2023-10-01', 'Laptop HP Pavilion', 'Laptop does not turn on.', 'Pending', 'Approved', 'Manager A', '2023-10-02 03:30:00', 'Necessary for urgent work tasks.', '2025-02-22 02:22:17', '2025-02-22 02:22:17'),
(12, 'Jane Smith', '2023-10-02', 'Dell Monitor', 'Flickering screen during use.', 'In-Progress', 'Pending', NULL, NULL, NULL, '2025-02-22 02:22:17', '2025-02-22 02:22:17'),
(13, 'Michael Tan', '2023-10-05', 'Gaming Mouse', 'Left and right buttons not responsive.', 'Completed', 'Approved', 'Manager B', '2023-10-06 08:20:00', 'Low priority issue, but approved for resolution.', '2025-02-22 02:22:17', '2025-02-22 02:22:17'),
(14, 'Sarah Lee', '2023-10-06', 'Printer Canon LBP6030', 'Paper jam error.', 'Pending', 'Rejected', 'Manager A', '2023-10-07 02:00:00', 'Cannot approve due to low priority and budget limitation.', '2025-02-22 02:22:17', '2025-02-22 02:22:17'),
(15, 'Kevin Wong', '2023-10-07', 'External SSD Samsung 870 EVO', 'Not detected by PC.', 'Cancelled', 'Pending', NULL, NULL, NULL, '2025-02-22 02:22:17', '2025-02-22 02:22:17');

--
-- Triggers `repair_requests`
--
DELIMITER $$
CREATE TRIGGER `notify_approval_update` AFTER UPDATE ON `repair_requests` FOR EACH ROW BEGIN
    -- เงื่อนไข: หาก `approval_status` หรือ `approval_comment` มีการเปลี่ยนแปลง
    IF NEW.approval_status <> OLD.approval_status OR NEW.approval_comment <> OLD.approval_comment THEN
        -- เพิ่มข้อมูลลงในระบบการแจ้งเตือน:
        INSERT INTO notification_logs (request_id, message, created_at)
        VALUES (
            NEW.id,
            CONCAT(
                'Approval has been updated for Request ID: ', NEW.id,
                '. Status: ', NEW.approval_status,
                IFNULL(CONCAT('. Comment: ', NEW.approval_comment), '.')
            ),
            NOW()
        );
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `software`
--

CREATE TABLE `software` (
  `id` int NOT NULL,
  `software_id` int NOT NULL COMMENT 'Software',
  `computer_id` int NOT NULL COMMENT 'Computer',
  `asset_code` varchar(45) DEFAULT NULL COMMENT 'รหัสสินทรัพย์',
  `software_name` varchar(100) NOT NULL COMMENT 'ชื่อ',
  `description` text COMMENT 'รายละเอียด',
  `version` varchar(45) NOT NULL COMMENT 'Version',
  `license_key` varchar(100) DEFAULT NULL COMMENT 'License Key',
  `installation_date` date DEFAULT NULL COMMENT 'วันที่ติดตั้งล่าสุด',
  `expiry_date` date DEFAULT NULL COMMENT 'วันที่หมดอายุ',
  `created_at` varchar(45) DEFAULT NULL,
  `updated_at` varchar(45) DEFAULT NULL,
  `ref_code` varchar(45) DEFAULT NULL,
  `status_id` int DEFAULT '1' COMMENT 'สถานะ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `software`
--

INSERT INTO `software` (`id`, `software_id`, `computer_id`, `asset_code`, `software_name`, `description`, `version`, `license_key`, `installation_date`, `expiry_date`, `created_at`, `updated_at`, `ref_code`, `status_id`) VALUES
(1, 1, 1, NULL, '', NULL, 'Windows 10 Pro', 'WIN10-KEY-001', '2022-01-01', '2025-01-01', '2025-02-22 09:02:55', '2025-02-22 09:02:55', NULL, 1),
(2, 2, 1, NULL, '', NULL, 'Office 365', 'OFFICE-KEY-001', '2022-01-02', '2023-01-02', '2025-02-22 09:02:55', '2025-02-22 09:02:55', NULL, 1),
(3, 3, 2, NULL, '', NULL, 'Photoshop CC 2022', 'PS-KEY-002', '2023-05-15', '2024-05-15', '2025-02-22 09:02:55', '2025-02-22 09:02:55', NULL, 1),
(4, 4, 3, NULL, '', NULL, 'Visual Studio 2022', 'VS-KEY-003', '2021-08-01', '2026-08-01', '2025-02-22 09:02:55', '2025-02-22 09:02:55', NULL, 1),
(5, 5, 4, NULL, '', NULL, 'Kaspersky Antivirus', 'KASP-KEY-004', '2022-03-20', '2023-03-20', '2025-02-22 09:02:55', '2025-02-22 09:02:55', NULL, 1),
(6, 1, 5, NULL, '', NULL, 'Windows 11 Home', 'WIN11-KEY-005', '2022-10-10', '2025-10-10', '2025-02-22 09:02:55', '2025-02-22 09:02:55', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `id` int NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `color` varchar(45) DEFAULT NULL,
  `category` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id`, `name`, `color`, `category`) VALUES
(1, 'Avtive', '#00CC00', 'A'),
(2, 'Pending', '#FFA500', 'A'),
(3, 'Disable', '#808080', 'A'),
(4, 'Create', '#1E90FF', 'B'),
(5, 'Approve', '#FFD700', 'B'),
(6, 'Success', '#32CD32', 'B');

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `id` int NOT NULL,
  `part_id` int NOT NULL,
  `quantity_in_stock` int NOT NULL,
  `reorder_level` int NOT NULL,
  `supplier_name` varchar(100) DEFAULT NULL,
  `last_restock_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`id`, `part_id`, `quantity_in_stock`, `reorder_level`, `supplier_name`, `last_restock_date`, `created_at`, `updated_at`) VALUES
(1, 1, 20, 5, 'IT Supplies Co.', '2023-10-01', '2025-02-22 02:10:55', '2025-02-22 02:10:55'),
(2, 2, 15, 3, 'Hardware Solutions', '2023-09-25', '2025-02-22 02:10:55', '2025-02-22 02:10:55'),
(3, 3, 10, 2, 'Tech Parts Ltd.', '2023-10-05', '2025-02-22 02:10:55', '2025-02-22 02:10:55'),
(4, 4, 12, 4, 'Gadget Depot', '2023-08-01', '2025-02-22 02:10:55', '2025-02-22 02:10:55'),
(5, 5, 8, 2, 'Power Gear Inc', '2023-07-15', '2025-02-22 02:10:55', '2025-02-22 02:10:55');

-- --------------------------------------------------------

--
-- Table structure for table `stock_transactions`
--

CREATE TABLE `stock_transactions` (
  `id` int NOT NULL,
  `part_id` int NOT NULL,
  `transaction_type` enum('IN','OUT') NOT NULL,
  `quantity` int NOT NULL,
  `transaction_date` date NOT NULL,
  `notes` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `stock_transactions`
--

INSERT INTO `stock_transactions` (`id`, `part_id`, `transaction_type`, `quantity`, `transaction_date`, `notes`, `created_at`, `updated_at`) VALUES
(1, 1, 'IN', 10, '2023-10-01', 'Restocked from supplier', '2025-02-22 02:11:03', '2025-02-22 02:11:03'),
(2, 1, 'OUT', 3, '2023-10-05', 'Used for upgrading systems', '2025-02-22 02:11:03', '2025-02-22 02:11:03'),
(3, 2, 'IN', 5, '2023-09-25', 'Restocked from supplier', '2025-02-22 02:11:03', '2025-02-22 02:11:03'),
(4, 3, 'OUT', 1, '2023-10-10', 'Replacement for failed motherboard', '2025-02-22 02:11:03', '2025-02-22 02:11:03'),
(5, 4, 'OUT', 2, '2023-08-10', 'Used for new gaming PC build', '2025-02-22 02:11:03', '2025-02-22 02:11:03'),
(6, 5, 'IN', 5, '2023-07-15', 'Shipment from supplier', '2025-02-22 02:11:03', '2025-02-22 02:11:03'),
(7, 5, 'OUT', 2, '2023-07-20', 'Used for repairing desktop system', '2025-02-22 02:11:03', '2025-02-22 02:11:03');

-- --------------------------------------------------------

--
-- Table structure for table `uploads`
--

CREATE TABLE `uploads` (
  `upload_id` int NOT NULL,
  `ref` varchar(50) DEFAULT NULL,
  `file_name` varchar(150) DEFAULT NULL COMMENT 'ชื่อไฟล์',
  `real_filename` varchar(150) DEFAULT NULL COMMENT 'ชื่อไฟล์จริง',
  `create_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `type` int DEFAULT NULL COMMENT 'ประเภท'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `user_client_auth`
--

CREATE TABLE `user_client_auth` (
  `id` int NOT NULL,
  `profile_id` int NOT NULL,
  `user_login` varchar(45) DEFAULT NULL COMMENT 'User: PC,DATA,Internet',
  `user_login_pass` varchar(45) DEFAULT NULL COMMENT 'Password: PC,DATA,Internet',
  `company_email` varchar(200) DEFAULT NULL COMMENT 'Email:',
  `company_email_pass` varchar(45) DEFAULT NULL COMMENT 'Password Email:',
  `mrp_user_login` varchar(45) DEFAULT NULL COMMENT 'MRP User:',
  `mrp_user_login_pass` varchar(45) DEFAULT NULL COMMENT 'MRP Password:',
  `printer_code` varchar(45) DEFAULT NULL COMMENT 'Printer Code:',
  `phone_number` varchar(45) DEFAULT NULL COMMENT 'เบอร์โทรภายใน',
  `operator_name` varchar(200) DEFAULT NULL COMMENT 'ผู้ดำเนินการ',
  `operator_date` varchar(45) DEFAULT NULL COMMENT 'วันที่ดำเนินการ',
  `operator_comment` text COMMENT 'ความคิดเห็น',
  `recorder_date` varchar(45) DEFAULT NULL COMMENT 'วันที่บันทึก',
  `ref_code` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `user_client_auth`
--

INSERT INTO `user_client_auth` (`id`, `profile_id`, `user_login`, `user_login_pass`, `company_email`, `company_email_pass`, `mrp_user_login`, `mrp_user_login_pass`, `printer_code`, `phone_number`, `operator_name`, `operator_date`, `operator_comment`, `recorder_date`, `ref_code`) VALUES
(1, 1, 'theerapong', 'Theer@pong', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-04-10', 'UC25040001');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accessories`
--
ALTER TABLE `accessories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `serial_number` (`serial_number`),
  ADD KEY `computer_id` (`computer_id`),
  ADD KEY `fk_accessories_accessory_types1_idx` (`type_id`),
  ADD KEY `fk_accessories_status_id1_idx` (`status_id`);

--
-- Indexes for table `accessory_types`
--
ALTER TABLE `accessory_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auto_number`
--
ALTER TABLE `auto_number`
  ADD PRIMARY KEY (`group`);

--
-- Indexes for table `computers`
--
ALTER TABLE `computers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `serial_number` (`serial_number`),
  ADD KEY `profile_id` (`profile_id`),
  ADD KEY `fk_computers_status_id1_idx` (`status_id`);

--
-- Indexes for table `connectivity_types`
--
ALTER TABLE `connectivity_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `monitors`
--
ALTER TABLE `monitors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `serial_number` (`serial_number`),
  ADD KEY `computer_id` (`computer_id`),
  ADD KEY `fk_monitors_status_id1_idx` (`status_id`),
  ADD KEY `fk_monitors_connectivity_types1_idx` (`connectivity_types_id`);

--
-- Indexes for table `parts`
--
ALTER TABLE `parts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `serial_number` (`serial_number`);

--
-- Indexes for table `printers`
--
ALTER TABLE `printers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `serial_number` (`serial_number`),
  ADD KEY `fk_printers_profile1_idx` (`profile_id`),
  ADD KEY `fk_printers_status_id1_idx` (`status_id`),
  ADD KEY `fk_printers_connectivity_types1_idx` (`connectivity_types_id`);

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id_UNIQUE` (`user_id`),
  ADD KEY `fk_profile_status_id1_idx` (`status_id`);

--
-- Indexes for table `repairs`
--
ALTER TABLE `repairs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `repairs_repair_request_id_f` (`repair_request_id`);

--
-- Indexes for table `repair_costs`
--
ALTER TABLE `repair_costs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `repair_id` (`repair_id`);

--
-- Indexes for table `repair_requests`
--
ALTER TABLE `repair_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `software`
--
ALTER TABLE `software`
  ADD PRIMARY KEY (`id`),
  ADD KEY `computer_id` (`computer_id`),
  ADD KEY `fk_software_status_id1_idx` (`status_id`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`id`),
  ADD KEY `part_id` (`part_id`);

--
-- Indexes for table `stock_transactions`
--
ALTER TABLE `stock_transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `part_id` (`part_id`);

--
-- Indexes for table `uploads`
--
ALTER TABLE `uploads`
  ADD PRIMARY KEY (`upload_id`);

--
-- Indexes for table `user_client_auth`
--
ALTER TABLE `user_client_auth`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_authen_profile1_idx` (`profile_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accessories`
--
ALTER TABLE `accessories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `accessory_types`
--
ALTER TABLE `accessory_types`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `computers`
--
ALTER TABLE `computers`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `connectivity_types`
--
ALTER TABLE `connectivity_types`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `monitors`
--
ALTER TABLE `monitors`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `parts`
--
ALTER TABLE `parts`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `printers`
--
ALTER TABLE `printers`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `profile`
--
ALTER TABLE `profile`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `repairs`
--
ALTER TABLE `repairs`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `repair_costs`
--
ALTER TABLE `repair_costs`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `repair_requests`
--
ALTER TABLE `repair_requests`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `software`
--
ALTER TABLE `software`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `stock_transactions`
--
ALTER TABLE `stock_transactions`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `uploads`
--
ALTER TABLE `uploads`
  MODIFY `upload_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_client_auth`
--
ALTER TABLE `user_client_auth`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `accessories`
--
ALTER TABLE `accessories`
  ADD CONSTRAINT `accessories_ibfk_1` FOREIGN KEY (`computer_id`) REFERENCES `computers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_accessories_accessory_types1` FOREIGN KEY (`type_id`) REFERENCES `accessory_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_accessories_status_id1` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `computers`
--
ALTER TABLE `computers`
  ADD CONSTRAINT `computers_ibfk_1` FOREIGN KEY (`profile_id`) REFERENCES `profile` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_computers_status_id1` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `monitors`
--
ALTER TABLE `monitors`
  ADD CONSTRAINT `fk_monitors_connectivity_types1` FOREIGN KEY (`connectivity_types_id`) REFERENCES `connectivity_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_monitors_status_id1` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `monitors_ibfk_1` FOREIGN KEY (`computer_id`) REFERENCES `computers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `printers`
--
ALTER TABLE `printers`
  ADD CONSTRAINT `fk_printers_connectivity_types1` FOREIGN KEY (`connectivity_types_id`) REFERENCES `connectivity_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_printers_profile1` FOREIGN KEY (`profile_id`) REFERENCES `profile` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_printers_status_id1` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `profile`
--
ALTER TABLE `profile`
  ADD CONSTRAINT `fk_profile_status_id1` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `repairs`
--
ALTER TABLE `repairs`
  ADD CONSTRAINT `repairs_repair_request_id_f` FOREIGN KEY (`repair_request_id`) REFERENCES `repair_requests` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `repair_costs`
--
ALTER TABLE `repair_costs`
  ADD CONSTRAINT `repair_costs_ibfk_1` FOREIGN KEY (`repair_id`) REFERENCES `repairs` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `software`
--
ALTER TABLE `software`
  ADD CONSTRAINT `fk_software_status_id1` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `software_details_ibfk_2` FOREIGN KEY (`computer_id`) REFERENCES `computers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `stock`
--
ALTER TABLE `stock`
  ADD CONSTRAINT `stock_ibfk_1` FOREIGN KEY (`part_id`) REFERENCES `parts` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `stock_transactions`
--
ALTER TABLE `stock_transactions`
  ADD CONSTRAINT `stock_transactions_ibfk_1` FOREIGN KEY (`part_id`) REFERENCES `parts` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_client_auth`
--
ALTER TABLE `user_client_auth`
  ADD CONSTRAINT `fk_user_authen_profile1` FOREIGN KEY (`profile_id`) REFERENCES `profile` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
