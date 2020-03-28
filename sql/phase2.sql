ALTER TABLE `dtb_push_device`
ADD `push_article` TINYINT NOT NULL DEFAULT '0' AFTER `push_setting`,
ADD `push_event` TINYINT NOT NULL DEFAULT '0' AFTER `push_article`,
ADD `push_promo` TINYINT NOT NULL DEFAULT '0' AFTER `push_event`,
ADD `push_voucher` TINYINT NOT NULL DEFAULT '0' AFTER `push_promo`,
ADD `push_reminder` TINYINT NOT NULL DEFAULT '0' AFTER `push_voucher`;
