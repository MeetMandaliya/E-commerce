<?php
if (isset($_POST['newuser'])) {
    session_start();
} else {
    include('authentication.php');
}

$conn = mysqli_connect("localhost", "root", "", "adminpanel");

// <-------------------logout-------------------------->

if (isset($_POST['logout'])) {
    unset($_SESSION['auth']);
    unset($_SESSION['auth_user']);
    $_SESSION['loggedout_status'] = "Logged out Successfully";
    header("Location: login.php");
    exit(0);
}

// <-------------------newuser------------------------->

if (isset($_POST['newuser'])) {

    $newname = $_POST['newname'];
    $newemail = $_POST['newemail'];
    $newphone = $_POST['newphone'];
    $newpassword = $_POST['newpassword'];
    $newconfirmpassword = $_POST['newconfirmpassword'];

    if ($newpassword == $newconfirmpassword) {
        $checkemail = "SELECT admin_email FROM admin_details WHERE admin_email ='$newemail'";
        $checkemail_run = mysqli_query($conn, $checkemail);

        if (mysqli_num_rows($checkemail_run) > 0) {
            $_SESSION['status'] = 'Email is already taken';
            header("Location: newuser.php");
            exit();
        } else {
            $sql = "INSERT INTO `admin_details` (`admin_name`, `admin_email`, `admin_phoneno`, `admin_password`, `date_and_time`) VALUES ('$newname', '$newemail', '$newphone', '$newpassword', current_timestamp())";
            $result = mysqli_query($conn, $sql);

            if ($result == true) {
                $_SESSION['status'] = 'User added successfully';
                header("Location: login.php");
                exit();
            } else {
                $_SESSION['status'] = "User registration failed";
                header("Location: newuser.php");
            }
        }
    } else {
        $_SESSION['status'] = "Your password and confirm password do not match";
        header("Location: newuser.php");
        exit();
    }
}

// <-------------------------updateuser---------------------->

if (isset($_POST['updateuser'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $confirmpassword = $_POST['confirmpassword'];
    $id = $_POST['id'];

    if (!empty($password) && $password != $confirmpassword) {
        $_SESSION['status'] = "Your password and confirm password do not match";
    } else {
        $checkemail = "SELECT admin_email FROM admin_details WHERE admin_email='$email' AND id != '$id'";
        $checkemail_run = mysqli_query($conn, $checkemail);

        if (mysqli_num_rows($checkemail_run) > 0) {
            $_SESSION['status'] = 'Email is already taken';
        } else {
            $query = "UPDATE admin_details SET admin_name='$name', admin_email='$email', admin_phoneno='$phone', admin_password='$password' WHERE id='$id'";
            $query_run = $conn->query($query);

            if ($query_run == true) {
                $_SESSION['status'] = 'User Updated successfully';
            } else {
                $_SESSION['status'] = "User Updating failed";
            }
        }
    }
    header("Location: register.php");
    exit(0);
}

// <----------------------------submit------------------------------>

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $confirmpassword = $_POST['confirmpassword'];

    if ($password == $confirmpassword) {
        $checkemail = "SELECT email FROM  users WHERE email ='$email'";
        $checkemail_run = mysqli_query($conn, $checkemail);

        if (mysqli_num_rows($checkemail_run) > 0) {
            $_SESSION['status'] = 'Email is already taken';
        } else {
            $sql = "INSERT INTO `users` (`name`, `email`, `phoneno`, `password`, `created_at`) VALUES ('$name', '$email', '$phone', '$password', current_timestamp())";
            $result = mysqli_query($conn, $sql);

            if ($result == true) {
                $_SESSION['status'] = 'User added successfully';
            } else {
                $_SESSION['status'] = "User registration failed";
            }
        }
    } else {
        $_SESSION['status'] = "Your password and confirm password do not match";
    }
    header("Location: register.php");
    exit(0);
}

// <<<<----------------------emailforforgotpassword------------------------------------>


if (isset($_POST['emailforforgotpassword'])) {
    $emailforpassword = $_POST['checkemail'];

    $_SESSION['emailforpassword'] = $emailforpassword;
    $query = "SELECT admin_email FROM admin_details WHERE admin_email= '$emailforpassword'";

    $query_run = mysqli_query($conn, $query);

    if (mysqli_num_rows($query_run) > 0) {
        $_SESSION['status'] = 'Create a new password';
        header('Location: recoverpassword.php');
        exit();
    } else {
        $_SESSION['status'] = 'Enter correct email';
        header("Location: forgotpassword.php");
        exit();
    }
}

// <<<<----------------------changepassword---------------------------------------->

if (isset($_POST['changepassword'])) {
    $createnewpassword = $_POST['createnewpassword'];
    $confirmnewpassword = $_POST['confirmnewpassword'];

    $emailforpassword = isset($_SESSION['emailforpassword']) ? $_SESSION['emailforpassword'] : '';

    $query_check_password = "SELECT admin_password FROM admin_details WHERE admin_email = '$emailforpassword'";
    $query_check_password_run = mysqli_query($conn, $query_check_password);

    if ($row = mysqli_fetch_assoc($query_check_password_run)) {
        $currentPassword = $row['admin_password'];

        if ($createnewpassword == $confirmnewpassword && $createnewpassword != $currentPassword) {
            $query_for_update = "UPDATE admin_details SET admin_password = '$createnewpassword' WHERE admin_email = '$emailforpassword'";
            $query_for_update_run = mysqli_query($conn, $query_for_update);

            if (mysqli_affected_rows($conn) > 0) {
                $_SESSION['status'] = "Password updated successfully";
                header('Location: login.php');
            } else {
                $_SESSION['status'] = "Password update failed";
                header("Location: recoverpassword.php");
            }
        } elseif ($createnewpassword == $currentPassword) {
            $_SESSION['status'] = 'Password updated successfully';
            header("Location: login.php");
        } else {
            $_SESSION['status'] = 'Your password and confirm password do not match';
            header("Location: recoverpassword.php");
        }
    } else {
        $_SESSION['status'] = 'Error retrieving current password';
        header("Location: recoverpassword.php");
    }
}

// <----------------------------Category-title------------------------------>
if (isset($_POST['add_category'])) {

    $title = $_POST['category_title'];
    $price_currency=$_POST['price_currency'];

    $query_for_add_category = "INSERT INTO `category_name`(`category_title`,`price_currency`) VALUES ('$title','$price_currency')";

    $query_for_add_category_run = mysqli_query($conn, $query_for_add_category);

    if ($query_for_add_category_run == true) {

        $_SESSION['status'] = 'Category added successfully';
        header("Location: category.php");
    } else {
        $_SESSION['status'] = "Category  failed";
        header("Location: category.php");
    }
}

// <-------------------- edit category ------------------------>



if(isset($_POST['edit_category'])){
    $updated_category_title=$_POST['updated_category_title'];

    $query="UPDATE category_name SET category_title='$updated_category_title'";

    $query_run=mysqli_query($conn,$query);

    if($query_run == true){
        $_SESSION['status'] = 'Category name is updated';
        header('Location: category.php');
    }else{
        $_SESSION['status'] = 'Updated failed';
        header('Location: category.php');
    }
}


