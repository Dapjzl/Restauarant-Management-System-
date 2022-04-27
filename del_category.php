<?php

    include 'connect/db_conn.php';

?>

<?php

if (isset($_GET['id'])) {
    $id = $_GET['id'];
}

    $sql = "DELETE FROM category WHERE id='$id'";
    $result = mysqli_query($connect, $sql);


    if ($result==TRUE) {
        echo "<script>alert('Category deleted successfully'); window.location='view_product'</script>";
    }
    
    else {
        echo "<script>alert('An error occurred while deleting category'); window.location='view_product'</script>";
    }








?>