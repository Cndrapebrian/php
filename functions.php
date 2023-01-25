<?php
$conn = mysqli_connect("localhost", "root", "", "cp7shopp");


function query($query) {
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while( $row = mysqli_fetch_assoc($result) ) {
        $rows[] = $row;
    }
    return $rows;
}


function tambah($data) {
    global $conn;

     $nama = htmlspecialchars($data["nama"]);
     $telepon = htmlspecialchars($data["telepon"]);
     $email = htmlspecialchars($data["email"]);
     $nkb = htmlspecialchars($data["nkb"]);
     $jumlah_pesanan = htmlspecialchars($data["jumlah_pesanan"]);
     $gambar = upload();
     if( !$gambar ){
        return false;
     }
     


    $query = "INSERT INTO pemesanan VALUES
    ('', '$nama', '$telepon', '$email', '$nkb', '$gambar', '$jumlah_pesanan')
    ";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
    
}

function upload() {
    
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    if( $error === 4 ) {
        echo"<script>
        alert('pilih gambar terlebih dahulu!');
        </script>";
        return false;
    }

    $ekstensiGambarValid = ['jpg', 'jpeg', 'png', 'jfif'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if( !in_array($ekstensiGambar, $ekstensiGambarValid) ) {
        echo"<script>
        alert('yang anda upload bukan gambar!');
        </script>";
        return false;
    }

    if( $ukuranFile > 1000000 ) {
        echo"<script>
        alert('ukuran gambar terlalu besar!');
        </script>";
        return false;
}


$namaFileBaru = uniqid();
$namaFileBaru .= '.';
$namaFileBaru .= $ekstensiGambar;


move_uploaded_file($tmpName, 'img/' . $namaFileBaru);

return $namaFileBaru;



}



function hapus($id) {
    global $conn;
    mysqli_query($conn, "DELETE FROM pemesanan WHERE id = $id");

    return mysqli_affected_rows($conn);
}



function ubah($data) {
    global $conn;
    
    $id = $data["id"];
    $nama = htmlspecialchars($data["nama"]);
    $telepon = htmlspecialchars($data["telepon"]);
    $email = htmlspecialchars($data["email"]);
    $nkb = htmlspecialchars($data["nkb"]);
    $jumlah_pesanan = htmlspecialchars($data["jumlah_pesanan"]);
    $gambarLama = htmlspecialchars($data["gambarLama"]);
    if( $_FILES['gambar']['error'] === 4 ) {
        $gambar = $gambarLama;
    } else {
    $gambar = upload();
    }
    
    
    


   $query = "UPDATE pemesanan SET
   nama = '$nama',
   telepon = '$telepon',
   email = '$email',
   nkb = '$nkb',
   jumlah_pesanan = '$jumlah_pesanan',
   gambar = '$gambar'
   
   WHERE id =$id

   ";
   mysqli_query($conn, $query);

   return mysqli_affected_rows($conn);
}



function cari($keyword) {
    $query = "SELECT * FROM pemesanan 
    WHERE
    nama LIKE '%$keyword%'
    ";

    return query($query);
}



function registrasi($data) {
    global $conn;

    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);

    $result = mysqli_query($conn, "SELECT username FROM users WHERE username = '$username'");

    if( mysqli_fetch_assoc($result) ) {
        echo"<script>
        alert('Username sudah terdaftar');
        </script>";
        return false;
    }

    if ( $password !== $password2 ) {
        echo "<script>
             alert('Konfirmasi password tidak sesuai!');          
              </script>";
              return false;
    }

    $password = password_hash($password, PASSWORD_DEFAULT);


    mysqli_query($conn, "INSERT INTO users VALUES('', '$username', '$password')");
    
    return mysqli_affected_rows($conn);



}









?>