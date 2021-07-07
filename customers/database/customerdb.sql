-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2021. Júl 07. 17:14
-- Kiszolgáló verziója: 10.4.14-MariaDB
-- PHP verzió: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `customerdb`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `megyek`
--

CREATE TABLE `megyek` (
  `id` int(11) NOT NULL,
  `megyenev` varchar(50) COLLATE utf8_hungarian_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `megyek`
--

INSERT INTO `megyek` (`id`, `megyenev`) VALUES
(1, 'Győr-Moson-Sopron'),
(2, 'Vas'),
(3, 'Zala'),
(4, 'Somogy'),
(5, 'Baranya'),
(6, 'Bács-Kiskun'),
(7, 'Csongrád-Csanád'),
(8, 'Békés'),
(9, 'Hajdú-Bihar'),
(10, 'Szabolcs-Szatmár-Bereg'),
(11, 'Borsod-Abaúj-Zemplén'),
(12, 'Heves'),
(13, 'Nógrád'),
(14, 'Pest'),
(15, 'Budapest'),
(16, 'Komárom-Esztergom'),
(17, 'Veszprém'),
(18, 'Fejér'),
(19, 'Tolna'),
(20, 'Jász-Nagykun-Szolnok');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `vasarlok`
--

CREATE TABLE `vasarlok` (
  `id` int(11) NOT NULL,
  `nev` varchar(100) COLLATE utf8_hungarian_ci NOT NULL,
  `jelszo` varchar(100) COLLATE utf8_hungarian_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_hungarian_ci NOT NULL,
  `lakcim1` varchar(100) COLLATE utf8_hungarian_ci NOT NULL,
  `lakcim2` varchar(100) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `szcim1` varchar(100) COLLATE utf8_hungarian_ci NOT NULL,
  `szcim2` varchar(100) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `adoszam` varchar(13) COLLATE utf8_hungarian_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `vasarlok`
--

INSERT INTO `vasarlok` (`id`, `nev`, `jelszo`, `email`, `lakcim1`, `lakcim2`, `szcim1`, `szcim2`, `adoszam`) VALUES
(11, 'Ronald Kovács', 'b109f3bbbc244eb82441917ed06d618b9008dd09b3befd1b5e07394c706a8bb980b1d7785e5976ec049b46df5f1326af5a2e', 'kovronald@gmail.com', 'Csongrád-Csanád Törökkanizsa utca 71.', '', 'Csongrád-Csanád Törökkanizsa utca 71.', '', '26163190-2-43'),
(13, 'Kovács Hanna', 'bc547750b92797f955b36112cc9bdd5cddf7d0862151d03a167ada8995aa24a9ad24610b36a68bc02da24141ee51670aea13', 'kovhannah@gmail.com', 'Csongrád-Csanád Lehel utca 8.', 'Csongrád-Csanád Törökkanizsa utca 71.', 'Csongrád-Csanád Lehel utca 8.', 'Csongrád-Csanád Törökkanizsa utca 71.', ''),
(14, 'Kovács Leila', '2a64d6563d9729493f91bf5b143365c0a7bec4025e1fb0ae67e307a0c3bed1c28cfb259fc6be768ab0a962b1e2c9527c5f21', 'kovleila@gmail.com', 'Jász-Nagykun-Szolnok Hatvan, tőke utca 8.', '', 'Budapest Budapest, vadító utca 11/a.', '', ''),
(15, 'Aklán Betti', '11961811bd4e11f23648afbd2d5c251d2784827147f1731be010adaf0ab38ae18e5567c6fd1bee50a4cd35fb544b3c594e7d', 'akbetti@gmail.com', 'Csongrád-Csanád Szeged, csorba utca 8.', 'Csongrád-Csanád Szeged, Törökkanizsa utca 71.', 'Budapest Budapest, vadító utca 11/a.', 'Budapest Budapest, petrezselyem utca 24.', '26163190-2-43');

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `megyek`
--
ALTER TABLE `megyek`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `vasarlok`
--
ALTER TABLE `vasarlok`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nev` (`nev`),
  ADD UNIQUE KEY `jelszo` (`jelszo`),
  ADD UNIQUE KEY `email` (`email`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `megyek`
--
ALTER TABLE `megyek`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT a táblához `vasarlok`
--
ALTER TABLE `vasarlok`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
