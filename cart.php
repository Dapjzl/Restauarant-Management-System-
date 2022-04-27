<?php

include 'header.php';
include 'component.php';

?>

<?php
if (!isset($_SESSION['cartigo'])) {
    echo "<script>alert('Please add at least 1 product to access your cart!'); window.location='all_products';</script>";
    
}

    if (isset($_POST['remove'])) {
        if ($_GET['action'] == 'remove') {
            foreach ($_SESSION['cartigo'] as $key => $value) {
                if ($value['product_id'] == $_GET['id']) {
                    unset($_SESSION['cartigo'][$key]);
                    echo "<script>alert('Product has been Removed from cart...!'); window.location='all_products';</script>";
                }
            }
        }
    } 

?>



            
                    <?php
                    if (count($_SESSION['cartigo'])<'1') {
                        $_SESSION['noadd'] = "<div class=''>No Item Added Yet</div>";?>

                        
                        <div class="page-content animate__bounce animate__animated animate__slow" id="rain">
                            <div class="page-wrapper what">
                                <h1 style="position: relative; top: -50px;">Oops!!!</h1>
                                <div class="create" style="display: flex; justify-content: center; align-items: center;">
                                <div class="content">
                                    <div class="content__container">
                                        
                                        
                                        <ul class="content__container__list">
                                        <li class="content__container__list__item">Welcome, <span class="text-success"><?php echo $username; ?></span></li>
                                        <li class="content__container__list__item">No Item Is In Your <span class="text-danger">Cart</span>.</li>
                                        <li class="content__container__list__item"><span>Check out list of <a href="all_products">products</a></span></li>
                                        <li class="content__container__list__item"><span class="text-warning">View</span> Discount Vouchers.😋</li>
                                        </ul>
                                    </div>
                                    </div>
                                </div>
                                <div class="magichappens animate__animated animate__delay-1s animate__slow animate__infinite animate animate__swing">

                                <?php
                    
                                    if (isset($_SESSION['noadd'])) {
                                        echo $_SESSION['noadd'];
                                        unset($_SESSION['noadd']);
                                    }
                                
                                ?>

                               
                            
                            </div>
                        </div>
                    <?php }else {?>
                    <div class="page-content">
                        <div class="page-wrapper">
                            <div class="row">

                                <div class="col-md-7">

                                    <div class="col-xl-9 mx-auto third-design">
                                            <h6 class="mb-0 text-uppercase">Cart Items display</h6>
                                            <hr/>
                                    </div>
                                    <div class="col-md-11 mx-auto mt-10 second-design">
                                        <?php
                                        $total = 0;
                                            $product_id=array_column($_SESSION['cartigo'], 'product_id');
                                            $sql123 = "SELECT * FROM products";
                                            $result12 = mysqli_query($connect, $sql123);
                                            while($rowtate = mysqli_fetch_assoc($result12)){
                                                foreach ($product_id as $idle) {
                                                    if ($rowtate['id'] == $idle) {
                                                        cartElement($rowtate['prd_image'], $rowtate['prd_name'], $rowtate['price'], $rowtate['supplier'], $rowtate['qty'], $rowtate['id']);
                                                        $total = $total + (int)$rowtate['price'];
                                                    }
                                                }
                                            }
                                        

                                        ?>

                                    </div>
                                </div>

                                <div class="col-md-5 border rounded mt-5 h-25"> 
                                    <div class="col-xl-10 mx-auto">
                                        <h6 class="mb-0 text-uppercase" style="margin-top: 20px;">Cart Items Summary</h6>
                                        <hr/>
                                           <div class="row price-details">

                                               <div class="col-md-7">
                                                    <?php
                                                    
                                                        if (isset($_SESSION['cartigo'])) {
                                                            $count = count($_SESSION['cartigo']);
                                                            if ($count=="1") {
                                                                echo "<h6>Price: $count item</h6>";
                                                            }else {
                                                                echo "<h6>Price: $count item(s)</h6>";
                                                            }
                                                            
                                                        }else {
                                                            echo "<h6>Price(0 item(s))</h6>";
                                                        }
                                                    
                                                    ?>
                                                    <h6>Discount</h6>
                                                    <hr>
                                                    <h6>Amount Payable</h6>
                                               </div>

                                               <div class="col-md-5">
                                                   <h6><?php echo "<div>$$total".".00</div>"; ?></h6>
                                                   <h6 class="text-warning">NONE</h6>
                                                   <hr>
                                                   <h6 class="text-success">
                                                       <?php
                                                       
                                                        echo "<div>$$total".".00</div>";
                                                       
                                                       ?>
                                                   </h6>
                                               </div>

                                           </div> 
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <?php } ?>

                    
               

















                    <script>

// var data = 0;
//   var counter = document.getElementById('final').innerText=data;
// function add(){

//     // var id = this.attr(id);
//     // console.log(this);
//     data=data+1;
//     var counter = document.getElementById('final').value=data;
//     console.log(data);
// }


</script>


<?php

include 'footer.php';

?>

<script>


    function add(id, price){
      

      var counter = document.getElementById('final'+id).value;
      counter = ++ counter ;
      document.getElementById('final'+id).value=counter;
      multiply(id, price)
      
  }
  function subtract(id, price){
      

      var counter = document.getElementById('final'+id).value;
      counter = -- counter ;
      document.getElementById('final'+id).value=counter;
      multiply(id, price)
      
  }
  

  function multiply(id, price) {
      var counter = document.getElementById('final'+id).value;
      var totalprice = document.getElementById('totprice'+id);
      if (counter>0) {
          totalprice.innerHTML = '$'+price*counter;
      }else{
          totalprice.innerHTML = 0*price;
      }
      
      
  }
</script>


