<?php
session_start();
?>
<?php
// include('authentication.php');
$conn = mysqli_connect("localhost", "root", "", "adminpanel");

if (isset($_POST['login'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];

    //  if (empty($email) || empty($password)) {
    //     $_SESSION['auth_status'] = 'Please enter email and password.';
    //     header("Location: login.php");
    //     exit();
    // }

    $checkuser = "SELECT * FROM admin_details WHERE admin_email='$email' AND admin_password='$password'";
    $checkuser_run = mysqli_query($conn, $checkuser);

    if (mysqli_num_rows($checkuser_run) > 0) {

        foreach ($checkuser_run as $row) {
            $id = $row['id'];
            $name = $row['admin_name'];
            $email = $row['admin_email'];
            $phone = $row['admin_phoneno'];
        }

        $_SESSION['admin_auth_user'] = [
            'id' => $id,
            'admin_name' => $name,
            'admin_email' => $email,
            'admin_password' => $password
        ];

        $_SESSION['auth'] = true;
        $_SESSION['status'] = 'Login Successfully';

        header("Location: index.php");
        exit(0);
    } else {
        if (isset($name) || $email == null) {
            $_SESSION['status'] = 'Enter your email and password..';
            header("Location: login.php");
            exit(0);
        } else {
            $_SESSION['status'] = 'Incorrect email or password. Please try again.';
            header("Location: login.php");
            exit(0);
        }
    }
} else {
    $_SESSION['status'] = "Access Denied";
    header("Location: login.php");
}
