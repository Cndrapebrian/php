<?php
session_start();

if( !isset($_SESSION["login"]) ) {
    header("location: login.php");
    exit;
}

require 'functions.php';

$pemesanan = query("SELECT * FROM pemesanan");

if( isset($_POST["cari"]) ) {
    $pemesanan = cari($_POST["keyword"]);
}
?>
<!DOCTYPE html>
<html>
<head>
    <a href="logout.php">Logout</a>
    <title>Halaman Admin1</title>
</head>
<body>
    
<h1>Daftar Pesanan</h1>

<a href="tambah.php">Tambah Pesanan</a>
<br><br>

<form action="" method="post">

<input type="text" name="keyword" size="25" autofocus placeholder="
masukan keyword pencarian.." autocomplete="off">
<button type="submit" name="cari">Cari</button>
</form>
<br>
<table border="1" cellpadding="10" cellspacing="0">
    <tr>
        <th>No.</th>
        <th>Aksi.</th>
        <th>Nama</th>
        <th>Telepon</th>
        <th>Email</th>
        <th>Gambar</th>
        <th>Jumlah Pesanan</th>
</tr>
<?php $i = 1; ?>
<?php foreach($pemesanan as $row) : ?>
<tr>
    <td><?= $i; ?></td>
    <td>
        <a href="ubah.php?id=<?= $row["id"]; ?>">Ubah</a>
        <a href="hapus.php?id=<?= $row["id"]; ?>" onclick="return confirm('Apakah anda yakin ingin membatalkan pesanan?');">Batal</a>
    </td>
    <td><?= $row["nama"]; ?></td>
    <td><?= $row["telepon"]; ?></td>
    <td><?= $row["email"]; ?></td>
    <td><img src="img/<?php echo $row["gambar"]; ?>" width="50"></td>
    <td><?= $row["jumlah_pesanan"]; ?></td>
</tr>
<?php $i ++; ?>
<?php endforeach; ?>
</body>
</html>