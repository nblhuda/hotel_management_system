-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 25, 2021 at 08:14 PM
-- Server version: 5.7.24
-- PHP Version: 7.2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hotel_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `checked`
--

CREATE TABLE `checked` (
  `id` int(30) NOT NULL,
  `room_id` int(30) DEFAULT NULL,
  `name` text NOT NULL,
  `contact_no` varchar(20) NOT NULL,
  `date_in` datetime NOT NULL,
  `date_out` datetime NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0 = pending, 1=checked in , 2 = checked out, 3 = cancel',
  `date_updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `checked`
--

INSERT INTO `checked` (`id`, `room_id`, `name`, `contact_no`, `date_in`, `date_out`, `status`, `date_updated`) VALUES
(16, 32, 'Ayraa Amenaa', '012345678', '2021-01-26 14:00:00', '2021-01-28 14:00:00', 3, '2021-01-26 02:25:03'),
(17, 38, 'Alisa Aisyah', '0123456789', '2021-01-28 18:18:00', '2021-01-31 18:18:00', 3, '2021-01-26 02:26:59'),
(19, 32, 'NABILA HUDA BINTI SUHAIMI', '0123456789', '2021-01-26 14:00:00', '2021-01-27 14:00:00', 3, '2021-01-26 02:56:36'),
(20, 42, 'NABILA HUDA BINTI SUHAIMI', '0123456789', '2021-01-27 12:00:00', '2021-01-28 12:00:00', 2, '2021-01-26 02:58:38'),
(21, 32, 'bell', '0123456789', '2021-01-25 19:02:00', '2021-01-27 19:02:00', 2, '2021-01-26 03:47:33'),
(22, 38, 'NABILA HUDA BINTI SUHAIMI', '0123456789', '2021-01-28 20:15:00', '2021-01-29 20:15:00', 2, '2021-01-26 03:47:16'),
(23, 40, 'Anis Aina', '0139332305', '2021-01-27 14:00:00', '2021-01-29 14:00:00', 0, '2021-01-26 03:52:23'),
(24, 32, 'Afrina Jafri', '0172867327', '2021-01-29 16:00:00', '2021-02-02 16:00:00', 1, '2021-01-26 03:53:38'),
(25, 42, 'Sarah Sofiya', '0123456789', '2021-01-25 19:54:00', '2021-01-27 19:54:00', 3, '2021-01-26 03:55:18');

-- --------------------------------------------------------

--
-- Table structure for table `facilities`
--

CREATE TABLE `facilities` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `status` int(11) NOT NULL COMMENT '0 = Available 1 = Unavailable',
  `cover_img` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `facilities`
--

INSERT INTO `facilities` (`id`, `name`, `status`, `cover_img`) VALUES
(4, 'Restaurant', 0, '1611128160_dining.jpg'),
(5, 'Spa', 0, '1611217680_spa.jpg'),
(6, 'Gift Shop', 0, '1611217800_gift_shop.jpg'),
(8, '24 Hours Security Control', 0, '1611217980_24hr-security-control.jpg'),
(9, 'Swimming Pool', 0, '1611218040_swimming_pool.jpg'),
(10, 'Concierge', 0, '1611561840_concierge.jpg'),
(11, 'Meeting Room', 0, '1611561960_meeting-room.jpg'),
(12, 'Event Venue', 0, '1611562020_ballroom.jpg'),
(13, 'Shuttle Service', 0, '1611562140_shuttle.jpg'),
(14, 'Gym', 0, '1611583260_facilities.jfif');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `rate` text NOT NULL,
  `feedback` text NOT NULL,
  `date_updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `rate`, `feedback`, `date_updated`) VALUES
(12, '4', 'I really like the service here. Gonna come in again later', '2021-01-26 01:41:38'),
(13, '3', 'Keep it up ', '2021-01-26 01:42:41'),
(14, '1', 'Terrible hotel, poor cleanliness and bad attitude', '2021-01-26 01:44:01'),
(15, '4', 'Affordable price, excellent location!\r\nQuite smooth reservation process, very friendly service at the desk, clean & large room for two, very quiet over the rooftops of Helsinki - a very pleasant stay at the heart of Helsinki, in the middle of practically everything!', '2021-01-26 01:45:13');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int(30) NOT NULL,
  `room` varchar(30) NOT NULL,
  `category_id` int(30) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0 = Available , 1= Unvailables'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `room`, `category_id`, `status`) VALUES
