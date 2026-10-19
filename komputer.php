<?php

include "koneksi.php";

if (isset($_GET['selesai'])) {
    $id = $_GET['selesai'];
    $query_selesai = "UPDATE komputer SET status ='Tersedia' WHERE id_komputer = '$id'";
    mysqli_query($koneksi, $query_selesai);

    header("Location: komputer.php");
    exit;
}

if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $query_hapus = "DELETE FROM komputer WHERE id_komputer = '$id'";
    mysqli_query($koneksi, $query_hapus);

    header("Location: komputer.php");
    exit;
}

if (isset($_POST['simpan'])) {

    $nomor       = $_POST['nomor'];
    $spesifikasi = $_POST['spesifikasi'];
    $status      = $_POST['status'];
    
    $query = "INSERT INTO komputer (nomor_komputer, spesifikasi, status) 
              VALUES ('$nomor', '$spesifikasi', '$status')";

    mysqli_query($koneksi, $query);

    header("Location: komputer.php");
    exit;
}

$data = mysqli_query(
    $koneksi,
    "SELECT * FROM komputer ORDER BY id_komputer DESC"
);

?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Data Komputer - Warnet Santuy</title>

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
        <h2>Data Komputer</h2>
        <p>Kelola data komputer warnet.</p>
    </div>

    <div class="form-box">

        <h3>Tambah Komputer</h3>

        <form method="post">

            <div class="form-group">
                <label>Nomor Komputer</label>

                <input
                    type="text"
                    name="nomor"
                    placeholder="Contoh: PC-01"
                    required
                >
            </div>

            <div class="form-group">
                <label>Spesifikasi Komputer</label>

                <input
                    type="text"
                    name="spesifikasi"
                    placeholder="Contoh: Ryzen xxxx"
                    required
                >
            </div>

            <div class="form-group">
                <label>Status</label>

                <select name="status">

                    <option value="Tersedia">
                        Tersedia
                    </option>

                    <option value="Digunakan">
                        Digunakan
                    </option>

                    <option value="Perbaikan">
                        Perbaikan
                    </option>

                </select>
            </div>

            <button
                type="submit"
                name="simpan"
                class="btn"
            >
                + Simpan Komputer
            </button>

        </form>

    </div>


    <div class="table-box">

        <h3>Daftar Komputer</h3>

        <table>

            <tr>
                <th>No</th>
                <th>Nomor</th>
                <th>Spesifikasi Komputer</th>
                <th>Status</th>
                <th>Opsi</th>
            </tr>

            <?php

            $no = 1;

            while ($row = mysqli_fetch_assoc($data)) {

            ?>

            <tr>

                <td>
                    <?php echo $no++; ?>
                </td>

                <td>
                    <?php echo $row['nomor_komputer']; ?>
                </td>

                <td>
                    <?php echo $row['spesifikasi']; ?>
                </td>

                <td>

                    <span class="status <?php echo strtolower($row['status']); ?>">

                        <?php echo $row['status']; ?>

                    </span>

                </td>

                <td>
                    <?php if ($row['status'] == 'Digunakan'): ?>
                        <a href="komputer.php?selesai=<?= $row['id_komputer']; ?>"
                           onclick="return confirm('Selesaikan penggunaan komputer ini?');"
                           style="color: green; margin-right: 8px;">
                           Selesai
                        </a>
                    <?php endif; ?>
                        <a href="komputer.php?hapus=<?php echo $row['id_komputer']; ?>" 
                           onclick="return confirm('Yakin ingin menghapus komputer ini?');"
                           style="color: red; text-decoration: none; font-weight: bold;">
                        Hapus
                    </a>
                </td>

            </tr>

            <?php
            }
            ?>

        </table>

    </div>

</div>

<div class="footer">
    <p><b>Warnet Santuy</b></p>
    <p>Sistem Informasi Warnet ©️ 2026</p>
</div>

</body>
</html>