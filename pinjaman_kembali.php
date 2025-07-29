<?php
include 'koneksi.php';

$id = $_GET['id'];
$tanggal_kembali = date('Y-m-d');

// Update status dan tanggal kembali
mysqli_query($conn, "UPDATE peminjaman SET status='Dikembalikan', tanggal_kembali='$tanggal_kembali' WHERE id='$id'");

echo "<script>alert('Alat telah dikembalikan.'); location.href='pinjaman_data.php';</script>";
?>
