-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 23, 2024 at 10:01 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `real_estate_listing_platform`
--

-- --------------------------------------------------------

--
-- Table structure for table `agents`
--

CREATE TABLE `agents` (
  `agent_id` int(11) NOT NULL,
  `agent_name` varchar(100) NOT NULL,
  `agency_name` varchar(255) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `phone_number` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `agents`
--

INSERT INTO `agents` (`agent_id`, `agent_name`, `agency_name`, `email`, `phone_number`) VALUES
(1, 'jeanclaude', 'MUSANZE Realty', 'john@gmail.com', '+250734567890'),
(2, 'Jane NDUWIMAN', 'XYZ Realty', 'jane@gmail.com', '+250787654321'),
(3, 'KWISANGA', 'Real Estate Com.', 'agentx@gmail.com', '+1250797659111'),
(4, 'RUKUNDO', 'BNVCB', 'hj@gmail.com', '9866473544'),
(5, 'MUHOZ', 'ABCD campany', 'ffff@gmail.com', '078453627');

-- --------------------------------------------------------

--
-- Table structure for table `buyer`
--

CREATE TABLE `buyer` (
  `buyer_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `budget` decimal(15,2) DEFAULT NULL,
  `preferences` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `buyer`
--

INSERT INTO `buyer` (`buyer_id`, `user_id`, `budget`, `preferences`) VALUES
(11, 205, 300000.00, 'Looking for a family-friendly neighborhood with good schools.'),
(12, 206, 400000.00, 'Interested in properties with modern amenities and open floor plans.'),
(13, 207, 250000.00, 'Prefer properties with a large backyard for gardening.'),
(14, 207, 350000.00, 'Seeking a property with easy access to public transportation.'),
(15, 208, 500000.00, 'Interested in historic homes with architectural charm.'),
(16, 205, 300000.00, 'Looking for a family-friendly neighborhood with good schools.'),
(17, 206, 400000.00, 'Interested in properties with modern amenities and open floor plans.'),
(18, 207, 250000.00, 'Prefer properties with a large backyard for gardening.'),
(19, 208, 350000.00, 'Seeking a property with easy access to public transportation.'),
(20, 209, 500000.00, 'Interested in historic homes with architectural charm.');

-- --------------------------------------------------------

--
-- Table structure for table `imagesgallery`
--

CREATE TABLE `imagesgallery` (
  `image_id` int(11) NOT NULL,
  `listing_id` int(11) DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `imagesgallery`
--

INSERT INTO `imagesgallery` (`image_id`, `listing_id`, `image_url`) VALUES
(11, 4, 'https://imege.com/image1.jpg'),
(12, 5, 'https://image.com/image2.jpg'),
(13, 6, 'https://image.com/image3.jpg'),
(14, 5, 'http:image.com/image4.jpg'),
(15, 6, 'http:image.com/image5.jpg'),
(16, 5, 'http:image.com/image5.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `inquiries`
--

CREATE TABLE `inquiries` (
  `inquiry_id` int(11) NOT NULL,
  `listing_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `inquiry_date` date DEFAULT NULL,
  `message` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inquiries`
--

INSERT INTO `inquiries` (`inquiry_id`, `listing_id`, `user_id`, `inquiry_date`, `message`) VALUES
(6, 4, 205, '2024-05-01', 'I am interested in this property. Can I schedule a viewing?'),
(7, 5, 206, '2024-05-02', 'Could you provide more details about the amenities of this property?'),
(8, 6, 207, '2024-05-03', 'Is the price negotiable for this listing?'),
(9, 7, 208, '2024-05-15', 'i am happy');

-- --------------------------------------------------------

--
-- Table structure for table `listings`
--

CREATE TABLE `listings` (
  `listing_id` int(11) NOT NULL,
  `property_id` int(11) DEFAULT NULL,
  `agent_id` int(11) DEFAULT NULL,
  `list_date` date DEFAULT NULL,
  `status` enum('active','pending','sold') DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `listings`
--

INSERT INTO `listings` (`listing_id`, `property_id`, `agent_id`, `list_date`, `status`) VALUES
(4, 1, 1, '0000-00-00', 'active'),
(5, 2, 2, '2024-05-05', 'pending'),
(6, 3, 3, '2024-05-06', 'active'),
(7, 4, 2, '2024-05-01', 'active'),
(8, 5, 3, '2024-05-06', 'sold');

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `location_id` int(11) NOT NULL,
  `country` varchar(255) NOT NULL,
  `province` varchar(255) DEFAULT NULL,
  `latitude` decimal(10,8) DEFAULT NULL,
  `longitude` decimal(11,8) DEFAULT NULL,
  `region` varchar(255) DEFAULT NULL,
  `neighborhood` varchar(255) DEFAULT NULL,
  `street_address` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`location_id`, `country`, `province`, `latitude`, `longitude`, `region`, `neighborhood`, `street_address`) VALUES
(1, 'RWANDA', 'NORTHERN', 34.05223500, -118.24368300, 'Southern California', 'RUBAVU district', '123 Main St'),
(2, 'RWANDA', 'SOUTHERN', 37.77492900, -122.41941600, 'Northern California', 'KAMONYI District', '456 Elm St'),
(3, 'UNITED STATE', 'New York', 40.71277600, -74.00597400, 'New York Metro Area', 'Midtown', '789 Broadway'),
(4, 'ENGLAND', 'England', 51.50735100, -0.12775800, 'Greater London', 'Westminster', '10 Downing Street'),
(5, 'FRANCE', 'Île-de-France', 48.85661300, 2.35222200, 'Île-de-France', 'Le Marais', '15 Rue du Louvre'),
(6, 'BURUNDI', NULL, 32.54627280, 1.43526200, 'KAYANZA', 'NYARUGURU', '23 KAYANZA'),
(7, 'KENYA', '0', 31.67770000, 0.43526200, 'KUYU', 'RUBYIRO', '23 KAYANZA');

-- --------------------------------------------------------

--
-- Table structure for table `properties`
--

CREATE TABLE `properties` (
  `property_id` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `price` decimal(15,2) NOT NULL,
  `size` decimal(10,2) NOT NULL,
  `bedrooms` int(11) NOT NULL,
  `bathrooms` int(11) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `properties`
--

INSERT INTO `properties` (`property_id`, `address`, `price`, `size`, `bedrooms`, `bathrooms`, `description`) VALUES
(1, '123 Main St', 250000.00, 2000.00, 3, 2, 'Beautiful family home in a quiet neighborhood.'),
(2, '456 Elm St', 350000.00, 3000.00, 4, 3, 'Spacious modern house with a large backyard.'),
(3, '789 Oak St', 400000.00, 2500.00, 3, 3, 'Cozy cottage-style home with a fireplace.'),
(4, '234tr', 444444552.00, 56.00, 12, 1, 'wesdfsh'),
(5, 'musanze', 454345.00, 34543.00, 23, 3, 'beautiful hanneymoon');

-- --------------------------------------------------------

--
-- Table structure for table `seller`
--

CREATE TABLE `seller` (
  `seller_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `property_id` int(11) DEFAULT NULL,
  `listing_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `seller`
--

INSERT INTO `seller` (`seller_id`, `user_id`, `property_id`, `listing_id`) VALUES
(18, 205, 1, 4),
(19, 206, 2, 5),
(20, 207, 3, 6);

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `transaction_id` int(11) NOT NULL,
  `listing_id` int(11) DEFAULT NULL,
  `buyer_id` int(11) DEFAULT NULL,
  `seller_id` int(11) DEFAULT NULL,
  `transaction_date` date DEFAULT NULL,
  `amount` decimal(15,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`transaction_id`, `listing_id`, `buyer_id`, `seller_id`, `transaction_date`, `amount`) VALUES
(19, 4, 11, 18, '2024-05-04', 250000.00),
(20, 5, 12, 19, '2024-05-05', 350000.00),
(21, 6, 13, 20, '2024-05-06', 400000.00),
(22, 7, 14, 20, '2024-05-06', 457778899.00),
(23, 8, 15, 20, '2024-05-01', 233333.00);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `firstname`, `lastname`, `email`, `username`, `password`) VALUES
(1, 'muhire', 'keza', 'hj@gmail.com', 'murara', '$2y$10$rlfSW/wLQIc2gVs40DJPd.CeU8WuwjLrNG7P9hIx8lNfH10LTYkLm'),
(2, 'claude', 'ht', 'ndayisengajeanclaude8888@gmail.com', 'hiro', '$2y$10$rex/C4DBeMqM2.aJ0aocPOQOcEa/qOp09e2Sbm749olwC2gPANkCK'),
(3, 'kasha', 'uwiyo', 'j@gmail.com', 'jean', '$2y$10$TXrx/k/9XpTIyjB/.5K6TehWuAWXldVQVX52mzJo06bzuJuRdRqc.'),
(4, 'muhire', 'keza', 'rty@gmail.com', 'shaid', '$2y$10$gg/7Wk1STctxDIpz1OugNeltBYjn7gJtbnzGj/C2xcSdRmbeiH6YW');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `role` enum('buyer','seller','agent') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `email`, `phone_number`, `role`) VALUES
(205, 'karangwa_john', 'password123', 'john@gmail.com', '+250723456780', 'buyer'),
(206, 'jeannine', 'jeanpwd456', 'jane@gmail.com', '+250786543210', 'seller'),
(207, 'agent1', 'agentpwd1', 'agent1@gmail.com', '+250711111111', 'agent'),
(208, 'user4', 'user4pwd', 'user4@gmail.com', '+250798844444', 'buyer'),
(209, 'user5', 'user5pwd', 'user5@gmail.com', '+250786548555', 'buyer');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agents`
--
ALTER TABLE `agents`
  ADD PRIMARY KEY (`agent_id`);

--
-- Indexes for table `buyer`
--
ALTER TABLE `buyer`
  ADD PRIMARY KEY (`buyer_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `imagesgallery`
--
ALTER TABLE `imagesgallery`
  ADD PRIMARY KEY (`image_id`),
  ADD KEY `listing_id` (`listing_id`);

--
-- Indexes for table `inquiries`
--
ALTER TABLE `inquiries`
  ADD PRIMARY KEY (`inquiry_id`),
  ADD KEY `listing_id` (`listing_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `listings`
--
ALTER TABLE `listings`
  ADD PRIMARY KEY (`listing_id`),
  ADD KEY `property_id` (`property_id`),
  ADD KEY `agent_id` (`agent_id`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`location_id`);

--
-- Indexes for table `properties`
--
ALTER TABLE `properties`
  ADD PRIMARY KEY (`property_id`);

--
-- Indexes for table `seller`
--
ALTER TABLE `seller`
  ADD PRIMARY KEY (`seller_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `property_id` (`property_id`),
  ADD KEY `listing_id` (`listing_id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`transaction_id`),
  ADD KEY `listing_id` (`listing_id`),
  ADD KEY `buyer_id` (`buyer_id`),
  ADD KEY `seller_id` (`seller_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agents`
--
ALTER TABLE `agents`
  MODIFY `agent_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `buyer`
--
ALTER TABLE `buyer`
  MODIFY `buyer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `imagesgallery`
--
ALTER TABLE `imagesgallery`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `inquiries`
--
ALTER TABLE `inquiries`
  MODIFY `inquiry_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `listings`
--
ALTER TABLE `listings`
  MODIFY `listing_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `location_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `properties`
--
ALTER TABLE `properties`
  MODIFY `property_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `seller`
--
ALTER TABLE `seller`
  MODIFY `seller_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=210;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `buyer`
--
ALTER TABLE `buyer`
  ADD CONSTRAINT `buyer_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `imagesgallery`
--
ALTER TABLE `imagesgallery`
  ADD CONSTRAINT `imagesgallery_ibfk_1` FOREIGN KEY (`listing_id`) REFERENCES `listings` (`listing_id`);

--
-- Constraints for table `inquiries`
--
ALTER TABLE `inquiries`
  ADD CONSTRAINT `inquiries_ibfk_1` FOREIGN KEY (`listing_id`) REFERENCES `listings` (`listing_id`),
  ADD CONSTRAINT `inquiries_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `listings`
--
ALTER TABLE `listings`
  ADD CONSTRAINT `listings_ibfk_1` FOREIGN KEY (`property_id`) REFERENCES `properties` (`property_id`),
  ADD CONSTRAINT `listings_ibfk_2` FOREIGN KEY (`agent_id`) REFERENCES `agents` (`agent_id`);

--
-- Constraints for table `seller`
--
ALTER TABLE `seller`
  ADD CONSTRAINT `seller_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `seller_ibfk_2` FOREIGN KEY (`property_id`) REFERENCES `properties` (`property_id`),
  ADD CONSTRAINT `seller_ibfk_3` FOREIGN KEY (`listing_id`) REFERENCES `listings` (`listing_id`);

--
-- Constraints for table `transaction`
--
ALTER TABLE `transaction`
  ADD CONSTRAINT `transaction_ibfk_1` FOREIGN KEY (`listing_id`) REFERENCES `listings` (`listing_id`),
  ADD CONSTRAINT `transaction_ibfk_2` FOREIGN KEY (`buyer_id`) REFERENCES `buyer` (`buyer_id`),
  ADD CONSTRAINT `transaction_ibfk_3` FOREIGN KEY (`seller_id`) REFERENCES `seller` (`seller_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
