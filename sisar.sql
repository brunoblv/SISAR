-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           10.4.28-MariaDB - mariadb.org binary distribution
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Copiando estrutura do banco de dados para sisar
CREATE DATABASE IF NOT EXISTS `sisar` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `sisar`;

-- Copiando estrutura para tabela sisar.admissibilidade
CREATE TABLE IF NOT EXISTS `admissibilidade` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `controleinterno` int(11) DEFAULT NULL,
  `coordenadoria` varchar(2) DEFAULT NULL,
  `dataenvio` date DEFAULT NULL,
  `parecer` varchar(1) DEFAULT NULL,
  `sub` int(2) DEFAULT NULL,
  `categoria` int(1) DEFAULT NULL,
  `datareuniao` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `controleinterno` (`controleinterno`),
  CONSTRAINT `admissibilidade_ibfk_1` FOREIGN KEY (`controleinterno`) REFERENCES `inicial` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela sisar.admissibilidade: ~12 rows (aproximadamente)
INSERT INTO `admissibilidade` (`id`, `controleinterno`, `coordenadoria`, `dataenvio`, `parecer`, `sub`, `categoria`, `datareuniao`) VALUES
	(19, 26, '0', '0000-00-00', '2', 0, 0, '1970-01-01'),
	(20, 24, '5', '2023-03-07', '1', 24, 0, '2023-05-03'),
	(21, 23, '5', '2023-03-01', '1', 32, 0, '2023-04-26'),
	(22, 27, '0', '0000-00-00', '2', 2, 0, '1970-01-01'),
	(23, 22, '5', '2023-05-03', '1', 19, 0, '2023-06-28'),
	(24, 21, '0', '0000-00-00', '2', 18, 0, '1970-01-01'),
	(25, 25, '0', '0000-00-00', '2', 8, 0, '1970-01-01'),
	(26, 28, '8', '2023-06-09', '2', 16, 0, '2023-08-02'),
	(27, 30, '0', '0000-00-00', '2', 19, 0, '1970-01-01'),
	(28, 34, '5', '2022-12-05', '1', 17, 0, '2023-02-01'),
	(29, 35, '5', '2022-12-19', '2', 2, 0, '2023-02-15'),
	(30, 36, '0', '0000-00-00', '2', 2, 0, '1970-01-01'),
	(31, 43, '1', '2023-08-16', '1', 21, 0, '2023-10-11');

-- Copiando estrutura para tabela sisar.conclusao
CREATE TABLE IF NOT EXISTS `conclusao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `controleinterno` int(11) DEFAULT NULL,
  `dataapostilamento` date DEFAULT NULL,
  `dataconclusao` date DEFAULT NULL,
  `dataemissao` date DEFAULT NULL,
  `dataoutorga` date DEFAULT NULL,
  `dataresposta` date DEFAULT NULL,
  `datatermo` date DEFAULT NULL,
  `numeroalvara` varchar(255) DEFAULT NULL,
  `obs` text DEFAULT NULL,
  `outorga` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `controleinterno` (`controleinterno`),
  CONSTRAINT `conclusao_ibfk_1` FOREIGN KEY (`controleinterno`) REFERENCES `inicial` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela sisar.conclusao: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela sisar.controle_prazo
CREATE TABLE IF NOT EXISTS `controle_prazo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `controleinterno` int(11) NOT NULL,
  `descricao` varchar(100) NOT NULL DEFAULT '',
  `datainicio` date NOT NULL,
  `datafim` date NOT NULL,
  `dias` int(11) DEFAULT NULL,
  `instancia` varchar(1) NOT NULL DEFAULT '',
  `graproem` varchar(1) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `FK_controleinterno_controle_prazo` (`controleinterno`),
  CONSTRAINT `FK_controleinterno_controle_prazo` FOREIGN KEY (`controleinterno`) REFERENCES `inicial` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=93 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela sisar.controle_prazo: ~39 rows (aproximadamente)
