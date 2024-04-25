    <?php
    session_start();
    include('header.php');

    include('config/dbcon.php');  ?>

    <style>
        .filter-range-wrap .range-slider .price-input input {
		max-width: 20%;
	}
    </style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="./index.php"><i class="fa fa-home"></i> Home</a>
                        <span>Shop</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Shop Section Begin -->
    <section class="shop spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3">
                    <div class="shop__sidebar">
                        <div class="sidebar__categories">
                            <div class="section-title">
                                <h4>Categories</h4>
                            </div>
                            <div class="categories__accordion">
                                <div class="accordion" id="accordionExample">
                                    <?php $query = "SELECT * FROM category_name";
                                    $query_run = mysqli_query($conn, $query);
                                    if (mysqli_num_rows($query_run) > 0) {
                                        while ($row = mysqli_fetch_assoc($query_run)) {
                                            $category_id = $row['category_id'];
                                    ?>
                                            <form method="GET" action="show_products.php" id="categoryForm" onchange="category_subcategory()">
                                                <div class="card">
                                                    <div class="card-heading active">
                                                        <a class="red category_id" data-category-value="<?php echo $row['category_id']; ?>" data-toggle="collapse" data-target="#<?php echo str_replace(' ', '', $row['category_title']); ?>"><?php echo ucfirst($row['category_title']); ?></a>
                                                    </div>
                                                    <div id="<?php echo str_replace(' ', '', $row['category_title']); ?>" class="collapse show" data-parent="#accordionExample">
                                                        <div class="card-body">
                                                            <ul>
                                                                <?php
                                                                $query_for_subcategory = "SELECT * FROM subcategory WHERE category_id='$category_id'";
                                                                $query_for_subcategory_run = mysqli_query($conn, $query_for_subcategory);
                                                                if (mysqli_num_rows($query_for_subcategory_run) > 0) {
                                                                    while ($subcategorys = mysqli_fetch_assoc($query_for_subcategory_run)) {
                                                                ?>
                                                                        <li class="addstyle position-static">
                                                                            <input type="hidden" class="subcategory_id" value="<?php echo $subcategorys['subcategory_id']; ?>">
                                                                            <input type="hidden" class="category_id" value="<?php echo $subcategorys['category_id']; ?>">

                                                                            <label for="<?php echo ucfirst($subcategorys['subcategory_name']); ?>">
                                                                                <input type="checkbox" value="<?php echo $subcategorys['subcategory_id']; ?>" class="subcategory-checkbox" id="subcategory_name">
                                                                                <span class="checkmark"></span>
                                                                                <?php echo ucfirst($subcategorys['subcategory_name']); ?>
                                                                            </label>
                                                                        </li>
                                                                <?php
                                                                    }
                                                                }
                                                                ?>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                    <?php
                                        }
                                    }
                                    ?>

                                </div>
                            </div>
                        </div>
                        
                        <form action="display_products.php" onchange="category_subcategory()" method="get" id="byprice">
                            <div class="sidebar__filter">
                                <div class="section-title">
                                    <h4>Shop by price</h4>
                                </div>
                                <div class="filter-range-wrap">
                                    <div class="price-range ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content" data-min="100" data-max="10000"></div>
                                    <div class="range-slider">
                                        <div class="price-input">
                                            <p>Price:</p>
                                            <input type="text" id="minamount" name="min_price" placeholder="Min price">
                                            <input type="text" id="maxamount" name="max_price" placeholder="Max price">
                                        </div>
                                    </div>
                                </div>
                                <!-- <button onclick="category_subcategory()" type="button">Filter</button> -->
                                <a href="#" onclick="category_subcategory()">Filter</a>

                            </div>
                        </form>
                        
                        <form action="" method="post" id="bysize" onchange="category_subcategory()">

                            <div class="sidebar__sizes">
                                <div class="section-title">
                                    <h4>Shop by size</h4>
                                </div>
                                <div class="size__list">
                                    <label for="S">
                                        s
                                        <input type="checkbox" value="S" class="size-checkbox" id="S">
                                        <span class="checkmark"></span>
                                    </label>
                                    <label for="M">
                                        m
                                        <input type="checkbox" value="M" class="size-checkbox" id="M">
                                        <span class="checkmark"></span>
                                    </label>
                                    <label for="L">
                                        l
                                        <input type="checkbox" value="L" class="size-checkbox" id="L">
                                        <span class="checkmark"></span>
                                    </label>
                                    <label for="XL">
                                        xl
                                        <input type="checkbox" value="XL" class="size-checkbox" id="XL">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                        </form>


                        <form action="show_products.php" id="bycolor" method="get" onchange="category_subcategory()">

                            <div class="sidebar__color">
                                <div class="section-title">
                                    <h4>Shop by color</h4>
                                </div>
                                <div class="size__list color__list">
                                    <label for="black">
                                        Blacks
                                        <input type="checkbox" id="black" value="black" class="colorname">
                                        <span class="checkmark"></span>
                                    </label>
                                    <label for="whites">
                                        Whites
                                        <input type="checkbox" id="whites" value="white" class="colorname">
                                        <span class="checkmark"></span>
                                    </label>
                                    <label for="reds">
                                        Reds
                                        <input type="checkbox" id="reds" value="red" class="colorname">
                                        <span class="checkmark"></span>
                                    </label>
                                    <label for="greys">
                                        Greys
                                        <input type="checkbox" id="greys" value="grey" class="colorname">
                                        <span class="checkmark"></span>
                                    </label>
                                    <label for="blues">
                                        Blues
                                        <input type="checkbox" id="blues" value="blue" class="colorname">
                                        <span class="checkmark"></span>
                                    </label>

                                    <label for="greens">
                                        Greens
                                        <input type="checkbox" id="greens" value="green" class="colorname">
                                        <span class="checkmark"></span>
                                    </label>
                                    <label for="yellows">
                                        Yellows
                                        <input type="checkbox" value="yellow" id="yellows" class="colorname">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <?php $_SESSION['product'] = true; ?>
                <div class="col-lg-9 col-md-9">
                <div class="row" id="displayProduct">
                    <?php
                    if(isset($_SESSION['product'])){
                        if (isset($_GET['category_id'])) {
                            $category_id_for_all = $_GET['category_id'];
                            $query = "SELECT * FROM product_details WHERE category_id='$category_id_for_all'";
                        } else {
                            $query = "SELECT * FROM product_details";
                        }
                        $query_run = mysqli_query($conn, $query);
                        if ($query_run) {
                            while ($product = mysqli_fetch_assoc($query_run)) {
                                $productId = $product['product_id'];
                                $price = intval($product['product_price']);
                                $category_id=$product['category_id'];
                                  
                                ?>
                                <!-- Product display code here -->
                                <div onclick="window.location.href='product-details.php?product_id=<?php echo $productId; ?>'" class="col-lg-4 col-md-6 cursor">
                                    <div class="product__item">
                                        <div class="product__item__pic set-bg" data-setbg="adminpanel/image/<?php echo $product['product_image']; ?>">
                                            
                                        </div>
                                        <div class="product__item__text">
                                            <h6><a href="#"><?php echo $product['product_name']; ?></a></h6>
                                            <div class="rating">
                                                <?php
                                                $productId=$product['product_id'];
                                                include('display_review.php'); ?>
                                            </div>
                                            <?php include('discount_price.php') ?>

                                        <!-- <div class="product__price"><?php echo $product['price_currency']; ?> <?php echo ceil($total);?></div> -->
                                        </div>
                                    </div>                                    
                                </div>
                                <?php
                            }
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Shop Section End -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
    var rangeSlider = $(".price-range"),
        minamount = $("#minamount"),
        maxamount = $("#maxamount"),
        minPrice = rangeSlider.data('min'),
        maxPrice = rangeSlider.data('max');
        
    rangeSlider.slider({
        range: true,
        min: minPrice,
        max: maxPrice,
        values: [minPrice, maxPrice],
        slide: function (event, ui) {
            minamount.val(ui.values[0]);
            maxamount.val(ui.values[1]);
        }
    });

    minamount.val(rangeSlider.slider("values", 0));
    maxamount.val(rangeSlider.slider("values", 1));

        document.getElementById('categoryForm').addEventListener('change', function() {
        category_subcategory();
    });

    document.getElementById('bysize').addEventListener('change', function() {
        category_subcategory();
    });

    document.getElementById('byprice').addEventListener('submit', function(event) {
        // event.preventDefault();
        
        category_subcategory() });

    document.getElementById('bycolor').addEventListener('change', function() {
        category_subcategory();
    });

    function category_subcategory() {
        let subcategoryIds = new Set();
        $('.subcategory-checkbox:checked').each(function() {
            let subcategoryId = $(this).val();
            if (subcategoryId) {
                subcategoryIds.add(subcategoryId);
            }
        });

        let categoryIds = new Set();
        $('.subcategory-checkbox:checked').each(function() {
            let categoryId = $(this).closest('li').find('.category_id').val();
            if (categoryId) {
                categoryIds.add(categoryId);
            }
        });    

        let productBySize = [];
        $('.size-checkbox:checked').each(function() {
            productBySize.push($(this).val());
        });

        let productByColor = [];
        $('.colorname:checked').each(function() {
            productByColor.push($(this).val());
        });

        let minPrice = $('#minamount').val();
        let maxPrice = $('#maxamount').val();

        let url = 'display_products.php?';

        if (subcategoryIds.size > 0) {
            url += 'subcategory_id=' + Array.from(subcategoryIds).join(',');
        }

        if (categoryIds.size > 0) {
            url += '&category_id=' + Array.from(categoryIds).join(',');
        }

        if (productBySize.length > 0) {
            url += '&size=' + productBySize.join(',');
        }

        if (productByColor.length > 0) {
            url += '&color=' + productByColor.join(',');
        }
        
        if (minPrice && maxPrice) {
            url += '&min_price=' + minPrice + '&max_price=' + maxPrice;
        }

        let request = new XMLHttpRequest();
        
        request.open('GET', url, true);
        request.onload = function() {
            if (request.status == 200) {
                document.getElementById('displayProduct').innerHTML = request.responseText;
            } else {
                console.error('Failed to fetch products');
            }
        };
        request.send();

    }

    </script>
    <?php include('footer.php'); ?>