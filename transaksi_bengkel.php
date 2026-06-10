<?php
include 'koneksi.php';

$pesan = "";
$tampil_nota = false;

// ✅ PERBAIKAN: tanda kurung dan kutip yang benar
if (isset($_POST['simpan'])) {
    $no_plat       = $_POST['no_plat'];
    $layanan       = $_POST['layanan'];
    $biaya_layanan = (int)$_POST['biaya_layanan'];
    $id_barang     = !empty($_POST['id_barang']) ? (int)$_POST['id_barang'] : NULL;
    $jumlah        = !empty($_POST['jumlah']) ? (int)$_POST['jumlah'] : 0;
    $total_harga   = (int)$_POST['total_harga'];

    $sql = "INSERT INTO transaksi (no_plat, layanan, biaya, id_barang, jumlah, total)
            VALUES ('$no_plat', '$layanan', '$biaya_layanan', '$id_barang', '$jumlah', '$total_harga')";

    if (mysqli_query($koneksi, $sql)) {
        $last_id = mysqli_insert_id($koneksi);

        $t = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM transaksi WHERE id_transaksi = $last_id"));
        $p = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM pelanggan WHERE no_plat = '$no_plat'"));
        
        $nama_barang = "";
        if (!empty($id_barang)) {
            $brg = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT nama_barang FROM barang WHERE id_barang = $id_barang"));
            $nama_barang = $brg['nama_barang'];
        }

        // Variabel nota
        $id_transaksi = $t['id_transaksi'];
        $tanggal      = date('d M Y, H:i', strtotime($t['tanggal']));
        $nama_pel     = $p['nama_pemilik'];
        $plat         = $t['no_plat'];
        $jenis_lay    = $t['layanan'];
        $biaya        = $t['biaya'];
        $jml_barang   = $jumlah;
        $barang_nama  = $nama_barang;
        $total        = $t['total'];

        $pesan = "<p style='color:green; font-weight:bold;'>✅ Transaksi berhasil disimpan! Berikut nota Anda:</p>";
        $tampil_nota = true;
    } else {
        $pesan = "<p style='color:red; font-weight:bold;'>❌ Gagal: " . mysqli_error($koneksi) . "</p>";
    }
}

