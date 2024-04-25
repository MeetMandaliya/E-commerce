<?php
// session_start();
include('authentication.php');
include('config/dbcon.php');
include('includes/header.php');
include('includes/navbar.php');
include('includes/sidebar.php');
?>
<div class="content-wrapper">
    <section class="content pt-3">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card mt-2">
                        <div class="card-header">
                            <h3 class="card-title">Product details</h3>
                        </div>
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <td>No.</td>
                                    <td>Product_id</td>
                                    <td>Product_name</td>
                                    <td>Product_size</td>
                                    <td>Product_color</td>
                                    <td>Product_quantity</td>
                                    <td>Product_price</td>
                                    <td>final_total</td>
                                    <td>flat_discount</td>
                                    <td>discount_by<br>percentage</td>
                                </thead>
                                <tbody>
                                    <?php if(isset($_GET['cart_unique_id'])){
                                        $unique_id=$_GET['cart_unique_id'];
                                        $query="SELECT * FROM cart_item WHERE cart_unique_id='$unique_id'";
                                        $query_run=mysqli_query($conn,$query);
                                        $no=0;
                                        if(mysqli_num_rows($query_run)>0){
                                            while($row=mysqli_fetch_assoc($query_run)){
                                                $product_id=$row['product_id'];
                                                $query_for_name="SELECT * FROM product_details WHERE product_id='$product_id'";
                                                $query_for_name_run=mysqli_query($conn,$query_for_name);
                                                if(mysqli_num_rows($query_for_name_run)>0){
                                                    while($name=mysqli_fetch_assoc($query_for_name_run)){
                                                      
                                                $no++;
                                                ?>
                                                <tr>
                                                <td><?php echo $no;  ?></td>
                                                <td><?php echo $row['product_id'];  ?></td>
                                                <td><?php echo $name['product_name'];  ?></td><td><?php echo $row['product_size'];  ?></td><td><?php echo $row['product_color'];  ?></td><td><?php echo $row['product_quantity'];  ?></td><td><?php echo $row['product_price'];  ?></td><td><?php echo $row['final_total'];  ?></td>
                                                <td><?php echo $row['flat_discount'];  ?></td>
                                                <td><?php echo $row['discount_by_percentage'];  ?></td>
                                                </tr>
                                                <?php
                                            }}
                                        }
                                        }
                                    }  ?>
                                    
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