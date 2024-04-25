<?php
ob_start();

include('authentication.php');
include('config/dbcon.php');
include('includes/header.php');
include('includes/navbar.php');
include('includes/sidebar.php');
?>

<div class="content-wrapper">
    <?php $product_id = $_GET['product_id']; ?>

    <?php if (isset($_POST['edit_product'])) {

        $product_name = $_POST['edit_name'];
        $product_description = $_POST['edit_description'];

        $product_size = isset($_POST['edit_size']) ? implode(',', $_POST['edit_size']) : null;
        $product_price = $_POST['edit_price'];
        $featured_product = $_POST['edit_featured_product'];
        $new_arrivals=$_POST['edit_new_arrivals'];
        // $price_currency=$_POST['edit_price_currency'];
        $product_stock=$_POST['edit_product_stock'];

        if (!empty($_FILES['edit_image']['name'])) {
            $target_dir = "image/";
            $target_file = $target_dir . basename($_FILES['edit_image']['name']);

            if (move_uploaded_file($_FILES['edit_image']['tmp_name'], $target_file)) {
                $product_image = $target_file;
            } else {
                echo "Sorry, there was an error uploading your file.";
                exit();
            }
        } else {
            $product_image = $_POST['existing_product_image'];
        }
        $product_color = $_POST['edit_color'];
        if($_POST['edit_category_id']== null){
            $_SESSION['status']="Enter Category and Subcategory";
            header("Location: edit_product.php?product_id=$product_id");
            exit();
        }else{
            $category_name=$_POST['edit_category_id'];
        }
        if($_POST['edit_subcategory_id']== null){
            $_SESSION['status']="Enter Category and Subcategory";
            header("Location: edit_product.php?product_id=$product_id");
            exit();
        }else{
            $subcategory_name=$_POST['edit_subcategory_id'];
        }



        $update_query = "UPDATE product_details SET `product_name`='$product_name',`product_description`='$product_description', `product_price` = '$product_price',`product_image` = '$product_image',`product_size` = '$product_size', `product_color` = '$product_color',`product_stock`='$product_stock',`featured_product`='$featured_product',`new_arrivals`='$new_arrivals',`category_id` = '$category_name', `subcategory_id` = '$subcategory_name'  WHERE `product_id` = '$product_id'";

        $update_query_run = mysqli_query($conn, $update_query);

        if ($update_query_run == true) {
            header("Location: product.php?product_id=$product_id");
            exit();
        }
    } ?>

    <!-------------------------------from for edit product-------------------------->
    <?php
    if (isset($_GET['product_id'])) {
        $product_id = $_GET['product_id'];

    ?>

        <form id="addProductForm" action="" class="bg-white" method="post" enctype="multipart/form-data">
            <div class="modal-body">
        <?php  include('message.php'); ?>

                <div class="form-group">
                    <label for="" class="mt-3">Select Category</label>

                    <select id="selectCategory" name="edit_category_id" class="form-select" onchange="handleCategorySelection()" required>
                        <option disabled selected>Categories</option>
                        <?php

                        $query = "SELECT * FROM category_name";
                        $query_run = mysqli_query($conn, $query);

                        if (mysqli_num_rows($query_run) > 0) {
                            while ($row = mysqli_fetch_assoc($query_run)) {
                                echo '<option value="' . $row['category_id'] . '">' . $row['category_title'] . '</option>';
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="" class="">Select Subcategory</label>

                    <select id="selectSubcategory" name="edit_subcategory_id" class="form-select" onchange="fetchProducts()" required>
                        <option disabled selected>Subcategories</option>

                    </select>
                </div>

                <?php $query = "SELECT * FROM product_details WHERE product_id='$product_id'";
                $query_run = mysqli_query($conn, $query);
                                    if ($row = mysqli_fetch_assoc($query_run)) {
                         ?>

                        <div class="form-group">
                            <label for="">Product Name</label>
                            <input type="text" class="form-control" value="<?php echo $row['product_name'] ?>" placeholder="Enter product name" name="edit_name" autofocus>
                        </div>
                        <div class="form-group">
                            <label for="">Product Description</label>
                            <textarea class="form-control" value="<?php echo $row['product_description'] ?>" placeholder="Enter product description" rows="7"   name="edit_description" autofocus><?php echo $row['product_description'] ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="">Product Price</label>
                            <input type="float" class="form-control" placeholder="Enter product price" value="<?php echo $row['product_price'] ?>" name="edit_price" required>
                        </div>
                        <div class="form-group">
                            <label for="">Product Image</label>
                            <input type="file" class="form-control" value="<?php echo $row['product_image'] ?>" placeholder="Enter your phone no" name="edit_image" accept="image/*">
                        </div>
                        <label>Product Size</label>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="S" name="edit_size[]" id="flexCheckDefault" <?php if (in_array('S', explode(',', $row['product_size']))) echo 'checked'; ?>>
                            <label class="form-check-label" for="flexCheckDefault">
                                S- Small
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="M" name="edit_size[]" id="flexCheckDefault" <?php if (in_array('M', explode(',', $row['product_size']))) echo 'checked'; ?>>
                            <label class="form-check-label" for="flexCheckChecked">
                                M- Medium
                            </label>
                        </div>
                        <div class="form-check" required>
                            <input class="form-check-input" type="checkbox" value="L" name="edit_size[]" id="flexCheckChecked" <?php if (in_array('L', explode(',', $row['product_size']))) echo 'checked'; ?>>
                            <label class="form-check-label" for="flexCheckChecked">
                                L- Large
                            </label>
                        </div>
                        <div class="form-check" required>
                            <input class="form-check-input" type="checkbox" value="XL" name="edit_size[]" id="flexCheckChecked" <?php if (in_array('XL', explode(',', $row['product_size']))) echo 'checked'; ?>>
                            <label class="form-check-label" for="flexCheckChecked">
                                XL- Extra Large
                            </label>
                        </div>

                        <div class="form-group">
                            <label for="" class="mt-3">Product Color</label>
                            <input type="text" class="form-control" placeholder="Enter product color" value="<?php echo $row['product_color']; ?>" name="edit_color" required multiple>
                            <small class="form-text text-muted">Add one or more color using ' , '</small>
                        </div>
                        <div class="form-group">
                            <label for="" class="mt-3">Available Stock</label>
                            <input type="number" value="<?php echo $row['product_stock']; ?>" class="form-control" placeholder="Enter available stock"  name="edit_product_stock" required>
                        </div>

                         

                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" value="add" name="edit_featured_product" id="exampleCheck1" <?php echo $row['featured_product'] == 'add'?'checked': '' ?>>
                            <label class="form-check-label" for="exampleCheck1">Add To Featured Product</label>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" value="new" name="edit_new_arrivals" id="exampleChe" <?php echo $row['new_arrivals'] == 'new'?'checked': '' ?>>
                            <label class="form-check-label" for="exampleCheck1">Add To New Arrivals</label>
                        </div>
                        <input type="hidden" name="existing_product_image" value="<?php echo $row['product_image']; ?>">


            </div>

            <div class="modal-footer">
                <a type="button" class="btn btn-secondary" data-dismiss="modal" href="product.php?product_id=<?php echo $product_id; ?>">Close</a>
                <button type="submit" class="btn btn-primary" name="edit_product">Edit</button>
            </div>
        </form>
<?php }
                }
             ?>

</div>
<?php
ob_end_flush();

include('includes/footer.php');
?>

<script>
    function handleCategorySelection() {
        var categoryId = document.getElementById('selectCategory').value;

        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'get_subcategory_for_products.php?category_id=' + categoryId, true);

        xhr.onload = function() {
            if (xhr.status == 200) {
                document.getElementById('selectSubcategory').innerHTML = xhr.responseText;

            } else {
                console.error('Failed to fetch subcategories');
            }
        };

        xhr.send();
    }
</script>