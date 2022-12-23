<?php
//hanya untuk memberikan delay
usleep(500000);
require '../functions.php';

//ambil data keyword dari ajax
$keyword= $_GET["keyword"];

//ambil data nya dari keyword
$query = " SELECT * FROM mahasiswa
                            WHERE
                    nama LIKE '%$keyword%' OR
                    nrp LIKE '%$keyword%' OR
                    email LIKE '%$keyword%' OR
                    jurusan LIKE '%$keyword%'";

//tampilkan datanya
$mahasiswa = query($query);

?>
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
            <?php foreach($mahasiswa as $row): ?>
            <tr>
                <td><?= $i ?></td>
                <td><img src="img/<?= $row["gambar"];?>" width="50"></td>
                <td><?= $row["nrp"];?></td>
                <td><?= $row["nama"];?></td>
                <td><?= $row["email"];?></td>
                <td><?= $row["jurusan"];?></td>
                <td>
                    <center>
                        <a id="edit" href="edit.php?id=<?= $row["id"];?>">Edit</a>
                        <a href="delete.php?id=<?= $row["id"];?>"  
                            onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">Delete</a>
                    </center>
                </td>
            </tr>
            <?php $i++ ;?>
            <?php endforeach; ?>
        </table>