-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: 17-Nov-2018 às 02:48
-- Versão do servidor: 10.1.24-MariaDB
-- PHP Version: 7.0.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `exemplo`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `arquivo`
--

CREATE TABLE `arquivo` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `tipo` varchar(30) NOT NULL,
  `tamanho` int(11) NOT NULL,
  `url` text NOT NULL,
  `id_curriculo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `lotacao`
--

CREATE TABLE `lotacao` (
  `id` int(11) NOT NULL,
  `nome` text NOT NULL,
  `sigla` varchar(50) NOT NULL,
  `id_suap` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `lotacao`
--

INSERT INTO `lotacao` (`id`, `nome`, `sigla`, `id_suap`) VALUES
(1, 'Presidência', 'PRESI', 1),
(2, 'Gabinete da Presidência', 'GABIN', 2),
(3, 'Diretoria de Gestão Interna', 'DGI', 3),
(4, 'Diretoria de Educação Continuada', 'DEC', 4),
(5, 'Diretoria de Formação Profissional e Especialização', 'DFPE', 5),
(6, 'Diretoria de Pesquisa e Pós-Graduação Stricto Sensu', 'DPSS', 6),
(7, 'Diretoria de Inovação e Gestão do Conhecimento', 'DGC', 7),
(8, 'Procuradoria', 'Proc', 8),
(9, 'Assessoria Internacional', 'AI', 9),
(10, 'Auditoria Interna', 'Audit', 10),
(11, 'Assessoria de Comunicação', 'Ascom', 11);

-- --------------------------------------------------------

--
-- Estrutura da tabela `perfil`
--

CREATE TABLE `perfil` (
  `id` int(11) NOT NULL,
  `descricao` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `perfil`
--

INSERT INTO `perfil` (`id`, `descricao`) VALUES
(1, 'ADMINISTRADOR'),
(2, 'SERVIDOR'),
(3, 'RECRUTADOR'),
(4, 'EXTERNO');

-- --------------------------------------------------------

--
-- Estrutura da tabela `permissao`
--

CREATE TABLE `permissao` (
  `id` int(11) NOT NULL,
  `descricao` varchar(100) NOT NULL,
  `url` varchar(300) DEFAULT NULL,
  `id_permissao_pai` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `permissao`
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
-- Estrutura da tabela `permissao_perfil`
--

CREATE TABLE `permissao_perfil` (
  `id_permissao` int(11) NOT NULL,
  `id_perfil` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `permissao_perfil`
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
-- Estrutura da tabela `teste`
--

CREATE TABLE `teste` (
  `id` int(11) NOT NULL,
  `descricao` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `teste`
--

INSERT INTO `teste` (`id`, `descricao`) VALUES
(41, 'EXTERNO');

-- --------------------------------------------------------

--
-- Estrutura da tabela `uf`
--

CREATE TABLE `uf` (
  `id` int(11) NOT NULL,
  `descricao` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `uf`
--

INSERT INTO `uf` (`id`, `descricao`) VALUES
(1, 'AC'),
(2, 'AL'),
(3, 'AM'),
(4, 'AP'),
(5, 'BA'),
(6, 'CE'),
(7, 'DF'),
(8, 'ES'),
(9, 'GO'),
(10, 'MA'),
(11, 'MG'),
(12, 'MS'),
(13, 'MT'),
(14, 'PA'),
(15, 'PB'),
(16, 'PE'),
(17, 'PI'),
(18, 'PR'),
(19, 'RJ'),
(20, 'RN'),
(21, 'RO'),
(22, 'RR'),
(23, 'RS'),
(24, 'SC'),
(25, 'SE'),
(26, 'SP'),
(27, 'TO');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nome` varchar(60) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(32) NOT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT '1',
  `data_cadastro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `cpf` varchar(45) CHARACTER SET dec8 NOT NULL,
  `siape` varchar(15) DEFAULT NULL,
  `rg` varchar(45) DEFAULT NULL,
  `nascimento` date DEFAULT NULL,
  `endereco` text,
  `municipio` text,
  `cep` varchar(45) DEFAULT NULL,
  `telefone` varchar(50) DEFAULT NULL,
  `cargo` varchar(200) DEFAULT NULL,
  `uf_id` int(11) DEFAULT NULL,
  `lotacao_id` int(11) DEFAULT NULL,
  `foto` varchar(400) DEFAULT NULL,
  `id_perfil` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id`, `nome`, `email`, `senha`, `ativo`, `data_cadastro`, `cpf`, `siape`, `rg`, `nascimento`, `endereco`, `municipio`, `cep`, `telefone`, `cargo`, `uf_id`, `lotacao_id`, `foto`, `id_perfil`) VALUES
