<?php
include "koneksi.php";

$data = mysqli_query($koneksi,"
    SELECT transaksi.*, pelanggan.nama_pemilik, barang.nama_barang
    FROM transaksi
    JOIN pelanggan ON transaksi.no_plat = pelanggan.no_plat
    LEFT JOIN barang ON transaksi.id_barang = barang.id_barang
    ORDER BY transaksi.id_transaksi DESC
");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Transaksi - MyBengkel</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Roboto, Arial, sans-serif;
        }
        body {
            background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
            min-height: 100vh;
            padding: 30px 20px;
        }
        .wadah {
            max-width: 1000px;
            margin: 0 auto;
        }
        h2 {
            color: #ffffff;
            text-align: center;
            margin-bottom: 25px;
            text-shadow: 0 2px 4px rgba(0,0,0,0.3);
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 8px 20px rgba(0,0,0,0.3);
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #e0e0e0;
        }
        th {
            background-color: #007bff;
            color: white;
        }
        tr:hover {
            background-color: #f1f8ff;
        }
        .kembali {
            text-align: center;
            margin-top: 20px;
        }
        .kembali a {
            color: white;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="wadah">
        <h2>📊 Laporan Transaksi</h2>
        <table>
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Pelanggan</th>
                    <th>Layanan</th>
                    <th>Sparepart</th>
                    <th>Jumlah</th>
                    <th>Total Bayar</th>
                </tr>
            </thead>
            <tbody>
                <?php while($t=mysqli_fetch_assoc($data)){ ?>
                <tr>
                    <td><?= $t['tanggal'] ?></td>
                    <td><?= $t['nama_pemilik'] ?></td>
                    <td><?= $t['layanan'] ?></td>
                    <td><?= $t['nama_barang'] ?? '-' ?></td>
                    <td><?= $t['jumlah'] ?? '0' ?></td>
                    <td>Rp <?= number_format((int)($t['total'] ?? 0)) ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        <div class="kembali">
            <a href="index.php">← Kembali ke Menu Utama</a>
        </div>
    </div>
</body>
</html>
