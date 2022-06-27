<?php 

require '../../config/koneksi.php';


if($_GET['hal'] == 'home'){
    include '../components/header.php';
    include 'home.php';
}

?>