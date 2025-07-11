-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 09, 2025 at 09:24 AM
-- Server version: 8.4.3
-- PHP Version: 8.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `penjualan`
--

-- --------------------------------------------------------

--
-- Table structure for table `makanan`
--

CREATE TABLE `makanan` (
  `id` int NOT NULL,
  `nama` varchar(225) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `harga` decimal(10,2) DEFAULT NULL,
  `kategori` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `deskripsi` text COLLATE utf8mb4_general_ci,
  `foto` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `stok` int DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `makanan`
--

INSERT INTO `makanan` (`id`, `nama`, `harga`, `kategori`, `deskripsi`, `foto`, `created_at`, `updated_at`, `stok`) VALUES
(23, 'Nasi Goreng Besar', 27000.00, 'makanan', 'dijamin enaknya porsi jumbo', '1751441919_Felicity Cloake’s perfect nasi goreng_.jpeg', '2025-07-02 00:38:39', '2025-07-09 01:40:56', 790),
(24, 'Mie Pedas Jontor', 17000.00, 'makanan', 'pedass bangett', '1751441974_Mie Setan Super Pedas Nikmat - Resep _ ResepKoki.jpeg', '2025-07-02 00:39:34', '2025-07-09 01:47:12', 2),
(25, 'Nasi Ayam Goreng', 30000.00, 'makanan', 'enak banget jelas kerasa ayamnya', '1751442047_Malay Fried Chicken Rice (Nasi Ayam Goreng….jpeg', '2025-07-02 00:40:47', '2025-07-02 00:40:47', 0),
(27, 'seblak', 11111.00, 'makanan', 'ad', '1752042754_81d29346-212d-4f3d-a916-322968b602b7.jpeg', '2025-07-08 23:32:34', '2025-07-08 23:32:34', 0);

-- --------------------------------------------------------

--
-- Table structure for table `minuman`
--

CREATE TABLE `minuman` (
  `id` int NOT NULL,
  `nama` varchar(225) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `harga` decimal(10,2) DEFAULT NULL,
  `kategori` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `deskripsi` text COLLATE utf8mb4_general_ci,
  `foto` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `stok` int DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `minuman`
--

INSERT INTO `minuman` (`id`, `nama`, `harga`, `kategori`, `deskripsi`, `foto`, `created_at`, `updated_at`, `stok`) VALUES
(4, 'jus mangga', 20000.00, 'minuman', 'segerr', '1751443073_14be400a-3c70-4876-a615-25b831726196.jpeg', '2025-07-02 00:57:53', '2025-07-02 00:57:53', 0),
(5, 'kopi', 15000.00, 'minuman', 'enakkk', '1751443152_196ea95c-f576-4205-8767-dcdabe117776.jpeg', '2025-07-02 00:59:12', '2025-07-02 00:59:12', 0),
(6, 'es teh', 12000.00, 'minuman', 'segerrrrrr', '1751443176_5efe2bdd-c4ef-4d76-b19c-c64f4c85f947.jpeg', '2025-07-02 00:59:36', '2025-07-02 00:59:36', 0);

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `id` int NOT NULL,
  `tanggal` date DEFAULT NULL,
  `id_makanan` int DEFAULT NULL,
  `id_minuman` int DEFAULT NULL,
  `id_user` int DEFAULT NULL,
  `nama_pemesan` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `no_hp` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `jumlah` int DEFAULT NULL,
  `total_harga` decimal(10,2) DEFAULT NULL,
  `status` enum('menunggu','sedang dimasak','selesai') COLLATE utf8mb4_general_ci DEFAULT 'menunggu'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penjualan`
--

INSERT INTO `penjualan` (`id`, `tanggal`, `id_makanan`, `id_minuman`, `id_user`, `nama_pemesan`, `alamat`, `no_hp`, `jumlah`, `total_harga`, `status`) VALUES
(11, '2025-07-08', 24, NULL, 4, 'nanang', 'pakis', '1', 1, 17000.00, 'selesai'),
(12, '2025-07-09', 23, NULL, 9, 'aqyla', 'kepanjen', '1111', 5, 135000.00, 'selesai'),
(13, '2025-07-09', 24, NULL, 9, 'aqyla', 'kepanjen', '1111', 2, 34000.00, 'selesai'),
(14, '2025-07-09', 24, NULL, 9, 'aqyla', 'q', '1', 1, 17000.00, 'selesai'),
(15, '2025-07-09', 23, NULL, 9, 'aqyla', 'sumawe', '11', 100, 2700000.00, 'selesai'),
(16, '2025-07-09', 23, NULL, 9, 'aqyla', 'sumawe', '11', 100, 2700000.00, 'selesai'),
(17, '2025-07-09', 23, NULL, 9, 'adda', 'da11', '1', 1, 27000.00, 'selesai'),
(18, '2025-07-09', 23, NULL, 9, 'ad1', '1a', 'ad', 101, 2727000.00, 'selesai'),
(19, '2025-07-09', 24, NULL, 9, 'aqyla', 'aqyla', '1213', 1, 17000.00, 'sedang dimasak'),
(20, '2025-07-09', 23, NULL, 9, 'aqyla', 'aqyla', '1213', 4, 108000.00, 'menunggu'),
(22, '2025-07-09', 24, NULL, 9, 'ad', 'da1', '1', 1, 17000.00, 'menunggu');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `role` enum('admin','pembeli') COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `username`, `password`, `role`) VALUES
(1, 'admin', 'admin', 'admin'),
(2, 'pembeli', 'pembeli', 'pembeli'),
(3, 'eka', 'eka', 'pembeli'),
(4, 'nanang', 'nanang', 'pembeli'),
(5, 'alex', 'alex', 'pembeli'),
(6, 'arif', 'arif', 'pembeli'),
(7, 'Mahasiswaa', 'Mahasiswaa', 'pembeli'),
(8, 'test', 'test', 'pembeli'),
(9, 'aqyla', 'aqyla', 'pembeli');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `makanan`
--
ALTER TABLE `makanan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `minuman`
--
ALTER TABLE `minuman`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_makanan` (`id_makanan`),
  ADD KEY `penjualan_ibfk_2` (`id_user`),
  ADD KEY `id_minuman` (`id_minuman`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `makanan`
--
ALTER TABLE `makanan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `minuman`
--
ALTER TABLE `minuman`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD CONSTRAINT `penjualan_ibfk_1` FOREIGN KEY (`id_makanan`) REFERENCES `makanan` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `penjualan_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`),
  ADD CONSTRAINT `penjualan_ibfk_minuman` FOREIGN KEY (`id_minuman`) REFERENCES `minuman` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
