<?php
require '../../config/koneksi.php';

$totalPage = 0;
$nomorSoal = $_GET['page'];

function getData($query)
{
    global $conn;

    $result = mysqli_query($conn, $query);
    $rows = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}


function checkUserState()
{
    $idUser = $_SESSION['id_user'];
    $statusTest =  getData("SELECT `status_tes` FROM `users` WHERE `id`= $idUser;");

    return $statusTest[0]['status_tes'];
}

function getSoalLength()
{
    $query = getData("SELECT * FROM `soal` WHERE `aktif` = 'Y';");
    $totalSoal = count($query);

    return $totalSoal;
}

function getSoalLengthByCategory($categoryId){
    $query = getData("SELECT * FROM `soal` WHERE `aktif` = 'Y' AND `id_kategori` = $categoryId;");
    $totalSoal = count($query);

    return $totalSoal;
}

function getTestInfo()
{
    $tesInfo = getData("SELECT * FROM `pengaturan_tes`;");
    return $tesInfo[0];
}


function getSoalData($soalLength)
{
    global $totalPage;

    $totalSoalPerPage = 1;
    $totalSoal = $soalLength;
    $totalPage = ceil($totalSoal / $totalSoalPerPage);
    $activePage = (isset($_GET['page'])) ? $_GET['page'] : 1;
    $firstData = ($totalSoalPerPage * $activePage) - $totalSoalPerPage;
    $data = getData("SELECT * FROM `soal` WHERE `aktif` = 'Y' ORDER BY `id_kategori` LIMIT $firstData, $totalSoalPerPage;");


    // $query = mysqli_query($conn, "SELECT * FROM `soal` WHERE `aktif` = 'Y' ORDER BY `id_kategori` LIMIT $firstData, $totalSoalPerPage;");

    return $data;
}


function getSoalCategory($id)
{
    $category =  getData("SELECT `kategori` FROM `kategori_soal` WHERE `id` = $id;");
    
    return $category[0]['kategori'];
}

function getAllCategory(){
    $category = getData("SELECT * FROM `kategori_soal`;");
    return $category;
}

function nextSoal()
{
    global $totalPage;
    
    $page = '?start=test&page=';
    $now = (int)$_GET['page'];
    
    if ($now < $totalPage) {
        $now++;
        $page = '?start=test&page=' . strval($now);
        return $page;
    } else {
        return;
    }
}

function prevSoal()
{

    $page = '?start=test&page=';
    $now = (int)$_GET['page'];

    if ($now != 1) {
        $now--;
        $page = '?start=test&page=' . strval($now);
        return $page;
    } else {
        return;
    }
}


function checkSession(){
    // unset($_SESSION['answer']);
    // $session = $_SESSION['test'];
    // $session1 = $_SESSION['answer'];
    $session = $_SESSION;
    // // $session = $_SESSION['test']['id'][1] = 'a';

    // var_dump($session);
    // echo '<br>';
    var_dump($session);
    echo '<br>';
    var_dump($_COOKIE);
    // echo '<br>';
    // var_dump(sizeof($session));
    // echo '<br>';
    // var_dump(sizeof($session1));
    die;
}