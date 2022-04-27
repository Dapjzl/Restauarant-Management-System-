
<?php

include 'header.php';

?>


    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Purchase</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">View Purchases</li>
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
            <!-- <h6 class="mb-0 text-uppercase">Purchases Made</h6> -->
            <hr/>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered" style="width:100%; font-size: 12px;">
                            <thead>
                                <tr>
                                    <?php
                                    
                                    $sn=0;
                                    $query1 = "SELECT * FROM purchase WHERE id='$id'";
                                    $data1 = mysqli_query($connect,$query1);
                                    $rowe = mysqli_fetch_assoc($data1);
                                    ?>
                                    <th width="2%">#</th>
                                    <th>Item Name</th>
                                    <th width="30%">Supplier</th>
                                    <th width="3%">Unit Price</th>
                                    <th width="3%">Qty</th>
                                    <th width="7%">Paid</th>
                                    <th width="7%">Due</th>
                                    <th width="5%">Refrence Code</th>
                                    <th width="4%">Status</th>
                                    <th width="5%">Date Created</th>
                                    <th width="4%">Act</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php

                                 $sn=0;
                                 $query = "SELECT * FROM purchase ORDER BY id";
                                 $data = mysqli_query($connect,$query);

                                 while($row = mysqli_fetch_assoc($data)) {
                                    $sn++;
                                    $id = $row['id'];
                                    $item = $row['item'];
                                    $supplier = $row['supplier'];
                                    $unit_price = $row['price'];
                                    $quantity = $row['qty'];
                                    $due = $row['amount_due'];
                                    $paid = $row['amount_paid'];
                                    $ref_code = $row['ref_code'];
                                    $status = $row['status'];
                                    $created = $row['created'];
                                
                            
                            ?>
                                <tr>
                                    <td><?php echo $sn; ?></td>
                                    <td><?php echo $item; ?></td>
                                    <td width="13%"><?php echo $supplier; ?></td>
                                    <td><?php echo $unit_price; ?></td>
                                    <td><?php echo $quantity; ?></td>
                                    <td><?php echo $paid; ?></td>
                                    <td><?php echo $due; ?></td>
                                    <td><?php echo $ref_code; ?></td>
                                    <td>
                                        <?php
                                        if($status=="1") {
                                         echo '<span class="badge bg-gradient-quepal text-white shadow-sm w-100">Paid</span>';   
                                        }elseif($status=="2") {
                                            echo '<span class="badge bg-gradient-blooker text-white shadow-sm w-100">Partly Paid</span>';   
                                        }elseif($status=="0") {
                                            echo '<span class="badge bg-gradient-bloody text-white shadow-sm w-100">Not Paid</span>';   
                                        }
                                         
                                        ?>
                                    </td>
                                    <td><?php echo $created; ?></td>
                                    <td>
                                        <?php
                                        if ($status=="1") {?>
                                            <div style="height: 18px;" class="btn btn-primary badge text-white shadow-sm w-100"><i class="lni">✔</i></div>
                                        <?php }
                                        else {?>
                                            <a style="height: 18px;" href="purchase_payment?id=<?php echo $id; ?>" class="btn btn-primary badge text-white shadow-sm w-100"><i class=" lni lni-amazon-pay"></i></a>
                                        <?php } ?>
                                    </td>
                            <?php } ?>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th width="2%">SN</th>
                                    <th>Item Name</th>
                                    <th width="10%">Supplier</th>
                                    <th width="4%">Unit Price</th>
                                    <th width="4%">Quantity</th>
                                    <th width="7%">Paid</th>
                                    <th width="7%">Due</th>
                                    <th width="5%">Refrence Code</th>
                                    <th width="4%">Status</th>
                                    <th width="5%">Date</th>
                                    <th width="4%">Act</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end page wrapper -->
    <!--start overlay-->
    <div class="overlay toggle-icon"></div>
    <!--end overlay-->
    <!--Start Back To Top Button--> <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
    <!--End Back To Top Button-->
    <footer class="page-footer">
        <p class="mb-0">Copyright © 2021. All right reserved.</p>
    </footer>
</div>
<!--end wrapper-->

<?php

include 'footer.php';

?>




<script>
    $(document).ready(function() {
        $('#example').DataTable();
      } );
</script>
<script>
    $(document).ready(function() {
        var table = $('#example2').DataTable( {
            lengthChange: false,
            buttons: [ 'copy', 'excel', 'pdf', 'print']
        } );
     
        table.buttons().container()
            .appendTo( '#example2_wrapper .col-md-6:eq(0)' );
    } );
</script>
<!--app JS-->
</body>
</html>