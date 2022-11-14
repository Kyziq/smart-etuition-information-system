-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 14, 2022 at 05:15 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

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
(1, 'Mathematics', 'https://meet.google.com/ian-sozw-waa', 'Saturday', '08:00:00', 50, 4, 4, 7),
(2, 'Mathematics', 'https://meet.google.com/joa-wioj-xow', 'Sunday', '08:00:00', 50, 3, 1, 7),
(3, 'Additional Mathematics', 'https://meet.google.com/aoz-soak-hoa', 'Saturday', '09:00:00', 50, 10, 1, 9),
(4, 'Additional Mathematics', 'https://meet.google.com/fiw-opao-zxs', 'Sunday', '09:00:00', 50, 3, 1, 9),
(5, 'Physics', 'https://meet.google.com/lqp-aowf-xzb', 'Saturday', '13:00:00', 50, 3, 1, 8),
(6, 'Physics', 'https://meet.google.com/sap-wapq-zmx', 'Sunday', '13:00:00', 50, 5, 1, 8),
(7, 'Chemistry', 'https://meet.google.com/lzm-paqz-mxs', 'Saturday', '14:00:00', 50, 3, 1, 5),
(8, 'Chemistry', 'https://meet.google.com/maq-dfga-qza', 'Sunday', '14:00:00', 50, 10, 1, 5),
(9, 'Biology', 'https://meet.google.com/plm-vxmc-aqp', 'Saturday', '15:00:00', 50, 0, 1, 6),
(10, 'Biology', 'https://meet.google.com/apz-knzo-plw', 'Sunday', '15:00:00', 50, 4, 1, 6);

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

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`fbID`, `fbTitle`, `fbComment`, `fbDate`, `adminID`, `stuID`) VALUES
(1, 'Great website!', 'I\'m amazed that this is free, the tutor teaches Math really well, you can even use it to grasp the basics of your upcoming grade. For example if you are in form 4 you can go do some prep for form 5 so when you actually do form 5 it\'ll probably be a lot easier for you haha. This app also teaches other kinds of topics like prep for several exams, prep for college, history, I think a little bit about socialise too? There wasn\'t ads too O.O overall, pretty good system', '2022-07-12 18:31:51', NULL, 15),
(3, 'sometimes crash', 'There\'s no doubt this app is the best. I love all the content I can learn for free. The only thing for which I am holding out  is because this app crashes on my Android 12 phone. It\'s basically unusable. I\'ve tried all troubleshooting methods but couldn\'t get it to work. The content is 100% amazing. The system is cool, with just finishing touches missing.', '2022-07-12 18:35:00', NULL, 10),
(4, 'Learning Tools', 'One of the best learning tool for any students out there,Its super effective but of course it isn\'t perfect,There is a bug where some sentences in the Hint button or on the multiple choices doesn\'t appear at all,Some of the page will just go blank with no reason, It can be fixed by reloading the app but the progress will be removed leaving me frustrated. Need to be fixed but good app overall', '2022-07-12 18:36:35', NULL, 11),
(5, 'awesome!!', 'Best online learning platform which is completely free and has a great quality resources. The visuals and the diagrams are so good that it makes the topic crystal clear in one go. Really satisfied with the content in the app. I appreciate the efforts put in by all the faculties and the background team. Thank you very much for creating this fantabulous app.', '2022-07-12 18:37:19', NULL, 13),
(6, 'clean app', 'It is a nice and clean app for learning. I can watch videos or download and watch them later. There are courses on different interests. I can add courses of my interest to my library and organize them. Everything is free, there are no Ads, app interface is so smooth.', '2022-07-12 18:37:36', NULL, 13),
(7, 'Bad quiz!!', 'The quizzes are horrendously done. They will mark a correct answer as wrong. My answer is checked via an online graphing calculator, calculus equations solvers, and/or other such computer programs. These agree with and confirm my answer, yet somehow Kahns answer is completely different. Further, there is no way to report an error in a question/solution/video. Not to mention the frustration of the way the unit tests and quizzes work, which other reviews have covered.', '2022-07-12 18:38:20', NULL, 18),
(8, 'i need the points!', 'The system is horrendous. After you\'ve reached \'proficient\' on all topics you have to take the unit test to level up. But the unit test is usually 20 questions long and if you\'re not doing well in one topic and you keep missing 1 question you have to take the 40 minute test all over again. Also, if you get one wrong towards the beginning there is not option to restart, you just have to do the whole thing knowing there is no point. (Also i am required to get all the mastery points for school)', '2022-07-12 18:39:18', NULL, 19),
(9, 'unique', 'The least I can say that this app is unique and fascinating. They ask unique questions which are not just from any other book or commonly used reference books. Concepts are strengthened. There are many courses we can choose from. Definitely one of the best. Keep it up!👍👍', '2022-07-12 18:41:44', NULL, 28),
(10, 'afasfsadfasdf', 'asdfasdfdf', '2022-07-13 06:18:51', NULL, 1),
(11, 'title', 'test', '2022-07-13 06:54:08', NULL, 1);

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

