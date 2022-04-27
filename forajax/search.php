<?php

include "../connect/db_conn.php";

sleep(0.5);

$search = "SELECT * FROM products WHERE prd_name LIKE '%".$_POST['name']."%'";
$name_search = $_POST['name'];

$resulting = mysqli_query($connect, $search);
if(mysqli_num_rows($resulting)>0){
				while($row = mysqli_fetch_assoc($resulting)) {
					$id = $row['id'];
				 	$prd_name = $row['prd_name'];
					$quantity = $row['qty'];
					$price = $row['price'];
					$image = $row['prd_image'];
					$supplied = $row['supplier'];
			   
		   
		   		?>
                   
				   <div class="card_item">
							<div class="card_inner">
                                <div class="backogan">
								<img src="assets/images/uploads/<?php echo $image; ?>" class="card-img-top responimg" alt="">
                                </div>
								<div class="cango">
								<div class="prod_name"><?php echo $prd_name; ?></div>
								
                                <div class="clearfix marg3">
									<p class="mb-0 float-start clearfixmath"><?php if ($quantity=='0') {?>
										<strong><?php echo "Out of stock";?></strong> 

									<?php }else {
										echo "<span class='color1like clearfixmath undopad' style='margin-top: 5px;'>Qty </span><strong>$quantity</strong>";
									} ?>
									</p>
									<p class="mb-0 float-end fw-bold clearfixmath toohot"><span><b>N </b><?php echo $price; ?></span></p>
								</div>
									<div class="no-css">
									<button type="button" onclick="minus(<?php echo $id; ?>)" class="rounded-circle d-inline-flex bordercol increment-btn setbutton"><small><i style="font-size: 8px;" class="bx bx-minus mx-auto"></i></small></button>
                                    <input type="text" name="item-qty" id="num<?php echo $id; ?>" class="form-control d-inline-flex counter" value="1" max="<?php echo $quantity; ?>" readonly>
                                    <button type="button" onclick="plus(<?php echo $id; ?>, <?php echo $quantity; ?>)" id="increase<?php echo $id; ?>" class="rounded-circle d-inline-flex bordercol setbutton "><small><i style="font-size: 8px;" class="bx bx-plus mx-auto"></i></small></button>
									</div>
								<div class="flexndjus">
                                  <button type="submit" onclick="addtocart(<?php echo $id ?>,'<?php echo $prd_name ?>', <?php echo $price ?>)" id="disableit<?php echo $id; ?>" class="button-62" role="button"><i class="bx bx-cart"></i><span class="text">add to cart</span></button>
								  <input type="hidden" name="hidden-price" value=<?php echo $price; ?>>
								  <input type="hidden" name="hidden-name" value=<?php echo $prd_name; ?>>
								  <input type="hidden" name="product_id" value=<?php echo $id; ?>>
                                </div>
                                </div>
							</div>
						</div>
                <?php } ?>


<?php }else {?>
		<div class="card_wrappernew" style="margin-top: 150px;">
			No result found for "<?php echo $name_search; ?>"
		</div>
<?php } ?>






<script>
	

</script>













