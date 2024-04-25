<?php
ob_start();
include('authentication.php');
include('includes/header.php');
include('includes/navbar.php');
include('config/dbcon.php');
?>
<?php include('includes/sidebar.php'); ?>

<div class="content-wrapper">

    <?php
    if(!isset($_GET['subcategory_id'])){

    
    if (isset($_GET['category_id'])) {
        $category_id = $_GET['category_id'];

        $query = "SELECT category_title FROM category_name WHERE category_id='$category_id'";
        $query_run = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($query_run);
    ?>
        <div class="modal-dialog modal-dialog-centered mt-0" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Edit Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <a href="category.php"><span aria-hidden="true">&times;</span></a>
                    </button>
                </div>
                <form action="" class="m-4" method="post">
                    <div class="modal-body p-0">
                        <div class="form-group">
                            <label for="">Title</label>
                            <input type="text" class="form-control" placeholder="Enter title" name="update_category_title" value="<?php echo $row['category_title']; ?>">
                        </div>
                    </div>
                    <?php
                        $currencies = array(
                            'United States' => array('currency_name' => 'United States Dollar', 'currency_symbol' => '$'),
                            'European Union' => array('currency_name' => 'Euro', 'currency_symbol' => '€'),
                            'United Kingdom' => array('currency_name' => 'British Pound', 'currency_symbol' => '£'),
                            'Japan' => array('currency_name' => 'Japanese Yen', 'currency_symbol' => '¥'),
                            'Switzerland' => array('currency_name' => 'Swiss Franc', 'currency_symbol' => 'CHF'),
                            'Australia' => array('currency_name' => 'Australian Dollar', 'currency_symbol' => 'AU$'),
                            'Canada' => array('currency_name' => 'Canadian Dollar', 'currency_symbol' => 'CA$'),
                            'China' => array('currency_name' => 'Chinese Yuan', 'currency_symbol' => '¥'),
                            'India' => array('currency_name' => 'Indian Rupee', 'currency_symbol' => '₹'),
                            'Russia' => array('currency_name' => 'Russian Ruble', 'currency_symbol' => '₽'),
                            'South Korea' => array('currency_name' => 'South Korean Won', 'currency_symbol' => '₩'),
                            'Brazil' => array('currency_name' => 'Brazilian Real', 'currency_symbol' => 'R$'),
                            'Mexico' => array('currency_name' => 'Mexican Peso', 'currency_symbol' => 'Mex$'),
                            'South Africa' => array('currency_name' => 'South African Rand', 'currency_symbol' => 'R'),
                            'Saudi Arabia' => array('currency_name' => 'Saudi Riyal', 'currency_symbol' => '﷼'),
                            'United Arab Emirates' => array('currency_name' => 'UAE Dirham', 'currency_symbol' => 'د.إ'),
                            'Israel' => array('currency_name' => 'Israeli Shekel', 'currency_symbol' => '₪'),
                            'Turkey' => array('currency_name' => 'Turkish Lira', 'currency_symbol' => '₺'),
                            'Sweden' => array('currency_name' => 'Swedish Krona', 'currency_symbol' => 'kr'),
                            'Norway' => array('currency_name' => 'Norwegian Krone', 'currency_symbol' => 'kr'),
                            'New Zealand' => array('currency_name' => 'New Zealand Dollar', 'currency_symbol' => 'NZ$'),
                            'Singapore' => array('currency_name' => 'Singapore Dollar', 'currency_symbol' => 'S$'),
                            'Hong Kong' => array('currency_name' => 'Hong Kong Dollar', 'currency_symbol' => 'HK$'),
                            'Malaysia' => array('currency_name' => 'Malaysian Ringgit', 'currency_symbol' => 'RM'),
                            'Indonesia' => array('currency_name' => 'Indonesian Rupiah', 'currency_symbol' => 'Rp'),
                            'Egypt' => array('currency_name' => 'Egyptian Pound', 'currency_symbol' => 'E£'),
                            'Nigeria' => array('currency_name' => 'Nigerian Naira', 'currency_symbol' => '₦'),
                            'Kenya' => array('currency_name' => 'Kenyan Shilling', 'currency_symbol' => 'KSh'),
                            'Argentina' => array('currency_name' => 'Argentine Peso', 'currency_symbol' => '$'),
                            'Chile' => array('currency_name' => 'Chilean Peso', 'currency_symbol' => 'CL$'),
                            'Colombia' => array('currency_name' => 'Colombian Peso', 'currency_symbol' => 'COL$'),
                            'Peru' => array('currency_name' => 'Peruvian Sol', 'currency_symbol' => 'S/'),
                            'Venezuela' => array('currency_name' => 'Venezuelan Bolívar', 'currency_symbol' => 'Bs'),
                            'Ghana' => array('currency_name' => 'Ghanaian Cedi', 'currency_symbol' => 'GH₵')
                        );
                        ?>
                        <div class="form-group">
                        <label for="">Price Currency</label>

                        <select name="edit_price_currency" class="form-select" aria-placeholder="Select currency" required>
                            <option disabled selected>Currency name</option>
                            <?php foreach ($currencies as $currency) { ?>
                                <option value="<?php echo $currency['currency_symbol']; ?>">
                                    <?php echo $currency['currency_name']; ?>
                                </option>
                            <?php } ?>
                        </select>
                        </div>
                    <div class="modal-footer">
                        <a class="btn btn-secondary" href="category.php" data-dismiss="modal">Close</a>
                        <button type="submit" class="btn btn-primary" name="update_title">Save changes</button>
                    </div>
                </form>
            </div>
        </div>

<?php }} ?>
        <?php
        if (isset($_GET['subcategory_id'])) {
            $subcategory_id = $_GET['subcategory_id'];

            $query = "SELECT subcategory_name FROM subcategory WHERE subcategory_id='$subcategory_id'";
            $query_run = mysqli_query($conn, $query);
            $row = mysqli_fetch_assoc($query_run);
            // $category_id=$row['category_id'];
        ?>
            <div class="modal-dialog modal-dialog-centered mt-0 " role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Edit Subcategory</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <a href="subcategory.php"><span aria-hidden="true">&times;</span></a>
                        </button>
                    </div>
                    <form action="" class="m-4" method="post">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="">Title</label>
                                <input type="text" class="form-control" placeholder="Enter title" name="update_subcategory_name" value="<?php echo $row['subcategory_name']; ?>">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <a class="btn btn-secondary" href="subcategory.php?subcategory_id=<?php echo $subcategory_id?>&category_id=<?php $category_id ?>" data-dismiss="modal">Close</a>
                            <button type="submit" class="btn btn-primary" name="update_subcategory_title">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>

    <?php
        }
     ?>

    <?php
    if (isset($_POST['update_title'])) {
        $updated_category_title = ucfirst($_POST['update_category_title']);
        $edit_price_currency=$_POST['edit_price_currency'];

        $query = "UPDATE category_name SET category_title='$updated_category_title' ,price_currency='$edit_price_currency' WHERE category_id='$category_id'";
        $query_run = mysqli_query($conn, $query);

        $update_currency="UPDATE product_details SET price_currency='$edit_price_currency' WHERE category_id='$category_id'";
        $update_currency_run=mysqli_query($conn,$update_currency);

        if ($query_run == true) {
            header("Location: category.php");
            $_SESSION['status'] = "title updated successfully";
        }
    }
    ?>

    <?php
if (isset($_POST['update_subcategory_title'])) {
    $category_id = $_GET['category_id'];
    $subcategory_id = $_GET['subcategory_id'];
    $updated_subcategory_title = ucfirst($_POST['update_subcategory_name']);

    $query = "UPDATE subcategory SET subcategory_name='$updated_subcategory_title' WHERE subcategory_id='$subcategory_id'";
    $query_run = mysqli_query($conn, $query);

    if ($query_run == true) {

        $query_for_category_title = "SELECT * FROM category_name WHERE category_id='$category_id'";
        $query_for_category_title_run = mysqli_query($conn, $query_for_category_title);
        $row = mysqli_fetch_assoc($query_for_category_title_run);
        $category_title = $row['category_title'];

        header("Location: subcategory.php?category_id=$category_id");
        $_SESSION['status'] = "subcategory updated successfully";
    }
}
?>



</div>
<?php
ob_end_flush();

include('includes/footer.php');
?>