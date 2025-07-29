<?php
include 'koneksi.php';

$nama = $_GET['nama'] ?? '';
$kategori = $_GET['kategori'] ?? '';
$kondisi = $_GET['kondisi'] ?? '';

$query = "SELECT * FROM alat_medis WHERE 1";
if ($nama) {
  $query .= " AND nama_alat LIKE '%" . mysqli_real_escape_string($conn, $nama) . "%'";
}
if ($kategori) {
  $query .= " AND jenis = '" . mysqli_real_escape_string($conn, $kategori) . "'";
}
if ($kondisi) {
  $query .= " AND kondisi = '" . mysqli_real_escape_string($conn, $kondisi) . "'";
}
$data = mysqli_query($conn, $query);
?>

<!-- ✅ 1. Form Filter -->
<div class="row g-2 mb-3">
  <form method="GET" class="row">
    <div class="col-md-4">
      <input type="text" name="nama" class="form-control" placeholder="🔍 Nama alat..." value="<?= htmlspecialchars($nama) ?>">
    </div>
    <div class="col-md-4">
      <select name="kategori" class="form-select">
        <option value="">-- Pilih Jenis Alat --</option>
        <option value="Alat Monitoring" <?= $kategori == 'Alat Monitoring' ? 'selected' : '' ?>>Alat Monitoring</option>
        <option value="Alat Diagnostik" <?= $kategori == 'Alat Diagnostik' ? 'selected' : '' ?>>Alat Diagnostik</option>
        <option value="Alat Pemeriksaan" <?= $kategori == 'Alat Pemeriksaan' ? 'selected' : '' ?>>Alat Pemeriksaan</option>
        <option value="Alat Terapi" <?= $kategori == 'Alat Terapi' ? 'selected' : '' ?>>Alat Terapi</option>
        <option value="Alat Bantu Gerak" <?= $kategori == 'Alat Bantu Gerak' ? 'selected' : '' ?>>Alat Bantu Gerak</option>
        <option value="Alat Bedah" <?= $kategori == 'Alat Bedah' ? 'selected' : '' ?>>Alat Bedah</option>
         <option value="Alat Sterilisasi" <?= $kategori == 'Alat Sterilisasi' ? 'selected' : '' ?>>Alat Sterilisasi</option>
      </select>
    </div>
    <div class="col-md-3">
      <select name="kondisi" class="form-select">
        <option value="">-- Pilih Kondisi --</option>
        <option value="Baik" <?= $kondisi == 'Baik' ? 'selected' : '' ?>>Baik</option>
        <option value="Rusak" <?= $kondisi == 'Rusak' ? 'selected' : '' ?>>Rusak</option>
      </select>
    </div>
    <div class="col-md-1">
      <button type="submit" class="btn btn-primary w-100">Filter</button>
    </div>
  </form>
</div>

<!-- ✅ 2. Alert Filter Aktif (Hanya 1 Kali) -->
<?php if ($nama || $kategori || $kondisi): ?>
  <div class="alert alert-warning mb-3">
    <strong>Filter aktif:</strong>
    <?= $nama ? 'Nama = <strong>' . htmlspecialchars($nama) . '</strong>' : '' ?>
    <?= ($nama && ($kategori || $kondisi)) ? ' | ' : '' ?>
    <?= $kategori ? 'Jenis = <strong>' . htmlspecialchars($kategori) . '</strong>' : '' ?>
    <?= ($kategori && $kondisi) ? ' | ' : '' ?>
    <?= $kondisi ? 'Kondisi = <strong>' . htmlspecialchars($kondisi) . '</strong>' : '' ?>
    <a href="dashboard.php" class="btn btn-sm btn-link text-decoration-none">🔄 Reset Filter</a>
  </div>
<?php endif; ?>

<!-- ✅ 3. Heading + Tambah Alat -->
<div class="row align-items-center mb-3">
  <div class="col-md-6">
    <h4 class="fw-bold text-primary">📋 Data Alat Medis</h4>
  </div>
  <div class="col-md-6 text-end">
    <a href="alat_tambah.php" class="btn btn-sm btn-outline-primary">➕ Tambah Alat</a>
  </div>
</div>

<!-- ✅ 4. Tabel Data Alat -->
<div class="table-responsive shadow rounded">
  <table class="table table-hover table-bordered align-middle bg-white">
    <thead class="table-light text-center">
      <tr>
        <th>No</th>
        <th>Nama Alat</th>
        <th>Jenis</th>
        <th>Jumlah Stok</th>
        <th>Dipinjam</th>
        <th>Tersedia</th>
        <th>Satuan</th>
        <th>Lokasi</th>
        <th>Tanggal Masuk</th>
        <th>Kondisi</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $no = 1;
      if (mysqli_num_rows($data) === 0) {
        echo '<tr><td colspan="11" class="text-center text-muted">Tidak ditemukan data alat medis sesuai filter.</td></tr>';
      } else {
        while ($d = mysqli_fetch_array($data)) {
          $id = $d['id'];
          $stok = (int)$d['jumlah'];
          $query_pinjam = mysqli_query($conn, "SELECT SUM(jumlah) AS total_dipinjam FROM peminjaman WHERE id_alat = $id AND status = 'Dipinjam'");
          $hasil_pinjam = mysqli_fetch_assoc($query_pinjam);
          $dipinjam = (int)($hasil_pinjam['total_dipinjam'] ?? 0);
          $tersedia = $stok - $dipinjam;
          $kondisiBadge = ($d['kondisi'] == 'Baik') ? 'success' : 'danger';
      ?>
          <tr>
            <td class="text-center"><?= $no++ ?></td>
            <td><?= htmlspecialchars($d['nama_alat']) ?></td>
            <td><?= htmlspecialchars($d['jenis']) ?></td>
            <td class="text-center"><?= $stok ?></td>
            <td class="text-center"><?= $dipinjam ?></td>
            <td class="text-center"><?= $tersedia ?></td>
            <td class="text-center"><?= htmlspecialchars($d['satuan']) ?></td>
            <td><?= htmlspecialchars($d['lokasi']) ?></td>
            <td class="text-center"><?= htmlspecialchars($d['tanggal_masuk']) ?></td>
            <td class="text-center">
              <span class="badge bg-<?= $kondisiBadge ?>"><?= htmlspecialchars($d['kondisi']) ?></span>
            </td>
            <td class="text-center">
              <a href="alat_edit.php?id=<?= $d['id'] ?>" class="btn btn-sm btn-warning me-1">✏️</a>
              <a href="alat_hapus.php?id=<?= $d['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus data ini?')">🗑️</a>
            </td>
          </tr>
      <?php }} ?>
    </tbody>
  </table>
</div>