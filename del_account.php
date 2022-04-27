<?php

    include 'connect/db_conn.php';

?>

<?php

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    
    $sql = "DELETE FROM register WHERE id='$id'";
    $result = mysqli_query($connect, $sql);


    if ($result==TRUE) {
        echo "<script>alert('Account removed successfully'); window.location='accounts'</script>";
    }
    
    else {
        echo "<script>alert('An error occurred while deleting account!!!'); window.location='accounts'</script>";
    }

}






?>