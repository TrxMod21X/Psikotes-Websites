<html lang="en" moznomarginboxes mozdisallowselectionprint>
<head>
    <title>Laporan Data Peserta Tes Psikotes</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../../asset/css/bootstrap.min.css">
</head>
<body onload="window.print()">
<div class="container">
            <h1 class="text-right">PT. SELAMAT LESTARI MANDIRI</h1>
            <h3 class="text-right">DAFTAR PESERTA TES PSIKOTES ONLINE</h3>
            <p class="text-right">Jl. Sudirman No. 17 Kota Sukabumi Telp. 0266 537243 </p>
<hr style="border-block-start-width: 10px;"/>
</div>
<?php 
include '../../config/koneksi.php';
$tampil = mysql_query("SELECT * FROM tbl_user");
echo"
<div class='container'><table class='table mt-3'>
          <tr align='center'><th>No</th><th>Username</th><th>Nama</th><th>Jenis Kelamin</th><th>Email</th><th>Telepon</th><th>Alamat</th></tr>"; 
    $no=1;
    while ($r=mysql_fetch_array($tampil)){
       echo "<tr><td align='center'>$no</td>
             <td>$r[username]</td>
            <td>$r[nama]</td>
        <td>$r[jk]</td>
        <td>$r[email]</td>
        <td>$r[telp]</td>
        <td>$r[alamat]</td>
        </tr>";
      $no++;
    } ?>
    </table></div>
    <table class="mt-4" align="center" style="width:800px; border:none;margin-top:5px;margin-bottom:20px;">
    <tr>
        <td align="right">Sukabumi, <?php echo date('d-M-Y')?></td>
    </tr>
    <tr>
        <td align="right"></td>
    </tr>
   
    <tr>
    <td><br/><br/><br/><br/></td>
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
        <th><br/><br/></th>
    </tr>
    <tr>
        <th align="left"></th>
    </tr>
</table>
</body>
</html>