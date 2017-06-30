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
-- 表的结构 `people`
--

CREATE TABLE IF NOT EXISTS `people` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `sex` varchar(4) NOT NULL,
  `grade` varchar(4) NOT NULL,
  `content` text NOT NULL,
  `img` varchar(1000) DEFAULT NULL,
  `major` varchar(50) NOT NULL,
  `aspect` varchar(50) NOT NULL,
  `sign` varchar(255) NOT NULL COMMENT '签名',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=40 ;

--
-- 转存表中的数据 `people`
--

INSERT INTO `people` (`id`, `name`, `sex`, `grade`, `content`, `img`, `major`, `aspect`, `sign`) VALUES
(24, '陈璐', '女', '2013', '', './memberImg/girl.png', '信息管理与信息系统', '前端', '从前有个人在我面前装逼，然后他就死了。'),
(25, '陈雪虹', '女', '2013', '', './memberImg/girl.png', '计算机科学与技术', '后台', ''),
(26, '董灿佳', '男', '2013', '', './memberImg/boy.png', '软件工程', '前端', ''),
(27, '何宇虹', '女', '2013', '', './memberImg/girl.png', '软件工程', '前端', '理想与担当 为自己选择的路负责'),
(28, '黄华媛', '女', '2013', '', './memberImg/girl.png', '软件工程', '前端', '我一直在承受我这个年纪不该有的机智和帅气，我好累。'),
(29, '梁铭新', '男', '2013', '', './memberImg/boy.png', '软件工程', 'Android', '我就是我，是颜色不一样的烟火！'),
(30, '刘超勇', '男', '2013', '', './memberImg/boy.png', '软件工程', '后台', '我的天空，你看得到却看不懂。'),
(31, '潘鸿仪', '男', '2013', '', './memberImg/boy.png', '计算机科学与技术', '前端', ''),
(32, '苏湘堡', '男', '2013', '', './memberImg/boy.png', '软件工程', 'Android', '给我一个妹子，我还你一个民族！'),
(33, '吴博聪', '男', '2013', '', './memberImg/boy.png', '软件工程', 'Array', '阅尽繁华，不改初心。'),
(34, '谢子扬', '男', '2013', '', './memberImg/boy.png', '软件工程', 'Android', '找对的人，做对的事。'),
(35, '徐国立', '男', '2013', '', './memberImg/boy.png', '软件工程', 'Android', '只要笑一笑，没什么过不了！'),
(36, '杨鹏飞', '男', '2013', '', './memberImg/boy.png', '计算机科学与技术', 'Array', '专业打杂请找我！'),
(37, '张宏业', '男', '2013', '', './memberImg/boy.png', '软件工程', 'Array', '我来买单！'),
(38, '张淑兰', '女', '2013', '', './memberImg/girl.png', '软件工程', '后台', '看时间不是为了起床，而是看还能睡多久。'),
(39, '卓燕珠', '女', '2013', '', './memberImg/girl.png', '信息管理与信息系统', '前端', '"What?!"');
