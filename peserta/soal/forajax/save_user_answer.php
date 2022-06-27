<?php
session_start();

$soalId = $_GET['idSoal'];
$value = $_GET['value'];
$_SESSION['answer'][$soalId]  = $value;
