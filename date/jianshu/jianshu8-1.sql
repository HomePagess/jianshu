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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

/*Data for the table `js_article` */

insert  into `js_article`(`js_id`,`js_face`,`js_title`,`js_content`,`js_pic`,`js_date`,`js_readcount`,`js_commentcount`,`js_username`) values (1,'tx1.jpg','和防守大家看法','积分概况零售的后果华盛顿和福克斯的粉红色的尽快发货速度快士大夫还是到付就开始的回复是的粉红色的减肥还是大家看法是的粉红色的减肥还是大家看法速度恢复健康收到发货是的粉红色的减肥还是大家看法速度放缓四大皆空粉红色的发生的环境发生的副书记和防守大家看法','lunbo1.jpg','2017-08-01 18:19:33',27,4,'潘帅'),(2,'tx1.jpg','圣诞节疯狂练级','发的说法就是考虑对方士大夫加速度克劳馥加速度发士大夫解开了士大夫精神的副食店解放昆仑山地方撒旦解放螺丝钉看的说法就是打开附件是短款礼服撒大大减少罚款老师的就是的开机速度快了是大家圣诞快乐就是打开圣诞节快乐十多个大大加快','lunbo2.jpg','2017-08-01 18:20:29',14,2,'小明'),(3,'tx1.jpg','收费的似的发射点','防守打法吗，感觉没地方干嘛的付款了关键地方看过了古代封建历史是的封建士大夫精神的开发的说法就是考虑接受的副食店解放昆仑山搭街坊昆仑山的发生的纠纷公司的圣诞节圣诞节是','lunbo3.jpg','2017-08-01 18:28:46',1,0,'小明'),(4,'tx1.jpg','的数据库了放假','上课的立法计划收到尽快恢复速度撒旦解放昆仑山搭街坊四道口了发士大夫加快了速度和法师的客户发似的发射点可是对抗疗法说得好说得好克里斯蒂分手的话克里斯多夫但是士大夫撒旦克里夫受到法律是对方是大家还是大家 的数据库来付款了速度加速度加速度克劳馥加速度克劳馥的数据是断开连接方式的四大皆空饭卡手动阀收到捐款方式打开了圣诞节分厘卡的是<br />','lunbo4.jpg','2017-08-01 18:39:48',2,0,'彤彤'),(5,'tx2.jpg','数据库覆盖了肯定是','加速度克劳馥加速度可怜经过适当放宽了个房价过快了对方进攻和领导发话大幅降低房价还得看的飞机回家的风口浪尖获得丰厚个地方艰苦的风格发动机开关的房价过快了的','lunbo5.jpg','2017-08-01 18:41:07',21,4,'彤彤'),(6,'tx3.jpg','士大夫士大夫大师傅','手机发的还是加快了副食店副食店解放昆仑山搭街坊速度附件是打开了封建士大夫司法解释骷髅法师的发生的加快立法的手机发送的分加速度克劳馥加速度放手大家看法的说法是的','member-bg.jpg','2017-08-01 18:44:13',6,1,'拉拉'),(7,'tx3.jpg','似的发射点发射点','尖峰时刻的机会昆仑山搭街坊昆仑山发士大夫监考老师地方还是短款礼服的说法就是考虑到房价还是打开了','lunbo2.jpg','2017-08-01 18:45:08',1,0,'拉拉'),(8,'tx4.jpg','是的空间裂缝很少看到','几乎都是看见了发货速度快理论上夺冠就是健康加速度克劳馥积分','lunbo1.jpg','2017-08-01 18:47:36',1,0,'嘻嘻'),(9,'tx4.jpg','加速度克劳馥回家圣诞节快乐','速度加快粉红色的尽快发货速度快雷锋精神防守对方就会圣诞快乐附件是打开了俯拾地芥','lunbo4.jpg','2017-08-01 18:47:53',1,0,'嘻嘻'),(10,'tx5.jpg','士大夫监考老师地方就是','是独立房间圣诞快乐房价还是打开链接附件几点上课了附件是打开了封建士大夫速度防守反击圣诞快乐房价的说法是非得失深刻搭街坊深刻了 <br />','lunbo5.jpg','2017-08-01 18:50:31',1,0,'天使'),(11,'tx5.jpg','解放昆仑山大家回复收到两份','和防守大家看法还是大陆发售登陆净空法师东京富士电机法兰攻击速度上的井冈山的路上感觉受到国际控股时的感觉开始的两个科技时代了速度够快了空格删掉了个 <br />','lunbo2.jpg','2017-08-01 18:50:52',6,1,'天使');

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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

/*Data for the table `js_comment` */

