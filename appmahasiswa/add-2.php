<?php
//connect to database
$conn = mysqli_connect( "localhost", "admin", "whoami2002", "Latihan");

//cek apakah tombol submit sudah di tekan atau belum
if (isset($_POST["submit"])) {
    // var_dump($_POST);
    //ambi data dari tiap elemen dalam form
    $nama = $_POST["nama"];
    $nrp = $_POST["nrp"];
    $email = $_POST["email"];
    $jurusan = $_POST["jurusan"];
    $gambar = $_POST["gambar"];

    //query insert data
    // id = null (auto increment)
    $query = "INSERT INTO mahasiswa VALUES(null, '$nama', '$nrp', '$email', '$jurusan', '$gambar')"; 
    mysqli_query($conn, $query);

    //cek apakah data berhasil di tambahkan atau tidak
     if (mysqli_affected_rows($conn) > 0) {
         echo "Data berhasil ditambahkan !";
     } else {
         echo "Data gagal ditambahkan";
         echo"<br>";
         echo mysqli_error($conn);
     }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tembah Data Mahasiswa</title>
</head>

<body>
    <center>
        <h2>Tambah Data Mahasiswa</h2>
        <form action="" method="post">
            <label for="nama"><b>Nama </b></label><br>
            <input type="text" name="nama" id="nama"/>
            <br><br>

            <label for="nrp"><b>NRP </b></label><br>
            <input type="text" name="nrp" id="nrp"/>
            <br><br>

            <label for="email"><b>Email </b></label><br>
            <input type="text" name="email" id="email"/>
            <br><br>

            <label for="jurusan"><b>Jurusan </b></label><br>
            <input type="text" name="jurusan" id="jurusan"/>
            <br><br>

            <label for="gambar"><b>Gambar </b></label><br>
            <input type="text" name="gambar" id="gambar"/>
            <br><br>

            <button type="submit" name="submit">Insert Data</button>
        </form>
        <br>
        <button onclick="document.location='index.php'">Back</button>
    </center>
</body>

</html>
