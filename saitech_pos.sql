-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 30, 2022 at 05:38 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `saitech_pos`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id_cart` int(11) NOT NULL,
  `invoice_sale` varchar(60) NOT NULL,
  `barcode_item` varchar(255) NOT NULL,
  `product_item` varchar(60) NOT NULL,
  `price` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `date_cart` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id_cart`, `invoice_sale`, `barcode_item`, `product_item`, `price`, `qty`, `total`, `date_cart`) VALUES
(6, 'STP2212230001', 'LKIS99444112', 'Tango', 20000, 4, 80000, '2022-12-23'),
(8, 'STP2212230002', 'LKIS99444112', 'Tango', 20000, 5, 100000, '2022-12-23'),
(10, 'STP2212230002', 'LKIS99444117', 'Sabun Mama Lemon', 2000, 4, 8000, '2022-12-23'),
(11, 'STP2212230003', 'LKIS99444112', 'Tango', 20000, 4, 80000, '2022-12-23'),
(16, 'STP2212230006', 'LKIS99444115', 'Sabun Give', 2000, 1, 2000, '2022-12-23'),
(19, 'STP2212300002', 'LKIS99444112', 'Tango', 20000, 3, 60000, '2022-12-30'),
(27, 'STP2212300005', 'LKIS99444111', 'Mie Goreng', 60000, 1, 60000, '2022-12-30'),
(28, 'STP2212300006', 'LKIS99444118', 'Aqua', 20000, 1, 20000, '2022-12-30'),
(29, 'STP2212300007', 'LKIS99444112', 'Tango', 20000, 1, 20000, '2022-12-30'),
(30, 'STP2212300008', 'LKIS99444114', 'Sabun Lifeboy', 2500, 1, 2500, '2022-12-30'),
(31, 'STP2212300009', 'LKIS99444112', 'Tango', 20000, 1, 20000, '2022-12-30'),
(32, 'STP2212300010', 'LKIS99444111', 'Mie Goreng', 60000, 1, 60000, '2022-12-30'),
(33, 'STP2212300011', 'LKIS99444111', 'Mie Goreng', 60000, 1, 60000, '2022-12-30');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id_customer` int(11) NOT NULL,
  `name_customer` varchar(60) NOT NULL,
  `gender` enum('L','P') NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id_customer`, `name_customer`, `gender`, `phone`, `address`, `created_at`, `updated_at`) VALUES
