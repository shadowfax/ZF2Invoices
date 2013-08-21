SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `zf2invoices`
--
CREATE DATABASE IF NOT EXISTS `zf2invoices` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `zf2invoices`;


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clients`
--

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `client_contact_linker`
--

CREATE TABLE IF NOT EXISTS `client_contact_linker` (
  `client_id` bigint(20) unsigned NOT NULL,
  `contact_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`client_id`,`contact_id`),
  KEY `contact_id` (`contact_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contacts`
--

CREATE TABLE IF NOT EXISTS `contacts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `mobile_phone` varchar(15) DEFAULT NULL,
  `contact_type` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `countries`
--

CREATE TABLE IF NOT EXISTS `countries` (
  `iso` char(2) NOT NULL,
  `english_name` varchar(80) NOT NULL,
  `iso3` char(3) DEFAULT NULL,
  `numcode` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`iso`),
  UNIQUE KEY `english_name` (`english_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='ISO 3166 - Countries';

--
-- Volcado de datos para la tabla `countries`
--

INSERT INTO `countries` (`iso`, `english_name`, `iso3`, `numcode`) VALUES
('AD', 'Andorra', 'AND', 20),
('AE', 'United Arab Emirates', 'ARE', 784),
('AF', 'Afghanistan', 'AFG', 4),
('AG', 'Antigua and Barbuda', 'ATG', 28),
('AI', 'Anguilla', 'AIA', 660),
('AL', 'Albania', 'ALB', 8),
('AM', 'Armenia', 'ARM', 51),
('AN', 'Netherlands Antilles', 'ANT', 530),
('AO', 'Angola', 'AGO', 24),
('AQ', 'Antarctica', NULL, NULL),
('AR', 'Argentina', 'ARG', 32),
('AS', 'American Samoa', 'ASM', 16),
('AT', 'Austria', 'AUT', 40),
('AU', 'Australia', 'AUS', 36),
('AW', 'Aruba', 'ABW', 533),
('AZ', 'Azerbaijan', 'AZE', 31),
('BA', 'Bosnia and Herzegovina', 'BIH', 70),
('BB', 'Barbados', 'BRB', 52),
('BD', 'Bangladesh', 'BGD', 50),
('BE', 'Belgium', 'BEL', 56),
('BF', 'Burkina Faso', 'BFA', 854),
('BG', 'Bulgaria', 'BGR', 100),
('BH', 'Bahrain', 'BHR', 48),
('BI', 'Burundi', 'BDI', 108),
('BJ', 'Benin', 'BEN', 204),
('BM', 'Bermuda', 'BMU', 60),
('BN', 'Brunei Darussalam', 'BRN', 96),
('BO', 'Bolivia', 'BOL', 68),
('BR', 'Brazil', 'BRA', 76),
('BS', 'Bahamas', 'BHS', 44),
('BT', 'Bhutan', 'BTN', 64),
('BV', 'Bouvet Island', NULL, NULL),
('BW', 'Botswana', 'BWA', 72),
('BY', 'Belarus', 'BLR', 112),
('BZ', 'Belize', 'BLZ', 84),
('CA', 'Canada', 'CAN', 124),
('CC', 'Cocos (Keeling) Islands', NULL, NULL),
('CD', 'Congo, the Democratic Republic of the', 'COD', 180),
('CF', 'Central African Republic', 'CAF', 140),
('CG', 'Congo', 'COG', 178),
('CH', 'Switzerland', 'CHE', 756),
('CI', 'Cote D''Ivoire', 'CIV', 384),
('CK', 'Cook Islands', 'COK', 184),
('CL', 'Chile', 'CHL', 152),
('CM', 'Cameroon', 'CMR', 120),
('CN', 'China', 'CHN', 156),
('CO', 'Colombia', 'COL', 170),
('CR', 'Costa Rica', 'CRI', 188),
('CS', 'Serbia and Montenegro', NULL, NULL),
('CU', 'Cuba', 'CUB', 192),
('CV', 'Cape Verde', 'CPV', 132),
('CX', 'Christmas Island', NULL, NULL),
('CY', 'Cyprus', 'CYP', 196),
('CZ', 'Czech Republic', 'CZE', 203),
('DE', 'Germany', 'DEU', 276),
('DJ', 'Djibouti', 'DJI', 262),
('DK', 'Denmark', 'DNK', 208),
('DM', 'Dominica', 'DMA', 212),
('DO', 'Dominican Republic', 'DOM', 214),
('DZ', 'Algeria', 'DZA', 12),
('EC', 'Ecuador', 'ECU', 218),
('EE', 'Estonia', 'EST', 233),
('EG', 'Egypt', 'EGY', 818),
('EH', 'Western Sahara', 'ESH', 732),
('ER', 'Eritrea', 'ERI', 232),
('ES', 'Spain', 'ESP', 724),
('ET', 'Ethiopia', 'ETH', 231),
('FI', 'Finland', 'FIN', 246),
('FJ', 'Fiji', 'FJI', 242),
('FK', 'Falkland Islands (Malvinas)', 'FLK', 238),
('FM', 'Micronesia, Federated States of', 'FSM', 583),
('FO', 'Faroe Islands', 'FRO', 234),
('FR', 'France', 'FRA', 250),
('GA', 'Gabon', 'GAB', 266),
('GB', 'United Kingdom', 'GBR', 826),
('GD', 'Grenada', 'GRD', 308),
('GE', 'Georgia', 'GEO', 268),
('GF', 'French Guiana', 'GUF', 254),
('GH', 'Ghana', 'GHA', 288),
('GI', 'Gibraltar', 'GIB', 292),
('GL', 'Greenland', 'GRL', 304),
('GM', 'Gambia', 'GMB', 270),
('GN', 'Guinea', 'GIN', 324),
('GP', 'Guadeloupe', 'GLP', 312),
('GQ', 'Equatorial Guinea', 'GNQ', 226),
('GR', 'Greece', 'GRC', 300),
('GS', 'South Georgia and the South Sandwich Islands', NULL, NULL),
('GT', 'Guatemala', 'GTM', 320),
('GU', 'Guam', 'GUM', 316),
('GW', 'Guinea-Bissau', 'GNB', 624),
('GY', 'Guyana', 'GUY', 328),
('HK', 'Hong Kong', 'HKG', 344),
('HM', 'Heard Island and Mcdonald Islands', NULL, NULL),
('HN', 'Honduras', 'HND', 340),
('HR', 'Croatia', 'HRV', 191),
('HT', 'Haiti', 'HTI', 332),
('HU', 'Hungary', 'HUN', 348),
('ID', 'Indonesia', 'IDN', 360),
('IE', 'Ireland', 'IRL', 372),
('IL', 'Israel', 'ISR', 376),
('IN', 'India', 'IND', 356),
('IO', 'British Indian Ocean Territory', NULL, NULL),
('IQ', 'Iraq', 'IRQ', 368),
('IR', 'Iran, Islamic Republic of', 'IRN', 364),
('IS', 'Iceland', 'ISL', 352),
('IT', 'Italy', 'ITA', 380),
('JM', 'Jamaica', 'JAM', 388),
('JO', 'Jordan', 'JOR', 400),
('JP', 'Japan', 'JPN', 392),
('KE', 'Kenya', 'KEN', 404),
('KG', 'Kyrgyzstan', 'KGZ', 417),
('KH', 'Cambodia', 'KHM', 116),
('KI', 'Kiribati', 'KIR', 296),
('KM', 'Comoros', 'COM', 174),
('KN', 'Saint Kitts and Nevis', 'KNA', 659),
('KP', 'Korea, Democratic People''s Republic of', 'PRK', 408),
('KR', 'Korea, Republic of', 'KOR', 410),
('KW', 'Kuwait', 'KWT', 414),
('KY', 'Cayman Islands', 'CYM', 136),
('KZ', 'Kazakhstan', 'KAZ', 398),
('LA', 'Lao People''s Democratic Republic', 'LAO', 418),
('LB', 'Lebanon', 'LBN', 422),
('LC', 'Saint Lucia', 'LCA', 662),
('LI', 'Liechtenstein', 'LIE', 438),
('LK', 'Sri Lanka', 'LKA', 144),
('LR', 'Liberia', 'LBR', 430),
('LS', 'Lesotho', 'LSO', 426),
('LT', 'Lithuania', 'LTU', 440),
('LU', 'Luxembourg', 'LUX', 442),
('LV', 'Latvia', 'LVA', 428),
('LY', 'Libyan Arab Jamahiriya', 'LBY', 434),
('MA', 'Morocco', 'MAR', 504),
('MC', 'Monaco', 'MCO', 492),
('MD', 'Moldova, Republic of', 'MDA', 498),
('MG', 'Madagascar', 'MDG', 450),
('MH', 'Marshall Islands', 'MHL', 584),
('MK', 'Macedonia, the Former Yugoslav Republic of', 'MKD', 807),
('ML', 'Mali', 'MLI', 466),
('MM', 'Myanmar', 'MMR', 104),
('MN', 'Mongolia', 'MNG', 496),
('MO', 'Macao', 'MAC', 446),
('MP', 'Northern Mariana Islands', 'MNP', 580),
('MQ', 'Martinique', 'MTQ', 474),
('MR', 'Mauritania', 'MRT', 478),
('MS', 'Montserrat', 'MSR', 500),
('MT', 'Malta', 'MLT', 470),
('MU', 'Mauritius', 'MUS', 480),
('MV', 'Maldives', 'MDV', 462),
('MW', 'Malawi', 'MWI', 454),
('MX', 'Mexico', 'MEX', 484),
('MY', 'Malaysia', 'MYS', 458),
('MZ', 'Mozambique', 'MOZ', 508),
('NA', 'Namibia', 'NAM', 516),
('NC', 'New Caledonia', 'NCL', 540),
('NE', 'Niger', 'NER', 562),
('NF', 'Norfolk Island', 'NFK', 574),
('NG', 'Nigeria', 'NGA', 566),
('NI', 'Nicaragua', 'NIC', 558),
('NL', 'Netherlands', 'NLD', 528),
('NO', 'Norway', 'NOR', 578),
('NP', 'Nepal', 'NPL', 524),
('NR', 'Nauru', 'NRU', 520),
('NU', 'Niue', 'NIU', 570),
('NZ', 'New Zealand', 'NZL', 554),
('OM', 'Oman', 'OMN', 512),
('PA', 'Panama', 'PAN', 591),
('PE', 'Peru', 'PER', 604),
('PF', 'French Polynesia', 'PYF', 258),
('PG', 'Papua New Guinea', 'PNG', 598),
('PH', 'Philippines', 'PHL', 608),
('PK', 'Pakistan', 'PAK', 586),
('PL', 'Poland', 'POL', 616),
('PM', 'Saint Pierre and Miquelon', 'SPM', 666),
('PN', 'Pitcairn', 'PCN', 612),
('PR', 'Puerto Rico', 'PRI', 630),
('PS', 'Palestinian Territory, Occupied', NULL, NULL),
('PT', 'Portugal', 'PRT', 620),
('PW', 'Palau', 'PLW', 585),
('PY', 'Paraguay', 'PRY', 600),
('QA', 'Qatar', 'QAT', 634),
('RE', 'Reunion', 'REU', 638),
('RO', 'Romania', 'ROM', 642),
('RU', 'Russian Federation', 'RUS', 643),
('RW', 'Rwanda', 'RWA', 646),
('SA', 'Saudi Arabia', 'SAU', 682),
('SB', 'Solomon Islands', 'SLB', 90),
('SC', 'Seychelles', 'SYC', 690),
('SD', 'Sudan', 'SDN', 736),
('SE', 'Sweden', 'SWE', 752),
('SG', 'Singapore', 'SGP', 702),
('SH', 'Saint Helena', 'SHN', 654),
('SI', 'Slovenia', 'SVN', 705),
('SJ', 'Svalbard and Jan Mayen', 'SJM', 744),
('SK', 'Slovakia', 'SVK', 703),
('SL', 'Sierra Leone', 'SLE', 694),
('SM', 'San Marino', 'SMR', 674),
('SN', 'Senegal', 'SEN', 686),
('SO', 'Somalia', 'SOM', 706),
('SR', 'Suriname', 'SUR', 740),
('ST', 'Sao Tome and Principe', 'STP', 678),
('SV', 'El Salvador', 'SLV', 222),
('SY', 'Syrian Arab Republic', 'SYR', 760),
('SZ', 'Swaziland', 'SWZ', 748),
('TC', 'Turks and Caicos Islands', 'TCA', 796),
('TD', 'Chad', 'TCD', 148),
('TF', 'French Southern Territories', NULL, NULL),
('TG', 'Togo', 'TGO', 768),
('TH', 'Thailand', 'THA', 764),
('TJ', 'Tajikistan', 'TJK', 762),
('TK', 'Tokelau', 'TKL', 772),
('TL', 'Timor-Leste', NULL, NULL),
('TM', 'Turkmenistan', 'TKM', 795),
('TN', 'Tunisia', 'TUN', 788),
('TO', 'Tonga', 'TON', 776),
('TR', 'Turkey', 'TUR', 792),
('TT', 'Trinidad and Tobago', 'TTO', 780),
('TV', 'Tuvalu', 'TUV', 798),
('TW', 'Taiwan, Province of China', 'TWN', 158),
('TZ', 'Tanzania, United Republic of', 'TZA', 834),
('UA', 'Ukraine', 'UKR', 804),
('UG', 'Uganda', 'UGA', 800),
('UM', 'United States Minor Outlying Islands', NULL, NULL),
('US', 'United States', 'USA', 840),
('UY', 'Uruguay', 'URY', 858),
('UZ', 'Uzbekistan', 'UZB', 860),
('VA', 'Holy See (Vatican City State)', 'VAT', 336),
('VC', 'Saint Vincent and the Grenadines', 'VCT', 670),
('VE', 'Venezuela', 'VEN', 862),
('VG', 'Virgin Islands, British', 'VGB', 92),
('VI', 'Virgin Islands, U.s.', 'VIR', 850),
('VN', 'Viet Nam', 'VNM', 704),
('VU', 'Vanuatu', 'VUT', 548),
('WF', 'Wallis and Futuna', 'WLF', 876),
('WS', 'Samoa', 'WSM', 882),
('YE', 'Yemen', 'YEM', 887),
('YT', 'Mayotte', NULL, NULL),
('ZA', 'South Africa', 'ZAF', 710),
('ZM', 'Zambia', 'ZMB', 894),
('ZW', 'Zimbabwe', 'ZWE', 716);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `options`
--

CREATE TABLE IF NOT EXISTS `options` (
  `key` varchar(64) NOT NULL,
  `value` text,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `options`
--

INSERT INTO `options` (`key`, `value`) VALUES
('tax_equalization', '0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text,
  `unit_price` decimal(21,2) NOT NULL COMMENT 'Unit price',
  `item_type` varchar(20) NOT NULL DEFAULT 'product',
  PRIMARY KEY (`id`),
  KEY `IDX_ITEM_TYPE` (`item_type`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `products_taxes`
--

CREATE TABLE IF NOT EXISTS `products_taxes` (
  `product_id` bigint(20) unsigned NOT NULL,
  `tax_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`product_id`,`tax_id`),
  KEY `tax_id` (`tax_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sessions`
--

CREATE TABLE IF NOT EXISTS `sessions` (
  `id` char(32) NOT NULL DEFAULT '',
  `name` char(32) NOT NULL DEFAULT '',
  `modified` int(11) DEFAULT NULL,
  `lifetime` int(11) DEFAULT NULL,
  `data` text,
  PRIMARY KEY (`id`,`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `taxes`
--

CREATE TABLE IF NOT EXISTS `taxes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `description` varchar(50) NOT NULL,
  `percentage` decimal(4,1) NOT NULL,
  `equalization` decimal(4,1) DEFAULT NULL COMMENT 'Recargo de equivalencia',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `UX_DESCRIPTION` (`description`),
  KEY `IX_ACTIVE` (`active`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `displayname` varchar(50) DEFAULT NULL,
  `password` varchar(128) NOT NULL,
  `state` smallint(5) unsigned DEFAULT NULL,
  `client_id` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  KEY `IDX_CLIENT_ID` (`client_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `displayname`, `password`, `state`, `client_id`) VALUES
(1, 'admin', 'root@zfinvoices.com', NULL, '$2y$14$Zfa3QIj/igUKS2RJDAeZqOVblraRFelfZuFRhMm0JyvSqhK4cjvma', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_role`
--

CREATE TABLE IF NOT EXISTS `user_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `roleId` varchar(255) NOT NULL,
  `is_default` tinyint(1) NOT NULL,
  `parent_id` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Volcado de datos para la tabla `user_role`
--

INSERT INTO `user_role` (`id`, `roleId`, `is_default`, `parent_id`) VALUES
(1, 'guest', 1, NULL),
(2, 'user', 0, NULL),
(3, 'customer', 0, '2'),
(4, 'accountant', 0, '2'),
(5, 'staff', 0, '2'),
(6, 'biller', 0, '5'),
(7, 'manager', 0, '6'),
(8, 'administrator', 0, '7');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_role_linker`
--

CREATE TABLE IF NOT EXISTS `user_role_linker` (
  `user_id` int(11) unsigned NOT NULL,
  `role_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`role_id`),
  KEY `role_id` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `user_role_linker`
--

INSERT INTO `user_role_linker` (`user_id`, `role_id`) VALUES
(1, 8);

--
-- Restricciones para tablas volcadas
--


--
-- Filtros para la tabla `clients`
--
ALTER TABLE `clients`
  ADD CONSTRAINT `fk_country` FOREIGN KEY (`country_iso`) REFERENCES `countries` (`iso`);

--
-- Filtros para la tabla `client_contact_linker`
--
ALTER TABLE `client_contact_linker`
  ADD CONSTRAINT `client_contact_linker_ibfk_2` FOREIGN KEY (`contact_id`) REFERENCES `contacts` (`id`),
  ADD CONSTRAINT `client_contact_linker_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`);


--
-- Filtros para la tabla `products_taxes`
--
ALTER TABLE `products_taxes`
  ADD CONSTRAINT `products_taxes_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `products_taxes_ibfk_2` FOREIGN KEY (`tax_id`) REFERENCES `taxes` (`id`);

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
