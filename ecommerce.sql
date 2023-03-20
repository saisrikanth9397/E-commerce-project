-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 29, 2022 at 06:36 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce`
--

DELIMITER $$
--
-- Procedures
-- procedure Product_delete to delete product based on the product id
CREATE DEFINER=`root`@`localhost` PROCEDURE `Product_delete` (IN `productid` INT)   delete from product where Product_id=productid$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `user_name` varchar(100) NOT NULL,
  `admin_proof` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

-- creating table cart with cart_id and user_id(here user id is from the user_name from the users table)
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `Cart_id` int(11) NOT NULL,
  `User_id` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`Cart_id`, `User_id`) VALUES
(17, 'James'),
(18, 'johnson'),
(19, 'stripur');

-- --------------------------------------------------------

-- cart_item table to store all the products in cart for the particular user
-- Table structure for table `cart_item`
--

CREATE TABLE `cart_item` (
  `cart_item_id` int(11) NOT NULL,
  `cart_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart_item`
--

INSERT INTO `cart_item` (`cart_item_id`, `cart_id`, `product_id`, `quantity`) VALUES
(62, 17, 14, 1),
(63, 17, 8, 1);

--
-- Triggers `cart_item`
-- trigger on cart_item before delete, before update, before insert, to change quntity available on the products table
DELIMITER $$
CREATE TRIGGER `beforeCartItemDelete` AFTER DELETE ON `cart_item` FOR EACH ROW Update product set product_quantity = product_quantity + old.quantity where  Product_id = old.product_id
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `beforeCartItemInsert` BEFORE INSERT ON `cart_item` FOR EACH ROW Update product set product_quantity = product_quantity -new.quantity where  Product_id = new.product_id
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `beforeCartItemUpdate` BEFORE UPDATE ON `cart_item` FOR EACH ROW Update product set product_quantity = product_quantity + old.quantity - new.quantity where  Product_id = old.product_id
$$
DELIMITER ;

-- --------------------------------------------------------

-- creating category table with category id and category name
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `Category_id` int(11) NOT NULL,
  `Category_Name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`Category_id`, `Category_Name`) VALUES
(1, 'Laptops'),
(2, 'Groceries'),
(3, 'Mobiles'),
(4, 'Cloths'),
(8, 'Books');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `user_name` varchar(100) NOT NULL,
  `customer_proof` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`user_name`, `customer_proof`) VALUES
('administrator', ''),
('distributor', 'adsfdd'),
('userdemo', '134675442');

-- --------------------------------------------------------

--
-- Table structure for table `distributor`
--

