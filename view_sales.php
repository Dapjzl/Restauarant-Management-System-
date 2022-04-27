
<?php

include 'header.php';

?>


    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Sales Records</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">View Sales</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!--end breadcrumb-->
            <h6 class="mb-0 text-uppercase">Sales datatable</h6>
            <hr/>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered" style="width:100%; font-size: 12px;">
                            <thead>
                                <tr>
                                    <th width="1%">#</th>
                                    <th width="10%">Customer Name</th>
                                    <th width="10%">Number</th>
                                    <th width="4%">Product Name</th>
                                    <th width="5%">Total</th>
                                    <th width="10%">Refrence Code</th>
                                    <th width="8%">Date</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php

                                 $sn=0;
                                 $query = "SELECT * FROM sales GROUP BY ref_code";
                                 $data = mysqli_query($connect,$query);

                                 while($row = mysqli_fetch_assoc($data)) {
                                    $sn++;
                                    $id = $row['id'];
                                    $cust_name = $row['cust_name'];
                                    $cust_number = $row['cust_number'];
                                    $prd_name = $row['prd_name'];
                                    $priceeach = $row['price'];
                                    $qtybought = $row['qty'];
                                    $total = $row['total'];
                                    $ref_code = $row['ref_code'];
                                    $created = $row['created_on'];

                            ?>
                                <tr>
                                    <td><?php echo $sn; ?></td>
                                    <td><?php echo $cust_name; ?></td>
                                    <td><?php echo $cust_number; ?></td>
                                    <td style="display: flex; justify-content: center; align-items: center;">
                                        <button id="modalBtn<?php echo $id; ?>" type="button" onclick="modalactive(<?php echo $id; ?>)" class="button-62">View details</button>

                                        <div id="simpleModal<?php echo $id; ?>" onclick="modalabtclsbody(<?php echo $id; ?>)" class="modalchange">
                                            <div class="modal-content" onclick="event.stopPropagation()">
                                                <div class="shadowing">
                                                    <div class="revit">
                                                        <span onclick="modalabtcls(<?php echo $id; ?>)" class="closeBtnX">&times;</span>
                                                        <div class="inline-it">
                                                            <img src="assets/images/logo-icon.png" alt="company_logo">
                                                            <h4 class="logo-text">Rocker</h4>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="modalbody">
                                                    <div class="headit">
                                                        <h6 class="h1modal">PURCHASE SUMMARY</h6>
                                                    </div>
                                                    <div class="mainbody">
                                                        <div class="custom_det">
                                                            <label for="Customer_name">Customer Name: </label>
                                                            <div class="custom_name"><?php echo $cust_name?></div>
                                                        </div>
                                                        <div class="custom_det">
                                                            <label for="Customer_name">Customer Number: </label>
                                                            <div class="custom_name"><?php echo $cust_number?></div>
                                                        </div>
                                                        <div class="card">
                                                            <div class="card-body">
                                                            <p style="text-align: center;">PRODUCT DETAILS</p>
                                                                <div class="table-responsive">
                                                                    <table id="example" class="table table-striped table-bordered" style="width:100%; font-size: 10px;">
                                                                        <thead>
                                                                            <tr>
                                                                                <th width="10%">S/N</th>
                                                                                <th width="40%">Product Name</th>
                                                                                <th width="25%"> Quantity</th>
                                                                                <th width="25%">Unit Price</th>
                                                                                <th width="10%">Total</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <?php
                                                                            $ntt = 0;
                                                                            $new_town = $connect->query("SELECT * FROM sales WHERE ref_code='$ref_code'");
                                                                                while ($brown=$new_town->fetch_array()) {
                                                                                    $ntt++;
                                                                                    $prod = $brown['prd_name'];
                                                                                    $price = $brown['price'];
                                                                                    $qty = $brown['qty'];
                                                                                    $totaft = $price * $qty;
                                                                            ?>
                                                                            <tr>
                                                                                <td width="4%"><?php echo $ntt;?></td>
                                                                                <td width="4%"><?php echo $prod;?></td>
                                                                                <td width="5%"><?php echo $qty;?></td>
                                                                                <td width="10%"><?php echo $price;?></td>
                                                                                <td width="10%"><?php echo $totaft;?></td>
                                                                            </tr>
                                                                            <?php } ?>
                                                                        </tbody>
                                                                        <tfoot>
                                                                            <tr>
                                                                                <th width="10%">S/N</th>
                                                                                <th width="40%">Product Name</th>
                                                                                <th width="25%"> Quantity</th>
                                                                                <th width="25%">Unit Price</th>
                                                                                <th width="10%">Total</th>
                                                                            </tr>
                                                                        </tfoot>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                            <div class="mnbdy_foot">
                                                               <?php echo $total;?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="revitdown">
                                                    <div class="copy_right">
                                                        2022 Hybridsoft Technologies
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td><?php echo $total; ?></td>
                                    <td><?php echo $ref_code; ?></td>
                                    <td><?php echo $created; ?></td>
                            <?php } ?>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th width="1%">#</th>
                                    <th width="10%">Customer Name</th>
                                    <th width="10%">Number</th>
                                    <th width="4%">Product Name</th>
                                    <th width="5%">Total</th>
                                    <th width="10%">Refrence Code</th>
                                    <th width="8%">Date</th>
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
      });
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

    
    
    
    function modalactive(ted){
        var simpleModal = document.getElementById('simpleModal'+ted);
        simpleModal.classList.add("showingit");
        simpleModal.classList.add("flexingit");
    }

    function modalabtcls(ted){
        var simpleModal = document.getElementById('simpleModal'+ted);
        simpleModal.classList.remove("showingit");
        simpleModal.classList.remove("flexingit");
    }
  
    function modalabtclsbody(ted){
        var simpleModal = document.getElementById('simpleModal'+ted);
        simpleModal.classList.remove("showingit");
        simpleModal.classList.remove("flexingit");
    }

    

    // $(document).ready(function(){
    //     let elementors = document.getElementsByClassName('tableid');
    //         $(elementors).children('div:first-child, div:nth-child(2)').removeClass('dont_show');
    // });
</script>
<!--app JS-->
</body>
</html>