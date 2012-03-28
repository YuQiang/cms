-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2012 年 03 月 28 日 17:23
-- 服务器版本: 5.5.8
-- PHP 版本: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `cms`
--

-- --------------------------------------------------------

--
-- 表的结构 `wf_categorys`
--

CREATE TABLE IF NOT EXISTS `wf_categorys` (
  `cid` int(11) NOT NULL AUTO_INCREMENT COMMENT '类目ID',
  `parent` int(11) NOT NULL DEFAULT '0' COMMENT '父类目',
  `tree` varchar(64) DEFAULT NULL COMMENT '类目路径',
  `title` varchar(64) DEFAULT NULL COMMENT '标题',
  `notes` varchar(64) DEFAULT NULL COMMENT '备注',
  `url` varchar(255) DEFAULT NULL COMMENT 'url',
  PRIMARY KEY (`cid`),
  KEY `tree` (`tree`),
  KEY `parent` (`parent`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `wf_categorys`
--

