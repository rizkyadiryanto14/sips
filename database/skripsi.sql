-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 14 Sep 2024 pada 11.08
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
(11, '1701071061', 'Sistem Infromasi Manajemen Aset Berbasis Web Di Universitas Teknologi Sumbawa', 'M.Zayyan Musoffa', 'manajemen aset', '2021'),
(23, '1901013044', 'Implementasi Docker', 'Rizky Adi Ryanto', 'ini adalah halaman abstrak', '2024'),
(24, '-', 'Membangun Sistem Informasi Pengelolahan Data Nasabah Berbasis Web di Bank Sampah Samawa', 'Erwin Mardinata', '-', '-'),
(25, '-', 'Rancang Bangun Aplikasi Kamus Bahasa Sumbawa Berbasis Android', 'Nora Dery Sofya', '-', '-'),
(26, '-', 'Sistem Informasi Kepegawaian Berbasis Web di Puskesmas Kerato', 'Haerun Nisa', '-', '-'),
(27, '-', 'Sistem Informasi Rekam Merk Mengguanakan Metode Prototype Berbasis Desktop Pada Bidan Praktek Mandiri Senyum Kencana', 'Nurlaily', '-', '-'),
(28, '-', 'Sistem Informasi Perpustakaan Berbasis Web dengan Metode Watefall di Universitas Teknologi Sumbawa', 'Fitri Lentari', '-', '-'),
(29, '-', 'Membangun Sistem Informasi Permintaan Kantong Darah UTD PMI Sumbawa Berbasis WEB', 'Reza Handika Supriatna', '-', '-'),
(30, '-', 'Sistem Informasi Pengelolaan Sarana Dan Aset di Universitas teknologi Sumbawa', 'Eva Juliani', '-', '-'),
(31, '-', 'Pembuatan Aplikasi Menu Kafe (M-Cafe) Berbasis Android', 'Fadhlan Ruchiatna', '-', '-'),
(32, '-', 'Rancang Bangun Aplikasi Pendataan pendudukan di Kantor Desa Sebasang Kecamatan Moyo Hulu Berbasis Web', 'Fhandy Rahmadi', '-', '-'),
(33, '-', 'Studi Informasi Nilai Berbasis WEB Pada SMK Mercury Sumbawa', 'Ogi Saktia', '-', '-'),
(34, '-', 'Rancang Bangun Aplikasi Pengelolaan Pemesanan Tiket Pada PO. Pancasari Tour dan Travel Berbasis WEB', 'NUR YANUAR ANSARI', '-', '-'),
(35, '-', 'Peta Infrastruktur Jalan pada Dinas Pekerjaan Umum Kabupaten Sumbawa Berbasis Multimedia', 'Yogi Suryanto', '-', '-'),
(36, '-', 'Sistem Inventory Data Barang Apotek An-Nafi', 'Rita Awaliah', '-', '-'),
(37, '-', 'Membangun Aplikasi Hybrid Jual Beli Kuliner Di Daerah Perkotaan Sumbawa Besar Menggunakan Codeigniter dan Phonegap', 'Nanang Yuliansyah', '-', '-'),
(38, '-', 'Rancang Bangun Aplikasi Kumpulan Lagu Daerah Sumbawa Berbasis Android', 'FAHLIYAH DIANI', '-', '-'),
(39, '-', 'Rancang Bangun Aplikasi Elektronik Commerce \"Kre Alang\" Pada UKM Kemang Setange Sumbawa', 'Febri Caputra Kandidat', '-', '-'),
(40, '-', 'Rancang Bangun Aplikasi Mengenal Satera Jontal Berbasis Android', 'Fitrah Arisandi', '-', '-'),
(41, '-', 'Sistem Informasi Pelayanan Online Dinas Kependudukan dan Pencatatan Sipil Kab. Sumbawa Barat', 'NIZAR HAFIZULLAH', '-', '-'),
(42, '-', 'Aplikasi Penjualan Berbasis Web (E-Commerce) Oleh-Oleh Khas Sumbawa Menggunakan Metode Waterfall Pada CV. Azizah Jaya', 'Syamsi Hidayat', '-', '-'),
(43, '-', 'Rancang Bangun Aplikasi Coffee Shop Di Wilayah Kota Sumbawa Berbasis Hybrid', 'Abdul Rahman', '-', '-'),
(44, '-', 'Rancang Bangun Sistem Informasi Perizinan Pengeluaran Ternak (SIJINAK) DISNAKESWAN Kabupaten Sumbawa Berbasis Web', 'Aji Kandidat', '-', '-'),
(45, '-', 'Sistem Informasi Pencatatan Dan Laporan Pada Bidan Praktek Swasta (BPS) \"Fitri Alatif\" Berbasis Desktop', 'Akbar', '-', '-'),
(46, '-', 'SISTEM INFORMASI PENDATAAN PASIEN PADA PUSKESMAS LANTUNG BERBASIS DEKSTOP', 'AIDIN PATARSA', '-', '-'),
(47, '-', 'Rancang Bangun Aplikasi Pengelolaan Data Reservasi Kamar Pada Hotel Sernu Raya Sumbawa Besar', 'MOHAMMAD DYMAS TAUCHID ANWAR', '-', '-'),
(48, '-', 'Sistem Informai Inventory Dan Penjualan Alat Olahraga Pada UD. Victoria Sport Berbasis Dekstop', 'IWANSYAH', '-', '-'),
(49, '-', 'Rancang Bangun Aplikasi Administrasi Stok Gudang Jagung Berbasis Dekstop Studi Kasus CV. Restu Sejati', 'Derri Achyar Sifatullah', '-', '-'),
(50, '-', 'Aplikasi Donor Darah Berbasis Android Di PMI Kab. Sumbawa', 'Satria Junanda', '-', '-'),
(51, '-', 'Sistem Informasi Penjualan Beras PT. Fajar Bukit Olat Ojong Sumbawa Berbasis Dekstop', 'Yayu Aida Wangi', '-', '-'),
(52, '-', 'Sistem Informasi Data Penduduk Pada Desa Luk Kecamatan Rhee Berbasis Dekstop', 'FERY HENDRAWAN', '-', '-'),
(53, '-', 'Rancang Bangun Sistem Informasi Geografis UTS Berbasis Android', 'Wahyuni Rizkianti', '-', '-'),
(54, '-', 'Pengembangan Sistem Informasi Puskesmas Pada UPT. Puskesmas Rhee', 'Hikmawati Intan', '-', '-'),
(55, '-', 'Rancang Bangun Aplikasi Pengenalan Alat Musik Tradisional Sumbawa Berbasis Android', 'harri gunawan', '-', '-'),
(56, '-', 'Rancang Bangun Sistem Informasi Pembayaran Sumbangan Pembinaan Pendidikan (SPP) Pada SMAK ST. Gregorius Sumbawa Menggunakan Metode Waterfall', 'Ertina Melfiani', '-', '-'),
(57, '-', 'Rancang Bangun Aplikasi Pemesanan Makanan Berbasis Android Pada Rumah Makan Bengawan Tepi Sawah', 'FAJAR ARYO NUGROHO', '-', '-'),
(58, '-', 'Rancang Bangun Sistem Informasi Jadwal Penggunaan Laboratorium Komputer Pada Universitas Teknologi Sumbawa', 'Mustaram', '-', '-'),
(59, '-', 'Sistem Informasi Pelayanan Pasien Pada Praktek Dokter Yogi Triatmakusuma Berbasis Web', 'DEBBY ANGGRAINI', '-', '-'),
(60, '-', 'Rancang Bangun Aplikasi Sastra Lisan (LAWAS) Khas Sumbawa Berbasis Android', 'Haryati', '-', '-'),
(61, '-', 'Sistem Informasi Peminjaman Dan Pengembalian Buku Pada Taman Baca Dila Samawa Berbasis Dekstop', 'INTAN RIZQI NURMANINGDYAH', '-', '-'),
(62, '-', 'Sistem Informasi Inventaris Alat Tulis Kantor Dan Suvenir Pada Kantor Pelayanan Pajak Pratama Sumbawa Besar Berbasis Dekstop', 'Agus Satriansyah', '-', '-'),
(63, '-', 'Rancang Bangun Aplikasi Berita Samawa Rea Berbasis Android', 'Ibnati Mar Atushalihah', '-', '-'),
(64, '-', 'Sistem Informasi Persedian Pupuk Pada PT. Bangun Alam Samawa Di Kecamatan Lopok Berbasis Android', 'NURUL WAHYUNINGSIH', '-', '-'),
(65, '-', 'Pengembangan Sistem Informasi Perpustakaan Pada Universitas Teknologi Sumbawa Berbasis Android', 'Rita Setyaningrum', '-', '-'),
(66, '-', 'Aplikasi Peminjaman Bumdes Desa Poto Kecamatan Moyo Hilir Berbasis Web', 'USWATUN HASANAH', '-', '-'),
(67, '-', 'Perancangan Aplikasi Pengenalan Dan Penjualan Batik Sasambo Nusa Tenggara Barat (NTB) Berbasis Android', 'ROSSA AGUSTIN', '-', '-'),
(68, '-', 'Pengembangan Sistem Informasi Penjualan Alat Di PT. Bunga Raya Lestari Berbasis Dekstop', 'Ardyansyah', '-', '-'),
(69, '-', 'Rancang Bangun Aplikasi Kamus Bahasa Mbojo Berbasis Android', 'Furdi Adrisah', '-', '-'),
(70, '-', 'Pembangunan Data Center Menggunakan Sistem Operasi Network Attached Storage (NAS) Dan Microprosessor', 'DEKKY SAPUTRA', '-', '-'),
(71, '-', 'Rancang Bangun Keamanan Jaringan Menggunakan Metode Port Knocking Pada Puskesmas Umum Kecamatan Empang', 'Gesi Kusuma wijaya', '-', '-'),
(72, '-', 'Sistem Informasi Inventory Barang Pada PT. Fajar Bukit Olat Ojong Sumbawa Berbasis Dekstop', 'Fitri Mulyani', '-', '-'),
(73, '-', 'Membangun Aplikasi Ensiklopedia Berbasis Android Di Kecamatan Plampang', 'Ari Apriansyah', '-', '-'),
(74, '-', 'Sistem Informasi Inventory Barang Pada Dinas Pekerjaan Umum Dan Penataan Ruang Kabupaten Sumbawa Berbasis Dekstop', 'Siti Nurbaya', '-', '-'),
(75, '-', 'Rancang Bangun Pengembangan Aplikasi Pendaftaran Mahasiswa Baru Universitas Teknologi Sumbawa Berbasis Web', 'IKA SRIWAHYUNI', '-', '-'),
(76, '-', 'Perancangan Aplikasi Pencarian Rumah Sewa Di Kabupaten Sumbawa Berbasis Android', 'Eny Suryani', '-', '-'),
(77, '-', 'Perancangan Aplikasi Pengarsipan Data Surat Pada Kantor Urusan Agama (KUA) Kecamatan Lape Berbasis Dekstop', 'Darmawan', '-', '-'),
(78, '-', 'Rancang Bangun Aplikasi Pembelajaran Kesenian Daerah Sumbawa (SENDAWA) Berbasis Ionic Framework', 'M. FAKHRI SURADI', '-', '-'),
(79, '-', 'Sistem Informasi Inventory Penjualan Dan Pelayanan Jasa Service Pada Central Komputer', 'Alimul Hakim', '-', '-'),
(80, '-', 'Rancang Bangun Sistem Pemesanan Catering Dan Dekorasi Di Sumbawa Besar Berbasis Android', 'Arni Safitri', '-', '-'),
(81, '-', 'Sistem Informasi Penjualan Dan Pembelian Sembako Pada UD. Kerta Mandala Sumbawa Berbasis Dekstop', 'Wayan Satru', '-', '-'),
(82, '-', 'Sistem Informasi Pendataan Alumni Berbasis Web Pada SMA 1 Moyo Utara Dengan Menggunakan Code Igniter', 'Dayu Ade Karsa Putra', '-', '-'),
(83, '-', 'Sistem Informasi Penjualan Ayam Potong Wilayah Sumbawa Berbasis Web', 'Fatar Rizal Hidayat', '-', '-'),
(84, '-', 'Membangun Sistem Informasi Pariwisata Di Desa Poto Kecamatan Moyo Hilir Berbasis Web', 'A. FARID MUJUTAHIR', '-', '-'),
(85, '-', 'Membuat Sistem Informasi Pendaftaran Siswa Baru Berbasis Web Dengan Menggunakan Framework Code Igniter Pada SMP Negeri 2 Alas Barat', 'MUHAMMAD AKBAR', '-', '-'),
(86, '-', 'Sistem Informasi Karyawan Departemen House Keeping Pada Amanwana Resort', 'MUHAMMAD ADET KARSA PRATAMA', '-', '-'),
(87, '-', 'Perancanan Aplikasi Pengarsipan Data Raport Kerja Harian (RKH) Pada Sekolah Taman Kanak-Kanak RA. Bustannul Jannah Berbasis Dekstop', 'ZAHRUN MUSYPI', '-', '-'),
(88, '-', 'Perancangan Sistem Informasi Arsip Surat Menyurat Di kantor Desa Batu Bulan Berbasis Dekstop', 'Putra Sukriwansyah', '-', '-'),
(89, '-', 'Membangun Aplikasi Jango (Kunjungan) Desa Berbasis Web (Studi Kasus Desa Mama Kabupaten Sumbawa)', 'KIKI RIZKI', '-', '-'),
(90, '-', 'Rancang Bangun Aplikasi Monitoring dan Evaluasi Penyaluran Dana Sosial di Dinas Sosial Kabupaten Sumbawa Berbasis Web', 'TEGUH HAMDALA', '-', '-'),
(91, '-', 'Rancang Bangun Sistem Pelayanan Administrasi Surat Berbasis Web di Kantor Desa Leseng', 'ARDIMANSYAH', '-', '-'),
(92, '-', 'Aplikasi Pengelolaan Inventaris Barang di SMK Negeri 1 Plampang Berbasis Web', 'FERY RAMDANI', '-', '-'),
(93, '-', 'Sistem informasi pengolahan data akademik pada SDN dan SMPN SATU ATAP (SATAP) Moyo Hulu', 'APRIANA WULANDARI', '-', '-'),
(94, '-', 'Sistem monitoring proses kegiatan belajar mengajar (E-Monev) Berbasis web Studi kasus Universitas Teknologi Sumbawa', 'SAHMAD', '-', '-'),
(95, '-', 'Rancang Bangun Aplikasi Pemandu Wisata Museum Dengan Memanfaatkan QR Code Berbasis Android', 'MUHAMMAD HABIBULLAH', '-', '-'),
(96, '-', 'Analisis dan perancangan jaringan komputer untuk implementasi sistem informasi pada windows server 2016 menggunakan internet dan intranet di universitas teknologi sumbawa', 'AHMAD JULIANSYAH', '-', '-'),
(97, '-', 'Rancang Bangun Aplikasi Media Promosi Hidup Sehat Berbasis Android (Studi Kasus di Dinas Kesehatan Kabupaten Sumbawa)', 'FAHMI YULIONO', '-', '-'),
(98, '-', 'Rancang Bangun Aplikasi Informasi dan Pendaftaran Online Barapan Kebo di Kabupaten Sumbawa Berbasis Web', 'IQRO MULHIDAYAT', '-', '-'),
(99, '-', 'Rancang Bangun Sistem Informasi Keuangan Mahasiswa di Institut Ilmu Sosial dan Budaya (IISBUD) Samawa Rea Berbasis Web', 'HANIFAH FARRAS RASYIDAH', '-', '-'),
(100, '-', 'Rancang bangun pengolahan data pada Desa Batu tering sebagai media promosi dan informasi wisata', 'FIRMANSYAH PUTRA', '-', '-'),
(101, '-', 'Rancang Bangun Aplikasi Monitoring Unit Kegiatan Mahasiswa (UKM) Universitas Teknologi Sumbawa berbasis WEB.', 'SRI LIS APRILIANI', '-', '-'),
(102, '-', 'Rancang Bangun Aplikasi Manajemen Dokumen Di Direktorat Penjaminan Mutu (DPM) Universitas Teknologi Sumbawa', 'AYASH ABDUS SYAHID', '-', '-'),
(103, '-', 'Pengembangan sistem informasi sarana dan prasarana di Universitas Teknologi Sumbawa berbasis web', 'IRWAN SAKTI PRATAMA', '-', '-'),
(104, '-', 'Pengembangan Sistem informasi manajemen administrasi izin (SIMAMI) di universitas teknologi sumbawa', 'SIRAJUNNASIHIN', '-', '-'),
(105, '-', 'Pengembangan Sistem Informasi Pendataan Korban Bencana Di Kabupaten Sumbawa Berbasis Web', 'ALI MULIANSYAH', '-', '-'),
(106, '-', 'Sistem informasi Pendaftaran Seminar di Universitas Teknologi Sumbawa Berbasis Web', 'AMRIN ARYONO', '-', '-'),
(107, '-', 'RANCANG BANGUN APLIKASI PENGELOLAAN ABSENSI BERBASIS ANDROID PADA UNIT KEGIATAN MAHASISWA PROTOKOLER UNIVERSITAS TEKNOLOGI SUMBAWA', 'ROBBY JOVINGKI SAPUTRA', '-', '-'),
(108, '-', 'Rancang Bangun Aplikasi Monitoring Hasil Pelatihan Tenaga Kerja Di Dinas Tenaga Kerja dan Transmigrasi (DISNAKERTRANS) Kabupaten Sumbawa Berbasis Android', 'HENNI KUSPITARI', '-', '-'),
(109, '-', 'Rancang Bangun Aplikasi Buku Panduan Akademik Digital Di Universitas Teknologi Sumbawa (UTS) Berbasis Android', 'FICKY FAHRUDDIN', '-', '-'),
(110, '-', 'Rancang Bangun Aplikasi Pendataan Subjek Objek Pajak di Bapenda Kabupaten Sumbawa Berbasis Web', 'AGUS TEGUH WAHYUDI', '-', '-'),
(111, '-', 'Aplikasi Pelayanan Administrasi Penduduk di Desa Karang Dima Berbasis WEB', 'INDRA JAYA PUTRA', '-', '-'),
(112, '-', 'Rancang Bangun Sistem Informasi Pengelolaan Data Alumni Pada SMA Negeri 3 Sumbawa Besar.', 'FAHMI', '-', '-'),
(113, '-', 'PENGEMBANGAN APLIKASI KAMUS BAHASA SUMBAWA BERBASIS MULTIPLATFORM', 'A. RAHMAN', '-', '-'),
(114, '-', 'Sistem Informasi Penjualan Pada Toko Jilbab RJS Kabupaten Sumbawa Berbasis Web', 'SUSI ISNAENI', '-', '-'),
(115, '-', 'SISTEM INFORMASI ADMINISTRASI AKADEMIK PADA BIMBINGAN BELAJAR BERBASIS WEB (STUDI KASUS DILA SAMAWA)', 'EVA SAPITRI ANDANI', '-', '-'),
(116, '-', 'Rancang Bangun Aplikasi Pengolahan Data Sampah Pada Dinas Lingkungan Hidup Kabupaten Sumbawa Berbasis Web', 'ATHIFAH MUTHI\'AH', '-', '-'),
(117, '-', 'RANCANG BANGUN APLIKASI KLASIFIKASI PLAGIARISME DENGAN MEMANFAATKAN MACHINE LEARNING BERBASIS ANDROID', 'MAZMUR TRIPUTRA', '-', '-'),
(118, '-', 'Rancang Bangun E-commerce Pada Galeri UMKM Kabupaten Sumbawa Berbasis Web', 'MADE AGUS SUARTIKA', '-', '-'),
(119, '-', 'Sistem Informasi Alumni Program Studi Informatika Universitas teknologi Sumbawa Berbasis Web', 'MUHAMMAD ABDUH ROBBANI', '-', '-'),
(120, '-', 'Rancang Bangun Sistem Informasi Pendaftaran Skripsi Berbasis Web Pada Program Studi Informatika', 'RIZAL JIHADUDDIN', '-', '-'),
(121, '-', 'Aplikasi Jual Beli Minyak Sumbawa Berbasis Android (Studi Kasus UMKM Kabupaten Sumbawa)', 'ELY WASIATI', '-', '-'),
(122, '-', 'Sistem Informasi Inventory data barang pada UD. Mutiara Meubel berbasis Web', 'GUSLAN', '-', '-'),
(123, '-', 'Analisis dan Pengembangan Infrastruktur Jaringan Komputer Dalam Mendukung Implementasi Sekolah Digital (Study Kasus SD Negeri 2 Sumbawa Besar)', 'KUDRATULLAH', '-', '-'),
(124, '-', 'Aplikasi Pelaporan Kegiatan Mentoring di Universitas Teknologi Sumbawa Berbasis Android', 'YAHYA ABDAN SYAKURA', '-', '-'),
(125, '-', 'Rancang Bangun Sistem Informasi Pengolahan Data Ternak (SIPADAK) Pada Unit Pelaksana Teknis Produksi Dan Kesehatan Hewan Kecamatan Lape Dan Kecamatan Lopok Berbasis Web', 'KIKI RIZKI ANANDA', '-', '-'),
(126, '-', 'Sistem Informasi Pendaftaran Nikah di Kantor Urusan Agama (KUA) Kecamatan Empang Berbasis Web', 'JULMIANTI', '-', '-'),
(127, '-', 'APLIKASI \"HALO PSIKOLOG\" BERBASIS WEB PADA PROGRAM STUDI PSIKOLOGI UNIVERSITAS TEKNOLOGI SUMBAWA', 'YAHYA DARSA PUTRA', '-', '-'),
(128, '-', 'Rancangan Bangun Sistem Informasi Akademik Berbasis Web Pada SMP Negeri 2 Empang', 'ARJUNA WIRAPANJI', '-', '-'),
(129, '-', 'Rancang Bangun Jaringan Komputer Menggunakan Sistem Manajemen OMADA Controller Pada Inspektorat Kabupaten Sumbawa Dengan Metode Network Development Life Cycle (NDLC)', 'SATRIO BUDI PRAKOSO', '-', '-'),
(130, '-', 'Rancang Bangun Sistem Informasi Pendataan Anggota Posyandu Anggrek Putih I Desa Pernek Berbasis Web', 'RESKY ADE KU BUYA', '-', '-'),
(131, '-', 'Rancang Bangun Sistem Informasi Penjualan Pada Toko OMG (Berbasis Web Di Kecamatan Empang Kabupaten Sumbawa)', 'HASMAWATI', '-', '-'),
(132, '-', 'Sistem Informasi U-Activity Pada SMK Al- Kahfi Berbasis Web Untuk Mengevaluasi Ketercapaian Kurikulum Setiap Pengajar', 'ABSORIHIM', '-', '-'),
(133, '-', 'Rancang Bangun Sistem Informasi Praktik Dokter Di Klinik Dokter Lulusia Agung Berbasis Web', 'AMMATULLAH AISYAH AHMAD', '-', '-'),
(134, '-', 'Pengembangan Sistem Informasi Pendataan Bedah Rumah Berbasis Web Pada Dinas Perumahan Rakyat Dan Kawasan Pemukiman Di Kabupaten Sumbawa', 'DENDI SAPUTRO', '-', '-'),
(135, '-', 'Rancang Bangun Short Message Service (SMS) Gateway Pada UPT Penerimaan Mahasiswa Baru Universitas Teknologi Sumbawa Berbasis Web', 'DIMAS PRATAMA', '-', '-'),
(136, '-', 'Pengebangan Sistem Informasi Keuangan Desa (SIKADES) Berbasis Web', 'EKO SYAMSUL FITRIANTO', '-', '-'),
(137, '-', 'Aplikasi Manajemen Ekrakurikuler Pramuka Berbasis Android Di SMAN 1 Lunyuk', 'FAHMI KURNIAWAN', '-', '-'),
(138, '-', 'Sistem Infromasi Pendaftaran Siswa Baru Pada SMKN 2 Sumbawa Besar Berbasis Web', 'HARFINA APRIANTI', '-', '-'),
(139, '-', 'Sistem Informasi Kredit Sahabat Pada Sahabat Pada Badan Usaha Milik Desa (BUMDes) Desa Semamung Berbasis Web', 'JUNDI KHOIRULLOH', '-', '-'),
(140, '-', 'Sistem Informasi Penerimaan Mahasiswa Baru Berbasis Web Di Sokolah Tinggi Keguruan Ilmu Pendidikan Paracendekia Nahdlatul Wathan Sumbawa', 'MUHAMMAD DIAN FAJRI', '-', '-'),
(141, '-', 'Rancang Bangun Sistem Infromasi Olat Maras Holticultural', 'M. ZAMMUL ADITYA FU\'ANI', '-', '-'),
(142, '-', 'Sistem Informasi Penjualan Produk Pertanian Pada Badan Usaha Milik Desa (BUMDes) Pernek Kecamatan Moyo Hulu Berbasis Web', 'MARIATI', '-', '-'),
(143, '-', 'Rancang Bangun Aplikasi Media Pembelejaran \"Basa Samawa\" Berbasis Android', 'MIFTAHUL MA\'RIF', '-', '-'),
(144, '-', 'Rancang Bangun Aplikasi Hybrid Penjualan Kuliner Di Pantai Jempol Sumbawa', 'MUKLIANI', '-', '-'),
(145, '-', 'Sistem Informasi Inventaris Barang Berbasis Web Pada SMPN 1 Buer', 'NOVI OKTAVIANI', '-', '-'),
(146, '-', 'Rancang Bangun Aplikasi Pendaftaran Sistematis Lengkap (PTSL) Pada Badan Pertanahan Nasional (BPN) Kabupaten Sumbawa Berbasis Web', 'NOVYANDA', '-', '-'),
(147, '-', 'Sistem Informasi Geografis Pemetaan Tata Letak Fasilitas Publik Di Sumbawa', 'PAJAR AJI MAOLANA', '-', '-'),
(148, '-', 'Rancang Bangun Game Edukasi Tata Cara Sholat 5 Waktu Dan Pengenalan Huruf Hijaiyah Berbasis Virtual Reality (VR)', 'RAHMAT HIDAYAT', '-', '-'),
(149, '-', 'Sistem Informasi Akademik SMK Negeri 3 Sumbawa Besar Berbasis web', 'REZA SANGGA RASEFTA', '-', '-'),
(150, '-', 'Multmedia Kesultanan Sumbawa Berbasis Android', 'SYAHLI ANDANI', '-', '-'),
(151, '-', 'Rancang Bangun Sistem Monitoring Perkembangan Anak Di TK IT Taamasa Menggunakan Metode Spiral', 'UMARA MAHARANI', '-', '-'),
(152, '-', 'Rancang Bangun Aplikasi Pendaftaran Musabaqah Tilawatil Qur\'an (MTQ) Kabupaten Sumbawa Berbasis Web', 'YUNIAR ANDRIANI', '-', '-'),
(153, '-', 'Sistem Informasi Administarasi KeuanganSekolah Berbasis Web (Studi Kasus : SMK Al-Kahfi)', 'YUYUN TARI', '-', '-'),
(154, '-', 'Citra digital', 'MUHAMMAD JAMAL', '-', '-'),
(155, '-', 'Sistem Informasi Manajemen Rumah Susun Sumbawa Universitas Teknologi Sumbawa Berbasis Web', 'MUHAMMAD RIFQI FAWZAN', '-', '-'),
(156, '-', 'Rancang Bangun Sistem Informasi Manajemen Avin Laundry Sumbawa Berbasis Web', 'WINDA ARYANI', '-', '-'),
(157, '-', 'Analisis Kelayakan Penerapan Sistem Informasi Peminjaman Sarana Dan Prasarana Di Universitas Teknologi Sumbawa', 'SUKMAWATI', '-', '-'),
(158, '-', 'Implementasi Data Mining dalam Klasifikasi Data Hasil Monitoring dan Evaluasi Beasiswa menggunakan Algoritma C4.5 (Studi Kasus: Unit Pelaksana Teknis Beasiswa Universitas Teknologi Sumbawa)', 'MAHARDIKA', '-', '-'),
(159, '-', 'Sistem Informasi Pendataan dan Pengarsipan Berkas Pelayanan Administrasi Terpadu Kecamatan (PATEN) di Kecamatan Sumbawa dengan Metode Waterfall', 'NOVITA ANANDA GAYATRI', '-', '-'),
(160, '-', 'Pembangunan Web Service Menggunakan Rest API Codeigniter Dengan Access Token', 'WAHYU RAHMANA', '-', '-'),
(161, '-', 'Rancang Bangun Aplikasi Reservation Hotel Berbasis Web Menggunakan PHP, HTML, CSS, Database Mysql (Studi Kasus Hotel Tambora Sumbawa)', 'YULI SANTIKA', '-', '-'),
(162, '-', 'Rancang Bangun Aplikasi Pendaftaran Yudisium Pada Fakultas Teknik Universitas Teknologi Sumbawa Berbasis Web', 'NEVA NURLIANA', '-', '-'),
(163, '-', 'Pengembangan Game Edukasi Pembelajaran Akhlak Berbasis Virtual Reality', 'MOCH. WAHYU FIRMANSYAH', '-', '-'),
(164, '-', 'Analisis Perbandingan Performa Kecepatan Routerboard Mikrotik Dan Cisco (Studi Kasus: Hotel Tambora Sumbawa Besar)', 'WIRA ADE PUTRA', '-', '-'),
(165, '-', 'Analisis perbandingan performa freeradius dan usermanager pada mikrotik', 'NANANG BUDIANSYAH', '-', '-'),
(166, '-', 'Rancang Bangun Aplikasi Pembelajaran Tanaman Obat Berbasis Augmented Reality', 'YUDI PRATAMA', '-', '-'),
(167, '-', 'Pengembangan Sistem Informasi Pendaftaran Pasien Dan Pemeriksaan Berbasis Web Di Puskesmas Pembantu (PUSTU) Desa Leseng Menggunakan Metode Waterfall', 'JASMAWANTI', '-', '-'),
(168, '-', 'Rancang Bangun Aplikasi Pendaftaran Ujian EEAPT Berbasis Web pada UPT Pusat Bahasa Universitas Teknologi Sumbawa', 'NURFAISUL HIDAYAT', '-', '-'),
(169, '-', 'Sistem Informasi Administrasi Keuangan Siswa Pada SMA Negeri 1 Moyo Hulu Berbasis Web.', 'FEBRIANTI', '-', '-'),
(170, '-', 'Rancang Bangun Aplikasi Elektronik Rapor Pada SMA Negeri 1 Moyo Hulu Berbasis Web', 'HERNAWATI', '-', '-'),
(171, '-', 'Rancang Bangun Sistem Informasi Pelayanan Administrasi Kependudukan Berbasis Web Menggunakan PHP Dan MySQL (Studi Kasus Di Desa Maronge)', 'SITI HAJAR', '-', '-'),
(172, '-', 'Pengembangan Sistem Informasi Peminjaman Dana BUMDES Berbasis Web Menggunakan PHP Dan MySQL (Studi Kasus \"BUMDES Tiu Kulit Desa Simu\")', 'RATI GUSTINA', '-', '-'),
(173, '-', 'Pengembangan Sistem Informasi Warkah (Si-Iwar) di Kantor Pertanahan Kabupaten Lombok Timur Berbasis Web', 'NUR LAILY HAMIDAH', '-', '-'),
(174, '-', 'Manajemen Pengelolaan Data pada Harmony Fitness Center Sumbawa Berbasis Web', 'ANNA SAYUNI', '-', '-'),
(175, '-', 'Aplikasi Monitoring Penyaluran Pupuk Bersubsidi (Studi Kasus: Bumdes Bukit Emas) Desa Kukin Berbasis Web', 'FEBBY LIMAS SENDEL VANT', '-', '-'),
(176, '-', 'Rancang Bangun Sistem Informasi Untuk Meningkatkan Tata Kelolah Administrasi Surat Menyurat Di Kelurahan Uma Sima Kabupaten Sumbawa', 'EVA OKTAVIANI', '-', '-'),
(177, '-', 'Rancang Bangun Sistem Informasi Akademik Menggunakan Metode Prototype\nSemoga bermanfaat bagi yg menggunakan aplikasi ini nantinya', 'FAJAR NUSANTARA PUTRA', '-', '-'),
(178, '-', 'Rancang Bangun Aplikasi Keuangan Sebagai Solusi Peningkatan Tata Kelola Keuangan Badan Usaha Milik Desa (BUMDES) Pernek', 'DITA PUTRI RIZKITA', '-', '-'),
(179, '-', 'Perancangan Sistem Informasi Pelaporan Data Riset dan Pengabdian Dosen dengan Zachman Framework (Study Kasus: Direktorat Riset dan Inovasi serta Direktorat Pengabdian kepada Masyarakat Universitas Teknologi Sumbawa)', 'AISYAH NUR FADHILAH', '-', '-'),
(180, '-', 'Sistem Informasi Booking Jasa Pariwisata Di Kabupaten Sumbawa', 'SAHRU RAMADAN LUBIS', '-', '-'),
(181, '-', 'Rancang Bangun Aplikasi Percetakan Tiga Bersaudara Berbasis Web  Dengan Metode Waterfall', 'ARDIAN SHALIHIN', '-', '-'),
(182, '-', 'Pengembangan Ensiklopedia Kebudayaan Sumbawa Berbasis Android', 'JUMADI', '-', '-'),
(183, '-', 'Pengembangan Aplikasi Pelaporan Mentoring Universitas Teknologi Sumbawa Berbasis Web', 'MUSTHOFA LUTHFI A M', '-', '-'),
(184, '-', 'Rancang Bangun Sistem Informasi Akademik Pada SDIT Insan Qur\'ani Sumbawa', 'INDAH LISTARI', '-', '-'),
(185, '-', 'Pengembangan Sistem Informasi Sarana dan Prasarana di Universitas Teknologi Sumbawa Menggunakan Metode Spiral Berbasis Web', 'AHMAD AZZAM SHIBGHATALLAH', '-', '-'),
(186, '-', 'Rancang Bangun Aplikasi Penjadwalan Pekerja Geprek Chicken Dinner Menggunakan Algoritma Genetika', 'KHALID AL ASAD', '-', '-'),
(187, '-', 'Rancang Bangun Web Service sebagai penyedia Basis Data Induk di Geprek Chicken Dinner', 'MUHAMMAD HANIF', '-', '-'),
(188, '-', 'Rancang Bangun Aplikasi Tata Kelola Desa Berbasis Web Menggunakan Metode Waterfall Di Kantor Desa Sepukur', 'DERI AFRILIYANSA', '-', '-'),
(189, '-', 'Implementasi Port Knocking Untuk Keamanan Jaringan SMK Negeri 1 Sumbawa Besar', 'ALDELA JABI AFAHAR', '-', '-'),
(190, '-', 'Pengembangan Sistem Informasi Akuntansi Keuangan Masjid (SIKANGMAS) Menggunakan Metode Waterfall Pada Masjid Nurul Islam Sumbawa', 'ARDIANSYAH PUTRA', '-', '-'),
(191, '-', 'Rancang Bangun Aplikasi Pendataan Penduduk Berbasis Web Di Kelurahan Bugis', 'MUJAHIDIN PATTI PEILOHY', '-', '-'),
(192, '-', 'RANCANG BANGUN SISTEM INFORMASI LAYANAN ADMINDUK ONLINE BERBASIS WEB DI DINAS KEPENDUDUKAN DAN PENCATATAN SIPIL KABUPATEN SUMBAWA', 'RAHMAD HANAPI', '-', '-'),
(193, '-', 'Rancang Bangun E-Learning Berbasis Web Pada SMK Negeri 3 Sumbawa', 'ARMAN DIANSYAH', '-', '-'),
(194, '-', 'Rancang Bangun Aplikasi Kelompok Tani Uma Beringin Kecamatan Alas Berbasis Web', 'AHMAD FAUZUL KABIR', '-', '-'),
(195, '-', 'Rancang Bangun Sistem Informasi Penjualan Kain Tenun (Kre Alang) Berbasis Web Di Desa Sebewe', 'LILIS HARTINA', '-', '-'),
(196, '-', 'RaBa TeMane (Rancang Bangun Tenun Marketplace Online) berbasis Web', 'YAYAN BAHTIAR', '-', '-'),
(197, '-', 'Rancang Bangun Aplikasi Pemesanan Barang berbasis Web pada Distribusi Barang Rifa\'i', 'ALPIN RAESANDI', '-', '-'),
(198, '-', 'Sistem Informasi Kredit Sahabat Pada Badan Usaha Milik Desa (BUMDES) Desa Moyo Berbasis Web', 'FAHRUL IRWANSAH', '-', '-'),
(199, '-', 'SISTEM INFORMASI MANAJEMEN EVENT ELECTRONIC SPORT (E-SPORT) BERBASIS WEB PADA KOMUNITAS ESPORT INDONESIA (ESI) WILAYAH KABUPATEN SUMBAWA', 'AENUL MEISER', '-', '-'),
(200, '-', 'Sistem Informasi Situs Sejarah dan Wisata Budaya di Kabupaten Sumbawa Berbasis Android', 'ILHAM WAHYUDI', '-', '-'),
(201, '-', 'Pengembangan Aplikasi E-Votting Untuk Pemilihan Ketua Osis Berbasis Android', 'IRSYAD MUHAMAD DZAROZAH', '-', '-'),
(202, '-', 'Rancang Bangun Aplikasi Monitoring Suhu Dan Kelembaban Ruangan Berbasis Android Dengan Teknologi Wireless Sensor Network', 'MIQDAD ABDURROHMAN', '-', '-'),
(203, '-', 'Rancang Bangun Aplikasi Pencatatan Order Akta Notaris dan PPAT I Wayan Pastika', 'HANIF PRIABDUL AZIZ', '-', '-'),
(204, '-', 'RANCANG BANGUN SISTEM INFORMASI SARANA DAN PRASARANA ASRAMA UTS MENGGUNAKAN METODE WATERFALL', 'SAM\'UN BASIR', '-', '-'),
(205, '-', 'Rancang Bangun Aplikasi Inventory Barang Pada TEMPAT FOOD AND DRINK Berbasis Android Dengan Metode Waterfall', 'HAMMID MUAMMAR ROBBANI AL FARUQ', '-', '-'),
(206, '-', 'Rancang Bangun Aplikasi Pembayaran Iuran Siswa SDIT Laboratorium School Islamic Science And Technology (ISTEC) Kota Bekasi Berbasis Web', 'FADHIL AR-RAHMAN', '-', '-'),
(207, '-', 'Sistem Infromasi Pengelolaan Data Perpustakaan di SMP Negeri 2 Sumbawa Besar Berbasis Website', 'MUHLAS ADE SAPUTRA', '-', '-'),
(208, '-', 'Rancang Bangun Web Server Untuk Mesin Pengering Rumput Laut Berbasis Internet Of Things', 'RHOMADON', '-', '-'),
(209, '-', 'Aplikasi English Village Pare Menggunakan Integrated Development Environment (IDE) Android Studio', 'MHD. SOKHIBUL PADILA PADLI', '-', '-'),
(210, '-', 'Pengembangan Aplikasi Mengenal Aksara Satera Jontal Berbasis Android', 'KEVIN NOANDA ADITYA RUDY YANTO', '-', '-'),
(211, '-', 'Rancang Bangun Aplikasi Perpus Rakyat Berbasis Web di Kota Jambi', 'ANDRY SYAHPUTRA RITONGA', '-', '-'),
(212, '-', 'Rancang Bangun Sistem Informasi Go-SIP Berbasis Web Di Dinas Lingkungan Hidup Kabupaten Sumbawa', 'RIDWAN ALI KAFABILLAH ASSEGAF', '-', '-'),
(213, '-', 'Sistem Monitoring Survey Pengajuan Pengambilan Kredit di Dealer NSS Berbasis Web', 'TONNY AYADI', '-', '-'),
(214, '-', 'Pengembangan Aplikasi TOEFL Practice Exam Berbasis Website Pada Universitas Teknologi Sumbawa', 'IQBAL BUDIKUSUMA', '-', '-'),
(215, '-', 'Aplikasi Pendaftaran Sertifikasi Kompetensi Pada Career Development Center (CDC) Universitas Teknologi Sumbawa', 'RANDI HARTONO', '-', '-'),
(216, '-', 'Sistem Pendukung Keputusan Dalam Menentukan Dosen Pembimbing Skripsi', 'NINIK WAHYU WULANDARI', '-', '-'),
(217, '-', 'Sistem Informasi Unit Kegiatan Mahasiswa Taekondo Universitas Teknologi Sumbawa Berbasis Web', 'Muhammad Hasan Basri', '-', '-'),
(218, '-', 'Analisis Perbandingan Performa Sistem Monitoring Jaringan Host-Tracker dan Nagios di Universitas Teknologi Sumbawa', 'USAID MUBAROK', '-', '-'),
(219, '-', 'Rancang Bangun Sistem Informasi Pebdaftaran Siswa Baru Pada Sekolah Dasar Islam Plus Baitul Maal Tangerang Selatan Berbasis Web', 'MUHAMMAD AZAM ROBBANI', '-', '-'),
(220, '-', 'Rancang Bangun Sistem Informasi Penerimaan Siswa Baru Online Berbasis Web Pada SMPIT ULIL ALBAB', 'ROBIANTO DWI RAHMAWAN', '-', '-'),
(221, '-', 'Implementasi React Server Component dan Server Action untuk Meningkatkan Performa Aplikasi Web', 'LAZARUS', '-', '-'),
(222, '-', 'Sistem Informasi Pemetaan Situs Sejarah dan Budaya di Kabupaten Sumbawa Berbasis Web', 'Ilham Suryadi Kusuma', '-', '-'),
(223, '-', 'Rancang Bangun Sistem Informasi Pengaduan Layanan Sarpras di Universitas Teknologi Sumbawa Berbasis Web', 'SULTAN NAUFAL ABDILLAH', '-', '-'),
(224, '-', 'Implementasi Quick Acces dengan metode QR code dan keamanan login menggunakan captcha pada aplikasi Basiru', 'SYUKRIANSYAH', '-', '-'),
(225, '-', 'Aplikasi Pembelajaran Budaya Sumbawa Untuk Anak-Anak Berbasis Android', 'RISNA', '-', '-'),
(226, '-', 'SISTEM INFORMASI PELAYANAN ADMINISTRASI DI KANTOR DESA LAPE BERBASIS WEB', 'ALDI PRANATA', '-', '-'),
(227, '-', 'Rekayasa perangkat lunak crowfunding basiru menggunakan pemrogram php dan freamwork codeigniter', 'SULASTRI', '-', '-'),
(228, '-', 'APLIKASI TABUNGAN PONDOK PESANTREN DAYAH PERBATASAN DARUL AMIN KUTACANE ACEH TENGGARA MENGGUNAKAN ALGORITMA KEAMANAN AES BERBASIS WEB', 'BRENNY PRASETYO WATY', '-', '-'),
(229, '-', 'RANCANG BANGUN APLIKASI E-COMMERCE BERBASIS WEB PADA TOKO UD. NIRA UTAMA.', 'ARI SYAHWATULLAH', '-', '-'),
(230, '-', 'Penerapan Malware security menggunakan filtering Firewall dengan metode port blocking pada mikrotik untuk keamanan jaringan SMK negeri 1 Sumbawa', 'AHMAD AFANDI FAJDUANI', '-', '-'),
(231, '-', 'Analisis keamanan website Universitas teknologi Sumbawa dengan pengujian serangan Distributed Denial of service (DDoS) menggunakan Low orbit ion Cannon (LOIC)', 'NURUL BADRIYAH', '-', '-'),
(232, '-', 'REKAYASA SISTEM INFORMASI MANAJEMEN PANTI ASUHAN MUHAMMADIYAH SUMBAWA BERBASIS WEB', 'SITI KALKAUSAR DJAFAR H S', '-', '-'),
(233, '-', 'Rekayasa Sistem Informasi Penjualan Barang di RJ Toko Berbasis Web', 'RAHMATIA FATMASARI', '-', '-'),
(234, '-', 'Implementasi Hotspot dengan User Manager untuk Internet Wireless menggunakan Mikrotik Rb 941-2nd di MTsN 1 Sumbawa Besar', 'ARSI DWI SEPTIARINI', '-', '-'),
(235, '-', 'Rancang Bangun Aplikasi e-Arsip Administrasi pada Kantor Kecamatan Batulanteh', 'MUHAMMAD ARNO', '-', '-'),
(236, '-', 'Pengembangan Aplikasi Smart-Book sebagai Media Pembelajaran Bahasa Inggris Anak berbasis AR (Augmented Reality)', 'FIKRI NURYANSAH', '-', '-'),
(237, '-', 'Analisis Keamanan Jaringan Komputer Pada Kantor Desa Batu Dulang Menggunakan Metode Security Policy Development Life Cycle (SPDLC)', 'MOH. FAUZY', '-', '-'),
(238, '-', 'Analisis Serangan Botnet DDoS Pada Website Facebook Deangan Menggunakan Metode National Institute of Standars And tecnology (NIST)', 'FATIMAH YASIN', '-', '-'),
(239, '-', 'Aplikasi Basiru(Crowdfunding) berbasis Android Menggunakan Rest Api', 'EVA RAHMIATI', '-', '-'),
(240, '-', 'Analisis Data Mining untuk Menghasilkan Strategi Promosi Mahasiswa Baru Universitas Teknologi Sumbawa', 'MUHAMMAD AULIA IBRAHIM', '-', '-'),
(241, '-', 'Aplikasi Tabungan Pondok Pesantren Dayah Perbatasan Darul Amin Kutacane Aceh Tenggara Menggunakan Algoritma Keamanan AES menggunakan Algoritma AES berbasis WEB', 'BRENNY PRASETYO WATY', '-', '-'),
(242, '-', 'Analisis User Experience Pada Website Dinas Pemuda Olahraga Dan Pariwisata Kabupaten Sumbawa Dengan Menggunakan Metode User Experience Questionnaire (UEQ)', 'YUTISTA MAWADDAH', '-', '-'),
(243, '-', 'Penerapan Malware Security Menggunakan Filtering Firewall dengan Metode Port Blocking pada Mikrotik untuk Keamanan Jaringan SMKN 1 Sumbawa', 'AHMAD AFANDI FAJDUANI', '-', '-'),
(244, '-', 'Analisis User Experience pada Website Dinas Kesehatan Kabupaten Sumbawa Menggunakan Metode Pieces', 'SASTRIANING SAFITRI', '-', '-'),
(245, '-', 'Analisis User Experience Pada Website Universitas Teknologi Sumbawa Menggunakan Metode Webqual', 'YENI RAHMAWATI', '-', '-'),
(246, '-', 'Aplikasi Pendaftaran Santri Baru Menggunakan Algoritma Best First Search pada Pesantren Manbaul Ulum Kabupaten Bondowoso', 'ULFATUS SOLEHA', '-', '-'),
(247, '-', 'Analisis Kualitas Penggunaan Website Terhadap Layanan Civitas Akademika Program Studi Teknik Informatika Universitas Teknologi Sumbawa', 'SUKMA ASYFINAWATI', '-', '-'),
(248, '-', 'Sistem Informasi Pelayanan Posyandu berbasis Web Menggunakan Metode Waterfall pada Posyandu Tambora Kelurahan Brang Biji.', 'RIZGIKA PUSPARINI', '-', '-'),
(249, '-', 'Rekayasa Aplikasi Layanan Administrasi Surat Menyurat Pada Fakultas Teknik Universitas Teknologi Sumbawa', 'EVI NURMALA', '-', '-'),
(250, '-', 'Rancang Bangun Sistem Informasi Karang Taruna Desa Uma Beringin Berbasis Web', 'ANDRIANSYAH', '-', '-'),
(251, '-', 'ANALISIS PERBANDINGAN PERFORMA MIKHMON DAN USERMANAGER PADA MIKROTIK', 'DIKA HAMDAYAN', '-', '-'),
(252, '-', 'ANALISIS DAN PERANCANGAN INFRASTRUKTUR JARINGAN MIKROTIK PADA KANTOR DESA PENYARING MENGGUNAKAN METODE SPDLC', 'MOH. FASLIN', '-', '-'),
(253, '-', 'Pengembangan Aplikasi Edukasi Animasi 3D Huruf Hijaiyah Berbasis Android', 'MUHAMMAD SYUKUR', '-', '-'),
(254, '-', 'Rekayasa Aplikasi Center Rumah Kost Berbasis Web di Kabupaten Sumbawa', 'NURUL MAULIDA SOLIHAT', '-', '-'),
(255, '-', 'ANALISIS DAN PENGEMBANGAN JARINGAN KOMPUTER DENGAN FITUR WEB PROXY BERBASIS MIKROTIK (STUDI KASUS : KANTOR DESA PUNGKIT KECAMATAN MOYO UTARA)', 'HAMKA SATRIA PUTRA', '-', '-'),
(256, '-', 'Pembuatan Sistem Penjualan Pupuk Bersubsidi Pada Kios Pupuk CV. Mitra Utama Di Desa Moyo Hilir Berbasis Web', 'FEBRIANSAH', '-', '-'),
(257, '-', 'ANALISIS PERBANDINGAN PERFORMA MODEM USB TP-LINK DAN TELKOMSEL ORBIT MENGGUNAKAN METODE QOS (STUDI KASUS: KANTOR DESA LABUHAN SANGORO)', 'DENDI ARDIANSYAH', '-', '-'),
(258, '-', 'Aplikasi Pelayanan Pengaduan Masyarakat Berbasis Web Pada Kantor Desa Pungkit', 'ANANDA BAKTI DARMAWAN', '-', '-'),
(259, '-', 'ANALISIS PEFORMA WEB PROXY PADA RASPBERRY PI UNTUK MEMFILTER ALAMAT WEBSITE (Studi Kasus : Lab Komputer, Universitas Teknologi Sumbawa)', 'MUHAMMAD RIZKI', '-', '-'),
(260, '-', 'APLIKASI PEMBAYARAN IURAN BULANAN PADA TPQ AS-SALAM SUMBAWA BERBASIS ANDROID', 'HABIB SHIBGHATALLAH', '-', '-'),
(261, '-', 'Implementasi Computer Assisted Instruction (CAI) pada Aplikasi Pembelajaran Aksara Sumbawa Berbasis Android dengan Metode Rapid Application Development (RAD)', 'BIMA MOCH HAFIDH AL FADLURROHMAN', '-', '-'),
(262, '-', 'SISTEM INFORMASI MANAJEMEN ASET BERBASIS WEB DI UNIVERSITAS TEKNOLOGI SUMBAWA', 'M. ZAYYAN MUSOFFA', '-', '-'),
(263, '-', 'Analisis kualitas Layanan Streaming di Universitas Teknologi Sumbawa Menggunakan Metode Quality of Service (QoS)', 'M. ZULKIFLI', '-', '-'),
(264, '-', 'SISTEM INFORMASI MANAJEMEN FAKULTAS TEKNIK UNIVERSITAS TEKNOLOGI SUMBAWA', 'MUHAMMAD HUDZAIFAH ASY SYIDIQ', '-', '-'),
(265, '-', 'PENERAPAN ALGORITMA APRIORI PADA APLIKASI PENJUALAN SEMBAKO UNTUK MENENTUKAN TATA LETAK BARANG', 'HAFIDZ ILMAN MUTTAQIN', '-', '-'),
(266, '-', 'SISTEM INFORMASI PKK DESA UMA BERINGIN KECAMATAN UNTER IWES KABUPATEN SUMBAWA', 'MIFTAHUL HAQ', '-', '-'),
(267, '-', 'ANALISIS KEAMANAN WEBSITE UNIVERSITASTEKNOLOGI SUMBAWA DENGAN PENGUJIAN SERANGAN DISTRIBUTED DENIAL OF SERVICE (DDOS)  MENGGUNAKAN LOW ORBIT ION CANNON (LOIC)', 'NURUL BADRIYAH', '-', '-'),
(268, '-', 'Analisis Keamanan Website SMAN 1 Sumbawa Menggunakan Metode Vulnerability Asesment', 'JUMIRAH', '-', '-'),
(269, '-', 'PERANCANGAN USER INTERFACE SISTEM CROWDFUNDING BASIRU DENGAN PENDEKATAN USER-CENTERED DESIGN (UCD)', 'RAMDAYANI', '-', '-'),
(270, '-', 'Rancang Bangun Aplikasi UTS IN ME  Berbasis Android Menggunakan  Flutter Dengan Metode Rapid Application Development', 'JATI IMANULLOH', '-', '-'),
(271, '-', 'Rancang Bangun Sistem Informasi Jasa Tukang Di \"Bale Tukang Pupinka\" Berbasis Web', 'NUSAIBAH WAFIA SANTOSO', '-', '-'),
(272, '-', 'Analisis Kerentanan Cross Site Scripting Pada Aplikasi Open Journal System Jinteks Menggunakan Metode Vulnerability Assessment', 'MITA PUTRIYANTI', '-', '-'),
(273, '-', 'Rekayasa Perangkat lunak crowfunding basiru menggunakanpemrograman php dan freamwork codeigniter', 'SULASTRI', '-', '-'),
(274, '-', 'Analisis Kepuasan Pengguna Sistem Informasi Akademik di Universitas Teknologi Sumbawa', 'RIZKA FAJRIATUR RAHMA', '-', '-'),
(275, '-', 'Rekayasa Sistem Informasi Absensi Siswa Berbasis Internet Di SMP Negeri 1 Unter Iwes', 'SONIA', '-', '-'),
(276, '-', 'Pengaruh Tingkat Kepuasan Pengguna Lulusan (Stakeholders) Terhadap Kualitas Lulusan Pada Universitas Teknologi Sumbawa', 'SANSUL YASMI', '-', '-'),
(277, '-', 'Analisis Pengembangan User Interface dan User Experience Pada Website Bank Perkreditan Rakyat Sumbawa Menggunakan Metode Design Thinking', 'AZZAHRAH MAULYA SAFIRA', '-', '-'),
(278, '-', 'Aplikasi Self Service Pelayanan Masyarakat Pada Desa Labuhan Sumbawa', 'ELGA RAMDANI', '-', '-'),
(279, '-', 'Rancang Bangun Antena Yagi pada Frekuensi 1800 Mhz untuk Penguatan Sinyal Modem', 'BABUL SALAM', '-', '-'),
(280, '-', 'Rancang Bangun Galeri UMKM BRItama Berbasis E-Commerce (Studi Kasus : Desa Batudulang)', 'MEGA TAZAYYUN', '-', '-'),
(281, '-', 'Sistem Informasi Keuangan Berbasis Web Pada Yayasan Mitra Insan Utama(YAMISTA) Provinsi Sulawesi Tengah', 'TRISULA BARKAH', '-', '-'),
(282, '-', 'Sistem Informasi Keuangan Berbasis Web pada Yayasan Mitra Insan Utama (YAMISTA) Propinsi Sulawei Tengah', 'TRISULA BARKAH', '-', '-'),
(283, '-', 'PENERAPAN FRAMEWORK COBIT 5 DALAM ANALISIS KEAMANAN WEBSITE DESA UMA BERINGIN DENGAN METODE CAPABILITY MATURITY MODEL INTEGRATION(CMMI)', 'ZULKARNAEN', '-', '-'),
(284, '-', 'Analisis Keamanan Firewall pada Login Router Mikrotik dengan Metode Penetration Testing (Studi Kasus SMKN 3 Sumbawa)', 'YUSRAN RIJALUDDIN', '-', '-'),
(285, '-', 'Analisis Keamanan Wireless Local Area Network Terhadap Serangan Brute Force dengan Metode Penetration Test', 'RANDI CANDRA KIRANA', '-', '-'),
(286, '-', 'PENERAPAN DATA MINING UNTUK MENENTUKAN PERSEDIAAN BARANG DENGAN METODE ALGORITMA APRIORI DI TOKO ALIFA', 'RIFQI AUFA', '-', '-'),
(287, '-', 'Rancang Bangun e-Commerce dalam pemasaran produk UMKM Desa Batu Dulang', 'MEGA TAZAYYUN', '-', '-'),
(288, '-', 'Sistem Informasi Penilaian Kinerja Pegawai Menggunakan Metode Psicological Apraisal Berbasis Web', 'NUR IMANSYAH', '-', '-'),
(289, '-', 'Aplikasi Center Laundry pada Laundry Sekar Bekasi Berbasis Web', 'GHOZI SYAHIDDIN RIDHO', '-', '-'),
(290, '-', 'Sistem informasi pengenalan sastra lisan sakeco khas Sumbawa berbasis web', 'IDHAM AMDIN', '-', '-'),
(291, '-', 'ANALISIS PERBANDINGAN KINERJA ROUTER BERBASIS LINUX DEBIAN DAN ROUTER BERBASIS MIKROTIK OS MENGGUNAKAN QUALITY OF SERVICE (QOS)', 'SATRIAWANSYAH. SB', '-', '-'),
(292, '-', 'Analisis Keamanan Website SMA Negeri 2 Sumbawa Besar Menggunakan Metode Penetration Testing (Pentest)', 'SAFWAN SIHAB', '-', '-'),
(293, '-', 'Optimalisasi Kualitas Layanan Internet Berdasarkan Pengelolaan Bandwith Berbasis Block Streaming dan Game pada SMKN 1 Lopok.', 'ISNAENI ZULKARNAEN', '-', '-'),
(294, '-', 'Aplikasi Permohonan Kebutuhan Surat Pegawai Berbasis Web ( Studi Kasus Direktorat PSDM UTS )', 'MUHAMMAD JAFAR SAKONE', '-', '-'),
(295, '-', 'SISTEM INFORMASI PELAYANAN JASA NOTARIS MENGGUNAKAN PHP DAN MYSQL DI KANTOR NOTARIS KUSLIANA S.H., M.Kn', 'HANIF FAUZAN RAMADHAN', '-', '-'),
(296, '-', 'Aplikasi Penilaian Target Kerja karyawan Berbasis web pada PT. ASDP Indonesia Ferry (Persero)', 'DHIA EARTHA HANIF', '-', '-'),
(297, '-', 'Pembuatan Prototipe Media Pembelajaran Tentang Wakaf Untuk Usia Sekolah Dasar Berbasis Multimedia', 'RISKY DARMAWAN', '-', '-'),
(298, '-', 'Digitalisasi Naskah Kuno Sumbawa Sebagai Bentuk Pelestarian Budaya Menggunakan Teknologi Unity', 'MIA MURNI MAHLIGAI PUTRI', '-', '-'),
(299, '-', 'Aplikasi Pendataan Hewan Ternak Besar Berbasis Android', 'FADEL MUHAMMAD RIZKY', '-', '-'),
(300, '-', 'APLIKASI PRESENSI PERKULIAHAN MENGGUNAKAN FINGERPRINT BERBASIS WEB (STUDI KASUS : PROGRAM STUDI TEKNIK INFORMATIKA)', 'DANY ANGGA SAPUTRA', '-', '-'),
(301, '-', 'Analisis Efektivitas Pemanfaatan Aplikasi Remote Komputer Menggunakan Metode PPDIOO', 'RINI PUTRI ADEKAYANTI', '-', '-'),
(302, '-', 'Analisis Forensics Database Sqlite Pada Aplikasi Whatsapp Untuk Penanganan Cybercrime Menggunakan Metode National Institute Of Standard And Technology (NIST)', 'M. MULIYONO', '-', '-'),
(303, '-', 'PENGEMBANGAN JARINGAN RT/RW NET PADA BUMI INDAH RESIDENCE MENGGUNAKAN TEKNIK FAILOVER 2 KONEKSI', 'FANDI SAPUTRA', '-', '-'),
(304, '-', 'Sistem Informasi Lelang Online Berbasis Web pada Pegadaian Desa Maronge', 'ARFAN JAYA', '-', '-'),
(305, '-', 'Sistem Informasi Reservasi Kamar Hotel Berbasis Web Menggunakan Laravel di Kabupaten Sumbawa', 'YORINDA NANDA UTAMI', '-', '-'),
(306, '-', 'Aplikasi Menentukan Kelayakan Mahasiswa Program Studi Informatika Untuk Mengambil Skripsi Di Universitas Teknologi Sumbawa', 'ADITYA BAGUS SASMITO', '-', '-'),
(307, '-', 'Analisis Keamanan Aplikasi Open Sistem Informasi Desa (OpenSID) Menggunakan Metode Vulnerability Assessment and Penetration Testing (VAPT) Studi Kasus Kelurahan Lempeh', 'DINO ARIANSYAH', '-', '-'),
(308, '-', 'Pengembangan Aplikasi Pendataan Komunitas E-sports di Sumbawa Menggunakan Framework Laravel', 'WAHYU INDRA PRATAMA', '-', '-'),
(309, '-', 'Sistem Informasi Pengendalian dan Realisasi Anggaran pada Dinas Komunikasi Informatika Statistik dan Persandian Kabupaten Sumbawa Berbasis Web', 'NURLINDA', '-', '-'),
(310, '-', 'Rancang Bangun Sistem Informasi Evaluasi Program Tahfidz Berbasis Web Ujian Online', 'KHAIDIR ARBABUL BASHAIR', '-', '-'),
(311, '-', 'Pengembangan Sistem Informasi Akademik Berbasis Web (Studi Kasus: SMA IT SAMAWA CENDEKIA)', 'REZA ALAM PRAMUDYA', '-', '-'),
(312, '-', 'Elektronik Poin Pelanggaran Siswa SMAN 1 Alas (E-PONSMANAS)', 'PUTRA AJI MULIA', '-', '-'),
(313, '-', 'Pengembangan Aplikasi Menghafal Al-Qur\'an Berbasis Android', 'ANGGI FITRIA', '-', '-'),
(314, '-', 'Sistem Informasi Manajemen Pengelolaan Apotek Vania Berbasis Web', 'MAULIDYA NURHIKMAWATI', '-', '-'),
(315, '-', 'Analisis Performa Tiga Metode Load Balancing Dengan Metode QOS', 'REZA IMAN SYAPUTRA', '-', '-'),
(316, '-', 'Rancang Bangun Sistem Informasi Tagihan Menggunakan Payment Gateway Berbasis Cashless Studi Kasus Di Sdit Nurul Ilmi', 'NABIL TAQIUDDIN MADJID', '-', '-'),
(317, '-', 'Analisis Firewall Jaringan Dari Serangan Port Scanning dan Denial of Service Menggunakan Metode Security Policy Development Life Cycle (SPDLC)', 'PANJI AKBAR SAMUDRA', '-', '-'),
(318, '-', 'Penerapan Sistem Pakar Menggunakan Metode Forward Chaining Untuk Mendiagnosa Penyakit Asam Lambung', 'MUHAMMAD RIZKY', '-', '-'),
(319, '-', 'Sistem Informasi Akademik SMAN 1 Moyo Utara Berbasis Web', 'HASTI UTARY ROMADON', '-', '-'),
(320, '-', 'Aplikasi Sumbawa Excursion Berbasis Web Di Kabupaten Sumbawa', 'MUHAMMAD FARISKI SEPTIAWAN', '-', '-'),
(321, '-', 'Pemanfaatan Teknologi Informasi dalam Meningkatkan Manajemen Perpustakaan SMA Negeri 1 Utan Kabupaten Sumbawa', 'NOVI NOVITA', '-', '-'),
(322, '-', 'Rancang Bangun Jaringan Hotspot Berbasis Mikrotik Dengan Metode Simple Queue Sebagai Traffic Priority Pada Global Village', 'DEDI WIJAYA SAPUTRA', '-', '-'),
(323, '-', 'Rancang Bangun Jaringan Hotspot Menggunakan Mikrotik Dengan Raspberry Pi Sebagai Simple Hotspot Manager Pada Ormawa Center Universitas Teknologi Sumbawa', 'ADJIE ADETIYA PRATAMA', '-', '-'),
(324, '-', 'Penerapan Algoritma Support Vector Mechine (SVM) untuk Diagnosis Penyakit Diabetic Retinopathy', 'ANA MARDIANA', '-', '-'),
(325, '-', 'APLIKASI E-LAPOR PADA DESA MARGA KARYA MENGGUNAKAN METODE PROTOTYPE', 'CHALVIN BEBBY FEBRIANTO', '-', '-'),
(326, '-', 'Analisis Keamanan Login Router Mikrotik Dari Serangan Brute force Studi Kasus: SMK Negeri 2 Sumbawa', 'AKBAR ALGI FARI', '-', '-'),
(327, '-', 'Sistem Informasi Manajemen Masjid Nurul Huda Desa Stowe Brang Berbasis Web', 'ANDRI NUR INSAN', '-', '-'),
(328, '-', 'INFORMASI LOWONGAN KERJA WILAYAH KABUPATEN SUMBAWA BERBASIS ANDROID.', 'INDAH PUTRIANTI', '-', '-'),
(329, '-', 'Pengembangan Sistem Informasi Pelayanan Posyandu Tambora Kelurahan Brang Biji Berbasis Android', 'DESIANA PUSPITA', '-', '-'),
(330, '-', 'Implementasi Firewall Packet Filtering pada Mikrotik Menggunakan Metode Security Police Development Life Cycle (SPDLC) Studi kasus: Kantor Desa Lopok', 'ATRI KAESA', '-', '-'),
(331, '-', 'Sistem Informasi Persediaan Bahan Bangunan Pada UD. Alam Raya Berbasis Web Menggunakan Metode Waterfall (Studi Kasus: Raberas, Kelurahan Seketeng)', 'ARSYAH KUMALASARI', '-', '-'),
(332, '-', 'Keamanan Sistem Informasi Menggunakan Kriptografi RSA Dengan Metode Reverse Engineering (Implementasi Pada Fitur Login Aplikasi Berbasis Web)', 'SURYA WATI', '-', '-'),
(333, '-', 'Aplikasi Monitoring Kegiatan Proyek Berbasis Web Pada CV. Aramco', 'SALITA ALZA FEBRY UTAMI', '-', '-'),
(334, '-', 'Simulasi Perancangan Keamanan Jaringan Firewall Packet Filtering Berbasis Mikrotik di Laboratorium Jaringan Komputer Universitas Teknologi Sumbawa', 'YANDA PUTRI ADE KANTARI', '-', '-'),
(335, '-', 'Rancang Bangun Sistem Informasi Pengolahan Data Lapangan Futsal GOR Mampis Rungan Berbasis Web Menggunakan Metode Extreme Programming', 'RYAN ADI SAPUTRA', '-', '-'),
(336, '-', 'Aplikasi Pengelolaan Dana BOP Berbasis Website Pada Paud Nurul Ilmi', 'SITI RAFIQAH NURJANNAH', '-', '-'),
(337, '-', 'Analisis Kinerja Jaringan Komputer dengan Metode Quality of Service pada Dinas Komunikasi dan Informatika Kabupaten Sumbawa Barat', 'IKHDA QURRATA AINI', '-', '-'),
(338, '-', 'MODIFIKASI ALGORITMA KRIPTOGRAFI CAESAR CIPHER MENJADI ALGORITMA KRIPTOGRAFI ASIMETRIS DENGAN METODE PENGEMBANGAN AGILE', 'TO\'O FATHONAH AL - KHALIQ Z', '-', '-'),
(339, '-', 'Implementasi Hand Sanitizer Otomatis Berbasis Mikrokontroler Arduino Uno Untuk Menjaga Kesehatan Masyarakat', 'GILANG GINANTA', '-', '-'),
(340, '-', 'Analisis Keamanan Website Menggunakan OWASP dan Control Objective for Information and Related Technology (COBIT) 5 (Studi Kasus Website Super Indo)', 'MUHAMMAD SHAFWAN KURNIAWAN', '-', '-'),
(341, '-', 'Implementasi Load Balancing Dan Failover Menggunakan Metode NTH ( Studi Kasus Semaras Esport)', 'HENDRA WAHYUDI', '-', '-'),
(342, '-', 'Rancang Bangun Sistem Informasi Alumni Penerima B-BEST LAZ RYDHA berbasis Web', 'SITI FITRIANAH', '-', '-'),
(343, '-', 'Pengembangan Alat Pendeteksi Kebocoran Liquefied Petroleum Gas Berbasis Mikrokontroler Wemos D1 R1 Dengan Notifikasi Calling', 'EKO PURWIRAWANSYAH', '-', '-'),
(344, '-', 'Rancang Bangun Aplikasi Pengolahan Data Pakan Ternak Berbasis Web.', 'RAHMAD GUSWANDI', '-', '-'),
(345, '-', 'Implementasi Algoritma Viginere Chiper Pada Sistem Informasi Absensi Karyawan PT Gunung Emas Tehnical', 'MITA YULANDA', '-', '-'),
(346, '-', 'Analisis Keamanan Informasi Pada Pengguna Instagram Dilingkungan Universitas Teknologi Sumbawa Menggunakan Metode Analisis Deskriptif', 'AFRIANTI', '-', '-'),
(347, '-', 'Analisis Kualitas Jaringan Hotspot Menggunakan Metode QOS', 'ADINDA PUTRI INTAN KOMALA', '-', '-'),
(348, '-', 'Sistem informasi kepegawaian pada SDIT Insan Qur\'ani sumbawa', 'NINDA', '-', '-'),
(349, '-', 'Sistem Informasi akademik menggunakan Metode Rapid Application Development Berbasis Web (Studi kasus: SDIT Insan Qur\'ani Sumbawa)', 'NURMALASARI', '-', '-'),
(350, '-', 'Pengembangan Aplikasi Galeri UMKM Britama Berbasis E- Commerce (Studi Kasus Batu Dulang)', 'WAHYU', '-', '-'),
(351, '-', 'Pengembangan Mesin Sangrai Kopi Semi Otomatis Dengan Kontrol Kecepatan Motor Menggunakan Arduino', 'HAUZAN RAMADHAN MUZAKI', '-', '-'),
(352, '-', 'SISTEM INFORMASI PENDATAAN PASIEN PADA PUSKESMAS ROPANG BERBASIS DESKTOP', 'RICI RIKARDO', '-', '-'),
(353, '-', 'Sistem Informasi Geografis Rekomendasi Wisata Alam Kabupaten Sumbawa Berbasis Web', 'PANJI YUSTITA', '-', '-'),
(354, '-', 'SISTEM INFORMASI KEPENDUDUKAN DESA BERBASIS WEB MENGGUNAKAN CODEIGNITER (STUDI KASUS: DESA BOAL KECAMATAN EMPANG KABUPATEN SUMBAWA)', 'SEPTI ADELIANA', '-', '-'),
(355, '-', 'IMPLEMENTASI SISTEM INFORMASI INVENTORY BERBASIS WEB PADA BENGKEL CD MOTOR', 'MUHAMMAD YURYAN', '-', '-'),
(356, '-', 'Sistem Informasi Stok Darah pada Unit Donor Darah (UDD) Kabupaten Sumbawa', 'ROBY JULIANSYAH', '-', '-'),
(357, '-', 'Sistem Informasi Pengolahan Data Pasien Pada Praktek Dr. Putu Eka Dan Dr. Timotius Munthe Provinsi Aceh', 'SA\'ADI POHAN', '-', '-'),
(358, '-', 'Aplikasi Delivery Food Pada Kedai Kebab Abbassy Street Food Berbasis Web', 'RO\'IF JAMAALUDIN PRAMUDIA', '-', '-'),
(359, '-', 'Membangun Aplikasi Aksara Ende Berbasis Android Menggunakan Metode Waterfall', 'MIMIN MINARNI', '-', '-'),
(360, '-', 'APLIKASI PENDATAAN PENDUDUK DI DESA JAMU KECAMATAN LUNYUK BERBASIS WEB', 'RINI SELFIANI', '-', '-'),
(361, '-', 'Aplikasi Penjadwalan Kuliah Program Studi Informatika Universitas Teknologi Sumbawa berbasis WEB', 'ABDULLAH ABBAS', '-', '-'),
(362, '-', 'OPTIMASI JARINGAN KOMPUTER MENGGUNAKAN METODE QUEUE TREE DAN PEER CONNECTION QUEUE (PCQ) PADA SMK NEGERI 1 SUMBAWA UNTUK PENUNJANG PEMBELAJARAN', 'ADE WAHYU', '-', '-'),
(363, '-', 'Sistem Informasi Pendaftaran Skripsi Berbasis Website Di Program Studi Informatika Universitas Teknologi Sumbawa', 'OLVIRA NANDA', '-', '-'),
(364, '-', 'Penjadwalan Seminar dan Sidang Tugas Akhir pada Sistem informasi pelayanan skripsi berbasis Web', 'NURUL AZMI', '-', '-'),
(365, '-', 'IMPLEMENTASI COMPLAINT MANAGEMENT SYSTEM BERBASIS WEB PADA PRODI INFORAMTIKA UTS', 'MUHAMMAD TASRIQ', '-', '-'),
(366, '-', 'Perancangan Sistem Informasi Electronic Customer Relationship Management (E-CRM) Berbasis Web Pada PT. Javarco Sumbawa.', 'LIYA MAHYUNI', '-', '-'),
(367, '-', 'Aplikasi Test Of English as a Foreign Language (TOEFL) Institusional Berbasis Web (Studi Kasus: UPT Pusat Bahasa Universitas Teknologi Sumbawa)', 'RIZKA IRJIBA', '-', '-'),
(368, '-', 'PERANCANGAN SISTEM INFORMASI PEMBAYARAN BIAYA PENYELENGGARAAN PENDIDIKAN BERBASIS WEB MENGGUNAKAN SMS GATEWAY', 'RADIAN SYAPUTRA', '-', '-'),
(369, '-', 'Sistem Informasi Rekam Medis Puskesmas Berbasis Web (Studi Kasus : Puskesmas Lopok)', 'EKA JULIANI', '-', '-'),
(370, '-', 'Perancangan sistem informasi audit mutu internal Universitas Teknologi Sumbawa menggunakan metode waterfall', 'ZIDAN', '-', '-'),
(371, '-', 'Sistem informasi point of sale berbasis web pada toko jass collection', 'DANI PRATAMA', '-', '-'),
(372, '-', 'Sistem Informasi Penjualan Obat Berbasis Web pada Apotek Family Kecamatan Lunyuk', 'DEDY KURNIAWAN', '-', '-'),
(373, '-', 'Pengambangan Aplikasi Perpustakaan Berbasis SMS Gateway Studi Kasus SMK Negeri 1 Taliwang Menggunakan Metode Waterfall', 'AQSAL ILHAMI', '-', '-');
INSERT INTO `daftar_judul` (`id`, `nim`, `judul_skripsi`, `nama`, `abstrak`, `tahun_lulus`) VALUES
(374, '-', 'Integrasi Face Recognition Dan Geo Tagging Pada Aplikasi Absensi Guru (Studi Kasus : SMK Negeri 1 Lenangguar)', 'AHMAD SYAKBAN', '-', '-'),
(375, '-', 'Pengembangan Sistem Informasi Inventaris Barang Berbasis (Studi kasus SMK Negeri 1 Lenangguar)', 'ARIS SOFIAN', '-', '-'),
(376, '-', 'Sistem Informasi Penjualan Barang Berbasis Web Pada Yumna Official Menggunakan Algoritma FP-Growth', 'EGA ZATRIANTI', '-', '-'),
(377, '-', 'SISTEM INFORMASI ENTERPRISE RESOURCE PLANNING BERBASIS WEB PADA PT. JAVARCO SUMBAWA', 'FAIQOH AULIA IZMI', '-', '-'),
(378, '-', 'Sistem Informasi Pembayaran SPP Utrujah Internatonal Islamic College Menggunakan Metode Waterfall Berbasis Web', 'NAMIRA RA\'UFA DAYYANA', '-', '-'),
(379, '-', 'RANCANG BANGUN INTERKONEKSI JARINGAN KOMPUTER DENGAN MENGGUNAKAN VPN DAN TUNNELING (Studi Kasus: Universitas Teknologi Sumbawa)', 'ADI MULIYANA', '-', '-'),
(380, '-', 'PEMBUATAN SISTEM INFORMASI PELAYANAN PADA PALANG MERAH INDONESIA (PMI) KABUPATEN SUMBAWA BERBASIS WEBSITE', 'RIAN AFRIYANSYAH', '-', '-'),
(381, '-', 'Analisis performa dan desain jaringan menggunakan pendekatan top-down network design studi kasus pada SMP Negeri 1 Lape', 'ARIN KOMALASARI', '-', '-'),
(382, '-', 'APLIKASI PENDAFTARAN EKSTRAKURIKULER BERBASIS WEB DENGAN METODE WATERFALL (STUDI KASUS SMAN 1 MOYO UTARA)', 'MUHAMMAD ILYAS', '-', '-'),
(383, '-', 'SISTEM PAKAR MENDIAGNOSA KERUSAKAN JARINGAN KOMPUTER MENGGUNAKAN METODE CERTAINTY FACTOR BERBASIS WEB', 'ERIKA GAMA PUTRI', '-', '-'),
(384, '-', 'RANCANG BANGUN VIRTUAL TOUR DENGAN METODE GAMBAR PANORAMA 360 DI UNIVERSITAS TEKNOLOGI SUMBAWA', 'TRISNO ADITIA', '-', '-'),
(385, '-', 'Implementasi Data Mining untuk Prediksi Penjualan Kayu Terlaris Menggunakan Metode K-Nearest Neighbor', 'LIS PRAYANTO PUTRA', '-', '-'),
(386, '-', 'Permodelan aplikasi aksara Lampung untuk anak sekolah dasar berbasis multimedia', 'MUHAMMAD IRFAN MUBAROK', '-', '-'),
(387, '-', 'Analisis dan Perancangan Prototype Smart Home Berbasis IoT Dengan NodeMCU Versi 3', 'BAHARUDDIN MUDA', '-', '-'),
(388, '-', 'Aplikasi Toefl Institusional Berbasis Web', 'RIZKA IRJIBA', '-', '-'),
(389, '-', 'Pengembangan Sistem Informasi Kepegawaian Pada Sdit Insan Qur’Ani Sumbawa Berbasis Website', 'RAHMAT HIDAYAT', '-', '-'),
(390, '-', 'Sistem Informasi Sebagai Upaya Peningkatan Layanan di Kantor Desa Berang Rea Berbasis Web', 'ARYA AGUS BUDIMAN', '-', '-'),
(391, '-', 'Perancangan Sistem Keamanan Jaringan dengan Metode Access Control List (ACL)', 'NILA TRISNA UTAMI', '-', '-'),
(392, '-', 'ANALISIS KELAYAKAN JARINGAN KOMPUTER MENGGUNAKAN ALAT SNIFFING DAN IDS (STUDI KASUS: FITRIA_HOSTPOT)', 'NURMI SANTI', '-', '-'),
(393, '-', 'MOBILE APLIKASI MANAJEMEN KEUANGAN CV.TOP DIGITAL PRINTING', 'SYAHRUL RAMADHAN', '-', '-'),
(394, '-', 'PENERAPAN ALGORITMA GENETIKA UNTUK PENJADWALAN OTOMATIS SIDANG SKRIPSI PADA SISTEM INFORMASI PELAYANAN SKRIPSI INFORMATIKA UNIVERSITAS TEKNOLOGI SUMBAWA', 'WIKI NASMANSYAH', '-', '-'),
(395, '-', 'Sistem Informasi Pariwisata Berbasis website Pada CV. Kacaru Trip Di Kabupaten Bima Menggunakan Metode Agile', 'WAHYU EKA TAPARANA', '-', '-'),
(396, '-', 'IMPLEMENTASI ALGORITMA GENETIKA PADA MEDIA PEMBELAJARAN BERBASIS WEB SEBAGAI METODE OPTIMASI PENJADAWALAN KELAS', 'YUDIANTO', '-', '-'),
(397, '-', 'Implementasi Metode Forward Chaining Untuk Mendiagnosis Penyakit Mata Berbasis WEB', 'ANGGIA PURBADHANTI', '-', '-'),
(398, '-', 'Analisis Perbandingan Performa Internet Hotspot Dan VLAN Menggunakan Quality of Service', 'KINTA DEWANY AZIZAH', '-', '-'),
(399, '-', 'ANALISIS KEAMANAN JARINGAN KOMPUTER MENGGUNAKAN METODE INTRUSION DETECTION SYSTEM(IDS) DAN FIREWALL', 'MUHAMMAD ILHAM AKBAR', '-', '-'),
(400, '-', 'Sistem Informasi Stok Darah pada Unit Donor Darah (UDD) Kabupaten Sumbawa Berbasis Android', 'ROBY JULIANSYAH', '-', '-'),
(401, '-', 'Penerapan K-Means Clustering Prestasi Akademik Siswa Berdasarkan Nilai Pengetahuan dan Keterampilan (Studi Kasus: MTs Negeri 1 Lampung Barat)', 'MUHAMMAD AZZAM ALFAUZIE', '-', '-'),
(402, '-', 'PENERAPAN ALGORITMA DECISION TREE C4.5 UNTUK PENENTUAN STATUS GIZI PADA BALITA (STUDI KASUS PADA POSYANDU DESA RHEE LOKA-SUMBAWA)', 'NIKEN SETIAWATI', '-', '-'),
(403, '-', 'Implementasi PSAK No.14 Pada Aplikasi Inventory Skuy Store Berbasis Web', 'MARSA PRAYUDA', '-', '-'),
(404, '-', 'Implementasi Framework Codeigniter pada Aplikasi Pembayaran Iuran SMK Negeri 1 Lenangguar', 'DODY PRANATA', '-', '-'),
(405, '-', 'Analisis Prediksi Penentuan Kelulusan Mahasiswa Dengan Data Mining (Studi Kasus : Fakultas Rekayasa Sistem)', 'SOFIA ARDINA', '-', '-'),
(406, '-', 'Penerapan Algoritma K-Means Clustering Untuk Data Obat Pada UPT. Puskesmas Unter Iwes Sumbawa', 'TIS ASY ARIA', '-', '-'),
(407, '-', 'Perancangan Sistem Informasi Manajemen Posyandu (SIMPADU) Untuk Meningkatkan Kualitas Layanan Posyandu', 'DUWI KARTINIAPRILIA', '-', '-'),
(408, '-', 'Penerapan Rapid Aplication Development Pada Aplikasi Akademik Berbasis Web SMP Negeri 3 Moyo Hulu', 'VINNA JARDYAGUSTIN', '-', '-'),
(409, '-', 'PENGEMBANGAN SISTEM INFORMASI MANAJEMEN MASJID BERBASIS ANDROID (STUDI KASUS: MASJID NURUL HUDA DESA STOWE BRANG KECAMATAN UTAN)', 'LISKA DELLA ERLANDA', '-', '-'),
(410, '-', 'MOBILE E-COMMERCE UMKM SUMBAWA', 'MUHAMMAD FAUZI', '-', '-'),
(411, '-', 'APLIKASI PEMBELAJARAN TATA CARA BERWUDHU DAN ILMU HUKUM TAJWID BERBASIS ANDROID PADA TPQ AL-IKHSAN DUSUN BOAK DALAM', 'GHIFRON AKHIRU SYAHRONI', '-', '-'),
(412, '-', 'Analisis Metriks Evaluasi RMSE Algoritma Forecasting Untuk Memprediksi Harga Saham', 'MALIK BAYU AJI', '-', '-'),
(413, '-', 'APLIKASI PENERIMAAN MAHASISWA BARU MENGGUNAKAN METODE PROTOTYPE PADA SEKOLAH TINGGI AGAMA ISLAM SUMBAWA (STAIS)', 'NOVIA RISKA AULIA', '-', '-'),
(414, '-', 'RANCANG BANGUN SISTEM INFORMASI INVENTORY MENGGUNAKAN METODE AGILE SOFTWARE DEVELOPMENT (STUDI KASUS TOKO NADA)', 'ARIF SUTRIANTO', '-', '-'),
(415, '-', 'Sistem Pendukung Keputusan Pemberian Bantuan Langsung Tunai Dana Desa Menggunakan Metode Analitycal Hierarchy Process (AHP)', 'ASRI RAMDANI', '-', '-'),
(416, '-', 'Aplikasi Surat Menyurat Berbasis Android (Studi Kasus : Kantor Desa Berang Rea Kecamatan Moyo Hulu)', 'FETI ALSEPIANINGSIH', '-', '-'),
(417, '-', 'Pengembangan Sistem Informasi Kredit Sahabat Pada Badan Usaha Milik Desa (BUMDes) Moyo Berbasis Android.', 'KHOFIFAH DELIA', '-', '-'),
(418, '-', 'Pengembangan Media Informasi SMK Negeri 1 Plampang Berbasis Android', 'WIDIYA LIS SUSANA', '-', '-'),
(419, '-', 'Otomatisasi Administrasi Kependudukan Berbasis Web', 'WAWA MARISA', '-', '-'),
(420, '-', 'Aplikasi Pengenalan Jaringan Dasar Komputer Kelas X TKJ Berbasis Web Menggunakan Metode Prototype', 'LUSI ANASTASIA', '-', '-'),
(421, '-', 'Sistem Informasi Terintegrasi Pada Pelayanan Pasien Rawat Jalan Puskesmas Pembantu Desa Suka Mulya Labangka-Sumbawa', 'ERMA SURYANI', '-', '-'),
(422, '-', 'Sistem pendukung keputusan pemilihan skincare berdasarkan jenis kulit wajah menggunakan metode simple additive weighting', 'MERI ANJARSARI', '-', '-'),
(423, '-', 'Implementasi Sistem Pakar Mendiagnosis Kerusakan Laptop Asus Menggunakan Metode Naive Bayes Pada Himpunan Mahasiswa Informatika', 'AGUS SIRHANDANI', '-', '-'),
(424, '-', 'IMPELEMENTASI SISTEM PAKAR BERBASIS WEB UNTUK MENDIAGNOSIS PENYAKIT AYAM BROILER MENGGUNAKAN METODE FORWARD CHAINING', 'MUHAMMAD FIRMANSYAH', '-', '-'),
(425, '-', 'Rancang Bangun Aplikasi Sistem Pengolahan Data Dan Penyewaan Lapangan Bulutangkis Pada Gedung Tiu Sedam Berbasis Web dan Android', 'MAULANA HELMI AKBAR', '-', '-'),
(426, '-', 'Analisis Keamanan Jaringan Wireless Menggunakan metode Security Policy Development Life Cycle', 'IRA AISYAH', '-', '-'),
(427, '-', 'Sistem Pendukung Keputusan Penilaian Prestasi Kerja Guru SMAN 1 Lape Menggunakan Metode Analytical Hierarchy Process', 'ABI AULIA', '-', '-'),
(428, '-', 'Analisis Perbandingan Cloud server menggunakan centos 7 dan ubuntu server 22.04 menggunakan Quality Of Service (QoS)', 'ZAINUR MINULLAH PUTRA', '-', '-'),
(429, '-', 'Sistem Pendukung Keputusan Penentuan Dosen Matakuliah Menggunakan Metode Simple Additive Weighting (SAW)', 'MAKDUM IBRAHIM', '-', '-'),
(430, '-', 'APLIKASI PEMBAYARAN BIAYA PENYELENGGARA PENDIDIKAN BERBASIS MOBILE ANDROID PADA SMA NEGERI 1 ALAS', 'WULAN PURNAMA PUTRI', '-', '-'),
(431, '-', 'Sistem Pendukung Keputusan Penentuan Jurusan Calon Siswa SMKN 1 Buer Berbasis Web Menggunakan Metode Simple Additive Weighting (SAW)', 'REYNALDO ROMERO', '-', '-'),
(432, '-', 'ANALISIS DAN OPTIMALISASI JARINGAN KOMPUTER MENGGUNAKAN METODE PER CONNECTION QUEUE (PCQ) (Studi Kasus : SMA Negeri 1 Sumbawa Besar)', 'MUHAMMAD RIFKAH', '-', '-'),
(433, '-', 'ANALISIS KUALITAS JARINGAN KOMPUTER PADA DISKOMINFOTIK KABUPATEN SUMBAWA BESAR MENGGUNAKAN METODE QUALITY OF SERVICE PADA DISKOMINFOTIK KABUPATEN SUMBAWA BESAR MENGGUNAKAN METODE QUALITY OF SERVICE', 'MUHAMMAD RIFKAH', '-', '-'),
(434, '-', 'SISTEM PENDUKUNG KEPUTUSAN PENENTUAN SISWA BERPRESTASI PADA SMP NEGERI 3 PLAMPANG DENGAN METODE SIMPLE ADDITIVE WEIGHTING (SAW) BERBASIS WEB', 'DAHALIA SUSANTI', '-', '-'),
(435, '-', 'Rancang bangun aplikasi pendataan pelanggan PT.jaringan Nusantara Samota', 'BAYU FAJRIN', '-', '-'),
(436, '-', 'Pengembangan Aplikasi RAPBS Pengelolaan Dana Bantuan Operasional Sekolah (BOS) Berbasis Web Menggunakan Metode Waterfall', 'LESI LELA SARI', '-', '-'),
(437, '-', 'Monitoring dan Evaluasi Surat Menyurat di Sekretariat Dinas Pendidikan dan Kebudayaan Berbasis Web (Studi Kasus : Kantor Cabang Dinas Dikbud Sumbawa Barat)', 'DIANA PUTRI', '-', '-'),
(438, '-', 'Aplikasi Transaksi Penjualan Berbasis Web Pada Rombong Aksesoris Sumbawa', 'ANDI MARTASYA', '-', '-'),
(439, '-', 'Penerapan Teknologi load balancing pada router mikrotik untuk meningkatkan kinerja jaringan ( study kasus SMAN 3 Sumbawa Besar)', 'YANDIEGA PRAGASTA', '-', '-'),
(440, '-', 'RANCANG BANGUN APLIKASI PENGENALAN ALAT MUSIK TRADISIONAL SUKU SUMBAWA DENGAN TEKNOLOGI AUGMENTED REALITY BERBASIS ANDROID', 'ISMAIL', '-', '-'),
(441, '-', 'Analisis Kinerja Jaringan Komputer Pada SMKN 1 Sumbawa Besar Dengan Menggunakan Metode Network Performance Analysis (NPA)', 'RIKA SAFIRA', '-', '-'),
(442, '-', 'Sistem Informasi Pelayanan Publik Desa Satu Pintu Berbasis Web Kecamatan Orong Telu', 'LINDA MUTIARA', '-', '-'),
(443, '-', 'Implementasi progressive web app (PAW) Pada Aplikasi Manajemen Data Dropship Berbasis Website', 'IHRATUN', '-', '-'),
(444, '-', 'Aplikasi Pemesanan Dan Penjualan Gas Elpiji Untuk Meningkatkan Kualitas Layanan Kepada Pelanggan Berbasis Web (Menggunakan Metode Extreme Programming)', 'CAHYOMULYO ANUGRAH', '-', '-'),
(445, '-', 'RANCANG BANGUN APLIKASI SISTEM PAKAR MENGGUNAKAN METODE FORWARD CHAINING UNTUK DIAGNOSA PENYAKIT HEWAN TERNAK SAPI', 'M. RAY CHOAN', '-', '-'),
(446, '-', 'Rancang Bangun Sistem Informasi Penjualan Obat Pada Apotek Ranggasolo Farma berbasis website', 'TRI UTAMI', '-', '-'),
(447, '-', 'Pengembangan Kanal Berita Semaras Sia Berbasis Web Menggunakan Metode Rapid Application Development', 'EDI CAHYADI', '-', '-'),
(448, '-', 'RANCANG BANGUN SISTEM INFORMASI PESERTA LITERASI DIGITAL MENGGUNAKAN METODE WATERFALL (STUDI KASUS RELAWAN TIK KABUPATEN SUMBAWA)', 'M. BAYU RIZKY', '-', '-'),
(449, '-', 'Sistem Informasi Sebagai Upaya Peningkatan Layanan Di Kantor Desa Ropang Berbasis Web', 'ADRIAN JULIAN PRATAMA', '-', '-'),
(450, '-', 'Analisis Perancangan Sistem Informasi Layanan Pengaduan Masyarakat Desa Berbasis Web Dengan Pendekatan Uml (Studi Kasus : Kelurahan Uma Sima, Kecamatan Sumbawa)', 'HAFIDHUDDIN YUS', '-', '-'),
(451, '-', 'Analisis Perilaku Konsumen Pada Data Penjualan Bahan Bangunan Menggunakan Algoritma FP-Growth (Studi Kasus: UD. Alam Raya)', 'KHAIRUNNISA SALSABILLAH PUTRI', '-', '-'),
(452, '-', 'Penerapan Algoritma Winnowing Untuk Mendeteksi Kemiripan Judul Skripsi Pada Program Studi Informatika Universitas Teknologi Sumbawa', 'SHEVA RICKO APRIANSYAH', '-', '-'),
(453, '-', 'Analisis keamanan website Sistem informasi administrasi kependudukan di kantor Dukcapil Sumbawa menggunakan metode vulnerability asessment.', 'TARA RIZKAYANTI', '-', '-'),
(454, '-', 'Aplikasi Layanan Penganduan Siswa SMA/SMK Di Kabupaten Sumbawa Berbasis Android (Studi Kasus Kantor Cabang Dinas Pendidikan Dan Kebudayaan Kabupaten Sumbawa Nusa Tenggara Barat)', 'TRI RESKI', '-', '-'),
(455, '-', 'Sistem Informasi Pengajuan Layanan Administrasi Dari Desa Dan Kelurahan Ke Dinas Kependudukan Dan Pencatatan Sipil Berbasis Web', 'WARDA WULANDARI', '-', '-'),
(456, '-', 'Penerapan Algoritma C4.5 Untuk Analisis Tingkat Kepuasan Pelanggan Pada Qyan Tailor', 'ISMED QALYUBI', '-', '-'),
(457, '-', 'PENERAPAN METODE WEIGHTED AGGREGATED SUM PRODUCT ASSESSMENT (WASPAS) DALAM MENENTUKAN LEVEL BELAJAR BAHASA INGGRIS PADA VANKA SPEAKING COURSE SUMBAWA', 'VIRNA FEBRI ANDINI', '-', '-'),
(458, '-', 'SISTEM DATA TERDISTRIBUSI UNTUK PENGELOLAAN DATA DONOR DARAH PADA UTD PMI KABUPATEN SUMBAWA MENGGUNAKAN METODE REPLICATION', 'ARMELIA PUTRIANJANI', '-', '-'),
(459, '-', 'Penerapan Metode Depth First Search (DFS) Untuk Sistem Pakar Diagnosis Kerusakan Handphone Berbasis Android', 'ASTI OKTAVIANI', '-', '-'),
(460, '-', 'Implementasi Data Mining Untuk Memprediksi Kecocokan Gaya Belajar Bagi Siswa Siswi Sekolah Dasar Menggunakan Algoritma C4.5', 'NURMALA', '-', '-'),
(461, '-', 'Klasifikasi Data Mining Untuk Penentuan Stunting Pada Balita Menggunakan Metode Naive Bayes (Studi Kasus : Puskesmas Kecamatan Poto Tano)', 'AMBAR WATI', '-', '-'),
(462, '-', 'Perancangan Prototipe Smart Door Lock Berbasis Internet of Things', 'ANGGA DWI WIBOWO', '-', '-'),
(463, '-', 'Clustering Petani Penerima Pupuk Berdasarkan Luas Lahan Dengan Menggunakan Algoritma K-Means Dan K-Medoids (Studi Kasus : Kecamatan Moyo Hulu)', 'NOVITASARI', '-', '-'),
(464, '-', 'ANALISIS PREDIKSI PENYEBARAN PENYAKIT TUBERKULOSIS (TBC) MENGGUNAKAN ALGORITMA K-MEANS DENGAN MODEL CRISP-DM STUDI KASUS KABUPATEN SUMBAWA', 'WULANDARI', '-', '-'),
(465, '-', 'PENGEMBANGAN SISTEM INFORMASI MANAJEMEN INVENTARIS SARANA DAN PRASARANA DI UNIVERSITAS TEKNOLOGI SUMBAWA', 'VENI SEPTIANI', '-', '-'),
(466, '-', 'Rancang Bangun Absensi Siswa Menggunakan Metode Waterfall dengan QR Code pada Sekolah SD negeri 2 Langam', 'ARMANITA ANING', '-', '-'),
(467, '-', 'Perancangan Aplikasi Pelaporan Keuangan Terintegrasi Untuk Meningkatkan Fleksibilitas Keuangan Dojang Taekwondo Kabupaten Sumbawa', 'HADIJATOL KADRI', '-', '-'),
(468, '-', 'Rancang Bangun Absensi Siswa Menggunakan Metode Waterfall Dengan QR Code Pada Sekolah Dasar Negeri 2 Langam', 'ARMANITA ANING', '-', '-'),
(469, '-', 'Perancangan Aplikasi Buku Kesehatan Ibu Dan Anak Berbasis Android', 'NURUL MUFLIHA PUASA', '-', '-'),
(470, '-', 'Pengembangan aplikasi manajemen laundry berbasis webview pada platform android', 'ULFA NOVIANDA', '-', '-'),
(471, '-', 'PENGEMBANGAN SISTEM INFORMASI POSYANDU BERBASIS MOBILE MENGGUNAKAN METODE FOUNTAIN (STUDI KASUS : POSYANDU TUNAS MEKAR KELURAHAN LEMPEH)', 'GUSLINA TRI SANTIKA', '-', '-'),
(472, '-', 'APLIKASI PEMBAYARAN BIAYA PENYELENGGARAAN PENDIDIKAN (BPP) SECARA QRIS BERBASIS WEB DAN MOBILE MENGGUNAKAN METODE EXTREME PROGRAMMING (STUDI KASUS : SMA NEGERI 2 SUMBAWA BESAR)', 'FATHIYA ROHALI', '-', '-'),
(473, '-', 'Rancang Bangun Sistem Informasi Manajemen Organisasi We SAVE Indonesia Terintegrasi Berbasis Web', 'SAMSURYA', '-', '-'),
(474, '-', 'Analisis Keamanan Jaringan Wireless Local Area Network Menggunakan Metode Penetration Testing', 'MUHAMMAD FAIZAL', '-', '-'),
(475, '-', 'Rancang Bangun Aplikasi Pencatatan Poin Pelanggaran Siswa Menggunakan Metode Waterfall Berbasis Web Pada MA Al-Khairiyah Tegalbuntu', 'ALFIN BAROKAH', '-', '-'),
(476, '-', 'PENERAPAN HIERARCHIAL TOKEN BUCKET (HTB) DALAM MANAJEMEN BANDWIDTH UNTUK MENINGKATKAN QUALITY OF SERVICE (QOS) PADA SMKN 1 ALAS', 'MUHAMMAD BAGUS', '-', '-'),
(477, '-', 'Penerapan Docker Platform Untuk Integrasi Sistem Informasi Skripsi dan Sistem Informasi Pengecekan Judul Skripsi Berbasis Web Pada Program Studi Informatika', 'RIZKY ADI RYANTO', '-', '-'),
(478, '-', 'Aplikasi Pelayanan Pengaduan Masyarakat Berbasis Android Di Kelurahan Uma Sima, Kabupaten Sumbawa', 'FAEZAL REZHA MARZUKI', '-', '-'),
(479, '-', 'Implementasi WebView Sistem Informasi Manajemen Perpustakaan STKIP Paracendekia NW Sumbawa Berbasis Website', 'YAHYA AYASY ABDURRAHMAN', '-', '-'),
(480, '-', 'Implementasi Metode Certainty Factor (CF) untuk Diagnosa Penyakit Cacing pada Ternak Sapi', 'FAJRI ALFARIZI', '-', '-'),
(481, '-', 'Sistem Informasi Presensi Berbasis Web Studi Kasus STKIP Paracendekia NW Sumbawa', 'M. RIZAL MADANI', '-', '-'),
(482, '-', 'Rancang Bangun Aplikasi Cerita Rakyat Sumbawa Berbasis Android', 'WAHYUDI', '-', '-'),
(483, '-', 'Aplikasi Guest Book Berbasis Web Pada Lokasi Cagar Budaya Kabupaten Sumbawa', 'LA HARIS', '-', '-'),
(484, '-', 'Pengembangan Aplikasi Sastra Lisan Lawas Khas Sumbawa Berbasis Android', 'ZADDWI JIWA ILMIAH', '-', '-'),
(485, '-', 'PENGEMBANGAN APLIKASI PENGENALAN ALAT MUSIK TRADISIONAL SUMBAWA UNTUK MELESTARIKAN KEBUDAYAAN', 'ADE LILIS APRIANTI', '-', '-'),
(486, '-', 'IMPLEMENTASI SISTEM MONITORING BERBASIS INTERNET OF THINGS (IOT) PADA RUMAH BUDIDAYA JAMUR TIRAM', 'SULASTRI', '-', '-'),
(487, '-', 'Pengembangan Sistem Informasi Pengolahan Data Lapangan GOR Mampis Rungan Berbasis Android Menggunakan Metode Extreme Programming', 'ANDHIKA SEPTIAN PRATAMA', '-', '-'),
(488, '-', 'SISTEM INFORMASI ADMINISTRASI UNIT KEGIATAN MAHASISWA (UKM) RACANA OLAT MARAS – AI RENUNG UNIVERSITAS TEKNOLOGI SUMBAWA BERBASIS WEBSITE', 'JIZAN QIFLI ILHAMDI', '-', '-'),
(489, '-', 'Implementasi Realtime Database Pada Sistem Smart Home Jamur Tiram Untuk Rekapitulasi Data Suhu Dan Kelembaban', 'ANDINI WULANDARI', '-', '-'),
(490, '-', 'Rekayasa Sistem Informasi Pendaftaran Siswa Baru SD Negeri 1 Gapit Berbasis Website', 'INTAN MEI GUTARI', '-', '-'),
(491, '-', 'INFOMATRIX UNIVERSITAS TEKNOLOGI SUMBAWA: MENINGKATKAN KETERLIBATAN UNIVERSITAS MELALUI SISTEM CHATBOT CERDAS', 'DAVID TAMBA NDOMAINA', '-', '-'),
(492, '-', 'Rancang Bangun Media Pembelajaran Menari Sebagai Sarana Penunjang Proses Pembelajaran Pada Program Studi Seni Tari Universitas Teknologi Sumbawa', 'MUHAMMAD RIFKI. R', '-', '-'),
(493, '-', 'Rancang Bangun Aplikasi Administrasi Peminjaman dan Pengembalian Mobil Pada Friyan X Octavian (FXO) Rental Cibubur Jakarta Timur', 'NAWWAF FAISAL', '-', '-'),
(494, '-', 'APLIKASI SISTEM INFORMASI MANAJEMEN MONITORING LAPORAN KOPI BAPER POINT COFFEE BERBASIS WEB(Studi kasus : point coffee indomaret garuda 19)', 'NOVA APRILLIA PANGESTI', '-', '-'),
(495, '-', 'PENERAPAN ALGORITMA NAIVE BAYES DALAM MEMPREDIKSI LULUS TEPAT WAKTU MAHASISWA PADA PROGRAM STUDI INFORMATIKA, UNIVERSITAS TEKNOLOGI SUMBAWA', 'MAR\'I YUSTIARDIN', '-', '-'),
(496, '-', 'ANALISIS KEAMANAN JARINGAN DALAM SMARTHOME INTERNET OF THINGS MENGGUNAKAN METODE SPDLC (SECURITY POLICY DEVELOPMENT LIFE CICLE)', 'DIMAS ARYA MUKHTI', '-', '-'),
(497, '-', 'Sistem Pendukung Keputusan Seleksi Pejabat Struktural Di Lingkungan Universitas Teknologi Sumbawa Berbasis Web Menggunakan Metode Simple Additive Weighting (SAW)', 'MUHAMMAD FIQAR RAMADHAN', '-', '-'),
(498, '-', 'PERANCANGAN APLIKASI E-RAPOR MATA PELAJARAN Al-QUR’AN PADA SEKOLAH MENENGAH PERTAMA ISLAM TERPADU SAMAWA CENDIKIA (SMP IT Samawa Cendekia) DENGAN METODE WATERFALL BERBASIS WEBVIEW PADA PLATFORM ANDROID', 'NATASYA AWRA FADILAH', '-', '-'),
(499, '-', 'Analisis Clustering Pendapatan Pajak dan Retribusi Daerah di Kabupaten Sumbawa dengan Model KDD menggunakan Algoritma K-Means', 'SAHARA HASIBUAN', '-', '-'),
(500, '-', 'Aplikasi Monitoring dan Evaluasi Taman Kanak-Kanak Binaan Dharma Wanita Persatuan Kabupaten Sumbawa Dengan Metode Agile', 'CECE LISTIANA UMBARA', '-', '-'),
(501, '-', 'PENGEMBANGAN APLIKASI PENGELOLAAN DATA SAMPAH KABUPATEN SUMBAWA BERBASIS ANDROID (STUDI KASUS: DINAS LINGKUNGAN HIDUP KABUPATEN SUMBAWA', 'MHD. ALWI SYAPUTRA PULUNGAN', '-', '-'),
(502, '-', 'Rancang Bangun Media Pembelajaran Pakaian Adat Sumbawa Berbasis Android', 'RIKI SUSAINANDA', '-', '-'),
(503, '-', 'Analisa Quality of Service (QoS) Jaringan Internet RT-RW Net Di Desa Pernek (Gina.Net)', 'MURNI ANITA WULANDARI', '-', '-'),
(504, '-', 'Aplikasi Game Edukasi Berbasis Problem Based Learning Pada SDN Kerato Unter Iwes', 'M. DIMAS SAKTI MAULANA', '-', '-'),
(505, '-', 'RANCANG BANGUN APLIKASI MOBILE PEMBELAJARAN AKSARA BIMA UNTUK MEMPERTAHANKAN KEBUDAYAAN MELALUI TEKNOLOGI', 'NUR ISLAMIA', '-', '-'),
(506, '-', 'METODE Certainty Factor pada sistem pakar penentuan status gizi balita usia 0 sampai 5 tahun', 'AZLAM WAHYUDIN', '-', '-'),
(507, '-', 'IMPLEMENTASI APLIKASI PENYALURAN PUPUK BERSUBSIDI PADAWILAYAH KECAMATAN UNTER IWES MENGGUNAKAN METODERAPID APPLICATION DEVELOPMENT (RAD) BERBASIS WEB', 'ARIF ANNURSIDA', '-', '-'),
(508, '-', 'Analisis Perbandingan Algoritma K-Means Dan K-Medoids Dengan Model CRISP-DM Untuk Clustering Penyebaran Penyakit Demam Berdarah Dengue (DBD)', 'ABIGAIL PERKASA', '-', '-'),
(509, '-', 'PENERAPAN ALGORITMA NAIVE BAYES DALAM MEMPREDIKSI TINGKAT MAHASISWA DROP OUT PADA PROGRAM STUDI INFORMATIKA UNIVERSITAS TEKNOLOGI SUMBAWA', 'BAYU SEPTIAN', '-', '-'),
(510, '-', 'Perancangan Alat Pakan Ikan Hias Otomatis Berbasis Internet of Things (IoT)', 'NIZAR MULYAWAN', '-', '-'),
(511, '-', 'Analisis Komparasi Algoritma C4.5, Naive Bayes dan K-Nearest Neighbor Untuk Memprediksi Ketepatan Waktu Lulus Mahasiswa', 'SHAKIRA AZ ZAHRA HADI PUTRI', '-', '-'),
(512, '-', 'IMPLEMENTASI METODE DESIGN THINKING DALAM PERANCANGAN PROTOTYPE UI/UX APLIKASI PENCARIAN RUMAH KONTRAKAN', 'QOLBI NURWANDI YUNUS', '-', '-'),
(513, '-', 'Sistem Pendukung Keputusan Kelayakan Siswa-siswi Calon Penerima Bantuan Program Indonesia Pintar pada SMPN 2 Sumbawa Besar Menggunakan Metode Simple Additive Weighting (SAW)', 'AZRUL ROCHMAD RIFAI', '-', '-'),
(514, '-', 'Rancang Bangun Aplikasi Pengelolaan Inventaris SMPN 3 Moyo Hulu Berbasis Website', 'ZAKIYAH', '-', '-'),
(515, '-', 'Rancang Bangun Aplikasi Simpanan Pelajar(SIMPEL) Berbasis Web Pada Koperasi Mutiara SDN Labuhan Lalar', 'NURUL HIDAYAT', '-', '-'),
(516, '-', 'Aplikasi Monitoring data Himpaudi Sebagai Upaya Peningkatan Kualitas Paud Di Kabupaten Sumbawa menggunakan metode WaterFall', 'ZAINUL HASAN', '-', '-'),
(517, '-', 'Rancang Bangun Sistem Informasi Layanan Konseling Berbasis Website Menggunakan Metode Fountain Pada Himpunan Mahasiswa Psikologi', 'JZIDAN MUHAMMAD RUSDWIAN NURFAUZAN', '-', '-'),
(518, '-', 'Sistem informasi pelayanan kesehatan hewan pada klinik dinas peternakan dan kesehatan hewan kabupaten sumbawa berbasis web', 'KHAULA SYAHIDAH', '-', '-'),
(519, '-', 'Penerapan Algoritma You Only Look Once (YOLO) Versi 8 Convolutional Neural Network (CNN) dan Image Processing pada Aplikasi Automatic Number Plate Recognition (ANPR)', 'M ALIF ALDIANSYAH', '-', '-'),
(520, '-', 'SISTEM PELAPORAN KEBAKARAN BERBASIS LOKASI DENGAN FITUR PENENTUAN RUTE TERCEPAT MENGGUNAKAN METODE BEST FIRST SEARCH UNTUK DINAS PEMADAM KEBAKARAN DAN KESELAMATAN KABUPATEN SUMBAWA', 'SATMIRAEN', '-', '-'),
(521, '-', 'PENERAPAN DATA MINING UNTUK MONITORING KINERJA PEGAWAI MENGGUNAKAN METODE K-MEANS', 'MAGFIRA MEILANI PUTRI', '-', '-'),
(522, '-', 'Perancangan Jaringan Virtual Private Network Berbasis Ip Security menggunakan Router Mikrotik', 'ADITYA FA\'ATHIR BARKHANI', '-', '-'),
(523, '-', 'Perancangan Platform Komunitas Belajar Online Sebagai Media Komunikasi dan Belajar Bersama', 'ABDULLAH AZZAM', '-', '-'),
(524, '-', 'penggunaan microservices untuk menyatukan aplikasi yang telah berjalan mandiri dengan metode single sign on', 'MOCHAMMAD IQBAL RAMADHAN', '-', '-'),
(525, '-', 'IMPLEMENTASI METODE USER CENTERED DESIGN (UCD) DALAM MEMBANGUN UI/UX MEDIA PEMBELAJARAN MATEMATIKA SISWA KELAS 7 SMP NEGERI 4 WOHA', 'TYREENIA', '-', '-'),
(526, '-', 'Implementasi Data Mining Untuk Menentukan Strategi Promosi Penerimaan Mahasiswa Baru Universitas Teknologi Sumbawa Menggunakan Algoritma K-Means', 'HIFZI RAHMATULLAH', '-', '-'),
(527, '-', 'PERANCANGAN SISTEM INFORMASI MANAJEMEN STOK BERBASIS HYBRID UNTUK MENGOPTIMALKAN EFISIENSI OPERASIONAL PADA PT NATURA COSMETIKA INTERNASIONAL', 'SALAHUDDIN DAFFA AZZAMI', '-', '-'),
(528, '-', 'sistem pendukung keputusan pemilihan nasabah penerima pinjaman kredit menggunakan metode simple additive weighthing (SAW) pada bumdes Ai Ramena desa Rhee Loka', 'ANANDA FAJRIANSYAH', '-', '-'),
(529, '-', 'Optimalisasi algoritma neural network untuk memprediksi harga saham menggunakan rapidminer', 'MUHAMMAD BAHARUN', '-', '-'),
(530, '-', 'Perancangan Desain Prototipe Aplikasi Panic Button Kabupaten Sumbawa Dengan Metode Human Centered Design', 'MUHAMMAD FADHLULLAH NADHIF', '-', '-'),
(531, '-', 'Analilisi Kualitas Layanan Jaringan Internet Berbasis Wireless Local Area Nerwork Pada Layanan Indihome di PT Telkom Area Kabupaten Sumbawa', 'EGIS ALFIAS', '-', '-'),
(532, '-', 'Implementasi Backward Chaining Untuk Mendiagnosis Penyakit Gigi Berbasis Web', 'RIMA FAHRANA', '-', '-'),
(533, '-', 'Sistem Pakar Diagnosa Penyakit Kulit Pada Kucing Berbasis Web Menggunakan Metode Forward Chaining', 'ERNA PUTRI ATI', '-', '-'),
(534, '-', 'IMPLEMENTASI SISTEM INFORMASI MANAJEMEN PERPUSTAKAAN STKIP PARACENDIKIA BERBASIS WEBSITE', 'YUDHA PUTRA PRATAMA', '-', '-'),
(535, '-', 'Perancangan sistem informasi jasa percetakan ms. Print berbasis website', 'DITA PUTRI APRILIA', '-', '-'),
(536, '-', 'Implementasi Algoritma Vieginere Chiper Pada Sistem Impormasi Absensi Karyawan Menggunakan Metode Agile (Studi Kasus: PT.Sinar Bali)', 'ERSYA DWI CAHYA', '-', '-'),
(537, '-', 'Rancang Bangun Sistem Absensi Siswa Berbasis Website', 'FITRI ADE KAYANTI', '-', '-'),
(538, '-', 'Rancang Bangun Aplikasi Bimbingan Akademik STKIP Paracendekia NW Berbasis Web', 'URWAH UTSMANI', '-', '-'),
(539, '-', 'Sistem Informasi Manajemen Ruangan Berbasis Mobile, Studi Kasus Universitas Teknologi Sumbawa', 'ILHAM AL HARIST', '-', '-');

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
(1, '0805018301', 1, 2, 'Yuliadi, M.Kom', '00852254168', 'dosen@gmail.com', '2', 'matematika', 'signature-eb2ffd6bd7.png', 'dosen_1.png', '12345678', 'percobaan', '$2y$10$ZU1wd2hK7HrsFJzTh2Mh2efpa3xuLD0/Lfo4SeoHI6eQCWikcLpuy', '2024-09-08 07:19:47', 1),
(2, '0806079202', 1, 2, 'M. Julkarnain, S.Si., M.Sc.', '085333411680', 'admin@admin.com', '1', 'rekayasa perangkat lunak', '', '', '1234566789', 'docker', '$2y$10$WaUtSht7khmSRnjntnWFvuW4rvtEwlDMnnL3UeFzJUnMYT..ptGTq', '2024-09-08 07:19:45', 1),
(4, '0814078603', 1, 2, 'Shinta Esabella, ST, M.TI', '08215674535786', 'shinta@gmail.com', '2', 'AI', 'signature-286f232244.png', 'dosen_4.png', '12345678910', 'linux', '$2y$10$ZU1wd2hK7HrsFJzTh2Mh2efpa3xuLD0/Lfo4SeoHI6eQCWikcLpuy', '2024-09-08 07:19:41', 1),
(7, '0804059203', 1, 3, 'Eri Sasmita Susanto, M.Kom', '0872928234', 'erisasmita@gmail.com', '2', 'machine learning', '', '', '234567890', 'sistem informasi', '$2y$10$ZU1wd2hK7HrsFJzTh2Mh2efpa3xuLD0/Lfo4SeoHI6eQCWikcLpuy', '2024-09-08 07:19:39', 1),
(8, '0810098001', 1, 2, 'Eka Haryanti, M.Pd.', '083652776522', 'eka@gmail.com', '2', 'RPL', 'signature-c1b80dc21a.png', 'dosen_8.png', '456789', 'tema riset 3', '$2y$10$ZU1wd2hK7HrsFJzTh2Mh2efpa3xuLD0/Lfo4SeoHI6eQCWikcLpuy', '2024-09-08 07:02:57', 0),
(9, '0813118701', 1, 2, 'Fahri Hamdani, M.Pd', '083876329987', 'fahri@gmail.com', '2', 'RPL', 'signature-06bb6f55f9.png', 'dosen_9.png', '3242342342', 'Jaringan', '$2y$10$ZU1wd2hK7HrsFJzTh2Mh2efpa3xuLD0/Lfo4SeoHI6eQCWikcLpuy', '2024-09-11 10:30:12', 1),
(11, '0823049301', 1, 2, 'Herfandi, M.Kom', '085333411680', 'herfandi@gmail.com', '2', 'AI', NULL, '', '234234', 'AI', '$2y$10$ZU1wd2hK7HrsFJzTh2Mh2efpa3xuLD0/Lfo4SeoHI6eQCWikcLpuy', '2024-09-07 15:54:19', 1),
(12, '0816069501', 1, 2, 'Nora Dery Sofya, S.Kom, M.M.Inov', '085333411680', 'nora@gmail.com', '2', 'AI', NULL, '', '2343242', 'AI', '$2y$10$ZU1wd2hK7HrsFJzTh2Mh2efpa3xuLD0/Lfo4SeoHI6eQCWikcLpuy', '2024-09-07 15:54:22', 1),
(13, '0829118502', 1, 2, 'Yudi Mulyanto, M.Kom', '085333411680', 'yudi@gmail.com', '2', 'Jaringan', NULL, '', '234234', 'AI', '$2y$10$ZU1wd2hK7HrsFJzTh2Mh2efpa3xuLD0/Lfo4SeoHI6eQCWikcLpuy', '2024-09-07 15:54:57', 1),
(14, '0808078101', 1, 3, 'Rodianto, M.Kom', '085333411680', 'rodianto@gmail.com', '2', 'Basis Data', NULL, '', '1234567', 'Basis Data', '$2y$10$ZU1wd2hK7HrsFJzTh2Mh2efpa3xuLD0/Lfo4SeoHI6eQCWikcLpuy', '2024-09-07 15:54:27', 1),
(15, '0805068304', 1, 3, 'Yunanri.W, ST, M.Kom', '4234234234234', 'yunanri@gmail.com', '2', 'Cyber', 'signature-75c0d9dd6e.png', 'dosen_15.png', '34234', 'Cyber', '$2y$10$ZU1wd2hK7HrsFJzTh2Mh2efpa3xuLD0/Lfo4SeoHI6eQCWikcLpuy', '2024-09-08 07:05:43', 1);

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
(1, 'sips@mancaksa.my.id', 'Rizky201121??', '465', 'mail.mancaksa.my.id');

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
(2, 'Fakultas  Rekayasa Sistem', 'Mitra');

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

