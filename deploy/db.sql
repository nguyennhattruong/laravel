-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.1.32-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win32
-- HeidiSQL Version:             11.1.0.6116
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table laravel.co_apartment
DROP TABLE IF EXISTS `co_apartment`;
CREATE TABLE IF NOT EXISTS `co_apartment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `alias` varchar(400) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(1000) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `feature_id` int(10) unsigned NOT NULL DEFAULT '1',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `state` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `label_id` int(10) unsigned NOT NULL DEFAULT '0',
  `type_id` int(10) unsigned NOT NULL DEFAULT '0',
  `location_id` int(10) unsigned NOT NULL DEFAULT '0',
  `images` varchar(1000) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `price` bigint(20) unsigned NOT NULL DEFAULT '0',
  `code` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `bedroom` int(10) unsigned NOT NULL DEFAULT '0',
  `bathroom` int(10) unsigned NOT NULL DEFAULT '0',
  `land_size` int(10) unsigned NOT NULL DEFAULT '0',
  `year_built` int(10) unsigned NOT NULL DEFAULT '0',
  `meta_title` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `meta_keywords` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `meta_description` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `publish_up` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `language` varchar(5) COLLATE utf8_unicode_ci NOT NULL DEFAULT '*',
  `hits` int(10) unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table laravel.co_apartment: ~0 rows (approximately)
/*!40000 ALTER TABLE `co_apartment` DISABLE KEYS */;
/*!40000 ALTER TABLE `co_apartment` ENABLE KEYS */;

-- Dumping structure for table laravel.co_apartment_locations
DROP TABLE IF EXISTS `co_apartment_locations`;
CREATE TABLE IF NOT EXISTS `co_apartment_locations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `alias` varchar(400) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `content` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `language` varchar(5) COLLATE utf8_unicode_ci NOT NULL DEFAULT '*',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table laravel.co_apartment_locations: ~0 rows (approximately)
/*!40000 ALTER TABLE `co_apartment_locations` DISABLE KEYS */;
/*!40000 ALTER TABLE `co_apartment_locations` ENABLE KEYS */;

-- Dumping structure for table laravel.co_apartment_types
DROP TABLE IF EXISTS `co_apartment_types`;
CREATE TABLE IF NOT EXISTS `co_apartment_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `alias` varchar(400) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `language` varchar(5) COLLATE utf8_unicode_ci NOT NULL DEFAULT '*',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table laravel.co_apartment_types: ~0 rows (approximately)
/*!40000 ALTER TABLE `co_apartment_types` DISABLE KEYS */;
/*!40000 ALTER TABLE `co_apartment_types` ENABLE KEYS */;

-- Dumping structure for table laravel.co_apartment_utilities
DROP TABLE IF EXISTS `co_apartment_utilities`;
CREATE TABLE IF NOT EXISTS `co_apartment_utilities` (
  `apartment_id` int(10) unsigned NOT NULL,
  `attribute_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table laravel.co_apartment_utilities: ~0 rows (approximately)
/*!40000 ALTER TABLE `co_apartment_utilities` DISABLE KEYS */;
/*!40000 ALTER TABLE `co_apartment_utilities` ENABLE KEYS */;

-- Dumping structure for table laravel.co_attributes
DROP TABLE IF EXISTS `co_attributes`;
CREATE TABLE IF NOT EXISTS `co_attributes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `column_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `note` varchar(2000) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `sequence` int(10) unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table laravel.co_attributes: ~0 rows (approximately)
/*!40000 ALTER TABLE `co_attributes` DISABLE KEYS */;
/*!40000 ALTER TABLE `co_attributes` ENABLE KEYS */;

-- Dumping structure for table laravel.co_attributes_values
DROP TABLE IF EXISTS `co_attributes_values`;
CREATE TABLE IF NOT EXISTS `co_attributes_values` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `attribute_id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `column_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `note` varchar(2000) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `sequence` int(10) unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table laravel.co_attributes_values: ~0 rows (approximately)
/*!40000 ALTER TABLE `co_attributes_values` DISABLE KEYS */;
/*!40000 ALTER TABLE `co_attributes_values` ENABLE KEYS */;

-- Dumping structure for table laravel.co_bills
DROP TABLE IF EXISTS `co_bills`;
CREATE TABLE IF NOT EXISTS `co_bills` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `date_order` datetime NOT NULL,
  `total` double NOT NULL,
  `status` int(11) NOT NULL,
  `disable` int(11) NOT NULL,
  `note` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table laravel.co_bills: ~0 rows (approximately)
/*!40000 ALTER TABLE `co_bills` DISABLE KEYS */;
/*!40000 ALTER TABLE `co_bills` ENABLE KEYS */;

-- Dumping structure for table laravel.co_bill_details
DROP TABLE IF EXISTS `co_bill_details`;
CREATE TABLE IF NOT EXISTS `co_bill_details` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `bill_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quality` int(11) NOT NULL,
  `price` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table laravel.co_bill_details: ~0 rows (approximately)
/*!40000 ALTER TABLE `co_bill_details` DISABLE KEYS */;
/*!40000 ALTER TABLE `co_bill_details` ENABLE KEYS */;

