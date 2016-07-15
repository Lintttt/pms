-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 07, 2015 at 08:16 AM
-- Server version: 5.6.11
-- PHP Version: 5.5.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `zentao`
--

-- --------------------------------------------------------

--
-- Table structure for table `zt_user`
--

DROP TABLE IF EXISTS `zt_user`;
CREATE TABLE IF NOT EXISTS `zt_user` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `work_id` varchar(20) NOT NULL,
  `dept` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `account` char(30) NOT NULL DEFAULT '',
  `password` char(32) NOT NULL DEFAULT '',
  `role` char(10) NOT NULL DEFAULT '',
  `higher_up` mediumint(8) NOT NULL,
  `department_group` varchar(50) NOT NULL,
  `realname` char(30) NOT NULL DEFAULT '',
  `nickname` char(60) NOT NULL DEFAULT '',
  `commiter` varchar(100) NOT NULL,
  `avatar` char(30) NOT NULL DEFAULT '',
  `birthday` date NOT NULL DEFAULT '0000-00-00',
  `age` int(3) NOT NULL,
  `gender` enum('f','m') NOT NULL DEFAULT 'f',
  `email` char(90) NOT NULL DEFAULT '',
  `skype` char(90) NOT NULL DEFAULT '',
  `qq` char(20) NOT NULL DEFAULT '',
  `yahoo` char(90) NOT NULL DEFAULT '',
  `gtalk` char(90) NOT NULL DEFAULT '',
  `wangwang` char(90) NOT NULL DEFAULT '',
  `mobile` char(11) NOT NULL DEFAULT '',
  `phone` char(20) NOT NULL DEFAULT '',
  `address` char(120) NOT NULL DEFAULT '',
  `zipcode` char(10) NOT NULL DEFAULT '',
  `join` date NOT NULL DEFAULT '0000-00-00',
  `visits` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `ip` char(15) NOT NULL DEFAULT '::1',
  `last` int(10) unsigned NOT NULL DEFAULT '0',
  `fails` tinyint(5) NOT NULL DEFAULT '0',
  `locked` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `account` (`account`),
  KEY `dept` (`dept`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `zt_user`
--

INSERT INTO `zt_user` (`id`, `work_id`, `dept`, `account`, `password`, `role`, `higher_up`, `department_group`, `realname`, `nickname`, `commiter`, `avatar`, `birthday`, `age`, `gender`, `email`, `skype`, `qq`, `yahoo`, `gtalk`, `wangwang`, `mobile`, `phone`, `address`, `zipcode`, `join`, `visits`, `ip`, `last`, `fails`, `locked`, `deleted`) VALUES
(1, '0', 0, 'admin', '21232f297a57a5a743894a0e4a801fc3', '', 0, '', 'admin', '', '', '', '0000-00-00', 0, 'm', '', '', '', '', '', '', '', '', '', '', '2015-01-01', 11, '::1', 1420609735, 0, '0000-00-00 00:00:00', '0'),
(2, '02', 2, 'chenfeiqin', 'e10adc3949ba59abbe56e057f20f883e', '', 0, '华北', '陈飞钦', '', '', '', '0000-00-00', 0, 'm', 'fqchen@genedenovo.com', '', '21017111', '', '', '', '13316002351', '', '', '', '2015-01-01', 12, '::1', 1420614765, 0, '0000-00-00 00:00:00', '0'),
(3, '06', 2, 'liqingshan', 'e10adc3949ba59abbe56e057f20f883e', '', 2, '华中', '李青山', '', '', '', '0000-00-00', 0, 'm', 'qshli@genedenovo.com', '', '553864166', '', '', '', '18028082987', '', '', '', '2015-01-01', 1, '::1', 1420534711, 0, '0000-00-00 00:00:00', '0'),
(4, '05', 2, 'yangliu', 'e10adc3949ba59abbe56e057f20f883e', '', 2, '华南', '杨柳', '', '', '', '0000-00-00', 0, 'f', 'lyang@genedenovo.com', '', '502129815', '', '', '', '18027386966', '', '', '', '2015-01-01', 5, '::1', 1420614366, 0, '0000-00-00 00:00:00', '0'),
(5, '11', 2, 'diaoxiuqin', 'e10adc3949ba59abbe56e057f20f883e', '', 4, '华南', '刁秀芹', '', '', '', '0000-00-00', 0, 'f', 'xqdiao@genedenovo.com', '', '2820792225', '', '', '', '18027386901', '', '', '', '2015-01-01', 3, '::1', 1420612285, 0, '0000-00-00 00:00:00', '0'),
(6, '17', 2, 'chenkeer', 'e10adc3949ba59abbe56e057f20f883e', '', 4, '华南', '陈柯洱', '', '', '', '0000-00-00', 0, 'm', 'kechen@genedenovo.com', '', '331963536', '', '', '', '18027386903', '', '', '', '2015-01-01', 2, '::1', 1420534675, 0, '0000-00-00 00:00:00', '0'),
(7, '26', 2, 'huangyuping', 'e10adc3949ba59abbe56e057f20f883e', '', 4, '华南', '黄玉萍', '', '', '', '0000-00-00', 0, 'f', 'yphuang@genedenovo.com', '', '353333159', '', '', '', '18926221990', '', '', '', '2015-01-01', 0, '', 0, 0, '0000-00-00 00:00:00', '0'),
(8, '31', 2, 'zhangrui', 'e10adc3949ba59abbe56e057f20f883e', '', 3, '华中', '张蕊', '', '', '', '0000-00-00', 0, 'f', 'rzhang@genedenovo.com', '', '645784440', '', '', '', '18028082667', '', '', '', '2015-01-01', 0, '', 0, 0, '0000-00-00 00:00:00', '0'),
(9, '21', 2, 'zhangyimin', 'e10adc3949ba59abbe56e057f20f883e', '', 2, '西北', '张意敏', '', '', '', '0000-00-00', 0, 'f', 'ymzhang@genedenovo.com', '', '526556825', '', '', '', '18028082665', '', '', '', '2015-01-01', 8, '::1', 1420614378, 0, '0000-00-00 00:00:00', '0'),
(10, '37', 2, 'pengxiaoli', 'e10adc3949ba59abbe56e057f20f883e', '', 9, '西南', '彭小丽', '', '', '', '0000-00-00', 0, 'f', 'xlpeng@genedenovo.com', '', '565296753', '', '', '', ' 1892622197', '', '', '', '2015-01-01', 0, '', 0, 1, '0000-00-00 00:00:00', '0'),
(11, '33', 2, 'liucong', 'e10adc3949ba59abbe56e057f20f883e', '', 4, '华南', '刘聪', '', '', '', '0000-00-00', 0, 'm', 'cliu@genedenovo.com', '', '781340339', '', '', '', '18028082948', '', '', '', '2015-01-01', 0, '', 0, 1, '0000-00-00 00:00:00', '0'),
(12, '38', 2, 'xiaohongbing', 'e10adc3949ba59abbe56e057f20f883e', '', 2, '华北', '肖红斌', '', '', '', '0000-00-00', 0, 'm', 'hbxiao@genedenovo.com', '', '2392917258', '', '', '', '18926221989', '', '', '', '2015-01-01', 0, '', 0, 0, '0000-00-00 00:00:00', '0'),
(13, '42', 2, 'linhuaming', 'e10adc3949ba59abbe56e057f20f883e', '', 2, '华北', '林华明', '', '', '', '0000-00-00', 0, 'm', 'hmlin@genedenovo.com\n', '', '814425442', '', '', '', '18028629049', '', '', '', '2015-01-01', 0, '', 0, 0, '0000-00-00 00:00:00', '0'),
(14, '0', 2, 'yinxiaojie', 'e10adc3949ba59abbe56e057f20f883e', '', 3, '华中', '殷晓杰', '', '', '', '0000-00-00', 0, 'm', 'xjyin@genedenovo.com', '', '2240472029', '', '', '', '18011981725', '', '', '', '2015-01-01', 0, '', 0, 0, '0000-00-00 00:00:00', '0'),
(15, '0', 2, 'xiaofengfang', 'e10adc3949ba59abbe56e057f20f883e', '', 9, '西北', '肖凤芳', '', '', '', '0000-00-00', 0, 'f', 'ffxiao@genedenovo.com', '', '870987759', '', '', '', '18926221952', '', '', '', '2015-01-01', 0, '', 0, 0, '0000-00-00 00:00:00', '0'),
(16, '0', 2, 'jianglonglong', 'e10adc3949ba59abbe56e057f20f883e', '', 9, '西北', '江龙龙', '', '', '', '0000-00-00', 0, 'm', 'lljiang@genedenovo.com', '', '282890591', '', '', '', '18122012427', '', '', '', '2015-01-01', 0, '', 0, 0, '0000-00-00 00:00:00', '0'),
(17, '0', 2, 'xujianbo', 'e10adc3949ba59abbe56e057f20f883e', '', 4, '华南', '徐建波', '', '', '', '0000-00-00', 0, 'm', 'jbxu@genedenovo.com', '', '2421866324', '', '', '', '18102789150', '', '', '', '2015-01-01', 0, '', 0, 0, '0000-00-00 00:00:00', '0'),
(18, '0', 2, 'liulijuan', 'e10adc3949ba59abbe56e057f20f883e', '', 3, '华中', '刘丽娟', '', '', '', '0000-00-00', 0, 'f', 'ljliu@genedenovo.com', '', '283587869', '', '', '', '15576612694', '', '', '', '2015-01-01', 0, '', 0, 0, '0000-00-00 00:00:00', '0'),
(19, '0', 2, 'jiangwei', 'e10adc3949ba59abbe56e057f20f883e', '', 9, '西北', '江为', '', '', '', '0000-00-00', 0, 'm', 'wjiang@genedenovo.com', '', '499288917', '', '', '', '18580252415', '', '', '', '2015-01-01', 2, '::1', 1420614180, 0, '0000-00-00 00:00:00', '0');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
