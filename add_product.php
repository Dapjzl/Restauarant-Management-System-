<?php

    include 'header.php';

?>

<?php


	if (isset($_POST['submit'])) {
		$prdname = check_input($_POST['prd_name']);
		$ctg = check_input($_POST['ctg']);
		$unit = check_input($_POST['unit']);
		$price = check_input($_POST['price']);
		$qty = check_input($_POST['qty']);
		$sup_name = check_input($_POST['sup_name']);
		$desc = check_input($_POST['desc']);
		$created = date('Y-m-d');

		if (empty($prdname) || empty($ctg) || empty($unit) || empty($price) || empty($qty) || empty($desc) || empty($sup_name)) {
			echo "<script>alert('You have not completed all required fields!!!')</script>";
		}else{
			
			$sqling = dbconnect()->prepare("SELECT * from products WHERE prd_name=?");
			$sqling->execute([$prdname]);
			if($sqling->rowcount() > 1){
				echo "<script> alert('Product Already Exists!!!');</script>";
			}else{
				$mainImage = $_FILES['imgupload']['name'];
				$source = $_FILES['imgupload']['tmp_name'];
				$error = $_FILES['imgupload']['error'];
				$size = $_FILES['imgupload']['size'];
				$type = $_FILES['imgupload']['type'];

				$fileExt = explode('.',$mainImage);
				$mainExt = strtolower(end($fileExt));

				$allow = array('jpeg','png','jpg','jpeg','gif','jfif','webp');
				// in_array()

				if (in_array($mainExt, $allow)) {
					if ($error === 0) {
						if ($size < 3000000) {
							$newName = uniqid('',true) . "." . $mainExt;

							$destination = 'assets/images/uploads/' . $newName;

							$upload = move_uploaded_file($source,$destination);

							$reg = dbconnect()->prepare("INSERT INTO  products(prd_name, cat_id, unit, price, qty, description, prd_image, created_on, supplier) VALUES(?,?,?,?,?,?,?,?,?)");
							$reg->execute([$prdname,$ctg,$unit,$price,$qty,$desc,$newName,$created,$sup_name]);
							if($reg){
							echo "<script> alert('Success, Product has been added!!!');</script>";
							}
							else{
							echo "<script> alert ('Oops, Operation Failed TRY AGAIN LATER!!!');</script>";
							}

						}else {
							echo "<script> alert('File size is too big!!!');</script>";
						}
					}else {
						echo "<script> alert('An error occurred!!!');</script>";
					}
				}else {
					echo "<script> alert('File extension is not supported!!!');</script>";
				}
			
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
								<li class="breadcrumb-item active" aria-current="page">Add Product</li>
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
						<h6 class="mb-0 text-uppercase">Create Product</h6>
						<hr/>
						<div class="card">
							<div class="card-body">
								<div class="p-4 border rounded">
									<form class="row g-3 needs-validation" method="POST" enctype="multipart/form-data" novalidate>

										<div class="col-md-7">
											<label for="validationCustom01" class="form-label">Product Name:</label>
											<input type="text" class="form-control" id="validationCustom01" placeholder="Enter product name..." name="prd_name">
										</div>

										<div class="col-md-3">
											<label for="validationCustom04" class="form-label">Supplier Name:</label>
											<select class="form-select" id="validationCustom04" name="sup_name">
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

										<div class="col-md-5">
											<label for="validationCustom04" class="form-label">Category:</label>
											<select class="form-select" id="validationCustom04" name="ctg">
												<option value="">....</option>
												<?php
												$query5 = "SELECT * from category";
												$result = mysqli_query($connect, $query5);
												
												while ($row2 = mysqli_fetch_assoc($result)) {
													$id = $row2['id'];
													$cat_name = $row2['category_name'];
												
												?>
													<option value="<?php echo"$id"; ?>"><?php echo"$cat_name" ?></option>
												
												<?php } ?>
											
											</select>
										</div>

										<div class="col-md-3">
											<label for="validationCustom04" class="form-label">Unit:</label>
											<select class="form-select" id="validationCustom04" name="unit">
												<option value="">....</option>
												<?php
												$query = "SELECT * from unit";
												$result = mysqli_query($connect, $query);
												
												while ($row = mysqli_fetch_assoc($result)) {
													$id = $row['id'];
													$unit_name = $row['unit_name'];
												
												?>
													<option value="<?php echo"$id"; ?>"><?php echo"$unit_name" ?></option>
												
												<?php } ?>
											</select>
										</div>

										<div class="col-md-5">
											<label for="validationCustomUsername" class="form-label">Price:</label>
											<div class="input-group has-validation"> <span class="input-group-text" id="inputGroupPrepend">$</span>
												<input type="text" class="form-control" id="validationCustomUsername" aria-describedby="inputGroupPrepend" placeholder="Enter unit price..."name="price">
											</div>
										</div>

										<div class="col-md-4">
											<label for="validationCustomUsername" class="form-label">Quantity:</label>
												<input type="text" class="form-control" id="validationCustomUsername" aria-describedby="inputGroupPrepend" placeholder="Available quantity..."name="qty">
											</div>
										</div>
										
										<div class="col-12" style="margin-bottom: 10px;">
											<label for="inputAddress" class="form-label">Description:</label>
											<textarea class="form-control" id="inputAddress" placeholder="Write a short note that captures the concept of the product..." rows="4" cols="8" name="desc"></textarea>
										</div>

										
										
												<div class="col-xl-9 mx-auto">
													<h6 class="mb-0 text-uppercase">Image Uploadify</h6>
													<hr/>
													<div class="card">
														<div class="card-body">
																<input id="image-uploadify" name="imgupload" type="file" >
														</div>
													</div>
												</div>
											

										<div class="col-12">
											<button class="btn btn-primary" type="submit" name="submit">Submit form</button>
										</div>
									</form>
								</div>
							</div>
						</div>

	

<?php

    include 'footer.php';

?>
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