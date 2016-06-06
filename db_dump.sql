-- -- --------------------------------------------------------
-- -- Хост:                         127.0.0.1
-- -- Версия сервера:               10.1.10-MariaDB - mariadb.org binary distribution
-- -- ОС Сервера:                   Win32
-- -- HeidiSQL Версия:              9.3.0.4984
-- -- --------------------------------------------------------

-- !40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT ;
-- /*!40101 SET NAMES utf8mb4 */;
-- /*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
-- /*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- -- Дамп структуры базы данных foot
-- DROP DATABASE IF EXISTS `foot`;
-- CREATE DATABASE IF NOT EXISTS `foot` /*!40100 DEFAULT CHARACTER SET latin1 */;
-- USE `foot`;


-- Дамп структуры для таблица foot.comments
DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `game_id` int(11) NOT NULL DEFAULT '0',
  `author_name` varchar(150) NOT NULL DEFAULT '0',
  `date` datetime NOT NULL,
  `body` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=131 DEFAULT CHARSET=latin1;

-- Дамп данных таблицы foot.comments: ~84 rows (приблизительно)
DELETE FROM `comments`;
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
	(25, 11, 'Emin Gasanov', '2016-04-16 13:00:17', 'CSKA Forever'),
	(26, 11, 'ddv', '2016-04-22 18:19:08', 'dvdsvds'),
	(27, 1, 'Mauricio Pacetino', '2016-05-14 04:27:34', 'Shurik, thank you)))'),
	(62, 1, 'princ_grenlandii', '2016-05-20 22:29:00', 'fafafsas'),
	(68, 1, 'princ_grenlandii', '2016-05-20 22:54:21', 'fire'),
	(69, 1, 'princ_grenlandii', '2016-05-20 23:07:15', 'Oh, No!((('),
	(70, 1, 'princ_grenlandii', '2016-05-20 23:07:47', 'Oh, No!((('),
	(71, 1, 'princ_grenlandii', '2016-05-20 23:07:57', 'Oh, No!((('),
	(72, 1, 'princ_grenlandii', '2016-05-20 23:08:10', 'Oh, No!((('),
	(73, 1, 'princ_grenlandii', '2016-05-20 23:08:53', 'Oh, No!((('),
	(74, 1, 'dfs g ', '2016-05-21 17:05:58', 'dfs g sd '),
	(75, 1, 'serega', '2016-05-21 18:14:09', 'gfhytfhytf'),
	(76, 1, 'serega', '2016-05-21 18:14:38', 'gfhytfhytf'),
	(77, 1, 'Array', '2016-05-23 00:30:45', 'asdera'),
	(78, 1, 'Array', '2016-05-23 00:31:25', 'asdera'),
	(79, 1, 'Array', '2016-05-23 00:31:41', 'asdera'),
	(80, 1, 'Array', '2016-05-23 00:34:11', 'asdera'),
	(81, 1, 'Array', '2016-05-23 00:35:45', 'derevo gizni'),
	(82, 1, 'princ_grenlandii', '2016-05-23 00:40:13', 'Ia vsegda v nih veril!!!'),
	(83, 1, 'princ_grenlandii', '2016-05-23 01:03:35', 'Tottanham!!!'),
	(84, 1, 'princ_grenlandii', '2016-05-23 01:10:55', 'London is a capital of Great Britain!!!'),
	(85, 1, 'princ_grenlandii', '2016-05-23 01:12:31', 'Leicter is champion!'),
	(86, 1, 'princ_grenlandii', '2016-05-23 01:15:13', 'Mama, ooo!!!'),
	(87, 1, 'princ_grenlandii', '2016-05-23 01:16:12', 'asfasf'),
	(88, 1, 'princ_grenlandii', '2016-05-23 01:17:59', 'a'),
	(89, 1, 'princ_grenlandii', '2016-05-23 01:18:20', 'ad'),
	(90, 1, 'princ_grenlandii', '2016-05-23 01:18:39', 'add'),
	(91, 1, 'princ_grenlandii', '2016-05-23 01:19:00', 'add'),
	(92, 1, 'princ_grenlandii', '2016-05-23 01:27:56', 'asdera'),
	(93, 1, 'princ_grenlandii', '2016-05-23 01:28:47', 'Radost\''),
	(94, 1, 'princ_grenlandii', '2016-05-23 01:29:41', 'prepend rabotaet'),
	(95, 1, 'princ_grenlandii', '2016-05-23 01:33:48', 'Udachno vstavilos\''),
	(96, 1, 'princ_grenlandii', '2016-05-23 01:35:02', 'Seichas Tochno vstavitsia!!!!!'),
	(97, 1, 'princ_grenlandii', '2016-05-23 01:35:33', 'And Now?'),
	(98, 1, 'princ_grenlandii', '2016-05-23 01:35:52', 'Now, please, now!!!'),
	(99, 1, 'princ_grenlandii', '2016-05-23 01:36:03', 'Uraaaaaa!!!!!'),
	(100, 1, 'princ_grenlandii', '2016-05-23 01:46:16', 'mama mia mia mia.'),
	(101, 1, 'shurik', '2016-05-23 01:47:19', 'Not Bad!'),
	(102, 1, 'Zidane', '2016-05-23 01:49:53', 'I waant to be a manager by Leicter!!!!!'),
	(103, 1, 'Zidane', '2016-05-23 01:50:56', 'I love France, Algire and Leicter!!!'),
	(104, 1, 'spurs@gmail.com', '2016-05-23 01:52:23', 'Zidane, I hate You!'),
	(105, 1, 'princ_grenlandii', '2016-05-23 10:54:50', 'Never let me go.'),
	(106, 1, 'princ_grenlandii', '2016-05-23 10:56:19', 'Tra-ta-ta!'),
	(107, 1, 'princ_grenlandii', '2016-05-24 12:39:08', 'Mother'),
	(108, 3, 'princ_grenlandii', '2016-05-24 12:39:26', 'Thank You, Emin!'),
	(109, 1, 'princ_grenlandii', '2016-05-24 16:31:36', 'asdera'),
	(110, 1, 'princ_grenlandii', '2016-05-27 16:04:45', 'Tra-ta-ta!'),
	(111, 1, 'princ_grenlandii', '2016-05-27 16:06:25', 'zsfasf'),
	(112, 1, 'princ_grenlandii', '2016-05-27 16:07:07', 'asderasda'),
	(113, 1, 'princ_grenlandii', '2016-05-27 16:08:42', 'sedare'),
	(114, 1, 'princ_grenlandii', '2016-05-27 16:11:33', 'Who Wants To Live Forever?'),
	(115, 1, 'princ_grenlandii', '2016-05-27 17:42:18', 'replace'),
	(116, 1, 'princ_grenlandii', '2016-06-02 03:31:19', 'asdads'),
	(117, 1, 'princ_grenlandii', '2016-06-02 03:31:29', 'asderasdasffasf'),
	(118, 19, 'princ_grenlandii', '2016-06-03 18:37:51', 'dfdfs'),
	(119, 19, 'princ_grenlandii', '2016-06-03 18:37:54', 'dsf'),
	(120, 19, 'princ_grenlandii', '2016-06-03 18:37:57', 'dsfs'),
	(121, 18, 'princ_grenlandii', '2016-06-04 13:16:36', 'dsfdsf'),
	(122, 18, 'princ_grenlandii', '2016-06-04 13:16:39', 'dsfdsf'),
	(123, 18, 'princ_grenlandii', '2016-06-04 13:19:21', 'dsfdsfads\r\nfds\r\nfads\r\nf\r\ndsafa sdf'),
	(124, 18, 'princ_grenlandii', '2016-06-04 13:19:43', 'htf\r\nhgfh\r\ngfh\r\nf\r\nh'),
	(125, 18, 'princ_grenlandii', '2016-06-04 13:20:19', 'dsfdsf\r\nds\r\nfds\r\nf'),
	(126, 18, 'princ_grenlandii', '2016-06-04 13:26:55', 'dsfdsf\r\ndsf\r\ndsf'),
	(127, 18, 'princ_grenlandii', '2016-06-04 13:27:00', '1\r\n2\r\n3'),
	(128, 18, 'princ_grenlandii', '2016-06-04 13:27:39', 'dsfdsf'),
	(129, 18, 'princ_grenlandii', '2016-06-04 13:27:42', 'dfgdg'),
	(130, 18, 'princ_grenlandii', '2016-06-04 13:27:49', '2\r\n3\r\n54\r\n54\r\n654\r\n6546546b54\r\n6\r\n54w\r\nrfgh\r\n fh\r\ndfh');

