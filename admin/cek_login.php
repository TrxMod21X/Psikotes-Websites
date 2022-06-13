<?php
require "../config/koneksi.php";
$username = $_POST['username'];
$password = md5($_POST['password']);


$sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";

$qry = mysqli_query($conn, $sql);
$jumpa = mysqli_num_rows($qry);
$r = mysqli_fetch_array($qry);

if ($jumpa > 0) {
	session_start();
	$_SESSION['username'] = $r['username'];
	$_SESSION['idadmin'] = $r['id_admin'];
	header('Location:media?module=home');
} else {
	echo '<script language="javascript">
	alert("Userid atau Password Yang anda Masukkan Salah atau Acount Sudah Diblokir");
	window.location="index";
	</script>';
	exit();
}
