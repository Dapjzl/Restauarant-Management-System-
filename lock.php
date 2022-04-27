<?php

    include 'connect/db_conn.php';
    include 'connect/login-check.php';
    
   
    if (isset($_GET['username'])) {
        $username = $_GET['username'];
        }
?>
<?php

    if (isset($_POST['submit'])) {

        $pass = check_input($_POST['password']);
        

        if (empty($pass)) {
            $_SESSION['noinput'] = "<div class='red'>Please input password!!!</div>";
            header("location=lock?username=$username");
        }else {
            $password = md5($pass);
            $checkUser = dbconnect()->prepare("SELECT * FROM register WHERE username=?");
            $checkUser->execute([$username]);
            $row = $checkUser->fetch();
            $db_password = $row['password'];
            if($db_password == $password){
                header("location:dashboard");
                $query = dbconnect()->prepare("UPDATE register SET status='1' WHERE username=?");
                $query->execute([$username]);            
                
            }else {
                $_SESSION['noinput'] = "<div class='red'>Invalid password!!!</div>";
                header("location=lock?username=$username");
            }
    }
}

?>



<?php

    $sql = "SELECT * from register WHERE username='$username'";
    $result = mysqli_query($connect, $sql);
    $route = mysqli_fetch_assoc($result);
    $role_id = $route['role_id'];
    $imgName = $route['admin_image'];
?>


<?php

    $sql2 = "SELECT role_name from role WHERE id='$role_id'";
    $result2 = mysqli_query($connect, $sql2);
    $route2 = mysqli_fetch_assoc($result2);
    $role_name = $route2['role_name'];
?>













<!DOCTYPE html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--favicon-->
	<link rel="icon" href="assets/images/favicon-32x32.png" type="image/png" />
	<!-- loader-->
	<link href="assets/css/pace.min.css" rel="stylesheet" />
	<script src="assets/js/pace.min.js"></script>
	<!-- Bootstrap CSS -->
	<link href="assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
	<link href="assets/css/app.css" rel="stylesheet">
	<link href="assets/css/icons.css" rel="stylesheet">
	<title>Rocker - Bootstrap 5 Admin Dashboard Template</title>
</head>



<body class="bg-lock-screen">
	<!-- wrapper -->
	<div class="wrapper">
		<div class="authentication-lock-screen d-flex align-items-center justify-content-center">
			<div class="card shadow-none bg-transparent">
				<div class="card-body p-md-5 text-center">
					<!-- <h2 class="text-white"></h2> -->
					<!-- <h5 class="text-white"></h5> -->
					<div class="fixed_admin">
						<img src="assets/images/uploads_admin/<?php echo $imgName ?>" class="mt-5" width="120" alt="" />
					</div>
					<p class="mt-2 text-white"><?php echo $role_name; ?></p>
                    <?php
                    
                        if (isset($_SESSION['noinput'])) {
                            echo $_SESSION['noinput'];
                            unset($_SESSION['noinput']);
                        }
                    
                    ?>
                    <form action="" method="POST">
					<div class="mb-3 mt-3">
						<input type="password" name="password" class="form-control" placeholder="Password" />
					</div>
					<div class="d-grid">
						<button type="submit" name="submit" class="btn btn-white">Login</button>
					</div>
                    </form>
				</div>
			</div>
		</div>
	</div>
	<!-- end wrapper -->
</body>

</html>