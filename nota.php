<?php
include "koneksi.php";

// Ambil ID dari alamat URL
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Cek jika ID kosong atau tidak valid
if ($id <= 0) {
    echo "<div style='text-align:center; margin-top:50px; font-family:Arial;'>
    <h3 style='color:red;'>Error: Transaksi tidak ditemukan!</h3>
    <a href='transaksi_bengkel.php' style='color:blue; text-decoration:underline;'>Kembali ke Kasir</a>
    </div>";
    exit;
}

// Ambil data transaksi lengkap sesuai ID
$data = mysqli_query($koneksi,"
    SELECT transaksi.*, pelanggan.nama_pemilik, barang.nama_barang
    FROM transaksi
    JOIN pelanggan ON transaksi.no_plat = pelanggan.no_plat
    LEFT JOIN barang ON transaksi.id_barang = barang.id_barang
    WHERE transaksi.id_transaksi = '$id'
");

$transaksi = mysqli_fetch_assoc($data);

// Jika data tidak ada di database
if (!$transaksi) {
    echo "<div style='text-align:center; margin-top:50px; font-family:Arial;'>
    <h3 style='color:red;'>Error: Transaksi tidak ditemukan!</h3>
    <a href='transaksi_bengkel.php' style='color:blue; text-decoration:underline;'>Kembali ke Kasir</a>
    </div>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Nota Transaksi - MyBengkel</title>
    <style>
        body { font-family:Arial, sans-serif; padding:30px; max-width:500px; margin:0 auto; border:1px solid #ccc; border-radius:8px; background:#fff; }
        h2 { text-align:center; border-bottom:1px dashed #333; padding-bottom:10px; margin-bottom:20px; }
        .baris { display:flex; justify-content:space-between; margin:8px 0; }
        .total { font-weight:bold; font-size:16px; border-top:1px solid #333; padding-top:10px; margin-top:10px; }
        .tengah { text-align:center; margin-top:20px; font-size:14px; }
    </style>
</head>
<body>
    <h2>🔧 NOTA BENGKEL</h2>

    <div class="baris">
        <span>Tanggal:</span>
        <span><?= $transaksi['tanggal'] ?></span>
    </div>
    <div class="baris">
        <span>Nama Pelanggan:</span>
        <span><?= $transaksi['nama_pemilik'] ?></span>
    </div>
    <div class="baris">
        <span>No. Plat:</span>
        <span><?= $transaksi['no_plat'] ?></span>
    </div>
    <div class="baris">
        <span>Layanan:</span>
        <span><?= $transaksi['layanan'] ?></span>
    </div>
    <div class="baris">
        <span>Sparepart:</span>
        <span><?= $transaksi['nama_barang'] ?? 'Tidak Pakai' ?></span>
    </div>
    <div class="baris">
        <span>Jumlah:</span>
        <span><?= $transaksi['jumlah'] ?? 0 ?></span>
    </div>
    <div class="baris total">
        <span>TOTAL BAYAR:</span>
        <span>Rp <?= number_format((int)$transaksi['total']) ?></span>
    </div>

    <div class="tengah">
        Terima kasih atas kunjungan Anda!<br>
        <a href="transaksi_bengkel.php" style="margin-top:15px; display:inline-block; text-decoration:none; background:#007bff; color:white; padding:8px 15px; border-radius:4px;">Kembali ke Kasir</a>
    </div>
</body>
</html>
