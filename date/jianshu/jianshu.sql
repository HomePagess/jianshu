/*
SQLyog Ultimate v11.24 (32 bit)
MySQL - 5.7.15-log : Database - jianshu
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`jianshu` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `jianshu`;

/*Table structure for table `js_article` */

DROP TABLE IF EXISTS `js_article`;

CREATE TABLE `js_article` (
  `js_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `js_face` varchar(40) DEFAULT NULL COMMENT '头像',
  `js_title` varchar(40) DEFAULT NULL COMMENT '标题',
  `js_content` text COMMENT '内容',
  `js_pic` varchar(40) DEFAULT NULL COMMENT '封面图片',
  `js_date` datetime DEFAULT NULL COMMENT '发布日期',
  `js_readcount` mediumint(8) DEFAULT '0' COMMENT '阅读次数',
  `js_commentcount` mediumint(8) DEFAULT '0' COMMENT '评论次数',
  `js_username` varchar(40) DEFAULT NULL COMMENT '用户名',
  PRIMARY KEY (`js_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `js_article` */

/*Table structure for table `js_comment` */

DROP TABLE IF EXISTS `js_comment`;

CREATE TABLE `js_comment` (
  `js_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `js_commenter` varchar(40) DEFAULT NULL COMMENT '评论者用户名',
  `js_commenter_face` varchar(40) DEFAULT NULL COMMENT '评论者头像',
  `js_content` varchar(200) DEFAULT NULL COMMENT '评论内容',
  `js_article_id` mediumint(8) DEFAULT NULL COMMENT '评论文章的id',
  `js_date` datetime DEFAULT NULL COMMENT '评论时间',
  PRIMARY KEY (`js_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `js_comment` */

/*Table structure for table `js_friend` */

DROP TABLE IF EXISTS `js_friend`;

CREATE TABLE `js_friend` (
  `js_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `js_addername` varchar(40) DEFAULT NULL COMMENT '添加者用户名',
  `js_adderface` varchar(40) DEFAULT NULL COMMENT '添加者头像',
  `js_friendname` varchar(40) DEFAULT NULL COMMENT '被添加者用户名',
  `js_friendface` varchar(40) DEFAULT NULL COMMENT '被添加者头像',
  `js_date` datetime DEFAULT NULL COMMENT '添加时间',
  PRIMARY KEY (`js_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `js_friend` */

/*Table structure for table `js_reply` */

DROP TABLE IF EXISTS `js_reply`;

CREATE TABLE `js_reply` (
  `js_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `js_reply_obj_id` mediumint(8) DEFAULT NULL COMMENT '回复对象id',
  `js_replyer` varchar(40) DEFAULT NULL COMMENT '回复者用户名',
  `js_content` varchar(200) DEFAULT NULL COMMENT '回复内容',
  `js_replyer_face` varchar(40) DEFAULT NULL COMMENT '回复者头像',
  `js_date` datetime DEFAULT NULL COMMENT '回复时间',
  PRIMARY KEY (`js_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `js_reply` */

/*Table structure for table `js_user` */

DROP TABLE IF EXISTS `js_user`;

CREATE TABLE `js_user` (
  `js_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `js_uniqid` varchar(40) DEFAULT NULL COMMENT '验证身份的唯一标识符',
  `js_active` varchar(40) DEFAULT NULL COMMENT '激活登陆的标识符',
  `js_username` varchar(40) DEFAULT NULL COMMENT '用户名',
  `js_password` varchar(40) DEFAULT NULL COMMENT '密码',
  `js_email` varchar(40) DEFAULT NULL COMMENT '邮箱',
  `js_time` datetime DEFAULT NULL COMMENT '注册时间',
  `js_last_time` datetime DEFAULT NULL COMMENT '最后登录时间',
  `js_last_ip` varchar(20) DEFAULT NULL COMMENT '登陆IP地址',
  `js_sex` smallint(1) DEFAULT '0' COMMENT '性别',
  `js_face` varchar(40) DEFAULT 'tx1.jpg' COMMENT '头像',
  `js_address` varchar(40) DEFAULT NULL COMMENT '地址',
  `js_birthday` varchar(40) DEFAULT NULL COMMENT '生日',
  `js_telphone` varchar(20) DEFAULT NULL COMMENT '电话',
  `js_school` varchar(20) DEFAULT NULL COMMENT '学校',
  `js_qianming` varchar(100) DEFAULT NULL COMMENT '签名',
  PRIMARY KEY (`js_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `js_user` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
