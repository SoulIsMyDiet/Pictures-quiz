-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Czas generowania: 06 Sty 2017, 11:24
-- Wersja serwera: 10.1.13-MariaDB
-- Wersja PHP: 5.5.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `obrazy`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `obrazy`
--

CREATE TABLE `obrazy` (
  `ID` int(11) NOT NULL,
  `tyt0` text COLLATE utf8_polish_ci NOT NULL,
  `autor` text COLLATE utf8_polish_ci NOT NULL,
  `tyt1` text COLLATE utf8_polish_ci NOT NULL,
  `tyt2` text COLLATE utf8_polish_ci NOT NULL,
  `tyt3` text COLLATE utf8_polish_ci NOT NULL,
  `muzeum` text COLLATE utf8_polish_ci NOT NULL,
  `rok_od` int(11) NOT NULL,
  `rok_do` int(11) NOT NULL,
  `styl` text COLLATE utf8_polish_ci NOT NULL,
  `pod_autor` text COLLATE utf8_polish_ci NOT NULL,
  `emocje` int(11) NOT NULL,
  `slawa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `obrazy`
--

INSERT INTO `obrazy` (`ID`, `tyt0`, `autor`, `tyt1`, `tyt2`, `tyt3`, `muzeum`, `rok_od`, `rok_do`, `styl`, `pod_autor`, `emocje`, `slawa`) VALUES
(1, 'monalisa', 'Leonardo da vinci', 'chlopak pzrebrany za kobiete', 'dziewczyna przebrana za chlopaka', 'Mona Lisa', 'Luwr', 1503, 1506, 'renesans', 'Michał Anioł', 70, 100),
(2, 'dziewczynazperla', 'Jan Vermeer', 'chlopak pzrebrany za kobiete', 'dziewczyna przebrana za chlopaka', 'dziewczyna z perla', 'Mauritshuis', 1660, 1670, 'barok', 'Leonardo da Vinci', 68, 88),
(3, 'guernica', 'Picasso', 'mona lisa', 'nie wiem ale niezly towar bral', 'dziewczyna z perla', 'Muzeum Narodowe Centrum Sztuki Królowej Zofii', 1937, 1937, 'kubizm', 'Salvador Dali', 85, 80),
(4, 'impresja', 'Claude Monet', 'Poranek kojota', 'byle do piątku', 'Oj bedzie bal, oj bedzie..', 'Musée Marmottan Monet w Paryżu', 1872, 1872, 'impresjonizm', 'Edouard Manet', 80, 90),
(5, 'gwiazdzistanoc', 'Vincent Van Gogh', 'Poranek kojota', 'byle do piątku', 'Oj bedzie bal, oj bedzie..', 'Museum of Modern Art Nowy York', 1889, 1889, 'postimpresjonizm', 'Claude Monet', 50, 72);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `obrazy`
--
ALTER TABLE `obrazy`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `obrazy`
--
ALTER TABLE `obrazy`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