(32, 'Room-101', 24, 1),
(33, 'Room-102', 24, 0),
(34, 'Room-103', 24, 0),
(35, 'Room-201', 25, 0),
(36, 'Room-202', 25, 0),
(38, 'Room-301', 26, 0),
(39, 'Room-302', 26, 0),
(40, 'Room-401', 27, 1),
(41, 'Room-402', 27, 0),
(42, 'Room-501', 28, 0);

-- --------------------------------------------------------

--
-- Table structure for table `room_categories`
--

CREATE TABLE `room_categories` (
  `id` int(30) NOT NULL,
  `name` text NOT NULL,
  `price` float NOT NULL,
  `adult` int(11) NOT NULL,
  `kid` int(11) NOT NULL,
  `cover_img` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `room_categories`
--

INSERT INTO `room_categories` (`id`, `name`, `price`, `adult`, `kid`, `cover_img`) VALUES
(24, 'Standard Single Room', 150, 1, 1, '1611597300_single-room.jpg'),
(25, 'Standard Twin Room', 200, 2, 1, '1611597660_twin-room.jpg'),
(26, 'Deluxe Double Room', 300, 2, 2, '1611597720_deluxe_double_room.jpg'),
(27, 'Deluxe Twin Room', 350, 2, 4, '1611597720_deluxe_twin_room.jpg'),
(28, 'Family Suite', 500, 4, 4, '1611597780_family_suite.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `system_settings`
--

CREATE TABLE `system_settings` (
  `id` int(30) NOT NULL,
  `hotel_name` text NOT NULL,
  `hotel_address` text NOT NULL,
  `email` varchar(200) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `fax` varchar(20) NOT NULL,
  `cover_img` text NOT NULL,
  `about_content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `system_settings`
--

INSERT INTO `system_settings` (`id`, `hotel_name`, `hotel_address`, `email`, `contact`, `fax`, `cover_img`, `about_content`) VALUES
(1, 'RendahTecc Hotel', 'Kuala Lumpur City Centre, 50088 Kuala Lumpur, Malaysia', 'admin@rendahtecc.com', '+03 332234567', '+604-899 1499', '1611567540_cover.jpg', '&lt;p style=&quot;text-align: center;&quot;&gt;&lt;span style=&quot;text-align: center;&quot;&gt;RendahTecc Hotel was founded by like minded entreprenuers, people who share a passion for travelling and exploring. &lt;/span&gt;&lt;/p&gt;&lt;p style=&quot;text-align: center;&quot;&gt;&lt;span style=&quot;text-align: center;&quot;&gt;Service, design and simplicity are at our core: when you book a room with us, you&rsquo;re guaranted to have an extraordinary experience.&lt;/span&gt;&lt;/p&gt;&lt;blockquote style=&quot;margin: 0 0 0 40px; border: none; padding: 0px;&quot;&gt;&lt;p style=&quot;text-align: center;&quot;&gt;&lt;span style=&quot;text-align: center;&quot;&gt;From the moment you walk in the door, you will feel the special RendahTecc Hotel hospitality. Our super soft linen, perfect concierge &lt;/span&gt;&lt;/p&gt;&lt;/blockquote&gt;&lt;p style=&quot;text-align: center;&quot;&gt;&lt;span style=&quot;text-align: center;&quot;&gt;services&lt;/span&gt;&lt;span style=&quot;text-align: left;&quot;&gt; and exceptional design are only part of the story. Take a look at our site to learn more, and book your room today.&lt;/span&gt;&lt;br&gt;&lt;/p&gt;');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(30) NOT NULL,
  `name` varchar(200) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT '2' COMMENT '1=admin , 2 = staff'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `type`) VALUES
(1, 'Administrator', 'admin', 'admin123', 1),
(9, 'Operation', 'afrina', 'afrina123', 2),
(10, 'Sales', 'aina', 'aina123', 2),
(11, 'Marketing', 'sarah', 'sarah123', 2),
(12, 'IT', 'huda', 'huda123', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `checked`
--
ALTER TABLE `checked`
  ADD PRIMARY KEY (`id`),
  ADD KEY `checked_ibfk_1` (`room_id`);

--
-- Indexes for table `facilities`
--
ALTER TABLE `facilities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `room_categories`
--
ALTER TABLE `room_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system_settings`
--
ALTER TABLE `system_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `checked`
--
ALTER TABLE `checked`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `facilities`
--
ALTER TABLE `facilities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `room_categories`
--
ALTER TABLE `room_categories`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `system_settings`
--
ALTER TABLE `system_settings`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `checked`
--
ALTER TABLE `checked`
  ADD CONSTRAINT `checked_ibfk_1` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rooms`
--
ALTER TABLE `rooms`
  ADD CONSTRAINT `rooms_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `room_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
