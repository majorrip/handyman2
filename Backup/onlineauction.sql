-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 25, 2024 at 02:00 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `onlineauction`
--

-- --------------------------------------------------------

--
-- Table structure for table `bidding`
--

CREATE TABLE `bidding` (
  `bidding_id` int(10) NOT NULL,
  `customer_id` int(10) NOT NULL,
  `product_id` int(10) NOT NULL,
  `bidding_amount` float(10,2) NOT NULL,
  `bidding_date_time` datetime NOT NULL,
  `note` text NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `bidding`
--

INSERT INTO `bidding` (`bidding_id`, `customer_id`, `product_id`, `bidding_amount`, `bidding_date_time`, `note`, `status`) VALUES
(3247, 37, 189, 25.00, '2024-10-22 03:59:37', '', 'Active'),
(3248, 37, 189, 50.00, '2024-10-24 03:21:55', '', 'Active'),
(3249, 39, 192, 25.00, '2024-10-24 18:43:01', '', 'Active'),
(3250, 37, 192, 50.00, '2024-10-25 05:20:02', '', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `billing`
--

CREATE TABLE `billing` (
  `billing_id` int(10) NOT NULL,
  `customer_id` int(10) NOT NULL,
  `product_id` int(10) NOT NULL,
  `purchase_date` date NOT NULL,
  `purchase_amount` float(10,2) NOT NULL,
  `payment_type` varchar(20) NOT NULL,
  `card_type` varchar(50) NOT NULL,
  `card_number` varchar(20) NOT NULL,
  `expire_date` date NOT NULL,
  `cvv_number` varchar(5) NOT NULL,
  `card_holder` varchar(50) NOT NULL,
  `delivery_date` date NOT NULL,
  `note` text NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `billing`
--

INSERT INTO `billing` (`billing_id`, `customer_id`, `product_id`, `purchase_date`, `purchase_amount`, `payment_type`, `card_type`, `card_number`, `expire_date`, `cvv_number`, `card_holder`, `delivery_date`, `note`, `status`) VALUES
(1359, 37, 0, '2024-10-22', 500.00, 'Deposit', 'Debit Card', '12345678889', '2024-12-01', '1212', 'dsdadas', '0000-00-00', '', 'Active'),
(1360, 37, 190, '2024-10-24', 100.00, 'Sell', 'Debit Card', '1234567890111111', '2024-11-01', '233', 'dsdadas', '0000-00-00', '', 'Active'),
(1361, 38, 192, '2024-10-24', 100.00, 'Sell', 'Debit Card', '1214343443111111', '0000-00-00', '232', 'WALY', '0000-00-00', '', 'Active'),
(1362, 39, 0, '2024-10-24', 100.00, 'Deposit', 'Credit card', '1214343443', '0000-00-00', '212', 'atif', '0000-00-00', '', 'Active'),
(1363, 37, 195, '2024-10-25', 100.00, 'Sell', 'Credit card', '', '0000-00-00', '', '', '0000-00-00', '', 'Active'),
(1364, 37, 195, '2024-10-25', 100.00, 'Sell', 'Bkash', '', '0000-00-00', '', '', '0000-00-00', '', 'Active'),
(1365, 37, 196, '2024-10-25', 100.00, 'Sell', 'Nagad', '01795422429', '2024-10-01', '3232', 'dsdadas', '0000-00-00', '', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(10) NOT NULL,
  `category_name` varchar(50) NOT NULL,
  `category_icon` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `category_icon`, `description`, `status`) VALUES
(16548, 'Electricians', 'Electrician.jpg', 'Electrician', 'Active'),
(16549, 'Plumber', 'Plumber.jpg', 'Plumber', 'Active'),
(16550, 'Wood Worker', 'woodworker.jpg', 'Wood Worker', 'Active'),
(16551, 'Gardener', 'Garden.jpg', 'Gardener', 'Active'),
(16552, 'Maid', 'maid.jpg', 'Maid', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(10) NOT NULL,
  `customer_role` varchar(500) NOT NULL,
  `customer_fname` varchar(50) NOT NULL,
  `customer_lname` varchar(50) NOT NULL,
  `email_id` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `state` varchar(25) NOT NULL,
  `city` varchar(25) NOT NULL,
  `landmark` varchar(50) NOT NULL,
  `pincode` varchar(6) NOT NULL,
  `mobile_no` varchar(15) NOT NULL,
  `note` text NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `customer_role`, `customer_fname`, `customer_lname`, `email_id`, `password`, `address`, `state`, `city`, `landmark`, `pincode`, `mobile_no`, `note`, `status`) VALUES
(2, 'Service Man', 'John Wick', '', 'john@example.com', '123456789', 'Address', 'Dhaka', '', '', '1234', '12367343', '', 'Active'),
(7, 'Customer', 'emily cooper', '', 'emily@example.com', '123456789', 'Address', 'Dhaka', '', '', '1234', '12`5661254', '', 'Active'),
(37, 'Service Man', 'Atif', 'Karim', 'atifkarim@example.com', '123456789', 'dsdsddsdsd\r\nCantonment', 'Dhaka', 'Dhaka', 'sasasasa', '1206', '01795422429', '', 'Active'),
(38, 'Customer', 'Waly', 'Khan', 'waly@khan.com', '123456789', 'sgdghsjdghdgsjh', 'Dhaka', 'dhaka', 'dfdffgdf', '1206', '01795422429', '', 'Active'),
(39, 'Service Man', 'Abu', 'Jafar', 'atifkarim0@gmail.com', '123456789', 'dsfsdfsdf', 'Dhaka', 'dhaka', 'fdffdfd', '1221', '01795422429', '', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `employee_id` int(10) NOT NULL,
  `employee_name` varchar(50) NOT NULL,
  `login_id` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `employee_type` varchar(50) NOT NULL,
  `status` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`employee_id`, `employee_name`, `login_id`, `password`, `employee_type`, `status`) VALUES
(1, 'Administrator', 'admin', 'admin', 'Admin', 'Active'),
(5, 'Employee', 'employee', 'employee', 'Employee', 'Active'),
(6, 'Employee1', 'employee1', 'employee1', 'Employee', 'Active'),
(7, 'Employee three', 'employeethree', 'employee123', 'Employee', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `message_id` int(10) NOT NULL,
  `sender_id` int(10) NOT NULL,
  `receiver_id` int(10) NOT NULL,
  `message_date_time` datetime NOT NULL,
  `product_id` int(10) NOT NULL,
  `message` text NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`message_id`, `sender_id`, `receiver_id`, `message_date_time`, `product_id`, `message`, `status`) VALUES
(39, 0, 0, '2024-10-24 03:22:38', 0, 'hello there!\n', 'Seller'),
(40, 39, 38, '2024-10-24 18:41:57', 192, 'hello wally\n', 'Customer'),
(41, 39, 38, '2024-10-24 18:42:24', 192, 'hello if you want 450 taka\n', 'Customer');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_id` int(10) NOT NULL,
  `customer_id` int(10) NOT NULL,
  `payment_type` varchar(50) NOT NULL,
  `product_id` int(10) NOT NULL,
  `bidding_id` int(10) NOT NULL,
  `paid_amount` float(10,2) NOT NULL,
  `paid_date` date NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`payment_id`, `customer_id`, `payment_type`, `product_id`, `bidding_id`, `paid_amount`, `paid_date`, `status`) VALUES
(239, 23, 'Bid', 148, 3239, 18.00, '2020-03-05', 'Active'),
(240, 23, 'Bid', 148, 3240, 18.00, '2020-03-05', 'Active'),
(241, 23, 'Bid', 148, 3241, 19.00, '2020-03-05', 'Active'),
(242, 23, 'Bid', 148, 3242, 19.00, '2020-03-05', 'Active'),
(243, 23, 'Bid', 148, 3243, 20.00, '2020-03-05', 'Active'),
(244, 28, 'Bid', 156, 3244, 0.25, '2020-08-27', 'Active'),
(245, 31, 'Bid', 158, 3245, 0.12, '2021-04-05', 'Active'),
(246, 2, 'Bid', 158, 3246, 0.15, '2021-05-09', 'Active'),
(247, 37, 'Bid', 189, 3247, 30.00, '2024-10-22', 'Active'),
(248, 37, 'Bid', 189, 3248, 55.00, '2024-10-24', 'Active'),
(249, 39, 'Bid', 192, 3249, 0.25, '2024-10-24', 'Active'),
(250, 37, 'Bid', 192, 3250, 0.50, '2024-10-25', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(10) NOT NULL,
  `customer_id` int(10) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `category_id` int(10) NOT NULL,
  `product_description` text NOT NULL,
  `starting_bid` float(10,2) NOT NULL,
  `ending_bid` float(10,2) NOT NULL,
  `start_date_time` datetime NOT NULL,
  `end_date_time` datetime NOT NULL,
  `product_cost` float(10,2) NOT NULL,
  `product_image` text NOT NULL,
  `product_warranty` varchar(100) NOT NULL,
  `product_delivery` text NOT NULL,
  `company_name` varchar(100) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `customer_id`, `product_name`, `category_id`, `product_description`, `starting_bid`, `ending_bid`, `start_date_time`, `end_date_time`, `product_cost`, `product_image`, `product_warranty`, `product_delivery`, `company_name`, `status`) VALUES
(189, 0, 'Mains Electricity Provider', 16548, 'Mains fixer', 0.00, 50.00, '2024-10-22 03:40:00', '2024-10-26 03:40:00', 5000.00, '1867601514OIP.jpg', '', '3-4 Days', 'saifcompany', 'Active'),
(190, 37, 'My Pipe Broke', 16549, 'My pipe broke please come fast', 10.00, 0.00, '2024-10-24 03:38:00', '2024-10-25 03:38:00', 500.00, 'a:1:{i:0;s:18:\"1591333278pipe.jpg\";}', '', '3-4 Days', '340/1 Nkaf dhaka', 'Active'),
(191, 37, 'I need someone to build me a bed', 16550, 'I can not sleep pls come to my house over the weekend to build me a bed', 10.00, 10.00, '2024-10-25 03:46:00', '2024-10-27 03:46:00', 5000.00, 'a:1:{i:0;s:17:\"1071361271bed.jpg\";}', '', '3-4 Days', '340/1 Nkaf dhaka', 'Pending'),
(192, 38, 'Plant Mango Tree ', 16551, 'I want someone skilled to plant in my mango tree', 1.00, 50.00, '2024-10-24 18:28:00', '2024-10-25 18:28:00', 500.00, 'a:1:{i:0;s:23:\"1154364091images-30.jpg\";}', '', '3-4 Days', 'bashundhara', 'Active'),
(193, 37, 'maid needed', 16552, 'there was a party', 10.00, 10.00, '2024-10-25 03:23:00', '2024-10-26 03:23:00', 500.00, 'a:1:{i:0;s:20:\"1428112897partys.jpg\";}', '', 'Instant Delivery', '340/1 Nkaf dhaka', 'Pending'),
(194, 37, 'maid needed', 16552, 'there was a party', 10.00, 10.00, '2024-10-25 03:23:00', '2024-10-26 03:23:00', 500.00, 'a:1:{i:0;s:19:\"597993922partys.jpg\";}', '', 'Instant Delivery', '340/1 Nkaf dhaka', 'Pending'),
(195, 37, 'maid needed', 16552, 'there was a party', 10.00, 10.00, '2024-10-25 03:23:00', '2024-10-26 03:23:00', 500.00, 'a:1:{i:0;s:20:\"1291362019partys.jpg\";}', '', 'Instant Delivery', '340/1 Nkaf dhaka', 'Active'),
(196, 37, 'My tap Broke', 16548, 'Tap is broken', 10.00, 10.00, '2024-10-25 04:14:00', '2024-10-26 04:14:00', 500.00, 'a:1:{i:0;s:55:\"1962417554close-leak-ruin-valve-old-600nw-205724125.jpg\";}', '', 'Instant Delivery', '340/1 Nkaf dhaka', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `webconfig`
--

CREATE TABLE `webconfig` (
  `webconfig_id` int(11) NOT NULL,
  `web_title` varchar(50) NOT NULL,
  `web_tagline` varchar(100) NOT NULL,
  `web_logo` varchar(255) NOT NULL,
  `favicon_logo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `webconfig`
--

INSERT INTO `webconfig` (`webconfig_id`, `web_title`, `web_tagline`, `web_logo`, `favicon_logo`) VALUES
(3, 'HANDY MAN', 'Online Service Bidding Website', 'img/1729551563logo_footer.png', 'img/1639226264online-auction.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `webpage`
--

CREATE TABLE `webpage` (
  `webpage_id` int(11) NOT NULL,
  `webpage_link` varchar(50) NOT NULL,
  `webpage_title` varchar(150) NOT NULL,
  `webpage_description` text NOT NULL,
  `webpage_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `webpage`
--

INSERT INTO `webpage` (`webpage_id`, `webpage_link`, `webpage_title`, `webpage_description`, `webpage_image`) VALUES
(1, 'about-us.php', 'About Handyman SERVICE Auction System', '<p>Welcome to HANDY MAN, your go-to platform for affordable, high-quality service providers across the country! Whether you&#39;re looking for electricians, plumbers, mechanics, or home improvement experts, our service bidding platform offers a unique opportunity for customers to get the best service at the most competitive rates.</p>\n\n<p>ServiceBid is proudly owned and operated by industry professionals from the western region of India, bringing you a trusted and risk-free marketplace. Since our first successful auction on December 1st, 2019, we have grown to become India&#39;s No.1 Service Bidding platform, with over 20,000 registered users.</p>\n\n<p>We have redefined the way people find and hire skilled professionals, making the process fun, efficient, and cost-effective!</p>\n\n<p>&nbsp;</p>\n\n<p>&nbsp;</p>\n\n<p>&nbsp;</p>\n\n<p>&nbsp;</p>\n', 'img/1639228920images.png');

-- --------------------------------------------------------

--
-- Table structure for table `winners`
--

CREATE TABLE `winners` (
  `winner_id` int(10) NOT NULL,
  `product_id` int(10) NOT NULL,
  `customer_id` int(10) NOT NULL,
  `winners_image` varchar(100) NOT NULL,
  `winning_bid` float(10,2) NOT NULL,
  `end_date` date NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bidding`
--
ALTER TABLE `bidding`
  ADD PRIMARY KEY (`bidding_id`);

--
-- Indexes for table `billing`
--
ALTER TABLE `billing`
  ADD PRIMARY KEY (`billing_id`);

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
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`employee_id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`message_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `webconfig`
--
ALTER TABLE `webconfig`
  ADD PRIMARY KEY (`webconfig_id`);

--
-- Indexes for table `webpage`
--
ALTER TABLE `webpage`
  ADD PRIMARY KEY (`webpage_id`);

--
-- Indexes for table `winners`
--
ALTER TABLE `winners`
  ADD PRIMARY KEY (`winner_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bidding`
--
ALTER TABLE `bidding`
  MODIFY `bidding_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3251;

--
-- AUTO_INCREMENT for table `billing`
--
ALTER TABLE `billing`
  MODIFY `billing_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1366;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16562;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `employee_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `message_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=251;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=197;

--
-- AUTO_INCREMENT for table `webconfig`
--
ALTER TABLE `webconfig`
  MODIFY `webconfig_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `webpage`
--
ALTER TABLE `webpage`
  MODIFY `webpage_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `winners`
--
ALTER TABLE `winners`
  MODIFY `winner_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
