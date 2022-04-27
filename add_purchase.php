<?php include 'header.php'; ?>


<?php


	if (isset($_POST['submit'])) {


		$purName = check_input($_POST['pur_name']);
		$supplier = check_input($_POST['sup']);
		$price = check_input($_POST['price']);
		$quantity = check_input($_POST['qty']);
		$tax = check_input($_POST['tax']);
		$duePrice = check_input($_POST['due']);
		$refCode = check_input($_POST['refcode']);
		$created = date('Y-m-d');
		$query = "SELECT * from tax WHERE percent='$tax'";
		$result = mysqli_query($connect, $query);
		
		$row = mysqli_fetch_assoc($result);
			$tax_name = $row['tax_name'];
			$taxInfo = $tax_name . " " . $tax."%";
		
												
												
												

		if (empty($purName) || empty($supplier)|| empty($tax)) {
			echo "<script>alert('You have not completed all required fields!!!')</script>";
		}else{
			
				$reg = dbconnect()->prepare("INSERT INTO purchase SET item=?, supplier=?, price=?, qty=?, tax=?, amount_due=?, ref_code=?, creator=?, created=?");
				if($reg->execute([$purName,$supplier,$price,$quantity,$taxInfo,$duePrice,$refCode,$fullname,$created])){
				
				echo "<script> alert('Success, record inserted!!!');</script>";
				$sqlfetch = "SELECT qty FROM products WHERE prd_name='$purName' AND supplier='$supplier'";
				$resfetch = mysqli_query($connect, $sqlfetch);

				$cockrel = mysqli_fetch_assoc($resfetch);
				$prd_quantfetch = $cockrel['qty'];

				$new_qty = $prd_quantfetch + $quantity;
				$sqlupdate = "UPDATE products SET qty='$new_qty' WHERE prd_name='$purName' AND supplier='$supplier'";
				$resupdate = mysqli_query($connect, $sqlupdate);
				}
				else{
				echo "<script> alert ('Oops, Operation Failed TRY AGAIN LATER!!!');</script>";
				}
			}
		}







?>



		<!--start page wrapper -->
		<div class="page-wrapper">
			<div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Products</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Add Purchase</li>
							</ol>
						</nav>
					</div>
					<div class="ms-auto">
						<div class="btn-group">
							<button type="button" class="btn btn-primary">Settings</button>
							<button type="button" class="btn btn-primary split-bg-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown">	<span class="visually-hidden">Toggle Dropdown</span>
							</button>
							<div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end">	<a class="dropdown-item" href="javascript:;">Action</a>
								<a class="dropdown-item" href="javascript:;">Another action</a>
								<a class="dropdown-item" href="javascript:;">Something else here</a>
								<div class="dropdown-divider"></div><a class="dropdown-item" href="javascript:;">Separated link</a>
							</div>
						</div>
					</div>
				</div>
				<!--end breadcrumb-->
				<div class="row">
					<div class="col-xl-9 mx-auto">
						<h6 class="mb-0 text-uppercase">Create New Purchase</h6>
						<hr/>
						<div class="card">
							<div class="card-body">
								<div class="p-4 border rounded">
									<form class="row g-3 needs-validation" method="POST" enctype="multipart/form-data" novalidate>

										<div class="col-md-12">
											<label for="validationCustom04" class="form-label">Supplier:</label>
											<select class="form-select" id="sup_name" name="sup" onchange="select_company(this.value)">
												<option value="">....</option>
												<?php
												$query5 = "SELECT * from register WHERE role_id='4'";
												$result = mysqli_query($connect, $query5);
												
												while ($row2 = mysqli_fetch_assoc($result)) {
													// $id = $row2['role_id'];
													$supplier = $row2['full_name'];
												
												?>
													<option value="<?php echo $supplier; ?>"><?php echo $supplier; ?></option>
												
												<?php } ?>
											
											</select>
										</div>

										<div class="col-md-4" id="product_name">
											
										</div>

										<div class="col-md-4" id="qtybringer">
											
										</div>
										
										<div class="col-md-4" id="pricebringer">
											<!-- <label for="validationCustomUsername" class="form-label">Price:</label>
											<div class="input-group has-validation"> <span class="input-group-text" id="inputGroupPrepend">$</span>
												<input type="number" oninput="calculation()" class="form-control" id="first" aria-describedby="inputGroupPrepend" placeholder="Enter item price..."name="price">
											</div> -->
										</div>

                                        <div class="col-md-6">
											<label for="validationCustomUsername" class="form-label">Quantity:</label>
												<input type="number" oninput="calculation()" class="form-control" id="second" aria-describedby="inputGroupPrepend" placeholder="Enter item price..."name="qty">
										</div>

                                        <div class="col-md-6">
											<label for="percent" class="form-label">Tax:</label>
											<select class="form-select" oninput="calculation()" id="percent" name="tax">
												<option value="">....</option>
												<?php
												$query = "SELECT * from tax";
												$result = mysqli_query($connect, $query);
												
												while ($row = mysqli_fetch_assoc($result)) {
													$percent = $row['percent'];
													$tax_name = $row['tax_name'];
												
												?>
													<option value="<?php echo $percent; ?>"><?php echo $tax_name; ?></option>
												
												<?php } ?>
											</select>
										</div>

										<div class="col-md-6">
											<label for="validationCustomUsername" class="form-label">Amount Due:</label>
												<input type="text" oninput="calculation()" readonly class="form-control" id="total" aria-describedby="inputGroupPrepend" placeholder="Amount to be paid...."name="due">
										</div>
                                        
                                        <div class="col-md-6">
											<label for="inputAddress" class="form-label">Refrence Code:</label>
											<input class="form-control" readonly id="inputAddress" value="<?php $ran=mt_rand(); $rands = "Codor".$ran."ref";  echo $rands;  ?>" name="refcode">
										</div>

                                        <div class="col-12">
											<button class="btn btn-primary" type="submit" name="submit">Update</button>
										</div>
										</div>
										

					
											

										
									</form>
								</div>
							</div>
						</div>



	

<?php

    include 'footer.php';

?>
<script>
	function select_company(sup_name) {
		var xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function () {
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
					document.getElementById("product_name").innerHTML=xmlhttp.responseText;
				}
			};
			xmlhttp.open("GET", "forajax/load_product?sup_name="+sup_name, true);
			xmlhttp.send();
	}
</script>

<script>
	function bring_qty(product_name) {
		var xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function () {
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
					document.getElementById("qtybringer").innerHTML=xmlhttp.responseText;
				}
			};
			xmlhttp.open("GET", "forajax/load_product_qty?product_name="+product_name, true);
			xmlhttp.send();
	}
</script>


<script>
	function bring_price(product_name) {
		var xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function () {
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
					document.getElementById("pricebringer").innerHTML=xmlhttp.responseText;
				}
			};
			xmlhttp.open("GET", "forajax/load_product_price?product_name="+product_name, true);
			xmlhttp.send();
	}
</script>


<script>
		$('#fancy-file-upload').FancyFileUpload({
			params: {
				action: 'fileuploader'
			},
			maxfilesize: 1000000
		});
	</script>
	<script>
		$(document).ready(function () {
			$('#image-uploadify').imageuploadify();
		})
	</script>





