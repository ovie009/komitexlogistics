-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 10, 2020 at 04:40 PM
-- Server version: 10.4.15-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u252710402_komitexlog`
--

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `Affiliate` varchar(30) DEFAULT NULL,
  `Agent` varchar(30) DEFAULT NULL,
  `Logistics` varchar(30) DEFAULT NULL,
  `Merchant` varchar(30) DEFAULT NULL,
  `Status` varchar(30) NOT NULL DEFAULT 'Not Approved',
  `DateTime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `Affiliate`, `Agent`, `Logistics`, `Merchant`, `Status`, `DateTime`) VALUES
(6, NULL, 'ccuardallv', 'jchatell2', NULL, 'Approved', '2020-09-21 10:22:28'),
(24, 'fjoseph7', NULL, NULL, 'mhadrill3', 'Approved', '2020-09-21 10:22:28'),
(25, NULL, NULL, 'jchatell2', 'cmourgeb', 'Approved', '2020-09-21 10:22:28'),
(26, NULL, 'Npellamonuten1h', 'jchatell2', NULL, 'Approved', '2020-09-21 10:22:28'),
(29, NULL, 'Ebultera', 'jchatell2', NULL, 'Approved', '2020-09-21 10:22:28'),
(44, NULL, NULL, 'jchatell2', 'mhadrill3', 'Approved', '2020-09-21 10:22:28'),
(45, NULL, NULL, 'Rsmaridge9', 'mhadrill3', 'Approved', '2020-09-21 10:22:28'),
(46, NULL, NULL, 'Hreedie1b', 'mhadrill3', 'Approved', '2020-09-21 10:22:28'),
(47, NULL, 'rmallaby16', 'rsmaridge9', NULL, 'Approved', '2020-09-21 10:22:28'),
(48, NULL, NULL, 'jchatell2', 'sdreini6', 'Approved', '2020-09-21 10:22:28'),
(49, NULL, NULL, 'jchatell2', 'cgildroy8', 'Approved', '2020-09-21 10:22:28'),
(51, NULL, NULL, 'jchatell2', 'gashburne1l', 'Approved', '2020-09-21 15:13:11'),
(52, NULL, NULL, 'jchatell2', 'Jayboy999', 'Approved', '2020-11-26 19:53:48'),
(53, NULL, NULL, 'Komitex', 'mhadrill3', 'Approved', '2020-11-28 13:41:05'),
(54, NULL, NULL, 'komitex', 'savvysage', 'Approved', '2020-11-28 13:41:00'),
(55, NULL, NULL, 'randomlogistics', 'savvysage', 'Approved', '2020-11-28 13:39:25'),
(56, NULL, NULL, 'Komitex', 'Doe', 'Approved', '2020-11-28 13:40:50');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` int(11) NOT NULL,
  `Merchant` varchar(20) NOT NULL,
  `GroupName` varchar(50) NOT NULL,
  `FirstProduct` varchar(50) DEFAULT NULL,
  `FirstQuantity` int(3) DEFAULT NULL,
  `SecondProduct` varchar(50) DEFAULT NULL,
  `SecondQuantity` int(3) DEFAULT NULL,
  `ThirdProduct` varchar(50) DEFAULT NULL,
  `ThirdQuantity` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `Merchant`, `GroupName`, `FirstProduct`, `FirstQuantity`, `SecondProduct`, `SecondQuantity`, `ThirdProduct`, `ThirdQuantity`) VALUES
(1, 'mhadrill3', 'Prototype', 'Vibroaction', 1, 'Richard Mille', 2, NULL, NULL),
(2, 'mhadrill3', 'Wiper Kit', NULL, NULL, 'Vibroaction', 1, 'W34', 2),
(3, 'mhadrill3', 'Zephyrus', 'Bleeding Edge', 1, 'CCTV camera', 1, NULL, NULL),
(4, 'mhadrill3', 'bla', 'Gyneo Gel', 2, 'Spin Scrubber', 2, NULL, NULL),
(5, 'mhadrill3', 'Brick', 'Richard Mille', 1, 'W34', 1, NULL, NULL),
(6, 'mhadrill3', 'Camera', 'Panoramic Camera', 1, 'CCTV camera', 1, NULL, NULL),
(7, 'mhadrill3', 'Camera Kit', 'Panoramic Camera', 1, 'CCTV camera', 1, NULL, NULL),
(8, 'Doe', 'Workout Combo', 'Set of Barbell', 1, 'Non Pedal Wonder Core ', 1, 'Situp Bench', 1);

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `location` varchar(20) NOT NULL,
  `price` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`id`, `username`, `location`, `price`) VALUES
(1, 'jchatell2', 'Warri', '2000'),
(2, 'jchatell2', 'Benin', '3000'),
(3, 'jchatell2', 'Auchi', '4000'),
(5, 'jchatell2', 'Ughelli', '2500'),
(6, 'jchatell2', 'Abraka', '3000'),
(8, 'jchatell2', 'Asaba', '3000'),
(9, 'jchatell2', 'Ekpoma', '3500'),
(10, 'rsmaridge9', 'Abraka', '2000'),
(11, 'jchatell2', 'Sapele', '3000'),
(12, 'jchatell2', 'Agbor', '3000'),
(13, 'SendMe Logistics', 'Ogun State', '3500'),
(14, 'SendMe Logistics', 'Abeokuta', '2000'),
(15, 'Komitex', 'Warri', '2000'),
(16, 'Komitex', 'Udu', '2500'),
(17, 'Komitex', 'Ughelli', '2500'),
(18, 'Komitex', 'Abraka', '3000'),
(19, 'Komitex', 'Obiaruku', '3500'),
(20, 'Komitex', 'Sapele', '3000'),
(21, 'Komitex', 'Benin', '3000'),
(22, 'Komitex', 'Asaba', '3000'),
(23, 'Zizi', 'Lagos(ikeja)', '1500'),
(24, 'randomlogistics', 'Lagos State', '5000'),
(25, 'randomlogistics', 'Ogun State', '8000'),
(26, 'Victor', 'Edo state ', '2000'),
(27, 'TayoKings', 'Lagos', '2500'),
(28, 'Jfroyale', 'Akure', '2000'),
(29, 'Jfroyale', 'Okitipupa', '3500'),
(30, 'King great', 'Imo', '5000');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `komitexLogisticsId` int(11) NOT NULL,
  `komitexLogisticsFullname` varchar(50) NOT NULL,
  `komitexLogisticsUsername` varchar(20) NOT NULL,
  `komitexLogisticsEmail` varchar(40) NOT NULL,
  `komitexLogisticsPhone` varchar(15) NOT NULL,
  `komitexLogisticsPassword` varchar(120) NOT NULL,
  `komitexLogisticsAccountType` varchar(30) DEFAULT NULL,
  `komitexLogisticsProfilePhoto` varchar(50) NOT NULL DEFAULT 'icons/others/user.png',
  `home` datetime NOT NULL DEFAULT current_timestamp(),
  `waybill` datetime NOT NULL DEFAULT current_timestamp(),
  `contacts` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`komitexLogisticsId`, `komitexLogisticsFullname`, `komitexLogisticsUsername`, `komitexLogisticsEmail`, `komitexLogisticsPhone`, `komitexLogisticsPassword`, `komitexLogisticsAccountType`, `komitexLogisticsProfilePhoto`, `home`, `waybill`, `contacts`) VALUES
(20, 'Cindra Petruskevich', 'cpetruskevich1', 'cpetruskevich1@utexas.edu', '721-275-3629', '$2y$10$4Eh4.i9h8h2yqL0l89l.V.FsUwzsNHeA1qCnmazZcNuAfRg1WIbK.', 'Affiliate', 'uploads/cpetruskevich1.jpg', '2020-09-16 19:52:27', '2020-09-16 19:52:27', '2020-09-16 19:52:27'),
(21, 'Jemmie Chatell', 'jchatell2', 'jchatell2@intel.com', '741-209-2298', '$2y$10$2UuvT1B..GNFPCYKv9wYw.HCpM5gcIMbU2OjcOlW1rsKnqG8iXMM.', 'Logistics', 'uploads/jchatell2.png', '2020-11-28 14:44:55', '2020-11-28 14:43:28', '2020-11-26 20:15:41'),
(22, 'Maureen Hadrill', 'mhadrill3', 'mhadrill3@alibaba.com', '354-389-5075', '$2y$10$u6.Bco0NRGUTynyGn0JwOuc.C.bBFEW6BLLNPbizdDoSibDh1y4NS', 'Merchant', 'uploads/mhadrill3.jpg', '2020-11-30 07:48:08', '2020-11-30 07:47:52', '2020-11-30 07:47:56'),
(23, 'Julius Furney', 'jfurney4', 'jfurney4@usda.gov', '900-786-6121', '$2y$10$nGYzkQ38t05D2bUielYz7.dvKh9WBkBvAb0TOBgqFMGdvEyfu/Asq', 'Affiliate', 'icons/others/user.png', '2020-09-16 19:52:27', '2020-09-16 19:52:27', '2020-09-16 19:52:27'),
(24, 'Barbie Goldwater', 'bgoldwater5', 'bgoldwater5@godaddy.com', '244-168-2836', '$2y$10$82noXfCH6oxaojwpeIarJ.tcY0vXPXQ2JNa62p9ttS65F5R6hirfK', 'Affiliate', 'icons/others/user.png', '2020-09-16 19:52:27', '2020-09-16 19:52:27', '2020-09-16 19:52:27'),
(25, 'Sebastiano Dreini', 'sdreini6', 'sdreini6@prlog.org', '275-792-0031', '$2y$10$8JNwf1YUu6RiykQVe4uylunAr/KCs5W38w2wyuxsyiMgffrAfIRG2', 'Merchant', 'uploads/sdreini6.jpg', '2020-09-22 11:31:39', '2020-09-22 11:28:11', '2020-09-22 11:31:35'),
(26, 'Frayda Joseph', 'fjoseph7', 'fjoseph7@desdev.cn', '615-730-8686', '$2y$10$jllRFzrIw7nmVCJmk05k8.DoOhfeE3l2uRLar7/z.qzcbuyxPAR.a', 'Affiliate', 'uploads/fjoseph7.jpg', '2020-11-12 17:59:31', '2020-09-16 19:52:27', '2020-11-12 18:00:17'),
(27, 'Caria Gildroy', 'cgildroy8', 'cgildroy8@51.la', '692-664-5956', '$2y$10$ll90J6fuCqb2dEDVQGlaXeXS0mM3jm2QUmbjKBvO1z74VH/Jv/7qu', 'Merchant', 'icons/others/user.png', '2020-09-22 11:26:40', '2020-09-21 13:58:04', '2020-09-22 11:26:45'),
(28, 'Robby Smaridge', 'rsmaridge9', 'rsmaridge9@tripod.com', '564-332-3406', '$2y$10$IMDcSecBGZt1naLGwxLVau7Ma8aTyDmM9w29fbBu/a.UzbTQRnyMm', 'Logistics', 'uploads/rsmaridge9.jpg', '2020-09-16 19:52:27', '2020-09-16 19:52:27', '2020-09-16 19:52:27'),
(29, 'Emiline Bulter', 'ebultera', 'ebultera@google.ru', '598-276-9241', '$2y$10$BPtzCbO/DMWgN37MSi2DiOYc7OqmawD0dO1Qb1T3G/KekBJmExdP2', 'Agent', 'uploads/ebultera.jpg', '2020-09-16 19:52:27', '2020-09-20 14:31:04', '2020-09-16 19:52:27'),
(30, 'Cullie Mourge', 'cmourgeb', 'cmourgeb@com.com', '106-812-5663', '$2y$10$U1EKeWCLHRAIiMpT44O1nuDQzRjwUjegO4wEOeswa/SZt0eGpEtbO', 'Merchant', 'uploads/cmourgeb.jpg', '2020-09-16 19:52:27', '2020-09-16 19:52:27', '2020-09-16 19:52:27'),
(31, 'Anselma Kenefick', 'akenefickc', 'akenefickc@ehow.com', '995-967-9957', 'B7lV7aGQ', 'Affiliate', 'icons/others/user.png', '2020-09-16 19:52:27', '2020-09-16 19:52:27', '2020-09-16 19:52:27'),
(32, 'Alfred Gullivan', 'agullivand', 'agullivand@hostgator.com', '182-297-2966', 'Wg7r1d', 'Merchant', 'icons/others/user.png', '2020-09-16 19:52:27', '2020-09-16 19:52:27', '2020-09-16 19:52:27'),
(33, 'Kin Tisor', 'ktisore', 'ktisore@behance.net', '204-942-2348', 'B8FqFQaPVZ', 'Merchant', 'icons/others/user.png', '2020-09-16 19:52:27', '2020-09-16 19:52:27', '2020-09-16 19:52:27'),
(34, 'Desmond Moreinis', 'dmoreinisf', 'dmoreinisf@epa.gov', '151-825-5569', 'PKZ5MzmSHx', 'Affiliate', 'icons/others/user.png', '2020-09-16 19:52:27', '2020-09-16 19:52:27', '2020-09-16 19:52:27'),
(35, 'Konstantine Philpott', 'kphilpottg', 'kphilpottg@bloomberg.com', '142-344-1788', 'VwCoFK', NULL, 'icons/others/user.png', '2020-09-16 19:52:27', '2020-09-16 19:52:27', '2020-09-16 19:52:27'),
(36, 'Ethelind Adolf', 'eadolfh', 'eadolfh@cnbc.com', '581-795-6870', 'n1RkYh', 'Merchant', 'icons/others/user.png', '2020-09-16 19:52:27', '2020-09-16 19:52:27', '2020-09-16 19:52:27'),
(37, 'Tally Ditt', 'tditti', 'tditti@webeden.co.uk', '105-668-7732', '3RCB1MJ', 'Merchant', 'icons/others/user.png', '2020-09-16 19:52:27', '2020-09-16 19:52:27', '2020-09-16 19:52:27'),
(38, 'Catie Dufour', 'cdufourj', 'cdufourj@stanford.edu', '851-578-9122', 'kFsCUM8mquOQ', 'Merchant', 'icons/others/user.png', '2020-09-16 19:52:27', '2020-09-16 19:52:27', '2020-09-16 19:52:27'),
(39, 'Karine Nyssen', 'knyssenk', 'knyssenk@bing.com', '848-352-5343', 'r6LyOC', 'Merchant', 'icons/others/user.png', '2020-09-16 19:52:27', '2020-09-16 19:52:27', '2020-09-16 19:52:27'),
(40, 'Shaylyn Pask', 'spaskl', 'spaskl@boston.com', '588-639-6999', 'TiyGYDfpPQl', 'Merchant', 'icons/others/user.png', '2020-09-16 19:52:27', '2020-09-16 19:52:27', '2020-09-16 19:52:27'),
(41, 'Lloyd Wilmington', 'lwilmingtonm', 'lwilmingtonm@businessweek.com', '308-502-4188', 'TVBIfCZBdsvG', 'Merchant', 'icons/others/user.png', '2020-09-16 19:52:27', '2020-09-16 19:52:27', '2020-09-16 19:52:27'),
(42, 'Robbie Inglefield', 'ringlefieldn', 'ringlefieldn@fda.gov', '539-413-7529', 'zN3JhmV0', 'Merchant', 'icons/others/user.png', '2020-09-16 19:52:27', '2020-09-16 19:52:27', '2020-09-16 19:52:27'),
(43, 'Easter Malarkey', 'emalarkeyo', 'emalarkeyo@apache.org', '131-944-2927', 'jtlDfCl', 'Merchant', 'icons/others/user.png', '2020-09-16 19:52:27', '2020-09-16 19:52:27', '2020-09-16 19:52:27'),
(44, 'Colene Lambkin', 'clambkinp', 'clambkinp@is.gd', '438-759-0777', 'h2Ls4rW', 'Affiliate', 'icons/others/user.png', '2020-09-16 19:52:27', '2020-09-16 19:52:27', '2020-09-16 19:52:27'),
(45, 'Lorraine Jensen', 'ljensenq', 'ljensenq@mozilla.com', '466-318-7172', 'JgJajBvNAl2', 'Merchant', 'icons/others/user.png', '2020-09-16 19:52:27', '2020-09-16 19:52:27', '2020-09-16 19:52:27'),
(46, 'Broddy Kimberly', 'bkimberlyr', 'bkimberlyr@nationalgeographic.', '673-893-2534', 'vwcoZTNsAP', 'Merchant', 'icons/others/user.png', '2020-09-16 19:52:27', '2020-09-16 19:52:27', '2020-09-16 19:52:27'),
(47, 'Morly Allum', 'mallums', 'mallums@aol.com', '457-318-4696', '6yuRXz9XNoN2', 'Agent', 'icons/others/user.png', '2020-09-16 19:52:27', '2020-09-16 19:52:27', '2020-09-16 19:52:27'),
(48, 'Lesley Drewes', 'ldrewest', 'ldrewest@photobucket.com', '902-226-8332', 'Zd4FvEA', 'Affiliate', 'icons/others/user.png', '2020-09-16 19:52:27', '2020-09-16 19:52:27', '2020-09-16 19:52:27'),
(49, 'Rodger Wittey', 'rwitteyu', 'rwitteyu@spiegel.de', '495-218-8896', 'cz9hFgPH', 'Affiliate', 'icons/others/user.png', '2020-09-16 19:52:27', '2020-09-16 19:52:27', '2020-09-16 19:52:27'),
(50, 'Carrol Cuardall', 'ccuardallv', 'ccuardallv@newsvine.com', '719-468-6210', '$2y$10$Ry9KaMsliDtCGPA0SCO.H.VTbexeOYQsMO.kvrZaAb7geoIydGwWq', 'Agent', 'uploads/ccuardallv.jpg', '2020-11-12 16:26:40', '2020-11-12 16:27:46', '2020-11-12 16:26:55'),
(51, 'Carmella Scryne', 'cscrynew', 'cscrynew@usa.gov', '286-544-0140', '7XwFae8tGunw', 'Merchant', 'icons/others/user.png', '2020-09-16 19:52:27', '2020-09-16 19:52:27', '2020-09-16 19:52:27'),
(52, 'Andreas Jannings', 'ajanningsx', 'ajanningsx@sbwire.com', '537-612-4415', 'vfWIBc5Try', 'Affiliate', 'icons/others/user.png', '2020-09-16 19:52:27', '2020-09-16 19:52:27', '2020-09-16 19:52:27'),
(53, 'Emeline Letixier', 'eletixiery', 'eletixiery@google.com.au', '867-747-6218', 's4olB0S8r2VR', 'Affiliate', 'icons/others/user.png', '2020-09-16 19:52:27', '2020-09-16 19:52:27', '2020-09-16 19:52:27'),
(54, 'Corbett Ricold', 'cricoldz', 'cricoldz@unesco.org', '799-121-2606', '2HOmem', 'Merchant', 'icons/others/user.png', '2020-09-16 19:52:27', '2020-09-16 19:52:27', '2020-09-16 19:52:27'),
(55, 'Kora Niese', 'kniese10', 'kniese10@baidu.com', '254-585-3739', '5nElmqABKEh', 'Merchant', 'icons/others/user.png', '2020-09-16 19:52:27', '2020-09-16 19:52:27', '2020-09-16 19:52:27'),
(56, 'Tiphany Bellchamber', 'tbellchamber11', 'tbellchamber11@bbb.org', '573-997-3895', 'snN4fxj', 'Merchant', 'icons/others/user.png', '2020-09-16 19:52:27', '2020-09-16 19:52:27', '2020-09-16 19:52:27'),
(57, 'Donnie Dominey', 'ddominey12', 'ddominey12@freewebs.com', '525-227-0898', 'EmpMCDw1s', 'Agent', 'icons/others/user.png', '2020-09-16 19:52:27', '2020-09-16 19:52:27', '2020-09-16 19:52:27'),
(58, 'Cherice Haug', 'chaug13', 'chaug13@cnbc.com', '722-139-5563', 'SQc8to', 'Agent', 'icons/others/user.png', '2020-09-16 19:52:27', '2020-09-16 19:52:27', '2020-09-16 19:52:27'),
(59, 'Harriott McCluskey', 'hmccluskey14', 'hmccluskey14@nbcnews.com', '538-133-1241', 'x4B6h3', 'Merchant', 'icons/others/user.png', '2020-09-16 19:52:27', '2020-09-16 19:52:27', '2020-09-16 19:52:27'),
(60, 'Jeniece Maccree', 'jmaccree15', 'jmaccree15@usatoday.com', '407-972-0720', 'ULQ5pRD4Oqyy', 'Affiliate', 'icons/others/user.png', '2020-09-16 19:52:27', '2020-09-16 19:52:27', '2020-09-16 19:52:27'),
(61, 'Rossy Mallaby', 'rmallaby16', 'rmallaby16@topsy.com', '366-289-9594', 'h9ASiMFI', 'Agent', 'icons/others/user.png', '2020-09-16 19:52:27', '2020-09-16 19:52:27', '2020-09-16 19:52:27'),
(62, 'Raquel Grishkov', 'rgrishkov17', 'rgrishkov17@netlog.com', '176-801-7061', '2qKU2cnd', 'Agent', 'icons/others/user.png', '2020-09-16 19:52:27', '2020-09-16 19:52:27', '2020-09-16 19:52:27'),
(63, 'Gratia Danilchev', 'gdanilchev18', 'gdanilchev18@theatlantic.com', '437-919-9774', 'KhGKkY', 'Merchant', 'icons/others/user.png', '2020-09-16 19:52:27', '2020-09-16 19:52:27', '2020-09-16 19:52:27'),
(64, 'Karilynn Busst', 'kbusst19', 'kbusst19@canalblog.com', '685-239-1124', 'FZVG6TmwN6uy', 'Merchant', 'icons/others/user.png', '2020-09-16 19:52:27', '2020-09-16 19:52:27', '2020-09-16 19:52:27'),
(65, 'Ainsley Iacovacci', 'aiacovacci1a', 'aiacovacci1a@bigcartel.com', '189-448-0136', '3pkMZ4ZIVZ', 'Affiliate', 'icons/others/user.png', '2020-09-16 19:52:27', '2020-09-16 19:52:27', '2020-09-16 19:52:27'),
(66, 'Happy Reedie', 'hreedie1b', 'hreedie1b@tripadvisor.com', '214-497-6489', 'bBcn4lWiYl', 'Logistics', 'icons/others/user.png', '2020-09-16 19:52:27', '2020-09-16 19:52:27', '2020-09-16 19:52:27'),
(67, 'Catie Hissett', 'chissett1c', 'chissett1c@apache.org', '916-244-5375', 'I1qDpin9HHYl', 'Affiliate', 'icons/others/user.png', '2020-09-16 19:52:27', '2020-09-16 19:52:27', '2020-09-16 19:52:27'),
(68, 'Tabbi Pedder', 'tpedder1d', 'tpedder1d@joomla.org', '562-443-2094', 'vNGPvOrE1H', 'Agent', 'icons/others/user.png', '2020-09-16 19:52:27', '2020-09-16 19:52:27', '2020-09-16 19:52:27'),
(69, 'Rebeka Frangleton', 'rfrangleton1e', 'rfrangleton1e@posterous.com', '659-327-9997', 'cWjX6UW', 'Agent', 'icons/others/user.png', '2020-09-16 19:52:27', '2020-09-16 19:52:27', '2020-09-16 19:52:27'),
(70, 'Yves McLellan', 'ymclellan1f', 'ymclellan1f@unicef.org', '412-347-2184', 'IK5wxJd', 'Merchant', 'icons/others/user.png', '2020-09-16 19:52:27', '2020-09-16 19:52:27', '2020-09-16 19:52:27'),
(71, 'Zane Matussevich', 'zmatussevich1g', 'zmatussevich1g@mayoclinic.com', '202-197-1906', 'D038Uk5yHrl0', 'Agent', 'icons/others/user.png', '2020-09-16 19:52:27', '2020-09-16 19:52:27', '2020-09-16 19:52:27'),
(72, 'Nalani Pellamonuten', 'npellamonuten1h', 'npellamonuten1h@xinhuanet.com', '385-795-5127', '$2y$10$gu765EyQ4y6h.Eb23ID2uOE/PwvQPnAeqBXc..8/wpDbZv53Se52K', 'Agent', 'uploads/npellamonuten1h.jpg', '2020-09-16 19:52:27', '2020-09-16 19:52:27', '2020-09-16 19:52:27'),
(73, 'Ronny Frudd', 'rfrudd1i', 'rfrudd1i@reference.com', '519-386-3504', 'VxkWMeGmG22', 'Merchant', 'icons/others/user.png', '2020-09-16 19:52:27', '2020-09-16 19:52:27', '2020-09-16 19:52:27'),
(74, 'Jarret Windley', 'jwindley1j', 'jwindley1j@psu.edu', '814-570-2439', 'z4C7YCyt', 'Agent', 'icons/others/user.png', '2020-09-16 19:52:27', '2020-09-16 19:52:27', '2020-09-16 19:52:27'),
(75, 'Ealasaid Hammon', 'ehammon1k', 'ehammon1k@dailymotion.com', '927-610-8489', 'NCWEaAHo', 'Agent', 'icons/others/user.png', '2020-09-16 19:52:27', '2020-09-16 19:52:27', '2020-09-16 19:52:27'),
(76, 'Georgine Ashburne', 'gashburne1l', 'gashburne1l@xrea.com', '435-154-2660', '$2y$10$GtPmn85NgC19f2pPVSvYJuyPWy5fXKwh.2qQkBJ0OpmEgD2rAD5uS', 'Merchant', 'icons/others/user.png', '2020-10-25 23:26:24', '2020-09-22 11:33:26', '2020-09-21 15:13:16'),
(77, 'Petronia Mingaye', 'pmingaye1m', 'pmingaye1m@sun.com', '253-564-6888', 'Ei0h1mwP2', 'Agent', 'icons/others/user.png', '2020-09-16 19:52:27', '2020-09-16 19:52:27', '2020-09-16 19:52:27'),
(78, 'Anastassia Lago', 'alago1n', 'alago1n@trellian.com', '204-720-2939', 'sjSv0DuTufTA', 'Affiliate', 'icons/others/user.png', '2020-09-16 19:52:27', '2020-09-16 19:52:27', '2020-09-16 19:52:27'),
(82, 'Ajiri ', 'Jayboy999', 'jay.designs.branding@gmail.com', '+2348111104723', '$2y$10$TJi8qc2nxKDCur9fZMT55u/hMp9F7HQDTBTKuaCaPQBdxU2MTpLF6', 'Merchant', 'icons/others/user.png', '2020-11-26 20:30:52', '2020-11-26 20:16:10', '2020-11-26 20:03:10'),
(83, 'Muhammed Khalid', 'SendMe Logistics', 'mhalid36@gmail.com', '07068192265', '$2y$10$pXJ7RQA59esBbhG75Dda.ubX7LFwOX/EOVWO8jPZIw2F5saAJiloW', 'Logistics', 'uploads/SendMe Logistics.png', '2020-11-28 12:37:48', '2020-11-28 10:31:41', '2020-11-28 12:38:35'),
(84, 'Iffie Okomite', 'Komitex', 'komitexlogistics@gmail.com', '08122266618', '$2y$10$goT.hs/o/2H0.o0j1dk.Ou/1SCKiDoWsT4bXV30Oyx/LyuAMjMUHi', 'Logistics', 'uploads/Komitex.jpg', '2020-12-10 12:42:12', '2020-12-10 12:41:10', '2020-12-10 12:40:56'),
(85, 'Saviour Oveh', 'Zizi', 'zizilogistics1@gmail.com', '08065441707', '$2y$10$//XmbsGgA027LBn7XjrnuudEHWqUpVhDe5US9PAbQPZwdVcKGcs8a', 'Logistics', 'icons/others/user.png', '2020-11-30 08:57:33', '2020-11-28 12:53:41', '2020-11-28 13:27:07'),
(86, 'Savvy Sage', 'savvysage', 'savvysage0@gmail.com', '09041392203', '$2y$10$L1gNPuVjUIbHHTLq0CTkmepiadC0pO1d08TlnJbCsQ0kg3H/fnlfC', 'Merchant', 'icons/others/user.png', '2020-11-28 14:32:44', '2020-11-28 14:32:12', '2020-11-28 13:48:31'),
(87, 'Random Logistics', 'randomlogistics', 'randomlogistics@randomlogistics.com', '09012345678', '$2y$10$UHjjTc61Sz1xGFXouasDgOW6iMWk8vzNckya9Kvi6TF1cdR2rFveG', 'Logistics', 'icons/others/user.png', '2020-11-28 14:32:58', '2020-11-28 14:33:18', '2020-11-28 13:46:30'),
(88, 'Jane', 'Doe', 'janedoe@gmail.com', '08100000000', '$2y$10$i9fLYQBZxzncJYYN53sbB.XK3mbtIu7YMjwE6T79zE0omSDhSSl2e', 'Merchant', 'icons/others/user.png', '2020-11-30 13:41:39', '2020-11-30 13:34:51', '2020-11-28 13:41:17'),
(89, 'George Felicity', 'Felicity', 'umukorofelicity@gmail.com', '08115608585', '$2y$10$93yxWxBWkJJUcnklEFNVmOzzOvanh1poB3B78zBARlqb3vpAtH2P6', 'Affiliate', 'icons/others/user.png', '2020-11-28 14:10:34', '2020-11-28 14:07:09', '2020-11-28 14:07:09'),
(90, 'Achi Ebuka Victor ', 'Victor', 'ebukaachi4@gmail.com', '09079079135', '$2y$10$hASdbWKiFbtgEbeZOdpoaOiQoWJpyuPNmQshE1r/GVbhgRzZp1MQK', 'Logistics', 'icons/others/user.png', '2020-11-28 19:19:04', '2020-11-28 19:16:06', '2020-11-28 19:18:59'),
(91, 'Tayo', 'TayoKings', 'primematthewtayo@gmail.com', '07031984170', '$2y$10$b.b/pARu3x7VYXhz8Sa2UOAfPu0tcs7Gsd4rT5jG6IVZOG6ev1yqi', 'Logistics', 'uploads/TayoKings.jpg', '2020-11-29 00:13:08', '2020-11-29 00:12:33', '2020-11-29 00:12:44'),
(92, 'Yussuf Adedeji', 'Yussuf', 'dejiyusufonline@gmail.com', '08146385462', '$2y$10$VKrODzq.NBADzodh87Uom.Uo56Gbhc1pNbJbF6xwW6xz42lfbIhmK', 'Merchant', 'icons/others/user.png', '2020-11-29 15:17:12', '2020-11-29 15:17:12', '2020-11-29 15:18:26'),
(93, 'Joseph', 'Jfroyale', 'akejuoluwaseun01@gmail.com', '08035534080', '$2y$10$79GL45cDqKKsuzC8h4kUiumZkGDUR0GlVFOJqlOqJeGwYA.C2/7.q', 'Logistics', 'icons/others/user.png', '2020-11-29 17:20:01', '2020-11-29 17:20:07', '2020-11-29 15:49:39'),
(94, 'Onyekamma ebuka great', 'King great', 'otunbagreat@gmail.com', '07036789038', '$2y$10$yAk6U0zYj3WAVpeYIyIBKO7x7Fo18NmPKPbT/FWEDVUAY6QPzM.AK', 'Logistics', 'uploads/King great.jpg', '2020-11-30 06:00:35', '2020-11-30 05:59:50', '2020-11-30 06:05:37');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `Merchant` varchar(20) NOT NULL,
  `Affiliate` varchar(20) DEFAULT NULL,
  `Logistics` varchar(20) NOT NULL,
  `Agent` varchar(20) DEFAULT NULL,
  `OrderDetails` varchar(240) NOT NULL,
  `Product` varchar(50) NOT NULL,
  `Type` varchar(20) NOT NULL DEFAULT 'Product',
  `Quantity` int(3) NOT NULL,
  `Price` float NOT NULL,
  `Location` varchar(20) NOT NULL,
  `Cost` float NOT NULL,
  `SentDateTime` datetime DEFAULT current_timestamp(),
  `RunningDate` date DEFAULT current_timestamp(),
  `DateTime` datetime DEFAULT NULL,
  `RescheduledDate` date DEFAULT NULL,
  `Remark` varchar(50) DEFAULT NULL,
  `Feedback` varchar(150) DEFAULT NULL,
  `FeedbackTime` datetime DEFAULT NULL,
  `PaymentMethod` varchar(50) DEFAULT NULL,
  `EnableEdit` tinyint(1) NOT NULL DEFAULT 1,
  `Status` varchar(20) NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `Merchant`, `Affiliate`, `Logistics`, `Agent`, `OrderDetails`, `Product`, `Type`, `Quantity`, `Price`, `Location`, `Cost`, `SentDateTime`, `RunningDate`, `DateTime`, `RescheduledDate`, `Remark`, `Feedback`, `FeedbackTime`, `PaymentMethod`, `EnableEdit`, `Status`) VALUES
(6, 'mhadrill3', NULL, 'jchatell2', 'ccuardallv', 'NEW ORDER; Kaine Benedict	\r\nTYPE; 1 W34	\r\n28AOrogun/Abbi road Orogun town Delta state.	\r\n08083057846, 07039689505	\r\nN19,000\r\nHE WANTS IT ON WEDNESDAY. 29/07', 'W34', 'Product', 2, 39000, 'Abraka', 3500, '2020-07-28 22:10:03', '2020-07-28', '2020-08-03 14:02:50', NULL, NULL, 'Available', NULL, NULL, 0, 'Canceled'),
(7, 'mhadrill3', NULL, 'Rsmaridge9', 'rsmaridge9', 'Full Name:Chris\r\n\r\nMain Phone Number:08060439045\r\n\r\nAlternate Phone:08060439045\r\n\r\nFull Address:At college junction Agbor Delta State\r\n\r\nResidential Local Govt Area:Agbor\r\n\r\nResidential State:Delta', 'Vibroaction', 'Product', 3, 70000, 'Abraka', 2000, '2020-07-28 23:13:04', '2020-09-04', '2020-09-04 16:40:14', '2020-08-22', 'Reposted from Sun August 30th 2020', 'Available', NULL, 'Cash', 0, 'Delivered'),
(9, 'mhadrill3', 'fjoseph7', 'jchatell2', NULL, 'Friday ebo	          \r\n\r\nPolice clinic, by b division police barracks, asaba. Delta state	\r\n\r\n08094563218', 'Spin Scrubber', 'Product', 1, 10000, 'Asaba', 3500, '2020-07-29 07:23:46', '2020-08-07', '2020-08-07 14:01:31', NULL, 'Reposted from Wed August 5th 2020', 'Switched off', NULL, NULL, 0, 'Canceled'),
(11, 'mhadrill3', NULL, 'jchatell2', 'jchatell2', 'Benjamin Hammond\r\nAddress\r\n201 P.T.I road,opposite sunny Eru Motors\r\nState\r\nDelta state\r\nPhone Number\r\n+2348101814516', 'W34', 'Product', 4, 84000, 'Warri', 1750, '2020-07-29 15:59:31', '2020-08-14', '2020-08-14 11:04:31', '2020-08-12', 'Reposted from Wed August 12th 2020', 'Available', NULL, 'GTB', 0, 'Delivered'),
(12, 'mhadrill3', NULL, 'jchatell2', NULL, 'Ogba Vigho\r\n\r\nEnter Your Phone Number\r\n\r\n08033987654\r\n\r\nAlternative Phone Number\r\n\r\n08022902621\r\n\r\nEnter Your Full Address (Street, City, Lga, State)\r\n\r\nBracelet Plaza, Km 3 Osubi express road, Osubi, Okpe LGA, Delta state', 'W34', 'Product', 1, 21000, 'Warri', 1750, '2020-07-29 16:08:16', '2020-08-14', '2020-08-14 11:03:46', '2020-08-07', 'Reposted from Wed August 12th 2020', 'Not Compatible', NULL, NULL, 0, 'Canceled'),
(13, 'mhadrill3', NULL, 'jchatell2', NULL, 'Chukwujekwu nonso\r\nPhone Numbers\r\n08121911123\r\nAlternate Phone Numbers\r\n08063000000\r\nEmail\r\nNnnnnnnn@gmail.com\r\nDelivery address\r\n5 iyah street Bendel estate warri', 'Black Panther', 'Product', 1, 250000, 'Warri', 1750, '2020-07-29 16:30:32', '2020-07-29', '2020-08-03 13:49:14', NULL, NULL, 'He\'s Busy', NULL, NULL, 0, 'Canceled'),
(16, 'mhadrill3', NULL, 'jchatell2', 'jchatell2', 'Name\r\nOgidiagba Ufuoma Benson\r\n\r\nPhone Numbers\r\n08033378695\r\n\r\nDelivery Address...\r\n\r\nN01Okuisoko road off Jakpa road effurun uvwe/warri.', 'W34', 'Product', 1, 21000, 'Abraka', 3500, '2020-07-29 18:56:34', '2020-08-14', '2020-08-14 11:04:21', '2020-08-05', 'Reposted from Wed August 12th 2020', 'Available by 12noon', NULL, 'FB', 0, 'Delivered'),
(17, 'mhadrill3', 'fjoseph7', 'jchatell2', NULL, 'Full Name : Sam Odibo\r\nPhone : 08023222821\r\nState : Delta State\r\nHome Address : Odibo Housing Estates, Effurun', 'Black Panther', 'Product', 2, 475000, 'Ekpoma', 3500, '2020-07-29 20:56:31', '2020-08-04', '2020-08-04 20:06:59', '2020-08-03', 'Reposted from Mon August 3rd 2020', NULL, NULL, NULL, 0, 'Canceled'),
(18, 'mhadrill3', 'fjoseph7', 'jchatell2', NULL, 'Name: okotete Douglas\r\n\r\nAddress: 75 ugbeyiyi Rd sapele\r\n\r\nPhone: 07081816482', 'Gyneo Gel', 'Product', 3, 29000, 'Auchi', 3000, '2020-07-29 21:01:21', '2020-08-04', '2020-08-04 20:07:49', NULL, 'Reposted from Mon August 3rd 2020', 'Not compatible', NULL, NULL, 0, 'Canceled'),
(19, 'mhadrill3', 'fjoseph7', 'jchatell2', 'jchatell2', 'NEW ORDER: \r\nprecious isifo	\r\nTYPE: 1 robot	\r\n12 Omosevie Street, Benin City, Edo State, Nigeria\r\n07012345678', 'Spin Scrubber', 'Product', 1, 10000, 'Benin', 6000, '2020-08-01 22:29:15', '2020-08-18', '2020-08-18 16:04:46', '2020-08-06', 'Rescheduled from Thu August 6th 2020', 'Available ', NULL, 'Delivered Transfer Paycom', 0, 'Delivered'),
(20, 'mhadrill3', NULL, 'jchatell2', 'jchatell2', 'Full Name\r\nOghenovo osiobe\r\nWhatsapp Number\r\n08174146374\r\nSecond Phone Number\r\n08148766074\r\nStreet Address\r\nNew layout,Jakpa road,Warri,delta state\r\nLocal Government\r\nUvwie\r\nState\r\nDelta state\r\nEmail\r\nSimplyus1980@gmail.com', 'Black Panther', 'Product', 2, 475000, 'Benin', 6000, '2020-08-02 12:14:08', '2020-08-18', '2020-08-18 16:04:27', '2020-08-06', 'Rescheduled from Thu August 6th 2020', 'Available by 5pm', NULL, 'Transfer ZB', 0, 'Delivered'),
(21, 'mhadrill3', NULL, 'jchatell2', NULL, 'NEW ORDER: \r\nprecious isifo	\r\nTYPE: 1 robot	\r\n12 Omosevie Street, Benin City, Edo State, Nigeria\r\n07087267736,', 'Black Panther', 'Product', 1, 250000, 'Benin', 6000, '2020-08-02 12:18:01', '2020-08-02', '2020-08-03 13:49:23', NULL, NULL, NULL, NULL, NULL, 0, 'Canceled'),
(22, 'mhadrill3', NULL, 'jchatell2', 'jchatell2', 'Name\r\nBlessing Lawson\r\nPHONE NUMBER\r\n08022535123\r\nALTERNATIVE PHONE NUMBER\r\n09083892171\r\nFULL DELIVERY ADDRESS/ STATE\r\nEdo State 2 Railto close eyaen Benin city', 'Spin Scrubber', 'Product', 1, 10000, 'Benin', 6000, '2020-08-02 12:19:43', '2020-08-02', '2020-08-02 13:36:41', NULL, NULL, NULL, NULL, 'Cash', 0, 'Delivered'),
(23, 'mhadrill3', NULL, 'jchatell2', NULL, 'Romeo D W\r\n08138836767\r\nOlori estate', 'Black Panther', 'Product', 1, 250000, 'Ughelli', 2000, '2020-08-02 21:20:12', '2020-08-07', '2020-08-07 13:54:16', '2020-08-05', 'Reposted from Wed August 5th 2020', NULL, NULL, NULL, 0, 'Canceled'),
(24, 'mhadrill3', NULL, 'jchatell2', 'jchatell2', 'Full Name\r\nOghenovo osiobe\r\nWhatsapp Number\r\n08156565656\r\nSecond Phone Number\r\nStreet Address\r\nNew layout,Jakpa road,Warri,delta state\r\nLocal Government\r\nUvwie\r\nState\r\nDelta state', 'W34', 'Product', 1, 21000, 'Warri', 1750, '2020-08-02 21:22:01', '2020-08-07', '2020-08-07 13:53:51', NULL, 'Reposted from Wed August 5th 2020', NULL, NULL, 'Cash', 0, 'Delivered'),
(25, 'mhadrill3', NULL, 'jchatell2', 'jchatell2', 'Name: Ovie\r\nPhone Number: 08165266847\r\nAddress: Somewhere in Wakanda', 'Black Panther', 'Product', 2, 475000, 'Warri', 1750, '2020-08-03 14:21:54', '2020-08-07', '2020-08-07 13:44:29', NULL, 'Reposted from Wed August 5th 2020', NULL, NULL, 'GTB', 0, 'Delivered'),
(26, 'mhadrill3', NULL, 'jchatell2', 'jchatell2', 'Iffie Great\r\nN0 6 Osamudiamen Street', 'W34', 'Product', 2, 39000, 'Ekpoma', 3500, '2020-08-04 19:46:23', '2020-08-07', '2020-08-07 13:44:20', NULL, 'Reposted from Wed August 5th 2020', NULL, NULL, 'Zb', 0, 'Delivered'),
(27, 'mhadrill3', NULL, 'jchatell2', 'ccuardallv', 'NEW ORDER; ALFRED ODION UYINOSA	\r\nTYPE; 1 Robot	\r\nUNIVERSITY OF BENIN, BENIN CITY, EDO STATE	\r\n07067013210, 		\r\nN14,900\r\nHE WANTS IT TOMORROW SIR.', 'Black Panther', 'Product', 1, 250000, 'Benin', 6000, '2020-08-04 20:16:31', '2020-08-04', '2020-08-04 20:17:45', NULL, NULL, 'He\'s number was busy', NULL, 'ZB', 0, 'Delivered'),
(28, 'mhadrill3', NULL, 'jchatell2', 'jchatell2', '*Monday Delivery before 4PM:*\r\nMrs Blessing Leleji\r\nOgiame hospital at Ubeji former Ubeji health Center warri south LGA Warri\r\n08057345678', 'Spin Scrubber', 'Product', 1, 10000, 'Warri', 1750, '2020-08-10 10:11:30', '2020-08-14', '2020-08-14 11:04:12', NULL, 'Reposted from Wed August 12th 2020', 'Available', NULL, 'Cash', 0, 'Delivered'),
(29, 'mhadrill3', NULL, 'jchatell2', 'jchatell2', 'John\r\n90XXXXXXXX\r\ndelta state\r\nW.t\r\n\r\nReady to receive', 'Spin Scrubber', 'Product', 2, 20000, 'Ughelli', 2000, '2020-08-14 11:23:58', '2020-08-21', '2020-08-21 07:43:25', '2020-08-21', 'Rescheduled from Fri August 21st 2020', 'Traveled', NULL, NULL, 0, 'Canceled'),
(30, 'mhadrill3', NULL, 'jchatell2', 'jchatell2', 'Believe Oriakhi\r\n80XXXXXXXX\r\nBilly grand motel. \r\nBenin Auchi b/c\r\nUhunmwode\r\nEdo', 'Vibroaction', 'Product', 4, 100000, 'Benin', 6000, '2020-08-14 12:09:26', '2020-08-20', '2020-08-20 09:10:48', '2020-08-20', 'Rescheduled from Thu August 20th 2020', 'Available', NULL, 'Transfer FB', 0, 'Delivered'),
(31, 'mhadrill3', NULL, 'jchatell2', NULL, 'Ebiana Anita\r\nOtovwodo shopping plaza opposite Delta line ughelli, Delta state Nigeria.\r\n090XXXXXXXX', 'W34', 'Product', 1, 21000, 'Ughelli', 2000, '2020-08-14 12:16:43', '2020-08-17', '2020-08-17 15:52:14', NULL, 'Reposted from Sun August 16th 2020', 'Doesn\'t want again', NULL, NULL, 0, 'Canceled'),
(32, 'mhadrill3', NULL, 'jchatell2', 'jchatell2', 'ovie\r\n08165266847\r\nsomewhere in wakanda', 'Black Panther', 'Product', 1, 250000, 'Abraka', 3500, '2020-08-14 12:17:23', '2020-08-18', '2020-08-18 15:20:38', NULL, 'Reposted from Mon August 17th 2020', 'Available', NULL, NULL, 0, 'Canceled'),
(33, 'mhadrill3', NULL, 'jchatell2', 'jchatell2', 'aaaa', 'W34', 'Product', 1, 21000, 'Ekpoma', 3500, '2020-08-14 12:19:13', '2020-08-19', '2020-08-19 08:30:15', '2020-08-19', 'Rescheduled from Wed August 19th 2020', 'Available', NULL, 'Transfer ZB', 0, 'Delivered'),
(34, 'mhadrill3', NULL, 'jchatell2', 'jchatell2', 'Name: Ovie\r\nAddress: somewhere in wakanda\r\nNumber: 08165266847', 'W34', 'Product', 3, 63000, 'Auchi', 3000, '2020-08-16 15:12:58', '2020-08-19', '2020-08-19 08:30:07', '2020-08-19', 'Rescheduled from Wed August 19th 2020', 'Available', NULL, 'Cash', 0, 'Delivered'),
(35, 'mhadrill3', NULL, 'jchatell2', 'jchatell2', 'Jane Doe\r\nCentral city\r\n08165266847', 'Vibroaction', 'Product', 2, 47000, 'Ughelli', 2000, '2020-08-16 15:26:32', '2020-08-18', '2020-08-18 15:18:54', NULL, 'Reposted from Mon August 17th 2020', 'Available', NULL, 'Cash', 0, 'Delivered'),
(36, 'mhadrill3', NULL, 'jchatell2', 'jchatell2', 'nnnnn', 'Gyneo Gel', 'Product', 1, 15000, 'Auchi', 3000, '2020-08-16 15:27:53', '2020-08-17', '2020-08-17 15:52:58', NULL, 'Reposted from Sun August 16th 2020', 'Available', NULL, 'Cash', 0, 'Delivered'),
(37, 'mhadrill3', NULL, 'jchatell2', NULL, 'Bbbbbbbb', 'Spin Scrubber', 'Product', 6, 60000, 'Warri', 1750, '2020-08-16 15:29:43', '2020-08-18', '2020-08-18 15:18:28', '2020-08-18', 'Rescheduled from Tue August 18th 2020', 'Available', NULL, NULL, 0, 'Canceled'),
(38, 'mhadrill3', NULL, 'jchatell2', NULL, 'nnnnnnnnnnn', 'Gyneo Gel', 'Product', 1, 15000, 'Auchi', 3000, '2020-08-18 23:00:37', '2020-08-18', '2020-08-18 23:16:55', NULL, 'Reposted from Tue August 18th 2020', NULL, NULL, NULL, 0, 'Canceled'),
(39, 'mhadrill3', NULL, 'jchatell2', NULL, 'iffie ovie\r\nsomewhere in Nigeria', 'Spin Scrubber', 'Product', 1, 10000, 'Benin', 6000, '2020-08-18 23:16:14', '2020-08-19', '2020-08-19 08:29:19', '2020-08-19', 'Rescheduled from Wed August 19th 2020', 'Travelled', NULL, NULL, 0, 'Canceled'),
(40, 'mhadrill3', NULL, 'jchatell2', 'jchatell2', 'iffie great\r\ncentral city', 'Vibroaction', 'Product', 1, 25000, 'Auchi', 3000, '2020-08-18 23:17:38', '2020-08-18', '2020-08-18 23:29:01', NULL, 'Reposted from Tue August 18th 2020', 'Available', NULL, 'Cash', 0, 'Delivered'),
(41, 'mhadrill3', NULL, 'jchatell2', 'jchatell2', 'Ovie\r\nWakanda', 'Vibroaction', 'Product', 3, 70000, 'Ekpoma', 3500, '2020-08-19 08:34:07', '2020-08-19', '2020-08-19 08:37:27', NULL, NULL, 'Available by 1pm', NULL, 'Delivered', 0, 'Delivered'),
(42, 'mhadrill3', NULL, 'jchatell2', 'jchatell2', 'Praise\r\n80XXXXXXXX\r\n80XXXXXXXX\r\nNo 13 street\r\nUvwie\r\nDelta', 'Richard Mille', 'Product', 1, 24000, 'Warri', 1750, '2020-08-19 09:40:48', '2020-08-20', '2020-08-20 09:10:35', NULL, 'Reposted from Wed August 19th 2020', 'Available', NULL, 'Transfer GTB', 0, 'Delivered'),
(44, 'mhadrill3', NULL, 'jchatell2', 'jchatell2', 'Name: Aronokhale Eshioramhe Daudu\r\n\r\nPhone Number:\r\n08037555887\r\nAlternative Phone Number:\r\n08026849061\r\n\r\nFull Address, Include nearest Landmark\r\nBUA cement PLC Okpella\r\n\r\nLocal Government/City:\r\nEtsako East\r\n\r\nState:\r\nEdo', 'Richard Mille', 'Product', 1, 24000, 'Benin', 6000, '2020-08-20 07:37:06', '2020-08-20', '2020-08-20 09:10:24', NULL, NULL, 'Available', NULL, 'Cash', 0, 'Delivered'),
(45, 'mhadrill3', NULL, 'jchatell2', NULL, 'Name.\r\nOchei\r\n\r\nPhone Number(s)\r\n080XXXXXXXX\r\n\r\nFull Delivery Address.\r\n\r\nNo XX ogwash uku road umunede delta state\r\n\r\nOne 4in1 Vacuum Cleaner/Tire Pump Plus one night driving glass and one car engine cleaner liquid.', 'Spin Scrubber', 'Product', 2, 20000, 'Ekpoma', 3500, '2020-08-20 08:26:52', '2020-08-20', '2020-08-20 09:08:06', NULL, NULL, 'Doesn\'t have money anymore', NULL, NULL, 0, 'Canceled'),
(46, 'mhadrill3', NULL, 'jchatell2', 'jchatell2', 'Ovie\r\nSomewhere in Nigeria', 'Richard Mille', 'Product', 1, 24000, 'Auchi', 3000, '2020-08-20 09:18:54', '2020-08-20', '2020-08-20 09:19:35', NULL, NULL, 'Doesn\'t want anymore', NULL, NULL, 0, 'Canceled'),
(48, 'mhadrill3', NULL, 'jchatell2', 'jchatell2', 'Young\r\n\r\n08137XXXXXX\r\n\r\nWarri Airport Road', 'Richard Mille', 'Product', 1, 24000, 'Warri', 1750, '2020-08-21 07:23:50', '2020-08-21', '2020-08-21 07:43:01', NULL, NULL, 'Available by 2pm', NULL, 'Zb', 0, 'Delivered'),
(49, 'mhadrill3', NULL, 'jchatell2', 'jchatell2', 'NAME\r\nGeorge  kolo\r\nPHONE NUMBER?\r\n08034702581\r\nSTATE\r\nEdo \r\nLOCAL GOVT\r\nOredo \r\nDELIVERY ADDRESS?\r\n74 mission road Benin\r\nSELECT YOUR OPTIONS\r\nOption #2  four hair oils  FREE = N18,500\r\n\r\nNetking', 'Richard Mille', 'Product', 2, 48000, 'Benin', 6000, '2020-08-21 07:40:29', '2020-08-21', '2020-08-21 07:42:25', NULL, NULL, 'Available', NULL, 'Cash', 0, 'Delivered'),
(50, 'mhadrill3', NULL, 'jchatell2', 'jchatell2', 'NEW ORDER; Atamako ovie	\r\nWellington hotel effurun warri	\r\n0813389XXXX, 07013XXXXXX', 'Richard Mille', 'Product', 2, 48000, 'Warri', 1750, '2020-08-22 17:18:10', '2020-08-22', '2020-08-22 17:35:27', NULL, NULL, 'Available', NULL, 'Cash', 0, 'Delivered'),
(51, 'mhadrill3', NULL, 'jchatell2', 'ebultera', 'Name: Henry Odigie\r\nPhone no: 08063111466\r\nWhatapp No: 08063111466\r\nAddress: 171 Nnebisi road Asaba\r\nLocal Gov.: Oshimili South\r\nState: Delta State', 'W34', 'Product', 1, 21000, 'Asaba', 3500, '2020-08-22 18:49:39', '2020-08-27', '2020-08-27 23:07:09', NULL, 'Reposted from Wed August 26th 2020', 'Travelled ', NULL, NULL, 0, 'Canceled'),
(52, 'mhadrill3', NULL, 'jchatell2', 'jchatell2', 'Okpako jeremiah\r\n\r\nAmukpe sapele delta state\r\n0903 599 3237\r\nToday', 'Vibroaction', 'Product', 2, 47000, 'Sapele', 3000, '2020-08-27 22:00:45', '2020-08-29', '2020-08-29 17:14:03', '2020-08-29', 'Rescheduled from Sat August 29th 2020', 'Available', NULL, 'Transfer ZB', 0, 'Delivered'),
(53, 'mhadrill3', NULL, 'jchatell2', 'ebultera', 'Name: Anthony Joshua\r\nAddress: 5 stretford park sapele', 'Vibroaction', 'Product', 2, 47000, 'Sapele', 3000, '2020-08-27 22:04:08', '2020-08-27', '2020-08-27 23:08:50', NULL, NULL, 'Available ', NULL, 'Access', 0, 'Delivered'),
(54, 'mhadrill3', NULL, 'jchatell2', 'jchatell2', 'Ovie\r\nPTI junction warri', 'Richard Mille', 'Product', 2, 48000, 'Sapele', 3000, '2020-08-27 22:05:49', '2020-08-30', '2020-08-30 12:02:45', '2020-08-29', 'Reposted from Sat August 29th 2020', 'Doesn\'t want anymore', NULL, NULL, 0, 'Canceled'),
(55, 'mhadrill3', NULL, 'jchatell2', 'ebultera', 'Ovie\r\nEffurun Roundabout  warri', 'W34', 'Product', 2, 39000, 'Warri', 1750, '2020-08-27 22:49:28', '2020-08-27', '2020-08-27 23:08:40', NULL, NULL, 'Available ', NULL, 'Transfer ZB', 0, 'Delivered'),
(56, 'mhadrill3', NULL, 'jchatell2', 'ebultera', 'Full Name\r\n 	Godwin Obahor\r\nPhone Number\r\n 	08037257240\r\nDelivery Address\r\n 	No 7 Eben Street off Akpakpava\r\nNearest Bus Stop\r\n 	Big Joe Motor Akpakpava\r\nLocal Govt Area\r\n 	Oredo', 'Richard Mille', 'Product', 1, 24000, 'Benin', 2000, '2020-08-27 23:06:30', '2020-08-27', '2020-08-27 23:08:29', NULL, NULL, 'Available ', NULL, 'Cash', 0, 'Delivered'),
(57, 'mhadrill3', NULL, 'jchatell2', 'jchatell2', 'Emmanuel\r\n8033641069\r\n8033641069\r\nNo kosine street\r\nWarri\r\nDelta state\r\n\r\nBUY 1 HEAD SHAVER + ExtraBlade (22,000)', 'Head Shaver', 'Product', 1, 22500, 'Ekpoma', 3500, '2020-08-28 08:32:11', '2020-08-29', '2020-08-29 17:13:52', '2020-08-29', 'Rescheduled from Sat August 29th 2020', 'Available', NULL, 'Cash', 0, 'Delivered'),
(58, 'mhadrill3', NULL, 'jchatell2', 'jchatell2', 'John\r\n8033641090\r\nNo kosine street\r\nSapele\r\nDelta state\r\n\r\nBUY 1 HEAD SHAVER + ExtraBlade (22,000)', 'Head Shaver', 'Product', 2, 40000, 'Sapele', 3000, '2020-08-28 08:32:58', '2020-08-28', '2020-08-28 08:35:02', NULL, NULL, 'Available', NULL, 'Cash', 0, 'Delivered'),
(59, 'mhadrill3', NULL, 'jchatell2', 'npellamonuten1h', 'Frazier Draxford\r\n996-800-4849\r\n37 Pearson Court\r\n', 'Head Shaver', 'Product', 4, 90000, 'Abraka', 3500, '2020-08-30 09:34:27', '2020-08-30', '2020-08-30 21:27:07', NULL, NULL, 'Available', NULL, 'Cash 40k, 50k first bank', 0, 'Delivered'),
(60, 'mhadrill3', NULL, 'jchatell2', 'jchatell2', 'Dru Kroin\r\n360-959-6916\r\n50 Waxwing Trail\r\n', 'W34', 'Product', 3, 63000, 'Asaba', 3500, '2020-08-30 09:35:02', '2020-08-30', '2020-08-30 12:14:46', NULL, NULL, 'Available', NULL, 'Cash', 0, 'Delivered'),
(61, 'mhadrill3', NULL, 'jchatell2', 'jchatell2', 'Faustine Ager\r\n385-224-8096\r\n65 Loftsgordon Avenue\r\n', 'Richard Mille', 'Product', 1, 24000, 'Auchi', 3000, '2020-08-30 09:35:31', '2020-08-30', '2020-08-30 12:06:35', NULL, NULL, 'He said we can come', NULL, NULL, 0, 'Canceled'),
(62, 'mhadrill3', NULL, 'jchatell2', 'jchatell2', 'Malissia Corn\r\n872-350-3436\r\n733 Rowland Hill\r\n', 'Black Panther', 'Product', 1, 250000, 'Benin', 2000, '2020-08-30 09:36:32', '2020-09-01', '2020-09-01 17:10:30', '2020-08-31', 'Reposted from Mon August 31st 2020', 'Available', NULL, 'Paycom', 0, 'Delivered'),
(63, 'mhadrill3', NULL, 'jchatell2', 'npellamonuten1h', 'Alasteir McKew \r\n986-803-6817 29 \r\nBashford Parkway\r\n', 'Vibroaction', 'Product', 1, 25000, 'Ekpoma', 3500, '2020-08-30 09:36:57', '2020-08-30', '2020-08-30 21:27:19', NULL, NULL, 'Available ', NULL, 'GTBank ', 0, 'Delivered'),
(64, 'mhadrill3', NULL, 'jchatell2', 'jchatell2', 'Tanny Iacopo \r\n455-723-2839 069 \r\nManufacturers Parkway\r\n', 'Spin Scrubber', 'Product', 1, 10000, 'Sapele', 3000, '2020-08-30 09:38:55', '2020-09-04', '2020-09-04 15:43:16', '2020-09-03', 'Reposted from Thu September 3rd 2020', 'Available', NULL, 'Cash', 0, 'Delivered'),
(65, 'mhadrill3', NULL, 'jchatell2', 'jchatell2', 'Debi Quarlis \r\n394-177-1948\r\n15 Golden Leaf Point\r\n', 'Gyneo Gel', 'Product', 2, 17500, 'Ughelli', 2000, '2020-08-30 09:39:31', '2020-08-30', '2020-08-30 12:06:58', NULL, NULL, NULL, NULL, NULL, 0, 'Canceled'),
(66, 'mhadrill3', NULL, 'jchatell2', 'jchatell2', 'Beryl Tizzard \r\n819-522-3386 \r\n6 Hanover Hill\r\n', 'Richard Mille', 'Product', 4, 96000, 'Warri', 1750, '2020-08-30 09:40:30', '2020-08-30', '2020-08-30 12:14:40', NULL, NULL, 'Available ', NULL, 'GTB', 0, 'Delivered'),
(67, 'cmourgeb', NULL, 'jchatell2', 'jchatell2', 'Emmy Omar \r\n365-145-1720 \r\n9089 Miller Way\r\n', 'Vibroaction', 'Product', 3, 75000, 'Warri', 1750, '2020-08-30 09:45:20', '2020-08-30', '2020-08-30 12:14:28', NULL, NULL, 'Available ', NULL, 'Zenitg', 1, 'Delivered'),
(68, 'cmourgeb', NULL, 'jchatell2', 'jchatell2', 'Fanni Claibourn \r\n495-643-2114 16246\r\nLotheville Circle\r\n', 'Vibroaction', 'Product', 3, 75000, 'Abraka', 3500, '2020-08-30 09:46:05', '2020-08-30', '2020-08-30 12:14:22', NULL, NULL, 'Available ', NULL, 'Cash', 1, 'Delivered'),
(69, 'cmourgeb', NULL, 'jchatell2', 'jchatell2', 'Agosto Ilbert \r\n930-529-4928 6269\r\nThompson Crossing\r\n', 'Vibroaction', 'Product', 1, 25000, 'Asaba', 3500, '2020-08-30 09:46:27', '2020-08-30', '2020-08-30 12:14:16', NULL, NULL, 'Available', NULL, 'Cash', 1, 'Delivered'),
(70, 'cmourgeb', NULL, 'jchatell2', 'jchatell2', 'Elfrida Drews\r\n763-524-3191 105\r\nPaget Point\r\n', 'Vibroaction', 'Product', 1, 25000, 'Auchi', 3000, '2020-08-30 09:46:55', '2020-08-30', '2020-08-30 12:14:12', NULL, NULL, 'Available', NULL, 'Paycom', 1, 'Delivered'),
(71, 'cmourgeb', NULL, 'jchatell2', 'jchatell2', 'Torrie Mounce \r\n352-780-3793 \r\n7 Melody Way\r\n', 'Vibroaction', 'Product', 1, 25000, 'Benin', 2000, '2020-08-30 09:47:13', '2020-09-02', '2020-09-02 12:16:51', '2020-09-01', 'Reposted from Tue September 1st 2020', 'Available', NULL, 'Cash', 1, 'Delivered'),
(72, 'cmourgeb', NULL, 'jchatell2', 'jchatell2', 'Hersch Manns \r\n976-279-1180 \r\n1 Springview Terrace\r\n', 'Vibroaction', 'Product', 1, 25000, 'Ekpoma', 3500, '2020-08-30 09:47:43', '2020-08-30', '2020-08-30 12:14:03', NULL, NULL, 'Available', NULL, 'Cash', 1, 'Delivered'),
(73, 'cmourgeb', NULL, 'jchatell2', 'jchatell2', 'Sasha Muzzullo \r\n956-849-5023 \r\n85 Menomonie Trail\r\n', 'Vibroaction', 'Product', 2, 48000, 'Ekpoma', 3500, '2020-08-30 09:48:11', '2020-08-30', '2020-08-30 12:09:45', NULL, NULL, 'Not interested', NULL, NULL, 1, 'Canceled'),
(74, 'cmourgeb', NULL, 'jchatell2', 'npellamonuten1h', 'Kimmy Rivel \r\n463-605-1965 \r\n29 Maple Wood Parkway \r\n', 'Vibroaction', 'Product', 1, 25000, 'Sapele', 3000, '2020-08-30 09:48:40', '2020-08-30', '2020-08-30 21:27:25', NULL, NULL, 'Available by 3pm', NULL, 'Cash', 1, 'Delivered'),
(75, 'cmourgeb', NULL, 'jchatell2', 'jchatell2', 'Gale Darington \r\n505-886-4871 99 \r\nGreen Ridge Drive\r\n', 'Vibroaction', 'Product', 1, 25000, 'Ughelli', 2000, '2020-08-30 09:49:29', '2020-08-30', '2020-08-30 12:13:58', NULL, NULL, 'Available', NULL, 'Cash', 1, 'Delivered'),
(76, 'cmourgeb', NULL, 'jchatell2', 'jchatell2', 'Dominique Greenhead \r\n701-302-0327 \r\n9 Marcy Circle\r\n', 'Vibroaction', 'Product', 1, 25000, 'Warri', 1750, '2020-08-30 09:50:02', '2020-08-30', '2020-08-30 12:13:52', NULL, NULL, 'Available', NULL, 'TRANSFER FIRST BANK', 1, 'Delivered'),
(77, 'sdreini6', NULL, 'jchatell2', 'jchatell2', 'Vonni Rowsell \r\n707-898-8920 \r\n6 Drewry Way\r\n', '3D WALL CLOCK', 'Product', 1, 17000, 'Warri', 2000, '2020-08-30 10:47:04', '2020-09-02', '2020-09-02 12:16:47', '2020-08-31', 'Reposted from Tue September 1st 2020', 'Available', NULL, 'Cash', 0, 'Delivered'),
(78, 'sdreini6', NULL, 'jchatell2', 'jchatell2', 'Aviva Cavil \r\n848-470-0149 \r\n8 Chive Plaza\r\n', '3D WALL CLOCK', 'Product', 4, 68000, 'Warri', 2000, '2020-08-30 10:47:38', '2020-09-02', '2020-09-02 12:16:14', '2020-08-31', 'Reposted from Tue September 1st 2020', NULL, NULL, NULL, 0, 'Canceled'),
(79, 'sdreini6', NULL, 'jchatell2', 'jchatell2', 'Christie Sumnall \r\n383-628-8578 \r\n7288 Raven Way\r\n', '3D WALL CLOCK', 'Product', 1, 17000, 'Benin', 3000, '2020-08-30 10:48:02', '2020-08-30', '2020-08-30 12:13:38', NULL, NULL, 'Available', NULL, 'Cash', 0, 'Delivered'),
(80, 'sdreini6', NULL, 'jchatell2', 'npellamonuten1h', 'Bill Sharnock \r\n756-100-4805 \r\n1035 High Crossing Alley\r\n', '3D WALL CLOCK', 'Product', 2, 34000, 'Benin', 3000, '2020-08-30 10:48:26', '2020-08-30', '2020-08-30 21:26:35', NULL, NULL, 'Available ', NULL, 'Casg', 0, 'Delivered'),
(81, 'sdreini6', NULL, 'jchatell2', 'jchatell2', 'Annora Cresar \r\n714-245-5972 \r\n7 Shoshone Avenue\r\n', '3D WALL CLOCK', 'Product', 2, 34000, 'Sapele', 3000, '2020-08-30 10:48:49', '2020-09-01', '2020-09-01 18:42:13', '2020-08-31', 'Reposted from Mon August 31st 2020', 'Available', NULL, 'Cash', 0, 'Delivered'),
(82, 'sdreini6', NULL, 'jchatell2', 'npellamonuten1h', 'Kathie Kilford \r\n292-493-2383 \r\n23 Petterle Place \r\n', '3D WALL CLOCK', 'Product', 1, 17000, 'Ughelli', 2500, '2020-08-30 10:49:09', '2020-08-30', '2020-08-30 21:26:28', NULL, NULL, 'Available ', NULL, 'GTBank', 0, 'Delivered'),
(83, 'sdreini6', NULL, 'jchatell2', 'jchatell2', 'Lindsay Geffe \r\n848-806-5848 \r\n953 Bowman Trail\r\n', '3D WALL CLOCK', 'Product', 1, 17000, 'Ekpoma', 3500, '2020-08-30 10:50:41', '2020-08-30', '2020-08-30 12:05:30', NULL, NULL, NULL, NULL, NULL, 0, 'Canceled'),
(84, 'sdreini6', NULL, 'jchatell2', 'npellamonuten1h', 'Brittaney Been \r\n690-557-0180 \r\n2 Miller Pass\r\n', '3D WALL CLOCK', 'Product', 2, 34000, 'Abraka', 3000, '2020-08-30 10:51:05', '2020-08-30', '2020-08-30 21:26:20', NULL, NULL, 'Available', NULL, 'Paycom', 0, 'Delivered'),
(85, 'sdreini6', NULL, 'jchatell2', 'jchatell2', 'April Headford \r\n264-952-2304 \r\n499 Farragut Center\r\n', '3D WALL CLOCK', 'Product', 3, 51000, 'Asaba', 3000, '2020-08-30 10:51:27', '2020-09-02', '2020-09-02 12:16:43', '2020-09-02', 'Rescheduled from Wed September 2nd 2020', 'Available', NULL, 'Cash', 0, 'Delivered'),
(86, 'cgildroy8', NULL, 'jchatell2', 'npellamonuten1h', 'Claude Bakhrushkin \r\n877-442-3934 \r\n8242 Morning Junction\r\n', '3D Wall Clock', 'Product', 1, 18000, 'Warri', 2000, '2020-08-30 10:59:26', '2020-08-30', '2020-08-30 21:26:11', NULL, NULL, 'Available', NULL, 'Paycom', 0, 'Delivered'),
(87, 'cgildroy8', NULL, 'jchatell2', 'npellamonuten1h', 'Deny McCamish \r\n619-599-2936 \r\n589 Shoshone Trail\r\n', '3D Wall Clock', 'Product', 1, 18000, 'Warri', 2000, '2020-08-30 10:59:51', '2020-08-30', '2020-08-30 21:26:05', NULL, NULL, 'Available', NULL, 'Cash', 0, 'Delivered'),
(88, 'mhadrill3', NULL, 'jchatell2', 'jchatell2', 'aaa', 'Black Panther', 'Product', 1, 250000, 'Warri', 2000, '2020-09-02 16:12:57', '2020-09-05', '2020-09-05 22:58:09', '2020-09-05', 'Rescheduled from Sat September 5th 2020', 'Available', NULL, 'Cash', 0, 'Delivered'),
(89, 'mhadrill3', NULL, 'jchatell2', 'npellamonuten1h', 'Lilyan Garfitt\r\n610-662-3098\r\nBanding Alley 3', 'W34', 'Product', 2, 39000, 'Auchi', 4000, '2020-09-02 19:26:56', '2020-09-02', '2020-09-02 23:09:32', NULL, NULL, 'Available', NULL, 'Zenith Bank', 0, 'Delivered'),
(91, 'mhadrill3', NULL, 'jchatell2', 'npellamonuten1h', 'Thelka Rumble\r\n760-572-2615\r\n65 Ridgeview Junction', 'Richard Mille', 'Product', 4, 90000, 'Auchi', 4000, '2020-09-02 19:29:21', '2020-09-02', '2020-09-02 23:09:18', NULL, NULL, 'Available', NULL, 'Cash', 0, 'Delivered'),
(93, 'mhadrill3', NULL, 'Rsmaridge9', 'rsmaridge9', 'Codee Adamski \r\n649-317-0551 271 \r\nWestridge Road\r\n', 'Vibroaction', 'Product', 2, 47000, 'Abraka', 2000, '2020-09-04 16:42:33', '2020-09-04', '2020-09-04 16:50:27', NULL, NULL, 'Available', NULL, 'FBN', 0, 'Delivered'),
(94, 'mhadrill3', NULL, 'Rsmaridge9', NULL, 'Dionisio Gosford \r\n684-354-5418 9464 \r\nComanche Junction\r\n', 'Gyneo Gel', 'Product', 1, 15000, 'Abraka', 2000, '2020-09-04 16:42:55', '2020-09-04', NULL, '2020-09-05', NULL, NULL, NULL, NULL, 0, 'Rescheduled'),
(95, 'mhadrill3', NULL, 'Rsmaridge9', NULL, 'Riobard Smallacombe \r\n408-328-0340 21267 \r\nNancy Trail\r\n', 'Gyneo Gel', 'Product', 1, 15000, 'Abraka', 2000, '2020-09-04 16:43:14', '2020-09-04', NULL, NULL, NULL, 'Available', NULL, NULL, 0, 'Pending'),
(96, 'mhadrill3', NULL, 'Rsmaridge9', 'rsmaridge9', 'Erminie Woodworth \r\n407-844-4802 \r\n4912 Northfield Street \r\n', 'W34', 'Product', 1, 21000, 'Abraka', 2000, '2020-09-04 16:43:43', '2020-09-04', '2020-09-04 16:49:55', NULL, NULL, 'Travelled', NULL, NULL, 0, 'Canceled'),
(97, 'mhadrill3', NULL, 'Rsmaridge9', NULL, 'Clemmie Kybert \r\n527-780-9940 \r\n02584 Mayfield Junction \r\n', 'W34', 'Product', 3, 63000, 'Abraka', 2000, '2020-09-04 16:44:11', '2020-09-04', NULL, NULL, NULL, 'Available', NULL, NULL, 0, 'Pending'),
(98, 'mhadrill3', NULL, 'Rsmaridge9', 'rsmaridge9', 'Cobb Caven \r\n677-347-8630 \r\n996 Leroy Hill \r\n', 'Baby Groot ', 'Product', 2, 5000, 'Abraka', 2000, '2020-09-04 16:44:36', '2020-09-04', '2020-09-04 16:50:17', NULL, NULL, NULL, NULL, 'Cash', 0, 'Delivered'),
(99, 'mhadrill3', NULL, 'Rsmaridge9', NULL, 'Garwood Bleything \r\n118-291-0921 \r\n6 Dottie Trail\r\n', 'CCTV camera', 'Product', 1, 5000, 'Abraka', 2000, '2020-09-04 16:44:53', '2020-09-04', NULL, NULL, NULL, 'Available', NULL, NULL, 0, 'Pending'),
(100, 'mhadrill3', NULL, 'Rsmaridge9', 'rsmaridge9', 'Wallace Mosconi \r\n875-263-2031 \r\n5022 Hauk Point\r\n', 'CCTV camera', 'Product', 4, 20000, 'Abraka', 2000, '2020-09-04 16:45:13', '2020-09-04', '2020-09-04 16:50:22', NULL, NULL, 'Available', NULL, 'ZB', 0, 'Delivered'),
(101, 'mhadrill3', NULL, 'jchatell2', 'jchatell2', 'Ovie\r\nPTI junction', 'Vibroaction', 'Product', 2, 47000, 'Ughelli', 2500, '2020-09-05 22:59:15', '2020-09-08', '2020-09-08 16:36:09', '2020-09-07', 'Rescheduled from Mon September 7th 2020', 'Available', NULL, 'Cash', 0, 'Delivered'),
(102, 'mhadrill3', NULL, 'Rsmaridge9', NULL, 'Ondrea Matoshin \r\n918-278-1420 \r\n5437 Glendale Crossing\r\n', 'CCTV camera', 'Product', 1, 5000, 'Abraka', 2000, '2020-09-09 11:26:30', '2020-09-09', NULL, NULL, NULL, NULL, NULL, NULL, 0, 'Pending'),
(103, 'mhadrill3', NULL, 'jchatell2', 'jchatell2', 'Gae Gatenby \r\n968-351-0232 \r\n12 4th Way\r\n', 'Panoramic Camera', 'Product', 1, 22500, 'Abraka', 3000, '2020-09-09 11:26:55', '2020-09-09', '2020-09-09 11:49:07', NULL, NULL, 'Available', NULL, 'Cash', 0, 'Delivered'),
(104, 'mhadrill3', NULL, 'jchatell2', 'jchatell2', 'Melva Spincke \r\n355-731-7891 \r\n2488 Oakridge Way\r\n', 'Panoramic Camera', 'Product', 2, 48000, 'Abraka', 3000, '2020-09-09 11:27:15', '2020-09-09', '2020-09-09 11:48:38', NULL, NULL, 'Available', NULL, 'ZB', 0, 'Delivered'),
(105, 'mhadrill3', NULL, 'jchatell2', 'ebultera', 'Caria Dumberrill \r\n477-771-8559 \r\n7 Debs Way ', 'W34', 'Product', 3, 63000, 'Warri', 2000, '2020-09-09 11:28:04', '2020-09-09', '2020-09-09 11:36:27', NULL, NULL, 'No money', NULL, NULL, 0, 'Canceled'),
(106, 'mhadrill3', NULL, 'jchatell2', 'ebultera', 'Nikolos Spataro \r\n621-396-5968 \r\n07 Ohio Plaza \r\n', 'Vibroaction', 'Product', 1, 25000, 'Sapele', 3000, '2020-09-09 11:28:30', '2020-09-09', '2020-09-09 11:36:13', NULL, NULL, NULL, NULL, NULL, 0, 'Canceled'),
(107, 'mhadrill3', NULL, 'jchatell2', 'jchatell2', 'Lenora Ding \r\n284-800-1250 \r\n737 Nevada Trail\r\n', 'Vibroaction', 'Product', 1, 25000, 'Sapele', 3000, '2020-09-09 11:28:56', '2020-09-15', '2020-09-15 06:36:35', '2020-09-10', 'Reposted from Sat September 12th 2020', 'Available', NULL, 'Cash', 0, 'Delivered'),
(108, 'mhadrill3', NULL, 'jchatell2', 'jchatell2', 'Ninetta Sandle \r\n376-318-1042 \r\n92128 Southridge Way \r\n', 'Richard Mille', 'Product', 2, 48000, 'Sapele', 3000, '2020-09-09 11:29:23', '2020-09-09', '2020-09-09 11:48:32', NULL, NULL, 'Available', NULL, 'ZB', 0, 'Delivered'),
(109, 'sdreini6', NULL, 'jchatell2', 'jchatell2', 'Vivie Jacomb \r\n105-310-3677\r\n64539 Elgar Terrace \r\n', '3D WALL CLOCK', 'Product', 2, 34000, 'Sapele', 3000, '2020-09-09 11:30:20', '2020-09-09', '2020-09-09 11:48:25', NULL, NULL, 'Available', NULL, 'ZB', 0, 'Delivered'),
(110, 'sdreini6', NULL, 'jchatell2', 'ebultera', 'Marius Jeram \r\n633-921-0059 \r\n6604 Glacier Hill Plaza\r\n', '3D WALL CLOCK', 'Product', 2, 34000, 'Ekpoma', 3500, '2020-09-09 11:30:48', '2020-09-09', '2020-09-09 11:42:47', NULL, NULL, 'Available', NULL, 'ZB', 0, 'Delivered'),
(111, 'sdreini6', NULL, 'jchatell2', 'ebultera', 'Dody Connichie \r\n680-442-1624 \r\n981 Mayfield Road\r\n', '3D WALL CLOCK', 'Product', 1, 17000, 'Auchi', 4000, '2020-09-09 11:31:15', '2020-09-09', '2020-09-09 11:41:55', NULL, NULL, 'Available', NULL, 'Cash', 0, 'Delivered'),
(112, 'mhadrill3', NULL, 'jchatell2', 'jchatell2', 'Niki Chimenti \r\n970-613-1518 \r\n7940 Veith Trail\r\n', 'Wiper Kit', 'Group', 1, 28000, 'Sapele', 3000, '2020-09-14 12:45:30', '2020-09-20', '2020-09-20 09:28:25', '2020-09-19', 'Rescheduled from Sat September 19th 2020', 'Available', '2020-09-20 09:27:30', 'Cash', 0, 'Delivered'),
(113, 'mhadrill3', NULL, 'jchatell2', 'jchatell2', 'Neil Trubshawe \r\n415-561-0087 \r\n909 Clarendon Road\r\n', 'Prototype', 'Group', 1, 50000, 'Sapele', 3000, '2020-09-14 12:52:54', '2020-09-15', '2020-09-15 06:33:39', NULL, 'Reposted from Mon September 14th 2020', 'Available', NULL, 'Cash', 0, 'Delivered'),
(114, 'mhadrill3', NULL, 'jchatell2', 'jchatell2', 'Reeva Lilie \r\n768-675-7881 \r\n542 Oakridge Street\r\n', 'Gyneo Gel', 'Product', 3, 29000, 'Sapele', 3000, '2020-09-15 06:37:58', '2020-09-15', '2020-09-15 16:43:03', NULL, NULL, '❌ this customer is not serious, he\'s been avoiding my calls and SMS since I told him I\'m in Sapele to deliver his kids notebook laptop', '2020-09-15 09:35:47', 'Access', 0, 'Delivered'),
(115, 'mhadrill3', NULL, 'jchatell2', 'jchatell2', 'Anetta Davidesco \r\n228-207-2922 \r\n7004 Ramsey Street\r\n', 'Vibroaction', 'Product', 1, 25000, 'Warri', 2000, '2020-09-15 14:59:41', '2020-09-15', '2020-09-15 15:03:18', NULL, NULL, 'Available', '2020-09-15 15:00:57', 'Cash', 0, 'Delivered'),
(116, 'mhadrill3', NULL, 'jchatell2', 'jchatell2', 'Bridget Cammock \r\n771-812-7272 \r\n1 Elmside Road\r\n', 'Vibroaction', 'Product', 1, 25000, 'Warri', 2000, '2020-09-15 15:03:57', '2020-09-15', '2020-09-15 18:48:12', NULL, NULL, 'Available', '2020-09-15 15:04:07', 'Access', 0, 'Delivered'),
(117, 'mhadrill3', NULL, 'jchatell2', 'jchatell2', 'Angie Blindt \r\n935-928-4772 \r\n4267 Graceland Pass\r\n', 'Vibroaction', 'Product', 2, 47000, 'Auchi', 4000, '2020-09-15 15:06:15', '2020-09-15', '2020-09-15 16:42:50', NULL, NULL, 'Available', '2020-09-15 15:06:27', 'ZB', 0, 'Delivered'),
(118, 'mhadrill3', NULL, 'jchatell2', 'jchatell2', 'Bart Sammars \r\n966-954-7346 \r\n28 Schurz Pass\r\n', 'Vibroaction', 'Product', 2, 47000, 'Ekpoma', 3500, '2020-09-15 15:13:53', '2020-09-15', '2020-09-15 16:42:46', NULL, NULL, 'Available', '2020-09-15 15:14:08', 'ZB', 0, 'Delivered'),
(119, 'mhadrill3', NULL, 'jchatell2', 'jchatell2', 'Debbi Dumbelton \r\n202-871-7021 \r\n0 Manufacturers Hill\r\n', 'Prototype', 'Group', 1, 50000, 'Ekpoma', 3500, '2020-09-15 16:39:48', '2020-09-15', '2020-09-15 18:53:05', NULL, NULL, 'Available', '2020-09-15 16:40:12', 'Cash', 0, 'Delivered'),
(120, 'mhadrill3', NULL, 'jchatell2', 'npellamonuten1h', 'Ovie\r\n08165266847\r\nJakpa Road', 'Richard Mille', 'Product', 1, 24000, 'Warri', 2000, '2020-09-15 18:10:10', '2020-09-15', '2020-09-15 18:18:52', NULL, NULL, 'Available', '2020-09-15 18:12:07', 'Cash', 0, 'Delivered'),
(121, 'mhadrill3', NULL, 'jchatell2', 'jchatell2', 'Great\r\n07030839278\r\nEffurun/Sapele Road', 'Spin Scrubber', 'Product', 1, 10000, 'Sapele', 3000, '2020-09-15 18:11:06', '2020-09-18', '2020-09-18 20:32:28', NULL, 'Reposted from Thu September 17th 2020', 'Available', '2020-09-18 20:23:36', 'FBN', 0, 'Delivered'),
(122, 'mhadrill3', NULL, 'jchatell2', 'jchatell2', 'Otto Skin \r\n240-835-3984 \r\n5 Almo Place\r\n', 'Panoramic Camera', 'Product', 4, 90000, 'Ekpoma', 3500, '2020-09-15 18:41:32', '2020-09-15', '2020-09-15 18:41:58', NULL, NULL, 'Available', '2020-09-15 18:41:50', 'ZB', 0, 'Delivered'),
(123, 'mhadrill3', NULL, 'jchatell2', 'jchatell2', 'Marten McGeever \r\n446-703-7291 \r\n60432 Marcy Drive \r\n', 'Prototype', 'Group', 1, 50000, 'Ekpoma', 3500, '2020-09-15 18:58:48', '2020-09-15', '2020-09-15 19:03:37', NULL, NULL, 'He\'s available', '2020-09-15 18:59:02', 'Cash', 0, 'Delivered'),
(126, 'mhadrill3', NULL, 'jchatell2', 'jchatell2', 'Lorenzo Loxdale \r\n160-814-4993 \r\n12710 Dorton Parkway \r\n', 'Head Shaver', 'Product', 3, 67500, 'Abraka', 3000, '2020-09-16 14:03:08', '2020-09-18', '2020-09-18 20:32:34', NULL, 'Reposted from Thu September 17th 2020', 'Available', '2020-09-18 20:23:30', 'Zb', 0, 'Delivered'),
(127, 'mhadrill3', NULL, 'jchatell2', 'jchatell2', 'Quinlan Bentz \r\n822-251-9971 \r\n90609 Karstens Parkway\r\n', 'W34', 'Product', 1, 21000, 'Benin', 3000, '2020-09-16 14:06:21', '2020-09-20', '2020-09-20 09:28:19', NULL, 'Reposted from Fri September 18th 2020', 'Available', '2020-09-20 09:27:22', 'ZB', 0, 'Delivered'),
(129, 'mhadrill3', NULL, 'jchatell2', 'jchatell2', 'Ellie Postance \r\n927-571-4860 \r\n0577 Warner Junction\r\n', 'Head Shaver', 'Product', 3, 67500, 'Warri', 2000, '2020-09-16 15:23:11', '2020-09-18', '2020-09-18 20:32:24', NULL, 'Reposted from Thu September 17th 2020', 'Available', '2020-09-18 20:23:20', 'ZB', 0, 'Delivered'),
(130, 'mhadrill3', NULL, 'jchatell2', 'jchatell2', 'Ellie Postance \r\n927-571-4860 \r\n0577 Warner Junction\r\n', 'W34', 'Product', 1, 21000, 'Sapele', 3000, '2020-09-16 15:24:36', '2020-09-18', '2020-09-18 20:32:49', NULL, 'Reposted from Thu September 17th 2020', 'Available', '2020-09-18 20:23:14', 'Cash', 0, 'Delivered'),
(131, 'mhadrill3', NULL, 'jchatell2', 'jchatell2', 'Delta\r\n\r\nName: Awariefe David\r\n\r\nAddress; ataverhe street extension back of celestial church ekiugbo-ughelli delta\r\n\r\nPhone: 08037896482\r\n\r\nProduct: USB voice recorder\r\n\r\nPrice: N12,000\r\n\r\nQuantity: 1pcs\r\n\r\nDelivery day: wednesday (15/7/202', 'Gyneo Gel', 'Product', 1, 15000, 'Ekpoma', 3500, '2020-09-16 15:26:36', '2020-09-18', '2020-09-18 20:23:09', NULL, 'Reposted from Thu September 17th 2020', NULL, NULL, NULL, 0, 'Canceled'),
(132, 'mhadrill3', NULL, 'jchatell2', 'jchatell2', 'Avigdor Marushak \r\n975-383-2043 \r\n877 Comanche Drive\r\n', 'Spin Scrubber', 'Product', 1, 10000, 'Ughelli', 2500, '2020-09-16 15:35:00', '2020-09-16', '2020-09-16 15:55:52', NULL, NULL, NULL, NULL, NULL, 0, 'Canceled'),
(133, 'mhadrill3', NULL, 'jchatell2', 'jchatell2', 'Avigdor Marushak \r\n975-383-2043 \r\n877 Comanche Drive \r\n', 'Spin Scrubber', 'Product', 1, 10000, 'Ughelli', 2500, '2020-09-16 15:35:22', '2020-09-18', '2020-09-18 20:35:40', NULL, 'Reposted from Thu September 17th 2020', 'Available', '2020-09-18 20:23:03', 'Cash', 0, 'Delivered'),
(134, 'mhadrill3', NULL, 'jchatell2', 'jchatell2', 'Gallagher Sircomb \r\n145-760-7349 \r\n472 Judy Pass\r\n', 'Gyneo Gel', 'Product', 2, 17500, 'Benin', 3000, '2020-09-16 15:55:58', '2020-11-13', '2020-11-13 06:21:34', '2020-09-25', 'Reposted from Thu November 12th 2020', 'Available', '2020-11-13 06:21:16', NULL, 0, 'Canceled'),
(135, 'mhadrill3', NULL, 'jchatell2', 'jchatell2', 'Mason Kelshaw \r\n803-228-3322 \r\n703 Gale Place\r\n', 'Head Shaver', 'Product', 3, 67500, 'Benin', 3000, '2020-09-16 15:57:10', '2020-09-18', '2020-09-18 20:22:51', NULL, 'Reposted from Thu September 17th 2020', 'Travelled', '2020-09-18 20:22:49', NULL, 0, 'Canceled'),
(139, 'mhadrill3', NULL, 'jchatell2', 'jchatell2', 'Delcine Sloy \r\n143-611-8809 \r\n77 John Wall Lane\r\n', 'Smart watch', 'Product', 2, 30000, 'Ekpoma', 3500, '2020-09-18 20:20:56', '2020-09-18', '2020-09-18 20:35:24', NULL, NULL, 'Available', '2020-09-18 20:22:42', 'Cash', 0, 'Delivered'),
(140, 'mhadrill3', NULL, 'jchatell2', 'jchatell2', 'Nert Bassett \r\n967-821-0830 \r\n88 Barby Trail \r\n', 'Smart watch', 'Product', 1, 15000, 'Ughelli', 2500, '2020-09-18 20:28:51', '2020-09-18', '2020-09-18 20:31:01', NULL, NULL, 'Available', '2020-09-18 20:29:28', 'Cash', 0, 'Delivered'),
(141, 'mhadrill3', NULL, 'jchatell2', 'jchatell2', 'Doralynn Astell \r\n394-990-7534 \r\n014 Springview Lane \r\n', 'W34', 'Product', 4, 84000, 'Warri', 2000, '2020-09-18 22:54:47', '2020-09-18', '2020-09-18 22:55:13', NULL, NULL, 'Available', '2020-09-18 22:54:57', 'Cash', 0, 'Delivered'),
(142, 'sdreini6', NULL, 'jchatell2', 'jchatell2', 'Lucille Romao \r\n638-924-1429 \r\n6 Arapahoe Point \r\n', 'Kids Educational Tablet', 'Product', 2, 62000, 'Warri', 2000, '2020-09-20 08:50:38', '2020-09-20', '2020-09-20 09:27:18', NULL, NULL, 'Doesn\'t have money anymore', '2020-09-20 09:27:15', NULL, 0, 'Canceled'),
(143, 'sdreini6', NULL, 'jchatell2', 'jchatell2', 'Petr Harriagn \r\n275-698-4807 \r\n7 Kropf Court \r\n', 'Kids Educational Tablet', 'Product', 3, 93000, 'Asaba', 3000, '2020-09-20 09:01:18', '2020-09-20', '2020-09-20 09:26:59', NULL, NULL, 'Travelled', '2020-09-20 09:26:56', NULL, 0, 'Canceled'),
(144, 'sdreini6', NULL, 'jchatell2', 'jchatell2', 'Frants Braniff \r\n457-295-8984 \r\n12974 Montana Drive \r\n', '3D WALL CLOCK', 'Product', 1, 17000, 'Auchi', 4000, '2020-09-20 09:07:50', '2020-09-20', '2020-09-20 09:28:14', NULL, NULL, 'Available', '2020-09-20 09:26:49', 'ZB', 0, 'Delivered'),
(145, 'sdreini6', NULL, 'jchatell2', 'jchatell2', 'Jackqueline Ronci \r\n695-448-4484 \r\n79201 Corscot Junction\r\n', '3D WALL CLOCK', 'Product', 1, 17000, 'Auchi', 4000, '2020-09-20 09:08:22', '2020-09-20', '2020-09-20 09:28:10', NULL, NULL, 'Available', '2020-09-20 09:26:42', 'Cash', 0, 'Delivered'),
(146, 'sdreini6', NULL, 'jchatell2', 'jchatell2', 'Izabel Relfe \r\n890-580-1188 \r\n839 Arizona Place \r\n', 'Kids Educational Tablet', 'Product', 2, 62000, 'Benin', 3000, '2020-09-20 09:08:45', '2020-09-20', '2020-09-20 09:28:05', NULL, NULL, 'Available', '2020-09-20 09:26:38', 'Access', 0, 'Delivered'),
(147, 'sdreini6', NULL, 'jchatell2', 'jchatell2', 'Durand Buer \r\n318-344-4210 \r\n82 Sunnyside Alley\r\n', 'Kids Educational Tablet', 'Product', 2, 62000, 'Benin', 3000, '2020-09-20 09:09:15', '2020-09-20', '2020-09-20 09:28:00', NULL, NULL, 'Available', '2020-09-20 09:26:34', 'ZB', 0, 'Delivered'),
(148, 'sdreini6', NULL, 'jchatell2', 'jchatell2', 'Vite Ellingworth \r\n487-891-3635 \r\n088 Del Mar Drive \r\n', 'Kids Educational Tablet', 'Product', 1, 31000, 'Ughelli', 2500, '2020-09-20 09:25:47', '2020-11-14', '2020-11-14 16:15:32', '2020-09-22', 'Reposted from Fri November 13th 2020', 'Travelled', '2020-11-14 16:15:27', NULL, 0, 'Canceled'),
(149, 'sdreini6', NULL, 'jchatell2', 'jchatell2', 'Diahann Collington \r\n352-535-2586 \r\n83579 Mayer Center \r\n', 'Kids Educational Tablet', 'Product', 3, 93000, 'Ughelli', 2500, '2020-09-20 09:26:12', '2020-09-20', '2020-09-20 09:27:55', NULL, NULL, 'Available', '2020-09-20 09:26:23', 'Cash', 0, 'Delivered'),
(150, 'mhadrill3', NULL, 'jchatell2', 'ebultera', 'New Order\r\nThis order was sent on Saturday 19th September, 2020.\r\nFullname: Misan Egbejule\r\nPhone Number: 08147181846\r\nAlternate Phone Number: 08143446489\r\nAddress: 8 oki lane okere roard warri\r\nState: Delta state\r\nLGA: Warri south\r\nAdditio', 'Smart watch', 'Product', 2, 30000, 'Warri', 2000, '2020-09-20 14:33:17', '2020-09-20', '2020-09-20 14:34:59', NULL, NULL, 'Available', '2020-09-20 14:34:17', 'Cash', 0, 'Delivered'),
(151, 'mhadrill3', NULL, 'jchatell2', 'jchatell2', 'Ovie\r\nPTI road', 'Richard Mille', 'Product', 2, 48000, 'Warri', 2000, '2020-09-20 14:33:54', '2020-09-20', '2020-09-20 14:35:29', NULL, NULL, 'Available', '2020-09-20 14:34:29', 'Zenith', 0, 'Delivered'),
(152, 'sdreini6', NULL, 'jchatell2', 'jchatell2', 'Sabine Richold \r\n483-846-3635 \r\n1968 Briar Crest Place \r\n', 'Kids Educational Tablet', 'Product', 1, 31000, 'Ughelli', 2500, '2020-09-20 21:20:37', '2020-09-21', '2020-09-21 16:19:35', NULL, 'Reposted from Sun September 20th 2020', 'Available', '2020-09-21 15:13:29', 'ZB', 0, 'Delivered'),
(153, 'sdreini6', NULL, 'jchatell2', 'jchatell2', 'Hans Zima \r\n333-465-1916 \r\n8931 Hanover Way \r\n', 'Kids Educational Tablet', 'Product', 1, 31000, 'Ughelli', 2500, '2020-09-20 21:38:13', '2020-09-21', '2020-09-21 16:19:29', NULL, 'Reposted from Sun September 20th 2020', 'Available', '2020-09-21 15:13:34', 'Cash', 0, 'Delivered'),
(154, 'sdreini6', NULL, 'jchatell2', 'jchatell2', 'Hynda Sherrard \r\n769-652-0643 \r\n4 Reinke Parkway \r\n', 'Kids Educational Tablet', 'Product', 1, 31000, 'Sapele', 3000, '2020-09-21 13:50:43', '2020-09-22', '2020-09-22 11:08:35', '2020-09-22', 'Rescheduled from Tue September 22nd 2020', 'Available', '2020-09-22 11:08:19', 'Cash', 0, 'Delivered'),
(155, 'sdreini6', NULL, 'jchatell2', 'jchatell2', 'Regina Bilverstone \r\n110-205-6142 \r\n063 American Ash Junction \r\n', 'Kids Educational Tablet', 'Product', 4, 124000, 'Abraka', 3000, '2020-09-21 13:51:17', '2020-09-21', '2020-09-21 16:18:22', NULL, NULL, 'Available', '2020-09-21 15:13:49', 'Cash', 0, 'Delivered'),
(156, 'sdreini6', NULL, 'jchatell2', 'jchatell2', 'Koo Eckels \r\n185-592-5634 \r\n628 Arapahoe Parkway\r\n', 'Kids Educational Tablet', 'Product', 1, 31000, 'Abraka', 3000, '2020-09-21 13:51:55', '2020-09-21', '2020-09-21 16:17:20', NULL, NULL, 'Available', '2020-09-21 15:13:59', 'ZB', 0, 'Delivered'),
(157, 'sdreini6', NULL, 'jchatell2', 'jchatell2', 'Denis Liepmann \r\n259-623-2689 \r\n35 Lindbergh Plaza \r\n', '3D WALL CLOCK', 'Product', 1, 17000, 'Benin', 3000, '2020-09-21 13:52:53', '2020-09-21', '2020-09-21 15:14:13', NULL, NULL, NULL, NULL, NULL, 0, 'Canceled'),
(158, 'cgildroy8', NULL, 'jchatell2', 'jchatell2', 'Lucas O\' Molan \r\n546-611-1441 \r\n4574 Haas Hill \r\n', '3D Wall Clock', 'Product', 2, 36000, 'Auchi', 4000, '2020-09-21 13:58:49', '2020-09-21', '2020-09-21 16:17:13', NULL, NULL, 'Available', '2020-09-21 15:14:22', 'Cash', 0, 'Delivered'),
(159, 'cgildroy8', NULL, 'jchatell2', 'jchatell2', 'Tallou Agus \r\n957-862-0867 \r\n788 Sauthoff Alley \r\n', '3D Wall Clock', 'Product', 1, 18000, 'Abraka', 3000, '2020-09-21 13:59:10', '2020-09-21', '2020-09-21 16:15:24', NULL, NULL, 'Available', '2020-09-21 16:13:30', 'Cash', 0, 'Delivered'),
(160, 'cgildroy8', NULL, 'jchatell2', 'jchatell2', 'Petronille Aizikov \r\n332-434-8540 \r\n988 Golden Leaf Street ', '3D Wall Clock', 'Product', 1, 18000, 'Asaba', 3000, '2020-09-21 13:59:28', '2020-11-14', '2020-11-14 16:15:05', '2020-09-23', 'Reposted from Fri November 13th 2020', 'Available', '2020-11-14 16:14:17', NULL, 0, 'Canceled'),
(161, 'cgildroy8', NULL, 'jchatell2', 'jchatell2', 'Mark Burdoun \r\n878-678-2189 \r\n129 Old Gate Point \r\n', '3D Wall Clock', 'Product', 2, 36000, 'Auchi', 4000, '2020-09-21 13:59:56', '2020-09-21', '2020-09-21 16:15:18', NULL, NULL, 'Available', '2020-09-21 16:13:40', 'Cash', 0, 'Delivered'),
(162, 'cgildroy8', NULL, 'jchatell2', 'jchatell2', 'Neill Hanhart \r\n699-188-8583 \r\n80308 Sutherland Way \r\n', '3D Wall Clock', 'Product', 2, 36000, 'Benin', 3000, '2020-09-21 14:00:18', '2020-09-21', '2020-09-21 16:13:45', NULL, NULL, NULL, NULL, NULL, 0, 'Canceled'),
(163, 'cgildroy8', NULL, 'jchatell2', 'jchatell2', 'Brande Foro \r\n989-835-0565 \r\n743 Shelley Avenue \r\n', '3D Wall Clock', 'Product', 2, 36000, 'Ekpoma', 3500, '2020-09-21 14:00:37', '2020-09-21', '2020-09-21 16:15:11', NULL, NULL, 'Available', '2020-09-21 16:13:51', 'ZB', 0, 'Delivered'),
(164, 'cgildroy8', NULL, 'jchatell2', 'jchatell2', 'Kendal Tranckle \r\n857-395-1369 \r\n13113 Maryland Street \r\n', '3D Wall Clock', 'Product', 1, 18000, 'Sapele', 3000, '2020-09-21 14:00:56', '2020-09-21', '2020-09-21 16:15:05', NULL, NULL, 'Available', '2020-09-21 16:13:56', 'ZB', 0, 'Delivered'),
(165, 'cgildroy8', NULL, 'jchatell2', 'jchatell2', 'Millisent Olech \r\n286-985-4311 \r\n78 Charing Cross Alley \r\n', '3D Wall Clock', 'Product', 2, 36000, 'Ughelli', 2500, '2020-09-21 14:01:16', '2020-09-21', '2020-09-21 16:14:57', NULL, NULL, 'Available', '2020-09-21 16:14:01', 'Cash', 0, 'Delivered'),
(166, 'cgildroy8', NULL, 'jchatell2', 'jchatell2', 'Brice Pattini \r\n863-928-8545\r\n359 Superior Parkway \r\n', '3D Wall Clock', 'Product', 3, 54000, 'Ughelli', 2500, '2020-09-21 14:01:46', '2020-09-21', '2020-09-21 16:14:52', NULL, NULL, 'Available', '2020-09-21 16:14:06', 'Cash', 0, 'Delivered'),
(167, 'mhadrill3', NULL, 'jchatell2', 'jchatell2', 'Stern Bezzant \r\n367-120-6102 \r\n4 Nova Junction \r\n', 'Spin Scrubber', 'Product', 1, 10000, 'Ughelli', 2500, '2020-09-22 11:22:21', '2020-11-13', '2020-11-13 06:22:43', '2020-09-23', 'Reposted from Thu November 12th 2020', 'Available', '2020-11-13 06:20:16', 'ZB', 0, 'Delivered'),
(168, 'mhadrill3', NULL, 'jchatell2', 'jchatell2', 'Constancy Fleischmann \r\n339-509-7721 \r\n6 Burrows Junction \r\n', 'Spin Scrubber', 'Product', 1, 10000, 'Ughelli', 2500, '2020-09-22 11:22:43', '2020-09-22', '2020-09-22 11:43:26', NULL, NULL, 'Available', '2020-09-22 11:36:11', 'Cash', 0, 'Delivered'),
(169, 'mhadrill3', NULL, 'jchatell2', 'jchatell2', 'Erasmus Whittet \r\n199-829-7927 \r\n5 Granby Junction \r\n', 'Spin Scrubber', 'Product', 1, 10000, 'Ughelli', 2500, '2020-09-22 11:22:57', '2020-09-22', '2020-09-22 11:43:22', NULL, NULL, 'Available', '2020-09-22 11:36:15', 'ZB', 0, 'Delivered'),
(170, 'mhadrill3', NULL, 'jchatell2', 'jchatell2', 'Thadeus Colquit \r\n771-808-7024 \r\n908 Quincy Parkway \r\n', 'Spin Scrubber', 'Product', 1, 10000, 'Warri', 2000, '2020-09-22 11:23:15', '2020-09-22', '2020-09-22 11:43:18', NULL, NULL, 'Available', '2020-09-22 11:36:19', 'ZB', 0, 'Delivered'),
(171, 'mhadrill3', NULL, 'jchatell2', 'jchatell2', 'Der Petrollo \r\n400-916-0834 \r\n1254 Texas Way \r\n', 'Spin Scrubber', 'Product', 2, 20000, 'Warri', 2000, '2020-09-22 11:23:33', '2020-09-22', '2020-09-22 11:43:14', NULL, NULL, 'Available', '2020-09-22 11:36:23', 'ZB', 0, 'Delivered'),
(172, 'mhadrill3', NULL, 'jchatell2', 'jchatell2', 'Derk Braine \r\n652-165-7417 \r\n18 Heffernan Park \r\n', 'Spin Scrubber', 'Product', 2, 20000, 'Warri', 2000, '2020-09-22 11:23:53', '2020-09-22', '2020-09-22 11:43:10', NULL, NULL, 'Available', '2020-09-22 11:36:28', 'ZB', 0, 'Delivered'),
(173, 'mhadrill3', NULL, 'jchatell2', 'jchatell2', 'Xerxes Vanyashkin \r\n182-892-9100 \r\n5600 Crest Line Parkway \r\n', 'Spin Scrubber', 'Product', 1, 10000, 'Warri', 2000, '2020-09-22 11:24:09', '2020-09-22', '2020-09-22 11:43:06', NULL, NULL, 'Available', '2020-09-22 11:36:33', 'Cash', 0, 'Delivered'),
(174, 'mhadrill3', NULL, 'jchatell2', 'jchatell2', 'Gianna Chaffyn \r\n873-269-6676 \r\n94 Ruskin Pass \r\n', 'Spin Scrubber', 'Product', 4, 40000, 'Abraka', 3000, '2020-09-22 11:24:27', '2020-09-22', '2020-09-22 11:43:02', NULL, NULL, 'Available', '2020-09-22 11:36:37', 'ZB', 0, 'Delivered'),
(175, 'mhadrill3', NULL, 'jchatell2', 'jchatell2', 'Annadiana Yerill \r\n561-878-0944 \r\n381 Merchant Lane \r\n', 'Spin Scrubber', 'Product', 2, 20000, 'Asaba', 3000, '2020-09-22 11:24:44', '2020-09-22', '2020-09-22 11:42:57', NULL, NULL, 'Available', '2020-09-22 11:36:42', 'ZB', 0, 'Delivered'),
(176, 'mhadrill3', NULL, 'jchatell2', 'jchatell2', 'Lou Rodolf \r\n828-199-6363 \r\n3730 Grim Road \r\n', 'Spin Scrubber', 'Product', 2, 20000, 'Auchi', 4000, '2020-09-22 11:25:05', '2020-11-13', '2020-11-13 06:22:37', '2020-11-13', 'Rescheduled from Fri November 13th 2020', 'Available', '2020-11-13 06:20:00', 'Cash', 0, 'Delivered'),
(177, 'mhadrill3', NULL, 'jchatell2', 'jchatell2', 'Phillipe Wellstead \r\n991-699-8734 \r\n7469 Burrows Trail \r\n', 'Spin Scrubber', 'Product', 1, 10000, 'Auchi', 4000, '2020-09-22 11:25:27', '2020-09-22', '2020-09-22 11:42:52', NULL, NULL, 'Available', '2020-09-22 11:36:55', 'ZB', 0, 'Delivered');
INSERT INTO `orders` (`id`, `Merchant`, `Affiliate`, `Logistics`, `Agent`, `OrderDetails`, `Product`, `Type`, `Quantity`, `Price`, `Location`, `Cost`, `SentDateTime`, `RunningDate`, `DateTime`, `RescheduledDate`, `Remark`, `Feedback`, `FeedbackTime`, `PaymentMethod`, `EnableEdit`, `Status`) VALUES
(178, 'mhadrill3', NULL, 'jchatell2', 'jchatell2', 'Garold Biggadike \r\n234-695-4901 \r\n7895 Tennyson Point \r\n', 'Spin Scrubber', 'Product', 2, 20000, 'Auchi', 4000, '2020-09-22 11:25:43', '2020-11-12', '2020-11-12 15:59:48', NULL, 'Reposted from Tue September 22nd 2020', 'Available', '2020-11-12 15:56:50', 'Cash', 0, 'Delivered'),
(179, 'mhadrill3', NULL, 'jchatell2', 'jchatell2', 'Thedrick Grevatt \r\n743-613-3696 \r\n0 Acker Street\r\n', 'Spin Scrubber', 'Product', 2, 20000, 'Benin', 3000, '2020-09-22 11:26:09', '2020-09-22', '2020-09-22 11:45:45', NULL, NULL, 'Available', '2020-09-22 11:37:07', 'Cash', 0, 'Delivered'),
(180, 'cgildroy8', NULL, 'jchatell2', 'jchatell2', 'Thelma Hainey` \r\n792-925-4900 \r\n3 Claremont Trail \r\n', '3D Wall Clock', 'Product', 3, 54000, 'Sapele', 3000, '2020-09-22 11:27:15', '2020-09-22', '2020-09-22 11:45:39', NULL, NULL, 'Available', '2020-09-22 11:37:13', 'ZB', 1, 'Delivered'),
(181, 'cgildroy8', NULL, 'jchatell2', 'jchatell2', 'Garret Leipelt \r\n136-409-0123\r\n9984 Laurel Avenue \r\n', '3D Wall Clock', 'Product', 2, 36000, 'Sapele', 3000, '2020-09-22 11:27:50', '2020-09-22', '2020-09-22 11:45:29', NULL, NULL, 'Available', '2020-09-22 11:37:20', 'Cash', 1, 'Delivered'),
(182, 'sdreini6', NULL, 'jchatell2', 'jchatell2', 'Gunilla Tongue \r\n492-880-4077 \r\n930 Stone Corner Trail \r\n', '3D WALL CLOCK', 'Product', 1, 17000, 'Benin', 3000, '2020-09-22 11:28:48', '2020-09-22', '2020-09-22 11:45:23', NULL, NULL, 'Available', '2020-09-22 11:37:25', 'Cash', 1, 'Delivered'),
(183, 'sdreini6', NULL, 'jchatell2', 'jchatell2', 'Evita Bapty \r\n618-376-3116 \r\n51 Johnson Junction\r\n', '3D WALL CLOCK', 'Product', 3, 51000, 'Asaba', 3000, '2020-09-22 11:29:06', '2020-11-14', '2020-11-14 16:15:01', NULL, 'Reposted from Fri November 13th 2020', 'Available', '2020-11-14 16:14:12', NULL, 1, 'Canceled'),
(184, 'sdreini6', NULL, 'jchatell2', 'jchatell2', 'Pebrook Jelf \r\n486-500-2184 \r\n47341 Harper Court \r\n', '3D WALL CLOCK', 'Product', 1, 17000, 'Ekpoma', 3500, '2020-09-22 11:29:36', '2020-09-22', '2020-09-22 11:45:05', NULL, NULL, 'Available', '2020-09-22 11:37:40', 'ZB', 1, 'Delivered'),
(185, 'sdreini6', NULL, 'jchatell2', 'jchatell2', 'Marie-ann Westoll \r\n197-861-9473 \r\n8 Debs Plaza \r\n', '3D WALL CLOCK', 'Product', 3, 51000, 'Ekpoma', 3500, '2020-09-22 11:29:58', '2020-09-22', '2020-09-22 11:42:47', NULL, NULL, 'Available', '2020-09-22 11:37:51', 'Cash', 1, 'Delivered'),
(186, 'sdreini6', NULL, 'jchatell2', 'jchatell2', 'Reeva Mithan \r\n265-446-5765 \r\n03 Sunbrook Lane \r\n', '3D WALL CLOCK', 'Product', 4, 68000, 'Ekpoma', 3500, '2020-09-22 11:30:14', '2020-09-22', '2020-09-22 11:42:42', NULL, NULL, 'Available', '2020-09-22 11:37:58', 'ZB', 1, 'Delivered'),
(187, 'sdreini6', NULL, 'jchatell2', 'jchatell2', 'Hermon MacDonagh \r\n864-634-0910 \r\n7 Miller Avenue\r\n', '3D WALL CLOCK', 'Product', 3, 51000, 'Abraka', 3000, '2020-09-22 11:30:47', '2020-09-22', '2020-09-22 11:44:57', NULL, NULL, 'Available', '2020-09-22 11:38:04', 'Cash', 1, 'Delivered'),
(188, 'sdreini6', NULL, 'jchatell2', 'jchatell2', 'Ailyn Caras \r\n702-468-6652 \r\n95439 Sunbrook Street \r\n', '3D WALL CLOCK', 'Product', 3, 51000, 'Abraka', 3000, '2020-09-22 11:31:07', '2020-09-22', '2020-09-22 11:44:53', NULL, NULL, 'Available', '2020-09-22 11:38:12', 'Cash', 1, 'Delivered'),
(189, 'gashburne1l', NULL, 'jchatell2', 'jchatell2', 'Johnnie Challiner \r\n129-945-6124 \r\n5 East Point \r\n', 'Slimming Shape Wear', 'Product', 3, 21000, 'Warri', 2000, '2020-09-22 11:34:27', '2020-09-22', '2020-09-22 11:42:38', NULL, NULL, 'Available', '2020-09-22 11:38:23', 'Cash', 1, 'Delivered'),
(190, 'gashburne1l', NULL, 'jchatell2', 'jchatell2', 'Uta Behan \r\n983-546-5157 \r\n75173 Maryland Court \r\n', 'Slimming Shape Wear', 'Product', 1, 7500, 'Warri', 2000, '2020-09-22 11:34:41', '2020-09-22', '2020-09-22 11:42:33', NULL, NULL, 'Available', '2020-09-22 11:38:34', 'Cash', 1, 'Delivered'),
(191, 'gashburne1l', NULL, 'jchatell2', 'jchatell2', 'Lazar Nelissen \r\n429-847-2708 \r\n5 Magdeline Trail \r\n', 'Slimming Shape Wear', 'Product', 1, 7500, 'Warri', 2000, '2020-09-22 11:34:56', '2020-09-22', '2020-09-22 11:42:28', NULL, NULL, 'Available', '2020-09-22 11:38:55', 'Zb', 1, 'Delivered'),
(192, 'gashburne1l', NULL, 'jchatell2', 'jchatell2', 'Donnamarie Norris \r\n575-998-8323 \r\n835 Loeprich Parkway \r\n', 'Slimming Shape Wear', 'Product', 1, 7500, 'Ughelli', 2500, '2020-09-22 11:35:24', '2020-09-22', '2020-09-22 11:42:23', NULL, NULL, 'Available', '2020-09-22 11:38:46', 'Cash', 1, 'Delivered'),
(193, 'mhadrill3', NULL, 'jchatell2', 'jchatell2', 'First Name\r\nYUSUF AMINU MOHAMMED\r\nPhone Number\r\n07037695859\r\nAlternative Phone Number\r\n08132012520\r\nFull Delivery Address\r\nNo 4 Evbero close by NDIC, off Ben-Oni street GRA Benin City Edo state.', 'Spin Scrubber', 'Product', 1, 10000, 'Ughelli', 2500, '2020-11-12 18:07:17', '2020-11-12', '2020-11-12 18:14:27', NULL, NULL, 'Available to receive by 3pm', '2020-11-12 18:08:40', 'Zb', 0, 'Delivered'),
(194, 'mhadrill3', NULL, 'jchatell2', 'jchatell2', 'Dani Slammy\r\n\r\nSapele Ghana \r\n08123456789', 'Gyneo Gel', 'Product', 8, 120000, 'Ekpoma', 3500, '2020-11-14 16:17:38', '2020-11-14', '2020-11-14 16:20:00', NULL, NULL, 'Available', '2020-11-14 16:18:15', 'Cash', 0, 'Delivered'),
(195, 'mhadrill3', NULL, 'jchatell2', NULL, 'Okon\r\n488459512', 'Spin Scrubber', 'Product', 2, 20000, 'Ekpoma', 3500, '2020-11-14 16:23:50', '2020-11-28', '2020-11-28 14:44:09', '2020-12-01', 'Reposted from Thu November 26th 2020', NULL, '2020-11-26 20:36:36', NULL, 0, 'Rescheduled'),
(196, 'Jayboy999', NULL, 'jchatell2', 'jchatell2', 'Hon. Okoh Friday\r\nHero', 'Saucidy sauce ', 'Product', 1, 4000, 'Agbor', 3000, '2020-11-26 20:18:52', '2020-11-28', '2020-11-28 14:44:26', NULL, 'Reposted from Thu November 26th 2020', 'Not interested anymore', '2020-11-28 14:44:22', NULL, 0, 'Canceled'),
(197, 'Jayboy999', NULL, 'jchatell2', 'jchatell2', 'Name: 	Hon okoh Friday Hero\r\nHero\r\n\r\nPhone Number	08034062187\r\n\r\nEmail	okohfridaychuks@gmail.com\r\n\r\nEnter A Valid Address	Owa ekei road opposite the governors house beside ebuowa market, Ika north east ,Agbor delta state Nigeria.', 'Saucidy sauce ', 'Product', 1, 4000, 'Agbor', 3000, '2020-11-26 20:30:21', '2020-11-28', '2020-11-28 14:44:48', NULL, 'Reposted from Thu November 26th 2020', 'Available', '2020-11-28 14:44:35', 'Cash', 0, 'Delivered'),
(198, 'Doe', NULL, 'Komitex', 'Komitex', 'Usman Banbagida\r\n230 PTI road Warri\r\n08166778899', 'Non Pedal Wonder Core ', 'Product', 1, 85000, 'Warri', 2000, '2020-11-28 13:44:24', '2020-11-28', '2020-11-28 13:57:47', NULL, NULL, 'Available', '2020-11-28 13:57:13', 'Zenith', 0, 'Delivered'),
(199, 'savvysage', NULL, 'komitex', 'Komitex', 'Name: Random Name\r\nPhone: 09012345678\r\nEmail: randomemail@randomemail.com\r\nAddress: Random Address', 'Wonder Core', 'Product', 1, 100000, 'Warri', 2000, '2020-11-28 13:50:36', '2020-11-28', '2020-11-28 13:57:35', NULL, NULL, 'Available to receive', '2020-11-28 13:51:19', 'Cash', 0, 'Delivered'),
(200, 'savvysage', NULL, 'randomlogistics', NULL, 'Name: Random Name\r\nPhone: 09012345678\r\nEmail: randomemail@randomemail.com\r\nAddress: Random Address', 'Wonder Core', 'Product', 2, 190000, 'Lagos State', 5000, '2020-11-28 13:51:02', '2020-11-28', '2020-11-28 14:12:47', '2020-11-30', NULL, NULL, NULL, NULL, 0, 'Rescheduled'),
(201, 'Doe', NULL, 'Komitex', 'Komitex', 'Mr Nelson\r\n200 Warri Sapele road\r\n08099887766', 'Non Pedal Wonder Core ', 'Product', 1, 80000, 'Warri', 2000, '2020-11-30 13:37:29', '2020-11-30', '2020-11-30 13:40:31', NULL, NULL, 'Available', '2020-11-30 13:39:54', 'Transfer ZB', 0, 'Delivered'),
(202, 'Doe', NULL, 'Komitex', 'Komitex', 'Mr Mark\r\nBonsai Asaba\r\n08099887766', 'Workout Combo', 'Group', 1, 200000, 'Asaba', 3000, '2020-11-30 13:38:20', '2020-11-30', '2020-11-30 13:40:20', NULL, NULL, 'Available', '2020-11-30 13:39:49', 'Cash', 0, 'Delivered');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `Merchant` varchar(20) NOT NULL,
  `Affiliate` varchar(20) DEFAULT NULL,
  `ProductName` varchar(50) NOT NULL,
  `Price` varchar(7) NOT NULL,
  `FirstDiscountPrice` varchar(7) DEFAULT NULL,
  `FirstDiscountQty` varchar(3) DEFAULT NULL,
  `SecondDiscountPrice` varchar(7) DEFAULT NULL,
  `SecondDiscountQty` varchar(3) DEFAULT NULL,
  `ThirdDiscountPrice` varchar(7) DEFAULT NULL,
  `ThirdDiscountQty` varchar(3) DEFAULT NULL,
  `Picture` varchar(70) DEFAULT 'icons/others/bag1.png',
  `DateTime` datetime NOT NULL DEFAULT current_timestamp(),
  `Type` varchar(20) NOT NULL DEFAULT 'Product'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `Merchant`, `Affiliate`, `ProductName`, `Price`, `FirstDiscountPrice`, `FirstDiscountQty`, `SecondDiscountPrice`, `SecondDiscountQty`, `ThirdDiscountPrice`, `ThirdDiscountQty`, `Picture`, `DateTime`, `Type`) VALUES
