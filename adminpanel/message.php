<?php
if (isset($_SESSION['status'])) {
?>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <?php echo $_SESSION['status'];  ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <a href=""><span aria-hidden="true">&times;</span></a>
        </button>
    </div>
<?php
unset($_SESSION['status']);
}
?>

