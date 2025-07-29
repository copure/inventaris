<?php
include 'koneksi.php';

// Ambil data peminjaman
$query = mysqli_query($conn, "SELECT p.*, a.nama_alat 
                               FROM peminjaman p 
                               LEFT JOIN alat_medis a ON p.id_alat = a.id 
                               ORDER BY p.tanggal_pinjam DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Laporan Peminjaman Alat Medis</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
  <style>
    body {
      font-family: 'Arial', sans-serif;
      padding: 40px;
    }
    h2 {
      text-align: center;
      margin-bottom: 30px;
    }
    table {
      width: 100%;
    }
    .footer {
      text-align: right;
      margin-top: 40px;
      font-size: 14px;
    }
    @media print {
      .no-print {
        display: none;
      }
    }
  </style>
</head>
<body onload="window.print()">

  <h2>Laporan Peminjaman Alat Medis</h2>

  <table class="table table-bordered table-sm">
    <thead class="table-light">
      <tr class="text-center">
        <th>No</th>
        <th>Nama Peminjam</th>
        <th>Nama Alat</th>
        <th>Tanggal Pinjam</th>
        <th>Tanggal Kembali</th>
        <th>Jumlah</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody>
      <?php 
      $no = 1; 
      while($row = mysqli_fetch_assoc($query)) { ?>
        <tr class="text-center">
          <td><?= $no++ ?></td>
          <td><?= htmlspecialchars($row['nama_peminjam']) ?></td>
          <td><?= htmlspecialchars($row['nama_alat']) ?></td>
          <td><?= $row['tanggal_pinjam'] ?></td>
          <td><?= $row['tanggal_kembali'] ?: '-' ?></td>
          <td><?= (int)$row['jumlah'] ?></td>
          <td><?= $row['status'] ?></td>
        </tr>
      <?php } ?>
    </tbody>
  </table>

  <div class="footer">
    Dicetak pada: <?= date('d-m-Y H:i') ?>
  </div>

</body>
</html>
