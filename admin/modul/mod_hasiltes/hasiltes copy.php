<?php
if (!isset($_SESSION['login'])) {
    header('Location: authentication/auth.php');
    exit;
}

$aksi = "modul/mod_hasiltes/aksi_hasiltes.php";

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
                            <?php
                            switch ($_GET['act']) {
                                    // Tampil Hasil tes Users
                                default:
                                    $tampil = mysqli_query($conn, "SELECT * FROM `nilai`,`users` WHERE `nilai`.`id_user` = `users`.`id`;");
                                    echo "<div class='row'>
      <div class='col-lg-6'>
          <a class='btn btn-warning' href='cetak/cetakhasiltes.php' role='button' target='_blank' rel='noopener noreferrer'><span class='fa fa-print fa-fw mr-3'></span>Cetak</a>
          <a class='btn btn-success' href=?module=hasiltes&act=lulus role='button'><i class='fa fa-user-check fa-fw mr-3'></i>Peserta Lulus</a>
          <a class='btn btn-danger' href=?module=hasiltes&act=tidaklulus role='button'><i class='fa fa fa-user-slash fa-fw mr-3'></i>Peserta Tidak Lulus</a>      
          </div>
      </div>
        <table class='table table-hover mt-3'>
          <thead><tr align='center'><th>No</th><th>Nama pengguna</th><th>Nama</th><th>Benar</th><th>Salah</th><th>Kosong</th><th>Nilai</th><th>Tanggal Tes</th><th>Keterangan</th><th>Aksi</th></tr></thead>";
                                    $no = 1;
                                    while ($r = mysqli_fetch_array($tampil)) {
                                        // var_dump($r);
                                        // die;
                                        $tgl = tgl_indo($r['tanggal']);

                                        echo "<tr><td>$no</td>
             <td>$r[username]</td>
            <td>$r[nama]</td>
            <td align='center'>$r[benar]</td>
        <td align='center'>$r[salah]</td>
        <td align='center'>$r[kosong]</td>
        <td align='center'>$r[score]</td>
        <td>$tgl</td>
        <td align='center'>$r[keterangan]</td>
   <td align='center'><input type=button value='Hapus' class='btn btn-outline-danger' onclick=\"window.location.href='$aksi?module=hasiltes&act=hapus&id=$r[id_nilai]';\">
   </td>
      </tr>";
                                        $no++;
                                    }
                                    echo "</table>";
                                    break;

                                    // Hasil tes lulus
                                case "lulus":
                                    $tampil = mysqli_query($conn, "SELECT nama,jk,email,benar,salah,kosong,score,keterangan,tanggal FROM tbl_user INNER JOIN tbl_nilai ON tbl_user.id_user=tbl_nilai.id_user WHERE keterangan='Lulus'");
                                    echo "<div class='row'>
      <div class='col-lg-6'>
          <a class='btn btn-warning' href='cetak/cetaklulus' role='button' target='_blank' rel='noopener noreferrer'><span class='fa fa-print fa-fw mr-3'></span>Cetak</a>
          <a class='btn btn-success' href='?module=hasiltes' role='button'><i class='fa fa-reply fa-fw mr-3'></i>Kembali</a>     
          </div>
      </div>
        <table class='table table-hover mt-3'>
          <thead><tr align='center'><th>No</th><th>Nama</th><th>Email</th><th>Benar</th><th>Salah</th><th>Kosong</th><th>Nilai</th><th>Keterangan</th><th>Tanggal Tes</th></tr></thead>";
                                    $no = 1;
                                    while ($r = mysqli_fetch_array($tampil)) {
                                        $tgl = tgl_indo($r['tanggal']);

                                        echo "<tr><td>$no</td>
             <td>$r[nama]</td>
            <td>$r[email]</td>
            <td align='center'>$r[benar]</td>
        <td align='center'>$r[salah]</td>
        <td align='center'>$r[kosong]</td>
        <td align='center'>$r[score]</td>
        <td align='center'>$r[keterangan]</td>
        <td>$tgl</td>
      </tr>";
                                        $no++;
                                    }
                                    echo "
    </table>";
                                    break;

                                    // Hasil tes tidak lulus
                                case "tidaklulus":
                                    $tampil = mysqli_query($conn, "SELECT nama,jk,email,benar,salah,kosong,score,keterangan,tanggal FROM tbl_user INNER JOIN tbl_nilai ON tbl_user.id_user=tbl_nilai.id_user WHERE keterangan='Tidak Lulus'");
                                    echo "<div class='row'>
      <div class='col-lg-6'>
          <a class='btn btn-warning' href='cetak/cetaktidaklulus' role='button' target='_blank' rel='noopener noreferrer'><span class='fa fa-print fa-fw mr-3'></span>Cetak</a>
          <a class='btn btn-success' href='?module=hasiltes' role='button'><i class='fa fa-reply fa-fw mr-3'></i>Kembali</a>     
          </div>
      </div>
        <table class='table table-hover mt-3'>
          <thead><tr align='center'><th>No</th><th>Nama</th><th>Email</th><th>Benar</th><th>Salah</th><th>Kosong</th><th>Nilai</th><th>Keterangan</th><th>Tanggal Tes</th></tr></thead>";
                                    $no = 1;
                                    while ($r = mysqli_fetch_array($tampil)) {
                                        $tgl = tgl_indo($r['tanggal']);

                                        echo "<tr><td>$no</td>
             <td>$r[nama]</td>
            <td>$r[email]</td>
            <td align='center'>$r[benar]</td>
        <td align='center'>$r[salah]</td>
        <td align='center'>$r[kosong]</td>
        <td align='center'>$r[score]</td>
        <td align='center'>$r[keterangan]</td>
        <td>$tgl</td>
      </tr>";
                                        $no++;
                                    }
                                    echo "</table>";
                                    break;
                            }
                            ?>



                        </div>
                        <div class="card-footer">
                            <?php
                            // Rata Rata Nilai
                            $dataavg = mysqli_query($conn, "SELECT AVG(score) as ratarata FROM tbl_nilai");
                            $avg = mysqli_fetch_array($dataavg);
                            // Nilai Rendah
                            $datamin = mysqli_query($conn, "SELECT MIN(score) as minimal FROM tbl_nilai");
                            $min = mysqli_fetch_array($datamin);
                            // Nama Min
                            $n = 35.3;
                            $nmmin = mysqli_query($conn, "SELECT nama FROM tbl_user INNER JOIN tbl_nilai ON tbl_user.id_user=tbl_nilai.id_user WHERE score=$n");
                            $namamin = mysqli_fetch_array($nmmin);
                            // Nilai Tinggi
                            $datamaks = mysqli_query($conn, "SELECT MAX(score) as maks FROM tbl_nilai");
                            $maks = mysqli_fetch_array($datamaks);
                            $m = 94.1;
                            // Nama Max
                            $nmmaks = mysqli_query($conn, "SELECT nama FROM tbl_user INNER JOIN tbl_nilai ON tbl_user.id_user=tbl_nilai.id_user WHERE score=$m");
                            $namamaks = mysqli_fetch_array($nmmaks);
                            // Total Peserta
                            $datapsrt = mysqli_query($conn, "SELECT COUNT(score) as peserta FROM tbl_nilai");
                            $count = mysqli_fetch_array($datapsrt);
                            ?>
                            <table>
                                <tr>
                                    <td>Nilai Rata-Rata</td>
                                    <td><?= round($avg['ratarata'], 2) ?></td>
                                </tr>
                                <tr>
                                    <td>Nilai Tertinggi</td>
                                    <td><?= $maks['maks']; ?></td>
                                    <td><?= $namamaks['nama']; ?></td>
                                </tr>
                                <tr>
                                    <td>Nilai Terendah</td>
                                    <td><?= $min['minimal'] ?></td>
                                    <td><?= $namamin['nama']; ?></td>
                                </tr>
                                <tr>
                                    <td>Total Peserta</td>
                                    <td><?= $count['peserta'] ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->



</div>
</div>