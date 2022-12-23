<?php
//cek session
session_start();
if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}
require 'functions.php';

//ambil data di url
$id = $_GET["id"];

//query data mahasiswa berdasarkan id
//[0](indeks-array) karena array id berupa numerik
$mhs = query("SELECT * FROM mahasiswa WHERE id = $id")[0];

//cek apakah tombol submit sudah di tekan atau belum
if (isset($_POST["submit"])) {

    //cek apakah data berhasil di ubah atau tidak
     if (edit($_POST) > 0) {
            echo "
                    <script>
                        alert('Data berhasil diubah !');
                        document.location.href = 'index.php';
                    </script>
            ";
     } else {
        echo "
            <script>
                alert('Data gagal diubah !');
                document.location.href = 'index.php';
            </script>
";
     }
}

?> 
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Mahasiswa</title>
    <link rel="stylesheet" href="css/style.css" />
</head>

<body>
    <center>
        <h2>Edit Data Mahasiswa</h2>
        <form action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $mhs["id"];?>">
            <input type="hidden" name="gambarLama" value="<?= $mhs["gambar"];?>">

            <label for="nama"><b>Nama </b></label><br>
            <input type="text" name="nama" id="nama" required value="<?= $mhs["nama"];?> "/>
            <br><br>

            <label for="nrp"><b>NRP </b></label><br>
            <input type="text" name="nrp" id="nrp" required value="<?= $mhs["nrp"];?> " />
            <br><br>

            <label for="email"><b>Email </b></label><br>
            <input type="text" name="email" id="email" required value="<?= $mhs["email"];?> "/>
            <br><br>

            <label for="jurusan"><b>Jurusan </b></label><br>
            <input type="text" name="jurusan" id="jurusan" required value="<?= $mhs["jurusan"];?> "/>
            <br><br>

            <label for="gambar"><b>Gambar </b></label><br>
            <img src="img/<?=$mhs['gambar'];?>" width="50"><br>
            <input type="file" name="gambar" id="gambar" />
            <br><br>

            <button class="button button2" type="submit" name="submit">Edit Data</button>
        </form>
        <br>
        <button class="button" onclick="document.location='index.php'">Back</button>
    </center>
</body>

</html>
