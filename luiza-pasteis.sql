-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 21-Nov-2022 às 19:17
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
-- Banco de dados: `antiquario`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `nome` varchar(30) NOT NULL,
  `nickname` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `senha` varchar(30) NOT NULL,
  `endereco` varchar(100) NOT NULL,
  `uf` varchar(2) NOT NULL,
  `telefone` varchar(20) NOT NULL,
  `funcao` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `login`
--

INSERT INTO `login` (`id`, `nome`, `nickname`, `email`, `senha`, `endereco`, `uf`, `telefone`, `funcao`) VALUES
(1, 'Giovanna', 'Gi', 'gi@gmail.com', '12345678', 'Rua 14 de Novembro, 21 - Jundiaí', 'SP', '11 95637-2016', 'cliente'),
(2, 'Gustavo', 'Gu', 'gu@gmail.com', '12345678', 'Av. 26 de Fevereiro, 2002 - Jundiaí', 'SP', '19 989186-2004', 'cliente'),
(3, 'Paulo André', 'PA', 'pa@outlook.com', '12345678', 'Rodovia dos Bandeirantes, 3000 - Jundiaí', 'SP', '19 97169-9117', 'cliente'),
(4, 'Lucas', 'Lucas', 'lucas@apple.com', '12345678', 'Rua Jair Messias - Jundiaí', 'SP', '11 96325-4756', 'cliente'),
(5, 'Camila', 'Cami', 'cami@uol.com.br', '12345678', 'Av. Inglaterra, 24 - Jundiaí', 'SP', '11 95129-0679', 'cliente');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbfunc`
--

CREATE TABLE `tbfunc` (
  `idFunc` int(11) NOT NULL,
  `email` varchar(250) NOT NULL,
  `senha` varchar(250) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `funcao` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tbfunc`
--

INSERT INTO `tbfunc` (`idFunc`, `email`, `senha`, `nome`, `funcao`) VALUES
(1, 'supervisor@luiza.com', '12345678', 'Micael', 'gerente'),
(2, 'estoque@luiza.com', '12345678', 'Nicolas', 'estoquista'),
(3, 'caixa@Luiza.com', '12345678', 'Luiza', 'caixa'),
(4, 'transportador@luiza.com', '12345678', 'Vinicius ', 'transportador');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbpedido`
--

CREATE TABLE `tbpedido` (
  `idPedido` int(11) NOT NULL,
  `idCliente` int(11) NOT NULL,
  `idProduto` int(11) NOT NULL,
  `data` date NOT NULL,
  `endereco` varchar(100) NOT NULL,
  `uf` varchar(2) NOT NULL,
  `precoPago` decimal(10,2) NOT NULL,
  `status` varchar(30) NOT NULL,
  `pag` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tbpedido`
--

