<?php
include('authentication.php');
include('includes/header.php');
include('includes/navbar.php');
include('config/dbcon.php');   
?>

<?php include('includes/sidebar.php');  ?>

<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Edit Register Users</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title mb-4">Edir Register Users</h3>
                            <a href="register.php" class="btn btn-primary btn-sm float-right" id="conformdelete">Back</a>
                            <div class="row">
                                <div class="col">
                                    <form action="code.php" method="post">
                                        <div class="modal-body">
                                            <?php
                                            if (isset($_GET['id'])) {
                                                $id = $_GET['id'];
                                                $query = "SELECT * FROM users WHERE id= '$id' LIMIT 1";
                                                $run_query = $conn->query($query);
                                                if (mysqli_num_rows($run_query) > 0) {
                                                    foreach ($run_query as $row) {
                                            ?>
                                                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                                        <div class="form-group">
                                                            <label for="" class="mt-4">Name</label>
                                                            <input type="text" class="form-control" placeholder="Enter your name" size="50" style="width: 100%;" value="<?php echo $row['name']; ?>" name="name" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">Email ID</label>
                                                            <input type="email" class="form-control" placeholder="Enter your email" value="<?php echo $row['email']; ?>" name="email" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">Phone No</label>
                                                            <input type="number" class="form-control" placeholder="Enter your phone no" value="<?php echo $row['phoneno']; ?>" name="phone" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">Password</label>
                                                            <input type="password" class="form-control" id="password" placeholder="Enter password" value="<?php echo $row['password']; ?>" name="password" required>
                                                            <input type="checkbox" id="showpassword"> Show Password
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="">Confirm Password</label>
                                                            <input type="password" class="form-control" id="confirmpassword" placeholder="Enter confirm password" name="confirmpassword" value="" required>
                                                            <input type="checkbox" id="showconfirmpassword"> Show Password
                                                        </div>
                                            <?php
                                                    }
                                                } else {
                                                    echo "<h4>" . 'No Record Found' . "</h4>";
                                                }
                                            }
                                            ?>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary" name="updateuser">Update</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">

                        </div>

                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
</div>
</section>
<script>
    const showPasswordCheckbox = document.getElementById('showpassword');
    const showConfirmPasswordCheckbox = document.getElementById('showconfirmpassword');

    const passwordInput = document.getElementById('password');
    const confirmPasswordInput = document.getElementById('confirmpassword')

    showPasswordCheckbox.addEventListener('change', function () {
        passwordInput.type = this.checked ? 'text' : 'password';
    });
    showConfirmPasswordCheckbox.addEventListener('change', function () {
        confirmPasswordInput.type = this.checked ? 'text' : 'password';
    });
</script>

<?php
include('includes/footer.php');
?>