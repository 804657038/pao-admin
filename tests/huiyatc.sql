/*
 Navicat MySQL Data Transfer

 Source Server         : 恒帝科技
 Source Server Type    : MySQL
 Source Server Version : 50540
 Source Host           : 120.24.212.12
 Source Database       : huiyatc

 Target Server Type    : MySQL
 Target Server Version : 50540
 File Encoding         : utf-8

 Date: 12/12/2017 11:39:46 AM
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `admin_commont`
-- ----------------------------
DROP TABLE IF EXISTS `admin_commont`;
CREATE TABLE `admin_commont` (
  `id` int(11) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `commont` longtext,
  `member_id` int(11) DEFAULT NULL,
  `to_member_id` int(11) DEFAULT NULL,
  `msgId` int(11) DEFAULT NULL,
  `addTime` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0:未读，1:已读',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
--  Table structure for `admin_msg`
-- ----------------------------
DROP TABLE IF EXISTS `admin_msg`;
CREATE TABLE `admin_msg` (
  `id` int(11) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `member_id` int(11) NOT NULL,
  `content` text,
  `images` text,
  `video` varchar(255) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '0' COMMENT '0:审核中，1:已通过',
  `addTime` int(11) DEFAULT NULL,
  `updateTime` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `admin_praise`
-- ----------------------------
DROP TABLE IF EXISTS `admin_praise`;
CREATE TABLE `admin_praise` (
  `id` int(11) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `member_id` int(11) DEFAULT NULL,
  `to_member_id` int(11) DEFAULT NULL,
  `msgId` int(11) DEFAULT NULL,
  `addTime` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0:未读，1:已读',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8;

SET FOREIGN_KEY_CHECKS = 1;
