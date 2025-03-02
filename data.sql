-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 25, 2025 at 01:51 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";
/*!40101 SET NAMES utf8mb4 */;
DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `AddCategory` (IN `p_name` VARCHAR(100), IN `p_slug` VARCHAR(100), IN `p_description` TEXT)   BEGIN
    INSERT INTO tbl_category (name, slug, description)
    VALUES (p_name, p_slug, p_description);
END$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `AuthenticateAdmin` (IN `p_username` VARCHAR(255), IN `p_password` VARCHAR(255), OUT `p_result` INT)   BEGIN
    DECLARE user_count INT;
    SELECT COUNT(*) INTO user_count
    FROM tbl_admin
    WHERE username = p_username AND password = p_password;
    IF user_count > 0 THEN
        SET p_result = 1; 
    ELSE
        SET p_result = 0;
    END IF;
END$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `CreateProduct` (IN `p_categoryID` INT, IN `p_productName` VARCHAR(255), IN `p_price` DECIMAL(10,2), IN `p_description` TEXT, IN `p_image_path` VARCHAR(255))   BEGIN
    INSERT INTO tbl_product (categoryID, productName, price, description, image_path)
    VALUES (p_categoryID, p_productName, p_price, p_description, p_image_path);
END$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `DeleteCategory` (IN `p_id` INT)   BEGIN
    DELETE FROM tbl_category WHERE id = p_id;
END$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `DeleteProduct` (IN `p_productID` INT)   BEGIN
    DELETE FROM tbl_product
    WHERE productID = p_productID;
END$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `GetAdminData` (IN `p_adminID` INT)   BEGIN
    SELECT * 
    FROM tbl_admin
    WHERE adminID = p_adminID;
END$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `GetAllProducts` ()   BEGIN
    SELECT *
    FROM tbl_product
    ORDER BY created_at DESC;
END$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `GetCategories` ()   BEGIN
    SELECT * FROM tbl_category ORDER BY name ASC;
END$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `GetProductById` (IN `p_productID` INT)   BEGIN
    SELECT *
    FROM tbl_product
    WHERE productID = p_productID;
END$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `UpdateAdminProfile` (IN `p_adminID` INT, IN `p_username` VARCHAR(255), IN `p_email` VARCHAR(255), IN `p_img` LONGBLOB)   BEGIN
    IF p_img IS NOT NULL THEN
        UPDATE tbl_admin
        SET username = p_username, gmail = p_email, img = p_img
        WHERE adminID = p_adminID;
    ELSE
        UPDATE tbl_admin
        SET username = p_username, gmail = p_email
        WHERE adminID = p_adminID;
    END IF;
END$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `UpdateCategory` (IN `p_id` INT, IN `p_name` VARCHAR(100), IN `p_slug` VARCHAR(100), IN `p_description` TEXT)   BEGIN
    UPDATE tbl_category 
    SET name = p_name, slug = p_slug, description = p_description
    WHERE id = p_id;
END$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `UpdateProduct` (IN `p_productID` INT, IN `p_categoryID` INT, IN `p_productName` VARCHAR(255), IN `p_price` DECIMAL(10,2), IN `p_description` TEXT, IN `p_image_path` VARCHAR(255))   BEGIN
    UPDATE tbl_product
    SET categoryID = p_categoryID,
        productName = p_productName,
        price = p_price,
        description = p_description,
        image_path = p_image_path,
        updated_at = CURRENT_TIMESTAMP
    WHERE productID = p_productID;
END$$
DELIMITER ;
CREATE TABLE `tbl_category` (
  `categoryID` int(11) NOT NULL,
  `catName` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
INSERT INTO `tbl_category` (`categoryID`, `catName`, `slug`, `description`, `created_at`) VALUES
(1, 'Women', 'women', 'Women fashion and accessories', '2025-02-19 08:05:07'),
(2, 'Men', 'men', 'Men clothing and accessories', '2025-02-19 08:05:07'),
(3, 'Bag', 'bag', 'Various types of bags', '2025-02-19 08:05:07'),
(4, 'Shoes', 'shoes', 'Footwear for all genders', '2025-02-19 08:05:07'),
(5, 'Watches', 'watches', 'Branded and stylish watches', '2025-02-19 08:05:07');
CREATE TABLE `tbl_product` (
  `productID` int(11) NOT NULL,
  `categoryID` int(11) DEFAULT NULL,
  `productName` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `description` varchar(30) DEFAULT NULL,
  `image_path` varchar(255) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `catName` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
INSERT INTO `tbl_product` (`productID`, `categoryID`, `productName`, `price`, `description`, `image_path`, `updated_at`, `created_at`, `catName`) VALUES
(1, 2, 'Men', 10.00, 'test', 'upload/image/67b86c6910664_product-11.jpg', '2025-02-21 12:26:24', '2025-02-21 12:26:37', 'Men'),
(2, 1, 'opo', 98.00, 'opo', 'upload/image/67b87242e4440_product-05.jpg', '2025-02-21 12:51:07', '2025-02-21 12:32:02', 'Women'),
(3, 1, 'Women2', 67.00, 'women', 'upload/image/67b8726220f15_product-04.jpg', '2025-02-21 12:51:16', '2025-02-21 12:32:34', 'Women'),
(4, 1, 'Women4', 77.00, 'women', 'upload/image/67b8727bebca7_product-07.jpg', '2025-02-21 12:51:23', '2025-02-21 12:32:59', 'Women');
CREATE TABLE `tbl_slider` (
  `slider_id` int(11) NOT NULL,
  `slider_title` varchar(255) DEFAULT NULL,
  `slider_subtitle` varchar(255) DEFAULT NULL,
  `slider_image` varchar(255) DEFAULT NULL,
  `slider_link` varchar(255) DEFAULT NULL,
  `slider_status` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
INSERT INTO `tbl_slider` (`slider_id`, `slider_title`, `slider_subtitle`, `slider_image`, `slider_link`, `slider_status`) VALUES
(1, 'NEW SEASON', 'Women Collection 2018', './assets/images/slide-01.jpg', 'shop', 1),
(2, 'Jackets & Coats', 'Men New-Season', './assets/images/slide-02.jpg', 'shop', 1),
(3, 'New arrivals', 'Men Collection 2018', './assets/images/slide-03.jpg', 'shop', 1);

ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`categoryID`),
  ADD UNIQUE KEY `name` (`catName`),
  ADD UNIQUE KEY `slug` (`slug`);
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`productID`),
  ADD KEY `categoryID` (`categoryID`);
ALTER TABLE `tbl_slider`
  ADD PRIMARY KEY (`slider_id`);
ALTER TABLE `tbl_admin`
  MODIFY `adminID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
ALTER TABLE `tbl_category`
  MODIFY `categoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

ALTER TABLE `tbl_product`
  MODIFY `productID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
ALTER TABLE `tbl_slider`
  MODIFY `slider_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
ALTER TABLE `tbl_product`
  ADD CONSTRAINT `tbl_product_ibfk_1` FOREIGN KEY (`categoryID`) REFERENCES `tbl_category` (`categoryID`) ON DELETE CASCADE;
COMMIT;

