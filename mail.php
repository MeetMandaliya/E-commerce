<?php 
include('config/dbcon.php');

mail($to,$subject,$message,$headers,$parameters);

?>