-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 03 Jul 2019 pada 05.36
-- Versi server: 10.1.37-MariaDB
-- Versi PHP: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kaskeluar_windu`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `akun`
--

CREATE TABLE `akun` (
  `id` int(6) NOT NULL,
  `kode` int(5) NOT NULL,
  `nama` varchar(35) NOT NULL,
  `jenis` varchar(20) NOT NULL,
  `saldo` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `is_deleted` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `akun`
--

INSERT INTO `akun` (`id`, `kode`, `nama`, `jenis`, `saldo`, `created_at`, `update_at`, `is_deleted`) VALUES
(1, 1111, 'Kas', 'Kas/Bank', 'Debet', '2019-05-12 15:36:09', '2019-06-19 14:43:36', NULL),
(2, 1112, 'Bank BCA', 'Kas/Bank', 'Debet', '2019-06-19 14:44:03', NULL, NULL),
(3, 5111, 'Biaya ATK', 'Beban', 'Kredit', '2019-06-19 14:44:26', NULL, NULL),
(4, 5112, 'Biaya Sewa Kendaraan', 'Beban', 'Kredit', '2019-06-19 14:44:49', NULL, NULL),
(5, 5113, 'Biaya Foto Copy', 'Beban', 'Kredit', '2019-06-19 14:45:15', NULL, NULL),
(6, 5114, 'Biaya Transport', 'Beban', 'Kredit', '2019-06-19 14:46:17', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_kaskeluar`
--

