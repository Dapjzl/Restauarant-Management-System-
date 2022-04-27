<?php
ob_start();
ini_set('display_errors', 1);
    include 'header.php';

?>

<?php

// 	if (isset($_POST['add'])) {
		
// 		if(isset($_SESSION['cartigo'])){

// 			$item_array_id = array_column($_SESSION['cartigo'], "product_id");
			
// 			if (in_array($_POST['product_id'], $item_array_id)) {
// 				echo "<script>alert('Item is already in cart'); window.location='all_products.php';</script>";
// 				$product_id = $_POST['product_id'];
// 			}else {
// 				$countess = count($_SESSION['cartigo']);

// 				$item_array = array(
// 					'product_id'=> $_POST['product_id'],
// 					'item_name'=> $_POST['hidden-name'],
// 					'item_price'=> $_POST['hidden-price'],
// 					'item_quantity'=> $_POST['item-qty'],
					
// 				);
// 				$_SESSION['cartigo'][$countess] = $item_array;
// 				print_r($_SESSION['cartigo']);
// 			}

// 		}else {
// 			$item_array = array(
// 				'product_id'=> $_POST['product_id'],
//                 'item_name'=> $_POST['hidden-name'],
//                 'item_price'=> $_POST['hidden-price'],
//                 'item_quantity'=> $_POST['item-qty'],
// 			);

// 			$_SESSION['cartigo'][0] = $item_array;
// 			print_r($_SESSION['cartigo']);
// 		}
// 	}

// 			'product_id' =>$_POST['product_id'],
// 			$catigories = array(
// 			'qty' => 1
// 		)

	

// ?>
 <?php

// 		if (isset($_GET['action'])) {
// 			if ($_GET['action'] == "delete") {
// 				echo "<script>alert('Item has been removed from cart'); window.location='all_products.php';</script>";
// 				foreach ($_SESSION['cartigo'] as $keys => $value) {
// 					if ($value['product_id'] == $_GET['id']) {
// 						unset($_SESSION['cartigo'][$keys]);
// 						echo "<script>alert('Item has been removed from cart'); window.location='all_products.php';</script>";
// 					}
// 				}
// 			}
// 		}
?>





<?php


if(isset($_POST['submit_sales'])){
	$prd = $_POST['prd'];
	$count = count($prd);
	$rand_sales = rand(); 
	$cust_name = check_input($_POST['custname']);
	$cust_num = check_input($_POST['custnumber']);
	$total = $_POST['total'];
	$month = date('M');
	$year = date('Y');

	if($month == "Jan"){
		$mon = 1;
	}elseif($month == "Feb"){
		$mon = 2;
	}elseif($month == "Mar"){
		$mon = 3;
	}elseif($month == "Apr"){
		$mon = 4;
	}elseif($month == "May"){
		$mon = 5;
	}elseif($month == "Jun"){
		$mon = 6;
	}elseif($month == "Jul"){
		$mon = 7;
	}elseif($month == "Aug"){
		$mon = 8;
	}elseif($month == "Sep"){
		$mon = 9;
	}elseif($month == "Oct"){
		$mon = 10;
	}elseif($month == "Nov"){
		$mon = 11;
	}elseif($month == "Dec"){
		$mon = 12;
	}


	
	// Looping all files
	if($count<1){
		// $error = 'Cart is empty';
		echo '<script>alert("Cart is empty !!!");window.location="all_products.php";</script>';
		// echo '<script>window.location="all_products.php";</script>';
		
	}else{
		for($i=0;$i<$count;$i++){
			$products = $_POST['prd'][$i];
			$price = $_POST['price'][$i];
			$vat = (7.5*$price)/100;
			$qty = $_POST['qty'][$i];
			
				  $fl= dbconnect()->prepare("INSERT INTO sales SET cust_name=:custname, cust_number=:custnumber, prd_name=:prd, qty=:qty, price=:price, total=:total, ref_code=:random, month=:month, year=:year");
				  $fl->bindParam(':custname', $cust_name);
				  $fl->bindParam(':custnumber', $cust_num);
				  $fl->bindParam(':prd', $products);
				  $fl->bindParam(':qty', $qty);
				  $fl->bindParam(':price', $price);
				  $fl->bindParam(':total', $total);
				  $fl->bindParam(':month', $mon);
				  $fl->bindParam(':year', $year);
				  $fl->bindParam(':random', $rand_sales);
				  $fl->execute();
		}
		// if($fl){
		// 	echo "<script>alert('doneit');window.location='all_products.php';</script>";
		//   }else {
		// 	echo "<script>alert('dodontadsjkjneit')</script>";
		//   }
		  
	}
}


