<?php
//session
session_start();
$_SESSION = [];
session_unset();
session_destroy();

//cookie
setcookie('x', '', time()-3600);
setcookie('y', '', time()-3600);

header("location: login.php");
exit;
?>