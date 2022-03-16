-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 30, 2022 at 09:41 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bookstore`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `a_id` int(11) NOT NULL,
  `country` varchar(20) NOT NULL,
  `gov` varchar(20) NOT NULL,
  `city` varchar(20) NOT NULL,
  `extraData` varchar(40) NOT NULL,
  `u_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`a_id`, `country`, `gov`, `city`, `extraData`, `u_id`) VALUES
(1, 'Egypt', 'Alex', 'root', 'ttest', 2),
(2, 'Egypt', 'alex', 'tt', 'ttt', 1);

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `b_id` int(11) NOT NULL,
  `b_name` varchar(50) NOT NULL,
  `b_author` varchar(40) NOT NULL,
  `publisher` varchar(40) NOT NULL,
  `edition` varchar(20) NOT NULL,
  `price` int(11) NOT NULL,
  `no_of_copies` int(11) NOT NULL,
  `description` varchar(250) NOT NULL,
  `images` varchar(50) NOT NULL,
  `type_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`b_id`, `b_name`, `b_author`, `publisher`, `edition`, `price`, `no_of_copies`, `description`, `images`, `type_id`) VALUES
(1, 'power', 'Robert Greene', 'mahmoud', 'one edition', 654, 30, 'power How to win friends and influence othersHow to win friends and influence ot', '21214039491640123416.png', 2),
(2, 'Attention Revolution', 'Alan Wallace', 'xxxxx', 'one edition', 80, 100, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce sed metus eleifend, elementum sem at, sagittis ipsum. Fusce quis rhoncus lorem. Mauris semper ac lorem eu condimentum. Morbi sollicitudin eros sed auctor cursus. Vestibulum euismod purus ', '10310416401640123465.png', 2),
(3, ' How to win friends and influence others', 'Dale Carnegie', 'aaaaaa', 'one edition', 70, 80, 'How to win friends and influence others', '792731371640123380.png', 2),
(4, 'Principles and Technology of Nuclear Physics', 'Bassam Mohamed Dakhl', 'test', 'two edition', 70, 50, 'Principles and Technology of Nuclear Physics', '12710183431640123492.jpg', 1),
(5, ' Concepts of the physical sciences', 'Paul Hoyt', 'sssssss', 'two edition', 60, 65, 'Concepts of the physical sciences', '10980635331640123515.jpg', 1),
(6, 'Atlas of Physics', 'group of scientists', 'test', 'one edition', 250, 40, 'Vestibulum sed tincidunt libero. Ut sed justo et lacus congue facilisis. Aliquam mollis, nulla a vestibulum lacinia, ex magna dignissim tellus, porttitor elementum diam erat eu eros.', '1296584501640123540.jpg', 1),
(7, 'The language instinct', 'Steven Pinker', 'ElAhram', 'first edition', 100, 30, 'The classic book on the development of human language by the world leading expert on language and the mind The classic book on the development of human language by the world leading expert on language and the mind\r\n', '11219364661637832715.jpg', 3),
(8, ' The First Word', 'Christine Kenneally', 'ElAhram', 'first edition', 60, 72, 'Vestibulum sed tincidunt libero. Ut sed justo et lacus congue facilisis. Aliquam mollis, nulla a vestibulum lacinia, ex magna dignissim tellus, porttitor elementum diam erat eu eros.', '15169150491640123581.jpg', 3),
(9, 'The Genius of Language', 'Wendy Lesser', 'DarelNasher', 'first edition', 64, 12, 'Vestibulum sed tincidunt libero. Ut sed justo et lacus congue facilisis. Aliquam mollis, nulla a vestibulum lacinia, ex magna dignissim tellus, porttitor elementum diam erat eu eros.', '7318228911640123599.jpg', 3),
(10, 'test', 'test', 'ElAhram', 'first edition', 226, 28, 'This book explains the principles and technology of nuclear physics in a clear scientific manner\r\n', '15625338731640291025.jpg', 4),
(11, 'test', 'test', 'test', 'first edition', 20, 58, 'Vestibulum sed tincidunt libero. Ut sed justo et lacus congue facilisis. Aliquam mollis, nulla a vestibulum lacinia, ex magna dignissim tellus, porttitor elementum diam erat eu eros.', '671008491640291082.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `book_type`
--

CREATE TABLE `book_type` (
  `t_id` int(11) NOT NULL,
  `t_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `book_type`
