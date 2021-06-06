-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 05 Jun 2021 pada 14.15
-- Versi server: 10.4.10-MariaDB
-- Versi PHP: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `regul`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `list_menu`
--

CREATE TABLE `list_menu` (
  `id` bigint(20) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `kategori` varchar(50) NOT NULL,
  `keterangan` varchar(50) NOT NULL,
  `photo` varchar(50) NOT NULL,
  `harga` bigint(20) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `list_menu`
--

INSERT INTO `list_menu` (`id`, `nama`, `kategori`, `keterangan`, `photo`, `harga`) VALUES
(1, 'Nasi Padang', 'Desert', 'Berisi Nasi, Telor', '', 1000),
(10, 'Gulai Kambing', 'Makanan', 'kambing garut nan mantap', '', 10000),
(11, 'sate madura', 'makanan', 'berisikan daging berkualitas', '', 15000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemesanan`
--

CREATE TABLE `pemesanan` (
  `resi` varchar(50) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `menu_id` bigint(20) NOT NULL,
  `qty` bigint(20) NOT NULL,
  `total` varchar(50) NOT NULL,
  `metode` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pemesanan`
--

INSERT INTO `pemesanan` (`resi`, `user_id`, `menu_id`, `qty`, `total`, `metode`, `status`, `created_at`) VALUES
('REGUL-21060000', 1, 1, 2, '242000', 1, 1, '2021-06-02 17:01:50'),
('REGUL-21060000', 1, 10, 5, '242000', 1, 1, '2021-06-02 17:01:52'),
('REGUL-21060000', 1, 11, 10, '242000', 1, 1, '2021-06-02 17:01:52'),
('REGUL-21060000', 1, 10, 4, '242000', 1, 1, '2021-06-02 17:07:40'),
('REGUL-21064000', 3, 1, 2, '52000', 1, 1, '2021-06-03 09:34:06'),
('REGUL-21064000', 3, 10, 2, '52000', 1, 1, '2021-06-03 09:34:06'),
('REGUL-21064000', 3, 11, 2, '52000', 1, 1, '2021-06-03 09:34:06'),
('REGUL-21067000', 4, 1, 1, '26000', NULL, 0, '2021-06-03 03:36:38'),
('REGUL-21067000', 4, 10, 1, '26000', NULL, 0, '2021-06-03 03:36:38'),
('REGUL-21067000', 4, 11, 1, '26000', NULL, 0, '2021-06-03 03:36:38'),
('REGUL-21061000', 4, 1, 1, '26000', 0, 1, '2021-06-03 09:37:02'),
('REGUL-21061000', 4, 10, 1, '26000', 0, 1, '2021-06-03 09:37:02'),
('REGUL-21061000', 4, 11, 1, '26000', 0, 1, '2021-06-03 09:37:02'),
('REGUL-21061300', 4, 1, 1, '26000', 0, 1, '2021-06-03 13:05:37'),
('REGUL-21061300', 4, 10, 1, '26000', 0, 1, '2021-06-03 13:05:37'),
('REGUL-21061300', 4, 11, 1, '26000', 0, 1, '2021-06-03 13:05:37'),
('REGUL-21061600', 4, 1, 1, '1000', 0, 1, '2021-06-03 13:20:27');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(64) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `role` enum('owner','customer','kasir') NOT NULL DEFAULT 'customer',
  `last_login` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_active` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `email`, `full_name`, `phone`, `role`, `last_login`, `created_at`, `is_active`) VALUES
(1, 'ali', '$2y$10$b3Y4DC1/5f9wZvCxuBMNdu84lhI.raantDiXeIXXustbupxHhzFDO', 'muhammadalisaid@gmail.com', 'ali', '082255119408', 'owner', '2021-06-03 13:17:17', '2021-06-03 09:27:25', 1),
(2, 'ghani', '$2y$10$b..EcJLUnwUejErOpgLB3.RYArzJDvW36V3TKeQ2vMEIOyS8FitEq', 'ghani@gmail.com', 'ghani', '082255114311', 'kasir', '2021-06-03 13:20:19', '2021-06-03 09:29:33', 1),
(3, 'sheva', '$2y$10$h1ul8uF7tqocjZd5RwMyOeDWrR.9Gr157vAnLqgplujT3ii.3BDUy', 'sheva@gmail.com', 'sheva', '082255114312', 'customer', '2021-06-03 09:36:07', '2021-06-03 09:31:06', 1),
(4, 'ragil', '$2y$10$2AyHVaeOJ468bB/RE66e0.2kMnOar5PUUMwCYc1ZxxhM0EQSrM51.', 'ragil@gmail.com', 'ragil', '082255114313', 'customer', '2021-06-03 13:20:51', '2021-06-03 09:32:00', 1);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `list_menu`
--
ALTER TABLE `list_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `username` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `list_menu`
--
ALTER TABLE `list_menu`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
