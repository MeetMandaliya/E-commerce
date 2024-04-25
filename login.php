<?php session_start(); ?>
<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ashion Template">
    <meta name="keywords" content="Ashion, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ashion | Template</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cookie&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

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
    .error {
    color: red;
    font-size: 12px;
}

</style>
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>
    <?php 
    // if (isset($_SESSION['status'])) {
    //     echo $_SESSION['status'];
    // }
    ?>
    <form action="logic.php" id="ValidateForm" method="post" class="checkout__form m-auto">
        <div class="row justify-content-around mt-5">
            <div class="col-lg-8">
                <h5>Login detail</h5>
                <div class="row">
                    <div class="col-lg-12 col-md-6 col-sm-6 mb-3">
                        <div class="checkout__form__input">
                            <p>Email <span>*</span></p>
                            <input type="email" name="email" class="textInput">
                            <span class="error"></span>
                        </div>
                    </div>
                    <div class="col-lg-12 mb-3">

                        <div class="checkout__form__input">
                            <p>Password <span>*</span></p>
                            <input type="password" name="password" class="textInput">
                            <span class="error"></span>
                        </div>

                    </div>

                </div>
                <button type="submit" name="login" class="site-btn">Log in</button>
                <a name="newuser" class="button style ml-4" href="forgotpassword.php">Forgot password</a>
                <a name="newuser" class="button ml-5 style" href="signup.php">Register a new membership</a>
                <button type="submit" name="logout" class="button ml-5 style bg-transparent border-light">Logout</button>
            </div>
        </div>
    </form>
   <!-- jQuery plugin .js files -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>

<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <script src="js/mixitup.min.js"></script>
    <script src="js/jquery.countdown.min.js"></script>
    <script src="js/jquery.slicknav.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.nicescroll.min.js"></script>
    <script src="js/main.js"></script>
</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>

<script>
    $(document).ready(function() {
        $('#ValidateForm').validate({
            rules: {
                email: {
                    required: true,
                    email: true,
                    pattern: /.+@.+\.(com|in|org|io)$/
                },
                password: {
                    required: true,
                    minlength:4,
                }
            },
            // messages: {
            //     email: {
            //         required: "Please enter your email",
            //         email: "Please enter a valid email address"
            //     },
            //     password: {
            //         required: "Please enter your password",
            //         minlength:"Password is too short!! Your password must be consist of at least 8 characters"
            //     }
            // },
            errorPlacement: function(error, element) {
                error.insertAfter(element);
            }
        });
    });
</script>

</html>