<?php
session_start();
include "../../../config/koneksi.php";
include "../../../config/fungsi_thumb.php";

$module=$_GET['module'];
// var_dump($module);
$act=$_GET['act'];
// $pass=$_POST[katasandi];
// var_dump($pass);
// Update pengguna
$data = mysql_query("SELECT * FROM tbl_admin WHERE id_admin=");
$r = mysql_fetch_array($data);
if ($module=='pengguna' AND $act=='update'){
    mysql_query("UPDATE tbl_admin SET username = '$_POST[username]',		
								password = '".md5($_POST['katasandi'])."'
                            WHERE id_admin      = '$_POST[id]'");
  header('location:../../media.php?module='.$module);
}
if ($_POST['passwordold'] == $r[password]){
  ovo;
}
?>