<?php
session_start();
if (!isset($_SESSION['login'])) {
    header('Location: login.php');
    exit;
}
include 'koneksi.php';
include 'header.php';
?>

<style>
    /* 🌞 Mode Terang */
    body.light-mode {
        background: linear-gradient(to right, #c6f0ff, #e0eaff);
        color: #000;
        font-family: 'Poppins', sans-serif;
    }
    .light-mode .glass-card {
        background: rgba(255, 255, 255, 0.75);
        backdrop-filter: blur(10px);
        border-radius: 15px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }
    .light-mode .header-title {
        background: linear-gradient(90deg, #00c6ff, #0072ff);
        color: white;
        padding: 1.5rem;
        border-radius: 1rem;
        box-shadow: 0 4px 15px rgba(0, 114, 255, 0.4);
        font-weight: bold;
    }
    .light-mode .table thead {
        background-color: #0072ff;
        color: white;
    }

    /* 🌙 Mode Gelap */
    body.dark-mode {
        background: linear-gradient(to right, #0f2027, #203a43, #2c5364);
        color: #f0f0f0;
        font-family: 'Poppins', sans-serif;
    }
    .dark-mode .glass-card {
        background: rgba(30, 30, 60, 0.85);
        color: #f0f0f0;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.6);
    }
    .dark-mode .header-title {
        background: linear-gradient(90deg, #2c3e50, #4ca1af);
        color: #eee;
        padding: 1.5rem;
        border-radius: 1rem;
        box-shadow: 0 4px 15px rgba(255, 255, 255, 0.3);
        font-weight: bold;
    }
    .dark-mode .table thead {
        background-color: #2c3e50;
        color: #fff;
    }

    /* 🌐 Tombol Ikon */
    .toggle-btn {
        margin-bottom: 15px;
        font-size: 20px;
        padding: 6px 12px;
        background-color: #008cba;
        color: white;
        border: none;
        border-radius: 50%;
        cursor: pointer;
        box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        transition: transform 0.3s ease;
    }

    .toggle-btn:hover {
        background-color: #005f8f;
        transform: scale(1.1);
    }

    .icon-circle {
        font-size: 24px;
        margin-right: 8px;
    }
</style>

<body class="light-mode">
<div class="container mt-4">
    <!-- 🔘 Tombol Toggle Ikon Kanan Atas -->
    <div class="d-flex justify-content-end mb-3">
        <button id="toggle-theme" class="toggle-btn" title="Ganti tema">
            🌞
        </button>
    </div>

    <div class="text-center mb-4">
        <h1 class="header-title">💉 Sistem Inventaris Alat Medis</h1>
    </div>

    <?php
    $alat_total = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(jumlah) AS total FROM alat_medis"))['total'] ?? 0;
    $dipinjam_total = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(jumlah) AS total FROM peminjaman WHERE status='Dipinjam'"))['total'] ?? 0;
    $tersedia_total = $alat_total - $dipinjam_total;
    $pinjam_aktif = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM peminjaman WHERE status='Dipinjam'"))['total'] ?? 0;

    $cards = [
        ['🔧', 'Total Alat', $alat_total, 'Jumlah alat yang tersedia'],
        ['📦', 'Dipinjam', $dipinjam_total, 'Alat yang sedang digunakan'],
        ['✅', 'Tersedia', $tersedia_total, 'Alat siap digunakan'],
        ['📝', 'Peminjaman Aktif', $pinjam_aktif, 'Belum dikembalikan'],
    ];
    ?>

    <div class="row text-center mb-4">
        <?php foreach ($cards as $c) { ?>
        <div class="col-md-3 mb-3">
            <div class="glass-card p-3">
                <div class="d-flex align-items-center justify-content-center">
                    <span class="icon-circle"><?= $c[0] ?></span>
                    <h5 class="mb-0"><?= $c[1] ?></h5>
                </div>
                <h2 class="fw-bold"><?= $c[2] ?></h2>
                <p class="text-muted"><?= $c[3] ?></p>
            </div>
        </div>
        <?php } ?>
    </div>

    <?php include 'alat_data.php'; ?> <!-- 🧩 Modul data alat -->
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const body = document.body;
    const toggleBtn = document.getElementById("toggle-theme");

    toggleBtn.addEventListener("click", function() {
        body.classList.toggle("light-mode");
        body.classList.toggle("dark-mode");

        toggleBtn.innerText = body.classList.contains("dark-mode") ? "🌙" : "🌞";
    });
});
</script>

<?php include 'footer.php'; ?>