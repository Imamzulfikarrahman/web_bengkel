<?php
include 'koneksi.php';

// Ambil kolom yang BENAR-BENAR ada di tabel
$sql = "SELECT id_barang, nama_barang, stok, harga_umum, harga_member FROM barang ORDER BY nama_barang ASC";
$hasil = mysqli_query($koneksi, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Daftar Stok Barang - MyBengkel</title>
    <style>
        body { font-family: Arial; margin: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 12px; text-align: left; }
        th { background-color: #f2f2f2; font-weight: bold; }
        .stok-habis { color: red; font-weight: bold; }
        .stok-sedikit { color: orange; }
    </style>
</head>
<body>
    <h2>Daftar Stok Barang Bengkel</h2>

    <table>
        <tr>
            <th>ID Barang</th>
            <th>Nama Barang</th>
            <th>Stok Tersedia</th>
            <th>Harga Umum</th>
            <th>Harga Member</th>
        </tr>

        <?php
        while ($barang = mysqli_fetch_assoc($hasil)) {
            // Tanda warna stok
            if ($barang['stok'] == 0) {
                $kelas = 'stok-habis';
            } elseif ($barang['stok'] < 3) {
                $kelas = 'stok-sedikit';
            } else {
                $kelas = '';
            }
        ?>
        <tr>
            <td><?php echo $barang['id_barang']; ?></td>
            <td><?php echo $barang['nama_barang']; ?></td>
            <td class="<?php echo $kelas; ?>"><?php echo $barang['stok']; ?></td>
            <td>Rp <?php echo number_format($barang['harga_umum'], 0, ',', '.'); ?></td>
            <td>Rp <?php echo number_format($barang['harga_member'], 0, ',', '.'); ?></td>
        </tr>
        <?php } ?>
    </table>

    <br>
    <a href="index.php">Kembali ke Beranda</a>
</body>
</html>
