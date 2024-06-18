-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 19/06/2024 às 00:52
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
-- Banco de dados: `cadastro`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `cliente`
--

CREATE TABLE `cliente` (
  `cliente_id` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `endereco` varchar(255) DEFAULT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `data_nasc` date DEFAULT NULL,
  `cpf` varchar(14) DEFAULT NULL,
  `numero_cartao` varchar(255) NOT NULL,
  `cep` varchar(20) DEFAULT NULL,
  `numero` varchar(20) DEFAULT NULL,
  `cidade` varchar(100) DEFAULT NULL,
  `estado` varchar(50) DEFAULT NULL,
  `complemento` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `cliente`
--

INSERT INTO `cliente` (`cliente_id`, `usuario_id`, `nome`, `email`, `endereco`, `telefone`, `data_nasc`, `cpf`, `numero_cartao`, `cep`, `numero`, `cidade`, `estado`, `complemento`) VALUES
(6, 7, 'Diogo lopes', 'diogolopes@hotmail.com', 'Rua da luz', '21-98173-6999', '2000-02-21', '143.451.287-29', '1111.2222.3333.5555', NULL, NULL, NULL, NULL, NULL),
(14, 18, 'Shay', 'shay@hotmail.com', 'Rua Pedra do Sino', '21-98173-6968', '2024-03-29', '143.451.287-27', '5668.9663.3322.5554', '23585-270', '287', 'Rio de Janeiro', 'RJ', 'Portao preto'),
(16, 20, 'pedro vieira', 'pedrovieira@hotmail.com', 'Rua vieras', '21981736968', '2024-02-21', '142.451.297-22', '1111.2222.3333.4444', '23585270', '287', 'Rio de janeiro', 'Rj', 'Qd 26 lt 60'),
(17, 22, 'aline', 'aline@hotmail.com', 'campo grande', '34096806', '1992-08-11', '142.452.297-27', '7896.3698.1236.7896', NULL, NULL, NULL, NULL, NULL),
(21, 25, 'vitor', 'vitor@hotmail.com', 'Rua Pedra do Sino', '21981736968', '2023-12-13', '143.451.287-27', '1111.2222.3333.5555', NULL, NULL, NULL, NULL, NULL),
(22, 26, 'leticia matins', 'leticia@hotmail.com', 'Rua Pedra do Sino', '21-98173-6968', '2024-04-03', '142.451.297-50', '1111.2222.3333.4444', '23585-270', '70', 'Rio de Janeiro', 'RJ', 'QD 69 Lt 26'),
(23, 27, 'miguel', 'miguel@hotmail.com', 'Rua Pedra do Sino', '21981736968', '2024-04-05', '183.451.287-27', '', NULL, NULL, NULL, NULL, NULL),
(24, 29, 'André', 'andre@hormail.com', 'Paciencia', '2-13409-6806', '1992-08-11', '159.123.654-78', '', NULL, NULL, NULL, NULL, NULL),
(25, 34, 'joao', 'joao@hotmail', 'Rua Pedra do Sino', '21-99999-9999', '1992-09-11', '142.451.297-27', '', '23585-270', '30', 'Rio de Janeiro', 'RJ', 'sn');

-- --------------------------------------------------------

--
-- Estrutura para tabela `detalhes_pedido`
--

CREATE TABLE `detalhes_pedido` (
  `id` int(11) NOT NULL,
  `pedido_id` int(11) DEFAULT NULL,
  `produto_id` int(11) DEFAULT NULL,
  `quantidade` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `detalhes_pedido`
--

INSERT INTO `detalhes_pedido` (`id`, `pedido_id`, `produto_id`, `quantidade`) VALUES
(35, 41, 41, 2),
(36, 41, 44, 1),
(37, 43, 41, 2),
(38, 43, 44, 1),
(39, 44, 41, 1),
(40, 45, 41, 1),
(41, 47, 41, 1),
(42, 48, 41, 1),
(43, 49, 41, 2),
(44, 50, 41, 2),
(45, 51, 41, 2),
(46, 52, 44, 3),
(47, 53, 40, 1),
(48, 53, 46, 1),
(49, 54, 40, 1),
(50, 54, 45, 1),
(51, 54, 44, 28),
(52, 55, 40, 1),
(53, 56, 41, 1),
(54, 56, 44, 1),
(55, 56, 40, 1),
(56, 57, 44, 1),
(57, 58, 41, 1),
(58, 58, 40, 2),
(59, 59, 41, 1),
(60, 60, 41, 1),
(61, 60, 40, 1),
(62, 61, 41, 1),
(63, 62, 40, 1),
(64, 63, 41, 2),
(65, 64, 50, 1),
(66, 64, 41, 1),
(67, 65, 41, 1),
(68, 66, 41, 2),
(69, 67, 40, 2),
(70, 68, 51, 1),
(71, 69, 41, 1),
(72, 70, 41, 1),
(73, 71, 41, 1),
(74, 72, 41, 3),
(75, 72, 40, 3),
(76, 73, 41, 3),
(77, 73, 40, 4),
(78, 74, 41, 3),
(79, 74, 40, 4),
(80, 75, 41, 0),
(81, 75, 40, 0),
(82, 76, 41, 3),
(83, 76, 40, 4),
(84, 77, 41, 3),
(85, 77, 40, 4),
(86, 78, 41, 3),
(87, 78, 40, 4),
(88, 79, 40, 13),
(89, 80, 41, 1),
(90, 81, 41, 1),
(91, 82, 44, 1),
(92, 83, 44, 1),
(93, 83, 41, 1),
(94, 84, 41, 2),
(95, 85, 44, 1),
(96, 86, 41, 1),
(97, 87, 40, 1),
(98, 88, 41, 1),
(99, 88, 40, 1),
(100, 89, 41, 1),
(101, 90, 41, 1),
(102, 90, 46, 1),
(103, 90, 45, 1),
(104, 90, 51, 1),
(105, 91, 40, 1),
(106, 92, 41, 2),
(107, 94, 44, 1),
(108, 95, 40, 4),
(109, 96, 40, 4),
(110, 97, 40, 4),
(111, 98, 40, 2);

-- --------------------------------------------------------

--
-- Estrutura para tabela `funcionario`
--

CREATE TABLE `funcionario` (
  `funcionario_id` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `cpf` int(11) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `cargo` varchar(100) DEFAULT NULL,
  `salario` decimal(10,2) DEFAULT NULL,
  `matricula` varchar(20) DEFAULT NULL,
  `data_contratacao` date DEFAULT NULL,
  `endereco` varchar(255) NOT NULL,
  `cep` varchar(20) DEFAULT NULL,
  `numero` varchar(20) DEFAULT NULL,
  `cidade` varchar(100) DEFAULT NULL,
  `estado` varchar(50) DEFAULT NULL,
  `complemento` varchar(100) DEFAULT NULL,
  `administrador` tinyint(1) NOT NULL DEFAULT 0
) ;

--
-- Despejando dados para a tabela `funcionario`
--

INSERT INTO `funcionario` (`funcionario_id`, `usuario_id`, `nome`, `cpf`, `email`, `cargo`, `salario`, `matricula`, `data_contratacao`, `endereco`, `cep`, `numero`, `cidade`, `estado`, `complemento`, `administrador`) VALUES
(10, 8, 'Átila Vieira', 142451, 'atilavieiralopes@hotmail.com', 'Analista TI', 3.00, '22222', '2024-02-02', 'Rua Pedra do Sino', NULL, NULL, NULL, NULL, NULL, 1),
(15, 33, 'aline sousa', 142451, 'alinesouza@hotmail.com', 'Auxiliar de Marketing', 3.00, '66666', '2024-05-07', 'Rua Pedra do Sino', '23585-270', '28721', 'Rio de Janeiro', 'RJ', 'QD69 Lt26', 0),
(16, 35, 'bruno', 320874, 'brunolopes@hotmail.com', 'Atendente de Atendimentos ao Cliente', 3.00, '68924', '2021-01-08', 'Rua Pedra do Sino', '23585-270', '50', 'Rio de Janeiro', 'RJ', 'Portao preto', 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `pagamento`
--

CREATE TABLE `pagamento` (
  `id` int(11) NOT NULL,
  `pedido_id` int(11) DEFAULT NULL,
  `valor` decimal(10,2) DEFAULT NULL,
  `data_pagamento` date DEFAULT NULL,
  `metodo_pagamento` varchar(50) DEFAULT NULL,
  `numero_do_cartao` varchar(19) DEFAULT NULL,
  `parcelas` int(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `pagamento`
--

INSERT INTO `pagamento` (`id`, `pedido_id`, `valor`, `data_pagamento`, `metodo_pagamento`, `numero_do_cartao`, `parcelas`) VALUES
(1, 8, 90.00, '2024-03-09', 'credito', '0', 0),
(2, NULL, 50.00, '2024-03-13', '0', '7896.3698.1236.7', 1),
(5, NULL, 240.00, '2024-03-13', 'credito', '7896', 3),
(6, NULL, 90.00, '2024-03-13', 'debito', '25546565', 4),
(7, 73, 870.00, '2024-03-13', 'selecione', '7896.3698.1236.7', 1),
(8, 74, 870.00, '2024-03-13', 'selecione', '7896.3698.1236.7', 1),
(9, 75, 870.00, '2024-03-13', 'selecione', '7896.3698.1236.7', 1),
(10, 76, 870.00, '2024-03-13', 'selecione', '7896.3698.1236.7', 1),
(11, 77, 870.00, '2024-03-13', 'selecione', '7896.3698.1236.7', 1),
(12, 78, 870.00, '2024-03-13', 'selecione', '7896.3698.1236.7', 1),
(13, 79, 1950.00, '2024-03-13', 'credito', '7896.3698.1236.7', 4),
(14, 80, 90.00, '2024-04-17', 'selecione', '25546565', 1),
(15, 81, 90.00, '2024-04-25', 'credito', '1111.2222.3333.4', 4),
(16, 82, 50.00, '2024-04-27', 'credito', '25546565', 5),
(17, 83, 165.00, '2024-04-27', 'credito', '1111.2222.3333.4', 5),
(18, 84, 180.00, '2024-04-27', 'credito', '***************4', 1),
(19, 85, 75.00, '2024-04-27', 'debito', '1111.2222.3333.4', 1),
(20, 86, 115.00, '2024-04-27', 'credito', '1111.2222.3333.4', 3),
(21, 87, 150.00, '2024-04-27', 'credito', '1111.2222.3333.4', 4),
(22, 88, 240.00, '2024-04-27', 'selecione', '', 1),
(23, 89, 115.00, '2024-05-14', 'debito', '1111.2222.3333.4444', 1),
(24, 90, 470.00, '2024-05-19', 'debito', '5668.9663.3322.5554', 1),
(25, 91, 150.00, '2024-06-17', 'credito', '5668.9663.3322.5554', 1),
(26, 92, 180.00, '2024-06-17', 'credito', '5668.9663.3322.5554', 1),
(27, 93, 25.00, '2024-06-17', 'credito', '5668.9663.3322.5554', 1),
(28, 94, 75.00, '2024-06-17', 'debito', '5668.9663.3322.5554', 1),
(29, 95, 600.00, '2024-06-17', 'debito', '5668.9663.3322.5554', 1),
(30, 96, 600.00, '2024-06-17', 'debito', '5668.9663.3322.5554', 1),
(31, 97, 600.00, '2024-06-17', 'debito', '5668.9663.3322.5554', 1),
(32, 98, 300.00, '2024-06-17', 'debito', '1111.2222.3333.4444', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `pedido`
--

CREATE TABLE `pedido` (
  `pedido_id` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `data_pedido` date DEFAULT NULL,
  `endereco_entrega` varchar(255) DEFAULT NULL,
  `valor_total` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `pedido`
--

INSERT INTO `pedido` (`pedido_id`, `usuario_id`, `data_pedido`, `endereco_entrega`, `valor_total`) VALUES
(3, 7, '2024-03-06', 'Rua celebridade', 890.00),
(4, 7, '2024-03-06', 'Rua celebridade', 1110.00),
(5, 7, '2024-03-06', 'Rua celebridade', 450.00),
(8, 0, '2024-03-09', ' 7 de abril', 90.00),
(9, 18, '2024-03-09', ' 7 de abril', 90.00),
(10, 18, '2024-03-09', ' 7 de abril', 90.00),
(11, 18, '2024-03-09', ' 7 de abril', 90.00),
(12, 18, '2024-03-09', ' 7 de abril', 270.00),
(13, 18, '2024-03-09', ' 7 de abril', 270.00),
(14, 18, '2024-03-09', ' 7 de abril', 270.00),
(15, 18, '2024-03-09', ' 7 de abril', 270.00),
(16, 18, '2024-03-09', ' 7 de abril', 420.00),
(17, 18, '2024-03-09', ' 7 de abril', 420.00),
(18, 18, '2024-03-09', ' 7 de abril', 420.00),
(19, 18, '2024-03-09', ' 7 de abril', 0.00),
(20, 18, '2024-03-09', ' 7 de abril', 0.00),
(21, 18, '2024-03-09', ' 7 de abril', 0.00),
(22, 18, '2024-03-09', ' 7 de abril', 0.00),
(23, 18, '2024-03-09', ' 7 de abril', 0.00),
(24, 18, '2024-03-09', ' 7 de abril', 0.00),
(25, 18, '2024-03-09', ' 7 de abril', 0.00),
(26, 18, '2024-03-09', ' 7 de abril', 0.00),
(27, 18, '2024-03-09', ' 7 de abril', 0.00),
(28, 18, '2024-03-09', ' 7 de abril', 0.00),
(29, 18, '2024-03-09', ' 7 de abril', 0.00),
(30, 18, '2024-03-09', ' 7 de abril', 0.00),
(31, 18, '2024-03-09', ' 7 de abril', 0.00),
(32, 18, '2024-03-09', ' 7 de abril', 0.00),
(33, 18, '2024-03-09', ' 7 de abril', 0.00),
(34, 18, '2024-03-09', ' 7 de abril', 0.00),
(35, 18, '2024-03-09', ' 7 de abril', 0.00),
(36, 18, '2024-03-10', ' 7 de abril', 230.00),
(37, 18, '2024-03-10', ' 7 de abril', 230.00),
(38, 18, '2024-03-10', ' 7 de abril', 230.00),
(39, 18, '2024-03-10', ' 7 de abril', 230.00),
(40, 18, '2024-03-10', ' 7 de abril', 230.00),
(41, 18, '2024-03-10', ' 7 de abril', 230.00),
(42, 18, '2024-03-10', ' 7 de abril', 230.00),
(43, 18, '2024-03-10', ' 7 de abril', 230.00),
(44, 7, '2024-03-10', 'Rua celebridade', 90.00),
(45, 7, '2024-03-10', 'Rua celebridade', 90.00),
(46, 7, '2024-03-10', 'Rua celebridade', 90.00),
(47, 7, '2024-03-10', 'Rua celebridade', 90.00),
(48, 7, '2024-03-10', 'Rua celebridade', 90.00),
(49, 19, '2024-03-10', 'santa cruz', 180.00),
(50, 19, '2024-03-10', 'santa cruz', 180.00),
(51, 19, '2024-03-10', 'santa cruz', 180.00),
(52, 19, '2024-03-10', 'santa cruz', 150.00),
(53, 19, '2024-03-10', 'santa cruz', 260.00),
(54, 22, '2024-03-12', 'campo grande', 1630.00),
(55, 22, '2024-03-12', 'campo grande', 150.00),
(56, 22, '2024-03-12', 'campo grande', 290.00),
(57, 22, '2024-03-12', 'campo grande', 50.00),
(58, 22, '2024-03-12', 'campo grande', 390.00),
(59, 22, '2024-03-12', 'campo grande', 90.00),
(60, 22, '2024-03-12', 'campo grande', 240.00),
(61, 18, '2024-03-13', ' 7 de abril', 90.00),
(62, 18, '2024-03-13', ' 7 de abril', 150.00),
(63, 18, '2024-03-13', ' 7 de abril', 180.00),
(64, 18, '2024-03-13', ' 7 de abril', 300.00),
(65, 18, '2024-03-13', ' 7 de abril', 90.00),
(66, 18, '2024-03-13', ' 7 de abril', 180.00),
(67, 18, '2024-03-13', ' 7 de abril', 300.00),
(68, 18, '2024-03-13', ' 7 de abril', 190.00),
(69, 18, '2024-03-13', ' 7 de abril', 90.00),
(70, 18, '2024-03-13', ' 7 de abril', 90.00),
(71, 18, '2024-03-13', ' 7 de abril', 90.00),
(72, 22, '2024-03-13', 'campo grande', 720.00),
(73, 22, '2024-03-13', 'campo grande', 870.00),
(74, 22, '2024-03-13', 'campo grande', 870.00),
(75, 22, '2024-03-13', 'campo grande', 870.00),
(76, 22, '2024-03-13', 'campo grande', 870.00),
(77, 22, '2024-03-13', 'campo grande', 870.00),
(78, 22, '2024-03-13', 'campo grande', 870.00),
(79, 22, '2024-03-13', 'campo grande', 1950.00),
(80, 18, '2024-04-17', ' 7 de abril', 90.00),
(81, 20, '2024-04-25', 'Rua vieras', 90.00),
(82, 18, '2024-04-27', ' 7 de abril', 50.00),
(83, 20, '2024-04-27', 'Rua vieras', 165.00),
(84, 20, '2024-04-27', 'Rua vieras', 180.00),
(85, 20, '2024-04-27', 'Rua vieras', 75.00),
(86, 20, '2024-04-27', 'Rua vieras', 115.00),
(87, 20, '2024-04-27', 'Rua vieras', 150.00),
(88, 27, '2024-04-27', 'Rua Pedra do Sino', 240.00),
(89, 20, '2024-05-14', 'Rua vieras', 115.00),
(90, 18, '2024-05-19', 'Rua Pedra do Sino', 470.00),
(91, 18, '2024-06-17', 'Rua Pedra do Sino', 150.00),
(92, 18, '2024-06-17', 'Rua Pedra do Sino', 180.00),
(93, 18, '2024-06-17', 'Rua Pedra do Sino', 25.00),
(94, 18, '2024-06-17', 'Rua Pedra do Sino', 75.00),
(95, 18, '2024-06-17', 'Rua Pedra do Sino', 600.00),
(96, 18, '2024-06-17', 'Rua Pedra do Sino', 600.00),
(97, 18, '2024-06-17', 'Rua Pedra do Sino', 600.00),
(98, 26, '2024-06-17', 'Rua Pedra do Sino', 300.00);

-- --------------------------------------------------------

--
-- Estrutura para tabela `produtos`
--

CREATE TABLE `produtos` (
  `produto_id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `descricao` text DEFAULT NULL,
  `preco` decimal(10,2) NOT NULL,
  `estoque` int(11) NOT NULL,
  `imagem` varchar(255) DEFAULT NULL,
  `tipo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `produtos`
--

INSERT INTO `produtos` (`produto_id`, `nome`, `descricao`, `preco`, `estoque`, `imagem`, `tipo`) VALUES
(40, 'Horus', 'Acelerar', 150.00, 8, 'produto/uploads/pretreino2.png', 'pretreino'),
(41, 'Whey universal', 'Hipertrofia', 90.00, 20, 'produto/uploads/whey1.png', 'whey'),
(44, 'Bcaa 5:1:1', 'Sabor natural', 50.00, 20, 'produto/uploads/bcaa1.png', 'bcaa'),
(45, 'Glutamina 100%', 'Suplemento alimentar', 80.00, 50, 'produto/uploads/glutamina1.png', 'glutamina'),
(46, 'Creatina pura', 'Força e resitencia', 110.00, 47, 'produto/uploads/creatina2.png', 'creatina'),
(49, 'Whey Full', 'Hipertrofia', 70.00, 45, 'produto/uploads/whey2.png', 'whey'),
(50, 'Hipertofria', 'Combo definição', 210.00, 48, 'produto/uploads/ki1.jpg', 'Kit'),
(51, 'Power treino', 'Melhore seu treino', 190.00, 46, 'produto/uploads/kit4.jpg', 'Kit'),
(53, 'BcaaSupport', 'Vitamina', 75.00, 39, 'produto/uploads/bcaa2.png', 'bcaa'),
(55, 'Whey Growth', '80% Proteina', 120.00, 50, 'produto/uploads/whey4.png', 'whey'),
(56, 'Creatina Universal', 'Ganho de massa', 80.00, 50, 'produto/uploads/creatina1.png', 'creatina'),
(57, 'Evorapw', 'Energia', 65.00, 20, 'produto/uploads/pretreino1.png', 'pretreino'),
(59, 'Glutamina Max', 'Suplemento ', 80.00, 30, 'produto/uploads/0671_glutamina-max-titanium-2455.png', 'glutamina'),
(64, 'Vitamina B12', 'vitamina', 100.00, 50, 'produto/uploads/vitamina-b12.png', 'vitamina'),
(65, 'Bope', 'treino', 80.00, 50, 'produto/uploads/pretreino3.png', 'pretreino');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

CREATE TABLE `usuario` (
  `usuario_id` int(11) NOT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `senha` int(255) DEFAULT NULL,
  `perfil` enum('cliente','funcionario') DEFAULT NULL,
  `bloqueado` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuario`
--

INSERT INTO `usuario` (`usuario_id`, `nome`, `email`, `senha`, `perfil`, `bloqueado`) VALUES
(7, 'Diogo lopes', 'diogolopes@hotmail.com', 123, 'cliente', 0),
(8, 'Átila Vieira', 'atilavieiralopes@hotmail.com', 123, 'funcionario', 0),
(18, 'Shay', 'shay@hotmail.com', 123, 'cliente', 0),
(20, 'pedro vieira', 'pedrovieira@hotmail.com', 123, 'cliente', 0),
(22, 'aline', 'aline@hotmail.com', 321, 'cliente', 0),
(25, 'vitor', 'vitor@hotmail.com', 453, 'cliente', 0),
(26, 'leticia matins', 'leticia@hotmail.com', 123, 'cliente', 0),
(27, 'miguel', 'miguel@hotmail.com', 123, 'cliente', 0),
(29, 'André', 'andre@hormail.com', 123, 'cliente', 0),
(33, 'aline sousa', 'alinesouza@hotmail.com', 123, 'funcionario', 0),
(34, 'joao', 'joao@hotmail', 0, 'cliente', 1),
(35, 'bruno', 'brunolopes@hotmail.com', 123, 'funcionario', 0);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`cliente_id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Índices de tabela `detalhes_pedido`
--
ALTER TABLE `detalhes_pedido`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pedido_id` (`pedido_id`),
  ADD KEY `produto_id` (`produto_id`);

--
-- Índices de tabela `funcionario`
--
ALTER TABLE `funcionario`
  ADD PRIMARY KEY (`funcionario_id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Índices de tabela `pagamento`
--
ALTER TABLE `pagamento`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pedido_id` (`pedido_id`);

--
-- Índices de tabela `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`pedido_id`);

--
-- Índices de tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`produto_id`);

--
-- Índices de tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`usuario_id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `cliente`
--
ALTER TABLE `cliente`
  MODIFY `cliente_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de tabela `detalhes_pedido`
--
ALTER TABLE `detalhes_pedido`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT de tabela `funcionario`
--
ALTER TABLE `funcionario`
  MODIFY `funcionario_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `pagamento`
--
ALTER TABLE `pagamento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de tabela `pedido`
--
ALTER TABLE `pedido`
  MODIFY `pedido_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `produto_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `usuario_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `cliente_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`usuario_id`);

--
-- Restrições para tabelas `detalhes_pedido`
--
ALTER TABLE `detalhes_pedido`
  ADD CONSTRAINT `detalhes_pedido_ibfk_1` FOREIGN KEY (`pedido_id`) REFERENCES `pedido` (`pedido_id`),
  ADD CONSTRAINT `detalhes_pedido_ibfk_2` FOREIGN KEY (`produto_id`) REFERENCES `produtos` (`produto_id`);

--
-- Restrições para tabelas `funcionario`
--
ALTER TABLE `funcionario`
  ADD CONSTRAINT `funcionario_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`usuario_id`);

--
-- Restrições para tabelas `pagamento`
--
ALTER TABLE `pagamento`
  ADD CONSTRAINT `pagamento_ibfk_1` FOREIGN KEY (`pedido_id`) REFERENCES `pedido` (`pedido_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
