<?php
include 'koneksi.php';

// Proses tambah barang
if (isset($_POST['tambah'])) {
    $kode = $_POST['kode_barang'];
    $nama = $_POST['nama_barang'];
    $jenis = $_POST['jenis'];
    $stok = $_POST['stok'];
    $beli = $_POST['harga_beli'];
    $jual = $_POST['harga_jual'];
    $ket = $_POST['keterangan'];

    $sql = "INSERT INTO barang (kode_barang, nama_barang, jenis, stok, harga_beli, harga_jual, keterangan)
            VALUES ('$kode', '$nama', '$jenis', '$stok', '$beli', '$jual', '$ket')";
    
    if (mysqli_query($koneksi, $sql)) {
        $pesan = "<p style='color:green;'> Barang berhasil ditambahkan!</p>";
    } else {
        $pesan = "<p style='color:red;'> Gagal: " . mysqli_error($koneksi) . "</p>";
    }
}

// Ambil semua data barang
$sql_barang = "SELECT * FROM barang ORDER BY nama_barang ASC";
$hasil_barang = mysqli_query($koneksi, $sql_barang);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Stok Barang - MyBengkel</title>
    <style>
        body { font-family: Arial; margin: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background: #f2f2f2; }
        form { border: 1px solid #ddd; padding: 15px; max-width: 500px; margin-bottom: 20px; }
        input { width: 100%; padding: 8px; margin: 5px 0 15px 0; }
        button { padding: 8px 15px; background: #28a745; color: white; border: none; cursor: pointer; }
        .stok-min { color: red; font-weight: bold; }
    </style>
</head>
<body>
    <h2>Manajemen Stok Barang</h2>
    <?php if(isset($pesan)) echo $pesan; ?>

    <!-- Form Tambah Barang -->
    <h4>Tambah Barang Baru</h4>
    <form method="post">
        <label>Kode Barang:</label>
        <input type="text" name="kode_barang" required>

        <label>Nama Barang:</label>
        <input type="text" name="nama_barang" required>

        <label>Jenis:</label>
        <input type="text" name="jenis" placeholder="Oli, Filter, dll">

        <label>Stok Awal:</label>
        <input type="number" name="stok" min="0" value="0">

        <label>Harga Beli (Rp):</label>
        <input type="number" name="harga_beli" min="0">

        <label>Harga Jual (Rp):</label>
        <input type="number" name="harga_jual" min="0">

        <label>Keterangan:</label>
        <input type="text" name="keterangan">

        <button type="submit" name="tambah">Simpan Barang</button>
    </form>

    <!-- Tabel Daftar Barang -->
    <h4>Daftar Stok Barang</h4>
    <table>
        <tr>
            <th>Kode</th>
            <th>Nama Barang</th>
            <th>Jenis</th>
            <th>Stok</th>
            <th>Harga Jual</th>
            <th>Keterangan</th>
        </tr>
        <?php while ($data = mysqli_fetch_assoc($hasil_barang)) { ?>
        <tr>
            <td><?php echo $data['kode_barang']; ?></td>
            <td><?php echo $data['nama_barang']; ?></td>
            <td><?php echo $data['jenis']; ?></td>
            <td class="<?php echo ($data['stok'] < 3) ? 'stok-min' : ''; ?>">
                <?php echo $data['stok']; ?>
            </td>
            <td>Rp <?php echo number_format($data['harga_jual'], 0, ',', '.'); ?></td>
            <td><?php echo $data['keterangan']; ?></td>
        </tr>
        <?php } ?>
    </table>

    <br>
    <a href="index.php">Kembali ke Beranda</a>
</body>
</html>
