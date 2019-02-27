-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 27-Fev-2019 às 06:12
-- Versão do servidor: 10.1.30-MariaDB
-- PHP Version: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dentallivramento`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `arco`
--

CREATE TABLE `arco` (
  `id_produto` int(10) UNSIGNED NOT NULL,
  `material` varchar(50) DEFAULT NULL,
  `forma` varchar(50) DEFAULT NULL,
  `posicao` varchar(50) DEFAULT NULL,
  `tamanho` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `estilo`
--

CREATE TABLE `estilo` (
  `id_estilo` int(11) NOT NULL,
  `hexadecimal` varchar(7) NOT NULL,
  `local` varchar(250) NOT NULL,
  `nome` varchar(25) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `estilo`
--

INSERT INTO `estilo` (`id_estilo`, `hexadecimal`, `local`, `nome`, `status`) VALUES
(1, '#00BAFA', 'default.css', 'Azul', 1),
(2, '#FFB548', 'color-option2.css', 'Amarelo', 0),
(3, '#F45C5D', 'color-option4.css', 'Vermelho', 0),
(4, '#9B59B6', 'color-option1.css', 'Roxo', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `grupo`
--

CREATE TABLE `grupo` (
  `id_grupo` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `imagem` varchar(10000) NOT NULL,
  `descricao` varchar(3000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `grupo`
--

INSERT INTO `grupo` (`id_grupo`, `nome`, `imagem`, `descricao`) VALUES
(1, 'Ortodontia', 'grupoteste.png', 'lorem ipsum dolor sit amet testeteste testeteste testeteste testeteste testeteste testeteste testeteste testeteste testeteste testeteste testeteste testeteste testeteste testeteste testeteste testeteste testeteste testeteste testeteste testeteste testeteste testeteste testeteste testeteste testeteste testeteste testeteste testeteste testeteste testeteste testeteste testeteste testeteste testeteste testeteste testeteste testeteste testeteste testeteste testeteste testeteste testeteste testeteste testeteste testeteste testeteste testeteste testeteste testeteste testeteste testeteste testeteste testeteste testeteste testeteste testeteste testeteste testeteste testeteste testeteste testeteste testeteste testeteste testeteste testeteste testeteste testeteste testeteste testeteste testeteste testeteste testeteste ');

-- --------------------------------------------------------

--
-- Estrutura da tabela `marca`
--

CREATE TABLE `marca` (
  `id_marca` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `imagem` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `marca`
--

INSERT INTO `marca` (`id_marca`, `nome`, `imagem`) VALUES
(1, 'Marca de Teste', 'teste.png');

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto`
--

CREATE TABLE `produto` (
  `id_produto` int(10) UNSIGNED NOT NULL,
  `barcode` varchar(150) NOT NULL,
  `preco` varchar(7) NOT NULL,
  `nome` varchar(200) NOT NULL,
  `estoque` int(11) NOT NULL,
  `imagem` varchar(100) NOT NULL,
  `descricao` varchar(3000) DEFAULT NULL,
  `destaque` enum('1','0') NOT NULL,
  `tipo` enum('Arco','Dente','Resina','Bracket') DEFAULT NULL,
  `id_grupo` int(11) NOT NULL,
  `id_marca` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `produto`
--

INSERT INTO `produto` (`id_produto`, `barcode`, `preco`, `nome`, `estoque`, `imagem`, `descricao`, `destaque`, `tipo`, `id_grupo`, `id_marca`) VALUES
(1, '324524353', '32.90', 'produto de teste', 10, 'imagem.jpg', 'lotem kwkejf testeteste testeteste testeteste testeteste testeteste testeteste testeteste testeteste testeteste testeteste testeteste testeteste testeteste testeteste testeteste testeteste testeteste testeteste testeteste testeteste testeteste testeteste testeteste testeteste ', '1', NULL, 1, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `nome` varchar(200) NOT NULL,
  `login` varchar(200) NOT NULL,
  `senha` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `dtupdate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id_user`, `nome`, `login`, `senha`, `email`, `dtupdate`) VALUES
(1, 'admin', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin@admin.com', '2018-11-18 01:19:48');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `arco`
--
ALTER TABLE `arco`
  ADD PRIMARY KEY (`id_produto`);

--
-- Indexes for table `estilo`
--
ALTER TABLE `estilo`
  ADD PRIMARY KEY (`id_estilo`);

--
-- Indexes for table `grupo`
--
ALTER TABLE `grupo`
  ADD PRIMARY KEY (`id_grupo`);

--
-- Indexes for table `marca`
--
ALTER TABLE `marca`
  ADD PRIMARY KEY (`id_marca`);

--
-- Indexes for table `produto`
--
ALTER TABLE `produto`
  ADD PRIMARY KEY (`id_produto`),
  ADD KEY `id_grupo` (`id_grupo`),
  ADD KEY `id_marca` (`id_marca`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `estilo`
--
ALTER TABLE `estilo`
  MODIFY `id_estilo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `grupo`
--
ALTER TABLE `grupo`
  MODIFY `id_grupo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `marca`
--
ALTER TABLE `marca`
  MODIFY `id_marca` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `produto`
--
ALTER TABLE `produto`
  MODIFY `id_produto` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_user` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `arco`
--
ALTER TABLE `arco`
  ADD CONSTRAINT `produto_arco_fk` FOREIGN KEY (`id_produto`) REFERENCES `produto` (`id_produto`);

--
-- Limitadores para a tabela `produto`
--
ALTER TABLE `produto`
  ADD CONSTRAINT `id_grupo` FOREIGN KEY (`id_grupo`) REFERENCES `grupo` (`id_grupo`),
  ADD CONSTRAINT `id_marca` FOREIGN KEY (`id_marca`) REFERENCES `marca` (`id_marca`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
