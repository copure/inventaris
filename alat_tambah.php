<?php include 'koneksi.php'; include 'header.php';

if ($_POST) {
  $nama = $_POST['nama_alat'];
  $jenis = $_POST['jenis'];
  $jumlah = $_POST['jumlah'];
  $satuan = $_POST['satuan'];
  $lokasi = $_POST['lokasi'];
  $tanggal = $_POST['tanggal_masuk'];
  $kondisi = $_POST['kondisi'];

  mysqli_query($conn, "INSERT INTO alat_medis (nama_alat, jenis, jumlah, satuan, lokasi, tanggal_masuk, kondisi)
                       VALUES ('$nama', '$jenis', '$jumlah', '$satuan', '$lokasi', '$tanggal', '$kondisi')");

  echo "<script>alert('Data berhasil ditambahkan!');location.href='alat_data.php';</script>";
}
?>

<div class="container mt-4">
  <h4 class="mb-3">🛠️ Tambah Alat Medis</h4>
  <form method="post">
    <?php
    $fields = [
      ['Nama Alat', 'nama_alat', 'text'],
      ['Jenis', 'jenis', 'text'],
      ['Jumlah', 'jumlah', 'number'],
      ['Satuan', 'satuan', 'text'],
      ['Lokasi', 'lokasi', 'text'],
      ['Tanggal Masuk', 'tanggal_masuk', 'date']
    ];
    foreach ($fields as [$label, $name, $type]) {
        echo "<div class='mb-2'><label>$label</label><input type='$type' name='$name' class='form-control' required></div>";
    }
    ?>
    <div class="mb-3">
      <label>Kondisi</label>
      <select name="kondisi" class="form-control" required>
        <option value="Baik">Baik</option>
        <option value="Rusak">Rusak</option>
      </select>
    </div>
    <button class="btn btn-success" type="submit"><i class="bi bi-save"></i> Simpan</button>
    <a href="dashboard.php" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Kembali</a>
  </form>
</div>

<?php include 'footer.php'; ?>
