-- phpMyAdmin SQL Dump
-- version 4.4.15.10
-- https://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 22, 2018 at 04:10 PM
-- Server version: 5.6.42
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `e2f10`
--

-- --------------------------------------------------------

--
-- Table structure for table `alternativa`
--

CREATE TABLE IF NOT EXISTS `alternativa` (
  `id` int(11) NOT NULL,
  `id_item` int(11) NOT NULL,
  `descricao` varchar(200) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `alternativa`
--

INSERT INTO `alternativa` (`id`, `id_item`, `descricao`) VALUES
(1, 2, 'Sim'),
(2, 2, 'Não'),
(3, 1, 'Sim'),
(4, 1, 'Não'),
(5, 3, 'Sim'),
(6, 3, 'Não'),
(7, 5, 'Sim'),
(8, 5, 'Não'),
(9, 6, 'Sim'),
(10, 6, 'Não');

-- --------------------------------------------------------

--
-- Table structure for table `checklist`
--

CREATE TABLE IF NOT EXISTS `checklist` (
  `id` int(11) NOT NULL,
  `data_cadastro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `usuario_id` int(11) NOT NULL,
  `nome` varchar(200) NOT NULL,
  `ativo` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `checklist`
--

INSERT INTO `checklist` (`id`, `data_cadastro`, `usuario_id`, `nome`, `ativo`) VALUES
(1, '2018-11-20 16:52:21', 3, 'Bundle PAV (este é para pacientes que estão dependentes dorespirador mecânico, ou seja está internado na UTI)', 1),
(2, '2018-11-20 17:39:19', 3, 'Bundle Sonda Vesical (pacientes em uso de sonda vesical)', 1);

-- --------------------------------------------------------

--
-- Table structure for table `checklist_item`
--

CREATE TABLE IF NOT EXISTS `checklist_item` (
  `id_checklist` int(11) NOT NULL,
  `id_item` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `checklist_item`
--

INSERT INTO `checklist_item` (`id_checklist`, `id_item`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 5),
(1, 6);

-- --------------------------------------------------------

--
-- Table structure for table `convenio`
--

CREATE TABLE IF NOT EXISTS `convenio` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `convenio`
--

INSERT INTO `convenio` (`id`, `nome`) VALUES
(2, 'AMIL'),
(3, 'SUS'),
(4, 'BRADESCO'),
(5, 'BRB Saúde');

-- --------------------------------------------------------

--
-- Table structure for table `internacao`
--

CREATE TABLE IF NOT EXISTS `internacao` (
  `id` int(11) NOT NULL,
  `numero_internacao` varchar(10) DEFAULT NULL,
  `data_internacao` datetime DEFAULT NULL,
  `id_setor` int(11) NOT NULL,
  `id_paciente` int(11) NOT NULL,
  `id_convenio` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `internacao`
--

INSERT INTO `internacao` (`id`, `numero_internacao`, `data_internacao`, `id_setor`, `id_paciente`, `id_convenio`) VALUES
(1, '1234', '2018-11-21 00:00:00', 3, 3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE IF NOT EXISTS `item` (
  `id` int(11) NOT NULL,
  `enunciado` varchar(200) NOT NULL,
  `tipo` enum('ME','VF','TX','MV') NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`id`, `enunciado`, `tipo`) VALUES
(1, 'Cabeceira elevada 30°-45°', 'VF'),
(2, 'Suspensão diária da sedação', 'VF'),
(3, 'Higiene oral com Clorexidine', 'VF'),
(5, 'Profilaxia sangramento digestivo', 'VF'),
(6, 'Profilaxia de Tromboembolismo venoso', 'VF'),
(8, 'Fixação segura', 'VF'),
(9, 'Posicionamento correto do coletor', 'VF'),
(10, 'Capacidade máxima de 2/3 do coletor', 'VF'),
(11, 'Manteve conectado o sistema', 'VF'),
(12, 'Necessidade de manutenção', 'VF');

-- --------------------------------------------------------

--
-- Table structure for table `paciente`
--

CREATE TABLE IF NOT EXISTS `paciente` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `cpf` varchar(11) NOT NULL,
  `nascimento` date DEFAULT NULL,
  `id_convenio` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `paciente`
--

INSERT INTO `paciente` (`id`, `nome`, `cpf`, `nascimento`, `id_convenio`) VALUES
(3, 'LARA CRISTIANA', '98920650187', '2018-11-30', 3),
(48, 'SABRINA DE PAULA CAMPOS', '72106107153', '2004-11-22', 5);

-- --------------------------------------------------------

--
-- Table structure for table `perfil`
--

CREATE TABLE IF NOT EXISTS `perfil` (
  `id` int(11) NOT NULL,
  `descricao` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `perfil`
--

INSERT INTO `perfil` (`id`, `descricao`) VALUES
(1, 'ADMINISTRADOR'),
(2, 'SERVIDOR'),
(3, 'RECRUTADOR'),
(4, 'EXTERNO');

-- --------------------------------------------------------

--
-- Table structure for table `permissao`
--

CREATE TABLE IF NOT EXISTS `permissao` (
  `id` int(11) NOT NULL,
  `descricao` varchar(100) NOT NULL,
  `url` varchar(300) DEFAULT NULL,
  `id_permissao_pai` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `permissao`
--

INSERT INTO `permissao` (`id`, `descricao`, `url`, `id_permissao_pai`) VALUES
(1, 'Administração', NULL, NULL),
(2, 'Hospital', NULL, NULL),
(3, 'Checklist', NULL, NULL),
(4, 'Usuário', '/usuario', 1),
(5, 'Setor', '/setor', 1),
(6, 'Convênio', '/convenio', 1),
(7, 'Paciente', '/paciente', 2),
(8, 'Ajuda', NULL, NULL),
(10, 'Internação', '/internacao', 2),
(15, 'Teste', '/teste', 14),
(16, 'Iniciar Seleção', '/selecao/iniciar', 14),
(18, 'Criar', '/checklist', 3),
(19, 'Responder', '/checklist-resposta', 3),
(20, 'Usuário', '/usuario', 4);

-- --------------------------------------------------------

--
-- Table structure for table `permissao_perfil`
--

CREATE TABLE IF NOT EXISTS `permissao_perfil` (
  `id_permissao` int(11) NOT NULL,
  `id_perfil` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `permissao_perfil`
--

INSERT INTO `permissao_perfil` (`id_permissao`, `id_perfil`) VALUES
(1, 1),
(5, 1),
(6, 1),
(7, 1),
(2, 1),
(10, 1),
(2, 4),
(10, 4),
(2, 3),
(10, 3),
(2, 2),
(10, 2),
(18, 1),
(19, 1),
(3, 1),
(4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `resposta_checklist`
--

CREATE TABLE IF NOT EXISTS `resposta_checklist` (
  `id` int(11) NOT NULL,
  `id_checklist` int(11) NOT NULL,
  `data_resposta` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_internacao` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `resposta_checklist`
--

INSERT INTO `resposta_checklist` (`id`, `id_checklist`, `data_resposta`, `id_internacao`) VALUES
(3, 1, '2018-11-22 02:18:17', 1),
(4, 1, '2018-11-22 17:59:15', 1);

-- --------------------------------------------------------

--
-- Table structure for table `resposta_checklist_item`
--

CREATE TABLE IF NOT EXISTS `resposta_checklist_item` (
  `id_resposta_checklist` int(11) NOT NULL,
  `id_item` int(11) NOT NULL,
  `id_resposta_alternativa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `resposta_checklist_item`
--

INSERT INTO `resposta_checklist_item` (`id_resposta_checklist`, `id_item`, `id_resposta_alternativa`) VALUES
(3, 1, 3),
(3, 2, 1),
(3, 3, 5),
(3, 5, 7),
(3, 6, 10),
(4, 1, 3),
(4, 2, 2),
(4, 3, 5),
(4, 5, 7),
(4, 6, 9);

-- --------------------------------------------------------

--
-- Table structure for table `setor`
--

CREATE TABLE IF NOT EXISTS `setor` (
  `id` int(11) NOT NULL,
  `nome` varchar(45) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `setor`
--

INSERT INTO `setor` (`id`, `nome`) VALUES
(2, 'RADIOGRAFIA (RAIO X)'),
(3, 'ENFERMARIA'),
(4, 'LABORATÓRIO');

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int(11) NOT NULL,
  `nome` varchar(60) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(32) NOT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT '1',
  `data_cadastro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `cpf` varchar(45) CHARACTER SET dec8 NOT NULL,
  `id_perfil` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`id`, `nome`, `email`, `senha`, `ativo`, `data_cadastro`, `cpf`, `id_perfil`) VALUES
(3, 'Francisco Carlos Molina', 'francisco.molina@enap.gov.br', 'e10adc3949ba59abbe56e057f20f883e', 0, '2017-10-16 02:00:00', '00000000000', 1),
(4, 'Admin', 'admin@enap.gov.br', 'd9b1d7db4cd6e70935368a1efb10e377', 1, '2017-11-01 02:00:00', '0000000000', 1),
(22, 'Francisco Carlos Molina Duarte Júnior', 'francisco.molina', '93d36da30ded8bd17536d1c642636243', 1, '2017-11-17 19:53:50', '98920650187', 2),
(23, 'teste', 'teste1@teste.com', '202cb962ac59075b964b07152d234b70', 1, '2017-11-17 19:57:20', '555.555.555-55', 3),
(24, 'Flaviano O. Silva', 'fosbsb@gmail.com', 'd3426d47a74ac758a7167846d80ddcdc', 1, '2018-11-22 14:26:06', '722.408.221-04', 1),
(25, 'Carlos Teste', 'carlos@teste.com.br', '1cc39ffd758234422e1f75beadfc5fb2', 0, '2018-11-22 14:27:51', '999.999.999-99', 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alternativa`
--
ALTER TABLE `alternativa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_alternativa_item1_idx` (`id_item`);

--
-- Indexes for table `checklist`
--
ALTER TABLE `checklist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_checklist_usuario1_idx` (`usuario_id`);

--
-- Indexes for table `checklist_item`
--
ALTER TABLE `checklist_item`
  ADD PRIMARY KEY (`id_checklist`,`id_item`),
  ADD KEY `fk_checklist_has_item_item1_idx` (`id_item`),
  ADD KEY `fk_checklist_has_item_checklist1_idx` (`id_checklist`);

--
-- Indexes for table `convenio`
--
ALTER TABLE `convenio`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `internacao`
--
ALTER TABLE `internacao`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_internacao_setor1_idx` (`id_setor`),
  ADD KEY `fk_internacao_paciente1_idx` (`id_paciente`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `paciente`
--
ALTER TABLE `paciente`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cpf_UNIQUE` (`cpf`),
  ADD KEY `fk_paciente_convenio1_idx` (`id_convenio`);

--
-- Indexes for table `perfil`
--
ALTER TABLE `perfil`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissao`
--
ALTER TABLE `permissao`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissao_perfil`
--
ALTER TABLE `permissao_perfil`
  ADD KEY `fk_permissao_perfil_permissao1_idx` (`id_permissao`),
  ADD KEY `fk_permissao_perfil_perfil1_idx` (`id_perfil`);

--
-- Indexes for table `resposta_checklist`
--
ALTER TABLE `resposta_checklist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_reposta_checklist_checklist1_idx` (`id_checklist`),
  ADD KEY `fk_reposta_checklist_internacao1_idx` (`id_internacao`);

--
-- Indexes for table `resposta_checklist_item`
--
ALTER TABLE `resposta_checklist_item`
  ADD KEY `fk_reposta_checklist_has_item_item1_idx` (`id_item`),
  ADD KEY `fk_reposta_checklist_has_item_reposta_checklist1_idx` (`id_resposta_checklist`),
  ADD KEY `fk_reposta_checklist_item_alternativa1_idx` (`id_resposta_alternativa`);

--
-- Indexes for table `setor`
--
ALTER TABLE `setor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `cpf_UNIQUE` (`cpf`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `fk_usuario_perfil1_idx` (`id_perfil`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alternativa`
--
ALTER TABLE `alternativa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `checklist`
--
ALTER TABLE `checklist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `convenio`
--
ALTER TABLE `convenio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `internacao`
--
ALTER TABLE `internacao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `paciente`
--
ALTER TABLE `paciente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=49;
--
-- AUTO_INCREMENT for table `perfil`
--
ALTER TABLE `perfil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `permissao`
--
ALTER TABLE `permissao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `resposta_checklist`
--
ALTER TABLE `resposta_checklist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `setor`
--
ALTER TABLE `setor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=26;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `alternativa`
--
ALTER TABLE `alternativa`
  ADD CONSTRAINT `fk_alternativa_item1` FOREIGN KEY (`id_item`) REFERENCES `item` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `checklist`
--
ALTER TABLE `checklist`
  ADD CONSTRAINT `fk_checklist_usuario1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `checklist_item`
--
ALTER TABLE `checklist_item`
  ADD CONSTRAINT `fk_checklist_has_item_checklist1` FOREIGN KEY (`id_checklist`) REFERENCES `checklist` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_checklist_has_item_item1` FOREIGN KEY (`id_item`) REFERENCES `item` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `internacao`
--
ALTER TABLE `internacao`
  ADD CONSTRAINT `fk_internacao_paciente1` FOREIGN KEY (`id_paciente`) REFERENCES `paciente` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_internacao_setor1` FOREIGN KEY (`id_setor`) REFERENCES `setor` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `paciente`
--
ALTER TABLE `paciente`
  ADD CONSTRAINT `fk_paciente_convenio1` FOREIGN KEY (`id_convenio`) REFERENCES `convenio` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `permissao_perfil`
--
ALTER TABLE `permissao_perfil`
  ADD CONSTRAINT `fk_permissao_perfil_perfil1` FOREIGN KEY (`id_perfil`) REFERENCES `perfil` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_permissao_perfil_permissao1` FOREIGN KEY (`id_permissao`) REFERENCES `permissao` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `resposta_checklist`
--
ALTER TABLE `resposta_checklist`
  ADD CONSTRAINT `fk_reposta_checklist_checklist1` FOREIGN KEY (`id_checklist`) REFERENCES `checklist` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_reposta_checklist_internacao1` FOREIGN KEY (`id_internacao`) REFERENCES `internacao` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `resposta_checklist_item`
--
ALTER TABLE `resposta_checklist_item`
  ADD CONSTRAINT `fk_reposta_checklist_has_item_item1` FOREIGN KEY (`id_item`) REFERENCES `item` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_reposta_checklist_has_item_reposta_checklist1` FOREIGN KEY (`id_resposta_checklist`) REFERENCES `resposta_checklist` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_reposta_checklist_item_alternativa1` FOREIGN KEY (`id_resposta_alternativa`) REFERENCES `alternativa` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_usuario_perfil1` FOREIGN KEY (`id_perfil`) REFERENCES `perfil` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
