<?php
session_start();
require '../../../config/koneksi.php';
require '../../../config/library.php';

$benar = 0;
$salah = 0;
$totalBenar = 0;

$idUser = $_SESSION['id_user'];

$idKategori = 0;
$kategoriSoal = '';
$verbal = 0;
$kuantitatif = 0;
$penalaran = 0;
$totalScore = 0;

if (isset($_SESSION['answer'])) {
    $getSortSoalId = mysqli_query($conn, "SELECT `id` FROM `soal` WHERE `aktif` = 'Y' ORDER BY `id_kategori`;");

    $idSoal = [];

    while ($id = mysqli_fetch_row($getSortSoalId)) {
        $idSoal[] = $id;
    }
    // print_r($idSoal);
    // print_r($_SESSION['answer']);
    for ($i = 0; $i < sizeof($_SESSION['answer']); $i++) {
        $kunci = '';
        $nomorSoal = $idSoal[$i][0];
        // var_dump($nomorSoal);

        $jawabanUser = $_SESSION['answer'][$nomorSoal];
        // print_r($jawabanUser);

        $kategoriSoal =  getCategoryById($nomorSoal);
        $idKategori = $kategoriSoal['id_kategori'];
        //    print_r($idKategori);

        $kunciJawaban = getKeyById($nomorSoal, $idKategori);
        $kunci = $kunciJawaban['kunci'];
        // print_r($kunci);

        calculate($jawabanUser, $kunci, $idKategori);
    }
    writeToDatabase($idUser);
}

// finish();


function getCategoryById($id)
{
    global $conn;
    $query = mysqli_query($conn, "SELECT `id_kategori` FROM `soal` WHERE `id`= $id;");
    $res = mysqli_fetch_assoc($query);
    // print_r($res);

    return $res;
}

function getCategoryName($id)
{
    global $conn;
    $query = mysqli_query($conn, "SELECT `kategori` FROM `kategori_soal` WHERE `id` = $id;");
    $res = mysqli_fetch_assoc($query);
    // print_r($res);
    return $res['kategori'];
}

function getSoalCategoryLength($id)
{
    global $conn;

    $query = mysqli_query($conn, "SELECT * FROM `soal` WHERE `id_kategori`= $id;");
    $totalSoalByCategori = mysqli_num_rows($query);

    return $totalSoalByCategori;
}

function getKeyById($id, $idKategori)
{
    global $conn;
    $query = mysqli_query($conn, "SELECT `kunci` FROM `soal` WHERE `id` = $id AND `id_kategori` = $idKategori;");
    $res = mysqli_fetch_assoc($query);
    // print_r($res);

    return $res;
}

function calculate($jawabanUser, $kunci, $kategori)
{
    global $benar;
    global $totalBenar;
    global $salah;

    global $verbal;
    global $kuantitatif;
    global $penalaran;
    global $totalScore;


    $totalSoal = getSoalCategoryLength($kategori);
    $soalKategori = getCategoryName($kategori);

    if ($jawabanUser == $kunci) {
        $benar++;
        $totalBenar++;
        if ($soalKategori == 'Verbal') {
            $verbal += $benar * 500 / $totalSoal;
            $benar = 0;
        } else if ($soalKategori == 'Kuantitatif') {
            $kuantitatif += $benar * 500 / $totalSoal;
            $benar = 0;
        } else {
            $penalaran += $benar * 500 / $totalSoal;
            $benar = 0;
        }
    } else {
        $salah++;
    }

    $totalScore = $verbal + $kuantitatif + $penalaran;

    // print_r($kategori);
    // echo '-----';
    // print_r($jawabanUser);
    // echo '----';
    // print_r($kunci);
    // echo '----';
}

function writeToDatabase($userId)
{
    global $conn;
    global $tgl_sekarang;

    global $totalBenar;
    global $salah;
    global $verbal;
    global $kuantitatif;
    global $penalaran;
    global $totalScore;

    mysqli_query($conn, "UPDATE `users` SET `status_tes` = 'SUDAH', `pelaksanaan` = '$tgl_sekarang' WHERE `users`.`id` = $userId;");

    mysqli_query($conn, "INSERT INTO `nilai` (`id`, `id_user`, `id_kategori`, `benar`, `salah`, `verbal`, `kuantitatif`, `penalaran`, `score`, `tanggal`) VALUES (NULL, $userId, '1', $totalBenar, $salah, $verbal, $kuantitatif, $penalaran, $totalScore, '$tgl_sekarang');");

    setcookie('start', '', time() - 3600, '/');
    unset($_SESSION['time']);
    unset($_SESSION['start']);
    unset($_SESSION['answer']);
    finish();
}

function finish()
{
    echo 'Terima Kasih Telah Mengikuti Tes.';
}


// echo $verbal;
// echo $kuantitatif;
// echo $penalaran;
// echo $totalScore;
// echo $salah;
// echo $totalBenar;
