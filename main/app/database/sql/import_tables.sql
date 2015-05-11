
-- phpMyAdmin SQL Dump
-- version 4.0.6deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 30, 2013 at 01:14 PM
-- Server version: 5.5.34-0ubuntu0.13.10.1
-- PHP Version: 5.5.3-1ubuntu2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

CREATE TABLE `countries` (
`id` int(11) NOT NULL auto_increment,
`country_code` varchar(2) NOT NULL default '',
`country_name` varchar(100) NOT NULL default '',
PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=240 DEFAULT CHARSET=latin1 AUTO_INCREMENT=240 ;

-- 
-- Dumping data for table `countries`
-- 
INSERT INTO `countries` VALUES (1, 'US', 'United States');
INSERT INTO `countries` VALUES (2, 'CA', 'Canada');
INSERT INTO `countries` VALUES (3, 'AF', 'Afghanistan');
INSERT INTO `countries` VALUES (4, 'AL', 'Albania');
INSERT INTO `countries` VALUES (5, 'DZ', 'Algeria');
INSERT INTO `countries` VALUES (6, 'DS', 'American Samoa');
INSERT INTO `countries` VALUES (7, 'AD', 'Andorra');
INSERT INTO `countries` VALUES (8, 'AO', 'Angola');
INSERT INTO `countries` VALUES (9, 'AI', 'Anguilla');
INSERT INTO `countries` VALUES (10, 'AQ', 'Antarctica');
INSERT INTO `countries` VALUES (11, 'AG', 'Antigua and/or Barbuda');
INSERT INTO `countries` VALUES (12, 'AR', 'Argentina');
INSERT INTO `countries` VALUES (13, 'AM', 'Armenia');
INSERT INTO `countries` VALUES (14, 'AW', 'Aruba');
INSERT INTO `countries` VALUES (15, 'AU', 'Australia');
INSERT INTO `countries` VALUES (16, 'AT', 'Austria');
INSERT INTO `countries` VALUES (17, 'AZ', 'Azerbaijan');
INSERT INTO `countries` VALUES (18, 'BS', 'Bahamas');
INSERT INTO `countries` VALUES (19, 'BH', 'Bahrain');
INSERT INTO `countries` VALUES (20, 'BD', 'Bangladesh');
INSERT INTO `countries` VALUES (21, 'BB', 'Barbados');
INSERT INTO `countries` VALUES (22, 'BY', 'Belarus');
INSERT INTO `countries` VALUES (23, 'BE', 'Belgium');
INSERT INTO `countries` VALUES (24, 'BZ', 'Belize');
INSERT INTO `countries` VALUES (25, 'BJ', 'Benin');
INSERT INTO `countries` VALUES (26, 'BM', 'Bermuda');
INSERT INTO `countries` VALUES (27, 'BT', 'Bhutan');
INSERT INTO `countries` VALUES (28, 'BO', 'Bolivia');
INSERT INTO `countries` VALUES (29, 'BA', 'Bosnia and Herzegovina');
INSERT INTO `countries` VALUES (30, 'BW', 'Botswana');
INSERT INTO `countries` VALUES (31, 'BV', 'Bouvet Island');
INSERT INTO `countries` VALUES (32, 'BR', 'Brazil');
INSERT INTO `countries` VALUES (33, 'IO', 'British lndian Ocean Territory');
INSERT INTO `countries` VALUES (34, 'BN', 'Brunei Darussalam');
INSERT INTO `countries` VALUES (35, 'BG', 'Bulgaria');
INSERT INTO `countries` VALUES (36, 'BF', 'Burkina Faso');
INSERT INTO `countries` VALUES (37, 'BI', 'Burundi');
INSERT INTO `countries` VALUES (38, 'KH', 'Cambodia');
INSERT INTO `countries` VALUES (39, 'CM', 'Cameroon');
INSERT INTO `countries` VALUES (40, 'CV', 'Cape Verde');
INSERT INTO `countries` VALUES (41, 'KY', 'Cayman Islands');
INSERT INTO `countries` VALUES (42, 'CF', 'Central African Republic');
INSERT INTO `countries` VALUES (43, 'TD', 'Chad');
INSERT INTO `countries` VALUES (44, 'CL', 'Chile');
INSERT INTO `countries` VALUES (45, 'CN', 'China');
INSERT INTO `countries` VALUES (46, 'CX', 'Christmas Island');
INSERT INTO `countries` VALUES (47, 'CC', 'Cocos (Keeling) Islands');
INSERT INTO `countries` VALUES (48, 'CO', 'Colombia');
INSERT INTO `countries` VALUES (49, 'KM', 'Comoros');
INSERT INTO `countries` VALUES (50, 'CG', 'Congo');
INSERT INTO `countries` VALUES (51, 'CK', 'Cook Islands');
INSERT INTO `countries` VALUES (52, 'CR', 'Costa Rica');
INSERT INTO `countries` VALUES (53, 'HR', 'Croatia (Hrvatska)');
INSERT INTO `countries` VALUES (54, 'CU', 'Cuba');
INSERT INTO `countries` VALUES (55, 'CY', 'Cyprus');
INSERT INTO `countries` VALUES (56, 'CZ', 'Czech Republic');
INSERT INTO `countries` VALUES (57, 'DK', 'Denmark');
INSERT INTO `countries` VALUES (58, 'DJ', 'Djibouti');
INSERT INTO `countries` VALUES (59, 'DM', 'Dominica');
INSERT INTO `countries` VALUES (60, 'DO', 'Dominican Republic');
INSERT INTO `countries` VALUES (61, 'TP', 'East Timor');
INSERT INTO `countries` VALUES (62, 'EC', 'Ecuador');
INSERT INTO `countries` VALUES (63, 'EG', 'Egypt');
INSERT INTO `countries` VALUES (64, 'SV', 'El Salvador');
INSERT INTO `countries` VALUES (65, 'GQ', 'Equatorial Guinea');
INSERT INTO `countries` VALUES (66, 'ER', 'Eritrea');
INSERT INTO `countries` VALUES (67, 'EE', 'Estonia');
INSERT INTO `countries` VALUES (68, 'ET', 'Ethiopia');
INSERT INTO `countries` VALUES (69, 'FK', 'Falkland Islands (Malvinas)');
INSERT INTO `countries` VALUES (70, 'FO', 'Faroe Islands');
INSERT INTO `countries` VALUES (71, 'FJ', 'Fiji');
INSERT INTO `countries` VALUES (72, 'FI', 'Finland');
INSERT INTO `countries` VALUES (73, 'FR', 'France');
INSERT INTO `countries` VALUES (74, 'FX', 'France, Metropolitan');
INSERT INTO `countries` VALUES (75, 'GF', 'French Guiana');
INSERT INTO `countries` VALUES (76, 'PF', 'French Polynesia');
INSERT INTO `countries` VALUES (77, 'TF', 'French Southern Territories');
INSERT INTO `countries` VALUES (78, 'GA', 'Gabon');
INSERT INTO `countries` VALUES (79, 'GM', 'Gambia');
INSERT INTO `countries` VALUES (80, 'GE', 'Georgia');
INSERT INTO `countries` VALUES (81, 'DE', 'Germany');
INSERT INTO `countries` VALUES (82, 'GH', 'Ghana');
INSERT INTO `countries` VALUES (83, 'GI', 'Gibraltar');
INSERT INTO `countries` VALUES (84, 'GR', 'Greece');
INSERT INTO `countries` VALUES (85, 'GL', 'Greenland');
INSERT INTO `countries` VALUES (86, 'GD', 'Grenada');
INSERT INTO `countries` VALUES (87, 'GP', 'Guadeloupe');
INSERT INTO `countries` VALUES (88, 'GU', 'Guam');
INSERT INTO `countries` VALUES (89, 'GT', 'Guatemala');
INSERT INTO `countries` VALUES (90, 'GN', 'Guinea');
INSERT INTO `countries` VALUES (91, 'GW', 'Guinea-Bissau');
INSERT INTO `countries` VALUES (92, 'GY', 'Guyana');
INSERT INTO `countries` VALUES (93, 'HT', 'Haiti');
INSERT INTO `countries` VALUES (94, 'HM', 'Heard and Mc Donald Islands');
INSERT INTO `countries` VALUES (95, 'HN', 'Honduras');
INSERT INTO `countries` VALUES (96, 'HK', 'Hong Kong');
INSERT INTO `countries` VALUES (97, 'HU', 'Hungary');
INSERT INTO `countries` VALUES (98, 'IS', 'Iceland');
INSERT INTO `countries` VALUES (99, 'IN', 'India');
INSERT INTO `countries` VALUES (100, 'ID', 'Indonesia');
INSERT INTO `countries` VALUES (101, 'IR', 'Iran (Islamic Republic of)');
INSERT INTO `countries` VALUES (102, 'IQ', 'Iraq');
INSERT INTO `countries` VALUES (103, 'IE', 'Ireland');
INSERT INTO `countries` VALUES (104, 'IL', 'Israel');
INSERT INTO `countries` VALUES (105, 'IT', 'Italy');
INSERT INTO `countries` VALUES (106, 'CI', 'Ivory Coast');
INSERT INTO `countries` VALUES (107, 'JM', 'Jamaica');
INSERT INTO `countries` VALUES (108, 'JP', 'Japan');
INSERT INTO `countries` VALUES (109, 'JO', 'Jordan');
INSERT INTO `countries` VALUES (110, 'KZ', 'Kazakhstan');
INSERT INTO `countries` VALUES (111, 'KE', 'Kenya');
INSERT INTO `countries` VALUES (112, 'KI', 'Kiribati');
INSERT INTO `countries` VALUES (113, 'KP', 'Korea, Democratic People''s Republic of');
INSERT INTO `countries` VALUES (114, 'KR', 'Korea, Republic of');
INSERT INTO `countries` VALUES (115, 'XK', 'Kosovo');

INSERT INTO `countries` VALUES (116, 'KW', 'Kuwait');
INSERT INTO `countries` VALUES (117, 'KG', 'Kyrgyzstan');
INSERT INTO `countries` VALUES (118, 'LA', 'Lao People''s Democratic Republic');
INSERT INTO `countries` VALUES (119, 'LV', 'Latvia');
INSERT INTO `countries` VALUES (120, 'LB', 'Lebanon');
INSERT INTO `countries` VALUES (121, 'LS', 'Lesotho');
INSERT INTO `countries` VALUES (122, 'LR', 'Liberia');
INSERT INTO `countries` VALUES (123, 'LY', 'Libyan Arab Jamahiriya');
INSERT INTO `countries` VALUES (124, 'LI', 'Liechtenstein');
INSERT INTO `countries` VALUES (125, 'LT', 'Lithuania');
INSERT INTO `countries` VALUES (126, 'LU', 'Luxembourg');
INSERT INTO `countries` VALUES (127, 'MO', 'Macau');
INSERT INTO `countries` VALUES (128, 'MK', 'Macedonia');
INSERT INTO `countries` VALUES (129, 'MG', 'Madagascar');
INSERT INTO `countries` VALUES (130, 'MW', 'Malawi');
INSERT INTO `countries` VALUES (131, 'MY', 'Malaysia');
INSERT INTO `countries` VALUES (132, 'MV', 'Maldives');
INSERT INTO `countries` VALUES (133, 'ML', 'Mali');
INSERT INTO `countries` VALUES (134, 'MT', 'Malta');
INSERT INTO `countries` VALUES (135, 'MH', 'Marshall Islands');
INSERT INTO `countries` VALUES (136, 'MQ', 'Martinique');
INSERT INTO `countries` VALUES (137, 'MR', 'Mauritania');
INSERT INTO `countries` VALUES (138, 'MU', 'Mauritius');
INSERT INTO `countries` VALUES (139, 'TY', 'Mayotte');
INSERT INTO `countries` VALUES (140, 'MX', 'Mexico');
INSERT INTO `countries` VALUES (141, 'FM', 'Micronesia, Federated States of');
INSERT INTO `countries` VALUES (142, 'MD', 'Moldova, Republic of');
INSERT INTO `countries` VALUES (143, 'MC', 'Monaco');
INSERT INTO `countries` VALUES (144, 'MN', 'Mongolia');
INSERT INTO `countries` VALUES (145, 'ME', 'Montenegro');
INSERT INTO `countries` VALUES (146, 'MS', 'Montserrat');
INSERT INTO `countries` VALUES (147, 'MA', 'Morocco');
INSERT INTO `countries` VALUES (148, 'MZ', 'Mozambique');
INSERT INTO `countries` VALUES (149, 'MM', 'Myanmar');
INSERT INTO `countries` VALUES (150, 'NA', 'Namibia');
INSERT INTO `countries` VALUES (151, 'NR', 'Nauru');
INSERT INTO `countries` VALUES (152, 'NP', 'Nepal');
INSERT INTO `countries` VALUES (153, 'NL', 'Netherlands');
INSERT INTO `countries` VALUES (154, 'AN', 'Netherlands Antilles');
INSERT INTO `countries` VALUES (155, 'NC', 'New Caledonia');
INSERT INTO `countries` VALUES (156, 'NZ', 'New Zealand');
INSERT INTO `countries` VALUES (157, 'NI', 'Nicaragua');
INSERT INTO `countries` VALUES (158, 'NE', 'Niger');
INSERT INTO `countries` VALUES (159, 'NG', 'Nigeria');
INSERT INTO `countries` VALUES (160, 'NU', 'Niue');
INSERT INTO `countries` VALUES (161, 'NF', 'Norfork Island');
INSERT INTO `countries` VALUES (162, 'MP', 'Northern Mariana Islands');
INSERT INTO `countries` VALUES (163, 'NO', 'Norway');
INSERT INTO `countries` VALUES (164, 'OM', 'Oman');
INSERT INTO `countries` VALUES (165, 'PK', 'Pakistan');
INSERT INTO `countries` VALUES (166, 'PW', 'Palau');
INSERT INTO `countries` VALUES (167, 'PA', 'Panama');
INSERT INTO `countries` VALUES (168, 'PG', 'Papua New Guinea');
INSERT INTO `countries` VALUES (169, 'PY', 'Paraguay');
INSERT INTO `countries` VALUES (170, 'PE', 'Peru');
INSERT INTO `countries` VALUES (171, 'PH', 'Philippines');
INSERT INTO `countries` VALUES (172, 'PN', 'Pitcairn');
INSERT INTO `countries` VALUES (173, 'PL', 'Poland');
INSERT INTO `countries` VALUES (174, 'PT', 'Portugal');
INSERT INTO `countries` VALUES (175, 'PR', 'Puerto Rico');
INSERT INTO `countries` VALUES (176, 'QA', 'Qatar');
INSERT INTO `countries` VALUES (177, 'RE', 'Reunion');
INSERT INTO `countries` VALUES (178, 'RO', 'Romania');
INSERT INTO `countries` VALUES (179, 'RU', 'Russian Federation');
INSERT INTO `countries` VALUES (180, 'RW', 'Rwanda');
INSERT INTO `countries` VALUES (181, 'KN', 'Saint Kitts and Nevis');
INSERT INTO `countries` VALUES (182, 'LC', 'Saint Lucia');
INSERT INTO `countries` VALUES (183, 'VC', 'Saint Vincent and the Grenadines');
INSERT INTO `countries` VALUES (184, 'WS', 'Samoa');
INSERT INTO `countries` VALUES (185, 'SM', 'San Marino');
INSERT INTO `countries` VALUES (186, 'ST', 'Sao Tome and Principe');
INSERT INTO `countries` VALUES (187, 'SA', 'Saudi Arabia');
INSERT INTO `countries` VALUES (188, 'SN', 'Senegal');
INSERT INTO `countries` VALUES (189, 'RS', 'Serbia');
INSERT INTO `countries` VALUES (190, 'SC', 'Seychelles');
INSERT INTO `countries` VALUES (191, 'SL', 'Sierra Leone');
INSERT INTO `countries` VALUES (192, 'SG', 'Singapore');
INSERT INTO `countries` VALUES (193, 'SK', 'Slovakia');
INSERT INTO `countries` VALUES (194, 'SI', 'Slovenia');
INSERT INTO `countries` VALUES (195, 'SB', 'Solomon Islands');
INSERT INTO `countries` VALUES (196, 'SO', 'Somalia');
INSERT INTO `countries` VALUES (197, 'ZA', 'South Africa');
INSERT INTO `countries` VALUES (198, 'GS', 'South Georgia South Sandwich Islands');
INSERT INTO `countries` VALUES (199, 'ES', 'Spain');
INSERT INTO `countries` VALUES (200, 'LK', 'Sri Lanka');
INSERT INTO `countries` VALUES (201, 'SH', 'St. Helena');
INSERT INTO `countries` VALUES (202, 'PM', 'St. Pierre and Miquelon');
INSERT INTO `countries` VALUES (203, 'SD', 'Sudan');
INSERT INTO `countries` VALUES (204, 'SR', 'Suriname');
INSERT INTO `countries` VALUES (205, 'SJ', 'Svalbarn and Jan Mayen Islands');
INSERT INTO `countries` VALUES (206, 'SZ', 'Swaziland');
INSERT INTO `countries` VALUES (207, 'SE', 'Sweden');
INSERT INTO `countries` VALUES (208, 'CH', 'Switzerland');
INSERT INTO `countries` VALUES (209, 'SY', 'Syrian Arab Republic');
INSERT INTO `countries` VALUES (210, 'TW', 'Taiwan');
INSERT INTO `countries` VALUES (211, 'TJ', 'Tajikistan');
INSERT INTO `countries` VALUES (212, 'TZ', 'Tanzania, United Republic of');
INSERT INTO `countries` VALUES (213, 'TH', 'Thailand');
INSERT INTO `countries` VALUES (214, 'TG', 'Togo');
INSERT INTO `countries` VALUES (215, 'TK', 'Tokelau');
INSERT INTO `countries` VALUES (216, 'TO', 'Tonga');
INSERT INTO `countries` VALUES (217, 'TT', 'Trinidad and Tobago');
INSERT INTO `countries` VALUES (218, 'TN', 'Tunisia');
INSERT INTO `countries` VALUES (219, 'TR', 'Turkey');
INSERT INTO `countries` VALUES (220, 'TM', 'Turkmenistan');
INSERT INTO `countries` VALUES (221, 'TC', 'Turks and Caicos Islands');
INSERT INTO `countries` VALUES (222, 'TV', 'Tuvalu');
INSERT INTO `countries` VALUES (223, 'UG', 'Uganda');
INSERT INTO `countries` VALUES (224, 'UA', 'Ukraine');
INSERT INTO `countries` VALUES (225, 'AE', 'United Arab Emirates');
INSERT INTO `countries` VALUES (226, 'GB', 'United Kingdom');
INSERT INTO `countries` VALUES (227, 'UM', 'United States minor outlying islands');
INSERT INTO `countries` VALUES (228, 'UY', 'Uruguay');
INSERT INTO `countries` VALUES (229, 'UZ', 'Uzbekistan');
INSERT INTO `countries` VALUES (230, 'VU', 'Vanuatu');
INSERT INTO `countries` VALUES (231, 'VA', 'Vatican City State');
INSERT INTO `countries` VALUES (232, 'VE', 'Venezuela');
INSERT INTO `countries` VALUES (233, 'VN', 'Vietnam');
INSERT INTO `countries` VALUES (234, 'VG', 'Virigan Islands (British)');
INSERT INTO `countries` VALUES (235, 'VI', 'Virgin Islands (U.S.)');
INSERT INTO `countries` VALUES (236, 'WF', 'Wallis and Futuna Islands');
INSERT INTO `countries` VALUES (237, 'EH', 'Western Sahara');
INSERT INTO `countries` VALUES (238, 'YE', 'Yemen');
INSERT INTO `countries` VALUES (239, 'YU', 'Yugoslavia');
INSERT INTO `countries` VALUES (240, 'ZR', 'Zaire');
INSERT INTO `countries` VALUES (241, 'ZM', 'Zambia');
INSERT INTO `countries` VALUES (242, 'ZW', 'Zimbabwe');

--
-- Database: `bizplannerpro`
--

-- --------------------------------------------------------

--
-- Table structure for table `cash_flow_projection`
--
-- Creation: Dec 30, 2013 at 09:55 AM
-- Last update: Dec 30, 2013 at 09:55 AM
--

DROP TABLE IF EXISTS `cash_flow_projection`;
CREATE TABLE IF NOT EXISTS `cash_flow_projection` (
  `cash_fp_id` int(110) NOT NULL AUTO_INCREMENT,
  `percentage_sale` int(110) NOT NULL,
  `days_collect_payments` int(110) NOT NULL,
  `percentage_purchase` int(110) NOT NULL,
  `days_make_payments` int(110) NOT NULL,
  `cash_fp_bpid` int(110) NOT NULL,
  PRIMARY KEY (`cash_fp_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--
-- Creation: Dec 30, 2013 at 09:55 AM
--

DROP TABLE IF EXISTS `employee`;
CREATE TABLE IF NOT EXISTS `employee` (
  `employee_id` int(110) NOT NULL AUTO_INCREMENT,
  `employee_bp_id` int(110) NOT NULL,
  `employee_name` varchar(225) NOT NULL,
  `employee_start_date` varchar(110) NOT NULL,
  `employee_type` varchar(255) NOT NULL,
  employee_pay_per_year BOOLEAN,
  employee_pay_amount decimal(11,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`employee_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=111 ;

-- --------------------------------------------------------

--
-- Table structure for table `employee_12_month_plan`
--
-- Creation: Dec 30, 2013 at 09:55 AM
--

DROP TABLE IF EXISTS `employee_12_month_plan`;
CREATE TABLE IF NOT EXISTS `employee_12_month_plan` (
  `mpp_id` int(110) NOT NULL AUTO_INCREMENT,
  `month_01` decimal(11,2) NOT NULL DEFAULT '0.00',
  `month_02` decimal(11,2) NOT NULL DEFAULT '0.00',
  `month_03` decimal(11,2) NOT NULL DEFAULT '0.00',
  `month_04` decimal(11,2) NOT NULL DEFAULT '0.00',
  `month_05` decimal(11,2) NOT NULL DEFAULT '0.00',
  `month_06` decimal(11,2) NOT NULL DEFAULT '0.00',
  `month_07` decimal(11,2) NOT NULL DEFAULT '0.00',
  `month_08` decimal(11,2) NOT NULL DEFAULT '0.00',
  `month_09` decimal(11,2) NOT NULL DEFAULT '0.00',
  `month_10` decimal(11,2) NOT NULL DEFAULT '0.00',
  `month_11` decimal(11,2) NOT NULL DEFAULT '0.00',
  `month_12` decimal(11,2) NOT NULL DEFAULT '0.00',
  `financial_yr_forecast` year(4) NOT NULL,
  `employee_id` int(110) NOT NULL,
  PRIMARY KEY (`mpp_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=109 ;

-- --------------------------------------------------------

--
-- Table structure for table `employee_financial_forecast`
--
-- Creation: Dec 30, 2013 at 09:55 AM
--

DROP TABLE IF EXISTS `employee_financial_forecast`;
CREATE TABLE IF NOT EXISTS `employee_financial_forecast` (
  `eff_id` int(110) NOT NULL AUTO_INCREMENT,
  `financial_year` int(110) NOT NULL,
  `total_per_yr` int(110) NOT NULL,
  `related_expenses` int(110) NOT NULL,
  `pay_per_year` binary(1) NOT NULL DEFAULT '0',
  `employee_id` int(110) NOT NULL,
  PRIMARY KEY (`eff_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=218 ;

-- --------------------------------------------------------

--
-- Table structure for table `executive_summary`
--
-- Creation: Dec 30, 2013 at 09:55 AM
--

DROP TABLE IF EXISTS `executive_summary`;
CREATE TABLE IF NOT EXISTS `executive_summary` (
  `exe_sum_id` int(110) NOT NULL,
  `who_we_are` text NOT NULL,
  `what_we_sell` text NOT NULL,
  `who_we_sell_to` text NOT NULL,
  `financial_summary` text NOT NULL,
  `exe_sum_bpid` int(110) NOT NULL,
  PRIMARY KEY (`exe_sum_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `expenditure`
--
-- Creation: Dec 30, 2013 at 09:55 AM
--

DROP TABLE IF EXISTS `expenditure`;
CREATE TABLE IF NOT EXISTS `expenditure` (
  `exp_id` int(110) NOT NULL AUTO_INCREMENT,
  `expenditure_bp_id` int(110) NOT NULL,
  `expenditure_name` varchar(225) NOT NULL,
  `expenditure_start_date` varchar(110) NOT NULL,
  expected_change VARCHAR(10),
  percentage_of_change INT(3),
  pay_per_year BOOLEAN,
  pay_amount decimal(11,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`exp_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

-- --------------------------------------------------------

--
-- Table structure for table `expenditure_12_month_plan`
--
-- Creation: Dec 30, 2013 at 09:55 AM
--

DROP TABLE IF EXISTS `expenditure_12_month_plan`;
CREATE TABLE IF NOT EXISTS `expenditure_12_month_plan` (
  `epp_id` int(110) NOT NULL AUTO_INCREMENT,
  `month_01` decimal(11,2) NOT NULL DEFAULT '0.00',
  `month_02` decimal(11,2) NOT NULL DEFAULT '0.00',
  `month_03` decimal(11,2) NOT NULL DEFAULT '0.00',
  `month_04` decimal(11,2) NOT NULL DEFAULT '0.00',
  `month_05` decimal(11,2) NOT NULL DEFAULT '0.00',
  `month_06` decimal(11,2) NOT NULL DEFAULT '0.00',
  `month_07` decimal(11,2) NOT NULL DEFAULT '0.00',
  `month_08` decimal(11,2) NOT NULL DEFAULT '0.00',
  `month_09` decimal(11,2) NOT NULL DEFAULT '0.00',
  `month_10` decimal(11,2) NOT NULL DEFAULT '0.00',
  `month_11` decimal(11,2) NOT NULL DEFAULT '0.00',
  `month_12` decimal(11,2) NOT NULL DEFAULT '0.00',
  `financial_yr_forecast` year(4) NOT NULL,
  `expenditure_id` int(110) NOT NULL,
  PRIMARY KEY (`epp_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

-- --------------------------------------------------------

--
-- Table structure for table `expenditure_financial_forecast`
--
-- Creation: Dec 30, 2013 at 09:55 AM
--

DROP TABLE IF EXISTS `expenditure_financial_forecast`;
CREATE TABLE IF NOT EXISTS `expenditure_financial_forecast` (
  `exff_id` int(110) NOT NULL AUTO_INCREMENT,
  `financial_year` int(110) NOT NULL,
  `total_per_yr` int(110) NOT NULL,
  `related_expenses` int(110) NOT NULL,
  `pay_per_year` binary(1) NOT NULL DEFAULT '0',
  `expenditure_id` int(110) NOT NULL,
  PRIMARY KEY (`exff_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=91 ;

-- --------------------------------------------------------

--
-- Table structure for table `loan_investment`
--
-- Creation: Dec 30, 2013 at 09:55 AM
--

DROP TABLE IF EXISTS `loan_investment`;
CREATE TABLE IF NOT EXISTS `loan_investment` (
  `li_id` int(110) NOT NULL AUTO_INCREMENT,
  `loan_invest_bp_id` int(110) NOT NULL,
  `loan_invest_name` varchar(225) NOT NULL,
  `type_of_funding` varchar(225) NOT NULL,
  `loan_invest_interest_rate` decimal(11,2) NOT NULL,
  `loan_invest_years_to_pay` int(5) NOT NULL,
  `loan_invest_pays_per_years` int(3) NOT NULL,
  PRIMARY KEY (`li_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

-- --------------------------------------------------------

--
-- Table structure for table `loan_investment_12m_payment`
--
-- Creation: Dec 30, 2013 at 09:55 AM
--

DROP TABLE IF EXISTS `loan_investment_12m_payment`;
CREATE TABLE IF NOT EXISTS `loan_investment_12m_payment` (
  `limp_id` int(110) NOT NULL AUTO_INCREMENT,
  `limp_month_01` int(110) NOT NULL DEFAULT '0',
  `limp_month_02` int(110) NOT NULL DEFAULT '0',
  `limp_month_03` int(110) NOT NULL DEFAULT '0',
  `limp_month_04` int(110) NOT NULL DEFAULT '0',
  `limp_month_05` int(110) NOT NULL DEFAULT '0',
  `limp_month_06` int(110) NOT NULL DEFAULT '0',
  `limp_month_07` int(110) NOT NULL DEFAULT '0',
  `limp_month_08` int(110) NOT NULL DEFAULT '0',
  `limp_month_09` int(110) NOT NULL DEFAULT '0',
  `limp_month_10` int(110) NOT NULL DEFAULT '0',
  `limp_month_11` int(110) NOT NULL DEFAULT '0',
  `limp_month_12` int(110) NOT NULL DEFAULT '0',
  `limp_loan_investment_id` int(110) NOT NULL DEFAULT '0',
  PRIMARY KEY (`limp_id`),
  KEY `limp_loan_investment_id` (`limp_loan_investment_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- RELATIONS FOR TABLE `loan_investment_12m_payment`:
--   `limp_loan_investment_id`
--       `loan_investment` -> `li_id`
--

-- --------------------------------------------------------

--
-- Table structure for table `loan_investment_12m_received`
--
-- Creation: Dec 30, 2013 at 09:55 AM
--

DROP TABLE IF EXISTS `loan_investment_12m_received`;
CREATE TABLE IF NOT EXISTS `loan_investment_12m_received` (
  `limr_id` int(110) NOT NULL AUTO_INCREMENT,
  `limr_month_01` int(110) NOT NULL DEFAULT '0',
  `limr_month_02` int(110) NOT NULL DEFAULT '0',
  `limr_month_03` int(110) NOT NULL DEFAULT '0',
  `limr_month_04` int(110) NOT NULL DEFAULT '0',
  `limr_month_05` int(110) NOT NULL DEFAULT '0',
  `limr_month_06` int(110) NOT NULL DEFAULT '0',
  `limr_month_07` int(110) NOT NULL DEFAULT '0',
  `limr_month_08` int(110) NOT NULL DEFAULT '0',
  `limr_month_09` int(110) NOT NULL DEFAULT '0',
  `limr_month_10` int(110) NOT NULL DEFAULT '0',
  `limr_month_11` int(110) NOT NULL DEFAULT '0',
  `limr_month_12` int(110) NOT NULL DEFAULT '0',
  `limr_loan_investment_id` int(110) NOT NULL DEFAULT '0',
  PRIMARY KEY (`limr_id`),
  KEY `limr_loan_investment_id` (`limr_loan_investment_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- RELATIONS FOR TABLE `loan_investment_12m_received`:
--   `limr_loan_investment_id`
--       `loan_investment` -> `li_id`
--

-- --------------------------------------------------------

--
-- Table structure for table `loan_investment_payment_f_yrs`
--
-- Creation: Dec 30, 2013 at 09:55 AM
--

DROP TABLE IF EXISTS `loan_investment_payment_f_yrs`;
CREATE TABLE IF NOT EXISTS `loan_investment_payment_f_yrs` (
  `lip_id` int(110) NOT NULL AUTO_INCREMENT,
  `lip_year` varchar(255) NOT NULL,
  `lip_total_per_yr` int(110) NOT NULL,
  `lip_loan_investment_id` int(110) NOT NULL,
  PRIMARY KEY (`lip_id`),
  KEY `lip_loan_investment_id` (`lip_loan_investment_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- RELATIONS FOR TABLE `loan_investment_payment_f_yrs`:
--   `lip_loan_investment_id`
--       `loan_investment` -> `li_id`
--

-- --------------------------------------------------------

--
-- Table structure for table `loan_investment_received_f_yrs`
--
-- Creation: Dec 30, 2013 at 09:55 AM
--

DROP TABLE IF EXISTS `loan_investment_received_f_yrs`;
CREATE TABLE IF NOT EXISTS `loan_investment_received_f_yrs` (
  `lir_id` int(110) NOT NULL AUTO_INCREMENT,
  `lir_year` varchar(255) NOT NULL,
  `lir_total_per_yr` int(110) NOT NULL,
  `lir_loan_investment_id` int(110) NOT NULL,
  PRIMARY KEY (`lir_id`),
  KEY `lir_loan_investment_id` (`lir_loan_investment_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- RELATIONS FOR TABLE `loan_investment_received_f_yrs`:
--   `lir_loan_investment_id`
--       `loan_investment` -> `li_id`
--

-- --------------------------------------------------------

--
-- Table structure for table `major_purchases`
--
-- Creation: Dec 30, 2013 at 09:55 AM
-- Last update: Dec 30, 2013 at 09:55 AM
--

DROP TABLE IF EXISTS `major_purchases`;
CREATE TABLE IF NOT EXISTS `major_purchases` (
  `mp_id` int(110) NOT NULL AUTO_INCREMENT,
  `mp_name` varchar(225) COLLATE utf8_unicode_ci NOT NULL,
  `mp_price` int(110) NOT NULL,
  `mp_date` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `mp_depreciate` binary(1) NOT NULL DEFAULT '0',
  `mp_bpid` int(110) NOT NULL,
  PRIMARY KEY (`mp_id`),
  KEY `mp_bpid` (`mp_bpid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--
-- Creation: Dec 30, 2013 at 09:55 AM
-- Last update: Dec 30, 2013 at 09:55 AM
--

DROP TABLE IF EXISTS `pages`;
CREATE TABLE IF NOT EXISTS `pages` (
  `pageid` int(110) NOT NULL AUTO_INCREMENT,
  `parentid` int(110) NOT NULL,
  `pageurl` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `pagetitle` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `pageorder` int(110) NOT NULL,
  `page_content` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`pageid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=71 ;

-- --------------------------------------------------------

--
-- Table structure for table `page_sections`
--
-- Creation: Dec 30, 2013 at 09:55 AM
-- Last update: Dec 30, 2013 at 09:55 AM
--

DROP TABLE IF EXISTS `page_sections`;
CREATE TABLE IF NOT EXISTS `page_sections` (
  `section_id` int(110) NOT NULL AUTO_INCREMENT,
  `s_pageid` int(110) NOT NULL,
  `section_order` int(110) NOT NULL,
  `section_desc` text COLLATE utf8_unicode_ci,
  `section_title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `section_content` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`section_id`),
  KEY `s_pageid` (`s_pageid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

-- --------------------------------------------------------

--
-- Table structure for table `sales_12_month_forecast`
--
-- Creation: Dec 30, 2013 at 09:55 AM
--

DROP TABLE IF EXISTS `sales_12_month_forecast`;
CREATE TABLE IF NOT EXISTS `sales_12_month_forecast` (
  `smf_id` int(110) NOT NULL AUTO_INCREMENT,
  `month_01` int(110) NOT NULL DEFAULT '0',
  `month_02` int(110) NOT NULL DEFAULT '0',
  `month_03` int(110) NOT NULL DEFAULT '0',
  `month_04` int(110) NOT NULL DEFAULT '0',
  `month_05` int(110) NOT NULL DEFAULT '0',
  `month_06` int(110) NOT NULL DEFAULT '0',
  `month_07` int(110) NOT NULL DEFAULT '0',
  `month_08` int(110) NOT NULL DEFAULT '0',
  `month_09` int(110) NOT NULL DEFAULT '0',
  `month_10` int(110) NOT NULL DEFAULT '0',
  `month_11` int(110) NOT NULL DEFAULT '0',
  `month_12` int(110) NOT NULL DEFAULT '0',
  `price` decimal(11,2) NOT NULL DEFAULT '0.00',
  `cost` decimal(11,2) NOT NULL DEFAULT '0.00',
  `sales_forecast_id` int(110) NOT NULL,
  PRIMARY KEY (`smf_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

-- --------------------------------------------------------

--
-- Table structure for table `sales_financial_forecast`
--
-- Creation: Dec 30, 2013 at 09:55 AM
--

DROP TABLE IF EXISTS `sales_financial_forecast`;
CREATE TABLE IF NOT EXISTS `sales_financial_forecast` (
  `sff_id` int(110) NOT NULL AUTO_INCREMENT,
  `financial_year` varchar(255) NOT NULL,
  `total_per_yr` int(110) NOT NULL,
  `sales_forecast_id` int(110) NOT NULL,
  PRIMARY KEY (`sff_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=61 ;

-- --------------------------------------------------------

--
-- Table structure for table `sales_forecast`
--
-- Creation: Dec 30, 2013 at 09:55 AM
--

DROP TABLE IF EXISTS `sales_forecast`;
CREATE TABLE IF NOT EXISTS `sales_forecast` (
  `sf_id` int(110) NOT NULL AUTO_INCREMENT,
  `sales_forecast_name` varchar(225) NOT NULL,
  `sales_forecast_bp_id` int(110) NOT NULL,
  PRIMARY KEY (`sf_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `loan_investment_12m_payment`
--
ALTER TABLE `loan_investment_12m_payment`
  ADD CONSTRAINT `loan_investment_12m_payment_ibfk_1` FOREIGN KEY (`limp_loan_investment_id`) REFERENCES `loan_investment` (`li_id`);

--
-- Constraints for table `loan_investment_12m_received`
--
ALTER TABLE `loan_investment_12m_received`
  ADD CONSTRAINT `loan_investment_12m_received_ibfk_1` FOREIGN KEY (`limr_loan_investment_id`) REFERENCES `loan_investment` (`li_id`);

--
-- Constraints for table `loan_investment_payment_f_yrs`
--
ALTER TABLE `loan_investment_payment_f_yrs`
  ADD CONSTRAINT `loan_investment_payment_f_yrs_ibfk_1` FOREIGN KEY (`lip_loan_investment_id`) REFERENCES `loan_investment` (`li_id`);

--
-- Constraints for table `loan_investment_received_f_yrs`
--
ALTER TABLE `loan_investment_received_f_yrs`
  ADD CONSTRAINT `loan_investment_received_f_yrs_ibfk_1` FOREIGN KEY (`lir_loan_investment_id`) REFERENCES `loan_investment` (`li_id`);
COMMIT;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`pageid`, `parentid`, `pageurl`, `pagetitle`, `pageorder`, `page_content`) VALUES
(1, 0, 'home', 'Welcome home', 1, ''),
(2, 1, 'executive-summary', 'Executive Summary', 1, ''),
(3, 2, 'who-we-are ', 'Who We Are', 1, ''),
(4, 2, 'what-we-sell', 'What We Sell', 2, ''),
(5, 2, 'who-we-sell-to', 'Who We Sell To', 3, ''),
(6, 2, 'financial-summary', 'Financial Summary', 4, ''),
(7, 1, 'company', 'Company', 2, ''),
(8, 7, 'company-overview', 'Company Overview', 1, ''),
(9, 7, 'management-team', 'Management Team', 2, ''),
(10, 0, 'error-page', 'Error Page', 0, ''),
(11, 1, 'products-and-services', 'Products and Services', 3, ''),
(12, 11, 'products-and-services-c', 'Products and Services', 1, ''),
(13, 11, 'competitors', 'Competitors', 2, ''),
(14, 1, 'target-market', 'Target Market', 4, ''),
(16, 14, 'market-overview', 'Market Overview', 1, ''),
(17, 14, 'market-needs', 'Market Needs', 2, ''),
(18, 1, 'strategy-and-implementation', 'Strategy and Implementation', 5, ''),
(26, 25, 'sales-forecast', 'Sales Forecast', 1, ''),
(25, 1, 'financial-plan', 'Financial Plan', 6, ''),
(24, 18, 'milestones', 'Milestones', 2, ''),
(23, 18, 'marketing', 'Marketing', 1, ''),
(27, 25, 'human-resources', 'Human Resources', 2, ''),
(28, 25, 'budget', 'Budget', 3, ''),
(31, 30, 'sales-forecast-delete', 'Sales Forecast delete', 1, ''),
(32, 30, 'personnel-plan-delete', 'Personnel Plan delete', 2, ''),
(33, 30, 'budget-delete', 'Budget delete', 3, ''),
(39, 11, 'product-and-service-development', 'Product & Service Development', 3, ''),
(40, 11, 'sourcing-and-fulfillment', 'Sourcing and Fulfillment', 4, ''),
(41, 11, 'technology', 'Technology', 5, ''),
(42, 11, 'intellectual-property', 'Intellectual Property', 6, ''),
(43, 14, 'market-trends', 'Market Trends', 3, ''),
(44, 14, 'market-growth', 'Market Growth', 4, ''),
(45, 14, 'industry-analysis', 'Industry Analysis', 5, ''),
(46, 14, 'key-customers', 'Key Customers', 6, ''),
(36, 7, 'locations-and-facilities', 'Locations and Facilities', 3, ''),
(37, 7, 'mission-statement', 'Mission Statement', 4, ''),
(38, 7, 'company-history', 'Company History', 5, ''),
(47, 18, 'swot-analysis', 'SWOT Analysis', 3, ''),
(48, 18, 'competitive-edge', 'Competitive Edge', 4, ''),
(49, 18, 'promotional-activity', 'Promotional Activity', 5, ''),
(50, 18, 'sales-administration', 'Sales Administration', 6, ''),
(51, 18, 'sales-plan', 'Sales Plan', 7, ''),
(52, 18, 'strategic-alliances', 'Strategic Alliances', 8, ''),
(53, 18, 'exit-strategy', 'Exit Strategy', 9, ''),
(54, 25, 'cash-flow-projections', 'Cash Flow Projections', 4, ''),
(55, 25, 'loans-and-investments', 'Loans and Investments', 4, ''),
(56, 1, 'financial-statements', 'Financial Statements', 7, ''),
(57, 56, 'profit-and-loss-statement', 'Profit and Loss Statement', 0, ''),
(58, 56, 'balance-sheet', 'Balance Sheet', 1, ''),
(59, 56, 'cash-flow-statement', 'Cash Flow Statement', 2, ''),
(60, 1, 'appendix', 'Appendix', 8, ''),
(61, 60, 'sales-forecast-apx', 'Sales Forecast', 0, ''),
(62, 60, 'personnel-plan-apx', 'Personnel Plan', 1, ''),
(63, 60, 'budget-apx', 'Budget', 2, ''),
(64, 60, 'loans-and-investments-apx', 'Loans and Investments', 3, ''),
(65, 60, 'profit-and-loss-statement-apx', 'Profit and Loss Statement', 4, ''),
(66, 60, 'balance-sheet-apx', 'Balance Sheet', 5, ''),
(67, 60, 'cash-flow-statement-apx', 'Cash Flow Statement', 6, '');

--
-- Truncate table before insert `page_sections`
--

TRUNCATE TABLE `page_sections`;
--
-- Dumping data for table `page_sections`
--

INSERT INTO `page_sections` (`section_id`, `s_pageid`, `section_order`, `section_desc`, `section_title`, `section_content`) VALUES
(1, 23, 0, 'An important part of how you market to your customers will be the pricing of your products or services. What will your customers pay? How did you come up with that price? Here are some things to think about:\r\n\r\n<ul>\r\n<li>	What is the cost to produce your product or the service you offer? </li>\r\n<li>   Will your selling price cover your production costs?</li>\r\n<li>	Will pricing be part of how you will position your company to the market?\r\n<ul>\r\n<li> Offering free or low-cost pricing as a promotion? </li>\r\n<li> Offering discounts to your loyal customers? </li>\r\n</ul>\r\n</li>\r\n<li> What will these promotions or discounts cost you?</li>\r\n<li> Does your pricing structure support that positioning message?</li>\r\n<li> How does your pricing structure relate to those of your main competitors and your industry in general?</li>\r\n</ul>', 'Pricing', ''),
(2, 23, 1, 'In this group (Marketing), you have decided where to position your business and how you compare to the competition. Then you decided on your product/service price structure and how this will support your position in the market. \r\n<br/><br/>\r\nThe next step is to decide on promotional activity your business will employ to get your products and services in front of your target market.\r\n<br/><br/>\r\nThink about the common traits of each customer group within your target market, which type of promotional activity is more likely to attract them to your company? This could include amongst other promotional disciplines;<br/>\r\n<br/><strong>Advertising</strong>\r\n<ul>\r\n<li>	Direct mail </li>\r\n<li>	Web site</li>\r\n<li>	E-mail marketing </li>\r\n<li>	Point of sale promotions</li>\r\n\r\n\r\nDoes that type of promotional activity match up to your product/service and your price structure? Does it fit the image of your business, but importantly can you afford it?</ul>\r\n', 'Promotion', ''),
(3, 23, 2, 'This will depend on the type of business you run, if you are supplying a product you may;<br/><br/>\r\n\r\n<ul>\r\n<li>	Sell direct to your customer?</li>\r\n<li>	Sell online or by mail order and then ship your orders direct from a storage location to the customer? </li>\r\n<li>	Sell your products through a retailer?</li>\r\nThese are examples of distribution = getting your products to your customers for sale.<br/><br/>\r\n\r\nIf your business supplies a service to a client or you are in a service industry – retail, leisure banking etc you will sell direct to your customers; no shipping or handling. <br/><br/>\r\n\r\nDepending on how many levels of distribution you have before your product reaches your customer, the price for your product/service will need to include the cost of distribution.  <br/><br/>\r\n\r\nWhat type of distribution do you need? What will it cost?\r\n</ul>', 'Distribution', ''),
(4, 47, 0, '<p>Start your SWOT analysis by describing the strongest aspects of your business. </p>\r\n<ul>\r\n<li>	What do you do best? </li>\r\n<li>	What unique or enviable resources do you have that give you a competitive advantage?</li>\r\n<li>	Right products, quality and reliability</li>\r\n<li>	Good location with client/customer parking</li>\r\n<li>	Management committed and confident</li>\r\n</ul>\r\n\r\n\r\n<p>Understanding your strengths will enable you to focus on them so you can maximize your advantages over your competitors.</p>\r\n<br/>\r\n<p>Remember, strengths aren''t always tangible things like equipment or investment finance. Less concrete assets are just as valuable, things like existing customer relationships, a reputation for quality and timeliness, or a strong knowledge of the market.', 'Strengths', ''),
(5, 47, 1, 'Acknowledging the weak points in your business is not in itself a sign of weakness but a signal that you are committed to improvement. Think about the missing ingredients that threaten to keep your business from reaching its full potential. </p>\r\n\r\n<ul>\r\n\r\n<li>	Do you have a sales staff but no prospect lists yet for them to call and sell to?</li> \r\n<li>	Are you just starting to build connections in the local market? </li>\r\n<li>	Do you have slower equipment or less advanced technology than others?</li> \r\n<li>	Is your business outgrowing its current space?</li> \r\n<li>	Do you still really need a finance person?</li> \r\n</ul>\r\n\r\n<p>Weak areas like this need to be identified and shored up, not glossed over. Weaknesses, like strengths, should be internal factors that are under your control. </p>\r\n\r\n<p>External market factors will be considered in opportunities and threats.\r\n', 'Weaknesses', ''),
(6, 47, 2, 'The focus shifts outward from your company to the market and customer base, to identify opportunities which could be of advantage to your company.</p>\r\n\r\n<ul>\r\n<li>	Local competitors have poor products</li>\r\n<li>	Could develop new product to solve unmet need</li>\r\n<li>	New specialist applications</li>\r\n<li>	Identify competitor short comings allowing a chance to innovate and outcompete</li>\r\n<li>	Client and customer base respond well to innovative new ideas</li>\r\n\r\n</ul>\r\n<p>Be sure to think about the timing for each opportunity. Is there an ongoing need or just a short window of opportunity? How critical is your timing?</p> \r\n<br/>\r\n<p>\r\nAlso, make sure that the opportunities you identify are indeed opportunities are not strengths. An opportunity is an external factor in the market that anyone could potentially exploit. Strengths are internal factors for your specific company. If you find internal factors mixed in with your opportunities, go ahead and move them into the strengths.\r\n', 'Opportunities', ''),
(7, 47, 3, 'To complete your SWOT analyses, identify the major outside threats to your business. The better you are at identifying threats, the better positioned you will be to respond to them.</p>\r\n\r\n<p>The world is full of threats, of course, especially potential ones. You can''t prepare for them all. Focus on those that are both realistic and close to your business;</p>\r\n<ul>\r\n<li>	Negative press coverage</li>\r\n<li>	changing consumer tastes,</li> \r\n<li>	The loss of a major contract. </li>\r\n<li>	Impact of changing legislation</li>\r\n<li>	Retention of key staff critical</li>\r\n</ul>\r\n\r\n<p>Also, remember that threats, like opportunities, should be external factors beyond your direct control. Any issues related to your company''s own capabilities should go in weaknesses.\r\n', 'Threats', ''),
(10, 55, 0, '<p>Describe your funding plans. What types of funding do you expect to receive and when? If you do not have the full detail of future financing worked out yet, that''s understandable. Just explain what you do know and when you expect to sort out the details. If you have no plans to get funding, or just think the Loans and Investments table is clear enough on its own, you can remove this text item in the Section Setup view.</p>', 'Sources of Funds', ''),
(9, 55, 1, '<p>If your plan includes loans, investments, or other funding, use this space to explain what you will do with that money. Will it help to cover operating costs as your business scales up? Will it finance major purchases? Will it enable you to add personnel or expand your marketing to increase sales? Give your reader a clear picture of why these funds are needed and how they will pay off. If you have no plans to get funding, you can remove this text item in the Section Setup view.</p>', 'Use of Funds', '');

DROP TABLE IF EXISTS bp_pages;
CREATE TABLE bp_pages (
	id integer NOT NULL AUTO_INCREMENT,
	bp_id integer NOT NULL,
	pageid integer NOT NULL,
	page_content text,
	PRIMARY KEY (id)
       	/* 
	FOREIGN KEY (user_id) REFERENCES bp_users (user_id) MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE,
       	FOREIGN KEY (pageid) REFERENCES pages (pageid) MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
	*/
)ENGINE=InnoDB;

DROP TABLE IF EXISTS bp_user_page_sections;
CREATE TABLE bp_page_sections (
	id integer NOT NULL AUTO_INCREMENT,
	bp_id integer NOT NULL,
	section_id integer NOT NULL,
	section_content text,
	PRIMARY KEY (id)
	/*
	FOREIGN KEY (user_id) REFERENCES bp_users (user_id) MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE,
	FOREIGN KEY (section_id) REFERENCES page_sections (section_id) MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE,
	*/
)ENGINE=InnoDB;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;