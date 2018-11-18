-- phpMyAdmin SQL Dump
-- version 4.3.7
-- http://www.phpmyadmin.net
--
-- Host: mysql06-farm59.uni5.net
-- Tempo de geração: 18/11/2018 às 00:26
-- Versão do servidor: 5.5.40-log
-- Versão do PHP: 5.3.28

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `checklist`
--

CREATE TABLE IF NOT EXISTS `checklist` (
  `id` int(11) NOT NULL,
  `data_cadastro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `usuario_id` int(11) NOT NULL,
  `nome` varchar(200) NOT NULL,
  `ativo` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `checklist_item`
--

CREATE TABLE IF NOT EXISTS `checklist_item` (
  `id_checklist` int(11) NOT NULL,
  `id_item` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `convenio`
--

CREATE TABLE IF NOT EXISTS `convenio` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `historico_acesso`
--

CREATE TABLE IF NOT EXISTS `historico_acesso` (
  `id` int(11) NOT NULL,
  `data` datetime NOT NULL,
  `usuario_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `historico_acesso`
--

INSERT INTO `historico_acesso` (`id`, `data`, `usuario_id`) VALUES
(1, '2018-11-18 00:05:54', 6),
(2, '2018-11-18 00:06:07', 3);

-- --------------------------------------------------------

--
-- Estrutura para tabela `internacao`
--

CREATE TABLE IF NOT EXISTS `internacao` (
  `id` int(11) NOT NULL,
  `numero_internacao` varchar(10) DEFAULT NULL,
  `data_internacao` datetime DEFAULT NULL,
  `id_setor` int(11) NOT NULL,
  `id_paciente` int(11) NOT NULL,
  `id_convenio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `item`
--

CREATE TABLE IF NOT EXISTS `item` (
  `id` int(11) NOT NULL,
  `enunciado` varchar(200) NOT NULL,
  `tipo` enum('ME','VF','TX','MV') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `paciente`
--

CREATE TABLE IF NOT EXISTS `paciente` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `cpf` varchar(11) DEFAULT NULL,
  `nascimento` date DEFAULT NULL,
  `id_convenio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `permissao`
--

INSERT INTO `permissao` (`id`, `descricao`, `url`, `id_permissao_pai`) VALUES
(1, 'Administração', NULL, NULL),
(2, 'Currículo', NULL, NULL),
(5, 'Usuários', '/usuario', 1),
(6, 'Áreas de Interesse', '/tema', 1),
(7, 'Perfis', '/perfil', 1),
(8, 'Ajuda', NULL, NULL),
(9, 'Teste', '/teste', 2),
(10, 'Meu Currículo', '/curriculo/{id_usuario}', 2),
(11, 'Ver p/ Impressão', '/curriculo/aba11/{id_usuario}', 2),
(12, 'Cursos', '/curso', 1),
(14, 'Seleção', NULL, NULL),
(15, 'Teste', '/teste', 14),
(16, 'Iniciar Seleção', '/selecao/iniciar', 14);

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
(5, 1),
(6, 1),
(7, 1),
(2, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(14, 1),
(15, 1),
(16, 1),
(2, 4),
(11, 4),
(10, 4),
(2, 3),
(14, 3),
(11, 3),
(10, 3),
(9, 3),
(15, 3),
(16, 3),
(2, 2),
(11, 2),
(10, 2);

-- --------------------------------------------------------

--
-- Estrutura para tabela `reposta_checklist`
--

CREATE TABLE IF NOT EXISTS `reposta_checklist` (
  `id` int(11) NOT NULL,
  `id_checklist` int(11) NOT NULL,
  `data_resposta` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_internacao` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `reposta_checklist_item`
--

CREATE TABLE IF NOT EXISTS `reposta_checklist_item` (
  `id_reposta_checklist` int(11) NOT NULL,
  `id_item` int(11) NOT NULL,
  `id_resposta_alternativa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `setor`
--

CREATE TABLE IF NOT EXISTS `setor` (
  `id` int(11) NOT NULL,
  `nome` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `id_perfil` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `usuario`
--

INSERT INTO `usuario` (`id`, `nome`, `email`, `senha`, `ativo`, `data_cadastro`, `cpf`, `id_perfil`) VALUES
(3, 'Francisco Carlos Molina', 'francisco.molina@enap.gov.br', 'e10adc3949ba59abbe56e057f20f883e', 0, '2017-10-16 00:00:00', '00000000000', 1),
(4, 'Admin', 'admin@enap.gov.br', '202cb962ac59075b964b07152d234b70', 1, '2017-11-01 00:00:00', '0000000000', 1),
(6, 'Flaviano de Oliveira Silva', 'flaviano.silva@enap.gov.br', '202cb962ac59075b964b07152d234b70', 1, '0000-00-00 00:00:00', '111.111.111-11', 1),
(12, 'FRANCISCO CARLOS MOLINA DUARTE JUNIOR', 'francicso.m.duarte@gmail.com', '202cb962ac59075b964b07152d234b70', 1, '0000-00-00 00:00:00', '222.222.222.22', 4),
(15, 'Fulano de tal', 'fulano@email.com', '202cb962ac59075b964b07152d234b70', 1, '0000-00-00 00:00:00', '444.444.444-44', 4),
(16, 'asdasd', 'teste@teste.com', '202cb962ac59075b964b07152d234b70', 1, '0000-00-00 00:00:00', '666.666.666-66', 3),
(22, 'Francisco Carlos Molina Duarte Júnior', 'francisco.molina', '93d36da30ded8bd17536d1c642636243', 1, '2017-11-17 17:53:50', '98920650187', 2),
(23, 'teste', 'teste1@teste.com', '202cb962ac59075b964b07152d234b70', 1, '2017-11-17 17:57:20', '555.555.555-55', 3);

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `alternativa`
--
ALTER TABLE `alternativa`
  ADD PRIMARY KEY (`id`), ADD KEY `fk_alternativa_item1_idx` (`id_item`);

--
-- Índices de tabela `checklist`
--
ALTER TABLE `checklist`
  ADD PRIMARY KEY (`id`), ADD KEY `fk_checklist_usuario1_idx` (`usuario_id`);

--
-- Índices de tabela `checklist_item`
--
ALTER TABLE `checklist_item`
  ADD PRIMARY KEY (`id_checklist`,`id_item`), ADD KEY `fk_checklist_has_item_item1_idx` (`id_item`), ADD KEY `fk_checklist_has_item_checklist1_idx` (`id_checklist`);

--
-- Índices de tabela `convenio`
--
ALTER TABLE `convenio`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `historico_acesso`
--
ALTER TABLE `historico_acesso`
  ADD PRIMARY KEY (`id`,`usuario_id`), ADD KEY `fk_historico_acesso_usuario1_idx` (`usuario_id`);

--
-- Índices de tabela `internacao`
--
ALTER TABLE `internacao`
  ADD PRIMARY KEY (`id`), ADD KEY `fk_internacao_setor1_idx` (`id_setor`), ADD KEY `fk_internacao_paciente1_idx` (`id_paciente`);

--
-- Índices de tabela `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `paciente`
--
ALTER TABLE `paciente`
  ADD PRIMARY KEY (`id`), ADD KEY `fk_paciente_convenio1_idx` (`id_convenio`);

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
  ADD KEY `fk_permissao_perfil_permissao1_idx` (`id_permissao`), ADD KEY `fk_permissao_perfil_perfil1_idx` (`id_perfil`);

--
-- Índices de tabela `reposta_checklist`
--
ALTER TABLE `reposta_checklist`
  ADD PRIMARY KEY (`id`), ADD KEY `fk_reposta_checklist_checklist1_idx` (`id_checklist`), ADD KEY `fk_reposta_checklist_internacao1_idx` (`id_internacao`);

--
-- Índices de tabela `reposta_checklist_item`
--
ALTER TABLE `reposta_checklist_item`
  ADD PRIMARY KEY (`id_reposta_checklist`,`id_item`), ADD KEY `fk_reposta_checklist_has_item_item1_idx` (`id_item`), ADD KEY `fk_reposta_checklist_has_item_reposta_checklist1_idx` (`id_reposta_checklist`), ADD KEY `fk_reposta_checklist_item_alternativa1_idx` (`id_resposta_alternativa`);

--
-- Índices de tabela `setor`
--
ALTER TABLE `setor`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`) USING BTREE, ADD UNIQUE KEY `cpf_UNIQUE` (`cpf`), ADD UNIQUE KEY `email` (`email`), ADD KEY `fk_usuario_perfil1_idx` (`id_perfil`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `historico_acesso`
--
ALTER TABLE `historico_acesso`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de tabela `perfil`
--
ALTER TABLE `perfil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de tabela `permissao`
--
ALTER TABLE `permissao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=24;
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
-- Restrições para tabelas `historico_acesso`
--
ALTER TABLE `historico_acesso`
ADD CONSTRAINT `fk_historico_acesso_usuario1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `internacao`
--
ALTER TABLE `internacao`
ADD CONSTRAINT `fk_internacao_paciente1` FOREIGN KEY (`id_paciente`) REFERENCES `paciente` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_internacao_setor1` FOREIGN KEY (`id_setor`) REFERENCES `setor` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
-- Restrições para tabelas `reposta_checklist`
--
ALTER TABLE `reposta_checklist`
ADD CONSTRAINT `fk_reposta_checklist_checklist1` FOREIGN KEY (`id_checklist`) REFERENCES `checklist` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_reposta_checklist_internacao1` FOREIGN KEY (`id_internacao`) REFERENCES `internacao` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `reposta_checklist_item`
--
ALTER TABLE `reposta_checklist_item`
ADD CONSTRAINT `fk_reposta_checklist_has_item_item1` FOREIGN KEY (`id_item`) REFERENCES `item` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_reposta_checklist_has_item_reposta_checklist1` FOREIGN KEY (`id_reposta_checklist`) REFERENCES `reposta_checklist` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_reposta_checklist_item_alternativa1` FOREIGN KEY (`id_resposta_alternativa`) REFERENCES `alternativa` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `usuario`
--
ALTER TABLE `usuario`
ADD CONSTRAINT `fk_usuario_perfil1` FOREIGN KEY (`id_perfil`) REFERENCES `perfil` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
