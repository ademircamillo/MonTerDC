# Host: mysql.ademircamillo.com.br  (Version 5.5.40-log)
# Date: 2018-08-01 08:55:14
# Generator: MySQL-Front 6.0  (Build 2.20)


#
# Structure for table "captor"
#

DROP TABLE IF EXISTS `captor`;
CREATE TABLE `captor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Data for table "captor"
#

INSERT INTO `captor` VALUES (1,'Captor 1');
