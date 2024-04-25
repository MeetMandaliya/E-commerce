<?php
include('authentication.php');
include('config/dbcon.php');
include('includes/header.php');
include('includes/navbar.php');
include('includes/sidebar.php');
?>

<style>
    .badge .legend-indicator {
        margin-right: 0.3125rem;
    }

    .legend-indicator {
        display: inline-block;
        width: 0.5rem;
        height: 0.5rem;
        background-color: #bdc5d1;
        border-radius: 50%;
        margin-right: 0.4375rem;
    }

    .bg-dark {
        --bs-bg-opacity: 1;
        background-color: #1e2022;
    }

    .text-dark {
        color: #1e2022 !important;
    }

    .badge {
        line-height: normal;
    }

    .text-dark {
        --bs-text-opacity: 1;
        color: rgba(var(--bs-dark-rgb), var(--bs-text-opacity)) !important;
    }

    .bg-info {
        --bs-bg-opacity: 1;
        background-color: rgb(9 165 190);
    }

    .badge {
        line-height: normal;
    }

    .bg-soft-info {
        background-color: rgba(9, 165, 190, .1) !important;
    }

    .text-dark {
        color: #1e2022 !important;
        --bs-text-opacity: 1;
    }

    .bg-soft-dark {
        background-color: rgba(19, 33, 68, .1) !important;
    }

    .selectbox {
        width: 150px !important;
        height: 37px !important;
        font-size: 15px;
        font-weight: bold;
    }

    .selectbox option {
        font-size: 15px;
    }

    .design_date {
        width: 120px;
        float: right;
        height: 37px;
        border: 1px solid #ced4da;
        border-radius: 0.25rem;
        transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
    }

    .design_filter {
        margin-left: 650px;
    }

    .accordion {
        /* display: flex; */
        flex-direction: column;
        width: 150px;
        margin-left: 750px;
        margin-top: -30px;
        height: 45px;
    }

    .accordion-section {
        border: 1px solid #ddd;
        margin-bottom: 5px;
        overflow: hidden;
        margin-top: 30px;
    }

    .accordion-label {

        background-color: white;
        padding: 10px;
        cursor: pointer;
        font-weight: bold;
        height: 37px;
    }

    .accordion-content {
        display: none;
        padding: 10px;
        background-color: white;
    }

    .checkbox {
        margin-right: 5px;
    }

    .design_apply {
        border-bottom-left-radius: 20%;
        border-bottom-right-radius: 20%;
        border-top-left-radius: 20%;
        border-top-right-radius: 20%;
        margin-top: 10px;
        width: 100%;
    }

    .design_remove {
        border: none;
        background-color: transparent;
        width: 100px;
        margin-left: 60px;
        margin-top: -9 0px;
    }

    .arrow {
        margin-left: 39px;
    }

    .bold {
        font-weight: bold;
    }
</style>

<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha384-wvfXpqpZZVQGK8tNE4s5zT2LWS5P9UJ5M0iPFFc9NDbwCf57DpJ4L8L2R8T8ikUw" crossorigin="anonymous">

<div class="content-wrapper">
    <section class="content pt-3">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card mt-2">
                        <div class="card-header mb-0 pb-0">
                            <h3 class="card-title">Order details</h3>
                            <select class="form-select selectbox float-end form-select-lg mb-3" aria-label=".form-select-lg example" onchange="changethestatus()" id="orderStatus">
                                <option class="bold" disabled selected>Order Status</option>
                                <option value="fulfilled">Fulfilled</option>
                                <option value="unfulfilled">Unfulfilled</option>
                            </select>
                            <form action="order_details.php" method="post">
                                <div class="accordion">
                                    <div class="accordion-section">
                                        <div class="accordion-label" onclick="toggleAccordion(this)">Add Filter <i class="fas fa-angle-down arrow"></i></div>
                                        <div class="accordion-content">
                                            <button type="submit" class="design_remove" name="removefilter" value="remove"><b>Reset</b></button>
                                            <input name="fulfilled" type="checkbox" value="fulfilled" class="checkbox"> Fulfilled<br>
                                            <input name="unfulfilled" value="unfulfilled" type="checkbox" class="checkbox"> Unfulfilled<br>
                                            <span id="datePickerContainer"><input placeholder="Select the date" type="checkbox" class="checkbox" name="datetimes" id="datePickerInput"></span><span>SELECT DATE<br>
                                            <button type="submit" class="design_apply" name="applyFilter">Apply</button>
                                        </div>
                                    </div>
                                <!-- </div> -->
                            </form>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="all" id="selectAll">
                                        </div>
                                    </th>
                                    <th>ID <a><i class="fas fa-angle-up-down"></i></a>
