-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Värd: localhost
-- Tid vid skapande: 25 jun 2020 kl 08:09
-- Serverversion: 8.0.18
-- PHP-version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databas: `ebutik`
--

-- --------------------------------------------------------

--
-- Tabellstruktur `orders`
--

CREATE TABLE `orders` (
  `id` int(9) NOT NULL,
  `user_id` int(9) NOT NULL,
  `total_price` int(6) NOT NULL,
  `billing_full_name` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `billing_street` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `billing_postal_code` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `billing_city` varchar(90) COLLATE utf8mb4_general_ci NOT NULL,
  `billing_country` varchar(90) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabellstruktur `order_items`
--

CREATE TABLE `order_items` (
  `id` int(9) NOT NULL,
  `order_id` int(9) NOT NULL,
  `product_id` int(9) NOT NULL,
  `quantity` int(9) NOT NULL,
  `unit_price` int(9) NOT NULL,
  `product_title` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabellstruktur `products`
--

CREATE TABLE `products` (
  `id` int(9) NOT NULL,
  `title` varchar(90) COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci NOT NULL,
  `price` int(9) NOT NULL,
  `img_url` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumpning av Data i tabell `products`
--

INSERT INTO `products` (`id`, `title`, `description`, `price`, `img_url`) VALUES
(56, 'Barbados', 'Full of personality, it is aged 11 years in Barbados and 2-3 years in France, and offers aromas of nougat, chocolate mint and candied walnut, evolving next to candied orange and vanilla with a sweet finish.', 399, '../img/barbados.png'),
(57, 'Plantation Grande Reserve', 'Grande Réserve is a blend of different rums from Barbados, matured in Bourbon casks in the Caribbean and then for one year in the southwest France, in old French oak barrels.', 699, '../img/assemblages_signature-Plantation-grande-reserve.png'),
(58, 'Fiji', 'From the pristine lagoons to the lush jungles, Plantation Isle of Fiji is an ode to the beauty ofthe Fiji Islands.', 999, '../img/fiji.png'),
(59, 'Jamaica', 'This 2005 vintage rum highlights the ancestral Jamaican style: a long fermentation and a 100% pot still distillation blended from the two mythic Long Pond and Clarendon distilleries.', 599, '../img/jamaica.png'),
(60, 'Isle of Fiji', 'From the pristine lagoons to the lush jungles, Plantation Isle of Fiji is an ode to the beauty ofthe Fiji Islands.', 1299, '../img/Isle+of+Fiji.png'),
(61, 'Plantation O.F.T.D', 'Plantation O.F.T.D. Rum is our take on that classic style of overproof rums. And not just ours: to join him on the quest to get the blend and the proof just right, Alexandre Gabriel scoured rum joints around the world to find six grizzled old salts who knew which end of a rum bottle was which.', 1999, '../img/OFTD.png');

-- --------------------------------------------------------

--
-- Tabellstruktur `users`
--

CREATE TABLE `users` (
  `id` int(9) NOT NULL,
  `first_name` varchar(60) COLLATE utf8mb4_general_ci NOT NULL,
  `last_name` varchar(60) COLLATE utf8mb4_general_ci NOT NULL,
  `username` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(60) COLLATE utf8mb4_general_ci NOT NULL,
  `phone` varchar(60) COLLATE utf8mb4_general_ci NOT NULL,
  `street` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `postal_code` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `city` varchar(90) COLLATE utf8mb4_general_ci NOT NULL,
  `country` varchar(90) COLLATE utf8mb4_general_ci NOT NULL,
  `register_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumpning av Data i tabell `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `username`, `email`, `password`, `phone`, `street`, `postal_code`, `city`, `country`, `register_date`) VALUES
(44, 'Rasmus', 'Södergren', 'Rasmus', 'rasmus@gmail.com', 'rasmus1', '0703452345', 'Storvägen', '13232', 'Stockholm', 'sweden', '2020-06-25 07:15:41'),
(45, 'Linnea', 'Andersson', 'Linnea', 'Linnea@gmail.com', 'linnea1', '0703452345', 'Harövägen', '13256', 'Stockholm', 'sweden', '2020-06-25 07:16:35'),
(46, 'Henrik', 'Henriksson', 'Henrik', 'Henrik@gmail.com', 'henrik1', '0703452347', 'Storövägen', '13273', 'Stockholm', 'norway', '2020-06-25 07:17:19');

--
-- Index för dumpade tabeller
--

--
-- Index för tabell `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Index för tabell `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`);

--
-- Index för tabell `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Index för tabell `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT för dumpade tabeller
--

--
-- AUTO_INCREMENT för tabell `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT för tabell `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT för tabell `products`
--
ALTER TABLE `products`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT för tabell `users`
--
ALTER TABLE `users`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
