<?php 
session_start();
include('config/dbcon.php');
echo $cart_unique_id= $_SESSION['cart_unique_id'];
if(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST') {

   $cash=$_POST['payment_method'];
  $address_unique_id = uniqid();                         
if(isset($_SESSION['auth'])){
    $login_id=$_SESSION['auth_user']['id'];
}else{
    $login_id=null;
}
$billing_address=isset($_POST['address'])?$_POST['address']:null;
if(isset($_POST['address_id'])){
   echo $address_id=$_POST['address_id'];
    $query_for_Address="SELECT * FROM address WHERE address_id='$address_id'";
    $query_for_Address_run=mysqli_query($conn,$query_for_Address);
    if(mysqli_num_rows($query_for_Address_run)>0){
        $address_data=mysqli_fetch_assoc($query_for_Address_run);
    echo  $billing_address=$address_data['billing_address'];
    }
}
$billing_city=$_POST['city'];
$billing_country=$_POST['country'];
$billing_name=$_POST['name'];
$billing_email=$_POST['email'];
$billing_zipcode=$_POST['zipcode'];
$billing_state=$_POST['state'];
$billing_phone=$_POST['phone'];
$shipping_name=isset($_POST['shipping_name'])?$_POST['shipping_name']:null;
$shipping_address=isset($_POST['shipping_address'])?$_POST['shipping_address']:null;
$shipping_city=isset($_POST['shipping_city'])?$_POST['shipping_city']:null;
$shipping_country=isset($_POST['shipping_country'])?$_POST['shipping_country']:null;
$shipping_email=isset($_POST['shipping_email'])?$_POST['shipping_email']:null;
$shipping_zipcode=isset($_POST['shipping_zipcode'])?$_POST['shipping_zipcode']:null;
$shipping_state=isset($_POST['shipping_state'])?$_POST['shipping_state']:null;
$shipping_phone=isset($_POST['shipping_phone'])?$_POST['shipping_phone']:null;
$shipping_email=isset($_POST['shipping_email'])?$_POST['shipping_email']:null;

$query="INSERT INTO `address` (`address_unique_id`,`login_id`, `billing_name`, `billing_address`, `billing_phone_no`,`billing_email`, `billing_city`, `billing_state`, `billing_country`, `billing_zipcode`, `shipping_name`, `shipping_address`, `shipping_city`, `shipping_state`, `shipping_country`, `shipping_zipcode`, `shipping_phone`,`shipping_email`) VALUES ('$address_unique_id','$login_id', '$billing_name', '$billing_address', '$billing_phone','$billing_email', '$billing_city', '$billing_state', '$billing_country', '$billing_zipcode', '$shipping_name', '$shipping_address', '$shipping_city', '$shipping_state', '$shipping_country', '$shipping_zipcode', '$shipping_phone','$shipping_email')";
$query_run=mysqli_query($conn,$query);
$_SESSION['order_confirm']="done";
$_SESSION['order_received']="unfulfilled";

$order_confirm = $_SESSION['order_confirm'];
$order_received =$_SESSION['order_received'];

if(!empty($shipping_address)){
    $query_for_add_shipping_address="UPDATE cart SET address='$address_unique_id' ,order_confirm = '$order_confirm' ,order_received='$order_received' , order_time= CURRENT_TIMESTAMP WHERE cart_unique_id='$cart_unique_id'";
    $query_for_add_shipping_address_run=mysqli_query($conn,$query_for_add_shipping_address);

}else{
    $query_for_add_address="UPDATE cart SET address='$address_unique_id' ,order_confirm = '$order_confirm' ,order_received='$order_received' , order_time= CURRENT_TIMESTAMP  WHERE cart_unique_id='$cart_unique_id'";
    $query_for_add_address_run=mysqli_query($conn,$query_for_add_address);
}

$cart_unique_id=$_SESSION['cart_unique_id'];
$query_for_get_product_id="SELECT * FROM cart_item WHERE cart_unique_id='$cart_unique_id'";
$query_for_get_product_id_run=mysqli_query($conn,$query_for_get_product_id);
if(mysqli_num_rows($query_for_get_product_id_run)>0){
    while($product_id_for_quantity=mysqli_fetch_assoc($query_for_get_product_id_run)){
    $product_id=$product_id_for_quantity['product_id'];
    $quantity= $product_id_for_quantity['product_quantity'];
    $quantity = intval($quantity);
        $query_for_quantity="UPDATE product_details SET product_stock= product_stock - $quantity WHERE product_id='$product_id'";
        $query_for_quantity_run=mysqli_query($conn,$query_for_quantity);
    }
}
unset($_SESSION['first_time']);
unset($_SESSION['cart_unique_id']);


if($query_run){
    header("Location:thankyou.php?cart_id=$cart_unique_id");
    exit();
}
} 

?>
