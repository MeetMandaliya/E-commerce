<?php 

$conn = mysqli_connect("localhost","root","","adminpanel");

if(!$conn){
    die(mysqli_connect_errno($conn));
}

?>