
ALTER TABLE `categories` ADD `parent` VARCHAR(255) NOT NULL DEFAULT '' AFTER `name`;

INSERT INTO `flower`.`categories` (`id`, `name`, `parent`, `is_active`, `type`)
VALUES (NULL, 'Ngày Phụ Nữ Việt Nam', '', '1', '1'), (NULL, 'Ngày Quốc Tế Phụ Nữ', '', '1', '1');
INSERT INTO `flower`.`categories` (`id`, `name`, `parent`, `is_active`, `type`)
VALUES (NULL, 'Ngày Nhà Giáo Việt Nam', '', '1', '1'), (NULL, 'Giáng Sinh', '', '1', '1');

UPDATE `categories` SET `parent` = 'by_topic' WHERE `id` IN (7, 14, 15, 16, 17, 18);

UPDATE `categories` SET `parent` = 'by_design' WHERE `id` NOT IN (5, 6, 7, 14, 15, 16, 17, 18);


DROP TABLE IF EXISTS `visitors`;
CREATE TABLE IF NOT EXISTS `visitors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `visited_timestamp` timestamp NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ip_address` (`ip_address`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `feedbacks`
CREATE TABLE IF NOT EXISTS `feedbacks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `viewed` int(1) NOT NULL,
  `hidden` int(1) NOT NULL,
  `created_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
