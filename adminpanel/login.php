<?php
session_start(); ?>
<style>
        .error {
            color: red;
            font-size: 12px;
        }
    </style>

<?php 
if (isset($_SESSION['auth']) && $_SESSION['auth'] == true) {
    header('Location: index.php');
    exit();
} ?>
<?php
include('includes/header.php');
?>
<div class="login-page">
<?php
if (isset($_SESSION['auth_status'])) {
?>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <?php echo $_SESSION['auth_status']; ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="color: black;">
            <a href="login.php"><span aria-hidden="true">&times;</span></a>
        </button>
    </div>
<?php
    unset($_SESSION['auth_status']);
}
?>
<?php include("message.php"); ?>
<div class="hold-transition ">

<div class="login-box ">

    <div class="login-logo">
        <a href="../../index2.html"><b>Admin</b>LTE</a>
    </div>
    
    <!-- /.login-logo -->
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Sign in to start your session</p>

            <form action="logincode.php" method="post">
                <div class="input-group mb-3">
                    <input type="email" class="form-control" placeholder="Enter your email" name="email" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" placeholder="Enter your password" name="password" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-8">
                        <div class="icheck-primary">
                            <input type="checkbox" id="remember">
                            <label for="remember">
                                Remember Me
                            </label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block" name="login">Log in</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

            <div class="social-auth-links text-center mb-3">
                <p>- OR -</p>
                <a href="#" class="btn btn-block btn-primary">
                    <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
                </a>
                <a href="#" class="btn btn-block btn-danger">
                    <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
                </a>
            </div>
            <!-- /.social-auth-links -->

            <p class="mb-1">
            <form action="forgotpassword.php" method="post" class="mb-0">
            <button name="forgotpassword" class="text-center " style="background-color: transparent; border: none; color:#5469d4;">I forgot my password</button>

                
            </form>

            </p>
            <p class="mb-0">
            <form action="newuser.php?" method="post" class="mb-0">

                <button name="newuser" class="text-center " style="background-color: transparent; border: none; color:#5469d4;">Register a new membership</button>
            </form>
            </p>
        </div>
        <!-- /.login-card-body -->
    </div>
</div>
</div>
</div>
<!-- /.login-box -->
