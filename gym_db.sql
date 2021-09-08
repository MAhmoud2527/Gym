-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 08, 2021 at 09:59 AM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gym_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
  `id` int(11) NOT NULL,
  `country_name` char(25) NOT NULL,
  `country_created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`id`, `country_name`, `country_created_at`) VALUES
(1, 'Cairo', '2021-08-26 11:20:21'),
(2, 'Alex', '2021-08-19 03:14:53'),
(3, 'Benha', '2021-08-26 11:20:06'),
(4, 'Maadi', '2021-08-26 11:20:06');

-- --------------------------------------------------------

--
-- Table structure for table `days`
--

CREATE TABLE `days` (
  `id` int(11) NOT NULL,
  `day_name` char(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `days`
--

INSERT INTO `days` (`id`, `day_name`) VALUES
(1, 'Saturday'),
(2, 'Sunday'),
(3, 'Monday'),
(4, 'Tuesday'),
(5, 'Wednesday'),
(6, 'Thursday'),
(7, 'Friday');

-- --------------------------------------------------------

--
-- Table structure for table `exercises`
--

CREATE TABLE `exercises` (
  `id` int(11) NOT NULL,
  `exercises_name` char(20) NOT NULL,
  `sets` int(11) NOT NULL,
  `add_by` int(11) NOT NULL,
  `day_id` int(11) NOT NULL,
  `trainee_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `exercises`
--

INSERT INTO `exercises` (`id`, `exercises_name`, `sets`, `add_by`, `day_id`, `trainee_id`) VALUES
(23, 'Back', 10, 133, 3, 49),
(25, 'Lester', 84, 136, 4, 50);

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `exe_id` int(11) NOT NULL,
  `image_created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `name`, `exe_id`, `image_created_at`) VALUES
(14, '14334502401629980862.jpg', 23, '2021-08-26 12:27:42'),
(15, '10865797991629980862.jpg', 23, '2021-08-26 12:27:42'),
(16, '8042643341629980862.jpg', 23, '2021-08-26 12:27:42'),
(17, '21134274051629980863.jpg', 23, '2021-08-26 12:27:43'),
(20, '4700099891631007617.jpg', 25, '2021-09-07 09:40:17');

-- --------------------------------------------------------

--
-- Table structure for table `package`
--

CREATE TABLE `package` (
  `id` int(11) NOT NULL,
  `package_name` char(50) NOT NULL,
  `month_num` int(11) NOT NULL,
  `package_amount` int(50) NOT NULL,
  `package_created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `add_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `package`
--

INSERT INTO `package` (`id`, `package_name`, `month_num`, `package_amount`, `package_created_at`, `add_by`) VALUES
(15, '3 month', 4, 500, '2021-08-26 12:25:23', 132);

-- --------------------------------------------------------

--
-- Table structure for table `trainees_more_info`
--

CREATE TABLE `trainees_more_info` (
  `id` int(11) NOT NULL,
  `weight` int(25) NOT NULL,
  `height` int(25) NOT NULL,
  `package_id` int(11) NOT NULL,
  `coach_id` int(11) NOT NULL,
  `more_info` int(11) NOT NULL,
  `more_add_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `trainees_more_info`
--

INSERT INTO `trainees_more_info` (`id`, `weight`, `height`, `package_id`, `coach_id`, `more_info`, `more_add_by`) VALUES
(49, 90, 182, 15, 133, 134, 132),
(50, 74, 30, 15, 136, 137, 132);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` char(20) NOT NULL,
  `email` char(30) NOT NULL,
  `password` char(100) NOT NULL,
  `phone` int(11) NOT NULL,
  `photo` char(50) NOT NULL,
  `country_id` int(11) NOT NULL,
  `user_type_id` int(11) NOT NULL,
  `add_by` int(11) DEFAULT NULL,
  `user_created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `phone`, `photo`, `country_id`, `user_type_id`, `add_by`, `user_created_at`) VALUES
