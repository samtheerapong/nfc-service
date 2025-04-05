-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 04, 2025 at 12:30 PM
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
-- Database: `data-engineer`
--

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
('RP-6803-????', 1, 1, 1742958684),
('RP-6804-????', 4, 1, 1743757028),
('TK-6803-????', 8, 1, 1742528922);

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `id` int NOT NULL,
  `code` varchar(255) NOT NULL COMMENT 'รหัส',
  `name` varchar(255) NOT NULL COMMENT 'ชื่อ',
  `detail` text COMMENT 'รายละเอียด',
  `color` varchar(255) DEFAULT NULL COMMENT 'สี',
  `active` int DEFAULT '1' COMMENT 'สถานะ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`id`, `code`, `name`, `detail`, `color`, `active`) VALUES
(1, 'B1-1-HR', 'ห้องแผนกบุคคล', '', '#176B87', 1),
(2, 'B1-1-PD', 'ห้องแผนกผลิต', '', '#176B87', 1),
(3, 'B1-1-PC', 'ห้องจัดซื้อ', '', '#176B87', 1),
(4, 'B1-1-QC', 'ห้องควบคุมคุณภาพ', '', '#176B87', 1),
(5, 'B1-2-AC', 'ห้องบัญชี', '', '#176B87', 1),
(6, 'B1-2-MT', 'ห้องประชุม', '', '#176B87', 1),
(7, 'B1-1-TL', 'ห้องน้ำสำนักงาน ชั้น 1', '', '#176B87', 1),
(8, 'B1-2-TL', 'ห้องน้ำสำนักงาน ชั้น 2', '', '#176B87', 1),
(9, 'B1-2-KC', 'ห้องเตรียมอาหารและเครื่องดื่ม', '', '#176B87', 1),
(10, 'B1-2-GM', 'ห้องผู้จัดการ', '', '#176B87', 1),
(11, 'B1-2-CT', 'ห้องประชุมใหญ่ (ห้องรับประทานอาหาร)', '', '#176B87', 1),
(12, 'C1-1-SE', 'บริเวณตู้ยาม', '', '#0802A3', 1),
(13, 'B1-1-IT', 'ห้องปฏิบัติการคอมพิวเตอร์', '', '#176B87', 1),
(14, 'B1-1-SV', 'ห้องเซิร์ฟเวอร์', '', '#176B87', 1),
(15, 'B1-A-WH', 'พื้นที่คลังสินค้า', '', '#6499E9', 1),
(16, 'B2-1-CT', 'อาคาร B2', '', '#713ABE', 1),
(17, 'B3-1-CT', 'อาคาร B3', '', '#26577C', 1),
(18, 'B4-1-CR', 'อาคาร B4 ส่วนคั้น', '', '#9A3B3B', 1),
(19, 'B4-1-FT', 'อาคาร B4 ส่วนกรอง', '', '#9A3B3B', 1),
(20, 'B4-1-WH', 'อาคาร B4 ส่วนคลังสินค้า', '', '#9A3B3B', 1),
(21, 'B4-1-PA', 'อาคาร B4 ส่วนบรรจุ', '', '#9A3B3B', 1),
(22, 'B5-1-PD', 'อาคาร B5 ส่วนผลิต', NULL, '#183D3D', 1),
(23, 'B5-1-RD', 'อาคาร B5 ส่วนวิจัยและพัฒนา', NULL, '#183D3D', 1),
(24, 'EN-1-BL', 'อาคารหม้อไอน้ำ (Boiler)', NULL, '#C70039', 1),
(25, 'EN-1-WS', 'อาคารน้ำดิบและน้ำซอฟท์', NULL, '#C70039', 1),
(26, 'EN-1-WR', 'ระบบบ่อบำบัดน้ำเสีย', NULL, '#607274', 1),
(27, 'EN-2-EN', 'อาคารวิศวกรรม', NULL, '#607274', 1),
(28, 'B2-1-DW', 'ห้องแต่งตัวหญิง', NULL, '#607274', 1),
(29, 'B2-1-DM', 'ห้องแต่งตัวชาย', NULL, '#607274', 1),
(30, 'C3-1-TU', 'โรงเก็บขยะ', NULL, '#607274', 1),
(31, 'C2-1-CP', 'โรงรถ', NULL, '#607274', 1),
(32, 'B1-1-CT', 'อาคารสำนักงาน', NULL, '#607274', 1),
(33, 'C4-1-CT', 'บริเวณอาคาร', '', '#607274', 0),
(34, 'EN-1-CW', 'โรงผลิตน้ำใช้', NULL, '#607274', 1),
(35, 'C2-1-MP', 'โรงจอดรถจักรยานยนต์', NULL, '#607274', 1),
(36, 'C5-1-PL', 'พื้นที่แปลงผัก', '', '#607274', 0),
(37, 'C6-1-WD', 'ห้องซักผ้าและห้องเย็บผ้า', NULL, '#607274', 1);

-- --------------------------------------------------------

--
-- Table structure for table `machine`
--

