<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventaris Alat Medis</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

    <!-- Custom Style -->
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .navbar-brand {
            font-weight: 600;
            font-size: 1.5rem;
        }

        .navbar-custom {
            background: linear-gradient(90deg, #0072ff, #00c6ff);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .navbar-custom .nav-link {
            color: white;
            font-weight: 500;
        }

        .navbar-custom .nav-link:hover {
            color: #e0e0e0;
        }

        .nav-icon {
            margin-right: 6px;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-custom mb-4">
    <div class="container">
        <a class="navbar-brand text-white" href="dashboard.php">🩺 Inventaris Medis</a>
        <button class="navbar-toggler bg-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon text-white"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="dashboard.php"><span class="nav-icon">🏠</span>Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="pinjaman_data.php"><span class="nav-icon">📦</span>Peminjaman</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php"><span class="nav-icon">🔓</span>Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
