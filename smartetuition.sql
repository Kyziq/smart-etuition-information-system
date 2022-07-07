-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 07, 2022 at 08:47 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `smartetuition`
--

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `classID` int(4) NOT NULL,
  `classSubject` varchar(50) DEFAULT NULL,
  `classLink` varchar(100) DEFAULT NULL,
  `classDay` varchar(50) DEFAULT NULL,
  `classTime` time DEFAULT NULL,
  `classFee` int(3) NOT NULL DEFAULT 50,
  `totalStudent` int(10) NOT NULL DEFAULT 0,
  `adminID` int(4) NOT NULL,
  `tutorID` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`classID`, `classSubject`, `classLink`, `classDay`, `classTime`, `classFee`, `totalStudent`, `adminID`, `tutorID`) VALUES
(1, 'Mathematics', 'https://meet.google.com/jbk-bjtn-idt', 'Saturday', '08:00:00', 50, 0, 1, 7),
(2, 'Mathematics', 'https://meet.google.com/joa-wioj-xow', 'Sunday', '08:00:00', 50, 0, 1, 7),
(3, 'Additional Mathematics', 'https://meet.google.com/aoz-soak-hoa', 'Saturday', '09:00:00', 50, 0, 1, 9),
(4, 'Additional Mathematics', 'https://meet.google.com/fiw-opao-zxs', 'Sunday', '09:00:00', 50, 0, 1, 9),
(5, 'Physics', 'https://meet.google.com/lqp-aowf-xzb', 'Saturday', '13:00:00', 50, 0, 1, 8),
(6, 'Physics', 'https://meet.google.com/sap-wapq-zmx', 'Sunday', '13:00:00', 50, 0, 1, 8),
(7, 'Chemistry', 'https://meet.google.com/lzm-paqz-mxs', 'Saturday', '14:00:00', 50, 0, 1, 5),
(8, 'Chemistry', 'https://meet.google.com/maq-dfga-qza', 'Sunday', '14:00:00', 50, 0, 1, 5),
(9, 'Biology', 'https://meet.google.com/plm-vxmc-aqp', 'Saturday', '15:00:00', 50, 0, 1, 6),
(10, 'Biology', 'https://meet.google.com/apz-knzo-plw', 'Sunday', '15:00:00', 50, 0, 1, 6);

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `fbID` int(4) NOT NULL,
  `fbTitle` varchar(200) DEFAULT NULL,
  `fbComment` varchar(2000) DEFAULT NULL,
  `fbDate` timestamp NULL DEFAULT current_timestamp(),
  `adminID` int(11) DEFAULT NULL,
  `stuID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

CREATE TABLE `register` (
  `classID` int(4) NOT NULL,
  `stuID` int(4) NOT NULL,
  `adminID` int(4) NOT NULL,
  `registerDate` timestamp NULL DEFAULT current_timestamp(),
  `proofPayment` varchar(200) DEFAULT NULL,
  `registerApproval` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userID` int(4) NOT NULL,
  `userLevel` int(1) NOT NULL DEFAULT 3,
  `userUname` varchar(100) DEFAULT NULL,
  `userPassw` varchar(100) DEFAULT NULL,
  `userName` varchar(100) DEFAULT NULL,
  `userPhone` varchar(11) DEFAULT NULL,
  `userEmail` varchar(100) DEFAULT NULL,
  `userGender` int(2) DEFAULT NULL,
  `userBirthdate` date DEFAULT NULL,
  `userAddress` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userID`, `userLevel`, `userUname`, `userPassw`, `userName`, `userPhone`, `userEmail`, `userGender`, `userBirthdate`, `userAddress`) VALUES
(1, 1, 'kyziq', 'qazwsx123', 'Khairul Haziq bin Khairi', '0164005754', 'ihaziqkhairi@gmail.com', 1, '2002-04-13', 'No. 14, Lorong Hang Tuah 7, Apartment Utama, 31490 Chenderiang, Perak'),
(2, 3, 'student', 'student', 'Mohamad Zikri bin Aysar', '0169328415', 'zikriaysar@gmail.com', 1, '2004-04-27', 'No. 4, Jln 6/9E, Kondominium Angkasa, 62573 Precinct 4, Putrajaya'),
(3, 3, 'salim', 'salim', 'Muhammad Salim bin Rusman', '0154673944', 'salimirusman@hotmail.com', 1, '2004-12-05', 'No. 34, Jalan Anson 7/55, PJU73, 62393 Precinct 8, Putrajaya'),
(4, 1, 'admin', 'admin', 'Harith Adib bin Mikail', '0142539621', 'rithdib@gmail.com', 1, '1996-11-08', '52, Jalan Petaling, Bandar Flora, 01524 Simpang Empat, Perlis Indera Kayangan'),
(5, 2, 'shazwan321', 'shazwan321', 'Shazwan bin Faizal', '0193024233', 'shazwan@yahoo.com', 1, '1988-12-05', '869, Lorong Yap Ah Shak, USJ 39M, 30005 Sitiawan, Perak Darul Ridzuan'),
(6, 2, 'afiffudin', 'pudin123', 'Afiffuddin Anas bin Kilau', '0199874040', 'fudin12@yahoo.com', 1, '1992-07-02', '1, Lorong 4/8E, Lembah Sungai Long, 47669 Klang, Selangor Darul Ehsan'),
(7, 2, 'siti', 'siti', 'Siti Bayani binti Amzar', '0179611826', 'sitibayani93@yahoo.com', 2, '1993-03-17', 'No. 40, Jln 9/9Z, PJU44, 05120 Merbok, Kedah Darul Aman'),
(8, 2, 'jasmin', 'jasmin', 'Jasmin Ilyas binti Haziq', '0143538115', 'jasmin_96@hotmail.com', 2, '1996-12-16', 'No. 69, Jalan Sempadan 9/4N, Taman Rahman, 15646 Gua Musang, Kelantan'),
(9, 2, 'taniza94', 'taniza94', 'Nur Taniza binti Suhardy', '0194234854', 'taniza94@gmail.com', 2, '1994-06-17', '3, Jalan 15U, Desa Petaling, 62898 Precinct 5, Putrajaya'),
(10, 3, 'kamarulrafiq', 'kamarulrafiq', 'Kamarul Rafiq bin Shapiein', '01111378541', 'kamarulraf_2004@gmail.com', 1, '2004-06-07', 'No. 6, Lorong 3/4, Damansara Melawati, 16449 Tok Bali, Kelantan Darul Naim'),
(11, 3, 'nuraleya', 'nuraleya', 'Nur Aleya binti Dazila', '0198677267', 'aleya72@gmail.com', 2, '2004-02-27', '53, Lorong 2D, Bukit Pahlawan, 30004 Behrang, Perak Darul Ridzuan'),
(12, 3, 'imrantaufek', 'imrantaufek', 'Imran Taufek bin Syed Dini', '0102355769', 'imrantaufek@gmail.com', 1, '2004-08-16', 'No. F-57-54, Jln 4/1, Taman Desa Delima, 72824 Tiroi, Negeri Sembilan'),
(13, 3, 'dianazikri', 'dianazikri', 'Nur Diana binti Zikri', '01115633790', 'dianazikri@yahoo.com', 2, '2004-12-13', 'Lot S-88-34, Jalan 4/28U, Bandar Tengah, 02186 Simpang Empat, Perlis'),
(14, 3, 'nurafifah', 'nurafifah', 'Nurafifah binti Hazzam', '0195827301', 'nurafifahhazzam@gmail.com', 2, '2004-03-24', 'No. 447, Lorong 3/7, Pandan Meru, 23750 Rantau Abang, Terengganu Darul Iman'),
(15, 3, 'ainamni', 'ainamni', 'Ain Amni binti Wahab', '0129518232', 'ainamni@yahoo.com', 2, '2004-06-01', '312, Lorong 2Y, Bandar Utara, 27454 Karak, Pahang Darul Makmur'),
(16, 3, 'chaikeyteh', 'chaikeyteh', 'Chai Key Teh', '0176932012', 'chaikeyteh@yahoo.com', 1, '2004-12-23', '987, Jalan 9, SS87, 47143 Subang Jaya, Selangor'),
(17, 3, 'gopinathan', 'gopinathan', 'Gopinathan a/l Pragash', '0179620124', 'gopinathan@yahoo.com', 1, '2004-03-21', 'No. 1, Jalan Ampang 8/4, SS64O, 62040 Precinct 5, Putrajaya'),
(18, 3, 'rafizal', 'rafizal', 'Rafizal bin Che Rusli Hamid', '0124860291', 'rafizal@gmail.com', 1, '2004-06-16', 'Lot 51, Jalan 8/17J, PJU62, 12225 Nibong Tebal, Pulau Pinang'),
(19, 3, 'nursofiya', 'nursofiya', 'Nur Sofiya binti Izam', '0169182845', 'nursofiya@gmail.com', 2, '2004-04-15', '1, Jalan 8/85X, Taman Mahkota, 39189 Chendor, Pahang'),
(20, 3, 'nurhafieza', 'nurhafieza', 'Nur Hafieza binti Shameer', '0192528692', 'nurhafieza@gmail.com', 2, '2004-09-20', '93, Jln 6/9C, Batu Pertama, 62640 Precinct 4, Putrajaya'),
(21, 3, 'yapmunkhee', 'yapmunkhee', 'Yap Mun Khee', '0125859123', 'yapmunkhee@gmail.com', 2, '2004-12-16', '3, Jalan Genting Klang 2/96Z, Alam Sungai Besi, 80459 Skudai, Johor'),
(22, 3, 'raihanazlan', 'raihanazlan', 'Muhammad Raihan bin Azlan', '0196862931', 'raihanazlan@gmail.com', 1, '2004-06-11', 'No. 50, Jalan 2/5, Taman Anggerik, 12159 George Town, Penang'),
(23, 3, 'nursufiya', 'nursufiya', 'Nur Sufiya binti Abu Bakar', '0196251237', 'nursufiya@gmail.com', 2, '2004-05-10', '71, Jalan Pudu 20Q, SS8, 59352 Taman Desa, WP Kuala Lumpur'),
(24, 3, 'danishirfan', 'danishirfan', 'Danish Irfan bin Shahrul', '0129862359', 'danishirfan@gmail.com', 1, '2004-02-06', 'Lot 6-1, Jalan Perdana 4, PJU79, 79829 Gemas Baharu, Johor Darul Ta\'zim'),
(25, 3, 'hakimidaniel', 'hakimidaniel', 'Hakimi Daniel bin Haque', '0179621268', 'hakimidaniel@gmail.com', 1, '2004-03-23', '46, Lorong Conlay 7/8F, Bandar Sri Permai, 23236 Kuala Berang, Terengganu Darul Iman');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`classID`),
  ADD KEY `admin` (`adminID`),
  ADD KEY `tutor` (`tutorID`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`fbID`),
  ADD KEY `adminFb` (`adminID`),
  ADD KEY `stuFb` (`stuID`);

--
-- Indexes for table `register`
--
ALTER TABLE `register`
  ADD PRIMARY KEY (`classID`,`stuID`,`adminID`),
  ADD KEY `stuR` (`stuID`),
  ADD KEY `adminID.reg` (`adminID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
  MODIFY `classID` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `fbID` int(4) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userID` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `class`
--
ALTER TABLE `class`
  ADD CONSTRAINT `admin` FOREIGN KEY (`adminID`) REFERENCES `user` (`userID`),
  ADD CONSTRAINT `tutor` FOREIGN KEY (`tutorID`) REFERENCES `user` (`userID`);

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `adminFb` FOREIGN KEY (`adminID`) REFERENCES `user` (`userID`),
  ADD CONSTRAINT `stuFb` FOREIGN KEY (`stuID`) REFERENCES `user` (`userID`);

--
-- Constraints for table `register`
--
ALTER TABLE `register`
  ADD CONSTRAINT `adminID.reg` FOREIGN KEY (`adminID`) REFERENCES `user` (`userID`),
  ADD CONSTRAINT `classID.reg` FOREIGN KEY (`classID`) REFERENCES `class` (`classID`),
  ADD CONSTRAINT `stuID.reg` FOREIGN KEY (`stuID`) REFERENCES `user` (`userID`);
COMMIT;
