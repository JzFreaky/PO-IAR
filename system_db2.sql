-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 15, 2025 at 01:24 AM
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
-- Database: `system_db2`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE `admin_users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `profile_picture` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `account_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`id`, `name`, `username`, `password`, `created_at`, `profile_picture`, `email`, `account_type`) VALUES
(7, 'Administrator', 'admin1', '$2y$10$u3lkX.YnHzhDPqZApBtKWuWzf9kvgZnVm252w51zedg0jX/L5O0oG', '2024-11-24 21:25:38', '../../../uploads/businessman.png', 'evsusupplyoffice@evsu.com', 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `arrived_items`
--

CREATE TABLE `arrived_items` (
  `id` int(11) NOT NULL,
  `po_id` int(11) NOT NULL,
  `po_no` varchar(50) NOT NULL,
  `stock_no` varchar(50) NOT NULL,
  `delivery_date` date NOT NULL,
  `invoice_no` varchar(50) NOT NULL,
  `original_quantity` int(11) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `unit` varchar(50) NOT NULL,
  `unit_cost` decimal(15,2) NOT NULL,
  `amount` decimal(15,2) NOT NULL,
  `iai_new` tinyint(1) NOT NULL DEFAULT 1,
  `is_news` tinyint(1) DEFAULT 0,
  `status` varchar(50) NOT NULL DEFAULT 'Pending',
  `remarks` text DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `item_status` varchar(50) DEFAULT 'not'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `arrived_items`
--

INSERT INTO `arrived_items` (`id`, `po_id`, `po_no`, `stock_no`, `delivery_date`, `invoice_no`, `original_quantity`, `description`, `unit`, `unit_cost`, `amount`, `iai_new`, `is_news`, `status`, `remarks`, `quantity`, `item_status`) VALUES
(239, 519, '2025-01-0002', '1', '2025-04-02', '12345', 1, 'Executive Table', 'unit', 19295.00, 19295.00, 0, 0, 'Rejected', '', 1, 'ok'),
(240, 517, '2024-09-0186', '1', '2025-04-09', '12345', 1, 'Tiling of Floor at Engineering Department Office at Luna Campus', 'lot', 96000.00, 96000.00, 0, 0, 'Inspected', '', 1, 'not');

-- --------------------------------------------------------

--
-- Table structure for table `delivery_term`
--

CREATE TABLE `delivery_term` (
  `id` int(11) NOT NULL,
  `term_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `delivery_term`
--

INSERT INTO `delivery_term` (`id`, `term_name`) VALUES
(1, '1'),
(2, '2');

-- --------------------------------------------------------

--
-- Table structure for table `end_users`
--

CREATE TABLE `end_users` (
  `id` int(11) NOT NULL,
  `end_user_name` varchar(255) NOT NULL,
  `requisitioning_office` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `end_users`
--

INSERT INTO `end_users` (`id`, `end_user_name`, `requisitioning_office`, `created_at`) VALUES
(1, 'Gerry B. de Cadiz, Ph.D., EnP.', 'Campus Director (Former)', '2024-09-16 07:22:08'),
(2, 'Joseph Jaymel S. Morpos, MSIT', 'Head, Computer Studies Department', '2024-09-16 07:22:30'),
(3, 'Genelyn M. Calzada, D.M.T.', 'Head, Business & Management', '2024-09-16 07:22:41'),
(4, 'Alan Reynaldo E. Mabitad, MSIT', 'Head, Industrial Technology Department', '2024-09-16 07:23:07'),
(5, 'Beatrice D. Mabitad, Ed.D.', 'Head, Teacher Education Department', '2024-09-16 07:23:29'),
(6, 'Engr. Ruderico M. Endriano, Jr.', 'Engineering Department', '2024-09-16 07:24:00'),
(7, 'Rustico B. Badilla, Ph.D., T.M.', 'Head, Administrative and Finance Services', '2024-09-16 07:24:15'),
(8, 'Wilferd Jude A. Perante, MSIT', 'Head, Property Management Office', '2024-09-16 07:24:25'),
(9, 'Lolita C. Badilla, MAVEd', 'Head, Extension Services', '2024-09-16 07:24:33'),
(10, 'Ma. Erenita V. Bahian, Ph.D.', 'Head, Research & Development Office', '2024-09-16 07:24:45'),
(11, 'Joergen T. Arradaza, Jr. Ph.D.', 'Head, Student Affairs & Services Office', '2024-09-16 07:24:52'),
(12, 'Dr. Joel M. Capala', 'Head, Engineering Department', '2024-09-16 07:25:01'),
(13, 'Charlene C. Pita, RGC, Ph.D', 'Guidance Counselor Designate', '2024-09-16 07:25:10'),
(14, 'Beatrice D. Mabitad, Ed.D.', 'Head, HRMDO', '2024-09-16 07:25:32'),
(15, 'Franz Martin S. Callano, MAEd', 'Head, Sports Development', '2024-09-16 07:25:41'),
(16, 'Guillermo M. Sodomia, Ed.D.', 'Head, Culture and the Arts', '2024-09-16 07:25:50'),
(17, 'Cheryl B. Sabal, MAT', 'Head, GAD OIC', '2024-09-16 07:25:59'),
(18, 'Rustico B. Badilla MAEd', 'Chairman, Bids and Awards Committee', '2024-09-16 07:26:09'),
(19, 'Romulo Joseph M. Jereza, IV', 'Head, Library', '2024-09-16 07:26:30'),
(20, 'Mary Joy B. Baltonado, MTE', 'Head, NSTP', '2024-09-16 07:26:41'),
(21, 'Angela M. Coquilla, CPA', 'Accountant Designate', '2024-09-16 07:26:49'),
(22, 'Joanah R. Benitez, MAEd', 'Head, Registrar Office', '2024-09-16 07:27:09'),
(23, 'Sara Jane C. Endriano', 'Head, Cashiering and Disbursing Office', '2024-09-16 07:27:18'),
(24, 'Gilbert Anthony O. Abaño', 'Head, Quality Assurance & Accreditation Center', '2024-09-16 07:27:46'),
(25, 'Glenda M. Barquin, Ph.D.', 'Head, Budget Office', '2024-09-16 07:27:55'),
(26, 'Cheryl B. Sabal, MAT', 'SPO Adviser', '2024-09-16 07:28:09'),
(27, 'Dr. Genelyn M. Calzada', 'Head, IPDO', '2024-09-16 07:34:24'),
(28, 'Rogelio D. Basas, MAEd', 'Head, IGP', '2024-09-16 07:34:34'),
(29, 'Engr. Joseph Jaymel S. Morpos, MSIT', 'Head, ICT', '2024-09-16 07:34:42'),
(30, 'Dr. Joel M. Capala', 'Head, Maintenance & Engineering Services Office', '2024-09-16 07:34:52'),
(31, 'Charlene C. Pita, RGC, Ph.D', 'Guidance Counselor Designate', '2024-09-16 07:35:01'),
(32, 'Genelyn M. Calzada, D.M.T.', 'Head, IPDO', '2024-09-16 07:35:10'),
(33, 'Gilbert Anthony O. Abaño, RN', 'Nurse Designate', '2024-09-16 07:35:21'),
(34, 'Neña Divina D. Fevidal', 'Librarian, EVSU-Luna', '2024-09-16 07:35:30'),
(35, 'Mary Joy B. Baltonado, MTEHE', 'Program Coordinator, BS Ind.Tech-Culinary Arts', '2024-09-16 07:35:37'),
(36, 'John Glenn D. Ocaña', 'Provincial S & T Director - DOST Leyte', '2024-09-16 07:36:23'),
(37, 'Dixie Jean V. Caresosa, LPT', 'BAC Secretariat', '2024-09-16 07:36:39'),
(38, 'Mr. Wilson A. Pogosa', 'Instructor I, Education Dept.', '2024-09-16 07:36:47'),
(39, 'Mary Ann B. Osores', 'Program Coordinator, Business & Management', '2024-09-16 07:36:54'),
(40, 'Lyra C. Rodriguez, MPM.', 'SSG Advisor', '2024-09-16 07:37:33'),
(41, 'Kristine Lovele E. Navarrete, RMT, MATMRS', 'Instructor I, Teacher Education Dept.', '2024-09-16 07:37:42'),
(42, 'Dr. Delicia C. Inghug', 'EVSU-OC, Faculty', '2024-09-16 07:37:52'),
(43, 'Rosita D. Lariosa, MTE', 'GAD Coordinator', '2024-09-16 07:38:25'),
(44, 'Hyacinth T. Gallarde, MAEd', 'Instructor III', '2024-09-16 07:38:32'),
(45, 'Engr. Jomar G. Navarro', 'Head, Maintenance & Engineering Services Office', '2024-09-16 07:38:44'),
(46, 'Dr. Jude Alexes M. Ramas', 'BAC Secretariat', '2024-09-16 07:38:53'),
(47, 'Glenn Mar Jess C. Baltonado', 'Instructor I', '2024-09-16 07:39:02'),
(48, 'Edward B. Bertulfo', 'Multimedia Committee', '2024-09-16 07:39:29'),
(49, 'Engr. Antonio E. Naboya Jr.', 'Instructor I / Engineering Dept.', '2024-09-16 07:39:37'),
(50, 'Engr. Vicente M. Duallo', 'Instructor I / Engineering Dept.', '2024-09-16 07:39:45'),
(51, 'Jeffry V. Ocay, Ph.D', 'Campus Director', '2024-09-16 07:39:57'),
(52, 'Jude I. Jabilles', 'Admin Aide II', '2024-09-16 07:48:47'),
(53, 'Julito F. Acebron', 'Instructor I, BTVTED-FSM', '2024-09-16 07:48:57'),
(54, 'Engr. Jereco Jims J. Agapito', 'Head, Research & Development Office', '2024-09-16 07:49:05'),
(55, 'Maybelle C. Ricote', 'OJT Coordinator, BTVTED', '2024-09-16 07:49:16'),
(56, 'Georgina M. Orbeta', 'Advisor, Student Publication Office', '2024-09-16 07:49:25'),
(57, 'Engr. Edrinald Estobañez', 'Instructor I', '2024-09-16 07:49:35'),
(58, 'Engr. Phoebe Lanzaderas', 'IPDO Coordinator', '2024-09-16 07:49:44'),
(59, 'Marc Fritz Y. Aseo', 'Instructor I', '2024-09-16 07:49:52'),
(60, 'Engr. Robert G. Navarro', '.', '2024-09-16 07:51:02'),
(61, 'Dionisio S. Cecilio', '.', '2024-09-16 07:51:17'),
(62, 'Joseph T. Gudelos, RN', 'Nurse Designate', '2024-09-16 07:51:26'),
(63, 'Jesiel T. Arcillas', 'Instructor I', '2024-09-16 07:51:33'),
(64, 'Bonard B. Torres', 'Instructor I', '2024-09-16 07:51:41'),
(65, 'Alvi Jean S. Weti', 'Instructor I', '2024-09-16 07:51:52'),
(66, 'Dr. Richard P. Impas', 'Head, Administrative and Finance Services', '2024-09-16 07:52:04'),
(72, '14', '124', '2025-04-28 06:58:57');

-- --------------------------------------------------------

--
-- Table structure for table `iar_creation_trail`
--

CREATE TABLE `iar_creation_trail` (
  `id` int(11) NOT NULL,
  `iar_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `name` varchar(255) DEFAULT NULL,
  `account_type` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `iar_creation_trail`
--

INSERT INTO `iar_creation_trail` (`id`, `iar_id`, `created_by`, `created_at`, `name`, `account_type`) VALUES
(80, 108, 35, '2025-04-02 01:35:22', 'Alan Reynaldo E. Mabitad', 'Inspector');

-- --------------------------------------------------------

--
-- Table structure for table `iar_item_details`
--

CREATE TABLE `iar_item_details` (
  `id` int(11) NOT NULL,
  `iar_id` int(11) NOT NULL,
  `stock_no` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `unit` varchar(50) NOT NULL,
  `quantity` varchar(10) NOT NULL,
  `is_complete` tinyint(1) DEFAULT 1,
  `status` varchar(20) DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `original_description` varchar(255) NOT NULL,
  `original_quantity` int(10) NOT NULL,
  `is_new` tinyint(1) DEFAULT 0,
  `is_newd` tinyint(1) DEFAULT 0,
  `is_newp` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `iar_item_details`
--

INSERT INTO `iar_item_details` (`id`, `iar_id`, `stock_no`, `description`, `unit`, `quantity`, `is_complete`, `status`, `remarks`, `original_description`, `original_quantity`, `is_new`, `is_newd`, `is_newp`) VALUES
(819, 108, '1', 'Executive Table ', 'unit', '1', NULL, 'verified', '', 'Executive Table ', 1, 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `iar_item_labels`
--

CREATE TABLE `iar_item_labels` (
  `id` int(11) NOT NULL,
  `iar_id` int(11) NOT NULL,
  `label_no` int(11) NOT NULL,
  `label_text` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `iar_item_specifications`
--

CREATE TABLE `iar_item_specifications` (
  `id` int(11) NOT NULL,
  `iar_id` int(11) NOT NULL,
  `item_no` varchar(50) NOT NULL,
  `item_specification` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `iar_notifications`
--

CREATE TABLE `iar_notifications` (
  `iar_notification_id` int(11) NOT NULL,
  `iar_user_id` int(11) NOT NULL,
  `message` varchar(255) NOT NULL,
  `forwarded_by` varchar(255) NOT NULL,
  `iar_no` varchar(255) NOT NULL,
  `iar_id` int(11) NOT NULL,
  `is_read` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `iar_notifications`
--

INSERT INTO `iar_notifications` (`iar_notification_id`, `iar_user_id`, `message`, `forwarded_by`, `iar_no`, `iar_id`, `is_read`, `created_at`) VALUES
(1, 36, 'The IAR No. 1 is ready for acceptance check.', 'Supply Office Staff', '1', 106, 0, '2025-01-11 13:31:55');

-- --------------------------------------------------------

--
-- Table structure for table `iar_update_trail`
--

CREATE TABLE `iar_update_trail` (
  `id` int(11) NOT NULL,
  `iar_id` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `name` varchar(255) DEFAULT NULL,
  `account_type` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `igf`
--

CREATE TABLE `igf` (
  `id` int(11) NOT NULL,
  `project_description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `igf`
--

INSERT INTO `igf` (`id`, `project_description`) VALUES
(1, 'Trainings, Seminars School Activities'),
(2, 'Commonly Used Office Supplies'),
(3, 'Other Supplies'),
(4, 'Office Equipment'),
(5, 'Semi-Office Equipment'),
(6, 'Medical Dental Laboratory Supplies'),
(7, 'Textbooks and Instructional Materials'),
(8, 'Utilities'),
(9, 'Telephone Expenses'),
(10, 'Accountable Form'),
(11, 'ICT Equipment'),
(12, 'Semi-ICT Equipment'),
(13, 'Furnitures and Fixtures'),
(14, 'Semi-Furnitures and Fixtures'),
(15, 'R&M, Other Structures'),
(16, 'Infrastructure Projects'),
(17, 'R&M Office Equipment'),
(18, 'R&M Service Vehicle'),
(19, 'Other MOOE'),
(20, 'Security Services'),
(21, 'Technical Scientific Equipment'),
(22, 'Motor Vehicle');

-- --------------------------------------------------------

--
-- Table structure for table `inspection_acceptance_report`
--

CREATE TABLE `inspection_acceptance_report` (
  `id` int(11) NOT NULL,
  `entity_name` varchar(255) NOT NULL,
  `fund_cluster` varchar(255) NOT NULL,
  `supplier` varchar(255) NOT NULL,
  `iar_no` varchar(255) NOT NULL,
  `po_no` varchar(255) NOT NULL,
  `iar_date` date NOT NULL,
  `req_office` varchar(255) NOT NULL,
  `invoice_no` varchar(255) NOT NULL,
  `resp_code` varchar(255) DEFAULT NULL,
  `invoice_date` date NOT NULL,
  `requestor` varchar(255) NOT NULL,
  `date_inspected` date NOT NULL,
  `date_received` date DEFAULT NULL,
  `inspection_officer` varchar(255) NOT NULL,
  `head_procurement` varchar(255) NOT NULL,
  `insp_status` varchar(20) NOT NULL,
  `property_custodian_status` varchar(50) DEFAULT 'pending',
  `incomplete_details` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `ppiar_new` tinyint(1) DEFAULT 0,
  `paiar_new` tinyint(1) DEFAULT 0,
  `indiar_new` tinyint(1) DEFAULT 0,
  `idiar_new` tinyint(1) DEFAULT 0,
  `iaiar_new` tinyint(1) DEFAULT 0,
  `spiar_new` tinyint(1) DEFAULT 0,
  `saiar_new` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inspection_acceptance_report`
--

INSERT INTO `inspection_acceptance_report` (`id`, `entity_name`, `fund_cluster`, `supplier`, `iar_no`, `po_no`, `iar_date`, `req_office`, `invoice_no`, `resp_code`, `invoice_date`, `requestor`, `date_inspected`, `date_received`, `inspection_officer`, `head_procurement`, `insp_status`, `property_custodian_status`, `incomplete_details`, `created_at`, `ppiar_new`, `paiar_new`, `indiar_new`, `idiar_new`, `iaiar_new`, `spiar_new`, `saiar_new`) VALUES
(108, 'EASTERN VISAYAS STATE UNIVERSITY - ORMOC CAMPUS', 'IGF', 'SL RUIZ CORPORATION', '1', '2025-01-0002 | January 7, 2025', '2025-04-02', 'Head, Teacher Education Department', '12345', '1040101005', '2025-04-02', 'Beatrice D. Mabitad, Ed.D.', '2025-04-02', '2025-04-02', 'Alan Reynaldo E. Mabitad, MSIT', 'Joel V. Mari', 'complete', 'pending', NULL, '2025-04-02 01:35:22', 0, 1, 1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `mode_procurement`
--

CREATE TABLE `mode_procurement` (
  `id` int(11) NOT NULL,
  `mode_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mode_procurement`
--

INSERT INTO `mode_procurement` (`id`, `mode_name`) VALUES
(1, 'Competitive Bidding (Public Bidding)'),
(2, 'Direct Contracting (Single Source Procurement)'),
(3, 'Shopping'),
(4, 'Small Value Procurement'),
(5, 'Agency-to-Agency'),
(6, 'Negotiated Procurement');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `notification_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `message` varchar(255) NOT NULL,
  `is_read` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `forwarded_by` varchar(255) DEFAULT NULL,
  `po_id` int(11) DEFAULT NULL,
  `po_no` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`notification_id`, `user_id`, `message`, `is_read`, `created_at`, `forwarded_by`, `po_id`, `po_no`) VALUES
(1, 35, 'The Items/Supplies from the Purchase Order 2025-01-0002 have arrived in the Supply Office.', 0, '2025-01-13 21:54:47', 'Supply Office', 519, '2025-01-0002');

-- --------------------------------------------------------

--
-- Table structure for table `office`
--

CREATE TABLE `office` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `role` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `office`
--

INSERT INTO `office` (`id`, `name`, `role`) VALUES
(1, 'Julito F. Acebron', 'Procurement'),
(2, 'Carolina Codilla', 'Procurement'),
(3, 'Alan Reynaldo E. Mabitad, MSIT', 'Inspector'),
(4, 'Nathan Barbac', 'Supply Office Staff'),
(5, 'Joel V. Mari', 'Property Custodian');

-- --------------------------------------------------------

--
-- Table structure for table `po_creation_trail`
--

CREATE TABLE `po_creation_trail` (
  `id` int(11) NOT NULL,
  `po_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `name` varchar(255) DEFAULT NULL,
  `account_type` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `po_creation_trail`
--

INSERT INTO `po_creation_trail` (`id`, `po_id`, `created_by`, `created_at`, `name`, `account_type`) VALUES
(47, 496, 31, '2024-12-31 03:02:16', 'Carolina Codilla', 'BAC'),
(48, 497, 31, '2024-12-31 03:07:24', 'Carolina Codilla', 'BAC'),
(49, 498, 31, '2024-12-31 03:14:16', 'Carolina Codilla', 'BAC'),
(50, 499, 31, '2024-12-31 03:27:32', 'Carolina Codilla', 'BAC'),
(51, 500, 31, '2024-12-31 03:30:48', 'Carolina Codilla', 'BAC'),
(52, 501, 31, '2024-12-31 03:33:15', 'Carolina Codilla', 'BAC'),
(53, 502, 31, '2025-01-01 18:11:04', 'Carolina Codilla', 'BAC'),
(54, 503, 31, '2025-01-01 18:29:42', 'Carolina Codilla', 'BAC'),
(55, 504, 31, '2025-01-01 18:33:24', 'Carolina Codilla', 'BAC'),
(56, 505, 31, '2025-01-01 18:36:22', 'Carolina Codilla', 'BAC'),
(57, 506, 31, '2025-01-01 18:46:56', 'Carolina Codilla', 'BAC'),
(58, 507, 31, '2025-01-01 18:49:01', 'Carolina Codilla', 'BAC'),
(59, 508, 31, '2025-01-01 18:55:34', 'Carolina Codilla', 'BAC'),
(66, 515, 31, '2025-01-04 09:47:27', 'Carolina Codilla', 'BAC'),
(67, 516, 31, '2025-01-07 10:40:46', 'Carolina Codilla', 'BAC'),
(68, 517, 31, '2025-01-07 10:56:54', 'Carolina Codilla', 'BAC'),
(69, 518, 31, '2025-01-07 11:11:06', 'Carolina Codilla', 'BAC'),
(70, 519, 31, '2025-01-07 15:38:22', 'Carolina Codilla', 'BAC'),
(72, 521, 31, '2025-01-09 16:22:32', 'Carolina Codilla', 'BAC'),
(73, 522, 36, '2025-01-09 16:45:00', 'Julito Acebron', 'BAC'),
(76, 525, 37, '2025-01-27 20:34:39', 'User', 'BAC');

-- --------------------------------------------------------

--
-- Table structure for table `po_item_specifications`
--

CREATE TABLE `po_item_specifications` (
  `id` int(11) NOT NULL,
  `po_id` int(11) NOT NULL,
  `item_no` varchar(50) NOT NULL,
  `item_specification` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `po_item_specifications`
--

INSERT INTO `po_item_specifications` (`id`, `po_id`, `item_no`, `item_specification`) VALUES
(74, 496, '1', 'Printing method: FDM (Fused Deposition Molding), Printing Size:220 220*250mm'),
(75, 496, '1', 'Printing speed: 180mm/s, Mormal 30-60mm/s, slice software: Cura, repetier-host, simplify 3D'),
(76, 496, '1', 'Operating system: Windows xp/vista/7/8/10, MAC, Linux'),
(77, 498, '1', 'Spring Rolls'),
(78, 498, '1', 'Sweet and Sour Fish'),
(79, 498, '1', 'Beef Steak'),
(80, 498, '1', 'Rice'),
(81, 498, '1', 'Drinks'),
(82, 500, '1', 'Specs: kyocera, Taskalfa 1800'),
(83, 503, '1', 'WXGA 1,280x800 (Native Resolution)'),
(84, 503, '1', 'DLP Type Projector'),
(85, 503, '1', 'With built-in speaker x 1'),
(86, 503, '1', '6,000 hours (standard), 10,000 hrs (ECO), 15,000 hrs (ExtremeEco) Lamp Life'),
(87, 503, '1', 'Wireless Cable, Bang'),
(88, 503, '1', '2 yrs warranty with bag'),
(89, 503, '1', 'Counter Offer'),
(90, 503, '1', 'ACER X 1228i, 4,800 Lumens'),
(91, 503, '1', 'Projector w/o screen'),
(92, 503, '2', 'Compact Integrated tank design'),
(93, 503, '2', 'Print speeds up to 15.5ipm for black and 8.5ipm for colour'),
(94, 503, '2', 'Auto-Duplex printing\\'),
(95, 503, '2', 'Ethernet and Wi-fi direct'),
(96, 503, '2', 'Seamless set up with epson smart panel'),
(97, 503, '2', 'Borderless printing up to A4 size'),
(98, 503, '2', 'Spill-free ink refilling'),
(99, 503, '2', 'Warranty of 2yrs of 50,000 pages'),
(100, 506, '2', '4 in 1'),
(101, 506, '2', 'Flat sheet 60in x 90in'),
(102, 506, '2', 'Fitted sheet 39in x 75in'),
(103, 506, '2', 'Pillowcase (2pcs) 20in x 30in'),
(104, 506, '2', 'Comforter 68in x 88in (124624)'),
(105, 515, '1', 'Epson'),
(106, 515, '6', '16 GB RAM\r\nProcessor Intel Core i5 3rd Gen\r\n512 GB SSD\r\n720p HD Video 30fps\r\nUSB Charging'),
(107, 516, '1', 'AMD RYZEN 5 5600G W/ RADEON GRAPHICS (1 unit / 1 year warranty)'),
(108, 516, '1', 'MSI B450M PRO VDH MAX (VGA+DVI-D+HDMI) (1 unit / 1 year warranty)'),
(109, 516, '1', 'KINGSTONE FURY BLACK 16GB 3200MHZ KF432 16BB 1/6 (1 unit / 1 year warranty)'),
(110, 516, '1', 'WD GREEN 240GB 2.5\" 7MM SATA-III SSD (1 unit / 1 year warranty)'),
(111, 516, '1', 'SEAGATE BARRACUD ST1000M014 1TB 3.5\"SATA 7200 RPM (1 unit / 1 year warranty)'),
(112, 516, '1', 'CIVO CASE H003 MICRO ATX BLK/BLK 700W PSU W/SATA (1 unit / 3 months warranty)'),
(113, 516, '1', 'ACER KA242Y 23.8\" FHD WIDE LED IPS MONITOR (VGA/HDMI) (1 unit / 1 year warranty)'),
(114, 516, '1', 'MOUSE & KEYBOARD with MOUSEPAD (1 unit / 3 months warranty)'),
(115, 516, '1', 'IDEAL UPS 650VA 5106C BLACK W/ AVR (1 unit / 1 year warranty) INSTALLATION (OS & OFFICE) (1 unit)'),
(116, 516, '2', 'BROPTHER MFC-J3940DW INKJET PRINTER (1 unit / 1 year warranty)'),
(117, 521, '1', 'Hot and Cold');

-- --------------------------------------------------------

--
-- Table structure for table `po_login_logs`
--

CREATE TABLE `po_login_logs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `account_type` varchar(255) NOT NULL,
  `login_time` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `po_login_logs`
--

INSERT INTO `po_login_logs` (`id`, `user_id`, `account_type`, `login_time`, `name`) VALUES
(6, 31, 'BAC', '2024-11-25 11:49:54', 'Mark Talle'),
(7, 31, 'BAC', '2024-11-25 12:05:52', 'Mark Talle'),
(8, 31, 'BAC', '2024-11-25 12:08:42', 'Mark Talle'),
(9, 31, 'BAC', '2024-11-25 20:47:28', 'Mark Talle'),
(10, 31, 'BAC', '2024-11-25 20:52:20', 'Mark Talle'),
(11, 31, 'BAC', '2024-11-25 21:22:37', 'Mark Talle'),
(12, 31, 'BAC', '2024-11-25 22:19:38', 'Mark Talle'),
(13, 31, 'BAC', '2024-11-25 22:52:30', 'Mark Talle'),
(14, 31, 'BAC', '2024-11-26 01:55:59', 'Mark Talle'),
(15, 31, 'BAC', '2024-11-26 01:57:12', 'Mark Talle'),
(16, 31, 'BAC', '2024-11-26 01:58:08', 'Mark Talle'),
(17, 31, 'BAC', '2024-11-26 02:00:03', 'Mark Talle'),
(18, 31, 'BAC', '2024-11-26 02:10:41', 'Mark Talle'),
(19, 31, 'BAC', '2024-11-26 02:14:43', 'Mark Talle'),
(20, 31, 'BAC', '2024-11-26 02:21:00', 'Mark Talle'),
(21, 31, 'BAC', '2024-11-26 02:22:13', 'Mark Talle'),
(22, 31, 'BAC', '2024-11-26 02:23:01', 'Mark Talle'),
(23, 31, 'BAC', '2024-11-26 09:10:14', 'Mark Talle'),
(24, 31, 'BAC', '2024-11-26 09:21:13', 'Mark Talle'),
(25, 31, 'BAC', '2024-11-26 09:22:48', 'Mark Talle'),
(26, 31, 'BAC', '2024-11-26 10:09:18', 'Mark Talle'),
(27, 31, 'BAC', '2024-11-26 12:43:36', 'Mark Talle'),
(28, 31, 'BAC', '2024-11-26 15:02:56', 'Mark Talle'),
(29, 31, 'BAC', '2024-11-26 18:16:37', 'Mark Talle'),
(30, 31, 'BAC', '2024-11-27 01:55:07', 'Mark Talle'),
(31, 31, 'BAC', '2024-11-27 13:24:52', 'Mark Talle'),
(32, 31, 'BAC', '2024-11-27 13:28:25', 'Mark Talle'),
(33, 31, 'BAC', '2024-11-27 19:43:30', 'Mark Talle'),
(34, 31, 'BAC', '2024-11-28 02:12:23', 'Mark Talle'),
(35, 31, 'BAC', '2024-11-28 03:56:29', 'Mark Talle'),
(36, 31, 'BAC', '2024-11-28 20:27:58', 'Mark Talle'),
(37, 31, 'BAC', '2024-11-28 23:36:19', 'Mark Talle'),
(38, 31, 'BAC', '2024-11-29 01:21:27', 'Mark Talle'),
(39, 31, 'BAC', '2024-11-29 10:03:23', 'Mark Talle'),
(40, 31, 'BAC', '2024-11-29 14:09:40', 'Mark Talle'),
(41, 31, 'BAC', '2024-11-29 14:28:31', 'Mark Talle'),
(42, 31, 'BAC', '2024-11-29 14:43:57', 'Mark Talle'),
(43, 31, 'BAC', '2024-11-29 14:45:14', 'Mark Talle'),
(44, 31, 'BAC', '2024-11-29 15:04:46', 'Mark Talle'),
(45, 31, 'BAC', '2024-11-29 15:28:48', 'Mark Talle'),
(46, 31, 'BAC', '2024-11-29 15:31:49', 'Mark Talle'),
(47, 31, 'BAC', '2024-11-29 20:51:53', 'Mark Talle'),
(48, 31, 'BAC', '2024-11-29 21:35:47', 'Mark Talle'),
(49, 31, 'BAC', '2024-11-29 21:36:01', 'Mark Talle'),
(50, 31, 'BAC', '2024-11-29 21:36:10', 'Mark Talle'),
(51, 31, 'BAC', '2024-11-29 22:13:16', 'Mark Talle'),
(52, 31, 'BAC', '2024-11-30 00:10:04', 'Mark Talle'),
(53, 31, 'BAC', '2024-11-30 04:36:00', 'Mark Talle'),
(54, 31, 'BAC', '2024-11-30 04:37:43', 'Mark Talle'),
(55, 31, 'BAC', '2024-11-30 04:44:45', 'Mark Talle'),
(56, 31, 'BAC', '2024-11-30 05:05:01', 'Mark Talle'),
(57, 31, 'BAC', '2024-11-30 09:36:44', 'Mark Talle'),
(58, 31, 'BAC', '2024-11-30 09:39:50', 'Mark Talle'),
(59, 31, 'BAC', '2024-12-01 04:59:48', 'Mark Talle'),
(60, 31, 'BAC', '2024-12-01 16:27:48', 'Mark Talle'),
(61, 31, 'BAC', '2024-12-01 16:31:22', 'Mark Talle'),
(62, 31, 'BAC', '2024-12-01 16:31:59', 'Mark Talle'),
(63, 31, 'BAC', '2024-12-01 16:46:49', 'Mark Talle'),
(64, 31, 'BAC', '2024-12-01 17:54:32', 'Mark Talle'),
(65, 31, 'BAC', '2024-12-01 17:54:58', 'Mark Talle'),
(66, 31, 'BAC', '2024-12-01 17:57:30', 'Mark Talle'),
(67, 31, 'BAC', '2024-12-01 17:58:46', 'Mark Talle'),
(68, 31, 'BAC', '2024-12-01 18:14:23', 'Mark Talle'),
(69, 31, 'BAC', '2024-12-01 18:21:27', 'Mark Talle'),
(70, 31, 'BAC', '2024-12-01 18:42:59', 'Mark Talle'),
(71, 31, 'BAC', '2024-12-01 18:45:00', 'Carolina Codilla'),
(72, 31, 'BAC', '2024-12-01 20:15:05', 'Carolina Codilla'),
(73, 31, 'BAC', '2024-12-01 23:01:51', 'Carolina Codilla'),
(74, 31, 'BAC', '2024-12-01 23:32:05', 'Carolina Codilla'),
(75, 31, 'BAC', '2024-12-01 23:43:28', 'Carolina Codilla'),
(76, 31, 'BAC', '2024-12-01 23:47:15', 'Carolina Codilla'),
(77, 31, 'BAC', '2024-12-02 00:08:52', 'Carolina Codilla'),
(78, 31, 'BAC', '2024-12-02 00:17:43', 'Carolina Codilla'),
(79, 31, 'BAC', '2024-12-02 00:25:18', 'Carolina Codilla'),
(80, 31, 'BAC', '2024-12-02 00:29:53', 'Carolina Codilla'),
(81, 31, 'BAC', '2024-12-02 00:35:26', 'Carolina Codilla'),
(82, 31, 'BAC', '2024-12-02 00:42:09', 'Carolina Codilla'),
(83, 31, 'BAC', '2024-12-02 00:48:37', 'Carolina Codilla'),
(84, 31, 'BAC', '2024-12-02 00:53:27', 'Carolina Codilla'),
(85, 31, 'BAC', '2024-12-02 00:59:51', 'Carolina Codilla'),
(86, 31, 'BAC', '2024-12-02 01:06:14', 'Carolina Codilla'),
(87, 31, 'BAC', '2024-12-02 01:15:30', 'Carolina Codilla'),
(88, 31, 'BAC', '2024-12-02 01:22:14', 'Carolina Codilla'),
(89, 31, 'BAC', '2024-12-02 01:28:12', 'Carolina Codilla'),
(90, 31, 'BAC', '2024-12-02 06:07:38', 'Carolina Codilla'),
(91, 31, 'BAC', '2024-12-02 10:08:14', 'Carolina Codilla'),
(92, 31, 'BAC', '2024-12-02 18:48:05', 'Carolina Codilla'),
(93, 31, 'BAC', '2024-12-02 18:50:57', 'Carolina Codilla'),
(94, 31, 'BAC', '2024-12-02 21:33:34', 'Carolina Codilla'),
(95, 31, 'BAC', '2024-12-02 21:35:27', 'Carolina Codilla'),
(96, 31, 'BAC', '2024-12-02 21:41:00', 'Carolina Codilla'),
(97, 31, 'BAC', '2024-12-02 22:31:18', 'Carolina Codilla'),
(98, 31, 'BAC', '2024-12-03 10:51:41', 'Carolina Codilla'),
(99, 31, 'BAC', '2024-12-03 23:19:13', 'Carolina Codilla'),
(100, 31, 'BAC', '2024-12-04 09:19:13', 'Carolina Codilla'),
(101, 31, 'BAC', '2024-12-04 18:50:16', 'Carolina Codilla'),
(102, 31, 'BAC', '2024-12-05 08:15:48', 'Carolina Codilla'),
(103, 31, 'BAC', '2024-12-05 08:38:06', 'Carolina Codilla'),
(104, 31, 'BAC', '2024-12-12 13:23:36', 'Carolina Codilla'),
(105, 31, 'BAC', '2024-12-12 13:31:03', 'Carolina Codilla'),
(106, 31, 'BAC', '2024-12-12 13:31:14', 'Carolina Codilla'),
(107, 31, 'BAC', '2024-12-29 02:39:20', 'Carolina Codilla'),
(108, 31, 'BAC', '2024-12-29 03:47:00', 'Carolina Codilla'),
(109, 31, 'BAC', '2024-12-29 04:26:30', 'Carolina Codilla'),
(110, 31, 'BAC', '2024-12-29 23:43:01', 'Carolina Codilla'),
(111, 31, 'BAC', '2024-12-29 23:57:35', 'Carolina Codilla'),
(112, 31, 'BAC', '2024-12-31 02:32:52', 'Carolina Codilla'),
(113, 31, 'BAC', '2025-01-01 17:39:16', 'Carolina Codilla'),
(114, 31, 'BAC', '2025-01-02 09:24:09', 'Carolina Codilla'),
(115, 31, 'BAC', '2025-01-02 23:07:21', 'Carolina Codilla'),
(116, 31, 'BAC', '2025-01-02 23:30:27', 'Carolina Codilla'),
(117, 31, 'BAC', '2025-01-02 23:43:17', 'Carolina Codilla'),
(118, 31, 'BAC', '2025-01-02 23:46:10', 'Carolina Codilla'),
(119, 31, 'BAC', '2025-01-03 04:03:23', 'Carolina Codilla'),
(120, 31, 'BAC', '2025-01-03 08:31:48', 'Carolina Codilla'),
(121, 31, 'BAC', '2025-01-03 09:59:28', 'Carolina Codilla'),
(122, 31, 'BAC', '2025-01-03 12:30:22', 'Carolina Codilla'),
(123, 31, 'BAC', '2025-01-03 12:36:02', 'Carolina Codilla'),
(124, 31, 'BAC', '2025-01-03 13:22:57', 'Carolina Codilla'),
(125, 31, 'BAC', '2025-01-03 13:46:28', 'Carolina Codilla'),
(126, 31, 'BAC', '2025-01-03 13:47:11', 'Carolina Codilla'),
(127, 31, 'BAC', '2025-01-03 14:51:22', 'Carolina Codilla'),
(128, 31, 'BAC', '2025-01-03 14:51:25', 'Carolina Codilla'),
(129, 31, 'BAC', '2025-01-03 14:52:14', 'Carolina Codilla'),
(130, 31, 'BAC', '2025-01-03 14:55:09', 'Carolina Codilla'),
(131, 31, 'BAC', '2025-01-03 15:18:19', 'Carolina Codilla'),
(132, 31, 'BAC', '2025-01-03 15:24:06', 'Carolina Codilla'),
(133, 31, 'BAC', '2025-01-03 15:30:39', 'Carolina Codilla'),
(134, 31, 'BAC', '2025-01-03 21:34:04', 'Carolina Codilla'),
(135, 31, 'BAC', '2025-01-03 22:42:15', 'Carolina Codilla'),
(136, 31, 'BAC', '2025-01-04 00:08:35', 'Carolina Codilla'),
(137, 31, 'BAC', '2025-01-04 00:14:18', 'Carolina Codilla'),
(138, 31, 'BAC', '2025-01-04 00:30:11', 'Carolina Codilla'),
(139, 31, 'BAC', '2025-01-04 01:07:28', 'Carolina Codilla'),
(140, 31, 'BAC', '2025-01-04 01:26:21', 'Carolina Codilla'),
(141, 31, 'BAC', '2025-01-04 01:53:47', 'Carolina Codilla'),
(142, 31, 'BAC', '2025-01-04 08:14:34', 'Carolina Codilla'),
(143, 31, 'BAC', '2025-01-04 08:26:56', 'Carolina Codilla'),
(144, 31, 'BAC', '2025-01-04 09:20:41', 'Carolina Codilla'),
(145, 31, 'BAC', '2025-01-04 09:30:18', 'Carolina Codilla'),
(146, 31, 'BAC', '2025-01-04 10:18:59', 'Carolina Codilla'),
(147, 31, 'BAC', '2025-01-06 10:48:27', 'Carolina Codilla'),
(148, 31, 'BAC', '2025-01-07 10:01:28', 'Carolina Codilla'),
(149, 31, 'BAC', '2025-01-07 11:35:49', 'Carolina Codilla'),
(150, 31, 'BAC', '2025-01-07 15:25:39', 'Carolina Codilla'),
(151, 31, 'BAC', '2025-01-08 18:18:50', 'Carolina Codilla'),
(152, 31, 'BAC', '2025-01-08 18:19:31', 'Carolina Codilla'),
(153, 31, 'BAC', '2025-01-09 15:23:29', 'Carolina Codilla'),
(154, 31, 'BAC', '2025-01-09 16:12:44', 'Carolina Codilla'),
(155, 31, 'BAC', '2025-01-09 16:27:12', 'Carolina Codilla'),
(156, 36, 'BAC', '2025-01-09 16:37:38', 'Julito Acebron'),
(157, 37, 'BAC', '2025-01-09 19:49:52', 'User'),
(158, 37, 'BAC', '2025-01-10 07:53:58', 'User'),
(159, 37, 'BAC', '2025-01-10 14:31:17', 'User'),
(160, 37, 'BAC', '2025-01-10 15:20:10', 'User'),
(161, 37, 'BAC', '2025-01-11 16:31:40', 'User'),
(162, 37, 'BAC', '2025-01-11 16:32:08', 'User'),
(163, 37, 'BAC', '2025-01-11 22:05:08', 'User'),
(164, 37, 'BAC', '2025-01-11 22:12:02', 'User'),
(165, 37, 'BAC', '2025-01-12 03:59:49', 'User'),
(166, 37, 'BAC', '2025-01-12 15:37:32', 'User'),
(167, 37, 'BAC', '2025-01-12 16:01:34', 'User'),
(168, 37, 'BAC', '2025-01-12 22:01:10', 'User'),
(169, 37, 'BAC', '2025-01-12 23:29:27', 'User'),
(170, 37, 'BAC', '2025-01-12 23:40:53', 'User'),
(171, 37, 'BAC', '2025-01-13 10:07:01', 'User'),
(172, 37, 'BAC', '2025-01-13 10:26:20', 'User'),
(173, 37, 'BAC', '2025-01-27 20:27:18', 'User'),
(174, 37, 'BAC', '2025-02-28 05:48:38', 'User'),
(175, 37, 'BAC', '2025-03-02 13:42:38', 'User'),
(176, 37, 'BAC', '2025-03-26 06:44:44', 'User'),
(177, 37, 'BAC', '2025-03-26 06:50:15', 'User'),
(178, 37, 'BAC', '2025-03-31 03:09:17', 'User'),
(179, 37, 'BAC', '2025-04-03 02:51:19', 'User'),
(180, 37, 'BAC', '2025-04-03 03:06:00', 'User'),
(181, 37, 'BAC', '2025-04-03 03:11:28', 'User'),
(182, 37, 'BAC', '2025-04-03 03:54:46', 'User'),
(183, 37, 'BAC', '2025-04-03 03:58:01', 'User'),
(184, 37, 'BAC', '2025-04-03 03:58:59', 'User'),
(185, 37, 'BAC', '2025-04-03 04:01:19', 'User'),
(186, 37, 'BAC', '2025-04-03 04:23:42', 'User'),
(187, 37, 'BAC', '2025-04-09 00:40:39', 'User'),
(188, 37, 'BAC', '2025-04-24 06:02:50', 'User'),
(189, 37, 'BAC', '2025-04-28 02:03:23', 'User'),
(190, 37, 'BAC', '2025-04-28 05:36:16', 'User'),
(191, 37, 'BAC', '2025-05-06 01:01:36', 'User'),
(192, 37, 'BAC', '2025-05-06 01:02:37', 'User');

-- --------------------------------------------------------

--
-- Table structure for table `po_notifications`
--

CREATE TABLE `po_notifications` (
  `po_notification_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `message` varchar(255) NOT NULL,
  `forwarded_by` varchar(50) NOT NULL,
  `po_no` varchar(50) NOT NULL,
  `po_id` int(11) NOT NULL,
  `is_read` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `po_notifications`
--

INSERT INTO `po_notifications` (`po_notification_id`, `user_id`, `message`, `forwarded_by`, `po_no`, `po_id`, `is_read`, `created_at`) VALUES
(7, 31, 'New Approved Purchase Order PO No. 2024-11-0281', 'BAC', '2024-11-0281', 498, 0, '2025-01-03 18:01:37'),
(8, 31, 'New Approved Purchase Order PO No. 2024-10-0233', 'BAC', '2024-10-0233', 497, 0, '2025-01-03 18:01:46'),
(9, 31, 'New Approved Purchase Order PO No. 2025-01-0001', 'BAC', '2025-01-0001', 515, 0, '2025-01-04 01:51:36'),
(10, 31, 'New Approved Purchase Order PO No. 2024-09-0186', 'BAC', '2024-09-0186', 517, 0, '2025-01-07 02:59:01'),
(11, 31, 'New Approved Purchase Order PO No. 2024-11-317', 'BAC', '2024-11-317', 518, 0, '2025-01-07 03:36:19');

-- --------------------------------------------------------

--
-- Table structure for table `po_update_trail`
--

CREATE TABLE `po_update_trail` (
  `id` int(11) NOT NULL,
  `po_id` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `name` varchar(255) DEFAULT NULL,
  `account_type` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `po_update_trail`
--

INSERT INTO `po_update_trail` (`id`, `po_id`, `updated_by`, `updated_at`, `name`, `account_type`) VALUES
(17, 498, 31, '2025-01-03 04:14:43', 'Carolina Codilla', 'BAC'),
(20, 497, 31, '2025-01-04 02:00:21', 'Carolina Codilla', 'BAC'),
(21, 515, 31, '2025-01-04 09:51:17', 'Carolina Codilla', 'BAC'),
(22, 522, 36, '2025-01-09 16:50:20', 'Julito Acebron', 'BAC'),
(23, 525, 37, '2025-01-27 20:36:18', 'User', 'BAC');

-- --------------------------------------------------------

--
-- Table structure for table `po_users`
--

CREATE TABLE `po_users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `profile_picture` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `account_type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `po_users`
--

INSERT INTO `po_users` (`id`, `name`, `username`, `password`, `created_at`, `profile_picture`, `email`, `account_type`) VALUES
(31, 'Carolina Codilla', 'procurement_staff', '$2y$10$YKThgtT2vVFVTdGin/VUde8wqwCXA3SINxxYMJ3FUFlz4J3XfjJVi', '2024-11-15 01:10:05', '../../../uploads/Bagong-Pilipinas.png', 'jzfreaky8@gmail.com', 'BAC'),
(36, 'Julito Acebron', 'admin', '$2y$10$nZWh1UPtlNHkJqKknB2RxOUOIJyD3MdGiPhz8PZNb1b6BqOHkXvo.', '2025-01-09 08:36:55', '../../../uploads/677f8aa7f3e86_Screenshot 2024-11-22 124244.png', 'evsusupplyoffice@evsu.com', 'BAC'),
(37, 'User', 'user1', '$2y$10$XhtrS4bRALVq3zgxTZNqhuRIKLxUmfMoiGFD.H3eL0uYI9ykzDocW', '2025-01-09 11:49:31', '../../../uploads/677fb7cba0035_1_7BE93trr-njcmPwSzdV8Cg.jpg', 'jomareydacuyan430@gmail.com', 'BAC');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_orders`
--

CREATE TABLE `purchase_orders` (
  `id` int(11) NOT NULL,
  `entity_name` varchar(255) NOT NULL,
  `requestor` varchar(255) NOT NULL,
  `requisitioning_office` varchar(255) NOT NULL,
  `supplier` varchar(255) NOT NULL,
  `po_no` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `tin` varchar(20) DEFAULT NULL,
  `mode_procurement` varchar(100) NOT NULL,
  `place_delivery` varchar(255) NOT NULL,
  `delivery_term` varchar(255) NOT NULL,
  `date_delivery` date DEFAULT NULL,
  `payment_term` varchar(255) NOT NULL,
  `total_amount_words` text NOT NULL,
  `signature_supplier` varchar(255) NOT NULL,
  `signature_official` varchar(255) NOT NULL,
  `supplier_date` date DEFAULT NULL,
  `designation` text NOT NULL,
  `fund_cluster` varchar(100) NOT NULL,
  `ors_burs_no` varchar(100) NOT NULL,
  `ors_burs_date` date DEFAULT NULL,
  `funds_available` varchar(255) NOT NULL,
  `ors_burs_amount` decimal(15,2) DEFAULT NULL,
  `signature_accountant` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(20) DEFAULT 'pending',
  `ipo_new` tinyint(1) DEFAULT 0,
  `ppo_new` tinyint(1) DEFAULT 0,
  `spo_new` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `purchase_orders`
--

INSERT INTO `purchase_orders` (`id`, `entity_name`, `requestor`, `requisitioning_office`, `supplier`, `po_no`, `address`, `date`, `tin`, `mode_procurement`, `place_delivery`, `delivery_term`, `date_delivery`, `payment_term`, `total_amount_words`, `signature_supplier`, `signature_official`, `supplier_date`, `designation`, `fund_cluster`, `ors_burs_no`, `ors_burs_date`, `funds_available`, `ors_burs_amount`, `signature_accountant`, `created_at`, `status`, `ipo_new`, `ppo_new`, `spo_new`) VALUES
(496, 'EASTERN VISAYAS STATE UNIVERSITY - ORMOC CAMPUS', 'Dr. Jeffry V. Ocay', 'Campus Director', 'SUNVIR ENTERPRISE', '2024-10-0214', 'Ormoc City', '2024-11-27', '', 'Small Value Procurement', 'EVSU OC, Brgy. Don Felipe Larrazabal, Ormoc City', '1', NULL, 'Check', 'FORTY THREE THOUSAND FIVE HUNDRED PESOS', '', 'Dr. Jeffry V. Ocay', NULL, 'Campus Director', '', '', NULL, '', NULL, 'Angela M Coquilla, CPA', '2024-12-30 19:02:16', 'pending', 1, 1, 1),
(497, 'EASTERN VISAYAS STATE UNIVERSITY - ORMOC CAMPUS', 'Dr. Jeffry V. Ocay', 'Campus Director', 'SHOW GRAPHICS DESIGN ENTERPRISES', '2024-10-0233', 'Ormoc City', '2024-10-10', '', 'Small Value Procurement', 'EVSU OC, Brgy. Don Felipe Larrazabal, Ormoc City', '1', '2024-11-25', 'Check', 'THREE THOUSAND FOUR HUNDRED EIGHTY PESOS', 'RONX C. CARILLO', 'Dr. Jeffry V. Ocay', '2024-11-15', 'Campus Director', 'IGF', '02-05206441-2024-12-771', '2024-11-13', '', 3480.00, 'Angela M. Coquilla, CPA', '2024-12-30 19:07:24', 'approved', 0, 0, 0),
(498, 'EASTERN VISAYAS STATE UNIVERSITY - ORMOC CAMPUS', 'Dr. Jeffry V. Ocay', 'Campus Director', 'ORMOC CARLOSTA HOTEL INC.', '2024-11-0281', 'Ormoc City', '2024-11-27', '', 'Small Value Procurement', 'EVSU OC, Brgy. Don Felipe Larrazabal, Ormoc City', '1', '2024-12-02', 'Check', 'FOUR THOUSAND TWO HUNDRED PESOS', 'Ritchell V. Ymas', 'Dr. Jeffry V. Ocay', '2024-12-02', 'Campus Director', 'IGF', '02-05206441-2024-12-771', '2024-12-02', '', 4200.00, 'Angela M Coquilla, CPA', '2024-12-30 19:14:16', 'approved', 0, 0, 0),
(499, 'EASTERN VISAYAS STATE UNIVERSITY - ORMOC CAMPUS', 'Dr. Jeffry V. Ocay', 'Campus Director', 'FABULOUS ENTERPRISES', '2024-11-0295', 'Ormoc City', '2024-11-27', '', 'Small Value Procurement', 'EVSU OC, Brgy. Don Felipe Larrazabal, Ormoc City', '1', NULL, 'Check', 'FOUR THOUSAND FOUR HUNDRED TWENTY FIVE PESOS', '', 'Jeffry V. Ocay, Ph.D', NULL, 'Campus Director', '', '', NULL, '', NULL, 'Angela M Coquilla, CPA', '2024-12-30 19:27:32', 'pending', 1, 1, 1),
(500, 'EASTERN VISAYAS STATE UNIVERSITY - ORMOC CAMPUS', 'Dr. Jeffry V. Ocay', 'Campus Director', 'FABULOUS ENTERPRISES', '2024-11-0297', 'Ormoc City', '2024-11-27', '', 'Small Value Procurement', 'EVSU OC, Brgy. Don Felipe Larrazabal, Ormoc City', '1', NULL, 'Check', 'NINETEEN THOUSAND FIVE HUNDRED PESOS', '', 'Jeffry V. Ocay, Ph.D', NULL, 'Campus Director', '', '', NULL, '', NULL, 'Angela M Coquilla, CPA', '2024-12-30 19:30:48', 'pending', 1, 1, 1),
(501, 'EASTERN VISAYAS STATE UNIVERSITY - ORMOC CAMPUS', 'Dr. Jeffry V. Ocay', 'Campus Director', 'FABULOUS ENTERPRISES', '2024-11-0301', 'Ormoc City', '2024-11-27', '', 'Small Value Procurement', 'EVSU OC, Brgy. Don Felipe Larrazabal, Ormoc City', '1', NULL, 'Check', 'SEVENTY EIGHT THOUSAND PESOS', '', 'Jeffry V. Ocay, Ph.D', NULL, 'Campus Director', '', '', NULL, '', NULL, 'Angela M Coquilla, CPA', '2024-12-30 19:33:15', 'pending', 1, 1, 1),
(502, 'EASTERN VISAYAS STATE UNIVERSITY - ORMOC CAMPUS', 'Dr. Jeffry V. Ocay', 'Campus Director', 'FABULOUS ENTERPRISES', '2024-11-0302', 'Ormoc City', '2024-11-27', '', 'Small Value Procurement', 'EVSU OC, Brgy. Don Felipe Larrazabal, Ormoc City', '1', NULL, 'Check', 'TWENTY EIGHT THOUSAND SEVENTY EIGHT PESOS', '', 'Jeffry V. Ocay, Ph.D', NULL, 'Campus Director', '', '', NULL, '', NULL, 'Angela M Coquilla, CPA', '2025-01-01 10:11:04', 'pending', 1, 1, 1),
(503, 'EASTERN VISAYAS STATE UNIVERSITY - ORMOC CAMPUS', 'Dr. Jeffry V. Ocay', 'Campus Director', 'GREENWARE CUSTOMISED SYSTEM AND PC ACCESSORIES', '2024-11-0304', 'Ormoc City', '2024-11-27', '', 'Small Value Procurement', 'EVSU OC, Brgy. Don Felipe Larrazabal, Ormoc City', '1', NULL, 'Check', 'SIXTY FIVE THOUSAND SEVEN HUNDRED EIGHTY PESOS', '', 'Jeffry V. Ocay, Ph.D', NULL, 'Campus Director', '', '', NULL, '', NULL, 'Angela M Coquilla, CPA', '2025-01-01 10:29:42', 'pending', 1, 1, 1),
(504, 'EASTERN VISAYAS STATE UNIVERSITY - ORMOC CAMPUS', 'Dr. Jeffry V. Ocay', 'Campus Director', 'COMPUSPEC SALES AND SERVICES', '2024-11-0305', 'Mandaue City, Cebu', '2024-11-27', '', 'Small Value Procurement', 'EVSU OC, Brgy. Don Felipe Larrazabal, Ormoc City', '1', NULL, 'Check', 'NINE THOUSAND EIGHT HUNDRED EIGHTY FIVE PESOS', '', 'Jeffry V. Ocay, Ph.D', NULL, 'Campus Director', '', '', NULL, '', NULL, 'Angela M Coquilla, CPA', '2025-01-01 10:33:24', 'pending', 1, 1, 1),
(505, 'EASTERN VISAYAS STATE UNIVERSITY - ORMOC CAMPUS', 'Dr. Jeffry V. Ocay', 'Campus Director', 'FABULOUS ENTERPRISES', '2024-11-0307', 'Ormoc City', '2024-11-27', '', 'Small Value Procurement', 'EVSU OC, Brgy. Don Felipe Larrazabal, Ormoc City', '1', NULL, 'Check', 'FIVE THOUSAND PESOS', '', 'Jeffry V. Ocay, Ph.D', NULL, 'Campus Director', '', '', NULL, '', NULL, 'Angela M Coquilla, CPA', '2025-01-01 10:36:22', 'pending', 1, 1, 1),
(506, 'EASTERN VISAYAS STATE UNIVERSITY - ORMOC CAMPUS', 'Dr. Jeffry V. Ocay', 'Campus Director', 'MANDAUE FOAM INDUSTRIES, INC.', '2024-11-0308', 'Mandaue City, Cebu', '2024-11-27', '', 'Small Value Procurement', 'EVSU OC, Brgy. Don Felipe Larrazabal, Ormoc City', '1', NULL, 'Check', 'SIX THOUSAND FIVE HUNDRED PESOS', '', 'Jeffry V. Ocay, Ph.D', NULL, 'Campus Director', '', '', NULL, '', NULL, 'Angela M Coquilla, CPA', '2025-01-01 10:46:56', 'pending', 1, 1, 1),
(507, 'EASTERN VISAYAS STATE UNIVERSITY - ORMOC CAMPUS', 'Dr. Jeffry V. Ocay', 'Campus Director', 'SHOPKO MARKETING CORP', '2024-11-0309', 'Ormoc City', '2024-11-27', '', 'Small Value Procurement', 'EVSU OC, Brgy. Don Felipe Larrazabal, Ormoc City', '1', NULL, 'Check', 'FOUR HUNDRED PESOS', '', 'Jeffry V. Ocay, Ph.D', NULL, 'Campus Director', '', '', NULL, '', NULL, 'Angela M Coquilla, CPA', '2025-01-01 10:49:01', 'pending', 1, 1, 1),
(508, 'EASTERN VISAYAS STATE UNIVERSITY - ORMOC CAMPUS', 'Dr. Jeffry V. Ocay', 'Campus Director', 'SINAG SUCCESS ENTERPRISES INC.', '2024-11-0311', 'Ormoc City', '2024-11-27', '', 'Small Value Procurement', 'EVSU OC, Brgy. Don Felipe Larrazabal, Ormoc City', '1', NULL, 'Check', 'THIRTY FOUR THOUSAND SIX HUNDRED SEVENTY PESOS', '', 'Jeffry V. Ocay, Ph.D', NULL, 'Campus Director', '', '', NULL, '', NULL, 'Angela M. Coquilla, CPA', '2025-01-01 10:55:34', 'pending', 1, 1, 1),
(515, 'EASTERN VISAYAS STATE UNIVERSITY - ORMOC CAMPUS', 'Gerry B. de Cadiz, Ph.D., EnP.', 'Campus Director (Former)', 'FABULOUS ENTERPRISES', '2025-01-0001', 'Ormoc City', '2025-01-04', '333-333-333-333', 'Small Value Procurement', 'EVSU OC, Brgy. Don Felipe Larrazabal, Ormoc City', 'DAP (Delivered at Place)', '2025-01-08', 'Check', 'ONE HUNDRED ELEVEN THOUSAND ONE HUNDRED ONE PESOS', 'Marky', 'Jeffry V. Ocay, Ph.D', '2025-01-05', 'Campus Director', 'IGF', '5', '2025-01-04', '', 5.00, 'Angela M. Coquilla, CPA', '2025-01-04 01:47:27', 'approved', 0, 0, 0),
(516, 'EASTERN VISAYAS STATE UNIVERSITY - ORMOC CAMPUS', 'Wilferd Jude A. Perante, MSIT', 'Head, Property Management Office', 'SHIFT TECH TRADING INC.', '2024-07-0142', 'Ormoc City', '2025-07-19', '', 'Small Value Procurement', 'EVSU OC, Brgy. Don Felipe Larrazabal, Ormoc City', '1', NULL, 'Check', 'SEVENTY TWO THOUSAND FIVE HUNDRED PESOS', '', 'Jeffry V. Ocay, Ph.D', NULL, 'Campus Director', '', '', NULL, '', NULL, '', '2025-01-07 02:40:46', 'pending', 1, 1, 1),
(517, 'EASTERN VISAYAS STATE UNIVERSITY - ORMOC CAMPUS', 'Engr. Ruderico M. Endriano, Jr.', 'Engineering Department', 'SAINT JOSEPH CONSTRACTION', '2024-09-0186', 'Ormoc City', '2024-09-13', '', 'Small Value Procurement', 'EVSU OC, Brgy. Don Felipe Larrazabal, Ormoc City', '1', '2024-11-04', 'Check', 'NINETY SIX THOUSAND PESOS', 'LAURO G. PLACIN', 'Jeffry V. Ocay, Ph.D', '2024-10-10', 'Campus Director', 'IGF', '02-05206441-2024-10-771', '2024-10-01', '', 96000.00, 'Angela M. Coquilla, CPA', '2025-01-07 02:56:54', 'approved', 0, 0, 0),
(518, 'EASTERN VISAYAS STATE UNIVERSITY - ORMOC CAMPUS', 'Engr. Ruderico M. Endriano, Jr.', 'Engineering Department', 'FABULOUS ENTERPRISES', '2024-11-317', 'Ormoc City', '2024-11-27', '', 'Small Value Procurement', 'EVSU OC, Brgy. Don Felipe Larrazabal, Ormoc City', '1', '2024-12-23', 'Check', 'THIRTY NINE THOUSAND SIX HUNDRED FIFTY TWO PESOS', 'MARIBETH BULETIN', 'Jeffry V. Ocay, Ph.D', '2024-12-12', 'Campus Director', 'IGF', '02-05206441-2024-12-939', '2024-12-27', '', 39652.00, 'Angela M. Coquilla, CPA', '2025-01-07 03:11:06', 'approved', 0, 0, 0),
(519, 'EASTERN VISAYAS STATE UNIVERSITY - ORMOC CAMPUS', 'Beatrice D. Mabitad, Ed.D.', 'Head, Teacher Education Department', 'SL RUIZ CORPORATION', '2025-01-0002', 'Tacloban City', '2025-01-07', '', 'Small Value Procurement', 'EVSU OC, Brgy. Don Felipe Larrazabal, Ormoc City', '1', '2025-01-03', 'Check', 'NINETEEN THOUSAND TWO HUNDRED NINETY FIVE PESOS', 'Ronalyn P. Bermejo', 'Jeffry V. Ocay, Ph.D', '2024-12-20', 'Campus Director', 'IGF', '', NULL, '', 19295.00, 'ANGELA M. COQUILLA, CPA', '2025-01-07 07:38:22', 'Complete', 0, 0, 0),
(521, 'EASTERN VISAYAS STATE UNIVERSITY - ORMOC CAMPUS', 'Dr. Joel M. Capala', 'Head, Maintenance & Engineering Services Office', 'rl appliance', '2025-01-0003', 'Tacloban City', '2025-01-09', '', 'Small Value Procurement', 'EVSU OC, Brgy. Don Felipe Larrazabal, Ormoc City', 'DAP (Delivered at Place)', NULL, 'Check', 'NINE THOUSAND NINE HUNDRED NINETY FIVE PESOS', '', 'Jeffry V. Ocay, Ph.D', NULL, 'Campus Director', '', '', NULL, '', NULL, '', '2025-01-09 08:22:32', 'pending', 1, 1, 1),
(522, 'EASTERN VISAYAS STATE UNIVERSITY - ORMOC CAMPUS', 'Beatrice D. Mabitad, Ed.D.', 'Head, Teacher Education Department', 'sl ruiz corporation', '2024-11-332', 'Tacloban City', '2024-11-27', '', 'Small Value Procurement', 'EVSU OC, Brgy. Don Felipe Larrazabal, Ormoc City', '1', '2025-01-06', 'Check', 'NINETEEN THOUSAND TWO HUNDRED NINETY FIVE PESOS', 'Ronalyn P. Bermejo', 'Jeffry V. Ocay, Ph.D', '2024-12-20', 'Campus Director', 'IGF', '02-05206441-2024-12-940', '2024-12-27', '', 19295.00, 'ANGELA M. COQUILLA, CPA', '2025-01-09 08:45:00', 'pending', 1, 1, 1),
(525, 'EASTERN VISAYAS STATE UNIVERSITY - ORMOC CAMPUS', 'Gerry B. de Cadiz, Ph.D., EnP.', 'Campus Director (Former)', 'BOSS', '2025-01-0004', 'Ormoc City', '2025-01-27', '123-344-443-443', 'Shopping', 'EVSU OC, Brgy. Don Felipe Larrazabal, Ormoc City', '1', '2025-01-31', 'Check', '', 'MARK GOMEZ', 'Jeffry V. Ocay, Ph.D', '2025-02-04', 'Campus Director', 'IGF', '', '2025-01-27', '', 0.00, 'ANGELA M. COQUILLA, CPA', '2025-01-27 12:34:39', 'pending', 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `purchase_order_items`
--

CREATE TABLE `purchase_order_items` (
  `id` int(11) NOT NULL,
  `po_id` int(11) NOT NULL,
  `stock_no` varchar(100) NOT NULL,
  `unit` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `quantity` int(11) NOT NULL,
  `unit_cost` decimal(15,2) NOT NULL,
  `amount` decimal(15,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_new` tinyint(1) DEFAULT 0,
  `is_news` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `purchase_order_items`
--

INSERT INTO `purchase_order_items` (`id`, `po_id`, `stock_no`, `unit`, `description`, `quantity`, `unit_cost`, `amount`, `created_at`, `is_new`, `is_news`) VALUES
(541, 496, '1', 'unit', '3d printer ender 3 pro, frame material: aluminum profile, power Input: 110/240V, 50/60Hz', 2, 21750.00, 43500.00, '2024-12-30 11:02:16', 0, 0),
(542, 497, '1', 'pc', 'Tarpaulin for gate (4x6 feet)', 1, 360.00, 360.00, '2024-12-30 11:07:24', 0, 0),
(543, 497, '2', 'pc', 'Tarpaulin for Background (6x8 feet)', 1, 720.00, 720.00, '2024-12-30 11:07:24', 0, 0),
(544, 497, '3', 'pc', 'Tarpaulin for Background (20x8 feet)', 1, 2400.00, 2400.00, '2024-12-30 11:07:24', 0, 0),
(545, 498, '1', 'pax', 'Menu:', 12, 350.00, 4200.00, '2024-12-30 11:14:16', 0, 0),
(546, 499, '1', 'pcs', 'Bathroom Tissue 2 ply', 65, 14.00, 910.00, '2024-12-30 11:27:32', 0, 0),
(547, 499, '2', 'pcs', 'Soft Broom (Silhig Lanot)', 4, 70.00, 280.00, '2024-12-30 11:27:32', 0, 0),
(548, 499, '3', 'pcs', 'Broom stick (Silhig Tukog)', 2, 70.00, 140.00, '2024-12-30 11:27:32', 0, 0),
(549, 499, '4', 'set', 'Tomdao mop and spin dry bucket set/ Dimension 46x25x21 cm 1 microfiber mop head', 1, 1695.00, 1695.00, '2024-12-30 11:27:32', 0, 0),
(550, 499, '5', 'packs', 'Garbage bags (Black) (Biodegradable Plastic/ Small 9x9x20 inches)', 25, 23.00, 575.00, '2024-12-30 11:27:32', 0, 0),
(551, 499, '6', 'packs', 'Garbage bags (Black) (Biodegradable Plastic/ Medium 11x11x24 inches)', 25, 24.00, 600.00, '2024-12-30 11:27:32', 0, 0),
(552, 499, '7', 'packs', 'Garbage bags (Black) (Biodegradable Plastic/Large 13x13x32 inches)', 5, 45.00, 225.00, '2024-12-30 11:27:32', 0, 0),
(553, 500, '1', 'unit', 'Toner for photocopier', 1, 19500.00, 19500.00, '2024-12-30 11:30:48', 0, 0),
(554, 501, '1', 'unit', 'Photocopier Toner (Kyocera Taskalfa 2020)', 4, 19500.00, 78000.00, '2024-12-30 11:33:15', 0, 0),
(555, 502, '1', 'ream', 'BondPaper (Long)', 11, 302.00, 3322.00, '2025-01-01 02:11:04', 0, 0),
(556, 502, '2', 'ream', 'BondPaper (short)', 10, 250.00, 2500.00, '2025-01-01 02:11:04', 0, 0),
(557, 502, '3', 'pcs', 'stapler (no.35)', 4, 81.00, 324.00, '2025-01-01 02:11:04', 0, 0),
(558, 502, '4', 'pcs', 'Puncher', 4, 215.00, 860.00, '2025-01-01 02:11:04', 0, 0),
(559, 502, '5', 'pcs', 'Correction Tape', 10, 32.00, 320.00, '2025-01-01 02:11:04', 0, 0),
(560, 502, '6', 'box', 'Binder Clips (32mm)', 10, 56.00, 560.00, '2025-01-01 02:11:04', 0, 0),
(561, 502, '7', 'box', 'Pencil no.2', 2, 154.00, 308.00, '2025-01-01 02:11:04', 0, 0),
(562, 502, '8', 'box', 'Sign Pen (0.5 Black)', 10, 348.00, 3480.00, '2025-01-01 02:11:04', 0, 0),
(563, 502, '9', 'box', 'Sign Pen (0.5 Blue)', 10, 348.00, 3480.00, '2025-01-01 02:11:04', 0, 0),
(564, 502, '10', 'pcs', 'Calculator (Big)', 4, 546.00, 2184.00, '2025-01-01 02:11:04', 0, 0),
(565, 502, '11', 'pcs', 'Log Book (500 Pages)', 5, 128.00, 640.00, '2025-01-01 02:11:04', 0, 0),
(566, 502, '12', 'pcs', 'Transparent Tape (Big)', 5, 70.00, 350.00, '2025-01-01 02:11:04', 0, 0),
(567, 502, '13', 'pcs', 'Brother ink Black (D60bk)', 5, 450.00, 2250.00, '2025-01-01 02:11:04', 0, 0),
(568, 502, '14', 'pcs', 'Brother ink Cyan (BT5000C)', 5, 450.00, 2250.00, '2025-01-01 02:11:04', 0, 0),
(569, 502, '15', 'pcs', 'Brother ink Magenta (BT5000M)', 5, 450.00, 2250.00, '2025-01-01 02:11:04', 0, 0),
(570, 502, '16', 'pcs', 'Brother ink Yellow (BT5000Y)', 5, 450.00, 2250.00, '2025-01-01 02:11:04', 0, 0),
(571, 502, '17', 'box', 'Long Arm Fastener', 5, 150.00, 750.00, '2025-01-01 02:11:04', 0, 0),
(572, 503, '1', 'pc', 'Projector Specs: 5,000 ANSI Lumens (Standard)', 1, 29990.00, 29990.00, '2025-01-01 02:29:42', 0, 0),
(573, 503, '2', 'pc', 'Printer Specs: Print, Scan, Copy', 2, 17895.00, 35790.00, '2025-01-01 02:29:42', 0, 0),
(574, 504, '1', 'pc', 'Epson Ink (Black Color)', 6, 470.00, 2820.00, '2025-01-01 02:33:24', 0, 0),
(575, 504, '2', 'pc', 'Electric Fan', 3, 2355.00, 7065.00, '2025-01-01 02:33:24', 0, 0),
(576, 505, '1', 'pc', 'Steel Bed Frame; Single 36in x 75in; Heavy Duty', 1, 5000.00, 5000.00, '2025-01-01 02:36:22', 0, 0),
(577, 506, '1', 'pc', 'Bed foam mattress; single, 4in x 36in x 75in (66390)', 1, 3050.00, 3050.00, '2025-01-01 02:46:56', 0, 0),
(578, 506, '2', 'set', 'Beadings; Single', 2, 1725.00, 3450.00, '2025-01-01 02:46:56', 0, 0),
(579, 507, '1', 'pc', 'Pillow; Soft, 4.5in x 14in x 23in', 1, 400.00, 400.00, '2025-01-01 02:49:01', 0, 0),
(580, 508, '1', 'btls', 'Printer Ink, Black, Brother, BTD60', 15, 498.00, 7470.00, '2025-01-01 02:55:34', 0, 0),
(581, 508, '2', 'btls', 'Printer Ink, Yellow, Brother, BTD60', 13, 498.00, 6474.00, '2025-01-01 02:55:34', 0, 0),
(582, 508, '3', 'btls', 'Printer Ink, Magenta, Brother, BTD60', 13, 498.00, 6474.00, '2025-01-01 02:55:34', 0, 0),
(583, 508, '4', 'btls', 'Printer Ink, Cyan, Brother, BTD60', 13, 498.00, 6474.00, '2025-01-01 02:55:34', 0, 0),
(584, 508, '5', 'pc', 'External Hard Drive, 2TB', 1, 7778.00, 7778.00, '2025-01-01 02:55:34', 0, 0),
(590, 515, '1', 'set', 'Printer', 3, 3000.00, 9000.00, '2025-01-03 17:47:27', 0, 0),
(591, 515, '2', 'box', 'Bondpaper', 5, 499.99, 2499.95, '2025-01-03 17:47:27', 0, 0),
(592, 515, '3', 'doz', 'Cartolina', 4, 44.00, 176.00, '2025-01-03 17:47:27', 0, 0),
(593, 515, '4', 'kg', 'Ballpen', 5, 50.00, 250.00, '2025-01-03 17:47:27', 0, 0),
(594, 515, '5', 'btls', 'Ink', 4, 44.00, 176.00, '2025-01-03 17:47:27', 0, 0),
(595, 515, '6', 'pc', 'Laptop', 1, 99000.00, 99000.00, '2025-01-03 17:47:27', 0, 0),
(596, 516, '1', 'unit', 'Computer Set', 1, 37000.00, 37000.00, '2025-01-06 18:40:46', 0, 0),
(597, 516, '2', 'unit', 'Printer', 1, 35500.00, 35500.00, '2025-01-06 18:40:46', 0, 0),
(598, 517, '1', 'lot', 'Tiling of Floor at Engineering Department Office at Luna Campus', 1, 96000.00, 96000.00, '2025-01-06 18:56:54', 0, 0),
(599, 518, '1', 'reams', 'Bond paper premium grade. legal 70gsm', 50, 302.00, 15100.00, '2025-01-06 19:11:06', 0, 0),
(600, 518, '2', 'reams', 'Bond paper premium, A4 size, 70gsm', 50, 261.00, 13050.00, '2025-01-06 19:11:06', 0, 0),
(601, 518, '3', 'reams', 'Bond paper premium grade, Short size, 70gsm', 30, 250.00, 7500.00, '2025-01-06 19:11:06', 0, 0),
(602, 518, '4', 'gallons', 'ethyl alcohol', 6, 667.00, 4002.00, '2025-01-06 19:11:06', 0, 0),
(603, 519, '1', 'unit', 'Executive Table ', 1, 19295.00, 19295.00, '2025-01-06 23:38:22', 0, 0),
(606, 521, '1', 'unit', 'Water Dispenser ', 1, 9995.00, 9995.00, '2025-01-09 00:22:32', 0, 0),
(607, 522, '1', 'unit', 'Executive Table', 1, 19295.00, 19295.00, '2025-01-09 00:45:00', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `purchase_order_labels`
--

CREATE TABLE `purchase_order_labels` (
  `id` int(11) NOT NULL,
  `po_id` int(11) DEFAULT NULL,
  `label_no` int(11) NOT NULL,
  `label_text` varchar(255) DEFAULT NULL,
  `label_order` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `purchase_order_labels`
--

INSERT INTO `purchase_order_labels` (`id`, `po_id`, `label_no`, `label_text`, `label_order`) VALUES
(369, 496, 1, '1', NULL),
(370, 497, 1, 'For organization days on November 14-16, 2024', NULL),
(371, 498, 1, 'Meals for Inspectors, Auditors and Facilitators on December 2, 2024', NULL),
(385, 515, 1, 'Office Equipment', NULL),
(386, 516, 1, '1', NULL),
(387, 521, 1, 'Semi-Office Equipment', NULL),
(388, 522, 1, 'Furnitures and Fixtures', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `raf`
--

CREATE TABLE `raf` (
  `id` int(11) NOT NULL,
  `project_description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `raf`
--

INSERT INTO `raf` (`id`, `project_description`) VALUES
(1, 'Trainings, Seminars'),
(2, 'Office Supplies'),
(3, 'Office Equipment');

-- --------------------------------------------------------

--
-- Table structure for table `so_login_logs`
--

CREATE TABLE `so_login_logs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `account_type` varchar(255) NOT NULL,
  `login_time` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `so_login_logs`
--

INSERT INTO `so_login_logs` (`id`, `user_id`, `account_type`, `login_time`, `name`) VALUES
(5, 35, 'Inspector', '2024-11-25 12:04:18', 'Alan Reynaldo E. Mabitad'),
(6, 36, 'Property Custodian', '2024-11-25 12:04:42', 'Wilferd Jude A. Perante'),
(7, 37, 'Supply Office Staff', '2024-11-25 12:05:24', 'Natahaniel'),
(8, 35, 'Inspector', '2024-11-25 12:08:24', 'Alan Reynaldo E. Mabitad'),
(9, 35, 'Inspector', '2024-11-25 12:09:06', 'Alan Reynaldo E. Mabitad'),
(10, 35, 'Inspector', '2024-11-25 21:00:56', 'Alan Reynaldo E. Mabitad'),
(11, 35, 'Inspector', '2024-11-25 21:14:36', 'Alan Reynaldo E. Mabitad'),
(12, 35, 'Inspector', '2024-11-25 22:29:40', 'Alan Reynaldo E. Mabitad'),
(13, 36, 'Property Custodian', '2024-11-25 22:33:32', 'Wilferd Jude A. Perante'),
(14, 35, 'Inspector', '2024-11-25 22:46:24', 'Alan Reynaldo E. Mabitad'),
(15, 37, 'Supply Office Staff', '2024-11-25 23:07:48', 'Natahaniel'),
(16, 36, 'Property Custodian', '2024-11-25 23:12:49', 'Wilferd Jude A. Perante'),
(17, 35, 'Inspector', '2024-11-25 23:17:23', 'Alan Reynaldo E. Mabitad'),
(18, 35, 'Inspector', '2024-11-25 23:22:16', 'Alan Reynaldo E. Mabitad'),
(19, 35, 'Inspector', '2024-11-26 00:39:31', 'Alan Reynaldo E. Mabitad'),
(20, 35, 'Inspector', '2024-11-26 02:16:13', 'Alan Reynaldo E. Mabitad'),
(21, 35, 'Inspector', '2024-11-26 02:19:44', 'Alan Reynaldo E. Mabitad'),
(22, 35, 'Inspector', '2024-11-26 10:03:04', 'Alan Reynaldo E. Mabitad'),
(23, 35, 'Inspector', '2024-11-27 02:48:58', 'Alan Reynaldo E. Mabitad'),
(24, 37, 'Supply Office Staff', '2024-11-27 03:57:24', 'Natahaniel'),
(25, 35, 'Inspector', '2024-11-27 03:59:00', 'Alan Reynaldo E. Mabitad'),
(26, 37, 'Supply Office Staff', '2024-11-27 04:01:27', 'Natahaniel'),
(27, 35, 'Inspector', '2024-11-27 04:02:09', 'Alan Reynaldo E. Mabitad'),
(28, 36, 'Property Custodian', '2024-11-27 09:32:28', 'Wilferd Jude A. Perante'),
(29, 36, 'Property Custodian', '2024-11-27 09:33:24', 'Wilferd Jude A. Perante'),
(30, 36, 'Property Custodian', '2024-11-27 09:34:03', 'Wilferd Jude A. Perante'),
(31, 35, 'Inspector', '2024-11-27 09:34:21', 'Alan Reynaldo E. Mabitad'),
(32, 35, 'Inspector', '2024-11-27 09:35:34', 'Alan Reynaldo E. Mabitad'),
(33, 35, 'Inspector', '2024-11-27 11:43:13', 'Alan Reynaldo E. Mabitad'),
(34, 35, 'Inspector', '2024-11-27 13:28:09', 'Alan Reynaldo E. Mabitad'),
(35, 35, 'Inspector', '2024-11-27 13:53:09', 'Alan Reynaldo E. Mabitad'),
(36, 35, 'Inspector', '2024-11-27 19:37:37', 'Alan Reynaldo E. Mabitad'),
(37, 36, 'Property Custodian', '2024-11-27 19:42:02', 'Wilferd Jude A. Perante'),
(38, 35, 'Inspector', '2024-11-28 21:46:16', 'Alan Reynaldo E. Mabitad'),
(39, 35, 'Inspector', '2024-11-29 02:38:56', 'Alan Reynaldo E. Mabitad'),
(40, 35, 'Inspector', '2024-11-29 02:47:04', 'Alan Reynaldo E. Mabitad'),
(41, 36, 'Property Custodian', '2024-11-29 03:54:07', 'Wilferd Jude A. Perante'),
(42, 37, 'Supply Office Staff', '2024-11-29 04:19:47', 'Natahaniel'),
(43, 35, 'Inspector', '2024-11-29 09:39:24', 'Alan Reynaldo E. Mabitad'),
(44, 36, 'Property Custodian', '2024-11-29 10:02:30', 'Wilferd Jude A. Perante'),
(45, 35, 'Inspector', '2024-11-29 10:05:14', 'Alan Reynaldo E. Mabitad'),
(46, 36, 'Property Custodian', '2024-11-29 10:08:42', 'Wilferd Jude A. Perante'),
(47, 35, 'Inspector', '2024-11-29 14:39:28', 'Alan Reynaldo E. Mabitad'),
(48, 37, 'Supply Office Staff', '2024-11-29 16:36:46', 'Natahaniel'),
(49, 35, 'Inspector', '2024-11-30 00:04:44', 'Alan Reynaldo E. Mabitad'),
(50, 37, 'Supply Office Staff', '2024-11-30 00:12:08', 'Natahaniel'),
(51, 35, 'Inspector', '2024-11-30 00:31:13', 'Alan Reynaldo E. Mabitad'),
(52, 37, 'Supply Office Staff', '2024-11-30 00:32:10', 'Natahaniel'),
(53, 37, 'Supply Office Staff', '2024-11-30 04:24:45', 'Natahaniel'),
(54, 37, 'Supply Office Staff', '2024-11-30 04:36:28', 'Natahaniel'),
(55, 35, 'Inspector', '2024-11-30 04:38:16', 'Alan Reynaldo E. Mabitad'),
(56, 37, 'Supply Office Staff', '2024-11-30 04:38:48', 'Natahaniel'),
(57, 37, 'Supply Office Staff', '2024-11-30 04:46:12', 'Natahaniel'),
(58, 37, 'Supply Office Staff', '2024-11-30 04:47:58', 'Natahaniel'),
(59, 35, 'Inspector', '2024-11-30 04:57:20', 'Alan Reynaldo E. Mabitad'),
(60, 35, 'Inspector', '2024-11-30 05:14:20', 'Alan Reynaldo E. Mabitad'),
(61, 37, 'Supply Office Staff', '2024-11-30 05:16:22', 'Natahaniel'),
(62, 35, 'Inspector', '2024-11-30 09:41:21', 'Alan Reynaldo E. Mabitad'),
(63, 37, 'Supply Office Staff', '2024-11-30 09:41:35', 'Natahaniel'),
(64, 35, 'Inspector', '2024-11-30 09:53:09', 'Alan Reynaldo E. Mabitad'),
(65, 35, 'Inspector', '2024-11-30 12:15:36', 'Alan Reynaldo E. Mabitad'),
(66, 37, 'Supply Office Staff', '2024-11-30 18:11:10', 'Natahaniel'),
(67, 35, 'Inspector', '2024-11-30 18:11:20', 'Alan Reynaldo E. Mabitad'),
(68, 37, 'Supply Office Staff', '2024-11-30 21:30:48', 'Natahaniel'),
(69, 35, 'Inspector', '2024-11-30 21:31:07', 'Alan Reynaldo E. Mabitad'),
(70, 36, 'Property Custodian', '2024-11-30 21:34:15', 'Wilferd Jude A. Perante'),
(71, 37, 'Supply Office Staff', '2024-11-30 21:34:34', 'Natahaniel'),
(72, 36, 'Property Custodian', '2024-11-30 21:41:24', 'Wilferd Jude A. Perante'),
(73, 37, 'Supply Office Staff', '2024-11-30 21:42:59', 'Natahaniel'),
(74, 35, 'Inspector', '2024-11-30 21:59:13', 'Alan Reynaldo E. Mabitad'),
(75, 35, 'Inspector', '2024-12-01 05:05:16', 'Alan Reynaldo E. Mabitad'),
(76, 36, 'Property Custodian', '2024-12-01 05:20:08', 'Wilferd Jude A. Perante'),
(77, 35, 'Inspector', '2024-12-01 05:20:55', 'Alan Reynaldo E. Mabitad'),
(78, 36, 'Property Custodian', '2024-12-01 05:21:07', 'Wilferd Jude A. Perante'),
(79, 37, 'Supply Office Staff', '2024-12-01 05:26:12', 'Natahaniel'),
(80, 37, 'Supply Office Staff', '2024-12-01 10:40:56', 'Natahaniel'),
(81, 37, 'Supply Office Staff', '2024-12-01 12:45:26', 'Natahaniel'),
(82, 35, 'Inspector', '2024-12-01 12:46:18', 'Alan Reynaldo E. Mabitad'),
(83, 37, 'Supply Office Staff', '2024-12-01 16:27:16', 'Natahaniel'),
(84, 37, 'Supply Office Staff', '2024-12-01 16:36:54', 'Natahaniel'),
(85, 35, 'Inspector', '2024-12-01 16:37:43', 'Alan Reynaldo E. Mabitad'),
(86, 37, 'Supply Office Staff', '2024-12-01 16:39:47', 'Natahaniel'),
(87, 37, 'Supply Office Staff', '2024-12-01 16:47:16', 'Natahaniel'),
(88, 35, 'Inspector', '2024-12-01 16:49:50', 'Alan Reynaldo E. Mabitad'),
(89, 37, 'Supply Office Staff', '2024-12-01 17:03:00', 'Natahaniel'),
(90, 35, 'Inspector', '2024-12-01 17:28:28', 'Alan Reynaldo E. Mabitad'),
(91, 36, 'Property Custodian', '2024-12-01 17:36:36', 'Wilferd Jude A. Perante'),
(92, 35, 'Inspector', '2024-12-01 17:56:32', 'Alan Reynaldo E. Mabitad'),
(93, 35, 'Inspector', '2024-12-01 17:57:22', 'Alan Reynaldo E. Mabitad'),
(94, 35, 'Inspector', '2024-12-01 18:07:09', 'Alan Reynaldo E. Mabitad'),
(95, 35, 'Inspector', '2024-12-01 18:09:15', 'Alan Reynaldo E. Mabitad'),
(96, 35, 'Inspector', '2024-12-01 18:47:35', 'Alan Reynaldo E. Mabitad'),
(97, 35, 'Inspector', '2024-12-01 18:48:07', 'Alan Reynaldo E. Mabitad'),
(98, 36, 'Property Custodian', '2024-12-01 18:48:21', 'Wilferd Jude A. Perante'),
(99, 37, 'Supply Office Staff', '2024-12-01 18:49:17', 'Natahaniel'),
(100, 36, 'Property Custodian', '2024-12-01 20:01:13', 'Wilferd Jude A. Perante'),
(101, 35, 'Inspector', '2024-12-01 20:16:20', 'Alan Reynaldo E. Mabitad'),
(102, 37, 'Supply Office Staff', '2024-12-01 20:16:55', 'Natahaniel Barbac'),
(103, 36, 'Property Custodian', '2024-12-01 20:17:21', 'Wilferd Jude A. Perante'),
(104, 36, 'Property Custodian', '2024-12-01 20:29:54', 'Wilferd Jude A. Perante'),
(105, 37, 'Supply Office Staff', '2024-12-02 01:38:15', 'Natahaniel Barbac'),
(106, 37, 'Supply Office Staff', '2024-12-02 01:41:13', 'Natahaniel Barbac'),
(107, 35, 'Inspector', '2024-12-02 01:43:45', 'Alan Reynaldo E. Mabitad'),
(108, 36, 'Property Custodian', '2024-12-02 01:47:23', 'Wilferd Jude A. Perante'),
(109, 36, 'Property Custodian', '2024-12-02 01:51:29', 'Wilferd Jude A. Perante'),
(110, 37, 'Supply Office Staff', '2024-12-02 06:32:02', 'Natahaniel Barbac'),
(111, 35, 'Inspector', '2024-12-02 06:44:20', 'Alan Reynaldo E. Mabitad'),
(112, 37, 'Supply Office Staff', '2024-12-02 09:47:52', 'Natahaniel Barbac'),
(113, 35, 'Inspector', '2024-12-02 09:54:36', 'Alan Reynaldo E. Mabitad'),
(114, 36, 'Property Custodian', '2024-12-02 11:35:56', 'Wilferd Jude A. Perante'),
(115, 37, 'Supply Office Staff', '2024-12-02 11:43:54', 'Natahaniel Barbac'),
(116, 35, 'Inspector', '2024-12-02 23:50:13', 'Alan Reynaldo E. Mabitad'),
(117, 35, 'Inspector', '2024-12-03 00:03:01', 'Alan Reynaldo E. Mabitad'),
(118, 35, 'Inspector', '2024-12-03 01:18:46', 'Alan Reynaldo E. Mabitad'),
(119, 36, 'Property Custodian', '2024-12-03 09:32:03', 'Wilferd Jude A. Perante'),
(120, 35, 'Inspector', '2024-12-03 09:42:11', 'Alan Reynaldo E. Mabitad'),
(121, 36, 'Property Custodian', '2024-12-03 09:53:52', 'Wilferd Jude A. Perante'),
(122, 37, 'Supply Office Staff', '2024-12-03 09:56:17', 'Natahaniel Barbac'),
(123, 36, 'Property Custodian', '2024-12-03 23:15:02', 'Wilferd Jude A. Perante'),
(124, 35, 'Inspector', '2024-12-03 23:18:17', 'Alan Reynaldo E. Mabitad'),
(125, 35, 'Inspector', '2024-12-03 23:22:02', 'Alan Reynaldo E. Mabitad'),
(126, 35, 'Inspector', '2024-12-29 03:49:43', 'Alan Reynaldo E. Mabitad'),
(127, 36, 'Property Custodian', '2024-12-29 03:59:54', 'Wilferd Jude A. Perante'),
(128, 35, 'Inspector', '2024-12-29 04:06:47', 'Alan Reynaldo E. Mabitad'),
(129, 36, 'Property Custodian', '2024-12-29 04:11:22', 'Wilferd Jude A. Perante'),
(130, 37, 'Supply Office Staff', '2024-12-29 04:20:22', 'Natahaniel Barbac'),
(131, 35, 'Inspector', '2024-12-29 23:43:42', 'Alan Reynaldo E. Mabitad'),
(132, 37, 'Supply Office Staff', '2025-01-03 04:15:41', 'Natahaniel Barbac'),
(133, 35, 'Inspector', '2025-01-03 04:54:22', 'Alan Reynaldo E. Mabitad'),
(134, 35, 'Inspector', '2025-01-03 08:34:20', 'Alan Reynaldo E. Mabitad'),
(135, 35, 'Inspector', '2025-01-03 09:58:56', 'Alan Reynaldo E. Mabitad'),
(136, 35, 'Inspector', '2025-01-03 13:08:43', 'Alan Reynaldo E. Mabitad'),
(137, 35, 'Inspector', '2025-01-03 13:11:34', 'Alan Reynaldo E. Mabitad'),
(138, 36, 'Property Custodian', '2025-01-03 13:21:58', 'Wilferd Jude A. Perante'),
(139, 37, 'Supply Office Staff', '2025-01-03 16:18:07', 'Natahaniel Barbac'),
(140, 37, 'Supply Office Staff', '2025-01-03 16:21:21', 'Natahaniel Barbac'),
(141, 35, 'Inspector', '2025-01-03 16:34:39', 'Alan Reynaldo E. Mabitad'),
(142, 37, 'Supply Office Staff', '2025-01-04 00:28:12', 'Natahaniel Barbac'),
(143, 37, 'Supply Office Staff', '2025-01-04 00:41:15', 'Natahaniel Barbac'),
(144, 35, 'Inspector', '2025-01-04 00:42:41', 'Alan Reynaldo E. Mabitad'),
(145, 36, 'Property Custodian', '2025-01-04 00:52:17', 'Wilferd Jude A. Perante'),
(146, 35, 'Inspector', '2025-01-04 00:53:08', 'Alan Reynaldo E. Mabitad'),
(147, 35, 'Inspector', '2025-01-04 00:55:53', 'Alan Reynaldo E. Mabitad'),
(148, 36, 'Property Custodian', '2025-01-04 00:56:25', 'Wilferd Jude A. Perante'),
(149, 35, 'Inspector', '2025-01-04 00:58:21', 'Alan Reynaldo E. Mabitad'),
(150, 37, 'Supply Office Staff', '2025-01-04 01:01:08', 'Natahaniel Barbac'),
(151, 36, 'Property Custodian', '2025-01-04 01:04:24', 'Wilferd Jude A. Perante'),
(152, 37, 'Supply Office Staff', '2025-01-04 01:47:59', 'Natahaniel Barbac'),
(153, 35, 'Inspector', '2025-01-04 02:03:30', 'Alan Reynaldo E. Mabitad'),
(154, 37, 'Supply Office Staff', '2025-01-04 02:03:55', 'Natahaniel Barbac'),
(155, 35, 'Inspector', '2025-01-04 02:05:27', 'Alan Reynaldo E. Mabitad'),
(156, 37, 'Supply Office Staff', '2025-01-04 02:10:45', 'Natahaniel Barbac'),
(157, 36, 'Property Custodian', '2025-01-04 02:11:24', 'Wilferd Jude A. Perante'),
(158, 35, 'Inspector', '2025-01-04 02:25:29', 'Alan Reynaldo E. Mabitad'),
(159, 37, 'Supply Office Staff', '2025-01-04 09:52:22', 'Natahaniel Barbac'),
(160, 35, 'Inspector', '2025-01-04 10:02:09', 'Alan Reynaldo E. Mabitad'),
(161, 35, 'Inspector', '2025-01-04 12:52:30', 'Alan Reynaldo E. Mabitad'),
(162, 35, 'Inspector', '2025-01-06 10:39:39', 'Alan Reynaldo E. Mabitad'),
(163, 35, 'Inspector', '2025-01-07 07:35:59', 'Alan Reynaldo E. Mabitad'),
(164, 36, 'Property Custodian', '2025-01-07 07:41:28', 'Wilferd Jude A. Perante'),
(165, 35, 'Inspector', '2025-01-07 11:37:49', 'Alan Reynaldo E. Mabitad'),
(166, 35, 'Inspector', '2025-01-07 14:44:46', 'Alan Reynaldo E. Mabitad'),
(167, 35, 'Inspector', '2025-01-07 15:04:28', 'Alan Reynaldo E. Mabitad'),
(168, 36, 'Property Custodian', '2025-01-07 15:48:05', 'Wilferd Jude A. Perante'),
(169, 36, 'Property Custodian', '2025-01-07 16:19:31', 'Wilferd Jude A. Perante'),
(170, 36, 'Property Custodian', '2025-01-07 17:14:37', 'Wilferd Jude A. Perante'),
(171, 35, 'Inspector', '2025-01-07 17:17:24', 'Alan Reynaldo E. Mabitad'),
(172, 35, 'Inspector', '2025-01-08 01:29:31', 'Alan Reynaldo E. Mabitad'),
(173, 35, 'Inspector', '2025-01-08 18:19:49', 'Alan Reynaldo E. Mabitad'),
(174, 37, 'Supply Office Staff', '2025-01-09 11:06:29', 'Natahaniel Barbac'),
(175, 37, 'Supply Office Staff', '2025-01-09 12:11:19', 'Natahaniel Barbac'),
(176, 37, 'Supply Office Staff', '2025-01-09 13:19:46', 'Natahaniel Barbac'),
(177, 35, 'Inspector', '2025-01-09 13:24:54', 'Alan Reynaldo E. Mabitad'),
(178, 36, 'Property Custodian', '2025-01-09 17:21:48', 'Wilferd Jude A. Perante'),
(179, 37, 'Supply Office Staff', '2025-01-09 19:50:42', 'Natahaniel Barbac'),
(180, 35, 'Inspector', '2025-01-09 21:06:11', 'Alan Reynaldo E. Mabitad'),
(181, 35, 'Inspector', '2025-01-09 21:58:51', 'Alan Reynaldo E. Mabitad'),
(182, 37, 'Supply Office Staff', '2025-01-09 23:32:31', 'Natahaniel Barbac'),
(183, 35, 'Inspector', '2025-01-10 01:27:26', 'Alan Reynaldo E. Mabitad'),
(184, 35, 'Inspector', '2025-01-10 09:48:25', 'Alan Reynaldo E. Mabitad'),
(185, 35, 'Inspector', '2025-01-10 10:11:47', 'Alan Reynaldo E. Mabitad'),
(186, 35, 'Inspector', '2025-01-10 14:22:13', 'Alan Reynaldo E. Mabitad'),
(187, 36, 'Property Custodian', '2025-01-10 15:14:34', 'Wilferd Jude A. Perante'),
(188, 35, 'Inspector', '2025-01-10 15:17:52', 'Alan Reynaldo E. Mabitad'),
(189, 37, 'Supply Office Staff', '2025-01-10 15:19:13', 'Natahaniel Barbac'),
(190, 36, 'Property Custodian', '2025-01-10 15:22:54', 'Wilferd Jude A. Perante'),
(191, 37, 'Supply Office Staff', '2025-01-10 15:24:44', 'Natahaniel Barbac'),
(192, 36, 'Property Custodian', '2025-01-10 15:27:20', 'Wilferd Jude A. Perante'),
(193, 36, 'Property Custodian', '2025-01-10 15:31:16', 'Wilferd Jude A. Perante'),
(194, 35, 'Inspector', '2025-01-10 15:33:04', 'Alan Reynaldo E. Mabitad'),
(195, 35, 'Inspector', '2025-01-10 15:43:43', 'Alan Reynaldo E. Mabitad'),
(196, 36, 'Property Custodian', '2025-01-10 15:45:01', 'Wilferd Jude A. Perante'),
(197, 36, 'Property Custodian', '2025-01-10 15:45:52', 'Wilferd Jude A. Perante'),
(198, 35, 'Inspector', '2025-01-10 15:56:38', 'Alan Reynaldo E. Mabitad'),
(199, 36, 'Property Custodian', '2025-01-10 16:15:30', 'Wilferd Jude A. Perante'),
(200, 35, 'Inspector', '2025-01-10 16:17:03', 'Alan Reynaldo E. Mabitad'),
(201, 36, 'Property Custodian', '2025-01-10 16:19:49', 'Wilferd Jude A. Perante'),
(202, 36, 'Property Custodian', '2025-01-10 16:36:50', 'Wilferd Jude A. Perante'),
(203, 35, 'Inspector', '2025-01-11 14:26:08', 'Alan Reynaldo E. Mabitad'),
(204, 35, 'Inspector', '2025-01-11 21:54:38', 'Alan Reynaldo E. Mabitad'),
(205, 35, 'Inspector', '2025-01-11 21:57:23', 'Alan Reynaldo E. Mabitad'),
(206, 35, 'Inspector', '2025-01-11 22:40:09', 'Alan Reynaldo E. Mabitad'),
(207, 36, 'Property Custodian', '2025-01-11 22:47:30', 'Wilferd Jude A. Perante'),
(208, 35, 'Inspector', '2025-01-12 04:38:08', 'Alan Reynaldo E. Mabitad'),
(209, 36, 'Property Custodian', '2025-01-12 05:14:56', 'Wilferd Jude A. Perante'),
(210, 35, 'Inspector', '2025-01-12 05:28:27', 'Alan Reynaldo E. Mabitad'),
(211, 37, 'Supply Office Staff', '2025-01-12 05:31:45', 'Natahaniel Barbac'),
(212, 36, 'Property Custodian', '2025-01-12 08:42:22', 'Wilferd Jude A. Perante'),
(213, 36, 'Property Custodian', '2025-01-12 08:45:25', 'Joel V. Mari'),
(214, 35, 'Inspector', '2025-01-12 22:02:59', 'Alan Reynaldo E. Mabitad'),
(215, 36, 'Property Custodian', '2025-01-12 22:11:49', 'Joel V. Mari'),
(216, 35, 'Inspector', '2025-01-12 23:36:51', 'Alan Reynaldo E. Mabitad'),
(217, 35, 'Inspector', '2025-01-13 07:34:12', 'Alan Reynaldo E. Mabitad'),
(218, 35, 'Inspector', '2025-01-13 09:36:03', 'Alan Reynaldo E. Mabitad'),
(219, 35, 'Inspector', '2025-01-13 09:50:00', 'Alan Reynaldo E. Mabitad'),
(220, 35, 'Inspector', '2025-01-13 10:08:34', 'Alan Reynaldo E. Mabitad'),
(221, 37, 'Supply Office Staff', '2025-01-13 10:09:53', 'Natahaniel Barbac'),
(222, 35, 'Inspector', '2025-01-13 10:27:48', 'Alan Reynaldo E. Mabitad'),
(223, 37, 'Supply Office Staff', '2025-01-14 08:25:08', 'Natahaniel Barbac'),
(224, 35, 'Inspector', '2025-01-14 09:13:02', 'Alan Reynaldo E. Mabitad'),
(225, 37, 'Supply Office Staff', '2025-01-14 09:28:20', 'Natahaniel Barbac'),
(226, 35, 'Inspector', '2025-01-14 09:28:54', 'Alan Reynaldo E. Mabitad'),
(227, 37, 'Supply Office Staff', '2025-01-14 09:30:12', 'Natahaniel Barbac'),
(228, 35, 'Inspector', '2025-01-14 09:30:40', 'Alan Reynaldo E. Mabitad'),
(229, 37, 'Supply Office Staff', '2025-01-14 09:32:05', 'Natahaniel Barbac'),
(230, 35, 'Inspector', '2025-01-14 09:32:44', 'Alan Reynaldo E. Mabitad'),
(231, 35, 'Inspector', '2025-01-14 11:40:19', 'Alan Reynaldo E. Mabitad'),
(232, 37, 'Supply Office Staff', '2025-01-14 12:04:04', 'Natahaniel Barbac'),
(233, 36, 'Property Custodian', '2025-01-14 12:06:44', 'Joel V. Mari'),
(234, 35, 'Inspector', '2025-01-14 12:33:04', 'Alan Reynaldo E. Mabitad'),
(235, 37, 'Supply Office Staff', '2025-01-14 12:33:13', 'Natahaniel Barbac'),
(236, 35, 'Inspector', '2025-01-14 12:37:46', 'Alan Reynaldo E. Mabitad'),
(237, 37, 'Supply Office Staff', '2025-01-14 12:38:08', 'Natahaniel Barbac'),
(238, 35, 'Inspector', '2025-01-14 12:38:31', 'Alan Reynaldo E. Mabitad'),
(239, 37, 'Supply Office Staff', '2025-01-14 13:41:16', 'Natahaniel Barbac'),
(240, 35, 'Inspector', '2025-01-14 13:44:59', 'Alan Reynaldo E. Mabitad'),
(241, 37, 'Supply Office Staff', '2025-01-14 13:45:29', 'Natahaniel Barbac'),
(242, 35, 'Inspector', '2025-01-14 13:47:18', 'Alan Reynaldo E. Mabitad'),
(243, 37, 'Supply Office Staff', '2025-01-14 13:50:46', 'Natahaniel Barbac'),
(244, 35, 'Inspector', '2025-01-18 22:06:12', 'Alan Reynaldo E. Mabitad'),
(245, 35, 'Inspector', '2025-01-27 22:36:09', 'Alan Reynaldo E. Mabitad'),
(246, 37, 'Supply Office Staff', '2025-01-28 01:01:27', 'Natahaniel Barbac'),
(247, 37, 'Supply Office Staff', '2025-01-28 01:20:17', 'Natahaniel Barbac'),
(248, 37, 'Supply Office Staff', '2025-01-28 12:52:16', 'Natahaniel Barbac'),
(249, 35, 'Inspector', '2025-01-28 14:07:44', 'Alan Reynaldo E. Mabitad'),
(250, 35, 'Inspector', '2025-01-28 16:23:20', 'Alan Reynaldo E. Mabitad'),
(251, 36, 'Property Custodian', '2025-01-28 16:59:27', 'Joel V. Mari'),
(252, 38, 'Inspector', '2025-02-28 05:42:01', 'Supply_Office'),
(253, 38, 'Inspector', '2025-02-28 05:42:06', 'Supply_Office'),
(254, 38, 'Inspector', '2025-02-28 05:42:19', 'Supply_Office'),
(255, 38, 'Inspector', '2025-02-28 05:45:23', 'Supply_Office'),
(256, 35, 'Inspector', '2025-02-28 05:46:05', 'Alan Reynaldo E. Mabitad'),
(257, 38, 'Inspector', '2025-02-28 05:46:42', 'Supply_Office'),
(258, 36, 'Property Custodian', '2025-02-28 05:47:03', 'Joel V. Mari'),
(259, 35, 'Inspector', '2025-02-28 05:47:41', 'Alan Reynaldo E. Mabitad'),
(260, 36, 'Property Custodian', '2025-02-28 05:47:50', 'Joel V. Mari'),
(261, 37, 'Supply Office Staff', '2025-02-28 05:48:22', 'Natahaniel Barbac'),
(262, 37, 'Supply Office Staff', '2025-02-28 05:49:11', 'Natahaniel Barbac'),
(263, 35, 'Inspector', '2025-02-28 05:53:21', 'Alan Reynaldo E. Mabitad'),
(264, 37, 'Supply Office Staff', '2025-02-28 05:53:35', 'Natahaniel Barbac'),
(265, 37, 'Supply Office Staff', '2025-03-02 12:40:26', 'Natahaniel Barbac'),
(266, 37, 'Supply Office Staff', '2025-03-02 13:48:10', 'Natahaniel Barbac'),
(267, 37, 'Supply Office Staff', '2025-03-02 23:52:24', 'Natahaniel Barbac'),
(268, 35, 'Inspector', '2025-03-03 01:33:31', 'Alan Reynaldo E. Mabitad'),
(269, 36, 'Property Custodian', '2025-03-03 01:39:19', 'Joel V. Mari'),
(270, 37, 'Supply Office Staff', '2025-03-03 01:41:18', 'Natahaniel Barbac'),
(271, 37, 'Supply Office Staff', '2025-03-04 05:16:12', 'Natahaniel Barbac'),
(272, 35, 'Inspector', '2025-03-05 00:34:42', 'Alan Reynaldo E. Mabitad'),
(273, 37, 'Supply Office Staff', '2025-03-05 00:35:17', 'Natahaniel Barbac'),
(274, 35, 'Inspector', '2025-03-05 00:39:18', 'Alan Reynaldo E. Mabitad'),
(275, 36, 'Property Custodian', '2025-03-05 00:43:21', 'Joel V. Mari'),
(276, 35, 'Inspector', '2025-03-05 00:44:38', 'Alan Reynaldo E. Mabitad'),
(277, 35, 'Inspector', '2025-03-06 00:28:37', 'Alan Reynaldo E. Mabitad'),
(278, 37, 'Supply Office Staff', '2025-03-06 00:29:28', 'Natahaniel Barbac'),
(279, 35, 'Inspector', '2025-03-06 01:08:50', 'Alan Reynaldo E. Mabitad'),
(280, 37, 'Supply Office Staff', '2025-03-06 01:10:40', 'Natahaniel Barbac'),
(281, 35, 'Inspector', '2025-03-07 00:26:11', 'Alan Reynaldo E. Mabitad'),
(282, 37, 'Supply Office Staff', '2025-03-07 00:36:18', 'Natahaniel Barbac'),
(283, 35, 'Inspector', '2025-03-07 00:51:22', 'Alan Reynaldo E. Mabitad'),
(284, 37, 'Supply Office Staff', '2025-03-07 00:53:48', 'Natahaniel Barbac'),
(285, 35, 'Inspector', '2025-03-07 00:56:14', 'Alan Reynaldo E. Mabitad'),
(286, 37, 'Supply Office Staff', '2025-03-10 00:37:07', 'Natahaniel Barbac'),
(287, 35, 'Inspector', '2025-03-10 01:52:01', 'Alan Reynaldo E. Mabitad'),
(288, 37, 'Supply Office Staff', '2025-03-11 01:14:04', 'Natahaniel Barbac'),
(289, 35, 'Inspector', '2025-03-12 00:30:33', 'Alan Reynaldo E. Mabitad'),
(290, 37, 'Supply Office Staff', '2025-03-12 00:31:20', 'Natahaniel Barbac'),
(291, 37, 'Supply Office Staff', '2025-03-12 00:52:31', 'Natahaniel Barbac'),
(292, 35, 'Inspector', '2025-03-12 01:02:16', 'Alan Reynaldo E. Mabitad'),
(293, 35, 'Inspector', '2025-03-12 01:26:00', 'Alan Reynaldo E. Mabitad'),
(294, 35, 'Inspector', '2025-03-12 01:32:09', 'Alan Reynaldo E. Mabitad'),
(295, 37, 'Supply Office Staff', '2025-03-12 07:32:15', 'Natahaniel Barbac'),
(296, 35, 'Inspector', '2025-03-12 07:46:42', 'Alan Reynaldo E. Mabitad'),
(297, 35, 'Inspector', '2025-03-14 01:27:51', 'Alan Reynaldo E. Mabitad'),
(298, 37, 'Supply Office Staff', '2025-03-14 02:15:01', 'Natahaniel Barbac'),
(299, 35, 'Inspector', '2025-03-14 02:15:59', 'Alan Reynaldo E. Mabitad'),
(300, 35, 'Inspector', '2025-03-14 02:20:19', 'Alan Reynaldo E. Mabitad'),
(301, 37, 'Supply Office Staff', '2025-03-17 00:29:09', 'Natahaniel Barbac'),
(302, 35, 'Inspector', '2025-03-17 02:11:04', 'Alan Reynaldo E. Mabitad'),
(303, 37, 'Supply Office Staff', '2025-03-17 07:07:00', 'Natahaniel Barbac'),
(304, 35, 'Inspector', '2025-03-17 07:09:45', 'Alan Reynaldo E. Mabitad'),
(305, 35, 'Inspector', '2025-03-17 07:55:23', 'Alan Reynaldo E. Mabitad'),
(306, 35, 'Inspector', '2025-03-18 00:22:28', 'Alan Reynaldo E. Mabitad'),
(307, 37, 'Supply Office Staff', '2025-03-19 00:29:08', 'Natahaniel Barbac'),
(308, 35, 'Inspector', '2025-03-19 00:30:03', 'Alan Reynaldo E. Mabitad'),
(309, 37, 'Supply Office Staff', '2025-03-19 01:10:03', 'Natahaniel Barbac'),
(310, 35, 'Inspector', '2025-03-24 08:05:09', 'Alan Reynaldo E. Mabitad'),
(311, 37, 'Supply Office Staff', '2025-03-25 02:14:48', 'Natahaniel Barbac'),
(312, 35, 'Inspector', '2025-03-26 00:33:18', 'Alan Reynaldo E. Mabitad'),
(313, 37, 'Supply Office Staff', '2025-03-26 05:46:19', 'Natahaniel Barbac'),
(314, 35, 'Inspector', '2025-03-26 05:49:22', 'Alan Reynaldo E. Mabitad'),
(315, 35, 'Inspector', '2025-03-26 05:51:30', 'Alan Reynaldo E. Mabitad'),
(316, 37, 'Supply Office Staff', '2025-03-26 06:45:15', 'Natahaniel Barbac'),
(317, 35, 'Inspector', '2025-03-26 06:49:42', 'Alan Reynaldo E. Mabitad'),
(318, 35, 'Inspector', '2025-03-27 00:28:10', 'Alan Reynaldo E. Mabitad'),
(319, 37, 'Supply Office Staff', '2025-03-27 00:30:29', 'Natahaniel Barbac'),
(320, 35, 'Inspector', '2025-03-27 00:38:07', 'Alan Reynaldo E. Mabitad'),
(321, 35, 'Inspector', '2025-03-27 00:43:44', 'Alan Reynaldo E. Mabitad'),
(322, 37, 'Supply Office Staff', '2025-03-27 00:58:27', 'Natahaniel Barbac'),
(323, 36, 'Property Custodian', '2025-03-27 01:04:17', 'Joel V. Mari'),
(324, 35, 'Inspector', '2025-03-27 01:13:01', 'Alan Reynaldo E. Mabitad'),
(325, 35, 'Inspector', '2025-03-28 05:06:36', 'Alan Reynaldo E. Mabitad'),
(326, 36, 'Property Custodian', '2025-03-28 23:31:14', 'Joel V. Mari'),
(327, 37, 'Supply Office Staff', '2025-03-28 23:32:39', 'Natahaniel Barbac'),
(328, 35, 'Inspector', '2025-03-28 23:46:26', 'Alan Reynaldo E. Mabitad'),
(329, 35, 'Inspector', '2025-03-29 00:03:38', 'Alan Reynaldo E. Mabitad'),
(330, 37, 'Supply Office Staff', '2025-03-29 00:20:54', 'Natahaniel Barbac'),
(331, 35, 'Inspector', '2025-03-29 22:45:07', 'Alan Reynaldo E. Mabitad'),
(332, 35, 'Inspector', '2025-03-29 23:12:24', 'Alan Reynaldo E. Mabitad'),
(333, 35, 'Inspector', '2025-03-29 23:15:04', 'Alan Reynaldo E. Mabitad'),
(334, 35, 'Inspector', '2025-03-29 23:17:50', 'Alan Reynaldo E. Mabitad'),
(335, 35, 'Inspector', '2025-03-29 23:26:18', 'Alan Reynaldo E. Mabitad'),
(336, 35, 'Inspector', '2025-03-31 01:17:38', 'Alan Reynaldo E. Mabitad'),
(337, 35, 'Inspector', '2025-03-31 01:29:50', 'Alan Reynaldo E. Mabitad'),
(338, 35, 'Inspector', '2025-03-31 01:32:51', 'Alan Reynaldo E. Mabitad'),
(339, 35, 'Inspector', '2025-03-31 02:25:26', 'Alan Reynaldo E. Mabitad'),
(340, 37, 'Supply Office Staff', '2025-03-31 02:30:37', 'Natahaniel Barbac'),
(341, 36, 'Property Custodian', '2025-03-31 02:36:30', 'Joel V. Mari'),
(342, 35, 'Inspector', '2025-03-31 02:43:20', 'Alan Reynaldo E. Mabitad'),
(343, 36, 'Property Custodian', '2025-03-31 03:04:06', 'Joel V. Mari'),
(344, 36, 'Property Custodian', '2025-03-31 12:00:42', 'Joel V. Mari'),
(345, 35, 'Inspector', '2025-03-31 12:00:51', 'Alan Reynaldo E. Mabitad'),
(346, 35, 'Inspector', '2025-03-31 12:05:37', 'Alan Reynaldo E. Mabitad'),
(347, 36, 'Property Custodian', '2025-03-31 12:05:53', 'Joel V. Mari'),
(348, 35, 'Inspector', '2025-03-31 12:14:54', 'Alan Reynaldo E. Mabitad'),
(349, 37, 'Supply Office Staff', '2025-03-31 12:17:21', 'Natahaniel Barbac'),
(350, 35, 'Inspector', '2025-03-31 12:20:08', 'Alan Reynaldo E. Mabitad'),
(351, 37, 'Supply Office Staff', '2025-03-31 12:21:24', 'Natahaniel Barbac'),
(352, 37, 'Supply Office Staff', '2025-04-02 01:02:30', 'Natahaniel Barbac'),
(353, 35, 'Inspector', '2025-04-02 01:32:05', 'Alan Reynaldo E. Mabitad'),
(354, 35, 'Inspector', '2025-04-02 06:06:51', 'Alan Reynaldo E. Mabitad'),
(355, 35, 'Inspector', '2025-04-02 06:12:43', 'Alan Reynaldo E. Mabitad'),
(356, 35, 'Inspector', '2025-04-02 06:19:24', 'Alan Reynaldo E. Mabitad'),
(357, 35, 'Inspector', '2025-04-02 06:26:44', 'Alan Reynaldo E. Mabitad'),
(358, 35, 'Inspector', '2025-04-03 00:41:58', 'Alan Reynaldo E. Mabitad'),
(359, 35, 'Inspector', '2025-04-03 00:44:50', 'Alan Reynaldo E. Mabitad'),
(360, 35, 'Inspector', '2025-04-03 00:46:50', 'Alan Reynaldo E. Mabitad'),
(361, 35, 'Inspector', '2025-04-03 00:48:12', 'Alan Reynaldo E. Mabitad'),
(362, 37, 'Supply Office Staff', '2025-04-03 00:49:24', 'Natahaniel Barbac'),
(363, 36, 'Property Custodian', '2025-04-03 00:50:34', 'Joel V. Mari'),
(364, 35, 'Inspector', '2025-04-03 00:51:18', 'Alan Reynaldo E. Mabitad'),
(365, 35, 'Inspector', '2025-04-03 00:54:59', 'Alan Reynaldo E. Mabitad'),
(366, 35, 'Inspector', '2025-04-03 00:58:25', 'Alan Reynaldo E. Mabitad'),
(367, 35, 'Inspector', '2025-04-03 00:59:56', 'Alan Reynaldo E. Mabitad'),
(368, 35, 'Inspector', '2025-04-03 01:18:11', 'Alan Reynaldo E. Mabitad'),
(369, 35, 'Inspector', '2025-04-03 01:19:45', 'Alan Reynaldo E. Mabitad'),
(370, 36, 'Property Custodian', '2025-04-03 01:27:45', 'Joel V. Mari'),
(371, 36, 'Property Custodian', '2025-04-03 01:34:02', 'Joel V. Mari'),
(372, 35, 'Inspector', '2025-04-03 01:34:42', 'Alan Reynaldo E. Mabitad'),
(373, 36, 'Property Custodian', '2025-04-03 01:35:45', 'Joel V. Mari'),
(374, 35, 'Inspector', '2025-04-03 02:50:16', 'Alan Reynaldo E. Mabitad'),
(375, 37, 'Supply Office Staff', '2025-04-03 02:50:41', 'Natahaniel Barbac'),
(376, 35, 'Inspector', '2025-04-03 02:53:41', 'Alan Reynaldo E. Mabitad'),
(377, 35, 'Inspector', '2025-04-03 03:02:57', 'Alan Reynaldo E. Mabitad'),
(378, 35, 'Inspector', '2025-04-03 03:07:15', 'Alan Reynaldo E. Mabitad'),
(379, 35, 'Inspector', '2025-04-03 03:12:09', 'Alan Reynaldo E. Mabitad'),
(380, 35, 'Inspector', '2025-04-03 03:59:35', 'Alan Reynaldo E. Mabitad'),
(381, 35, 'Inspector', '2025-04-03 04:07:32', 'Alan Reynaldo E. Mabitad'),
(382, 35, 'Inspector', '2025-04-03 04:08:23', 'Alan Reynaldo E. Mabitad'),
(383, 35, 'Inspector', '2025-04-03 04:08:35', 'Alan Reynaldo E. Mabitad'),
(384, 35, 'Inspector', '2025-04-03 04:09:29', 'Alan Reynaldo E. Mabitad'),
(385, 35, 'Inspector', '2025-04-03 04:10:32', 'Alan Reynaldo E. Mabitad'),
(386, 35, 'Inspector', '2025-04-03 04:11:45', 'Alan Reynaldo E. Mabitad'),
(387, 37, 'Supply Office Staff', '2025-04-03 04:11:52', 'Natahaniel Barbac'),
(388, 35, 'Inspector', '2025-04-03 04:12:42', 'Alan Reynaldo E. Mabitad'),
(389, 36, 'Property Custodian', '2025-04-03 04:13:24', 'Joel V. Mari'),
(390, 35, 'Inspector', '2025-04-09 00:37:00', 'Alan Reynaldo E. Mabitad'),
(391, 35, 'Inspector', '2025-04-09 00:51:09', 'Alan Reynaldo E. Mabitad'),
(392, 37, 'Supply Office Staff', '2025-04-09 00:57:33', 'Natahaniel Barbac'),
(393, 37, 'Supply Office Staff', '2025-04-09 01:20:11', 'Natahaniel Barbac'),
(394, 35, 'Inspector', '2025-04-09 02:34:04', 'Alan Reynaldo E. Mabitad'),
(395, 36, 'Property Custodian', '2025-04-09 03:11:03', 'Joel V. Mari'),
(396, 35, 'Inspector', '2025-04-09 06:05:53', 'Alan Reynaldo E. Mabitad'),
(397, 36, 'Property Custodian', '2025-04-09 06:06:52', 'Joel V. Mari'),
(398, 37, 'Supply Office Staff', '2025-04-09 06:08:12', 'Natahaniel Barbac'),
(399, 36, 'Property Custodian', '2025-04-09 06:08:48', 'Joel V. Mari'),
(400, 37, 'Supply Office Staff', '2025-04-09 06:13:10', 'Natahaniel Barbac'),
(401, 36, 'Property Custodian', '2025-04-09 06:13:48', 'Joel V. Mari'),
(402, 35, 'Inspector', '2025-04-09 06:15:30', 'Alan Reynaldo E. Mabitad'),
(403, 35, 'Inspector', '2025-04-09 06:20:32', 'Alan Reynaldo E. Mabitad'),
(404, 37, 'Supply Office Staff', '2025-04-09 06:20:55', 'Natahaniel Barbac'),
(405, 36, 'Property Custodian', '2025-04-09 06:21:10', 'Joel V. Mari'),
(406, 35, 'Inspector', '2025-04-09 06:22:21', 'Alan Reynaldo E. Mabitad'),
(407, 37, 'Supply Office Staff', '2025-04-09 06:35:30', 'Natahaniel Barbac'),
(408, 35, 'Inspector', '2025-04-09 06:40:35', 'Alan Reynaldo E. Mabitad'),
(409, 37, 'Supply Office Staff', '2025-04-09 06:41:36', 'Natahaniel Barbac'),
(410, 35, 'Inspector', '2025-04-10 01:49:13', 'Alan Reynaldo E. Mabitad'),
(411, 35, 'Inspector', '2025-04-10 01:52:38', 'Alan Reynaldo E. Mabitad'),
(412, 35, 'Inspector', '2025-04-10 02:14:14', 'Alan Reynaldo E. Mabitad'),
(413, 35, 'Inspector', '2025-04-10 02:18:33', 'Alan Reynaldo E. Mabitad'),
(414, 35, 'Inspector', '2025-04-10 02:27:25', 'Alan Reynaldo E. Mabitad'),
(415, 35, 'Inspector', '2025-04-21 01:03:49', 'Alan Reynaldo E. Mabitad'),
(416, 35, 'Inspector', '2025-04-21 01:07:56', 'Alan Reynaldo E. Mabitad'),
(417, 37, 'Supply Office Staff', '2025-04-21 01:22:13', 'Natahaniel Barbac'),
(418, 37, 'Supply Office Staff', '2025-04-24 06:04:01', 'Natahaniel Barbac'),
(419, 35, 'Inspector', '2025-04-24 06:04:54', 'Alan Reynaldo E. Mabitad'),
(420, 36, 'Property Custodian', '2025-04-24 06:05:08', 'Joel V. Mari'),
(421, 37, 'Supply Office Staff', '2025-04-27 11:10:15', 'Natahaniel Barbac'),
(422, 35, 'Inspector', '2025-04-27 14:08:00', 'Alan Reynaldo E. Mabitad'),
(423, 37, 'Supply Office Staff', '2025-05-06 02:39:12', 'Natahaniel Barbac'),
(424, 37, 'Supply Office Staff', '2025-05-06 02:45:35', 'Natahaniel Barbac'),
(425, 35, 'Inspector', '2025-05-07 01:55:05', 'Alan Reynaldo E. Mabitad'),
(426, 36, 'Property Custodian', '2025-05-07 04:22:10', 'Joel V. Mari');

-- --------------------------------------------------------

--
-- Table structure for table `so_users`
--

CREATE TABLE `so_users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `profile_picture` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `account_type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `so_users`
--

INSERT INTO `so_users` (`id`, `name`, `username`, `password`, `created_at`, `profile_picture`, `email`, `account_type`) VALUES
(35, 'Alan Reynaldo E. Mabitad', 'inspector', '$2y$10$11h0P5JmzNro0j2GTAfp8uKgxBaoCbSwhaoJV9i.CAvxOYP.nAbD6', '2024-11-15 00:53:41', '../../../uploads/681abdc952ced_kiah.jpg', 'jzfreaky8@gmail.com', 'Inspector'),
(36, 'Joel V. Mari', 'property_custodian', '$2y$10$8SQN9YeKHvANnSjEHyoF2O1.Wtr6aNCtNJbSGAC0AI05S7j4RLc5q', '2024-11-15 00:54:03', '../../../uploads/67c14e180ea8c_PXL_20241010_200757361.jpg', 'jzfreaky8@gmail.com', 'Property Custodian'),
(37, 'Natahaniel Barbac', 'supply_staff', '$2y$10$JNFXWcS89Tww8/OCzrdbV.Sq58LwIfVybf/DmQGACFQRwRHghErZS', '2024-11-15 00:54:28', '../../../uploads/67c14e2e2e3fd_PXL_20241010_200757361.jpg', 'jomareyd2acuyan430@gmail.com', 'Supply Office Staff'),
(38, 'Supply_Office', 'user1', '$2y$10$EwEnl02ksEwodCjXDxcrhOMruzxKceMZh1zj63d56mebf1fTBS7QW', '2025-01-12 08:56:14', '../../../uploads/678383ae6bde5_system-logo-removebg-preview.png', 'jomareydacuyan430@gmail.com', 'Inspector');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `supplier_id` int(11) NOT NULL,
  `supplier_name` varchar(255) NOT NULL,
  `tin` varchar(50) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `contact_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`supplier_id`, `supplier_name`, `tin`, `address`, `contact_name`) VALUES
(1, 'SHOW GRAPHICS DESIGN ENTERPRISES', NULL, 'Ormoc City', NULL),
(2, 'ORMOC CARLOSTA HOTEL INC.', NULL, 'Ormoc City', NULL),
(3, 'FABULOUS ENTERPRISES', NULL, 'Ormoc City', NULL),
(4, 'GREENWARE CUSTOMISED SYSTEM AND PC ACCESSORIES', NULL, 'Ormoc City', NULL),
(5, 'COMPUSPEC SALES AND SERVICES', NULL, 'Mandaue City, Cebu', NULL),
(6, 'MANDAUE FOAM INDUSTRIES, INC.', NULL, 'Mandaue City, Cebu', NULL),
(7, 'SHOPKO MARKETING CORP', NULL, 'Ormoc City', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `uacs_codes`
--

CREATE TABLE `uacs_codes` (
  `id` int(11) NOT NULL,
  `classification` varchar(255) DEFAULT NULL,
  `sub_class` varchar(255) DEFAULT NULL,
  `group_name` varchar(255) DEFAULT NULL,
  `object_code` varchar(255) DEFAULT NULL,
  `sub_object_code` varchar(255) DEFAULT NULL,
  `uacs` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `uacs_codes`
--

INSERT INTO `uacs_codes` (`id`, `classification`, `sub_class`, `group_name`, `object_code`, `sub_object_code`, `uacs`, `status`) VALUES
(1, 'Assets', '', '', '', '', '1000000000', ''),
(2, 'Assets', 'Cash and Cash Equivalents', '', '', '', '1010000000', ''),
(3, 'Assets', 'Cash and Cash Equivalents', 'Cash on Hand', '', '', '1010100000', ''),
(4, 'Assets', 'Cash and Cash Equivalents', 'Cash on Hand', 'Cash - Collecting Officers', 'Cash - Collecting Officers', '1010101000', 'Active'),
(5, 'Assets', 'Cash and Cash Equivalents', 'Cash on Hand', 'Petty Cash', 'Petty Cash', '1010102000', 'Active'),
(6, 'Assets', 'Cash and Cash Equivalents', 'Cash in Bank - Local Currency', '', '', '1010200000', ''),
(7, 'Assets', 'Cash and Cash Equivalents', 'Cash in Bank - Local Currency', 'Cash in Bank - Local Currency, Bangko Sentral ng Pilipinas', 'Cash in Bank - Local Currency, Bangko Sentral ng Pilipinas', '1010201000', 'Active'),
(8, 'Assets', 'Cash and Cash Equivalents', 'Cash in Bank - Local Currency', 'Cash in Bank - Local Currency, Bangko Sentral ng Pilipinas', '', '1010201000', ''),
(9, 'Assets', 'Cash and Cash Equivalents', 'Cash in Bank - Local Currency', 'Cash in Bank - Local Currency, Bangko Sentral ng Pilipinas', 'Treasury Single Account', '1010201001', 'Active'),
(10, 'Assets', 'Cash and Cash Equivalents', 'Cash in Bank - Local Currency', 'Cash in Bank - Local Currency, Bangko Sentral ng Pilipinas', 'Regular', '1010201002', 'Active'),
(11, 'Assets', 'Cash and Cash Equivalents', 'Cash in Bank - Local Currency', 'Cash in Bank - Local Currency, Current Account', '', '1010202000', ''),
(12, 'Assets', 'Cash and Cash Equivalents', 'Cash in Bank - Local Currency', 'Cash in Bank - Local Currency, Current Account', 'Cash in Bank - Local Currency, Current Account - Allied Bank', '1010202001', 'Active'),
(13, 'Assets', 'Cash and Cash Equivalents', 'Cash in Bank - Local Currency', 'Cash in Bank - Local Currency, Current Account', 'Cash in Bank - Local Currency, Current Account - Amanah Bank', '1010202002', 'Active'),
(14, 'Assets', 'Cash and Cash Equivalents', 'Cash in Bank - Local Currency', 'Cash in Bank - Local Currency, Current Account', 'Cash in Bank - Local Currency, Current Account - Asia United Bank Corporation', '1010202003', 'Active'),
(15, 'Assets', 'Cash and Cash Equivalents', 'Cash in Bank - Local Currency', 'Cash in Bank - Local Currency, Current Account', 'Cash in Bank - Local Currency, Current Account - Australia and New Zealand Bank', '1010202004', 'Active'),
(16, 'Assets', 'Cash and Cash Equivalents', 'Cash in Bank - Local Currency', 'Cash in Bank - Local Currency, Current Account', 'Cash in Bank - Local Currency, Current Account - Banco de Oro (BDO)', '1010202005', 'Active'),
(17, 'Assets', 'Cash and Cash Equivalents', 'Cash in Bank - Local Currency', 'Cash in Bank - Local Currency, Current Account', 'Cash in Bank - Local Currency, Current Account - Bangkok Bank', '1010202006', 'Active'),
(18, 'Assets', 'Cash and Cash Equivalents', 'Cash in Bank - Local Currency', 'Cash in Bank - Local Currency, Current Account', 'Cash in Bank - Local Currency, Current Account - Bangkok Bank Public Company Limited', '1010202007', 'Active'),
(19, 'Assets', 'Cash and Cash Equivalents', 'Cash in Bank - Local Currency', 'Cash in Bank - Local Currency, Current Account', 'Cash in Bank - Local Currency, Current Account - Bank of China', '1010202008', 'Active'),
(20, 'Assets', 'Cash and Cash Equivalents', 'Cash in Bank - Local Currency', 'Cash in Bank - Local Currency, Current Account', 'Cash in Bank - Local Currency, Current Account - Bank of Commerce', '1010202009', 'Active'),
(21, 'Assets', 'Cash and Cash Equivalents', 'Cash in Bank - Local Currency', 'Cash in Bank - Local Currency, Current Account', 'Cash in Bank - Local Currency, Current Account - Bank of the Philippine Islands (BPI)', '1010202010', 'Active'),
(22, 'Assets', 'Cash and Cash Equivalents', 'Cash in Bank - Local Currency', 'Cash in Bank - Local Currency, Current Account', 'Cash in Bank - Local Currency, Current Account - Bank of Tokyo', '1010202011', 'Active'),
(23, 'Assets', 'Cash and Cash Equivalents', 'Cash in Bank - Local Currency', 'Cash in Bank - Local Currency, Current Account', 'Cash in Bank - Local Currency, Current Account - China Banking Corporation', '1010202012', 'Active'),
(24, 'Assets', 'Cash and Cash Equivalents', 'Cash in Bank - Local Currency', 'Cash in Bank - Local Currency, Current Account', 'Cash in Bank - Local Currency, Current Account - Chinatrust Commercial Bank', '1010202013', 'Active'),
(25, 'Assets', 'Cash and Cash Equivalents', 'Cash in Bank - Local Currency', 'Cash in Bank - Local Currency, Current Account', 'Cash in Bank - Local Currency, Current Account - Citibank', '1010202014', 'Active'),
(26, 'Assets', 'Cash and Cash Equivalents', 'Cash in Bank - Local Currency', 'Cash in Bank - Local Currency, Current Account', 'Cash in Bank - Local Currency, Current Account - Deutsche Bank AG', '1010202015', 'Active'),
(27, 'Assets', 'Cash and Cash Equivalents', 'Cash in Bank - Local Currency', 'Cash in Bank - Local Currency, Current Account', 'Cash in Bank - Local Currency, Current Account - Development Bank of the Philippines (DBP)', '1010202016', 'Active'),
(28, 'Assets', 'Cash and Cash Equivalents', 'Cash in Bank - Local Currency', 'Cash in Bank - Local Currency, Current Account', 'Cash in Bank - Local Currency, Current Account - East-West Banking Corporation', '1010202017', 'Active'),
(29, 'Assets', 'Cash and Cash Equivalents', 'Cash in Bank - Local Currency', 'Cash in Bank - Local Currency, Current Account', 'Cash in Bank - Local Currency, Current Account - Equitable PCI Bank', '1010202018', 'Active'),
(30, 'Assets', 'Cash and Cash Equivalents', 'Cash in Bank - Local Currency', 'Cash in Bank - Local Currency, Current Account', 'Cash in Bank - Local Currency, Current Account - First Consolidated Bank (FCB)', '1010202019', 'Active'),
(31, 'Assets', 'Cash and Cash Equivalents', 'Cash in Bank - Local Currency', 'Cash in Bank - Local Currency, Current Account', 'Cash in Bank - Local Currency, Current Account - Fuji-Mizuho Bank', '1010202020', 'Active'),
(32, 'Assets', 'Cash and Cash Equivalents', 'Cash in Bank - Local Currency', 'Cash in Bank - Local Currency, Current Account', 'Cash in Bank - Local Currency, Current Account - Hong Kong and Shanghai Banking Corporation', '1010202021', 'Active'),
(33, 'Assets', 'Cash and Cash Equivalents', 'Cash in Bank - Local Currency', 'Cash in Bank - Local Currency, Current Account', 'Cash in Bank - Local Currency, Current Account - International Commercial Bank of China', '1010202022', 'Active'),
(34, 'Assets', 'Cash and Cash Equivalents', 'Cash in Bank - Local Currency', 'Cash in Bank - Local Currency, Current Account', 'Cash in Bank - Local Currency, Current Account - International Exchange Bank', '1010202023', 'Active'),
(35, 'Assets', 'Cash and Cash Equivalents', 'Cash in Bank - Local Currency', 'Cash in Bank - Local Currency, Current Account', 'Cash in Bank - Local Currency, Current Account - Land Bank of the Philippines (LBP)', '1010202024', 'Active'),
(36, 'Assets', 'Cash and Cash Equivalents', 'Cash in Bank - Local Currency', 'Cash in Bank - Local Currency, Current Account', 'Cash in Bank - Local Currency, Current Account - Maybank Philippines', '1010202025', 'Active'),
(37, 'Assets', 'Cash and Cash Equivalents', 'Cash in Bank - Local Currency', 'Cash in Bank - Local Currency, Current Account', 'Cash in Bank - Local Currency, Current Account - Metropolitan Bank and Trust Company', '1010202026', 'Active'),
(38, 'Assets', 'Cash and Cash Equivalents', 'Cash in Bank - Local Currency', 'Cash in Bank - Local Currency, Current Account', 'Cash in Bank - Local Currency, Current Account - Philippine Bank of Communication', '1010202027', 'Active'),
(39, 'Assets', 'Cash and Cash Equivalents', 'Cash in Bank - Local Currency', 'Cash in Bank - Local Currency, Current Account', 'Cash in Bank - Local Currency, Current Account - Philippine Business Bank', '1010202028', 'Active'),
(40, 'Assets', 'Cash and Cash Equivalents', 'Cash in Bank - Local Currency', 'Cash in Bank - Local Currency, Current Account', 'Cash in Bank - Local Currency, Current Account - Philippine National Bank (PNB)', '1010202029', 'Active'),
(41, 'Assets', 'Cash and Cash Equivalents', 'Cash in Bank - Local Currency', 'Cash in Bank - Local Currency, Current Account', 'Cash in Bank - Local Currency, Current Account - Philippine Postal Savings Bank (PPSB)', '1010202030', 'Active'),
(42, 'Assets', 'Cash and Cash Equivalents', 'Cash in Bank - Local Currency', 'Cash in Bank - Local Currency, Current Account', 'Cash in Bank - Local Currency, Current Account - Philippine Trust Company', '1010202031', 'Active'),
(43, 'Assets', 'Cash and Cash Equivalents', 'Cash in Bank - Local Currency', 'Cash in Bank - Local Currency, Current Account', 'Cash in Bank - Local Currency, Current Account - Philippine Veterans Bank (PVB)', '1010202032', 'Active'),
(44, 'Assets', 'Cash and Cash Equivalents', 'Cash in Bank - Local Currency', 'Cash in Bank - Local Currency, Current Account', 'Cash in Bank - Local Currency, Current Account - Rizal Commercial Banking Corporation (RCBC)', '1010202033', 'Active'),
(45, 'Assets', 'Cash and Cash Equivalents', 'Cash in Bank - Local Currency', 'Cash in Bank - Local Currency, Current Account', 'Cash in Bank - Local Currency, Current Account - Robinsons Bank', '1010202034', 'Active'),
(46, 'Assets', 'Cash and Cash Equivalents', 'Cash in Bank - Local Currency', 'Cash in Bank - Local Currency, Current Account', 'Cash in Bank - Local Currency, Current Account - Security Bank', '1010202035', 'Active'),
(47, 'Assets', 'Cash and Cash Equivalents', 'Cash in Bank - Local Currency', 'Cash in Bank - Local Currency, Current Account', 'Cash in Bank - Local Currency, Current Account - Standard Chartered Bank', '1010202036', 'Active'),
(48, 'Assets', 'Cash and Cash Equivalents', 'Cash in Bank - Local Currency', 'Cash in Bank - Local Currency, Current Account', 'Cash in Bank - Local Currency, Current Account - Sterling Bank of Asia', '1010202037', 'Active'),
(49, 'Assets', 'Cash and Cash Equivalents', 'Cash in Bank - Local Currency', 'Cash in Bank - Local Currency, Current Account', 'Cash in Bank - Local Currency, Current Account - Union Bank of the Philippines', '1010202038', 'Active'),
(50, 'Assets', 'Cash and Cash Equivalents', 'Cash in Bank - Local Currency', 'Cash in Bank - Local Currency, Current Account', 'Cash in Bank - Local Currency, Current Account - United Coconut Planters Bank (UCPB)', '1010202039', 'Active'),
(51, 'Assets', 'Cash and Cash Equivalents', 'Cash in Bank - Local Currency', 'Cash in Bank - Local Currency, Savings Account', '', '1010203000', ''),
(52, 'Assets', 'Cash and Cash Equivalents', 'Cash in Bank - Local Currency', 'Cash in Bank - Local Currency, Savings Account', 'Cash in Bank - Local Currency, Savings Accounts - Land Bank of the Philippines (LBP)', '1010203001', 'Active'),
(53, 'Assets', 'Cash and Cash Equivalents', 'Cash in Bank - Local Currency', 'Cash in Bank - Local Currency, Savings Account', 'Cash in Bank - Local Currency, Savings Accounts - Development Bank of the Philippines (DBP)', '1010203002', 'Active'),
(54, 'Assets', 'Cash and Cash Equivalents', 'Cash in Bank - Local Currency', 'Cash in Bank - Local Currency, Savings Account', 'Cash in Bank - Local Currency, Savings Accounts - Philippine Veterans Bank (PVB)', '1010203003', 'Active'),
(55, 'Assets', 'Cash and Cash Equivalents', 'Cash in Bank - Local Currency', 'Cash in Bank - Local Currency, Savings Account', 'Cash in Bank - Local Currency, Savings Accounts - Philippine National Bank (PNB)', '1010203004', 'Active'),
(56, 'Assets', 'Cash and Cash Equivalents', 'Cash in Bank - Local Currency', 'Cash in Bank - Local Currency, Savings Account', 'Cash in Bank - Local Currency, Savings Accounts - Philippine Amanah Bank (PAB)', '1010203005', 'Active'),
(57, 'Assets', 'Cash and Cash Equivalents', 'Cash in Bank - Local Currency', 'Cash in Bank - Local Currency, Savings Account', 'Cash in Bank - Local Currency, Savings Accounts - Philippine Postal Savings Bank (PPSB)', '1010203006', 'Active'),
(58, 'Assets', 'Cash and Cash Equivalents', 'Cash in Bank - Local Currency', 'Cash in Bank - Local Currency, Savings Account', 'Cash in Bank - Local Currency, Savings Accounts - United Coconut Planters Bank (UCPB)', '1010203007', 'Active'),
(59, 'Assets', 'Cash and Cash Equivalents', 'Cash in Bank - Local Currency', 'Cash in Bank - Local Currency, Time Deposits', '', '1010204000', ''),
(60, 'Assets', 'Cash and Cash Equivalents', 'Cash in Bank - Local Currency', 'Cash in Bank - Local Currency, Time Deposits', 'Cash in Bank - Local Currency, Time Deposits - Land Bank of the Philippines (LBP)', '1010204001', 'Inactive'),
(61, 'Assets', 'Cash and Cash Equivalents', 'Cash in Bank - Local Currency', 'Cash in Bank - Local Currency, Time Deposits', 'Cash in Bank - Local Currency, Time Deposits - Development Bank of the Philippines (DBP)', '1010204002', 'Inactive'),
(62, 'Assets', 'Cash and Cash Equivalents', 'Cash in Bank - Local Currency', 'Cash in Bank - Local Currency, Time Deposits', 'Cash in Bank - Local Currency, Time Deposits - Philippine Veterans Bank (PVB)', '1010204003', 'Inactive'),
(63, 'Assets', 'Cash and Cash Equivalents', 'Cash in Bank - Local Currency', 'Cash in Bank - Local Currency, Time Deposits', 'Cash in Bank - Local Currency, Time Deposits - Philippine National Bank (PNB)', '1010204004', 'Inactive'),
(64, 'Assets', 'Cash and Cash Equivalents', 'Cash in Bank - Local Currency', 'Cash in Bank - Local Currency, Time Deposits', 'Cash in Bank - Local Currency, Time Deposits - United Coconut Planters Bank (UCPB)', '1010204005', 'Inactive'),
(65, 'Assets', 'Cash and Cash Equivalents', 'Cash in Bank - Foreign Currency', '', '', '1010300000', ''),
(66, 'Assets', 'Cash and Cash Equivalents', 'Cash in Bank - Foreign Currency', 'Cash in Bank - Foreign Currency, Bangko Sentral ng Pilipinas', 'Cash in Bank - Foreign Currency, Bangko Sentral ng Pilipinas', '1010301000', 'Active'),
(67, 'Assets', 'Cash and Cash Equivalents', 'Cash in Bank - Foreign Currency', 'Cash in Bank - Foreign Currency, Current Account', 'Cash in Bank - Foreign Currency, Current Account', '1010302000', 'Active'),
(68, 'Assets', 'Cash and Cash Equivalents', 'Cash in Bank - Foreign Currency', 'Cash in Bank - Foreign Currency, Current Account', '', '1010302000', ''),
(69, 'Assets', 'Cash and Cash Equivalents', 'Cash in Bank - Foreign Currency', 'Cash in Bank - Foreign Currency, Current Account', 'Cash in Bank - Foreign Currency, Current Account - Foreign Banks', '1010302001', 'Active'),
(70, 'Assets', 'Cash and Cash Equivalents', 'Cash in Bank - Foreign Currency', 'Cash in Bank - Foreign Currency, Savings Account', '', '1010303000', ''),
(71, 'Assets', 'Cash and Cash Equivalents', 'Cash in Bank - Foreign Currency', 'Cash in Bank - Foreign Currency, Savings Account', 'Cash in Bank - Foreign Currency, Savings Account - Land Bank of the Philippines (LBP)', '1010303001', 'Active'),
(72, 'Assets', 'Cash and Cash Equivalents', 'Cash in Bank - Foreign Currency', 'Cash in Bank - Foreign Currency, Savings Account', 'Cash in Bank - Foreign Currency, Savings Account - Development Bank of the Philippines (DBP)', '1010303002', 'Active'),
(73, 'Assets', 'Cash and Cash Equivalents', 'Cash in Bank - Foreign Currency', 'Cash in Bank - Foreign Currency, Savings Account', 'Cash in Bank - Foreign Currency, Savings Account - Philippine National Bank (PNB)', '1010303003', 'Active'),
(74, 'Assets', 'Cash and Cash Equivalents', 'Cash in Bank - Foreign Currency', 'Cash in Bank - Foreign Currency, Savings Account', 'Cash in Bank - Foreign Currency, Savings Account - United Coconut Planters Bank (UCPB)', '1010303004', 'Active'),
(75, 'Assets', 'Cash and Cash Equivalents', 'Cash in Bank - Foreign Currency', 'Cash in Bank - Foreign Currency, Savings Account', 'Cash in Bank - Foreign Currency, Savings Account - Foreign Banks', '1010303005', 'Active'),
(76, 'Assets', 'Cash and Cash Equivalents', 'Cash in Bank - Foreign Currency', 'Cash in Bank - Foreign Currency, Time Deposits', '', '1010304000', ''),
(77, 'Assets', 'Cash and Cash Equivalents', 'Cash in Bank - Foreign Currency', 'Cash in Bank - Foreign Currency, Time Deposits', 'Cash in Bank - Foreign Currency, Time Deposits - Land Bank of the Philippines (LBP)', '1010304001', 'Inactive'),
(78, 'Assets', 'Cash and Cash Equivalents', 'Cash in Bank - Foreign Currency', 'Cash in Bank - Foreign Currency, Time Deposits', 'Cash in Bank - Foreign Currency, Time Deposits - Development Bank of the Philippines (DBP)', '1010304002', 'Inactive'),
(79, 'Assets', 'Cash and Cash Equivalents', 'Cash in Bank - Foreign Currency', 'Cash in Bank - Foreign Currency, Time Deposits', 'Cash in Bank - Foreign Currency, Time Deposits - Philippine National Bank (PNB)', '1010304003', 'Inactive'),
(80, 'Assets', 'Cash and Cash Equivalents', 'Cash in Bank - Foreign Currency', 'Cash in Bank - Foreign Currency, Time Deposits', 'Cash in Bank - Foreign Currency, Time Deposits - United Coconut Planters Bank (UCPB)', '1010304004', 'Inactive'),
(81, 'Assets', 'Cash and Cash Equivalents', 'Treasury/Agency Cash Accounts', '', '', '1010400000', ''),
(82, 'Assets', 'Cash and Cash Equivalents', 'Treasury/Agency Cash Accounts', 'Cash - Treasury/Agency Deposit, Regular', 'Cash - Treasury/Agency Deposit, Regular', '1010401000', 'Active'),
(83, 'Assets', 'Cash and Cash Equivalents', 'Treasury/Agency Cash Accounts', 'Cash - Treasury/Agency Deposit, Special Account', 'Cash - Treasury/Agency Deposit, Special Account', '1010402000', 'Active'),
(84, 'Assets', 'Cash and Cash Equivalents', 'Treasury/Agency Cash Accounts', 'Cash - Treasury/Agency Deposit, Trust', 'Cash - Treasury/Agency Deposit, Trust', '1010403000', 'Active'),
(85, 'Assets', 'Cash and Cash Equivalents', 'Treasury/Agency Cash Accounts', 'Cash - Modified Disbursement System (MDS), Regular', 'Cash - Modified Disbursement System (MDS), Regular', '1010404000', 'Active'),
(86, 'Assets', 'Cash and Cash Equivalents', 'Treasury/Agency Cash Accounts', 'Cash - Modified Disbursement System (MDS), Special Account', 'Cash - Modified Disbursement System (MDS), Special Account', '1010405000', 'Active'),
(87, 'Assets', 'Cash and Cash Equivalents', 'Treasury/Agency Cash Accounts', 'Cash - Modified Disbursement System (MDS), Trust', 'Cash - Modified Disbursement System (MDS), Trust', '1010406000', 'Active'),
(88, 'Assets', 'Cash and Cash Equivalents', 'Treasury/Agency Cash Accounts', 'Cash - Tax Remittance Advice', 'Cash - Tax Remittance Advice', '1010407000', 'Active'),
(89, 'Assets', 'Cash and Cash Equivalents', 'Treasury/Agency Cash Accounts', 'Cash - Constructive Income and Other Remittances', '', '1010408000', ''),
(90, 'Assets', 'Cash and Cash Equivalents', 'Treasury/Agency Cash Accounts', 'Cash - Constructive Income and Other Remittances', 'Cash - Constructive Income Remittance', '1010408000', 'Active'),
(91, 'Assets', 'Cash and Cash Equivalents', 'Cash Equivalents', '', '', '1010500000', ''),
(92, 'Assets', 'Cash and Cash Equivalents', 'Cash Equivalents', 'Treasury Bills', 'Treasury Bills', '1010501000', 'Active'),
(93, 'Assets', 'Cash and Cash Equivalents', 'Cash Equivalents', 'Time Deposits - Local Currency', '', '1010502000', ''),
(94, 'Assets', 'Cash and Cash Equivalents', 'Cash Equivalents', 'Time Deposits - Local Currency', 'Time Deposits - Local Currency - Land Bank of the Philippines (LBP)', '1010502001', 'Active'),
(95, 'Assets', 'Cash and Cash Equivalents', 'Cash Equivalents', 'Time Deposits - Local Currency', 'Time Deposits - Local Currency - Development Bank of the Philippines (DBP)', '1010502002', 'Active'),
(96, 'Assets', 'Cash and Cash Equivalents', 'Cash Equivalents', 'Time Deposits - Local Currency', 'Time Deposits - Local Currency - Philippine Veterans Bank (PVB)', '1010502003', 'Active'),
(97, 'Assets', 'Cash and Cash Equivalents', 'Cash Equivalents', 'Time Deposits - Local Currency', 'Time Deposits - Local Currency - Philippine National Bank (PNB)', '1010502004', 'Active'),
(98, 'Assets', 'Cash and Cash Equivalents', 'Cash Equivalents', 'Time Deposits - Local Currency', 'Time Deposits - Local Currency - United Coconut Planters Bank (UCPB)', '1010502005', 'Active'),
(99, 'Assets', 'Cash and Cash Equivalents', 'Cash Equivalents', 'Time Deposits - Foreign Currency', '', '1010503000', ''),
(100, 'Assets', 'Cash and Cash Equivalents', 'Cash Equivalents', 'Time Deposits - Foreign Currency', 'Time Deposits - Foreign Currency - Land Bank of the Philippines (LBP)', '1010503001', 'Active'),
(101, 'Assets', 'Cash and Cash Equivalents', 'Cash Equivalents', 'Time Deposits - Foreign Currency', 'Time Deposits - Foreign Currency - Development Bank of the Philippines (DBP)', '1010503002', 'Active'),
(102, 'Assets', 'Cash and Cash Equivalents', 'Cash Equivalents', 'Time Deposits - Foreign Currency', 'Time Deposits - Foreign Currency - Philippine National Bank (PNB)', '1010503003', 'Active'),
(103, 'Assets', 'Cash and Cash Equivalents', 'Cash Equivalents', 'Time Deposits - Foreign Currency', 'Time Deposits - Foreign Currency - United Coconut Planters Bank (UCPB)', '1010503004', 'Active'),
(104, 'Assets', 'Investments', '', '', '', '1020000000', ''),
(105, 'Assets', 'Investments', 'Financial Assets at Fair Value Through Surplus or Deficit', '', '', '1020100000', ''),
(106, 'Assets', 'Investments', 'Financial Assets at Fair Value Through Surplus or Deficit', 'Financial Assets Held for Trading', 'Financial Assets Held for Trading', '1020101000', 'Active'),
(107, 'Assets', 'Investments', 'Financial Assets at Fair Value Through Surplus or Deficit', 'Financial Assets Designated at Fair Value Through Surplus or Deficit', 'Financial Assets Designated at Fair Value Through Surplus or Deficit', '1020102000', 'Active'),
(108, 'Assets', 'Investments', 'Financial Assets at Fair Value Through Surplus or Deficit', 'Derivative Financial Assets Held for Trading', 'Derivative Financial Assets Held for Trading', '1020103000', 'Active'),
(109, 'Assets', 'Investments', 'Financial Assets at Fair Value Through Surplus or Deficit', 'Derivative Financial Assets Designated at Fair Value Through Surplus or Deficit', 'Derivative Financial Assets Designated at Fair Value Through Surplus or Deficit', '1020104000', 'Active'),
(110, 'Assets', 'Investments', 'Financial Assets - Held to Maturity', '', '', '1020200000', ''),
(111, 'Assets', 'Investments', 'Financial Assets - Held to Maturity', 'Investments in Treasury Bills - Local', 'Investments in Treasury Bills - Local', '1020201000', 'Active'),
(112, 'Assets', 'Investments', 'Financial Assets - Held to Maturity', 'Allowance for Impairment - Investments in Treasury Bills - Local', '', '1020201100', ''),
(113, 'Assets', 'Investments', 'Financial Assets - Held to Maturity', 'Allowance for Impairment - Investments in Treasury Bills - Local', 'Allowance for Impairment - Investments in  Treasury Bills - Local', '1020201100', 'Active'),
(114, 'Assets', 'Investments', 'Financial Assets - Held to Maturity', 'Investments in Treasury Bills - Foreign', 'Investments in Treasury Bills - Foreign', '1020202000', 'Active'),
(115, 'Assets', 'Investments', 'Financial Assets - Held to Maturity', 'Allowance for Impairment - Investments in Treasury Bills - Foreign', 'Allowance for Impairment - Investments in Treasury Bills - Foreign', '1020202100', 'Active'),
(116, 'Assets', 'Investments', 'Financial Assets - Held to Maturity', 'Investments in Treasury Bonds - Local', 'Investments in Treasury Bonds - Local', '1020203000', 'Active'),
(117, 'Assets', 'Investments', 'Financial Assets - Held to Maturity', 'Allowance for Impairment - Investments in Bonds - Local', '', '1020203100', ''),
(118, 'Assets', 'Investments', 'Financial Assets - Held to Maturity', 'Allowance for Impairment - Investments in Bonds - Local', 'Allowance for Impairment - Investments in Treasury Bonds - Local', '1020203100', 'Active'),
(119, 'Assets', 'Investments', 'Financial Assets - Held to Maturity', 'Investments in Treasury Bonds - Foreign', 'Investments in Treasury Bonds - Foreign', '1020204000', 'Active'),
(120, 'Assets', 'Investments', 'Financial Assets - Held to Maturity', 'Allowance for Impairment - Investments in Treasury Bonds - Foreign', 'Allowance for Impairment - Investments in Treasury Bonds - Foreign', '1020204100', 'Active'),
(121, 'Assets', 'Investments', 'Financial Assets - Others', '', '', '1020300000', ''),
(122, 'Assets', 'Investments', 'Financial Assets - Others', 'Investments in Stocks', 'Investments in Stocks', '1020301000', 'Active'),
(123, 'Assets', 'Investments', 'Financial Assets - Others', 'Investments in Bonds', 'Investments in Bonds', '1020302000', 'Active'),
(124, 'Assets', 'Investments', 'Financial Assets - Others', 'Other Investments', 'Other Investments', '1020399000', 'Active'),
(125, 'Assets', 'Investments', 'Investments in Government-Owned or Controlled Corporations', '', '', '1020400000', ''),
(126, 'Assets', 'Investments', 'Investments in Government-Owned or Controlled Corporations', 'Investments in Government-Owned or Controlled Corporations', '', '1020401000', ''),
(127, 'Assets', 'Investments', 'Investments in Government-Owned or Controlled Corporations', 'Investments in Government-Owned or Controlled Corporations', 'Investments in GOCCs', '1020401000', 'Active'),
(128, 'Assets', 'Investments', 'Investments in Government-Owned or Controlled Corporations', 'Allowance for Impairment - Investments in GOCCs', 'Allowance for Impairment - Investments in GOCCs', '1020401100', 'Active'),
(129, 'Assets', 'Investments', 'Investments in Joint Ventures', '', '', '1020500000', ''),
(130, 'Assets', 'Investments', 'Investments in Joint Ventures', 'Investments in Joint Ventures', '', '1020501000', ''),
(131, 'Assets', 'Investments', 'Investments in Joint Ventures', 'Investments in Joint Ventures', 'Investments in Joint Venture', '1020501000', 'Active'),
(132, 'Assets', 'Investments', 'Investments in Joint Ventures', 'Allowance for Impairment - Investments in Joint Venture', 'Allowance for Impairment - Investments in Joint Venture', '1020501100', 'Active'),
(133, 'Assets', 'Investments', 'Investments in Associates', 'Investments in Associates', 'Investments in Associates', '1020601000', 'Active'),
(134, 'Assets', 'Investments', 'Investments in Associates', '', '', '1020600000', ''),
(135, 'Assets', 'Investments', 'Investments in Associates', 'Allowance for Impairment - Investments in Associates', 'Allowance for Impairment - Investments in Associates', '1020601100', 'Active'),
(136, 'Assets', 'Investments', 'Sinking Fund', 'Sinking Fund', 'Sinking Fund', '1020701000', 'Active'),
(137, 'Assets', 'Receivables', '', '', '', '1030000000', ''),
(138, 'Assets', 'Receivables', 'Loans and Receivable Accounts', '', '', '1030100000', ''),
(139, 'Assets', 'Receivables', 'Loans and Receivable Accounts', 'Accounts Receivable', 'Accounts Receivable', '1030101000', 'Active'),
(140, 'Assets', 'Receivables', 'Loans and Receivable Accounts', 'Allowance for Impairment - Accounts Receivable', 'Allowance for Impairment - Accounts Receivable', '1030101100', 'Active'),
(141, 'Assets', 'Receivables', 'Loans and Receivable Accounts', 'Notes Receivable', 'Notes Receivable', '1030102000', 'Active'),
(142, 'Assets', 'Receivables', 'Loans and Receivable Accounts', 'Allowance for Impairment - Notes Receivable', 'Allowance for Impairment - Notes Receivable', '1030102100', 'Active'),
(143, 'Assets', 'Receivables', 'Loans and Receivable Accounts', 'Loans Receivable - Government-Owned or Controlled Corporations', '', '1030103000', ''),
(144, 'Assets', 'Receivables', 'Loans and Receivable Accounts', 'Loans Receivable - Government-Owned or Controlled Corporations', 'Loans Receivable - Government-Owned and/or Controlled Corporations', '1030103000', 'Active'),
(145, 'Assets', 'Receivables', 'Loans and Receivable Accounts', 'Allowance for Impairment - Loans Receivable - Government-Owned and/or Controlled Corporations', 'Allowance for Impairment - Loans Receivable - Government-Owned and/or Controlled Corporations', '1030103100', 'Active'),
(146, 'Assets', 'Receivables', 'Loans and Receivable Accounts', 'Loans Receivable - Local Government Units', 'Loans Receivable - Local Government Units', '1030104000', 'Active'),
(147, 'Assets', 'Receivables', 'Loans and Receivable Accounts', 'Allowance for Impairment - Loans Receivable - Local Government Units', 'Allowance for Impairment - Loans Receivable - Local Government Units', '1030104100', 'Active'),
(148, 'Assets', 'Receivables', 'Loans and Receivable Accounts', 'Interests Receivable', '', '1030105000', ''),
(149, 'Assets', 'Receivables', 'Loans and Receivable Accounts', 'Interests Receivable', 'Interests Receivable ', '1030105000', 'Active'),
(150, 'Assets', 'Receivables', 'Loans and Receivable Accounts', 'Allowance for Impairment - Interests Receivable', 'Allowance for Impairment - Interests Receivable', '1030105100', 'Active'),
(151, 'Assets', 'Receivables', 'Loans and Receivable Accounts', 'Dividends Receivable', 'Dividends Receivable', '1030106000', 'Active'),
(152, 'Assets', 'Receivables', 'Loans and Receivable Accounts', 'Receivables from Authorized Agent Banks (AABs)/Agents', '', '1030125000', ''),
(153, 'Assets', 'Receivables', 'Loans and Receivable Accounts', 'Receivables from Authorized Agent Banks (AABs)/Agents', 'Land Bank of the Philippines (LBP)', '1030125001', 'Active'),
(154, 'Assets', 'Receivables', 'Loans and Receivable Accounts', 'Receivables from Authorized Agent Banks (AABs)/Agents', 'Development Bank of the Philippines (DBP)', '1030125002', 'Active'),
(155, 'Assets', 'Receivables', 'Loans and Receivable Accounts', 'Receivables from Authorized Agent Banks (AABs)/Agents', 'Philippine Veterans Bank (PVB)', '1030125003', 'Active'),
(156, 'Assets', 'Receivables', 'Loans and Receivable Accounts', 'Receivables from Authorized Agent Banks (AABs)/Agents', 'Philippine National Bank (PNB)', '1030125004', 'Active'),
(157, 'Assets', 'Receivables', 'Loans and Receivable Accounts', 'Receivables from Authorized Agent Banks (AABs)/Agents', 'Philippine Amanah Bank (PAB)', '1030125005', 'Active'),
(158, 'Assets', 'Receivables', 'Loans and Receivable Accounts', 'Receivables from Authorized Agent Banks (AABs)/Agents', 'Philippine Postal Savings Bank (PPSB)', '1030125006', 'Active'),
(159, 'Assets', 'Receivables', 'Loans and Receivable Accounts', 'Receivables from Authorized Agent Banks (AABs)/Agents', 'United Coconut Planters Bank (UCPB)', '1030125007', 'Active'),
(160, 'Assets', 'Receivables', 'Loans and Receivable Accounts', 'Receivables from Authorized Agent Banks (AABs)/Agents', 'Agents (PSA)', '1030125008', 'Active'),
(161, 'Assets', 'Receivables', 'Loans and Receivable Accounts', 'Loans Receivable - Others', 'Loans Receivable - Others', '1030199000', 'Active'),
(162, 'Assets', 'Receivables', 'Loans and Receivable Accounts', 'Allowance for Impairment - Loans Receivables - Others', '', '1030199100', ''),
(163, 'Assets', 'Receivables', 'Loans and Receivable Accounts', 'Allowance for Impairment - Loans Receivables - Others', 'Allowance for Impairment - Loans Receivable - Others', '1030199100', 'Active'),
(164, 'Assets', 'Receivables', 'Lease Receivable', '', '', '1030200000', ''),
(165, 'Assets', 'Receivables', 'Lease Receivable', 'Operating Lease Receivable', '', '1030201000', ''),
(166, 'Assets', 'Receivables', 'Lease Receivable', 'Operating Lease Receivable', 'Operating Lease  Receivable', '1030201000', 'Active'),
(167, 'Assets', 'Receivables', 'Lease Receivable', 'Allowance for Impairment - Operating Lease Receivable', 'Allowance for Impairment - Operating Lease Receivable', '1030201100', 'Active'),
(168, 'Assets', 'Receivables', 'Lease Receivable', 'Finance Lease Receivable', 'Finance Lease Receivable', '1030202000', 'Active'),
(169, 'Assets', 'Receivables', 'Lease Receivable', 'Allowance for Impairment - Finance Lease Receivable', 'Allowance for Impairment - Finance Lease Receivable', '1030202100', 'Active'),
(170, 'Assets', 'Receivables', 'Inter-Agency Receivables', '', '', '1030300000', ''),
(171, 'Assets', 'Receivables', 'Inter-Agency Receivables', 'Due from National Government Agencies', 'Due from National Government Agencies', '1030301000', 'Active'),
(172, 'Assets', 'Receivables', 'Inter-Agency Receivables', 'Due from Government-Owned or Controlled Corporations', '', '1030302000', ''),
(173, 'Assets', 'Receivables', 'Inter-Agency Receivables', 'Due from Government-Owned or Controlled Corporations', 'Due from Government-Owned and/or Controlled Corporations', '1030302000', 'Active'),
(174, 'Assets', 'Receivables', 'Inter-Agency Receivables', 'Due from Local Government Units', 'Due from Local Government Units', '1030303000', 'Active'),
(175, 'Assets', 'Receivables', 'Inter-Agency Receivables', 'Due from Joint Venture', 'Due from Joint Venture', '1030304000', 'Active'),
(176, 'Assets', 'Receivables', 'Intra-Agency Receivables', '', '', '1030400000', ''),
(177, 'Assets', 'Receivables', 'Intra-Agency Receivables', 'Due from Central Office ', '', '1030401000', ''),
(178, 'Assets', 'Receivables', 'Intra-Agency Receivables', 'Due from Central Office ', 'Due from Central Office', '1030401000', 'Active'),
(179, 'Assets', 'Receivables', 'Intra-Agency Receivables', 'Due from Bureaus', 'Due from Bureaus', '1030402000', 'Active'),
(180, 'Assets', 'Receivables', 'Intra-Agency Receivables', 'Due from Regional Offices', 'Due from Regional Offices', '1030403000', 'Active'),
(181, 'Assets', 'Receivables', 'Intra-Agency Receivables', 'Due from Operating/Field Units', '', '1030404000', ''),
(182, 'Assets', 'Receivables', 'Intra-Agency Receivables', 'Due from Operating/Field Units', 'Due from Operating Units', '1030404000', 'Active'),
(183, 'Assets', 'Receivables', 'Other Receivables', '', '', '1030500000', ''),
(184, 'Assets', 'Receivables', 'Other Receivables', 'Receivables  - Disallowances/Charges', '', '1030501000', ''),
(185, 'Assets', 'Receivables', 'Other Receivables', 'Receivables  - Disallowances/Charges', 'Receivables - Disallowances/Charges', '1030501000', 'Active'),
(186, 'Assets', 'Receivables', 'Other Receivables', 'Due from Officers and Employees', 'Due from Officers and Employees', '1030502000', 'Active'),
(187, 'Assets', 'Receivables', 'Other Receivables', 'Due from Non-Government Organizations/People\'s Organizations', 'Due from Non-Government Organizations/People\'s Organizations', '1030503000', 'Active'),
(188, 'Assets', 'Receivables', 'Other Receivables', 'Other Receivables', 'Other Receivables', '1030599000', 'Active'),
(189, 'Assets', 'Receivables', 'Other Receivables', 'Allowance for Impairment -  Other Receivables', '', '1030599100', ''),
(190, 'Assets', 'Receivables', 'Other Receivables', 'Allowance for Impairment -  Other Receivables', 'Allowance for Impairment - Other Receivables', '1030599100', 'Active'),
(191, 'Assets', 'Inventories', '', '', '', '1040000000', ''),
(192, 'Assets', 'Inventories', 'Inventory Held for Sale', '', '', '1040100000', ''),
(193, 'Assets', 'Inventories', 'Inventory Held for Sale', 'Acquired/Forfeited Real Property', '', '1040101000', ''),
(194, 'Assets', 'Inventories', 'Inventory Held for Sale', 'Acquired/Forfeited Real Property', 'Supplies and Materials', '1040101001', 'Active'),
(195, 'Assets', 'Inventories', 'Inventory Held for Sale', 'Aquaculture Produce', '', '1040101000', ''),
(196, 'Assets', 'Inventories', 'Inventory Held for Sale', 'Aquaculture Produce', 'Supplies and Materials', '1040101001', 'Active'),
(197, 'Assets', 'Inventories', 'Inventory Held for Sale', 'Forest Products', '', '1040101000', ''),
(198, 'Assets', 'Inventories', 'Inventory Held for Sale', 'Forest Products', 'Supplies and Materials', '1040101001', 'Active'),
(199, 'Assets', 'Inventories', 'Inventory Held for Sale', 'Land/Reclaimed Land', '', '1040101000', ''),
(200, 'Assets', 'Inventories', 'Inventory Held for Sale', 'Land/Reclaimed Land', 'Supplies and Materials', '1040101001', 'Active'),
(201, 'Assets', 'Inventories', 'Inventory Held for Sale', 'Levied Real Property', '', '1040101000', ''),
(202, 'Assets', 'Inventories', 'Inventory Held for Sale', 'Levied Real Property', 'Supplies and Materials', '1040101001', 'Active'),
(203, 'Assets', 'Inventories', 'Inventory Held for Sale', 'Merchandise Inventory', '', '1040101000', ''),
(204, 'Assets', 'Inventories', 'Inventory Held for Sale', 'Merchandise Inventory', 'Supplies and Materials', '1040101001', 'Active'),
(205, 'Assets', 'Inventories', 'Inventory Held for Sale', 'Seized/Distrained Personal Property', '', '1040101000', ''),
(206, 'Assets', 'Inventories', 'Inventory Held for Sale', 'Seized/Distrained Personal Property', 'Supplies and Materials', '1040101001', 'Active'),
(207, 'Assets', 'Inventories', 'Inventory Held for Sale', 'Acquired/Forfeited Real Property', '', '1040101000', ''),
(208, 'Assets', 'Inventories', 'Inventory Held for Sale', 'Acquired/Forfeited Real Property', 'Drugs and Medicines', '1040101002', 'Active'),
(209, 'Assets', 'Inventories', 'Inventory Held for Sale', 'Aquaculture Produce', '', '1040101000', ''),
(210, 'Assets', 'Inventories', 'Inventory Held for Sale', 'Aquaculture Produce', 'Drugs and Medicines', '1040101002', 'Active'),
(211, 'Assets', 'Inventories', 'Inventory Held for Sale', 'Forest Products', '', '1040101000', ''),
(212, 'Assets', 'Inventories', 'Inventory Held for Sale', 'Forest Products', 'Drugs and Medicines', '1040101002', 'Active'),
(213, 'Assets', 'Inventories', 'Inventory Held for Sale', 'Land/Reclaimed Land', '', '1040101000', ''),
(214, 'Assets', 'Inventories', 'Inventory Held for Sale', 'Land/Reclaimed Land', 'Drugs and Medicines', '1040101002', 'Active'),
(215, 'Assets', 'Inventories', 'Inventory Held for Sale', 'Levied Real Property', '', '1040101000', ''),
(216, 'Assets', 'Inventories', 'Inventory Held for Sale', 'Levied Real Property', 'Drugs and Medicines', '1040101002', 'Active'),
(217, 'Assets', 'Inventories', 'Inventory Held for Sale', 'Merchandise Inventory', '', '1040101000', ''),
(218, 'Assets', 'Inventories', 'Inventory Held for Sale', 'Merchandise Inventory', 'Drugs and Medicines', '1040101002', 'Active'),
(219, 'Assets', 'Inventories', 'Inventory Held for Sale', 'Seized/Distrained Personal Property', '', '1040101000', ''),
(220, 'Assets', 'Inventories', 'Inventory Held for Sale', 'Seized/Distrained Personal Property', 'Drugs and Medicines', '1040101002', 'Active'),
(221, 'Assets', 'Inventories', 'Inventory Held for Sale', 'Acquired/Forfeited Real Property', '', '1040101000', ''),
(222, 'Assets', 'Inventories', 'Inventory Held for Sale', 'Acquired/Forfeited Real Property', 'Agricultural Produce', '1040101003', 'Active'),
(223, 'Assets', 'Inventories', 'Inventory Held for Sale', 'Aquaculture Produce', '', '1040101000', ''),
(224, 'Assets', 'Inventories', 'Inventory Held for Sale', 'Aquaculture Produce', 'Agricultural Produce', '1040101003', 'Active'),
(225, 'Assets', 'Inventories', 'Inventory Held for Sale', 'Forest Products', '', '1040101000', ''),
(226, 'Assets', 'Inventories', 'Inventory Held for Sale', 'Forest Products', 'Agricultural Produce', '1040101003', 'Active'),
(227, 'Assets', 'Inventories', 'Inventory Held for Sale', 'Land/Reclaimed Land', '', '1040101000', ''),
(228, 'Assets', 'Inventories', 'Inventory Held for Sale', 'Land/Reclaimed Land', 'Agricultural Produce', '1040101003', 'Active'),
(229, 'Assets', 'Inventories', 'Inventory Held for Sale', 'Levied Real Property', '', '1040101000', ''),
(230, 'Assets', 'Inventories', 'Inventory Held for Sale', 'Levied Real Property', 'Agricultural Produce', '1040101003', 'Active'),
(231, 'Assets', 'Inventories', 'Inventory Held for Sale', 'Merchandise Inventory', '', '1040101000', ''),
(232, 'Assets', 'Inventories', 'Inventory Held for Sale', 'Merchandise Inventory', 'Agricultural Produce', '1040101003', 'Active'),
(233, 'Assets', 'Inventories', 'Inventory Held for Sale', 'Seized/Distrained Personal Property', '', '1040101000', ''),
(234, 'Assets', 'Inventories', 'Inventory Held for Sale', 'Seized/Distrained Personal Property', 'Agricultural Produce', '1040101003', 'Active'),
(235, 'Assets', 'Inventories', 'Inventory Held for Sale', 'Acquired/Forfeited Real Property', '', '1040101000', ''),
(236, 'Assets', 'Inventories', 'Inventory Held for Sale', 'Acquired/Forfeited Real Property', 'Ammunitions', '1040101004', 'Active'),
(237, 'Assets', 'Inventories', 'Inventory Held for Sale', 'Aquaculture Produce', '', '1040101000', ''),
(238, 'Assets', 'Inventories', 'Inventory Held for Sale', 'Aquaculture Produce', 'Ammunitions', '1040101004', 'Active'),
(239, 'Assets', 'Inventories', 'Inventory Held for Sale', 'Forest Products', '', '1040101000', ''),
(240, 'Assets', 'Inventories', 'Inventory Held for Sale', 'Forest Products', 'Ammunitions', '1040101004', 'Active'),
(241, 'Assets', 'Inventories', 'Inventory Held for Sale', 'Land/Reclaimed Land', '', '1040101000', ''),
(242, 'Assets', 'Inventories', 'Inventory Held for Sale', 'Land/Reclaimed Land', 'Ammunitions', '1040101004', 'Active'),
(243, 'Assets', 'Inventories', 'Inventory Held for Sale', 'Levied Real Property', '', '1040101000', ''),
(244, 'Assets', 'Inventories', 'Inventory Held for Sale', 'Levied Real Property', 'Ammunitions', '1040101004', 'Active'),
(245, 'Assets', 'Inventories', 'Inventory Held for Sale', 'Merchandise Inventory', '', '1040101000', ''),
(246, 'Assets', 'Inventories', 'Inventory Held for Sale', 'Merchandise Inventory', 'Ammunitions', '1040101004', 'Active'),
(247, 'Assets', 'Inventories', 'Inventory Held for Sale', 'Seized/Distrained Personal Property', '', '1040101000', ''),
(248, 'Assets', 'Inventories', 'Inventory Held for Sale', 'Seized/Distrained Personal Property', 'Ammunitions', '1040101004', 'Active'),
(249, 'Assets', 'Inventories', 'Inventory Held for Sale', 'Acquired/Forfeited Real Property', '', '1040101000', ''),
(250, 'Assets', 'Inventories', 'Inventory Held for Sale', 'Acquired/Forfeited Real Property', 'Property and Equipment', '1040101005', 'Active'),
(251, 'Assets', 'Inventories', 'Inventory Held for Sale', 'Aquaculture Produce', '', '1040101000', ''),
(252, 'Assets', 'Inventories', 'Inventory Held for Sale', 'Aquaculture Produce', 'Property and Equipment', '1040101005', 'Active'),
(253, 'Assets', 'Inventories', 'Inventory Held for Sale', 'Forest Products', '', '1040101000', ''),
(254, 'Assets', 'Inventories', 'Inventory Held for Sale', 'Forest Products', 'Property and Equipment', '1040101005', 'Active'),
(255, 'Assets', 'Inventories', 'Inventory Held for Sale', 'Land/Reclaimed Land', '', '1040101000', ''),
(256, 'Assets', 'Inventories', 'Inventory Held for Sale', 'Land/Reclaimed Land', 'Property and Equipment', '1040101005', 'Active'),
(257, 'Assets', 'Inventories', 'Inventory Held for Sale', 'Levied Real Property', '', '1040101000', ''),
(258, 'Assets', 'Inventories', 'Inventory Held for Sale', 'Levied Real Property', 'Property and Equipment', '1040101005', 'Active'),
(259, 'Assets', 'Inventories', 'Inventory Held for Sale', 'Merchandise Inventory', '', '1040101000', ''),
(260, 'Assets', 'Inventories', 'Inventory Held for Sale', 'Merchandise Inventory', 'Property and Equipment', '1040101005', 'Active'),
(261, 'Assets', 'Inventories', 'Inventory Held for Sale', 'Seized/Distrained Personal Property', '', '1040101000', ''),
(262, 'Assets', 'Inventories', 'Inventory Held for Sale', 'Seized/Distrained Personal Property', 'Property and Equipment', '1040101005', 'Active'),
(263, 'Assets', 'Inventories', 'Inventory Held for Sale', 'Acquired/Forfeited Real Property', '', '1040101000', ''),
(264, 'Assets', 'Inventories', 'Inventory Held for Sale', 'Acquired/Forfeited Real Property', 'Others', '1040101099', 'Active'),
(265, 'Assets', 'Inventories', 'Inventory Held for Sale', 'Aquaculture Produce', '', '1040101000', ''),
(266, 'Assets', 'Inventories', 'Inventory Held for Sale', 'Aquaculture Produce', 'Others', '1040101099', 'Active'),
(267, 'Assets', 'Inventories', 'Inventory Held for Sale', 'Forest Products', '', '1040101000', ''),
(268, 'Assets', 'Inventories', 'Inventory Held for Sale', 'Forest Products', 'Others', '1040101099', 'Active'),
(269, 'Assets', 'Inventories', 'Inventory Held for Sale', 'Land/Reclaimed Land', '', '1040101000', ''),
(270, 'Assets', 'Inventories', 'Inventory Held for Sale', 'Land/Reclaimed Land', 'Others', '1040101099', 'Active'),
(271, 'Assets', 'Inventories', 'Inventory Held for Sale', 'Levied Real Property', '', '1040101000', ''),
(272, 'Assets', 'Inventories', 'Inventory Held for Sale', 'Levied Real Property', 'Others', '1040101099', 'Active'),
(273, 'Assets', 'Inventories', 'Inventory Held for Sale', 'Merchandise Inventory', '', '1040101000', ''),
(274, 'Assets', 'Inventories', 'Inventory Held for Sale', 'Merchandise Inventory', 'Others', '1040101099', 'Active'),
(275, 'Assets', 'Inventories', 'Inventory Held for Sale', 'Seized/Distrained Personal Property', '', '1040101000', ''),
(276, 'Assets', 'Inventories', 'Inventory Held for Sale', 'Seized/Distrained Personal Property', 'Others', '1040101099', 'Active'),
(277, 'Assets', 'Inventories', 'Inventory Held for Distribution', '', '', '1040200000', ''),
(278, 'Assets', 'Inventories', 'Inventory Held for Distribution', 'Food Supplies for Distribution', 'Food Supplies for Distribution', '1040201000', 'Active'),
(279, 'Assets', 'Inventories', 'Inventory Held for Distribution', 'Welfare Goods for Distribution', 'Welfare Goods for Distribution', '1040202000', 'Active'),
(280, 'Assets', 'Inventories', 'Inventory Held for Distribution', 'Drugs and Medicines for Distribution', 'Drugs and Medicines for Distribution', '1040203000', 'Active'),
(281, 'Assets', 'Inventories', 'Inventory Held for Distribution', 'Medical, Dental and Laboratory Supplies for Distribution', 'Medical, Dental and Laboratory Supplies for Distribution', '1040204000', 'Active'),
(282, 'Assets', 'Inventories', 'Inventory Held for Distribution', 'Agricultural and Marine Supplies for Distribution', 'Agricultural and Marine Supplies for Distribution', '1040205000', 'Active'),
(283, 'Assets', 'Inventories', 'Inventory Held for Distribution', 'Agricultural Produce for Distribution', 'Agricultural Produce for Distribution', '1040206000', 'Active'),
(284, 'Assets', 'Inventories', 'Inventory Held for Distribution', 'Textbooks and Instructional Materials for Distribution', 'Textbooks and Instructional Materials for Distribution', '1040207000', 'Active'),
(285, 'Assets', 'Inventories', 'Inventory Held for Distribution', 'Construction Materials for Distribution', 'Construction Materials for Distribution', '1040208000', 'Active'),
(286, 'Assets', 'Inventories', 'Inventory Held for Distribution', 'Property and Equipment for Distribution', 'Property and Equipment for Distribution', '1040209000', 'Active'),
(287, 'Assets', 'Inventories', 'Inventory Held for Distribution', 'Other Supplies and  Materials for Distribution', '', '1040299000', ''),
(288, 'Assets', 'Inventories', 'Inventory Held for Distribution', 'Other Supplies and  Materials for Distribution', 'Other Supplies and Materials for Distribution', '1040299000', 'Active'),
(289, 'Assets', 'Inventories', 'Inventory Held for Manufacturing', '', '', '1040300000', ''),
(290, 'Assets', 'Inventories', 'Inventory Held for Manufacturing', 'Raw Materials Inventory', 'Raw Materials Inventory', '1040301000', 'Active'),
(291, 'Assets', 'Inventories', 'Inventory Held for Manufacturing', 'Work-In-Process Inventory', 'Work-In-Process Inventory', '1040302000', 'Active'),
(292, 'Assets', 'Inventories', 'Inventory Held for Manufacturing', 'Finished Goods Inventory', 'Finished Goods Inventory', '1040303000', 'Active'),
(293, 'Assets', 'Inventories', 'Inventory Held for Consumption', '', '', '1040400000', ''),
(294, 'Assets', 'Inventories', 'Inventory Held for Consumption', 'Office Supplies Inventory', 'Office Supplies Inventory', '1040401000', 'Active'),
(295, 'Assets', 'Inventories', 'Inventory Held for Consumption', 'Accountable Forms, Plates and Stickers Inventory', 'Accountable Forms, Plates and Stickers Inventory', '1040402000', 'Active'),
(296, 'Assets', 'Inventories', 'Inventory Held for Consumption', 'Non-Accountable Forms Inventory', 'Non-Accountable Forms Inventory', '1040403000', 'Active'),
(297, 'Assets', 'Inventories', 'Inventory Held for Consumption', 'Animal/Zoological Supplies Inventory', 'Animal/Zoological Supplies Inventory', '1040404000', 'Active'),
(298, 'Assets', 'Inventories', 'Inventory Held for Consumption', 'Food Supplies Inventory', 'Food Supplies Inventory', '1040405000', 'Active'),
(299, 'Assets', 'Inventories', 'Inventory Held for Consumption', 'Drugs and Medicines Inventory', 'Drugs and Medicines Inventory', '1040406000', 'Active'),
(300, 'Assets', 'Inventories', 'Inventory Held for Consumption', 'Medical, Dental and Laboratory Supplies Inventory', 'Medical, Dental and Laboratory Supplies Inventory', '1040407000', 'Active'),
(301, 'Assets', 'Inventories', 'Inventory Held for Consumption', 'Fuel, Oil and Lubricants Inventory', 'Fuel, Oil and Lubricants Inventory', '1040408000', 'Active'),
(302, 'Assets', 'Inventories', 'Inventory Held for Consumption', 'Agricultural and Marine Supplies Inventory', 'Agricultural and Marine Supplies Inventory', '1040409000', 'Active'),
(303, 'Assets', 'Inventories', 'Inventory Held for Consumption', 'Textbooks and Instructional Materials Inventory', 'Textbooks and Instructional Materials Inventory', '1040410000', 'Active'),
(304, 'Assets', 'Inventories', 'Inventory Held for Consumption', 'Military, Police and Traffic Supplies Inventory', 'Military, Police and Traffic Supplies Inventory', '1040411000', 'Active'),
(305, 'Assets', 'Inventories', 'Inventory Held for Consumption', 'Chemical and Filtering Supplies Inventory', 'Chemical and Filtering Supplies Inventory', '1040412000', 'Active'),
(306, 'Assets', 'Inventories', 'Inventory Held for Consumption', 'Construction Materials Inventory', 'Construction Materials Inventory', '1040413000', 'Active'),
(307, 'Assets', 'Inventories', 'Inventory Held for Consumption', 'Other Supplies and Materials Inventory', 'Other Supplies and Materials Inventory', '1040499000', 'Active'),
(308, 'Assets', 'Investment Property', '', '', '', '1050000000', ''),
(309, 'Assets', 'Investment Property', 'Land and Buildings', '', '', '1050100000', ''),
(310, 'Assets', 'Investment Property', 'Land and Buildings', 'Investment Property, Land', 'Investment Property, Land', '1050101000', 'Active');
INSERT INTO `uacs_codes` (`id`, `classification`, `sub_class`, `group_name`, `object_code`, `sub_object_code`, `uacs`, `status`) VALUES
(311, 'Assets', 'Investment Property', 'Land and Buildings', 'Accumulated Impairment Losses - Investment Property, Land', 'Accumulated Impairment Losses - Investment Property, Land', '1050101100', 'Active'),
(312, 'Assets', 'Investment Property', 'Land and Buildings', 'Investment Property, Buildings', 'Investment Property, Buildings', '1050102000', 'Active'),
(313, 'Assets', 'Investment Property', 'Land and Buildings', 'Accumulated Depreciation - Investment Property, Buildings', 'Accumulated Depreciation - Investment Property, Buildings', '1050102100', 'Active'),
(314, 'Assets', 'Investment Property', 'Land and Buildings', 'Accumulated Impairment Losses - Investment Property, Buildings', 'Accumulated Impairment Losses - Investment Property, Buildings', '1050102200', 'Active'),
(315, 'Assets', 'Property, Plant and Equipment', '', '', '', '1060000000', ''),
(316, 'Assets', 'Property, Plant and Equipment', 'Land', '', '', '1060100000', ''),
(317, 'Assets', 'Property, Plant and Equipment', 'Land', 'Accumulated Impairment Losses - Land', 'Accumulated Impairment Losses - Land', '1060101100', 'Active'),
(318, 'Assets', 'Property, Plant and Equipment', 'Land Improvements', '', '', '1060200000', ''),
(319, 'Assets', 'Property, Plant and Equipment', 'Land Improvements', 'Land Improvements, Aquaculture Structures', '', '1060201000', ''),
(320, 'Assets', 'Property, Plant and Equipment', 'Land Improvements', 'Land Improvements, Aquaculture Structures', 'Land Improvements - Aquaculture Structures', '1060201000', 'Active'),
(321, 'Assets', 'Property, Plant and Equipment', 'Land Improvements', 'Accumulated Depreciation - Land Improvements, Aquaculture Structures', '', '1060201100', ''),
(322, 'Assets', 'Property, Plant and Equipment', 'Land Improvements', 'Accumulated Depreciation - Land Improvements, Aquaculture Structures', 'Accumulated Depreciation - Land Improvements - Aquaculture Structures', '1060201100', 'Active'),
(323, 'Assets', 'Property, Plant and Equipment', 'Land Improvements', 'Accumulated Impairment Losses - Land Improvements, Aquaculture Structures', '', '1060201200', ''),
(324, 'Assets', 'Property, Plant and Equipment', 'Land Improvements', 'Accumulated Impairment Losses - Land Improvements, Aquaculture Structures', 'Accumulated Impairment Losses - Land Improvements - Aquaculture Structures', '1060201200', 'Active'),
(325, 'Assets', 'Property, Plant and Equipment', 'Land Improvements', 'Land Improvements, Reforestation Projects', 'Land Improvements, Reforestation Projects', '1060202000', 'Active'),
(326, 'Assets', 'Property, Plant and Equipment', 'Land Improvements', 'Accumulated Impairment Losses - Land Improvements, Reforestation Projects', 'Accumulated Impairment Losses - Land Improvements, Reforestation Projects', '1060202100', 'Active'),
(327, 'Assets', 'Property, Plant and Equipment', 'Land Improvements', 'Other Land Improvements', 'Other Land Improvements', '1060299000', 'Active'),
(328, 'Assets', 'Property, Plant and Equipment', 'Land Improvements', 'Accumulated Depreciation - Other Land Improvements', 'Accumulated Depreciation - Other Land Improvements', '1060299100', 'Active'),
(329, 'Assets', 'Property, Plant and Equipment', 'Land Improvements', 'Accumulated Impairment Losses - Other Land Improvements', 'Accumulated Impairment Losses - Other Land Improvements', '1060299200', 'Active'),
(330, 'Assets', 'Property, Plant and Equipment', 'Infrastructure Assets', '', '', '1060300000', ''),
(331, 'Assets', 'Property, Plant and Equipment', 'Infrastructure Assets', 'Road Networks', 'Road Networks', '1060301000', 'Active'),
(332, 'Assets', 'Property, Plant and Equipment', 'Infrastructure Assets', 'Accumulated Depreciation - Road Networks', 'Accumulated Depreciation - Road Networks', '1060301100', 'Active'),
(333, 'Assets', 'Property, Plant and Equipment', 'Infrastructure Assets', 'Accumulated Impairment Losses - Road Networks', 'Accumulated Impairment Losses - Road Networks', '1060301200', 'Active'),
(334, 'Assets', 'Property, Plant and Equipment', 'Infrastructure Assets', 'Flood Control Systems', 'Flood Control Systems', '1060302000', 'Active'),
(335, 'Assets', 'Property, Plant and Equipment', 'Infrastructure Assets', 'Accumulated Depreciation - Flood Control Systems', 'Accumulated Depreciation - Flood Control Systems', '1060302100', 'Active'),
(336, 'Assets', 'Property, Plant and Equipment', 'Infrastructure Assets', 'Accumulated Impairment Losses - Flood Control Systems', 'Accumulated Impairment Losses - Flood Control Systems', '1060302200', 'Active'),
(337, 'Assets', 'Property, Plant and Equipment', 'Infrastructure Assets', 'Sewer Systems', 'Sewer Systems', '1060303000', 'Active'),
(338, 'Assets', 'Property, Plant and Equipment', 'Infrastructure Assets', 'Accumulated Depreciation - Sewer Systems ', '', '1060303100', ''),
(339, 'Assets', 'Property, Plant and Equipment', 'Infrastructure Assets', 'Accumulated Depreciation - Sewer Systems ', 'Accumulated Depreciation - Sewer Systems', '1060303100', 'Active'),
(340, 'Assets', 'Property, Plant and Equipment', 'Infrastructure Assets', 'Accumulated Impairment Losses - Sewer Systems', 'Accumulated Impairment Losses - Sewer Systems', '1060303200', 'Active'),
(341, 'Assets', 'Property, Plant and Equipment', 'Infrastructure Assets', 'Water Supply Systems', 'Water Supply Systems', '1060304000', 'Active'),
(342, 'Assets', 'Property, Plant and Equipment', 'Infrastructure Assets', 'Accumulated Depreciation - Water Supply Systems', 'Accumulated Depreciation - Water Supply Systems', '1060304100', 'Active'),
(343, 'Assets', 'Property, Plant and Equipment', 'Infrastructure Assets', 'Accumulated Impairment Losses - Water Supply Systems', '', '1060304200', ''),
(344, 'Assets', 'Property, Plant and Equipment', 'Infrastructure Assets', 'Accumulated Impairment Losses - Water Supply Systems', 'Accumulated Impairment Losses - Water Supply Systems ', '1060304200', 'Active'),
(345, 'Assets', 'Property, Plant and Equipment', 'Infrastructure Assets', 'Power Supply Systems', 'Power Supply Systems', '1060305000', 'Active'),
(346, 'Assets', 'Property, Plant and Equipment', 'Infrastructure Assets', 'Accumulated Depreciation - Power Supply Systems', 'Accumulated Depreciation - Power Supply Systems', '1060305100', 'Active'),
(347, 'Assets', 'Property, Plant and Equipment', 'Infrastructure Assets', 'Accumulated Impairment Losses - Power Supply Systems', 'Accumulated Impairment Losses - Power Supply Systems', '1060305200', 'Active'),
(348, 'Assets', 'Property, Plant and Equipment', 'Infrastructure Assets', 'Communication Networks', 'Communication Networks', '1060306000', 'Active'),
(349, 'Assets', 'Property, Plant and Equipment', 'Infrastructure Assets', 'Accumulated Depreciation - Communication Networks', '', '1060306100', ''),
(350, 'Assets', 'Property, Plant and Equipment', 'Infrastructure Assets', 'Accumulated Depreciation - Communication Networks', 'Accumulated Depreciation - Communication  Networks', '1060306100', 'Active'),
(351, 'Assets', 'Property, Plant and Equipment', 'Infrastructure Assets', 'Accumulated Impairment Losses - Communications Networks', '', '1060306200', ''),
(352, 'Assets', 'Property, Plant and Equipment', 'Infrastructure Assets', 'Accumulated Impairment Losses - Communications Networks', 'Accumulated Impairment Losses - Communication Networks', '1060306200', 'Active'),
(353, 'Assets', 'Property, Plant and Equipment', 'Infrastructure Assets', 'Seaport Systems', 'Seaport Systems', '1060307000', 'Active'),
(354, 'Assets', 'Property, Plant and Equipment', 'Infrastructure Assets', 'Accumulated Depreciation - Seaport Systems', 'Accumulated Depreciation - Seaport Systems', '1060307100', 'Active'),
(355, 'Assets', 'Property, Plant and Equipment', 'Infrastructure Assets', 'Accumulated Impairment Losses - Seaport Systems', 'Accumulated Impairment Losses - Seaport Systems', '1060307200', 'Active'),
(356, 'Assets', 'Property, Plant and Equipment', 'Infrastructure Assets', 'Airport Systems', 'Airport Systems', '1060308000', 'Active'),
(357, 'Assets', 'Property, Plant and Equipment', 'Infrastructure Assets', 'Accumulated Depreciation - Airport Systems ', '', '1060308100', ''),
(358, 'Assets', 'Property, Plant and Equipment', 'Infrastructure Assets', 'Accumulated Depreciation - Airport Systems ', 'Accumulated Depreciation - Airport Systems', '1060308100', 'Active'),
(359, 'Assets', 'Property, Plant and Equipment', 'Infrastructure Assets', 'Accumulated Impairment Losses - Airport Systems', 'Accumulated Impairment Losses - Airport Systems', '1060308200', 'Active'),
(360, 'Assets', 'Property, Plant and Equipment', 'Infrastructure Assets', 'Parks, Plazas and Monuments', 'Parks, Plazas and Monuments', '1060309000', 'Active'),
(361, 'Assets', 'Property, Plant and Equipment', 'Infrastructure Assets', 'Accumulated Depreciation - Parks, Plazas and Monuments', 'Accumulated Depreciation - Parks, Plazas and Monuments', '1060309100', 'Active'),
(362, 'Assets', 'Property, Plant and Equipment', 'Infrastructure Assets', 'Accumulated Impairment Losses - Parks, Plazas and Monuments', 'Accumulated Impairment Losses - Parks, Plazas and Monuments', '1060309200', 'Active'),
(363, 'Assets', 'Property, Plant and Equipment', 'Infrastructure Assets', 'Other Infrastructure Assets', 'Other Infrastructure Assets', '1060399000', 'Active'),
(364, 'Assets', 'Property, Plant and Equipment', 'Infrastructure Assets', 'Accumulated Depreciation - Other Infrastructure Assets', 'Accumulated Depreciation - Other Infrastructure Assets', '1060399100', 'Active'),
(365, 'Assets', 'Property, Plant and Equipment', 'Infrastructure Assets', 'Accumulated Impairment Losses - Other Infrastructure Assets', 'Accumulated Impairment Losses - Other Infrastructure Assets', '1060399200', 'Active'),
(366, 'Assets', 'Property, Plant and Equipment', 'Buildings and Other Structures', '', '', '1060400000', ''),
(367, 'Assets', 'Property, Plant and Equipment', 'Buildings and Other Structures', 'Buildings', 'Buildings', '1060401000', 'Active'),
(368, 'Assets', 'Property, Plant and Equipment', 'Buildings and Other Structures', 'Accumulated Depreciation - Buildings', 'Accumulated Depreciation - Buildings', '1060401100', 'Active'),
(369, 'Assets', 'Property, Plant and Equipment', 'Buildings and Other Structures', 'Accumulated Impairment Losses - Buildings', 'Accumulated Impairment Losses - Buildings', '1060401200', 'Active'),
(370, 'Assets', 'Property, Plant and Equipment', 'Buildings and Other Structures', 'School Buildings', 'School Buildings', '1060402000', 'Active'),
(371, 'Assets', 'Property, Plant and Equipment', 'Buildings and Other Structures', 'Accumulated Depreciation - School Buildings', 'Accumulated Depreciation - School Buildings', '1060402100', 'Active'),
(372, 'Assets', 'Property, Plant and Equipment', 'Buildings and Other Structures', 'Accumulated Impairment Losses - School Buildings', 'Accumulated Impairment Losses - School Buildings', '1060402200', 'Active'),
(373, 'Assets', 'Property, Plant and Equipment', 'Buildings and Other Structures', 'Hospitals and Health Centers', 'Hospitals and Health Centers', '1060403000', 'Active'),
(374, 'Assets', 'Property, Plant and Equipment', 'Buildings and Other Structures', 'Accumulated Depreciation - Hospitals and Health Centers ', '', '1060403100', ''),
(375, 'Assets', 'Property, Plant and Equipment', 'Buildings and Other Structures', 'Accumulated Depreciation - Hospitals and Health Centers ', 'Accumulated Depreciation - Hospitals and Health Centers', '1060403100', 'Active'),
(376, 'Assets', 'Property, Plant and Equipment', 'Buildings and Other Structures', 'Accumulated Impairment Losses - Hospitals and Health Centers', 'Accumulated Impairment Losses - Hospitals and Health Centers', '1060403200', 'Active'),
(377, 'Assets', 'Property, Plant and Equipment', 'Buildings and Other Structures', 'Markets', 'Markets', '1060404000', 'Active'),
(378, 'Assets', 'Property, Plant and Equipment', 'Buildings and Other Structures', 'Accumulated Depreciation - Markets', 'Accumulated Depreciation - Markets', '1060404100', 'Active'),
(379, 'Assets', 'Property, Plant and Equipment', 'Buildings and Other Structures', 'Accumulated Impairment Losses - Markets', 'Accumulated Impairment Losses - Markets', '1060404200', 'Active'),
(380, 'Assets', 'Property, Plant and Equipment', 'Buildings and Other Structures', 'Slaughterhouses', 'Slaughterhouses', '1060405000', 'Active'),
(381, 'Assets', 'Property, Plant and Equipment', 'Buildings and Other Structures', 'Accumulated Depreciation - Slaughterhouses ', '', '1060405100', ''),
(382, 'Assets', 'Property, Plant and Equipment', 'Buildings and Other Structures', 'Accumulated Depreciation - Slaughterhouses ', 'Accumulated Depreciation - Slaughterhouses', '1060405100', 'Active'),
(383, 'Assets', 'Property, Plant and Equipment', 'Buildings and Other Structures', 'Accumulated Impairment Losses - Slaughterhouses', 'Accumulated Impairment Losses - Slaughterhouses', '1060405200', 'Active'),
(384, 'Assets', 'Property, Plant and Equipment', 'Buildings and Other Structures', 'Hostels and Dormitories', 'Hostels and Dormitories', '1060406000', 'Active'),
(385, 'Assets', 'Property, Plant and Equipment', 'Buildings and Other Structures', 'Accumulated Depreciation - Hostels and Dormitories', 'Accumulated Depreciation - Hostels and Dormitories', '1060406100', 'Active'),
(386, 'Assets', 'Property, Plant and Equipment', 'Buildings and Other Structures', 'Accumulated Impairment Losses - Hostels and Dormitories', 'Accumulated Impairment Losses - Hostels and Dormitories', '1060406200', 'Active'),
(387, 'Assets', 'Property, Plant and Equipment', 'Buildings and Other Structures', 'Other Structures', 'Other Structures', '1060499000', 'Active'),
(388, 'Assets', 'Property, Plant and Equipment', 'Buildings and Other Structures', 'Accumulated Depreciation - Other Structures', 'Accumulated Depreciation - Other Structures', '1060499100', 'Active'),
(389, 'Assets', 'Property, Plant and Equipment', 'Buildings and Other Structures', 'Accumulated Impairment Losses - Other Structures', 'Accumulated Impairment Losses - Other Structures', '1060499200', 'Active'),
(390, 'Assets', 'Property, Plant and Equipment', 'Machinery and Equipment', '', '', '1060500000', ''),
(391, 'Assets', 'Property, Plant and Equipment', 'Machinery and Equipment', 'Machinery', 'Machinery', '1060501000', 'Active'),
(392, 'Assets', 'Property, Plant and Equipment', 'Machinery and Equipment', 'Accumulated Depreciation - Machinery', 'Accumulated Depreciation - Machinery', '1060501100', 'Active'),
(393, 'Assets', 'Property, Plant and Equipment', 'Machinery and Equipment', 'Accumulated Impairment Losses - Machinery', 'Accumulated Impairment Losses - Machinery', '1060501200', 'Active'),
(394, 'Assets', 'Property, Plant and Equipment', 'Machinery and Equipment', 'Office Equipment', 'Office Equipment', '1060502000', 'Active'),
(395, 'Assets', 'Property, Plant and Equipment', 'Machinery and Equipment', 'Accumulated Depreciation - Office Equipment', 'Accumulated Depreciation - Office Equipment', '1060502100', 'Active'),
(396, 'Assets', 'Property, Plant and Equipment', 'Machinery and Equipment', 'Accumulated Impairment Losses - Office Equipment', 'Accumulated Impairment Losses - Office Equipment', '1060502200', 'Active'),
(397, 'Assets', 'Property, Plant and Equipment', 'Machinery and Equipment', 'Information and Communications Technology Equipment', '', '1060503000', ''),
(398, 'Assets', 'Property, Plant and Equipment', 'Machinery and Equipment', 'Information and Communications Technology Equipment', 'Information and Communication Technology Equipment', '1060503000', 'Active'),
(399, 'Assets', 'Property, Plant and Equipment', 'Machinery and Equipment', 'Accumulated Depreciation - Information and Communications Technology Equipment', '', '1060503100', ''),
(400, 'Assets', 'Property, Plant and Equipment', 'Machinery and Equipment', 'Accumulated Depreciation - Information and Communications Technology Equipment', 'Accumulated Depreciation - Information and Communication Technology Equipment', '1060503100', 'Active'),
(401, 'Assets', 'Property, Plant and Equipment', 'Machinery and Equipment', 'Accumulated Impairment Losses - Information and Communications Technology Equipment', '', '1060503200', ''),
(402, 'Assets', 'Property, Plant and Equipment', 'Machinery and Equipment', 'Accumulated Impairment Losses - Information and Communications Technology Equipment', 'Accumulated Impairment Losses - Information and Communication Technology Equipment', '1060503200', 'Active'),
(403, 'Assets', 'Property, Plant and Equipment', 'Machinery and Equipment', 'Agricultural and Forestry Equipment', 'Agricultural and Forestry Equipment', '1060504000', 'Active'),
(404, 'Assets', 'Property, Plant and Equipment', 'Machinery and Equipment', 'Accumulated Depreciation - Agricultural and Forestry Equipment', 'Accumulated Depreciation - Agricultural and Forestry Equipment', '1060504100', 'Active'),
(405, 'Assets', 'Property, Plant and Equipment', 'Machinery and Equipment', 'Accumulated Impairment Losses - Agricultural and Forestry Equipment', 'Accumulated Impairment Losses - Agricultural and Forestry Equipment', '1060504200', 'Active'),
(406, 'Assets', 'Property, Plant and Equipment', 'Machinery and Equipment', 'Marine and Fishery Equipment', 'Marine and Fishery Equipment', '1060505000', 'Active'),
(407, 'Assets', 'Property, Plant and Equipment', 'Machinery and Equipment', 'Accumulated Depreciation - Marine and Fishery Equipment', 'Accumulated Depreciation - Marine and Fishery Equipment', '1060505100', 'Active'),
(408, 'Assets', 'Property, Plant and Equipment', 'Machinery and Equipment', 'Accumulated Impairment Losses - Marine and Fishery Equipment', 'Accumulated Impairment Losses - Marine and Fishery Equipment', '1060505200', 'Active'),
(409, 'Assets', 'Property, Plant and Equipment', 'Machinery and Equipment', 'Airport Equipment', 'Airport Equipment', '1060506000', 'Active'),
(410, 'Assets', 'Property, Plant and Equipment', 'Machinery and Equipment', 'Accumulated Depreciation - Airport Equipment', 'Accumulated Depreciation - Airport Equipment', '1060506100', 'Active'),
(411, 'Assets', 'Property, Plant and Equipment', 'Machinery and Equipment', 'Accumulated Impairment Losses - Airport Equipment', 'Accumulated Impairment Losses - Airport Equipment', '1060506200', 'Active'),
(412, 'Assets', 'Property, Plant and Equipment', 'Machinery and Equipment', 'Communications Equipment', '', '1060507000', ''),
(413, 'Assets', 'Property, Plant and Equipment', 'Machinery and Equipment', 'Communications Equipment', 'Communication Equipment', '1060507000', 'Active'),
(414, 'Assets', 'Property, Plant and Equipment', 'Machinery and Equipment', 'Accumulated Depreciation - Communications Equipment', '', '1060507100', ''),
(415, 'Assets', 'Property, Plant and Equipment', 'Machinery and Equipment', 'Accumulated Depreciation - Communications Equipment', 'Accumulated Depreciation - Communication Equipment', '1060507100', 'Active'),
(416, 'Assets', 'Property, Plant and Equipment', 'Machinery and Equipment', 'Accumulated Impairment Losses - Communications Equipment', '', '1060507200', ''),
(417, 'Assets', 'Property, Plant and Equipment', 'Machinery and Equipment', 'Accumulated Impairment Losses - Communications Equipment', 'Accumulated Impairment Losses - Communication Equipment', '1060507200', 'Active'),
(418, 'Assets', 'Property, Plant and Equipment', 'Machinery and Equipment', 'Construction and Heavy Equipment', 'Construction and Heavy Equipment', '1060508000', 'Active'),
(419, 'Assets', 'Property, Plant and Equipment', 'Machinery and Equipment', 'Accumulated Depreciation - Construction and Heavy Equipment', 'Accumulated Depreciation - Construction and Heavy Equipment', '1060508100', 'Active'),
(420, 'Assets', 'Property, Plant and Equipment', 'Machinery and Equipment', 'Accumulated Impairment Losses - Construction and Heavy Equipment', 'Accumulated Impairment Losses - Construction and Heavy Equipment', '1060508200', 'Active'),
(421, 'Assets', 'Property, Plant and Equipment', 'Machinery and Equipment', 'Disaster Response and Rescue Equipment', '', '1060509000', ''),
(422, 'Assets', 'Property, Plant and Equipment', 'Machinery and Equipment', 'Disaster Response and Rescue Equipment', 'Firefighting Equipment and Accessories', '1060509001', 'Active'),
(423, 'Assets', 'Property, Plant and Equipment', 'Machinery and Equipment', 'Disaster Response and Rescue Equipment', 'Flood and Rescue Equipment', '1060509002', 'Active'),
(424, 'Assets', 'Property, Plant and Equipment', 'Machinery and Equipment', 'Disaster Response and Rescue Equipment', 'Earthquake Rescue Equipment', '1060509003', 'Active'),
(425, 'Assets', 'Property, Plant and Equipment', 'Machinery and Equipment', 'Disaster Response and Rescue Equipment', 'Volcanic Eruption Rescue Equipment', '1060509004', 'Active'),
(426, 'Assets', 'Property, Plant and Equipment', 'Machinery and Equipment', 'Disaster Response and Rescue Equipment', 'Landslide Rescue Equipment', '1060509005', 'Active'),
(427, 'Assets', 'Property, Plant and Equipment', 'Machinery and Equipment', 'Accumulated Depreciation - Disaster Response and Rescue Equipment', 'Accumulated Depreciation - Disaster Response and Rescue Equipment', '1060509100', 'Active'),
(428, 'Assets', 'Property, Plant and Equipment', 'Machinery and Equipment', 'Accumulated Impairment Losses - Disaster Response and Rescue Equipment', 'Accumulated Impairment Losses - Disaster Response and Rescue Equipment', '1060509200', 'Active'),
(429, 'Assets', 'Property, Plant and Equipment', 'Machinery and Equipment', 'Military, Police and Security Equipment', 'Military, Police and Security Equipment', '1060510000', 'Active'),
(430, 'Assets', 'Property, Plant and Equipment', 'Machinery and Equipment', 'Accumulated Depreciation - Military, Police and Security Equipment', 'Accumulated Depreciation - Military, Police and Security Equipment', '1060510100', 'Active'),
(431, 'Assets', 'Property, Plant and Equipment', 'Machinery and Equipment', 'Accumulated Impairment Losses - Military, Police and Security Equipment', 'Accumulated Impairment Losses - Military, Police and Security Equipment', '1060510200', 'Active'),
(432, 'Assets', 'Property, Plant and Equipment', 'Machinery and Equipment', 'Medical Equipment', 'Medical Equipment', '1060511000', 'Active'),
(433, 'Assets', 'Property, Plant and Equipment', 'Machinery and Equipment', 'Accumulated Depreciation - Medical Equipment', 'Accumulated Depreciation - Medical Equipment', '1060511100', 'Active'),
(434, 'Assets', 'Property, Plant and Equipment', 'Machinery and Equipment', 'Accumulated Impairment Losses - Medical Equipment', 'Accumulated Impairment Losses - Medical Equipment', '1060511200', 'Active'),
(435, 'Assets', 'Property, Plant and Equipment', 'Machinery and Equipment', 'Printing Equipment', 'Printing Equipment', '1060512000', 'Active'),
(436, 'Assets', 'Property, Plant and Equipment', 'Machinery and Equipment', 'Accumulated Depreciation - Printing Equipment', 'Accumulated Depreciation - Printing Equipment', '1060512100', 'Active'),
(437, 'Assets', 'Property, Plant and Equipment', 'Machinery and Equipment', 'Accumulated Impairment Losses - Printing Equipment', 'Accumulated Impairment Losses - Printing Equipment', '1060512200', 'Active'),
(438, 'Assets', 'Property, Plant and Equipment', 'Machinery and Equipment', 'Sports Equipment', 'Sports Equipment', '1060513000', 'Active'),
(439, 'Assets', 'Property, Plant and Equipment', 'Machinery and Equipment', 'Accumulated Depreciation - Sports Equipment', 'Accumulated Depreciation - Sports Equipment', '1060513100', 'Active'),
(440, 'Assets', 'Property, Plant and Equipment', 'Machinery and Equipment', 'Accumulated Impairment Losses - Sports Equipment', 'Accumulated Impairment Losses - Sports Equipment', '1060513200', 'Active'),
(441, 'Assets', 'Property, Plant and Equipment', 'Machinery and Equipment', 'Technical and Scientific Equipment', 'Technical and Scientific Equipment', '1060514000', 'Active'),
(442, 'Assets', 'Property, Plant and Equipment', 'Machinery and Equipment', 'Accumulated Depreciation - Technical and Scientific Equipment', 'Accumulated Depreciation - Technical and Scientific Equipment', '1060514100', 'Active'),
(443, 'Assets', 'Property, Plant and Equipment', 'Machinery and Equipment', 'Accumulated Impairment Losses - Technical and Scientific Equipment', 'Accumulated Impairment Losses - Technical and Scientific Equipment', '1060514200', 'Active'),
(444, 'Assets', 'Property, Plant and Equipment', 'Machinery and Equipment', 'Other Equipment', '', '1060599000', ''),
(445, 'Assets', 'Property, Plant and Equipment', 'Machinery and Equipment', 'Other Equipment', 'Other Machinery and Equipment', '1060599000', 'Active'),
(446, 'Assets', 'Property, Plant and Equipment', 'Machinery and Equipment', 'Accumulated Depreciation - Other Equipment', '', '1060599100', ''),
(447, 'Assets', 'Property, Plant and Equipment', 'Machinery and Equipment', 'Accumulated Depreciation - Other Equipment', 'Accumulated Depreciation - Other Machinery and Equipment', '1060599100', 'Active'),
(448, 'Assets', 'Property, Plant and Equipment', 'Machinery and Equipment', 'Accumulated Impairment Losses - Other Equipment', '', '1060599200', ''),
(449, 'Assets', 'Property, Plant and Equipment', 'Machinery and Equipment', 'Accumulated Impairment Losses - Other Equipment', 'Accumulated Impairment Losses - Other Machinery and Equipment', '1060599200', 'Active'),
(450, 'Assets', 'Property, Plant and Equipment', 'Transportation Equipment', '', '', '1060600000', ''),
(451, 'Assets', 'Property, Plant and Equipment', 'Transportation Equipment', 'Motor Vehicles', 'Motor Vehicles', '1060601000', 'Active'),
(452, 'Assets', 'Property, Plant and Equipment', 'Transportation Equipment', 'Accumulated Depreciation - Motor Vehicles', 'Accumulated Depreciation - Motor Vehicles', '1060601100', 'Active'),
(453, 'Assets', 'Property, Plant and Equipment', 'Transportation Equipment', 'Accumulated Impairment Losses - Motor Vehicles', 'Accumulated Impairment Losses - Motor Vehicles', '1060601200', 'Active'),
(454, 'Assets', 'Property, Plant and Equipment', 'Transportation Equipment', 'Trains', 'Trains', '1060602000', 'Active'),
(455, 'Assets', 'Property, Plant and Equipment', 'Transportation Equipment', 'Accumulated Depreciation - Trains', 'Accumulated Depreciation - Trains', '1060602100', 'Active'),
(456, 'Assets', 'Property, Plant and Equipment', 'Transportation Equipment', 'Accumulated Impairment Losses - Trains', 'Accumulated Impairment Losses - Trains', '1060602200', 'Active'),
(457, 'Assets', 'Property, Plant and Equipment', 'Transportation Equipment', 'Aircrafts and Aircrafts Ground Equipment', 'Aircrafts and Aircrafts Ground Equipment', '1060603000', 'Active'),
(458, 'Assets', 'Property, Plant and Equipment', 'Transportation Equipment', 'Accumulated Depreciation - Aircrafts and Aircrafts Ground Equipment', 'Accumulated Depreciation - Aircrafts and Aircrafts Ground Equipment', '1060603100', 'Active'),
(459, 'Assets', 'Property, Plant and Equipment', 'Transportation Equipment', 'Accumulated Impairment Losses - Aircrafts and Aircrafts Ground Equipment', 'Accumulated Impairment Losses - Aircrafts and Aircrafts Ground Equipment', '1060603200', 'Active'),
(460, 'Assets', 'Property, Plant and Equipment', 'Transportation Equipment', 'Watercrafts', 'Watercrafts', '1060604000', 'Active'),
(461, 'Assets', 'Property, Plant and Equipment', 'Transportation Equipment', 'Accumulated Depreciation - Watercrafts', 'Accumulated Depreciation - Watercrafts', '1060604100', 'Active'),
(462, 'Assets', 'Property, Plant and Equipment', 'Transportation Equipment', 'Accumulated Impairment Losses - Watercrafts', 'Accumulated Impairment Losses - Watercrafts', '1060604200', 'Active'),
(463, 'Assets', 'Property, Plant and Equipment', 'Transportation Equipment', 'Other Transportation Equipment', 'Other Transportation Equipment', '1060699000', 'Active'),
(464, 'Assets', 'Property, Plant and Equipment', 'Transportation Equipment', 'Accumulated Depreciation - Other Transportation Equipment', 'Accumulated Depreciation - Other Transportation Equipment', '1060699100', 'Active'),
(465, 'Assets', 'Property, Plant and Equipment', 'Transportation Equipment', 'Accumulated Impairment Losses - Other Transportation Equipment', 'Accumulated Impairment Losses - Other Transportation Equipment', '1060699200', 'Active'),
(466, 'Assets', 'Property, Plant and Equipment', 'Furniture, Fixtures and Books', '', '', '1060700000', ''),
(467, 'Assets', 'Property, Plant and Equipment', 'Furniture, Fixtures and Books', 'Furniture and Fixtures', 'Furniture and Fixtures', '1060701000', 'Active'),
(468, 'Assets', 'Property, Plant and Equipment', 'Furniture, Fixtures and Books', 'Accumulated Depreciation - Furniture and Fixtures', 'Accumulated Depreciation - Furniture and Fixtures', '1060701100', 'Active'),
(469, 'Assets', 'Property, Plant and Equipment', 'Furniture, Fixtures and Books', 'Accumulated Impairment Losses - Furniture and Fixtures', 'Accumulated Impairment Losses - Furniture and Fixtures', '1060701200', 'Active'),
(470, 'Assets', 'Property, Plant and Equipment', 'Furniture, Fixtures and Books', 'Books', 'Books', '1060702000', 'Active'),
(471, 'Assets', 'Property, Plant and Equipment', 'Furniture, Fixtures and Books', 'Accumulated Depreciation - Books', 'Accumulated Depreciation - Books', '1060702100', 'Active'),
(472, 'Assets', 'Property, Plant and Equipment', 'Furniture, Fixtures and Books', 'Accumulated Impairment Losses - Books', 'Accumulated Impairment Losses - Books', '1060702200', 'Active'),
(473, 'Assets', 'Property, Plant and Equipment', 'Leased Assets', '', '', '1060800000', ''),
(474, 'Assets', 'Property, Plant and Equipment', 'Leased Assets', 'Leased Asset, Land', '', '1060801000', ''),
(475, 'Assets', 'Property, Plant and Equipment', 'Leased Assets', 'Leased Asset, Land', 'Leased Assets, Land', '1060801000', 'Active'),
(476, 'Assets', 'Property, Plant and Equipment', 'Leased Assets', 'Leased Asset, Buildings and Other Structures', '', '1060802000', ''),
(477, 'Assets', 'Property, Plant and Equipment', 'Leased Assets', 'Leased Asset, Buildings and Other Structures', 'Leased Assets, Buildings and Other Structures', '1060802000', 'Active'),
(478, 'Assets', 'Property, Plant and Equipment', 'Leased Assets', 'Accumulated Depreciation - Leased Asset, Buildings and Other Structures', '', '1060802100', ''),
(479, 'Assets', 'Property, Plant and Equipment', 'Leased Assets', 'Accumulated Depreciation - Leased Asset, Buildings and Other Structures', 'Accumulated Depreciation - Leased Assets, Buildings and Other Structures', '1060802100', 'Active'),
(480, 'Assets', 'Property, Plant and Equipment', 'Leased Assets', 'Accumulated Impairment Losses - Leased Asset, Buildings and Other Structures', '', '1060802200', ''),
(481, 'Assets', 'Property, Plant and Equipment', 'Leased Assets', 'Accumulated Impairment Losses - Leased Asset, Buildings and Other Structures', 'Accumulated Impairment Losses - Leased Assets, Buildings and Other Structures', '1060802200', 'Active'),
(482, 'Assets', 'Property, Plant and Equipment', 'Leased Assets', 'Leased Asset, Machinery and Equipment', '', '1060803000', ''),
(483, 'Assets', 'Property, Plant and Equipment', 'Leased Assets', 'Leased Asset, Machinery and Equipment', 'Leased Assets, Machinery and Equipment', '1060803000', 'Active'),
(484, 'Assets', 'Property, Plant and Equipment', 'Leased Assets', 'Accumulated Depreciation - Leased Asset, Machinery and Equipment', '', '1060803100', ''),
(485, 'Assets', 'Property, Plant and Equipment', 'Leased Assets', 'Accumulated Depreciation - Leased Asset, Machinery and Equipment', 'Accumulated Depreciation - Leased Assets, Machinery and Equipment', '1060803100', 'Active'),
(486, 'Assets', 'Property, Plant and Equipment', 'Leased Assets', 'Accumulated Impairment Losses - Leased Asset, Machinery and Equipment', '', '1060803200', ''),
(487, 'Assets', 'Property, Plant and Equipment', 'Leased Assets', 'Accumulated Impairment Losses - Leased Asset, Machinery and Equipment', 'Accumulated Impairment Losses - Leased Assets, Machinery and Equipment', '1060803200', 'Active'),
(488, 'Assets', 'Property, Plant and Equipment', 'Leased Assets', 'Leased Asset, Transportation Equipment', '', '1060804000', ''),
(489, 'Assets', 'Property, Plant and Equipment', 'Leased Assets', 'Leased Asset, Transportation Equipment', 'Leased Assets, Transportation Equipment', '1060804000', 'Active'),
(490, 'Assets', 'Property, Plant and Equipment', 'Leased Assets', 'Accumulated Depreciation - Leased Asset, Transportation Equipment', '', '1060804100', ''),
(491, 'Assets', 'Property, Plant and Equipment', 'Leased Assets', 'Accumulated Depreciation - Leased Asset, Transportation Equipment', 'Accumulated Depreciation - Leased Assets, Transportation Equipment', '1060804100', 'Active'),
(492, 'Assets', 'Property, Plant and Equipment', 'Leased Assets', 'Accumulated Impairment Losses - Leased Asset, Transportation Equipment', '', '1060804200', ''),
(493, 'Assets', 'Property, Plant and Equipment', 'Leased Assets', 'Accumulated Impairment Losses - Leased Asset, Transportation Equipment', 'Accumulated Impairment Losses - Leased Assets, Transportation Equipment', '1060804200', 'Active'),
(494, 'Assets', 'Property, Plant and Equipment', 'Leased Assets', 'Other Leased Assets', 'Other Leased Assets', '1060899000', 'Active'),
(495, 'Assets', 'Property, Plant and Equipment', 'Leased Assets', 'Accumulated Depreciation - Other Leased Assets', 'Accumulated Depreciation - Other Leased Assets', '1060899100', 'Active'),
(496, 'Assets', 'Property, Plant and Equipment', 'Leased Assets', 'Accumulated Impairment Losses - Other Leased Assets', '', '1060899200', ''),
(497, 'Assets', 'Property, Plant and Equipment', 'Leased Assets', 'Accumulated Impairment Losses - Other Leased Assets', 'Accumulated Impairment Losses -Other Leased Assets', '1060899200', 'Active'),
(498, 'Assets', 'Property, Plant and Equipment', 'Leased Assets - Improvements', '', '', '1060900000', ''),
(499, 'Assets', 'Property, Plant and Equipment', 'Leased Assets - Improvements', 'Leased Asset Improvements, Land', '', '1060901000', ''),
(500, 'Assets', 'Property, Plant and Equipment', 'Leased Assets - Improvements', 'Leased Asset Improvements, Land', 'Leased Assets Improvements, Land', '1060901000', 'Active'),
(501, 'Assets', 'Property, Plant and Equipment', 'Leased Assets - Improvements', 'Accumulated Depreciation - Leased Asset Improvements, Land', '', '1060901100', ''),
(502, 'Assets', 'Property, Plant and Equipment', 'Leased Assets - Improvements', 'Accumulated Depreciation - Leased Asset Improvements, Land', 'Accumulated Depreciation - Leased Assets Improvements, Land', '1060901100', 'Active'),
(503, 'Assets', 'Property, Plant and Equipment', 'Leased Assets - Improvements', 'Accumulated Impairment Losses - Leased Asset Improvements, Land', '', '1060901200', ''),
(504, 'Assets', 'Property, Plant and Equipment', 'Leased Assets - Improvements', 'Accumulated Impairment Losses - Leased Asset Improvements, Land', 'Accumulated Impairment Losses - Leased Assets Improvements, Land', '1060901200', 'Active'),
(505, 'Assets', 'Property, Plant and Equipment', 'Leased Assets - Improvements', 'Leased Asset Improvements, Buildings and Other Structures', '', '1060902000', ''),
(506, 'Assets', 'Property, Plant and Equipment', 'Leased Assets - Improvements', 'Leased Asset Improvements, Buildings and Other Structures', 'Leased Assets Improvements, Buildings', '1060902000', 'Active'),
(507, 'Assets', 'Property, Plant and Equipment', 'Leased Assets - Improvements', 'Accumulated Depreciation - Leased Asset Improvements, Buildings and Other Structures', '', '1060902100', ''),
(508, 'Assets', 'Property, Plant and Equipment', 'Leased Assets - Improvements', 'Accumulated Depreciation - Leased Asset Improvements, Buildings and Other Structures', 'Accumulated Depreciation - Leased Assets Improvements, Buildings', '1060902100', 'Active'),
(509, 'Assets', 'Property, Plant and Equipment', 'Leased Assets - Improvements', 'Accumulated Impairment Losses - Leased Asset Improvements, Buildings and Other Structures', '', '1060902200', ''),
(510, 'Assets', 'Property, Plant and Equipment', 'Leased Assets - Improvements', 'Accumulated Impairment Losses - Leased Asset Improvements, Buildings and Other Structures', 'Accumulated Impairment Losses - Leased Assets Improvements, Buildings', '1060902200', 'Active'),
(511, 'Assets', 'Property, Plant and Equipment', 'Leased Assets - Improvements', 'Other Leased Assets Improvements', 'Other Leased Assets Improvements', '1060999000', 'Active'),
(512, 'Assets', 'Property, Plant and Equipment', 'Leased Assets - Improvements', 'Accumulated Depreciation - Other Leased Assets Improvements', 'Accumulated Depreciation - Other Leased Assets Improvements', '1060999100', 'Active'),
(513, 'Assets', 'Property, Plant and Equipment', 'Leased Assets - Improvements', 'Accumulated Impairment Losses - Other Leased Assets Improvements', 'Accumulated Impairment Losses - Other Leased Assets Improvements', '1060999200', 'Active'),
(514, 'Assets', 'Property, Plant and Equipment', 'Construction in Progress', '', '', '1061000000', ''),
(515, 'Assets', 'Property, Plant and Equipment', 'Construction in Progress', 'Construction in Progress - Land Improvements', 'Construction in Progress - Land Improvements', '1061001000', 'Active'),
(516, 'Assets', 'Property, Plant and Equipment', 'Construction in Progress', 'Construction in Progress - Infrastructure Assets', 'Construction in Progress - Infrastructure Assets', '1061002000', 'Active'),
(517, 'Assets', 'Property, Plant and Equipment', 'Construction in Progress', 'Construction in Progress - Buildings and Other Structures', 'Construction in Progress - Buildings and Other Structures', '1061003000', 'Active'),
(518, 'Assets', 'Property, Plant and Equipment', 'Construction in Progress', 'Construction in Progress - Leased Assets', 'Construction in Progress - Leased Assets', '1061004000', 'Active'),
(519, 'Assets', 'Property, Plant and Equipment', 'Construction in Progress', 'Construction in Progress - Leased Assets Improvements', 'Construction in Progress - Leased Assets Improvements', '1061005000', 'Active'),
(520, 'Assets', 'Property, Plant and Equipment', 'Heritage Assets', '', '', '1061100000', ''),
(521, 'Assets', 'Property, Plant and Equipment', 'Heritage Assets', 'Historical Buildings', 'Historical Buildings', '1061101000', 'Active'),
(522, 'Assets', 'Property, Plant and Equipment', 'Heritage Assets', 'Accumulated Depreciation - Historical Buildings', 'Accumulated Depreciation - Historical Buildings', '1061101100', 'Active'),
(523, 'Assets', 'Property, Plant and Equipment', 'Heritage Assets', 'Accumulated Impairment Losses - Historical Buildings', 'Accumulated Impairment Losses - Historical Buildings', '1061101200', 'Active'),
(524, 'Assets', 'Property, Plant and Equipment', 'Heritage Assets', 'Works of Arts and Archeological Specimens', 'Works of Arts and Archeological Specimens', '1061102000', 'Active'),
(525, 'Assets', 'Property, Plant and Equipment', 'Heritage Assets', 'Accumulated Depreciation - Works of Arts and Archeological Specimens', 'Accumulated Depreciation - Works of Arts and Archeological Specimens', '1061102100', 'Active'),
(526, 'Assets', 'Property, Plant and Equipment', 'Heritage Assets', 'Accumulated Impairment Losses - Works of Arts and Archeological Specimens', 'Accumulated Impairment Losses - Works of Arts and Archeological Specimens', '1061102200', 'Active'),
(527, 'Assets', 'Property, Plant and Equipment', 'Heritage Assets', 'Other Heritage Assets', 'Other Heritage Assets', '1061199000', 'Active'),
(528, 'Assets', 'Property, Plant and Equipment', 'Heritage Assets', 'Accumulated Depreciation - Other Heritage Assets', 'Accumulated Depreciation - Other Heritage Assets', '1061199100', 'Active'),
(529, 'Assets', 'Property, Plant and Equipment', 'Heritage Assets', 'Accumulated Impairment Losses - Other Heritage Assets', 'Accumulated Impairment Losses - Other Heritage Assets', '1061199200', 'Active'),
(530, 'Assets', 'Property, Plant and Equipment', 'Service Concession Tangible Assets', '', '', '1061200000', ''),
(531, 'Assets', 'Property, Plant and Equipment', 'Service Concession Tangible Assets', 'Service Concession - Road Networks', '', '1061201000', ''),
(532, 'Assets', 'Property, Plant and Equipment', 'Service Concession Tangible Assets', 'Service Concession - Road Networks', 'Service Concession- Road Networks', '1061201000', 'Active'),
(533, 'Assets', 'Property, Plant and Equipment', 'Service Concession Tangible Assets', 'Accumulated Depreciation - Service Concession - Road Networks', '', '1061201100', ''),
(534, 'Assets', 'Property, Plant and Equipment', 'Service Concession Tangible Assets', 'Accumulated Depreciation - Service Concession - Road Networks', 'Accumulated Depreciation - Service Concession- Road Networks', '1061201100', 'Active'),
(535, 'Assets', 'Property, Plant and Equipment', 'Service Concession Tangible Assets', 'Accumulated Impairment Losses - Service Concession - Road Networks', '', '1061201200', ''),
(536, 'Assets', 'Property, Plant and Equipment', 'Service Concession Tangible Assets', 'Accumulated Impairment Losses - Service Concession - Road Networks', 'Accumulated Impairment Losses -Service Concession - Road Networks', '1061201200', 'Active'),
(537, 'Assets', 'Property, Plant and Equipment', 'Service Concession Tangible Assets', 'Service Concession - Flood Control Systems', 'Service Concession - Flood Control Systems', '1061202000', 'Active'),
(538, 'Assets', 'Property, Plant and Equipment', 'Service Concession Tangible Assets', 'Accumulated Depreciation - Service Concession - Flood Control Systems', 'Accumulated Depreciation - Service Concession - Flood Control Systems', '1061202100', 'Active'),
(539, 'Assets', 'Property, Plant and Equipment', 'Service Concession Tangible Assets', 'Accumulated Impairment Losses - Service Concession - Flood Control Systems', 'Accumulated Impairment Losses - Service Concession - Flood Control Systems', '1061202200', 'Active'),
(540, 'Assets', 'Property, Plant and Equipment', 'Service Concession Tangible Assets', 'Service Concession - Sewer Systems', 'Service Concession - Sewer Systems', '1061203000', 'Active'),
(541, 'Assets', 'Property, Plant and Equipment', 'Service Concession Tangible Assets', 'Accumulated Depreciation - Service Concession - Sewer Systems', 'Accumulated Depreciation - Service Concession - Sewer Systems', '1061203100', 'Active'),
(542, 'Assets', 'Property, Plant and Equipment', 'Service Concession Tangible Assets', 'Accumulated Impairment Losses - Service Concession - Sewer Systems', 'Accumulated Impairment Losses - Service Concession - Sewer Systems', '1061203200', 'Active'),
(543, 'Assets', 'Property, Plant and Equipment', 'Service Concession Tangible Assets', 'Service Concession - Water Supply Systems', 'Service Concession - Water Supply Systems', '1061204000', 'Active'),
(544, 'Assets', 'Property, Plant and Equipment', 'Service Concession Tangible Assets', 'Accumulated Depreciation - Service Concession - Water Supply Systems', 'Accumulated Depreciation - Service Concession - Water Supply Systems', '1061204100', 'Active'),
(545, 'Assets', 'Property, Plant and Equipment', 'Service Concession Tangible Assets', 'Accumulated Impairment Losses - Service Concession - Water Supply Systems', 'Accumulated Impairment Losses - Service Concession - Water Supply Systems', '1061204200', 'Active'),
(546, 'Assets', 'Property, Plant and Equipment', 'Service Concession Tangible Assets', 'Service Concession - Power Supply Systems', 'Service Concession - Power Supply Systems', '1061205000', 'Active'),
(547, 'Assets', 'Property, Plant and Equipment', 'Service Concession Tangible Assets', 'Accumulated Depreciation - Service Concession - Power Supply Systems', 'Accumulated Depreciation - Service Concession - Power Supply Systems', '1061205100', 'Active'),
(548, 'Assets', 'Property, Plant and Equipment', 'Service Concession Tangible Assets', 'Accumulated Impairment Losses - Service Concession - Power Supply Systems', 'Accumulated Impairment Losses - Service Concession - Power Supply Systems', '1061205200', 'Active'),
(549, 'Assets', 'Property, Plant and Equipment', 'Service Concession Tangible Assets', 'Service Concession - Communication Networks', 'Service Concession - Communication Networks', '1061206000', 'Active'),
(550, 'Assets', 'Property, Plant and Equipment', 'Service Concession Tangible Assets', 'Accumulated Depreciation - Service Concession - Communication Networks', 'Accumulated Depreciation - Service Concession - Communication Networks', '1061206100', 'Active'),
(551, 'Assets', 'Property, Plant and Equipment', 'Service Concession Tangible Assets', 'Accumulated Impairment Losses - Service Concession - Communication Networks', 'Accumulated Impairment Losses - Service Concession - Communication Networks', '1061206200', 'Active'),
(552, 'Assets', 'Property, Plant and Equipment', 'Service Concession Tangible Assets', 'Service Concession - Seaport Systems', 'Service Concession - Seaport Systems', '1061207000', 'Active'),
(553, 'Assets', 'Property, Plant and Equipment', 'Service Concession Tangible Assets', 'Accumulated Depreciation - Service Concession - Seaport Systems', 'Accumulated Depreciation - Service Concession - Seaport Systems', '1061207100', 'Active'),
(554, 'Assets', 'Property, Plant and Equipment', 'Service Concession Tangible Assets', 'Accumulated Impairment Losses - Service Concession - Seaport Systems', 'Accumulated Impairment Losses - Service Concession - Seaport Systems', '1061207200', 'Active'),
(555, 'Assets', 'Property, Plant and Equipment', 'Service Concession Tangible Assets', 'Service Concession - Airport Systems', 'Service Concession - Airport Systems', '1061208000', 'Active'),
(556, 'Assets', 'Property, Plant and Equipment', 'Service Concession Tangible Assets', 'Accumulated Depreciation - Service Concession - Airport Systems', 'Accumulated Depreciation - Service Concession - Airport Systems', '1061208100', 'Active'),
(557, 'Assets', 'Property, Plant and Equipment', 'Service Concession Tangible Assets', 'Accumulated Impairment Losses - Service Concession - Airport Systems', 'Accumulated Impairment Losses - Service Concession - Airport Systems', '1061208200', 'Active'),
(558, 'Assets', 'Property, Plant and Equipment', 'Service Concession Tangible Assets', 'Service Concession - Parks, Plazas and Monuments', 'Service Concession - Parks, Plazas and Monuments', '1061209000', 'Active'),
(559, 'Assets', 'Property, Plant and Equipment', 'Service Concession Tangible Assets', 'Accumulated Depreciation - Service Concession - Parks, Plazas and Monuments', 'Accumulated Depreciation - Service Concession - Parks, Plazas and Monuments', '1061209100', 'Active'),
(560, 'Assets', 'Property, Plant and Equipment', 'Service Concession Tangible Assets', 'Accumulated Impairment Losses - Service Concession - Parks, Plazas and Monuments', 'Accumulated Impairment Losses - Service Concession - Parks, Plazas and Monuments', '1061209200', 'Active'),
(561, 'Assets', 'Property, Plant and Equipment', 'Service Concession Tangible Assets', 'Other Service Concession Assets', 'Other Service Concession Assets', '1061299000', 'Active'),
(562, 'Assets', 'Property, Plant and Equipment', 'Service Concession Tangible Assets', 'Accumulated Depreciation - Other Service Concession Assets', 'Accumulated Depreciation - Other Service Concession Assets', '1061299100', 'Active'),
(563, 'Assets', 'Property, Plant and Equipment', 'Service Concession Tangible Assets', 'Accumulated Impairment Losses - Other Service Concession Assets', 'Accumulated Impairment Losses - Other Service Concession Assets', '1061299200', 'Active'),
(564, 'Assets', 'Property, Plant and Equipment', 'Other Property, Plant and Equipment', '', '', '1069900000', ''),
(565, 'Assets', 'Property, Plant and Equipment', 'Other Property, Plant and Equipment', 'Work/Zoo and/or Other Animals', '', '1069901000', ''),
(566, 'Assets', 'Property, Plant and Equipment', 'Other Property, Plant and Equipment', 'Work/Zoo and/or Other Animals', 'Work/Zoo Animals', '1069901000', 'Active'),
(567, 'Assets', 'Property, Plant and Equipment', 'Other Property, Plant and Equipment', 'Accumulated Depreciation - Work/Zoo and/or Other Animals', '', '1069901100', ''),
(568, 'Assets', 'Property, Plant and Equipment', 'Other Property, Plant and Equipment', 'Accumulated Depreciation - Work/Zoo and/or Other Animals', 'Accumulated Depreciation - Work/Zoo Animals', '1069901100', 'Active'),
(569, 'Assets', 'Property, Plant and Equipment', 'Other Property, Plant and Equipment', 'Accumulated Impairment Losses - Work/Zoo and/or Other Animals', '', '1069901200', ''),
(570, 'Assets', 'Property, Plant and Equipment', 'Other Property, Plant and Equipment', 'Accumulated Impairment Losses - Work/Zoo and/or Other Animals', 'Accumulated Impairment Losses - Work/Zoo Animals', '1069901200', 'Active'),
(571, 'Assets', 'Property, Plant and Equipment', 'Other Property, Plant and Equipment', 'Other Property, Plant and Equipment', 'Other Property, Plant and Equipment', '1069999000', 'Active'),
(572, 'Assets', 'Property, Plant and Equipment', 'Other Property, Plant and Equipment', 'Accumulated Depreciation - Other Property, Plant and Equipment', 'Accumulated Depreciation - Other Property, Plant and Equipment', '1069999100', 'Active'),
(573, 'Assets', 'Property, Plant and Equipment', 'Other Property, Plant and Equipment', 'Accumulated Impairment Losses - Other Property, Plant and Equipment', 'Accumulated Impairment Losses - Other Property, Plant and Equipment', '1069999200', 'Active'),
(574, 'Assets', 'Biological Assets', '', '', '', '1070000000', ''),
(575, 'Assets', 'Biological Assets', 'Bearer Biological Assets', '', '', '1070100000', ''),
(576, 'Assets', 'Biological Assets', 'Bearer Biological Assets', 'Breeding Stocks', 'Breeding Stocks', '1070101000', 'Active'),
(577, 'Assets', 'Biological Assets', 'Bearer Biological Assets', 'Accumulated Depreciation - Breeding Stocks', '', '1070101100', ''),
(578, 'Assets', 'Biological Assets', 'Bearer Biological Assets', 'Accumulated Depreciation - Breeding Stocks', 'Accumulated Impairment Losses - Breeding Stocks', '1070101100', 'Active');
INSERT INTO `uacs_codes` (`id`, `classification`, `sub_class`, `group_name`, `object_code`, `sub_object_code`, `uacs`, `status`) VALUES
(579, 'Assets', 'Biological Assets', 'Bearer Biological Assets', 'Livestock', 'Livestock', '1070102000', 'Active'),
(580, 'Assets', 'Biological Assets', 'Bearer Biological Assets', 'Accumulated Depreciation - Livestock', '', '1070102100', ''),
(581, 'Assets', 'Biological Assets', 'Bearer Biological Assets', 'Accumulated Depreciation - Livestock', 'Accumulated Impairment Losses - Livestock', '1070102100', 'Active'),
(582, 'Assets', 'Biological Assets', 'Bearer Biological Assets', 'Trees, Plants and Crops', 'Trees, Plants and Crops', '1070103000', 'Active'),
(583, 'Assets', 'Biological Assets', 'Bearer Biological Assets', 'Accumulated Depreciation - Trees, Plants and Crops', '', '1070103100', ''),
(584, 'Assets', 'Biological Assets', 'Bearer Biological Assets', 'Accumulated Depreciation - Trees, Plants and Crops', 'Accumulated Impairment Losses - Trees, Plants and Crops', '1070103100', 'Active'),
(585, 'Assets', 'Biological Assets', 'Bearer Biological Assets', 'Aquaculture', 'Aquaculture', '1070104000', 'Active'),
(586, 'Assets', 'Biological Assets', 'Bearer Biological Assets', 'Accumulated Depreciation - Aquaculture', '', '1070104100', ''),
(587, 'Assets', 'Biological Assets', 'Bearer Biological Assets', 'Accumulated Depreciation - Aquaculture', 'Accumulated Impairment Losses - Aquaculture', '1070104100', 'Active'),
(588, 'Assets', 'Biological Assets', 'Bearer Biological Assets', 'Other Bearer Biological Assets', 'Other Bearer Biological Assets', '1070199000', 'Active'),
(589, 'Assets', 'Biological Assets', 'Bearer Biological Assets', 'Accumulated Depreciation - Other Bearer Biological Assets', '', '1070199100', ''),
(590, 'Assets', 'Biological Assets', 'Bearer Biological Assets', 'Accumulated Depreciation - Other Bearer Biological Assets', 'Accumulated Impairment Losses - Other Bearer Biological Assets', '1070199100', 'Active'),
(591, 'Assets', 'Biological Assets', 'Consumable Biological Assets', '', '', '1070200000', ''),
(592, 'Assets', 'Biological Assets', 'Consumable Biological Assets', 'Livestock Held for Consumption/Sale/Distribution', 'Livestock Held for Consumption/Sale/Distribution', '1070201000', 'Active'),
(593, 'Assets', 'Biological Assets', 'Consumable Biological Assets', 'Livestock Held for Consumption/Sale/Distribution', '', '1070201000', ''),
(594, 'Assets', 'Biological Assets', 'Consumable Biological Assets', 'Livestock Held for Consumption/Sale/Distribution', 'Livestock Held for Consumption', '1070201001', 'Active'),
(595, 'Assets', 'Biological Assets', 'Consumable Biological Assets', 'Livestock Held for Consumption/Sale/Distribution', 'Livestock Held for Sale', '1070201002', 'Active'),
(596, 'Assets', 'Biological Assets', 'Consumable Biological Assets', 'Livestock Held for Consumption/Sale/Distribution', 'Livestock Held for Distribution', '1070201003', 'Active'),
(597, 'Assets', 'Biological Assets', 'Consumable Biological Assets', 'Accumulated Impairment Losses - Livestock Held for Consumption/Sale/Distribution', 'Accumulated Impairment Losses - Livestock Held for Consumption/Sale/Distribution', '1070201100', 'Active'),
(598, 'Assets', 'Biological Assets', 'Consumable Biological Assets', 'Trees, Plants and Crops Held for Consumption/Sale/Distribution', 'Trees, Plants and Crops Held for Consumption/Sale/Distribution', '1070202000', 'Active'),
(599, 'Assets', 'Biological Assets', 'Consumable Biological Assets', 'Trees, Plants and Crops Held for Consumption/Sale/Distribution', '', '1070202000', ''),
(600, 'Assets', 'Biological Assets', 'Consumable Biological Assets', 'Trees, Plants and Crops Held for Consumption/Sale/Distribution', 'Trees, Plants and Crops Held for Consumption', '1070202001', 'Active'),
(601, 'Assets', 'Biological Assets', 'Consumable Biological Assets', 'Trees, Plants and Crops Held for Consumption/Sale/Distribution', 'Trees, Plants and Crops Held for Sale', '1070202002', 'Active'),
(602, 'Assets', 'Biological Assets', 'Consumable Biological Assets', 'Trees, Plants and Crops Held for Consumption/Sale/Distribution', 'Trees, Plants and Crops Held for Distribution', '1070202003', 'Active'),
(603, 'Assets', 'Biological Assets', 'Consumable Biological Assets', 'Accumulated Impairment Losses - Trees, Plants and Crops Held for Consumption/Sale/Distribution', '', '1070202100', ''),
(604, 'Assets', 'Biological Assets', 'Consumable Biological Assets', 'Accumulated Impairment Losses - Trees, Plants and Crops Held for Consumption/Sale/Distribution', 'Accumulated Impairment Losses - Trees, Plants and Crops Held for Consumption/Sale/ Distribution', '1070202100', 'Active'),
(605, 'Assets', 'Biological Assets', 'Consumable Biological Assets', 'Agricultural Produce Held for Consumption/Sale/Distribution', '', '1070203000', ''),
(606, 'Assets', 'Biological Assets', 'Consumable Biological Assets', 'Agricultural Produce Held for Consumption/Sale/Distribution', 'Agricultural Produce Held for for Consumption/Sale/Distribution', '1070203000', 'Active'),
(607, 'Assets', 'Biological Assets', 'Consumable Biological Assets', 'Accumulated Impairment Losses - Agricultural Produce Held for Consumption/Sale/Distribution', 'Accumulated Impairment Losses - Agricultural Produce Held for Consumption/Sale/Distribution', '1070203100', 'Active'),
(608, 'Assets', 'Biological Assets', 'Consumable Biological Assets', 'Aquaculture', 'Aquaculture', '1070204000', 'Active'),
(609, 'Assets', 'Biological Assets', 'Consumable Biological Assets', 'Accumulated Impairment Losses - Aquaculture', 'Accumulated Impairment Losses - Aquaculture', '1070204100', 'Active'),
(610, 'Assets', 'Biological Assets', 'Consumable Biological Assets', 'Other Consumable Biological Assets', 'Other Consumable Biological Assets', '1070299000', 'Active'),
(611, 'Assets', 'Biological Assets', 'Consumable Biological Assets', 'Accumulated Impairment Losses- Other Consumable Biological Assets', '', '1070299100', ''),
(612, 'Assets', 'Biological Assets', 'Consumable Biological Assets', 'Accumulated Impairment Losses- Other Consumable Biological Assets', 'Accumulated Impairment Losses - Other Consumable Biological Assets', '1070299100', 'Active'),
(613, 'Assets', 'Intangible Assets', '', '', '', '1080000000', ''),
(614, 'Assets', 'Intangible Assets', 'Intangible Assets', '', '', '1080100000', ''),
(615, 'Assets', 'Intangible Assets', 'Intangible Assets', 'Patents', '', '1080101000', ''),
(616, 'Assets', 'Intangible Assets', 'Intangible Assets', 'Patents', 'Patents/Copyrights', '1080101000', 'Active'),
(617, 'Assets', 'Intangible Assets', 'Intangible Assets', 'Accumulated Amortization - Patents', '', '1080101100', ''),
(618, 'Assets', 'Intangible Assets', 'Intangible Assets', 'Accumulated Amortization - Patents', 'Accumulated Amortization - Patents/Copyrights', '1080101100', 'Active'),
(619, 'Assets', 'Intangible Assets', 'Intangible Assets', 'Computer Software', 'Computer Software', '1080102000', 'Active'),
(620, 'Assets', 'Intangible Assets', 'Intangible Assets', 'Accumulated Amortization - Computer Software', 'Accumulated Amortization - Computer Software', '1080102100', 'Active'),
(621, 'Assets', 'Intangible Assets', 'Intangible Assets', 'Other Intangible Assets', 'Other Intangible Assets', '1080199000', 'Active'),
(622, 'Assets', 'Intangible Assets', 'Intangible Assets', 'Accumulated Amortization - Other Intangible Assets', 'Accumulated Amortization - Other Intangible Assets', '1080199100', 'Active'),
(623, 'Assets', 'Other Assets', '', '', '', '1090000000', ''),
(624, 'Assets', 'Other Assets', 'Advances', '', '', '1990100000', ''),
(625, 'Assets', 'Other Assets', 'Advances', 'Advances for Operation Expenses', 'Advances for Operation Expenses', '1990101000', 'Active'),
(626, 'Assets', 'Other Assets', 'Advances', 'Advances for Payroll', 'Advances for Payroll', '1990102000', 'Active'),
(627, 'Assets', 'Other Assets', 'Advances', 'Advances to Special Disbursing Officer', '', '1990103000', ''),
(628, 'Assets', 'Other Assets', 'Advances', 'Advances to Special Disbursing Officer', 'Advances for Special Disbursing Officer', '1990103000', 'Active'),
(629, 'Assets', 'Other Assets', 'Advances', 'Advances to Officers and Employees', 'Advances to Officers and Employees', '1990104000', 'Active'),
(630, 'Assets', 'Other Assets', 'Prepayments', '', '', '1990200000', ''),
(631, 'Assets', 'Other Assets', 'Prepayments', 'Advances to Contractors', 'Advances to Contractors', '1990201000', 'Active'),
(632, 'Assets', 'Other Assets', 'Prepayments', 'Prepaid Rent', 'Prepaid Rent', '1990202000', 'Active'),
(633, 'Assets', 'Other Assets', 'Prepayments', 'Prepaid Registration', 'Prepaid Registration', '1990203000', 'Active'),
(634, 'Assets', 'Other Assets', 'Prepayments', 'Prepaid Interest', 'Prepaid Interest', '1990204000', 'Active'),
(635, 'Assets', 'Other Assets', 'Prepayments', 'Prepaid Insurance', '', '1990205000', ''),
(636, 'Assets', 'Other Assets', 'Prepayments', 'Prepaid Insurance', 'Prepaid Insurance ', '1990205000', 'Active'),
(637, 'Assets', 'Other Assets', 'Prepayments', 'Prepaid Subscription', '', '1990210000', ''),
(638, 'Assets', 'Other Assets', 'Prepayments', 'Prepaid Subscription', 'ICT Software Subscription', '1990210001', 'Active'),
(639, 'Assets', 'Other Assets', 'Prepayments', 'Prepaid Subscription', 'Data Center Service', '1990210002', 'Active'),
(640, 'Assets', 'Other Assets', 'Prepayments', 'Prepaid Subscription', 'Cloud Computing Service', '1990210003', 'Active'),
(641, 'Assets', 'Other Assets', 'Prepayments', 'Prepaid Subscription', 'Library and Other Reading Materials Subscription Expenses', '1990210004', 'Active'),
(642, 'Assets', 'Other Assets', 'Prepayments', 'Prepaid Subscription', 'Other Subscription Expenses', '1990210099', 'Active'),
(643, 'Assets', 'Other Assets', 'Prepayments', 'Other Prepayments', 'Other Prepayments', '1990299000', 'Active'),
(644, 'Assets', 'Other Assets', 'Deposits', '', '', '1990300000', ''),
(645, 'Assets', 'Other Assets', 'Deposits', 'Deposit on Letters of Credit', '', '1990301000', ''),
(646, 'Assets', 'Other Assets', 'Deposits', 'Deposit on Letters of Credit', 'Deposits on Letter of Credit', '1990301000', 'Active'),
(647, 'Assets', 'Other Assets', 'Deposits', 'Guaranty Deposits', 'Guaranty Deposits', '1990302000', 'Active'),
(648, 'Assets', 'Other Assets', 'Deposits', 'Other Deposits', 'Other Deposits', '1990399000', 'Active'),
(649, 'Assets', 'Other Assets', 'Other Assets', '', '', '1999900000', ''),
(650, 'Assets', 'Other Assets', 'Other Assets', 'Acquired Assets', 'Acquired Assets', '1999901000', 'Active'),
(651, 'Assets', 'Other Assets', 'Other Assets', 'Accumulated Impairment Losses - Acquired Assets', 'Accumulated Impairment Losses - Acquired Assets', '1999901100', 'Active'),
(652, 'Assets', 'Other Assets', 'Other Assets', 'Foreclosed Property/Assets', 'Foreclosed Property/Assets', '1999902000', 'Active'),
(653, 'Assets', 'Other Assets', 'Other Assets', 'Accumulated Impairment Losses - Foreclosed Property/Assets', 'Accumulated Impairment Losses - Foreclosed Property/Assets', '1999902100', 'Active'),
(654, 'Assets', 'Other Assets', 'Other Assets', 'Forfeited Property/Assets', 'Forfeited Property/Assets', '1999903000', 'Active'),
(655, 'Assets', 'Other Assets', 'Other Assets', 'Accumulated Impairment Losses - Forfeited Property/Assets', 'Accumulated Impairment Losses - Forfeited Property/Assets', '1999903100', 'Active'),
(656, 'Assets', 'Other Assets', 'Other Assets', 'Confiscated Property/Assets', 'Confiscated Property/Assets', '1999904000', 'Active'),
(657, 'Assets', 'Other Assets', 'Other Assets', 'Accumulated Impairment Losses - Confiscated Property/Assets', 'Accumulated Impairment Losses - Confiscated Property/Assets', '1999904100', 'Active'),
(658, 'Assets', 'Other Assets', 'Other Assets', 'Abandoned/Surrendered Property/Assets', '', '1999905000', ''),
(659, 'Assets', 'Other Assets', 'Other Assets', 'Abandoned/Surrendered Property/Assets', 'Abandoned Property/Assets', '1999905000', 'Active'),
(660, 'Assets', 'Other Assets', 'Other Assets', 'Accumulated Impairment Losses - Abandoned Property Assets', '', '1999905100', ''),
(661, 'Assets', 'Other Assets', 'Other Assets', 'Accumulated Impairment Losses - Abandoned Property Assets', 'Accumulated Impairment Losses - Abandoned Property/Assets', '1999905100', 'Active'),
(662, 'Assets', 'Other Assets', 'Other Assets', 'Other Assets', 'Other Assets', '1999999000', 'Active'),
(663, 'Assets', 'Other Assets', 'Other Assets', 'Accumulated Impairment Losses - Other Assets', 'Accumulated Impairment Losses - Other Assets', '1999999100', 'Active'),
(664, 'Liabilities', '', '', '', '', '2000000000', ''),
(665, 'Liabilities', 'Financial Liabilities', '', '', '', '2010000000', ''),
(666, 'Liabilities', 'Financial Liabilities', 'Payables', '', '', '2010100000', ''),
(667, 'Liabilities', 'Financial Liabilities', 'Payables', 'Accounts Payable', 'Accounts Payable', '2010101000', 'Active'),
(668, 'Liabilities', 'Financial Liabilities', 'Payables', 'Due to Officers and Employees', 'Due to Officers and Employees', '2010102000', 'Active'),
(669, 'Liabilities', 'Financial Liabilities', 'Payables', 'Internal Revenue Allotment Payable', 'Internal Revenue Allotment Payable', '2010103000', 'Active'),
(670, 'Liabilities', 'Financial Liabilities', 'Payables', 'Notes Payable', 'Notes Payable', '2010104000', 'Active'),
(671, 'Liabilities', 'Financial Liabilities', 'Payables', 'Interest Payable', 'Interest Payable', '2010105000', 'Active'),
(672, 'Liabilities', 'Financial Liabilities', 'Payables', 'Operating Lease Payable', 'Operating Lease Payable', '2010106000', 'Active'),
(673, 'Liabilities', 'Financial Liabilities', 'Payables', 'Finance Lease Payable', 'Finance Lease Payable', '2010107000', 'Active'),
(674, 'Liabilities', 'Financial Liabilities', 'Payables', 'Awards and Rewards Payable', 'Awards and Rewards Payable', '2010108000', 'Active'),
(675, 'Liabilities', 'Financial Liabilities', 'Payables', 'Service Concession Arrangements Payable', 'Service Concession Arrangements Payable', '2010109000', 'Active'),
(676, 'Liabilities', 'Financial Liabilities', 'Bills/Bonds/Loans Payable', '', '', '2010200000', ''),
(677, 'Liabilities', 'Financial Liabilities', 'Bills/Bonds/Loans Payable', 'Treasury Bills Payable ', '', '2010201000', ''),
(678, 'Liabilities', 'Financial Liabilities', 'Bills/Bonds/Loans Payable', 'Treasury Bills Payable ', 'Treasury Bills Payable', '2010201000', 'Active'),
(679, 'Liabilities', 'Financial Liabilities', 'Bills/Bonds/Loans Payable', 'Bonds Payable - Domestic', 'Bonds Payable - Domestic', '2010202000', 'Active'),
(680, 'Liabilities', 'Financial Liabilities', 'Bills/Bonds/Loans Payable', 'Discount on Bonds Payable - Domestic', 'Discount on Bonds Payable - Domestic', '2010202100', 'Active'),
(681, 'Liabilities', 'Financial Liabilities', 'Bills/Bonds/Loans Payable', 'Premium on Bonds Payable - Domestic', 'Premium on Bonds Payable - Domestic', '2010202200', 'Active'),
(682, 'Liabilities', 'Financial Liabilities', 'Bills/Bonds/Loans Payable', 'Bonds Payable - Foreign', 'Bonds Payable - Foreign', '2010203000', 'Active'),
(683, 'Liabilities', 'Financial Liabilities', 'Bills/Bonds/Loans Payable', 'Discount on Bonds Payable - Foreign', 'Discount on Bonds Payable - Foreign', '2010203100', 'Active'),
(684, 'Liabilities', 'Financial Liabilities', 'Bills/Bonds/Loans Payable', 'Premium on Bonds Payable - Foreign', 'Premium on Bonds Payable - Foreign', '2010203200', 'Active'),
(685, 'Liabilities', 'Financial Liabilities', 'Bills/Bonds/Loans Payable', 'Loans Payable - Domestic', 'Loans Payable - Domestic', '2010204000', 'Active'),
(686, 'Liabilities', 'Financial Liabilities', 'Bills/Bonds/Loans Payable', 'Loans Payable - Foreign ', '', '2010205000', ''),
(687, 'Liabilities', 'Financial Liabilities', 'Bills/Bonds/Loans Payable', 'Loans Payable - Foreign ', 'Loans Payable - Foreign', '2010205000', 'Active'),
(688, 'Liabilities', 'Inter-Agency Payables', '', '', '', '2020000000', ''),
(689, 'Liabilities', 'Inter-Agency Payables', 'Inter-Agency Payables', '', '', '2020100000', ''),
(690, 'Liabilities', 'Inter-Agency Payables', 'Inter-Agency Payables', 'Due to BIR', 'Due to BIR', '2020101000', 'Active'),
(691, 'Liabilities', 'Inter-Agency Payables', 'Inter-Agency Payables', 'Due to GSIS', '', '2020102000', ''),
(692, 'Liabilities', 'Inter-Agency Payables', 'Inter-Agency Payables', 'Due to GSIS', 'Life and Retirement Premium', '2020102001', 'Active'),
(693, 'Liabilities', 'Inter-Agency Payables', 'Inter-Agency Payables', 'Due to GSIS', 'ECC', '2020102002', 'Active'),
(694, 'Liabilities', 'Inter-Agency Payables', 'Inter-Agency Payables', 'Due to GSIS', 'Salary Loan', '2020102003', 'Active'),
(695, 'Liabilities', 'Inter-Agency Payables', 'Inter-Agency Payables', 'Due to GSIS', 'Policy Loan', '2020102004', 'Active'),
(696, 'Liabilities', 'Inter-Agency Payables', 'Inter-Agency Payables', 'Due to Pag-IBIG', '', '2020103000', ''),
(697, 'Liabilities', 'Inter-Agency Payables', 'Inter-Agency Payables', 'Due to Pag-IBIG', 'Pag-IBIG Premium', '2020103001', 'Active'),
(698, 'Liabilities', 'Inter-Agency Payables', 'Inter-Agency Payables', 'Due to Pag-IBIG', 'Pag-IBIG Multi-Purpose Loan', '2020103002', 'Active'),
(699, 'Liabilities', 'Inter-Agency Payables', 'Inter-Agency Payables', 'Due to Pag-IBIG', 'Pag-IBIG Housing Loan', '2020103003', 'Active'),
(700, 'Liabilities', 'Inter-Agency Payables', 'Inter-Agency Payables', 'Due to PhilHealth', 'Due to PhilHealth', '2020104000', 'Active'),
(701, 'Liabilities', 'Inter-Agency Payables', 'Inter-Agency Payables', 'Due to National Government Agencies', '', '2020105000', ''),
(702, 'Liabilities', 'Inter-Agency Payables', 'Inter-Agency Payables', 'Due to National Government Agencies', 'Due to NGAs', '2020105000', 'Active'),
(703, 'Liabilities', 'Inter-Agency Payables', 'Inter-Agency Payables', 'Due to Government-Owned or Controlled Corporations', '', '2020106000', ''),
(704, 'Liabilities', 'Inter-Agency Payables', 'Inter-Agency Payables', 'Due to Government-Owned or Controlled Corporations', 'Due to GOCCs', '2020106000', 'Active'),
(705, 'Liabilities', 'Inter-Agency Payables', 'Inter-Agency Payables', 'Due to Local Government Units', '', '2020107000', ''),
(706, 'Liabilities', 'Inter-Agency Payables', 'Inter-Agency Payables', 'Due to Local Government Units', 'Due to LGUs', '2020107000', 'Active'),
(707, 'Liabilities', 'Inter-Agency Payables', 'Inter-Agency Payables', 'Due to Joint Venture', 'Due to Joint Venture', '2020108000', 'Active'),
(708, 'Liabilities', 'Intra-Agency Payables', '', '', '', '2030000000', ''),
(709, 'Liabilities', 'Intra-Agency Payables', 'Intra-Agency Payables', '', '', '2030100000', ''),
(710, 'Liabilities', 'Intra-Agency Payables', 'Intra-Agency Payables', 'Due to Central Office', 'Due to Central Office', '2030101000', 'Active'),
(711, 'Liabilities', 'Intra-Agency Payables', 'Intra-Agency Payables', 'Due to Bureaus', 'Due to Bureaus', '2030102000', 'Active'),
(712, 'Liabilities', 'Intra-Agency Payables', 'Intra-Agency Payables', 'Due to Regional Offices', 'Due to Regional Offices', '2030103000', 'Active'),
(713, 'Liabilities', 'Intra-Agency Payables', 'Intra-Agency Payables', 'Due to Operating Units', 'Due to Operating Units', '2030104000', 'Active'),
(714, 'Liabilities', 'Intra-Agency Payables', 'Intra-Agency Payables', 'Due to Other Funds', 'Due to Other Funds', '2030105000', 'Active'),
(715, 'Liabilities', 'Trust Liabilities', 'Trust Liabilities', 'Trust Liabilities', 'Trust Liabilities', '2040101000', 'Active'),
(716, 'Liabilities', 'Trust Liabilities', 'Trust Liabilities', 'Trust Liabilities', 'Trust Liabilities', '2040101001', 'Active'),
(717, 'Liabilities', 'Trust Liabilities', '', '', '', '2040000000', ''),
(718, 'Liabilities', 'Trust Liabilities', 'Trust Liabilities', '', '', '2040100000', ''),
(719, 'Liabilities', 'Trust Liabilities', 'Trust Liabilities', 'Trust Liabilities', '', '2040101000', ''),
(720, 'Liabilities', 'Trust Liabilities', 'Trust Liabilities', 'Trust Liabilities', 'Trust Liabilities - Fuel Marking Trust Account', '2040101002', 'Active'),
(721, 'Liabilities', 'Trust Liabilities', 'Trust Liabilities', 'Trust Liabilities - Disaster Risk Reduction And Management Fund', '', '2040102000', ''),
(722, 'Liabilities', 'Trust Liabilities', 'Trust Liabilities', 'Trust Liabilities - Disaster Risk Reduction And Management Fund', 'Trust Liabilities - Disaster Risk Reduction and Management Fund ', '2040102000', 'Active'),
(723, 'Liabilities', 'Trust Liabilities', 'Trust Liabilities', 'Bail Bonds Payable ', '', '2040103000', ''),
(724, 'Liabilities', 'Trust Liabilities', 'Trust Liabilities', 'Bail Bonds Payable ', 'Bail Bonds Payable', '2040103000', 'Active'),
(725, 'Liabilities', 'Trust Liabilities', 'Trust Liabilities', 'Guaranty/Security Deposits Payable', 'Guaranty/Security Deposits Payable', '2040104000', 'Active'),
(726, 'Liabilities', 'Trust Liabilities', 'Trust Liabilities', 'Customers\' Deposits Payable', 'Customers\' Deposits Payable', '2040105000', 'Active'),
(727, 'Liabilities', 'Deffered Credits/Unearned Income', '', '', '', '2050000000', ''),
(728, 'Liabilities', 'Deffered Credits/Unearned Income', 'Deferred Credits', '', '', '2050100000', ''),
(729, 'Liabilities', 'Deffered Credits/Unearned Income', 'Deferred Credits', 'Deferred Finance Lease Revenue', 'Deferred Finance Lease Revenue', '2050101000', 'Active'),
(730, 'Liabilities', 'Deffered Credits/Unearned Income', 'Deferred Credits', 'Deferred Service Concession Revenue', 'Deferred Service Concession Revenue', '2050102000', 'Active'),
(731, 'Liabilities', 'Deffered Credits/Unearned Income', 'Deferred Credits', 'Other Deferred Credits', 'Other Deferred Credits', '2050199000', 'Active'),
(732, 'Liabilities', 'Deffered Credits/Unearned Income', 'Unearned Revenue', '', '', '2050200000', ''),
(733, 'Liabilities', 'Deffered Credits/Unearned Income', 'Unearned Revenue', 'Unearned Revenue - Investment Property', 'Unearned Revenue - Investment Property', '2050201000', 'Active'),
(734, 'Liabilities', 'Deffered Credits/Unearned Income', 'Unearned Revenue', 'Other Unearned Revenue', 'Other Unearned Revenue', '2050299000', 'Active'),
(735, 'Liabilities', 'Provisions', '', '', '', '2060000000', ''),
(736, 'Liabilities', 'Provisions', 'Provisions', '', '', '2060100000', ''),
(737, 'Liabilities', 'Provisions', 'Provisions', 'Pension Benefits Payable', 'Pension Benefits Payable', '2060101000', 'Active'),
(738, 'Liabilities', 'Provisions', 'Provisions', 'Leave Benefits Payable', 'Leave Benefits Payable', '2060102000', 'Active'),
(739, 'Liabilities', 'Provisions', 'Provisions', 'Retirement Gratuity Payable', 'Retirement Gratuity Payable', '2060103000', 'Active'),
(740, 'Liabilities', 'Provisions', 'Provisions', 'Other Provisions', 'Other Provisions', '2060199000', 'Active'),
(741, 'Liabilities', 'Other Payables', 'Other Payables', 'Other Payables', 'Other Payables', '2999999000', 'Active'),
(742, 'Equity', '', '', '', '', '3000000000', ''),
(743, 'Equity', 'Government Equity', 'Government Equity', 'Accumulated Surplus/(Deficit)', '', '3010101000', ''),
(744, 'Equity', 'Government Equity', 'Government Equity', 'Accumulated Surplus/(Deficit)', 'Government Equity', '3010101000', 'Active'),
(745, 'Equity', 'Government Equity', '', '', '', '3010000000', ''),
(746, 'Equity', 'Government Equity', 'Government Equity', '', '', '3010100000', ''),
(747, 'Equity', 'Government Equity', 'Government Equity', 'Contributed Capital', 'Contributed Capital', '3010103000', 'Active'),
(748, 'Equity', 'Revaluation Surplus', 'Revaluation Surplus', 'Revaluation Surplus', 'Revaluation Surplus', '3020101000', 'Active'),
(749, 'Equity', 'Intermediate Accounts', '', '', '', '3030000000', ''),
(750, 'Equity', 'Intermediate Accounts', 'Intermediate Accounts', '', '', '3030100000', ''),
(751, 'Equity', 'Intermediate Accounts', 'Intermediate Accounts', 'Revenue and Expense Summary', '', '3030101000', ''),
(752, 'Equity', 'Intermediate Accounts', 'Intermediate Accounts', 'Revenue and Expense Summary', 'Income and Expense Summary', '3030101000', 'Active'),
(753, 'Equity', 'Equity in Joint Venture', 'Equity in Joint Venture', 'Equity in Joint Venture', 'Equity in Joint Venture', '3040101000', 'Active'),
(754, 'Revenue/Income', '', '', '', '', '4000000000', ''),
(755, 'Revenue/Income', 'Tax Revenue', '', '', '', '4010000000', ''),
(756, 'Revenue/Income', 'Tax Revenue', 'Tax Revenue - Individual and Corporation', '', '', '4010100000', ''),
(757, 'Revenue/Income', 'Tax Revenue', 'Tax Revenue - Individual and Corporation', 'Income Tax', '', '4010101000', ''),
(758, 'Revenue/Income', 'Tax Revenue', 'Tax Revenue - Individual and Corporation', 'Income Tax', 'Income Tax - Individual', '4010101001', 'Active'),
(759, 'Revenue/Income', 'Tax Revenue', 'Tax Revenue - Individual and Corporation', 'Income Tax', 'Income Tax - Partnerships', '4010101002', 'Active'),
(760, 'Revenue/Income', 'Tax Revenue', 'Tax Revenue - Individual and Corporation', 'Income Tax', 'Income Tax - Corporations', '4010101003', 'Active'),
(761, 'Revenue/Income', 'Tax Revenue', 'Tax Revenue - Individual and Corporation', 'Professional Tax', 'Professional Tax', '4010102000', 'Active'),
(762, 'Revenue/Income', 'Tax Revenue', 'Tax Revenue - Individual and Corporation', 'Travel Tax', 'Travel Tax', '4010103000', 'Active'),
(763, 'Revenue/Income', 'Tax Revenue', 'Tax Revenue - Individual and Corporation', 'Immigration Tax', 'Immigration Tax', '4010104000', 'Active'),
(764, 'Revenue/Income', 'Tax Revenue', 'Tax Revenue - Property', '', '', '4010200000', ''),
(765, 'Revenue/Income', 'Tax Revenue', 'Tax Revenue - Property', 'Estate Tax', 'Estate Tax', '4010201000', 'Active'),
(766, 'Revenue/Income', 'Tax Revenue', 'Tax Revenue - Property', 'Donors Tax', 'Donors Tax', '4010202000', 'Active'),
(767, 'Revenue/Income', 'Tax Revenue', 'Tax Revenue - Property', 'Capital Gains Tax', '', '4010203000', ''),
(768, 'Revenue/Income', 'Tax Revenue', 'Tax Revenue - Property', 'Capital Gains Tax', 'Capital Gains Tax - Individuals', '4010203001', 'Active'),
(769, 'Revenue/Income', 'Tax Revenue', 'Tax Revenue - Property', 'Capital Gains Tax', 'Capital Gains Tax - Corporations and Other Enterprises', '4010203002', 'Active'),
(770, 'Revenue/Income', 'Tax Revenue', 'Tax Revenue - Goods and Services', '', '', '4010300000', ''),
(771, 'Revenue/Income', 'Tax Revenue', 'Tax Revenue - Goods and Services', 'Import Duties', '', '4010301000', ''),
(772, 'Revenue/Income', 'Tax Revenue', 'Tax Revenue - Goods and Services', 'Import Duties', 'Live Animals, Animals Products', '4010301001', 'Active'),
(773, 'Revenue/Income', 'Tax Revenue', 'Tax Revenue - Goods and Services', 'Import Duties', 'Vegetable Products', '4010301002', 'Active'),
(774, 'Revenue/Income', 'Tax Revenue', 'Tax Revenue - Goods and Services', 'Import Duties', 'Animal or Vegetable Fats and Oils and their Cleavage Products; Prepared Edible Fats; Animal or Vegetable Waxes', '4010301003', 'Active'),
(775, 'Revenue/Income', 'Tax Revenue', 'Tax Revenue - Goods and Services', 'Import Duties', 'Prepared Foodstuffs; Beverages, Spirits and Vinegar; Tobacco and Manufactured Tobacco Substitutes', '4010301004', 'Active'),
(776, 'Revenue/Income', 'Tax Revenue', 'Tax Revenue - Goods and Services', 'Import Duties', 'Mineral Products', '4010301005', 'Active'),
(777, 'Revenue/Income', 'Tax Revenue', 'Tax Revenue - Goods and Services', 'Import Duties', 'Products of the Chemical or Allied Industries', '4010301006', 'Active'),
(778, 'Revenue/Income', 'Tax Revenue', 'Tax Revenue - Goods and Services', 'Import Duties', 'Plastics and Articles Thereof; Rubber and Articles Thereof', '4010301007', 'Active'),
(779, 'Revenue/Income', 'Tax Revenue', 'Tax Revenue - Goods and Services', 'Import Duties', 'Raw Hides and Skins, Leather, Furskins and Articles Thereof; Saddlery and Harness; Travel Goods, Handbags and Similar Containers; Articles of Animal Gut (Other than Silk-Worm Gut)', '4010301008', 'Active'),
(780, 'Revenue/Income', 'Tax Revenue', 'Tax Revenue - Goods and Services', 'Import Duties', 'Wood and Articles of Wood; Wood Charcoal; Cork and Articles of Cork; Manufactures of Straw, or of Esparto or of other Plaiting Materials; Basketware and Wickerwork', '4010301009', 'Active'),
(781, 'Revenue/Income', 'Tax Revenue', 'Tax Revenue - Goods and Services', 'Import Duties', 'Pulp of Wood or of other Fibrous Cellulosic Material; Recovered (Waste and Scrap) Paper or Paperboard; Paper and Paperboard and Articles Thereof', '4010301010', 'Active'),
(782, 'Revenue/Income', 'Tax Revenue', 'Tax Revenue - Goods and Services', 'Import Duties', 'Textiles and Textile Articles', '4010301011', 'Active'),
(783, 'Revenue/Income', 'Tax Revenue', 'Tax Revenue - Goods and Services', 'Import Duties', 'Footwear, Headgear, Umbrellas, Sun Umbrellas, Walking-Sticks, Seat-Sticks, Whips, Riding-Crops and Parts Thereof; Prepared Feathers and Articles made Therewith; Artificial Flowers; Articles of Human Hair', '4010301012', 'Active'),
(784, 'Revenue/Income', 'Tax Revenue', 'Tax Revenue - Goods and Services', 'Import Duties', 'Articles of Stone, Plaster, Cement, Asbestos, Mica or Similar Materials; Ceramic Products; Glass and Glassware', '4010301013', 'Active'),
(785, 'Revenue/Income', 'Tax Revenue', 'Tax Revenue - Goods and Services', 'Import Duties', 'Natural or Cultured Pearls, Precious or Semi-Precious Stones, Precious Metals, Metals Clad with Precious Metal, and Articles Thereof; Imitation Jewellery; Coin', '4010301014', 'Active'),
(786, 'Revenue/Income', 'Tax Revenue', 'Tax Revenue - Goods and Services', 'Import Duties', 'Base Metals and Articles of Base Metal', '4010301015', 'Active'),
(787, 'Revenue/Income', 'Tax Revenue', 'Tax Revenue - Goods and Services', 'Import Duties', 'Machinery and Mechanical Appliances; Electrical Equipment; Parts Thereof; Sound Recorders and Reproducers, Television Image and Sound Recorders and Reproducers, and Parts and Accesories of Such Articles', '4010301016', 'Active'),
(788, 'Revenue/Income', 'Tax Revenue', 'Tax Revenue - Goods and Services', 'Import Duties', 'Vehicles, Aircraft, Vessels And Associated Transport Equipment', '4010301017', 'Active'),
(789, 'Revenue/Income', 'Tax Revenue', 'Tax Revenue - Goods and Services', 'Import Duties', 'Optical, Photographic, Cinematographic, Measuring, Checking, Precision, Medical or Surgical Instruments and Apparatus; Clocks and Watches; Musical Instruments; Parts and Accessories Thereof', '4010301018', 'Active'),
(790, 'Revenue/Income', 'Tax Revenue', 'Tax Revenue - Goods and Services', 'Import Duties', 'Arms and Ammunition; Parts and Accessories Thereof', '4010301019', 'Active'),
(791, 'Revenue/Income', 'Tax Revenue', 'Tax Revenue - Goods and Services', 'Import Duties', 'Miscellaneous Manufactured Articles', '4010301020', 'Active'),
(792, 'Revenue/Income', 'Tax Revenue', 'Tax Revenue - Goods and Services', 'Import Duties', 'Works of Arts, Collectors\' Pieces And Antiques', '4010301021', 'Active'),
(793, 'Revenue/Income', 'Tax Revenue', 'Tax Revenue - Goods and Services', 'Import Duties', 'Rice Tariff Revenue', '4010301022', 'Active'),
(794, 'Revenue/Income', 'Tax Revenue', 'Tax Revenue - Goods and Services', 'Import Duties', 'Other Import Duties', '4010301099', 'Active'),
(795, 'Revenue/Income', 'Tax Revenue', 'Tax Revenue - Goods and Services', 'Excise Tax', '', '4010302000', ''),
(796, 'Revenue/Income', 'Tax Revenue', 'Tax Revenue - Goods and Services', 'Excise Tax', 'Excise - Tobacco Products', '4010302001', 'Active'),
(797, 'Revenue/Income', 'Tax Revenue', 'Tax Revenue - Goods and Services', 'Excise Tax', 'Excise - Alcoholic Beverages', '4010302002', 'Active'),
(798, 'Revenue/Income', 'Tax Revenue', 'Tax Revenue - Goods and Services', 'Excise Tax', 'Excise - Mining - Non-Metallic Products', '4010302003', 'Active'),
(799, 'Revenue/Income', 'Tax Revenue', 'Tax Revenue - Goods and Services', 'Excise Tax', 'Excise - Mining - Metallic Products', '4010302004', 'Active'),
(800, 'Revenue/Income', 'Tax Revenue', 'Tax Revenue - Goods and Services', 'Excise Tax', 'Excise - Petroleum Products', '4010302005', 'Active'),
(801, 'Revenue/Income', 'Tax Revenue', 'Tax Revenue - Goods and Services', 'Excise Tax', 'Excise - Motor Vehicles', '4010302006', 'Active'),
(802, 'Revenue/Income', 'Tax Revenue', 'Tax Revenue - Goods and Services', 'Excise Tax', 'Excise - Mineral Products', '4010302007', 'Active'),
(803, 'Revenue/Income', 'Tax Revenue', 'Tax Revenue - Goods and Services', 'Excise Tax', 'Excise - Others', '4010302099', 'Active'),
(804, 'Revenue/Income', 'Tax Revenue', 'Tax Revenue - Goods and Services', 'Business Tax', '', '4010303000', ''),
(805, 'Revenue/Income', 'Tax Revenue', 'Tax Revenue - Goods and Services', 'Business Tax', 'Value Added Tax', '4010303001', 'Active'),
(806, 'Revenue/Income', 'Tax Revenue', 'Tax Revenue - Goods and Services', 'Business Tax', 'Expanded Value Added Tax', '4010303002', 'Active'),
(807, 'Revenue/Income', 'Tax Revenue', 'Tax Revenue - Goods and Services', 'Business Tax', 'Percentage Tax', '4010303003', 'Active'),
(808, 'Revenue/Income', 'Tax Revenue', 'Tax Revenue - Goods and Services', 'Tax on Sand, Gravel and Other Quarry Products', '', '4010304000', ''),
(809, 'Revenue/Income', 'Tax Revenue', 'Tax Revenue - Goods and Services', 'Tax on Sand, Gravel and Other Quarry Products', 'Tax on Sand, Gravel and Other Quarry products', '4010304000', 'Active'),
(810, 'Revenue/Income', 'Tax Revenue', 'Tax Revenue - Goods and Services', 'Tax on Delivery Vans and Trucks', 'Tax on Delivery Vans and Trucks', '4010305000', 'Active'),
(811, 'Revenue/Income', 'Tax Revenue', 'Tax Revenue - Goods and Services', 'Tax on Forest Products', 'Tax on Forest Products', '4010306000', 'Active'),
(812, 'Revenue/Income', 'Tax Revenue', 'Tax Revenue - Others', '', '', '4010400000', ''),
(813, 'Revenue/Income', 'Tax Revenue', 'Tax Revenue - Others', 'Documentary Stamp Tax', 'Documentary Stamp Tax', '4010401000', 'Active'),
(814, 'Revenue/Income', 'Tax Revenue', 'Tax Revenue - Others', 'Motor Vehicles Users\' Charge ', '', '4010402000', ''),
(815, 'Revenue/Income', 'Tax Revenue', 'Tax Revenue - Others', 'Motor Vehicles Users\' Charge ', 'MVUC Proper', '4010402001', 'Active'),
(816, 'Revenue/Income', 'Tax Revenue', 'Tax Revenue - Others', 'Motor Vehicles Users\' Charge ', 'MVUC Fines and Penalties', '4010402002', 'Active'),
(817, 'Revenue/Income', 'Tax Revenue', 'Tax Revenue - Others', 'Motor Vehicles Users\' Charge ', 'Axle Overloading', '4010402003', 'Active'),
(818, 'Revenue/Income', 'Tax Revenue', 'Tax Revenue - Others', 'Other Taxes', 'Other Taxes', '4010499000', 'Active'),
(819, 'Revenue/Income', 'Tax Revenue', 'Tax Revenue - Others', 'Other Taxes', '', '4010499000', ''),
(820, 'Revenue/Income', 'Tax Revenue', 'Tax Revenue - Others', 'Other Taxes', 'Other Taxes - Business', '4010499001', 'Active'),
(821, 'Revenue/Income', 'Tax Revenue', 'Tax Revenue - Others', 'Other Taxes', 'Other Taxes - Other than Business', '4010499002', 'Active'),
(822, 'Revenue/Income', 'Tax Revenue', 'Tax Revenue - Fines and Penalties', '', '', '4010500000', ''),
(823, 'Revenue/Income', 'Tax Revenue', 'Tax Revenue - Fines and Penalties', 'Tax Revenue - Fines and Penalties - Taxes on Individual and Corporation', 'Tax Revenue - Fines and Penalties - Taxes on Individual and Corporation', '4010501000', 'Active'),
(824, 'Revenue/Income', 'Tax Revenue', 'Tax Revenue - Fines and Penalties', 'Tax Revenue - Fines and Penalties - Property Taxes', 'Tax Revenue - Fines and Penalties - Property Taxes', '4010502000', 'Active'),
(825, 'Revenue/Income', 'Tax Revenue', 'Tax Revenue - Fines and Penalties', 'Tax Revenue - Fines and Penalties - Taxes on Goods and Services', 'Tax Revenue - Fines and Penalties - Taxes on Goods and Services', '4010503000', 'Active'),
(826, 'Revenue/Income', 'Tax Revenue', 'Tax Revenue - Fines and Penalties', 'Tax Revenue - Fines and Penalties - Other Taxes', 'Tax Revenue - Fines and Penalties - Other Taxes', '4010504000', 'Active'),
(827, 'Revenue/Income', 'Service and Business Income', '', '', '', '4020000000', ''),
(828, 'Revenue/Income', 'Service and Business Income', 'Service Income', '', '', '4020100000', ''),
(829, 'Revenue/Income', 'Service and Business Income', 'Service Income', 'Permit Fees', '', '4020101000', ''),
(830, 'Revenue/Income', 'Service and Business Income', 'Service Income', 'Permit Fees', 'Permit Fees Import', '4020101001', 'Active'),
(831, 'Revenue/Income', 'Service and Business Income', 'Service Income', 'Permit Fees', 'Permit Fees Export', '4020101002', 'Active'),
(832, 'Revenue/Income', 'Service and Business Income', 'Service Income', 'Permit Fees', 'Other Permit Fees', '4020101099', 'Active'),
(833, 'Revenue/Income', 'Service and Business Income', 'Service Income', 'Registration Fees', 'Registration Fees', '4020102000', 'Active'),
(834, 'Revenue/Income', 'Service and Business Income', 'Service Income', 'Registration Plates, Tags and Stickers Fees', '', '4020103000', ''),
(835, 'Revenue/Income', 'Service and Business Income', 'Service Income', 'Registration Plates, Tags and Stickers Fees', 'Regular Plates', '4020103001', 'Active'),
(836, 'Revenue/Income', 'Service and Business Income', 'Service Income', 'Registration Plates, Tags and Stickers Fees', 'Optional Motor Vehicle Special Plate', '4020103002', 'Active'),
(837, 'Revenue/Income', 'Service and Business Income', 'Service Income', 'Registration Plates, Tags and Stickers Fees', 'Vanity Licensed Plates', '4020103003', 'Active'),
(838, 'Revenue/Income', 'Service and Business Income', 'Service Income', 'Registration Plates, Tags and Stickers Fees', 'Validating Tags/Stickers', '4020103004', 'Active'),
(839, 'Revenue/Income', 'Service and Business Income', 'Service Income', 'Clearance and Certification Fees', '', '4020104000', ''),
(840, 'Revenue/Income', 'Service and Business Income', 'Service Income', 'Clearance and Certification Fees', 'Clearance Fees', '4020104001', 'Active'),
(841, 'Revenue/Income', 'Service and Business Income', 'Service Income', 'Clearance and Certification Fees', 'Certification Fees', '4020104002', 'Active'),
(842, 'Revenue/Income', 'Service and Business Income', 'Service Income', 'Clearance and Certification Fees', 'Endorsement Fees', '4020104003', 'Active'),
(843, 'Revenue/Income', 'Service and Business Income', 'Service Income', 'Clearance and Certification Fees', 'Identification of Specimens', '4020104004', 'Active'),
(844, 'Revenue/Income', 'Service and Business Income', 'Service Income', 'Franchising Fees', 'Franchising Fees', '4020105000', 'Active'),
(845, 'Revenue/Income', 'Service and Business Income', 'Service Income', 'Licensing Fees', 'Licensing Fees', '4020106000', 'Active'),
(846, 'Revenue/Income', 'Service and Business Income', 'Service Income', 'Supervision and Regulation Enforcement Fees', 'Supervision and Regulation Enforcement Fees', '4020107000', 'Active'),
(847, 'Revenue/Income', 'Service and Business Income', 'Service Income', 'Spectrum Usage Fees', 'Spectrum Usage Fees', '4020108000', 'Active'),
(848, 'Revenue/Income', 'Service and Business Income', 'Service Income', 'Legal Fees', 'Legal Fees', '4020109000', 'Active'),
(849, 'Revenue/Income', 'Service and Business Income', 'Service Income', 'Inspection Fees', 'Inspection Fees', '4020110000', 'Active'),
(850, 'Revenue/Income', 'Service and Business Income', 'Service Income', 'Verification and Authentication Fees', '', '4020111000', ''),
(851, 'Revenue/Income', 'Service and Business Income', 'Service Income', 'Verification and Authentication Fees', 'Accreditation Fees', '4020111001', 'Active'),
(852, 'Revenue/Income', 'Service and Business Income', 'Service Income', 'Verification and Authentication Fees', 'Weights and Measures Fees', '4020111002', 'Active'),
(853, 'Revenue/Income', 'Service and Business Income', 'Service Income', 'Verification and Authentication Fees', 'Other Verification and Authentication Fees', '4020111099', 'Active'),
(854, 'Revenue/Income', 'Service and Business Income', 'Service Income', 'Passport and Visa Fees', '', '4020112000', ''),
(855, 'Revenue/Income', 'Service and Business Income', 'Service Income', 'Passport and Visa Fees', 'Passport Fees', '4020112001', 'Active'),
(856, 'Revenue/Income', 'Service and Business Income', 'Service Income', 'Passport and Visa Fees', 'Visa Fees', '4020112002', 'Active'),
(857, 'Revenue/Income', 'Service and Business Income', 'Service Income', 'Processing Fees', '', '4020113000', ''),
(858, 'Revenue/Income', 'Service and Business Income', 'Service Income', 'Processing Fees', 'Analysis Fees', '4020113001', 'Active'),
(859, 'Revenue/Income', 'Service and Business Income', 'Service Income', 'Processing Fees', 'Appeal Fees', '4020113002', 'Active'),
(860, 'Revenue/Income', 'Service and Business Income', 'Service Income', 'Processing Fees', 'Application Fees', '4020113003', 'Active'),
(861, 'Revenue/Income', 'Service and Business Income', 'Service Income', 'Processing Fees', 'Assessment Fees', '4020113004', 'Active'),
(862, 'Revenue/Income', 'Service and Business Income', 'Service Income', 'Processing Fees', 'Execution Fees', '4020113005', 'Active'),
(863, 'Revenue/Income', 'Service and Business Income', 'Service Income', 'Processing Fees', 'Express Lane or Special Lane Fees', '4020113006', 'Active'),
(864, 'Revenue/Income', 'Service and Business Income', 'Service Income', 'Processing Fees', 'Filing Fees', '4020113007', 'Active'),
(865, 'Revenue/Income', 'Service and Business Income', 'Service Income', 'Processing Fees', 'Identity Card Fees', '4020113008', 'Active'),
(866, 'Revenue/Income', 'Service and Business Income', 'Service Income', 'Processing Fees', 'Import Processing Fees', '4020113009', 'Active'),
(867, 'Revenue/Income', 'Service and Business Income', 'Service Income', 'Processing Fees', 'Oathtaking Fees', '4020113010', 'Active'),
(868, 'Revenue/Income', 'Service and Business Income', 'Service Income', 'Processing Fees', 'Review Fees', '4020113011', 'Active'),
(869, 'Revenue/Income', 'Service and Business Income', 'Service Income', 'Processing Fees', 'Testing Fees', '4020113012', 'Active'),
(870, 'Revenue/Income', 'Service and Business Income', 'Service Income', 'Processing Fees', 'Other Processing Fees', '4020113099', 'Active'),
(871, 'Revenue/Income', 'Service and Business Income', 'Service Income', 'Fines and Penalties - Service Income', 'Fines and Penalties - Service Income', '4020114000', 'Active'),
(872, 'Revenue/Income', 'Service and Business Income', 'Service Income', 'Other Service Income', '', '4020199000', ''),
(873, 'Revenue/Income', 'Service and Business Income', 'Service Income', 'Other Service Income', 'Amendment Fees', '4020199001', 'Active'),
(874, 'Revenue/Income', 'Service and Business Income', 'Service Income', 'Other Service Income', 'Calibration Fees', '4020199002', 'Active'),
(875, 'Revenue/Income', 'Service and Business Income', 'Service Income', 'Other Service Income', 'Escheat Fees of Unclaimed Balances', '4020199003', 'Active'),
(876, 'Revenue/Income', 'Service and Business Income', 'Service Income', 'Other Service Income', 'Service Fees on Relent Loan', '4020199004', 'Active'),
(877, 'Revenue/Income', 'Service and Business Income', 'Service Income', 'Other Service Income', 'Technology Development Transfer and Commercialization', '4020199005', 'Active'),
(878, 'Revenue/Income', 'Service and Business Income', 'Service Income', 'Other Service Income', 'Other Geological and Energy Data', '4020199006', 'Active'),
(879, 'Revenue/Income', 'Service and Business Income', 'Service Income', 'Other Service Income', 'Other Service Income', '4020199099', 'Active'),
(880, 'Revenue/Income', 'Service and Business Income', 'Business Income', '', '', '4020200000', ''),
(881, 'Revenue/Income', 'Service and Business Income', 'Business Income', 'School Fees', '', '4020201000', ''),
(882, 'Revenue/Income', 'Service and Business Income', 'Business Income', 'School Fees', 'Tuition Fees', '4020201001', 'Active'),
(883, 'Revenue/Income', 'Service and Business Income', 'Business Income', 'School Fees', 'Income Collected from Students', '4020201002', 'Active'),
(884, 'Revenue/Income', 'Service and Business Income', 'Business Income', 'School Fees', 'Income from Other Sources', '4020201003', 'Active'),
(885, 'Revenue/Income', 'Service and Business Income', 'Business Income', 'School Fees', 'Other School Fees', '4020201099', 'Active'),
(886, 'Revenue/Income', 'Service and Business Income', 'Business Income', 'Affiliation Fees', 'Affiliation Fees', '4020202000', 'Active'),
(887, 'Revenue/Income', 'Service and Business Income', 'Business Income', 'Examination Fees', 'Examination Fees', '4020203000', 'Active'),
(888, 'Revenue/Income', 'Service and Business Income', 'Business Income', 'Seminar/Training Fees', 'Seminar/Training Fees', '4020204000', 'Active'),
(889, 'Revenue/Income', 'Service and Business Income', 'Business Income', 'Rent/Lease Income', 'Rent/Lease Income', '4020205000', 'Active'),
(890, 'Revenue/Income', 'Service and Business Income', 'Business Income', 'Communication Network Fees', 'Communication Network Fees', '4020206000', 'Active'),
(891, 'Revenue/Income', 'Service and Business Income', 'Business Income', 'Transportation System Fees', 'Transportation System Fees', '4020207000', 'Active'),
(892, 'Revenue/Income', 'Service and Business Income', 'Business Income', 'Road Network Fees', 'Road Network Fees', '4020208000', 'Active'),
(893, 'Revenue/Income', 'Service and Business Income', 'Business Income', 'Waterworks System Fees', 'Waterworks System Fees', '4020209000', 'Active'),
(894, 'Revenue/Income', 'Service and Business Income', 'Business Income', 'Power Supply System Fees', 'Power Supply System Fees', '4020210000', 'Active'),
(895, 'Revenue/Income', 'Service and Business Income', 'Business Income', 'Seaport System Fees', 'Seaport System Fees', '4020211000', 'Active'),
(896, 'Revenue/Income', 'Service and Business Income', 'Business Income', 'Landing and Parking Fees', 'Landing and Parking Fees', '4020212000', 'Active'),
(897, 'Revenue/Income', 'Service and Business Income', 'Business Income', 'Income from Hostels/Dormitories and Other Like Facilities', '', '4020213000', ''),
(898, 'Revenue/Income', 'Service and Business Income', 'Business Income', 'Income from Hostels/Dormitories and Other Like Facilities', 'Income from Hostels/Dormitories and other Like facilities', '4020213000', 'Active'),
(899, 'Revenue/Income', 'Service and Business Income', 'Business Income', 'Slaughterhouse Operation', 'Slaughterhouse Operation', '4020214000', 'Active'),
(900, 'Revenue/Income', 'Service and Business Income', 'Business Income', 'Income from Printing and Publication', 'Income from Printing and Publication', '4020215000', 'Active'),
(901, 'Revenue/Income', 'Service and Business Income', 'Business Income', 'Sales Revenue', '', '4020216000', ''),
(902, 'Revenue/Income', 'Service and Business Income', 'Business Income', 'Sales Revenue', 'Book Sales', '4020216001', 'Active'),
(903, 'Revenue/Income', 'Service and Business Income', 'Business Income', 'Sales Revenue', 'Consultancy Fees', '4020216002', 'Active'),
(904, 'Revenue/Income', 'Service and Business Income', 'Business Income', 'Sales Revenue', 'Entrance Fees', '4020216003', 'Active'),
(905, 'Revenue/Income', 'Service and Business Income', 'Business Income', 'Sales Revenue', 'Film Showing Fees', '4020216004', 'Active'),
(906, 'Revenue/Income', 'Service and Business Income', 'Business Income', 'Sales Revenue', 'Sales of Accountable Forms', '4020216005', 'Active'),
(907, 'Revenue/Income', 'Service and Business Income', 'Business Income', 'Sales Revenue', 'Sale of Animals, Meat and Dairy', '4020216006', 'Active'),
(908, 'Revenue/Income', 'Service and Business Income', 'Business Income', 'Sales Revenue', 'Sale of Technology thru Payback', '4020216007', 'Active'),
(909, 'Revenue/Income', 'Service and Business Income', 'Business Income', 'Sales Revenue', 'Sale of Training Manuals', '4020216008', 'Active'),
(910, 'Revenue/Income', 'Service and Business Income', 'Business Income', 'Sales Revenue', 'Sale of Drugs, Medicines and Other Medical Supplies', '4020216009', 'Active'),
(911, 'Revenue/Income', 'Service and Business Income', 'Business Income', 'Sales Revenue', 'Other Sales', '4020216099', 'Active'),
(912, 'Revenue/Income', 'Service and Business Income', 'Business Income', 'Sales Discounts', 'Sales Discounts', '4020216100', 'Active'),
(913, 'Revenue/Income', 'Service and Business Income', 'Business Income', 'Hospital Fees', '', '4020217000', ''),
(914, 'Revenue/Income', 'Service and Business Income', 'Business Income', 'Hospital Fees', 'Drugs and Medicines', '4020217001', 'Active'),
(915, 'Revenue/Income', 'Service and Business Income', 'Business Income', 'Hospital Fees', 'Medical Supplies', '4020217002', 'Active'),
(916, 'Revenue/Income', 'Service and Business Income', 'Business Income', 'Hospital Fees', 'Medical Fees - Operating Room', '4020217003', 'Active'),
(917, 'Revenue/Income', 'Service and Business Income', 'Business Income', 'Hospital Fees', 'Medical Fees - Radiology', '4020217004', 'Active'),
(918, 'Revenue/Income', 'Service and Business Income', 'Business Income', 'Hospital Fees', 'Medical Fees - Laboratory', '4020217005', 'Active'),
(919, 'Revenue/Income', 'Service and Business Income', 'Business Income', 'Hospital Fees', 'Medical Fees - Hemodialysis', '4020217006', 'Active'),
(920, 'Revenue/Income', 'Service and Business Income', 'Business Income', 'Hospital Fees', 'Medical Fees - Cardio-Vascular Services', '4020217007', 'Active'),
(921, 'Revenue/Income', 'Service and Business Income', 'Business Income', 'Hospital Fees', 'Medical Fees - Nuclear Medicine Services', '4020217008', 'Active'),
(922, 'Revenue/Income', 'Service and Business Income', 'Business Income', 'Hospital Fees', 'Medical Fees - Physical Medicine & Rehabilitation Services', '4020217009', 'Active'),
(923, 'Revenue/Income', 'Service and Business Income', 'Business Income', 'Hospital Fees', 'Medical Fees - Pulmonary Services', '4020217010', 'Active'),
(924, 'Revenue/Income', 'Service and Business Income', 'Business Income', 'Hospital Fees', 'Medical Fees - Neurology Services', '4020217011', 'Active'),
(925, 'Revenue/Income', 'Service and Business Income', 'Business Income', 'Hospital Fees', 'Medical Fees - Emergency Room Services', '4020217012', 'Active'),
(926, 'Revenue/Income', 'Service and Business Income', 'Business Income', 'Hospital Fees', 'Other Fees', '4020217099', 'Active'),
(927, 'Revenue/Income', 'Service and Business Income', 'Business Income', 'Guarantee Income', 'Guarantee Income', '4020218000', 'Active');
INSERT INTO `uacs_codes` (`id`, `classification`, `sub_class`, `group_name`, `object_code`, `sub_object_code`, `uacs`, `status`) VALUES
(928, 'Revenue/Income', 'Service and Business Income', 'Business Income', 'Fidelity Insurance Income', '', '4020219000', ''),
(929, 'Revenue/Income', 'Service and Business Income', 'Business Income', 'Fidelity Insurance Income', 'Fidelity Insurance Premiums', '4020219000', 'Active'),
(930, 'Revenue/Income', 'Service and Business Income', 'Business Income', 'Dividend Income', 'Dividend Income', '4020220000', 'Active'),
(931, 'Revenue/Income', 'Service and Business Income', 'Business Income', 'Interest Income', '', '4020221000', ''),
(932, 'Revenue/Income', 'Service and Business Income', 'Business Income', 'Interest Income', 'Interest on NG Deposits', '4020221001', 'Active'),
(933, 'Revenue/Income', 'Service and Business Income', 'Business Income', 'Interest Income', 'Interest on Advances to GOCCs', '4020221002', 'Active'),
(934, 'Revenue/Income', 'Service and Business Income', 'Business Income', 'Interest Income', 'Interest Income - Others', '4020221099', 'Active'),
(935, 'Revenue/Income', 'Service and Business Income', 'Business Income', 'Share in the Profit of Joint Venture', '', '4020222000', ''),
(936, 'Revenue/Income', 'Service and Business Income', 'Business Income', 'Share in the Profit of Joint Venture', 'Share in the profit of Joint Venture', '4020222000', 'Active'),
(937, 'Revenue/Income', 'Service and Business Income', 'Business Income', 'Fines and Penalties - Business Income', 'Fines and Penalties - Business Income', '4020223000', 'Active'),
(938, 'Revenue/Income', 'Service and Business Income', 'Business Income', 'Service Concession Revenue', 'Service Concession Revenue', '4020224000', 'Active'),
(939, 'Revenue/Income', 'Service and Business Income', 'Business Income', 'Other Business Income', '', '4020299000', ''),
(940, 'Revenue/Income', 'Service and Business Income', 'Business Income', 'Other Business Income', 'Income from Compromise Agreement', '4020299001', 'Active'),
(941, 'Revenue/Income', 'Service and Business Income', 'Business Income', 'Other Business Income', 'Pasture Income', '4020299002', 'Active'),
(942, 'Revenue/Income', 'Service and Business Income', 'Business Income', 'Other Business Income', 'Warehousing Fees', '4020299003', 'Active'),
(943, 'Revenue/Income', 'Service and Business Income', 'Business Income', 'Other Business Income', 'Other Business Income', '4020299099', 'Active'),
(944, 'Revenue/Income', 'Assistance/Subsidy from', '', '', '', '4030000000', ''),
(945, 'Revenue/Income', 'Assistance/Subsidy from', 'Assistance/Subsidy from', '', '', '4030100000', ''),
(946, 'Revenue/Income', 'Assistance/Subsidy from', 'Assistance/Subsidy from', 'Subsidy from National Government', 'Subsidy from National Government', '4030101000', 'Active'),
(947, 'Revenue/Income', 'Assistance/Subsidy from', 'Assistance/Subsidy from', 'Assistance from Other National Government Agencies', '', '4030102000', ''),
(948, 'Revenue/Income', 'Assistance/Subsidy from', 'Assistance/Subsidy from', 'Assistance from Other National Government Agencies', 'Subsidy from other National Government Agencies', '4030102000', 'Active'),
(949, 'Revenue/Income', 'Assistance/Subsidy from', 'Assistance/Subsidy from', 'Assistance from Local Government Units', 'Assistance from Local Government Units', '4030103000', 'Active'),
(950, 'Revenue/Income', 'Assistance/Subsidy from', 'Assistance/Subsidy from', 'Assistance from Government-Owned or Controlled Corporations', '', '4030104000', ''),
(951, 'Revenue/Income', 'Assistance/Subsidy from', 'Assistance/Subsidy from', 'Assistance from Government-Owned or Controlled Corporations', 'Assistance from Government-Owned and/or Controlled Corporations', '4030104000', 'Active'),
(952, 'Revenue/Income', 'Assistance/Subsidy from', 'Assistance/Subsidy from', 'Subsidy from Other Funds', 'Subsidy from Other Funds', '4030105000', 'Active'),
(953, 'Revenue/Income', 'Shares, Grants and Donations', '', '', '', '4040000000', ''),
(954, 'Revenue/Income', 'Shares, Grants and Donations', 'Shares', '', '', '4040100000', ''),
(955, 'Revenue/Income', 'Shares, Grants and Donations', 'Shares', 'Share from National Wealth', 'Share from National Wealth', '4040101000', 'Active'),
(956, 'Revenue/Income', 'Shares, Grants and Donations', 'Shares', 'Share from National Wealth', '', '4040101000', ''),
(957, 'Revenue/Income', 'Shares, Grants and Donations', 'Shares', 'Share from National Wealth', 'Tobacco Excise Tax (Virginia) per R.A. 7171', '4040101001', 'Active'),
(958, 'Revenue/Income', 'Shares, Grants and Donations', 'Shares', 'Share from National Wealth', 'Tobacco Excise Tax (Burley and Native) per R.A. 8240', '4040101002', 'Active'),
(959, 'Revenue/Income', 'Shares, Grants and Donations', 'Shares', 'Share from National Wealth', 'Mining Taxes per R.A. 7160', '4040101003', 'Active'),
(960, 'Revenue/Income', 'Shares, Grants and Donations', 'Shares', 'Share from National Wealth', 'Royalties per R.A.7160', '4040101004', 'Active'),
(961, 'Revenue/Income', 'Shares, Grants and Donations', 'Shares', 'Share from National Wealth', 'Forestry Charges per R.A.7160', '4040101005', 'Active'),
(962, 'Revenue/Income', 'Shares, Grants and Donations', 'Shares', 'Share from National Wealth', 'Fishery Charges per R.A.7160', '4040101006', 'Active'),
(963, 'Revenue/Income', 'Shares, Grants and Donations', 'Shares', 'Share from National Wealth', 'Renewable Energy charges per R.A.9513', '4040101007', 'Active'),
(964, 'Revenue/Income', 'Shares, Grants and Donations', 'Shares', 'Share from National Wealth', 'Income Tax Collections in ECO ZONES per R.A. 7922 and R.A. 8748', '4040101008', 'Active'),
(965, 'Revenue/Income', 'Shares, Grants and Donations', 'Shares', 'Share from National Wealth', 'Value Added Tax per R.A. 7643', '4040101009', 'Active'),
(966, 'Revenue/Income', 'Shares, Grants and Donations', 'Shares', 'Share from National Wealth', 'Value Added Tax in lieu of Franchise Tax per R.A. 7953 and R.A. 8407', '4040101010', 'Active'),
(967, 'Revenue/Income', 'Shares, Grants and Donations', 'Shares', 'Share from PAGCOR/PCSO', 'Share from PAGCOR/PCSO', '4040102000', 'Active'),
(968, 'Revenue/Income', 'Shares, Grants and Donations', 'Shares', 'Share from Earnings of Government-Owned or Controlled Corporations', '', '4040103000', ''),
(969, 'Revenue/Income', 'Shares, Grants and Donations', 'Shares', 'Share from Earnings of Government-Owned or Controlled Corporations', 'Share from Earnings of GOCCs', '4040103000', 'Active'),
(970, 'Revenue/Income', 'Shares, Grants and Donations', 'Donations', '', '', '4040200000', ''),
(971, 'Revenue/Income', 'Shares, Grants and Donations', 'Donations', 'Donations in Cash', '', '4040201000', ''),
(972, 'Revenue/Income', 'Shares, Grants and Donations', 'Donations', 'Donations in Cash', 'Income from Grants and Donations in Cash', '4040201000', 'Active'),
(973, 'Revenue/Income', 'Shares, Grants and Donations', 'Donations', 'Donations in Kind', '', '4040202000', ''),
(974, 'Revenue/Income', 'Shares, Grants and Donations', 'Donations', 'Donations in Kind', 'Income from Grants and Donations in Kind', '4040202000', 'Active'),
(975, 'Revenue/Income', 'Shares, Grants and Donations', 'Grants', '', '', '4040300000', ''),
(976, 'Revenue/Income', 'Shares, Grants and Donations', 'Grants', 'Grants in Cash', '', '4040301000', ''),
(977, 'Revenue/Income', 'Shares, Grants and Donations', 'Grants', 'Grants in Cash', 'Grants in cash from domestic sources', '4040301001', 'Active'),
(978, 'Revenue/Income', 'Shares, Grants and Donations', 'Grants', 'Grants in Cash', 'Grants in cash from foreign sources', '4040301002', 'Active'),
(979, 'Revenue/Income', 'Shares, Grants and Donations', 'Grants', 'Grants in Kind', '', '4040302000', ''),
(980, 'Revenue/Income', 'Shares, Grants and Donations', 'Grants', 'Grants in Kind', 'Grants in kind from domestic sources', '4040302001', 'Active'),
(981, 'Revenue/Income', 'Shares, Grants and Donations', 'Grants', 'Grants in Kind', 'Grants in kind from foreign sources', '4040302002', 'Active'),
(982, 'Revenue/Income', 'Gains', '', '', '', '4050000000', ''),
(983, 'Revenue/Income', 'Gains', 'Gains', '', '', '4050100000', ''),
(984, 'Revenue/Income', 'Gains', 'Gains', 'Gain on Foreign Exchange (FOREX)', '', '4050101000', ''),
(985, 'Revenue/Income', 'Gains', 'Gains', 'Gain on Foreign Exchange (FOREX)', 'Gain in Foreign Exchange (FOREX)', '4050101000', 'Active'),
(986, 'Revenue/Income', 'Gains', 'Gains', 'Gain on Sale of Investments', 'Gain on Sale of Investments', '4050102000', 'Active'),
(987, 'Revenue/Income', 'Gains', 'Gains', 'Gain on Sale of Investment Property', 'Gain on Sale of Investment Property', '4050103000', 'Active'),
(988, 'Revenue/Income', 'Gains', 'Gains', 'Gain on Sale of Property, Plant and Equipment', 'Gain on Sale of Property, Plant and Equipment', '4050104000', 'Active'),
(989, 'Revenue/Income', 'Gains', 'Gains', 'Gain on Initial Recognition of Biological Assets', 'Gain on Initial Recognition of Biological Assets', '4050105000', 'Active'),
(990, 'Revenue/Income', 'Gains', 'Gains', 'Gain on Sale of Biological Assets', 'Gain on Sale of Biological Assets', '4050106000', 'Active'),
(991, 'Revenue/Income', 'Gains', 'Gains', 'Gain from Changes in Fair Value Less Cost to Sell of Biological Assets Due to Physical Change', 'Gain from Changes in Fair Value Less Cost to Sell of Biological Assets Due to Physical Change', '4050107000', 'Active'),
(992, 'Revenue/Income', 'Gains', 'Gains', 'Gain from Changes in Fair Value Less Cost to Sell of Biological Assets Due to Price Change', 'Gain from Changes in Fair Value Less Cost to Sell of Biological Assets Due to Price Change', '4050108000', 'Active'),
(993, 'Revenue/Income', 'Gains', 'Gains', 'Gain on Sale of Agricultural Produce', 'Gain on Sale of Agricultural Produce', '4050109000', 'Active'),
(994, 'Revenue/Income', 'Gains', 'Gains', 'Gain on Sale of Intangible Assets', '', '4050110000', ''),
(995, 'Revenue/Income', 'Gains', 'Gains', 'Gain on Sale of Intangible Assets', 'Gain on Sale of Intagible Assets', '4050110000', 'Active'),
(996, 'Revenue/Income', 'Gains', 'Gains', 'Other Gains', 'Other Gains', '4050199000', 'Active'),
(997, 'Revenue/Income', 'Non-Operating Income', '', '', '', '4060000000', ''),
(998, 'Revenue/Income', 'Non-Operating Income', 'Sale of Assets', '', '', '4060100000', ''),
(999, 'Revenue/Income', 'Non-Operating Income', 'Sale of Assets', 'Sale of Garnished/Confiscated/Abandoned/Seized Goods and Property', '', '4060101000', ''),
(1000, 'Revenue/Income', 'Non-Operating Income', 'Sale of Assets', 'Sale of Garnished/Confiscated/Abandoned/Seized Goods and Property', 'Sale of Garnished/Confiscated/Abandoned/Seized Goods and Properties', '4060101000', 'Active'),
(1001, 'Revenue/Income', 'Non-Operating Income', 'Sale of Assets', 'Sale of Unserviceable Property', 'Sale of Unserviceable Property', '4060102000', 'Active'),
(1002, 'Revenue/Income', 'Non-Operating Income', 'Reversal of Impairment Loss', 'Reversal of Impairment Loss', 'Reversal of Impairment Loss', '4060201000', 'Active'),
(1003, 'Revenue/Income', 'Non-Operating Income', 'Miscellaneous Income', '', '', '4060900000', ''),
(1004, 'Revenue/Income', 'Non-Operating Income', 'Miscellaneous Income', 'Proceeds from Insurance/Indemnities', 'Proceeds from Insurance/Indemnities', '4060901000', 'Active'),
(1005, 'Revenue/Income', 'Non-Operating Income', 'Miscellaneous Income', 'Miscellaneous Income', 'Miscellaneous Income', '4060999000', 'Active'),
(1006, 'Expenses', '', '', '', '', '5000000000', ''),
(1007, 'Expenses', 'Personnel Services', '', '', '', '5010000000', ''),
(1008, 'Expenses', 'Personnel Services', 'Salaries and Wages', '', '', '5010100000', ''),
(1009, 'Expenses', 'Personnel Services', 'Salaries and Wages', 'Salaries and Wages - Regular', '', '5010101000', ''),
(1010, 'Expenses', 'Personnel Services', 'Salaries and Wages', 'Salaries and Wages - Regular', 'Basic Salary - Civilian', '5010101001', 'Active'),
(1011, 'Expenses', 'Personnel Services', 'Salaries and Wages', 'Salaries and Wages - Regular', 'Base Pay - Military/Uniformed Personnel', '5010101002', 'Active'),
(1012, 'Expenses', 'Personnel Services', 'Salaries and Wages', 'Salaries and Wages - Casual/Contractual', 'Salaries and Wages - Casual/Contractual', '5010102000', 'Active'),
(1013, 'Expenses', 'Personnel Services', 'Salaries and Wages', 'Salaries and Wages - Substitute Teachers', 'Salaries and Wages - Substitute Teachers', '5010103000', 'Active'),
(1014, 'Expenses', 'Personnel Services', 'Other Compensation', '', '', '5010200000', ''),
(1015, 'Expenses', 'Personnel Services', 'Other Compensation', 'Personal Economic Relief Allowance (PERA)', '', '5010201000', ''),
(1016, 'Expenses', 'Personnel Services', 'Other Compensation', 'Personal Economic Relief Allowance (PERA)', 'PERA - Civilian', '5010201001', 'Active'),
(1017, 'Expenses', 'Personnel Services', 'Other Compensation', 'Personal Economic Relief Allowance (PERA)', 'PERA - Military/Uniformed Personnel', '5010201002', 'Active'),
(1018, 'Expenses', 'Personnel Services', 'Other Compensation', 'Representation Allowance (RA)', 'Representation Allowance (RA)', '5010202000', 'Active'),
(1019, 'Expenses', 'Personnel Services', 'Other Compensation', 'Transportation Allowance (TA)', 'Transportation Allowance (TA)', '5010203001', 'Active'),
(1020, 'Expenses', 'Personnel Services', 'Other Compensation', 'Transportation Allowance (TA)', '', '5010203000', ''),
(1021, 'Expenses', 'Personnel Services', 'Other Compensation', 'Transportation Allowance (TA)', 'RATA of Sectoral/Alternate Sectoral Representatives', '5010203002', 'Active'),
(1022, 'Expenses', 'Personnel Services', 'Other Compensation', 'Clothing/Uniform Allowance', '', '5010204000', ''),
(1023, 'Expenses', 'Personnel Services', 'Other Compensation', 'Clothing/Uniform Allowance', 'Clothing/Uniform Allowance - Civilian', '5010204001', 'Active'),
(1024, 'Expenses', 'Personnel Services', 'Other Compensation', 'Clothing/Uniform Allowance', 'Shoe Allowance - Civilian', '5010204002', 'Active'),
(1025, 'Expenses', 'Personnel Services', 'Other Compensation', 'Clothing/Uniform Allowance', 'Clothing/Uniform Allowance - Military/Uniformed Personnel', '5010204003', 'Active'),
(1026, 'Expenses', 'Personnel Services', 'Other Compensation', 'Clothing/Uniform Allowance', 'Clothing/Uniform Allowance - Initial - Military/Uniformed Personnel', '5010204004', 'Active'),
(1027, 'Expenses', 'Personnel Services', 'Other Compensation', 'Clothing/Uniform Allowance', 'Clothing/Uniform Allowance - Special - Military/Uniformed Personnel', '5010204005', 'Active'),
(1028, 'Expenses', 'Personnel Services', 'Other Compensation', 'Clothing/Uniform Allowance', 'Clothing/Uniform Allowance - Cold Weather - Military/Uniformed Personnel', '5010204006', 'Active'),
(1029, 'Expenses', 'Personnel Services', 'Other Compensation', 'Clothing/Uniform Allowance', 'Clothing/Uniform Allowance - Reenlistment - Military/Uniformed Personnel', '5010204007', 'Active'),
(1030, 'Expenses', 'Personnel Services', 'Other Compensation', 'Clothing/Uniform Allowance', 'Clothing/Uniform Allowance - Winter - Military/Uniformed Personnel', '5010204008', 'Active'),
(1031, 'Expenses', 'Personnel Services', 'Other Compensation', 'Clothing/Uniform Allowance', 'Clothing/Uniform Allowance - Combat - Military/Uniformed Personnel', '5010204009', 'Active'),
(1032, 'Expenses', 'Personnel Services', 'Other Compensation', 'Clothing/Uniform Allowance', 'Clothing/Uniform Allowance - Maintenance Cold Weather - Military/Uniformed Personnel', '5010204010', 'Active'),
(1033, 'Expenses', 'Personnel Services', 'Other Compensation', 'Clothing/Uniform Allowance', 'Clothing/Uniform Allowance - Replacement - Military/Uniformed Personnel', '5010204011', 'Active'),
(1034, 'Expenses', 'Personnel Services', 'Other Compensation', 'Subsistence Allowance', '', '5010205000', ''),
(1035, 'Expenses', 'Personnel Services', 'Other Compensation', 'Subsistence Allowance', 'Subsistence Allowance - Military/Uniformed Personnel', '5010205001', 'Active'),
(1036, 'Expenses', 'Personnel Services', 'Other Compensation', 'Subsistence Allowance', 'Subsistence Allowance - Magna Carta Benefits for Science and Technology under R.A. 8439', '5010205002', 'Active'),
(1037, 'Expenses', 'Personnel Services', 'Other Compensation', 'Subsistence Allowance', 'Subsistence Allowance - Magna Carta Benefits for Public Health Workers under R.A. 7305', '5010205003', 'Active'),
(1038, 'Expenses', 'Personnel Services', 'Other Compensation', 'Subsistence Allowance', 'Subsistence Allowance - Magna Carta Benefits for Public Social Workers under R.A. 9432', '5010205004', 'Active'),
(1039, 'Expenses', 'Personnel Services', 'Other Compensation', 'Laundry Allowance', '', '5010206000', ''),
(1040, 'Expenses', 'Personnel Services', 'Other Compensation', 'Laundry Allowance', 'Laundry Allowance - Civilian', '5010206001', 'Active'),
(1041, 'Expenses', 'Personnel Services', 'Other Compensation', 'Laundry Allowance', 'Laundry Allowance - Military/Uniformed Personnel', '5010206002', 'Active'),
(1042, 'Expenses', 'Personnel Services', 'Other Compensation', 'Laundry Allowance', 'Laundry Allowance - Magna Carta Benefits for Science and Technology under R.A. 8439', '5010206003', 'Active'),
(1043, 'Expenses', 'Personnel Services', 'Other Compensation', 'Laundry Allowance', 'Laundry Allowance - Magna Carta Benefits for Public Health Workers under R.A. 7305', '5010206004', 'Active'),
(1044, 'Expenses', 'Personnel Services', 'Other Compensation', 'Laundry Allowance', 'Laundry Allowance - Magna Carta Benefits for Public Social Workers under R.A. 9432', '5010206005', 'Active'),
(1045, 'Expenses', 'Personnel Services', 'Other Compensation', 'Quarters Allowance', '', '5010207000', ''),
(1046, 'Expenses', 'Personnel Services', 'Other Compensation', 'Quarters Allowance', 'Quarters Allowance - Civilian', '5010207001', 'Active'),
(1047, 'Expenses', 'Personnel Services', 'Other Compensation', 'Quarters Allowance', 'Quarters Allowance - Military/Uniformed Personnel', '5010207002', 'Active'),
(1048, 'Expenses', 'Personnel Services', 'Other Compensation', 'Quarters Allowance', 'Quarters Allowance - Magna Carta Benefits for Science and Technology under R.A. 8439', '5010207003', 'Active'),
(1049, 'Expenses', 'Personnel Services', 'Other Compensation', 'Quarters Allowance', 'Quarters Allowance - Magna Carta Benefits for Public Health Workers under R.A. 7305', '5010207004', 'Active'),
(1050, 'Expenses', 'Personnel Services', 'Other Compensation', 'Quarters Allowance', 'Quarters Allowance - Magna Carta Benefits for Public Social Workers under R.A. 9432', '5010207005', 'Active'),
(1051, 'Expenses', 'Personnel Services', 'Other Compensation', 'Productivity Incentive Allowance', '', '5010208000', ''),
(1052, 'Expenses', 'Personnel Services', 'Other Compensation', 'Productivity Incentive Allowance', 'Productivity Incentive Allowance - Civilian ', '5010208001', 'Active'),
(1053, 'Expenses', 'Personnel Services', 'Other Compensation', 'Productivity Incentive Allowance', 'Productivity Incentive Allowance - Military/Uniformed Personnel', '5010208002', 'Active'),
(1054, 'Expenses', 'Personnel Services', 'Other Compensation', 'Overseas Allowance', '', '5010209000', ''),
(1055, 'Expenses', 'Personnel Services', 'Other Compensation', 'Overseas Allowance', 'Overseas Allowance - Civilian', '5010209001', 'Active'),
(1056, 'Expenses', 'Personnel Services', 'Other Compensation', 'Overseas Allowance', 'Overseas Allowance - Military/Uniformed Personnel', '5010209002', 'Active'),
(1057, 'Expenses', 'Personnel Services', 'Other Compensation', 'Honoraria', '', '5010210000', ''),
(1058, 'Expenses', 'Personnel Services', 'Other Compensation', 'Honoraria', 'Honoraria - Civilian', '5010210001', 'Active'),
(1059, 'Expenses', 'Personnel Services', 'Other Compensation', 'Honoraria', 'Honoraria - Military/Uniformed Personnel', '5010210002', 'Active'),
(1060, 'Expenses', 'Personnel Services', 'Other Compensation', 'Honoraria', 'Honoraria - Magna Carta Benefits for Science and Technology under R.A. 8439', '5010210003', 'Active'),
(1061, 'Expenses', 'Personnel Services', 'Other Compensation', 'Honoraria', 'Honoraria - Magna Carta Benefits for Public Health Workers under R.A. 7305', '5010210004', 'Active'),
(1062, 'Expenses', 'Personnel Services', 'Other Compensation', 'Honoraria', 'Honoraria - Magna Carta Benefits for Public Social Workers under R.A. 9432', '5010210005', 'Active'),
(1063, 'Expenses', 'Personnel Services', 'Other Compensation', 'Hazard Pay', 'Hazard Pay', '5010211001', 'Active'),
(1064, 'Expenses', 'Personnel Services', 'Other Compensation', 'Hazard Pay', '', '5010211000', ''),
(1065, 'Expenses', 'Personnel Services', 'Other Compensation', 'Hazard Pay', 'Hazard Duty Pay - Civilian', '5010211002', 'Active'),
(1066, 'Expenses', 'Personnel Services', 'Other Compensation', 'Hazard Pay', 'Hazard Duty Pay - Military/Uniformed Personnel', '5010211003', 'Active'),
(1067, 'Expenses', 'Personnel Services', 'Other Compensation', 'Hazard Pay', 'HP - Magna Carta Benefits for Science and Technology under R.A. 8439', '5010211004', 'Active'),
(1068, 'Expenses', 'Personnel Services', 'Other Compensation', 'Hazard Pay', 'HP - Magna Carta Benefits for Public Health Workers under R.A. 7305', '5010211005', 'Active'),
(1069, 'Expenses', 'Personnel Services', 'Other Compensation', 'Hazard Pay', 'HP - Magna Carta Benefits for Public Social Workers under R.A. 9432', '5010211006', 'Active'),
(1070, 'Expenses', 'Personnel Services', 'Other Compensation', 'Hazard Pay', 'Radiation Hazard Pay not exceeding 15% of Basic Salary', '5010211007', 'Active'),
(1071, 'Expenses', 'Personnel Services', 'Other Compensation', 'Hazard Pay', 'High Risk Duty Pay', '5010211008', 'Active'),
(1072, 'Expenses', 'Personnel Services', 'Other Compensation', 'Hazard Pay', 'Hazardous Duty Pay', '5010211009', 'Active'),
(1073, 'Expenses', 'Personnel Services', 'Other Compensation', 'Longevity Pay', '', '5010212000', ''),
(1074, 'Expenses', 'Personnel Services', 'Other Compensation', 'Longevity Pay', 'Longevity Pay - Civilian', '5010212001', 'Active'),
(1075, 'Expenses', 'Personnel Services', 'Other Compensation', 'Longevity Pay', 'Longevity Pay - Military/Uniformed Personnel', '5010212002', 'Active'),
(1076, 'Expenses', 'Personnel Services', 'Other Compensation', 'Longevity Pay', 'Longevity Pay - Magna Carta Benefits for Science and Technology under R.A. 8439', '5010212003', 'Active'),
(1077, 'Expenses', 'Personnel Services', 'Other Compensation', 'Longevity Pay', 'Longevity Pay - Magna Carta Benefits fo Public Health Workers under R.A. 7305', '5010212004', 'Active'),
(1078, 'Expenses', 'Personnel Services', 'Other Compensation', 'Longevity Pay', 'Longevity Pay - Magna Carta Benefits for Public Social Workers under R.A. 9432', '5010212005', 'Active'),
(1079, 'Expenses', 'Personnel Services', 'Other Compensation', 'Overtime and Night Pay', '', '5010213000', ''),
(1080, 'Expenses', 'Personnel Services', 'Other Compensation', 'Overtime and Night Pay', 'Overtime Pay', '5010213001', 'Active'),
(1081, 'Expenses', 'Personnel Services', 'Other Compensation', 'Overtime and Night Pay', 'Night-shift Differential Pay', '5010213002', 'Active'),
(1082, 'Expenses', 'Personnel Services', 'Other Compensation', 'Year End Bonus', '', '5010214000', ''),
(1083, 'Expenses', 'Personnel Services', 'Other Compensation', 'Year End Bonus', 'Year-End Bonus - Civilian', '5010214001', 'Active'),
(1084, 'Expenses', 'Personnel Services', 'Other Compensation', 'Year End Bonus', 'Year-End Bonus - Military/Uniformed Personnel', '5010214002', 'Active'),
(1085, 'Expenses', 'Personnel Services', 'Other Compensation', 'Cash Gift', '', '5010215000', ''),
(1086, 'Expenses', 'Personnel Services', 'Other Compensation', 'Cash Gift', 'Cash Gift - Civilian ', '5010215001', 'Active'),
(1087, 'Expenses', 'Personnel Services', 'Other Compensation', 'Cash Gift', 'Cash Gift - Military/Uniformed Personnel', '5010215002', 'Active'),
(1088, 'Expenses', 'Personnel Services', 'Other Compensation', 'Mid-Year Bonus', '', '5010216000', ''),
(1089, 'Expenses', 'Personnel Services', 'Other Compensation', 'Mid-Year Bonus', 'Mid-Year Bonus - Civilian', '5010216001', 'Active'),
(1090, 'Expenses', 'Personnel Services', 'Other Compensation', 'Mid-Year Bonus', 'Mid-Year Bonus - Military/Uniformed Personnel\n', '5010216002', 'Active'),
(1091, 'Expenses', 'Personnel Services', 'Other Compensation', 'Other Bonuses and Allowances', '', '5010299000', ''),
(1092, 'Expenses', 'Personnel Services', 'Other Compensation', 'Other Bonuses and Allowances', 'Per Diems - Civilian', '5010299001', 'Active'),
(1093, 'Expenses', 'Personnel Services', 'Other Compensation', 'Other Bonuses and Allowances', 'Allowance of PAO Lawyers and Employees Assigned in Night Courts - Civilian', '5010299002', 'Active'),
(1094, 'Expenses', 'Personnel Services', 'Other Compensation', 'Other Bonuses and Allowances', 'Allowance of Attorney\'s de Officio - Civilian', '5010299003', 'Active'),
(1095, 'Expenses', 'Personnel Services', 'Other Compensation', 'Other Bonuses and Allowances', 'Special Hardship Allowance - Civilian', '5010299004', 'Active'),
(1096, 'Expenses', 'Personnel Services', 'Other Compensation', 'Other Bonuses and Allowances', 'Private Messenger Fee - Civilian', '5010299005', 'Active'),
(1097, 'Expenses', 'Personnel Services', 'Other Compensation', 'Other Bonuses and Allowances', 'Inquest Allowance - Civilian', '5010299006', 'Active'),
(1098, 'Expenses', 'Personnel Services', 'Other Compensation', 'Other Bonuses and Allowances', 'Special Duty Allowance - Civilian', '5010299007', 'Active'),
(1099, 'Expenses', 'Personnel Services', 'Other Compensation', 'Other Bonuses and Allowances', 'Special Duty Allowance - Military/Uniformed Personnel', '5010299008', 'Active'),
(1100, 'Expenses', 'Personnel Services', 'Other Compensation', 'Other Bonuses and Allowances', 'Special Allowance for Judges and Justices - Civilian', '5010299009', 'Active'),
(1101, 'Expenses', 'Personnel Services', 'Other Compensation', 'Other Bonuses and Allowances', 'Special Allowance for the Members of the Prosecution Service', '5010299010', 'Active'),
(1102, 'Expenses', 'Personnel Services', 'Other Compensation', 'Other Bonuses and Allowances', 'Collective Negotiation Agreement Incentive - Civilian', '5010299011', 'Active'),
(1103, 'Expenses', 'Personnel Services', 'Other Compensation', 'Other Bonuses and Allowances', 'Productivity Enhancement Incentive - Civilian ', '5010299012', 'Active'),
(1104, 'Expenses', 'Personnel Services', 'Other Compensation', 'Other Bonuses and Allowances', 'Productivity Enhancement Incentive - Military/Uniformed Personnel', '5010299013', 'Active'),
(1105, 'Expenses', 'Personnel Services', 'Other Compensation', 'Other Bonuses and Allowances', 'Performance Based Bonus - Civilian', '5010299014', 'Active'),
(1106, 'Expenses', 'Personnel Services', 'Other Compensation', 'Other Bonuses and Allowances', 'Performance Based Bonus - Military/Uniformed Personnel', '5010299015', 'Active'),
(1107, 'Expenses', 'Personnel Services', 'Other Compensation', 'Other Bonuses and Allowances', 'Flying Pay - Duty Based Allowance - Military/Uniformed Personnel', '5010299016', 'Active'),
(1108, 'Expenses', 'Personnel Services', 'Other Compensation', 'Other Bonuses and Allowances', 'Special Group Term Insurance - Duty Based Allowance - Military/Uniformed Personnel', '5010299017', 'Active'),
(1109, 'Expenses', 'Personnel Services', 'Other Compensation', 'Other Bonuses and Allowances', 'Sea Duty Pay - Duty Based Allowance - Military/Uniformed Personnel', '5010299018', 'Active'),
(1110, 'Expenses', 'Personnel Services', 'Other Compensation', 'Other Bonuses and Allowances', 'Combat Incentive Pay - Duty Based Allowance - Military/Uniformed Personnel', '5010299019', 'Active'),
(1111, 'Expenses', 'Personnel Services', 'Other Compensation', 'Other Bonuses and Allowances', 'Reenlistment Pay - Duty Based Allowance - Military/Uniformed Personnel', '5010299020', 'Active'),
(1112, 'Expenses', 'Personnel Services', 'Other Compensation', 'Other Bonuses and Allowances', 'Other Subsistence Allowance - Duty Based Allowance - Military/Uniformed Personnel', '5010299021', 'Active'),
(1113, 'Expenses', 'Personnel Services', 'Other Compensation', 'Other Bonuses and Allowances', 'Training Subsistence Allowance - Duty Based Allowance - Military/Uniformed Personnel', '5010299022', 'Active'),
(1114, 'Expenses', 'Personnel Services', 'Other Compensation', 'Other Bonuses and Allowances', 'Civil Disturbance Control Subsistence Allowance - Duty Based Allowance - Military/Uniformed Personnel', '5010299023', 'Active'),
(1115, 'Expenses', 'Personnel Services', 'Other Compensation', 'Other Bonuses and Allowances', 'Subsistence of Detainees - Duty Based Allowance - Military/Uniformed Personnel', '5010299024', 'Active'),
(1116, 'Expenses', 'Personnel Services', 'Other Compensation', 'Other Bonuses and Allowances', 'Hardship Allowance - Duty Based Allowance - Military/Uniformed Personnel', '5010299025', 'Active'),
(1117, 'Expenses', 'Personnel Services', 'Other Compensation', 'Other Bonuses and Allowances', 'Combat Duty Pay - Duty Based Allowance - Military/Uniformed Personnel', '5010299026', 'Active'),
(1118, 'Expenses', 'Personnel Services', 'Other Compensation', 'Other Bonuses and Allowances', 'Incentive Pay - Duty Based Allowance - Military/Uniformed Personnel', '5010299027', 'Active'),
(1119, 'Expenses', 'Personnel Services', 'Other Compensation', 'Other Bonuses and Allowances', 'Instructor\'s Duty Pay - Duty Based Allowance - Military/Uniformed Personnel', '5010299028', 'Active'),
(1120, 'Expenses', 'Personnel Services', 'Other Compensation', 'Other Bonuses and Allowances', 'Reservist\'s Pay - Duty Based Allowance - Military/Uniformed Personnel', '5010299029', 'Active'),
(1121, 'Expenses', 'Personnel Services', 'Other Compensation', 'Other Bonuses and Allowances', 'Medal of Valor Award - Duty Based Allowance - Military/Uniformed Personnel', '5010299030', 'Active'),
(1122, 'Expenses', 'Personnel Services', 'Other Compensation', 'Other Bonuses and Allowances', 'Hospitalization Expenses - Duty Based Allowance - Military/Uniformed Personnel', '5010299031', 'Active'),
(1123, 'Expenses', 'Personnel Services', 'Other Compensation', 'Other Bonuses and Allowances', 'Specialist\'s Pay - Duty Based Allowance - Military/Uniformed Personnel', '5010299032', 'Active'),
(1124, 'Expenses', 'Personnel Services', 'Other Compensation', 'Other Bonuses and Allowances', 'Parachutist Pay - Duty Based Allowance - Military/Uniformed Personnel', '5010299033', 'Active'),
(1125, 'Expenses', 'Personnel Services', 'Other Compensation', 'Other Bonuses and Allowances', 'Provisional Allowance - Military/Uniformed Personnel', '5010299034', 'Active'),
(1126, 'Expenses', 'Personnel Services', 'Other Compensation', 'Other Bonuses and Allowances', 'Officers\' Allowance - Military/Uniformed Personnel', '5010299035', 'Active'),
(1127, 'Expenses', 'Personnel Services', 'Other Compensation', 'Other Bonuses and Allowances', 'Mid-Year Bonus - Civilian', '5010299036', 'Inactive'),
(1128, 'Expenses', 'Personnel Services', 'Other Compensation', 'Other Bonuses and Allowances', 'Mid-Year Bonus - Military / Uniformed Personnel', '5010299037', 'Inactive'),
(1129, 'Expenses', 'Personnel Services', 'Other Compensation', 'Other Bonuses and Allowances', 'Anniversary Bonus - Civilian', '5010299038', 'Active'),
(1130, 'Expenses', 'Personnel Services', 'Other Compensation', 'Other Bonuses and Allowances', 'Anniversary Bonus - Military/Uniformed Personnel', '5010299039', 'Active'),
(1131, 'Expenses', 'Personnel Services', 'Other Compensation', 'Other Bonuses and Allowances', 'Special Counsel Allowance', '5010299040', 'Inactive'),
(1132, 'Expenses', 'Personnel Services', 'Personnel Benefit Contributions', '', '', '5010300000', ''),
(1133, 'Expenses', 'Personnel Services', 'Personnel Benefit Contributions', 'Retirement and Life Insurance Premiums', 'Retirement and Life Insurance Premiums', '5010301000', 'Active'),
(1134, 'Expenses', 'Personnel Services', 'Personnel Benefit Contributions', 'Pag-IBIG Contributions ', '', '5010302000', ''),
(1135, 'Expenses', 'Personnel Services', 'Personnel Benefit Contributions', 'Pag-IBIG Contributions ', 'Pag-IBIG - Civilian', '5010302001', 'Active'),
(1136, 'Expenses', 'Personnel Services', 'Personnel Benefit Contributions', 'Pag-IBIG Contributions ', 'Pag-IBIG - Military/Uniformed Personnel', '5010302002', 'Active'),
(1137, 'Expenses', 'Personnel Services', 'Personnel Benefit Contributions', 'PhilHealth Contributions', '', '5010303000', ''),
(1138, 'Expenses', 'Personnel Services', 'Personnel Benefit Contributions', 'PhilHealth Contributions', 'PhilHealth - Civilian', '5010303001', 'Active'),
(1139, 'Expenses', 'Personnel Services', 'Personnel Benefit Contributions', 'PhilHealth Contributions', 'PhilHealth - Military/Uniformed Personnel', '5010303002', 'Active'),
(1140, 'Expenses', 'Personnel Services', 'Personnel Benefit Contributions', 'Employees Compensation Insurance Premiums (ECIP)', '', '5010304000', ''),
(1141, 'Expenses', 'Personnel Services', 'Personnel Benefit Contributions', 'Employees Compensation Insurance Premiums (ECIP)', 'ECIP - Civilian', '5010304001', 'Active'),
(1142, 'Expenses', 'Personnel Services', 'Personnel Benefit Contributions', 'Employees Compensation Insurance Premiums (ECIP)', 'ECIP - Military/Uniformed Personnel', '5010304002', 'Active'),
(1143, 'Expenses', 'Personnel Services', 'Personnel Benefit Contributions', 'Provident/Welfare Fund Contributions', 'Provident/Welfare Fund Contributions', '5010305000', 'Active'),
(1144, 'Expenses', 'Personnel Services', 'Other Personnel Benefits', '', '', '5010400000', ''),
(1145, 'Expenses', 'Personnel Services', 'Other Personnel Benefits', 'Pension Benefits', '', '5010401000', ''),
(1146, 'Expenses', 'Personnel Services', 'Other Personnel Benefits', 'Pension Benefits', 'Pension Benefits - Civilian', '5010401001', 'Active'),
(1147, 'Expenses', 'Personnel Services', 'Other Personnel Benefits', 'Pension Benefits', 'Pension Benefits - Military/Uniformed Personnel', '5010401002', 'Active'),
(1148, 'Expenses', 'Personnel Services', 'Other Personnel Benefits', 'Pension Benefits', 'Pension Benefits - Veterans', '5010401003', 'Active'),
(1149, 'Expenses', 'Personnel Services', 'Other Personnel Benefits', 'Retirement Gratuity', '', '5010402000', ''),
(1150, 'Expenses', 'Personnel Services', 'Other Personnel Benefits', 'Retirement Gratuity', 'Retirement Gratuity - Civilian', '5010402001', 'Active'),
(1151, 'Expenses', 'Personnel Services', 'Other Personnel Benefits', 'Retirement Gratuity', 'Retirement Gratuity - Military/Uniformed Personnel', '5010402002', 'Active'),
(1152, 'Expenses', 'Personnel Services', 'Other Personnel Benefits', 'Terminal Leave Benefits ', '', '5010403000', ''),
(1153, 'Expenses', 'Personnel Services', 'Other Personnel Benefits', 'Terminal Leave Benefits ', 'Terminal Leave Benefits - Civilian', '5010403001', 'Active'),
(1154, 'Expenses', 'Personnel Services', 'Other Personnel Benefits', 'Terminal Leave Benefits ', 'Terminal Leave Benefits - Military/Uniformed Personnel', '5010403002', 'Active'),
(1155, 'Expenses', 'Personnel Services', 'Other Personnel Benefits', 'Other Personnel Benefits', '', '5010499000', ''),
(1156, 'Expenses', 'Personnel Services', 'Other Personnel Benefits', 'Other Personnel Benefits', 'Lump-sum for Creation of New Positions - Civilian', '5010499001', 'Active'),
(1157, 'Expenses', 'Personnel Services', 'Other Personnel Benefits', 'Other Personnel Benefits', 'Lump-sum for Creation of New Positions - Military/Uniformed Personnel', '5010499002', 'Active'),
(1158, 'Expenses', 'Personnel Services', 'Other Personnel Benefits', 'Other Personnel Benefits', 'Lump-sum for Reclassification of Positions', '5010499003', 'Active'),
(1159, 'Expenses', 'Personnel Services', 'Other Personnel Benefits', 'Other Personnel Benefits', 'Lump-sum for Equivalent-Record Form', '5010499004', 'Active'),
(1160, 'Expenses', 'Personnel Services', 'Other Personnel Benefits', 'Other Personnel Benefits', 'Lump-sum for Master Teachers', '5010499005', 'Active'),
(1161, 'Expenses', 'Personnel Services', 'Other Personnel Benefits', 'Other Personnel Benefits', 'Lump-sum for Compensation Adjustment ', '5010499006', 'Active'),
(1162, 'Expenses', 'Personnel Services', 'Other Personnel Benefits', 'Other Personnel Benefits', 'Lump-sum for Filling of Positions - Civilian', '5010499007', 'Active'),
(1163, 'Expenses', 'Personnel Services', 'Other Personnel Benefits', 'Other Personnel Benefits', 'Lump-sum for NBC No. 308', '5010499008', 'Active'),
(1164, 'Expenses', 'Personnel Services', 'Other Personnel Benefits', 'Other Personnel Benefits', 'Lump-sum for Personnel Services', '5010499009', 'Active'),
(1165, 'Expenses', 'Personnel Services', 'Other Personnel Benefits', 'Other Personnel Benefits', 'Lump-sum for Step Increments - Length of Service', '5010499010', 'Active'),
(1166, 'Expenses', 'Personnel Services', 'Other Personnel Benefits', 'Other Personnel Benefits', 'Lump-sum for Step Increments - Meritorious Performance', '5010499011', 'Active'),
(1167, 'Expenses', 'Personnel Services', 'Other Personnel Benefits', 'Other Personnel Benefits', 'Other Lump-sum', '5010499012', 'Active'),
(1168, 'Expenses', 'Personnel Services', 'Other Personnel Benefits', 'Other Personnel Benefits', 'Police Benefits (NAPOLCOM)', '5010499013', 'Active'),
(1169, 'Expenses', 'Personnel Services', 'Other Personnel Benefits', 'Other Personnel Benefits', 'Lump-sum for Filling of Positions - Military/Uniformed Personnel', '5010499014', 'Active'),
(1170, 'Expenses', 'Personnel Services', 'Other Personnel Benefits', 'Other Personnel Benefits', 'Loyalty Award - Civilian', '5010499015', 'Active'),
(1171, 'Expenses', 'Personnel Services', 'Other Personnel Benefits', 'Other Personnel Benefits', 'Other Personnel Benefits', '5010499099', 'Active'),
(1172, 'Expenses', 'Maintenance and Other Operating Expenses', '', '', '', '5020000000', ''),
(1173, 'Expenses', 'Maintenance and Other Operating Expenses', 'Traveling Expenses', '', '', '5020100000', ''),
(1174, 'Expenses', 'Maintenance and Other Operating Expenses', 'Traveling Expenses', 'Traveling Expenses - Local', 'Traveling Expenses - Local', '5020101000', 'Active'),
(1175, 'Expenses', 'Maintenance and Other Operating Expenses', 'Traveling Expenses', 'Traveling Expenses - Foreign', 'Traveling Expenses - Foreign', '5020102000', 'Active'),
(1176, 'Expenses', 'Maintenance and Other Operating Expenses', 'Training and Scholarship Expenses', '', '', '5020200000', ''),
(1177, 'Expenses', 'Maintenance and Other Operating Expenses', 'Training and Scholarship Expenses', 'Training Expenses', '', '5020201000', ''),
(1178, 'Expenses', 'Maintenance and Other Operating Expenses', 'Training and Scholarship Expenses', 'Training Expenses', 'ICT Training Expenses', '5020201001', 'Active'),
(1179, 'Expenses', 'Maintenance and Other Operating Expenses', 'Training and Scholarship Expenses', 'Training Expenses', 'Training Expenses', '5020201002', 'Active'),
(1180, 'Expenses', 'Maintenance and Other Operating Expenses', 'Training and Scholarship Expenses', 'Scholarship Grants/Expenses', 'Scholarship Grants/Expenses', '5020202000', 'Active'),
(1181, 'Expenses', 'Maintenance and Other Operating Expenses', 'Supplies and Materials Expenses', '', '', '5020300000', ''),
(1182, 'Expenses', 'Maintenance and Other Operating Expenses', 'Supplies and Materials Expenses', 'Office Supplies Expenses', '', '5020301000', ''),
(1183, 'Expenses', 'Maintenance and Other Operating Expenses', 'Supplies and Materials Expenses', 'Office Supplies Expenses', 'ICT Office Supplies Expenses', '5020301001', 'Active'),
(1184, 'Expenses', 'Maintenance and Other Operating Expenses', 'Supplies and Materials Expenses', 'Office Supplies Expenses', 'Office Supplies Expenses', '5020301002', 'Active'),
(1185, 'Expenses', 'Maintenance and Other Operating Expenses', 'Supplies and Materials Expenses', 'Accountable Forms Expenses', 'Accountable Forms Expenses', '5020302000', 'Active'),
(1186, 'Expenses', 'Maintenance and Other Operating Expenses', 'Supplies and Materials Expenses', 'Non-Accountable Forms Expenses', 'Non-Accountable Forms Expenses', '5020303000', 'Active'),
(1187, 'Expenses', 'Maintenance and Other Operating Expenses', 'Supplies and Materials Expenses', 'Animal/Zoological Supplies Expenses', 'Animal/Zoological Supplies Expenses', '5020304000', 'Active'),
(1188, 'Expenses', 'Maintenance and Other Operating Expenses', 'Supplies and Materials Expenses', 'Food Supplies Expenses', 'Food Supplies Expenses', '5020305000', 'Active'),
(1189, 'Expenses', 'Maintenance and Other Operating Expenses', 'Supplies and Materials Expenses', 'Welfare Goods Expense', '', '5020306000', ''),
(1190, 'Expenses', 'Maintenance and Other Operating Expenses', 'Supplies and Materials Expenses', 'Welfare Goods Expense', 'Welfare Goods Expenses', '5020306000', 'Active'),
(1191, 'Expenses', 'Maintenance and Other Operating Expenses', 'Supplies and Materials Expenses', 'Drugs and Medicines Expenses', 'Drugs and Medicines Expenses', '5020307000', 'Active'),
(1192, 'Expenses', 'Maintenance and Other Operating Expenses', 'Supplies and Materials Expenses', 'Medical, Dental and Laboratory Supplies Expenses', 'Medical, Dental and Laboratory Supplies Expenses', '5020308000', 'Active'),
(1193, 'Expenses', 'Maintenance and Other Operating Expenses', 'Supplies and Materials Expenses', 'Fuel, Oil and Lubricants Expenses', 'Fuel, Oil and Lubricants Expenses', '5020309000', 'Active'),
(1194, 'Expenses', 'Maintenance and Other Operating Expenses', 'Supplies and Materials Expenses', 'Agricultural and Marine Supplies Expenses', 'Agricultural and Marine Supplies Expenses', '5020310000', 'Active'),
(1195, 'Expenses', 'Maintenance and Other Operating Expenses', 'Supplies and Materials Expenses', 'Textbooks and Instructional Materials Expenses', 'Textbooks and Instructional Materials Expenses', '5020311001', 'Active'),
(1196, 'Expenses', 'Maintenance and Other Operating Expenses', 'Supplies and Materials Expenses', 'Textbooks and Instructional Materials Expenses', '', '5020311000', ''),
(1197, 'Expenses', 'Maintenance and Other Operating Expenses', 'Supplies and Materials Expenses', 'Textbooks and Instructional Materials Expenses', 'Chalk Allowance', '5020311002', 'Active'),
(1198, 'Expenses', 'Maintenance and Other Operating Expenses', 'Supplies and Materials Expenses', 'Military, Police and Traffic Supplies Expenses', 'Military, Police and Traffic Supplies Expenses', '5020312000', 'Active'),
(1199, 'Expenses', 'Maintenance and Other Operating Expenses', 'Supplies and Materials Expenses', 'Chemical and Filtering Supplies Expenses', 'Chemical and Filtering Supplies Expenses', '5020313000', 'Active'),
(1200, 'Expenses', 'Maintenance and Other Operating Expenses', 'Supplies and Materials Expenses', 'Semi-Expendable Machinery and Equipment Expenses', 'Semi-Expendable Machinery and Equipment Expenses', '5020321000', 'Active'),
(1201, 'Expenses', 'Maintenance and Other Operating Expenses', 'Supplies and Materials Expenses', 'Semi-Expendable Machinery and Equipment Expenses', '', '5020321000', ''),
(1202, 'Expenses', 'Maintenance and Other Operating Expenses', 'Supplies and Materials Expenses', 'Semi-Expendable Machinery and Equipment Expenses', 'Machinery', '5020321001', 'Active'),
(1203, 'Expenses', 'Maintenance and Other Operating Expenses', 'Supplies and Materials Expenses', 'Semi-Expendable Machinery and Equipment Expenses', 'Office Equipment', '5020321002', 'Active'),
(1204, 'Expenses', 'Maintenance and Other Operating Expenses', 'Supplies and Materials Expenses', 'Semi-Expendable Machinery and Equipment Expenses', 'Information and Communications Technology Equipment', '5020321003', 'Active'),
(1205, 'Expenses', 'Maintenance and Other Operating Expenses', 'Supplies and Materials Expenses', 'Semi-Expendable Machinery and Equipment Expenses', 'Agricultural and Forestry Equipment', '5020321004', 'Active'),
(1206, 'Expenses', 'Maintenance and Other Operating Expenses', 'Supplies and Materials Expenses', 'Semi-Expendable Machinery and Equipment Expenses', 'Marine and Fishery Equipment', '5020321005', 'Active'),
(1207, 'Expenses', 'Maintenance and Other Operating Expenses', 'Supplies and Materials Expenses', 'Semi-Expendable Machinery and Equipment Expenses', 'Airport Equipment', '5020321006', 'Active'),
(1208, 'Expenses', 'Maintenance and Other Operating Expenses', 'Supplies and Materials Expenses', 'Semi-Expendable Machinery and Equipment Expenses', 'Communications Equipment', '5020321007', 'Active'),
(1209, 'Expenses', 'Maintenance and Other Operating Expenses', 'Supplies and Materials Expenses', 'Semi-Expendable Machinery and Equipment Expenses', 'Disaster Response and Rescue Equipment', '5020321008', 'Active'),
(1210, 'Expenses', 'Maintenance and Other Operating Expenses', 'Supplies and Materials Expenses', 'Semi-Expendable Machinery and Equipment Expenses', 'Military, Police and Security Equipment', '5020321009', 'Active'),
(1211, 'Expenses', 'Maintenance and Other Operating Expenses', 'Supplies and Materials Expenses', 'Semi-Expendable Machinery and Equipment Expenses', 'Medical Equipment', '5020321010', 'Active'),
(1212, 'Expenses', 'Maintenance and Other Operating Expenses', 'Supplies and Materials Expenses', 'Semi-Expendable Machinery and Equipment Expenses', 'Printing Equipment', '5020321011', 'Active'),
(1213, 'Expenses', 'Maintenance and Other Operating Expenses', 'Supplies and Materials Expenses', 'Semi-Expendable Machinery and Equipment Expenses', 'Sports Equipment', '5020321012', 'Active'),
(1214, 'Expenses', 'Maintenance and Other Operating Expenses', 'Supplies and Materials Expenses', 'Semi-Expendable Machinery and Equipment Expenses', 'Technical and Scientific Equipment', '5020321013', 'Active'),
(1215, 'Expenses', 'Maintenance and Other Operating Expenses', 'Supplies and Materials Expenses', 'Semi-Expendable Machinery and Equipment Expenses', 'Other Equipment', '5020321099', 'Active'),
(1216, 'Expenses', 'Maintenance and Other Operating Expenses', 'Supplies and Materials Expenses', 'Semi-Expendable Furniture, Fixtures and Books Expenses', 'Semi-Expendable Furniture, Fixtures and Books Expenses', '5020322000', 'Active'),
(1217, 'Expenses', 'Maintenance and Other Operating Expenses', 'Supplies and Materials Expenses', 'Semi-Expendable Furniture, Fixtures and Books Expenses', '', '5020322000', ''),
(1218, 'Expenses', 'Maintenance and Other Operating Expenses', 'Supplies and Materials Expenses', 'Semi-Expendable Furniture, Fixtures and Books Expenses', 'Furniture and Fixtures', '5020322001', 'Active'),
(1219, 'Expenses', 'Maintenance and Other Operating Expenses', 'Supplies and Materials Expenses', 'Semi-Expendable Furniture, Fixtures and Books Expenses', 'Books', '5020322002', 'Active'),
(1220, 'Expenses', 'Maintenance and Other Operating Expenses', 'Supplies and Materials Expenses', 'Other Supplies and Materials Expenses', 'Other Supplies and Materials Expenses', '5020399000', 'Active'),
(1221, 'Expenses', 'Maintenance and Other Operating Expenses', 'Utility Expenses', '', '', '5020400000', ''),
(1222, 'Expenses', 'Maintenance and Other Operating Expenses', 'Utility Expenses', 'Water Expenses', 'Water Expenses', '5020401000', 'Active'),
(1223, 'Expenses', 'Maintenance and Other Operating Expenses', 'Utility Expenses', 'Electricity Expenses', 'Electricity Expenses', '5020402000', 'Active'),
(1224, 'Expenses', 'Maintenance and Other Operating Expenses', 'Utility Expenses', 'Gas/Heating Expenses', 'Gas/Heating Expenses', '5020403000', 'Active'),
(1225, 'Expenses', 'Maintenance and Other Operating Expenses', 'Utility Expenses', 'Other Utility Expenses', 'Other Utility Expenses', '5020499000', 'Active'),
(1226, 'Expenses', 'Maintenance and Other Operating Expenses', 'Communication Expenses', '', '', '5020500000', ''),
(1227, 'Expenses', 'Maintenance and Other Operating Expenses', 'Communication Expenses', 'Postage and Courier Services', '', '5020501000', ''),
(1228, 'Expenses', 'Maintenance and Other Operating Expenses', 'Communication Expenses', 'Postage and Courier Services', 'Postage and Courier Expenses', '5020501000', 'Active'),
(1229, 'Expenses', 'Maintenance and Other Operating Expenses', 'Communication Expenses', 'Telephone Expenses', '', '5020502000', ''),
(1230, 'Expenses', 'Maintenance and Other Operating Expenses', 'Communication Expenses', 'Telephone Expenses', 'Mobile', '5020502001', 'Active'),
(1231, 'Expenses', 'Maintenance and Other Operating Expenses', 'Communication Expenses', 'Telephone Expenses', 'Landline', '5020502002', 'Active'),
(1232, 'Expenses', 'Maintenance and Other Operating Expenses', 'Communication Expenses', 'Internet Subscription Expenses', 'Internet Subscription Expenses', '5020503000', 'Active'),
(1233, 'Expenses', 'Maintenance and Other Operating Expenses', 'Communication Expenses', 'Cable, Satellite, Telegraph and Radio Expenses', 'Cable, Satellite, Telegraph and Radio Expenses', '5020504000', 'Active'),
(1234, 'Expenses', 'Maintenance and Other Operating Expenses', 'Awards/Rewards, Prizes and Indemnities', '', '', '5020600000', ''),
(1235, 'Expenses', 'Maintenance and Other Operating Expenses', 'Awards/Rewards, Prizes and Indemnities', 'Awards/Rewards Expenses', 'Awards/Rewards Expenses', '5020601001', 'Active'),
(1236, 'Expenses', 'Maintenance and Other Operating Expenses', 'Awards/Rewards, Prizes and Indemnities', 'Awards/Rewards Expenses', '', '5020601000', ''),
(1237, 'Expenses', 'Maintenance and Other Operating Expenses', 'Awards/Rewards, Prizes and Indemnities', 'Awards/Rewards Expenses', 'Rewards and Incentives', '5020601002', 'Active'),
(1238, 'Expenses', 'Maintenance and Other Operating Expenses', 'Awards/Rewards, Prizes and Indemnities', 'Prizes', 'Prizes', '5020602000', 'Active'),
(1239, 'Expenses', 'Maintenance and Other Operating Expenses', 'Survey, Research, Exploration and Development Expenses', '', '', '5020700000', ''),
(1240, 'Expenses', 'Maintenance and Other Operating Expenses', 'Survey, Research, Exploration and Development Expenses', 'Survey Expenses', 'Survey Expenses', '5020701000', 'Active'),
(1241, 'Expenses', 'Maintenance and Other Operating Expenses', 'Survey, Research, Exploration and Development Expenses', 'Survey Expenses', '', '5020701000', '');
INSERT INTO `uacs_codes` (`id`, `classification`, `sub_class`, `group_name`, `object_code`, `sub_object_code`, `uacs`, `status`) VALUES
(1242, 'Expenses', 'Maintenance and Other Operating Expenses', 'Survey, Research, Exploration and Development Expenses', 'Survey Expenses', 'ICT Survey Expenses', '5020701001', 'Active'),
(1243, 'Expenses', 'Maintenance and Other Operating Expenses', 'Survey, Research, Exploration and Development Expenses', 'Survey Expenses', 'Survey Expenses', '5020701002', 'Active'),
(1244, 'Expenses', 'Maintenance and Other Operating Expenses', 'Survey, Research, Exploration and Development Expenses', 'Research, Exploration and Development Expenses', '', '5020702000', ''),
(1245, 'Expenses', 'Maintenance and Other Operating Expenses', 'Survey, Research, Exploration and Development Expenses', 'Research, Exploration and Development Expenses', 'ICT Research, Exploration and Development Expenses', '5020702001', 'Active'),
(1246, 'Expenses', 'Maintenance and Other Operating Expenses', 'Survey, Research, Exploration and Development Expenses', 'Research, Exploration and Development Expenses', 'Research, Exploration and Development Expenses', '5020702002', 'Active'),
(1247, 'Expenses', 'Maintenance and Other Operating Expenses', 'Demolition/Relocation and Desilting/Drilling/Dredging Expenses', '', '', '5020800000', ''),
(1248, 'Expenses', 'Maintenance and Other Operating Expenses', 'Demolition/Relocation and Desilting/Drilling/Dredging Expenses', 'Demolition and Relocation Expenses', 'Demolition and Relocation Expenses', '5020801000', 'Active'),
(1249, 'Expenses', 'Maintenance and Other Operating Expenses', 'Demolition/Relocation and Desilting/Drilling/Dredging Expenses', 'Desilting, Drilling and Dredging Expenses', '', '5020802000', ''),
(1250, 'Expenses', 'Maintenance and Other Operating Expenses', 'Demolition/Relocation and Desilting/Drilling/Dredging Expenses', 'Desilting, Drilling and Dredging Expenses', 'Desilting and Dredging Expenses', '5020802000', 'Active'),
(1251, 'Expenses', 'Maintenance and Other Operating Expenses', 'Generation, Transmission and Distribution Expenses', '', '', '5020900000', ''),
(1252, 'Expenses', 'Maintenance and Other Operating Expenses', 'Generation, Transmission and Distribution Expenses', 'Generation, Transmission and Distribution Expenses', '', '5020901000', ''),
(1253, 'Expenses', 'Maintenance and Other Operating Expenses', 'Generation, Transmission and Distribution Expenses', 'Generation, Transmission and Distribution Expenses', 'ICT Generation, Transmission and Distribution Expenses', '5020901001', 'Active'),
(1254, 'Expenses', 'Maintenance and Other Operating Expenses', 'Generation, Transmission and Distribution Expenses', 'Generation, Transmission and Distribution Expenses', 'Generation, Transmission and Distribution Expenses', '5020901002', 'Active'),
(1255, 'Expenses', 'Maintenance and Other Operating Expenses', 'Confidential, Intelligence and Extraordinary Expenses', '', '', '5021000000', ''),
(1256, 'Expenses', 'Maintenance and Other Operating Expenses', 'Confidential, Intelligence and Extraordinary Expenses', 'Confidential Expenses', 'Confidential Expenses', '5021001000', 'Active'),
(1257, 'Expenses', 'Maintenance and Other Operating Expenses', 'Confidential, Intelligence and Extraordinary Expenses', 'Intelligence Expenses', 'Intelligence Expenses', '5021002000', 'Active'),
(1258, 'Expenses', 'Maintenance and Other Operating Expenses', 'Confidential, Intelligence and Extraordinary Expenses', 'Extraordinary and Miscellaneous Expenses', 'Extraordinary and Miscellaneous Expenses', '5021003000', 'Active'),
(1259, 'Expenses', 'Maintenance and Other Operating Expenses', 'Professional Services', '', '', '5021100000', ''),
(1260, 'Expenses', 'Maintenance and Other Operating Expenses', 'Professional Services', 'Legal Services ', '', '5021101000', ''),
(1261, 'Expenses', 'Maintenance and Other Operating Expenses', 'Professional Services', 'Legal Services ', 'Legal Services', '5021101000', 'Active'),
(1262, 'Expenses', 'Maintenance and Other Operating Expenses', 'Professional Services', 'Auditing Services', 'Auditing Services', '5021102000', 'Active'),
(1263, 'Expenses', 'Maintenance and Other Operating Expenses', 'Professional Services', 'Consultancy Services', '', '5021103000', ''),
(1264, 'Expenses', 'Maintenance and Other Operating Expenses', 'Professional Services', 'Consultancy Services', 'ICT Consultancy Services', '5021103001', 'Active'),
(1265, 'Expenses', 'Maintenance and Other Operating Expenses', 'Professional Services', 'Consultancy Services', 'Consultancy Services', '5021103002', 'Active'),
(1266, 'Expenses', 'Maintenance and Other Operating Expenses', 'Professional Services', 'Other Professional Services', 'Other Professional Services', '5021199000', 'Active'),
(1267, 'Expenses', 'Maintenance and Other Operating Expenses', 'General Services', '', '', '5021200000', ''),
(1268, 'Expenses', 'Maintenance and Other Operating Expenses', 'General Services', 'Environment/Sanitary Services', 'Environment/Sanitary Services', '5021201000', 'Active'),
(1269, 'Expenses', 'Maintenance and Other Operating Expenses', 'General Services', 'Janitorial Services', 'Janitorial Services', '5021202000', 'Active'),
(1270, 'Expenses', 'Maintenance and Other Operating Expenses', 'General Services', 'Security Services', 'Security Services', '5021203000', 'Active'),
(1271, 'Expenses', 'Maintenance and Other Operating Expenses', 'General Services', 'Other General Services', '', '5021299000', ''),
(1272, 'Expenses', 'Maintenance and Other Operating Expenses', 'General Services', 'Other General Services', 'Other General Services - ICT Services', '5021299001', 'Inactive'),
(1273, 'Expenses', 'Maintenance and Other Operating Expenses', 'General Services', 'Other General Services', 'Other General Services', '5021299099', 'Inactive'),
(1274, 'Expenses', 'Maintenance and Other Operating Expenses', 'Repairs and Maintenance', '', '', '5021300000', ''),
(1275, 'Expenses', 'Maintenance and Other Operating Expenses', 'Repairs and Maintenance', 'Repairs and Maintenance - Investment Property', 'Repairs and Maintenance - Investment Property', '5021301000', 'Active'),
(1276, 'Expenses', 'Maintenance and Other Operating Expenses', 'Repairs and Maintenance', 'Repairs and Maintenance - Land Improvements', '', '5021302000', ''),
(1277, 'Expenses', 'Maintenance and Other Operating Expenses', 'Repairs and Maintenance', 'Repairs and Maintenance - Land Improvements', 'Aquaculture Structures', '5021302001', 'Active'),
(1278, 'Expenses', 'Maintenance and Other Operating Expenses', 'Repairs and Maintenance', 'Repairs and Maintenance - Land Improvements', 'Reforestation Projects', '5021302002', 'Active'),
(1279, 'Expenses', 'Maintenance and Other Operating Expenses', 'Repairs and Maintenance', 'Repairs and Maintenance - Land Improvements', 'Other Land Improvements', '5021302099', 'Active'),
(1280, 'Expenses', 'Maintenance and Other Operating Expenses', 'Repairs and Maintenance', 'Repairs and Maintenance - Infrastructure Assets', '', '5021303000', ''),
(1281, 'Expenses', 'Maintenance and Other Operating Expenses', 'Repairs and Maintenance', 'Repairs and Maintenance - Infrastructure Assets', 'Road Networks', '5021303001', 'Active'),
(1282, 'Expenses', 'Maintenance and Other Operating Expenses', 'Repairs and Maintenance', 'Repairs and Maintenance - Infrastructure Assets', 'Flood Control Systems', '5021303002', 'Active'),
(1283, 'Expenses', 'Maintenance and Other Operating Expenses', 'Repairs and Maintenance', 'Repairs and Maintenance - Infrastructure Assets', 'Sewer Systems', '5021303003', 'Active'),
(1284, 'Expenses', 'Maintenance and Other Operating Expenses', 'Repairs and Maintenance', 'Repairs and Maintenance - Infrastructure Assets', 'Water Supply Systems', '5021303004', 'Active'),
(1285, 'Expenses', 'Maintenance and Other Operating Expenses', 'Repairs and Maintenance', 'Repairs and Maintenance - Infrastructure Assets', 'Power Supply Systems', '5021303005', 'Active'),
(1286, 'Expenses', 'Maintenance and Other Operating Expenses', 'Repairs and Maintenance', 'Repairs and Maintenance - Infrastructure Assets', 'Communications Networks', '5021303006', 'Active'),
(1287, 'Expenses', 'Maintenance and Other Operating Expenses', 'Repairs and Maintenance', 'Repairs and Maintenance - Infrastructure Assets', 'Seaport Systems', '5021303007', 'Active'),
(1288, 'Expenses', 'Maintenance and Other Operating Expenses', 'Repairs and Maintenance', 'Repairs and Maintenance - Infrastructure Assets', 'Airport Systems', '5021303008', 'Active'),
(1289, 'Expenses', 'Maintenance and Other Operating Expenses', 'Repairs and Maintenance', 'Repairs and Maintenance - Infrastructure Assets', 'Parks, Plazas and Monuments', '5021303009', 'Active'),
(1290, 'Expenses', 'Maintenance and Other Operating Expenses', 'Repairs and Maintenance', 'Repairs and Maintenance - Infrastructure Assets', 'Railway Systems', '5021303010', 'Active'),
(1291, 'Expenses', 'Maintenance and Other Operating Expenses', 'Repairs and Maintenance', 'Repairs and Maintenance - Infrastructure Assets', 'Other Infrastructure Assets', '5021303099', 'Active'),
(1292, 'Expenses', 'Maintenance and Other Operating Expenses', 'Repairs and Maintenance', 'Repairs and Maintenance - Buildings and Other Structures', '', '5021304000', ''),
(1293, 'Expenses', 'Maintenance and Other Operating Expenses', 'Repairs and Maintenance', 'Repairs and Maintenance - Buildings and Other Structures', 'Buildings', '5021304001', 'Active'),
(1294, 'Expenses', 'Maintenance and Other Operating Expenses', 'Repairs and Maintenance', 'Repairs and Maintenance - Buildings and Other Structures', 'School Buildings', '5021304002', 'Active'),
(1295, 'Expenses', 'Maintenance and Other Operating Expenses', 'Repairs and Maintenance', 'Repairs and Maintenance - Buildings and Other Structures', 'Hospitals and Health Centers', '5021304003', 'Active'),
(1296, 'Expenses', 'Maintenance and Other Operating Expenses', 'Repairs and Maintenance', 'Repairs and Maintenance - Buildings and Other Structures', 'Markets', '5021304004', 'Active'),
(1297, 'Expenses', 'Maintenance and Other Operating Expenses', 'Repairs and Maintenance', 'Repairs and Maintenance - Buildings and Other Structures', 'Slaughterhouses', '5021304005', 'Active'),
(1298, 'Expenses', 'Maintenance and Other Operating Expenses', 'Repairs and Maintenance', 'Repairs and Maintenance - Buildings and Other Structures', 'Hostels and Dormitories', '5021304006', 'Active'),
(1299, 'Expenses', 'Maintenance and Other Operating Expenses', 'Repairs and Maintenance', 'Repairs and Maintenance - Buildings and Other Structures', 'Other Structures', '5021304099', 'Active'),
(1300, 'Expenses', 'Maintenance and Other Operating Expenses', 'Repairs and Maintenance', 'Repairs and Maintenance - Machinery and Equipment', '', '5021305000', ''),
(1301, 'Expenses', 'Maintenance and Other Operating Expenses', 'Repairs and Maintenance', 'Repairs and Maintenance - Machinery and Equipment', 'Machinery', '5021305001', 'Active'),
(1302, 'Expenses', 'Maintenance and Other Operating Expenses', 'Repairs and Maintenance', 'Repairs and Maintenance - Machinery and Equipment', 'Office Equipment', '5021305002', 'Active'),
(1303, 'Expenses', 'Maintenance and Other Operating Expenses', 'Repairs and Maintenance', 'Repairs and Maintenance - Machinery and Equipment', 'ICT Equipment', '5021305003', 'Active'),
(1304, 'Expenses', 'Maintenance and Other Operating Expenses', 'Repairs and Maintenance', 'Repairs and Maintenance - Machinery and Equipment', 'Agricultural and Forestry Equipment', '5021305004', 'Active'),
(1305, 'Expenses', 'Maintenance and Other Operating Expenses', 'Repairs and Maintenance', 'Repairs and Maintenance - Machinery and Equipment', 'Marine and Fishery Equipment', '5021305005', 'Active'),
(1306, 'Expenses', 'Maintenance and Other Operating Expenses', 'Repairs and Maintenance', 'Repairs and Maintenance - Machinery and Equipment', 'Airport Equipment', '5021305006', 'Active'),
(1307, 'Expenses', 'Maintenance and Other Operating Expenses', 'Repairs and Maintenance', 'Repairs and Maintenance - Machinery and Equipment', 'Communications Equipment', '5021305007', 'Active'),
(1308, 'Expenses', 'Maintenance and Other Operating Expenses', 'Repairs and Maintenance', 'Repairs and Maintenance - Machinery and Equipment', 'Construction and Heavy Equipment', '5021305008', 'Active'),
(1309, 'Expenses', 'Maintenance and Other Operating Expenses', 'Repairs and Maintenance', 'Repairs and Maintenance - Machinery and Equipment', 'Disaster Response and Rescue Equipment', '5021305009', 'Active'),
(1310, 'Expenses', 'Maintenance and Other Operating Expenses', 'Repairs and Maintenance', 'Repairs and Maintenance - Machinery and Equipment', 'Military, Police and Security Equipment', '5021305010', 'Active'),
(1311, 'Expenses', 'Maintenance and Other Operating Expenses', 'Repairs and Maintenance', 'Repairs and Maintenance - Machinery and Equipment', 'Medical Equipment', '5021305011', 'Active'),
(1312, 'Expenses', 'Maintenance and Other Operating Expenses', 'Repairs and Maintenance', 'Repairs and Maintenance - Machinery and Equipment', 'Printing Equipment', '5021305012', 'Active'),
(1313, 'Expenses', 'Maintenance and Other Operating Expenses', 'Repairs and Maintenance', 'Repairs and Maintenance - Machinery and Equipment', 'Sports Equipment', '5021305013', 'Active'),
(1314, 'Expenses', 'Maintenance and Other Operating Expenses', 'Repairs and Maintenance', 'Repairs and Maintenance - Machinery and Equipment', 'Technical and Scientific Equipment', '5021305014', 'Active'),
(1315, 'Expenses', 'Maintenance and Other Operating Expenses', 'Repairs and Maintenance', 'Repairs and Maintenance - Machinery and Equipment', 'Other Equipment', '5021305099', 'Active'),
(1316, 'Expenses', 'Maintenance and Other Operating Expenses', 'Repairs and Maintenance', 'Repairs and Maintenance - Transportation Equipment', '', '5021306000', ''),
(1317, 'Expenses', 'Maintenance and Other Operating Expenses', 'Repairs and Maintenance', 'Repairs and Maintenance - Transportation Equipment', 'Motor Vehicles', '5021306001', 'Active'),
(1318, 'Expenses', 'Maintenance and Other Operating Expenses', 'Repairs and Maintenance', 'Repairs and Maintenance - Transportation Equipment', 'Trains', '5021306002', 'Active'),
(1319, 'Expenses', 'Maintenance and Other Operating Expenses', 'Repairs and Maintenance', 'Repairs and Maintenance - Transportation Equipment', 'Aircrafts and Aircrafts Ground Equipment', '5021306003', 'Active'),
(1320, 'Expenses', 'Maintenance and Other Operating Expenses', 'Repairs and Maintenance', 'Repairs and Maintenance - Transportation Equipment', 'Watercrafts', '5021306004', 'Active'),
(1321, 'Expenses', 'Maintenance and Other Operating Expenses', 'Repairs and Maintenance', 'Repairs and Maintenance - Transportation Equipment', 'Other Transportation Equipment', '5021306099', 'Active'),
(1322, 'Expenses', 'Maintenance and Other Operating Expenses', 'Repairs and Maintenance', 'Repairs and Maintenance - Furniture and Fixtures', '', '5021307000', ''),
(1323, 'Expenses', 'Maintenance and Other Operating Expenses', 'Repairs and Maintenance', 'Repairs and Maintenance - Furniture and Fixtures', 'Repairs and Maintenance -  Furniture and Fixtures', '5021307000', 'Active'),
(1324, 'Expenses', 'Maintenance and Other Operating Expenses', 'Repairs and Maintenance', 'Repairs and Maintenance - Leased Assets', 'Repairs and Maintenance - Leased Assets', '5021308000', 'Active'),
(1325, 'Expenses', 'Maintenance and Other Operating Expenses', 'Repairs and Maintenance', 'Repairs and Maintenance - Leased Assets', '', '5021308000', ''),
(1326, 'Expenses', 'Maintenance and Other Operating Expenses', 'Repairs and Maintenance', 'Repairs and Maintenance - Leased Assets', 'Buildings and Other Structures', '5021308001', 'Active'),
(1327, 'Expenses', 'Maintenance and Other Operating Expenses', 'Repairs and Maintenance', 'Repairs and Maintenance - Leased Assets', 'Machinery and Equipment', '5021308002', 'Active'),
(1328, 'Expenses', 'Maintenance and Other Operating Expenses', 'Repairs and Maintenance', 'Repairs and Maintenance - Leased Assets', 'Transportation Equipment', '5021308003', 'Active'),
(1329, 'Expenses', 'Maintenance and Other Operating Expenses', 'Repairs and Maintenance', 'Repairs and Maintenance - Leased Assets', 'ICT Machinery and Equipment', '5021308004', 'Active'),
(1330, 'Expenses', 'Maintenance and Other Operating Expenses', 'Repairs and Maintenance', 'Repairs and Maintenance - Leased Assets', 'Other Leased Assets', '5021308099', 'Active'),
(1331, 'Expenses', 'Maintenance and Other Operating Expenses', 'Repairs and Maintenance', 'Repairs and Maintenance - Leased Assets Improvements', '', '5021309000', ''),
(1332, 'Expenses', 'Maintenance and Other Operating Expenses', 'Repairs and Maintenance', 'Repairs and Maintenance - Leased Assets Improvements', 'Land', '5021309001', 'Active'),
(1333, 'Expenses', 'Maintenance and Other Operating Expenses', 'Repairs and Maintenance', 'Repairs and Maintenance - Leased Assets Improvements', 'Buildings', '5021309002', 'Active'),
(1334, 'Expenses', 'Maintenance and Other Operating Expenses', 'Repairs and Maintenance', 'Repairs and Maintenance - Leased Assets Improvements', 'Other Leased Assets Improvements', '5021309099', 'Active'),
(1335, 'Expenses', 'Maintenance and Other Operating Expenses', 'Repairs and Maintenance', 'Restoration and Maintenance - Heritage Assets', '', '5021310000', ''),
(1336, 'Expenses', 'Maintenance and Other Operating Expenses', 'Repairs and Maintenance', 'Restoration and Maintenance - Heritage Assets', 'Historical Buildings', '5021310001', 'Active'),
(1337, 'Expenses', 'Maintenance and Other Operating Expenses', 'Repairs and Maintenance', 'Restoration and Maintenance - Heritage Assets', 'Works of Arts and Archeological Specimens', '5021310002', 'Active'),
(1338, 'Expenses', 'Maintenance and Other Operating Expenses', 'Repairs and Maintenance', 'Restoration and Maintenance - Heritage Assets', 'Other Heritage Assets', '5021310099', 'Active'),
(1339, 'Expenses', 'Maintenance and Other Operating Expenses', 'Repairs and Maintenance', 'Repairs and Maintenance - Semi-Expendable Machinery and Equipment', 'Repairs and Maintenance - Semi-Expendable Machinery and Equipment', '5021321000', 'Active'),
(1340, 'Expenses', 'Maintenance and Other Operating Expenses', 'Repairs and Maintenance', 'Repairs and Maintenance - Semi-Expendable Machinery and Equipment', '', '5021321000', ''),
(1341, 'Expenses', 'Maintenance and Other Operating Expenses', 'Repairs and Maintenance', 'Repairs and Maintenance - Semi-Expendable Machinery and Equipment', 'Machinery', '5021321001', 'Active'),
(1342, 'Expenses', 'Maintenance and Other Operating Expenses', 'Repairs and Maintenance', 'Repairs and Maintenance - Semi-Expendable Machinery and Equipment', 'Office Equipment', '5021321002', 'Active'),
(1343, 'Expenses', 'Maintenance and Other Operating Expenses', 'Repairs and Maintenance', 'Repairs and Maintenance - Semi-Expendable Machinery and Equipment', 'Information and Communications Technology Equipment', '5021321003', 'Active'),
(1344, 'Expenses', 'Maintenance and Other Operating Expenses', 'Repairs and Maintenance', 'Repairs and Maintenance - Semi-Expendable Machinery and Equipment', 'Agricultural and Forestry Equipment', '5021321004', 'Active'),
(1345, 'Expenses', 'Maintenance and Other Operating Expenses', 'Repairs and Maintenance', 'Repairs and Maintenance - Semi-Expendable Machinery and Equipment', 'Marine and Fishery Equipment', '5021321005', 'Active'),
(1346, 'Expenses', 'Maintenance and Other Operating Expenses', 'Repairs and Maintenance', 'Repairs and Maintenance - Semi-Expendable Machinery and Equipment', 'Airport Equipment', '5021321006', 'Active'),
(1347, 'Expenses', 'Maintenance and Other Operating Expenses', 'Repairs and Maintenance', 'Repairs and Maintenance - Semi-Expendable Machinery and Equipment', 'Communications Equipment', '5021321007', 'Active'),
(1348, 'Expenses', 'Maintenance and Other Operating Expenses', 'Repairs and Maintenance', 'Repairs and Maintenance - Semi-Expendable Machinery and Equipment', 'Disaster Response and Rescue Equipment', '5021321008', 'Active'),
(1349, 'Expenses', 'Maintenance and Other Operating Expenses', 'Repairs and Maintenance', 'Repairs and Maintenance - Semi-Expendable Machinery and Equipment', 'Military, Police and Security Equipment', '5021321009', 'Active'),
(1350, 'Expenses', 'Maintenance and Other Operating Expenses', 'Repairs and Maintenance', 'Repairs and Maintenance - Semi-Expendable Machinery and Equipment', 'Medical Equipment', '5021321010', 'Active'),
(1351, 'Expenses', 'Maintenance and Other Operating Expenses', 'Repairs and Maintenance', 'Repairs and Maintenance - Semi-Expendable Machinery and Equipment', 'Printing Equipment', '5021321011', 'Active'),
(1352, 'Expenses', 'Maintenance and Other Operating Expenses', 'Repairs and Maintenance', 'Repairs and Maintenance - Semi-Expendable Machinery and Equipment', 'Sports Equipment', '5021321012', 'Active'),
(1353, 'Expenses', 'Maintenance and Other Operating Expenses', 'Repairs and Maintenance', 'Repairs and Maintenance - Semi-Expendable Machinery and Equipment', 'Technical and Scientific Equipment', '5021321013', 'Active'),
(1354, 'Expenses', 'Maintenance and Other Operating Expenses', 'Repairs and Maintenance', 'Repairs and Maintenance - Semi-Expendable Machinery and Equipment', 'Other Equipment', '5021321099', 'Active'),
(1355, 'Expenses', 'Maintenance and Other Operating Expenses', 'Repairs and Maintenance', 'Repairs and Maintenance - Semi-Expendable Furniture, Fixtures and Books', 'Repairs and Maintenance - Semi-Expendable Furniture, Fixtures and Books', '5021322000', 'Active'),
(1356, 'Expenses', 'Maintenance and Other Operating Expenses', 'Repairs and Maintenance', 'Repairs and Maintenance - Semi-Expendable Furniture, Fixtures and Books', '', '5021322000', ''),
(1357, 'Expenses', 'Maintenance and Other Operating Expenses', 'Repairs and Maintenance', 'Repairs and Maintenance - Semi-Expendable Furniture, Fixtures and Books', 'Furniture and Fixtures', '5021322001', 'Active'),
(1358, 'Expenses', 'Maintenance and Other Operating Expenses', 'Repairs and Maintenance', 'Repairs and Maintenance - Semi-Expendable Furniture, Fixtures and Books', 'Books', '5021322002', 'Active'),
(1359, 'Expenses', 'Maintenance and Other Operating Expenses', 'Repairs and Maintenance', 'Repairs and Maintenance - Others', '', '5021398000', ''),
(1360, 'Expenses', 'Maintenance and Other Operating Expenses', 'Repairs and Maintenance', 'Repairs and Maintenance - Others', 'Others', '5021398000', 'Active'),
(1361, 'Expenses', 'Maintenance and Other Operating Expenses', 'Repairs and Maintenance', 'Repairs and Maintenance - Other Property, Plant and Equipment', '', '5021399000', ''),
(1362, 'Expenses', 'Maintenance and Other Operating Expenses', 'Repairs and Maintenance', 'Repairs and Maintenance - Other Property, Plant and Equipment', 'Work/Zoo Animals', '5021399001', 'Active'),
(1363, 'Expenses', 'Maintenance and Other Operating Expenses', 'Repairs and Maintenance', 'Repairs and Maintenance - Other Property, Plant and Equipment', 'Other Property, Plant and Equipment', '5021399099', 'Active'),
(1364, 'Expenses', 'Maintenance and Other Operating Expenses', 'Assistance/Subsidy to', '', '', '5021400000', ''),
(1365, 'Expenses', 'Maintenance and Other Operating Expenses', 'Assistance/Subsidy to', 'Subsidy to National Government Agencies', '', '5021401000', ''),
(1366, 'Expenses', 'Maintenance and Other Operating Expenses', 'Assistance/Subsidy to', 'Subsidy to National Government Agencies', 'Subsidy to NGAs', '5021401000', 'Active'),
(1367, 'Expenses', 'Maintenance and Other Operating Expenses', 'Assistance/Subsidy to', 'Assistance to Other National Government Agencies', '', '5021402000', ''),
(1368, 'Expenses', 'Maintenance and Other Operating Expenses', 'Assistance/Subsidy to', 'Assistance to Other National Government Agencies', 'Financial Assistance to NGAs', '5021402000', 'Active'),
(1369, 'Expenses', 'Maintenance and Other Operating Expenses', 'Assistance/Subsidy to', 'Assistance to Local Government Units', '', '5021403000', ''),
(1370, 'Expenses', 'Maintenance and Other Operating Expenses', 'Assistance/Subsidy to', 'Assistance to Local Government Units', 'Financial Assistance to Local Government Units', '5021403000', 'Active'),
(1371, 'Expenses', 'Maintenance and Other Operating Expenses', 'Assistance/Subsidy to', 'Assistance to Local Government Units', 'Tobacco Excise Tax (Virginia) per R.A. 7171', '5021403001', 'Active'),
(1372, 'Expenses', 'Maintenance and Other Operating Expenses', 'Assistance/Subsidy to', 'Assistance to Local Government Units', 'Tobacco Excise Tax (Burley and Native) per R.A. 8240', '5021403002', 'Active'),
(1373, 'Expenses', 'Maintenance and Other Operating Expenses', 'Assistance/Subsidy to', 'Assistance to Local Government Units', 'Mining Taxes per R.A. 7160', '5021403003', 'Active'),
(1374, 'Expenses', 'Maintenance and Other Operating Expenses', 'Assistance/Subsidy to', 'Assistance to Local Government Units', 'Royalties per R.A. 7160', '5021403004', 'Active'),
(1375, 'Expenses', 'Maintenance and Other Operating Expenses', 'Assistance/Subsidy to', 'Assistance to Local Government Units', 'Forestry Charges per R.A. 7160', '5021403005', 'Active'),
(1376, 'Expenses', 'Maintenance and Other Operating Expenses', 'Assistance/Subsidy to', 'Assistance to Local Government Units', 'Fishery Charges per R.A. 7160', '5021403006', 'Active'),
(1377, 'Expenses', 'Maintenance and Other Operating Expenses', 'Assistance/Subsidy to', 'Assistance to Local Government Units', 'Renewable Energy charges per R.A. 9513', '5021403007', 'Active'),
(1378, 'Expenses', 'Maintenance and Other Operating Expenses', 'Assistance/Subsidy to', 'Assistance to Local Government Units', 'Income Tax Collections in ECO ZONES per R.A. 7922 and R.A. 8748', '5021403008', 'Active'),
(1379, 'Expenses', 'Maintenance and Other Operating Expenses', 'Assistance/Subsidy to', 'Assistance to Local Government Units', 'Value Added Tax per R.A. 7643', '5021403009', 'Active'),
(1380, 'Expenses', 'Maintenance and Other Operating Expenses', 'Assistance/Subsidy to', 'Assistance to Local Government Units', 'Value Added Tax in lieu of Franchise Tax per R.A. 7953 and R.A. 8407', '5021403010', 'Active'),
(1381, 'Expenses', 'Maintenance and Other Operating Expenses', 'Assistance/Subsidy to', 'Budgetary Support to Government-Owned or Controlled Corporations', '', '5021404000', ''),
(1382, 'Expenses', 'Maintenance and Other Operating Expenses', 'Assistance/Subsidy to', 'Budgetary Support to Government-Owned or Controlled Corporations', 'Subsidy Support to Operations of GOCCs', '5021404001', 'Active'),
(1383, 'Expenses', 'Maintenance and Other Operating Expenses', 'Assistance/Subsidy to', 'Budgetary Support to Government-Owned or Controlled Corporations', 'Road Networks', '5021404002', 'Active'),
(1384, 'Expenses', 'Maintenance and Other Operating Expenses', 'Assistance/Subsidy to', 'Budgetary Support to Government-Owned or Controlled Corporations', 'Flood Control Systems', '5021404003', 'Active'),
(1385, 'Expenses', 'Maintenance and Other Operating Expenses', 'Assistance/Subsidy to', 'Budgetary Support to Government-Owned or Controlled Corporations', 'Sewer Systems', '5021404004', 'Active'),
(1386, 'Expenses', 'Maintenance and Other Operating Expenses', 'Assistance/Subsidy to', 'Budgetary Support to Government-Owned or Controlled Corporations', 'Water Supply Systems', '5021404005', 'Active'),
(1387, 'Expenses', 'Maintenance and Other Operating Expenses', 'Assistance/Subsidy to', 'Budgetary Support to Government-Owned or Controlled Corporations', 'Power Supply Systems', '5021404006', 'Active'),
(1388, 'Expenses', 'Maintenance and Other Operating Expenses', 'Assistance/Subsidy to', 'Budgetary Support to Government-Owned or Controlled Corporations', 'Communications Networks', '5021404007', 'Active'),
(1389, 'Expenses', 'Maintenance and Other Operating Expenses', 'Assistance/Subsidy to', 'Budgetary Support to Government-Owned or Controlled Corporations', 'Seaport Systems', '5021404008', 'Active'),
(1390, 'Expenses', 'Maintenance and Other Operating Expenses', 'Assistance/Subsidy to', 'Budgetary Support to Government-Owned or Controlled Corporations', 'Airport Systems', '5021404009', 'Active'),
(1391, 'Expenses', 'Maintenance and Other Operating Expenses', 'Assistance/Subsidy to', 'Budgetary Support to Government-Owned or Controlled Corporations', 'Parks, Plazas and Monuments', '5021404010', 'Active'),
(1392, 'Expenses', 'Maintenance and Other Operating Expenses', 'Assistance/Subsidy to', 'Budgetary Support to Government-Owned or Controlled Corporations', 'Irrigation Systems', '5021404011', 'Inactive'),
(1393, 'Expenses', 'Maintenance and Other Operating Expenses', 'Assistance/Subsidy to', 'Budgetary Support to Government-Owned or Controlled Corporations', 'Railway Systems', '5021404012', 'Inactive'),
(1394, 'Expenses', 'Maintenance and Other Operating Expenses', 'Assistance/Subsidy to', 'Budgetary Support to Government-Owned or Controlled Corporations', 'Housing and Community Facilities', '5021404013', 'Inactive'),
(1395, 'Expenses', 'Maintenance and Other Operating Expenses', 'Assistance/Subsidy to', 'Budgetary Support to Government-Owned or Controlled Corporations', 'Other Infrastructure Assets', '5021404099', 'Active'),
(1396, 'Expenses', 'Maintenance and Other Operating Expenses', 'Assistance/Subsidy to', 'Assistance to Non-Government Organizations/Civil Society Organizations', '', '5021405000', ''),
(1397, 'Expenses', 'Maintenance and Other Operating Expenses', 'Assistance/Subsidy to', 'Assistance to Non-Government Organizations/Civil Society Organizations', 'Financial Assistance to NGOs/POs', '5021405000', 'Active'),
(1398, 'Expenses', 'Maintenance and Other Operating Expenses', 'Assistance/Subsidy to', 'Internal Revenue Allotment', 'Internal Revenue Allotment', '5021406000', 'Active'),
(1399, 'Expenses', 'Maintenance and Other Operating Expenses', 'Assistance/Subsidy to', 'Subsidy to Regional Offices/Staff Bureaus', 'Subsidy to Regional Offices/Staff Bureaus', '5021407000', 'Active'),
(1400, 'Expenses', 'Maintenance and Other Operating Expenses', 'Assistance/Subsidy to', 'Subsidy to Operating Units', 'Subsidy to Operating Units', '5021408000', 'Active'),
(1401, 'Expenses', 'Maintenance and Other Operating Expenses', 'Assistance/Subsidy to', 'Subsidy to Other Funds', 'Subsidy to Other Funds', '5021409000', 'Active'),
(1402, 'Expenses', 'Maintenance and Other Operating Expenses', 'Assistance/Subsidy to', 'Subsidies - Others', 'Subsidies - Others', '5021499000', 'Active'),
(1403, 'Expenses', 'Maintenance and Other Operating Expenses', 'Taxes, Insurance Premiums and Other Fees', '', '', '5021500000', ''),
(1404, 'Expenses', 'Maintenance and Other Operating Expenses', 'Taxes, Insurance Premiums and Other Fees', 'Taxes, Duties and Licenses', 'Taxes, Duties and Licenses', '5021501001', 'Active'),
(1405, 'Expenses', 'Maintenance and Other Operating Expenses', 'Taxes, Insurance Premiums and Other Fees', 'Taxes, Duties and Licenses', '', '5021501000', ''),
(1406, 'Expenses', 'Maintenance and Other Operating Expenses', 'Taxes, Insurance Premiums and Other Fees', 'Taxes, Duties and Licenses', 'Tax Refund', '5021501002', 'Active'),
(1407, 'Expenses', 'Maintenance and Other Operating Expenses', 'Taxes, Insurance Premiums and Other Fees', 'Fidelity Bond Premiums', 'Fidelity Bond Premiums', '5021502000', 'Active'),
(1408, 'Expenses', 'Maintenance and Other Operating Expenses', 'Taxes, Insurance Premiums and Other Fees', 'Insurance Expenses', 'Insurance Expenses', '5021503000', 'Active'),
(1409, 'Expenses', 'Maintenance and Other Operating Expenses', 'Labor and Wages', 'Labor and Wages', 'Labor and Wages', '5021601000', 'Active'),
(1410, 'Expenses', 'Maintenance and Other Operating Expenses', 'Other Maintenance and Operating Expenses', '', '', '5029900000', ''),
(1411, 'Expenses', 'Maintenance and Other Operating Expenses', 'Other Maintenance and Operating Expenses', 'Advertising, Promotional and Marketing Expenses', '', '5029901000', ''),
(1412, 'Expenses', 'Maintenance and Other Operating Expenses', 'Other Maintenance and Operating Expenses', 'Advertising, Promotional and Marketing Expenses', 'Advertising Expenses', '5029901000', 'Active'),
(1413, 'Expenses', 'Maintenance and Other Operating Expenses', 'Other Maintenance and Operating Expenses', 'Printing and Publication Expenses', 'Printing and Publication Expenses', '5029902000', 'Active'),
(1414, 'Expenses', 'Maintenance and Other Operating Expenses', 'Other Maintenance and Operating Expenses', 'Representation Expenses', 'Representation Expenses', '5029903000', 'Active'),
(1415, 'Expenses', 'Maintenance and Other Operating Expenses', 'Other Maintenance and Operating Expenses', 'Transportation and Delivery Expenses', 'Transportation and Delivery Expenses', '5029904000', 'Active'),
(1416, 'Expenses', 'Maintenance and Other Operating Expenses', 'Other Maintenance and Operating Expenses', 'Rent/Lease Expenses', '', '5029905000', ''),
(1417, 'Expenses', 'Maintenance and Other Operating Expenses', 'Other Maintenance and Operating Expenses', 'Rent/Lease Expenses', 'Rents - Building and Structures', '5029905001', 'Active'),
(1418, 'Expenses', 'Maintenance and Other Operating Expenses', 'Other Maintenance and Operating Expenses', 'Rent/Lease Expenses', 'Rents - Land', '5029905002', 'Active'),
(1419, 'Expenses', 'Maintenance and Other Operating Expenses', 'Other Maintenance and Operating Expenses', 'Rent/Lease Expenses', 'Rents - Motor Vehicles', '5029905003', 'Active'),
(1420, 'Expenses', 'Maintenance and Other Operating Expenses', 'Other Maintenance and Operating Expenses', 'Rent/Lease Expenses', 'Rents - Equipment', '5029905004', 'Active'),
(1421, 'Expenses', 'Maintenance and Other Operating Expenses', 'Other Maintenance and Operating Expenses', 'Rent/Lease Expenses', 'Rents - Living Quarters', '5029905005', 'Active'),
(1422, 'Expenses', 'Maintenance and Other Operating Expenses', 'Other Maintenance and Operating Expenses', 'Rent/Lease Expenses', 'Operating Lease', '5029905006', 'Active'),
(1423, 'Expenses', 'Maintenance and Other Operating Expenses', 'Other Maintenance and Operating Expenses', 'Rent/Lease Expenses', 'Financial Lease', '5029905007', 'Active'),
(1424, 'Expenses', 'Maintenance and Other Operating Expenses', 'Other Maintenance and Operating Expenses', 'Rent/Lease Expenses', 'Rents - ICT Machinery and Equipment', '5029905008', 'Active'),
(1425, 'Expenses', 'Maintenance and Other Operating Expenses', 'Other Maintenance and Operating Expenses', 'Membership Dues and Contributions to Organizations', 'Membership Dues and Contributions to Organizations', '5029906000', 'Active'),
(1426, 'Expenses', 'Maintenance and Other Operating Expenses', 'Other Maintenance and Operating Expenses', 'Subscription Expenses', '', '5029907000', ''),
(1427, 'Expenses', 'Maintenance and Other Operating Expenses', 'Other Maintenance and Operating Expenses', 'Subscription Expenses', 'ICT Software Subscription', '5029907001', 'Active'),
(1428, 'Expenses', 'Maintenance and Other Operating Expenses', 'Other Maintenance and Operating Expenses', 'Subscription Expenses', 'Data Center Service', '5029907002', 'Active'),
(1429, 'Expenses', 'Maintenance and Other Operating Expenses', 'Other Maintenance and Operating Expenses', 'Subscription Expenses', 'Cloud Computing Service', '5029907003', 'Active'),
(1430, 'Expenses', 'Maintenance and Other Operating Expenses', 'Other Maintenance and Operating Expenses', 'Subscription Expenses', 'Library and Other Reading Materials Subscription Expenses', '5029907004', 'Active'),
(1431, 'Expenses', 'Maintenance and Other Operating Expenses', 'Other Maintenance and Operating Expenses', 'Subscription Expenses', 'Other Subscription Expenses', '5029907099', 'Active'),
(1432, 'Expenses', 'Maintenance and Other Operating Expenses', 'Other Maintenance and Operating Expenses', 'Donations', 'Donations', '5029908000', 'Active'),
(1433, 'Expenses', 'Maintenance and Other Operating Expenses', 'Other Maintenance and Operating Expenses', 'Litigation/Acquired Assets Expenses', 'Litigation/Acquired Assets Expenses', '5029909000', 'Active'),
(1434, 'Expenses', 'Maintenance and Other Operating Expenses', 'Other Maintenance and Operating Expenses', 'Bank Transaction Fee', 'Bank Transaction Fee', '5029922000', 'Active'),
(1435, 'Expenses', 'Maintenance and Other Operating Expenses', 'Other Maintenance and Operating Expenses', 'Other Maintenance and Operating Expenses', 'Other Maintenance and Operating Expenses', '5029999000', 'Inactive'),
(1436, 'Expenses', 'Maintenance and Other Operating Expenses', 'Other Maintenance and Operating Expenses', 'Other Maintenance and Operating Expenses', '', '5029999000', ''),
(1437, 'Expenses', 'Maintenance and Other Operating Expenses', 'Other Maintenance and Operating Expenses', 'Other Maintenance and Operating Expenses', 'Website Maintenance', '5029999001', 'Active'),
(1438, 'Expenses', 'Maintenance and Other Operating Expenses', 'Other Maintenance and Operating Expenses', 'Other Maintenance and Operating Expenses', 'Other Maintenance and Operating Expenses', '5029999099', 'Active'),
(1439, 'Expenses', 'Financial Expenses', '', '', '', '5030000000', ''),
(1440, 'Expenses', 'Financial Expenses', 'Financial Expenses', '', '', '5030100000', ''),
(1441, 'Expenses', 'Financial Expenses', 'Financial Expenses', 'Management Supervision/Trusteeship Fees', 'Management Supervision/Trusteeship Fees', '5030101000', 'Active'),
(1442, 'Expenses', 'Financial Expenses', 'Financial Expenses', 'Interest Expenses', '', '5030102000', ''),
(1443, 'Expenses', 'Financial Expenses', 'Financial Expenses', 'Interest Expenses', 'Interest Paid to Non Residents', '5030102001', 'Active'),
(1444, 'Expenses', 'Financial Expenses', 'Financial Expenses', 'Interest Expenses', 'Interest Paid to Residents other than General Government', '5030102002', 'Active'),
(1445, 'Expenses', 'Financial Expenses', 'Financial Expenses', 'Interest Expenses', 'Interest Paid to other General Government Units', '5030102003', 'Active'),
(1446, 'Expenses', 'Financial Expenses', 'Financial Expenses', 'Interest Expenses', 'Interest Expense - Others', '5030102004', 'Active'),
(1447, 'Expenses', 'Financial Expenses', 'Financial Expenses', 'Guarantee Fees', 'Guarantee Fees', '5030103000', 'Active'),
(1448, 'Expenses', 'Financial Expenses', 'Financial Expenses', 'Bank Charges - Loans/Borrowings', '', '5030104000', ''),
(1449, 'Expenses', 'Financial Expenses', 'Financial Expenses', 'Bank Charges - Loans/Borrowings', 'Bank Charges', '5030104000', 'Active'),
(1450, 'Expenses', 'Financial Expenses', 'Financial Expenses', 'Commitment Fees', 'Commitment Fees', '5030105000', 'Active'),
(1451, 'Expenses', 'Financial Expenses', 'Financial Expenses', 'Other Financial Charges', 'Other Financial Charges', '5030199000', 'Active'),
(1452, 'Expenses', 'Direct Costs', '', '', '', '5040000000', ''),
(1453, 'Expenses', 'Direct Costs', 'Cost of Goods Manufactured', '', '', '5040100000', ''),
(1454, 'Expenses', 'Direct Costs', 'Cost of Goods Manufactured', 'Direct Labor', 'Direct Labor', '5040101000', 'Active'),
(1455, 'Expenses', 'Direct Costs', 'Cost of Goods Manufactured', 'Manufacturing Overhead', 'Manufacturing Overhead', '5040102000', 'Active'),
(1456, 'Expenses', 'Direct Costs', 'Cost of Sales', 'Cost of Sales', 'Cost of Sales', '5040201000', 'Active'),
(1457, 'Expenses', 'Non-Cash Expenses', '', '', '', '5050000000', ''),
(1458, 'Expenses', 'Non-Cash Expenses', 'Depreciation', '', '', '5050100000', ''),
(1459, 'Expenses', 'Non-Cash Expenses', 'Depreciation', 'Depreciation - Investment Property', 'Depreciation - Investment Property', '5050101000', 'Active'),
(1460, 'Expenses', 'Non-Cash Expenses', 'Depreciation', 'Depreciation - Land Improvements', '', '5050102000', ''),
(1461, 'Expenses', 'Non-Cash Expenses', 'Depreciation', 'Depreciation - Land Improvements', 'Aquaculture Structures', '5050102001', 'Active'),
(1462, 'Expenses', 'Non-Cash Expenses', 'Depreciation', 'Depreciation - Land Improvements', 'Reforestation Projects', '5050102002', 'Active'),
(1463, 'Expenses', 'Non-Cash Expenses', 'Depreciation', 'Depreciation - Land Improvements', 'Other Land Improvements', '5050102099', 'Active'),
(1464, 'Expenses', 'Non-Cash Expenses', 'Depreciation', 'Depreciation - Infrastructure Assets', '', '5050103000', ''),
(1465, 'Expenses', 'Non-Cash Expenses', 'Depreciation', 'Depreciation - Infrastructure Assets', 'Road Networks', '5050103001', 'Active'),
(1466, 'Expenses', 'Non-Cash Expenses', 'Depreciation', 'Depreciation - Infrastructure Assets', 'Flood Control Systems', '5050103002', 'Active'),
(1467, 'Expenses', 'Non-Cash Expenses', 'Depreciation', 'Depreciation - Infrastructure Assets', 'Sewer System', '5050103003', 'Active'),
(1468, 'Expenses', 'Non-Cash Expenses', 'Depreciation', 'Depreciation - Infrastructure Assets', 'Water Supply Systems', '5050103004', 'Active'),
(1469, 'Expenses', 'Non-Cash Expenses', 'Depreciation', 'Depreciation - Infrastructure Assets', 'Power Supply Systems', '5050103005', 'Active'),
(1470, 'Expenses', 'Non-Cash Expenses', 'Depreciation', 'Depreciation - Infrastructure Assets', 'Communications Networks', '5050103006', 'Active'),
(1471, 'Expenses', 'Non-Cash Expenses', 'Depreciation', 'Depreciation - Infrastructure Assets', 'Seaport Systems', '5050103007', 'Active'),
(1472, 'Expenses', 'Non-Cash Expenses', 'Depreciation', 'Depreciation - Infrastructure Assets', 'Airport Systems', '5050103008', 'Active'),
(1473, 'Expenses', 'Non-Cash Expenses', 'Depreciation', 'Depreciation - Infrastructure Assets', 'Parks, Plazas and Monuments', '5050103009', 'Active'),
(1474, 'Expenses', 'Non-Cash Expenses', 'Depreciation', 'Depreciation - Infrastructure Assets', 'Railway Systems', '5050103010', 'Active'),
(1475, 'Expenses', 'Non-Cash Expenses', 'Depreciation', 'Depreciation - Infrastructure Assets', 'Other Infrastructure Assets', '5050103099', 'Active'),
(1476, 'Expenses', 'Non-Cash Expenses', 'Depreciation', 'Depreciation - Buildings and Other Structures', '', '5050104000', ''),
(1477, 'Expenses', 'Non-Cash Expenses', 'Depreciation', 'Depreciation - Buildings and Other Structures', 'Buildings', '5050104001', 'Active'),
(1478, 'Expenses', 'Non-Cash Expenses', 'Depreciation', 'Depreciation - Buildings and Other Structures', 'School Buildings', '5050104002', 'Active'),
(1479, 'Expenses', 'Non-Cash Expenses', 'Depreciation', 'Depreciation - Buildings and Other Structures', 'Hospitals and Health Centers', '5050104003', 'Active'),
(1480, 'Expenses', 'Non-Cash Expenses', 'Depreciation', 'Depreciation - Buildings and Other Structures', 'Markets', '5050104004', 'Active'),
(1481, 'Expenses', 'Non-Cash Expenses', 'Depreciation', 'Depreciation - Buildings and Other Structures', 'Slaughterhouses', '5050104005', 'Active'),
(1482, 'Expenses', 'Non-Cash Expenses', 'Depreciation', 'Depreciation - Buildings and Other Structures', 'Hostels and Dormitories', '5050104006', 'Active'),
(1483, 'Expenses', 'Non-Cash Expenses', 'Depreciation', 'Depreciation - Buildings and Other Structures', 'Other Structures', '5050104099', 'Active'),
(1484, 'Expenses', 'Non-Cash Expenses', 'Depreciation', 'Depreciation - Machinery and Equipment', '', '5050105000', ''),
(1485, 'Expenses', 'Non-Cash Expenses', 'Depreciation', 'Depreciation - Machinery and Equipment', 'Machinery', '5050105001', 'Active'),
(1486, 'Expenses', 'Non-Cash Expenses', 'Depreciation', 'Depreciation - Machinery and Equipment', 'Office Equipment', '5050105002', 'Active'),
(1487, 'Expenses', 'Non-Cash Expenses', 'Depreciation', 'Depreciation - Machinery and Equipment', 'ICT Equipment', '5050105003', 'Active'),
(1488, 'Expenses', 'Non-Cash Expenses', 'Depreciation', 'Depreciation - Machinery and Equipment', 'Agricultural and Forestry Equipment', '5050105004', 'Active'),
(1489, 'Expenses', 'Non-Cash Expenses', 'Depreciation', 'Depreciation - Machinery and Equipment', 'Marine and Fishery Equipment', '5050105005', 'Active'),
(1490, 'Expenses', 'Non-Cash Expenses', 'Depreciation', 'Depreciation - Machinery and Equipment', 'Airport Equipment', '5050105006', 'Active'),
(1491, 'Expenses', 'Non-Cash Expenses', 'Depreciation', 'Depreciation - Machinery and Equipment', 'Communications Equipment', '5050105007', 'Active'),
(1492, 'Expenses', 'Non-Cash Expenses', 'Depreciation', 'Depreciation - Machinery and Equipment', 'Construction and Heavy Equipment', '5050105008', 'Active'),
(1493, 'Expenses', 'Non-Cash Expenses', 'Depreciation', 'Depreciation - Machinery and Equipment', 'Disaster Response and Rescue Equipment', '5050105009', 'Active'),
(1494, 'Expenses', 'Non-Cash Expenses', 'Depreciation', 'Depreciation - Machinery and Equipment', 'Military, Police and Security Equipment', '5050105010', 'Active'),
(1495, 'Expenses', 'Non-Cash Expenses', 'Depreciation', 'Depreciation - Machinery and Equipment', 'Medical Equipment', '5050105011', 'Active'),
(1496, 'Expenses', 'Non-Cash Expenses', 'Depreciation', 'Depreciation - Machinery and Equipment', 'Printing Equipment', '5050105012', 'Active'),
(1497, 'Expenses', 'Non-Cash Expenses', 'Depreciation', 'Depreciation - Machinery and Equipment', 'Sports Equipment', '5050105013', 'Active'),
(1498, 'Expenses', 'Non-Cash Expenses', 'Depreciation', 'Depreciation - Machinery and Equipment', 'Technical and Scientific Equipment', '5050105014', 'Active'),
(1499, 'Expenses', 'Non-Cash Expenses', 'Depreciation', 'Depreciation - Machinery and Equipment', 'Other Equipment', '5050105099', 'Active'),
(1500, 'Expenses', 'Non-Cash Expenses', 'Depreciation', 'Depreciation - Transportation Equipment', '', '5050106000', ''),
(1501, 'Expenses', 'Non-Cash Expenses', 'Depreciation', 'Depreciation - Transportation Equipment', 'Motor Vehicles', '5050106001', 'Active'),
(1502, 'Expenses', 'Non-Cash Expenses', 'Depreciation', 'Depreciation - Transportation Equipment', 'Trains', '5050106002', 'Active'),
(1503, 'Expenses', 'Non-Cash Expenses', 'Depreciation', 'Depreciation - Transportation Equipment', 'Aircrafts and Aircrafts Ground Equipment', '5050106003', 'Active'),
(1504, 'Expenses', 'Non-Cash Expenses', 'Depreciation', 'Depreciation - Transportation Equipment', 'Watercrafts', '5050106004', 'Active'),
(1505, 'Expenses', 'Non-Cash Expenses', 'Depreciation', 'Depreciation - Transportation Equipment', 'Other Transportation Equipment', '5050106099', 'Active'),
(1506, 'Expenses', 'Non-Cash Expenses', 'Depreciation', 'Depreciation - Furniture, Fixtures and Books', '', '5050107000', ''),
(1507, 'Expenses', 'Non-Cash Expenses', 'Depreciation', 'Depreciation - Furniture, Fixtures and Books', 'Furniture and Fixtures', '5050107001', 'Active'),
(1508, 'Expenses', 'Non-Cash Expenses', 'Depreciation', 'Depreciation - Furniture, Fixtures and Books', 'Books', '5050107002', 'Active'),
(1509, 'Expenses', 'Non-Cash Expenses', 'Depreciation', 'Depreciation - Leased Assets', '', '5050108000', ''),
(1510, 'Expenses', 'Non-Cash Expenses', 'Depreciation', 'Depreciation - Leased Assets', 'Buildings and Other Structures', '5050108001', 'Active'),
(1511, 'Expenses', 'Non-Cash Expenses', 'Depreciation', 'Depreciation - Leased Assets', 'Machinery and Equipment', '5050108002', 'Active'),
(1512, 'Expenses', 'Non-Cash Expenses', 'Depreciation', 'Depreciation - Leased Assets', 'Transportation Equipment', '5050108003', 'Active'),
(1513, 'Expenses', 'Non-Cash Expenses', 'Depreciation', 'Depreciation - Leased Assets', 'Other Leased Asets', '5050108099', 'Active'),
(1514, 'Expenses', 'Non-Cash Expenses', 'Depreciation', 'Depreciation - Leased Assets Improvements', '', '5050109000', ''),
(1515, 'Expenses', 'Non-Cash Expenses', 'Depreciation', 'Depreciation - Leased Assets Improvements', 'Land', '5050109001', 'Active'),
(1516, 'Expenses', 'Non-Cash Expenses', 'Depreciation', 'Depreciation - Leased Assets Improvements', 'Buildings', '5050109002', 'Active'),
(1517, 'Expenses', 'Non-Cash Expenses', 'Depreciation', 'Depreciation - Leased Assets Improvements', 'Other Leased Assets Improvements', '5050109099', 'Active'),
(1518, 'Expenses', 'Non-Cash Expenses', 'Depreciation', 'Depreciation - Heritage Assets', '', '5050110000', ''),
(1519, 'Expenses', 'Non-Cash Expenses', 'Depreciation', 'Depreciation - Heritage Assets', 'Historical Buildings', '5050110001', 'Active'),
(1520, 'Expenses', 'Non-Cash Expenses', 'Depreciation', 'Depreciation - Heritage Assets', 'Works of Arts and Archeological Specimens', '5050110002', 'Active'),
(1521, 'Expenses', 'Non-Cash Expenses', 'Depreciation', 'Depreciation - Heritage Assets', 'Other Heritage Assets', '5050110099', 'Active'),
(1522, 'Expenses', 'Non-Cash Expenses', 'Depreciation', 'Depreciation - Service Concession Asset', '', '5050111000', ''),
(1523, 'Expenses', 'Non-Cash Expenses', 'Depreciation', 'Depreciation - Service Concession Asset', 'Depreciation - Service Concession Assets', '5050111000', 'Active'),
(1524, 'Expenses', 'Non-Cash Expenses', 'Depreciation', 'Depreciation - Service Concession Asset', 'Road Networks', '5050111001', 'Active'),
(1525, 'Expenses', 'Non-Cash Expenses', 'Depreciation', 'Depreciation - Service Concession Asset', 'Flood Control Systems', '5050111002', 'Active'),
(1526, 'Expenses', 'Non-Cash Expenses', 'Depreciation', 'Depreciation - Service Concession Asset', 'Sewer Systems', '5050111003', 'Active'),
(1527, 'Expenses', 'Non-Cash Expenses', 'Depreciation', 'Depreciation - Service Concession Asset', 'Water Supply Systems', '5050111004', 'Active'),
(1528, 'Expenses', 'Non-Cash Expenses', 'Depreciation', 'Depreciation - Service Concession Asset', 'Power Supply Systems', '5050111005', 'Active'),
(1529, 'Expenses', 'Non-Cash Expenses', 'Depreciation', 'Depreciation - Service Concession Asset', 'Communications Networks', '5050111006', 'Active'),
(1530, 'Expenses', 'Non-Cash Expenses', 'Depreciation', 'Depreciation - Service Concession Asset', 'Seaport Systems', '5050111007', 'Active'),
(1531, 'Expenses', 'Non-Cash Expenses', 'Depreciation', 'Depreciation - Service Concession Asset', 'Airport Systems', '5050111008', 'Active'),
(1532, 'Expenses', 'Non-Cash Expenses', 'Depreciation', 'Depreciation - Service Concession Asset', 'Parks, Plazas and Monuments', '5050111009', 'Active'),
(1533, 'Expenses', 'Non-Cash Expenses', 'Depreciation', 'Depreciation - Service Concession Asset', 'Railway Systems', '5050111010', 'Active');
INSERT INTO `uacs_codes` (`id`, `classification`, `sub_class`, `group_name`, `object_code`, `sub_object_code`, `uacs`, `status`) VALUES
(1534, 'Expenses', 'Non-Cash Expenses', 'Depreciation', 'Depreciation - Service Concession Asset', 'Buildings and Other Structures', '5050111011', 'Active'),
(1535, 'Expenses', 'Non-Cash Expenses', 'Depreciation', 'Depreciation - Service Concession Asset', 'Other Service Concession Assets', '5050111099', 'Active'),
(1536, 'Expenses', 'Non-Cash Expenses', 'Depreciation', 'Depreciation - Other Property, Plant and Equipment', '', '5050199000', ''),
(1537, 'Expenses', 'Non-Cash Expenses', 'Depreciation', 'Depreciation - Other Property, Plant and Equipment', 'Work/Zoo Animals', '5050199001', 'Active'),
(1538, 'Expenses', 'Non-Cash Expenses', 'Depreciation', 'Depreciation - Other Property, Plant and Equipment', 'Other Property, Plant and Equipment', '5050199099', 'Active'),
(1539, 'Expenses', 'Non-Cash Expenses', 'Amortization', '', '', '5050200000', ''),
(1540, 'Expenses', 'Non-Cash Expenses', 'Amortization', 'Amortization - Intangible Assets', '', '5050201000', ''),
(1541, 'Expenses', 'Non-Cash Expenses', 'Amortization', 'Amortization - Intangible Assets', 'Patents/Copyrights', '5050201001', 'Active'),
(1542, 'Expenses', 'Non-Cash Expenses', 'Amortization', 'Amortization - Intangible Assets', 'Computer Software', '5050201002', 'Active'),
(1543, 'Expenses', 'Non-Cash Expenses', 'Amortization', 'Amortization - Intangible Assets', 'Websites', '5050201003', 'Active'),
(1544, 'Expenses', 'Non-Cash Expenses', 'Amortization', 'Amortization - Intangible Assets', 'Other Intangible Assets', '5050201099', 'Active'),
(1545, 'Expenses', 'Non-Cash Expenses', 'Impairment Loss', '', '', '5050300000', ''),
(1546, 'Expenses', 'Non-Cash Expenses', 'Impairment Loss', 'Impairment Loss - Financial Assets Held to Maturity', 'Impairment Loss - Financial Assets Held to Maturity', '5050301000', 'Active'),
(1547, 'Expenses', 'Non-Cash Expenses', 'Impairment Loss', 'Impairment Loss - Loans and Receivables', 'Impairment Loss - Loans and Receivables', '5050302000', 'Inactive'),
(1548, 'Expenses', 'Non-Cash Expenses', 'Impairment Loss', 'Impairment Loss - Loans and Receivables', '', '5050302000', ''),
(1549, 'Expenses', 'Non-Cash Expenses', 'Impairment Loss', 'Impairment Loss - Loans and Receivables', 'Impairment Loss - Other Assets', '5050302000', 'Active'),
(1550, 'Expenses', 'Non-Cash Expenses', 'Impairment Loss', 'Impairment Loss - Lease Receivables', 'Impairment Loss - Lease Receivables', '5050303000', 'Active'),
(1551, 'Expenses', 'Non-Cash Expenses', 'Impairment Loss', 'Impairment Loss - Investments in Government-Owned or Contolled Corporations', '', '5050304000', ''),
(1552, 'Expenses', 'Non-Cash Expenses', 'Impairment Loss', 'Impairment Loss - Investments in Government-Owned or Contolled Corporations', 'Impairment Loss - Investments in GOCCs', '5050304000', 'Active'),
(1553, 'Expenses', 'Non-Cash Expenses', 'Impairment Loss', 'Impairment Loss - Investment in Joint Venture', '', '5050305000', ''),
(1554, 'Expenses', 'Non-Cash Expenses', 'Impairment Loss', 'Impairment Loss - Investment in Joint Venture', 'Impairment Loss - Investments in Joint Venture', '5050305000', 'Active'),
(1555, 'Expenses', 'Non-Cash Expenses', 'Impairment Loss', 'Impairment Loss - Other Receivables', 'Impairment Loss - Other Receivables', '5050306000', 'Active'),
(1556, 'Expenses', 'Non-Cash Expenses', 'Impairment Loss', 'Impairment Loss - Inventories', 'Impairment Loss - Inventories', '5050307000', 'Active'),
(1557, 'Expenses', 'Non-Cash Expenses', 'Impairment Loss', 'Impairment Loss - Investment Property', 'Impairment Loss - Investment Property', '5050308000', 'Active'),
(1558, 'Expenses', 'Non-Cash Expenses', 'Impairment Loss', 'Impairment Loss - Investment Property', '', '5050308000', ''),
(1559, 'Expenses', 'Non-Cash Expenses', 'Impairment Loss', 'Impairment Loss - Investment Property', 'Investment Property, Land', '5050308001', 'Active'),
(1560, 'Expenses', 'Non-Cash Expenses', 'Impairment Loss', 'Impairment Loss - Investment Property', 'Investment Property, Buildings', '5050308002', 'Active'),
(1561, 'Expenses', 'Non-Cash Expenses', 'Impairment Loss', 'Impairment Loss - Property, Plant and Equipment', 'Impairment Loss - Property, Plant and Equipment', '5050309000', 'Active'),
(1562, 'Expenses', 'Non-Cash Expenses', 'Impairment Loss', 'Impairment Loss - Biological Assets', 'Impairment Loss - Biological Assets', '5050310000', 'Active'),
(1563, 'Expenses', 'Non-Cash Expenses', 'Impairment Loss', 'Impairment Loss - Intangible Assets', 'Impairment Loss - Intangible Assets', '5050311000', 'Active'),
(1564, 'Expenses', 'Non-Cash Expenses', 'Impairment Loss', 'Impairment Loss - Intangible Assets', '', '5050311000', ''),
(1565, 'Expenses', 'Non-Cash Expenses', 'Impairment Loss', 'Impairment Loss - Intangible Assets', 'Patents/Copyrights', '5050311001', 'Active'),
(1566, 'Expenses', 'Non-Cash Expenses', 'Impairment Loss', 'Impairment Loss - Intangible Assets', 'Computer Software', '5050311002', 'Active'),
(1567, 'Expenses', 'Non-Cash Expenses', 'Impairment Loss', 'Impairment Loss - Intangible Assets', 'Websites', '5050311003', 'Active'),
(1568, 'Expenses', 'Non-Cash Expenses', 'Impairment Loss', 'Impairment Loss - Intangible Assets', 'Other Intangible Assets', '5050311099', 'Active'),
(1569, 'Expenses', 'Non-Cash Expenses', 'Impairment Loss', 'Impairment Loss - Investments in Associates', 'Impairment Loss - Investments in Associates', '5050312000', 'Inactive'),
(1570, 'Expenses', 'Non-Cash Expenses', 'Losses', '', '', '5050400000', ''),
(1571, 'Expenses', 'Non-Cash Expenses', 'Losses', 'Loss on Foreign Exchange (FOREX)', '', '5050401000', ''),
(1572, 'Expenses', 'Non-Cash Expenses', 'Losses', 'Loss on Foreign Exchange (FOREX)', 'Loss on Foreign Exchange(FOREX)', '5050401000', 'Active'),
(1573, 'Expenses', 'Non-Cash Expenses', 'Losses', 'Loss on Sale of Investments', '', '5050402000', ''),
(1574, 'Expenses', 'Non-Cash Expenses', 'Losses', 'Loss on Sale of Investments', 'Loss on Sale  of Investments', '5050402000', 'Active'),
(1575, 'Expenses', 'Non-Cash Expenses', 'Losses', 'Loss on Sale of Investment Property', 'Loss on Sale of Investment Property', '5050403000', 'Active'),
(1576, 'Expenses', 'Non-Cash Expenses', 'Losses', 'Loss on Sale of Property, Plant and Equipment', '', '5050404000', ''),
(1577, 'Expenses', 'Non-Cash Expenses', 'Losses', 'Loss on Sale of Property, Plant and Equipment', 'Loss on Sale of Property, Plant and Equipment ', '5050404000', 'Active'),
(1578, 'Expenses', 'Non-Cash Expenses', 'Losses', 'Loss on Sale of Biological Assets', 'Loss on Sale of Biological Assets', '5050405000', 'Active'),
(1579, 'Expenses', 'Non-Cash Expenses', 'Losses', 'Loss on Sale of Agricultural Produce ', '', '5050406000', ''),
(1580, 'Expenses', 'Non-Cash Expenses', 'Losses', 'Loss on Sale of Agricultural Produce ', 'Loss on Sale of Agricultural Produce', '5050406000', 'Active'),
(1581, 'Expenses', 'Non-Cash Expenses', 'Losses', 'Loss on Sale of Intangible Assets', 'Loss on Sale of Intangible Assets', '5050407000', 'Active'),
(1582, 'Expenses', 'Non-Cash Expenses', 'Losses', 'Loss on Sale of Assets', 'Loss on Sale of Assets', '5050408000', 'Active'),
(1583, 'Expenses', 'Non-Cash Expenses', 'Losses', 'Loss of Assets', 'Loss of Assets', '5050409000', 'Active'),
(1584, 'Expenses', 'Non-Cash Expenses', 'Losses', 'Loss on Guaranty', '', '5050410000', ''),
(1585, 'Expenses', 'Non-Cash Expenses', 'Losses', 'Loss on Guaranty', 'Loss of Guaranty', '5050410000', 'Inactive'),
(1586, 'Expenses', 'Non-Cash Expenses', 'Losses', 'Loss on Initial Recognition of Biological Assets', 'Loss on Initial Recognition of Biological Assets', '5050411000', 'Active'),
(1587, 'Expenses', 'Non-Cash Expenses', 'Losses', 'Other Losses', 'Other Losses', '5050499000', 'Active'),
(1588, 'Expenses', 'Capital Outlays', '', '', '', '5060000000', ''),
(1589, 'Expenses', 'Capital Outlays', 'Investment Outlay', '', '', '5060100000', ''),
(1590, 'Expenses', 'Capital Outlays', 'Investment Outlay', 'Investment in Government-Owned and/or Controlled Corporations', 'Investment in Government-Owned and/or Controlled Corporations', '5060101001', 'Active'),
(1591, 'Expenses', 'Capital Outlays', 'Investment Outlay', 'Investment in Government-Owned and/or Controlled Corporations', '', '5060101000', ''),
(1592, 'Expenses', 'Capital Outlays', 'Investment Outlay', 'Investment in Government-Owned and/or Controlled Corporations', 'Road Networks', '5060101002', 'Active'),
(1593, 'Expenses', 'Capital Outlays', 'Investment Outlay', 'Investment in Government-Owned and/or Controlled Corporations', 'Flood Control Systems', '5060101003', 'Active'),
(1594, 'Expenses', 'Capital Outlays', 'Investment Outlay', 'Investment in Government-Owned and/or Controlled Corporations', 'Sewer Systems', '5060101004', 'Active'),
(1595, 'Expenses', 'Capital Outlays', 'Investment Outlay', 'Investment in Government-Owned and/or Controlled Corporations', 'Water Supply Systems', '5060101005', 'Active'),
(1596, 'Expenses', 'Capital Outlays', 'Investment Outlay', 'Investment in Government-Owned and/or Controlled Corporations', 'Power Supply Systems', '5060101006', 'Active'),
(1597, 'Expenses', 'Capital Outlays', 'Investment Outlay', 'Investment in Government-Owned and/or Controlled Corporations', 'Communications Networks', '5060101007', 'Active'),
(1598, 'Expenses', 'Capital Outlays', 'Investment Outlay', 'Investment in Government-Owned and/or Controlled Corporations', 'Seaport Systems', '5060101008', 'Active'),
(1599, 'Expenses', 'Capital Outlays', 'Investment Outlay', 'Investment in Government-Owned and/or Controlled Corporations', 'Airport Systems', '5060101009', 'Active'),
(1600, 'Expenses', 'Capital Outlays', 'Investment Outlay', 'Investment in Government-Owned and/or Controlled Corporations', 'Parks, Plazas and Monuments', '5060101010', 'Active'),
(1601, 'Expenses', 'Capital Outlays', 'Investment Outlay', 'Investment in Government-Owned and/or Controlled Corporations', 'Railway Systems', '5060101011', 'Inactive'),
(1602, 'Expenses', 'Capital Outlays', 'Investment Outlay', 'Investment in Government-Owned and/or Controlled Corporations', 'Housing and Community Facilities', '5060101012', 'Inactive'),
(1603, 'Expenses', 'Capital Outlays', 'Investment Outlay', 'Investment in Government-Owned and/or Controlled Corporations', 'Other Infrastructure Assets', '5060101099', 'Active'),
(1604, 'Expenses', 'Capital Outlays', 'Investment Outlay', 'Investment in Associates', 'Investment in Associates', '5060102000', 'Active'),
(1605, 'Expenses', 'Capital Outlays', 'Loans Outlay', '', '', '5060200000', ''),
(1606, 'Expenses', 'Capital Outlays', 'Loans Outlay', 'Loans Outlay - Government-Owned and/or Controlled Corporations', 'Loans Outlay - Government-Owned and/or Controlled Corporations', '5060201000', 'Active'),
(1607, 'Expenses', 'Capital Outlays', 'Loans Outlay', 'Loans Outlay - Local Government Units', 'Loans Outlay - Local Government Units', '5060202000', 'Active'),
(1608, 'Expenses', 'Capital Outlays', 'Loans Outlay', 'Loans Outlay - Others', 'Loans Outlay - Others', '5060299000', 'Active'),
(1609, 'Expenses', 'Capital Outlays', 'Investment Property Outlay', '', '', '5060300000', ''),
(1610, 'Expenses', 'Capital Outlays', 'Investment Property Outlay', 'Land and Buildings Outlay', '', '5060301000', ''),
(1611, 'Expenses', 'Capital Outlays', 'Investment Property Outlay', 'Land and Buildings Outlay', 'Investment Property - Land', '5060301001', 'Active'),
(1612, 'Expenses', 'Capital Outlays', 'Investment Property Outlay', 'Land and Buildings Outlay', 'Investment Property - Buildings', '5060301002', 'Active'),
(1613, 'Expenses', 'Capital Outlays', 'Property, Plant and Equipment Outlay', '', '', '5060400000', ''),
(1614, 'Expenses', 'Capital Outlays', 'Property, Plant and Equipment Outlay', 'Land Outlay', '', '5060401000', ''),
(1615, 'Expenses', 'Capital Outlays', 'Property, Plant and Equipment Outlay', 'Land Outlay', 'Land', '5060401001', 'Active'),
(1616, 'Expenses', 'Capital Outlays', 'Property, Plant and Equipment Outlay', 'Land Improvements Outlay', '', '5060402000', ''),
(1617, 'Expenses', 'Capital Outlays', 'Property, Plant and Equipment Outlay', 'Land Improvements Outlay', 'Aquaculture Structures', '5060402001', 'Active'),
(1618, 'Expenses', 'Capital Outlays', 'Property, Plant and Equipment Outlay', 'Land Improvements Outlay', 'Reforestation Projects', '5060402002', 'Active'),
(1619, 'Expenses', 'Capital Outlays', 'Property, Plant and Equipment Outlay', 'Land Improvements Outlay', 'Other Land Improvements', '5060402099', 'Active'),
(1620, 'Expenses', 'Capital Outlays', 'Property, Plant and Equipment Outlay', 'Infrastructure Outlay', '', '5060403000', ''),
(1621, 'Expenses', 'Capital Outlays', 'Property, Plant and Equipment Outlay', 'Infrastructure Outlay', 'Road Networks', '5060403001', 'Active'),
(1622, 'Expenses', 'Capital Outlays', 'Property, Plant and Equipment Outlay', 'Infrastructure Outlay', 'Flood Control Systems', '5060403002', 'Active'),
(1623, 'Expenses', 'Capital Outlays', 'Property, Plant and Equipment Outlay', 'Infrastructure Outlay', 'Sewer Systems', '5060403003', 'Active'),
(1624, 'Expenses', 'Capital Outlays', 'Property, Plant and Equipment Outlay', 'Infrastructure Outlay', 'Water Supply Systems', '5060403004', 'Active'),
(1625, 'Expenses', 'Capital Outlays', 'Property, Plant and Equipment Outlay', 'Infrastructure Outlay', 'Power Supply Systems', '5060403005', 'Active'),
(1626, 'Expenses', 'Capital Outlays', 'Property, Plant and Equipment Outlay', 'Infrastructure Outlay', 'Communications Networks', '5060403006', 'Active'),
(1627, 'Expenses', 'Capital Outlays', 'Property, Plant and Equipment Outlay', 'Infrastructure Outlay', 'Seaport Systems', '5060403007', 'Active'),
(1628, 'Expenses', 'Capital Outlays', 'Property, Plant and Equipment Outlay', 'Infrastructure Outlay', 'Airport Systems', '5060403008', 'Active'),
(1629, 'Expenses', 'Capital Outlays', 'Property, Plant and Equipment Outlay', 'Infrastructure Outlay', 'Parks, Plazas and Monuments', '5060403009', 'Active'),
(1630, 'Expenses', 'Capital Outlays', 'Property, Plant and Equipment Outlay', 'Infrastructure Outlay', 'Railway Systems', '5060403010', 'Inactive'),
(1631, 'Expenses', 'Capital Outlays', 'Property, Plant and Equipment Outlay', 'Infrastructure Outlay', 'Right-of-Way', '5060403011', 'Inactive'),
(1632, 'Expenses', 'Capital Outlays', 'Property, Plant and Equipment Outlay', 'Infrastructure Outlay', 'Other Infrastructure Assets', '5060403099', 'Active'),
(1633, 'Expenses', 'Capital Outlays', 'Property, Plant and Equipment Outlay', 'Building and Other Structures Outlay', '', '5060404000', ''),
(1634, 'Expenses', 'Capital Outlays', 'Property, Plant and Equipment Outlay', 'Building and Other Structures Outlay', 'Buildings', '5060404001', 'Active'),
(1635, 'Expenses', 'Capital Outlays', 'Property, Plant and Equipment Outlay', 'Building and Other Structures Outlay', 'School Buildings', '5060404002', 'Active'),
(1636, 'Expenses', 'Capital Outlays', 'Property, Plant and Equipment Outlay', 'Building and Other Structures Outlay', 'Hospitals and Health Centers', '5060404003', 'Active'),
(1637, 'Expenses', 'Capital Outlays', 'Property, Plant and Equipment Outlay', 'Building and Other Structures Outlay', 'Markets', '5060404004', 'Active'),
(1638, 'Expenses', 'Capital Outlays', 'Property, Plant and Equipment Outlay', 'Building and Other Structures Outlay', 'Slaughterhouses', '5060404005', 'Active'),
(1639, 'Expenses', 'Capital Outlays', 'Property, Plant and Equipment Outlay', 'Building and Other Structures Outlay', 'Hostels and Dormitories', '5060404006', 'Active'),
(1640, 'Expenses', 'Capital Outlays', 'Property, Plant and Equipment Outlay', 'Building and Other Structures Outlay', 'Ground Water Monitoring Stations', '5060404007', 'Active'),
(1641, 'Expenses', 'Capital Outlays', 'Property, Plant and Equipment Outlay', 'Building and Other Structures Outlay', 'Other Structures', '5060404099', 'Active'),
(1642, 'Expenses', 'Capital Outlays', 'Property, Plant and Equipment Outlay', 'Machinery and Equipment Outlay', '', '5060405000', ''),
(1643, 'Expenses', 'Capital Outlays', 'Property, Plant and Equipment Outlay', 'Machinery and Equipment Outlay', 'Machinery', '5060405001', 'Active'),
(1644, 'Expenses', 'Capital Outlays', 'Property, Plant and Equipment Outlay', 'Machinery and Equipment Outlay', 'Office Equipment', '5060405002', 'Active'),
(1645, 'Expenses', 'Capital Outlays', 'Property, Plant and Equipment Outlay', 'Machinery and Equipment Outlay', 'Information and Communication Technology Equipment', '5060405003', 'Active'),
(1646, 'Expenses', 'Capital Outlays', 'Property, Plant and Equipment Outlay', 'Machinery and Equipment Outlay', 'Agricultural and Forestry Equipment', '5060405004', 'Active'),
(1647, 'Expenses', 'Capital Outlays', 'Property, Plant and Equipment Outlay', 'Machinery and Equipment Outlay', 'Marine and Fishery Equipment', '5060405005', 'Active'),
(1648, 'Expenses', 'Capital Outlays', 'Property, Plant and Equipment Outlay', 'Machinery and Equipment Outlay', 'Airport Equipment', '5060405006', 'Active'),
(1649, 'Expenses', 'Capital Outlays', 'Property, Plant and Equipment Outlay', 'Machinery and Equipment Outlay', 'Communications Equipment', '5060405007', 'Active'),
(1650, 'Expenses', 'Capital Outlays', 'Property, Plant and Equipment Outlay', 'Machinery and Equipment Outlay', 'Construction and Heavy Equipment', '5060405008', 'Active'),
(1651, 'Expenses', 'Capital Outlays', 'Property, Plant and Equipment Outlay', 'Machinery and Equipment Outlay', 'Disaster Response and Rescue Equipment', '5060405009', 'Active'),
(1652, 'Expenses', 'Capital Outlays', 'Property, Plant and Equipment Outlay', 'Machinery and Equipment Outlay', 'Military, Police and Security Equipment', '5060405010', 'Active'),
(1653, 'Expenses', 'Capital Outlays', 'Property, Plant and Equipment Outlay', 'Machinery and Equipment Outlay', 'Medical Equipment', '5060405011', 'Active'),
(1654, 'Expenses', 'Capital Outlays', 'Property, Plant and Equipment Outlay', 'Machinery and Equipment Outlay', 'Printing Equipment', '5060405012', 'Active'),
(1655, 'Expenses', 'Capital Outlays', 'Property, Plant and Equipment Outlay', 'Machinery and Equipment Outlay', 'Sports Equipment', '5060405013', 'Active'),
(1656, 'Expenses', 'Capital Outlays', 'Property, Plant and Equipment Outlay', 'Machinery and Equipment Outlay', 'Technical and Scientific Equipment', '5060405014', 'Active'),
(1657, 'Expenses', 'Capital Outlays', 'Property, Plant and Equipment Outlay', 'Machinery and Equipment Outlay', 'ICT Software', '5060405015', 'Active'),
(1658, 'Expenses', 'Capital Outlays', 'Property, Plant and Equipment Outlay', 'Machinery and Equipment Outlay', 'Other Machinery and Equipment', '5060405099', 'Active'),
(1659, 'Expenses', 'Capital Outlays', 'Property, Plant and Equipment Outlay', 'Transportation Equipment Outlay', '', '5060406000', ''),
(1660, 'Expenses', 'Capital Outlays', 'Property, Plant and Equipment Outlay', 'Transportation Equipment Outlay', 'Motor Vehicles', '5060406001', 'Active'),
(1661, 'Expenses', 'Capital Outlays', 'Property, Plant and Equipment Outlay', 'Transportation Equipment Outlay', 'Trains', '5060406002', 'Active'),
(1662, 'Expenses', 'Capital Outlays', 'Property, Plant and Equipment Outlay', 'Transportation Equipment Outlay', 'Aircrafts and Aircrafts Ground Equipment', '5060406003', 'Active'),
(1663, 'Expenses', 'Capital Outlays', 'Property, Plant and Equipment Outlay', 'Transportation Equipment Outlay', 'Watercrafts', '5060406004', 'Active'),
(1664, 'Expenses', 'Capital Outlays', 'Property, Plant and Equipment Outlay', 'Transportation Equipment Outlay', 'Other Transportation Equipment', '5060406099', 'Active'),
(1665, 'Expenses', 'Capital Outlays', 'Property, Plant and Equipment Outlay', 'Furniture, Fixtures and Books Outlay', '', '5060407000', ''),
(1666, 'Expenses', 'Capital Outlays', 'Property, Plant and Equipment Outlay', 'Furniture, Fixtures and Books Outlay', 'Furniture and Fixtures', '5060407001', 'Active'),
(1667, 'Expenses', 'Capital Outlays', 'Property, Plant and Equipment Outlay', 'Furniture, Fixtures and Books Outlay', 'Books', '5060407002', 'Active'),
(1668, 'Expenses', 'Capital Outlays', 'Property, Plant and Equipment Outlay', 'Heritage Assets', '', '5060408000', ''),
(1669, 'Expenses', 'Capital Outlays', 'Property, Plant and Equipment Outlay', 'Heritage Assets', 'Historical Buildings', '5060408001', 'Active'),
(1670, 'Expenses', 'Capital Outlays', 'Property, Plant and Equipment Outlay', 'Heritage Assets', 'Works of Arts and Archeological Specimens', '5060408002', 'Active'),
(1671, 'Expenses', 'Capital Outlays', 'Property, Plant and Equipment Outlay', 'Heritage Assets', 'Other Heritage Assets', '5060408099', 'Active'),
(1672, 'Expenses', 'Capital Outlays', 'Property, Plant and Equipment Outlay', 'Other Property, Plant and Equipment Outlay', '', '5060409000', ''),
(1673, 'Expenses', 'Capital Outlays', 'Property, Plant and Equipment Outlay', 'Other Property, Plant and Equipment Outlay', 'Work/Zoo Animals', '5060409001', 'Active'),
(1674, 'Expenses', 'Capital Outlays', 'Property, Plant and Equipment Outlay', 'Other Property, Plant and Equipment Outlay', 'Other Property, Plant and Equipment', '5060409099', 'Active'),
(1675, 'Expenses', 'Capital Outlays', 'Property, Plant and Equipment Outlay', 'Leased Assets Improvements', '', '5060410000', ''),
(1676, 'Expenses', 'Capital Outlays', 'Property, Plant and Equipment Outlay', 'Leased Assets Improvements', 'Other Leased Assets Improvements', '5060410099', 'Inactive'),
(1677, 'Expenses', 'Capital Outlays', 'Biological Assets Outlay', '', '', '5060500000', ''),
(1678, 'Expenses', 'Capital Outlays', 'Biological Assets Outlay', 'Bearer Biological Assets', '', '5060501000', ''),
(1679, 'Expenses', 'Capital Outlays', 'Biological Assets Outlay', 'Bearer Biological Assets', 'Breeding Stocks', '5060501001', 'Active'),
(1680, 'Expenses', 'Capital Outlays', 'Biological Assets Outlay', 'Bearer Biological Assets', 'Livestock', '5060501002', 'Active'),
(1681, 'Expenses', 'Capital Outlays', 'Biological Assets Outlay', 'Bearer Biological Assets', 'Trees, Plants and Crops', '5060501003', 'Active'),
(1682, 'Expenses', 'Capital Outlays', 'Biological Assets Outlay', 'Bearer Biological Assets', 'Aquaculture', '5060501004', 'Active'),
(1683, 'Expenses', 'Capital Outlays', 'Biological Assets Outlay', 'Bearer Biological Assets', 'Other Bearer Biological Assets', '5060501099', 'Active'),
(1684, 'Expenses', 'Capital Outlays', 'Intangible Assets Outlay', '', '', '5060600000', ''),
(1685, 'Expenses', 'Capital Outlays', 'Intangible Assets Outlay', 'Patents/Copyrights', 'Patents/Copyrights', '5060601000', 'Active'),
(1686, 'Expenses', 'Capital Outlays', 'Intangible Assets Outlay', 'Computer Software', 'Computer Software', '5060602000', 'Active'),
(1687, 'Expenses', 'Capital Outlays', 'Intangible Assets Outlay', 'Other Intangible Assets', 'Other Intangible Assets', '5060699000', 'Active'),
(1704, '12345', '1234', '12345', '12345', '12345', '12345', '2');

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `unit_id` int(11) NOT NULL,
  `unit_code` varchar(10) NOT NULL,
  `unit_name` varchar(50) NOT NULL,
  `unit_description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`unit_id`, `unit_code`, `unit_name`, `unit_description`) VALUES
(1, 'pc', 'Piece', 'Individual unit'),
(2, 'box', 'Box', 'Container holding multiple items'),
(3, 'pks', 'Pack', 'Package containing multiple items'),
(4, 'btls', 'Bottle', 'Container for liquids'),
(5, 'roll', 'Roll', 'Item wound around a central core'),
(6, 'doz', 'Dozen', 'Group of twelve items'),
(7, 'set', 'Set', 'Collection of related items'),
(8, 'kg', 'Kilogram', 'Unit of mass'),
(9, 'ltr', 'Liter', 'Unit of volume'),
(10, 'm', 'Meter', 'Unit of length'),
(11, 'bdl', 'Bundle', 'Collection of items tied together'),
(12, 'gal', 'Gallon', 'Unit of volume'),
(13, 'pack', 'Pack', 'Package containing multiple items'),
(14, 'pair', 'Pair', 'Group of two items'),
(15, 'case', 'Case', 'Large container holding multiple items'),
(16, 'tab', 'Tablet', 'Small, compressed medicine'),
(17, 'tube', 'Tube', 'Cylindrical container for paste or cream'),
(18, 'sachet', 'Sachet', 'Small, single-use packet'),
(19, 'ream', 'Ream', 'Group of 500 sheets of paper'),
(20, 'ctn', 'Carton', 'Box made of cardboard'),
(21, 'packs', 'Packs', 'Multiple packages grouped together'),
(22, 'pax', 'Pax', 'Unit typically representing \"per person\" in events'),
(23, 'unit', 'Unit', 'A single, individual item'),
(24, 'pcs', 'Pieces', 'Individual pieces of an item (often small items)');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `arrived_items`
--
ALTER TABLE `arrived_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `delivery_term`
--
ALTER TABLE `delivery_term`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `end_users`
--
ALTER TABLE `end_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `iar_creation_trail`
--
ALTER TABLE `iar_creation_trail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_iar_creation_trail_iar_id` (`iar_id`),
  ADD KEY `fk_iar_creation_trail_created_by` (`created_by`);

--
-- Indexes for table `iar_item_details`
--
ALTER TABLE `iar_item_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `iar_id` (`iar_id`);

--
-- Indexes for table `iar_item_labels`
--
ALTER TABLE `iar_item_labels`
  ADD PRIMARY KEY (`id`),
  ADD KEY `iar_item_labels_ibfk_1` (`iar_id`);

--
-- Indexes for table `iar_item_specifications`
--
ALTER TABLE `iar_item_specifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `iar_id` (`iar_id`);

--
-- Indexes for table `iar_notifications`
--
ALTER TABLE `iar_notifications`
  ADD PRIMARY KEY (`iar_notification_id`);

--
-- Indexes for table `iar_update_trail`
--
ALTER TABLE `iar_update_trail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_iar_update_trail_iar_id` (`iar_id`),
  ADD KEY `fk_iar_update_trail_updated_by` (`updated_by`);

--
-- Indexes for table `igf`
--
ALTER TABLE `igf`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inspection_acceptance_report`
--
ALTER TABLE `inspection_acceptance_report`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mode_procurement`
--
ALTER TABLE `mode_procurement`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`notification_id`);

--
-- Indexes for table `office`
--
ALTER TABLE `office`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `po_creation_trail`
--
ALTER TABLE `po_creation_trail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_po_creation_trail_po_id` (`po_id`),
  ADD KEY `fk_po_creation_trail_created_by` (`created_by`);

--
-- Indexes for table `po_item_specifications`
--
ALTER TABLE `po_item_specifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `po_item_specifications_ibfk_1` (`po_id`);

--
-- Indexes for table `po_login_logs`
--
ALTER TABLE `po_login_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_po_login_logs_user_id` (`user_id`);

--
-- Indexes for table `po_notifications`
--
ALTER TABLE `po_notifications`
  ADD PRIMARY KEY (`po_notification_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `po_id` (`po_id`);

--
-- Indexes for table `po_update_trail`
--
ALTER TABLE `po_update_trail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_po_update_trail_po_id` (`po_id`),
  ADD KEY `fk_po_update_trail_updated_by` (`updated_by`);

--
-- Indexes for table `po_users`
--
ALTER TABLE `po_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `purchase_orders`
--
ALTER TABLE `purchase_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_order_items`
--
ALTER TABLE `purchase_order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `po_id` (`po_id`);

--
-- Indexes for table `purchase_order_labels`
--
ALTER TABLE `purchase_order_labels`
  ADD PRIMARY KEY (`id`),
  ADD KEY `purchase_order_labels_ibfk_1` (`po_id`);

--
-- Indexes for table `raf`
--
ALTER TABLE `raf`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `so_login_logs`
--
ALTER TABLE `so_login_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_so_login_logs_user_id` (`user_id`);

--
-- Indexes for table `so_users`
--
ALTER TABLE `so_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`supplier_id`);

--
-- Indexes for table `uacs_codes`
--
ALTER TABLE `uacs_codes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`unit_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `arrived_items`
--
ALTER TABLE `arrived_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=241;

--
-- AUTO_INCREMENT for table `delivery_term`
--
ALTER TABLE `delivery_term`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `end_users`
--
ALTER TABLE `end_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `iar_creation_trail`
--
ALTER TABLE `iar_creation_trail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `iar_item_details`
--
ALTER TABLE `iar_item_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=820;

--
-- AUTO_INCREMENT for table `iar_item_labels`
--
ALTER TABLE `iar_item_labels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=149;

--
-- AUTO_INCREMENT for table `iar_item_specifications`
--
ALTER TABLE `iar_item_specifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `iar_notifications`
--
ALTER TABLE `iar_notifications`
  MODIFY `iar_notification_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `iar_update_trail`
--
ALTER TABLE `iar_update_trail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `inspection_acceptance_report`
--
ALTER TABLE `inspection_acceptance_report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- AUTO_INCREMENT for table `mode_procurement`
--
ALTER TABLE `mode_procurement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `notification_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `office`
--
ALTER TABLE `office`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `po_creation_trail`
--
ALTER TABLE `po_creation_trail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `po_item_specifications`
--
ALTER TABLE `po_item_specifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;

--
-- AUTO_INCREMENT for table `po_login_logs`
--
ALTER TABLE `po_login_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=193;

--
-- AUTO_INCREMENT for table `po_notifications`
--
ALTER TABLE `po_notifications`
  MODIFY `po_notification_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `po_update_trail`
--
ALTER TABLE `po_update_trail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `po_users`
--
ALTER TABLE `po_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `purchase_orders`
--
ALTER TABLE `purchase_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=526;

--
-- AUTO_INCREMENT for table `purchase_order_items`
--
ALTER TABLE `purchase_order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=610;

--
-- AUTO_INCREMENT for table `purchase_order_labels`
--
ALTER TABLE `purchase_order_labels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=391;

--
-- AUTO_INCREMENT for table `so_login_logs`
--
ALTER TABLE `so_login_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=427;

--
-- AUTO_INCREMENT for table `so_users`
--
ALTER TABLE `so_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `supplier_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `uacs_codes`
--
ALTER TABLE `uacs_codes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1705;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `unit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `iar_creation_trail`
--
ALTER TABLE `iar_creation_trail`
  ADD CONSTRAINT `fk_iar_creation_trail_created_by` FOREIGN KEY (`created_by`) REFERENCES `so_users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_iar_creation_trail_iar_id` FOREIGN KEY (`iar_id`) REFERENCES `inspection_acceptance_report` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `iar_creation_trail_ibfk_1` FOREIGN KEY (`iar_id`) REFERENCES `inspection_acceptance_report` (`id`),
  ADD CONSTRAINT `iar_creation_trail_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `so_users` (`id`);

--
-- Constraints for table `iar_item_details`
--
ALTER TABLE `iar_item_details`
  ADD CONSTRAINT `iar_item_details_ibfk_1` FOREIGN KEY (`iar_id`) REFERENCES `inspection_acceptance_report` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `iar_item_labels`
--
ALTER TABLE `iar_item_labels`
  ADD CONSTRAINT `iar_item_labels_ibfk_1` FOREIGN KEY (`iar_id`) REFERENCES `inspection_acceptance_report` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `iar_item_specifications`
--
ALTER TABLE `iar_item_specifications`
  ADD CONSTRAINT `iar_item_specifications_ibfk_1` FOREIGN KEY (`iar_id`) REFERENCES `inspection_acceptance_report` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `iar_update_trail`
--
ALTER TABLE `iar_update_trail`
  ADD CONSTRAINT `fk_iar_update_trail_iar_id` FOREIGN KEY (`iar_id`) REFERENCES `inspection_acceptance_report` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_iar_update_trail_updated_by` FOREIGN KEY (`updated_by`) REFERENCES `so_users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `iar_update_trail_ibfk_1` FOREIGN KEY (`iar_id`) REFERENCES `inspection_acceptance_report` (`id`),
  ADD CONSTRAINT `iar_update_trail_ibfk_2` FOREIGN KEY (`updated_by`) REFERENCES `so_users` (`id`);

--
-- Constraints for table `po_creation_trail`
--
ALTER TABLE `po_creation_trail`
  ADD CONSTRAINT `fk_po_creation_trail_created_by` FOREIGN KEY (`created_by`) REFERENCES `po_users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_po_creation_trail_po_id` FOREIGN KEY (`po_id`) REFERENCES `purchase_orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `po_creation_trail_ibfk_1` FOREIGN KEY (`po_id`) REFERENCES `purchase_orders` (`id`),
  ADD CONSTRAINT `po_creation_trail_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `po_users` (`id`);

--
-- Constraints for table `po_item_specifications`
--
ALTER TABLE `po_item_specifications`
  ADD CONSTRAINT `po_item_specifications_ibfk_1` FOREIGN KEY (`po_id`) REFERENCES `purchase_orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `po_login_logs`
--
ALTER TABLE `po_login_logs`
  ADD CONSTRAINT `fk_po_login_logs_user_id` FOREIGN KEY (`user_id`) REFERENCES `po_users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `po_login_logs_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `po_users` (`id`);

--
-- Constraints for table `po_notifications`
--
ALTER TABLE `po_notifications`
  ADD CONSTRAINT `po_notifications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `po_users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `po_notifications_ibfk_2` FOREIGN KEY (`po_id`) REFERENCES `purchase_orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `po_update_trail`
--
ALTER TABLE `po_update_trail`
  ADD CONSTRAINT `fk_po_update_trail_po_id` FOREIGN KEY (`po_id`) REFERENCES `purchase_orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_po_update_trail_updated_by` FOREIGN KEY (`updated_by`) REFERENCES `po_users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `po_update_trail_ibfk_1` FOREIGN KEY (`po_id`) REFERENCES `purchase_orders` (`id`),
  ADD CONSTRAINT `po_update_trail_ibfk_2` FOREIGN KEY (`updated_by`) REFERENCES `po_users` (`id`);

--
-- Constraints for table `purchase_order_items`
--
ALTER TABLE `purchase_order_items`
  ADD CONSTRAINT `purchase_order_items_ibfk_1` FOREIGN KEY (`po_id`) REFERENCES `purchase_orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `purchase_order_labels`
--
ALTER TABLE `purchase_order_labels`
  ADD CONSTRAINT `purchase_order_labels_ibfk_1` FOREIGN KEY (`po_id`) REFERENCES `purchase_orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `so_login_logs`
--
ALTER TABLE `so_login_logs`
  ADD CONSTRAINT `fk_so_login_logs_user_id` FOREIGN KEY (`user_id`) REFERENCES `so_users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `so_login_logs_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `so_users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
