<?php
$host = '195.88.211.210'; // <-- IP SAMA
$user = 'mybengkel';
$pass = 'mybengkel12345#';
$db_baru = 'bengkel_ultimate';

$koneksi = @mysqli_connect($host, $user, $pass);

if (!$koneksi) {
    die('GAGAL:
     ' . mysqli_connect_error());
}

echo "Berhasil masuk ke server DB<br>";

// Buat database kalau belum ada
mysqli_query($koneksi, "CREATE DATABASE IF NOT EXISTS `$db_baru`");
mysqli_select_db($koneksi, $db_baru);

// Impor data
$file_sql = 'bengkel_ultimate (1).sql';
$isi = file_get_contents($file_sql);

if (mysqli_multi_query($koneksi, $isi)) {
    echo "<h2> BERHASIL 100%! SUDAH BISA DIPAKAI</h2>";
} else {
    echo "Gagal: " . mysqli_error($koneksi);
}

mysqli_close($koneksi);
?>
