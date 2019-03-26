-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 21-Mar-2019 às 21:18
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
(6, 'Equipamentos', 'Equipamentos e acessórios odontológicos para o seu consultório disponíveis para venda.', 'https://conteudo.imguol.com.br/blogs/125/files/2016/10/utensilios-e-equipamentos-de-dentista-odontologia-broca-espatula-1452201753205_1920x1127.jpg'),
(7, 'Ortodontia', 'A categoria não possui descrição.', 'https://www.sindicatometal.org.br/wp-content/uploads/2018/02/ortodontia-e1517842522535-860x450_c.png'),
(8, 'Dentística', 'A categoria não possui descrição.', 'http://funbeo.com.br/wp-content/uploads/2017/07/Odontologia-Este%CC%81tica-825x510.jpg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `destaque`
--

CREATE TABLE `destaque` (
  `id_destaque` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `id_categoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `destaque`
--

INSERT INTO `destaque` (`id_destaque`, `nome`, `id_categoria`) VALUES
(1, 'Promoção Especial Dia dos Pais Dental', 5);

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
  `id_categoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `grupo`
--

INSERT INTO `grupo` (`id_grupo`, `nome`, `id_categoria`) VALUES
(15, 'Acessórios', 6),
(16, 'Peças de mão', 6),
(17, 'Raio X', 6),
(19, 'Acessórios Ortodônticos', 7),
(20, 'Adesivos para braquetes', 7),
(21, 'Afastadores Labiais', 7),
(22, 'Alicates', 7),
(23, 'Arcos Braided', 7),
(24, 'Arcos Curva Reversa', 7),
(25, 'Arcos de Aço', 7),
(26, 'Arcos de Niti Copper', 7),
(27, 'Arcos de Niti Superelástico', 7),
(28, 'Arcos de Niti Termoativado', 7),
(29, 'Arcos Estéticos', 7),
(30, 'Bandas Inferiores com Tubos', 7);

-- --------------------------------------------------------

--
-- Estrutura da tabela `itemcarrinho`
--

CREATE TABLE `itemcarrinho` (
  `id_itemcarrinho` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `precoitem` float NOT NULL,
  `id_carrinho` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `marca`
--

CREATE TABLE `marca` (
  `id_marca` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `imagem` varchar(5000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `marca`
--

INSERT INTO `marca` (`id_marca`, `nome`, `imagem`) VALUES
(1, 'Marca de Teste', 'https://vandal-us.s3.amazonaws.com/spree/products/49846/original/open-uri20181203-14-1jczs.jpg'),
(2, 'Puma', 'http://pluspng.com/img-png/puma-png-puma-png-240.png'),
(3, 'qwert', 'https://logodownload.org/wp-content/uploads/2014/04/nike-logo-1.png');

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
  `data` int(11) NOT NULL,
  `status` enum('0','1') NOT NULL,
  `id_carrinho` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto`
--

CREATE TABLE `produto` (
  `id_produto` int(11) NOT NULL,
  `barcode` varchar(50) NOT NULL,
  `preco` varchar(10) NOT NULL,
  `estoque` int(11) NOT NULL,
  `especificacao` varchar(500) NOT NULL,
  `id_subgrupo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `produto`
--

INSERT INTO `produto` (`id_produto`, `barcode`, `preco`, `estoque`, `especificacao`, `id_subgrupo`) VALUES
(1, '33287500', '57.90', 38, 'Azul de Tamanho numero 25 e Superior', 1),
(2, '44445555', '39.90', 34, 'Azul e tamanho 12', 2),
(3, '43682337', '50.60', 23, 'Amarelo com bolinhas marrons', 3),
(4, '43682338', '50.60', 31, 'Azul com bolinhas marrons', 3),
(5, '43682339', '40.60', 34, 'Verde com bolinhas pretas', 3),
(6, '436576854', '85.00', 56, 'Alicate 053 Meia Cana', 4),
(7, '2354326', '85.00', 85, 'ALICATE 001 NANCE', 4),
(8, '2356456', '85.00', 45, 'ALICATE 074 YOUNG', 4);

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

--
-- Extraindo dados da tabela `slider`
--

INSERT INTO `slider` (`id_slider`, `id_subgrupo`, `imagem`, `fundo`, `status`) VALUES
(2, 3, 'https://2.bp.blogspot.com/-Cb7NZAenJA4/VR3Y-FZnpdI/AAAAAAAAbps/9ND-JUqQF_I/s1600/Girafa.png', 'https://static.todamateria.com.br/upload/54/e2/54e2921595b9c-savanas.jpg', '1'),
(3, 2, 'http://www.stickpng.com/assets/images/5897a333cba9841eabab613e.png', '', '1'),
(6, 1, 'http://4.bp.blogspot.com/-VOg1Fxz_aDk/VUaul7ThU5I/AAAAAAAAFV8/0VmFpaypg7k/s1600/gatito.png', 'https://www.casaparaviver.com.br/wp-content/uploads/2017/10/brinquedo-gato1.jpeg', '1');

-- --------------------------------------------------------

--
-- Estrutura da tabela `subgrupo`
--

CREATE TABLE `subgrupo` (
  `id_subgrupo` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `descricao` varchar(5000) NOT NULL,
  `imagem` varchar(5000) NOT NULL,
  `destaque` enum('1','0') NOT NULL,
  `id_grupo` int(11) NOT NULL,
  `id_marca` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `subgrupo`
--

INSERT INTO `subgrupo` (`id_subgrupo`, `nome`, `descricao`, `imagem`, `destaque`, `id_grupo`, `id_marca`) VALUES
(1, 'Elástico Dental para Gatos', 'O melhor elástico dental para gatos disponibilizado pela marca Puma', 'https://meusanimais.com.br/wp-content/uploads/2015/03/chocalho-gato.jpg', '0', 15, 2),
(2, 'Elástico Dental para Cavalos', 'O melhor elastico', 'https://ae01.alicdn.com/kf/HTB1ebTLodfJ8KJjy0Feq6xKEXXaG/100-cm-USB-Cobrado-Decora-o-Tubos-Luminosos-LED-Rabos-de-Cavalo-Rabo-de-Cavalo-Equita.jpg_640x640.jpg', '0', 15, 3),
(3, 'Elástico Dental para Girafas', 'No entanto, não podemos esquecer que a execução dos pontos do programa assume importantes posições no estabelecimento dos índices pretendidos. Caros amigos, o comprometimento entre as equipes ainda não demonstrou convincentemente que vai participar na mudança do impacto na agilidade decisória. Do mesmo modo, a valorização de fatores subjetivos nos obriga à análise das condições inegavelmente apropriadas. Nunca é demais lembrar o peso e o significado destes problemas, uma vez que a necessidade de renovação processual desafia a capacidade de equalização das posturas dos órgãos dirigentes com relação às suas atribuições. Assim mesmo, o início da atividade geral de formação de atitudes pode nos levar a considerar a reestruturação das diretrizes de desenvolvimento para o futuro. ', 'https://abrilsuperinteressante.files.wordpress.com/2016/09/super_imggirafa.jpg', '0', 15, 2),
(4, 'ICE', 'Produto sem descrição.', 'http://www.dentallivramento.com.br/fotos/7898475422716.jpg', '0', 22, 1);

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
-- Indexes for table `grupo`
--
ALTER TABLE `grupo`
  ADD PRIMARY KEY (`id_grupo`),
  ADD KEY `id_categoria` (`id_categoria`);

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
  ADD KEY `id_subgrupo` (`id_subgrupo`);

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
-- AUTO_INCREMENT for table `carrinho`
--
ALTER TABLE `carrinho`
  MODIFY `id_carrinho` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `destaque`
--
ALTER TABLE `destaque`
  MODIFY `id_destaque` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `estilo`
--
ALTER TABLE `estilo`
  MODIFY `id_estilo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `grupo`
--
ALTER TABLE `grupo`
  MODIFY `id_grupo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `itemcarrinho`
--
ALTER TABLE `itemcarrinho`
  MODIFY `id_itemcarrinho` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `marca`
--
ALTER TABLE `marca`
  MODIFY `id_marca` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pedido`
--
ALTER TABLE `pedido`
  MODIFY `id_pedido` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `produto`
--
ALTER TABLE `produto`
  MODIFY `id_produto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `slider`
--
ALTER TABLE `slider`
  MODIFY `id_slider` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `subgrupo`
--
ALTER TABLE `subgrupo`
  MODIFY `id_subgrupo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_user` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  ADD CONSTRAINT `id_grupo` FOREIGN KEY (`id_grupo`) REFERENCES `grupo` (`id_grupo`),
  ADD CONSTRAINT `id_marca` FOREIGN KEY (`id_marca`) REFERENCES `marca` (`id_marca`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;