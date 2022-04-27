<?php
include '../connect/db_conn.php';

$product_names = $_GET['product_name'];


$selector1 = "SELECT price FROM products WHERE prd_name='$product_names'";
$reselector1 = mysqli_query($connect, $selector1);
$broadcom = mysqli_fetch_assoc($reselector1);
$prd_price = $broadcom['price'];

?>


<label for="validationCustomUsername" class="form-label">Price:</label>
<div class="input-group has-validation"> <span class="input-group-text" id="inputGroupPrepend">$</span>
    <input type="number" oninput="calculation()" class="form-control" value="<?php echo $prd_price; ?>" id="first" aria-describedby="inputGroupPrepend" readonly>
</div>