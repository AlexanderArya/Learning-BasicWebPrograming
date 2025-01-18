<?php
//connetion from database
require 'function.php';
$ikan = query("SELECT * FROM tb_ikan");

//Pencarian 

if( isset($_POST["pencarian"])){
    $ikan = cari($_POST["kataKunci"]);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Admin</title>
    <link rel="stylesheet" href="tugas3.css">
</head> 
<body>
    <center>

    <div class="con">
    <h1>Toko Ikan Razzor</h1>
    
    <br>
    
    <form action="" method="post">
        <input type="text" placeholder="Search" name="kataKunci" autofocus autocomplete="off" >
        <button type="submit" name="pencarian"> Search </button>    
        
    </form>
    
    <br>
    <table border="0" cellpadding="10" cellspacing="0" class="tab"> 
        <tr>
            <th>No.</th>
            <th>Nama Ikan</th>
            <th>Jenis Ikan</th>
            <th>Harga Ikan</th>
            <th>Gambar</th>
            <th>Aksi</th>
        </tr>
        <?php $i = 1; ?>
        <?php foreach ($ikan as $ikn ) :?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $ikn["nama_ikan"];?></td>
                <td><?php echo $ikn["jenis_ikan"];?></td>
                <td><?php echo $ikn["harga_ikan"];?></td>
                <td><img style="height: 50px; width: 50x;border-radius: 10%;" src="img/<?php echo $ikn["gambar_ikan"]?>" alt="<?= $ikn["nama_ikan"];?>"></td>
                <td> 
                    <a href="ubah.php?id_ikan=<?php echo $ikn["id_ikan"]?>"><div class="link">ubah</div></a> 
                    <a href="hapus.php?id_ikan=<?php echo $ikn["id_ikan"];?>" onclick="return confirm('Yakin anda akan menghapus data ini?');"><div class="link">hapus</div></a>
                </td> 
            </tr>
            <?php $i++; ?>
            <?php endforeach; ?>
            
        </table>
        <br>
        <a href="tambah.php"><div class="linkdua"> Tambah Ikan </div> </a>
    </div>
</center>
</body>
</html>