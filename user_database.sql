-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 18/07/2024 às 05:03
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `user_database`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `proposals`
--

CREATE TABLE `proposals` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `clientName` varchar(255) DEFAULT NULL,
  `solutionName` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `imageUrl` varchar(255) DEFAULT NULL,
  `aboutClientName` varchar(255) DEFAULT NULL,
  `aboutSolutionName` varchar(255) DEFAULT NULL,
  `aboutDescription` text DEFAULT NULL,
  `aboutImageUrl` varchar(255) DEFAULT NULL,
  `testimonialClientName` varchar(255) DEFAULT NULL,
  `testimonialSolutionName` varchar(255) DEFAULT NULL,
  `testimonialDescription` text DEFAULT NULL,
  `testimonialImageUrl` varchar(255) DEFAULT NULL,
  `testimonialVideoUrl` varchar(255) DEFAULT NULL,
  `offerClientName` varchar(255) DEFAULT NULL,
  `offerSolutionName` varchar(255) DEFAULT NULL,
  `offerDescription` text DEFAULT NULL,
  `offerImageUrl` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `date_of_birth`, `password`, `username`) VALUES
(1, '', 'jdiocelio@gmail.com', '16988177812', '2024-07-15', '$2y$10$T3SB06vADAkmD8Dy/E2xHOE2sx5WSB1h0rDOhgDPJiw6rwZIIAb0q', 'DIow'),
(2, '', 'karen_fefa@hotmail.com', '16992846301', '2024-07-15', '$2y$10$VdZj48AzqLXNBrnzjV0mVOyUM0JkumZiId.PKBmpDRJizLuFWNCoG', 'Karen'),
(3, '', 'Admin@admin.com', '16988177812', '2024-07-15', '$2y$10$LBi3g6cbIzUpe8ugY0g6MOarWZiV4dxv6joDjUQhFtpxjgWp8vKuW', 'Admin');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `proposals`
--
ALTER TABLE `proposals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Índices de tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `proposals`
--
ALTER TABLE `proposals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `proposals`
--
ALTER TABLE `proposals`
  ADD CONSTRAINT `proposals_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
