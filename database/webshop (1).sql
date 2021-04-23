-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 23, 2021 at 09:34 PM
-- Server version: 5.7.24
-- PHP Version: 7.2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_user`
--

CREATE TABLE `admin_user` (
  `admin_user_id` int(11) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `password_token` varchar(255) DEFAULT NULL,
  `password_changed` timestamp NULL DEFAULT NULL,
  `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin_user`
--

INSERT INTO `admin_user` (`admin_user_id`, `email`, `password`, `password_token`, `password_changed`, `datetime`) VALUES
(1, 'test@test.nl', '$2y$10$3eJXM2NBYpOH8opTNAHVye/uRtxMhWNLS0NX9qpp1WqygPBnX4vjS', '', '2021-02-18 16:06:05', '2021-02-17 15:32:17'),
(2, 'admin@test.nl', '$2y$10$H5YPdNhH8mIb3nfm1wKyxe4BFsnWHQfY9oiRlEFqLWEaMO1Ny9xEa', '', '2021-04-23 16:32:47', '2021-03-09 09:54:25'),
(4, 'ggg@gmail.com', NULL, NULL, NULL, '2021-04-22 13:33:49'),
(5, 'lol@gmail.com', NULL, NULL, NULL, '2021-04-22 13:34:10'),
(6, 'test', NULL, NULL, NULL, '2021-04-22 19:12:29'),
(8, 'kut@gmail.com', NULL, NULL, NULL, '2021-04-22 19:17:29'),
(9, 'testtt@gmail.com', NULL, NULL, NULL, '2021-04-22 19:21:36'),
(10, 'pizza@gmail.com', '$2y$10$o3swWGHfynq/356TofVSa.3DWFZfAaBJM1SYLrXKK86ajBB2apT0G', '', '2021-04-23 18:14:29', '2021-04-23 18:14:06');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `name`, `description`, `active`) VALUES
(1, 'tafellamp', 'Tafellampen zijn binnenlampen voor op tafel.', 1),
(2, 'buitenlamp', 'Tafellampen zijn binnenlampen voor op tafel.', 1),
(3, 'designlamp', 'Tafellampen zijn binnenlampen voor op tafel.', 1),
(4, 'bureaulamp', 'Tafellampen zijn binnenlampen voor op tafel.', 1);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL,
  `gender` set('Man','Vrouw','Transgender','') NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `street` varchar(255) NOT NULL,
  `house_number` int(11) NOT NULL,
  `house_number_addon` varchar(255) DEFAULT NULL,
  `zip_code` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `phone` int(11) NOT NULL,
  `e-mailadres` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `newsletter_subscription` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `gender`, `first_name`, `middle_name`, `last_name`, `street`, `house_number`, `house_number_addon`, `zip_code`, `city`, `phone`, `e-mailadres`, `password`, `newsletter_subscription`) VALUES
(1, 'Man', 'jantjess', 'de', 'Ruiter', 'berenveld', 22, '', '3657YH', 'Utrecht', 615302473, 'daanderuiten@xs4all.nl', 'lol123', 1),
(2, 'Transgender', 'Daan', 'de', 'Ruiter', 'berenveld', 22, '', '3657YH', 'Utrecht', 615302473, 'daanderuiten@xs4all.nl', 'lol123', 1),
(3, 'Transgender', 'Daan', 'de', 'Ruiter', 'berenveld', 22, '', '3657YH', 'Utrecht', 615302473, 'daanderuiten@xs4all.nl', 'lol123', 1),
(4, 'Transgender', 'Daan', 'de', 'Ruiter', 'berenveld', 22, '', '3657YH', 'Utrecht', 615302473, 'daanderuiten@xs4all.nl', 'lol123', 1),
(5, 'Transgender', 'Daan', 'de', 'Ruiter', 'berenveld', 22, '', '3657YH', 'Utrecht', 615302473, 'daanderuiten@xs4all.nl', 'lol123', 1),
(6, 'Man', 'lol', 'lol', 'lol', 'lol', 11, '', '4567TG', 'Utrecht', 615302473, 'lol@gmail.com', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `color` varchar(255) NOT NULL,
  `weight` varchar(255) NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `name`, `description`, `category_id`, `price`, `color`, `weight`, `active`) VALUES
(1, 'Arstid', 'De lampenkap van textiel geeft een zacht en decoratief licht.<br><br>Lichtbron wordt apart verkocht. IKEA adviseert de led-lamp E27 globevorm opaalwit.<br><b>Gebruik een opalen lichtbron als je een gewone lampenkap of lamp hebt en je een gelijkmat', 2, 0, 'black', '300', 1),
(2, 'buitenlamp', 'rie.ffg', 1, 40, 'wit', '300', 1),
(3, 'gans-lamp', 'dadada.ggg', 1, 40, 'wit', '300', 1),
(4, 'giraf-lamp', 'dadada.', 1, 400, 'wit', '300', 0),
(5, 'hektar', 'dadada.', 1, 40, 'wit', '300', 1),
(6, 'jesse', 'dadada.', 1, 40, 'wit', '300', 1),
(7, 'lampje', 'dadada.', 1, 40, 'wit', '300', 1),
(8, 'Ilahra', 'dadada.2', 1, 46, 'wit', '300', 1),
(9, 'struisvogel-lamp', 'dadada.', 2, 40, 'wit', '300', 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_image`
--

CREATE TABLE `product_image` (
  `product_image_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_image`
--

INSERT INTO `product_image` (`product_image_id`, `product_id`, `image`, `active`) VALUES
(1, 1, 'arstid.jpg', 1),
(2, 1, 'arstid.jpg', 1),
(3, 2, 'buitenlamp.jpg', 1),
(4, 3, 'gans-lamp.jpg', 1),
(5, 4, 'giraf-lamp.jpg', 1),
(6, 5, 'hektar.jpg', 1),
(7, 6, 'jesse.jpg', 1),
(8, 7, 'lampje.jpg', 1),
(9, 8, 'Ilahra.jpg', 1),
(10, 9, 'struisvogel-lamp.jpg', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_user`
--
ALTER TABLE `admin_user`
  ADD PRIMARY KEY (`admin_user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `product_image`
--
ALTER TABLE `product_image`
  ADD PRIMARY KEY (`product_image_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_user`
--
ALTER TABLE `admin_user`
  MODIFY `admin_user_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `product_image`
--
ALTER TABLE `product_image`
  MODIFY `product_image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
