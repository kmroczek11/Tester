-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 18 Kwi 2020, 17:15
-- Wersja serwera: 10.4.8-MariaDB
-- Wersja PHP: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `tester`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `questions`
--

CREATE TABLE `questions` (
  `question_id` int(11) NOT NULL,
  `question` varchar(250) COLLATE utf8_polish_ci NOT NULL,
  `answer_a` varchar(250) COLLATE utf8_polish_ci NOT NULL,
  `answer_b` varchar(250) COLLATE utf8_polish_ci NOT NULL,
  `answer_c` varchar(250) COLLATE utf8_polish_ci NOT NULL,
  `answer_d` varchar(250) COLLATE utf8_polish_ci NOT NULL,
  `correct` char(2) COLLATE utf8_polish_ci NOT NULL,
  `correct_amount` int(11) NOT NULL,
  `incorrect_amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `questions`
--

INSERT INTO `questions` (`question_id`, `question`, `answer_a`, `answer_b`, `answer_c`, `answer_d`, `correct`, `correct_amount`, `incorrect_amount`) VALUES
(1, 'Do czego służy język HTML?', 'Do projektowania wykresów', 'Do tworzenia skryptów', 'Do pisania programów graficznych', 'Do tworzenia stron internetowych', 'D', 1, 1),
(2, 'Za pomocą jakiego polecenia w języku HTML wstawia się hiperłącze?', 'a ant', 'a href', 'a int', 'b href', 'B', 1, 2),
(3, 'Jakim słowem kluczowym w JavaScript rozpoczynamy deklarację stałych?', 'var', 'const', 'let', 'int', 'B', 1, 2),
(4, 'Co opisuje instrukcja if?', 'Instrukcję przypisania', 'Instrukcję warunkową', 'Deklarację zmiennej', 'Pętlę', 'B', 1, 2),
(5, 'Poprzez wykonanie jakiej instrukcji w C++ funkcja zwraca wynik działania?', 'Return', 'While', 'Continue', 'Do', 'A', 3, 0),
(6, 'Co to jest CSS?', 'Jest to język służący do pisania programów bazodanowych', 'Jest to język służący do budowania skryptów na stronach WWW', 'Jest to język służący do opisu formy prezentacji (wyświetlania) stron internetowych', 'Jest to język służący do programowania niskopoziomowego', 'C', 1, 2),
(7, 'Jakim znakiem w języku C++ jest zakończona każda komenda?', '#', ':', ';', '*', 'C', 0, 2),
(8, 'Kiedy powstał język PHP?', '1995', '1992', '2001', '1989', 'A', 3, 0),
(9, 'Kod binarny składa się z?', 'dwóch liter „a” i „z”', 'dwóch cyfr „0” i „1”', 'trzech liter „a”, „o”, „z”', 'trzech cyfr „2”, „5” ,”8”', 'B', 1, 1),
(10, 'Kompilacja – jest to?', 'tłumaczenie programu źródłowego na kod maszynowy', 'przeszukiwanie dysku twardego', 'tłumaczenie programu źródłowego do pliku', 'tłumaczenie programu źródłowego na maszynę', 'A', 3, 0),
(11, 'Do tworzenia baz danych używamy?', 'Word', 'Access', 'Excel', 'PowerPoint', 'B', 1, 2);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`question_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `questions`
--
ALTER TABLE `questions`
  MODIFY `question_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
