
<?php
include('config/dbcon.php');
session_start();
if (isset($_GET['address_id'])) {
    $address_id = $_GET['address_id'];
    $query = "SELECT * FROM address WHERE address_id='$address_id'";
    $query_run = mysqli_query($conn, $query);
    if (mysqli_num_rows($query_run) > 0) {
        while ($row = mysqli_fetch_assoc($query_run)) {
            $address = $row['billing_address'];
            $city = $row['billing_city'];
            if (empty($city)) {
                $city = "";
            }
            $country = $row['billing_country'];
            if (empty($country)) {
                $country = "";
            }
            $zipcode = $row['billing_zipcode'];
            if (empty($zipcode)) {
                $zipcode = "";
            }
            if (empty($address)) { ?>

                <div class="col-lg-12 col-md-12 col-sm-12 mt-3">
                    <div class="checkout__form__input">
                        <p>Address <span>*</span></p>
                        <input class="textInput" type="text" name="address" placeholder="Enter Address" >
                    </div>
                </div>
            <?php
            }

            ?>
            <div class="col-lg-12 col-md-12 col-sm-12 mt-3">
                <div class="checkout__form__input">
                    <p>Town/City <span>*</span></p>
                    <input class="textInput" type="text" name="city" value="<?php echo $row['billing_city']; ?>" >
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 mt-3">
                <div class="checkout__form__input">
                    <p>State <span>*</span></p>
                    <input class="textInput" type="text" name="state" value="<?php echo $row['billing_city']; ?>" >
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 mt-3">
                <div class="checkout__form__input">
                    <p>Country <span>*</span></p>
                    <input class="textInput" type="text" name="country" value="<?php echo $row['billing_country']; ?>" >
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 mt-3">
                <div class="checkout__form__input">
                    <p>Postcode/Zip <span>*</span></p>
                    <input class="textInput" type="text" name="zipcode" value="<?php echo $row['billing_zipcode']; ?>" >
                </div>
            </div>
            
    <?php
        }
    }
}

if (isset($_GET['shipping_address']) == true) { ?>
    <h5 class="mt-4">Shipping Details</h5>
    <div class="col-lg-12 col-md-12 col-sm-12 mt-3">
        <div class="checkout__form__input">
            <p>Name <span>*</span></p>
            <input class="textInput" type="text" name="shipping_name">
        </div>

        <div class="checkout__form__input mt-3">
            <p>Address <span>*</span></p>
            <input class="textInput" type="text" placeholder="Street Address" name="shipping_address">
        </div>
        <div class="checkout__form__input mt-3">
            <p>Town/City <span>*</span></p>
            <input class="textInput" type="text" name="shipping_city" >
        </div>

        <div class="checkout__form__input mt-3">
            <p>State <span>*</span></p>
            <input class="textInput" type="text" name="shipping_state" >
        </div>
        <div class="checkout__form__input mt-3">
            <p>Country <span>*</span></p>
            <input class="textInput" type="text" name="shipping_country" >
        </div>
        <div class="checkout__form__input mt-3">
            <p>Postcode/Zip <span>*</span></p>
            <input class="textInput" type="number" name="shipping_zipcode" >
        </div>
        <div class="checkout__form__input mt-3">
            <p>Phone <span>*</span></p>
            <input class="textInput" type="number" name="shipping_phone" >
        </div>
        <div class="checkout__form__input mt-3">
            <p>Email <span>*</span></p>
            <input class="textInput" type="email" name="shipping_email" >
        </div>
    </div>

<?php
}
?>
