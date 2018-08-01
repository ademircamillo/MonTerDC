# Host: mysql.ademircamillo.com.br  (Version 5.5.40-log)
# Date: 2018-08-01 08:55:41
# Generator: MySQL-Front 6.0  (Build 2.20)


#
# Structure for table "dados"
#

DROP TABLE IF EXISTS `dados`;
CREATE TABLE `dados` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_captor_sensor` int(255) DEFAULT NULL,
  `valor` float(10,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Data for table "dados"
#

