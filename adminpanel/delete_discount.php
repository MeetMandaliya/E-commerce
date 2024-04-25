<?php
ob_start();
include('authentication.php');
include('config/dbcon.php');

if(isset($_GET['discount_id'])){

    $discount_id=$_GET['discount_id'];
    $query="DELETE FROM discount WHERE discount_id='$discount_id'";
    $query_run=mysqli_query($conn,$query);
    if($query_run == true){
        header("Location: discount.php?discount_id=$discount_id");
        exit();
    }else {
        echo "Error deleting discount: " . mysqli_error($conn);
    }
}
?>