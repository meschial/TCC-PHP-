-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 08-Jan-2020 às 16:02
-- Versão do servidor: 10.1.34-MariaDB
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tcc`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `cliente`
--

CREATE TABLE `cliente` (
  `id` int(11) NOT NULL,
  `foto` varchar(20) NOT NULL,
  `usuario_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `cliente`
--

INSERT INTO `cliente` (`id`, `foto`, `usuario_id`) VALUES
(1, '1578172546', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `endereco`
--

CREATE TABLE `endereco` (
  `id` int(11) NOT NULL,
  `cep` varchar(10) NOT NULL,
  `rua` varchar(100) NOT NULL,
  `complemento` varchar(40) NOT NULL,
  `bairro` varchar(50) NOT NULL,
  `cidade` varchar(70) NOT NULL,
  `estado` varchar(45) NOT NULL,
  `numero` varchar(10) NOT NULL,
  `usuario_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `endereco`
--

INSERT INTO `endereco` (`id`, `cep`, `rua`, `complemento`, `bairro`, `cidade`, `estado`, `numero`, `usuario_id`) VALUES
(1, '87501-130', 'Avenida Rio Branco', 'Casa', 'Zona I', 'Umuarama', 'PR', '356', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `item`
--

CREATE TABLE `item` (
  `id` int(11) NOT NULL,
  `data_venda` date NOT NULL,
  `status` char(1) NOT NULL,
  `rota_id` int(11) NOT NULL,
  `parada_id` int(11) NOT NULL,
  `cliente_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `item`
--

INSERT INTO `item` (`id`, `data_venda`, `status`, `rota_id`, `parada_id`, `cliente_id`) VALUES
(1, '2020-01-04', '1', 1, 0, 1),
(2, '2016-12-25', '1', 1, 0, 1),
(3, '2020-01-08', '1', 1, 1, 1),
(4, '1997-04-18', '1', 1, 2, 1),
(5, '2020-01-08', '1', 1, 0, 3),
(6, '2020-01-08', '1', 1, 2, 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `motorista`
--

CREATE TABLE `motorista` (
  `id` int(11) NOT NULL,
  `tipo_cnh` char(2) NOT NULL,
  `cnh` varchar(20) NOT NULL,
  `foto` varchar(20) NOT NULL,
  `usuario_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `motorista`
--

INSERT INTO `motorista` (`id`, `tipo_cnh`, `cnh`, `foto`, `usuario_id`) VALUES
(1, 'B', '333.333.333-33', '1578172572', 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `pagamento`
--

CREATE TABLE `pagamento` (
  `id` int(11) NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `valor` double NOT NULL,
  `data` date NOT NULL,
  `venda_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `parada`
--

CREATE TABLE `parada` (
  `id` int(11) NOT NULL,
  `cep` varchar(15) NOT NULL,
  `valor` double NOT NULL,
  `cidade` varchar(60) NOT NULL,
  `rota_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `parada`
--

INSERT INTO `parada` (`id`, `cep`, `valor`, `cidade`, `rota_id`) VALUES
(1, '87492-000', 25, 'Cida p 1', 1),
(2, '87491-000', 40, 'teste cida', 1),
(3, '87490-000', 55, 'cidade p 3', 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto`
--

CREATE TABLE `produto` (
  `id` int(11) NOT NULL,
  `nome` varchar(45) NOT NULL,
  `peso` varchar(10) NOT NULL,
  `altura` varchar(10) NOT NULL,
  `comprimento` varchar(10) NOT NULL,
  `largura` varchar(10) NOT NULL,
  `quantidade` char(3) NOT NULL,
  `item_id` int(11) NOT NULL,
  `cliente_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `produto`
--

INSERT INTO `produto` (`id`, `nome`, `peso`, `altura`, `comprimento`, `largura`, `quantidade`, `item_id`, `cliente_id`) VALUES
(1, 'teste novo', '5', '5', '5', '5', '2', 1, 1),
(2, 'novo', '8', '8', '8', '8', '1', 1, 1),
(3, 'Caixa de sapato', '1', '30', '30', '30', '2', 1, 1),
(5, 'teste de novo produro', '10', '10', '10', '10', '2', 2, 1),
(6, 'alcool', '2', '3', '3', '3', '2', 2, 1),
(7, 'caixa de tenis', '2', '2', '2', '2', '15', 2, 1),
(8, 'produto parada', '5', '5', '5', '5', '2', 3, 1),
(9, 'teste de envio', '6', '6', '6', '6', '15', 0, 1),
(10, 'teste q deu ruim', '5', '4', '4', '4', '50', 4, 1),
(11, 'super produto', '5', '5', '5', '5', '5', 5, 3),
(12, 'teste', '2', '2', '2', '2', '15', 6, 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `rota`
--

CREATE TABLE `rota` (
  `id` int(11) NOT NULL,
  `quantidade` varchar(10) NOT NULL,
  `valor` double NOT NULL,
  `cep_inicio` varchar(15) NOT NULL,
  `cep_fim` varchar(15) NOT NULL,
  `data_inicio` date NOT NULL,
  `cidade_inicio` varchar(60) NOT NULL,
  `cidade_fim` varchar(60) NOT NULL,
  `motorista_id` int(11) NOT NULL,
  `tamanho_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `rota`
--

INSERT INTO `rota` (`id`, `quantidade`, `valor`, `cep_inicio`, `cep_fim`, `data_inicio`, `cidade_inicio`, `cidade_fim`, `motorista_id`, `tamanho_id`) VALUES
(1, '5', 180, '87490-000', '87830-000', '1997-04-18', 'Nova Olímpia', 'Tapira', 2, 1),
(2, '5', 25, '87491-000', '87501-130', '1997-04-18', 'Nova Olímpia', 'Umuarama', 2, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tamanho`
--

CREATE TABLE `tamanho` (
  `id` int(11) NOT NULL,
  `descricao` varchar(150) NOT NULL,
  `peso` varchar(10) NOT NULL,
  `largura` varchar(10) NOT NULL,
  `comprimento` varchar(10) NOT NULL,
  `altura` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tamanho`
--

INSERT INTO `tamanho` (`id`, `descricao`, `peso`, `largura`, `comprimento`, `altura`) VALUES
(1, 'PEQUENO', '1KG', '30CM', '30CM', '30CM');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `cpf` varchar(15) NOT NULL,
  `rg` varchar(15) NOT NULL,
  `data` date NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(100) NOT NULL,
  `tipo` char(2) NOT NULL,
  `apelido` varchar(20) NOT NULL,
  `celular` varchar(15) NOT NULL,
  `celular2` varchar(15) DEFAULT NULL,
  `ativo` char(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id`, `nome`, `cpf`, `rg`, `data`, `email`, `senha`, `tipo`, `apelido`, `celular`, `celular2`, `ativo`) VALUES
(1, 'cliente', '111.111.111-11', '10.518.198-0', '1997-04-18', 'cliente@gmail.com', '$2y$10$CyBzxc3LbkxN4xK7gUsE2OGzvDLIq1NrtfjD0SHWzXK0hUimD7oUG', '1', 'cliente', '(44)44444-4444', '', 's'),
(2, 'motorista', '222.222.222-22', '1054584', '1998-05-20', 'motorista@gmail.com', '$2y$10$CyBzxc3LbkxN4xK7gUsE2OGzvDLIq1NrtfjD0SHWzXK0hUimD7oUG', '2', 'motorista', '(22)22222-2222', NULL, 's'),
(3, 'super', '333.333.333-33', '21545', '2000-07-25', 'super#gmail.com', '$2y$10$CyBzxc3LbkxN4xK7gUsE2OGzvDLIq1NrtfjD0SHWzXK0hUimD7oUG', '3', 'super', '(33)33333-3333', NULL, 's');

-- --------------------------------------------------------

--
-- Estrutura da tabela `venda`
--

CREATE TABLE `venda` (
  `id` int(11) NOT NULL,
  `valor` double NOT NULL,
  `item_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `venda`
--

INSERT INTO `venda` (`id`, `valor`, `item_id`) VALUES
(1, 285, 2),
(2, 285, 2),
(3, 75, 1),
(4, 285, 2),
(5, 360, 3),
(6, 50, 3),
(7, 3.42, 2),
(8, 3420, 2),
(9, 2000, 4),
(10, 900, 5),
(11, 600, 6);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `endereco`
--
ALTER TABLE `endereco`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `motorista`
--
ALTER TABLE `motorista`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pagamento`
--
ALTER TABLE `pagamento`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `parada`
--
ALTER TABLE `parada`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produto`
--
ALTER TABLE `produto`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rota`
--
ALTER TABLE `rota`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tamanho`
--
ALTER TABLE `tamanho`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `venda`
--
ALTER TABLE `venda`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `endereco`
--
ALTER TABLE `endereco`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `motorista`
--
ALTER TABLE `motorista`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pagamento`
--
ALTER TABLE `pagamento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `parada`
--
ALTER TABLE `parada`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `produto`
--
ALTER TABLE `produto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `rota`
--
ALTER TABLE `rota`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tamanho`
--
ALTER TABLE `tamanho`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `venda`
--
ALTER TABLE `venda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
