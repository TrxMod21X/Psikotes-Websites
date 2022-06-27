<?php
session_start();
if (!isset($_SESSION['login'])) {
  header('Location: authentication/auth.php');
  exit;
} else {
  require "../../../config/koneksi.php";
  require "../../../config/library.php";
  require "../../../config/fungsi_thumb.php";

  $module = $_GET['module'];
  $act = $_GET['act'];

  $idKategori = $_POST['kategori_soal'];
  $soal = $_POST['soal'];
  $jA = $_POST['a'];
  $jB = $_POST['b'];
  $jC = $_POST['c'];
  $jD = $_POST['d'];
  $jE = $_POST['e'];
  $kunci = $_POST['knc_jawaban'];

  // Tambah soal
  if ($module == 'soal' and $act == 'input') {
    $lokasi_file    = $_FILES['fupload']['tmp_name'];
    $tipe_file      = $_FILES['fupload']['type'];
    $nama_file      = $_FILES['fupload']['name'];
    $acak           = rand(1, 99);
    $nama_file_unik = $acak . $nama_file;


    // Apabila ada gambar yang diupload
    if (!empty($lokasi_file)) {

      UploadBanner($nama_file_unik);

      mysqli_query($conn, "INSERT INTO `soal` (`id`, `id_kategori`, `soal`, `a`, `b`, `c`, `d`, `e`, `kunci`, `gambar`, `tanggal`, `aktif`) VALUES (NULL, $idKategori, $soal, $jA, $jB, $jC, $jD, $jE, $kunci, $nama_file_unik, $tgl_sekarang, 'Y');");
    } else {
      mysqli_query($conn, "INSERT INTO `soal` (`id`, `id_kategori`, `soal`, `a`, `b`, `c`, `d`, `e`, `kunci`, `gambar`, `tanggal`, `aktif`) VALUES (NULL, '$idKategori', '$soal', '$jA', '$jB', '$jC', '$jD', '$jE', '$kunci', '', '$tgl_sekarang', 'Y');");
    }
    header('location:../../media.php?module=' . $module);
  }

  //Hapus Soal
  elseif ($module == 'soal' and $act == 'hapus') {
    mysqli_query($conn, "DELETE FROM `soal` WHERE `id` = '$_GET[id]';");
    header('location:../../media.php?module=' . $module);
  }

  // Update soal
  elseif ($module == 'soal' and $act == 'update') {
    $lokasi_file    = $_FILES['fupload']['tmp_name'];
    $tipe_file      = $_FILES['fupload']['type'];
    $nama_file      = $_FILES['fupload']['name'];
    $acak           = rand(1, 99);
    $nama_file_unik = $acak . $nama_file;


    // Apabila gambar tidak diganti
    if (empty($lokasi_file)) {

      $idSoal = $_POST['id'];

      mysqli_query($conn, "UPDATE `soal` SET `id_kategori` = '$idKategori', `soal` = '$soal', `a` = '$jA', `b` = '$jB', `c` = '$jC', `d` = '$jD', `e` = '$jE', `kunci` = '$kunci' WHERE `id` = '$idSoal';");
    } else {
      UploadBanner($nama_file_unik);

      mysqli_query($conn, "UPDATE `soal` SET `id_kategori` = '$idKategori', `soal` = '$soal', `a` = '$jA', `b` = '$jB', `c` = '$jC', `d` = '$jD', `e` = '$jE', `kunci` = '$kunci', `gambar` = '$nama_file_unik' WHERE `id` = '$idSoal';");

    }
    header('location:../../media.php?module=' . $module);
  }
  //Pengaktifan dan Pengnonaktifan
  elseif ($module == 'soal' and $act == 'nonaktif') {
    $aktif = 'N';
    mysqli_query($conn, "UPDATE `soal` SET `aktif` = '$aktif'  WHERE `id`= '$_GET[id]'");
    header('location:../../media.php?module=' . $module);
  } elseif ($module == 'soal' and $act == 'aktif') {
    $aktif = 'Y';
    mysqli_query($conn, "UPDATE `soal` SET `aktif` = '$aktif'  WHERE `id`= '$_GET[id]'");
    header('location:../../media.php?module=' . $module);
  }
}
