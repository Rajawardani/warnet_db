<?php

include "koneksi.php";

if (isset($_POST['simpan'])) {

    $pelanggan = $_POST['pelanggan'];
    $komputer  = $_POST['komputer'];
    $lama      = $_POST['lama'];

    $tarif = 5000;
    $total_biaya = $lama * $tarif;
    $waktu_mulai = date("Y-m-d H:i:s");

    // Pastikan 'Lunas' dibungkus tanda petik
    $query = "INSERT INTO transaksi
              (id_pelanggan, id_komputer, waktu_mulai, total_biaya, status_pembayaran)
              VALUES
              ('$pelanggan',
               '$komputer',
               '$waktu_mulai',
               '$total_biaya',
               'Lunas')";

    mysqli_query($koneksi, $query);

    mysqli_query(
        $koneksi,
        "UPDATE komputer
         SET status='Digunakan'
         WHERE id_komputer='$komputer'"
    );

    header("Location: transaksi.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Transaksi - Warnet Santuy</title>

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

        <h2>Transaksi Warnet</h2>

        <p>
            Catat penggunaan komputer pelanggan.
        </p>

    </div>


    <div class="form-box">

        <h3>Tambah Transaksi</h3>

        <form method="post">

            <div class="form-group">

                <label>Pelanggan</label>

                <select name="pelanggan" required>

                    <option value="">
                        -- Pilih Pelanggan --
                    </option>

                    <?php

                    $pelanggan = mysqli_query(
                        $koneksi,
                        "SELECT * FROM pelanggan
                         ORDER BY nama ASC"
                    );

                    while ($p = mysqli_fetch_assoc($pelanggan)) {

                    ?>

                    <option value="<?php echo $p['id_pelanggan']; ?>">

                        <?php echo $p['nama']; ?>

                    </option>

                    <?php

                    }

                    ?>

                </select>

            </div>


            <div class="form-group">

                <label>Komputer</label>

                <select name="komputer" required>

                    <option value="">
                        -- Pilih Komputer --
                    </option>

                    <?php

                    $komputer = mysqli_query(
                        $koneksi,
                        "SELECT * FROM komputer
                         WHERE status='Tersedia'
                         ORDER BY nomor_komputer ASC"
                    );

                    while ($k = mysqli_fetch_assoc($komputer)) {

                    ?>

                    <option value="<?php echo $k['id_komputer']; ?>">

                        <?php echo $k['nomor_komputer']; ?>
                        -
                        <?php echo $k['spesifikasi']; ?>

                    </option>

                    <?php

                    }

                    ?>

                </select>

            </div>


            <div class="form-group">

                <label>Lama Pemakaian (Jam)</label>

                <input
                    type="number"
                    name="lama"
                    min="1"
                    placeholder="Contoh: 2"
                    required
                >

                <small>
                    Tarif penggunaan: Rp5.000 / jam
                </small>

            </div>


            <button
                type="submit"
                name="simpan"
                class="btn"
            >

                + Simpan Transaksi

            </button>

        </form>

    </div>

</div>


<div class="footer">

    <p><b>Warnet Santuy</b></p>

    <p>Sistem Informasi Warnet ©️ 2026</p>

</div>

</body>

</html>