<?php
include('config/dbcon.php');

date_default_timezone_set('Asia/Kolkata');
$current_time = date("Y-m-d h:i A");

$query_for_discount = "SELECT * FROM discount WHERE (FIND_IN_SET('$productId',product_id) OR category_id='$category_id') AND ('$current_time' BETWEEN discount_start_time AND discount_end_time)";

$query_for_discount_run = mysqli_query($conn, $query_for_discount);
if ($query_for_discount_run) {
    if (mysqli_num_rows($query_for_discount_run) > 0) {
        while ($discount_product = mysqli_fetch_assoc($query_for_discount_run)) {
            if (isset($discount_product['flat_discount']) !== null  && $discount_product['discount_by_percentage'] == null) {
                $price = intval($product['product_price']);
                $total = $price - intval($discount_product['flat_discount']);
                $flat_discount = $discount_product['flat_discount'];
                $percentage_discount = '';
            } else if ($discount_product['discount_by_percentage'] !== null && $discount_product['flat_discount'] == null) {
                $price = intval($product['product_price']);
                $percentage = $price * (intval($discount_product['discount_by_percentage']) / 100);
                $total = $price - $percentage;
                $percentage_discount = $discount_product['discount_by_percentage'];
                $flat_discount = '';
            } else {
                $price = intval($product['product_price']);
                $total = $price;
                $flat_discount = '';
                $percentage_discount = '';
            }
            if (!empty($flat_discount) && empty($percentage_discount)) { ?>
                <h6 style="color: black; font-weight:200;"><?php echo $product['price_currency']  ?> <?php echo ceil($total) ?>
                    <span class="text-secondary"> <del><?php echo $product['price_currency']; ?> <?php echo ceil($price) ?></del></span>
                    <p class="text-danger" style="font-size: small;"><?php echo $product['price_currency']  ?><?php echo intval($flat_discount) ?> OFF</p>
                <?php } else if (!empty($percentage_discount) && empty($flat_discount)) { ?>
                    <h6 style="color: black; font-weight:200;"><?php echo $product['price_currency']  ?> <?php echo ceil($total) ?>
                        <span class="text-secondary"> <del><?php echo $product['price_currency']; ?> <?php echo ceil($price) ?></del> </span>
                        <p class="text-danger " style="font-size: small;"><?php echo intval($percentage_discount) ?>% OFF</p>
                    <?php } else { ?>
                        <h6 style="color: black; font-weight:200;"><?php echo $product['price_currency']  ?> <?php echo ceil($total) ?>
                        </h6>
                <?php }
            }
        } else {
                ?>
                <h6 style="color: black; font-weight:200;"><?php echo $product['price_currency']  ?> <?php echo ceil($product['product_price']) ?></h6>
        <?php }
    } else {
        echo "Error executing discount query: " . mysqli_error($conn);
    }
        ?>