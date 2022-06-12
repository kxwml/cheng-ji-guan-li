/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 50731
 Source Host           : localhost:3306
 Source Schema         : scoremanger

 Target Server Type    : MySQL
 Target Server Version : 50731
 File Encoding         : 65001

 Date: 15/06/2021 22:07:56
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for course
-- ----------------------------
DROP TABLE IF EXISTS `course`;
CREATE TABLE `course`  (
  `course_id` int(11) NOT NULL AUTO_INCREMENT,
  `course_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL DEFAULT NULL,
  `course_teaid` int(11) NULL DEFAULT NULL,
  `stu_num` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`course_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 11 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_bin ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of course
-- ----------------------------
INSERT INTO `course` VALUES (1, '大学物理', 3, 1);
INSERT INTO `course` VALUES (2, '大学英语', 4, 2);
INSERT INTO `course` VALUES (3, '数据库', 3, 1);
INSERT INTO `course` VALUES (4, '软件工程', 5, 1);
INSERT INTO `course` VALUES (5, '数据结构', 6, 2);
INSERT INTO `course` VALUES (6, '大学体育', 6, 0);
INSERT INTO `course` VALUES (8, '大学物理a', 3, 0);

-- ----------------------------
-- Table structure for role
-- ----------------------------
DROP TABLE IF EXISTS `role`;
CREATE TABLE `role`  (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL DEFAULT NULL,
  PRIMARY KEY (`role_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_bin ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of role
-- ----------------------------
INSERT INTO `role` VALUES (1, '教务管理员');
INSERT INTO `role` VALUES (2, '学生');
INSERT INTO `role` VALUES (3, '教师');

-- ----------------------------
-- Table structure for scoresum
-- ----------------------------
DROP TABLE IF EXISTS `scoresum`;
CREATE TABLE `scoresum`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `way1` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL DEFAULT NULL,
  `way2` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL DEFAULT NULL,
  `way3` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL DEFAULT NULL,
  `way4` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL DEFAULT NULL,
  `course_id` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_bin ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of scoresum
-- ----------------------------
INSERT INTO `scoresum` VALUES (1, '0.2', '0.2', '0.2', '0.4', 1);
INSERT INTO `scoresum` VALUES (2, '0.2', '0.2', '0.2', '0.4', 2);
INSERT INTO `scoresum` VALUES (3, '0.2', '0.2', '0.2', '0.4', 3);
INSERT INTO `scoresum` VALUES (4, '0.2', '0.2', '0.2', '0.4', 4);
INSERT INTO `scoresum` VALUES (5, '0.2', '0.2', '0.2', '0.4', 5);
INSERT INTO `scoresum` VALUES (6, '0.2', '0.2', '0.2', '0.4', 6);

-- ----------------------------
-- Table structure for stu_course
-- ----------------------------
DROP TABLE IF EXISTS `stu_course`;
CREATE TABLE `stu_course`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `course_id` int(11) NULL DEFAULT NULL,
  `stu_id` int(11) NULL DEFAULT NULL,
  `score1` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL DEFAULT NULL,
  `score2` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL DEFAULT NULL,
  `score3` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL DEFAULT NULL,
  `score4` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL DEFAULT NULL,
  `sum` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 9 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_bin ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of stu_course
-- ----------------------------
INSERT INTO `stu_course` VALUES (1, 1, 2, '90', '90', '90', '80', '87');
INSERT INTO `stu_course` VALUES (2, 2, 2, '90', '90', '90', '90', '90');
INSERT INTO `stu_course` VALUES (3, 3, 2, '80', '60', '80', '70', '71');
INSERT INTO `stu_course` VALUES (4, 4, 2, '85', '90', '90', '90', '90');
INSERT INTO `stu_course` VALUES (5, 5, 2, '85', '90', '90', '90', '90');
INSERT INTO `stu_course` VALUES (6, 6, 2, '95', '90', '90', '90', '90');
INSERT INTO `stu_course` VALUES (7, 2, 7, '70', '90', '90', '90', '86');
INSERT INTO `stu_course` VALUES (8, 5, 7, '85', '90', '90', '90', '90');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `salt` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL DEFAULT NULL,
  `user_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL DEFAULT NULL,
  `user_password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL DEFAULT NULL,
  `role_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL DEFAULT NULL,
  `stunum` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL DEFAULT NULL,
  `nick` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL DEFAULT NULL,
  `class` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL DEFAULT NULL,
  PRIMARY KEY (`user_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 11 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_bin ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'sdnjksw', 'admin', '7af7ceb59fcebbc5664a4f4d5977163a', '1', NULL, '教务管理员', NULL);
INSERT INTO `users` VALUES (2, 'snxnaw', 'stu1', '5da8f8e25ed1eeb214fac524ab6ce6af', '2', '1001', '学生一', '软件工程2班');
INSERT INTO `users` VALUES (3, 'wsaxx', 'tea1', '4cadb245211e40c82d9fd2a39aeba6e7', '3', NULL, '老师1', NULL);
INSERT INTO `users` VALUES (4, 'wsaxx', 'tea2', '4cadb245211e40c82d9fd2a39aeba6e7', '3', NULL, '老师2', NULL);
INSERT INTO `users` VALUES (5, 'wsaxx', 'tea3', '4cadb245211e40c82d9fd2a39aeba6e7', '3', NULL, '老师3', NULL);
INSERT INTO `users` VALUES (6, 'wsaxx', 'tea4', '4cadb245211e40c82d9fd2a39aeba6e7', '3', NULL, '老师4', NULL);
INSERT INTO `users` VALUES (7, 'snxnaw', 'stu2', '5da8f8e25ed1eeb214fac524ab6ce6af', '2', '1002', '学生二', '软件工程1班');
INSERT INTO `users` VALUES (9, 'pwamnB', 'stu3', 'b89e0da186801b8fbc195b334d26e7ba', '2', '1003', '学生三', '软件工程3班');
INSERT INTO `users` VALUES (10, 'lOPNFZ', 'tea10', '35be880af53c2adb63da4d9840421fb6', '3', '', '老师10', '软件工程3');

SET FOREIGN_KEY_CHECKS = 1;
