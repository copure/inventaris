<?php include 'koneksi.php'; include 'header.php';

if ($_POST) {
  $id_alat = $_POST['id_alat'];
  $nama_peminjam = $_POST['nama_peminjam'];
  $tanggal_pinjam = $_POST['tanggal_pinjam'];
  $jumlah = (int)$_POST['jumlah'];
  $status = 'Dipinjam';
  $keterangan = $_POST['keterangan'];

  $cekStok = mysqli_query($conn, "SELECT jumlah FROM alat_medis WHERE id = $id_alat");
  $stokAlat = mysqli_fetch_assoc($cekStok)['jumlah'];

  if ($jumlah > $stokAlat) {
    echo "<script>alert('Stok tidak mencukupi! Tersisa $stokAlat unit.'); window.location='pinjaman_tambah.php';</script>";
    exit;
  }

  $insert = mysqli_query($conn, "INSERT INTO peminjaman (id_alat, nama_peminjam, tanggal_pinjam, jumlah, status, keterangan)
                                 VALUES ('$id_alat', '$nama_peminjam', '$tanggal_pinjam', '$jumlah', '$status', '$keterangan')");

  if ($insert) {
    mysqli_query($conn, "UPDATE alat_medis SET jumlah = jumlah - $jumlah WHERE id = $id_alat");
    echo "<script>alert('Data peminjaman berhasil ditambahkan!'); location.href='pinjaman_data.php';</script>";
  } else {
    echo "<script>alert('Gagal menambahkan data.');</script>";
  }
}
?>

<div class="container mt-4">
  <h4 class="mb-3">📋 Tambah Peminjaman Alat</h4>
  <form method="post">
    <div class="mb-2">
      <label>Nama Peminjam</label>
      <input type="text" name="nama_peminjam" class="form-control" required>
    </div>
    <div class="mb-2">
      <label>Alat Medis</label>
      <select name="id_alat" class="form-control" required>
        <option value="">-- Pilih Alat --</option>
        <?php
        $alat = mysqli_query($conn, "SELECT * FROM alat_medis");
        while($a = mysqli_fetch_array($alat)) {
          echo "<option value='$a[id]'>$a[nama_alat] (Stok: $a[jumlah])</option>";
        }
        ?>
      </select>
    </div>
    <div class="mb-2">
      <label>Jumlah Pinjam</label>
      <input type="number" name="jumlah" class="form-control" min="1" required>
    </div>
    <div class="mb-2">
      <label>Tanggal Pinjam</label>
      <input type="date" name="tanggal_pinjam" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>Keterangan</label>
      <textarea name="keterangan" class="form-control"></textarea>
    </div>
    <button type="submit" class="btn btn-success"><i class="bi bi-save2"></i> Simpan</button>
    <a href="pinjaman_data.php" class="btn btn-secondary"><i class="bi bi-arrow-left-circle"></i> Batal</a>
  </form>
</div>

<?php include 'footer.php'; ?>
