-- phpMyAdmin SQL Dump
-- version 3.5.2
-- http://www.phpmyadmin.net
--
-- Inang: localhost
-- Waktu pembuatan: 07 Nov 2019 pada 14.58
-- Versi Server: 5.5.25a
-- Versi PHP: 5.4.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Basis data: `psikotesonline`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_admin`
--

CREATE TABLE IF NOT EXISTS `tbl_admin` (
  `id_admin` int(3) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  PRIMARY KEY (`id_admin`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data untuk tabel `tbl_admin`
--

INSERT INTO `tbl_admin` (`id_admin`, `username`, `password`) VALUES
(2, 'admin', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_nilai`
--

CREATE TABLE IF NOT EXISTS `tbl_nilai` (
  `id_nilai` int(7) NOT NULL AUTO_INCREMENT,
  `id_user` int(5) NOT NULL,
  `benar` varchar(20) NOT NULL,
  `salah` varchar(20) NOT NULL,
  `kosong` varchar(20) NOT NULL,
  `score` varchar(20) NOT NULL,
  `tanggal` date NOT NULL,
  `keterangan` varchar(30) NOT NULL,
  PRIMARY KEY (`id_nilai`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=62 ;

--
-- Dumping data untuk tabel `tbl_nilai`
--

INSERT INTO `tbl_nilai` (`id_nilai`, `id_user`, `benar`, `salah`, `kosong`, `score`, `tanggal`, `keterangan`) VALUES
(55, 121, '6', '4', '7', '35.3', '2019-04-17', 'Tidak Lulus'),
(52, 118, '16', '1', '0', '94.1', '2019-04-14', 'Lulus'),
(51, 117, '15', '1', '1', '90.2', '2019-04-14', 'Lulus');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_pengaturan_tes`
--

CREATE TABLE IF NOT EXISTS `tbl_pengaturan_tes` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `nama_tes` varchar(50) NOT NULL,
  `waktu` varchar(20) NOT NULL,
  `nilai_min` varchar(20) NOT NULL,
  `peraturan` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data untuk tabel `tbl_pengaturan_tes`
--

INSERT INTO `tbl_pengaturan_tes` (`id`, `nama_tes`, `waktu`, `nilai_min`, `peraturan`) VALUES
(1, ' Tes Psikotes PT. Selamat Lestari Mandiri Sukabumi', '30', '75', '<ol><li>Bacalah Doa terlebih dahulu</li><li>&nbsp;Bacalah soal tes psikotes yang diujikan dengan teliti tiap-tiap soal sebelum menjawab</li><li>Pengerjaan soal tes psikotes diberikan batasan waktu apabila waktu telah habis maka anda tidak dapat mengisi&nbsp; ataupun mengoreksi kembali jawaban dari soal yang tersedia.</li><li>Hasil psikotes akan ditampilkan setelah menyelesaikan tes psikotes.</li><li>Follow IG si obet<br></li></ol>');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_soal`
--

CREATE TABLE IF NOT EXISTS `tbl_soal` (
  `id_soal` int(5) NOT NULL AUTO_INCREMENT,
  `soal` text NOT NULL,
  `a` varchar(100) NOT NULL,
  `b` varchar(100) NOT NULL,
  `c` varchar(100) NOT NULL,
  `d` varchar(100) NOT NULL,
  `e` varchar(100) NOT NULL,
  `knc_jawaban` varchar(30) NOT NULL,
  `gambar` varchar(100) NOT NULL,
  `tanggal` date NOT NULL,
  `aktif` enum('Y','N') NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`id_soal`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=53 ;

--
-- Dumping data untuk tabel `tbl_soal`
--

INSERT INTO `tbl_soal` (`id_soal`, `soal`, `a`, `b`, `c`, `d`, `e`, `knc_jawaban`, `gambar`, `tanggal`, `aktif`) VALUES
('', 'EKSKAVASI = ', 'Pengeboran', 'Pemindahan', 'Penggalian', 'Penyulingan', 'Pengangkutan', 'c', '', '0000-00-00', 'Y'),
('', 'ARKETIPE = ', 'Simbol', 'Model', 'Arsip', 'Fosil', 'Artefak', 'b', '', '0000-00-00', 'Y'),
('', 'EKSENTRIK = ', 'Aneh', 'Unik', 'Antik', 'Artistik', 'Etnik', 'a', '', '0000-00-00', 'Y'),
('', 'PEMANTULAN = ', 'Refleksi', 'Refraksi', 'Transformasi', 'Transmisi', 'Transmutasi', 'a', '', '0000-00-00', 'Y'),
('', 'KULMINASI = ', 'Keadaan emosi seseorang', 'Tempat untuk mendinginkan', 'Sumbu bumi', 'Panas terik matahari', 'Tingkatan yang tertinggi', 'e', '', '0000-00-00', 'Y'),
('', 'DISKREPANSI X ', 'Kecocokan', 'Ketimpangan', 'Keterkaitan', 'Keseragaman', 'Keakraban', 'a', '', '0000-00-00', 'Y'),
('', 'TENTATIF X ', 'Cepat', 'Lancar', 'Praktis', 'Pasti', 'Tepat', 'd', '', '0000-00-00', 'Y'),
('', 'NISBI X ', 'Benar', 'Penting', 'Harus', 'Mutlak', 'Pasti', 'd', '', '0000-00-00', 'Y'),
('', 'LATEN X ', 'Tersembunyi', 'Jelas', 'Tampak', 'Terang', 'Ada', 'c', '', '0000-00-00', 'Y'),
('', 'SPORADIS X ', 'Sering', 'Sembarangan', 'Terukur', 'Jarang', 'Serius', 'a', '', '0000-00-00', 'Y');

-- (24, 'Semua jenis burung bisa terbang. Semua ayam memiliki sayap', 'Semua burung memiliki sayap', 'Semua ayam bisa terbang', 'Semua ayam termasuk jenis burung', 'Semua ayam bukan termasuk jenis burung', 'd', '', '0000-00-00', 'Y'),
-- (25, '24 20 16 12 = ....', '10', '8', '6', '4', 'd', '', '0000-00-00', 'Y'),
-- (22, 'Fiktif : Fakta', 'Dongeng : Peristiwa', 'Rencana : Projeksi', 'Dugaan : Rekaan', 'Dagelan : Sandiwara', 'a', '', '0000-00-00', 'Y'),
-- (49, 'Gambar yang selanjutnya adalah . . .&nbsp;', 'Gambar A', 'Gambar B', 'Gambar C', 'Gambar D', 'c', '15p3-b.jpg', '2019-05-01', 'Y'),
-- (30, 'Pedati : Kuda = Pesawat Terbang :&nbsp;', 'Baling-Baling', 'Pilot', 'Landasan', 'Sayap', 'a', '', '0000-00-00', 'Y'),
-- (33, 'Perbandingan uang jajan Yoga dan uang jajan Sandi adalah 3:2, jika uang Yoga dan Sandi berjumlah Rp. 150.000, berapakah masing-masing uang Yoga dan Sandi ?', 'Rp. 80.000 dan Rp. 60.000', 'Rp. 90.000 dan Rp. 60.000', 'Rp. 90.000 dan Rp. 70.000', 'Rp. 100.000 dan Rp. 50.000', 'b', '', '0000-00-00', 'Y'),
-- (34, 'Putri membeli sebuah boneka seharga Rp. 50.000, kemudian ia jual lagi dengan harga Rp. 80.000. Berapa persenkah keuntungan Putri ?', '20%', '30%', '50%', '60%', 'd', '', '0000-00-00', 'Y'),
-- (35, 'Jika Raju senang maka nilainya tinggi, Jika nilainya tinggi maka ayah dan ibunya senang.<div>Kesimpulan yang dapat diambil dari premis diatas adalah ?</div>', 'Jika Raju senang maka nilainya tinggi', 'Jika nilai tinggi maka Raju akan senang', 'Jika Raju senang maka ayah dan ibunya senang', 'Jika nilai tinggi maka keluarga Raju akan membuat pesta', 'c', '', '0000-00-00', 'Y'),
-- (50, 'Gambar selanjutnya adalah . . . .', 'Gambar A', 'Gambar B', 'Gambar C', 'Gambar D', 'a', '79p4-a.jpg', '2019-05-01', 'Y'),
-- (37, '. . . . . . . = Interupsi', 'Penyelaan', 'Perbincangan', 'Pembicaraan', 'Kelebihan', 'a', '', '0000-00-00', 'Y'),
-- (40, 'Kepala : Pusing = Perut : . . . . . . .', 'Pilek', 'Gemuk', 'Mules', 'Batuk', 'c', '', '0000-00-00', 'Y');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_user`
--

CREATE TABLE IF NOT EXISTS `tbl_user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(40) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nama` text NOT NULL,
  `tgl_lahir` varchar(30) NOT NULL,
  `jk` varchar(20) NOT NULL,
  `email` varchar(80) NOT NULL,
  `telp` varchar(13) NOT NULL,
  `alamat` text NOT NULL,
  `statusaktif` enum('Y','N') NOT NULL DEFAULT 'Y',
  `stat_tes` varchar(10) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=153 ;

--
-- Dumping data untuk tabel `tbl_user`
--

INSERT INTO `tbl_user` (`id_user`, `username`, `password`, `nama`, `tgl_lahir`, `jk`, `email`, `telp`, `alamat`, `statusaktif`, `stat_tes`) VALUES
(121, 'tubagus', '9fb9d88ca649985894292a6ce968ede6', 'Tubagus Syarif H', '1996-08-12', 'Pria', 'tubagus_sh@yahoo.com', '087831561131', 'Nagrak Sukabumi', 'Y', 'Sudah'),
(152, 'dini', '83476316a972856163fb987b861a0a2c', 'Dini agustian', '1986-11-05', 'Perempuan', 'dini@gmail.com', '087644443333', 'Nagrak', 'Y', ''),
(117, 'robby', '8d05dd2f03981f86b56c23951f3f34d7', 'Robby Takdirillah', '1997-12-03', 'Pria', 'robbytakdirillah@gmail.com', '085210245372', 'Nagrak Sukabumi', 'Y', 'Sudah'),
(118, 'yoga', '807659cd883fc0a63f6ce615893b3558', 'Yoga Permana', '1997-10-11', 'Pria', 'yogaprrmn@gmail.com', '085234561234', 'Ciaul Sukabumi', 'Y', 'Sudah');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
