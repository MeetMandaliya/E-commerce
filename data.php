<?php
include('config/dbcon.php');

if(isset($_POST['category_id']) || isset($_POST['subcategory_id'])) {
    $category_id = $_POST['category_id'];
    $subcategory_ids = $_POST['subcategory_id'];
    

    foreach($subcategory_ids as $subcategory_id) {
        $query = "SELECT * FROM product_details WHERE category_id='$category_id' AND subcategory_id='$subcategory_id'";
        $query_run = mysqli_query($conn, $query);

        if($query_run) {
            while($row = mysqli_fetch_assoc($query_run)) {
                echo $row['product_name'] . "<br>";
            }
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }

if(isset($_POST['color'])){


 
    foreach($colors as $color) {
        $query = "SELECT * FROM product_details WHERE product_color='$color'";
        $query_run = mysqli_query($conn, $query);

        if($query_run) {
            while($row = mysqli_fetch_assoc($query_run)) {
                echo $row['product_name'] . "<br>";
            }
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
}
    
}
?>

