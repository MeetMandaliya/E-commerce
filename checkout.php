<?php
session_start();
include('header.php');
include('config/dbcon.php');
?>
<style>
    .font_size {
        font-size: 14px;
        color: #666666;
    }

    .error {
        color: red;
        font-size: 12px;
    }

    .form-select {
        height: 50px;
    }
</style>

<!-- Breadcrumb Begin -->
<div class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__links">
                    <a href="./index.php"><i class="fa fa-home"></i> Home</a>
                    <span>Shopping cart</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->
<!-- Checkout Section Begin -->
<section class="checkout spad">
    <div class="container">
        <div class="row">
            <?php
            // echo $cart_unique_id=isset($_SESSION['cart_unique_id'])?$_SESSION['cart_unique_id']:""; 
            ?>
            <form action="checkout_details.php" id="ValidateForm" class="checkout__form" method="post">
                <div class="row">
                    <div class="col-lg-8">
                        <h5>Billing detail</h5>

                        <?php if (isset($_SESSION['auth']) && isset($_SESSION['auth_user'])) {
                            $id = $_SESSION['auth_user']['id'];
                            $query = "SELECT * FROM users WHERE id='$id'";
                            $query_run = mysqli_query($conn, $query);
                            if (mysqli_num_rows($query_run) > 0) {
                                $row = mysqli_fetch_assoc($query_run);
                        ?>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="checkout__form__input">
                                        <p>Name <span>*</span></p>
                                        <input type="text" name="name" class="textInput" value="<?php echo $_SESSION['auth_user']['name']; ?>">
                                        <p class="error"></p>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="checkout__form__input">
                                        <p>Phone <span>*</span></p>
                                        <input type="number" name="phone" class="textInput" value="<?php echo $_SESSION['auth_user']['phoneno'];  ?>">
                                        <p class="error"></p>

                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="checkout__form__input">
                                        <p>Email <span>*</span></p>
                                        <input type="email" class="textInput" name="email" value="<?php echo $_SESSION['auth_user']['email'];  ?>">
                                        <p class="error"></p>

                                    </div>
                                </div>
                                <?php $query_for_address_check = "SELECT * FROM address WHERE login_id='$id'";
                                $query_for_address_check_run = mysqli_query($conn, $query_for_address_check);
                                if (mysqli_num_rows($query_for_address_check_run) == 0) { ?>
                                    <div class="col-lg-12">
                                        <div class="checkout__form__input mt-3">
                                            <p>Address <span>*</span></p>
                                            <input type="text" class="textInput" name="address" placeholder="Street Address">
                                        </div>
                                        <div class="checkout__form__input mt-3">
                                            <p>Town/City <span>*</span></p>
                                            <input type="text" class="textInput" name="city">
                                        </div>
                                        <div class="checkout__form__input mt-3">
                                            <p>State <span>*</span></p>
                                            <input type="text" class="textInput" name="state">
                                        </div>
                                        <div class="checkout__form__input mt-3">
                                            <p>Country <span>*</span></p>
                                            <input type="text" class="textInput" name="country">
                                        </div>
                                        <div class="checkout__form__input mt-3">
                                            <p>Postcode/Zip <span>*</span></p>
                                            <input type="number" class="textInput" name="zipcode">
                                        </div>
                                        <div class="checkout__form__checkbox">
                                            <label for="note">
                                                Add a different shipping address
                                                <input type="checkbox" id="note">
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                        <div id="display_shipping_address_details">

                                        </div>
                                    </div>
                                <?php   } else { ?>
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="checkout__form__input">
                                            <p>Address <span>*</span></p>
                                            <select onchange="get_other_details()" class="font_size form-select form-select-lg mb-3 " id="selectedOption" aria-label=".form-select-lg example" name="address_id">
                                                <option value="add" selected>Select address</option>
                                                <?php
                                                $query_for_address = "SELECT DISTINCT billing_address, address_id FROM address WHERE login_id='$id'";
                                                $query_for_address_run = mysqli_query($conn, $query_for_address);

                                                if (mysqli_num_rows($query_for_address_run) > 0) {
                                                    while ($address = mysqli_fetch_assoc($query_for_address_run)) {
                                                        $single_address = '';
                                                        if (!empty($address['billing_address'])) {
                                                            $single_address = $address['billing_address'];
                                                        }
                                                        if (!empty($single_address)) {
                                                            $address_value = $address['address_id'];
                                                ?>
                                                            <option value="<?php echo $address_value; ?>">
                                                                <?php echo $single_address; ?>
                                                            </option>
                                                <?php
                                                        }
                                                    }
                                                } ?>
                                            </select>
                                            <span id="addressError" class="error" style="display: none;">Please select an address</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="checkout__form__checkbox">
                                            <label for="note">
                                                Add a different shipping address
                                                <input type="checkbox" id="note">
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </div>
                                <?php } ?>
                                <div id="add_user_details"></div>
                                <div id="display_shipping_address_details">
                                </div>

                            <?php
                            }
                            //     }else {
                            //         echo "<a class='btn btn-dark' href='shop.php'>Add Product For Checkout</a>";
                            // } 

                        } else { ?>

                            <div class="col-lg-12">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="checkout__form__input">
                                        <p>Name <span>*</span></p>
                                        <input class="textInput" type="text" name="name">
                                        <p class="error"></p>
                                    </div>
                                </div>
                                <div class="col-lg-12">

                                    <div class="checkout__form__input mt-3">
                                        <p>Address <span>*</span></p>
                                        <input class="textInput" type="text" placeholder="Street Address" name="address">
                                        <p class="error"></p>

                                    </div>
                                    <div class="checkout__form__input mt-3">
                                        <p>Town/City <span>*</span></p>
                                        <input class="textInput" type="text" name="city">
                                        <p class="error"></p>

                                    </div>
                                    <div class="checkout__form__input mt-3">
                                        <p>State <span>*</span></p>
                                        <input class="textInput" type="text" name="state">
                                        <p class="error"></p>

                                    </div>
                                    <div class="checkout__form__input mt-3">
                                        <p>Country <span>*</span></p>
                                        <input class="textInput" type="text" name="country">
                                        <p class="error"></p>

                                    </div>
                                    <div class="checkout__form__input mt-3">
                                        <p>Postcode/Zip <span>*</span></p>
                                        <input class="textInput zipcode" type="text" id="zipcode" name="zipcode">
                                        <p class="error"></p>

                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 mt-3">
                                    <div class="checkout__form__input">
                                        <p>Phone <span>*</span></p>
                                        <input class="textInput zipcode" type="text" name="phone">
                                        <p class="error"></p>

                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 mt-3">
                                    <div class="checkout__form__input">
                                        <p>Email <span>*</span></p>
                                        <input class="textInput" type="email" name="email">
                                        <p class="error"></p>

                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="checkout__form__checkbox mt-3">
                                        <label for="note">
                                            Add a different shipping address
                                            <input type="checkbox" id="note">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                    <div id="display_shipping_address_details">

                                    </div>
                                </div>
                            </div>
                        <?php    }
                        ?>
                    </div>

                    <div class="col-lg-4">
                        <div class="checkout__order">
                            <h5>Your order</h5>
                            <div class="checkout__order__product">
                                <ul>
                                    <li>
                                        <span class="top__text">Product</span>
                                        <span class="top__text__right">Total</span>
                                    </li>
                                    <?php if (isset($_SESSION['cart_unique_id'])) {
                                        $cart_unique_id = $_SESSION['cart_unique_id'];
                                        $query = "SELECT * FROM cart_item WHERE cart_unique_id='$cart_unique_id'";
                                        $query_run = mysqli_query($conn, $query);
                                        if (mysqli_num_rows($query_run) > 0) {
                                            while ($row = mysqli_fetch_assoc($query_run)) {
                                                $product_id = $row['product_id'];
                                                $query_for_product = "SELECT * FROM product_details WHERE product_id='$product_id'";
                                                $query_for_product_run = mysqli_query($conn, $query_for_product);
                                                if (mysqli_num_rows($query_for_product_run) > 0) {
                                                    while ($product = mysqli_fetch_assoc($query_for_product_run)) {
                                    ?>
                                                        <li><?php echo $product['product_name']; ?> <span>₹ <?php echo $row['final_total'];  ?></span></li>
                                    <?php
                                                    }
                                                }
                                            }
                                        }
                                    }
                                    ?>
                                </ul>
                            </div>
                            <div class="checkout__order__total">
                                <ul>
                                    <?php if (isset($_SESSION['cart_unique_id'])) {
                                        $cart_unique_id = $_SESSION['cart_unique_id'];
                                        $query = "SELECT * FROM cart_item WHERE cart_unique_id='$cart_unique_id'";
                                        $query_run = mysqli_query($conn, $query);
                                        $_SESSION['product_total'] = 0;
                                        if (mysqli_num_rows($query_run) > 0) {
                                            while ($row = mysqli_fetch_assoc($query_run)) {
                                                $_SESSION['product_total'] += $row['final_total'];
                                            };
                                    ?>
                                            <li>Subtotal <span>₹ <?php echo $_SESSION['product_total'] ?></span></li>
                                            <li>Total <span>₹ <?php echo $_SESSION['product_total']; ?></span></li>
                                    <?php
                                        }
                                    }
                                    ?>
                                </ul>
                            </div>
                            <div class="checkout__order__widget">
                                <label for="check-payment">
                                    Cash on delivery
                                    <input type="radio" id="check-payment" name="payment_method" value="cash" checked>
                                    <span class="checkmark"></span>
                                </label>
                                <label for="paypal">
                                    PayPal
                                    <input type="radio" id="paypal" name="payment_method" value="paypal">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <?php  ?>
                            <button type="submit" class="site-btn" name="place_order">Place order</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
