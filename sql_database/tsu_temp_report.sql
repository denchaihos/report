/*
Navicat MySQL Data Transfer

Source Server         : hiserver5
Source Server Version : 50163
Source Host           : 192.168.11.5:3306
Source Database       : hi

Target Server Type    : MYSQL
Target Server Version : 50163
File Encoding         : 65001

Date: 2016-12-15 11:19:55
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `tsu_temp_report`
-- ----------------------------
DROP TABLE IF EXISTS `tsu_temp_report`;
CREATE TABLE `tsu_temp_report` (
  `id` int(11) DEFAULT NULL,
  `reportname` varchar(150) DEFAULT NULL,
  `vn` int(11) DEFAULT NULL,
  `date1` date DEFAULT NULL,
  `date2` date DEFAULT NULL,
  `n1` int(11) DEFAULT NULL,
  `n2` int(11) DEFAULT NULL,
  `n3` int(11) DEFAULT NULL,
  `n4` int(11) DEFAULT NULL,
  `n5` int(11) DEFAULT NULL,
  `n6` int(11) DEFAULT NULL,
  `n7` int(11) DEFAULT NULL,
  `n8` int(11) DEFAULT NULL,
  `n9` int(11) DEFAULT NULL,
  `n10` int(11) DEFAULT NULL,
  `n11` int(11) DEFAULT NULL,
  `n12` int(11) DEFAULT NULL,
  `n13` int(11) DEFAULT NULL,
  `n14` int(11) DEFAULT NULL,
  `n15` int(11) DEFAULT NULL,
  `s1` varchar(100) DEFAULT NULL,
  `s2` varchar(100) DEFAULT NULL,
  `s3` varchar(100) DEFAULT NULL,
  `s4` varchar(100) DEFAULT NULL,
  `s5` varchar(100) DEFAULT NULL,
  `s6` varchar(100) DEFAULT NULL,
  `s7` varchar(100) DEFAULT NULL,
  `date3` date DEFAULT NULL,
  `date4` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=tis620;

-- ----------------------------
-- Records of tsu_temp_report
-- ----------------------------