// Data untuk form
$pelanggan = mysqli_query($koneksi, "SELECT nama_pemilik, no_plat, status_member FROM pelanggan ORDER BY nama_pemilik");
$barang    = mysqli_query($koneksi, "SELECT id_barang, nama_barang, stok, harga_umum, harga_member FROM barang WHERE stok > 0 ORDER BY nama_barang");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Kasir MyBengkel</title>
    <script>
        function hitungTotal() {
            let elPel = document.querySelector('select[name="no_plat"]');
            let status = elPel?.selectedOptions[0]?.dataset?.status || 'Non-Member';
            let elBrg = document.querySelector('select[name="id_barang"]');
            let harga = 0;
            if (elBrg && elBrg.value !== "") {
                harga = (status === 'Member')
                    ? parseInt(elBrg.selectedOptions[0].dataset.hargaMember || 0)
                    : parseInt(elBrg.selectedOptions[0].dataset.hargaUmum || 0);
            }
            let jml = parseInt(document.querySelector('input[name="jumlah"]').value || 0);
            let biaya = parseInt(document.querySelector('input[name="biaya_layanan"]').value || 0);
            let total = biaya + (harga * jml);
            document.getElementById('total_harga').value = total;
            document.getElementById('tampil_total').textContent = 'Rp ' + total.toLocaleString('id-ID');
        }
    </script>
    <style>
        body { font-family: Arial; margin: 20px; max-width: 650px; }
        select, input { width:100%; padding:8px; margin:6px 0; border:1px solid #ccc; border-radius:4px; }
        button { padding:8px 20px; background:#28a745; color:#fff; border:none; border-radius:4px; cursor:pointer; }
        .nota { margin-top:25px; border:2px solid #cc0000; padding:20px; background:#fff; max-width:400px; margin-left:auto; margin-right:auto; }
        .nota-header { text-align:center; margin-bottom:15px; }
        .nota-header h2, .nota-header h3 { margin:0; }
        .garis { border-bottom:1px solid #000; margin:8px 0; }
        .cetak-btn { background:#28a745; color:white; padding:6px 12px; border:none; border-radius:3px; cursor:pointer; margin:10px 0; }
        .tengah { text-align:center; font-size:13px; margin-top:15px; }
        @media print {
            form, .nav { display:none; }
            .nota { border:1px solid #000; max-width:100%; }
            .cetak-btn { display:none; }
        }
    </style>
</head>
<body>
    <h2>Kasir MyBengkel</h2>
    <?php echo $pesan; ?>

    <form method="post">
        <label>Pilih Pelanggan:</label>
        <select name="no_plat" onchange="hitungTotal()" required>
            <option value="">-- Pilih --</option>
            <?php while($d=mysqli_fetch_assoc($pelanggan)){ ?>
            <option value="<?=$d['no_plat']?>" data-status="<?=$d['status_member']?>">
                <?=$d['nama_pemilik']?> - <?=$d['no_plat']?> (<?=$d['status_member']?>)
            </option>
            <?php } ?>
        </select>

        <label>Jenis Layanan:</label>
        <input type="text" name="layanan" placeholder="Contoh: Servis Ringan, Ganti Oli" required>

        <label>Biaya Layanan (Rp):</label>
        <input type="number" name="biaya_layanan" min="0" value="0" oninput="hitungTotal()" required>

        <label>Pakai Sparepart:</label>
        <select name="id_barang" onchange="hitungTotal()">
            <option value="">-- Tidak Pakai --</option>
            <?php while($b=mysqli_fetch_assoc($barang)){ ?>
            <option value="<?=$b['id_barang']?>" 
                data-harga-umum="<?=$b['harga_umum']?>" 
                data-harga-member="<?=$b['harga_member']?>">
                <?=$b['nama_barang']?> (Stok: <?=$b['stok']?>)
            </option>
            <?php } ?>
        </select>

        <label>Jumlah Barang:</label>
        <input type="number" name="jumlah" min="0" value="1" oninput="hitungTotal()">

        <div style="font-weight:bold; font-size:17px; margin:10px 0;">Total Bayar: <span id="tampil_total">Rp 0</span></div>
        <input type="hidden" name="total_harga" id="total_harga" value="0">

        <br>
        <button type="submit" name="simpan">Simpan & Buat Nota</button>
    </form>

    <div class="nav">
        <br>
        <a href="dashboard_stok.php">Stok Barang</a> | 
        <a href="list_pelanggan.php">Daftar Pelanggan</a> | 
        <a href="index.php">Kembali</a>
    </div>

    <!-- ✅ NOTA SEPERTI CONTOH -->
    <?php if ($tampil_nota): ?>
    <div class="nota">
        <div class="nota-header">
            <h2>NOTA TRANSAKSI</h2>
            <h3>MyBengkel</h3>
            <p>Jl. Contoh No. 123, Denpasar, Bali</p>
        </div>
        <div class="garis"></div>

        <p><strong>ID Transaksi:</strong> <?=$id_transaksi?></p>
        <p><strong>Tanggal:</strong> <?=$tanggal?></p>
        <p><strong>Nama Pelanggan:</strong> <?=$nama_pel?></p>
        <p><strong>No. Plat:</strong> <?=$plat?></p>
        <p><strong>Jenis Layanan:</strong> <?=$jenis_lay?></p>
        <?php if (!empty($barang_nama)): ?>
        <p><strong>Sparepart:</strong> <?=$barang_nama?> x <?=$jml_barang?></p>
        <?php endif; ?>
        <p><strong>Biaya:</strong> Rp <?=number_format($biaya,0,',','.')?></p>
        <p><strong>Total Bayar:</strong> Rp <?=number_format($total,0,',','.')?></p>

        <div class="tengah">
            <button class="cetak-btn" onclick="window.print()">Cetak Nota</button>
            <p>Terima kasih atas kunjungan Anda!</p>
        </div>
    </div>
    <?php endif; ?>
</body>
</html>