</section>
<!-- Checkout Section End -->

<?php include('footer.php'); ?>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
<script>
    $(document).ready(function() {
        $.validator.addMethod("notEqualTo", function(value, element, parameter) {
            return value !== parameter;
        }, "Please select a valid option.");

        $('.zipcode').on('keypress', function(event) {
        var charCode = (event.which) ? event.which : event.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            event.preventDefault();
        }
    });

        $('#ValidateForm').validate({
            rules: {
                email: {
                    required: true,
                    email: true,
                    pattern: /.+@.+\.(com|in|org|io|co)$/
                },
                address_id: {
                    required: true,
                    notEqualTo: "add"
                },
                name: {
                    required: true,
                    minlength: 4,
                },
                city: {
                    required: true,
                    minlength: 4,
                    pattern: /^[a-zA-Z]+$/
                },
                country: {
                    required: true,
                    minlength: 4
                },
                state: {
                    required: true,
                    minlength: 4
                },
                zipcode: {
                    digits: true,
                    required: true,
                    minlength: 4
                },
                phone: {
                    required: true,
                    maxlength: 10,
                    minlength: 10
                }
            },
            messages: {
                email: {
                    required: "Please enter your email",
                    email: "Please enter a valid email address",
                    pattern: "Please enter a valid email address with .com, .in, .org, .io, or .co domain"
                },
                phone: {
                    required: "Please enter your phone number",
                    maxlength: "Phone number cannot exceed 10 digits"
                }
            },
            errorPlacement: function(error, element) {
                error.insertAfter(element);
            }
        });
    });
