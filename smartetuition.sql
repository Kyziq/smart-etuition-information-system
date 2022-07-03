-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 03, 2022 at 06:30 AM
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
(1, 'Mathematics', 'https://meet.google.com/xxx-xxxx-xxx', 'Saturday', '08:00:00', 50, 0, 1, 7),
(2, 'Mathematics', 'https://meet.google.com/xxx-xxxx-xxx', 'Sunday', '08:00:00', 50, 0, 1, 7),
(3, 'Additional Mathematics', 'https://meet.google.com/xxx-xxxx-xxx', 'Saturday', '09:00:00', 50, 0, 1, 9),
(4, 'Additional Mathematics', 'https://meet.google.com/xxx-xxxx-xxx', 'Sunday', '09:00:00', 50, 0, 1, 9),
(5, 'Physics', 'https://meet.google.com/xxx-xxxx-xxx', 'Saturday', '13:00:00', 50, 0, 1, 8),
(6, 'Physics', 'https://meet.google.com/xxx-xxxx-xxx', 'Sunday', '13:00:00', 50, 0, 1, 8),
(7, 'Chemistry', 'https://meet.google.com/xxx-xxxx-xxx', 'Saturday', '14:00:00', 50, 0, 1, 10),
(8, 'Chemistry', 'https://meet.google.com/xxx-xxxx-xxx', 'Sunday', '14:00:00', 50, 0, 1, 10),
(9, 'Biology', 'https://meet.google.com/xxx-xxxx-xxx', 'Saturday', '15:00:00', 50, 0, 1, 6),
(10, 'Biology', 'https://meet.google.com/xxx-xxxx-xxx', 'Sunday', '15:00:00', 50, 0, 1, 6);

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `fbID` int(4) NOT NULL,
  `fbTitle` varchar(100) DEFAULT NULL,
  `fbComment` varchar(500) DEFAULT NULL,
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
(2, 3, 'student', 'student', 'Mohamad Zikri bin Aysar', '0162969826', 'zikriaysar@gmail.com', 1, '2002-04-30', 'No. 4, Jln 6/9E, Kondominium Angkasa, 62573 Precinct 4, Putrajaya'),
(3, 2, 'tutor', 'tutor', 'Tutor Name', '0135216387', 'tutor@gmail.com', 1, '1986-05-29', '48, Jln Tan Cheng Lock 4/52, Ara Bintang, 13635 Kepala Batas, Penang'),
(4, 1, 'admin', 'admin', 'Admin name', '0142539621', 'admin@gmail.com', 1, '1996-11-08', '52, Jalan Petaling, Bandar Flora, 01524 Simpang Empat, Perlis Indera Kayangan'),
(5, 3, 'newstu', 'student', 'newstu', '0123456789', 'newstu@gmail.com', 2, '2001-12-05', '84, Lorong Vivekananda, USJ 2, 62575 Precinct 11, Putrajaya'),
(6, 2, 'afiffudin', 'pudin123', 'Afiffuddin Anas bin Kilau', '0199874040', 'fudin12@yahoo.com', 1, '1997-07-02', '1, Lorong 4/8E, Lembah Sungai Long, 47669 Klang, Selangor Darul Ehsan'),
(7, 2, 'afida', 'afida', 'Afida binti Ahmad', '0179611822', 'afida87@uitm.edu.my', 2, '1987-05-17', 'No. 40, Jln 9/9Z, PJU44, 05120 Merbok, Kedah Darul Aman'),
(8, 2, 'jasminy', 'jasminy123', 'Jasmin Ilyas binti Haziq', '0143538115', 'jasmin_79@hotmail.com', 2, '1979-12-16', 'No. 69, Jalan Sempadan 9/4N, Taman Rahman, 15646 Gua Musang, Kelantan'),
(9, 2, 'taniza94', 'taniza94', 'Nur Taniza binti Suhardy', '0194234852', 'taniza94@gmail.com', 2, '1994-06-17', '3, Jalan 15U, Desa Petaling, 62898 Precinct 5, Putrajaya'),
(10, 2, 'shazwan321', 'shazwan321', 'Shazwan bin Faizal', '0124952865', 'shazwan@yahoo.com', 1, '1991-12-05', '869, Lorong Yap Ah Shak, USJ 39M, 30005 Sitiawan, Perak Darul Ridzuan');

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
  MODIFY `userID` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
