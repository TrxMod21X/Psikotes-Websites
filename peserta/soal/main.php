<?php
require 'action.php';

$ready = hash('sha256', 'ready');

if (isset($_COOKIE['start'])) {
    $checkCookie = $_COOKIE['start'];

    if ($checkCookie === $ready) {
        $_SESSION['start'] = true;
        header('Location: ?start=test&category=1');
        exit;
    }
}
// checkSession();

$status_tes = false;

// Lakukan Pengecekan Apakah Sudah Pernah Mengerjakan Soal atau belum
if (checkUserState() === 'SUDAH') {
    $status_tes = true;
}
// Jika Belum 
else {
    $totalSoal = getSoalLength();
    $infoTes = getTestInfo();
    $aggreeCheck = false;

    // Checking User Sudah Siap Mengerjakan Tes
    if (isset($_POST['ready'])) {
        if (!isset($_POST['aggree'])) {
            $aggreeCheck = true;
        } else {
            $_SESSION['start'] = true;
            setcookie('start', $ready, time() + ((int)$infoTes['waktu'] * 60), '/');
            header('Location: ?start=test&category=1');
            exit;
        }
    }
}
?>

<div class="row" id="body-row">
    <!-- Sidebar -->
    <?php include '../components/sidebar.php' ?>

    <!-- Main -->
    <div class="col">
        <div class="page-wrapper">
            <div class="container-fluid mt-3">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-header bg-info text-white">Soal</div>
                        <div class="card-body">



                            <!-- Jika User Sudah Pernah Mengerjakan Soal -->
                            <?php if ($status_tes) : ?>
                                <h3 class="mt-5" align="center" style="border: 0;">
                                    Anda Telah Menyelesaikan Tes Terima kasih.
                                </h3>
                                <hr><br>
                                <ol>
                                    <li>Untuk hasil atau info selanjutnya. Admin akan menghubungi anda melalui Email atau Whatsapp.</li>
                                    <li>Cek email secara berkala.</li>
                                    <li>Admin akan secepatnya memproses hasil anda. Terima Kasih.</li>
                                </ol>

                                <!-- Jika User Belum Mengerjakan Soal dan User Belum Cek Mengerti -->
                            <?php else : ?>
                                <!-- Jika User Tidak Check Setuju -->
                                <?php if ($aggreeCheck) : ?>
                                    <div class="alert alert-danger d-flex align-items-center" role="alert">
                                        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:">
                                            <use xlink:href="#exclamation-triangle-fill" />
                                        </svg>
                                        <div>
                                            Anda belum menyetujui!
                                        </div>
                                    </div>
                                <?php endif ?>

                                <h3 align="center"><?= $infoTes['nama_tes'] ?></h3>
                                <hr><br>

                                <i class="fas fa-clock mr-2"></i>
                                <p style="display: inline;">Waktu Pengerjaan : <?= $infoTes['waktu'] ?> menit</p> <br>

                                <i class="fas fa-file-alt mr-2"></i>
                                <p style="display: inline;">Jumlah : <?= $totalSoal ?> soal</p><br><br>

                                <h2>Peraturan</h2>
                                <hr><br>
                                <?= $infoTes['peraturan'] ?><br>

                                <form action="" method="POST">
                                    <input type="checkbox" name="aggree" id="agree" value="1">
                                    <label class="text-capitalize <?php echo (($aggreeCheck) ? 'text-danger' : '') ?>" for="agree">
                                        <b>Saya Mengerti dan Siap Untuk Mengikuti Tes.</b>
                                    </label> <br><br>
                                    <div class="text-align:center">
                                        <input type="submit" name="ready" class="btn btn-primary" value="MULAI TES">
                                    </div>
                                </form>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>