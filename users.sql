-- Generation Time: 10/03/2024 at 8:55:00 PM
-- Server Version: 8.2.0
-- PHP Version: 8.2.13

-- Author: Leonardo Moura
-- LinkedIn Profile: https://www.linkedin.com/in/mouraleonardo/
-- Date Created: 3/10/2024
-- Portfolio: mouraleonardo.com

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "-05:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `vaulteyes`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `last_name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `username`, `email`, `password`) VALUES
(1, 'John', 'Doe', 'john_doe', 'john.doe@example.com', '$2y$10$9VBp9xJFrNMS7LsJjC5U2eOMJehmPNroBKH/I51pW0Fu6XRP6hUTG'),
(2, 'Michael', 'Johnson', 'michaeljohnson', 'michaeljohnson@example.com', '$2y$10$iTL9Njyz6UJkEZXb.S4GO.9oRDkr8sW05MQSH5Y54D45ESXhhWUcu'),
(4, 'Jane', 'Smith', 'janesmith', 'janesmith@example.com', '$2y$10$vxCVUzmhSLwCM4vkEaCrCOEO1MV5gAEnNqjoI/1HB7RhfbcIMMTUi'),
(5, 'Alice', 'Williams', 'alicewilliams', 'alicewilliams@example.com', '$2y$10$amK8jv7oBZNWM.wc4A6JfuHpyjIkTiIeb1goVJpxQtQ3NtAwbBbq6'),
(6, 'Bob', 'Brown', 'bobbrown', 'bobbrown@example.com', '$2y$10$5bsJf8VRZSOPmOhFLyhVwODUV/l/peuCXzQ.p56CMnXzmwzMGRigy'),
(7, 'Emily', 'Johnson', 'emilyjohnson', 'emilyjohnson@example.com', '$2y$10$RPFrJbxyxN0d0XoEIBqfFO5wwqDRXg8nITKEl4WR4jHWrKtVz6lnC'),
(3, 'David', 'Brown', 'davidbrown', 'davidbrown@example.com', '$2y$10$tTLmQ/s.TzaBgmvTjxrlCuIHR10Q3yS9qWskX6LPiXWn7n9EWDQzC'),
(8, 'Sophia', 'Miller', 'sophiamiller', 'sophiamiller@example.com', '$2y$10$6.w6qeZL4EO4jxUl4lvKb.xU/Y8929OzD2cxiP0JHf0bOCUAnBTWS'),
(9, 'Olivia', 'Smith', 'oliviasmith', 'oliviasmith@example.com', '$2y$10$.twoUNtDC9IFHWST5ofM4ua/2N9C8xSsroGqdQ2w0vcDnDCo4bPaG'),
(10, 'Ethan', 'Taylor', 'ethantaylor', 'ethantaylor@example.com', '$2y$10$OCiXZYT9kHk5qgkgjvDLKuMslT3ln/V6Txk1KkgOd.dVapGXlYbb.'),
(11, 'Emma', 'Moore', 'emmamoore', 'emmamoore@example.com', '$2y$10$BaTPKYVjCHudibhN3nrcEe2Nel.79oO95d64JX3e8rxziXWQentMO'),
(12, 'Aiden', 'White', 'aidenwhite3', 'aidenwhite3@example.com', '$2y$10$95rZhXqYNWPEZ.5nyaDO7.96zthvRXoEAsHe88FROv6VsnMpKtT06'),
(13, 'Mia', 'Jones', 'miajones', 'miajones@example.com', '$2y$10$tQB11LXhjLc0PbbQoG5Rb.8jdtOTMUTbEV6KK0MDMMwi2GfcUM9bK'),
(14, 'Liam', 'Wilson', 'liamwilson', 'liamwilson@example.com', '$2y$10$WSIeHs/rBPfyacCwORe1FOLWpXP/PdxtzqtjwEe4.Yipxj6vPklXy'),
(15, 'Ella', 'Anderson', 'ellaanderson', 'ellaanderson@example.com', '$2y$10$AkI917D3h6TaPMB7ZkoVMezMn2Zz2IIlgbQW30Iv2jzpBZsRHbuGu'),
(16, 'Henry', 'Taylor', 'henrytaylor', 'henrytaylor@example.com', '$2y$10$qPH/hx70RTT0PcYEEOgFzOru7/8uNxgAGyb.L//mPkOU14mIURkMi'),
(17, 'Grace', 'Wilson', 'gracewilson', 'gracewilson@example.com', '$2y$10$31rPqBUypZZ6yMQMG8KqBe/nGKSm.MUiWWsthtpFHXGnkDJLMi.Ze'),
(18, 'James', 'Miller', 'jamesmiller', 'jamesmiller@example.com', '$2y$10$p0uiswKLptOqe8DJQrQj1.bGwZPQ4Iq2bHKq3Qs4Xiei92BH0mb8a'),
(19, 'Ava', 'White', 'avawhite', 'avawhite@example.com', '$2y$10$EaDQ/Pyd2YLi.a2YXVi6yuMU/EOtWKHOsm58G04/FAG.JaTsA0ye.'),
(20, 'Noah', 'Jones', 'noahjones', 'noahjones@example.com', '$2y$10$6q9j/7.UMO8ecYyi97VZvulhAVuZre8UU.kCEABT.QpGmfIkvk0l.'),
(21, 'John', 'OConnor', 'johnconnor', 'john.connor@example.com', '$2y$10$2qOeuFwS7./ETK6nCwYkROR5D03x1pTvTzZRnw5gtY4Ehn3NovLNK');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
