-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 18-Mar-2019 às 22:50
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
(3, 2, 'http://www.stickpng.com/assets/images/5897a333cba9841eabab613e.png', 'data:image/jpeg;base64,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', '1'),
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
-- Indexes for table `marca`
--
ALTER TABLE `marca`
  ADD PRIMARY KEY (`id_marca`);

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
-- AUTO_INCREMENT for table `marca`
--
ALTER TABLE `marca`
  MODIFY `id_marca` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
