<?php
include "koneksi.php";

// Proses simpan barang baru
if (isset($_POST['simpan'])) {
    mysqli_query($koneksi,"INSERT INTO barang VALUES ('','$_POST[nama_barang]','$_POST[stok]','$_POST[harga_umum]','$_POST[harga_member]')");
    echo "<script>alert('Barang Berhasil Ditambahkan'); location='stok_barang.php';</script>";
}

// Ambil daftar barang
$data = mysqli_query($koneksi,"SELECT * FROM barang");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Stok Barang - MyBengkel</title>
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
            max-width: 900px;
            margin: 0 auto;
        }
        h2 {
            color: #ffffff;
            text-align: center;
            margin-bottom: 25px;
            text-shadow: 0 2px 4px rgba(0,0,0,0.3);
        }
        .kotak-form {
            background: #ffffff;
            padding: 25px 30px;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.3);
            margin-bottom: 25px;
        }
        .form-baris {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin-bottom: 15px;
        }
        .form-grup {
            display: flex;
            flex-direction: column;
        }
        label {
            font-weight: 500;
            margin-bottom: 5px;
            color: #333;
        }
        input {
            padding: 10px 12px;
            border: 1px solid #ced4da;
            border-radius: 6px;
            font-size: 15px;
        }
        input:focus {
            outline: none;
            border-color: #007bff;
            box-shadow: 0 0 0 2px rgba(0,123,255,0.2);
        }
        .tombol {
            display: flex;
            gap: 12px;
            margin-top: 10px;
        }
        button, a.tombol-biasa {
            padding: 10px 20px;
            border-radius: 6px;
            font-size: 15px;
            font-weight: 500;
            border: none;
            cursor: pointer;
            text-decoration: none;
            transition: 0.3s;
        }
        button {
            background-color: #007bff;
            color: white;
        }
        button:hover {
            background-color: #0056b3;
        }
        a.tombol-biasa {
            background-color: #6c757d;
            color: white;
        }
        a.tombol-biasa:hover {
            background-color: #545b62;
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
    </style>
</head>
<body>
    <div class="wadah">
        <h2>📦 Manajemen Stok Barang</h2>

        <!-- Form Tambah Barang -->
        <div class="kotak-form">
            <h3 style="margin-bottom:15px; color:#222;">Tambah Barang Baru</h3>
            <form method="POST">
                <div class="form-baris">
                    <div class="form-grup">
                        <label>Nama Barang:</label>
                        <input type="text" name="nama_barang" required>
                    </div>
                    <div class="form-grup">
                        <label>Stok Awal:</label>
                        <input type="number" name="stok" min="0" value="0" required>
                    </div>
                    <div class="form-grup">
                        <label>Harga Umum (Rp):</label>
                        <input type="number" name="harga_umum" min="0" required>
                    </div>
                    <div class="form-grup">
                        <label>Harga Member (Rp):</label>
                        <input type="number" name="harga_member" min="0" required>
                    </div>
                </div>
                <div class="tombol">
                    <button type="submit" name="simpan">Simpan Barang</button>
                    <a href="index.php" class="tombol-biasa">Kembali</a>
                </div>
            </form>
        </div>

        <!-- Daftar Barang -->
        <h3 style="color:white; margin-bottom:12px;">Daftar Barang</h3>
        <table>
            <thead>
                <tr>
                    <th>Nama Barang</th>
                    <th>Stok</th>
                    <th>Harga Umum</th>
                    <th>Harga Member</th>
                </tr>
            </thead>
            <tbody>
                <?php while($b=mysqli_fetch_assoc($data)){ ?>
                <tr>
                    <td><?= $b['nama_barang'] ?></td>
                    <td><?= $b['stok'] ?></td>
                    <td>Rp <?= number_format((int)$b['harga_umum']) ?></td>
                    <td>Rp <?= number_format((int)$b['harga_member']) ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>

        <div class="kembali">
            <a href="index.php" style="color:white; text-decoration:none;">← Kembali ke Menu Utama</a>
        </div>
    </div>
</body>
</html>
