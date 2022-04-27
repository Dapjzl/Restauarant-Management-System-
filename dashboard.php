


<?php
ob_start();
ini_set('display_errors', 1);
	include 'header.php';

?>

<?php

	$counterid = 0;
	$countsql = "SELECT id FROM products";
	$countres = mysqli_query($connect, $countsql);
	while ($countrow=mysqli_fetch_assoc($countres)) {
		$counterid++;
	}

?>

<?php
	$quora = $connect->query("SELECT DISTINCT month, year FROM sales GROUP BY ref_code ORDER BY month ASC");
	while ($borow=$quora->fetch_array()) {
		$month = $borow['month'];
		$year = $borow['year'];
		$quer = $connect->query("SELECT sum(total) AS summit FROM (SELECT DISTINCT ref_code, month, total FROM sales WHERE month=$month AND year=$year) AS ref");

		if ($month==1) {
			$month = 'Jan';
		}elseif ($month==2) {
			$month = 'Feb';
		}elseif ($month==3) {
			$month = 'Mar';
		}elseif ($month==4) {
			$month = 'Apr';
		}elseif ($month==5) {
			$month = 'May';
		}elseif ($month==6) {
			$month = 'Jun';
		}elseif ($month==7) {
			$month = 'Jul';
		}elseif ($month==8) {
			$month = 'Aug';
		}elseif ($month==9) {
			$month = 'Sep';
		}elseif ($month==10) {
			$month = 'Oct';
		}elseif ($month==11) {
			$month = 'Nov';
		}elseif ($month==12) {
			$month = 'Dec';
		}
		$prMON[] = $month;

		while ($brow=$quer->fetch_array()) {

		$tot = $brow['summit'];
		$prDID[] = $tot;
		}

	}
	$querot = $connect->query("SELECT sum(summit) AS summitot FROM (SELECT sum(total) AS summit FROM (SELECT DISTINCT ref_code, month, total FROM sales) AS ref) AS refer");
	while ($browquerot=$querot->fetch_array()) {

		$totalsum = $browquerot['summitot'];
		}

	
	?>
	
	
	<!--start page wrapper -->
		<div class="page-wrapper">
			<div class="page-content">
				<div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
                   <div class="col">
					 <div class="card radius-10 border-start border-0 border-3 border-info">
						<div class="card-body">
							<div class="d-flex align-items-center">
								<div>
									<p class="mb-0 text-secondary">Total Orders</p>
									<h4 class="my-1 text-info">4805</h4>
									<p class="mb-0 font-13">+2.5% from last week</p>
								</div>
								<div class="widgets-icons-2 rounded-circle bg-gradient-scooter text-white ms-auto"><i class='bx bxs-cart'></i>
								</div>
							</div>
						</div>
					 </div>
				   </div>
				   <div class="col">
					<div class="card radius-10 border-start border-0 border-3 border-danger">
					   <div class="card-body">
						   <div class="d-flex align-items-center">
							   <div>
								   <p class="mb-0 text-secondary">Sales Revenue</p>
								   <h4 class="my-1 text-danger">$ <?php echo $totalsum;?></h4>
								   <p class="mb-0 font-13">+5.4% from last week</p>
							   </div>
							   <div class="widgets-icons-2 rounded-circle bg-gradient-bloody text-white ms-auto"><i class='bx bxs-wallet'></i>
							   </div>
						   </div>
					   </div>
					</div>
				  </div>
				  <div class="col">
					<div class="card radius-10 border-start border-0 border-3 border-success">
					   <div class="card-body">
						   <div class="d-flex align-items-center">
							   <div>
									<?php
									
										$countquer = $connect->query("SELECT count(prd_name) AS countprd FROM sales");
										while ($rowcquer=$countquer->fetch_array()) {
											$prdPicks = $rowcquer['countprd'];
										}
									?>
								   <p class="mb-0 text-secondary">Products Sold</p>
								   <h4 class="my-1 text-success"><?php echo $prdPicks;?></h4>
								   <p class="mb-0 font-13">-4.5% from last week</p>
							   </div>
							   <div class="widgets-icons-2 rounded-circle bg-gradient-ohhappiness text-white ms-auto"><i class='bx bxs-bar-chart-alt-2' ></i>
							   </div>
						   </div>
					   </div>
					</div>
				  </div>
				  <div class="col">
					<div class="card radius-10 border-start border-0 border-3 border-warning">
					   <div class="card-body">
						   <div class="d-flex align-items-center">
							   <div>
								   <p class="mb-0 text-secondary">Available Products</p>
								   <h4 class="my-1 text-warning"><?php echo $counterid; ?></h4>
								   <p class="mb-0 font-13">+8.4% from last week</p>
							   </div>
							   <div class="widgets-icons-2 rounded-circle bg-gradient-blooker text-white ms-auto"><i class='bx bxs-group'></i>
							   </div>
						   </div>
					   </div>
					</div>
				  </div> 
				</div><!--end row-->

				<div class="row">
                   <div class="col-12 col-lg-8">
                      <div class="card radius-10">
						  <div class="card-body">
							<div class="d-flex align-items-center">
								<div>
									<h6 class="mb-0">Sales Overview</h6>
								</div>
								<div class="dropdown ms-auto">
									<a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown"><i class='bx bx-dots-horizontal-rounded font-22 text-option'></i>
									</a>
									<ul class="dropdown-menu">
										<li><a class="dropdown-item" href="javascript:;">Action</a>
										</li>
										<li><a class="dropdown-item" href="javascript:;">Another action</a>
										</li>
										<li>
											<hr class="dropdown-divider">
										</li>
										<li><a class="dropdown-item" href="javascript:;">Something else here</a>
										</li>
									</ul>
								</div>
							</div>
							<div class="d-flex align-items-center ms-auto font-13 gap-2 my-3">
								<span class="border px-1 rounded cursor-pointer"><i class="bx bxs-circle me-1" style="color: #14abef"></i>Sales</span>
								<span class="border px-1 rounded cursor-pointer"><i class="bx bxs-circle me-1" style="color: #ffc107"></i>Purchases</span>
							</div>
							<div class="chart-container-1">
								<canvas id="chart1"></canvas>
							  </div>
						  </div>
						  <div class="row row-cols-1 row-cols-md-3 row-cols-xl-3 g-0 row-group text-center border-top">
							<div class="col">
							  <div class="p-3">
								<h5 class="mb-0">24.15M</h5>
								<small class="mb-0">Overall Visitor <span> <i class="bx bx-up-arrow-alt align-middle"></i> 2.43%</span></small>
							  </div>
							</div>
							<div class="col">
							  <div class="p-3">
								<h5 class="mb-0">12:38</h5>
								<small class="mb-0">Visitor Duration <span> <i class="bx bx-up-arrow-alt align-middle"></i> 12.65%</span></small>
							  </div>
							</div>
							<div class="col">
							  <div class="p-3">
								<h5 class="mb-0">639.82</h5>
								<small class="mb-0">Pages/Visit <span> <i class="bx bx-up-arrow-alt align-middle"></i> 5.62%</span></small>
							  </div>
							</div>
						  </div>
					  </div>
				   </div>
				   <div class="col-12 col-lg-4">
                       <div class="card radius-10">
						   <div class="card-body">
							<div class="d-flex align-items-center">
								<div>
									<h6 class="mb-0">Trending Products</h6>
								</div>
								<div class="dropdown ms-auto">
									<a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown"><i class='bx bx-dots-horizontal-rounded font-22 text-option'></i>
									</a>
									<ul class="dropdown-menu">
										<li><a class="dropdown-item" href="javascript:;">Action</a>
										</li>
										<li><a class="dropdown-item" href="javascript:;">Another action</a>
										</li>
										<li>
											<hr class="dropdown-divider">
										</li>
										<li><a class="dropdown-item" href="javascript:;">Something else here</a>
										</li>
									</ul>
								</div>
							</div>
							<div class="chart-container-2 mt-4">
								<canvas id="chart2"></canvas>
							  </div>
						   </div>
						   <ul class="list-group list-group-flush">
							<li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">Jeans <span class="badge bg-success rounded-pill">25</span>
							</li>
							<li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">T-Shirts <span class="badge bg-danger rounded-pill">10</span>
							</li>
							<li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">Shoes <span class="badge bg-primary rounded-pill">65</span>
							</li>
							<li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">Lingerie <span class="badge bg-warning text-dark rounded-pill">14</span>
							</li>
						</ul>
					   </div>
				   </div>
				</div><!--end row-->

				 <div class="card radius-10">
                         <div class="card-body">
							<div class="d-flex align-items-center">
								<div>
									<h6 class="mb-0">Recent Orders</h6>
								</div>
								<div class="dropdown ms-auto">
									<a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown"><i class='bx bx-dots-horizontal-rounded font-22 text-option'></i>
									</a>
									<ul class="dropdown-menu">
										<li><a class="dropdown-item" href="javascript:;">Action</a>
										</li>
										<li><a class="dropdown-item" href="javascript:;">Another action</a>
										</li>
										<li>
											<hr class="dropdown-divider">
										</li>
										<li><a class="dropdown-item" href="javascript:;">Something else here</a>
										</li>
									</ul>
								</div>
							</div>
						 <div class="table-responsive">
						   <table class="table align-middle mb-0">
							<thead class="table-light">
							 <tr>
							   <th>Product</th>
							   <th>Photo</th>
							   <th>Product ID</th>
							   <th>Status</th>
							   <th>Amount</th>
							   <th>Date</th>
							   <th>Shipping</th>
							 </tr>
							 </thead>
							 <tbody><tr>
							  <td>Iphone 5</td>
							  <td><img src="assets/images/products/01.png" class="product-img-2" alt="product img"></td>
							  <td>#9405822</td>
							  <td><span class="badge bg-gradient-quepal text-white shadow-sm w-100">Paid</span></td>
							  <td>$1250.00</td>
							  <td>03 Feb 2020</td>
							  <td><div class="progress" style="height: 6px;">
									<div class="progress-bar bg-gradient-quepal" role="progressbar" style="width: 100%"></div>
								  </div></td>
							 </tr>
		  
							 <tr>
							  <td>Earphone GL</td>
							  <td><img src="assets/images/products/02.png" class="product-img-2" alt="product img"></td>
							  <td>#8304620</td>
							  <td><span class="badge bg-gradient-blooker text-white shadow-sm w-100">Pending</span></td>
							  <td>$1500.00</td>
							  <td>05 Feb 2020</td>
							  <td><div class="progress" style="height: 6px;">
									<div class="progress-bar bg-gradient-blooker" role="progressbar" style="width: 60%"></div>
								  </div></td>
							 </tr>
		  
							 <tr>
							  <td>HD Hand Camera</td>
							  <td><img src="assets/images/products/03.png" class="product-img-2" alt="product img"></td>
							  <td>#4736890</td>
							  <td><span class="badge bg-gradient-bloody text-white shadow-sm w-100">Failed</span></td>
							  <td>$1400.00</td>
							  <td>06 Feb 2020</td>
							  <td><div class="progress" style="height: 6px;">
									<div class="progress-bar bg-gradient-bloody" role="progressbar" style="width: 70%"></div>
								  </div></td>
							 </tr>
		  
							 <tr>
							  <td>Classic Shoes</td>
							  <td><img src="assets/images/products/04.png" class="product-img-2" alt="product img"></td>
							  <td>#8543765</td>
							  <td><span class="badge bg-gradient-quepal text-white shadow-sm w-100">Paid</span></td>
							  <td>$1200.00</td>
							  <td>14 Feb 2020</td>
							  <td><div class="progress" style="height: 6px;">
									<div class="progress-bar bg-gradient-quepal" role="progressbar" style="width: 100%"></div>
								  </div></td>
							 </tr>
							 <tr>
							  <td>Sitting Chair</td>
							  <td><img src="assets/images/products/06.png" class="product-img-2" alt="product img"></td>
							  <td>#9629240</td>
							  <td><span class="badge bg-gradient-blooker text-white shadow-sm w-100">Pending</span></td>
							  <td>$1500.00</td>
							  <td>18 Feb 2020</td>
							  <td><div class="progress" style="height: 6px;">
									<div class="progress-bar bg-gradient-blooker" role="progressbar" style="width: 60%"></div>
								  </div></td>
							 </tr>
							 <tr>
							  <td>Hand Watch</td>
							  <td><img src="assets/images/products/05.png" class="product-img-2" alt="product img"></td>
							  <td>#8506790</td>
							  <td><span class="badge bg-gradient-bloody text-white shadow-sm w-100">Failed</span></td>
							  <td>$1800.00</td>
							  <td>21 Feb 2020</td>
							  <td><div class="progress" style="height: 6px;">
									<div class="progress-bar bg-gradient-bloody" role="progressbar" style="width: 40%"></div>
								  </div></td>
							 </tr>
						    </tbody>
						  </table>
						  </div>
						 </div>
					</div>


					<div class="row">
						<div class="col-12 col-lg-7 col-xl-8 d-flex">
						  <div class="card radius-10 w-100">
							<div class="card-header bg-transparent">
								<div class="d-flex align-items-center">
									<div>
										<h6 class="mb-0">Recent Orders</h6>
									</div>
									<div class="dropdown ms-auto">
										<a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown"><i class='bx bx-dots-horizontal-rounded font-22 text-option'></i>
										</a>
										<ul class="dropdown-menu">
											<li><a class="dropdown-item" href="javascript:;">Action</a>
											</li>
											<li><a class="dropdown-item" href="javascript:;">Another action</a>
											</li>
											<li>
												<hr class="dropdown-divider">
											</li>
											<li><a class="dropdown-item" href="javascript:;">Something else here</a>
											</li>
										</ul>
									</div>
								</div>
							   </div>
							 <div class="card-body">
								<div class="row">
								  <div class="col-lg-7 col-xl-8 border-end">
									 <div id="geographic-map-2"></div>
								  </div>
								  <div class="col-lg-5 col-xl-4">
			                       
									<div class="mb-4">
									<p class="mb-2"><i class="flag-icon flag-icon-us me-1"></i> USA <span class="float-end">70%</span></p>
									<div class="progress" style="height: 7px;">
										 <div class="progress-bar bg-primary progress-bar-striped" role="progressbar" style="width: 70%"></div>
									 </div>
									</div>
			   
									<div class="mb-4">
									 <p class="mb-2"><i class="flag-icon flag-icon-ca me-1"></i> Canada <span class="float-end">65%</span></p>
									 <div class="progress" style="height: 7px;">
										 <div class="progress-bar bg-danger progress-bar-striped" role="progressbar" style="width: 65%"></div>
									 </div>
									</div>
			   
									<div class="mb-4">
									 <p class="mb-2"><i class="flag-icon flag-icon-gb me-1"></i> England <span class="float-end">60%</span></p>
									 <div class="progress" style="height: 7px;">
										 <div class="progress-bar bg-success progress-bar-striped" role="progressbar" style="width: 60%"></div>
									   </div>
									</div>
			   
									<div class="mb-4">
									 <p class="mb-2"><i class="flag-icon flag-icon-au me-1"></i> Australia <span class="float-end">55%</span></p>
									 <div class="progress" style="height: 7px;">
										 <div class="progress-bar bg-warning progress-bar-striped" role="progressbar" style="width: 55%"></div>
									   </div>
									</div>
			   
									<div class="mb-4">
									 <p class="mb-2"><i class="flag-icon flag-icon-in me-1"></i> India <span class="float-end">50%</span></p>
									 <div class="progress" style="height: 7px;">
										 <div class="progress-bar bg-info progress-bar-striped" role="progressbar" style="width: 50%"></div>
									   </div>
									</div>

									<div class="mb-0">
									   <p class="mb-2"><i class="flag-icon flag-icon-cn me-1"></i> China <span class="float-end">45%</span></p>
									   <div class="progress" style="height: 7px;">
										   <div class="progress-bar bg-dark progress-bar-striped" role="progressbar" style="width: 45%"></div>
										 </div>
									</div>

								  </div>
								</div>
							 </div>
						   </div>
						</div>
			   
						<div class="col-12 col-lg-5 col-xl-4 d-flex">
							<div class="card w-100 radius-10">
						     <div class="card-body">
							  <div class="card radius-10 border shadow-none">
								<div class="card-body">
									<div class="d-flex align-items-center">
										<div>
											<p class="mb-0 text-secondary">Total Likes</p>
											<h4 class="my-1">45.6M</h4>
											<p class="mb-0 font-13">+6.2% from last week</p>
										</div>
										<div class="widgets-icons-2 bg-gradient-cosmic text-white ms-auto"><i class='bx bxs-heart-circle'></i>
										</div>
									</div>
								</div>
							 </div>
							 <div class="card radius-10 border shadow-none">
								<div class="card-body">
									<div class="d-flex align-items-center">
										<div>
											<p class="mb-0 text-secondary">Comments</p>
											<h4 class="my-1">25.6K</h4>
											<p class="mb-0 font-13">+3.7% from last week</p>
										</div>
										<div class="widgets-icons-2 bg-gradient-ibiza text-white ms-auto"><i class='bx bxs-comment-detail'></i>
										</div>
									</div>
								</div>
							 </div>
							 <div class="card radius-10 mb-0 border shadow-none">
								<div class="card-body">
									<div class="d-flex align-items-center">
										<div>
											<p class="mb-0 text-secondary">Total Shares</p>
											<h4 class="my-1">85.4M</h4>
											<p class="mb-0 font-13">+4.6% from last week</p>
										</div>
										<div class="widgets-icons-2 bg-gradient-moonlit text-white ms-auto"><i class='bx bxs-share-alt'></i>
										</div>
									</div>
								</div>
							  </div>
							 </div>

							</div>
			   
						</div>
					 </div><!--end row-->

					 <div class="row row-cols-1 row-cols-lg-3">
						 <div class="col d-flex">
                           <div class="card radius-10 w-100">
							   <div class="card-body">
								<p class="font-weight-bold mb-1 text-secondary">Weekly Revenue</p>
								<div class="d-flex align-items-center mb-4">
									<div>
										<h4 class="mb-0">$89,540</h4>
									</div>
									<div class="">
										<p class="mb-0 align-self-center font-weight-bold text-success ms-2">4.4% <i class="bx bxs-up-arrow-alt mr-2"></i>
										</p>
									</div>
								</div>
								<div class="chart-container-0">
									<canvas id="chart3"></canvas>
								  </div>
							   </div>
						   </div>
						 </div>
						 <div class="col d-flex">
							<div class="card radius-10 w-100">
								<div class="card-header bg-transparent">
									<div class="d-flex align-items-center">
										<div>
											<h6 class="mb-0">Orders Summary</h6>
										</div>
										<div class="dropdown ms-auto">
											<a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown"><i class='bx bx-dots-horizontal-rounded font-22 text-option'></i>
											</a>
											<ul class="dropdown-menu">
												<li><a class="dropdown-item" href="javascript:;">Action</a>
												</li>
												<li><a class="dropdown-item" href="javascript:;">Another action</a>
												</li>
												<li>
													<hr class="dropdown-divider">
												</li>
												<li><a class="dropdown-item" href="javascript:;">Something else here</a>
												</li>
											</ul>
										</div>
									</div>
								</div>
								<div class="card-body">
									<div class="chart-container-1">
										<canvas id="chart4"></canvas>
									  </div>
								</div>
								<ul class="list-group list-group-flush">
									<li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">Completed <span class="badge bg-gradient-quepal rounded-pill">25</span>
									</li>
									<li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">Pending <span class="badge bg-gradient-ibiza rounded-pill">10</span>
									</li>
									<li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">Process <span class="badge bg-gradient-deepblue rounded-pill">65</span>
									</li>
								</ul>
							</div>
						  </div>
						  <div class="col d-flex">
							<div class="card radius-10 w-100">
								 <div class="card-header bg-transparent">
									<div class="d-flex align-items-center">
										<div>
											<h6 class="mb-0">Top Selling Categories</h6>
										</div>
										<div class="dropdown ms-auto">
											<a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown"><i class='bx bx-dots-horizontal-rounded font-22 text-option'></i>
											</a>
											<ul class="dropdown-menu">
												<li><a class="dropdown-item" href="javascript:;">Action</a>
												</li>
												<li><a class="dropdown-item" href="javascript:;">Another action</a>
												</li>
												<li>
													<hr class="dropdown-divider">
												</li>
												<li><a class="dropdown-item" href="javascript:;">Something else here</a>
												</li>
											</ul>
										</div>
									 </div>
								 </div>
								<div class="card-body">
								   <div class="chart-container-0">
									 <canvas id="chart5"></canvas>
								   </div>
								</div>
								<div class="row row-group border-top g-0">
									<div class="col">
										<div class="p-3 text-center">
											<h4 class="mb-0 text-danger">$45,216</h4>
											<p class="mb-0">Clothing</p>
										</div>
									</div>
									<div class="col">
										<div class="p-3 text-center">
											<h4 class="mb-0 text-success">$68,154</h4>
											<p class="mb-0">Electronic</p>
										</div>
									 </div>
								</div><!--end row-->
							</div>
						  </div>
					 </div><!--end row-->

			</div>
		</div>
		<!--end page wrapper -->
		<!--start overlay-->
		
	


