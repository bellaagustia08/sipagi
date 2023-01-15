-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 22 Jun 2022 pada 03.16
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sipagi`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `aturan`
--

CREATE TABLE `aturan` (
  `id_aturan` int(10) NOT NULL,
  `id_gejala` int(10) DEFAULT NULL,
  `id_penyakit` int(10) DEFAULT NULL,
  `cf_pakar` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `aturan`
--

INSERT INTO `aturan` (`id_aturan`, `id_gejala`, `id_penyakit`, `cf_pakar`) VALUES
(1, 24, 1, 1),
(2, 25, 1, 0.4),
(3, 32, 1, 0.8),
(4, 36, 1, 0.6),
(5, 38, 1, 0.8),
(6, 5, 2, 0.8),
(7, 6, 2, 0.6),
(8, 12, 2, 0.8),
(9, 13, 2, 0.6),
(10, 24, 2, 1),
(11, 36, 2, 0.6),
(12, 37, 2, 0.8),
(13, 13, 3, 0.6),
(14, 16, 3, 0.6),
(15, 20, 3, 0.4),
(16, 25, 3, 0.6),
(17, 34, 3, 0.6),
(18, 35, 3, 0.6),
(19, 39, 3, 0.4),
(20, 2, 4, 0.6),
(21, 13, 4, 0.6),
(22, 19, 4, 0.4),
(23, 24, 4, 0.8),
(24, 36, 4, 0.8),
(25, 13, 5, 0.6),
(26, 42, 5, 1),
(27, 13, 6, 0.6),
(28, 21, 6, 0.4),
(29, 29, 6, 0.8),
(30, 30, 6, 0.8),
(31, 31, 6, 0.8),
(32, 1, 7, 0.4),
(33, 11, 7, 1),
(34, 21, 7, 0.6),
(35, 27, 7, 0.2),
(36, 26, 8, 0.6),
(37, 41, 8, 1),
(38, 5, 9, 0.6),
(39, 8, 9, 0.8),
(40, 23, 9, 0.8),
(41, 36, 9, 0.6),
(42, 38, 9, 0.8),
(43, 7, 10, 0.6),
(44, 8, 10, 0.8),
(45, 17, 10, 0.8),
(46, 22, 10, 1),
(47, 28, 10, 0.8),
(48, 40, 10, 1),
(49, 5, 11, 0.6),
(50, 10, 11, 1),
(51, 33, 11, 0.8),
(52, 34, 11, 0.6),
(53, 3, 12, 0.6),
(54, 7, 12, 0.4),
(55, 9, 12, 0.6),
(56, 13, 12, 0.8),
(57, 14, 12, 0.8),
(58, 15, 12, 0.6),
(59, 18, 12, 0.6);

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_konsultasi`
--