-- Дамп структуры для таблица foot.games
DROP TABLE IF EXISTS `games`;
CREATE TABLE IF NOT EXISTS `games` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `home_team_id` int(11) NOT NULL,
  `guest_team_id` int(11) NOT NULL,
  `home_scores` int(11) DEFAULT NULL,
  `guest_scores` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `description` text,
  `create_date` datetime DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_games_teams` (`home_team_id`),
  KEY `FK_games_teams_2` (`guest_team_id`)
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=latin1;

-- Дамп данных таблицы foot.games: ~58 rows (приблизительно)
DELETE FROM `games`;
INSERT INTO `games` (`id`, `home_team_id`, `guest_team_id`, `home_scores`, `guest_scores`, `date`, `description`, `create_date`, `update_date`) VALUES
	(1, 12, 2, 0, 3, '2016-04-25', '', NULL, '2016-06-02 06:42:18'),
	(2, 3, 4, 2, 1, '2016-04-10', '', NULL, '2016-06-01 03:45:31'),
	(3, 5, 6, 0, 2, '2016-04-11', 'Ha-ha - lohi', NULL, '2016-06-02 06:41:22'),
	(4, 7, 8, 1, 2, '2016-04-11', '', NULL, NULL),
	(5, 9, 10, 1, 0, '2016-04-11', 'WTF', NULL, NULL),
	(6, 11, 12, 14, 14, '2016-03-31', 'Old Match', '2016-05-12 21:36:14', NULL),
	(7, 13, 14, 2, 2, '2014-12-31', 'Happy New Year', NULL, NULL),
	(8, 15, 16, 4, 3, '2016-04-11', '', NULL, NULL),
	(9, 17, 18, NULL, NULL, '2016-05-30', '', NULL, NULL),
	(10, 20, 37, 1, 3, '2016-09-09', '', NULL, '2016-06-01 03:32:40'),
	(11, 20, 1, 2, 2, '2016-04-15', '', NULL, NULL),
	(12, 2, 3, 2, 1, '2016-04-16', '', NULL, NULL),
	(13, 4, 11, 2, 0, '2016-04-17', '', NULL, NULL),
	(14, 12, 8, 0, 0, '2016-04-16', '', NULL, NULL),
	(15, 6, 13, 1, 0, '2016-04-11', '', NULL, NULL),
	(16, 5, 7, 0, 0, '2016-04-11', '', NULL, NULL),
	(17, 9, 17, 0, 3, '2016-04-11', '', NULL, NULL),
	(18, 10, 19, 345, 0, '0000-00-00', '', NULL, '2016-06-04 01:58:58'),
	(19, 14, 15, 2, 0, '2016-04-11', '', NULL, NULL),
	(20, 16, 18, 3, 1, '2016-03-31', '', NULL, NULL),
	(21, 5, 18, 0, 0, '2016-05-31', '', NULL, NULL),
	(22, 3, 14, 0, 0, '2016-04-16', '', NULL, NULL),
	(24, 25, 26, 0, 0, '2016-04-29', '', NULL, NULL),
	(25, 24, 21, 0, 0, '2016-04-30', '', NULL, NULL),
	(26, 28, 27, 0, 0, '2016-04-30', '', NULL, NULL),
	(27, 1, 26, 0, 0, '2016-05-31', '', NULL, NULL),
	(29, 1, 4, 0, 0, '2016-06-06', '', NULL, NULL),
	(30, 8, 1, 0, 0, '2016-06-07', '', NULL, NULL),
	(31, 1, 2, 0, 0, '2016-07-16', '', NULL, NULL),
	(32, 1, 26, 0, 0, '2016-05-31', '', NULL, NULL),
	(33, 3, 8, 0, 0, '2016-06-24', '', NULL, NULL),
	(34, 8, 8, 0, 0, '2016-06-08', '', NULL, NULL),
	(35, 8, 8, 0, 0, '2016-06-08', '', NULL, NULL),
	(36, 8, 8, 0, 0, '2016-06-08', '', NULL, NULL),
	(37, 7, 14, 0, 0, '2016-06-08', '', NULL, NULL),
	(38, 3, 19, 0, 0, '2016-06-08', '', NULL, NULL),
	(39, 3, 19, 0, 0, '2016-06-08', '', NULL, NULL),
	(40, 4, 7, 0, 0, '2016-06-08', '', NULL, NULL),
	(41, 4, 7, 0, 0, '2016-06-08', '', NULL, NULL),
	(43, 9, 3, 0, 0, '2016-06-08', '', NULL, NULL),
	(44, 8, 17, 0, 0, '2016-06-08', '', NULL, NULL),
	(46, 1, 32, 0, 0, '2016-06-08', '', NULL, NULL),
	(47, 13, 2, 0, 0, '2016-07-16', '', NULL, NULL),
	(48, 7, 28, 0, 0, '2016-07-16', '', NULL, NULL),
	(49, 9, 29, 0, 0, '2016-07-16', '', NULL, NULL),
	(50, 10, 32, 0, 0, '2016-06-08', '', NULL, NULL),
	(51, 12, 4, 0, 0, '2016-06-24', '', NULL, NULL),
	(54, 7, 31, 0, 0, '2016-06-08', '', NULL, NULL),
	(55, 4, 24, NULL, NULL, NULL, 'Interesting Play Must Be', '2016-05-12 08:55:03', '2016-05-12 08:55:03'),
	(78, 37, 34, 0, 0, '2016-05-14', NULL, '2016-05-14 09:58:58', '2016-05-14 09:58:58'),
	(86, 2, 4, 11, 1, '0000-00-00', NULL, '2016-05-28 05:41:15', '2016-05-28 05:41:15'),
	(87, 2, 12, 0, 0, '0000-00-00', NULL, '2016-05-28 05:55:59', '2016-05-28 05:55:59'),
	(88, 4, 1, 0, 0, '2016-05-14', NULL, '2016-06-01 02:37:45', '2016-06-01 02:37:45'),
	(89, 1, 6, 0, 0, '2016-05-08', NULL, '2016-06-02 06:42:01', '2016-06-02 06:42:01'),
	(90, 12, 38, 0, 0, '2016-06-24', NULL, '2016-06-02 06:42:17', '2016-06-02 06:42:17'),
	(91, 1, 20, 0, 0, '2016-06-08', NULL, '2016-06-02 06:43:01', '2016-06-02 06:43:01'),
	(92, 2, 10, 0, 0, '2016-06-08', NULL, '2016-06-03 11:36:49', '2016-06-03 11:36:49'),
	(97, 3, 4, 0, 0, '0000-00-00', NULL, '2016-06-04 02:09:49', '2016-06-04 02:09:49'),
	(98, 3, 5, 0, 0, '0000-00-00', NULL, '2016-06-04 02:10:45', '2016-06-04 02:10:45'),
	(99, 3, 4, 0, 0, '0000-00-00', NULL, '2016-06-04 02:14:19', '2016-06-04 02:14:19'),
	(100, 6, 13, 0, 0, '0000-00-00', NULL, '2016-06-04 02:14:42', '2016-06-04 02:14:42');

-- Дамп структуры для таблица foot.players
DROP TABLE IF EXISTS `players`;
CREATE TABLE IF NOT EXISTS `players` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `team_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(100) NOT NULL DEFAULT '0',
  `position` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=94 DEFAULT CHARSET=latin1;

