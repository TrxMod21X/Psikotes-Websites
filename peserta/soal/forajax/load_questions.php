<?php
session_start();
require '../../../config/koneksi.php';

$nomorSoal = '';
$idSoal = '';
$kategoriId = '';
$soal = '';
$gambar = '';
$pilihanA = '';
$pilihanB = '';
$pilihanC = '';
$pilihanD = '';
$pilihanE = '';
$kunci = '';
$hitung = 0;
$jawabanUser = '';

$nomorSoal = $_GET['number'];
$kategoriId = $_GET['category'];
$kategori = $_GET['nama'];

$totalSoalPerPage = $_GET['totalPage'];
$totalSoal = $_GET['totalSoal'];
$totalPage = ceil($totalSoal / $totalSoalPerPage);
$activePage = $nomorSoal;
$firstData = ($totalSoalPerPage * $activePage) - $totalSoalPerPage;

$query = mysqli_query($conn, "SELECT * FROM `soal` WHERE `id_kategori` = $kategoriId AND `aktif` = 'Y' LIMIT $firstData, $totalSoalPerPage;");

while ($dataSoal = mysqli_fetch_assoc($query)) {
    $idSoal = $dataSoal['id'];
    $soal = $dataSoal['soal'];
    $gambar = $dataSoal['gambar'];
    $pilihanA = $dataSoal['a'];
    $pilihanB = $dataSoal['b'];
    $pilihanC = $dataSoal['c'];
    $pilihanD = $dataSoal['d'];
    $pilihanE = $dataSoal['e'];
}

if (isset($_SESSION['answer'][$idSoal])) {
    $jawabanUser = $_SESSION['answer'][$idSoal][0];
}
?>

<br>
<h1 class="text-center">Kemampuan <?= $kategori ?></h1>
<br>

<!-- Soal -->
<tr>
    <!-- Pertanyaan -->
    <td width="430">
        <font color="#000000">
            <?= $nomorSoal . "." . " " . $soal; ?>
        </font>
    </td>
</tr>

<!-- Jika soal memiliki gambar -->
<?php if (!empty($gambar)) : ?>
    <tr>
        <td>
            <img src="<?= "../../foto/" . $soal['gambar'] ?>" width="300" height="300" class="img-thumbnail" alt="soal">
        </td>
    </tr>
<?php endif ?>

<!-- Pilihan Jawaban Soal -->
<!-- Jawaban A -->
<tr>
    <td>
        <font color="#000000">
            <label>A.</label>
            <input name="pilihan[<?= $idSoal ?>]" type="radio" value="A" <?= ($jawabanUser == $pilihanA) ? 'checked' : ''; ?> onclick="radioClick(this.value, <?= $idSoal; ?>);">
            <label><?= $pilihanA ?></label>
        </font>
    </td>
</tr>

<!-- Jawaban B -->
<tr>
    <td>
        <font color="#000000">
            <label>B.</label>
            <input name="pilihan[<?= $idSoal ?>]" type="radio" value="B" <?= ($jawabanUser == $pilihanB) ? 'checked' : ''; ?> onclick="radioClick(this.value, <?= $idSoal; ?>);">
            <label><?= $pilihanB ?></label>
        </font>
    </td>
</tr>

<!-- Jawaban C -->
<tr>
    <td>
        <font color="#000000">
            <label>C.</label>
            <input name="pilihan[<?= $idSoal ?>]" type="radio" value="C" <?= ($jawabanUser == $pilihanC) ? 'checked' : ''; ?> onclick="radioClick(this.value, <?= $idSoal; ?>);">
            <label><?= $pilihanC ?></label>
        </font>
    </td>
</tr>

<!-- Jawaban D -->
<tr>
    <td>
        <font color="#000000">
            <label>D.</label>
            <input name="pilihan[<?= $idSoal ?>]" type="radio" value="D" <?= ($jawabanUser == $pilihanD) ? 'checked' : ''; ?> onclick="radioClick(this.value, <?= $idSoal; ?>);">
            <label><?= $pilihanD ?></label>
        </font>
    </td>
</tr>

<!-- Jawaban E -->
<tr>
    <td>
        <font color="#000000">
            <label>E.</label>
            <input name="pilihan[<?= $idSoal ?>]" type="radio" value="E" <?= ($jawabanUser == $pilihanE) ? 'checked' : ''; ?> onclick="radioClick(this.value, <?= $idSoal; ?>);">
            <label><?= $pilihanE ?></label>
        </font>
    </td>
</tr>