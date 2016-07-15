/*
Navicat MySQL Data Transfer

Source Server         : cxjun
Source Server Version : 50624
Source Host           : localhost:3306
Source Database       : cxjun

Target Server Type    : MYSQL
Target Server Version : 50624
File Encoding         : 65001

Date: 2015-08-07 08:51:44
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for almnui
-- ----------------------------
DROP TABLE IF EXISTS `almnui`;
CREATE TABLE `almnui` (
  `alumniID` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `age` varchar(255) DEFAULT NULL,
  `sex` varchar(255) DEFAULT NULL,
  `alumniAssociation` varchar(255) DEFAULT NULL,
  `industry` varchar(255) DEFAULT NULL,
  `alumniType` varchar(255) DEFAULT NULL,
  `currentPosition` varchar(255) DEFAULT NULL,
  `alumniDuty` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `creator` varchar(255) DEFAULT NULL,
  `fax` varchar(255) DEFAULT NULL,
  `workUnit` varchar(255) DEFAULT NULL,
  `pinyin` varchar(255) DEFAULT NULL,
  `accountType` varchar(255) DEFAULT NULL,
  `identifyType` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `loginControl` varchar(255) DEFAULT NULL,
  `isIdentify` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `continent` varchar(255) DEFAULT NULL,
  `NETID` varchar(255) DEFAULT NULL,
  `Englishname` varchar(255) DEFAULT NULL,
  `birthday` varchar(255) DEFAULT NULL,
  `createDay` varchar(255) DEFAULT NULL,
  `liaisonDuty` varchar(255) DEFAULT NULL,
  `graduationYear` varchar(255) DEFAULT NULL,
  `grade` varchar(255) DEFAULT NULL,
  `politicalStatus` varchar(255) DEFAULT NULL,
  `introduction` varchar(255) DEFAULT NULL,
  `province` varchar(255) DEFAULT NULL,
  `qq` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `telephone` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `nation` varchar(255) DEFAULT NULL,
  `zipCode` varchar(255) DEFAULT NULL,
  `origin` varchar(255) DEFAULT NULL,
  `maritalStatus` varchar(255) DEFAULT NULL,
  `certificateType` varchar(255) DEFAULT NULL,
  `country1` varchar(255) DEFAULT NULL,
  `companyProperty` varchar(255) DEFAULT NULL,
  `almnuiEmail` varchar(255) DEFAULT NULL,
  `certificateNum` varchar(255) DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`alumniID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of almnui
-- ----------------------------
