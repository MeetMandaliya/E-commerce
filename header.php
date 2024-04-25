
<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ashion Template">
    <meta name="keywords" content="Ashion, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Fashion Cart </title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cookie&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Css Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="css/magnific-popup.css" type="text/css">
    <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">

    <style>
    .header__right__auth .dropdown-options {
        display: none;
        position: absolute;
        top: 100%;
        right: 0;
        background: #fff;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        z-index: 999;
    }

    .header__right__auth:hover .dropdown-options {
        display: block;
    }

    .dropdown-options a {
        display: block;
        padding: 10px;
        text-decoration: none;
        color: #333;
        z-index: 1;
    }

    .dropdown-options a:hover {
        background-color: #f5f5f5;
        z-index: 1;
    }
</style>
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Offcanvas Menu Begin -->
    <div class="offcanvas-menu-overlay"></div>
    <div class="offcanvas-menu-wrapper">
        <div class="offcanvas__close">+</div>
        
        <div class="offcanvas__logo">
            <a href="./index.php"><img src="./img/logo.png" style="width: 250px; height: 60px;" alt=""></a>
        </div>
        <div id="mobile-menu-wrap"></div>
        <div class="offcanvas__auth">
            <a href="login.php">Login</a>
            <a href="signup.php">Register</a>
        </div>
    </div>
    <!-- Offcanvas Menu End -->

    <!-- Header Section Begin -->
    <header class="header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-3 col-lg-2">
                    <div class="header__logo">
                        <a href="./index.php"><img src="img/logo.png" style="width: 150px;" alt=""></a>
                    </div>
                </div>
                
<?php
function isActivePage($pagePath) {
    $currentPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    return $currentPath == $pagePath ? 'class="active"' : '';
}
?>
<div class="col-xl-6 col-lg-7">
    <nav class="header__menu">
        <ul>
        <li><a <?php if (basename($_SERVER['SCRIPT_NAME']) == 'index.php') echo 'class="active"'; ?> href="index.php">Home</a></li>
        <li><a <?php if (basename($_SERVER['SCRIPT_NAME']) == 'shop.php') echo 'class="active"'; ?> href="shop.php">Shop</a></li>
        <li><a <?php if (basename($_SERVER['SCRIPT_NAME']) == 'shop-cart.php') echo 'class="active"'; ?> href="shop-cart.php">Cart</a></li>
        <li><a <?php if (basename($_SERVER['SCRIPT_NAME']) == 'blog.php') echo 'class="active"'; ?> href="blog.php">Blog</a>
        </li>
            <li <?php echo isActivePage('/E-commerce/blog.php'); ?>>
                <a href="#">Pages</a>
                <ul class="dropdown">
                    <li <?php echo isActivePage('/E-commerce/product-details.php'); ?>><a href="./product-details.php">Product Details</a></li>
                    <li><a href="./checkout.php">Checkout</a></li>
                    <li><a href="./blog-details.php">Blog Details</a></li>
                </ul>
            </li>
            <li <?php echo isActivePage('/E-commerce/account.php'); ?>><a href="./account.php">Account</a></li>
        </ul>
    </nav>
</div>
                <div class="col-lg-3">
                    <div class="header__right">
                        <div class="header__right__auth">
                            
                            <?php if (isset($_SESSION['auth_user']) && isset($_SESSION['auth'])) { ?>
                                <a href="account.php" ><?php echo $_SESSION['auth_user']['name']; ?></a>
                                <?php } else { ?>
                                    <a href="login.php">Login</a>
                                    <a href="signup.php">Register</a>
                                <?php

                            }  ?>
                        </div>
                        <!-- <----new----->
                     <!-- <div class="header__right__auth">
    <?php if (isset($_SESSION['auth_user']) && isset($_SESSION['auth'])) { ?>
        <div class="dropdown-options ">
            <a href="my_account.php">My Account</a>
            <a href="logout.php">Logout</a>
        </div>
        <a href=""><?php echo $_SESSION['auth_user']['name']; ?></a>
    <?php } else { ?>
        <a href="login.php">Login</a>
        <a href="signup.php">Register</a>
    <?php } ?>
</div>  -->
                        <!-- <----new-----> 

                        <!-- <ul class="header__right__widget"> -->
                            <!-- <li><span class="icon_search search-switch"></span></li>
                            <li><a href="#"><span class="icon_heart_alt"></span>
                                    <div class="tip">2</div>
                                </a></li>
                            <li><a href="#"><span class="icon_bag_alt"></span>
                                    <div class="tip">2</div>
                                </a></li> -->
                        <!-- </ul> -->
                    </div>
                </div>
            </div>
            <div class="canvas__open">
                <i class="fa fa-bars"></i>
            </div>
        </div>
    </header>
    <body>
    <!-- Header Section End -->