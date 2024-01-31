-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 31 Jan 2024 pada 11.01
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_notes`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `notes`
--

CREATE TABLE `notes` (
  `no` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `notes` text NOT NULL,
  `kategori` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `notes`
--

INSERT INTO `notes` (`no`, `judul`, `notes`, `kategori`) VALUES
(1, 'assasd', 'asdasd', 'sadasd'),
(2, 'asasdas', 'asdasd', 'asdasdasd'),
(3, 'Catatan matematika', 'Buatan Awan', 'Catatan RUmah'),
(4, 'Catatan matematika', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Nam mollitia repellendus maiores, facere alias laborum dolorum, nisi magni quo perspiciatis perferendis vitae eaque! Similique beatae eos sit cum eum omnis.', 'Catatan Keseharaian'),
(5, 'Catatan matematika', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Nam mollitia repellendus maiores, facere alias laborum dolorum, nisi magni quo perspiciatis perferendis vitae eaque! Similique beatae eos sit cum eum omnis.saaaaaaaaaaaaaaaaa', 'Catatan Keseharaian'),
(6, 'Catatan Sejarah', 'Halaman 100', 'PR'),
(7, 'Catatan Sejarah', 'ghh', 'mn bjb');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`no`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `notes`
--
ALTER TABLE `notes`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
