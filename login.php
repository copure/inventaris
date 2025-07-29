<?php
session_start();
include 'koneksi.php';

$error = '';

// Redirect jika sudah login
if (isset($_SESSION['login'])) {
    header("Location: dashboard.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = mysqli_real_escape_string($conn, trim($_POST['user']));
    $password = mysqli_real_escape_string($conn, trim($_POST['pass']));

    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $query = mysqli_query($conn, $sql);
    $data = mysqli_fetch_assoc($query);

    if ($data) {
        $_SESSION['login'] = true;
        $_SESSION['nama'] = $data['username'];
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Username atau password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        * { box-sizing: border-box; }

        body {
            margin: 0;
            padding: 0;
            font-family: 'Inter', sans-serif;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(-45deg, #fceabb, #fdc6b3ff, #ffecd2, #fbd1c3ff);
            background-size: 400% 400%;
            animation: gradientBG 15s ease infinite;
        }

        @keyframes gradientBG {
            0%, 100% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
        }

        .login-box {
            background: white;
            padding: 40px 30px;
            border-radius: 16px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
            width: 100%;
            max-width: 420px;
        }

        h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #333;
            font-weight: 600;
        }

        .input-group {
            position: relative;
            margin-bottom: 20px;
        }

        .input-group i {
            position: absolute;
            left: 12px;
            top: 12px;
            color: #888;
        }

        .input-group input {
            width: 100%;
            padding: 10px 12px 10px 36px;
            border: 1px solid #ccc;
            border-radius: 10px;
            font-size: 14px;
        }

        .input-group input:focus {
            border-color: #000;
            outline: none;
        }

        button {
            width: 100%;
            background-color: #000;
            color: white;
            border: none;
            padding: 12px;
            font-size: 16px;
            border-radius: 10px;
            cursor: pointer;
        }

        button:hover {
            background-color: #746666ff;
        }

        .error {
            color: red;
            text-align: center;
            margin-top: 10px;
            font-weight: bold;
        }

        .login-icon {
            font-size: 64px;
            text-align: center;
            display: block;
            margin-bottom: 15px;
        }

        @media (max-width: 480px) {
            .login-box {
                margin: 20px;
                padding: 30px 20px;
            }
        }
    </style>
</head>
<body>

<div class="login-box">
    <div class="login-icon">🔐</div>
    <h2>Login Admin</h2>

    <form method="POST">
        <div class="input-group">
            <i class="bi bi-person-fill"></i>
            <input type="text" name="user" placeholder="Username" required>
        </div>

        <div class="input-group">
            <i class="bi bi-lock-fill"></i>
            <input type="password" name="pass" placeholder="Password" required>
        </div>

        <button type="submit"><i class="bi bi-box-arrow-in-right"></i> Masuk</button>

        <?php if (!empty($error)) echo "<p class='error'>$error</p>"; ?>
    </form>
</div>

</body>
</html>
