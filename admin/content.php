<?php
include "../config/koneksi.php";
include "../config/library.php";
include "../config/fungsi_indotgl.php";

// Bagian User
if ($_GET['module']=='home'){
  include "header.php";
  include "modul/mod_home/home.php";
}
elseif ($_GET['module']=='soal'){
  include "header.php";
  include "modul/mod_soal/soal.php";
}
elseif ($_GET['module']=='hasiltes'){
  include "header.php";	
  include "modul/mod_hasiltes/hasiltes.php";
}
elseif ($_GET['module']=='pengaturantes'){
  include "header.php";	
  include "modul/mod_pengaturantes/pengaturantes.php";
}
elseif ($_GET['module']=='users') {
	include "header.php";
	include "modul/mod_users/users.php";
}
elseif ($_GET['module']=='pengguna'){
  include "header.php";
  include "modul/mod_pengguna/pengguna.php";
}
elseif ($_GET['module']=='tentang'){
  include "header.php";
  include "modul/mod_tentang/tentang.php";
}
// Apabila modul tidak ditemukan
else{
  echo "<p><a href='media?module=home' target='_blank' rel='noopener noreferrer'>404 HALAMAN TIDAK DITEMUKAN</a></p>";
}
?>
