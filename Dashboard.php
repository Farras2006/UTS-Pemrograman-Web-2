<?php
session_start();
// Cek apakah user sudah login, jika belum maka redirect ke halaman login
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}
// Koneksi ke database
require_once'Koneksi.php';

$result = mysqli_query($koneksi, "SELECT * FROM barang");
?>


<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard SIMBAR</title>
    <style>
        body { font-family: Times New Roman, sans-serif; background-color: #f4f4f4; margin: 20px; }
        .header { display: flex; justify-content: space-between; align-items: center; background: white; padding: 15px 20px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.05); }
        h1 { margin: 0; font-size: 24px; color: #333; }
        .btn-logout { background: #dc3545;
                    color: white;
                    padding: 8px 15px;
                    text-decoration: none;
                    border-radius: 4px;
                    font-weight: bold; }
        .btn-logout:hover { background: #c82333; }

        .btn-tambah { display: inline-block;
                    background: #28a745;
                    color: white; 
                    padding: 10px 15px;
                    text-decoration: none;
                    border-radius: 4px;
                    font-weight: bold;
                    margin: 20px 0 10px 0; }
        .btn-tambah:hover { background: #218838; }
        
        table { width: 100%; border-collapse: collapse; background: white; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 5px rgba(0,0,0,0.05); }
        th, td { padding: 12px 15px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background-color: #007bff; color: white; }
        tr:hover { background-color: #f1f1f1; }
        .aksi-link { text-decoration: none; font-weight: bold; margin-right: 10px; }
        .edit { color: #ffc107; }
        .hapus { color: #dc3545; }
    </style>
</head>


<body>
<div class="header">
    <h1>Selamat Datang, <?=htmlspecialchars($_SESSION['username'])?></h1>
    <a href="logout.php" class="btn-logout" onclick="return confirm('Apakah Anda yakin ingin logout?');">Logout</a>
</div>

<a href="tambah.php" class="btn-tambah">+ Tambah Data Barang</a>

<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Kode Barang</th>
            <th>Nama Barang</th>
            <th>Kategori</th>
            <th>Stok</th>
            <th>Harga</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1; ?>
        <?php while ($row = mysqli_fetch_assoc($result)) : ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= htmlspecialchars($row['kode_barang']); ?></td>
            <td><?= htmlspecialchars($row['nama_barang']); ?></td>
            <td><?= htmlspecialchars($row['kategori']); ?></td>
            <td><?= htmlspecialchars($row['stok']); ?></td>
            <td>Rp <?= number_format($row['harga'], 0, ',', '.'); ?></td>
            <td>
                <a href="edit.php?id=<?= $row['id']; ?>" class="aksi-link edit">Edit</a>
                <a href="hapus.php?id=<?= $row['id']; ?>" class="aksi-link hapus" onclick="return confirm('Yakin mau hapus data ini?');">Hapus</a>
            </td>
        </tr>
        <?php endwhile; ?>
        
        <?php if (mysqli_num_rows($result) === 0) : ?>
        <tr>
            <td colspan="7" style="text-align: center; color: #888;">Belum ada data barang. Silakan tambah data baru!</td>
        </tr>
        <?php endif; ?>
    </tbody>
</table>

</body>
</html>