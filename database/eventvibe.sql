-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 16, 2024 at 07:47 AM
-- Server version: 5.7.36
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eventvibe`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
CREATE TABLE IF NOT EXISTS `cart` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `user_id` int(100) NOT NULL,
  `pid` int(100) NOT NULL,
  `event_type` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `pid`, `event_type`) VALUES
(34, 19, 3, 'premium'),
(33, 17, 10, 'basic'),
(32, 2, 2, 'basic');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

DROP TABLE IF EXISTS `message`;
CREATE TABLE IF NOT EXISTS `message` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `message` varchar(500) NOT NULL,
  `planner_id` int(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `user_id`, `name`, `email`, `number`, `message`, `planner_id`) VALUES
(2, 2, 'kamal', 'user2@ka.com', '0712356741', 'This is message for planners 4 from user 2', 4),
(3, 2, 'kamal', 'user2@ka.com', '0712356741', 'This is message for planners 1 from user 2', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `email` varchar(100) NOT NULL,
  `method` varchar(50) NOT NULL,
  `address` varchar(500) NOT NULL,
  `event_date` varchar(100) NOT NULL,
  `participants` int(11) NOT NULL,
  `total_products` int(10) NOT NULL,
  `total_price` int(100) NOT NULL,
  `placed_on` varchar(50) NOT NULL,
  `payment_status` varchar(20) NOT NULL DEFAULT 'pending',
  `planner_id` int(100) NOT NULL,
  `pid` int(11) NOT NULL,
  `package` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `name`, `number`, `email`, `method`, `address`, `event_date`, `participants`, `total_products`, `total_price`, `placed_on`, `payment_status`, `planner_id`, `pid`, `package`) VALUES
(6, 3, 'kushan', '0714249784', 'user3@ka.com', 'online', '105,kurunegala', '', 0, 1, 500, '2022/08/09', 'completed', 1, 0, ''),
(8, 3, 'kushan', '0714249784', 'user3@ka.com', 'online', '105,kurunegala', '', 0, 1, 1000, '2022/08/09', 'pending', 1, 0, ''),
(4, 3, 'kushan', '0714249784', 'user3@ka.com', 'online', '105,kurunegala', '', 0, 1, 500, '2022/08/09', 'completed', 4, 0, ''),
(5, 3, 'kushan', '0714249784', 'user3@ka.com', 'online', '105,kurunegala', '', 0, 1, 500, '2022/08/09', 'pending', 4, 0, ''),
(9, 2, 'kushan', '0714212369', 'user2@ka.com', 'after event', '105, nisshanka mawatha, malkaduwawa, kurunegala', '2023-04-05', 100, 1, 20000, '21-Mar-2023', 'pending', 1, 0, ''),
(10, 2, 'kapila', '0712323655', 'user2@ka.com', 'after event', '399, ilawatha road, narammala, kurunegala', '2023-05-06', 200, 1, 10002, '21-Mar-2023', 'pending', 1, 27, 'premium'),
(11, 2, 'manethra', '714249784', 'user2@ka.com', 'after event', '105, kumal mawatha, wehera, kurunegala', '2023-04-06', 450, 1, 20000, '21-Mar-2023', 'pending', 7, 2, 'premium'),
(12, 2, 'manethra', '714249784', 'user2@ka.com', 'after event', 'dda, sda, asdas, asd', '2222-03-03', 444, 2, 56900, '21-Mar-2023', 'pending', 1, 5, 'basic'),
(13, 2, 'manethra', '714249784', 'user2@ka.com', 'after event', 'qqs, sq, qs2q, qsqs', '1111-02-21', 90, 3, 30000, '03-Nov-2023', 'pending', 7, 2, 'basic');

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

DROP TABLE IF EXISTS `packages`;
CREATE TABLE IF NOT EXISTS `packages` (
  `package_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `type` varchar(1000) NOT NULL,
  `price` int(11) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `includes` varchar(1000) NOT NULL,
  `have` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`package_id`)
) ENGINE=MyISAM AUTO_INCREMENT=59 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`package_id`, `product_id`, `type`, `price`, `description`, `includes`, `have`) VALUES
(20, 2, 'basic', 4000, 'In this package i only take care of the decorations', 'Custom decor design,Rental items,Setup and takedown\r\n', 1),
(19, 27, 'premium', 10000, 'In this package i take care of the decorations,music and foods', 'Custom decor design,Rental items,Setup and takedown,dj music,smoke,fireworks,welcome drink,foods', 1),
(17, 27, 'basic', 6000, 'In this package i only take care of the decorations', 'Custom decor design,Rental items,Setup and takedown', 1),
(18, 27, 'standard', 9000, 'In this package i only take care of the decorations and music', 'Custom decor design,Rental items,Setup and takedown,dj music,smoke,fireworks', 1),
(14, 26, 'basic', 9000, 'In this package i only take care of the decorations', 'Custom decor design,Rental items,Setup and takedown', 1),
(15, 26, 'standard', 12000, 'In this package i only take care of the decorations and music', 'Custom decor design,Rental items,Setup and takedown,dj music,smoke,fireworks', 1),
(16, 26, 'premium', 20000, 'In this package i take care of the decorations,music and foods', 'Custom decor design,Rental items,Setup and takedown,dj music,smoke,fireworks,welcome drink,foods', 1),
(21, 2, 'standard', 12000, 'In this package i only take care of the decorations and music', 'Custom decor design,Rental items,Setup and takedown,dj music,smoke,fireworks', 1),
(22, 2, 'premium', 20000, 'In this package i take care of the decorations,music and foods', 'Custom decor design,Rental items,Setup and takedown,dj music,smoke,fireworks,welcome drink,foods', 1),
(23, 3, 'basic', 7500, 'In this package i only take care of the decorations', 'Custom decor design,Rental items,Setup and takedown\r\n', 1),
(24, 3, 'standard', 15000, 'In this package i only take care of the decorations and music', 'Custom decor design,Rental items,Setup and takedown,dj music,smoke,fireworks', 1),
(25, 3, 'premium', 30000, 'In this package i take care of the decorations,music and foods', 'Custom decor design,Rental items,Setup and takedown,dj music,smoke,fireworks,welcome drink,foods', 1),
(26, 5, 'basic', 6900, 'In this package i only take care of the decorations', 'Custom decor design,Rental items,Setup and takedown\r\n', 1),
(27, 5, 'standard', 14000, 'In this package i only take care of the decorations and music', 'Custom decor design,Rental items,Setup and takedown,dj music,smoke,fireworks', 1),
(28, 5, 'premium', 18000, 'In this package i take care of the decorations,music and foods', 'Custom decor design,Rental items,Setup and takedown,dj music,smoke,fireworks,welcome drink,foods', 1),
(29, 6, 'basic', 8000, 'In this package i only take care of the decorations', 'Custom decor design,Rental items,Setup and takedown\r\n', 1),
(30, 6, 'standard', 23000, 'In this package i only take care of the decorations and music', 'Custom decor design,Rental items,Setup and takedown,dj music,smoke,fireworks', 1),
(31, 6, 'premium', 40000, 'In this package i take care of the decorations,music and foods', 'Custom decor design,Rental items,Setup and takedown,dj music,smoke,fireworks,welcome drink,foods', 1),
(32, 4, 'basic', 7500, 'In this package i only take care of the decorations', 'Custom decor design,Rental items,Setup and takedown\r\n', 1),
(33, 4, 'standard', 12000, 'In this package i only take care of the decorations and music', 'Custom decor design,Rental items,Setup and takedown,dj music,smoke,fireworks', 1),
(34, 4, 'premium', 16000, 'In this package i take care of the decorations,music and foods', 'Custom decor design,Rental items,Setup and takedown,dj music,smoke,fireworks,welcome drink,foods', 1),
(35, 7, 'basic', 20000, 'In this package i only take care of the decorations', 'Custom decor design,Rental items,Setup and takedown\r\n', 1),
(36, 7, 'standard', 40000, 'In this package i only take care of the decorations and music', 'Custom decor design,Rental items,Setup and takedown,dj music,smoke,fireworks', 1),
(37, 7, 'premium', 120000, 'In this package i take care of the decorations,music and foods', 'Custom decor design,Rental items,Setup and takedown,dj music,smoke,fireworks,welcome drink,foods', 1),
(38, 8, 'basic', 25000, 'In this package i only take care of the decorations', 'Custom decor design,Rental items,Setup and takedown\r\n', 1),
(39, 8, 'standard', 75000, 'In this package i only take care of the decorations and music', 'Custom decor design,Rental items,Setup and takedown,dj music,smoke,fireworks', 1),
(40, 8, 'premium', 250000, 'In this package i take care of the decorations,music and foods', 'Custom decor design,Rental items,Setup and takedown,dj music,smoke,fireworks,welcome drink,foods', 1),
(41, 9, 'basic', 3000, 'In this package i only take care of the decorations', 'Custom decor design,Rental items,Setup and takedown\r\n', 1),
(42, 9, 'standard', 6000, 'In this package i only take care of the decorations and music', 'Custom decor design,Rental items,Setup and takedown,dj music', 1),
(43, 9, 'premium', 15000, 'In this package i take care of the decorations,music and foods', 'Custom decor design,Rental items,Setup and takedown,dj music,smoke,fireworks,welcome drink,foods', 1),
(44, 10, 'basic', 5000, 'In this package i only take care of the decorations', 'Custom decor design,Rental items,Setup and takedown\r\n', 1),
(45, 10, 'standard', 9000, 'In this package i only take care of the decorations and music', 'Custom decor design,Rental items,Setup and takedown,dj music,smoke,fireworks', 1),
(46, 10, 'premium', 14000, 'In this package i take care of the decorations,music and foods', 'Custom decor design,Rental items,Setup and takedown,dj music,smoke,fireworks,welcome drink,foods', 1),
(47, 11, 'basic', 10000, 'In this package i only take care of the decorations', 'Custom decor design,Rental items,Setup and takedown\r\n', 1),
(48, 11, 'standard', 18000, 'In this package i only take care of the decorations and music', 'Custom decor design,Rental items,Setup and takedown,dj music,smoke,fireworks', 1),
(49, 11, 'premium', 29000, 'In this package i take care of the decorations,music and foods', 'Custom decor design,Rental items,Setup and takedown,dj music,smoke,fireworks,welcome drink,foods', 1),
(50, 12, 'basic', 7000, 'In this package i only take care of the decorations', 'Custom decor design,Rental items,Setup and takedown\r\n', 1),
(51, 12, 'standard', 15000, 'In this package i only take care of the decorations and music', 'Custom decor design,Rental items,Setup and takedown,dj music', 1),
(52, 12, 'premium', 25000, 'In this package i take care of the decorations,music and foods', 'Custom decor design,Rental items,Setup and takedown,dj music,smoke,fireworks,welcome drink,foods', 1),
(53, 28, 'basic', 20000, 'In this package i only take care of the decorations', 'Custom decor design,Rental items,Setup and takedown\r\n', 1),
(54, 28, 'standard', 40000, 'In this package i only take care of the decorations and music', 'Custom decor design,Rental items,Setup and takedown,dj music,smoke,fireworks', 1),
(55, 28, 'premium', 60000, 'In this package i take care of the decorations,music and foods', 'Custom decor design,Rental items,Setup and takedown,dj music,smoke,fireworks,welcome drink,foods', 1),
(56, 29, 'basic', 20000, 'In this package i only take care of the decorations', 'Custom decor design,Rental items,Setup and takedown\r\n', 1),
(57, 29, 'standard', 50000, 'In this package i only take care of the decorations and music', 'Custom decor design,Rental items,Setup and takedown,dj music', 1),
(58, 29, 'premium', 10000, 'In this package i take care of the decorations,music and foods', 'Custom decor design,Rental items,Setup and takedown,dj music,smoke,fireworks,welcome drink,foods', 1);

