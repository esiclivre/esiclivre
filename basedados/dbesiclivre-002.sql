-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: 03/12/2015 às 17:05
-- Versão do servidor: 5.5.46-0ubuntu0.14.04.2
-- Versão do PHP: 5.5.9-1ubuntu4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

-- --------------------------------------------------------

--
-- Estrutura para tabela `gen_bairros`
--

CREATE TABLE IF NOT EXISTS `gen_bairros` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `municipio_id` int(11) DEFAULT NULL,
  `nome` varchar(100) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`),
  KEY `bairro_municipio_fk` (`municipio_id`),
  KEY `nome` (`nome`)
) ENGINE=InnoDB  ROW_FORMAT=COMPACT AUTO_INCREMENT=49931 ;

-- --------------------------------------------------------

--
-- Estrutura para tabela `gen_estados`
--

CREATE TABLE IF NOT EXISTS `gen_estados` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) DEFAULT NULL,
  `sigla` varchar(3) CHARACTER SET utf8 DEFAULT NULL,
  `pais_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `estado_pais_fk` (`pais_id`)
) ENGINE=InnoDB  AUTO_INCREMENT=28 ;

-- --------------------------------------------------------

--
-- Estrutura para tabela `gen_logradouros`
--

CREATE TABLE IF NOT EXISTS `gen_logradouros` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `cep` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `bairro_id` int(11) DEFAULT NULL,
  `tipo_logradouro_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `logradouro_tipo_fk` (`tipo_logradouro_id`),
  KEY `cep` (`cep`)
) ENGINE=InnoDB  AUTO_INCREMENT=740867 ;

-- --------------------------------------------------------

--
-- Estrutura para tabela `gen_municipios`
--

CREATE TABLE IF NOT EXISTS `gen_municipios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `estado_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `municipio_estado_fk` (`estado_id`),
  KEY `nome` (`nome`)
) ENGINE=InnoDB  ROW_FORMAT=COMPACT AUTO_INCREMENT=11252 ;


-- --------------------------------------------------------

--
-- Estrutura para tabela `gen_paises`
--

CREATE TABLE IF NOT EXISTS `gen_paises` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  AUTO_INCREMENT=103 ;


-- --------------------------------------------------------

--
-- Estrutura para tabela `gen_tipos_logradouro`
--

CREATE TABLE IF NOT EXISTS `gen_tipos_logradouro` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(40) CHARACTER SET utf8 DEFAULT NULL,
  `ativo` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  AUTO_INCREMENT=224 ;

-- --------------------------------------------------------

--
-- Estrutura para view `vw_cep`
--
DROP VIEW IF EXISTS `vw_cep`;

CREATE VIEW `vw_cep` AS select `l`.`id` AS `idlogradouro`,`l`.`cep` AS `cep`,`l`.`nome` AS `logradouro`,`t`.`nome` AS `tipologradouro`,`t`.`id` AS `idtipologradouro`,`b`.`nome` AS `bairro`,`m`.`nome` AS `cidade`,`u`.`sigla` AS `uf`,`u`.`id` AS `idestado` from ((((`gen_logradouros` `l` join `gen_tipos_logradouro` `t` on((`l`.`tipo_logradouro_id` = `t`.`id`))) join `gen_bairros` `b` on((`l`.`bairro_id` = `b`.`id`))) join `gen_municipios` `m` on((`b`.`municipio_id` = `m`.`id`))) join `gen_estados` `u` on((`m`.`estado_id` = `u`.`id`)));

-- --------------------------------------------------------

--
-- Estrutura para view `vw_gen_municipios`
--
DROP VIEW IF EXISTS `vw_gen_municipios`;

CREATE VIEW `vw_gen_municipios` AS select `m`.`id` AS `idmunicipio`,`e`.`id` AS `idestado`,`m`.`nome` AS `municipio`,`e`.`sigla` AS `uf` from (`gen_municipios` `m` join `gen_estados` `e`) where (`m`.`estado_id` = `e`.`id`);

-- --------------------------------------------------------

--
-- Estrutura para view `vw_logradouro`
--
DROP VIEW IF EXISTS `vw_logradouro`;

CREATE VIEW `vw_logradouro` AS select `l`.`id` AS `idlogradouro`,`l`.`nome` AS `logradouro`,`l`.`cep` AS `cep`,`b`.`id` AS `idbairro`,`b`.`nome` AS `bairro`,`m`.`id` AS `idmunicipio`,`m`.`nome` AS `municipio`,`e`.`id` AS `idestado`,`e`.`sigla` AS `uf`,`e`.`nome` AS `estado`,`t`.`nome` AS `tipologradouro` from ((((`gen_logradouros` `l` join `gen_bairros` `b` on((`b`.`id` = `l`.`bairro_id`))) join `gen_tipos_logradouro` `t` on((`t`.`id` = `l`.`tipo_logradouro_id`))) join `gen_municipios` `m` on((`m`.`id` = `b`.`municipio_id`))) join `gen_estados` `e` on((`e`.`id` = `m`.`estado_id`)));

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