</th>
                                    <th>Sub Total</th>
                                    <th>Final Total</th>
                                    <th>Order Date</th>
                                    <th>Order Status</th>
                                    <th>Billed To</th>
                                    <th>Shipped To</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (isset($_POST['applyFilter'])) {
                                    $query_add = [];
                                    if (isset($_POST['datetimes'])) {
                                        $date = $_POST['datetimes'];
                                        $current_date = explode(' - ', $date);
                                        $startDate = $current_date[0];
                                        $endDate = $current_date[1];

                                        $query_add[] = "order_time BETWEEN STR_TO_DATE('$startDate', '%Y/%m/%d %h:%i:%s') AND STR_TO_DATE('$endDate', '%Y/%m/%d %h:%i:%s')";
                                    }
                                    
                                    if (isset($_POST['fulfilled'])) {
                                        $fulfilled = $_POST['fulfilled'];
                                        $query_add[] = "order_received='$fulfilled'";
                                    }
                                    if (isset($_POST['unfulfilled'])) {
                                        $unfulfilled = $_POST['unfulfilled'];
                                        $query_add[] = "order_received='$unfulfilled'";
                                    }
                                    $query = "SELECT * FROM cart";
                                    if (!empty($query_add)) {
                                        $query .= " WHERE " . implode(" AND ", $query_add);
                                    }
                                } elseif (isset($_POST['removefilter'])) {
                                    $query = "SELECT * FROM cart";
                                } else {
                                    $query = "SELECT * FROM cart";
                                }
                                $query .= " ORDER BY cart_id DESC";
                                $query_run = mysqli_query($conn, $query);
                                $no = 0;
                                if (mysqli_num_rows($query_run) > 0) {
                                    while ($row = mysqli_fetch_assoc($query_run)) {
                                        $confirm_order = !empty($row['order_confirm']) ? $row['order_confirm'] : "";
                                        if ($confirm_order == "done") {
                                            $cart_unique_id = $row['cart_unique_id'];
                                            $no++;
                                            $address_id = $row['address'];
                                            if (!empty($address_id)) {
                                                $query_for_address = "SELECT * FROM address WHERE address_unique_id='$address_id'";
                                                $query_for_address_run = mysqli_query($conn, $query_for_address);
                                                if (mysqli_num_rows($query_for_address_run) > 0) {
                                                    while ($address_details = mysqli_fetch_assoc($query_for_address_run)) { ?>
                                                        <tr>
                                                            <td>
                                                                <div class="form-check">
                                                                    <input class="form-check-input byOrderAdd" type="checkbox" value="<?php echo $cart_unique_id; ?>">
                                                                </div>
                                                            </td>
                                                            <td>#<?php echo $row['cart_id'];  ?> </td>
                                                            <td>₹ <?php echo $row['subtotal'];  ?> </td>
                                                            <td>₹ <?php echo $row['final_total'];  ?> </td>
                                                            <td> <?php echo $row['order_time'];  ?> </td>
                                                            <td>
                                                                <span class="badge <?php echo ($row['order_received'] == 'fulfilled') ? 'bg-soft-info text-info' : 'bg-soft-dark text-dark' ?>">
                                                                    <span class="legend-indicator <?php echo ($row['order_received'] == 'fulfilled') ? 'bg-info' : 'bg-dark' ?>"></span><?php echo ($row['order_received'] == 'fulfilled') ? 'Fulfilled' : 'Unfulfilled';  ?>
                                                                </span>
                                                            </td>
                                                            <!-- <td> <?php echo ($row['order_received'] == 'fulfilled') ? 'Fulfilled' : 'Unulfilled'; ?> </td> -->
                                                            <td> <?php echo $address_details['billing_name'];  ?> </td>
                                                            <td><?php echo empty($address_details['shipping_name']) ?  $address_details['billing_name'] : $address_details['shipping_name'] ?></td>
                                                            <td><a style="color: #80878f;" href="details.php?cart_id=<?php echo $row['cart_id']; ?>"><i class="fa fa-eye"> View</a></td>
                                                        </tr>
                                <?php   }
                                                }
                                            }
                                        }
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
<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<!-- Include Moment.js -->
<script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>

<!-- Include Date Range Picker -->
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

<script>
    function changethestatus() {
        let orderStatusSelect = document.getElementById('orderStatus').value;
        console.log(orderStatusSelect);
        let checkboxes = document.querySelectorAll('.byOrderAdd:checked');
        let value = Array.from(checkboxes).map(checkbox => checkbox.value).join(',');
        console.log(value);
        if (checkboxes.length > 0) {
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'update_order_received.php?cart_unique_id=' + value + '&order_status=' + orderStatusSelect, true);
            console.log('update_order_received.php?cart_unique_id=' + value + '&order_status=' + orderStatusSelect);
            xhr.onload = function() {
                if (xhr.status == 200) {
                    location.reload();
                } else {
                    console.error('Failed to change the status');
                }
            };
            xhr.send();
        }
    }
    document.addEventListener("DOMContentLoaded", function() {
        let selectAllCheckbox = document.getElementById('selectAll');
        let checkboxes = document.querySelectorAll('input[type="checkbox"]');

        selectAllCheckbox.addEventListener('change', function() {
            checkboxes.forEach(function(checkbox) {
                checkbox.checked = selectAllCheckbox.checked;
            });
        });
    });

    function getdate() {
        let time = document.getElementById('datePickerInput').value;
        console.log(time);
    }
    $(function() {
        $('input[name="datetimes"]').daterangepicker({
            timePicker: true,
            locale: {
                format: 'Y/MM/DD hh:mm:ss'
            },
            placeholder: 'Select Date and Time'
        });
    });

    function toggleAccordion(label) {
        var content = label.nextElementSibling;

        if (content.style.display === "block") {
            content.style.display = "none";
        } else {
            content.style.display = "block";
        }
    }
</script>

<?php include('includes/footer.php'); ?>