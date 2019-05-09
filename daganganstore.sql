-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 25, 2019 at 04:39 PM
-- Server version: 5.7.19
-- PHP Version: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `daganganstore`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`) VALUES
(1, 'Makanan'),
(2, 'Minuman'),
(3, 'Mainan'),
(4, 'Alat Tulis');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_name` text NOT NULL,
  `product_price` int(11) NOT NULL,
  `product_weight` float NOT NULL,
  `product_detail` text NOT NULL,
  `product_stock` int(11) NOT NULL,
  `product_path_image` text NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `product_price`, `product_weight`, `product_detail`, `product_stock`, `product_path_image`, `category_id`) VALUES
(1, 'Coca-Cola', 5700, 1, 'Sebuah minuman bersoda yang mampu memberikan rasa segar ditenggorokan!', 150, 'assets/images/coca_cola.jpg', 2),
(2, 'Pena Metal Ball', 9800, 0, 'Pena ini mampu membuat tulisan di dinding dengan sangat tebal, dia pun juga bisa menulis.', 100, 'assets/images/pena_metal_ball.jpg', 4),
(5, 'Bebek Kuning', 25000, 1, 'Bebek karet yang bisa menemanimu disaat mandi sendirian.', 40, 'assets/images/bebek_kuning.jpg', 3),
(6, 'Cream Cracker', 13100, 1, 'Sebuah kue kering yang bisa mengenyangkan perutmu hingga penuh!', 99, 'assets/images/cream_cracker.jpg', 1),
(7, 'Sprite', 4900, 1, 'Minuman bersoda berasa minum liangteh!', 150, 'assets/images/sprite.jpg', 2),
(8, 'Penghapus Staples', 7000, 0, 'Sebuah penghapus yang bahkan bisa menghapus nasib.', 80, 'assets/images/staples.jpg', 4);

-- --------------------------------------------------------

--
-- Table structure for table `shopping_carts`
--

CREATE TABLE `shopping_carts` (
  `shopping_cart_id` int(11) NOT NULL,
  `quantity_shopping` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shopping_carts`
--

INSERT INTO `shopping_carts` (`shopping_cart_id`, `quantity_shopping`, `user_id`, `product_id`) VALUES
(1, 3, 1, 1),
(2, 1, 1, 2),
(3, 1, 1, 6),
(4, 1, 1, 2),
(5, 1, 1, 2),
(6, 1, 1, 6),
(7, 1, 1, 1),
(8, 1, 1, 6);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `category_id_idx` (`category_id`);

--
-- Indexes for table `shopping_carts`
--
ALTER TABLE `shopping_carts`
  ADD PRIMARY KEY (`shopping_cart_id`),
  ADD KEY `product_id` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `shopping_carts`
--
ALTER TABLE `shopping_carts`
  MODIFY `shopping_cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`);

--
-- Constraints for table `shopping_carts`
--
ALTER TABLE `shopping_carts`
  ADD CONSTRAINT `shopping_carts_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
