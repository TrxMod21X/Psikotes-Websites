<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="../asset/css/bootstrap.min.css">
  <link rel="stylesheet" href="../asset/css/all.css">
  <link rel="stylesheet" href="../asset/css/bet.css">

  <title>Admin Login</title>
</head>

<body>
  <div class="container">
    <div class="row mt-5">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card card-signin my-5">
          <div class="card-body">
            <!-- <h5 class="card-title text-center"><img src="../asset/img/1.jpg" alt="" style="height: 50px;"> APLIKASI PSIKOTES ONLINE</h5> -->
            <h5 class="card-title text-center">PSIKOTES ONLINE ADMIN PANEL</h5>
            <form class="form-signin" name="form" action="cek_login.php" id="loginF" method="post">
              <div class="form-label-group">
                <input type="text" id="username" name="username" class="form-control" placeholder="Nama Pengguna" required autofocus>
                <label for="username">Nama Pengguna</label>
              </div>

              <div class="form-label-group">
                <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
                <label for="password">Kata Sandi</label>
              </div>

              <button class="btn btn-lg btn-danger btn-block text-uppercase" type="submit">MASUK</button>
              <hr class="my-4">
              <p class="text-center"> &copy; 2022</p>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Optional JavaScript -->
  <script src="asset/js/sweetalert2.all.min.js"></script>
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="asset/js/bootstrap.min.js"></script>
  <script src="asset/js/jquery-3.3.1.slim.min.js"></script>
  <script src="asset/js/popper.min.js"></script>
</body>

</html>