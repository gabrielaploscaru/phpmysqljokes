-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Gazdă: 127.0.0.1
-- Timp de generare: dec. 28, 2019 la 03:12 PM
-- Versiune server: 10.4.11-MariaDB
-- Versiune PHP: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Bază de date: `ijdb`
--

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `author`
--

CREATE TABLE `author` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` char(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Eliminarea datelor din tabel `author`
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
-- Structură tabel pentru tabel `authorrole`
--

CREATE TABLE `authorrole` (
  `authorid` int(11) NOT NULL,
  `roleid` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Eliminarea datelor din tabel `authorrole`
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
-- Structură tabel pentru tabel `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Eliminarea datelor din tabel `category`
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
-- Structură tabel pentru tabel `filestore`
--

CREATE TABLE `filestore` (
  `id` int(11) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `mimetype` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `filedata` mediumblob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `joke`
--

CREATE TABLE `joke` (
  `id` int(11) NOT NULL,
  `joketext` text DEFAULT NULL,
  `jokedate` date NOT NULL,
  `authorid` int(11) DEFAULT NULL,
  `visible` enum('NO','YES') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Eliminarea datelor din tabel `joke`
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
-- Structură tabel pentru tabel `jokecategory`
--

CREATE TABLE `jokecategory` (
  `jokeid` int(11) NOT NULL,
  `categoryid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Eliminarea datelor din tabel `jokecategory`
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
-- Structură tabel pentru tabel `role`
--

CREATE TABLE `role` (
  `id` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Eliminarea datelor din tabel `role`
--

INSERT INTO `role` (`id`, `description`) VALUES
('Account Administrator', 'Add, remove, and edit authors'),
('Content Editor', 'Add, remove, and edit jokes'),
('Site Administrator', 'Add, remove, and edit categories');

--
-- Indexuri pentru tabele eliminate
--

--
-- Indexuri pentru tabele `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`id`);

--
-- Indexuri pentru tabele `authorrole`
--
ALTER TABLE `authorrole`
  ADD PRIMARY KEY (`authorid`,`roleid`);

--
-- Indexuri pentru tabele `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexuri pentru tabele `filestore`
--
ALTER TABLE `filestore`
  ADD PRIMARY KEY (`id`);

--
-- Indexuri pentru tabele `joke`
--
ALTER TABLE `joke`
  ADD PRIMARY KEY (`id`);

--
-- Indexuri pentru tabele `jokecategory`
--
ALTER TABLE `jokecategory`
  ADD PRIMARY KEY (`jokeid`,`categoryid`);

--
-- Indexuri pentru tabele `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pentru tabele eliminate
--

--
-- AUTO_INCREMENT pentru tabele `author`
--
ALTER TABLE `author`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT pentru tabele `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pentru tabele `filestore`
--
ALTER TABLE `filestore`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pentru tabele `joke`
--
ALTER TABLE `joke`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
