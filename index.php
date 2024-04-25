<?php 
session_start();
include('header.php');
include('config/dbcon.php');
?>
<style>
     .cursor{
        cursor: pointer;
    }
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<!-- Categories Section Begin -->
<section class="categories">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 p-0">
                <div class="categories__item categories__large__item set-bg" data-setbg="img/categories/category-1.jpg">
                    <div class="categories__text">
                        <h1>Women’s fashion</h1>
                        <p>Sitamet, consectetur adipiscing elit, sed do eiusmod tempor incidid-unt labore
                            edolore magna aliquapendisse ultrices gravida.</p>
                        <a href="shop.php">Shop now</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 p-0">
                        <div class="categories__item set-bg" data-setbg="img/categories/category-2.jpg">
                            <div class="categories__text">
                                <h4>Men’s fashion</h4>
                                <p>358 items</p>
                                <a href="shop.php">Shop now</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 p-0">
                        <div class="categories__item set-bg" data-setbg="img/categories/category-3.jpg">
                            <div class="categories__text">
                                <h4>Kid’s fashion</h4>
                                <p>273 items</p>
                                <a href="shop.php">Shop now</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 p-0">
                        <div class="categories__item set-bg" data-setbg="img/categories/category-4.jpg">
                            <div class="categories__text">
                                <h4>Cosmetics</h4>
                                <p>159 items</p>
                                <a href="shop.php">Shop now</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 p-0">
                        <div class="categories__item set-bg" data-setbg="img/categories/category-5.jpg">
                            <div class="categories__text">
                                <h4>Accessories</h4>
                                <p>792 items</p>
                                <a href="shop.php">Shop now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Categories Section End -->

<!-- Product Section Begin -->
<section class="product spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4">
                <div class="section-title">
                    <h4>New product</h4>
                </div>
            </div>
            <div class="col-lg-8 col-md-8">
                <ul class="filter__controls">
                    <?php $_SESSION['showcategory'] = true ?>

                    <li onclick="showallcategory()" class="active" data-filter="">All</li>
                    <?php
                    $query = "SELECT * FROM category_name";
                    $query_run = mysqli_query($conn, $query);
                    if (mysqli_num_rows($query_run) > 0) {
                        while ($row = mysqli_fetch_assoc($query_run)) {
                            $category_id = $row['category_id'];
                            $category_title = $row['category_title'];
                    ?>
                            <li onclick="showcategory('<?php echo $category_title; ?>')"><?php echo $category_title; ?></li>
                    <?php       
                    }
                    }
                    ?>
                </ul>
            </div>
        </div>
        <div class="row property__gallery" id="selectcategory">
            <?php if (isset($_SESSION['showcategory'])) {


                $query_for_product = "SELECT * FROM product_details ";
                $query_for_product_run = mysqli_query($conn, $query_for_product);
                $limit = 0;
                while ($product = mysqli_fetch_assoc($query_for_product_run)) {
                    $category_id=$product['category_id'];
                    $productId=$product['product_id'];
                    $limit++;
                    if ($limit > 4) {
                        break;
                    }

            ?>
                    <div  class="col-lg-3 col-md-4 col-sm-6 meet mix cosmetic">
                        <div class="product__item  <?php echo str_replace(' ', '', $product['category_id']) ?>">
                            <div onclick=window.location.href='shop.php?category_id=<?php echo $category_id; ?>' class="cursor product__item__pic set-bg" data-setbg="adminpanel/image/<?php echo $product['product_image']; ?>">
                                <ul class="product__hover mt-5">
                                    <li><a href="adminpanel/image/<?php echo $product['product_image']; ?>" class="image-popup"><span class="arrow_expand"></span></a></li>
                                    <li><a href="#"><span class="icon_heart_alt"></span></a></li>
                                    <li><a href="#"><span class="icon_bag_alt"></span></a></li>
                                </ul>
                                <img src="adminpanel/image/<?php echo $product['product_image']; ?>" class="product__item__pic set-bg" alt="<?php echo $product['product_name']; ?>">

                            </div>
                            <div class="product__item__text">
                                <h6><a href="#"><?php echo $product['product_name'] ?></a></h6>
                                <div class="rating">
                                
                                    <?php
                                    $productId=$product['product_id'];
                                    include('display_review.php');  ?>
                                </div>
                                <?php include('discount_price.php') ?>

                                <!-- <div class="product__price"><?php echo $product['price_currency']; ?> <?php echo ceil($total) ?></div> -->
                            </div>

                        </div>
                    </div>
            <?php
                }
            } ?>
        </div>
