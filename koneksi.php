<?php
$host = "sql113.infinityfree.com";
$user = "if0_39586557";
$pass = "xIEHka2yq4g0";
$db   = "if0_39586557_db_inventaris_alat";

$conn = mysqli_connect($host, $user, $pass, $db);
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>