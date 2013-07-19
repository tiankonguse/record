-- phpMyAdmin SQL Dump
-- version 3.5.5
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2013 年 06 月 19 日 22:10
-- 服务器版本: 5.5.24-log
-- PHP 版本: 5.4.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `tiankong_tksite`
--

-- --------------------------------------------------------

--
-- 表的结构 `share_big_class`
--

CREATE TABLE IF NOT EXISTS `share_big_class` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `share_comment`
--

CREATE TABLE IF NOT EXISTS `share_comment` (
  `id` int(11) NOT NULL,
  `pre` int(11) NOT NULL DEFAULT '0',
  `name` varchar(45) NOT NULL,
  `content` longtext NOT NULL,
  `time` bigint(20) NOT NULL,
  `tiankong_tksite` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_share_comment_share_record_idx` (`tiankong_tksite`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `share_map_big_small_tag`
--

CREATE TABLE IF NOT EXISTS `share_map_big_small_tag` (
  `big_id` int(11) NOT NULL,
  `small_id` int(11) NOT NULL,
  PRIMARY KEY (`big_id`,`small_id`),
  KEY `fk_share_map_big_small_tag_share_big_class1_idx` (`big_id`),
  KEY `fk_share_map_big_small_tag_share_small_class1_idx` (`small_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `share_map_class_record`
--

CREATE TABLE IF NOT EXISTS `share_map_class_record` (
  `record_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  PRIMARY KEY (`record_id`,`class_id`),
  KEY `fk_share_map_class_record_share_record1_idx` (`record_id`),
  KEY `fk_share_map_class_record_share_small_class1_idx` (`class_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `share_record`
--

CREATE TABLE IF NOT EXISTS `share_record` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `time` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `share_record`
--

-- --------------------------------------------------------

--
-- 表的结构 `share_small_class`
--

CREATE TABLE IF NOT EXISTS `share_small_class` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `share_tag`
--

CREATE TABLE IF NOT EXISTS `share_tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `share_tag`
--

-- --------------------------------------------------------

--
-- 表的结构 `share_tag_map`
--

CREATE TABLE IF NOT EXISTS `share_tag_map` (
  `tag_id` int(11) NOT NULL,
  `record_id` int(11) NOT NULL,
  PRIMARY KEY (`tag_id`,`record_id`),
  KEY `fk_share_tag_map_share_record1_idx` (`record_id`),
  KEY `fk_share_tag_map_share_tag1_idx` (`tag_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `share_tag_map`
--


--
-- 限制导出的表
--

--
-- 限制表 `share_comment`
--
ALTER TABLE `share_comment`
  ADD CONSTRAINT `fk_share_comment_share_record` FOREIGN KEY (`tiankong_tksite`) REFERENCES `share_record` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- 限制表 `share_map_big_small_tag`
--
ALTER TABLE `share_map_big_small_tag`
  ADD CONSTRAINT `fk_share_map_big_small_tag_share_big_class1` FOREIGN KEY (`big_id`) REFERENCES `share_big_class` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_share_map_big_small_tag_share_small_class1` FOREIGN KEY (`small_id`) REFERENCES `share_small_class` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- 限制表 `share_map_class_record`
--
ALTER TABLE `share_map_class_record`
  ADD CONSTRAINT `fk_share_map_class_record_share_record1` FOREIGN KEY (`record_id`) REFERENCES `share_record` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_share_map_class_record_share_small_class1` FOREIGN KEY (`class_id`) REFERENCES `share_small_class` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- 限制表 `share_tag_map`
--
ALTER TABLE `share_tag_map`
  ADD CONSTRAINT `fk_share_tag_map_share_record1` FOREIGN KEY (`record_id`) REFERENCES `share_record` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_share_tag_map_share_tag1` FOREIGN KEY (`tag_id`) REFERENCES `share_tag` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
