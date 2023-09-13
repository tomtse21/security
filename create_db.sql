-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- 主機： localhost
-- 產生時間： 2023 年 09 月 13 日 19:14
-- 伺服器版本： 10.4.28-MariaDB
-- PHP 版本： 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `covid19_db`
--

-- --------------------------------------------------------

--
-- 資料表結構 `covid19_table`
--

CREATE TABLE `covid19_table` (
  `id` int(11) NOT NULL,
  `enName` varchar(50) NOT NULL,
  `cnName` varchar(50) NOT NULL,
  `hkId` text NOT NULL,
  `email` varchar(30) NOT NULL,
  `phoneNo` int(8) NOT NULL,
  `gender` varchar(5) NOT NULL,
  `dob` text NOT NULL,
  `vaccinationDate` text NOT NULL,
  `boc` varchar(20) NOT NULL,
  `location` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `covid19_table`
--

INSERT INTO `covid19_table` (`id`, `enName`, `cnName`, `hkId`, `email`, `phoneNo`, `gender`, `dob`, `vaccinationDate`, `boc`, `location`) VALUES
(103, 'John Doe', '謝好', 'YlhtWXowZUVPZkNncjBkS3ZDTFBXQT09', '123@gmail.com', 12345678, 'men', '09/08/2001', '09/08/2001', 'bioNTech', 'addr1'),
(104, 'John Doe', '謝好', 'VjVwVzFscjlZTE96WkcvNlltTWlvdz09', '123@gmail.com', 12345678, 'men', '09/08/2001', '09/08/2001', 'bioNTech', 'addr1');

-- --------------------------------------------------------

--
-- 資料表結構 `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','member') NOT NULL DEFAULT 'member'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
(1, '123', '123', 'member'),
(2, '12', '22', 'member'),
(3, '12311', '1111', 'member');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `covid19_table`
--
ALTER TABLE `covid19_table`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `covid19_table`
--
ALTER TABLE `covid19_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
