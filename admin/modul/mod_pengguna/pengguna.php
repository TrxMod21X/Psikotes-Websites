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
      <a href="?module=pengaturantes"
        class="bg-dark list-group-item list-group-item-action flex-column align-items-start">
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
      <a href="http://localhost/psikotes/admin/logout.php"
        class="bg-dark list-group-item list-group-item-action flex-column align-items-start">
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
            <!-- <div class="card border-danger"> -->
            <div class="card-header bg-info text-white">
              Pengguna
            </div>
            <div class="card-body">


              <?php
$aksi="modul/mod_pengguna/aksi_pengguna.php";
switch($_GET[act]){
  // Tampil Menuatas
  default:
    $sql  = mysql_query("SELECT * FROM tbl_admin");
    $r    = mysql_fetch_array($sql);

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