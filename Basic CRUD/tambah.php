<?php
require'function.php';
    
    $percobaan = "Selamat Datang";
if( isset($_POST["submit"])){
    if( tambah($_POST) > 0){
        $percobaan = "Berhasil Di Upload";
        header("Location:index.php");
    }else {
        $percobaan = "Gagal Di Upload";
        echo mysqli_error($koneksi);
    }

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menambah Mahasiswa</title>
    <link rel="stylesheet" href="tambah3.css">
</head>
<body>
    <div class="con">
        <h1>Menambah Mahasiswa UKSW</h1>
        <p style="color:#d7e1e4 ;"><?php echo $percobaan?></p>
        <br>

        <form action="" method="POST" enctype="multipart/form-data">
        
                <div class="condua">
                <label for="nama_ikan">Nama   : </label>
                <input type="text" name="nama_ikan" id="nama_ikan" required autocomplete="off" placeholder="Nama Ikan">
                <br><br>
                <label for="jenis_ikan">Jenis Ikan : </label>
                <input type="text" name="jenis_ikan" id="jenis_ikan" required autocomplete="off" placeholder="Jenis Ikan">
                <br><br>        
                <label for="harga_ikan">Harga Ikan :</label>
                <input type="text" name="harga_ikan" id="harga_ikan" required autocomplete="off" placeholder="Harga Ikan">
                <br><br>
                <label for="gambar_ikan">Gambar Ikan :</label>
                <input type="file" name="gambar_ikan" id="gambar_ikan" placeholder="Gambar">
                <br><br>
                <button type="submit" name="submit"> Masukan </button>
                </div>
    
        </form>
    </div>
</body>
</html>