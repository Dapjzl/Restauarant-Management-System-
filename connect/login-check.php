<?php

if(!isset($_SESSION['user'])){
    $msg = "Login to access admin panel!!!";
    echo "<script>alert('$msg'); window.location='index.php';</script>";
}

?>
