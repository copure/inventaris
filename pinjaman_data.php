<?php 
include 'koneksi.php'; 
include 'header.php'; 
?>
<div class="container mt-4">
  <h4 class="mb-4">📦 Data Peminjaman Alat Medis</h4>

  <div class="mb-3 d-flex justify-content-between">
    <div>
      <a href="pinjaman_tambah.php" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Tambah Peminjaman
      </a>
      <a href="dashboard.php" class="btn btn-dark ms-2">
        <i class="bi bi-arrow-left-circle"></i> Kembali ke Dashboard
      </a>
    </div>
    <div>
      <a href="cetak_laporan_peminjaman.php" target="_blank" class="btn btn-outline-success">
        <i class="bi bi-printer-fill"></i> Cetak Laporan
      </a>
    </div>
  </div>

  <div class="table-responsive">
    <table class="table table-bordered table-striped align-middle text-center">
      <thead class="table-primary">
        <tr>
          <th>No</th>
          <th>Nama Peminjam</th>
          <th>Nama Alat</th>
          <th>Tanggal Pinjam</th>
          <th>Tanggal Kembali</th>
          <th>Jumlah</th>
          <th>Status</th>
          <th>Keterangan</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
      <?php
      $no = 1;
      $query = mysqli_query($conn, "SELECT p.*, a.nama_alat FROM peminjaman p 
                                     LEFT JOIN alat_medis a ON p.id_alat = a.id 
                                     ORDER BY p.tanggal_pinjam DESC");
      while($data = mysqli_fetch_array($query)) {
      ?>
        <tr>
          <td><?= $no++ ?></td>
          <td><?= htmlspecialchars($data['nama_peminjam']) ?></td>
          <td><?= htmlspecialchars($data['nama_alat']) ?></td>
          <td><?= $data['tanggal_pinjam'] ?></td>
          <td><?= $data['tanggal_kembali'] ?: '-' ?></td>
          <td><?= (int)$data['jumlah'] ?></td>
          <td>
            <span class="badge bg-<?= $data['status'] == 'Dipinjam' ? 'warning text-dark' : 'success' ?>">
              <?= htmlspecialchars($data['status']) ?>
            </span>
          </td>
          <td><?= htmlspecialchars($data['keterangan']) ?></td>
          <td>
            <?php if ($data['status'] == 'Dipinjam') { ?>
              <a href="pinjaman_kembali.php?id=<?= $data['id'] ?>" 
                 class="btn btn-sm btn-success" title="Kembalikan">
                <i class="bi bi-box-arrow-in-down"></i> Kembalikan
              </a>
            <?php } else { ?>
              <i class="text-muted bi bi-check-circle-fill" title="Sudah dikembalikan"></i>
            <?php } ?>
          </td>
        </tr>
      <?php } ?>
      </tbody>
    </table>
  </div>
</div>
<?php include 'footer.php'; ?>
