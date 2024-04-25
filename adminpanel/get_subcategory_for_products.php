<?php
include('config/dbcon.php');

if (isset($_GET['category_id'])) {
    $categoryId = $_GET['category_id'];

    $query = "SELECT * FROM subcategory WHERE category_id = '$categoryId'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        echo '<option disabled selected>Select subcategory</option>';
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<option value="' . $row['subcategory_id'] . '">' . $row['subcategory_name'] . '</option>';
        }
    } else {
        echo '<option value="null" disabled selected>Select category first</option>';
    }
}
?>
