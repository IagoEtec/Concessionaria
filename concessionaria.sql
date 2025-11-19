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

-- Cria o banco de dados se não existir
CREATE DATABASE IF NOT EXISTS `concessionaria`;
USE `concessionaria`;

-- --------------------------------------------------------

--
-- Tabela para armazenar usuários do sistema
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `tipo_conta` enum('cliente','admin') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dados de exemplo para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`, `tipo_conta`) VALUES
(1, 'João Henrique', 'rabelo7@gmail.com', '$2y$10$eofuYQmEQlyRtbqe95ZH/ObvJD4uOaTyUFV5jNG2spri4h8aWZnj.', 'cliente'),
(2, 'Administrador', 'admin@gmail.com', '$2y$10$jM9VNkY1rAQAz0uuFU7z5OmQ2IUO7dKqanCItvGtf0M0VNuruzdvO', 'admin'),
(3, 'Cliente Teste', 'cliente@gmail.com', '$2y$10$m2fjkIVttjqcbfuOROMkoOLBD.b7W52jbp2QQqwPYBDW72M4TWjpa', 'cliente');

-- --------------------------------------------------------

--
-- Tabela para armazenar veículos da concessionária
--

CREATE TABLE `veiculos` (
  `id` int(11) NOT NULL,
  `tipo` enum('carro','moto') NOT NULL,
  `modelo` varchar(255) NOT NULL,
  `imagem` varchar(500) NOT NULL,
  `descricao` text NOT NULL,
  `data_cadastro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dados de exemplo para a tabela `veiculos`
--

INSERT INTO `veiculos` (`id`, `tipo`, `modelo`, `imagem`, `descricao`) VALUES
(1, 'carro', 'Honda Civic', 'civic.jpg', 'Carro esportivo com ótimo desempenho'),
(2, 'carro', 'Toyota Corolla', 'corolla.jpg', 'Carro familiar confortável'),
(3, 'moto', 'Honda CB 500', 'cb500.jpg', 'Moto ideal para cidade e estrada');

-- --------------------------------------------------------

--
-- Tabela para armazenar agendamentos de test drive
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tabelas
--

--
-- Índices para tabela `teste_drive`
--
ALTER TABLE `teste_drive`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_veiculo` (`id_veiculo`);

--
-- Índices para tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Índices para tabela `veiculos`
--
ALTER TABLE `veiculos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas
--

--
-- AUTO_INCREMENT para tabela `teste_drive`
--
ALTER TABLE `teste_drive`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT para tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT para tabela `veiculos`
--
ALTER TABLE `veiculos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restrições para tabelas
--

--
-- Restrições para tabela `teste_drive`
--
ALTER TABLE `teste_drive`
  ADD CONSTRAINT `teste_drive_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `teste_drive_ibfk_2` FOREIGN KEY (`id_veiculo`) REFERENCES `veiculos` (`id`) ON DELETE CASCADE;

COMMIT;