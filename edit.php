<?php
session_start();
// Cek apakah user sudah login, jika belum maka redirect ke halaman login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}
include 'koneksi.php';

// Cek apakah parameter ID barang ada di URL
if (!isset($_GET['id'])) {
    header("Location: dashboard.php");
    exit;
}
$id = $_GET['id'];

// Ambil data barang lama berdasarkan ID untuk ditampilkan di form
$result = mysqli_query($koneksi, "SELECT * FROM barang WHERE id = '$id'");
$data = mysqli_fetch_assoc($result);
// Jika data tidak ditemukan, redirect ke dashboard
if (!$data) {
    header("Location: dashboard.php");
    exit;
}

// Proses ketika tombol "Update" diklik (metode POST)
if (isset($_POST['update'])) {
    // Sanitasi input dasar
    $kode_barang = mysqli_real_escape_string($koneksi, $_POST['kode_barang']);
    $nama_barang = mysqli_real_escape_string($koneksi, $_POST['nama_barang']);
    $kategori = mysqli_real_escape_string($koneksi, $_POST['kategori']);
    $stok = intval($_POST['stok']);
    $harga = floatval($_POST['harga']);

    // Query UPDATE untuk mengubah data di database
    $query = "UPDATE barang SET 
                kode_barang = '$kode_barang', 
                nama_barang = '$nama_barang', 
                kategori = '$kategori', 
                stok = $stok, 
                harga = $harga 
              WHERE id = '$id'";

    $update = mysqli_query($koneksi, $query);

    if ($update) {
        echo "<script>
                alert('Data barang berhasil diubah!');
                window.location.href = 'dashboard.php';
              </script>";
    } else {
        echo "Gagal mengubah data: " . mysqli_error($koneksi);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Barang - SIMBAR</title>
    <!-- Hubungkan ke Bootstrap 5 sesuai instruksi soal -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .card { max-width: 500px; margin: 50px auto; }
    </style>
</head>
<body>

<div class="container">
    <div class="card shadow-sm">
        <div class="card-header bg-warning text-dark text-center">
            <h4>Edit Data Barang</h4>
        </div>
        <div class="card-body">
            <!-- Form untuk mengedit data barang menggunakan metode POST -->
            <form action="" method="POST">
                <div class="mb-3">
                    <label class="form-label">Kode Barang</label>
                    <input type="text" name="kode_barang" class="form-control" value="<?= htmlspecialchars($data['kode_barang']) ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Nama Barang</label>
                    <input type="text" name="nama_barang" class="form-control" value="<?= htmlspecialchars($data['nama_barang']) ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Kategori</label>
                    <select name="kategori" class="form-select" required>
                        <option value="Elektronik" <?= $data['kategori'] == 'Elektronik' ? 'selected' : '' ?>>Elektronik</option>
                        <option value="Pakaian" <?= $data['kategori'] == 'Pakaian' ? 'selected' : '' ?>>Pakaian</option>
                        <option value="Makanan" <?= $data['kategori'] == 'Makanan' ? 'selected' : '' ?>>Makanan</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Stok</label>
                    <input type="number" name="stok" class="form-control" value="<?= htmlspecialchars($data['stok']) ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Harga</label>
                    <input type="number" step="0.01" name="harga" class="form-control" value="<?= htmlspecialchars($data['harga']) ?>" required>
                </div>
                <div class="d-flex justify-content-between">
                    <a href="dashboard.php" class="btn btn-secondary">Kembali</a>
                    <button type="submit" name="update" class="btn btn-warning">Update Data</button>
                </div>
            </</form>
        </div>
    </div>
</div>

</body>
</html>