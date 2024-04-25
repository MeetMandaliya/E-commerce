<?php
include('config/dbcon.php');

if (isset($_POST['add_subcategory'])) {

    $category_id=$_POST['selectcategory'];
    $subcategory_name=$_POST['add_subcategory_name'];
    $query = "INSERT INTO `subcategory` (`category_id`,`subcategory_name`) VALUE ('$category_id','$subcategory_name')";
    $result = mysqli_query($conn, $query);
    if($result == true){
        header("Location:subcategory.php?category_id=$category_id");
        exit();
    }
    
}


?>
<!-- <div class="modal fade" id="deleteConfirmationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                <a href="subcategory.php" class="btn btn-secondary" data-dismiss="modal">Close</a>
                <form id="deleteForm" action="" method="post">
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    function showDeleteConfirmationModal(subcategoryId, categoryId) {
        document.getElementById('deleteForm').action = 'deletecategory.php?subcategory_id=' + subcategoryId + '&id=' + categoryId;
        $('#deleteConfirmationModal').modal('show');
    }
</script> -->
