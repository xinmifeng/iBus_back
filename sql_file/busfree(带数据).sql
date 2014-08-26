# Host: 192.168.1.101  (Version: 5.5.38)
# Date: 2014-08-23 02:43:38
# Generator: MySQL-Front 5.3  (Build 4.120)

/*!40101 SET NAMES utf8 */;

#
# Structure for table "bee_activity"
#
use  busfree;

DROP TABLE IF EXISTS `bee_activity`;
CREATE TABLE `bee_activity` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `title` varchar(64) DEFAULT NULL,
  `picture_url` varchar(128) DEFAULT NULL,
  `src` varchar(512) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  `app_type` varchar(50) DEFAULT NULL,
  `download_url` varchar(256) DEFAULT NULL,
  `web_url` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=202 DEFAULT CHARSET=gbk;

#
# Data for table "bee_activity"
#

/*!40000 ALTER TABLE `bee_activity` DISABLE KEYS */;
INSERT INTO `bee_activity` VALUES (201,'fdsafd','ef2b89b7ed337173a5bedbb6488c5502.jpg','0a8a4c08c24d5935b8e1c1da68eb628f.mp4','2014-08-23 00:55:00','活动','0','5ffeadb76903220489bec4100007323a.jpg','fdas');
/*!40000 ALTER TABLE `bee_activity` ENABLE KEYS */;

#
# Structure for table "bee_banner"
#

DROP TABLE IF EXISTS `bee_banner`;
CREATE TABLE `bee_banner` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `picture_url` varchar(128) DEFAULT NULL,
  `src` varchar(512) DEFAULT NULL,
  `title` varchar(64) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `order_id` int(5) DEFAULT NULL,
  `type` varchar(32) DEFAULT NULL,
  `details_id` int(5) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=gbk;

#
# Data for table "bee_banner"
#

/*!40000 ALTER TABLE `bee_banner` DISABLE KEYS */;
INSERT INTO `bee_banner` VALUES (6,'/Image_Upload/banner1.jpg','www.baidu.com','余额宝','2014-08-21 00:00:00',10,'1',NULL,NULL),(7,'/Image_Upload/banner2.jpg','www.baidu.com','余额宝','2014-08-21 00:00:00',20,'1',NULL,NULL),(8,'/Image_Upload/banner3.jpg','www.baidu.com','余额宝','2014-08-21 00:00:00',30,'1',NULL,NULL);
/*!40000 ALTER TABLE `bee_banner` ENABLE KEYS */;

#
# Structure for table "bee_index"
#

