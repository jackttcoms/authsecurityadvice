-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 02, 2019 at 02:22 PM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.1.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `everything`
--

-- --------------------------------------------------------

--
-- Table structure for table `everything_countries`
--

CREATE TABLE `everything_countries` (
  `id` int(11) NOT NULL,
  `country_code` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `country_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `status` int(11) NOT NULL DEFAULT '1',
  `popular` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `everything_countries`
--

INSERT INTO `everything_countries` (`id`, `country_code`, `country_name`, `status`, `popular`) VALUES
(1, 'AF', 'Afghanistan', 1, 0),
(2, 'AL', 'Albania', 1, 0),
(3, 'DZ', 'Algeria', 1, 0),
(4, 'DS', 'American Samoa', 1, 0),
(5, 'AD', 'Andorra', 1, 0),
(6, 'AO', 'Angola', 1, 0),
(7, 'AI', 'Anguilla', 1, 0),
(8, 'AQ', 'Antarctica (UK, AU, NZ, NO, FR)', 1, 0),
(9, 'AG', 'Antigua and Barbuda', 1, 0),
(10, 'AR', 'Argentina', 1, 0),
(11, 'AM', 'Armenia', 1, 0),
(12, 'AW', 'Aruba', 1, 0),
(13, 'AU', 'Australia', 1, 2),
(14, 'AT', 'Austria', 1, 0),
(15, 'AZ', 'Azerbaijan', 1, 0),
(16, 'BS', 'Bahamas', 1, 0),
(17, 'BH', 'Bahrain', 1, 0),
(18, 'BD', 'Bangladesh', 1, 0),
(19, 'BB', 'Barbados', 1, 0),
(20, 'BY', 'Belarus', 1, 0),
(21, 'BE', 'Belgium', 1, 0),
(22, 'BZ', 'Belize', 1, 0),
(23, 'BJ', 'Benin', 1, 0),
(24, 'BM', 'Bermuda', 1, 0),
(25, 'BT', 'Bhutan', 1, 0),
(26, 'BO', 'Bolivia', 1, 0),
(27, 'BA', 'Bosnia and Herzegovina', 1, 0),
(28, 'BW', 'Botswana', 1, 0),
(29, 'BV', 'Bouvet Island', 1, 0),
(30, 'BR', 'Brazil', 1, 0),
(31, 'IO', 'British Indian Ocean Territory', 1, 0),
(32, 'BN', 'Brunei Darussalam', 1, 0),
(33, 'BG', 'Bulgaria', 1, 0),
(34, 'BF', 'Burkina Faso', 1, 0),
(35, 'BI', 'Burundi', 1, 0),
(36, 'KH', 'Cambodia', 1, 0),
(37, 'CM', 'Cameroon', 1, 0),
(38, 'CA', 'Canada', 1, 3),
(39, 'CV', 'Cape Verde', 1, 0),
(40, 'KY', 'Cayman Islands', 1, 0),
(41, 'CF', 'Central African Republic', 1, 0),
(42, 'TD', 'Chad', 1, 0),
(43, 'CL', 'Chile', 1, 0),
(44, 'CN', 'China', 1, 0),
(45, 'CX', 'Christmas Island', 1, 0),
(46, 'CC', 'Cocos (Keeling) Islands', 1, 0),
(47, 'CO', 'Colombia', 1, 0),
(48, 'KM', 'Comoros', 1, 0),
(49, 'CG', 'Congo', 1, 0),
(50, 'CK', 'Cook Islands', 1, 0),
(51, 'CR', 'Costa Rica', 1, 0),
(52, 'HR', 'Croatia (Hrvatska)', 1, 0),
(53, 'CU', 'Cuba', 1, 0),
(54, 'CY', 'Cyprus', 1, 0),
(55, 'CZ', 'Czech Republic', 1, 0),
(56, 'DK', 'Denmark', 1, 0),
(57, 'DJ', 'Djibouti', 1, 0),
(58, 'DM', 'Dominica', 1, 0),
(59, 'DO', 'Dominican Republic', 1, 0),
(60, 'TP', 'East Timor', 1, 0),
(61, 'EC', 'Ecuador', 1, 0),
(62, 'EG', 'Egypt', 1, 0),
(63, 'SV', 'El Salvador', 1, 0),
(64, 'GQ', 'Equatorial Guinea', 1, 0),
(65, 'ER', 'Eritrea', 1, 0),
(66, 'EE', 'Estonia', 1, 0),
(67, 'ET', 'Ethiopia', 1, 0),
(68, 'FK', 'British Falkland Islands', 1, 6),
(69, 'FO', 'Faroe Islands', 1, 0),
(70, 'FJ', 'Fiji', 1, 0),
(71, 'FI', 'Finland', 1, 0),
(72, 'FR', 'France', 1, 0),
(73, 'FX', 'France, Metropolitan', 1, 0),
(74, 'GF', 'French Guiana', 1, 0),
(75, 'PF', 'French Polynesia', 1, 0),
(76, 'TF', 'French Southern Territories', 1, 0),
(77, 'GA', 'Gabon', 1, 0),
(78, 'GM', 'Gambia', 1, 0),
(79, 'GE', 'Georgia', 1, 0),
(80, 'DE', 'Germany', 1, 0),
(81, 'GH', 'Ghana', 1, 0),
(82, 'GI', 'Gibraltar', 1, 0),
(83, 'GK', 'Guernsey', 1, 0),
(84, 'GR', 'Greece', 1, 0),
(85, 'GL', 'Greenland', 1, 0),
(86, 'GD', 'Grenada', 1, 0),
(87, 'GP', 'Guadeloupe', 1, 0),
(88, 'GU', 'Guam', 1, 0),
(89, 'GT', 'Guatemala', 1, 0),
(90, 'GN', 'Guinea', 1, 0),
(91, 'GW', 'Guinea-Bissau', 1, 0),
(92, 'GY', 'Guyana', 1, 0),
(93, 'HT', 'Haiti', 1, 0),
(94, 'HM', 'Heard and Mc Donald Islands', 1, 0),
(95, 'HN', 'Honduras', 1, 0),
(96, 'HK', 'Hong Kong', 1, 0),
(97, 'HU', 'Hungary', 1, 0),
(98, 'IS', 'Iceland', 1, 0),
(99, 'IN', 'India', 1, 0),
(100, 'IM', 'Isle of Man', 1, 0),
(101, 'ID', 'Indonesia', 1, 0),
(102, 'IR', 'Iran (Islamic Republic of)', 1, 0),
(103, 'IQ', 'Iraq', 1, 0),
(104, 'IE', 'Ireland', 1, 0),
(105, 'IL', 'Israel', 1, 0),
(106, 'IT', 'Italy', 1, 0),
(107, 'CI', 'Ivory Coast', 1, 0),
(108, 'JE', 'Jersey', 1, 0),
(109, 'JM', 'Jamaica', 1, 0),
(110, 'JP', 'Japan', 1, 0),
(111, 'JO', 'Jordan', 1, 0),
(112, 'KZ', 'Kazakhstan', 1, 0),
(113, 'KE', 'Kenya', 1, 0),
(114, 'KI', 'Kiribati', 1, 0),
(115, 'KP', 'Korea, Democratic People\'s Republic of', 1, 0),
(116, 'KR', 'Korea, Republic of', 1, 0),
(117, 'XK', 'Kosovo', 1, 0),
(118, 'KW', 'Kuwait', 1, 0),
(119, 'KG', 'Kyrgyzstan', 1, 0),
(120, 'LA', 'Lao People\'s Democratic Republic', 1, 0),
(121, 'LV', 'Latvia', 1, 0),
(122, 'LB', 'Lebanon', 1, 0),
(123, 'LS', 'Lesotho', 1, 0),
(124, 'LR', 'Liberia', 1, 0),
(125, 'LY', 'Libyan Arab Jamahiriya', 1, 0),
(126, 'LI', 'Liechtenstein', 1, 0),
(127, 'LT', 'Lithuania', 1, 0),
(128, 'LU', 'Luxembourg', 1, 0),
(129, 'MO', 'Macau', 1, 0),
(130, 'MK', 'Macedonia', 1, 0),
(131, 'MG', 'Madagascar', 1, 0),
(132, 'MW', 'Malawi', 1, 0),
(133, 'MY', 'Malaysia', 1, 0),
(134, 'MV', 'Maldives', 1, 0),
(135, 'ML', 'Mali', 1, 0),
(136, 'MT', 'Malta', 1, 0),
(137, 'MH', 'Marshall Islands', 1, 0),
(138, 'MQ', 'Martinique', 1, 0),
(139, 'MR', 'Mauritania', 1, 0),
(140, 'MU', 'Mauritius', 1, 0),
(141, 'TY', 'Mayotte', 1, 0),
(142, 'MX', 'Mexico', 1, 0),
(143, 'FM', 'Micronesia, Federated States of', 1, 0),
(144, 'MD', 'Moldova, Republic of', 1, 0),
(145, 'MC', 'Monaco', 1, 0),
(146, 'MN', 'Mongolia', 1, 0),
(147, 'ME', 'Montenegro', 1, 0),
(148, 'MS', 'Montserrat', 1, 0),
(149, 'MA', 'Morocco', 1, 0),
(150, 'MZ', 'Mozambique', 1, 0),
(151, 'MM', 'Myanmar', 1, 0),
(152, 'NA', 'Namibia', 1, 0),
(153, 'NR', 'Nauru', 1, 0),
(154, 'NP', 'Nepal', 1, 0),
(155, 'NL', 'Netherlands', 1, 0),
(156, 'AN', 'Netherlands Antilles', 1, 0),
(157, 'NC', 'New Caledonia', 1, 0),
(158, 'NZ', 'New Zealand', 1, 4),
(159, 'NI', 'Nicaragua', 1, 0),
(160, 'NE', 'Niger', 1, 0),
(161, 'NG', 'Nigeria', 1, 0),
(162, 'NU', 'Niue', 1, 0),
(163, 'NF', 'Norfolk Island', 1, 0),
(164, 'MP', 'Northern Mariana Islands', 1, 0),
(165, 'NO', 'Norway', 1, 0),
(166, 'OM', 'Oman', 1, 0),
(167, 'PK', 'Pakistan', 1, 0),
(168, 'PW', 'Palau', 1, 0),
(169, 'PS', 'Palestine', 1, 0),
(170, 'PA', 'Panama', 1, 0),
(171, 'PG', 'Papua New Guinea', 1, 0),
(172, 'PY', 'Paraguay', 1, 0),
(173, 'PE', 'Peru', 1, 0),
(174, 'PH', 'Philippines', 1, 0),
(175, 'PN', 'Pitcairn', 1, 0),
(176, 'PL', 'Poland', 1, 0),
(177, 'PT', 'Portugal', 1, 0),
(178, 'PR', 'Puerto Rico', 1, 0),
(179, 'QA', 'Qatar', 1, 0),
(180, 'RE', 'Reunion', 1, 0),
(181, 'RO', 'Romania', 1, 0),
(182, 'RU', 'Russian Federation', 1, 0),
(183, 'RW', 'Rwanda', 1, 0),
(184, 'KN', 'Saint Kitts and Nevis', 1, 0),
(185, 'LC', 'Saint Lucia', 1, 0),
(186, 'VC', 'Saint Vincent and the Grenadines', 1, 0),
(187, 'WS', 'Samoa', 1, 0),
(188, 'SM', 'San Marino', 1, 0),
(189, 'ST', 'Sao Tome and Principe', 1, 0),
(190, 'SA', 'Saudi Arabia', 1, 0),
(191, 'SN', 'Senegal', 1, 0),
(192, 'RS', 'Serbia', 1, 0),
(193, 'SC', 'Seychelles', 1, 0),
(194, 'SL', 'Sierra Leone', 1, 0),
(195, 'SG', 'Singapore', 1, 0),
(196, 'SK', 'Slovakia', 1, 0),
(197, 'SI', 'Slovenia', 1, 0),
(198, 'SB', 'Solomon Islands', 1, 0),
(199, 'SO', 'Somalia', 1, 0),
(200, 'ZA', 'South Africa', 1, 0),
(201, 'GS', 'South Georgia South Sandwich Islands', 1, 0),
(202, 'ES', 'Spain', 1, 0),
(203, 'LK', 'Sri Lanka', 1, 0),
(204, 'SH', 'St. Helena', 1, 0),
(205, 'PM', 'St. Pierre and Miquelon', 1, 0),
(206, 'SD', 'Sudan', 1, 0),
(207, 'SR', 'Suriname', 1, 0),
(208, 'SJ', 'Svalbard and Jan Mayen Islands', 1, 0),
(209, 'SZ', 'Swaziland', 1, 0),
(210, 'SE', 'Sweden', 1, 0),
(211, 'CH', 'Switzerland', 1, 0),
(212, 'SY', 'Syrian Arab Republic', 1, 0),
(213, 'TW', 'Taiwan', 1, 0),
(214, 'TJ', 'Tajikistan', 1, 0),
(215, 'TZ', 'Tanzania, United Republic of', 1, 0),
(216, 'TH', 'Thailand', 1, 0),
(217, 'TG', 'Togo', 1, 0),
(218, 'TK', 'Tokelau', 1, 0),
(219, 'TO', 'Tonga', 1, 0),
(220, 'TT', 'Trinidad and Tobago', 1, 0),
(221, 'TN', 'Tunisia', 1, 0),
(222, 'TR', 'Turkey', 1, 0),
(223, 'TM', 'Turkmenistan', 1, 0),
(224, 'TC', 'Turks and Caicos Islands', 1, 0),
(225, 'TV', 'Tuvalu', 1, 0),
(226, 'UG', 'Uganda', 1, 0),
(227, 'UA', 'Ukraine', 1, 0),
(228, 'AE', 'United Arab Emirates', 1, 0),
(229, 'GB', 'United Kingdom', 1, 1),
(230, 'US', 'United States', 1, 5),
(231, 'UM', 'United States Minor Outlying Islands', 1, 0),
(232, 'UY', 'Uruguay', 1, 0),
(233, 'UZ', 'Uzbekistan', 1, 0),
(234, 'VU', 'Vanuatu', 1, 0),
(235, 'VA', 'Vatican City State', 1, 0),
(236, 'VE', 'Venezuela', 1, 0),
(237, 'VN', 'Vietnam', 1, 0),
(238, 'VG', 'Virgin Islands (British)', 1, 0),
(239, 'VI', 'Virgin Islands (U.S.)', 1, 0),
(240, 'WF', 'Wallis and Futuna Islands', 1, 0),
(241, 'EH', 'Western Sahara', 1, 0),
(242, 'YE', 'Yemen', 1, 0),
(243, 'ZR', 'Zaire', 1, 0),
(244, 'ZM', 'Zambia', 1, 0),
(245, 'ZW', 'Zimbabwe', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `everything_email_templates`
--

CREATE TABLE `everything_email_templates` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `template` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `notes` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `everything_email_templates`
--

INSERT INTO `everything_email_templates` (`id`, `name`, `subject`, `template`, `notes`, `type`, `status`) VALUES
(1, 'Password Reset', 'Password Reset', '<h1>Hi [USER_NAME]</h1>\r\n<br>Click here to reset your password! <a href=\"[RESET_URL]\">Reset Password!</a><br><small>Note: This URL will expire in 2 hour!</small>', NULL, 1, 1),
(2, 'Verify Account', 'Verify your Account', '<h1>Hi, [USER_NAME]</h1>\r\n<br>Verify your account <a href=\"[VERIFY_URL]\">Click here to verify!</a>', NULL, 2, 1),
(3, 'Re-Verify Account', 'Re-verify your Account', '<h1>Hi, [USER_NAME]</h1>\r\n<br>Re-Verify your account <a href=\"[VERIFY_URL]\">Click here to verify!</a>', NULL, 3, 1),
(4, 'Password Change', 'Your Password has changed!', '<h1>Hi, [USER_NAME]</h1>\r\n<p><br />Just to let you know, your password has been changed! If you did not do this, contact us ASAP!</p>', 'rrrr', 4, 1),
(5, 'Account Banned', 'Your account has been permanently banned!', '<h1>Hi, [USER_NAME]</h1>\r\n<br>Your account has been permanently banned for the following reason:<br>\r\n<b>[REASON]</b>', NULL, 5, 1),
(6, 'Account Banned Temp', 'Your account has been temporarily banned!', '<h1>Hi, [USER_NAME]</h1>\r\n<br>Just to let you know, your account has been temporarily banned until [BANNED_UNTIL]', NULL, 6, 1),
(7, 'Contact Enquiry', 'You have a new contact enquiry!', '<h1>Hi, Admin</h1>\r\n<br>From: [FORM_NAME]/[FORM_EMAIL] | Subject: [FORM_SUBJECT]<br>\r\n<p>[FORM_MESSAGE]</p>', NULL, 7, 1),
(8, 'User Contact Enquiry', 'A new message sent via your Profile!', '<h1>Hi, [USER_NAME]</h1><br><small>You have a new message sent via your profile. Reply as soon as possible!</small><hr>\r\n<br>From: [FORM_EMAIL]<BR>\r\n<p>[FORM_MESSAGE]</p>', NULL, 8, 1);

-- --------------------------------------------------------

--
-- Table structure for table `everything_sessions`
--

CREATE TABLE `everything_sessions` (
  `session_id` char(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `session_data` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `session_lastaccesstime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `everything_settings`
--

CREATE TABLE `everything_settings` (
  `id` int(11) NOT NULL,
  `global_company` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `global_logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `global_recaptchaon` int(11) NOT NULL DEFAULT '0',
  `global_recaptchasite` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `global_recaptchasecret` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `everything_settings`
--

INSERT INTO `everything_settings` (`id`, `global_company`, `global_logo`, `global_recaptchaon`, `global_recaptchasite`, `global_recaptchasecret`) VALUES
(1, 'Brand', NULL, 1, 'enter recaptcha site code', 'enter recaptcha secret code');

-- --------------------------------------------------------

--
-- Table structure for table `everything_users`
--

CREATE TABLE `everything_users` (
  `id` int(11) NOT NULL,
  `username` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fname` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lname` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `extra_security` int(11) NOT NULL DEFAULT '0',
  `extra_security_code` varchar(16) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created` datetime NOT NULL,
  `last_activity` datetime NOT NULL,
  `last_ip` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `verify_code` varchar(55) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `everything_users`
--

INSERT INTO `everything_users` (`id`, `username`, `email`, `password`, `pin`, `country`, `fname`, `lname`, `avatar`, `extra_security`, `extra_security_code`, `created`, `last_activity`, `last_ip`, `verify_code`, `notes`, `status`) VALUES
(1, 'admin', 'admin@admin.com', '$2y$10$cezJ3p6HPVPFoGPb4XASBOQyhC2s.MPEfEN3tKhzkfGvLT1XREWmi', '4825411546431396', 'GB', 'John', 'Doe', '', 0, '4NZDFDGD7WWWQ4J5', '2019-01-02 12:16:37', '2019-01-02 12:16:37', '::1', '22CjpRFNohtCZ3uWZFF55Ze1ykU55W82', NULL, 1),
(2, 'user', 'user@user.com', '$2y$10$cezJ3p6HPVPFoGPb4XASBOQyhC2s.MPEfEN3tKhzkfGvLT1XREWmi', '5949741546435152', 'GB', 'Jane', 'Doe', '', 0, 'OCVMBFALZD7KSXDK', '2019-01-02 13:19:12', '2019-01-02 13:19:12', '::1', 'B1bvF6C5vb50OnOhKPoDsbLxmpI9P64y', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `everything_users_settings`
--

CREATE TABLE `everything_users_settings` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_pin` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `everything_users_settings`
--

INSERT INTO `everything_users_settings` (`id`, `user_pin`) VALUES
(1, '4825411546431396'),
(2, '5949741546435152');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `everything_countries`
--
ALTER TABLE `everything_countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `everything_email_templates`
--
ALTER TABLE `everything_email_templates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `everything_sessions`
--
ALTER TABLE `everything_sessions`
  ADD PRIMARY KEY (`session_id`);

--
-- Indexes for table `everything_settings`
--
ALTER TABLE `everything_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `everything_users`
--
ALTER TABLE `everything_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `everything_users_settings`
--
ALTER TABLE `everything_users_settings`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `everything_countries`
--
ALTER TABLE `everything_countries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=246;

--
-- AUTO_INCREMENT for table `everything_email_templates`
--
ALTER TABLE `everything_email_templates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `everything_settings`
--
ALTER TABLE `everything_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `everything_users`
--
ALTER TABLE `everything_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `everything_users_settings`
--
ALTER TABLE `everything_users_settings`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
