<?php 
//koneksi database 
//Dapat digunakan semua function yang menggunakan variable scope global
$koneksi = mysqli_connect("localhost","root", "", "tugas3");


//SELECT
function query($query1) {
    //Koneksi database dari variable global
    global $koneksi;
    //Inputan Query yang digunakan
    $result = mysqli_query($koneksi, $query1);
    //Tempat baru yang akan dimasukan data
    $rows = [];
    //Memasukan data ke da lam tempat baru dimana tempat lama akan digunakan untuk data inputan baru
    while ( $row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;

    }
    //Mengembalikan data yang sudah di masukan (Melihat/Select)
    return $rows;
}

//INSERT

function tambah($data){
    //Koneksi Global
    global $koneksi;
    
    //Menambahakan data mahasiswa
    $nama = htmlspecialchars($data["nama_ikan"]);
    $jenis = htmlspecialchars($data["jenis_ikan"]);
    $harga = htmlspecialchars($data["harga_ikan"]);
    
    //Menambahakann data gambar    
    $gambar = upload();
    //Mengupload gambar
    if( !$gambar){
        //Jika data belum ada
        return false;
    }

    $query = "INSERT INTO tb_ikan VALUES ('','$nama','$jenis','$harga','$gambar')";

    mysqli_query($koneksi,$query);
    
    //Mengecek Koneksi Berhasil Atau Tidak
    return mysqli_affected_rows($koneksi);
}

function hapus($id){
    global $koneksi;
    $query = "DELETE FROM tb_ikan WHERE id_ikan = $id";
    mysqli_query($koneksi,$query);
}

function ubah($data){
    global $koneksi;

    $id = $data["id_ikan"];
    $nama = htmlspecialchars($data["nama_ikan"]);
    $jenis = htmlspecialchars($data["jenis_ikan"]);
    $harga = htmlspecialchars($data["harga_ikan"]);
    
    $gambarLama = htmlspecialchars($data["gambarLama_mhs"]);
    
    if($_FILES['gambar_ikan']['error'] === 4) {
        $gambar = $gambarLama;
    }else {
        $gambar = upload();
    }



    $query = "UPDATE tb_ikan SET 
    nama_ikan = '$nama',
    jenis_ikan = '$jenis',
    harga_ikan = '$harga',
    gambar_ikan = '$gambar'
    WHERE id_ikan = $id";

    mysqli_query($koneksi,$query);

    return mysqli_affected_rows($koneksi);
}

function cari($kataKunci){
    global $koneksi;

    $query = "SELECT * FROM tb_ikan WHERE nama_ikan LIKE '%$kataKunci%' OR jenis_ikan LIKE '%$kataKunci%' OR harga_ikan LIKE '%$kataKunci%'";

    return query($query);
}


//Mengupload Gambar
function upload(){
    //Pengiriman File
    $namaFile = $_FILES['gambar_ikan']['name'];
    $ukuranFile = $_FILES['gambar_ikan']['size'];
    $errorFile = $_FILES['gambar_ikan']['error'];
    $tempatFile = $_FILES['gambar_ikan']['tmp_name'];
    $tipeFile = $_FILES['gambar_ikan']['type'];

    //Pengecekan user apakah sudah mengupload gambar
    if( $errorFile === 4){
        echo '<script> 
            alert("Anda Belum memasukan gambar");
        </script>';
        return false;
    }
    
    
    //Pengecekan Jenis File

    //Jenis" File yang dapat di masukan 
    $jenisFile = ['jpg','jpeg','png','bmp','tif','tiif','svg','image'];
    //Mengecek Jenis File dengan memecah ekstensi dan nama file
    $PemecahanFile = explode('.',$namaFile);
    //Membuat nama ekstensi file tetap menggunakan huruf kecil
    $PemecahanFile = strtolower(end($PemecahanFile));

    // Mengecek ekstensi file
    if( !in_array($PemecahanFile, $jenisFile)){
        echo '<script> alert("File yang anda upload bukan gambar"); </script>';
        return false;
    }

    //Pengecekan Ukuran File

    //File maksimal 10Mb
    if( $ukuranFile > 10000000000 ){
        echo '<script> 
            alert("Ukuran File terlalu besar");
        </script>';
        return false;     
    }

    else{
    //Memberikan nama file unik agar file gambar yang sama tidak tertimpa
    $nameBackup = uniqid();
    $nameBackup .= '.';
    $nameBackup .= $PemecahanFile;
    
    //Memasukan data ke file tertentu ( tidak ke database )
    move_uploaded_file($tempatFile,'img/'. $nameBackup);

    //Mengembalikan nama file yang sudah melalui 3 tahap seleksi
    //Memasukan nama ke dalam dalam database
    return $nameBackup;
    };

    
}

?>



