<?php 
  require '../../../config/koneksi.php';
  
  $total_que = 0;
  $category = $_GET['category'];
  $query  = mysqli_query($conn, "SELECT * FROM `soal` WHERE `id_kategori` = $category AND `aktif` = 'Y'; ");
  $total_que = mysqli_num_rows($query);

  echo $total_que;
