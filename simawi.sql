-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 30 Jan 2025 pada 06.59
-- Versi server: 10.4.18-MariaDB
-- Versi PHP: 7.4.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `simawi`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `medical_records`
--

CREATE TABLE `medical_records` (
  `id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `symptoms` text NOT NULL,
  `initial_diagnosis` text NOT NULL,
  `icd_code` varchar(10) DEFAULT NULL,
  `icd_description` text DEFAULT NULL,
  `status` enum('pending','completed') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `medical_records`
--

INSERT INTO `medical_records` (`id`, `patient_id`, `doctor_id`, `symptoms`, `initial_diagnosis`, `icd_code`, `icd_description`, `status`, `created_at`, `updated_at`) VALUES
(5, 9, 2, 'sakit pinggang', 'skoliosis', 'M41. 20', 'skoliosis melitus tubercolosis', 'completed', '2025-01-29 16:50:48', '2025-01-29 14:31:59'),
(6, 10, 2, 'pilek', 'Influenza', 'J00', 'Nasofaringitis akut [flu biasa]', 'completed', '2025-01-29 21:36:29', '2025-01-29 14:59:06'),
(7, 12, 2, '-', '-', 'J00', '-', 'pending', '2025-01-29 21:59:38', '2025-01-29 21:59:38');

-- --------------------------------------------------------

--
-- Struktur dari tabel `patients`
--

CREATE TABLE `patients` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `medical_record_number` varchar(50) NOT NULL,
  `age` int(11) NOT NULL,
  `gender` enum('male','female') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `birth` int(11) NOT NULL,
  `nik` varchar(16) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `address` text NOT NULL,
  `blood_type` enum('A','B','AB','O') NOT NULL,
  `weight` float NOT NULL,
  `height` float NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `patients`
--

INSERT INTO `patients` (`id`, `name`, `medical_record_number`, `age`, `gender`, `created_at`, `birth`, `nik`, `phone`, `address`, `blood_type`, `weight`, `height`, `updated_at`, `user_id`) VALUES
(9, 'Brodi', 'RM0001', 0, 'male', '2025-01-29 16:08:43', 2020, '5130975900008', '085739922444', 'sa', 'A', 60, 160, '2025-01-29 16:21:14', 2),
(10, 'Cece', 'RM0010', 0, 'male', '2025-01-29 09:20:51', 2012, '5130975900999', '085739977777', 'asdasda', 'A', 55, 124, '2025-01-29 09:20:51', 0),
(11, 'Brodi', 'RM0011', 0, 'male', '2025-01-29 09:27:16', 2012, '5130975900008', '085739922444', 'jl. Jenggala. No 16\r\nBlahkiuh, Abiansemal', 'A', 66, 179, '2025-01-29 09:27:16', 0),
(12, 'Ayu Mandela', 'RM0012', 0, 'male', '2025-01-29 09:37:16', 2010, '5130975977777', '085739977777', 'jalan badung', 'A', 66, 170, '2025-01-29 09:37:16', 0),
(40, 'Ahmad Fauzi', 'RM0006', 30, 'male', '2025-01-29 22:35:48', 1993, '3201010101010006', '081234567006', 'Jl. Merdeka No.6, Jakarta', 'A', 70, 175, '2025-01-29 22:35:48', 6),
(41, 'Dian Pratama', 'RM0007', 25, 'male', '2025-01-29 22:35:48', 1998, '3201010101010007', '081234567007', 'Jl. Sudirman No.7, Bandung', 'B', 65, 168, '2025-01-29 22:35:48', 7),
(42, 'Elisa Widya', 'RM0008', 28, 'female', '2025-01-29 22:35:48', 1995, '3201010101010008', '081234567008', 'Jl. Diponegoro No.8, Yogyakarta', 'AB', 55, 160, '2025-01-29 22:35:48', 8),
(43, 'Farhan Setiawan', 'RM0009', 35, 'male', '2025-01-29 22:35:48', 1988, '3201010101010009', '081234567009', 'Jl. Ahmad Yani No.9, Surabaya', 'O', 80, 180, '2025-01-29 22:35:48', 9),
(44, 'Joko Riyanto', 'RM0013', 26, 'male', '2025-01-29 22:35:48', 1997, '3201010101010013', '081234567013', 'Jl. Pemuda No.13, Palembang', 'AB', 85, 185, '2025-01-29 22:35:48', 13),
(45, 'Kurniawati', 'RM0014', 31, 'female', '2025-01-29 22:35:48', 1992, '3201010101010014', '081234567014', 'Jl. Sultan Agung No.14, Batam', 'A', 55, 158, '2025-01-29 22:35:48', 14),
(46, 'Lukman Hakim', 'RM0015', 27, 'male', '2025-01-29 22:35:48', 1996, '3201010101010015', '081234567015', 'Jl. Jendral Sudirman No.15, Denpasar', 'B', 72, 172, '2025-01-29 22:35:48', 15),
(75, 'Toto', 'RM0016', 0, 'male', '2025-01-29 18:15:32', 2000, '5130975900999', '085739977777', 'jl. Jenggala. No 16\r\nBlahkiuh, ', 'AB', 66, 170, '2025-01-29 18:15:32', 0),
(76, 'Mamat', 'RM0017', 0, 'male', '2025-01-29 19:07:31', 2012, '5130975977799', '085739977777', 'jl. Jenggala. No 16\r\nBlahkiuh, Abiansemal', 'A', 66, 140, '2025-01-29 19:07:31', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `role` enum('admin','doctor') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `name`, `role`, `created_at`, `updated_at`) VALUES
(1, 'admin', '$2y$10$JZP2G5WsIhhmWHgCvm.R7e6fkY/I3Sj4LRdtRkTiLU9rpjoCeZv8e', 'Toni Saputra', 'admin', '2025-01-29 11:19:11', '2025-01-29 14:39:50'),
(2, 'dokter', '$2y$10$a9BizPUjM6MsWSjzUhZbAOay46PY/iaOI.MpCROjjFppifgU0TvkK', 'Dr. Made Agus', 'doctor', '2025-01-29 11:19:11', '2025-01-29 14:40:05'),
(4, 'ufik', '$2y$10$q49ZdBqHitIvz0yoHjr0uegvIegq91Plb5uK0lWSz6krZTMveLDPG', 'Ufik Hidayat', 'admin', '2025-01-30 00:11:31', '2025-01-30 00:12:28');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `medical_records`
--
ALTER TABLE `medical_records`
  ADD PRIMARY KEY (`id`),
  ADD KEY `patient_id` (`patient_id`),
  ADD KEY `doctor_id` (`doctor_id`);

--
-- Indeks untuk tabel `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `medical_record_number` (`medical_record_number`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `medical_records`
--
ALTER TABLE `medical_records`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `patients`
--
ALTER TABLE `patients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `medical_records`
--
ALTER TABLE `medical_records`
  ADD CONSTRAINT `medical_records_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `medical_records_ibfk_2` FOREIGN KEY (`doctor_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

DELIMITER $$
--
-- Event
--
CREATE DEFINER=`root`@`localhost` EVENT `update_patient_age` ON SCHEDULE EVERY 1 DAY STARTS '2025-01-29 23:10:27' ON COMPLETION NOT PRESERVE ENABLE DO UPDATE patients SET age = TIMESTAMPDIFF(YEAR, birth, CURDATE())$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
