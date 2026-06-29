<?php
session_start();
require_once 'koneksi.php';

// 1. CEK SESSION: Jika sudah login, langsung ke dashboard
if (isset($_SESSION['login'])) {
    header("Location: dashboard.php");
    exit;
}

// 2. CEK FORM SUBMIT: Jika form login disubmit
if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = $_POST['password'];

    // Cari user berdasarkan username
    $result = mysqli_query($koneksi, "SELECT * FROM users WHERE username = '$username'");

    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        
        // Verifikasi password dengan enkripsi MD5
        if (md5($password) === $row['password']) {
            // Set session login dan username
            $_SESSION['login'] = true;
            $_SESSION['username'] = $row['username'];
            
            header("Location: dashboard.php");
            exit;
        }
    }
    $error = true;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login SIMBAR</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container">
    <div class="row justify-content-center align-items-center vh-100">
        <div class="col-md-4">
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-body p-4">
    
    <h3 class="card-title text-center mb-4 fw-bold text-primary">Login SIMBAR</h3>
        
    <?php if (isset($error)) : ?>
        <div class="alert alert-danger text-center py-2 fs-6" role="alert">
            Username atau password salah!
            </div>
            <?php endif; ?>

    <form action="" method="POST">
         <div class="mb-3">
            <label for="username" class="form-label fw-semibold">Username</label>
            <input type="text" name="username" id="username" class="form-control" required autocomplete="off" placeholder="Masukkan username">
         </div>

    <div class="mb-3">
        <label for="password" class="form-label fw-semibold">Password</label>
        <input type="password" name="password" id="password" class="form-control" required placeholder="Masukkan password">
    </div>
    
    <div class="d-grid mt-4">
        <button type="submit" name="login" class="btn btn-primary fw-bold">Login</button>
    </div>
 </form>
                    
                </div>
            </div>
<div class="text-center mt-3 text-muted fs-7">
<small>&copy; [cite_start]2026 SIMBAR - Mandiri [cite: 8]</small>
</div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>