<?php

include 'footer.php';

?>

<script>

$(function() {
    "use strict";

	
// chart 1

  var ctx = document.getElementById("chart1").getContext('2d');
   
  var gradientStroke1 = ctx.createLinearGradient(0, 0, 0, 300);
      gradientStroke1.addColorStop(0, '#6078ea');  
      gradientStroke1.addColorStop(1, '#17c5ea'); 
   
  var gradientStroke2 = ctx.createLinearGradient(0, 0, 0, 300);
      gradientStroke2.addColorStop(0, '#ff8359');
      gradientStroke2.addColorStop(1, '#ffdf40');

      var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
          labels: <?php echo json_encode($prMON); ?>,
          datasets: [{
            label: 'Sales',
            data: <?php echo json_encode($prDID); ?>,
            borderColor: gradientStroke1,
            backgroundColor: gradientStroke1,
            hoverBackgroundColor: gradientStroke1,
            pointRadius: 0,
            fill: false,
            borderWidth: 0
          },
			{
				label: 'Purchases',
				data: [2500, 4500, 2000, 1100, 3600, 1500, 2800, 1800, 2500, 3000, 5100, 2900],
				borderColor: gradientStroke2,
				backgroundColor: gradientStroke2,
				hoverBackgroundColor: gradientStroke2,
				pointRadius: 0,
				fill: false,
				borderWidth: 0

			}]
        },
		
		options:{
		  maintainAspectRatio: false,
		  legend: {
			  position: 'bottom',
              display: false,
			  labels: {
                boxWidth:8
              }
            },
			tooltips: {
			  displayColors:false,
			},	
		  scales: {
			  xAxes: [{
				barPercentage: .7
			  }]
		     }
		}
      });
	  
	 
