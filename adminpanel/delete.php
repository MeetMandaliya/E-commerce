<?php
$conn = mysqli_connect('localhost', 'root', '', 'adminpanel');

if (isset($_GET['id'])) {


    $id = $_GET['id'];

    $sql = "DELETE FROM users WHERE `id` = '$id'";


    $result = $conn->query($sql);

    if ($result == true) {
        header("Location: register.php");
    }else{
        echo "fail";
    }
}
?>
</div>