--
-- Dumping data untuk tabel `hasil_seminar`
--

INSERT INTO `hasil_seminar` (`id`, `seminar_id`, `berita_acara`, `masukan`, `status`) VALUES
(1, 1, '', '', '1');

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
(3, 'lektor kepala 400', 'sudah memiliki no japung', '2024-08-17 19:06:53'),
(4, 'Asisten Ahli', 'Asisten Ahli', '2024-09-07 15:45:15'),
(5, 'Lektor', 'Lektor', '2024-09-07 15:45:25');

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

--
-- Dumping data untuk tabel `konsultasi`
--

INSERT INTO `konsultasi` (`id`, `proposal_mahasiswa_id`, `tanggal`, `jam`, `isi`, `bukti`, `sk_tim`, `persetujuan_pembimbing`, `persetujuan_kaprodi`, `komentar_pembimbing`, `komentar_kaprodi`, `created_at`, `id_periode`) VALUES
(1, 16, '2024-09-13', '12:29:00', 'revisi bab 1', '20240912062928_66e316e837b8e.pdf', NULL, '0', '0', 'Revisi lagi pada bagian bab 1 paragraf ke dua', NULL, '2024-09-12 16:30:48', 1);

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
(1, 2);

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
(18, '19010130444', 'Rizky Adi Ryanto', 2, 'laki-laki', 'Bima', '2000-08-14', 'adiryantorizky140820@gmail.com', 'Bima', '085333411680', 'Bima', '085333411680', '085333411680', '3.9', '20240821070225.png', '$2y$10$HHXSHx7KuT.icOFDWIuHtetU.XNVs7otYr4npMb3XiBYOZzCeBnua', '1', '2024-09-12 18:52:45', 1),
(19, '2001013044', 'Agung', 2, 'laki-laki', 'Bima', '2000-08-15', 'rizky14082000@gmail.com', 'Bima', '085333411680', 'Kebayan', '085333411680', '085333411680', '3.52', '20240828115913.png', '$2y$10$odd993yqQ7xS09dz6fT.bepjnDPu7w3ddKqFySAtHPUKRqoGi9Z5K', '1', '2024-08-28 09:59:59', 1),
(20, '2001013045', 'andini', 2, 'laki-laki', 'Sumbawa', '2024-03-06', 'andini@gmail.com', 'sumbawa', '085333411680', 'sumbawa', '085333411680', '085333411680', '3.52', '20240828091712.png', '$2y$10$7Feo69p23zYjU13JL5jSt.18FhGBG8VWiyy7ffhtw/XXI.p47Dz4O', '1', '2024-08-28 19:17:35', 1),
(21, '2001013055', 'Sulastri', 2, 'perempuan', 'Rhee', '2001-08-14', 'adiryantorizky140820@gmail.com', 'rhee', '085333411680', 'rhee', '085333411680', '085333411680', '3.89', '20240907093419.png', '$2y$10$.Rv2O78a1Rav67BPelO0XOlwuGt64PKePlLYB5KnPHyA6dZMCbx2e', '1', '2024-09-07 07:35:23', 1);

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

