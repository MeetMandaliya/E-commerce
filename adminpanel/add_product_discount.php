<?php
include('config/dbcon.php');

if (isset($_POST['add_discount'])) {
    $value=$_POST['selected_category_id'];

    if(isset($_POST['product_id'])){
        $product=implode(',',$_POST['product_id']);

        if($product == 'all'){
            $category_id= $value;
            $product_id=null;
        }else{
            $category_id=null;
            $product_id= implode(',',$_POST['product_id']);
        }
    
    }

    $discount_name=$_POST['discount_name'];

    if(isset($_POST['by_percentage'])){
        $flat_discount=null;
        $discount_by_percentage=$_POST['by_percentage'];
    }else{
        $discount_by_percentage=null;
        $flat_discount=$_POST['by_amount'];
    }

    $start_date=empty($_POST['starting_date'])?'': $_POST['starting_date'];
    $start_time=empty($_POST['starting_time'])?'': $_POST['starting_time'];
    $end_date=  empty($_POST['ending_date'])?'':$_POST['ending_date'];
    $end_time=  empty($_POST['ending_time'])?'':$_POST['ending_time'];

    $discount_start_time = $start_date . ' ' . $start_time;
    $discount_end_time = $end_date . ' ' . $end_time;

    $query = "INSERT INTO `discount` (`product_id`,`category_id`,`discount_name`,`discount_by_percentage`,`flat_discount`,`discount_start_time`,`discount_end_time`,`current_time`) VALUE ('$product_id','$category_id','$discount_name','$discount_by_percentage','$flat_discount','$discount_start_time','$discount_end_time',current_timestamp())";
    echo $query;
    $result = mysqli_query($conn, $query);
    if($result == true){
        header("Location:discount.php?category_id=$category_id");
        exit();
    }
    
}


?>