DROP TABLE IF EXISTS `bee_index`;
CREATE TABLE `bee_index` (
  `index_id` int(5) NOT NULL AUTO_INCREMENT,
  `index_type` int(4) DEFAULT NULL COMMENT '0:视频天地一行 1:视频 2:活动',
  `pic_url` varchar(256) DEFAULT NULL,
  `details_id` int(5) DEFAULT NULL,
  `src` varchar(512) DEFAULT NULL,
  `position` int(4) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  PRIMARY KEY (`index_id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=gbk;

#
# Data for table "bee_index"
#

/*!40000 ALTER TABLE `bee_index` DISABLE KEYS */;
INSERT INTO `bee_index` VALUES (1,1,'/Image_Upload/index1.jpg',1,'www.baidu.com',2,NULL),(2,1,'/Image_Upload/index2.jpg',1,'www.baidu.com',3,NULL),(3,2,'/Image_Upload/index3.jpg',201,'www.baidu.com',4,NULL),(4,2,'/Image_Upload/index4.jpg',201,'www.baidu.com',5,NULL),(5,2,'/Image_Upload/index5.jpg',201,'www.baidu.com',6,NULL),(6,2,'/Image_Upload/index6.jpg',201,'www.baidu.com',7,NULL),(7,2,'/Image_Upload/index7.jpg',201,'www.baidu.com',8,NULL),(8,2,'/Image_Upload/index8.jpg',201,'www.baidu.com',9,NULL),(9,2,'/Image_Upload/index9.jpg',201,'www.baidu.com',10,NULL),(10,2,'/Image_Upload/index10.jpg',201,'www.baidu.com',11,NULL),(11,0,'/Image_Upload/shangwang.jpg',NULL,NULL,1,NULL),(12,0,'/Image_Upload/tiandi.jpg',NULL,NULL,0,NULL);
/*!40000 ALTER TABLE `bee_index` ENABLE KEYS */;

#
# Structure for table "bee_system_user"
#

DROP TABLE IF EXISTS `bee_system_user`;
CREATE TABLE `bee_system_user` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) DEFAULT NULL,
  `password` varchar(32) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=gbk;

#
# Data for table "bee_system_user"
#

/*!40000 ALTER TABLE `bee_system_user` DISABLE KEYS */;
INSERT INTO `bee_system_user` VALUES (1,'admin','21232f297a57a5a743894a0e4a801fc3','2014-08-20 00:00:00');
/*!40000 ALTER TABLE `bee_system_user` ENABLE KEYS */;

#
# Structure for table "bee_user"
#

DROP TABLE IF EXISTS `bee_user`;
CREATE TABLE `bee_user` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(20) DEFAULT NULL,
  `password` varchar(32) DEFAULT NULL,
  `status` varchar(1) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=gbk;

#
# Data for table "bee_user"
#

/*!40000 ALTER TABLE `bee_user` DISABLE KEYS */;
INSERT INTO `bee_user` VALUES (5,'18500239527','e10adc3949ba59abbe56e057f20f883e','1','2014-08-22 22:00:12'),(6,'13716806004','e10adc3949ba59abbe56e057f20f883e','1','2014-08-22 22:12:30');
/*!40000 ALTER TABLE `bee_user` ENABLE KEYS */;

#
# Structure for table "bee_user_history"
#

DROP TABLE IF EXISTS `bee_user_history`;
CREATE TABLE `bee_user_history` (
  `his_id` int(5) NOT NULL AUTO_INCREMENT,
  `user_id` int(5) DEFAULT NULL,
  `src_id` int(5) DEFAULT NULL COMMENT '视频或活动id',
  `count` int(5) DEFAULT NULL,
  `is_like` int(1) DEFAULT NULL,
  `src_type` int(5) DEFAULT NULL COMMENT '1：活动 2：视频',
  `create_date` datetime DEFAULT NULL,
  PRIMARY KEY (`his_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=gbk;

#
# Data for table "bee_user_history"
#

/*!40000 ALTER TABLE `bee_user_history` DISABLE KEYS */;
INSERT INTO `bee_user_history` VALUES (1,5,6,1,1,2,'2014-03-14 20:23:20');
/*!40000 ALTER TABLE `bee_user_history` ENABLE KEYS */;

#
# Structure for table "bee_video"
#

DROP TABLE IF EXISTS `bee_video`;
CREATE TABLE `bee_video` (
  `v_id` int(5) NOT NULL AUTO_INCREMENT,
  `type_id` int(5) DEFAULT NULL,
  `title` varchar(20) DEFAULT NULL,
  `pic_url` varchar(256) DEFAULT NULL,
  `v_name` varchar(128) DEFAULT NULL,
  `address` varchar(256) DEFAULT NULL,
  `length` varchar(32) DEFAULT NULL,
  `totle_like` int(5) DEFAULT '0',
  `count` varchar(64) DEFAULT '0',
  `order_id` int(5) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  PRIMARY KEY (`v_id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=gbk;

#
# Data for table "bee_video"
#

/*!40000 ALTER TABLE `bee_video` DISABLE KEYS */;
INSERT INTO `bee_video` VALUES (1,1,'酥油灯','Image_Upload/history_demo.jpg','酥油灯.mp4','/Video_Upload/酥油灯.mp4','00:19:53',42,'42',113,'2014-08-20 10:06:00'),(2,1,'大土狼的落败','Image_Upload/history_demo.jpg','大土狼的落败.mp4','/Video_Upload/大土狼的落败.mp4','00:19:53',52,'56',114,'2014-08-20 12:06:00'),(3,1,'二逼男反串','Image_Upload/history_demo.jpg','二逼男反串.mp4','/Video_Upload/二逼男反串.mp4','00:19:53',53,'42',115,'2014-08-20 13:06:00'),(4,1,'瑞典遭炸弹威胁','Image_Upload/history_demo.jpg','瑞典遭炸弹威胁.mp4','/Video_Upload/瑞典遭炸弹威胁.mp4','00:19:53',53,'76',116,'2014-08-20 13:06:00'),(5,1,'中国土豪定制','Image_Upload/history_demo.jpg','中国土豪定制.mp4','/Video_Upload/中国土豪定制.mp4','00:19:53',0,'0',117,'2014-08-20 13:06:00'),(6,2,'酥油灯','Image_Upload/history_demo.jpg','酥油灯.mp4','/Video_Upload/酥油灯.mp4','00:19:53',0,'0',118,'2014-08-20 13:06:00'),(12,7,'小霸王','Image_Upload/history_demo.jpg','小霸王打是阿尔沙发','额外斯蒂芬','33',0,'0',138,'2014-08-22 16:51:51'),(13,8,'阿 ','Image_Upload/history_demo.jpg','斯蒂芬斯蒂芬','问问','323',0,'0',148,'2014-08-22 16:52:50'),(17,6,'大泽','Image_Upload/history_demo.jpg','32斯蒂芬','322实得分','32多少',0,'0',178,'2014-08-22 20:54:30'),(18,8,'阿萨德2','Image_Upload/history_demo.jpg','112','122','122',0,'0',1882,'2014-08-22 21:14:46');
/*!40000 ALTER TABLE `bee_video` ENABLE KEYS */;

#
# Structure for table "bee_video_type"
#

DROP TABLE IF EXISTS `bee_video_type`;
CREATE TABLE `bee_video_type` (
  `type_id` int(5) NOT NULL AUTO_INCREMENT,
  `type_name` varchar(32) DEFAULT NULL,
  `order_id` int(4) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  PRIMARY KEY (`type_id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=gbk;

#
# Data for table "bee_video_type"
#

/*!40000 ALTER TABLE `bee_video_type` DISABLE KEYS */;
INSERT INTO `bee_video_type` VALUES (1,'热门',10,'2014-08-20 14:33:40'),(2,'搞笑',20,'2014-08-20 14:34:30'),(5,'电影',30,'2014-08-21 17:21:44'),(6,'动漫',40,'2014-08-21 17:21:54'),(7,'汽车',50,'2014-08-21 17:22:04'),(8,'资讯',60,'2014-08-21 17:22:12');
/*!40000 ALTER TABLE `bee_video_type` ENABLE KEYS */;
