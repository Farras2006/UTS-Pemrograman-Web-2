<?php
session_start();
// Hapus semua session
$_SESSION = [];
session_unset();
session_destroy();

// kembali ke halaman login
header("Location: login.php");
exit;
?>