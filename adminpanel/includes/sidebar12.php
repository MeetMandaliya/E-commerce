<!-- Add this line to include Font Awesome 5 stylesheet -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />


<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="index3.html" class="brand-link">
    <img src="assets/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">AdminLTE 3</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="assets/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block">
          <?php
          if (isset($_SESSION['auth']) && isset($_SESSION['auth_user'])) {
            echo $_SESSION['auth_user']['name'];
          } else {
            echo "Not logged in";
          }
          ?>
        </a>
      </div>
    </div>


    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

    
    <li class="nav-item">
      <select id="userOptions" class="form-control bg mb-4">
        <option selected disabled class="bg">User details</option>
        <option value="login.php">Login <i class="fas fa-chevron-down text-white" id="userArrow"></i></option>
        <option value="register.php">Register <i class="fas fa-chevron-down text-white" id="userArrow"></i></option>
        <option value="forgotpassword.php">Forgot Password <i class="fas fa-chevron-down text-white" id="userArrow"></i></option>
      </select>
    </li>

<!-- <i class="fas fa-chevron-down text-white" id="userArrow"></i> -->
<li class="nav-item">
      <select id="categoryOptions" class="form-control bg mb-4">
        <option selected disabled class="bg">Categories <i class="fas fa-chevron-down text-white" id="categoryArrow"></i></option>
      </select>
    </li>
    <li class="nav-item">
      <select id="categoryOptions" class="form-control bg mb-4">
        <option selected disabled class="bg">Subcategories <i class="fas fa-chevron-down text-white" id="categoryArrow"></i></option>
        <option value="category.php">Category<i class="fas fa-chevron-down text-white" id="categoryArrow"></i></option>
      </select>
    </li>
    <li class="nav-item">
      <select id="categoryOptions" class="form-control bg mb-4">
        <option selected disabled class="bg">Products <i class="fas fa-chevron-down text-white" id="categoryArrow"></i></option>
        <option value="category.php">Category <i class="fas fa-chevron-down text-white" id="categoryArrow"></i></option>
        <option value="subcategory.php">Subcategory <i class="fas fa-chevron-down text-white" id="categoryArrow"></i></option>
        <option value="product.php">Products <i class="fas fa-chevron-down text-white" id="categoryArrow"></i></option>
      </select>
    </li>
  </ul>


  <script>
    function handleOptionSelection(selectId, arrowId) {
      let selectedOption = document.getElementById(selectId).value;
      if (selectedOption) {
        window.location.href = selectedOption;
      }
      toggleArrow(arrowId);
    }

    function toggleArrow(arrowId) {
      let arrowIcon = document.getElementById(arrowId);
      if (arrowIcon.classList.contains('fa-chevron-down')) {
        arrowIcon.classList.remove('fa-chevron-down');
        arrowIcon.classList.add('fa-chevron-up');
      } else {
        arrowIcon.classList.remove('fa-chevron-up');
        arrowIcon.classList.add('fa-chevron-down');
      }
    }

    document.getElementById('userOptions').addEventListener('change', function () {
      handleOptionSelection('userOptions', 'userArrow');
    });

    document.getElementById('categoryOptions').addEventListener('change', function () {
      handleOptionSelection('categoryOptions', 'categoryArrow');
    });
  </script>
</aside>
