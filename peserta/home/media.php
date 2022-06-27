<?php
session_start();
if (!isset($_SESSION['login'])) {
    header('Location: ../authentication/auth.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Font Icon -->
    <link rel="stylesheet" href="../../asset/fontawesome-free-5.7.2-web/css/all.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../../asset/css/bootstrap.min.css">

    <!-- Sidebar css -->
    <link rel="stylesheet" href="../../admin/assets/css/sidebar.css">

    <script src="../../nicEdit.js"></script>

    <script type="text/javascript">
        bkLib.onDomLoaded(function() {
            nicEditors.allTextAreas()
        });
    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <title><?= $_GET['hal'] ?></title>
</head>

<body>
    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
        <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
        </symbol>
    </svg>

    <div id="wrapper">
        <?php include 'content.php' ?>
    </div>

    <script src="../../asset/dist/sweetalert2.all.min.js"></script>
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="../../asset/js/bootstrap.min.js"></script>
    <!-- <script src="../../asset/js/jquery-3.3.1.slim.min.js"></script>
    <script src="../../asset/js/popper.min.js"></script> -->
</body>

</html>