SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

CREATE DATABASE IF NOT EXISTS `zf2invoices` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `zf2invoices`;

CREATE TABLE IF NOT EXISTS `addressbook` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` bigint(20) unsigned DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `contact_type` varchar(30) NOT NULL,
  `email` varchar(255) NOT NULL,
  `fax` varchar(15) NOT NULL,
  `telephone` varchar(15) NOT NULL,
  `country` varchar(3) NOT NULL,
  `locality` varchar(100) NOT NULL,
  `region` varchar(100) NOT NULL,
  `postalcode` varchar(30) NOT NULL,
  `street` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_CUSTOMER` (`customer_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `clients` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `tax_id` varchar(15) DEFAULT NULL COMMENT 'The Tax / Fiscal ID of the organization or person, e.g. the TIN in the US or the CIF/NIF in Spain.',
  `street` varchar(255) NOT NULL,
  `street2` varchar(255) DEFAULT NULL,
  `locality` varchar(255) NOT NULL,
  `region` varchar(255) NOT NULL,
  `zip` varchar(20) NOT NULL,
  `country_iso` char(2) NOT NULL,
  `phone` varchar(30) DEFAULT NULL,
  `fax` varchar(30) DEFAULT NULL,
  `notes` longtext,
  PRIMARY KEY (`id`),
  KEY `IDX_COUNTRY` (`country_iso`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `countries` (
  `iso` char(2) NOT NULL,
  `english_name` varchar(80) NOT NULL,
  `iso3` char(3) DEFAULT NULL,
  `numcode` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`iso`),
  UNIQUE KEY `english_name` (`english_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='ISO 3166 - Countries';

CREATE TABLE IF NOT EXISTS `options` (
  `key` varchar(64) NOT NULL,
  `value` text,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `products` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text,
  `unit_price` decimal(21,2) NOT NULL COMMENT 'Unit price',
  `unit_cost` decimal(21,2) NOT NULL DEFAULT '0.00',
  `tax_id` int(10) unsigned NOT NULL,
  `item_type` varchar(20) NOT NULL DEFAULT 'product',
  PRIMARY KEY (`id`),
  KEY `IDX_TAX_ID` (`tax_id`),
  KEY `IDX_ITEM_TYPE` (`item_type`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `sessions` (
  `id` char(32) NOT NULL DEFAULT '',
  `name` char(32) NOT NULL DEFAULT '',
  `modified` int(11) DEFAULT NULL,
  `lifetime` int(11) DEFAULT NULL,
  `data` text,
  PRIMARY KEY (`id`,`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `taxes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `description` varchar(50) NOT NULL,
  `percentage` decimal(4,1) NOT NULL,
  `equalization` decimal(4,1) DEFAULT NULL COMMENT 'Recargo de equivalencia',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `UX_DESCRIPTION` (`description`),
  KEY `IX_ACTIVE` (`active`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Equivalente a IVAS.DBF';

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `displayname` varchar(50) DEFAULT NULL,
  `password` varchar(128) NOT NULL,
  `state` smallint(5) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `user_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `roleId` varchar(255) NOT NULL,
  `is_default` tinyint(1) NOT NULL,
  `parent_id` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `user_role_linker` (
  `user_id` int(11) unsigned NOT NULL,
  `role_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`role_id`),
  KEY `role_id` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


ALTER TABLE `addressbook`
  ADD CONSTRAINT `fk_customer_id` FOREIGN KEY (`customer_id`) REFERENCES `clients` (`id`);

ALTER TABLE `clients`
  ADD CONSTRAINT `fk_country` FOREIGN KEY (`country_iso`) REFERENCES `countries` (`iso`);

ALTER TABLE `products`
  ADD CONSTRAINT `fk_tax_id` FOREIGN KEY (`tax_id`) REFERENCES `taxes` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
