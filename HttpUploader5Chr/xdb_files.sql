-- phpMyAdmin SQL Dump
-- version 2.11.2.1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2012 年 10 月 10 日 02:40
-- 服务器版本: 5.0.45
-- PHP 版本: 5.2.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- 数据库: `test`
--

-- --------------------------------------------------------

--
-- 表的结构 `xdb_files`
--

CREATE TABLE `xdb_files` (
  `fid` int(11) NOT NULL auto_increment,
  `uid` int(11) NOT NULL,
  `FileNameLocal` varchar(255) NOT NULL,
  `FileNameRemote` varchar(255) NOT NULL,
  `FilePathLocal` varchar(512) NOT NULL,
  `FilePathRemote` varchar(512) NOT NULL,
  `FilePathRelative` varchar(512) NOT NULL,
  `FileMD5` varchar(32) NOT NULL,
  `FileLength` int(11) NOT NULL,
  `FileSize` varchar(10) NOT NULL,
  `FilePos` int(11) default '0',
  `PostedLength` int(11) default '0',
  `PostedPercent` varchar(6) default '0%',
  `PostComplete` tinyint(1) default '0',
  `PostedTime` timestamp NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `IsDeleted` tinyint(1) default '0',
  `f_remark` varchar(255) default '',
  PRIMARY KEY  (`fid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 导出表中的数据 `xdb_files`
--