-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 02, 2014 at 07:26 AM
-- Server version: 5.6.16
-- PHP Version: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `flowers`
--

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE IF NOT EXISTS `banners` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(300) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `title`, `description`, `image`, `is_active`) VALUES
(1, 'Mỗi ngày một giỏ hoa', 'Mo ta', 'banner_1.jpg', 1),
(2, 'Lãng mạn ngày lễ tình nhân', 'Mo ta', 'banner_2.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE IF NOT EXISTS `blogs` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(400) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `category_id` int(10) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `type` int(10) NOT NULL DEFAULT '1' COMMENT '1: flower, 2: blog',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `is_active`, `type`) VALUES
(1, 'Hoa giỏ', 1, 1),
(2, 'Hoa bó', 1, 1),
(3, 'Hoa cưới', 1, 1),
(4, 'Hoa sinh nhật', 1, 1),
(5, 'Kiến thức', 1, 2),
(6, 'Tin tức', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE IF NOT EXISTS `companies` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `full_name` text COLLATE utf8_unicode_ci NOT NULL,
  `address` text COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `email` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `image` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `name`, `full_name`, `address`, `phone`, `email`, `image`, `description`) VALUES
(1, 'Flowersinlove', 'Lãng Hoa Tình Yêu', '16 Nguyễn Quý Cảnh, P. An Phú, Quận 2', '08.31312xxx - 0905. 000 xxx - 0905. 000 xxx', 'info@flowersinlove.vn', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `flowers`
--

CREATE TABLE IF NOT EXISTS `flowers` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` text COLLATE utf8_unicode_ci NOT NULL,
  `price` double NOT NULL DEFAULT '0',
  `image` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `thumb` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `flowers`
--

INSERT INTO `flowers` (`id`, `name`, `price`, `image`, `thumb`, `description`, `created`, `modified`) VALUES
(1, 'Hoa hồng', 2000000, '1404138187.jpg', '1404138187.jpg', 'Hehe', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'Hoa tulip', 200000, '1404138174.jpg', '1404138174.jpg', 'Dis', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'Hoa cưới', 20000, '1404138209.jpg', '1404138209.jpg', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'Hoa hong do', 200000, '1404138209.jpg', '1404138209.jpg', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `flower_categories`
--

CREATE TABLE IF NOT EXISTS `flower_categories` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `flower_id` int(10) NOT NULL DEFAULT '0',
  `category_id` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table `flower_categories`
--

INSERT INTO `flower_categories` (`id`, `flower_id`, `category_id`) VALUES
(3, 2, 1),
(4, 1, 1),
(5, 3, 1),
(6, 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `last_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `password` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `role` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `role`) VALUES
(1, 'Admin', 'Admin', 'admin@email.com', '$2a$10$WKZ1dUFdixwsbVjF7B7nIOncYcJAjSubOQp45JQv05wiTun/6.QBS', 1),
(2, 'Manager', 'Manager', 'manager@email.com', '$2a$10$Kw5.X7DaaaOg07Q0zFfkr.XG11r.5jdhydQt7u6gZ1hPY2GyQuBlG', 2);
