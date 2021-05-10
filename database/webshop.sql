-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 09 mei 2021 om 12:08
-- Serverversie: 10.4.16-MariaDB
-- PHP-versie: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webshop`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `admin_user`
--

CREATE TABLE `admin_user` (
  `admin_user_id` int(11) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `password_token` varchar(255) DEFAULT NULL,
  `password_changed` timestamp NULL DEFAULT NULL,
  `datetime` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `admin_user`
--

INSERT INTO `admin_user` (`admin_user_id`, `email`, `password`, `password_token`, `password_changed`, `datetime`) VALUES
(1, 'robinadmintest@robintest.nl', '$2y$10$3eJXM2NBYpOH8opTNAHVye/uRtxMhWNLS0NX9qpp1WqygPBnX4vjS', '', '2021-03-31 12:00:01', '2021-03-21 22:26:43');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `category`
--

CREATE TABLE `category` (
  `category_id` int(11) UNSIGNED NOT NULL,
  `name` varchar(60) NOT NULL,
  `description` varchar(400) NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `category`
--

INSERT INTO `category` (`category_id`, `name`, `description`, `active`) VALUES
(1, 'tafellamp', 'Tafellampen zijn binnenlampen voor op tafel.', 1),
(2, 'buitenlamp', 'Buitenlammpen zijn lampen voor buiten.', 1),
(3, 'designlampen', 'Designlampen zijn binnenlampen en buitenlampen met een mooi design.', 1),
(4, 'bureaulamp', 'Bureaulampen zijn binnenlampen voor op uw bureau.', 1),
(69, 'Dikkiediklamp', 'Super vette lamp wel een beetje een dikke lamp maar goed zet hem lekker in de woonkamer ofzo.', 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(11) UNSIGNED NOT NULL,
  `gender` varchar(11) NOT NULL,
  `first_name` varchar(50) CHARACTER SET utf8 NOT NULL,
  `middle_name` varchar(50) CHARACTER SET utf8 NOT NULL,
  `last_name` varchar(50) CHARACTER SET utf8 NOT NULL,
  `street` varchar(50) CHARACTER SET utf8 NOT NULL,
  `house_number` int(4) NOT NULL,
  `house_number_addon` varchar(3) CHARACTER SET utf8 NOT NULL,
  `zip_code` varchar(10) CHARACTER SET utf8 NOT NULL,
  `city` varchar(50) CHARACTER SET utf8 NOT NULL,
  `phone` int(12) NOT NULL,
  `emailadres` varchar(320) NOT NULL,
  `password` varchar(100) NOT NULL,
  `newsletter_subscription` int(1) NOT NULL,
  `date_added` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `customer`
--

INSERT INTO `customer` (`customer_id`, `gender`, `first_name`, `middle_name`, `last_name`, `street`, `house_number`, `house_number_addon`, `zip_code`, `city`, `phone`, `emailadres`, `password`, `newsletter_subscription`, `date_added`) VALUES
(7, 'man', 'Pokkie', 'van', 'pollie', 'Spontaanlaan', 53, '', '7519GS', 'Breda', 685267384, 'ikbencool@cool.com', 'test12345', 1, '2021-04-22 14:21:23'),
(8, 'man', 'Robin', '', 'Hardjowijono', 'Frans Halshage', 19, '', '3438JE', 'Nieuwegein', 641499663, 'testermannetje@tester.com', 'testermannetje9876', 1, '2021-04-22 14:24:54'),
(9, 'man', 'bollie', 'van', 'bolle', 'loempialaan', 69, 'A', '6441OK', 'Utrecht', 657223846, 'bollebollie@bolzak.com', 'RobinDitiseenWW', 0, '2021-04-22 14:31:13'),
(10, 'vrouw', 'gerardiene', '', 'woepoe', 'Dikkejanstraat', 75, '', '4863KU', 'Almere', 681263911, 'coolegozerd@gozerd.com', 'dikkiedikiscool231', 1, '2021-04-22 14:33:52'),
(13, 'man', 'Herrie', 'super', 'Handig', 'herriesstraat', 112, 'D', '5718BC', 'Groningen', 644485192, 'herriehandig@superhandig.com', 'Blablabla123', 0, '2021-04-22 14:45:44');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `product`
--

CREATE TABLE `product` (
  `product_id` int(11) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(400) NOT NULL,
  `category_id` int(11) NOT NULL,
  `price` float NOT NULL,
  `color` varchar(80) NOT NULL,
  `weight` varchar(50) NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `product`
--

INSERT INTO `product` (`product_id`, `name`, `description`, `category_id`, `price`, `color`, `weight`, `active`) VALUES
(1, 'tafellampp', 'Tafellampen zijn binnenlampen voor op tafel.', 1, 41, 'wit', '301', 1),
(2, 'Buitenlamp', 'De lampenkap van textiel geeft een zacht en decoratief licht.\r\n<br><br>\r\nLichtbron wordt apart verkocht. IKEA adviseert de led-lamp E27 globevorm opaalwit.\r\n<br><b>\r\nGebruik een opalen lichtbron als je een gewone lampenkap of lamp hebt en je een gelijkmatig, gespreid licht wilt.\r\n<br><br>\r\nVoorzien van trekschakelaar.\r\n<br><br>\r\nDit product is CE-gecertificeerd.\r\n\r\nGoed te completeren met andere l', 2, 40.5, 'wit', '300', 1),
(3, 'Ganslamp', 'De lampenkap van textiel geeft een zacht en decoratief licht.\r\n<br><br>\r\nLichtbron wordt apart verkocht. IKEA adviseert de led-lamp E27 globevorm opaalwit.\r\n<br><b>\r\nGebruik een opalen lichtbron als je een gewone lampenkap of lamp hebt en je een gelijkmatig, gespreid licht wilt.\r\n<br><br>\r\nVoorzien van trekschakelaar.\r\n<br><br>\r\nDit product is CE-gecertificeerd.\r\n\r\nGoed te completeren met andere l', 3, 60, 'blauw', '420', 1),
(4, 'Giraf-lamp', 'De lampenkap van textiel geeft een zacht en decoratief licht.\r\n<br><br>\r\nLichtbron wordt apart verkocht. IKEA adviseert de led-lamp E27 globevorm opaalwit.\r\n<br><b>\r\nGebruik een opalen lichtbron als je een gewone lampenkap of lamp hebt en je een gelijkmatig, gespreid licht wilt.\r\n<br><br>\r\nVoorzien van trekschakelaar.\r\n<br><br>\r\nDit product is CE-gecertificeerd.\r\n\r\nGoed te completeren met andere l', 3, 70, 'geel', '600', 1),
(5, 'Hektar', 'De lampenkap van textiel geeft een zacht en decoratief licht.\r\n<br><br>\r\nLichtbron wordt apart verkocht. IKEA adviseert de led-lamp E27 globevorm opaalwit.\r\n<br><b>\r\nGebruik een opalen lichtbron als je een gewone lampenkap of lamp hebt en je een gelijkmatig, gespreid licht wilt.\r\n<br><br>\r\nVoorzien van trekschakelaar.\r\n<br><br>\r\nDit product is CE-gecertificeerd.\r\n\r\nGoed te completeren met andere l', 3, 59.95, 'zwart', '433', 1),
(6, 'Jesse', 'De lampenkap van textiel geeft een zacht en decoratief licht.\r\n<br><br>\r\nLichtbron wordt apart verkocht. IKEA adviseert de led-lamp E27 globevorm opaalwit.\r\n<br><b>\r\nGebruik een opalen lichtbron als je een gewone lampenkap of lamp hebt en je een gelijkmatig, gespreid licht wilt.\r\n<br><br>\r\nVoorzien van trekschakelaar.\r\n<br><br>\r\nDit product is CE-gecertificeerd.\r\n\r\nGoed te completeren met andere l', 3, 120, 'grijs', '1076', 1),
(7, 'Lampje', 'De lampenkap van textiel geeft een zacht en decoratief licht.\r\n<br><br>\r\nLichtbron wordt apart verkocht. IKEA adviseert de led-lamp E27 globevorm opaalwit.\r\n<br><b>\r\nGebruik een opalen lichtbron als je een gewone lampenkap of lamp hebt en je een gelijkmatig, gespreid licht wilt.\r\n<br><br>\r\nVoorzien van trekschakelaar.\r\n<br><br>\r\nDit product is CE-gecertificeerd.\r\n\r\nGoed te completeren met andere l', 4, 30, 'donker-grijs', '250', 1),
(8, 'Llahra', 'De lampenkap van textiel geeft een zacht en decoratief licht.\r\n<br><br>\r\nLichtbron wordt apart verkocht. IKEA adviseert de led-lamp E27 globevorm opaalwit.\r\n<br><b>\r\nGebruik een opalen lichtbron als je een gewone lampenkap of lamp hebt en je een gelijkmatig, gespreid licht wilt.\r\n<br><br>\r\nVoorzien van trekschakelaar.\r\n<br><br>\r\nDit product is CE-gecertificeerd.\r\n\r\nGoed te completeren met andere l', 2, 60, 'wit', '711', 1),
(9, 'Struisvogel-lamp', 'De lampenkap van textiel geeft een zacht en decoratief licht.\r\n<br><br>\r\nLichtbron wordt apart verkocht. IKEA adviseert de led-lamp E27 globevorm opaalwit.\r\n<br><b>\r\nGebruik een opalen lichtbron als je een gewone lampenkap of lamp hebt en je een gelijkmatig, gespreid licht wilt.\r\n<br><br>\r\nVoorzien van trekschakelaar.\r\n<br><br>\r\nDit product is CE-gecertificeerd.\r\n\r\nGoed te completeren met andere l', 4, 19.95, 'roze', '223', 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `product_image`
--

CREATE TABLE `product_image` (
  `product_image_id` int(11) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `image` varchar(100) NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `product_image`
--

INSERT INTO `product_image` (`product_image_id`, `product_id`, `image`, `active`) VALUES
(1, 1, 'arstid.jpg', 1),
(2, 2, 'buitenlamp.jpg', 1),
(3, 2, 'buitenlamp2.jpg', 1),
(4, 3, 'gans.jpg', 1),
(5, 4, 'giraf.jpg', 1),
(6, 4, 'giraf2.jpg', 1),
(7, 5, 'hektar.jpg', 1),
(8, 6, 'jesse.png', 1),
(9, 7, 'lampje.jpg', 1),
(10, 8, 'llahra.png', 1),
(11, 9, 'struisvogel.jpg', 1);

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `admin_user`
--
ALTER TABLE `admin_user`
  ADD PRIMARY KEY (`admin_user_id`);

--
-- Indexen voor tabel `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexen voor tabel `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexen voor tabel `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexen voor tabel `product_image`
--
ALTER TABLE `product_image`
  ADD PRIMARY KEY (`product_image_id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `admin_user`
--
ALTER TABLE `admin_user`
  MODIFY `admin_user_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT voor een tabel `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT voor een tabel `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT voor een tabel `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT voor een tabel `product_image`
--
ALTER TABLE `product_image`
  MODIFY `product_image_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
