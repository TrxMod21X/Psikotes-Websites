<?php
if (!isset($_SESSION['login'])) {
  header('Location: authentication/auth.php');
  exit;
}

$aksi = "modul/mod_soal/aksi_soal.php";

$soals = mysqli_query($conn, "SELECT `soal` FROM `soal`;");

$kategoriSoal = mysqli_query($conn, "SELECT * FROM `kategori_soal`;");

$tblSoal = mysqli_query($conn, "SELECT * FROM `soal` ORDER BY `id` DESC;");

$idFromUrl = isset($_GET['id']) ? $_GET['id'] : 0;

$editSoal = mysqli_query($conn, "SELECT * FROM `soal` WHERE `id` = $idFromUrl;");
$edit = mysqli_fetch_assoc($editSoal);

$viewSoal = mysqli_query($conn, "SELECT * FROM `soal` WHERE `id` = $idFromUrl;");
$view = mysqli_fetch_assoc($viewSoal);

$cariSoal = mysqli_query($conn, "SELECT * FROM `soal` WHERE `soal` LIKE '%$_POST[cari]%';");
$noSoal = 1;

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
              Kelola Soal
            </div>

            <div class="card-body">
              <script language="JavaScript">
                function bukajendela(url) {
                  window.open(url, "window_baru", "width=800,height=500,left=120,top=10,resizable=1,scrollbars=1");
                }
              </script>

              <?php switch ($_GET['act']):
                default: ?>
                  <div class="row">
                    <!-- Button Tambah Soal -->
                    <div class="col-lg-6">
                      <input type="button" class="btn btn-primary" value="Tambah Soal" onclick="window.location.href='?module=soal&act=tambahsoal';">
                    </div>

                    <!-- Search Soal -->
                    <div class="col-lg-6">
                      <form action="?module=soal&act=carisoal" class="form-inline" method="POST">
                        <div class="form-group mx-sm-3 mb-2">
                          <input type="text" class="form-control" name="cari" placeholder="Cari Soal" list="auto" required />
                          <button class='btn btn-success ml-3' type='submit'><i class='fa fa-search mr-1'></i>Cari</button>
                        </div>
                        <datalist id="auto">
                          <?php while ($soal = mysqli_fetch_assoc($soals)) : ?>
                            <option value="<?= $soal['soal'] ?>"></option>
                          <?php endwhile; ?>
                        </datalist>
                      </form>
                    </div>

                    <!-- Show Data Soal -->
                    <table class="table table-hover mt-5 table-bordered">
                      <thead class="table-dark">
                        <tr align="center">
                          <th>No</th>
                          <th>Pertanyaan</th>
                          <th>Status</th>
                          <th>Aksi</th>
                          <th>Lihat</th>
                          <th>Status</th>
                        </tr>
                      </thead>
                      <?php $no = 1; ?>
                      <?php while ($row = mysqli_fetch_assoc($tblSoal)) : ?>
                        <?php $soal = substr($row['soal'], 0, 50); ?>
                        <?php $idSoal = $row['id']; ?>
                        <tr>
                          <!-- Row Nomor -->
                          <td><?= $no ?></td>

                          <!-- Row Soal -->
                          <td><?= $soal ?></td>

                          <!-- Row Status Soal -->
                          <td align="center"><?= ($row['aktif']) == 'Y' ? 'Aktif' : 'Nonaktif'; ?></td>

                          <!-- Button Aksi Soal -->
                          <td align="center">
                            <!-- Button Edit Soal -->
                            <a href="?module=soal&act=editsoal&id=<?= $idSoal ?>" class="btn btn-outline-primary" role="button">
                              <i class="fa fa-edit mr-1"></i>
                              Edit
                            </a>
                            |
                            <!-- Button Hapus Soal -->
                            <a href="<?= $aksi ?>?module=soal&act=hapus&id=<?= $idSoal ?>" class="btn btn-outline-danger" role="button">
                              <i class="fa fa-trash mr-1"></i>
                              Hapus
                            </a>
                          </td>

                          <!-- Button Lihat Soal -->
                          <td align="center">
                            <a href="?module=soal&act=viewsoal&id=<?= $idSoal; ?>" class="btn btn-outline-info">
                              <i class="fa fa-eye mr-1"></i>
                              Lihat
                            </a>
                          </td>

                          <?php if ($row['aktif'] == 'Y') : ?>
                            <!-- Button Non-Aktifkan -->
                            <td align="center">
                              <input type="button" class="btn btn-outline-dark" value="Non-Aktifkan" onclick="window.location.href='<?= $aksi ?>?module=soal&act=nonaktif&id=<?= $idSoal; ?>';">
                            </td>

                            <!-- Button Aktifkan -->
                          <?php else : ?>
                            <td align="center">
                              <input type="button" class="btn btn-outline-success" value="Aktifkan" onclick="window.location.href='<?= $aksi ?>?module=soal&act=aktif&id=<?= $idSoal; ?>';">
                            </td>
                          <?php endif; ?>
                        </tr>
                        <?php $no++ ?>
                      <?php endwhile ?>
                    </table>
                    <?php break; ?>

                  <?php
                case "tambahsoal": ?>
                    <h2 class="mb-3">
                      <i class="fa fa-plus mr-2"></i>
                      Tambah Soal
                    </h2>
                    <hr>
                    <form method="POST" class="form-horizontal" action="<?= $aksi ?>?module=soal&act=input" enctype="multipart/form-data">
                      <!-- SOAL FORM -->
                      <div class="form-group">
                        <label for="soal" class="col-sm-2 control-label">Soal</label>
                        <div class="col-sm-10">
                          <textarea name="soal" id="soal" style="width: 950px; height: 350px;"></textarea>
                        </div>
                      </div>

                      <!-- IMAGE FORM -->
                      <div class="form-group">
                        <label for='fupload' class='col-sm-2 control-label'>Gambar</label>
                        <div class='col-sm-10'>
                          <input type=file name='fupload' id="fupload">
                          <br>Tipe gambar harus JPG/JPEG/PNG dan ukuran lebar maks: 400 px
                        </div>
                      </div>

                      <!-- PILIHAN JAWABAN A -->
                      <div class='form-group'>
                        <label for='a' class='col-sm-2 control-label'>Jawaban A</label>
                        <div class='col-sm-12'>
                          <input type=text name='a' id="a" class='form-control' size=80 required />
                        </div>
                      </div>

                      <!-- PILIHAN JAWABAN B -->
                      <div class='form-group'>
                        <label for='b' class='col-sm-2 control-label'>Jawaban B</label>
                        <div class='col-sm-12'>
                          <input type=text name='b' id="b" class='form-control' size=80 required />
                        </div>
                      </div>

                      <!-- PILIHAN JAWABAN C -->
                      <div class='form-group'>
                        <label for='c' class='col-sm-2 control-label'>Jawaban C</label>
                        <div class='col-sm-12'>
                          <input type=text name='c' id="c" class='form-control' size=80 required />
                        </div>
                      </div>

                      <!-- PILIHAN JAWABAN D -->
                      <div class='form-group'>
                        <label for='d' class='col-sm-2 control-label'>Jawaban D</label>
                        <div class='col-sm-12'>
                          <input type=text name='d' id="d" class='form-control' size=80 required />
                        </div>
                      </div>

                      <!-- PILIHAN JAWABAN E -->
                      <div class='form-group'>
                        <label for='e' class='col-sm-2 control-label'>Jawaban E</label>
                        <div class='col-sm-12'>
                          <input type=text name='e' id="e" class='form-control' size=80 required />
                        </div>
                      </div>

                      <!-- KUNCI JAWABAN -->
                      <div class='form-group'>
                        <label for='kunci' class='col-sm-2 control-label'>Kunci Jawaban</label>
                        <div class='col-sm-4'>
                          <select name='knc_jawaban' id="kunci" class='form-control'>
                            <option value='A'>A</option>
                            <option value='B'>B</option>
                            <option value='C'>C</option>
                            <option value='D'>D</option>
                            <option value='E'>E</option>
                          </select>
                        </div>
                      </div>

                      <!-- KATEGORI SOAL -->
                      <div class='form-group'>
                        <label for='kategori' class='col-sm-2 control-label'>Kategori Soal</label>
                        <div class='col-sm-4'>
                          <select name='kategori_soal' id="kategori" class='form-control'>
                            <?php while ($kategori = mysqli_fetch_assoc($kategoriSoal)) : ?>
                              <option value='<?= $kategori['id'] ?>'><?= $kategori['kategori']; ?></option>
                            <?php endwhile; ?>
                          </select>
                        </div>
                      </div>

                      <!-- ACTION BUTTON -->
                      <div class='form-group'>
                        <label for='buttonAction' class='col-sm-2 control-label'></label>
                        <div class='col-sm-4'>
                          <button class='btn btn-primary' type='submit' name='submit'><i class='fa fa-save mr-1'></i>Simpan</button>
                          <input type=button value=Batal onclick=self.history.back() class='btn btn-danger'>
                        </div>
                      </div>
                    </form>
                    <?php break; ?>

                  <?php
                case 'editsoal': ?>
                    <h2 class="mb-3">
                      <i class="fa fa-edit mr-2"></i>Edit Soal Tes
                    </h2>
                    <hr />
                    <form method="POST" action="<?= $aksi ?>?module=soal&act=update" class="form-horizontal" enctype="multipart/form-data">
                      <input type="hidden" name="id" value="<?= $edit['id']; ?>">

                      <!-- SOAL FORM -->
                      <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Pertanyaan</label>
                        <div class="col-lg-10">
                          <textarea name="soal" style="width: 950px; height: 350px;"><?= $edit['soal']; ?></textarea>
                        </div>
                      </div>

                      <!-- IMAGE THUMB -->
                      <?php if ($edit['gambar'] != '') : ?>
                        <div class="form-group">
                          <label for="img" class="col-sm-2 control-label"></label>
                          <div class="col-sm-10">
                            <img src="../foto/<?= $edit['gambar']; ?>" alt="img" class="img-thumbnail">
                          </div>
                        </div>
                      <?php endif; ?>

                      <!-- IMAGE FORM -->
                      <div class="form-group">
                        <label for="img" class="col-sm-2 control-label">Gambar</label>
                        <div class="col-sm-10">
                          <input type="file" name="fupload" id="img" size="40">
                          <br>Tipe gambar harus JPG/JPEG dan ukuran lebar maks: 400 px
                        </div>
                      </div>

                      <!-- JAWABAN A -->
                      <div class='form-group'>
                        <label for='a' class='col-sm-2 control-label'>Jawaban A</label>
                        <div class='col-sm-4'>
                          <input type=text name='a' id="a" class='form-control' value="<?= $edit['a'] ?>" size=80 required />
                        </div>
                      </div>

                      <!-- JAWABAN B -->
                      <div class='form-group'>
                        <label for='b' class='col-sm-2 control-label'>Jawaban B</label>
                        <div class='col-sm-4'>
                          <input type=text name='b' id="b" class='form-control' value="<?= $edit['b'] ?>" size=80 required />
                        </div>
                      </div>

                      <!-- JAWABAN C -->
                      <div class='form-group'>
                        <label for='c' class='col-sm-2 control-label'>Jawaban C</label>
                        <div class='col-sm-4'>
                          <input type=text name='c' id="c" class='form-control' value="<?= $edit['c'] ?>" size=80 required />
                        </div>
                      </div>

                      <!-- JAWABAN D -->
                      <div class='form-group'>
                        <label for='a' class='col-sm-2 control-label'>Jawaban D</label>
                        <div class='col-sm-4'>
                          <input type=text name='d' id="d" class='form-control' value="<?= $edit['d'] ?>" size=80 required />
                        </div>
                      </div>

                      <!-- JAWABAN E -->
                      <div class='form-group'>
                        <label for='e' class='col-sm-2 control-label'>Jawaban E</label>
                        <div class='col-sm-4'>
                          <input type=text name='e' id="e" class='form-control' value="<?= $edit['e'] ?>" size=80 required />
                        </div>
                      </div>

                      <!-- KUNCI JAWABAN -->
                      <div class='form-group'>
                        <label for='kunci' class='col-sm-2 control-label'>Kunci Jawaban</label>
                        <div class='col-sm-4'>
                          <select name='knc_jawaban' id='kunci' class='form-control'>
                            <option value='A' <?= ($edit['kunci']) == 'A' ? 'selected' : '' ?>>A</option>
                            <option value='B' <?= ($edit['kunci']) == 'B' ? 'selected' : '' ?>>B</option>
                            <option value='C' <?= ($edit['kunci']) == 'C' ? 'selected' : '' ?>>C</option>
                            <option value='D' <?= ($edit['kunci']) == 'D' ? 'selected' : '' ?>>D</option>
                            <option value='E' <?= ($edit['kunci']) == 'E' ? 'selected' : '' ?>>E</option>
                          </select>
                        </div>
                      </div>

                      <!-- KATEGORI SOAL -->
                      <div class='form-group'>
                        <label for='kategori' class='col-sm-2 control-label'>Kategori Soal</label>
                        <div class='col-sm-4'>
                          <select name='kategori_soal' id="kategori" class='form-control'>
                            <?php while ($kategori = mysqli_fetch_assoc($kategoriSoal)) : ?>
                              <option value='<?= $kategori['id'] ?>' <?= ($edit['id_kategori']) == $kategori['id'] ? 'selected' : '' ?>><?= $kategori['kategori']; ?></option>
                            <?php endwhile; ?>
                          </select>
                        </div>
                      </div>

                      <!-- ACTION BUTTON -->
                      <div class='form-group'>
                        <label for='inputEmail3' class='col-sm-2 control-label'></label>
                        <div class='col-sm-4'>
                          <button class='btn btn-primary' type='submit' name='submit'><i class='fa fa-save mr-1'></i>Simpan</button>
                          <input type=button value=Batal onclick=self.history.back() class='btn btn-danger'>
                        </div>
                      </div>
                    </form>
                    <?php break; ?>

                  <?php
                case 'viewsoal': ?>
                    <h2>
                      <i class="fa fa-eye mr-2"></i>Detail Soal
                    </h2>
                    <hr>
                    <div class="container">
                      <a href="?module=soal" class="btn btn-success mb-4">Kembali</a>
                      <h5>Soal Pertanyaan :</h5>
                      <?= $view['soal'] ?><br>
                      <?php if ($view['gambar'] != '') : ?>
                        <img src="../foto/<?= $view['gambar']; ?>" alt="img" class="img-thumbnail mt-2 mb-2">
                      <?php endif; ?>
                      <h5>Jawaban :</h5>
                      a. <?= $view['a']; ?> <br>
                      b. <?= $view['b']; ?> <br>
                      c. <?= $view['c']; ?> <br>
                      d. <?= $view['d']; ?> <br>
                      e. <?= $view['e']; ?> <br>
                      <h5>Kunci Jawaban : <?= $view['kunci']; ?></h5>
                    </div>
                    <?php break; ?>

                  <?php
                case 'carisoal': ?>
                    <h2>
                      <i class="fa fa-search mr-3"></i>
                      Hasil Pencarian
                    </h2>
                    <hr>
                    <a href="?module=soal" role="button" class="btn btn-success mt-1 mb-1">
                      <i class="fa fa-sign-out-alt mr-1"></i>
                      Kembali
                    </a>
                    <table class="table table-hover mt-3">
                      <thead class="table-dark">
                        <tr align="center">
                          <th>No</th>
                          <th>Pertanyaan</th>
                          <th>Status</th>
                          <th>Aksi</th>
                          <th>Status</th>
                          <th>Lihat</th>
                        </tr>
                      </thead>
                      <?php while ($soal = mysqli_fetch_assoc($cariSoal)) : ?>
                        <?php $id = $soal['id']; ?>
                        <tr>
                          <td align="center">
                            <?= $noSoal; ?>
                          <td><?= $soal['soal']; ?></td>
                          <td align="center"><?= $soal['aktif']; ?></td>
                          <td align="center">
                            <a href="?module=soal&act=editsoal&id=<?= $id; ?>" role="button" class="btn btn-outline-primary">
                              <i class="fa fa-edit mr-1"></i>
                            </a>
                            <a class='btn btn-outline-danger' href="<?= $aksi; ?>?module=soal&act=hapus&id=<?= $id; ?>" role='button'><i class='fa fa-trash mr-1'></i></a>
                          </td>
                          <?php if ($soal['aktif'] == 'Y') : ?>
                            <td align='center'>
                              <input class='btn btn-outline-dark' type="button" value='Non- Aktifkan' onclick="window.location.href='<?= $aksi ?>?module=soal&act=nonaktif&id=$<?= $id ?> ';">
                            </td>
                          <?php else : ?>
                            <td align='center'>
                              <input class='btn btn-outline-success' type="button" value='Aktifkan' onclick="window.location.href='<?= $aksi ?>?module=soal&act=aktif&id=$<?= $id ?> ';">
                            </td>
                          <?php endif; ?>
                          <td align="center">
                            <a href="?module=soal&act=viewsoal&id=<?= $id; ?>" role="button" class="btn btn-outline-info">
                              <i class="fa fa-eye mr-1"></i>
                            </a>
                          </td>
                        </tr>
                        <?php $noSoal++; ?>
                      <?php endwhile; ?>
                    </table>
                    <?php break; ?>
                  </div>
              <?php endswitch; ?>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script type="text/javascript">
      var $ = jQuery;
      $('#knc_jawaban').val('<?php echo $r['knc_jawaban']; ?>');
    </script>
  </div>
</div>