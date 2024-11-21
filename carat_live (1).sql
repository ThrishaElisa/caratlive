-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 21, 2024 at 06:14 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `carat_live`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--
-- Check and create the database if it does not exist
CREATE DATABASE IF NOT EXISTS carat_live;

-- Use the database
USE carat_live;

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `lastname` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `firstname`, `email`, `password`, `lastname`) VALUES
(1, 'Admin ', 'admin@caratlive.com', 'admin123', '');

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `event_id` int(11) NOT NULL,
  `eventname` varchar(100) NOT NULL,
  `artistname` varchar(100) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `location` varchar(100) NOT NULL,
  `description` varchar(700) NOT NULL,
  `content` longtext NOT NULL,
  `image` longblob NOT NULL,
  `seatmapimage` longblob NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`event_id`, `eventname`, `artistname`, `date`, `time`, `location`, `description`, `content`, `image`, `seatmapimage`, `is_deleted`) VALUES
(5, 'REQUIEM TOUR IN KUALA LUMPUR ', 'Keshi', '2025-02-24', '20:00:00', ' Axiata Arena, Bukit Jalil', 'Get ready for an unforgettable night with Keshi as he brings the \"Requiem Tour\" to Kuala Lumpur! Join us for an evening filled with amazing music, energy, and emotion. Don’t miss out on the chance to witness his concert!!', '<h3>Enjoy special access to the for&nbsp;<strong>MASTERCARD</strong>&nbsp;PREFFERED* cardholders globally!</h3>\r\n\r\n<p><br />\r\n&nbsp;</p>\r\n\r\n<h1><strong>ONSALE DETAILS</strong></h1>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h3><strong>Artist Presale</strong></h3>\r\n\r\n<h3>📆 29 July 2024, Monday</h3>\r\n\r\n<h3>⏰10 AM - 11:59 PM - The waiting room starts at 9 AM</h3>\r\n\r\n<h3><br />\r\n&nbsp;</h3>\r\n\r\n<h3><strong>MasterCard Presale</strong></h3>\r\n\r\n<h3>📆 30 July 2024, Tuesday till 1 Aug 2024, Thursday</h3>\r\n\r\n<h3>⏰10 AM - 10 AM - The waiting room starts at 9 AM</h3>\r\n\r\n<h3><br />\r\n&nbsp;</h3>\r\n\r\n<h3><strong>Live Nation Presale</strong></h3>\r\n\r\n<h3>📆 1 Aug 2024, Thursday</h3>\r\n\r\n<h3>⏰ 12 PM - 11:59 PM - The waiting room starts at 11 AM</h3>\r\n', 0x75706c6f6164732f6b657368692e706e67, 0x75706c6f6164732f6b6573686920736561746d61702e6a706567, 0),
(6, 'LOOM WORLD TOUR LIVE IN KUALA LUMPUR', 'Imagine Dragons', '2024-11-21', '20:00:00', 'National Hockey Stadium, Bukit Jalil', 'Enjoy special access to the for 𝐌𝐀𝐒𝐓𝐄𝐑𝐂𝐀𝐑𝐃 PREFFERED * cardholders globally! Visit HERE to find out more.⁠', '<p><strong>ONSALE DETAILS</strong></p>\r\n\r\n<p><strong>Artist Presale</strong><br />\r\n📆 12 August 2024, Monday<br />\r\n⏰ 12 PM - 11:59 PM - The waiting room starts at 11 AM<br />\r\nSign up at <a href=\"imaginedragonsmusic.com\" target=\"_blank\">imaginedragonsmusic.com</a> to get your presale code!</p>\r\n\r\n<p><strong>MasterCard Presale</strong><br />\r\n📆 13 August 2024, Tuesday till 15 August 2024, Thursday<br />\r\n⏰11 AM - 11 AM - The waiting room starts at 10 AM<br />\r\nEnjoy special access to the presale for 𝐌𝐀𝐒𝐓𝐄𝐑𝐂𝐀𝐑𝐃 cardholders globally! Visit priceless.com/music to find out more.</p>\r\n\r\n<p><strong>Live Nation Presale</strong><br />\r\n📆 15 August 2024, Thursday<br />\r\n⏰ 12 PM - 11:59 PM - The waiting room starts at 11 AM<br />\r\n<em>Register for a FREE membership via </em><a href=\"https://www.livenation.my/\" target=\"_blank\"><em>www.livenation.my</em></a><em> to access the exclusive presale!⁠</em></p>\r\n\r\n<p><strong>General Onsale</strong><br />\r\n📆 16 August 2024, Friday<br />\r\n⏰ 11 AM onwards - The waiting room starts at 10 AM</p>\r\n\r\n<hr />\r\n<h2>TICKET PRICE</h2>\r\n\r\n<p>CAT 1 - RM 988<br />\r\nCAT 2 - RM 698<br />\r\nCAT 3 - RM 598<br />\r\nCAT 4 - RM 498 [ STANDING ZONE ]<br />\r\nCAT 5 - RM 498<br />\r\nCAT 6 - RM 398<br />\r\nCAT 7 - RM 298</p>\r\n\r\n<p>*Ticket prices shown exclude Booking Fees, and Transaction charges</p>\r\n\r\n<hr />\r\n<h2><strong>Important Information</strong></h2>\r\n\r\n<ul>\r\n	<li>\r\n	<p>Limited to 8 tickets per customer.</p>\r\n	</li>\r\n	<li>\r\n	<p>Reselling your tickets or purchasing from an unauthorised ticket seller or ticket scalper is strictly prohibited and the Event Organiser/Promoter reserves the right to cancel such tickets without compensation and/or refuse entry to the event.</p>\r\n	</li>\r\n	<li>\r\n	<p>Payment Method: Only VISA &amp; MASTERCARD CREDIT Cards or DEBIT Card payments are accepted.</p>\r\n	</li>\r\n	<li>\r\n	<p>Tickets may not be bought and resold for advertising and/or promotional purposes.</p>\r\n	</li>\r\n</ul>\r\n', 0x75706c6f6164732f696d6167696e65647261676f6e732e706e67, 0x75706c6f6164732f494420736561746d61702e706e67, 0),
(10, 'Asia Tour 2025 Kuala Lumpur', 'Maroon 5 ', '2025-02-12', '20:00:00', 'National Hockey Stadium, Bukit Jalil', 'Details for VIP entitlements will be released with an event guide nearer to the show date. ', '<h3><strong>ONSALE DETAILS</strong></h3>\r\n\r\n<p><strong>Artist Presale</strong><br />\r\n📆 30 Sept (Monday)<br />\r\n⏰11 AM - 11:59 PM<br />\r\n<em>Visit </em><a href=\"https://www.maroon5sin.com/subscribe\" target=\"_blank\"><em>MAROON 5 </em></a><em>for more details</em></p>\r\n\r\n<p><strong>MasterCard Presale</strong><br />\r\n📆 1 Oct (Tuesday) till 3 Oct (Thursday)<br />\r\n⏰11 AM - 11 AM<br />\r\n<em>Visit priceless.com/music to find out more. CLICK </em><a href=\"https://golive-asia.thaiticketmajor.com/booking/prww/zones.php?query=636\" target=\"_blank\"><em>HERE</em></a></p>\r\n\r\n<p><strong>Live Nation Presale</strong><br />\r\n📆 3 Oct Thursday<br />\r\n⏰ 1 PM - 11:59 PM</p>\r\n\r\n<p><strong>General Onsale</strong><br />\r\n📆 4 Oct Friday<br />\r\n⏰ 11 AM onwards</p>\r\n\r\n<p><strong>*<em>Waiting Room for the queue will start 1 hour before all Presale &amp; General On-Sale</em></strong></p>\r\n', 0x75706c6f6164732f6d6172726f6e352e706e67, 0x75706c6f6164732f736561746d61706d61726f6f6e352e6a7067, 0),
(11, '0.03 World Tour in Kuala Lumpur', 'Wave to Earth', '2025-01-19', '20:00:00', 'Mega Star Arena', 'Play with Earth!! 0.03 World Tour', '<h2><strong>ONSALE DETAILS</strong></h2>\r\n\r\n<h3><strong>MasterCard Presale</strong></h3>\r\n\r\n<h3><br />\r\n📆27 Nov (Wednesday) till 28 Nov (Thursday)<br />\r\n⏰11 AM - 11 AM</h3>\r\n\r\n<p><br />\r\n<em>These tickets are available exclusively to Mastercard cardholders and can only be purchased using a Mastercard and by paying through the Mastercard network. For more priceless experiences: </em><strong><em>priceless</em></strong></p>\r\n\r\n<h3><strong>Live Nation Presale</strong></h3>\r\n\r\n<h3><br />\r\n📆 28 Nov (Wednesday)<br />\r\n⏰ 2 PM - 11:59 PM<br />\r\n<em>Register for a FREE membership via </em><a href=\"https://www.livenation.my/\" target=\"_blank\"><strong><em>www.livenation.my</em></strong></a><em> to access the presale!⁠</em></h3>\r\n\r\n<p><strong>General Onsale</strong><br />\r\n📆 29 Nov (Thursday)<br />\r\n⏰ 12 PM onwards</p>\r\n\r\n<p><strong><em>*</em></strong><em>The waiting room will start </em><strong><em>AN HOUR</em></strong><em> before all the sales.</em></p>\r\n', 0x75706c6f6164732f77617665746f65617274682e6a7067, 0x75706c6f6164732f736561746d61707774652e6a7067, 0),
(12, 'World Tour In Kuala Lumpur', 'Green Day', '2024-11-12', '21:00:00', 'National Hockey Stadium, Bukit Jalil', 'Enjoy special access to the for 𝐌𝐀𝐒𝐓𝐄𝐑𝐂𝐀𝐑𝐃 PREFFERED * cardholders globally! Visit HERE to find out more.⁠', '<h2><strong>ONSALE DETAILS</strong></h2>\r\n\r\n<h3><strong>MasterCard Presale</strong><br />\r\n📆 24 Sept (Tuesday) till 26 Sept (Thursday) 10 am<br />\r\n⏰10 AM - 10 AM</h3>\r\n\r\n<h3><strong>Live Nation Presale</strong><br />\r\n📆 26 Sept Thursday<br />\r\n⏰ 12 PM - 11:59 PM<br />\r\n<em>Register for a FREE membership via </em><a href=\"https://www.livenation.my/\" target=\"_blank\"><em>www.livenation.my</em></a><em> to access the exclusive presale!⁠</em></h3>\r\n\r\n<h3><strong>General Onsale</strong><br />\r\n📆 27 Sept Friday<br />\r\n⏰ 11 AM onwards - The waiting room starts at 10 AM</h3>\r\n', 0x75706c6f6164732f677265656e6461792e706e67, 0x75706c6f6164732f677265656e646179736561742e6a7067, 0),
(14, 'TOUR OF EARTH in Kuala Lumpur', 'Human Musical Group Sensations GLASS ANIMALS', '2024-11-21', '20:00:00', 'ZEEP KL', 'RM1488.00, RM668.00, RM308.00, RM268.00, RM268.00, RM372.00\r\n\r\n*Ticket price excludes ticket fee and booking charges', '<h3>ONSALE DETAILS</h3>\r\n\r\n<p><strong>MasterCard Presale</strong><br />\r\n📆11 Nov (Monday) till 13 Nov (Wednesday)<br />\r\n⏰11 AM - 11 AM<br />\r\n<em>These tickets are available exclusively to Mastercard cardholders and can only be purchased using a Mastercard and by paying through the Mastercard network. For more priceless experiences: </em><strong><em>priceless</em></strong></p>\r\n\r\n<p><strong>Live Nation Presale</strong><br />\r\n📆 13 Nov (Wednesday)<br />\r\n⏰ 12 PM - 11:59 PM<br />\r\n<em>Register for a FREE membership via </em><a href=\"https://www.livenation.my/\" target=\"_blank\"><strong><em>www.livenation.my</em></strong></a><em> to access the presale!⁠</em></p>\r\n\r\n<p><strong>General Onsale</strong><br />\r\n📆 14 Nov (Thursday)<br />\r\n⏰ 11 AM onwards</p>\r\n\r\n<p><strong><em>*</em></strong><em>The waiting room will start </em><strong><em>HALF AN HOUR</em></strong><em> before all the sales.</em></p>\r\n', 0x75706c6f6164732f676c617373616e696d616c2e6a7067, 0x75706c6f6164732f676c617373616e696d616c736561742e6a7067, 0);

