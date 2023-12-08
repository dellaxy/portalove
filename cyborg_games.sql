-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hostiteľ: 127.0.0.1
-- Čas generovania: Pi 08.Dec 2023, 14:56
-- Verzia serveru: 10.4.24-MariaDB
-- Verzia PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáza: `cyborg_games`
--
CREATE DATABASE IF NOT EXISTS `cyborg_games` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `cyborg_games`;

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `category` varchar(125) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Sťahujem dáta pre tabuľku `categories`
--

INSERT INTO `categories` (`id`, `category`) VALUES
(1, 'Action-Adventure'),
(2, 'RPG'),
(3, 'Open World'),
(4, 'Western'),
(5, 'Sandbox');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `games`
--

CREATE TABLE `games` (
  `id` int(11) NOT NULL,
  `unique_name` varchar(125) NOT NULL,
  `name` varchar(125) NOT NULL,
  `description` varchar(8000) NOT NULL,
  `release_date` date DEFAULT NULL,
  `size_gb` float NOT NULL,
  `category_id` int(11) NOT NULL,
  `downloads` float NOT NULL,
  `game_header` varchar(128) NOT NULL,
  `trailer_link` varchar(2055) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Sťahujem dáta pre tabuľku `games`
--

INSERT INTO `games` (`id`, `unique_name`, `name`, `description`, `release_date`, `size_gb`, `category_id`, `downloads`, `game_header`, `trailer_link`) VALUES
(1, 'assassins_creed_valhalla', 'Assassin\'s Creed Valhalla', 'Embark on a Viking saga in the ninth century as Eivor, a fierce Viking raider.', '2023-01-01', 50, 1, 5000000, 'ac_valhalla_header.jpg', 'https://www.youtube.com/watch?v=rKjUAWlbTJk'),
(2, 'cyberpunk_2077', 'Cyberpunk 2077', 'Enter the futuristic open world of Night City and become a cyber-enhanced mercenary.', '2022-02-15', 70.5, 2, 8000000, 'cyberpunk_2077_header.jpg', 'https://www.youtube.com/watch?v=8X2kIfS6fb8'),
(3, 'the_witcher_3', 'The Witcher 3: Wild Hunt', 'Join Geralt of Rivia in the conclusion of the epic Witcher trilogy.', '2022-03-20', 45.2, 1, 6000000, 'witcher3_header.jpg', 'http://www.youtube.com/watch?v=c0i88t0Kacs'),
(4, 'red_dead_redemption_2', 'Red Dead Redemption 2', 'Experience the story of Arthur Morgan and the Van der Linde gang in the American Wild West.', '2022-04-25', 105.8, 3, 7000000, 'rdr2_header.jpg', 'https://www.youtube.com/watch?v=eaW0tYpxyp0'),
(5, 'minecraft', 'Minecraft', 'Create and explore your own blocky world in this sandbox game with endless possibilities.', '2022-05-30', 200, 4, 15000000, 'minecraft_header.jpg', 'https://www.youtube.com/watch?v=MmB9b5njVbA'),
(6, 'gta_v', 'Grand Theft Auto V', 'Explore the fictional state of San Andreas in this action-packed open-world game.', '2022-06-15', 80, 3, 12000000, 'gta_v_header.jpg', 'https://www.youtube.com/watch?v=QkkoHAzjnUs'),
(7, 'god_of_war', 'God of War', 'Join Kratos on his journey in the realm of Norse mythology, battling gods and monsters.', '2022-07-10', 35.6, 1, 4500000, 'god_of_war_header.jpg', 'https://www.youtube.com/watch?v=K0u_kAWLJOA'),
(8, 'fifa_22', 'FIFA 22', 'Experience the excitement of football with realistic gameplay and top-notch graphics.', '2022-12-20', 25, 5, 5500000, 'fifa_22_header.jpg', 'https://www.youtube.com/watch?v=K0u_kAWLJOA'),
(9, 'fallout_4', 'Fallout 4', 'Survive in the post-apocalyptic wasteland and shape the future in this action role-playing game.', '2022-09-05', 48.3, 2, 3500000, 'fallout_4_header.jpg', 'https://www.youtube.com/watch?v=K0u_kAWLJOA'),
(10, 'overwatch', 'Overwatch', 'Join a team of heroes and engage in fast-paced multiplayer battles to save the world.', '2022-10-10', 15.7, 4, 6000000, 'overwatch_header.jpg', 'https://www.youtube.com/watch?v=K0u_kAWLJOA');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `game_ratings`
--

CREATE TABLE `game_ratings` (
  `id` int(11) NOT NULL,
  `profile_id` int(11) NOT NULL,
  `game_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Sťahujem dáta pre tabuľku `game_ratings`
--

INSERT INTO `game_ratings` (`id`, `profile_id`, `game_id`, `rating`) VALUES
(1, 1, 1, 5),
(2, 2, 1, 4),
(3, 3, 1, 4),
(4, 1, 2, 5),
(5, 2, 2, 1),
(6, 3, 2, 1),
(7, 1, 3, 5),
(8, 2, 3, 5),
(9, 3, 3, 4),
(10, 1, 4, 5),
(11, 2, 4, 4),
(12, 3, 4, 4),
(13, 1, 5, 5),
(14, 2, 5, 4),
(15, 3, 5, 4),
(16, 4, 1, 4),
(17, 4, 2, 1),
(18, 4, 3, 5),
(19, 4, 4, 4),
(20, 4, 5, 4),
(21, 5, 1, 4),
(22, 5, 2, 4),
(23, 5, 3, 4),
(24, 5, 4, 4),
(25, 5, 5, 4),
(26, 6, 1, 5),
(27, 6, 2, 4),
(28, 6, 3, 4),
(29, 6, 4, 4),
(30, 6, 5, 4),
(31, 1, 6, 5),
(32, 2, 6, 5),
(33, 3, 6, 4),
(34, 4, 6, 4),
(35, 5, 6, 4),
(36, 1, 7, 5),
(37, 2, 7, 4),
(38, 3, 7, 4),
(39, 4, 7, 4),
(40, 5, 7, 5),
(41, 1, 8, 5),
(42, 2, 8, 4),
(43, 3, 8, 4),
(44, 4, 8, 4),
(45, 5, 8, 4),
(46, 1, 9, 4),
(47, 2, 9, 4),
(48, 3, 9, 5),
(49, 4, 9, 4),
(50, 5, 9, 4),
(51, 6, 10, 3),
(52, 1, 10, 2),
(53, 2, 10, 2),
(54, 3, 10, 3),
(55, 4, 10, 2),
(56, 5, 10, 3),
(57, 6, 11, 2),
(58, 1, 11, 3),
(59, 2, 11, 2),
(60, 3, 11, 3);

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `profiles`
--

CREATE TABLE `profiles` (
  `id` int(11) NOT NULL,
  `unique_name` varchar(125) NOT NULL,
  `password` text NOT NULL,
  `nickname` varchar(125) NOT NULL,
  `profile_picture` varchar(1024) NOT NULL,
  `bio` varchar(1024) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Sťahujem dáta pre tabuľku `profiles`
--

INSERT INTO `profiles` (`id`, `unique_name`, `password`, `nickname`, `profile_picture`, `bio`) VALUES
(1, 'randomAccount', '$2y$10$hYMV/JdzxqL745w1yVoFjuPgBexnq1LgQicmGrYXV4Ih0B10Q22Pq', 'Hocijake meno', 'ano.jpg', 'status status status status status status status '),
(2, 'player1', '', 'Player One', 'player1.jpg', 'Hello, I am Player One! 🎮'),
(3, 'gamer2', '', 'Gamer2', 'gamer2.jpg', 'Gaming is life! 🕹️'),
(4, 'pro_gamer', '', 'ProGamer', 'pro_gamer.jpg', 'Competitive gamer looking for challenges!'),
(5, 'casual_player', '', 'CasualPlayer', 'casual_player.jpg', 'Just here for some casual gaming.'),
(6, 'game_lover', '', 'GameLover', 'game_lover.jpg', 'In love with all kinds of games!'),
(7, 'explorer_gamer', '', 'ExplorerGamer', 'explorer_gamer.jpg', 'Exploring virtual worlds one game at a time.'),
(8, 'gamergirl', '', 'GamerGirl', 'gamergirl.jpg', 'Gaming is not just for guys! 💖🎮'),
(9, 'console_master', '', 'ConsoleMaster', 'console_master.jpg', 'Mastering every console out there!'),
(10, 'pc_gamer', '', 'PCGamer', 'pc_gamer.jpg', 'PC gaming enthusiast. Building dreams, one rig at a time.'),
(11, 'game_addict', '', 'GameAddict', 'game_addict.jpg', 'Addicted to games! Need more games! 🎮🎮🎮');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `profile_following`
--

CREATE TABLE `profile_following` (
  `profile_id` int(11) DEFAULT NULL,
  `following_profile_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Sťahujem dáta pre tabuľku `profile_following`
--

INSERT INTO `profile_following` (`profile_id`, `following_profile_id`) VALUES
(1, 2),
(1, 3),
(1, 4),
(2, 5),
(2, 6),
(3, 7),
(4, 8),
(5, 9),
(6, 10);

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `profile_games`
--

CREATE TABLE `profile_games` (
  `profile_id` int(11) NOT NULL,
  `game_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Sťahujem dáta pre tabuľku `profile_games`
--

INSERT INTO `profile_games` (`profile_id`, `game_id`) VALUES
(2, 4),
(2, 5),
(3, 6),
(4, 7),
(5, 8),
(6, 9),
(7, 10),
(8, 1),
(9, 2),
(10, 3),
(11, 4),
(11, 5),
(10, 6),
(9, 7),
(8, 8),
(7, 9),
(6, 10),
(1, 6),
(1, 1),
(1, 8),
(1, 10);

--
-- Kľúče pre exportované tabuľky
--

--
-- Indexy pre tabuľku `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pre tabuľku `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pre tabuľku `game_ratings`
--
ALTER TABLE `game_ratings`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pre tabuľku `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pre tabuľku `profile_following`
--
ALTER TABLE `profile_following`
  ADD KEY `profile_id1` (`profile_id`),
  ADD KEY `profile_id2` (`following_profile_id`);

--
-- AUTO_INCREMENT pre exportované tabuľky
--

--
-- AUTO_INCREMENT pre tabuľku `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pre tabuľku `games`
--
ALTER TABLE `games`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pre tabuľku `game_ratings`
--
ALTER TABLE `game_ratings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT pre tabuľku `profiles`
--
ALTER TABLE `profiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Obmedzenie pre exportované tabuľky
--

--
-- Obmedzenie pre tabuľku `profile_following`
--
ALTER TABLE `profile_following`
  ADD CONSTRAINT `profile_following_ibfk_1` FOREIGN KEY (`profile_id`) REFERENCES `profiles` (`id`),
  ADD CONSTRAINT `profile_following_ibfk_2` FOREIGN KEY (`following_profile_id`) REFERENCES `profiles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
