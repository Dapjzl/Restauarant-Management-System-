<?php

include 'header.php';

?>


<!--start page wrapper -->
<div class="page-wrapper">
			<div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Tables</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Basic Table</li>
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
				<div class="row">
					<div class="col-xl-9 mx-auto">
						<h6 class="mb-0 text-uppercase">Striped rows</h6>
						<hr/>
						<div class="card">
							<div class="card-body">
								<table class="table mb-0 table-striped">
									<thead>
										<tr>
											<th scope="col">#</th>
											<th scope="col">Category Name</th>
											<th scope="col">Date Created</th>
											<th scope="col">Actions</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$n = 0;
										$sql = "SELECT * FROM category";
										$res = mysqli_query($connect, $sql);
										while ($row = mysqli_fetch_assoc($res)) {
											$n++;
											$id = $row['id'];
											$cat_name = $row['category_name'];	
											$created = $row['created_on'];	
										
										?>
										<tr>
											<td scope="row"><?php echo $n ?></td>
											<td><?php echo $cat_name; ?></td>
											<td><?php echo $created; ?></td>
											<td>
											<a href="update_category?id=<?php echo $id; ?>" class="green"><i class="bx bx-edit producticon"></i></a>
											<a href="del_category?id=<?php echo $id; ?>"  onclick ="return confirm('Are you sure you want to delete category?')" class="red"><i class="bx bx-trash producticon"></i></a>
											</td>
									<?php } ?>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
				<!--end row-->
			</div>
		</div>
		<!--end page wrapper -->

<?php

include 'footer.php';

?>