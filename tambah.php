<?php
session_start();

if( !isset($_SESSION["login"]) ) {
    header("location: login.php");
    exit;
}

require 'functions.php';

if( isset($_POST["submit"]) ) {
    

    if( tambah($_POST) > 0 ) {
        echo "
        <script>
        alert('Pesanan berhasil ditambahkan');
        document.location.href = 'index.php';
        </script>
        ";
} else {
    echo "
    <script>
    alert('Pesanan gagal ditambahkan');
    document.location.href = 'index.php';
    </script>
    ";
}
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>tambah pesanan</title>
</head>
<body>
    <h1>Tambah Pesanan</h1>

    <form action="" method="post" enctype="multipart/form-data">
        <ul>
            <li>
                <label for="nama">Nama :</label>
                <input type="text" name="nama" id="nama" required>
            </li>
            <li>
                <label for="telepon">Telepon :</label>
                <input type="text" name="telepon" id="telepon" required>
            </li>
            <li>
                <label for="email">Email :</label>
                <input type="text" name="email" id="email" required>
            </li>
            <li>
                <label for="nkb">Nkb :</label>
                <input type="text" name="nkb" id="nkb" required>
            </li>
            <li>
                <label for="jumlah_pesanan">Jumlah pesanan :</label>
                <input type="text" name="jumlah_pesanan" id="jumlah_pesanan" required>
            </li>
            <li>
                <label for="gambar">Gambar :</label>
                <input type="file" name="gambar" id="gambar">
            </li>
            <li>
                <button type="submit" name="submit">Pesan</button>
            </li>
        </ul>

</body>
</html>