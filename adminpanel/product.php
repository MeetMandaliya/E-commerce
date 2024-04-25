<?php
ob_start();
include('authentication.php');
include('config/dbcon.php');
include('includes/header.php');
include('includes/navbar.php');
include('includes/sidebar.php');
?>
<div class="content-wrapper">

    <div class="modal fade" id="AddUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">ADD PRODUCT</h1>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <!-------------------------------from for add product-------------------------->

                <form id="addProductForm" action="add_product.php" class="mt-0 m-4" method="post" enctype="multipart/form-data">
                    <div class="modal-body ">
                        <div class="form-group">
                            <label for="">Select Category</label>

                            <select id="selectCategory" name="category_name" class="form-select" onchange="handleCategorySelection()">
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
                            <label for="" class="mt-2">Select Subcategory</label>

                            <select id="selectSubcategory" name="subcategory_name" class="form-select">
                                <option disabled selected>Subcategories</option>

                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Product Name</label>
                            <input type="text" class="form-control" placeholder="Enter product name" name="product_name" autofocus>
                        </div>
                        <div class="form-group">
                            <label for="">Product Description</label>
                            <textarea class="form-control" placeholder="Enter product description" name="product_description">
                            </textarea>
                        </div>
                        <div class="form-group">
                            <label for="">Product Price</label>
                            <input type="float" class="form-control" placeholder="Enter product price" name="product_price" required>
                        </div>
                        <div class="form-group">
                            <label for="">Product Image</label>
                            <input type="file" class="form-control" placeholder="Enter your phone no" name="product_image" accept="image/*">
                        </div>
                        <label>Product Size</label>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="S" name="product_size[]" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                                S- Small
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="M" name="product_size[]" id="flexCheckDefault" checked>
                            <label class="form-check-label" for="flexCheckChecked">
                                M- Medium
                            </label>
                        </div>
                        <div class="form-check" required>
                            <input class="form-check-input" type="checkbox" value="L" name="product_size[]" id="flexCheckChecked">
                            <label class="form-check-label" for="flexCheckChecked">
                                L- Large
                            </label>
                        </div>
                        <div class="form-check" required>
                            <input class="form-check-input" type="checkbox" value="XL" name="product_size[]" id="flexCheckChecked">
                            <label class="form-check-label" for="flexCheckChecked">
                                XL- Extra Large
                            </label>
                        </div>

                        <div class="form-group">
                            <label for="" class="mt-3">Product Color</label>
                            <input type="text" class="form-control" placeholder="Enter product color" name="product_color" required multiple>
                            <small class="form-text text-muted">Add one or more color using ' , '</small>
                        </div>

                        <div class="form-group">
                            <label for="">Available Stock</label>
                            <input type="number" class="form-control" placeholder="Enter available stock" name="product_stock" required>
                        </div>

                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" value="add" name="featured_product" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Add Featured Product</label>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" value="new" name="new_arrivals" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Add To New Arrivals</label>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="add_product">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <section class="content pt-3">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card mt-2">
                        <div class="card-header">
                            <h3 class="card-title">Select Category and Subcategory</h3>
                            <div class="col">
                                <a href="#" data-toggle="modal" data-target="#AddUserModal" class="btn btn-primary btn-sm float-right">Add product</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Product Category</th>
                                        <th>Product Subcategory</th>
                                        <th>Product Name</th>
                                        <th>Product Description</th>
                                        <th>Product Price</th>
                                        <th>Product Size</th>
                                        <th>Product Color</th>
                                        <th>Product Stock</th>
                                        <th>Price Currency</th>

                                        <th>Product Image</th>

                                        <th width='20%'>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="addProductTableInBody">
                                    <?php

                                    $query = "SELECT * FROM product_details";
                                    $query_run = mysqli_query($conn, $query);
                                    if (mysqli_num_rows($query_run) > 0) {
                                        while ($row = mysqli_fetch_assoc($query_run)) {
                                            $category_id = $row['category_id'];
                                            $newsubcategory_id = $row['subcategory_id'];
                                    ?>
                                            <?php echo '<tr>'; ?>
                                            <?php $category_name_query = "SELECT * FROM category_name WHERE category_id='$category_id'";
                                            $category_name_query_run = mysqli_query($conn, $category_name_query);
                                            while ($category = mysqli_fetch_assoc($category_name_query_run)) { ?>
                                                <td><?php echo $category['category_title']; ?></td>
                                            <?php }
                                            ?>
                                            <?php $subcategory_name_query = "SELECT * FROM subcategory WHERE subcategory_id='$newsubcategory_id'";
                                            $subcategory_name_query_run = mysqli_query($conn, $subcategory_name_query);
                                            while ($subcategory = mysqli_fetch_assoc($subcategory_name_query_run)) { ?>
                                                <td> <?php echo $subcategory['subcategory_name']; ?></td>
                                            <?php }
                                            ?>
                                            <td><?php echo ucfirst($row['product_name']) ? ucfirst($row['product_name']) : '--'; ?></td>
                                            <td><?php echo ucfirst($row['product_description']) ? ucfirst($row['product_description']) : '--'; ?></td>

                                            <td>₹ <?php echo $row['product_price'] ? $row['product_price'] : '--'; ?></td>
                                            <td><?php echo $row['product_size'] ? $row['product_size'] : '--'; ?></td>
                                            <td><?php echo $row['product_color'] ? $row['product_color'] : '--'; ?></td>
                                            <td><?php echo $row['product_stock'] ? $row['product_stock'] : '--'; ?></td>
                                            <td><?php echo $row['price_currency'] ? $row['price_currency'] : '--'; ?></td>
                                            <td><?php echo $row['product_image'] ? $row['product_image'] : '--'; ?></td>
                                            <td><?php echo
                                                '
                                                <a class="btn btn-primary text-white" href="edit_product.php?subcategory_id=' . $row['subcategory_id'] . '&product_id=' . $row['product_id'] . '&category_id=' . $row['category_id'] . '">
                                                edit
                                            </a> 
                                            
                                                    <a class="btn btn-danger mt-2" href="deletecategory.php?subcategory_id=' . $row['subcategory_id'] . '&product_id=' . $row['product_id'] . '&category_id=' . $row['category_id'] . '">
                                                        delete
                                                    </a>'

                                                ?>
                                                <?php
                                                echo '</tr>';

                                                ?></td>
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
<script>
    async function handleCategorySelection() {
        var categoryId = document.getElementById('selectCategory').value;

        url = 'get_subcategory_for_products.php?category_id=' + categoryId
        try {
            const Response = await fetch(url);
            if (!Response.ok) {
                throw new Error('Failed to fetch subcategory');
            }
            const responsedata = await Response.text()
            document.getElementById('selectSubcategory').innerHTML = responsedata;
        } catch (error) {
            console.error('Error fetching subcategory name:', error);
        }
    }
</script>