<?php
include('config/dbcon.php');

if (isset($_GET['category_id'])) {
    $categoryId = mysqli_real_escape_string($conn, $_GET['category_id']);
    echo $categoryId;

    $query = "SELECT * FROM product_details WHERE category_id = '$categoryId'";
    $result = mysqli_query($conn, $query);

?>

    <?php
    if ($result && mysqli_num_rows($result) > 0) {
        echo '<option disabled selected>Select Product</option>';
        echo '<option value="all">All Products</option>';

        while ($row = mysqli_fetch_assoc($result)) {
            echo '<option value="' . $row['product_id'] . '">' . $row['product_name'] . '</option>';
            echo '<input type="text" name="category_id" value="'. $categoryId .'">';
        }
    } else {
        echo '<option value="null" disabled selected>No products found</option>';
    }
}
if(isset($_GET['value']) && isset($_GET['discountmethod'])){
    $method = $_GET['discountmethod'];
    $value=$_GET['value'];
    if ($method == 'percentage') {
    ?>
        <div class="form-group mt-3">
            <label for="">Add Percentage :</label>
            <input type="text" class="form-control" value="<?php echo empty($value)?'':$value ; ?>" name="edit_by_percentage" placeholder="Enter Percentage" autofocus>
        </div>
    <?php
    } else {
    ?>
        <div class="form-group mt-3">
            <label for="">Add Amount :</label>
            <input type="text" class="form-control" value="<?php echo empty($value)?'':$value ; ?>" placeholder="Enter Amount" name="edit_by_amount" autofocus>
        </div>
<?php
    }
}else if (isset($_GET['discountmethod'])) {
    if(!isset($_GET['value'])){

    
    $method = $_GET['discountmethod'];
    if ($method == 'percentage') {
    ?>
        <div class="form-group mt-3">
            <label for="">Add Percentage :</label>
            <input type="text" class="form-control" name="by_percentage" placeholder="Enter Percentage" autofocus>
        </div>
    <?php
    } else {
    ?>
        <div class="form-group mt-3">
            <label for="">Add Amount :</label>
            <input type="text" class="form-control" placeholder="Enter Amount" name="by_amount" autofocus>
        </div>
<?php
    }}
}
?>

