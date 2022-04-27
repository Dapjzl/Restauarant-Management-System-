<?php include 'header.php'; ?>


<?php
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
    }
                   
        $sql = "SELECT * FROM purchase WHERE id='$id'";
        $data = mysqli_query($connect,$sql);
        $row = mysqli_fetch_assoc($data);
        $itm_name = $row['item'];
        $supplier = $row['supplier'];
        $unit_price = $row['price'];
        $quantity = $row['qty'];
        $tax = $row['tax'];
        $amt_paid = $row['amount_paid'];
        $amt_due = $row['amount_due'];
        $ref_code = $row['ref_code'];

	if (isset($_POST['submit'])) {
        $pay_amt = check_input($_POST['pay_amt']);
        $rem = check_input($_POST['rem']);
        if (empty($pay_amt)) {
            echo "<script>alert('You have not entered payment amount!')</script>";
        }elseif ($pay_amt > $amt_due) {
            $_SESSION['over'] = "<div>The amount you entered is over what you owe!!</div>";
        }else {
            $new_paid = $amt_paid + $pay_amt;
            $query = dbconnect()->prepare("UPDATE purchase SET amount_due='$rem', amount_paid='$new_paid' WHERE id=?");
            $query->execute([$id]);
            $msg = "Update Successful!!!";
			echo "<script> alert('$msg'); window.location='view_purchases'</script>";
				if ($rem=='0'){
					$query6 = dbconnect()->prepare("UPDATE purchase SET status ='1' WHERE id=?");
					$query6->execute([$id]);				
				}elseif ($rem > 0 && $rem < $amt_due){
					$query6 = dbconnect()->prepare("UPDATE purchase SET status ='2' WHERE id=?");
					$query6->execute([$id]);
				}else {
                    
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
						<h6 class="mb-0 text-uppercase">Payment Update</h6>
						<hr/>
                            <?php

                            
                                if (isset($_SESSION['over'])) {?>
                                    <div class="attack"><?php
                                    echo $_SESSION['over'];?>
                                    </div>
                                <?php unset($_SESSION['over']);
                                }
                            
                            ?>
						<div class="card">
							<div class="card-body">
								<div class="p-4 border rounded">
									<form class="row g-3 needs-validation" method="POST" enctype="multipart/form-data" novalidate>

										<div class="col-md-7">
											<label for="validationCustom01" class="form-label">Item Name:</label>
											<input type="text" value="<?php echo $itm_name; ?>" class="form-control" id="validationCustom01" readonly>
										</div>

										<div class="col-md-5">
											<label for="validationCustom01" class="form-label">Supplier:</label>
											<input type="text" value="<?php echo $supplier; ?>" class="form-control" id="validationCustom01" readonly>
										</div>

										<div class="col-md-4">
											<label for="validationCustomUsername" class="form-label">Price:</label>
											<div class="input-group has-validation"> <span class="input-group-text" id="inputGroupPrepend">$</span>
                                                <input type="text" value="<?php echo $unit_price; ?>" class="form-control" id="validationCustom01" readonly>
											</div>
										</div>

                                        <div class="col-md-3">
											<label for="validationCustomUsername" class="form-label">Quantity:</label>
											    <input type="text" value="<?php echo $quantity; ?>" class="form-control" id="validationCustom01" readonly>
										</div>

                                        <div class="col-md-5">
											<label for="inputAddress" class="form-label">Reference Code:</label>
											    <input type="text" value="<?php echo $ref_code; ?>" class="form-control" id="validationCustom01" readonly>
										</div>
                                        
                                        <div class="col-md-3">
											<label for="validationCustomUsername" class="form-label">Tax Applied:</label>
                                            <div class="input-group has-validation"> <span class="input-group-text" id="inputGroupPrepend">$</span>
											    <input type="text" value="<?php echo $tax; ?>" class="form-control" id="validationCustom01" readonly>
                                            </div>
										</div>

                                        <div class="col-md-4">
											<label for="validationCustomUsername" class="form-label">Amount Paid:</label>
                                            <div class="input-group has-validation"> <span class="input-group-text" id="inputGroupPrepend">$</span>
											    <input type="text" value="<?php echo $amt_paid; ?>" class="form-control" id="validationCustom01" readonly>	
                                            </div>
										</div>

                                        <div class="col-md-5">
											<label for="validationCustomUsername" class="form-label">Amount Due:</label>
                                            <div class="input-group has-validation"> <span class="input-group-text" id="inputGroupPrepend">$</span>
											    <input type="number" value="<?php echo $amt_due; ?>" class="form-control"  oninput="minus()" id="amtdue" readonly>
                                            </div>
										</div>

                                        <div class="col-md-7">
											<label for="inputAddress" class="form-label">Current Payment:</label>
                                            <div class="input-group has-validation"> <span class="input-group-text" id="inputGroupPrepend">$</span>
											    <input type="number" placeholder="Enter the amount you want to pay..."  oninput="minus()" max="<?php echo $amt_due; ?>" name="pay_amt" class="form-control" id="payamt">
                                            </div>
                                        </div>

                                        <div class="col-md-5">
											<label for="inputAddress" class="form-label">Remaining Balance:</label>
											    <input type="text" class="form-control" oninput="minus()" name="rem" id="rem" readonly>
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





