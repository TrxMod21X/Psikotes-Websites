<?php
if (!isset($_SESSION['login'])) {
  header('Location: authentication/auth.php');
  exit;
}

$aksi = "modul/mod_users/aksi_users.php";

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
        <div class="row">
          <div class="col-lg-12">
            <div class="card-header bg-info text-white">
              Daftar Peserta
            </div>
            <div class="card-body">

              <?php
              switch ($_GET['act']) {
                  // Tampil User
                default:
                  // cetak
                  echo "<div class='row'>
<div class='col-lg-6'>
    <a class='btn btn-warning' href='cetak/cetakpeserta.php' role='button' target='_blank' rel='noopener noreferrer'><span class='fa fa-print fa-fw mr-3'></span>Cetak</a>
</div>";
                  //   Cari
                  echo "<div col-lg-6>
<form class='form-inline'method='POST' action=?module=users&act=cariusers>
<div class='form-group mx-sm-3 mb-2'>
<input class='form-control' type=text name='cari'  placeholder='Masukkan Nama' list='auto'  required/>
<button class='btn btn-success ml-3' type='submit'><i class='fa fa-search mr-1'></i>Cari</button></div></div>";
                  echo "<datalist id='auto'>";
                  $qry = mysqli_query($conn, "SELECT * FROM tbl_user");
                  while ($t = mysqli_fetch_array($qry)) {
                    echo "<option value='$t[nama]'>";
                  }
                  echo "</datalist></form>
</div>";
                  $tampil = mysqli_query($conn, "SELECT * FROM tbl_user");
                  echo "
      <div class='row'>
      <div class='col-12 col sm-3'></div>
    <table class='table table-hover mt-3'>
          <tr align='center'><th>No</th><th>Username</th><th>Nama</th><th>Jenis Kelamin</th><th>Status Tes</th><th>Status</th><th>Lihat</th><th>Hapus</th><th>Aksi</th></tr>";
                  $no = 1;
                  while ($r = mysqli_fetch_array($tampil)) {
                    echo "<tr><td align='center'>$no</td>
             <td>$r[username]</td>
            <td>$r[nama]</td>
        <td>$r[jk]</td>";
                    if ($r['stat_tes'] == "Sudah") {
                      echo "<td>Selesai Mengerjakan</td>";
                    } else {
                      echo "<td>Belum Mengerjakan</td>";
                    }

                    echo  "<td align=center>$r[statusaktif]</td>
        <td align='center'><a class='btn btn-outline-info' href='?module=users&act=lihat&id=$r[id_user]' role='button'><i class='fa fa-eye mr-1'></i>Lihat</a></td>
             <td align='center'><a class='btn btn-outline-danger' href=$aksi?module=users&act=hapus&id=$r[id_user] role='button'><i class='fa fa-trash mr-1'></i>Hapus</a></td>";
                    if ($r['statusaktif'] == "Y") {
                      echo "<td align='center'><input type=button class='btn btn-outline-dark' value='Non Aktifkan' onclick=\"window.location.href='$aksi?module=users&act=nonaktif&id=$r[id_user]';\"></td>";
                    } else {
                      echo "<td align='center'><input class='btn btn-outline-success' type=button value='Aktifkan' onclick=\"window.location.href='$aksi?module=users&act=aktif&id=$r[id_user]';\"></td>";
                    }
                    echo "</tr>";
                    $no++;
                  }
                  echo "</table></div>";
                  break;

                case "lihat":
                  $tampil = mysqli_query($conn, "SELECT * FROM tbl_user WHERE id_user='$_GET[id]'");
                  $t = mysqli_fetch_array($tampil);
                  echo "
  <table width='60%'>
    <tr><th colspan=2 align='center'>DETAIL PESERTA</th></tr>
    <tr><td>Username</td><td>$t[username]</td></tr>
    <tr><td>Nama</td><td>$t[nama]</td></tr>
    <tr><td>Tgl Lahir </td><td>$t[tgl_lahir]</td></tr>
    <tr><td>Jenis Kelamin </td><td>$t[jk]</td> </tr>
    <tr><td>Email </td><td>$t[email]</td></tr>
    <tr> <td>Telp</td><td>$t[telp]</td></tr>
    <tr><td>Alamat</td><td>$t[alamat]</td></tr>
  </table>
  <a class='btn btn-success mt-5' href='?module=users' role='button'><i class='fa fa-sign-out-alt mr-1'></i>Kembali</a>";
                  break;

                case "cariusers":
                  echo "<h2><i class='fa fa-search mr-3'></i>Hasil Pencarian</h2><hr/>
       <a class='btn btn-success mt-1 mb-1' href='?module=users' role='button'><i class='fa fa-sign-out-alt mr-1'></i>Kembali</a>
     <table class='table table-hover mt-3'>
          <thead><tr align='center'><th>No</th><th>Nama</th><th>Email</th><th>Aksi</th><th>Status</th><th>Lihat</th></tr></thead>";
                  $tampil = mysqli_query($conn, "SELECT * FROM tbl_user WHERE nama LIKE '%$_POST[cari]%'");
                  $no = 1;
                  while ($r = mysqli_fetch_array($tampil)) {
                    echo "<tr><td align='center'>$no</td>
             <td>$r[nama]</td>
       <td align='center'>$r[email]</td>
             <td align='center'>
        <a class='btn btn-outline-danger' href=$aksi?module=users&act=hapus&id=$r[id_user] role='button'><i class='fa fa-trash mr-1'></i></a></td>";
                    if ($r['statusaktif'] == "Y") {
                      echo "<td align='center'><input class='btn btn-outline-dark' type=button value='Non Aktifkan' onclick=\"window.location.href='$aksi?module=users&act=nonaktif&id=$r[id_user]';\"></td>";
                    } else {
                      echo "<td align='center'><input class='btn btn-success' type=button value='Aktifkan' onclick=\"window.location.href='$aksi?module=users&act=aktif&id=$r[id_user]';\"></td>";
                    }

                    echo "   </td>
    <td align='center'><a class='btn btn-outline-info' href=?module=users&act=lihat&id=$r[id_user] role='button'><i class='fa fa-eye mr-1'></i></a></td>

    </tr>";
                    $no++;
                  }
                  echo "</table>";
                  break;
              }
              ?>

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