(5, 'mhadrill3', NULL, 'W34', '21000', '39000', '2', NULL, NULL, NULL, NULL, 'uploads/mhadrill3.w34.jpeg', '2020-09-18 23:39:24', 'Product'),
(7, 'mhadrill3', NULL, 'Spin Scrubber', '10000', NULL, NULL, NULL, NULL, NULL, NULL, 'icons/others/bag1.png', '2020-11-14 16:23:50', 'Product'),
(8, 'mhadrill3', NULL, 'Panoramic Camera', '22500', '48000', '2', NULL, NULL, NULL, NULL, 'icons/others/bag1.png', '2020-09-15 18:41:32', 'Product'),
(9, 'mhadrill3', NULL, 'CCTV camera', '5000', '9000', '2', NULL, NULL, NULL, NULL, 'uploads/jchatell2.cctv.camera.jpg', '2020-09-18 23:47:49', 'Product'),
(10, 'mhadrill3', NULL, 'Vibroaction', '25000', '47000', '2', '70000', '3', NULL, NULL, 'uploads/mhadrill3.vibroaction.jpg', '2020-09-18 06:04:19', 'Product'),
(11, 'mhadrill3', NULL, 'Gyneo Gel', '15000', '17500', '2', '29000', '3', NULL, NULL, 'uploads/mhadrill3.gyneo.gel.jpg', '2020-11-14 16:22:15', 'Product'),
(12, 'mhadrill3', NULL, 'Black Panther', '250000', '475000', '2', NULL, NULL, NULL, NULL, 'uploads/mhadrill3.black.panther.jpg', '2020-09-18 16:52:20', 'Product'),
(13, 'mhadrill3', NULL, 'Baby Groot ', '15000', NULL, NULL, NULL, NULL, NULL, NULL, 'uploads/mhadrill3.baby.groot..jpg', '2020-09-15 05:35:23', 'Product'),
(15, 'mhadrill3', NULL, 'Bleeding Edge', '50000', NULL, NULL, NULL, NULL, NULL, NULL, 'uploads/mhadrill3.bleeding.edge.jpg', '2020-07-24 10:19:56', 'Product'),
(16, 'cmourgeb', NULL, 'Vibroaction', '25000', '48000', '2', NULL, NULL, NULL, NULL, 'uploads/cmourgeb.vibroaction.png', '2020-08-30 09:50:02', 'Product'),
(17, 'cmourgeb', NULL, 'Hyper Venom', '70000', NULL, NULL, NULL, NULL, NULL, NULL, 'icons/others/bag1.png', '2020-07-25 17:07:31', 'Product'),
(18, 'mhadrill3', NULL, 'Smart watch', '15000', NULL, NULL, NULL, NULL, NULL, NULL, 'icons/others/bag1.png', '2020-09-20 14:33:15', 'Product'),
(19, 'mhadrill3', NULL, 'Richard Mille', '24000', NULL, NULL, NULL, NULL, NULL, NULL, 'uploads/mhadrill3.richard.mille.jpg', '2020-09-20 14:33:54', 'Product'),
(20, 'mhadrill3', NULL, 'Head Shaver', '22500', '40000', '2', NULL, NULL, NULL, NULL, 'uploads/mhadrill3.head.shaver.jpeg', '2020-09-18 23:26:02', 'Product'),
(21, 'sdreini6', NULL, '3D WALL CLOCK', '17000', NULL, NULL, NULL, NULL, NULL, NULL, 'uploads/sdreini6.3d.wall.clock.jpg', '2020-09-22 11:31:06', 'Product'),
(22, 'cgildroy8', NULL, '3D Wall Clock', '18000', NULL, NULL, NULL, NULL, NULL, NULL, 'uploads/cgildroy8.3d.wall.clock.jpg', '2020-09-22 11:27:50', 'Product'),
(23, 'sdreini6', NULL, 'Kids Educational Tablet', '31000', NULL, NULL, NULL, NULL, NULL, NULL, 'icons/others/bag1.png', '2020-09-21 13:51:55', 'Product'),
(24, 'mhadrill3', NULL, 'Wiper kit', '28000', NULL, NULL, NULL, NULL, NULL, NULL, 'icons/others/bag2.png', '2020-09-18 20:18:27', 'Group'),
(25, 'mhadrill3', NULL, 'Prototype', '50000', NULL, NULL, NULL, NULL, NULL, NULL, 'icons/others/bag2.png', '2020-09-15 18:58:48', 'Group'),
(27, 'mhadrill3', NULL, 'Zephyrus', '50000', NULL, NULL, NULL, NULL, NULL, NULL, 'icons/others/bag2.png', '2020-09-14 10:29:48', 'Group'),
(31, 'mhadrill3', NULL, 'Camera Kit', '57000', NULL, NULL, NULL, NULL, NULL, NULL, 'uploads/mhadrill3.camera.kit.jpg', '2020-09-16 16:45:48', 'Group'),
(32, 'gashburne1l', NULL, 'Slimming Shape Wear', '7500', '14000', '2', '21000', '3', NULL, NULL, 'icons/others/bag1.png', '2020-09-22 11:35:24', 'Product'),
(33, 'Jayboy999', NULL, 'Saucidy sauce ', '4000', '3000', '5', NULL, NULL, NULL, NULL, 'uploads/Jayboy999.saucidy.sauce..jpeg', '2020-11-26 20:30:21', 'Product'),
(34, 'mhadrill3', NULL, 'Wonder Core ', '100000', NULL, NULL, NULL, NULL, NULL, NULL, 'uploads/mhadrill3.wonder.core..jpeg', '2020-11-28 11:12:59', 'Product'),
(35, 'savvysage', NULL, 'Wonder Core', '100000', '190000', '2', NULL, NULL, NULL, NULL, 'uploads/savvysage.wonder.core.jpg', '2020-11-28 13:51:02', 'Product'),
(36, 'Doe', NULL, 'Non Pedal Wonder Core ', '85000', NULL, NULL, NULL, NULL, NULL, NULL, 'uploads/Doe.non.pedal.wonder.core..jpeg', '2020-11-30 13:37:29', 'Product'),
(37, 'Doe', NULL, 'Situp Bench', '59000', NULL, NULL, NULL, NULL, NULL, NULL, 'icons/others/bag1.png', '2020-11-30 13:30:37', 'Product'),
(38, 'Doe', NULL, 'Set of Barbell', '75000', NULL, NULL, NULL, NULL, NULL, NULL, 'uploads/Doe.set.of.barbell.png', '2020-11-30 13:31:15', 'Product'),
(39, 'Doe', NULL, 'Workout Combo', '200000', NULL, NULL, NULL, NULL, NULL, NULL, 'icons/others/bag2.png', '2020-11-30 13:38:20', 'Group');

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `id` int(11) NOT NULL,
  `Merchant` varchar(20) NOT NULL,
  `Logistics` varchar(20) NOT NULL,
  `ProductName` varchar(50) NOT NULL,
  `StockLeft` int(5) NOT NULL,
  `DateTime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`id`, `Merchant`, `Logistics`, `ProductName`, `StockLeft`, `DateTime`) VALUES
(1, 'mhadrill3', 'jchatell2', 'Gyneo Gel', 5, '2020-11-14 16:22:35'),
(4, 'mhadrill3', 'jchatell2', 'Spin Scrubber', 0, '2020-11-13 06:22:43'),
(5, 'mhadrill3', 'jchatell2', 'Black Panther', 18, '2020-09-05 22:58:09'),
(6, 'mhadrill3', 'jchatell2', 'W34', 16, '2020-09-20 09:28:25'),
(8, 'mhadrill3', 'rsmaridge9', 'CCTV camera', 14, '2020-09-04 16:50:22'),
(9, 'mhadrill3', 'rsmaridge9', 'Baby Groot ', 14, '2020-09-04 16:50:17'),
(10, 'cmourgeb', 'jchatell2', 'Vibroaction', 9, '2020-09-02 12:16:51'),
(11, 'mhadrill3', 'jchatell2', 'Vibroaction', 5, '2020-09-20 09:28:25'),
(12, 'mhadrill3', 'rsmaridge9', 'W34', 14, '2020-08-09 18:43:51'),
(13, 'mhadrill3', 'rsmaridge9', 'Gyneo Gel', 7, '2020-08-10 08:26:43'),
(14, 'mhadrill3', 'jchatell2', 'Richard Mille', 13, '2020-09-20 14:35:29'),
(15, 'mhadrill3', 'jchatell2', 'Head Shaver', 7, '2020-09-18 20:32:34'),
(16, 'sdreini6', 'jchatell2', '3D WALL CLOCK', 1, '2020-09-22 11:45:23'),
(17, 'cgildroy8', 'jchatell2', '3D Wall Clock', 0, '2020-09-22 11:45:39'),
(18, 'mhadrill3', 'rsmaridge9', 'Vibroaction', 9, '2020-09-04 16:50:28'),
(19, 'mhadrill3', 'jchatell2', 'Panoramic Camera', 5, '2020-09-15 18:41:58'),
(20, 'sdreini6', 'jchatell2', 'Kids Educational Tablet', 0, '2020-09-22 11:08:35'),
(21, 'mhadrill3', 'jchatell2', 'Smart watch', 5, '2020-09-20 14:34:59'),
(22, 'gashburne1l', 'jchatell2', 'Slimming Shape Wear', 14, '2020-09-22 11:42:38'),
(23, 'Jayboy999', 'jchatell2', 'Saucidy sauce ', 4, '2020-11-28 14:44:48'),
(24, 'Doe', 'Komitex', 'Non Pedal Wonder Core ', 7, '2020-11-30 13:40:31'),
(25, 'savvysage', 'Komitex', 'Wonder Core', 1, '2020-11-28 13:57:35'),
(26, 'savvysage', 'randomlogistics', 'Wonder Core', 5, '2020-11-28 13:46:50'),
(27, 'mhadrill3', 'jchatell2', 'Wonder Core ', 5, '2020-11-28 14:43:27'),
(28, 'Doe', 'Komitex', 'Set of Barbell', 3, '2020-11-30 13:40:19'),
(29, 'Doe', 'Komitex', 'Situp Bench', 1, '2020-11-30 13:40:20');

-- --------------------------------------------------------

--
-- Table structure for table `waybill`
--

CREATE TABLE `waybill` (
  `id` int(11) NOT NULL,
  `Merchant` varchar(20) DEFAULT NULL,
  `Affiliate` varchar(20) DEFAULT NULL,
  `Logistics` varchar(20) NOT NULL,
  `Agent` varchar(20) DEFAULT NULL,
  `ProductName` varchar(50) NOT NULL,
  `NumberSent` int(5) NOT NULL,
  `waybillDetails` varchar(50) DEFAULT NULL,
  `DateTimeSent` datetime NOT NULL DEFAULT current_timestamp(),
  `DateTimeReceived` datetime DEFAULT NULL,
  `Location` varchar(20) DEFAULT NULL,
  `Type` varchar(20) NOT NULL DEFAULT 'Waybill',
  `Status` varchar(20) NOT NULL DEFAULT 'Not Approved'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `waybill`
--

INSERT INTO `waybill` (`id`, `Merchant`, `Affiliate`, `Logistics`, `Agent`, `ProductName`, `NumberSent`, `waybillDetails`, `DateTimeSent`, `DateTimeReceived`, `Location`, `Type`, `Status`) VALUES
(1, 'mhadrill3', NULL, 'jchatell2', NULL, 'Spin Scrubber', 6, NULL, '2020-07-19 15:51:15', '2020-09-18 16:55:23', NULL, 'Waybill', 'Approved'),
(2, 'mhadrill3', NULL, 'Rsmaridge9', NULL, 'Baby Groot ', 9, NULL, '2020-07-19 15:52:07', '2020-07-24 21:19:46', NULL, 'Waybill', 'Approved'),
(3, 'mhadrill3', NULL, 'jchatell2', NULL, 'Black Panther', 17, NULL, '2020-07-19 15:55:56', '2020-07-31 08:50:04', NULL, 'Waybill', 'Approved'),
(5, 'mhadrill3', NULL, 'Rsmaridge9', NULL, 'CCTV camera', 18, NULL, '2020-07-20 09:00:44', '2020-07-23 15:37:35', NULL, 'Waybill', 'Approved'),
(6, 'mhadrill3', NULL, 'jchatell2', NULL, 'Gyneo Gel', 8, NULL, '2020-07-20 18:19:27', '2020-09-18 23:54:39', NULL, 'Waybill', 'Approved'),
(7, 'mhadrill3', 'Ovie', 'jchatell2', NULL, 'W34', 9, 'Driver number: 08155677890\r\nWaybill No: 1567230', '2020-07-22 16:25:02', '2020-08-27 22:48:40', NULL, 'Waybill', 'Approved'),
(18, 'mhadrill3', NULL, 'Rsmaridge9', NULL, 'Baby Groot ', 7, NULL, '2020-07-23 16:41:28', '2020-07-24 21:19:46', NULL, 'Waybill', 'Approved'),
(19, 'cmourgeb', NULL, 'jchatell2', NULL, 'Vibroaction', 13, 'Waybill number: 3246775', '2020-07-24 22:47:17', '2020-08-01 14:10:47', NULL, 'Waybill', 'Approved'),
(20, 'cmourgeb', NULL, 'jchatell2', NULL, 'Vibroaction', 5, 'Driver Number: 08023457689', '2020-07-25 17:14:55', '2020-08-01 14:10:47', NULL, 'Waybill', 'Approved'),
(21, 'mhadrill3', NULL, 'jchatell2', NULL, 'W34', 13, NULL, '2020-07-28 16:57:55', '2020-08-27 22:48:40', NULL, 'Waybill', 'Approved'),
(22, 'mhadrill3', NULL, 'jchatell2', NULL, 'Vibroaction', 5, 'Driver number: 050639214756', '2020-07-30 11:56:31', '2020-09-18 06:39:43', NULL, 'Waybill', 'Approved'),
(24, 'mhadrill3', NULL, 'jchatell2', NULL, 'Black Panther', 3, NULL, '2020-07-31 08:49:51', '2020-07-31 08:50:04', NULL, 'Waybill', 'Approved'),
(25, 'mhadrill3', NULL, 'Hreedie1b', NULL, 'Black Panther', 10, 'Waybill number: 34567890', '2020-08-09 17:33:58', NULL, NULL, 'Waybill', 'Not Approved'),
(27, 'mhadrill3', NULL, 'Hreedie1b', NULL, 'Vibroaction', 5, NULL, '2020-08-09 17:46:15', NULL, NULL, 'Waybill', 'Not Approved'),
(28, 'mhadrill3', NULL, 'Rsmaridge9', NULL, 'W34', 9, 'Driver Number: 08165266999', '2020-08-09 18:35:17', '2020-08-09 18:43:51', NULL, 'Waybill', 'Approved'),
(29, 'mhadrill3', NULL, 'Rsmaridge9', NULL, 'W34', 5, NULL, '2020-08-09 18:42:39', '2020-08-09 18:43:51', NULL, 'Waybill', 'Approved'),
(30, 'mhadrill3', NULL, 'Rsmaridge9', NULL, 'Gyneo Gel', 7, NULL, '2020-08-09 18:43:20', '2020-08-10 08:26:43', NULL, 'Waybill', 'Approved'),
(36, 'mhadrill3', NULL, 'jchatell2', NULL, 'Richard Mille', 20, 'Driver Number: 08166778899', '2020-08-19 09:39:20', '2020-09-18 06:39:34', NULL, 'Waybill', 'Approved'),
(37, 'mhadrill3', NULL, 'jchatell2', NULL, 'W34', 5, 'Driver number: 08115161718', '2020-08-27 22:48:32', '2020-08-27 22:48:40', NULL, 'Waybill', 'Approved'),
(38, 'mhadrill3', NULL, 'jchatell2', NULL, 'Head Shaver', 10, 'Waybill Number: 345678\r\nTransport: Delta Line', '2020-08-28 08:30:09', '2020-09-08 16:40:31', NULL, 'Waybill', 'Approved'),
(39, 'sdreini6', NULL, 'jchatell2', NULL, '3D WALL CLOCK', 10, 'waybill number: 789456123\r\nAgofure', '2020-08-30 10:42:33', '2020-09-09 12:33:36', NULL, 'Waybill', 'Approved'),
(40, 'cgildroy8', NULL, 'jchatell2', NULL, '3D Wall Clock', 15, 'Driver Number: 08165266899', '2020-08-30 10:56:10', '2020-08-30 10:56:19', NULL, 'Waybill', 'Approved'),
(59, 'mhadrill3', NULL, 'Rsmaridge9', NULL, 'Vibroaction', 14, 'Waybill Number: 3456789', '2020-09-04 16:28:55', '2020-09-04 17:30:55', NULL, 'Waybill', 'Approved'),
(60, 'mhadrill3', NULL, 'jchatell2', NULL, 'Head Shaver', 5, 'Waybill number 12345678', '2020-09-08 16:24:43', '2020-09-08 16:40:31', NULL, 'Waybill', 'Approved'),
(61, 'mhadrill3', NULL, 'jchatell2', NULL, 'Head Shaver', 6, 'Waybill number: 0987654', '2020-09-08 16:25:46', '2020-09-08 16:40:31', NULL, 'Waybill', 'Approved'),
(62, 'mhadrill3', NULL, 'jchatell2', NULL, 'Spin Scrubber', 10, 'Driver Number: 08165266877', '2020-09-08 16:26:20', '2020-09-18 16:55:23', NULL, 'Waybill', 'Approved'),
(63, 'mhadrill3', NULL, 'jchatell2', NULL, 'Smart watch', 6, 'Driver Nmuber: 08097654321', '2020-09-08 16:56:44', '2020-09-20 07:27:48', NULL, 'Waybill', 'Approved'),
(64, 'mhadrill3', NULL, 'jchatell2', NULL, 'Panoramic Camera', 12, 'Driver Number: 08166778899', '2020-09-08 16:58:32', '2020-09-08 16:59:58', NULL, 'Waybill', 'Approved'),
(65, 'sdreini6', NULL, 'jchatell2', NULL, 'Kids Educational Tablet', 10, 'Driver Number', '2020-09-09 11:32:26', '2020-09-09 11:44:42', NULL, 'Waybill', 'Approved'),
(66, 'sdreini6', NULL, 'jchatell2', NULL, '3D WALL CLOCK', 10, 'waybill number: 2389056', '2020-09-09 12:31:31', '2020-09-09 12:33:36', NULL, 'Waybill', 'Approved'),
(67, 'cgildroy8', NULL, 'jchatell2', NULL, '3D Wall Clock', 1, 'Driver Number: 08067893412', '2020-09-09 22:33:53', NULL, 'Auchi', 'Dispatch', 'Approved'),
(68, 'cgildroy8', NULL, 'jchatell2', NULL, '3D Wall Clock', 2, 'Waybill Details: 07030405060', '2020-09-09 22:43:01', NULL, 'Auchi', 'Dispatch', 'Approved'),
(69, 'sdreini6', NULL, 'jchatell2', NULL, 'Kids Educational Tablet', 3, 'Waybill Number: 08165266880', '2020-09-09 22:44:10', NULL, 'Benin', 'Dispatch', 'Approved'),
(70, 'mhadrill3', NULL, 'jchatell2', NULL, 'Vibroaction', 3, 'Driver Number: 08165266847 ', '2020-09-15 15:00:35', '2020-09-18 06:39:43', NULL, 'Waybill', 'Approved'),
(71, 'mhadrill3', NULL, 'jchatell2', NULL, 'Vibroaction', 5, 'Waybill Number: 234567\r\nDelta line', '2020-09-15 16:41:38', '2020-09-18 06:39:43', NULL, 'Waybill', 'Approved'),
(72, 'mhadrill3', NULL, 'jchatell2', NULL, 'Vibroaction', 6, 'Waybill Number: 08165266999', '2020-09-18 06:04:19', '2020-09-18 06:39:43', NULL, 'Waybill', 'Approved'),
(73, 'mhadrill3', NULL, 'jchatell2', NULL, 'Richard Mille', 4, 'Waybill Number: 234566', '2020-09-18 06:18:00', '2020-09-18 06:39:34', NULL, 'Waybill', 'Approved'),
(74, 'mhadrill3', NULL, 'jchatell2', NULL, 'Spin Scrubber', 5, 'waybill number: 08036538080', '2020-09-18 15:51:47', '2020-09-18 16:55:23', NULL, 'Waybill', 'Approved'),
(85, 'mhadrill3', NULL, 'jchatell2', NULL, 'Gyneo Gel', 3, 'Driver Number: 08135245678', '2020-09-18 23:53:29', '2020-09-18 23:54:39', NULL, 'Waybill', 'Approved'),
(86, 'mhadrill3', NULL, 'jchatell2', NULL, 'Gyneo Gel', 2, 'driver number: 08165266847', '2020-09-18 23:57:15', NULL, 'Auchi', 'Dispatch', 'Approved'),
(87, 'mhadrill3', NULL, 'jchatell2', NULL, 'Vibroaction', 3, 'mmmm', '2020-09-18 23:58:34', NULL, 'Ekpoma', 'Dispatch', 'Approved'),
(88, 'mhadrill3', NULL, 'jchatell2', NULL, 'Smart watch', 4, 'Agofure\r\nWaybill Number: 2345678 ', '2020-09-20 07:26:57', '2020-09-20 07:27:48', NULL, 'Waybill', 'Approved'),
(89, 'sdreini6', NULL, 'jchatell2', NULL, '3D WALL CLOCK', 10, 'Driver Number: 08165266847', '2020-09-20 08:02:23', '2020-09-20 08:05:33', NULL, 'Waybill', 'Approved'),
(90, 'sdreini6', NULL, 'jchatell2', NULL, 'Kids Educational Tablet', 2, 'waybill Number: 345690\r\nDelta line', '2020-09-20 08:15:49', '2020-09-20 08:22:35', NULL, 'Waybill', 'Approved'),
(91, 'sdreini6', NULL, 'jchatell2', NULL, 'Kids Educational Tablet', 2, 'Waybill Number: 08165266847', '2020-09-20 08:22:13', '2020-09-20 08:22:27', NULL, 'Waybill', 'Approved'),
(92, 'sdreini6', NULL, 'jchatell2', NULL, 'Kids Educational Tablet', 1, 'Waybill Number: 123456', '2020-09-20 21:39:43', '2020-09-21 13:57:10', NULL, 'Waybill', 'Approved'),
(93, 'cgildroy8', NULL, 'jchatell2', NULL, '3D Wall Clock', 5, 'Waybill Number: 2345678', '2020-09-21 13:56:42', '2020-09-21 13:57:38', NULL, 'Waybill', 'Approved'),
(94, 'gashburne1l', NULL, 'jchatell2', NULL, 'Slimming Shape Wear', 20, 'Waybill Number: 2345678\r\nDelta Line', '2020-09-22 11:33:10', '2020-09-22 11:33:36', NULL, 'Waybill', 'Approved'),
(95, 'mhadrill3', NULL, 'jchatell2', NULL, 'Spin Scrubber', 5, 'Driver\'s number 08036538961', '2020-11-12 15:58:53', '2020-11-12 15:59:18', NULL, 'Waybill', 'Approved'),
(96, 'mhadrill3', NULL, 'jchatell2', NULL, 'Gyneo Gel', 5, 'Driver\'s number 08123456788', '2020-11-14 16:22:15', '2020-11-14 16:22:35', NULL, 'Waybill', 'Approved'),
(97, 'sdreini6', NULL, 'jchatell2', NULL, 'Kids Educational Tablet', 1, 'Hhhh', '2020-11-14 17:09:11', NULL, 'Sapele', 'Dispatch', 'Approved'),
(98, 'Jayboy999', NULL, 'jchatell2', NULL, 'Saucidy sauce ', 5, 'Tyu', '2020-11-26 20:06:33', '2020-11-26 20:07:05', NULL, 'Waybill', 'Approved'),
(99, 'mhadrill3', NULL, 'jchatell2', NULL, 'Wonder Core ', 5, 'Delta line\r\nWaybill Number: 123455', '2020-11-28 11:12:59', '2020-11-28 14:43:27', NULL, 'Waybill', 'Approved'),
(100, 'savvysage', NULL, 'randomlogistics', NULL, 'Wonder Core', 5, '5 Wonder Core sent to you in Lagos', '2020-11-28 13:42:00', '2020-11-28 13:46:50', NULL, 'Waybill', 'Approved'),
(101, 'Doe', NULL, 'Komitex', NULL, 'Non Pedal Wonder Core ', 10, 'Driver\'s number: 08190909090', '2020-11-28 13:42:44', '2020-11-28 13:43:08', NULL, 'Waybill', 'Approved'),
(102, 'savvysage', NULL, 'komitex', NULL, 'Wonder Core', 2, '2 Wonder Core sent to you in Warri', '2020-11-28 13:43:54', '2020-11-28 13:45:01', NULL, 'Waybill', 'Approved'),
(103, 'Doe', NULL, 'Komitex', NULL, 'Situp Bench', 2, 'Driver\'s number: 08166778899', '2020-11-30 13:30:37', '2020-11-30 13:31:54', NULL, 'Waybill', 'Approved'),
(104, 'Doe', NULL, 'Komitex', NULL, 'Set of Barbell', 2, 'Driver\'s number: 08166778899', '2020-11-30 13:31:15', '2020-11-30 13:31:52', NULL, 'Waybill', 'Approved'),
(105, 'Doe', NULL, 'Komitex', NULL, 'Set of Barbell', 2, 'Driver\'s number: 08166778899', '2020-11-30 13:31:15', '2020-11-30 13:31:48', NULL, 'Waybill', 'Approved');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`komitexLogisticsId`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `waybill`
--
ALTER TABLE `waybill`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `komitexLogisticsId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=203;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `waybill`
--
ALTER TABLE `waybill`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
