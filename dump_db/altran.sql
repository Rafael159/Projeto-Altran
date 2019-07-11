-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 11-Jul-2019 às 19:43
-- Versão do servidor: 10.1.37-MariaDB
-- versão do PHP: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `altran`
--
CREATE DATABASE IF NOT EXISTS `altran` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `altran`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `agendamentos`
--

CREATE TABLE `agendamentos` (
  `id` int(11) NOT NULL,
  `paciente` int(11) DEFAULT NULL,
  `medico` int(11) DEFAULT NULL,
  `dataconsulta` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `agendamentos`
--

INSERT INTO `agendamentos` (`id`, `paciente`, `medico`, `dataconsulta`, `status`) VALUES
(12, 7, 1, '2019-07-11 12:00:00', 'Ativo'),
(17, 1, 1, '2019-07-11 14:00:00', 'Ativo'),
(18, 1, 4, '2019-07-13 15:30:00', 'Ativo'),
(19, 1, 1, '2019-07-15 17:30:00', 'Ativo');

-- --------------------------------------------------------

--
-- Estrutura da tabela `medicos`
--

CREATE TABLE `medicos` (
  `id` int(11) NOT NULL,
  `medico` varchar(255) DEFAULT NULL,
  `crm` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `medicos`
--

INSERT INTO `medicos` (`id`, `medico`, `crm`) VALUES
(1, 'João Santos', '147228369'),
(2, 'Maria Aparecida', '147228369'),
(3, 'Carlos Silva Santos', '112233445566'),
(4, 'Diogo Lima', '1593574785'),
(5, 'Madalena Costa', '258147369');

-- --------------------------------------------------------

--
-- Estrutura da tabela `notificacoes`
--

CREATE TABLE `notificacoes` (
  `id` int(11) NOT NULL,
  `tipo` varchar(100) DEFAULT NULL,
  `mensagem` varchar(255) DEFAULT NULL,
  `usuario` int(11) DEFAULT NULL,
  `dataacao` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `notificacoes`
--

INSERT INTO `notificacoes` (`id`, `tipo`, `mensagem`, `usuario`, `dataacao`) VALUES
(1, 'Consulta adicionada', 'Uma nova consulta foi adicionada', 1, '2019-07-11 01:40:24'),
(2, 'Consulta adicionada', 'Uma nova consulta foi adicionada', 1, '2019-07-10 20:41:06'),
(3, 'Consulta deletada', 'A consulta #6 foi excluído pelo paciente', 1, '2019-07-10 20:42:31'),
(4, 'Consulta deletada', 'A consulta #1 foi excluída pelo paciente', 3, '2019-07-10 20:48:56'),
(5, 'Consulta adicionada', 'Uma nova consulta foi adicionada', 1, '2019-07-10 20:54:35'),
(6, 'Consulta adicionada', 'Uma nova consulta foi adicionada', 1, '2019-07-10 20:59:16'),
(7, 'Consulta adicionada', 'Uma nova consulta foi adicionada', 7, '2019-07-10 21:05:15'),
(8, 'Consulta adicionada', 'Uma nova consulta foi adicionada', 7, '2019-07-10 21:05:27'),
(9, 'Consulta deletada', 'A consulta #8 foi excluída pelo paciente', 1, '2019-07-11 00:02:43'),
(10, 'Consulta adicionada', 'Uma nova consulta foi adicionada', 7, '2019-07-11 09:05:23'),
(11, 'Consulta atualizar', 'A consulta #14 foi atualizada pelo paciente', 7, '2019-07-11 11:00:46'),
(12, 'Consulta atualizada', 'A consulta #12 foi atualizada pelo paciente', 7, '2019-07-11 11:05:29'),
(13, 'Consulta atualizada', 'A consulta #12 foi atualizada pelo paciente', 7, '2019-07-11 11:05:44'),
(14, 'Consulta atualizada', 'A consulta #13 foi atualizada pelo paciente', 7, '2019-07-11 11:05:53'),
(15, 'Consulta deletada', 'A consulta #7 foi excluída pelo paciente', 3, '2019-07-11 13:53:25'),
(16, 'Consulta deletada', 'A consulta #14 foi excluída pelo paciente', 3, '2019-07-11 13:53:43'),
(17, 'Consulta deletada', 'A consulta #10 foi excluída pelo paciente', 3, '2019-07-11 13:53:55'),
(18, 'Consulta atualizada', 'A consulta #11 foi atualizada pelo paciente', 3, '2019-07-11 13:57:11'),
(19, 'Consulta atualizada', 'A consulta #13 foi atualizada pelo paciente', 3, '2019-07-11 13:57:22'),
(20, 'Consulta atualizada', 'A consulta #13 foi atualizada pelo paciente', 3, '2019-07-11 13:57:30'),
(21, 'Consulta atualizada', 'A consulta #13 foi atualizada pelo paciente', 3, '2019-07-11 13:57:40'),
(22, 'Consulta atualizada', 'A consulta #9 foi atualizada pelo paciente', 1, '2019-07-11 13:58:30'),
(23, 'Consulta atualizada', 'A consulta #11 foi atualizada pelo paciente', 1, '2019-07-11 14:03:03'),
(24, 'Consulta deletada', 'A consulta #9 foi excluída pelo paciente', 8, '2019-07-11 14:03:33'),
(25, 'Consulta adicionada', 'Uma nova consulta foi adicionada', 1, '2019-07-11 14:03:53'),
(26, 'Consulta atualizada', 'A consulta #15 foi atualizada pelo paciente', 1, '2019-07-11 14:04:00'),
(27, 'Consulta deletada', 'A consulta #11 foi excluída po paciente', 8, '2019-07-11 14:05:49'),
(28, 'Consulta adicionada', 'Uma nova consulta foi adicionada', 1, '2019-07-11 14:08:00'),
(29, 'Consulta atualizada', 'A consulta #16 foi atualizada pelo paciente', 1, '2019-07-11 14:08:28'),
(30, 'Consulta deletada', 'A consulta #16 foi excluída po paciente', 1, '2019-07-11 14:09:29'),
(31, 'Consulta adicionada', 'Uma nova consulta foi adicionada', 1, '2019-07-11 14:13:44'),
(32, 'Consulta adicionada', 'Uma nova consulta foi adicionada', 1, '2019-07-11 14:14:05'),
(33, 'Consulta adicionada', 'Uma nova consulta foi adicionada', 1, '2019-07-11 14:14:25');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `sexo` char(1) DEFAULT NULL,
  `cidade` varchar(255) DEFAULT NULL,
  `tipousuario` int(11) DEFAULT NULL,
  `telefone` varchar(50) DEFAULT NULL,
  `logusuario` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `firstlog` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `nome`, `email`, `senha`, `sexo`, `cidade`, `tipousuario`, `telefone`, `logusuario`, `firstlog`) VALUES
(1, 'Rafael Alves', 'rafael@gmail.com', '$2a$08$Cf1f11ePArKlBJomM0F6a.kde0EnMOqlC3yy97YbmH4z5QiTVRlXK', NULL, 'São Paulo', 1, '(12) 15451-1515', '2019-07-09 16:34:23', '2019-07-09 16:34:00'),
(2, 'Joana Silva', 'joana@gmail.com', '$2a$08$Cf1f11ePArKlBJomM0F6a.kde0EnMOqlC3yy97YbmH4z5QiTVRlXK', NULL, 'Poá', 2, '(11) 85445-3233', '2019-07-09 16:39:10', '2019-07-09 16:39:00'),
(3, 'Dr Marcos', 'marcos@gmail.com', '$2a$08$Cf1f11ePArKlBJomM0F6a.kde0EnMOqlC3yy97YbmH4z5QiTVRlXK', 'm', 'São Paulo', 3, '(11) 55484-1515', '2019-07-09 16:41:06', '2019-07-09 16:41:00'),
(4, 'Teste', 'testes@gmail.com', '$2a$08$Cf1f11ePArKlBJomM0F6a.8hkDBVwbjEj4M.X8f8Mif742BLRbCGO', 'm', '', 1, '', '2019-07-09 16:48:39', '2019-07-09 16:48:00'),
(5, 'teste2', 'maisteste@gmail.com', '$2a$08$Cf1f11ePArKlBJomM0F6a.kde0EnMOqlC3yy97YbmH4z5QiTVRlXK', 'f', '', 2, '', '2019-07-09 16:49:26', '2019-07-09 16:49:00'),
(6, 'Sandra Mattos', 'sandra@gmail.com', '$2a$08$Cf1f11ePArKlBJomM0F6a.kde0EnMOqlC3yy97YbmH4z5QiTVRlXK', 'f', 'Suzano', 1, '(11) 85558-5555', '2019-07-11 00:00:34', '2019-07-11 00:00:00'),
(7, 'Martha', 'martha@gmail.com', '$2a$08$Cf1f11ePArKlBJomM0F6a.kde0EnMOqlC3yy97YbmH4z5QiTVRlXK', 'm', 'Poá', 1, '(15) 45555-5555', '2019-07-11 00:04:56', '2019-07-11 00:04:00'),
(8, 'Terezinha', 'terezinha@gmail.com', '$2a$08$Cf1f11ePArKlBJomM0F6a.kde0EnMOqlC3yy97YbmH4z5QiTVRlXK', 'f', 'São Paulo', 2, '(65) 65451-5155', '2019-07-11 16:59:09', '2019-07-11 16:59:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agendamentos`
--
ALTER TABLE `agendamentos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_userID` (`paciente`);

--
-- Indexes for table `medicos`
--
ALTER TABLE `medicos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notificacoes`
--
ALTER TABLE `notificacoes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_usuario` (`usuario`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agendamentos`
--
ALTER TABLE `agendamentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `medicos`
--
ALTER TABLE `medicos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `notificacoes`
--
ALTER TABLE `notificacoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `agendamentos`
--
ALTER TABLE `agendamentos`
  ADD CONSTRAINT `FK_userID` FOREIGN KEY (`paciente`) REFERENCES `users` (`id`);

--
-- Limitadores para a tabela `notificacoes`
--
ALTER TABLE `notificacoes`
  ADD CONSTRAINT `FK_usuario` FOREIGN KEY (`usuario`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
