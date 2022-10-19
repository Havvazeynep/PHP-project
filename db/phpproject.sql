-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 19 Eki 2022, 20:13:52
-- Sunucu sürümü: 10.4.24-MariaDB
-- PHP Sürümü: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `phpproject`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `firstname` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `mesaj` varchar(500) COLLATE utf8_turkish_ci NOT NULL,
  `date_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `contact`
--

INSERT INTO `contact` (`id`, `firstname`, `email`, `mesaj`, `date_time`) VALUES
(1, 'Ahmet', 'ahmet@gmail.com', 'bu deneme mesajıdır', '2022-10-14 21:41:43'),
(2, 'Eda', 'eda@gmail.com', 'bu bir denemedir', '2022-10-19 18:12:28');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(20) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'admin'),
(2, 'employee'),
(3, 'customer');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `teams`
--

CREATE TABLE `teams` (
  `id` int(11) NOT NULL,
  `team_name` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `status` varchar(20) COLLATE utf8_turkish_ci NOT NULL,
  `date_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `teams`
--

INSERT INTO `teams` (`id`, `team_name`, `status`, `date_time`) VALUES
(1, 'team 1', '', '2022-10-15 10:22:17'),
(10, 'takım1', '', '2022-10-18 10:01:55'),
(11, 'team 2', '', '2022-10-18 21:18:58'),
(12, 'team 3', '', '2022-10-18 23:26:50');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `team_messages`
--

CREATE TABLE `team_messages` (
  `id` int(11) NOT NULL,
  `title` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `message` text COLLATE utf8_turkish_ci NOT NULL,
  `team_id` int(11) NOT NULL,
  `status` varchar(20) COLLATE utf8_turkish_ci DEFAULT NULL,
  `date_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `team_messages`
--

INSERT INTO `team_messages` (`id`, `title`, `message`, `team_id`, `status`, `date_time`) VALUES
(1, 'Deneme', 'Bu bir deneme mesajıdır', 1, NULL, '2022-10-19 14:41:59'),
(2, 'Merhaba', 'Bu bir takım mesajıdır', 1, NULL, '2022-10-19 15:00:27');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `team_users`
--

CREATE TABLE `team_users` (
  `team_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `team_users`
--

INSERT INTO `team_users` (`team_id`, `user_id`) VALUES
(10, 1),
(1, 4),
(1, 3),
(10, 2),
(11, 5),
(11, 2),
(11, 3),
(11, 4),
(11, 1),
(10, 3),
(12, 1),
(12, 3),
(12, 5),
(1, 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `lastname` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8_turkish_ci NOT NULL,
  `password` varchar(20) COLLATE utf8_turkish_ci NOT NULL,
  `role_id` int(11) NOT NULL DEFAULT 3,
  `date_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `phone`, `password`, `role_id`, `date_time`) VALUES
(1, 'Havva Zeynep', 'Akdemir', 'havva.zeynep.16@gmail.com', '5079782904', 'ahmet12345', 1, '2022-10-16 18:30:25'),
(2, 'Ahmet', 'Akdemir', 'ahmet@gmail.com', '5555555555', '$2y$12$qZAlIzpEluNuS', 0, '0000-00-00 00:00:00'),
(3, 'mustafa', 'akdemir', 'mustafa@gmail.com', '555555555', 'ahmethamza', 0, '0000-00-00 00:00:00'),
(4, 'Eda', 'Balsak', 'eda@gmail.com', '5555555555', 'ahmethamza', 0, '0000-00-00 00:00:00'),
(5, 'zehra', 'aslan', 'zehra@gmail.com', '5555555555', 'ahmethamza', 3, '2022-10-15 06:40:18');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `team_messages`
--
ALTER TABLE `team_messages`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Tablo için AUTO_INCREMENT değeri `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Tablo için AUTO_INCREMENT değeri `teams`
--
ALTER TABLE `teams`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Tablo için AUTO_INCREMENT değeri `team_messages`
--
ALTER TABLE `team_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Tablo için AUTO_INCREMENT değeri `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
