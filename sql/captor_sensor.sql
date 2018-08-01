# Host: mysql.ademircamillo.com.br  (Version 5.5.40-log)
# Date: 2018-08-01 08:55:20
# Generator: MySQL-Front 6.0  (Build 2.20)


#
# Structure for table "captor_sensor"
#

DROP TABLE IF EXISTS `captor_sensor`;
CREATE TABLE `captor_sensor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_captor` int(255) DEFAULT NULL,
  `id_sensor` int(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Data for table "captor_sensor"
#

INSERT INTO `captor_sensor` VALUES (1,1,1),(2,1,1),(3,1,1),(4,1,1),(5,1,1),(6,1,1),(7,1,1),(8,1,1),(9,1,1),(10,1,1),(11,1,1),(12,1,1),(13,1,1),(14,1,1),(15,1,1),(16,1,1);