</section>
<div class="row property__gallery" id="selectcategory">
</div>
</section>
<!-- Product Section End -->

<!-- Banner Section Begin -->
<section class="banner set-bg" data-setbg="img/banner/banner-1.jpg">
    <div class="container">
        <div class="row">
            <div class="col-xl-7 col-lg-8 m-auto">
                <div class="banner__slider owl-carousel">
                    <div class="banner__item">
                        <div class="banner__text">
                            <span>The Chloe Collection</span>
                            <h1>The Project Jacket</h1>
                            <a href="#">Shop now</a>
                        </div>
                    </div>
                    <div class="banner__item">
                        <div class="banner__text">
                            <span>The Chloe Collection</span>
                            <h1>The Project Jacket</h1>
                            <a href="#">Shop now</a>
                        </div>
                    </div>
                    <div class="banner__item">
                        <div class="banner__text">
                            <span>The Chloe Collection</span>
                            <h1>The Project Jacket</h1>
                            <a href="#">Shop now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Banner Section End -->

<!-- Trend Section Begin -->
<section class="trend spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="trend__content">
                    <div class="section-title">
                        <h4>Hot Trend</h4>
                    </div>
                    <?php
                    $query_for_trend_product = "SELECT * FROM product_details";
                    $query_for_trend_product_run = mysqli_query($conn, $query_for_trend_product);
                    if (mysqli_num_rows($query_for_trend_product_run) > 0) {
                        $product_count = 0;
                        while ($row = mysqli_fetch_assoc($query_for_trend_product_run)) {
                            $productId= $row['product_id'];
                            $category_id=$row['category_id'];
                            if ($row['featured_product'] == 'add') {

                                $product_count++;
                                if ($product_count > 3) {
                                    break;
                                }
                    ?>
                                <div class="trend__item">
                                    <div class="trend__item__pic">
                                        <img src="adminpanel/image/<?php echo $row['product_image'];  ?>" width="90px" height="90px" alt="">
                                    </div>
                                    <div class="trend__item__text">
                                        <h6><?php echo $row['product_name'];  ?></h6>
                                        <div class="rating">
                                            <?php 

                                             include('display_review.php');  ?>
                                        </div>
                                        <?php include('discount_price.php') ?>

                                        <!-- <div class="product__price"><?php echo $row['price_currency']  ?> <?php echo ceil($total)   ?></div> -->
                                    </div>
                                </div>
                    <?php   }
                        }
                    }
                    ?>

                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="trend__content">
                    <div class="section-title">
                        <h4>Best seller</h4>
                    </div>
                    <?php
                    $query_for_trend_product = "SELECT * FROM product_details";
                    $query_for_trend_product_run = mysqli_query($conn, $query_for_trend_product);
                    if (mysqli_num_rows($query_for_trend_product_run) > 0) {
                        $product_count = 0;
                        while ($row = mysqli_fetch_assoc($query_for_trend_product_run)) {
                            $category_id=$row['category_id'];
                            $productId=$row['product_id'];
                            if ($row['featured_product'] == 'add') {
                                $product_count++;
                                if ($product_count > 3) {
                                    break;
                                }
                    ?>
                                <div class="trend__item">
                                    <div class="trend__item__pic">
                                        <img src="adminpanel/image/<?php echo $row['product_image'];  ?>" width="90px" height="90px" alt="">
                                    </div>
                                    <div class="trend__item__text">
                                        <h6><?php echo $row['product_name'];  ?></h6>
                                        <div class="rating">
                                            <?php include('display_review.php'); ?>
                                        </div>
                                        <?php include('discount_price.php') ?>
                                        <!-- <div class="product__price"><?php echo $row['price_currency']  ?> <?php echo ceil($total)  ?></div> -->
                                    </div>
                                </div>
                    <?php   }
                        }
                    }
                    ?>
                    
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="trend__content">
                    <div class="section-title">
                        <h4>Feature</h4>
                    </div>
                    <?php
                    $query_for_trend_product = "SELECT * FROM product_details";
                    $query_for_trend_product_run = mysqli_query($conn, $query_for_trend_product);
                    if (mysqli_num_rows($query_for_trend_product_run) > 0) {
                        $product_count = 0;
                        while ($row = mysqli_fetch_assoc($query_for_trend_product_run)) {
                            $category_id=$row['category_id'];
                            $productId=$row['product_id'];
                            if ($row['new_arrivals'] == 'new') {
                                $product_count++;
                                if ($product_count > 3) {
                                    break;
                                }
                    ?>
                                <div class="trend__item">
                                    <div class="trend__item__pic">
                                        <img src="adminpanel/image/<?php echo $row['product_image'];  ?>" width="90px" height="90px" alt="">
                                    </div>
                                    <div class="trend__item__text">
                                        <h6><?php echo $row['product_name'];  ?></h6>
                                        <div class="rating">
                                            <?php  include('display_review.php'); ?>
                                        </div>
                                        <?php include('discount_price.php') ?>

                                        <!-- <div class="product__price"><?php echo $row['price_currency']  ?> <?php echo ceil($total)  ?></div> -->
                                    </div>
                                </div>
                    <?php   }
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Trend Section End -->

<!-- Discount Section Begin -->
<section class="discount">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 p-0">
                <div class="discount__pic">
                    <img src="img/discount.jpg" alt="">
                </div>
            </div>
            <div class="col-lg-6 p-0">
                <div class="discount__text">
                    <div class="discount__text__title">
                        <span>Discount</span>
                        <h2>Summer 2019</h2>
                        <h5><span>Sale</span> 50%</h5>
                    </div>
                    <div class="discount__countdown" id="countdown-time">
                        <div class="countdown__item">
                            <span>22</span>
                            <p>Days</p>
                        </div>
                        <div class="countdown__item">
                            <span>18</span>
                            <p>Hour</p>
                        </div>
                        <div class="countdown__item">
                            <span>46</span>
                            <p>Min</p>
                        </div>
                        <div class="countdown__item">
                            <span>05</span>
                            <p>Sec</p>
                        </div>
                    </div>
                    <a href="#">Shop now</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Discount Section End -->

<!-- Services Section Begin -->
<section class="services spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="services__item">
                    <i class="fa fa-car"></i>
                    <h6>Free Shipping</h6>
                    <p>For all oder over $99</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="services__item">
                    <i class="fa fa-money"></i>
                    <h6>Money Back Guarantee</h6>
                    <p>If good have Problems</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="services__item">
                    <i class="fa fa-support"></i>
                    <h6>Online Support 24/7</h6>
                    <p>Dedicated support</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="services__item">
                    <i class="fa fa-headphones"></i>
                    <h6>Payment Secure</h6>
                    <p>100% secure payment</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Services Section End -->

<script>
    function showallcategory() {
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'get_products.php?show_all=true', true);

        xhr.onload = function() {
            if (xhr.status == 200) {
                document.getElementById('selectcategory').innerHTML = xhr.responseText;
            } else {
                console.error('Failed to fetch products');
            }
        };
        xhr.send();
    }

    function showcategory(categoryTitle) {
        let selectcategory = categoryTitle;
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'get_products.php?category_title=' + categoryTitle, true);

        xhr.onload = function() {
            if (xhr.status == 200) {
                document.getElementById('selectcategory').innerHTML = xhr.responseText;

            } else {
                console.error('Failed to fetch subcategories');
            }
        };
        xhr.send();
    }
</script>

<?php include('footer.php'); ?>