
ALTER TABLE `categories` ADD `parent` VARCHAR(255) NOT NULL DEFAULT '' AFTER `name`;

INSERT INTO `flower`.`categories` (`id`, `name`, `parent`, `is_active`, `type`)
VALUES (NULL, 'Ngày Phụ Nữ Việt Nam', '', '1', '1'), (NULL, 'Ngày Quốc Tế Phụ Nữ', '', '1', '1');
INSERT INTO `flower`.`categories` (`id`, `name`, `parent`, `is_active`, `type`)
VALUES (NULL, 'Ngày Nhà Giáo Việt Nam', '', '1', '1'), (NULL, 'Giáng Sinh', '', '1', '1');

UPDATE `categories` SET `parent` = 'by_topic' WHERE `id` IN (7, 14, 15, 16, 17, 18);

UPDATE `categories` SET `parent` = 'by_design' WHERE `id` NOT IN (5, 6, 7, 14, 15, 16, 17, 18);
