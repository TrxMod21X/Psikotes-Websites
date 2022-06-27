<?php
require '../../config/koneksi.php';

function login($data)
{
    global $conn;

    $username = $data['username'];
    $password = $data['password'];

    $result = mysqli_query($conn, "SELECT * FROM `admin` WHERE `username` = '$username';");

    if (mysqli_num_rows($result)) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row['password'])) {
            session_start();
            $_SESSION['login'] = true;
            $_SESSION['roles'] = $row['roles'];
            $_SESSION['id_user'] = $row['id'];

            setcookie('id', $row['id'], time() + 3600);
            setcookie('key', hash('sha256', $row['username']), time() + 3600);

            header('Location: ../media.php?module=home');
            exit;
        }
    }
}
