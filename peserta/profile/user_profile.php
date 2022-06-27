<?php
require '../../config/koneksi.php';

$id_user = $_SESSION['id_user'];
$query = mysqli_query($conn, "SELECT * FROM `users` WHERE `id` = $id_user");
$data = mysqli_fetch_assoc($query);

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $tgl_lahir = $_POST['tgl_lahir'];
    $jk = $_POST['jk'];
    $telepon = $_POST['telepon'];
    $alamat = $_POST['alamat'];
    $nisn = $_POST['nisn'];
    $instansi = $_POST['instansi'];
    $jurusan = $_POST['jurusan'];

    $updateQuery = "UPDATE `users` SET `username` = '$username', `nama` = '$nama', `email` = '$email', `tgl_lahir` = '$tgl_lahir', `jk` = '$jk', `telepon` = '$telepon', `alamat` = '$alamat', `nisn` = '$nisn', `instansi` = '$instansi', `jurusan` = '$jurusan' WHERE `users`.`id` = $id_user;";

    mysqli_query($conn, $updateQuery);

    echo '<script>
            alert("Anda Berhasil Merubah data");
            window.location="media.php?hal=profiluser";
         </script>';
}
?>
<div class="row" id="body-row">
    <?php include '../components/sidebar.php' ?>

    <!-- Main -->
    <div class="col">
        <div id="page-wrapper">
            <div class="container-fluid mt-3">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-header bg-info text-white">Profil Peserta</div>
                        <div class="card-body">
                            <h4 align="center">Profil <?= $data['nama'] ?></h4>
                            <hr><br>
                            <h6>Mohon Melengkapi Semua Data.</h6>
                            <hr><br>
                            <form action="" method="POST">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="username">Username</label>
                                        <input type="text" class="form-control" id="username" name="username" value="<?= $data['username'] ?>">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="nama">Nama Lengkap</label>
                                        <input type="text" class="form-control" id="nama" name="nama" value="<?= $data['nama'] ?>">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" value="<?= $data['email'] ?>">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="telepon">Nomor Telepon</label>
                                        <input type="text" class="form-control" id="telepon" name="telepon" placeholder="+62" value="<?= $data['telepon'] ?>">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="nisn">NISN</label>
                                        <input type="text" class="form-control" id="nisn" name="nisn" value="<?= $data['nisn'] ?>">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="instansi">Asal Instasi</label>
                                        <input type="text" class="form-control" id="instansi" name="instansi" value="<?= $data['instansi'] ?>">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="jurusan">Kelas/Jurusan</label>
                                        <input type="text" class="form-control" id="jurusan" name="jurusan" value="<?= $data['jurusan'] ?>">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-2">
                                        <label for="tgl_lahir">Tanggal Lahir</label>
                                        <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir" value="<?= $data['tgl_lahir'] ?>">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="jk">Jenis Kelamin</label>
                                        <select id="jk" name="jk" class="form-control">
                                            <option selected>Pria</option>
                                            <option>Perempuan</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-8">
                                        <label for="alamat">Alamat</label>
                                        <input type="text" class="form-control" id="alamat" name="alamat" value="<?= $data['alamat'] ?>">
                                    </div>
                                </div>
                                <!-- <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="password">Password</label>
                                        <input type="password" class="form-control" id="password" name="password" placeholder="Password dikosongkan jika tidak ingin di edit.">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="password2">Konfirmasi Password</label>
                                        <input type="password" class="form-control" id="password2" name="password2" placeholder="Konfirmasi Password">
                                    </div>
                                </div> -->
                                <div class="form-row mt-4">
                                    <div class="form-group col-md-4 offset-11">
                                        <button class="btn btn-success" type="submit" name="submit"><i class="fa fa-save mr-2"></i>Simpan</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>