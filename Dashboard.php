<?php
session_start(); // [cite: 53]
// Cek apakah user sudah login, jika belum maka redirect ke halaman login
if (!isset($_SESSION['login'])) { // [cite: 55]
    header("Location: login.php"); // [cite: 56]
    exit;
}
// Koneksi ke database
require_once 'koneksi.php'; 

$result = mysqli_query($koneksi, "SELECT * FROM barang"); // 
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard SIMBAR</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold text-primary" href="#">SIMBAR</a>
        <div class="d-flex align-items-center">
            <span class="navbar-text text-white me-3 fs-6 fw-semibold">
                Selamat Datang, <span class="text-warning"><?= htmlspecialchars($_SESSION['username']) ?></span> </span>
            <a href="logout.php" class="btn btn-danger btn-sm fw-bold" onclick="return confirm('Apakah Anda yakin ingin logout?');">Logout</a> </div>
    </div>
</nav>

<div class="container my-5">
    <div class="row mb-4 align-items-center">
        <div class="col">
            <h2 class="fw-bold text-secondary">Manajemen Inventaris Barang</h2>
        </div>
        <div class="col-auto">
            <a href="tambah.php" class="btn btn-primary fw-bold shadow-sm">+ Tambah Barang</a> </div>
    </div>

    <div class="card shadow-sm border-0 rounded-3">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-hover table-bordered mb-0 align-middle"> <thead class="table-primary text-center">
                        <tr>
                            <th width="5%">No</th>
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Kategori</th>
                            <th width="10%">Stok</th>
                            <th>Harga</th>
                            <th width="15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        <?php while ($row = mysqli_fetch_assoc($result)) : ?> <tr>
                            <td class="text-center"><?= $no++; ?></td>
                            <td class="fw-semibold text-center"><?= htmlspecialchars($row['kode_barang']); ?></td>
                            <td><?= htmlspecialchars($row['nama_barang']); ?></td>
                            <td><span class="badge bg-secondary"><?= htmlspecialchars($row['kategori']); ?></span></td>
                            <td class="text-center"><?= htmlspecialchars($row['stok']); ?></td>
                            <td class="text-end pe-3">Rp <?= number_format($row['harga'], 0, ',', '.'); ?></td>
                            <td class="text-center">
                                <a href="edit.php?id=<?= $row['id']; ?>" class="btn btn-warning btn-sm fw-semibold text-white me-1">Edit</a> <a href="hapus.php?id=<?= $row['id']; ?>" class="btn btn-danger btn-sm fw-semibold" onclick="return confirm('Apakah Anda yakin ingin menghapus barang ini?');">Hapus</a> </td>
                        </tr>
                        <?php endwhile; ?>
                        
                        <?php if (mysqli_num_rows($result) === 0) : ?>
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">Belum ada data barang. Silakan tambah data baru!</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>