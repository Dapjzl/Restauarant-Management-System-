
<?php

include 'header.php';

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
                            <li class="breadcrumb-item active" aria-current="page">View Products</li>
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
            <h6 class="mb-0 text-uppercase">Product datatable</h6>
            <hr/>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example2" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th width="1%">S/N</th>
                                    <th width="2%"></th>
                                    <th>Product Name</th>
                                    <th width="7%">Category</th>
                                    <th width="3%">Unit</th>
                                    <th width="3%">Price</th>
                                    <th width="3%">Quantity</th>
                                    <th width="5%">Date Created</th>
                                    <th width="5%">Last Update</th>
                                    <th width="3%">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php

                                 $sn=0;
                                 $query = "SELECT * FROM products WHERE qty='0' ORDER BY prd_name";
                                 $data = mysqli_query($connect,$query);

                                 while($row = mysqli_fetch_assoc($data)) {
                                    $sn++;
                                    $id = $row['id'];
                                    $prdname = $row['prd_name'];
                                    $ctg = $row['cat_id'];
                                    $unit = $row['unit'];
                                    $price = $row['price'];
                                    $qty = $row['qty'];
                                    $prd_image = $row['prd_image'];
                                    $created = $row['created_on'];
                                    $updated = $row['updated_on'];

                                $query2 = "SELECT category_name FROM category WHERE id='$ctg'";
                                $data2 = mysqli_query($connect,$query2);
                                $row =  mysqli_fetch_assoc($data2);
                                $cat_name = $row['category_name'];
                            
                                $query3 = "SELECT unit_name FROM unit WHERE id='$unit'";
                                $data3 = mysqli_query($connect,$query3);
                                $row =  mysqli_fetch_assoc($data3);
                                $unit_name = $row['unit_name'];
                            ?>
                                <tr>
                                    <td><?php echo $sn; ?></td>
                                    <td class="product"><img src="assets/images/uploads/<?php echo $prd_image; ?>"></td>
                                    <td><?php echo $prdname; ?></td>
                                    <td><?php echo $cat_name; ?></td>
                                    <td><?php echo $unit_name; ?></td>
                                    <td><?php echo $price; ?></td>
                                    <td><?php echo $qty; ?></td>
                                    <td><?php echo $created; ?></td>
                                    <td><?php echo $updated; ?></td>
                                    <td>
                                        <a href="view_single?id=<?php echo $id; ?>" class="blue"><i class="bx bx-show producticon"></i></a>
                                        <a href="update_product?id=<?php echo $id; ?>" class="green"><i class="bx bx-edit producticon"></i></a>
                                        <a href="del_product?id=<?php echo $id; ?>"  onclick ="return confirm('Are you sure you want to delete product?')" class="red"><i class="bx bx-trash producticon"></i></a>
                                    </td>
                            <?php } ?>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th width="1%">S/N</th>
                                    <th width="2%"></th>
                                    <th>Product Name</th>
                                    <th width="7%">Category</th>
                                    <th width="3%">Unit</th>
                                    <th width="3%">Price</th>
                                    <th width="3%">Quantity</th>
                                    <th width="5%">Date Created</th>
                                    <th width="5%">Last Update</th>
                                    <th width="3%">Actions</th>
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