CREATE TABLE `machine` (
  `id` int NOT NULL,
  `code` varchar(45) DEFAULT NULL COMMENT 'รหัส',
  `name` varchar(100) DEFAULT NULL COMMENT 'ชื่อ',
  `description` text COMMENT 'รายละเอียด',
  `type_id` int DEFAULT NULL COMMENT 'ประเภท',
  `serial_code` varchar(100) DEFAULT NULL COMMENT 'ซีเรียลนัมเบอร์',
  `asset_code` varchar(100) DEFAULT NULL COMMENT 'รหัสสินทรัพย์',
  `location` varchar(100) DEFAULT NULL COMMENT 'สถานที่',
  `last_install` varchar(45) DEFAULT NULL COMMENT 'ติดตั้งล่าสุด',
  `quantity_in_stock` int DEFAULT '0',
  `cost` varchar(45) DEFAULT NULL COMMENT 'ราคา',
  `unit` varchar(45) DEFAULT NULL,
  `last_update` varchar(45) DEFAULT NULL COMMENT 'วันที่ล่าสุด',
  `remask` varchar(100) DEFAULT NULL COMMENT 'หมายเหตุ',
  `status_id` int DEFAULT '1' COMMENT 'สถานะ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `machine`
--

INSERT INTO `machine` (`id`, `code`, `name`, `description`, `type_id`, `serial_code`, `asset_code`, `location`, `last_install`, `quantity_in_stock`, `cost`, `unit`, `last_update`, `remask`, `status_id`) VALUES
(1, 'M-001', 'เครื่องผลิต A', 'เครื่องผลิต A', 1, '000000001', 'M-66-PD-001', 'B2', '2024-01-02', 1, '50000', 'เครื่อง', '2024-01-02', NULL, 1),
(2, 'M-001', 'คอมพิวเตอร์', 'คอมพิวเตอร์', 1, '000000001', 'M-66-PD-001', 'B2', '2024-01-02', 1, '50000', 'เครื่อง', '2024-01-02', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `machine_bom`
--

CREATE TABLE `machine_bom` (
  `id` int NOT NULL,
  `machine_id` int NOT NULL COMMENT 'เครื่องจักร',
  `parent_part_id` int NOT NULL COMMENT 'อะไหล่หลัก',
  `child_part_id` int NOT NULL COMMENT 'อะไหล่รอง',
  `quantity_required` int DEFAULT NULL COMMENT 'จำนวน',
  `level` int DEFAULT '1' COMMENT 'ชั้นโครงสร้าง',
  `unit` varchar(45) DEFAULT NULL COMMENT 'หน่วย',
  `bom_date` varchar(45) DEFAULT NULL COMMENT 'วันที่',
  `status_id` int DEFAULT '1' COMMENT 'สถานะ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `machine_bom`
--

INSERT INTO `machine_bom` (`id`, `machine_id`, `parent_part_id`, `child_part_id`, `quantity_required`, `level`, `unit`, `bom_date`, `status_id`) VALUES
(1, 2, 1, 2, 2, 1, NULL, NULL, 1),
(2, 2, 4, 3, 1, 2, NULL, NULL, 1),
(3, 2, 3, 3, 1, 3, NULL, NULL, 1),
(4, 2, 4, 3, 1, 4, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `parts`
--

CREATE TABLE `parts` (
  `id` int NOT NULL,
  `code` varchar(45) DEFAULT NULL COMMENT 'รหัส',
  `name` varchar(100) DEFAULT NULL COMMENT 'ชื่อ',
  `description` text COMMENT 'รายละเอียด',
  `group_id` int DEFAULT NULL COMMENT 'กลุ่ม',
  `category_id` int DEFAULT NULL COMMENT 'หวดหมู่',
  `type_id` int DEFAULT NULL COMMENT 'ประเภท',
  `location` varchar(100) DEFAULT NULL COMMENT 'สถานที่',
  `serial_code` varchar(100) DEFAULT NULL COMMENT 'ซีเรียลนัมเบอร์',
  `asset_code` varchar(100) DEFAULT NULL COMMENT 'รหัสสินทรัพย์',
  `last_install` varchar(45) DEFAULT NULL COMMENT 'ติดตั้งล่าสุด',
  `quantity_in_stock` int DEFAULT '0' COMMENT 'จำนวนสต๊อก',
  `unit_cost` decimal(10,2) DEFAULT NULL COMMENT 'ราคาต่อหน่วย',
  `unit` varchar(45) DEFAULT NULL COMMENT 'หน่วย',
  `min_stock` int DEFAULT NULL COMMENT 'สต๊อกน้อยสุด',
  `last_update` varchar(45) DEFAULT NULL COMMENT 'วันที่ล่าสุด',
  `remask` varchar(100) DEFAULT NULL COMMENT 'หมายเหตุ',
  `status_id` int DEFAULT '1' COMMENT 'สถานะ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `parts`
--

INSERT INTO `parts` (`id`, `code`, `name`, `description`, `group_id`, `category_id`, `type_id`, `location`, `serial_code`, `asset_code`, `last_install`, `quantity_in_stock`, `unit_cost`, `unit`, `min_stock`, `last_update`, `remask`, `status_id`) VALUES
(1, 'P-001', 'แผงวงจรหลัก', NULL, 1, 1, 1, 'EN', NULL, NULL, NULL, 5, '100.00', 'ชิ้น', 2, NULL, NULL, 1),
(2, 'P-002', 'ฮาร์ดดิสก์', NULL, 1, 1, 1, 'EN', NULL, NULL, NULL, 5, '100.00', 'ชิ้น', 2, NULL, NULL, 1),
(3, 'P-003', 'สายแพร', NULL, 1, 1, 1, 'EN', NULL, NULL, NULL, 5, '100.00', 'ชิ้น', 2, NULL, NULL, 1),
(4, 'P-004', 'SSD', NULL, 1, 1, 1, 'EN', NULL, NULL, NULL, 5, '100.00', 'ชิ้น', 2, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `priority`
--

CREATE TABLE `priority` (
  `id` int NOT NULL,
  `code` varchar(255) NOT NULL COMMENT 'รหัส',
  `name` varchar(255) NOT NULL COMMENT 'ชื่อ',
  `detail` text COMMENT 'รายละเอียด',
  `color` varchar(255) DEFAULT NULL COMMENT 'สี',
  `active` int DEFAULT '1' COMMENT 'สถานะ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `priority`
--

INSERT INTO `priority` (`id`, `code`, `name`, `detail`, `color`, `active`) VALUES
(1, 'low', 'ต่ำ', 'ไม่มีผลกระทบต่อการผลิต', '#274e13', 1),
(2, 'nomal', 'กลาง', 'กระทบต่อการผลิตเฉพาะจุดที่ทำ', '#fd9500', 1),
(3, 'Hight', 'สูง', 'กระทบต่อการหยุดผลิตทั้งหมด', '#ff0000', 1);

-- --------------------------------------------------------

--
-- Table structure for table `task_status`
--

CREATE TABLE `task_status` (
  `id` int NOT NULL,
  `code` varchar(255) NOT NULL COMMENT 'รหัส',
  `name` varchar(255) NOT NULL COMMENT 'สถานะ',
  `detail` text COMMENT 'รายละเอียด',
  `color` varchar(255) DEFAULT NULL COMMENT 'สี',
  `active` int DEFAULT '1' COMMENT 'สถานะ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `task_status`
--

INSERT INTO `task_status` (`id`, `code`, `name`, `detail`, `color`, `active`) VALUES
(1, 'Request', 'ร้องขอ', 'ผู้ใช้เริ่มต้นกระบวนการโดยแจ้งปัญหาที่ต้องการให้ซ่อมแซม', '#ff0000', 1),
(2, 'Supervisor Approve', 'หัวหน้างานอนุมัติ', 'คำขอซ่อมถูกส่งไปยังหัวหน้าของผู้ใช้เพื่อตรวจสอบและอนุมัติ', '#9900ff', 1),
(3, 'Under Repair', 'ดำเนินการซ่อม', 'แผนกที่รับผิดชอบการซ่อมเริ่มดำเนินการแก้ไขปัญหา', '#0000ff', 1),
(4, 'Engineer Approve', 'วิศวกรรม อนุมัติ', 'หลังจากซ่อมเสร็จ หัวหน้าแผนกซ่อมจะตรวจสอบและอนุมัติ', '#ff9900', 1),
(5, 'Complete', 'เสร็จสมบูรณ์', 'กระบวนการซ่อมทั้งหมดเสร็จสมบูรณ์และได้รับการยืนยัน', '#1A5D1A', 1),
(6, 'Reject', 'ไม่อนุมัติ', 'ไม่ได้รับการอนุมัติซ่อม', '#B80000', 1),
(7, 'Cancel', 'ยกเลิก', 'คำขอซ่อมถูกยกเลิก ไม่ดำเนินการต่อ (อาจเนื่องจากไม่จำเป็นหรือเหตุผลอื่น)', '#000000', 1);

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `id` int NOT NULL,
  `name` varchar(255) DEFAULT NULL COMMENT 'ชื่อทีม',
  `team_header` int DEFAULT NULL COMMENT 'หัวหน้าทีม',
  `team_role` int DEFAULT NULL COMMENT 'บทบาท',
  `team_user` text,
  `team_email` varchar(255) DEFAULT NULL COMMENT 'อีเมลทีม',
  `api` varchar(255) DEFAULT NULL COMMENT 'API',
  `active` int DEFAULT '1' COMMENT 'สถานะ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`id`, `name`, `team_header`, `team_role`, `team_user`, `team_email`, `api`, `active`) VALUES
(1, 'ทีมแรก', 32, 2, NULL, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `team_roles`
--

CREATE TABLE `team_roles` (
  `id` int NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `color` varchar(45) DEFAULT NULL,
  `ref` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COMMENT='บทบาท';

--
-- Dumping data for table `team_roles`
--

INSERT INTO `team_roles` (`id`, `name`, `color`, `ref`) VALUES
(1, 'ช่างเทคนิค', NULL, NULL),
(2, 'หัวหน้างาน', NULL, NULL),
(3, 'หัวหน้าแผนก', NULL, NULL),
(4, 'ผู้จัดการแผนก', NULL, NULL),
(5, 'ไอที', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `technician`
--

CREATE TABLE `technician` (
  `id` int NOT NULL,
  `ref` varchar(45) DEFAULT NULL COMMENT 'รหัส',
  `user_id` int DEFAULT NULL COMMENT 'ผู้ใช้งานในระบบ',
  `thainame` varchar(255) NOT NULL COMMENT 'ชื่อ-สกุล',
  `role_id` int NOT NULL COMMENT 'บทบาท',
  `tel` varchar(45) DEFAULT NULL COMMENT 'เบอร์โทร',
  `email` varchar(255) DEFAULT NULL COMMENT 'อีเมล',
  `api` varchar(255) DEFAULT NULL COMMENT 'API',
  `active` enum('yes','no') DEFAULT 'yes'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `technician`
--

INSERT INTO `technician` (`id`, `ref`, `user_id`, `thainame`, `role_id`, `tel`, `email`, `api`, `active`) VALUES
(1, 'NFC-0006', 23, 'สุพจน์ ช่างฆ้อง', 3, '26', 'sam47290800@gmail.com', '1', 'yes'),
(2, 'NFC-0060', 32, 'ณัฐพล ขันเขียว', 2, '26', 'sam47290800@gmail.com', '1', 'yes'),
(3, 'NFC-0117', 33, 'คมสันต์ สมบูรณ์ชัย', 1, '26', 'sam47290800@gmail.com', 's', 'yes'),
(4, 'NFC-0030', 31, 'มานพ ศรีจุมปา', 1, '26', 'sam47290800@gmail.com', '1', 'yes'),
(5, 'NFC-0129', 34, 'สราวุฒิ โฆษิตเกียรติคุณ', 1, '26', 'sam47290800@gmail.com', '2', 'yes'),
(6, 'NFC-0134', 35, 'สุเทพ ปวงรังษี', 1, '26', 'sam47290800@gmail.com', '2', 'yes'),
(7, 'NFC-0152', 24, 'สุริยา สมเพชร', 4, '26', 'sam47290800@gmail.com', '8', 'yes'),
(8, 'NFC-0269', 25, 'ยศพนธ์ โพธิ', 1, '26', 'sam47290800@gmail.com', '1', 'no'),
(9, ' NFC-0314', 38, 'ภาณุวัฒน์ ยางรัมย์', 1, '26', 'sam47290800@gmail.com', '1', 'yes'),
(10, 'NFC-0363', 168, 'วีรภัทร พุฒซ้อน', 1, '26', 'sam47290800@gmail.com', '1', 'yes'),
(11, 'NFC-0404', 149, 'กฤษณพงศ์ กิ่งชา', 1, '26', 'sam47290800@gmail.com', '4', 'yes'),
(12, 'NFC-0268', 12, 'ธีรพงศ์ ขันตา', 5, '31', 'sam47290800@gmail.com', '1', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `ticket`
--

CREATE TABLE `ticket` (
  `id` int NOT NULL,
  `ticket_group` int DEFAULT '1' COMMENT 'กลุ่มงาน',
  `ticket_code` varchar(45) DEFAULT NULL COMMENT 'รหัส',
  `ticket_date` varchar(45) DEFAULT NULL COMMENT 'วันที่ต้องการ',
  `broken_date` varchar(45) DEFAULT NULL COMMENT 'วันที่เสีย',
  `title` varchar(255) DEFAULT NULL COMMENT 'หัวข้อ',
  `description` text COMMENT 'รายละเอียด',
  `priority_id` int NOT NULL DEFAULT '1' COMMENT 'ผลกระทบ',
  `location` varchar(45) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL COMMENT 'สถานที่',
  `remask` varchar(255) DEFAULT NULL COMMENT 'หมายเหตุ',
  `request_by` varchar(255) DEFAULT NULL COMMENT 'ผู้ร้องขอ',
  `created_at` varchar(45) DEFAULT NULL COMMENT 'วันที่บันทึก',
  `approve_name` varchar(255) DEFAULT NULL COMMENT 'ผู้อนุมัติ',
  `approve_date` varchar(45) DEFAULT NULL COMMENT 'วันที่อนุมัติ',
  `approve_comment` text COMMENT 'ความคิดเห็นผู้อนุมัติ',
  `status_id` int DEFAULT '1' COMMENT 'สถานะ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `ticket`
--

INSERT INTO `ticket` (`id`, `ticket_group`, `ticket_code`, `ticket_date`, `broken_date`, `title`, `description`, `priority_id`, `location`, `remask`, `request_by`, `created_at`, `approve_name`, `approve_date`, `approve_comment`, `status_id`) VALUES
(1, 1, 'RP-6803-0003', '2025-03-07', '2025-03-07', 'เครื่องห้องไอน้ำเสีย', 'มีรอยรั่วบริเวณท่อด้านหลัง', 3, 'อาคารหม้อไอน้ำ (Boiler)', NULL, 'ณัฐพล ขันเขียว', '2025-03-21', 'ผู้ดูแลระบบ', '2025-04-04', 'ให้ประเมิณราคาก่อนซ่อม', 2),
(2, 1, 'RP-6803-0004', '2025-03-20', '2025-03-07', 'กล้องวงจรปิดป้อมยามดูไม่ได้', 'เดินสายใหม่', 1, 'อาคารน้ำดิบและน้ำซอฟท์', NULL, 'กฤษณพงศ์ กิ่งชา', '2025-03-21', 'ธีรพงศ์ ขันตา', '2025-03-26', NULL, 7),
(3, 2, 'RP-6803-0005', '2025-03-21', '2025-03-07', 'ทดสอบ 1', 'ทดสอบ 1', 1, 'อาคาร B4 ส่วนคั้น', 'ต้องรอหลังการผลิต', 'จิรโรจน์ ทองเทพ', '2025-03-31', NULL, NULL, NULL, 1),
(4, 1, 'RP-6803-0006', '2025-03-22', '2025-03-07', 'คอมพิวเตอร์ใช้งานไม่ได้', NULL, 2, 'ห้องจัดซื้อ', NULL, 'ชลธี ลือเลิศ', '2025-03-20', NULL, NULL, NULL, 3),
(5, 2, 'RP-6803-0007', '2025-03-24', '2025-03-07', 'แอร์เสีย', NULL, 2, 'ห้องจัดซื้อ', NULL, 'ณัฐวัฒน์ วรรณราช', '2025-03-20', NULL, NULL, NULL, 4),
(6, 1, 'RP-6803-0008', '2025-03-21', '2025-03-21', 'แอร์เสีย', 'มีน้ำหยด', 1, 'ห้องบัญชี', NULL, 'ธีรพงศ์ ขันตา', '2025-03-26', 'ธีรพงศ์ ขันตา', '2025-03-26', NULL, 6),
(7, 2, 'RP-6803-0001', '2025-03-26', '2025-03-26', 'คอมเปิดไม่ติด', 'คอมเปิดไม่ติดคอมเปิดไม่ติดคอมเปิดไม่ติด', 1, 'ห้องแผนกผลิต', NULL, 'รัศมี ศศิยศพงศ์', '2025-03-26', 'ธีรพงศ์ ขันตา', '2025-03-26', NULL, 5),
(8, 1, 'RP-6804-0001', '2025-04-04', '2025-04-04', 'กล้องวงจรปิดป้อมยามดูไม่ได้', 'sasasdasd', 1, 'ห้องควบคุมคุณภาพ', 'asasdasd', 'ยศพร พยัคฆญาติ', '2025-04-04', NULL, NULL, NULL, 1),
(9, 1, 'RP-6804-0002', '2025-04-04', '2025-04-04', 'แอร์เสีย', 'dsfsdfsdf', 1, 'ห้องบัญชี', NULL, 'ผู้ดูแลระบบ', '2025-04-04', NULL, NULL, NULL, 1),
(10, 1, 'RP-6804-0003', '2025-04-04', '2025-04-04', 'eewwerwer', 'werwerwerwer', 1, 'อาคาร B4 ส่วนกรอง', 'หกดหกดหกดหกดหกดห', 'ผู้ดูแลระบบ', '2025-04-04', NULL, NULL, NULL, 1),
(11, 2, 'RP-6804-0004', '2025-04-04', '2025-04-04', 'werwerwee', 'erwewerwe', 1, 'อาคาร B4 ส่วนกรอง', NULL, 'ยศพนธ์ โพธิ', '2025-04-04', 'ผู้ดูแลระบบ', '2025-04-04', 'กกกกกกกกก', 2);

-- --------------------------------------------------------

--
-- Table structure for table `ticket_group`
--

CREATE TABLE `ticket_group` (
  `id` int NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `color` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `ticket_group`
--

INSERT INTO `ticket_group` (`id`, `name`, `color`) VALUES
(1, 'วิศวกรรม', '#493D9E'),
(2, 'ไอที', '#F26B0F');

-- --------------------------------------------------------

--
-- Table structure for table `ticket_list`
--

CREATE TABLE `ticket_list` (
  `id` int NOT NULL,
  `ticket_code` varchar(45) NOT NULL,
  `details` varchar(255) NOT NULL,
  `remask` varchar(255) DEFAULT NULL,
  `location` int NOT NULL,
  `ticket_date` varchar(45) DEFAULT NULL,
  `quantity` int DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `uploads`
--

CREATE TABLE `uploads` (
  `id` int NOT NULL,
  `ref` varchar(255) DEFAULT NULL,
  `file_name` varchar(255) DEFAULT NULL,
  `real_filename` varchar(255) DEFAULT NULL,
  `last_updated` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `uploads`
--

INSERT INTO `uploads` (`id`, `ref`, `file_name`, `real_filename`, `last_updated`) VALUES
(52, 'NFC-0060', '0060.png', '8bf2fea2bce34b6cf053dc25c47e4a7e.png', '2025-02-28 04:00:52'),
(53, 'NFC-0117', '0117.png', '0749e81ef7f9e79a10eabfd1f101a2df.png', '2025-02-28 04:01:38'),
(54, 'NFC-0006', '0006.png', '27001ddfeb03eb982047eea91f73ef44.png', '2025-02-28 03:59:09'),
(55, 'NFC-0030', '0030.png', 'b7ecb0e2553dbf80c311a2ce98bf91e5.png', '2025-02-28 04:03:18'),
(56, 'NFC-0129', '0129.png', '0f95c96bc15988876727314fd9a680c2.png', '2025-02-28 04:04:47'),
(57, 'NFC-0134', '0134.png', '53104d90fd3b06fd58a4844c2dc16372.png', '2025-02-28 04:05:24'),
(58, 'NFC-0152', '0152.png', '4b2a05e3c95309dc2adcdffe33410ed3.png', '2025-02-28 04:07:01'),
(60, 'NFC-0269', 'NFC-0269.png', '9cc4765e3d18d090338aecd400be5be0.png', '2025-03-03 01:50:50'),
(63, 'NFC-0363', '3.png', '9f33b2088a54fb5cc66b4c3660c261fc.png', '2025-03-03 01:57:13'),
(64, ' NFC-0314', '4.png', '5f4d968707e4ee6efe80a3f2054d0bb7.png', '2025-03-03 01:57:24'),
(65, 'NFC-0404', '2.png', '9708cc7cc4d39902864d0fe2ffa01141.png', '2025-03-03 01:58:14'),
(66, 'NFC-0268', 'NFC-0268.png', '8c4decb50cb5c5a4a8dd7bc5337552fb.png', '2025-03-03 01:59:58'),
(74, 'nfc0243', 'NFC-0269.png', '769d98a80b2ea8921a508bd959eaf68f.png', '2025-03-03 15:37:43'),
(85, 'RP-6803-0004', '.trashed-1742482559-IMG_20250218_181018.jpg', 'd25ff27f3ffab1a46eb3df0dd3a12a90.jpg', '2025-03-26 07:05:40'),
(90, 'RP-6803-0006', '19-2-2568 10-27-48.png', '86c55164b91f1a3ec6d36780c6017c18.png', '2025-03-26 07:05:38'),
(93, 'RP-6803-0007', 'check-server.png', 'e39e1b1c3047f5bcb74f8e63661a61d8.png', '2025-03-26 07:05:37'),
(94, 'RP-6803-0008', 'ใบสั่งซ่อม.pdf', 'ab34f9ff47bdbec4034f55cb95a70b63.pdf', '2025-03-26 07:05:35'),
(96, 'RP-6803-0004', '1817_0.jpg', '91576d8caaa101b0cfccb8638331e94e.jpg', '2025-03-26 07:05:33'),
(97, 'RP-6803-0004', '1818_0.jpg', 'bf65b63b91b4d40de6615a8a45ad22f3.jpg', '2025-03-26 07:05:32'),
(100, 'RP-6803-0003', '3.png', '63c40a1a89ed88afb7e7b785b14f5cfb.png', '2025-03-26 07:05:29'),
(101, 'RP-6803-0003', 'S__13877366.jpg', '669d6d124e3af1c9a2eacb7f17468e2e.jpg', '2025-03-26 07:05:28'),
(103, 'RP-6803-0001', 'fa01.png', 'fc04e1ff6bae345478d6697e7f88085e.png', '2025-03-26 06:34:30'),
(104, 'RP-6803-0008', '323914_0.jpg', 'a0527a2e419f145188243522ca00fd82.jpg', '2025-03-26 07:05:26'),
(105, 'RP-6803-0005', '_e21a05dd-0b4c-48ba-ac7a-4228067d91ef.jpg', '79c9a9230d130c18372ceaeb3d21cffd.jpg', '2025-03-26 07:05:24'),
(108, 'RP-6804-0002', 'wfh.jpg', 'c3b0399f592cf724054e70aea4fe7ab1.jpg', '2025-04-04 08:56:06'),
(109, 'RP-6804-0001', 'branch.jpg', 'faa4bb33a27169d8e740049c8dea09c4.jpg', '2025-04-04 08:56:19'),
(110, 'RP-6804-0003', 'check-server.png', '8c3d81473092c1ffe00a605e39ea5a37.png', '2025-04-04 08:56:45'),
(111, 'RP-6804-0004', '19-2-2568 10-27-48.png', '1947647f27033bc75069099aa9b44ac0.png', '2025-04-04 08:57:08');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `username` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `thai_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL COMMENT 'ชื่อ-สกุล',
  `auth_key` varchar(32) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `password_hash` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `status` smallint NOT NULL DEFAULT '10',
  `created_at` int NOT NULL,
  `updated_at` int NOT NULL,
  `verification_token` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `role_id` int NOT NULL DEFAULT '1',
  `rule_id` int DEFAULT '1',
  `department_id` int DEFAULT '1',
  `employee_id` int DEFAULT NULL COMMENT 'พนักงาน'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `thai_name`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`, `verification_token`, `role_id`, `rule_id`, `department_id`, `employee_id`) VALUES
(1, 'admin', 'ผู้ดูแลระบบ', 'RMXJucsh-8q4gUpnGIgV9S6EE1yqr8hH', '$2y$13$Rv/I/kYVF7Vvnnn.BHkSZ.WsptGCymva6LygzWf7dHpWOkkd2vr/O', NULL, 'admin@admin.com', 10, 1689666356, 1731643869, 'SA3gozOob2BBbQR0Ue5t4mJQpoyb0gcp_1689666356', 2, 2, 1, NULL),
(2, 'demo', 'ทดสอบระบบ', 'lJsMEFiO-XjqJrVhH2aDcjXyrP0oC0vy', '$2y$13$FTH70yBz0GJxYjqxnfMlJe2K8BT5gyHrWrTlAXQnWLCJTItzzI4hq', NULL, 'demo1@demo.com', 10, 1689756005, 1718934956, 'sfLH5psKTa0wMf7dH-kiSrkNcSPqn9OD_1689756005', 1, 1, 1, NULL),
(3, 'nfc0252', 'อรอนงค์ ชมภู', '2bj5VmZ1PEwJDerqRsj3fhE8i2zvsVZq', '$2y$13$hEUbvEkVgPTEerqDI4NNceeS4llpCbNa8U2vl4cWgWL.uCqCYzYMO', NULL, 'chumphu2538@gmail.com', 10, 1689759317, 1733885129, '9NqfkSJcx8KkIodMLNCeH9HLqhOUmcxw_1689759317', 1, 11, 3, 71),
(4, 'phitchai', 'พิชญ์ชัย พิชญ์ชานุวัฒน์', 'yJwBMulOJv3IDmDkCXrdYZ-VMEw_zwLZ', '$2y$13$Q.1smIJmmAJ28OJ9v2F1wupBzXmYum8Fx79DgyBozTi8OoGNx03Lq', NULL, 'qc.northernfoodcomplex@gmail.com', 9, 1689759339, 1726471507, '4Zgy1uVGJvXg2nZOAHcFCSj0NK0Ll3Ze_1689759339', 4, 8, 3, 109),
(5, 'nfc0021', 'ประกายวรรณ เทพมณี', 'y2RYhV3E1NG68CUaa8svzBknRdbCTO79', '$2y$13$AS9Nsc8QkGNWntz6r0BAeeFbb06kWJxFKaW3TLCEuydAAQNZdDhQq', NULL, 'prakaiwan4213@gmail.com', 10, 1689759362, 1733885118, '2qNZk71gb01_K-bdCiscD38z36G9exZH_1689759362', 5, 3, 3, 23),
(6, 'sale', 'ฝ่ายขาย', 'EHSvx6uElywR8fG2XRQ_xKE4sups-8cO', '$2y$13$1WNsYNf4h/2D0rSNWJCRyO3Qz6kUPplmKaFLdvS8eWhjbLZ0H1Dxa', NULL, 'sale@nfc.com', 10, 1689759388, 1718935013, '9ZnxmSRzPpvLgxD0MPSamdokpcp_eMul_1689759388', 12, 7, 12, NULL),
(7, 'supanee', 'สุพาณี ธีรวราภรณ์', 'JWT4BgIkYF4TIN62mLaKv5iL0uLMn7C9', '$2y$13$UNrqeeW2ktMyl17tzJd0FOsDjfmg6ukI.NmJ/io6IUVsMvilpROEC', NULL, 'sale-export@northernfoodcomplex.com', 10, 1689759413, 1729742756, '7xCjBXE9xNLx1gWqKX2LaVex2ah0IWt4_1689759413', 12, 15, 12, NULL),
(8, 'adisak', 'เอก', 'FjE8vrSWJ1uVTanpvQJDnpq_OiUySrzg', '$2y$13$9A8b1R/ZpQLY0bQHMkOWceid20ePbM45Sl6FhJyNH6xCDQTWqbhoq', NULL, 'sale@northernfoodcomplex.com', 10, 1689759430, 1729495461, 'qNJ-e9RkWlfqvHqmvmSsItU1rlpb_D3j_1689759430', 1, 1, 12, NULL),
(9, 'nfc0256', 'วรรษรา หลวงเป็ง', 'XEPSPmb7Bt0oI_tklPUc5Uh4Jq4HM4Ig', '$2y$13$GutMY6i5TkU4LR22nW4F6eqfGNvN7QrNBtUMDWri7x.uRfHuaEicW', NULL, 'watsara.nfc@gmail.com', 10, 1690430330, 1733885109, 't1iesBNA9TNHWotQHvGzbLCVhrK6LF9O_1690430330', 5, 3, 7, 74),
(10, 'somsak', 'สมศักดิ์ ชาญเกียรติก้อง', '3tiUcswenYgRTZTfuvfv_Tv4V7BXwAcn', '$2y$13$5WPiO4JsFvfx2rgYibsRt.A/TLCCyK6bb3BG4zFXwXXKhIsMKo.nW', NULL, 'somsak@northernfoodcomplex.com', 10, 1691631165, 1731997917, 'Pj5G3y6R8VeykAb0cyXVIHChtnlpquo9_1691631165', 3, 14, 1, 183),
(11, 'peeranai', 'พีรนัย โสทรทวีพงศ์', 'G3b3XCgv3uFzzly7jDX0cJXzNm45qoUV', '$2y$13$d4ClcgC/8v5LTfBmy4YBy.WKM99qLBlWJ14VaKwcCFyUhAFZRmzr2', NULL, 'peeranai@northernfoodcomplex.com', 9, 1691631423, 1733885088, 'HmjAFfcWByo3VbwpZDD9qeBA-shqds8q_1691631423', 3, 3, 1, 1),
(12, 'nfc0268', 'ธีรพงศ์ ขันตา', 'tWXwJZ5JEXbWCN0M-0zpCouAUJcL5BwZ', '$2y$13$zaGsUkZ/2mw8d6kSyWjcwuwn/XPvWoazR3Mno1FvuirJMfIG3NSMa', NULL, 'theerapong.khan@gmail.com', 10, 1691639318, 1733885076, NULL, 2, 2, 11, 79),
(13, 'nfc0243', 'ชลธี ลือเลิศ', 'EOXd5DKbM2Jcs6aK9sD62YxeP7VboVhg', '$2y$13$CMtQYCcZxWf2P498kxI/GO400C2JGeA7udRrVPXwWbfsLt5KuEKiS', NULL, 'chonlatee.l@local.com', 10, 1699687514, 1733885056, NULL, 1, 1, 2, 68),
(14, 'yosaporn', 'ยศพร พยัคฆญาติ', 'GOI-0AQj0nAYGBIpppuSe-O3IK4OSs2h', '$2y$13$ZCmZnp7eh/d8H0F9NK9moeWQuHQnzADdRqH.hDcl9rDRnP5QGB0ZK', NULL, 'ypayakayat@yahoo.com', 10, 1692180393, 1733885135, NULL, 4, 3, 4, 5),
(15, 'nfc0027', 'สาวิกา พินิจ', 'GOI-0AQj0nAYGBIpppuSe-O3IK4OSs2h', '$2y$13$Od8Mxpz53Luz1ecWoVOgw.3BaTG5i42B9r1HQ38gQTXBc0gVmDX7e', NULL, 'sawika_pinit@yahoo.co.th', 10, 1692180393, 1733885039, NULL, 4, 3, 2, 26),
(16, 'nfc0183', 'เปรมมิกา พินิจ', 'GOI-0AQj0nAYGBIpppuSe-O3IK4OSs2h', '$2y$13$WQhSCj/010cimU5nGh/drualXKBR08OHFRt1p1VtKxdx3iOfvcGbC', NULL, 'pinit@yahoo.co.th', 10, 1692180393, 1733885030, NULL, 7, 5, 4, 47),
(17, 'nfc0148', 'ชาริณี จันต๊ะนาเขต', 'wLQMbhfIHnG07ZHdPZA2IGb5JfIWjm37', '$2y$13$9yV4IMEH4Drr1qJx1lCLuewj4KtnL3f30wmUAHX/6AajcWuASbr.a', NULL, 'charinee@localhost.com', 10, 1698800364, 1733885019, NULL, 1, 13, 3, 42),
(18, 'nfc0205', 'เบญจรัตน์ คงชำนาญ', '-WVnwHhiOWQdUJ3KYypIVVJ1WgFO_NUv', '$2y$13$j0znACt7Z7vh7x0zelELGu2RTmoahJd5dXarZU1/RU.aqy5w9.Aru', NULL, 'khongchanan1996@gmail.com', 10, 1698800565, 1733885010, NULL, 1, 13, 3, 55),
(19, 'nfc0203', 'ณัฐวัฒน์ วรรณราช', 'Kb6gw6VW_6c9O_CAnGJPnhsX85rF9zyx', '$2y$13$KQ/AqOzBxXl847hvbYj7vO5qxzDmRr6RoLXpJRRQT3EU24bu31WYq', NULL, 'coi.northernfoodcomplex@gmail.com', 10, 1698800639, 1733885002, NULL, 1, 1, 3, 54),
(20, 'thaksin', 'ทักษิณ อินทรศิลา', 'TZGAEflaZm143CsHlFjJZMMYZdKQeMVE', '$2y$13$BwKpULbKpy7h4gpHinfdJelEu3LEtHGC.mEKhvZWmD1HJlThpFuuq', NULL, 'notethaksin@hotmail.com', 9, 1698800733, 1726471621, NULL, 4, 3, 5, 4),
(21, 'nfc0159', 'ชฎาภรณ์ แก้วคำ', '7HasNWHP_M5-W_fBPDKb1M_0sXyd2Dsc', '$2y$13$g8.Zhkyg3Zm8b3DpafdV3uXwx9OjqCgpXdAIKRKHtGZmCDaXdpeDq', NULL, 'kaewkhamchadaporn@gmail.com', 10, 1698801098, 1733884994, NULL, 7, 5, 5, 44),
(22, 'araya', 'อารยา เทพโพธา', 'iOtjB0XK4SiRHsuOwg_vudd0epMz0wHW', '$2y$13$KmrrWVQnvVcsZunR7uS6y.u6V2wflU5YTuvlxteIBkyZp1WwdbfOa', NULL, 'araya.thep@gmail.com', 10, 1698801169, 1733884979, NULL, 4, 3, 6, 6),
(23, 'nfc0006', 'สุพจน์ ช่างฆ้อง', 'vGAi-pbCSZLcDRzbxOZ5w9sPllCdSFQq', '$2y$13$IZV6NngWZa/g4ogNKMLl6OoOx8xPeuAdXFauSbD7TwdoLoLuHLeHu', NULL, 'changkhong.8777@gmail.com', 10, 1698801231, 1733884971, NULL, 6, 5, 10, 11),
(24, 'nfc0152', 'สุริยา สมเพชร', 'BACKO9VW3y79pLaoZvOiQtX3OWZzuDQI', '$2y$13$VgMP2eW7RgkppYqmPze6Ne9YJ376u/m/6Yp2//ELDOgTuD7.7iaMS', NULL, 'suriyasompatch@gmail.com', 10, 1698801309, 1733884948, NULL, 4, 3, 10, 43),
(25, 'nfc0269', 'ยศพนธ์ โพธิ', 'wmyXWYgzYvewSqTMmgf9CFDD_ryIM5nl', '$2y$13$unBiLDwUgvEw2L0BUhX0iuq0KI1VLrtQYAGS7sB/m1tpfkrCvLsOm', NULL, 'yotsapon@localhost.com', 10, 1698801387, 1733884934, NULL, 11, 4, 10, 80),
(26, 'nfc0318', 'ศุทธหทัย ชูกำลัง', 'LFeQidH3yohyJ3Qc1MOKuZJm27IAZFH0', '$2y$13$CrCgHC5Poir1HDRimLbfq.4XpHCjoWrlzXp0X7RzGVtpcFv46jRV2', NULL, 'rd.northernfoodcomplex@gmail.com', 10, 1698801460, 1733884923, NULL, 7, 5, 9, 110),
(28, 'nfc0214', 'จิราภรณ์ กาบแก้ว', 'w0GFJQICSa2Ad9453hYPNUMf6Svm1WdX', '$2y$13$GhY9QnKqXn27v/dwjX7OLen1xn3MYmfNi.zp2Wp2nwonjW79aygwW', NULL, 'planning@northernfoodcomplex.com', 10, 1698801621, 1733884912, NULL, 7, 5, 13, 59),
(29, 'taweekiat', 'ทวีเกียรติ คำเทพ', 'tjJu-rUAKYmyXN6v5wZxaESahe2EYKwx', '$2y$13$Jv9fDurwLELQkAnnEL2Ls.64nAqleP/Ys0/zuFfcDbVVSgrQWo0fe', NULL, 'd.taweekiat@gmail.com', 9, 1698801681, 1726471516, NULL, 4, 3, 8, 82),
(30, 'nfc0326', 'กุลธร ดอนมูล', 'qD0mmuOHZ6ZNXs81dppLg3VBB1fQTrcn', '$2y$13$omXboTzw6NJurBhhugyxme2sMCAvkMScgwoQalWftEY0U9yD7rEkG', NULL, 'pd03.nfc@gmail.com', 10, 1698801766, 1733884901, NULL, 11, 4, 8, 115),
(31, 'nfc0030', 'มานพ ศรีจุมปา', 'skTB0VTY-7RcVfokMQRjtZjsic0xFo5e', '$2y$13$NlSh/RqL96l7xsRJ2nki8ONDG4Y.xUomX0l2XbMjn479pSRonmM1u', NULL, 'manop.s@local.com', 10, 1699672763, 1733884893, NULL, 1, 1, 10, 28),
(32, 'nfc0060', 'ณัฐพล ขันเขียว', 'agve9wCBQNQsnst59xpLAFBW6Cq7IRLd', '$2y$13$aWrn/5Ct0dcudX9T3IbkyuGjIfc2RKMTNqGJlVkahtpKWpeHQ1bqu', NULL, 'natthaphon.k@local.com', 10, 1699672822, 1733884885, NULL, 8, 6, 10, 34),
(33, 'nfc0117', 'คมสันต์ สมบูณ์ชัย', 'qm1hqRc6dLA5L6_UtbmUl1TLAd_D7x9S', '$2y$13$ZEunVYedHX2yIXIiPBEHmu0NaqF.VnHvO/rD6mu.LH5PAKyJihVvC', NULL, 'komsan.s@local.com', 10, 1699672864, 1733884875, NULL, 1, 1, 10, 38),
(34, 'nfc0129', 'สราวุฒิ โฆษิตเกียรติคุณ', '5_HL5jD2jOAGgRMlzrCGje_mnMVAwrM2', '$2y$13$ojp8tqYeIL34PL.XbfPVMeDdlFFwwXlHLVtlhD77GnEkTq9kdPc7K', NULL, 'sarawut.k@local.com', 10, 1699673427, 1733884865, NULL, 1, 1, 10, 39),
(35, 'nfc0134', 'สุเทพ ปวงรังษี', '4ZC6I_pSHZUeKxy0bTWJVJ5OoBU3tyaG', '$2y$13$iAl9GY/Jzhq38mKQFNq0WOxzRmf45jZqIrbVSSjltCZIYsByyKYou', NULL, 'sutap.p@local.com', 10, 1699673470, 1733884856, NULL, 1, 1, 10, 40),
(36, 'jadsakorn', 'เจษกร คำวรรณ์', 'UpcQnJlQ5ym-tl4ln6RR9lncaVqNEDeE', '$2y$13$elUuASkqoaFpcj4XH8OCE.evOp0652TKPRpayG5e2V2ObS0Wh38eq', NULL, 'jadsakorn.k@local.com', 9, 1699673508, 1727062980, NULL, 1, 1, 10, 53),
(38, 'nfc0314', 'ภาณุวัฒน์ ยางรัมย์', 'KlXe_M-3gpwuMycTgSa3b2cHG4sszYbu', '$2y$13$hiPuDOYvykWVhMw6quaMj.hHs/ZD36K1SODMuTJbXkrl/yuhJv/aa', NULL, 'panuwat.y@local.com', 10, 1699673713, 1733884846, NULL, 1, 1, 10, 107),
(39, 'nfc0108', 'รัศมี ศศิยศพงศ์', 'ZwwiwqfFPKF3Qyw0RCufsRwieogeqkKA', '$2y$13$oa1V1dCgr40fefJCmeD0zujwfiUiXVWe/tJkHy9oPgQXssi1TKII6', NULL, 'ratsamee.s@local.com', 10, 1699684280, 1733884836, NULL, 1, 1, 2, 36),
(40, 'nfc0329', 'กาญจน์ประภา ไพยราช', 'WDv33rQp0vRaL5mKrkznfJ268027UF5a', '$2y$13$AHvOe2Rx1AJonk.UBWdC4.MsbL78U4Rt3tqRaZUj7ai4ZbFWjaefq', NULL, 'kanprapha.p@local.com', 10, 1699684322, 1733884828, NULL, 1, 1, 2, 118),
(41, 'nfc0258', 'ชนิกา เรือนมูล', 'sA-NLySBUOSDB8XSWsh1AqoCQrKjroAX', '$2y$13$lIAwUy/i1ZeMyTqG6B2GQ.YB59WhBunZYLRZ0pxhqZCk2TTtugLwm', NULL, 'chanika.r@local.com', 10, 1699684367, 1733884818, NULL, 1, 13, 3, 75),
(42, 'nfc0263', 'ธัญญารัตน์ นิ่มวงษ์', 'BAPZkF-0tqu3qK6uVtDff5FZwWHby_lY', '$2y$13$EjgmRgwDbMZPZ67NkSX4rORh5SoWIARYhm3hh8tMJuUjHBLzr81b.', NULL, 'tanyarat.n@local.com', 10, 1699684417, 1733884809, NULL, 1, 1, 4, 77),
(43, 'nfc0046', 'กรรณิกา คำภีระ', 'ggE1RcJqk0OyaVS9mj-zB8J37fqtvbq7', '$2y$13$VvkrGgOXdOAxXpQNiR7xx./xE6AFS0bqhTuD1GjdNOZaXu/mjDGwC', NULL, 'kannika.k@local.com', 10, 1699684493, 1733884801, NULL, 1, 1, 6, 32),
(44, 'nfc0312', 'ศศิชา นัตสิทธิ์', 'haaNM8Y3gwJCsL2RvvpP7RioUNVkLCoy', '$2y$13$NrcAqThvJYzyrKvA60FdUOmx..YJ6ZM/l4p9bEUUWayh99QYKJ67W', NULL, 'sasicha.n@local.com', 10, 1699684519, 1733884792, NULL, 11, 12, 5, 106),
(45, 'pranee', 'ปราณี แดงโคตร', 'fxatETyZYQcw4G9WLuk2DeD6tigRLSpx', '$2y$13$FO383fbroT26IGpfszXMeOHS34ynJIZCCBRmMbq8snhFHVwzgyii2', NULL, 'pranee.d@local.com', 9, 1699684567, 1726931091, NULL, 11, 12, 5, 52),
(46, 'nfc0246', 'กุลนิษฐ์นรี เจริญจิตรวี', 'xbVfqgX0yJppq1rvKaczeuystm7HWTRr', '$2y$13$Yq8TYriw3klQA6nheRU6Iu.pmICuL0Fw8p3PAWkInoG1jT.E245/6', NULL, 'kullanisnaree.c@local.com', 10, 1699684607, 1733884780, NULL, 1, 1, 8, 70),
(47, 'nisarat', 'นิศารัตน์ คำขัด', '6qWMOvel4G-Fd9yAcmJFuP60dIxGDvYo', '$2y$13$bfM4SCN1ldNnHouY9WtR2eRQz4cnX1vX3P0VXrYcezwOx6fPFogsi', NULL, 'nisarat.k@localhost.com', 9, 1699684659, 1727062884, NULL, 6, 5, 8, 112),
(48, 'nfc0007', 'บุญส่ง เสียงใหญ่', 'wOK4AATzCwJIwVr0fAC3KpJwsvS6Xjno', '$2y$13$k1ntW4SxTzwI/ehx.opYnu/4WH4GHEwhWCtfiF1LMJwO10Td2e/Tm', NULL, 'boonsong.s@local.com', 10, 1699684807, 1733884770, NULL, 1, 1, 5, 12),
(49, 'nfc0213', 'สมชาติ พิจุมปู', 'uPey51SyvEKmcVMhoGVpYk7u4jkOL3dt', '$2y$13$soGzwEa3TlOHCaLTG7Gcv.fTBIrBhyKKPtc14OFc71Gohlk2qi5Mm', NULL, 'somchat.p@local.com', 10, 1699684842, 1733884759, NULL, 1, 1, 5, 58),
(50, 'nfc0266', 'มานะ คำเป็ง', 'QUNckltEY9HOcWtsAjD-FV5SIS1F9EQP', '$2y$13$bQDAVfG6sez5zUZgCX/CD.3m5jHz0K61G/u8tcMqOv6/hkOxLk2d2', NULL, 'mana.l@local.com', 10, 1699684865, 1733884698, NULL, 1, 1, 5, 78),
(51, 'nfc0015', 'สงกรานต์ พรมจักร์', 'nVXtegNye3Vc7vG4fs9plrF2C4Me6cMe', '$2y$13$0eHBr/0rfJqmESwnVV7gLON6mtkjOkkZGUX8xBiS1f3iRB81gNfyq', NULL, 'songkarn.p@local.com', 10, 1699684934, 1733884688, NULL, 1, 1, 8, 20),
(52, 'nfc0016', 'สนอง เสียงใหญ่', 'dibJ2WhwtBhspSNDG8YrdNlq2PV0gn14', '$2y$13$R4xMNwn/hXGmYrb3TpzXzO2yt4vm3WmsndNYY2sNsxqH.VbzPIvhq', NULL, 'sanong.s@local.com', 10, 1699684958, 1733884676, NULL, 8, 6, 8, 21),
(53, 'nfc0032', 'กัมพล สิงห์แก้ว', '8AQqEtzYHPxTol0oCpW3cs2aM80rWTZa', '$2y$13$BI0.Nq0wqq8LnV6ArcD3I.sCazP1C74zxXWqtOSlXK1fFFwHpFTH.', NULL, 'kampon.s@local.com', 10, 1699684984, 1733884661, NULL, 1, 1, 8, 29),
(54, 'nfc0191', 'บุญยัง ม้าแก้ว', 'OdkiGuMQ2nulHBhvROue3jLuXSH7SpU6', '$2y$13$0t0d8r2mTDhMWto3KArEw.o6CnfTrfxoLTlmnm4k30Q24ij4JqXjC', NULL, 'boonyung.m@local.com', 10, 1699685010, 1733884653, NULL, 1, 1, 8, 51),
(55, 'natthapon', 'ณัฐพล ศิริชุมภู', 'vhwHqw2oDqrjq856haquL9Y-skl8AIOx', '$2y$13$YNqhMpa0Zz3VqzN9pt7UYOVCAXa.jW74YrEMOJwIjbNjK6uiaXQdW', NULL, 'natthapon.s@gmail.com', 9, 1699685055, 1727062969, NULL, 1, 1, 8, 56),
(56, 'nfc0230', 'ยุทธพิชัย ศิริจักร', 'J0BsQX2qs7dH40tEJZeFO22Hads2k6Xi', '$2y$13$5n8mOc9SycHN46Cl4KuzP.TByF40JCGgkHyq55fldbV1KJVw6idWK', NULL, 'yuthapichai.s@local.com', 10, 1699685104, 1733884645, NULL, 1, 1, 8, 63),
(57, 'nfc0316', 'ประภวิษณุ์ ต๊ะตา', 'EfqNnCEzWwGBPxvlt-zzUoaD1NR4LOSV', '$2y$13$IgNWTgjPzTP2g41IDK3cR.BtK1PSo4rutg95J9qh5w98O95rKWBF.', NULL, 'praphawith.t@local.com', 10, 1699685148, 1733884637, NULL, 1, 1, 8, 108),
(58, 'nfc0319', 'ยศกร ศิริชุมภู', 'y90we65IJjIjTVLSVGC8tJqLwiINpwz4', '$2y$13$BIaShJdfac6RtJyc/LCMFua8gteX/lw5KROyMq4g9KIRHijL7OVuu', NULL, 'yotsakorn.s@local.com', 10, 1699685190, 1733884629, NULL, 1, 1, 8, 111),
(59, 'nfc0283', 'จรัญ ดอนเลย', 'kjq19KvF5ziBaRz5qrqjx5dugcZFM50s', '$2y$13$HkPx9.dvxTzTDo.1kERunuDILxIBy03VMgBP9kXLzx.x23gHQGTh2', NULL, 'jarun.d@local.com', 10, 1699685220, 1733884621, NULL, 1, 1, 8, 89),
(60, 'nfc0013', 'องอาจ ชุมภูโร', 's9emD5sGgatRTvmjx2lAIesnIoaP9Tly', '$2y$13$NLY9C1074LF6WFvQ86br7ut/xFrWqN3zAD69cQ/H3ndpeUgfxUp9S', NULL, 'ongart.c@local.com', 10, 1699685260, 1733884613, NULL, 8, 6, 8, 18),
(61, 'nfc0141', 'จิรโรจน์ ทองเทพ', '0ZOIowngY_I8QO_bvI_A0EoCFdVbUFdN', '$2y$13$bkZzd2fsPEQ3dfWNk4B9w.UFfDKE9C3lnmG0CgcHIdgP7pGWDhWaG', NULL, 'jiraroch.t@local.com', 10, 1699685289, 1733884605, NULL, 1, 1, 8, 41),
(62, 'nfc0008', 'สาวิตรี วันโน', 'KS3_21E3ptIJdbtxolF-XEre2bwgtHKN', '$2y$13$sKxSFELGSlAQ1sgxY31RNeRa948dpwOXI2yXoM26mlWhdIobh.2bu', NULL, 'sawitee.w@local.com', 10, 1699685316, 1733884595, NULL, 8, 6, 8, 13),
(63, 'nfc0069', 'กิตติพงษ์ วงค์ไชยา', 'CDVMYioQrVVFqCragdOVk5wOaW87_zpp', '$2y$13$1COYVtRW0JsdxCZVerZjteyj6yfj.OE/4Uh1DPUMc5QsWn8MuHmsu', NULL, 'kittipong.w@local.com', 10, 1699685357, 1733884588, NULL, 1, 1, 8, 35),
(64, 'nfc0189', 'ศิริชัย จันทร์ถา', 'yTzdJjTHHRVsSCCLcENHXYg10H2A9xwG', '$2y$13$eX7nR5BH7rajHnEe1uPdoeXiLx2xvVqlk2ul4xoaJlLKylAQ5Wi/y', NULL, 'sirichai.j@local.com', 10, 1699685389, 1733884579, NULL, 1, 1, 8, 49),
(65, 'kamon', 'กมล ไชยชมภู', 'JHUCq2z9HhVADGLuA_i7dAiJDhsa1wR2', '$2y$13$SKOaeWe9fPaQCM1Tjgr9HOKfDwptVlIGJKVKk3Q8cq4ioOy9tryKe', NULL, 'kamon.c@local.com', 9, 1699685412, 1727063005, NULL, 1, 1, 8, 50),
(66, 'nfc0220', 'ดลวรรณษ อัมพวานนท์', 'zHSjvSE6aExt-MrCVYpYk5jyxjNjayYc', '$2y$13$Sl98c2VzpRADFdKevEdsmO5V/YAVSTWHyUXb1Kx42vlp3aC/ePMKe', NULL, 'donlawan.u@local.com', 9, 1699685446, 1733882409, NULL, 1, 1, 8, 61),
(67, 'nfc0227', 'ผดุงเกียรติ์ คำนึงเชิดชูชัย', 'toj21i1GkAPuGCM5nuyq_mTXEdfrBqV7', '$2y$13$GrGBIjUKYzXjOgdgbCUXpemA833t59ZsCy6nWkGZ3Vey.seB8A0Hq', NULL, 'phadungkiat.k@local.com', 10, 1699685477, 1733884570, NULL, 1, 1, 8, 62),
(68, 'nfc0233', 'ปรเมฆ แซ่พากู่', '93zBcw6pjBHq22BwYc8dIIp8XSUebKq8', '$2y$13$3JQf.u6ePTQV68htCt7B2uZQtB1GqYhrOKTCpsn/yDjpls9/ffGF2', NULL, 'poramak.s@local.com', 10, 1699685522, 1733882391, NULL, 1, 1, 8, 64),
(69, 'nfc0236', 'วุฒิพงศ์ เผือกขวัญนาค', 'HOwpkCP0spLPMQMprCXC4jKP6y_l4iaf', '$2y$13$0CqD5utMq3sp/uRmQrsgW.sdqcjvGT1BiD37ddvk6uJ9IE3RZNKsW', NULL, 'wuthipong.p@local.com', 10, 1699685559, 1733882377, NULL, 1, 1, 8, 65),
(70, 'nfc0241', 'วาสนา วรรณโล', 'RXZ1AQ7Ap15oCBjGUDocd0qebNA-8vHP', '$2y$13$EryGbjMczpTpDwIoZ94VduBb0WT0VTBR9RpxnoUPGMlquL2bOAWPe', NULL, 'wasana.w@local.com', 9, 1699685583, 1733882369, NULL, 1, 1, 8, 66),
(71, 'nfc0242', 'ธีระ รชตะภัทรพงศา', 'RHJJhDLtiGJvTEfzrfL9ysApUOBAiWzG', '$2y$13$s9i/GtNSOtz4iMvRGM4gXOXJfLBzOwp6WjCyhy4m7gk7y/jiNyFeC', NULL, 'theera.r@local.com', 10, 1699685621, 1733882361, NULL, 1, 1, 8, 67),
(72, 'nfc0244', 'สันติ วงค์แสง', 'TRyJy7AqIjL5mXMAw-x2smyyqDp7GoJ-', '$2y$13$.sI/OW/rbcLDMf29dcq2x.ADBeDLNp98EnNVmygk3B.DN9GwPkNnS', NULL, 'santi.w@local.com', 10, 1699685644, 1733882351, NULL, 1, 1, 8, 69),
(73, 'nfc0284', 'เจษฎากรณ์ วรรณโล', 'uoDFZV_MMJmjdz8eRv8R7TVMuNfkHtnt', '$2y$13$FQm0rlQI5IUkObzUYemsK.E9QUS6lXzakC3FHT5sA/.cLQgpSISCC', NULL, 'jadsadakorn.w@local.com', 9, 1699685685, 1733882310, NULL, 1, 1, 8, 90),
(74, 'nfc0285', 'บดินทร์ เชมือ', 'qP3gksAxn_bPXbBpyjUuka4WD_fa5YNi', '$2y$13$Kn26SCpivzPieZ64sa1E6O/Ih24qIc4X9Bi7N0ZgDi6ga9mXU3bh6', NULL, 'bordin.s@local.com', 10, 1699685711, 1733882301, NULL, 1, 1, 8, 91),
(75, 'nfc0050', 'นพคุณ กาบแก้ว', 'qcdUNFTxqGp0AG67Zdg7lIg_jDS5Teqq', '$2y$13$42vW6tMXOMvH4/DNxmWG4.FFi57vSlubf.hApu48zTh1IenQPWBAa', NULL, 'noppakun.k@local.com', 9, 1699685754, 1733882290, NULL, 1, 1, 8, 33),
(76, 'nfc0277', 'นครินท์ กึกกอง', 'DElk_jB4tJaW0_HkCY0HvobhDL-12O9_', '$2y$13$2kpsmvL3GFQcxPOpuZpcnehWSpCL592O0Cs04ioNyRewXG8NE8EhS', NULL, 'nakarin.k@local.com', 10, 1699685786, 1733882281, NULL, 1, 1, 8, 85),
(78, 'nfc0299', 'วีรยุทธ จุมปูโล', 'A9vrsSIADPEAysCtiS9w_c9kYcOLvcSh', '$2y$13$JxwIb2qFxntevsiJMoGh0.zW5zSstKSJvlyJDPaNMiLUC4/S9l.jK', NULL, 'veerayuth.j@local.com', 10, 1699685858, 1733882273, NULL, 1, 1, 8, 100),
(79, 'nfc0001', 'สมคิด คำยานะ', '1kM4Ch6D5qrI1XbvSY0Y4GQqT8YLG07N', '$2y$13$uUE3ydFPzB1TPMTOkbFbe.Fs.KlzHW71Dy86BpLIZICft6jOo7CD.', NULL, 'somkid.k@local.com', 10, 1699686011, 1733882265, NULL, 9, 1, 8, 8),
(80, 'nfc0002', 'เพ็ญศรี ช่างฆ้อง', 'ptkx46QYcn2bwwfen63qGKPGQAKcxYyl', '$2y$13$3xzq0wCoIN42igjI/eXBbuJnrB9/523iCkV6hmmbIjzyCmkHtgI.S', NULL, 'pensri.c@local.com', 10, 1699686063, 1733882257, NULL, 1, 1, 8, 9),
(81, 'nfc0003', 'วันเพ็ญ บรรดิ', 'nkgFRZiOfCcB3jyqyDFbsCk1YSvC3xs6', '$2y$13$gH0EjP0f2nv34zTER2DkfeZnIjDl9wn/Um2.EetRcQGMOpDG2OodW', NULL, 'wanpen.b@local.com', 10, 1699686102, 1733882249, NULL, 1, 1, 8, 10),
(82, 'nfc0011', 'วิภาดา ไชยชมภู', 'jFF_jEUzhVDt6FALP3vYcbkXKW3hOana', '$2y$13$zoUAk1AXs7vhA6440IkRoOOHzADVhRT9vGHUzWPe3ekTd8vEKspZS', NULL, 'wipada.c@local.com', 10, 1699686130, 1733882241, NULL, 9, 1, 8, 16),
(83, 'nfc0017', 'กัญญา เลิศชมภู', '_wJa7uhYYv5HUhjmF093L8QWTjk4J6WW', '$2y$13$dM2HJMp018mU0Zd2gH742eQF4MGX/Svgg3Ynt7O4eUqPeXcG1A/.C', NULL, 'kanya.l@local.com', 10, 1699686155, 1733882233, NULL, 1, 1, 8, 22),
(84, 'nfc0044', 'วิมพ์วิภา รักรุ่ง', 'A9oVWCPsXV2k_I2Teax3vJwJukNrhWhn', '$2y$13$bhj6HcWJRfXl6lIlYp7kMesMifI7aS3tKRhnBDJJInk/Mc6KsJcEO', NULL, 'wimwipa.r@local.com', 9, 1699686260, 1733882226, NULL, 9, 1, 8, 31),
(85, 'nfc0111', 'จีระพงศ์ สุเดชมารค', 'CpQnZXgr14sFpReg0h1WFzxn_iR160-G', '$2y$13$byJwwxsMypNEfvzPlfdcZOcR3C9gKthSmUKELNtwuLLNhxYUdluY.', NULL, 'jeerapong.s@local.com', 10, 1699686292, 1733882216, NULL, 1, 1, 8, 37),
(86, 'nfc0173', 'เฉลิมชัย สีเขียว', 'Z5xBDmTuAQ6NSNR5Rc90Mr2JEBfNLIB8', '$2y$13$tm40hhKN0liGnTg9EnXlru.OiJVXvarg45QVl5i0/t/bZeLmMbeqq', NULL, 'chalurmchai.s@local.com', 9, 1699686323, 1733882208, NULL, 1, 1, 8, 45),
(87, 'nfc0260', 'อรรถพล เครือวงค์', '5a6cwqT361_OtnjtaXCA926gY6S3PnT-', '$2y$13$QLLyc5QPCHkFR7kX.dsPS.jCtAEUMTh9lD3TNboAPnhl46yS6219.', NULL, 'atthapon.k@local.com', 9, 1699686352, 1733882162, NULL, 9, 1, 8, 76),
(88, 'nfc0276', 'วรรณภา เหมืองหม้อ', 'wSZTo5ls2FGCH65lbBTfs_SMBo0sUxtz', '$2y$13$Qb7BmtIMlGhGTnv4kLgNvO4dW05FGuc8nJiB3YgAa7DxMtgmnZW46', NULL, 'wannapa.m@local.com', 10, 1699686377, 1733882153, NULL, 1, 1, 8, 84),
(89, 'nfc0290', 'จิระนันท์ จรรยา', 'HZEEzX3LYWtH8HCWTvJeHOdDMo5aPb7B', '$2y$13$cNalnfY9HO8/TJDfvCYSRu//LocLxfbP6EEY5Vi5TahuCu8c1oXwK', NULL, 'jiranan.j@local.com', 10, 1699686398, 1733882142, NULL, 1, 1, 8, 93),
(90, 'nfc0306', 'เพ็ญพยอม เครือวงศ์', '3uzpB3yEv8rKMi7ecIS5t1UBWF4F0soW', '$2y$13$dxxRONSl5r8NY3LqFWZRi.g9BCyUu57vH6SmqocazKrXuOD71wx2i', NULL, 'penpayom.k@local.com', 9, 1699686425, 1733882133, NULL, 1, 1, 8, 104),
(91, 'nfc0311', 'ณรงค์ศักดิ์ แซ่วื้อ', 'yC5anyf5l7nwHsY4lxnIeaPnN_Bvvd4d', '$2y$13$Y4AbZR0fr193bZj69CcQgeMTygYGmaAwFN.8MC7v8eaaZiSTuYYF.', NULL, 'narongsakpd.s@local.com', 9, 1699686470, 1733882125, NULL, 1, 1, 8, 105),
(92, 'nfc0281', 'สุมาลี วิจิตรพวงชมพู', 'j1_KpWX9gqdB3ldEgtVIIkQkjIznMC8V', '$2y$13$ELuaO3Gdf3Ll0skZXCPFhumrFmW4gJ4ovpAMzux6S.uIodWiu9Aei', NULL, 'sumalee.w@local.com', 10, 1699686524, 1733882103, NULL, 1, 1, 8, 87),
(93, 'nfc0282', 'สุวิมล ยาวิละ', '2LyaKKzkX4xaUm1xZ0rqmuibyWZlRnHn', '$2y$13$XL01pe.nOn5G4SnJ2oeygO3SL/dQXn.Z39w1SKq0wsypC4dYE4.du', NULL, 'suwimol.y@local.com', 10, 1699686562, 1733882095, NULL, 1, 1, 2, 88),
(94, 'nfc0291', 'นงคราญ ไชยแก้ว', 'KhOevm-RxzkkGPAocZyRVuJdbY-70MKT', '$2y$13$.qrfG7leVdsiXmS8pnh2BeQ4Yv6phyjrnsj4.zjzASaeiAMpSjAJu', NULL, 'nongkarn.c@local.com', 10, 1699686641, 1733882086, NULL, 1, 1, 8, 94),
(95, 'nfc0293', 'กรรณิการ์ เตชะเนตร', 'bqw8B9ndHTZxr1MAsLD5wdGI-0yhJErv', '$2y$13$n4an4k6KxdqWKKK7KpLeruM2SaUn2KO43Y29AylOy6vA.Wmd2tZGy', NULL, 'kannikar.t@local.com', 10, 1699686677, 1733882076, NULL, 1, 1, 8, 96),
(96, 'nfc0287', 'นที เตปินตา', 'dcymGMXXb80Tc03ceEdmt_ZGNJWlfnXS', '$2y$13$XzffSv7WsnmDLk3grODC.uVhDLMliuIIbM8W.2oq8aasaB1iM51.i', NULL, 'natee.t@local.com', 10, 1699686696, 1733882068, NULL, 1, 1, 8, 92),
(97, 'nfc0294', 'สุรนันท์ จันทสิงห์', 'XPBYDyy02GTlB4m0k8LDNMfBTGPIFv-i', '$2y$13$CntOqP9K20dRO3l8sUl.YeZsaTxMyaGWJVVc2g8TYw8R2QL294ctK', NULL, 'suranan.j@local.com', 10, 1699686726, 1733882059, NULL, 1, 1, 8, 97),
(98, 'nfc0295', 'โชคชัย จันทวงษ์', 'DlZeOkai8z130tasyHrC3Bs-5a1_nGmd', '$2y$13$9eeUo2HWHXfKATWA6pDJBOj2vKVtk2yHjtZ/9HnxX/un/8ELvRGcy', NULL, 'chokchai.j@local.com', 10, 1699686752, 1733882052, NULL, 1, 1, 8, 98),
(99, 'nfc0300', 'ขุนแผน เสียงใหญ่', 'jJGHCmgOHR95eAwawoMWlQJOz4bO3KLE', '$2y$13$LJH78m5hIX2ihBcfprsu8.5it2i8xYOWjyGssnNjd5azboWWwX9bG', NULL, 'kunpan.s@local.com', 9, 1699686776, 1733882043, NULL, 1, 1, 8, 101),
(100, 'nfc0301', 'นภัสภรณ์ เลิศชมภู', 'deO2wA63dHuD6scgZmzr7msR8WDYZUxP', '$2y$13$4liIp8fshzvX67424MK0ve1kVvkcMBb6ChjYCCOHFEep79fwX/G.K', NULL, 'napatporn.l@local.com', 10, 1699686803, 1733882036, NULL, 1, 1, 8, 102),
(102, 'nfc0324', 'ศิริภัสสร ขัติยะ', 'JyUw3KmvzoBPdgMMLFw1V69HDgPQTheA', '$2y$13$Jm.G0wYYr8jQ4Uv5wonByunJ1xQCJJZxKS/4aJXTSl1MxUX5CxuqC', NULL, 'siripatsorn.k@local.com', 10, 1699686849, 1733882025, NULL, 1, 1, 8, 113),
(103, 'nfc0327', 'น้ำเพชร ลำใยผล', 'xsiB1HBq8bgGcykGL5DRm9MDf5udiNcv', '$2y$13$LMib0Vdm7SPwOoftgLvQPOLw1JCX9mrZTZlzeDcBjgdMPuEMEUB.G', NULL, 'nampech.l@local.com', 9, 1699686879, 1733882014, NULL, 1, 1, 8, 116),
(104, 'nfc0029', 'ประสาน ชัยตาล', 'ks3oAEZ61yBd9ofdreMLsgm7H3s-Ue5S', '$2y$13$0wvQmgrvIIQdn6vMyS8cxeXfX/9JjaD3cN/e5Ysylqn4W9ZUzgEpu', NULL, 'pasan.c@local.com', 10, 1699686903, 1733882005, NULL, 8, 6, 8, 27),
(105, 'nfc0038', 'บัวบาน มณีจิต', 'iLoGKGtyGwhjflUNxu5Yzn9bQzAtxM2r', '$2y$13$33Q.2WVd2TdDAasTRYzfNO0CQOtIOblyhTpUR0H1XFiG4iVUwa/Yu', NULL, 'buaban.m@local.com', 10, 1699686933, 1733881997, NULL, 1, 1, 8, 30),
(106, 'nfc0176', 'กิจขจร โค้งคูณหาร', 'T2KkDB5BYNsqMlf16Fs5VSP1S6oZVaVJ', '$2y$13$w5Fv3cnBv4ptEoI5URt4yeHAEGlqmU.yEPJuxsJXkvb4LOgjQ0amm', NULL, 'kitkajon.k@local.com', 10, 1699686968, 1733881986, NULL, 1, 1, 8, 46),
(110, 'nfc0328', 'สุขนิรันดร์ ผันผ่อน', 'Qg2SLiqjv5RazhRo1_CcI8WDdRpQ40Km', '$2y$13$n/3ijQfhyg70Vjb3sWYMNOCGv3RuftxNPuWLMhDUdo7FD/s.yP.t2', NULL, 'sukniran.p@local.com', 9, 1699687151, 1733881971, NULL, 1, 1, 8, 117),
(111, 'nfc0023', 'พัน ไชยวงค์', 'ZfaslU-Ma3eEKWS_Q5gQLX6CAAHORaM8', '$2y$13$zWg0OLjmlKd17nzd6TJieu9CVS6GoBOJK/6tyf8vog5QuErMsT6L.', NULL, 'pun.c@local.com', 10, 1699687183, 1733881782, NULL, 1, 1, 9, 24),
(112, 'nfc0009', 'พัชริน บรรดิ', 'nl69zW3du9EER0QEKdMd74UctPGKEgR8', '$2y$13$gJGB15g8mVTeH6QHgt7Q7O8xizqDsW78kUuabSu3/wcv8.2mklnsC', NULL, 'patcharin.b@local.com', 10, 1699687237, 1733881773, NULL, 1, 1, 8, 14),
(113, 'nfc0010', 'รัชนี ชุมภูโร', 'sKSXmQlcO8ChY1z2TytbmzFXDCrOXB_Q', '$2y$13$KjtVlvEL9Jl0f5WrWilWoeHsHXrX9l3w8h4Ty43zguM8KOaGiJnQG', NULL, 'ratchanee.c@local.com', 10, 1699687263, 1733881764, NULL, 1, 1, 8, 15),
(114, 'nfc0187', 'เบญจวรรณ สุขใส', 'gmYRQ6MLSFVv46y2S9XxzrrxZ7AflF47', '$2y$13$Gsr80lF0Ecn.CMth0V5zvOAdbVFE7MljIsJnvwGq3HpNAP8aw2B9y', NULL, 'benjawan.s@local.com', 10, 1699687298, 1733881753, NULL, 1, 1, 3, 48),
(115, 'nfc0211', 'ศักดา วงศ์สุข', 'wc83Q1oGp86pCnKZMuPbEpEJRMqAxWpZ', '$2y$13$es7MbJQ6/lr2CZLXIIGU4uuXh1AsHVE0EUf5TrcMRoZGbOqJuSEni', NULL, 'sakda.w@local.com', 10, 1699687321, 1733881744, NULL, 1, 1, 3, 57),
(116, 'nfc0275', 'มธุรส อินเทพ', 'CdTvIVdx8PT-VRxGmLo98k5GMx1kNVGp', '$2y$13$g7F4Jr0fGKCviidUb9jFTeaUbR9e7UY5La1Y5IVusMHWvQHwSFs3a', NULL, 'mathurot.i@local.com', 10, 1699687354, 1733881730, NULL, 1, 1, 8, 83),
(117, 'nfc0292', 'สร้อยทิพย์ กาลศรี', 'ZM-XCtMM0GvQn_Aesgn9LLy26XNv3R5z', '$2y$13$AUXI1U5qCAODE54XVkLaQe5.J3QM5p8f19COxT.fjd8tU2CsfUAO.', NULL, 'soythip.k@local.com', 10, 1699687381, 1733881721, NULL, 1, 1, 3, 95),
(118, 'nfc0298', 'น้ำฝน วงค์เทพ', 't7wIRKM1mmFxEKvohFc9YvKuA5wFi_Xp', '$2y$13$mxS2EFqo6Vzd6lG3enuk5.U3Ai0wsZFLZ.X6Vv70GGvNdAInxWPra', NULL, 'namfon.w@local.com', 10, 1699687401, 1733881711, NULL, 1, 1, 3, 99),
(119, 'nfc0025', 'สำรวย กันธิยะ', 'BDZdfPbOI2klNUy7vbk14UOKuzY8_eeX', '$2y$13$vEAU4JvHV8eDZOuIii4GjeoB.G7/6IF9tQRxzduvlqGgk6F.4DFoC', NULL, 'samrouy.k@local.com', 10, 1699687457, 1733881699, NULL, 1, 1, 2, 25),
(120, 'nfc0218', 'ณัฐพันธ์ ขุมนาค', 'nHfZMx0P8UNY0KK2SauLlUsqNpz4wkPq', '$2y$13$EuVouIxCTTlZJjjvZK4Yxe1fICysgsuHgfqy9h39pPMW/fuDpeXKO', NULL, 'natthapan.k@local.com', 10, 1699687482, 1733881687, NULL, 1, 1, 2, 60),
(121, 'nfc0342', 'พงพิพัฒน์ อินทะไชย', 'DMS5eUAklO-mipoxzY1UgK_yJE_gd8mD', '$2y$13$VPXItWEjmHpg8/sHTtHehe5mwkehz2.QBTr5PKWbOuZDCPJvfkr.C', NULL, 'phongphiphat@local.com', 10, 1710225809, 1733881674, NULL, 1, 1, 6, 130),
(122, 'kotchaporn', 'กชพร กุดนาน้อย', '25bue0W_EmlzILSpg33azVB230Ot1Xns', '$2y$13$xvWNPY6K6KYpSUQ42BifTeIqcmALpAeWGE0JEcSyIsbzZAHW5.SvG', NULL, 'kotchaporn@local.com', 10, 1710225839, 1731999371, NULL, 4, 12, 5, 7),
(123, 'nfc0332', 'คุณานนต์ คำเรือน', '_Y4EDPRF8xyolO37cp0uMmc1r6RwGXne', '$2y$13$OFionJQO/l.DbLjNC9tVbO/Vbqt7vjId/DpzZP7GpGltU7ViLZiHG', NULL, 'kunanon@local.com', 9, 1710225901, 1733881855, NULL, 7, 5, 8, 121),
(125, 'nfc0353', 'อรุณ น้อมสูงเนิน', 'zEhRwvPJT0vxf6bZcpV60KcJOQ-6XYUj', '$2y$13$N5e0Pe88U5lo9Lf.2XgV2.niZ8dc1XpEXrKSehfa96VJLWXjGcI9q', NULL, 'nfcproduction@gmail.com', 10, 1717227899, 1733881632, NULL, 6, 5, 8, 141),
(126, 'nfc0343', 'นฤดล ดวงเอ้ย', '46xQElQ0b2E9z17mxq5uNqEvubFZdIJQ', '$2y$13$JgQMnlNqkXgi4w1L0mpMueBClf4kxNr303jRz725DwrSCk7/Q2Dwm', NULL, 'naruedon@local.com', 9, 1717229501, 1733881846, NULL, 1, 1, 10, 131),
(127, 'nfc0254', 'พงศภัค สมใหม่', 'z4Tdg46hdMYUkjNbCFcBhK9NF9LZG0k1', '$2y$13$1HwTmi9jbj6M5L81TVb7/.EXLhNqPh75mVXHtiGYVTNzbgCeGvbM2', NULL, 'pongsapat@local.com', 9, 1717229572, 1733881837, NULL, 1, 1, 10, 73),
(128, 'khajonsak', 'ขจรศักดิ์ สุภรัตนกูล', 'RqUZ9WbnWqYPRu8XjUI3qD8N7PVocct4', '$2y$13$A8e4fzVgaI9EvKh00tfGkOBvUbV8u2NOEkEP.HXSNSO4PZDoBoWuO', NULL, 'khajonsak@email.com', 9, 1717477460, 1733881547, NULL, 3, 3, 1, 2),
(129, 'nfc0370', 'นิธิวดี ศรีสืบ', 'QRQUhLFatlFRGD6SX4iQbX-6lpYPsI6Y', '$2y$13$GCoCH.JJSQVsZc2xUgA8WuenIKWoFvacYcYXT2NfPfMeU/CZLZ8Vq', NULL, 'nithiwadee@gmail.com', 9, 1718934790, 1733881824, NULL, 4, 8, 3, 158),
(130, 'nfc0369', 'เบญจพร ปันดอนตอง', 'zXDzXw3KdWAQoitbFbgy8vnGDbs-65Dr', '$2y$13$t8iNhAqUaKbUyOgN8QXo1eF0N0KoRFznIVKRxoKqsD3GW2rkqRWwG', NULL, 'nfcsuperviserpd2@gmail.com', 10, 1718934875, 1733881624, NULL, 6, 5, 8, 157),
(131, 'nfc0371', 'ชูเกียรติ ลีลาธนพงศ์พันธุ์', 'CglLQLeATDASoAxhwM45TMIL3e3sDQHj', '$2y$13$bDXIMmGiBxZfkDF4wPmHu.gYNPThrGHKqttDkI/uJqxxj36bPY2K2', NULL, 'nfcproduction22@gmail.com', 9, 1718934909, 1733881816, NULL, 4, 3, 8, 159),
(132, 'nfc0389', 'ชายแดน ธนาคง', 'v7KA4W-0HMi1TP_8e2QDPHe-MkCcJL1X', '$2y$13$QsDXPydWhk1TBsUajZNzIO7ASHgXTS15Q7mnLK1wKx.IhBCfmun6G', NULL, 'nfcwarehouse01@gmail.com', 9, 1721207632, 1733881513, NULL, 6, 5, 2, 177),
(133, 'nfc0377', 'วัชรพงษ์ มโนชมภู', 'Q47BWS0g-STOEsWIkts-zKdLdEcv54yt', '$2y$13$sqoW9V4pY2OQBASynS.tj.9Fdp7uWP0og6hfUbQ8xYVXwashNWL/W', NULL, 'nfcsuperviserpd3@gmail.com', 9, 1721207725, 1733881504, NULL, 6, 5, 8, 165),
(134, 'nfc0387', 'พรชัย ขันคำกาศ', 'AGsxkhZvx38TovCZEUXW1f4ivnFzQhAI', '$2y$13$r.PiHaGUHUfBkenodGnE0e1CEK34228g1547WroD2Enhy685YTxdO', NULL, 'nfcpdsuper1@gmail.com', 10, 1721207773, 1733881493, NULL, 6, 5, 8, 175),
(135, 'nfc0386', 'ภิรฎา ท้าวอินต๊ะ', 'B0C8EXK2rRM3a3IoOBS0K7nc_aK3Oi-Z', '$2y$13$kdSdjsVpKTQJm7l8CbdJEOf.CmGCezg3KYbQqn.hQmkV3dVjh.9aa', NULL, 'pearbpoom@gmail.com', 10, 1721207829, 1733881484, NULL, 11, 12, 5, 174),
(136, 'nfc0385', 'อติวิชญ์ แลนิ', 'NymlOnVbQ5WQ_o9gzfiBY32MFJlz74wk', '$2y$13$X8ULT1YVDCXPUx0BbHYfTO2LcZCNtKs00uT12LJUKeXPfQE8tKRNW', NULL, 'atiwit@local.com', 9, 1721207892, 1733881476, NULL, 1, 1, 10, 173),
(137, 'supawish', 'ศุภวิชญ์ จำลอง', 'B6sy9Zlgg9d-qzEcsKMCF8qhotj5dw6l', '$2y$13$unrC3oe/ZvAXYjkFz5pzEeJqsRKsW70At5my/zClTU7hFhh9X44iq', NULL, 'gm@northernfoodcomplex.com', 10, 1727057957, 1733881423, NULL, 3, 3, 1, 182),
(139, 'nfc0394', 'ชาติชาย แลเซอะ', 'mdFEGgHoScuyBkdHDBuW80sQKZpurfCY', '$2y$13$Hr/wFPEgeFaqJf0Ad7gqpuDFH6O/ayUmJ/.7/HrN7fxMoukh/uW2e', NULL, 'chatchai@local.com', 9, 1727059247, 1733881348, NULL, 1, 1, 1, 185),
(140, 'nfc0395', 'สุรศักดิ์ ภูจีรัง', 'Fzrd2rvIuvVOPMdPXckso3fhWyWD-_td', '$2y$13$fZJhWT40eauH7O37a.ccKuvxtxVKsEY3TI6y4ZISOTkdGqbthffGS', NULL, 'surasak@local.com', 9, 1727059543, 1733881341, NULL, 1, 1, 1, 186),
(141, 'nfc0396', 'เสาวภา ภูจีรัง', 'RVE02jKmIW-dEn_6kHYk9aG8ValJP9MS', '$2y$13$1bog73pByckWqC6pkRBGVu/ULXmFe/m1uKgsE22AyHDDUJefrSV0y', NULL, 'saowapha@local.com', 9, 1727059755, 1733881333, NULL, 1, 1, 1, 187),
(142, 'nfc0397', 'ดิศกันต์ ดวงสนิท', 'UHhA-2sYNFHC7qn-c8BAayEMNDPhLbqj', '$2y$13$JagbnkWNVXmfIS/QqkFIF.VpRWqr68JomVW4MBOnhP4hgGlX5jDJG', NULL, 'dissgan@local.com', 9, 1727060022, 1733881323, NULL, 1, 1, 1, 188),
(143, 'nfc0398', 'วิทยา จะเตาะ', 'BJ_tAbtiB13kmLh5ZneNR_APrEVoAEIZ', '$2y$13$K0beNAESQJDhtyjAS46cYuUbn.nOpCCQxSyew4HqtBWshysWjFNAS', NULL, 'witaya@local.com', 10, 1727060198, 1733881316, NULL, 1, 1, 1, 189),
(144, 'nfc0399', 'พิเชษฐ์ จะทอ', '-90GPe28DaBIarRNJRv0B7yJFivc8YLD', '$2y$13$HppsCp9weNybCDvj6qO5w.vyXmADwV.QpgJYR3KRxYlUIg7X0.AO.', NULL, 'pichet@local.com', 10, 1727060351, 1733881308, NULL, 1, 1, 1, 190),
(145, 'nfc0400', 'เพ็ญนภา จอมใจ', 'hC4Zz-XUeQFFowkLBtjrvJ6wbRJY65AQ', '$2y$13$pMOtUoUOdzwIg1KpNmpKi.NwfrMDQ9F8q45NaUdlpV2CB4LU/tXZK', NULL, 'pannapa@local.com', 10, 1727060458, 1733881298, NULL, 1, 1, 1, 191),
(146, 'nfc0401', 'คณัสนันท์ วิรัลพัชรพงษ์', 'bZlwSCVogaKKEMxiJToXYjOKXo7jCcRS', '$2y$13$Cj3V1kX.NYBfxEd/qeLzze/GuCZDO7z.rAmqlAK1vsgG1jOPXYMTe', NULL, 'kanatsanan@local.com', 10, 1727060554, 1733881290, NULL, 1, 1, 1, 192),
(147, 'nfc0402', 'สิวลี สุขบำรุง', 'pXS-YarCjcB7jswE-cxJ4gT60vnXin6T', '$2y$13$sZfDj94nbFNqBnaqhZknD.9QeiRliaaNtpHbZ6h/Y2/NhDg8kUoXO', NULL, 'siwalee@local.com', 10, 1727836212, 1733881282, NULL, 1, 1, 1, 193),
(148, 'nfc0403', 'เอกภพ ไชยสกุลวงศ์', 'Iu9VREg9NIeRUGyh-qJsYFvFgjbWAhvu', '$2y$13$wsbrcjK/NDLNCmAAFMrR9.SNCTLcacaKfT75E3tj/SloHeygRuKLW', NULL, 'aekkaphop@local.com', 10, 1727836327, 1733880764, NULL, 1, 1, 1, 194),
(149, 'nfc0404', 'กฤษณพงศ์ กิ่งชา', 'DeIRppU5u4pvJbV5-Caz0a09tc4YR6Ho', '$2y$13$IXoMCojT63npsukra7kAYeOMvAtKhXqziQSEnLuk/1jRtTtttplcm', NULL, 'kitsanapong@local.com', 10, 1727836454, 1733880744, NULL, 1, 1, 1, 195),
(152, 'nfc0405', 'จักรกฤษณ์ นับเนืองทรัพย์', '-VzdfPaAGPxnp_FQQJlixL9YymlTfH7L', '$2y$13$FuRzoNXTtL7koVNnrvVjfe1ON1gyKBvIsWKDkBRtH2JPPeFfn.jQq', NULL, 'jakkrit@local.com', 10, 1727836677, 1733880727, NULL, 4, 3, 8, 196),
(153, 'nfc0406', 'ศิรินทรา ยิ้มฉาย', 'gFjo6zgdbXloWWO1HPsxKUC9ulJjDqSM', '$2y$13$Bzi.efFQDY2ofKU9MFUBKepbtuXqRHjbdhUG.EFvCHyL1XR7rFM7O', NULL, 'qmr.northernfoodcomplex@gmail.com', 9, 1729493091, 1733881257, NULL, 4, 3, 3, 197),
(154, 'nfc0361', 'วิชุดา อินตาวงค์', 'ktqVU2tL9wKNLpOaE44J0J4uus-1Gk2l', '$2y$13$9I.to1CauUQac8WLamog1eiAyHlfYfJ7ueFADgaUY98x.g0.oKGrW', NULL, 'wichuda1234intawong@gmail.com', 10, 1730863502, 1733880711, NULL, 1, 1, 3, 149),
(155, 'nfc0391', 'ลัดดาวัลย์ ปฐมกุลการ', 'SeZYpPuGZRAEfN6ZidmlyA2o0NIq_O2l', '$2y$13$hidd2VfNPBiWmy/EhA7eVO5dc203Fm/eVkoLHkItdQ9KcUe7qMgKq', NULL, 'nfc0391@local.com', 10, 1733882523, 1733882523, NULL, 1, 1, 8, 179),
(156, 'nfc0392', 'สุวิทย์ แยะซอก', 's9Eq9V3N89xziTlq4wNLJjUpH5lLIYUp', '$2y$13$D8BBjIBmj0wJZz.BuPkAOefyRgIK3H19SjbOAAj94PkEhVIhkXf0O', NULL, 'nfc0392@local.com', 10, 1733882574, 1733882574, NULL, 1, 1, 8, 180),
(157, 'nfc0388', 'ธิดารัตน์ สิทธิเป็ง', 'er9-olAuy8aNrZNxZHCkWMQkiJRw9KDQ', '$2y$13$IHAf/eHBMncvXtM6LrV.SOFGBfuEUaa/c0dconOlAH21csP8.PMOO', NULL, 'nfc0388@local.com', 10, 1733882622, 1733882622, NULL, 1, 1, 8, 176),
(158, 'nfc0390', 'เดชา ปฐมกุลการ', 'kbAP33YZJhgli1V5-oqXVJSmNx1YoSyS', '$2y$13$39BYZbt44CQzjJkZT3u46Oaeor3IyFE6xVfNuWCNLGfTOGsT8eRdK', NULL, 'nfc0390@local.com', 10, 1733882661, 1733882661, NULL, 1, 1, 8, 178),
(159, 'nfc0379', 'นัฐณิชา เขื่อนคำ', 'b41zJMc5abNOusIem3WCrNb-5kFVBUZR', '$2y$13$qQ5M/nQlpBHO7zB4EJUCuuYKVYN2NjIZjFwIEk6pupmBvB.wslAI2', NULL, 'nfc0379@local.com', 10, 1733882790, 1733882790, NULL, 1, 1, 8, 167),
(160, 'nfc0383', 'ไชยวัฒน์ ชือมือ', 'zqspNnmawuWbOvtJV2h9m-_BLwYM1S34', '$2y$13$97MAQBNKwYsInQjrvczMquE3T24ro.Ne0L0gI4kRYziGl3dgynzMe', NULL, 'nfc0383@local.com', 10, 1733882822, 1733882822, NULL, 1, 1, 8, 171),
(161, 'nfc0376', 'นนทวัฒน์ แก้วหุง', 'fEiYKqvruGy5vRw6N6fR1JxhyhP2s-Cc', '$2y$13$31yNijVLxBYAiW9xbfmRAeS729BJKVjqqubDYZ/aZY28WKHqAQCu6', NULL, 'nfc0376@local.com', 10, 1733882866, 1733882866, NULL, 1, 1, 8, 164),
(162, 'nfc0378', 'ประทุมพร แก้วตุ้ย', 'bydUGqnHXIZa2hNw5P9MThFEuSKnT8Bg', '$2y$13$6PBzPUiY.v6VPqdPXvGK4uwC/XUH/mOsvnqOJXtPNSM1ZOAIMlO8.', NULL, 'nfc0378@local.com', 10, 1733882900, 1733882900, NULL, 1, 1, 8, 166),
(163, 'nfc0374', 'ฐาปกรณ์ ฝ่ายแสนยอ', 'OOKeZnhqNC3r4SiHr3OawdGeqLZMIUGY', '$2y$13$N0AOkt2S8u2kWIAnxCgsYuzQ3nkuK2tsKzXmQPvZmibwmPklisEpm', NULL, 'nfc0374@local.com', 10, 1733882931, 1733882931, NULL, 1, 1, 8, 162),
(164, 'nfc0375', 'ศักดิ์ชัย นาคทัยสงค์', 'Vf6v1XdQ0QjqaaDk01bv6wWQZa_prfZ7', '$2y$13$attRJMV9541MFUL//2Bvney/xLNFxSYD12c9sDFUfRxpmuS0sb4Ce', NULL, 'nfc0375@local.com', 10, 1733882969, 1733882969, NULL, 1, 1, 8, 163),
(165, 'nfc0372', 'นันทิกา ไขสี', 'CwKHBIHCwdCMhLKUP0pFPQFRNq_IvI2L', '$2y$13$S91.f9k2jbf.FlWdal5yPO62hoZ5hTOyClgiRDM11elTg/oxXjEcy', NULL, 'nfc0372@local.com', 10, 1733883005, 1733883005, NULL, 1, 1, 8, 160),
(166, 'nfc0373', 'นลินนิภา แปงจะนะ', 'qUxrlQ4pnmtyisEcOYsOz1lZRhNd4G-M', '$2y$13$xtVgn71zxHK/hJGbtSG.2OWWk7OPWlcEhGuJw3p/INoE8MxU/tmlS', NULL, 'nfc0373@local.com', 10, 1733883048, 1733883048, NULL, 1, 1, 8, 161),
(167, 'nfc0368', 'ชุติภา ไพบูลย์', 'IM2Ae7aUSjXgJiOuEEonlg34ely1KOR-', '$2y$13$Ywgxg6G9DusTXLEgARIbPuBM02en.7Cgg0EZ9LnvDWc3II7ib2Yba', NULL, 'nfc0368@local.com', 10, 1733883108, 1733883108, NULL, 1, 1, 8, 156),
(168, 'nfc0363', 'วีรภัทร พุฒซ้อน', 'Gl00uNgdy2H6PxZ7hkjr6YC1Eo3fDK6h', '$2y$13$hH3hOCl7hngwJek4LztDKeJU09WY6mHJYDeCerVvlEByAwx8jw.Mi', NULL, 'nfc0363@local.com', 10, 1733883159, 1733883159, NULL, 1, 1, 10, 151),
(169, 'nfc0253', 'สุธีรา เทพวงศ์', 'XZCjgsKmfhMDSlp1a7Y8HvBWVWQD-21X', '$2y$13$xlf1yagOLMrve/LylIo6d.OzpmCqEP15W6y0mEKnEMP7111xihAI2', NULL, 'nfc0253@local.com', 10, 1733883237, 1733883237, NULL, 1, 1, 9, 72),
(170, 'nfc0280', 'เบญจมาศ นาคำ', 'PI-vsLRYE77ilzDd8RhHUquc5jTvJvNi', '$2y$13$fEzh8B9V/d471TKpQmMGreDLWsZPBcw7EWecwk2JZwSGaqcHHDagK', NULL, 'nfc0280@local.com', 10, 1733883265, 1733883272, NULL, 1, 1, 8, 86),
(171, 'nfc0325', 'ลัทธพล มะโนพรม', 'hblAf9yo-PlMAYmNHps3kc04TByZSqP6', '$2y$13$SjnlViqskUZR6CCeg96FMODwjkX1bup251nkbMoheZgSWXTJtK2gy', NULL, 'nfc0325@local.com', 10, 1733883314, 1733883314, NULL, 1, 1, 8, 114),
(172, 'nfc0334', 'วรชัย วันสุกใจ', 'cuIGxUEbrhZE_tYcjdu1JK5D3cRR6Y0C', '$2y$13$VwedVcDy8W38oy/ANKCwJOA.aCIJBbUtXO/FuZpUAPWh5K5n2M846', NULL, 'nfc0334@local.com', 10, 1733883350, 1733883356, NULL, 1, 1, 8, 122),
(173, 'nfc0335', 'ณัฐพล ดอนเลย', 'BGjTPFHUFcHQRHBPm7BxEdMNTc-14ba4', '$2y$13$QMtNoxqmW0bWQwsMGGmouug373R2z24PLPnxrDpByjJC/FXP06mgm', NULL, 'nfc0335@local.com', 10, 1733883387, 1733883392, NULL, 1, 1, 8, 123),
(174, 'nfc0336', 'นฤพล บุญเรือง', 'ttmbjQa4-1ELlPWCzXeYWRnmjbjWZOFM', '$2y$13$rKj6.xH/wkBadVCWg6fQtudQJ925zJC.HOCOz/R8cptwNK1Ul4vM2', NULL, 'nfc0336@local.com', 10, 1733883422, 1733883422, NULL, 1, 1, 8, 124),
(175, 'nfc0338', 'ยอดรัก จะคือ', 'Heo7g2w2cyMZKmE2xb11yvHkshEm6HJm', '$2y$13$1aGAPFspe31/9gBeqgYqPefWaLhhMzmGKLGbnpFajZCKIhtbc1w5.', NULL, 'nfc0338@local.com', 10, 1733883451, 1733883451, NULL, 1, 1, 8, 126),
(176, 'nfc0339', 'ศิริวรรณ แลเซอร', 'GNHtb86F36xm9FRrWQ8XHvClOtnZEDUg', '$2y$13$91.afB1jja9qhTvumdE5KerSC23V039CGp9s38SDdAhGD1iq/6dkG', NULL, 'nfc0339@local.com', 10, 1733883486, 1733883486, NULL, 1, 1, 8, 127),
(177, 'nfc0341', 'ธีรเดช ยอดแก้ว', '15N5od_0yKvJ_VhZVFlsUPqALnyEM1LF', '$2y$13$k.MvEnWMrsQxGFk4FcJTEuNzUJOWjmpXlO6bbF.AXiuLF9PCiayCu', NULL, 'nfc0341@local.com', 10, 1733883551, 1733883551, NULL, 1, 1, 8, 129),
(178, 'nfc0344', 'สุวรรณี จิกคำ', 'qs8sZE9lXRPyfz69-yBs0I67DvFlS1hg', '$2y$13$6rXfa7eLm9MLKUqydje0iu3c65WX4vdC9IUlWXrDBKeyNTGjUSW9K', NULL, 'nfc0344@local.com', 10, 1733883596, 1733883596, NULL, 1, 1, 8, 132),
(179, 'nfc0345', 'มานพ อาหยิ', 'c59HElXLKUM5c3Dyy7HZfoHF40ycCDpT', '$2y$13$jhHxpxOctvDbHKU/aF539eo4WcbbVVgN2BMdyGhhF8R8CeciCUGdi', NULL, 'nfc0345@local.com', 10, 1733883625, 1733883625, NULL, 1, 1, 8, 133),
(180, 'nfc0349', 'สิทธิชัย เครือวงค์', 'xcG93DbSsbMenvik-gNkgJfuc6seEY5x', '$2y$13$.kHjOe.KXmIeiiHE04Wd6O/8HDAiL./08Ws5G4vuWnpw8aanQdbOK', NULL, 'nfc0349@local.com', 10, 1733883665, 1733883665, NULL, 1, 1, 8, 137),
(181, 'nfc0351', 'ธีรพงษ์ มณีรัตน์', '6x66Jf1Ed6O2feDA5KgcnqTVMHiCmmY9', '$2y$13$F3bCC95WBHKt2hcndqUh6ud2GBo0NheZ2yeWVTIFLsv2rnW1ywBwe', NULL, 'nfc0351@local.com', 10, 1733883698, 1733883698, NULL, 1, 1, 8, 139),
(182, 'nfc0354', 'ทิวาพร เมธีกิตติคุณ', 'NLZ22vwHg_Gujc9g6R449epjghcl-naB', '$2y$13$jzaliPZuscb2uBLIjJHHPODEW8w8h0ynoaSXAxwaUb3JM4FkT9ble', NULL, 'nfc0354@local.com', 10, 1733883733, 1733883733, NULL, 1, 1, 9, 142),
(183, 'nfc0355', 'วัฒนา แก้วผสม', 'P3Z2-fCau4ZNpcRhNglX9QghitBuGodh', '$2y$13$jNYFENgRuUuMM/xyBwoqEuZQr6wTnuQPIWju5q.93b42tDx2NI5cG', NULL, 'nfc0355@local.com', 10, 1733883769, 1733883769, NULL, 1, 1, 8, 143),
(184, 'nfc0356', 'สมชาติ จะผึ', 'WZtDhoA95dK6HV8G1ulTuk078PUVsGr3', '$2y$13$KqCfTynzi9TynApSKtPm2eDesXihTgRp/W2s9iiN9EM5QOuFmvDrG', NULL, 'nfc0356@local.com', 10, 1733884412, 1733884412, NULL, 1, 1, 8, 144),
(185, 'nfc0357', 'นุชวรา ฟูเชื้อ', 'nh1qlYuBoieGoAy6F1niEx2be0obMWzH', '$2y$13$I/p8UHiP2caNWFyA/rwn8.nlK9kadKFGKHvjMXjot/dWu7RURaw66', NULL, 'nfc0357@local.com', 10, 1733884449, 1733884449, NULL, 1, 1, 8, 145),
(186, 'nfc0360', 'ศิริชัย จันทาพูล', 'Cn8_Hf5LBlpfyqfQaXi-d0o_227Zbh-U', '$2y$13$YvvvgdOFIF3yAaLFbD7iqex0JQdE8q6sB0..YYWE1DZV/.IHzDcR6', NULL, 'nfc0360@local.com', 10, 1733884485, 1733884485, NULL, 1, 1, 8, 148);

-- --------------------------------------------------------

--
-- Table structure for table `work_order`
--

CREATE TABLE `work_order` (
  `id` int NOT NULL,
  `ticket_id` int DEFAULT NULL COMMENT 'ใบแจ้งซ่อม',
  `work_order_code` varchar(45) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL COMMENT 'เลขที่ใบสั่งซ่อม',
  `work_detail` text COMMENT 'รายละเอียด',
  `priority_id` int DEFAULT '1' COMMENT 'ผลกระทบ',
  `teamwork` int DEFAULT NULL COMMENT 'ทีมงาน',
  `start_date` varchar(45) DEFAULT NULL COMMENT 'วันที่เริ่มซ่อม',
  `end_date` varchar(45) DEFAULT NULL COMMENT 'วันที่ซ่อมเสร็จ',
  `hours` varchar(45) DEFAULT NULL COMMENT 'จำนวนชั่วโมง',
  `work_type_id` int DEFAULT NULL COMMENT 'ประเภทการซ่อม',
  `cost` varchar(45) DEFAULT '0' COMMENT 'ค่าใช้จ่าย',
  `approve_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL COMMENT 'ผู้อนุมัติ',
  `approve_date` varchar(45) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL COMMENT 'วันที่อนุมัติ',
  `approve_comment` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL COMMENT 'ความคิดเห็น'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `work_type`
--

CREATE TABLE `work_type` (
  `id` int NOT NULL,
  `code` varchar(45) DEFAULT NULL COMMENT 'รหัส',
  `name` varchar(100) DEFAULT NULL COMMENT 'ชื่อ',
  `color` varchar(45) DEFAULT NULL COMMENT 'สี'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `work_type`
--

INSERT INTO `work_type` (`id`, `code`, `name`, `color`) VALUES
(1, 'Project', 'งานโครงการ', '#0000ff'),
(2, 'Repair', 'ซ่อมแซม', '#ffff00'),
(3, 'New', 'สร้างใหม่', '#ff00ff'),
(4, 'Adapt', 'ดัดแปลง', '#9900ff'),
(5, 'Install', 'ติดตั้ง', '#3c78d8'),
(6, 'Move', 'โยกย้าย', '#e69138');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auto_number`
--
ALTER TABLE `auto_number`
  ADD PRIMARY KEY (`group`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code_UNIQUE` (`code`);

--
-- Indexes for table `machine`
--
ALTER TABLE `machine`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `machine_bom`
--
ALTER TABLE `machine_bom`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_machine_bom_machine1_idx` (`machine_id`),
  ADD KEY `fk_machine_bom_parts1_idx` (`parent_part_id`),
  ADD KEY `fk_machine_bom_parts2_idx` (`child_part_id`);

--
-- Indexes for table `parts`
--
ALTER TABLE `parts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `priority`
--
ALTER TABLE `priority`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code_UNIQUE` (`code`);

--
-- Indexes for table `task_status`
--
ALTER TABLE `task_status`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code_UNIQUE` (`code`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `team_roles`
--
ALTER TABLE `team_roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `technician`
--
ALTER TABLE `technician`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code_UNIQUE` (`ref`),
  ADD UNIQUE KEY `user_id_UNIQUE` (`user_id`);

--
-- Indexes for table `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ticket_group`
--
ALTER TABLE `ticket_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ticket_list`
--
ALTER TABLE `ticket_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `uploads`
--
ALTER TABLE `uploads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`),
  ADD UNIQUE KEY `employee_id` (`employee_id`);

--
-- Indexes for table `work_order`
--
ALTER TABLE `work_order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_work_order_ticket_idx` (`ticket_id`),
  ADD KEY `fk_work_order_priority1_idx` (`priority_id`),
  ADD KEY `fk_work_order_work_type1_idx` (`work_type_id`),
  ADD KEY `fk_work_order_teams1_idx` (`teamwork`);

--
-- Indexes for table `work_type`
--
ALTER TABLE `work_type`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `machine`
--
ALTER TABLE `machine`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `machine_bom`
--
ALTER TABLE `machine_bom`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `parts`
--
ALTER TABLE `parts`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `priority`
--
ALTER TABLE `priority`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `task_status`
--
ALTER TABLE `task_status`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `team_roles`
--
ALTER TABLE `team_roles`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `technician`
--
ALTER TABLE `technician`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `ticket`
--
ALTER TABLE `ticket`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `ticket_group`
--
ALTER TABLE `ticket_group`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ticket_list`
--
ALTER TABLE `ticket_list`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `uploads`
--
ALTER TABLE `uploads`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=187;

--
-- AUTO_INCREMENT for table `work_order`
--
ALTER TABLE `work_order`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `work_type`
--
ALTER TABLE `work_type`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `machine_bom`
--
ALTER TABLE `machine_bom`
  ADD CONSTRAINT `fk_machine_bom_machine1` FOREIGN KEY (`machine_id`) REFERENCES `machine` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_machine_bom_parts1` FOREIGN KEY (`parent_part_id`) REFERENCES `parts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_machine_bom_parts2` FOREIGN KEY (`child_part_id`) REFERENCES `parts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `work_order`
--
ALTER TABLE `work_order`
  ADD CONSTRAINT `fk_work_order_priority1` FOREIGN KEY (`priority_id`) REFERENCES `priority` (`id`),
  ADD CONSTRAINT `fk_work_order_teams1` FOREIGN KEY (`teamwork`) REFERENCES `teams` (`id`),
  ADD CONSTRAINT `fk_work_order_ticket` FOREIGN KEY (`ticket_id`) REFERENCES `ticket` (`id`),
  ADD CONSTRAINT `fk_work_order_work_type1` FOREIGN KEY (`work_type_id`) REFERENCES `work_type` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
