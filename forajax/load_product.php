<?php
include '../connect/db_conn.php';

$sup_names = $_GET['sup_name'];

?>
<label for="validationCustom04" class="form-label">Item Name:</label>
<select class="form-select" id="product_name" onchange="bring_qty(this.value)" oninput="bring_price(this.value)" name="pur_name">
<option value=""> - select -</option>
<?php
$slect = "SELECT * FROM products WHERE supplier='$sup_names'";
$reselect = mysqli_query($connect, $slect);
    while ($release=mysqli_fetch_assoc($reselect)) 
    {
        echo "<option>";
        echo $release['prd_name'];
        echo "</option>";


    } 
    echo "</select>";
?>
        
  