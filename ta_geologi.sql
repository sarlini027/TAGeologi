-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 24 Agu 2024 pada 21.30
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
-- Database: `ta_geologi`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `bot_telegram`
--

CREATE TABLE `bot_telegram` (
  `id` int(5) UNSIGNED NOT NULL,
  `token` varchar(255) NOT NULL,
  `chat_id` varchar(255) DEFAULT NULL,
  `group_id` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `bot_telegram`
--

INSERT INTO `bot_telegram` (`id`, `token`, `chat_id`, `group_id`, `created_at`, `updated_at`) VALUES
(1, '7498500525:AAEpDsUpW01MtR8CI5Di_Ep2tt93UOFrS9A', '-1002151170400', NULL, '2024-08-25 01:50:45', '2024-08-25 01:50:45');

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_indikator_penilaian`
--

CREATE TABLE `detail_indikator_penilaian` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_indikator` int(11) UNSIGNED NOT NULL,
  `bobot` int(11) UNSIGNED NOT NULL,
  `keterangan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `detail_indikator_penilaian`
--

INSERT INTO `detail_indikator_penilaian` (`id`, `id_indikator`, `bobot`, `keterangan`) VALUES
(1, 1, 3, 'Latar belakang dijelaskan dengan sangat baik dan berhasil menunjukkan urgensi penelitian di kawasan tersebut'),
(2, 1, 2, 'Latar belakang dan urgensi penelitian dijelaskan dengan cukup baik'),
(3, 1, 1, 'Tujuan penelitian dapat terukur dengan ruang lingkup yang baik'),
(4, 2, 2, '50-80% referensi menggunakan  referensi 10 tahun terakhir namun semua referensi tercantum di daftar pustaka'),
(5, 2, 3, '80% referensi menggunakan referensi 10 tahun terakhir dan semua referensi tercantum di daftar pustaka'),
(6, 3, 3, 'Metode dijabarkan dengan cukup jelas dan cukup mudah difahami'),
(7, 3, 5, 'Metode dijabarkan dengan sangat jelas dan mudah difahami'),
(8, 3, 1, 'Metode tidak dijabarkan dengan baik'),
(9, 4, 3, 'Alur penelitian dijabarkan dengan sangat jelas dan mudah difahami'),
(10, 4, 2, 'Alur penelitian dijabarkan dengan cukup jelas dan cukup mudah difahami'),
(11, 4, 1, 'Alur penelitian tidak dijabarkan dengan baik'),
(12, 5, 4, 'Tidak ada typo dan sesuai format'),
(13, 5, 3, 'Masih terdapat typo namun sesuai format'),
(14, 5, 3, 'Tidak terdapat typo namun format kurang tepat'),
(15, 5, 1, 'Tidak sesuai format dan/atau banyak typo'),
(16, 6, 4, '(1) Sesuai EYD'),
(17, 6, 4, '(2) Kalimat mudah difahami'),
(18, 6, 2, 'Satu kriteria terpenuhi'),
(19, 7, 4, '(1) Penomoran gambar dan tabel sesuai; (2) semua tabel dan gambar disitir di dalam kalimat'),
(20, 8, 4, 'Tidak ada typo dan sesuai format'),
(21, 8, 3, 'Masih terdapat typo namun sesuai format'),
(22, 8, 3, 'Tidak terdapat typo namun format kurang tepat'),
(23, 9, 4, '(1) Sesuai EYD'),
(24, 9, 4, '(2) Kalimat mudah difahami'),
(25, 9, 2, 'Satu kriteria terpenuhi'),
(26, 10, 2, 'Tujuan penelitian dapat terukur dengan ruang lingkup yang baik'),
(27, 10, 1, 'Tujuan penelitian dapat terukur dengan ruang lingkup yang cukup baik'),
(28, 10, 0, 'Tujuan penelitian dan ruang lingkup tidak dapat dijelaskan dengan baik');

-- --------------------------------------------------------

--
-- Struktur dari tabel `indikator_penilaian`
--

CREATE TABLE `indikator_penilaian` (
  `id` int(11) UNSIGNED NOT NULL,
  `indikator` varchar(255) NOT NULL,
  `tipe` enum('seminar_kemajuan','seminar_hasil','sidang_akhir') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `indikator_penilaian`
--

INSERT INTO `indikator_penilaian` (`id`, `indikator`, `tipe`) VALUES
(1, 'Latar Belakang dan Tujuan', 'seminar_kemajuan'),
(2, 'Tinjauan Pustaka', 'seminar_kemajuan'),
(3, 'Metode Penelitian', 'seminar_kemajuan'),
(4, 'Metode Penelitian 2', 'seminar_kemajuan'),
(5, 'Kaidah Penulisan', 'seminar_hasil'),
(6, 'Kaidah Penulisan 2', 'seminar_hasil'),
(7, 'Kaidah Penulisan 3', 'seminar_hasil'),
(8, 'Kaidah Penulisan', 'sidang_akhir'),
(9, 'Kaidah Penulisan 2', 'sidang_akhir'),
(10, 'Latar Belakang dan tujuan', 'sidang_akhir');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(28, '2024-08-11-084958', 'App\\Database\\Migrations\\UserTable', 'default', 'App', 1724288083, 1),
(29, '2024-08-13-051238', 'App\\Database\\Migrations\\SeminarKemajuanTable', 'default', 'App', 1724288083, 1),
(30, '2024-08-13-051248', 'App\\Database\\Migrations\\SeminarHasilTable', 'default', 'App', 1724288083, 1),
(31, '2024-08-13-051256', 'App\\Database\\Migrations\\SidangAkhirTable', 'default', 'App', 1724288083, 1),
(32, '2024-08-19-050655', 'App\\Database\\Migrations\\IndikatorPenilaianTable', 'default', 'App', 1724288083, 1),
(33, '2024-08-19-051239', 'App\\Database\\Migrations\\DetailIndikatorPenilaianTable', 'default', 'App', 1724288083, 1),
(34, '2024-08-19-053239', 'App\\Database\\Migrations\\PenilaianTable', 'default', 'App', 1724288083, 1),
(35, '2024-08-19-053821', 'App\\Database\\Migrations\\TemplateTable', 'default', 'App', 1724288083, 1),
(36, '2024-08-19-183921', 'App\\Database\\Migrations\\TempPenilaianTable', 'default', 'App', 1724288083, 1),
(37, '2024-08-24-182447', 'App\\Database\\Migrations\\BotTelegramTable', 'default', 'App', 1724523993, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `penilaian`
--

CREATE TABLE `penilaian` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_mahasiswa` int(11) UNSIGNED NOT NULL,
  `id_dosen` int(11) UNSIGNED NOT NULL,
  `id_detail_indikator` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `seminar_hasil`
--

CREATE TABLE `seminar_hasil` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `bukti_kehadiran` varchar(255) NOT NULL,
  `kendali_bimbingan` varchar(255) NOT NULL,
  `form_pendaftaran` varchar(255) NOT NULL,
  `status_validasi` tinyint(1) NOT NULL DEFAULT 0,
  `id_dosen_penguji_1` int(10) UNSIGNED DEFAULT NULL,
  `id_dosen_penguji_2` int(10) UNSIGNED DEFAULT NULL,
  `id_dosen_pembimbing_1` int(10) UNSIGNED DEFAULT NULL,
  `id_dosen_pembimbing_2` int(10) UNSIGNED DEFAULT NULL,
  `tgl_mulai` datetime DEFAULT NULL,
  `ruang` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `seminar_hasil`
--

INSERT INTO `seminar_hasil` (`id`, `user_id`, `bukti_kehadiran`, `kendali_bimbingan`, `form_pendaftaran`, `status_validasi`, `id_dosen_penguji_1`, `id_dosen_penguji_2`, `id_dosen_pembimbing_1`, `id_dosen_pembimbing_2`, `tgl_mulai`, `ruang`, `created_at`, `updated_at`) VALUES
(1, 2, 'http://localhost:8080/uploads/seminar-hasil/bukti-kehadiran/KHS_2023_2024_GENAP.pdf', 'http://localhost:8080/uploads/seminar-hasil/kendali-bimbingan/Desain tanpa judul.pdf', 'http://localhost:8080/uploads/seminar-hasil/form-pendaftaran-dosbing/Desain tanpa judul.pdf', 1, 7, 8, 6, NULL, '2024-08-23 01:28:00', 'Ruang M.11', '2024-08-23 01:25:02', '2024-08-23 01:25:02'),
(2, 3, 'http://localhost:8080/uploads/seminar-hasil/bukti-kehadiran/1723102609533-5727-Article Text-16632-1-10-20221106.pdf', 'http://localhost:8080/uploads/seminar-hasil/kendali-bimbingan/1723102609533-5727-Article Text-16632-1-10-20221106 (1).pdf', 'http://localhost:8080/uploads/seminar-hasil/form-pendaftaran-dosbing/1723102609533-5727-Article Text-16632-1-10-20221106.pdf', 1, 7, NULL, 6, NULL, '2024-08-23 01:28:00', 'Ruang M.10', '2024-08-23 01:26:22', '2024-08-23 01:26:22'),
(3, 4, 'http://localhost:8080/uploads/seminar-hasil/bukti-kehadiran/Desain tanpa judul.pdf', 'http://localhost:8080/uploads/seminar-hasil/kendali-bimbingan/Desain tanpa judul.pdf', 'http://localhost:8080/uploads/seminar-hasil/form-pendaftaran-dosbing/Desain tanpa judul.pdf', 1, 5, 7, 6, NULL, '2024-08-25 02:21:00', 'Ruang M.11', '2024-08-25 02:03:36', '2024-08-25 02:03:36');

-- --------------------------------------------------------

--
-- Struktur dari tabel `seminar_kemajuan`
--

CREATE TABLE `seminar_kemajuan` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `draft_proposal` varchar(255) NOT NULL,
  `lembar_pendaftaran` varchar(255) NOT NULL,
  `status_validasi` tinyint(1) NOT NULL DEFAULT 0,
  `id_dosen_penguji_1` int(10) UNSIGNED DEFAULT NULL,
  `id_dosen_penguji_2` int(10) UNSIGNED DEFAULT NULL,
  `id_dosen_pembimbing_1` int(10) UNSIGNED DEFAULT NULL,
  `id_dosen_pembimbing_2` int(10) UNSIGNED DEFAULT NULL,
  `tgl_mulai` datetime DEFAULT NULL,
  `ruang` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `seminar_kemajuan`
--

INSERT INTO `seminar_kemajuan` (`id`, `user_id`, `draft_proposal`, `lembar_pendaftaran`, `status_validasi`, `id_dosen_penguji_1`, `id_dosen_penguji_2`, `id_dosen_pembimbing_1`, `id_dosen_pembimbing_2`, `tgl_mulai`, `ruang`, `created_at`, `updated_at`) VALUES
(1, 2, 'http://localhost:8080/uploads/seminar-kemajuan/draft-proposal/1723102609533-5727-Article Text-16632-1-10-20221106 (1).pdf', 'http://localhost:8080/uploads/seminar-kemajuan/lembar-pendaftaran/1723102609533-5727-Article Text-16632-1-10-20221106.pdf', 1, 7, NULL, 6, NULL, '2024-08-22 19:19:00', 'Ruang M.23', '2024-08-22 19:17:41', '2024-08-22 19:17:41'),
(2, 3, 'http://localhost:8080/uploads/seminar-kemajuan/draft-proposal/1723102609533-5727-Article Text-16632-1-10-20221106.pdf', 'http://localhost:8080/uploads/seminar-kemajuan/lembar-pendaftaran/Desain tanpa judul.pdf', 1, 5, NULL, 6, NULL, '2024-08-22 19:19:00', 'Ruang M.10', '2024-08-22 19:18:11', '2024-08-22 19:18:11'),
(3, 4, 'http://localhost:8080/uploads/seminar-kemajuan/draft-proposal/1723102609533-5727-Article Text-16632-1-10-20221106 (1)_1.pdf', 'http://localhost:8080/uploads/seminar-kemajuan/lembar-pendaftaran/1723102609533-5727-Article Text-16632-1-10-20221106 (1).pdf', 1, 8, NULL, 6, NULL, '2024-08-25 02:24:00', 'Ruang M.11', '2024-08-22 19:18:51', '2024-08-22 19:18:51');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sidang_akhir`
--

CREATE TABLE `sidang_akhir` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `kendali_bimbingan` varchar(255) NOT NULL,
  `form_pendaftaran` varchar(255) NOT NULL,
  `form_bimbingan` varchar(255) NOT NULL,
  `kehadiran_seminar` varchar(255) NOT NULL,
  `nilai_kompre` varchar(255) NOT NULL,
  `transkrip_nilai` varchar(255) NOT NULL,
  `status_validasi` tinyint(1) NOT NULL DEFAULT 0,
  `id_dosen_penguji_1` int(11) UNSIGNED DEFAULT NULL,
  `id_dosen_penguji_2` int(11) UNSIGNED DEFAULT NULL,
  `id_dosen_pembimbing_1` int(11) UNSIGNED DEFAULT NULL,
  `id_dosen_pembimbing_2` int(11) UNSIGNED DEFAULT NULL,
  `tgl_mulai` datetime DEFAULT NULL,
  `ruang` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `sidang_akhir`
--

INSERT INTO `sidang_akhir` (`id`, `user_id`, `kendali_bimbingan`, `form_pendaftaran`, `form_bimbingan`, `kehadiran_seminar`, `nilai_kompre`, `transkrip_nilai`, `status_validasi`, `id_dosen_penguji_1`, `id_dosen_penguji_2`, `id_dosen_pembimbing_1`, `id_dosen_pembimbing_2`, `tgl_mulai`, `ruang`, `created_at`, `updated_at`) VALUES
(1, 2, 'http://localhost:8080/uploads/sidang-akhir/kendali-bimbingan/1723102609533-5727-Article Text-16632-1-10-20221106.pdf', 'http://localhost:8080/uploads/sidang-akhir/form-pendaftaran-sidang/Desain tanpa judul.pdf', 'http://localhost:8080/uploads/sidang-akhir/form-bimbingan/1723102609533-5727-Article Text-16632-1-10-20221106.pdf', 'http://localhost:8080/uploads/sidang-akhir/kehadiran-seminar/inovasi-126136.pdf', '88', 'http://localhost:8080/uploads/sidang-akhir/transkrip-nilai/inovasi-126136.pdf', 1, 7, 8, 6, NULL, '2024-08-23 02:25:00', 'Ruang M.23', '2024-08-23 01:25:55', '2024-08-23 01:25:55'),
(2, 3, 'http://localhost:8080/uploads/sidang-akhir/kendali-bimbingan/Desain tanpa judul.pdf', 'http://localhost:8080/uploads/sidang-akhir/form-pendaftaran-sidang/Desain tanpa judul_1.pdf', 'http://localhost:8080/uploads/sidang-akhir/form-bimbingan/1723102609533-5727-Article Text-16632-1-10-20221106_1.pdf', 'http://localhost:8080/uploads/sidang-akhir/kehadiran-seminar/1723102609533-5727-Article Text-16632-1-10-20221106 (1).pdf', '90', 'http://localhost:8080/uploads/sidang-akhir/transkrip-nilai/1723102609533-5727-Article Text-16632-1-10-20221106 (1).pdf', 1, 8, 5, 6, NULL, '2024-08-25 02:27:00', 'Ruang M.23', '2024-08-23 01:26:58', '2024-08-23 01:26:58');

-- --------------------------------------------------------

--
-- Struktur dari tabel `template`
--

CREATE TABLE `template` (
  `id` int(11) UNSIGNED NOT NULL,
  `nama_template` varchar(255) NOT NULL,
  `file_template` varchar(255) NOT NULL,
  `ikon` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `temp_penilaian`
--

CREATE TABLE `temp_penilaian` (
  `id` int(5) UNSIGNED NOT NULL,
  `id_indikator` int(5) UNSIGNED NOT NULL,
  `id_detail_indikator` int(5) UNSIGNED NOT NULL,
  `id_dosen` int(5) UNSIGNED NOT NULL,
  `id_mahasiswa` int(5) UNSIGNED NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `temp_penilaian`
--

INSERT INTO `temp_penilaian` (`id`, `id_indikator`, `id_detail_indikator`, `id_dosen`, `id_mahasiswa`, `created_at`, `updated_at`) VALUES
(25, 1, 1, 6, 4, NULL, NULL),
(26, 2, 4, 6, 4, NULL, NULL),
(27, 3, 6, 6, 4, NULL, NULL),
(28, 4, 9, 6, 4, NULL, NULL),
(33, 1, 1, 7, 2, NULL, NULL),
(34, 2, 5, 7, 2, NULL, NULL),
(35, 3, 7, 7, 2, NULL, NULL),
(36, 4, 10, 7, 2, NULL, NULL),
(86, 1, 1, 6, 2, NULL, NULL),
(87, 2, 4, 6, 2, NULL, NULL),
(88, 3, 7, 6, 2, NULL, NULL),
(89, 4, 9, 6, 2, NULL, NULL),
(99, 8, 20, 6, 2, NULL, NULL),
(100, 9, 25, 6, 2, NULL, NULL),
(101, 10, 26, 6, 2, NULL, NULL),
(105, 5, 12, 6, 2, NULL, NULL),
(106, 6, 18, 6, 2, NULL, NULL),
(107, 7, 19, 6, 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','dosen','mahasiswa') NOT NULL DEFAULT 'mahasiswa',
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `nama_lengkap`, `username`, `password`, `role`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'admin', '$2y$10$Na67LHq.TJ643VCvnRUQ3.x3SB8LBnq3msQ1eo4N/7LSykLI66GYS', 'admin', '2024-08-22 07:54:51', NULL),
(2, 'Andre', '11223344', '$2y$10$EhTfQdQK2I3O8GgCDOOJPO.tfrLEkt4PeTBicXD2WvP4UE7MDOOq6', 'mahasiswa', '2024-08-22 07:54:51', NULL),
(3, 'Budi', '22334455', '$2y$10$BWBKlSKbkZmbwpB9GSRkPuKEJKMGjUdlvN4zkwaBovishPjmQeTgG', 'mahasiswa', '2024-08-22 07:54:51', NULL),
(4, 'Cici', '33445566', '$2y$10$gatXoyQwB3C6mnJAYuJTQuCOgDvbJq55ivd/tAqZh09a1iv1ZHj2m', 'mahasiswa', '2024-08-22 07:54:51', NULL),
(5, 'Siswanto, M.TI., Ph.D.', '999', '$2y$10$3Gj.i/TYkacF1xfNdIle7OPxlGlw.6anNNYPaJ60dACFV4mrW8RPG', 'dosen', '2024-08-22 07:54:54', NULL),
(6, 'Rahmat Hidayat, S.T., M.T.', '998', '$2y$10$einq.5eHhkNy3/k.iN3/bOB4rZSov3crzmuH9NtfAFRRujFY3dohi', 'dosen', '2024-08-22 07:54:54', NULL),
(7, 'Andri Pranolo, S.T., M.T.', '997', '$2y$10$JEhx9B8hCq9FfLsRRtN3C.Lr.QnlzwEaNdJhEgXA1Rlcyw7y6gKC.', 'dosen', '2024-08-22 07:54:54', NULL),
(8, 'Dwi Haryanto, S.T., M.T.', '996', '$2y$10$X//ZRoUIBWaZnSYihH243.g9H4jQhH4m/Dpsyq3qLF4AEU3Xrq5H6', 'dosen', '2024-08-22 07:54:54', NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `bot_telegram`
--
ALTER TABLE `bot_telegram`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `detail_indikator_penilaian`
--
ALTER TABLE `detail_indikator_penilaian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detail_indikator_penilaian_id_indikator_foreign` (`id_indikator`);

--
-- Indeks untuk tabel `indikator_penilaian`
--
ALTER TABLE `indikator_penilaian`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `penilaian`
--
ALTER TABLE `penilaian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `penilaian_id_mahasiswa_foreign` (`id_mahasiswa`),
  ADD KEY `penilaian_id_dosen_foreign` (`id_dosen`),
  ADD KEY `penilaian_id_detail_indikator_foreign` (`id_detail_indikator`);

--
-- Indeks untuk tabel `seminar_hasil`
--
ALTER TABLE `seminar_hasil`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `id_dosen_penguji_1` (`id_dosen_penguji_1`),
  ADD KEY `id_dosen_penguji_2` (`id_dosen_penguji_2`),
  ADD KEY `id_dosen_pembimbing_1` (`id_dosen_pembimbing_1`),
  ADD KEY `id_dosen_pembimbing_2` (`id_dosen_pembimbing_2`);

--
-- Indeks untuk tabel `seminar_kemajuan`
--
ALTER TABLE `seminar_kemajuan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `id_dosen_penguji_1` (`id_dosen_penguji_1`),
  ADD KEY `id_dosen_penguji_2` (`id_dosen_penguji_2`),
  ADD KEY `id_dosen_pembimbing_1` (`id_dosen_pembimbing_1`),
  ADD KEY `id_dosen_pembimbing_2` (`id_dosen_pembimbing_2`);

--
-- Indeks untuk tabel `sidang_akhir`
--
ALTER TABLE `sidang_akhir`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `id_dosen_penguji_1` (`id_dosen_penguji_1`),
  ADD KEY `id_dosen_penguji_2` (`id_dosen_penguji_2`),
  ADD KEY `id_dosen_pembimbing_1` (`id_dosen_pembimbing_1`),
  ADD KEY `id_dosen_pembimbing_2` (`id_dosen_pembimbing_2`);

--
-- Indeks untuk tabel `template`
--
ALTER TABLE `template`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `temp_penilaian`
--
ALTER TABLE `temp_penilaian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `temp_penilaian_id_indikator_foreign` (`id_indikator`),
  ADD KEY `temp_penilaian_id_detail_indikator_foreign` (`id_detail_indikator`),
  ADD KEY `temp_penilaian_id_dosen_foreign` (`id_dosen`),
  ADD KEY `temp_penilaian_id_mahasiswa_foreign` (`id_mahasiswa`);

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
-- AUTO_INCREMENT untuk tabel `bot_telegram`
--
ALTER TABLE `bot_telegram`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `detail_indikator_penilaian`
--
ALTER TABLE `detail_indikator_penilaian`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT untuk tabel `indikator_penilaian`
--
ALTER TABLE `indikator_penilaian`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT untuk tabel `penilaian`
--
ALTER TABLE `penilaian`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `seminar_hasil`
--
ALTER TABLE `seminar_hasil`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `seminar_kemajuan`
--
ALTER TABLE `seminar_kemajuan`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `sidang_akhir`
--
ALTER TABLE `sidang_akhir`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `template`
--
ALTER TABLE `template`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `temp_penilaian`
--
ALTER TABLE `temp_penilaian`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `detail_indikator_penilaian`
--
ALTER TABLE `detail_indikator_penilaian`
  ADD CONSTRAINT `detail_indikator_penilaian_id_indikator_foreign` FOREIGN KEY (`id_indikator`) REFERENCES `indikator_penilaian` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `penilaian`
--
ALTER TABLE `penilaian`
  ADD CONSTRAINT `penilaian_id_detail_indikator_foreign` FOREIGN KEY (`id_detail_indikator`) REFERENCES `detail_indikator_penilaian` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `penilaian_id_dosen_foreign` FOREIGN KEY (`id_dosen`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `penilaian_id_mahasiswa_foreign` FOREIGN KEY (`id_mahasiswa`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `seminar_hasil`
--
ALTER TABLE `seminar_hasil`
  ADD CONSTRAINT `seminar_hasil_id_dosen_pembimbing_1_foreign` FOREIGN KEY (`id_dosen_pembimbing_1`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `seminar_hasil_id_dosen_pembimbing_2_foreign` FOREIGN KEY (`id_dosen_pembimbing_2`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `seminar_hasil_id_dosen_penguji_1_foreign` FOREIGN KEY (`id_dosen_penguji_1`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `seminar_hasil_id_dosen_penguji_2_foreign` FOREIGN KEY (`id_dosen_penguji_2`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `seminar_hasil_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `seminar_kemajuan`
--
ALTER TABLE `seminar_kemajuan`
  ADD CONSTRAINT `seminar_kemajuan_id_dosen_pembimbing_1_foreign` FOREIGN KEY (`id_dosen_pembimbing_1`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `seminar_kemajuan_id_dosen_pembimbing_2_foreign` FOREIGN KEY (`id_dosen_pembimbing_2`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `seminar_kemajuan_id_dosen_penguji_1_foreign` FOREIGN KEY (`id_dosen_penguji_1`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `seminar_kemajuan_id_dosen_penguji_2_foreign` FOREIGN KEY (`id_dosen_penguji_2`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `seminar_kemajuan_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `sidang_akhir`
--
ALTER TABLE `sidang_akhir`
  ADD CONSTRAINT `sidang_akhir_id_dosen_pembimbing_1_foreign` FOREIGN KEY (`id_dosen_pembimbing_1`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sidang_akhir_id_dosen_pembimbing_2_foreign` FOREIGN KEY (`id_dosen_pembimbing_2`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sidang_akhir_id_dosen_penguji_1_foreign` FOREIGN KEY (`id_dosen_penguji_1`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sidang_akhir_id_dosen_penguji_2_foreign` FOREIGN KEY (`id_dosen_penguji_2`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sidang_akhir_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `temp_penilaian`
--
ALTER TABLE `temp_penilaian`
  ADD CONSTRAINT `temp_penilaian_id_detail_indikator_foreign` FOREIGN KEY (`id_detail_indikator`) REFERENCES `detail_indikator_penilaian` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `temp_penilaian_id_dosen_foreign` FOREIGN KEY (`id_dosen`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `temp_penilaian_id_indikator_foreign` FOREIGN KEY (`id_indikator`) REFERENCES `indikator_penilaian` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `temp_penilaian_id_mahasiswa_foreign` FOREIGN KEY (`id_mahasiswa`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
