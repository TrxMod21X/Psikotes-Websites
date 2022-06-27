<?php
$ready = hash('sha256', 'ready');

if (isset($_COOKIE['ready'])) {
    $userReady = $_COOKIE['ready'];

    if ($userReady === $ready) {
        $_SESSION['ready'] = true;
        $warning = true;
    } else {
        $warning = false;
    }
}
?>

<div class="row" id="body-row">
    <!-- Sidebar -->
    <?php include '../components/sidebar.php' ?>

    <!-- Main -->
    <div class="col">
        <div id="page-wrapper">
            <div class="container-fluid mt-3">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-header bg-info text-white">Beranda</div>
                        <div class="card-body">
                            <?php if (isset($warning)) : ?>
                                <div class="alert alert-warning" role="alert">
                                    Anda belum menjawab seluruh soal dan masi ada waktu yang tersisa. ke halaman <a href="?hal=soal" class="alert-link">soal</a>. sekarang untuk melanjutkan?
                                </div>
                            <?php endif; ?>


                            <h3 align='center'>Selamat datang <?= $_SESSION['name']; ?></h3>
                            <hr><br>
                            <h2>PENTING</h2>
                            <ol>
                                <li>Sebelum mengerjakan soal, jika belum melengkapi profil yang ada di bagian menu <a href="?hal=profiluser">profil peserta.</a> disarankan untuk melengkapi dulu.</li>
                                <li>Pengerjaan soal tes psikotes diberikan batasan waktu apabila waktu telah habis maka anda tidak dapat mengisi&nbsp; ataupun mengoreksi kembali jawaban dari soal yang tersedia.</li>
                                <li>Jika sudah mengerti dan siap untuk mengikuti tes, anda bisa langsung masuk ke menu tes <a href="?hal=soal">soal.</a> </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>