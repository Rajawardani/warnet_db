<?php

include "koneksi.php";

$query = "
    SELECT 
        transaksi.*, 
        pelanggan.nama, 
        komputer.nomor_komputer
    FROM transaksi
    INNER JOIN pelanggan ON transaksi.id_pelanggan = pelanggan.id_pelanggan
    INNER JOIN komputer ON transaksi.id_komputer = komputer.id_komputer
    ORDER BY transaksi.id_transaksi DESC
";

$data = mysqli_query($koneksi, $query);

?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat - Warnet Santuy</title>
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
        <h2>Riwayat Transaksi</h2>
        <p>Daftar riwayat penggunaan komputer warnet.</p>
    </div>

    <div class="table-box">
        <h3>Data Riwayat</h3>

        <table>
            <tr>
                <th>No</th>
                <th>Nama Pelanggan</th>
                <th>Komputer</th>
                <th>Waktu Mulai</th>
                <th>Total Biaya</th>
                <th>Status Pembayaran</th>
            </tr>

            <?php
            $no = 1;
            while ($row = mysqli_fetch_assoc($data)) {
            ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $row['nama']; ?></td>
                <td><?php echo $row['nomor_komputer']; ?></td>
                <td><?php echo $row['waktu_mulai']; ?></td>
                <td>Rp<?php echo number_format($row['total_biaya'], 0, ',', '.'); ?></td>
                <td>
                    <span class="status lunas">
                        <?php echo $row['status_pembayaran']; ?>
                    </span>
                </td>
            </tr>
            <?php } ?>
        </table>
    </div>

</div>

<div class="footer">
    <p><b>Warnet Santuy</b></p>
    <p>Sistem Informasi Warnet ©️ 2026</p>
</div>

</body>
</html>