-- --------------------------------------------------------

--
-- Table structure for table `planners`
--

DROP TABLE IF EXISTS `planners`;
CREATE TABLE IF NOT EXISTS `planners` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `details` varchar(500) NOT NULL,
  `price` int(100) NOT NULL,
  `event_type` varchar(100) NOT NULL,
  `subcategorie` varchar(100) NOT NULL,
  `district` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `image1` varchar(100) NOT NULL,
  `image2` varchar(100) NOT NULL,
  `image3` varchar(100) NOT NULL,
  `image4` varchar(100) NOT NULL,
  `planner_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `details`, `price`, `event_type`, `subcategorie`, `district`, `image`, `image1`, `image2`, `image3`, `image4`, `planner_id`) VALUES
(27, 'Galas Awarding ceremony many nm more nm max min more', 'this is gala event', 6000, 'Galas and award ceremonies', 'Bohemian', 'All Districts', 'gal6.jpg', 'gal7.jpg', 'gal8.jpg', 'gal10.jpg', 'gal15.jpg', 1),
(2, 'I will take care of your special wedding day', 'This is event details', 4000, 'Weddings', 'Traditional', 'Colombo', 'wed29.jpg', 'wed3.png', 'wed4.png', 'wed5.png', 'wed6.png', 7),
(3, 'Get your wedding planned by an industry professional', 'This is wedding 3', 7500, 'Weddings', 'Bohemian', 'Colombo', 'wed24.jpg', 'wed7.png', 'wed8.png', 'wed9.jpg', 'wed10.jpg', 1),
(4, 'I will plan the perfect beach wedding for you', 'this is wedding 4', 7500, 'Weddings', 'Rustic', 'Kurunegala', 'wed11.png', 'wed12.jpg', 'wed13.jpg', 'wed20.jpg', 'wed14.jpg', 4),
(5, 'Destination wedding planning', 'This is wedding 5', 6900, 'Weddings', 'Eco friendly', 'All Districts', 'wed16.jpg', 'wed17.jpg', 'wed18.jpg', 'wed19.jpg', 'wed30.jpg', 1),
(6, 'Full service wedding planning taken care by a professional', 'This is wedding 6', 8000, 'Weddings', 'Destination', 'Galle', 'wed21.jpg', 'wed22.jpg', 'wed23.jpg', 'wed24.jpg', 'wed25.jpg', 7),
(7, 'I will plan your bridal shower in the most unique way', 'this is Rustic Bridal shower', 20000, 'Bridal showers', 'Rustic', 'Kandy', 'bride1.jpg', 'bride2.jpg', 'bride3.jpg', 'bride4.jpg', 'bride5.png', 7),
(8, 'Would you like me to plan your wedding in eco-friendly way?', 'This is wedding 8', 25000, 'Weddings', 'Bohemian', 'Mathara', 'wed27.jpg', 'wed26.jpg', 'wed28.jpg', 'wed1.png', 'wed30.jpg', 7),
(9, 'Niwesh trade shower Event Organisers', 'This is a Trade shows', 3000, 'Trade shows', 'Traditional', 'All Districts', 'trade1.jpg', 'trade2.jpg', 'trade3.jpg', 'trade4.jpg', 'trade5.jpg', 1),
(10, 'International Safety Awards Gala Dinner ', 'This is gala event 2', 5000, 'Galas and award ceremonies', 'Destination', 'All Districts', 'gal21.jpg', 'gal22.jpg', 'gal23.jpg', 'gal24.jpg', 'gal25.jpg', 1),
(11, 'Gala Dinners Dublin Awards Dinner Venue Dublin - The Round Room', 'This is event 3', 10000, 'Galas and award ceremonies', 'Luxury', 'Colombo', 'gal9.jpg', 'gal17.jpg', 'gal18.jpg', 'gal19.jpg', 'gal20.jpg', 4),
(12, 'Awards Shows gala QOKO Events', 'This is event 4', 7000, 'Galas and award ceremonies', 'Traditional', 'All Districts', 'gal4.jpg', 'gal14.jpg', 'gal11.jpg', 'gal12.jpg', 'gal16.jpg', 4),
(28, 'Averndra music festival with urbun country plan', 'This is music event 1', 20000, 'Music Festivals', 'Vintage', 'All Districts', 'music3.png', 'music1.jpg', 'music2.jpg', 'music4.jpg', 'music5.jpg', 4),
(26, 'Galas Awarding ceremony many more max min', 'this is gala award ceremony', 9000, 'Galas and award ceremonies', 'Luxury', 'All Districts', 'gal5.jpg', 'gal1.jpg', 'gal2.jpg', 'gal3.jpg', 'gal13.jpg', 1),
(29, 'Darvin music festival with sunday time plan', 'This is music event 2', 20000, 'Music Festivals', 'Intimate', 'Colombo', 'music9.jpg', 'music6.jpg', 'music7.jpg', 'music8.jpg', 'music10.jpg', 7);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `f_name` varchar(100) NOT NULL,
  `l_name` varchar(100) NOT NULL,
  `nic` varchar(100) NOT NULL,
  `t_no` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `user_type` varchar(20) NOT NULL DEFAULT 'user',
  `image` varchar(100) NOT NULL DEFAULT 'default.jpg',
  `about` varchar(10000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `f_name`, `l_name`, `nic`, `t_no`, `name`, `email`, `password`, `user_type`, `image`, `about`) VALUES
(1, 'kasun', 'dayananda', '199658961234', 764123586, 'kusun96', 'planner1@ka.com', '202cb962ac59075b964b07152d234b70', 'planner', 'pic-1.png', 'Hi there, I\'m Kasun, an event planner with a passion for creating magical beach weddings. Growing up near the coast, I\'ve always been drawn to the natural beauty and tranquility of the beach, and I feel fortunate to have turned this passion into a career.\r\n\r\nI studied event management in college and quickly discovered that my true calling was in helping couples plan their dream beach weddings. Over the past decade, I\'ve developed a reputation for my attention to detail, creativity, and ability to work under pressure.\r\n\r\nWhen I work with a couple, I take a collaborative and hands-on approach. I take the time to get to know them and their vision for their special day, and then use my expertise to bring that vision to life. I have a keen eye for design and work closely with my trusted vendors to create stunning floral arrangements, decor, and lighting that perfectly complement the beach setting.\r\n\r\nFrom sourcing the perfect beachfront location to coordinating the wedding day timeline, I take care of every detail to ensure a stress-free experience for the couple and their guests. I\'m known for my excellent communication skills, professionalism, and ability to handle unexpected challenges with ease.\r\n\r\nIt\'s an honor to be a part of such an important moment in a couple\'s life, and I take that responsibility very seriously. With me as their event planner, couples can relax and enjoy their special day, knowing that every detail has been taken care of and that their beach wedding will be truly unforgettable.'),
(2, 'kushan', 'manethra', '200012802803', 714249784, 'manethra', 'user2@ka.com', '202cb962ac59075b964b07152d234b70', 'user', 'pic-3.png', ''),
(3, 'piumi', 'saheela', '199845789632', 785623418, 'piumi1998', 'user3@ka.com', '202cb962ac59075b964b07152d234b70', 'user', 'pic-2.png', ''),
(4, 'Sandun', 'Perera', '199425463687', 712345785, 'sandun94', 'planner4@ka.com', '202cb962ac59075b964b07152d234b70', 'planner', 'pic-5.png', 'Hi there, I\'m Sandun, an event planner with a passion for creating magical beach weddings. Growing up near the coast, I\'ve always been drawn to the natural beauty and tranquility of the beach, and I feel fortunate to have turned this passion into a career.\r\n\r\nI studied event management in college and quickly discovered that my true calling was in helping couples plan their dream beach weddings. Over the past decade, I\'ve developed a reputation for my attention to detail, creativity, and ability to work under pressure.\r\n\r\nWhen I work with a couple, I take a collaborative and hands-on approach. I take the time to get to know them and their vision for their special day, and then use my expertise to bring that vision to life. I have a keen eye for design and work closely with my trusted vendors to create stunning floral arrangements, decor, and lighting that perfectly complement the beach setting.\r\n\r\nFrom sourcing the perfect beachfront location to coordinating the wedding day timeline, I take care of every detail to ensure a stress-free experience for the couple and their guests. I\'m known for my excellent communication skills, professionalism, and ability to handle unexpected challenges with ease.\r\n\r\nIt\'s an honor to be a part of such an important moment in a couple\'s life, and I take that responsibility very seriously. With me as their event planner, couples can relax and enjoy their special day, knowing that every detail has been taken care of and that their beach wedding will be truly unforgettable.'),
(5, 'Nimali', 'Rathnayaka', '199752364517', 754123856, 'nimalrath', 'user5@ka.com', '202cb962ac59075b964b07152d234b70', 'user', 'pic-4.png', ''),
(6, 'admin', 'admin', '000000000000', 0, 'admin', 'admin@ka.com', '202cb962ac59075b964b07152d234b70', 'admin', 'admin.jpg', 'i\'m the admin of this web site'),
(7, 'Wasana', 'Amarathunga', '200244567841', 704125369, 'Wasana02', 'planner7@ka.com', '202cb962ac59075b964b07152d234b70', 'planner', 'pic-6.png', 'Hi there, I\'m Wasana, an event planner with a passion for creating magical beach weddings. Growing up near the coast, I\'ve always been drawn to the natural beauty and tranquility of the beach, and I feel fortunate to have turned this passion into a career.\r\n\r\nI studied event management in college and quickly discovered that my true calling was in helping couples plan their dream beach weddings. Over the past decade, I\'ve developed a reputation for my attention to detail, creativity, and ability to work under pressure.\r\n\r\nWhen I work with a couple, I take a collaborative and hands-on approach. I take the time to get to know them and their vision for their special day, and then use my expertise to bring that vision to life. I have a keen eye for design and work closely with my trusted vendors to create stunning floral arrangements, decor, and lighting that perfectly complement the beach setting.\r\n\r\nFrom sourcing the perfect beachfront location to coordinating the wedding day timeline, I take care of every detail to ensure a stress-free experience for the couple and their guests. I\'m known for my excellent communication skills, professionalism, and ability to handle unexpected challenges with ease.\r\n\r\nIt\'s an honor to be a part of such an important moment in a couple\'s life, and I take that responsibility very seriously. With me as their event planner, couples can relax and enjoy their special day, knowing that every detail has been taken care of and that their beach wedding will be truly unforgettable.'),
(15, 'Navindu', 'Kumara', '200001212356', 124578456, 'navindu', 'planner15@ka.com', '202cb962ac59075b964b07152d234b70', 'planner', 'default.jpg', ''),
(17, 'kushan', 'asassa', '3123', 12321, 'kushan', 'kushan@gmail.com', '202cb962ac59075b964b07152d234b70', 'user', 'default.jpg', 'hi'),
(18, 'nimal', 'Andarawewa', '112', 212, 'nimal', 'nimal@gmail.com', '202cb962ac59075b964b07152d234b70', 'planner', 'default.jpg', 'sdad'),
(19, 'kushan', 'manethra', '222222', 12345578, 'kushanu', 'testu@gmail.com', '202cb962ac59075b964b07152d234b70', 'user', 'default.jpg', 'hi'),
(20, 'kushan', 'andarawewa', '2121212', 12113113, 'kushanP', 'testp@gmail.com', '202cb962ac59075b964b07152d234b70', 'planner', 'default.jpg', 'hi');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

DROP TABLE IF EXISTS `wishlist`;
CREATE TABLE IF NOT EXISTS `wishlist` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `user_id` int(100) NOT NULL,
  `pid` int(100) NOT NULL,
  `event_type` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
