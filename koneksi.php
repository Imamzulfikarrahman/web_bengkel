<?php
// Pengaturan koneksi yang benar untuk WAMP
$host = 'localhost';
$user = 'root';          // Pakai user root bawaan
$pass = '';              // Kosongkan saja, tidak ada sandi
$db   = 'bengkel_ultimate'; // Nama database yang ada di daftar

$koneksi = mysqli_connect($host, $user, $pass, $db);

// Cek koneksi
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
