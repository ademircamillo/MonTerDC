# Host: mysql.ademircamillo.com.br  (Version 5.5.40-log)
# Date: 2018-08-01 08:55:47
# Generator: MySQL-Front 6.0  (Build 2.20)


#
# Structure for table "localizacao"
#

DROP TABLE IF EXISTS `localizacao`;
CREATE TABLE `localizacao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_captor_sensor` int(255) DEFAULT NULL,
  `posX` int(255) DEFAULT NULL,
  `posY` int(255) DEFAULT NULL,
  `posZ` int(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Data for table "localizacao"
#

INSERT INTO `localizacao` VALUES (1,1,50,70,65),(2,2,70,70,65),(3,3,90,70,65),(4,4,110,70,65),(5,5,150,70,65),(6,6,170,70,65),(7,7,190,70,65),(8,8,210,70,65),(9,9,50,160,65),(10,10,70,160,65),(11,11,90,160,65),(12,12,110,160,65),(13,13,150,160,65),(14,14,170,160,65),(15,15,190,160,65),(16,16,210,160,65);
