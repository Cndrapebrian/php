<?php
session_start();

if( !isset($_SESSION["login"]) ) {
    header("location: login.php");
    exit;
}

require 'functions.php';

$id = $_GET["id"];


$psn = query("SELECT * FROM pemesanan WHERE id = $id")[0];


if( isset($_POST["submit"]) ) {

    if( ubah($_POST) > 0 ) {
        echo "
        <script>
        alert('Pesanan berhasil diubah');
        document.location.href = 'index.php';
        </script>
        ";
} else {
    echo "
    <script>
    alert('Pesanan gagal diubah');
    document.location.href = 'index.php';
    </script>
    ";
}


}
?>
<!DOCTYPE html>
<html>
<head>
    <title>ubah pesanan</title>
</head>
<body>
    <h1>ubah Pesanan</h1>

    <form action="" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= $psn["id"]; ?>">
                <input type="hidden" name="gambarLama" value="<?= $psn["gambar"]; ?>">
            <ul>
            <li>
                <label for="nama">Nama :</label>
                <input type="text" name="nama" id="nama" required value="<?= $psn["nama"]; ?>">
            </li>
            <li>
                <label for="telepon">Telepon :</label>
                <input type="text" name="telepon" id="telepon" required value="<?= $psn["telepon"]; ?>">
            </li>
            <li>
                <label for="email">Email :</label>
                <input type="text" name="email" id="email" required value="<?= $psn["email"]; ?>">
            </li>
            <li>
                <label for="nkb">Nkb :</label>
                <input type="text" name="nkb" id="nkb" required value="<?= $psn["nkb"]; ?>">
            </li>
            <li>
                <label for="jumlah_pesanan">Jumlah pesanan :</label>
                <input type="text" name="jumlah_pesanan" id="jumlah_pesanan" required value="<?= $psn["jumlah_pesanan"]; ?>">
            </li>
            <li>
                <label for="gambar">Gambar :</label><br>
                <img src="img/<?= $psn['gambar']; ?>" width="50"><br>
                <input type="file" name="gambar" id="gambar">
            </li>
            <li>
                <button type="submit" name="submit">Ubah Pesanan</button>
            </li>
        </ul>

</body>
</html>