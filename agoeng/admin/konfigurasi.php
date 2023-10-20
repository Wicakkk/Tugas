<?php
include '../config.php';

if (isset($_POST['simpan'])) {
    $judul = $_POST['judul'];
    $subjudul = $_POST['subjudul'];
    $status = $_POST['status'];
    $namagambar = $_FILES['gambar']['name'];
    $ekstensi_diperbolehkan = array('png', 'jpg', 'jpeg');
    $x = explode('.', $namagambar);
    $ekstensi = strtolower(end($x));
    $ukuran = $_FILES['gambar']['size'];
    $file_tmp = $_FILES['gambar']['tmp_name'];

    if (in_array($ekstensi, $ekstensi_diperbolehkan) && $ukuran < 1044070) {
            move_uploaded_file($file_tmp, '../assets/img/' . $namagambar);
            $koneksi->query("INSERT INTO hero (gambar, judul, subjudul, status)VALUES ('$namagambar', '$judul', '$subjudul', '$status')");
            header("location:index.php");}
            else {
                $_SESSION['gagalposting'] = "Maaf Postingan tidak berhasil disimpan karena Format tidak sesuai atau ukuran terlalu besar";
            header("location:index.php?gagal");
        }
    }

if (isset($_GET['delete'])) {
    $idHero = $_GET['delete'];
    $koneksi->query("DELETE FROM hero WHERE idHero = '$idHero'");
    header("location:index.php");
}

if (isset($_POST['editposting'])) {
    $judul = $_POST['judul'];
    $subjudul = $_POST['subjudul'];
    $status = $_POST['status'];
    $namagambar = $_FILES['gambar']['name'];
    $file_tmp = $_FILES['gambar']['tmp_name'];
    move_uploaded_file($file_tmp, '../assets/img/' . $namagambar);
  
    $koneksi->query("UPDATE hero SET judul='$judul', subjudul='$subjudul', gambar='$namagambar', status='$status' WHERE idHero='$idHero'");
    header("location:index.php");
}
?>