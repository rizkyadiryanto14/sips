-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 07 Sep 2024 pada 08.20
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `skripsi`
--

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `bimbingan_dosen_v`
-- (Lihat di bawah untuk tampilan aktual)
--
DROP VIEW IF EXISTS `bimbingan_dosen_v`;
CREATE TABLE `bimbingan_dosen_v` (
`nip` varchar(30)
,`nama` varchar(100)
,`nomor_telepon` varchar(30)
,`email` varchar(100)
,`level` enum('1','2')
,`nim` varchar(50)
,`nama_mahasiswa` varchar(100)
,`nama_prodi` varchar(50)
,`mahasiswa_id` bigint(20)
,`id_periode` int(11)
,`id` bigint(20)
);

-- --------------------------------------------------------

--
-- Struktur dari tabel `bobot_penilaian`
--

DROP TABLE IF EXISTS `bobot_penilaian`;
CREATE TABLE `bobot_penilaian` (
  `id` int(11) NOT NULL,
  `bobot_penilaian` varchar(255) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `bobot_penilaian`
--

INSERT INTO `bobot_penilaian` (`id`, `bobot_penilaian`, `keterangan`) VALUES
(2, '5', 'Nilai Tertinggi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `daftar_judul`
--

DROP TABLE IF EXISTS `daftar_judul`;
CREATE TABLE `daftar_judul` (
  `id` int(11) NOT NULL,
  `nim` varchar(255) NOT NULL,
  `judul_skripsi` varchar(500) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `abstrak` text NOT NULL,
  `tahun_lulus` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `daftar_judul`
--

INSERT INTO `daftar_judul` (`id`, `nim`, `judul_skripsi`, `nama`, `abstrak`, `tahun_lulus`) VALUES
(9, '1801013044', 'Aplikasi Kamus Aksara Ende', 'Mimin', 'Aplikasi kamus aksara ende merupakan sebuah aplikas yang menerjemahkan aplikasi kamus', '2020'),
(10, '1801013056', 'Impelementasi Laravel Pada Sistem Informasi Akademik Berbasis Website', 'Ahmad', 'Aplikasi Siakaad', '2019'),
(11, '1701071061', 'Sistem Infromasi Manajemen Aset Berbasis Web Di Universitas Teknologi Sumbawa', 'M.Zayyan Musoffa', 'manajemen aset', '2021');

-- --------------------------------------------------------

--
-- Struktur dari tabel `dokumen_hasil`
--

DROP TABLE IF EXISTS `dokumen_hasil`;
CREATE TABLE `dokumen_hasil` (
  `id` bigint(20) NOT NULL,
  `mahasiswa_id` bigint(20) NOT NULL,
  `kegiatan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `dosen`
--

DROP TABLE IF EXISTS `dosen`;
CREATE TABLE `dosen` (
  `id` bigint(20) NOT NULL,
  `nip` varchar(30) NOT NULL,
  `prodi_id` bigint(20) NOT NULL DEFAULT 1,
  `id_jabatan` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `nomor_telepon` varchar(30) NOT NULL,
  `email` varchar(100) NOT NULL,
  `level` enum('1','2') NOT NULL DEFAULT '2' COMMENT '1 = admin, 2 = dosen',
  `fokus` varchar(255) NOT NULL,
  `signature` varchar(100) DEFAULT NULL,
  `qr_code` varchar(255) NOT NULL,
  `no_japung` varchar(50) NOT NULL,
  `tema_riset` text NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id_periode` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `dosen`
--

INSERT INTO `dosen` (`id`, `nip`, `prodi_id`, `id_jabatan`, `nama`, `nomor_telepon`, `email`, `level`, `fokus`, `signature`, `qr_code`, `no_japung`, `tema_riset`, `password`, `created_at`, `id_periode`) VALUES
(1, '20201011', 1, 2, 'Azhari Ali, M.Kom.', '00852254168', 'dosen@gmail.com', '2', 'matematika', 'signature-eb2ffd6bd7.png', 'dosen_1.png', '12345678', 'percobaan', '$2y$10$Jv.d3LkDNHqpsEZFHgUQbeAzu9fOotiny36A3sOiSkhck2i5aUl7y', '2024-08-24 13:07:24', 0),
(2, '20201015', 1, 2, 'Sekretaris Prodi', '085333411680', 'admin@admin.com', '1', 'rekayasa perangkat lunak', '', '', '1234566789', 'docker', '$2y$10$t3axdEXJr0sCQgD18HyBTefkXHFEB2T53boZ0mId7xN8x/1sSQbaS', '2024-08-22 14:24:17', 0),
(4, '20201017', 1, 2, 'Ambarwati S. Kom', '08215674535786', 'ambarrannazwa@gmail.com', '2', 'AI', 'signature-286f232244.png', 'dosen_4.png', '12345678910', 'linux', '$2y$10$Jv.d3LkDNHqpsEZFHgUQbeAzu9fOotiny36A3sOiSkhck2i5aUl7y', '2024-08-24 13:15:04', 0),
(7, '20201018', 1, 3, 'Binaga Sinaga, M.H', '0872928234', 'binaga@gmail.com', '2', 'machine learning', '', '', '234567890', 'sistem informasi', '$2y$10$Jv.d3LkDNHqpsEZFHgUQbeAzu9fOotiny36A3sOiSkhck2i5aUl7y', '2024-08-28 09:30:40', 0),
(8, '20201019', 1, 2, 'Nina Sulistyo, M.M', '083652776522', 'nina@gmail.com', '2', 'RPL', '', '', '456789', 'tema riset 3', '$2y$10$VjUdPPFbus749zXF7ykR4OoW8zFjU1R3Ju5XhyxBgXPBfhrlZK5fK', '2024-08-26 07:17:13', 0),
(9, '20201020', 1, 2, 'Ateng, M.Ag', '083876329987', 'ateng@gmail.com', '2', '', 'signature-06bb6f55f9.png', 'dosen_9.png', '', '', '$2y$10$Jv.d3LkDNHqpsEZFHgUQbeAzu9fOotiny36A3sOiSkhck2i5aUl7y', '2024-08-24 13:08:50', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `email_sender`
--

DROP TABLE IF EXISTS `email_sender`;
CREATE TABLE `email_sender` (
  `id` int(11) NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `smtp_port` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `smtp_host` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `email_sender`
--

INSERT INTO `email_sender` (`id`, `email`, `password`, `smtp_port`, `smtp_host`) VALUES
(1, 'admin@imamdev.com', 'password', '465', 'ssl://mail.imamdev.com');

-- --------------------------------------------------------

--
-- Struktur dari tabel `fakultas`
--

DROP TABLE IF EXISTS `fakultas`;
CREATE TABLE `fakultas` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `dekan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `fakultas`
--

INSERT INTO `fakultas` (`id`, `nama`, `dekan`) VALUES
(1, 'Fakultas Hukum', 'Marcelo Vierra'),
(2, 'Fakultas Ilmu Komputer', 'Luka Modric'),
(3, 'Fakultas Agama Islam', 'Karim Benzema'),
(5, 'Fakultas Ekonomi Dan Bisnis', 'Toni Kroos'),
(6, 'Fakultas Ilmu Keguruan dan Pendidikan', 'Lucas Vasquez'),
(7, 'Fakultas Ilmu Sosial dan Ilmu Politik', 'Marco Asensio'),
(8, 'Fakultas Teknik', 'Daniel Carvajal'),
(9, 'Fakultas Pertanian', 'Casemiro');

-- --------------------------------------------------------

--
-- Struktur dari tabel `hasil_kegiatan`
--

DROP TABLE IF EXISTS `hasil_kegiatan`;
CREATE TABLE `hasil_kegiatan` (
  `id` bigint(20) NOT NULL,
  `mahasiswa_id` bigint(20) NOT NULL,
  `file` varchar(50) NOT NULL,
  `kegiatan` varchar(5000) DEFAULT NULL,
  `file_kegiatan` varchar(50) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `hasil_kegiatan_v`
-- (Lihat di bawah untuk tampilan aktual)
--
DROP VIEW IF EXISTS `hasil_kegiatan_v`;
CREATE TABLE `hasil_kegiatan_v` (
`mahasiswa_id` bigint(20)
,`id` bigint(20)
,`file` varchar(50)
,`kegiatan` varchar(5000)
,`file_kegiatan` varchar(50)
,`nim` varchar(50)
,`nama_mahasiswa` varchar(100)
,`nama_prodi` varchar(50)
,`status` varchar(50)
);

-- --------------------------------------------------------

--
-- Struktur dari tabel `hasil_penelitian`
--

DROP TABLE IF EXISTS `hasil_penelitian`;
CREATE TABLE `hasil_penelitian` (
  `id` bigint(20) NOT NULL,
  `penelitian_id` bigint(20) NOT NULL,
  `berita_acara` varchar(50) NOT NULL,
  `masukan` varchar(50) NOT NULL,
  `status` enum('1','2') NOT NULL COMMENT '1 = lulus, 2 = tidak lulus'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `hasil_seminar`
--

DROP TABLE IF EXISTS `hasil_seminar`;
CREATE TABLE `hasil_seminar` (
  `id` bigint(20) NOT NULL,
  `seminar_id` bigint(20) NOT NULL,
  `berita_acara` text NOT NULL,
  `masukan` text NOT NULL COMMENT 'komentar pdf (pembimbing, penguji, catatan)',
  `status` enum('1','2','3') NOT NULL COMMENT '1 = lanjut, 2 = lanjut (perbaikan), 3 = ditolak'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `home_template`
--

DROP TABLE IF EXISTS `home_template`;
CREATE TABLE `home_template` (
  `id` int(11) NOT NULL,
  `carousel_bg1` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `carousel_subtitle1` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `carousel_title1` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `carousel_description1` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `carousel_btn_href1` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `carousel_btn_text1` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `carousel_bg2` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `carousel_subtitle2` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `carousel_title2` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `carousel_description2` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `carousel_btn_href2` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `carousel_btn_text2` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `carousel_bg3` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `carousel_subtitle3` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `carousel_title3` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `carousel_description3` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `carousel_btn_href3` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `carousel_btn_text3` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `tentang_kami_subtitle` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tentang_kami_isi` varchar(5000) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `social_description` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link_fb` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link_twitter` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kontak_subtitle` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `page_title` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `home_template`
--

INSERT INTO `home_template` (`id`, `carousel_bg1`, `carousel_subtitle1`, `carousel_title1`, `carousel_description1`, `carousel_btn_href1`, `carousel_btn_text1`, `carousel_bg2`, `carousel_subtitle2`, `carousel_title2`, `carousel_description2`, `carousel_btn_href2`, `carousel_btn_text2`, `carousel_bg3`, `carousel_subtitle3`, `carousel_title3`, `carousel_description3`, `carousel_btn_href3`, `carousel_btn_text3`, `tentang_kami_subtitle`, `tentang_kami_isi`, `social_description`, `link_fb`, `link_twitter`, `alamat`, `phone`, `email`, `kontak_subtitle`, `page_title`) VALUES
(1, 'univ-sumba.jpg', 'Aplikasi', 'Monitoring Tugas Akhir Mahasiswa Program Studi Informatika', 'Tujuan dari sistem ini adalah sebagai media pencatat, memonitoring dan penjadwalan tugas akhir. Media pencatat yaitu untuk mencatat setiap mahasiswa yang sedang mengerjakan tugas akhir. Memonitoring dalam hal ini diperuntukan untuk dosen agar dosen pembimbing dapat mengawasi mahasiswa bimbingannya agar mengetahui dan mengawasi perkembangan mahasiswa bimbingannya', 'home/registrasi', 'Mulai', 'informatika2.jpg', 'Seminar', 'Seminar Proposal, Hasil, dan Skripsi', 'Setiap tahapan seminar, mahasiswa wajib melakukan pendaftaran melalui website ini', 'home/registrasi', 'Mulai', 'informatika.jpg', 'HK3', 'Dokumentasi Kegiatan Mahasiswa', 'Setiap Mahasiswa dapat mengupload semua kegiatan intra dan ekstra yang diikuti yang dibuktikan dengan SK atau sertifikat.', 'home/registrasi', 'Mulai', 'Aplikasi Monitoring Tugas Akhir Mahasiswa Universitas Teknologi Sumbawa', 'Tujuan dari sistem ini adalah sebagai media pencatat, memonitoring dan penjadwalan tugas akhir. Media pencatat yaitu untuk mencatat setiap mahasiswa yang sedang mengerjakan tugas akhir. Memonitoring dalam hal ini diperuntukan untuk dosen agar dosen pembimbing dapat mengawasi mahasiswa bimbingannya agar mengetahui dan mengawasi perkembangan mahasiswa bimbingannya.', '', 'uts sumbawa', 'uts sumbawa', 'uts sumbawa', '0218728291', 'uts.ac.id', '', 'Sistem Monitoring Skripsi dan Tugas Akhir');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jabatan`
--

DROP TABLE IF EXISTS `jabatan`;
CREATE TABLE `jabatan` (
  `id` int(11) NOT NULL,
  `nama_jabatan` varchar(100) NOT NULL,
  `keterangan` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `jabatan`
--

INSERT INTO `jabatan` (`id`, `nama_jabatan`, `keterangan`, `created_at`) VALUES
(2, 'Profesor', 'Peneliti ulung', '2024-08-23 11:59:30'),
(3, 'lektor kepala 400', 'sudah memiliki no japung', '2024-08-17 19:06:53');

-- --------------------------------------------------------

--
-- Struktur dari tabel `komponen_penilaian`
--

DROP TABLE IF EXISTS `komponen_penilaian`;
CREATE TABLE `komponen_penilaian` (
  `id` int(11) NOT NULL,
  `komponen_penilaian` varchar(100) NOT NULL,
  `keterangan` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `komponen_penilaian`
--

INSERT INTO `komponen_penilaian` (`id`, `komponen_penilaian`, `keterangan`, `created_at`) VALUES
(4, 'Komponen 1', 'Keterangan Komponen 1', '2024-08-26 08:17:52');

-- --------------------------------------------------------

--
-- Struktur dari tabel `konsultasi`
--

DROP TABLE IF EXISTS `konsultasi`;
CREATE TABLE `konsultasi` (
  `id` bigint(20) NOT NULL,
  `proposal_mahasiswa_id` bigint(20) NOT NULL,
  `tanggal` date NOT NULL,
  `jam` time NOT NULL,
  `isi` text NOT NULL,
  `bukti` text NOT NULL,
  `sk_tim` varchar(50) DEFAULT NULL,
  `persetujuan_pembimbing` enum('1','0') NOT NULL DEFAULT '0' COMMENT '1 = true, 0 = false',
  `persetujuan_kaprodi` enum('1','0') NOT NULL DEFAULT '0' COMMENT '1 = true, 0 = false',
  `komentar_pembimbing` text DEFAULT NULL,
  `komentar_kaprodi` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id_periode` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kuota_bimbingan`
--

DROP TABLE IF EXISTS `kuota_bimbingan`;
CREATE TABLE `kuota_bimbingan` (
  `id` int(11) NOT NULL,
  `nilai` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kuota_bimbingan`
--

INSERT INTO `kuota_bimbingan` (`id`, `nilai`) VALUES
(1, 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kuota_dospem`
--

DROP TABLE IF EXISTS `kuota_dospem`;
CREATE TABLE `kuota_dospem` (
  `id` int(11) NOT NULL,
  `nilai` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kuota_dospem`
--

INSERT INTO `kuota_dospem` (`id`, `nilai`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `mahasiswa`
--

DROP TABLE IF EXISTS `mahasiswa`;
CREATE TABLE `mahasiswa` (
  `id` bigint(20) NOT NULL,
  `nim` varchar(50) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `prodi_id` bigint(20) NOT NULL,
  `jenis_kelamin` enum('laki-laki','perempuan') NOT NULL,
  `tempat_lahir` varchar(20) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `email` varchar(100) NOT NULL,
  `alamat_orang_tua` text NOT NULL,
  `nomor_telepon_orang_tua` varchar(30) NOT NULL,
  `alamat` text NOT NULL,
  `nomor_telepon` varchar(30) NOT NULL,
  `nomor_telepon_orang_dekat` varchar(30) NOT NULL,
  `ipk` text NOT NULL,
  `foto` varchar(50) DEFAULT NULL,
  `password` text NOT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '0' COMMENT '1 = aktif, 0 = nonaktif',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id_periode` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `mahasiswa`
--

INSERT INTO `mahasiswa` (`id`, `nim`, `nama`, `prodi_id`, `jenis_kelamin`, `tempat_lahir`, `tanggal_lahir`, `email`, `alamat_orang_tua`, `nomor_telepon_orang_tua`, `alamat`, `nomor_telepon`, `nomor_telepon_orang_dekat`, `ipk`, `foto`, `password`, `status`, `created_at`, `id_periode`) VALUES
(1, '20201011', 'M. Dimas Trisandi', 1, 'laki-laki', 'Jember', '2004-02-07', 'achmad@gmail.com', 'Karanganyar Rt002 Rw008 Gumukmas', '082330538264', 'Karanganyar Rt002 Rw008 Gumukmas', '081233415715', '085214555215', '90', '20220421055550.png', '$2y$10$7Feo69p23zYjU13JL5jSt.18FhGBG8VWiyy7ffhtw/XXI.p47Dz4O', '1', '2024-08-29 17:14:54', 1),
(2, '20201012', 'Zainab', 4, 'perempuan', 'Jember', '2003-10-30', 'zainabzahra@gmail.com', 'Jl. Muria, Wunguan, Kencong', '08526536689', 'Jl. Muria, Wunguan, Kencong', '083446275638', '08123582673', '3.14', '20201012073212.png', '$2y$10$L5aa2RGrSevnjUJBTIrDLuSLgeB0r0Qb12S287NBTiD4HH4FKHdeK', '1', '2024-08-26 14:12:37', 1),
(3, '20170808', 'Alimuddin', 2, 'laki-laki', 'Palu', '1992-10-23', 'mahasiswa@gmail.com', 'Palu', '085224445667', 'Palu', '085212221445', '087665778989', '3,5', NULL, '$2y$10$KrO.CAEG483s3h8QnopO4eOkZEuzgnCkN4AH0KS/D.egvQq3AdXo.', '1', '2024-08-27 07:22:00', 1),
(4, '1500068', 'Kosim', 6, 'laki-laki', 'Sumedang', '1997-09-29', 'kozenk1997@gmail.com', 'Perum Jatihurip Blok 9', '082115258816', 'Dsn. Nyalindung RT 001 RW 007', '-', '082295398173', '3.15', '20201029111032.png', '$2y$10$L5aa2RGrSevnjUJBTIrDLuSLgeB0r0Qb12S287NBTiD4HH4FKHdeK', '1', '2024-08-26 14:12:42', 1),
(6, '21107021', 'Bohari', 2, 'laki-laki', 'MAKASSAR', '2000-01-03', 'bohari.gizi@gmail.com', 'palu', '085255777888', 'Palu', '085255778777', '085255777888', '3,5', '20201111084428.png', '$2y$10$0cKebn3deUCrntamA6ShlObhPJQmoGL5NQp9rLAtNAeySQPiXp/iG', '1', '2024-08-26 14:12:45', 1),
(7, '21180011', 'Ijanuri', 2, 'laki-laki', 'PALU', '1998-12-11', 'bohmks@gmail.com', 'Palu', '085255555555', 'Palu', '085255555555', '085255555555', '3,8', NULL, '$2y$10$De.l6iv0oALRCUNvGH5aCuhNjlDHlP7VGLh/30MII4y2Kr2CsWXNC', '1', '2024-08-26 14:12:48', 1),
(8, '987654321', 'Ucup Mancur', 5, 'laki-laki', 'banyuwangi', '2001-01-27', 'muhammadafif@qmail.id', 'banyuwangi', '083189966956', 'genteng banyuwangi', '082132620137', '-', '40', '20201111090112.png', '$2y$10$H6La4JN3/UIdhT5egAIcZ.Flp4LWvPLReXapUs9nDqfa27xiEfjzW', '1', '2024-08-26 14:12:50', 1),
(11, '10200099', 'Siti Isnaeni', 8, 'perempuan', 'Gorontalo', '2020-11-20', '123@gmail.com', 'Tasikmalaya, Jawa Barat', '08765452323', 'Tasikmalaya, Jawa Barat', '0821372164613', '0821372164613', '3.11', '20201120050406.png', '$2a$12$F4lXxs7LsFAG/VrAtQdOJ.FG83pKTCByZYZIlltM3FUoJpRLDaWY.', '1', '2024-08-26 14:12:52', 1),
(17, '10200055', 'Melody Laksani', 9, 'perempuan', 'Bandung', '2020-11-20', 'syogaadi75@gmail.com', 'Bogor, Jawa Barat', '083814305087', 'Bogor, Jawa Barat', '083814305087', '083814305087', '3.4', NULL, '$2y$10$SDV4DPEUtanNrdub2qvAmeAfF.7dBKp7h1XgN4O.DHpuQAbX2KLTC', '1', '2024-08-26 14:12:54', 1),
(18, '19010130444', 'Rizky Adi Ryanto', 2, 'laki-laki', 'Bima', '2000-08-14', 'adiryantorizky140820@gmail.com', 'Bima', '085333411680', 'Bima', '085333411680', '085333411680', '3.9', '20240821070225.png', '$2y$10$HHXSHx7KuT.icOFDWIuHtetU.XNVs7otYr4npMb3XiBYOZzCeBnua', '1', '2024-08-26 14:12:55', 1),
(19, '2001013044', 'Agung', 2, 'laki-laki', 'Bima', '2000-08-15', 'rizky14082000@gmail.com', 'Bima', '085333411680', 'Kebayan', '085333411680', '085333411680', '3.52', '20240828115913.png', '$2y$10$odd993yqQ7xS09dz6fT.bepjnDPu7w3ddKqFySAtHPUKRqoGi9Z5K', '1', '2024-08-28 09:59:59', 1),
(20, '2001013045', 'andini', 2, 'laki-laki', 'Sumbawa', '2024-03-06', 'andini@gmail.com', 'sumbawa', '085333411680', 'sumbawa', '085333411680', '085333411680', '3.52', '20240828091712.png', '$2y$10$7Feo69p23zYjU13JL5jSt.18FhGBG8VWiyy7ffhtw/XXI.p47Dz4O', '1', '2024-08-28 19:17:35', 1);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `mahasiswa_v`
-- (Lihat di bawah untuk tampilan aktual)
--
DROP VIEW IF EXISTS `mahasiswa_v`;
CREATE TABLE `mahasiswa_v` (
`nama_prodi` varchar(50)
,`id` bigint(20)
,`nim` varchar(50)
,`nama` varchar(100)
,`prodi_id` bigint(20)
,`jenis_kelamin` enum('laki-laki','perempuan')
,`tempat_lahir` varchar(20)
,`tanggal_lahir` date
,`email` varchar(100)
,`alamat_orang_tua` text
,`nomor_telepon_orang_tua` varchar(30)
,`alamat` text
,`nomor_telepon` varchar(30)
,`nomor_telepon_orang_dekat` varchar(30)
,`ipk` text
,`foto` varchar(50)
,`password` text
,`status` enum('1','0')
);

-- --------------------------------------------------------

--
-- Struktur dari tabel `penelitian`
--

DROP TABLE IF EXISTS `penelitian`;
CREATE TABLE `penelitian` (
  `id` bigint(20) NOT NULL,
  `judul_penelitian` varchar(100) DEFAULT NULL,
  `proposal_mahasiswa_id` bigint(20) NOT NULL,
  `pembimbing_id` bigint(20) NOT NULL,
  `penguji_id` bigint(20) NOT NULL,
  `bukti` text NOT NULL,
  `persetujuan_pembimbing` enum('1','2') NOT NULL COMMENT '1 = true, 2 = false',
  `persetujuan_penguji` enum('1','2') NOT NULL COMMENT '1 = true, 2 = false',
  `komentar_pembimbing` text DEFAULT NULL,
  `komentar_penguji` text DEFAULT NULL,
  `sk_tim` varchar(50) DEFAULT NULL,
  `file_seminar` varchar(50) DEFAULT NULL,
  `bukti_konsultasi` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengujian_sempro`
--

DROP TABLE IF EXISTS `pengujian_sempro`;
CREATE TABLE `pengujian_sempro` (
  `id_pengujian` int(11) NOT NULL,
  `id_sempro` decimal(10,0) NOT NULL,
  `id_dosen` decimal(10,0) NOT NULL,
  `presentasi` decimal(10,0) NOT NULL,
  `alat_bantu` decimal(10,0) NOT NULL,
  `penampilan` decimal(10,0) NOT NULL,
  `penguasaan_materi` decimal(10,0) NOT NULL,
  `kelayakan_proposal` decimal(10,0) NOT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id_periode` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengujian_skripsi`
--

DROP TABLE IF EXISTS `pengujian_skripsi`;
CREATE TABLE `pengujian_skripsi` (
  `id_pengujian_skripsi` int(11) NOT NULL,
  `id_skripsi` int(11) NOT NULL,
  `id_dosen` int(11) NOT NULL,
  `pokok_permasalahan` varchar(255) NOT NULL,
  `kerangka_pemikiran` varchar(255) NOT NULL,
  `metode_penelitian` varchar(255) NOT NULL,
  `hasil_penelitian` varchar(255) NOT NULL,
  `bahasa` varchar(255) NOT NULL,
  `manfaat_akademis_praktis` varchar(100) NOT NULL,
  `teknik_penulisan` varchar(255) NOT NULL,
  `penguasaan_materi` varchar(255) DEFAULT NULL,
  `penguasaan_metode` varchar(255) DEFAULT NULL,
  `kemampuan_argumentasi` varchar(255) DEFAULT NULL,
  `nilai_rata_rata` float NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id_periode` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `penguji_dosen_v`
-- (Lihat di bawah untuk tampilan aktual)
--
DROP VIEW IF EXISTS `penguji_dosen_v`;
CREATE TABLE `penguji_dosen_v` (
`nip` varchar(30)
,`nama` varchar(100)
,`nomor_telepon` varchar(30)
,`email` varchar(100)
,`level` enum('1','2')
,`id` bigint(20)
,`mahasiswa_id` bigint(20)
,`nim` varchar(50)
,`nama_mahasiswa` varchar(100)
,`nama_prodi` varchar(50)
,`id_periode` int(11)
);

-- --------------------------------------------------------

--
-- Struktur dari tabel `periode`
--

DROP TABLE IF EXISTS `periode`;
CREATE TABLE `periode` (
  `id` int(11) NOT NULL,
  `periode` varchar(100) NOT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `periode`
--

INSERT INTO `periode` (`id`, `periode`, `status`) VALUES
(1, '2024', '1'),
(2, '2025', '0'),
(3, '2026', '0');

-- --------------------------------------------------------

--
-- Struktur dari tabel `prodi`
--

DROP TABLE IF EXISTS `prodi`;
CREATE TABLE `prodi` (
  `id` bigint(20) NOT NULL,
  `kode` varchar(30) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `dosen_id` bigint(20) NOT NULL COMMENT 'ketua prodi (pembimbing)',
  `fakultas_id` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `prodi`
--

INSERT INTO `prodi` (`id`, `kode`, `nama`, `dosen_id`, `fakultas_id`) VALUES
(1, '20201110', 'Ilmu Hukum', 1, 1),
(2, '20201017', 'Teknik Informatika', 1, 2),
(4, '20201112', 'Akuntansi', 2, 5),
(5, '20201113', 'Pendidikan Agama Islam', 1, 3),
(6, '20201114', 'Ilmu Komunikasi', 1, 7),
(7, '20201115', 'Teknik Industri', 1, 8),
(8, '20201116', 'Pendidikan Guru SD', 9, 6),
(9, '20201118', 'Ilmu Pertanian', 1, 9);

-- --------------------------------------------------------

--
-- Struktur dari tabel `proposal_mahasiswa`
--

DROP TABLE IF EXISTS `proposal_mahasiswa`;
CREATE TABLE `proposal_mahasiswa` (
  `id` bigint(20) NOT NULL,
  `mahasiswa_id` bigint(20) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `dosen_id` bigint(20) NOT NULL COMMENT 'pembimbing',
  `dosen2_id` int(11) DEFAULT NULL COMMENT 'pembimbing 2',
  `transkip` varchar(255) NOT NULL,
  `krs` varchar(255) NOT NULL,
  `outline` varchar(255) NOT NULL,
  `lulus_metopen` varchar(50) NOT NULL,
  `lulus_mkwajib` varchar(50) NOT NULL,
  `dosen_penguji_id` int(11) DEFAULT NULL,
  `dosen_penguji_id2` int(11) DEFAULT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '0' COMMENT '1 = disetujui, 2 = tidak disetujui',
  `deadline` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id_periode` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `proposal_mahasiswa_v`
-- (Lihat di bawah untuk tampilan aktual)
--
DROP VIEW IF EXISTS `proposal_mahasiswa_v`;
CREATE TABLE `proposal_mahasiswa_v` (
`id` bigint(20)
,`mahasiswa_id` bigint(20)
,`judul` varchar(100)
,`dosen_id` bigint(20)
,`dosen2_id` int(11)
,`dosen_penguji_id` int(11)
,`dosen_penguji_id2` int(11)
,`transkip` varchar(255)
,`krs` varchar(255)
,`outline` varchar(255)
,`lulus_metopen` varchar(50)
,`lulus_mkwajib` varchar(50)
,`status` enum('1','0')
,`created_at` timestamp
,`id_periode` int(11)
,`nim` varchar(50)
,`nama_mahasiswa` varchar(100)
,`nama_prodi` varchar(50)
,`deadline` datetime
,`email` varchar(100)
);

-- --------------------------------------------------------

--
-- Struktur dari tabel `seminar`
--

DROP TABLE IF EXISTS `seminar`;
CREATE TABLE `seminar` (
  `id` bigint(20) NOT NULL,
  `proposal_mahasiswa_id` bigint(20) NOT NULL,
  `dosen_penguji_id` int(11) DEFAULT NULL,
  `dosen_penguji_id2` int(11) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `jam_mulai` time DEFAULT NULL,
  `jam_selesai` time DEFAULT NULL,
  `tempat` text DEFAULT NULL,
  `file_proposal` varchar(50) NOT NULL,
  `sk_tim` varchar(50) NOT NULL,
  `bukti_konsultasi` varchar(50) DEFAULT NULL,
  `persetujuan` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id_periode` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `seminar_view`
-- (Lihat di bawah untuk tampilan aktual)
--
DROP VIEW IF EXISTS `seminar_view`;
CREATE TABLE `seminar_view` (
`id` bigint(20)
,`proposal_mahasiswa_id` bigint(20)
,`dosen_penguji_1` int(11)
,`dosen_penguji_2` int(11)
,`tanggal` date
,`jam_mulai` time
,`jam_selesai` time
,`tempat` text
,`file_proposal` varchar(50)
,`sk_tim` varchar(50)
,`bukti_konsultasi` varchar(50)
,`persetujuan` varchar(50)
,`created_at` timestamp
,`id_periode` int(11)
,`dosen_pembimbing_1` bigint(20)
,`dosen_pembimbing_2` int(11)
,`mahasiswa_id` bigint(20)
);

-- --------------------------------------------------------

--
-- Struktur dari tabel `skripsi`
--

DROP TABLE IF EXISTS `skripsi`;
CREATE TABLE `skripsi` (
  `id` int(11) NOT NULL,
  `judul_skripsi` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dosen_id` int(11) DEFAULT NULL,
  `dosen_penguji_id` int(11) DEFAULT NULL,
  `dosen_penguji_id2` int(11) DEFAULT NULL,
  `file_skripsi` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `sk_tim` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mahasiswa_id` int(11) DEFAULT NULL,
  `jadwal_skripsi` datetime DEFAULT NULL,
  `tempat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(1) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `persetujuan` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bukti_konsultasi` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id_periode` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `skripsi_v`
-- (Lihat di bawah untuk tampilan aktual)
--
DROP VIEW IF EXISTS `skripsi_v`;
CREATE TABLE `skripsi_v` (
`nim` varchar(50)
,`nama_prodi` varchar(50)
,`nama_mahasiswa` varchar(100)
,`id` int(11)
,`judul_skripsi` varchar(100)
,`dosen_id` bigint(20)
,`dosen2_id` int(11)
,`dosen_penguji_id` int(11)
,`dosen_penguji_id2` int(11)
,`sk_tim` varchar(50)
,`mahasiswa_id` int(11)
,`nama_pembimbing` varchar(100)
,`jadwal_skripsi` datetime
,`tempat` varchar(255)
,`file_skripsi` varchar(50)
,`status` varchar(1)
,`persetujuan` varchar(50)
,`bukti_konsultasi` varchar(50)
,`created_at` timestamp
,`id_periode` int(11)
,`email` varchar(100)
);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `skripsi_vl`
-- (Lihat di bawah untuk tampilan aktual)
--
DROP VIEW IF EXISTS `skripsi_vl`;
CREATE TABLE `skripsi_vl` (
`nim` varchar(50)
,`nama_prodi` varchar(50)
,`nama_mahasiswa` varchar(100)
,`id` int(11)
,`id_skripsi` int(11)
,`judul_skripsi` varchar(100)
,`dosen_id` bigint(20)
,`dosen2_id` int(11)
,`dosen_penguji_id` int(11)
,`dosen_penguji_id2` int(11)
,`sk_tim` varchar(50)
,`mahasiswa_id` int(11)
,`nama_pembimbing1` varchar(100)
,`nama_pembimbing2` varchar(100)
,`nama_penguji1` varchar(100)
,`nama_penguji2` varchar(100)
,`jadwal_skripsi` datetime
,`tempat` varchar(255)
,`file_skripsi` varchar(50)
,`status` varchar(1)
,`persetujuan` varchar(50)
,`bukti_konsultasi` varchar(50)
,`email` varchar(100)
,`created_at` timestamp
,`id_periode` int(11)
);

-- --------------------------------------------------------

--
-- Struktur untuk view `bimbingan_dosen_v`
--
DROP TABLE IF EXISTS `bimbingan_dosen_v`;

DROP VIEW IF EXISTS `bimbingan_dosen_v`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `bimbingan_dosen_v`  AS  select `dosen`.`nip` AS `nip`,`dosen`.`nama` AS `nama`,`dosen`.`nomor_telepon` AS `nomor_telepon`,`dosen`.`email` AS `email`,`dosen`.`level` AS `level`,`proposal_mahasiswa_v`.`nim` AS `nim`,`proposal_mahasiswa_v`.`nama_mahasiswa` AS `nama_mahasiswa`,`proposal_mahasiswa_v`.`nama_prodi` AS `nama_prodi`,`proposal_mahasiswa_v`.`mahasiswa_id` AS `mahasiswa_id`,`proposal_mahasiswa_v`.`id_periode` AS `id_periode`,`dosen`.`id` AS `id` from (`dosen` join `proposal_mahasiswa_v` on(`dosen`.`id` = `proposal_mahasiswa_v`.`dosen_id`)) ;

-- --------------------------------------------------------

--
-- Struktur untuk view `hasil_kegiatan_v`
--
DROP TABLE IF EXISTS `hasil_kegiatan_v`;

DROP VIEW IF EXISTS `hasil_kegiatan_v`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `hasil_kegiatan_v`  AS  select `hasil_kegiatan`.`mahasiswa_id` AS `mahasiswa_id`,`hasil_kegiatan`.`id` AS `id`,`hasil_kegiatan`.`file` AS `file`,`hasil_kegiatan`.`kegiatan` AS `kegiatan`,`hasil_kegiatan`.`file_kegiatan` AS `file_kegiatan`,`mahasiswa_v`.`nim` AS `nim`,`mahasiswa_v`.`nama` AS `nama_mahasiswa`,`mahasiswa_v`.`nama_prodi` AS `nama_prodi`,`hasil_kegiatan`.`status` AS `status` from (`hasil_kegiatan` join `mahasiswa_v` on(`mahasiswa_v`.`id` = `hasil_kegiatan`.`mahasiswa_id`)) ;

-- --------------------------------------------------------

--
-- Struktur untuk view `mahasiswa_v`
--
DROP TABLE IF EXISTS `mahasiswa_v`;

DROP VIEW IF EXISTS `mahasiswa_v`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `mahasiswa_v`  AS  select `prodi`.`nama` AS `nama_prodi`,`mahasiswa`.`id` AS `id`,`mahasiswa`.`nim` AS `nim`,`mahasiswa`.`nama` AS `nama`,`mahasiswa`.`prodi_id` AS `prodi_id`,`mahasiswa`.`jenis_kelamin` AS `jenis_kelamin`,`mahasiswa`.`tempat_lahir` AS `tempat_lahir`,`mahasiswa`.`tanggal_lahir` AS `tanggal_lahir`,`mahasiswa`.`email` AS `email`,`mahasiswa`.`alamat_orang_tua` AS `alamat_orang_tua`,`mahasiswa`.`nomor_telepon_orang_tua` AS `nomor_telepon_orang_tua`,`mahasiswa`.`alamat` AS `alamat`,`mahasiswa`.`nomor_telepon` AS `nomor_telepon`,`mahasiswa`.`nomor_telepon_orang_dekat` AS `nomor_telepon_orang_dekat`,`mahasiswa`.`ipk` AS `ipk`,`mahasiswa`.`foto` AS `foto`,`mahasiswa`.`password` AS `password`,`mahasiswa`.`status` AS `status` from (`mahasiswa` join `prodi` on(`mahasiswa`.`prodi_id` = `prodi`.`id`)) ;

-- --------------------------------------------------------

--
-- Struktur untuk view `penguji_dosen_v`
--
DROP TABLE IF EXISTS `penguji_dosen_v`;

DROP VIEW IF EXISTS `penguji_dosen_v`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `penguji_dosen_v`  AS  select `dosen`.`nip` AS `nip`,`dosen`.`nama` AS `nama`,`dosen`.`nomor_telepon` AS `nomor_telepon`,`dosen`.`email` AS `email`,`dosen`.`level` AS `level`,`dosen`.`id` AS `id`,`proposal_mahasiswa_v`.`mahasiswa_id` AS `mahasiswa_id`,`proposal_mahasiswa_v`.`nim` AS `nim`,`proposal_mahasiswa_v`.`nama_mahasiswa` AS `nama_mahasiswa`,`proposal_mahasiswa_v`.`nama_prodi` AS `nama_prodi`,`proposal_mahasiswa_v`.`id_periode` AS `id_periode` from ((`seminar` join `proposal_mahasiswa_v` on(`seminar`.`proposal_mahasiswa_id` = `proposal_mahasiswa_v`.`id`)) join `dosen` on(`dosen`.`id` = `seminar`.`dosen_penguji_id` or `dosen`.`id` = `seminar`.`dosen_penguji_id2`)) where `seminar`.`id` is not null ;

-- --------------------------------------------------------

--
-- Struktur untuk view `proposal_mahasiswa_v`
--
DROP TABLE IF EXISTS `proposal_mahasiswa_v`;

DROP VIEW IF EXISTS `proposal_mahasiswa_v`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `proposal_mahasiswa_v`  AS  select `proposal_mahasiswa`.`id` AS `id`,`proposal_mahasiswa`.`mahasiswa_id` AS `mahasiswa_id`,`proposal_mahasiswa`.`judul` AS `judul`,`proposal_mahasiswa`.`dosen_id` AS `dosen_id`,`proposal_mahasiswa`.`dosen2_id` AS `dosen2_id`,`proposal_mahasiswa`.`dosen_penguji_id` AS `dosen_penguji_id`,`proposal_mahasiswa`.`dosen_penguji_id2` AS `dosen_penguji_id2`,`proposal_mahasiswa`.`transkip` AS `transkip`,`proposal_mahasiswa`.`krs` AS `krs`,`proposal_mahasiswa`.`outline` AS `outline`,`proposal_mahasiswa`.`lulus_metopen` AS `lulus_metopen`,`proposal_mahasiswa`.`lulus_mkwajib` AS `lulus_mkwajib`,`proposal_mahasiswa`.`status` AS `status`,`proposal_mahasiswa`.`created_at` AS `created_at`,`proposal_mahasiswa`.`id_periode` AS `id_periode`,`mahasiswa_v`.`nim` AS `nim`,`mahasiswa_v`.`nama` AS `nama_mahasiswa`,`mahasiswa_v`.`nama_prodi` AS `nama_prodi`,`proposal_mahasiswa`.`deadline` AS `deadline`,`mahasiswa_v`.`email` AS `email` from (`proposal_mahasiswa` join `mahasiswa_v` on(`proposal_mahasiswa`.`mahasiswa_id` = `mahasiswa_v`.`id`)) ;

-- --------------------------------------------------------

--
-- Struktur untuk view `seminar_view`
--
DROP TABLE IF EXISTS `seminar_view`;

DROP VIEW IF EXISTS `seminar_view`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `seminar_view`  AS  select `seminar`.`id` AS `id`,`seminar`.`proposal_mahasiswa_id` AS `proposal_mahasiswa_id`,`seminar`.`dosen_penguji_id` AS `dosen_penguji_1`,`seminar`.`dosen_penguji_id2` AS `dosen_penguji_2`,`seminar`.`tanggal` AS `tanggal`,`seminar`.`jam_mulai` AS `jam_mulai`,`seminar`.`jam_selesai` AS `jam_selesai`,`seminar`.`tempat` AS `tempat`,`seminar`.`file_proposal` AS `file_proposal`,`seminar`.`sk_tim` AS `sk_tim`,`seminar`.`bukti_konsultasi` AS `bukti_konsultasi`,`seminar`.`persetujuan` AS `persetujuan`,`seminar`.`created_at` AS `created_at`,`seminar`.`id_periode` AS `id_periode`,`proposal_mahasiswa`.`dosen_id` AS `dosen_pembimbing_1`,`proposal_mahasiswa`.`dosen2_id` AS `dosen_pembimbing_2`,`proposal_mahasiswa`.`mahasiswa_id` AS `mahasiswa_id` from (`seminar` join `proposal_mahasiswa` on(`seminar`.`proposal_mahasiswa_id` = `proposal_mahasiswa`.`id`)) ;

-- --------------------------------------------------------

--
-- Struktur untuk view `skripsi_v`
--
DROP TABLE IF EXISTS `skripsi_v`;

DROP VIEW IF EXISTS `skripsi_v`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `skripsi_v`  AS  select `mahasiswa_v`.`nim` AS `nim`,`mahasiswa_v`.`nama_prodi` AS `nama_prodi`,`mahasiswa_v`.`nama` AS `nama_mahasiswa`,`id` AS `id`,`judul_skripsi` AS `judul_skripsi`,`seminar_view`.`dosen_pembimbing_1` AS `dosen_id`,`seminar_view`.`dosen_pembimbing_2` AS `dosen2_id`,`seminar_view`.`dosen_penguji_1` AS `dosen_penguji_id`,`seminar_view`.`dosen_penguji_2` AS `dosen_penguji_id2`,`sk_tim` AS `sk_tim`,`mahasiswa_id` AS `mahasiswa_id`,`dosen`.`nama` AS `nama_pembimbing`,`jadwal_skripsi` AS `jadwal_skripsi`,`tempat` AS `tempat`,`file_skripsi` AS `file_skripsi`,`status` AS `status`,`persetujuan` AS `persetujuan`,`bukti_konsultasi` AS `bukti_konsultasi`,`created_at` AS `created_at`,`id_periode` AS `id_periode`,`mahasiswa_v`.`email` AS `email` from ((((`skripsi` join `mahasiswa_v` on(`mahasiswa_id` = `mahasiswa_v`.`id`)) join `proposal_mahasiswa` on(`mahasiswa_id` = `proposal_mahasiswa`.`mahasiswa_id`)) join `seminar_view` on(`proposal_mahasiswa`.`id` = `seminar_view`.`proposal_mahasiswa_id`)) join `dosen` on(`seminar_view`.`dosen_pembimbing_1` = `dosen`.`id`)) ;

-- --------------------------------------------------------

--
-- Struktur untuk view `skripsi_vl`
--
DROP TABLE IF EXISTS `skripsi_vl`;

DROP VIEW IF EXISTS `skripsi_vl`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `skripsi_vl`  AS  select `skripsi_v`.`nim` AS `nim`,`skripsi_v`.`nama_prodi` AS `nama_prodi`,`skripsi_v`.`nama_mahasiswa` AS `nama_mahasiswa`,`skripsi_v`.`id` AS `id`,`id` AS `id_skripsi`,`skripsi_v`.`judul_skripsi` AS `judul_skripsi`,`skripsi_v`.`dosen_id` AS `dosen_id`,`skripsi_v`.`dosen2_id` AS `dosen2_id`,`skripsi_v`.`dosen_penguji_id` AS `dosen_penguji_id`,`skripsi_v`.`dosen_penguji_id2` AS `dosen_penguji_id2`,`skripsi_v`.`sk_tim` AS `sk_tim`,`skripsi_v`.`mahasiswa_id` AS `mahasiswa_id`,`pembimbing1`.`nama` AS `nama_pembimbing1`,`pembimbing2`.`nama` AS `nama_pembimbing2`,`penguji1`.`nama` AS `nama_penguji1`,`penguji2`.`nama` AS `nama_penguji2`,`skripsi_v`.`jadwal_skripsi` AS `jadwal_skripsi`,`skripsi_v`.`tempat` AS `tempat`,`skripsi_v`.`file_skripsi` AS `file_skripsi`,`skripsi_v`.`status` AS `status`,`skripsi_v`.`persetujuan` AS `persetujuan`,`skripsi_v`.`bukti_konsultasi` AS `bukti_konsultasi`,`skripsi_v`.`email` AS `email`,`skripsi_v`.`created_at` AS `created_at`,`skripsi_v`.`id_periode` AS `id_periode` from (((((`skripsi_v` left join `skripsi` on(`skripsi_v`.`mahasiswa_id` = `mahasiswa_id`)) left join `dosen` `pembimbing1` on(`skripsi_v`.`dosen_id` = `pembimbing1`.`id`)) left join `dosen` `pembimbing2` on(`skripsi_v`.`dosen2_id` = `pembimbing2`.`id`)) left join `dosen` `penguji1` on(`skripsi_v`.`dosen_penguji_id` = `penguji1`.`id`)) left join `dosen` `penguji2` on(`skripsi_v`.`dosen_penguji_id2` = `penguji2`.`id`)) ;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `bobot_penilaian`
--
ALTER TABLE `bobot_penilaian`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `daftar_judul`
--
ALTER TABLE `daftar_judul`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `dokumen_hasil`
--
ALTER TABLE `dokumen_hasil`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `dosen`
--
ALTER TABLE `dosen`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `email_sender`
--
ALTER TABLE `email_sender`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `fakultas`
--
ALTER TABLE `fakultas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `hasil_kegiatan`
--
ALTER TABLE `hasil_kegiatan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `hasil_penelitian`
--
ALTER TABLE `hasil_penelitian`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `hasil_seminar`
--
ALTER TABLE `hasil_seminar`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `home_template`
--
ALTER TABLE `home_template`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `komponen_penilaian`
--
ALTER TABLE `komponen_penilaian`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `konsultasi`
--
ALTER TABLE `konsultasi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kuota_bimbingan`
--
ALTER TABLE `kuota_bimbingan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kuota_dospem`
--
ALTER TABLE `kuota_dospem`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `penelitian`
--
ALTER TABLE `penelitian`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pengujian_sempro`
--
ALTER TABLE `pengujian_sempro`
  ADD PRIMARY KEY (`id_pengujian`);

--
-- Indeks untuk tabel `pengujian_skripsi`
--
ALTER TABLE `pengujian_skripsi`
  ADD PRIMARY KEY (`id_pengujian_skripsi`);

--
-- Indeks untuk tabel `periode`
--
ALTER TABLE `periode`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `prodi`
--
ALTER TABLE `prodi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `proposal_mahasiswa`
--
ALTER TABLE `proposal_mahasiswa`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `seminar`
--
ALTER TABLE `seminar`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `skripsi`
--
ALTER TABLE `skripsi`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `bobot_penilaian`
--
ALTER TABLE `bobot_penilaian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `daftar_judul`
--
ALTER TABLE `daftar_judul`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `dokumen_hasil`
--
ALTER TABLE `dokumen_hasil`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `dosen`
--
ALTER TABLE `dosen`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `email_sender`
--
ALTER TABLE `email_sender`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `fakultas`
--
ALTER TABLE `fakultas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `hasil_kegiatan`
--
ALTER TABLE `hasil_kegiatan`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `hasil_penelitian`
--
ALTER TABLE `hasil_penelitian`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `hasil_seminar`
--
ALTER TABLE `hasil_seminar`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `home_template`
--
ALTER TABLE `home_template`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `komponen_penilaian`
--
ALTER TABLE `komponen_penilaian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `konsultasi`
--
ALTER TABLE `konsultasi`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kuota_bimbingan`
--
ALTER TABLE `kuota_bimbingan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `kuota_dospem`
--
ALTER TABLE `kuota_dospem`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `penelitian`
--
ALTER TABLE `penelitian`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pengujian_sempro`
--
ALTER TABLE `pengujian_sempro`
  MODIFY `id_pengujian` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pengujian_skripsi`
--
ALTER TABLE `pengujian_skripsi`
  MODIFY `id_pengujian_skripsi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `periode`
--
ALTER TABLE `periode`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `prodi`
--
ALTER TABLE `prodi`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `proposal_mahasiswa`
--
ALTER TABLE `proposal_mahasiswa`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `seminar`
--
ALTER TABLE `seminar`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `skripsi`
--
ALTER TABLE `skripsi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