-- Дамп данных таблицы foot.players: ~81 rows (приблизительно)
DELETE FROM `players`;
INSERT INTO `players` (`id`, `team_id`, `name`, `position`) VALUES
	(1, 2, 'Hary Kane', 'Left Forward'),
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
	(68, 1, 'Kevin Tripier', 'Right Defender'),
	(73, 32, 'Roberto Soldado', 'Forward'),
	(74, 32, 'Cedric Bakambu', 'Forward'),
	(76, 19, 'Andrey Malafeev', 'Goalkeeper'),
	(77, 34, 'Andrei Iarmolenko', 'Right Winger'),
	(78, 34, 'Andrei Iarmolenko', 'Right Winger'),
	(79, 34, 'Andrei Iarmolenko', 'Right Winger'),
	(80, 34, 'Andrei Iarmolenko', 'Right Winger'),
	(81, 4, 'Roberto Soldado', 'dsf'),
	(82, 4, 'Roberto Soldado', 'dsf'),
	(83, 2, 'dddddddddddddddd', 'dsfsdf'),
	(84, 0, '0', '0'),
	(85, 0, 'select password from `user` limit 1', '0'),
	(86, 1, 'Ben Davies', 'Defender'),
	(87, 1, 'Ben Davies', 'Defender'),
	(88, 10, 'Farmonello', 'Defender'),
	(89, 5, 'willian', 'forward'),
	(90, 5, 'willian', 'forward'),
	(91, 18, 'aaaa', 'nbbbbbbbbb'),
	(92, 12, '111sdf', 'dddddddddddddd'),
	(93, 13, 'Ð²Ð°Ð½Ñ', 'Ð¿ÐµÑ‚Ñ');

