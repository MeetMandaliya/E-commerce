<?php
include('authentication.php');
include('includes/header.php');
include('includes/navbar.php');
include('config/dbcon.php');
?>
<?php include('includes/sidebar.php');  ?>

<div class="content-wrapper">
    <div class="modal fade" id="AddUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="code.php" class="m-4" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Title</label>
                            <input type="text" class="form-control" placeholder="Enter title" name="category_title">
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
                        <select name="price_currency" class="form-select" aria-placeholder="Select currency" required>
                            <option disabled selected>Currency name</option>
                            <?php foreach ($currencies as $currency) { ?>
                                <option value="<?php echo $currency['currency_symbol']; ?>">
                                    <?php echo $currency['currency_name']; ?>
                                </option>
                            <?php } ?>
                        </select>
                        </div> 
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" value="submit" name="add_category">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php
if (isset($_GET['category_id'])) {
    $category_id = $_GET['category_id'];
    $query = "SELECT category_title FROM category_name WHERE category_id='$category_id'";
    $query_run = mysqli_query($conn, $query);
    foreach ($query_run as $row) {
?>
        <div class="modal fade" id="category_<?php echo $row['category_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Edit Category</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="code.php" class="m-4" method="post" id="editCategoryForm_<?php echo $row['category_id']; ?>">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="">Title</label>
                                <input type="text" class="form-control" placeholder="Enter title" name="category_title" value="<?php echo $row['category_title']; ?>">
                            </div>
                        </div>
                    </form>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="submitEditForm(<?php echo $row['category_id']; ?>)">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
<?php
    }
}
?>

   

    <!-- Main content -->
    <section class="content pt-3">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Category</h3>
                            <a href="#" data-toggle="modal" data-target="#AddUserModal" class="btn btn-primary btn-sm float-right">Add Category</a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>CATEGORY</th>
                                        <th width="25%">ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    include('config/dbcon.php');
                                    $query = "SELECT * FROM category_name";
                                    $query_run = mysqli_query($conn, $query);

                                    while ($row = mysqli_fetch_assoc($query_run)) { ?>
                                        <!-- <tr>
                                        <td><?php echo $row['category_title']; ?></td> 
                                        </tr>    -->
                                        <tr>
                                            <?php echo "<td> <a href='subcategory.php?category_id={$row['category_id']}&category_title={$row['category_title']}'>{$row['category_title']}</a><br> </td> "; ?>
                                            <td><a class="btn btn-primary" href="edit_category.php?category_id=<?php echo $row['category_id']; ?>">
                                                    edit
                                                </a>
                                                <button class="btn btn-danger" onclick="showDeleteConfirmationModal(<?php echo $row['category_id']; ?>)">delete</button>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>


                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<div class="modal fade" id="deleteConfirmationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <a href="category.php"><span aria-hidden="true">&times;</span></a>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this category?
            </div>
            <div class="modal-footer">
                <a href="category.php" class="btn btn-secondary" data-dismiss="modal">Close</a>
                <form id="deleteForm" action="" method="post">
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    function showDeleteConfirmationModal(userId) {
        document.getElementById('deleteForm').action = 'deletecategory.php?category_id=' + userId;
        $('#deleteConfirmationModal').modal('show');
    }
</script>


<?php
include('includes/footer.php');
?>