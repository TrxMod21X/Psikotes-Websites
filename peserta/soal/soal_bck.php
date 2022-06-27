<?php

require 'action.php';
require '../../config/library.php';
require '../../config/koneksi.php';

if (!isset($_COOKIE['start']) || $_SESSION['start'] === false) {
    header('Location: ?hal=soal');
    exit;
}

// checkSession();
$allCategory = getAllCategory();
$totalCategory = count($allCategory);
$totalSoal = getSoalLengthByCategory($_GET['category']);
$soalKategori = getSoalCategory($_GET['category']);
$infoTes = getTestInfo();
$kategoriAktif = $_GET['category'];
?>

<div class="row" id="body-row">
    <!-- Sidebar -->
    <div id="sidebar-container" class="sidebar-expanded d-none d-md-block">
        <ul class="list-group">
            <li class="list-group-item sidebar-separator-title text-muted d-flex align-items-center menu-collapsed">
                <small>Kategori</small>
            </li>
            <?php foreach ($allCategory as $kategori) : ?>
                <a href="?start=test&category=<?= $kategori['id'] ?>" class="bg-dark list-group-item list-group-item-action flex-column align-items-start">
                    <div class="d-flex w-100 justify-content-start align-items-center">
                        <span class="fa fa-file fa-fw mr-3"></span>
                        <span class="menu-collapsed"><?= $kategori['kategori'] ?></span>
                    </div>
                </a>
            <?php endforeach; ?>
        </ul>
    </div>
    <!-- EndSidebar -->

    <!-- Main Content -->
    <div class="col">
        <div class="page-wrapper">
            <div class="container mt-3">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-header bg-info text-white">Soal</div>
                        <div class="card-body">
                            <!-- Info Soal -->
                            <div class="container">
                                <div class="row">
                                    <div class="col-11">
                                        <table>
                                            <tr>
                                                <th>
                                                    <i class="fas fa-clock mr-2"></i>
                                                    <p style="display: inline;">Waktu Tersisa</p><br>
                                                </th>
                                            </tr>
                                            <tr>
                                                <td align="center">
                                                    <span id="show" style="font-size: 18px;"></span>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="col-1">
                                        <table>
                                            <tr>
                                                <th>
                                                    <p style="display: inline;" id="current-questions">0</p>
                                                    <p style="display: inline;">/</p>
                                                    <p id="total-soal" style="display: inline;">0</p>
                                                </th>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- Info Soal -->

                            <!-- Soal -->
                            <div style="width: 100%; border: 1px solid #EBEBEB; overflow: auto; min-height: 400px;">
                                <table class="table" border="0" id="soal-container">

                                </table>
                            </div>
                            <!-- End Soal -->

                            <!-- Button -->
                            <div class="row" style="margin-top: 10px;">

                                <!-- Previous Button -->
                                <div class="col-lg-6" style="min-height: 50px;">
                                    <button class="btn rounded-circle" onclick="loadPrevious();">
                                        <span style="color: red;">
                                            <i class="fa fa-arrow-circle-left fa-3x mt-2"></i>
                                        </span>
                                    </button>
                                </div>
                                <!-- End Previous Button -->


                                <!-- Complete Test Button -->
                                <div id="complete-btn" class="col-lg-6 text-right" style="min-height: 50px; display: none;">
                                    <button class="btn rounded-circle" onclick="complete();">
                                        <span style="color: green;">
                                            <i class="fa fa-check-circle fa-3x mt-2"></i>
                                        </span>
                                    </button>
                                </div>
                                <!-- End Complete Test Button -->

                                <!-- Next Button -->
                                <div id="next-btn" class="col-lg-6 text-right" style="min-height: 50px;">
                                    <button class="btn rounded-circle" onclick="loadNext();">
                                        <span style="color: blue;">
                                            <i class="fa fa-arrow-circle-right fa-3x mt-2"></i>
                                        </span>
                                    </button>
                                </div>
                                <!-- End Next Button -->


                            </div>
                            <!-- End Button -->

                            <script>
                                $(document).ready(function() {
                                   myTimer = setInterval(function() {
                                        // $('#show').load('../soal/timer.php');
                                        timer();
                                    }, 1000);
                                });

                                function timer() {
                                    var xmlhttp = new XMLHttpRequest();
                                    xmlhttp.onreadystatechange = function() {
                                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                                            if (xmlhttp.responseText == 'timeout') {
                                                clearInterval(myTimer);
                                                alert("Waktu Anda Telah Habis.");
                                                complete();
                                            }
                                            document.getElementById('show').innerHTML = xmlhttp.responseText;
                                        }
                                    }
                                    xmlhttp.open('GET', '../soal/timer.php', true);
                                    xmlhttp.send(null);
                                }

                                var questionNumber = 1;
                                var categoryId = <?= $_GET['category'] ?>;
                                var totalSoalPerPage = <?= $infoTes['pagination'] ?>;
                                var totalSoal = <?= $totalSoal ?>;
                                var totalCategory = <?= $totalCategory ?>;
                                var soalKategori = '<?= $soalKategori ?>';

                                load_total_que(categoryId);
                                load_questions(questionNumber);

                                function radioClick(radioValue, soalId) {
                                    var xmlhttp = new XMLHttpRequest();
                                    xmlhttp.onreadystatechange = function() {
                                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {

                                        }
                                    }
                                    xmlhttp.open('GET', '../soal/forajax/save_user_answer.php?idSoal=' + soalId + '&value=' + radioValue + '&cat=' + categoryId, true);
                                    xmlhttp.send(null);
                                }

                                function load_total_que(kategori) {
                                    var xmlhttp = new XMLHttpRequest();
                                    xmlhttp.onreadystatechange = function() {
                                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                                            document.getElementById('total-soal').innerHTML = xmlhttp.responseText;
                                        }
                                    }
                                    xmlhttp.open('GET', '../soal/forajax/load_total_que.php?category=' + kategori, true);
                                    xmlhttp.send(null);
                                }


                                function load_questions(questionNumber) {
                                    document.getElementById('current-questions').innerHTML = questionNumber;

                                    if (categoryId == totalCategory && questionNumber == totalSoal) {
                                        document.getElementById('next-btn').style.display = 'none';
                                        document.getElementById('complete-btn').style.display = null;
                                    }

                                    var xmlhttp = new XMLHttpRequest();
                                    xmlhttp.onreadystatechange = function() {
                                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                                            document.getElementById('soal-container').innerHTML = xmlhttp.responseText;
                                        }
                                    }
                                    xmlhttp.open('GET', '../soal/forajax/load_questions.php?number=' + questionNumber + '&category=' + categoryId + '&nama=' + soalKategori + '&totalPage=' + totalSoalPerPage + '&totalSoal=' + totalSoal, true);
                                    xmlhttp.send(null);
                                }

                                function loadPrevious() {
                                    if (questionNumber == 1 && categoryId == 1) {
                                        load_questions(questionNumber);
                                    } else if (questionNumber == 1 && categoryId != 1) {
                                        categoryId--;
                                        window.location.href = 'media.php?start=test&category=' + categoryId;
                                    } else {
                                        questionNumber = eval(questionNumber) - 1;
                                        load_questions(questionNumber);
                                    }
                                }

                                function loadNext() {
                                    if (questionNumber == totalSoal && categoryId == totalCategory) {
                                        load_questions(questionNumber);
                                    } else if (questionNumber == totalSoal && categoryId != totalCategory) {
                                        categoryId++;
                                        window.location.href = 'media.php?start=test&category=' + categoryId;
                                    } else {
                                        questionNumber = eval(questionNumber) + 1;
                                        load_questions(questionNumber);
                                    }
                                }

                                function complete() {
                                    var xmlhttp = new XMLHttpRequest();
                                    xmlhttp.onreadystatechange = function() {
                                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                                            alert(xmlhttp.responseText);
                                            window.location = '?hal=soal';
                                        }
                                    }
                                    xmlhttp.open('GET', '../soal/forajax/calculate_result.php', true);
                                    xmlhttp.send(null);
                                }
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Main Content -->
</div>