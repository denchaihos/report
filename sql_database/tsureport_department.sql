/*
Navicat MySQL Data Transfer

Source Server         : local
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : hi

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2016-12-15 11:01:52
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `tsureport_department`
-- ----------------------------
DROP TABLE IF EXISTS `tsureport_department`;
CREATE TABLE `tsureport_department` (
  `dep_id` varchar(2) NOT NULL,
  `dep_name` varchar(200) NOT NULL,
  PRIMARY KEY (`dep_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tsureport_department
-- ----------------------------
INSERT INTO `tsureport_department` VALUES ('00', 'รายงานมาตรฐานทั่วไป');
INSERT INTO `tsureport_department` VALUES ('01', 'องค์กรแพทย์');
INSERT INTO `tsureport_department` VALUES ('02', 'ผู้ป่วยนอก');
INSERT INTO `tsureport_department` VALUES ('03', 'ผู้ป่วยใน');
INSERT INTO `tsureport_department` VALUES ('04', 'อุบัติเหตุและฉุกเฉิน');
INSERT INTO `tsureport_department` VALUES ('05', 'ชัณสูตร');
INSERT INTO `tsureport_department` VALUES ('06', 'รังสีเทคนิก');
INSERT INTO `tsureport_department` VALUES ('07', 'เภสัชกรรม');
INSERT INTO `tsureport_department` VALUES ('08', 'ทันตกรรม');
INSERT INTO `tsureport_department` VALUES ('09', 'ห้องเก็บเงิน');
INSERT INTO `tsureport_department` VALUES ('10', 'ศูนย์ส่งต่อ');
INSERT INTO `tsureport_department` VALUES ('11', 'จิตเวช');
INSERT INTO `tsureport_department` VALUES ('12', 'ห้องคลอด');
INSERT INTO `tsureport_department` VALUES ('13', 'ห้องผ่าตัด');
INSERT INTO `tsureport_department` VALUES ('14', 'เวชศาสตร์ครอบ ฯ');
INSERT INTO `tsureport_department` VALUES ('98', 'ไม่ระบุแผนก');
INSERT INTO `tsureport_department` VALUES ('99', 'ผู้ดูแลระบบ');
