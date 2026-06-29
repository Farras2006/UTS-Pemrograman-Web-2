<?php
require_once 'koneksi.php';
// 1. Cek apakah parameter ID barang ada di URL
if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($koneksi, $_GET['id']);
// 2. Query untuk menghapus data barang berdasarkan ID
    $query = "DELETE FROM barang WHERE id = '$id'";
    $hapus = mysqli_query($koneksi, $query);
// 3. Cek apakah query berhasil dijalankan
    if ($hapus) {
        echo "<script>
                alert('Data barang berhasil dihapus!');
                window.location.href='Dashboard.php';
              </script>";
    } else {
        echo "<script>
                alert('Gagal menghapus data: " . mysqli_error($koneksi) . "');
                window.location.href='Dashboard.php';
              </script>";
    }
} else {
    header("Location: Dashboard.php");
    exit;
}
?>