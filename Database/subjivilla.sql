-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 27, 2025 at 05:52 AM
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
-- Database: `subjivilla`
--

-- --------------------------------------------------------

--
-- Table structure for table `about_us`
--

CREATE TABLE `about_us` (
  `about_id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `trusted` text DEFAULT NULL,
  `professional` text DEFAULT NULL,
  `expert` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `about_us`
--

INSERT INTO `about_us` (`about_id`, `title`, `description`, `image`, `trusted`, `professional`, `expert`) VALUES
(1, 'SubjiVilla', '     Hello, Online family. We are an organization who provides people fresh & organic vegetables & fruits that grown naturally by us. We are 10 people in a team who work together to provide you fresh & clean foods. We want to change a world like green revolution. We want that all people get organic food because that is very beneficial for our health. So we called it \"Organic food revolution\". We are able to provide doorstep delivery of your veggies that purchased from our website. We also mind that plastic harm our environment a lot. So we decided to change paper instead of plastic. We deliver your order in a paper bag. You also have to use less plastic in our daily activity.\r\n                  At last, We care about your health. You can visit our farm given adress below. You can check how we do organic farming. Thank you for visiting our site.', 'uploads/1757829718_about-img.jpg', 'We are authorised & trusted brand who always look for gives you a quality. Your satisfaction must need.', 'Seven members of team working together where all are professional in their field. We doing our best.', 'In term of farming we have also farmers in our team who are professional & very educated in this field.');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `pwd` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `pwd`) VALUES
(1, 'chirag', '25d55ad283aa400af464c76d713c07ad');

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `title`, `description`, `image`) VALUES
(11, 'Cabbage Benefits', '  Cabbage is frequently recommended for people who want to lose weight healthily. Since the vegetable is packed with many beneficial vitamins, minerals, and other nutrients, including water and fiber, it is a healthy dietary option for people looking to eat healthier and shedding pounds. It may also low in calories, containing only 33 calories in a cup of the cooked vegetable.\r\n                           ', '1758174725_blog-img.jpg'),
(12, 'Carrot Benefits', '   For those who wish to improve their diet through skin products, carrots are a wonderful snack. As we all know, they can treat acne, dermatitis, acne, rash, and other skin diseases. In addition to the antioxidant content, they also contain β-carotene. What plays a role in healing? Scars and spots on the skin. Eat more ingredients to get the full nutritional benefits.\r\n                          ', '1758174758_blog-img-02.jpg'),
(13, 'Natural Vegetables Benefits', '   Natural foods usually do not contain toxic substances as they do not use harmful substances like chemicals, pesticides, drugs, preservatives. The body\'s immunity is also strengthened by the consumption of natural food. It tastes better and is considered beneficial for the growing skin. Natural food has higher nutritional content than chemical-rich foods. \r\n                         ', '1758174845_blog-img-01.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `cat_name` varchar(255) NOT NULL,
  `cat_image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `cat_name`, `cat_image`) VALUES
(1, 'Vegetables', '1757845661_1757840628_categories_img_01.jpg'),
(2, 'Fruits', '1757845672_1757840657_fruits354.jpg'),
(3, 'Dry Fruits', '1757845683_1757840668_dryfruits.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `con_id` int(10) NOT NULL,
  `con_fnm` varchar(32) NOT NULL,
  `con_email` varchar(32) NOT NULL,
  `con_sub` varchar(150) DEFAULT NULL,
  `con_message` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`con_id`, `con_fnm`, `con_email`, `con_sub`, `con_message`) VALUES
(11, 'Mahil', 'mahil@gmail.com', 'Fresh Vegetables inquires', 'I would like to know fresh vegetables and fruits are currently availeble.'),
(12, 'Romit', 'romit@gmail.com', 'Fresh Fruits inquires', 'Fresh fruits available.'),
(17, 'Raj', 'raj@gmail.com', 'Vegetables and fruits inquires.', 'vegetables and fruits available.');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `c_id` int(11) NOT NULL,
  `c_username` varchar(32) NOT NULL,
  `c_pwd` varchar(64) NOT NULL,
  `c_email` varchar(32) NOT NULL,
  `c_phone` varchar(32) NOT NULL,
  `c_address` varchar(128) NOT NULL,
  `c_order` varchar(64) NOT NULL,
  `c_status` enum('Pending','Approved','Processing','Rejected','Completed') DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`c_id`, `c_username`, `c_pwd`, `c_email`, `c_phone`, `c_address`, `c_order`, `c_status`) VALUES
