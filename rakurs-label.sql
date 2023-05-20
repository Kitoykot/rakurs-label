-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 20 2023 г., 06:57
-- Версия сервера: 10.8.4-MariaDB-log
-- Версия PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `rakurs-label`
--

-- --------------------------------------------------------

--
-- Структура таблицы `admins`
--

CREATE TABLE `admins` (
  `id` bigint(24) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `login` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `admins`
--

INSERT INTO `admins` (`id`, `name`, `login`, `password`) VALUES
(1, 'Александра', 'admin_rakurs', '$2y$10$QEYbOj36gwGR0XmVmrdg1eyhx3FboWTefHz9SHj2M3Qm0Onm2g4Bu');

-- --------------------------------------------------------

--
-- Структура таблицы `artists`
--

CREATE TABLE `artists` (
  `id` bigint(24) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `spoti-link` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ym-link` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `am-link` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vk-link` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `public` int(10) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `artists`
--

INSERT INTO `artists` (`id`, `name`, `spoti-link`, `ym-link`, `am-link`, `vk-link`, `image`, `public`) VALUES
(1, 'Гюнтер', 'https://open.spotify.com/artist/42aBYRMBUnwxoridjJSjcF', 'https://music.yandex.ru/artist/10435948', 'https://music.apple.com/us/artist/%D0%B3%D1%8E%D0%BD%D1%82%D0%B5%D1%80/1542665082', 'https://vk.com/gunterprod', '/storage/images/1684402621_gunter.png', 1),
(2, 'Грушевый Сидр', 'https://open.spotify.com/artist/235wLkMnQvHVHS1z0NVKgB', 'https://music.yandex.ru/artist/10947381', 'https://music.apple.com/us/artist/%D0%B3%D1%80%D1%83%D1%88%D0%B5%D0%B2%D1%8B%D0%B9-%D1%81%D0%B8%D0%B4%D1%80/1554238461', 'https://vk.com/cider_the_band', '/storage/images/1684402934_cider.png', 1),
(3, 'Печорин', 'https://open.spotify.com/artist/0dAA4j4QiSfSAvqcMziCCv', 'https://music.yandex.ru/artist/8779799', 'https://music.apple.com/us/artist/%D0%BF%D0%B5%D1%87%D0%BE%D1%80%D0%B8%D0%BD/1498853800', 'https://vk.com/pechorinband', '/storage/images/1684402811_pechorin-band.png', 1),
(4, 'xvostik', 'https://open.spotify.com/artist/1U46cQrCks3w62D6WgocHk', 'https://music.yandex.ru/artist/11215588', 'https://music.apple.com/us/artist/xvostik/1561338030', 'https://vk.com/djxvostik', '/storage/images/1684402725_xvostik-band.png', 1),
(5, 'Продукты', 'https://open.spotify.com/artist/6nxKTC13zE2dDCaroHAmWp', 'https://music.yandex.ru/artist/8501548', 'https://music.apple.com/us/artist/%D0%BF%D1%80%D0%BE%D0%B4%D1%83%D0%BA%D1%82%D1%8B/1491323219', 'https://vk.com/yournewfavoriteband', '/storage/images/1684403010_produkty.png', 1),
(6, 'superkomfort', 'https://open.spotify.com/artist/4BDMkaminPIl2lPHZWOmHg', 'https://music.yandex.ru/artist/8771545', 'https://music.apple.com/us/artist/superkomfort/1536378580', 'https://vk.com/superkomfort', '/storage/images/1684483655_superkomfort.png', 1),
(7, 'Ученик', 'https://open.spotify.com/artist/5oI2pGgvv3UgV1U7cV0SlG', 'https://music.yandex.ru/artist/16714315', 'https://music.apple.com/ru/artist/%D1%83%D1%87%D0%B5%D0%BD%D0%B8%D0%BA/1624669222', 'https://vk.com/uchenick_sound', '/storage/images/1684486728_CYV9D4QniHA.jpg', 1),
(8, 'Стихограмма', 'https://open.spotify.com/artist/7n1gvOGuAG4qzMMEz6XBvT', 'https://music.yandex.ru/artist/10962251', 'https://music.apple.com/ru/artist/%D1%81%D1%82%D0%B8%D1%85%D0%BE%D0%B3%D1%80%D0%B0%D0%BC%D0%BC%D0%B0/1555094705', 'https://vk.com/stihogramma', '/storage/images/1684487474_E8illZvWfQU.jpg', 1),
(9, 'Буква Ф', 'https://open.spotify.com/artist/76QJGMMVTAy04DAG2Cn7Et', 'https://music.yandex.ru/artist/16827423', 'https://music.apple.com/ru/artist/%D0%B1%D1%83%D0%BA%D0%B2%D0%B0-%D1%84/1627933981', 'https://vk.com/bukva_fa', '/storage/images/1684487605_La9sjHTJw5g.jpg', 1),
(10, 'Пока Что Неизвестен', 'https://open.spotify.com/artist/6tplM5zBMGc2hI3mnOiqU7', 'https://music.yandex.ru/artist/9949199', 'https://music.apple.com/ru/artist/%D0%BF%D0%BE%D0%BA%D0%B0-%D1%87%D1%82%D0%BE-%D0%BD%D0%B5%D0%B8%D0%B7%D0%B2%D0%B5%D1%81%D1%82%D0%B5%D0%BD/1512119622', 'https://vk.com/pniiimenyaaa', '/storage/images/1684487774_DUsefguaXS4.jpg', 1),
(11, 'Хорошее отношение', 'https://open.spotify.com/artist/2pmxf2tPmWbdadUTxL8ppu', 'https://music.yandex.ru/artist/17124864', 'https://music.apple.com/ru/artist/%D1%85%D0%BE%D1%80%D0%BE%D1%88%D0%B5%D0%B5-%D0%BE%D1%82%D0%BD%D0%BE%D1%88%D0%B5%D0%BD%D0%B8%D0%B5/1633907920', 'https://vk.com/goodrelationships', '/storage/images/1684488117_E4N1TpsDr-k.jpg', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `general`
--

CREATE TABLE `general` (
  `id` bigint(24) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vk-link` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tg-link` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tap-link` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `general`
--

INSERT INTO `general` (`id`, `title`, `description`, `vk-link`, `tg-link`, `tap-link`) VALUES
(1, '/ракурс/', 'помогаем музыкантам, которые делают хорошую музыку \r\n\r\nдистрибьюция, менеджмент, концерты, промо-поддержка, мерч и прочее ', 'https://vk.com/rakurslabel', 'https://t.me/rakurslabel', 'https://taplink.cc/rakurslabel');

-- --------------------------------------------------------

--
-- Структура таблицы `releases`
--

CREATE TABLE `releases` (
  `id` bigint(24) NOT NULL,
  `artist_id` bigint(24) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `multi-link` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cover` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `public` int(10) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `releases`
--

INSERT INTO `releases` (`id`, `artist_id`, `title`, `multi-link`, `cover`, `public`) VALUES
(1, 9, 'Океаны', 'https://zvonko.link/bukvafokeany', '/storage/covers/1684487672_nZ1uMKQRjmI.jpg', 1),
(2, 8, 'Saudade', 'https://zvonko.link/saudade', '/storage/covers/1684487515_ckrOY0f0BMU.jpg', 1),
(3, 7, 'Заря', 'https://zvonko.link/uchenikzarya', '/storage/covers/1684486765_xOdtC0aCiNI.jpg', 1),
(4, 10, 'Временные трудности', 'https://zvonko.link/vremennietrudnosty', '/storage/covers/1684487805_8AB9oJPJ1_4.jpg', 1),
(5, 11, 'В темноте', 'https://zvonko.link/vtemnoteHO', '/storage/covers/1684488152_BkYn9ah678I.jpg', 1),
(6, 6, 'Сложно, когда всё горит', 'https://zvonko.link/vsegorit', '/storage/covers/1684488243_4cBzHP9rKps.jpg', 1);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `artists`
--
ALTER TABLE `artists`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `general`
--
ALTER TABLE `general`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `releases`
--
ALTER TABLE `releases`
  ADD PRIMARY KEY (`id`),
  ADD KEY `artist_id` (`artist_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(24) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `artists`
--
ALTER TABLE `artists`
  MODIFY `id` bigint(24) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT для таблицы `general`
--
ALTER TABLE `general`
  MODIFY `id` bigint(24) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `releases`
--
ALTER TABLE `releases`
  MODIFY `id` bigint(24) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `releases`
--
ALTER TABLE `releases`
  ADD CONSTRAINT `releases_ibfk_1` FOREIGN KEY (`artist_id`) REFERENCES `artists` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
