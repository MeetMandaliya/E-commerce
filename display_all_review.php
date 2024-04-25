<?php

include('config/dbcon.php');
function generateStarRating($rating)
{
    $ratingValue = floatval($rating);
    $fullStars = floor($ratingValue);
    $remainingStars = $ratingValue - $fullStars;

    for ($i = 0; $i < $fullStars; $i++) {
        echo '<i class="fa fa-star"></i>';
    }
    if ($remainingStars > 0) {
        echo '<i class="fa-regular fa-star-half-stroke"></i>';
    }
}

$product_id = $_GET['product_id'];
$query_for_display_the_review = "SELECT * FROM product_review WHERE review_product_id='$product_id'";
$query_for_display_the_review_run = mysqli_query($conn, $query_for_display_the_review);
if (mysqli_num_rows($query_for_display_the_review_run) > 0) {


    while ($review = mysqli_fetch_assoc($query_for_display_the_review_run)) {


        $id = $review['user_id'];
        $query_for_name = "SELECT * FROM users WHERE id='$id'";
        $query_for_name_run = mysqli_query($conn, $query_for_name);
        if (mysqli_num_rows($query_for_name_run) > 0) {

            while ($name = mysqli_fetch_assoc($query_for_name_run)) {


?>
                <div id="showall"></div>
                <div class="blog__comment__item">
                    <div class="blog__comment__item__text">
                        <h6><?php echo $name['name'];  ?></h6>
                        <div class="rating_review">
                            <?php generateStarRating($review['review_rating']); ?>
                        </div> <br>
                        <p><?php echo $review['review']; ?>.</p>
                        <ul>
                            <li><i class="fa fa-clock-o"></i> <?php $date = $review['submitted_time'];
                                echo $formattedDate = date('M d, Y', strtotime($date)); ?></li>
                            <li><i class="fa fa-heart-o"></i> 12</li>
                            <li><i class="fa fa-share"></i> 1</li>
                        </ul>
                    </div>
                </div>
        <?php

            }
        }
        ?> <?php
                                            }
                                        }
                                                ?>