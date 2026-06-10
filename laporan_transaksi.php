<?php
include 'koneksi.php';
$query = mysqli_query($conn, "SELECT transaksi.*, pelanggan.nama_pemilik, barang.nama_barang 
                              FROM transaksi 
                              JOIN pelanggan ON transaksi.id_pelanggan = pelanggan.id_pelanggan 
                              JOIN barang ON transaksi.id_barang = barang.id_barang 
                              ORDER BY tgl_transaksi DESC");
?>
<h2>Riwayat Transaksi Bengkel</h2>
<table border="1" cellpadding="10">
    <tr>
        <th>Tanggal</th>
        <th>Pelanggan</th>
        <th>Barang</th>
        <th>Total Bayar</th>
    </tr>
    <?php while($row = mysqli_fetch_assoc($query)): ?>
    <tr>
        <td><?= $row['tgl_transaksi'] ?></td>
        <td><?= $row['nama_pemilik'] ?></td>
        <td><?= $row['nama_barang'] ?></td>
        <td>Rp <?= number_format($row['total_bayar']) ?></td>
    </tr>
    <?php endwhile; ?>
</table>
<br>
<a href="index.php">Kembali ke Menu</a>
