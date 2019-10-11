-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 11-Out-2019 às 06:43
-- Versão do servidor: 10.1.25-MariaDB
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dentallivramento2`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `carrinho`
--

CREATE TABLE `carrinho` (
  `id_carrinho` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `categoria`
--

CREATE TABLE `categoria` (
  `id_categoria` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `descricao` varchar(5000) NOT NULL,
  `imagem` varchar(5000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `categoria`
--

INSERT INTO `categoria` (`id_categoria`, `nome`, `descricao`, `imagem`) VALUES
(1, 'Cirurgia e periodontia', '', ''),
(2, 'Ortodontia ', '', ''),
(3, 'Protese e laboratorio', '', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `destaque`
--

CREATE TABLE `destaque` (
  `id_destaque` int(11) NOT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `imagem` varchar(5000) NOT NULL,
  `id_grupo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `destaque`
--

INSERT INTO `destaque` (`id_destaque`, `nome`, `imagem`, `id_grupo`) VALUES
(1, NULL, 'https://thirdforcenews.org.uk/images/uploads/articles/214331/web_dad_helping_children_do_homework.jpg', 15),
(3, 'Promo teste surpresa', 'https://lh3.googleusercontent.com/JfmPqZCVQmMHvNTh5Wt0c_cnB2dR-j8vT3ryGvCgRkrWY3c5UJjRB70IgOPVEKDv-8cHaYzvCSZDhTpJXxKkAYtR6QINe0LgdT8sXIcabyAeseOqq3ly6EAsjinKrgUWH6BUTqayZrczVfMnGmGBIjVLq8V75qgBFvHEl8Q2oyrzo4odxJJjlq92M5HrcV318ZPjQ662CiP7lca_g769POhUyxHw4e5blbD6WskFljtkjA14x3PKPGrGCcPD4bbg44x1DCOAItXknHbpV-wESEiHJbaPU9Hlo1FcOK2o-2upHg3Cy96NjBmVSzaPVLTb6O22KLmJXBoxMXYTbO53YPVduOFnJy0dGiOmSrDIutfoB21l0yMxPBtbDYigbm1rHUcvfQHE-ciw5qLXAwb9K1yqz0warp_HtcL3CEzi_SRSQ286Yo7UZcccDAlB2buwK9o3IbYuDSC7hP3yukSFmb7nRGBFqjg5chBTVSrLBKokeOuYIuvHbbzzfGaiwifPdqp6bQy7DGJkMR0WoVFefR5eN4cH9f9DZcbzNRe1bwIxoC5K1HaR9mx9p0uoF97BS9h4QT4jBM12rFxXty72xrS2nTJ9MepwKt-FqqcWK1x5qIC-Mt-c3-cijmiQ2QkWi1m30uXtPUxyD0b5lZHecl8=w956-h500-no', 30),
(4, NULL, 'https://inepo.com.br/pacientes/wp-content/uploads/2018/09/banner-inicio-orto.png', 19);

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
-- Estrutura da tabela `foto`
--

