<div class="row" id="body-row">
    <div id="sidebar-container" class="sidebar-expanded d-none d-md-block">
        <ul class="list-group">
            <li class="list-group-item sidebar-separator-title text-muted d-flex align-items-center menu-collapsed">
                <small>MENU</small>
            </li>
            <a href="?module=home" class="bg-dark list-group-item list-group-item-action flex-column align-items-start">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="fas fa-home fa-fw mr-3"></span>
                    <span class="menu-collapsed">Beranda</span>
                </div>
            </a>
            <a href="?module=soal" class="bg-dark list-group-item list-group-item-action flex-column align-items-start">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="fa fa-tasks fa-fw mr-3"></span>
                    <span class="menu-collapsed">Kelola Soal Tes</span>
                </div>
            </a>
            <a href="?module=hasiltes" class="bg-dark list-group-item list-group-item-action flex-column align-items-start">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="fa fa-file-alt fa-fw mr-3"></span>
                    <span class="menu-collapsed">Hasil Tes</span>
                </div>
            </a>
            <a href="?module=pengaturantes" class="bg-dark list-group-item list-group-item-action flex-column align-items-start">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="fa fa-tools fa-fw mr-3"></span>
                    <span class="menu-collapsed">Pengaturan Tes</span>
                </div>
            </a>
            <a href="?module=users" class="bg-dark list-group-item list-group-item-action flex-column align-items-start">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="fa fa-users fa-fw mr-3"></span>
                    <span class="menu-collapsed">Daftar Peserta</span>
                </div>
            </a>
            <a href="?module=pengguna" class="bg-dark list-group-item list-group-item-action flex-column align-items-start">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="fa fa-user-alt fa-fw mr-3"></span>
                    <span class="menu-collapsed">Pengguna</span>
                </div>
            </a>
            <a href="?module=tentang" class="bg-dark list-group-item list-group-item-action flex-column align-items-start">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="fa fa-laptop fa-fw mr-3"></span>
                    <span class="menu-collapsed">Tentang</span>
                </div>
            </a>
            <a href="logout.php" class="bg-dark list-group-item list-group-item-action flex-column align-items-start">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="fa fa-sign-out-alt fa-fw mr-3"></span>
                    <span class="menu-collapsed">Keluar</span>
                </div>
            </a>
        </ul>
    </div> <!-- End Sidebar -->

    <!-- MAIN -->
    <div class="col">

        <div id="page-wrapper">
            <div class="container-fluid mt-3">
                <div class="row">
                    <div class="col-lg-12">
                        <!--   <h3 class="page-header"> Peraturan </h3> -->

                    </div>

                </div>

                <div class="row">
                    <div class="col-lg-12">

                        <div class="card-header bg-info text-white">
                            Hasil Tes
                        </div>
                        <div class="card-body">
                            <?php
                            $aksi = "modul/mod_hasiltes/aksi_hasiltes.php";
                            switch ($_GET['act']) {
                                    // Tampil Hasil tes Users
                                default:
                                    $tampil = mysqli_query($conn, "SELECT * FROM tbl_nilai,tbl_user WHERE tbl_nilai.id_user=tbl_user.id_user");
                                    echo "<div class='row'>
      <div class='col-lg-6'>
          <a class='btn btn-warning' href='cetak/cetakhasiltes' role='button' target='_blank' rel='noopener noreferrer'><span class='fa fa-print fa-fw mr-3'></span>Cetak</a>
          <a class='btn btn-success' href=?module=hasiltes&act=lulus role='button'><i class='fa fa-user-check fa-fw mr-3'></i>Peserta Lulus</a>
          <a class='btn btn-danger' href=?module=hasiltes&act=tidaklulus role='button'><i class='fa fa fa-user-slash fa-fw mr-3'></i>Peserta Tidak Lulus</a>      
          </div>
      </div>
        <table class='table table-hover mt-3'>
          <thead><tr align='center'><th>No</th><th>Nama pengguna</th><th>Nama</th><th>Benar</th><th>Salah</th><th>Kosong</th><th>Nilai</th><th>Tanggal Tes</th><th>Keterangan</th><th>Aksi</th></tr></thead>";
                                    $no = 1;
                                    while ($r = mysqli_fetch_array($tampil)) {
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