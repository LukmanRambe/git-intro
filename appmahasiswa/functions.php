<?php 

 //connect to database
 $conn = mysqli_connect( "localhost", "lukman", "", "Latihan");

 //function query
 function query($query)
 {
     //add variable global
     global $conn;
     //add query data from table
    $result = mysqli_query($conn, $query);
    //create variable (penampung)
    $rows = []; 

    //looping query
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    //return variable (penampung)
    return $rows;
 }


 //for add data
 function add($data){
        //add variable global
        global $conn;

        //add data from , add page
        // htmlspecialchars() for security inject via html
        $nama = htmlspecialchars( $data["nama"]);
        $nrp = htmlspecialchars($data["nrp"]);
        $email = htmlspecialchars($data["email"]);
        $jurusan = htmlspecialchars($data["jurusan"]);

        //upload gambar
        $gambar = upload();
        if (!$gambar) {
            return false;
        }

        //query insert data
        // id = null (auto increment)
        $query = "INSERT INTO mahasiswa VALUES(null, '$nama', '$nrp', '$email', '$jurusan', '$gambar')"; 
        mysqli_query($conn, $query);

        //mengembalikan data berhasil atau tidak
        return mysqli_affected_rows($conn);
 }

 //for upload data
 function upload(){
    //add data from $_FILES
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    //ERORR INPUT
    //cek apakah tidak ada gambar yang di upload
    if ($error === 4){
         echo "<script>
                    alert('Pilih gambar terlebih dahulu!');
                    </script>";
        return false;
    }

    //ERROR FILES
    //cek apakah yang di upload adalah gambar
    $ekstensionValidImage = ['jpg','jpeg','png'];

    //ambil ekstensi file dari gambar yang di upload
    $ekstensionImage = explode('.', $namaFile);

     //ambil dari array yang paling akhir 
     $ekstensionImage = strtolower(end($ekstensionImage));

     //cek apakah ektensi gambar tersedia
     if (!in_array($ekstensionImage, $ekstensionValidImage)) {
        echo "<script>
                        alert('Maaf yang anda upload bukan gambar!');
                    </script>";
            return false;
     }

     //ERROR CAPACITY
     //cek jika ukurannya terlalu besar
     if ($ukuranFile > 1000000) {
        echo "<script>
                        alert('Maaf ukuran gambar terlalu besar!');
                    </script>";
        return false;
     }

     //lolos pengecekan, upload gambar
     //generate nama gambar baru
     $namaFileBaru = uniqid();
     $namaFileBaru .= '.';
     $namaFileBaru .= $ekstensionImage;

     move_uploaded_file($tmpName, 'img/'.$namaFileBaru);

     return $namaFileBaru;

}

//for edit data
function edit($data){
    //add variable global
    global $conn;

    //add data from , add page
    // htmlspecialchars() for security inject via html
    $id = $data["id"];
    $nama = htmlspecialchars( $data["nama"]);
    $nrp = htmlspecialchars($data["nrp"]);
    $email = htmlspecialchars($data["email"]);
    $jurusan = htmlspecialchars($data["jurusan"]);
    $gambarLama = htmlspecialchars($data["gambarLama"]);

    //cek apakah user pilih gambar baru atau tidak
    if ($_FILES['gambar']['error'] === 4) {
        $gambar = $gambarLama;
    } else {
        $gambar = upload();
    }
    
    //query insert data
    // id = null (auto increment)
    $query = "UPDATE mahasiswa SET nama = '$nama', nrp = '$nrp', email = '$email', jurusan = '$jurusan', gambar = '$gambar' WHERE id = $id"; 

    mysqli_query($conn, $query);

    //mengembalikan data berhasil atau tidak
    return mysqli_affected_rows($conn);
}

//for delete data
function delete($id)
{
    //add variable global
    global $conn;

    //query delete
    $query = "DELETE FROM mahasiswa WHERE id =$id";
   mysqli_query($conn, $query);

   return mysqli_affected_rows($conn);
}

 //for search data
 function search($keyword){
        $query = " SELECT * FROM mahasiswa
                                    WHERE
                            nama LIKE '%$keyword%' OR
                            nrp LIKE '%$keyword%' OR
                            email LIKE '%$keyword%' OR
                            jurusan LIKE '%$keyword%'
                            ";

        return query($query);
 }

//registrasi
function register($data){
    global $conn;

    $username = strtolower( stripslashes( $data["username"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);

    //cek username sudah ada atau belum
    $result = mysqli_query($conn, "SELECT username FROM users WHERE username = '$username'");

    if (mysqli_fetch_assoc($result)) {
        echo"<script>
                        alert('Username sudah tersedia !')
                    </script>";
        return false;
    }
    
    //cek konfirmasi password
    if($password !== $password2) {
        echo"<script>
                        alert('Konfirmasi password tidak sesuai !')
                    </script>";
         return false;   
    }

    //enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // tambahkan userbaru ke database
    mysqli_query($conn, "INSERT INTO users VALUES(null, '$username', '$password')");

    return mysqli_affected_rows($conn);
}