INSERT INTO `tbpedido` (`idPedido`, `idCliente`, `idProduto`, `data`, `endereco`, `uf`, `precoPago`, `status`, `pag`) VALUES
(73, 1, 3, '2022-11-21', 'Rua 14 de Novembro, 21 - Jundiaí', 'SP', '40.00', 'Enviado', 'credito'),
(74, 1, 12, '2022-11-21', 'Rua 14 de Novembro, 21 - Jundiaí', 'SP', '8.00', 'Enviado', 'credito'),
(75, 1, 2, '2022-11-21', 'Rua 14 de Novembro, 21 - Jundiaí', 'SP', '5.00', 'Enviado', 'pix'),
(76, 1, 10, '2022-11-21', 'Rua 14 de Novembro, 21 - Jundiaí', 'SP', '6.00', 'Pronto para a entrega', 'pix'),
(77, 1, 1, '2022-11-20', 'Rua 14 de Novembro, 21 - Jundiaí', 'SP', '65.00', 'Falha na compra', 'pix'),
(78, 1, 2, '2022-11-20', 'Rua 14 de Novembro, 21 - Jundiaí', 'SP', '5.00', 'Pronto para a entrega', 'pix'),
(79, 1, 10, '2022-11-19', 'Rua 14 de Novembro, 21 - Jundiaí', 'SP', '6.00', 'Pronto para a entrega', 'boleto'),
(80, 1, 13, '2022-11-19', 'Rua 14 de Novembro, 21 - Jundiaí', 'SP', '7.00', 'Pronto para a entrega', 'boleto'),
(81, 1, 12, '2022-11-18', 'Rua 14 de Novembro, 21 - Jundiaí', 'SP', '8.00', 'Falha na compra', 'boleto'),
(82, 1, 6, '2022-11-18', 'Rua 14 de Novembro, 21 - Jundiaí', 'SP', '15.00', 'Pronto para a entrega', 'pix'),
(83, 2, 12, '2022-11-17', 'Av. 26 de Fevereiro, 2002 - Jundiaí', 'SP', '8.00', 'Pronto para a entrega', 'pix'),
(84, 2, 7, '2022-11-17', 'Av. 26 de Fevereiro, 2002 - Jundiaí', 'SP', '13.00', 'Pronto para a entrega', 'pix'),
(85, 2, 6, '2022-11-16', 'Av. 26 de Fevereiro, 2002 - Jundiaí', 'SP', '15.00', 'Pronto para a entrega', 'credito'),
(86, 2, 4, '2022-11-15', 'Av. 26 de Fevereiro, 2002 - Jundiaí', 'SP', '10.00', 'Pronto para a entrega', 'credito'),
(87, 2, 13, '2022-11-13', 'Av. 26 de Fevereiro, 2002 - Jundiaí', 'SP', '7.00', 'Pronto para a entrega', 'credito'),
(88, 2, 12, '2022-11-12', 'Av. 26 de Fevereiro, 2002 - Jundiaí', 'SP', '8.00', 'Pronto para a entrega', 'credito'),
(89, 2, 4, '2022-11-11', 'Av. 26 de Fevereiro, 2002 - Jundiaí', 'SP', '10.00', 'Pronto para a entrega', 'boleto'),
(90, 2, 5, '2022-11-10', 'Av. 26 de Fevereiro, 2002 - Jundiaí', 'SP', '20.00', 'Pronto para a entrega', 'boleto'),
(91, 2, 9, '2022-11-09', 'Av. 26 de Fevereiro, 2002 - Jundiaí', 'SP', '25.00', 'Pronto para a entrega', 'boleto'),
(92, 2, 11, '2022-11-08', 'Av. 26 de Fevereiro, 2002 - Jundiaí', 'SP', '11.00', 'Pronto para a entrega', 'pix'),
(93, 3, 6, '2022-10-31', 'Rodovia dos Bandeirantes, 3000 - Jundiaí', 'SP', '15.00', 'Pronto para a entrega', 'credito'),
(94, 3, 13, '2022-10-30', 'Rodovia dos Bandeirantes, 3000 - Jundiaí', 'SP', '7.00', 'Pronto para a entrega', 'credito'),
(95, 3, 8, '2022-10-29', 'Rodovia dos Bandeirantes, 3000 - Jundiaí', 'SP', '70.00', 'Pronto para a entrega', 'credito'),
(96, 3, 3, '2022-10-28', 'Rodovia dos Bandeirantes, 3000 - Jundiaí', 'SP', '40.00', 'Pronto para a entrega', 'credito'),
(97, 3, 11, '2022-10-27', 'Rodovia dos Bandeirantes, 3000 - Jundiaí', 'SP', '11.00', 'Pronto para a entrega', 'credito'),
(98, 4, 9, '2022-11-21', 'Rua Jair Messias - Jundiaí', 'SP', '25.00', 'Pronto para a entrega', 'credito'),
(99, 4, 4, '2022-11-21', 'Rua Jair Messias - Jundiaí', 'SP', '10.00', 'Pronto para a entrega', 'credito'),
(100, 4, 12, '2022-11-21', 'Rua Jair Messias - Jundiaí', 'SP', '8.00', 'Pronto para a entrega', 'credito'),
(101, 4, 13, '2022-11-21', 'Rua Jair Messias - Jundiaí', 'SP', '7.00', 'Pronto para a entrega', 'credito'),
(102, 5, 1, '2022-11-21', 'Av. Inglaterra, 24 - Jundiaí', 'SP', '65.00', 'Pronto para a entrega', 'pix'),
(103, 5, 12, '2022-11-21', 'Av. Inglaterra, 24 - Jundiaí', 'SP', '8.00', 'Pronto para a entrega', 'pix');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbproduto`
--

CREATE TABLE `tbproduto` (
  `idProduto` int(11) NOT NULL,
  `produto` varchar(30) NOT NULL,
  `descricaoProduto` varchar(100) NOT NULL,
  `precoVenda` decimal(10,2) NOT NULL,
  `promocao` char(1) NOT NULL,
  `precoPromocao` decimal(10,2) NOT NULL,
  `nomeFoto` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tbproduto`