(16, 'Mahil', '12345', 'mahil@gmail.com', '9685532325', 'Ahemdabad', '', 'Pending'),
(19, 'Romit', '12345', 'romit@gmail.com', '7875634323', 'Gandhinagar', '', 'Approved'),
(24, 'Raj', '12345', 'raj@gmail.com', '1234512345', 'rajkot', '1761540289339', 'Approved');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `f_id` int(11) NOT NULL,
  `f_name` varchar(255) NOT NULL,
  `f_email` varchar(255) NOT NULL,
  `f_rating` int(1) NOT NULL,
  `f_message` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`f_id`, `f_name`, `f_email`, `f_rating`, `f_message`, `created_at`) VALUES
(9, 'Mahil', 'mahil@gmail.com', 5, 'Greate service', '2025-09-19 22:20:32'),
(10, 'Romit', 'romit@gmail.com', 4, 'Good', '2025-09-19 22:36:34'),
(11, 'Raj', 'raj@gmail.com', 5, 'very fast and good service.', '2025-09-23 22:19:15');

-- --------------------------------------------------------

--
-- Table structure for table `manage_offers`
--

CREATE TABLE `manage_offers` (
  `id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `manage_offers`
--

INSERT INTO `manage_offers` (`id`, `image`) VALUES
(7, 'nature.jpg'),
(8, 'img.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `manage_order_details`
--

CREATE TABLE `manage_order_details` (
  `order_id` int(32) NOT NULL,
  `customer_id` int(32) NOT NULL,
  `product_id` int(32) NOT NULL,
  `order_qty` int(32) NOT NULL,
  `order_price` decimal(10,2) NOT NULL,
  `order_time` datetime NOT NULL DEFAULT current_timestamp(),
  `payment_mode` varchar(50) DEFAULT 'COD',
  `order_batch` varchar(100) NOT NULL,
  `order_status` varchar(50) NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `manage_order_details`
--

INSERT INTO `manage_order_details` (`order_id`, `customer_id`, `product_id`, `order_qty`, `order_price`, `order_time`, `payment_mode`, `order_batch`, `order_status`) VALUES
(47, 0, 37, 2, 0.00, '2025-10-15 22:36:12', 'COD', '', 'Pending'),
(48, 0, 38, 1, 0.00, '2025-10-15 22:36:12', 'COD', '', 'Pending'),
(49, 0, 41, 1, 0.00, '2025-10-15 22:36:12', 'COD', '', 'Pending'),
(50, 0, 38, 1, 0.00, '2025-10-15 22:36:12', 'COD', '', 'Pending'),
(66, 16, 37, 1, 0.00, '2025-10-15 22:36:12', 'COD', '', 'Pending'),
(67, 16, 38, 1, 0.00, '2025-10-15 22:36:12', 'COD', '', 'Pending'),
(68, 16, 41, 1, 0.00, '2025-10-15 22:36:12', 'COD', '', 'Pending'),
(81, 17, 36, 1, 0.00, '2025-10-15 22:36:12', 'COD', '', 'Pending'),
(82, 17, 39, 1, 0.00, '2025-10-15 22:36:12', 'COD', '', 'Pending'),
(83, 17, 49, 1, 0.00, '2025-10-15 22:36:12', 'COD', '', 'Pending'),
(84, 17, 36, 1, 0.00, '2025-10-15 22:36:12', 'COD', '', 'Pending'),
(85, 17, 39, 1, 0.00, '2025-10-15 22:36:12', 'COD', '', 'Pending'),
(86, 17, 49, 1, 0.00, '2025-10-15 22:36:12', 'COD', '', 'Pending'),
(87, 17, 36, 1, 0.00, '2025-10-15 22:36:12', 'COD', '', 'Pending'),
(88, 17, 39, 1, 0.00, '2025-10-15 22:36:12', 'COD', '', 'Pending'),
(89, 17, 49, 1, 0.00, '2025-10-15 22:36:12', 'COD', '', 'Pending'),
(90, 17, 41, 1, 0.00, '2025-10-15 22:36:12', 'COD', '', 'Pending'),
(91, 17, 38, 1, 0.00, '2025-10-15 22:36:12', 'COD', '', 'Pending'),
(92, 17, 50, 1, 0.00, '2025-10-15 22:36:12', 'COD', '', 'Pending'),
(93, 17, 38, 1, 0.00, '2025-10-15 22:36:12', 'COD', '', 'Pending'),
(94, 17, 41, 1, 0.00, '2025-10-15 22:36:12', 'COD', '', 'Pending'),
(95, 17, 44, 1, 0.00, '2025-10-15 22:36:12', 'COD', '', 'Pending'),
(105, 18, 38, 1, 0.00, '2025-10-15 22:36:12', 'COD', '', 'Pending'),
(106, 18, 39, 1, 0.00, '2025-10-15 22:36:12', 'COD', '', 'Pending'),
(107, 18, 52, 1, 0.00, '2025-10-15 22:36:12', 'COD', '', 'Pending'),
(108, 18, 51, 1, 0.00, '2025-10-15 22:36:12', 'COD', '', 'Pending'),
(109, 18, 48, 1, 0.00, '2025-10-15 22:36:12', 'COD', '', 'Pending'),
(110, 18, 61, 1, 0.00, '2025-10-15 22:36:12', 'COD', '', 'Pending'),
(111, 18, 49, 1, 0.00, '2025-10-15 22:36:12', 'COD', '', 'Pending'),
(112, 18, 60, 1, 0.00, '2025-10-15 22:36:12', 'COD', '', 'Pending'),
(113, 18, 72, 1, 0.00, '2025-10-15 22:36:12', 'COD', '', 'Pending'),
(114, 18, 76, 1, 0.00, '2025-10-15 22:36:12', 'COD', '', 'Pending'),
(115, 18, 38, 1, 0.00, '2025-10-15 22:36:12', 'COD', '', 'Pending'),
(116, 18, 39, 1, 0.00, '2025-10-15 22:36:12', 'COD', '', 'Pending'),
(117, 18, 52, 1, 0.00, '2025-10-15 22:36:12', 'COD', '', 'Pending'),
(118, 18, 51, 1, 0.00, '2025-10-15 22:36:12', 'COD', '', 'Pending'),
(119, 18, 48, 1, 0.00, '2025-10-15 22:36:12', 'COD', '', 'Pending'),
(120, 18, 61, 1, 0.00, '2025-10-15 22:36:12', 'COD', '', 'Pending'),
(121, 18, 49, 1, 0.00, '2025-10-15 22:36:12', 'COD', '', 'Pending'),
(122, 18, 60, 1, 0.00, '2025-10-15 22:36:12', 'COD', '', 'Pending'),
(123, 18, 72, 1, 0.00, '2025-10-15 22:36:12', 'COD', '', 'Pending'),
(124, 18, 76, 1, 0.00, '2025-10-15 22:36:12', 'COD', '', 'Pending'),
(125, 19, 37, 1, 0.00, '2025-10-15 22:36:12', 'COD', '', 'Pending'),
(126, 19, 49, 1, 0.00, '2025-10-15 22:36:12', 'COD', '', 'Pending'),
(127, 19, 48, 1, 0.00, '2025-10-15 22:36:12', 'COD', '', 'Pending'),
(128, 19, 58, 1, 0.00, '2025-10-15 22:36:12', 'COD', '', 'Pending'),
(129, 19, 72, 1, 0.00, '2025-10-15 22:36:12', 'COD', '', 'Pending'),
(130, 19, 67, 1, 0.00, '2025-10-15 22:36:12', 'COD', '', 'Pending'),
(131, 19, 85, 1, 0.00, '2025-10-15 22:36:12', 'COD', '', 'Pending'),
(141, 16, 38, 2, 0.00, '2025-10-15 22:36:12', 'COD', '', 'Pending'),
(142, 16, 37, 5, 0.00, '2025-10-15 22:36:12', 'COD', '', 'Pending'),
(143, 16, 37, 5, 0.00, '2025-10-15 22:36:12', 'COD', '', 'Pending'),
(144, 16, 46, 1, 0.00, '2025-10-15 22:36:12', 'COD', '', 'Pending'),
(145, 16, 36, 1, 0.00, '2025-10-15 22:36:12', 'COD', '', 'Pending'),
(146, 16, 36, 4, 0.00, '2025-10-15 22:36:12', 'COD', '', 'Pending'),
(147, 16, 37, 1, 0.00, '2025-10-15 22:36:12', 'COD', '', 'Pending'),
(148, 16, 36, 4, 0.00, '2025-10-15 22:36:12', 'COD', '', 'Pending'),
(149, 16, 37, 1, 0.00, '2025-10-15 22:36:12', 'COD', '', 'Pending'),
(150, 16, 36, 2, 0.00, '2025-10-15 22:36:12', 'COD', '', 'Pending'),
(151, 16, 38, 7, 0.00, '2025-10-15 22:36:12', 'COD', '', 'Pending'),
(152, 16, 61, 4, 0.00, '2025-10-15 22:36:12', 'COD', '', 'Pending'),
(153, 16, 43, 1, 0.00, '2025-10-15 22:36:12', 'COD', '', 'Pending'),
(154, 16, 61, 4, 0.00, '2025-10-15 22:36:12', 'COD', '', 'Pending'),
(155, 16, 43, 1, 0.00, '2025-10-15 22:36:12', 'COD', '', 'Pending'),
(156, 16, 38, 3, 0.00, '2025-10-15 22:36:12', 'COD', '', 'Pending'),
(157, 16, 38, 1, 0.00, '2025-10-15 22:36:12', 'COD', '', 'Pending'),
(158, 16, 38, 1, 0.00, '2025-10-15 22:36:12', 'COD', '', 'Pending'),
(159, 16, 38, 1, 0.00, '2025-10-15 22:36:12', 'COD', '', 'Pending'),
(160, 16, 38, 2, 0.00, '2025-10-15 22:36:12', 'COD', '', 'Pending'),
(161, 16, 38, 2, 0.00, '2025-10-15 22:36:12', 'COD', '', 'Pending'),
(162, 16, 38, 2, 0.00, '2025-10-15 22:36:12', 'COD', '', 'Pending'),
(163, 16, 38, 2, 0.00, '2025-10-15 22:36:12', 'COD', '', 'Pending'),
(164, 16, 38, 1, 0.00, '2025-10-15 22:36:12', 'COD', '', 'Pending'),
(165, 16, 38, 1, 0.00, '2025-10-15 22:36:12', 'COD', '', 'Pending'),
(186, 24, 38, 3, 0.00, '2025-10-17 11:00:46', 'COD', '', 'Pending'),
(187, 24, 37, 1, 0.00, '2025-10-17 11:05:25', 'COD', '', 'Pending'),
(188, 24, 37, 3, 0.00, '2025-10-21 13:02:23', 'COD', '', 'Pending'),
(189, 24, 38, 1, 0.00, '2025-10-21 13:02:23', 'COD', '', 'Pending'),
(190, 24, 52, 1, 0.00, '2025-10-21 13:04:48', 'COD', '', 'Pending'),
(191, 24, 38, 2, 0.00, '2025-10-21 13:10:47', 'COD', '', 'Pending'),
(192, 24, 49, 1, 0.00, '0000-00-00 00:00:00', 'COD', '', 'Pending'),
(193, 24, 37, 5, 0.00, '0000-00-00 00:00:00', 'COD', '', 'Pending'),
(194, 24, 37, 2, 0.00, '0000-00-00 00:00:00', 'COD', '', 'Pending'),
(195, 24, 44, 1, 0.00, '0000-00-00 00:00:00', 'COD', '', 'Pending'),
(196, 24, 41, 1, 0.00, '0000-00-00 00:00:00', 'COD', '', 'Pending'),
(197, 24, 37, 1, 120.00, '2025-10-21 13:41:18', 'COD', '', 'Pending'),
(198, 24, 38, 1, 800.00, '2025-10-21 14:05:52', 'COD', '', 'Pending'),
(199, 24, 41, 1, 1000.00, '2025-10-21 14:08:35', 'COD', '', 'Pending'),
(200, 24, 38, 1, 800.00, '2025-10-21 15:04:21', 'COD', '', 'Pending'),
(201, 24, 38, 1, 800.00, '2025-10-21 00:00:00', 'COD', '', 'Pending'),
(202, 24, 38, 1, 800.00, '2025-10-21 15:16:16', 'COD', '', 'Pending'),
(209, 24, 37, 1, 120.00, '2025-10-27 05:44:49', 'COD', '1761540289339', 'Pending'),
(210, 24, 36, 1, 60.00, '2025-10-27 05:44:49', 'COD', '1761540289339', 'Pending'),
(211, 24, 38, 1, 800.00, '2025-10-27 05:44:49', 'COD', '1761540289339', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `p_id` int(11) NOT NULL,
  `p_name` varchar(64) NOT NULL,
  `p_price` varchar(64) NOT NULL,
  `p_detail` varchar(64) NOT NULL,
  `p_cat` varchar(34) NOT NULL,
  `p_photo` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`p_id`, `p_name`, `p_price`, `p_detail`, `p_cat`, `p_photo`) VALUES
(36, 'Cucumber', '60', '50', 'Vegetables', '1758215085_chibda.jpg'),
(37, 'Mango', '120', '30', 'Fruits', '1758215134_manga.jpg'),
(38, 'Almond', '800', '75', 'Dry Fruits', '1758215210_badam.jpg'),
(39, 'Carrot', '30', '35', 'Vegetables', '1758215407_carrot.jpeg'),
(40, 'Strawberry', '100', '30', 'Fruits', '1758215578_strawbeery.jpeg'),
(41, 'Cashew', '1000', '55', 'Dry Fruits', '1758215838_kaju.jpg'),
(42, 'Bottle Gourd', '50', '48', 'Vegetables', '1758215946_dhudhi.jpg'),
(43, 'Watermelon', '25', '100', 'Fruits', '1758216090_tadbuch.jpg'),
(44, 'Pista', '700', '30', 'Dry Fruits', '1758216224_pishta.jpg'),
(45, 'Tomata', '50', '35', 'vegetables', '1758224165_1758216304_tameta.jpg'),
(46, 'Guava', '100', '25', 'Fruits', '1758216369_jamfala.jpg'),
(47, 'Fig', '500', '30', 'Dry Fruits', '1758217579_anjir.jpg'),
(48, 'Capsicum', '60', '50', 'Vegetables', '1758217677_allchili.jpg'),
(49, 'Cherry', '300', '20', 'Fruits', '1758217748_cheri.jpg'),
(50, 'Raisin', '480', '25', 'Dry Fruits', '1758217837_kishmis.jpg'),
(51, 'Lady\'s Finger', '30', '50', 'Vegetables', '1758218060_bhinda.jpg'),
(52, 'Banana', '50', '30', 'Fruits', '1758218147_banana.jpg'),
(53, 'Walnut', '600', '20', 'Dry Fruits', '1758218245_Walnut.jpeg'),
(54, 'Beetroot', '150', '32', 'Vegetables', '1758218499_bit.jpg'),
(55, 'Sugarcane', '30', '100', 'Fruits', '1758218592_Sugarcane.jpeg'),
(56, 'Dry Dates', '300', '15', 'Dry Fruits', '1758218680_Dry Dates.jpeg'),
(57, 'Ridged Gourd', '65', '30', 'Vegetables', '1758218978_Ridged Gourd.jpeg'),
(58, 'Papaya', '40', '25', 'Fruits', '1758219079_Papaya.jpeg'),
(59, 'Coconut', '340', '30', 'dry fruits', '1758222801_cocunat.jpeg'),
(60, 'Radish', '30', '37', 'Vegetables', '1758219294_mula.jpg'),
(61, 'Jamun', '50', '30', 'Fruits', '1758219379_Jamun.jpeg'),
(62, 'Dates', '325', '15', 'Dry Fruits', '1758219514_Dates.jpeg'),
(63, 'Drumstick', '280', '43', 'Vegetables', '1758219591_sarghava.jpg'),
(64, 'Kiwi', '500', '25', 'Fruits', '1758219696_kiwi.jpg'),
(65, 'Apricot', '700', '50', 'Dry Fruits', '1758219900_Apricot.jpeg'),
(66, 'Potata', '20', '100', 'Vegetables', '1758220336_Potata.jpeg'),
(67, 'Grape', '155', '35', 'Fruits', '1758220556_darsh.jpg'),
(68, 'Brinjal', '30', '40', 'Vegetables', '1758220780_bangan.jpg'),
(69, 'Pineapple', '75', '35', 'Fruits', '1758220983_annanas.jpg'),
(70, 'Spinach', '60', '50', 'Vegetables', '1758221164_Spinach.jpeg'),
(71, 'Lychee', '300', '30', 'Fruits', '1758221321_Lychee.jpeg'),
(72, 'Lemon', '60', '35', 'Vegetables', '1758221512_lemon.jpg'),
(73, 'Sapodilla', '130', '50', 'Fruits', '1758221612_chiku.jpg'),
(75, 'Corn Mais', '50', '50', 'Vegetables', '1758255964_makaye.jpg'),
(76, 'Custard Apple', '120', '35', 'Fruits', '1758256148_Custard Apple.jpeg'),
(77, 'Onion', '20', '150', 'Vegetables', '1758256433_Onion.jpg'),
(78, 'Dragon', '200', '25', 'Fruits', '1758256556_Dragon.jpeg'),
(79, 'Garlic Knofiook', '120', '100', 'Vegetables', '1758256707_alashan.jpg'),
(80, 'Tamarind', '140', '65', 'Fruits', '1758256823_Tamarind.jpeg'),
(81, 'Ginger', '160', '25', 'Vegetables', '1758257075_aadu.jpg'),
(82, 'Raspberry', '700', '30', 'Fruits', '1758257368_Raspberry.jpeg'),
(83, 'Cauliflower', '50', '30', 'Vegetables', '1758257459_flawercobi.jpg'),
(84, 'apple', '200', '50', 'Fruits', '1758257506_apple.jpg'),
(85, 'Cabbage', '30', '35', 'Vegetables', '1758257595_cobi.jpg'),
(86, 'Gooseberry', '280', '25', 'Fruits', '1758257697_amla.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `site_settings`
--

CREATE TABLE `site_settings` (
  `id` int(11) NOT NULL,
  `site_name` varchar(255) NOT NULL,
  `site_logo` varchar(255) NOT NULL,
  `site_url` varchar(255) NOT NULL,
  `fruits_title` varchar(255) NOT NULL,
  `fruits_desc` text NOT NULL,
  `vegetables_title` varchar(255) NOT NULL,
  `vegetables_desc` text NOT NULL,
  `business_time` text DEFAULT NULL,
  `social_google` varchar(255) DEFAULT NULL,
  `social_whatsapp` varchar(255) DEFAULT NULL,
  `social_instagram` varchar(255) DEFAULT NULL,
  `social_twitter` varchar(255) DEFAULT NULL,
  `social_facebook` varchar(255) DEFAULT NULL,
  `about_text` text DEFAULT NULL,
  `contact_address` text DEFAULT NULL,
  `contact_phone` varchar(50) DEFAULT NULL,
  `contact_email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `site_settings`
--

INSERT INTO `site_settings` (`id`, `site_name`, `site_logo`, `site_url`, `fruits_title`, `fruits_desc`, `vegetables_title`, `vegetables_desc`, `business_time`, `social_google`, `social_whatsapp`, `social_instagram`, `social_twitter`, `social_facebook`, `about_text`, `contact_address`, `contact_phone`, `contact_email`) VALUES
(1, 'SubjiVilla Store', 'siteimages/1759050770_subjivilla.png', 'index.php', 'Fruits', 'We are developing green house technology that promotes vegetable plants growth organically that will help for us.', 'Vegetables', 'We always follow organic methods because it\'s good & beneficial for health.', 'Mon - Fri: 8.00am to 5.00pm\r\nSaturday: 8.00am to 8.00pm\r\nSunday: Closed', 'https://google.com', 'https://wa.me/919224242122', 'https://instagram.com/subjivilla', 'https://twitter.com/subjivilla', 'https://facebook.com/subjivilla', 'We are farmers offering fresh organic vegetables. Buy directly from us with home delivery to your doorstep. Your satisfaction is our goal!', 'Behind, Kalawad road, Rajkot, SubjiVilla Farmhouse', '+919224242123', 'subjivilla@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about_us`
--
ALTER TABLE `about_us`
  ADD PRIMARY KEY (`about_id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`con_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`f_id`);

--
-- Indexes for table `manage_offers`
--
ALTER TABLE `manage_offers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `manage_order_details`
--
ALTER TABLE `manage_order_details`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`p_id`);

--
-- Indexes for table `site_settings`
--
ALTER TABLE `site_settings`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about_us`
--
ALTER TABLE `about_us`
  MODIFY `about_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `con_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `f_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `manage_offers`
--
ALTER TABLE `manage_offers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `manage_order_details`
--
ALTER TABLE `manage_order_details`
  MODIFY `order_id` int(32) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=212;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `site_settings`
--
ALTER TABLE `site_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
