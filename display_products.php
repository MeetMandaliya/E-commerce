<style>
    .cursor {
        cursor: pointer;
    }
</style>
<?php
include('config/dbcon.php');

$conditions = [];

if (isset($_GET['subcategory_id'])) {
    $subcategory_ids = explode(',', $_GET['subcategory_id']);
    $subcategory_conditions = [];
    foreach ($subcategory_ids as $subcategory_id) {
        $subcategory_conditions[] = "subcategory_id='$subcategory_id'";
    }
    $conditions[] = "(" . implode(" OR ", $subcategory_conditions) . ")";
}

if (isset($_GET['size'])) {
    $sizes = explode(',', $_GET['size']);
    $size_conditions = [];
    foreach ($sizes as $size) {
        $size_conditions[] = "FIND_IN_SET('$size', product_size) > 0";
    }
    $conditions[] = "(" . implode(" OR ", $size_conditions) . ")";
}

if (isset($_GET['color'])) {
    $colors = explode(',', $_GET['color']);
    $color_conditions = [];
    foreach ($colors as $color) {
        $color_conditions[] = "FIND_IN_SET('$color', product_color) > 0";
    }
    $conditions[] = "(" . implode(" OR ", $color_conditions) . ")";
}
if (isset($_GET['min_price']) && isset($_GET['max_price'])) {
    $min_price = str_replace('$', '', $_GET['min_price']);
    $max_price = str_replace('$', '', $_GET['max_price']);
    $conditions[] = "(product_price BETWEEN $min_price AND $max_price)";
}

$query = "SELECT * FROM product_details";
if (!empty($conditions)) {
    $query .= " WHERE " . implode(" AND ", $conditions);
}

$query_run = mysqli_query($conn, $query);

if ($query_run) {

    if (mysqli_num_rows($query_run) > 0) {
        while ($product = mysqli_fetch_assoc($query_run)) {
            $productId = $product['product_id'];
            $category_id =$product['category_id'];
            $price = intval($product['product_price']);
           
           ?>
            <div class="col-lg-4 col-md-6">
                <div class="product__item">
                    <img class="product__item__pic set-bg cursor" onclick="window.location.href='product-details.php?product_id=<?php echo $productId ?>'" src="adminpanel/image/<?php echo $product['product_image'] ?>">
                    <div class="product__item__text">
                        <h6><a href="#"><?php echo $product['product_name']; ?></a></h6>
                        <div class="rating">
                        <?php
                         include('display_review.php'); ?>
                            
                        </div>
                        <?php include('discount_price.php') ?>

                        <!-- <div class="product__price"><?php echo $product['price_currency']; ?> <?php echo ceil($total); ?></div> -->
                    </div>
                </div>
            </div>
<?php
        }
    } else {
        echo "No products found matching the selected filters.";
    }
} else {
    echo "Error: " . mysqli_error($conn);
}

mysqli_close($conn);
?>