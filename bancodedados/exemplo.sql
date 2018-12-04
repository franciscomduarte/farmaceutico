-- phpMyAdmin SQL Dump
-- version 4.4.15.10
-- https://www.phpmyadmin.net
--
-- Host: localhost
-- Tempo de geração: 04/12/2018 às 15:05
-- Versão do servidor: 5.6.42
-- Versão do PHP: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Banco de dados: `e2f10`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `alternativa`
--

CREATE TABLE IF NOT EXISTS `alternativa` (
  `id` int(11) NOT NULL,
  `id_item` int(11) NOT NULL,
  `descricao` varchar(200) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `alternativa`
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
-- Estrutura para tabela `checklist`
--

CREATE TABLE IF NOT EXISTS `checklist` (
  `id` int(11) NOT NULL,
  `data_cadastro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `usuario_id` int(11) NOT NULL,
  `nome` varchar(200) NOT NULL,
  `sigla` varchar(20) NOT NULL DEFAULT 'Não cadastrado',
  `ativo` tinyint(1) NOT NULL,
  `meta` int(11) NOT NULL DEFAULT '75'
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `checklist`
--

INSERT INTO `checklist` (`id`, `data_cadastro`, `usuario_id`, `nome`, `sigla`, `ativo`, `meta`) VALUES
(1, '2018-11-20 16:52:21', 3, 'Bundle PAV (este é para pacientes que estão dependentes dorespirador mecânico, ou seja está internado na UTI)', 'PAV', 1, 90),
(2, '2018-11-20 17:39:19', 3, 'Bundle Sonda Vesical (pacientes em uso de sonda vesical)', 'Sonda Vesical', 1, 75),
(3, '2018-12-01 01:27:51', 25, 'CK - 1', 'PAV CK1', 1, 75),
(4, '2018-12-01 01:28:00', 25, 'CK - 2', 'PAV CK2', 1, 75),
(5, '2018-12-01 01:28:10', 25, 'CK - 3', 'PAV CK3', 0, 75);

-- --------------------------------------------------------

--
-- Estrutura para tabela `checklist_item`
--

CREATE TABLE IF NOT EXISTS `checklist_item` (
  `id_checklist` int(11) NOT NULL,
  `id_item` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `checklist_item`
--

INSERT INTO `checklist_item` (`id_checklist`, `id_item`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 5),
(1, 6);

-- --------------------------------------------------------

--
-- Estrutura para tabela `convenio`
--

CREATE TABLE IF NOT EXISTS `convenio` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `convenio`
--

INSERT INTO `convenio` (`id`, `nome`) VALUES
(2, 'AMIL'),
(3, 'SUS'),
(4, 'BRADESCO');

-- --------------------------------------------------------

--
-- Estrutura para tabela `internacao`
--

CREATE TABLE IF NOT EXISTS `internacao` (
  `id` int(11) NOT NULL,
  `numero_internacao` varchar(10) DEFAULT NULL,
  `data_internacao` datetime DEFAULT NULL,
  `data_saida` datetime DEFAULT NULL,
  `id_setor` int(11) NOT NULL,
  `id_paciente` int(11) NOT NULL,
  `id_convenio` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `internacao`
--

INSERT INTO `internacao` (`id`, `numero_internacao`, `data_internacao`, `data_saida`, `id_setor`, `id_paciente`, `id_convenio`) VALUES
(1, 'INT-01958', '2018-11-21 00:00:00', '2018-11-27 03:13:00', 3, 3, 3),
(2, 'INT-01959', '2018-11-24 00:00:00', '2018-11-30 17:28:00', 3, 3, 3),
(3, 'INT-01960', '2018-11-27 03:12:00', '2018-11-27 03:13:00', 3, 3, 3),
(4, 'INT-02010', '2018-11-23 00:00:00', NULL, 5, 3, 2),
(5, 'INT-02015', '2018-11-27 00:00:00', '2018-11-30 17:01:00', 2, 49, 4),
(6, 'INT-12345', '2018-11-30 00:00:00', '2018-11-30 17:33:00', 4, 49, 4),
(9, '4444444', '2018-11-30 00:00:00', NULL, 3, 3, 3),
(18, '4444444', '2018-12-22 00:00:00', NULL, 2, 49, 4),
(19, '555555', '2018-12-08 00:00:00', NULL, 4, 50, 2);

-- --------------------------------------------------------

--
-- Estrutura para tabela `internacao_checklist`
--

CREATE TABLE IF NOT EXISTS `internacao_checklist` (
  `id_internacao` int(11) NOT NULL,
  `id_checklist` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `internacao_checklist`
--

INSERT INTO `internacao_checklist` (`id_internacao`, `id_checklist`) VALUES
(9, 1),
(18, 1),
(19, 1),
(19, 2),
(18, 3),
(18, 4);

-- --------------------------------------------------------

--
-- Estrutura para tabela `item`
--

CREATE TABLE IF NOT EXISTS `item` (
  `id` int(11) NOT NULL,
  `enunciado` varchar(200) NOT NULL,
  `tipo` enum('ME','VF','TX','MV') NOT NULL,
  `meta` int(3) NOT NULL DEFAULT '75'
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `item`
--

INSERT INTO `item` (`id`, `enunciado`, `tipo`, `meta`) VALUES
(1, 'Cabeceira elevada 30°-45°', 'VF', 75),
(2, 'Suspensão diária da sedação', 'VF', 75),
(3, 'Higiene oral com Clorexidine', 'VF', 75),
(5, 'Profilaxia sangramento digestivo', 'VF', 75),
(6, 'Profilaxia de Tromboembolismo venoso', 'VF', 75),
(8, 'Fixação segura', 'VF', 75),
(9, 'Posicionamento correto do coletor', 'VF', 75),
(10, 'Capacidade máxima de 2/3 do coletor', 'VF', 75),
(11, 'Manteve conectado o sistema', 'VF', 75),
(12, 'Necessidade de manutenção', 'VF', 75);

-- --------------------------------------------------------

--
-- Estrutura para tabela `paciente`
--

CREATE TABLE IF NOT EXISTS `paciente` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `cpf` varchar(11) NOT NULL,
  `nascimento` date DEFAULT NULL,
  `id_convenio` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `paciente`
--

INSERT INTO `paciente` (`id`, `nome`, `cpf`, `nascimento`, `id_convenio`) VALUES
(3, 'LARA CRISTIAN1', '98920650187', '2018-11-30', 3),
(49, 'Molina', '71869549104', '2018-11-17', 4),
(50, 'Flaviano', '989898989', '2018-12-01', 2);

-- --------------------------------------------------------

--
-- Estrutura para tabela `perfil`
--

CREATE TABLE IF NOT EXISTS `perfil` (
  `id` int(11) NOT NULL,
  `descricao` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `perfil`
--

INSERT INTO `perfil` (`id`, `descricao`) VALUES
(1, 'ADMINISTRADOR'),
(2, 'SERVIDOR'),
(3, 'RECRUTADOR'),
(4, 'EXTERNO');

-- --------------------------------------------------------

--
-- Estrutura para tabela `permissao`
--

CREATE TABLE IF NOT EXISTS `permissao` (
  `id` int(11) NOT NULL,
  `descricao` varchar(100) NOT NULL,
  `url` varchar(300) DEFAULT NULL,
  `id_permissao_pai` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `permissao`
--

INSERT INTO `permissao` (`id`, `descricao`, `url`, `id_permissao_pai`) VALUES
(1, 'Administração', NULL, NULL),
(2, 'Hospital', NULL, NULL),
(3, 'Checklist', NULL, NULL),
(5, 'Setor', '/setor', 1),
(6, 'Convênio', '/convenio', 1),
(7, 'Paciente', '/paciente', 2),
(8, 'Ajuda', NULL, NULL),
(10, 'Internação', '/internacao', 2),
(15, 'Usuário', '/usuario', 1),
(16, '', '/selecao/iniciar', 14),
(18, 'Listar', '/checklist', 3);

-- --------------------------------------------------------

--
-- Estrutura para tabela `permissao_perfil`
--

CREATE TABLE IF NOT EXISTS `permissao_perfil` (
  `id_permissao` int(11) NOT NULL,
  `id_perfil` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `permissao_perfil`
--

INSERT INTO `permissao_perfil` (`id_permissao`, `id_perfil`) VALUES
(1, 1),
(2, 1),
(2, 2),
(2, 3),
(2, 4),
(3, 1),
(5, 1),
(6, 1),
(7, 1),
(10, 1),
(10, 2),
(10, 3),
(10, 4),
(15, 1),
(18, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `resposta_checklist`
--

CREATE TABLE IF NOT EXISTS `resposta_checklist` (
  `id` int(11) NOT NULL,
  `id_checklist` int(11) NOT NULL,
  `data_resposta` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_internacao` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `resposta_checklist`
--

INSERT INTO `resposta_checklist` (`id`, `id_checklist`, `data_resposta`, `id_internacao`) VALUES
(3, 1, '2018-11-22 02:18:17', 1),
(4, 1, '2018-11-24 01:45:42', 2),
(5, 1, '2018-11-24 02:29:54', 2),
(6, 1, '2018-11-24 03:07:04', 2),
(7, 1, '2018-11-27 02:30:43', 4),
(8, 1, '2018-11-27 02:50:55', 2),
(9, 1, '2018-11-28 17:47:03', 4),
(10, 1, '2018-11-30 17:36:50', 4),
(11, 1, '2018-11-30 17:45:36', 2),
(12, 1, '2018-11-30 17:53:04', 5),
(13, 1, '2018-11-30 19:31:46', 6);

-- --------------------------------------------------------

--
-- Estrutura para tabela `resposta_checklist_item`
--

CREATE TABLE IF NOT EXISTS `resposta_checklist_item` (
  `id_resposta_checklist` int(11) NOT NULL,
  `id_item` int(11) NOT NULL,
  `id_resposta_alternativa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `resposta_checklist_item`
--

INSERT INTO `resposta_checklist_item` (`id_resposta_checklist`, `id_item`, `id_resposta_alternativa`) VALUES
(3, 1, 3),
(3, 2, 1),
(3, 3, 5),
(3, 5, 7),
(3, 6, 10),
(4, 1, 3),
(4, 2, 2),
(4, 3, 6),
(4, 5, 8),
(4, 6, 9),
(5, 1, 3),
(5, 2, 2),
(5, 3, 6),
(5, 5, 8),
(5, 6, 9),
(6, 1, 3),
(6, 2, 1),
(6, 3, 5),
(6, 5, 7),
(6, 6, 9),
(7, 1, 3),
(7, 2, 1),
(7, 3, 5),
(7, 5, 7),
(7, 6, 9),
(8, 1, 3),
(8, 2, 1),
(8, 3, 5),
(8, 5, 7),
(8, 6, 9),
(9, 1, 3),
(9, 2, 1),
(9, 3, 6),
(9, 5, 7),
(9, 6, 9),
(10, 1, 3),
(10, 2, 1),
(10, 3, 5),
(10, 5, 7),
(10, 6, 9),
(11, 1, 3),
(11, 2, 2),
(11, 3, 5),
(11, 5, 7),
(11, 6, 10),
(12, 1, 3),
(12, 2, 1),
(12, 3, 6),
(12, 5, 7),
(12, 6, 10),
(13, 1, 3),
(13, 2, 2),
(13, 3, 6),
(13, 5, 8),
(13, 6, 10);

-- --------------------------------------------------------

--
-- Estrutura para tabela `setor`
--

CREATE TABLE IF NOT EXISTS `setor` (
  `id` int(11) NOT NULL,
  `nome` varchar(45) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `setor`
--

INSERT INTO `setor` (`id`, `nome`) VALUES
(2, 'UTI - TMO'),
(3, 'UTI - NEONATAL'),
(4, 'UTI - ESPECIALIZADA'),
(5, 'UTI - SEMI-INTENSIVA');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int(11) NOT NULL,
  `nome` varchar(60) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(32) NOT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT '1',
  `data_cadastro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `cpf` varchar(45) CHARACTER SET dec8 NOT NULL,
  `id_perfil` int(11) NOT NULL,
  `chave` varchar(32) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `usuario`
--

INSERT INTO `usuario` (`id`, `nome`, `email`, `senha`, `ativo`, `data_cadastro`, `cpf`, `id_perfil`, `chave`) VALUES
(3, 'Francisco Carlos Molina', 'francisco.molina@enap.gov.br', 'c56d0e9a7ccec67b4ea131655038d604', 0, '2017-10-16 02:00:00', '00000000000', 1, '3c2be6e69e254eb6ac0dfece4b63ba01'),
(4, 'Admin', 'admin@enap.gov.br', '202cb962ac59075b964b07152d234b70', 1, '2017-11-01 02:00:00', '0000000000', 1, '9654d70a804218ea38c50617e5c75435'),
(22, 'Francisco Carlos Molina Duarte Júnior', 'francisco.molina', '93d36da30ded8bd17536d1c642636243', 1, '2017-11-17 19:53:50', '98920650187', 2, 'dcde4924e17a3c443dcaa7bdcf6bc8ee'),
(23, 'teste', 'teste1@teste.com', '202cb962ac59075b964b07152d234b70', 1, '2017-11-17 19:57:20', '555.555.555-55', 3, 'ecf33f5b2170425128749c6d4473dde5'),
(24, 'Eric Soares Dias', 'ericsoaresd@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 1, '2018-11-27 23:30:40', '444.444.444-44', 1, '189d4e66a41f85286085e7f8006a1925'),
(25, 'Flaviano O. Silva', 'fosbsb@gmail.com', 'd3426d47a74ac758a7167846d80ddcdc', 1, '2018-11-27 23:31:22', '722.408.221-04', 1, '32439f3ce713c1224772abb81d942c99'),
(26, 'Janaína de Paula Campos', 'janainasabrina@gmail.com', 'ba87017893b16b6fdad4ff18b391d56b', 1, '2018-11-28 02:00:43', '721.061.071-53', 2, '3f05aec20e0a23addaaf539c39b3d8b3');

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `alternativa`
--
ALTER TABLE `alternativa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_alternativa_item1_idx` (`id_item`);

--
-- Índices de tabela `checklist`
--
ALTER TABLE `checklist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_checklist_usuario1_idx` (`usuario_id`);

--
-- Índices de tabela `checklist_item`
--
ALTER TABLE `checklist_item`
  ADD PRIMARY KEY (`id_checklist`,`id_item`),
  ADD KEY `fk_checklist_has_item_item1_idx` (`id_item`),
  ADD KEY `fk_checklist_has_item_checklist1_idx` (`id_checklist`);

--
-- Índices de tabela `convenio`
--
ALTER TABLE `convenio`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `internacao`
--
ALTER TABLE `internacao`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_internacao_setor1_idx` (`id_setor`),
  ADD KEY `fk_internacao_paciente1_idx` (`id_paciente`);

--
-- Índices de tabela `internacao_checklist`
--
ALTER TABLE `internacao_checklist`
  ADD PRIMARY KEY (`id_internacao`,`id_checklist`),
  ADD KEY `fk_internacao_has_checklist_checklist1_idx` (`id_checklist`),
  ADD KEY `fk_internacao_has_checklist_internacao1_idx` (`id_internacao`);

--
-- Índices de tabela `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `paciente`
--
ALTER TABLE `paciente`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cpf_UNIQUE` (`cpf`),
  ADD KEY `fk_paciente_convenio1_idx` (`id_convenio`);

--
-- Índices de tabela `perfil`
--
ALTER TABLE `perfil`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `permissao`
--
ALTER TABLE `permissao`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `permissao_perfil`
--
ALTER TABLE `permissao_perfil`
  ADD UNIQUE KEY `id_permissao` (`id_permissao`,`id_perfil`),
  ADD KEY `fk_permissao_perfil_permissao1_idx` (`id_permissao`),
  ADD KEY `fk_permissao_perfil_perfil1_idx` (`id_perfil`);

--
-- Índices de tabela `resposta_checklist`
--
ALTER TABLE `resposta_checklist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_reposta_checklist_checklist1_idx` (`id_checklist`),
  ADD KEY `fk_reposta_checklist_internacao1_idx` (`id_internacao`);

--
-- Índices de tabela `resposta_checklist_item`
--
ALTER TABLE `resposta_checklist_item`
  ADD KEY `fk_reposta_checklist_has_item_item1_idx` (`id_item`),
  ADD KEY `fk_reposta_checklist_has_item_reposta_checklist1_idx` (`id_resposta_checklist`),
  ADD KEY `fk_reposta_checklist_item_alternativa1_idx` (`id_resposta_alternativa`);

--
-- Índices de tabela `setor`
--
ALTER TABLE `setor`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `cpf_UNIQUE` (`cpf`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `chave` (`chave`),
  ADD KEY `fk_usuario_perfil1_idx` (`id_perfil`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `alternativa`
--
ALTER TABLE `alternativa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de tabela `checklist`
--
ALTER TABLE `checklist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de tabela `convenio`
--
ALTER TABLE `convenio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de tabela `internacao`
--
ALTER TABLE `internacao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT de tabela `item`
--
ALTER TABLE `item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT de tabela `paciente`
--
ALTER TABLE `paciente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=51;
--
-- AUTO_INCREMENT de tabela `perfil`
--
ALTER TABLE `perfil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de tabela `permissao`
--
ALTER TABLE `permissao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT de tabela `resposta_checklist`
--
ALTER TABLE `resposta_checklist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT de tabela `setor`
--
ALTER TABLE `setor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=27;
--
-- Restrições para dumps de tabelas
--

--
-- Restrições para tabelas `alternativa`
--
ALTER TABLE `alternativa`
  ADD CONSTRAINT `fk_alternativa_item1` FOREIGN KEY (`id_item`) REFERENCES `item` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `checklist`
--
ALTER TABLE `checklist`
  ADD CONSTRAINT `fk_checklist_usuario1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `checklist_item`
--
ALTER TABLE `checklist_item`
  ADD CONSTRAINT `fk_checklist_has_item_checklist1` FOREIGN KEY (`id_checklist`) REFERENCES `checklist` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_checklist_has_item_item1` FOREIGN KEY (`id_item`) REFERENCES `item` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `internacao`
--
ALTER TABLE `internacao`
  ADD CONSTRAINT `fk_internacao_paciente1` FOREIGN KEY (`id_paciente`) REFERENCES `paciente` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_internacao_setor1` FOREIGN KEY (`id_setor`) REFERENCES `setor` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `internacao_checklist`
--
ALTER TABLE `internacao_checklist`
  ADD CONSTRAINT `fk_internacao_has_checklist_checklist1` FOREIGN KEY (`id_checklist`) REFERENCES `checklist` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_internacao_has_checklist_internacao1` FOREIGN KEY (`id_internacao`) REFERENCES `internacao` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `paciente`
--
ALTER TABLE `paciente`
  ADD CONSTRAINT `fk_paciente_convenio1` FOREIGN KEY (`id_convenio`) REFERENCES `convenio` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `permissao_perfil`
--
ALTER TABLE `permissao_perfil`
  ADD CONSTRAINT `fk_permissao_perfil_perfil1` FOREIGN KEY (`id_perfil`) REFERENCES `perfil` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_permissao_perfil_permissao1` FOREIGN KEY (`id_permissao`) REFERENCES `permissao` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `resposta_checklist`
--
ALTER TABLE `resposta_checklist`
  ADD CONSTRAINT `fk_reposta_checklist_checklist1` FOREIGN KEY (`id_checklist`) REFERENCES `checklist` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_reposta_checklist_internacao1` FOREIGN KEY (`id_internacao`) REFERENCES `internacao` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `resposta_checklist_item`
--
ALTER TABLE `resposta_checklist_item`
  ADD CONSTRAINT `fk_reposta_checklist_has_item_item1` FOREIGN KEY (`id_item`) REFERENCES `item` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_reposta_checklist_has_item_reposta_checklist1` FOREIGN KEY (`id_resposta_checklist`) REFERENCES `resposta_checklist` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_reposta_checklist_item_alternativa1` FOREIGN KEY (`id_resposta_alternativa`) REFERENCES `alternativa` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_usuario_perfil1` FOREIGN KEY (`id_perfil`) REFERENCES `perfil` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
