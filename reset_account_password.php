<?php

    include 'header.php';

?>

<?php
if (isset($_GET['id'])) {
	$upid = $_GET['id'];
}

	if (isset($_POST['submit'])) {

		$passw = check_input($_POST['pass']);
		$cpassw = check_input($_POST['cpass']);

		if (empty($passw) || empty($cpassw)) {
			$_SESSION['noinput'] = "<div class='red'>All fields are required!!!</div>";

		}elseif ($passw !== $cpassw) {
			$_SESSION['noinput'] = "<div class='red'>Passwords do not match!!!</div>";
		}elseif ($passw<6 || $cpassw<6) {
			$_SESSION['noinput'] = "<div class='red'>Password should be at least 6 characters!!!</div>";
		}else {
			$passes = md5($passw);
			
			$sql = "SELECT password FROM register WHERE id='$upid'";
			$res = mysqli_query($connect, $sql);
			$row = mysqli_fetch_assoc($res);
			$actpass = $row['password'];
			if ($actpass==$passes) {
				$_SESSION['noinput'] = "<div class='red'>You Cannot use previous Password!!!</div>";
			}else {
				$query = dbconnect()->prepare("UPDATE register SET password='$passes' WHERE id=?");
				if ($query->execute([$upid])){
					$msg = "Password Changed Successfully!!!";
					echo "<script>alert('$msg'); window.location='accounts';</script>";
				}else{
					$_SESSION['noinput'] = "<div class='red'>An error occurred!!!</div>";
				}
			}
		}
	}

?>



	<!-- wrapper -->
<div class="page-wrapper">
	<div class="page-content">
        <!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Profile</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="dashboard"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Reset password</li>
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
					<div class="col-xl-7 mx-auto">
						<h6 class="mb-0 text-uppercase">Reset password</h6>
						<hr/>
                    </div>
			<div class="row">
				<div class="col-12 col-lg-10 mx-auto">
					<div class="card">
						<div class="row g-0">
							<div class="col-lg-5 border-end">
								<div class="card-body">
									<div class="p-5">
										<div class="text-start">
											<img src="assets/images/logo-img.png" width="180" alt="">
										</div>
										
										<h4 class="mt-5 font-weight-bold">Generate New Password</h4>
										<p class="text-muted">We received your reset password request. Please enter your new password!</p>
										<?php
											if (isset($_SESSION['noinput'])) {
												echo $_SESSION['noinput'];
												unset($_SESSION['noinput']);
											}
										?>
									<form method="POST">
										<div class="mb-3 mt-5">
											<label class="form-label">New Password</label>
											<input type="password" name="pass" class="form-control" placeholder="Enter new password" />
										</div>
										<div class="mb-3">
											<label class="form-label">Confirm Password</label>
											<input type="password" name="cpass" class="form-control" placeholder="Confirm password" />
										</div>
										<div class="d-grid gap-2">
											<button type="submit" name="submit" onclick ="return confirm('Are you sure you want to change password?')" class="btn btn-primary">Change Password</button>
										</div>
									</form>
									</div>
								</div>
							</div>
							<div class="col-lg-7">
								<img src="assets/images/login-images/forgot-password-frent-img.jpg" class="card-img login-img h-100" alt="...">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end wrapper -->
    


<?php

    include 'footer.php';

?>