(3, 'Francisco Carlos Molina', 'francisco.molina@enap.gov.br', '202cb962ac59075b964b07152d234b70', 0, '2017-10-16 00:00:00', '00000000000', '', '2082914', '1983-03-05', 'Rua 12 Norte Lote 08', 'Aguas Claras', '71909540', '2020-3440', 'Assessor', 1, 1, '', 1),
(4, 'Admin', 'admin@enap.gov.br', '202cb962ac59075b964b07152d234b70', 1, '2017-11-01 00:00:00', '0000000000', '0000000', '00000000', '2017-11-01', 'Enap', 'Asa Sul', '00000000', '00000000', 'Admin', 7, 3, '', 1),
(6, 'Flaviano de Oliveira Silva', 'flaviano.silva@enap.gov.br', '202cb962ac59075b964b07152d234b70', 1, '0000-00-00 00:00:00', '111.111.111-11', '1111111', '1111111', '2014-11-11', '1111111111', '111111111', '11.111-111', '(11) 11111-1111', '1111111', 4, 3, 'asda', 1),
(12, 'FRANCISCO CARLOS MOLINA DUARTE JUNIOR', 'francicso.m.duarte@gmail.com', '202cb962ac59075b964b07152d234b70', 1, '0000-00-00 00:00:00', '222.222.222.22', '1111111', '111111111111', '1983-03-05', '131313', '111111111111', '11.111-111', '(11) 11111-1111', '1111111111111', 3, NULL, '', 4),
(15, 'Fulano de tal', 'fulano@email.com', '202cb962ac59075b964b07152d234b70', 1, '0000-00-00 00:00:00', '444.444.444-44', '4444444', '4444444444444444', '2011-04-04', '44444444', '44444444444444444444444', '44.444-444', '(44) 44444-4444', '44444444444444444', 17, NULL, '', 4),
(16, 'asdasd', 'teste@teste.com', '202cb962ac59075b964b07152d234b70', 1, '0000-00-00 00:00:00', '666.666.666-66', '6666666', '66666666', '2011-12-12', '666666', '666666666666666666666666', '66.666-666', '(66) 66666-6666', '66666666666666', 17, 6, '', 3),
(22, 'Francisco Carlos Molina Duarte Júnior', 'francisco.molina', '93d36da30ded8bd17536d1c642636243', 1, '2017-11-17 17:53:50', '98920650187', '', '', '0000-00-00', '', '', '', '', '', NULL, NULL, '', 2),
(23, 'teste', 'teste1@teste.com', '202cb962ac59075b964b07152d234b70', 1, '2017-11-17 17:57:20', '555.555.555-55', '5555555', '5555555555', '2011-05-05', 'sad', 'asd', '44.444-444', '(55) 55555-5555', '444444', 2, 5, '', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `arquivo`
--
ALTER TABLE `arquivo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lotacao`
--
ALTER TABLE `lotacao`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `teste`
--
ALTER TABLE `teste`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `uf`
--
ALTER TABLE `uf`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `cpf_UNIQUE` (`cpf`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `fk_usuario_uf1_idx` (`uf_id`),
  ADD KEY `fk_usuario_perfil1_idx` (`id_perfil`),
  ADD KEY `lotacao_id` (`lotacao_id`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `arquivo`
--
ALTER TABLE `arquivo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `lotacao`
--
ALTER TABLE `lotacao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `perfil`
--
ALTER TABLE `perfil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `permissao`
--
ALTER TABLE `permissao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `teste`
--
ALTER TABLE `teste`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
--
-- AUTO_INCREMENT for table `uf`
--
ALTER TABLE `uf`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `permissao_perfil`
--
ALTER TABLE `permissao_perfil`
  ADD CONSTRAINT `fk_permissao_perfil_perfil1` FOREIGN KEY (`id_perfil`) REFERENCES `perfil` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_permissao_perfil_permissao1` FOREIGN KEY (`id_permissao`) REFERENCES `permissao` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_usuario_perfil1` FOREIGN KEY (`id_perfil`) REFERENCES `perfil` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_usuario_uf1` FOREIGN KEY (`uf_id`) REFERENCES `uf` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`lotacao_id`) REFERENCES `lotacao` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
