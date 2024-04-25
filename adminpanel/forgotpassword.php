<?php
session_start(); 
if(isset($_SESSION['auth'])== true){
  header('Location:index.php');
  exit();
}
?>
<?php
include('includes/header.php');
?>
<div class="hold-transition login-page">
  <?php
  include('message.php');
  ?>
  <div class="login-box">
    <div class="login-logo">
      <a href="../../index2.html"><b>Admin</b>LTE</a>
    </div>

    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">You forgot your password? Here you can easily retrieve a new password.</p>
        <form action="code.php" method="post">
          <div class="input-group mb-3">
            <input type="email" class="form-control" placeholder="Enter your email" name="checkemail" required>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <button type="submit" name="emailforforgotpassword" value="emailforforgotpassword" class="btn btn-primary btn-block">Request new password</button>
            </div>
            <!-- /.col -->
          </div>
        </form>
        <p class="mt-3 mb-1">
          <a href="login.php">Login</a>
        </p>
        <p class="mb-0">
          <a href="newuser.php" class="text-center">Register a new membership</a>
        </p>
      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
  <!-- /.login-box -->
</div>