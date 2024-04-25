<?php

session_start();
include('header.php');
include('config/dbcon.php');
$productId = $_GET['product_id'];
// include('display_review.php');

?>


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<style>
    .review-design {
        display: flex;
        justify-content: space-between;
    }

    .review-button {
        width: 140px;
        height: 38px;
    }

    /* .yellow{
        color: yellow;
    } */
    .rating_review {
        color: yellow;
    }

    .message_design {
        width: 100%;
        height: 100px;
    }

    /* .form-design{
        /* margin-left: 30px; */
    /* }  */
    .design-text {
        margin-top: 40px;
        color: black;
        font-weight: 500;
        margin-left: 30px;
    }

    .message {
        width: 90%;
        /* height: 100px; */
        margin-top: 10px;
        margin-left: 30px;
        resize: none;
    }

    .text_center {
        margin-top: 20px;
        text-align: center;
    }

    /* .rating-star{
        display: flex;
        flex-direction: column;
        text-align: center;
        justify-content: flex-start;
    } */
    .star {
        margin-left: 158px;
    }

    .button-review {
        margin-left: 200px;
    }
</style>
<?php
$product_id = $_GET['product_id'];
$count_query = "SELECT COUNT(*) AS review_count FROM product_review WHERE review_product_id = $product_id";

$count_result = mysqli_query($conn, $count_query);

