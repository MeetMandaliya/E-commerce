<?php
include('config/dbcon.php');
session_start();

if (isset($_GET['product_id']) && isset($_GET['quantity'])) {
    $productId = $_GET['product_id'];

    $transaction_id = isset($_GET['confirm_product_id']) ? $_GET['confirm_product_id'] : null;
    $product_quantity = $_GET['quantity'];
    $product_price = $_GET['price'];
    $product_color = isset($_GET['color']) ? $_GET['color'] : null;
    $product_size = isset($_GET['size']) ? $_GET['size'] : 'M';
    $subtotal = intval($product_price) * intval($product_quantity);
    $total = $subtotal;
    $flat_discount = $_GET['flat_discount'];
    $discount_by_percentage = $_GET['discount_by_percentage'];
    $final_total = $_GET['total'];
    $shipping_charges = null;
    $tax = null;

    if (!isset($_SESSION['first_time'])) {  
        $cart_unique_id = uniqid();                         
        // Insert data into the cart table
        $cart_table_query = "INSERT INTO `cart` (cart_unique_id, product_id, product_quantity, product_color, product_size, product_price, total, subtotal, final_total, created_time, transaction_id) VALUES ('$cart_unique_id', '$productId', '$product_quantity', '$product_color', '$product_size', '$product_price', '$total', '$subtotal', '$final_total', current_timestamp(), '$transaction_id')";
        $cart_table_query_run = mysqli_query($conn, $cart_table_query);

        if (!$cart_table_query_run) {
            echo "Error inserting data into the cart table: " . mysqli_error($conn);
            exit;
        }
        $_SESSION['first_time'] = true;
        $_SESSION['cart_unique_id'] = $cart_unique_id;
    } else {

        $cart_unique_id = $_SESSION['cart_unique_id'];

        // Update the total and subtotal in the cart table
        $_SESSION['first_time'];
        $update_cart_query = "UPDATE `cart` SET subtotal = subtotal + '$subtotal', total = total + '$total', final_total = final_total + '$final_total' WHERE cart_unique_id = '$cart_unique_id'";
        $update_cart_query_run = mysqli_query($conn, $update_cart_query);

        if (!$update_cart_query_run) {
            echo "Error updating cart table: " . mysqli_error($conn);
            exit;
        }
    }
    $query_for_check="SELECT * FROM cart WHERE cart_unique_id='$cart_unique_id' AND product_id='$productId'";
    $query_for_check_run=mysqli_query($conn,$query_for_check);
    if(mysqli_num_rows($query_for_check_run) > 0){
        $query_for_update_quantity="UPDATE cart_item SET product_quantity='$product_quantity' WHERE product_id='$productId' AND cart_unique_id='$cart_unique_id'";
        $query_for_update_quantity_run=mysqli_query($conn,$query_for_update_quantity);
        if (!$query_for_update_quantity_run) {
            echo "Error inserting data into the cart_item table: " . mysqli_error($conn);
            exit;
        }
    }
    // if (isset($_SESSION['cart_product_details'])) {
    //     echo 'Existing session is set.<br>';
    //     if (
    //         isset($_SESSION['cart_product_details']['cart_unique_id']) &&
    //         isset($_SESSION['cart_product_details']['product_id']) &&
    //         $_SESSION['cart_product_details']['cart_unique_id'] == $cart_unique_id &&
    //         $_SESSION['cart_product_details']['product_id'] == $productId
    //     ) {
    //         echo 'Updating product_quantity in existing session.<br>';
    //         $_SESSION['cart_product_details']['product_quantity'] = $product_quantity;
    //     } else {
    //         echo 'Creating a new session.<br>';
    //         $product_details = array(
    //             'cart_unique_id' => $cart_unique_id,
    //             'product_id' => $productId,
    //             'product_quantity' => $product_quantity,
    //             'product_color' => $product_color,
    //             'product_size' => $product_size,
    //             'product_price' => $product_price,
    //             'subtotal' => $subtotal,
    //             'total' => $total,
    //             'final_total' => $final_total,
    //             'flat_discount' => $flat_discount,
    //             'discount_by_percentage' => $discount_by_percentage,
    //             'shipping_charges' => $shipping_charges,
    //             'tax' => $tax
    //         );
    
            // Store product details in the session variable
            // $_SESSION['cart_product_details'] = $product_details;
        // }
    // } else {
    //     echo 'No existing session found. Creating a new session.<br>';
    //     $product_details = array(
    //         'cart_unique_id' => $cart_unique_id,
    //         'product_id' => $productId,
    //         'product_quantity' => $product_quantity,
    //         'product_color' => $product_color,
    //         'product_size' => $product_size,
    //         'product_price' => $product_price,
    //         'subtotal' => $subtotal,
    //         'total' => $total,
    //         'final_total' => $final_total,
    //         'flat_discount' => $flat_discount,
    //         'discount_by_percentage' => $discount_by_percentage,
    //         'shipping_charges' => $shipping_charges,
    //         'tax' => $tax
    //     );
    
        // Store product details in the session variable
        // $_SESSION['cart_product_details'] = $product_details;
    // }
    
    if(isset($productId) && isset($cart_unique_id)){
        $query_for_check_reupdate="SELECT * FROM cart_item WHERE product_id='$productId' AND cart_unique_id='$cart_unique_id'";
        $query_for_check_reupdate_run=mysqli_query($conn,$query_for_check_reupdate);
        
        
       
        
        if(mysqli_num_rows($query_for_check_reupdate_run)>0){
            $update_quantity="UPDATE cart_item SET product_quantity='$product_quantity' WHERE product_id='$productId' AND cart_unique_id='$cart_unique_id'";
            $update_quantity_run=mysqli_query($conn,$update_quantity);
        }else{
            $cart_item_query = "INSERT INTO `cart_item` (`product_id`, `cart_unique_id`, `product_quantity`, `product_color`, `product_size`, `product_price`, `subtotal`, `total`, `final_total`, `discount_by_percentage`, `flat_discount`, `shipping_charges`, `tax`, `created_time`) VALUES ('$productId', '$cart_unique_id', '$product_quantity', '$product_color', '$product_size', '$product_price', '$subtotal', '$total', '$final_total', '$discount_by_percentage', '$flat_discount', '$shipping_charges', '$tax', current_timestamp())";
            $cart_item_query_run = mysqli_query($conn, $cart_item_query);
            
            if (!$cart_item_query_run) {
                echo "Error inserting data into the cart_item table: " . mysqli_error($conn);
                exit;
            }
        }
    }

$_SESSION['add_final_total']=0;
$_SESSION['add_total']=0;
$_SESSION['add_subtotal']=0;

    $query_for_add="SELECT * FROM cart_item WHERE cart_unique_id='$cart_unique_id'";
    $query_for_add_run=mysqli_query($conn,$query_for_add);
    if(mysqli_num_rows($query_for_add_run) > 0){
        while($add=mysqli_fetch_assoc($query_for_add_run)){
            $subtotal_for_add=$add['subtotal'];
            $total_for_add=$add['total'];
            $final_total_for_add=$add['final_total'];
           $_SESSION['add_final_total'] += $final_total_for_add;
           $_SESSION['add_total'] += $total_for_add;
           $_SESSION['add_subtotal'] += $subtotal_for_add;

        $query_for_update_cart_total="UPDATE cart SET subtotal=". $_SESSION['add_subtotal'] .", total=" . $_SESSION['add_total'] . " ,final_total= ".$_SESSION['add_final_total'] ." WHERE cart_unique_id='$cart_unique_id'";
        echo $query_for_update_cart_total;
        $query_for_update_cart_total_run=mysqli_query($conn,$query_for_update_cart_total);
        if (!$query_for_update_cart_total_run) {
            echo "Error inserting data into the cart_item table: " . mysqli_error($conn);
            exit;
        }
    }}

    header('Location: shop-cart.php?cart_unique_id=' . $cart_unique_id);
    exit;
}