<?php
session_start();
include('header.php');
include('config/dbcon.php');
?>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<style>
</style>
    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="./index.php"><i class="fa fa-home"></i> Home</a>
                        <span>Shopping cart</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->
    <!-- Shop Cart Section Begin -->
    <section class="shop-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="shop__cart__table">
                        <?php if(isset($_SESSION['cart_unique_id'])){
                            $cart_unique_id=$_SESSION['cart_unique_id'];
                            $query_for_cart_for_check="SELECT * FROM cart_item WHERE cart_unique_id='$cart_unique_id'";
                            $query_for_cart_id_check_run=mysqli_query($conn,$query_for_cart_for_check);
                            if(mysqli_num_rows($query_for_cart_id_check_run)>0){?>
                        <table>
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                // if(isset($_SESSION['cart_unique_id'])){

                                   $cart_unique_id=isset($_SESSION['cart_unique_id'])?$_SESSION['cart_unique_id']:null;
                                    $query_for_cart_id="SELECT * FROM cart_item WHERE cart_unique_id='$cart_unique_id'";
                                    $query_for_cart_id_run=mysqli_query($conn,$query_for_cart_id);
                                    if(mysqli_num_rows($query_for_cart_id_run)>0){
                                        while($row=mysqli_fetch_assoc($query_for_cart_id_run)){

                                            $product_id=$row['product_id'];
                                            $subtotal=$row['final_total'];
                                        
                                    $query="SELECT * FROM product_details WHERE product_id='$product_id'";
                                    $query_run=mysqli_query($conn,$query);
                                    if(mysqli_num_rows($query_run)>0){
                                        while($product=mysqli_fetch_assoc($query_run)){
                                            $price=$product['product_price'];

                                            if(!empty($row['flat_discount']) && empty($row['discount_by_percentage']) ){
                                                $subtotal= intval($price) - $row['flat_discount'];

                                            }else if(!empty($row['discount_by_percentage']) && empty($row['flat_discount'])){
                                                $subtotal_in_per= intval($price) * ($row['discount_by_percentage'] / 100);
                                                $subtotal= intval($price) - $subtotal_in_per;
                                            }else{
                                                $subtotal=ceil($price);
                                            }
                                            ?>       
                                <tr>
                                    <td class="cart__product__item">
                                    <img class="product-id" width="90px" height="90px" src="adminpanel/image/<?php echo $product['product_image']; ?>" alt="<?php echo $row['cart_item_id']; ?>">
                                        <div class="cart__product__item__title">
                                            <h6><?php echo $product['product_name']; ?></h6>
                                            <div class="rating">
                                                <?php
                                                $productId=$row['product_id'];

                                                include('display_review.php');
                                                 ?>
                                            </div>
                                        </div>
                                    </td>
                                    <td value="<?php echo ceil($subtotal); ?>"><span class="price"><?php echo $product['price_currency'] ?></span>&nbsp;<span class="cart__price"><?php echo ceil($subtotal); ?> </span>
                                    <?php $product_price_actual=$product['product_price'];
                                     if($product_price_actual == $subtotal){?>
                                     <input type="hidden" value="<?php echo $product_price_actual; ?>" id="actual_price">
                                    </td>
                                     <?php
                                     }else{ ?>
                                    <p><span><?php echo $product['price_currency'] ?></span><del class="original_price"><?php echo $product_price_actual=$product['product_price'];
                                     ?></del></p></td>
                                     <?php
                                     }  ?>
                                    <td class="cart__quantity">
                                        <div class="pro-qty">
                                        <span onclick="removevalue(this)" class="dec qtybtn bg-white">-</span>
                                            <input disabled type="text" class="getvalue bg-white" value="<?php echo $row['product_quantity']; ?>">
                                            <span onclick="addvalue(this)" class="inc qtybtn">+</span>
                                        </div>
                                    </td>
                                    <td class="cart__total"><?php echo $subtotal; ?></td>
                                    <td class="cart__close" onclick="removeProduct(<?php echo $row['cart_item_id']; ?>,'<?php echo $cart_unique_id; ?>')" ><span class="icon_close"></span></td>
                                </tr>
                                
                                <?php
                                      }  }  }
                                    }
                                // }
                                ?>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="cart__btn">
                        <a href="shop.php">Continue Shopping</a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="discount__content">
                        <h6>Discount codes</h6>
                        <form action="#">
                            <input type="text" placeholder="Enter your coupon code">
                            <button type="submit" class="site-btn">Apply</button>
                        </form>
                    </div>
                </div>

                <div class="col-lg-4 offset-lg-2">
                    <div class="cart__total__procced">
                        <h6 class="text-center">Cart total</h6>
                        <ul>
                            <li class="subtotal_without_disocunt"> <span></span></li>
                            <li class="shippingcharges">Shipping charges = 0 <span></span></li>
                            <li class="tax">Tax = 0 <span></span></li>
                            <li class="total">Total <span></span></li>
                        </ul>
                        <a href="checkout.php?cart_unique_id=<?php echo isset($_SESSION['cart_unique_id'])?$_SESSION['cart_unique_id']:''; ?>" class="primary-btn">Proceed to checkout</a>
                    </div>
                </div>
            </div>
            <?php }else{?>
                <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="cart__btn">
                        <a href="shop.php">Add Product in cart</a>
                    </div>
                </div>
            </div>
                <?php

            } }else{ ?>
                <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="cart__btn">
                        <a href="shop.php">Add Product in cart</a>
                    </div>
                </div>
            </div> <?php } ?>

        </div>
    </section>
    <!-- Shop Cart Section End -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>
    function addvalue(btn) {
        let changevalue = $(btn).siblings('.getvalue');
        let newValue = parseInt(changevalue.val()) + 1;
        changevalue.val(newValue);
        updateTotals();
    }

    function removevalue(btn) {
        let changevalue = $(btn).siblings('.getvalue');
        let newValue = parseInt(changevalue.val()) - 1;
        if (newValue >= 1) {
            changevalue.val(newValue);
            updateTotals();
        }
    }

    $(document).ready(function() {
    updateTotals();

    $('.getvalue').on('input', function() {
        updateTotals(); 
    });
});