-- --------------------------------------------------------

--
-- Table structure for table `inquiry`
--

CREATE TABLE `inquiry` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `message` varchar(800) NOT NULL,
  `reply` varchar(800) NOT NULL,
  `internaluser` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inquiry`
--

INSERT INTO `inquiry` (`id`, `name`, `email`, `message`, `reply`, `internaluser`) VALUES
(21, 'Thrisha Yusri', 'thrisha@gmail.com', 'I have a question regarding wave to earth concert. Could you please provide more details or assist me with this? Thank you for your help!', '  hi, yeah sure............', 1),
(23, 'Thrisha Yusri', 'thrisha@gmail.com', 'I’d like to inquire about Seventeen Concert In Kuala Lumpur. Could you provide more information or assist me with this? Thank you!\"', '  hi, this is carat team....', 1),
(24, 'Ali', 'ali@gmail.com', '  hii, unregistered user ', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `purchase`
--

CREATE TABLE `purchase` (
  `id` int(11) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `event_id` int(11) NOT NULL,
  `ticket_id` int(11) NOT NULL,
  `ticketNum` int(11) NOT NULL,
  `totalprice` double NOT NULL,
  `paymentMethod` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `purchase`
--

INSERT INTO `purchase` (`id`, `firstname`, `lastname`, `email`, `phone`, `address`, `event_id`, `ticket_id`, `ticketNum`, `totalprice`, `paymentMethod`, `user_id`) VALUES
(21, 'Naqib ', 'Ariffin', 'naqib@gmail.com', '0122845545', 'Alor Gajah', 11, 27, 2, 836, 'FPX Payment', 10),
(22, 'Naqib ', 'Ariffin', 'naqib@gmail.com', '0122845545', 'Alor Gajah', 6, 20, 3, 3660, 'FPX Payment', 10),
(23, 'Thrisha', 'Yusri', 'thrisha@gmail.com', '012345678', 'Ampang', 5, 34, 3, 1854, 'FPX Payment', 13),
(24, 'Thrisha', 'Yusri', 'thrisha@gmail.com', '122845545', 'Ampang', 5, 15, 2, 2940, 'FPX Payment', 13);

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `ticket_id` int(11) NOT NULL,
  `ticketname` varchar(100) NOT NULL,
  `ticketprice` double NOT NULL,
  `ticketquantity` int(11) NOT NULL,
  `section` varchar(500) NOT NULL,
  `event_id` int(11) NOT NULL,
  `remainingquantity` int(11) NOT NULL,
  `is_deleted` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`ticket_id`, `ticketname`, `ticketprice`, `ticketquantity`, `section`, `event_id`, `remainingquantity`, `is_deleted`) VALUES
(15, 'Soundcheck ', 1450, 100, 'Standing Zone', 5, 98, 0),
(16, 'Limbo VIP ', 950, 100, 'Standing Zone', 5, 25, 0),
(20, 'VVIP', 1200, 100, 'V1', 6, 97, 0),
(22, 'Early Entry VIP', 1128, 100, 'Standing Zone', 10, 100, 0),
(23, 'VIP MEET & GREET ', 728, 100, 'Standing Zone', 11, 100, 0),
(24, 'VIP SOUNDCHECK', 498, 100, 'Standing Zone', 11, 100, 0),
(25, 'STANDING ZONE', 298, 100, 'Standing Zone', 11, 100, 0),
(26, 'CAT 1', 498, 100, 'Seating Zone', 11, 100, 0),
(27, 'CAT 2 ', 398, 100, 'Seating Zone', 11, 98, 0),
(28, 'CAT 1', 698, 100, '318', 5, 100, 0),
(29, 'CAT 1', 698, 100, '317', 5, 100, 0),
(30, 'CAT 1', 698, 100, '319', 5, 100, 0),
(31, 'CAT 1', 698, 100, '308', 5, 100, 0),
(32, 'CAT 1', 698, 100, '307', 5, 100, 0),
(33, 'CAT 1', 698, 100, '306', 5, 100, 0),
(34, 'CAT 2', 598, 100, '305', 5, 97, 0),
(35, 'CAT 2', 598, 100, '304', 5, 100, 0),
(36, 'CAT 2', 598, 100, '303', 5, 100, 0),
(37, 'CAT 2', 598, 100, '302', 5, 100, 0),
(38, 'CAT 2', 598, 100, '301', 5, 100, 0),
(39, 'CAT 2', 598, 100, '322', 5, 100, 0),
(40, 'CAT 2', 598, 100, '321', 5, 100, 0),
(41, 'CAT 2', 598, 100, '320', 5, 100, 0),
(42, 'CAT 1 ', 1228, 100, '118', 12, 100, 0),
(43, 'TOUR OF EARTH VIP PACKAGE', 668, 100, 'Free Standing', 14, 100, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(15) NOT NULL,
  `birthdate` date NOT NULL,
  `phonenumber` int(11) NOT NULL,
  `address` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `firstname`, `lastname`, `email`, `password`, `birthdate`, `phonenumber`, `address`) VALUES
(2, 'Firal', 'Yusri', 'firalyusri@gmail.com', 'firal', '2024-11-06', 0, ''),
(13, 'Thrisha', 'Yusri', 'thrisha@gmail.com', 'thrisha', '2024-11-03', 122845545, 'Ampang');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`event_id`);

--
-- Indexes for table `inquiry`
--
ALTER TABLE `inquiry`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase`
--
ALTER TABLE `purchase`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_id` (`event_id`),
  ADD KEY `ticket_id` (`ticket_id`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`ticket_id`),
  ADD KEY `event_id` (`event_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `inquiry`
--
ALTER TABLE `inquiry`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `purchase`
--
ALTER TABLE `purchase`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `ticket_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `purchase`
--
ALTER TABLE `purchase`
  ADD CONSTRAINT `purchase_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `event` (`event_id`),
  ADD CONSTRAINT `purchase_ibfk_2` FOREIGN KEY (`ticket_id`) REFERENCES `tickets` (`ticket_id`);

--
-- Constraints for table `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `tickets_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `event` (`event_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
