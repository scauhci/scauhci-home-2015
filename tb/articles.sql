-- phpMyAdmin SQL Dump
-- version 3.3.8.1
-- http://www.phpmyadmin.net
--
-- 主机: w.rdc.sae.sina.com.cn:3307
-- 生成日期: 2015 年 09 月 11 日 21:13
-- 服务器版本: 5.5.23
-- PHP 版本: 5.3.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `app_scauhci`
--

-- --------------------------------------------------------

--
-- 表的结构 `articles`
--

CREATE TABLE IF NOT EXISTS `articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cl` varchar(255) NOT NULL DEFAULT 'php',
  `title` varchar(30) NOT NULL,
  `content` text NOT NULL,
  `author` varchar(20) NOT NULL,
  `time` datetime NOT NULL,
  `img` varchar(10000) NOT NULL,
  `intro` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- 转存表中的数据 `articles`
--

INSERT INTO `articles` (`id`, `cl`, `title`, `content`, `author`, `time`, `img`, `intro`) VALUES
(15, '前端', 'HCI官网开发札记', '<p>+ HCI官网，由我们一个新的团队，花了1个月时间，不能说白璧无瑕，但至少不负HCI前辈们所托，也算是恪尽职守了。</p><p><br/></p><p>+ 从一开始提出第一版的需求，到讨论过后确定基本框架，再到中间进行的多次重构和丰富，和最后的优化，我们官网小组五人“异想天开”、“剑走偏锋”、“鞠躬尽瘁”，终于完成任务。忘不了血红一人撑起后台的天空，忘不了大biao姐和璐哥使用各种奇技淫巧对抗IE8但最终还是无奈投降，忘不了红移玩转BootStrap虐翻全场，忘不了负责人如同热锅上的蚂蚁一般四处救火。我们都辛苦了！</p><p><br/></p><p>+ 如今，我们给未来开辟了一条道路，既遵道而得路。跟我们一起来吧，我们是HCI Front End！</p><p><br/></p><p>![](http://scauhci-upload.stor.sinaapp.com/IMG_20150813_152619_AO_HDR.jpg)</p><p><br/></p>', 'Warrior！', '2015-08-28 13:22:31', '', ''),
(16, '后台', 'HCI后台介绍', '<p>#HCI后台介绍</p><p>##后台开发##</p><p>&nbsp; 目前HCI工作室现主攻后台方向的技术人员有四名。他们主要负责在前端完成了网站页面的基础上，根据用户需求实现网站的功能。负责后台的人要掌握现今比较流行的网络编程语言，例如PHP、ASP或者JSP等。除了实现网站的功能，他们也负责性能优化，故对数据结构和算法也有一点的了解和研究。</p><p><br/></p><p><br/></p><p>##项目介绍##</p><p>###1.竞考网微信公众号开发###</p><p>&nbsp;&nbsp;该项目主要为加强自媒体和竞考网功能的联系，用户直接通过微信公众号就可以直接查询竞考网的相关资料并可以进行模拟考试，主要用node.js+mongodb进行该微信公众号的后台开发，将用户的微信公众号和其竞考网的账户进行关联，使用户能够在微信上直接查看竞考网的个人信息和竞赛考试相关的资讯。</p><p><br/></p><p>![](http://scauhci-upload.stor.sinaapp.com/IMG_20150813_171517_AO_HDR.jpg)</p>', 'June', '2015-08-28 23:34:07', '', '');
