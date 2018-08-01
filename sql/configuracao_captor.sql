# Host: mysql.ademircamillo.com.br  (Version 5.5.40-log)
# Date: 2018-08-01 08:55:33
# Generator: MySQL-Front 6.0  (Build 2.20)


#
# Structure for table "configuracao_captor"
#

DROP TABLE IF EXISTS `configuracao_captor`;
CREATE TABLE `configuracao_captor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_captor` int(255) DEFAULT NULL,
  `id_configuracao` int(255) DEFAULT NULL,
  `valor` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Data for table "configuracao_captor"
#

INSERT INTO `configuracao_captor` VALUES (1,1,1,5),(2,1,2,1),(3,1,3,10),(4,1,4,1);
