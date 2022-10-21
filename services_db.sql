-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 21, 2022 at 01:42 PM
-- Server version: 5.7.34
-- PHP Version: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `services_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `verification_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`, `verification_token`) VALUES
(1, 'admin', 'sGDXidM9JQUfQc5ns-CwbsTR6QnD4chC', '$2y$13$.G88QQ.oi6ciHYwoUIKy5uxN9iVW7GCcLo6cT.vIq5kqe1J.rBqzi', NULL, 'admin@codendot.com', 10, '2022-10-13 13:10:20', '2022-10-13 13:10:20', '15LIoMzQ2KORjYKUDzGOvFbHHB5klB_A_1665666620');

-- --------------------------------------------------------

--
-- Table structure for table `attributes`
--

CREATE TABLE `attributes` (
  `id` int(11) NOT NULL,
  `service` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `attributes`
--

INSERT INTO `attributes` (`id`, `service`, `type`, `name`) VALUES
(2, 1, 1, 'Monthly'),
(3, 1, 1, 'Wish Money'),
(5, 1, 2, 'Package'),
(6, 2, 1, 'cha3er'),
(7, 2, 1, 'da2en'),
(8, 2, 1, 'temchit'),
(9, 2, 2, 'bchu bdk tmachet'),
(10, 2, 1, 'chame3');

-- --------------------------------------------------------

--
-- Table structure for table `attribute_options`
--

CREATE TABLE `attribute_options` (
  `id` int(11) NOT NULL,
  `attribute` int(11) NOT NULL,
  `value` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `attribute_options`
--

INSERT INTO `attribute_options` (`id`, `attribute`, `value`) VALUES
(9, 5, '5Gb'),
(10, 5, '10Gb'),
(11, 9, 'wax'),
(12, 9, 'djel');

-- --------------------------------------------------------

--
-- Table structure for table `attribute_types`
--

CREATE TABLE `attribute_types` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `html_value` varchar(255) NOT NULL,
  `has_options` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `attribute_types`
--

INSERT INTO `attribute_types` (`id`, `name`, `html_value`, `has_options`) VALUES
(1, 'Text', 'text', 0),
(2, 'dropdown', 'dropdown', 1),
(3, 'Number', 'number', 0);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `active` int(1) DEFAULT '1',
  `description` text,
  `in_menu` int(1) DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `parent` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `active`, `description`, `in_menu`, `created_at`, `updated_at`, `parent`) VALUES
(5, 'Barber', 1, 'Barber Category', 1, '2022-10-14 08:01:56', '2022-10-14 08:01:56', NULL),
(6, 'Technology', 1, '', 1, '2022-10-14 08:02:24', '2022-10-14 08:03:13', NULL),
(7, 'Development', 1, '', 1, '2022-10-14 08:03:27', '2022-10-14 08:03:27', 6),
(8, 'Web Development', 1, '', 1, '2022-10-14 08:03:45', '2022-10-14 08:03:45', 7),
(9, 'Mobile Development', 1, '', 1, '2022-10-14 08:03:59', '2022-10-14 08:03:59', 7),
(10, 'Network', 1, '', 1, '2022-10-14 08:04:33', '2022-10-21 08:12:09', NULL),
(11, 'Mobile Recharge', 1, '', 1, '2022-10-14 08:05:13', '2022-10-20 13:52:36', 10),
(12, 'Alfa', 1, '', 1, '2022-10-14 08:05:23', '2022-10-21 06:23:56', 11),
(14, 'Cards', 1, '', 1, '2022-10-14 08:05:51', '2022-10-14 08:05:51', 12),
(15, 'Ushare', 1, '', 1, '2022-10-14 08:06:02', '2022-10-14 08:06:02', 12),
(16, 'Mtc', 1, '', 1, '2022-10-17 06:48:09', '2022-10-17 06:48:09', 11);

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `id` int(11) NOT NULL,
  `x` float DEFAULT NULL,
  `y` float DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `address` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1665666345),
('m130524_201442_init', 1665666347),
('m190124_110200_add_verification_token_column_to_user_table', 1665666347),
('m221014_072019_create_categories_table', 1665732069),
('m221014_072552_add_parent_column_to_categories_table', 1665732366),
('m221014_085315_create_services_table', 1665743070),
('m221014_101529_create_attribute_types_table', 1665743208),
('m221014_102059_create_attributes_table', 1665743209),
('m221014_102404_create_attribute_options_table', 1665743209),
('m221014_111041_add_active_column_to_services_table', 1665745849),
('m221014_111254_create_services_images_table', 1665745989),
('m221017_133604_add_type_column_to_user_table', 1666013833),
('m221018_114220_create_providers_services_table', 1666093763),
('m221018_114630_create_providers_services_attributes_table', 1666099597),
('m221019_070858_create_locations_table', 1666163378),
('m221019_072111_add_address_column_to_locations_table', 1666164077),
('m221019_110349_create_services_days_table', 1666177839),
('m221019_111001_create_schedules_table', 1666183319),
('m221021_133737_create_users_services_table', 1666359582),
('m221021_133900_create_users_services_attributes_table', 1666359582),
('m221021_133923_create_users_services_datetime_table', 1666359583);

-- --------------------------------------------------------

--
-- Table structure for table `providers_services`
--

CREATE TABLE `providers_services` (
  `id` int(11) NOT NULL,
  `user` int(11) DEFAULT NULL,
  `service` int(11) DEFAULT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `providers_services`
--

INSERT INTO `providers_services` (`id`, `user`, `service`, `price`) VALUES
(6, 4, 1, 200000),
(7, 2, 1, 180000);

-- --------------------------------------------------------

--
-- Table structure for table `providers_services_attributes`
--

CREATE TABLE `providers_services_attributes` (
  `id` int(11) NOT NULL,
  `entity_id` int(11) DEFAULT NULL,
  `attribute` int(11) DEFAULT NULL,
  `option` varchar(255) DEFAULT NULL,
  `price` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `providers_services_attributes`
--

INSERT INTO `providers_services_attributes` (`id`, `entity_id`, `attribute`, `option`, `price`) VALUES
(22, 6, 3, NULL, 10000),
(23, 6, 5, '10', 270000),
(24, 7, 3, NULL, 10000),
(25, 7, 5, '10', 260000);

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

CREATE TABLE `schedules` (
  `id` int(11) NOT NULL,
  `day` int(11) NOT NULL,
  `from` time NOT NULL,
  `to` time NOT NULL,
  `duration` int(11) NOT NULL,
  `user` int(11) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `schedules`
--

INSERT INTO `schedules` (`id`, `day`, `from`, `to`, `duration`, `user`, `status`, `created_at`, `updated_at`) VALUES
(198, 14, '18:00:00', '18:30:00', 30, NULL, 'available', '2022-10-21 13:16:32', '2022-10-21 13:16:32'),
(199, 14, '18:30:00', '19:00:00', 30, NULL, 'available', '2022-10-21 13:16:32', '2022-10-21 13:16:32'),
(200, 14, '19:00:00', '19:30:00', 30, NULL, 'available', '2022-10-21 13:16:32', '2022-10-21 13:16:32'),
(201, 14, '19:30:00', '20:00:00', 30, NULL, 'available', '2022-10-21 13:16:32', '2022-10-21 13:16:32'),
(202, 14, '20:00:00', '20:30:00', 30, NULL, 'available', '2022-10-21 13:16:32', '2022-10-21 13:16:32'),
(203, 14, '20:30:00', '21:00:00', 30, NULL, 'available', '2022-10-21 13:16:32', '2022-10-21 13:16:32'),
(204, 15, '18:00:00', '18:30:00', 30, NULL, 'available', '2022-10-21 13:16:32', '2022-10-21 13:16:32'),
(205, 15, '18:30:00', '19:00:00', 30, NULL, 'available', '2022-10-21 13:16:32', '2022-10-21 13:16:32'),
(206, 15, '19:00:00', '19:30:00', 30, NULL, 'available', '2022-10-21 13:16:32', '2022-10-21 13:16:32'),
(207, 15, '19:30:00', '20:00:00', 30, NULL, 'available', '2022-10-21 13:16:32', '2022-10-21 13:16:32'),
(208, 15, '20:00:00', '20:30:00', 30, NULL, 'available', '2022-10-21 13:16:32', '2022-10-21 13:16:32'),
(209, 15, '20:30:00', '21:00:00', 30, NULL, 'available', '2022-10-21 13:16:32', '2022-10-21 13:16:32'),
(210, 16, '13:00:00', '14:00:00', 60, NULL, 'available', '2022-10-21 13:17:30', '2022-10-21 13:17:30'),
(211, 16, '14:00:00', '15:00:00', 60, NULL, 'available', '2022-10-21 13:17:30', '2022-10-21 13:17:30'),
(212, 16, '15:00:00', '16:00:00', 60, NULL, 'available', '2022-10-21 13:17:30', '2022-10-21 13:17:30'),
(213, 16, '16:00:00', '17:00:00', 60, NULL, 'available', '2022-10-21 13:17:30', '2022-10-21 13:17:30'),
(214, 16, '17:00:00', '18:00:00', 60, NULL, 'available', '2022-10-21 13:17:30', '2022-10-21 13:17:30'),
(215, 16, '18:00:00', '19:00:00', 60, NULL, 'available', '2022-10-21 13:17:30', '2022-10-21 13:17:30'),
(216, 16, '19:00:00', '20:00:00', 60, NULL, 'available', '2022-10-21 13:17:30', '2022-10-21 13:17:30'),
(217, 17, '13:00:00', '14:00:00', 60, NULL, 'available', '2022-10-21 13:17:30', '2022-10-21 13:17:30'),
(218, 17, '14:00:00', '15:00:00', 60, NULL, 'available', '2022-10-21 13:17:30', '2022-10-21 13:17:30'),
(219, 17, '15:00:00', '16:00:00', 60, NULL, 'available', '2022-10-21 13:17:30', '2022-10-21 13:17:30'),
(220, 17, '16:00:00', '17:00:00', 60, NULL, 'available', '2022-10-21 13:17:30', '2022-10-21 13:17:30'),
(221, 17, '17:00:00', '18:00:00', 60, NULL, 'available', '2022-10-21 13:17:30', '2022-10-21 13:17:30'),
(222, 17, '18:00:00', '19:00:00', 60, NULL, 'available', '2022-10-21 13:17:30', '2022-10-21 13:17:30'),
(223, 17, '19:00:00', '20:00:00', 60, NULL, 'available', '2022-10-21 13:17:30', '2022-10-21 13:17:30'),
(224, 18, '13:00:00', '14:00:00', 60, NULL, 'available', '2022-10-21 13:17:30', '2022-10-21 13:17:30'),
(225, 18, '14:00:00', '15:00:00', 60, NULL, 'available', '2022-10-21 13:17:30', '2022-10-21 13:17:30'),
(226, 18, '15:00:00', '16:00:00', 60, NULL, 'available', '2022-10-21 13:17:30', '2022-10-21 13:17:30'),
(227, 18, '16:00:00', '17:00:00', 60, NULL, 'available', '2022-10-21 13:17:30', '2022-10-21 13:17:30'),
(228, 18, '17:00:00', '18:00:00', 60, NULL, 'available', '2022-10-21 13:17:30', '2022-10-21 13:17:30'),
(229, 18, '18:00:00', '19:00:00', 60, NULL, 'available', '2022-10-21 13:17:30', '2022-10-21 13:17:30'),
(230, 18, '19:00:00', '20:00:00', 60, NULL, 'available', '2022-10-21 13:17:30', '2022-10-21 13:17:30'),
(231, 19, '13:00:00', '14:00:00', 60, NULL, 'available', '2022-10-21 13:17:30', '2022-10-21 13:17:30'),
(232, 19, '14:00:00', '15:00:00', 60, NULL, 'available', '2022-10-21 13:17:30', '2022-10-21 13:17:30'),
(233, 19, '15:00:00', '16:00:00', 60, NULL, 'available', '2022-10-21 13:17:30', '2022-10-21 13:17:30'),
(234, 19, '16:00:00', '17:00:00', 60, NULL, 'available', '2022-10-21 13:17:30', '2022-10-21 13:17:30'),
(235, 19, '17:00:00', '18:00:00', 60, NULL, 'available', '2022-10-21 13:17:30', '2022-10-21 13:17:30'),
(236, 19, '18:00:00', '19:00:00', 60, NULL, 'available', '2022-10-21 13:17:30', '2022-10-21 13:17:30'),
(237, 19, '19:00:00', '20:00:00', 60, NULL, 'available', '2022-10-21 13:17:30', '2022-10-21 13:17:30'),
(238, 20, '13:00:00', '14:00:00', 60, NULL, 'available', '2022-10-21 13:17:30', '2022-10-21 13:17:30'),
(239, 20, '14:00:00', '15:00:00', 60, NULL, 'available', '2022-10-21 13:17:30', '2022-10-21 13:17:30'),
(240, 20, '15:00:00', '16:00:00', 60, NULL, 'available', '2022-10-21 13:17:30', '2022-10-21 13:17:30'),
(241, 20, '16:00:00', '17:00:00', 60, NULL, 'available', '2022-10-21 13:17:30', '2022-10-21 13:17:30'),
(242, 20, '17:00:00', '18:00:00', 60, NULL, 'available', '2022-10-21 13:17:30', '2022-10-21 13:17:30'),
(243, 20, '18:00:00', '19:00:00', 60, NULL, 'available', '2022-10-21 13:17:30', '2022-10-21 13:17:30'),
(244, 20, '19:00:00', '20:00:00', 60, NULL, 'available', '2022-10-21 13:17:30', '2022-10-21 13:17:30'),
(245, 21, '13:00:00', '14:00:00', 60, NULL, 'available', '2022-10-21 13:17:30', '2022-10-21 13:17:30'),
(246, 21, '14:00:00', '15:00:00', 60, NULL, 'available', '2022-10-21 13:17:30', '2022-10-21 13:17:30'),
(247, 21, '15:00:00', '16:00:00', 60, NULL, 'available', '2022-10-21 13:17:30', '2022-10-21 13:17:30'),
(248, 21, '16:00:00', '17:00:00', 60, NULL, 'available', '2022-10-21 13:17:30', '2022-10-21 13:17:30'),
(249, 21, '17:00:00', '18:00:00', 60, NULL, 'available', '2022-10-21 13:17:30', '2022-10-21 13:17:30'),
(250, 21, '18:00:00', '19:00:00', 60, NULL, 'available', '2022-10-21 13:17:30', '2022-10-21 13:17:30'),
(251, 21, '19:00:00', '20:00:00', 60, NULL, 'available', '2022-10-21 13:17:30', '2022-10-21 13:17:30'),
(252, 22, '13:00:00', '14:00:00', 60, NULL, 'available', '2022-10-21 13:17:30', '2022-10-21 13:17:30'),
(253, 22, '14:00:00', '15:00:00', 60, NULL, 'available', '2022-10-21 13:17:30', '2022-10-21 13:17:30'),
(254, 22, '15:00:00', '16:00:00', 60, NULL, 'available', '2022-10-21 13:17:30', '2022-10-21 13:17:30'),
(255, 22, '16:00:00', '17:00:00', 60, NULL, 'available', '2022-10-21 13:17:30', '2022-10-21 13:17:30'),
(256, 22, '17:00:00', '18:00:00', 60, NULL, 'available', '2022-10-21 13:17:30', '2022-10-21 13:17:30'),
(257, 22, '18:00:00', '19:00:00', 60, NULL, 'available', '2022-10-21 13:17:30', '2022-10-21 13:17:30'),
(258, 22, '19:00:00', '20:00:00', 60, NULL, 'available', '2022-10-21 13:17:30', '2022-10-21 13:17:30');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text,
  `category` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `active` int(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `name`, `description`, `category`, `created_at`, `updated_at`, `active`) VALUES
(1, 'Ushare', 'We Have Mbs Ushare', 12, '2022-10-18 06:19:11', '2022-10-21 06:23:45', 1),
(2, 'Barber', 'mn7lo2', 5, '2022-10-20 10:58:39', '2022-10-20 10:58:39', 1);

-- --------------------------------------------------------

--
-- Table structure for table `services_days`
--

CREATE TABLE `services_days` (
  `id` int(11) NOT NULL,
  `entity_id` int(11) NOT NULL,
  `day` date NOT NULL,
  `duration` int(11) NOT NULL,
  `from` time NOT NULL,
  `to` time NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `services_days`
--

INSERT INTO `services_days` (`id`, `entity_id`, `day`, `duration`, `from`, `to`, `created_at`, `updated_at`) VALUES
(14, 6, '2022-10-22', 30, '18:00:00', '21:00:00', '2022-10-21 13:16:32', '2022-10-21 13:16:32'),
(15, 6, '2022-10-23', 30, '18:00:00', '21:00:00', '2022-10-21 13:16:32', '2022-10-21 13:16:32'),
(16, 7, '2022-10-23', 60, '13:00:00', '20:00:00', '2022-10-21 13:17:30', '2022-10-21 13:17:30'),
(17, 7, '2022-10-24', 60, '13:00:00', '20:00:00', '2022-10-21 13:17:30', '2022-10-21 13:17:30'),
(18, 7, '2022-10-25', 60, '13:00:00', '20:00:00', '2022-10-21 13:17:30', '2022-10-21 13:17:30'),
(19, 7, '2022-10-26', 60, '13:00:00', '20:00:00', '2022-10-21 13:17:30', '2022-10-21 13:17:30'),
(20, 7, '2022-10-27', 60, '13:00:00', '20:00:00', '2022-10-21 13:17:30', '2022-10-21 13:17:30'),
(21, 7, '2022-10-28', 60, '13:00:00', '20:00:00', '2022-10-21 13:17:30', '2022-10-21 13:17:30'),
(22, 7, '2022-10-29', 60, '13:00:00', '20:00:00', '2022-10-21 13:17:30', '2022-10-21 13:17:30');

-- --------------------------------------------------------

--
-- Table structure for table `services_images`
--

CREATE TABLE `services_images` (
  `id` int(11) NOT NULL,
  `service` int(11) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `services_images`
--

INSERT INTO `services_images` (`id`, `service`, `image`) VALUES
(1, 1, 'pYD8MgpPPK8V-gCAgKWGt3kPv0BJISTc.jpg'),
(2, 1, 'EAttOly9ZvysyER1h5WxwVKLDsViDdjH.jpg'),
(3, 2, 'JglH7E0XuroZhhLJOfS7U8MbKxQJHU32.png');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `verification_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`, `verification_token`, `type`) VALUES
(2, 'provider', 'HJg-n0g_i0bKwcj79VRcSoPc07yTnjrJ', '$2y$13$QC/YPQnLocmeSDqvUzRPeeKmx.am88WgrsQVFYEzkPWEk6/xflhGm', NULL, 'provider@codendot.com', 10, '2022-10-21 13:01:00', '2022-10-21 13:14:12', 'weg6oBYqdxCNMWtODfYbDzDQB6PF01g3_1666357260', 'providers'),
(3, 'user', 'Zbx8xXjldsjEQwHVbRftT7qFDDgg6i_a', '$2y$13$0LzkOvIeo5HnD6g8ZlG2beU1V66D7qulQiK7vYxlPHVgjk6fqLymC', NULL, 'user@codendot.com', 10, '2022-10-21 13:01:13', '2022-10-21 13:14:57', '3l-cZIkQlvYeGmYPQhfyNBMCzM-smsLN_1666358097', 'users'),
(4, 'provider2', 'LUJQEU5sDBr6bBDhZaq_p7QZDJqQxOsG', '$2y$13$JAsYVG8DFxeagqkHprqRW.H/qMqO2fY8Am7YD6dmwp.Pzt568fC0S', NULL, 'provider2@codendot.com', 10, '2022-10-21 13:15:35', '2022-10-21 13:15:40', 'lIZtBaFXRZK5WKISdaaRCfk4HOq8WNDw_1666358135', 'providers');

-- --------------------------------------------------------

--
-- Table structure for table `users_services`
--

CREATE TABLE `users_services` (
  `id` int(11) NOT NULL,
  `entity_id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users_services_attributes`
--

CREATE TABLE `users_services_attributes` (
  `id` int(11) NOT NULL,
  `entity_id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users_services_datetime`
--

CREATE TABLE `users_services_datetime` (
  `id` int(11) NOT NULL,
  `entity_id` int(11) NOT NULL,
  `day` int(11) NOT NULL,
  `schedule` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`);

