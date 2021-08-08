-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 08, 2021 at 05:12 PM
-- Server version: 8.0.21
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hackacode`
--

-- --------------------------------------------------------

--
-- Table structure for table `assignments`
--

DROP TABLE IF EXISTS `assignments`;
CREATE TABLE IF NOT EXISTS `assignments` (
  `sno` int NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `submissions` text NOT NULL,
  `c_id` varchar(10) NOT NULL,
  `a_id` varchar(10) NOT NULL,
  PRIMARY KEY (`sno`),
  UNIQUE KEY `a_id` (`a_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `assignments`
--

INSERT INTO `assignments` (`sno`, `title`, `description`, `submissions`, `c_id`, `a_id`) VALUES
(1, 'draw that cat', 'draw that cat draw that catdraw that catdraw that catdraw that catdraw that catdraw that catdraw that catdraw that catdraw that catdraw that catdraw that catdraw that catdraw that catdraw that cat', '[{\"studentid\":\"fg6778\",\"link\":\"haha\"}]', 'CLW785', ''),
(9, 'Bestvalentinesdaygift.in Logo', 'big description one here is the', '', 'clw538', 'asg206'),
(10, 'showing everly', 'the proof', '', 'clw538', 'asg100'),
(11, 'new one again', 'hha ha dear', '', 'clw612', 'asg84'),
(12, 'New for this class', 'nothing to do, just chill', '[\"assignment/asg200/Internathon.pdf\"]', 'clw759', 'asg200'),
(13, 'new assignment is being....', 'given to u guys', '[\"assignment/asg374/report.pdf\"]', 'clw538', 'asg374'),
(14, 'Math tutorial sheet', 'Finish this tomorrow or else mark is gone , hehe', '[\"assignment/asg77/exp-cn-2.pdf\"]', 'clw97', 'asg77'),
(15, 'Maths Hw', 'Do these necessary problems', '', 'clw747', 'asg469'),
(16, 'Maths Hw', 'Do these necessary problems', '', 'clw747', 'asg65'),
(17, 'Science Assignment', 'This is your assignment', '', 'clw64', 'asg424'),
(18, 'Mathematics assignment', 'This is your assignment', '[\"assignment/asg892/exp-cn-2.pdf\"]', 'clw831', 'asg892');

-- --------------------------------------------------------

--
-- Table structure for table `classroom`
--

