<?php
session_start();

if( !isset($_SESSION["login"]) ) {
    header("location: login.php");
    exit;
}

require 'functions.php';
$id = $_GET["id"];

if( hapus($id) > 0 ) {
    echo "
    <script>
    alert('Pesanan berhasil dibatalkan');
    document.location.href = 'index.php';
    </script>
    ";
} else {
echo "
<script>
alert('Pesanan gagal dibatalkan');
document.location.href = 'index.php';
</script>
";
}
?>