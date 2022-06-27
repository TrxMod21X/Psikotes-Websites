<?php
if (!isset($_SESSION['login'])) {
  header('Location: authentication/auth.php');
  exit;
}

$aksi = "modul/mod_pengguna/aksi_pengguna.php";

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
              Pengguna
            </div>
            <div class="card-body">

              <?php
              switch ($_GET['act']) {
                  // Tampil Menuatas
                default:
                  $sql  = mysqli_query($conn, "SELECT * FROM tbl_admin");
                  $r    = mysqli_fetch_array($sql);

                  echo "
        <h3>Perbarui Pengguna</h3>
        <hr>
          <form method=POST enctype='multipart/form-data' action=$aksi?module=pengguna&act=update class='form-horizontal'>
          <input type=hidden name=id value=$r[id_admin]>

          <div class='form-group'>
            <label for='inputEmail3' class='col-sm-2 control-label'>Nama Pengguna</label>
            <div class='col-lg-6'>
              <input type=text size=30 class='form-control' name=username value='$r[username]'>
            </div>
          </div>

          <div class='form-group'>
            <label for='inputEmail3' class='col-sm-2 control-label'>Kata Sandi Baru</label>
            <div class='col-lg-6'>
              <input type=password size=30 class='form-control' name=katasandi >
            </div>
          </div>

          <div class='form-group'>
            <label for='inputEmail3' class='col-sm-2 control-label'>Kata Sandi Lama</label>
            <div class='col-lg-6'>
              <input type=password size=30 class='form-control' name=passwordold >
            </div>
          </div>

          <div class='form-group'>
            <label for='inputEmail3' class='col-sm-2 control-label'></label>
            <div class='col-sm-5'>
              <input type='submit' value='Perbarui' class='btn btn-primary'>
            </div>
          </div>

          

         </form>";
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