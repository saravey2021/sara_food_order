-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 22, 2021 at 07:16 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sara_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `category_id` int(10) UNSIGNED NOT NULL,
  `image_name` text NOT NULL,
  `title` text NOT NULL,
  `featured` varchar(20) NOT NULL,
  `active` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`category_id`, `image_name`, `title`, `featured`, `active`) VALUES
(23, 'Food_category_814.jpg', 'Pizza dkk', 'Yes', 'Yes'),
(25, 'Food_category_473.jpg', 'hjhkjlkjh', 'Yes', 'Yes'),
(26, 'Food_category_303.jpg', 'Hot dog', 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_post`
--

CREATE TABLE `tbl_post` (
  `post_id` int(10) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_name` text NOT NULL,
  `featured` varchar(20) NOT NULL,
  `active` varchar(20) NOT NULL,
  `post_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_post`
--

INSERT INTO `tbl_post` (`post_id`, `category_id`, `title`, `description`, `price`, `image_name`, `featured`, `active`, `post_date`) VALUES
(44, 23, 'ស្ងោបន្លែ', 'គ្រឿងផ្សំ - ស្លឹក​ខ្ទឹម​​ ១មួយគម្ព - ម្ទេស ១ឬ ២ផ្លែ - ក្រូច​ឆ្មា​១ផ្លែ - ត្រី​ ៤០០ក្រាម - គល់​ស្លឹកគ្រៃ ១គុល - បន្ថែម​អង្ករ​កន្លះ​ស្លាព្រាកាហ្វេ - ស្លឹកក្រូចសើច រំដេង - ស្ករសរ​ ២​ស្លាព្រាកាហ្វ ', '4.00', 'Food-Name-9743.jpg', 'Yes', 'Yes', '2021-08-21'),
(50, 22, 'somlor kako', 'jhniijbggbj', '2.00', 'Food-Name-8060.jpg', 'Yes', 'Yes', '2021-08-22'),
(51, 23, 'FOOD gage', 'mfksdlfjslldksfkmdfljkdkflljsdm', '3.00', 'Food-Name-3166.jpg', 'Yes', 'Yes', '2021-08-22');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `user_id` int(11) NOT NULL,
  `image_user` varchar(100) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `image_user`, `full_name`, `username`, `password`) VALUES
(2, '', 'Sara Vey', 'Sara', '6074c6aa3488f3c2dddff2a7ca821aab');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `tbl_post`
--
ALTER TABLE `tbl_post`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `category_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `tbl_post`
--
ALTER TABLE `tbl_post`
  MODIFY `post_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
