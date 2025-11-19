-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 19/11/2025 às 20:51
-- Versão do servidor: 10.4.28-MariaDB
-- Versão do PHP: 8.2.4

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
-- Estrutura para tabela `admin`
--

CREATE TABLE `admin` (
  `ID_admin` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `cliente`
--

CREATE TABLE `cliente` (
  `ID_cliente` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `teste_drive`
--

CREATE TABLE `teste_drive` (
  `id` int(11) NOT NULL,
  `tipo_veiculo` varchar(255) NOT NULL,
  `modelo` varchar(255) NOT NULL,
  `data` date NOT NULL,
  `horario` time NOT NULL,
  `status` enum('pendente','confirmado','cancelado','realizado') NOT NULL DEFAULT 'pendente',
  `id_usuario` int(11) NOT NULL,
  `id_veiculo` int(11) NOT NULL,
  `data_agendamento` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `test_drive`
--

CREATE TABLE `test_drive` (
  `ID` int(11) NOT NULL,
  `data` int(11) NOT NULL,
  `horario` int(11) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `tipo_conta` enum('cliente','admin') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`, `tipo_conta`) VALUES
(1, 'João Henrique', 'rabelo7@gmail.com', '$2y$10$eofuYQmEQlyRtbqe95ZH/ObvJD4uOaTyUFV5jNG2spri4h8aWZnj.', 'cliente'),
(2, 'Administrador', 'admin@gmail.com', '$2y$10$jM9VNkY1rAQAz0uuFU7z5OmQ2IUO7dKqanCItvGtf0M0VNuruzdvO', 'admin'),
(3, 'Cliente Teste', 'cliente@gmail.com', '$2y$10$m2fjkIVttjqcbfuOROMkoOLBD.b7W52jbp2QQqwPYBDW72M4TWjpa', 'cliente');

-- --------------------------------------------------------

--
-- Estrutura para tabela `veiculo`
--

CREATE TABLE `veiculo` (
  `ID_veiculo` int(11) NOT NULL,
  `modelo_carro` varchar(255) NOT NULL,
  `modelo_moto` varchar(255) NOT NULL,
  `marca_carro` varchar(255) NOT NULL,
  `marca_moto` varchar(255) NOT NULL,
  `disponibilidade` varchar(255) NOT NULL,
  `ano` int(11) NOT NULL,
  `imagem` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `veiculos`
--

CREATE TABLE `veiculos` (
  `id` int(11) NOT NULL,
  `tipo` enum('carro','moto') NOT NULL,
  `modelo` varchar(255) NOT NULL,
  `imagem` varchar(500) NOT NULL,
  `descricao` text NOT NULL,
  `data_cadastro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `veiculos`
--

INSERT INTO `veiculos` (`id`, `tipo`, `modelo`, `imagem`, `descricao`, `data_cadastro`) VALUES
(1, 'carro', 'Honda Civic', 'civic.jpg', 'Carro esportivo com ótimo desempenho', '2025-11-19 18:11:58'),
(2, 'carro', 'Toyota Corolla', 'corolla.jpg', 'Carro familiar confortável', '2025-11-19 18:11:58'),
(3, 'moto', 'Honda CB 500', 'cb500.jpg', 'Moto ideal para cidade e estrada', '2025-11-19 18:11:58');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`ID_admin`);

--
-- Índices de tabela `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`ID_cliente`);

--
-- Índices de tabela `teste_drive`
--
ALTER TABLE `teste_drive`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_veiculo` (`id_veiculo`);

--
-- Índices de tabela `test_drive`
--
ALTER TABLE `test_drive`
  ADD PRIMARY KEY (`ID`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Índices de tabela `veiculo`
--
ALTER TABLE `veiculo`
  ADD PRIMARY KEY (`ID_veiculo`);

--
-- Índices de tabela `veiculos`
--
ALTER TABLE `veiculos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `admin`
--
ALTER TABLE `admin`
  MODIFY `ID_admin` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `cliente`
--
ALTER TABLE `cliente`
  MODIFY `ID_cliente` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `teste_drive`
--
ALTER TABLE `teste_drive`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `test_drive`
--
ALTER TABLE `test_drive`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `veiculo`
--
ALTER TABLE `veiculo`
  MODIFY `ID_veiculo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `veiculos`
--
ALTER TABLE `veiculos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `teste_drive`
--
ALTER TABLE `teste_drive`
  ADD CONSTRAINT `teste_drive_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `teste_drive_ibfk_2` FOREIGN KEY (`id_veiculo`) REFERENCES `veiculos` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
