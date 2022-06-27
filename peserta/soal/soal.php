<?php
session_start();
require 'action.php';
require '../../config/library.php';

$ready = hash('sha256', 'ready');

if (isset($_COOKIE['ready'])) {
    $userReady = $_COOKIE['ready'];

    if ($userReady === $ready) {
        $_SESSION['ready'] = true;
    } else {
        $_SESSION['ready'] = [];
    }
}

// Lakukan Pengecekan Apakah Sudah Pernah Mengerjakan Soal atau belum
if (checkUserState($_SESSION['id_user']) > 0) {
    $workDone = true;
}
// Jika Belum
else {
    $totalSoal = getSoalLength();
    $dataSoal = getSoalData($totalSoal);
    $info = getTestInfo();
    $nomorSoal = 1;

    if (isset($_POST['ready'])) {
        if (!isset($_POST['agree'])) {
            echo "  <script>
                        alert('Anda belum menyetujui!');
                    </script>";
        } else {
            $_SESSION['ready'] = true;
            setcookie('ready', $ready, time() + ((int)$info['waktu'] * 60));
            echo "  <script>
                        alert('Selamat Mengerjakan, Semoga Berhasil!'); 
                    </script>";
            header('Location: ?hal=soal');
            exit;
        }
    }
}

// User menyelesaikan test
if (isset($_POST['complete'])) {
    $pilihan = $_POST['pilihan'];
    $id_soal = $_POST['id'];
    $jumlah = $_POST['jumlah'];

    $score = 0;
    $benar = 0;
    $salah = 0;
    $kosong = 0;

    for ($i = 0; $i < $jumlah; $i++) {
        // Id Nomor Soal
        $nomor = $id_soal[$i];

        // Jika Jawaban User Kosong
        if (empty($pilihan[$nomor])) {
            $kosong++;
        } else {
            // Jawaban User
            $jawaban = $pilihan[$nomor];

            // Checking Jawaban dengan Kunci
            $query = mysqli_query($conn, "SELECT * FROM `soal` WHERE `id` = $nomor AND `kunci` = '$jawaban'; ");
            $cek = mysqli_num_rows($query);

            // Jika Jawaban Benar
            if ($cek) {
                $benar++;
            }
            // Jika Jawaban Salah
            else {
                $salah++;
            }
        }

        $score = 500 / $totalSoal * $benar;
        $hasil = round($score);
    }

    // Checking Data di Database
    $userId = $_SESSION['id_user'];
    $cek = mysqli_num_rows(mysqli_query($conn, "SELECT `id_user` FROM `nilai` WHERE `id_user` = $userId;"));

    if ($cek < 1) {
        mysqli_query($conn, "UPDATE `users` SET `status_tes` = 'SUDAH', `pelaksanaan` = '$tgl_sekarang' WHERE `users`.`id` = $userId; ");
        mysqli_query($conn, "INSERT INTO `nilai` (`id`, `id_user`, `id_kategori`, `benar`, `salah`, `kosong`, `score`, `tanggal`, `keterangan`) VALUES (NULL, '$userId', '1', '$benar', '$salah', '$kosong', '$hasil', '$tgl_sekarang', 'Tidak Lulus');");
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
                            <?php if (isset($workDone)) : ?>
                                <h3 class="mt-5" align="center" style="border: 0;">
                                    Anda Telah Menyelesaikan Tes Terima kasih.
                                </h3>
                                <hr><br>
                                <ol>
                                    <li>Untuk hasil atau info selanjutnya. Admin akan menghubungi anda melalui Email atau Whatsapp.</li>
                                    <li>Cek email secara berkala.</li>
                                    <li>Admin akan secepatnya memproses hasil anda. Terima Kasih.</li>
                                </ol>
                            <?php endif; ?>

                            <!-- Jika User Belum Mengerjakan Soal dan User Belum Cek Mengerti -->
                            <?php if (!isset($workDone) && !isset($_COOKIE['ready'])) : ?>
                                <h3 align="center"><?= $info['nama_tes'] ?></h3>
                                <hr><br>

                                <i class="fas fa-clock mr-2"></i>
                                <p style="display: inline;">Waktu Pengerjaan : <?= $info['waktu'] ?> menit</p> <br>

                                <i class="fas fa-file-alt mr-2"></i>
                                <p style="display: inline;">Jumlah : <?= $totalSoal ?> soal</p><br><br>

                                <h2>Peraturan</h2>
                                <hr><br>
                                <?= $info['peraturan'] ?><br>

                                <form action="" method="POST">
                                    <input type="checkbox" name="agree" id="agree" value="1">
                                    <label class="text-capitalize" for="agree">
                                        <b>Saya Mengerti dan Siap Untuk Mengikuti Tes.</b>
                                    </label> <br><br>
                                    <div class="text-align:center">
                                        <input type="submit" name="ready" class="btn btn-primary" value="MULAI TES">
                                    </div>
                                </form>
                            <?php endif ?>

                            <!-- Jika User Belum Mengerjakan Soal  dan User Sudah Cek Mengerti -->
                            <?php if (isset($_SESSION['ready']) && isset($_COOKIE['ready'])) : ?>
                                <!-- Time Left -->
                                <table>
                                    <tr>
                                        <th>
                                            <i class="fas fa-clock mr-2"></i>
                                            <p style="display: inline;">Waktu Tersisa</p><br>
                                        </th>
                                    </tr>
                                    <tr>
                                        <td align="center">
                                            <span id="show" style="font-size: 18px;"></span>
                                        </td>
                                    </tr>
                                </table>

                                <!-- Form Soal -->
                                <div style="width: 100%; border: 1px solid #EBEBEB; overflow: auto; height:700px;">
                                    <table class="table" border="0">

                                        <?php while ($soal = mysqli_fetch_assoc($dataSoal)) : ?>
                                            <h1 class="text-center">Kemampuan <?= getSoalCategory($soal['id_kategori']) ?></h1>
                                            <form action="" method="POST">
                                                <input type="hidden" name="id[]" value="<?= $soal['id'] ?>">
                                                <input type="hidden" name="jumlah" value="<?= $totalSoal ?>">
                                                <input type="hidden" name="kategori" value="<?= $soal['id_kategori'] ?>">
                                                <?= $soal['id_kategori'] ?>
                                                <!-- Soal -->
                                                <tr>
                                                    <!-- Nomor Soal -->
                                                    <td width="17">
                                                        <font color="#000000">
                                                            <?= $nomorSoal++ ?>
                                                        </font>
                                                    </td>

                                                    <!-- Pertanyaan -->
                                                    <td width="430">
                                                        <font color="#000000">
                                                            <?= $soal['soal'] ?>
                                                        </font>
                                                    </td>
                                                </tr>

                                                <!-- Jika soal memiliki gambar -->
                                                <?php if (!empty($soal["gambar"])) : ?>
                                                    <tr>
                                                        <td>
                                                            <img src="<?= "../../foto/" . $soal['gambar'] ?>" width="300" height="300" class="img-thumbnail" alt="soal">
                                                        </td>
                                                    </tr>
                                                <?php endif ?>

                                                <!-- Pilihan Jawaban Soal -->
                                                <!-- Jawaban A -->
                                                <tr>
                                                    <td height="21">
                                                        <font color="#000000">&nbsp;</font>
                                                    </td>
                                                    <td>
                                                        <font color="#000000">
                                                            <label>A.</label>

                                                            <input name="pilihan[<?= $soal['id'] ?>]" type="radio" value="A">

                                                            <label><?= $soal['a'] ?></label>
                                                        </font>
                                                    </td>
                                                </tr>

                                                <!-- Jawaban B -->
                                                <tr>
                                                    <td height="21">
                                                        <font color="#000000">&nbsp;</font>
                                                    </td>
                                                    <td>
                                                        <font color="#000000">
                                                            <label>B.</label>

                                                            <input name="pilihan[<?= $soal['id'] ?>]" type="radio" value="B">

                                                            <label><?= $soal['b'] ?></label>
                                                        </font>
                                                    </td>
                                                </tr>

                                                <!-- Jawaban C -->
                                                <tr>
                                                    <td height="21">
                                                        <font color="#000000">&nbsp;</font>
                                                    </td>
                                                    <td>
                                                        <font color="#000000">
                                                            <label>C.</label>

                                                            <input name="pilihan[<?= $soal['id'] ?>]" type="radio" value="C">

                                                            <label><?= $soal['c'] ?></label>
                                                        </font>
                                                    </td>
                                                </tr>

                                                <!-- Jawaban D -->
                                                <tr>
                                                    <td height="21">
                                                        <font color="#000000">&nbsp;</font>
                                                    </td>
                                                    <td>
                                                        <font color="#000000">
                                                            <label>D.</label>

                                                            <input name="pilihan[<?= $soal['id'] ?>]" type="radio" value="D">

                                                            <label><?= $soal['d'] ?></label>
                                                        </font>
                                                    </td>
                                                </tr>

                                                <!-- Jawaban E -->
                                                <tr>
                                                    <td height="21">
                                                        <font color="#000000">&nbsp;</font>
                                                    </td>
                                                    <td>
                                                        <font color="#000000">
                                                            <label>E.</label>

                                                            <input name="pilihan[<?= $soal['id'] ?>]" type="radio" value="E">

                                                            <label><?= $soal['e'] ?></label>
                                                        </font>
                                                    </td>
                                                </tr>

                                            <?php endwhile ?>

                                            <!-- Submit Button -->
                                            <!-- Test Action Button -->
                                            <tr>
                                                <td>&nbsp;</td>
                                                <td>
                                                    <div class="container">
                                                        <div class="row">

                                                            <!-- Back Button -->
                                                            <div class="col-sm text-left">
                                                                <?php if ($_GET['page'] != 1) : ?>
                                                                    <a href="<?= prevSoal() ?>">
                                                                        <span style="color: red;">
                                                                            <i class="fa fa-arrow-circle-left fa-3x mt-2"></i>
                                                                        </span>
                                                                    </a>
                                                                <?php endif ?>
                                                            </div>

                                                            <!-- Submit Button -->
                                                            <?php if ($_GET['page'] == $totalPage) : ?>
                                                                <div class="col-sm text-center mt-2">
                                                                    <input type="submit" class="btn btn-success" name="complete" value="Jawab" onclick="">
                                                                </div>
                                                            <?php endif ?>


                                                            <!-- Next Button -->
                                                            <div class="col-sm text-right">
                                                                <?php if ($_GET['page'] != $totalPage) : ?>
                                                                    <a href="<?= nextSoal() ?>">
                                                                        <span style="color: blue;">
                                                                            <i class="fa fa-arrow-circle-right fa-3x mt-2"></i>
                                                                        </span>
                                                                    </a>
                                                                <?php endif ?>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            </form>
                                    </table>
                                    <?php for ($i = 1; $i <= $totalPage; $i++) : ?>
                                        <a href="?hal=soal&page=<?= $i ?> "><?= $i ?></a>
                                    <?php endfor ?>
                                </div>
                            <?php endif ?>

                            <script>
                                $(document).ready(function() {
                                    setInterval(function() {
                                        $('#show').load('../soal/timer.php');
                                    }, 1000);
                                });
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>