-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 17, 2019 at 05:41 AM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `saferlife`
--

-- --------------------------------------------------------

--
-- Table structure for table `appearance`
--

CREATE TABLE `appearance` (
  `a` int(11) NOT NULL,
  `ad` int(11) NOT NULL,
  `adad` int(11) NOT NULL,
  `asdas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `auth_group`
--

CREATE TABLE `auth_group` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `auth_group_permissions`
--

CREATE TABLE `auth_group_permissions` (
  `id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `auth_permission`
--

CREATE TABLE `auth_permission` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `content_type_id` int(11) NOT NULL,
  `codename` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `auth_permission`
--

INSERT INTO `auth_permission` (`id`, `name`, `content_type_id`, `codename`) VALUES
(1, 'Can add log entry', 1, 'add_logentry'),
(2, 'Can change log entry', 1, 'change_logentry'),
(3, 'Can delete log entry', 1, 'delete_logentry'),
(4, 'Can view log entry', 1, 'view_logentry'),
(5, 'Can add permission', 2, 'add_permission'),
(6, 'Can change permission', 2, 'change_permission'),
(7, 'Can delete permission', 2, 'delete_permission'),
(8, 'Can view permission', 2, 'view_permission'),
(9, 'Can add group', 3, 'add_group'),
(10, 'Can change group', 3, 'change_group'),
(11, 'Can delete group', 3, 'delete_group'),
(12, 'Can view group', 3, 'view_group'),
(13, 'Can add user', 4, 'add_user'),
(14, 'Can change user', 4, 'change_user'),
(15, 'Can delete user', 4, 'delete_user'),
(16, 'Can view user', 4, 'view_user'),
(17, 'Can add content type', 5, 'add_contenttype'),
(18, 'Can change content type', 5, 'change_contenttype'),
(19, 'Can delete content type', 5, 'delete_contenttype'),
(20, 'Can view content type', 5, 'view_contenttype'),
(21, 'Can add session', 6, 'add_session'),
(22, 'Can change session', 6, 'change_session'),
(23, 'Can delete session', 6, 'delete_session'),
(24, 'Can view session', 6, 'view_session');

-- --------------------------------------------------------

--
-- Table structure for table `auth_user`
--

CREATE TABLE `auth_user` (
  `id` int(11) NOT NULL,
  `password` varchar(128) NOT NULL,
  `last_login` datetime(6) DEFAULT NULL,
  `is_superuser` tinyint(1) NOT NULL,
  `username` varchar(150) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(150) NOT NULL,
  `email` varchar(254) NOT NULL,
  `is_staff` tinyint(1) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `date_joined` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `auth_user_groups`
--

CREATE TABLE `auth_user_groups` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `auth_user_user_permissions`
--

CREATE TABLE `auth_user_user_permissions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `blacklist`
--

CREATE TABLE `blacklist` (
  `blacklist_ID` int(100) NOT NULL,
  `c_ID` int(11) NOT NULL,
  `p_ID` int(11) NOT NULL,
  `b_Date` date NOT NULL,
  `b_Time` time NOT NULL,
  `b_location` varchar(100) COLLATE ascii_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=ascii COLLATE=ascii_bin;

--
-- Dumping data for table `blacklist`
--

INSERT INTO `blacklist` (`blacklist_ID`, `c_ID`, `p_ID`, `b_Date`, `b_Time`, `b_location`) VALUES
(3, 1, 1, '2016-03-05', '03:25:00', 'Melbourne'),
(4, 0, 2, '2018-09-12', '04:30:00', 'St Albans'),
(5, 0, 1, '2019-05-15', '22:20:00', 'Springvale Shopping Center'),
(6, 0, 4, '2019-05-20', '16:18:00', '120 Spencer St, Melbourne'),
(7, 1, 1, '2019-11-11', '11:11:00', 'At Springvale'),
(8, 0, 5, '2012-12-12', '12:05:00', 'Hollywood'),
(9, 0, 5, '2019-06-16', '23:11:00', 'Brunswick West, Melbourne');

-- --------------------------------------------------------

--
-- Table structure for table `crime`
--

CREATE TABLE `crime` (
  `c_ID` int(11) NOT NULL,
  `c_name` varchar(100) COLLATE ascii_bin NOT NULL,
  `c_Level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=ascii COLLATE=ascii_bin;

--
-- Dumping data for table `crime`
--

INSERT INTO `crime` (`c_ID`, `c_name`, `c_Level`) VALUES
(0, 'rape', 2),
(1, 'Murder', 3);

-- --------------------------------------------------------

--
-- Table structure for table `django_admin_log`
--

CREATE TABLE `django_admin_log` (
  `id` int(11) NOT NULL,
  `action_time` datetime(6) NOT NULL,
  `object_id` longtext,
  `object_repr` varchar(200) NOT NULL,
  `action_flag` smallint(5) UNSIGNED NOT NULL,
  `change_message` longtext NOT NULL,
  `content_type_id` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `django_content_type`
--

CREATE TABLE `django_content_type` (
  `id` int(11) NOT NULL,
  `app_label` varchar(100) NOT NULL,
  `model` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `django_content_type`
--

INSERT INTO `django_content_type` (`id`, `app_label`, `model`) VALUES
(1, 'admin', 'logentry'),
(3, 'auth', 'group'),
(2, 'auth', 'permission'),
(4, 'auth', 'user'),
(5, 'contenttypes', 'contenttype'),
(6, 'sessions', 'session');

-- --------------------------------------------------------

--
-- Table structure for table `django_migrations`
--

CREATE TABLE `django_migrations` (
  `id` int(11) NOT NULL,
  `app` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `applied` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `django_migrations`
--

INSERT INTO `django_migrations` (`id`, `app`, `name`, `applied`) VALUES
(1, 'contenttypes', '0001_initial', '2019-04-13 09:25:20.338541'),
(2, 'auth', '0001_initial', '2019-04-13 09:25:21.527111'),
(3, 'admin', '0001_initial', '2019-04-13 09:25:29.620825'),
(4, 'admin', '0002_logentry_remove_auto_add', '2019-04-13 09:25:32.096349'),
(5, 'admin', '0003_logentry_add_action_flag_choices', '2019-04-13 09:25:32.157189'),
(6, 'contenttypes', '0002_remove_content_type_name', '2019-04-13 09:25:33.676054'),
(7, 'auth', '0002_alter_permission_name_max_length', '2019-04-13 09:25:34.605398'),
(8, 'auth', '0003_alter_user_email_max_length', '2019-04-13 09:25:35.548968'),
(9, 'auth', '0004_alter_user_username_opts', '2019-04-13 09:25:35.593849'),
(10, 'auth', '0005_alter_user_last_login_null', '2019-04-13 09:25:35.968263'),
(11, 'auth', '0006_require_contenttypes_0002', '2019-04-13 09:25:35.992727'),
(12, 'auth', '0007_alter_validators_add_error_messages', '2019-04-13 09:25:36.035770'),
(13, 'auth', '0008_alter_user_username_max_length', '2019-04-13 09:25:36.720708'),
(14, 'auth', '0009_alter_user_last_name_max_length', '2019-04-13 09:25:37.435118'),
(15, 'auth', '0010_alter_group_name_max_length', '2019-04-13 09:25:38.161868'),
(16, 'auth', '0011_update_proxy_permissions', '2019-04-13 09:25:38.349021'),
(17, 'sessions', '0001_initial', '2019-04-13 09:25:38.866327');

-- --------------------------------------------------------

--
-- Table structure for table `django_session`
--

CREATE TABLE `django_session` (
  `session_key` varchar(40) NOT NULL,
  `session_data` longtext NOT NULL,
  `expire_date` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `people`
--

CREATE TABLE `people` (
  `p_ID` int(5) NOT NULL,
  `p_Name` varchar(100) COLLATE ascii_bin DEFAULT NULL,
  `p_dob` date DEFAULT NULL,
  `p_address` varchar(100) COLLATE ascii_bin NOT NULL,
  `p_Note` varchar(500) COLLATE ascii_bin NOT NULL,
  `p_Images` varchar(10000) COLLATE ascii_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=ascii COLLATE=ascii_bin;

--
-- Dumping data for table `people`
--

INSERT INTO `people` (`p_ID`, `p_Name`, `p_dob`, `p_address`, `p_Note`, `p_Images`) VALUES
(1, 'Manh Huy Vo', '1997-06-20', '42 Myrtle St, Springvale', 'A really handsome Vietnamese hot boy', 'ManhHuyVo.jpg'),
(2, 'Saoud Nazir', '1997-04-07', '59 Athedlelas St Albans', 'Really dangerous, and enjoys killing people', 'SaoudNazir.jpg'),
(3, 'Barrack Obama', '1961-08-04', 'Kapiolani Medical Center for Women and Children', '44th President of The United State of America', 'BarrackObama.jpg'),
(4, 'Marcus Moraes', '1990-03-20', '29 Moreland Rd, Coburg VIC', 'This guy is tall and has a lot of beard', 'MarcusMoraes.jpg'),
(5, 'Will Smith', '1968-09-25', 'Calabasas, California, America', 'A really famous artist in Hollywood', 'WillSmith.jpg'),
(6, 'Tony Stark', '1962-05-12', 'Hollywood, America', 'The second richest superhero in Marvel', 'TonyStark.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `seen_history`
--

CREATE TABLE `seen_history` (
  `seen_ID` int(10) NOT NULL,
  `p_ID` int(10) NOT NULL,
  `seen_Date` date NOT NULL,
  `seen_Time` time(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `seen_history`
--

INSERT INTO `seen_history` (`seen_ID`, `p_ID`, `seen_Date`, `seen_Time`) VALUES
(1, 1, '2019-06-12', '11:15:55.000000'),
(2, 1, '2019-06-12', '11:15:58.000000'),
(3, 1, '2019-06-12', '11:16:17.000000'),
(4, 1, '2019-06-12', '11:16:19.000000'),
(5, 1, '2019-06-12', '11:18:27.000000'),
(6, 1, '2019-06-12', '11:18:29.000000'),
(7, 1, '2019-06-12', '11:18:31.000000'),
(8, 1, '2019-06-12', '11:22:04.000000'),
(9, 1, '2019-06-12', '11:22:06.000000'),
(10, 1, '2019-06-12', '11:22:11.000000'),
(11, 1, '2019-06-12', '11:22:19.000000'),
(12, 1, '2019-06-12', '11:22:21.000000'),
(13, 1, '2019-06-12', '11:22:22.000000'),
(14, 1, '2019-06-12', '11:22:26.000000'),
(15, 1, '2019-06-12', '11:22:29.000000'),
(16, 1, '2019-06-12', '11:40:51.000000'),
(17, 1, '2019-06-12', '11:52:37.000000'),
(18, 1, '2019-06-12', '12:23:27.000000'),
(19, 1, '2019-06-12', '12:26:03.000000'),
(20, 1, '2019-06-12', '12:26:04.000000'),
(21, 1, '2019-06-12', '12:26:05.000000'),
(22, 1, '2019-06-12', '12:26:07.000000'),
(23, 1, '2019-06-12', '12:26:48.000000'),
(24, 1, '2019-06-12', '12:28:54.000000'),
(25, 1, '2019-06-12', '12:31:32.000000'),
(26, 1, '2019-06-12', '12:34:54.000000'),
(27, 1, '2019-06-12', '12:36:15.000000'),
(28, 1, '2019-06-14', '02:16:02.000000'),
(29, 1, '2019-06-14', '02:18:48.000000'),
(30, 2, '2019-06-14', '02:19:28.000000'),
(31, 1, '2019-06-15', '01:50:54.000000'),
(32, 1, '2019-06-15', '02:02:00.000000'),
(33, 1, '2019-06-15', '02:25:44.000000'),
(34, 1, '2019-06-15', '02:29:03.000000'),
(35, 1, '2019-06-15', '03:19:40.000000'),
(36, 2, '2019-06-15', '03:20:20.000000'),
(37, 2, '2019-06-15', '03:24:34.000000'),
(38, 1, '2019-06-15', '03:24:43.000000'),
(39, 2, '2019-06-15', '03:27:44.000000'),
(40, 2, '2019-06-15', '03:29:00.000000'),
(41, 1, '2019-06-15', '03:29:58.000000'),
(42, 1, '2019-06-15', '03:55:07.000000'),
(43, 2, '2019-06-15', '03:56:30.000000'),
(44, 1, '2019-06-15', '03:58:44.000000'),
(45, 2, '2019-06-15', '04:00:34.000000'),
(46, 1, '2019-06-15', '04:06:21.000000'),
(47, 1, '2019-06-15', '04:06:40.000000'),
(48, 1, '2019-06-15', '04:08:27.000000'),
(49, 1, '2019-06-15', '04:10:56.000000'),
(50, 1, '2019-06-15', '04:11:03.000000'),
(51, 1, '2019-06-15', '04:11:07.000000'),
(52, 1, '2019-06-15', '04:15:32.000000'),
(53, 1, '2019-06-15', '04:17:40.000000'),
(54, 1, '2019-06-15', '04:39:31.000000'),
(55, 1, '2019-06-15', '04:42:19.000000'),
(56, 1, '2019-06-15', '04:44:13.000000'),
(57, 1, '2019-06-15', '04:46:16.000000'),
(58, 1, '2019-06-15', '04:47:12.000000'),
(59, 2, '2019-06-15', '04:48:09.000000'),
(60, 1, '2019-06-15', '04:52:23.000000'),
(61, 1, '2019-06-15', '04:53:17.000000'),
(62, 2, '2019-06-15', '04:53:53.000000'),
(63, 1, '2019-06-15', '04:56:32.000000'),
(64, 1, '2019-06-15', '04:59:24.000000'),
(65, 1, '2019-06-15', '05:00:19.000000'),
(66, 2, '2019-06-15', '05:00:32.000000'),
(67, 1, '2019-06-15', '05:04:18.000000'),
(68, 1, '2019-06-16', '12:36:17.000000'),
(69, 1, '2019-06-16', '12:37:00.000000'),
(70, 1, '2019-06-16', '12:40:15.000000'),
(71, 2, '2019-06-16', '12:59:08.000000'),
(72, 2, '2019-06-16', '01:00:00.000000'),
(73, 1, '2019-06-16', '01:00:21.000000'),
(74, 2, '2019-06-16', '01:14:16.000000'),
(75, 2, '2019-06-16', '01:15:26.000000'),
(76, 1, '2019-06-16', '01:16:15.000000'),
(77, 2, '2019-06-16', '01:44:38.000000'),
(78, 2, '2019-06-16', '01:45:56.000000'),
(79, 2, '2019-06-16', '01:46:53.000000'),
(80, 2, '2019-06-16', '01:47:51.000000'),
(81, 1, '2019-06-16', '01:48:18.000000'),
(82, 2, '2019-06-16', '01:57:54.000000'),
(83, 2, '2019-06-16', '02:00:52.000000'),
(84, 2, '2019-06-16', '02:01:48.000000'),
(85, 2, '2019-06-16', '02:07:02.000000'),
(86, 1, '2019-06-16', '05:30:18.000000'),
(87, 2, '2019-06-16', '05:31:07.000000'),
(88, 2, '2019-06-16', '05:33:41.000000'),
(89, 2, '2019-06-16', '05:35:27.000000'),
(90, 1, '2019-06-16', '05:36:17.000000'),
(91, 2, '2019-06-16', '05:37:09.000000'),
(92, 2, '2019-06-16', '05:45:42.000000'),
(93, 2, '2019-06-16', '05:48:44.000000'),
(94, 2, '2019-06-16', '05:51:29.000000'),
(95, 1, '2019-06-16', '05:53:26.000000'),
(96, 1, '2019-06-16', '05:54:54.000000'),
(97, 1, '2019-06-16', '06:02:08.000000'),
(98, 1, '2019-06-16', '06:10:02.000000'),
(99, 1, '2019-06-16', '06:17:40.000000'),
(100, 1, '2019-06-17', '10:43:49.000000'),
(101, 1, '2019-06-17', '10:44:31.000000'),
(102, 1, '2019-06-17', '10:50:42.000000'),
(103, 1, '2019-06-17', '10:56:07.000000'),
(104, 1, '2019-06-17', '10:56:24.000000'),
(105, 1, '2019-06-17', '11:02:07.000000'),
(106, 1, '2019-06-17', '11:02:18.000000'),
(107, 1, '2019-06-17', '11:02:32.000000'),
(108, 1, '2019-06-17', '11:02:36.000000'),
(109, 1, '2019-06-17', '11:03:37.000000'),
(110, 1, '2019-06-17', '11:03:44.000000'),
(111, 1, '2019-06-17', '11:03:46.000000'),
(112, 2, '2019-06-17', '11:04:19.000000'),
(113, 1, '2019-06-17', '11:07:08.000000'),
(114, 1, '2019-06-17', '11:09:24.000000'),
(115, 2, '2019-06-17', '11:10:18.000000'),
(116, 1, '2019-06-17', '11:12:52.000000'),
(117, 1, '2019-06-17', '11:17:27.000000'),
(118, 1, '2019-06-17', '11:18:01.000000'),
(119, 1, '2019-06-17', '11:19:07.000000'),
(120, 1, '2019-06-17', '11:19:08.000000'),
(121, 1, '2019-06-17', '11:19:13.000000'),
(122, 1, '2019-06-17', '11:20:41.000000'),
(123, 1, '2019-06-17', '11:21:05.000000'),
(124, 1, '2019-06-17', '01:34:15.000000'),
(125, 1, '2019-06-17', '01:36:47.000000');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `u_ID` int(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `u_Password` varchar(100) NOT NULL,
  `u_FirstName` varchar(100) NOT NULL,
  `u_LastName` varchar(100) NOT NULL,
  `u_DOB` date NOT NULL,
  `u_Phone` int(100) NOT NULL,
  `u_Email` varchar(100) NOT NULL,
  `u_Address` varchar(100) NOT NULL,
  `u_level` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`u_ID`, `username`, `u_Password`, `u_FirstName`, `u_LastName`, `u_DOB`, `u_Phone`, `u_Email`, `u_Address`, `u_level`) VALUES
(1, 'manhhuyvo', 'huy123', 'Manh Huy', 'Vo', '1997-06-20', 452597206, 'manhhuyvo@gmail.com', '42 Myrtle ST, Noble Park VIC 3174', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auth_group`
--
ALTER TABLE `auth_group`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `auth_group_permissions`
--
ALTER TABLE `auth_group_permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `auth_group_permissions_group_id_permission_id_0cd325b0_uniq` (`group_id`,`permission_id`),
  ADD KEY `auth_group_permissio_permission_id_84c5c92e_fk_auth_perm` (`permission_id`);

--
-- Indexes for table `auth_permission`
--
ALTER TABLE `auth_permission`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `auth_permission_content_type_id_codename_01ab375a_uniq` (`content_type_id`,`codename`);

--
-- Indexes for table `auth_user`
--
ALTER TABLE `auth_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `auth_user_groups`
--
ALTER TABLE `auth_user_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `auth_user_groups_user_id_group_id_94350c0c_uniq` (`user_id`,`group_id`),
  ADD KEY `auth_user_groups_group_id_97559544_fk_auth_group_id` (`group_id`);

--
-- Indexes for table `auth_user_user_permissions`
--
ALTER TABLE `auth_user_user_permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `auth_user_user_permissions_user_id_permission_id_14a6b632_uniq` (`user_id`,`permission_id`),
  ADD KEY `auth_user_user_permi_permission_id_1fbb5f2c_fk_auth_perm` (`permission_id`);

--
-- Indexes for table `blacklist`
--
ALTER TABLE `blacklist`
  ADD PRIMARY KEY (`blacklist_ID`),
  ADD KEY `c_ID` (`c_ID`),
  ADD KEY `p_ID` (`p_ID`);

--
-- Indexes for table `crime`
--
ALTER TABLE `crime`
  ADD PRIMARY KEY (`c_ID`);

--
-- Indexes for table `django_admin_log`
--
ALTER TABLE `django_admin_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `django_admin_log_content_type_id_c4bce8eb_fk_django_co` (`content_type_id`),
  ADD KEY `django_admin_log_user_id_c564eba6_fk_auth_user_id` (`user_id`);

--
-- Indexes for table `django_content_type`
--
ALTER TABLE `django_content_type`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `django_content_type_app_label_model_76bd3d3b_uniq` (`app_label`,`model`);

--
-- Indexes for table `django_migrations`
--
ALTER TABLE `django_migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `django_session`
--
ALTER TABLE `django_session`
  ADD PRIMARY KEY (`session_key`),
  ADD KEY `django_session_expire_date_a5c62663` (`expire_date`);

--
-- Indexes for table `people`
--
ALTER TABLE `people`
  ADD PRIMARY KEY (`p_ID`);

--
-- Indexes for table `seen_history`
--
ALTER TABLE `seen_history`
  ADD PRIMARY KEY (`seen_ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`u_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `auth_group`
--
ALTER TABLE `auth_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `auth_group_permissions`
--
ALTER TABLE `auth_group_permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `auth_permission`
--
ALTER TABLE `auth_permission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `auth_user`
--
ALTER TABLE `auth_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `auth_user_groups`
--
ALTER TABLE `auth_user_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `auth_user_user_permissions`
--
ALTER TABLE `auth_user_user_permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blacklist`
--
ALTER TABLE `blacklist`
  MODIFY `blacklist_ID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `django_admin_log`
--
ALTER TABLE `django_admin_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `django_content_type`
--
ALTER TABLE `django_content_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `django_migrations`
--
ALTER TABLE `django_migrations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `people`
--
ALTER TABLE `people`
  MODIFY `p_ID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `seen_history`
--
ALTER TABLE `seen_history`
  MODIFY `seen_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=126;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `u_ID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `auth_group_permissions`
--
ALTER TABLE `auth_group_permissions`
  ADD CONSTRAINT `auth_group_permissio_permission_id_84c5c92e_fk_auth_perm` FOREIGN KEY (`permission_id`) REFERENCES `auth_permission` (`id`),
  ADD CONSTRAINT `auth_group_permissions_group_id_b120cbf9_fk_auth_group_id` FOREIGN KEY (`group_id`) REFERENCES `auth_group` (`id`);

--
-- Constraints for table `auth_permission`
--
ALTER TABLE `auth_permission`
  ADD CONSTRAINT `auth_permission_content_type_id_2f476e4b_fk_django_co` FOREIGN KEY (`content_type_id`) REFERENCES `django_content_type` (`id`);

--
-- Constraints for table `auth_user_groups`
--
ALTER TABLE `auth_user_groups`
  ADD CONSTRAINT `auth_user_groups_group_id_97559544_fk_auth_group_id` FOREIGN KEY (`group_id`) REFERENCES `auth_group` (`id`),
  ADD CONSTRAINT `auth_user_groups_user_id_6a12ed8b_fk_auth_user_id` FOREIGN KEY (`user_id`) REFERENCES `auth_user` (`id`);

--
-- Constraints for table `auth_user_user_permissions`
--
ALTER TABLE `auth_user_user_permissions`
  ADD CONSTRAINT `auth_user_user_permi_permission_id_1fbb5f2c_fk_auth_perm` FOREIGN KEY (`permission_id`) REFERENCES `auth_permission` (`id`),
  ADD CONSTRAINT `auth_user_user_permissions_user_id_a95ead1b_fk_auth_user_id` FOREIGN KEY (`user_id`) REFERENCES `auth_user` (`id`);

--
-- Constraints for table `blacklist`
--
ALTER TABLE `blacklist`
  ADD CONSTRAINT `c_ID` FOREIGN KEY (`c_ID`) REFERENCES `crime` (`c_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `p_ID` FOREIGN KEY (`p_ID`) REFERENCES `people` (`p_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `django_admin_log`
--
ALTER TABLE `django_admin_log`
  ADD CONSTRAINT `django_admin_log_content_type_id_c4bce8eb_fk_django_co` FOREIGN KEY (`content_type_id`) REFERENCES `django_content_type` (`id`),
  ADD CONSTRAINT `django_admin_log_user_id_c564eba6_fk_auth_user_id` FOREIGN KEY (`user_id`) REFERENCES `auth_user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
