-- --------------------------------------------------------
-- Хост:                         127.0.0.1
-- Версия сервера:               10.1.10-MariaDB - mariadb.org binary distribution
-- ОС Сервера:                   Win32
-- HeidiSQL Версия:              9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Дамп структуры базы данных foot
DROP DATABASE IF EXISTS `foot`;
CREATE DATABASE IF NOT EXISTS `foot` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `foot`;


-- Дамп структуры для таблица foot.comments
DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `game_id` int(11) NOT NULL DEFAULT '0',
  `author_name` varchar(150) NOT NULL DEFAULT '0',
  `date` datetime NOT NULL,
  `body` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

-- Дамп данных таблицы foot.comments: ~19 rows (приблизительно)
DELETE FROM `comments`;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` (`id`, `game_id`, `author_name`, `date`, `body`) VALUES
	(1, 1, 'Princ_Grenlandii', '2016-04-10 07:03:24', 'Oh my god. What A Game.'),
	(2, 1, 'Zigfrid_Pobedimiy', '2016-04-10 07:03:23', 'Tottanham!!! Tottanham!!!!'),
	(3, 1, 'Foxy', '2016-04-10 01:16:35', 'Leicter, common, common((('),
	(4, 2, 'Princ_grenlandii', '2016-04-10 00:00:00', 'Ya, ya, dast is fantastic)))'),
	(5, 2, 'Only_Bayern', '2016-04-10 00:00:00', 'Nine, nine!!!!!!!!!!!!!'),
	(6, 1, 'Ronald Kuman', '2016-04-12 17:38:21', 'It\'s my predecessor.'),
	(7, 1, 'Claudio Ranieri', '2016-04-12 17:38:21', 'Mamma Mia!'),
	(8, 1, 'Mauricio Pacetino', '2016-04-12 17:58:21', 'Fucking Leicter((('),
	(9, 1, 'Emin Gasanov', '2016-04-12 18:05:44', 'Pochetiono Loh))))'),
	(10, 3, 'Princ_Grenlandii', '2016-04-12 18:11:44', 'Konte, what you are doing?'),
	(11, 3, 'Emin Gasanov', '2016-04-12 18:15:44', 'Princ_Grenlandii, i agree with you.'),
	(12, 3, 'Shurik Is Absenta', '2016-04-12 18:08:44', 'Red Devils in my heart'),
	(13, 1, 'Mauricio Pacetino', '2016-04-12 18:08:44', 'Silence, Emin, I Kill You!!!!'),
	(15, 1, 'Princ_Grenlandii', '2016-04-12 18:09:21', 'Emin and Mauricio, please, stop to quarrel.'),
	(18, 1, 'Mauricio Pacetino', '2016-04-12 18:10:01', 'Princ_Grenlandii, I KILL YOU TOO!!!!! But first of all I must be kill Emin for his impertinance.'),
	(19, 1, 'Shurik Is Absenta', '2016-04-12 19:06:08', 'Norhern London - go!!!!!'),
	(20, 4, 'YNWA_LIVERPOOL', '2016-04-12 19:07:00', 'You Never Walk Allone'),
	(21, 6, 'Shurik Is Absenta', '2016-04-12 19:08:07', 'Oho-ho-ho-ho! WTF)))'),
	(22, 19, 'Emin Gasanov', '2016-04-12 19:10:08', 'Cool Madrid Derby!'),
	(25, 11, 'Emin Gasanov', '2016-04-16 13:00:17', 'CSKA Forever');
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;


-- Дамп структуры для таблица foot.games
DROP TABLE IF EXISTS `games`;
CREATE TABLE IF NOT EXISTS `games` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `home_team_id` int(11) NOT NULL,
  `guest_team_id` int(11) NOT NULL,
  `home_scores` int(11) DEFAULT NULL,
  `guest_scores` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_games_teams` (`home_team_id`),
  KEY `FK_games_teams_2` (`guest_team_id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

-- Дамп данных таблицы foot.games: ~26 rows (приблизительно)
DELETE FROM `games`;
/*!40000 ALTER TABLE `games` DISABLE KEYS */;
INSERT INTO `games` (`id`, `home_team_id`, `guest_team_id`, `home_scores`, `guest_scores`, `date`, `description`) VALUES
	(1, 1, 2, 0, 1, '2016-04-25', 'It\'s was very bad game.'),
	(2, 3, 4, 2, 0, '2016-04-10', 'Not bad for germany.'),
	(3, 5, 6, 0, 2, '2016-04-11', 'Ha-ha - lohi'),
	(4, 7, 8, 1, 2, '2016-04-11', ''),
	(5, 9, 10, 1, 0, '2016-04-11', 'WTF'),
	(6, 11, 12, 14, 14, '2016-03-31', 'Old Match'),
	(7, 13, 14, 2, 2, '2014-12-31', 'Happy New Year'),
	(8, 15, 16, 4, 3, '2016-04-11', ''),
	(9, 17, 18, NULL, NULL, '2016-05-30', ''),
	(10, 19, 20, 1, 3, '2016-09-09', ''),
	(11, 20, 1, 2, 2, '2016-04-15', ''),
	(12, 2, 3, 2, 1, '2016-04-16', ''),
	(13, 4, 11, 2, 0, '2016-04-17', ''),
	(14, 12, 8, 0, 0, '2016-04-16', ''),
	(15, 6, 13, 1, 0, '2016-04-11', ''),
	(16, 5, 7, 0, 0, '2016-04-11', ''),
	(17, 9, 17, 0, 3, '2016-04-11', ''),
	(18, 10, 19, 1, 0, '2016-09-15', ''),
	(19, 14, 15, 2, 0, '2016-04-11', ''),
	(20, 16, 18, 3, 1, '2016-03-31', ''),
	(21, 5, 18, 0, 0, '2016-05-31', ''),
	(22, 3, 14, 0, 0, '2016-04-16', ''),
	(24, 25, 26, 0, 0, '2016-04-29', ''),
	(25, 24, 21, 0, 0, '2016-04-30', ''),
	(26, 28, 27, 0, 0, '2016-04-30', ''),
	(27, 1, 26, 0, 0, '2016-05-31', ''),
	(29, 1, 4, 0, 0, '2016-06-06', '');
/*!40000 ALTER TABLE `games` ENABLE KEYS */;


-- Дамп структуры для таблица foot.players
DROP TABLE IF EXISTS `players`;
CREATE TABLE IF NOT EXISTS `players` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `team_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(100) NOT NULL DEFAULT '0',
  `position` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=latin1;

-- Дамп данных таблицы foot.players: ~66 rows (приблизительно)
DELETE FROM `players`;
/*!40000 ALTER TABLE `players` DISABLE KEYS */;
INSERT INTO `players` (`id`, `team_id`, `name`, `position`) VALUES
	(1, 1, 'Harry Kane', 'Center Forward'),
	(2, 1, 'Delle Alli', 'Central Miedfield'),
	(3, 1, 'Christian Eriksen', 'Central Miedfield'),
	(4, 1, 'Eric Lamela', 'Right Miedfield'),
	(5, 1, 'Hugo Loris', 'Goalkeeper'),
	(6, 1, 'Tobi Alderveild', 'Center Defender'),
	(7, 1, 'Dany Rose', 'Left Defender'),
	(8, 1, 'Kayle Walker', 'Right Defender'),
	(9, 2, 'Jamy Vardy', 'Forward'),
	(10, 2, 'Riad Mahrez', 'Right Miedfield'),
	(11, 2, 'Sindzi Okazaki', 'Forward'),
	(12, 2, 'Kasper Shmeihel', 'Goalkeeper'),
	(13, 2, 'Robert Huth', 'Center Defender'),
	(14, 2, 'Danny Drinkwater', 'Center Miedfield'),
	(15, 2, 'Danny Simpson', 'Right Defender'),
	(16, 2, 'Wes Morgan', 'Center Defender'),
	(17, 4, 'Robert Lewandovski', 'Forward'),
	(18, 4, 'Thomas Muller', 'Forward'),
	(19, 4, 'Arien Robben', 'Right Miedfield'),
	(20, 4, 'Frank Ribery', 'Left Miedfield'),
	(21, 4, 'Manuel Noer', 'Goalkeeper'),
	(22, 4, 'Philim Lahm', 'Right Defender'),
	(23, 3, 'Pier Aubumeniang', 'Forward'),
	(24, 3, 'Roman Wandenfeiler', 'Goalkeeper'),
	(25, 3, 'Marco Reus', 'Center Miedfield'),
	(26, 5, 'Diego Costa', 'Forward'),
	(27, 5, 'Tibo Cortouis', 'Goalkeeper'),
	(28, 6, 'Wane Rooney', 'Forward'),
	(29, 6, 'David De Gea', 'Goalkeeper'),
	(30, 6, 'Marcos Rojo', 'Left Defender'),
	(31, 7, 'Kevin De Bruyne', 'Center Miedfield'),
	(32, 7, 'Yaya Toure', 'Center Miedfield'),
	(33, 7, 'Fernandinho', 'Center Miedfield'),
	(34, 8, 'Simon Mignolet', 'Goalkeeper'),
	(35, 8, 'Philipe Coutinho', 'Center Miedfield'),
	(36, 8, 'Danny Staridge', 'Forward'),
	(37, 9, 'Stepahn Kislieng', 'Forward'),
	(38, 10, 'Eder', 'Forward'),
	(39, 11, 'Woiceh Schezny', 'Goalkeeper'),
	(40, 12, 'Paul Pogba', 'Center Miedfield'),
	(41, 12, 'Gianluca Buffon', 'Goalkeeper'),
	(42, 13, 'Lionel Messi', 'Forward'),
	(43, 13, 'Neymar', 'Forward'),
	(44, 13, 'Luis Suarez', 'Forward'),
	(45, 13, 'Dani Alves', 'Left Defender'),
	(46, 13, 'Gerrard Pique', 'Center Defender'),
	(47, 13, 'Sergio Busquets', 'Center Miedfield'),
	(48, 14, 'Cristaino Ronaldo', 'Forward'),
	(49, 14, 'Karim Benzema', 'Forward'),
	(50, 14, 'Gareth Bale', 'Forward'),
	(51, 14, 'James Rodriguez', 'Forward'),
	(52, 14, 'Kaylor Navas', 'Goalkeeper'),
	(53, 15, 'Antuan Griezman', 'Forward'),
	(54, 15, 'Jan Oblak', 'Goalkeeper'),
	(55, 16, 'Dani Alves', 'Goalkeeper'),
	(56, 20, 'Roman Eremenko', 'Center Midfield'),
	(57, 1, 'Jan Verthongen', 'Center Defender'),
	(58, 8, 'Christian Benteke', 'Forward'),
	(59, 26, 'Gonzalo Higuain', 'Forward'),
	(60, 26, 'Marek Hamsik', 'Center Midfield'),
	(61, 1, 'Moussa Dembele', 'Center Midfield'),
	(62, 28, 'Nicola Kalinic', 'Forward'),
	(63, 2, 'N\'Golo Kante', 'Center Midfield'),
	(64, 29, 'Taison', 'Center Midfield'),
	(65, 30, 'Saido Mane', 'Forward'),
	(66, 31, 'Romelu Lukaku', 'Forward'),
	(67, 31, 'Tim Howard', 'Goalkeeper'),
	(68, 1, 'Kevin Tripier', 'Right Defender');
/*!40000 ALTER TABLE `players` ENABLE KEYS */;


-- Дамп структуры для таблица foot.teams
DROP TABLE IF EXISTS `teams`;
CREATE TABLE IF NOT EXISTS `teams` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT '0',
  `logo` varchar(100) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

-- Дамп данных таблицы foot.teams: ~29 rows (приблизительно)
DELETE FROM `teams`;
/*!40000 ALTER TABLE `teams` DISABLE KEYS */;
INSERT INTO `teams` (`id`, `name`, `logo`) VALUES
	(1, 'Tottanham', 'img\\tottanham.png'),
	(2, 'Leicter City', 'img\\leicter_city.png'),
	(3, 'Borussia Dorthmund', ''),
	(4, 'Bayern Munchen', ''),
	(5, 'Chelsea', ''),
	(6, 'Manchester United', ''),
	(7, 'Manchester City', ''),
	(8, 'Liverpool', ''),
	(9, 'Bayer Liverkusen', ''),
	(10, 'Inter Milan', ''),
	(11, 'Juventus', ''),
	(12, 'AS Roma', ''),
	(13, 'FC Barcelona', ''),
	(14, 'Real Madrid', ''),
	(15, 'Athletico Madrid', ''),
	(16, 'Valencia', ''),
	(17, 'PSG', ''),
	(18, 'FC Porto', ''),
	(19, 'Zenith St, Piterbourgh', ''),
	(20, 'CSKA Moscow', ''),
	(21, 'Arsenal', ''),
	(24, 'SL Benfica', ''),
	(25, 'FC Schalke', ''),
	(26, 'Napoli', '0'),
	(27, 'AC Milan', '0'),
	(28, 'AC Fiorentina', '0'),
	(29, 'FC Shakhtar', '0'),
	(30, 'Southampton', '0'),
	(31, 'Everton', '0');
/*!40000 ALTER TABLE `teams` ENABLE KEYS */;


-- Дамп структуры для таблица foot.user
DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_email` varchar(50) NOT NULL,
  `team_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=latin1;

-- Дамп данных таблицы foot.user: ~0 rows (приблизительно)
DELETE FROM `user`;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`, `user_email`, `team_id`) VALUES
	(2, 'princ_grenlandii', 1),
	(3, 'shurik', 4),
	(4, 'emin', 2),
	(29, 'Ksusha', 5),
	(39, 'YNWA', 8),
	(41, 'Princessa_Mourinho', 10),
	(42, 'Allegri', 11),
	(48, 'Zlatanka', 17),
	(49, 'Zidane', 14),
	(50, 'Torres', 15),
	(51, 'Red_Deivil', 6),
	(52, 'Fialka', 28),
	(53, 'Alexander_Tretiak', 1),
	(54, 'emin', 10),
	(55, 'shurik', 10);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
