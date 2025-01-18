<?php
require'function.php';
    
    $percobaan = "Selamat Datang";
if( isset($_POST["submit"])){
    if( ubah($_POST) > 0){
        $percobaan = "Berhasil Di Ubah";
        header("Location:index.php");
    }else {
        $percobaan = "Gagal Di Ubah";
        echo mysqli_error($koneksi);
    }

}

?>

<!DOCTYPE html>
<?php 
$id = $_GET["id_ikan"];

$ikn = query("SELECT * FROM tb_ikan WHERE id_ikan = $id")[0];

?>


<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Data Mahasiswa</title>
    <link rel="stylesheet" href="ubah3.css">
</head>
<body>
    <div class="con">
    <h1>Ubah Data Mahasiswa UKSW</h1>

    <p><?php echo $percobaan?></p>
    <form action="" method="POST" enctype="multipart/form-data">

            <div class="condua">
        
            <input type="hidden" name="id_ikan" value="<?php echo $ikn["id_ikan"]?>">
            <input type="hidden" name="gambarLama_mhs" value="<?php echo $ikn["gambar_ikan"]?>">
            <br>
                <label for="nama_ikan">Nama : </label>
                <input type="text" name="nama_ikan" id="nama_ikan" required value="<?php echo $ikn["nama_ikan"]?>">            
            <br><br>
                <label for="jenis_ikan">Jenis Ikan : </label>
                <input type="text" name="jenis_ikan" id="jenis_ikan" required value="<?php echo $ikn["jenis_ikan"]?>">
            <br><br>
                <label for="harga_ikan">Harga Ikan :</label>
                <input type="text" name="harga_ikan" id="harga_ikan" required value="<?php echo $ikn["harga_ikan"]?>">
            <br><br>    
                <img style="width: 50px;" src="<?php echo $ikn["gambar_ikan"] ?>" alt="<?php echo $ikn['nama_ikan']?>"><br>
            <label for="gambar_ikan">Gambar :</label>
                <input style="width: 50px;" type="file" name="gambar_ikan" id="gambar_ikan" required>
            <br><br>
                <button type="submit" name="submit"> Update </button>
                </div>
        </form>
    </div>
</body>
</html>