<?php
ob_start();
include('authentication.php');
include('config/dbcon.php');
include('includes/header.php');
include('includes/navbar.php');
include('includes/sidebar.php');

if (isset($_GET['discount_id'])) {
    $discount_id = $_GET['discount_id'];
    $query_for_discount = "SELECT * FROM discount WHERE discount_id='$discount_id'";
    $query_for_discount_run = mysqli_query($conn, $query_for_discount);
    if (mysqli_num_rows($query_for_discount_run) > 0) {
        $discount = mysqli_fetch_assoc($query_for_discount_run);
    }
}

if(isset($_POST['edit_discount'])){
    $discount_id= $_POST['discount_id'];
    $value=$_POST['selected_category_id'];

    if(isset($_POST['product_id'])){
        $product=implode(',',$_POST['product_id']);

        if($product == 'all'){
            $category_id= $value;
            $product_id=null;
        }else{
            $category_id=null;
            $product_id= implode(',',$_POST['product_id']);
        }
    }

    $discount_name=$_POST['edit_discount_name'];

    if(isset($_POST['edit_by_percentage'])){
        $discount_by_percentage = $_POST['edit_by_percentage'];
        $flat_discount = null;
    } elseif(isset($_POST['edit_by_amount'])){
        $discount_by_percentage = null;
        $flat_discount = $_POST['edit_by_amount'];
    } else {
        $discount_by_percentage = null;
        $flat_discount = null;
    }

    $start_date=empty($_POST['starting_date'])?'': $_POST['starting_date'];
    $start_time=empty($_POST['starting_time'])?'': $_POST['starting_time'];
    $end_date=empty($_POST['ending_date'])?'':$_POST['ending_date'];
    $end_time=empty($_POST['ending_time'])?'':$_POST['ending_time'];

    $discount_start_time = $start_date . ' ' . $start_time;
    $discount_end_time = $end_date . ' ' . $end_time;

    $query_for_update_discount="UPDATE discount SET product_id='$product_id',category_id='$category_id',discount_name='$discount_name',discount_by_percentage='$discount_by_percentage',flat_discount='$flat_discount',discount_start_time='$discount_start_time',discount_end_time='$discount_end_time' WHERE discount_id='$discount_id'";

    $query_for_update_discount_run=mysqli_query($conn,$query_for_update_discount);
    if($query_for_update_discount_run == true){
        header("Location: discount.php?discount_id=$discount_id");
        exit(); 
    } else {
        echo "Error updating discount: " . mysqli_error($conn);
    }
}
?>


