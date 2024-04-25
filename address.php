<?php
session_start();
include('config/dbcon.php');

if (isset($_POST['add_address'])) {
    $email = isset($_POST['email']) ? $_POST['email'] : null;

    if (!empty($email)) {
        $query_for_login_id = "SELECT id FROM users WHERE email='$email'";
        $query_for_login_id_run = mysqli_query($conn, $query_for_login_id);
    
        if ($query_for_login_id_run) {
            if (mysqli_num_rows($query_for_login_id_run) > 0) {
                $login_id_row = mysqli_fetch_assoc($query_for_login_id_run);
                $login_id = $login_id_row['id'];
            }}}
                $address = $_POST['address'];
                $city = $_POST['city'];
                $state = $_POST['state'];
                $country = $_POST['country'];
                $zipcode = $_POST['zipcode'];

                if (isset($_SESSION['auth']) && $_SESSION['auth'] == true) {
                    $name = $_SESSION['auth_user']['name'];
                    $phone_no = $_SESSION['auth_user']['phoneno'];
                } else {
                    $name = null;
                    $phone_no = null;
                }

                $query = "INSERT INTO `address` (`billing_name`,`login_id`,`billing_address`,`billing_phone_no`,`billing_city`,`billing_state`,`billing_country`,`billing_zipcode`) 
                          VALUES ('$name','$login_id','$address','$phone_no','$city','$state','$country','$zipcode')";

                $query_run = mysqli_query($conn, $query);

                if ($query_run) {
                    header('Location: account.php');
                    exit();
                } else {
                    echo "Error: " . mysqli_error($conn);
                }
            } else {
                echo "No user found with the provided email.";
            }
        
    

?>