<?php
//cek session
session_start();
if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}
//add file functions.php
require 'functions.php';

//pagination 
//konfigurasi page
$resultDataPage = 5;

//jumlah halaman yang ditampilkan
//ambil semua data
$resultData = count(query("SELECT * FROM mahasiswa"));
//bulatkan ke atas(ceil();)
$resultPage = ceil($resultData / $resultDataPage);
//cek halaman aktif (ternary operator)
$activePage = (isset($_GET["page"])) ? $_GET["page"] : 1;
//urut per halaman   
$firstData = ($resultDataPage * $activePage) - $resultDataPage;

//add data from query
$mahasiswa = query("SELECT * FROM mahasiswa LIMIT $firstData, $resultDataPage");

//tombol cari ditekan
if (isset($_POST["search"])) {
    $mahasiswa = search($_POST["keyword"]);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Admin</title>
    <link rel="stylesheet" href="css/style.css" />
    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="js/script.js"></script>
</head>

<body>
    <center>
        <h2>Daftar Mahasiswa</h2>

        <form action="" method="post" class="form-cari">
            <input type="text" name="keyword" size="30" autofocus autocomplete="off" placeholder="Search" id="keyword" />
            <button class="button button2" type="submit" name="search" id="tombol-cari">Search</button>
            <img src="img/loader.gif" class="loader">
        </form>
        <br>
        <button class="button button2" onclick="document.location='add.php'">Add Data</button>
        <a id="edit2" href="print.php" target="_blank">Print</a>
        <br><br>
        <button class="button" onclick="document.location='logout.php'">Logout</button>
        <br>
        <br>
        <div id="container">
            <table>
                <tr>
                    <th>No.</th>
                    <th>Gambar</th>
                    <th>NRP</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Jurusan</th>
                    <th class="action">Action</th>
                </tr>

                <?php $i = 1; ?>
                <?php foreach ($mahasiswa as $row) : ?>
                    <tr>
                        <td><?= $i ?></td>
                        <td><img src="img/<?= $row["gambar"]; ?>" width="50"></td>
                        <td><?= $row["nrp"]; ?></td>
                        <td><?= $row["nama"]; ?></td>
                        <td><?= $row["email"]; ?></td>
                        <td><?= $row["jurusan"]; ?></td>
                        <td class="action">
                            <center>
                                <a id="edit" href="edit.php?id=<?= $row["id"]; ?>">Edit</a>
                                <a href="delete.php?id=<?= $row["id"]; ?>" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">Delete</a>
                            </center>
                        </td>
                    </tr>
                    <?php $i++; ?>
                <?php endforeach; ?>
            </table>
        </div>
        <br>
        <!-- navigasi -->
        <?php if ($activePage > 1) : ?>
            <a href="?page=<?= $activePage - 1; ?>">&laquo;</a>
        <?php endif; ?>
        <?php for ($i = 1; $i <= $resultPage; $i++) : ?>
            <?php if ($i == $activePage) : ?>
                <a href="?page=<?= $i ?>" style="background-color: #008CBA;"><?= $i; ?></a>
            <?php else : ?>
                <a href="?page=<?= $i ?>"><?= $i; ?></a>
            <?php endif; ?>
        <?php endfor; ?>
        <?php if ($activePage < $resultPage) : ?>
            <a href="?page=<?= $activePage + 1; ?>">&raquo;</a>
        <?php endif; ?>
    </center>
</body>

</html>