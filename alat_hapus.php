<?php
include 'koneksi.php';
$id = $_GET['id'];
mysqli_query($conn, "DELETE FROM alat_medis WHERE id='$id'");
header("Location: alat_data.php");
?>