CREATE TABLE `distributor` (
  `user_name` varchar(100) NOT NULL,
  `distributor_proof` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `order_date` varchar(255) NOT NULL,
  `payment` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `total_price` int(11) NOT NULL,
  `order_status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `order_date`, `payment`, `address`, `total_price`, `order_status`) VALUES
(19, 'James', '11/23/2022 09:46:57 pm', 'Credit card', '417 S Hester', 2679, 'accepted'),
(20, 'James', '11/23/2022 09:49:25 pm', 'Credit card', '417 S Hester', 904, 'accepted'),
(21, 'James', '11/23/2022 09:51:27 pm', 'Credit card', '417 South Hester Apartment no. 4', 4577, 'accepted'),
(22, 'James', '11/23/2022 09:55:27 pm', 'Credit card', '417 S Hester', 977, 'accepted'),
(23, 'johnson', '11/24/2022 10:27:30 pm', 'Credit card', '417 S Hester', 4459, 'accepted'),
(24, 'stripur', '11/26/2022 10:02:05 pm', 'Credit card', 'fsnvjdbdbg', 238, 'accepted');

-- --------------------------------------------------------

-- order_line consists of all the product with respect to the order_id
-- Table structure for table `order_line`
--

CREATE TABLE `order_line` (
  `order_line_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total_price` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_line`
--

INSERT INTO `order_line` (`order_line_id`, `order_id`, `product_name`, `quantity`, `total_price`, `product_id`) VALUES
(13, 19, 'Acer2', 2, 1780, 4),
(14, 19, 'Dell1', 1, 899, 5),
(15, 20, 'Ketchup', 1, 5, 18),
(16, 20, 'Dell1', 1, 899, 5),
(17, 21, 'Harry Potter and the DH', 23, 4577, 23),
(18, 22, '13 pro', 1, 899, 15),
(19, 22, 'shirt', 2, 78, 12),
(20, 23, 'Acer2', 4, 3560, 4),
(21, 23, 'Dell1', 1, 899, 5),
(22, 24, 'shirt', 1, 39, 12),
(23, 24, 'Harry Potter and the DH', 1, 199, 23);

-- trigger on the order_line as the product_available should be decreased
-- Triggers `order_line`
--
DELIMITER $$
CREATE TRIGGER `beforeOrderlineInsert` BEFORE INSERT ON `order_line` FOR EACH ROW Update product set product_quantity = product_quantity -new.quantity where  Product_id = new.product_id
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `Product_id` int(11) NOT NULL,
  `Product_name` varchar(200) NOT NULL,
  `Category_id` int(11) DEFAULT NULL,
  `Product_image` varchar(200) NOT NULL,
  `Price` int(11) NOT NULL,
  `product_quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`Product_id`, `Product_name`, `Category_id`, `Product_image`, `Price`, `product_quantity`) VALUES
(4, 'Acer2', 1, 'Acer2.webp', 890, 47),
(5, 'Dell1', 1, 'dell1.webp', 899, 27),
(6, 'Dell2', 1, 'dell2.webp', 789, 18),
(7, 'Mac', 1, 'mac.jpeg', 1999, 19),
(8, 'MSI', 1, 'MSI.jpeg', 1499, 17),
(9, 'Toshiba', 1, 'toshiba.jpg', 699, 19),
(10, 'Hoodie1', 4, 'shopping3.webp', 34, 0),
(11, 'Hoodie2', 4, 'shopping1.webp', 49, 19),
(12, 'shirt', 4, 'shopping2.webp', 39, 5),
(13, 'Shirt2', 4, 'shopping4.webp', 56, 19),
(14, '14 pro max', 3, '14 pro.webp', 1199, 18),
(15, '13 pro', 3, '13 pro.jpeg', 899, 16),
(16, 'oppo', 3, 'oppo.jpg', 350, 18),
(17, 'Lays', 2, 'Lays.jpeg', 4, 19),
(18, 'Ketchup', 2, 'Ketup.jpeg', 5, 18),
(20, 'Kisses', 2, 'Kisses.jpeg', 11, 18),
(21, 'Oreo', 2, 'Oreo.jpeg', 2, 19),
(22, 'Samsung', 3, 'samsung.jpg', 750, 19),
(23, 'Harry Potter and the DH', 8, 'Harry Potter.jpeg', 199, 3),
(31, 'Oats', 2, 'Oats.jpeg', 5, 19);

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE `profile` (
  `profile_id` int(11) NOT NULL,
  `profile_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`profile_id`, `profile_name`) VALUES
(1, 'customer'),
(2, 'admin'),
(3, 'distributor');

-- --------------------------------------------------------

--
-- Table structure for table `survey`
--

CREATE TABLE `survey` (
  `user_name` varchar(100) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `opinion` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `survey`
--

INSERT INTO `survey` (`user_name`, `subject`, `opinion`) VALUES
('James', 'Product Images', 'Product images are in high quality'),
('James', 'Price', 'price of the products are high');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_name` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL,
  `Mobile` varchar(20) NOT NULL,
  `profile_id` int(11) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_name`, `password`, `email`, `address`, `Mobile`, `profile_id`, `fname`, `lname`) VALUES
('admin', 'password', 'admin@gmail.com', 'qwert', '123222132', 2, '', ''),
('admin2', 'asd', 'adsvasd@efdqwa.com', 'qewrfd', '123221', 2, '', ''),
('admining4', '1234', '', '', '', 3, 'ad4', 'da4'),
('administrator', 'asd', '', '', '', 2, 'admin', 'jjjjj'),
('distributor', 'asd', '', '', '', 3, 'asd', 'qwr'),
('distrubuter', 'asd', 'ama@gmail.com', 'qwerty', '123421', 3, 'amzon', 'aaaa'),
('James', 'asd', 'qewe@fvwd.com', 'wdewsa', '12322', 1, '', ''),
('john', 'asd', 'john.doe@gmail.com', 'hester', '123454321', 1, 'john', 'doe'),
('johnson', 'asdf', 'sfdda', 'esdaw', '21323', 1, 'david', 'johnson'),
('mark', 'asd', 'mark.joe@gmail.com', '', '', 1, 'mark', 'joe'),
('max', 'asd', 'max.sanders@gmail.com', 'qwetre', '123432213', 1, 'Max', 'Sanders'),
('rootuserr', 'asd', 'rootuser@gmail.com', 'qwert', '12343232', 2, 'root', 'user'),
('stripur', '1234', 'stripur@okstate.edu', '417 South Hester, Apartment No 4', '4055644651', 1, 'srinath', 'Tripuraneni'),
('userdemo', 'asd', 'qwert@gmail.com', 'asdf', '1234', 1, 'user', 'demo');

