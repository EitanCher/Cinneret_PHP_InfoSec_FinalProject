-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: ספטמבר 14, 2023 בזמן 11:50 PM
-- גרסת שרת: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `finalproj_summer2023`
--

-- --------------------------------------------------------

--
-- מבנה טבלה עבור טבלה `postboxes`
--

CREATE TABLE `postboxes` (
  `id` int(11) NOT NULL,
  `FirstName` text NOT NULL,
  `LastName` text NOT NULL,
  `BoxNumber` text NOT NULL,
  `Phone` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- הוצאת מידע עבור טבלה `postboxes`
--

INSERT INTO `postboxes` (`id`, `FirstName`, `LastName`, `BoxNumber`, `Phone`) VALUES
(2, 'Karl', 'Marx', '1033', '0544444444'),
(3, 'Jimmy', 'Hendrics', '222', '0544444444'),
(4, 'Albert', 'Einstein', '12345', '0522222222'),
(5, 'Marco', 'Polo', '111', '0544444441'),
(6, 'Yuri', 'Gagarin', '345', '0534562225'),
(7, 'Neil', 'Armstrong', '345', '1234567890'),
(8, 'Christopher', 'Columbus', '111', '2345667777'),
(9, 'Adam', 'Smith', '1033', '0544444444');

--
-- Indexes for dumped tables
--

--
-- אינדקסים לטבלה `postboxes`
--
ALTER TABLE `postboxes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `postboxes`
--
ALTER TABLE `postboxes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
