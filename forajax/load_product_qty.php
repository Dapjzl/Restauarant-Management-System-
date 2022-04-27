<?php
include '../connect/db_conn.php';

$product_names = $_GET['product_name'];


$selector = "SELECT qty FROM products WHERE prd_name='$product_names'";
$reselector = mysqli_query($connect, $selector);
$broad = mysqli_fetch_assoc($reselector);
$prd_quant = $broad['qty'];

?>
<label for="validationCustom04" class="form-label">In-stock:</label>
<input type="text" class="form-control" value="<?php echo $prd_quant; ?>" readonly>


