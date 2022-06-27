<?php
session_start();
include "../../../config/koneksi.php";
include "../../../config/fungsi_thumb.php";

$module=$_GET['module'];
$act=$_GET['act'];

if ($module=='hasiltes' AND $act=='hapus') {
	mysqli_query($conn, "DELETE FROM `nilai` WHERE `id_user` = '$_GET[id]';");
  header('Location:../../media.php?module='.$module);
}
