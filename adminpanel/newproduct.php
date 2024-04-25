<?php
ob_start();
include('authentication.php');
include('config/dbcon.php');
if (!isset($_GET['category_id'])) {
    header("Location: category.php");
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_GET['category_id'])) {
    $product_size = isset($_POST['product_size']) ? (!empty($_POST['product_size']) ? implode(', ', $_POST['product_size']) : 'M') : 'M';
    $product_name = ucfirst($_POST['product_name']);
    $product_price = $_POST['product_price'];
    $product_color = $_POST['product_color'];
    $product_stock=$_POST['product_stock'];
    $price_currency=$_POST['price_currency'];
    $product_image = $_FILES['product_image']['name'];
    $img_tmp = $_FILES['product_image']['tmp_name'];

    move_uploaded_file($img_tmp, "./image/$product_image");

    $subcategory_id = $_GET['subcategory_id'];
    $category_id = $_GET['category_id'];

    $insert_query = "INSERT INTO product_details (product_name, product_price, product_image, product_size, product_color,product_stock ,price_currency , category_id, subcategory_id) VALUES ('$product_name', '$product_price', '$product_image', '$product_size', '$product_color','$product_stock','$price_currency', '$category_id', '$subcategory_id')";
    $insert_result = mysqli_query($conn, $insert_query);

    if ($insert_result) {
        $new_product_query = "SELECT * FROM product_details WHERE product_id = " . mysqli_insert_id($conn);
        $new_product_result = mysqli_query($conn, $new_product_query);

        if ($new_product_result && mysqli_num_rows($new_product_result) > 0) {
            $new_product_row = mysqli_fetch_assoc($new_product_result);
            $category_id=$new_product_row['category_id'];
            $subcategory_id=$new_product_row['subcategory_id'];
            $product_id=$new_product_row['product_id'];

            $newProduct = <<<HTML
            <div class="card card-solid">
                <div class="card-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <a href="deletecategory.php?product_id={$product_id}&category_id={$category_id}&subcategory_id={$subcategory_id}"><span aria-hidden="true">&times;</span></a>
                            </button>
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <h3 class="d-inline-block d-sm-none">LOWA Men’s Renegade GTX Mid Hiking Boots Review</h3>
                            <div class="col-12">
                                <img src="./image/{$new_product_row['product_image']}" alt='{$new_product_row["product_image"]}' width="500px" height="400px">
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <h3 class="my-3">{$new_product_row["product_name"]}</h3>
                            <hr>
                            <h4>Available Colors</h4>
HTML;
                            $color = $new_product_row['product_color'] ? $new_product_row['product_color'] : 'black';
                            $singlecolor =  explode(',', $color) ? explode(',', $color) : $color;
                            foreach ($singlecolor as $onecolor) {

                                $newProduct .= <<<HTML
                                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                        <label class="btn btn-default text-center active">
                                            <input type="radio" name="color_option" id="color_option_a1" autocomplete="off" checked>
                                            {$onecolor} 
                                            <br>
                                            <i class="fas fa-circle fa-2x text-{$onecolor}"></i>
                                        </label>
                                    </div>
HTML;
            }
            $newProduct .= <<<HTML
                <h4 class="mt-3">Size <small>Please select one</small></h4>
HTML;
                            
                            $size=$new_product_row['product_size']?str_replace(' ', '', $new_product_row['product_size']):'M';
                            $singlesize = explode(',', $size) ? explode(',', $size) : $size;
                            foreach ($singlesize as $onesize) {
                                $newProduct .= <<<HTML
                                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                    <label class="btn btn-default text-center">
                                    <input type="radio" name="color_option" id="color_option_b1" autocomplete="off">
                                    <span class="text-xl">$onesize</span>
                                    <br>
HTML;

                                    switch ($onesize) {
                                        case 'S':
                                            $newProduct .= "Small";
                                            break;
                                        case 'M':
                                            $newProduct .=  "Medium";
                                            break;
                                        case 'L':
                                            $newProduct .=  "Large";
                                            break;
                                        case 'XL':
                                            $newProduct .=  "Extra Large";
                                            break;
                                        default:
                                            $newProduct .= "Unknown Size";
                                    }

                                    $newProduct .= "</label></div>";
                                }

                                
                                
                            
                            $newProduct .= <<<HTML
                             <div class="bg-gray py-2 px-3 mt-4">
                                <h2 class="mb-0">&#8377;{$new_product_row["product_price"]}</h2>
                                <h4 class="mt-0"><small>Ex Tax: {$new_product_row["product_price"]}</small></h4>
                            </div>
                            <div class="mt-4">
                                <div class="btn btn-primary btn-lg btn-flat">
                                    <i class="fas fa-cart-plus fa-lg mr-2"></i>
                                    Add to Cart
                                </div>
                                <div class="btn btn-default btn-lg btn-flat">
                                    <i class="fas fa-heart fa-lg mr-2"></i>
                                    Add to Wishlist
                                </div>
                            </div>
                            <div class="mt-4 product-share">
                                <a href="#" class="text-gray">
                                    <i class="fab fa-facebook-square fa-2x"></i>
                                </a>
                                <a href="#" class="text-gray">
                                    <i class="fab fa-twitter-square fa-2x"></i>
                                </a>
                                <a href="#" class="text-gray">
                                    <i class="fas fa-envelope-square fa-2x"></i>
                                </a>
                                <a href="#" class="text-gray">
                                    <i class="fas fa-rss-square fa-2x"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
HTML;

            echo $newProduct;
        } else {
            echo 'Error fetching the newly added product.';
        }
    } else {
        echo 'Error adding the product to the database.';
    }
} else {
    echo 'Invalid request';
}
