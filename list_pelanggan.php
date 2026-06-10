<?php
// Panggil koneksi database
include 'koneksi.php';

// Ambil semua data pelanggan
$sql = "SELECT * FROM pelanggan";
$hasil = mysqli_query($koneksi, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Daftar Pelanggan Bengkel</title>
    <style>
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h2>Daftar Pelanggan Bengkel</h2>

    <table>
        <tr>
            <th>Nama Pemilik</th>
            <th>No Plat Kendaraan</th>
            <th>Status</th>
        </tr>

        <?php
        // Tampilkan data
        while ($data = mysqli_fetch_assoc($hasil)) {
        ?>
        <tr>
            <td><?php echo $data['nama_pemilik']; ?></td>
            <td><?php echo $data['no_plat']; ?></td>
            <td><?php echo $data['status_member']; ?></td>
        </tr>
        <?php } ?>
    </table>

    <br>
    <a href="pendaftaran_pelanggan.php">Tambah Pelanggan Baru</a>
</body>
</html>
