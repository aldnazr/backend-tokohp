-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 19 Agu 2025 pada 09.03
-- Versi server: 8.4.3
-- Versi PHP: 8.3.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tokohp`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `brands`
--

CREATE TABLE `brands` (
  `ID_BRAND` int NOT NULL,
  `NAMA_BRAND` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `brands`
--

INSERT INTO `brands` (`ID_BRAND`, `NAMA_BRAND`) VALUES
(4, 'Apple'),
(5, 'Oppo'),
(1, 'Samsung'),
(3, 'Sony'),
(6, 'Vivo'),
(2, 'Xiaomi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_transaksi`
--

CREATE TABLE `detail_transaksi` (
  `ID_DETAIL_TRANSAKSI` int NOT NULL,
  `ID_TRANSAKSI` int DEFAULT NULL,
  `ID_PHONE` int DEFAULT NULL,
  `HARGA_BARANG` int DEFAULT NULL,
  `JUMLAH_PEMBELIAN` int DEFAULT NULL,
  `SUBTOTAL` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `detail_transaksi`
--

INSERT INTO `detail_transaksi` (`ID_DETAIL_TRANSAKSI`, `ID_TRANSAKSI`, `ID_PHONE`, `HARGA_BARANG`, `JUMLAH_PEMBELIAN`, `SUBTOTAL`) VALUES
(1, 1, 1, 1000000, 1, 1000000),
(2, 2, 2, 2000000, 1, 2000000),
(3, 3, 3, 3000000, 1, 3000000),
(4, 4, 4, 1000000, 1, 1000000),
(5, 5, 6, 3000000, 1, 3000000),
(6, 6, 1, 100000, 2, 200000),
(7, 6, 2, 150000, 2, 300000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `phones`
--

CREATE TABLE `phones` (
  `ID_PHONE` int NOT NULL,
  `ID_BRAND` int DEFAULT NULL,
  `NAMA_HANDPHONE` varchar(100) DEFAULT NULL,
  `DESKRIPSI` varchar(255) DEFAULT NULL,
  `HARGA` int DEFAULT NULL,
  `STOK` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `phones`
--

INSERT INTO `phones` (`ID_PHONE`, `ID_BRAND`, `NAMA_HANDPHONE`, `DESKRIPSI`, `HARGA`, `STOK`) VALUES
(1, 1, 'S23', 'Samsung', 1000000, 10),
(2, 2, 'POCO X5', 'POCO', 2000000, 10),
(3, 3, 'Xperia 5', 'Xperia', 3000000, 15),
(4, 4, 'Iphone 15', 'Iphone', 1000000, 10),
(5, 2, 'POCO M5', 'POCO', 2000000, 10),
(6, 6, 'V70', 'Vivo', 3000000, 15);

-- --------------------------------------------------------

--
-- Struktur dari tabel `sessions`
--

CREATE TABLE `sessions` (
  `ID_SESSION` int NOT NULL,
  `ID_USER` int DEFAULT NULL,
  `WAKTU_LOGIN` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `ID_TRANSAKSI` int NOT NULL,
  `ID_USER` int DEFAULT NULL,
  `NAMA_PELANGGAN` varchar(100) DEFAULT NULL,
  `TANGGAL` timestamp NULL DEFAULT NULL,
  `TOTAL_HARGA` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`ID_TRANSAKSI`, `ID_USER`, `NAMA_PELANGGAN`, `TANGGAL`, `TOTAL_HARGA`) VALUES
(1, 1, 'Aulus', '2023-11-15 05:00:00', 1000000),
(2, 1, 'Hanzo', '2023-11-16 05:00:00', 2000000),
(3, 1, 'Nana', '2023-11-17 05:00:00', 3000000),
(4, 1, 'Johnson', '2023-11-18 05:00:00', 1000000),
(5, 1, 'Chou', '2023-11-19 05:00:00', 3000000),
(6, 1, 'Azhar', '2025-08-17 17:00:00', 500000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `ID_USER` int NOT NULL,
  `NAMA_LENGKAP` varchar(100) NOT NULL,
  `TANGGAL_LAHIR` date DEFAULT NULL,
  `GENDER` varchar(10) NOT NULL,
  `ALAMAT` varchar(255) DEFAULT NULL,
  `EMAIL` varchar(100) NOT NULL,
  `NO_TELP` varchar(100) DEFAULT NULL,
  `TIPE_AKUN` varchar(10) NOT NULL,
  `USERNAME` varchar(100) DEFAULT NULL,
  `PASSWORD` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`ID_USER`, `NAMA_LENGKAP`, `TANGGAL_LAHIR`, `GENDER`, `ALAMAT`, `EMAIL`, `NO_TELP`, `TIPE_AKUN`, `USERNAME`, `PASSWORD`) VALUES
(1, 'Admin', '2000-01-01', 'Laki-laki', 'Rungkut, Surabaya', 'admin@gmail.com', '0821246476', 'Admin', 'admin', 'admin'),
(2, 'John Doe', '1990-05-15', 'Laki-laki', '123 Main Street', 'john.doe@email.com', '1234567890', 'Karyawan', 'john_doe', '123'),
(3, 'Jane Doe', '2000-01-01', 'Perempuan', '456 Oak Street', 'jane.doe@email.com', '9876543210', 'Karyawan', 'jane_doe', 'securepass'),
(4, 'Bob Smith', '2000-01-01', 'Laki-laki', '789 Pine Street', 'bob.smith@email.com', '5551234567', 'Karyawan', 'bob_smith', 'pass123word'),
(5, 'Alice Johnson', '2000-01-01', 'Perempuan', '101 Cedar Street', 'alice.johnson@email.com', '9998887776', 'Karyawan', 'alice_j', 'mysecretpassword');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`ID_BRAND`),
  ADD UNIQUE KEY `NAMA_BRAND` (`NAMA_BRAND`);

--
-- Indeks untuk tabel `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD PRIMARY KEY (`ID_DETAIL_TRANSAKSI`),
  ADD KEY `ID_TRANSAKSI` (`ID_TRANSAKSI`),
  ADD KEY `ID_PHONE` (`ID_PHONE`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `phones`
--
ALTER TABLE `phones`
  ADD PRIMARY KEY (`ID_PHONE`),
  ADD UNIQUE KEY `NAMA_HANDPHONE` (`NAMA_HANDPHONE`),
  ADD KEY `ID_BRAND` (`ID_BRAND`);

--
-- Indeks untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`ID_SESSION`),
  ADD KEY `ID_USER` (`ID_USER`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`ID_TRANSAKSI`),
  ADD KEY `ID_USER` (`ID_USER`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID_USER`),
  ADD UNIQUE KEY `EMAIL` (`EMAIL`),
  ADD UNIQUE KEY `NO_TELP` (`NO_TELP`),
  ADD UNIQUE KEY `USERNAME` (`USERNAME`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `brands`
--
ALTER TABLE `brands`
  MODIFY `ID_BRAND` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  MODIFY `ID_DETAIL_TRANSAKSI` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `phones`
--
ALTER TABLE `phones`
  MODIFY `ID_PHONE` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `sessions`
--
ALTER TABLE `sessions`
  MODIFY `ID_SESSION` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `ID_TRANSAKSI` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `ID_USER` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD CONSTRAINT `detail_transaksi_ibfk_1` FOREIGN KEY (`ID_TRANSAKSI`) REFERENCES `transaksi` (`ID_TRANSAKSI`),
  ADD CONSTRAINT `detail_transaksi_ibfk_2` FOREIGN KEY (`ID_PHONE`) REFERENCES `phones` (`ID_PHONE`);

--
-- Ketidakleluasaan untuk tabel `phones`
--
ALTER TABLE `phones`
  ADD CONSTRAINT `phones_ibfk_1` FOREIGN KEY (`ID_BRAND`) REFERENCES `brands` (`ID_BRAND`);

--
-- Ketidakleluasaan untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD CONSTRAINT `sessions_ibfk_1` FOREIGN KEY (`ID_USER`) REFERENCES `users` (`ID_USER`);

--
-- Ketidakleluasaan untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`ID_USER`) REFERENCES `users` (`ID_USER`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
