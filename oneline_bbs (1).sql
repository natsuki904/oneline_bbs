-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2016 年 1 月 23 日 13:37
-- サーバのバージョン： 5.6.26
-- PHP Version: 5.5.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `oneline_bbs`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(11) NOT NULL,
  `nickname` varchar(20) NOT NULL,
  `comment` text NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `posts`
--

INSERT INTO `posts` (`id`, `nickname`, `comment`, `created`) VALUES
(76, 'かぜひいた', 'あああああああ\r\n', '2016-01-20 16:01:45'),
(77, 'なんで', '？？？？', '2016-01-21 13:59:16'),
(83, 'あきら', 'ひとみあ', '2016-01-21 22:17:42'),
(86, 'ばっちょい', 'たべたい', '2016-01-21 22:25:50'),
(92, 'すご', 'awsome', '2016-01-22 13:20:49'),
(94, 'どうして？', 'どうして？', '2016-01-22 14:37:04'),
(97, 'よし', '解決！！', '2016-01-23 10:01:00'),
(98, 'くそー', 'さああああ', '2016-01-23 09:59:31');

-- --------------------------------------------------------

--
-- テーブルの構造 `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL,
  `nickname` varchar(255) NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `password` varchar(100) NOT NULL,
  `picture` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `modified` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `users`
--

INSERT INTO `users` (`id`, `nickname`, `email`, `password`, `picture`, `created`, `modified`) VALUES
(1, 'あああああ', 'っっっっｓ', 'a59e375e7e163c060ec5103e61f24bf008661a68', '20151021030215', '2015-10-21 12:04:12', NULL),
(2, 'aaaa', '', 'c441f164b1283bd56e0aa24dabb133150397df87', '2015102103260606.jpg', '2015-10-21 12:26:09', NULL),
(3, 'natsuki', 'runru904@gmail.com', 'a3058bbc69b8ea7dfdc4e6ec0f344d39142bf7b2', '2015102103260606.jpg', '2015-10-22 12:09:28', NULL),
(4, 'hirona', 'hoge', 'e86797b125848e625d70987c20e4127bbb3db51a', '2015102214281306.jpg', '2015-10-22 23:28:15', NULL),
(5, 'らららい', 'rararai', '97c7d276a303199fcfa8bf2dd20ff6c07af7ba45', '2015102217201603.jpg', '2015-10-23 02:20:40', NULL),
(6, 'ぴくみん', 'わわわ', '673e3d592d490cf47ea0cf76f8297f1ea90006b6', '2015102303325602.jpg', '2015-10-23 12:32:58', NULL),
(7, 'なつ', 'てる', 'd2a4d1a7e5308eb33481c6595d7b03f376320b73', '2015102407215601.jpg', '2015-10-24 16:31:31', NULL),
(8, '1024', '1024', '128351137a9c47206c4507dcf2e6fbeeca3a9079', '20151026144619', '2015-10-26 23:46:20', NULL),
(9, 'aaa', 'bbb', 'f36b4825e5db2cf7dd2d2593b3f5c24c0311d8b2', '20151103234146', '2015-11-04 08:41:48', NULL),
(10, 'hoge', 'hoge@', '31f30ddbcb1bf8446576f0e64aa4c88a9f055e3c', '20160121071846', '2016-01-21 16:18:48', NULL),
(11, 'hoge', 'hoge', 'hoge', '', '2016-01-23 17:56:08', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=101;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
