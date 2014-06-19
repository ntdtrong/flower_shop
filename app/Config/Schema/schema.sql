--
-- Database: `flower_shop_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_banner` tinyint(1) DEFAULT '0',
  `image` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

INSERT INTO `categories` (`id`, `name`, `is_banner`, `image`) VALUES
(1, 'Hoa cÆ°á»›i', 1, 'banner_1.jpg'),
(2, 'Hoa khai trÆ°Æ¡ng', 0, NULL),
(3, 'Hoa sinh nháº­t', 1, 'banner_2.jpg');
-- --------------------------------------------------------

--
-- Table structure for table `flowers`
--


CREATE TABLE IF NOT EXISTS `flowers` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` text COLLATE utf8_unicode_ci,
  `price` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `thumb` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `flower_category`
--

CREATE TABLE IF NOT EXISTS `flower_categories` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `flower_id` int(10) DEFAULT NULL,
  `category_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `first_name` nvarchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` nvarchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `role` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `role`) VALUES
(1, 'Admin', 'Admin', 'admin@email.com', '$2a$10$nQ.eFGjSQuOPAag3Yb01IeQoMOEF1BU2MjlTj3MEM2e8mONx/t1B6', 1),
(2, 'Manager', 'Manager', 'manager@email.com', '$2a$10$BlvqhVO9RZy5RcE1Ca67t.mGIMpeVZam2fJ/xR0PZ8V1Z9csnTdAS', 2);
-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE IF NOT EXISTS `companies` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` nvarchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `full_name` text COLLATE utf8_unicode_ci,
  `address` text COLLATE utf8_unicode_ci,
  `phone` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

INSERT INTO `companies` (`id`, `name`, `full_name`, `phone`, `email`, `image`, `description`) VALUES
(1, 'Hoa ÄÃ  Láº¡t', 'Cá»­a hÃ ng hoa tÆ°Æ¡i Hoa ÄÃ  Láº¡t', '08.31312xxx - 0905. 000 xxx - 0905. 000 xxx', 'emai@email.com', NULL, NULL);

