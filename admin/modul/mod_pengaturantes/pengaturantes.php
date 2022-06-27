<?php
if (!isset($_SESSION['login'])) {
  header('Location: authentication/auth.php');
  exit;
}

$aksi = "modul/mod_pengaturantes/aksi_pengaturantes.php";

$pengaturan = mysqli_query($conn, "SELECT * FROM `pengaturan_tes`;");
$data = mysqli_fetch_assoc($pengaturan);

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
              <?php switch ($_GET['act']):
                default: ?>
                  <form method="POST" enctype='multipart/form-data' action="<?= $aksi ?>?module=pengaturantes&act=update" class='form-horizontal'>
                    <input type="hidden" name="id" value="<?= $data['id'] ?>">
                    <div class='form-group'>
                      <label for='nama' class='col-sm-2 control-label'>Nama Tes</label>
                      <div class='col-lg-6'>
                        <input id="nama" type="text" class='form-control' name="nama_tes" value="<?= $data['nama_tes']; ?>">
                      </div>
                    </div>

                    <div class='form-group'>
                      <label for='waktu' class='col-sm-2 control-label'>Waktu Pengerjaan (Menit)</label>
                      <div class='col-lg-6'>
                        <input type="text" class='form-control' name="waktu" id="waktu" value="<?= $data['waktu']; ?>">
                      </div>
                    </div>

                    <div class='form-group'>
                      <label for='nilai' class='col-sm-2 control-label'>Nilai Minimum</label>
                      <div class='col-lg-6'>
                        <input id="nilai" type="text" class='form-control' name="nilai_min" value="<?= $data['nilai_min']; ?>">
                      </div>
                    </div>

                    <div class='form-group'>
                      <label for='peraturan' class='col-sm-2 control-label'>Peraturan</label>
                      <div class='col-lg-12'>
                        <textarea id="peraturan" name='peraturan' style='width: 950px; height: 350px;'><?= $data['peraturan']; ?></textarea>
                      </div>
                    </div>

                    <div class='form-group'>
                      <label for='inputEmail3' class='col-sm-2 control-label'></label>
                      <div class='col-sm-5'>
                        <input type='submit' value='Perbarui' class='btn btn-primary'>
                      </div>
                    </div>
                  </form>
                  <?php break; ?>
              <?php endswitch; ?>
              <?php ?>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>