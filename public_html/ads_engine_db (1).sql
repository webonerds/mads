-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 20, 2014 at 07:41 AM
-- Server version: 5.6.14
-- PHP Version: 5.5.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ads_engine_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `brief` text,
  `description` longtext,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `created_on` datetime DEFAULT NULL,
  `modified_by` int(11) NOT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`category_id`),
  KEY `categories_created_by` (`created_by`),
  KEY `categories_modified_by` (`modified_by`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `title`, `brief`, `description`, `status`, `created_by`, `created_on`, `modified_by`, `modified_on`) VALUES
(2, 'one', 'one			', '<p>test</p>\r\n', 1, 1, '2014-02-03 15:48:10', 1, '2014-02-04 20:02:37'),
(3, 'my', 'best', '<p>categories</p>\r\n', 1, 1, '2014-02-04 20:03:07', 1, '2014-02-04 20:03:07');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE IF NOT EXISTS `countries` (
  `country_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `abbreviation` varchar(10) NOT NULL DEFAULT '',
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`country_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `email_messages`
--

CREATE TABLE IF NOT EXISTS `email_messages` (
  `email_message_id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_email_message_id` int(11) DEFAULT NULL,
  `from_user_id` int(11) DEFAULT NULL,
  `to_user_id` int(11) DEFAULT NULL,
  `to_email` varchar(255) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `message` longtext,
  `body_contents` longtext,
  `sent_successful` tinyint(1) NOT NULL DEFAULT '0',
  `message_replied` tinyint(1) NOT NULL DEFAULT '0',
  `mark_as_read` tinyint(1) NOT NULL DEFAULT '0',
  `created_on` datetime NOT NULL,
  PRIMARY KEY (`email_message_id`),
  KEY `email_messages_to_user_id` (`to_user_id`),
  KEY `email_messages_from_user_id` (`from_user_id`),
  KEY `email_messages_parent_email_message_id` (`parent_email_message_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE IF NOT EXISTS `faqs` (
  `faq_id` int(11) NOT NULL AUTO_INCREMENT,
  `faq_title` varchar(255) NOT NULL,
  `brief` text NOT NULL,
  `description` longtext NOT NULL,
  `display_order` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `created_on` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `modified_on` datetime NOT NULL,
  PRIMARY KEY (`faq_id`),
  KEY `faqs_created_by` (`created_by`),
  KEY `faqs_modified_by` (`modified_by`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `faqs`
--

INSERT INTO `faqs` (`faq_id`, `faq_title`, `brief`, `description`, `display_order`, `active`, `created_by`, `created_on`, `modified_by`, `modified_on`) VALUES
(2, 'how are you', 'th', '<p>thanks</p>\r\n', 4, 1, 1, '2014-02-04 18:49:50', 1, '2014-02-04 18:49:50'),
(3, 'sadfj', 'sdlkfj', '<p>asdlkfj</p>\r\n', 5, 0, 1, '2014-02-04 18:50:12', 1, '2014-02-04 19:24:21');

-- --------------------------------------------------------

--
-- Table structure for table `media_files`
--

CREATE TABLE IF NOT EXISTS `media_files` (
  `media_file_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `user_post_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `news_id` int(11) DEFAULT NULL,
  `column_name` varchar(50) DEFAULT NULL,
  `file_type` enum('image','video') NOT NULL DEFAULT 'image',
  `image_width` int(11) DEFAULT NULL,
  `image_height` int(11) DEFAULT NULL,
  `image_identifier` enum('XS','S','M','L','XL','XXL','Orig') DEFAULT NULL,
  `original_filename` varchar(255) DEFAULT NULL,
  `filepath` varchar(255) DEFAULT NULL,
  `filename` varchar(100) DEFAULT NULL,
  `filesize` int(11) DEFAULT NULL,
  `filetype` varchar(50) DEFAULT NULL,
  `cdn_absolute_url` varchar(255) DEFAULT NULL,
  `marked_delete` tinyint(1) NOT NULL DEFAULT '0',
  `created_on` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`media_file_id`),
  KEY `media_files_created_by` (`created_by`),
  KEY `media_files_user_id` (`user_id`),
  KEY `media_files_user_post_id` (`user_post_id`),
  KEY `media_files_product_id` (`product_id`),
  KEY `media_files_news_id` (`news_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=123 ;

--
-- Dumping data for table `media_files`
--

INSERT INTO `media_files` (`media_file_id`, `user_id`, `user_post_id`, `product_id`, `news_id`, `column_name`, `file_type`, `image_width`, `image_height`, `image_identifier`, `original_filename`, `filepath`, `filename`, `filesize`, `filetype`, `cdn_absolute_url`, `marked_delete`, `created_on`, `created_by`) VALUES
(1, NULL, NULL, NULL, NULL, 'picture', 'image', NULL, NULL, 'Orig', '6039_264401327028719_1947321900_n.jpg', 'uploads/assets/1/7', 'y9Lu4N1q1jcWw.jpg', 115831, 'image/jpeg', NULL, 0, '2014-02-03 15:30:43', 1),
(2, NULL, NULL, NULL, NULL, 'picture', 'image', NULL, NULL, 'Orig', '6039_264401327028719_1947321900_n.jpg', 'uploads/assets/1/8', '4LdfW3oheiqH0.jpg', 115831, 'image/jpeg', NULL, 0, '2014-02-03 15:41:35', 1),
(3, NULL, NULL, NULL, NULL, 'picture', 'image', NULL, NULL, 'Orig', '6039_264401327028719_1947321900_n.jpg', 'uploads/assets/1/9', 'wSpIVt3p1pICo.jpg', 115831, 'image/jpeg', NULL, 0, '2014-02-03 15:42:27', 1),
(4, NULL, NULL, NULL, NULL, 'picture', 'image', NULL, NULL, 'Orig', '6039_264401327028719_1947321900_n.jpg', 'uploads/assets/1/10', 'L8n33coKjZDrR.jpg', 115831, 'image/jpeg', NULL, 0, '2014-02-03 15:45:11', 1),
(5, NULL, NULL, NULL, NULL, 'picture', 'image', NULL, NULL, 'Orig', '6039_264401327028719_1947321900_n.jpg', 'uploads/assets/1/12', 'MHUpZobxbY6GC.jpg', 115831, 'image/jpeg', NULL, 0, '2014-02-03 15:47:47', 1),
(6, NULL, NULL, NULL, NULL, 'picture', 'image', 132, 72, 'XS', 'img_132_72_MHUpZobxbY6GC.jpg', 'uploads/assets/1/12', 'img_132_72_MHUpZobxbY6GC.jpg', 11913, 'image/jpeg', NULL, 0, '2014-02-03 15:47:47', 1),
(7, NULL, NULL, NULL, NULL, 'picture', 'image', 264, 146, 'S', 'img_264_146_MHUpZobxbY6GC.jpg', 'uploads/assets/1/12', 'img_264_146_MHUpZobxbY6GC.jpg', 39113, 'image/jpeg', NULL, 0, '2014-02-03 15:47:47', 1),
(8, NULL, NULL, NULL, NULL, 'picture', 'image', 341, 138, 'M', 'img_341_138_MHUpZobxbY6GC.jpg', 'uploads/assets/1/12', 'img_341_138_MHUpZobxbY6GC.jpg', 46346, 'image/jpeg', NULL, 0, '2014-02-03 15:47:47', 1),
(9, NULL, NULL, NULL, NULL, 'picture', 'image', 341, 276, 'L', 'img_341_276_MHUpZobxbY6GC.jpg', 'uploads/assets/1/12', 'img_341_276_MHUpZobxbY6GC.jpg', 86882, 'image/jpeg', NULL, 0, '2014-02-03 15:47:47', 1),
(10, NULL, NULL, NULL, NULL, 'picture', 'image', 682, 276, 'XL', 'img_682_276_MHUpZobxbY6GC.jpg', 'uploads/assets/1/12', 'img_682_276_MHUpZobxbY6GC.jpg', 151416, 'image/jpeg', NULL, 0, '2014-02-03 15:47:47', 1),
(11, NULL, NULL, NULL, NULL, 'picture', 'image', 680, 370, 'XXL', 'img_680_370_MHUpZobxbY6GC.jpg', 'uploads/assets/1/12', 'img_680_370_MHUpZobxbY6GC.jpg', 192761, 'image/jpeg', NULL, 0, '2014-02-03 15:47:47', 1),
(12, NULL, NULL, NULL, NULL, 'picture', 'image', NULL, NULL, 'Orig', '6039_264401327028719_1947321900_n.jpg', 'uploads/assets/1/13', 'jOQHajpkvykHR.jpg', 115831, 'image/jpeg', NULL, 0, '2014-02-03 15:48:40', 1),
(13, NULL, NULL, NULL, NULL, 'picture', 'image', 132, 72, 'XS', 'img_132_72_jOQHajpkvykHR.jpg', 'uploads/assets/1/13', 'img_132_72_jOQHajpkvykHR.jpg', 11913, 'image/jpeg', NULL, 0, '2014-02-03 15:48:41', 1),
(14, NULL, NULL, NULL, NULL, 'picture', 'image', 264, 146, 'S', 'img_264_146_jOQHajpkvykHR.jpg', 'uploads/assets/1/13', 'img_264_146_jOQHajpkvykHR.jpg', 39113, 'image/jpeg', NULL, 0, '2014-02-03 15:48:41', 1),
(15, NULL, NULL, NULL, NULL, 'picture', 'image', 341, 138, 'M', 'img_341_138_jOQHajpkvykHR.jpg', 'uploads/assets/1/13', 'img_341_138_jOQHajpkvykHR.jpg', 46346, 'image/jpeg', NULL, 0, '2014-02-03 15:48:41', 1),
(16, NULL, NULL, NULL, NULL, 'picture', 'image', 341, 276, 'L', 'img_341_276_jOQHajpkvykHR.jpg', 'uploads/assets/1/13', 'img_341_276_jOQHajpkvykHR.jpg', 86882, 'image/jpeg', NULL, 0, '2014-02-03 15:48:41', 1),
(17, NULL, NULL, NULL, NULL, 'picture', 'image', 682, 276, 'XL', 'img_682_276_jOQHajpkvykHR.jpg', 'uploads/assets/1/13', 'img_682_276_jOQHajpkvykHR.jpg', 151416, 'image/jpeg', NULL, 0, '2014-02-03 15:48:41', 1),
(18, NULL, NULL, NULL, NULL, 'picture', 'image', 680, 370, 'XXL', 'img_680_370_jOQHajpkvykHR.jpg', 'uploads/assets/1/13', 'img_680_370_jOQHajpkvykHR.jpg', 192761, 'image/jpeg', NULL, 0, '2014-02-03 15:48:41', 1),
(19, NULL, NULL, NULL, NULL, 'picture', 'image', NULL, NULL, 'Orig', '6039_264401327028719_1947321900_n.jpg', 'uploads/news/1/14', 'Pl08nZJYERVlj.jpg', 115831, 'image/jpeg', NULL, 0, '2014-02-03 15:59:26', 1),
(20, NULL, NULL, NULL, NULL, 'picture', 'image', NULL, NULL, 'Orig', '6039_264401327028719_1947321900_n.jpg', 'uploads/news/1/15', 'd0TAy0jguJb6y.jpg', 115831, 'image/jpeg', NULL, 0, '2014-02-03 16:00:05', 1),
(21, NULL, NULL, NULL, NULL, 'picture', 'image', 132, 72, 'XS', 'img_132_72_d0TAy0jguJb6y.jpg', 'uploads/news/1/15', 'img_132_72_d0TAy0jguJb6y.jpg', 11913, 'image/jpeg', NULL, 0, '2014-02-03 16:00:05', 1),
(22, NULL, NULL, NULL, NULL, 'picture', 'image', 264, 146, 'S', 'img_264_146_d0TAy0jguJb6y.jpg', 'uploads/news/1/15', 'img_264_146_d0TAy0jguJb6y.jpg', 39113, 'image/jpeg', NULL, 0, '2014-02-03 16:00:05', 1),
(23, NULL, NULL, NULL, NULL, 'picture', 'image', 341, 138, 'M', 'img_341_138_d0TAy0jguJb6y.jpg', 'uploads/news/1/15', 'img_341_138_d0TAy0jguJb6y.jpg', 46346, 'image/jpeg', NULL, 0, '2014-02-03 16:00:05', 1),
(24, NULL, NULL, NULL, NULL, 'picture', 'image', 341, 276, 'L', 'img_341_276_d0TAy0jguJb6y.jpg', 'uploads/news/1/15', 'img_341_276_d0TAy0jguJb6y.jpg', 86882, 'image/jpeg', NULL, 0, '2014-02-03 16:00:05', 1),
(25, NULL, NULL, NULL, NULL, 'picture', 'image', 682, 276, 'XL', 'img_682_276_d0TAy0jguJb6y.jpg', 'uploads/news/1/15', 'img_682_276_d0TAy0jguJb6y.jpg', 151416, 'image/jpeg', NULL, 0, '2014-02-03 16:00:05', 1),
(26, NULL, NULL, NULL, NULL, 'picture', 'image', 680, 370, 'XXL', 'img_680_370_d0TAy0jguJb6y.jpg', 'uploads/news/1/15', 'img_680_370_d0TAy0jguJb6y.jpg', 192761, 'image/jpeg', NULL, 0, '2014-02-03 16:00:05', 1),
(27, NULL, NULL, NULL, NULL, 'picture', 'image', NULL, NULL, 'Orig', '6039_264401327028719_1947321900_n.jpg', 'uploads/news/1/16', 'uauHwtkkgMRSL.jpg', 115831, 'image/jpeg', NULL, 0, '2014-02-03 16:14:09', 1),
(28, NULL, NULL, NULL, NULL, 'picture', 'image', 132, 72, 'XS', 'img_132_72_uauHwtkkgMRSL.jpg', 'uploads/news/1/16', 'img_132_72_uauHwtkkgMRSL.jpg', 11913, 'image/jpeg', NULL, 0, '2014-02-03 16:14:09', 1),
(29, NULL, NULL, NULL, NULL, 'picture', 'image', 264, 146, 'S', 'img_264_146_uauHwtkkgMRSL.jpg', 'uploads/news/1/16', 'img_264_146_uauHwtkkgMRSL.jpg', 39113, 'image/jpeg', NULL, 0, '2014-02-03 16:14:09', 1),
(30, NULL, NULL, NULL, NULL, 'picture', 'image', 341, 138, 'M', 'img_341_138_uauHwtkkgMRSL.jpg', 'uploads/news/1/16', 'img_341_138_uauHwtkkgMRSL.jpg', 46346, 'image/jpeg', NULL, 0, '2014-02-03 16:14:09', 1),
(31, NULL, NULL, NULL, NULL, 'picture', 'image', 341, 276, 'L', 'img_341_276_uauHwtkkgMRSL.jpg', 'uploads/news/1/16', 'img_341_276_uauHwtkkgMRSL.jpg', 86882, 'image/jpeg', NULL, 0, '2014-02-03 16:14:09', 1),
(32, NULL, NULL, NULL, NULL, 'picture', 'image', 682, 276, 'XL', 'img_682_276_uauHwtkkgMRSL.jpg', 'uploads/news/1/16', 'img_682_276_uauHwtkkgMRSL.jpg', 151416, 'image/jpeg', NULL, 0, '2014-02-03 16:14:09', 1),
(33, NULL, NULL, NULL, NULL, 'picture', 'image', 680, 370, 'XXL', 'img_680_370_uauHwtkkgMRSL.jpg', 'uploads/news/1/16', 'img_680_370_uauHwtkkgMRSL.jpg', 192761, 'image/jpeg', NULL, 0, '2014-02-03 16:14:09', 1),
(34, NULL, NULL, NULL, NULL, 'picture', 'image', NULL, NULL, 'Orig', '6039_264401327028719_1947321900_n.jpg', 'uploads/news/1/18', 'fEM1z5p7LhZer.jpg', 115831, 'image/jpeg', NULL, 0, '2014-02-03 16:30:53', 1),
(35, NULL, NULL, NULL, NULL, 'picture', 'image', 132, 72, 'XS', 'img_132_72_fEM1z5p7LhZer.jpg', 'uploads/news/1/18', 'img_132_72_fEM1z5p7LhZer.jpg', 11913, 'image/jpeg', NULL, 0, '2014-02-03 16:30:53', 1),
(36, NULL, NULL, NULL, NULL, 'picture', 'image', 264, 146, 'S', 'img_264_146_fEM1z5p7LhZer.jpg', 'uploads/news/1/18', 'img_264_146_fEM1z5p7LhZer.jpg', 39113, 'image/jpeg', NULL, 0, '2014-02-03 16:30:53', 1),
(37, NULL, NULL, NULL, NULL, 'picture', 'image', 341, 138, 'M', 'img_341_138_fEM1z5p7LhZer.jpg', 'uploads/news/1/18', 'img_341_138_fEM1z5p7LhZer.jpg', 46346, 'image/jpeg', NULL, 0, '2014-02-03 16:30:53', 1),
(38, NULL, NULL, NULL, NULL, 'picture', 'image', 341, 276, 'L', 'img_341_276_fEM1z5p7LhZer.jpg', 'uploads/news/1/18', 'img_341_276_fEM1z5p7LhZer.jpg', 86882, 'image/jpeg', NULL, 0, '2014-02-03 16:30:53', 1),
(39, NULL, NULL, NULL, NULL, 'picture', 'image', 682, 276, 'XL', 'img_682_276_fEM1z5p7LhZer.jpg', 'uploads/news/1/18', 'img_682_276_fEM1z5p7LhZer.jpg', 151416, 'image/jpeg', NULL, 0, '2014-02-03 16:30:53', 1),
(40, NULL, NULL, NULL, NULL, 'picture', 'image', 680, 370, 'XXL', 'img_680_370_fEM1z5p7LhZer.jpg', 'uploads/news/1/18', 'img_680_370_fEM1z5p7LhZer.jpg', 192761, 'image/jpeg', NULL, 0, '2014-02-03 16:30:53', 1),
(41, NULL, NULL, NULL, NULL, 'picture', 'image', NULL, NULL, 'Orig', '6039_264401327028719_1947321900_n.jpg', 'uploads/news/1/19', 'l94g5kZ0ZJrRw.jpg', 115831, 'image/jpeg', NULL, 0, '2014-02-03 16:31:49', 1),
(42, NULL, NULL, NULL, NULL, 'picture', 'image', 132, 72, 'XS', 'img_132_72_l94g5kZ0ZJrRw.jpg', 'uploads/news/1/19', 'img_132_72_l94g5kZ0ZJrRw.jpg', 11913, 'image/jpeg', NULL, 0, '2014-02-03 16:31:49', 1),
(43, NULL, NULL, NULL, NULL, 'picture', 'image', 264, 146, 'S', 'img_264_146_l94g5kZ0ZJrRw.jpg', 'uploads/news/1/19', 'img_264_146_l94g5kZ0ZJrRw.jpg', 39113, 'image/jpeg', NULL, 0, '2014-02-03 16:31:49', 1),
(44, NULL, NULL, NULL, NULL, 'picture', 'image', 341, 138, 'M', 'img_341_138_l94g5kZ0ZJrRw.jpg', 'uploads/news/1/19', 'img_341_138_l94g5kZ0ZJrRw.jpg', 46346, 'image/jpeg', NULL, 0, '2014-02-03 16:31:49', 1),
(45, NULL, NULL, NULL, NULL, 'picture', 'image', 341, 276, 'L', 'img_341_276_l94g5kZ0ZJrRw.jpg', 'uploads/news/1/19', 'img_341_276_l94g5kZ0ZJrRw.jpg', 86882, 'image/jpeg', NULL, 0, '2014-02-03 16:31:49', 1),
(46, NULL, NULL, NULL, NULL, 'picture', 'image', 682, 276, 'XL', 'img_682_276_l94g5kZ0ZJrRw.jpg', 'uploads/news/1/19', 'img_682_276_l94g5kZ0ZJrRw.jpg', 151416, 'image/jpeg', NULL, 0, '2014-02-03 16:31:49', 1),
(47, NULL, NULL, NULL, NULL, 'picture', 'image', 680, 370, 'XXL', 'img_680_370_l94g5kZ0ZJrRw.jpg', 'uploads/news/1/19', 'img_680_370_l94g5kZ0ZJrRw.jpg', 192761, 'image/jpeg', NULL, 0, '2014-02-03 16:31:50', 1),
(48, NULL, NULL, NULL, NULL, 'picture', 'image', NULL, NULL, 'Orig', '6039_264401327028719_1947321900_n.jpg', 'uploads/news/1/20', 'XIzsRk1R0L5RA.jpg', 115831, 'image/jpeg', NULL, 0, '2014-02-04 12:07:38', 1),
(49, NULL, NULL, NULL, NULL, 'picture', 'image', 132, 72, 'XS', 'img_132_72_XIzsRk1R0L5RA.jpg', 'uploads/news/1/20', 'img_132_72_XIzsRk1R0L5RA.jpg', 11913, 'image/jpeg', NULL, 0, '2014-02-04 12:07:38', 1),
(50, NULL, NULL, NULL, NULL, 'picture', 'image', 264, 146, 'S', 'img_264_146_XIzsRk1R0L5RA.jpg', 'uploads/news/1/20', 'img_264_146_XIzsRk1R0L5RA.jpg', 39113, 'image/jpeg', NULL, 0, '2014-02-04 12:07:38', 1),
(51, NULL, NULL, NULL, NULL, 'picture', 'image', 341, 138, 'M', 'img_341_138_XIzsRk1R0L5RA.jpg', 'uploads/news/1/20', 'img_341_138_XIzsRk1R0L5RA.jpg', 46346, 'image/jpeg', NULL, 0, '2014-02-04 12:07:38', 1),
(52, NULL, NULL, NULL, NULL, 'picture', 'image', 341, 276, 'L', 'img_341_276_XIzsRk1R0L5RA.jpg', 'uploads/news/1/20', 'img_341_276_XIzsRk1R0L5RA.jpg', 86882, 'image/jpeg', NULL, 0, '2014-02-04 12:07:38', 1),
(53, NULL, NULL, NULL, NULL, 'picture', 'image', 682, 276, 'XL', 'img_682_276_XIzsRk1R0L5RA.jpg', 'uploads/news/1/20', 'img_682_276_XIzsRk1R0L5RA.jpg', 151416, 'image/jpeg', NULL, 0, '2014-02-04 12:07:38', 1),
(54, NULL, NULL, NULL, NULL, 'picture', 'image', 680, 370, 'XXL', 'img_680_370_XIzsRk1R0L5RA.jpg', 'uploads/news/1/20', 'img_680_370_XIzsRk1R0L5RA.jpg', 192761, 'image/jpeg', NULL, 0, '2014-02-04 12:07:38', 1),
(55, NULL, NULL, NULL, NULL, 'picture', 'image', NULL, NULL, 'Orig', '47000_425044264236652_773023461_n.jpg', 'uploads/news/1/21', 'OCGvMpTKfsAfS.jpg', 16649, 'image/jpeg', NULL, 0, '2014-02-05 09:43:25', 1),
(56, NULL, NULL, NULL, NULL, 'picture', 'image', 132, 72, 'XS', 'img_132_72_OCGvMpTKfsAfS.jpg', 'uploads/news/1/21', 'img_132_72_OCGvMpTKfsAfS.jpg', 8735, 'image/jpeg', NULL, 0, '2014-02-05 09:43:25', 1),
(57, NULL, NULL, NULL, NULL, 'picture', 'image', NULL, NULL, 'Orig', '6039_264401327028719_1947321900_n.jpg', 'uploads/news/1/22', 'rflg6KFAmjdVb.jpg', 115831, 'image/jpeg', NULL, 1, '2014-02-05 10:11:59', 1),
(58, NULL, NULL, NULL, NULL, 'picture', 'image', 132, 72, 'XS', 'img_132_72_rflg6KFAmjdVb.jpg', 'uploads/news/1/22', 'img_132_72_rflg6KFAmjdVb.jpg', 11913, 'image/jpeg', NULL, 1, '2014-02-05 10:12:00', 1),
(59, NULL, NULL, NULL, NULL, 'picture', 'image', NULL, NULL, 'Orig', '6039_264401327028719_1947321900_n.jpg', 'uploads/news/1/23', 'vfAKzssXBBGxC.jpg', 115831, 'image/jpeg', NULL, 1, '2014-02-05 11:03:19', 1),
(60, NULL, NULL, NULL, NULL, 'picture', 'image', 132, 72, 'XS', 'img_132_72_vfAKzssXBBGxC.jpg', 'uploads/news/1/23', 'img_132_72_vfAKzssXBBGxC.jpg', 11913, 'image/jpeg', NULL, 1, '2014-02-05 11:03:19', 1),
(61, NULL, NULL, NULL, NULL, 'picture', 'image', NULL, NULL, 'Orig', '6039_264401327028719_1947321900_n.jpg', 'uploads/news/1/24', 'l5b8c4PxYXJiE.jpg', 115831, 'image/jpeg', NULL, 1, '2014-02-05 11:04:37', 1),
(62, NULL, NULL, NULL, NULL, 'picture', 'image', 132, 72, 'XS', 'img_132_72_l5b8c4PxYXJiE.jpg', 'uploads/news/1/24', 'img_132_72_l5b8c4PxYXJiE.jpg', 11913, 'image/jpeg', NULL, 1, '2014-02-05 11:04:37', 1),
(63, NULL, NULL, NULL, NULL, 'picture', 'image', NULL, NULL, 'Orig', '6039_264401327028719_1947321900_n.jpg', 'uploads/news/1/25', 'VdyMLDQG3N6dK.jpg', 115831, 'image/jpeg', NULL, 1, '2014-02-05 11:15:39', 1),
(64, NULL, NULL, NULL, NULL, 'picture', 'image', 132, 72, 'XS', 'img_132_72_VdyMLDQG3N6dK.jpg', 'uploads/news/1/25', 'img_132_72_VdyMLDQG3N6dK.jpg', 11913, 'image/jpeg', NULL, 1, '2014-02-05 11:15:39', 1),
(65, NULL, NULL, NULL, NULL, 'picture', 'image', NULL, NULL, 'Orig', '47000_425044264236652_773023461_n.jpg', 'uploads/userpost/1/44', 'e0APD44M1A9nC.jpg', 16649, 'image/jpeg', NULL, 0, '2014-02-06 08:58:53', 1),
(66, NULL, NULL, NULL, NULL, 'picture', 'image', 132, 72, 'XS', 'img_132_72_e0APD44M1A9nC.jpg', 'uploads/userpost/1/44', 'img_132_72_e0APD44M1A9nC.jpg', 8735, 'image/jpeg', NULL, 0, '2014-02-06 08:58:53', 1),
(68, NULL, NULL, NULL, NULL, 'profile_picture', 'image', NULL, NULL, 'Orig', '47000_425044264236652_773023461_n.jpg', 'uploads/users/1/1', 'jzi83altrfHfD.jpg', 16649, 'image/jpeg', NULL, 0, '2014-02-06 11:45:00', 1),
(69, NULL, NULL, NULL, NULL, 'profile_picture', 'image', NULL, NULL, 'Orig', '47000_425044264236652_773023461_n.jpg', 'uploads/users/1/1', 'GfsTnanwVeUnO.jpg', 16649, 'image/jpeg', NULL, 0, '2014-02-06 11:55:48', 1),
(70, NULL, NULL, NULL, NULL, 'picture', 'image', NULL, NULL, 'Orig', '47000_425044264236652_773023461_n.jpg', 'uploads/userpost/1/45', '4ncmWm0ZmlKzx.jpg', 16649, 'image/jpeg', NULL, 0, '2014-02-06 11:57:34', 1),
(71, NULL, NULL, NULL, NULL, 'picture', 'image', 132, 72, 'XS', 'img_132_72_4ncmWm0ZmlKzx.jpg', 'uploads/userpost/1/45', 'img_132_72_4ncmWm0ZmlKzx.jpg', 8735, 'image/jpeg', NULL, 0, '2014-02-06 11:57:34', 1),
(72, NULL, NULL, NULL, NULL, 'profile_picture', 'image', NULL, NULL, 'Orig', '47000_425044264236652_773023461_n.jpg', 'uploads/users/1/2', 'WhjFd9igm0VOg.jpg', 16649, 'image/jpeg', NULL, 0, '2014-02-06 13:15:48', 1),
(73, NULL, NULL, NULL, NULL, 'profile_picture', 'image', NULL, NULL, 'Orig', '6039_264401327028719_1947321900_n.jpg', 'uploads/users/1/3', 'Lcn3cj9v32uhy.jpg', 115831, 'image/jpeg', NULL, 0, '2014-02-06 13:16:25', 1),
(74, NULL, NULL, NULL, NULL, 'profile_picture', 'image', NULL, NULL, 'Orig', '47000_425044264236652_773023461_n.jpg', 'uploads/users/1/1', '6yNvGxoZPTzYm.jpg', 16649, 'image/jpeg', NULL, 0, '2014-02-06 13:54:56', 1),
(75, NULL, NULL, NULL, NULL, 'profile_picture', 'image', NULL, NULL, 'Orig', '6039_264401327028719_1947321900_n.jpg', 'uploads/users/1/5', '27KOYcLOfgDjc.jpg', 115831, 'image/jpeg', NULL, 0, '2014-02-06 15:00:25', 1),
(76, NULL, NULL, NULL, NULL, 'profile_picture', 'image', NULL, NULL, 'Orig', '47000_425044264236652_773023461_n.jpg', 'uploads/users/1/6', '6YPWdTKQtYWYn.jpg', 16649, 'image/jpeg', NULL, 0, '2014-02-06 15:59:23', 1),
(77, NULL, NULL, NULL, NULL, 'product_picture', 'image', NULL, NULL, 'Orig', '6039_264401327028719_1947321900_n.jpg', 'uploads/products/1/3', 'DTCdsEZewfz6N.jpg', 115831, 'image/jpeg', NULL, 0, '2014-02-06 19:26:14', 1),
(78, NULL, NULL, NULL, NULL, 'product_picture', 'image', 132, 72, 'XS', 'img_132_72_DTCdsEZewfz6N.jpg', 'uploads/products/1/3', 'img_132_72_DTCdsEZewfz6N.jpg', 11913, 'image/jpeg', NULL, 0, '2014-02-06 19:26:14', 1),
(79, NULL, NULL, NULL, NULL, 'product_picture', 'image', NULL, NULL, 'Orig', '47000_425044264236652_773023461_n.jpg', 'uploads/products/1/3', '7KryNaoxhxrEH.jpg', 16649, 'image/jpeg', NULL, 0, '2014-02-06 19:31:50', 1),
(80, NULL, NULL, NULL, NULL, 'product_picture', 'image', 132, 72, 'XS', 'img_132_72_7KryNaoxhxrEH.jpg', 'uploads/products/1/3', 'img_132_72_7KryNaoxhxrEH.jpg', 8735, 'image/jpeg', NULL, 0, '2014-02-06 19:31:50', 1),
(81, NULL, NULL, 1, NULL, 'product_picture', 'image', NULL, NULL, 'Orig', 'index.jpg', 'uploads/products/1/1', '0W1GJe5GMPfRF.jpg', 7846, 'image/jpeg', NULL, 0, '2014-02-07 09:57:01', 1),
(82, NULL, NULL, 1, NULL, 'product_picture', 'image', 132, 72, 'XS', 'img_132_72_0W1GJe5GMPfRF.jpg', 'uploads/products/1/1', 'img_132_72_0W1GJe5GMPfRF.jpg', 10771, 'image/jpeg', NULL, 0, '2014-02-07 09:57:01', 1),
(83, NULL, NULL, 2, NULL, 'product_picture', 'image', NULL, NULL, 'Orig', '1601499_570071023084112_2042409616_n.jpg', 'uploads/products/1/2', 'IpdG4i3PVTC4x.jpg', 76545, 'image/jpeg', NULL, 0, '2014-02-07 10:36:47', 1),
(84, NULL, NULL, 2, NULL, 'product_picture', 'image', 132, 72, 'XS', 'img_132_72_IpdG4i3PVTC4x.jpg', 'uploads/products/1/2', 'img_132_72_IpdG4i3PVTC4x.jpg', 10060, 'image/jpeg', NULL, 0, '2014-02-07 10:36:47', 1),
(85, NULL, NULL, 3, NULL, 'product_picture', 'image', NULL, NULL, 'Orig', 'index.jpg', 'uploads/products/1/3', 'w45xibeiGkPEJ.jpg', 7846, 'image/jpeg', NULL, 0, '2014-02-07 10:59:17', 1),
(86, NULL, NULL, 3, NULL, 'product_picture', 'image', 132, 72, 'XS', 'img_132_72_w45xibeiGkPEJ.jpg', 'uploads/products/1/3', 'img_132_72_w45xibeiGkPEJ.jpg', 10771, 'image/jpeg', NULL, 0, '2014-02-07 10:59:17', 1),
(87, NULL, 39, NULL, NULL, 'picture', 'image', NULL, NULL, 'Orig', 'DSC_0033.jpg', 'uploads/userpost/1/39', 'NltbzfeeTfPWq.jpg', 1805342, 'image/jpeg', NULL, 0, '2014-02-10 21:25:50', 1),
(88, NULL, 39, NULL, NULL, 'picture', 'image', 132, 72, 'XS', 'img_132_72_NltbzfeeTfPWq.jpg', 'uploads/userpost/1/39', 'img_132_72_NltbzfeeTfPWq.jpg', 12047, 'image/jpeg', NULL, 0, '2014-02-10 21:25:50', 1),
(89, NULL, 38, NULL, NULL, 'picture', 'image', NULL, NULL, 'Orig', 'DSC_0034.jpg', 'uploads/userpost/1/38', 'QzkpI33ngAXiU.jpg', 1636586, 'image/jpeg', NULL, 0, '2014-02-12 12:33:52', 1),
(90, NULL, 38, NULL, NULL, 'picture', 'image', 132, 72, 'XS', 'img_132_72_QzkpI33ngAXiU.jpg', 'uploads/userpost/1/38', 'img_132_72_QzkpI33ngAXiU.jpg', 10034, 'image/jpeg', NULL, 0, '2014-02-12 12:33:52', 1),
(100, 24, NULL, NULL, NULL, 'profile_picture', 'image', NULL, NULL, 'Orig', '72342_257701524365366_388005665_n.jpg', 'E:/xampp/htdocsuploadsusers124', 'uJQgxwpEGotw6.jpg', 49832, 'image/jpeg', NULL, 0, '2014-02-18 02:29:04', NULL),
(101, 25, NULL, NULL, NULL, 'profile_picture', 'image', NULL, NULL, 'Orig', '66948_258775104258008_1009529765_n.jpg', 'E:/xampp/htdocsuploadsusers125', 'fvo8TppygklRs.jpg', 46271, 'image/jpeg', NULL, 0, '2014-02-18 02:29:57', NULL),
(102, 26, NULL, NULL, NULL, 'profile_picture', 'image', NULL, NULL, 'Orig', '69873_259263967542455_1534372678_n.jpg', 'E:/xampp/htdocsuploadsusers126', 'ormaFqgSXd4mB.jpg', 48111, 'image/jpeg', NULL, 0, '2014-02-18 03:19:05', NULL),
(113, 37, NULL, NULL, NULL, 'profile_picture', 'image', NULL, NULL, 'Orig', '66948_258775104258008_1009529765_n.jpg', 'E:/xampp/htdocsuploadsusers137', 'q1ChvhgkZrsUd.jpg', 46271, 'image/jpeg', NULL, 0, '2014-02-19 01:14:16', NULL),
(114, 24, NULL, NULL, NULL, 'profile_picture', 'image', NULL, NULL, 'Orig', '47000_425044264236652_773023461_n.jpg', 'E:/xampp/htdocsuploadsusers124', 'b7i3YP3HR5ABp.jpg', 16649, 'image/jpeg', NULL, 0, '2014-02-19 01:44:35', NULL),
(117, 40, NULL, NULL, NULL, 'profile_picture', 'image', NULL, NULL, 'Orig', '205267_264390460363139_1459896730_n.jpg', 'E:/xampp/htdocs/mads/public_htmluploadsusers140', 'YAFCWXbF7lMhY.jpg', 50417, 'image/jpeg', NULL, 0, '2014-02-19 15:45:27', 24),
(118, 41, NULL, NULL, NULL, 'profile_picture', 'image', NULL, NULL, 'Orig', '486081_489108617814831_164506989_n.jpg', 'E:/xampp/htdocs/mads/public_htmluploadsusers141', 'voi8ZGaGGzNSM.jpg', 31426, 'image/jpeg', NULL, 0, '2014-02-19 15:48:58', 24),
(119, 42, NULL, NULL, NULL, 'profile_picture', 'image', NULL, NULL, 'Orig', '67379_160808940741699_444519665_n.jpg', 'E:/xampp/htdocs/mads/public_htmluploadsusers142', 'tZtZMkGaMSlrT.jpg', 29131, 'image/jpeg', NULL, 0, '2014-02-19 16:26:00', 24),
(120, 44, NULL, NULL, NULL, 'profile_picture', 'image', NULL, NULL, 'Orig', '66948_258775104258008_1009529765_n.jpg', 'E:/xampp/htdocs/mads/public_htmluploadsusers144', 'yN0z42VjPlIDF.jpg', 46271, 'image/jpeg', NULL, 0, '2014-02-19 16:52:07', 24),
(121, 45, NULL, NULL, NULL, 'profile_picture', 'image', NULL, NULL, 'Orig', '66468_263521697116682_904110784_n.jpg', 'E:/xampp/htdocs/mads/public_htmluploadsusers145', 'HpsVo2wRjVu3A.jpg', 36021, 'image/jpeg', NULL, 0, '2014-02-19 16:54:00', 24),
(122, 46, NULL, NULL, NULL, 'profile_picture', 'image', NULL, NULL, 'Orig', '64154_477595068974062_26967298_n.jpg', 'E:/xampp/htdocs/mads/public_htmluploadsusers146', 'MdrUTGWfmgjte.jpg', 22746, 'image/jpeg', NULL, 0, '2014-02-19 16:54:55', 24);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `news_id` int(11) NOT NULL AUTO_INCREMENT,
  `news_title` varchar(255) NOT NULL,
  `brief` text NOT NULL,
  `description` longtext NOT NULL,
  `display_order` int(11) NOT NULL,
  `picture_media_file_id` int(11) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `created_on` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `modified_on` datetime NOT NULL,
  PRIMARY KEY (`news_id`),
  KEY `news_created_by` (`created_by`),
  KEY `news_modified_by` (`modified_by`),
  KEY `news_picture_media_file_id` (`picture_media_file_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`news_id`, `news_title`, `brief`, `description`, `display_order`, `picture_media_file_id`, `active`, `created_by`, `created_on`, `modified_by`, `modified_on`) VALUES
(1, 'ad', 'adsf', '<p>adsf</p>\r\n', 3, NULL, 1, 1, '2014-02-06 21:00:23', 1, '2014-02-07 21:02:06');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `total_price` decimal(6,2) DEFAULT NULL,
  `total_shipping` decimal(6,2) DEFAULT NULL,
  `status` enum('open','delivered','paused','resume','cancelled','closed') DEFAULT NULL,
  `type` enum('home_appliance','electronics','services','print') DEFAULT NULL,
  `total_gst` decimal(6,2) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`order_id`),
  KEY `orders_user_id` (`user_id`),
  KEY `orders_created_by` (`created_by`),
  KEY `orders_modified_by` (`modified_by`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `total_price`, `total_shipping`, `status`, `type`, `total_gst`, `created_on`, `created_by`, `modified_on`, `modified_by`) VALUES
(1, 3, '444.00', '44.00', 'open', 'print', '45.00', '2014-02-04 16:11:05', 2, NULL, NULL),
(2, 6, '500.00', '50.00', 'open', 'home_appliance', '50.00', '2014-02-05 14:41:48', 6, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE IF NOT EXISTS `order_items` (
  `order_item_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `unit_price` decimal(6,2) DEFAULT NULL,
  `total_price` decimal(6,2) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`order_item_id`),
  KEY `order_items_product_id` (`product_id`),
  KEY `order_items_created_by` (`created_by`),
  KEY `order_items_modified_by` (`modified_by`),
  KEY `order_items_order_id` (`order_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`order_item_id`, `order_id`, `product_id`, `quantity`, `unit_price`, `total_price`, `created_by`, `created_on`, `modified_by`, `modified_on`) VALUES
(2, 2, 2, 10, '12.00', '120.00', 5, '2014-02-04 14:43:33', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
  `page_id` int(11) NOT NULL AUTO_INCREMENT,
  `page_title` varchar(255) NOT NULL,
  `page_slug` varchar(255) NOT NULL,
  `page_content` longtext NOT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_keywords` text,
  `meta_description` text,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `created_on` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `modified_on` datetime NOT NULL,
  PRIMARY KEY (`page_id`),
  KEY `pages_created_by` (`created_by`),
  KEY `pages_modified_by` (`modified_by`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`page_id`, `page_title`, `page_slug`, `page_content`, `meta_title`, `meta_keywords`, `meta_description`, `active`, `created_by`, `created_on`, `modified_by`, `modified_on`) VALUES
(6, 'test', 'test', '<span class="Apple-tab-span" style="white-space:pre">	</span>tests<span class="Apple-tab-span" style="white-space:pre">	</span>', 'test', 'test', 'test', 1, 1, '2014-02-01 13:03:16', 1, '2014-02-01 13:41:54');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(255) NOT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`role_id`, `role_name`) VALUES
(1, 'admin'),
(2, 'user'),
(3, 'print_supplier');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_migration`
--

CREATE TABLE IF NOT EXISTS `tbl_migration` (
  `version` varchar(255) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_migration`
--

INSERT INTO `tbl_migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1392806402),
('m140219_093233_change_active_to_status', 1392806404);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(1000) DEFAULT NULL,
  `lastname` varchar(1000) DEFAULT NULL,
  `username` varchar(1000) DEFAULT NULL,
  `password` varchar(1000) DEFAULT NULL,
  `register_surce` varchar(1000) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `paypal_email` varchar(1000) DEFAULT NULL,
  `email` varchar(1000) DEFAULT NULL,
  `address` text,
  `profile_description` text,
  `lat` varchar(1000) DEFAULT NULL,
  `logn` varchar(1000) DEFAULT NULL,
  `sex` enum('male','female') DEFAULT NULL,
  `private_email` varchar(1000) DEFAULT NULL,
  `profile_picture_media_file_id` int(11) DEFAULT NULL,
  `email_newsletter` tinyint(1) DEFAULT NULL,
  `reset_password_key` varchar(1000) DEFAULT NULL,
  `reset_password_timestamp` datetime DEFAULT NULL,
  `last_login_datetime` datetime DEFAULT NULL,
  `email_address_verified` tinyint(1) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `last_login_ip_address` varchar(1000) NOT NULL,
  `created_on` datetime DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  KEY `user_profile_picture_media_file_id` (`profile_picture_media_file_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=47 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `firstname`, `lastname`, `username`, `password`, `register_surce`, `date_of_birth`, `phone`, `paypal_email`, `email`, `address`, `profile_description`, `lat`, `logn`, `sex`, `private_email`, `profile_picture_media_file_id`, `email_newsletter`, `reset_password_key`, `reset_password_timestamp`, `last_login_datetime`, `email_address_verified`, `status`, `last_login_ip_address`, `created_on`, `modified_on`, `created_by`, `modified_by`) VALUES
(24, 'admin', 'asldj@gmail.com', 'admin', '21232f297a57a5a743894a0e4a801fc3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '18.291949733550336', '73.57749938964844', NULL, 'aljd@gmail.com', NULL, NULL, NULL, NULL, '2014-02-20 07:07:29', NULL, 1, '127.0.0.1', '2014-02-18 02:29:04', '2014-02-19 02:13:24', NULL, NULL),
(25, 'asdlkf@gmail.com', 'adsf@gmail.com', 'adflkj', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'asdlkf@gmail.com', 101, NULL, NULL, NULL, NULL, NULL, 1, '', '2014-02-18 02:29:57', '2014-02-18 02:29:57', NULL, NULL),
(26, 'asd@gmail.com', 'sldkfjQ@gmai.com', 'asdlkj', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'salkd@gmail.com', 102, NULL, NULL, NULL, NULL, NULL, 0, '', '2014-02-18 03:19:05', '2014-02-18 03:19:05', NULL, NULL),
(37, 'sadlkj', 'sdlkfj', 'adsflkj', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'sdlkj', 113, NULL, NULL, NULL, NULL, NULL, 0, '', '2014-02-19 01:14:16', '2014-02-19 01:14:16', NULL, NULL),
(40, 'aslam', 'aslam', 'aslam', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'aslam@gmail.com', 117, NULL, NULL, NULL, NULL, NULL, NULL, '', '2014-02-19 15:45:27', '2014-02-19 15:45:27', 24, 24),
(41, 'vilas', 'vias', 'vilas', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'vilas@gmail.com', 118, NULL, NULL, NULL, NULL, NULL, NULL, '', '2014-02-19 15:48:58', '2014-02-19 15:48:58', 24, 24),
(42, 'asdlkfj', 'asldkj', 'adf', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'asldkjf@gmail.com', 119, NULL, NULL, NULL, NULL, NULL, NULL, '', '2014-02-19 16:26:00', '2014-02-19 16:26:00', 24, 24),
(44, 'asldkfj', 'alsdkfj', 'aldsk', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'sldkfj@gmail.com', 120, NULL, NULL, NULL, NULL, NULL, NULL, '', '2014-02-19 16:52:07', '2014-02-19 16:52:07', 24, 24),
(45, 'asdlkfj', 'aldfksj', 'asdkl', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'asldkfj@gmail.com', 121, NULL, NULL, NULL, NULL, NULL, NULL, '', '2014-02-19 16:54:00', '2014-02-19 16:54:00', 24, 24),
(46, 'sdlkf', 'sdlfk', 'ads', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'sldk@gmail.com', 122, NULL, NULL, NULL, NULL, NULL, NULL, '', '2014-02-19 16:54:55', '2014-02-19 16:54:55', 24, 24);

-- --------------------------------------------------------

--
-- Table structure for table `user_posts`
--

CREATE TABLE IF NOT EXISTS `user_posts` (
  `user_post_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `post_type` enum('story','picture') NOT NULL,
  `picture_thumb_media_file_id` int(11) DEFAULT NULL,
  `picture_media_file_id` int(11) DEFAULT NULL,
  `comment` text,
  `story_background_colour` varchar(20) DEFAULT NULL,
  `story_font_style` varchar(20) DEFAULT NULL,
  `is_public` tinyint(1) NOT NULL DEFAULT '1',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `total_likes` int(11) NOT NULL DEFAULT '0',
  `total_shares` int(11) NOT NULL DEFAULT '0',
  `reported_abuse` tinyint(1) NOT NULL DEFAULT '0',
  `created_by` int(11) NOT NULL,
  `created_on` datetime DEFAULT NULL,
  `modified_by` int(11) NOT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`user_post_id`),
  KEY `user_posts_category_id` (`category_id`),
  KEY `user_posts_user_id` (`user_id`),
  KEY `user_posts_created_by` (`created_by`),
  KEY `user_posts_modified_by` (`modified_by`),
  KEY `user_posts_picture_thumb` (`picture_thumb_media_file_id`),
  KEY `user_posts_picture` (`picture_media_file_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=46 ;

--
-- Dumping data for table `user_posts`
--

INSERT INTO `user_posts` (`user_post_id`, `user_id`, `category_id`, `post_type`, `picture_thumb_media_file_id`, `picture_media_file_id`, `comment`, `story_background_colour`, `story_font_style`, `is_public`, `active`, `total_likes`, `total_shares`, `reported_abuse`, `created_by`, `created_on`, `modified_by`, `modified_on`) VALUES
(11, 1, 2, 'story', 3, NULL, NULL, NULL, NULL, 1, 1, 0, 0, 0, 1, '2014-02-03 15:50:17', 1, '2014-02-05 15:50:29'),
(17, 1, 2, 'story', NULL, NULL, NULL, NULL, NULL, 1, 1, 0, 0, 0, 1, '2014-02-05 14:19:56', 1, NULL),
(36, 1, 2, 'story', NULL, NULL, 'hello Ajij .. how you doing ? ', 'red', 'arial', 1, 1, 0, 0, 0, 1, '2014-02-05 17:26:05', 1, '2014-02-13 17:50:28'),
(37, 1, 2, 'story', NULL, NULL, 'adsfasdf', 'red', 'arial', 1, 0, 0, 0, 1, 1, '2014-02-05 17:46:55', 1, '2014-02-05 17:46:55'),
(38, 1, 2, 'picture', NULL, 89, 'ertrt\r\n', '', '', 1, 1, 0, 0, 0, 1, '2014-02-05 17:47:46', 1, '2013-11-14 12:33:52'),
(39, 1, 2, 'picture', NULL, 87, 'asdfsdaf', '', '', 1, 0, 0, 0, 0, 1, '2014-02-05 18:22:49', 1, '2014-01-01 21:25:50'),
(40, 1, 2, 'picture', NULL, NULL, 'asdfsdaf', '', '', 1, 1, 0, 0, 0, 1, '2014-02-05 18:22:49', 1, '2013-11-01 18:22:49'),
(41, 1, 2, 'picture', NULL, NULL, 'asdfdasf', '', '', 1, 1, 0, 0, 0, 1, '2014-02-05 18:25:08', 1, '2014-02-05 18:25:08'),
(42, 1, 2, 'picture', NULL, NULL, 'asdfdasf', '', '', 1, 1, 0, 0, 0, 1, '2014-02-05 18:26:38', 1, '2013-10-30 18:26:38'),
(43, 1, 2, 'picture', NULL, NULL, 'aaaaa', '', '', 1, 0, 0, 0, 0, 1, '2014-02-05 18:36:30', 1, '2012-09-01 18:36:30'),
(44, 1, 2, 'picture', NULL, 65, 'adsf', '', '', 1, 1, 0, 0, 0, 1, '2014-02-06 08:58:53', 1, '2014-03-21 08:58:53'),
(45, 1, 2, 'picture', NULL, 70, 'asdfads', '', '', 1, 1, 0, 0, 0, 1, '2014-02-06 11:57:34', 1, '2014-02-06 11:57:34');

-- --------------------------------------------------------

--
-- Table structure for table `user_post_comments`
--

CREATE TABLE IF NOT EXISTS `user_post_comments` (
  `user_post_comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `created_on` datetime NOT NULL,
  PRIMARY KEY (`user_post_comment_id`),
  KEY `user_post_comments_post_id` (`post_id`),
  KEY `user_post_comments_created_by` (`created_by`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `user_post_comments`
--

INSERT INTO `user_post_comments` (`user_post_comment_id`, `post_id`, `comment`, `active`, `created_by`, `created_on`) VALUES
(1, 44, 'hi', 0, 1, '2014-02-06 09:25:59'),
(2, 39, 'hello', 0, 1, '2014-02-05 09:51:50');

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE IF NOT EXISTS `user_roles` (
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_on` datetime NOT NULL,
  PRIMARY KEY (`user_id`,`role_id`),
  KEY `user_roles_role_id` (`role_id`),
  KEY `user_roles_created_by` (`created_by`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`user_id`, `role_id`, `created_by`, `created_on`) VALUES
(24, 1, 24, '2014-02-04 00:00:00');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `email_messages`
--
ALTER TABLE `email_messages`
  ADD CONSTRAINT `email_messages_from_user_id` FOREIGN KEY (`from_user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `email_messages_parent_email_message_id` FOREIGN KEY (`parent_email_message_id`) REFERENCES `email_messages` (`email_message_id`),
  ADD CONSTRAINT `email_messages_to_user_id` FOREIGN KEY (`to_user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `media_files`
--
ALTER TABLE `media_files`
  ADD CONSTRAINT `media_file_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `user_profile_picture_media_file_id` FOREIGN KEY (`profile_picture_media_file_id`) REFERENCES `media_files` (`media_file_id`);

--
-- Constraints for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD CONSTRAINT `user_roles_created_by` FOREIGN KEY (`created_by`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `user_roles_role_id` FOREIGN KEY (`role_id`) REFERENCES `roles` (`role_id`),
  ADD CONSTRAINT `user_roles_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