if ($count_result) {
    $count_data = mysqli_fetch_assoc($count_result);
    $review_count = $count_data['review_count'];
} else {
    echo "Error in query: " . mysqli_error($conn);
}
?>
<?php
if (isset($_GET['product_id'])) {
    $productId = $_GET['product_id'];

    $query_for_title = "SELECT * FROM product_details WHERE product_id='$productId'";
    $query_for_title_run = mysqli_query($conn, $query_for_title);
    if (mysqli_num_rows($query_for_title_run) > 0) {
        while ($product_title = mysqli_fetch_assoc($query_for_title_run)) {

            $category_id = $product_title['category_id'];
            $product_name = $product_title['product_name'];
            $query_for_category_name = "SELECT * FROM category_name WHERE category_id='$category_id'";
            $query_for_category_name_run = mysqli_query($conn, $query_for_category_name);
            if (mysqli_num_rows($query_for_category_name_run) > 0) {
                $category_name = mysqli_fetch_assoc($query_for_category_name_run)

?>
                <!-- Breadcrumb Begin -->
                <div class="breadcrumb-option">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="breadcrumb__links">
                                    <a href="./index.php"><i class="fa fa-home"></i> Home</a>
                                    <a href="#"><?php echo $category_name['category_title'];  ?> </a>
                                    <span><?php echo $product_name;  ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    <?php
            }
        }
    }
    ?>
    <!-- Breadcrumb End -->

    <!-- Product Details Section Begin -->
    <section class="product-details spad">
        <div class="container">
            <div class="row">
                <?php
                $query = "SELECT * FROM product_details WHERE product_id='$productId'";
                $query_run = mysqli_query($conn, $query);
                if (mysqli_num_rows($query_run) > 0) {
                    $product = mysqli_fetch_assoc($query_run);
                    $subcategoryId = $product['subcategory_id'];
                    $category_id = $product['category_id'];
                ?>

                    <div class="col-lg-6">
                        <div class="product__details__pic">
                            <div class="product__details__pic__left product__thumb nice-scroll">
                                <a class="pt active" href="#product-1">
                                    <img src="adminpanel/image/<?php echo $product['product_image'] ?>" alt="">
                                </a>
                                <a class="pt" href="#product-2">
                                    <img src="img/product/details/thumb-2.jpg" alt="">
                                </a>
                                <a class="pt" href="#product-3">
                                    <img src="img/product/details/thumb-3.jpg" alt="">
                                </a>
                                <a class="pt" href="#product-4">
                                    <img src="img/product/details/thumb-4.jpg" alt="">
                                </a>
                            </div>

                            <div class="product__details__slider__content">
                                <div class="product__details__pic__slider owl-carousel">
                                    <img data-hash="product-1" class="product__big__img" height="550px" src="adminpanel/image/<?php echo $product['product_image']; ?>" alt="">
                                    <img data-hash="product-2" class="product__big__img" src="img/product/details/product-3.jpg" alt="">
                                    <img data-hash="product-3" class="product__big__img" src="img/product/details/product-2.jpg" alt="">
                                    <img data-hash="product-4" class="product__big__img" src="img/product/details/product-4.jpg" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="product__details__text">
                            <h3><?php echo $product['product_name']; ?> <span>Brand: SKMEIMore Men Watches from SKMEI</span></h3>
                            <div class="rating">
                                <?php
                                include('display_review.php');
                                ?>
                            <span>( <?php echo $review_count; ?> reviews )</span>
                            </div>

                            <?php
                            date_default_timezone_set('Asia/Kolkata');
                            $current_time = date("Y-m-d h:i A");


                            $query_for_discount = "SELECT * FROM discount WHERE (FIND_IN_SET('$productId',product_id) OR category_id='$category_id') AND ('$current_time' BETWEEN discount_start_time AND discount_end_time)";

                            $query_for_discount_run = mysqli_query($conn, $query_for_discount);
                            if (mysqli_num_rows($query_for_discount_run) > 0) {
                                while ($discount_product = mysqli_fetch_assoc($query_for_discount_run)) {

                                    if (isset($discount_product['flat_discount']) !== null  && $discount_product['discount_by_percentage'] == null) {
                                        $price = intval($product['product_price']);


                                        $total = $price - intval($discount_product['flat_discount']);
                                        $flat_discount = $discount_product['flat_discount'];
                                        $percentage_discount = '';
                                    } else if ($discount_product['discount_by_percentage'] !== null && $discount_product['flat_discount'] == null) {
                                        $price = intval($product['product_price']);


                                        $percentage = $price * (intval($discount_product['discount_by_percentage']) / 100);
                                        $total = $price - $percentage;
                                        $percentage_discount = $discount_product['discount_by_percentage'];
                                        $flat_discount = '';
                                    } else {
                                        $price = intval($product['product_price']);
                                        $total = $price;
                                        $flat_discount = '';
                                        $percentage_discount = '';
                                    }
                            ?>

                                    <?php

                                    if (!empty($discount_product['flat_discount'])  && empty($discount_product['discount_by_percentage'])) {
                                        $price = intval($product['product_price']);
                                    } else if (!empty($discount_product['discount_by_percentage'])  && empty($discount_product['flat_discount'])) {
                                    } else {
                                        echo '';
                                    }
                                    
                                }
                            } else {
                                $total = $product['product_price'];
                                $price = $product['product_price'];
                                $flat_discount = '';
                                $percentage_discount = '';
                            }

                            ?>
                            <div class="product__details__price .text-secondary flex"><?php echo $product['price_currency']  ?><section class="total_price"> <?php echo ceil($total) ?></section>
                                <?php if (!empty($flat_discount) && empty($percentage_discount)) { ?>

                                    <!-- Display flat discount -->
                                    <h6 class="text-danger mb-4 flex center"><?php echo $product['price_currency']  ?><?php echo intval($flat_discount) ?> OFF</h6>
                                <?php } else if (!empty($percentage_discount) && empty($flat_discount)) { ?>
                                    <!-- Display percentage discount -->

                                    <h6 class="text-danger mb-4 flex center"><?php echo intval($percentage_discount) ?>% OFF</h6>
                                <?php } else {
                                } ?>
                            </div>
                            <?php if (!empty($flat_discount) || !empty($percentage_discount)) {
                            ?>

                                <p class="text-muted">M.R.P.:<del><?php echo $product['price_currency']; ?><span class="original_price"><?php echo $product['product_price']; ?></span></del> </p>
                            <?php
                            } else { ?>
                                <input type="hidden" class="original_price1" value="<?php echo $product['product_price']; ?>"></input>
                            <?php } ?>
                            <!-- <form action="shop-cart.php" method="post"> -->
                            <div class="product__details__button">
                                <div class="quantity">
                                    <span>Quantity:</span>
                                    <div class="pro-qty">
                                        <input class="bg-white" type="text" name="quantity" value="1" id="quantityInput" disabled min="1">
                                    </div>
                                </div>
                                <button onclick="addToCart('<?php echo $product['product_id'] ?>')" type="submit" name="add_to_cart" class="cart-btn border-0"><span class="icon_bag_alt"></span> Add to cart</button>
                                <ul>
                                    <li><a href="#"><span class="icon_heart_alt"></span></a></li>
                                    <li><a href="#"><span class="icon_adjust-horiz"></span></a></li>
                                </ul>
                            </div>
                            <div class="product__details__widget">
                                <ul>

                                    <li>
                                        <span>Available color:</span>
                                        <div class="color__checkbox ">
                                            <?php $productColor = $product['product_color'];
                                            $color = explode(',', $productColor);
                                            foreach ($color as $singlecolor) { ?>
                                                <label for="<?php echo $singlecolor ?>">
                                                    <input type="radio" name="color__radio" value="<?php echo $singlecolor ?>" checked onclick="addchecked()">
                                                    <span class="checkmark"></span>
                                                </label>
                                            <?php }
                                            ?>
                                        </div>
                                    </li>

                                    <li>
                                        <span>Available size:</span>
                                        <div class="size__btn">
                                            <?php
                                            $productSize = $product['product_size'];
                                            $size = explode(',', $productSize);
                                            foreach ($size as $singlesize) {
                                            ?>
                                                <label data-value="<?php echo $singlesize; ?>" name="size__radio" for="size-<?php echo $singlesize; ?>">
                                                    <input name="size__radio" onclick="toggleSize('<?php echo $singlesize; ?>')" type="radio" class="active size size-<?php echo $singlesize; ?>" value="<?php echo $singlesize; ?>">
                                                    <?php echo $singlesize; ?>
                                                </label>

                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </li>

                                    <li>
                                        <span>Promotions:</span>
                                        <p>Free shipping</p>
                                    </li>
                                </ul>
                            </div>
                            <!-- </form> -->
                        </div>
                    </div>

                    <!-- <--------------review -form --------->
                    <div class="modal fade" id="AddUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content" style="height: 480px;">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">LEAVE A REVIEW</h1>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <!-- <h2 class="align-content-center">REVIEW </h2> -->
                                <div class="form-design">
                                    <form action="product_review.php?product_id=<?php echo $_GET['product_id']; ?>" method="post">
                                        <div class="rating-star">
                                            <p class="text_center">Click a stars to rate product *</p>
                                            <fieldset class="rating_review star">
                                                <input type="radio" id="star5" name="rating" value="5" /><label class="full" for="star5" title="Awesome - 5 stars"></label>
                                                <input type="radio" id="star4half" name="rating" value="4.5" /><label class="half" for="star4half" title="Pretty good - 4.5 stars"></label>
                                                <input type="radio" id="star4" name="rating" value="4" /><label class="full" for="star4" title="Pretty good - 4 stars"></label>
                                                <input type="radio" id="star3half" name="rating" value="3.5" /><label class="half" for="star3half" title="Meh - 3.5 stars"></label>
                                                <input type="radio" id="star3" name="rating" value="3" /><label class="full" for="star3" title="Meh - 3 stars"></label>
                                                <input type="radio" id="star2half" name="rating" value="2.5" /><label class="half" for="star2half" title="Kinda bad - 2.5 stars"></label>
                                                <input type="radio" id="star2" name="rating" value="2" /><label class="full" for="star2" title="Kinda bad - 2 stars"></label>
                                                <input type="radio" id="star1half" name="rating" value="1.5" /><label class="half" for="star1half" title="Meh - 1.5 stars"></label>
                                                <input type="radio" id="star1" name="rating" value="1" /><label class="full" for="star1" title="Bad product"></label>
                                                <input type="radio" id="starhalf" name="rating" value="0.5" required /><label class="half" for="starhalf" title="Very Bad Product"></label>
                                            </fieldset>
                                        </div><br>
                                        <!-- <div class="message_design"> -->

                                        <div class="checkout__form__input">
                                            <h5 class="design-text">Review:</h5>
                                            <textarea type="text" name="review_message" class="message" rows="5" cols="20" placeholder="Enter your review here..." required></textarea>
                                        </div>
                                        <br />
                                        <button type="submit" name="review_submit" class="btn btn-primary button-review">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- <------------review form----------->
                    <!-- <------------edit review----------->
                    <?php 
                    if (isset($_POST['edit_review'])) {
                        $edit_message = $_POST['edit_review_message'];
                        $edit_rating = $_POST['edit_rating'];
                        $user_id = $_SESSION['auth_user']['id'];
                        $update = "UPDATE product_review SET review_rating='$edit_rating', review='$edit_message', submitted_time= current_timestamp() WHERE user_id='$user_id'";
                        $update_run = mysqli_query($conn, $update);

                        if ($update_run == false) {
                            die("Error : " . mysqli_error($conn));
                        }
                    }
                    ?>
                    <div class="modal fade" id="editreview" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content" style="height: 480px;">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">LEAVE A REVIEW</h1>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <!-- <h2 class="align-content-center">REVIEW </h2> -->
                                <div class="form-design">
                                    <form action="product-details.php?product_id=<?php echo $_GET['product_id']; ?>" method="post">
                                <?php
                                                // if(isset($_SESSION['first_edit'])){
                                                $user_id_for_edit = $_SESSION['auth_user']['id'];
                                                $product_id=$_GET['product_id'];
                                                $query_for_edit_review = "SELECT * FROM product_review WHERE user_id='$user_id_for_edit' AND review_product_id='$product_id'";
                                                $query_for_edit_review_run = mysqli_query($conn, $query_for_edit_review);
                                                if (mysqli_num_rows($query_for_edit_review_run) > 0) {
                                                    while($edit_review = mysqli_fetch_assoc($query_for_edit_review_run)){

                                                    $value=$edit_review['review_rating'];
                                                ?>
                                        <div class="rating-star">
                                            <p class="text_center">Click a stars to rate product *</p>
                                            <fieldset class="rating_review star">
                                               
                                                <input type="radio" id="star51" name="edit_rating" value="5" <?php echo ($value == '5') ? 'checked' : ''; ?> /><label class="full" for="star51" title="Awesome - 5 stars"></label>
                                                <input type="radio" id="star4half1" name="edit_rating" value="4.5" <?php echo ($value == '4.5') ? 'checked' : ''; ?> /><label class="half" for="star4half1" title="Pretty good - 4.5 stars"></label>
                                                <input type="radio" id="star41" name="edit_rating" value="4" <?php echo ($value == '4') ? 'checked' : ''; ?> /><label class="full" for="star41" title="Pretty good - 4 stars"></label>
                                                <input type="radio" id="star3half1" name="edit_rating" <?php echo ($value == '3.5') ? 'checked' : ''; ?> value="3.5" /><label class="half" for="star3half1" title="Meh - 3.5 stars"></label>
                                                <input type="radio" <?php echo ($value == '3') ? 'checked' : ''; ?> id="star31" name="edit_rating" value="3" /><label class="full" for="star31" title="Meh - 3 stars"></label>
                                                <input type="radio" <?php echo ($value == '2.5') ? 'checked' : ''; ?> id="star2half1" name="edit_rating" value="2.5" /><label class="half" for="star2half1" title="Kinda bad - 2.5 stars"></label>
                                                <input type="radio" <?php echo ($value == '2') ? 'checked' : ''; ?> id="star21" name="edit_rating" value="2" /><label class="full" for="star21" title="Kinda bad - 2 stars"></label>
                                                <input type="radio" <?php echo ($value == '1.5') ? 'checked' : ''; ?> id="star1half1" name="edit_rating" value="1.5" /><label class="half" for="star1half1" title="Meh - 1.5 stars"></label>
                                                <input type="radio" <?php echo ($value == '1') ? 'checked' : ''; ?> id="star11" name="edit_rating" value="1" /><label class="full" for="star11" title="Sucks big time - 1 star"></label>
                                                <input type="radio" <?php echo ($value == '0.5') ? 'checked' : ''; ?> id="starhalf1" name="edit_rating" value="0.5" required/><label class="half" for="starhalf1" title="Sucks big time - 0.5 stars"></label>
                                            </fieldset>
                                        </div><br>

                                        <div class="checkout__form__input">
                                            <h5 class="design-text">Review:</h5>
                                            <textarea name="edit_review_message" class="message" rows="5" cols="20" placeholder="Enter your review here..." required><?php echo $edit_review['review']; ?></textarea>
                                        </div>
                                        
                                        <br />
                                        <button type="submit" name="edit_review" class="btn btn-primary button-review">Submit</button>
                                    <?php
                                        }}
                                        ?>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <------------edit review----------->

                    <div class="col-lg-12">
                        <div class="product__details__tab">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab">Description</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab">Specification</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab">Reviews ( <?php echo $review_count; ?> )</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tabs-1" role="tabpanel">
                                    <h6>Description</h6>
                                    <p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut loret fugit, sed
                                        quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt loret.
                                        Neque porro lorem quisquam est, qui dolorem ipsum quia dolor si. Nemo enim ipsam
                                        voluptatem quia voluptas sit aspernatur aut odit aut loret fugit, sed quia ipsu
                                        consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Nulla
                                        consequat massa quis enim.</p>
                                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget
                                        dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes,
                                        nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium
                                        quis, sem.</p>
                                </div>
                                <div class="tab-pane" id="tabs-2" role="tabpanel">
                                    <h6>Specification</h6>
                                    <p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut loret fugit, sed
                                        quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt loret.
                                        Neque porro lorem quisquam est, qui dolorem ipsum quia dolor si. Nemo enim ipsam
                                        voluptatem quia voluptas sit aspernatur aut odit aut loret fugit, sed quia ipsu
                                        consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Nulla
                                        consequat massa quis enim.</p>
                                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget
                                        dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes,
                                        nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium
                                        quis, sem.</p>
                                </div>
                                <div class="tab-pane" id="tabs-3" role="tabpanel">
                                    <!-- <div class="review-design"> -->
                                    <div class="blog__details__comment">
                                        <div class="d-flex justify-content-between">
                                            <h5>Reviews ( <?php echo $review_count; ?> )</h5>
                                            <?php if (isset($_SESSION['auth']) && isset($_SESSION['auth_user'])) {
                                                $user_id = $_SESSION['auth_user']['id'];
                                                $product_id = $_GET['product_id'];
                                                $query_for_check = "SELECT * FROM product_review WHERE user_id='$user_id' AND review_product_id='$product_id'";
                                                $query_for_check_run = mysqli_query($conn, $query_for_check);
                                                if (mysqli_num_rows($query_for_check_run) > 0) {
                                                    $_SESSION['first_edit']=true;
                                            ?>
                                                    <a data-toggle="modal" data-target="#editreview" class="leave-btn cursor">
                                                        <i class="fa-regular fa-pen-to-square"></i><span class="ml-2">Edit Your Review</span></a>
                                                <?php
                                                } else {
                                                ?>
                                                    <a data-toggle="modal" data-target="#AddUserModal" href="
                                                    product_details.php" class="leave-btn">
                                                        <i class="fa-regular fa-pen-to-square"></i><span class="ml-2">Write a review</span></a>
                                                <?php  } ?>
                                            <?php   } else { ?>
                                                <a href="login.php" class="leave-btn"><i class="fa-regular fa-pen-to-square"></i><span class="ml-2">Write a review</span></a>
                                            <?php  } ?>
                                        </div>
                                        <?php
                                        function generateStarRating($rating)
                                        {
                                            $ratingValue = floatval($rating);
                                            $fullStars = floor($ratingValue);
                                            $remainingStars = $ratingValue - $fullStars;

                                            for ($i = 0; $i < $fullStars; $i++) {
                                                echo '<i class="fa fa-star"></i>';
                                            }
                                            if ($remainingStars > 0) {
                                                echo '<i class="fa-regular fa-star-half-stroke"></i>';
                                            }
                                        } ?>
                                        <?php
                                        $product_id = $_GET['product_id'];
                                        $query_for_display_the_review = "SELECT * FROM product_review WHERE review_product_id='$product_id'";
                                        $query_for_display_the_review_run = mysqli_query($conn, $query_for_display_the_review);
                                        if (mysqli_num_rows($query_for_display_the_review_run) > 0) {

                                            while ($review = mysqli_fetch_assoc($query_for_display_the_review_run)) {
                                            
                                                $id = $review['user_id'];
                                                $query_for_name = "SELECT * FROM users WHERE id='$id'";
                                                $query_for_name_run = mysqli_query($conn, $query_for_name);
                                                if (mysqli_num_rows($query_for_name_run) > 0) {
                                                    
                                                    while ($name = mysqli_fetch_assoc($query_for_name_run)) {
                                                                    
                                        ?>

                                                    <div id="showall"></div>
                                                        <div class="blog__comment__item">
                                                            <div class="blog__comment__item__text">
                                                                <h6><?php echo $name['name'];  ?></h6>
                                                                <div class="rating_review">
                                                                    <?php generateStarRating($review['review_rating']); ?>
                                                                </div> <br>
                                                                <p><?php echo $review['review']; ?></p>
                                                                <ul>
                                                                    <li><i class="fa fa-clock-o"></i> <?php $date = $review['submitted_time'];
                                                                        echo $formattedDate = date('M d, Y', strtotime($date)); ?></li>
                                                                    <li><i class="fa fa-heart-o"></i> 12</li>
                                                                    <li><i class="fa fa-share"></i> 1</li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                        <?php
                                                   
                                             }
                                                }
                                                // if($no == 4){
                                                //     break;
                                                // }
                                           ?> <?php
                                            }
                                        }
                                        ?>
                                        <!-- <h6 onclick="showall(<?php echo $_GET['product_id']; ?>)"> See more reviews ..   <h6> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="related__title">
                        <h5>RELATED PRODUCTS</h5>
                    </div>
                </div>
                <?php $query_for_product = "SELECT * FROM product_details WHERE subcategory_id='$subcategoryId'";
                    $query_for_product_run = mysqli_query($conn, $query_for_product);
                    if (mysqli_num_rows($query_for_product_run) > 0) {
                        $count = 0;
                        while ($product = mysqli_fetch_assoc($query_for_product_run)) {
                            $count++;
                            if ($count > 4) {
                                break;
                            }
                ?>
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="product__item">
                                <div class="product__item__pic set-bg" data-setbg="adminpanel/image/<?php echo $product['product_image']; ?>">
                                    <div class="label new">New</div>
                                    <ul class="product__hover">
                                        <li><a href="adminpanel/image/<?php echo $product['product_image']; ?>" class="image-popup"><span class="arrow_expand"></span></a></li>
                                        <li><a href="#"><span class="icon_heart_alt"></span></a></li>
                                        <li><a href="#"><span class="icon_bag_alt"></span></a></li>
                                    </ul>
                                </div>
                                <div class="product__item__text">
                                    <h6><a href="#"><?php echo $product['product_name']; ?></a></h6>
                                    <div class="rating">
                                   <?php 
                                   $productId=$product['product_id'];
                                   include('display_review.php'); ?>
                                    </div>
                                    <?php include('discount_price.php'); ?>

                                </div>
                            </div>
                        </div>
                <?php
                        }
                    }

                ?>

            </div>
        </div>
<?php
                }
            }
?>
    </section>
    <!-- Product Details Section End -->

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <script>
        // document.addEventListener("DOMContentLoaded", function () {
        //     // Set initial rating value based on PHP value
        //     var initialValue = 
        //     console.log(initialValue);
        //     document.querySelector("input[name='edit_rating'][value='" + initialValue + "']").checked = true;
        //     document.getElementById("selectedRating").value = initialValue;

        //     // Handle user click to update the hidden input value
        //     // document.addEventListener("DOMContentLoaded", function () {
        //     // Handle user click to update the hidden input value
        //     var radioButtons = document.querySelectorAll("input[name='edit_rating']");
        //     console.log(radioButtons);
        //     var initialValue = document.getElementById("selectedRating").value;
        //     // console.log(radioButtons);

        //     radioButtons.forEach(function (radioButton) {
        //         radioButton.addEventListener("change", function () {
        //             var selectedValue = this.value;
        //             console.log(selectedValue);

        //             // Uncheck initially checked radio button
        //             radioButtons.forEach(function (radio) {
        //                 if (radio.value === initialValue) {
        //                     radio.checked = false;
        //                 }
        //             });

        //             // Update the hidden input value
        //             document.getElementById("selectedRating").value = selectedValue;

        //             // Update the initial value to the newly selected value
        //             initialValue = selectedValue;
        //         });
        //     });
        // });
        // });
        function addchecked() {
            let id = document.getElementById('checked');
            id.toggleAttribute('checked');
            // console.log(id);
        }

        function toggleSize(size) {
            var clickedSize = document.querySelector('.size-' + size);
            console.log(clickedSize)
            if (clickedSize) {
                clickedSize.classList.toggle('checked');
            } else {
                console.error('Size element not found:', size);
            }
            console.log(size);
        }
        var proQty = $('.pro-qty');
        proQty.prepend('<span class="dec qtybtn">-</span>');
        proQty.append('<span class="inc qtybtn">+</span>');
        proQty.on('click', '.qtybtn', function() {
            var $button = $(this);
            var oldValue = $button.parent().find('input').val();
            if ($button.hasClass('inc')) {
                var newVal = parseFloat(oldValue) + 1;
            } else {
                if (oldValue > 1) {
                    var newVal = parseFloat(oldValue) - 1;
                    
                } else {
                    newVal = 1;
                }
            }
            $button.parent().find('input').val(newVal);

        });

        function toggle(color) {
            var clickedColor = document.querySelector('.bg-' + color);

            clickedColor.classList.toggle('bordersize');

            
        }

        function addToCart(productId) {
            let discount_by_percentage = "<?php if (!empty($percentage_discount) && empty($flat_discount)) {
                echo $percentage_discount;
            } else {
                 echo "0";
            } ?>"
            let flat_discount = "<?php if (!empty($flat_discount) && empty($percentage_discount)) {
                echo $flat_discount;
                } else {
                    echo '0';
                }; ?>"

            // let price = parseFloat($('.original_price').text());

            var price1 = $(".original_price1").val();


            var price;
            if (price1 === undefined) {

                price = parseFloat($('.original_price').text());
            } else {
                price = parseFloat(price1);
            }

            // console.log(price); 
            let total = parseFloat($('.total_price').text());
           
            var color = $("input[name='color__radio']:checked").val();
            // console.log(color);
            var size = $("label[name='size__radio'].active").data('value');
            if (size == null) {
                size = 'M';
            }
            // console.log(size);
            let quantity = $('#quantityInput').val();
            total = total * quantity;

            // console.log(quantity);
            // let quantity = $('#quantityInput').val()

            var url = 'add_to_cart.php?product_id=' + productId + '&quantity=' + quantity + '&discount_by_percentage=' + discount_by_percentage + '&flat_discount=' + flat_discount + '&color=' + color + '&size=' + size + '&total=' + total + '&price=' + price;
            window.location.href = url;
        }

        // function showall(productId){
        //     var xhr = new XMLHttpRequest();
        // xhr.open('GET', 'display_all_review.php?product_id=' + productId, true);
        // xhr.onload = function() {
        //     if (xhr.status == 200) {
        //         document.getElementById('showall').innerHTML = xhr.responseText;
        //     } else {
        //         console.error('Failed to fetch subcategories');
        //     }
        // };
        // xhr.send();
        // }
    </script>
    <?php include('footer.php'); ?>