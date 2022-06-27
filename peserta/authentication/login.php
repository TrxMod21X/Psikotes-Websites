<?php
require '../../config/koneksi.php';


function login($data)
{
    global $conn;

    $username = $data['username'];
    $password = $data['password'];

    $result = mysqli_query($conn, "SELECT * FROM `users` WHERE `username` = '$username';");

    if (mysqli_num_rows($result)) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row['password'])) {
            session_start();
            $_SESSION['login'] = true;
            $_SESSION['name'] = $row['nama'];
            $_SESSION['id_user'] = $row['id'];

            setcookie('id', $row['id'], time() + 86400);
            setcookie('key', hash('sha256', $row['username']), time() + 86400);

            header('Location: ../home/media.php?hal=home');
            exit;
        }
    }
}
