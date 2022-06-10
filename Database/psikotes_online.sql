-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 10, 2022 at 10:26 AM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `psikotes_online`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id_admin` int(3) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id_admin`, `username`, `password`) VALUES
(2, 'admin', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_nilai`
--

CREATE TABLE `tbl_nilai` (
  `id_nilai` int(7) NOT NULL,
  `id_user` int(5) NOT NULL,
  `benar` varchar(20) NOT NULL,
  `salah` varchar(20) NOT NULL,
  `kosong` varchar(20) NOT NULL,
  `score` varchar(20) NOT NULL,
  `tanggal` date NOT NULL,
  `keterangan` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_nilai`
--

INSERT INTO `tbl_nilai` (`id_nilai`, `id_user`, `benar`, `salah`, `kosong`, `score`, `tanggal`, `keterangan`) VALUES
(55, 121, '6', '4', '7', '35.3', '2019-04-17', 'Tidak Lulus'),
(52, 118, '16', '1', '0', '94.1', '2019-04-14', 'Lulus'),
(51, 117, '15', '1', '1', '90.2', '2019-04-14', 'Lulus');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pengaturan_tes`
--

CREATE TABLE `tbl_pengaturan_tes` (
  `id` int(4) NOT NULL,
  `nama_tes` varchar(100) NOT NULL,
  `waktu` varchar(20) NOT NULL,
  `nilai_min` varchar(20) NOT NULL,
  `peraturan` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_pengaturan_tes`
--

INSERT INTO `tbl_pengaturan_tes` (`id`, `nama_tes`, `waktu`, `nilai_min`, `peraturan`) VALUES
(1, 'TES POTENSI AKADEMIK (TPA) / TES BAKAT SKOLASTIK (TBS) 2022', '1', '75', '<ol><li>Bacalah Doa terlebih dahulu</li><li>&nbsp;Bacalah soal tes psikotes yang diujikan dengan teliti tiap-tiap soal sebelum menjawab</li><li>Pengerjaan soal tes psikotes diberikan batasan waktu apabila waktu telah habis maka anda tidak dapat mengisi&nbsp; ataupun mengoreksi kembali jawaban dari soal yang tersedia.</li></ol>');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_soal`
--

CREATE TABLE `tbl_soal` (
  `id_soal` int(5) NOT NULL,
  `soal` text NOT NULL,
  `a` varchar(100) NOT NULL,
  `b` varchar(100) NOT NULL,
  `c` varchar(100) NOT NULL,
  `d` varchar(100) NOT NULL,
  `e` varchar(100) NOT NULL,
  `knc_jawaban` varchar(30) NOT NULL,
  `gambar` varchar(100) NOT NULL,
  `tanggal` date NOT NULL,
  `aktif` enum('Y','N') NOT NULL DEFAULT 'Y'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_soal`
--

INSERT INTO `tbl_soal` (`id_soal`, `soal`, `a`, `b`, `c`, `d`, `e`, `knc_jawaban`, `gambar`, `tanggal`, `aktif`) VALUES
(54, '<b>Tes Persamaan Kata (Sinonim)</b><div><i>\r\nPilih satu jawaban yang paling dekat artinya dengan kata yang tercetak KAPITAL</i>&nbsp;</div><div><br></div><div>&nbsp;EKSKAVASI = </div>', 'Pengeboran', 'Pemindahan', 'Penggalian', 'Penyulingan', 'Pengangkutan', 'c', '', '0000-00-00', 'Y'),
(55, 'ARKETIPE = ', 'Simbol', 'Model', 'Arsip', 'Fosil', 'Artefak', 'b', '', '0000-00-00', 'N'),
(56, 'EKSENTRIK = ', 'Aneh', 'Unik', 'Antik', 'Artistik', 'Etnik', 'a', '', '0000-00-00', 'N'),
(57, 'PEMANTULAN = ', 'Refleksi', 'Refraksi', 'Transformasi', 'Transmisi', 'Transmutasi', 'a', '', '0000-00-00', 'N'),
(58, 'KULMINASI = ', 'Keadaan emosi seseorang', 'Tempat untuk mendinginkan', 'Sumbu bumi', 'Panas terik matahari', 'Tingkatan yang tertinggi', 'e', '', '0000-00-00', 'N'),
(59, '<div><b>Tes Lawan Kata (Antonim)</b></div><div><i>Pilih satu jawaban yang paling berlawanan artinya dengan kata yang tercetak KAPITAL</i></div><div><br></div>DISKREPANSI X ', 'Kecocokan', 'Ketimpangan', 'Keterkaitan', 'Keseragaman', 'Keakraban', 'a', '', '0000-00-00', 'Y'),
(60, 'TENTATIF X ', 'Cepat', 'Lancar', 'Praktis', 'Pasti', 'Tepat', 'd', '', '0000-00-00', 'N'),
(61, 'NISBI X ', 'Benar', 'Penting', 'Harus', 'Mutlak', 'Pasti', 'd', '', '0000-00-00', 'N'),
(62, 'LATEN X ', 'Tersembunyi', 'Jelas', 'Tampak', 'Terang', 'Ada', 'c', '', '0000-00-00', 'N'),
(63, 'SPORADIS X ', 'Sering', 'Sembarangan', 'Terukur', 'Jarang', 'Serius', 'a', '', '0000-00-00', 'N'),
(68, '<b>Tes Padanan Hubungan Kata (Analogi)</b><div><i>pilih satu jawaban yang sesuai dengan pola kata yang tercetak KAPITAL</i></div><div><i><br></i></div><div>PETANI : TRAKTOR =&nbsp;</div><div><i><br></i></div><div><i><br></i></div><div><i><br></i></div>', 'raja : kereta', 'dalang : cerita', 'dokter : mobil', 'nelayan : jaring', 'sopir : sepeda', 'a', '', '0000-00-00', 'Y'),
(69, 'SENAPAN : BERBURU =', 'kapal : berlabuh', 'kereta : langsir', 'pancing : ikan', 'parang : mengasah', 'perangkap : menangkap', 'a', '', '0000-00-00', 'N'),
(70, 'MOBIL : GARASI = PESAWAT :&nbsp;', 'bandara', 'landasan', 'stasiun', 'pelabuhan', 'hanggar', 'a', '', '0000-00-00', 'N'),
(71, 'OPTIMISME : SEMANGAT = PESIMISME :&nbsp;', 'kegagalan', 'kekecewaan', 'kebimbangan', 'keberanian', 'keputusasaan', 'a', '', '0000-00-00', 'N'),
(72, 'WARTEG : NASI RAMES = ANGKRINGAN :&nbsp;', 'nasi liwet', 'nasi gudeg', 'nasi uduk', 'nasi goreng', 'nasi kucing', 'a', '', '0000-00-00', 'N'),
(73, '<b>Tes Arti Kata</b><div><i>Pilih satu jawaban yang paling dekat artinya dengan kata yang tercetak KAPITAL</i></div><div><i><br></i></div><div>INSURANCE</div>', 'Promise of reimbursement in the case of loss', 'Money in the form of bills or coins', 'Money available for a client to borrow', 'A sum of money paid or a claim discharged', 'Transactions(sales and purchases) having the objective of supplying commodities', 'a', '', '0000-00-00', 'Y'),
(74, 'FELLOWSHIP', 'An association of people who share common beliefs or activities', 'The relation of an owner to the thing possessed', 'The body of people who lead a group', 'The act or process of giving form or shape to anything', 'A formal organization of people or groups of people', 'a', '', '0000-00-00', 'N'),
(75, 'REWARD', 'An act performed to strengthen approved behavior', 'A penalty inflicted by a court of justice on a convicted offender as a just retribution, and inciden', 'A stimulus that strengthens or weakens the behavior that produced it', 'A reinforcing stimulus whose removal serves to decrease the likelihood of the response that produced', 'Any stimulating information or event; acts to arouse action', 'a', '', '0000-00-00', 'N'),
(76, 'PREFIX', 'An affix that is added in front of the word', 'A linguistic element added to a word to produce an inflected or derived form', 'An affix that is inserted inside the word', 'An affix that is added at the end of the word', 'A word that expresses an attribute of something', 'a', '', '0000-00-00', 'N'),
(77, 'CHROMOSOME', 'A threadlike strand of DNA in the cell nucleus that carries the genes in a linear order', 'A segment of DNA that is involved in producing a polypeptide chain', 'A long linear polymer found in the nucleus of a cell and formed from nucleotides and shaped like a d', 'A general term for the research activity that creates a copy of some biological entity', 'A part of the cell containing DNA and RNA and responsible for growth and reproduction', 'a', '', '0000-00-00', 'N'),
(78, '<b>Tes Pemahaman Wacana</b><div><b><br></b></div><div><b>Bacalah paragraf berikut!</b></div><div><b><br></b></div><div><p class=\"MsoListParagraph\" style=\"margin-top:.25pt;margin-right:0cm;margin-bottom:\r\n0cm;margin-left:40.35pt;margin-bottom:.0001pt;text-align:justify;text-indent:\r\n-15.4pt;mso-list:l0 level2 lfo1;tab-stops:40.4pt\"><span lang=\"EN-US\">(1)<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\">&nbsp;&nbsp;\r\n</span></span><!--[endif]--><span lang=\"EN-US\">Saat<span style=\"letter-spacing:\r\n.35pt\"> </span>ini,<span style=\"letter-spacing:.3pt\"> </span>menurut<span style=\"letter-spacing:.35pt\"> </span>ahli<span style=\"letter-spacing:.25pt\"> </span>kependudukan,<span style=\"letter-spacing:.35pt\"> </span>tingkat<span style=\"letter-spacing:.4pt\"> </span>pertumbuhan<span style=\"letter-spacing:.3pt\"> </span>secara<span style=\"letter-spacing:.3pt\"> </span>nasional<span style=\"letter-spacing:.25pt\"> </span>memang<span style=\"letter-spacing:.3pt\"> </span>hanya<span style=\"letter-spacing:.25pt\"> </span>1,98<o:p></o:p></span></p>\r\n\r\n<span lang=\"EN-US\" style=\"font-size:11.0pt;font-family:&quot;Calibri&quot;,sans-serif;\r\nmso-fareast-font-family:Calibri;mso-ansi-language:EN-US;mso-fareast-language:\r\nEN-US;mso-bidi-language:AR-SA\">% per tahun. (2) Namun, angka itu harus tetap\r\ndiwaspadai. (3) Alasannya, usaha menurunkan tingkat<span style=\"letter-spacing:\r\n.05pt\"> </span>pertumbuhan<span style=\"letter-spacing:.05pt\"> </span>saat<span style=\"letter-spacing:.05pt\"> </span>ini<span style=\"letter-spacing:.05pt\"> </span>belum<span style=\"letter-spacing:.05pt\"> </span>mantap,<span style=\"letter-spacing:.05pt\">\r\n</span>apalagi<span style=\"letter-spacing:.05pt\"> </span>terdapat<span style=\"letter-spacing:.05pt\"> </span>variasi<span style=\"letter-spacing:.05pt\">\r\n</span>pertumbuhan<span style=\"letter-spacing:.05pt\"> </span>penduduk<span style=\"letter-spacing:.05pt\"> </span>di<span style=\"letter-spacing:.05pt\"> </span>berbagai<span style=\"letter-spacing:.05pt\"> </span>daerah. (4) Mungkin ada yang jauh di atas\r\nrata-rata. (5) Kalimantan Timur misalnya, mencapai 4,4 % per<span style=\"letter-spacing:-2.35pt\"> </span>tahun, pulau Sumatera 2,67 %, sementara\r\ndaerah-daerah yang program KB-nya berhasil seperti pulau<span style=\"letter-spacing:\r\n.05pt\"> </span>Jawa hanya<span style=\"letter-spacing:-.15pt\"> </span>1,6 %.</span><b><br></b></div><div><span lang=\"EN-US\" style=\"font-size:11.0pt;font-family:&quot;Calibri&quot;,sans-serif;\r\nmso-fareast-font-family:Calibri;mso-ansi-language:EN-US;mso-fareast-language:\r\nEN-US;mso-bidi-language:AR-SA\"><p class=\"MsoListParagraph\" style=\"margin-left:1.0cm;text-indent:-21.4pt;\r\nmso-list:l0 level1 lfo1;tab-stops:28.4pt\"><span lang=\"EN-US\"><br></span></p><p class=\"MsoListParagraph\" style=\"margin-left:1.0cm;text-indent:-21.4pt;\r\nmso-list:l0 level1 lfo1;tab-stops:28.4pt\"><span lang=\"EN-US\">Yang<span style=\"letter-spacing:\r\n-.15pt\"> </span>bukan<span style=\"letter-spacing:-.1pt\"> </span>opini<span style=\"letter-spacing:-.1pt\"> </span>dalam paragraf<span style=\"letter-spacing:\r\n-.1pt\"> </span>di<span style=\"letter-spacing:-.1pt\"> </span>atas<span style=\"letter-spacing:-.1pt\"> </span>adalah<span style=\"letter-spacing:-.25pt\">\r\n</span>kalimat<span style=\"letter-spacing:-.05pt\"> </span>nomor....<o:p></o:p></span></p></span></div>', '1', '2', '3', '4', '5', 'a', '', '0000-00-00', 'N'),
(79, '<b>Bacalah paragraf deskripsi berikut!</b><div><b><br></b></div><div><span lang=\"EN-US\" style=\"font-size:11.0pt;font-family:\r\n&quot;Calibri&quot;,sans-serif;mso-fareast-font-family:Calibri;mso-ansi-language:EN-US;\r\nmso-fareast-language:EN-US;mso-bidi-language:AR-SA\">Pernahkah Anda melihat\r\nBadak bercula satu ? Culanya terdapat di atas moncong melengkung seperti<span style=\"letter-spacing:-2.35pt\"> </span>gading<span style=\"letter-spacing:-.1pt\">\r\n</span>Gajah.<span style=\"letter-spacing:-.1pt\"> </span>Postur<span style=\"letter-spacing:-.1pt\"> </span>tubuhnya<span style=\"letter-spacing:-.1pt\">\r\n</span>lebih<span style=\"letter-spacing:-.1pt\"> </span>pendek<span style=\"letter-spacing:-.05pt\"> </span>daripada<span style=\"letter-spacing:-.2pt\">\r\n</span>Kerbau.<span style=\"letter-spacing:-.1pt\"> </span>Kakinya<span style=\"letter-spacing:-.1pt\"> </span>pendek,<span style=\"letter-spacing:-.1pt\">\r\n</span>begitu<span style=\"letter-spacing:-.1pt\"> </span>pula<span style=\"letter-spacing:-.1pt\"> </span>ekornya...</span></div><div><span lang=\"EN-US\" style=\"font-size:11.0pt;font-family:\r\n&quot;Calibri&quot;,sans-serif;mso-fareast-font-family:Calibri;mso-ansi-language:EN-US;\r\nmso-fareast-language:EN-US;mso-bidi-language:AR-SA\"><br></span></div><div><span lang=\"EN-US\" style=\"font-size:11.0pt;font-family:\r\n&quot;Calibri&quot;,sans-serif;mso-fareast-font-family:Calibri;mso-ansi-language:EN-US;\r\nmso-fareast-language:EN-US;mso-bidi-language:AR-SA\">Kalimat&nbsp;</span><span style=\"font-family: Calibri, sans-serif; font-size: 11pt;\">yang</span><span style=\"font-family: Calibri, sans-serif; font-size: 11pt; letter-spacing: -0.25pt;\"> </span><span style=\"font-family: Calibri, sans-serif; font-size: 11pt;\">tepat</span><span style=\"font-family: Calibri, sans-serif; font-size: 11pt; letter-spacing: -0.2pt;\"> </span><span style=\"font-family: Calibri, sans-serif; font-size: 11pt;\">untuk</span><span style=\"font-family: Calibri, sans-serif; font-size: 11pt; letter-spacing: -0.25pt;\"> </span><span style=\"font-family: Calibri, sans-serif; font-size: 11pt;\">melengkapi</span><span style=\"font-family: Calibri, sans-serif; font-size: 11pt; letter-spacing: -0.1pt;\"> </span><span style=\"font-family: Calibri, sans-serif; font-size: 11pt;\">paragraf</span><span style=\"font-family: Calibri, sans-serif; font-size: 11pt; letter-spacing: -0.1pt;\"> </span><span style=\"font-family: Calibri, sans-serif; font-size: 11pt;\">deskripsi</span><span style=\"font-family: Calibri, sans-serif; font-size: 11pt; letter-spacing: -0.15pt;\"> </span><span style=\"font-family: Calibri, sans-serif; font-size: 11pt;\">tersebut</span><span style=\"font-family: Calibri, sans-serif; font-size: 11pt; letter-spacing: -0.2pt;\">\r\n</span><span style=\"font-family: Calibri, sans-serif; font-size: 11pt;\">adalah...</span></div>', 'Badak bercula satu berada di Taman Ujung Kulon', 'Taman Nasional Ujung Kulon masuk wilayah Kabupaten Pandeglang', 'Jika beruntung dapat melihat aktivitas binatang tersebut', 'Taman Nasional Ujung Kulon untuk pelestarian Badak bercula satu', 'Tubuhnya gemuk dan moncongnya agak panjang', 'a', '', '0000-00-00', 'N'),
(81, 'SMP AL IKHLAS akan membangun lapangan basket. Padahal sudah tidak ada lagi lahan kosong di SMP AL IKHLAS. Satu-satunya tempat yang dimungkinkan menjadi lapangan basket adalah taman sekolah. Taman itu letaknya di depan deretan kelas. Oleh para siswa, taman itu dijadikan tempat bersantai saat istirahat tiba.Guru-guru dan siswa juga seringkali melakukan kegiatan pembelajaran di sana. Kepala sekolah telah memutuskan untuk mengubah taman itu menjadi lapangan basket tanpa pertimbangan dari guru dan siswa.<br><div><br></div><div>Kritikan yang tepat terhadap sikap kepala sekolah adalah â€¦<br></div>', 'Kepala sekolah perlu mengadakan pembicaraan dengan siswa dan guru mengenai rencana pengubahan taman ', 'Lapangan basket juga sangat diperlukan ada baiknya taman sekolah diubah menjadi lapangan basket namu', 'Kepala sekolah perlu mempertimbangkan keputusan yang diambilnya.', 'Kepala sekolah perlu melakukan pembicaraan dengan guru dan siswa mengenai taman sekolah.', 'Kegiatan pembelajaran sering dilakukan oleh guru dan siswa', 'a', '', '0000-00-00', 'N'),
(82, '<div>Penanganan masalah penyalahgunaan narkoba tidak dilakukan dengan tuntas. Banyak peristiwa narkoba yang hilang begitu saja tanpa diketahui proses hukum berikutnya. Satu peristiwa yang mengoyak hati masyarakat adalah vonis 20 tahun penjara terhadap terdakwa pemilik hampir 1 ton narkoba yang ditemukan di Teluk Naga. Semestinya vonis yang dijatuhkan kepada pemilik pabrik narkoba tersebut adalah hukuman mati atau seumur hidup.</div><div><br></div><div>Informasi yang bertentangan pada kutipan berita tersebut adalah â€¦</div><div><br></div>', 'Seharusnya vonis hukuman mati atau seumur hidup, kenyataannya lebih ringan dari itu.', 'Vonis pemilik hampir 1 ton narkoba adalah hukuman mati atau seumur hidup', 'Banyak peristiwa narkoba yang hilang begitu saja tanpa proses hukum yang jelas.', 'Peredaran gelap narkoba tidak ditangani secara serius sehingga mengoyak hati masyarakat.', 'Vonis dijatuhkan kepada pemilik pabrik narkoba', 'a', '', '0000-00-00', 'N'),
(83, '<div><b>Tajuk rencana berikut untuk menjawab soal nomor 20, Bacalah dengan cermat!</b></div><blockquote style=\"margin: 0 0 0 40px; border: none; padding: 0px;\"><div>Awak angkutan bus kota rupanya tidak mau ketinggalan dengan menjulangnya harga sembako.</div></blockquote><div>Mereka ada yang menaikkan tarif bus kota reguler dari Rp 300,00 per penumpang.</div><div>Bagi masyarakat kecil, uang Rp 200,00 untuk tambahan ongkos bus kota memang akan mempengaruhi biaya hidup mereka. Bila bolak-balik berarti sehari harus menambah Rp 400,00 per hari. Bila sebulan Rp 10.000,00 tambahnya.</div><div>Awak angkutan juga pusing menghadapi naiknya harga beras, gula, minyak goreng dan kebutuhan lainnya. Belum lagi tuntutan biaya sekolah anak, padahal penghasilannya tetap.</div><div>Persoalannya adalah penumpang bus reguler tentu orang berkantong serba pas. Bisa jadi serba kurang, sehingga tambahan pengeluaran Rp 10.000,00 per bulan bisa bikin pusing.</div><div>Maka apapun alasan awak angkutan menaikkan tarif di luar aturan sulit dibenarkan. Mereka harus menyadari kondisinya sekarang, sama-sama kerepotan untuk memenuhi hidup sehari-hari, sopir susah, rakyat kecil pun susah.</div><div><br></div><div>Kalimat utama yang terdapat pada paragraf pertama adalah...</div><div><br></div>', 'awak angkutan bus kota', 'tarif bus kota reguler', 'menjulangnya harga sembako', 'kenaikan tarif bus reguler', 'Alasan awak angkutan menaikkan tarif', 'a', '', '0000-00-00', 'N'),
(84, '<div><b>Tes Deret Angka</b></div><div><i>Pilih satu jawaban yang sesuai dengan pola angka yang dibentuk.</i></div><div><i><br></i></div><div>1/3 4/5 3/2&nbsp; &nbsp;8/3 5&nbsp; &nbsp;â€¦<br></div><div><br></div>', '12', '10', '9/5', '5/2', '3/5', 'a', '', '0000-00-00', 'Y'),
(85, '405 127 278 128 150 129 â€¦<br>', '427', '12', '249', '21', '247', 'a', '', '0000-00-00', 'N'),
(86, '-8271 16542 24813 -8270 16540 24810 -8269 â€¦<br>', '16538 24813', '16538 24807', '-16542 24807', '16542 24813', '16542 -24807', 'a', '', '0000-00-00', 'N'),
(87, '3 2&nbsp; &nbsp;4 6&nbsp; &nbsp;8&nbsp; &nbsp;7 9&nbsp; &nbsp;â€¦&nbsp; &nbsp;13&nbsp; &nbsp;12<br>', '12', '11,5', '11', '10,5', '10', 'a', '', '0000-00-00', 'N'),
(88, '100% 4/3 Â¾&nbsp; &nbsp;-2/3&nbsp; &nbsp;Â½&nbsp; &nbsp;-8/3&nbsp; &nbsp;â€¦&nbsp;<br>', '25%    -4/3', 'Â¼	125%', '25% -4,67', '0%	-1,33', 'Â¼	-1,67', 'a', '', '0000-00-00', 'N'),
(89, '<div><b>Tes Numerik</b></div><div><i>Pilih satu jawaban yang paling tepat!</i></div><div><i><br></i></div><div>Sebuah bangun ruang berada di atas lantai dan disusun oleh 12 kubus-kubus kecil yang bervolume 8 cmÂ³. Tinggi bangun ruang tersebut adalah 2 kubus dan ternyata tingginya sama dengan lebar bangun ruang tersebut. Jika bangun ruang tersebut dijadikan meja dan diatasnya diberi taplak&nbsp;berbentuk segi empat yang semua ujung-ujungnya menyentuh lantai sehingga tidak terlihat lagi kubus-kubus kecil tersebut, maka berapakah luas taplak yang dibutuhkan?<br></div><div><br></div><div><br></div><div><br></div>', '100 cmÂ²', '144 cmÂ²', '168 cmÂ²', '188 cmÂ²', '200 cmÂ²', 'a', '', '0000-00-00', 'Y'),
(90, 'Sebuah kolam air mancur berbentuk lingkaran yang kelilingnya 44 m. Sekeliling kolam tersebut dibangun jalan yang lebarnya 3,5 m. Berapakah luas jalan yang dibangun?<br>', '154 mÂ²', '154 mÂ²', '154 mÂ²', '154 mÂ²', '154 mÂ²', 'a', '', '0000-00-00', 'N'),
(91, 'Fory mengadakan pesta untuk pertama kali. Dia mengundang 10 kawan perempuan dan 15 kawan laki-lakinya serta menghabiskan roti 6,5 Kg. Kemudian dia mengadakan pesta kedua dan mengundang 25 kawan laki-laki dan 20 kawan perempuan serta menghabiskan roti 15 Kg. Jika Fory ingin mengundang 50 kawan perempuan dan 50 kawan laki-lakinya, sedangkan dia masih punya 10 Kg roti, berapa Kg roti lagi yang harus dia persiapkan?<br>', '43,75 Kg', '32,5 Kg', '31,75 Kg', '42,5 Kg', '52,5 Kg', 'a', '', '0000-00-00', 'N'),
(92, 'Sheanie, Niesa, dan Dita masing-masing membawa lidi yang panjangnya 12 cm, 5 cm, dan 13 cm. Jika ujung-ujung lidi dipertemukan di atas tanah, maka luas tanah maksimal yang dibentuk dari lidi- lidi tersebut adalah â€¦<br>', '65 cmÂ²', '30 cmÂ²', '60 cmÂ²', '780 cmÂ²', '156 cmÂ²', 'a', '', '0000-00-00', 'N'),
(93, 'Besar sudut pertama sebuah segitiga adalah dua kali besar sudut kedua. Sedangkan besar sudut ketiga adalah lima derajat lebih besar daripada sudut pertama. Berapakah ukuran sudut ketiga dikurangi sudut kedua?<br>', '75Â°', '70Â°', '40Â°', '35Â°', '5Â°', 'a', '', '0000-00-00', 'N'),
(94, '<div>Satu galon bensin dituangkan ke dalam sebuah pengisi yang berbentuk seperti kubus yang panjang sisinya 7 inci. Berapakah kira-kira tinggi bensin dalam pengisi tersebut ? (1 galon = 231 inci kubik)</div><div><br></div><div><br></div>', '3,8 inci', '4,2 inci', '4,7 inci', '5,2 inci', '5,6 inci', 'a', '', '0000-00-00', 'N'),
(95, 'Jika jari-jari lingkaran P adalah 60% dari jari-jari lingkaran Q, berapa persenkah luas lingkaran P dari luas lingkaran Q?<br>', '36', '40', '64', '80', '120', 'a', '', '0000-00-00', 'N'),
(96, 'Ki Agus telah menjual barang dengan harga Rp 95.000,- ia memperoleh laba 25% dari harga beli. Berapakah harga beli sebenarnya?<br>', 'Rp 88.000', 'Rp 80.000', 'Rp 77.000', 'Rp 76.000', 'Rp 64.000', 'a', '', '0000-00-00', 'N'),
(97, 'Cita bekerja di sebuah pabrik dari jam 08.00 hingga pukul 16.00. Ia diberikan upah Rp 800/jam. Apabila ia lembur, maka ia akan dibayar 50% per jam jika lewat dari jam 16.00. Jika ia menerima upah sebesar Rp 8.000 pada hari itu, maka pukul berapa ia pulang??<br>', '17.00', '17.50', '18.45', '19.30', '20.00', 'a', '', '0000-00-00', 'N'),
(98, 'Lembaran seng lebarnya 18/3 kaki (delapan belas per tiga kaki). 1 kaki = 16 cm. Lembaran ini akan dipotong-potong menjadi beberapa bagian yang masing-masing 4 inchi (1 inchi = 1 Â½ cm). Berapakah potongan yang akan dihasilkan dari lembaran tersebutâ€¦<br>', '18 potong', '17 potong', '16 potong', '15 potong', '14 potong', 'a', '', '0000-00-00', 'N'),
(99, '<div><b>LOGIKA ANALISA</b></div><div><i>Pilih satu jawaban dengan menggunakan Logika Analisa</i></div><div><i><br></i></div><div><i><br></i></div><div>Dalam sebuah acara biro jodoh, terdapat beberapa fakta menarik berikut ini. Bram berusia 37 tahun dan berprofesi sebagai pengamat ekonomi. Dia tertarik dengan wanita yang usianya tidak lebih tua dari 30 tahun. Nurul tertarik dengan lelaki selain suku Jawa. Usia Nurul setahun lebih muda dibandingkan Dian. Dian tertarik dengan pria Jawa yang usianya dibawahnya. Fajri tertarik dengan perempuan kuning langsat yang berprofesi sebagai akuntan. Fajri berusia 5 tahun di bawah Nurul. Fajri seorang dokter yang&nbsp;berasal dari Papua. Fajri tidak tertarik dengan perempuan yang lebih muda dari dirinya. Dita hanya ingin menjadi istri seorang dokter. Usia Dita 3 tahun lebih muda dari usia Dian. Sedangkan usia Nurul sekarang adalah 31 tahun. Siapakah yang hampir tidak berpeluang mendapatkan jodoh?<br></div><div><br></div>', 'Om Bram dan Neng Dita', 'Neng Dita dan Ibu Nurul', 'Tante Dian dan Om Bram', 'Ibu Nurul dan Tante Dian', 'Bang Fajri dan Neng Dita', 'a', '', '0000-00-00', 'Y'),
(100, 'Di sebuah bioskop terdapat fakta menarik. Sebuah keluarga dan pembantunya menonton film di bioskop. Irsyad tidak mau duduk bersebelahan dengan perempuan yang bukan mukhrimnya. Tapi ia juga tidak mau duduk di posisi yang paling pinggir. Aji hanya mau duduk bersebelahan dengan Bima. Chyntia tidak ingin duduk bersebelahan dengan Bima karena selalu menggodanya. Yuri tidak mau duduk di samping Aji. Hal ini karena Aji selalu memarahi dirinya sebagai pembantu rumah tangga yang kurang gesit. Posisi duduk di bioskop yang paling tepat adalah â€¦<br>', 'Yuri, Irsyad, Bima, Aji, Cynthia', 'Bima, Aji, Irsyad, Cynthia, Yuri', 'Cynthia, Aji, Irsyad, Bima, Yuri', 'Cynthia, Bima, Aji, Irsyad, Yuri', 'Cynthia, Irsyad, Bima, Aji, Yuri', 'a', '', '0000-00-00', 'N'),
(101, 'Sebuah keluarga hendak memasak untuk makan malam. Ayah suka sayuran kecuali kangkung. Ayah makan harus ada sayur dan lauknya. Ibu tidak boleh makan makanan yang ada unsur kangkung dan udangnya oleh dokter. Kakak suka udang goreng tetapi tidak suka sayuran. Adik tidak suka sayuran kecuali kangkung. Adik punya alergi udang. Komposisi menu yang tepat untuk masakan malam itu adalah â€¦<br>', 'Sayur kangkung 2 porsi, soup 1 porsi dan udang goreng 1 porsi', 'Sayur kangkung 1 porsi, soup 2 porsi dan udang goreng 1 porsi', 'Sayur kangkung 1 porsi, soup 1 porsi dan udang goreng 2 porsi', 'Sayur kangkung 2 porsi, soup 2 porsi dan udang goreng 1 porsi', 'Sayur kangkung 1 porsi, soup bayam 2 porsi dan udang goreng 2 porsi', 'a', '', '0000-00-00', 'N'),
(102, '<div>Satu negara hanya dipimpin dan diatur oleh seorang Presiden. Negara Belanda dipimpin oleh seorang Presiden dan seorang Ratu. Jika satu hal diatur oleh lebih dari satu pengatur, maka akan mengalami kekacauan. Alam semesta ini sangat teratur. Alam semesta tidak mungkin dipimpin oleh lebih dari satu pengatur. Kesimpulan yang tidak salah dari berbagai pernyataan di atas adalah â€¦</div><div><br></div><div><br></div>', 'Jika ada lebih dari satu Tuhan maka pengaturan alam semesta akan tertib.', 'Tuhan itu esa walaupun tidak mengatur alam semesta.', 'Kedudukan Presiden sama dengan kedudukan Ratu.', 'Negara Belanda tidak dipimpin oleh seorang Ratu.', 'Negara akan kacau jika dipimpin oleh seorang Ratu.', 'a', '', '0000-00-00', 'N'),
(103, 'Membunuh orang tanpa alasan yang jelas itu haram. Membunuh wanita tua dan anak-anak yang tidak melawan itu tidak dibenarkan walaupun mereka kafir. Para pembunuh berhak untuk dibunuh. Orang kafir juga berhak dibunuh jika memerangi orang yang beriman. Upaya melawan dan membunuh orang kafir bisa dilakukan dengan Jihad. Namun, jihad bukan hanya berjuang melawan orang kafir saja. Hanya orang yang beriman yang mentaati aturan-aturan itu. Imam Samudra meledakkan bom untuk&nbsp;<span style=\"font-size: 1rem;\">membunuh</span><span style=\"font-size: 1rem; letter-spacing: 0.3pt;\"> </span><span style=\"font-size: 1rem;\">orang</span><span style=\"font-size: 1rem; letter-spacing: 0.25pt;\"> </span><span style=\"font-size: 1rem;\">kafir</span><span style=\"font-size: 1rem; letter-spacing: 0.3pt;\"> </span><span style=\"font-size: 1rem;\">yang</span><span style=\"font-size: 1rem; letter-spacing: 0.35pt;\"> </span><span style=\"font-size: 1rem;\">tidak</span><span style=\"font-size: 1rem; letter-spacing: 0.3pt;\"> </span><span style=\"font-size: 1rem;\">melakukan</span><span style=\"font-size: 1rem; letter-spacing: 0.35pt;\">\r\n</span><span style=\"font-size: 1rem;\">perlawanan.</span><span style=\"font-size: 1rem; letter-spacing: 0.3pt;\"> </span><span style=\"font-size: 1rem;\">Kesimpulan</span><span style=\"font-size: 1rem; letter-spacing: 0.35pt;\"> </span><span style=\"font-size: 1rem;\">yang</span><span style=\"font-size: 1rem; letter-spacing: 0.35pt;\"> </span><span style=\"font-size: 1rem;\">salah</span><span style=\"font-size: 1rem; letter-spacing: 0.35pt;\"> </span><span style=\"font-size: 1rem;\">dari</span><span style=\"font-size: 1rem; letter-spacing: 0.4pt;\"> </span><span style=\"font-size: 1rem;\">data-data</span><span style=\"font-size: 1rem; letter-spacing: 0.2pt;\"> </span><span style=\"font-size: 1rem;\">di</span><span style=\"font-size: 1rem; letter-spacing: 0.35pt;\"> </span><span style=\"font-size: 1rem;\">atas</span><span style=\"font-size: 1rem; letter-spacing: -2.3pt;\"> </span><span style=\"font-size: 1rem;\">adalah â€¦</span><p class=\"MsoBodyText\" style=\"margin-top:1.8pt;margin-right:0cm;margin-bottom:\r\n0cm;margin-left:7.0pt;margin-bottom:.0001pt\"><span lang=\"EN-US\"><o:p></o:p></span></p>', 'Perbuatan Imam Samudra tidak dibenarkan.', 'Perbuatan membunuh orang secara sembarangan tidak dilakukan oleh orang yang beriman.', 'Orang kafir yang membunuh orang yang beriman berhak untuk dibunuh.', 'Imam Samudra berhak untuk dibunuh karena telah membunuh banyak orang secara sembarangan.', 'Imam Samudra adalah seorang teroris karena meledakkan bom dan berhak dibunuh.', 'a', '', '0000-00-00', 'N'),
(104, 'Baju-baju yang dijual di toko pakaian â€œMewahâ€ tidak ada yang memiliki renda. Neni membeli sebuah baju berenda di toko pakaian remaja.<br><div><br></div><div>Kesimpulan:<br></div>', 'Baju berenda hanya ada di toko pakaian remaja.', 'Neni tidak pernah membeli baju di toko pakaian â€œMewahâ€', 'Di toko pakaian â€œMewahâ€ tidak ada pakaian remaja.', 'Toko pakaian â€œMewahâ€ adalah satu-satunya toko yang tidak menjual baju berenda.', 'Baju berenda Neni tidak dibeli di toko pakaian â€œMewahâ€', 'a', '', '0000-00-00', 'N'),
(105, '<div>Pabrik roti M hanya membuat roti dengan bahan dasar tepung beras atau tepung jagung. Untuk bulan ini, roti â€œpisang crispyâ€ tidak dibuat dengan menggunakan tepung beras.</div><div><br></div><div>Kesimpulan:</div><div><br></div>', 'Roti â€œpisang crispyâ€ selalu dibuat dengan menggunakan tepung jagung.', 'Untuk bulan ini pabrik roti M hanya membuat roti dengan bahan dasar tepung jagung.', 'Roti â€œpisang crispyâ€ selalu dibuat dengan menggunakan bahan dasar tepung beras.', 'Pabrik roti M hanya membuat roti â€œpisang crispyâ€ pada bulan ini.', 'Untuk bulan ini roti â€œpisang crispyâ€ dibuat dengan menggunakan tepung jagung.', 'a', '', '0000-00-00', 'N'),
(106, 'Semua orang Jogja ramah dan baik hati. Nafis orang Jogja.<br>', 'Nafis orangnya baik hati.', 'Nafis orang yang ramah.', 'Nafis baik hati dan ramah.', 'Nafis tinggal di Jogja.', 'A, B, C, D tidak benar.', 'd', '', '0000-00-00', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(40) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nama` text NOT NULL,
  `tgl_lahir` varchar(30) NOT NULL,
  `jk` varchar(20) NOT NULL,
  `email` varchar(80) NOT NULL,
  `telp` varchar(13) NOT NULL,
  `alamat` text NOT NULL,
  `statusaktif` enum('Y','N') NOT NULL DEFAULT 'Y',
  `stat_tes` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id_user`, `username`, `password`, `nama`, `tgl_lahir`, `jk`, `email`, `telp`, `alamat`, `statusaktif`, `stat_tes`) VALUES
(121, 'tubagus', '9fb9d88ca649985894292a6ce968ede6', 'Tubagus Syarif H', '1996-08-12', 'Pria', 'tubagus_sh@yahoo.com', '087831561131', 'Nagrak Sukabumi', 'Y', 'Sudah'),
(152, 'dini', '83476316a972856163fb987b861a0a2c', 'Dini agustian', '1986-11-05', 'Perempuan', 'dini@gmail.com', '087644443333', 'Nagrak', 'Y', ''),
(117, 'robby', '8d05dd2f03981f86b56c23951f3f34d7', 'Robby Takdirillah', '1997-12-03', 'Pria', 'robbytakdirillah@gmail.com', '085210245372', 'Nagrak Sukabumi', 'Y', 'Sudah'),
(118, 'yoga', '807659cd883fc0a63f6ce615893b3558', 'Yoga Permana', '1997-10-11', 'Pria', 'yogaprrmn@gmail.com', '085234561234', 'Ciaul Sukabumi', 'Y', 'Sudah'),
(153, 'Yuffi', '85064efb60a9601805dcea56ec5402f7', 'Yuffi Aulia', '2000-06-13', 'Pria', 'Yuffi@gmail.com', '08222918102', 'Banda Aceh', 'Y', 'Sudah');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `tbl_nilai`
--
ALTER TABLE `tbl_nilai`
  ADD PRIMARY KEY (`id_nilai`);

--
-- Indexes for table `tbl_pengaturan_tes`
--
ALTER TABLE `tbl_pengaturan_tes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_soal`
--
ALTER TABLE `tbl_soal`
  ADD PRIMARY KEY (`id_soal`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id_admin` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_nilai`
--
ALTER TABLE `tbl_nilai`
  MODIFY `id_nilai` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `tbl_pengaturan_tes`
--
ALTER TABLE `tbl_pengaturan_tes`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_soal`
--
ALTER TABLE `tbl_soal`
  MODIFY `id_soal` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=154;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
