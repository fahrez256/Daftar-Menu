<?php
$servername = "sql110.infinityfree.com";
$username = "if0_37095148";
$password = "mikireen123";
$dbname = "if0_37095148_menu";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
