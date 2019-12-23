-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 23, 2019 at 07:48 AM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ijdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `author`
--

CREATE TABLE `author` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` char(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `author`
--

INSERT INTO `author` (`id`, `name`, `email`, `password`) VALUES
(1, 'Autor1', 'autor1@gmail.com', '062f87626e2e92a1c890b8e3eac11304'),
(2, 'Autor2', 'autor2@gmail.com', '68d389403c525be0622a3ebe8c1781f9'),
(3, 'Autor3', 'autor3@gmail.com', '937e2e5694d1c917e6479708c51c8857'),
(4, 'Autor4', 'autor4@gmail.com', 'bcc784905998236bff9820286414f81f'),
(5, 'Autor5', 'autor5@gmail.com', '91aed47acaaba7fe1f33807a0700e55f'),
(6, 'Autor6', 'autor6@gmail.com', 'c6665e5235bceb4eff689d6634659928'),
(7, 'Autor7', 'autor7@gmail.com', '46931e5216a21c50b30c67d3a0dc7a07'),
(15, 'Autor8', 'autor8@gmail.com', '765776222982727fb404afead1cf531d'),
(17, 'Autor9', 'autor9@gmail.com', '9adfd97f2cc16a578f2faaa5733d3749');

-- --------------------------------------------------------

--
-- Table structure for table `authorrole`
--

CREATE TABLE `authorrole` (
  `authorid` int(11) NOT NULL,
  `roleid` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `authorrole`
--

INSERT INTO `authorrole` (`authorid`, `roleid`) VALUES
(1, 'Account Administrator'),
(2, 'Content Editor'),
(3, 'Site Administrator'),
(4, 'Site Administrator'),
(5, 'Site Administrator'),
(6, 'Site Administrator'),
(7, 'Account Administrator'),
(15, 'Account Administrator'),
(15, 'Content Editor'),
(15, 'Site Administrator');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'Knock-knock'),
(2, 'Cross the road'),
(3, 'Lawyers'),
(4, 'Walk the bar'),
(5, 'fdefd'),
(14, 'dsada'),
(15, 'test final'),
(16, 'dhglhj');

-- --------------------------------------------------------

--
-- Table structure for table `joke`
--

CREATE TABLE `joke` (
  `id` int(11) NOT NULL,
  `joketext` text,
  `jokedate` date NOT NULL,
  `authorid` int(11) DEFAULT NULL,
  `visible` enum('NO','YES') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `joke`
--

INSERT INTO `joke` (`id`, `joketext`, `jokedate`, `authorid`, `visible`) VALUES
(2, 'Knock-knock! Who\\\'s there? Boo! \"Boo\" who? Don\\\'t cry; it\\\'s on', '2019-12-06', 1, 'NO'),
(3, 'A man walks into a bar. \"Ouch.\" test author 8', '2009-04-01', 15, 'NO'),
(4, '2019-12-06 10:09:58 test', '2009-04-01', 4, 'NO'),
(5, '\'How many lawyers does it take to screw in a lightbulb? I can\\\'t', '2019-12-06', 3, 'NO'),
(6, 'test', '2019-12-19', 1, 'NO'),
(7, 'tedfsf', '2019-12-19', 1, 'NO'),
(9, 'ttttttttttttt', '2019-12-19', 2, 'NO'),
(10, 'My new joke123', '2019-12-19', 2, 'NO');

-- --------------------------------------------------------

--
-- Table structure for table `jokecategory`
--

CREATE TABLE `jokecategory` (
  `jokeid` int(11) NOT NULL,
  `categoryid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `jokecategory`
--

INSERT INTO `jokecategory` (`jokeid`, `categoryid`) VALUES
(2, 1),
(3, 1),
(3, 2),
(3, 3),
(3, 4),
(3, 5),
(3, 14),
(3, 15),
(3, 16),
(4, 3),
(5, 3),
(6, 1),
(6, 2),
(7, 1),
(9, 2),
(10, 1),
(10, 2),
(10, 3),
(10, 4);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `description`) VALUES
('Account Administrator', 'Add, remove, and edit authors'),
('Content Editor', 'Add, remove, and edit jokes'),
('Site Administrator', 'Add, remove, and edit categories');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `authorrole`
--
ALTER TABLE `authorrole`
  ADD PRIMARY KEY (`authorid`,`roleid`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `joke`
--
ALTER TABLE `joke`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jokecategory`
--
ALTER TABLE `jokecategory`
  ADD PRIMARY KEY (`jokeid`,`categoryid`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `author`
--
ALTER TABLE `author`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `joke`
--
ALTER TABLE `joke`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
