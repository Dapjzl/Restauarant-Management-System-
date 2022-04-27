<?php

    include 'header.php';

?>




<?php


	if (isset($_POST['submit'])) {
		$fullname = check_input($_POST['full_name']);
		$age = check_input($_POST['age']);
		$username = check_input($_POST['username']);
		$phone = check_input($_POST['phone']);
		$email = check_input($_POST['email']);
		$address = check_input($_POST['address']);
		$pass = md5(check_input($_POST['pass']));
		$cpass = md5(check_input($_POST['cpass']));
		$agree = check_input($_POST['agree']);
		$role_id = check_input($_POST['role_id']);
		$status = 0;
		$created = date('Y-m-d');

		if (empty($fullname) || empty($age) || empty($username) || empty($phone) || empty($email) || empty($address) || empty($pass) || empty($cpass) || empty($agree) || empty($role_id)) {
			echo "<script>alert('You have not completed all required fields!!!')</script>";
		}elseif ($pass !== $cpass) {
			echo "<script>alert('Passwords do not match!!!')</script>";
		}elseif ($pass<6 || $cpass<6) {
			echo "<script>alert('Password should be at least 6 characters!!!')</script>";
		}else{
				$mainImage = $_FILES['imgupload']['name'];
				$source = $_FILES['imgupload']['tmp_name'];
				$error = $_FILES['imgupload']['error'];
				$size = $_FILES['imgupload']['size'];
				$type = $_FILES['imgupload']['type'];

				$fileExt = explode('.',$mainImage);
				$mainExt = strtolower(end($fileExt));

				$allow = array('jpeg','png','jpg','jpeg','gif');
				// in_array()

				if (in_array($mainExt, $allow)) {
					if ($error === 0) {
						if ($size < 3000000) {
							$newName = uniqid('',true) . "." . $mainExt;

							$destination = 'assets/images/uploads_admin/' . $newName;

							$upload = move_uploaded_file($source,$destination);

							$sql = dbconnect()->prepare("SELECT id from register WHERE username=?");
							$sql->execute([$username]);
							if($sql->rowcount() > 0){
								echo "<script> alert('Username Already Exists!!!');</script>";
								}else{
								$reg = dbconnect()->prepare("INSERT INTO  register(full_name, age, username, phone, email, address, password, admin_image, role_id, status, created_on) VALUES(?,?,?,?,?,?,?,?,?,?,?)");
								$reg->execute([$fullname,$age,$username,$phone,$email,$address,$pass,$newName,$role_id,$status,$created]);
								if($reg){
									$query = dbconnect()->prepare("UPDATE register SET status='0' WHERE username=?");
									$query->execute([$username]);
										echo "<script> alert('Registration Successful!!!'); window.location='dashboard'</script>";
								}
								else{
								echo "<script> alert ('Oops, Operation Failed TRY AGAIN LATER!!!');</script>";
								}
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


?>








<!--start page wrapper -->
<div class="page-wrapper">
			<div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Form</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="dashboard"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Registration</li>
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
					<div class="col-xl-7 mx-auto">
						<h6 class="mb-0 text-uppercase">Registration Form</h6>
						<hr/>
						<div class="card border-top border-0 border-4 border-danger">
							<div class="card-body p-5">
								<div class="card-title d-flex align-items-center">
									<div><i class="bx bxs-user me-1 font-22 text-danger"></i>
									</div>
									<h5 class="mb-0 text-danger">User Registration</h5>
								</div>
								<hr>
								<form class="row g-3" method="POST" enctype="multipart/form-data">
									<div class="col-md-8">
										<label for="inputLastName1" class="form-label">Full Name</label>
										<div class="input-group"> <span class="input-group-text bg-transparent"><i class='bx bxs-user'></i></span>
											<input type="text" class="form-control border-start-0" id="inputLastName1"  name="full_name" placeholder="Enter full name..." />
										</div>
									</div>
									<div class="col-md-4">
										<label for="inputLastName2" class="form-label">Age</label>
										<div class="input-group"> <span class="input-group-text bg-transparent"><img class="bxbig" src="assets/images/icons/age.png"></span>
											<input type="number" min="18" class="form-control border-start-0" id="inputLastName2"  name="age" placeholder="Enter age..." />
										</div>
									</div>
									<div class="col-md-6">
										<label for="inputLastName2" class="form-label">Username</label>
										<div class="input-group"> <span class="input-group-text bg-transparent"><i class='bx bxs-user'></i></span>
											<input type="text" min-length="6" class="form-control border-start-0" id="inputLastName2"  name="username" placeholder="Enter username..." />
										</div>
									</div>
									<div class="col-6">
										<label for="inputPhoneNo" class="form-label">Phone No</label>
										<div class="input-group"> <span class="input-group-text bg-transparent"><i class='bx bxs-microphone' ></i></span>
											<input type="text" class="form-control border-start-0" id="inputPhoneNo" name="phone" placeholder="Enter Phone No..." />
										</div>
									</div>
									<div class="col-6">
										<label for="inputEmailAddress" class="form-label">Email Address</label>
										<div class="input-group"> <span class="input-group-text bg-transparent"><i class='bx bxs-message' ></i></span>
											<input type="email" class="form-control border-start-0" id="inputEmailAddress" name="email" placeholder="Enter email address..." />
										</div>
									</div>
									<div class="col-md-6">
											<label for="validationCustom04" class="form-label">Role</label>
											<select class="form-select" id="validationCustom04" name="role_id">
												<option value="">....</option>
												<?php
												$query5 = "SELECT * from role";
												$result = mysqli_query($connect, $query5);
												
												while ($row2 = mysqli_fetch_assoc($result)) {
													$actrole_id = $row2['id'];
													$role_name = $row2['role_name'];
												
												?>
													<option value="<?php echo"$actrole_id"; ?>"><?php echo"$role_name" ?></option>
												
												<?php } ?>
											
											</select>
										</div>
									<div class="col-12">
										<label for="inputAddress3" class="form-label">Address</label>
										<textarea class="form-control" id="inputAddress3" placeholder="Enter current house address..." rows="2" name="address"></textarea>
									</div>
									<div class="col-6">
										<label for="inputChoosePassword" class="form-label">Password</label>
										<div class="input-group" id="show_hide_password"> <span class="input-group-text bg-transparent"><i class='bx bxs-lock-open' ></i></span>
											<input type="password" minlength="6" class="form-control border-start-0" id="inputChoosePassword" name="pass" placeholder="Enter Password..." /><a class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
										</div>
									</div>
									<div class="col-6">
										<label for="inputConfirmPassword" class="form-label">Confirm Password</label>
										<div class="input-group" id="show_hide_confirm_password"> <span class="input-group-text bg-transparent"><i class='bx bxs-lock' ></i></span>
											<input type="password" minlength="6" class="form-control border-start-0" id="inputConfirmPassword" name="cpass" placeholder="Confirm Password..." /><a class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
										</div>
									</div>
									<div class="col-12">
										<label for="inputConfirmPassword" class="form-label">Profile Image</label>
										<div class="input-group" id=""> <span class="input-group-text bg-transparent"><i class='bx bx-image-add' ></i></span>
											<input type="file" class="form-control border-start-0" id="" name="imgupload" />
										</div>
									</div>
									<div class="col-12">
									<div class="form-check form-switch">
										<input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" name="agree">
										<label class="form-check-label" for="flexSwitchCheckChecked">I read and agree to Terms & Conditions</label>
									</div>
									</div>
									<div class="col-12">
										<button type="submit" name="submit" class="btn btn-danger px-5">Register</button>
									</div>
								</form>
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


<script>
		$(document).ready(function () {
			$("#show_hide_password a").on('click', function (event) {
				event.preventDefault();
				if ($('#show_hide_password input').attr("type") == "text") {
					$('#show_hide_password input').attr('type', 'password');
					$('#show_hide_password i').addClass("bx-hide");
					$('#show_hide_password i').removeClass("bx-show");
				} else if ($('#show_hide_password input').attr("type") == "password") {
					$('#show_hide_password input').attr('type', 'text');
					$('#show_hide_password i').removeClass("bx-hide");
					$('#show_hide_password i').addClass("bx-show");
				}
			});
		});
	</script>
	<script>
		$(document).ready(function () {
			$("#show_hide_confirm_password a").on('click', function (event) {
				event.preventDefault();
				if ($('#show_hide_confirm_password input').attr("type") == "text") {
					$('#show_hide_confirm_password input').attr('type', 'password');
					$('#show_hide_confirm_password i').addClass("bx-hide");
					$('#show_hide_confirm_password i').removeClass("bx-show");
				} else if ($('#show_hide_confirm_password input').attr("type") == "password") {
					$('#show_hide_confirm_password input').attr('type', 'text');
					$('#show_hide_confirm_password i').removeClass("bx-hide");
					$('#show_hide_confirm_password i').addClass("bx-show");
				}
			});
		});
	</script>