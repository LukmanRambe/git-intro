<?php
    //connect to database
    $conn = mysqli_connect( "localhost", "admin", "whoami2002", "Latihan");
    //add query data from table "mahasiswa"
    $result = mysqli_query($conn, "SELECT * FROM mahasiswa");
    //checking the table
    if (!$result) {
        echo mysqli_error($conn);
    }
    //add data (fetch) from  object result
    // mysqli_fetch_row()   // mengembalikan array numerik
    // mysqli_fetch_assoc() // mengembalikan array associative
    // mysqli_fetch_array() // mengembalikan keduanya
    // mysqli_fetch_object() //mengambalikan hanya object

    // while ($mhs = mysqli_fetch_assoc($result)) {
    //     var_dump($mhs)
    // }
    

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Admin</title>
    <style>
    table,
    th,
    td {
        border: 1px solid #ddd;
        border-collapse: collapse;
    }

    th,
    td {
        padding: 13px;
    }

    th {
        background-color: #4CAF50;
        color: white;
    }

    a:link,
    a:visited {
        background-color: #f44336;
        color: white;
        padding: 3px 7px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
    }
    a:hover,
    a:active {
        background-color: red;
    }
    #edit {
        background-color: #ffff00 ;
        color: black;
        padding: 3px 7px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
    }

    </style>
</head>

<body>
    <center>
        <h2>Daftar Mahasiswa</h2>

        <form action="search.php" method="get">
            <input type="text" name="keyword" placeholder="Search"/>
            <button type="submit">Search</button>
        </form>
        <br>

        <table>
            <tr>
                <th>No.</th>
                <th>Gambar</th>
                <th>NRP</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Jurusan</th>
                <th>Action</th>
            </tr>

            <?php $i = 1 ;?>
            <?php while( $row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?= $i ?></td>
                <td><img src="img/<?= $row["gambar"];?>" width="50"></td>
                <td><?= $row["nrp"];?></td>
                <td><?= $row["nama"];?></td>
                <td><?= $row["email"];?></td>
                <td><?= $row["jurusan"];?></td>
                <td>
                    <center>
                    <a id="edit" href="">Edit</a>
                    <a href=""
                            onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">Delete</a>
                    </center>
                </td>
            </tr>
            <?php $i++ ;?>
            <?php endwhile; ?>
    </center>
</body>

</html>
