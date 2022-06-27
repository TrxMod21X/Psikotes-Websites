<?php
session_start();
include "../../../config/koneksi.php";
include "../../../config/fungsi_thumb.php";

$module = $_GET['module'];
$act = $_GET['act'];

// Update user
if ($module == 'users' and $act == 'update') {
	$lokasi_file = $_FILES['fupload']['tmp_name'];
	$nama_file   = $_FILES['fupload']['name'];

	if (!empty($lokasi_file)) {
		UploadBanner($nama_file);
		move_uploaded_file($lokasi_file, "foto/$nama_file");

		mysqli_query($conn, "UPDATE user SET statusaktif  = '$_POST[statusaktif]',
								 nama = '$_POST[nama]',
								 pangkat = '$_POST[pangkat]',
								 nrp = '$_POST[nrp]',
								 password = '$_POST[password]',
								 jabatan = '$_POST[jabatan]',
								 gambar = '$nama_file'
								  WHERE  id_user     = '$_POST[id]'");
	} else {
		mysqli_query($conn, "UPDATE user SET statusaktif  = '$_POST[statusaktif]',
								 nama = '$_POST[nama]',
								 pangkat = '$_POST[pangkat]',
								 nrp = '$_POST[nrp]',
								 password = '$_POST[password]',
								 jabatan = '$_POST[jabatan]'
								  WHERE  id_user     = '$_POST[id]'");
	}
	header('location:../../media.php?module=' . $module);
} elseif ($module == 'users' and $act == 'hapus') {
	mysqli_query($conn, "DELETE FROM `users` WHERE `id` = '$_GET[id]';");
	header('location:../../media.php?module=' . $module);
} elseif ($module == 'users' and $act == 'input') {
	$lokasi_file = $_FILES['fupload']['tmp_name'];
	$nama_file   = $_FILES['fupload']['name'];

	if (!empty($lokasi_file)) {
		UploadBanner($nama_file);
		move_uploaded_file($lokasi_file, "foto/$nama_file");

		mysqli_query($conn, "INSERT INTO user(nama,pangkat,nrp,password,jabatan,gambar,level) 
	  VALUES('$_POST[nama]','$_POST[pangkat]','$_POST[nrp]','$_POST[password]',
	  '$_POST[jabatan]','$nama_file','user')");
	} else {
		mysqli_query($conn, "INSERT INTO user(nama,pangkat,nrp,password,jabatan,level) 
	  VALUES('$_POST[nama]','$_POST[pangkat]','$_POST[nrp]','$_POST[password]',
	  '$_POST[jabatan]','user')");
	}
	header('location:../../media.php?module=' . $module);
}
//Pengaktifan dan Pengnonaktifan
elseif ($module == 'users' and $act == 'nonaktif') {
	$aktif = 'N';
	mysqli_query($conn, "UPDATE `users` SET `statusaktif` = '$aktif'  WHERE `id` = '$_GET[id]';");
	header('location:../../media.php?module=' . $module);
} elseif ($module == 'users' and $act == 'aktif') {
	$aktif = 'Y';
	mysqli_query($conn, "UPDATE `users` SET `statusaktif`  = '$aktif'  WHERE `id` = '$_GET[id]';");
	header('location:../../media.php?module=' . $module);
}
