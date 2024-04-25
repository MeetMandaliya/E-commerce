<?php
ob_start();
include('authentication.php');
include('config/dbcon.php');
include('includes/header.php');
include('includes/navbar.php');
include('includes/sidebar.php');
?>

<div class="content-wrapper pt-3">

    
    <div class="modal fade" id="AddUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add Subcategory</h1>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="get_subcategories.php" class="m-4" method="post">

                    <div class="modal-body ">

                        <!-- <div class="form-group"> -->
                        <h2></h2>
                        <!-- <input type="text" class="form-control" placeholder="Enter category name" name="category_title"> -->
                        <!-- </div> -->
                        <div class="form-group">
                        <label for="">Select Category</label>
                        <select id="selectCategory" name="selectcategory" class="form-select" required>
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
                        <div class="form-group">
                            <label for="">Add subcategory</label>
                            <input type="text" class="form-control" placeholder="Enter product name" name="add_subcategory_name" autofocus required>
                        </div>


                        <!-- Your modal content goes here -->
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" value="submit" name="add_subcategory">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Subcategory</h3>
                            <a href="#" data-toggle="modal" data-target="#AddUserModal" class="btn btn-primary btn-sm float-right">Add Subcategory</a>
                        </div>
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Subcategory</th>
                                        <th width='30%'>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="subcategoryTableBody">
                                    <?php $query = "SELECT * FROM subcategory";
                                    $query_run = mysqli_query($conn, $query);
                                    if (mysqli_num_rows($query_run) > 0) {
                                        while ($row = mysqli_fetch_assoc($query_run)) {
                                    ?>
                                            <tr>
                                                <td>
                                                    <?php echo ucfirst($row['subcategory_name']); ?>
                                                </td>
                                                
                                                <td> 
                    <a class="btn btn-primary" href="edit_category.php?subcategory_id=<?php echo $row['subcategory_id'] ?>&category_id=<?php echo $row['category_id'] ?>">
                        edit
                    </a>
                    
                    <a class="btn btn-danger" href="deletecategory.php?subcategory_id=<?php echo $row['subcategory_id'] ?>&category_id=<?php echo $row['category_id'] ?>">
                        delete
                     </a>
                </td> 
                                                
                                            </tr>

                                    <?php
                                        }
                                    }


                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>


<?php
include('includes/footer.php');
?>