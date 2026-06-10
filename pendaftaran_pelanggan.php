<?php
// Panggil koneksi
include 'koneksi.php';

// Proses hanya jika tombol diklik
if (isset($_POST['daftar'])) {
    // Ambil data dari formulir
    $nama     = $_POST['nama_pemilik'];
    $no_plat  = $_POST['no_plat'];
    $status   = $_POST['status'];

    // Simpan ke database
    $sql = "INSERT INTO pelanggan (nama_pemilik, no_plat, status_member)
            VALUES ('$nama', '$no_plat', '$status')";

    if (mysqli_query($koneksi, $sql)) {
        $pesan = "Data berhasil disimpan!";
    } else {
        $pesan = "Gagal menyimpan: " . mysqli_error($koneksi);
    }
}
?>

<!-- Tampilan Formulir -->
<!DOCTYPE html>
<html>
<head>
    <title>Pendaftaran Pelanggan Baru</title>
</head>
<body>
    <h2>Pendaftaran Pelanggan Baru</h2>

    <?php if(isset($pesan)) echo "<p>$pesan</p>"; ?>

    <form method="post" action="">
        <label>Nama Pemilik:</label><br>
        <input type="text" name="nama_pemilik" required><br><br>

        <label>No. Plat Kendaraan:</label><br>
        <input type="text" name="no_plat" required><br><br>

        <label>Status:</label><br>
        <select name="status">
            <option value="Non-Member">Non-Member</option>
            <option value="Member">Member</option>
        </select><br><br>

        <button type="submit" name="daftar">Daftar Pelanggan</button>
        <a href="index.php">Kembali</a>
    </form>
</body>
</html>