--
-- Indexes for table `attributes`
--
ALTER TABLE `attributes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx-attributes-service` (`service`),
  ADD KEY `idx-attributes-type` (`type`);

--
-- Indexes for table `attribute_options`
--
ALTER TABLE `attribute_options`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx-attribute_options-attribute` (`attribute`);

--
-- Indexes for table `attribute_types`
--
ALTER TABLE `attribute_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `html_value` (`html_value`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx-categories-parent` (`parent`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `providers_services`
--
ALTER TABLE `providers_services`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idx-unique-user-service` (`user`,`service`),
  ADD KEY `idx-providers_services-user` (`user`),
  ADD KEY `idx-providers_services-service` (`service`);

--
-- Indexes for table `providers_services_attributes`
--
ALTER TABLE `providers_services_attributes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idx-unique-entity_id-attribute` (`entity_id`,`attribute`),
  ADD KEY `idx-providers_services_attributes-entity_id` (`entity_id`),
  ADD KEY `idx-providers_services_attributes-attribute` (`attribute`);

--
-- Indexes for table `schedules`
--
ALTER TABLE `schedules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx-schedules-day` (`day`),
  ADD KEY `idx-schedules-user` (`user`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx-services-category` (`category`);

--
-- Indexes for table `services_days`
--
ALTER TABLE `services_days`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx-services_days-entity_id` (`entity_id`);

--
-- Indexes for table `services_images`
--
ALTER TABLE `services_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx-services_images-service` (`service`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`);

--
-- Indexes for table `users_services`
--
ALTER TABLE `users_services`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx-users_services-entity_id` (`entity_id`),
  ADD KEY `idx-users_services-user` (`user`);

--
-- Indexes for table `users_services_attributes`
--
ALTER TABLE `users_services_attributes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx-users_services_attributes-entity_id` (`entity_id`),
  ADD KEY `idx-users_services_attributes-user` (`user`);

--
-- Indexes for table `users_services_datetime`
--
ALTER TABLE `users_services_datetime`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx-users_services_datetime-entity_id` (`entity_id`),
  ADD KEY `idx-users_services_datetime-day` (`day`),
  ADD KEY `idx-users_services_datetime-schedule` (`schedule`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `attributes`
--
ALTER TABLE `attributes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `attribute_options`
--
ALTER TABLE `attribute_options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `attribute_types`
--
ALTER TABLE `attribute_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `providers_services`
--
ALTER TABLE `providers_services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `providers_services_attributes`
--
ALTER TABLE `providers_services_attributes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=259;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `services_days`
--
ALTER TABLE `services_days`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `services_images`
--
ALTER TABLE `services_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users_services`
--
ALTER TABLE `users_services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users_services_attributes`
--
ALTER TABLE `users_services_attributes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users_services_datetime`
--
ALTER TABLE `users_services_datetime`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attributes`
--
ALTER TABLE `attributes`
  ADD CONSTRAINT `fk-attributes-service` FOREIGN KEY (`service`) REFERENCES `services` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk-attributes-type` FOREIGN KEY (`type`) REFERENCES `attribute_types` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `attribute_options`
--
ALTER TABLE `attribute_options`
  ADD CONSTRAINT `fk-attribute_options-attribute` FOREIGN KEY (`attribute`) REFERENCES `attributes` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `fk-categories-parent` FOREIGN KEY (`parent`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `providers_services`
--
ALTER TABLE `providers_services`
  ADD CONSTRAINT `fk-providers_services-service` FOREIGN KEY (`service`) REFERENCES `services` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk-providers_services-user` FOREIGN KEY (`user`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `providers_services_attributes`
--
ALTER TABLE `providers_services_attributes`
  ADD CONSTRAINT `fk-providers_services_attributes-attribute` FOREIGN KEY (`attribute`) REFERENCES `attributes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk-providers_services_attributes-entity_id` FOREIGN KEY (`entity_id`) REFERENCES `providers_services` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `schedules`
--
ALTER TABLE `schedules`
  ADD CONSTRAINT `fk-schedules-day` FOREIGN KEY (`day`) REFERENCES `services_days` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk-schedules-user` FOREIGN KEY (`user`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `services`
--
ALTER TABLE `services`
  ADD CONSTRAINT `fk-services-category` FOREIGN KEY (`category`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `services_days`
--
ALTER TABLE `services_days`
  ADD CONSTRAINT `fk-services_days-entity_id` FOREIGN KEY (`entity_id`) REFERENCES `providers_services` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `services_images`
--
ALTER TABLE `services_images`
  ADD CONSTRAINT `fk-services_images-service` FOREIGN KEY (`service`) REFERENCES `services` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users_services`
--
ALTER TABLE `users_services`
  ADD CONSTRAINT `fk-users_services-entity_id` FOREIGN KEY (`entity_id`) REFERENCES `providers_services` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk-users_services-user` FOREIGN KEY (`user`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users_services_attributes`
--
ALTER TABLE `users_services_attributes`
  ADD CONSTRAINT `fk-users_services_attributes-entity_id` FOREIGN KEY (`entity_id`) REFERENCES `providers_services_attributes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk-users_services_attributes-user` FOREIGN KEY (`user`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users_services_datetime`
--
ALTER TABLE `users_services_datetime`
  ADD CONSTRAINT `fk-users_services_datetime-day` FOREIGN KEY (`day`) REFERENCES `services_days` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk-users_services_datetime-entity_id` FOREIGN KEY (`entity_id`) REFERENCES `users_services` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk-users_services_datetime-schedule` FOREIGN KEY (`schedule`) REFERENCES `schedules` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
