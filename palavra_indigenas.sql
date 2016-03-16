-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: 16/03/2016 às 14:55
-- Versão do servidor: 5.5.47-0ubuntu0.14.04.1
-- Versão do PHP: 5.5.9-1ubuntu4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de dados: `palavra_indigenas`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `classe_palavra`
--

CREATE TABLE IF NOT EXISTS `classe_palavra` (
  `idClassePalavra` int(11) NOT NULL AUTO_INCREMENT,
  `nomeClassePalavra` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idClassePalavra`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Classe gramatical da palavras\n' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura para tabela `classificacao_palavra`
--

CREATE TABLE IF NOT EXISTS `classificacao_palavra` (
  `idClassificacaoPalavra` int(11) NOT NULL AUTO_INCREMENT,
  `nomeClassificacaoPalavra` varchar(45) NOT NULL,
  PRIMARY KEY (`idClassificacaoPalavra`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura para tabela `lingua`
--

CREATE TABLE IF NOT EXISTS `lingua` (
  `idLingua` int(11) NOT NULL AUTO_INCREMENT,
  `nomeLingua` varchar(50) NOT NULL,
  `obsLingua` text NOT NULL,
  `statusLingua` int(1) NOT NULL,
  PRIMARY KEY (`idLingua`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Fazendo dump de dados para tabela `lingua`
--

INSERT INTO `lingua` (`idLingua`, `nomeLingua`, `obsLingua`, `statusLingua`) VALUES
(1, 'Xakriabá', 'Braço Linguístico do Macrô-Jê', 1),
(3, 'xerente', 'teste de observação', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `logs`
--

CREATE TABLE IF NOT EXISTS `logs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idUsuario` int(11) NOT NULL,
  `hora` datetime NOT NULL,
  `ip` varchar(15) COLLATE latin1_general_ci NOT NULL,
  `mensagem` text COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `hora` (`hora`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=305 ;

--
-- Fazendo dump de dados para tabela `logs`
--

INSERT INTO `logs` (`id`, `idUsuario`, `hora`, `ip`, `mensagem`) VALUES
(1, 1, '2014-11-14 00:35:19', '187.84.19.48', 'Usuário entrou no sistema.'),
(2, 1, '2014-11-14 00:36:12', '187.84.19.48', 'Um novo povo foi inserido.'),
(3, 1, '2014-11-14 00:38:31', '187.84.19.48', 'Uma nova lingua foi inserida.'),
(4, 1, '2014-11-14 00:38:59', '187.84.19.48', 'Uma nova palavra foi inserida no sistema.'),
(5, 1, '2014-11-14 00:39:11', '187.84.19.48', 'Foi inserida uma imagem para a palavra 1.'),
(6, 1, '2014-11-14 00:39:30', '187.84.19.48', 'Foi inserido um som para a palavra .'),
(7, 1, '2014-11-14 00:40:06', '187.84.19.48', 'Uma nova palavra foi inserida no sistema.'),
(8, 1, '2014-11-14 00:40:18', '187.84.19.48', 'Foi inserida uma imagem para a palavra 2.'),
(9, 1, '2014-11-14 00:40:41', '187.84.19.48', 'Foi inserido um som para a palavra .'),
(10, 1, '2014-11-14 00:41:16', '187.84.19.48', 'Uma nova palavra foi inserida no sistema.'),
(11, 1, '2014-11-14 00:41:43', '187.84.19.48', 'Foi inserida uma imagem para a palavra 3.'),
(12, 1, '2014-11-14 00:43:02', '187.84.19.48', 'Uma nova palavra foi inserida no sistema.'),
(13, 1, '2014-11-14 00:43:11', '187.84.19.48', 'Foi inserida uma imagem para a palavra 4.'),
(14, 1, '2014-11-14 00:43:37', '187.84.19.48', 'Foi inserido um som para a palavra .'),
(15, 1, '2014-11-14 00:44:02', '187.84.19.48', 'Uma nova palavra foi inserida no sistema.'),
(16, 1, '2014-11-14 00:44:28', '187.84.19.48', 'Foi inserida uma imagem para a palavra 5.'),
(17, 1, '2014-11-14 00:44:51', '187.84.19.48', 'Foi inserido um som para a palavra .'),
(18, 1, '2014-11-14 00:45:17', '187.84.19.48', 'Uma nova palavra foi inserida no sistema.'),
(19, 1, '2014-11-14 00:45:37', '187.84.19.48', 'Foi inserida uma imagem para a palavra 6.'),
(20, 1, '2014-11-14 00:45:56', '187.84.19.48', 'Foi inserido um som para a palavra .'),
(21, 1, '2014-11-14 00:46:31', '187.84.19.48', 'Uma nova palavra foi inserida no sistema.'),
(22, 1, '2014-11-14 00:46:56', '187.84.19.48', 'Foi inserida uma imagem para a palavra 7.'),
(23, 1, '2014-11-14 00:47:16', '187.84.19.48', 'Foi inserido um som para a palavra .'),
(24, 1, '2014-11-14 00:48:43', '187.84.19.48', 'Foi inserido um som para a palavra .'),
(25, 1, '2014-11-14 00:49:24', '187.84.19.48', 'Usuário saiu do sistema.'),
(26, 1, '2014-11-14 21:38:03', '177.185.87.40', 'Usuário entrou no sistema.'),
(27, 1, '2014-11-14 21:38:59', '177.185.87.40', 'Uma nova palavra foi inserida no sistema.'),
(28, 1, '2014-11-14 21:39:40', '177.185.87.40', 'Foi inserida uma imagem para a palavra 8.'),
(29, 1, '2014-11-14 21:39:55', '177.185.87.40', 'Foi inserido um som para a palavra 8.'),
(30, 1, '2014-11-14 21:40:25', '177.185.87.40', 'Uma nova palavra foi inserida no sistema.'),
(31, 1, '2014-11-14 21:40:43', '177.185.87.40', 'Foi inserida uma imagem para a palavra 9.'),
(32, 1, '2014-11-14 21:40:59', '177.185.87.40', 'Foi inserido um som para a palavra 9.'),
(33, 1, '2014-11-14 21:41:32', '177.185.87.40', 'Uma nova palavra foi inserida no sistema.'),
(34, 1, '2014-11-14 21:42:50', '177.185.87.40', 'Foi inserida uma imagem para a palavra 10.'),
(35, 1, '2014-11-14 21:43:01', '177.185.87.40', 'Foi inserido um som para a palavra 10.'),
(36, 1, '2014-11-14 21:43:29', '177.185.87.40', 'Uma nova palavra foi inserida no sistema.'),
(37, 1, '2014-11-14 21:44:12', '177.185.87.40', 'Foi inserida uma imagem para a palavra 11.'),
(38, 1, '2014-11-14 21:44:29', '177.185.87.40', 'Foi inserido um som para a palavra 11.'),
(39, 1, '2014-11-14 21:44:58', '177.185.87.40', 'Uma nova palavra foi inserida no sistema.'),
(40, 1, '2014-11-14 21:45:09', '177.185.87.40', 'Foi inserida uma imagem para a palavra 12.'),
(41, 1, '2014-11-14 21:45:23', '177.185.87.40', 'Foi inserido um som para a palavra 12.'),
(42, 1, '2014-11-14 21:46:41', '177.185.87.40', 'Uma nova palavra foi inserida no sistema.'),
(43, 1, '2014-11-14 21:46:56', '177.185.87.40', 'Foi inserida uma imagem para a palavra 13.'),
(44, 1, '2014-11-14 21:47:24', '177.185.87.40', 'Foi inserido um som para a palavra 13.'),
(45, 1, '2014-11-14 21:47:58', '177.185.87.40', 'Uma nova palavra foi inserida no sistema.'),
(46, 1, '2014-11-14 21:48:21', '177.185.87.40', 'Foi inserida uma imagem para a palavra 14.'),
(47, 1, '2014-11-14 21:48:33', '177.185.87.40', 'Foi inserido um som para a palavra 14.'),
(48, 1, '2014-11-14 21:49:31', '177.185.87.40', 'Uma nova palavra foi inserida no sistema.'),
(49, 1, '2014-11-14 21:49:56', '177.185.87.40', 'Foi inserida uma imagem para a palavra 15.'),
(50, 1, '2014-11-14 21:50:15', '177.185.87.40', 'Foi inserido um som para a palavra 15.'),
(51, 1, '2014-11-14 21:50:50', '177.185.87.40', 'Uma nova palavra foi inserida no sistema.'),
(52, 1, '2014-11-14 21:51:01', '177.185.87.40', 'Foi inserida uma imagem para a palavra 16.'),
(53, 1, '2014-11-14 21:51:17', '177.185.87.40', 'Foi inserido um som para a palavra 16.'),
(54, 1, '2014-11-14 21:51:40', '177.185.87.40', 'Uma nova palavra foi inserida no sistema.'),
(55, 1, '2014-11-14 21:51:54', '177.185.87.40', 'Foi inserida uma imagem para a palavra 17.'),
(56, 1, '2014-11-14 21:52:28', '177.185.87.40', 'Foi inserido um som para a palavra 17.'),
(57, 1, '2014-11-14 21:52:53', '177.185.87.40', 'Uma nova palavra foi inserida no sistema.'),
(58, 1, '2014-11-14 21:53:22', '177.185.87.40', 'Foi inserida uma imagem para a palavra 18.'),
(59, 1, '2014-11-14 21:53:41', '177.185.87.40', 'Foi inserido um som para a palavra 18.'),
(60, 1, '2014-11-14 21:54:15', '177.185.87.40', 'Uma nova palavra foi inserida no sistema.'),
(61, 1, '2014-11-14 21:54:27', '177.185.87.40', 'Foi inserida uma imagem para a palavra 19.'),
(62, 1, '2014-11-14 21:54:48', '177.185.87.40', 'Foi inserido um som para a palavra 19.'),
(63, 1, '2014-11-14 21:55:11', '177.185.87.40', 'Uma nova palavra foi inserida no sistema.'),
(64, 1, '2014-11-14 21:55:22', '177.185.87.40', 'Foi inserida uma imagem para a palavra 20.'),
(65, 1, '2014-11-14 21:55:40', '177.185.87.40', 'Foi inserido um som para a palavra 20.'),
(66, 1, '2014-11-14 21:56:07', '177.185.87.40', 'Uma nova palavra foi inserida no sistema.'),
(67, 1, '2014-11-14 21:56:16', '177.185.87.40', 'Foi inserida uma imagem para a palavra 21.'),
(68, 1, '2014-11-14 21:56:32', '177.185.87.40', 'Foi inserido um som para a palavra 21.'),
(69, 1, '2014-11-14 21:56:55', '177.185.87.40', 'Uma nova palavra foi inserida no sistema.'),
(70, 1, '2014-11-14 21:57:05', '177.185.87.40', 'Foi inserida uma imagem para a palavra 22.'),
(71, 1, '2014-11-14 21:57:25', '177.185.87.40', 'Foi inserido um som para a palavra 22.'),
(72, 1, '2014-11-14 21:57:57', '177.185.87.40', 'Uma nova palavra foi inserida no sistema.'),
(73, 1, '2014-11-14 21:58:07', '177.185.87.40', 'Foi inserida uma imagem para a palavra 23.'),
(74, 1, '2014-11-14 21:58:34', '177.185.87.40', 'Foi inserido um som para a palavra 23.'),
(75, 1, '2014-11-14 21:59:10', '177.185.87.40', 'Uma nova palavra foi inserida no sistema.'),
(76, 1, '2014-11-14 21:59:19', '177.185.87.40', 'Foi inserida uma imagem para a palavra 24.'),
(77, 1, '2014-11-14 21:59:32', '177.185.87.40', 'Foi inserido um som para a palavra 24.'),
(78, 1, '2014-11-14 22:00:01', '177.185.87.40', 'Uma nova palavra foi inserida no sistema.'),
(79, 1, '2014-11-14 22:00:14', '177.185.87.40', 'Foi inserida uma imagem para a palavra 25.'),
(80, 1, '2014-11-14 22:00:33', '177.185.87.40', 'Foi inserido um som para a palavra 25.'),
(81, 1, '2014-11-14 22:01:10', '177.185.87.40', 'Uma nova palavra foi inserida no sistema.'),
(82, 1, '2014-11-14 22:01:20', '177.185.87.40', 'Foi inserida uma imagem para a palavra 26.'),
(83, 1, '2014-11-14 22:01:36', '177.185.87.40', 'Foi inserido um som para a palavra 26.'),
(84, 1, '2014-11-14 22:02:04', '177.185.87.40', 'Uma nova palavra foi inserida no sistema.'),
(85, 1, '2014-11-14 22:02:16', '177.185.87.40', 'Foi inserida uma imagem para a palavra 27.'),
(86, 1, '2014-11-14 22:02:29', '177.185.87.40', 'Foi inserido um som para a palavra 27.'),
(87, 1, '2014-11-14 22:03:02', '177.185.87.40', 'Uma nova palavra foi inserida no sistema.'),
(88, 1, '2014-11-14 22:03:16', '177.185.87.40', 'Foi inserida uma imagem para a palavra 28.'),
(89, 1, '2014-11-14 22:03:28', '177.185.87.40', 'Foi inserido um som para a palavra 28.'),
(90, 1, '2014-11-14 22:03:52', '177.185.87.40', 'Uma nova palavra foi inserida no sistema.'),
(91, 1, '2014-11-14 22:04:12', '177.185.87.40', 'Uma nova palavra foi inserida no sistema.'),
(92, 1, '2014-11-14 22:04:25', '177.185.87.40', 'Foi inserida uma imagem para a palavra 30.'),
(93, 1, '2014-11-14 22:04:37', '177.185.87.40', 'Foi inserido um som para a palavra 30.'),
(94, 1, '2014-11-14 22:05:05', '177.185.87.40', 'Uma nova palavra foi inserida no sistema.'),
(95, 1, '2014-11-14 22:05:15', '177.185.87.40', 'Foi inserida uma imagem para a palavra 31.'),
(96, 1, '2014-11-14 22:05:28', '177.185.87.40', 'Foi inserido um som para a palavra 31.'),
(97, 1, '2014-11-14 22:05:57', '177.185.87.40', 'Uma nova palavra foi inserida no sistema.'),
(98, 1, '2014-11-14 22:06:06', '177.185.87.40', 'Foi inserida uma imagem para a palavra 32.'),
(99, 1, '2014-11-14 22:06:20', '177.185.87.40', 'Foi inserido um som para a palavra 32.'),
(100, 1, '2014-11-14 22:06:44', '177.185.87.40', 'Uma nova palavra foi inserida no sistema.'),
(101, 1, '2014-11-14 22:06:52', '177.185.87.40', 'Foi inserida uma imagem para a palavra 33.'),
(102, 1, '2014-11-14 22:07:09', '177.185.87.40', 'Foi inserido um som para a palavra 33.'),
(103, 1, '2014-11-14 22:07:33', '177.185.87.40', 'Uma nova palavra foi inserida no sistema.'),
(104, 1, '2014-11-14 22:07:42', '177.185.87.40', 'Foi inserida uma imagem para a palavra 34.'),
(105, 1, '2014-11-14 22:07:59', '177.185.87.40', 'Foi inserido um som para a palavra 34.'),
(106, 1, '2014-11-14 22:08:28', '177.185.87.40', 'Uma nova palavra foi inserida no sistema.'),
(107, 1, '2014-11-14 22:09:26', '177.185.87.40', 'Uma nova palavra foi inserida no sistema.'),
(108, 1, '2014-11-14 22:10:03', '177.185.87.40', 'Uma nova palavra foi inserida no sistema.'),
(109, 1, '2014-11-14 22:10:52', '177.185.87.40', 'A palavra 14 foi alterada.'),
(110, 1, '2014-11-14 22:12:00', '177.185.87.40', 'Usuário saiu do sistema.'),
(111, 1, '2014-11-14 22:19:52', '177.185.87.40', 'Usuário entrou no sistema.'),
(112, 1, '2014-11-14 22:20:55', '177.185.87.40', 'O Colaborador 2 foi habilitado.'),
(113, 1, '2014-11-14 22:20:58', '177.185.87.40', 'O moderador 2 foi habilitado.'),
(114, 1, '2014-11-14 22:32:32', '177.185.87.40', 'Usuário saiu do sistema.'),
(115, 2, '2014-11-14 22:33:06', '177.185.87.40', 'Usuário entrou no sistema.'),
(116, 2, '2014-11-14 22:33:09', '177.185.87.40', 'Usuário saiu do sistema.'),
(117, 2, '2014-11-14 22:35:16', '177.185.87.40', 'Usuário entrou no sistema.'),
(118, 2, '2014-11-14 22:35:31', '177.185.87.40', 'Usuário alterou a senha.'),
(119, 2, '2014-11-14 22:36:43', '177.185.87.40', 'Uma nova lingua foi inserida.'),
(120, 2, '2014-11-14 22:37:02', '177.185.87.40', 'Um novo povo foi inserido.'),
(121, 2, '2014-11-14 22:37:26', '177.185.87.40', 'Uma nova palavra foi inserida no sistema.'),
(122, 2, '2014-11-14 22:37:42', '177.185.87.40', 'Foi inserida uma imagem para a palavra 38.'),
(123, 2, '2014-11-14 22:37:57', '177.185.87.40', 'Foi inserido um som para a palavra 38.'),
(124, 2, '2014-11-14 22:39:45', '177.185.87.40', 'Uma nova palavra foi inserida no sistema.'),
(125, 2, '2014-11-14 22:39:56', '177.185.87.40', 'Foi inserida uma imagem para a palavra 39.'),
(126, 2, '2014-11-14 22:40:24', '177.185.87.40', 'Foi inserido um som para a palavra 39.'),
(127, 2, '2014-11-14 22:44:47', '177.185.87.40', 'Uma nova palavra foi inserida no sistema.'),
(128, 2, '2014-11-14 22:45:09', '177.185.87.40', 'Uma nova palavra foi inserida no sistema.'),
(129, 2, '2014-11-14 22:45:31', '177.185.87.40', 'Uma nova palavra foi inserida no sistema.'),
(130, 2, '2014-11-14 22:45:56', '177.185.87.40', 'Uma nova palavra foi inserida no sistema.'),
(131, 2, '2014-11-14 22:46:09', '177.185.87.40', 'Foi inserida uma imagem para a palavra 43.'),
(132, 2, '2014-11-14 22:46:23', '177.185.87.40', 'Foi inserido um som para a palavra 43.'),
(133, 2, '2014-11-14 22:47:02', '177.185.87.40', 'Uma nova palavra foi inserida no sistema.'),
(134, 2, '2014-11-14 22:47:18', '177.185.87.40', 'Foi inserida uma imagem para a palavra 44.'),
(135, 2, '2014-11-14 22:49:13', '177.185.87.40', 'Foi inserido um som para a palavra 44.'),
(136, 2, '2014-11-14 22:49:42', '177.185.87.40', 'Uma nova palavra foi inserida no sistema.'),
(137, 2, '2014-11-14 22:49:55', '177.185.87.40', 'Foi inserida uma imagem para a palavra 45.'),
(138, 2, '2014-11-14 22:50:07', '177.185.87.40', 'Foi inserido um som para a palavra 45.'),
(139, 2, '2014-11-14 22:50:37', '177.185.87.40', 'Uma nova palavra foi inserida no sistema.'),
(140, 2, '2014-11-14 22:50:57', '177.185.87.40', 'Uma nova palavra foi inserida no sistema.'),
(141, 2, '2014-11-14 22:51:09', '177.185.87.40', 'Foi inserida uma imagem para a palavra 47.'),
(142, 2, '2014-11-14 22:51:20', '177.185.87.40', 'Foi inserido um som para a palavra 47.'),
(143, 2, '2014-11-14 22:51:53', '177.185.87.40', 'Uma nova palavra foi inserida no sistema.'),
(144, 2, '2014-11-14 22:52:03', '177.185.87.40', 'Foi inserida uma imagem para a palavra 48.'),
(145, 2, '2014-11-14 22:52:20', '177.185.87.40', 'Foi inserido um som para a palavra 48.'),
(146, 2, '2014-11-14 22:53:03', '177.185.87.40', 'Uma nova palavra foi inserida no sistema.'),
(147, 2, '2014-11-14 22:53:11', '177.185.87.40', 'Foi inserida uma imagem para a palavra 49.'),
(148, 2, '2014-11-14 22:53:25', '177.185.87.40', 'Foi inserido um som para a palavra 49.'),
(149, 2, '2014-11-14 22:53:34', '177.185.87.40', 'Usuário saiu do sistema.'),
(150, 1, '2014-11-14 22:53:58', '177.185.87.40', 'Usuário entrou no sistema.'),
(151, 1, '2014-11-14 22:54:03', '177.185.87.40', 'A palavra 5 foi excluída.'),
(152, 1, '2014-11-14 22:54:07', '177.185.87.40', 'Usuário saiu do sistema.'),
(153, 1, '2014-11-14 22:59:47', '177.185.87.40', 'Usuário entrou no sistema.'),
(154, 1, '2014-11-14 22:59:50', '177.185.87.40', 'Usuário saiu do sistema.'),
(155, 2, '2014-11-14 22:59:59', '177.185.87.40', 'Usuário entrou no sistema.'),
(156, 2, '2014-11-14 23:00:07', '177.185.87.40', 'O Colaborador 3 foi habilitado.'),
(157, 2, '2014-11-14 23:00:12', '177.185.87.40', 'Usuário saiu do sistema.'),
(158, 3, '2014-11-14 23:02:08', '177.185.87.40', 'Usuário entrou no sistema.'),
(159, 3, '2014-11-14 23:02:19', '177.185.87.40', 'Usuário saiu do sistema.'),
(160, 3, '2014-11-14 23:14:01', '177.185.87.40', 'Usuário entrou no sistema.'),
(161, 3, '2014-11-14 23:14:36', '177.185.87.40', 'Usuário alterou os dados.'),
(162, 3, '2014-11-14 23:14:58', '177.185.87.40', 'Usuário alterou a senha.'),
(163, 3, '2014-11-14 23:20:45', '177.185.87.40', 'Uma nova palavra foi inserida no sistema.'),
(164, 3, '2014-11-14 23:20:55', '177.185.87.40', 'Foi inserida uma imagem para a palavra 50.'),
(165, 3, '2014-11-14 23:21:06', '177.185.87.40', 'Foi inserido um som para a palavra 50.'),
(166, 3, '2014-11-14 23:21:28', '177.185.87.40', 'Uma nova palavra foi inserida no sistema.'),
(167, 3, '2014-11-14 23:21:37', '177.185.87.40', 'Foi inserida uma imagem para a palavra 51.'),
(168, 3, '2014-11-14 23:21:47', '177.185.87.40', 'Foi inserido um som para a palavra 51.'),
(169, 3, '2014-11-14 23:22:12', '177.185.87.40', 'Uma nova palavra foi inserida no sistema.'),
(170, 3, '2014-11-14 23:22:44', '177.185.87.40', 'Uma nova palavra foi inserida no sistema.'),
(171, 3, '2014-11-14 23:23:11', '177.185.87.40', 'Uma nova palavra foi inserida no sistema.'),
(172, 3, '2014-11-14 23:23:38', '177.185.87.40', 'Uma nova palavra foi inserida no sistema.'),
(173, 3, '2014-11-14 23:23:51', '177.185.87.40', 'Foi inserida uma imagem para a palavra 55.'),
(174, 3, '2014-11-14 23:24:02', '177.185.87.40', 'Foi inserido um som para a palavra 55.'),
(175, 3, '2014-11-14 23:24:35', '177.185.87.40', 'Uma nova palavra foi inserida no sistema.'),
(176, 3, '2014-11-14 23:24:43', '177.185.87.40', 'Foi inserida uma imagem para a palavra 56.'),
(177, 3, '2014-11-14 23:25:02', '177.185.87.40', 'Foi inserido um som para a palavra 56.'),
(178, 3, '2014-11-14 23:25:31', '177.185.87.40', 'Uma nova palavra foi inserida no sistema.'),
(179, 3, '2014-11-14 23:25:45', '177.185.87.40', 'Foi inserida uma imagem para a palavra 57.'),
(180, 3, '2014-11-14 23:26:12', '177.185.87.40', 'Foi inserido um som para a palavra 57.'),
(181, 3, '2014-11-14 23:29:46', '177.185.87.40', 'Usuário saiu do sistema.'),
(182, 1, '2014-11-14 23:46:56', '177.185.87.40', 'Usuário entrou no sistema.'),
(183, 1, '2014-11-14 23:47:01', '177.185.87.40', 'A palavra 52 foi excluída.'),
(184, 1, '2014-11-14 23:47:23', '177.185.87.40', 'A palavra 29 foi excluída.'),
(185, 1, '2014-11-14 23:47:54', '177.185.87.40', 'Usuário saiu do sistema.'),
(186, 1, '2014-11-15 16:21:48', '177.185.87.40', 'Usuário entrou no sistema.'),
(187, 1, '2014-11-15 16:21:55', '177.185.87.40', 'Usuário saiu do sistema.'),
(188, 1, '2015-12-26 14:04:30', '127.0.0.1', 'Usuário entrou no sistema.'),
(189, 1, '2015-12-26 14:07:45', '127.0.0.1', 'Usuário saiu do sistema.'),
(190, 3, '2015-12-31 08:36:12', '127.0.0.1', 'Usuário entrou no sistema.'),
(191, 3, '2015-12-31 08:53:57', '127.0.0.1', 'Usuário saiu do sistema.'),
(192, 3, '2015-12-31 08:54:06', '127.0.0.1', 'Usuário entrou no sistema.'),
(193, 3, '2015-12-31 10:52:32', '127.0.0.1', 'Usuário entrou no sistema.'),
(194, 3, '2015-12-31 11:16:01', '127.0.0.1', 'A palavra 51 foi alterada.'),
(195, 3, '2015-12-31 11:19:25', '127.0.0.1', 'Usuário saiu do sistema.'),
(196, 1, '2015-12-31 11:19:38', '127.0.0.1', 'Usuário entrou no sistema.'),
(197, 3, '2015-12-31 14:26:52', '127.0.0.1', 'Usuário entrou no sistema.'),
(198, 3, '2015-12-31 14:47:37', '127.0.0.1', 'Usuário saiu do sistema.'),
(199, 3, '2015-12-31 14:48:56', '127.0.0.1', 'Usuário entrou no sistema.'),
(200, 3, '2015-12-31 14:50:12', '127.0.0.1', 'Usuário saiu do sistema.'),
(201, 1, '2015-12-31 14:50:19', '127.0.0.1', 'Usuário entrou no sistema.'),
(202, 1, '2015-12-31 14:52:26', '127.0.0.1', 'Usuário saiu do sistema.'),
(203, 1, '2015-12-31 14:55:40', '127.0.0.1', 'Usuário entrou no sistema.'),
(204, 1, '2015-12-31 14:55:55', '127.0.0.1', 'Usuário saiu do sistema.'),
(205, 3, '2015-12-31 14:56:03', '127.0.0.1', 'Usuário entrou no sistema.'),
(206, 1, '2016-01-04 19:17:42', '127.0.0.1', 'Usuário entrou no sistema.'),
(207, 1, '2016-01-04 19:25:30', '127.0.0.1', 'Uma nova palavra foi inserida no sistema.'),
(208, 1, '2016-01-04 19:33:16', '127.0.0.1', 'Foi inserida uma imagem para a palavra 60.'),
(209, 1, '2016-01-04 19:39:58', '127.0.0.1', 'Foi inserido um som para a palavra 60.'),
(210, 1, '2016-01-09 13:32:06', '127.0.0.1', 'Usuário entrou no sistema.'),
(211, 1, '2016-01-09 16:14:28', '127.0.0.1', 'Usuário entrou no sistema.'),
(212, 1, '2016-01-09 16:45:38', '127.0.0.1', 'Foi inserida uma imagem para a palavra 27.'),
(213, 1, '2016-01-09 18:04:25', '127.0.0.1', 'Foi inserida uma imagem para a palavra 27.'),
(214, 1, '2016-01-09 18:08:26', '127.0.0.1', 'Foi inserida uma imagem para a palavra 27.'),
(215, 1, '2016-01-09 18:08:39', '127.0.0.1', 'Foi inserida uma imagem para a palavra 27.'),
(216, 1, '2016-01-09 18:08:50', '127.0.0.1', 'Foi inserida uma imagem para a palavra 27.'),
(217, 1, '2016-01-09 18:11:35', '127.0.0.1', 'Foi inserida uma imagem para a palavra 27.'),
(218, 1, '2016-01-09 18:11:42', '127.0.0.1', 'Foi inserida uma imagem para a palavra 27.'),
(219, 1, '2016-01-09 18:46:17', '127.0.0.1', 'Foi inserida uma imagem para a palavra 27.'),
(220, 1, '2016-01-09 18:47:54', '127.0.0.1', 'Foi inserida uma imagem para a palavra 27.'),
(221, 1, '2016-01-09 18:51:28', '127.0.0.1', 'Foi inserida uma imagem para a palavra 27.'),
(222, 1, '2016-01-09 18:52:45', '127.0.0.1', 'Foi inserida uma imagem para a palavra 27.'),
(223, 1, '2016-01-09 19:07:26', '127.0.0.1', 'Foi inserida uma imagem para a palavra 27.'),
(224, 1, '2016-01-09 19:09:12', '127.0.0.1', 'Foi inserida uma imagem para a palavra 27.'),
(225, 1, '2016-01-09 20:14:05', '127.0.0.1', 'Usuário entrou no sistema.'),
(226, 1, '2016-01-09 20:14:14', '127.0.0.1', 'Foi inserida uma imagem para a palavra 51.'),
(227, 1, '2016-01-09 20:14:55', '127.0.0.1', 'Foi inserida uma imagem para a palavra 51.'),
(228, 1, '2016-01-09 20:15:43', '127.0.0.1', 'Foi inserida uma imagem para a palavra 51.'),
(229, 1, '2016-01-09 20:16:20', '127.0.0.1', 'Foi inserida uma imagem para a palavra 51.'),
(230, 1, '2016-01-09 20:24:19', '127.0.0.1', 'Foi inserida uma imagem para a palavra 32.'),
(231, 1, '2016-01-11 08:33:58', '127.0.0.1', 'Usuário entrou no sistema.'),
(232, 1, '2016-01-11 09:15:22', '127.0.0.1', 'Foi inserida uma imagem para a palavra 27.'),
(233, 1, '2016-01-11 09:26:39', '127.0.0.1', 'Foi inserido um som para a palavra 27.'),
(234, 1, '2016-01-11 10:49:21', '127.0.0.1', 'Usuário entrou no sistema.'),
(235, 1, '2016-01-11 10:57:57', '127.0.0.1', 'A palavra 27 foi alterada.'),
(236, 1, '2016-01-11 11:40:02', '127.0.0.1', 'A palavra 27 foi alterada.'),
(237, 1, '2016-01-11 11:52:44', '127.0.0.1', 'A palavra 27 foi alterada.'),
(238, 1, '2016-01-11 11:53:09', '127.0.0.1', 'A palavra 27 foi alterada.'),
(239, 1, '2016-01-11 11:54:04', '127.0.0.1', 'A palavra 27 foi alterada.'),
(240, 1, '2016-01-11 11:55:43', '127.0.0.1', 'A palavra 27 foi alterada.'),
(241, 1, '2016-01-11 11:57:24', '127.0.0.1', 'A palavra 27 foi alterada.'),
(242, 1, '2016-01-11 13:00:02', '127.0.0.1', 'Usuário entrou no sistema.'),
(243, 1, '2016-01-11 13:00:25', '127.0.0.1', 'Uma nova palavra foi inserida no sistema.'),
(244, 1, '2016-01-11 13:01:46', '127.0.0.1', 'Foi inserido um som para a palavra 61.'),
(245, 1, '2016-01-11 13:02:28', '127.0.0.1', 'A palavra 61 foi excluída.'),
(246, 1, '2016-01-11 13:07:54', '127.0.0.1', 'Foi inserida uma imagem para a palavra 27.'),
(247, 1, '2016-01-11 13:22:46', '127.0.0.1', 'Foi inserida uma imagem para a palavra 27.'),
(248, 1, '2016-01-11 13:27:28', '127.0.0.1', 'Foi inserida uma imagem para a palavra 27.'),
(249, 1, '2016-01-11 13:29:13', '127.0.0.1', 'Foi inserida uma imagem para a palavra 27.'),
(250, 1, '2016-01-11 13:29:46', '127.0.0.1', 'Foi inserida uma imagem para a palavra 27.'),
(251, 1, '2016-01-11 13:49:44', '127.0.0.1', 'Foi inserido um som para a palavra 27.'),
(252, 1, '2016-01-11 13:55:56', '127.0.0.1', 'Foi inserido um som para a palavra 27.'),
(253, 1, '2016-01-11 13:56:07', '127.0.0.1', 'Foi inserido um som para a palavra 27.'),
(254, 1, '2016-01-11 14:02:27', '127.0.0.1', 'Uma nova palavra foi inserida no sistema.'),
(255, 1, '2016-01-11 14:05:31', '127.0.0.1', 'Foi inserida uma imagem para a palavra 62.'),
(256, 1, '2016-01-11 14:06:33', '127.0.0.1', 'A palavra 62 foi excluída.'),
(257, 1, '2016-01-11 14:06:52', '127.0.0.1', 'Uma nova palavra foi inserida no sistema.'),
(258, 1, '2016-01-11 14:07:01', '127.0.0.1', 'Foi inserida uma imagem para a palavra 63.'),
(259, 1, '2016-01-11 14:07:47', '127.0.0.1', 'Foi inserido um som para a palavra 63.'),
(260, 1, '2016-01-11 19:34:41', '127.0.0.1', 'Usuário entrou no sistema.'),
(261, 1, '2016-01-11 19:36:28', '127.0.0.1', 'Uma nova palavra foi inserida no sistema.'),
(262, 1, '2016-01-11 19:37:39', '127.0.0.1', 'Foi inserida uma imagem para a palavra 64.'),
(263, 1, '2016-01-11 19:38:32', '127.0.0.1', 'Foi inserido um som para a palavra 64.'),
(264, 1, '2016-01-11 20:02:41', '127.0.0.1', 'Usuário saiu do sistema.'),
(265, 1, '2016-01-22 19:55:02', '127.0.0.1', 'Usuário entrou no sistema.'),
(266, 1, '2016-01-25 10:03:06', '127.0.0.1', 'Usuário entrou no sistema.'),
(267, 1, '2016-01-25 10:03:13', '127.0.0.1', 'Usuário saiu do sistema.'),
(268, 3, '2016-01-25 10:06:18', '127.0.0.1', 'Usuário entrou no sistema.'),
(269, 3, '2016-01-25 10:06:35', '127.0.0.1', 'Usuário saiu do sistema.'),
(270, 3, '2016-01-25 10:07:53', '127.0.0.1', 'Usuário entrou no sistema.'),
(271, 3, '2016-01-25 10:08:59', '127.0.0.1', 'Usuário saiu do sistema.'),
(272, 3, '2016-01-25 10:10:59', '127.0.0.1', 'Usuário entrou no sistema.'),
(273, 3, '2016-01-25 10:12:10', '127.0.0.1', 'Foi inserida uma imagem para a palavra 51.'),
(274, 1, '2016-01-25 10:17:15', '127.0.0.1', 'Usuário entrou no sistema.'),
(275, 3, '2016-01-25 10:37:21', '127.0.0.1', 'Uma nova palavra foi inserida no sistema.'),
(276, 3, '2016-01-25 10:47:32', '127.0.0.1', 'A palavra 66 foi alterada.'),
(277, 3, '2016-01-25 14:47:52', '127.0.0.1', 'Usuário entrou no sistema.'),
(278, 3, '2016-01-25 14:48:14', '127.0.0.1', 'A palavra 66 foi alterada.'),
(279, 3, '2016-01-25 14:48:27', '127.0.0.1', 'A palavra 66 foi excluída.'),
(280, 3, '2016-01-25 15:13:27', '127.0.0.1', 'Usuário saiu do sistema.'),
(281, 3, '2016-01-25 15:26:35', '127.0.0.1', 'Usuário entrou no sistema.'),
(282, 1, '2016-01-26 12:18:59', '127.0.0.1', 'Usuário entrou no sistema.'),
(283, 1, '2016-01-26 12:21:02', '127.0.0.1', 'Usuário saiu do sistema.'),
(284, 3, '2016-01-26 12:23:32', '127.0.0.1', 'Usuário entrou no sistema.'),
(285, 1, '2016-01-27 14:55:36', '127.0.0.1', 'Usuário entrou no sistema.'),
(286, 1, '2016-01-27 15:02:59', '127.0.0.1', 'Usuário saiu do sistema.'),
(287, 3, '2016-01-27 15:03:08', '127.0.0.1', 'Usuário entrou no sistema.'),
(288, 1, '2016-02-03 09:37:19', '127.0.0.1', 'Usuário entrou no sistema.'),
(289, 1, '2016-02-03 09:45:28', '127.0.0.1', 'Usuário saiu do sistema.'),
(290, 3, '2016-02-03 09:45:38', '127.0.0.1', 'Usuário entrou no sistema.'),
(291, 1, '2016-02-03 10:40:29', '127.0.0.1', 'Usuário entrou no sistema.'),
(292, 1, '2016-02-03 10:40:50', '127.0.0.1', 'Usuário saiu do sistema.'),
(293, 3, '2016-02-03 10:41:03', '127.0.0.1', 'Usuário entrou no sistema.'),
(294, 3, '2016-02-04 20:49:42', '127.0.0.1', 'Usuário entrou no sistema.'),
(295, 3, '2016-02-04 20:53:48', '127.0.0.1', 'A palavra 51 foi excluída.'),
(296, 3, '2016-02-12 15:27:33', '127.0.0.1', 'Usuário entrou no sistema.'),
(297, 3, '2016-02-12 15:35:06', '127.0.0.1', 'Usuário saiu do sistema.'),
(298, 1, '2016-02-12 15:35:15', '127.0.0.1', 'Usuário entrou no sistema.'),
(299, 1, '2016-02-12 16:07:26', '127.0.0.1', 'Usuário saiu do sistema.'),
(300, 3, '2016-02-12 16:07:39', '127.0.0.1', 'Usuário entrou no sistema.'),
(301, 3, '2016-02-12 20:42:19', '127.0.0.1', 'Usuário entrou no sistema.'),
(302, 3, '2016-02-12 20:46:03', '127.0.0.1', 'Usuário saiu do sistema.'),
(303, 1, '2016-02-12 20:46:12', '127.0.0.1', 'Usuário entrou no sistema.'),
(304, 1, '2016-02-24 17:41:52', '127.0.0.1', 'Usuário entrou no sistema.');

-- --------------------------------------------------------

--
-- Estrutura para tabela `palavra`
--

CREATE TABLE IF NOT EXISTS `palavra` (
  `idPalavra` int(11) NOT NULL AUTO_INCREMENT,
  `palavraPortugues` varchar(50) NOT NULL,
  `palavraIndigina` varchar(50) NOT NULL,
  `obsPalavra` text,
  `imagemPalavra` varchar(50) NOT NULL,
  `somPalavra` varchar(50) NOT NULL,
  `idLingua` int(11) NOT NULL,
  `idPovo` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  PRIMARY KEY (`idPalavra`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=68 ;

--
-- Fazendo dump de dados para tabela `palavra`
--

INSERT INTO `palavra` (`idPalavra`, `palavraPortugues`, `palavraIndigina`, `obsPalavra`, `imagemPalavra`, `somPalavra`, `idLingua`, `idPovo`, `idUsuario`) VALUES
(1, 'sol', 'stacró', '', 'd215c428ea6d99046c8cd7d4d3bee4a2.jpg', 'f1ee92d29f8e22e8a3b03436e7a7e117.mp3', 1, 2, 1),
(2, 'lua', 'ua', '', 'img_eda45e02f83b173f7e3a8945a46ecbdf.png', 'som_caac5493e4f61bb6769bbaf54a39fb43.mp3', 1, 1, 1),
(3, 'estrelas', 'uaítemuri', '', 'img_d86344149bae8b2a256b448413c2eae4.png', '', 1, 1, 1),
(4, 'terra', 'tica', '', 'img_47d757abbd9e75fd8e7b5bf10e1ecc6d.png', 'som_0162e54060a7e8720718eeea7afc8534.mp3', 1, 1, 1),
(6, 'homem', 'ambá', '', 'img_a78f562b5176fed67f9b987d2e759668.png', 'som_9116158bc13e180ff8c161c87fc4244e.mp3', 1, 1, 1),
(7, 'mulher', 'picon', '', 'img_6b8c84558b4948a8a5a06e454d6972ae.png', 'som_b8b5593ca55318b749abdf6aa3e362e8.mp3', 1, 1, 1),
(8, 'criança', 'aícuté', '', 'img_b84060d706115fd6477c02020e88478d.png', 'som_8155d5877af9bcd8f1edd2623adc5a73.mp3', 1, 1, 1),
(9, 'moça', 'debá', '', 'img_f4dc542b9d665f573af4f6f905dbdcba.png', 'som_99829cc4dd60675158bcf2319e1e4872.mp3', 1, 1, 1),
(10, 'rapaz', 'aímaman', '', 'img_663f53cf109554a3a5c2c5cccf8338d4.png', 'som_9aa787445b507fccee940011b07d1966.mp3', 1, 1, 1),
(11, 'homem branco', 'oradjoíca', '', 'img_54dadec431e8c8171a4222a930e3cfa9.png', 'som_f9b6e3ee64ab1622de0e73f092633fbd.mp3', 1, 1, 1),
(12, 'negro', 'oradjura', '', 'img_f0c52962c53e91c2600e70c59cba3eba.png', 'som_8296d76f5f3b71437a8de5f9bc4e35d0.mp3', 1, 1, 1),
(13, 'índio', 'oípredé', 'também pode ser usado a palavra ambá = homem para se referir a índio', 'img_ebfd248f286aafe11246ec5c64fbb421.png', 'som_88abe840a7397ee015cfa70c9200bddc.mp3', 1, 1, 1),
(14, 'cabeça', 'dacran', '(O an final, nessa palavra e nas outras, tem um som surdo, intermediário entre o a e o an francês.)', 'img_507236715b641031b4459f44e052612a.png', 'som_23518caade46dff0f091d977900a429b.mp3', 1, 1, 1),
(15, 'cabelos', 'dajahi', '', 'img_39de4b49ff5af1ac5f803544fbcd57e9.png', 'som_23449efc9ab192e8a36adf811a5786f4.mp3', 1, 1, 1),
(16, 'olhos', 'datoman', '', 'img_80e4423f9db06c393ec22d4679afc02b.png', 'som_4c55a9e17dccfa21a292086341fa3415.mp3', 1, 1, 1),
(17, 'nariz', 'dascri', '', 'img_d5034ade81a21cd513ad0686828e0ed2.png', 'som_d19d6f7ca7c14f90d2192dd4e9ef627f.mp3', 1, 1, 1),
(18, 'boca', 'daídaua', '', 'img_676751911714b4134d8ec71d231f1d8a.png', 'som_28d613cae3ccd0e7e7f305e99b414dfc.mp3', 1, 1, 1),
(19, 'orelhas', 'daípocri', '', 'img_874a139273a0b0be10bd5917ed11dbb8.png', 'som_802cfb8536762596f4b24ab59617a71f.mp3', 1, 1, 1),
(20, 'peito', 'daputu', '', 'img_aff6d1bdcc9a522f1017bcd205ddcf30.png', 'som_34f9cb73218882ec8860e8d6baa0d744.mp3', 1, 1, 1),
(21, 'ventre', 'dadu', '', 'img_3d87534f3fe1a8c7f6a684a3c5d82465.png', 'som_d3322da742b639055b65771d65428f55.mp3', 1, 1, 1),
(22, 'braço', 'dapá', '', 'img_da9ecf2e384bcf734c31e74a2441f442.png', 'som_f6d12c83ed074871aaaee5e841a32dac.mp3', 1, 1, 1),
(23, 'pé', 'daprá', '', 'img_82674d3e817002887503c1356a05d8b4.png', 'som_f7f2bc48315cb92ee8aa28ac0c5c25df.mp3', 1, 1, 1),
(24, 'mãos', 'dajipcra', '', 'img_7822c7e3d24d56af6efe9556a4c0a6f9.png', 'som_e72873a514e844457f8cfd6a43b6a319.mp3', 1, 1, 1),
(25, 'cavalo', 'soujari', '', 'img_65d7e8ef22b27d4b4a9f6f166ecd9e7b.png', 'som_ab1989611d55948a8053188ce0c3126d.mp3', 1, 1, 1),
(26, 'veado', 'pó', '(O o muito aberto.)', 'img_f96c157e6cc7914d2b3babb0f56aaf7d.png', 'som_261e934196ee0463011548c3060aa5bc.mp3', 1, 1, 1),
(27, 'anta teste', 'cutó', '(O o bastante gutural.)', 'img_2c581584434bd1b70c1194762986cdde.jpg', 'som_9583dd622a53ef0a485ae510b01c2e60.mp3', 1, 1, 1),
(28, 'peixe', 'tupe', '', 'img_34cf55d12c579e880ac36d9d681d07c4.png', 'som_ee485e1a87fa96bb544560c7aff30326.mp3', 1, 1, 1),
(30, 'pena', 'sidarpi', '', 'img_1a00bb6df2a955b8a4263c2f380b27b8.png', 'som_17c07093d278db39885b984ef4a02c79.mp3', 1, 1, 1),
(31, 'carne', 'ponnhi', '', 'img_6cb386c2589687b44a226d749e9a9d56.png', 'som_465451d493f2be27d0b775338fe6b379.mp3', 1, 1, 1),
(32, 'árvore', 'odé', '', 'img_4d3208bcc130b255b8fb8d782ed4ec7a.jpg', 'som_5d43fd77519455e63497b4501c89efa3.mp3', 1, 1, 1),
(33, 'folha', 'deçu', '', 'img_d9aaf0aa222f212b0f9d4b6be610e713.png', 'som_4367e7dfd28e7a32d735cbeb919b8591.mp3', 1, 1, 1),
(34, 'fruto', 'decran', '', 'img_00816a2abbedaa199d1c5a6c07827d36.png', 'som_9802fd77dcdc475ca2d71f0fe3835428.mp3', 1, 1, 1),
(35, 'casca de árvore', 'odéu', '(O e fechado e o eu longo.)', '', '', 1, 1, 1),
(36, 'grande', 'aímoapté', '', '', '', 1, 1, 1),
(37, 'pequeno', 'aícuté', '', '', '', 1, 1, 1),
(38, 'doença', 'rezêqui', '', 'img_b3eb4f0e331bc98c24229877eb3961f7.png', 'som_4709b3e55d8f8247e68150a587792350.mp3', 3, 2, 2),
(39, 'tosse', 'daqueçá', '', 'img_481a925b6a57f93656819bb72a6a0123.png', 'som_9e0fc034c59bd466301e07123b87c5a3.mp3', 3, 2, 2),
(40, 'dor de cabeça', 'cranzêqui', '', '', '', 3, 2, 2),
(41, 'dor torácica', 'soaquetanzêqui', '', '', '', 3, 2, 2),
(42, 'dor abdominal', 'dequezêqui', '', '', '', 3, 2, 2),
(43, 'coração', 'dáceri', '', 'img_497cdc6b8d86904c49c6dc43e4c4768e.png', 'som_2cab60094d54f8e0a79628919cfd897b.mp3', 3, 2, 2),
(44, 'boca', 'dácedaná', '', 'img_90ab83636298857dc5581e954f4924cb.png', 'som_59b69f05d4680cb6d3b0a5fdb0f8e733.mp3', 3, 2, 2),
(45, 'carne', 'tacamonï', '', 'img_b3ef04abea0ddfedf54f543fa2d5ee54.png', 'som_e1949681d361db0837bc4dc80821b0c4.mp3', 3, 2, 2),
(46, 'onça', 'ruquï', '', '', '', 3, 2, 2),
(47, 'cachorro', 'uápecï', '', 'img_880a9e45aa66345e47c9f7188eb34ae3.png', 'som_bca9f72a8e3c3f0a071c1754a40e77a0.mp3', 3, 2, 2),
(48, 'galinha', 'sicá', '', 'img_23c47903dce2f57c9e48dc192493b49a.png', 'som_70db653aa568aabb4602c2f741dc941c.mp3', 3, 2, 2),
(49, 'boi', 'quetedú', '', 'img_b413f4233f3fd5b951ca59ffd682180e.png', 'som_5ef8ce58f03a34f674d674e52b1112fe.mp3', 3, 2, 2),
(50, 'homem branco', 'açoên', '', 'img_ea452ec2c932c1d96eb4ec9f0b2b9d4e.png', 'som_d01347edfd4711ab9d4198e1da0740f0.mp3', 3, 2, 3),
(53, 'fome', 'merandï', '', '', '', 3, 2, 3),
(54, 'sede', 'cubudï', '', '', '', 3, 2, 3),
(55, 'fogo', 'cozê', '', 'img_112a093acfb534d0b2d4b94d7d461df9.png', 'som_90d39a562434c1c79c882f94cf0712eb.mp3', 3, 2, 3),
(56, 'sim', 'inzê', '', 'img_73115ac4d3bd3ff0d2519ad1ee3bd3f7.png', 'som_e216f1b97ef2e13c65522dbe6e2ba309.mp3', 1, 2, 3),
(57, 'não', 'anrê', '', 'img_7094972facca017226206e2ebc6655ef.png', 'som_e36d3aefcb665b57d64ac8ce2376c84f.mp3', 3, 2, 3),
(58, 'teste', 'ak?', '', '', '', 1, 1, 3),
(59, 'teste', 'ak?', '', '', '', 1, 1, 3),
(60, 'Oi', 'Ola', 'teste de cadastro', 'img_2bcc846aae7d26caf0490484ed4a4e06.png', 'som_ed5b7b601b7ddbb88f50f3529fd974d9.mp3', 1, 2, 1),
(63, 'aaaaaaaa', 'bbbbbbbb', 'aaaaaaaaaaa', 'img_37d062d96f10359c1b473633a5bd9b27.png', 'som_112d175d52fdaf261d1367fb33fc64b9.mp3', 1, 2, 1),
(64, 'aaaaaabb', 'bbbbbbbb', '', 'img_774f3790ad8d33fbc851290cea786b00.png', 'som_21a1fdc0d32a8072dbf2261f5423b19c.mp3', 1, 2, 1),
(65, 'alterada', 'ï ?', 'teste', '5223b692bb7225ce8eccd7e5cbef1165.jpg', 'b2e7eb56cca06a476a0c3310d425cf8b.mp3', 3, 2, 1),
(67, 'Teste cadastro', 'indigena', NULL, '', '', 3, 1, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `povo`
--

CREATE TABLE IF NOT EXISTS `povo` (
  `idPovo` int(11) NOT NULL AUTO_INCREMENT,
  `nomePovo` varchar(50) NOT NULL,
  `obsPovo` text NOT NULL,
  `statusPovo` int(1) NOT NULL,
  PRIMARY KEY (`idPovo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Fazendo dump de dados para tabela `povo`
--

INSERT INTO `povo` (`idPovo`, `nomePovo`, `obsPovo`, `statusPovo`) VALUES
(1, 'Xakriabá', 'Aldeia Xakriabá, localizada no município de São João das Missões', 1),
(2, 'Xerente', 'Aldeia Xerente-TO', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tipo_palavra`
--

CREATE TABLE IF NOT EXISTS `tipo_palavra` (
  `idTipoPalavra` int(11) NOT NULL AUTO_INCREMENT,
  `nomeTipoPalavra` varchar(45) NOT NULL,
  PRIMARY KEY (`idTipoPalavra`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Fazendo dump de dados para tabela `tipo_palavra`
--

INSERT INTO `tipo_palavra` (`idTipoPalavra`, `nomeTipoPalavra`) VALUES
(1, 'Comida'),
(2, 'Planta'),
(3, 'Animal'),
(4, 'Objeto'),
(5, 'Sentimento');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tipo_usuario`
--

CREATE TABLE IF NOT EXISTS `tipo_usuario` (
  `idTipoUsuario` int(11) NOT NULL,
  `DescricaoTipoUsuario` varchar(45) NOT NULL,
  PRIMARY KEY (`idTipoUsuario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `tipo_usuario`
--

INSERT INTO `tipo_usuario` (`idTipoUsuario`, `DescricaoTipoUsuario`) VALUES
(0, 'Administrador Geral'),
(1, 'Moderador'),
(2, 'Colaborador');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `idUsuario` int(11) NOT NULL AUTO_INCREMENT,
  `nomeUsuario` varchar(50) NOT NULL,
  `apelidoUsuario` varchar(50) NOT NULL,
  `senhaUsuario` varchar(40) NOT NULL,
  `emailUsuario` varchar(70) NOT NULL,
  `cpfUsuario` varchar(11) NOT NULL,
  `telefoneUsuario` varchar(15) NOT NULL,
  `linkUsuario` varchar(100) DEFAULT NULL,
  `descricaoUsuario` text NOT NULL,
  `idTipoUsuario` varchar(45) NOT NULL,
  `statusUsuario` int(1) NOT NULL,
  PRIMARY KEY (`idUsuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Fazendo dump de dados para tabela `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `nomeUsuario`, `apelidoUsuario`, `senhaUsuario`, `emailUsuario`, `cpfUsuario`, `telefoneUsuario`, `linkUsuario`, `descricaoUsuario`, `idTipoUsuario`, `statusUsuario`) VALUES
(1, 'Dener Guedes Mendonça', 'denerxy', 'dener', 'denerxy@gmail.com', '08215164692', '38 91252236', NULL, '', '0', 1),
(2, 'Fabricio Guedes Mendonça', 'fa', '123456', 'denerguedesbnb@yahoo.com.br', '05553493650', '3891252236', 'www.facebook.com.br', 'Estudante do IFNMG', '1', -1),
(3, 'Laila Fabianne Guedes Mendonça', 'laila', '123456', 'sorrisonafoto@yahoo.com.br', '04682828665', '3891252236', 'www.facebook.com.br', 'Estudo a língua indígena e sei algumas palavras. Gostaria de cadastrar a língua Macrô Jê', '2', 1),
(4, 'Hairton Sobral Silva', 'hairtonsena', '', 'hairtonsena@hotmail.com', '11111111111', '991919191', '', 'bla bla', '', 0),
(5, 'Danilo', 'dan', '', 'moabbcel@gmail.com', '22222222222', '222222222', '', '', '', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