(65, 'Admin', 'admin@admin.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 123123, '642928731629601194.jpeg', 1, 1, NULL, '2021-08-23 09:39:17'),
(132, 'nti', 'a@a.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 323, '4596342711629980693.jpeg', 2, 2, 65, '2021-08-26 12:24:53'),
(133, 'adam', 'c@c.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 5435, '11414192411629980762.jpeg', 3, 3, 132, '2021-08-26 12:26:02'),
(134, 'test', 's@s.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 123, '19405963331629980800.jpeg', 3, 4, 132, '2021-08-26 12:26:40'),
(135, 'sara', 'ad@ad.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 21, '17639752351629980982.jpeg', 3, 2, 65, '2021-08-26 12:29:42'),
(136, 'denalefeji', 'cocomynuv@mailinator.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 21, '8064804271629982712.jpeg', 1, 3, 132, '2021-08-26 12:58:32'),
(137, 'denunos', 'wowulywu@mailinator.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 5, '12726220151629982741.jpeg', 1, 4, 132, '2021-08-26 12:59:01');

-- --------------------------------------------------------

--
-- Table structure for table `usertype`
--

CREATE TABLE `usertype` (
  `id` int(11) NOT NULL,
  `title` char(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `usertype`
--

INSERT INTO `usertype` (`id`, `title`) VALUES
(1, 'Admin'),
(2, 'Manager'),
(3, 'Coach'),
(4, 'Trainee');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `days`
--
ALTER TABLE `days`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exercises`
--
ALTER TABLE `exercises`
  ADD PRIMARY KEY (`id`),
  ADD KEY `day_id` (`day_id`),
  ADD KEY `trainee_id` (`trainee_id`),
  ADD KEY `coach_id` (`add_by`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `exe_id` (`exe_id`);

--
-- Indexes for table `package`
--
ALTER TABLE `package`
  ADD PRIMARY KEY (`id`),
  ADD KEY `add_by` (`add_by`);

--
-- Indexes for table `trainees_more_info`
--
ALTER TABLE `trainees_more_info`
  ADD PRIMARY KEY (`id`),
  ADD KEY `coach_id` (`coach_id`),
  ADD KEY `more_info` (`more_info`),
  ADD KEY `package_id` (`package_id`) USING BTREE,
  ADD KEY `more_add_by` (`more_add_by`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_type_id` (`user_type_id`),
  ADD KEY `country_id` (`country_id`),
  ADD KEY `add_by` (`add_by`);

--
-- Indexes for table `usertype`
--
ALTER TABLE `usertype`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `days`
--
ALTER TABLE `days`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `exercises`
--
ALTER TABLE `exercises`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `package`
--
ALTER TABLE `package`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `trainees_more_info`
--
ALTER TABLE `trainees_more_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=138;

--
-- AUTO_INCREMENT for table `usertype`
--
ALTER TABLE `usertype`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `exercises`
--
ALTER TABLE `exercises`
  ADD CONSTRAINT `coach_relation` FOREIGN KEY (`add_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `day_relation` FOREIGN KEY (`day_id`) REFERENCES `days` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_relation` FOREIGN KEY (`trainee_id`) REFERENCES `trainees_more_info` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `img_rel` FOREIGN KEY (`exe_id`) REFERENCES `exercises` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `package`
--
ALTER TABLE `package`
  ADD CONSTRAINT `added_RElatedUser_rel` FOREIGN KEY (`add_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `trainees_more_info`
--
ALTER TABLE `trainees_more_info`
  ADD CONSTRAINT `coach_id` FOREIGN KEY (`coach_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `more_add_by` FOREIGN KEY (`more_add_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `more_rel` FOREIGN KEY (`more_info`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `package_id` FOREIGN KEY (`package_id`) REFERENCES `package` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `add_user_relation` FOREIGN KEY (`add_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `country` FOREIGN KEY (`country_id`) REFERENCES `country` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_type_relation` FOREIGN KEY (`user_type_id`) REFERENCES `usertype` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
