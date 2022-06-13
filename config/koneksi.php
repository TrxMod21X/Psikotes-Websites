<?php
$server = "localhost";
$username = "root";
$password = "";
$database = "psikotes_online";

// Koneksi dan memilih database di server
// mysql_connect($server,$username,$password) or die("Koneksi gagal");
// mysql_select_db($database) or die("Database tidak bisa dibuka");

/// Create connection
$conn = new mysqli($server, $username, $password, $database);

/// Check connection
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}
