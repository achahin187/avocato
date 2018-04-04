/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50719
Source Host           : localhost:3306
Source Database       : secure_bridge

Target Server Type    : MYSQL
Target Server Version : 50719
File Encoding         : 65001

Date: 2018-03-25 12:51:20
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for task_reports
-- ----------------------------
DROP TABLE IF EXISTS `task_reports`;
CREATE TABLE `task_reports` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `task_id` int(11) DEFAULT NULL,
  `description` longtext,
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `created_by` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of task_reports
-- ----------------------------

-- ----------------------------
-- Table structure for task_reports_photos
-- ----------------------------
DROP TABLE IF EXISTS `task_reports_photos`;
CREATE TABLE `task_reports_photos` (
  `id` int(11) NOT NULL,
  `task_report_id` int(11) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of task_reports_photos
-- ----------------------------

-- ----------------------------
-- Table structure for task_status_histories
-- ----------------------------
DROP TABLE IF EXISTS `task_status_histories`;
CREATE TABLE `task_status_histories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `task_id` int(11) DEFAULT NULL,
  `task_status_id` int(11) DEFAULT NULL,
  `datetime` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of task_status_histories
-- ----------------------------

-- ----------------------------
-- Table structure for task_statuses
-- ----------------------------
DROP TABLE IF EXISTS `task_statuses`;
CREATE TABLE `task_statuses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of task_statuses
-- ----------------------------
INSERT INTO `task_statuses` VALUES ('1', 'new');
INSERT INTO `task_statuses` VALUES ('2', 'completed');

-- ----------------------------
-- Table structure for task_types
-- ----------------------------
DROP TABLE IF EXISTS `task_types`;
CREATE TABLE `task_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of task_types
-- ----------------------------
INSERT INTO `task_types` VALUES ('1', 'urgent');
INSERT INTO `task_types` VALUES ('2', 'normal');

-- ----------------------------
-- Table structure for tasks
-- ----------------------------
DROP TABLE IF EXISTS `tasks`;
CREATE TABLE `tasks` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` longtext,
  `assigned_lawyer_id` int(11) DEFAULT NULL,
  `who_assigned_lawyer_id` int(11) DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  `task_type_id` int(11) DEFAULT NULL,
  `task_status_id` int(11) DEFAULT NULL,
  `start_datetime` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `end_datetime` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `task_address` varchar(255) DEFAULT NULL,
  `client_longitude` varchar(255) DEFAULT NULL,
  `client_latitude` varchar(255) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tasks
-- ----------------------------