-- --------------------------------------------------------

-- view on users and profile id, to look into list of users with profile_name

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `userslist`  AS SELECT `users`.`user_name` AS `user_name`, `users`.`fname` AS `fname`, `users`.`lname` AS `lname`, `profile`.`profile_name` AS `profile_name`, `users`.`password` AS `password`, `users`.`email` AS `email`, `users`.`address` AS `address`, `users`.`Mobile` AS `Mobile` FROM (`users` join `profile` on(`users`.`profile_id` = `profile`.`profile_id`))  ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_proof`),
  ADD KEY `admin_username_forienkey` (`user_name`);

-- Making cart_id as primary key for cart and user_id as forign key to user table 
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`Cart_id`),
  ADD KEY `ForeignkeyUser` (`User_id`);

-- Making cart_item_id as primary key for cart and cart_id as forign key to cart table and product_id as forign key to product table 
-- Indexes for table `cart_item`
--
ALTER TABLE `cart_item`
  ADD PRIMARY KEY (`cart_item_id`),
  ADD KEY `ForeignkeyProduct` (`product_id`),
  ADD KEY `ForeignkeyCart` (`cart_id`);

-- Making Category_id as primary key for category
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`Category_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_proof`),
  ADD KEY `usernameforignkey` (`user_name`);

--
-- Indexes for table `distributor`
--
ALTER TABLE `distributor`
  ADD PRIMARY KEY (`distributor_proof`),
  ADD KEY `distributor_username_foreign_key` (`user_name`);

-- Making order_id as primary key for orders and user_id as forign key to user table 
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `ForeignkeyUserName` (`user_id`);

--
-- Indexes for table `order_line`
--
ALTER TABLE `order_line`
  ADD PRIMARY KEY (`order_line_id`),
  ADD KEY `ForeignkeyOrder` (`order_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`Product_id`),
  ADD KEY `ForeignkeyCategory` (`Category_id`);

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`profile_id`);

--
-- Indexes for table `survey`
--
ALTER TABLE `survey`
  ADD KEY `unameForiegnKey` (`user_name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_name`),
  ADD KEY `ForeignkeyProfile` (`profile_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `Cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `cart_item`
--
ALTER TABLE `cart_item`
  MODIFY `cart_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `Category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `order_line`
--
ALTER TABLE `order_line`
  MODIFY `order_line_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `Product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `profile`
--
ALTER TABLE `profile`
  MODIFY `profile_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_username_forienkey` FOREIGN KEY (`user_name`) REFERENCES `users` (`user_name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cart`
-- on delete and update, setting cascade for cart users
ALTER TABLE `cart`
  ADD CONSTRAINT `ForeignkeyUser` FOREIGN KEY (`User_id`) REFERENCES `users` (`user_name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cart_item`
-- on delete and update, setting cascade for cart_item cart
-- on delete and update, setting cascade for cart_item product
ALTER TABLE `cart_item`
  ADD CONSTRAINT `ForeignkeyCart` FOREIGN KEY (`cart_id`) REFERENCES `cart` (`Cart_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ForeignkeyProduct` FOREIGN KEY (`product_id`) REFERENCES `product` (`Product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `usernameforignkey` FOREIGN KEY (`user_name`) REFERENCES `users` (`user_name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `distributor`
--
ALTER TABLE `distributor`
  ADD CONSTRAINT `distributor_username_foreign_key` FOREIGN KEY (`user_name`) REFERENCES `users` (`user_name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders`
-- on delete no action for update, setting cascade for orders users
ALTER TABLE `orders`
  ADD CONSTRAINT `ForeignkeyUserName` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_name`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `order_line`
--
ALTER TABLE `order_line`
  ADD CONSTRAINT `ForeignkeyOrder` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`);

--
-- Constraints for table `product`
-- on delete set null for update, setting cascade for product Category_id
ALTER TABLE `product`
  ADD CONSTRAINT `ForeignkeyCategory` FOREIGN KEY (`Category_id`) REFERENCES `category` (`Category_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `survey`
--
ALTER TABLE `survey`
  ADD CONSTRAINT `unameForiegnKey` FOREIGN KEY (`user_name`) REFERENCES `users` (`user_name`);

--
-- Constraints for table `users`
-- on delete and update, setting cascade for users profile
ALTER TABLE `users`
  ADD CONSTRAINT `ForeignkeyProfile` FOREIGN KEY (`profile_id`) REFERENCES `profile` (`profile_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
