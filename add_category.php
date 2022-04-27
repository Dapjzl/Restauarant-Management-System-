<?php

    include 'header.php';

?>

<?php


	if (isset($_POST['submit'])) {
		$cat_name = $_POST['cat_name'];
		$created = date('Y-m-d');

		if (empty($cat_name)) {
			echo "<script>alert('You have not entered category name!!!')</script>";
		}else{
            $sql = dbconnect()->prepare("SELECT id from category WHERE category_name=?");
            $sql->execute([$cat_name]);
            if($sql->rowcount() > 0){
                echo "<script> alert('Category Already Exists!!!');</script>";
                }else{
                $reg = dbconnect()->prepare("INSERT INTO  category(category_name, created_on) VALUES(?,?)");
                $reg->execute([$cat_name,$created]);
                if($reg){
                $msg = '';
                echo "<script> alert('New category created successfully!');</script>";
                }
                else{
                echo "<script> alert ('Oops, something went wrong TRY AGAIN!!!');</script>";
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
					<div class="breadcrumb-title pe-3">Category</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Add Category</li>
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
						<h6 class="mb-0 text-uppercase">Create Category</h6>
						<hr/>
						<div class="card">
							<div class="card-body">
								<div class="p-4 border rounded">
									<form class="row g-3 needs-validation" method="POST" enctype="multipart/form-data" novalidate>

										<div class="col-md-7">
											<label for="validationCustom01" class="form-label">Category Name:</label>
											<input type="text" class="form-control" id="validationCustom01" placeholder="Enter category name..." name="cat_name">
										</div>
                                        <div class="col-md-7">
											<label for="validationCustom01" class="form-label">Category Name:</label>
											<input type="text" class="form-control" id="validationCustom01" placeholder="Category name to be saved..." name="" readonly>
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
			maxfilesize: 300000
		});
	</script>
	<script>
		$(document).ready(function () {
			$('#image-uploadify').imageuploadify();
		})
	</script>