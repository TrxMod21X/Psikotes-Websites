<?php
require '../../config/koneksi.php';

if ($_GET['hal'] == 'home') {
    include '../components/header.php';
    include 'home.php';
}

if ($_GET['hal'] == 'profiluser') {
    include '../components/header.php';
    include '../profile/user_profile.php';
}

if ($_GET['hal'] == 'soal') {
    include '../components/header.php';
    include '../soal/main.php';
}

if ($_GET['start'] == 'test'){
    include '../components/header.php';
    include '../soal/soal_bck.php';
}
