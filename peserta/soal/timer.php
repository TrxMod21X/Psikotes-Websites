<?php
session_start();
require '../../config/koneksi.php';

$query = mysqli_query($conn, "SELECT `waktu` FROM `pengaturan_tes`;");
$waktu = mysqli_fetch_assoc($query);

$myTime = (int)$waktu['waktu'] * 60;
if (isset($_COOKIE['start']) && !isset($_SESSION['time'])) {
    $_SESSION['time'] = time();
} else {
    $diff = time() - $_SESSION['time'];
    $diff = $myTime - $diff;

    $hours = floor($diff / 60);
    $minute = (int)($diff / 60);
    $second = $diff % 60;

    $show = $minute . ":" . $second;

    if ($diff == 0 || $diff < 0) {
        echo 'timeout';
        unset($_SESSION['time']);
        unset($_SESSION['start']);
        // echo '<script>
        //         window.location.href="?hal=home";
        //         alert("Waktu Anda Telah Habis. Terima Kasih Telah Mengikuti Tes");
        //       </script>';
    } else {
        echo $show;
    }
}
