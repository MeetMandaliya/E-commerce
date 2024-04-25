<?php
include('config/dbcon.php');

$query_for_display_rating = "SELECT * FROM product_review WHERE review_product_id='$productId'";
$query_for_display_rating_run = mysqli_query($conn, $query_for_display_rating);

$totalRating = 0;
$totalCount = 0;

if (mysqli_num_rows($query_for_display_rating_run) > 0) {
    while ($rating = mysqli_fetch_assoc($query_for_display_rating_run)) {
        $rating_number = floatval($rating['review_rating']);
        $totalRating += $rating_number;
        $totalCount++;
    }
    $averageRating = ($totalCount > 0) ? ($totalRating / $totalCount) : 0;
    if($averageRating == 0){
        $averageRating = 5;
        $fullStars=0;
    }else{
    $fullStars = floor($averageRating);
     $remainingStars = $averageRating - $fullStars;
    }

    for ($i = 0; $i < $fullStars; $i++) {
   
        echo '<i class="fa fa-star"></i>&nbsp;';
    }

    if ($remainingStars > 0) {
        echo '<i class="fa-regular fa-star-half-stroke"></i>';
    }
    
}else{

        $fullStars=5;
    for ($i = 0; $i < $fullStars; $i++) {
        echo '<i class="fa fa-star"></i>&nbsp;';
    }
}  
// }
?>


