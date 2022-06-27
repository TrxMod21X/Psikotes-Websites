<?php
if (!isset($_SESSION['login'])) {
    header('Location: authentication/auth.php');
    exit;
}

require '../config/fungsi_indotgl.php';

$aksi = "modul/mod_hasiltes/aksi_hasiltes.php";

// $getNilai = mysqli_query($conn, "SELECT * FROM `nilai`,`users` WHERE `nilai`.`id_user` = `users`.`id`;");

$getNilai = mysqli_query($conn, "SELECT * FROM `nilai`,`users` WHERE `nilai`.`id_user` = `users`.`id`;");

?>
<div class="row" id="body-row">
    <!-- Sidebar -->
    <?php include 'components/sidebar.php' ?>
    <!-- Akhir Sidebar -->

    <!-- MAIN -->
    <div class="col">
        <div id="page-wrapper">
            <div class="container-fluid mt-3">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-header bg-info text-white">
                            Hasil Tes
                        </div>
                        <div class="card-body">
                            <?php switch ($_GET['act']):
                                default: ?>
                                    <div class='row'>
                                        <div class='col-lg-6'>
                                            <a class='btn btn-warning' href='cetak/cetakhasiltes.php' role='button' target='_blank' rel='noopener noreferrer'><span class='fa fa-print fa-fw mr-3'></span>Cetak</a>
                                            <!-- <a class='btn btn-success' href=?module=hasiltes&act=lulus role='button'><i class='fa fa-user-check fa-fw mr-3'></i>Peserta Lulus</a>
                                            <a class='btn btn-danger' href=?module=hasiltes&act=tidaklulus role='button'><i class='fa fa fa-user-slash fa-fw mr-3'></i>Peserta Tidak Lulus</a> -->
                                        </div>
                                    </div>
                                    <table class='table table-hover mt-5 table-bordered'>
                                        <thead class="table-dark">
                                            <tr align='center'>
                                                <th>No</th>
                                                <th>Nama pengguna</th>
                                                <th>Nama</th>
                                                <th>Verbal</th>
                                                <th>Kuantitatif</th>
                                                <th>Penalaran</th>
                                                <th>Nilai</th>
                                                <th>Tanggal Tes</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <?php while ($data = mysqli_fetch_assoc($getNilai)) : ?>
                                            <?php $nomor = 1; ?>
                                            <?php $tgl = tgl_indo($data['tanggal']); ?>
                                            <tr>
                                                <td><?= $nomor; ?></td>
                                                <td><?= $data['username']; ?></td>
                                                <td><?= $data['nama']; ?></td>
                                                <td align='center'><?= $data['verbal']; ?></td>
                                                <td align='center'><?= $data['kuantitatif']; ?></td>
                                                <td align='center'><?= $data['penalaran']; ?></td>
                                                <td align='center'><?= $data['score']; ?></td>
                                                <td align='center'><?= $tgl; ?></td>
                                                <td align='center'><input type=button value='Hapus' class='btn btn-outline-danger' onclick="window.location.href='<?= $aksi ?>?module=hasiltes&act=hapus&id=<?= $data['id']; ?>';">
                                                </td>
                                            </tr>
                                            <?php $nomor++; ?>
                                        <?php endwhile; ?>
                                        <?php break; ?>

                                    <?php
                                case "sasa": ?>
                                        <?php break; ?>
                                <?php endswitch; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>