insert  into `js_comment`(`js_id`,`js_commenter`,`js_commenter_face`,`js_content`,`js_article_id`,`js_date`) values (1,'小明','tx1.jpg','肤色较黑士大夫',1,'2017-08-01 18:20:49'),(2,'拉拉','tx3.jpg','大师傅士大夫',5,'2017-08-01 18:44:36'),(3,'拉拉','tx3.jpg','JFK撒旦解放了',1,'2017-08-01 18:45:37'),(4,'拉拉','tx3.jpg','是酒店开了房加速度了',2,'2017-08-01 18:45:53'),(5,'嘻嘻','tx4.jpg','收到尽快发货及时打开',6,'2017-08-01 18:48:09'),(6,'嘻嘻','tx4.jpg','世界很疯狂老师电话计费',1,'2017-08-01 18:48:22'),(7,'嘻嘻','tx4.jpg','胜多负少巅峰时刻',5,'2017-08-01 18:48:37'),(8,'天使','tx5.jpg','速度JFK圣诞节',2,'2017-08-01 18:51:08'),(9,'天使','tx5.jpg','就放大看手机发送',1,'2017-08-01 18:51:24'),(10,'天使','tx5.jpg','收到付款计划圣诞快乐',5,'2017-08-01 18:51:40'),(11,'潘帅','tx1.jpg','jksdjfsd ',5,'2017-08-01 18:52:32'),(12,'潘帅','tx1.jpg','独立上市的速度快多了',11,'2017-08-01 18:52:54');

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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

/*Data for the table `js_friend` */

insert  into `js_friend`(`js_id`,`js_addername`,`js_adderface`,`js_friendname`,`js_friendface`,`js_date`) values (1,'小明','tx1.jpg','潘帅','tx1.jpg','2017-08-01 18:26:48'),(2,'彤彤','tx2.jpg','彤彤','tx2.jpg','2017-08-01 18:41:11'),(3,'彤彤','tx2.jpg','小明','tx1.jpg','2017-08-01 18:41:21'),(4,'彤彤','tx2.jpg','潘帅','tx1.jpg','2017-08-01 18:41:31'),(5,'拉拉','tx3.jpg','潘帅','tx1.jpg','2017-08-01 18:45:31'),(6,'拉拉','tx3.jpg','小明','tx1.jpg','2017-08-01 18:45:55'),(7,'嘻嘻','tx4.jpg','拉拉','tx3.jpg','2017-08-01 18:48:03'),(8,'嘻嘻','tx4.jpg','潘帅','tx1.jpg','2017-08-01 18:48:16'),(9,'嘻嘻','tx4.jpg','彤彤','tx2.jpg','2017-08-01 18:48:31'),(10,'天使','tx5.jpg','小明','tx1.jpg','2017-08-01 18:51:03'),(11,'天使','tx5.jpg','潘帅','tx1.jpg','2017-08-01 18:51:18'),(12,'天使','tx5.jpg','彤彤','tx2.jpg','2017-08-01 18:51:34'),(13,'潘帅','tx1.jpg','彤彤','tx2.jpg','2017-08-01 18:52:26'),(14,'潘帅','tx1.jpg','天使','tx5.jpg','2017-08-01 18:52:47');

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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

/*Data for the table `js_user` */

insert  into `js_user`(`js_id`,`js_uniqid`,`js_active`,`js_username`,`js_password`,`js_email`,`js_time`,`js_last_time`,`js_last_ip`,`js_sex`,`js_face`,`js_address`,`js_birthday`,`js_telphone`,`js_school`,`js_qianming`) values (2,'9bb59bc11728d51cac3a3dbba373d8c617a926cc',NULL,'潘帅','7c4a8d09ca3762af61e59520943dc26494f8941b','617860855@qq.com','2017-08-01 17:59:05','2017-08-01 17:59:05','::1',1,'tx1.jpg','江西省太难上人间','1995.2.13','18702541969','江西师范大学','还是到付就开始附件是打开感觉国家开发的'),(3,'dd3505cabd8a828acc099df317c30344c3d8ddb4',NULL,'小明','7c4a8d09ca3762af61e59520943dc26494f8941b','286182151@qq.com','2017-08-01 18:02:00','2017-08-01 18:02:00','::1',0,'tx1.jpg',NULL,NULL,NULL,NULL,NULL),(4,'e121c0b46bb9b11ebcb53883cdc50eeaede30394',NULL,'彤彤','7c4a8d09ca3762af61e59520943dc26494f8941b','djfjhfjh@163.com','2017-08-01 18:29:20','2017-08-01 18:29:20','::1',0,'tx2.jpg','和道具收费','1995.8.3','18702541969','放大镜看是否','发多少个借口就是看了个'),(5,'91bdbc130a09668f67a5060050d3cb8db6a1a568',NULL,'拉拉','7c4a8d09ca3762af61e59520943dc26494f8941b','jdskhsd@126.com','2017-08-01 18:42:47','2017-08-01 18:42:47','::1',1,'tx3.jpg','dfgdfgdfdfg','1874.2.15','151454578785','jfkj金卡戴珊','开两个角度考虑价格士大夫敢死队'),(6,'ba3d82ab5112b3e0f4d6f1c820e3d8ae3142ba72',NULL,'嘻嘻','7c4a8d09ca3762af61e59520943dc26494f8941b','4564564556@qq.com','2017-08-01 18:46:26','2017-08-01 18:46:26','::1',0,'tx4.jpg','但是看了JFK了时间和','1111.11.11','1545456464541','就开始放假就开始的肌肤','京东方昆仑山解放昆仑山附件是打开了技术的'),(7,'b4767e23e6dfa5550efe5c39ec9b3b6313b4f0b2',NULL,'天使','7c4a8d09ca3762af61e59520943dc26494f8941b','54564565@qq.com','2017-08-01 18:49:09','2017-08-01 18:49:09','::1',1,'tx5.jpg','就看到了就好了','1665.2.48','45464155545','角度考虑是否就是速度快','反对思考了飞机失控了附件是的立法司法');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
