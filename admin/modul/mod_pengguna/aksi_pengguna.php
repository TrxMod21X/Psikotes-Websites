<?php
session_start();
include "../../../config/koneksi.php";
include "../../../config/fungsi_thumb.php";

$module = $_GET['module'];
$act = $_GET['act'];

$id = $_POST['id'];
$username = $_POST['username'];
$oldPassword = mysqli_real_escape_string($conn, $_POST['passwordold']);
$newPassword = mysqli_real_escape_string($conn, $_POST['password']);
// var_dump($_POST);
// echo '<br>';
// die;

$data = mysqli_query($conn, "SELECT * FROM `admin` WHERE `id`= $id;");
$result = mysqli_fetch_array($data);

if ($module == 'pengguna' and $act == 'update') {
  if (password_verify($oldPassword, $result['password'])) {
    if ($newPassword != '') {
      $newPassword = password_hash($newPassword, PASSWORD_DEFAULT);
      
      mysqli_query($conn, "UPDATE `admin` SET `username` = '$username', `password` = '$newPassword' WHERE `id` = '$id';");

      echo '
      <script>
        window.location.href="../../media.php?module=pengguna";
        alert("Update Berhasil.");
      </script>';
    } else {

      mysqli_query($conn, "UPDATE `admin` SET `username` = '$username' WHERE `id` = '$id';");

      echo '
            <script>
              window.location.href="../../media.php?module=pengguna";
              alert("Update Berhasil.");
            </script>';
    }
  } else {
    echo '
    <script>
    window.location.href="../../media.php?module=pengguna";
    alert("password lama salah");
    </script>';
  }
}
