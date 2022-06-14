<?php
session_start();
include "../../../config/koneksi.php";
include "../../../config/fungsi_thumb.php";

$module=$_GET['module'];
$act=$_GET['act'];

if ($module=='hasiltes' AND $act=='hapus') {
	mysqli_query($conn, "DELETE FROM tbl_nilai WHERE id_nilai='$_GET[id]'");
  header('Location:../../media.php?module='.$module);
}
