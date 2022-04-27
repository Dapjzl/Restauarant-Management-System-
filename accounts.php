
<?php

include 'header.php';

?>


    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Accounts</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">View Accounts</li>
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
            <h6 class="mb-0 text-uppercase">Registered Account</h6>
            <hr/>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th width="1%">#</th>
                                    <th width="2%"></th>
                                    <th>Full Name</th>
                                    <th width="7%">Username</th>
                                    <th width="3%">Email</th>
                                    <th width="3%">Age</th>
                                    <th width="3%">Phone</th>
                                    <th width="3%">Role</th>
                                    <th width="3%">Status</th>
                                    <th width="5%">Date</th>
                                    <th width="3%">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php

                                 $sn=0;
                                 $query = "SELECT * FROM register WHERE NOT username = '$username' ORDER BY full_name";
                                 $data = mysqli_query($connect,$query);

                                 while($row = mysqli_fetch_assoc($data)) {
                                    $sn++;
                                    $id = $row['id'];
                                    $fullname = $row['full_name'];
                                    $age = $row['age'];
                                    $username = $row['username'];
                                    $phone = $row['phone'];
                                    $email = $row['email'];
                                    $admin_image = $row['admin_image'];
                                    $created = $row['created_on'];
                                    $status = $row['status'];
                                    $role_id = $row['role_id'];

                                $query2 = "SELECT * FROM role WHERE id='$role_id'";
                                $data2 = mysqli_query($connect,$query2);
                                $row =  mysqli_fetch_assoc($data2);
                                $role_name = $row['role_name'];
                            
                            ?>
                                <tr>
                                    <td><?php echo $sn; ?></td>
                                    <td class="product"><img src="assets/images/uploads_admin/<?php echo $admin_image; ?>"></td>
                                    <td><?php echo $fullname; ?></td>
                                    <td><?php echo $username; ?></td>
                                    <td><?php echo $email; ?></td>
                                    <td><?php echo $age; ?></td>
                                    <td><?php echo $phone; ?></td>
                                    <td><?php echo $role_name; ?></td>
                                    <td>
                                    
                                        <?php
                                        if ($status == '1') {
                                            ?><span class="badge bg-gradient-quepal text-white shadow-sm w-100"><?php
                                            echo "Online";
                                            ?></span><?php
                                        }elseif ($status == '2') {
                                            ?><span class="badge bg-gradient-blooker text-white shadow-sm w-100"><?php
                                            echo "Inactive";
                                            ?></span><?php
                                        }else {
                                            ?><span class="badge bg-gradient-bloody text-white shadow-sm w-100"><?php
                                            echo "Offline";
                                            ?></span><?php } ?>

                                    </td>
                                    <td><?php echo $created; ?></td>
                                    <td>
                                        <a href="account_update?id=<?php echo $id; ?>" class="green"><i class="bx bx-edit producticon"></i></a>
                                        <a href="del_account?id=<?php echo $id; ?>" onclick ="return confirm('Are you sure you want to delete account?')" class="red"><i class="bx bx-trash producticon"></i></a>
                                    </td>
                            <?php } ?>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th width="1%">#</th>
                                    <th width="2%"></th>
                                    <th>Full Name</th>
                                    <th width="7%">Username</th>
                                    <th width="3%">Email</th>
                                    <th width="3%">Age</th>
                                    <th width="3%">Phone</th>
                                    <th width="3%">Role</th>
                                    <th width="3%">Status</th>
                                    <th width="5%">Date</th>
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