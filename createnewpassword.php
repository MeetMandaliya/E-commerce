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
    // echo $_SESSION['status'];
      ?>
    <form action="logic.php" id="ValidateForm" method="post" class="checkout__form m-auto">
        <div class="row justify-content-around mt-5">
            <div class="col-lg-8">
                <h5>FORGOT PASSWORD</h5>
                <div class="row ">
                    <div class="col-lg-12 col-md-6 col-sm-6 mt-3">
                        <div class="checkout__form__input">
                            <p>Password <span>*</span></p>
                            <input type="password" id="password" name="createpassword" placeholder="Enter Your Password" required>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-6 col-sm-6 mt-3">
                        <div class="checkout__form__input">
                            <p>Confirm Password <span>*</span></p>
                            <input type="password" id="confirmpassword" name="confirmcreatepassword" placeholder="Enter Your Password" required>
                        </div>
                    </div>
                    
                </div>
                <button type="submit" name="changepassword" class="site-btn mt-3">Continue</button> 
            </div>
        </div>
    </form>
    <!-- Js Plugins -->
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
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>

    <script>
        $(document).ready(function() {

            $('#ValidateForm').validate({
                rules: {

                    createpassword: {
                        required: true,
                        minlength: 8,
                        containsUppercase: true,
                        containsLowercase: true,
                        containsDigit: true,
                        containsSpecialCharacter: true
                    },
                    confirmcreatepassword: {
                        required: true,
                        equalTo: '#password'
                    }
                },
                messages: {
                    createpassword: {
                        required: "Please enter your password",
                        minlength: "Password is too short! Your password must be at least 8 characters long"
                    },
                    confirmcreatepassword: {
                        required: "Please enter your password",
                        equalTo: "Please enter the same password again."
                    }
                },
            })
            $.validator.addMethod("containsUppercase", function(value) {
                return /[A-Z]/.test(value);
            }, "Password must contain at least one uppercase letter");

            $.validator.addMethod("containsLowercase", function(value) {
                return /[a-z]/.test(value);
            }, "Password must contain at least one lowercase letter");

            $.validator.addMethod("containsDigit", function(value) {
                return /\d/.test(value);
            }, "Password must contain at least one digit");

            $.validator.addMethod("containsSpecialCharacter", function(value) {
                return /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]+/.test(value);
            }, "Password must contain at least one special character");
        });
        // });
    </script>
</body>

</html>