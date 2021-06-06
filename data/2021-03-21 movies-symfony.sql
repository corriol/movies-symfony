-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Temps de generació: 06-06-2021 a les 22:58:23
-- Versió del servidor: 10.4.13-MariaDB
-- Versió de PHP: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de dades: `movies-symfony`
--
CREATE DATABASE IF NOT EXISTS `movies-symfony` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `movies-symfony`;

-- --------------------------------------------------------

--
-- Estructura de la taula `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Bolcament de dades per a la taula `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20210130162101', '2021-01-30 17:53:25', 54),
('DoctrineMigrations\\Version20210214191917', '2021-02-14 20:19:29', 27),
('DoctrineMigrations\\Version20210214192049', '2021-02-14 20:20:56', 72),
('DoctrineMigrations\\Version20210217154452', '2021-02-17 16:45:04', 27),
('DoctrineMigrations\\Version20210221095954', '2021-02-21 11:01:45', 94),
('DoctrineMigrations\\Version20210221111601', '2021-02-21 12:17:42', 42),
('DoctrineMigrations\\Version20210221112521', '2021-02-21 12:25:57', 64);

-- --------------------------------------------------------

--
-- Estructura de la taula `genre`
--

CREATE TABLE `genre` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Bolcament de dades per a la taula `genre`
--

INSERT INTO `genre` (`id`, `name`) VALUES
(1, 'Action'),
(2, 'Adventure'),
(3, 'Thriller');

-- --------------------------------------------------------

--
-- Estructura de la taula `movie`
--

CREATE TABLE `movie` (
  `id` int(11) NOT NULL,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tagline` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `poster` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `overview` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `release_date` date NOT NULL,
  `genre_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Bolcament de dades per a la taula `movie`
--

INSERT INTO `movie` (`id`, `title`, `tagline`, `poster`, `overview`, `release_date`, `genre_id`) VALUES
(6, 'Greenland', NULL, '3cc58d8adf92.jpg', 'John Garrity, his estranged wife and their young son embark on a perilous journey to find sanctuary as a planet-killing comet hurtles toward Earth. Amid terrifying accounts of cities getting levelled, the Garrity\'s experience the best and worst in humanity. As the countdown to the global apocalypse approaches zero, their incredible trek culminates in a desperate and last-minute flight to a possible safe haven.', '2020-07-29', 3),
(7, 'Below Zero', 'Escape is not the exit.', 'a84a6d585384.jpg', 'When a prisoner transfer van is attacked, the cop in charge must fight those inside and outside while dealing with a silent foe: the icy temperatures.', '2021-01-29', 1),
(8, 'Joker', 'Put on a happy face.', '103f200e1888.jpg', 'During the 1980s, a failed stand-up comedian is driven insane and turns to a life of crime and chaos in Gotham City while becoming an infamous psychopathic crime figure.', '2019-10-04', 3),
(9, 'Burn It All', NULL, 'e421ab05e46f.jpg', 'With a history of men dominating her fate, a broken woman returns to her hometown to bury her mother only to find a violent organ smuggling ring already has the body and wants no witnesses, but by trying to extinguish her they spark an inferno.', '2021-02-19', 3),
(10, 'The Little Things', 'Some things never let us go.', 'de25baeccdb1.jpg', 'Deputy Sheriff Joe \"Deke\" Deacon joins forces with Sgt. Jim Baxter to search for a serial killer who\'s terrorizing Los Angeles. As they track the culprit, Baxter is unaware that the investigation is dredging up echoes of Deke\'s past, uncovering disturbing secrets that could threaten more than his case.', '2021-01-29', 3),
(11, 'Fear of Rain', 'Some voices you can\'t outrun', 'c8fac1cfbcf1.jpg', 'A teenage girl living with schizophrenia begins to suspect her neighbor has kidnapped a child. Her parents try desperately to help her live a normal life, without exposing their own tragic secrets, and the only person who believes her is Caleb – a boy she isn’t even sure exists.', '2021-02-12', 3),
(12, 'Godzilla: King of the Monsters', 'Long live the king.', 'b26814c646f2.jpg', 'Follows the heroic efforts of the crypto-zoological agency Monarch as its members face off against a battery of god-sized monsters, including the mighty Godzilla, who collides with Mothra, Rodan, and his ultimate nemesis, the three-headed King Ghidorah. When these ancient super-species, thought to be mere myths, rise again, they all vie for supremacy, leaving humanity\'s very existence hanging in the balance.', '2019-05-29', 1),
(13, 'Prova', 'Una prova', 'nofile.jpg', 'Un text de prova molt llarg', '2021-02-12', NULL);

-- --------------------------------------------------------

--
-- Estructura de la taula `rating`
--

CREATE TABLE `rating` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `movie_id` int(11) NOT NULL,
  `value` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Bolcament de dades per a la taula `rating`
--

INSERT INTO `rating` (`id`, `user_id`, `movie_id`, `value`) VALUES
(1, 2, 10, 4),
(3, 2, 8, 5),
(5, 2, 6, 3),
(8, 2, 7, 4),
(10, 1, 6, 4),
(11, 1, 7, 5),
(12, 1, 8, 5),
(14, 1, 11, 3),
(15, 2, 9, 2),
(16, 1, 12, 2);

-- --------------------------------------------------------

--
-- Estructura de la taula `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Bolcament de dades per a la taula `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `email`, `role`) VALUES
(1, 'user', 'us6EKZMmfBVwI', 'user@proves.org', 'ROLE_USER'),
(2, 'admin', 'afMZU7gNS1jvE', NULL, 'ROLE_ADMIN');

--
-- Índexs per a les taules bolcades
--

--
-- Índexs per a la taula `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Índexs per a la taula `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`id`);

--
-- Índexs per a la taula `movie`
--
ALTER TABLE `movie`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_1D5EF26F4296D31F` (`genre_id`);

--
-- Índexs per a la taula `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_user_movie_unique` (`user_id`,`movie_id`),
  ADD KEY `IDX_D8892622A76ED395` (`user_id`),
  ADD KEY `IDX_D88926228F93B6FC` (`movie_id`);

--
-- Índexs per a la taula `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT per les taules bolcades
--

--
-- AUTO_INCREMENT per la taula `genre`
--
ALTER TABLE `genre`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT per la taula `movie`
--
ALTER TABLE `movie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT per la taula `rating`
--
ALTER TABLE `rating`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT per la taula `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restriccions per a les taules bolcades
--

--
-- Restriccions per a la taula `movie`
--
ALTER TABLE `movie`
  ADD CONSTRAINT `FK_1D5EF26F4296D31F` FOREIGN KEY (`genre_id`) REFERENCES `genre` (`id`);

--
-- Restriccions per a la taula `rating`
--
ALTER TABLE `rating`
  ADD CONSTRAINT `FK_D88926228F93B6FC` FOREIGN KEY (`movie_id`) REFERENCES `movie` (`id`),
  ADD CONSTRAINT `FK_D8892622A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
