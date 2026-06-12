<?php
include "koneksi.php";
$data = mysqli_query($koneksi,"SELECT * FROM pelanggan");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pelanggan - MyBengkel</title>
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
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 8px 20px rgba(0,0,0,0.3);
        }
        th, td {
            padding: 14px 12px;
            text-align: left;
            border-bottom: 1px solid #e0e0e0;
        }
        th {
            background-color: #007bff;
            color: white;
            font-weight: 600;
        }
        tr:hover {
            background-color: #f1f8ff;
        }
        .tombol-kembali {
            text-align: center;
            margin-top: 20px;
        }
        a {
            display: inline-block;
            padding: 10px 20px;
            background-color: #6c757d;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            transition: 0.3s;
        }
        a:hover {
            background-color: #545b62;
        }
    </style>
</head>
<body>
    <div class="wadah">
        <h2>📋 Daftar Pelanggan Bengkel</h2>
        <table>
            <thead>
                <tr>
                    <th>Nama Pemilik</th>
                    <th>No. Plat Kendaraan</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php while($p=mysqli_fetch_assoc($data)){ ?>
                <tr>
                    <td><?= $p['nama_pemilik'] ?></td>
                    <td><?= $p['no_plat'] ?></td>
                    <td><?= $p['status_member'] ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        <div class="tombol-kembali">
            <a href="index.php">← Kembali ke Menu Utama</a>
        </div>
    </div>
</body>
</html>
