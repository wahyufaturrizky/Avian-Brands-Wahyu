CREATE TABLE `dtb_slider_mobile` (
  `id` bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,

  `title` varchar(50) NOT NULL,
  `description` varchar(500) DEFAULT NULL,
  `url` text,
  `image_url` varchar(500) DEFAULT NULL,
  `image_url_pro` varchar(500) DEFAULT NULL COMMENT 'for pro view',
  `file_pretty_name` varchar(500) DEFAULT NULL,
  `ordering` int(11) NOT NULL,
  `is_show` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0: hide, 1: show',
  `show_in` tinyint(2) NOT NULL DEFAULT '1' COMMENT '1 : both, 2: User, 3: pro',
  `created_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `image_url_device` varchar(300) DEFAULT NULL,
  `popup_image_url` varchar(300) DEFAULT NULL,
  `is_show_as_popup` tinyint(3) UNSIGNED DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


create table dtb_snippet (
    id bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
    snip_header TEXT,
    snip_footer TEXT
);