CREATE TABLE `foto` (
  `id_foto` int(11) NOT NULL,
  `src` varchar(2000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `foto`
--

INSERT INTO `foto` (`id_foto`, `src`) VALUES
(1, 'menu-photo_1.jpg'),
(2, 'menu-photo_2.jpg'),
(4, 'bg-testimoni.jpg'),
(5, 'about.png'),
(6, 'bg-about.jpg'),
(7, 'people-01.jpg'),
(8, 'people-04.jpg'),
(9, 'title-img.jpg'),
(10, 'blog-small-03.jpg'),
(11, 'blog-01.jpg'),
(12, 'blog-03.jpg'),
(13, 'featured-collection-02.jpg'),
(14, 'featurporch1.jpg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `grupo`
--

CREATE TABLE `grupo` (
  `id_grupo` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `id_categoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `grupo`
--

INSERT INTO `grupo` (`id_grupo`, `nome`, `id_categoria`) VALUES
(1, 'Ucla plastica', 1),
(2, 'Ligadura tematica', 2),
(3, 'Geral', 3),
(4, 'Insolante para resina ', 3),
(5, 'Bionix', 3),
(6, 'Ligadura modular', 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `item`
--

CREATE TABLE `item` (
  `id_item` int(11) NOT NULL,
  `descricao` varchar(1000) NOT NULL,
  `imagem` varchar(5000) NOT NULL,
  `destaque` enum('1','0') NOT NULL,
  `tipo` varchar(100) NOT NULL,
  `id_subgrupo` int(11) NOT NULL,
  `id_marca` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `item`
--

INSERT INTO `item` (`id_item`, `descricao`, `imagem`, `destaque`, `tipo`, `id_subgrupo`, `id_marca`) VALUES
(1504, '', '', '1', '\r', 739, 141),
(1505, '', '', '1', '\r', 740, 142),
(1506, '', '', '1', '\r', 741, 143),
(1507, '', '', '1', '\r', 742, 143),
(1508, '', '', '1', '\r', 743, 143),
(1509, '', '', '1', 'Amarelo\r', 744, 142),
(1510, '', '', '', 'Azul bebe\r', 744, 142),
(1511, '', '', '', 'Azul celeste\r', 744, 142),
(1512, '', '', '', 'Azul claro\r', 744, 142),
(1513, '', '', '', 'Azul crisatal\r', 744, 142),
(1514, '', '', '', 'Azul jeans\r', 744, 142),
(1515, '', '', '', 'Azul metalizado\r', 744, 142),
(1516, '', '', '', 'Azul royal\r', 744, 142),
(1517, '', '', '', 'Branco\r', 744, 142),
(1518, '', '', '', 'Cereja\r', 744, 142),
(1519, '', '', '', 'Laranja\r', 744, 142),
(1520, '', '', '', 'Laranja escuro\r', 744, 142),
(1521, '', '', '', 'Lilas\r', 744, 142),
(1522, '', '', '', 'Perola\r', 744, 142),
(1523, '', '', '', 'Pink\r', 744, 142),
(1524, '', '', '', 'Pink escuro\r', 744, 142),
(1525, '', '', '', 'Prata\r', 744, 142),
(1526, '', '', '', 'Preto', 744, 142);

-- --------------------------------------------------------

--
-- Estrutura da tabela `itemcarrinho`
--

CREATE TABLE `itemcarrinho` (
  `id_itemcarrinho` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `id_carrinho` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `marca`
--

CREATE TABLE `marca` (
  `id_marca` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `imagem` varchar(5000) NOT NULL,
  `catalogo` varchar(1000) NOT NULL,
  `slider` enum('1','0') NOT NULL,
  `single_prod` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `marca`
--

INSERT INTO `marca` (`id_marca`, `nome`, `imagem`, `catalogo`, `slider`, `single_prod`) VALUES
(1, 'Adidas', 'https://vandal-us.s3.amazonaws.com/spree/products/49846/original/open-uri20181203-14-1jczs.jpg', 'https://static.morelli.com.br/arquivos/midias/folhetos/br/Midia_284_4_1520622302610.pdf', '1', '1'),
(2, 'Puma', 'http://pluspng.com/img-png/puma-png-puma-png-240.png', 'https://static.morelli.com.br/arquivos/midias/folhetos/br/Midia_284_4_1520622302610.pdf', '1', '0'),
(3, 'qwert', 'https://logodownload.org/wp-content/uploads/2014/04/nike-logo-1.png', 'https://google.com.br', '1', '1'),
(141, 'Implacil', '', '', '1', '0'),
(142, 'Orthomundi', '', '', '1', '0'),
(143, 'Triunfo', '', '', '1', '0');

-- --------------------------------------------------------

--
-- Estrutura da tabela `mensagem`
--

CREATE TABLE `mensagem` (
  `id_mensagem` int(11) NOT NULL,
  `email` varchar(200) NOT NULL,
  `mensagem` text NOT NULL,
  `data` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `mensagem`
--

INSERT INTO `mensagem` (`id_mensagem`, `email`, `mensagem`, `data`) VALUES
(3, 'dudumaciel2011@hotmail.com', 'que top boi', '2019-04-26'),
(4, 'dudumaciel2011@hotmail.com', 'gostaria de saber algo topperson', '2019-05-27');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedido`
--

CREATE TABLE `pedido` (
  `id_pedido` int(11) NOT NULL,
  `nome` varchar(500) NOT NULL,
  `endereco` varchar(2000) DEFAULT NULL,
  `cep` varchar(30) DEFAULT NULL,
  `cidade` varchar(100) DEFAULT NULL,
  `uf` varchar(2) DEFAULT NULL,
  `telefone` varchar(20) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `mensagem` text,
  `precototal` float NOT NULL,
  `data` date NOT NULL,
  `status` enum('INCONCLUSO','NAO ENTREGUE','ENTREGUE') NOT NULL,
  `id_carrinho` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto`
--

CREATE TABLE `produto` (
  `id_produto` int(11) NOT NULL,
  `barcode` varchar(50) NOT NULL,
  `preco` float NOT NULL,
  `estoque` int(11) NOT NULL,
  `especificacao` varchar(500) NOT NULL,
  `tipo` varchar(100) NOT NULL,
  `embalagem` varchar(100) NOT NULL,
  `id_subgrupo` int(11) NOT NULL,
  `id_marca` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `produto`
--

INSERT INTO `produto` (`id_produto`, `barcode`, `preco`, `estoque`, `especificacao`, `tipo`, `embalagem`, `id_subgrupo`, `id_marca`) VALUES
(1, '000000003698', 35, 80, 'Ucla Plastica HI com Hexagono sim Ombro 3.5', '\r', '1 und', 739, 141),
(2, '00000003', 19.9, 0, 'Ligadura Tematica Premium Gatinho cor Surtida', '\r', '1000 und', 740, 142),
(3, '00000004', 19.9, 0, 'Ligadura Tematica Premium Orelhas cor Surtida', '\r', '1000 und', 740, 142),
(4, '000000117029', 4.2, 17, 'Triunfo Superior 3P Cor 60', '\r', '1 und', 741, 143),
(5, '000000117043', 4.2, 15, 'Triunfo Superior 264 Cor 60', '\r', '1 und', 741, 143),
(6, '000000117074', 4.2, 12, 'Triunfo Inferior A26 Cor 62', '\r', '1 und', 741, 143),
(7, '000000117081', 4.2, 6, 'Triunfo Superior 30M Cor 62', '\r', '1 und', 741, 143),
(8, '000000117159', 4.2, 15, 'Triunfo Superior 32L Cor 66', '\r', '1 und', 741, 143),
(9, '000000255400', 24, 5, 'Isolante', '\r', '500 ml', 742, 143),
(10, '000000292719', 8.5, 20, 'Bionix TG3 Cor 62', '\r', '1 und', 743, 143),
(11, '000000292733', 8.5, 16, 'Bionix R4B Cor 66', '\r', '1 und', 743, 143),
(12, '000000292757', 8.5, 11, 'Bionix IL7 Cor 66', '\r', '1 und', 743, 143),
(13, '000000292771', 8.5, 13, 'Bionix IK 6 Cor 69', '\r', '1 und', 743, 143),
(14, '000000292795', 8.5, 8, 'Bionix Superior TM5 Cor 69', '\r', '1 und', 743, 143),
(15, '000000292825', 8.5, 9, 'Bionix Inferior TM5 Cor 69', '\r', '1 und', 743, 143),
(16, '000000292832', 8.5, 16, 'Bionix TL4 Cor 60', '\r', '1 und', 743, 143),
(17, '000000292849', 8.5, 16, 'Bionix R25 Cor 69', '\r', '1 und', 743, 143),
(18, '000000292856', 8.5, 16, 'Bionix IK 12 Cor 60', '\r', '1 und', 743, 143),
(19, '00000051', 9.9, 3, 'Ligadura Modular Amarelo', 'Amarelo\r', '500 und', 744, 142),
(20, '00000052', 9.9, 3, 'Ligadura Modular Azul Bebe', 'Azul bebe\r', '500 und', 744, 142),
(21, '00000053', 9.9, 5, 'Ligadura Modular Azul Celeste', 'Azul celeste\r', '500 und', 744, 142),
(22, '00000055', 9.9, 7, 'Ligadura Modular Azul Claro', 'Azul claro\r', '500 und', 744, 142),
(23, '00000056', 9.9, 4, 'Ligadura Modular Azul Cristal', 'Azul crisatal\r', '500 und', 744, 142),
(24, '00000057', 9.9, 6, 'Ligadura Modular Azul Jeans', 'Azul jeans\r', '500 und', 744, 142),
(25, '00000058', 9.9, 4, 'Ligadura Modular Azul Metalizado', 'Azul metalizado\r', '500 und', 744, 142),
(26, '00000059', 9.9, 3, 'Ligadura Modular Azul Royal', 'Azul royal\r', '500 und', 744, 142),
(27, '00000060', 9.9, 5, 'Ligadura Modular Branco', 'Branco\r', '500 und', 744, 142),
(28, '00000061', 9.9, 7, 'Ligadura Modular Cereja', 'Cereja\r', '500 und', 744, 142),
(29, '00000064', 9.9, 5, 'Ligadura Modular Laranja', 'Laranja\r', '500 und', 744, 142),
(30, '00000065', 9.9, 3, 'Ligadura Modular Laranja Escuro', 'Laranja escuro\r', '500 und', 744, 142),
(31, '00000066', 9.9, 3, 'Ligadura Modular Lilas', 'Lilas\r', '500 und', 744, 142),
(32, '00000068', 9.9, 3, 'Ligadura Modular Perola', 'Perola\r', '500 und', 744, 142),
(33, '00000071', 9.9, 3, 'Ligadura Modular Pink', 'Pink\r', '500 und', 744, 142),
(34, '00000072', 9.9, 3, 'Ligadura Modular Pink Escuro', 'Pink escuro\r', '500 und', 744, 142),
(35, '00000073', 9.9, 4, 'Ligadura Modular Prata', 'Prata\r', '500 und', 744, 142),
(36, '00000074', 9.9, 4, 'Ligadura Modular Preto', 'Preto', '500 und', 744, 142);

-- --------------------------------------------------------

--
-- Estrutura da tabela `slider`
--

CREATE TABLE `slider` (
  `id_slider` int(11) NOT NULL,
  `id_subgrupo` int(11) NOT NULL,
  `imagem` varchar(5000) DEFAULT NULL,
  `fundo` varchar(5000) DEFAULT NULL,
  `status` enum('1','0') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `subgrupo`
--

CREATE TABLE `subgrupo` (
  `id_subgrupo` int(11) NOT NULL,
  `nome` varchar(200) NOT NULL,
  `id_grupo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `subgrupo`
--

INSERT INTO `subgrupo` (`id_subgrupo`, `nome`, `id_grupo`) VALUES
(1, 'Banco esportivo', 19),
(2, 'Volante de competição', 19),
(3, 'abafador', 19),
(739, 'Implante', 1),
(740, 'Elastico', 2),
(741, 'Dente', 3),
(742, 'Insolante e cera', 4),
(743, 'Dente', 5),
(744, 'Elastico', 6);

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
(2, 'dental', 'dental', 'cde512dfb6937975382bb78607a1b2ec', 'dental@gmail.com', '2019-04-27 15:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carrinho`
--
ALTER TABLE `carrinho`
  ADD PRIMARY KEY (`id_carrinho`);

--
-- Indexes for table `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indexes for table `destaque`
--
ALTER TABLE `destaque`
  ADD PRIMARY KEY (`id_destaque`);

--
-- Indexes for table `estilo`
--
ALTER TABLE `estilo`
  ADD PRIMARY KEY (`id_estilo`);

--
-- Indexes for table `foto`
--
ALTER TABLE `foto`
  ADD PRIMARY KEY (`id_foto`);

--
-- Indexes for table `grupo`
--
ALTER TABLE `grupo`
  ADD PRIMARY KEY (`id_grupo`),
  ADD KEY `id_categoria` (`id_categoria`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`id_item`),
  ADD KEY `id_subgrupo` (`id_subgrupo`),
  ADD KEY `id_marca` (`id_marca`);

--
-- Indexes for table `itemcarrinho`
--
ALTER TABLE `itemcarrinho`
  ADD PRIMARY KEY (`id_itemcarrinho`),
  ADD KEY `id_produto` (`id_produto`),
  ADD KEY `id_carrinho` (`id_carrinho`);

--
-- Indexes for table `marca`
--
ALTER TABLE `marca`
  ADD PRIMARY KEY (`id_marca`);

--
-- Indexes for table `mensagem`
--
ALTER TABLE `mensagem`
  ADD PRIMARY KEY (`id_mensagem`);

--
-- Indexes for table `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`id_pedido`),
  ADD KEY `id_carrinho` (`id_carrinho`);

--
-- Indexes for table `produto`
--
ALTER TABLE `produto`
  ADD PRIMARY KEY (`id_produto`),
  ADD KEY `id_subgrupo` (`id_subgrupo`),
  ADD KEY `id_marca` (`id_marca`);

--
-- Indexes for table `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`id_slider`),
  ADD KEY `id_subgrupo` (`id_subgrupo`);

--
-- Indexes for table `subgrupo`
--
ALTER TABLE `subgrupo`
  ADD PRIMARY KEY (`id_subgrupo`),
  ADD KEY `id_grupo` (`id_grupo`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carrinho`
--
ALTER TABLE `carrinho`
  MODIFY `id_carrinho` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `destaque`
--
ALTER TABLE `destaque`
  MODIFY `id_destaque` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `estilo`
--
ALTER TABLE `estilo`
  MODIFY `id_estilo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `foto`
--
ALTER TABLE `foto`
  MODIFY `id_foto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `grupo`
--
ALTER TABLE `grupo`
  MODIFY `id_grupo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `id_item` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1527;
--
-- AUTO_INCREMENT for table `itemcarrinho`
--
ALTER TABLE `itemcarrinho`
  MODIFY `id_itemcarrinho` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `marca`
--
ALTER TABLE `marca`
  MODIFY `id_marca` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=144;
--
-- AUTO_INCREMENT for table `mensagem`
--
ALTER TABLE `mensagem`
  MODIFY `id_mensagem` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `pedido`
--
ALTER TABLE `pedido`
  MODIFY `id_pedido` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `produto`
--
ALTER TABLE `produto`
  MODIFY `id_produto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `slider`
--
ALTER TABLE `slider`
  MODIFY `id_slider` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `subgrupo`
--
ALTER TABLE `subgrupo`
  MODIFY `id_subgrupo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=745;
--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_user` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `grupo`
--
ALTER TABLE `grupo`
  ADD CONSTRAINT `id_categoria` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id_categoria`);

--
-- Limitadores para a tabela `itemcarrinho`
--
ALTER TABLE `itemcarrinho`
  ADD CONSTRAINT `id_produto` FOREIGN KEY (`id_produto`) REFERENCES `produto` (`id_produto`),
  ADD CONSTRAINT `itemcarrinho_ibfk_1` FOREIGN KEY (`id_carrinho`) REFERENCES `carrinho` (`id_carrinho`);

--
-- Limitadores para a tabela `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `id_carrinho` FOREIGN KEY (`id_carrinho`) REFERENCES `carrinho` (`id_carrinho`);

--
-- Limitadores para a tabela `produto`
--
ALTER TABLE `produto`
  ADD CONSTRAINT `id_subgrupo` FOREIGN KEY (`id_subgrupo`) REFERENCES `subgrupo` (`id_subgrupo`);

--
-- Limitadores para a tabela `slider`
--
ALTER TABLE `slider`
  ADD CONSTRAINT `slider_ibfk_1` FOREIGN KEY (`id_subgrupo`) REFERENCES `subgrupo` (`id_subgrupo`);

--
-- Limitadores para a tabela `subgrupo`
--
ALTER TABLE `subgrupo`
  ADD CONSTRAINT `id_grupo` FOREIGN KEY (`id_grupo`) REFERENCES `grupo` (`id_grupo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
