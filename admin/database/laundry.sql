-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 03 Jun 2024 pada 14.44
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laundry`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `laundry`
--

CREATE TABLE `laundry` (
  `laun_id` int(11) NOT NULL,
  `customer_name` varchar(100) NOT NULL,
  `laun_priority` int(11) NOT NULL,
  `laun_weight` int(11) NOT NULL,
  `laun_date_received` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `laun_claimed` tinyint(4) NOT NULL DEFAULT 0,
  `resi` varchar(50) NOT NULL,
  `status` varchar(20) NOT NULL,
  `laun_type_id` int(11) NOT NULL,
  `laun_status_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `laundry`
--

INSERT INTO `laundry` (`laun_id`, `customer_name`, `laun_priority`, `laun_weight`, `laun_date_received`, `laun_claimed`, `resi`, `status`, `laun_type_id`, `laun_status_id`) VALUES
(27, 'Zero Two', 1, 5, '2024-06-03 12:32:56', 0, 'DC2DE778', '', 10, 1),
(28, 'Zero Two 2', 2, 4, '2024-06-03 12:33:28', 0, '858EE102', '', 10, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `laundry_status`
--

CREATE TABLE `laundry_status` (
  `laun_status_id` int(11) NOT NULL,
  `laun_status_desc` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `laundry_status`
--

INSERT INTO `laundry_status` (`laun_status_id`, `laun_status_desc`) VALUES
(1, 'Diproses'),
(2, 'Selesai');

-- --------------------------------------------------------

--
-- Struktur dari tabel `laundry_type`
--

CREATE TABLE `laundry_type` (
  `laun_type_id` int(11) NOT NULL,
  `laun_type_desc` varchar(50) NOT NULL,
  `laun_type_price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `laundry_type`
--

INSERT INTO `laundry_type` (`laun_type_id`, `laun_type_desc`, `laun_type_price`) VALUES
(6, 'T-shirt', 5000),
(7, 'Celana Jeans', 7000),
(8, 'Celana Panjang', 6000),
(9, 'Celana Pendek', 4000),
(10, 'Kemeja', 8000),
(11, 'Dress', 10000),
(12, 'Rok', 9000),
(13, 'Jaket', 12000),
(14, 'Blouse', 6000),
(15, 'Kaos', 4500);

-- --------------------------------------------------------

--
-- Struktur dari tabel `sales`
--

CREATE TABLE `sales` (
  `sale_id` int(11) NOT NULL,
  `sale_customer_name` varchar(100) NOT NULL,
  `sale_type_desc` varchar(50) NOT NULL,
  `sale_date_paid` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `sale_laundry_received` datetime NOT NULL,
  `sale_amount` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_account` varchar(50) NOT NULL,
  `user_password` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`user_id`, `user_account`, `user_password`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `laundry`
--
ALTER TABLE `laundry`
  ADD PRIMARY KEY (`laun_id`),
  ADD KEY `laun_type_id` (`laun_type_id`),
  ADD KEY `laun_status_id` (`laun_status_id`);

--
-- Indeks untuk tabel `laundry_status`
--
ALTER TABLE `laundry_status`
  ADD PRIMARY KEY (`laun_status_id`);

--
-- Indeks untuk tabel `laundry_type`
--
ALTER TABLE `laundry_type`
  ADD PRIMARY KEY (`laun_type_id`);

--
-- Indeks untuk tabel `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`sale_id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `laundry`
--
ALTER TABLE `laundry`
  MODIFY `laun_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT untuk tabel `laundry_status`
--
ALTER TABLE `laundry_status`
  MODIFY `laun_status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `laundry_type`
--
ALTER TABLE `laundry_type`
  MODIFY `laun_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `sales`
--
ALTER TABLE `sales`
  MODIFY `sale_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `laundry`
--
ALTER TABLE `laundry`
  ADD CONSTRAINT `laundry_ibfk_1` FOREIGN KEY (`laun_type_id`) REFERENCES `laundry_type` (`laun_type_id`),
  ADD CONSTRAINT `laundry_ibfk_2` FOREIGN KEY (`laun_status_id`) REFERENCES `laundry_status` (`laun_status_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
