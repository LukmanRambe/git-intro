<?php
session_start();
require 'functions.php';

//cek cookie
if (isset($_COOKIE['x']) &&  isset($_COOKIE['y'])) {
    $x = $_COOKIE['x'];
    $y = $_COOKIE['y'];

    //ambil username(y) berdasarkan id(x)
    $result = mysqli_query($conn,"SELECT username FROM users WHERE id = $x");
    //ambil
    $row = mysqli_fetch_assoc($result);

    //cek cookie dan username
    if ($y === hash('sha256', $row['username'])) {
        $_SESSION['login'] = true;
    }

}

if (isset($_SESSION["login"])) {
    header("location: index.php");
    exit;
}

if (isset($_POST["login"])) {
    
    $username = $_POST["username"];
    $password = $_POST["password"];

    $result =  mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");

    //cek username
    if (mysqli_num_rows($result) === 1 ) {
        
        //cek password
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row["password"])){
            //set session
            $_SESSION["login"] = true;

            // cek remember me
            if (isset($_POST["remember"])) {
                //buat cookie
                $waktu = 60;
                setcookie('x', $row['id'], time()+60);
                setcookie('y', hash('sha256',$row['username'] ), time()+$waktu);
            }

            header("Location: index.php");
            exit;
        }
    }
    
    $error = true;
     
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Login</title>
    <style>
        body{
            font-family: Arial, Helvetica, sans-serif;
        }
        .label {
            display: block;
        }
        .button {
        background-color: #ff414d ;
        border: none;
        border-radius: 10px;
        color: white;
        padding: 7px 10px;
        text-align: center;
        font-size: 14px;
        text-decoration: none;
        display: inline-block;

        }
        #edit {
        background-color: #0278ae ;
        border-radius: 10px;
        color: white;
        padding: 7px 10px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
    }

    </style>
</head>
<body>
    <center>
    <h1>Silahkan  Login</h1>

    <?php if(isset($error)) :  ?>
        <p style="color:red; font-style: italic;">Username / Password salah</p>
    <?php endif; ?>

        <form action="" method="post">
            <label class="label" for="username"><b>Username : </b></label><br>
            <input type="text" name="username" id="username" autocomplete="off"><br><br>
            
            <label class="label" for="password"><b>Password : </b></label><br>
            <input type="password" name="password" id="password" autocomplete="off"><br><br>

            <input type="checkbox" name="remember" id="remember" autocomplete="off">
            <label for="remember">Remember me</label><br><br><br>
            
            <button class="button" type="submit" name="login">Login</button>
            <br><br>
            <a id="edit" href="registration.php">Sign Up +</a>
        </form>
    </center>
</body>
</html>