-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 20, 2018 at 06:05 PM
-- Server version: 5.7.19
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tradohub`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `cat_id` int(10) NOT NULL AUTO_INCREMENT,
  `cat_title` varchar(255) NOT NULL,
  PRIMARY KEY (`cat_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_title`) VALUES
(1, 'Fruits'),
(2, 'Vegetable'),
(3, 'Dry Fruits');

-- --------------------------------------------------------

--
-- Table structure for table `colors`
--

DROP TABLE IF EXISTS `colors`;
CREATE TABLE IF NOT EXISTS `colors` (
  `color_id` int(10) NOT NULL AUTO_INCREMENT,
  `color_title` varchar(200) NOT NULL,
  PRIMARY KEY (`color_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `colors`
--

INSERT INTO `colors` (`color_id`, `color_title`) VALUES
(1, 'Red'),
(2, 'Orange'),
(3, 'Yellow');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `pro_id` int(10) NOT NULL AUTO_INCREMENT,
  `pro_title` varchar(150) NOT NULL,
  `pro_color` int(10) NOT NULL,
  `pro_size` int(10) NOT NULL,
  `pro_category` int(10) NOT NULL,
  `pro_image` varchar(255) NOT NULL,
  PRIMARY KEY (`pro_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`pro_id`, `pro_title`, `pro_color`, `pro_size`, `pro_category`, `pro_image`) VALUES
(1, 'Orange', 2, 2, 1, 'products/orange.jpg'),
(2, 'Apple', 1, 2, 1, 'products/apple.jpg'),
(3, 'Bananas', 3, 3, 1, 'products/bananas.jpg'),
(4, 'Corns', 3, 3, 2, 'products/corns.jpg'),
(5, 'Tomato', 1, 2, 2, 'products/tomato.jpg'),
(6, 'Carrots', 2, 3, 2, 'products/carrots.jpg'),
(7, 'Apricots', 2, 2, 3, 'products/apricot.jpg'),
(8, 'Red Dates', 1, 1, 3, 'products/red-dates.jpg'),
(9, 'Yellow Raisins', 3, 1, 3, 'products/yellow-raisins.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `sizes`
--

DROP TABLE IF EXISTS `sizes`;
CREATE TABLE IF NOT EXISTS `sizes` (
  `size_id` int(10) NOT NULL AUTO_INCREMENT,
  `size_title` varchar(200) NOT NULL,
  PRIMARY KEY (`size_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sizes`
--

INSERT INTO `sizes` (`size_id`, `size_title`) VALUES
(1, 'Small'),
(2, 'Medium'),
(3, 'Large');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
