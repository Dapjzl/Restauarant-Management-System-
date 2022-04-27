<?php

    include 'header.php';

?>



<?php
		if (isset($_GET['id'])) {
			$id = $_GET['id'];
			$sql = "SELECT reviews FROM products WHERE id='$id'";
			$res = mysqli_query($connect, $sql);
			$roller = mysqli_fetch_assoc($res);
			$reviews = $roller['reviews'];
			$new_review = $reviews + 1;
			$sql2 = "UPDATE products SET reviews = '$new_review' WHERE id='$id'";
			$rester = mysqli_query($connect, $sql2);
		}


$query = "SELECT * FROM products WHERE id='$id'";
$data = mysqli_query($connect,$query);
$row = mysqli_fetch_assoc($data);
	$id = $row['id'];
	$prd_name = $row['prd_name'];
	$quantity = $row['qty'];
	$price = $row['price'];
	$cat_id = $row['cat_id'];
	$unit_id = $row['unit'];
	$desc = $row['description'];
	$image = $row['prd_image'];

$query2 = "SELECT * FROM unit WHERE id='$unit_id'";
$data2 = mysqli_query($connect,$query2);
$row2 = mysqli_fetch_assoc($data2);
	$unit_name = $row2['unit_name'];

$query3 = "SELECT * FROM category WHERE id='$cat_id'";
$data3 = mysqli_query($connect,$query3);
$row3 = mysqli_fetch_assoc($data3);
	$cat_name = $row3['category_name'];
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
								<li class="breadcrumb-item"><a href="dashboard"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Product Details</li>
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
								<div class="dropdown-divider"></div>	<a class="dropdown-item" href="javascript:;">Separated link</a>
							</div>
						</div>
					</div>
				</div>
				<!--end breadcrumb-->

				 <div class="card paddingthings">
					<div class="row g-0">
					  <div class="col-md-4 border-end paddingthings">
						<img src="assets/images/uploads/<?php echo $image; ?>" class="img-alerting" alt="...">
					  </div>
					  <div class="col-md-8">
						<div class="card-body">
						  <h4 class="card-title"><?php echo $prd_name; ?></h4>
						  <div class="d-flex gap-3 py-3">
							<div class="cursor-pointer">
								<i class='bx bxs-star text-warning'></i>
								<i class='bx bxs-star text-warning'></i>
								<i class='bx bxs-star text-warning'></i>
								<i class='bx bxs-star text-warning'></i>
								<i class='bx bxs-star text-secondary'></i>
							  </div>	
							  <div><?php echo $new_review; ?> review(s)</div>
							  <div class="text-success"><i class='bx bxs-cart-alt align-middle'></i> 134 orders</div>
						  </div>
						  <div class="mb-3"> 
							<span class="price h4">$<?php echo $price; ?>.00</span> 
						</div>
						  <p class="card-text fs-6"><?php echo $desc; ?></p>
						  <dl class="row">
							<dt class="col-sm-3">Category</dt>
							<dd class="col-sm-9"><?php echo $cat_name; ?></dd>
						  
							<dt class="col-sm-3">Sold in</dt>
							<dd class="col-sm-9"><?php echo $unit_name; ?>(s)</dd>
						  
							<dt class="col-sm-3">Delivery</dt>
							<dd class="col-sm-9">Nigeria, USA, and Europe</dd>
						  </dl>
						  <hr>
					<div class="card-body">
						<ul class="nav nav-tabs nav-primary mb-0" role="tablist">
							<li class="nav-item" role="presentation">
								<a class="nav-link active" data-bs-toggle="tab" href="#primaryhome" role="tab" aria-selected="true">
									<div class="d-flex align-items-center">
										<div class="tab-icon"><i class='bx bx-comment-detail font-18 me-1'></i>
										</div>
										<div class="tab-title"> Product Description </div>
									</div>
								</a>
							</li>
							<li class="nav-item" role="presentation">
								<a class="nav-link" data-bs-toggle="tab" href="#primaryprofile" role="tab" aria-selected="false">
									<div class="d-flex align-items-center">
										<div class="tab-icon"><i class='bx bx-bookmark-alt font-18 me-1'></i>
										</div>
										<div class="tab-title">Tags</div>
									</div>
								</a>
							</li>
							<li class="nav-item" role="presentation">
								<a class="nav-link" data-bs-toggle="tab" href="#primarycontact" role="tab" aria-selected="false">
									<div class="d-flex align-items-center">
										<div class="tab-icon"><i class='bx bx-star font-18 me-1'></i>
										</div>
										<div class="tab-title">Reviews</div>
									</div>
								</a>
							</li>
						</ul>
						<div class="tab-content pt-3">
							<div class="tab-pane fade show active" id="primaryhome" role="tabpanel">
								<p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit butcher retro keffiyeh dreamcatcher synth. Cosby sweater eu banh mi, qui irure terry richardson ex squid. Aliquip placeat salvia cillum iphone. Seitan aliquip quis cardigan american apparel, butcher voluptate nisi.</p>
								<p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit butcher retro keffiyeh dreamcatcher synth. Cosby sweater eu banh mi, qui irure terry richardson ex squid. Aliquip placeat salvia cillum iphone. Seitan aliquip quis cardigan american apparel, butcher voluptate nisi.</p>
							</div>
							<div class="tab-pane fade" id="primaryprofile" role="tabpanel">
								<p>Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui photo booth letterpress, commodo enim craft beer mlkshk aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthetic magna delectus mollit. Keytar helvetica VHS salvia yr, vero magna velit sapiente labore stumptown. Vegan fanny pack odio cillum wes anderson 8-bit, sustainable jean shorts beard ut DIY ethical culpa terry richardson biodiesel. Art party scenester stumptown, tumblr butcher vero sint qui sapiente accusamus tattooed echo park.</p>
							</div>
							<div class="tab-pane fade" id="primarycontact" role="tabpanel">
								<p>Etsy mixtape wayfarers, ethical wes anderson tofu before they sold out mcsweeney's organic lomo retro fanny pack lo-fi farm-to-table readymade. Messenger bag gentrify pitchfork tattooed craft beer, iphone skateboard locavore carles etsy salvia banksy hoodie helvetica. DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg banh mi whatever gluten-free, carles pitchfork biodiesel fixie etsy retro mlkshk vice blog. Scenester cred you probably haven't heard of them, vinyl craft beer blog stumptown. Pitchfork sustainable tofu synth chambray yr.</p>
							</div>
						</div>
					</div>

				  </div>
					   </div>
					   <div class="aftermath">
					   <h6 class="text-uppercase mb-0">Related Product</h6>
					<hr/>
					<div class="row row-cols-1 row-cols-lg-3">
					<?php
					
					$query4 = "SELECT * FROM products WHERE NOT id='$id' AND cat_id='$cat_id' ORDER BY rand() LIMIT 3";
					$data4 = mysqli_query($connect,$query4);
	
					while($row4 = mysqli_fetch_assoc($data4)) {
						$id1 = $row4['id'];
						$prd_name1 = $row4['prd_name'];
						$quantity1 = $row4['qty'];
						$price1 = $row4['price'];
						$image1 = $row4['prd_image'];
				   
			   
					   ?>

							<a href="view_single?id=<?php echo $id1?>">
						   <div class="col">
							<div class="card">
								<div class="row g-0 rowfurther">
								  <div class="col-md-4 colkere dowella">
									<img src="assets/images/uploads/<?php echo $image1; ?>" class="img-define" alt="...">
								  </div>
								  <div class="col-md-8 textkere">
									<div class="card-body">
									  <h6 class="card-title"><?php echo $prd_name1; ?></h6>
									  <div class="cursor-pointer my-2">
										<i class="bx bxs-star text-warning"></i>
										<i class="bx bxs-star text-warning"></i>
										<i class="bx bxs-star text-warning"></i>
										<i class="bx bxs-star text-secondary"></i>
										<i class="bx bxs-star text-secondary"></i>
									  </div>
									  <div class="clearfix">
										<p class="mb-0 float-start fw-bold"><span class="me-2 text-decoration-line-through text-secondary">$150</span><span>$<?php echo $price1; ?></span></p>
									 </div>
									</div>
								  </div>
								</div>
							  </div>
							  </div>
							  </a>
						<?php } ?>
					</div>

				  
			</div>
		</div>























<?php

    include 'footer.php';

?>