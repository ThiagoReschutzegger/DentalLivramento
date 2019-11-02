-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 02-Nov-2019 às 03:04
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
-- Estrutura da tabela `subgrupo_selecionado`
--

CREATE TABLE `subgrupo_selecionado` (
  `id_selecionado` int(11) NOT NULL,
  `id_subgrupo` int(11) NOT NULL,
  `imagem` varchar(5000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `subgrupo_selecionado`
--

INSERT INTO `subgrupo_selecionado` (`id_selecionado`, `id_subgrupo`, `imagem`) VALUES
(1, 602, 'https://c1.wallpaperflare.com/preview/293/349/287/dentist-toothbrush-dental-care-hygiene.jpg'),
(2, 496, 'https://www.loudwallpapers.com/wp-content/uploads/2019/09/dentist-sample-teeth.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `subgrupo_selecionado`
--
ALTER TABLE `subgrupo_selecionado`
  ADD PRIMARY KEY (`id_selecionado`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `subgrupo_selecionado`
--
ALTER TABLE `subgrupo_selecionado`
  MODIFY `id_selecionado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