--
-- Dumping data untuk tabel `pengujian_sempro`
--

INSERT INTO `pengujian_sempro` (`id_pengujian`, `id_sempro`, `id_dosen`, `presentasi`, `alat_bantu`, `penampilan`, `penguasaan_materi`, `kelayakan_proposal`, `status`, `created_at`, `id_periode`) VALUES
(1, '1', '8', '80', '81', '88', '87', '86', '1', '2024-09-12 20:29:46', 1),
(2, '1', '4', '88', '87', '86', '89', '87', '1', '2024-09-12 20:30:09', 1),
(12, '1', '9', '80', '87', '86', '87', '85', '1', '2024-09-12 20:58:35', 1);

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
  `jumlah` double NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id_periode` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pengujian_skripsi`
--

INSERT INTO `pengujian_skripsi` (`id_pengujian_skripsi`, `id_skripsi`, `id_dosen`, `pokok_permasalahan`, `kerangka_pemikiran`, `metode_penelitian`, `hasil_penelitian`, `bahasa`, `manfaat_akademis_praktis`, `teknik_penulisan`, `penguasaan_materi`, `penguasaan_metode`, `kemampuan_argumentasi`, `nilai_rata_rata`, `jumlah`, `status`, `created_at`, `id_periode`) VALUES
(1, 1, 4, '88', '87', '86', '89', '82', '89', '85', '88', '86', '87', 87.13, 867, 1, '2024-09-14 06:57:57', 1),
(2, 1, 9, '88', '87', '85', '89', '85', '87', '86', '89', '82', '82', 86.27, 860, 1, '2024-09-14 06:58:44', 1),
(5, 1, 8, '80', '87', '86', '85', '83', '87', '88', ' ', ' ', ' ', 85.5, 596, 1, '2024-09-14 07:04:16', 1);

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
-- Struktur dari tabel `predikat_penilaian`
--

