<?php
session_start();
$conn = mysqli_connect('localhost', 'root', '', 'adminpanel');

if(!isset($_GET['product_id'])){
if(!isset($_GET['subcategory_id'])){

if (isset($_GET['category_id'])) {
    $category_id = $_GET['category_id'];


    $sql = "DELETE FROM category_name WHERE `category_id` = '$category_id'";

    $result = $conn->query($sql);

    if ($result == true) {
        header("Location: category.php");
    } else {
        echo "fail";
    }
}}}

if(!isset($_GET['product_id'])){
if (isset($_GET['subcategory_id'])) {
    $subcategory_id = $_GET['subcategory_id'];
    $category_id = $_GET['category_id'];

    $sql = "DELETE FROM subcategory WHERE `subcategory_id` = '$subcategory_id'";

    $result = $conn->query($sql);

    if ($result == true) {

        $query_for_title = "SELECT category_title FROM category_name WHERE category_id='$category_id'";
        $query_for_title_run = mysqli_query($conn, $query_for_title);
        $row = mysqli_fetch_assoc($query_for_title_run);
        $category_title = $row['category_title'];

        header("Location: subcategory.php");
    } else {
        echo "fail";
    }
}}

if(isset($_GET['product_id'])){
    $product_id=$_GET['product_id'];
    $category_id=$_GET['category_id'];
    $subcategory_id=$_GET['subcategory_id'];



    $sql = "DELETE FROM product_details WHERE `product_id` = '$product_id'";

    $result = $conn->query($sql);
    if ($result == true) {
        echo "true";
        header("Location: product.php?subcategory_id=$subcategory_id&category_id=$category_id");
    }


}
?>
