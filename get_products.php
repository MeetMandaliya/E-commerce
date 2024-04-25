<style>
     .cursor{
        cursor: pointer;
    }
</style>
<?php
include('config/dbcon.php');

if (isset($_GET['category_title']) || isset($_GET['show_all'])) {
    unset($_SESSION['showcategory']);

    if (isset($_GET['category_title'])) {
        $categoryTitle = $_GET['category_title'];

        $query = "SELECT * FROM category_name WHERE category_title = '$categoryTitle'";
        $result = mysqli_query($conn, $query);
        if ($result && mysqli_num_rows($result) > 0) {

            $row = mysqli_fetch_assoc($result);
            $category_id = $row['category_id'];
            $query_for_product = "SELECT * FROM product_details WHERE category_id='$category_id' ";
        } else {
            echo "Category not found";
            exit();
        }
    } elseif (isset($_GET['show_all'])) {
        $query_for_product = "SELECT * FROM product_details";
    }

    $query_for_product_run = mysqli_query($conn, $query_for_product);
    $limit = 0;

    while ($product = mysqli_fetch_assoc($query_for_product_run)) {
        $productId=$product['product_id'];
        $category_id=$product['category_id'];
        
        $limit++;
        if ($limit > 4) {
            break;
        }

        ?>
        <div  class="col-lg-3 col-md-4 col-sm-6 meet mix cosmetic">
            <div class="product__item <?php echo str_replace(' ', '', $product['category_id']) ?>">
               
                <img onclick=window.location.href='shop.php?category_id=<?php echo $category_id; ?>' src="adminpanel/image/<?php echo $product['product_image']; ?>" class="cursor product__item__pic set-bg" alt="<?php echo $product['product_name']; ?>">
            </div>
            <div class="product__item__text">
                <h6><a href="#"><?php echo $product['product_name'] ?></a></h6>
                <div class="rating">
                   <?php include('display_review.php');  ?>
                </div>
                <?php include('discount_price.php') ?>
                <!-- <div class="product__price"><?php echo $product['price_currency']; ?> <?php echo ceil($total) ?></div> -->
            </div>
        </div>
        <?php
    }
}
?>
