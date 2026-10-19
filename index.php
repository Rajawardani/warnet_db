<?php
include "koneksi.php";

$dataKomputer = mysqli_query($koneksi, "SELECT * FROM komputer");
$totalKomputer = mysqli_num_rows($dataKomputer);

$dataPelanggan = mysqli_query($koneksi, "SELECT * FROM pelanggan");
$totalPelanggan = mysqli_num_rows($dataPelanggan);

$dataTransaksi = mysqli_query($koneksi, "SELECT * FROM transaksi");
$totalTransaksi = mysqli_num_rows($dataTransaksi);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Warnet santuy</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="header">
    <h1>WARNET SANTUY</h1>
    <p>Sistem Informasi Manajemen Warnet</p>
</div>

<div class="navbar">
    <a href="index.php">Dashboard</a>
    <a href="komputer.php">Komputer</a>
    <a href="pelanggan.php">Pelanggan</a>
    <a href="transaksi.php">Transaksi</a>
    <a href="riwayat.php">Riwayat</a>
</div>

<div class="container">

    <div class="title">
        <h2>Dashboard</h2>
        <p>Selamat datang di Sistem Informasi Warnet Santuy.</p>
    </div>

    <div class="dashboard">

        <div class="card">
            <h3>🖥️ Total Komputer</h3>

            <div class="jumlah">
                <?php echo $totalKomputer; ?>
            </div>

            <p>Komputer terdaftar</p>

            <a href="komputer.php">
                Kelola komputer →
            </a>
        </div>

        <div class="card">
            <h3>👥 Pelanggan</h3>

            <div class="jumlah">
                <?php echo $totalPelanggan; ?>
            </div>

            <p>Pelanggan terdaftar</p>

            <a href="pelanggan.php">
                Kelola pelanggan →
            </a>
        </div>

        <div class="card">
            <h3>💳 Transaksi</h3>

            <div class="jumlah">
                <?php echo $totalTransaksi; ?>
            </div>

            <p>Total transaksi</p>

            <a href="riwayat.php">
                Lihat riwayat →
            </a>
        </div>

    </div>

</div>

<div class="footer">
    <p><b>Warnet Santuy</b></p>
    <p>Sistem Informasi Warnet © 2026</p>
</div>

</body>
</html>