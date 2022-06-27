<?php
require '../../config/koneksi.php';
require '../../config/library.php';

function registrasi($data)
{
    global $conn;
    global $tgl_sekarang;

    $username = strtolower(stripslashes($data['username']));
    $nama = $data['nama'];
    $email = $data['email'];
    $password = mysqli_real_escape_string($conn, $data['password']);
    $confirmpassword = mysqli_real_escape_string($conn, $data['password2']);

    $usernameChecker = mysqli_query($conn, "SELECT `username` FROM `users` WHERE `username` = '$username';");

    if (mysqli_fetch_assoc($usernameChecker)) {
        echo '<script>
                    alert("username sudah terdaftar");
              </script>';
        return false;
    }

    if ($password !== $confirmpassword) {
        echo '<script>
                 alert("konfirmasi password tidak sesuai");
             </script>';
        return false;
    }

    $password = password_hash($password, PASSWORD_DEFAULT);

    mysqli_query($conn, " INSERT INTO `users` (`id`, `username`, `nama`, `email`, `password`, `tgl_lahir`, `jk`, `telepon`, `alamat`, `nisn`, `instansi`, `jurusan`, `statusaktif`, `status_tes`, `pelaksanaan`) VALUES (NULL, '$username', '$nama', '$email', '$password', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'BELUM', '$tgl_sekarang');");

    return mysqli_affected_rows($conn);
}
