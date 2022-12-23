<?php
//cek session
session_start();
if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}
require 'functions.php';

//cek apakah tombol submit sudah di tekan atau belum
if (isset($_POST["submit"])) {

    //cek apakah data berhasil di tambahkan atau tidak
     if (add($_POST) > 0) {
            echo "
                    <script>
                        alert('Data berhasil ditambahkan !');
                        document.location.href = 'index.php';
                    </script>
            ";
     } else {
        echo "
            <script>
                alert('Data gagal ditambahkan !');
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
    <title>Tembah Data Mahasiswa</title>
    <link rel="stylesheet" href="css/style.css" />
</head>

<body>
    <center>
        <h2>Tambah Data Mahasiswa</h2>
        <form action="" method="post" enctype="multipart/form-data">
            <label for="nama"><b>Nama </b></label><br>
            <input type="text" name="nama" id="nama" autocomplete="off" required/>
            <br><br>

            <label for="nrp"><b>NRP </b></label><br>
            <input type="text" name="nrp" id="nrp" autocomplete="off" required/>
            <br><br>

            <label for="email"><b>Email </b></label><br>
            <input type="text" name="email" id="email" autocomplete="off" required/>
            <br><br>

            <label for="jurusan"><b>Jurusan </b></label><br>
            <input type="text" name="jurusan" id="jurusan" autocomplete="off" required/>
            <br><br><br>

             <label for="gambar"><b>Gambar </b></label><br>
            <input type="file" name="gambar" id="gambar"/>
            <br><br><br>

            <button class="button button2" type="submit" name="submit">Insert Data</button>
        </form>
        <br>
        <button class="button" onclick="document.location='index.php'">Back</button>
    </center>
</body>

</html>
