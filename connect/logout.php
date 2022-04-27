<?php

    include 'db_conn.php';

?>


<?php

    session_unset();
    session_destroy();
    unset($_SESSION['last_active_time']);

    if (isset($_GET['username'])) {
        $username = $_GET['username'];
    }

    $query = dbconnect()->prepare("UPDATE register SET status='0' WHERE username=?");
	$query->execute([$username]);

    $msg = "Logout Successful!!!";
    echo "<script>alert('$msg'); window.location='../index.php';</script>";



?>