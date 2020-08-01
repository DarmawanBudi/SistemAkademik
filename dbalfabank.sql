-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 02 Jul 2020 pada 03.32
-- Versi server: 10.4.13-MariaDB
-- Versi PHP: 7.3.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbalfabank`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `instruktur`
--

CREATE TABLE `instruktur` (
  `id_instruktur` varchar(7) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `nama` varchar(20) NOT NULL,
  `email` varchar(20) NOT NULL,
  `kelamin` varchar(20) NOT NULL,
  `hp` varchar(20) NOT NULL,
  `id_program` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `instruktur`
--

INSERT INTO `instruktur` (`id_instruktur`, `username`, `password`, `nama`, `email`, `kelamin`, `hp`, `id_program`) VALUES
('I0001', 'user', '1234', 'user', 'user@gmail.com', 'Pria', '085729891118', 'P0001 P0002 P0003 '),
('I0002', 'budi', '1234', 'budi', 'budi@gmail.com', 'Pria', '085729891118', 'P0001 P0003 '),
('I0003', 'admin', 'admin', 'admin', 'admin@gmail.com', 'Pria', '085729891118', 'P0001 P0002 P0003 P0004 ');

-- --------------------------------------------------------

--
-- Struktur dari tabel `karyawan`
--

CREATE TABLE `karyawan` (
  `id_karyawan` varchar(7) NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `kelamin` varchar(10) NOT NULL,
  `hp` varchar(12) NOT NULL,
  `id_role` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `karyawan`
--

INSERT INTO `karyawan` (`id_karyawan`, `username`, `password`, `nama`, `email`, `kelamin`, `hp`, `id_role`) VALUES
('K0001', 'admin', 'admin', 'admin', 'admin@gmail.com', 'Pria', '085729891118', 'R0001'),
('K0002', 'frontoffice', 'frontoffice', 'frontoffice', 'frontoffice@gmail.com', 'Pria', '085729891118', 'R0004'),
('K0003', 'adm', 'adm', 'adm', 'adm@gmail.com', 'Pria', '085729891118', 'R0001'),
('K0004', 'fo', 'fo', 'fo', 'fo', 'Pria', '085729891118', 'R0004'),
('K0006', 'darmawan', '1234', 'darmawan', 'darmawan@gmail.com', 'Pria', '085729891118', 'R0001'),
('K0007', 'akademik', 'akademik', 'akademik', 'akademik@gmail.com', 'Pria', '085729891118', 'R0003');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` varchar(10) NOT NULL,
  `id_program` varchar(7) NOT NULL,
  `id_waktu` varchar(7) NOT NULL,
  `id_ruang` varchar(7) NOT NULL,
  `id_instruktur` varchar(7) NOT NULL,
  `keterangan` varchar(10) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `id_program`, `id_waktu`, `id_ruang`, `id_instruktur`, `keterangan`, `status`) VALUES
('', 'P0001', 'W0001', 'R0001', 'I0001', 'Reguler', 'Aktif'),
('K0001', 'P0001', 'W0001', 'R0001', 'I0001', 'Reguler', 'Aktif');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayaran`
--

CREATE TABLE `pembayaran` (
  `nota` varchar(9) NOT NULL,
  `nis` varchar(9) NOT NULL,
  `nominal` int(9) NOT NULL,
  `tanggal` date NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pembayaran`
--

INSERT INTO `pembayaran` (`nota`, `nis`, `nominal`, `tanggal`, `keterangan`) VALUES
('B0002', 'S0001', 100000, '2020-06-26', 'Pendaftaran'),
('B0005', 'S0001', 200000, '2020-06-26', 'Angsuran 3'),
('N0001', 'S0001', 50000, '2020-07-01', 'Angsuran 4');

-- --------------------------------------------------------

--
-- Struktur dari tabel `program`
--