--

INSERT INTO `book_type` (`t_id`, `t_name`) VALUES
(1, 'physics'),
(2, 'human development'),
(3, 'languages'),
(4, 'sport');

-- --------------------------------------------------------

--
-- Table structure for table `make_order`
--

CREATE TABLE `make_order` (
  `o_id` int(11) NOT NULL,
  `b_id` int(11) NOT NULL,
  `u_id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `num_copies` int(11) NOT NULL,
  `order_date` bigint(20) NOT NULL,
  `order_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `make_order`
--

INSERT INTO `make_order` (`o_id`, `b_id`, `u_id`, `price`, `num_copies`, `order_date`, `order_status`) VALUES
(1, 8, 1, 120, 2, 1643497200, 0),
(2, 11, 1, 80, 4, 1643497200, 0),
(3, 4, 1, 490, 7, 1643497200, 0);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `pay_id` int(11) NOT NULL,
  `delivery_date` bigint(20) NOT NULL,
  `o_id` int(11) NOT NULL,
  `payment_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`pay_id`, `delivery_date`, `o_id`, `payment_status`) VALUES
(1, 1643842800, 1, 0),
(2, 1643842800, 2, 0),
(3, 1643842800, 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `title` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `title`) VALUES
(1, 'admin'),
(2, 'customer'),
(3, 'delivery');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `u_id` int(11) NOT NULL,
  `u_name` varchar(50) NOT NULL,
  `u_pass` varchar(80) NOT NULL,
  `u_phone` int(11) NOT NULL,
  `u_email` varchar(50) NOT NULL,
  `u_role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`u_id`, `u_name`, `u_pass`, `u_phone`, `u_email`, `u_role`) VALUES
(1, 'Mahmoud Elshall', '64e1b8d34f425d19e1ee2ea7236d3028', 1144557788, 'admin@admin.com', 1),
(2, 'test user', 'b642b4217b34b1e8d3bd915fc65c4452', 1188557788, 'test@test.com', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`a_id`),
  ADD KEY `u_id` (`u_id`);

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`b_id`),
  ADD KEY `type_id` (`type_id`);

--
-- Indexes for table `book_type`
--
ALTER TABLE `book_type`
  ADD PRIMARY KEY (`t_id`);

--
-- Indexes for table `make_order`
--
ALTER TABLE `make_order`
  ADD PRIMARY KEY (`o_id`),
  ADD KEY `b_id` (`b_id`),
  ADD KEY `u_id` (`u_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`pay_id`),
  ADD KEY `o_id` (`o_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`u_id`),
  ADD KEY `u_role` (`u_role`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `a_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
  MODIFY `b_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `book_type`
--
ALTER TABLE `book_type`
  MODIFY `t_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `make_order`
--
ALTER TABLE `make_order`
  MODIFY `o_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `pay_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `address`
--
ALTER TABLE `address`
  ADD CONSTRAINT `address_ibfk_1` FOREIGN KEY (`u_id`) REFERENCES `user` (`u_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `book`
--
ALTER TABLE `book`
  ADD CONSTRAINT `book_ibfk_1` FOREIGN KEY (`type_id`) REFERENCES `book_type` (`t_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `make_order`
--
ALTER TABLE `make_order`
  ADD CONSTRAINT `make_order_ibfk_1` FOREIGN KEY (`b_id`) REFERENCES `book` (`b_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `make_order_ibfk_2` FOREIGN KEY (`u_id`) REFERENCES `user` (`u_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`o_id`) REFERENCES `make_order` (`o_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`u_role`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
