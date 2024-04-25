<?php 
include('config/dbcon.php');
session_start();

if (isset($_POST['review_submit'])) {
    $product_id_for_review = $_GET['product_id'];
    $review_message = $_POST['review_message'];
    $rating = ($_POST['rating']);
    $login_id = $_SESSION['auth_user']['id'];

    $query_for_review = "INSERT INTO `product_review` (`user_id`,`review_rating`,`review_product_id`,`review`,`submitted_time`) VALUES ('$login_id','$rating','$product_id_for_review','$review_message', current_timestamp())";

    $query_for_review_run = mysqli_query($conn, $query_for_review);
    if (!$query_for_review_run) {
        echo "Error in query" . mysqli_error($conn);
    }else{
        header("Location:product-details.php?product_id=$product_id_for_review");
        exit();
    }
}   ?>
