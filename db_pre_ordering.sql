-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 11, 2018 at 01:52 PM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_pre_ordering`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `category_id` int(11) NOT NULL,
  `category` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`category_id`, `category`) VALUES
(1, 'Bread'),
(2, 'Sauce'),
(3, 'Sandwich Type'),
(4, 'Cheese'),
(5, 'Veggies');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_orders`
--

CREATE TABLE `tbl_orders` (
  `order_id` int(11) NOT NULL,
  `product_id` varchar(100) NOT NULL,
  `total` decimal(11,2) NOT NULL,
  `cart_id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_orders`
--

INSERT INTO `tbl_orders` (`order_id`, `product_id`, `total`, `cart_id`, `name`, `date`) VALUES
(29, '7,8,9,10,11,12,14,17,6', '536.20', '201808115b6ec77a8929c', 'Victor Magtanggol', '2018-08-10 16:00:00'),
(30, '1,7,9,10,14,16', '423.50', '201808115b6ec78ddeb7e', 'Mekeni Mekeni', '2018-08-10 16:00:00'),
(31, '7,9,2,5,14,6', '400.50', '201808115b6ec7a1354d1', 'Juan Dela Cruz', '2018-08-10 16:00:00'),
(32, '1,7,9,10,2', '536.00', '201808115b6ec7e11fbd4', 'Justin Bieber', '2018-08-10 16:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_products`
--

CREATE TABLE `tbl_products` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `category_id` int(11) NOT NULL,
  `price` decimal(11,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_products`
--

INSERT INTO `tbl_products` (`product_id`, `product_name`, `category_id`, `price`) VALUES
(1, 'Whole Wheat', 1, '250.00'),
(2, 'Turkey Bacon Club', 3, '215.00'),
(4, 'Mayo', 2, '100.00'),
(5, 'American', 4, '55.25'),
(6, 'Cucumber', 5, '49.75'),
(7, 'Italian Herb', 1, '29.00'),
(8, 'Japaleno Parmesan', 1, '99.95'),
(9, 'Mustard', 2, '16.00'),
(10, 'Honey Mustard', 2, '26.00'),
(11, 'Oven Toasted Turkey', 3, '125.00'),
(12, 'Savory Ham', 3, '115.00'),
(13, 'Spicy Mayo', 2, '77.00'),
(14, 'Swiss', 4, '35.50'),
(15, 'Lettuce', 5, '26.00'),
(16, 'Spinach', 5, '67.00'),
(17, 'PepperJack', 4, '40.00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `tbl_orders`
--
ALTER TABLE `tbl_orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `tbl_products`
--
ALTER TABLE `tbl_products`
  ADD PRIMARY KEY (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tbl_orders`
--
ALTER TABLE `tbl_orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT for table `tbl_products`
--
ALTER TABLE `tbl_products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
