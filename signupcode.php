<?php  
session_start();
include('config/dbcon.php');

if(isset($_POST['signup'])){
    $name=$_POST['name'];
    $email=$_POST['email'];
    $phone=$_POST['phoneno'];
    $password=$_POST['password'];
    // $confirmpassword = $_POST['confirmpassword'];

    $checkemail_query= "SELECT email FROM users WHERE email='$email'";
    
    $checkemail_query_run=mysqli_query($conn, $checkemail_query);


    // if($password == $confirmpassword){
        if(!mysqli_num_rows($checkemail_query_run) > 0){
            $query= "INSERT INTO `users` (`name`, `email`,`phoneno`, `password`, `created_at`) VALUES ('$name', '$email','$phone', '$password', current_timestamp())";
            $query_run=mysqli_query($conn, $query);
        
            if($query_run == true){
                $_SESSION['status'] = 'User added successfully';
                header('Location: login.php');
    
            }else{
                $_SESSION['status'] = 'User not added';
                header('Location: signup.php');
    
            }
        }else{
            $_SESSION['status']= "email is already taken";
            header("Location: signup.php");
        }

    // }else{
    //     $_SESSION['status'] = 'your password and confirmpassword do not match';
    //     header('Location: signup.php');
    // }

    

    }
?>