CREATE TABLE `detail_kaskeluar` (
  `id` int(6) NOT NULL,
  `id_kaskeluar` int(6) NOT NULL,
  `id_akun` int(6) NOT NULL,
  `nominal` int(12) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `is_deleted` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `detail_kaskeluar`
--

INSERT INTO `detail_kaskeluar` (`id`, `id_kaskeluar`, `id_akun`, `nominal`, `created_at`, `update_at`, `is_deleted`) VALUES
(1, 1, 6, 55000, '2019-05-14 03:26:56', '2019-06-19 14:47:35', NULL),
(2, 2, 5, 50000, '2019-06-22 10:52:20', NULL, NULL),
(3, 3, 1, 90900, '2019-06-30 06:16:26', NULL, NULL),
(4, 4, 5, 2147483647, '2019-06-30 06:16:48', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `divisi`
--

CREATE TABLE `divisi` (
  `id` int(5) NOT NULL,
  `divisi` varchar(40) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `is_deleted` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `divisi`
--

INSERT INTO `divisi` (`id`, `divisi`, `created_at`, `update_at`, `is_deleted`) VALUES
(1, 'Direktur Utama', '2019-03-27 08:29:32', NULL, NULL),
(2, 'GM Technical & Operation', '2019-03-27 08:29:42', '2019-03-27 08:33:13', NULL),
(3, 'Vendor Management Manager', '2019-03-27 08:29:52', NULL, NULL),
(4, 'Service Assurance Manager', '2019-03-27 08:30:03', NULL, NULL),
(5, 'Sales Manager', '2019-03-27 08:30:08', '2019-04-01 00:58:58', NULL),
(6, 'Finance & HR Director', '2019-03-27 08:30:19', '2019-03-27 08:33:22', NULL),
(7, 'Finance Manager', '2019-03-27 08:30:31', NULL, NULL),
(8, 'HRGA Manager', '2019-03-27 08:30:38', NULL, NULL),
(9, 'IT & Business Development Director', '2019-03-27 08:31:04', '2019-03-27 08:33:42', NULL),
(10, 'Project Director Trans Nusantara Cable', '2019-03-27 08:31:18', NULL, NULL),
(11, 'Kalbar Project Director', '2019-03-27 08:31:27', NULL, NULL),
(12, 'Sawarak Project Direktor', '2019-03-27 08:31:34', NULL, NULL),
(13, 'General Manager Commercial', '2019-03-27 08:31:43', NULL, NULL),
(14, 'Finance, HR & Admin Manager', '2019-03-27 08:31:48', '2019-03-27 08:33:53', NULL),
(15, 'Direktur Utama', '2019-03-27 08:34:16', NULL, NULL),
(16, 'General Manager Commercial', '2019-03-27 08:34:26', NULL, NULL),
(17, 'Sales Manager', '2019-03-27 08:34:33', NULL, NULL),
(18, 'Secretariat & Legal Manager', '2019-03-27 08:34:50', '2019-03-27 08:35:33', NULL),
(19, 'Product Manager', '2019-03-27 08:34:58', NULL, NULL),
(20, 'Finance, HR & Admin Manager', '2019-03-27 08:35:18', '2019-03-27 08:35:39', NULL),
(21, 'Resepsionis', '2019-03-27 09:18:39', NULL, NULL),
(22, 'Secretariat & Legal Manager', '2019-03-27 09:27:56', '2019-03-27 09:28:46', NULL),
(23, 'Sales Manager Commercial', '2019-04-01 01:02:58', NULL, NULL),
(24, 'Product Manager', '2019-04-01 01:08:24', NULL, NULL),
(25, 'Direksi', '2019-04-05 09:08:15', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `jabatan`
--

CREATE TABLE `jabatan` (
  `id` int(255) NOT NULL,
  `jabatan` varchar(40) NOT NULL,
  `kode` varchar(20) NOT NULL,
  `posisi` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `is_deleted` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `jabatan`
--

INSERT INTO `jabatan` (`id`, `jabatan`, `kode`, `posisi`, `created_at`, `update_at`, `is_deleted`) VALUES
(1, 'Direktur', 'DRU', 'Pemimpin Perusahaan', '2019-03-03 14:07:12', NULL, NULL),
(2, 'General Manager', 'GM', 'Dibawah Pemimpin Perusahaan', '2019-03-03 14:09:12', NULL, NULL),
(3, 'Staff', 'ST', 'Staff', '2019-03-06 06:35:30', NULL, NULL),
(4, 'Admin', 'ADM', '-', '2019-05-14 01:49:55', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `jurnal`
--

CREATE TABLE `jurnal` (
  `id` int(12) NOT NULL,
  `id_kaskeluar` int(6) NOT NULL,
  `nomor_referensi` varchar(15) NOT NULL,
  `tanggal` date NOT NULL,
  `keterangan` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `is_deleted` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `jurnal`
--

INSERT INTO `jurnal` (`id`, `id_kaskeluar`, `nomor_referensi`, `tanggal`, `keterangan`, `created_at`, `update_at`, `is_deleted`) VALUES
(1, 2, 'JU000001', '2019-06-22', 'Keterangan ada', '2019-06-22 11:40:46', NULL, NULL),
(2, 4, 'JU000002', '2019-07-03', 'kaeteranaganf\r\n', '2019-07-03 03:35:42', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `jurnal_detail`
--

CREATE TABLE `jurnal_detail` (
  `id` int(6) NOT NULL,
  `id_jurnal` varchar(15) NOT NULL,
  `id_akun` int(6) NOT NULL,
  `nomor_referensi` varchar(15) NOT NULL,
  `debet` int(20) NOT NULL,
  `kredit` int(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `is_deleted` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `jurnal_detail`
--

INSERT INTO `jurnal_detail` (`id`, `id_jurnal`, `id_akun`, `nomor_referensi`, `debet`, `kredit`, `created_at`, `update_at`, `is_deleted`) VALUES
(1, '1', 5, 'JU000001', 50000, 50000, '2019-06-22 11:40:46', NULL, NULL),
(2, '2', 5, 'JU000002', 2147483647, 2147483647, '2019-07-03 03:35:42', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `karyawan`
--

CREATE TABLE `karyawan` (
  `id` int(6) NOT NULL,
  `nik` varchar(12) NOT NULL,
  `nama` varchar(35) NOT NULL,
  `divisi` varchar(35) NOT NULL,
  `telepon` varchar(13) NOT NULL,
  `alamat` text NOT NULL,
  `jk` enum('1','0') NOT NULL,
  `tgl_lahir` varchar(35) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `is_deleted` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `karyawan`
--

INSERT INTO `karyawan` (`id`, `nik`, `nama`, `divisi`, `telepon`, `alamat`, `jk`, `tgl_lahir`, `created_at`, `update_at`, `is_deleted`) VALUES
(1, '06190003', 'Hafiz Ramadhan', 'Bagian Keuangan', '083819954386', 'alamad', '1', '', '2019-06-25 13:41:46', '2019-06-30 06:27:15', NULL),
(2, '06190002', 'NAN', '', '7093409234823', 'ASDASLDJ', '1', '2017-12-30', '2019-06-30 05:43:18', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kaskeluar`
--

CREATE TABLE `kaskeluar` (
  `id` int(6) NOT NULL,
  `id_karyawan` int(6) NOT NULL,
  `nomor` varchar(15) NOT NULL,
  `tanggal` varchar(20) NOT NULL,
  `memo` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `is_deleted` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kaskeluar`
--

INSERT INTO `kaskeluar` (`id`, `id_karyawan`, `nomor`, `tanggal`, `memo`, `created_at`, `update_at`, `is_deleted`) VALUES
(1, 1, 'KK000001', '19-06-2019 09:47:35', 'Biaya Transport Bapak Anwar Dept. Pengairan', '2019-05-14 03:26:56', '2019-06-19 14:47:35', NULL),
(2, 1, 'KK000002', '22-06-2019 05:52:20', 'biaya fotocopy', '2019-06-22 10:52:20', NULL, NULL),
(3, 2, 'KK000003', '30-06-2019 01:16:26', 'Memory acard sdk', '2019-06-30 06:16:26', NULL, NULL),
(4, 2, 'KK000004', '30-06-2019 01:16:48', 'asdasdasdas', '2019-06-30 06:16:48', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `log`
--

CREATE TABLE `log` (
  `id` int(6) NOT NULL,
  `nama` varchar(35) NOT NULL,
  `departement` varchar(35) NOT NULL,
  `divisi` varchar(35) DEFAULT NULL,
  `jabatan` varchar(35) NOT NULL,
  `tanggal` datetime NOT NULL,
  `kategori` varchar(35) DEFAULT NULL,
  `log` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `log`
--

INSERT INTO `log` (`id`, `nama`, `departement`, `divisi`, `jabatan`, `tanggal`, `kategori`, `log`) VALUES
(0, 'Cici', 'Trans Hybrid', '', 'Admin', '2019-06-24 21:07:40', 'login', 'Berhasil login ke dalam aplikasi dengan browser Chrome, IP Address : ::1 dan Operating System Windows 10 '),
(1, 'Hafiz Ramadhan', 'Trans Hybrid', 'GM Technical & Operation', 'General Manager', '2019-05-09 10:03:38', 'login', 'Berhasil login ke dalam aplikasi dengan browser Chrome, IP Address : ::1 dan Operating System Windows 10 '),
(2, 'Hafiz Ramadhan', 'Trans Hybrid', 'GM Technical & Operation', 'General Manager', '2019-05-12 22:10:31', 'login', 'Berhasil login ke dalam aplikasi dengan browser Chrome, IP Address : ::1 dan Operating System Windows 10 '),
(3, 'Hafiz Ramadhan', 'Trans Hybrid', 'GM Technical & Operation', 'General Manager', '2019-05-13 13:00:02', 'login', 'Berhasil login ke dalam aplikasi dengan browser Chrome, IP Address : ::1 dan Operating System Windows 10 '),
(4, 'Cici', 'Trans Hybrid', 'GM Technical & Operation', 'General Manager', '2019-05-14 08:04:39', 'login', 'Berhasil login ke dalam aplikasi dengan browser Chrome, IP Address : ::1 dan Operating System Windows 10 '),
(5, 'Cici', 'Trans Hybrid', 'GM Technical & Operation', 'General Manager', '2019-05-14 08:07:41', 'memperbarui', 'Berhasil memperbarui data karyawan dengan ID : 1'),
(6, 'Cici', 'Trans Hybrid', 'GM Technical & Operation', 'General Manager', '2019-05-14 08:09:15', 'logout', 'Berhasil keluar dari aplikasi '),
(7, 'Cici', 'Trans Hybrid', 'GM Technical & Operation', 'General Manager', '2019-05-14 08:09:39', 'login', 'Berhasil login ke dalam aplikasi dengan browser Chrome, IP Address : ::1 dan Operating System Windows 10 '),
(8, 'Cici', 'Trans Hybrid', 'GM Technical & Operation', 'General Manager', '2019-05-14 08:49:12', 'logout', 'Berhasil keluar dari aplikasi '),
(9, 'Cici', 'Trans Hybrid', 'GM Technical & Operation', 'Direktur', '2019-05-14 08:49:16', 'login', 'Berhasil login ke dalam aplikasi dengan browser Chrome, IP Address : ::1 dan Operating System Windows 10 '),
(10, 'Cici', 'Trans Hybrid', 'GM Technical & Operation', 'Direktur', '2019-05-14 08:49:55', 'menyimpan', 'Berhasil menyimpan data jabatan'),
(11, 'Cici', 'Trans Hybrid', 'GM Technical & Operation', 'Direktur', '2019-05-14 10:22:54', 'logout', 'Berhasil keluar dari aplikasi '),
(12, 'Cici', 'Trans Hybrid', 'GM Technical & Operation', 'Admin', '2019-05-14 10:25:10', 'login', 'Berhasil login ke dalam aplikasi dengan browser Chrome, IP Address : ::1 dan Operating System Windows 10 '),
(13, 'Cici', 'Trans Hybrid', 'GM Technical & Operation', 'Admin', '2019-05-14 10:26:28', 'memperbarui', 'Berhasil memperbarui data akun dengan ID : 1'),
(14, 'Cici', 'Trans Hybrid', 'GM Technical & Operation', 'Admin', '2019-05-14 10:29:07', 'menghapus', 'Berhasil menghapus data jurnal dengan ID : 2'),
(15, 'Cici', 'Trans Hybrid', 'GM Technical & Operation', 'Admin', '2019-05-15 12:10:05', 'login', 'Berhasil login ke dalam aplikasi dengan browser Chrome, IP Address : ::1 dan Operating System Windows 10 '),
(16, 'Cici', 'Trans Hybrid', 'GM Technical & Operation', 'Admin', '2019-05-21 08:01:17', 'login', 'Berhasil login ke dalam aplikasi dengan browser Chrome, IP Address : ::1 dan Operating System Windows 10 '),
(17, 'Cici', 'Trans Hybrid', 'GM Technical & Operation', 'Admin', '2019-05-28 08:52:02', 'login', 'Berhasil login ke dalam aplikasi dengan browser Chrome, IP Address : ::1 dan Operating System Windows 10 '),
(18, 'Cici', 'Trans Hybrid', 'GM Technical & Operation', 'Admin', '2019-05-28 09:02:39', 'login', 'Berhasil login ke dalam aplikasi dengan browser Chrome, IP Address : ::1 dan Operating System Windows 10 '),
(19, 'Cici', 'Trans Hybrid', 'GM Technical & Operation', 'Admin', '2019-05-29 07:54:27', 'login', 'Berhasil login ke dalam aplikasi dengan browser Chrome, IP Address : ::1 dan Operating System Windows 10 '),
(20, 'Cici', 'Trans Hybrid', 'GM Technical & Operation', 'Admin', '2019-05-29 08:52:27', 'login', 'Berhasil login ke dalam aplikasi dengan browser Chrome, IP Address : ::1 dan Operating System Windows 10 '),
(21, 'Cici', 'Trans Hybrid', 'GM Technical & Operation', 'Admin', '2019-06-17 16:00:45', 'login', 'Berhasil login ke dalam aplikasi dengan browser Chrome, IP Address : ::1 dan Operating System Windows 10 '),
(22, 'Cici', 'Trans Hybrid', 'GM Technical & Operation', 'Admin', '2019-06-19 20:16:13', 'login', 'Berhasil login ke dalam aplikasi dengan browser Chrome, IP Address : ::1 dan Operating System Windows 10 '),
(23, 'Cici', 'Trans Hybrid', 'GM Technical & Operation', 'Admin', '2019-06-19 21:43:36', 'memperbarui', 'Berhasil memperbarui data akun dengan ID : 1'),
(24, 'Cici', 'Trans Hybrid', 'GM Technical & Operation', 'Admin', '2019-06-19 21:44:03', 'menyimpan', 'Berhasil menyimpan data akun'),
(25, 'Cici', 'Trans Hybrid', 'GM Technical & Operation', 'Admin', '2019-06-19 21:44:26', 'menyimpan', 'Berhasil menyimpan data akun'),
(26, 'Cici', 'Trans Hybrid', 'GM Technical & Operation', 'Admin', '2019-06-19 21:44:49', 'menyimpan', 'Berhasil menyimpan data akun'),
(27, 'Cici', 'Trans Hybrid', 'GM Technical & Operation', 'Admin', '2019-06-19 21:45:15', 'menyimpan', 'Berhasil menyimpan data akun'),
(28, 'Cici', 'Trans Hybrid', 'GM Technical & Operation', 'Admin', '2019-06-19 21:46:17', 'menyimpan', 'Berhasil menyimpan data akun'),
(29, 'Cici', 'Trans Hybrid', 'GM Technical & Operation', 'Admin', '2019-06-19 21:47:35', 'memperbarui', 'Berhasil memperbarui data kaskeluar dengan ID : 1'),
(30, 'Cici', 'Trans Hybrid', 'GM Technical & Operation', 'Admin', '2019-06-19 21:48:13', 'menghapus', 'Berhasil menghapus data kaskeluar dengan ID : 2'),
(31, 'Cici', 'Trans Hybrid', '', 'Admin', '2019-06-22 17:26:11', 'login', 'Berhasil login ke dalam aplikasi dengan browser Chrome, IP Address : ::1 dan Operating System Windows 10 '),
(32, 'Cici', 'Trans Hybrid', NULL, 'Admin', '2019-06-24 21:09:44', 'logout', 'Berhasil keluar dari aplikasi '),
(33, 'Cici', 'Trans Hybrid', NULL, 'Admin', '2019-06-24 21:10:21', 'logout', 'Berhasil keluar dari aplikasi '),
(34, 'Cici', 'Trans Hybrid', NULL, 'Admin', '2019-06-24 21:14:25', 'login', 'Berhasil login ke dalam aplikasi dengan browser Chrome, IP Address : ::1 dan Operating System Windows 10 '),
(35, 'Cici', 'Trans Hybrid', NULL, 'Admin', '2019-06-24 21:19:15', 'login', 'Berhasil login ke dalam aplikasi dengan browser Chrome, IP Address : ::1 dan Operating System Windows 10 '),
(36, 'Cici', 'Trans Hybrid', NULL, 'Admin', '2019-06-24 21:19:19', 'login', 'Berhasil login ke dalam aplikasi dengan browser Chrome, IP Address : ::1 dan Operating System Windows 10 '),
(37, 'Cici', 'Trans Hybrid', NULL, 'Admin', '2019-06-24 21:23:11', 'login', 'Berhasil login ke dalam aplikasi dengan browser Chrome, IP Address : ::1 dan Operating System Windows 10 '),
(38, 'Cici', 'Trans Hybrid', NULL, 'Admin', '2019-06-24 21:23:43', 'login', 'Berhasil login ke dalam aplikasi dengan browser Chrome, IP Address : ::1 dan Operating System Windows 10 '),
(39, 'Cici', 'Trans Hybrid', NULL, 'Admin', '2019-06-25 06:49:22', 'login', 'Berhasil login ke dalam aplikasi dengan browser Chrome, IP Address : ::1 dan Operating System Windows 10 '),
(40, 'Cici', 'Trans Hybrid', NULL, 'Admin', '2019-06-25 20:04:14', 'login', 'Berhasil login ke dalam aplikasi dengan browser Chrome, IP Address : ::1 dan Operating System Windows 10 '),
(41, 'Cici', 'Trans Hybrid', NULL, 'Admin', '2019-06-25 20:41:46', 'menyimpan', 'Berhasil menyimpan data karyawan'),
(42, 'Cici', 'Trans Hybrid', NULL, 'Admin', '2019-06-26 09:16:54', 'login', 'Berhasil login ke dalam aplikasi dengan browser Chrome, IP Address : ::1 dan Operating System Windows 10 '),
(43, 'Cici', 'Trans Hybrid', NULL, 'Admin', '2019-06-26 11:32:23', 'login', 'Berhasil login ke dalam aplikasi dengan browser Chrome, IP Address : ::1 dan Operating System Windows 10 '),
(44, 'Cici', 'Trans Hybrid', NULL, 'Admin', '2019-06-27 08:30:36', 'login', 'Berhasil login ke dalam aplikasi dengan browser Chrome, IP Address : ::1 dan Operating System Windows 10 '),
(45, 'Cici', 'Trans Hybrid', NULL, 'Admin', '2019-06-27 08:32:10', 'login', 'Berhasil login ke dalam aplikasi dengan browser Chrome, IP Address : ::1 dan Operating System Windows 10 '),
(46, 'Cici', 'Trans Hybrid', NULL, 'Admin', '2019-06-29 16:37:03', 'login', 'Berhasil login ke dalam aplikasi dengan browser Chrome, IP Address : ::1 dan Operating System Windows 10 '),
(47, 'Cici', 'Trans Hybrid', NULL, 'Admin', '2019-06-30 11:48:35', 'login', 'Berhasil login ke dalam aplikasi dengan browser Chrome, IP Address : ::1 dan Operating System Windows 10 '),
(48, 'Cici', 'Trans Hybrid', NULL, 'Admin', '2019-06-30 11:49:18', 'logout', 'Berhasil keluar dari aplikasi '),
(49, 'Cici', 'Trans Hybrid', NULL, 'Admin', '2019-06-30 11:49:36', 'login', 'Berhasil login ke dalam aplikasi dengan browser Chrome, IP Address : ::1 dan Operating System Windows 10 '),
(50, 'Cici', 'Trans Hybrid', NULL, 'Admin', '2019-06-30 12:43:18', 'menyimpan', 'Berhasil menyimpan data karyawan'),
(51, 'Cici', 'Trans Hybrid', NULL, 'Admin', '2019-06-30 13:19:24', 'logout', 'Berhasil keluar dari aplikasi '),
(52, 'Cici', '', NULL, 'Admin', '2019-06-30 13:20:43', 'login', 'Berhasil login ke dalam aplikasi dengan browser Chrome, IP Address : ::1 dan Operating System Windows 10 '),
(53, 'Cici', '', 'Vendor Management Manager', 'Admin', '2019-06-30 13:27:39', 'memperbarui', 'Berhasil memperbarui data karyawan dengan ID : 1'),
(54, 'Cici', '', 'Vendor Management Manager', 'Admin', '2019-06-30 13:29:10', 'logout', 'Berhasil keluar dari aplikasi '),
(55, 'Cici', '', NULL, 'Admin', '2019-06-30 13:29:36', 'login', 'Berhasil login ke dalam aplikasi dengan browser Chrome, IP Address : ::1 dan Operating System Windows 10 '),
(56, 'Cici', '', 'Vendor Management Manager', 'Admin', '2019-06-30 13:31:26', 'logout', 'Berhasil keluar dari aplikasi '),
(57, 'Cici', '', NULL, 'Admin', '2019-07-01 22:27:39', 'login', 'Berhasil login ke dalam aplikasi dengan browser Chrome, IP Address : ::1 dan Operating System Windows 10 '),
(58, 'Cici', '', 'Vendor Management Manager', 'Admin', '2019-07-01 22:40:16', 'logout', 'Berhasil keluar dari aplikasi '),
(59, 'Cici', '', NULL, 'Admin', '2019-07-02 22:11:57', 'login', 'Berhasil login ke dalam aplikasi dengan browser Chrome, IP Address : ::1 dan Operating System Windows 10 '),
(60, 'Cici', '', 'Vendor Management Manager', 'Admin', '2019-07-02 22:14:29', 'mengupload', 'Berhasil mengupload data user dengan ID : 3'),
(61, 'Cici', '', 'Vendor Management Manager', 'Admin', '2019-07-02 22:23:09', 'mengupload', 'Berhasil mengupload data user dengan ID : 4'),
(62, 'Cici', '', 'Vendor Management Manager', 'Admin', '2019-07-02 22:44:27', 'mengupload', 'Berhasil mengupload data user dengan ID : 5'),
(63, 'Cici', '', NULL, 'Admin', '2019-07-03 10:21:16', 'login', 'Berhasil login ke dalam aplikasi dengan browser Chrome, IP Address : ::1 dan Operating System Windows 10 ');

-- --------------------------------------------------------

--
-- Struktur dari tabel `masukan`
--

CREATE TABLE `masukan` (
  `id` int(12) NOT NULL,
  `judul` varchar(35) NOT NULL,
  `keterangan` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_deleted` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `riwayatlogin`
--

CREATE TABLE `riwayatlogin` (
  `id` int(3) NOT NULL,
  `id_user` varchar(3) NOT NULL,
  `os` varchar(50) NOT NULL,
  `browser` text NOT NULL,
  `ip_address` varchar(17) NOT NULL,
  `version` varchar(50) NOT NULL,
  `last_login` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `riwayatlogin`
--

INSERT INTO `riwayatlogin` (`id`, `id_user`, `os`, `browser`, `ip_address`, `version`, `last_login`) VALUES
(0, '1', 'Windows 10', 'Chrome', '::1', '75.0.3770.100', '24-Jun-19 21:07:41'),
(1, '1', 'Windows 10', 'Chrome', '::1', '74.0.3729.131', '09-May-19 10:03:38'),
(2, '1', 'Windows 10', 'Chrome', '::1', '74.0.3729.131', '12-May-19 22:10:31'),
(3, '1', 'Windows 10', 'Chrome', '::1', '74.0.3729.131', '13-May-19 13:00:03'),
(4, '1', 'Windows 10', 'Chrome', '::1', '74.0.3729.131', '14-May-19 08:04:40'),
(5, '1', 'Windows 10', 'Chrome', '::1', '74.0.3729.131', '14-May-19 08:09:39'),
(6, '1', 'Windows 10', 'Chrome', '::1', '74.0.3729.131', '14-May-19 08:49:16'),
(7, '1', 'Windows 10', 'Chrome', '::1', '74.0.3729.131', '14-May-19 10:25:10'),
(8, '1', 'Windows 10', 'Chrome', '::1', '74.0.3729.131', '15-May-19 12:10:05'),
(9, '1', 'Windows 10', 'Chrome', '::1', '74.0.3729.157', '21-May-19 08:01:17'),
(10, '1', 'Windows 10', 'Chrome', '::1', '74.0.3729.169', '28-May-19 08:52:03'),
(11, '1', 'Windows 10', 'Chrome', '::1', '74.0.3729.169', '28-May-19 09:02:39'),
(12, '1', 'Windows 10', 'Chrome', '::1', '74.0.3729.169', '29-May-19 07:54:27'),
(13, '1', 'Windows 10', 'Chrome', '::1', '74.0.3729.169', '29-May-19 08:52:27'),
(14, '1', 'Windows 10', 'Chrome', '::1', '74.0.3729.169', '17-Jun-19 16:00:45'),
(15, '1', 'Windows 10', 'Chrome', '::1', '74.0.3729.169', '19-Jun-19 20:16:13'),
(16, '1', 'Windows 10', 'Chrome', '::1', '75.0.3770.100', '22-Jun-19 17:26:11'),
(17, '1', 'Windows 10', 'Chrome', '::1', '75.0.3770.100', '24-Jun-19 21:14:25'),
(18, '1', 'Windows 10', 'Chrome', '::1', '75.0.3770.100', '24-Jun-19 21:23:43'),
(19, '1', 'Windows 10', 'Chrome', '::1', '75.0.3770.100', '25-Jun-19 06:49:22'),
(20, '1', 'Windows 10', 'Chrome', '::1', '75.0.3770.100', '25-Jun-19 20:04:14'),
(21, '1', 'Windows 10', 'Chrome', '::1', '75.0.3770.100', '26-Jun-19 09:16:54'),
(22, '1', 'Windows 10', 'Chrome', '::1', '75.0.3770.100', '26-Jun-19 11:32:23'),
(23, '1', 'Windows 10', 'Chrome', '::1', '75.0.3770.100', '27-Jun-19 08:30:37'),
(24, '1', 'Windows 10', 'Chrome', '::1', '75.0.3770.100', '27-Jun-19 08:32:11'),
(25, '1', 'Windows 10', 'Chrome', '::1', '75.0.3770.100', '29-Jun-19 16:37:03'),
(26, '1', 'Windows 10', 'Chrome', '::1', '75.0.3770.100', '30-Jun-19 11:48:35'),
(27, '1', 'Windows 10', 'Chrome', '::1', '75.0.3770.100', '30-Jun-19 11:49:36'),
(28, '1', 'Windows 10', 'Chrome', '::1', '75.0.3770.100', '30-Jun-19 13:20:43'),
(29, '1', 'Windows 10', 'Chrome', '::1', '75.0.3770.100', '30-Jun-19 13:29:36'),
(30, '1', 'Windows 10', 'Chrome', '::1', '75.0.3770.100', '01-Jul-19 22:27:39'),
(31, '1', 'Windows 10', 'Chrome', '::1', '75.0.3770.100', '02-Jul-19 22:11:57'),
(32, '1', 'Windows 10', 'Chrome', '::1', '75.0.3770.100', '03-Jul-19 10:21:17');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(5) NOT NULL,
  `id_divisi` int(2) DEFAULT NULL,
  `id_jabatan` int(4) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `telepon` varchar(12) NOT NULL,
  `username` varchar(35) DEFAULT NULL,
  `katasandi` varchar(100) DEFAULT NULL,
  `file` text COMMENT 'file tanda tangan',
  `ext` varchar(6) NOT NULL,
  `size` varchar(12) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `ganti` enum('true','false') NOT NULL DEFAULT 'false',
  `status` varchar(35) NOT NULL DEFAULT 'Aktif',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `is_deleted` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `id_divisi`, `id_jabatan`, `nama`, `telepon`, `username`, `katasandi`, `file`, `ext`, `size`, `email`, `ganti`, `status`, `created_at`, `update_at`, `is_deleted`) VALUES
(1, 3, 4, 'Cici', '', 'cici', '$2y$10$84ZO61zE1vQr4ET9bPl3f.p03bT763shpsPJeoLDrLLg7TOYjIwDO', 'profile-cici.jpeg', 'jpeg', '47.39', 'Chiealgalih@gmail.com', 'false', 'Aktif', '2019-03-04 02:05:19', '2019-06-30 05:49:23', NULL),
(2, 0, 0, 'asdasda', '', 'asdasdas', '$2y$10$gxdVk1gRzSD4rGcSgD3CueiHauKPjMuiSvG3oqSz.aPmazGuhaWdy', NULL, '', '', 'asdasdasdas@gmauil.con', 'false', 'Aktif', '2019-06-27 01:43:36', NULL, NULL),
(3, 0, 0, 'Hafiz ramadhan', '', 'asdasd', '$2y$10$hI8.h6JLRlEvHZmsQvBYv.v9isTPEhJUIsxIBc161vrPRXCt21ljG', '36940694aa7dbbb7e65e6d8b9d90aa74.jpg', '.jpg', '7.4', 'asdas@gmail.com', 'false', 'Aktif', '2019-07-02 15:14:29', '2019-07-02 15:14:29', NULL),
(4, 0, 0, 'asdasd', '', 'asdasd', '$2y$10$XNK2FAvCN9SCTxvjcVHDr.TC5IIJiYsExxz9j5cScmQPVuy5i8yrW', '09f84e0c2809b9dec6875d3e5dd8dc22.png', '.png', '10.25', 'asdjasdlkasjdkas@gnqac.com', 'false', 'Aktif', '2019-07-02 15:23:09', '2019-07-02 15:23:09', NULL),
(5, 11, 2, 'ASDASD', '', 'asdasdas', '$2y$10$PknTGka2J5iTmTtGV2B25ulAxj7SGILxHswmfvQGMbFecmf2HG47m', '71f8bf3f8fbb176e3eee965d60991486.jpg', '.jpg', '7.4', 'asdasd@asdas.com', 'false', 'Aktif', '2019-07-02 15:44:27', '2019-07-02 15:44:27', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `_sessions`
--

CREATE TABLE `_sessions` (
  `id` varchar(128) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `data` longblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `_sessions`
--

INSERT INTO `_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES
('ifemm6675p27ea60ef8clpfr5vmmcmhu', '::1', 1562124057, 0x5f5f63695f6c6173745f726567656e65726174657c693a313536323132343035373b),
('rchbhhjk11iq224ehclif89l526lsdsr', '::1', 1562124948, 0x5f5f63695f6c6173745f726567656e65726174657c693a313536323132343932373b7374617475737c623a313b6c6173745f766973697465647c693a313536323132343037363b73696170617c733a343a2243696369223b656d61696c7c733a32313a2243686965616c67616c696840676d61696c2e636f6d223b74656c65706f6e7c733a303a22223b66696c657c733a31373a2270726f66696c652d636963692e6a706567223b69645f6469766973697c733a313a2233223b6469766973697c733a32353a2256656e646f72204d616e6167656d656e74204d616e61676572223b69645f6a61626174616e7c733a313a2234223b6a61626174616e7c733a353a2241646d696e223b757365725f69647c733a313a2231223b);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `detail_kaskeluar`
--
ALTER TABLE `detail_kaskeluar`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `divisi`
--
ALTER TABLE `divisi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `jurnal`
--
ALTER TABLE `jurnal`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `jurnal_detail`
--
ALTER TABLE `jurnal_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kaskeluar`
--
ALTER TABLE `kaskeluar`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `masukan`
--
ALTER TABLE `masukan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `riwayatlogin`
--
ALTER TABLE `riwayatlogin`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `_sessions`
--
ALTER TABLE `_sessions`
  ADD KEY `ci_sessions_TIMESTAMP` (`timestamp`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `akun`
--
ALTER TABLE `akun`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `detail_kaskeluar`
--
ALTER TABLE `detail_kaskeluar`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `divisi`
--
ALTER TABLE `divisi`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT untuk tabel `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `jurnal`
--
ALTER TABLE `jurnal`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `jurnal_detail`
--
ALTER TABLE `jurnal_detail`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `kaskeluar`
--
ALTER TABLE `kaskeluar`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `log`
--
ALTER TABLE `log`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT untuk tabel `masukan`
--
ALTER TABLE `masukan`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `riwayatlogin`
--
ALTER TABLE `riwayatlogin`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
