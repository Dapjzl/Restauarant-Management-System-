<?php

    include 'connect/db_conn.php';

?>

<?php

if (isset($_GET['id'])) {
    $id = $_GET['id'];
}

   
    $sql1 = "SELECT prd_image FROM products WHERE id=$id";
    $result1 = mysqli_query($connect, $sql1);
    $rowt=mysqli_fetch_assoc($result1);
        $newName = $rowt['prd_image'];
        $destination = 'assets/images/uploads/' . $newName;


    if ($result1==TRUE) {
       
        if (!unlink($destination)) {
            echo "<script>alert('An error occurred while deleting product'); window.location='view_product'</script>";
        }else {
            $sql = "DELETE FROM products WHERE id='$id'";
            $result = mysqli_query($connect, $sql);
                if ($result==TRUE){
                    echo "<script>alert('Product removed successfully'); window.location='view_product'</script>";
                }else {
                    echo "<script>alert('An error occurred while deleting product'); window.location='view_product'</script>";  
                }
        }

    }else {
        echo "<script>alert('An error occurred while deleting product'); window.location='view_product'</script>";
    }


























    







?>