DROP TABLE IF EXISTS `classroom`;
CREATE TABLE IF NOT EXISTS `classroom` (
  `sno` int NOT NULL AUTO_INCREMENT,
  `admin` text NOT NULL,
  `c_code` varchar(10) NOT NULL,
  `students` text NOT NULL,
  `assignment` text NOT NULL,
  `announcement` text NOT NULL,
  `c_name` varchar(20) NOT NULL,
  `admin_id` varchar(10) NOT NULL,
  PRIMARY KEY (`sno`),
  UNIQUE KEY `c_code` (`c_code`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `classroom`
--

INSERT INTO `classroom` (`sno`, `admin`, `c_code`, `students`, `assignment`, `announcement`, `c_name`, `admin_id`) VALUES
(1, 'Deeban Sk', 'CL45582', '[{\"userid\":\"id64581341\",\"date\":\"2021-08-07 06:25:56\"}]', '[{\"name\":\"First one\",\"date\":\"2021-08-07 06:25:56\"}]', 'This is to say that u r a rascal my boi', '12MPE58 Name', 'RA77855698'),
(2, 'deebansir ji', 'CLA78852', '', '', '', 'NEW852', 'RA778557'),
(3, 'deebansir ji', 'CLA76852', '', '', '', 'NEW852', 'RA778557'),
(4, 'deebansir ji', '45882', '', '', '', 'Cla7852', 'RA778557'),
(5, 'deebansir ji', 'clw684', '', '', '', 'fvfv', 'RA778557'),
(6, 'deebansir ji', 'clw856', '', '', '', 'New4588', 'RA778557'),
(7, 'deebansir ji', 'clw538', '[{\"userid\":\"2\",\"date\":\"2021-08-07 10:52:45\"},{\"userid\":\"1\",\"date\":\"2021-08-07 10:53:30\"},{\"userid\":\"3\",\"date\":\"2021-08-07 12:21:29\"},{\"userid\":\"4\",\"date\":\"2021-08-08 06:18:33\"}]', '', '', 'FB8552', 'RA778557'),
(8, 'deebansir ji', 'clw319', '', '', '', 'HS885', 'RA15224'),
(9, 'deebansir ji', 'clw759', '[{\"userid\":\"3\",\"date\":\"2021-08-07 23:26:19\"}]', '', '', '254PKO', 'RA15224'),
(10, 'deebansir ji', 'clw927', '[{\"userid\":\"3\",\"date\":\"2021-08-07 23:26:41\"}]', '', '', '256PKO', 'RA15224'),
(11, 'deebansir ji', 'clw402', '[{\"userid\":\"4\",\"date\":\"2021-08-08 06:30:10\"}]', '', '', '250PKO', 'RA15224'),
(12, 'rajmun', 'clw612', '[{\"userid\":\"4\",\"date\":\"2021-08-08 06:29:43\"},{\"userid\":\"2\",\"date\":\"2021-08-08 07:28:10\"}]', '', '', 'newone', '3'),
(13, 'subatra', 'clw747', '[{\"userid\":\"1\",\"date\":\"2021-08-08 10:13:02\"},{\"userid\":\"2\",\"date\":\"2021-08-08 13:59:54\"}]', '', '', 'Science - e2', '1'),
(14, 'subatra', 'clw64', '[{\"userid\":\"1\",\"date\":\"2021-08-08 15:32:13\"}]', '', '', 'Science', '1'),
(15, 'subatra', 'clw831', '[{\"userid\":\"1\",\"date\":\"2021-08-08 15:45:19\"},{\"userid\":\"2\",\"date\":\"2021-08-08 15:46:39\"}]', '', '', 'Mathematics - D2', '1');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int NOT NULL AUTO_INCREMENT,
  `comment` text NOT NULL,
  `comment_author` varchar(255) NOT NULL,
  `post_id` int NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `author_id` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `comment`, `comment_author`, `post_id`, `date`, `author_id`) VALUES
(4, 'Please refere to RD sharma , it\\\'s a great resource', 'subatra', 4, '2021-08-07 07:49:24', 1),
(6, 'Mdn docs rocks', 'subatra', 5, '2021-08-07 08:27:23', 1),
(7, 'Rd sharma op', 'Raj', 4, '2021-08-08 10:07:35', 4),
(9, 'Nice', 'subatra', 8, '2021-08-08 12:04:27', 1);

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

DROP TABLE IF EXISTS `events`;
CREATE TABLE IF NOT EXISTS `events` (
  `event_id` int NOT NULL AUTO_INCREMENT,
  `event_name` varchar(255) NOT NULL,
  `event_details` text NOT NULL,
  `location` varchar(255) NOT NULL,
  `org` text NOT NULL,
  `author_id` varchar(255) NOT NULL,
  `author_name` text NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`event_id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`event_id`, `event_name`, `event_details`, `location`, `org`, `author_id`, `author_name`, `date`) VALUES
(1, 'Hackacode 2021', '7 th august more info here', 'remote/online', 'SRM Institute of Science and Technology', '1', 'everly', '2021-08-07 23:47:54'),
(2, 'Internathon', 'Internships', 'remote/online', 'SRM Institute of Science and Technology', '1', 'vishal', '2021-08-08 00:07:40'),
(3, 'Internship fest', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search ', 'Remote/online', 'SRM Institute of Science and Technology', '1', 'vishal', '2021-08-08 00:19:22'),
(4, 'Intern fair', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets ', 'Remote/online', 'SRM Institute of Science and Technology', '1', 'vishal', '2021-08-08 00:19:22'),
(5, 'zaxan', 'zaxan rocks', 'remote/online', 'SRM Institute of Science and Technology', '4', 'Raj', '2021-08-07 10:00:13'),
(9, 'battlegournd', 'woo', 'remote/online', '', '2', 'Vive', '2021-08-08 07:42:39'),
(10, 'zaxan', 'woo', 'remote/online', '', '2', 'Vive', '2021-08-08 07:44:30'),
(12, 'yolo', 'yolo', 'remote/online', '', '1', 'subatra', '2021-08-08 03:57:22');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

DROP TABLE IF EXISTS `feedback`;
CREATE TABLE IF NOT EXISTS `feedback` (
  `id` int NOT NULL AUTO_INCREMENT,
  `content` text NOT NULL,
  `teacher_name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `teacher_id` varchar(10) NOT NULL,
  `class_id` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `content`, `teacher_name`, `teacher_id`, `class_id`) VALUES
(1, 'amazing', 'rajmun', '3', 'clw612'),
(2, 'good class, enjoyed it a lot', 'subatra', '1', 'clw747');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

DROP TABLE IF EXISTS `post`;
CREATE TABLE IF NOT EXISTS `post` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `content` text NOT NULL,
  `class_id` varchar(50) NOT NULL,
  `user_id` int NOT NULL,
  `timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `title`, `content`, `class_id`, `user_id`, `timestamp`) VALUES
(2, 'To-do List', '<p>please help me with making a js to do list, need help</p>\r\n', 'CLS345', 2, '2021-08-07 03:59:34'),
(3, 'Technical Documentation Page', '<p>such a good convo</p>\r\n', 'CLS345', 2, '2021-08-07 04:31:38'),
(4, 'How to solve this maths question', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc vestibulum dolor sed velit dignissim congue. Vivamus pretium dignissim aliquam. Pellentesque ut condimentum massa. Integer eget condimentum dolor. Quisque dictum arcu at libero placerat congue. Sed venenatis risus nec nisi aliquet scelerisque. Vivamus ac massa vitae risus dapibus ullamcorper non a tellus. Suspendisse consequat, justo vitae tristique congue, nisi ante viverra ante, et facilisis mauris sapien ut augue. Donec convallis orci finibus leo gravida dignissim. Morbi ut malesuada quam. Quisque egestas justo erat, semper sodales massa lacinia nec. Donec commodo, tortor at dictum hendrerit, massa diam vestibulum eros, ac auctor nunc nulla eget felis. Donec molestie ligula laoreet suscipit pretium. In hac habitasse platea dictumst. Etiam tristique eros eu dapibus commodo. Sed risus sem, tempor vehicula dictum eu, fermentum non justo.</p>\r\n\r\n<p>Aliquam id ultricies ex, at porta sem. Praesent ut maximus felis. Morbi maximus et ante ac tristique. Sed iaculis aliquet elit at dapibus. Donec lectus nisi, euismod vitae nunc et, vestibulum lacinia diam. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent vel arcu non lorem vehicula ullamcorper. Vestibulum feugiat vel quam eu vulputate. Duis tincidunt orci ligula, nec posuere nisi auctor dapibus. Morbi efficitur eros leo, eget sagittis nulla finibus vitae. Nulla at ipsum dictum, vulputate felis quis, lacinia felis. Donec massa magna, egestas consectetur dolor in, tincidunt luctus eros. Aliquam erat volutpat. Vivamus vel convallis urna.</p>\r\n\r\n<p>Morbi consectetur neque sit amet dolor congue, at scelerisque sapien efficitur. Mauris elementum augue varius, vestibulum odio vel, cursus quam. Fusce placerat odio venenatis sollicitudin porttitor. Sed id elementum diam. Duis volutpat sapien a magna volutpat, non elementum massa fringilla. Phasellus et nisl elit. Nam tempor sapien felis, sed ullamcorper augue semper id. Praesent facilisis lectus eros, non viverra nunc malesuada non. Nulla vestibulum consectetur euismod. Ut sit amet condimentum magna. Fusce eget hendrerit nisi, eu tincidunt arcu. Aliquam placerat quis lectus ut rutrum. Suspendisse tristique congue nulla sit amet sodales. Aliquam ut libero vitae diam bibendum tristique. Donec quis mauris neque. Cras rhoncus, neque ut posuere pretium, nisl nibh tristique erat, ut viverra urna nunc eget magna.</p>\r\n\r\n<p>Nulla posuere blandit cursus. Quisque at finibus arcu. Quisque facilisis pharetra venenatis. Ut lectus libero, rutrum in massa quis, convallis vestibulum quam. Nam justo neque, lacinia at mi non, feugiat semper enim. Sed venenatis, metus et dignissim sagittis, magna sem egestas tellus, a posuere risus orci nec nibh. In consectetur, purus a laoreet hendrerit, felis metus semper sem, nec sollicitudin erat ipsum non magna. Morbi porttitor rhoncus dui, a tincidunt velit bibendum sed. Duis blandit pellentesque facilisis. Sed accumsan ac odio a bibendum. Vivamus rhoncus turpis ut lorem egestas ultricies.</p>\r\n\r\n<p>Duis maximus urna dui, tincidunt imperdiet felis mollis eget. Sed efficitur consequat mollis. Nullam vehicula lacinia pretium. Etiam id dictum massa. Duis ut massa nec lectus tincidunt semper. Aliquam et dui tempus, ullamcorper nulla a, pellentesque velit. Donec pretium, augue a faucibus ullamcorper, lacus enim euismod leo, sed posuere velit orci in tellus. Aliquam vestibulum varius sapien at iaculis. Vestibulum feugiat massa vitae feugiat mattis. Sed at tortor tellus. Maecenas faucibus ipsum urna, quis convallis metus consectetur scelerisque. Praesent iaculis tincidunt eros eu scelerisque. Aliquam nunc orci, ullamcorper eget dolor in, pretium interdum tortor.</p>\r\n', 'CLS345', 1, '2021-08-07 06:47:09'),
(7, 'let\'s talk about our mental health shall we?', '<p>hey</p>\r\n', 'clw612', 2, '2021-08-08 08:20:38'),
(8, 'Car E Rental', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets&nbsp;</p>\r\n', 'clw747', 1, '2021-08-08 11:25:26');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(20) NOT NULL,
  `org` text NOT NULL,
  `classes` text NOT NULL,
  `calendly_link` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `org`, `classes`, `calendly_link`) VALUES
(1, 'subatra', 'subatra@gmail.com', '$2y$10$GzBbPL43zzGIKWnAw6Lv4O8EEIoHZ8oh6Pvfn5Lkt7XF4vqegX1Ey', '0', '', '[\"clw612\",\"clw747\",\"clw64\",\"clw831\"]', '<!-- Calendly link widget begin -->\r\n<link href=\"https://assets.calendly.com/assets/external/widget.css\" rel=\"stylesheet\">\r\n<script src=\"https://assets.calendly.com/assets/external/widget.js\" type=\"text/javascript\" async></script>\r\n<a href=\"\" onclick=\"Calendly.initPopupWidget({url: \'https://calendly.com/yashmalho1999\'});return false;\">Schedule time with your teacher</a>\r\n<!-- Calendly link widget end -->'),
(2, 'Vive', 'viveksingh@gmail.com', '$2y$10$8aeD1jehkg0fNqmYmYW0tuMcEroW6oaQ5KDveur/D1c0fH7oWux/y', '1', '', '[\"clw612\",\"clw747\",\"clw831\"]', ''),
(3, 'rajmun', 'r@k.j', '$2y$10$nBUtKq5yeFA/CVUITAQjdeGCGN2RmRmxzYBq/oiCq.pxOF8oF34w2', '0', '', '[\"clw759\",\"clw927\"]', ''),
(4, 'Yash Malhotra', 'yashmalho1999@gmail.com', '$2y$10$TNFTqNpDIYrjSQYEHrOtdO0OEaMhZNTBLdebOrA.n3GAMo7AABK3u', '1', '', '[\"clw612\",\"clw402\"]', ''),
(5, 'Rajmun Khan', 't@s.L', '$2y$10$fN75lnpjHCC0eukoB72gne.p2H5d4bdJnkVSEbRFfbkr7UV.j5jpu', '0', 'mera apna', '[\"clw538\",\"clw402\",\"clw684\"]', '');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
