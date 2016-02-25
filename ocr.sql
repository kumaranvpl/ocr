-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 23, 2016 at 12:57 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ocr`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(30) NOT NULL,
  `fields_needed` varchar(300) NOT NULL,
  `tags` varchar(300) NOT NULL,
  `added_by` int(11) NOT NULL,
  `is_enabled` varchar(30) NOT NULL DEFAULT 'no',
  `time_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `bill_types` varchar(100) NOT NULL,
  `program_api` varchar(300) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `fields_needed`, `tags`, `added_by`, `is_enabled`, `time_created`, `bill_types`, `program_api`) VALUES
(1, 'Cheque', 'date', 'bank name, branch name', 1, 'yes', '2016-01-29 01:58:25', 'cheque', ''),
(2, 'Restaurant Bills', 'Total, Vat, Service Tax', 'curry, roti', 1, 'yes', '2016-01-29 06:39:16', 'thermal, invoice, texture', ''),
(3, 'Certificate', 'Degree, University', 'degree, university', 1, 'yes', '2016-01-29 06:40:16', 'certificate', '');

-- --------------------------------------------------------

--
-- Table structure for table `categories_fields`
--

CREATE TABLE IF NOT EXISTS `categories_fields` (
  `categories_id` int(11) NOT NULL,
  `fields_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  KEY `categories_fields_category_id_foreign` (`categories_id`),
  KEY `categories_fields_field_id_foreign` (`fields_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `categories_fields`
--

INSERT INTO `categories_fields` (`categories_id`, `fields_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2016-02-23 04:26:57', '2016-02-23 04:26:57');

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE IF NOT EXISTS `companies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_name` varchar(30) NOT NULL,
  `verification_password` varchar(300) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `company_name` (`company_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `company_name`, `verification_password`) VALUES
(1, '1000lookz', '$2y$10$IgO7JHTeaUWYdzA0qheSYOIzoOYELCckIN4FUGvqHQ65SxdXTElVK');

-- --------------------------------------------------------

--
-- Table structure for table `fields`
--

CREATE TABLE IF NOT EXISTS `fields` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `fields`
--

INSERT INTO `fields` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Date', '2016-02-23 04:21:00', '2016-02-23 04:21:00');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2016_02_23_095521_create_categories_table', 0),
('2016_02_23_095521_create_categories_fields_table', 0),
('2016_02_23_095521_create_companies_table', 0),
('2016_02_23_095521_create_fields_table', 0),
('2016_02_23_095521_create_salt_table', 0),
('2016_02_23_095521_create_users_table', 0),
('2016_02_23_095523_add_foreign_keys_to_categories_fields_table', 0);

-- --------------------------------------------------------

--
-- Table structure for table `salt`
--

CREATE TABLE IF NOT EXISTS `salt` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `salt_key` varchar(32) NOT NULL,
  `company` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `salt`
--

INSERT INTO `salt` (`id`, `salt_key`, `company`) VALUES
(1, 'wJHSi6LOgn266sYzTNEkUWbTQ9ufB3AV', '1000lookz');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) NOT NULL,
  `email` varchar(60) NOT NULL,
  `password` varchar(300) NOT NULL,
  `employee_id` varchar(30) NOT NULL,
  `company` varchar(30) NOT NULL,
  `is_admin` varchar(25) NOT NULL DEFAULT 'no',
  `added_by` bigint(25) NOT NULL,
  `is_confirmed` varchar(20) NOT NULL DEFAULT 'no',
  `time_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `time_verified` timestamp NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `id_2` (`id`),
  UNIQUE KEY `employee_id` (`employee_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `employee_id`, `company`, `is_admin`, `added_by`, `is_confirmed`, `time_created`, `time_verified`) VALUES
(1, 'admin', 'admin@admin.com', '$2y$10$cYYTDefNZY/GpjLXF6d5i.2R8.EJUP1AXaE6..VuAL6ihJNGsDXfi', '1', '1000lookz', 'yes', 1, 'yes', '0000-00-00 00:00:00', '2016-01-25 05:19:42'),
(2, 'NewUser', 'user@admin.com', '$2y$10$cYYTDefNZY/GpjLXF6d5i.2R8.EJUP1AXaE6..VuAL6ihJNGsDXfi', '3969', '1000lookz', 'no', 1, 'yes', '2016-01-27 05:01:25', '2016-01-25 10:37:33'),
(5, 'Kumaran', 'kumaranvpl@gmail.com', '$2y$10$KBz6bIfllMwFZehFoQcSDuThVzxmUeAe2qJtEbmDgbFRVA50pD9iS', '3695', '1000lookz', 'no', 1, 'yes', '2016-01-27 11:02:22', '2016-01-28 04:14:17');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `categories_fields`
--
ALTER TABLE `categories_fields`
  ADD CONSTRAINT `categories_fields_field_id_foreign` FOREIGN KEY (`fields_id`) REFERENCES `fields` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `categories_fields_category_id_foreign` FOREIGN KEY (`categories_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
