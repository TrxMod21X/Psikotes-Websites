<html lang="en" moznomarginboxes mozdisallowselectionprint>

<head>
    <title>Laporan Data Peserta Tes Psikotes</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../../asset/css/bootstrap.min.css">
</head>

<body onload="window.print()">
    <div class="container">
        <h1 class="text-right">PT. SELAMAT LESTARI MANDIRI</h1>
        <h3 class="text-right">DAFTAR NILAI PESERTA TES PSIKOTES ONLINE</h3>
        <p class="text-right">Jl. Sudirman No. 76 Kota Sukabumi Telp. 0266 537243 </p>
        <hr style="border-block-start-width: 10px;" />
    </div>
    <?php 
include '../../config/koneksi.php';
$tampil = mysql_query("SELECT * FROM tbl_user,tbl_nilai WHERE tbl_nilai.id_user=tbl_user.id_user");
echo"
<div class='container'><table class='table mt-3'>
          <tr align='center'><th>No</th><th>Tanggal Tes</th><th>Username</th><th>Nama</th><th>Benar</th><th>Salah</th><th>Kosong</th><th>Nilai</th><th>Hasil</th></tr>"; 
    $no=1;
    while ($r=mysql_fetch_array($tampil)){
       echo "<tr><td align='center'>$no</td>
       <td align='center'>$r[tanggal]</td>
             <td>$r[username]</td>
            <td>$r[nama]</td>
        <td align='center'>$r[benar]</td>
        <td align='center'>$r[salah]</td>
        <td align='center'>$r[kosong]</td>
        <td align='center'>$r[score]</td>
        <td align='center'>$r[keterangan]</td>
        </tr>";
      $no++;
    } ?>
    <!-- Menghitung rata2 nilai max dan min bray -->
    <?php 
        // Rata Rata Nilai
        $dataavg = mysql_query("SELECT AVG(score) as ratarata FROM tbl_nilai");
        $avg = mysql_fetch_array($dataavg);
        // Nilai Rendah
        $datamin = mysql_query("SELECT MIN(score) as minimal FROM tbl_nilai");
        $min = mysql_fetch_array($datamin);
        // Nilai Tinggi
        $datamaks = mysql_query("SELECT MAX(score) as maks FROM tbl_nilai");
        $maks = mysql_fetch_array($datamaks);
        // Total Peserta
        $datapsrt = mysql_query("SELECT COUNT(score) as peserta FROM tbl_nilai");
        $count = mysql_fetch_array($datapsrt);
        ?>
    <tr>
        <td>Nilai Rata-Rata</td>
        <td><?= round($avg['ratarata'], 2) ?></td>
    </tr>
    <tr>
        <td>Nilai Tertinggi</td>
        <td><?= $maks['maks']; ?></td>
    </tr>
    <tr>
        <td>Nilai Terendah</td>
        <td><?= $min['minimal'] ?></td>
    </tr>
    <tr>
        <td>Total Peserta</td>
        <td><?= $count['peserta'] ?></td>
    </tr>
    </table>
    </div>
    <table class="mt-4" align="center" style="width:800px; border:none;margin-top:5px;margin-bottom:20px;">
        <tr>
            <td align="right">Sukabumi, <?php echo date('d-M-Y')?></td>
        </tr>
        <tr>
            <td align="right"></td>
        </tr>

        <tr>
            <td><br /><br /><br /><br /></td>
        </tr>
        <tr>
            <td align="right">( ........................................... )</td>
        </tr>
        <tr>
            <td align="center"></td>
        </tr>
    </table>
    <table align="center" style="width:800px; border:none;margin-top:5px;margin-bottom:20px;">
        <tr>
            <th><br /><br /></th>
        </tr>
        <tr>
            <th align="left"></th>
        </tr>
    </table>
</body>

</html>