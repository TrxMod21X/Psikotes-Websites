<?php
require '../../config/koneksi.php';

function registrasi($data)
{
    global $conn;

    $username = strtolower(stripslashes($data['username']));
    $password = mysqli_real_escape_string($conn, $data['password']);
    $confirmPassword = mysqli_real_escape_string($conn, $data['password']);

    $usernameChecker = mysqli_query($conn, "SELECT `username` FROM `admin` WHERE `username` = '$username';");

    if (mysqli_fetch_assoc($usernameChecker)) {
        echo '<script>
                alert("username sudah terdaftar");
             </script>';
        return false;
    }

    if ($password != $confirmPassword) {
        echo '<script>
                 alert("konfirmasi password tidak sesuai");
             </script>';
        return false;
    }

    $password = password_hash($password, PASSWORD_DEFAULT);

    mysqli_query($conn, "INSERT INTO `admin` (`id`, `username`, `password`, `roles`) VALUES (NULL, '$username', '$password', 'A');");

    return mysqli_affected_rows($conn);
}