--

INSERT INTO `tbproduto` (`idProduto`, `produto`, `descricaoProduto`, `precoVenda`, `promocao`, `precoPromocao`, `nomeFoto`) VALUES
(1, 'Tábua de Pastéis', 'Deliciosa tábua com 8 pastéis (Acompanha mostarda dijon e ketchup) ', '80.00', 's', '65.00', 'pasteis-2.jpg'),
(2, 'Heineken', 'Aquela verdinha de respeito para acompanhar seu pastel', '10.00', 's', '5.00', 'heineken.jpg'),
(3, 'Massa Artesanal', 'Receita com mais de 30 anos da Chef Luiza', '50.00', 's', '40.00', 'massa-pastel-3.jpg'),
(4, 'Pastel de carne', 'Pastéis com carne, páprica e pimentões', '10.00', 'n', '0.00', 'pasteis-1.jpg'),
(5, 'Chips picantes', 'Massa de pastel frito com 6 molhos diversos', '20.00', 'n', '0.00', 'pasteis-3.jpg'),
(6, 'Empanadas de escarola ', '', '15.00', 'n', '0.00', 'pasteis-4.jpg'),
(7, 'Pastel de queijo ', '', '13.00', 'n', '0.00', 'pasteis-5.jpg'),
(8, 'Cestas de pastéis', '10 mini-pastéis de carne com vinagrete ', '70.00', 'n', '0.00', 'pasteis-6.jpg'),
(9, 'Vinagrete', 'Refrescante molho à vinagrete', '25.00', 'n', '20.00', 'vinagrete.jpg'),
(10, 'Pastel de vento', '', '6.00', 'n', '0.00', 'pasteis-7.jpeg'),
(11, 'Pink lemonade', 'Deliciosa bebida de frutas vermelhas ', '11.00', 'n', '0.00', 'lemonade.jpg'),
(12, 'Coca-cola', 'A melhor bebida já criada ', '8.00', 'n', '0.00', 'cocacola.jpg'),
(13, 'Casquinha', 'Linda casquinha com Sorbet artesanal ', '7.00', 'n', '0.00', 'casquinha.jpg');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `tbfunc`
--
ALTER TABLE `tbfunc`
  ADD PRIMARY KEY (`idFunc`);

--
-- Índices para tabela `tbpedido`
--
ALTER TABLE `tbpedido`
  ADD PRIMARY KEY (`idPedido`);

--
-- Índices para tabela `tbproduto`
--
ALTER TABLE `tbproduto`
  ADD PRIMARY KEY (`idProduto`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `tbfunc`
--
ALTER TABLE `tbfunc`
  MODIFY `idFunc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `tbpedido`
--
ALTER TABLE `tbpedido`
  MODIFY `idPedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT de tabela `tbproduto`
--
ALTER TABLE `tbproduto`
  MODIFY `idProduto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
