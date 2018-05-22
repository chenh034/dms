/*
 Navicat Premium Data Transfer

 Source Server         : dms
 Source Server Type    : MySQL
 Source Server Version : 50621
 Source Host           : 121.42.248.249
 Source Database       : db_dms

 Target Server Type    : MySQL
 Target Server Version : 50621
 File Encoding         : utf-8

 Date: 11/10/2017 22:03:10 PM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `t_admin`
-- ----------------------------
DROP TABLE IF EXISTS `t_admin`;
CREATE TABLE `t_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `username` varchar(60) NOT NULL COMMENT '用户名',
  `password` varchar(32) NOT NULL COMMENT '密码',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `t_area`
-- ----------------------------
DROP TABLE IF EXISTS `t_area`;
CREATE TABLE `t_area` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `areaID` int(11) NOT NULL,
  `area` varchar(20) CHARACTER SET gbk NOT NULL,
  `fatherID` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3145 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `t_city`
-- ----------------------------
DROP TABLE IF EXISTS `t_city`;
CREATE TABLE `t_city` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cityID` int(11) NOT NULL,
  `city` varchar(20) NOT NULL,
  `fatherID` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=346 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `t_comment_pic`
-- ----------------------------
DROP TABLE IF EXISTS `t_comment_pic`;
CREATE TABLE `t_comment_pic` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `comment_id` int(11) DEFAULT NULL COMMENT '评论id',
  `img_url` varchar(60) DEFAULT NULL COMMENT '图片地址',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `t_dorm`
-- ----------------------------
DROP TABLE IF EXISTS `t_dorm`;
CREATE TABLE `t_dorm` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `farm_id` int(10) DEFAULT NULL,
  `deviceSerial` varchar(60) DEFAULT NULL,
  `validateCode` varchar(6) DEFAULT NULL,
  `url` varchar(120) DEFAULT NULL,
  `name` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `t_farm_message`
-- ----------------------------
DROP TABLE IF EXISTS `t_farm_message`;
CREATE TABLE `t_farm_message` (
  `mid` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `farm_id` int(11) DEFAULT NULL COMMENT '养殖户id',
  `product_id` int(11) DEFAULT NULL COMMENT '产品id',
  `forage` varchar(30) DEFAULT NULL COMMENT '饲料更改',
  `feed_time` varchar(11) DEFAULT NULL COMMENT '喂养时间更改',
  `kill_time` varchar(11) DEFAULT NULL COMMENT '宰杀提醒',
  `log` varchar(120) DEFAULT NULL COMMENT '物流消息',
  `feed` varchar(1) DEFAULT NULL,
  `check` varchar(60) DEFAULT NULL COMMENT '审核信息',
  `update_time` varchar(20) DEFAULT NULL COMMENT '更新时间',
  `confirm` char(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`mid`)
) ENGINE=MyISAM AUTO_INCREMENT=91 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `t_farm_result`
-- ----------------------------
DROP TABLE IF EXISTS `t_farm_result`;
CREATE TABLE `t_farm_result` (
  `rid` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `farm_id` int(11) DEFAULT NULL COMMENT '养殖户id',
  `product_id` int(11) DEFAULT NULL COMMENT '产品id',
  `total_weight` varchar(11) DEFAULT NULL COMMENT '总出肉量',
  `content` text COMMENT '出肉结果',
  `createtime` int(11) DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`rid`)
) ENGINE=InnoDB AUTO_INCREMENT=91 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `t_farm_update`
-- ----------------------------
DROP TABLE IF EXISTS `t_farm_update`;
CREATE TABLE `t_farm_update` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `farm_id` int(10) DEFAULT NULL,
  `name` varchar(10) DEFAULT NULL,
  `cellphone` varchar(11) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `id_number` varchar(18) DEFAULT NULL,
  `farm_name` varchar(60) DEFAULT NULL,
  `area_id` varchar(6) DEFAULT NULL,
  `detail_place` varchar(60) DEFAULT NULL,
  `status` char(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `t_farm_user`
-- ----------------------------
DROP TABLE IF EXISTS `t_farm_user`;
CREATE TABLE `t_farm_user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `username` varchar(60) NOT NULL COMMENT '用户名',
  `password` varchar(32) NOT NULL COMMENT '密码',
  `name` varchar(60) DEFAULT NULL COMMENT '姓名',
  `cellphone` varchar(11) DEFAULT NULL COMMENT '手机号',
  `email` varchar(60) DEFAULT NULL COMMENT '邮箱',
  `id_number` varchar(18) DEFAULT NULL COMMENT '身份证',
  `account_place` varchar(60) DEFAULT NULL COMMENT '联系地址',
  `bak_phone` varchar(20) DEFAULT NULL COMMENT '备用电话',
  `farm_name` varchar(60) DEFAULT NULL COMMENT '养殖场名称',
  `area_id` int(6) DEFAULT NULL COMMENT '区域id',
  `pca` varchar(60) DEFAULT NULL COMMENT '省市区',
  `detail_place` varchar(60) DEFAULT NULL COMMENT '详细地址',
  `dorm_num` varchar(10) DEFAULT NULL COMMENT '猪舍数量',
  `product_num` varchar(10) DEFAULT NULL COMMENT '产品数量',
  `forage_offer` varchar(60) DEFAULT NULL COMMENT '提供的饲料',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `t_font_message`
-- ----------------------------
DROP TABLE IF EXISTS `t_font_message`;
CREATE TABLE `t_font_message` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `font_id` int(11) DEFAULT NULL COMMENT '用户户id',
  `product_id` int(11) DEFAULT NULL COMMENT '产品id',
  `forage` varchar(30) DEFAULT NULL COMMENT '饲料更改',
  `feed_time` varchar(11) DEFAULT NULL COMMENT '喂养时间更改',
  `kill` varchar(11) DEFAULT NULL COMMENT '宰杀提醒',
  `log` varchar(120) DEFAULT NULL COMMENT '物流消息',
  `feed` varchar(1) DEFAULT NULL,
  `update_time` varchar(20) DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `t_font_user`
-- ----------------------------
DROP TABLE IF EXISTS `t_font_user`;
CREATE TABLE `t_font_user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `username` varchar(30) NOT NULL COMMENT '用户名',
  `password` varchar(32) NOT NULL COMMENT '密码',
  `nickname` varchar(30) DEFAULT NULL COMMENT '昵称',
  `head_url` varbinary(60) NOT NULL DEFAULT '/assets/c/images/common/person.jpg' COMMENT '头像地址',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=76 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `t_forage`
-- ----------------------------
DROP TABLE IF EXISTS `t_forage`;
CREATE TABLE `t_forage` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `type_id` int(11) NOT NULL COMMENT '饲料类别id',
  `product_id` int(11) NOT NULL COMMENT '所属产品id',
  `farm_id` int(11) NOT NULL COMMENT '所属养殖户id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `t_forage_offer`
-- ----------------------------
DROP TABLE IF EXISTS `t_forage_offer`;
CREATE TABLE `t_forage_offer` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `farm_id` int(11) DEFAULT NULL COMMENT '养殖户id',
  `forage_id` int(11) DEFAULT NULL COMMENT '饲料名称id',
  `price` varchar(30) DEFAULT NULL COMMENT '价格',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `t_forage_type`
-- ----------------------------
DROP TABLE IF EXISTS `t_forage_type`;
CREATE TABLE `t_forage_type` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `name` varchar(60) NOT NULL COMMENT '饲料名称',
  `object` varchar(30) NOT NULL COMMENT '饲养对象',
  `ingredient` varchar(60) DEFAULT NULL COMMENT '成分',
  `introduce` text COMMENT '介绍',
  `img_url` varchar(60) DEFAULT NULL COMMENT '图片地址',
  `createtime` int(11) DEFAULT NULL COMMENT '创建时间',
  `is_use` char(1) DEFAULT '1' COMMENT '是否使用',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `t_handbook`
-- ----------------------------
DROP TABLE IF EXISTS `t_handbook`;
CREATE TABLE `t_handbook` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `title` varchar(60) DEFAULT NULL COMMENT '标题',
  `content` text COMMENT '内容',
  `img_url` varchar(60) DEFAULT NULL COMMENT '图片地址',
  `update_time` int(11) DEFAULT NULL COMMENT '修改时间',
  `is_top` char(1) NOT NULL DEFAULT '0' COMMENT '置顶',
  `mark` char(1) NOT NULL DEFAULT '0' COMMENT '养殖必读',
  `important` varchar(2) DEFAULT NULL COMMENT '重要性',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `t_index_img`
-- ----------------------------
DROP TABLE IF EXISTS `t_index_img`;
CREATE TABLE `t_index_img` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `title` varchar(30) DEFAULT NULL COMMENT '标题',
  `target` text COMMENT '指向地址',
  `img_url` varchar(60) DEFAULT NULL COMMENT '图片地址',
  `is_show` char(1) NOT NULL DEFAULT '1' COMMENT '是否首页显示',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `t_infos`
-- ----------------------------
DROP TABLE IF EXISTS `t_infos`;
CREATE TABLE `t_infos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) DEFAULT NULL,
  `content` text,
  `update_time` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `t_order`
-- ----------------------------
DROP TABLE IF EXISTS `t_order`;
CREATE TABLE `t_order` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `nickname` varchar(60) DEFAULT NULL,
  `product_type` char(1) DEFAULT NULL,
  `address_id` int(11) DEFAULT NULL,
  `amount` varchar(20) DEFAULT NULL,
  `status` varchar(3) DEFAULT NULL,
  `express` varchar(20) DEFAULT NULL,
  `express_num` varchar(30) DEFAULT NULL,
  `tradeno` varchar(100) DEFAULT NULL,
  `tradeext` text,
  `createtime` varchar(11) DEFAULT NULL,
  `updatetime` varchar(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=125 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `t_order_adopt`
-- ----------------------------
DROP TABLE IF EXISTS `t_order_adopt`;
CREATE TABLE `t_order_adopt` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int(11) DEFAULT NULL,
  `forage_id` int(11) DEFAULT NULL,
  `start_time` varchar(11) DEFAULT NULL,
  `end_time` varchar(11) DEFAULT NULL,
  `time_add` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `t_order_raised`
-- ----------------------------
DROP TABLE IF EXISTS `t_order_raised`;
CREATE TABLE `t_order_raised` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int(11) DEFAULT NULL,
  `setmeal_id` int(11) DEFAULT NULL,
  `price` varchar(10) DEFAULT NULL,
  `createtime` varchar(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `t_product`
-- ----------------------------
DROP TABLE IF EXISTS `t_product`;
CREATE TABLE `t_product` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `farm_id` int(11) NOT NULL COMMENT '所属养殖户id',
  `species_id` int(11) NOT NULL COMMENT '物种id',
  `type` char(1) NOT NULL COMMENT '类别：1认养，2共筹',
  `forage_id` int(11) DEFAULT NULL COMMENT '使用的饲料id',
  `name` varchar(60) DEFAULT NULL COMMENT '编号',
  `birthday` varchar(10) DEFAULT NULL COMMENT '出生日期',
  `foundation_weight` varchar(11) DEFAULT NULL COMMENT '30天体重',
  `pre_weight` varchar(11) DEFAULT NULL COMMENT '预计出肉',
  `now_weight` varchar(11) DEFAULT NULL COMMENT '当前体重',
  `foundation_price` varchar(11) DEFAULT NULL COMMENT '定价',
  `feed_price` varchar(11) DEFAULT NULL COMMENT '喂养价格/天',
  `introduce` text COMMENT '介绍',
  `img_url` varchar(60) DEFAULT NULL COMMENT '图片地址',
  `feed_time` int(10) DEFAULT NULL COMMENT '养殖时间',
  `start_time` varchar(11) DEFAULT NULL COMMENT '开始养殖时间',
  `end_time` varchar(11) DEFAULT NULL COMMENT '结束养殖时间',
  `kill_time` varchar(11) DEFAULT NULL COMMENT '宰杀时间',
  `setmeal_info` text COMMENT '套餐介绍',
  `dorm` varchar(30) NOT NULL DEFAULT '分配牧舍' COMMENT '猪舍',
  `advice` text COMMENT '养殖建议',
  `update_time` int(11) DEFAULT NULL COMMENT '更新时间',
  `output` varchar(11) DEFAULT NULL COMMENT '出肉量',
  `rate` int(2) NOT NULL DEFAULT '0' COMMENT '共筹完成度',
  `all_price` varchar(11) DEFAULT NULL COMMENT '交易金额',
  `status` char(1) NOT NULL DEFAULT '1' COMMENT '产品当前状态',
  `is_ok` char(1) NOT NULL DEFAULT '0' COMMENT '是否审核通过',
  `fail_reason` text COMMENT '审核不通过的原因',
  PRIMARY KEY (`id`),
  KEY `species_id` (`species_id`)
) ENGINE=InnoDB AUTO_INCREMENT=92 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `t_product_comment`
-- ----------------------------
DROP TABLE IF EXISTS `t_product_comment`;
CREATE TABLE `t_product_comment` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `user_id` int(11) DEFAULT NULL COMMENT '用户id',
  `product_id` int(11) DEFAULT NULL COMMENT '所属产品id',
  `content` text COMMENT '评论内容',
  `createtime` int(11) DEFAULT NULL COMMENT '创建时间',
  `is_index_show` char(1) NOT NULL DEFAULT '0' COMMENT '是否首页显示',
  `main_level` varchar(5) DEFAULT NULL COMMENT '出肉评价等级',
  `fresh_level` varchar(5) DEFAULT NULL COMMENT '新鲜度评价等级',
  `log_level` varchar(5) DEFAULT NULL COMMENT '物流评价等级',
  `is_ok` char(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `t_product_param`
-- ----------------------------
DROP TABLE IF EXISTS `t_product_param`;
CREATE TABLE `t_product_param` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `product_id` int(10) DEFAULT NULL COMMENT '产品id',
  `food_intake` varchar(30) DEFAULT NULL COMMENT '进食量',
  `activity` varchar(30) DEFAULT NULL COMMENT '活动量',
  `sleep` varchar(30) DEFAULT NULL COMMENT '睡眠量',
  `fat_ratio` varchar(30) DEFAULT NULL COMMENT '体脂率',
  `now_weight` varchar(30) DEFAULT NULL COMMENT '当前体重',
  `update_time` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=122 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `t_province`
-- ----------------------------
DROP TABLE IF EXISTS `t_province`;
CREATE TABLE `t_province` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `provinceID` int(11) NOT NULL,
  `province` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `t_question`
-- ----------------------------
DROP TABLE IF EXISTS `t_question`;
CREATE TABLE `t_question` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `type_id` int(11) NOT NULL COMMENT '问题类别id',
  `title` varchar(60) DEFAULT NULL COMMENT '问题标题',
  `answer` text COMMENT '问题答案',
  `update_time` varchar(12) DEFAULT NULL,
  `important` varchar(2) NOT NULL DEFAULT '0' COMMENT '重要性',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `t_question_type`
-- ----------------------------
DROP TABLE IF EXISTS `t_question_type`;
CREATE TABLE `t_question_type` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `name` varchar(30) DEFAULT NULL COMMENT '问题类别名称',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `t_receipt_address`
-- ----------------------------
DROP TABLE IF EXISTS `t_receipt_address`;
CREATE TABLE `t_receipt_address` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `user_id` int(11) NOT NULL COMMENT '用户id',
  `name` varchar(30) DEFAULT NULL COMMENT '收件人姓名',
  `cellphone` varchar(20) DEFAULT NULL COMMENT '联系电话',
  `area_id` int(10) DEFAULT NULL COMMENT '城市',
  `detail_address` text COMMENT '详细地址',
  `is_default` char(1) NOT NULL DEFAULT '0' COMMENT '是否默认地址',
  `is_use` char(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=69 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `t_setmeal`
-- ----------------------------
DROP TABLE IF EXISTS `t_setmeal`;
CREATE TABLE `t_setmeal` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `index` varchar(2) DEFAULT NULL COMMENT '套餐序号',
  `name` text COMMENT '套餐内容',
  `price` varchar(11) DEFAULT NULL COMMENT '价格',
  `product_id` int(11) DEFAULT NULL COMMENT '产品id',
  `farm_id` int(11) DEFAULT NULL COMMENT '所属养殖户id',
  `buy` char(1) NOT NULL DEFAULT '0' COMMENT '是否被买',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=92 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `t_species`
-- ----------------------------
DROP TABLE IF EXISTS `t_species`;
CREATE TABLE `t_species` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `parent_id` int(11) NOT NULL DEFAULT '0' COMMENT '父类id',
  `name` varchar(30) NOT NULL COMMENT '物种名称',
  `special` varchar(60) DEFAULT NULL COMMENT '特点',
  `introduce` text COMMENT '介绍',
  `img_url` varchar(60) DEFAULT NULL COMMENT '图片地址',
  `createtime` int(11) DEFAULT NULL COMMENT '创建时间',
  `is_use` char(1) NOT NULL DEFAULT '1' COMMENT '是否使用',
  PRIMARY KEY (`id`),
  KEY `parent_id` (`parent_id`),
  KEY `parent_id_2` (`parent_id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

SET FOREIGN_KEY_CHECKS = 1;
