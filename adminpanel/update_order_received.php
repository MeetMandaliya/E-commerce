<?php 
include('config/dbcon.php');

if(isset($_GET['order_status']) && isset($_GET['cart_unique_id'])){
    $orderStatus = $_GET['order_status'];
    $cartIds = explode(',', $_GET['cart_unique_id']);

    foreach ($cartIds as $cartId) {
            $query = "UPDATE cart SET order_received = '$orderStatus' WHERE cart_unique_id = '$cartId'";
            $query_run = mysqli_query($conn, $query);
        }
        if (!$query_run) {
            echo 'Failed to update order status: ' . mysqli_error($conn);
        }
    }

?>