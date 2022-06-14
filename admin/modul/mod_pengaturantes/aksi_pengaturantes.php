<?php
session_start();
include "../../../config/koneksi.php";
include "../../../config/fungsi_thumb.php";

$module=$_GET['module'];
$act=$_GET['act'];

// Update pengaturantes
if ($module=='pengaturantes' AND $act=='update'){
    mysqli_query($conn, "UPDATE tbl_pengaturan_tes SET nama_tes = '$_POST[nama_tes]',		
								waktu = '$_POST[waktu]',
								nilai_min = '$_POST[nilai_min]',
								peraturan = '$_POST[peraturan]'
                            WHERE id      = '$_POST[id]'");
  header('location:../../media.php?module='.$module);
}
?>
