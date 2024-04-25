<?php
session_start();
include('config/dbcon.php');
if (!$conn) {
    die(mysqli_connect_errno($conn));
}

if (isset($_POST['logout'])) {
    unset($_SESSION['auth']);
    unset($_SESSION['auth_user']);
    $_SESSION['status'] = "Logged out Successfully";
    // header("Location: login_Page.php");
    // exit(0);
}


if (isset($_POST['login'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];

    $check_query = "SELECT * FROM users WHERE email='$email' AND password= '$password'";

    $check_query_run = mysqli_query($conn, $check_query);

    if (mysqli_num_rows($check_query_run) > 0) {
        foreach ($check_query_run as $row) {
            $id = $row['id'];
            $name = $row['name'];
            $phone = $row['phoneno'];
            $email = $row['email'];
            $password = $row['password'];
        }
        $_SESSION['auth_user'] = [
            'id' => $id,
            'name' => $name,
            'phoneno' => $phone,
            'email' => $email,
            'password' => $password
        ];
        $_SESSION['auth'] = true;
        $_SESSION['status'] = "Login successfully";
        header("Location: index.php");
    } else {
        $_SESSION['status'] = "Incorrect email or password. Please try again.";
        header("Location: login.php");
    }
} else {
    $_SESSION['status'] = "Access Denied";
    header("Location: login.php");
}

if (isset($_POST['signup'])) {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $password = $_POST['password'];
    $confirmpassword = $_POST['confirmpassword'];

    $checkemail_query = "SELECT email FROM users WHERE email='$email'";

    $checkemail_query_run = mysqli_query($conn, $checkemail_query);

        if (!mysqli_num_rows($checkemail_query_run) > 0) {
            $query = "INSERT INTO `users` (`name`, `email`,`phoneno`, `password`, `created_at`) VALUES ('$name','$email','$phone', '$password', current_timestamp())";
            $query_run = mysqli_query($conn, $query);

            if ($query_run == true) {
                $_SESSION['status'] = 'user added successfully';
                header('Location: login.php');
            } else {
                $_SESSION['status'] = 'user not added';
                header('Location: signup.php');
            }
        } else {
            $_SESSION['status'] = "email is already taken";
            header("Location: signup.php");
        }
 
}

if(isset($_POST['emailforchangepassword'])){
    $email = $_POST['emailfornewpassword'];

    $check_valid_user_query = "SELECT email FROM users WHERE email='$email'";
    
    $check_valid_user_query_run= mysqli_query($conn,$check_valid_user_query);

    if(mysqli_num_rows($check_valid_user_query_run) > 0){
        $_SESSION['emailfornewpassword'] = $email;
        $_SESSION['status'] = "Create new password";
        header('Location: createnewpassword.php');

    }else{
        $_SESSION['status'] = "Enter correct email";
        header('Location: forgotpassword.php');

    }
}

if(isset($_POST['changepassword'])){

   $checkemail= $_SESSION['emailfornewpassword'] ;
   $newpassword = $_POST['createpassword'];
   $confirmpassword = $_POST['confirmcreatepassword'];

   if($newpassword == $confirmpassword){

   $create_new_password_query="UPDATE users SET password='$newpassword' WHERE email='$checkemail'";

   $create_new_password_query_run=mysqli_query($conn,$create_new_password_query);

   if(mysqli_num_rows($create_new_password_query_run) > 0){
        $_SESSION['status'] = "Password updated successfully";
        header('Location: login.php');
   }else{
    $_SESSION['status'] = "Password update failed";
        header('Location: createnewpassword.php');
   }
}else{
    $_SESSION['status'] = 'Your password and confirm password do not match';
    header('Location: createnewpassword.php');
}
}
