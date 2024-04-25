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
  <div class="login-box">
    <?php include('message.php'); ?>
    <div class="login-logo">
      <a href="../../index2.html"><b>Admin</b>LTE</a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">You are only one step a way from your new password, recover your password now.</p>

        <form action="code.php" method="post">
          <div class="input-group mb-3">
            <input type="password" class="form-control" name="createnewpassword" placeholder="Password" required>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control" name="confirmnewpassword" placeholder="Confirm Password" required>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <button type="submit" class="btn btn-primary btn-block" name="changepassword">Change password</button>
            </div>
            <!-- /.col -->
          </div>
        </form>

        <p class="mt-3 mb-1">
          <a href="login.php">Login</a>
        </p>
      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
  <!-- /.login-box -->

</div>