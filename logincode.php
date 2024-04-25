<?php
session_start();
include('config/dbcon.php');
 

if(isset($_POST['login'])){

    $email=$_POST['email'];
    $password=$_POST['password'];

    $check_query= "SELECT * FROM users WHERE email='$email' AND password= '$password'";
     
    $check_query_run= mysqli_query($conn,$check_query);

    if(mysqli_num_rows($check_query_run) > 0){
        foreach($check_query_run as $row){
            $id = $row['id'];
            $name = $row['name'];
            $phone= $row['phoneno'];
            $email = $row['email'];
            $password = $row['password'];

        }
        $_SESSION['auth_user'] = [
            'id' => $id,
            'name' => $name,
            'email' => $email,
            'phoneno' => $phone,
            'password' => $password
        ];
        $_SESSION['user_auth'] = true;
        header("Location: index.php");
        
    
    }else{
        $_SESSION['status'] = "Incorrect email or password. Please try again.";
        $_SESSION['email_not_match']="Enter correct email";
        header("Location: login.php");
    }
}else {
    $_SESSION['status'] = "Access Denied";
    header("Location: login.php");
}
?>