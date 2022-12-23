<?php
require 'functions.php';

if (isset($_POST["register"])) {

        if (register($_POST) > 0) {
            echo" <script>
                            alert('Selamat kamu berhasil daftar, Silahkan login');
                            document.location.href = 'login.php';
                        </script>";
        }else {
            echo mysqli_error($conn);
        }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Registrasi</title>
    <link rel="stylesheet" href="css/style.css" />
    <style>
        label {
            display: block;
        }
    </style>
</head>
<body>
    <center>
    <h1>Halaman Registrasi</h1>
        <form action="" method="post">
            <label for="username"><b>Username : </b></label><br>
            <input type="text" name="username" id="username" autocomplete="off" required><br><br>
            
            <label for="password"><b>Password : </b></label><br>
            <input type="password" name="password" id="password" autocomplete="off" required><br><br>
                
            <label for="password2"><b>Konfirmasi Password : </b></label><br>
            <input type="password" name="password2" id="password2" autocomplete="off" required><br><br><br>
            
            <button class="button button2" type="submit" name="register">Register!</button>
            <a class="button" href="login.php">back</a>
        </form>
    </center>
</body>
</html>