DROP TABLE IF EXISTS `predikat_penilaian`;
CREATE TABLE `predikat_penilaian` (
  `id` int(11) NOT NULL,
  `nilai_minimum` int(11) NOT NULL,
  `nilai_maximum` int(11) NOT NULL,
  `nama_predikat` varchar(50) NOT NULL,
  `keterangan` text NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `predikat_penilaian`
--

INSERT INTO `predikat_penilaian` (`id`, `nilai_minimum`, `nilai_maximum`, `nama_predikat`, `keterangan`, `created`) VALUES
(4, 86, 100, 'A', 'Mendapatkan Nilai A', '2024-09-08 11:25:41'),
(5, 81, 86, 'A-', 'nilai untuk nama predikat A-', '2024-09-09 02:46:18'),
(6, 76, 81, 'B+', 'Nilai predikat B+', '2024-09-09 02:47:01'),
(7, 71, 76, 'B', 'Nilai Predikat B', '2024-09-09 02:47:31'),
(8, 66, 71, 'B-', 'Nilai predikat B-', '2024-09-09 02:47:53'),
(9, 61, 66, 'C+', 'Nilai Predikat C+', '2024-09-09 02:48:39'),
(10, 56, 61, 'C', 'Nilai Predikat C', '2024-09-09 02:49:07'),
(11, 41, 56, 'D', 'Nilai Predikat D', '2024-09-09 02:49:28');

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
(2, '20201017', 'Informatika', 14, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `proposal_mahasiswa`
--

DROP TABLE IF EXISTS `proposal_mahasiswa`;
CREATE TABLE `proposal_mahasiswa` (
  `id` bigint(20) NOT NULL,
  `mahasiswa_id` bigint(20) NOT NULL,
  `judul` text NOT NULL,
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

--
-- Dumping data untuk tabel `proposal_mahasiswa`
--

INSERT INTO `proposal_mahasiswa` (`id`, `mahasiswa_id`, `judul`, `dosen_id`, `dosen2_id`, `transkip`, `krs`, `outline`, `lulus_metopen`, `lulus_mkwajib`, `dosen_penguji_id`, `dosen_penguji_id2`, `status`, `deadline`, `created_at`, `id_periode`) VALUES
(17, 18, 'implementasi docker untuk integrasi sistem informasi skripsi dan pengecekan judul skripsi pada program studi Informatika', 8, NULL, '20240912092456_66e340082d5e5.pdf', '20240912092456_66e340082ca42.pdf', '20240912092456_66e340082da02.pdf', '1', '1', NULL, NULL, '1', '2024-10-11 03:25:10', '2024-09-12 19:29:04', 1);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `proposal_mahasiswa_v`
-- (Lihat di bawah untuk tampilan aktual)
--
DROP VIEW IF EXISTS `proposal_mahasiswa_v`;
CREATE TABLE `proposal_mahasiswa_v` (
`id` bigint(20)
,`mahasiswa_id` bigint(20)
,`judul` text
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

--
-- Dumping data untuk tabel `seminar`
--

INSERT INTO `seminar` (`id`, `proposal_mahasiswa_id`, `dosen_penguji_id`, `dosen_penguji_id2`, `tanggal`, `jam_mulai`, `jam_selesai`, `tempat`, `file_proposal`, `sk_tim`, `bukti_konsultasi`, `persetujuan`, `created_at`, `id_periode`) VALUES
(1, 17, 4, 9, '2024-09-14', '08:30:00', '10:30:00', 'Ruang BNI 1', '20240912092536_66e340307bc23.pdf', '20240912092536_66e340307ce6d.pdf', '20240912092536_66e340307d62f.pdf', '20240912092536_66e340307e184.pdf', '2024-09-12 19:47:38', 1);

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

--
-- Dumping data untuk tabel `skripsi`
--

INSERT INTO `skripsi` (`id`, `judul_skripsi`, `dosen_id`, `dosen_penguji_id`, `dosen_penguji_id2`, `file_skripsi`, `sk_tim`, `mahasiswa_id`, `jadwal_skripsi`, `tempat`, `status`, `persetujuan`, `bukti_konsultasi`, `created_at`, `id_periode`) VALUES
(1, 'implementasi docker untuk integrasi sistem informasi skripsi dan pengecekan judul skripsi pada progr', NULL, 4, 9, '20240914080834_66e52862965a5.pdf', '20240914080834_66e52862976b3.pdf', 18, '2024-09-15 03:19:00', 'Ruang BNI 1', '1', '20240914080834_66e5286295e84.pdf', '20240914080834_66e528629904a.pdf', '2024-09-14 06:20:07', 1);

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
DROP VIEW IF EXISTS `skripsi_v`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `skripsi_v` AS
SELECT 
  `mahasiswa_v`.`nim` AS `nim`,
  `mahasiswa_v`.`nama_prodi` AS `nama_prodi`,
  `mahasiswa_v`.`nama` AS `nama_mahasiswa`,
  `skripsi`.`id` AS `skripsi_id`, -- Ubah 'id' agar lebih jelas
  `skripsi`.`judul_skripsi` AS `judul_skripsi`,
  `seminar_view`.`dosen_pembimbing_1` AS `dosen_pembimbing1_id`,
  `seminar_view`.`dosen_pembimbing_2` AS `dosen_pembimbing2_id`,
  `seminar_view`.`dosen_penguji_1` AS `dosen_penguji1_id`,
  `seminar_view`.`dosen_penguji_2` AS `dosen_penguji2_id`,
  `skripsi`.`sk_tim` AS `sk_tim`,
  `skripsi`.`mahasiswa_id` AS `mahasiswa_id`,
  `dosen`.`nama` AS `nama_pembimbing`,
  `skripsi`.`jadwal_skripsi` AS `jadwal_skripsi`,
  `skripsi`.`tempat` AS `tempat`,
  `skripsi`.`file_skripsi` AS `file_skripsi`,
  `skripsi`.`status` AS `status`,
  `skripsi`.`persetujuan` AS `persetujuan`,
  `skripsi`.`bukti_konsultasi` AS `bukti_konsultasi`,
  `skripsi`.`created_at` AS `created_at`,
  `skripsi`.`id_periode` AS `id_periode`,
  `mahasiswa_v`.`email` AS `email`
FROM
  `skripsi`
  JOIN `mahasiswa_v` ON (`skripsi`.`mahasiswa_id` = `mahasiswa_v`.`id`)
  JOIN `proposal_mahasiswa` ON (`skripsi`.`mahasiswa_id` = `proposal_mahasiswa`.`mahasiswa_id`)
  JOIN `seminar_view` ON (`proposal_mahasiswa`.`id` = `seminar_view`.`proposal_mahasiswa_id`)
  JOIN `dosen` ON (`seminar_view`.`dosen_pembimbing_1` = `dosen`.`id`);


-- --------------------------------------------------------

--
-- Struktur untuk view `skripsi_vl`
--
DROP VIEW IF EXISTS `skripsi_vl`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `skripsi_vl` AS
SELECT 
  `skripsi_v`.`nim` AS `nim`,
  `skripsi_v`.`nama_prodi` AS `nama_prodi`,
  `skripsi_v`.`nama_mahasiswa` AS `nama_mahasiswa`,
  `skripsi_v`.`skripsi_id` AS `skripsi_id`, -- Ubah 'id' agar lebih jelas
  `skripsi_v`.`judul_skripsi` AS `judul_skripsi`,
  `skripsi_v`.`dosen_pembimbing1_id` AS `dosen_pembimbing1_id`,
  `skripsi_v`.`dosen_pembimbing2_id` AS `dosen_pembimbing2_id`,
  `skripsi_v`.`dosen_penguji1_id` AS `dosen_penguji1_id`,
  `skripsi_v`.`dosen_penguji2_id` AS `dosen_penguji2_id`,
  `skripsi_v`.`sk_tim` AS `sk_tim`,
  `skripsi_v`.`mahasiswa_id` AS `mahasiswa_id`,
  `pembimbing1`.`nama` AS `nama_pembimbing1`,
  `pembimbing2`.`nama` AS `nama_pembimbing2`,
  `penguji1`.`nama` AS `nama_penguji1`,
  `penguji2`.`nama` AS `nama_penguji2`,
  `skripsi_v`.`jadwal_skripsi` AS `jadwal_skripsi`,
  `skripsi_v`.`tempat` AS `tempat`,
  `skripsi_v`.`file_skripsi` AS `file_skripsi`,
  `skripsi_v`.`status` AS `status`,
  `skripsi_v`.`persetujuan` AS `persetujuan`,
  `skripsi_v`.`bukti_konsultasi` AS `bukti_konsultasi`,
  `skripsi_v`.`email` AS `email`,
  `skripsi_v`.`created_at` AS `created_at`,
  `skripsi_v`.`id_periode` AS `id_periode`
FROM
  `skripsi_v`
  LEFT JOIN `skripsi` ON (`skripsi_v`.`mahasiswa_id` = `skripsi`.`mahasiswa_id`)
  LEFT JOIN `dosen` `pembimbing1` ON (`skripsi_v`.`dosen_pembimbing1_id` = `pembimbing1`.`id`)
  LEFT JOIN `dosen` `pembimbing2` ON (`skripsi_v`.`dosen_pembimbing2_id` = `pembimbing2`.`id`)
  LEFT JOIN `dosen` `penguji1` ON (`skripsi_v`.`dosen_penguji1_id` = `penguji1`.`id`)
  LEFT JOIN `dosen` `penguji2` ON (`skripsi_v`.`dosen_penguji2_id` = `penguji2`.`id`);

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
-- Indeks untuk tabel `predikat_penilaian`
--
ALTER TABLE `predikat_penilaian`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=540;

--
-- AUTO_INCREMENT untuk tabel `dokumen_hasil`
--
ALTER TABLE `dokumen_hasil`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `dosen`
--
ALTER TABLE `dosen`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

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
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `home_template`
--
ALTER TABLE `home_template`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `komponen_penilaian`
--
ALTER TABLE `komponen_penilaian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `konsultasi`
--
ALTER TABLE `konsultasi`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `penelitian`
--
ALTER TABLE `penelitian`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pengujian_sempro`
--
ALTER TABLE `pengujian_sempro`
  MODIFY `id_pengujian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `pengujian_skripsi`
--
ALTER TABLE `pengujian_skripsi`
  MODIFY `id_pengujian_skripsi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `periode`
--
ALTER TABLE `periode`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `predikat_penilaian`
--
ALTER TABLE `predikat_penilaian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `prodi`
--
ALTER TABLE `prodi`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `proposal_mahasiswa`
--
ALTER TABLE `proposal_mahasiswa`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `seminar`
--
ALTER TABLE `seminar`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `skripsi`
--
ALTER TABLE `skripsi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
