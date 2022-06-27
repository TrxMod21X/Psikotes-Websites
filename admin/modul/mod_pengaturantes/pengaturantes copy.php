<?php
if (!isset($_SESSION['login'])) {
  header('Location: authentication/auth.php');
  exit;
}
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
              Pengaturan Tes
            </div>
            <div class="card-body">

              <?php
              $aksi = "modul/mod_pengaturantes/aksi_pengaturantes.php";
              switch ($_GET['act']) {
                  // Tampil Menuatas
                default:
                  $sql  = mysqli_query($conn, "SELECT * FROM tbl_pengaturan_tes");
                  $r    = mysqli_fetch_array($sql);

                  echo "
          <form method=POST enctype='multipart/form-data' action=$aksi?module=pengaturantes&act=update class='form-horizontal'>
          <input type=hidden name=id value=$r[id]>

          <div class='form-group'>
            <label for='inputEmail3' class='col-sm-2 control-label'>Nama Tes</label>
            <div class='col-lg-6'>
              <input type=text size=30 class='form-control' name=nama_tes value='$r[nama_tes]'>
            </div>
          </div>

          <div class='form-group'>
            <label for='inputEmail3' class='col-sm-2 control-label'>Waktu Pengerjaan</label>
            <div class='col-lg-6'>
              <input type=text size=30 class='form-control' name=waktu value='$r[waktu]'>
            </div>
          </div>

          <div class='form-group'>
            <label for='inputEmail3' class='col-sm-2 control-label'>Nilai Minimum</label>
            <div class='col-lg-6'>
              <input type=text size=30 class='form-control' name=nilai_min value='$r[nilai_min]'>
            </div>
          </div>

          <div class='form-group'>
            <label for='inputEmail3' class='col-sm-2 control-label'>Peraturan</label>
            <div class='col-lg-12'>
              <textarea name='peraturan' style='width: 950px; height: 350px;'>$r[peraturan]</textarea>
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