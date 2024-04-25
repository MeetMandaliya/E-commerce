<?php
session_start();
include('header.php'); ?>
<style>
    .display_address{
        width: 300px;
        height: 40vh;
        border-radius: 20%;
        border: 1px solid black;
        position: relative;
    }
</style>

<!-- Breadcrumb Begin -->
<div class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__links">
                    <a href="./index.php"><i class="fa fa-home"></i> Home</a>
                    <span>Contact</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->
<!-- Contact Section Begin -->
<div class="col-lg-3">
                            <div class="checkout__order mt-4">
                                <h5 class="mb-4 text-bolder">My Account</h5>
                                <div class="checkout__order__product">
                                    <ul>
                                        <li class="cursor" onclick="getprofile()">My Profile </li>
                                        <li class="cursor" onclick="getaddress()">Delivery Address</li>
                                        <li class="cursor" onclick="getorders()">My Orders</li>
                                        <li class="cursor" onclick="getwishlist()">My Wishlist</li>
                                    </ul>
                                </div>
                            </div>
                        </div>


<section class="contact spad">
    <div class="container">

        <div class="section flex">
            <div class="add_address">
                <?php  if(isset($_SESSION['auth']) == true){

                 echo   '<a href="#" data-toggle="modal" data-target="#AddUserModal" class="plus">+</a>';
                  echo  '<h2>Add address</h2>';

                }else{
                 echo   '<a href="login.php" class="plus">+</a>';
                 $_SESSION['status']="You are not looged in";
                 echo  '<h2>Add address</h2>';
                }
                    ?>

            </div>
            <?php if (isset($_SESSION['auth'])) { ?>

                <div class="login " onclick=window.location.href='login.php'>
                    <h2><?php echo $_SESSION['auth_user']['name']; ?></h2>

                <?php   }  ?>
                </div>
        </div>
        <!-- <form action="#" class="checkout__form">
            <div class="row">
                <div class="col-lg-8">
                    <h5>Billing detail</h5>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="checkout__form__input">
                                <p>Name <span>*</span></p>
                                <input type="text">
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="checkout__form__input">
                                <p>Country <span>*</span></p>
                                <input type="text">
                            </div>
                            <div class="checkout__form__input">
                                <p>Address <span>*</span></p>
                                <input type="text" placeholder="Street Address">
                                <input type="text" placeholder="Apartment. suite, unite ect ( optinal )">
                            </div>
                            <div class="checkout__form__input">
                                <p>Town/City <span>*</span></p>
                                <input type="text">
                            </div>
                            <div class="checkout__form__input">
                                <p>Country/State <span>*</span></p>
                                <input type="text">
                            </div>
                            <div class="checkout__form__input">
                                <p>Postcode/Zip <span>*</span></p>
                                <input type="text">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form> -->
        <!-- <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="contact__content">
                    <div class="contact__address">
                        <h5>Contact info</h5>
                        <ul>
                            <li>
                                <h6><i class="fa fa-map-marker"></i> Address</h6>
                                <p>160 Pennsylvania Ave NW, Washington, Castle, PA 16101-5161</p>
                            </li>
                            <li>
                                <h6><i class="fa fa-phone"></i> Phone</h6>
                                <p><span>125-711-811</span><span>125-668-886</span></p>
                            </li>
                            <li>
                                <h6><i class="fa fa-headphones"></i> Support</h6>
                                <p>Support.photography@gmail.com</p>
                            </li>
                        </ul>
                    </div>
                    <div class="contact__form">
                        <h5>SEND MESSAGE</h5>
                        <form action="#">
                            <input type="text" placeholder="Name">
                            <input type="text" placeholder="Email">
                            <input type="text" placeholder="Website">
                            <textarea placeholder="Message"></textarea>
                            <button type="submit" class="site-btn">Send Message</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="contact__map">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d48158.305462977965!2d-74.13283844036356!3d41.02757295168286!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c2e440473470d7%3A0xcaf503ca2ee57958!2sSaddle%20River%2C%20NJ%2007458%2C%20USA!5e0!3m2!1sen!2sbd!4v1575917275626!5m2!1sen!2sbd" height="780" style="border:0" allowfullscreen="">
                    </iframe>
                </div>
            </div>
        </div> -->


        <div class="modal fade" id="AddUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content bigsize">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Add New Address</h1>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="address.php" method="post" class="checkout__form">
                        <div>
                            <div class="col-lg-10 center">
                                <!-- <h5 class="justify-content-center">Add New Address</h5> -->
                                <div class="row">
                                <?php if(isset($_SESSION['auth'])){
                                
                                 ?>
                                <input type="hidden" name="email" value="<?php echo $_SESSION['auth_user']['email']; ?>">
                                   <?php
                                }  ?>
                                    <div class="col-lg-12 mt-4">
                                        <div class="checkout__form__input">
                                            <p>Address <span>*</span></p>
                                            <input type="text" name="address" placeholder="Street Address">
                                        </div>
                                        <div class="checkout__form__input">
                                            <p>Town/City <span>*</span></p>
                                            <input name="city" type="text">
                                        </div>
                                        <div class="checkout__form__input">
                                            <p>State <span>*</span></p>
                                            <input name="state" type="text">
                                        </div>
                                        <div class="checkout__form__input">
                                            <p>Country <span>*</span></p>
                                            <input name="country" type="text">
                                        </div>
                                        <div class="checkout__form__input">
                                            <p>Postcode/Zip <span>*</span></p>
                                            <input name="zipcode" type="number">
                                        </div>
                                        <button type="submit" name="add_address" class="mb-4 design">Add Address</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Contact Section End -->

<?php include('footer.php'); ?>

<script>

    function getprofile(){
console.log('true');
    }
</script>