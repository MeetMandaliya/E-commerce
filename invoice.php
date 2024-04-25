<?php
session_start();
include('config/dbcon.php');
$_SESSION['no']=0;
?>
<!DOCTYPE html>
<html lang="zxx">
<head>
    <title>INVOICE </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">

    <!-- External CSS libraries -->
    <link type="text/css" rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="assets/fonts/font-awesome/css/font-awesome.min.css">

    <!-- Favicon icon -->
    <link rel="shortcut icon" href="assets/img/favicon.ico" type="image/x-icon" >

    <!-- Google fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900">

    <!-- Custom Stylesheet -->
    <link type="text/css" rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<?php if (isset($_GET['cart_id'])) {

$cart_id = $_GET['cart_id'];

$query_for_cart = "SELECT * FROM cart WHERE cart_unique_id='$cart_id'";
$query_for_cart_run = mysqli_query($conn, $query_for_cart);
if (mysqli_num_rows($query_for_cart_run) > 0) {
    while ($cart = mysqli_fetch_assoc($query_for_cart_run)) {
        $_SESSION['final'] = $cart['final_total'];
        $cart_id_for_invoice=$cart['cart_id'];

        $address_id = $cart['address'];
        $currentDate = date('d M Y');

    }
}
}
?>
<!-- Invoice start -->
<div class="invoice-1 invoice-content">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="invoice-inner clearfix">
                    <div class="invoice-info clearfix" id="invoice_wrapper">
                        <div class="invoice-headar">
                            <div class="row g-0">
                                <div class="col-sm-6">
                                    <div class="invoice-logo">
                                        <!-- logo started -->
                                        <div class="logo">
                                            <img src="img/logo.png" width="100px" alt="logo">
                                        </div>
                                        <!-- logo ended -->
                                    </div>
                                </div>
                                <div class="col-sm-6 invoice-id">
                                    <div class="info">
                                        <h1 class="color-white inv-header-1">Invoice</h1>
                                        <p class="color-white mb-1">Invoice Number <span>#<?php echo $cart_id_for_invoice; ?></span></p>
                                        <p class="color-white mb-0">Invoice Date <span><?php echo $currentDate;  ?></span></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="invoice-top">
                            <div class="row">
                            <?php $query_for_address = "SELECT * FROM address WHERE address_unique_id='$address_id'";
                $query_for_address_run = mysqli_query($conn, $query_for_address);
                if (mysqli_num_rows($query_for_address_run) > 0) {
                    while ($address = mysqli_fetch_assoc($query_for_address_run)) {
                        $name = empty($address['shipping_name']) ? $address['billing_name'] : $address['shipping_name'];
                        $email = empty($address['shipping_email']) ? $address['billing_email'] : $address['shipping_email'];
                        $phone = empty($address['shipping_phone']) ? $address['billing_phone_no'] : $address['shipping_phone'];
                        $address_data = empty($address['shipping_address']) ? $address['billing_address'] : $address['shipping_address'];
                        $city = empty($address['shipping_city']) ? $address['billing_city'] : $address['shipping_city'];
                        $state = empty($address['shipping_state']) ? $address['billing_state'] : $address['shipping_state'];
                        $country = empty($address['shipping_country']) ? $address['billing_country'] : $address['shipping_country'];
                        $city=$address['billing_city'];
                ?>
                                <div class="col-sm-6">
                                    <div class="invoice-number mb-30">
                                        <h4 class="inv-title-1">Billing Details</h4>
                                        <h2 class="name mb-10"><?php echo $address['billing_name']; ?></h2>
                                        <p class="invo-addr-1">
                                            <?php echo $address['billing_phone_no'];; ?><br/>
                                            <?php echo $address['billing_email']; ?> <br/>
                                            <?php echo ucfirst($address['billing_address']) . ', ' . $city; ?>   <br/>
                                            <?php echo $address['billing_state'] . ', ' . $address['billing_country']; ?>   <br/>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="invoice-number mb-30">
                                        <div class="invoice-number-inner">
                                            <h4 class="inv-title-1">Shipping Details</h4>
                                            <h2 class="name mb-10"><?php echo $name; ?></h2>
                                            <p class="invo-addr-1">
                                                <?php echo $phone; ?>  <br/>
                                                <?php echo $email; ?><br/>
                                                <?php echo ucfirst($address_data) . ', ' . $city ?> <br/>
                                                <?php echo $state . ', ' . $country  ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <?php }
                } ?>
                            </div>
                        </div>
                        <div class="invoice-center">
                            <div class="table-responsive">
                                <table  class="table mb-0 table-striped invoice-table">
                                    <thead  class="bg-active">
                                    <tr class="tr">
                                        <th>No.</th>
                                        <th class="pl0 text-start">Item Description</th>
                                        <th class="text-center">Price</th>
                                        <th class="text-center">Quantity</th>
                                        <th class="text-end">Amount</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr class="tr">
                                    <tr  class="tr">
                                    <?php $query = "SELECT * FROM cart_item WHERE cart_unique_id='$cart_id'";
                    $query_run = mysqli_query($conn, $query);
                    if (mysqli_num_rows($query_run) > 0) {
                        while ($row = mysqli_fetch_assoc($query_run)) {
                            $total_of_allproduct = $row['final_total'];
                            $product_quantity = $row['product_quantity'];
                            $subtotal_of_oneproduct = $total_of_allproduct / $product_quantity;
                            $product_id = $row['product_id'];
                            $query_for_product_name = "SELECT * FROM product_details WHERE product_id='$product_id'";
                            $query_for_product_name_run = mysqli_query($conn, $query_for_product_name);
                            $_SESSION['no'] = 0;
                            if (mysqli_num_rows($query_for_product_name_run) > 0) {
                                while ($product_name = mysqli_fetch_assoc($query_for_product_name_run)) {
                                    $_SESSION['no'] += 1;
                                    $product_name = $product_name['product_name'];  ?>
                                        <td>
                                            <div class="item-desc-1">
                                                <span>0<?php echo $_SESSION['no'];?></span>
                                            </div>
                                        </td>
                                        <td class="pl0"><?php echo $product_name; ?></td>
                                        <td class="text-center">$ <?php echo $subtotal_of_oneproduct;  ?></td>
                                        <td class="text-center"><?php echo $row['product_quantity'];  ?></td>
                                        <td class="text-end">$ <?php echo $row['final_total']; ?></td>
                                    </tr>
                                    <?php }
                            }
                        }
                    } ?>
                                    <tr class="tr2">
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class="text-center">SubTotal</td>
                                        <td class="text-end">$ <?php echo $_SESSION['final']; ?></td>
                                    </tr>
                                    <tr class="tr2">
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class="text-center">Tax</td>
                                        <td class="text-end">$ <?php echo 0; ?></td>
                                    </tr> 
                                    <tr class="tr2">
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class="text-center f-w-600 active-color">Grand Total</td>
                                        <td class="f-w-600 text-end active-color">$ <?php echo $_SESSION['final']; ?></td>
                                    </tr> 
                                   
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="invoice-bottom">
                            <div class="row">
                                <div class="col-lg-6 col-md-8 col-sm-7">
                                    <div class="mb-30 dear-client">
                                        <h3 class="inv-title-1">Terms & Conditions</h3>
                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been typesetting industry. Lorem Ipsum</p>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-4 col-sm-5">
                                    <div class="mb-30 payment-method">
                                        <h3 class="inv-title-1">Payment Method</h3>
                                        <ul class="payment-method-list-1 text-14">
                                            <li><strong>Account No:</strong> 00 123 647 840</li>
                                            <li><strong>Account Name:</strong> Jhon Doe</li>
                                            <li><strong>Branch Name:</strong> xyz</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="invoice-contact clearfix">
                            <div class="row g-0">
                                <div class="col-lg-9 col-md-11 col-sm-12">
                                    <div class="contact-info">
                                        <a href="tel:+55-4XX-634-7071"><i class="fa fa-phone"></i> +91 123 647 1840</a>
                                        <a href="tel:info@themevessel.com"><i class="fa fa-envelope"></i> info@ashion.com</a>
                                        <a href="tel:info@themevessel.com" class="mr-0 d-none-580"><i class="fa fa-map-marker"></i> 169 Teroghoria, India</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="invoice-btn-section clearfix d-print-none">
                        <a id="invoice_download_btn" class="btn btn-lg btn-download btn-theme">
                            <i class="fa fa-download"></i> Download Invoice
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Invoice end -->

<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/jspdf.min.js"></script>
<script src="assets/js/html2canvas.js"></script>
<script src="assets/js/app.js"></script>
</body>
</html>