// chart 2

 var ctx = document.getElementById("chart2").getContext('2d');
<?php 

		// $qwerty = $connect->query("SELECT count(DISTINCT prd_name) AS prdName FROM sales GROUP BY id");
		// while ($rowqwerty=$qwerty->fetch_array()) {
		// 	$prodit = $rowqwerty['prdName'];
		 	// echo "<script>alert('$prodit')</script>";
		// }

?>
  var gradientStroke1 = ctx.createLinearGradient(0, 0, 0, 300);
      gradientStroke1.addColorStop(0, '#fc4a1a');
      gradientStroke1.addColorStop(1, '#f7b733');

  var gradientStroke2 = ctx.createLinearGradient(0, 0, 0, 300);
      gradientStroke2.addColorStop(0, '#4776e6');
      gradientStroke2.addColorStop(1, '#8e54e9');


  var gradientStroke3 = ctx.createLinearGradient(0, 0, 0, 300);
      gradientStroke3.addColorStop(0, '#ee0979');
      gradientStroke3.addColorStop(1, '#ff6a00');
	  
	var gradientStroke4 = ctx.createLinearGradient(0, 0, 0, 300);
      gradientStroke4.addColorStop(0, '#42e695');
      gradientStroke4.addColorStop(1, '#3bb2b8');

      var myChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
          labels: ["Jeans", "T-Shirts", "Shoes", "Lingerie"],
          datasets: [{
            backgroundColor: [
              gradientStroke1,
              gradientStroke2,
              gradientStroke3,
              gradientStroke4
            ],
            hoverBackgroundColor: [
              gradientStroke1,
              gradientStroke2,
              gradientStroke3,
              gradientStroke4
            ],
            data: [25, 80, 25, 25],
			borderWidth: [1, 1, 1, 1]
          }]
        },
        options: {
			maintainAspectRatio: false,
			cutoutPercentage: 75,
            legend: {
			  position: 'bottom',
              display: false,
			  labels: {
                boxWidth:8
              }
            },
			tooltips: {
			  displayColors:false,
			}
        }
      });

   

