<?php
include('authentication.php');
include('config/dbcon.php');
include('includes/header.php');
include('includes/navbar.php');
include('includes/sidebar.php');
?>

<div class="content-wrapper">
    <?php if(isset($_GET['cart_id'])){ ?>
    <section class="content pt-3">
        <div class="d-flex">
            <div class="container-fluid table-container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card mt-2">
                            <div class="card-header">
                                <h3 class="card-title">Order details</h3>
                                
                            </div>
                            <div class="card-body">
                                <table id="example1" class=" table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Product details</th>
                                            <th>Product Price</th>
                                            <th>Product Quantity</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (isset($_GET['cart_id'])) {
                                            $cart_id = $_GET['cart_id'];
                                            $query_for_unique_id = "SELECT * FROM cart WHERE cart_id='$cart_id'";
                                            $query_for_unique_id_run = mysqli_query($conn, $query_for_unique_id);
                                            if (mysqli_num_rows($query_for_unique_id_run) > 0) {
                                                while ($cart_unique = mysqli_fetch_assoc($query_for_unique_id_run)) {
                                                    $cart_unique_id = $cart_unique['cart_unique_id'];
                                                    $_SESSION['final_total'] = $cart_unique['final_total'];
                                                    $query = "SELECT * FROM cart_item WHERE cart_unique_id='$cart_unique_id'";
                                                    $query_run = mysqli_query($conn, $query);

                                                    $no = 0;
                                                    if (mysqli_num_rows($query_run) > 0) {
                                                        while ($row = mysqli_fetch_assoc($query_run)) {
                                                            $final_price = $row['final_total'];
                                                            $quantity = $row['product_quantity'];
                                                            $singlr_product_price = $final_price / $quantity;
                                                            $product_id = $row['product_id'];
                                                            $query_for_name = "SELECT * FROM product_details WHERE product_id='$product_id'";
                                                            $query_for_name_run = mysqli_query($conn, $query_for_name);
                                                            if (mysqli_num_rows($query_for_name_run) > 0) {
                                                                while ($name = mysqli_fetch_assoc($query_for_name_run)) {
                                                                    $no++;
                                        ?>
                                                                    <tr>
                                                                        <td>
                                                                            <b> <?php echo ucfirst($name['product_name']);  ?></b><br>
                                                                            <span class="color">Color: </span><span class="font-color"><?php echo $row['product_color']; ?></span><br>
                                                                            <span class="color">Size: </span><span class="font-color"><?php echo $row['product_size']; ?></span>
                                                                        </td>
                                                                        <td>₹ <?php echo $singlr_product_price; ?></td>
                                                                        <td><?php echo $row['product_quantity']; ?></td>
                                                                        <td>₹ <?php echo $row['final_total']; ?></td>

                                                                    </tr>

                                        <?php
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }  ?>
                                    </tbody>
                                </table>
                                <div class="flex">
                                    <div class="total">
                                        <b> Subtotal: </b><br>
                                        <b> Shipping Charges: </b><br>
                                        <b> Tax: </b><br>
                                        <b> Final Amount:</b>
                                    </div>
                                    <div class="amount">
                                        ₹ <?php echo $_SESSION['final_total']; ?> <br>
                                        ₹ <?php echo 0; ?> <br>
                                        ₹ <?php echo 0; ?> <br>
                                        ₹ <?php echo $_SESSION['final_total']; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
            <div class="container-fluid table-container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card mt-2">
                            <div class="card-header">
                                <h3 class="card-title">Customer Details</h3>
                            </div>
                            <div class="card-body">
                                <?php
                                $cart_id = $_GET['cart_id'];
                                $query = "SELECT * FROM cart WHERE cart_id='$cart_id'";
                                $query_run = mysqli_query($conn, $query);
                                $no = 0;

                                if (mysqli_num_rows($query_run) > 0) {
                                    while ($row = mysqli_fetch_assoc($query_run)) {
                                        $confirm_order = !empty($row['order_confirm']) ? $row['order_confirm'] : "";

                                        if ($confirm_order == "done") {
                                            $cart_unique_id = $row['cart_unique_id'];
                                            $no++;
                                            $address_id = $row['address'];
                                            if (!empty($address_id)) {
                                                $query_for_address = "SELECT * FROM address WHERE address_unique_id='$address_id'";
                                                $query_for_address_run = mysqli_query($conn, $query_for_address);

                                                if (mysqli_num_rows($query_for_address_run) > 0) {
                                                    while ($address_details = mysqli_fetch_assoc($query_for_address_run)) { ?>
                                                        <div>
                                                            <b> Name:</b><span class="color-code"> <?php echo $address_details['billing_name']; ?> </span>
                                                        </div>
                                                        <hr>
                                                        <div>

                                                            <b>Billing Details:</b> <br>

                                                            <div class="color-code">
                                                                <?php echo ucfirst($address_details['billing_address']); ?><br>

                                                                <?php echo $address_details['billing_city']; ?> , <?php echo $address_details['billing_zipcode'] ?><br>
                                                                <?php echo $address_details['billing_state']; ?> ,
                                                                <?php echo $address_details['billing_country']; ?><br>
                                                            </div>
                                                            <br>
                                                            <b>Contact Info: </b><br>
                                                            <div class="color-code">
                                                            <i class="fa fa-envelope"></i>&nbsp;&nbsp;&nbsp;<?php echo $address_details['billing_email'] ; ?> <br>
                                                            <i class="fa fa-phone"></i>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $address_details['billing_phone_no'] ; ?>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <!-- <br> -->
                                                        <div>

                                                            <b>Shipping Details:</b> <br>

                                                            <div class="color-code">
                                                                <?php echo empty($address_details['shipping_address']) ?  ucfirst($address_details['billing_address']) : ucfirst($address_details['shipping_address']) ?><br>


                                                                <?php echo empty($address_details['shipping_city']) ?  $address_details['billing_city'] : $address_details['shipping_city'] ?> , <?php echo empty($address_details['shipping_zipcode']) ?  $address_details['billing_zipcode'] : $address_details['shipping_zipcode'] ?><br>
                                                                <?php echo empty($address_details['shipping_state']) ?  $address_details['billing_state'] : $address_details['shipping_state'] ?> , <?php echo empty($address_details['shipping_country']) ?  $address_details['billing_country'] : $address_details['shipping_country'] ?>

                                                            </div>
                                                            <br>
                                                            <b>Contact Info: </b><br>
                                                            <div class="color-code">
                                                            <i class="fa fa-envelope"></i>&nbsp;&nbsp;&nbsp;<?php echo empty($address_details['shipping_email']) ?  $address_details['billing_email'] : $address_details['shipping_email'] ?> <br>
                                                            <i class="fa fa-phone"></i>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo empty($address_details['shipping_phone']) ?  $address_details['billing_phone_no'] : $address_details['shipping_phone'] ?>
                                                            </div>       
                                                        </div>
                                <?php   }
                                                }
                                            }
                                        }
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
<?php } ?>
</div>
<?php include('includes/footer.php'); ?>