INSERT INTO `controle_prazo` (`id`, `controleinterno`, `descricao`, `datainicio`, `datafim`, `dias`, `instancia`, `graproem`) VALUES
	(50, 17, 'Protocolo', '2023-04-12', '2023-04-12', 0, '', ''),
	(51, 18, 'Protocolo', '2022-04-11', '2022-03-12', 1, '', ''),
	(52, 19, 'Protocolo', '2022-04-05', '2022-04-11', 6, '', ''),
	(53, 20, 'Protocolo', '2022-04-05', '2022-04-12', 7, '', ''),
	(54, 21, 'Protocolo', '2022-04-12', '2022-04-12', 0, '', ''),
	(55, 22, 'Protocolo', '2022-04-13', '2022-04-13', 0, '', ''),
	(56, 23, 'Protocolo', '2023-02-13', '2023-02-13', 0, '', ''),
	(57, 24, 'Protocolo', '2023-02-14', '2023-02-14', 0, '', ''),
	(58, 25, 'Protocolo', '2023-06-28', '2023-07-10', 12, '', ''),
	(59, 26, 'Protocolo', '2023-06-20', '2023-06-23', 3, '', ''),
	(60, 26, 'Análise de Admissibilidade', '2022-04-12', '0000-00-00', 738653, '', ''),
	(61, 24, 'Análise de Admissibilidade', '2023-02-14', '2023-03-07', 21, '', ''),
	(62, 23, 'Análise de Admissibilidade', '2023-02-13', '2023-03-01', 16, '', ''),
	(63, 27, 'Protocolo', '2023-05-09', '2023-05-09', 0, '', ''),
	(64, 27, 'Análise de Admissibilidade', '2022-04-12', '0000-00-00', 738653, '', ''),
	(65, 22, 'Análise de Admissibilidade', '2022-04-12', '2023-05-03', 386, '', ''),
	(66, 21, 'Análise de Admissibilidade', '2022-04-12', '0000-00-00', 738653, '', ''),
	(67, 25, 'Análise de Admissibilidade', '2023-07-10', '0000-00-00', 739107, '', ''),
	(68, 28, 'Protocolo', '2023-04-28', '2023-05-10', 12, '', ''),
	(69, 28, 'Análise de Admissibilidade', '2022-03-12', '0000-00-00', 738622, '', ''),
	(70, 29, 'Protocolo', '2023-04-25', '2023-05-02', 7, '', ''),
	(71, 30, 'Protocolo', '2023-04-28', '2023-05-10', 12, '', ''),
	(72, 30, 'Análise de Admissibilidade', '2022-03-12', '0000-00-00', 738622, '', ''),
	(73, 31, 'Protocolo', '2023-06-21', '2023-06-21', 0, '', ''),
	(74, 32, 'Protocolo', '2023-07-02', '2023-07-18', 16, '', ''),
	(75, 33, 'Protocolo', '2023-07-01', '2023-07-18', 17, '', ''),
	(76, 34, 'Protocolo', '2022-11-17', '2022-11-17', 0, '', ''),
	(77, 35, 'Protocolo', '2022-11-17', '2022-11-17', 0, '', ''),
	(78, 34, 'Análise de Admissibilidade', '2022-03-12', '2022-12-05', 268, '', ''),
	(79, 35, 'Análise de Admissibilidade', '2022-03-12', '0000-00-00', 738622, '', ''),
	(80, 36, 'Protocolo', '2023-02-15', '2023-02-24', 9, '', ''),
	(81, 36, 'Análise de Admissibilidade', '2022-03-12', '0000-00-00', 738622, '', ''),
	(82, 37, 'Protocolo', '2023-02-16', '2023-02-24', 8, '', ''),
	(83, 38, 'Protocolo', '2023-04-12', '2023-04-12', 0, '', ''),
	(84, 39, 'Protocolo', '2023-04-12', '2023-04-12', 0, '', ''),
	(85, 40, 'Protocolo', '2023-04-05', '2023-04-05', 0, '', ''),
	(86, 41, 'Protocolo', '2022-02-03', '2022-02-03', 0, '', ''),
	(87, 42, 'Protocolo', '2022-06-20', '2022-06-24', 4, '', ''),
	(88, 43, 'Protocolo', '2023-08-02', '2023-08-09', 63, '', ''),
	(89, 43, 'Análise de Admissibilidade', '2022-03-12', '2023-08-16', 63, '', ''),
	(90, 43, 'Análise Técnica', '2023-08-16', '2023-10-18', 63, '1', '1'),
	(91, 44, 'Protocolo', '2023-03-10', '2023-03-15', 5, '', ''),
	(92, 45, 'Protocolo', '2023-03-16', '2023-03-16', 0, '', '');

