<?php
include "koneksi.php";

if (isset($_POST['simpan'])) {
    mysqli_query($koneksi,"INSERT INTO pelanggan VALUES ('','$_POST[nama_pemilik]','$_POST[no_plat]','$_POST[status_member]')");
    echo "<script>alert('Pendaftaran Berhasil'); location='list_pelanggan.php';</script>";
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Pelanggan Baru - MyBengkel</title>
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
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .kotak-form {
            background-color: #ffffff;
            padding: 35px 40px;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.3);
            width: 100%;
            max-width: 420px;
        }
        h2 {
            color: #212529;
            text-align: center;
            margin-bottom: 25px;
        }
        .kelompok {
            margin-bottom: 18px;
        }
        label {
            display: block;
            font-weight: 500;
            margin-bottom: 6px;
            color: #333;
        }
        input, select {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #ced4da;
            border-radius: 6px;
            font-size: 15px;
        }
        input:focus, select:focus {
            outline: none;
            border-color: #007bff;
            box-shadow: 0 0 0 2px rgba(0,123,255,0.2);
        }
        .tombol-grup {
            display: flex;
            gap: 12px;
            margin-top: 10px;
        }
        button, a.tombol-kembali {
            padding: 10px 20px;
            border-radius: 6px;
            font-size: 15px;
            font-weight: 500;
            text-decoration: none;
            cursor: pointer;
            border: none;
            transition: 0.3s;
        }
        button {
            background-color: #007bff;
            color: white;
        }
        button:hover {
            background-color: #0056b3;
        }
        a.tombol-kembali {
            background-color: #6c757d;
            color: white;
        }
        a.tombol-kembali:hover {
            background-color: #545b62;
        }
    </style>
</head>
<body>
    <div class="kotak-form">
        <h2>📝 Pendaftaran Pelanggan Baru</h2>
        <form method="POST">
            <div class="kelompok">
                <label>Nama Pemilik:</label>
                <input type="text" name="nama_pemilik" required>
            </div>
            <div class="kelompok">
                <label>No. Plat Kendaraan:</label>
                <input type="text" name="no_plat" required>
            </div>
            <div class="kelompok">
                <label>Status Keanggotaan:</label>
                <select name="status_member">
                    <option value="Non-Member">Non-Member</option>
                    <option value="Member">Member</option>
                </select>
            </div>
            <div class="tombol-grup">
                <button type="submit" name="simpan">Daftar Pelanggan</button>
                <a href="index.php" class="tombol-kembali">Kembali</a>
            </div>
        </form>
    </div>
</body>
</html>
