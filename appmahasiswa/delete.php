<?php
//cek session
session_start();
if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}
//connection to functions
require 'functions.php';

//add data id 
$id = $_GET["id"];

if (delete($id) > 0) {
    echo "
                    <script>
                        alert('Data berhasil dihapus!');
                        document.location.href = 'index.php';
                    </script>
            ";
} else {
    echo "
                    <script>
                        alert('Data gagal dihapus !');
                        document.location.href = 'index.php';
                    </script>
            ";
}

?>