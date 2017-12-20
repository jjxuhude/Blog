/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 50719
 Source Host           : 127.0.0.1:3306
 Source Schema         : blog

 Target Server Type    : MySQL
 Target Server Version : 50719
 File Encoding         : 65001

 Date: 20/12/2017 23:49:41
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for admin
-- ----------------------------
DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp(0) DEFAULT NULL,
  `updated_at` timestamp(0) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `users_email_unique`(`email`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of admin
-- ----------------------------
INSERT INTO `admin` VALUES (1, 'user01', 'user01@163.com', '$2y$10$mhMTnUCmgZgL..fMB.rPMenL0llcfi26IvJyLWOUSgD0R2ztc9hgm', 'Pvn6P2nBTUefC3lhfVjyuoW1M8nmfPSkHHrYLEwsntlqbAyCpdb9jUWFEvJ7', '2017-11-20 14:56:34', '2017-11-20 14:56:34');
INSERT INTO `admin` VALUES (2, 'guest', 'guest@163.com', '$2y$10$yRYpkZ4DsowgyfyTEDXJX.wnWl9mLYmUrcS1AiJIyk/0cWQBjuV.u', 'gRjOa8w1Sik7AO1ZbuFjE5YzPGC1nQDuOrgNVRuKVmi27ObA6cmWXQ7Pc9eu', '2017-11-20 14:56:56', '2017-11-20 14:56:56');
INSERT INTO `admin` VALUES (3, 'user02', 'user02@163.com', '$2y$10$17.1wgUx981GqG1xi2YYU.cwf/yY/AcZEWz2ErWMNq/5brOaFKTMm', NULL, '2017-11-20 15:18:53', '2017-11-20 15:18:53');
INSERT INTO `admin` VALUES (4, 'user03', 'user03@163.com', '$2y$10$IcC3eI1wNhdyQxiQs9XwwugEpb2pyD0o2GWNk8pOuZEeMf9RDtCZm', '7DZZP1KmSgXD0sgelEox7jzsStbAv9Y7S8OqtO8yPIGsb9kSpBaO1CU0XphN', '2017-11-20 15:25:36', '2017-11-20 15:25:36');
INSERT INTO `admin` VALUES (5, 'user04', 'user04@163.com', '$2y$10$PRjDeh1xDc.j/PGr9C.vauKcrp3w7havV4x8Fhg3OrViSqR5fluh6', NULL, '2017-12-04 14:45:20', '2017-12-04 14:45:20');
INSERT INTO `admin` VALUES (6, 'user05', 'user05@163.com', '$2y$10$aL67Dm1EFD0szxueNv22necziRheZ8yQIwDumh9Wkz91nKzKU9g/O', 'NAAg2cBAqUhpFbFTvq1YiWoOQOlNVhNtiQhvRWEAOaOscgvQX3QxdF7aE3WO', '2017-12-04 14:47:26', '2017-12-04 14:47:26');
INSERT INTO `admin` VALUES (7, 'user06', 'user06@163.com', '$2y$10$Y.UrxP6GqQk6wGKFeY7.C.XN.Ldagb1EFspQMqN6RQ0W4IPo60mKK', 'I9PsbSzal5oUiF7He59PyK5ywMgVCEM17eZK0Q9ZNmSUU8rXUnCnwWISQheB', '2017-12-04 14:48:01', '2017-12-04 14:48:01');

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (1, '2014_10_12_000000_create_users_table', 1);
INSERT INTO `migrations` VALUES (2, '2014_10_12_100000_create_password_resets_table', 1);
INSERT INTO `migrations` VALUES (3, '2016_06_01_000001_create_oauth_auth_codes_table', 2);
INSERT INTO `migrations` VALUES (4, '2016_06_01_000002_create_oauth_access_tokens_table', 2);
INSERT INTO `migrations` VALUES (5, '2016_06_01_000003_create_oauth_refresh_tokens_table', 2);
INSERT INTO `migrations` VALUES (6, '2016_06_01_000004_create_oauth_clients_table', 2);
INSERT INTO `migrations` VALUES (7, '2016_06_01_000005_create_oauth_personal_access_clients_table', 2);

-- ----------------------------
-- Table structure for oauth_access_tokens
-- ----------------------------
DROP TABLE IF EXISTS `oauth_access_tokens`;
CREATE TABLE `oauth_access_tokens`  (
  `id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `client_id` int(11) NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp(0) DEFAULT NULL,
  `updated_at` timestamp(0) DEFAULT NULL,
  `expires_at` datetime(0) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `oauth_access_tokens_user_id_index`(`user_id`) USING BTREE
) ENGINE = MyISAM CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of oauth_access_tokens
-- ----------------------------
INSERT INTO `oauth_access_tokens` VALUES ('fba7110024f44d2274ffa4c4dbf436d5af7be08c2bbf0cf39afc93df3ddb01360cdf7278c01277a0', 7, 1, 'MyApp', '[]', 0, '2017-12-20 15:06:26', '2017-12-20 15:06:26', '2018-12-20 15:06:26');
INSERT INTO `oauth_access_tokens` VALUES ('b13468cda90e4f5786373de2e922d1d910f7095899a4422f0dc5c4c63ad74702a4b3f24b5110e8e1', 1, 1, 'MyApp', '[]', 0, '2017-12-20 15:18:21', '2017-12-20 15:18:21', '2018-12-20 15:18:21');
INSERT INTO `oauth_access_tokens` VALUES ('09f4b6acdaef88240a34e6c3c50731d89f844706bb2def0eab74b8a44f29bde8e92c9aad3a37aafa', 1, 1, 'MyApp', '[]', 0, '2017-12-20 15:22:46', '2017-12-20 15:22:46', '2018-12-20 15:22:46');
INSERT INTO `oauth_access_tokens` VALUES ('0ca0e91e9e9858d824cde61257d36da2e313a7c032fc19679a95ada45821b8d014f381b2048348ff', 1, 1, 'MyApp', '[]', 0, '2017-12-20 15:26:40', '2017-12-20 15:26:40', '2018-12-20 15:26:40');
INSERT INTO `oauth_access_tokens` VALUES ('84dd5691e198c0b92adeeca18bc25ee70612dc1a4339e3f231dd77470aa9b42a74d340deebe58a51', 1, 1, 'MyApp', '[]', 0, '2017-12-20 15:26:48', '2017-12-20 15:26:48', '2018-12-20 15:26:48');
INSERT INTO `oauth_access_tokens` VALUES ('9f3d7f7fdba0bade1df5aea79493bc9e4dff30a58a5acb2fb3953d5f92c0fbea672c7ebcd91d53ed', 1, 1, 'MyApp', '[]', 0, '2017-12-20 15:27:03', '2017-12-20 15:27:03', '2018-12-20 15:27:03');
INSERT INTO `oauth_access_tokens` VALUES ('094386f8565a3bb2d3121a862b2230b001403e2affd11dd290abca76c220f1b2eb1267e3dc189f59', 1, 1, 'MyApp', '[]', 0, '2017-12-20 15:27:34', '2017-12-20 15:27:34', '2018-12-20 15:27:34');

-- ----------------------------
-- Table structure for oauth_auth_codes
-- ----------------------------
DROP TABLE IF EXISTS `oauth_auth_codes`;
CREATE TABLE `oauth_auth_codes`  (
  `id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `scopes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime(0) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for oauth_clients
-- ----------------------------
DROP TABLE IF EXISTS `oauth_clients`;
CREATE TABLE `oauth_clients`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `redirect` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp(0) DEFAULT NULL,
  `updated_at` timestamp(0) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `oauth_clients_user_id_index`(`user_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of oauth_clients
-- ----------------------------
INSERT INTO `oauth_clients` VALUES (1, NULL, 'Laravel Personal Access Client', '7CIGzOJOpNctuYMqsmrrCCYwrZauQFbX9fh3t5FZ', 'http://localhost', 1, 0, 0, '2017-12-20 14:45:17', '2017-12-20 14:45:17');
INSERT INTO `oauth_clients` VALUES (2, NULL, 'Laravel Password Grant Client', 'GdWCfhZaDqtGaD4vMDJt9WsGDUO6IIdXy3Nx2TpM', 'http://localhost', 0, 1, 0, '2017-12-20 14:45:17', '2017-12-20 14:45:17');

-- ----------------------------
-- Table structure for oauth_personal_access_clients
-- ----------------------------
DROP TABLE IF EXISTS `oauth_personal_access_clients`;
CREATE TABLE `oauth_personal_access_clients`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `client_id` int(11) NOT NULL,
  `created_at` timestamp(0) DEFAULT NULL,
  `updated_at` timestamp(0) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `oauth_personal_access_clients_client_id_index`(`client_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Fixed;

-- ----------------------------
-- Records of oauth_personal_access_clients
-- ----------------------------
INSERT INTO `oauth_personal_access_clients` VALUES (1, 1, '2017-12-20 14:45:17', '2017-12-20 14:45:17');

-- ----------------------------
-- Table structure for oauth_refresh_tokens
-- ----------------------------
DROP TABLE IF EXISTS `oauth_refresh_tokens`;
CREATE TABLE `oauth_refresh_tokens`  (
  `id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime(0) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `oauth_refresh_tokens_access_token_id_index`(`access_token_id`) USING BTREE
) ENGINE = MyISAM CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets`  (
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) DEFAULT NULL,
  INDEX `password_resets_email_index`(`email`) USING BTREE
) ENGINE = MyISAM CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp(0) DEFAULT NULL,
  `updated_at` timestamp(0) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `users_email_unique`(`email`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'user01', 'user01@163.com', '$2y$10$mhMTnUCmgZgL..fMB.rPMenL0llcfi26IvJyLWOUSgD0R2ztc9hgm', 'X1Rk4lsvhIbpatCDYNv6UDuft1KgFhip54zdYb50n3hNsiGVwJvOUhswM0Qa', '2017-11-20 14:56:34', '2017-11-20 14:56:34');
INSERT INTO `users` VALUES (2, 'guest', 'guest@163.com', '$2y$10$yRYpkZ4DsowgyfyTEDXJX.wnWl9mLYmUrcS1AiJIyk/0cWQBjuV.u', 'VQoSn36x7ftXRSmXvLWPDNmSBU0i1RGxHTQwfV896dVswX90V91O7WVXiV5R', '2017-11-20 14:56:56', '2017-11-20 14:56:56');
INSERT INTO `users` VALUES (3, 'user02', 'user02@163.com', '$2y$10$17.1wgUx981GqG1xi2YYU.cwf/yY/AcZEWz2ErWMNq/5brOaFKTMm', NULL, '2017-11-20 15:18:53', '2017-11-20 15:18:53');
INSERT INTO `users` VALUES (4, 'user03', 'user03@163.com', '$2y$10$IcC3eI1wNhdyQxiQs9XwwugEpb2pyD0o2GWNk8pOuZEeMf9RDtCZm', 'OrzxY68zcld9gqpilfdviJ6sEztIE0gBMqNbFH0RuWhe6Mc7TGhRNcaIaOeI', '2017-11-20 15:25:36', '2017-11-20 15:25:36');
INSERT INTO `users` VALUES (5, 'user04', 'user04@163.com', '$2y$10$hFCBGCbWkSn19lourdkf/eAJnIKyiKFQA7Ogh2FGlqPWORyAOD7gS', 'wdwdyObXqPZgPr2bFFAz8IVIFZbs2WJPefCdjz68nYDreL4eYOjRhP9nIaAQ', '2017-12-04 14:55:30', '2017-12-04 14:55:30');
INSERT INTO `users` VALUES (6, 'user05', 'user05@163.com', '$2y$10$dISHWgbgYwGlkE5oUclQVe4MffE5DA9aL7EkfqOldx0jMPFVni.te', 'bWtewdiXv0huZt0Z7l5dLw0Xcy2njTfBt4fEFqItRBZn8WBZ5wLP2rpHYIwq', '2017-12-04 14:56:33', '2017-12-04 14:56:33');
INSERT INTO `users` VALUES (7, 'aaa', 'aaa@163.com', '$2y$10$geoCuDXHt5hUk6TCPrHNG.WRr/oOfMaoKbdVRuo6ZyqnrkuHjA1t6', NULL, '2017-12-20 15:06:26', '2017-12-20 15:06:26');

SET FOREIGN_KEY_CHECKS = 1;
