<?php
session_start();


require '../../config/koneksi.php';
require 'register.php';
require 'login.php';

if (isset($_COOKIE['id']) && isset($_COOKIE['key'])) {
    $id = $_COOKIE['id'];
    $key = $_COOKIE['key'];
    
    $result = mysqli_query($conn, "SELECT * FROM `admin` WHERE `id` = $id;");
    $row = mysqli_fetch_assoc($result);
    
    if ($key === hash('sha256', $row['username'])) {
        $_SESSION['login'] = true;
        $_SESSION['roles'] = $row['roles'];
        $_SESSION['id_user'] = $row['id'];
    }
}

if (isset($_SESSION['login']) && isset($_SESSION['roles']) && isset($_SESSION['id_user'])) {
    header('Location: ../media.php?module=home');
    exit;
}

// if (isset($_POST['register'])) {
//     if (registrasi($_POST) > 0) {
//         echo '<script>
//                 alert("Pendaftaran berhasil, silahkan login.");
//              </script>';
//     } else {
//         echo mysqli_error($conn);
//     }
// }

if (isset($_POST['login'])) {
    login($_POST);
    $error = true;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../../asset/css/auth.css" />
    <title>Login & Register Form</title>
</head>

<body>
    <div class="container">
        <div class="forms-container">

            <!-- Sign In Form -->
            <div class="signin-signup">
                <form action="" method="POST" class="sign-in-form">
                    <h2 class="title">Login</h2>
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="text" name="username" placeholder="Username" />
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="password" placeholder="Password" />
                    </div>
                    <input type="submit" name="login" value="Login" class="btn solid" />

                    <?php if (isset($error)) : ?>
                        <p style="color: red; font-style: italic;">Username/Password wrong</p>
                    <?php endif; ?>
                </form>
            </div>
        </div>

        <div class="panels-container">
            <div class="panel left-panel">
                <div class="content">
                    <h3>Selamat Datang Admin</h3>
                    <p>
                        Biometrika Indonesia adalah konsultan psikologi yang selalu berinovasi dalam upaya mendukung optimalisasi potensi diri, untuk menemukan versi terbaik dari setiap keluarga Indonesia.
                    </p>
                    <button class="btn transparent" disabled>
                        Let's Go
                    </button>
                </div>
                <img src="../../asset/img/register.svg" class="image" alt="" />
            </div>
        </div>
    </div>

    <!-- <script src="../../asset/js/auth.js"></script> -->
</body>

</html>