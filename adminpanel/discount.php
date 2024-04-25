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
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add Discount</h1>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="add_product_discount.php" class="m-4" method="post">
    <div class="modal-body ">
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
                            <input type="text" class="form-control" placeholder="Enter Discount Name" name="discount_name" autofocus>
                        </div>

                        <label>Discount Method :</label>
                        <div class="form-check">
                            <input class="form-check-input" onclick="setmethod()" value="percentage" type="radio" name="discount_method" id="flexRadioDefault1">
                            <label class="form-check-label" for="flexRadioDefault1">
                                Discount By Percentage
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" onclick="setmethod()" value="amount" type="radio" name="discount_method" id="flexRadioDefault2">
                            <label class="form-check-label" for="flexRadioDefault2">
                                Flat Discount
                            </label>
                        </div>

                        <div id="add_method">

                        </div>
                        <label class="mt-3">Discount Starting Time :</label>
                        <div class="row">
                            <div class="form-group col-6">
                                <label class="text-black-50 mb-0 fw-lighter">Date</label>
                                <div class="input-group date" id="datepicker">
                                    <input type="date" name="starting_date" class="form-control" placeholder="MM/DD/YYYY" required /><span class="input-group-append input-group-addon"></span>
                                </div>
                            </div>
                            <div class="form-group col-6">
                                <label class="text-black-50 mb-0 fw-lighter">Time</label>
                                <div class="input-group date" id="datepicker">
                                    <input type="time" class="form-control" name="starting_time" placeholder="MM/DD/YYYY" required /><span class="input-group-append input-group-addon"></span>
                                </div>
                            </div>
                        </div>

                        <label>Discount Ending Time :</label>
                        <div class="row">
                            <div class="form-group col-6">
                                <label class="text-black-50 mb-0 fw-lighter">Date</label>
                                <div class="input-group date" id="datepicker">
                                    <input type="date" name="ending_date" value="" class="form-control" placeholder="MM/DD/YYYY" required /><span class="input-group-append input-group-addon"></span>
                                </div>
                            </div>
                            <div class="form-group col-6">
                                <label class="text-black-50 mb-0 fw-lighter">Time</label>
                                <div class="input-group date" id="datepicker">
                                    <input type="time" class="form-control" name="ending_time" placeholder="MM/DD/YYYY" required /><span class="input-group-append input-group-addon"></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" value="submit" name="add_discount">Add</button>
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
                            <h3 class="card-title">Discount</h3>
                            <a href="#" data-toggle="modal" data-target="#AddUserModal" class="btn btn-primary btn-sm float-right">Add Discount</a>
                        </div>
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Product_id</th>
                                        <th>Discount_name</th>
                                        <th>Discount_by_percentage</th>
                                        <th>Flat discount</th>
                                        <th>Discount_start_time</th>
                                        <th>Discount_end_time</th>
                                        <th width='30%'>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="subcategoryTableBody">
                                    <?php $query = "SELECT * FROM discount";

                                    $query_run = mysqli_query($conn, $query);

                                    if (mysqli_num_rows($query_run) > 0) {
                                        $no = 0;
                                        while ($row = mysqli_fetch_assoc($query_run)) {
                                            $product_id = $row['product_id'];
                                            $category_id=$row['category_id'];
                                            $no++;
                                    ?>
                                            <tr>
                                                <td><?php echo $no; ?></td>
                                                
                                                    <td>
                                                    <?php 
                                                        $product_id = $row['product_id'];

                                                        echo $product_id == null ? 'category: '.$category_id : $product_id;
                                                    ?>
                                                </td>
                                                   
                                                <td><?php echo ucfirst($row['discount_name']);  ?></td>
                                                <td><?php echo !empty($row['discount_by_percentage']) ? $row['discount_by_percentage'] . '%' : '--'; ?></td>
                                                <td><?php echo !empty($row['flat_discount']) ? $row['flat_discount']  : '--'; ?></td>
                                                <td><?php echo $row['discount_start_time'];  ?></td>
                                                <td><?php echo $row['discount_end_time'];  ?></td>
                                                <td>
                                                    <a class="btn btn-primary" href="edit_discount.php?discount_id=<?php echo $row['discount_id'] ?>">
                                                        edit
                                                    </a>

                                                    <a class="btn btn-danger" href="delete_discount.php?discount_id=<?php echo $row['discount_id'] ?>">
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
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

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

    function setmethod() {
        var checkedInput = document.querySelector('input.form-check-input:checked');
        var method = checkedInput ? checkedInput.value : null;

        var xhreq = new XMLHttpRequest();
        xhreq.open('GET', 'get_product_for_discount.php?discountmethod=' + method, true);

        xhreq.onload = function() {
            if (xhreq.status == 200) {
                document.getElementById('add_method').innerHTML = xhreq.responseText;

            } else {
                console.error('Failed to fetch subcategories');
            }
        }
        xhreq.send();
    }
</script>