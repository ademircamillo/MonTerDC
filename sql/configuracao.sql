# Host: mysql.ademircamillo.com.br  (Version 5.5.40-log)
# Date: 2018-08-01 08:55:27
# Generator: MySQL-Front 6.0  (Build 2.20)


#
# Structure for table "configuracao"
#

DROP TABLE IF EXISTS `configuracao`;
CREATE TABLE `configuracao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Data for table "configuracao"
#

INSERT INTO `configuracao` VALUES (1,'Tempo de Captura'),(2,'Variação'),(3,'Leituras'),(4,'Processamento');
