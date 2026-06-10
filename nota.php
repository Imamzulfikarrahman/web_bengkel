<?php
include 'koneksi.php';

// 1. Cek apakah ada ID transaksi yang dikirim lewat URL
if (!isset($_GET['id']) || $_GET['id'] == 0) {
    echo "<h3>Error: Transaksi tidak ditemukan!</h3>";
    echo "<a href='transaksi_bengkel.php'>Kembali ke Kasir</a>";
    exit;
}

$id_t = $_GET['id'];

// 2. Query untuk mengambil detail transaksi (menggabungkan tabel pelanggan dan barang)
$sql = "SELECT transaksi.*, pelanggan.nama_pemilik, pelanggan.no_plat, barang.nama_barang 
        FROM transaksi 
        JOIN pelanggan ON transaksi.id_pelanggan = pelanggan.id_pelanggan 
        JOIN barang ON transaksi.id_barang = barang.id_barang 
        WHERE transaksi.id_transaksi = '$id_t'";

$eksekusi = mysqli_query($conn, $sql);
$data = mysqli_fetch_assoc($eksekusi);

// 3. Jika data tidak ditemukan di database
if (!$data) {
    echo "<h3>Data transaksi ID $id_t tidak ada di database.</h3>";
    exit;
}
?>

<div style="width: 350px; border: 1px solid #000; padding: 15px; font-family: monospace;">
    <center>
        <strong>BENGKEL PRO ULTIMATE</strong><br>
        Nota Digital Transaksi
    </center>
    <hr>
    ID Transaksi : <?= $data['id_transaksi'] ?> <br>
    Tanggal      : <?= $data['tgl_transaksi'] ?> <br>
    Pelanggan    : <?= $data['nama_pemilik'] ?> <br>
    No. Plat     : <?= $data['no_plat'] ?> <br>
    <hr>
    Item         : <?= $data['nama_barang'] ?> <br>
    Total Bayar  : <strong>Rp <?= number_format($data['total_bayar']) ?></strong>
    <hr>
    <center>Terima Kasih Atas Kunjungan Anda</center>
</div>

<br>
<button onclick="window.print()">Cetak Nota</button>
<a href="index.php">Kembali ke Menu</a>
