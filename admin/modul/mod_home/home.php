<?php
include "../../../config/koneksi.php";
include "../../../config/fungsi_thumb.php";

if (!isset($_SESSION['login'])) {
    header('Location: authentication/auth.php');
    exit;
}

$roles = $_SESSION['roles'];

$tanggal = mktime(date('m'), date("d"), date('Y'));
date_default_timezone_set("Asia/Jakarta");
$jam = date("H:i:s");
$a = date("H");

$sql_user  = mysqli_query($conn, "SELECT count(*) as jum FROM `users` WHERE statusaktif='Y'");
$r_user    = mysqli_fetch_array($sql_user);

$total_user = $r_user['jum'];

$sql_soal  = mysqli_query($conn, "SELECT count(*) as jum FROM `soal` WHERE aktif='Y'");
$r_soal    = mysqli_fetch_array($sql_soal);
$total_soal = $r_soal['jum'];

?>
<div class="row" id="body-row">
    <!-- Sidebar -->
    <?php include 'components/sidebar.php' ?>
    <!-- Akhir Sidebar -->

    <!-- MAIN -->
    <div class="col">
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 mt-3">
                        <h3 class="display-4 text-center">Aplikasi Psikotes Online</h3>
                        <hr />
                    </div>
                </div>

                <!-- Waktu Tanggal Selamat Admin -->
                <div class="row">
                    <div class="container text-center mb-2">
                        <h5 class="ml-4 d-inline-block">
                            Tanggal : <b><?= date("d-m-Y", $tanggal); ?></b>
                        </h5>
                        <h5 class="d-inline-block">
                            | Pukul : <b><?= $jam ?></b>
                        </h5>
                        <?php if (($a >= 6) && ($a <= 11)) : ?>
                            <b>, Selamat Pagi <?= ($roles == 'SA') ? 'Super Admin' : 'Admin' ?> <i class="fas fa-sun"></i></b>
                        <?php endif ?>

                        <?php if (($a >= 11) && ($a <= 15)) : ?>
                            <b>, Selamat Siang <?= ($roles == 'SA') ? 'Super Admin' : 'Admin' ?> <i class="fas fa-sun"></i></b>
                        <?php endif ?>

                        <?php if (($a >= 15) && ($a <= 19)) : ?>
                            <b>, Selamat Sore <?= ($roles == 'SA') ? 'Super Admin' : 'Admin' ?> <i class="fas fa-sun"></i></b>
                        <?php else : ?>
                            <b>, Selamat Malam <?= ($roles == 'SA') ? 'Super Admin' : 'Admin' ?> <i class="fas fa-sun"></i></b>
                        <?php endif ?>
                    </div>
                </div>
                <!-- Header Menu card -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-header bg-info text-white">
                            <span class="fas fa-home fa-fw mr-3"></span>Beranda
                        </div>
                    </div>
                </div>

                <!-- Isi Card -->
                <div class="card-body text-center">
                    <!-- Kotak Total Peserta -->
                    <div class="col-lg-3 col-md-6 d-inline-block">
                        <a href="?module=users">
                            <div class="card text-white ">
                                <div class="card-header bg-info">
                                    <div class="row">
                                        <div class="col-3">
                                            <i class="fa fa-users fa-4x mt-2"></i>
                                        </div>
                                        <div class="col-9 text-right">
                                            <div class="font-weight-bold" style="font-size:38px"><?php echo $total_user ?>
                                            </div>
                                            <div class="font-weight-light">Total Peserta</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <!-- Kotak Total Soal Tes -->
                    <div class="col-lg-3 col-md-6 d-inline-block">
                        <a href="?module=soal">
                            <div class="card text-white">
                                <div class="card-header color">
                                    <div class="row">
                                        <div class="col-3">
                                            <i class="fa fa-file-alt fa-4x mt-2"></i>
                                        </div>
                                        <div class="col-9 text-right">
                                            <div class="font-weight-bold" style="font-size:38px"><?php echo $total_soal ?></div>
                                            <div class="font-weight-light">Total Soal</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>