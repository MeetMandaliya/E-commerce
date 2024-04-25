<?php
include('authentication.php');
include('includes/header.php');
include('includes/navbar.php');
?>
<?php include('includes/sidebar.php');  ?>

<div class="content-wrapper">
    <!-- Button trigger modal -->
    <!-- Modal -->
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

                    <div class="modal-body ">
                        <div class="form-group">
                            <label for="">Name</label>
                            <input type="text" class="form-control" placeholder="Enter your name" name="name" size="10">
                        </div>
                        <div class="form-group">
                            <label for="">Email ID</label>
                            <input type="email" class="form-control" placeholder="Enter your email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="">Phone No</label>
                            <input type="number" class="form-control" placeholder="Enter your phone no" name="phone" required>
                        </div>
                        <div class="form-group">
                            <label for="">Password</label>
                            <input type="password" class="form-control" placeholder="Enter password" name="password" id="password" required>
                            <input type="checkbox" id="showpassword"> Show Password
                        </div>
                        <div class="form-group">
                            <label for="">Confirm Password</label>
                            <input type="password" class="form-control" placeholder="Enter confirm password" name="confirmpassword" id="confirmpassword" required>
                            <input type="checkbox" id="showconfirmpassword"> Show Confirmpassword
                        </div>

                        <!-- Your modal content goes here -->
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" value="submit" name="submit">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

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
                        <li class="breadcrumb-item active">Register Users</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <?php
                    // if (isset($_SESSION['status'])) {
                    //     echo "<h4> " . $_SESSION['status'] . " </h4> ";
                    //     unset($_SESSION['status']);
                    // }
                    include('message.php');
                    ?>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Register Users</h3>
                            <a href="#" data-toggle="modal" data-target="#AddUserModal" class="btn btn-primary btn-sm float-right">Add user</a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone no.</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <?php
                                        $conn = mysqli_connect("localhost", "root", "", "adminpanel");
                                        $query = "SELECT * FROM users ";
                                        $mysqli_query_run = mysqli_query($conn, $query);
                                        $num=1;
                                        while ($row = $mysqli_query_run->fetch_assoc()) {

                                        ?>
                                            <td><?php echo $num; ?></td>
                                            <td><?php echo $row['name']; ?></td>
                                            <td><?php echo $row['email']; ?></td>
                                            <td><?php echo $row['phoneno']; ?></td>
                                            <td><a href="edit.php?id=<?php echo $row['id']; ?>" class="btn btn-dark">edit</a>
                                                <button class="btn btn-danger" onclick="showDeleteConfirmationModal(<?php echo $row['id']; ?>)">delete</button>
                                            </td>
                                    </tr>
                                <?php $num++; }
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
<div class="modal fade" id="deleteConfirmationModal" tabindex="-1" role="dialog"     aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <a href="register.php"><span aria-hidden="true">&times;</span></a>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this user?
            </div>
            <div class="modal-footer">
                <a href="register.php" class="btn btn-secondary" data-dismiss="modal">Close</a>
                <form id="deleteForm" action="" method="post">
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
include('includes/footer.php');
?>

<script>
    function showDeleteConfirmationModal(userId) {
        document.getElementById('deleteForm').action = 'delete.php?id=' + userId;
        $('#deleteConfirmationModal').modal('show');
    }
</script>
<script>
    const showPasswordCheckbox = document.getElementById('showpassword');
    const showConfirmPasswordCheckbox = document.getElementById('showconfirmpassword');

    const passwordInput = document.getElementById('password');
    const confirmPasswordInput = document.getElementById('confirmpassword')

    showPasswordCheckbox.addEventListener('change', function() {
        passwordInput.type = this.checked ? 'text' : 'password';
    });
    showConfirmPasswordCheckbox.addEventListener('change', function() {
        confirmPasswordInput.type = this.checked ? 'text' : 'password';
    });
    <?php
    // }
    ?>
</script>