?>









		<!--start page wrapper -->
		<div class="page-wrapper">
			<div class="page-content">

				<div class="row">
					<div class="col-12">
						<div class="card">
							<div class="card-body">
								<div class="row align-items-center">
									<div class="col-lg-3 col-xl-2">
										<a href="add_product" class="btn btn-primary mb-3 mb-lg-0"><i class='bx bxs-plus-square'></i>New Product</a>
									</div>
									<div class="col-lg-9 col-xl-10">
										<form class="float-lg-end">
											<div class="row row-cols-lg-auto g-2">
											<img id="loader" style="width: 40px; display: none;" src="assets/images/gifs/search-spinner.gif">
												<div class="col-12">
													<div class="position-relative">
														<input type="search" onkeyup="searchfunc()" id="search" name="name" class="form-control ps-5" placeholder="Search Product..."><span class="position-absolute top-50 product-show translate-middle-y"><i id="searchloader" class="bx bx-search"></i></span>
													</div>
												</div>
												<div class="col-12">
													<div class="btn-group" role="group" aria-label="Button group with nested dropdown">
														<button type="button" class="btn btn-white">Sort By</button>
														<div class="btn-group" role="group">
														  <button id="btnGroupDrop1" type="button" class="btn btn-white dropdown-toggle dropdown-toggle-nocaret px-1" data-bs-toggle="dropdown" aria-expanded="false">
															<i class='bx bx-chevron-down'></i>
														  </button>
														  <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
															<li><a class="dropdown-item" href="#">Dropdown link</a></li>
															<li><a class="dropdown-item" href="#">Dropdown link</a></li>
														  </ul>
														</div>
													  </div>
												</div>
												<div class="col-12">
													<div class="btn-group" role="group" aria-label="Button group with nested dropdown">
														<button type="button" class="btn btn-white">Collection Type</button>
														<div class="btn-group" role="group">
														  <button id="btnGroupDrop1" type="button" class="btn btn-white dropdown-toggle dropdown-toggle-nocaret px-1" data-bs-toggle="dropdown" aria-expanded="false">
															<i class='bx bxs-category'></i>
														  </button>
														  <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
															<li><a class="dropdown-item" href="#">Dropdown link</a></li>
															<li><a class="dropdown-item" href="#">Dropdown link</a></li>
														  </ul>
														</div>
													  </div>
												</div>
												<div class="col-12">
													<div class="btn-group" role="group">
														<button type="button" class="btn btn-white">Price Range</button>
														<div class="btn-group" role="group">
														  <button id="btnGroupDrop1" type="button" class="btn btn-white dropdown-toggle dropdown-toggle-nocaret px-1" data-bs-toggle="dropdown" aria-expanded="false">
															<i class='bx bx-slider'></i>
														  </button>
														  <ul class="dropdown-menu dropdown-menu-start" aria-labelledby="btnGroupDrop1">
															<li><a class="dropdown-item" href="#">Dropdown link</a></li>
															<li><a class="dropdown-item" href="#">Dropdown link</a></li>
														  </ul>
														</div>
													  </div>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
            
            
				<div class="row">
                <div class="col-md-7">
					<div class="card_wrap" id="output">
                    <?php
				
				$query = "SELECT * FROM products ORDER BY prd_name";
				$data = mysqli_query($connect,$query);

				while($row = mysqli_fetch_assoc($data)) {
					$id = $row['id'];
				 	$prd_name = $row['prd_name'];
					$quantity = $row['qty'];
					$price = $row['price'];
					$image = $row['prd_image'];
					$supplied = $row['supplier'];
			   
		   
		   		?>
                   
						<div class="card_item cardRounder">
							<div class="card_inner">
								<a href="view_single?id=<?php echo $id; ?>">
                                <div class="backogan">
								<img src="assets/images/uploads/<?php echo $image; ?>" class="card-img-top responimg" alt="">
                                </div>
								</a>
								<div class="cango">
								<!-- <a href="view_single?id=<?php echo $id; ?>"> -->
								<div class="prod_name"><?php echo $prd_name; ?></div>
								<!-- </a> -->
								
                                <div class="clearfix marg3">
									<p class="mb-0 float-start clearfixmath"><?php if ($quantity=='0') {?>
										<strong><?php echo "Out of stock  ";?></strong>
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
                                  <button type="submit" onclick="addtocart(<?php echo $id ?>,'<?php echo $prd_name ?>', <?php echo $price ?>, <?php echo $quantity?>)" id="disableit<?php echo $id; ?>" class="button-62 but_work" role="button"><i class="bx bx-cart"></i><span class="text"> Add To Cart</span></button>
								  <input type="hidden" name="hidden-price" value=<?php echo $price; ?>>
								  <input type="hidden" name="hidden-name" value=<?php echo $prd_name; ?>>
								  <input type="hidden" name="product_id" value=<?php echo $id; ?>>
                                </div>
                                </div>
							</div>
						</div>
                <?php } ?>

                       
					</div>
				</div>
				<div class="col-md-5" style="	margin-top: 19px;">
                <div class="col-12" style="margin-left: -10px;">
				<div class="card">
							<div class="card-body">
							<form action="" method="POST">
								<table class="table mb-0 table-hover table-striped" style="min-height: 100px; width:100%">
								<div class="cust_det">
									<div class="salesnbut d-flex col-md-12" style="justify-content: space-between;">
										<h6 class="mb-0 text-uppercase">
											Sales Book
										</h6>
										<button class="button-1">Add Customer</button>
									</div>
									<hr style="margin-bottom: 2rem;">
									<div class="input-groupers">
										<input class="inputer" type="text" id="cust_hidename" name="custname" value="Customer Esteemed">
										<label id="hidename" for="name"><i class="fas fa-user"></i>Customer Name</label>
									</div>
									<div class="input-groupers">
        								<input class="inputer" type="telephone" id="cust_hidenum" name="custnumber" Value="08073195568">
        								<label id="hidenum" for="number"><i class="fas fa-phone"></i>Phone Number</label>
        							</div>
								</div>
									<thead>
										<tr>
											<th style="font-size: 11px;" width="35%" scope="col">Item Name(s)</th>
											<th style="font-size: 11px;" width="15%" scope="col">Price</th>
											<th style="font-size: 11px;" width="10%" scope="col">Qty</th>
											<th style="font-size: 11px;" width="20%" scope="col">Total</th>
											<th style="font-size: 11px;" width="10%" scope="col">#</th>
										</tr>
									</thead>

									
									<tbody id="cartBody">
										
										
									<div><strong>Price of </strong><input style="margin-bottom: 30px; text-align: center; width:30px; border: none;" value="0" type="text" id="totalItem" readonly> <strong>item(s)</strong></div>
									</tbody>
								</table>
								<div class="flexndspace">
									<div><strong>Sum Total: </strong><input style="margin-top: 50px; border: none;" type="text" id="totalSum" name="total" readonly></div>
									<button type="button" onclick="removeall()" id="removevery" class="button-62" style="margin-top: 50px; width: 100px; min-height: 30px; border: none;">Remove all</button>
								</div>
									<button type="submit" class="button-63" style="margin-top: 50px; width: 100px; min-height: 30px; border: none;" name="submit_sales">Submit</button>
								</form>
							</div>
						</div>
                	</div>			
                </div>
            </div>
           	
		</div><!--end page-content-->
	</div><!--end page wrapper -->

		


<?php

include 'footer.php';

?>

<!-- Search -->
<script>
	const searchfunc = () =>{
			const myInput = document.getElementById('search').value.toUpperCase();
			const rounding = document.getElementById('output');
			const inRound = document.querySelectorAll('.cardRounder');
			const childDiv = document.getElementsByTagName('div');

			if ($("#search").val()) {
			for (let i = 0; i < childDiv.length; i++) {
				let cartNameTag = inRound[i].getElementsByTagName('div')[0];

				if (cartNameTag){
					var cartName = cartNameTag.textContent || cartNameTag.innerHTML;
					if (cartName.toUpperCase().indexOf(myInput) > -1) {
						inRound[i].style.display = "";
					}
					else {
						inRound[i].style.display = "none";
					}
				}
			}
		}
	}
</script>

<script>

	// START ADD-TO-CART
	function addtocart(id, name, price, quantity){

	// DISABLE ADD-TO-CART BUTTON
		$("#disableit"+id).attr("disabled", true);
	// END DISABLE ADD-TO-CART BUTTON

		let qty = $('#num'+id).val();
		let totalPrice = price * qty;
		let cartBody = $('#cartBody');
		// console.log(id +' '+ name +' '+ price +' '+ qty );
		let html = `<tr id="finland${id}" class="finremall">
						<td width="35%" id="prdName"><input name="prd[]" value="${name}" style="width: 100px; font-size: 12px;" readonly></td>
						<td width="15%" id="unitPrice"><input value="${price}" name="price[]" style="width: 40px; font-size: 12px;" readonly></td>
						<td width="10%"><input type="number" min="1" max="${quantity}" class="cartqty" style="font-size: 12px;" name="qty[]" id="cartqty${id}" oninput="multiply(cartqty${id}, ${price}, ${id})" value="${qty}" style="border: none;"></td>
						<td width="20%"><input type="text" class="total cartqty" style="font-size: 12px;" readonly id="totalPrice${id}" value="${totalPrice}"></td>
						<td width="5%"><a class="text-danger" id="remove${id}" style="width="15px" font-size: 12px;" onclick="removefunc(${id}),enablefunc(${id})">
							<i class="bx bx-trash producticon"></i>
								</a>
						</td>
					</tr>`;
					
		cartBody.append(html);

	// START COUNT OF ITEMS IN CART
		let cartCount = $('#totalItem');
		let itml =  $('#cartBody tr').length;
		cartCount.val(itml);
	// END COUNT OF ITEMS IN CART

		getTotal();
	}
	// END ADD-TO-CART
	
	// START REMOVE ALL ITEM AND ENABLE ADD-TO-CART BUTTON AGAIN
	function removeall(){
		let elements = document.querySelectorAll('.finremall');
		elements.forEach(finremall => {
  		finremall.remove();
		});
		getTotal();
		butwork();
		let cartCount = $('#totalItem');
		let itml =  $('#cartBody tr').length;
		cartCount.val(itml);
	}

	function butwork() {
		$(".but_work").attr("disabled", false);
	}
	// END REMOVE ALL ITEM AND ENABLE ADD-TO-CART BUTTON AGAIN

	// START REMOVE INDIVIDUAL ITEM AND ENABLE ADD-TO-CART BUTTON AGAIN
	function removefunc(remid){
		remtr = document.getElementById("finland"+remid);
		remtr.parentNode.removeChild(remtr);
		getTotal ();
		let cartCount = $('#totalItem');
		let itml =  $('#cartBody tr').length;
		cartCount.val(itml);

	}

	function enablefunc(enid) {
		$("#disableit"+enid).attr("disabled", false);
	}
	// END REMOVE INDIVIDUAL ITEM AND ENABLE ADD-TO-CART BUTTON AGAIN

	// START PLUS AND MINUS QUANTITY ON CARD
	function plus(id, quant){
		var num = parseInt(document.getElementById('num'+id).value);
		num += 1;
		let qty = $('#num'+id).val();
		if (num<quant) {
			document.getElementById('num'+id).value=num;
		}
		else{
		document.getElementById('num'+id).value=quant;
		}
	}


	function minus(id){
		var num = parseInt(document.getElementById('num'+id).value);
		num -= 1;
		let qty = $('#num'+id).val();
		if (num>0) {
			
			document.getElementById('num'+id).value=num;
		}
		else{
		document.getElementById('num'+id).value=1;
		}
	}
	// END PLUS AND MINUS QUANTITY ON CARD

	// START GET TOTAL OF ALL CART ITEMS AFTER MULTIPLICATION
	function getTotal (){
		let itml =  $('#cartBody tr').length;
		if (itml<1) {
			$('#totalSum').val(0);
		}else{
		let newprice = 0;
		$('.total').each(function(){
			let price = $(this).val();
			newprice += Number(price);
			$('#totalSum').val(newprice);
		});
		}
	}
	// END GET TOTAL OF ALL CART ITEMS AFTER MULTIPLICATION

	// START MULTIPLICATION OF QUANTITY AND PRICE OF EACH CART ITEM
	function multiply(id, price, prdID){
		let qty = id.value;
		let totalPrice = qty * price
		$('#totalPrice'+prdID).val(totalPrice);
		getTotal();
	}
	// END MULTIPLICATION OF QUANTITY AND PRICE OF EACH CART ITEM


	$('#cartBody').on('.cartqty', 'input', function(){
		console.log(this.id);
	})

</script>



<script>
	$(document).ready(function(){
		$("#hidename").css({"top": "-35px", "color": "blue"});
		$("#cust_hidename").on("blur", function(){
			if (!$("#cust_hidename").val()) {
			$("#hidename").css({"top": "-7px", "color": "red"})
			}
		});
		$("#cust_hidename").on("focus", function(){
			$("#hidename").css({"top": "-35px", "color": "blue"});
		});

		$("#hidenum").css({"top": "-35px", "color": "blue"});
		$("#cust_hidenum").on("blur", function(){
			if (!$("#cust_hidenum").val()) {
			$("#hidenum").css({"top": "-7px", "color": "red"})
			}
		});
		$("#cust_hidenum").on("focus", function(){
			$("#hidenum").css({"top": "-35px", "color": "blue"});
		});
	});
</script>	