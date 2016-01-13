-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 13-Jan-2016 às 17:28
-- Versão do servidor: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `financeiro`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `categoria`
--

CREATE TABLE IF NOT EXISTS `categoria` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `categoria`
--

INSERT INTO `categoria` (`id`, `name`) VALUES
(2, 'Mercado'),
(3, 'Moto'),
(4, 'Aluguel'),
(5, 'Luz'),
(6, 'Telefone/TV/Internet');

-- --------------------------------------------------------

--
-- Estrutura da tabela `lancamentos`
--

CREATE TABLE IF NOT EXISTS `lancamentos` (
  `id` int(11) NOT NULL,
  `categoria` int(11) NOT NULL,
  `operacao` int(11) NOT NULL,
  `origem` int(11) NOT NULL,
  `data_lancamento` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `data_pagamento` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `valor_inicial` float NOT NULL,
  `valor_final` float NOT NULL,
  `tipo` int(11) NOT NULL,
  `prioridade` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `operacoes`
--

CREATE TABLE IF NOT EXISTS `operacoes` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `operacoes`
--

INSERT INTO `operacoes` (`id`, `name`) VALUES
(1, 'Dinheiro'),
(2, 'Cartao de Crédito'),
(3, 'Conta Corrente'),
(4, 'Depósito'),
(5, 'Débito');

-- --------------------------------------------------------

--
-- Estrutura da tabela `origem`
--

CREATE TABLE IF NOT EXISTS `origem` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `saldo_inicial` float NOT NULL,
  `saldo_atual` float DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `origem`
--

INSERT INTO `origem` (`id`, `name`, `saldo_inicial`, `saldo_atual`) VALUES
(2, 'Conta Corrente', 100, NULL),
(3, 'Bolso', 50, NULL),
(4, 'Salário', 0, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `prioridade`
--

CREATE TABLE IF NOT EXISTS `prioridade` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `icon` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `prioridade`
--

INSERT INTO `prioridade` (`id`, `name`, `icon`) VALUES
(1, 'Essencial', ''),
(2, 'Lazer', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipo`
--

CREATE TABLE IF NOT EXISTS `tipo` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `icon` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tipo`
--

INSERT INTO `tipo` (`id`, `name`, `icon`) VALUES
(1, 'Entrada', 'glyphicon glyphicon-arrow-up text-primary'),
(2, 'Saída', 'glyphicon glyphicon-arrow-down text-danger');

-- --------------------------------------------------------

--
-- Estrutura da tabela `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `login` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `user`
--

INSERT INTO `user` (`id`, `nome`, `login`, `email`, `password`) VALUES
(1, 'Diego de Campos', 'diegomi', 'diegomister@gmail.com', '123456');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lancamentos`
--
ALTER TABLE `lancamentos`
  ADD PRIMARY KEY (`id`), ADD KEY `categoria` (`categoria`), ADD KEY `operacao` (`operacao`), ADD KEY `origem` (`origem`), ADD KEY `lancamentos_ibfk_4` (`tipo`), ADD KEY `lancamentos_ibfk_5` (`prioridade`);

--
-- Indexes for table `operacoes`
--
ALTER TABLE `operacoes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `origem`
--
ALTER TABLE `origem`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prioridade`
--
ALTER TABLE `prioridade`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tipo`
--
ALTER TABLE `tipo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `lancamentos`
--
ALTER TABLE `lancamentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `operacoes`
--
ALTER TABLE `operacoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `origem`
--
ALTER TABLE `origem`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `prioridade`
--
ALTER TABLE `prioridade`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tipo`
--
ALTER TABLE `tipo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `lancamentos`
--
ALTER TABLE `lancamentos`
ADD CONSTRAINT `lancamentos_ibfk_1` FOREIGN KEY (`categoria`) REFERENCES `categoria` (`id`),
ADD CONSTRAINT `lancamentos_ibfk_2` FOREIGN KEY (`operacao`) REFERENCES `operacoes` (`id`),
ADD CONSTRAINT `lancamentos_ibfk_3` FOREIGN KEY (`origem`) REFERENCES `origem` (`id`),
ADD CONSTRAINT `lancamentos_ibfk_4` FOREIGN KEY (`tipo`) REFERENCES `tipo` (`id`),
ADD CONSTRAINT `lancamentos_ibfk_5` FOREIGN KEY (`prioridade`) REFERENCES `prioridade` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