(1, 'Teh Iis', 'P', '0895564788', 'Kp. Cisaat, Cianjur', '2022-11-30 03:22:32', NULL),
(2, 'Dadang', 'L', '0856851762', 'Gadung', '2022-11-30 17:34:52', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `p_category`
--

CREATE TABLE `p_category` (
  `id_category` int(11) NOT NULL,
  `name_category` varchar(40) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `p_category`
--

INSERT INTO `p_category` (`id_category`, `name_category`, `created_at`, `updated_at`) VALUES
(1, 'Makanan', '2022-12-13 22:44:47', NULL),
(2, 'Kue Kering', '2022-12-16 15:58:09', NULL),
(3, 'Kue Basah', '2022-12-16 15:58:16', NULL),
(4, 'Bahan Pokok', '2022-12-16 15:58:34', NULL),
(5, 'Minuman', '2022-12-16 15:58:41', NULL),
(6, 'Soap', '2022-12-16 15:59:39', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `p_item`
--

CREATE TABLE `p_item` (
  `id_item` int(11) NOT NULL,
  `barcode_item` varchar(255) NOT NULL,
  `name_item` varchar(60) NOT NULL,
  `id_category` int(11) NOT NULL,
  `id_unit` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `stock` int(10) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `p_item`
--

INSERT INTO `p_item` (`id_item`, `barcode_item`, `name_item`, `id_category`, `id_unit`, `price`, `stock`, `created_at`, `updated_at`) VALUES
(1, 'LKIS99444111', 'Mie Goreng', 1, 1, 60000, 92, '2022-12-13 22:45:16', NULL),
(2, 'LKIS99444112', 'Tango', 2, 1, 20000, 12, '2022-12-16 19:48:22', NULL),
(3, 'LKIS99444113', 'Kue Lapis', 3, 2, 30000, 0, '2022-12-16 19:49:03', NULL),
(4, 'LKIS99444114', 'Sabun Lifeboy', 6, 3, 2500, 17, '2022-12-16 19:49:28', '2022-12-16 19:50:09'),
(5, 'LKIS99444115', 'Sabun Give', 6, 3, 2000, 29, '2022-12-16 19:49:55', '2022-12-16 19:50:03'),
(6, 'LKIS99444116', 'Sampo Penteen', 6, 3, 1000, 30, '2022-12-16 19:50:36', NULL),
(7, 'LKIS99444117', 'Sabun Mama Lemon', 6, 3, 2000, 26, '2022-12-16 19:51:07', NULL),
(8, 'LKIS99444118', 'Aqua', 5, 1, 20000, 7, '2022-12-16 19:52:13', '2022-12-16 19:52:24'),
(9, 'LKIS99444119', 'Sabun Daia', 6, 3, 2000, 30, '2022-12-16 19:53:02', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `p_unit`
--

CREATE TABLE `p_unit` (
  `id_unit` int(11) NOT NULL,
  `name_unit` varchar(40) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `p_unit`
--

INSERT INTO `p_unit` (`id_unit`, `name_unit`, `created_at`, `updated_at`) VALUES
(1, 'Dus', '2022-12-13 22:44:54', NULL),
(2, 'Kilogram', '2022-12-16 15:00:57', NULL),
(3, 'Sachet', '2022-12-16 15:01:05', NULL),
(4, 'Liter', '2022-12-16 15:01:13', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `p_voucher`
--

CREATE TABLE `p_voucher` (
  `id_voucher` int(11) NOT NULL,
  `name_voucher` varchar(255) NOT NULL,
  `discount` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `p_voucher`
--

INSERT INTO `p_voucher` (`id_voucher`, `name_voucher`, `discount`, `id_user`) VALUES
(1, 'POTONGAN LIMARIBU', 5000, NULL),
(2, 'POTONGAN SERIBU', 1000, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id_supplier` int(11) NOT NULL,
  `name_supplier` varchar(60) NOT NULL,
  `phone` varchar(18) NOT NULL,
  `address` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id_supplier`, `name_supplier`, `phone`, `address`, `description`, `created_at`, `updated_at`) VALUES
(1, 'PT Indomieee', '08545345', 'Jl. Kenangan Anjay, Jakarta Barat', 'Cabang Utama', '2022-11-28 23:46:04', '2022-11-30 02:51:18');

-- --------------------------------------------------------

--
-- Table structure for table `t_sale`
--

CREATE TABLE `t_sale` (
  `invoice_sale` varchar(60) NOT NULL,
  `id_customer` int(11) DEFAULT NULL,
  `sub_total` int(11) DEFAULT NULL,
  `name_voucher` varchar(255) DEFAULT NULL,
  `discount` int(11) DEFAULT NULL,
  `grand_total` int(11) DEFAULT NULL,
  `cash` int(11) DEFAULT NULL,
  `remaining` int(11) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `date` date NOT NULL,
  `id_user` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_sale`
--

INSERT INTO `t_sale` (`invoice_sale`, `id_customer`, `sub_total`, `name_voucher`, `discount`, `grand_total`, `cash`, `remaining`, `note`, `date`, `id_user`, `created_at`) VALUES
('STP2212230001', NULL, 502500, NULL, NULL, 502500, 505000, 2500, '', '2022-12-23', 1, '2022-12-23 16:08:37'),
('STP2212230002', NULL, 133000, NULL, NULL, 133000, 150000, 17000, '', '2022-12-23', 1, '2022-12-23 16:13:18'),
('STP2212230003', NULL, 640000, NULL, NULL, 640000, 650000, 10000, 'Borongan', '2022-12-23', 1, '2022-12-23 16:17:36'),
('STP2212230004', NULL, 60000, NULL, NULL, 60000, 100000, 40000, '', '2022-12-23', 1, '2022-12-23 16:18:14'),
('STP2212230005', NULL, 20000, NULL, NULL, 20000, 20000, 0, '', '2022-12-23', 1, '2022-12-23 16:19:33'),
('STP2212230006', 1, 2000, NULL, NULL, 2000, 5000, 3000, '', '2022-12-23', 1, '2022-12-23 16:19:54'),
('STP2212230007', 2, 2500, NULL, NULL, 2500, 5000, 2500, '', '2022-12-23', 1, '2022-12-23 16:20:35'),
('STP2212300001', 2, 120000, NULL, NULL, 120000, 200000, 80000, '', '2022-12-30', 1, '2022-12-30 10:48:12'),
('STP2212300002', 1, 60000, NULL, NULL, 60000, 60000, 0, '', '2022-12-30', 1, '2022-12-30 10:52:12'),
('STP2212300003', 2, 60000, NULL, NULL, 60000, 60000, 0, '', '2022-12-30', 1, '2022-12-30 10:53:00'),
('STP2212300004', 1, 60000, NULL, NULL, 60000, 60000, 0, '', '2022-12-30', 1, '2022-12-30 10:53:51'),
('STP2212300005', NULL, 60000, NULL, NULL, 60000, 60000, 0, NULL, '2022-12-30', 1, '2022-12-30 11:15:50'),
('STP2212300006', 2, 20000, NULL, NULL, 20000, 30000, 10000, '', '2022-12-30', 1, '2022-12-30 11:25:23'),
('STP2212300007', 2, 20000, NULL, NULL, 20000, 50000, 30000, '', '2022-12-30', 1, '2022-12-30 11:27:08'),
('STP2212300008', NULL, 2500, NULL, NULL, 2500, 5000, 2500, NULL, '2022-12-30', 1, '2022-12-30 11:31:37'),
('STP2212300009', NULL, 20000, NULL, NULL, 20000, 20000, 0, '', '2022-12-30', 1, '2022-12-30 11:36:59'),
('STP2212300010', NULL, 60000, NULL, NULL, 60000, 100000, 40000, '', '2022-12-30', 1, '2022-12-30 11:37:11'),
('STP2212300011', 2, 60000, NULL, NULL, 60000, 100000, 40000, '', '2022-12-30', 1, '2022-12-30 11:37:23');

-- --------------------------------------------------------

--
-- Table structure for table `t_stock`
--

CREATE TABLE `t_stock` (
  `id_stock` int(11) NOT NULL,
  `id_item` int(11) NOT NULL,
  `type` enum('in','out') NOT NULL,
  `detail` varchar(200) NOT NULL,
  `id_supplier` int(11) DEFAULT NULL,
  `qty` int(10) NOT NULL,
  `date` date NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `id_user` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_stock`
--

INSERT INTO `t_stock` (`id_stock`, `id_item`, `type`, `detail`, `id_supplier`, `qty`, `date`, `created_at`, `id_user`) VALUES
(1, 1, 'in', 'Stock in', NULL, 60, '2022-12-13', '2022-12-13 22:45:54', 1),
(2, 2, 'in', 'Stock in', NULL, 30, '2022-12-16', '2022-12-16 19:54:47', 1),
(3, 4, 'in', 'Stock in', NULL, 30, '2022-12-16', '2022-12-16 19:55:23', 1),
(4, 5, 'in', 'Stock in', NULL, 30, '2022-12-16', '2022-12-16 19:55:37', 1),
(5, 6, 'in', 'Stock in', NULL, 30, '2022-12-16', '2022-12-16 19:55:55', 1),
(6, 7, 'in', 'Stock in', NULL, 30, '2022-12-16', '2022-12-16 19:56:07', 1),
(7, 8, 'in', 'Stock in', NULL, 10, '2022-12-16', '2022-12-16 19:56:20', 1),
(8, 9, 'in', 'Stock in', NULL, 30, '2022-12-16', '2022-12-16 19:56:34', 1),
(9, 1, 'in', 'Stock in', NULL, 50, '2022-12-30', '2022-12-30 11:30:08', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(60) NOT NULL,
  `address` varchar(100) DEFAULT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `role` varchar(10) NOT NULL,
  `status_active` varchar(20) NOT NULL COMMENT 'Active, Non Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `name`, `address`, `picture`, `role`, `status_active`) VALUES
(1, 'admin', '$2y$10$elsL0c2MEcLK9/xOt3GLHuOl9Ivhu0GeIza9XKt.X9qkJd7i.r3cW', 'Saidina Husen', 'Jakarta Selatan', 'admin.jpg', 'Admin', 'Active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id_cart`),
  ADD KEY `invoice_sale` (`invoice_sale`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id_customer`);

--
-- Indexes for table `p_category`
--
ALTER TABLE `p_category`
  ADD PRIMARY KEY (`id_category`);

--
-- Indexes for table `p_item`
--
ALTER TABLE `p_item`
  ADD PRIMARY KEY (`id_item`),
  ADD KEY `id_category` (`id_category`),
  ADD KEY `id_unit` (`id_unit`);

--
-- Indexes for table `p_unit`
--
ALTER TABLE `p_unit`
  ADD PRIMARY KEY (`id_unit`);

--
-- Indexes for table `p_voucher`
--
ALTER TABLE `p_voucher`
  ADD PRIMARY KEY (`id_voucher`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id_supplier`);

--
-- Indexes for table `t_sale`
--
ALTER TABLE `t_sale`
  ADD PRIMARY KEY (`invoice_sale`),
  ADD KEY `id_customer` (`id_customer`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `t_stock`
--
ALTER TABLE `t_stock`
  ADD PRIMARY KEY (`id_stock`),
  ADD KEY `id_item` (`id_item`),
  ADD KEY `id_supplier` (`id_supplier`),
  ADD KEY `t_stock_ibfk_3` (`id_user`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username_2` (`username`),
  ADD UNIQUE KEY `username_3` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id_cart` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id_customer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `p_category`
--
ALTER TABLE `p_category`
  MODIFY `id_category` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `p_item`
--
ALTER TABLE `p_item`
  MODIFY `id_item` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `p_unit`
--
ALTER TABLE `p_unit`
  MODIFY `id_unit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `p_voucher`
--
ALTER TABLE `p_voucher`
  MODIFY `id_voucher` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id_supplier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `t_stock`
--
ALTER TABLE `t_stock`
  MODIFY `id_stock` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `p_item`
--
ALTER TABLE `p_item`
  ADD CONSTRAINT `p_item_ibfk_1` FOREIGN KEY (`id_category`) REFERENCES `p_category` (`id_category`),
  ADD CONSTRAINT `p_item_ibfk_2` FOREIGN KEY (`id_unit`) REFERENCES `p_unit` (`id_unit`);

--
-- Constraints for table `p_voucher`
--
ALTER TABLE `p_voucher`
  ADD CONSTRAINT `p_voucher_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `t_sale`
--
ALTER TABLE `t_sale`
  ADD CONSTRAINT `t_sale_ibfk_1` FOREIGN KEY (`id_customer`) REFERENCES `customer` (`id_customer`),
  ADD CONSTRAINT `t_sale_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

--
-- Constraints for table `t_stock`
--
ALTER TABLE `t_stock`
  ADD CONSTRAINT `t_stock_ibfk_1` FOREIGN KEY (`id_item`) REFERENCES `p_item` (`id_item`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `t_stock_ibfk_2` FOREIGN KEY (`id_supplier`) REFERENCES `supplier` (`id_supplier`),
  ADD CONSTRAINT `t_stock_ibfk_3` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
