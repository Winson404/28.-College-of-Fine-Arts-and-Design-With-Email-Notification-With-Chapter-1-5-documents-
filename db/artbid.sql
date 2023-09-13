-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 19, 2023 at 05:20 AM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `artbid`
--

-- --------------------------------------------------------

--
-- Table structure for table `announcement`
--

CREATE TABLE IF NOT EXISTS `announcement` (
`actId` int(11) NOT NULL,
  `actName` text NOT NULL,
  `actDate` varchar(20) NOT NULL,
  `date_added` varchar(20) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `announcement`
--

INSERT INTO `announcement` (`actId`, `actName`, `actDate`, `date_added`) VALUES
(2, 'Activity 5', '2022-12-23', ''),
(3, 'Activity 3', '2022-12-10', '2022-12-11'),
(4, 'Activity 2', '2022-12-11', '2022-12-11'),
(5, 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Rem, ipsum delectus voluptatum? Molestias aut inventore eaque, maxime numquam dignissimos asperiores, voluptatibus consectetur distinctio excepturi odit architecto, saepe enim sunt, molestiae.', '2022-12-11', '2022-12-11'),
(6, 'sample', '2022-12-27', '2022-12-27'),
(8, 'gfdgfd', '2023-01-06', '2022-12-27'),
(9, 'Announcement sample', '2023-01-09', '2023-01-16'),
(10, 'SAMple', '2023-01-24', '2023-01-16'),
(11, 'yhfng', '2023-02-13', '2023-02-05');

-- --------------------------------------------------------

--
-- Table structure for table `bidding`
--

CREATE TABLE IF NOT EXISTS `bidding` (
`bidding_Id` int(11) NOT NULL,
  `user_Id` int(11) NOT NULL,
  `product_Id` int(11) NOT NULL,
  `bidding_price` int(11) NOT NULL,
  `bidding_status` int(11) NOT NULL DEFAULT '0' COMMENT '0=Bidded, 1=Win, 2=Loss',
  `payment` int(11) NOT NULL DEFAULT '0' COMMENT '0=Pending, 1=Paid, 2=Payment Confirmed',
  `payment_proof` varchar(255) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=38 ;

--
-- Dumping data for table `bidding`
--

INSERT INTO `bidding` (`bidding_Id`, `user_Id`, `product_Id`, `bidding_price`, `bidding_status`, `payment`, `payment_proof`, `date_added`) VALUES
(30, 67, 46, 1200, 1, 0, '', '2023-06-16 10:05:37'),
(31, 67, 72, 400, 0, 0, '', '2023-04-27 14:59:51'),
(32, 72, 51, 1300, 0, 0, '', '2023-06-16 04:57:17'),
(33, 72, 49, 600, 0, 0, '', '2023-06-16 10:19:43'),
(34, 67, 54, 1900, 0, 0, '', '2023-06-16 05:00:17'),
(35, 67, 49, 18500, 0, 0, '', '2023-06-16 10:19:24'),
(36, 75, 49, 18000, 0, 0, '', '2023-06-16 10:19:40'),
(37, 75, 49, 19000, 0, 0, '', '2023-06-16 10:19:18');

-- --------------------------------------------------------

--
-- Table structure for table `bidding_winner`
--

CREATE TABLE IF NOT EXISTS `bidding_winner` (
`winner_Id` int(11) NOT NULL,
  `user_Id` int(11) NOT NULL,
  `product_Id` int(11) NOT NULL,
  `date_won` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=242 ;

--
-- Dumping data for table `bidding_winner`
--

INSERT INTO `bidding_winner` (`winner_Id`, `user_Id`, `product_Id`, `date_won`) VALUES
(11, 72, 47, '2023-04-27 16:36:01'),
(12, 72, 47, '2023-06-16 04:23:09'),
(13, 72, 47, '2023-06-16 04:23:18'),
(14, 72, 47, '2023-06-16 04:23:27'),
(15, 72, 47, '2023-06-16 04:23:36'),
(16, 72, 47, '2023-06-16 04:23:43'),
(17, 72, 47, '2023-06-16 04:23:44'),
(18, 72, 47, '2023-06-16 04:23:45'),
(19, 72, 47, '2023-06-16 04:23:48'),
(20, 72, 47, '2023-06-16 04:23:57'),
(21, 72, 47, '2023-06-16 04:24:06'),
(22, 72, 47, '2023-06-16 04:24:17'),
(23, 72, 47, '2023-06-16 04:24:19'),
(24, 72, 47, '2023-06-16 04:24:28'),
(25, 72, 47, '2023-06-16 04:24:36'),
(26, 72, 47, '2023-06-16 04:24:44'),
(27, 72, 47, '2023-06-16 04:24:47'),
(28, 72, 47, '2023-06-16 04:24:49'),
(29, 72, 47, '2023-06-16 04:24:53'),
(30, 72, 47, '2023-06-16 04:24:54'),
(31, 72, 47, '2023-06-16 04:24:55'),
(32, 72, 47, '2023-06-16 04:24:56'),
(33, 72, 47, '2023-06-16 04:24:57'),
(34, 72, 47, '2023-06-16 04:25:06'),
(35, 72, 47, '2023-06-16 04:25:15'),
(36, 72, 47, '2023-06-16 04:25:24'),
(37, 72, 47, '2023-06-16 04:25:27'),
(38, 72, 47, '2023-06-16 04:25:27'),
(39, 72, 47, '2023-06-16 04:25:37'),
(40, 72, 47, '2023-06-16 04:25:46'),
(41, 72, 47, '2023-06-16 04:25:55'),
(42, 72, 47, '2023-06-16 04:25:57'),
(43, 72, 47, '2023-06-16 04:25:58'),
(44, 72, 47, '2023-06-16 04:26:06'),
(45, 72, 47, '2023-06-16 04:26:11'),
(46, 72, 47, '2023-06-16 04:26:12'),
(47, 72, 47, '2023-06-16 04:26:13'),
(48, 72, 47, '2023-06-16 04:26:14'),
(49, 72, 47, '2023-06-16 04:26:15'),
(50, 72, 47, '2023-06-16 04:26:16'),
(51, 72, 47, '2023-06-16 04:27:23'),
(52, 72, 47, '2023-06-16 04:27:32'),
(53, 72, 47, '2023-06-16 04:27:41'),
(54, 72, 47, '2023-06-16 04:27:50'),
(55, 72, 47, '2023-06-16 04:27:56'),
(56, 72, 47, '2023-06-16 04:27:57'),
(57, 72, 47, '2023-06-16 04:27:59'),
(58, 72, 47, '2023-06-16 04:28:02'),
(59, 72, 47, '2023-06-16 04:28:11'),
(60, 72, 47, '2023-06-16 04:28:20'),
(61, 72, 47, '2023-06-16 04:28:26'),
(62, 72, 47, '2023-06-16 04:28:27'),
(63, 72, 47, '2023-06-16 04:28:29'),
(64, 72, 47, '2023-06-16 04:28:32'),
(65, 72, 47, '2023-06-16 04:28:41'),
(66, 72, 47, '2023-06-16 04:28:50'),
(67, 72, 47, '2023-06-16 04:28:57'),
(68, 72, 47, '2023-06-16 04:28:57'),
(69, 72, 47, '2023-06-16 04:28:59'),
(70, 72, 47, '2023-06-16 04:29:03'),
(71, 72, 47, '2023-06-16 04:29:11'),
(72, 72, 47, '2023-06-16 04:29:15'),
(73, 72, 47, '2023-06-16 04:29:16'),
(74, 72, 47, '2023-06-16 04:29:17'),
(75, 72, 47, '2023-06-16 04:29:18'),
(76, 72, 47, '2023-06-16 04:29:19'),
(77, 72, 47, '2023-06-16 04:29:21'),
(78, 72, 47, '2023-06-16 04:29:30'),
(79, 72, 47, '2023-06-16 04:29:39'),
(80, 72, 47, '2023-06-16 04:29:48'),
(81, 72, 47, '2023-06-16 04:29:50'),
(82, 72, 47, '2023-06-16 04:30:33'),
(83, 72, 47, '2023-06-16 04:30:43'),
(84, 72, 47, '2023-06-16 04:30:52'),
(85, 72, 47, '2023-06-16 04:31:02'),
(86, 72, 47, '2023-06-16 04:31:06'),
(87, 72, 47, '2023-06-16 04:31:07'),
(88, 72, 47, '2023-06-16 04:31:09'),
(89, 72, 47, '2023-06-16 04:31:13'),
(90, 72, 47, '2023-06-16 04:31:23'),
(91, 72, 47, '2023-06-16 04:31:31'),
(92, 72, 47, '2023-06-16 04:31:36'),
(93, 72, 47, '2023-06-16 04:31:38'),
(94, 72, 47, '2023-06-16 04:31:39'),
(95, 72, 47, '2023-06-16 04:31:44'),
(96, 72, 47, '2023-06-16 04:31:53'),
(97, 72, 47, '2023-06-16 04:32:01'),
(98, 72, 47, '2023-06-16 04:32:07'),
(99, 72, 47, '2023-06-16 04:32:08'),
(100, 72, 47, '2023-06-16 04:32:09'),
(101, 72, 47, '2023-06-16 04:32:14'),
(102, 72, 47, '2023-06-16 04:32:22'),
(103, 72, 47, '2023-06-16 04:32:31'),
(104, 72, 47, '2023-06-16 04:32:37'),
(105, 72, 47, '2023-06-16 04:32:38'),
(106, 72, 47, '2023-06-16 04:32:40'),
(107, 72, 47, '2023-06-16 04:32:44'),
(108, 72, 47, '2023-06-16 04:32:53'),
(109, 72, 47, '2023-06-16 04:33:02'),
(110, 72, 47, '2023-06-16 04:33:07'),
(111, 72, 47, '2023-06-16 04:33:08'),
(112, 72, 47, '2023-06-16 04:33:10'),
(113, 72, 47, '2023-06-16 04:33:14'),
(114, 72, 47, '2023-06-16 04:33:15'),
(115, 72, 47, '2023-06-16 04:33:15'),
(116, 72, 47, '2023-06-16 04:33:17'),
(117, 72, 47, '2023-06-16 04:33:17'),
(118, 72, 47, '2023-06-16 04:33:19'),
(119, 72, 47, '2023-06-16 04:33:20'),
(120, 72, 47, '2023-06-16 04:33:28'),
(121, 72, 47, '2023-06-16 04:33:38'),
(122, 72, 47, '2023-06-16 04:35:43'),
(123, 72, 47, '2023-06-16 04:35:52'),
(124, 72, 47, '2023-06-16 04:36:01'),
(125, 72, 47, '2023-06-16 04:36:10'),
(126, 72, 47, '2023-06-16 04:36:17'),
(127, 72, 47, '2023-06-16 04:36:19'),
(128, 72, 47, '2023-06-16 04:36:22'),
(129, 72, 47, '2023-06-16 04:36:26'),
(130, 72, 47, '2023-06-16 04:36:31'),
(131, 72, 47, '2023-06-16 04:36:40'),
(132, 72, 47, '2023-06-16 04:36:48'),
(133, 72, 47, '2023-06-16 04:36:50'),
(134, 72, 47, '2023-06-16 04:36:52'),
(135, 72, 47, '2023-06-16 04:36:54'),
(136, 72, 47, '2023-06-16 04:36:55'),
(137, 72, 47, '2023-06-16 04:36:56'),
(138, 72, 47, '2023-06-16 04:36:57'),
(139, 72, 47, '2023-06-16 04:36:58'),
(140, 72, 47, '2023-06-16 04:37:08'),
(141, 72, 47, '2023-06-16 04:37:16'),
(142, 72, 47, '2023-06-16 04:37:26'),
(143, 72, 47, '2023-06-16 04:37:35'),
(144, 72, 47, '2023-06-16 04:37:44'),
(145, 72, 47, '2023-06-16 04:37:53'),
(146, 72, 47, '2023-06-16 04:37:59'),
(147, 72, 47, '2023-06-16 04:38:01'),
(148, 72, 47, '2023-06-16 04:38:05'),
(149, 72, 47, '2023-06-16 04:38:14'),
(150, 72, 47, '2023-06-16 04:38:23'),
(151, 72, 47, '2023-06-16 04:38:29'),
(152, 72, 47, '2023-06-16 04:38:31'),
(153, 72, 47, '2023-06-16 04:38:35'),
(154, 72, 47, '2023-06-16 04:38:44'),
(155, 72, 47, '2023-06-16 04:38:53'),
(156, 72, 47, '2023-06-16 04:38:59'),
(157, 72, 47, '2023-06-16 04:39:01'),
(158, 72, 47, '2023-06-16 04:39:05'),
(159, 72, 47, '2023-06-16 04:39:14'),
(160, 72, 47, '2023-06-16 04:39:24'),
(161, 72, 47, '2023-06-16 04:39:29'),
(162, 72, 47, '2023-06-16 04:39:31'),
(163, 72, 47, '2023-06-16 04:39:36'),
(164, 72, 47, '2023-06-16 04:39:44'),
(165, 72, 47, '2023-06-16 04:39:53'),
(166, 72, 47, '2023-06-16 04:39:59'),
(167, 72, 47, '2023-06-16 04:40:02'),
(168, 72, 47, '2023-06-16 04:40:06'),
(169, 72, 47, '2023-06-16 04:40:14'),
(170, 72, 47, '2023-06-16 04:40:23'),
(171, 72, 47, '2023-06-16 04:40:29'),
(172, 72, 47, '2023-06-16 04:40:33'),
(173, 72, 47, '2023-06-16 04:40:36'),
(174, 72, 47, '2023-06-16 04:40:44'),
(175, 72, 47, '2023-06-16 04:40:54'),
(176, 72, 47, '2023-06-16 04:41:00'),
(177, 72, 47, '2023-06-16 04:41:03'),
(178, 72, 47, '2023-06-16 04:41:06'),
(179, 72, 47, '2023-06-16 04:41:15'),
(180, 72, 47, '2023-06-16 04:41:23'),
(181, 72, 47, '2023-06-16 04:41:30'),
(182, 72, 47, '2023-06-16 04:41:33'),
(183, 72, 47, '2023-06-16 04:41:36'),
(184, 72, 47, '2023-06-16 04:41:44'),
(185, 72, 47, '2023-06-16 04:41:53'),
(186, 72, 47, '2023-06-16 04:42:00'),
(187, 72, 47, '2023-06-16 04:42:03'),
(188, 72, 47, '2023-06-16 04:42:06'),
(189, 72, 47, '2023-06-16 04:42:15'),
(190, 72, 47, '2023-06-16 04:42:23'),
(191, 72, 47, '2023-06-16 04:42:30'),
(192, 72, 47, '2023-06-16 04:42:33'),
(193, 72, 47, '2023-06-16 04:42:36'),
(194, 72, 47, '2023-06-16 04:42:44'),
(195, 72, 47, '2023-06-16 04:42:54'),
(196, 72, 47, '2023-06-16 04:43:01'),
(197, 72, 47, '2023-06-16 04:43:04'),
(198, 72, 47, '2023-06-16 04:43:06'),
(199, 72, 47, '2023-06-16 04:43:15'),
(200, 72, 47, '2023-06-16 04:43:24'),
(201, 72, 47, '2023-06-16 04:43:31'),
(202, 72, 47, '2023-06-16 04:43:34'),
(203, 72, 47, '2023-06-16 04:43:37'),
(204, 72, 47, '2023-06-16 04:43:45'),
(205, 72, 47, '2023-06-16 04:43:54'),
(206, 72, 47, '2023-06-16 04:44:01'),
(207, 72, 47, '2023-06-16 04:44:04'),
(208, 72, 47, '2023-06-16 04:44:07'),
(209, 72, 47, '2023-06-16 04:44:16'),
(210, 75, 49, '2023-06-16 10:08:00'),
(211, 75, 49, '2023-06-16 10:08:00'),
(212, 75, 49, '2023-06-16 10:08:09'),
(213, 75, 49, '2023-06-16 10:08:17'),
(214, 75, 49, '2023-06-16 10:08:28'),
(215, 75, 49, '2023-06-16 10:08:34'),
(216, 75, 49, '2023-06-16 10:08:34'),
(217, 75, 49, '2023-06-16 10:08:35'),
(218, 75, 49, '2023-06-16 10:08:39'),
(219, 75, 49, '2023-06-16 10:08:47'),
(220, 75, 49, '2023-06-16 10:08:56'),
(221, 75, 49, '2023-06-16 10:09:04'),
(222, 75, 49, '2023-06-16 10:09:04'),
(223, 75, 49, '2023-06-16 10:09:05'),
(224, 75, 49, '2023-06-16 10:09:10'),
(225, 75, 49, '2023-06-16 10:09:18'),
(226, 75, 49, '2023-06-16 10:09:26'),
(227, 75, 49, '2023-06-16 10:09:34'),
(228, 75, 49, '2023-06-16 10:09:35'),
(229, 75, 49, '2023-06-16 10:09:36'),
(230, 75, 49, '2023-06-16 10:09:36'),
(231, 75, 49, '2023-06-16 10:09:37'),
(232, 75, 49, '2023-06-16 10:09:38'),
(233, 75, 49, '2023-06-16 10:09:39'),
(234, 75, 49, '2023-06-16 10:09:40'),
(235, 75, 49, '2023-06-16 10:09:49'),
(236, 75, 49, '2023-06-16 10:09:57'),
(237, 75, 49, '2023-06-16 10:10:06'),
(238, 75, 49, '2023-06-16 10:10:09'),
(239, 75, 49, '2023-06-16 10:10:10'),
(240, 75, 49, '2023-06-16 10:10:11'),
(241, 75, 49, '2023-06-16 10:10:19');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
`cat_id` int(11) NOT NULL,
  `cat_name` varchar(255) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cat_id`, `cat_name`, `date_added`) VALUES
(17, 'Jacket', '2023-04-27 07:35:21'),
(18, 'Sports Shoes', '2023-04-27 07:35:32'),
(19, 'Sports Cap', '2023-04-27 07:35:42'),
(20, 'Jersey', '2023-04-27 07:35:59'),
(21, 'Bag', '2023-04-27 07:36:10');

-- --------------------------------------------------------

--
-- Table structure for table `customization`
--

CREATE TABLE IF NOT EXISTS `customization` (
`customID` int(11) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `logoStatus` int(11) NOT NULL DEFAULT '0' COMMENT '0=Inactive, 1=Active',
  `brandName` varchar(255) NOT NULL,
  `about` text NOT NULL,
  `mission` text NOT NULL,
  `vision` text NOT NULL,
  `contact` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '0=Inactive, 1=Active',
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `customization`
--

INSERT INTO `customization` (`customID`, `logo`, `logoStatus`, `brandName`, `about`, `mission`, `vision`, `contact`, `email`, `status`, `date_added`) VALUES
(18, 'AB.png', 1, 'fdsf', 'dsfsf', 'dsf', 'fdsf', '9359428963', 'samkesa@gmail.com', 0, '2023-04-24 13:32:17'),
(22, '13.jpg', 0, 'ArtBid', 'Lorem ipsum, dolor sit, amet consectetur adipisicing elit. Veniam doloremque hic nam corrupti. Soluta ea, vero! Tenetur voluptatem rem, dolor quasi itaque inventore id nisi adipisci sunt, asperiores aut, provident?fd', 'Lorem ipsum, dolor sit, amet consectetur adipisicing elit. Veniam doloremque hic nam corrupti. Soluta ea, vero! Tenetur voluptatem rem, dolor quasi itaque inventore id nisi adipisci sunt, asperiores aut, provident?', 'Lorem ipsum, dolor sit, amet consectetur adipisicing elit. Veniam doloremque hic nam corrupti. Soluta ea, vero! Tenetur voluptatem rem, dolor quasi itaque inventore id nisi adipisci sunt, asperiores aut, provident?', '9359428963', 'admin@gmail.com', 1, '2023-04-24 13:35:37');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
`product_Id` int(11) NOT NULL,
  `user_Id` int(11) NOT NULL,
  `product_cat_Id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_desc` text NOT NULL,
  `starting_price` varchar(150) NOT NULL,
  `bid_due_date` datetime NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `product_status` int(11) NOT NULL DEFAULT '0' COMMENT '0=Available, 1=Sold',
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=78 ;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_Id`, `user_Id`, `product_cat_Id`, `product_name`, `product_desc`, `starting_price`, `bid_due_date`, `product_image`, `product_status`, `date_created`) VALUES
(46, 73, 21, 'Bag 1', 'Bag 1 - Description', '1000', '2024-05-06 00:00:00', 'istockphoto-450262987-612x612.jpg', 0, '2023-06-16 03:47:54'),
(47, 73, 21, 'Bag 2', 'Bag 2 - Description', '1100', '2023-01-03 00:00:00', 'istockphoto-470860695-612x612.jpg', 1, '2023-06-16 03:48:50'),
(48, 73, 21, 'Bag 3', 'Bag 3 - Description', '1200', '2024-05-06 00:00:00', 'istockphoto-545356714-612x612.jpg', 0, '2023-06-03 04:09:05'),
(49, 73, 21, 'Bag 4', 'Bag 4 - Description', '1300', '2023-07-28 18:08:00', 'istockphoto-620744590-612x612.jpg', 0, '2023-06-16 10:19:03'),
(50, 73, 21, 'Bag 5', 'Bag 5 - Description', '1400', '2024-05-06 00:00:00', 'istockphoto-638742100-612x612.jpg', 0, '2023-06-03 04:09:05'),
(51, 73, 21, 'Bag 6', 'Bag 6 - Description', '1500', '2024-05-06 00:00:00', 'istockphoto-845876878-612x612.jpg', 0, '2023-06-03 04:09:05'),
(52, 73, 21, 'Bag 7', 'Bag 7 - Description', '1600', '2024-05-06 00:00:00', 'istockphoto-939875864-612x612.jpg', 0, '2023-06-03 04:09:05'),
(53, 73, 21, 'Bag 8', 'Bag 8 - Description', '1700', '2024-05-06 00:00:00', 'istockphoto-1050922202-612x612.jpg', 0, '2023-06-03 04:09:05'),
(54, 73, 21, 'Bag 9', 'Bag 9 - Description', '1800', '2024-05-06 00:00:00', 'istockphoto-1077815254-612x612.jpg', 0, '2023-06-03 04:09:05'),
(55, 73, 21, 'Bag 10', 'Bag 10 - Description', '1900', '2024-05-06 00:00:00', 'istockphoto-1146438956-612x612.jpg', 0, '2023-06-03 04:09:05'),
(56, 73, 21, 'Bag 11', 'Bag 11 - Description', '2000', '2024-05-06 00:00:00', 'istockphoto-1146439100-612x612.jpg', 0, '2023-06-03 04:09:05'),
(57, 73, 21, 'Bag 12', 'Bag 12 - Description', '2100', '2024-05-06 00:00:00', 'istockphoto-1365118618-612x612.jpg', 0, '2023-06-03 04:09:05'),
(58, 73, 21, 'Bag 12.2', 'Bag 12 - Description', '2200', '2024-05-06 00:00:00', 'istockphoto-1365118618-612x612.jpg', 0, '2023-06-16 06:57:07'),
(59, 73, 21, 'Bag 13', 'Bag 13 - Description', '2200', '2024-05-06 00:00:00', 'istockphoto-1367616254-612x612.jpg', 0, '2023-06-03 04:09:05'),
(60, 73, 21, 'Bag 14', 'Bag 14 - Dscription', '2300', '2024-05-06 00:00:00', 'istockphoto-1385197826-612x612.jpg', 0, '2023-06-03 04:09:05'),
(61, 73, 21, 'Bag 15', 'Bag 15 - Description', '2400', '2024-05-06 00:00:00', 'istockphoto-1391086980-612x612.jpg', 0, '2023-06-03 04:09:05'),
(62, 73, 21, 'Bag 16', 'Bag 16 - Description', '2400', '2024-05-06 00:00:00', 'istockphoto-1411816746-612x612.jpg', 0, '2023-06-03 04:09:05'),
(63, 73, 21, 'Bag 17', 'Bag 17 - Description', '2500', '2024-05-06 00:00:00', 'istockphoto-1429064676-612x612.jpg', 0, '2023-06-03 04:09:05'),
(64, 73, 21, 'Bag 18', 'Bag 17 - Description', '2600', '2024-05-06 00:00:00', 'istockphoto-1429064676-612x612.jpg', 0, '2023-06-16 06:56:21'),
(65, 73, 21, 'Bag 19', 'Bag 18 - Description', '2600', '2024-05-06 00:00:00', 'istockphoto-1432566792-612x612.jpg', 0, '2023-06-16 06:56:24'),
(66, 73, 21, 'Bag 20', 'Bag 18 - Description', '2800', '2024-05-06 00:00:00', 'istockphoto-1432566792-612x612.jpg', 0, '2023-06-16 06:56:26'),
(67, 73, 21, 'Bag 21', 'Bag 19 - Description', '2900', '2024-05-06 00:00:00', 'istockphoto-1432884348-612x612.jpg', 0, '2023-06-16 06:56:31'),
(68, 73, 21, 'Bag 22', 'Bag 20 - Description', '3000', '2024-05-06 00:00:00', 'istockphoto-1271796113-612x612.jpg', 0, '2023-06-16 06:56:33'),
(69, 73, 20, 'Jersey 1', 'Jersey 1 - Descriptions', '100', '2024-05-06 00:00:00', 'istockphoto-960888850-612x612.jpg', 0, '2023-06-03 04:44:28'),
(70, 73, 20, 'Jersey 2', 'Jersey 2 - Description', '200', '2024-05-06 00:00:00', 'istockphoto-969592352-612x612.jpg', 0, '2023-06-03 04:09:05'),
(71, 73, 20, 'Jersey 3', 'Jersey 3 - Description', '300', '2024-05-06 00:00:00', 'istockphoto-969592362-612x612.jpg', 0, '2023-06-03 04:09:05'),
(72, 73, 20, 'Jersey 4', 'Jersey 4 - Description', '400', '2024-05-06 00:00:00', 'istockphoto-969592364-612x612.jpg', 1, '2023-06-16 03:44:52'),
(73, 73, 20, 'Jersey 5', 'Jersey 5 - Description', '500', '2024-05-06 00:00:00', 'istockphoto-969592384-612x612.jpg', 0, '2023-06-03 04:09:05'),
(74, 73, 20, 'Jersey 6', 'Jersey 6 - Description', '600', '2024-05-06 00:00:00', 'istockphoto-969592386-612x612.jpg', 0, '2023-06-03 04:09:05'),
(75, 73, 20, 'Jersey 7', 'Jersey 7 - Description', '700', '2024-05-06 00:00:00', 'istockphoto-969592398-612x612.jpg', 0, '2023-06-03 04:09:05'),
(76, 73, 20, 'Jersey 8', 'Jersey 8 - Description', '800', '2024-05-06 00:00:00', 'istockphoto-1044979062-612x612.jpg', 0, '2023-06-03 04:09:05'),
(77, 73, 20, 'Jersey 9', 'Jersey 9 - Description', '900', '2024-05-06 00:00:00', 'istockphoto-1044979084-612x612.jpg', 0, '2023-06-03 04:09:05');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`user_Id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `middlename` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `suffix` varchar(255) NOT NULL,
  `dob` varchar(255) NOT NULL,
  `age` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contact` varchar(100) NOT NULL,
  `birthplace` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `civilstatus` varchar(50) NOT NULL,
  `occupation` varchar(50) NOT NULL,
  `religion` varchar(100) NOT NULL,
  `house_no` varchar(255) NOT NULL,
  `street_name` varchar(255) NOT NULL,
  `purok` varchar(255) NOT NULL,
  `zone` varchar(255) NOT NULL,
  `barangay` varchar(255) NOT NULL,
  `municipality` varchar(255) NOT NULL,
  `province` varchar(255) NOT NULL,
  `region` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `password` varchar(100) NOT NULL,
  `user_type` varchar(50) NOT NULL DEFAULT 'Buyer',
  `verification_code` int(11) NOT NULL,
  `failed_attempts` int(11) NOT NULL,
  `last_failed_attempt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `date_registered` date NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=76 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_Id`, `firstname`, `middlename`, `lastname`, `suffix`, `dob`, `age`, `email`, `contact`, `birthplace`, `gender`, `civilstatus`, `occupation`, `religion`, `house_no`, `street_name`, `purok`, `zone`, `barangay`, `municipality`, `province`, `region`, `image`, `password`, `user_type`, `verification_code`, `failed_attempts`, `last_failed_attempt`, `date_registered`) VALUES
(66, 'Admin', 'Admin', 'Admin', '', '1997-09-22', '25 years old', 'admin@gmail.com', '9359428963', 'Poblacion, Medellin, Cebu', 'Male', 'Married', 'Web developer', 'Bible Baptist Church', '1234', 'Sitio Upper Landing', 'Purok San Isidro', 'Ambot', 'Daanlungsod', 'Medellin', 'Cebu', 'VII', '13.jpg', '0192023a7bbd73250516f069df18b500', 'Admin', 313552, 1, '2023-06-03 04:38:55', '2022-11-25'),
(67, 'Buyer 1', 'Buyer 1', 'Buyer 1', '', '2016-03-09', '6 years old', 'buyer@gmail.com', '9123456789', 'dsa', 'Male', 'Married', 'fdsf', 'Protestants', 'fdsf', 'dsf', 'fdsf', 'fdsf', 'dsfsd', 'fdsf', 'gfdgdfgdfg', 'fds', '1.jpg', '0192023a7bbd73250516f069df18b500', 'Buyer', 372912, 1, '2023-04-26 03:06:19', '2022-11-25'),
(72, 'Buyer 2', 'Buyer 2', 'Buyer 2', 'Buyer', '2022-12-21', '5 days old', 'buyer2@gmail.com', '9359428963', 'gfdgfdg', 'Male', 'Married', 'gfdgfdgd', 'Buddhist', 'gfdg', 'fdg', 'gdfgdg', 'gfdg', 'dfgd', 'fdgdg', 'fdg', 'dfg', '12.jpg', '0192023a7bbd73250516f069df18b500', 'Buyer', 420213, 0, '2023-04-26 03:06:41', '2022-12-27'),
(73, 'Seller', 'Seller', 'Seller', 'Seller', '2022-12-15', '1 week old', 'seller@gmail.com', '9359428963', 'ewf', 'Male', 'Married', 'f', 'Methodist', 'gfd', 'gdfgd', 'gdfgdg', 'fdgd', 'gdf', 'gdgfdgdfgdfgd', 'Cebu', 'hgfhgfhfgghf', '1.jpg', '0192023a7bbd73250516f069df18b500', 'Seller', 0, 0, '2023-04-25 14:31:40', '2022-12-27'),
(75, 'Buyer Fname', 'Buyer Mname', 'Buyer Lname', '', '2023-04-10', '1 week old', 'buyer3@gmail.com', '9359428963', 'fds', 'Male', 'Single', 'fdsfds', 'Jehovah''s Witnesses', 'fds', 'fdsf', 'dsff', 'dsf', 'dsfdsf', 'dsfsd', 'fsdf', 'fds', '340113606_6010107749027068_137288871082476109_n.jpg', '0192023a7bbd73250516f069df18b500', 'Buyer', 0, 0, '2023-06-16 09:58:23', '2023-04-20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `announcement`
--
ALTER TABLE `announcement`
 ADD PRIMARY KEY (`actId`);

--
-- Indexes for table `bidding`
--
ALTER TABLE `bidding`
 ADD PRIMARY KEY (`bidding_Id`);

--
-- Indexes for table `bidding_winner`
--
ALTER TABLE `bidding_winner`
 ADD PRIMARY KEY (`winner_Id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
 ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `customization`
--
ALTER TABLE `customization`
 ADD PRIMARY KEY (`customID`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
 ADD PRIMARY KEY (`product_Id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`user_Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `announcement`
--
ALTER TABLE `announcement`
MODIFY `actId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `bidding`
--
ALTER TABLE `bidding`
MODIFY `bidding_Id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT for table `bidding_winner`
--
ALTER TABLE `bidding_winner`
MODIFY `winner_Id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=242;
--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `customization`
--
ALTER TABLE `customization`
MODIFY `customID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
MODIFY `product_Id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=78;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `user_Id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=76;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
