-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 09, 2021 at 08:16 PM
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

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`id`, `user_id`, `expense_category_assigned_to_user`, `amount`, `expense_date`, `payment_method_assigned_to_user`, `comment`) VALUES
(1, 27, 3, 100.00, '2021-08-25', 2, ''),
(2, 1, 2, 125.00, '2021-08-10', 2, ''),
(3, 1, 2, 55.00, '2021-07-14', 2, ''),
(6, 27, 4, 70.00, '2021-09-01', 2, 'Internet'),
(7, 27, 3, 121.00, '2021-08-17', 3, 'Oopsie'),
(8, 27, 14, 100.00, '2021-08-25', 1, 'BOOKS BOOKS'),
(10, 27, 1, 100.00, '2021-10-15', 1, ''),
(11, 27, 1, 350.49, '2021-10-22', 2, 'Test expense'),
(12, 38, 1, 570.00, '2021-08-17', 58, 'Popo'),
(13, 38, 1, 100.00, '2021-08-31', 57, 'test');

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
(38, 1, 'limitowany expense', 1, 700.00),
(38, 2, 'home & bills', 0, 0.00),
(44, 3, 'car', 0, 0.00),
(44, 7, 'beauty', 0, 0.00),
(44, 12, 'savings', 0, 0.00),
(44, 15, 'pension', 0, 0.00);

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
(57, 38, 0, 'BLIK'),
(58, 38, 0, 'cash');

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

--
-- Dumping data for table `revenues`
--

INSERT INTO `revenues` (`id`, `user_id`, `revenue_category_assigned_to_user`, `amount`, `revenue_date`, `comment`) VALUES
(3, 27, 2, 350.00, '2021-08-04', 'Shop'),
(4, 6, 2, 1000.00, '2021-08-18', 'z sierpnia'),
(5, 6, 2, 500.00, '2021-09-15', 'z wrzesnia'),
(6, 6, 3, 55.00, '2021-08-05', ''),
(7, 27, 4, 400.00, '2021-09-08', ''),
(8, 6, 2, 100.00, '2021-09-11', ''),
(9, 14, 4, 350.00, '2021-09-01', ''),
(11, 27, 4, 56.00, '2021-08-24', '1200 PLUS'),
(12, 27, 1, 350.00, '2021-10-15', ''),
(13, 27, 1, 123.00, '2021-08-05', 'GAGAGA'),
(14, 27, 3, 56.00, '2021-10-21', 'KO KO KO !'),
(15, 27, 2, 49.22, '2021-10-22', 'Test income');

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
(1, 38, 1, 'Salary'),
(13, 38, 2, 'Passive income'),
(14, 38, 4, 'Pension');

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
(18, 'dingo', '$2y$10$pfssixtndYJMWk7Z25kC0OaDgYs7ZmNLDIfp1qDIzG107jvhjrDc6'),
(19, 'franek', '$2y$10$IkPU4Lr4kcFk5.9S3g3aL.3P2JyluREWpwdI.30VITHPnMIzrjLkO'),
(21, 'harry', '$2y$10$mkA3Vsg.qbFG07f4TwR3pecIoLGcaXa3eBkRwGerVX.Jqu2ASisFm'),
(26, 'kokosza', '$2y$10$fWuq/f4yTaz5BSm7sUIsYu5rBBBd/K5MMkMl0Ce5YwwHpDV8GsEWu'),
(27, 'programista', '$2y$10$NmuKODn3aS6qO6Yf3v5ycO.fkVjT8HyfRahUQ4Uw9eCf2vv58E9yS'),
(29, 'papuga', '$2y$10$BEFpJ5tlS/so87o/ICuPfOIsGmNdvhfSrXzNo8HOCiFsc1shRd4rq'),
(38, 'swinka', '$2y$10$qGDpC8F4U2qQNOTGDpC2cu6vtWP2z4nJwkz7lml5pVBz2Ys8T4BzS');

--
-- Triggers `users`
--
DELIMITER $$
CREATE TRIGGER `INSERT DEFAULT EXPENSE CATEGORIES` AFTER INSERT ON `users` FOR EACH ROW INSERT INTO `expenses_category_assigned_to_user` (user_id, expense_category_id, name, has_limit, expense_limit) SELECT NEW.id, id, name, has_limit, expense_limit FROM `expense_category_default`
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `INSERT DEFAULT PAYMENT METHODS` AFTER INSERT ON `users` FOR EACH ROW INSERT INTO `payment_method_assigned_to_user` (user_id, payment_method_id, name) SELECT NEW.id, id, name FROM `payment_method_default`
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `INSERT DEFAULT REVENUE CATEGORIES` AFTER INSERT ON `users` FOR EACH ROW INSERT INTO `revenue_categories_assigned_to_user` (user_id, revenue_category_id, name) SELECT NEW.id, id, name FROM `revenue_category_default`
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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `expense_category_assigned_to_user`
--
ALTER TABLE `expense_category_assigned_to_user`
  MODIFY `expense_category_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `expense_category_default`
--
ALTER TABLE `expense_category_default`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `payment_method_assigned_to_user`
--
ALTER TABLE `payment_method_assigned_to_user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `payment_method_default`
--
ALTER TABLE `payment_method_default`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `revenues`
--
ALTER TABLE `revenues`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `revenue_category_assigned_to_user`
--
ALTER TABLE `revenue_category_assigned_to_user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `revenue_category_default`
--
ALTER TABLE `revenue_category_default`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