// worl map

jQuery('#geographic-map-2').vectorMap(
{
    map: 'world_mill_en',
    backgroundColor: 'transparent',
    borderColor: '#818181',
    borderOpacity: 0.25,
    borderWidth: 1,
    zoomOnScroll: false,
    color: '#009efb',
    regionStyle : {
        initial : {
          fill : '#008cff'
        }
      },
    markerStyle: {
      initial: {
				r: 9,
				'fill': '#fff',
				'fill-opacity':1,
				'stroke': '#000',
				'stroke-width' : 5,
				'stroke-opacity': 0.4
                },
                },
    enableZoom: true,
    hoverColor: '#009efb',
    markers : [{
        latLng : [21.00, 78.00],
        name : 'Lorem Ipsum Dollar'
      
      }],
    hoverOpacity: null,
    normalizeFunction: 'linear',
    scaleColors: ['#b6d6ff', '#005ace'],
    selectedColor: '#c9dfaf',
    selectedRegions: [],
    showTooltip: true,
});


// chart 3

 var ctx = document.getElementById('chart3').getContext('2d');

  var gradientStroke1 = ctx.createLinearGradient(0, 0, 0, 300);
      gradientStroke1.addColorStop(0, '#008cff');
      gradientStroke1.addColorStop(1, 'rgba(22, 195, 233, 0.1)');

      var myChart = new Chart(ctx, {
        type: 'line',
        data: {
          labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
          datasets: [{
            label: 'Revenue',
            data: [3, 30, 10, 10, 22, 12, 5],
            pointBorderWidth: 2,
            pointHoverBackgroundColor: gradientStroke1,
            backgroundColor: gradientStroke1,
            borderColor: gradientStroke1,
            borderWidth: 3
          }]
        },
        options: {
			maintainAspectRatio: false,
            legend: {
			  position: 'bottom',
              display:false
            },
            tooltips: {
			  displayColors:false,	
              mode: 'nearest',
              intersect: false,
              position: 'nearest',
              xPadding: 10,
              yPadding: 10,
              caretPadding: 10
            }
         }
      });