-- Copiando estrutura para tabela sisar.distribuicao
CREATE TABLE IF NOT EXISTS `distribuicao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `controleinterno` int(11) DEFAULT NULL,
  `tec` varchar(255) DEFAULT NULL,
  `tectroca` varchar(255) DEFAULT NULL,
  `adm` varchar(255) DEFAULT NULL,
  `admsubst` varchar(255) DEFAULT NULL,
  `admsubst2` varchar(255) DEFAULT NULL,
  `pi` varchar(20) DEFAULT NULL,
  `assuntopi` varchar(255) DEFAULT NULL,
  `baixa` varchar(255) DEFAULT NULL,
  `obs1` text DEFAULT NULL,
  `obs2` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `controleinterno` (`controleinterno`),
  CONSTRAINT `distribuicao_ibfk_1` FOREIGN KEY (`controleinterno`) REFERENCES `inicial` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela sisar.distribuicao: ~19 rows (aproximadamente)
INSERT INTO `distribuicao` (`id`, `controleinterno`, `tec`, `tectroca`, `adm`, `admsubst`, `admsubst2`, `pi`, `assuntopi`, `baixa`, `obs1`, `obs2`) VALUES
	(15, 26, 'MARILIA FERNANDES', 'MARILIA FERNANDES', 'Cecilia Ayako Tsuruda', 'ALESSANDRO DA SILVA FERNANDES', 'Gabriel Cavinato da Ponte', '', '', '3', '', ''),
	(16, 25, 'ERICA MASSIS', 'ERICA MASSIS', 'Cecilia Ayako Tsuruda', 'Gabriel Cavinato da Ponte', 'ALESSANDRO DA SILVA FERNANDES', '', '', '3', '', ''),
	(17, 24, 'RENAN FREITAS DE ARAUJO', 'RENAN FREITAS DE ARAUJO', 'Cecilia Ayako Tsuruda', 'ALESSANDRO DA SILVA FERNANDES', 'THIAGO PRADO SILVERO', '', '', '4', '', ''),
	(18, 23, 'THAYS SANTOS HAMAD', 'THAYS SANTOS HAMAD', 'Cecilia Ayako Tsuruda', 'THIAGO PRADO SILVERO', 'ALESSANDRO DA SILVA FERNANDES', '', '', '4', '', ''),
	(19, 22, 'GILCILENE ALVES DA SILVA', 'GILCILENE ALVES DA SILVA', 'Cecilia Ayako Tsuruda', 'Gabriel Cavinato da Ponte', 'THIAGO PRADO SILVERO', '', '', '4', '', ''),
	(20, 21, 'ERICA MASSIS', 'ERICA MASSIS', 'Cecilia Ayako Tsuruda', 'LUCILÉIA JESUS MIRA', 'ALESSANDRO DA SILVA FERNANDES', '', '', '4', '', ''),
	(21, 27, 'ERICA MASSIS', 'ERICA MASSIS', 'Bruno Luiz Vieira', 'Cecilia Ayako Tsuruda', 'Gabriel Cavinato da Ponte', '', '', '4', '', ''),
	(22, 20, 'ANA MARIA GIL AUGE', 'THAYS SANTOS HAMAD', 'Cecilia Ayako Tsuruda', 'ALESSANDRO DA SILVA FERNANDES', 'Gabriel Cavinato da Ponte', '', '', '3', '', ''),
	(23, 19, 'MARILIA FERNANDES', 'ANA MARIA GIL AUGE', 'Cecilia Ayako Tsuruda', 'THIAGO PRADO SILVERO', 'ALESSANDRO DA SILVA FERNANDES', '', '', '3', '', ''),
	(24, 18, 'MARIELY FERREIRA DOS REIS LUZ', 'ANA MARIA GIL AUGE', 'Cecilia Ayako Tsuruda', 'LUCILÉIA JESUS MIRA', 'ALESSANDRO DA SILVA FERNANDES', '', '', '3', '', ''),
	(25, 28, 'ANA MARIA GIL AUGE', 'THAYS SANTOS HAMAD', 'Cecilia Ayako Tsuruda', 'ALESSANDRO DA SILVA FERNANDES', 'LUCILÉIA JESUS MIRA', '', '', '3', '', ''),
	(26, 30, 'THAYS SANTOS HAMAD', 'ANA MARIA GIL AUGE', 'Cecilia Ayako Tsuruda', 'THIAGO PRADO SILVERO', 'ALESSANDRO DA SILVA FERNANDES', '', '', '3', '', ''),
	(27, 29, 'RENAN FREITAS DE ARAUJO', 'ANA MARIA GIL AUGE', 'Cecilia Ayako Tsuruda', 'Gabriel Cavinato da Ponte', 'ALESSANDRO DA SILVA FERNANDES', '', '', '3', '', ''),
	(28, 31, 'MARILIA FERNANDES', 'GILCILENE ALVES DA SILVA', 'Cecilia Ayako Tsuruda', 'ALESSANDRO DA SILVA FERNANDES', 'THIAGO PRADO SILVERO', '', '', '3', '', ''),
	(29, 34, 'ERICA MASSIS', 'GILCILENE ALVES DA SILVA', 'Cecilia Ayako Tsuruda', 'ALESSANDRO DA SILVA FERNANDES', 'THIAGO PRADO SILVERO', '', '', '4', '', ''),
	(30, 35, 'MARIANA POLI GORTAN', 'MARILIA FERNANDES', 'Cecilia Ayako Tsuruda', 'THIAGO PRADO SILVERO', 'LUCILÉIA JESUS MIRA', '', '', '4', '', ''),
	(31, 36, 'MARIELY FERREIRA DOS REIS LUZ', 'MARILIA FERNANDES', 'Cecilia Ayako Tsuruda', 'Gabriel Cavinato da Ponte', 'ALESSANDRO DA SILVA FERNANDES', '', '', '3', '', ''),
	(32, 41, 'GILCILENE ALVES DA SILVA', 'ANA MARIA GIL AUGE', 'Gabriel Cavinato da Ponte', 'ALESSANDRO DA SILVA FERNANDES', 'Cecilia Ayako Tsuruda', '', '', '4', '', ''),
	(33, 42, 'RENAN FREITAS DE ARAUJO', 'ANA MARIA GIL AUGE', 'Gabriel Cavinato da Ponte', 'ALESSANDRO DA SILVA FERNANDES', 'LUCILÉIA JESUS MIRA', '', '', '3', '', ''),
	(34, 43, 'PAOLA TUCCI', 'MARICLÉ ORTEGA XAVIER DE ARAUJO MISCHI', 'Bruno Luiz Vieira', 'Cecilia Ayako Tsuruda', 'LUCILÉIA JESUS MIRA', '0', '0', '1', '0', '0'),
	(35, 44, 'GILCILENE ALVES DA SILVA', 'ANA MARIA GIL AUGE', 'Gabriel Cavinato da Ponte', 'ALESSANDRO DA SILVA FERNANDES', 'Cecilia Ayako Tsuruda', '', '', '3', '', '');

-- Copiando estrutura para tabela sisar.graproem
CREATE TABLE IF NOT EXISTS `graproem` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `controleinterno` int(11) DEFAULT NULL,
  `complementar` tinyint(4) DEFAULT NULL,
  `dataagendada` date DEFAULT NULL,
  `datacoord` date DEFAULT NULL,
  `datacumprimento` date DEFAULT NULL,
  `datainicio` date DEFAULT NULL,
  `datalimite` date DEFAULT NULL,
  `datapubli` date DEFAULT NULL,
  `datapublicomplementar` date DEFAULT NULL,
  `datareal` date DEFAULT NULL,
  `dataresposta` date DEFAULT NULL,
  `datasehab` date DEFAULT NULL,
  `datasiurb` date DEFAULT NULL,
  `datasmc` date DEFAULT NULL,
  `datasmt` date DEFAULT NULL,
  `datasmul` date DEFAULT NULL,
  `datasvma` date DEFAULT NULL,
  `graproem` int(1) DEFAULT NULL,
  `instancia` int(1) DEFAULT NULL,
  `motivo` int(1) DEFAULT NULL,
  `obs` text DEFAULT NULL,
  `parecer` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `controleinterno` (`controleinterno`),
  CONSTRAINT `graproem_ibfk_1` FOREIGN KEY (`controleinterno`) REFERENCES `inicial` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela sisar.graproem: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela sisar.inicial
CREATE TABLE IF NOT EXISTS `inicial` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sei` varchar(19) DEFAULT NULL,
  `numsql` varchar(20) DEFAULT NULL,
  `tipo` varchar(1) DEFAULT NULL,
  `req` varchar(3) DEFAULT NULL,
  `aprovadigital` varchar(20) DEFAULT NULL,
  `fisico` varchar(20) DEFAULT NULL,
  `dataprotocolo` date DEFAULT NULL,
  `dataad` date DEFAULT NULL,
  `tipoalvara1` varchar(1) DEFAULT NULL,
  `tipoalvara2` varchar(1) DEFAULT NULL,
  `tipoalvara3` varchar(1) DEFAULT NULL,
  `tipoprocesso` varchar(1) DEFAULT NULL,
  `obs` text DEFAULT NULL,
  `sts` varchar(255) DEFAULT NULL,
  `decreto` varchar(255) DEFAULT NULL,
  `conclusao` tinyint(4) DEFAULT NULL,
  `at_prazo` int(2) DEFAULT NULL,
  `rt_prazo` int(2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela sisar.inicial: ~42 rows (aproximadamente)
INSERT INTO `inicial` (`id`, `sei`, `numsql`, `tipo`, `req`, `aprovadigital`, `fisico`, `dataprotocolo`, `dataad`, `tipoalvara1`, `tipoalvara2`, `tipoalvara3`, `tipoprocesso`, `obs`, `sts`, `decreto`, `conclusao`, `at_prazo`, `rt_prazo`) VALUES
	(1, '6068.2022/0008276-7', '101', '1', '1', '', '', '2022-09-02', '0000-00-00', '1', '2', '1', '1', '', NULL, '1', 1, NULL, NULL),
	(2, '6068.2022/0008502-2', '9', '1', '1', 'N/A', 'N/A', '2022-09-12', '2022-09-12', '1', '2', '1', '1', '', '2', '', 0, NULL, NULL),
	(3, '1010.2022/0007750-0', '8', '1', '1', 'N/A', 'N/A', '2022-09-13', '2022-09-13', '1', '1', '1', '1', '', '6', '', 0, NULL, NULL),
	(4, '6068.2022/0008687', '7', '1', '1', 'N/A', 'N/A', '2022-09-16', '2022-09-16', '1', '1', '1', '1', '', '5', '', 0, NULL, NULL),
	(5, '1010.2022/0008240-6', '6', '1', '1', 'N/A', 'N/A', '2022-09-22', '2022-09-22', '1', '2', '1', '1', '', '5', '', 0, NULL, NULL),
	(6, '1010.2022/0008682-7', '5', '1', '1', 'N/A', 'N/A', '2022-10-05', '2022-10-05', '1', '1', '1', '1', '', '1', '', 0, NULL, NULL),
	(7, '6068.2022/0009813-2', '4', '1', '1', 'N/A', 'N/A', '2022-10-18', '2022-10-18', '1', '1', '1', '1', '', '1', '', 0, NULL, NULL),
	(8, '6068.2022/0010424-8', '3', '1', '1', 'N/A', 'N/A', '2022-11-01', '2022-11-01', '1', '1', '1', '1', '', '1', '', 0, NULL, NULL),
	(9, '1010.2022/0010303-9', '2', '1', '1', 'N/A', 'N/A', '2022-12-05', '2022-12-05', '1', '2', '1', '1', '', '1', '', 0, NULL, NULL),
	(10, '6068.2023/0000126-2', '1', '1', '1', 'N/A', 'N/A', '2023-01-09', '2023-01-09', '1', '2', '1', '1', '', '1', '', 0, NULL, NULL),
	(11, '1111.1111/1111111-1', '', '', '', '', '', '1970-01-01', '1970-01-01', '1', '1', '1', '2', '', '5', '', 0, NULL, NULL),
	(12, '6068.2022/0007017-3', '', '', '', '', '', '1970-01-01', '1970-01-01', '1', '2', '1', '2', '', '1', '', 0, NULL, NULL),
	(13, '1010.2019/0002104-5', '04620100765', '1', '007', '', '', '2019-11-29', '2019-12-06', '1', '1', '1', '2', '', '5', '', 0, NULL, NULL),
	(14, '6066.2019/0007712-0', '14102600050', '1', '004', '', '', '2019-12-17', '2019-12-17', '1', '2', '1', '2', '', '1', '', 0, NULL, NULL),
	(15, '6068.2020/0005348-8', '06738300972', '1', '002', '', '', '2020-12-11', '2020-12-11', '1', '2', '1', '1', '', '5', '1', 0, NULL, NULL),
	(16, '6068.2019/0002717-5', '08516400204', '', '', '', '', '2019-05-30', '2019-05-30', '1', '1', '1', '2', '', '1', '1', 0, NULL, NULL),
	(17, '1010.2023/0003682-1', '000000000', '5', '555', '00000-00-00-000', '0000-0.000.000-0', '2023-04-12', '2023-04-12', '1', '2', '1', '1', 'a', '1', '1', 0, NULL, NULL),
	(18, '1010.2022/0002347-7', '17112800251', '1', '5', '', '', '2022-03-31', '2022-03-12', '1', '2', '1', '2', '', '2', '2', 0, NULL, NULL),
	(19, '1010.2022/0002563-1', '29904000547', '1', '007', '', '', '2022-04-05', '2022-04-11', '1', '2', '1', '2', '', '2', '1', 0, NULL, NULL),
	(20, '1010.2022/0002544-5', '08821300110', '1', '001', '', '', '2022-04-05', '2022-04-12', '1', '2', '1', '2', '', '2', '1', 0, NULL, NULL),
	(21, '6068.2022/0003329-4', '05915300057', '1', '002', '', '', '2022-04-12', '2022-04-12', '1', '2', '1', '1', '', '4', '1', 0, NULL, NULL),
	(22, '6068.2022/0003371-5', '05801400230', '1', '002', '', '', '2022-04-13', '2022-04-13', '1', '1', '1', '2', '', '3', '', 0, NULL, NULL),
	(23, '6068.2023/0001128-4', '15205200102', '1', '027', '', '', '2023-02-13', '2023-02-13', '1', '1', '1', '1', '', '3', '1', 0, NULL, NULL),
	(24, '6068.2023/0001182-9', '08707900821', '1', '002', '', '', '2023-02-14', '2023-02-14', '1', '2', '1', '2', '', '5', '1', 0, NULL, NULL),
	(25, '1010.2023/0007080-9', '01302400495', '1', '001', '', '', '2023-06-28', '2023-07-10', '', '1', '1', '2', '', '4', '1', 0, NULL, NULL),
	(26, '1010.2023/0006810-3', '12722800453', '1', '001', '', '', '2023-06-20', '2023-06-23', '', '2', '1', '1', '', '4', '', 0, NULL, NULL),
	(27, '6068.2023/0004160-4', '16021300016', '1', '004', '', '', '2023-05-09', '2023-05-09', '', '1', '1', '1', '', '4', '', 0, NULL, NULL),
	(28, '1010.2023/0004560-0', '1403600244', '1', '008', '', '', '2023-04-28', '2023-05-10', '', '2', '2', '2', '', '4', '1', 1, NULL, NULL),
	(29, '1010.2023/0004562-3', '01403600244', '1', '8', '', '', '2023-04-25', '0000-00-00', '1', '2', '2', '1', '', '1', '2', 0, NULL, NULL),
	(30, '1010.2023/0004565-5', '01403600244', '1', '008', '', '', '2023-04-28', '2023-05-10', '1', '2', '2', '2', '', '4', '', 0, NULL, NULL),
	(31, '1010.2023/0006707-7', '1506000487', '1', '001', '', '', '2023-06-21', '2023-06-21', '2', '1', '1', '2', '', '2', '', 0, NULL, NULL),
	(32, '0000.1000/0000000-0', '000000000001', '1', '1', '1', '1', '2023-07-02', '2023-07-18', '1', '1', '1', '1', 's', '1', '1', 0, NULL, NULL),
	(33, '4441.4141/4141414-4', 'asdasdsa', 'a', 'a', '', '', '2023-07-01', '2023-07-18', '1', '1', '1', '1', 'a', '1', '1', 0, NULL, NULL),
	(34, '6068.2022/0011008-6', '11509800051', '1', '001', '', '', '2022-11-17', '2022-11-17', '2', '2', '1', '1', '', '3', '1', 0, NULL, NULL),
	(35, '6068.2022/0011015-9', '11510600263', '1', '2', '', '', '2022-11-17', '2022-11-17', '2', '2', '1', '1', '', '3', '1', 0, NULL, NULL),
	(36, '1010.2023/0001208-6', '0840500145', '1', '002', '', '', '2023-02-15', '2023-02-24', '2', '1', '1', '2', '', '4', '1', 0, NULL, NULL),
	(37, '1010.2023/0001284-1', '08562600253', '1', '002', '', '', '2023-02-16', '2023-02-24', '2', '2', '1', '2', '', '1', '1', 0, NULL, NULL),
	(38, '1010.2023/0003682-1', '123456789', '0', '011', '01245-65-64-788', '1515-1.515.151-5', '2023-04-12', '2023-04-12', '2', '2', '1', '1', '', '1', '1', 0, NULL, NULL),
	(39, '1010.2023/0003674-0', '12345698', '0', '45', '00000-00-00-000', '0000-0.000.000-0', '2023-04-12', '2023-04-12', '2', '1', '1', '2', '', '1', '1', 0, NULL, NULL),
	(40, '1010.2023/0003528-0', '748484848', '1', '12', '00000-00-00-000', '0000-0.000.000-0', '2023-04-05', '2023-04-05', '2', '2', '1', '2', '', '1', '1', 0, NULL, NULL),
	(41, '6068.2022/0001031-6', '10140000096', '1', '001', '', '', '2022-02-03', '2022-02-03', '2', '2', '1', '2', '', '2', '1', 0, NULL, NULL),
	(42, '1010.2022/0004902-6', '08515000598', '1', '015', '', '', '2022-06-20', '2022-06-24', '2', '1', '1', '2', '', '2', '1', 0, NULL, NULL),
	(43, '6068.2023/0000000-0', '123456789', '0', '011', '00000-00-00-000', '0000-0.000.000-0', '2023-08-02', '2023-08-09', '1', '1', '1', '2', 'gfgfg', '6', '1', 0, NULL, NULL),
	(44, '1010.2023/0002269-3', '08803500154', '1', '011', '', '', '2023-03-10', '2023-03-15', '2', '3', '1', '2', '', '2', '1', 0, NULL, NULL),
	(45, '6068.2023/0002289-8', '10148600335', '1', '002', '', '', '2023-03-16', '2023-03-16', '2', '1', '1', '2', '', '1', '1', 0, NULL, NULL);

-- Copiando estrutura para tabela sisar.motivoinad
CREATE TABLE IF NOT EXISTS `motivoinad` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela sisar.motivoinad: ~6 rows (aproximadamente)
INSERT INTO `motivoinad` (`id`, `descricao`) VALUES
	(1, 'Não cumprimento de requisito'),
	(2, 'Ausência de documentos'),
	(3, 'Documentação não conforme com descrição solicitada'),
	(4, 'Não está de acordo com os parâmetros urbanisticos'),
	(5, 'Não foi dado baixa no pagamento das guias'),
	(6, 'Nenhuma das anteriores');

-- Copiando estrutura para tabela sisar.motivoinad_rel
CREATE TABLE IF NOT EXISTS `motivoinad_rel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `controleinterno` int(11) DEFAULT NULL,
  `idmotivo` int(11) DEFAULT NULL,
  `descricao` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idmotivo` (`idmotivo`),
  CONSTRAINT `motivoinad_rel_ibfk_1` FOREIGN KEY (`controleinterno`) REFERENCES `inicial` (`id`),
  CONSTRAINT `motivoinad_rel_ibfk_2` FOREIGN KEY (`idmotivo`) REFERENCES `motivoinad` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela sisar.motivoinad_rel: ~17 rows (aproximadamente)
INSERT INTO `motivoinad_rel` (`id`, `controleinterno`, `idmotivo`, `descricao`) VALUES
	(10, 26, 1, NULL),
	(11, 26, 2, NULL),
	(12, 26, 4, NULL),
	(13, 27, 1, NULL),
	(14, 27, 4, NULL),
	(15, 21, 1, NULL),
	(16, 21, 2, NULL),
	(17, 25, 4, NULL),
	(18, 25, 5, NULL),
	(19, 28, 1, NULL),
	(20, 28, 2, NULL),
	(21, 28, 3, NULL),
	(22, 30, 1, NULL),
	(23, 30, 2, NULL),
	(24, 35, 1, NULL),
	(25, 35, 2, NULL),
	(26, 35, 4, NULL),
	(27, 36, 2, NULL),
	(28, 36, 3, NULL);

-- Copiando estrutura para tabela sisar.pedidos
CREATE TABLE IF NOT EXISTS `pedidos` (
  `id` int(11) DEFAULT NULL,
  `descricao` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela sisar.pedidos: ~8 rows (aproximadamente)
INSERT INTO `pedidos` (`id`, `descricao`) VALUES
	(1, 'Stand de vendas'),
	(2, 'Outorga onerosa'),
	(3, 'CEPAC'),
	(4, 'Operação Urbana'),
	(5, 'AUI'),
	(6, 'RIVI'),
	(7, 'Aquecimento Solar'),
	(8, 'Polo Gerador de Tráfego');

-- Copiando estrutura para tabela sisar.pedido_rel
CREATE TABLE IF NOT EXISTS `pedido_rel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `controleinterno` int(11) DEFAULT NULL,
  `idpedido` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela sisar.pedido_rel: ~32 rows (aproximadamente)
INSERT INTO `pedido_rel` (`id`, `controleinterno`, `idpedido`) VALUES
	(1, 33, 1),
	(2, 33, 2),
	(3, 33, 3),
	(4, 33, 4),
	(5, 33, 5),
	(6, 33, 6),
	(7, 33, 7),
	(8, 33, 8),
	(9, 36, 7),
	(10, 37, 2),
	(11, 38, 1),
	(12, 38, 6),
	(13, 38, 0),
	(14, 39, 3),
	(15, 39, 5),
	(16, 40, 1),
	(17, 40, 2),
	(18, 40, 3),
	(19, 40, 4),
	(20, 40, 5),
	(21, 40, 6),
	(22, 40, 7),
	(23, 40, 8),
	(24, 42, 2),
	(25, 43, 1),
	(26, 43, 2),
	(27, 43, 3),
	(28, 43, 4),
	(29, 43, 5),
	(30, 43, 6),
	(31, 43, 7),
	(32, 43, 8),
	(33, 44, 2),
	(34, 44, 7),
	(35, 45, 1);

-- Copiando estrutura para tabela sisar.primeirainstancia
CREATE TABLE IF NOT EXISTS `primeirainstancia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `controleinterno` int(11) NOT NULL,
  `datainicio` date DEFAULT NULL,
  `datalimite` date DEFAULT NULL,
  `dataagendada` date DEFAULT NULL,
  `datareal` date DEFAULT NULL,
  `motivo` int(1) NOT NULL,
  `parecer` int(1) NOT NULL,
  `datapubli` date DEFAULT NULL,
  `datasmul` date DEFAULT NULL,
  `datasmc` date DEFAULT NULL,
  `datasmt` date DEFAULT NULL,
  `datasehab` date DEFAULT NULL,
  `datasiurb` date DEFAULT NULL,
  `datasvma` date DEFAULT NULL,
  `obs` text DEFAULT NULL,
  `datacumprimento_r` date DEFAULT NULL,
  `datalimite_r` date DEFAULT NULL,
  `dataagendada_r` date DEFAULT NULL,
  `datareal_r` date DEFAULT NULL,
  `motivo_r` int(1) NOT NULL,
  `parecer_r` int(1) NOT NULL,
  `datapubli_r` date DEFAULT NULL,
  `datasmul_r` date DEFAULT NULL,
  `datasmc_r` date DEFAULT NULL,
  `datasmt_r` date DEFAULT NULL,
  `datasehab_r` date DEFAULT NULL,
  `datasiurb_r` date DEFAULT NULL,
  `datasvma_r` date DEFAULT NULL,
  `obs_r` text DEFAULT NULL,
  `complementar` tinyint(4) NOT NULL,
  `datapublicomplementar` date DEFAULT NULL,
  `datacumprimento_c` date DEFAULT NULL,
  `datalimite_c` date DEFAULT NULL,
  `dataagendada_c` date DEFAULT NULL,
  `datareal_c` date DEFAULT NULL,
  `motivo_c` int(1) NOT NULL,
  `parecer_c` int(1) NOT NULL,
  `datapubli_c` date DEFAULT NULL,
  `datasmul_c` date DEFAULT NULL,
  `datasmc_c` date DEFAULT NULL,
  `datasmt_c` date DEFAULT NULL,
  `datasehab_c` date DEFAULT NULL,
  `datasiurb_c` date DEFAULT NULL,
  `datasvma_c` date DEFAULT NULL,
  `datacoord` date DEFAULT NULL,
  `obs_c` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `controleinterno` (`controleinterno`),
  CONSTRAINT `primeirainstancia_ibfk_1` FOREIGN KEY (`controleinterno`) REFERENCES `inicial` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela sisar.primeirainstancia: ~0 rows (aproximadamente)
INSERT INTO `primeirainstancia` (`id`, `controleinterno`, `datainicio`, `datalimite`, `dataagendada`, `datareal`, `motivo`, `parecer`, `datapubli`, `datasmul`, `datasmc`, `datasmt`, `datasehab`, `datasiurb`, `datasvma`, `obs`, `datacumprimento_r`, `datalimite_r`, `dataagendada_r`, `datareal_r`, `motivo_r`, `parecer_r`, `datapubli_r`, `datasmul_r`, `datasmc_r`, `datasmt_r`, `datasehab_r`, `datasiurb_r`, `datasvma_r`, `obs_r`, `complementar`, `datapublicomplementar`, `datacumprimento_c`, `datalimite_c`, `dataagendada_c`, `datareal_c`, `motivo_c`, `parecer_c`, `datapubli_c`, `datasmul_c`, `datasmc_c`, `datasmt_c`, `datasehab_c`, `datasiurb_c`, `datasvma_c`, `datacoord`, `obs_c`) VALUES
	(12, 43, '2023-08-16', '2023-10-15', '2023-10-11', '2023-10-18', 0, 1, '2023-10-18', '2023-10-18', '2023-10-10', '2023-10-18', '2023-10-18', '2023-10-18', '2023-10-10', 'gg', NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- Copiando estrutura para tabela sisar.reconsideracao_admissibilidade
CREATE TABLE IF NOT EXISTS `reconsideracao_admissibilidade` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `controleinterno` int(11) DEFAULT NULL,
  `dataenvio` date DEFAULT NULL,
  `datapubli` date DEFAULT NULL,
  `datarecon` date DEFAULT NULL,
  `parecer` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `controleinterno` (`controleinterno`),
  CONSTRAINT `reconsideracao_admissibilidade_ibfk_1` FOREIGN KEY (`controleinterno`) REFERENCES `inicial` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela sisar.reconsideracao_admissibilidade: ~1 rows (aproximadamente)
INSERT INTO `reconsideracao_admissibilidade` (`id`, `controleinterno`, `dataenvio`, `datapubli`, `datarecon`, `parecer`) VALUES
	(2, 28, '2023-06-09', '2023-06-08', '2023-05-26', '2'),
	(3, 35, '2022-12-19', '2022-12-18', '2022-12-05', '1');

-- Copiando estrutura para tabela sisar.secretarias
CREATE TABLE IF NOT EXISTS `secretarias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `controleinterno` int(11) DEFAULT NULL,
  `interfacesehab` tinyint(4) DEFAULT NULL,
  `interfacesiurb` tinyint(4) DEFAULT NULL,
  `interfacesmc` tinyint(4) DEFAULT NULL,
  `interfacesmt` tinyint(4) DEFAULT NULL,
  `interfacesvma` tinyint(4) DEFAULT NULL,
  `sehab` varchar(19) DEFAULT NULL,
  `siurb` varchar(19) DEFAULT NULL,
  `smc` varchar(19) DEFAULT NULL,
  `smt` varchar(19) DEFAULT NULL,
  `svma` varchar(19) DEFAULT NULL,
  `tec` varchar(19) DEFAULT NULL,
  `tec2` varchar(19) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `controleinterno` (`controleinterno`),
  CONSTRAINT `secretarias_ibfk_1` FOREIGN KEY (`controleinterno`) REFERENCES `inicial` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela sisar.secretarias: ~0 rows (aproximadamente)
INSERT INTO `secretarias` (`id`, `controleinterno`, `interfacesehab`, `interfacesiurb`, `interfacesmc`, `interfacesmt`, `interfacesvma`, `sehab`, `siurb`, `smc`, `smt`, `svma`, `tec`, `tec2`) VALUES
	(8, 24, 0, 0, 0, 0, 1, '', '6068.2023/0001670-7', '6068.2023/0001671-5', '6068.2023/0001669-3', '6068.2023/0001668-5', 'Luis Cato', '-'),
	(9, 43, 1, 0, 0, 0, 1, '0000000000000', '', '', '', '0000000000000', 'Gustavo', 'ddd');

-- Copiando estrutura para tabela sisar.suspensao_prazo
CREATE TABLE IF NOT EXISTS `suspensao_prazo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `controleinterno` int(11) DEFAULT NULL,
  `datainicio` date DEFAULT NULL,
  `datafim` date DEFAULT NULL,
  `motivo` int(1) DEFAULT NULL,
  `etapa` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `controleinterno` (`controleinterno`),
  CONSTRAINT `suspensao_prazo_ibfk_1` FOREIGN KEY (`controleinterno`) REFERENCES `inicial` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela sisar.suspensao_prazo: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela sisar.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `iduser` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(255) DEFAULT NULL,
  `cargo` varchar(255) DEFAULT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `permissao` int(1) DEFAULT NULL,
  `statususer` int(1) DEFAULT NULL,
  PRIMARY KEY (`iduser`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela sisar.usuarios: ~21 rows (aproximadamente)
INSERT INTO `usuarios` (`iduser`, `login`, `cargo`, `nome`, `permissao`, `statususer`) VALUES
	(1, 'd854440\r\n', 'ADM', 'Bruno Luiz Vieira', 1, 1),
	(2, 'd855060', 'ADM', 'Gabriel Cavinato da Ponte', 1, 1),
	(3, 'd851675', 'ADM', 'Cecilia Ayako Tsuruda', 1, 1),
	(4, 'D877313', 'ADM', 'Kendi Souza Kurihara', 1, 1),
	(6, 'd877329', 'ADM', 'ALESSANDRO DA SILVA FERNANDES', 1, 0),
	(7, 'd810084', 'TEC', 'ANA MARIA GIL AUGE', 1, 0),
	(9, 'd775098', 'TEC', 'ERICA MASSIS', 1, 0),
	(10, 'd805990', 'TEC', 'FERNANDA CSORDAS', 1, 0),
	(11, 'd809676', 'TEC', 'GILCILENE ALVES DA SILVA', 1, 0),
	(12, 'd793392', 'TEC', 'LAURA GITTI CAMPELLE PAIM', 1, 0),
	(13, 'd839720', 'ADM', 'LUCILÉIA JESUS MIRA', 1, 0),
	(14, 'd892523', 'TEC', 'MARIANA POLI GORTAN', 1, 0),
	(15, 'd598542', 'TEC', 'MARICLÉ ORTEGA XAVIER DE ARAUJO MISCHI', 1, 0),
	(16, 'd912599', 'TEC', 'MARIELY FERREIRA DOS REIS LUZ', 1, 0),
	(17, 'd806960', 'TEC', 'MARILIA FERNANDES', 1, 0),
	(18, 'd810448', 'TEC', 'PAOLA TUCCI', 1, 0),
	(19, 'd806753', 'TEC', 'PAULA SIMELIOVICH BIRMAN', 1, 0),
	(20, 'd308432', 'TEC', 'PEDRO LUIZ F. FONSECA', 1, 0),
	(21, 'd810209', 'TEC', 'RENAN FREITAS DE ARAUJO', 1, 0),
	(22, 'd806075', 'TEC', 'THAYS SANTOS HAMAD', 1, 0),
	(23, 'd854427', 'ADM', 'THIAGO PRADO SILVERO', 1, 0),
	(24, 'd927014', 'ADM', 'Victor Alexander Menezes de Abreu', 1, 1);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
