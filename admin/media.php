<?php
session_start();
if (!isset($_SESSION['login'])) {
  header('Location: authentication/auth.php');
  exit;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Font Icon -->
  <link rel="stylesheet" href="../asset/fontawesome-free-5.7.2-web/css/all.css">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="../asset/css/bootstrap.min.css">

  <!-- Sidebar css -->
  <link rel="stylesheet" href="assets/css/sidebar.css">

  <!-- Style CSS Sendiri -->
  <link rel="stylesheet" href="assets/css/style.css">

  <script src="../nicEdit.js"></script>
  <script type="text/javascript">
    bkLib.onDomLoaded(function() {
      nicEditors.allTextAreas()
    });
  </script>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

  <title><?= $_GET['module'] ?></title>

</head>

<body>

  <div id="wrapper">
    <!-- Navigasi -->
    <?php include "content.php" ?>
  </div>

  <!-- Optional JavaScript -->
  <!-- localhost/psikotes/asset/dist/sweetalert2.all.min.js -->
  <script src="../asset/dist/sweetalert2.all.min.js"></script>
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="../asset/js/bootstrap.min.js"></script>
  <!-- <script src="../asset/js/jquery-3.3.1.slim.min.js"></script> -->
  <!-- <script src="../asset/js/popper.min.js"></script> -->
</body>

</html>