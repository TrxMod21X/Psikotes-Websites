<?php
ob_start();
session_start();
error_reporting(0);

$sesi_username    = isset($_SESSION['username']) ? $_SESSION['username'] : NULL;
if ($sesi_username == NULL || empty($sesi_username) )
{
    session_destroy();
    header('Location:../login.php?status=Silahkan Login');
}

?>
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Font Icon -->
  <link rel="stylesheet" href="../asset/fontawesome-free-5.7.2-web/css/all.css">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="../asset/css/bootstrap.min.css">

  <!-- Sidebar css -->
  <link rel="stylesheet" href="http://localhost/psikotes/admin/assets/css/sidebar.css">

  <script src="nicEdit.js"></script>
  <script type="text/javascript">
    bkLib.onDomLoaded(function () {
      nicEditors.allTextAreas()
    });
  </script>
  <title>Psikotes Online</title>
</head>

<body>

  <div id="wrapper">

    <!-- Navigasi -->
    <?php include "content.php"; ?>

    <!-- #pagewrapper -->
  </div>

  <!-- Optional JavaScript -->
  <!-- localhost/psikotes/asset/dist/sweetalert2.all.min.js -->
  <script src="http://localhost/psikotes/asset/dist/sweetalert2.all.min.js"></script>
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="../asset/js/bootstrap.min.js"></script>
  <script src="../asset/js/jquery-3.3.1.slim.min.js"></script>
  <script src="../asset/js/popper.min.js"></script>
</body>

</html>