-- Дамп структуры для таблица foot.teams
DROP TABLE IF EXISTS `teams`;
CREATE TABLE IF NOT EXISTS `teams` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT '0',
  `logo` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=latin1;

-- Дамп данных таблицы foot.teams: ~32 rows (приблизительно)
DELETE FROM `teams`;
INSERT INTO `teams` (`id`, `name`, `logo`) VALUES
	(1, 'Tottanhamsss', '/img/tottanham.png'),
	(2, 'Leicter Citys', '/img/leicter_city.png'),
	(3, 'Borussia Dortmund', ''),
	(4, 'Bayern Munchen', '/img/bayern_munchen.png'),
	(5, 'Chelsea', '/img/chelsea.png'),
	(6, 'Manchester United', ''),
	(7, 'Manchester City', '/img/man_city.png'),
	(8, 'Liverpool', ''),
	(9, 'Bayer Liverkusen', '/img/bayer_liverkusen.png'),
	(10, 'Inter Milan', '/img/inter.png'),
	(11, 'Juventus', ''),
	(12, 'AS Roma', '/img/roma.png'),
	(13, 'FC Barcelona', ''),
	(14, 'Real Madrid', ''),
	(15, 'Athletico Madrid', '/img/athletico_madrid.png'),
	(16, 'Valencia', '/img/valencia.png'),
	(17, 'PSG', ''),
	(18, 'FC Porto', '/img/portu.png'),
	(19, 'Zenith St, Piterbourgh', ''),
	(20, 'CSKA Moscow', ''),
	(21, 'Arsenal', ''),
	(24, 'SL Benfica', ''),
	(25, 'FC Schalke', ''),
	(26, 'Napoli', '0'),
	(27, 'AC Milan', '/img/milan.png'),
	(28, 'AC Fiorentina', '0'),
	(29, 'FC Shakhtar', '0'),
	(30, 'Southampton', '0'),
	(31, 'Everton', '0'),
	(32, 'Villareal', '0'),
	(33, 'West Ham', '0'),
	(34, 'Dynamo Kiyiv', '0'),
	(35, 'Metalist Kharkiv', '/img/metalist.png'),
	(36, 'Metalist Kharkiv', '/img/metalist.png'),
	(37, 'Metalist Kharkiv', '/img/metalist.png'),
	(38, 'FC Krasnodar', '/img/metalist.png'),
	(39, 'Dfds', NULL),
	(40, 'ddddddddd', NULL),
	(41, 'aaaa', NULL);

