-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 05, 2022 at 02:50 AM
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
(1, 'Makanan', '2022-11-30 18:41:47', NULL),
(8, 'Pakaian', '2022-12-02 05:10:04', NULL),
(10, 'Minuman', '2022-12-04 18:41:47', NULL),
(11, 'ATK', '2022-12-04 05:10:04', NULL),
(12, 'Kue Kering', '2022-11-30 18:41:47', NULL),
(13, 'Kue Basah', '2022-12-02 05:10:04', NULL),
(14, 'Wafer', '2022-12-04 18:41:47', NULL),
(15, 'Cola', '2022-12-04 05:10:04', NULL);

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
(4, 'LKIS95653', 'Mie Goreng', 1, 1, 80000, 0, '2022-12-02 04:35:41', '2022-12-04 18:00:36'),
(5, 'LKIS94522221', 'Baju Argentina', 8, 1, 1000000, 0, '2022-12-02 05:10:29', '2022-12-04 18:00:51'),
(6, 'LKIS9920881', 'AKUAAA', 1, 1, 900000, 0, '2022-12-02 22:35:11', NULL),
(7, 'LKIS9920435', 'Kerupuk RO', 12, 5, 40000, 0, '2022-12-04 17:54:22', NULL),
(8, 'LKIS99202341', 'Minyak', 10, 6, 122000, 0, '2022-12-04 17:55:20', NULL),
(9, 'LKIS99444', 'Nutrisari', 10, 8, 90000, 0, '2022-12-04 17:56:02', NULL),
(10, 'LKIS99444533', 'Kantong Es', 10, 7, 5000, 0, '2022-12-04 17:56:40', NULL),
(11, 'LKIS99444111', 'Oreo', 14, 1, 122000, 0, '2022-12-04 17:57:04', NULL),
(12, 'LKIS933245', 'Buku A4', 11, 1, 70000, 0, '2022-12-04 17:57:38', NULL),
(13, 'LKIC324544', 'Big Cola', 15, 1, 75000, 0, '2022-12-04 17:58:17', NULL),
(14, 'LKI87554', 'Kue Lapis', 13, 5, 2000, 0, '2022-12-04 17:58:55', NULL);

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
(1, 'Dus', '2022-11-30 18:41:47', NULL),
(5, 'Kilogram', '2022-12-04 17:52:58', NULL),
(6, 'Leter', '2022-12-04 17:53:05', NULL),
(7, 'Pak', '2022-12-04 17:53:23', NULL),
(8, 'Lusin', '2022-12-04 17:53:32', NULL);

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
(1, 'admin', '$2y$10$elsL0c2MEcLK9/xOt3GLHuOl9Ivhu0GeIza9XKt.X9qkJd7i.r3cW', 'Saidina Husen', 'Jakarta Selatan', 'admin.jpg', 'Admin', 'Active'),
(18, 'husen', '$2y$10$tzGxHmO0CPmnXsvOeQYR2.WVXT1U1b22gwLlBvq7G4YawRyglsc3.', 'admin baru', 'maleber ajaaa', 'Screenshot_from_2022-11-22_13-29-43.png', 'Kasir', 'Active');

--
-- Indexes for dumped tables
--

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
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id_supplier`);

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
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id_customer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `p_category`
--
ALTER TABLE `p_category`
  MODIFY `id_category` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `p_item`
--
ALTER TABLE `p_item`
  MODIFY `id_item` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `p_unit`
--
ALTER TABLE `p_unit`
  MODIFY `id_unit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id_supplier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `p_item`
--
ALTER TABLE `p_item`
  ADD CONSTRAINT `p_item_ibfk_1` FOREIGN KEY (`id_category`) REFERENCES `p_category` (`id_category`),
  ADD CONSTRAINT `p_item_ibfk_2` FOREIGN KEY (`id_unit`) REFERENCES `p_unit` (`id_unit`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
