-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 14-Nov-2025 às 22:21
-- Versão do servidor: 10.4.22-MariaDB
-- versão do PHP: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `concessionaria`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `teste_drive`
--

CREATE TABLE `teste_drive` (
  `ID` int(11) NOT NULL,
  `tipo_veiculo` varchar(255) NOT NULL,
  `modelo` varchar(255) NOT NULL,
  `data` int(11) NOT NULL,
  `horario` int(11) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `tipo_conta` enum('cliente','admin') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`, `tipo_conta`) VALUES
(1, 'João Henrique', 'rabelo7@gmail.com', '$2y$10$eofuYQmEQlyRtbqe95ZH/ObvJD4uOaTyUFV5jNG2spri4h8aWZnj.', 'cliente'),
(2, 'Teste', 'teste@gmail.com', '$2y$10$jM9VNkY1rAQAz0uuFU7z5OmQ2IUO7dKqanCItvGtf0M0VNuruzdvO', 'admin'),
(3, 'Teste', 'rabelo1@gmail.com', '$2y$10$m2fjkIVttjqcbfuOROMkoOLBD.b7W52jbp2QQqwPYBDW72M4TWjpa', 'cliente');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `teste_drive`
--
ALTER TABLE `teste_drive`
  ADD PRIMARY KEY (`ID`);

--
-- Índices para tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `teste_drive`
--
ALTER TABLE `teste_drive`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
