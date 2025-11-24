-- phpMyAdmin SQL Dump
-- Arquivo da concessionária de veículos - Versão Corrigida

-- Configurações iniciais do MySQL
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- Cria o banco de dados se não existir
CREATE DATABASE IF NOT EXISTS `concessionaria` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `concessionaria`;

-- Apaga tabelas velhas que não vamos usar mais
DROP TABLE IF EXISTS `admin`;
DROP TABLE IF EXISTS `cliente`;
DROP TABLE IF EXISTS `test_drive`;

-- --------------------------------------------------------

--
-- Tabela dos usuários do sistema (clientes e administradores)
-- Aqui guardamos todos que vão usar o sistema
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,  -- Número único pra cada usuário
  `nome` varchar(255) NOT NULL,  -- Nome da pessoa
  `email` varchar(255) NOT NULL,  -- Email pra login
  `senha` varchar(255) NOT NULL,  -- Senha criptografada
  `tipo_conta` enum('cliente','admin') NOT NULL  -- Se é cliente ou administrador
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Colocando alguns usuários de exemplo no sistema
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`, `tipo_conta`) VALUES
(1, 'João Henrique', 'rabelo7@gmail.com', '$2y$10$eofuYQmEQlyRtbqe95ZH/ObvJD4uOaTyUFV5jNG2spri4h8aWZnj.', 'cliente'),
(2, 'Administrador', 'admin@gmail.com', '$2y$10$jM9VNkY1rAQAz0uuFU7z5OmQ2IUO7dKqanCItvGtf0M0VNuruzdvO', 'admin'),
(3, 'Cliente Teste', 'cliente@gmail.com', '$2y$10$m2fjkIVttjqcbfuOROMkoOLBD.b7W52jbp2QQqwPYBDW72M4TWjpa', 'cliente');

-- --------------------------------------------------------

--
-- Tabela dos veículos da concessionária
-- Aqui a gente cadastra todos os carros e motos pra venda
--

CREATE TABLE `veiculos` (
  `id` int(11) NOT NULL,  -- Número único pra cada veículo
  `tipo` enum('carro','moto') NOT NULL,  -- Se é carro ou moto
  `marca` varchar(255) NOT NULL,  -- Marca do veículo (Honda, Toyota, etc)
  `modelo` varchar(255) NOT NULL,  -- Modelo do veículo (Civic, Corolla, etc)
  `ano` int(11) NOT NULL,  -- Ano do veículo
  `imagem` varchar(500) NOT NULL,  -- Foto do veículo
  `descricao` text NOT NULL,  -- Descrição do veículo
  `disponivel` tinyint(1) NOT NULL DEFAULT 1,  -- Se tá disponível pra venda (1 = sim, 0 = não)
  `data_cadastro` timestamp NOT NULL DEFAULT current_timestamp()  -- Data que cadastrou o veículo
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Cadastrando alguns veículos de exemplo
--

INSERT INTO `veiculos` (`id`, `tipo`, `marca`, `modelo`, `ano`, `imagem`, `descricao`, `disponivel`) VALUES
(1, 'carro', 'Honda', 'Civic', 2023, 'civic.jpg', 'Carro esportivo com ótimo desempenho', 1),
(2, 'carro', 'Toyota', 'Corolla', 2024, 'corolla.jpg', 'Carro familiar confortável', 1),
(3, 'moto', 'Honda', 'CB 500', 2023, 'cb500.jpg', 'Moto ideal para cidade e estrada', 1);

-- --------------------------------------------------------

--
-- Tabela dos agendamentos de test drive
-- Aqui os clientes marcam quando querem testar os veículos
--

CREATE TABLE `test_drives` (
  `id` int(11) NOT NULL,  -- Número único pra cada agendamento
  `id_usuario` int(11) NOT NULL,  -- Qual usuário tá agendando (liga com a tabela usuarios)
  `id_veiculo` int(11) NOT NULL,  -- Qual veículo ele quer testar (liga com a tabela veiculos)
  `data_agendamento` date NOT NULL,  -- Data que ele marcou pro test drive
  `horario_agendamento` time NOT NULL,  -- Horário que ele marcou
  `status` enum('pendente','confirmado','cancelado','realizado') NOT NULL DEFAULT 'pendente',  -- Como tá o agendamento
  `data_solicitacao` timestamp NOT NULL DEFAULT current_timestamp()  -- Quando ele fez o pedido
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Aqui a gente configura as chaves primárias (as chaves principais das tabelas)
-- É isso que faz cada registro ser único
--

-- Tabela usuarios
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),  -- id é a chave principal
  ADD UNIQUE KEY `email` (`email`);  -- email não pode repetir

-- Tabela veiculos
ALTER TABLE `veiculos`
  ADD PRIMARY KEY (`id`);  -- id é a chave principal

-- Tabela test_drives
ALTER TABLE `test_drives`
  ADD PRIMARY KEY (`id`),  -- id é a chave principal
  ADD KEY `id_usuario` (`id_usuario`),  -- índice pra buscar rápido por usuário
  ADD KEY `id_veiculo` (`id_veiculo`);  -- índice pra buscar rápido por veículo

--
-- Aqui a gente configura os auto incrementos
-- Isso faz o número id aumentar automaticamente quando add novo registro
--

ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;  -- Começa no 4 pq já temos 3 usuarios

ALTER TABLE `veiculos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;  -- Começa no 4 pq já temos 3 veiculos

ALTER TABLE `test_drives`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;  -- Começa no 1 pq não temos agendamentos ainda

--
-- Aqui a gente configura as relações entre as tabelas
-- Isso garante que não vamos agendar test drive com usuário ou veículo que não existe
--

ALTER TABLE `test_drives`
  ADD CONSTRAINT `test_drives_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `test_drives_ibfk_2` FOREIGN KEY (`id_veiculo`) REFERENCES `veiculos` (`id`) ON DELETE CASCADE;
  -- ON DELETE CASCADE significa que se apagar usuário ou veículo, apaga os test drives também

-- Finaliza a transação
COMMIT;