<?php
session_start();
include('config/dbcon.php');
$_SESSION['cart_final_total']=0;
if (isset($_POST['cartDetails'])) {
    $cart_unique_id = $_SESSION['cart_unique_id'];
    $cart_final_total = 0;
    $cartDetails = json_decode($_POST['cartDetails'], true);
    $cart_item_id = $_SESSION['cart_unique_id'];
    if (is_array($cartDetails)) {
        foreach ($cartDetails as $item) {
            $product_id = $item['product_id'];
            $quantity = $item['quantity'];
            $original_price=$item['original_price'];
            $_SESSION['product_id']=$product_id;

            // Update the cart_item table
            $updateQuery = "UPDATE cart_item SET product_quantity = '$quantity' WHERE cart_unique_id = '$cart_item_id' AND cart_item_id='$product_id'";
            mysqli_query($conn, $updateQuery);

            $update_total="UPDATE cart_item SET total= product_quantity * $original_price, subtotal= product_quantity * $original_price WHERE cart_unique_id = '$cart_item_id' AND cart_item_id='$product_id'";
            $update_total_run=mysqli_query($conn,$update_total);

            $get_disocunt="SELECT * FROM cart_item WHERE cart_unique_id = '$cart_item_id' AND cart_item_id='$product_id'";
            $get_disocunt_run=mysqli_query($conn,$get_disocunt);

            if(mysqli_num_rows($get_disocunt_run)>0){
                while($row=mysqli_fetch_assoc($get_disocunt_run)){
                    $subtotal=$row['subtotal'];
                    $total=$row['total'];

                    $newsubtotal += $subtotal;
                    $newtotal += $total;
                    // $_SESSION['true']=$newsubtotal;
                    $quantity_of_product=$row['product_quantity'];
                    $product_price=$original_price;
            $_SESSION['price']=$product_price;

                    if(!empty($row['discount_by_percentage']) && empty($row['flat_discount'])){
                        $by_percenatage_discount=$row['discount_by_percentage'];
                        $final_total= intval($product_price) * (intval($by_percenatage_discount) / 100);
                        $new_final_total=(intval($product_price)) - $final_total;
                    }else if(!empty($row['flat_discount']) && empty($row['discount_by_percentage'])){
                        $by_amount_discount=$row['flat_discount'];
                        $new_final_total=intval($product_price) - $by_amount_discount;
                    }else{
                        // $price= 0;
                        $new_final_total = intval($product_price);
                    }
                    $confirm_final_total= ceil($quantity_of_product) * ceil($new_final_total);
                    
                    $query_for_update_total="UPDATE cart_item SET final_total= '$confirm_final_total' WHERE cart_unique_id = '$cart_item_id' AND cart_item_id='$product_id'";
                    $query_for_update_total_run=mysqli_query($conn,$query_for_update_total);
                    $cart_final_total += $confirm_final_total;
                }
                $cart_final=ceil($cart_final_total);
                $_SESSION['cart']=ceil($cart_final_total);
                $query_for_update_cart = "UPDATE cart SET final_total = $cart_final ,subtotal= $newsubtotal , total= $newtotal WHERE cart_unique_id = '$cart_unique_id'";
                $query_for_update_cart_run = mysqli_query($conn, $query_for_update_cart);

            }
        }
        header('Content-Type: application/json');
        echo json_encode(['success' => true]);
    } 
    else {
        header('Content-Type: application/json');
        echo json_encode(['success' => false, 'error' => 'Invalid data format']);
    }
} else {
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'error' => 'Invalid data received']);
}
?>