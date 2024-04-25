<?php
session_start();
include('config/dbcon.php');

if (isset($_POST['cart_item_id']) && isset($_POST['cart_unique_id'])) {
    $cart_item_id = $_POST['cart_item_id'];
    $cart_unique_id = $_POST['cart_unique_id'];

    $query_to_get_data="SELECT * FROM cart_item WHERE cart_item_id='$cart_item_id' AND cart_unique_id='$cart_unique_id'";
    $query_to_get_data_run=mysqli_query($conn,$query_to_get_data);
    if(mysqli_num_rows($query_to_get_data_run)>0){
        while($row=mysqli_fetch_assoc($query_to_get_data_run)){
            $subtotal=$row['subtotal'];
            $total=$row['total'];
            $final_total=$row['final_total'];

            $query_for_update_subtotal = "UPDATE cart SET subtotal = subtotal - $subtotal, total = total - $total, final_total = final_total - $final_total WHERE cart_unique_id = '$cart_unique_id'";
            $query_for_update_subtotal_run = mysqli_query($conn, $query_for_update_subtotal);
        }
    }

    $query = "DELETE FROM cart_item WHERE cart_item_id='$cart_item_id'";
    $query_run = mysqli_query($conn, $query);

    $query_for_cart_Delete = "SELECT * FROM cart_item WHERE cart_unique_id='$cart_unique_id'";
    $query_for_cart_Delete_run = mysqli_query($conn, $query_for_cart_Delete);


    if (mysqli_num_rows($query_for_cart_Delete_run) < 1) {
        $query_delete = "DELETE FROM cart WHERE cart_unique_id='$cart_unique_id'";
        $query_delete_run = mysqli_query($conn, $query_delete);
        unset($_SESSION['first_time']);
    }

    // $query_to_remove_from_cart="DELETE FROM cart WHERE product_id='$removeProductId'";
    // $query_to_remove_from_cart_run=mysqli_query($conn,$query_to_remove_from_cart);

    // foreach ($_SESSION['cart'] as $key => $product) {
    //     if ($product['product_id'] === $removeProductId) {
    //         unset($_SESSION['cart'][$key]);

    echo json_encode(['status' => 'success', 'message' => 'Product removed from cart.']);
    exit;
} else {
    echo json_encode(['status' => 'error', 'message' => 'Product not found in cart.']);
    exit;
}