--
-- Dumping data for table `register`
--

INSERT INTO `register` (`classID`, `stuID`, `adminID`, `registerDate`, `proofPayment`, `registerApproval`) VALUES
(1, 2, 4, '2022-07-12 11:06:04', '../user/paymentProof/zikriaysar-12-07-22.jpg', 1),
(1, 10, 4, '2022-07-12 11:08:18', '../user/paymentProof/kamarulrafiq-12-07-22.jpeg', 1),
(1, 17, 4, '2022-07-12 11:12:11', '../user/paymentProof/gopinathan-12-07-22.jpeg', 1),
(1, 19, 4, '2022-07-12 11:15:20', '../user/paymentProof/nursofiya-12-07-22.jpeg', 1),
(1, 28, 1, '2022-07-12 18:41:30', '../user/paymentProof/bansiawxi-13-07-22.jpg', 3),
(2, 11, 4, '2022-07-12 11:08:44', '../user/paymentProof/nuraleya-12-07-22.jpg', 1),
(2, 12, 4, '2022-07-12 11:09:33', '../user/paymentProof/imrantaufek-12-07-22.png', 1),
(2, 13, 4, '2022-07-12 11:10:03', '../user/paymentProof/dianazikri-12-07-22.jpeg', 1),
(2, 15, 4, '2022-07-12 11:11:37', '../user/paymentProof/ainamni-12-07-22.jpeg', 1),
(2, 23, 4, '2022-07-12 11:27:17', '../user/paymentProof/nursufiya-12-07-22.jpeg', 1),
(2, 27, 4, '2022-07-12 11:34:14', '../user/paymentProof/norerina-12-07-22.jpg', 2),
(2, 30, 4, '2022-07-12 11:36:03', '../user/paymentProof/nikafiq-12-07-22.jpg', 2),
(3, 2, 4, '2022-07-12 11:06:04', '../user/paymentProof/zikriaysar-12-07-22.jpg', 1),
(3, 3, 4, '2022-07-12 11:19:00', '../user/paymentProof/salim-12-07-22.jpg', 1),
(3, 12, 4, '2022-07-12 11:09:33', '../user/paymentProof/imrantaufek-12-07-22.png', 1),
(3, 13, 4, '2022-07-12 11:10:03', '../user/paymentProof/dianazikri-12-07-22.jpeg', 1),
(3, 14, 4, '2022-07-12 11:22:43', '../user/paymentProof/nurafifah-12-07-22.jpg', 1),
(3, 15, 4, '2022-07-12 11:11:37', '../user/paymentProof/ainamni-12-07-22.jpeg', 1),
(3, 18, 4, '2022-07-12 11:20:30', '../user/paymentProof/rafizal-12-07-22.jpeg', 1),
(3, 19, 4, '2022-07-12 11:15:20', '../user/paymentProof/nursofiya-12-07-22.jpeg', 1),
(3, 20, 4, '2022-07-12 11:17:46', '../user/paymentProof/nurhafieza-12-07-22.jpg', 1),
(3, 25, 4, '2022-07-13 04:20:23', '../user/paymentProof/hakimidaniel-13-07-22.jpeg', 1),
(4, 10, 4, '2022-07-12 11:08:18', '../user/paymentProof/kamarulrafiq-12-07-22.jpeg', 1),
(4, 11, 4, '2022-07-12 11:08:44', '../user/paymentProof/nuraleya-12-07-22.jpg', 1),
(4, 17, 4, '2022-07-12 11:12:11', '../user/paymentProof/gopinathan-12-07-22.jpeg', 1),
(4, 21, 4, '2022-07-12 11:24:24', '../user/paymentProof/yapmunkhee-12-07-22.png', 1),
(4, 22, 4, '2022-07-12 11:25:03', '../user/paymentProof/raihanazlan-12-07-22.jpg', 1),
(4, 23, 4, '2022-07-12 11:27:17', '../user/paymentProof/nursufiya-12-07-22.jpeg', 1),
(4, 27, 4, '2022-07-12 11:34:14', '../user/paymentProof/norerina-12-07-22.jpg', 2),
(4, 30, 4, '2022-07-12 11:36:03', '../user/paymentProof/nikafiq-12-07-22.jpg', 2),
(4, 36, 4, '2022-07-13 02:49:13', '../user/paymentProof/natashaaliah-13-07-22.jpg', 2),
(5, 3, 4, '2022-07-12 11:19:00', '../user/paymentProof/salim-12-07-22.jpg', 1),
(5, 10, 4, '2022-07-12 11:08:18', '../user/paymentProof/kamarulrafiq-12-07-22.jpeg', 1),
(5, 12, 4, '2022-07-12 11:09:33', '../user/paymentProof/imrantaufek-12-07-22.png', 1),
(5, 16, 1, '2022-07-12 11:11:55', '../user/paymentProof/chaikeyteh-12-07-22.jpg', 3),
(6, 11, 4, '2022-07-12 11:08:44', '../user/paymentProof/nuraleya-12-07-22.jpg', 1),
(6, 14, 4, '2022-07-12 11:22:43', '../user/paymentProof/nurafifah-12-07-22.jpg', 1),
(6, 18, 4, '2022-07-12 11:20:30', '../user/paymentProof/rafizal-12-07-22.jpeg', 1),
(6, 19, 4, '2022-07-12 11:15:20', '../user/paymentProof/nursofiya-12-07-22.jpeg', 1),
(6, 25, 4, '2022-07-13 04:20:23', '../user/paymentProof/hakimidaniel-13-07-22.jpeg', 1),
(6, 28, 1, '2022-07-12 18:41:30', '../user/paymentProof/bansiawxi-13-07-22.jpg', 3),
(7, 12, 4, '2022-07-12 11:09:33', '../user/paymentProof/imrantaufek-12-07-22.png', 1),
(7, 13, 4, '2022-07-12 11:10:03', '../user/paymentProof/dianazikri-12-07-22.jpeg', 1),
(7, 20, 4, '2022-07-12 11:17:46', '../user/paymentProof/nurhafieza-12-07-22.jpg', 1),
(7, 23, 4, '2022-07-12 11:27:17', '../user/paymentProof/nursufiya-12-07-22.jpeg', 1),
(7, 27, 4, '2022-07-12 11:34:14', '../user/paymentProof/norerina-12-07-22.jpg', 2),
(8, 2, 4, '2022-07-12 11:06:04', '../user/paymentProof/zikriaysar-12-07-22.jpg', 1),
(8, 3, 4, '2022-07-12 11:19:00', '../user/paymentProof/salim-12-07-22.jpg', 1),
(8, 10, 4, '2022-07-12 11:08:18', '../user/paymentProof/kamarulrafiq-12-07-22.jpeg', 1),
(8, 11, 4, '2022-07-12 11:08:44', '../user/paymentProof/nuraleya-12-07-22.jpg', 1),
(8, 14, 4, '2022-07-12 11:22:43', '../user/paymentProof/nurafifah-12-07-22.jpg', 1),
(8, 15, 4, '2022-07-12 11:11:37', '../user/paymentProof/ainamni-12-07-22.jpeg', 1),
(8, 17, 4, '2022-07-12 11:12:11', '../user/paymentProof/gopinathan-12-07-22.jpeg', 1),
(8, 21, 4, '2022-07-12 11:24:24', '../user/paymentProof/yapmunkhee-12-07-22.png', 1),
(8, 22, 4, '2022-07-12 11:25:03', '../user/paymentProof/raihanazlan-12-07-22.jpg', 1),
(8, 28, 4, '2022-07-12 18:41:30', '../user/paymentProof/bansiawxi-13-07-22.jpg', 1),
(9, 36, 4, '2022-07-13 02:49:13', '../user/paymentProof/natashaaliah-13-07-22.jpg', 2),
(10, 11, 4, '2022-07-12 11:08:44', '../user/paymentProof/nuraleya-12-07-22.jpg', 1),
(10, 12, 4, '2022-07-12 11:09:33', '../user/paymentProof/imrantaufek-12-07-22.png', 1),
(10, 13, 4, '2022-07-12 11:10:03', '../user/paymentProof/dianazikri-12-07-22.jpeg', 1),
(10, 15, 4, '2022-07-12 11:11:37', '../user/paymentProof/ainamni-12-07-22.jpeg', 1),
(10, 16, 1, '2022-07-12 11:11:55', '../user/paymentProof/chaikeyteh-12-07-22.jpg', 3),
(10, 17, 4, '2022-07-12 11:12:11', '../user/paymentProof/gopinathan-12-07-22.jpeg', 1),
(10, 27, 4, '2022-07-12 11:34:14', '../user/paymentProof/norerina-12-07-22.jpg', 2);

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
  `userAddress` varchar(100) DEFAULT NULL,
  `userCode` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userID`, `userLevel`, `userUname`, `userPassw`, `userName`, `userPhone`, `userEmail`, `userGender`, `userBirthdate`, `userAddress`, `userCode`) VALUES
(1, 3, 'student', 'student', 'Khairul Haziq bin Khairy', '0164005753', 'ihaziqkhairy@gmail.com', 1, '2002-04-13', 'No. 14, Lorong Hang Tuah 7, Apartment Utama, 31490 Chenderiang, Perak', 631142),
(2, 3, 'zikriaysar', 'zikriaysar', 'Mohamad Zikri bin Aysar', '0169328422', 'zikriaysar@gmail.com', 1, '2005-04-14', 'No. 4, Jln 6/9E, Kondominium Angkasa, 62573 Precinct 4, Putrajaya', NULL),
(3, 3, 'salim', 'salim', 'Muhammad Salim bin Rusman', '0154673944', 'salimirusman@hotmail.com', 1, '2005-12-05', 'No. 34, Jalan Anson 7/55, PJU73, 62393 Precinct 8, Putrajaya', NULL),
(4, 1, 'admin', 'admin', 'Harith Adib bin Mikail', '0142539622', 'rithdib@gmail.com', 1, '1996-11-08', '52, Jalan Petaling, Bandar Flora, 01524 Simpang Empat, Perlis Indera Kayangan', NULL),
(5, 2, 'shazwan321', 'shazwan321', 'Shazwan bin Faizal', '0193024231', 'shazwan@yahoo.com', 1, '1988-12-05', '869, Lorong Yap Ah Shak, USJ 39M, 30005 Sitiawan, Perak Darul Ridzuan', NULL),
(6, 2, 'afiffudin', 'pudin123', 'Afiffuddin Anas bin Kilau', '0199874040', 'fudin12@yahoo.com', 1, '1992-07-02', '1, Lorong 4/8E, Lembah Sungai Long, 47669 Klang, Selangor Darul Ehsan', NULL),
(7, 2, 'tutor', 'tutor', 'Siti Bayani binti Amzar', '0179611828', 'sitibayani93@yahoo.com', 2, '1993-03-17', 'No. 40, Jln 9/9Z, PJU44, 05120 Merbok, Kedah Darul Aman', NULL),
(8, 2, 'jasmin', 'jasmin', 'Jasmin Ilyas binti Haziq', '01435381156', 'jasmin_96@hotmail.com', 2, '1996-12-16', 'No. 69, Jalan Sempadan 9/4N, Taman Rahman, 15646 Gua Musang, Kelantan', NULL),
(9, 2, 'taniza', 'taniza', 'Nur Taniza binti Suhardy', '0194234854', 'taniza94@gmail.com', 2, '1994-06-17', '3, Jalan 15U, Desa Petaling, 62898 Precinct 5, Putrajaya', NULL),
(10, 3, 'kamarulrafiq', 'kamarulrafiq', 'Kamarul Rafiq bin Shapiein', '0197581723', 'kamarulrafiq@gmail.com', 1, '2005-06-07', 'No. 6, Lorong 3/4, Damansara Melawati, 16449 Tok Bali, Kelantan Darul Naim', NULL),
(11, 3, 'nuraleya', 'nuraleya', 'Nur Aleya binti Dazila', '0198677267', 'aleya72@gmail.com', 2, '2005-02-27', '53, Lorong 2D, Bukit Pahlawan, 30004 Behrang, Perak Darul Ridzuan', NULL),
(12, 3, 'imrantaufek', 'imrantaufek', 'Imran Taufek bin Syed Dini', '0129512664', 'imrantaufek@gmail.com', 1, '2005-08-16', 'No. F-57-54, Jln 4/1, Taman Desa Delima, 72824 Tiroi, Negeri Sembilan', NULL),
(13, 3, 'dianazikri', 'dianazikri', 'Nur Diana binti Zikri', '0129858124', 'dianazikri@yahoo.com', 2, '2006-12-13', 'Lot S-88-34, Jalan 4/28U, Bandar Tengah, 02186 Simpang Empat, Perlis', NULL),
(14, 3, 'nurafifah', 'nurafifah', 'Nurafifah binti Hazzam', '0195827301', 'nurafifahhazzam@gmail.com', 2, '2005-03-24', 'No. 447, Lorong 3/7, Pandan Meru, 23750 Rantau Abang, Terengganu Darul Iman', NULL),
(15, 3, 'ainamni', 'ainamni', 'Ain Amni binti Wahab', '0129518232', 'ainamni@yahoo.com', 2, '2006-06-01', '312, Lorong 2Y, Bandar Utara, 27454 Karak, Pahang Darul Makmur', NULL),
(16, 3, 'chaikeyteh', 'chaikeyteh', 'Chai Key Teh', '0176932012', 'chaikeyteh@yahoo.com', 1, '2005-12-23', '987, Jalan 9, SS87, 47143 Subang Jaya, Selangor', NULL),
(17, 3, 'gopinathan', 'gopinathan', 'Gopinathan a/l Pragash', '0179620124', 'gopinathan@yahoo.com', 1, '2005-03-21', 'No. 1, Jalan Ampang 8/4, SS64O, 62040 Precinct 5, Putrajaya', NULL),
(18, 3, 'rafizal', 'rafizal', 'Rafizal bin Che Rusli Hamid', '0124860291', 'rafizal@gmail.com', 1, '2006-06-16', 'Lot 51, Jalan 8/17J, PJU62, 12225 Nibong Tebal, Pulau Pinang', NULL),
(19, 3, 'nursofiya', 'nursofiya', 'Nur Sofiya binti Izam', '0169182845', 'nursofiya@gmail.com', 2, '2006-04-15', '1, Jalan 8/85X, Taman Mahkota, 39189 Chendor, Pahang', NULL),
(20, 3, 'nurhafieza', 'nurhafieza', 'Nur Hafieza binti Shameer', '0192528692', 'nurhafieza@gmail.com', 2, '2005-09-20', '93, Jln 6/9C, Batu Pertama, 62640 Precinct 4, Putrajaya', NULL),
(21, 3, 'yapmunkhee', 'yapmunkhee', 'Yap Mun Khee', '0125859123', 'yapmunkhee@gmail.com', 2, '2005-12-16', '3, Jalan Genting Klang 2/96Z, Alam Sungai Besi, 80459 Skudai, Johor', NULL),
(22, 3, 'raihanazlan', 'raihanazlan', 'Muhammad Raihan bin Azlan', '0196862931', 'raihanazlan@gmail.com', 1, '2005-06-11', 'No. 50, Jalan 2/5, Taman Anggerik, 12159 George Town, Penang', NULL),
(23, 3, 'nursufiya', 'nursufiya', 'Nur Sufiya binti Abu Bakar', '0196251237', 'nursufiya@gmail.com', 2, '2005-05-10', '71, Jalan Pudu 20Q, SS8, 59352 Taman Desa, WP Kuala Lumpur', NULL),
(24, 3, 'danishirfan', 'danishirfan', 'Danish Irfan bin Shahrul', '0129862359', 'danishirfan@gmail.com', 1, '2005-02-06', 'Lot 6-1, Jalan Perdana 4, PJU79, 79829 Gemas Baharu, Johor Darul Ta\'zim', NULL),
(25, 3, 'hakimidaniel', 'hakimidaniel', 'Hakimi Daniel bin Haque', '0179621268', 'hakimidaniel@gmail.com', 1, '2006-03-23', '46, Lorong Conlay 7/8F, Bandar Sri Permai, 23236 Kuala Berang, Terengganu Darul Iman', NULL),
(26, 3, 'nazirah', 'nazirah', 'Nazirah binti Nik Hazrie', '0196821845', 'nazirahhazrie@gmail.com', 2, '2005-11-08', '8T-79, Jalan 12W, Taman Aman, 62783 Precinct 5, Putrajaya', NULL),
(27, 3, 'norerina', 'norerina', 'Norerina Aziz binti Hisham', '0129581723', 'norerinaaziz@gmail.com', 2, '2005-01-24', '77, Jalan 4, Bandar Kuchai, 98609 Bario, Sarawak', NULL),
(28, 3, 'bansiawxi', 'bansiawxi', 'Ban Siaw Xi', '0179285723', 'bansiawxi@gmail.com', 2, '2005-06-30', '900, Lorong Ariffin 3/3, PJU14, 45228 Damansara, Selangor Darul Ehsan', NULL),
(29, 3, 'amranikmal', 'amranikmal', 'Muhammad Amran bin Ikmal', '0198662322', 'amranikmal@gmail.com', 1, '2005-06-07', 'Z-00-23, Jalan Wan Kadir 2/5, Pandan Manggis, 34854 Tanjung Rambutan, Perak', NULL),
(30, 3, 'nikafiq', 'nikafiq', 'Nik Afiq bin Hakimi', '0168491023', 'nikafiq@gmail.com', 1, '2005-08-19', '1-3, Lorong Lt. Adnan, PJS14, 79840 Mersing, Johor', NULL),
(31, 3, 'isyrafhamizan', 'isyrafhamizan', 'Isyraf Hamizan bin Amir', '0128921044', 'isyrafhamizan@gmail.com', 1, '2005-12-02', 'No. 9-3, Jln 6/47B, Seksyen 29, 02713 Chuping, Perlis', NULL),
(32, 3, 'wannazirul', 'wannazirul', 'Wan Nazirul bin Nasir', '0138521942', 'wannazirul@gmail.com', 1, '2006-02-16', 'No. 22, Lorong Zainal Abidin 3/7, PJU89, 82000 Permas Jaya, Johor Darul Ta\'zim', NULL),
(33, 3, 'hoofonliek', 'hoofonliek', 'Hoo Fon Liek', '0195128849', 'hoofonliek@yahoo.com', 1, '2005-08-27', '4, Jalan Raja Chulan 11N, Seri Permai, 62568 Precinct 18, Putrajaya', NULL),
(34, 3, 'nurulhayatul', 'nurulhayatul', 'Nurul Hayatul binti Salleh', '0129987411', 'nurulhayatul@gmail.com', 2, '2005-03-03', '3, Jalan 9/35, Damansara Bintang, 27659 Temerloh, Pahang', NULL),
(35, 3, 'suhailaaini', 'suhailaaini', 'Suhaila Aini binti Kamal', '0179688821', 'suhailaaini@gmail.com', 2, '2005-08-07', '1, Lorong 3/9A, Bandar Anggerik, 87026 Layang-Layang, Labuan', NULL),
(36, 3, 'natashaaliah', 'natashaaliah', 'Natasha Aliah binti Razak', '0129589912', 'natashaaliah@gmail.com', 2, '2005-12-02', 'No. 1G-90, Jln Cochrane 3P, Bandar Sri Rahman, 52746 Sungai Lembing, Pahang Darul Makmur', NULL),
(38, 3, 'rafik', 'rafik', 'rafik', '2312', 'email', 1, '2022-07-12', 'ad', NULL);

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
  MODIFY `fbID` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userID` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
