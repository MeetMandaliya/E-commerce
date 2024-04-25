<?php


include('config/dbcon.php');

if(isset($_POST['add_product'])){
    $product_name = ucfirst($_POST['product_name']);
    $product_description = ucfirst($_POST['product_description']);

   $product_price=$_POST['product_price'];
   $product_size = isset($_POST['product_size']) ? (!empty($_POST['product_size']) ? implode(',', $_POST['product_size']) : 'M') : 'M';
   $product_color=$_POST['product_color'];
   
   $product_stock=$_POST['product_stock'];
   $product_image = $_FILES['product_image']['name'];
    $img_tmp = $_FILES['product_image']['tmp_name'];
    $featured_product=isset($_POST['featured_product'])?$_POST['featured_product']:null;
    $new_arrivals=isset($_POST['new_arrivals'])?$_POST['new_arrivals']:null;
    move_uploaded_file($img_tmp, "./image/$product_image");
    $category_id=$_POST['category_name'];
    $subcategory_id=$_POST['subcategory_name'];

    
        $query_for_currency="SELECT price_currency FROM category_name WHERE category_id='$category_id'";
        $query_for_currency_run=mysqli_query($conn,$query_for_currency);
        if(mysqli_num_rows($query_for_currency_run)>0){
            $price_currencys=mysqli_fetch_assoc($query_for_currency_run);
            echo $price_currency=$price_currencys['price_currency'];
        
    }


    $query="INSERT INTO `product_details` (`product_name`, `product_description`,`product_price`,`product_image`,`product_size`,`product_color`,`product_stock`,`price_currency`,`featured_product`,`new_arrivals`,`category_id`,`subcategory_id`) VALUE ('$product_name','$product_description','$product_price','$product_image','$product_size','$product_color','$product_stock','$price_currency','$featured_product','$new_arrivals','$category_id','$subcategory_id')";

    $query_run=mysqli_query($conn,$query);
    if($query_run == true){
        header("Location: product.php");
    }
    
}


?>