function updateTotals() {
    let totalSum = 0;
    let totalSum_for_subtotal = 0;
    let cartDetails = [];
    $('.shop__cart__table tbody tr').each(function() {
        let row = $(this);
        let quantity = parseInt(row.find('.getvalue').val());
        let product_id = row.find('.cart__product__item img').attr('alt');  
        let subtotal = parseFloat(row.find('.cart__price').text()); 
        let original = parseFloat(row.find('.original_price').text());
        if(isNaN(original)){
        original = row.find('#actual_price').val();
        }
        let total = subtotal * quantity;
        let subtotal_price = original * quantity;
        row.find('.cart__total').text('₹ ' + total.toFixed(2));
        totalSum += total;
        totalSum_for_subtotal += subtotal_price;

        cartDetails.push({
            'original_price':original,
            'product_id': product_id,
            'quantity': quantity,
            'subtotal': subtotal_price,
            'total': total,
        });
    });
    $.ajax({
        url: 'update_session_totals.php',
        type: 'POST',
        data: {
            cartDetails: JSON.stringify(cartDetails),
            totalSum: totalSum,
            totalSum_for_subtotal: totalSum_for_subtotal
        },
        success: function(response) {
        // Parse JSON response
        var responseData = JSON.parse(response);

        // Handle the response if needed
        if (responseData.success) {
            console.log('Update successful');
        } else {
            console.error('Update failed:', responseData.error);
        }
    }
});
    
    $('.subtotal').text('₹ ' + totalSum_for_subtotal.toFixed(2));
    $('.subtotal_without_disocunt').text('Subtotal= ₹ ' + totalSum.toFixed(2));
    $('.total').text('Total= ₹ ' + totalSum.toFixed(2));

}

    function removeProduct(cart_item_id ,cart_unique_id) {
        let removecartitemId = cart_item_id;
        let cartuniqueid = cart_unique_id;
        $.ajax({
            url: 'remove_from_cart.php',
            type: 'POST',
            data: {cart_item_id: removecartitemId , 
                cart_unique_id: cartuniqueid
            },
            success: function(response) {
                location.reload();
            }
        });
    }
</script>

<?php include('footer.php');?>