</script>


<script>
    // $(document).ready(function() {
    //     $('#myForm').submit(function(event) {
    //         event.preventDefault();
    //         let isValid = true;

    // var selectedOption = $('#selectedOption').val();
    // console.log(selectedOption);
    // if (selectedOption === 'add') {
    //     $('#addressError').show(); 
    //     event.preventDefault(); 
    // }
    //         $('.textInput').each(function() {
    //             let inputData = $(this).val();
    //             if (inputData.trim() === '') {
    //                 $(this).next('.error').text("Please enter a value in this field");
    //                 isValid = false;
    //             } else {
    //                 $(this).next('.error').text('');
    //             }
    //         });

    //         if (isValid) {
    //             this.submit();
    //         }
    //     });
    // });
    document.getElementById('note').addEventListener('change', function() {
        let shippingAddressForm = document.getElementById('note');

        if (shippingAddressForm.checked) {
            let xhr = new XMLHttpRequest();
            xhr.open('GET', 'show_address_details.php?shipping_address=' + true, true);

            xhr.onload = function() {
                if (xhr.status == 200) {
                    document.getElementById('display_shipping_address_details').innerHTML = xhr.responseText;
                } else {
                    console.error('Failed to fetch address details');
                }
            };
            xhr.send();
        } else {
            document.getElementById('display_shipping_address_details').innerHTML = '';

        }
    });

    function get_other_details() {
        let selectedAddress = document.querySelector('select[name="address_id"]').value;
        // console.log(selectedAddress);
        let xhr = new XMLHttpRequest();
        xhr.open('GET', 'show_address_details.php?address_id=' + selectedAddress, true);

        xhr.onload = function() {
            if (xhr.status == 200) {
                document.getElementById('add_user_details').innerHTML = xhr.responseText;
            } else {
                console.error('Failed to fetch address details');
            }
        };
        xhr.send();
    }
</script>