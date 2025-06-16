<?php
$servername = "db.be-mons1.bengt.wasmernet.com";
$username = "fb9121307be1800039fdb16809e8";
$password = "0684fb91-2130-7d19-8000-ff6aacfda562y";
$dbname = "db_uas";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
