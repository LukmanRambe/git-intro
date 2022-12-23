<?php

require_once __DIR__ . '/vendor/autoload.php';

require 'functions.php';

$mahasiswa = query("SELECT * FROM mahasiswa");


$mpdf = new \Mpdf\Mpdf();

//print
$html ='<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=m, initial-scale=1.0">
    <title>Daftar Mahasiswa</title>
    <link rel="stylesheet" href="css/style.css" />
</head>
<body>
    <h1>Daftar Mahasiswa</h1>
    <table>
            <tr>
                <th>No.</th>
                <th>Gambar</th>
                <th>NRP</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Jurusan</th>
            </tr>';

        $i = 1;
        foreach ($mahasiswa as $row ) {
            $html .= '<tr>
                    <td>'. $i++ .'</td>
                    <td><img src="img/'. $row["gambar"] .'" width ="50"></td>
                    <td>'. $row["nrp"] .'</td>
                    <td>'. $row["nama"] .'</td>
                    <td>'. $row["email"] .'</td>
                    <td>'. $row["jurusan"] .'</td>
            </tr>';
        }
        
$html .=   '</table> 
</body>
</html>';
$mpdf->WriteHTML($html);
$mpdf->Output('Daftar-Mahasiswa.pdf', \Mpdf\Output\Destination::INLINE);

?>