<?php
session_start();


$koneksi = new mysqli('localhost', 'root', '', 'myapp_agoeng') or die(mysqli_error($koneksi));
if (isset($_POST['login'])) {
    $username = htmlspecialchars($_POST['username']);
    $password = sha1($_POST['password']);
    $query = $koneksi->query("SELECT * FROM user WHERE username='$username' and password='$password'");
    $num = mysqli_num_rows($query);
    $c = mysqli_fetch_array($query);
    if ($num > 0) {
        $_SESSION['username'] = $c['username'];
        $_SESSION['nmUser'] = $c['nmUser'];
        header("location:index.php");
    } else {
        echo "Gagal";
    }
}
if (isset($_FILES['gambar'])) {
    $uploadDir = '/xampp/htdocs/BLOCKING_XI/agoeng/assets/img/'; // Direktori tempat gambar disimpan di index utama
    $uploadedFile = $uploadDir . basename($_FILES['gambar']['name']);

    if (move_uploaded_file($_FILES['gambar']['tmp_name'], $uploadedFile)) {
   
    } else {
        
    }
}

