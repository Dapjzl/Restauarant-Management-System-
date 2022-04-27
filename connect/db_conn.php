<?php

session_start();
function dbconnect(){
    try{
        $servername = 'localhost';
        $username = 'root';
        $password = '';

        $con = new pdo("mysql:host=$servername; dbname=restaurant_pos", $username, $password);
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $con;
    }catch(PDOException $e){
        echo 'Error establishing connection'. $e->getMessage();
    }
}

function check_input($name){
    $data =trim($name);
    $data =stripslashes($name);
    $data =htmlspecialchars($name);
    return $data;
}


?>

<?php

$connect = mysqli_connect('localhost','root','','restaurant_pos');

?>
