-- phpMyAdmin SQL Dump
-- version 3.4.9
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: 27/06/2019 às 17h46min
-- Versão do Servidor: 5.5.20
-- Versão do PHP: 5.3.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de Dados: `jurassic_park`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `dinossauro`
--

CREATE TABLE IF NOT EXISTS `dinossauro` (
  `id_dinossauro` int(11) NOT NULL,
  `filo` varchar(100) NOT NULL,
  `reino` varchar(100) NOT NULL,
  `dominio` varchar(100) NOT NULL,
  `ordem` varchar(100) NOT NULL,
  `clado` varchar(100) NOT NULL,
  `familia` varchar(100) NOT NULL,
  `genero` varchar(100) NOT NULL,
  `especie` varchar(100) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `periodo` varchar(100) NOT NULL,
  `cod_relacao` int(11) NOT NULL,
  PRIMARY KEY (`id_dinossauro`),
  KEY `cod_relacao` (`cod_relacao`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `dinossauro`
--

INSERT INTO `dinossauro` (`id_dinossauro`, `filo`, `reino`, `dominio`, `ordem`, `clado`, `familia`, `genero`, `especie`, `nome`, `periodo`, `cod_relacao`) VALUES
(0, 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 0),
(1, 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'aa', 'a', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `filial`
--

CREATE TABLE IF NOT EXISTS `filial` (
  `id_filial` int(11) NOT NULL AUTO_INCREMENT,
  `endereco` varchar(100) NOT NULL,
  `estado` char(2) NOT NULL,
  `telefone` int(11) NOT NULL,
  `cidade` varchar(100) NOT NULL,
  `nome` varchar(100) NOT NULL,
  PRIMARY KEY (`id_filial`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Extraindo dados da tabela `filial`
--

INSERT INTO `filial` (`id_filial`, `endereco`, `estado`, `telefone`, `cidade`, `nome`) VALUES
(3, 'FÃ£o Faulo', 'SP', 33333333, 'natata', 'Furafic Fark III'),
(4, 'Rua da quebrada principal 777', 'SP', 1177777777, 'SÃ£o Paulo', 'Rafa Morera mano'),
(5, 'a', 'a', 0, 'a', 'a');

-- --------------------------------------------------------

--
-- Estrutura da tabela `funcionario`
--

CREATE TABLE IF NOT EXISTS `funcionario` (
  `id_funcionario` char(11) NOT NULL,
  `cod_funcao` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `cod_relacao` int(10) NOT NULL,
  PRIMARY KEY (`id_funcionario`),
  KEY `funcao` (`cod_funcao`),
  KEY `setor_filial` (`cod_relacao`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `funcoes`
--

CREATE TABLE IF NOT EXISTS `funcoes` (
  `id_funcoes` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(100) NOT NULL,
  PRIMARY KEY (`id_funcoes`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Extraindo dados da tabela `funcoes`
--

INSERT INTO `funcoes` (`id_funcoes`, `descricao`) VALUES
(3, 'SeguranÃ§a'),
(4, 'a');

-- --------------------------------------------------------

--
-- Estrutura da tabela `relacao`
--

CREATE TABLE IF NOT EXISTS `relacao` (
  `id_relacao` int(11) NOT NULL AUTO_INCREMENT,
  `cod_setor` int(11) NOT NULL,
  `cod_filial` int(11) NOT NULL,
  PRIMARY KEY (`id_relacao`),
  KEY `cod_setor` (`cod_setor`),
  KEY `cod_filial` (`cod_filial`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Extraindo dados da tabela `relacao`
--

INSERT INTO `relacao` (`id_relacao`, `cod_setor`, `cod_filial`) VALUES
(0, 4, 3),
(8, 4, 4),
(9, 3, 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `setor`
--

CREATE TABLE IF NOT EXISTS `setor` (
  `id_setor` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(100) NOT NULL,
  PRIMARY KEY (`id_setor`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Extraindo dados da tabela `setor`
--

INSERT INTO `setor` (`id_setor`, `descricao`) VALUES
(3, 'HerbÃ­voro'),
(4, 'CarnÃ­voros'),
(5, 'a');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `id_usuario` char(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `sexo` char(1) NOT NULL,
  `data_nascimento` date NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` int(128) NOT NULL,
  `permissao` int(11) NOT NULL,
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nome`, `sexo`, `data_nascimento`, `email`, `senha`, `permissao`) VALUES
('11111111111', 'giovane', 'm', '2019-04-09', 'email@email.com', 123, 1),
('22222222222', 'eduardo', 'f', '2019-04-17', 'email1@email.com', 123, 0);

--
-- Restrições para as tabelas dumpadas
--

--
-- Restrições para a tabela `dinossauro`
--
ALTER TABLE `dinossauro`
  ADD CONSTRAINT `dinossauro_ibfk_2` FOREIGN KEY (`cod_relacao`) REFERENCES `relacao` (`id_relacao`) ON UPDATE CASCADE;

--
-- Restrições para a tabela `funcionario`
--
ALTER TABLE `funcionario`
  ADD CONSTRAINT `funcionario_ibfk_3` FOREIGN KEY (`cod_funcao`) REFERENCES `funcoes` (`id_funcoes`) ON UPDATE CASCADE,
  ADD CONSTRAINT `funcionario_ibfk_4` FOREIGN KEY (`cod_relacao`) REFERENCES `relacao` (`id_relacao`) ON UPDATE CASCADE;

--
-- Restrições para a tabela `relacao`
--
ALTER TABLE `relacao`
  ADD CONSTRAINT `relacao_ibfk_1` FOREIGN KEY (`cod_setor`) REFERENCES `setor` (`id_setor`) ON UPDATE CASCADE,
  ADD CONSTRAINT `relacao_ibfk_2` FOREIGN KEY (`cod_filial`) REFERENCES `filial` (`id_filial`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