CREATE TABLE `program` (
  `id_program` varchar(9) NOT NULL,
  `nama_program` varchar(30) NOT NULL,
  `keterangan` text NOT NULL,
  `sesi` int(2) NOT NULL,
  `biaya` int(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `program`
--

INSERT INTO `program` (`id_program`, `nama_program`, `keterangan`, `sesi`, `biaya`) VALUES
('P0001', 'Desain Grafis', 'Seorang grafis desainer harus memiliki konsep dari apa yang akan dituangkan dalam sebuah karya. Tidak hanya membuat suatu karya yang bagus, tapi juga lebih memiliki makna yang sesuai dengan tema desain visual yang akan ditampilkan.', 1, 200000),
('P0002', 'Rancang Bangun', 'Meliputi beberapa sub materi program yang wajib dikuasai oleh peserta Kursus dan pelatihan Rancang Bangununtuk teknik sipil terbaik di jogja, sobat akan dibimbing oleh seorang instruktur yang juga adalah praktisi ahli yang sarat pengalaman dibidang Teknik sipil. Berdedikasi tinggi dan tidak pernah pelit untuk berbagi dalam segala hal tentu tidak terkecuali dalam memberikan tip dan trik praktis yang aplikatif terkait aplikasi yang di pelajari.', 6, 100000),
('P0003', 'Web Desain & web programming', 'Kemampuan merancag dan memrogram web yang dinamis dan handal agaknya sudah menjadi hal yang harus dan lumrah untuk dikuasai saat ini. Dipicu pekembangan teknologi internet yang semakin tak terbendung dengan berbagai kemudahan dan platform yang ditawarkan benar-benar mampu menjadikan dunia didalam genggaman kita. Bagi yang belum memiliki keahlian dan keterampilan yang cukup dalam hal Web design & web programming. Masih belum terlambat untuk memulai mengenal dan mempelajari hal-hal terkait dengan proses pembuatan sebuah website meliputi merancang, membuat, memrogramnya serta mempublikasikannya.', 6, 1000000),
('P0004', 'Komputer Akuntansi', 'Sudah memiliki pengetahuan dasar akuntansi keuangan manual? belum lah lengkap jika tidak diberngi  kemampuan mengoperasikan program akuntansi seperti MYOB Accounting, Zahir Accounting, Accurate Accounting ataupun Excel Accounting. Efisiensi dan efektifitas kerja adalah tujuan utama dari penguasaan program-program komputer akuntansi tersebut sebab di era teknologi informasi yang serba cepat ini profesional muda yang bekerja dibagian keuangan dan akuntan, baik di instansi pemerintahan terlebih lagi di perusahaan swasta dituntut pula untuk dapat lebih cepat dan akurat dalam menyelesaikan pelaporan keuangannya.', 1, 500000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `role`
--

CREATE TABLE `role` (
  `id_role` varchar(7) NOT NULL,
  `user_role` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `role`
--

INSERT INTO `role` (`id_role`, `user_role`) VALUES
('R0001', 'admin'),
('R0002', 'keuangan'),
('R0003', 'akademik'),
('R0004', 'front office');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ruang`
--

CREATE TABLE `ruang` (
  `id_ruang` varchar(7) NOT NULL,
  `ruang` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `ruang`
--

INSERT INTO `ruang` (`id_ruang`, `ruang`) VALUES
('R0001', 'Ruang 01');

-- --------------------------------------------------------

--
-- Struktur dari tabel `siswa`
--

CREATE TABLE `siswa` (
  `nis` varchar(9) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nama` varchar(25) NOT NULL,
  `email` varchar(30) NOT NULL,
  `jenis` varchar(10) NOT NULL,
  `tempat` varchar(20) NOT NULL,
  `lahir` date NOT NULL,
  `agama` varchar(15) NOT NULL,
  `hp` varchar(15) NOT NULL,
  `status_sekolah` varchar(20) NOT NULL,
  `asal_sekolah` varchar(25) NOT NULL,
  `kerja` varchar(30) NOT NULL,
  `status` varchar(10) NOT NULL,
  `prog` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `siswa`
--

INSERT INTO `siswa` (`nis`, `username`, `password`, `nama`, `email`, `jenis`, `tempat`, `lahir`, `agama`, `hp`, `status_sekolah`, `asal_sekolah`, `kerja`, `status`, `prog`) VALUES
('S0001', 'user', '1234', 'user', 'user@gmail.com', 'Pria', 'sleman', '2020-06-26', 'Islam', '085729891118', 'lulus', 'smk', 'tidak', 'Daftar', 'P0004'),
('S0002', 'admin', '1234', 'admin', 'admin@gmail.com', 'Pria', 'sleman', '2020-06-26', 'Islam', '085729891118', 'lulus', 'smk', 'tidak', 'Daftar', 'P0002'),
('S0003', 'budi', '1234', 'budi', 'budi@gmail.com', 'Pria', 'sleman', '2020-06-26', 'Islam', '085729891118', 'lulus', 'smk', 'tidak', 'Daftar', 'P0003');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(7) NOT NULL,
  `id_karyawan` int(7) NOT NULL,
  `id_role` int(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `waktu`
--

CREATE TABLE `waktu` (
  `id_waktu` varchar(7) NOT NULL,
  `mulai` time NOT NULL,
  `selesai` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `waktu`
--

INSERT INTO `waktu` (`id_waktu`, `mulai`, `selesai`) VALUES
('W0001', '07:00:00', '12:00:00'),
('W0002', '07:00:00', '12:00:00');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `instruktur`
--
ALTER TABLE `instruktur`
  ADD PRIMARY KEY (`id_instruktur`);

--
-- Indeks untuk tabel `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id_karyawan`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indeks untuk tabel `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indeks untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`nota`);

--
-- Indeks untuk tabel `program`
--
ALTER TABLE `program`
  ADD PRIMARY KEY (`id_program`);

--
-- Indeks untuk tabel `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id_role`);

--
-- Indeks untuk tabel `ruang`
--
ALTER TABLE `ruang`
  ADD PRIMARY KEY (`id_ruang`);

--
-- Indeks untuk tabel `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`nis`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indeks untuk tabel `waktu`
--
ALTER TABLE `waktu`
  ADD PRIMARY KEY (`id_waktu`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