// chart 4

var ctx = document.getElementById("chart4").getContext('2d');

  var gradientStroke1 = ctx.createLinearGradient(0, 0, 0, 300);
      gradientStroke1.addColorStop(0, '#ee0979');
      gradientStroke1.addColorStop(1, '#ff6a00');
    
  var gradientStroke2 = ctx.createLinearGradient(0, 0, 0, 300);
      gradientStroke2.addColorStop(0, '#283c86');
      gradientStroke2.addColorStop(1, '#39bd3c');

  var gradientStroke3 = ctx.createLinearGradient(0, 0, 0, 300);
      gradientStroke3.addColorStop(0, '#7f00ff');
      gradientStroke3.addColorStop(1, '#e100ff');

      var myChart = new Chart(ctx, {
        type: 'pie',
        data: {
          labels: ["Completed", "Pending", "Process"],
          datasets: [{
            backgroundColor: [
              gradientStroke1,
              gradientStroke2,
              gradientStroke3
            ],

             hoverBackgroundColor: [
              gradientStroke1,
              gradientStroke2,
              gradientStroke3
            ],

            data: [50, 50, 50],
      borderWidth: [1, 1, 1]
          }]
        },
        options: {
		 maintainAspectRatio: false,
          cutoutPercentage: 0,
            legend: {
              position: 'bottom',
              display: false,
            labels: {
                boxWidth:8
              }
            },
			tooltips: {
			  displayColors:false,
			},
        }
      });

	  
  // chart 5

    var ctx = document.getElementById("chart5").getContext('2d');
   
      var gradientStroke1 = ctx.createLinearGradient(0, 0, 0, 300);
      gradientStroke1.addColorStop(0, '#f54ea2');
      gradientStroke1.addColorStop(1, '#ff7676');

      var gradientStroke2 = ctx.createLinearGradient(0, 0, 0, 300);
      gradientStroke2.addColorStop(0, '#42e695');
      gradientStroke2.addColorStop(1, '#3bb2b8');

      var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
          labels: [1, 2, 3, 4, 5, 6, 7, 8],
          datasets: [{
            label: 'Clothing',
            data: [40, 30, 60, 35, 60, 25, 50, 40],
            borderColor: gradientStroke1,
            backgroundColor: gradientStroke1,
            hoverBackgroundColor: gradientStroke1,
            pointRadius: 0,
            fill: false,
            borderWidth: 1
          }, {
            label: 'Electronic',
            data: [50, 60, 40, 70, 35, 75, 30, 20],
            borderColor: gradientStroke2,
            backgroundColor: gradientStroke2,
            hoverBackgroundColor: gradientStroke2,
            pointRadius: 0,
            fill: false,
            borderWidth: 1
          }]
        },
		options:{
		  maintainAspectRatio: false,
		  legend: {
			  position: 'bottom',
              display: false,
			  labels: {
                boxWidth:8
              }
            },	
		  scales: {
			  xAxes: [{
				barPercentage: .5
			  }]
		     },
			tooltips: {
			  displayColors:false,
			}
		}
      });




   });	 
   	
</script>