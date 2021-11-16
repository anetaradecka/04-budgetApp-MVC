-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 16, 2021 at 07:31 PM
-- Server version: 8.0.27
-- PHP Version: 7.3.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `anetarad_budgetapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `expense_category_assigned_to_user` int NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `expense_date` date NOT NULL,
  `payment_method_assigned_to_user` int NOT NULL,
  `comment` varchar(100) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_polish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `expense_category_assigned_to_user`
--

CREATE TABLE `expense_category_assigned_to_user` (
  `user_id` int NOT NULL,
  `expense_category_id` int NOT NULL,
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `has_limit` tinyint(1) NOT NULL DEFAULT '0',
  `expense_limit` decimal(10,2) NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `expense_category_assigned_to_user`
--

INSERT INTO `expense_category_assigned_to_user` (`user_id`, `expense_category_id`, `name`, `has_limit`, `expense_limit`) VALUES
(50, 146, 'groceries', 0, 0.00),
(50, 147, 'home & bills', 0, 0.00),
(50, 148, 'car', 0, 0.00),
(50, 149, 'phone & Internet', 0, 0.00),
(50, 150, 'health care', 0, 0.00),
(50, 151, 'clothes', 0, 0.00),
(50, 152, 'beauty', 0, 0.00),
(50, 153, 'kids', 0, 0.00),
(50, 154, 'entertainment', 0, 0.00),
(50, 155, 'travels', 0, 0.00),
(50, 156, 'education', 0, 0.00),
(50, 157, 'savings', 0, 0.00),
(50, 158, 'debts', 0, 0.00),
(50, 159, 'books', 0, 0.00),
(50, 160, 'pension', 0, 0.00),
(50, 161, 'charity', 0, 0.00),
(50, 162, 'other expenses', 0, 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `expense_category_default`
--

CREATE TABLE `expense_category_default` (
  `id` int NOT NULL,
  `name` text CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `has_limit` tinyint(1) NOT NULL DEFAULT '0',
  `expense_limit` decimal(10,2) NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `expense_category_default`
--

INSERT INTO `expense_category_default` (`id`, `name`, `has_limit`, `expense_limit`) VALUES
(1, 'groceries', 0, 0.00),
(2, 'home & bills', 0, 0.00),
(3, 'car', 0, 0.00),
(4, 'phone & Internet', 0, 0.00),
(5, 'health care', 0, 0.00),
(6, 'clothes', 0, 0.00),
(7, 'beauty', 0, 0.00),
(8, 'kids', 0, 0.00),
(9, 'entertainment', 0, 0.00),
(10, 'travels', 0, 0.00),
(11, 'education', 0, 0.00),
(12, 'savings', 0, 0.00),
(13, 'debts', 0, 0.00),
(14, 'books', 0, 0.00),
(15, 'pension', 0, 0.00),
(16, 'charity', 0, 0.00),
(17, 'other expenses', 0, 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `payment_method_assigned_to_user`
--

CREATE TABLE `payment_method_assigned_to_user` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `payment_method_id` int NOT NULL,
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `payment_method_assigned_to_user`
--

INSERT INTO `payment_method_assigned_to_user` (`id`, `user_id`, `payment_method_id`, `name`) VALUES
(133, 50, 1, 'cash'),
(134, 50, 2, 'debit card'),
(135, 50, 3, 'credit card'),
(136, 50, 4, 'BLIK');

-- --------------------------------------------------------

--
-- Table structure for table `payment_method_default`
--

CREATE TABLE `payment_method_default` (
  `id` int NOT NULL,
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `payment_method_default`
--

INSERT INTO `payment_method_default` (`id`, `name`) VALUES
(1, 'cash'),
(2, 'debit card'),
(3, 'credit card'),
(4, 'BLIK');

-- --------------------------------------------------------

--
-- Table structure for table `revenues`
--

CREATE TABLE `revenues` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `revenue_category_assigned_to_user` int NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `revenue_date` date NOT NULL,
  `comment` varchar(100) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_polish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `revenue_category_assigned_to_user`
--

CREATE TABLE `revenue_category_assigned_to_user` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `revenue_category_id` int NOT NULL,
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `revenue_category_assigned_to_user`
--

INSERT INTO `revenue_category_assigned_to_user` (`id`, `user_id`, `revenue_category_id`, `name`) VALUES
(64, 50, 1, 'Salary'),
(65, 50, 2, 'Passive income'),
(66, 50, 3, 'Investments'),
(67, 50, 4, 'Pension'),
(68, 50, 5, 'Other revenues');

-- --------------------------------------------------------

--
-- Table structure for table `revenue_category_default`
--

CREATE TABLE `revenue_category_default` (
  `id` int NOT NULL,
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `revenue_category_default`
--

INSERT INTO `revenue_category_default` (`id`, `name`) VALUES
(1, 'Salary'),
(2, 'Passive income'),
(3, 'Investments'),
(4, 'Pension'),
(5, 'Other revenues');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` text CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `password` text CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(50, 'swinka', '$2y$10$gBV6EZMr1B7gLts2E4RxT.AO7ZsxuLxLkvdLhMd/3COacrabblfke');

--
-- Triggers `users`
--
DELIMITER $$
CREATE TRIGGER `INSERT DEFAULT EXPENSE CATEGORIES` AFTER INSERT ON `users` FOR EACH ROW INSERT INTO `expense_category_assigned_to_user` (user_id, name, has_limit, expense_limit) SELECT NEW.id, name, has_limit, expense_limit FROM `expense_category_default`
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `INSERT DEFAULT PAYMENT METHODS` AFTER INSERT ON `users` FOR EACH ROW INSERT INTO `payment_method_assigned_to_user` (user_id, payment_method_id, name) SELECT NEW.id, id, name FROM `payment_method_default`
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `INSERT DEFAULT REVENUE CATEGORIES` AFTER INSERT ON `users` FOR EACH ROW INSERT INTO `revenue_category_assigned_to_user` (user_id, revenue_category_id, name) SELECT NEW.id, id, name FROM `revenue_category_default`
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expense_category_assigned_to_user`
--
ALTER TABLE `expense_category_assigned_to_user`
  ADD PRIMARY KEY (`expense_category_id`);

--
-- Indexes for table `expense_category_default`
--
ALTER TABLE `expense_category_default`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_method_assigned_to_user`
--
ALTER TABLE `payment_method_assigned_to_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_method_default`
--
ALTER TABLE `payment_method_default`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `revenues`
--
ALTER TABLE `revenues`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `revenue_category_assigned_to_user`
--
ALTER TABLE `revenue_category_assigned_to_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `revenue_category_default`
--
ALTER TABLE `revenue_category_default`
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
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `expense_category_assigned_to_user`
--
ALTER TABLE `expense_category_assigned_to_user`
  MODIFY `expense_category_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=177;

--
-- AUTO_INCREMENT for table `expense_category_default`
--
ALTER TABLE `expense_category_default`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `payment_method_assigned_to_user`
--
ALTER TABLE `payment_method_assigned_to_user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=140;

--
-- AUTO_INCREMENT for table `payment_method_default`
--
ALTER TABLE `payment_method_default`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `revenues`
--
ALTER TABLE `revenues`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `revenue_category_assigned_to_user`
--
ALTER TABLE `revenue_category_assigned_to_user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `revenue_category_default`
--
ALTER TABLE `revenue_category_default`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
