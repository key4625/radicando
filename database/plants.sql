-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 18, 2021 at 09:20 AM
-- Server version: 5.7.31
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `straorto_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `plants`
--

DELETE FROM plants;

--
-- Dumping data for table `plants`
--

INSERT INTO `plants` (`id`, `abbreviazione`, `nome`, `sulla_fila`, `tra_file`, `trapianto`, `semina`, `semina_out`, `raccolta`, `gg_campo`, `consumatore`, `stagione`, `trattamenti_consigliati`, `richieste_nutrizionali`, `resa_pianta_kg`, `vendibile`, `prezzo_kg`, `image`, `created_at`, `updated_at`) VALUES
(1, 'AGL', 'Aglio', 5, 25, NULL, NULL, '[10, 11]', '[8]', '[75, 90]', 'Forte', 'Inv-est', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'ANGU', 'Anguria', 100, 100, '[4, 5]', NULL, NULL, NULL, NULL, 'Forte', NULL, NULL, NULL, 10, NULL, NULL, NULL, NULL, NULL),
(3, 'BRR', 'Barbabietola rossa', 5, 20, '[3, 4]', '[2]', NULL, '[5, 6, 7, 8]', '[60]', 'debole', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 'BASI', 'Basilico', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 'BIET', 'Bietola', 30, 25, NULL, NULL, '[2, 3, 9]', NULL, '[90]', 'debole', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 'CARC', 'Carciofo', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 'CARO', 'Carota', 3, 15, NULL, NULL, NULL, NULL, '[85]', 'debole', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, 'CABR', 'Cavolo Broccolo', 45, 35, '[8]', '[6]', NULL, '[11, 12, 1, 2, 3]', '[90]', 'Forte', 'invernale', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(9, 'CAVO', 'Cavolfiore', 45, 35, '[8]', '[6]', NULL, '[11, 12, 1, 2, 3]', '[90]', 'Forte', 'invernale', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(10, 'CETR', 'Cetrioli', 45, 75, '[4, 5]', NULL, NULL, NULL, '[55, 75]', 'Forte', 'estivo', NULL, NULL, 2, 1, NULL, 'https://st2.depositphotos.com/1494134/7007/v/600/depositphotos_70075971-stock-illustration-cucumber-and-slice-isolated-on.jpg', NULL, NULL),
(11, 'CICO', 'Cicoria', 15, 15, NULL, NULL, '[2, 3, 9]', NULL, '[75]', 'debole', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(12, 'CIPO', 'Cipolla', 25, 25, '[2, 3]', NULL, NULL, NULL, NULL, 'Forte', NULL, NULL, NULL, NULL, 1, NULL, 'https://img.icons8.com/emoji/452/onion-emoji.png', NULL, NULL),
(13, 'FAGI', 'Fagiolini', 15, 35, '[3, 4]', NULL, NULL, NULL, '[70]', 'Nessuna', 'estivo', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(14, 'FAVA', 'Fava', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(15, 'FINO', 'Finocchio', 25, 25, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(16, 'ISLT', 'Insalata lattuga', 30, 25, NULL, '[2, 3, 4, 5, 6, 7, 8, 9]', NULL, NULL, '[30, 45]', 'debole', NULL, NULL, NULL, 0.3, 1, NULL, 'https://www.ilgiardinodellemeraviglie.it/upload/cache/immagini/prodotti/orto/207-500x481.jpg', NULL, NULL),
(17, 'ISRC', 'Insalata riccia', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.3, NULL, NULL, NULL, NULL, NULL),
(18, 'MELA', 'Melanzane', 45, 75, '[3, 4, 5]', NULL, NULL, NULL, NULL, 'Forte', NULL, NULL, NULL, 2, 1, NULL, 'https://banner2.cleanpng.com/20190201/ojj/kisspng-emojipedia-aubergines-vegetable-gif-icon-hoboken-farmersampapos-market-5c5419f80f9b25.0463011415490155440639.jpg', NULL, NULL),
(19, 'MELO', 'Melone', 100, 100, '[4, 5]', NULL, NULL, NULL, NULL, 'Forte', NULL, NULL, NULL, 4.8, NULL, NULL, NULL, NULL, NULL),
(20, 'MIST', 'Misticanza', 1, 6, NULL, NULL, '[3, 4, 5, 6, 7, 8, 9, 10]', NULL, NULL, 'debole', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(21, 'PATA', 'Patata', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(22, 'PEPI', 'Peperoncini', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(23, 'PEPE', 'Peperoni', 23, 75, '[4, 5]', NULL, NULL, NULL, NULL, 'Forte', NULL, NULL, 'ferro', 1.2, NULL, NULL, NULL, NULL, NULL),
(24, 'PISE', 'Piselli', 1, 75, NULL, NULL, '[10, 11]', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(25, 'POMO', 'Pomodori', 25, 75, '[3, 4, 5]', NULL, NULL, NULL, NULL, 'Forte', NULL, 'verderame; piretro;', 'calcio', 3.5, 1, NULL, 'http://download.seaicons.com/download/i80791/bingxueling/fruit-vegetables/bingxueling-fruit-vegetables-tomato.ico', NULL, NULL),
(26, 'PORR', 'Porro', 15, 25, NULL, '[2, 8]', NULL, NULL, NULL, 'Forte', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(27, 'RADI', 'Radicchio', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(28, 'RAPA', 'Rapa', 3, 20, NULL, NULL, NULL, NULL, NULL, 'debole', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(29, 'RAVA', 'Ravanello', 3, 15, NULL, NULL, NULL, NULL, NULL, 'debole', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(30, 'ROSC', 'Roscano', NULL, NULL, NULL, '[2, 3, 9]', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(31, 'RUCO', 'Rucola', 3, 15, NULL, NULL, NULL, NULL, NULL, 'debole', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(32, 'SCAL', 'Scalogno', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(33, 'SEDA', 'Sedano', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(34, 'SPIN', 'Spinaci', 15, 15, NULL, '[2, 3, 9]', NULL, NULL, NULL, 'debole', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(35, 'TACC', 'Taccole', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(36, 'VALE', 'Valeriana', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(37, 'ZUCC', 'Zucca', 100, 100, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 15, NULL, NULL, NULL, NULL, NULL),
(38, 'ZUCH', 'Zucchine', 60, 75, NULL, NULL, NULL, NULL, NULL, 'Forte', NULL, NULL, NULL, 5, 1, NULL, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRMydjdMPZLpYn73wfBSV0yWWfG9-WdAG5rwQ&usqp=CAU', NULL, NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
