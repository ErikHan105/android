-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 18, 2018 at 06:52 AM
-- Server version: 10.1.33-MariaDB
-- PHP Version: 7.2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `davidhood`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id` int(10) UNSIGNED NOT NULL,
  `ikey` varchar(256) CHARACTER SET utf8 NOT NULL,
  `ivalue` varchar(1024) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `ikey`, `ivalue`) VALUES
(1, 'date', '3479510000'),
(2, 'email', 'root'),
(3, 'password', 'root'),
(4, 'username', 'Billy'),
(5, 'photo', '000.png');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_advertise`
--

CREATE TABLE `tbl_advertise` (
  `id` int(10) UNSIGNED NOT NULL,
  `lang` varchar(10) CHARACTER SET utf8 NOT NULL,
  `title` varchar(256) CHARACTER SET utf8 NOT NULL,
  `description` varchar(1024) CHARACTER SET utf8 NOT NULL,
  `price` varchar(256) CHARACTER SET utf8 NOT NULL,
  `type` varchar(256) CHARACTER SET utf8 NOT NULL,
  `created` int(10) UNSIGNED NOT NULL,
  `deleted` int(1) UNSIGNED NOT NULL,
  `url` varchar(256) CHARACTER SET utf8 NOT NULL,
  `cnt` int(5) UNSIGNED NOT NULL,
  `question` varchar(1024) CHARACTER SET utf8 NOT NULL,
  `company_url` varchar(256) CHARACTER SET utf8 NOT NULL,
  `limits` int(10) UNSIGNED NOT NULL,
  `remains` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_advertise`
--

INSERT INTO `tbl_advertise` (`id`, `lang`, `title`, `description`, `price`, `type`, `created`, `deleted`, `url`, `cnt`, `question`, `company_url`, `limits`, `remains`) VALUES
(1, 'deutsch', 'Example Dummy video', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', '0.19', 'multi', 1497889342, 0, 'https://drive.google.com/open?id=0B9EClND00YIMMlNRZm5VWHkzQk0', 3, 'qq', 'https://android--code.blogspot.com/2015/05/android-textview-center-text.html', 10, 0),
(3, 'french', 'test', 'test', '0.1', 'once', 1531421236, 0, 'https://drive.google.com/open?id=0B9EClND00YIMMlNRZm5VWHkzQk0', 1, 'ew', 'https://google.com', 10, 8),
(6, 'deutsch', 'sample', 'bridge sample description', '0.1', 'once', 1531423104, 0, 'https://drive.google.com/open?id=1NWxm1elxoEt4jiguPR_7a1skBQjFx36Q', 1, '', 'https://android--code.blogspot.com/2015/05/android-textview-center-text.html', 10, 10),
(7, 'french', 'sample', 'sample description', '2.3', 'multi', 1531685884, 0, 'https://drive.google.com/open?id=10XU4UrmzLgqgm7MTQPVhyZ7y-3GymcU6', 1, '', 'https://mail.google.com/mail/u/0/#inbox', 10, 10),
(8, 'french', 'sd', 'er', '4.5', 'once', 1533480939, 0, 'https://drive.google.com/open?id=1e6pBBVZUzFh3GppFDnQivgVERlXtRAG5', 1, '', 'http://sd.com', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_answer`
--

CREATE TABLE `tbl_answer` (
  `id` int(10) UNSIGNED NOT NULL,
  `advertise_id` int(10) UNSIGNED NOT NULL,
  `answer` varchar(1024) CHARACTER SET utf8 NOT NULL,
  `isright` int(1) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_answer`
--

INSERT INTO `tbl_answer` (`id`, `advertise_id`, `answer`, `isright`) VALUES
(7, 3, 'q', 1),
(8, 3, 'qq', 1),
(15, 3, 'ee', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_gain_log`
--

CREATE TABLE `tbl_gain_log` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `price` varchar(256) CHARACTER SET utf8 NOT NULL,
  `created` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_log`
--

CREATE TABLE `tbl_log` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `advertise_id` int(10) UNSIGNED NOT NULL,
  `updated` int(10) UNSIGNED NOT NULL,
  `cnt` int(5) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_log`
--

INSERT INTO `tbl_log` (`id`, `user_id`, `advertise_id`, `updated`, `cnt`) VALUES
(2, 2, 1, 1531768978, 0),
(3, 2, 3, 1532201554, 0),
(4, 1, 3, 1531773441, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_purchase`
--

CREATE TABLE `tbl_purchase` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `price` varchar(256) CHARACTER SET utf8 NOT NULL,
  `updated` int(10) UNSIGNED NOT NULL,
  `status` int(1) UNSIGNED NOT NULL,
  `deleted` int(1) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_purchase`
--

INSERT INTO `tbl_purchase` (`id`, `user_id`, `price`, `updated`, `status`, `deleted`) VALUES
(3, 1, '11.3', 1531660265, 1, 0),
(4, 1, '3', 1531662212, 1, 0),
(5, 1, '2', 1531662423, 1, 0),
(6, 1, '0.2', 1531772684, 1, 0),
(7, 1, '0.3', 1531773004, 1, 0),
(8, 1, '0.2', 1531773210, 1, 0),
(9, 1, '0.08', 1532275334, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_question`
--

CREATE TABLE `tbl_question` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(256) CHARACTER SET utf8 NOT NULL,
  `subject` varchar(256) CHARACTER SET utf8 NOT NULL,
  `body` varchar(1024) CHARACTER SET utf8 NOT NULL,
  `created` int(10) UNSIGNED NOT NULL,
  `deleted` int(1) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id` int(10) UNSIGNED NOT NULL,
  `lang` varchar(10) CHARACTER SET utf8 NOT NULL,
  `first_name` varchar(256) CHARACTER SET utf8 NOT NULL,
  `last_name` varchar(256) CHARACTER SET utf8 NOT NULL,
  `email` varchar(256) CHARACTER SET utf8 NOT NULL,
  `password` varchar(256) CHARACTER SET utf8 NOT NULL,
  `birth_date` varchar(256) CHARACTER SET utf8 NOT NULL,
  `address` varchar(256) CHARACTER SET utf8 NOT NULL,
  `postal_code` varchar(256) CHARACTER SET utf8 NOT NULL,
  `city` varchar(1024) CHARACTER SET utf8 NOT NULL,
  `iban` varchar(256) CHARACTER SET utf8 NOT NULL,
  `price` varchar(256) CHARACTER SET utf8 NOT NULL,
  `paid` varchar(256) CHARACTER SET utf8 NOT NULL,
  `created` int(10) UNSIGNED NOT NULL,
  `deleted` int(1) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `lang`, `first_name`, `last_name`, `email`, `password`, `birth_date`, `address`, `postal_code`, `city`, `iban`, `price`, `paid`, `created`, `deleted`) VALUES
(1, 'french', 'Alex', 'Wang', 'test@test.com', 'test', '01/01/1994', 'No.2 holidsek street, Switzerland', '540000', 'test', 'CH-9789', '0', '17.38', 0, 1),
(2, 'deutsch', 'Bill', 'Kevin', 'kevin@test.com', 'ppp', '01/05/1992', 'No.3 holidsek street, Switzerland1', '540000', 'test', 'CH54 9789 7876 h869 9879 m', '1.35', '0', 0, 0),
(3, 'deutsch', 'ali@test.com', 'pier', 'ali@test.com', 'test', '21/05/1991', 'test address', '1234', 'test', 'CH1234', '6.5', '0', 1531627606, 1),
(4, 'deutsch', 'alipo@test.com', 'po', 'alipo@test.com', 'test', '21/05/1991', 'test address', '1234', 'test', 'CH1234', '0', '0', 1531627922, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_advertise`
--
ALTER TABLE `tbl_advertise`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_answer`
--
ALTER TABLE `tbl_answer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_gain_log`
--
ALTER TABLE `tbl_gain_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_log`
--
ALTER TABLE `tbl_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_purchase`
--
ALTER TABLE `tbl_purchase`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_question`
--
ALTER TABLE `tbl_question`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_advertise`
--
ALTER TABLE `tbl_advertise`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_answer`
--
ALTER TABLE `tbl_answer`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tbl_gain_log`
--
ALTER TABLE `tbl_gain_log`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_log`
--
ALTER TABLE `tbl_log`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_purchase`
--
ALTER TABLE `tbl_purchase`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_question`
--
ALTER TABLE `tbl_question`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