-- Дамп структуры для таблица foot.user
DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `is_admin` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=latin1;

-- Дамп данных таблицы foot.user: ~19 rows (приблизительно)
DELETE FROM `user`;
INSERT INTO `user` (`id`, `login`, `password`, `is_admin`) VALUES
	(2, 'princ_grenlandii', '12345', 1),
	(3, 'shurik', '12345', 0),
	(4, 'emin', '', 0),
	(29, 'Ksusha', '', 0),
	(39, 'YNWA', '', 0),
	(41, 'Princessa_Mourinho', '', 0),
	(42, 'Allegri', '', 0),
	(48, 'Zlatanka', '', 0),
	(49, 'Zidane', 'france', 0),
	(50, 'Torres', '', 0),
	(51, 'Red_Deivil', '', 0),
	(52, 'Fialka', '', 0),
	(53, 'Alexander_Tretiak', '1999', 0),
	(54, 'emin', '', 0),
	(55, 'shurik', 'absent', 0),
	(56, 'lit@li.com', '', 0),
	(57, 'lit@li.com', '', 0),
	(58, 'leicter@rambler.ru', 'vardy1', 0),
	(59, 'spurs@gmail.com', 'petuhi', 0);

-- Дамп структуры для таблица foot.user_teams
DROP TABLE IF EXISTS `user_teams`;
CREATE TABLE IF NOT EXISTS `user_teams` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `team_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user` (`user_id`),
  KEY `FK_user_teams_teams` (`team_id`),
  CONSTRAINT `FK_user_teams_teams` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=205 DEFAULT CHARSET=latin1;

-- Дамп данных таблицы foot.user_teams: ~4 rows (приблизительно)
DELETE FROM `user_teams`;
INSERT INTO `user_teams` (`id`, `team_id`, `user_id`) VALUES
	(118, 2, 50),
	(120, 2, 55),
	(203, 19, 2),
	(204, 10, 2);