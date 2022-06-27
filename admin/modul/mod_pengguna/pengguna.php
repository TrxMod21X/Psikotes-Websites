<?php
if (!isset($_SESSION['login'])) {
  header('Location: authentication/auth.php');
  exit;
}

$aksi = "modul/mod_pengguna/aksi_pengguna.php";
$admin = mysqli_query($conn, "SELECT * FROM `admin`;");
$data = mysqli_fetch_assoc($admin);
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
              <?php switch ($_GET['act']):
                default: ?>
                  <h3>Perbarui Pengguna</h3>
                  <hr>
                  <form method="POST" enctype='multipart/form-data' action="<?= $aksi; ?>?module=pengguna&act=update" class='form-horizontal'>
                    <input type="hidden" name="id" value="<?= $data['id']; ?>">

                    <div class='form-group'>
                      <label for='nama' class='col-sm-2 control-label'>Nama Pengguna</label>
                      <div class='col-lg-6'>
                        <input type="text" id="nama" class='form-control' name="username" value="<?= $data['username']; ?>">
                      </div>
                    </div>

                    <div class='form-group'>
                      <label for='password' class='col-sm-2 control-label'>Kata Sandi Baru</label>
                      <div class='col-lg-6'>
                        <input id="password" type="password" class='form-control' name="password">
                      </div>
                    </div>

                    <div class='form-group'>
                      <label for='oldPass' class='col-sm-2 control-label'>Kata Sandi Lama</label>
                      <div class='col-lg-6'>
                        <input id="oldPass" type="password" class='form-control' name="passwordold">
                      </div>
                    </div>

                    <div class='form-group'>
                      <label for='inputEmail3' class='col-sm-2 control-label'></label>
                      <div class='col-sm-5'>
                        <input type='submit' value='Perbarui' class='btn btn-primary'>
                      </div>
                    </div>
                  </form>"
                  <?php break; ?>
              <?php endswitch; ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>