CREATE TABLE `detail_konsultasi` (
  `id_detail_konsultasi` int(10) NOT NULL,
  `id_konsultasi` int(10) DEFAULT NULL,
  `id_gejala` int(10) DEFAULT NULL,
  `cf_user` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `detail_konsultasi`
--

INSERT INTO `detail_konsultasi` (`id_detail_konsultasi`, `id_konsultasi`, `id_gejala`, `cf_user`) VALUES
(34, 1, 3, 0.4),
(35, 1, 5, 0.6),
(36, 1, 12, 0.6),
(37, 1, 14, 0.4),
(38, 1, 24, 0.8),
(39, 1, 25, 0.6),
(40, 1, 33, 0.4),
(41, 1, 36, 0.4),
(42, 1, 39, 0.4),
(43, 2, 7, 0.6),
(44, 2, 17, 0.8),
(45, 2, 28, 0.4),
(46, 2, 33, 0.4),
(47, 2, 39, 0.4),
(48, 3, 7, 0.6),
(49, 3, 17, 0.8),
(50, 3, 28, 0.4),
(51, 3, 33, 0.4),
(52, 3, 39, 0.4),
(53, 4, 3, 0.6),
(54, 4, 5, 0.8),
(55, 4, 24, 0.6),
(56, 4, 25, 0.6),
(57, 4, 26, 0.6),
(58, 5, 40, 0.4),
(59, 5, 41, 0.6);

-- --------------------------------------------------------

--
-- Struktur dari tabel `dokter`
--

CREATE TABLE `dokter` (
  `id_dokter` int(10) NOT NULL,
  `nama_dokter` varchar(100) DEFAULT NULL,
  `alamat_dokter` varchar(100) DEFAULT NULL,
  `no_telp_dokter` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `dokter`
--

INSERT INTO `dokter` (`id_dokter`, `nama_dokter`, `alamat_dokter`, `no_telp_dokter`) VALUES
(1, 'Drg. Bagus Perkasa', 'Jln. Jeruk No. 25', '089726351199'),
(2, 'Drg. Caca Karunia', 'Jln. Flamboyan No. 5', '081287302933'),
(3, 'Drg. Abdi Sutejo', 'Jln. Mangga No.35', '081239482298');

-- --------------------------------------------------------

--
-- Struktur dari tabel `gejala`
--

CREATE TABLE `gejala` (
  `id_gejala` int(10) NOT NULL,
  `nama_gejala` varchar(255) DEFAULT NULL,
  `kode_gejala` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `gejala`
--

INSERT INTO `gejala` (`id_gejala`, `nama_gejala`, `kode_gejala`) VALUES
(1, 'Bagian dalam pipi atau lidah tergigit', 'G01'),
(2, 'Bau mulut tidak sedap', 'G02'),
(3, 'Berdarah saat sikat gigi', 'G03'),
(4, 'Demam', 'G04'),
(5, 'Gigi berubah warna', 'G05'),
(6, 'Gigi berwarna kehitaman', 'G06'),
(7, 'Gigi goyang', 'G07'),
(8, 'Gigi retak dan tidak rata', 'G08'),
(9, 'Gigi terlihat panjang - panjang', 'G09'),
(10, 'Gigi terlihat terkikis di bagian yang dipakai untuk mengunyah', 'G10'),
(11, 'Gigi tumbuh bertumpukan', 'G11'),
(12, 'Gigi yang sebelumnya sakit perlahan menghilang', 'G12'),
(13, 'Gusi bengkak', 'G13'),
(14, 'Gusi berwarna lebih merah', 'G14'),
(15, 'Gusi berwarna merah keunguan', 'G15'),
(16, 'Gusi dan rahang bagian belakang terasa sakit ketika diraba menggunakan lidah atau saat menyikat gigi.', 'G16'),
(17, 'Gusi menurun', 'G17'),
(18, 'Gusi sangat lembut saat disentuh', 'G18'),
(19, 'Keluar nanah dari gusi', 'G19'),
(20, 'Kesulitan membuka mulut', 'G20'),
(21, 'Kesulitan saat mengunyah atau menggigit makanan', 'G21'),
(22, 'Leher gigi (antara gusi dan gigi) tidak rata', 'G22'),
(23, 'Lekukan kuning pada permukaan gigi', 'G23'),
(24, 'Lubang yang terlihat pada gigi', 'G24'),
(25, 'Makanan terselip', 'G25'),
(26, 'Memiliki kebiasaan seperti mengisap jari, mendorong lidah, atau menggigit bibir bawah', 'G26'),
(27, 'Mengalami gangguan bicara seperti cadel', 'G27'),
(28, 'Ngilu pada gusi atau gigi', 'G28'),
(29, 'Ngilu saat menggunakan obat kumur yang mengandung alkohol', 'G29'),
(30, 'Ngilu saat mengonsumsi makanan manis, panas atau dingin', 'G30'),
(31, 'Ngilu saat menyikat gigi atau membersihkan sela-sela gigi (flossing)', 'G31'),
(32, 'Noda berwarna cokelat, hitam, atau putih pada permukaan gigi', 'G32'),
(33, 'Nyeri pada gusi atau gigi', 'G33'),
(34, 'Nyeri pada rahang', 'G34'),
(35, 'Nyeri saat menggigit atau mengunyah makanan', 'G35'),
(36, 'Nyeri saat mengonsumsi makanan manis, panas atau dingin', 'G36'),
(37, 'Nyeri terasa tajam dan menusuk', 'G37'),
(38, 'Nyeri yang berketerusan', 'G38'),
(39, 'Sakit kepala berkepanjangan', 'G39'),
(40, 'Terdapat area kuning di antara gusi dan gigi (pada leher gigi) ', 'G40'),
(41, 'Terdapat celah di antara kedua gigi seri depan', 'G41'),
(42, 'Terdapat dua gigi atau lebih, tumbuh di tempat yang sama', 'G42');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jadwal`
--

CREATE TABLE `jadwal` (
  `id_jadwal` int(10) NOT NULL,
  `tanggal_jadwal` date DEFAULT NULL,
  `waktu_jadwal` time DEFAULT NULL,
  `id_dokter` int(10) DEFAULT NULL,
  `id_pasien` int(10) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `jadwal`
--

INSERT INTO `jadwal` (`id_jadwal`, `tanggal_jadwal`, `waktu_jadwal`, `id_dokter`, `id_pasien`, `status`) VALUES
(1, '2022-08-17', '13:00:00', 1, NULL, 'Tidak Aktif'),
(2, '2022-08-16', '08:00:00', 2, NULL, 'Tidak Aktif'),
(3, '2022-08-17', '16:00:00', 2, NULL, 'Tidak Aktif'),
(4, '2022-08-01', '08:00:00', 3, NULL, 'Tidak Aktif'),
(5, '2022-06-30', '10:00:00', 1, NULL, 'Tidak Aktif');

-- --------------------------------------------------------

--
-- Struktur dari tabel `konsultasi`
--

CREATE TABLE `konsultasi` (
  `id_konsultasi` int(10) NOT NULL,
  `id_pasien` int(10) DEFAULT NULL,
  `no_tiket` varchar(255) DEFAULT NULL,
  `id_penyakit` int(10) DEFAULT NULL,
  `cf_gabungan` float DEFAULT NULL,
  `waktu` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `konsultasi`
--

INSERT INTO `konsultasi` (`id_konsultasi`, `id_pasien`, `no_tiket`, `id_penyakit`, `cf_gabungan`, `waktu`) VALUES
(1, 1, 'I6ERJ8', 2, 0.958899, '2022-06-14 04:35:24'),
(2, 3, 'P6CSJM', 10, 0.843328, '2022-06-14 14:38:56'),
(3, 1, 'KWQ5EV', 10, 0.843328, '2022-06-14 21:56:30'),
(4, 1, '0HI8UT', 2, 0.856, '2022-06-20 18:13:21'),
(5, 2, '48R93N', 8, 0.6, '2022-06-22 05:21:17');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pasien`
--

CREATE TABLE `pasien` (
  `id_pasien` int(10) NOT NULL,
  `nama_pasien` varchar(100) DEFAULT NULL,
  `username_pasien` varchar(255) DEFAULT NULL,
  `alamat_pasien` varchar(100) DEFAULT NULL,
  `no_telp_pasien` varchar(100) DEFAULT NULL,
  `tanggal_lahir_pasien` date DEFAULT NULL,
  `umur_pasien` int(10) DEFAULT NULL,
  `jenis_kelamin_pasien` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pasien`
--

INSERT INTO `pasien` (`id_pasien`, `nama_pasien`, `username_pasien`, `alamat_pasien`, `no_telp_pasien`, `tanggal_lahir_pasien`, `umur_pasien`, `jenis_kelamin_pasien`) VALUES
(1, 'Bella Agustia', 'bella123', 'Jln. Apel No.35', '081212233183', '1999-08-04', 23, 'Perempuan'),
(2, 'Putra Prakoso', 'putra123', 'Jln. Salak No.65', '089726374812', '1998-04-27', 24, 'Laki-laki'),
(3, 'Nastasya Celline', 'celline123', 'Jln. Mangga No.34', '089837281123', '2022-06-30', 26, 'Perempuan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penyakit`
--

CREATE TABLE `penyakit` (
  `id_penyakit` int(10) NOT NULL,
  `nama_penyakit` varchar(255) DEFAULT NULL,
  `kode_penyakit` varchar(10) DEFAULT NULL,
  `definisi_penyakit` text DEFAULT NULL,
  `penanganan_penyakit` text DEFAULT NULL,
  `gambar_penyakit` varchar(255) DEFAULT NULL,
  `nama_file` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `penyakit`
--

INSERT INTO `penyakit` (`id_penyakit`, `nama_penyakit`, `kode_penyakit`, `definisi_penyakit`, `penanganan_penyakit`, `gambar_penyakit`, `nama_file`) VALUES
(1, 'Karies Gigi', 'P01', 'Karies atau  gigi berlubang adalah suatu penyakit yang disebabkan oleh kerusakan lapisan email yang bisa meluas sampai ke bagian saraf gigi yang disebabkan oleh aktifitas bakteri di dalam mulut.', 'Saran penanganan untuk mengurangi gejala gigi bolong atau berlubang yang terasa sakit, beberapa penanganan yang dapat dilakukan adalah dianjurkan untuk menyikat gigi minimal 2 kali sehari, yaitu setelah makan dan sebelum tidur, perawatan saluran akar gigi (root planing), penambalan gigi dan pencabutan gigi\r\n', 'https://firebasestorage.googleapis.com/v0/b/sipagi.appspot.com/o/penyakit%2FKaries%20Gigi%20(Gigi%20Berlubang).jpg?alt=media&token=a247dcf1-2901-4433-a8f6-496e403a8563', 'Karies Gigi (Gigi Berlubang).jpg'),
(2, 'Nekrosis Pulpa', 'P02', 'Pulpa terdiri atas saraf-saraf gigi dan pembuluh darah. Jaringan ini bermula dari mahkota gigi, lalu berlanjut hingga mengisi rongga akar gigi. Jadi singkatnya, nekrosis pulpa adalah gigi dengan saraf yang sudah mati. Artinya, kerusakan gigi telah mencapai tahap paling parah dan kemungkinan tidak bisa ditambal lagi.', 'Saran penanganan jika anda menderita Nekrosis Pulpa adalah perawatan saluran akar (membuang jaringan pulpa yang mati, membersihkannya, kemudian melakukan filling) dan pencabutan gigi\n', 'https://firebasestorage.googleapis.com/v0/b/sipagi.appspot.com/o/penyakit%2FNekrosis%20Pulpa.jpg?alt=media&token=7f4a1aec-8a05-489b-9cfa-ef58457b1dd5', 'Nekrosis Pulpa.jpg'),
(3, 'Impaksi Gigi', 'P03', 'Impaksi gigi atau gigi terpendam merupakan kondisi gigi yang terjebak di dalam gusi dan umumnya terjadi pada gigi geraham bungsu orang dewasa. Impaksi gigi terjadi saat gigi bungsu tumbuh secara tidak sempurna karena tidak mendapatkan ruang yang cukup unt', 'Segera periksa ke dokter gigi jika hasil pemeriksaan menunjukkan bahwa impaksi gigi telah membawa dampak buruk bagi gigi lainnya, tindakan yang direkomendasikan adalah pencabutan gigi atau operasi gigi bungsu.\r\n\r\n', 'https://firebasestorage.googleapis.com/v0/b/sipagi.appspot.com/o/penyakit%2FImpaksi%20Gigi.jpg?alt=media&token=668e3c28-ca73-452f-ae12-df333922774c', 'Impaksi Gigi.jpg'),
(4, 'Sisa Akar Gigi', 'P04', 'Sisa akar gigi biasanya terjadi akibat gigi berlubang yang tidak dirawat atau trauma. Pada gigi berlubang yang tidak di rawat, ini bisa menyebabkan seluruh mahkota gigi habis dan tersisa akarnya saja.', 'Tindakan yang tepat jika anda mengalami sisa akar gigi adalah segera pergi ke dokter untuk melakukan pencabutan sisa akar.', 'https://firebasestorage.googleapis.com/v0/b/sipagi.appspot.com/o/penyakit%2FSisa%20Akar.jpg?alt=media&token=e466940f-31d8-4891-bb3e-797569e37c38', 'Sisa Akar.jpg'),
(5, 'Persistensi Gigi', 'P05', 'Persistensi gigi adalah suatu keadaan gigi sulung(gigi susu) masih berada di mulut dan belum tanggal, tetapi gigi tetap yang akan menggantikannya sudah tumbuh. Pada keadaan persistensi, terkadang gigi susu juga tidak goyang, dan bisa ditemukan pada gigi mana saja.', 'Saran penanganan yang dianjurkan jika anda menderita persistensi gigi adalah Pemasangan behel, dengan catatan pemasangan behel hanya bisa dilakukan ketika kondisi gigi susu masih sehat dan berfungsi dengan baik. Selain itu, tindakan ini juga dilakukan jika tidak ada gigi permanen yang bisa menggantikan gigi susu tersebut. Saran lainnya pencabutan gigi susu, pemasangan kawat gigi setelah pencabutan dan pemasangan implan gigi setelah pencabutan', 'https://firebasestorage.googleapis.com/v0/b/sipagi.appspot.com/o/penyakit%2FPersistensi.png?alt=media&token=0cb2d370-3764-49d8-9c30-f3b632b1fbbc', 'Persistensi.png'),
(6, 'Gigi Hipersensitif', 'P06', 'Gigi Hipersensitif atau di dalam dunia kedokteran gigi lebih tepat disebut Dentin Hipersensitif (DH), yaitu suatu respon yang tidak normal dari dentin gigi yang masih vital terhadap berbagai rangsangan, seperti panas, dingin, sentuhan, bahan kimia, dan rangsangan osmotik dari defek gigi atau patologis. Penyebab hipersensitif dentin bermacam-macam, tetapi secara umum terjadi karena akar gigi terbuka sehingga menyebabkan pori-pori yang terdapat pada dentin ikut terbuka.', 'Saran penanganan jika anda mengalami Gigi Hipersensitif adalah anda dianjurkan menggunakan pasta gigi khusus untuk gigi sensitif, memilih sikat gigi dengan bulu sikat yang lembut, menggunakan obat kumur yang bebas alkohol, menyikat gigi secara perlahan, melakukan serangkaian perawatan gigi untuk mengurangi gigi hipersensitif, lalu biasanya juga dokter gigi akan mengaplikasikan bahan desensitisasi yang tujuannya untuk menutup tubuli dentin sehingga mengurangi hipersensitifitas.\r\n', 'https://firebasestorage.googleapis.com/v0/b/sipagi.appspot.com/o/penyakit%2FGigi%20Hipersensitif.png?alt=media&token=e40653c5-b0f9-48b9-ae8e-00b2c7c2015d', 'Gigi Hipersensitif.png'),
(7, 'Maloklusi (Gigi Berantakan)', 'P07', 'Maloklusi adalah kondisi susunan tulang rahang dan gigi yang tidak sejajar atau rata. Kondisi ini menyebabkan gigi berantakan, entah itu jadi tumpang tindih, bengkok, gigi tonggos (overbite), dan masalaha lainnya.', 'Saran penanganan jika anda mengalami Maloklusi adalah \r\npemasangan kawat gigi (behel), \r\npemasangan kawat atau pelat khusus untuk mengukuhkan atau menstabilkan tulang rahang, \r\npencabutan gigi tertentu untuk memperbaiki posisi gigi yang terlalu berdesakan, \r\npemasangan crown gigi atau dental crown, dan operasi untuk memperpendek atau memperbaiki bentuk tulang rahang.\r\n', 'https://firebasestorage.googleapis.com/v0/b/sipagi.appspot.com/o/penyakit%2FMaloklusi%20Gigi%20(Gigi%20Berantakan).jpg?alt=media&token=d9f5de91-e91d-483a-9b87-d8755e876695', 'Maloklusi Gigi (Gigi Berantakan).jpg'),
(8, 'Diastema', 'P08', 'Diastema merupakan suatu kondisi ketika terdapat celah di antara kedua gigi yang bersebelahan. Seseorang bisa dikatakan memiliki diastema bila lebar celahnya mencapai 0,5 milimeter atau lebih. Diastema paling sering ditemukan pada gigi seri depan atau tengah di rahang atas. Namun, kondisi ini juga melibatkan gigi belakang.', 'Saran penanganan jika anda menderita Diastema adalah pemasangan kawat gigi, pemasangan crown gigi, veneer atau bonding, dimana dokter akan memberikan komposit dengan warna serupa warna alami gigi di area diastema. Tujuannya untuk menyamarkan rongga di antara gigi. Lalu anda juga bisa melakukan perawatan ortodontik, dimana dokter gigi bisa mengusulkan untuk melakukan pengecilan jarak di antara gigi.', 'https://firebasestorage.googleapis.com/v0/b/sipagi.appspot.com/o/penyakit%2FDiastema.jpg?alt=media&token=13c3adba-dd04-4222-be10-674570407bef', 'Diastema.jpg'),
(9, 'Erosi Gigi', 'P09', 'Erosi gigi adalah proses terkikisnya lapisan enamel gigi yang disebabkan oleh makanan dan minuman atau zat asam yang berasal dari dalam tubuh. Enamel adalah salah satu struktur gigi berupa lapisan keras pelindung gigi, yang melindungi lapisan dentin di dalamnya yang bersifat sensitif.', '- Menggunakan pasta gigi dan obat kumur yang mengandung fluoride.\r\n- Melakukan fluoride varnish setidaknya setiap enam bulan\r\n- Kurangi mengonsumsi sesuatu yang asam,\r\n- Berkumur dengan air putih setelah mengonsumsi makanan dan minuman yang bersifat asam \r\n- Minum air putih yang cukup', 'https://firebasestorage.googleapis.com/v0/b/sipagi.appspot.com/o/penyakit%2FErosi%20Gigi.png?alt=media&token=e6f2b7fc-ada2-41d9-8eff-22c519a64700', 'Erosi Gigi.png'),
(10, 'Abrasi Gigi', 'P10', 'Abrasi adalah keadaan abnormal pada lapisan gigi yaitu email yang hilang dan terkikis atau terkadang hingga lapisan yang lebih dari email atau dentin. Abrasi gigi banyak ditemukan pada daerah servikal membentuk irisan atau parit berbentuk huruf “V” pada akar diantara mahkota dan gingiva. Salah satu penyebab abrasi gigi adalah teknik sikat gigi yang salah.', 'Saran penanganan jika anda menderita Abrasi Gigi adalah pembuatan Mahkota gigi (Crown) dan penambalan gigi. cek tesasasa\r\n', 'https://firebasestorage.googleapis.com/v0/b/sipagi.appspot.com/o/penyakit%2FAbrasi%20Gigi.jpeg?alt=media&token=2e4b1aa6-38b9-4c0a-9711-e851a7025edc', 'Abrasi Gigi.jpeg'),
(11, 'Atrisi Gigi', 'P11', 'Atrisi gigi adalah pengikisan gigi akibat kekuatan mekanis atau gesekan antar gigi atas dan gigi bawah. Atrisi bisa menyebabkan ngilu namun bisa diatasi dengan tambalan yang sesuai.', '- Menghilangkan bruxism \nBruxism adalah kebiasaan menggesek-gesek gigi atas dan bawah saat tidur.\n- Pembuatan Mahkota Gigi (Crown)\n- Penambalan Gigi\n', 'https://firebasestorage.googleapis.com/v0/b/sipagi.appspot.com/o/penyakit%2FAtrisi%20Gigi.jpg?alt=media&token=eee52256-28b4-4820-9018-1675ebc4fcb4', 'Atrisi Gigi.jpg'),
(12, 'Gingivitis', 'P12', 'Gingivitis (radang gusi) adalah penyakit akibat infeksi bakteri yang menyebabkan gusi bengkak karena meradang.', 'Pengobatan gingivitis atau radang gusi bertujuan untuk meredakan gejala dan mencegah komplikasi. \r\nBerikut beberapa solusi untuk Gingivitis yaitu : \r\n- Melakukan Pembersihan karang gigi (scaling)\r\n- Perawatan saluran akar gigi (root planing)\r\n- Penambalan atau penggantian gigi yang rusak\r\n', 'https://firebasestorage.googleapis.com/v0/b/sipagi.appspot.com/o/penyakit%2FGingivitis.jpg?alt=media&token=89860299-c301-4dda-8828-4c1518c6afb7', 'Gingivitis.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id_user` int(10) NOT NULL,
  `nama_lengkap` varchar(100) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `role` varchar(100) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id_user`, `nama_lengkap`, `username`, `email`, `password`, `role`, `status`) VALUES
(1, 'Bella Agustia', 'Admin123', 'bellaagustia08@gmail.com', '2c103f2c4ed1e59c0b4e2e01821770fa', 'Admin', 'Aktif'),
(2, 'Dr. Bagus Prakasa', 'Pakar123', 'akunfake08@gmail.com', '2c103f2c4ed1e59c0b4e2e01821770fa', 'Pakar', 'Aktif'),
(4, 'Celline', 'UsernameAdmin2', 'cellineanastasy08@gmail.com', '2c103f2c4ed1e59c0b4e2e01821770fa', 'Pakar', 'Aktif'),
(5, 'Dr. Renita Dewi', 'Renitadew1', 'rere44@gmail.com', '2c103f2c4ed1e59c0b4e2e01821770fa', 'Pakar', 'Tidak Aktif'),
(6, 'sasa', 'sasasa123', 'asasasas@gmail.com', '42f749ade7f9e195bf475f37a44cafcb', 'Admin', 'Tidak Aktif'),
(7, 'tes', 'testes123', 'tes@gmail.com', '2c103f2c4ed1e59c0b4e2e01821770fa', 'Admin', 'Tidak Aktif'),
(8, 'qqqqqqqq', 'qqqqqqq1', 'qqq@gmail.com', '2c103f2c4ed1e59c0b4e2e01821770fa', 'Pakar', 'Tidak Aktif'),
(9, 'zzzz', 'zzzzzzz1', 'zzz@gmail.com', '2c103f2c4ed1e59c0b4e2e01821770fa', 'Admin', 'Tidak Aktif'),
(10, 'ddd', 'ddddddd1', 'ddd@gmail.com', '2c103f2c4ed1e59c0b4e2e01821770fa', 'Admin', 'Tidak Aktif'),
(11, 'ghghgh', 'ghghgh123', 'ghgh@gmail.com', '2c103f2c4ed1e59c0b4e2e01821770fa', 'Admin', 'Tidak Aktif');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `aturan`
--
ALTER TABLE `aturan`
  ADD PRIMARY KEY (`id_aturan`),
  ADD KEY `id_penyakit` (`id_penyakit`),
  ADD KEY `id_gejala` (`id_gejala`) USING BTREE;

--
-- Indeks untuk tabel `detail_konsultasi`
--
ALTER TABLE `detail_konsultasi`
  ADD PRIMARY KEY (`id_detail_konsultasi`),
  ADD KEY `id_konsultasi` (`id_konsultasi`),
  ADD KEY `id_gejala` (`id_gejala`);

--
-- Indeks untuk tabel `dokter`
--
ALTER TABLE `dokter`
  ADD PRIMARY KEY (`id_dokter`);

--
-- Indeks untuk tabel `gejala`
--
ALTER TABLE `gejala`
  ADD PRIMARY KEY (`id_gejala`);

--
-- Indeks untuk tabel `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`id_jadwal`),
  ADD KEY `id_pasien` (`id_pasien`) USING BTREE,
  ADD KEY `id_dokter` (`id_dokter`) USING BTREE;

--
-- Indeks untuk tabel `konsultasi`
--
ALTER TABLE `konsultasi`
  ADD PRIMARY KEY (`id_konsultasi`),
  ADD KEY `id_penyakit` (`id_penyakit`),
  ADD KEY `id_pasien` (`id_pasien`) USING BTREE;

--
-- Indeks untuk tabel `pasien`
--
ALTER TABLE `pasien`
  ADD PRIMARY KEY (`id_pasien`);

--
-- Indeks untuk tabel `penyakit`
--
ALTER TABLE `penyakit`
  ADD PRIMARY KEY (`id_penyakit`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `aturan`
--
ALTER TABLE `aturan`
  MODIFY `id_aturan` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT untuk tabel `detail_konsultasi`
--
ALTER TABLE `detail_konsultasi`
  MODIFY `id_detail_konsultasi` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT untuk tabel `dokter`
--
ALTER TABLE `dokter`
  MODIFY `id_dokter` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `gejala`
--
ALTER TABLE `gejala`
  MODIFY `id_gejala` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT untuk tabel `jadwal`
--
ALTER TABLE `jadwal`
  MODIFY `id_jadwal` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `konsultasi`
--
ALTER TABLE `konsultasi`
  MODIFY `id_konsultasi` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `pasien`
--
ALTER TABLE `pasien`
  MODIFY `id_pasien` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `penyakit`
--
ALTER TABLE `penyakit`
  MODIFY `id_penyakit` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `aturan`
--
ALTER TABLE `aturan`
  ADD CONSTRAINT `aturan_ibfk_1` FOREIGN KEY (`id_gejala`) REFERENCES `gejala` (`id_gejala`) ON UPDATE CASCADE,
  ADD CONSTRAINT `aturan_ibfk_2` FOREIGN KEY (`id_penyakit`) REFERENCES `penyakit` (`id_penyakit`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `detail_konsultasi`
--
ALTER TABLE `detail_konsultasi`
  ADD CONSTRAINT `detail_konsultasi_ibfk_1` FOREIGN KEY (`id_konsultasi`) REFERENCES `konsultasi` (`id_konsultasi`) ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_konsultasi_ibfk_2` FOREIGN KEY (`id_gejala`) REFERENCES `gejala` (`id_gejala`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `jadwal`
--
ALTER TABLE `jadwal`
  ADD CONSTRAINT `jadwal_ibfk_1` FOREIGN KEY (`id_dokter`) REFERENCES `dokter` (`id_dokter`) ON UPDATE CASCADE,
  ADD CONSTRAINT `jadwal_ibfk_2` FOREIGN KEY (`id_pasien`) REFERENCES `pasien` (`id_pasien`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `konsultasi`
--
ALTER TABLE `konsultasi`
  ADD CONSTRAINT `konsultasi_ibfk_2` FOREIGN KEY (`id_penyakit`) REFERENCES `penyakit` (`id_penyakit`) ON UPDATE CASCADE,
  ADD CONSTRAINT `konsultasi_ibfk_3` FOREIGN KEY (`id_pasien`) REFERENCES `pasien` (`id_pasien`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
