<?php 
require'function.php';
$id = $_GET["id_ikan"];
$percobaan = "Selamat Datang";

if(hapus($id) > 0 ){
    $percobaan = "Data Berhasil Dihapus";
    header("Location:index.php");
}else {
    $percobaan = "Data Gagal Dihapus";
    header("Location:index.php");
}
?>