-- Dumping structure for table laravel.co_categories
DROP TABLE IF EXISTS `co_categories`;
CREATE TABLE IF NOT EXISTS `co_categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alias` varchar(400) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `lft` int(11) DEFAULT NULL,
  `rgt` int(11) DEFAULT NULL,
  `depth` int(11) DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(3) unsigned NOT NULL,
  `ordering` int(10) unsigned NOT NULL,
  `language` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `co_categories_parent_id_index` (`parent_id`),
  KEY `co_categories_lft_index` (`lft`),
  KEY `co_categories_rgt_index` (`rgt`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table laravel.co_categories: ~0 rows (approximately)
/*!40000 ALTER TABLE `co_categories` DISABLE KEYS */;
INSERT INTO `co_categories` (`id`, `title`, `alias`, `parent_id`, `lft`, `rgt`, `depth`, `description`, `status`, `ordering`, `language`, `created_at`, `updated_at`) VALUES
	(1, 'Blog', 'blog', NULL, 1, 2, 0, '', 1, 0, '*', '2019-03-13 12:49:39', '2019-03-13 12:49:39');
/*!40000 ALTER TABLE `co_categories` ENABLE KEYS */;

-- Dumping structure for table laravel.co_config
DROP TABLE IF EXISTS `co_config`;
CREATE TABLE IF NOT EXISTS `co_config` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `off` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `off_message` text COLLATE utf8mb4_unicode_ci,
  `site_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci,
  `meta_keywords` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_robots` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_extension` text COLLATE utf8mb4_unicode_ci,
  `mail_from` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `from_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reply_to_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reply_to_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mailer` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `smtp_host` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `smtp_port` smallint(5) unsigned DEFAULT NULL,
  `smtp_secure` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `smtp_auth` tinyint(3) unsigned DEFAULT NULL,
  `smtp_user` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `smtp_pass` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `header_script` text COLLATE utf8mb4_unicode_ci,
  `header_css` text COLLATE utf8mb4_unicode_ci,
  `header_link` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table laravel.co_config: ~0 rows (approximately)
/*!40000 ALTER TABLE `co_config` DISABLE KEYS */;
INSERT INTO `co_config` (`id`, `off`, `off_message`, `site_name`, `meta_description`, `meta_keywords`, `meta_robots`, `meta_extension`, `mail_from`, `from_name`, `reply_to_email`, `reply_to_name`, `mailer`, `smtp_host`, `smtp_port`, `smtp_secure`, `smtp_auth`, `smtp_user`, `smtp_pass`, `header_script`, `header_css`, `header_link`) VALUES
	(1, 1, NULL, 'Cửa hàng bán laptop', 'Cửa hàng bán laptop', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL);
/*!40000 ALTER TABLE `co_config` ENABLE KEYS */;

-- Dumping structure for table laravel.co_contact
DROP TABLE IF EXISTS `co_contact`;
CREATE TABLE IF NOT EXISTS `co_contact` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `content` varchar(400) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `fullname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `mobile` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `phone` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `address` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `ip` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `send_time` datetime NOT NULL,
  `type` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `read` tinyint(3) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table laravel.co_contact: ~0 rows (approximately)
/*!40000 ALTER TABLE `co_contact` DISABLE KEYS */;
/*!40000 ALTER TABLE `co_contact` ENABLE KEYS */;

-- Dumping structure for table laravel.co_content
DROP TABLE IF EXISTS `co_content`;
CREATE TABLE IF NOT EXISTS `co_content` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `alias` varchar(400) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `category_id` int(10) unsigned NOT NULL DEFAULT '0',
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `image_alt` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `layout_type` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `layout` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `introtext` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `fulltext` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(10) unsigned NOT NULL DEFAULT '0',
  `modified_by` int(10) unsigned NOT NULL DEFAULT '0',
  `author` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `meta` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `publish_up` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `publish_down` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `rating_sum` int(10) unsigned NOT NULL DEFAULT '0',
  `rating_count` int(10) unsigned NOT NULL DEFAULT '0',
  `params` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `hits` int(10) unsigned NOT NULL DEFAULT '0',
  `source` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `ordering` int(10) unsigned NOT NULL DEFAULT '0',
  `language` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '*',
  `attribs` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table laravel.co_content: ~0 rows (approximately)
/*!40000 ALTER TABLE `co_content` DISABLE KEYS */;
INSERT INTO `co_content` (`id`, `title`, `alias`, `category_id`, `image`, `image_alt`, `layout_type`, `layout`, `introtext`, `fulltext`, `created_by`, `modified_by`, `author`, `meta`, `publish_up`, `publish_down`, `status`, `rating_sum`, `rating_count`, `params`, `hits`, `source`, `ordering`, `language`, `attribs`, `created_at`, `updated_at`) VALUES
	(4, '9 lý do nên mua Dell Latitude – Laptop doanh nghiệp số 1', '9-ly-do-nen-mua-dell-latitude-laptop-doanh-nghiep-so-1', 1, 'f8725ba555e9e8b5f6647551258e8fce.jpg', '', 1, '', 'Các hãng sản xuất laptop luôn cố gắng tạo sự khác biệt giữa dòng máy phổ thông và những dòng laptop chuyên dụng. Thực ra đôi khi chúng ta cần nhìn lại và xác định nhu cầu sử dụng, mục đích và những kì vọng khi chọn mua một laptop. Trong khi những dòng laptop phổ thông thường hướng đến sự phá cách, đổi mới về thiết kế. Thì dòng máy laptop doanh nghiệp thường có bộ khung chắc chắn hơn, nhiều lựa chọn cấu hình và sử dụng cũng linh hoạt hơn.', '<h2><strong>V&igrave; sao c&aacute;c doanh nghiệp n&ecirc;n trang bị d&ograve;ng m&aacute;y t&iacute;nh Dell Latitude?</strong></h2>\r\n\r\n<blockquote>\r\n<p>Những d&ograve;ng laptop Dell Latitude thường kh&ocirc;ng quảng c&aacute;o rầm rộ?</p>\r\n</blockquote>\r\n\r\n<p><img alt="Dell Latitude sự lựa chọn số 1" height="760" loading="lazy" sizes="(max-width: 1400px) 100vw, 1400px" src="https://prolap.vn/wp-content/uploads/2019/01/dell-latitude-7490-usa.jpg.webp" srcset="https://prolap.vn/wp-content/uploads/2019/01/dell-latitude-7490-usa.jpg.webp 1400w, https://prolap.vn/wp-content/uploads/2019/01/dell-latitude-7490-usa-300x163.jpg.webp 300w, https://prolap.vn/wp-content/uploads/2019/01/dell-latitude-7490-usa-768x417.jpg.webp 768w, https://prolap.vn/wp-content/uploads/2019/01/dell-latitude-7490-usa-1024x556.jpg.webp 1024w, https://prolap.vn/wp-content/uploads/2019/01/dell-latitude-7490-usa-247x134.jpg.webp 247w, https://prolap.vn/wp-content/uploads/2019/01/dell-latitude-7490-usa-510x277.jpg.webp 510w" width="1400" /></p>\r\n\r\n<p>C&aacute;c h&atilde;ng sản xuất laptop lu&ocirc;n cố gắng tạo sự kh&aacute;c biệt giữa d&ograve;ng m&aacute;y phổ th&ocirc;ng v&agrave; những d&ograve;ng laptop chuy&ecirc;n dụng. Thực ra đ&ocirc;i khi ch&uacute;ng ta cần nh&igrave;n lại v&agrave; x&aacute;c định nhu cầu sử dụng, mục đ&iacute;ch v&agrave; những k&igrave; vọng khi chọn mua một laptop. Trong khi những d&ograve;ng laptop phổ th&ocirc;ng thường hướng đến sự ph&aacute; c&aacute;ch, đổi mới về thiết kế. Th&igrave; d&ograve;ng m&aacute;y laptop doanh nghiệp thường c&oacute; bộ khung chắc chắn hơn, nhiều lựa chọn cấu h&igrave;nh v&agrave; sử dụng cũng linh hoạt hơn.</p>\r\n\r\n<p>Những c&ocirc;ng ty, tập đo&agrave;n khi mua sắm laptop cho nh&acirc;n vi&ecirc;n lu&ocirc;n k&igrave; vọng ch&uacute;ng c&oacute; thể hoạt động tốt trong tối thiểu 3 năm. V&igrave; thế để thoả m&atilde;n kh&aacute;ch h&agrave;ng của m&igrave;nh, d&ograve;ng laptop doanh nghiệp lu&ocirc;n được thiết kế c&oacute; độ bền cao hơn ti&ecirc;u chuẩn th&ocirc;ng thường. Ngay cả khi những g&igrave; bạn l&agrave;m chỉ l&agrave; duyệt email, lướt web hay l&agrave;m việc qua mạng x&atilde; hội, bạn cũng cảm thấy thoải m&aacute;i với chiếc laptop tối ưu ho&aacute; cho c&ocirc;ng việc.</p>\r\n\r\n<h3><strong>9 l&yacute; do sau đ&acirc;y sẽ khiến bạn suy nghĩ về lựa chọn mua laptop của m&igrave;nh:</strong></h3>\r\n\r\n<ol>\r\n	<li>\r\n	<h4><strong>Bền bỉ</strong></h4>\r\n\r\n	<p>Bạn cần một laptop sống s&oacute;t qua một c&uacute; rơi nhẹ, lỡ tay nhỏ v&agrave;i giọt nước, hay đơn giản l&agrave; chạy bền chạy khoẻ trong dăm ba năm? D&ograve;ng m&aacute;y Latitude v&agrave; Elitebook ch&iacute;nh l&agrave; 2 lựa chọn h&agrave;ng đầu của bạn. Bộ khung cứng c&aacute;p của những d&ograve;ng m&aacute;y doanh nghiệp đ&atilde; l&agrave;m n&ecirc;n t&ecirc;n tuổi của d&ograve;ng m&aacute;y n&agrave;y qua năm th&aacute;ng v&agrave; chiếm được niềm tin của nhiều kh&aacute;ch h&agrave;ng.</p>\r\n	</li>\r\n	<li>\r\n	<h4><strong>Dell Latitude được trang bị m&agrave;n h&igrave;nh chống ch&oacute;i, g&oacute;c nh&igrave;n rộng</strong></h4>\r\n\r\n	<p>M&agrave;n h&igrave;nh gương trở n&ecirc;n qu&aacute; phổ biến v&igrave; khả năng hiển thị m&agrave;u sắc tươi tắn, hấp dẫn &aacute;nh nh&igrave;n người d&ugrave;ng. Tuy nhi&ecirc;n m&agrave;n h&igrave;nh gương th&igrave; phản chiếu &aacute;nh s&aacute;ng v&agrave; ngay cả b&oacute;ng của bạn khi ngồi l&agrave;m việc. Điều n&agrave;y dẫn đến kh&oacute; tập trung quan s&aacute;t hơn l&agrave; m&agrave;n h&igrave;nh chống ch&oacute;i, đặc biệt khi l&agrave;m việc ngo&agrave;i trời hay trong điều kiện &aacute;nh s&aacute;ng mạnh.</p>\r\n	</li>\r\n	<li>\r\n	<h4><strong>B&agrave;n ph&iacute;m tốt hơn</strong></h4>\r\n\r\n	<p>L&agrave;m việc cả ng&agrave;y với một b&agrave;n ph&iacute;m laptop k&eacute;m chắc chắn l&agrave; một thảm hoạ. Bạn sẽ bị t&ecirc; tay, mỏi v&agrave; tệ hơn l&agrave; mất đi hứng th&uacute; khi l&agrave;m việc. B&agrave;n ph&iacute;m c&oacute; thể n&oacute;i l&agrave; bộ phận quan trọng h&agrave;ng đầu trong tương t&aacute;c giữa người v&agrave; laptop. V&igrave; thế chất lượng b&agrave;n ph&iacute;m ảnh hưởng rất lớn đến trải nghiệm sử dụng m&aacute;y. B&agrave;n ph&iacute;m của những d&ograve;ng m&aacute;y business như Latitude, Elitebook, Thinkpad đều c&oacute; h&agrave;nh tr&igrave;nh ph&iacute;m d&agrave;i, ph&iacute;m &iacute;t rung lắc v&agrave; &ecirc;m &aacute;i, d&ugrave; g&otilde; l&acirc;u vẫn kh&ocirc;ng ch&aacute;n. C&aacute;c ph&iacute;m bấm to, thiết kế &ocirc;m ng&oacute;n tay tạo cảm gi&aacute;c thoải m&aacute;i khi g&otilde;.</p>\r\n\r\n	<p><img alt="Dell laitude laptop doanh nghiệp tiêu chuẩn 2019" height="1080" loading="lazy" sizes="(max-width: 1620px) 100vw, 1620px" src="https://prolap.vn/wp-content/uploads/2018/04/dell-latitude-7490-new.jpg.webp" srcset="https://prolap.vn/wp-content/uploads/2018/04/dell-latitude-7490-new.jpg.webp 1620w, https://prolap.vn/wp-content/uploads/2018/04/dell-latitude-7490-new-247x165.jpg 247w, https://prolap.vn/wp-content/uploads/2018/04/dell-latitude-7490-new-510x340.jpg 510w, https://prolap.vn/wp-content/uploads/2018/04/dell-latitude-7490-new-300x200.jpg.webp 300w, https://prolap.vn/wp-content/uploads/2018/04/dell-latitude-7490-new-768x512.jpg.webp 768w, https://prolap.vn/wp-content/uploads/2018/04/dell-latitude-7490-new-1024x683.jpg.webp 1024w, https://prolap.vn/wp-content/uploads/2018/04/dell-latitude-7490-new-115x77.jpg.webp 115w, https://prolap.vn/wp-content/uploads/2018/04/dell-latitude-7490-new-150x100.jpg.webp 150w" width="1620" /></p>\r\n	</li>\r\n	<li>\r\n	<h4><strong>Touchpad v&agrave; n&uacute;t chuột bố tr&iacute; thuận ti&ecirc;n cho người hay g&otilde; văn bản nhiều.</strong></h4>\r\n\r\n	<p>N&uacute;t chuột l&agrave; t&iacute;nh năng thường chỉ c&oacute; tr&ecirc;n c&aacute;c d&ograve;ng m&aacute;y doanh nghiệp. Đa phần người d&ugrave;ng cho biết n&uacute;t chuột ch&iacute;nh x&aacute;c v&agrave; thuận tiện hơn touchpad, ng&oacute;n tay kh&ocirc;ng cần rời khỏi b&agrave;n ph&iacute;m chỉ để r&ecirc; touchpad. Những d&ograve;ng m&aacute;y như Latitude, Elitebook, Thinkpad c&ograve;n c&oacute; th&ecirc;m 2 ph&iacute;m tr&aacute;i phải ri&ecirc;ng cho chuột gi&uacute;p thao t&aacute;c dễ d&agrave;ng v&agrave; thuận tiện hơn.</p>\r\n	</li>\r\n	<li>\r\n	<h4><strong>Thời lượng pin tr&ecirc;n 3 tiếng l&agrave;m việc l&agrave; chuyện b&igrave;nh thường</strong></h4>\r\n\r\n	<p>Thời lượng pin trước nay lu&ocirc;n l&agrave; vấn đề nan giải với người d&ugrave;ng. Bạn muốn m&aacute;y mỏng nhẹ, cấu h&igrave;nh kh&aacute;, hiển nhi&ecirc;n thời lượng pin sẽ thấp. R&otilde; r&agrave;ng ch&uacute;ng ta kh&ocirc;ng thể n&agrave;o nh&eacute;t một vi&ecirc;n pin lớn v&agrave;o chiếc ultrabook mỏng d&iacute;nh được. D&ograve;ng laptop business như Latitude, Elitebook, tr&aacute;i lại, c&oacute; thời lượng pin rất tốt v&agrave; đảm bảo cho c&ocirc;ng việc của bạn tr&ocirc;i chảy cả khi cần di chuyển li&ecirc;n tục.</p>\r\n	</li>\r\n	<li>\r\n	<h4><strong>Hệ điều h&agrave;nh Windows Pro mặc định.</strong></h4>\r\n\r\n	<p>Rất &iacute;t người d&ugrave;ng nhận ra sự kh&aacute;c biệt cũng như &iacute;ch lợi của Windows Pro so với bản Home. Thực sự, đối với c&aacute;c doanh nghiệp, c&aacute;c t&iacute;nh năng bảo mật cũng như quản l&iacute; to&agrave;n diện của Windows Pro rất đ&aacute;ng gi&aacute;.&nbsp;Hệ điều h&agrave;nh Windows Pro đ&ocirc;i khi l&agrave; điều kiện bắt buộc cho laptop của nh&acirc;n vi&ecirc;n. C&aacute;c laptop doanh nghiệp như Dell Latitude c&oacute; điểm chung l&agrave; được c&agrave;i đặt Windows 10 Pro bản quyền. Gần như kh&ocirc;ng c&oacute; c&aacute;c phần mềm r&aacute;c c&agrave;i sẵn (hay c&ograve;n gọi l&agrave; bloatware) như c&aacute;c m&aacute;y phổ th&ocirc;ng. Ngo&agrave;i ra c&aacute;c d&ograve;ng m&aacute;y Dell Latitude thường được t&iacute;ch hợp bản quyền cho cả Windows 7 Pro v&agrave; Windows 10 Pro tr&ecirc;n c&ugrave;ng 1 m&aacute;y. Đảm bảo hỗ trợ tương th&iacute;ch ngược cho c&aacute;c phầm mềm đặc th&ugrave; ri&ecirc;ng biệt m&agrave; doanh nghiệp của bạn đang sử dụng.</p>\r\n	</li>\r\n	<li>\r\n	<h4><strong>Bảo mật cao</strong></h4>\r\n\r\n	<p>Đa phần c&aacute;c laptop doanh nghiệp đều c&oacute; những t&iacute;nh năng bảo mật vượt trội. Qu&eacute;t v&acirc;n tay, Smart Card (thẻ nhận diện bảo mật), t&iacute;nh năng tham gia v&agrave;o mạng nội bộ v&agrave;&nbsp; quản l&iacute; người d&ugrave;ng to&agrave;n diện (Domain Control), bảo mật dữ liệu (Bitlocker Encryption)&hellip; Những t&iacute;nh năng m&agrave; &iacute;t khi xuất hiện tr&ecirc;n c&aacute;c d&ograve;ng laptop phổ th&ocirc;ng.</p>\r\n	</li>\r\n	<li>\r\n	<h4><strong>V&ograve;ng đời sản phẩm d&agrave;i, hỗ trợ tối đa từ h&atilde;ng</strong></h4>\r\n\r\n	<p>V&igrave; những d&ograve;ng laptop doanh nghiệp n&agrave;y c&oacute; tuổi thọ tương đối d&agrave;i n&ecirc;n c&aacute;c h&atilde;ng laptop cũng c&oacute; ch&iacute;nh s&aacute;ch hỗ trợ d&agrave;i hơi. Thường thấy l&agrave; h&atilde;ng b&aacute;n th&ecirc;m bảo h&agrave;nh, b&aacute;n c&aacute;c linh kiện thay thế trong thời gian d&agrave;i&hellip; Dell v&agrave; HP cũng c&oacute; những ch&iacute;nh s&aacute;ch hỗ trợ tốt hơn cho c&aacute;c d&ograve;ng Latitude v&agrave; Elitebook so với những d&ograve;ng phổ th&ocirc;ng.</p>\r\n\r\n	<p><img alt="" height="760" loading="lazy" sizes="(max-width: 1400px) 100vw, 1400px" src="https://prolap.vn/wp-content/uploads/2019/01/dell-latitude-prolap.jpg.webp" srcset="https://prolap.vn/wp-content/uploads/2019/01/dell-latitude-prolap.jpg.webp 1400w, https://prolap.vn/wp-content/uploads/2019/01/dell-latitude-prolap-300x163.jpg.webp 300w, https://prolap.vn/wp-content/uploads/2019/01/dell-latitude-prolap-768x417.jpg.webp 768w, https://prolap.vn/wp-content/uploads/2019/01/dell-latitude-prolap-1024x556.jpg.webp 1024w, https://prolap.vn/wp-content/uploads/2019/01/dell-latitude-prolap-247x134.jpg.webp 247w, https://prolap.vn/wp-content/uploads/2019/01/dell-latitude-prolap-510x277.jpg.webp 510w" width="1400" /></p>\r\n	</li>\r\n	<li>\r\n	<h4><strong>Tỉ lệ Chi ph&iacute; / Hiệu năng</strong></h4>\r\n\r\n	<p>Đ&acirc;y cũng l&agrave; điểm người d&ugrave;ng dễ d&agrave;ng bỏ qua những lợi &iacute;ch của d&ograve;ng m&aacute;y laptop business: Gi&aacute; cả. Những m&aacute;y t&iacute;nh laptop doanh nghiệp thường c&oacute; gi&aacute; cao hơn c&aacute;c laptop phổ th&ocirc;ng từ v&agrave;i trăm ngh&igrave;n đến v&agrave;i triệu. Thế nhưng nếu sử dụng c&ocirc;ng thức Chi ph&iacute; / Hiệu năng, bạn sẽ bất ngờ với những g&igrave; m&igrave;nh nhận được. Cấu h&igrave;nh mạnh, b&agrave;n ph&iacute;m tốt hơn, thời lượng pin tốt hơn, bền bỉ&hellip; với gi&aacute; hợp l&iacute;. Qu&aacute; tuyệt!</p>\r\n	</li>\r\n</ol>\r\n\r\n<h3><strong>Lời kết</strong></h3>\r\n\r\n<p>Với 9 l&yacute; do tr&ecirc;n hẳn nhiều bạn đ&atilde; suy nghĩ lại v&agrave; nhận ra n&eacute;t đẹp cũng như sức mạnh tiềm ẩn của d&ograve;ng m&aacute;y business. Phương ch&acirc;m thiết kế của những d&ograve;ng laptop n&agrave;y l&agrave; &ldquo;Bền vững, kh&ocirc;ng ph&ocirc; trương&rdquo;. Chắc chắn sẽ mang lại những trải nghiệm l&agrave;m việc tốt nhất cho người d&ugrave;ng.</p>\r\n\r\n<p>Prolap.vn đang tự h&agrave;o l&agrave; đơn vị nhập khẩu v&agrave; kinh doanh d&ograve;ng m&aacute;y Dell Latitude nhập khẩu với chất lượng tốt nhất. H&agrave;ng mới 100% nhập ch&iacute;nh ngạch c&oacute; ho&aacute; đơn VAT, (<a href="https://prolap.vn/san-pham/dell-latitude/">gi&aacute; Dell Latitude</a>&nbsp;ni&ecirc;m yết đ&atilde; bao gồm VAT) số lượng lớn sẵn s&agrave;ng cung cấp cho kh&aacute;ch h&agrave;ng doanh nghiệp. H&atilde;y nhanh tay li&ecirc;n hệ với ch&uacute;ng t&ocirc;i để được b&aacute;o gi&aacute; tham khảo những mẫu laptop business tuyệt vời n&agrave;y nh&eacute;!</p>', 0, 0, '', '', '2021-01-04 15:24:00', '2021-01-04 15:24:45', 1, 0, 0, '', 0, '', 0, '*', '', '2021-01-04 15:24:02', '2021-01-04 15:24:45');
/*!40000 ALTER TABLE `co_content` ENABLE KEYS */;

-- Dumping structure for table laravel.co_customers
DROP TABLE IF EXISTS `co_customers`;
CREATE TABLE IF NOT EXISTS `co_customers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `phone_number` int(11) NOT NULL,
  `note` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table laravel.co_customers: ~0 rows (approximately)
/*!40000 ALTER TABLE `co_customers` DISABLE KEYS */;
/*!40000 ALTER TABLE `co_customers` ENABLE KEYS */;

-- Dumping structure for table laravel.co_menu
DROP TABLE IF EXISTS `co_menu`;
CREATE TABLE IF NOT EXISTS `co_menu` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `alias` varchar(400) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `description` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `menutype_id` int(10) unsigned NOT NULL DEFAULT '0',
  `onsite` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `parent_id` int(11) DEFAULT NULL,
  `lft` int(11) DEFAULT NULL,
  `rgt` int(11) DEFAULT NULL,
  `depth` int(11) DEFAULT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `target` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `home` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `language` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '*',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `co_menu_parent_id_index` (`parent_id`),
  KEY `co_menu_lft_index` (`lft`),
  KEY `co_menu_rgt_index` (`rgt`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table laravel.co_menu: ~0 rows (approximately)
/*!40000 ALTER TABLE `co_menu` DISABLE KEYS */;
/*!40000 ALTER TABLE `co_menu` ENABLE KEYS */;

-- Dumping structure for table laravel.co_menu_types
DROP TABLE IF EXISTS `co_menu_types`;
CREATE TABLE IF NOT EXISTS `co_menu_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `language` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table laravel.co_menu_types: ~0 rows (approximately)
/*!40000 ALTER TABLE `co_menu_types` DISABLE KEYS */;
INSERT INTO `co_menu_types` (`id`, `title`, `description`, `language`, `created_at`, `updated_at`) VALUES
	(1, 'Menu Top', '', '*', '2019-03-13 12:30:01', '2019-03-13 12:30:01');
/*!40000 ALTER TABLE `co_menu_types` ENABLE KEYS */;

-- Dumping structure for table laravel.co_pages
DROP TABLE IF EXISTS `co_pages`;
CREATE TABLE IF NOT EXISTS `co_pages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `alias` varchar(400) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `layout` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `attribs` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `language` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '*',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table laravel.co_pages: ~0 rows (approximately)
/*!40000 ALTER TABLE `co_pages` DISABLE KEYS */;
/*!40000 ALTER TABLE `co_pages` ENABLE KEYS */;

-- Dumping structure for table laravel.co_password_resets
DROP TABLE IF EXISTS `co_password_resets`;
CREATE TABLE IF NOT EXISTS `co_password_resets` (
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `co_password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table laravel.co_password_resets: ~0 rows (approximately)
/*!40000 ALTER TABLE `co_password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `co_password_resets` ENABLE KEYS */;

-- Dumping structure for table laravel.co_products
DROP TABLE IF EXISTS `co_products`;
CREATE TABLE IF NOT EXISTS `co_products` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `alias` varchar(400) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(1000) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `price` int(10) unsigned NOT NULL DEFAULT '0',
  `price_contact` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `price_compare` int(10) unsigned NOT NULL DEFAULT '0',
  `vat` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `sku` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `barcode` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `inventory` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `quantity` int(10) unsigned NOT NULL DEFAULT '1',
  `inventory_policy` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `meta_title` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `meta_keywords` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `meta_description` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `images` varchar(1000) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `publish_up` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `category_id` int(10) unsigned NOT NULL DEFAULT '0',
  `vendor_id` int(10) unsigned NOT NULL DEFAULT '0',
  `language` varchar(5) COLLATE utf8_unicode_ci NOT NULL DEFAULT '*',
  `hits` int(10) unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table laravel.co_products: ~0 rows (approximately)
/*!40000 ALTER TABLE `co_products` DISABLE KEYS */;
INSERT INTO `co_products` (`id`, `title`, `alias`, `content`, `description`, `price`, `price_contact`, `price_compare`, `vat`, `sku`, `barcode`, `inventory`, `quantity`, `inventory_policy`, `meta_title`, `meta_keywords`, `meta_description`, `images`, `status`, `publish_up`, `category_id`, `vendor_id`, `language`, `hits`, `created_at`, `updated_at`) VALUES
	(1, 'Laptop Dell Vostro 3590 i7 10510U/8GB/256GB/2GB 610R5/Win10 (GRMGK2)', 'laptop-dell-vostro-3590-i7-10510u8gb256gb2gb-610r5win10-grmgk2', '<h3><a href="https://www.dienmayxanh.com/laptop/dell-vostro-3590-i7-grmgk2" target="_blank" title=" Laptop Dell Vostro 3590 i7 (GRMGK2) đang được kinh doanh tại Dienmayxanh.com" type=" Laptop Dell Vostro 3590 i7 (GRMGK2) đang được kinh doanh tại Dienmayxanh.com">Laptop Dell Vostro 3590 i7 (GRMGK2)</a>&nbsp;l&agrave; chiếc laptop được trang bị cấu h&igrave;nh mạnh sử dụng mượt m&agrave; ứng dụng văn ph&ograve;ng v&agrave; đồ họa, học tập. Dell Vostro 3590 laptop l&iacute; tưởng cho sinh vi&ecirc;n, hay người l&agrave;m đồ họa kĩ thuật.</h3>\r\n\r\n<h3>Hiệu năng ổn định cho sử dụng văn ph&ograve;ng v&agrave; đồ họa</h3>\r\n\r\n<p>Laptop trang bị bộ vi xử l&yacute;<strong>&nbsp;Intel&nbsp;<a href="https://www.dienmayxanh.com/laptop?g=core-i7" target="_blank" title="Xem thêm các laptop Core i7 đang bán tại Dienmayxanh.com" type="Xem thêm các laptop Core i7 đang bán tại Dienmayxanh.com">Core i7</a></strong>&nbsp;thế hệ thứ 10 tốc độ l&ecirc;n đ&ecirc;́n 4.9 GHz hiệu năng cao v&agrave; tiết kiệm điện năng hiệu quả.</p>\r\n\r\n<p><a href="https://www.dienmayxanh.com/laptop?g=8-gb" target="_blank" title="Laptop được trang bị RAM 8 GB đang kinh doanh tại Dienmayxanh.com" type="Laptop được trang bị RAM 8 GB đang kinh doanh tại Dienmayxanh.com"><strong>RAM 8 GB</strong></a>&nbsp;đa nhiệm mượt m&agrave;, mở khoảng hơn 20 tab Chrome kh&ocirc;ng giật lắc, sử dụng c&aacute;c ứng dụng đồ họa 2D như Photoshop, Ai ổn định.</p>', '', 20490000, 0, 20990000, 1, '0001', '', 0, 1, 0, 'Laptop Dell Vostro 3590 i7 10510U/8GB/256GB/2GB 610R5/Win10 (GRMGK2)', '', '', 'dc6a4dd608539653addcd374e8553134.jpg', 1, '2021-01-04 15:17:32', 2, 0, '*', 0, '2021-01-04 15:17:32', '2021-01-04 15:17:32');
/*!40000 ALTER TABLE `co_products` ENABLE KEYS */;

-- Dumping structure for table laravel.co_products_categories
DROP TABLE IF EXISTS `co_products_categories`;
CREATE TABLE IF NOT EXISTS `co_products_categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alias` varchar(400) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `lft` int(11) DEFAULT NULL,
  `rgt` int(11) DEFAULT NULL,
  `depth` int(11) DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(3) unsigned NOT NULL,
  `ordering` int(10) unsigned NOT NULL,
  `language` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `co_products_categories_parent_id_index` (`parent_id`),
  KEY `co_products_categories_lft_index` (`lft`),
  KEY `co_products_categories_rgt_index` (`rgt`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table laravel.co_products_categories: ~1 rows (approximately)
/*!40000 ALTER TABLE `co_products_categories` DISABLE KEYS */;
INSERT INTO `co_products_categories` (`id`, `title`, `alias`, `parent_id`, `lft`, `rgt`, `depth`, `description`, `status`, `ordering`, `language`, `created_at`, `updated_at`) VALUES
	(2, 'Laptop DELL', 'laptop-dell', NULL, 1, 2, 0, '', 1, 0, '*', '2021-01-04 15:15:16', '2021-01-04 15:15:16');
/*!40000 ALTER TABLE `co_products_categories` ENABLE KEYS */;

-- Dumping structure for table laravel.co_products_groups
DROP TABLE IF EXISTS `co_products_groups`;
CREATE TABLE IF NOT EXISTS `co_products_groups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alias` varchar(400) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(3) unsigned NOT NULL,
  `language` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table laravel.co_products_groups: ~0 rows (approximately)
/*!40000 ALTER TABLE `co_products_groups` DISABLE KEYS */;
/*!40000 ALTER TABLE `co_products_groups` ENABLE KEYS */;

-- Dumping structure for table laravel.co_users
DROP TABLE IF EXISTS `co_users`;
CREATE TABLE IF NOT EXISTS `co_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fullname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `group_id` int(10) unsigned NOT NULL DEFAULT '0',
  `remark` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table laravel.co_users: ~0 rows (approximately)
/*!40000 ALTER TABLE `co_users` DISABLE KEYS */;
INSERT INTO `co_users` (`id`, `name`, `fullname`, `email`, `password`, `group_id`, `remark`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'admin', 'Nguyễn Nhật Trường', 'nntruong91@gmail.com', '$2y$10$B7Hf7Ag3CommV38IUUkpRu0nSpKVGNON3AytNk4aAmTf3bxF443FW', 1, '', 'vIUb9tDjv0MEC426kFWCG0zo5hXisXNlaRK2gfjJL5VmzZtzbXczwrBm9Td6', NULL, '2019-03-13 08:55:22');
/*!40000 ALTER TABLE `co_users` ENABLE KEYS */;

-- Dumping structure for table laravel.co_users_groups
DROP TABLE IF EXISTS `co_users_groups`;
CREATE TABLE IF NOT EXISTS `co_users_groups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `lft` int(11) DEFAULT NULL,
  `rgt` int(11) DEFAULT NULL,
  `depth` int(11) DEFAULT NULL,
  `rules` varchar(3000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `co_users_groups_parent_id_index` (`parent_id`),
  KEY `co_users_groups_lft_index` (`lft`),
  KEY `co_users_groups_rgt_index` (`rgt`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table laravel.co_users_groups: ~0 rows (approximately)
/*!40000 ALTER TABLE `co_users_groups` DISABLE KEYS */;
INSERT INTO `co_users_groups` (`id`, `title`, `parent_id`, `lft`, `rgt`, `depth`, `rules`, `created_at`, `updated_at`) VALUES
	(1, 'Admin', 0, 1, 2, 0, '*', NULL, NULL);
/*!40000 ALTER TABLE `co_users_groups` ENABLE KEYS */;

-- Dumping structure for table laravel.co_users_groups_users_map
DROP TABLE IF EXISTS `co_users_groups_users_map`;
CREATE TABLE IF NOT EXISTS `co_users_groups_users_map` (
  `user_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table laravel.co_users_groups_users_map: ~0 rows (approximately)
/*!40000 ALTER TABLE `co_users_groups_users_map` DISABLE KEYS */;
INSERT INTO `co_users_groups_users_map` (`user_id`, `group_id`) VALUES
	(1, 1);
/*!40000 ALTER TABLE `co_users_groups_users_map` ENABLE KEYS */;

-- Dumping structure for table laravel.co_widgets
DROP TABLE IF EXISTS `co_widgets`;
CREATE TABLE IF NOT EXISTS `co_widgets` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `show_title` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `layout` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `position` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ordering` int(10) unsigned NOT NULL DEFAULT '0',
  `widget` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `params` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `language` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '*',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table laravel.co_widgets: ~6 rows (approximately)
/*!40000 ALTER TABLE `co_widgets` DISABLE KEYS */;
INSERT INTO `co_widgets` (`id`, `title`, `content`, `link`, `status`, `show_title`, `layout`, `position`, `ordering`, `widget`, `access`, `params`, `options`, `language`, `created_at`, `updated_at`) VALUES
	(1, 'Hotline', 'Hotline: <span class="color-red font-size-1d2"><strong>0948 087 939</strong></span>', '', 1, 0, 'transparent', 'header_left', 0, 'custom_html', '', '', '', '*', '2019-03-13 09:14:10', '2019-03-13 09:53:22'),
	(4, 'Search', '', '', 1, 0, 'blank', 'header_middle', 0, 'search', '', '{"class":null,"menutype_id":null}', '', '*', '2019-03-13 09:57:06', '2019-03-13 10:04:40'),
	(5, 'Logo', '<a href="#">\r\n                        <div class="logo"></div>\r\n                    </a>', '', 1, 0, 'blank', 'header_main_left', 0, 'custom_html', '', '', '', '*', '2019-03-13 12:33:14', '2019-03-13 12:33:35'),
	(6, 'Menu ngang', '', '', 1, 0, 'blank', 'header_main_right', 0, 'navbar', '', '{"class":"menu-white mt-1 font-size-1d1 color-black font-bold","menutype_id":"1"}', '', '*', '2019-03-13 12:34:00', '2019-04-12 15:27:25'),
	(7, 'Carousel Bootstrap', '', '', 1, 1, 'blank', 'body', 0, 'carousel_bootstrap', '', '{"images":"http:\\/\\/laravel.local\\/uploads\\/media\\/banners\\/banner-1.png\\r\\nhttp:\\/\\/laravel.local\\/uploads\\/media\\/banners\\/banner-2.jpg","links":null,"controls":"0","indicators":"0","crossfade":"0","class":null}', '{"session":{"class":"","attr":""},"header":{"class":"","attr":""},"body":{"class":"","attr":""}}', '*', '2019-03-13 12:42:01', '2021-01-04 14:48:32'),
	(9, 'Blog', '', '', 1, 1, 'default', 'body', 2, 'content_list', '', '{"category":"1","quantity":"5","columns":"3","template":"2","showImage":"1","showTitle":"1","showIntro":"1","subIntro":"150","slider":"1"}', '{"session":{"class":"mt-5","attr":""},"header":{"class":"","attr":""},"body":{"class":"","attr":""}}', '*', '2019-03-13 12:49:24', '2021-01-04 15:25:11'),
	(14, 'Laptop DELL', '', '', 1, 1, 'default', 'body', 1, 'products_list', '', '{"category":"2","quantity":null,"columns":null,"template":"1","showImage":"1","showTitle":"1","showIntro":"0","subIntro":"200","slider":"0"}', '{"session":{"class":"mt-5","attr":""},"header":{"class":"color-green","attr":""},"body":{"class":"","attr":""}}', '*', '2021-01-04 15:18:16', '2021-01-04 15:20:06');
/*!40000 ALTER TABLE `co_widgets` ENABLE KEYS */;

-- Dumping structure for table laravel.migrations
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table laravel.migrations: ~24 rows (approximately)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_resets_table', 1),
	(3, '2017_10_20_163619_create_config_table', 1),
	(4, '2017_12_18_094913_create_content_table', 1),
	(5, '2018_03_21_131807_create_categories_table', 1),
	(6, '2018_05_16_160623_create_widgets_table', 1),
	(7, '2018_05_26_162123_create_pages_table', 1),
	(8, '2018_05_28_111909_create_contact_table', 1),
	(9, '2018_06_13_114933_create_menu_types_table', 1),
	(10, '2018_06_13_115958_create_menu', 1),
	(12, '2018_08_03_113419_create_users_groups_table', 1),
	(13, '2018_08_03_113947_create_users_groups_users_map_table', 1),
	(14, '2018_08_08_112601_create_products_categories_table', 1),
	(15, '2018_08_08_112931_create_products_groups_table', 1),
	(33, '2018_06_19_114557_create_products_table', 2),
	(34, '2019_10_12_220307_create_apartment_table', 2),
	(35, '2019_10_19_080927_create_table_apartment_types_table', 2),
	(36, '2019_10_19_221029_create_apartment_locations_table', 2),
	(37, '2019_10_24_130847_create_attributes_table', 2),
	(38, '2019_10_24_132925_create_attributes_values_table', 2),
	(39, '2019_10_27_203245_create_customers_table', 2),
	(40, '2019_10_27_203353_create_bills_table', 2),
	(41, '2019_10_27_203414_create_bill_details_table', 2),
	(42, '2019_11_15_204513_create_apartment_utilities_table', 2);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Dumping structure for table laravel.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fullname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table laravel.users: ~2 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `fullname`, `email`) VALUES
	(1, 'Truong Nguyen Nhat', 'nntruong91@gmail.com');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
