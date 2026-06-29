<?php
// memakai include untuk menyertakan file Koneksi.php
include 'Koneksi.php';  

// Mengecek apakah tombol simpan ditekan
if (isset($_POST['simpan'])) {
    $kode_barang = $_POST['kode_barang'];
    $nama_barang = $_POST['nama_barang'];
    $kategori    = $_POST['kategori'];
    $stok        = $_POST['stok'];
    $harga       = $_POST['harga'];


// Query untuk menyimpan data ke database
$query = "INSERT INTO barang (kode_barang, nama_barang, kategori, stok, harga) 
VALUES ('$kode_barang', '$nama_barang', '$kategori', '$stok', '$harga')";
$insert = mysqli_query($koneksi, $query);

if ($insert) {
    echo "<script>
        alert('Data berhasil ditambahkan!');
        window.location.href = 'Dashboard.php';
    </script>";
}
else {
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
    <title>Tambah Data Barang</title>
    <style>

        body { font-family: Times New Roman, sans-serif;
        background-color: #f4f4f4;
        margin: 20px; }

        .form-container {width: 400px;
        background: white;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        
        h2 {color: #333;
        margin-top: 5px;
        text-align: center; }
        
        .form-group {margin-bottom: 15px; }
        .form-group label { display: block;
        margin-bottom: 5px;
        font-weight: bold; }
        .form-group input,.form-group select { width: 100%;
        padding: 8px;
        box-sizing: border-box;
        border: 1px solid #ccc;
        border-radius: 4px; }

        .btn-submit {background-color: #28a745;
        color: white;
        border: none;
        padding: 10px 15px;
        border-radius: 4px;
        font-weight: bold;
        cursor: pointer; }
        .btn-submit:hover {background-color: #218838; }
        
        .btn-kembali { text-decoration: none;
                        color: #007bff;
                        font-weight: bold;
                        margin-left: 10px; }
    </style>
</head>

<div class="form-container">
    <h2>Tambah Barang</h2>
    
    <form action="" method="POST">
        <div class="form-group">
            <label>Kode Barang</label>
            <input type="text" name="kode_barang" required placeholder="Contoh: BRG01">
        </div>
        
        <div class="form-group">
            <label>Nama Barang</label>
            <input type="text" name="nama_barang" required placeholder="Nama lengkap barang">
        </div>
        
        <div class="form-group">
            <label>Kategori</label>
            <select name="kategori" required>
                <option value="">-- Pilih Kategori --</option>
                <option value="Elektronik">Elektronik</option>
                <option value="Pakaian">Pakaian</option>
                <option value="Makanan">Makanan</option>
                <option value="Alat Tulis">Alat Tulis</option>
            </select>
        </div>
        
        <div class="form-group">
            <label>Stok</label>
            <input type="number" name="stok" required min="0">
        </div>
        
        <div class="form-group">
            <label>Harga (Rupiah)</label>
            <input type="number" name="harga" required min="0">
        </div>
        
        <button type="submit" name="simpan" class="btn-simpan">Simpan Data</button>
        <a href="Dashboard.php" class="btn-kembali">Kembali</a> ```
    </form>
</div>
</body>
</html>