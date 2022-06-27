<?php
include '../../config/koneksi.php';
include '../../config/fungsi_thumb.php';

// var_dump($_SESSION);
// die;

if (!isset($_SESSION['login'])) {
    header('Location: ../authentication/auth.php');
    exit;
}

$roles = $_SESSION['roles'];

$tanggal = mktime(date('m'), date("d"), date('Y'));
date_default_timezone_set("Asia/Jakarta");
$jam = date("H:i:s");
$a = date("H");

?>

<div class="row" id="body-row">
    <!-- Sidebar -->
    <?php include '../components/sidebar.php' ?>

    <!-- Main -->
    <div class="col">
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 mt-3">
                        <h3 class="display-4 text-center">Aplikasi Psikotes Online</h3>
                        <hr>
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
                <div class="card-body">
                    <!-- Kotak Total Peserta -->
                    <div class="col-lg-3 col-md-6">
                        <a href="?module=users">
                            <div class="card text-white ">
                                <div class="card-header bg-info">
                                    <div class="row">
                                        <div class="col-3">
                                            <i class="fa fa-users fa-4x mt-2"></i>
                                        </div>
                                        <div class="col-9 text-right">
                                            <div class="font-weight-bold" style="font-size:38px"><?= $total_user ?>
                                            </div>
                                            <div class="font-weight-light">Total Peserta</div>
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