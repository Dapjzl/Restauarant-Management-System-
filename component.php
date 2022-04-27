

<?php

function cartElement($product_img, $product_name, $product_price, $product_supplier, $product_qty, $productid){
    $element="

    <form action=\"cart?action=remove&id=$productid\" method=\"POST\" class=\"cart-items\">
                        <div class=\"border rounded\">
                            <div class=\"row bg-white p-3\">
                                <div class=\"mydesign\">
                                    <img src=\"assets/images/uploads/$product_img\" class=\"img-fluid img-battalion\">
                                </div>
                                <div class=\"col-md-8 fourth-design mergeain\">
                                    <h5 class=\"pt-2\">$product_name</h5>
                                    <p class=\"text-secondary p-2\" style=\"margin-bottom: -7px;\">Supplier: $product_supplier <span style=\"border-left: 2px solid black; padding:2px;\"> In-stock: $product_qty</span></p>
                                    <small class=\"pt-2 mx-2\" style=\"margin-bottom: 10px;\">Price:</small><p class=\"d-inline\"><b id=\"totprice$productid\">$$product_price</b></p>
                                    <div>
                                    <button type=\"button\" onClick=\"add($productid, $product_price)\" id=\"increase$productid\" class=\"rounded-circle w-10 d-inline bordercol increment-btn\"><small><i class=\"bx bx-plus mx-auto\"></i></small></button>
                                    <input type=\"text\" id=\"final$productid\" oninput=\"multiply($productid, $product_price)\" class=\"form-control w-25 d-inline counter\" style=\"height: 25px; font-size: 12;\" value=\"1\">
                                    <button type=\"button\" onClick=\"subtract($productid, $product_price)\" id=\"decrease$productid\" class=\"rounded-circle w-10 d-inline bordercol\"><small><i class=\"bx bx-minus mx-auto\"></i></small></button>
                                    </div>
                                    <!-- <button type=\"submit\" class=\"btn btn-warning\">Buy Later</button> -->
                                    <button type=\"submit\" class=\"btn btn-danger rangerrick\" onclick=\"return confirm('Are you sure you want to remove?')\" style=\"float: right;\" name=\"remove\">Remove</button>
                                </div>
                            </div>
                        </div>
                    </form>
    ";
    echo $element;
}

?>
