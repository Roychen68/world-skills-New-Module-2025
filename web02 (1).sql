-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2025-11-21 01:34:58
-- 伺服器版本： 10.4.32-MariaDB
-- PHP 版本： 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `web02`
--

-- --------------------------------------------------------

--
-- 資料表結構 `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- 傾印資料表的資料 `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', '1234');

-- --------------------------------------------------------

--
-- 資料表結構 `basic`
--

CREATE TABLE `basic` (
  `id` int(11) NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL,
  `form` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- 傾印資料表的資料 `basic`
--

INSERT INTO `basic` (`id`, `start`, `end`, `form`) VALUES
(1, '2025-10-07 02:36:31', '2025-12-30 02:36:31', 1);

-- --------------------------------------------------------

--
-- 資料表結構 `bus`
--

CREATE TABLE `bus` (
  `id` int(11) NOT NULL,
  `plate` text NOT NULL,
  `time` int(11) NOT NULL,
  `route` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- 傾印資料表的資料 `bus`
--

INSERT INTO `bus` (`id`, `plate`, `time`, `route`) VALUES
(4, 'A1234', 10, 3),
(5, 'A12345', 5, 3),
(7, 'asdf', 5, 1);

-- --------------------------------------------------------

--
-- 資料表結構 `response`
--

CREATE TABLE `response` (
  `id` int(11) NOT NULL,
  `route` text NOT NULL,
  `name` text NOT NULL,
  `mail` text NOT NULL,
  `rate` text NOT NULL,
  `feedback` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- 傾印資料表的資料 `response`
--

INSERT INTO `response` (`id`, `route`, `name`, `mail`, `rate`, `feedback`) VALUES
(16, 'test', 'ddd', '234@gmail.com', 'Neutral', 'test'),
(17, 'aaa', 'ddd', '234@gmail.com', 'Neutral', 'test'),
(18, 'test', 'test', 'test@test.com', 'Neutral', 'a');

-- --------------------------------------------------------

--
-- 資料表結構 `route`
--

CREATE TABLE `route` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `row` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- 傾印資料表的資料 `route`
--

INSERT INTO `route` (`id`, `name`, `row`) VALUES
(3, 'aaa', 2),
(4, 'test-1', 2),
(7, 'test', 3);

-- --------------------------------------------------------

--
-- 資料表結構 `route-station`
--

CREATE TABLE `route-station` (
  `id` int(11) NOT NULL,
  `station` int(11) NOT NULL,
  `need` int(11) NOT NULL,
  `stop` int(11) NOT NULL,
  `route` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- 傾印資料表的資料 `route-station`
--

INSERT INTO `route-station` (`id`, `station`, `need`, `stop`, `route`) VALUES
(4, 0, 3, 2, 2),
(5, 0, 2, 3, 2),
(6, 4, 3, 2, 3),
(7, 1, 3, 2, 3),
(8, 5, 2, 3, 3),
(9, 4, 1, 1, 4),
(10, 5, 1, 1, 4),
(11, 1, 1, 1, 5),
(12, 4, 2, 2, 5),
(13, 5, 1, 1, 5),
(18, 1, 2, 3, 7),
(19, 4, 2, 3, 7),
(20, 5, 3, 2, 7);

-- --------------------------------------------------------

--
-- 資料表結構 `station`
--

CREATE TABLE `station` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- 傾印資料表的資料 `station`
--

INSERT INTO `station` (`id`, `name`) VALUES
(1, 'ff'),
(4, '1234'),
(5, 'ggg'),
(6, 'test');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `basic`
--
ALTER TABLE `basic`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `bus`
--
ALTER TABLE `bus`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `response`
--
ALTER TABLE `response`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `route`
--
ALTER TABLE `route`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `route-station`
--
ALTER TABLE `route-station`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `station`
--
ALTER TABLE `station`
  ADD PRIMARY KEY (`id`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `basic`
--
ALTER TABLE `basic`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `bus`
--
ALTER TABLE `bus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `response`
--
ALTER TABLE `response`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `route`
--
ALTER TABLE `route`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `route-station`
--
ALTER TABLE `route-station`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `station`
--
ALTER TABLE `station`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
