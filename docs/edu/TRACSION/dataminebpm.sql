-- phpMyAdmin SQL Dump
-- version 4.9.10
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 19, 2024 at 10:48 AM
-- Server version: 5.7.21
-- PHP Version: 7.0.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dataminebpm`
--

-- --------------------------------------------------------

--
-- Table structure for table `pos_access`
--

DROP TABLE IF EXISTS `pos_access`;
CREATE TABLE IF NOT EXISTS `pos_access` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `roleId` bigint(20) UNSIGNED DEFAULT NULL,
  `access` text,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pos_access_roleid_index` (`roleId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pos_admin`
--

DROP TABLE IF EXISTS `pos_admin`;
CREATE TABLE IF NOT EXISTS `pos_admin` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `roleId` bigint(20) UNSIGNED NOT NULL,
  `storeId` int(10) UNSIGNED NOT NULL,
  `storeAccessIds` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile` varchar(255) DEFAULT 'employee.png',
  `phoneNumber` varchar(50) DEFAULT NULL,
  `token` text,
  `deviceToken` text,
  `deviceType` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1:WEB 2:ANDROID 3:IOS',
  `remember_token` varchar(100) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pos_admin_username_unique` (`username`),
  UNIQUE KEY `pos_admin_email_unique` (`email`),
  KEY `pos_admin_roleid_foreign` (`roleId`),
  KEY `pos_admin_storeid_foreign` (`storeId`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pos_admin`
--

INSERT INTO `pos_admin` (`id`, `roleId`, `storeId`, `storeAccessIds`, `name`, `username`, `email`, `password`, `profile`, `phoneNumber`, `token`, `deviceToken`, `deviceType`, `remember_token`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 3, '1', 'Jems Peter', 'admin', 'sa@admin.com', '$2y$10$i9lp/uwXY5LDmoodcG0hw.ZPuFlaF6qF459QedP7X0g.9zVuBr47K', 'employee.png', '1234567890', NULL, NULL, 1, NULL, 1, '2023-08-04 11:04:50', '2023-08-31 02:58:51', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pos_categories`
--

DROP TABLE IF EXISTS `pos_categories`;
CREATE TABLE IF NOT EXISTS `pos_categories` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `storeId` int(10) UNSIGNED DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `web` tinyint(4) NOT NULL DEFAULT '1',
  `pos` tinyint(4) NOT NULL DEFAULT '0',
  `color` varchar(255) NOT NULL DEFAULT '#fff',
  `image` varchar(100) NOT NULL DEFAULT 'category.png',
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `createdBy` int(11) DEFAULT NULL,
  `updateBy` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pos_categories_storeid_foreign` (`storeId`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pos_categories`
--

INSERT INTO `pos_categories` (`id`, `storeId`, `name`, `web`, `pos`, `color`, `image`, `status`, `createdBy`, `updateBy`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 3, 'Meal Deals', 1, 0, '#fff', 'MealDeal.png', 1, 1, 1, '2023-09-11 05:13:01', '2023-09-11 05:13:01', NULL),
(2, 3, 'Pizzas', 1, 0, '#fff', 'Pizza.png', 1, 1, 1, '2023-09-11 05:13:01', '2023-09-11 05:13:01', NULL),
(3, 3, 'Kebabs', 1, 0, '#fff', 'Kebabs.png', 1, 1, 1, '2023-09-11 05:13:01', '2023-09-11 05:13:01', NULL),
(4, 3, 'Combination Kebabs', 1, 0, '#fff', 'CombinationKebabs.png', 1, 1, 1, '2023-09-11 05:13:01', '2023-09-11 05:13:01', NULL),
(5, 3, 'Kebabs and Rice', 1, 0, '#fff', 'KebabRice.png', 1, 1, 1, '2023-09-11 05:13:01', '2023-09-11 05:13:01', NULL),
(6, 3, 'Wraps', 1, 0, '#fff', 'Wraps.png', 1, 1, 1, '2023-09-11 05:13:01', '2023-09-11 05:13:01', NULL),
(7, 3, 'Veggi Lover', 1, 0, '#fff', 'VeggieLover.png', 1, 1, 1, '2023-09-11 05:13:01', '2023-09-11 05:13:01', NULL),
(8, 3, 'Salad', 1, 0, '#fff', 'Salad.png', 1, 1, 1, '2023-09-11 05:13:01', '2023-09-11 05:13:01', NULL),
(9, 3, 'Side Order', 1, 0, '#fff', 'SideOrder.png', 1, 1, 1, '2023-09-11 05:13:01', '2023-09-11 05:13:01', NULL),
(10, 3, 'Burgers', 1, 0, '#fff', 'Burgers.png', 1, 1, 1, '2023-09-11 05:13:01', '2023-09-11 05:13:01', NULL),
(11, 3, 'Desserts and Ice Cream', 1, 0, '#fff', 'DessertsIceCream.png', 1, 1, 1, '2023-09-11 05:13:01', '2023-09-11 05:13:01', NULL),
(12, 3, 'Drinks', 1, 0, '#fff', 'Drinks.png', 1, 1, 1, '2023-09-11 05:13:01', '2023-09-11 05:13:01', NULL),
(13, 3, 'Pizza Deals', 1, 0, '#fff', 'PizzaDeals.png', 1, 1, 1, '2023-09-11 05:13:01', '2023-09-11 05:13:01', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pos_city`
--

DROP TABLE IF EXISTS `pos_city`;
CREATE TABLE IF NOT EXISTS `pos_city` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `stateId` int(10) UNSIGNED DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pos_city_stateid_foreign` (`stateId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pos_country`
--

DROP TABLE IF EXISTS `pos_country`;
CREATE TABLE IF NOT EXISTS `pos_country` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `flag` varchar(255) DEFAULT NULL,
  `iso` varchar(255) DEFAULT NULL,
  `nicename` varchar(255) DEFAULT NULL,
  `iso3` varchar(255) DEFAULT NULL,
  `numcode` varchar(255) DEFAULT NULL,
  `phonecode` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=240 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pos_country`
--

INSERT INTO `pos_country` (`id`, `name`, `flag`, `iso`, `nicename`, `iso3`, `numcode`, `phonecode`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'AFGHANISTAN', NULL, 'AF', 'Afghanistan', 'AFG', '4', '93', 1, NULL, NULL, NULL),
(2, 'ALBANIA', NULL, 'AL', 'Albania', 'ALB', '8', '355', 1, NULL, NULL, NULL),
(3, 'ALGERIA', NULL, 'DZ', 'Algeria', 'DZA', '12', '213', 1, NULL, NULL, NULL),
(4, 'AMERICAN SAMOA', NULL, 'AS', 'American Samoa', 'ASM', '16', '1684', 1, NULL, NULL, NULL),
(5, 'ANDORRA', NULL, 'AD', 'Andorra', 'AND', '20', '376', 1, NULL, NULL, NULL),
(6, 'ANGOLA', NULL, 'AO', 'Angola', 'AGO', '24', '244', 1, NULL, NULL, NULL),
(7, 'ANGUILLA', NULL, 'AI', 'Anguilla', 'AIA', '660', '1264', 1, NULL, NULL, NULL),
(8, 'ANTARCTICA', NULL, 'AQ', 'Antarctica', NULL, NULL, '0', 1, NULL, NULL, NULL),
(9, 'ANTIGUA AND BARBUDA', NULL, 'AG', 'Antigua and Barbuda', 'ATG', '28', '1268', 1, NULL, NULL, NULL),
(10, 'ARGENTINA', NULL, 'AR', 'Argentina', 'ARG', '32', '54', 1, NULL, NULL, NULL),
(11, 'ARMENIA', NULL, 'AM', 'Armenia', 'ARM', '51', '374', 1, NULL, NULL, NULL),
(12, 'ARUBA', NULL, 'AW', 'Aruba', 'ABW', '533', '297', 1, NULL, NULL, NULL),
(13, 'AUSTRALIA', NULL, 'AU', 'Australia', 'AUS', '36', '61', 1, NULL, NULL, NULL),
(14, 'AUSTRIA', NULL, 'AT', 'Austria', 'AUT', '40', '43', 1, NULL, NULL, NULL),
(15, 'AZERBAIJAN', NULL, 'AZ', 'Azerbaijan', 'AZE', '31', '994', 1, NULL, NULL, NULL),
(16, 'BAHAMAS', NULL, 'BS', 'Bahamas', 'BHS', '44', '1242', 1, NULL, NULL, NULL),
(17, 'BAHRAIN', NULL, 'BH', 'Bahrain', 'BHR', '48', '973', 1, NULL, NULL, NULL),
(18, 'BANGLADESH', NULL, 'BD', 'Bangladesh', 'BGD', '50', '880', 1, NULL, NULL, NULL),
(19, 'BARBADOS', NULL, 'BB', 'Barbados', 'BRB', '52', '1246', 1, NULL, NULL, NULL),
(20, 'BELARUS', NULL, 'BY', 'Belarus', 'BLR', '112', '375', 1, NULL, NULL, NULL),
(21, 'BELGIUM', NULL, 'BE', 'Belgium', 'BEL', '56', '32', 1, NULL, NULL, NULL),
(22, 'BELIZE', NULL, 'BZ', 'Belize', 'BLZ', '84', '501', 1, NULL, NULL, NULL),
(23, 'BENIN', NULL, 'BJ', 'Benin', 'BEN', '204', '229', 1, NULL, NULL, NULL),
(24, 'BERMUDA', NULL, 'BM', 'Bermuda', 'BMU', '60', '1441', 1, NULL, NULL, NULL),
(25, 'BHUTAN', NULL, 'BT', 'Bhutan', 'BTN', '64', '975', 1, NULL, NULL, NULL),
(26, 'BOLIVIA', NULL, 'BO', 'Bolivia', 'BOL', '68', '591', 1, NULL, NULL, NULL),
(27, 'BOSNIA AND HERZEGOVINA', NULL, 'BA', 'Bosnia and Herzegovina', 'BIH', '70', '387', 1, NULL, NULL, NULL),
(28, 'BOTSWANA', NULL, 'BW', 'Botswana', 'BWA', '72', '267', 1, NULL, NULL, NULL),
(29, 'BOUVET ISLAND', NULL, 'BV', 'Bouvet Island', NULL, NULL, '0', 1, NULL, NULL, NULL),
(30, 'BRAZIL', NULL, 'BR', 'Brazil', 'BRA', '76', '55', 1, NULL, NULL, NULL),
(31, 'BRITISH INDIAN OCEAN TERRITORY', NULL, 'IO', 'British Indian Ocean Territory', NULL, NULL, '246', 1, NULL, NULL, NULL),
(32, 'BRUNEI DARUSSALAM', NULL, 'BN', 'Brunei Darussalam', 'BRN', '96', '673', 1, NULL, NULL, NULL),
(33, 'BULGARIA', NULL, 'BG', 'Bulgaria', 'BGR', '100', '359', 1, NULL, NULL, NULL),
(34, 'BURKINA FASO', NULL, 'BF', 'Burkina Faso', 'BFA', '854', '226', 1, NULL, NULL, NULL),
(35, 'BURUNDI', NULL, 'BI', 'Burundi', 'BDI', '108', '257', 1, NULL, NULL, NULL),
(36, 'CAMBODIA', NULL, 'KH', 'Cambodia', 'KHM', '116', '855', 1, NULL, NULL, NULL),
(37, 'CAMEROON', NULL, 'CM', 'Cameroon', 'CMR', '120', '237', 1, NULL, NULL, NULL),
(38, 'CANADA', NULL, 'CA', 'Canada', 'CAN', '124', '1', 1, NULL, NULL, NULL),
(39, 'CAPE VERDE', NULL, 'CV', 'Cape Verde', 'CPV', '132', '238', 1, NULL, NULL, NULL),
(40, 'CAYMAN ISLANDS', NULL, 'KY', 'Cayman Islands', 'CYM', '136', '1345', 1, NULL, NULL, NULL),
(41, 'CENTRAL AFRICAN REPUBLIC', NULL, 'CF', 'Central African Republic', 'CAF', '140', '236', 1, NULL, NULL, NULL),
(42, 'CHAD', NULL, 'TD', 'Chad', 'TCD', '148', '235', 1, NULL, NULL, NULL),
(43, 'CHILE', NULL, 'CL', 'Chile', 'CHL', '152', '56', 1, NULL, NULL, NULL),
(44, 'CHINA', NULL, 'CN', 'China', 'CHN', '156', '86', 1, NULL, NULL, NULL),
(45, 'CHRISTMAS ISLAND', NULL, 'CX', 'Christmas Island', NULL, NULL, '61', 1, NULL, NULL, NULL),
(46, 'COCOS (KEELING) ISLANDS', NULL, 'CC', 'Cocos (Keeling) Islands', NULL, NULL, '672', 1, NULL, NULL, NULL),
(47, 'COLOMBIA', NULL, 'CO', 'Colombia', 'COL', '170', '57', 1, NULL, NULL, NULL),
(48, 'COMOROS', NULL, 'KM', 'Comoros', 'COM', '174', '269', 1, NULL, NULL, NULL),
(49, 'CONGO', NULL, 'CG', 'Congo', 'COG', '178', '242', 1, NULL, NULL, NULL),
(50, 'CONGO, THE DEMOCRATIC REPUBLIC OF THE', NULL, 'CD', 'Congo, the Democratic Republic of the', 'COD', '180', '242', 1, NULL, NULL, NULL),
(51, 'COOK ISLANDS', NULL, 'CK', 'Cook Islands', 'COK', '184', '682', 1, NULL, NULL, NULL),
(52, 'COSTA RICA', NULL, 'CR', 'Costa Rica', 'CRI', '188', '506', 1, NULL, NULL, NULL),
(53, 'COTE D\'IVOIRE', NULL, 'CI', 'Cote D\'Ivoire', 'CIV', '384', '225', 1, NULL, NULL, NULL),
(54, 'CROATIA', NULL, 'HR', 'Croatia', 'HRV', '191', '385', 1, NULL, NULL, NULL),
(55, 'CUBA', NULL, 'CU', 'Cuba', 'CUB', '192', '53', 1, NULL, NULL, NULL),
(56, 'CYPRUS', NULL, 'CY', 'Cyprus', 'CYP', '196', '357', 1, NULL, NULL, NULL),
(57, 'CZECH REPUBLIC', NULL, 'CZ', 'Czech Republic', 'CZE', '203', '420', 1, NULL, NULL, NULL),
(58, 'DENMARK', NULL, 'DK', 'Denmark', 'DNK', '208', '45', 1, NULL, NULL, NULL),
(59, 'DJIBOUTI', NULL, 'DJ', 'Djibouti', 'DJI', '262', '253', 1, NULL, NULL, NULL),
(60, 'DOMINICA', NULL, 'DM', 'Dominica', 'DMA', '212', '1767', 1, NULL, NULL, NULL),
(61, 'DOMINICAN REPUBLIC', NULL, 'DO', 'Dominican Republic', 'DOM', '214', '1809', 1, NULL, NULL, NULL),
(62, 'ECUADOR', NULL, 'EC', 'Ecuador', 'ECU', '218', '593', 1, NULL, NULL, NULL),
(63, 'EGYPT', NULL, 'EG', 'Egypt', 'EGY', '818', '20', 1, NULL, NULL, NULL),
(64, 'EL SALVADOR', NULL, 'SV', 'El Salvador', 'SLV', '222', '503', 1, NULL, NULL, NULL),
(65, 'EQUATORIAL GUINEA', NULL, 'GQ', 'Equatorial Guinea', 'GNQ', '226', '240', 1, NULL, NULL, NULL),
(66, 'ERITREA', NULL, 'ER', 'Eritrea', 'ERI', '232', '291', 1, NULL, NULL, NULL),
(67, 'ESTONIA', NULL, 'EE', 'Estonia', 'EST', '233', '372', 1, NULL, NULL, NULL),
(68, 'ETHIOPIA', NULL, 'ET', 'Ethiopia', 'ETH', '231', '251', 1, NULL, NULL, NULL),
(69, 'FALKLAND ISLANDS (MALVINAS)', NULL, 'FK', 'Falkland Islands (Malvinas)', 'FLK', '238', '500', 1, NULL, NULL, NULL),
(70, 'FAROE ISLANDS', NULL, 'FO', 'Faroe Islands', 'FRO', '234', '298', 1, NULL, NULL, NULL),
(71, 'FIJI', NULL, 'FJ', 'Fiji', 'FJI', '242', '679', 1, NULL, NULL, NULL),
(72, 'FINLAND', NULL, 'FI', 'Finland', 'FIN', '246', '358', 1, NULL, NULL, NULL),
(73, 'FRANCE', NULL, 'FR', 'France', 'FRA', '250', '33', 1, NULL, NULL, NULL),
(74, 'FRENCH GUIANA', NULL, 'GF', 'French Guiana', 'GUF', '254', '594', 1, NULL, NULL, NULL),
(75, 'FRENCH POLYNESIA', NULL, 'PF', 'French Polynesia', 'PYF', '258', '689', 1, NULL, NULL, NULL),
(76, 'FRENCH SOUTHERN TERRITORIES', NULL, 'TF', 'French Southern Territories', NULL, NULL, '0', 1, NULL, NULL, NULL),
(77, 'GABON', NULL, 'GA', 'Gabon', 'GAB', '266', '241', 1, NULL, NULL, NULL),
(78, 'GAMBIA', NULL, 'GM', 'Gambia', 'GMB', '270', '220', 1, NULL, NULL, NULL),
(79, 'GEORGIA', NULL, 'GE', 'Georgia', 'GEO', '268', '995', 1, NULL, NULL, NULL),
(80, 'GERMANY', NULL, 'DE', 'Germany', 'DEU', '276', '49', 1, NULL, NULL, NULL),
(81, 'GHANA', NULL, 'GH', 'Ghana', 'GHA', '288', '233', 1, NULL, NULL, NULL),
(82, 'GIBRALTAR', NULL, 'GI', 'Gibraltar', 'GIB', '292', '350', 1, NULL, NULL, NULL),
(83, 'GREECE', NULL, 'GR', 'Greece', 'GRC', '300', '30', 1, NULL, NULL, NULL),
(84, 'GREENLAND', NULL, 'GL', 'Greenland', 'GRL', '304', '299', 1, NULL, NULL, NULL),
(85, 'GRENADA', NULL, 'GD', 'Grenada', 'GRD', '308', '1473', 1, NULL, NULL, NULL),
(86, 'GUADELOUPE', NULL, 'GP', 'Guadeloupe', 'GLP', '312', '590', 1, NULL, NULL, NULL),
(87, 'GUAM', NULL, 'GU', 'Guam', 'GUM', '316', '1671', 1, NULL, NULL, NULL),
(88, 'GUATEMALA', NULL, 'GT', 'Guatemala', 'GTM', '320', '502', 1, NULL, NULL, NULL),
(89, 'GUINEA', NULL, 'GN', 'Guinea', 'GIN', '324', '224', 1, NULL, NULL, NULL),
(90, 'GUINEA-BISSAU', NULL, 'GW', 'Guinea-Bissau', 'GNB', '624', '245', 1, NULL, NULL, NULL),
(91, 'GUYANA', NULL, 'GY', 'Guyana', 'GUY', '328', '592', 1, NULL, NULL, NULL),
(92, 'HAITI', NULL, 'HT', 'Haiti', 'HTI', '332', '509', 1, NULL, NULL, NULL),
(93, 'HEARD ISLAND AND MCDONALD ISLANDS', NULL, 'HM', 'Heard Island and Mcdonald Islands', NULL, NULL, '0', 1, NULL, NULL, NULL),
(94, 'HOLY SEE (VATICAN CITY STATE)', NULL, 'VA', 'Holy See (Vatican City State)', 'VAT', '336', '39', 1, NULL, NULL, NULL),
(95, 'HONDURAS', NULL, 'HN', 'Honduras', 'HND', '340', '504', 1, NULL, NULL, NULL),
(96, 'HONG KONG', NULL, 'HK', 'Hong Kong', 'HKG', '344', '852', 1, NULL, NULL, NULL),
(97, 'HUNGARY', NULL, 'HU', 'Hungary', 'HUN', '348', '36', 1, NULL, NULL, NULL),
(98, 'ICELAND', NULL, 'IS', 'Iceland', 'ISL', '352', '354', 1, NULL, NULL, NULL),
(99, 'INDIA', NULL, 'IN', 'India', 'IND', '356', '91', 1, NULL, NULL, NULL),
(100, 'INDONESIA', NULL, 'ID', 'Indonesia', 'IDN', '360', '62', 1, NULL, NULL, NULL),
(101, 'IRAN, ISLAMIC REPUBLIC OF', NULL, 'IR', 'Iran, Islamic Republic of', 'IRN', '364', '98', 1, NULL, NULL, NULL),
(102, 'IRAQ', NULL, 'IQ', 'Iraq', 'IRQ', '368', '964', 1, NULL, NULL, NULL),
(103, 'IRELAND', NULL, 'IE', 'Ireland', 'IRL', '372', '353', 1, NULL, NULL, NULL),
(104, 'ISRAEL', NULL, 'IL', 'Israel', 'ISR', '376', '972', 1, NULL, NULL, NULL),
(105, 'ITALY', NULL, 'IT', 'Italy', 'ITA', '380', '39', 1, NULL, NULL, NULL),
(106, 'JAMAICA', NULL, 'JM', 'Jamaica', 'JAM', '388', '1876', 1, NULL, NULL, NULL),
(107, 'JAPAN', NULL, 'JP', 'Japan', 'JPN', '392', '81', 1, NULL, NULL, NULL),
(108, 'JORDAN', NULL, 'JO', 'Jordan', 'JOR', '400', '962', 1, NULL, NULL, NULL),
(109, 'KAZAKHSTAN', NULL, 'KZ', 'Kazakhstan', 'KAZ', '398', '7', 1, NULL, NULL, NULL),
(110, 'KENYA', NULL, 'KE', 'Kenya', 'KEN', '404', '254', 1, NULL, NULL, NULL),
(111, 'KIRIBATI', NULL, 'KI', 'Kiribati', 'KIR', '296', '686', 1, NULL, NULL, NULL),
(112, 'KOREA, DEMOCRATIC PEOPLE\'S REPUBLIC OF', NULL, 'KP', 'Korea, Democratic People\'s Republic of', 'PRK', '408', '850', 1, NULL, NULL, NULL),
(113, 'KOREA, REPUBLIC OF', NULL, 'KR', 'Korea, Republic of', 'KOR', '410', '82', 1, NULL, NULL, NULL),
(114, 'KUWAIT', NULL, 'KW', 'Kuwait', 'KWT', '414', '965', 1, NULL, NULL, NULL),
(115, 'KYRGYZSTAN', NULL, 'KG', 'Kyrgyzstan', 'KGZ', '417', '996', 1, NULL, NULL, NULL),
(116, 'LAO PEOPLE\'S DEMOCRATIC REPUBLIC', NULL, 'LA', 'Lao People\'s Democratic Republic', 'LAO', '418', '856', 1, NULL, NULL, NULL),
(117, 'LATVIA', NULL, 'LV', 'Latvia', 'LVA', '428', '371', 1, NULL, NULL, NULL),
(118, 'LEBANON', NULL, 'LB', 'Lebanon', 'LBN', '422', '961', 1, NULL, NULL, NULL),
(119, 'LESOTHO', NULL, 'LS', 'Lesotho', 'LSO', '426', '266', 1, NULL, NULL, NULL),
(120, 'LIBERIA', NULL, 'LR', 'Liberia', 'LBR', '430', '231', 1, NULL, NULL, NULL),
(121, 'LIBYAN ARAB JAMAHIRIYA', NULL, 'LY', 'Libyan Arab Jamahiriya', 'LBY', '434', '218', 1, NULL, NULL, NULL),
(122, 'LIECHTENSTEIN', NULL, 'LI', 'Liechtenstein', 'LIE', '438', '423', 1, NULL, NULL, NULL),
(123, 'LITHUANIA', NULL, 'LT', 'Lithuania', 'LTU', '440', '370', 1, NULL, NULL, NULL),
(124, 'LUXEMBOURG', NULL, 'LU', 'Luxembourg', 'LUX', '442', '352', 1, NULL, NULL, NULL),
(125, 'MACAO', NULL, 'MO', 'Macao', 'MAC', '446', '853', 1, NULL, NULL, NULL),
(126, 'MACEDONIA, THE FORMER YUGOSLAV REPUBLIC OF', NULL, 'MK', 'Macedonia, the Former Yugoslav Republic of', 'MKD', '807', '389', 1, NULL, NULL, NULL),
(127, 'MADAGASCAR', NULL, 'MG', 'Madagascar', 'MDG', '450', '261', 1, NULL, NULL, NULL),
(128, 'MALAWI', NULL, 'MW', 'Malawi', 'MWI', '454', '265', 1, NULL, NULL, NULL),
(129, 'MALAYSIA', NULL, 'MY', 'Malaysia', 'MYS', '458', '60', 1, NULL, NULL, NULL),
(130, 'MALDIVES', NULL, 'MV', 'Maldives', 'MDV', '462', '960', 1, NULL, NULL, NULL),
(131, 'MALI', NULL, 'ML', 'Mali', 'MLI', '466', '223', 1, NULL, NULL, NULL),
(132, 'MALTA', NULL, 'MT', 'Malta', 'MLT', '470', '356', 1, NULL, NULL, NULL),
(133, 'MARSHALL ISLANDS', NULL, 'MH', 'Marshall Islands', 'MHL', '584', '692', 1, NULL, NULL, NULL),
(134, 'MARTINIQUE', NULL, 'MQ', 'Martinique', 'MTQ', '474', '596', 1, NULL, NULL, NULL),
(135, 'MAURITANIA', NULL, 'MR', 'Mauritania', 'MRT', '478', '222', 1, NULL, NULL, NULL),
(136, 'MAURITIUS', NULL, 'MU', 'Mauritius', 'MUS', '480', '230', 1, NULL, NULL, NULL),
(137, 'MAYOTTE', NULL, 'YT', 'Mayotte', NULL, NULL, '269', 1, NULL, NULL, NULL),
(138, 'MEXICO', NULL, 'MX', 'Mexico', 'MEX', '484', '52', 1, NULL, NULL, NULL),
(139, 'MICRONESIA, FEDERATED STATES OF', NULL, 'FM', 'Micronesia, Federated States of', 'FSM', '583', '691', 1, NULL, NULL, NULL),
(140, 'MOLDOVA, REPUBLIC OF', NULL, 'MD', 'Moldova, Republic of', 'MDA', '498', '373', 1, NULL, NULL, NULL),
(141, 'MONACO', NULL, 'MC', 'Monaco', 'MCO', '492', '377', 1, NULL, NULL, NULL),
(142, 'MONGOLIA', NULL, 'MN', 'Mongolia', 'MNG', '496', '976', 1, NULL, NULL, NULL),
(143, 'MONTSERRAT', NULL, 'MS', 'Montserrat', 'MSR', '500', '1664', 1, NULL, NULL, NULL),
(144, 'MOROCCO', NULL, 'MA', 'Morocco', 'MAR', '504', '212', 1, NULL, NULL, NULL),
(145, 'MOZAMBIQUE', NULL, 'MZ', 'Mozambique', 'MOZ', '508', '258', 1, NULL, NULL, NULL),
(146, 'MYANMAR', NULL, 'MM', 'Myanmar', 'MMR', '104', '95', 1, NULL, NULL, NULL),
(147, 'NAMIBIA', NULL, 'NA', 'Namibia', 'NAM', '516', '264', 1, NULL, NULL, NULL),
(148, 'NAURU', NULL, 'NR', 'Nauru', 'NRU', '520', '674', 1, NULL, NULL, NULL),
(149, 'NEPAL', NULL, 'NP', 'Nepal', 'NPL', '524', '977', 1, NULL, NULL, NULL),
(150, 'NETHERLANDS', NULL, 'NL', 'Netherlands', 'NLD', '528', '31', 1, NULL, NULL, NULL),
(151, 'NETHERLANDS ANTILLES', NULL, 'AN', 'Netherlands Antilles', 'ANT', '530', '599', 1, NULL, NULL, NULL),
(152, 'NEW CALEDONIA', NULL, 'NC', 'New Caledonia', 'NCL', '540', '687', 1, NULL, NULL, NULL),
(153, 'NEW ZEALAND', NULL, 'NZ', 'New Zealand', 'NZL', '554', '64', 1, NULL, NULL, NULL),
(154, 'NICARAGUA', NULL, 'NI', 'Nicaragua', 'NIC', '558', '505', 1, NULL, NULL, NULL),
(155, 'NIGER', NULL, 'NE', 'Niger', 'NER', '562', '227', 1, NULL, NULL, NULL),
(156, 'NIGERIA', NULL, 'NG', 'Nigeria', 'NGA', '566', '234', 1, NULL, NULL, NULL),
(157, 'NIUE', NULL, 'NU', 'Niue', 'NIU', '570', '683', 1, NULL, NULL, NULL),
(158, 'NORFOLK ISLAND', NULL, 'NF', 'Norfolk Island', 'NFK', '574', '672', 1, NULL, NULL, NULL),
(159, 'NORTHERN MARIANA ISLANDS', NULL, 'MP', 'Northern Mariana Islands', 'MNP', '580', '1670', 1, NULL, NULL, NULL),
(160, 'NORWAY', NULL, 'NO', 'Norway', 'NOR', '578', '47', 1, NULL, NULL, NULL),
(161, 'OMAN', NULL, 'OM', 'Oman', 'OMN', '512', '968', 1, NULL, NULL, NULL),
(162, 'PAKISTAN', NULL, 'PK', 'Pakistan', 'PAK', '586', '92', 1, NULL, NULL, NULL),
(163, 'PALAU', NULL, 'PW', 'Palau', 'PLW', '585', '680', 1, NULL, NULL, NULL),
(164, 'PALESTINIAN TERRITORY, OCCUPIED', NULL, 'PS', 'Palestinian Territory, Occupied', NULL, NULL, '970', 1, NULL, NULL, NULL),
(165, 'PANAMA', NULL, 'PA', 'Panama', 'PAN', '591', '507', 1, NULL, NULL, NULL),
(166, 'PAPUA NEW GUINEA', NULL, 'PG', 'Papua New Guinea', 'PNG', '598', '675', 1, NULL, NULL, NULL),
(167, 'PARAGUAY', NULL, 'PY', 'Paraguay', 'PRY', '600', '595', 1, NULL, NULL, NULL),
(168, 'PERU', NULL, 'PE', 'Peru', 'PER', '604', '51', 1, NULL, NULL, NULL),
(169, 'PHILIPPINES', NULL, 'PH', 'Philippines', 'PHL', '608', '63', 1, NULL, NULL, NULL),
(170, 'PITCAIRN', NULL, 'PN', 'Pitcairn', 'PCN', '612', '0', 1, NULL, NULL, NULL),
(171, 'POLAND', NULL, 'PL', 'Poland', 'POL', '616', '48', 1, NULL, NULL, NULL),
(172, 'PORTUGAL', NULL, 'PT', 'Portugal', 'PRT', '620', '351', 1, NULL, NULL, NULL),
(173, 'PUERTO RICO', NULL, 'PR', 'Puerto Rico', 'PRI', '630', '1787', 1, NULL, NULL, NULL),
(174, 'QATAR', NULL, 'QA', 'Qatar', 'QAT', '634', '974', 1, NULL, NULL, NULL),
(175, 'REUNION', NULL, 'RE', 'Reunion', 'REU', '638', '262', 1, NULL, NULL, NULL),
(176, 'ROMANIA', NULL, 'RO', 'Romania', 'ROM', '642', '40', 1, NULL, NULL, NULL),
(177, 'RUSSIAN FEDERATION', NULL, 'RU', 'Russian Federation', 'RUS', '643', '70', 1, NULL, NULL, NULL),
(178, 'RWANDA', NULL, 'RW', 'Rwanda', 'RWA', '646', '250', 1, NULL, NULL, NULL),
(179, 'SAINT HELENA', NULL, 'SH', 'Saint Helena', 'SHN', '654', '290', 1, NULL, NULL, NULL),
(180, 'SAINT KITTS AND NEVIS', NULL, 'KN', 'Saint Kitts and Nevis', 'KNA', '659', '1869', 1, NULL, NULL, NULL),
(181, 'SAINT LUCIA', NULL, 'LC', 'Saint Lucia', 'LCA', '662', '1758', 1, NULL, NULL, NULL),
(182, 'SAINT PIERRE AND MIQUELON', NULL, 'PM', 'Saint Pierre and Miquelon', 'SPM', '666', '508', 1, NULL, NULL, NULL),
(183, 'SAINT VINCENT AND THE GRENADINES', NULL, 'VC', 'Saint Vincent and the Grenadines', 'VCT', '670', '1784', 1, NULL, NULL, NULL),
(184, 'SAMOA', NULL, 'WS', 'Samoa', 'WSM', '882', '684', 1, NULL, NULL, NULL),
(185, 'SAN MARINO', NULL, 'SM', 'San Marino', 'SMR', '674', '378', 1, NULL, NULL, NULL),
(186, 'SAO TOME AND PRINCIPE', NULL, 'ST', 'Sao Tome and Principe', 'STP', '678', '239', 1, NULL, NULL, NULL),
(187, 'SAUDI ARABIA', NULL, 'SA', 'Saudi Arabia', 'SAU', '682', '966', 1, NULL, NULL, NULL),
(188, 'SENEGAL', NULL, 'SN', 'Senegal', 'SEN', '686', '221', 1, NULL, NULL, NULL),
(189, 'SERBIA AND MONTENEGRO', NULL, 'CS', 'Serbia and Montenegro', NULL, NULL, '381', 1, NULL, NULL, NULL),
(190, 'SEYCHELLES', NULL, 'SC', 'Seychelles', 'SYC', '690', '248', 1, NULL, NULL, NULL),
(191, 'SIERRA LEONE', NULL, 'SL', 'Sierra Leone', 'SLE', '694', '232', 1, NULL, NULL, NULL),
(192, 'SINGAPORE', NULL, 'SG', 'Singapore', 'SGP', '702', '65', 1, NULL, NULL, NULL),
(193, 'SLOVAKIA', NULL, 'SK', 'Slovakia', 'SVK', '703', '421', 1, NULL, NULL, NULL),
(194, 'SLOVENIA', NULL, 'SI', 'Slovenia', 'SVN', '705', '386', 1, NULL, NULL, NULL),
(195, 'SOLOMON ISLANDS', NULL, 'SB', 'Solomon Islands', 'SLB', '90', '677', 1, NULL, NULL, NULL),
(196, 'SOMALIA', NULL, 'SO', 'Somalia', 'SOM', '706', '252', 1, NULL, NULL, NULL),
(197, 'SOUTH AFRICA', NULL, 'ZA', 'South Africa', 'ZAF', '710', '27', 1, NULL, NULL, NULL),
(198, 'SOUTH GEORGIA AND THE SOUTH SANDWICH ISLANDS', NULL, 'GS', 'South Georgia and the South Sandwich Islands', NULL, NULL, '0', 1, NULL, NULL, NULL),
(199, 'SPAIN', NULL, 'ES', 'Spain', 'ESP', '724', '34', 1, NULL, NULL, NULL),
(200, 'SRI LANKA', NULL, 'LK', 'Sri Lanka', 'LKA', '144', '94', 1, NULL, NULL, NULL),
(201, 'SUDAN', NULL, 'SD', 'Sudan', 'SDN', '736', '249', 1, NULL, NULL, NULL),
(202, 'SURINAME', NULL, 'SR', 'Suriname', 'SUR', '740', '597', 1, NULL, NULL, NULL),
(203, 'SVALBARD AND JAN MAYEN', NULL, 'SJ', 'Svalbard and Jan Mayen', 'SJM', '744', '47', 1, NULL, NULL, NULL),
(204, 'SWAZILAND', NULL, 'SZ', 'Swaziland', 'SWZ', '748', '268', 1, NULL, NULL, NULL),
(205, 'SWEDEN', NULL, 'SE', 'Sweden', 'SWE', '752', '46', 1, NULL, NULL, NULL),
(206, 'SWITZERLAND', NULL, 'CH', 'Switzerland', 'CHE', '756', '41', 1, NULL, NULL, NULL),
(207, 'SYRIAN ARAB REPUBLIC', NULL, 'SY', 'Syrian Arab Republic', 'SYR', '760', '963', 1, NULL, NULL, NULL),
(208, 'TAIWAN, PROVINCE OF CHINA', NULL, 'TW', 'Taiwan, Province of China', 'TWN', '158', '886', 1, NULL, NULL, NULL),
(209, 'TAJIKISTAN', NULL, 'TJ', 'Tajikistan', 'TJK', '762', '992', 1, NULL, NULL, NULL),
(210, 'TANZANIA, UNITED REPUBLIC OF', NULL, 'TZ', 'Tanzania, United Republic of', 'TZA', '834', '255', 1, NULL, NULL, NULL),
(211, 'THAILAND', NULL, 'TH', 'Thailand', 'THA', '764', '66', 1, NULL, NULL, NULL),
(212, 'TIMOR-LESTE', NULL, 'TL', 'Timor-Leste', NULL, NULL, '670', 1, NULL, NULL, NULL),
(213, 'TOGO', NULL, 'TG', 'Togo', 'TGO', '768', '228', 1, NULL, NULL, NULL),
(214, 'TOKELAU', NULL, 'TK', 'Tokelau', 'TKL', '772', '690', 1, NULL, NULL, NULL),
(215, 'TONGA', NULL, 'TO', 'Tonga', 'TON', '776', '676', 1, NULL, NULL, NULL),
(216, 'TRINIDAD AND TOBAGO', NULL, 'TT', 'Trinidad and Tobago', 'TTO', '780', '1868', 1, NULL, NULL, NULL),
(217, 'TUNISIA', NULL, 'TN', 'Tunisia', 'TUN', '788', '216', 1, NULL, NULL, NULL),
(218, 'TURKEY', NULL, 'TR', 'Turkey', 'TUR', '792', '90', 1, NULL, NULL, NULL),
(219, 'TURKMENISTAN', NULL, 'TM', 'Turkmenistan', 'TKM', '795', '7370', 1, NULL, NULL, NULL),
(220, 'TURKS AND CAICOS ISLANDS', NULL, 'TC', 'Turks and Caicos Islands', 'TCA', '796', '1649', 1, NULL, NULL, NULL),
(221, 'TUVALU', NULL, 'TV', 'Tuvalu', 'TUV', '798', '688', 1, NULL, NULL, NULL),
(222, 'UGANDA', NULL, 'UG', 'Uganda', 'UGA', '800', '256', 1, NULL, NULL, NULL),
(223, 'UKRAINE', NULL, 'UA', 'Ukraine', 'UKR', '804', '380', 1, NULL, NULL, NULL),
(224, 'UNITED ARAB EMIRATES', NULL, 'AE', 'United Arab Emirates', 'ARE', '784', '971', 1, NULL, NULL, NULL),
(225, 'UNITED KINGDOM', NULL, 'GB', 'United Kingdom', 'GBR', '826', '44', 1, NULL, NULL, NULL),
(226, 'UNITED STATES', NULL, 'US', 'United States', 'USA', '840', '1', 1, NULL, NULL, NULL),
(227, 'UNITED STATES MINOR OUTLYING ISLANDS', NULL, 'UM', 'United States Minor Outlying Islands', NULL, NULL, '1', 1, NULL, NULL, NULL),
(228, 'URUGUAY', NULL, 'UY', 'Uruguay', 'URY', '858', '598', 1, NULL, NULL, NULL),
(229, 'UZBEKISTAN', NULL, 'UZ', 'Uzbekistan', 'UZB', '860', '998', 1, NULL, NULL, NULL),
(230, 'VANUATU', NULL, 'VU', 'Vanuatu', 'VUT', '548', '678', 1, NULL, NULL, NULL),
(231, 'VENEZUELA', NULL, 'VE', 'Venezuela', 'VEN', '862', '58', 1, NULL, NULL, NULL),
(232, 'VIET NAM', NULL, 'VN', 'Viet Nam', 'VNM', '704', '84', 1, NULL, NULL, NULL),
(233, 'VIRGIN ISLANDS, BRITISH', NULL, 'VG', 'Virgin Islands, British', 'VGB', '92', '1284', 1, NULL, NULL, NULL),
(234, 'VIRGIN ISLANDS, U.S.', NULL, 'VI', 'Virgin Islands, U.s.', 'VIR', '850', '1340', 1, NULL, NULL, NULL),
(235, 'WALLIS AND FUTUNA', NULL, 'WF', 'Wallis and Futuna', 'WLF', '876', '681', 1, NULL, NULL, NULL),
(236, 'WESTERN SAHARA', NULL, 'EH', 'Western Sahara', 'ESH', '732', '212', 1, NULL, NULL, NULL),
(237, 'YEMEN', NULL, 'YE', 'Yemen', 'YEM', '887', '967', 1, NULL, NULL, NULL),
(238, 'ZAMBIA', NULL, 'ZM', 'Zambia', 'ZMB', '894', '260', 1, NULL, NULL, NULL),
(239, 'ZIMBABWE', NULL, 'ZW', 'Zimbabwe', 'ZWE', '716', '263', 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pos_customers`
--

DROP TABLE IF EXISTS `pos_customers`;
CREATE TABLE IF NOT EXISTS `pos_customers` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `fName` varchar(255) DEFAULT NULL,
  `lName` varchar(255) DEFAULT NULL,
  `phoneNumber` varchar(255) DEFAULT NULL,
  `countryCode` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `profile` varchar(255) DEFAULT 'customers.png',
  `dob` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `acceptTerms` tinyint(4) NOT NULL DEFAULT '0',
  `deviceType` enum('ANDROID','IOS','WINDOWS','WEB') DEFAULT 'WEB',
  `deviceToken` text,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pos_customers`
--

INSERT INTO `pos_customers` (`id`, `fName`, `lName`, `phoneNumber`, `countryCode`, `username`, `email`, `password`, `profile`, `dob`, `gender`, `acceptTerms`, `deviceType`, `deviceToken`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'July', 'Windosor', '1234569991', '44', 'julymarker', 's3@s.com', '$2y$10$mlBN/NM5ICVItCqHTrwSuOtxWAxd05Ux9ULAY2FRUJXuC2C9OnD.W', 'customers.png', '10/10/2000', 'Male', 0, NULL, NULL, 1, '2023-08-04 13:34:50', '2023-08-08 16:38:29', NULL),
(2, 'July', 'Windosor', '1234569944', '+44', 'julywindsonr', 's2@s.com', '$2y$10$vey3WDCf0R1ihJpVV0Z0jOqu1yiN7jAQkKy6pW/FVvnBImH3I23uS', 'Cf9kN2ZNuR.jpg', '10/10/2000', 'Male', 0, NULL, NULL, 1, '2023-08-04 13:34:50', '2023-09-29 02:28:07', NULL),
(24, 'Ema', 'Watson', '9714170940', '+91', NULL, 'ronak@yopmail.com', '$2y$10$SlccSkWwz01u/1m5eQl2a.WyDAsPRHPmcmTjrr2KBLdMsVdFp7Ohq', 'P06gfDPmi7.jpg', NULL, NULL, 1, NULL, NULL, 1, '2023-08-08 15:43:23', '2023-10-12 07:19:27', NULL),
(25, 'Ronak', 'kapadi', '9714170955', '+91', NULL, 'rk@gmail.com', '$2y$10$gBKMGp45PQ8XfefVG.uFhuY4C1BTBmACBFU17rbdKz3FEQsDoXfTK', 'iUHVFYU22M.jpg', NULL, NULL, 1, NULL, NULL, 1, '2023-08-14 06:17:06', '2023-08-19 04:28:14', NULL),
(27, 'ROnak', 'Kapadi', '1234567890', '+44', NULL, 'xpert@yopmail.com', '$2y$10$TXr7z6ExtckPrivLvH5buuVzYnIdjoERBT4w598K8hLF5SN2jAx8e', 'customers.png', NULL, NULL, 1, 'WEB', NULL, 1, '2023-08-28 12:02:02', '2023-08-28 12:35:06', NULL),
(28, 'Mark', 'Jackson', '1234567892', '+44', NULL, 'mac@yopmail.com', '$2y$10$juVYfM.ucTYTAybbM4PcCeNKGTOs4sfhveEnW5PZOgMVFiWvG5egi', 'customers.png', NULL, NULL, 1, 'WEB', NULL, 1, '2023-08-28 14:10:13', '2023-08-28 14:10:13', NULL),
(34, 'Ronak', 'Kapadi', '0972797969', '+44', NULL, 'ronakkapadi@yopmail.com', '$2y$10$kgRFEQtZ3QHC7KWF4jL6cucW2NlJooaCzSzV46eE8/IRsSR7sd2j2', 'customers.png', NULL, NULL, 1, NULL, NULL, 1, '2023-08-29 17:55:15', '2023-08-30 08:37:30', NULL),
(35, 'Ronak', 'Kapadi', '0974252352', '+44', NULL, 'macbook@yopmail.com', '$2y$10$g5IeCFeEnNsQ3RzuBGdXsOan9ftT0FimnhnQU2pF8qlX7ohcoh6v2', 'customers.png', NULL, NULL, 1, 'WEB', NULL, 1, '2023-08-29 18:02:29', '2023-08-29 18:02:29', NULL),
(37, 'Ronak', 'Kapadi', '09714170940', '+44', NULL, 'ronakkapadi11@yopmail.com', '$2y$10$STtXDIjl8sas/eZb2dQo4OgVfJZgvWQ6zngviGNETDKq5vHrzlShy', 'customers.png', NULL, NULL, 1, 'WEB', NULL, 1, '2023-08-30 01:18:58', '2023-08-30 01:18:58', NULL),
(39, 'Martin', 'Elon', '1234567999', '+44', NULL, 'raju071.con@gmail.com', '$2y$10$fu/5uT9U9tYV/.vUI9aDpOHqvTa.wiNr8Rt8NQKdPfhxjsAJQefz.', 'customers.png', NULL, NULL, 1, 'WEB', NULL, 1, '2023-08-30 02:24:09', '2023-08-30 02:24:09', NULL),
(40, 'Json', 'Elan', '1234569999', '+44', NULL, 'raju072.con@gmail.com', '$2y$10$i21.eAlQ9oAf4qJJ9413C.AG3X3qZ.pxMynv.iBoVRiQIQ9SOx5Ha', 'customers.png', NULL, NULL, 1, 'WEB', NULL, 1, '2023-08-30 03:00:25', '2023-08-30 03:00:25', NULL),
(41, 'Test', 'User', '09714170944', '+44', NULL, 'ok@yopmail.com', '$2y$10$7XSFEShGdu9SilhzQ4aaw.soP8LNmv2oQMxpQO0mQESkEHS04LOrq', 'customers.png', NULL, NULL, 1, 'WEB', NULL, 1, '2023-08-30 07:41:32', '2023-08-30 07:41:32', NULL),
(42, 'Ronak', 'Kapadi', '09714170945', '+44', NULL, 'okok@yopmail.com', '$2y$10$YnAz7/m4zM4t1yA0GYSTneRPFeXMqW8Q/cBFS6DRQr.S78VTsV1iO', 'customers.png', NULL, NULL, 1, NULL, NULL, 1, '2023-08-30 09:54:22', '2023-08-30 10:04:53', NULL),
(43, 'Ok', 'OK', '09714170949', '+44', NULL, 'rk@gmail.co', '$2y$10$nd79LpH2SSKQIr1.ab1bQeGnnOgc3PIk607plyfynze56CcRxticO', 'customers.png', NULL, NULL, 1, NULL, NULL, 1, '2023-08-30 10:13:35', '2023-08-30 10:15:23', NULL),
(44, 'Mahek', 'Tester', '02452326235', '+44', NULL, 'mk@yopmail.com', '$2y$10$il9DVFJ5iNWRO1hAl2YdhecKcnEqgeWALQKZkKUknaeWP2Oa.4Xue', 'customers.png', NULL, NULL, 1, NULL, NULL, 1, '2023-08-30 10:24:39', '2023-08-30 10:34:35', NULL),
(45, 'Ronak', 'Kapadi', '09714170988', '+44', NULL, 'ronak12@yopmail.com', '$2y$10$B1G9Lj6t1Uy3JYHmKM8z/eIIECFBhTw3rt/.rUFsqsUVpa3q.PHQu', 'customers.png', NULL, NULL, 1, 'WEB', NULL, 1, '2023-08-30 11:36:01', '2023-08-30 11:36:01', NULL),
(46, 'Rock', 'Henny', '09714167089', '+44', NULL, 'rock@yopmail.com', '$2y$10$jN/yDUXFfnE8MZ3rU9inNen7BbYMvjbtxrTr9/.IluOqT4/.hEXKy', 'customers.png', NULL, NULL, 1, 'WEB', NULL, 1, '2023-08-30 12:34:51', '2023-08-30 12:34:51', NULL),
(47, 'First', 'Last', '09724537699', '+44', NULL, 'first@yopmail.com', '$2y$10$CXyMzu99AJjQGGnibrAJQ.03KHWzsErY9JuC3oRykT82XR/ajvTkC', 'customers.png', NULL, NULL, 1, 'WEB', NULL, 1, '2023-08-30 13:01:59', '2023-08-30 13:01:59', NULL),
(48, 'Jems', 'Elan', '1234568888', '+44', NULL, 'raju07.con@gmail.com', '$2y$10$UeupTQRwDs2wcXiN1dw2IO2PXckARXlPbdYzJC/YerLFArEncyp1y', 'customers.png', NULL, NULL, 1, 'WEB', NULL, 1, '2023-08-30 13:46:24', '2023-08-30 13:46:24', NULL),
(49, 'Vipul', 'Bhandari', '07570285011', '+44', NULL, 'octobas@gmail.com', '$2y$10$N.9nN7G7ETfrvm.8BQoQ.eISqh4pes3WJpQSdFyQqxtPzLJ49HJFe', 'SY3jmVfHtP.png', NULL, NULL, 1, NULL, NULL, 1, '2023-09-24 06:22:07', '2023-09-29 03:49:42', NULL),
(50, 'Ronak', 'Kapadi', '97141709400', '+44', NULL, 'test@yopmail.com', '$2y$10$eRN/f3vanrWOtNFQbqEIWOcCpTTvPP3kWVkMn1cK2IlwnytVi5d6.', 'nGR7fdgYHK.jpg', NULL, NULL, 1, NULL, NULL, 1, '2023-09-26 00:52:28', '2023-09-30 10:45:40', NULL),
(51, 'Test', 'Test', '35236262623', '+44', NULL, 'te@yopmail.com', '$2y$10$NsOlTTbIRnuS6auQp6r/8urGHWf6o/wUh1FCHviI/mioxVotGE95y', 'customers.png', NULL, NULL, 1, 'WEB', NULL, 1, '2023-09-26 15:16:09', '2023-09-26 15:16:09', NULL),
(52, 'Ronak', 'Kapadi', '9714170990', '+44', NULL, 'rockey@yopmail.com', '$2y$10$kudtO.JgfsqNRbxlz./huekKgSVzy7QAJcKzmQWws8yAgGo9jfdXW', 'customers.png', NULL, NULL, 1, 'WEB', NULL, 1, '2023-10-10 04:37:08', '2023-10-10 04:37:08', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pos_customers_address`
--

DROP TABLE IF EXISTS `pos_customers_address`;
CREATE TABLE IF NOT EXISTS `pos_customers_address` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `customerId` int(10) UNSIGNED DEFAULT NULL,
  `addressName` varchar(255) NOT NULL,
  `streetName` varchar(255) NOT NULL,
  `locality` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `postCode` varchar(255) NOT NULL,
  `type` enum('BILLING','BUSINESS','SHIPPING','CONTRACT') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pos_customers_address_customerid_foreign` (`customerId`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pos_customers_address`
--

INSERT INTO `pos_customers_address` (`id`, `customerId`, `addressName`, `streetName`, `locality`, `country`, `postCode`, `type`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'Ronak Kapadi', 'A-706, Savvy Strata, Near LJ Campus', 'Ahmedabad (Gujarat)', 'India', '380001', 'BILLING', '2023-08-04 13:34:50', '2023-08-06 22:12:51', '2023-08-06 22:12:51'),
(2, 2, 'Mr. Phillips Gaillard', 'Gunnersbury House, 1 Chapel Hill', 'London', 'UK', 'A11 B12', 'BILLING', '2023-08-04 13:34:50', '2023-08-12 07:11:15', '2023-08-12 07:11:15'),
(3, 1, 'Kapadi Ronak', 'Ahmedabad (Gujarat)', 'Ahmedabad', 'India', '380015', 'BILLING', '2023-08-06 22:13:52', '2023-08-06 22:14:16', '2023-08-06 22:14:16'),
(4, 1, 'Kapadi Ronak', 'Ahmedabad (Gujarat)', 'Ahmedabad', 'India', '380015', 'BILLING', '2023-08-06 22:16:26', '2023-08-06 22:16:31', '2023-08-06 22:16:31'),
(5, 1, 'Kapadi Ronak', 'Ahmedabad (Gujarat)', 'Ahmedabad', 'India', '380015', 'BILLING', '2023-08-06 22:16:38', '2023-08-06 22:16:38', NULL),
(6, 1, 'Hello new address EDIT', 'Stree name  EDIT', 'locality  EDIT', 'UK  EDIT', '999999', 'SHIPPING', '2023-08-30 10:00:05', '2023-08-30 10:00:05', NULL),
(7, 2, 'Ronak Kapadi', 'A-706, Savvy Strata, Behind LJ Campus.', 'Ahmedabad (Gujarat)', 'India', '380002', 'BILLING', '2023-08-12 06:44:16', '2023-08-12 07:24:05', '2023-08-12 07:24:05'),
(8, 2, 'Mayur', 'A-405', 'Gandhinagar', 'India', '362130', 'BILLING', '2023-08-12 07:21:44', '2023-08-12 07:26:07', '2023-08-12 07:26:07'),
(9, 2, 'Ronak Kapdi', 'A-706, Savvy Strata, Behind LJ Campus.', 'Gandhinagar', 'India', '38001', 'BILLING', '2023-08-12 07:25:16', '2023-08-12 07:26:00', '2023-08-12 07:26:00'),
(10, 2, 'Ronak kapadi', 'A-706, Savvy Strata', 'GANDHINAGAR', 'India', '38001', 'BILLING', '2023-08-12 07:26:49', '2023-08-18 13:45:55', '2023-08-18 13:45:55'),
(11, 2, 'Mayur', 'A-404, Savvy Strata', 'Rajkot', 'India', '555555', 'BILLING', '2023-08-12 07:36:17', '2023-08-18 13:45:51', '2023-08-18 13:45:51'),
(12, 25, 'Ronak Kapadi', 'A-706, Savvy Strata, behind LJ Campus.', 'Ahmedabad', 'India', '380001', 'BILLING', '2023-08-14 10:22:29', '2023-08-19 03:09:27', '2023-08-19 03:09:27'),
(13, 2, 'Ronak', 'Kapadi', 'Gujarat', 'India', '380001', 'BILLING', '2023-08-19 02:31:06', '2023-08-19 02:44:30', '2023-08-19 02:44:30'),
(14, 2, 'ok', 'ok', '35235', 'Iceland', '2424', 'BILLING', '2023-08-19 02:45:16', '2023-08-19 02:47:40', '2023-08-19 02:47:40'),
(15, 2, 'wtwe', 'slfhof', 'wotywo', 'India', '6529385', 'BILLING', '2023-08-19 02:48:25', '2023-08-19 02:48:47', '2023-08-19 02:48:47'),
(16, 2, 'Ronak', 'Kapadi', 'Gujarat', 'India', '380001', 'BILLING', '2023-08-19 02:48:59', '2023-08-19 02:49:33', '2023-08-19 02:49:33'),
(17, 2, 'Ronak', 'Kapadi', 'Gujarat', 'India', '380001', 'BILLING', '2023-08-19 02:50:08', '2023-08-19 02:50:08', NULL),
(18, 25, 'Ronak Kapadi', 'Savvy Strata, LJ Campus.', 'Ahmedabad', 'Iceland', '380001', 'BILLING', '2023-08-19 03:10:13', '2023-08-19 04:13:58', '2023-08-19 04:13:58'),
(19, 25, 'Ronak kapadi', 'A-706, Savvy Strata, LJ Campus', 'Ahmedabad', 'India', '380001', 'BILLING', '2023-08-19 04:15:14', '2023-08-19 04:30:53', '2023-08-19 04:30:53'),
(20, 25, 'Ronak', 'Savvy Strata, behind LJ Campus', 'Junagadh', 'India', '362130', 'BILLING', '2023-08-19 04:31:35', '2023-08-19 04:31:35', NULL),
(22, 2, 'Hallo Mark', 'B- 122, Street Near', 'LN', 'United Kingdom', '545454', 'BILLING', '2023-08-28 03:09:03', '2023-08-28 03:09:03', NULL),
(23, 39, 'Jems Elson', 'Street Flase number', 'UK', 'United Kingdom', '767676', 'BILLING', '2023-08-30 02:29:08', '2023-08-30 02:29:08', NULL),
(24, 40, 'ABC', 'DES', 'UK', 'United Kingdom', '123456', 'BILLING', '2023-08-30 03:02:55', '2023-08-30 03:02:55', NULL),
(25, 1, 'Hello new address EDIT', 'Stree name  EDIT', 'locality  EDIT', 'UK  EDIT', '999999', 'SHIPPING', '2023-08-30 10:00:24', '2023-08-30 10:00:24', NULL),
(26, 42, 'Ronak Kapadi', 'Ford behind', 'Gujarat', 'United Kingdom', '362130', 'BILLING', '2023-08-30 10:06:15', '2023-08-30 10:10:38', '2023-08-30 10:10:38'),
(27, 42, 'Ronak', 'Ford', 'Gujarat', 'United Kingdom', 'HIJ203', 'BILLING', '2023-08-30 10:07:08', '2023-08-30 10:11:15', '2023-08-30 10:11:15'),
(28, 42, 'Ok', 'Ok', 'Guj', 'United Kingdom', 'DGG24523', 'BILLING', '2023-08-30 10:11:49', '2023-08-30 10:11:49', NULL),
(29, 44, 'Mahek', 'behind Ford showroom', 'UK', 'United Kingdom', 'HOK232', 'BILLING', '2023-08-30 10:25:35', '2023-08-30 10:25:35', NULL),
(30, 45, 'Ronak Kapadi', 'Behind Ford campus', 'UK', 'United Kingdom', 'H17OPK', 'BILLING', '2023-08-30 11:38:12', '2023-08-30 11:38:26', NULL),
(31, 31, 'Vipul Bhandari', '66 Ford Close', 'London North, Greater London', 'Afghanistan', 'HA14AZ', 'BILLING', '2023-08-30 12:09:35', '2023-08-30 12:12:19', '2023-08-30 12:12:19'),
(32, 31, 'Vipul Bhandari', '66 Ford Close', 'London North, Greater London', 'United Kingdom', 'HA14AZ', 'BILLING', '2023-08-30 12:12:33', '2023-08-30 12:12:33', NULL),
(33, 46, 'Rock Henny', 'Ford Central', 'UK', 'United Kingdom', 'H65 JI4', 'BILLING', '2023-08-30 12:36:16', '2023-08-30 12:36:16', NULL),
(34, 47, 'First Name', 'Ford central', 'UK', 'United Kingdom', 'HI6 6Y7', 'BILLING', '2023-08-30 13:03:53', '2023-08-30 13:03:53', NULL),
(35, 48, 'Marsin Peter', 'Block PEter', 'LN', 'United Kingdom', 'W22 B11', 'BILLING', '2023-08-30 13:46:59', '2023-08-30 13:46:59', NULL),
(36, 49, 'Vipul Bhandari', '66 Ford Close', 'London North, Greater London', 'United Kingdom', 'HA14AZ', 'BILLING', '2023-09-24 06:23:15', '2023-09-24 06:23:15', NULL),
(37, 50, 'Kapadi Ronak', 'Ahmedabad (Gujarat)', 'Ahmedabad', 'United Kingdom', '380015', 'BILLING', '2023-09-26 00:55:09', '2023-09-26 00:55:09', NULL),
(38, 51, 'ok', 'ok', 'ok', 'United Kingdom', 'OKKOKOKO', 'BILLING', '2023-09-26 15:16:30', '2023-09-26 15:16:30', NULL),
(39, 24, 'Ronak Kapadi', '303, Strata near LJ Campus', 'Ahmedabad', 'India', '380015', 'BILLING', '2023-09-28 15:04:31', '2023-09-28 15:04:31', NULL),
(40, 52, 'Ronak Kapadi', 'Ford Street', 'London', 'United Kingdom', '35H 6JK', 'BILLING', '2023-10-10 04:37:37', '2023-10-10 04:37:37', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pos_failed_jobs`
--

DROP TABLE IF EXISTS `pos_failed_jobs`;
CREATE TABLE IF NOT EXISTS `pos_failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pos_failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pos_migrations`
--

DROP TABLE IF EXISTS `pos_migrations`;
CREATE TABLE IF NOT EXISTS `pos_migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pos_migrations`
--

INSERT INTO `pos_migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_stores_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2016_06_01_000001_create_oauth_auth_codes_table', 1),
(4, '2016_06_01_000002_create_oauth_access_tokens_table', 1),
(5, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1),
(6, '2016_06_01_000004_create_oauth_clients_table', 1),
(7, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1),
(8, '2019_08_19_000000_create_failed_jobs_table', 1),
(9, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(10, '2022_12_02_100000_create_roles_table', 1),
(11, '2022_12_02_100001_create_employees_table', 1),
(12, '2022_12_14_175446_create_access_table', 1),
(13, '2022_12_14_175514_create_customers_table', 1),
(14, '2022_12_14_179514_create_customers_otp_table', 1),
(15, '2022_12_14_205514_create_customers_address_table', 1),
(16, '2023_01_05_125107_create_vendors_table', 1),
(17, '2023_01_05_125126_create_country_table', 1),
(18, '2023_01_05_125241_create_state_table', 1),
(19, '2023_01_05_125307_create_city_table', 1),
(20, '2023_07_28_162930_create_categories_table', 1),
(21, '2023_07_28_182147_create_products_table', 1),
(22, '2023_07_28_182247_create_products_images_table', 1),
(23, '2023_07_28_182247_create_products_ratings_table', 1),
(24, '2023_07_29_143638_create_products_attributes_modifiers_table', 1),
(25, '2023_07_29_143655_create_products_attributes_items_table', 1),
(26, '2023_07_29_143713_create_products_modifiers_items_table', 1),
(27, '2023_07_29_143742_create_orders_table', 1),
(28, '2023_07_29_143819_create_orders_items_table', 1),
(29, '2023_07_29_143831_create_orders_items_modifiers_table', 1),
(30, '2023_07_29_143844_create_orders_items_attributes_table', 1),
(31, '2023_08_08_122958_create_tables_table', 2),
(32, '2023_08_08_125022_create_tables_booking_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `pos_oauth_access_tokens`
--

DROP TABLE IF EXISTS `pos_oauth_access_tokens`;
CREATE TABLE IF NOT EXISTS `pos_oauth_access_tokens` (
  `id` varchar(100) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_id` char(36) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `scopes` text,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pos_oauth_access_tokens_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pos_oauth_access_tokens`
--

INSERT INTO `pos_oauth_access_tokens` (`id`, `user_id`, `client_id`, `name`, `scopes`, `revoked`, `created_at`, `updated_at`, `expires_at`) VALUES
('08176b24b27c8dfda225c4b737f65135966bffd264d4f7e9c9184fc4c9c63dbdfc6a5ec515b4a47c', 2, '9a33dded-3326-4631-903c-32de69c6b701', 'customer', '[]', 0, '2023-09-27 11:06:44', '2023-09-27 11:06:44', '2024-09-27 14:06:44'),
('0c7fa902b9faaf600be67fe4098f2ed0abab3f1efb7afe23b19f1018f7bcda650c91d2bb430b14f1', 29, '9a33dded-3326-4631-903c-32de69c6b701', 'customer', '[]', 0, '2023-09-24 05:43:03', '2023-09-24 05:43:03', '2024-09-24 08:43:03'),
('0dd9808086881f71f598a00084177c3c56c055b3c74d37d1d5c22726ceeefe71b37d33a2bff47504', 50, '9a33dded-3326-4631-903c-32de69c6b701', 'customer', '[]', 0, '2023-09-26 00:52:28', '2023-09-26 00:52:28', '2024-09-26 03:52:28'),
('0fab36ff5c0ec169c14cb1ae315b6743e4226b1e96fa7e9254a9e2e4f90ff76356be9ceec7944ce5', 49, '9a33dded-3326-4631-903c-32de69c6b701', 'customer', '[]', 0, '2023-09-26 18:36:41', '2023-09-26 18:36:41', '2024-09-26 21:36:41'),
('119e058c59ed47689128bee7badbae763725c8a4a0f0e574e97926764aa8a795d3c1f10266c86c38', 49, '9a33dded-3326-4631-903c-32de69c6b701', 'customer', '[]', 0, '2023-09-24 06:27:07', '2023-09-24 06:27:07', '2024-09-24 09:27:07'),
('141057677fa4dc4113345fab32011b52b387ecd01ab5e22da0b944f5740a99f93c849c9ac5bc5e23', 51, '9a33dded-3326-4631-903c-32de69c6b701', 'customer', '[]', 0, '2023-09-26 15:16:09', '2023-09-26 15:16:09', '2024-09-26 18:16:09'),
('18a98a258d8cfbb1b8c812745663c4fe51026c26ea4374c74512c539f9abd837ecfdaf6dd5ae7c5f', 50, '9a33dded-3326-4631-903c-32de69c6b701', 'customer', '[]', 0, '2023-09-26 15:02:17', '2023-09-26 15:02:17', '2024-09-26 18:02:17'),
('239fded9f8bc939383847b417bd3782c881a1b514a157cf4d6c0b72cee573ece8d4c0e1bbfd895fd', 50, '9a33dded-3326-4631-903c-32de69c6b701', 'customer', '[]', 0, '2023-10-01 16:00:56', '2023-10-01 16:00:56', '2024-10-01 19:00:56'),
('23a5d425caffeabb2d1f2c910b21b2268fde811d8e7120780ebda48ba888fa493a6b9031a173d5d5', 2, '9a33dded-3326-4631-903c-32de69c6b701', 'customer', '[]', 0, '2023-09-23 10:26:19', '2023-09-23 10:26:19', '2024-09-23 13:26:19'),
('2e8e03638a18a9572e1eb25b3334246a2e647ffbedd49f9b5072375953fe157952a79611a99eeec7', 2, '9a33dded-3326-4631-903c-32de69c6b701', 'customer', '[]', 0, '2023-10-20 12:11:12', '2023-10-20 12:11:12', '2024-10-20 15:11:12'),
('30e55757de9868e8eac74e0d8043f53898daa85cd94e46b6fa457eeb369c540d3601504511620ce8', 24, '9a33dded-3326-4631-903c-32de69c6b701', 'customer', '[]', 0, '2023-09-26 15:40:13', '2023-09-26 15:40:13', '2024-09-26 18:40:13'),
('33c384f114e8838a62bc519031357d6170641f2ce9528b5952faafe6d90ab23659495fe69494e8bd', 2, '9a33dded-3326-4631-903c-32de69c6b701', 'customer', '[]', 0, '2023-09-23 10:31:27', '2023-09-23 10:31:27', '2024-09-23 13:31:27'),
('3e969e186937219fe8b1e4a23369371b97298642815563bb7bb1dfbaf11e897f9186f6817ef71c6d', 49, '9a33dded-3326-4631-903c-32de69c6b701', 'customer', '[]', 0, '2023-09-24 06:33:40', '2023-09-24 06:33:40', '2024-09-24 09:33:40'),
('45188ce73ff75edc543b12d3c7a64e7b0e175c054d36cba7912926a53e4e5ff7575fcc1b79cebc86', 50, '9a33dded-3326-4631-903c-32de69c6b701', 'customer', '[]', 0, '2023-09-26 14:47:50', '2023-09-26 14:47:50', '2024-09-26 17:47:50'),
('49ae7dbab0467659c9f62c7b3e07a49a922e5b44f3580096fcb7a436151d5e43fda673fa902c98c6', 25, '9a33dded-3326-4631-903c-32de69c6b701', 'customer', '[]', 0, '2023-10-15 07:00:52', '2023-10-15 07:00:52', '2024-10-15 10:00:52'),
('49d00321da57fd294debeafa4825bab22c7241cbc7b2aa4a96bf94ebb044326498f81afc4fcc3e20', 50, '9a33dded-3326-4631-903c-32de69c6b701', 'customer', '[]', 0, '2023-09-26 14:55:45', '2023-09-26 14:55:45', '2024-09-26 17:55:45'),
('4f9036c6fe4c388d2c3d9319e44952fee0afa8d127363e8645c51a1bf0aebfaa0890109b3687e8c0', 2, '9a33dded-3326-4631-903c-32de69c6b701', 'customer', '[]', 0, '2023-10-12 23:59:09', '2023-10-12 23:59:09', '2024-10-13 02:59:09'),
('53b4c8c688dc110fd804fb2bd04519218115fab09988d54f9954c919e81d4c2fae8b320c134eebc5', 49, '9a33dded-3326-4631-903c-32de69c6b701', 'customer', '[]', 0, '2023-09-24 06:22:07', '2023-09-24 06:22:07', '2024-09-24 09:22:07'),
('5a21a7eb7fd801ed2fddcbfef26abbd068d0f288e3ad68a0afc7d248f1c634d7ffdfa8e917fd0e8d', 50, '9a33dded-3326-4631-903c-32de69c6b701', 'customer', '[]', 0, '2023-09-26 15:02:33', '2023-09-26 15:02:33', '2024-09-26 18:02:33'),
('5cbfaaa321f6ab4115df8eaa8c03011f2ba94ce1a3d2c858bad94188c740acf63d87eb9b16a2f05f', 2, '9a33dded-3326-4631-903c-32de69c6b701', 'customer', '[]', 0, '2023-10-20 11:14:35', '2023-10-20 11:14:35', '2024-10-20 14:14:35'),
('605dc5d2d15045fc312e4488856afcd679df80e57455e8de4cd214dc7bdfb220acd850ec815d9210', 2, '9a33dded-3326-4631-903c-32de69c6b701', 'customer', '[]', 0, '2023-09-29 02:28:07', '2023-09-29 02:28:07', '2024-09-29 05:28:07'),
('61c77d02a504e4e3dd24d8647c500f973ddfaeeba3b6bfdab7473333de2a6fb384e475736939e809', 50, '9a33dded-3326-4631-903c-32de69c6b701', 'customer', '[]', 0, '2023-09-26 12:18:33', '2023-09-26 12:18:33', '2024-09-26 15:18:33'),
('67e17d2f0e450e3c4e8eef192d873e88e0282db5e480ac523c122cb5b0439affe3fe65e90676fa1f', 50, '9a33dded-3326-4631-903c-32de69c6b701', 'customer', '[]', 0, '2023-10-01 15:54:37', '2023-10-01 15:54:37', '2024-10-01 18:54:37'),
('6b618eac141c543a5aeead29168f38848542166eb95b2daf89e365b28f1e85a3907ce25014df4b51', 24, '9a33dded-3326-4631-903c-32de69c6b701', 'customer', '[]', 0, '2023-10-12 07:18:09', '2023-10-12 07:18:09', '2024-10-12 10:18:09'),
('6c4901eb4e9e124fdca67248a47a118dc59aaa64c66a671d076437aee806a277f3c6991141dbb49f', 2, '9a33dded-3326-4631-903c-32de69c6b701', 'customer', '[]', 0, '2023-09-29 05:54:52', '2023-09-29 05:54:52', '2024-09-29 08:54:52'),
('70286e7e9c6397e724f259c9ae7827d50140ea647bab473f0e910fc69d9ff55842ff2c6b7f7db356', 49, '9a33dded-3326-4631-903c-32de69c6b701', 'customer', '[]', 0, '2023-09-29 05:43:35', '2023-09-29 05:43:35', '2024-09-29 08:43:35'),
('776df89bfa1f90e9a94f9bf4687a78e5e82cd9303fa39e80488d700d367a011be30f0939c044f4f6', 50, '9a33dded-3326-4631-903c-32de69c6b701', 'customer', '[]', 0, '2023-09-26 14:54:48', '2023-09-26 14:54:48', '2024-09-26 17:54:48'),
('9ad07f53b5470a28ee5fdeed67093134ed49546d4b02dc73963ed7034205506eff899074b494409e', 2, '9a33dded-3326-4631-903c-32de69c6b701', 'customer', '[]', 0, '2023-11-01 08:20:24', '2023-11-01 08:20:24', '2024-11-01 10:20:24'),
('9d72c2ba30c19f779714c70333a200025ac5abde9e443611a022e04551cb79ccf668011d4c1c5009', 25, '9a33dded-3326-4631-903c-32de69c6b701', 'customer', '[]', 0, '2023-10-15 06:25:08', '2023-10-15 06:25:08', '2024-10-15 09:25:08'),
('9db22e73245bd08afe3605ac5a9ed2a4c3fbd9415f700a30827d3916c2fb13fb8a019848d5a1dab0', 50, '9a33dded-3326-4631-903c-32de69c6b701', 'customer', '[]', 0, '2023-09-26 14:39:49', '2023-09-26 14:39:49', '2024-09-26 17:39:49'),
('a8e69452656e42645086bd0a0a52058b94cacd490e6860cda5e6f6c92184a3d5998f72883a16fa94', 50, '9a33dded-3326-4631-903c-32de69c6b701', 'customer', '[]', 0, '2023-09-26 01:05:25', '2023-09-26 01:05:25', '2024-09-26 04:05:25'),
('ac56bb9d0844bf70aca7cd9761bad670a2ba6fad2a1c92faf9a15e72272a3fd2a267a125e8827899', 50, '9a33dded-3326-4631-903c-32de69c6b701', 'customer', '[]', 0, '2023-09-26 15:07:29', '2023-09-26 15:07:29', '2024-09-26 18:07:29'),
('accad73e8b4b60316269143a29e063edaedce5e36d357f04cd780bdea243eb585527d41545ed9c25', 2, '9a33dded-3326-4631-903c-32de69c6b701', 'customer', '[]', 0, '2023-09-28 15:18:41', '2023-09-28 15:18:41', '2024-09-28 18:18:41'),
('afa03d6b4b4377cda6f547631b38b76ec24fbc2ef329b995ca7f11c2673e6c1e086296e9a936e251', 29, '9a33dded-3326-4631-903c-32de69c6b701', 'customer', '[]', 0, '2023-09-24 06:08:49', '2023-09-24 06:08:49', '2024-09-24 09:08:49'),
('afaafdbfd018b53f2f21b017e5b81eb6a8ef61ff77b72d5cee619f9292f13af38e515364ee840c5c', 29, '9a33dded-3326-4631-903c-32de69c6b701', 'customer', '[]', 0, '2023-09-24 05:47:46', '2023-09-24 05:47:46', '2024-09-24 08:47:46'),
('b1c897afa735d3bfdb339f7555fb583d7978215b126f48a9d3e4ae563819202feb607d209ac01905', 50, '9a33dded-3326-4631-903c-32de69c6b701', 'customer', '[]', 0, '2023-09-26 14:47:21', '2023-09-26 14:47:21', '2024-09-26 17:47:21'),
('b4a8b0686642c6dbf6cfa16dc9a792e05f7bcce02236bdec3f49141fdc632f2e21d21b7e23294dce', 29, '9a33dded-3326-4631-903c-32de69c6b701', 'customer', '[]', 0, '2023-09-24 05:43:41', '2023-09-24 05:43:41', '2024-09-24 08:43:41'),
('b709fc39d5154683671363b99d1be5ce7ef5a1bdfe3fb9a5f298213cc159e42bb4878bd1545e6d43', 50, '9a33dded-3326-4631-903c-32de69c6b701', 'customer', '[]', 0, '2023-10-01 16:27:28', '2023-10-01 16:27:28', '2024-10-01 19:27:28'),
('ba0d84beddd850d81eff5b819962238f25c08d0bd389ca9cb82d914c15b8e54c8e73e1b83f58f294', 50, '9a33dded-3326-4631-903c-32de69c6b701', 'customer', '[]', 0, '2023-10-01 15:35:33', '2023-10-01 15:35:33', '2024-10-01 18:35:33'),
('bc1c079d074438db2995892557863ec3e4395599435e263add1c55ab80a29041aae7ac9c57f10f4e', 49, '9a33dded-3326-4631-903c-32de69c6b701', 'customer', '[]', 0, '2023-09-26 18:35:14', '2023-09-26 18:35:14', '2024-09-26 21:35:14'),
('bf32fe4d6f5f89df72c5fbc760ff13849cf2743f4c045794e55345e75d8b98d5d491dfc985114f5f', 50, '9a33dded-3326-4631-903c-32de69c6b701', 'customer', '[]', 0, '2023-10-01 15:35:31', '2023-10-01 15:35:31', '2024-10-01 18:35:31'),
('c98c522ac737c94cf48b2758f5d0d0d7e287c5162461cef5623e0585afd6e4dec7fbcd112ab0768d', 2, '9a33dded-3326-4631-903c-32de69c6b701', 'customer', '[]', 0, '2023-09-29 05:30:31', '2023-09-29 05:30:31', '2024-09-29 08:30:31'),
('d01fa8464e38d33ef3d18d0ca36a946e68628fc1bce1cce87489c54db78cd7b69fdb4d51b57f8d98', 2, '9a33dded-3326-4631-903c-32de69c6b701', 'customer', '[]', 0, '2023-10-01 01:24:14', '2023-10-01 01:24:14', '2024-10-01 04:24:14'),
('d870ec8f3e0a7ad61c6ed4dfd321cbb45f87469160f6360b8f1bfcb2a17e7b0bcd4e013cb1bcebe7', 50, '9a33dded-3326-4631-903c-32de69c6b701', 'customer', '[]', 0, '2023-09-30 10:55:25', '2023-09-30 10:55:25', '2024-09-30 13:55:25'),
('daa64216dee1d48b1587e038463bc58d59bb37e1ed743d29bb41b57153503ac7c274ce8d1a44c968', 50, '9a33dded-3326-4631-903c-32de69c6b701', 'customer', '[]', 0, '2023-09-30 10:45:00', '2023-09-30 10:45:00', '2024-09-30 13:45:00'),
('ec75aef8ec73ad21a65e42b07c021750ce3c24b02ca91940e626dacdc28be55de60d436e95f2da1a', 50, '9a33dded-3326-4631-903c-32de69c6b701', 'customer', '[]', 0, '2023-09-26 12:14:53', '2023-09-26 12:14:53', '2024-09-26 15:14:53'),
('ede749f65c9342f500278736c127fa8d731ea4f3e6aed69d9f671cfb81a024cf0e287e500d79cccd', 49, '9a33dded-3326-4631-903c-32de69c6b701', 'customer', '[]', 0, '2023-09-29 04:57:03', '2023-09-29 04:57:03', '2024-09-29 07:57:03'),
('f069ebe339b7f497f354969640776da434b71aebbec4ee0f90e26bbd6795aeac46568c0df7137cd3', 50, '9a33dded-3326-4631-903c-32de69c6b701', 'customer', '[]', 0, '2023-09-26 15:02:50', '2023-09-26 15:02:50', '2024-09-26 18:02:50'),
('f66b00fa8a529b23cff796da6d18a4d26f0cd26f066be86f55df3334b19e8b32f9f4a222e5c95625', 50, '9a33dded-3326-4631-903c-32de69c6b701', 'customer', '[]', 0, '2023-09-26 14:50:14', '2023-09-26 14:50:14', '2024-09-26 17:50:14'),
('f75bd379152f001edcc650c893c5191d69a8f4b8eff325d538b1110711b131cb700f5718339e405e', 50, '9a33dded-3326-4631-903c-32de69c6b701', 'customer', '[]', 0, '2023-09-26 14:51:09', '2023-09-26 14:51:09', '2024-09-26 17:51:09'),
('ff84f6dc0cae0603d762c8fe825374e35b4e89a4e95260b5dc189423de69bfb2437f1f61e98088a8', 52, '9a33dded-3326-4631-903c-32de69c6b701', 'customer', '[]', 0, '2023-10-10 04:37:08', '2023-10-10 04:37:08', '2024-10-10 07:37:08');

-- --------------------------------------------------------

--
-- Table structure for table `pos_oauth_auth_codes`
--

DROP TABLE IF EXISTS `pos_oauth_auth_codes`;
CREATE TABLE IF NOT EXISTS `pos_oauth_auth_codes` (
  `id` varchar(100) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` char(36) NOT NULL,
  `scopes` text,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pos_oauth_auth_codes_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pos_oauth_clients`
--

DROP TABLE IF EXISTS `pos_oauth_clients`;
CREATE TABLE IF NOT EXISTS `pos_oauth_clients` (
  `id` char(36) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `secret` varchar(100) DEFAULT NULL,
  `provider` varchar(255) DEFAULT NULL,
  `redirect` text NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pos_oauth_clients_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pos_oauth_clients`
--

INSERT INTO `pos_oauth_clients` (`id`, `user_id`, `name`, `secret`, `provider`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
('9a33dded-3326-4631-903c-32de69c6b701', NULL, 'Romeopizaa Personal Access Client', 'uNg6Zzcjgu67v1nFuf9h3zqIxgsCs5AB6sv9um5x', NULL, 'http://localhost', 1, 0, 0, '2023-09-23 10:26:13', '2023-09-23 10:26:13'),
('9a33dded-4680-4793-9ac9-0d5747fb1270', NULL, 'Romeopizaa Password Grant Client', '0BO7QYEBosZ47YvrhNCNUg79PelaItQNcVWK5nz2', 'users', 'http://localhost', 0, 1, 0, '2023-09-23 10:26:13', '2023-09-23 10:26:13');

-- --------------------------------------------------------

--
-- Table structure for table `pos_oauth_personal_access_clients`
--

DROP TABLE IF EXISTS `pos_oauth_personal_access_clients`;
CREATE TABLE IF NOT EXISTS `pos_oauth_personal_access_clients` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `client_id` char(36) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pos_oauth_personal_access_clients`
--

INSERT INTO `pos_oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
(1, '9a33dded-3326-4631-903c-32de69c6b701', '2023-09-23 10:26:13', '2023-09-23 10:26:13');

-- --------------------------------------------------------

--
-- Table structure for table `pos_oauth_refresh_tokens`
--

DROP TABLE IF EXISTS `pos_oauth_refresh_tokens`;
CREATE TABLE IF NOT EXISTS `pos_oauth_refresh_tokens` (
  `id` varchar(100) NOT NULL,
  `access_token_id` varchar(100) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pos_oauth_refresh_tokens_access_token_id_index` (`access_token_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pos_orders`
--

DROP TABLE IF EXISTS `pos_orders`;
CREATE TABLE IF NOT EXISTS `pos_orders` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `storeId` int(10) UNSIGNED DEFAULT NULL,
  `employeeId` int(10) UNSIGNED DEFAULT NULL,
  `customerId` int(10) UNSIGNED DEFAULT NULL,
  `customerAddressId` int(10) UNSIGNED DEFAULT NULL,
  `driverId` int(11) DEFAULT NULL,
  `stripePid` varchar(100) DEFAULT NULL,
  `stripePmid` varchar(100) DEFAULT NULL,
  `stripePaymentStatus` varchar(100) DEFAULT NULL,
  `totalQuantity` int(11) DEFAULT '0',
  `totalAmount` double(10,5) DEFAULT '0.00000',
  `subTotalAmount` double(10,5) DEFAULT '0.00000',
  `taxTotalAmount` double(10,5) DEFAULT '0.00000',
  `tipAmount` double(10,2) NOT NULL DEFAULT '0.00',
  `DeliveryAmount` double(10,2) NOT NULL DEFAULT '0.00',
  `deliveryType` varchar(50) DEFAULT NULL,
  `deliveryDateTime` varchar(50) DEFAULT NULL,
  `discountRate` double(10,5) DEFAULT '0.00000',
  `discountId` int(11) DEFAULT NULL,
  `discountAmount` double(10,8) DEFAULT '0.00000000',
  `noOfPersons` int(11) DEFAULT '0',
  `createFrom` enum('WEB','POS') DEFAULT 'WEB',
  `orderNumber` varchar(255) DEFAULT NULL,
  `discountType` enum('FIX','PERCENTAGE') DEFAULT 'FIX',
  `orderType` enum('Delivery','DiningOut','DiningIn','NightLife') DEFAULT 'DiningIn',
  `orderStatus` enum('Pending','CookNow','Rejected','Completed','DriverAccept','DriverRejected','DriverPickup') DEFAULT 'Pending',
  `internalNote` text,
  `notes` text,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pos_orders_storeid_foreign` (`storeId`),
  KEY `pos_orders_employeeid_foreign` (`employeeId`),
  KEY `pos_orders_customerid_foreign` (`customerId`),
  KEY `pos_orders_customeraddressid_foreign` (`customerAddressId`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pos_orders`
--

INSERT INTO `pos_orders` (`id`, `storeId`, `employeeId`, `customerId`, `customerAddressId`, `driverId`, `stripePid`, `stripePmid`, `stripePaymentStatus`, `totalQuantity`, `totalAmount`, `subTotalAmount`, `taxTotalAmount`, `tipAmount`, `DeliveryAmount`, `deliveryType`, `deliveryDateTime`, `discountRate`, `discountId`, `discountAmount`, `noOfPersons`, `createFrom`, `orderNumber`, `discountType`, `orderType`, `orderStatus`, `internalNote`, `notes`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 3, NULL, 49, 36, 1, 'pi_3NvafdA5wqCNycpn0PfzqHVX', 'pm_1NvagAA5wqCNycpnPw4FkL5L', 'succeeded', 1, 11.99000, 9.99000, 1.00000, 0.00, 0.00, NULL, NULL, NULL, NULL, 0.00000000, 1, 'WEB', 'yImiN9beDn', 'FIX', 'DiningIn', 'Pending', NULL, 'I need it now only', 1, '2023-09-29 04:00:04', '2023-09-29 04:00:54', NULL),
(2, 3, NULL, 49, 36, NULL, 'pi_3NvbZWA5wqCNycpn1CMeYwfa', 'pm_1NvbaTA5wqCNycpnJizkgswF', 'succeeded', 2, 10.00000, 8.00000, 1.00000, 0.00, 0.00, NULL, NULL, NULL, NULL, 0.00000000, 1, 'WEB', 'WmLju2YTQR', 'FIX', 'DiningIn', 'Pending', NULL, NULL, 1, '2023-09-29 04:58:16', '2023-09-29 04:58:16', NULL),
(3, 3, NULL, 2, 17, NULL, 'pi_3Nvc5sA5wqCNycpn192kLFZb', 'pm_1Nvc6IA5wqCNycpnrbrOJmlx', 'succeeded', 3, 5.00000, 3.00000, 1.00000, 0.00, 0.00, NULL, NULL, NULL, NULL, 0.00000000, 1, 'WEB', 'yfePfeh8nx', 'FIX', 'DiningIn', 'Pending', NULL, NULL, 1, '2023-09-29 05:31:08', '2023-09-29 05:31:08', NULL),
(4, 3, NULL, 49, 36, NULL, 'pi_3NvcIYA5wqCNycpn1yXS7GMc', 'pm_1NvcJFA5wqCNycpnEDr5pnQZ', 'succeeded', 2, 13.98000, 11.98000, 1.00000, 0.00, 0.00, NULL, NULL, NULL, NULL, 0.00000000, 1, 'WEB', 'hGQsDHoT8N', 'FIX', 'DiningIn', 'Pending', NULL, NULL, 1, '2023-09-29 05:44:31', '2023-09-29 05:44:31', NULL),
(5, 3, NULL, 2, 17, NULL, 'pi_3NvcTcA5wqCNycpn1LKaMcfw', 'pm_1NvcU4A5wqCNycpn6tdzorHq', 'succeeded', 2, 4.00000, 2.00000, 1.00000, 0.00, 0.00, NULL, NULL, NULL, NULL, 0.00000000, 1, 'WEB', 'v7EJedcCOk', 'FIX', 'DiningIn', 'Pending', NULL, NULL, 1, '2023-09-29 05:55:42', '2023-09-29 05:55:42', NULL),
(6, 3, NULL, 50, 37, NULL, 'pi_3NwSHgA5wqCNycpn1LQ7d63p', 'pm_1NwSI9A5wqCNycpni7O7Wk2z', 'succeeded', 1, 11.99000, 9.99000, 1.00000, 0.00, 0.00, NULL, NULL, NULL, NULL, 0.00000000, 1, 'WEB', 'Rs8CL7rPie', 'FIX', 'DiningIn', 'Pending', NULL, NULL, 1, '2023-10-01 13:14:52', '2023-10-01 13:14:52', NULL),
(7, 3, NULL, 50, 37, NULL, 'pi_3NwTENA5wqCNycpn0W4jkmPw', 'pm_1NwTElA5wqCNycpnlsLHPrYl', 'succeeded', 4, 41.92000, 39.92000, 1.00000, 0.00, 0.00, NULL, NULL, NULL, NULL, 0.00000000, 1, 'WEB', 'MlXXPxdeg7', 'FIX', 'DiningIn', 'Pending', NULL, NULL, 1, '2023-10-01 14:15:26', '2023-10-01 14:15:26', NULL),
(8, 3, NULL, 50, 37, NULL, 'pi_3NwUOrA5wqCNycpn1KSdS5na', 'pm_1NwUPQA5wqCNycpnCf17tj3B', 'succeeded', 5, 111.90000, 109.90000, 1.00000, 0.00, 0.00, NULL, NULL, NULL, NULL, 0.00000000, 1, 'WEB', 'UM1iUD1UkP', 'FIX', 'DiningIn', 'Pending', NULL, NULL, 1, '2023-10-01 15:30:30', '2023-10-01 15:30:30', NULL),
(9, 3, NULL, 50, 37, NULL, 'pi_3NwURwA5wqCNycpn0ZdqMGcV', 'pm_1NwUSGA5wqCNycpnsLHPbVte', 'succeeded', 2, 15.98000, 13.98000, 1.00000, 0.00, 0.00, NULL, NULL, NULL, NULL, 0.00000000, 1, 'WEB', 'DVaI61YAa1', 'FIX', 'DiningIn', 'Pending', NULL, NULL, 1, '2023-10-01 15:33:26', '2023-10-01 15:33:26', NULL),
(10, 3, NULL, 50, 37, NULL, 'pi_3NwUnMA5wqCNycpn0az1pDsM', 'pm_1NwUoFA5wqCNycpniqbmP3kw', 'succeeded', 2, 4.00000, 2.00000, 1.00000, 0.00, 0.00, NULL, NULL, NULL, NULL, 0.00000000, 1, 'WEB', 'XTtw3NpnkC', 'FIX', 'DiningIn', 'Pending', NULL, 'In office', 1, '2023-10-01 15:56:10', '2023-10-01 15:56:10', NULL),
(11, 3, NULL, 50, 37, NULL, 'pi_3NwUrQA5wqCNycpn0hQ245xA', 'pm_1NwUrmA5wqCNycpnwnSlHuUs', 'succeeded', 1, 3.00000, 1.00000, 1.00000, 0.00, 0.00, NULL, NULL, NULL, NULL, 0.00000000, 1, 'WEB', 'sDQePQFfTZ', 'FIX', 'DiningIn', 'Pending', NULL, 'In office', 1, '2023-10-01 15:59:48', '2023-10-01 15:59:48', NULL),
(12, 3, NULL, 50, 37, NULL, 'pi_3NwUt1A5wqCNycpn0YXkAP60', 'pm_1NwUtLA5wqCNycpnzhn5L2Wc', 'succeeded', 1, 12.49000, 10.49000, 1.00000, 0.00, 0.00, NULL, NULL, NULL, NULL, 0.00000000, 1, 'WEB', 'EfeWdAfrBg', 'FIX', 'DiningIn', 'Pending', NULL, NULL, 1, '2023-10-01 16:01:25', '2023-10-01 16:01:25', NULL),
(13, 3, NULL, 49, 36, NULL, 'pi_3NwtCxA5wqCNycpn1J9N3uUK', 'pm_1NwtDJA5wqCNycpnun3iSLEY', 'succeeded', 3, 67.97000, 65.97000, 1.00000, 0.00, 0.00, NULL, NULL, NULL, NULL, 0.00000000, 1, 'WEB', 'pwjTUOUtFo', 'FIX', 'DiningIn', 'Pending', NULL, NULL, 1, '2023-10-02 17:59:38', '2023-10-02 17:59:38', NULL),
(14, 3, NULL, 52, 40, NULL, 'pi_3NzaVyA5wqCNycpn0N6DZIVZ', 'pm_1NzaWZA5wqCNycpnF6E1Fia4', 'succeeded', 2, 8.00000, 6.00000, 1.00000, 0.00, 0.00, NULL, NULL, NULL, NULL, 0.00000000, 1, 'WEB', 'aq4spzIQtR', 'FIX', 'DiningIn', 'Pending', NULL, 'In office', 1, '2023-10-10 04:38:41', '2023-10-10 04:38:41', NULL),
(15, 3, NULL, 52, 40, NULL, 'pi_3Nzab1A5wqCNycpn13KuSjTZ', 'pm_1NzabNA5wqCNycpnbijro9EJ', 'succeeded', 3, 11.00000, 9.00000, 1.00000, 0.00, 0.00, NULL, NULL, NULL, NULL, 0.00000000, 1, 'WEB', 'vsTxpC4eUV', 'FIX', 'DiningIn', 'Pending', NULL, NULL, 1, '2023-10-10 04:43:39', '2023-10-10 04:43:39', NULL),
(16, 3, NULL, 52, 40, NULL, 'pi_3Nzg4AA5wqCNycpn0xwJCeWA', 'pm_1Nzg4bA5wqCNycpnto9CEs08', 'succeeded', 2, 41.38000, 39.38000, 1.00000, 0.00, 0.00, NULL, NULL, NULL, NULL, 0.00000000, 1, 'WEB', 'riIoD3gHMg', 'FIX', 'DiningIn', 'Pending', NULL, NULL, 1, '2023-10-10 10:34:11', '2023-10-10 10:34:11', NULL),
(17, 3, NULL, 24, 39, NULL, 'pi_3O0LyAA5wqCNycpn0AlsWSTM', 'pm_1O0LyZA5wqCNycpneEB7QFgs', 'succeeded', 3, 43.97000, 41.97000, 1.00000, 0.00, 0.00, NULL, NULL, NULL, NULL, 0.00000000, 1, 'WEB', 'uVKVTFyo7V', 'FIX', 'DiningIn', 'Pending', NULL, NULL, 1, '2023-10-12 07:18:45', '2023-10-12 07:18:45', NULL),
(18, 1, NULL, 2, 17, NULL, 'pi_3O0boPA5wqCNycpn0BrRzQuB', 'pm_1O0bpCA5wqCNycpn1DWvWxJ7', 'succeeded', 1, 21.00000, 19.00000, 1.00000, 0.00, 0.00, NULL, NULL, NULL, NULL, 0.00000000, 1, 'WEB', 'KgFq7pbtN7', 'FIX', 'DiningIn', 'Pending', NULL, NULL, 1, '2023-10-13 00:14:08', '2023-10-13 00:14:08', NULL),
(19, 3, NULL, 25, 20, NULL, 'pi_3O1QZsA5wqCNycpn0xMblr4Y', 'pm_1O1QaAA5wqCNycpn9mJHJx29', 'succeeded', 2, 17.98000, 15.98000, 1.00000, 0.00, 0.00, NULL, NULL, NULL, NULL, 0.00000000, 1, 'WEB', 'alFjyvpplK', 'FIX', 'DiningIn', 'Pending', NULL, 'In Office', 1, '2023-10-15 06:26:01', '2023-10-15 06:26:01', NULL),
(20, 3, NULL, 25, 20, NULL, 'pi_3O1QsSA5wqCNycpn0S0aMB1f', 'pm_1O1QsrA5wqCNycpnwPuhh4PY', 'succeeded', 1, 9.99000, 7.99000, 1.00000, 0.00, 1.00, 'Standard', NULL, NULL, NULL, 0.00000000, 1, 'WEB', 'm69iRdnZwc', 'FIX', 'DiningIn', 'Pending', NULL, NULL, 1, '2023-10-15 06:45:19', '2023-10-15 06:45:19', NULL),
(21, 3, NULL, 25, 20, NULL, 'pi_3O1R8cA5wqCNycpn1IPkW9Qb', 'pm_1O1R8uA5wqCNycpnlNZSarHJ', 'succeeded', 2, 11.98000, 9.98000, 1.00000, 0.00, 1.00, 'Standard', NULL, NULL, NULL, 0.00000000, 1, 'WEB', '8Yu4X1dOKO', 'FIX', 'DiningIn', 'Pending', NULL, NULL, 1, '2023-10-15 07:01:54', '2023-10-15 07:01:54', NULL),
(22, 3, NULL, 2, 17, 1, 'pi_3O3F3UA5wqCNycpn1WkTxmVb', 'pm_1O3F3yA5wqCNycpns91CqSnX', 'succeeded', 1, 12.69000, 10.69000, 1.00000, 0.00, 1.00, 'Standard', NULL, NULL, NULL, 0.00000000, 1, 'WEB', 'UTGCJBTSVW', 'FIX', 'DiningIn', 'Pending', NULL, NULL, 1, '2023-10-20 06:32:16', '2023-10-20 06:37:50', NULL),
(23, 3, NULL, 2, 17, 1, 'pi_3O3FF2A5wqCNycpn0fiupgTF', 'pm_1O3FFaA5wqCNycpnqjb876G6', 'succeeded', 1, 6.99000, 4.99000, 1.00000, 0.00, 1.00, 'Standard', NULL, NULL, NULL, 0.00000000, 1, 'WEB', 'PBVXEGINW2', 'FIX', 'DiningIn', 'Pending', NULL, NULL, 1, '2023-10-20 06:44:15', '2023-10-20 06:45:37', NULL),
(24, 3, NULL, 2, 17, 1, 'pi_3O3JWpA5wqCNycpn0J3oRelV', 'pm_1O3JXGA5wqCNycpnOBzR2iM4', 'succeeded', 2, 33.98000, 31.98000, 1.00000, 0.00, 1.00, 'Standard', NULL, NULL, NULL, 0.00000000, 1, 'WEB', 'MBPMN8GKHQ', 'FIX', 'DiningIn', 'Pending', NULL, NULL, 1, '2023-10-20 11:18:48', '2023-10-20 11:19:40', NULL),
(25, 3, NULL, 2, 17, 1, 'pi_3O3KCkA5wqCNycpn0tBsDedK', 'pm_1O3KDBA5wqCNycpnrHeyYPgY', 'succeeded', 1, 14.99000, 12.99000, 1.00000, 0.00, 1.00, 'Standard', NULL, NULL, NULL, 0.00000000, 1, 'WEB', 'YLQSYTERWA', 'FIX', 'DiningIn', 'Pending', 'Rejected by driver : Raju', NULL, 1, '2023-10-20 12:02:07', '2023-10-20 12:05:27', NULL),
(26, 3, NULL, 2, 17, 2, 'pi_3O3KPkA5wqCNycpn0JwX2Cg8', 'pm_1O3KQMA5wqCNycpnvo7cLvlj', 'succeeded', 3, 24.47000, 22.47000, 1.00000, 0.00, 1.00, 'Standard', NULL, NULL, NULL, 0.00000000, 1, 'WEB', 'RYXIVGPYLG', 'FIX', 'DiningIn', 'Pending', 'Rejected by driver : Vipul ', NULL, 1, '2023-10-20 12:15:44', '2023-10-20 12:23:48', NULL),
(27, 3, NULL, 2, 17, 2, 'pi_3O7bZGA5wqCNycpn1nZVCeiU', 'pm_1O7bZpA5wqCNycpnWXCWXpIV', 'succeeded', 1, 17.99000, 15.99000, 1.00000, 0.00, 1.00, 'Standard', NULL, NULL, NULL, 0.00000000, 1, 'WEB', '3PQAEHDTW2', 'FIX', 'DiningIn', 'Pending', NULL, NULL, 1, '2023-11-01 08:23:10', '2023-11-01 08:26:07', NULL),
(28, 3, NULL, 2, 17, 2, 'pi_3O7bhYA5wqCNycpn0BUCRvR8', 'pm_1O7bihA5wqCNycpnqMOeWxKM', 'succeeded', 1, 6.99000, 4.99000, 1.00000, 0.00, 1.00, 'Standard', NULL, NULL, NULL, 0.00000000, 1, 'WEB', 'ZVIXFH4LCB', 'FIX', 'DiningIn', 'Pending', NULL, NULL, 1, '2023-11-01 08:32:20', '2023-11-01 08:35:34', NULL),
(29, 3, NULL, 2, 17, 2, 'pi_3O7boSA5wqCNycpn1u6YyVyG', 'pm_1O7bosA5wqCNycpnJO89EISq', 'succeeded', 1, 8.99000, 6.99000, 1.00000, 0.00, 1.00, 'Standard', NULL, NULL, NULL, 0.00000000, 1, 'WEB', 'D0NIVAL3TD', 'FIX', 'DiningIn', 'Pending', NULL, NULL, 1, '2023-11-01 08:38:43', '2023-11-01 08:43:29', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pos_orders_items`
--

DROP TABLE IF EXISTS `pos_orders_items`;
CREATE TABLE IF NOT EXISTS `pos_orders_items` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `orderId` int(10) UNSIGNED NOT NULL,
  `storeId` int(10) UNSIGNED DEFAULT NULL,
  `productId` int(10) UNSIGNED DEFAULT NULL,
  `quantity` double(10,5) DEFAULT '0.00000',
  `subTotal` double(10,5) DEFAULT '0.00000',
  `taxTotal` double(10,5) DEFAULT '0.00000',
  `discountTotal` double(10,5) DEFAULT '0.00000',
  `finalTotal` double(10,5) DEFAULT '0.00000' COMMENT '(product_price*qty)+tax-discount=finalTotal',
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pos_orders_items_orderid_foreign` (`orderId`),
  KEY `pos_orders_items_storeid_foreign` (`storeId`),
  KEY `pos_orders_items_productid_foreign` (`productId`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pos_orders_items`
--

INSERT INTO `pos_orders_items` (`id`, `orderId`, `storeId`, `productId`, `quantity`, `subTotal`, `taxTotal`, `discountTotal`, `finalTotal`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 3, 20, 1.00000, 9.99000, 9.99000, 0.00000, 0.00000, 1, '2023-09-29 04:00:04', '2023-09-29 04:00:04', NULL),
(2, 2, 3, 67, 2.00000, 8.00000, 4.00000, 0.00000, 0.00000, 1, '2023-09-29 04:58:16', '2023-09-29 04:58:16', NULL),
(3, 3, 3, 1, 3.00000, 3.00000, 1.00000, 0.00000, 0.00000, 1, '2023-09-29 05:31:08', '2023-09-29 05:31:08', NULL),
(4, 4, 3, 3, 2.00000, 11.98000, 5.99000, 0.00000, 0.00000, 1, '2023-09-29 05:44:31', '2023-09-29 05:44:31', NULL),
(5, 5, 3, 1, 2.00000, 2.00000, 1.00000, 0.00000, 0.00000, 1, '2023-09-29 05:55:42', '2023-09-29 05:55:42', NULL),
(6, 6, 3, 21, 1.00000, 9.99000, 9.99000, 0.00000, 0.00000, 1, '2023-10-01 13:14:52', '2023-10-01 13:14:52', NULL),
(7, 7, 3, 53, 4.00000, 39.92000, 9.98000, 0.00000, 0.00000, 1, '2023-10-01 14:15:26', '2023-10-01 14:15:26', NULL),
(8, 8, 3, 20, 5.00000, 109.90000, 21.98000, 0.00000, 0.00000, 1, '2023-10-01 15:30:30', '2023-10-01 15:30:30', NULL),
(9, 9, 3, 4, 2.00000, 13.98000, 6.99000, 0.00000, 0.00000, 1, '2023-10-01 15:33:26', '2023-10-01 15:33:26', NULL),
(10, 10, 3, 1, 2.00000, 2.00000, 1.00000, 0.00000, 0.00000, 1, '2023-10-01 15:56:10', '2023-10-01 15:56:10', NULL),
(11, 11, 3, 1, 1.00000, 1.00000, 1.00000, 0.00000, 0.00000, 1, '2023-10-01 15:59:48', '2023-10-01 15:59:48', NULL),
(12, 12, 3, 47, 1.00000, 10.49000, 10.49000, 0.00000, 0.00000, 1, '2023-10-01 16:01:25', '2023-10-01 16:01:25', NULL),
(13, 13, 3, 20, 3.00000, 65.97000, 21.99000, 0.00000, 0.00000, 1, '2023-10-02 17:59:38', '2023-10-02 17:59:38', NULL),
(14, 14, 3, 79, 2.00000, 6.00000, 3.00000, 0.00000, 0.00000, 1, '2023-10-10 04:38:41', '2023-10-10 04:38:41', NULL),
(15, 15, 3, 63, 3.00000, 9.00000, 3.00000, 0.00000, 0.00000, 1, '2023-10-10 04:43:39', '2023-10-10 04:43:39', NULL),
(16, 16, 3, 19, 2.00000, 39.38000, 19.69000, 0.00000, 0.00000, 1, '2023-10-10 10:34:11', '2023-10-10 10:34:11', NULL),
(17, 17, 3, 22, 3.00000, 41.97000, 13.99000, 0.00000, 0.00000, 1, '2023-10-12 07:18:45', '2023-10-12 07:18:45', NULL),
(18, 18, 1, 18, 1.00000, 19.00000, 19.00000, 0.00000, 0.00000, 1, '2023-10-13 00:14:08', '2023-10-13 00:14:08', NULL),
(19, 19, 3, 51, 2.00000, 15.98000, 7.99000, 0.00000, 0.00000, 1, '2023-10-15 06:26:01', '2023-10-15 06:26:01', NULL),
(20, 20, 3, 52, 1.00000, 7.99000, 7.99000, 0.00000, 0.00000, 1, '2023-10-15 06:45:19', '2023-10-15 06:45:19', NULL),
(21, 21, 3, 60, 2.00000, 9.98000, 4.99000, 0.00000, 0.00000, 1, '2023-10-15 07:01:54', '2023-10-15 07:01:54', NULL),
(22, 22, 3, 19, 1.00000, 10.69000, 10.69000, 0.00000, 0.00000, 1, '2023-10-20 06:32:16', '2023-10-20 06:32:16', NULL),
(23, 23, 3, 2, 1.00000, 4.99000, 4.99000, 0.00000, 0.00000, 1, '2023-10-20 06:44:15', '2023-10-20 06:44:15', NULL),
(24, 24, 3, 9, 1.00000, 11.99000, 11.99000, 0.00000, 0.00000, 1, '2023-10-20 11:18:48', '2023-10-20 11:18:48', NULL),
(25, 24, 3, 20, 1.00000, 19.99000, 19.99000, 0.00000, 0.00000, 1, '2023-10-20 11:18:48', '2023-10-20 11:18:48', NULL),
(26, 25, 3, 20, 1.00000, 12.99000, 12.99000, 0.00000, 0.00000, 1, '2023-10-20 12:02:07', '2023-10-20 12:02:07', NULL),
(27, 26, 3, 54, 3.00000, 22.47000, 7.49000, 0.00000, 0.00000, 1, '2023-10-20 12:15:44', '2023-10-20 12:15:44', NULL),
(28, 27, 3, 20, 1.00000, 15.99000, 15.99000, 0.00000, 0.00000, 1, '2023-11-01 08:23:10', '2023-11-01 08:23:10', NULL),
(29, 28, 3, 2, 1.00000, 4.99000, 4.99000, 0.00000, 0.00000, 1, '2023-11-01 08:32:20', '2023-11-01 08:32:20', NULL),
(30, 29, 3, 44, 1.00000, 6.99000, 6.99000, 0.00000, 0.00000, 1, '2023-11-01 08:38:43', '2023-11-01 08:38:43', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pos_password_resets`
--

DROP TABLE IF EXISTS `pos_password_resets`;
CREATE TABLE IF NOT EXISTS `pos_password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `pos_password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pos_personal_access_tokens`
--

DROP TABLE IF EXISTS `pos_personal_access_tokens`;
CREATE TABLE IF NOT EXISTS `pos_personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pos_personal_access_tokens_token_unique` (`token`),
  KEY `pos_personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pos_products`
--

DROP TABLE IF EXISTS `pos_products`;
CREATE TABLE IF NOT EXISTS `pos_products` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `storeId` int(10) UNSIGNED DEFAULT NULL,
  `categoryId` int(10) UNSIGNED DEFAULT NULL,
  `vendorId` int(10) UNSIGNED DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `price` double(10,5) DEFAULT '0.00000',
  `cost` double(10,5) DEFAULT '0.00000',
  `image` varchar(255) NOT NULL DEFAULT 'product.png',
  `sku` varchar(255) DEFAULT NULL,
  `barcode` varchar(255) DEFAULT NULL,
  `color` varchar(255) NOT NULL DEFAULT '#fff',
  `productType` enum('Product','Ingredient','Service','Games') NOT NULL DEFAULT 'Product',
  `beginnngInventory` double(10,5) DEFAULT '0.00000',
  `trackInventory` tinyint(4) NOT NULL DEFAULT '0',
  `description` text,
  `IsBasePrice` tinyint(4) DEFAULT '0',
  `deliveryFee` tinyint(4) NOT NULL DEFAULT '0',
  `soldByWeight` tinyint(4) NOT NULL DEFAULT '0',
  `deliveryTime` varchar(50) NOT NULL DEFAULT '15-20 min',
  `web` tinyint(4) NOT NULL DEFAULT '1',
  `pos` tinyint(4) NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `createdBy` int(10) UNSIGNED DEFAULT NULL,
  `updatedBy` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pos_products_storeid_foreign` (`storeId`),
  KEY `pos_products_categoryid_foreign` (`categoryId`),
  KEY `pos_products_vendorid_foreign` (`vendorId`)
) ENGINE=InnoDB AUTO_INCREMENT=115 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pos_products`
--

INSERT INTO `pos_products` (`id`, `storeId`, `categoryId`, `vendorId`, `name`, `price`, `cost`, `image`, `sku`, `barcode`, `color`, `productType`, `beginnngInventory`, `trackInventory`, `description`, `IsBasePrice`, `deliveryFee`, `soldByWeight`, `deliveryTime`, `web`, `pos`, `status`, `createdBy`, `updatedBy`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 3, 1, 1, '6 Pcs Wings', 1.00000, 1.00000, '1698461515.png', 'SS000001', 'B000001', '#FF8C00', 'Product', 100.00000, 1, 'And 1 reg chips and can drink', 1, 1, 1, '4 min', 1, 1, 1, NULL, NULL, '2023-09-10 13:03:23', '2023-10-27 23:51:55', NULL),
(2, 3, 1, 1, '2 Pc Fried Chicken or 1 Pc Chicken and 3 Wings', 4.99000, 4.99000, '1698461799.png', 'SS000002', 'B000002', '#FF8C00', 'Product', 100.00000, 1, 'And 1 reg chips and can drink', 1, 1, 1, '4 min', 1, 1, 1, NULL, NULL, '2023-09-10 07:33:23', '2023-10-27 23:56:39', NULL),
(3, 3, 1, 1, 'Chicken Burgers', 5.99000, 5.99000, '1698461640.png', 'SS000003', 'B000003', '#FF8C00', 'Product', 100.00000, 1, '1 reg chips and can drink', 1, 1, 1, '4 min', 1, 1, 1, NULL, NULL, '2023-09-10 07:33:23', '2023-10-27 23:54:00', NULL),
(4, 3, 1, 1, 'Kings Burger Meal', 6.99000, 6.99000, '1698461350.png', 'S000005', 'B000005', '#FF8C00', 'Product', 100.00000, 1, 'Chicken fillet with mozzarella sticks and 1 reg chips and can drink', 1, 1, 1, '4 min', 1, 1, 1, NULL, NULL, '2023-09-10 07:33:23', '2023-10-27 23:49:10', NULL),
(5, 3, 1, 1, 'Ultimate Mix Burger', 6.99000, 6.99000, '1698462582.png', 'S000006', 'B000006', '#FF8C00', 'Product', 100.00000, 1, 'Chicken fillet with beef burger and 1 reg chips and can drink', 1, 1, 1, '4 min', 1, 1, 1, NULL, NULL, '2023-09-10 07:33:23', '2023-10-28 00:09:42', NULL),
(6, 3, 1, 1, 'Triple Ringer Burger', 6.99000, 6.99000, '1698463370.png', 'S000007', 'B000007', '#FF8C00', 'Product', 100.00000, 1, 'Chicken fillet with beef burger and 1 reg chips and can drink', 1, 1, 1, '4 min', 1, 1, 1, NULL, NULL, '2023-09-10 07:33:23', '2023-10-28 00:22:50', NULL),
(7, 3, 1, 1, 'Super Box Meal', 6.99000, 6.99000, '1697999632.png', 'S000001', 'B000008', '#FF8C00', 'Product', 100.00000, 1, 'Chicken fillet with beef burger and 1 reg chips and can drink', 0, 1, 1, '4 min', 1, 1, 1, NULL, NULL, '2023-09-10 07:33:23', '2023-10-22 15:33:52', NULL),
(8, 3, 1, 1, 'Sole Peri Peri Box', 15.99000, 15.99000, '1697999371.png', 'S000009', 'B000009', '#FF8C00', 'Product', 100.00000, 1, 'Full peri peri chicken, 4 grill wings, reg chips, salad and can drink', 0, 1, 1, '4 min', 1, 1, 1, NULL, NULL, '2023-09-10 07:33:23', '2023-10-22 15:29:31', NULL),
(9, 3, 1, 1, 'Grill Chicken', 3.49000, 3.49000, '1698464168.png', 'S000010', 'B000010', '#FF8C00', 'Product', 100.00000, 1, NULL, 0, 1, 1, '4 min', 1, 1, 1, NULL, NULL, '2023-09-10 07:33:23', '2023-10-28 00:36:08', NULL),
(10, 3, 1, 1, 'Enclose Box', 21.99000, 21.99000, '1697953149.png', 'S000011', 'B000011', '#FF8C00', 'Product', 100.00000, 1, 'Reg chicken doner, reg lamb doner, 2 lamb chop, 2 chicken shish, 2 reg chips, salad and 2 can drink', 0, 1, 1, '4 min', 1, 1, 1, NULL, NULL, '2023-09-10 07:33:23', '2023-10-22 02:39:09', NULL),
(11, 3, 1, 1, 'Grill Family Box', 29.99000, 29.99000, '1697958474.png', 'S000012', 'B000012', '#FF8C00', 'Product', 100.00000, 1, '2 full grill chicken, 8 grill wings, 8 garlic bread, 2 reg chips, salad and 1.5L drink', 0, 1, 1, '4 min', 1, 1, 1, NULL, NULL, '2023-09-10 07:33:23', '2023-10-22 04:07:54', NULL),
(12, 3, 1, 1, 'Family Fried Platter', 24.99000, 24.99000, '1697955109.png', 'S000013', 'B000013', '#FF8C00', 'Product', 100.00000, 1, '12 pcs chicken, 16 hot wings, 4 reg fries, 1.5L Pepsi', 0, 1, 1, '4 min', 1, 1, 1, NULL, NULL, '2023-09-10 07:33:23', '2023-10-22 03:11:49', NULL),
(13, 3, 1, 1, 'Mini Fried Platter', 12.50000, 12.50000, '1697998451.png', 'S000014', 'B000014', '#FF8C00', 'Product', 100.00000, 1, '6 pcs chicken, 6 hot wings, 2 reg fries, 2 can pepsi', 0, 1, 1, '4 min', 1, 1, 1, NULL, NULL, '2023-09-10 07:33:23', '2023-10-22 15:14:11', NULL),
(14, 3, 1, 1, 'Burger Bucket', 24.99000, 24.99000, '1697952414.png', 'S000015', 'B000015', '#FF8C00', 'Product', 100.00000, 1, '2 chicken fillet burger, 2 chicken steak burger, 2 beef burgers, 2 pcs chicken, 2 fries, 6 wings and 1.5L Pepsi', 0, 1, 1, '4 min', 1, 1, 1, NULL, NULL, '2023-09-10 07:33:23', '2023-10-22 02:26:55', NULL),
(15, 3, 1, 1, 'Chicken or Lamb Biryani', 7.50000, 7.50000, '1697952226.png', 'S000016', 'B000016', '#FF8C00', 'Product', 100.00000, 1, 'And salad and can drink', 0, 1, 1, '4 min', 1, 1, 1, NULL, NULL, '2023-09-10 07:33:23', '2023-10-22 02:23:46', NULL),
(16, 3, 1, 1, 'Lamb or Chicken Doner Meal', 7.50000, 7.50000, '1697997982.png', 'S000017', 'B000017', '#FF8C00', 'Product', 100.00000, 1, 'And salad, chips and can drink', 0, 1, 1, '4 min', 1, 1, 1, NULL, NULL, '2023-09-10 07:33:23', '2023-10-22 15:06:22', NULL),
(17, 3, 1, 1, 'Pounder Burger Meal', 5.49000, 5.49000, '1698465011.png', 'S000018', 'B000018', '#FF8C00', 'Product', 100.00000, 1, 'And 2 fried wings and 1 reg chips and can drink', 0, 1, 1, '4 min', 1, 1, 1, NULL, NULL, '2023-09-10 07:33:23', '2023-10-28 00:50:11', NULL),
(18, 3, 1, 1, 'Peri Peri Box', 17.99000, 17.99000, '1697999163.png', 'S000019', 'B000019', '#FF8C00', 'Product', 100.00000, 1, 'Full peri peri chicken, 8 grill wings, 1 reg chips, salad and 1.5L drink', 0, 1, 1, '4 min', 1, 1, 1, NULL, NULL, '2023-09-10 07:33:23', '2023-10-22 15:26:03', NULL),
(19, 3, 2, 1, 'Margherita Pizza', 9.99000, 9.99000, '1695969760.png', 'S00002026', 'B00002026', '#FF8C00', 'Product', 100.00000, 1, 'Cheese and tomato', 0, 1, 1, '4 min', 1, 1, 1, NULL, NULL, '2023-09-10 07:33:23', '2023-09-29 03:42:40', NULL),
(20, 3, 2, 1, 'Hawaiian Pizza', 9.99000, 9.99000, '1695909516.png', 'S000021', 'B000021', '#FF8C00', 'Product', 100.00000, 1, 'Turkey ham and pineapple', 0, 1, 1, '4 min', 1, 1, 1, NULL, NULL, '2023-09-10 07:33:23', '2023-09-28 10:58:36', NULL),
(21, 3, 2, 1, 'Cheeky Chicken Pizza', 9.99000, 9.99000, '1695909497.png', 'S000022', 'B000022', '#FF8C00', 'Product', 100.00000, 1, 'Chicken, turkey ham and mushroom', 0, 1, 1, '4 min', 1, 1, 1, NULL, NULL, '2023-09-10 07:33:23', '2023-09-28 10:58:17', NULL),
(22, 3, 2, 1, 'Vegetarian Pizza', 9.99000, 9.99000, '1695909554.png', 'S000023', 'B000023', '#FF8C00', 'Product', 100.00000, 1, 'Onion, green pepper, sweet corn and mushroom', 0, 1, 1, '4 min', 1, 1, 1, NULL, NULL, '2023-09-10 07:33:23', '2023-09-28 10:59:14', NULL),
(23, 3, 2, 1, 'Vegetarian Deluxe Pizza', 9.99000, 9.99000, '1696509788.png', 'S000024101', 'B000024101', '#FF8C00', 'Product', 100.00000, 1, 'Onion, mushroom, mixed pepper and tomato', 0, 1, 1, '4 min', 1, 1, 1, NULL, NULL, '2023-09-10 07:33:23', '2023-10-05 09:43:08', NULL),
(24, 3, 2, 1, 'Vegetarian Hot Pizza', 9.99000, 9.99000, '1696509986.png', 'S000025', 'B000025', '#FF8C00', 'Product', 100.00000, 1, 'Onion, mushrooms, jalapenos, hot chillies and mix peppers', 0, 1, 1, '4 min', 1, 1, 1, NULL, NULL, '2023-09-10 07:33:23', '2023-10-05 09:46:26', NULL),
(25, 3, 2, 1, 'Nice and Spicy Pizza', 9.99000, 9.99000, '1696510117.png', 'S000026', 'B000026', '#FF8C00', 'Product', 100.00000, 1, 'Onion, mixed pepper, pepperoni, spicy beef, jalapenos and onion', 0, 1, 1, '4 min', 1, 1, 1, NULL, NULL, '2023-09-10 07:33:23', '2023-10-05 09:48:37', NULL),
(26, 3, 2, 1, 'Beefeater Pizza', 9.99000, 9.99000, '1696510206.png', 'S000027', 'B000027', '#FF8C00', 'Product', 100.00000, 1, 'Beef lamb doner and turkey ham', 0, 1, 1, '4 min', 1, 1, 1, NULL, NULL, '2023-09-10 07:33:23', '2023-10-05 09:50:06', NULL),
(27, 3, 2, 1, 'Spicy Chicken Mix Pizza', 9.99000, 9.99000, '1696510316.png', 'S000028', 'B000028', '#FF8C00', 'Product', 100.00000, 1, 'Tandoori chicken, spicy chicken, mixed pepper, jalapenos and onions', 0, 1, 1, '4 min', 1, 1, 1, NULL, NULL, '2023-09-10 07:33:23', '2023-10-05 09:51:56', NULL),
(28, 3, 2, 1, 'Mexican Hot and Spicy Pizza', 9.99000, 9.99000, '1696510427.png', 'S000029', 'B000029', '#FF8C00', 'Product', 100.00000, 1, 'Pepperoni, beef, onions, chicken, mixed peppers and jalapenos', 0, 1, 1, '4 min', 1, 1, 1, NULL, NULL, '2023-09-10 07:33:23', '2023-10-05 09:53:47', NULL),
(29, 3, 2, 1, 'Asian Hot Pizza', 9.99000, 9.99000, '1696510563.png', 'S000030', 'B000030', '#FF8C00', 'Product', 100.00000, 1, 'Onion, mixed peppers, green chilli, spicy chicken jalapenos and fresh garlic', 0, 1, 1, '4 min', 1, 1, 1, NULL, NULL, '2023-09-10 07:33:23', '2023-10-05 09:56:03', NULL),
(30, 3, 2, 1, 'Meat Feast Pizza', 9.99000, 9.99000, '1696510694.png', 'S000031', 'B000031', '#FF8C00', 'Product', 100.00000, 1, 'Pepperoni, turkey ham, meatballs and spicy beef', 0, 1, 1, '4 min', 1, 1, 1, NULL, NULL, '2023-09-10 07:33:23', '2023-10-05 09:58:14', NULL),
(31, 3, 2, 1, 'New Yorker Pizza', 9.99000, 9.99000, '1696510812.png', 'S000032', 'B000032', '#FF8C00', 'Product', 100.00000, 1, 'Pepperoni, ham, sweet corn, mushrooms and chicken', 0, 1, 1, '4 min', 1, 1, 1, NULL, NULL, '2023-09-10 07:33:23', '2023-10-05 10:00:12', NULL),
(32, 3, 2, 1, 'Pepperoni Plus Pizza', 9.99000, 9.99000, '1696510917.png', 'S000033', 'B000033', '#FF8C00', 'Product', 100.00000, 1, 'Double pepperoni and double cheese', 0, 1, 1, '4 min', 1, 1, 1, NULL, NULL, '2023-09-10 07:33:23', '2023-10-05 10:01:57', NULL),
(33, 3, 2, 1, 'Romeos Super Supreme Pizza', 9.99000, 9.99000, '1696511001.png', 'S000034', 'B000034', '#FF8C00', 'Product', 100.00000, 1, NULL, 0, 1, 1, '4 min', 1, 1, 1, NULL, NULL, '2023-09-10 07:33:23', '2023-10-05 10:03:21', NULL),
(34, 3, 2, 1, 'Chicken Madness Pizza', 9.99000, 9.99000, '1696511240.png', 'S000035', 'B000035', '#FF8C00', 'Product', 100.00000, 1, 'Tandoori chicken, Mexican chicken, cheese chicken and plain chicken', 0, 1, 1, '4 min', 1, 1, 1, NULL, NULL, '2023-09-10 07:33:23', '2023-10-05 10:07:20', NULL),
(35, 3, 2, 1, 'BBQ Chicken Pizza', 9.99000, 9.99000, '1696511348.png', 'S000036', 'B000036', '#FF8C00', 'Product', 100.00000, 1, 'BBQ Sauce, onion, BBQ chicken, mushrooms and green peppers', 0, 1, 1, '4 min', 1, 1, 1, NULL, NULL, '2023-09-10 07:33:23', '2023-10-05 10:09:08', NULL),
(36, 3, 2, 1, 'Chinese Chicken Pizza', 9.99000, 9.99000, '1696511533.png', 'S000037', 'B000037', '#FF8C00', 'Product', 100.00000, 1, 'Chinese chicken, mixed peppers, mushrooms, sweet corn and onions', 0, 1, 1, '4 min', 1, 1, 1, NULL, NULL, '2023-09-10 07:33:23', '2023-10-05 10:12:13', NULL),
(37, 3, 2, 1, 'Four Seasons Pizza', 9.99000, 9.99000, '1696511635.png', 'S000038', 'B000038', '#FF8C00', 'Product', 100.00000, 1, 'Mushrooms, turkey ham, anchovies, mixed peppers and tomatoes', 0, 1, 1, '4 min', 1, 1, 1, NULL, NULL, '2023-09-10 07:33:23', '2023-10-05 10:13:55', NULL),
(38, 3, 2, 1, 'Tandoori Deluxe Pizza', 9.99000, 9.99000, '1696511762.png', 'S000039', 'B000039', '#FF8C00', 'Product', 100.00000, 1, 'Chicken, mixed peppers, onions, sweet corns and tomatoes', 0, 1, 1, '4 min', 1, 1, 1, NULL, NULL, '2023-09-10 07:33:23', '2023-10-05 10:16:02', NULL),
(39, 3, 2, 1, 'Seafood Pizza', 9.99000, 9.99000, '1696511857.jpg', 'S000040', 'B000040', '#FF8C00', 'Product', 100.00000, 1, 'Anchovies, tuna, prawns, olives and tomato', 0, 1, 1, '4 min', 1, 1, 1, NULL, NULL, '2023-09-10 07:33:23', '2023-10-05 10:17:37', NULL),
(40, 3, 2, 1, 'Lamb Doner Pizza', 9.99000, 9.99000, '1696512025.png', 'S000041', 'B000041', '#FF8C00', 'Product', 100.00000, 1, 'Lamb doner, onion, mixed pepper and tomato', 0, 1, 1, '4 min', 1, 1, 1, NULL, NULL, '2023-09-10 07:33:23', '2023-10-05 10:20:25', NULL),
(41, 3, 3, 1, 'Lamb Doner', 5.99000, 5.99000, '1695727924.png', 'S000042', 'B000042', '#FF8C00', 'Product', 100.00000, 1, NULL, 0, 1, 1, '4 min', 1, 1, 1, NULL, NULL, '2023-09-10 07:33:23', '2023-09-26 08:32:04', NULL),
(42, 3, 3, 1, 'Chicken Doner', 6.49000, 6.49000, '1695848710.jpg', 'S00004327', 'B00004327', '#FF8C00', 'Product', 100.00000, 1, NULL, 0, 1, 1, '4 min', 1, 1, 1, NULL, NULL, '2023-09-10 07:33:23', '2023-09-27 18:05:10', NULL),
(43, 3, 3, 1, 'Mix Doner', 6.99000, 6.99000, '1695909882.png', 'S000044', 'B000044', '#FF8C00', 'Product', 100.00000, 1, NULL, 0, 1, 1, '4 min', 1, 1, 1, NULL, NULL, '2023-09-10 07:33:23', '2023-09-28 11:04:42', NULL),
(44, 3, 3, 1, 'Lamb or Chicken Shish (4pcs)', 6.99000, 6.99000, '1695897581.png', 'S000045', 'B000045', '#FF8C00', 'Product', 100.00000, 1, NULL, 0, 1, 1, '4 min', 1, 1, 1, NULL, NULL, '2023-09-10 07:33:23', '2023-09-28 07:39:41', NULL),
(45, 3, 4, 1, 'Lamb Doner and 2Pcs Lamb Chop', 11.99000, 11.99000, '1696309347.png', 'S000046', 'B000046', '#FF8C00', 'Product', 100.00000, 1, NULL, 0, 1, 1, '4 min', 1, 1, 1, NULL, NULL, '2023-09-10 07:33:23', '2023-10-03 02:02:27', NULL),
(46, 3, 4, 1, 'Chicken Doner and 2Pcs Lamb Chop', 11.99000, 11.99000, '1696307983.jpg', 'S000047', 'B000047', '#FF8C00', 'Product', 100.00000, 1, NULL, 0, 1, 1, '4 min', 1, 1, 1, NULL, NULL, '2023-09-10 07:33:23', '2023-10-03 01:39:43', NULL),
(47, 3, 4, 1, 'Lamb Doner and Lamb Shish (2Pcs)', 10.49000, 10.49000, '1696309595.png', 'S000048', 'B000048', '#FF8C00', 'Product', 100.00000, 1, NULL, 0, 1, 1, '4 min', 1, 1, 1, NULL, NULL, '2023-09-10 07:33:23', '2023-10-03 02:06:35', NULL),
(48, 3, 4, 1, 'Chicken Doner and Chicken Shish (2Pcs)', 10.49000, 10.49000, '1695910078.png', 'S000049', 'B000049', '#FF8C00', 'Product', 100.00000, 1, NULL, 0, 1, 1, '4 min', 1, 1, 1, NULL, NULL, '2023-09-10 07:33:23', '2023-09-28 11:07:58', NULL),
(49, 3, 5, 1, 'Lamb Doner and Rice', 9.99000, 9.99000, '1696310069.png', 'SSS0000501', 'BBBB0000501', '#FF8C00', 'Product', 100.00000, 1, NULL, 0, 1, 1, '4 min', 1, 1, 1, NULL, NULL, '2023-09-10 07:33:23', '2023-10-03 02:14:29', NULL),
(50, 3, 5, 1, 'Chicken Doner and Rice', 9.99000, 9.99000, '1695910664.png', 'S000051', 'B000051', '#FF8C00', 'Product', 100.00000, 1, NULL, 0, 1, 1, '4 min', 1, 1, 1, NULL, NULL, '2023-09-10 07:33:23', '2023-09-28 11:17:44', NULL),
(51, 3, 5, 1, 'Lamb Shish (2Pcs) and Rice', 7.99000, 7.99000, '1695910720.png', 'S000052', 'B000052', '#FF8C00', 'Product', 100.00000, 1, NULL, 0, 1, 1, '4 min', 1, 1, 1, NULL, NULL, '2023-09-10 07:33:23', '2023-09-28 11:18:40', NULL),
(52, 3, 5, 1, 'Chicken Shish (2Pcs) and Rice', 7.99000, 7.99000, '1696310245.png', 'S000053', 'B000053', '#FF8C00', 'Product', 100.00000, 1, NULL, 0, 1, 1, '4 min', 1, 1, 1, NULL, NULL, '2023-09-10 07:33:23', '2023-10-03 02:17:25', NULL),
(53, 3, 6, 1, 'Chicken or Lamb Kebab Wrap', 4.99000, 4.99000, '1695899378.jpg', 'S00005009', 'B00005009', '#FF8C00', 'Product', 100.00000, 1, NULL, 0, 1, 1, '4 min', 1, 1, 1, NULL, NULL, '2023-09-10 07:33:23', '2023-09-28 08:09:38', NULL),
(54, 3, 6, 1, 'Mixed Doner Wrap', 5.99000, 5.99000, '1695465225.jpg', 'SS000051', 'BB000051', '#FF8C00', 'Product', 100.00000, 1, NULL, 0, 1, 1, '4 min', 1, 1, 1, NULL, NULL, '2023-09-10 07:33:23', '2023-09-23 07:33:45', NULL),
(55, 3, 6, 1, 'Chicken Strips Wrap', 4.99000, 4.99000, '1695899543.jpg', 'S0000528', 'B0000528', '#FF8C00', 'Product', 100.00000, 1, NULL, 0, 1, 1, '4 min', 1, 1, 1, NULL, NULL, '2023-09-10 07:33:23', '2023-09-28 08:12:23', NULL),
(56, 3, 6, 1, 'Chicken Grill Wrap', 5.99000, 5.99000, '1695465191.jpg', 'SS000053', 'BB000053', '#FF8C00', 'Product', 100.00000, 1, NULL, 0, 1, 1, '4 min', 1, 1, 1, NULL, NULL, '2023-09-10 07:33:23', '2023-09-23 07:33:11', NULL),
(57, 3, 7, 1, 'Veggi Wrap', 4.99000, 4.99000, '1695898930.png', 'S0000501234', 'B0000501234', '#FF8C00', 'Product', 100.00000, 1, NULL, 0, 1, 1, '4 min', 1, 1, 1, NULL, NULL, '2023-09-10 07:33:23', '2023-09-28 08:02:10', NULL),
(58, 3, 7, 1, 'Falafel Wrap', 5.99000, 5.99000, '1695911171.png', 'S00005011111', 'B00005011111', '#FF8C00', 'Product', 100.00000, 1, NULL, 0, 1, 1, '4 min', 1, 1, 1, NULL, NULL, '2023-09-10 07:33:23', '2023-09-28 11:26:11', NULL),
(59, 3, 7, 1, 'Veggi or Bean Burger', 4.99000, 4.99000, '1695911189.jpg', 'SSS000050', 'BBB000050', '#FF8C00', 'Product', 100.00000, 1, NULL, 0, 1, 1, '4 min', 1, 1, 1, NULL, NULL, '2023-09-10 07:33:23', '2023-09-28 11:26:29', NULL),
(60, 3, 7, 1, 'Veggi Nuggets (8pcs)', 4.99000, 4.99000, '1695911211.png', 'S0000500', 'B0000500', '#FF8C00', 'Product', 100.00000, 1, NULL, 0, 1, 1, '4 min', 1, 1, 1, NULL, NULL, '2023-09-10 07:33:23', '2023-09-28 11:26:51', NULL),
(61, 3, 7, 1, 'Falafel Burger', 4.99000, 4.99000, '1696431905.png', 'S00005094', 'B00005094', '#FF8C00', 'Product', 100.00000, 1, NULL, 0, 1, 1, '4 min', 1, 1, 1, NULL, NULL, '2023-09-10 07:33:23', '2023-10-04 12:05:05', NULL),
(62, 3, 8, 1, 'Greek Salad', 3.50000, 3.50000, '1695911789.png', 'S00005023', 'B00005023', '#FF8C00', 'Product', 100.00000, 1, NULL, 0, 1, 1, '4 min', 1, 1, 1, NULL, NULL, '2023-09-10 07:33:23', '2023-09-28 11:36:29', NULL),
(63, 3, 8, 1, 'Caesar Salad', 3.00000, 3.00000, '1695911834.png', 'S00005020', 'B00005020', '#FF8C00', 'Product', 100.00000, 1, NULL, 0, 1, 1, '4 min', 1, 1, 1, NULL, NULL, '2023-09-10 07:33:23', '2023-09-28 11:37:14', NULL),
(64, 3, 8, 1, 'Sheraz Salad', 3.00000, 3.00000, '1695911769.png', 'S00005024', 'B00005024', '#FF8C00', 'Product', 100.00000, 1, NULL, 0, 1, 1, '4 min', 1, 1, 1, NULL, NULL, '2023-09-10 07:33:23', '2023-09-28 11:36:09', NULL),
(65, 3, 8, 1, 'Coleslow', 1.99000, 1.99000, '1695911811.png', 'S00005021', 'B00005021', '#FF8C00', 'Product', 100.00000, 1, NULL, 0, 1, 1, '4 min', 1, 1, 1, NULL, NULL, '2023-09-10 07:33:23', '2023-09-28 11:36:51', NULL),
(66, 3, 9, 1, '6Pcs Fried Wings', 3.00000, 3.00000, '1698488565.png', 'SS000050', 'BB000050', '#FF8C00', 'Product', 100.00000, 1, NULL, 0, 1, 1, '4 min', 1, 1, 1, NULL, NULL, '2023-09-10 07:33:23', '2023-10-28 07:22:45', NULL),
(67, 3, 9, 1, '6Pcs BBQ Wings', 4.00000, 4.00000, '1695467725.jpg', 'SA000050', 'BA000050', '#FF8C00', 'Product', 100.00000, 1, NULL, 0, 1, 1, '4 min', 1, 1, 1, NULL, NULL, '2023-09-10 07:33:23', '2023-09-23 08:15:25', NULL),
(68, 3, 9, 1, '6 Grill Wings', 4.50000, 4.50000, '1695465368.jpg', 'SSSS000050', 'BBBB000050', '#FF8C00', 'Product', 100.00000, 1, NULL, 0, 1, 1, '4 min', 1, 1, 1, NULL, NULL, '2023-09-10 07:33:23', '2023-09-23 07:36:08', NULL),
(69, 3, 9, 1, '1Pc Fried Chicken', 4.50000, 4.50000, '1695897341.png', 'S000050122', 'B000050122', '#FF8C00', 'Product', 100.00000, 1, NULL, 0, 1, 1, '4 min', 1, 1, 1, NULL, NULL, '2023-09-10 07:33:23', '2023-09-28 07:35:41', NULL),
(70, 3, 9, 1, '6Pcs Chicken Strips', 4.50000, 4.50000, '1695465435.jpg', 'SSSSS000050', 'BBBBB000050', '#FF8C00', 'Product', 100.00000, 1, NULL, 0, 1, 1, '4 min', 1, 1, 1, NULL, NULL, '2023-09-10 07:33:23', '2023-09-23 07:37:15', NULL),
(71, 3, 9, 1, '6Pcs Nuggets', 3.50000, 3.50000, '1696427702.jpg', 'S00005074', 'B00005074', '#FF8C00', 'Product', 100.00000, 1, NULL, 0, 1, 1, '4 min', 1, 1, 1, NULL, NULL, '2023-09-10 07:33:23', '2023-10-04 10:55:02', NULL),
(72, 3, 9, 1, '6Pcs Cheese Nuggets', 3.50000, 3.50000, '1696427907.png', 'S00005075', 'B00005075', '#FF8C00', 'Product', 100.00000, 1, NULL, 0, 1, 1, '4 min', 1, 1, 1, NULL, NULL, '2023-09-10 07:33:23', '2023-10-04 10:58:27', NULL),
(73, 3, 9, 1, '6Pcs Mozzarella Sticks', 4.00000, 4.00000, '1696428202.jpg', 'S00005077', 'B00005077', '#FF8C00', 'Product', 100.00000, 1, NULL, 0, 1, 1, '4 min', 1, 1, 1, NULL, NULL, '2023-09-10 07:33:23', '2023-10-04 11:03:22', NULL),
(74, 3, 9, 1, '6Pcs Scampi', 3.50000, 3.50000, '1696428468.jpg', 'S00005078', 'B00005078', '#FF8C00', 'Product', 100.00000, 1, NULL, 0, 1, 1, '4 min', 1, 1, 1, NULL, NULL, '2023-09-10 07:33:23', '2023-10-04 11:07:48', NULL),
(75, 3, 9, 1, '6Pcs Fish Fingers', 3.50000, 3.50000, '1696429389.png', 'S00005080', 'B00005080', '#FF8C00', 'Product', 100.00000, 1, NULL, 0, 1, 1, '4 min', 1, 1, 1, NULL, NULL, '2023-09-10 07:33:23', '2023-10-04 11:23:09', NULL),
(76, 3, 9, 1, '6Pcs Squid Chunk', 3.50000, 3.50000, '1696428863.jpg', 'S00005079', 'B00005079', '#FF8C00', 'Product', 100.00000, 1, NULL, 0, 1, 1, '4 min', 1, 1, 1, NULL, NULL, '2023-09-10 07:33:23', '2023-10-04 11:14:23', NULL),
(77, 3, 9, 1, '10Pcs Onion Ring', 3.00000, 3.00000, '1696429526.png', 'S00005081', 'B00005081', '#FF8C00', 'Product', 100.00000, 1, NULL, 0, 1, 1, '4 min', 1, 1, 1, NULL, NULL, '2023-09-10 07:33:23', '2023-10-04 11:25:26', NULL),
(78, 3, 9, 1, '6pcs Falafel', 4.99000, 4.99000, '1696429664.png', 'S00005082', 'B00005082', '#FF8C00', 'Product', 100.00000, 1, NULL, 0, 1, 1, '4 min', 1, 1, 1, NULL, NULL, '2023-09-10 07:33:23', '2023-10-04 11:27:44', NULL),
(79, 3, 9, 1, 'Large Chips', 3.00000, 3.00000, '1696429800.jpg', 'S00005083', 'B00005083', '#FF8C00', 'Product', 100.00000, 1, NULL, 0, 1, 1, '4 min', 1, 1, 1, NULL, NULL, '2023-09-10 07:33:23', '2023-10-04 11:30:00', NULL),
(80, 3, 9, 1, 'Large Potato Wedges', 3.50000, 3.50000, '1696430222.png', 'S00005084', 'B00005084', '#FF8C00', 'Product', 100.00000, 1, NULL, 0, 1, 1, '4 min', 1, 1, 1, NULL, NULL, '2023-09-10 07:33:23', '2023-10-04 11:37:02', NULL),
(81, 3, 9, 1, 'Cheesy Chips', 3.00000, 3.00000, '1696430416.jpg', 'S00005086', 'B00005086', '#FF8C00', 'Product', 100.00000, 1, NULL, 0, 1, 1, '4 min', 1, 1, 1, NULL, NULL, '2023-09-10 07:33:23', '2023-10-04 11:40:16', NULL),
(82, 3, 9, 1, 'Large Sweet Potato Chips', 3.50000, 3.50000, '1696430598.jpg', 'S00005087', 'B00005087', '#FF8C00', 'Product', 100.00000, 1, NULL, 0, 1, 1, '4 min', 1, 1, 1, NULL, NULL, '2023-09-10 07:33:23', '2023-10-04 11:43:18', NULL),
(83, 3, 9, 1, '4pcs Garlic Bread', 3.50000, 3.50000, '1696430735.jpg', 'S00005088', 'B00005088', '#FF8C00', 'Product', 100.00000, 1, NULL, 0, 1, 1, '4 min', 1, 1, 1, NULL, NULL, '2023-09-10 07:33:23', '2023-10-04 11:45:35', NULL),
(84, 3, 9, 1, '4pcs Garlic Bread with Cheese', 4.00000, 4.00000, '1696430856.jpg', 'S00005089', 'B00005089', '#FF8C00', 'Product', 100.00000, 1, NULL, 0, 1, 1, '4 min', 1, 1, 1, NULL, NULL, '2023-09-10 07:33:23', '2023-10-04 11:47:36', NULL),
(85, 3, 9, 1, '6pcs Garlic Mushroom', 2.00000, 2.00000, '1696431045.png', 'S00005091', 'B00005091', '#FF8C00', 'Product', 100.00000, 1, NULL, 0, 1, 1, '4 min', 1, 1, 1, NULL, NULL, '2023-09-10 07:33:23', '2023-10-04 11:50:45', NULL),
(86, 3, 9, 1, 'Cream Cheese Jalapeno', 3.50000, 3.50000, '1696431694.jpg', 'S00005092', 'B00005092', '#FF8C00', 'Product', 100.00000, 1, NULL, 0, 1, 1, '4 min', 1, 1, 1, NULL, NULL, '2023-09-10 07:33:23', '2023-10-04 12:01:34', NULL),
(87, 3, 9, 1, 'Extra Sauce Dip', 0.35000, 0.35000, '1696431672.png', 'S00005093', 'B00005093', '#FF8C00', 'Product', 100.00000, 1, NULL, 0, 1, 1, '4 min', 1, 1, 1, NULL, NULL, '2023-09-10 07:33:23', '2023-10-04 12:01:12', NULL),
(88, 3, 10, 1, 'Chicken Burger', 4.00000, 4.00000, '1695912346.jpg', 'S000050112', 'B000050112', '#FF8C00', 'Product', 100.00000, 1, NULL, 0, 1, 1, '4 min', 1, 1, 1, NULL, NULL, '2023-09-10 07:33:23', '2023-09-28 11:45:46', NULL),
(89, 3, 10, 1, 'Double Cheese Burger', 4.00000, 4.00000, '1695912319.jpg', 'S0000507', 'B0000507', '#FF8C00', 'Product', 100.00000, 1, NULL, 0, 1, 1, '4 min', 1, 1, 1, NULL, NULL, '2023-09-10 07:33:23', '2023-09-28 11:45:19', NULL),
(90, 3, 10, 1, 'Romeos Mix Burger', 5.49000, 5.49000, '1696426723.png', 'S00005067', 'B00005067', '#FF8C00', 'Product', 100.00000, 1, NULL, 0, 1, 1, '4 min', 1, 1, 1, NULL, NULL, '2023-09-10 07:33:23', '2023-10-04 10:38:43', NULL),
(91, 3, 10, 1, 'Quarter Pounder Burger', 4.00000, 4.00000, '1695912296.jpg', 'S00005076', 'B00005076', '#FF8C00', 'Product', 100.00000, 1, NULL, 0, 1, 1, '4 min', 1, 1, 1, NULL, NULL, '2023-09-10 07:33:23', '2023-09-28 11:44:56', NULL),
(92, 3, 10, 1, 'Half Pounder Burger', 5.49000, 5.49000, '1696426892.png', 'S00005068', 'B00005068', '#FF8C00', 'Product', 100.00000, 1, NULL, 0, 1, 1, '4 min', 1, 1, 1, NULL, NULL, '2023-09-10 07:33:23', '2023-10-04 10:41:32', NULL),
(93, 3, 10, 1, 'Grill Burger', 4.49000, 4.49000, '1696427261.png', 'S00005071', 'B00005071', '#FF8C00', 'Product', 100.00000, 1, NULL, 0, 1, 1, '4 min', 1, 1, 1, NULL, NULL, '2023-09-10 07:33:23', '2023-10-04 10:47:41', NULL),
(94, 3, 10, 1, 'Gourment Burger', 6.00000, 6.00000, '1696427389.png', 'S00005072', 'B00005072', '#FF8C00', 'Product', 100.00000, 1, NULL, 0, 1, 1, '4 min', 1, 1, 1, NULL, NULL, '2023-09-10 07:33:23', '2023-10-04 10:49:49', NULL),
(95, 3, 10, 1, 'Fish Burger', 4.00000, 4.00000, '1696427484.jpg', 'S00005073', 'B00005073', '#FF8C00', 'Product', 100.00000, 1, NULL, 0, 1, 1, '4 min', 1, 1, 1, NULL, NULL, '2023-09-10 07:33:23', '2023-10-04 10:51:24', NULL),
(96, 3, 11, 1, 'Chocolate Fudge Cake', 3.00000, 3.00000, '1695845026.jpg', 'S00005016', 'B00005017', '#FF8C00', 'Product', 100.00000, 1, NULL, 0, 1, 1, '4 min', 1, 1, 1, NULL, NULL, '2023-09-10 07:33:23', '2023-09-27 17:03:46', NULL),
(97, 3, 11, 1, 'Strawberry Cheese Cake', 3.00000, 3.00000, '1695845110.jpg', 'S00005018', 'B00005018', '#FF8C00', 'Product', 100.00000, 1, NULL, 0, 1, 1, '4 min', 1, 1, 1, NULL, NULL, '2023-09-10 07:33:23', '2023-09-27 17:05:10', NULL),
(98, 3, 11, 1, 'Tennessee Toffee Pie', 3.00000, 3.00000, '1695845146.jpg', 'S00005019', 'B00005019', '#FF8C00', 'Product', 100.00000, 1, NULL, 0, 1, 1, '4 min', 1, 1, 1, NULL, NULL, '2023-09-10 07:33:23', '2023-09-27 17:05:46', NULL),
(99, 3, 11, 1, 'Haagen Dazs Chocolate 480ml', 6.50000, 6.50000, '1695845081.jpg', 'S00005017', 'B000050177', '#FF8C00', 'Product', 100.00000, 1, NULL, 0, 1, 1, '4 min', 1, 1, 1, NULL, NULL, '2023-09-10 07:33:23', '2023-09-27 17:04:41', NULL),
(100, 3, 11, 1, 'Ben and Jerrys Cookie Dough 480m', 6.50000, 6.50000, '1696426224.png', 'S00005066', 'B00005066', '#FF8C00', 'Product', 100.00000, 1, NULL, 0, 1, 1, '4 min', 1, 1, 1, NULL, NULL, '2023-09-10 07:33:23', '2023-10-04 10:30:24', NULL),
(101, 3, 12, 1, 'Coke 330ml', 1.50000, 1.50000, '1695844264.jpg', 'S00005013', 'B00005013', '#FF8C00', 'Product', 100.00000, 1, NULL, 0, 1, 1, '4 min', 1, 1, 1, NULL, NULL, '2023-09-10 07:33:23', '2023-09-27 16:51:04', NULL),
(102, 3, 12, 1, '7up 330ml', 1.50000, 1.50000, '1695844228.jpg', 'S00005011', 'B00005011', '#FF8C00', 'Product', 100.00000, 1, NULL, 0, 1, 1, '4 min', 1, 1, 1, NULL, NULL, '2023-09-10 07:33:23', '2023-09-27 16:50:28', NULL),
(103, 3, 12, 1, 'Pepsi 330ml 1.50 Diet Coke 330ml', 1.50000, 1.50000, '1696190318.jpg', 'S00005015', 'B00005015', '#FF8C00', 'Product', 100.00000, 1, NULL, 0, 1, 1, '4 min', 1, 1, 1, NULL, NULL, '2023-09-10 07:33:23', '2023-10-01 16:58:38', NULL),
(104, 3, 12, 1, 'Fanta Orange 330ml', 1.50000, 1.50000, '1695844299.jpg', 'S00005014', 'B00005014', '#FF8C00', 'Product', 100.00000, 1, NULL, 0, 1, 1, '4 min', 1, 1, 1, NULL, NULL, '2023-09-10 07:33:23', '2023-09-27 16:51:39', NULL),
(105, 3, 12, 1, 'Mirinda Orange 330ml', 1.50000, 1.50000, '1696425314.png', 'S00005061', 'B00005061', '#FF8C00', 'Product', 100.00000, 1, NULL, 0, 1, 1, '4 min', 1, 1, 1, NULL, NULL, '2023-09-10 07:33:23', '2023-10-04 10:15:14', NULL),
(106, 3, 12, 1, 'Mirinda Strawberry 330ml', 1.50000, 1.50000, '1696425335.png', 'S00005062', 'B00005062', '#FF8C00', 'Product', 100.00000, 1, NULL, 0, 1, 1, '4 min', 1, 1, 1, NULL, NULL, '2023-09-10 07:33:23', '2023-10-04 10:15:35', NULL),
(107, 3, 12, 1, '1.5L Bottle Drink', 2.50000, 2.50000, '1696425470.png', 'S00005063', 'B00005063', '#FF8C00', 'Product', 100.00000, 1, NULL, 0, 1, 1, '4 min', 1, 1, 1, NULL, NULL, '2023-09-10 07:33:23', '2023-10-04 10:17:50', NULL),
(108, 3, 12, 1, '1.5L Bottle of Water', 2.00000, 2.00000, '1696425584.png', 'S00005064', 'B00005064', '#FF8C00', 'Product', 100.00000, 1, NULL, 0, 1, 1, '4 min', 1, 1, 1, NULL, NULL, '2023-09-10 07:33:23', '2023-10-04 10:19:44', NULL),
(109, 3, 12, 1, '500ml Water', 1.00000, 1.00000, '1696425759.jpg', 'S00005065', 'B00005065', '#FF8C00', 'Product', 100.00000, 1, NULL, 0, 1, 1, '4 min', 1, 1, 1, NULL, NULL, '2023-09-10 07:33:23', '2023-10-04 10:22:39', NULL),
(110, 3, 13, 1, 'Big Deal', 35.99000, 35.99000, '1695843325.jpg', 'S0000501', 'B0000501', '#FF8C00', 'Product', 100.00000, 1, NULL, 0, 1, 1, '4 min', 1, 1, 1, NULL, NULL, '2023-09-10 07:33:23', '2023-09-27 16:35:25', NULL),
(111, 3, 13, 1, 'Double Deal', 17.99000, 17.99000, '1695843830.jpg', 'S000050123', 'B000050123', '#FF8C00', 'Product', 100.00000, 1, NULL, 0, 1, 1, '4 min', 1, 1, 1, NULL, NULL, '2023-09-10 07:33:23', '2023-09-27 16:43:50', NULL),
(112, 3, 13, 1, 'Triple Deal', 25.99000, 25.99000, '1695843500.jpg', 'S00005022', 'B00005022', '#FF8C00', 'Product', 100.00000, 1, NULL, 0, 1, 1, '4 min', 1, 1, 1, NULL, NULL, '2023-09-10 07:33:23', '2023-09-27 16:38:20', NULL),
(113, 3, 13, 1, 'Cool Lover', 19.99000, 19.99000, '1695843404.jpg', 'S00005012', 'B00005012', '#FF8C00', 'Product', 100.00000, 1, NULL, 0, 1, 1, '4 min', 1, 1, 1, NULL, NULL, '2023-09-10 07:33:23', '2023-09-27 16:36:44', NULL),
(114, 3, 13, 1, 'Mix Deal', 26.99000, 26.99000, 'product.png', 'S000050', 'B000050', '#FF8C00', 'Product', 100.00000, 1, '', 0, 1, 1, '4 min', 1, 1, 1, NULL, NULL, '2023-09-10 07:33:23', '2023-09-10 07:33:23', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pos_roles`
--

DROP TABLE IF EXISTS `pos_roles`;
CREATE TABLE IF NOT EXISTS `pos_roles` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` text,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pos_roles`
--

INSERT INTO `pos_roles` (`id`, `name`, `description`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'ADMINISTRATOR', NULL, 1, '2023-08-04 11:04:49', NULL, NULL),
(2, 'MANAGER', NULL, 1, '2023-08-04 11:04:49', NULL, NULL),
(3, 'EMPLOYEE', NULL, 1, '2023-08-04 11:04:49', NULL, NULL),
(4, 'SUPERVISOR', NULL, 1, '2023-08-04 11:04:49', NULL, NULL),
(5, 'RECEPTIONIST', NULL, 1, '2023-08-04 11:04:49', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pos_state`
--

DROP TABLE IF EXISTS `pos_state`;
CREATE TABLE IF NOT EXISTS `pos_state` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `countryId` int(10) UNSIGNED DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pos_state_countryid_foreign` (`countryId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pos_stores`
--

DROP TABLE IF EXISTS `pos_stores`;
CREATE TABLE IF NOT EXISTS `pos_stores` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `storeType` varchar(50) DEFAULT NULL,
  `contactName` varchar(150) NOT NULL,
  `phone` bigint(20) DEFAULT NULL,
  `fax` bigint(20) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `siteNumber` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `council` varchar(255) DEFAULT NULL,
  `county` varchar(255) DEFAULT NULL,
  `postCode` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `businessName` varchar(255) DEFAULT NULL,
  `description` text,
  `logo` varchar(100) NOT NULL DEFAULT 'storeicon.png',
  `startTime` varchar(255) NOT NULL,
  `endTime` varchar(255) NOT NULL,
  `currency` int(10) UNSIGNED DEFAULT NULL,
  `timezone` varchar(200) NOT NULL DEFAULT 'US/Central',
  `isonlineoffline` tinyint(4) NOT NULL DEFAULT '1',
  `storeshowinweb` tinyint(4) NOT NULL DEFAULT '1',
  `deliveryOption` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0:Hide 1:Show',
  `makeReservation` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0:Hide 1:Show',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0:Inactive 1:Active',
  `discountTagLine` text,
  `openCloseTime` text,
  `banner` varchar(255) DEFAULT 'banner.png',
  `serviceCharges` double(10,2) DEFAULT '0.00',
  `deliveryCharges` double(10,2) DEFAULT '0.00',
  `createdBy` int(10) UNSIGNED DEFAULT NULL,
  `updatedBy` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pos_stores`
--

INSERT INTO `pos_stores` (`id`, `storeType`, `contactName`, `phone`, `fax`, `email`, `siteNumber`, `address`, `city`, `council`, `county`, `postCode`, `country`, `businessName`, `description`, `logo`, `startTime`, `endTime`, `currency`, `timezone`, `isonlineoffline`, `storeshowinweb`, `deliveryOption`, `makeReservation`, `status`, `discountTagLine`, `openCloseTime`, `banner`, `serviceCharges`, `deliveryCharges`, `createdBy`, `updatedBy`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Retail', 'Mark Json', 123456789, 123456789, 'mail@gmail.com', '123456789', '209 Well Street, London, E9 6QU', '', '', '', '', '', 'Romeo Pizaa', 'Largest Pizaa retail chain', 'storeicon.png', '10:00AM', '10:00PM', 0, 'US/Central', 1, 1, 1, 1, 1, NULL, '', 'banner.png', 0.00, 0.00, 1, 1, '2023-08-04 11:04:49', '2023-08-04 11:04:49', '2023-09-10 15:08:04'),
(2, 'Retail', 'Will Json', 123456789, 123456789, 'mail@gmail.com', '123456789', 'Address Line1, Address Line2', 'Ahmedabad', 'Gujarat', 'Londan', '121212', 'UK', 'Marker Pizaa', 'Largest Pizaa retail chain', 'storeicon.png', '10:00AM', '10:00PM', 0, 'US/Central', 1, 1, 1, 1, 1, NULL, '', 'banner.png', 0.00, 0.00, 1, 1, '2023-08-04 11:04:49', '2023-08-04 11:04:49', '2023-09-23 09:08:39'),
(3, 'Retail', 'Ovi', 9865324578, NULL, 'ovi@romeospizza.uk', '12454877', '209 Well Street, London, E9 6QU', 'City A', NULL, 'Londan', 'E125BP', 'UK', 'Coffee Manor', NULL, 'storeicon.png', '12:15 PM', '12:15 PM', 0, 'US/Central', 1, 1, 1, 1, 1, NULL, NULL, 'banner.png', 0.00, 0.00, NULL, NULL, '2023-08-31 02:43:48', '2023-08-31 02:43:48', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pos_stores_availability`
--

DROP TABLE IF EXISTS `pos_stores_availability`;
CREATE TABLE IF NOT EXISTS `pos_stores_availability` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `storeId` int(10) UNSIGNED DEFAULT NULL,
  `day` varchar(50) NOT NULL,
  `starttime` varchar(255) DEFAULT NULL,
  `endtime` varchar(255) DEFAULT NULL,
  `isopen` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0:Close 1:Open',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pos_stores_availability_storeid_foreign` (`storeId`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pos_stores_availability`
--

INSERT INTO `pos_stores_availability` (`id`, `storeId`, `day`, `starttime`, `endtime`, `isopen`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'Monday', '10AM', '10PM', 1, '2023-08-04 11:04:49', '2023-08-04 11:04:49', NULL),
(2, 1, 'Tuesday', '10AM', '10PM', 1, '2023-08-04 11:04:49', '2023-08-04 11:04:49', NULL),
(3, 1, 'Wednesday', '10AM', '10PM', 1, '2023-08-04 11:04:49', '2023-08-04 11:04:49', NULL),
(4, 1, 'Thursday', '10AM', '10PM', 1, '2023-08-04 11:04:49', '2023-08-04 11:04:49', NULL),
(5, 1, 'Friday', '10AM', '10PM', 1, '2023-08-04 11:04:49', '2023-08-04 11:04:49', NULL),
(6, 1, 'Saturday', '10AM', '10PM', 1, '2023-08-04 11:04:49', '2023-08-04 11:04:49', NULL),
(7, 1, 'Sunday', 'Closed', '', 1, '2023-08-04 11:04:49', '2023-08-04 11:04:49', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pos_stores_tables`
--

DROP TABLE IF EXISTS `pos_stores_tables`;
CREATE TABLE IF NOT EXISTS `pos_stores_tables` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `storeId` int(10) UNSIGNED DEFAULT NULL,
  `seatingCapacity` varchar(255) DEFAULT NULL,
  `tableNumber` varchar(255) DEFAULT NULL,
  `shapeType` varchar(255) DEFAULT NULL,
  `length` varchar(255) DEFAULT NULL,
  `width` varchar(255) DEFAULT NULL,
  `marginLeft` varchar(255) DEFAULT NULL,
  `marginTop` varchar(255) DEFAULT NULL,
  `color` varchar(255) DEFAULT NULL,
  `createdBy` int(10) UNSIGNED DEFAULT NULL,
  `updatedBy` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pos_stores_tables_storeid_foreign` (`storeId`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pos_stores_tables`
--

INSERT INTO `pos_stores_tables` (`id`, `storeId`, `seatingCapacity`, `tableNumber`, `shapeType`, `length`, `width`, `marginLeft`, `marginTop`, `color`, `createdBy`, `updatedBy`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, '10', '1', 'Bar height', '4', '5', '0', '0', 'White', 1, 1, '2023-08-08 00:18:21', '2023-08-08 00:18:21', NULL),
(2, 1, '10', '7', 'Circel', '4', '5', '0', '0', 'White', 1, 1, '2023-08-08 00:18:21', '2023-08-08 00:18:21', NULL),
(3, 1, '5', '3', 'Family dining', '4', '5', '0', '0', 'White', 1, 1, '2023-08-08 00:18:21', '2023-08-08 00:18:21', NULL),
(4, 1, '4', '4', 'Outdoor', '4', '5', '0', '0', 'White', 1, 1, '2023-08-08 00:18:21', '2023-08-08 00:18:21', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pos_tables_booking`
--

DROP TABLE IF EXISTS `pos_tables_booking`;
CREATE TABLE IF NOT EXISTS `pos_tables_booking` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `storeId` int(10) UNSIGNED DEFAULT NULL,
  `tableId` int(10) UNSIGNED DEFAULT NULL,
  `bookingId` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `phoneNumber` varchar(255) DEFAULT NULL,
  `person` varchar(255) DEFAULT NULL,
  `date` varchar(255) DEFAULT NULL,
  `time` varchar(255) DEFAULT NULL,
  `bookingStatus` enum('BOOKING','COMPLETED','CANCELLED') NOT NULL DEFAULT 'BOOKING',
  `createdBy` int(10) UNSIGNED DEFAULT NULL,
  `updatedBy` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pos_tables_booking_storeid_foreign` (`storeId`),
  KEY `pos_tables_booking_tableid_foreign` (`tableId`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pos_tables_booking`
--

INSERT INTO `pos_tables_booking` (`id`, `storeId`, `tableId`, `bookingId`, `name`, `phoneNumber`, `person`, `date`, `time`, `bookingStatus`, `createdBy`, `updatedBy`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 3, 1, NULL, 'Ronak Kapdi', '+919714170940', '5', '29/09/2023', '12:00 PM', 'BOOKING', NULL, NULL, '2023-09-28 15:07:53', '2023-09-28 15:07:53', NULL),
(4, 3, 2, NULL, 'TOGO', '+4407570285011', 'TOGO', '29/09/2023', '09:58 AM', 'BOOKING', NULL, NULL, '2023-09-29 06:03:58', '2023-09-29 06:03:58', NULL),
(5, 3, 2, NULL, 'Ronak', '+449714170940', '5', '02/10/2023', '12:39 AM', 'BOOKING', NULL, NULL, '2023-10-01 16:10:07', '2023-10-01 16:10:07', NULL),
(6, 3, 2, NULL, 'ok', '+449714170940', 'ok', '03/10/2023', '12:51 AM', 'BOOKING', NULL, NULL, '2023-10-01 16:23:45', '2023-10-01 16:23:45', NULL),
(7, 3, 3, NULL, 'ok', '+449714170940', 'ok', '02/10/2023', '12:53 AM', 'BOOKING', NULL, NULL, '2023-10-01 16:24:02', '2023-10-01 16:24:02', NULL),
(8, 3, 1, NULL, 'tttttt', '+4497141709400', '1', '02/10/2023', '12:56 AM', 'BOOKING', NULL, NULL, '2023-10-01 16:28:12', '2023-10-01 16:28:12', NULL),
(9, 3, 2, NULL, 'Vipul Bhandari', '+4407570285011', 'Vipul Bhandari', '19/10/2023', '09:15 AM', 'BOOKING', NULL, NULL, '2023-10-05 17:36:11', '2023-10-05 17:36:11', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pos_vendors`
--

DROP TABLE IF EXISTS `pos_vendors`;
CREATE TABLE IF NOT EXISTS `pos_vendors` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `profile` varchar(255) NOT NULL DEFAULT 'vendor.png',
  `phone` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pos_vendors`
--

INSERT INTO `pos_vendors` (`id`, `name`, `email`, `profile`, `phone`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Ricky Ponting', 'rk@gmail.com', 'vendor.png', '123456789', 1, '2023-08-04 11:04:49', NULL, NULL);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pos_access`
--
ALTER TABLE `pos_access`
  ADD CONSTRAINT `pos_access_roleid_foreign` FOREIGN KEY (`roleId`) REFERENCES `pos_roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pos_admin`
--
ALTER TABLE `pos_admin`
  ADD CONSTRAINT `pos_admin_roleid_foreign` FOREIGN KEY (`roleId`) REFERENCES `pos_roles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pos_admin_storeid_foreign` FOREIGN KEY (`storeId`) REFERENCES `pos_stores` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pos_categories`
--
ALTER TABLE `pos_categories`
  ADD CONSTRAINT `pos_categories_storeid_foreign` FOREIGN KEY (`storeId`) REFERENCES `pos_stores` (`id`);

--
-- Constraints for table `pos_city`
--
ALTER TABLE `pos_city`
  ADD CONSTRAINT `pos_city_stateid_foreign` FOREIGN KEY (`stateId`) REFERENCES `pos_state` (`id`);

--
-- Constraints for table `pos_orders`
--
ALTER TABLE `pos_orders`
  ADD CONSTRAINT `pos_orders_customeraddressid_foreign` FOREIGN KEY (`customerAddressId`) REFERENCES `pos_customers_address` (`id`),
  ADD CONSTRAINT `pos_orders_customerid_foreign` FOREIGN KEY (`customerId`) REFERENCES `pos_customers` (`id`),
  ADD CONSTRAINT `pos_orders_employeeid_foreign` FOREIGN KEY (`employeeId`) REFERENCES `pos_admin` (`id`),
  ADD CONSTRAINT `pos_orders_storeid_foreign` FOREIGN KEY (`storeId`) REFERENCES `pos_stores` (`id`);

--
-- Constraints for table `pos_orders_items`
--
ALTER TABLE `pos_orders_items`
  ADD CONSTRAINT `pos_orders_items_orderid_foreign` FOREIGN KEY (`orderId`) REFERENCES `pos_orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pos_orders_items_productid_foreign` FOREIGN KEY (`productId`) REFERENCES `pos_products` (`id`),
  ADD CONSTRAINT `pos_orders_items_storeid_foreign` FOREIGN KEY (`storeId`) REFERENCES `pos_stores` (`id`);

--
-- Constraints for table `pos_products`
--
ALTER TABLE `pos_products`
  ADD CONSTRAINT `pos_products_categoryid_foreign` FOREIGN KEY (`categoryId`) REFERENCES `pos_categories` (`id`),
  ADD CONSTRAINT `pos_products_storeid_foreign` FOREIGN KEY (`storeId`) REFERENCES `pos_stores` (`id`),
  ADD CONSTRAINT `pos_products_vendorid_foreign` FOREIGN KEY (`vendorId`) REFERENCES `pos_vendors` (`id`);

--
-- Constraints for table `pos_state`
--
ALTER TABLE `pos_state`
  ADD CONSTRAINT `pos_state_countryid_foreign` FOREIGN KEY (`countryId`) REFERENCES `pos_country` (`id`);

--
-- Constraints for table `pos_stores_availability`
--
ALTER TABLE `pos_stores_availability`
  ADD CONSTRAINT `pos_stores_availability_storeid_foreign` FOREIGN KEY (`storeId`) REFERENCES `pos_stores` (`id`);

--
-- Constraints for table `pos_stores_tables`
--
ALTER TABLE `pos_stores_tables`
  ADD CONSTRAINT `pos_stores_tables_storeid_foreign` FOREIGN KEY (`storeId`) REFERENCES `pos_stores` (`id`);

--
-- Constraints for table `pos_tables_booking`
--
ALTER TABLE `pos_tables_booking`
  ADD CONSTRAINT `pos_tables_booking_storeid_foreign` FOREIGN KEY (`storeId`) REFERENCES `pos_stores` (`id`),
  ADD CONSTRAINT `pos_tables_booking_tableid_foreign` FOREIGN KEY (`tableId`) REFERENCES `pos_stores_tables` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
