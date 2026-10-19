<?php

include "koneksi.php";

if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $query_hapus = "DELETE FROM pelanggan WHERE id_pelanggan = '$id'";
    mysqli_query($koneksi, $query_hapus);

    header("Location: pelanggan.php");
    exit;
}

if (isset($_POST['simpan'])) {

    $nama = $_POST['nama'];
    $no_hp = $_POST['no_hp'];

    $query = "INSERT INTO pelanggan
              (nama, no_hp)
              VALUES
              ('$nama', '$no_hp')";

    mysqli_query($koneksi, $query);

    header("Location: pelanggan.php");
    exit;
}

$data = mysqli_query(
    $koneksi,
    "SELECT * FROM pelanggan ORDER BY id_pelanggan DESC"
);
?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Pelanggan - Warnet Santuy</title>

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

        <h2>Data Pelanggan</h2>

        <p>
            Kelola data pelanggan warnet.
        </p>

    </div>


    <div class="form-box">

        <h3>Tambah Pelanggan</h3>

        <form method="post">

            <div class="form-group">

                <label>Nama Pelanggan</label>

                <input
                    type="text"
                    name="nama"
                    placeholder="Masukkan nama pelanggan"
                    required
                >

            </div>


            <div class="form-group">

                <label>No. HP</label>

                <input
                    type="text"
                    name="no_hp"
                    placeholder="Contoh: 08123456789"
                >

            </div>


            <button
                type="submit"
                name="simpan"
                class="btn"
            >

                + Simpan Pelanggan

            </button>

        </form>

    </div>


    <div class="table-box">

        <h3>Daftar Pelanggan</h3>

        <table>

            <tr>

                <th>No</th>

                <th>Nama</th>

                <th>No. HP</th>

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
                    <?php echo $row['nama']; ?>
                </td>

                <td>
                    <?php echo $row['no_hp']; ?>
                </td>

                <td>
                    <a href="pelanggan.php?hapus=<?php echo $row['id_pelanggan']; ?>" 
                       onclick="return confirm('Yakin ingin menghapus pelanggan ini?');"
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

    <p><b>WARNET SANTUY</b></p>

    <p>Sistem Informasi Warnet ©️ 2026</p>

</div>

</body>

</html>