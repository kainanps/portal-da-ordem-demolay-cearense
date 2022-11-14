-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 15-Jun-2019 às 18:43
-- Versão do servidor: 10.1.33-MariaDB
-- PHP Version: 7.2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `demolay`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `atas`
--

CREATE TABLE `atas` (
  `id_ata` int(11) NOT NULL,
  `titulo_ata` varchar(80) NOT NULL,
  `capitulo_ata` varchar(50) NOT NULL,
  `data_ata` date NOT NULL,
  `titulo_arquivo_ata` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `decretos`
--

CREATE TABLE `decretos` (
  `id_decreto` int(11) NOT NULL,
  `titulo_decreto` varchar(70) NOT NULL,
  `capitulo_decreto` varchar(40) NOT NULL,
  `data_decreto` date NOT NULL,
  `titulo_arquivo_decreto` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `eventos`
--

CREATE TABLE `eventos` (
  `id_evento` int(11) NOT NULL,
  `titulo_evento` varchar(100) NOT NULL,
  `conteudo_evento` varchar(5000) NOT NULL,
  `titulo_imagem` varchar(50) NOT NULL,
  `data_evento` date NOT NULL,
  `descricao_imagem` varchar(80) NOT NULL,
  `autor_evento` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `noticias`
--

CREATE TABLE `noticias` (
  `id_noticia` int(11) NOT NULL,
  `titulo_noticia` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `conteudo_noticia` varchar(5000) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `fontes_noticia` varchar(80) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `titulo_imagem` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `data_noticia` date NOT NULL,
  `descricao_imagem` varchar(80) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `autor_noticia` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `ouvidoria`
--

CREATE TABLE `ouvidoria` (
  `id_ouvidoria` int(11) NOT NULL,
  `nome` varchar(60) DEFAULT NULL,
  `telefone` varchar(16) DEFAULT NULL,
  `cidade` varchar(40) DEFAULT NULL,
  `comentario` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `ouvidoria`
--

INSERT INTO `ouvidoria` (`id_ouvidoria`, `nome`, `telefone`, `cidade`, `comentario`) VALUES
(5, '', '', '', ''),
(6, '', '', '', ''),
(7, '', '', '', ''),
(8, '', '', '', ''),
(9, '', '', '', ''),
(10, '', '', '', ''),
(11, '', '', '', ''),
(12, '', '', '', ''),
(13, '', '', '', ''),
(14, '', '', '', ''),
(15, '', '', '', ''),
(16, '', '', '', ''),
(17, '', '', '', ''),
(18, '', '', '', ''),
(19, '', '', '', ''),
(20, '', '', '', ''),
(21, '', '', '', ''),
(22, '', '', '', ''),
(23, '', '', '', ''),
(24, '', '', '', ''),
(25, '', '', '', ''),
(26, '', '', '', ''),
(27, '', '', '', ''),
(28, '', '', '', ''),
(29, '', '', '', ''),
(30, 'kasdkf', '', 'aklsdjf', 'aklsdjfa'),
(31, '', '', '', ''),
(32, 'kainan', '', 'kainan', 'kainan'),
(33, 'kainan', '', 'kaina', 'kaina');

-- --------------------------------------------------------

--
-- Estrutura da tabela `prestacaoconta`
--

CREATE TABLE `prestacaoconta` (
  `id_pConta` int(11) NOT NULL,
  `titulo_pConta` varchar(70) NOT NULL,
  `capitulo_pConta` varchar(40) NOT NULL,
  `data_pConta` date NOT NULL,
  `frequencia_pConta` varchar(1) NOT NULL,
  `titulo_arquivo_pConta` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nome_usuario` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `identificador_usuario` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `senha_usuario` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `tipo_usuario` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nome_usuario`, `identificador_usuario`, `senha_usuario`, `tipo_usuario`) VALUES
(3, 'teste', 'teste', '$2y$10$M978j12H5QPP/wBv.U.33u5w6/LQFwNZAJFrYZ7Usfz0qKFEMSmcO', 1),
(7, 'Ordem DeMolay', 'gce', '$2y$10$eoggM1evRdXc8onPRAXCG.VGU6J4JksAtuE.dvby9.gsTD/l6KFSq', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `atas`
--
ALTER TABLE `atas`
  ADD PRIMARY KEY (`id_ata`);

--
-- Indexes for table `decretos`
--
ALTER TABLE `decretos`
  ADD PRIMARY KEY (`id_decreto`);

--
-- Indexes for table `eventos`
--
ALTER TABLE `eventos`
  ADD PRIMARY KEY (`id_evento`);

--
-- Indexes for table `noticias`
--
ALTER TABLE `noticias`
  ADD PRIMARY KEY (`id_noticia`);

--
-- Indexes for table `ouvidoria`
--
ALTER TABLE `ouvidoria`
  ADD PRIMARY KEY (`id_ouvidoria`);

--
-- Indexes for table `prestacaoconta`
--
ALTER TABLE `prestacaoconta`
  ADD PRIMARY KEY (`id_pConta`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `identificador_usuario` (`identificador_usuario`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `atas`
--
ALTER TABLE `atas`
  MODIFY `id_ata` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `decretos`
--
ALTER TABLE `decretos`
  MODIFY `id_decreto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `eventos`
--
ALTER TABLE `eventos`
  MODIFY `id_evento` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `noticias`
--
ALTER TABLE `noticias`
  MODIFY `id_noticia` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ouvidoria`
--
ALTER TABLE `ouvidoria`
  MODIFY `id_ouvidoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `prestacaoconta`
--
ALTER TABLE `prestacaoconta`
  MODIFY `id_pConta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
