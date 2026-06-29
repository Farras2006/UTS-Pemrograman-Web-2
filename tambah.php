<?php
session_start();
// Cek apakah user sudah login, jika belum maka kembali ke halaman login
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

include 'koneksi.php';  

if (isset($_POST['simpan'])) {
    // Sanitasi input untuk mencegah SQL Injection
    $kode_barang = mysqli_real_escape_string($koneksi, $_POST['kode_barang']);
    $nama_barang = mysqli_real_escape_string($koneksi, $_POST['nama_barang']);
    $kategori    = mysqli_real_escape_string($koneksi, $_POST['kategori']);
    $stok        = intval($_POST['stok']);
    $harga       = floatval($_POST['harga']);

    $query = "INSERT INTO barang (kode_barang, nama_barang, kategori, stok, harga) 
              VALUES ('$kode_barang', '$nama_barang', '$kategori', '$stok', '$harga')";
    $insert = mysqli_query($koneksi, $query);

    if ($insert) {
        echo "<script>
            alert('Data berhasil ditambahkan!');
            window.location.href = 'dashboard.php';
        </script>";
    } else {
        echo "<script>
            alert('Gagal menambahkan data: " . mysqli_error($koneksi) . "');
        </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-header bg-success text-white text-center py-3">
                    <h4 class="mb-0 fw-bold">Tambah Barang Baru</h4>
                </div>
                <div class="card-body p-4">
                    <form action="" method="POST">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Kode Barang</label>
                            <input type="text" name="kode_barang" class="form-control" required placeholder="Contoh: BRG01">
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Nama Barang</label>
                            <input type="text" name="nama_barang" class="form-control" required placeholder="Nama lengkap barang">
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Kategori</label>
                            <select name="kategori" class="form-select" required>
                                <option value="">-- Pilih Kategori --</option>
                                <option value="Elektronik">Elektronik</option>
                                <option value="Pakaian">Pakaian</option>
                                <option value="Makanan">Makanan</option>
                                <option value="Alat Tulis">Alat Tulis</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Stok</label>
                            <input type="number" name="stok" class="form-control" required min="0" placeholder="0">
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Harga (Rupiah)</label>
                            <input type="number" name="harga" class="form-control" required min="0" placeholder="0">
                        </div>
                        <div class="d-flex justify-content-between mt-4">
                            <a href="dashboard.php" class="btn btn-secondary fw-semibold">Kembali</a>
                            <button type="submit" name="simpan" class="btn btn-success fw-bold">Simpan Data</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>