-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 24, 2026 at 12:16 PM
-- Wersja serwera: 10.4.32-MariaDB
-- Wersja PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `barcelona`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `akademia`
--

CREATE TABLE `akademia` (
  `id` int(11) NOT NULL,
  `imie_nazwisko` varchar(100) NOT NULL,
  `narodowos` varchar(50) DEFAULT '',
  `overall_start` int(11) DEFAULT 0,
  `potencjal_koniec` int(11) DEFAULT 0,
  `pozycja` varchar(10) NOT NULL,
  `klub` varchar(100) DEFAULT '',
  `status` enum('pierwsza_druzyna','akademia','wypozyczony') NOT NULL DEFAULT 'akademia'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `byli_zawodnicy`
--

CREATE TABLE `byli_zawodnicy` (
  `id` int(11) NOT NULL,
  `imie_nazwisko` varchar(100) NOT NULL,
  `narodowos` varchar(50) DEFAULT '',
  `wiek_odejscia` int(11) DEFAULT 0,
  `overall_start` int(11) DEFAULT 0,
  `overall_koniec` int(11) DEFAULT 0,
  `gack` varchar(30) DEFAULT '',
  `pozycja` varchar(10) NOT NULL,
  `skup` varchar(50) DEFAULT '',
  `sprzedaz` varchar(50) DEFAULT '',
  `zdjecie` varchar(255) DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `puchary`
--

CREATE TABLE `puchary` (
  `id` int(11) NOT NULL,
  `nazwa` varchar(100) NOT NULL,
  `kategoria` enum('domowe','kontynentalne') NOT NULL,
  `ilosc` int(11) NOT NULL DEFAULT 0,
  `zdjecie` varchar(255) DEFAULT '',
  `ilosc_historyczna` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `puchary`
--

INSERT INTO `puchary` (`id`, `nazwa`, `kategoria`, `ilosc`, `zdjecie`, `ilosc_historyczna`) VALUES
(1, 'La Liga', 'domowe', 28, 'puchar_laliga.png', 28),
(2, 'Super Copa', 'domowe', 16, 'puchar_supercopa.png', 16),
(3, 'Copa de España', 'domowe', 32, 'puchar_copa.png', 32),
(4, 'Puchar Przedsezonowy', 'domowe', 47, 'puchar_przedsezonowy.png', 47),
(5, 'UEFA Champions League', 'kontynentalne', 5, 'puchar_ucl.png', 5),
(6, 'UEFA Europa League', 'kontynentalne', 0, 'puchar_uel.png', 0),
(7, 'UEFA Conference League', 'kontynentalne', 0, 'puchar_uecl.png', 0),
(8, 'Super Cup', 'kontynentalne', 5, 'puchar_supercup.png', 5);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `sezony`
--

CREATE TABLE `sezony` (
  `id` int(11) NOT NULL,
  `sezon` varchar(10) NOT NULL,
  `la_liga` int(11) DEFAULT 0,
  `copa_de_espana` int(11) DEFAULT 0,
  `super_copa` int(11) DEFAULT 0,
  `puchar_europejski_nazwa` varchar(50) DEFAULT 'UEFA Champions League',
  `puchar_europejski` int(11) DEFAULT 0,
  `super_cup` int(11) DEFAULT 0,
  `puchar_przedsezonowy` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sezony`
--

INSERT INTO `sezony` (`id`, `sezon`, `la_liga`, `copa_de_espana`, `super_copa`, `puchar_europejski_nazwa`, `puchar_europejski`, `super_cup`, `puchar_przedsezonowy`) VALUES
(1, '25/26', 0, 0, 0, 'UEFA Champions League', 0, 0, 0),
(2, '26/27', 0, 0, 0, 'UEFA Champions League', 0, 0, 0),
(3, '27/28', 0, 0, 0, 'UEFA Champions League', 0, 0, 0),
(4, '28/29', 0, 0, 0, 'UEFA Champions League', 0, 0, 0),
(5, '29/30', 0, 0, 0, 'UEFA Champions League', 0, 0, 0),
(6, '30/31', 0, 0, 0, 'UEFA Champions League', 0, 0, 0),
(7, '31/32', 0, 0, 0, 'UEFA Champions League', 0, 0, 0),
(8, '32/33', 0, 0, 0, 'UEFA Champions League', 0, 0, 0),
(9, '33/34', 0, 0, 0, 'UEFA Champions League', 0, 0, 0),
(10, '34/35', 0, 0, 0, 'UEFA Champions League', 0, 0, 0),
(11, '35/36', 0, 0, 0, 'UEFA Champions League', 0, 0, 0),
(12, '36/37', 0, 0, 0, 'UEFA Champions League', 0, 0, 0),
(13, '37/38', 0, 0, 0, 'UEFA Champions League', 0, 0, 0),
(14, '38/39', 0, 0, 0, 'UEFA Champions League', 0, 0, 0),
(15, '39/40', 0, 0, 0, 'UEFA Champions League', 0, 0, 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `sklad`
--

CREATE TABLE `sklad` (
  `id` int(11) NOT NULL,
  `numer` int(11) NOT NULL,
  `pozycja` varchar(10) NOT NULL,
  `imie_nazwisko` varchar(100) NOT NULL,
  `wiek` int(11) NOT NULL,
  `overall` int(11) NOT NULL,
  `typ` enum('podstawowy','rezerwowy') NOT NULL DEFAULT 'podstawowy'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sklad`
--

INSERT INTO `sklad` (`id`, `numer`, `pozycja`, `imie_nazwisko`, `wiek`, `overall`, `typ`) VALUES
(1, 1, 'BR', 'Joan Garcia', 24, 86, 'podstawowy'),
(2, 2, 'LO', 'Alejandro Balde', 21, 83, 'podstawowy'),
(3, 5, 'SO', 'Pau Cubarsi', 18, 83, 'podstawowy'),
(4, 4, 'SO', 'Dean Huijsen', 20, 81, 'podstawowy'),
(5, 12, 'PO', 'Givairo Read', 19, 76, 'podstawowy'),
(6, 18, 'SPD', 'Joao Neves', 20, 87, 'podstawowy'),
(7, 8, 'SP', 'Pedri', 22, 90, 'podstawowy'),
(8, 6, 'SP', 'Pablo Barrios', 22, 83, 'podstawowy'),
(9, 11, 'LS', 'Desire Doue', 20, 85, 'podstawowy'),
(10, 9, 'N', 'Julian Alvarez', 25, 86, 'podstawowy'),
(11, 10, 'PS', 'Lamine Yamal', 17, 89, 'podstawowy'),
(12, 30, 'BR', 'Iñaki Peña', 26, 76, 'rezerwowy'),
(13, 3, 'SO', 'Ronald Araujo', 26, 81, 'rezerwowy'),
(14, 15, 'LO', 'Ian Maatsen', 23, 79, 'rezerwowy'),
(15, 22, 'PO', 'Joao Cancelo', 31, 84, 'rezerwowy'),
(16, 16, 'SPD', 'Pablo Gavi', 20, 83, 'rezerwowy'),
(17, 14, 'SP', 'Dani Olmo', 27, 84, 'rezerwowy'),
(18, 7, 'LS', 'Marcus Rashford', 27, 82, 'rezerwowy'),
(19, 27, 'PS', 'Pedro Neto', 25, 82, 'rezerwowy'),
(20, 21, 'N', 'Ferran Torres', 25, 84, 'rezerwowy');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `statystyki`
--

CREATE TABLE `statystyki` (
  `id` int(11) NOT NULL,
  `zawodnik_id` int(11) NOT NULL,
  `sezon` varchar(10) NOT NULL,
  `gack` varchar(20) DEFAULT NULL,
  `nagrody` varchar(100) DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `statystyki`
--

INSERT INTO `statystyki` (`id`, `zawodnik_id`, `sezon`, `gack`, `nagrody`) VALUES
(1, 1, '25/26', '', ''),
(2, 1, '26/27', '', ''),
(3, 1, '27/28', '', ''),
(4, 1, '28/29', '', ''),
(5, 1, '29/30', '', ''),
(6, 1, '30/31', '', ''),
(7, 1, '31/32', '', ''),
(8, 1, '32/33', '', ''),
(9, 1, '33/34', '', ''),
(10, 1, '34/35', '', ''),
(11, 1, '35/36', '', ''),
(12, 1, '36/37', '', ''),
(13, 1, '37/38', '', ''),
(14, 1, '38/39', '', ''),
(15, 1, '39/40', '', ''),
(16, 2, '25/26', '', ''),
(17, 2, '26/27', '', ''),
(18, 2, '27/28', '', ''),
(19, 2, '28/29', '', ''),
(20, 2, '29/30', '', ''),
(21, 2, '30/31', '', ''),
(22, 2, '31/32', '', ''),
(23, 2, '32/33', '', ''),
(24, 2, '33/34', '', ''),
(25, 2, '34/35', '', ''),
(26, 2, '35/36', '', ''),
(27, 2, '36/37', '', ''),
(28, 2, '37/38', '', ''),
(29, 2, '38/39', '', ''),
(30, 2, '39/40', '', ''),
(31, 3, '25/26', '', ''),
(32, 3, '26/27', '', ''),
(33, 3, '27/28', '', ''),
(34, 3, '28/29', '', ''),
(35, 3, '29/30', '', ''),
(36, 3, '30/31', '', ''),
(37, 3, '31/32', '', ''),
(38, 3, '32/33', '', ''),
(39, 3, '33/34', '', ''),
(40, 3, '34/35', '', ''),
(41, 3, '35/36', '', ''),
(42, 3, '36/37', '', ''),
(43, 3, '37/38', '', ''),
(44, 3, '38/39', '', ''),
(45, 3, '39/40', '', ''),
(46, 4, '25/26', '', ''),
(47, 4, '26/27', '', ''),
(48, 4, '27/28', '', ''),
(49, 4, '28/29', '', ''),
(50, 4, '29/30', '', ''),
(51, 4, '30/31', '', ''),
(52, 4, '31/32', '', ''),
(53, 4, '32/33', '', ''),
(54, 4, '33/34', '', ''),
(55, 4, '34/35', '', ''),
(56, 4, '35/36', '', ''),
(57, 4, '36/37', '', ''),
(58, 4, '37/38', '', ''),
(59, 4, '38/39', '', ''),
(60, 4, '39/40', '', ''),
(61, 5, '25/26', '', ''),
(62, 5, '26/27', '', ''),
(63, 5, '27/28', '', ''),
(64, 5, '28/29', '', ''),
(65, 5, '29/30', '', ''),
(66, 5, '30/31', '', ''),
(67, 5, '31/32', '', ''),
(68, 5, '32/33', '', ''),
(69, 5, '33/34', '', ''),
(70, 5, '34/35', '', ''),
(71, 5, '35/36', '', ''),
(72, 5, '36/37', '', ''),
(73, 5, '37/38', '', ''),
(74, 5, '38/39', '', ''),
(75, 5, '39/40', '', ''),
(76, 6, '25/26', '', ''),
(77, 6, '26/27', '', ''),
(78, 6, '27/28', '', ''),
(79, 6, '28/29', '', ''),
(80, 6, '29/30', '', ''),
(81, 6, '30/31', '', ''),
(82, 6, '31/32', '', ''),
(83, 6, '32/33', '', ''),
(84, 6, '33/34', '', ''),
(85, 6, '34/35', '', ''),
(86, 6, '35/36', '', ''),
(87, 6, '36/37', '', ''),
(88, 6, '37/38', '', ''),
(89, 6, '38/39', '', ''),
(90, 6, '39/40', '', ''),
(91, 7, '25/26', '', ''),
(92, 7, '26/27', '', ''),
(93, 7, '27/28', '', ''),
(94, 7, '28/29', '', ''),
(95, 7, '29/30', '', ''),
(96, 7, '30/31', '', ''),
(97, 7, '31/32', '', ''),
(98, 7, '32/33', '', ''),
(99, 7, '33/34', '', ''),
(100, 7, '34/35', '', ''),
(101, 7, '35/36', '', ''),
(102, 7, '36/37', '', ''),
(103, 7, '37/38', '', ''),
(104, 7, '38/39', '', ''),
(105, 7, '39/40', '', ''),
(106, 8, '25/26', '', ''),
(107, 8, '26/27', '', ''),
(108, 8, '27/28', '', ''),
(109, 8, '28/29', '', ''),
(110, 8, '29/30', '', ''),
(111, 8, '30/31', '', ''),
(112, 8, '31/32', '', ''),
(113, 8, '32/33', '', ''),
(114, 8, '33/34', '', ''),
(115, 8, '34/35', '', ''),
(116, 8, '35/36', '', ''),
(117, 8, '36/37', '', ''),
(118, 8, '37/38', '', ''),
(119, 8, '38/39', '', ''),
(120, 8, '39/40', '', ''),
(121, 9, '25/26', '', ''),
(122, 9, '26/27', '', ''),
(123, 9, '27/28', '', ''),
(124, 9, '28/29', '', ''),
(125, 9, '29/30', '', ''),
(126, 9, '30/31', '', ''),
(127, 9, '31/32', '', ''),
(128, 9, '32/33', '', ''),
(129, 9, '33/34', '', ''),
(130, 9, '34/35', '', ''),
(131, 9, '35/36', '', ''),
(132, 9, '36/37', '', ''),
(133, 9, '37/38', '', ''),
(134, 9, '38/39', '', ''),
(135, 9, '39/40', '', ''),
(136, 10, '25/26', '', ''),
(137, 10, '26/27', '', ''),
(138, 10, '27/28', '', ''),
(139, 10, '28/29', '', ''),
(140, 10, '29/30', '', ''),
(141, 10, '30/31', '', ''),
(142, 10, '31/32', '', ''),
(143, 10, '32/33', '', ''),
(144, 10, '33/34', '', ''),
(145, 10, '34/35', '', ''),
(146, 10, '35/36', '', ''),
(147, 10, '36/37', '', ''),
(148, 10, '37/38', '', ''),
(149, 10, '38/39', '', ''),
(150, 10, '39/40', '', ''),
(151, 11, '25/26', '', ''),
(152, 11, '26/27', '', ''),
(153, 11, '27/28', '', ''),
(154, 11, '28/29', '', ''),
(155, 11, '29/30', '', ''),
(156, 11, '30/31', '', ''),
(157, 11, '31/32', '', ''),
(158, 11, '32/33', '', ''),
(159, 11, '33/34', '', ''),
(160, 11, '34/35', '', ''),
(161, 11, '35/36', '', ''),
(162, 11, '36/37', '', ''),
(163, 11, '37/38', '', ''),
(164, 11, '38/39', '', ''),
(165, 11, '39/40', '', ''),
(166, 12, '25/26', '', ''),
(167, 12, '26/27', '', ''),
(168, 12, '27/28', '', ''),
(169, 12, '28/29', '', ''),
(170, 12, '29/30', '', ''),
(171, 12, '30/31', '', ''),
(172, 12, '31/32', '', ''),
(173, 12, '32/33', '', ''),
(174, 12, '33/34', '', ''),
(175, 12, '34/35', '', ''),
(176, 12, '35/36', '', ''),
(177, 12, '36/37', '', ''),
(178, 12, '37/38', '', ''),
(179, 12, '38/39', '', ''),
(180, 12, '39/40', '', ''),
(181, 13, '25/26', '', ''),
(182, 13, '26/27', '', ''),
(183, 13, '27/28', '', ''),
(184, 13, '28/29', '', ''),
(185, 13, '29/30', '', ''),
(186, 13, '30/31', '', ''),
(187, 13, '31/32', '', ''),
(188, 13, '32/33', '', ''),
(189, 13, '33/34', '', ''),
(190, 13, '34/35', '', ''),
(191, 13, '35/36', '', ''),
(192, 13, '36/37', '', ''),
(193, 13, '37/38', '', ''),
(194, 13, '38/39', '', ''),
(195, 13, '39/40', '', ''),
(196, 14, '25/26', '', ''),
(197, 14, '26/27', '', ''),
(198, 14, '27/28', '', ''),
(199, 14, '28/29', '', ''),
(200, 14, '29/30', '', ''),
(201, 14, '30/31', '', ''),
(202, 14, '31/32', '', ''),
(203, 14, '32/33', '', ''),
(204, 14, '33/34', '', ''),
(205, 14, '34/35', '', ''),
(206, 14, '35/36', '', ''),
(207, 14, '36/37', '', ''),
(208, 14, '37/38', '', ''),
(209, 14, '38/39', '', ''),
(210, 14, '39/40', '', ''),
(211, 15, '25/26', '', ''),
(212, 15, '26/27', '', ''),
(213, 15, '27/28', '', ''),
(214, 15, '28/29', '', ''),
(215, 15, '29/30', '', ''),
(216, 15, '30/31', '', ''),
(217, 15, '31/32', '', ''),
(218, 15, '32/33', '', ''),
(219, 15, '33/34', '', ''),
(220, 15, '34/35', '', ''),
(221, 15, '35/36', '', ''),
(222, 15, '36/37', '', ''),
(223, 15, '37/38', '', ''),
(224, 15, '38/39', '', ''),
(225, 15, '39/40', '', ''),
(226, 16, '25/26', '', ''),
(227, 16, '26/27', '', ''),
(228, 16, '27/28', '', ''),
(229, 16, '28/29', '', ''),
(230, 16, '29/30', '', ''),
(231, 16, '30/31', '', ''),
(232, 16, '31/32', '', ''),
(233, 16, '32/33', '', ''),
(234, 16, '33/34', '', ''),
(235, 16, '34/35', '', ''),
(236, 16, '35/36', '', ''),
(237, 16, '36/37', '', ''),
(238, 16, '37/38', '', ''),
(239, 16, '38/39', '', ''),
(240, 16, '39/40', '', ''),
(241, 17, '25/26', '', ''),
(242, 17, '26/27', '', ''),
(243, 17, '27/28', '', ''),
(244, 17, '28/29', '', ''),
(245, 17, '29/30', '', ''),
(246, 17, '30/31', '', ''),
(247, 17, '31/32', '', ''),
(248, 17, '32/33', '', ''),
(249, 17, '33/34', '', ''),
(250, 17, '34/35', '', ''),
(251, 17, '35/36', '', ''),
(252, 17, '36/37', '', ''),
(253, 17, '37/38', '', ''),
(254, 17, '38/39', '', ''),
(255, 17, '39/40', '', ''),
(256, 18, '25/26', '', ''),
(257, 18, '26/27', '', ''),
(258, 18, '27/28', '', ''),
(259, 18, '28/29', '', ''),
(260, 18, '29/30', '', ''),
(261, 18, '30/31', '', ''),
(262, 18, '31/32', '', ''),
(263, 18, '32/33', '', ''),
(264, 18, '33/34', '', ''),
(265, 18, '34/35', '', ''),
(266, 18, '35/36', '', ''),
(267, 18, '36/37', '', ''),
(268, 18, '37/38', '', ''),
(269, 18, '38/39', '', ''),
(270, 18, '39/40', '', ''),
(271, 19, '25/26', '', ''),
(272, 19, '26/27', '', ''),
(273, 19, '27/28', '', ''),
(274, 19, '28/29', '', ''),
(275, 19, '29/30', '', ''),
(276, 19, '30/31', '', ''),
(277, 19, '31/32', '', ''),
(278, 19, '32/33', '', ''),
(279, 19, '33/34', '', ''),
(280, 19, '34/35', '', ''),
(281, 19, '35/36', '', ''),
(282, 19, '36/37', '', ''),
(283, 19, '37/38', '', ''),
(284, 19, '38/39', '', ''),
(285, 19, '39/40', '', ''),
(286, 20, '25/26', '', ''),
(287, 20, '26/27', '', ''),
(288, 20, '27/28', '', ''),
(289, 20, '28/29', '', ''),
(290, 20, '29/30', '', ''),
(291, 20, '30/31', '', ''),
(292, 20, '31/32', '', ''),
(293, 20, '32/33', '', ''),
(294, 20, '33/34', '', ''),
(295, 20, '34/35', '', ''),
(296, 20, '35/36', '', ''),
(297, 20, '36/37', '', ''),
(298, 20, '37/38', '', ''),
(299, 20, '38/39', '', ''),
(300, 20, '39/40', '', '');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `trener_puchary`
--

CREATE TABLE `trener_puchary` (
  `id` int(11) NOT NULL,
  `nazwa` varchar(100) NOT NULL,
  `ilosc` int(11) NOT NULL DEFAULT 0,
  `zdjecie` varchar(255) DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `trener_puchary`
--

INSERT INTO `trener_puchary` (`id`, `nazwa`, `ilosc`, `zdjecie`) VALUES
(1, 'Światowy Trener Roku', 3, 'nagroda_trener_roku.png'),
(2, 'Menadżer Miesiąca', 12, 'nagroda_menedzer_miesiaca.png'),
(3, 'UEFA Champions League', 3, 'puchar_ucl.png'),
(4, 'UEFA Super Cup', 4, 'puchar_supercup.png'),
(5, 'UEFA Europa League', 0, 'puchar_uel.png'),
(6, 'UEFA Conference League', 0, 'puchar_uecl.png'),
(7, 'La Liga', 3, 'puchar_laliga.png'),
(8, 'Super Copa', 3, 'puchar_supercopa.png'),
(9, 'Copa de Espana', 2, 'puchar_copa.png'),
(10, 'Premier League', 6, 'puchar_anglia_liga.png'),
(11, 'FA Community Shield', 3, 'puchar_anglia_super.png'),
(12, 'FA Cup', 2, 'puchar_anglia_fa.png'),
(13, 'Bundesliga', 3, 'puchar_niemcy_liga.png'),
(14, 'Franz Beckenbauer Supercup', 0, 'puchar_niemcy_super.png'),
(15, 'DFB-Pokal', 2, 'puchar_niemcy_dfb.png'),
(16, 'World Cup', 0, 'world.png'),
(17, 'Mistrzostwa Europy', 0, 'euro.png'),
(18, 'Puchar Przedsezonowy', 8, 'puchar_przedsezonowy.png');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `akademia`
--
ALTER TABLE `akademia`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `byli_zawodnicy`
--
ALTER TABLE `byli_zawodnicy`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `puchary`
--
ALTER TABLE `puchary`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `sezony`
--
ALTER TABLE `sezony`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sezon` (`sezon`);

--
-- Indeksy dla tabeli `sklad`
--
ALTER TABLE `sklad`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `statystyki`
--
ALTER TABLE `statystyki`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uniq_zawodnik_sezon` (`zawodnik_id`,`sezon`);

--
-- Indeksy dla tabeli `trener_puchary`
--
ALTER TABLE `trener_puchary`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `akademia`
--
ALTER TABLE `akademia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `byli_zawodnicy`
--
ALTER TABLE `byli_zawodnicy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `puchary`
--
ALTER TABLE `puchary`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `sezony`
--
ALTER TABLE `sezony`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;

--
-- AUTO_INCREMENT for table `sklad`
--
ALTER TABLE `sklad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `statystyki`
--
ALTER TABLE `statystyki`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=529;

--
-- AUTO_INCREMENT for table `trener_puchary`
--
ALTER TABLE `trener_puchary`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
