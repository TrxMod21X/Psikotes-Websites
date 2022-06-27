<?php
if (!isset($_SESSION['login'])) {
  header('Location: authentication/auth.php');
  exit;
}

$aksi = "modul/mod_users/aksi_users.php";

$userQuery = mysqli_query($conn, "SELECT * FROM `users`;");
$datas = mysqli_query($conn, "SELECT * FROM `users`;");

if (isset($_GET['id'])) {
  $lihatUser = mysqli_query($conn, "SELECT * FROM `users` WHERE `id` = $_GET[id];");
  $detailUser = mysqli_fetch_assoc($lihatUser);
}

if (isset($_POST['cari'])) {

  $cari = mysqli_query($conn, "SELECT * FROM `users` WHERE `nama` LIKE '%$_POST[cari]%';");
}
$no = 1;
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
              Daftar Peserta
            </div>
            <div class="card-body">
              <?php switch ($_GET['act']):
                default: ?>
                  <div class='row'>
                    <div class='col-lg-6'>
                      <a class='btn btn-warning' href='cetak/cetakpeserta.php' role='button' target='_blank' rel='noopener noreferrer'><span class='fa fa-print fa-fw mr-3'></span>Cetak</a>
                    </div>

                    <div col-lg-6>
                      <form class='form-inline' method='POST' action=?module=users&act=cariusers>
                        <div class='form-group mx-sm-3 mb-2'>
                          <input class='form-control' type=text name='cari' placeholder='Masukkan Nama' list='auto' required />
                          <button class='btn btn-success ml-3' type='submit'><i class='fa fa-search mr-1'></i>Cari</button>
                        </div>
                        <datalist id='auto'>
                          <?php while ($user = mysqli_fetch_assoc($userQuery)) : ?>
                            <option value="<?= $user['nama']; ?>">
                            <?php endwhile; ?>
                        </datalist>
                      </form>
                    </div>
                  </div>

                  <div class='row'>
                    <div class='col-12 col sm-3'></div>
                    <table class='table table-hover mt-5 table-bordered'>
                      <thead class="table-dark">
                        <tr align='center'>
                          <th>No</th>
                          <th>Username</th>
                          <th>Nama</th>
                          <th>Jenis Kelamin</th>
                          <th>Status Tes</th>
                          <th>Status</th>
                          <th>Lihat</th>
                          <th>Hapus</th>
                          <th>Aksi</th>
                        </tr>
                      </thead>
                      <?php $nomor = 1; ?>
                      <?php while ($data = mysqli_fetch_assoc($datas)) : ?>
                        <tr>
                          <td><?= $nomor; ?></td>
                          <td><?= $data['username']; ?></td>
                          <td><?= $data['nama']; ?></td>
                          <td align="center"><?= ($data['jk']) ? $data['jk'] : 'Belum di set'; ?></td>
                          <td align="center"> <?= ($data['status_tes']) == 'SUDAH' ? 'Selesai Mengerjakan' : 'Belum Mengerjakan'; ?></td>
                          <td align="center"><?= ($data['statusaktif']) == 'Y' ? 'Aktif' : 'Nonaktif'; ?></td>
                          <td align='center'><a class='btn btn-outline-info' href='?module=users&act=lihat&id=<?= $data['id']; ?>' role='button'><i class='fa fa-eye mr-1'></i>Lihat</a></td>
                          <td align='center'><a class='btn btn-outline-danger' href="<?= $aksi; ?>?module=users&act=hapus&id=<?= $data['id']; ?>" role='button'><i class='fa fa-trash mr-1'></i>Hapus</a></td>
                          <?php if ($data['statusaktif'] == 'Y') : ?>
                            <td align='center'><input type=button class='btn btn-outline-dark' value='Non-Aktifkan' onclick="window.location.href='<?= $aksi; ?>?module=users&act=nonaktif&id=<?= $data['id']; ?>';"></td>
                          <?php else : ?>
                            <td align='center'><input type=button class='btn btn-outline-success' value='Aktifkan' onclick="window.location.href='<?= $aksi; ?>?module=users&act=aktif&id=<?= $data['id']; ?>';"></td>
                          <?php endif; ?>
                        </tr>
                        <?php $nomor++; ?>
                      <?php endwhile; ?>
                    </table>
                  </div>
                  <?php break; ?>

                <?php
                case 'lihat': ?>
                  <table width='60%'>
                    <tr>
                      <th colspan=2 align='center'>DETAIL PESERTA</th>
                    </tr>
                    <tr>
                      <td>Username</td>
                      <td><?= $detailUser['username']; ?></td>
                    </tr>
                    <tr>
                      <td>Nama</td>
                      <td><?= $detailUser['nama']; ?></td>
                    </tr>
                    <tr>
                      <td>Tgl Lahir </td>
                      <td><?= ($detailUser['tgl_lahir']) ? $detailUser['tgl_lahir'] : 'Belum di set'; ?></td>
                    </tr>
                    <tr>
                      <td>Jenis Kelamin </td>
                      <td><?= ($detailUser['jk']) ? $detailUser['jk'] : 'Belum di set'; ?></td>
                    </tr>
                    <tr>
                      <td>Email </td>
                      <td><?= $detailUser['email']; ?></td>
                    </tr>
                    <tr>
                      <td>Telp</td>
                      <td><?= ($detailUser['telepon']) ? $detailUser['telepon'] : 'Belum di set'; ?></td>
                    </tr>
                    <tr>
                      <td>Alamat</td>
                      <td><?= ($detailUser['alamat']) ? $detailUser['alamat'] : 'Belum di set'; ?></td>
                    </tr>
                  </table>
                  <a class='btn btn-success mt-5' href='?module=users' role='button'><i class='fa fa-sign-out-alt mr-1'></i>Kembali</a>
                  <?php break; ?>

                <?php
                case 'cariusers': ?>
                  <h2><i class='fa fa-search mr-3'></i>Hasil Pencarian</h2>
                  <hr />
                  <a class='btn btn-success mt-1 mb-1' href='?module=users' role='button'><i class='fa fa-sign-out-alt mr-1'></i>Kembali</a>
                  <table class='table table-hover mt-5 table-bordered'>
                    <thead class="table-dark">
                      <tr align='center'>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Aksi</th>
                        <th>Status</th>
                        <th>Lihat</th>
                      </tr>
                    </thead>
                    <?php while ($hasil = mysqli_fetch_assoc($cari)) : ?>
                      <tr>
                        <td align="center"><?= $no; ?></td>
                        <td><?= $hasil['nama']; ?></td>
                        <td align="center"><?= $hasil['email']; ?></td>
                        <td align='center'>
                          <a class='btn btn-outline-danger' href="<?= $aksi; ?>?module=users&act=hapus&id=<?= $hasil['id']; ?>" role='button'><i class='fa fa-trash mr-1'></i></a>
                        </td>
                        <?php if ($hasil['statusaktif'] == 'Y') : ?>
                          <td align='center'><input type=button class='btn btn-outline-dark' value='Non-Aktifkan' onclick="window.location.href='<?= $aksi; ?>?module=users&act=nonaktif&id=<?= $hasil['id']; ?>"></td>
                        <?php else : ?>
                          <td align='center'><input type=button class='btn btn-outline-success' value='Aktifkan' onclick="window.location.href='<?= $aksi; ?>?module=users&act=aktif&id=<?= $hasil['id']; ?>"></td>
                        <?php endif; ?>
                        </td>
                        <td align='center'><a class='btn btn-outline-info' href="?module=users&act=lihat&id=<?= $hasil['id'] ?>" role='button'><i class='fa fa-eye mr-1'></i></a></td>
                      </tr>
                      <?php $no++; ?>
                    <?php endwhile; ?>
                  </table>
                  <?php break; ?>
              <?php endswitch; ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>