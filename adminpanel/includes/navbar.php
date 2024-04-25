<!-- Navbar -->


<nav class="main-header navbar navbar-expand navbar-white navbar-light ">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="#" class="nav-link">Home</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="#" class="nav-link">Contact</a>
        </li>
    </ul>

   
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?php
                if (isset($_SESSION['auth']) && isset($_SESSION['admin_auth_user'])) {
                    echo $_SESSION['admin_auth_user']['admin_name'];
                } else {
                    echo "Not logged in";
                }
                ?>
            </button>

            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                <form action="code.php" method="post">
                    <button type="submit" name="logout" class="dropdown-item">Logout</button>
                </form>
            </div>
        </li>
    </ul>
</nav>
<!-- /.navbar -->