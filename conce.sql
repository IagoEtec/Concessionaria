-- Criar o banco de dados
CREATE DATABASE IF NOT EXISTS conce CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE conce;

-- Tabela de login (credenciais)
CREATE TABLE IF NOT EXISTS login (
  idlog INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) NOT NULL UNIQUE,
  email VARCHAR(100) NOT NULL UNIQUE,
  senha VARCHAR(255) NOT NULL, -- senha armazenada com hash
  tipo ENUM('cliente', 'atendente') DEFAULT 'cliente',
  criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Perfil do usuário
CREATE TABLE IF NOT EXISTS perfil_user (
  iduser INT AUTO_INCREMENT PRIMARY KEY,
  idlog INT NOT NULL,
  nome_user VARCHAR(220) NOT NULL,
  cpf VARCHAR(50),
  celular VARCHAR(30),
  carros TEXT,
  qtd_carro INT DEFAULT 0,
  motos TEXT,
  qnt_moto INT DEFAULT 0,
  FOREIGN KEY (idlog) REFERENCES login(idlog) ON DELETE CASCADE
);

-- Tabela de carros (catálogo)
CREATE TABLE IF NOT EXISTS carros (
  idcar INT AUTO_INCREMENT PRIMARY KEY,
  titulo VARCHAR(120) NOT NULL,
  descricao TEXT,
  imagem VARCHAR(255),
  disponivel TINYINT(1) DEFAULT 1,
  disponivel_test_drive TINYINT(1) DEFAULT 1,
  criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabela para agendamentos de test drive
CREATE TABLE IF NOT EXISTS test_drives (
  id INT AUTO_INCREMENT PRIMARY KEY,
  id_cliente INT NOT NULL,
  id_carro INT NOT NULL,
  data_agendamento DATETIME NOT NULL,
  status ENUM('pendente', 'aprovado', 'negado') DEFAULT 'pendente',
  criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (id_cliente) REFERENCES login(idlog) ON DELETE CASCADE,
  FOREIGN KEY (id_carro) REFERENCES carros(idcar) ON DELETE CASCADE
);

-- Inserindo todos os 6 carros de exemplo COM DESCRIÇÕES DETALHADAS
INSERT INTO carros (titulo, descricao, imagem) VALUES
('Honda Civic Type-R', 'O Honda Civic Type-R é a versão mais extrema do Civic, equipado com um motor 2.0L VTEC Turbo que produz 320 cv. Com tração dianteira e câmbio manual de 6 velocidades, oferece performance excepcional com aerodinâmica agressiva, incluindo um grande spoiler traseiro e detalhes em vermelho que destacam seu caráter esportivo. Interior com bancos esportivos Recaro e tecnologia Honda CONNECT.', 'car1.jpg'),
('Mitsubishi Lancer Evolution', 'Lenda dos ralis, o Lancer Evolution X conta com motor 2.0L MIVEC Turbo de 300 cv e tração integral S-AWC (Super All Wheel Control). Sistema de transmissão Twin-Clutch SST de 6 velocidades ou manual. Suspensão Bilstein, freios Brembo e diferencial traseiro ativo. Design agressivo com capô com entradas de ar e aerofólio característico.', 'car2.jpg'),
('Chevrolet Corvette Stingray', 'O Corvette Stingray C8 revoluciona com motor central V8 6.2L LT2 que entrega 495 cv. Primeiro Corvette com motor central na história. Aceleração 0-100 km/h em 2.9 segundos. Câmbio automatizado de 8 velocidades, chassis de fibra de carbono e modos de condução que incluem Weather, Tour, Sport e Track. Interior premium com materiais de alta qualidade.', 'car3.jpg'),
('Volkswagen Golf GTI', 'Ícone dos hot hatches, o Golf GTI possui motor 2.0L TSI de 245 cv com câmbio DSG de 7 velocidades ou manual de 6. Suspensão esportiva, diferencial de escorregamento limitado eletrônico VAQ e modo Race. Design com detalhes em vermelho, grades GTI específicas e rodas de 18". Interior com bancos xadrez tartan e volante plano multifuncional.', 'car4.jpg'),
('Subaru Impreza WRX STI', 'O Subaru Impreza WRX STI é uma lenda do mundo dos rallys, equipado com motor boxer EJ25 2.5L turbo de 305 cv e tração integral Symmetrical AWD. Sistema de controle de tração DCCD (Driver Controlled Center Differential), suspensão esportiva Bilstein, freios Brembo de 6 pistões e diferencial traseiro de deslizamento limitado. Câmbio manual de 6 velocidades de curso curto. Design icônico com grande spoiler traseiro, capô com intercooler e saídas de ar características. Interior com bancos esportivos Recaro, volante achatado e instrumentação completa com tacômetro proeminente.', 'car5.jpg'),
('BMW E36 M3', 'O BMW E36 M3 é um ícone dos esportivos alemães, movido pelo motor S50B32 3.2L inline-6 que produz 321 cv. Câmbio manual de 6 velocidades ou SMG de primeira geração, tração traseira com diferencial de deslizamento limitado. Suspensão M específica com amortecedores esportivos, freios ventilados de grande diâmetro e direção de assistência variável. Design clássico dos anos 90 com para-choques específicos, saias laterais e teto solar elétrico. Interior em couro Nappa, bancos esportivos M com ajustes elétricos e painel de instrumentos com mostradores M. Considerado um dos melhores handling cars de todos os tempos.', 'car6.jpg');

-- Inserir um usuário atendente de exemplo
INSERT INTO login (username, email, senha, tipo) VALUES 
('atendente', 'atendente@selectcar.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'atendente');
-- senha: password