<div class="content-wrapper pt-3 mb-0">
    <div class="modal-dialog">
        <div class="modal-content mb-0">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add Discount</h1>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <a href="discount.php"><span aria-hidden="true">&times;</span></a>
                </button>
            </div>

            <form action="edit_discount.php?disocunt_id=<?php echo $discount_id ?>" class="m-4" method="post">
                <div class="modal-body ">
                    <?php if (isset($discount)) { ?>
                        <div class="form-group">
                            <label for="">Select Category :</label>
                            <select id="selectCategory" onchange="handleCategorySelection()" name="category_name" class="form-select">
                                <option disabled selected>Categories</option>
                                <?php
                                $query = "SELECT * FROM category_name";
                                $query_run = mysqli_query($conn, $query);
                                if (mysqli_num_rows($query_run) > 0) {
                                    while ($row = mysqli_fetch_assoc($query_run)) {
                                        echo '<option value="' . $row['category_id'] . '">' . $row['category_title'] . '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <input type="hidden" name="selected_category_id" id="selectedCategoryId" value="">

                        <div class="form-group">
                            <label for="" class="mt-2">Select Product :</label>
                            <select class="form-select" id="selectProduct" name="product_id[]" multiple aria-label="multiple select example">
                                <option disabled selected>Products</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="">Discount Name :</label>
                            <input type="text" class="form-control" placeholder="Enter Discount Name" name="edit_discount_name" value="<?php echo $discount['discount_name'] ?>" autofocus>
                        </div>

                        <label>Discount Method :</label>
                        <div class="form-check">
                        <input class="form-check-input" onclick="setmethod(<?php echo $discount['discount_by_percentage']; ?>)" value="percentage" type="radio" name="discount_method" id="flexRadioDefault1" <?php if (isset($discount['discount_by_percentage'])) echo 'checked'; ?>>
                        <label class="form-check-label" for="flexRadioDefault1">
                            Discount By Percentage
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" onclick="setmethod(<?php echo $discount['flat_discount']; ?>)" value="amount" type="radio" name="discount_method" id="flexRadioDefault2" <?php if (isset($discount['discount_by_percentage']) == null) echo 'checked'; ?>>
                        <label class="form-check-label" for="flexRadioDefault2">
                            Flat Discount
                        </label>
                    </div>
                        <?php

                        $starting_datetime = explode(' ', $discount['discount_start_time']);
                        $starting_date = $starting_datetime[0];
                        $starting_time_24h = $starting_datetime[1];

                        $starting_time_12h = date('h:i A', strtotime($starting_time_24h));

                        $ending_datetime = explode(' ', $discount['discount_end_time']);
                        $ending_date = $ending_datetime[0];
                        $ending_time_24h = $ending_datetime[1];


                        $ending_time_12h = date('h:i A', strtotime($ending_time_24h));
                        ?>


                        <div id="add_method"></div>

                        <label class="mt-3">Starting Time :</label>
                        <div class="row">
                            <div class="form-group col-6">
                                <label class="text-black-50 mb-0 fw-lighter">Date</label>
                                <div class="input-group date">



                                    <input type="date" name="starting_date" value="<?php echo $starting_date; ?>" class="form-control" placeholder="MM/DD/YYYY" required /><span class="input-group-append input-group-addon"></span>
                                </div>
                            </div>
                            <div class="form-group col-6">
                                <label class="text-black-50 mb-0 fw-lighter">Time</label>
                                <div class="input-group date">
                                    <input type="time" class="form-control" name="starting_time" value="<?php echo $starting_time_12h; ?>" placeholder="HH:MM" required /><span class="input-group-append input-group-addon"></span>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="discount_id" value="<?php echo $discount['discount_id']; ?>">
                        <label>Ending Time :</label>

                        <div class="row">

                            <div class="form-group col-6">
                                <label class="text-black-50 mb-0 fw-lighter">Date</label>
                                <div class="input-group date">


                                    <input type="date" name="ending_date" value="<?php echo $ending_date; ?>" class="form-control" placeholder="MM/DD/YYYY" required /><span class="input-group-append input-group-addon"></span>
                                </div>
                            </div>
                            <div class="form-group col-6">
                                <label class="text-black-50 mb-0 fw-lighter">Time</label>
                                <div class="input-group date" id="datepicker">
                                    <input type="time" class="form-control" name="ending_time" value="<?php echo $ending_time_12h; ?>" placeholder="HH:MM" required /><span class="input-group-append input-group-addon"></span>
                                </div>
                            </div>
                        <?php } ?>
                        </div>

                        <div class="modal-footer">
                            <a href="discount.php" type="button" class="btn btn-secondary" data-dismiss="modal">Close</a>
                            <button type="submit" class="btn btn-primary" value="submit" name="edit_discount">Add</button>
                        </div>
            </form>
        </div>
    </div>
</div>
</div>

<?php
include('includes/footer.php');
?>

<script>
    function handleCategorySelection() {
        var categoryId = document.getElementById('selectCategory').value;
        document.getElementById('selectedCategoryId').value = categoryId;
        console.log(categoryId);
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'get_product_for_discount.php?category_id=' + categoryId, true);
        console.log(xhr);

        xhr.onload = function() {
            if (xhr.status == 200) {
                document.getElementById('selectProduct').innerHTML = xhr.responseText;
            } else {
                console.error('Failed to fetch subcategories');
            }
        }
        xhr.send();
    }

    function setmethod(amount) {
        var checkedInput = document.querySelector('input.form-check-input:checked');
        var method = checkedInput ? checkedInput.value : null;

        var xhreq = new XMLHttpRequest();
        xhreq.open('GET', 'get_product_for_discount.php?discountmethod=' + method + '&value=' + amount, true);

        xhreq.onload = function() {
            if (xhreq.status == 200) {
                document.getElementById('add_method').innerHTML = xhreq.responseText;
            } else {
                console.error('Failed to fetch subcategories');
            }
        };
        xhreq.send();
    }
</script>