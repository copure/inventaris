<?php include 'koneksi.php'; include 'header.php';

$id = $_GET['id'];
$d = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM alat_medis WHERE id='$id'"));

if ($_POST) {
  $nama = $_POST['nama_alat'];
  $jenis = $_POST['jenis'];
  $jumlah = $_POST['jumlah'];
  $satuan = $_POST['satuan'];
  $lokasi = $_POST['lokasi'];
  $tanggal = $_POST['tanggal_masuk'];
  $kondisi = $_POST['kondisi'];

  mysqli_query($conn, "UPDATE alat_medis SET 
    nama_alat='$nama',
    jenis='$jenis',
    jumlah='$jumlah',
    satuan='$satuan',
    lokasi='$lokasi',
    tanggal_masuk='$tanggal',
    kondisi='$kondisi'
    WHERE id='$id'");

  echo "<script>alert('Data berhasil diubah!');location.href='alat_data.php';</script>";
}
?>

<div class="container mt-4">
  <h4 class="mb-3">✏️ Edit Alat Medis</h4>
  <form method="post">
    <?php
    $inputs = [
      ['Nama Alat', 'nama_alat', 'text'],
      ['Jenis', 'jenis', 'text'],
      ['Jumlah', 'jumlah', 'number'],
      ['Satuan', 'satuan', 'text'],
      ['Lokasi', 'lokasi', 'text'],
      ['Tanggal Masuk', 'tanggal_masuk', 'date']
    ];
    foreach ($inputs as [$label, $name, $type]) {
      echo "<div class='mb-2'><label>$label</label><input type='$type' name='$name' class='form-control' value='{$d[$name]}' required></div>";
    }
    ?>
    <div class="mb-3">
      <label>Kondisi</label>
      <select name="kondisi" class="form-control" required>
        <option value="Baik" <?= $d['kondisi'] == 'Baik' ? 'selected' : '' ?>>Baik</option>
        <option value="Rusak" <?= $d['kondisi'] == 'Rusak' ? 'selected' : '' ?>>Rusak</option>
      </select>
    </div>
    <button class="btn btn-primary" type="submit"><i class="bi bi-pencil-square"></i> Simpan Perubahan</button>
    <a href="alat_data.php" class="btn btn-secondary"><i class="bi bi-x-circle"></i> Batal</a>
  </form>
</div>

<?php include 'footer.php'; ?>
