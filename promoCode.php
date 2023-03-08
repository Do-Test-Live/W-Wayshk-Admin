<?php
session_start();
require_once("include/dbController.php");
$db_handle = new DBController();
if (!isset($_SESSION['userid'])) {
    header("Location: Login");
} ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Promo Code | Wayshk Admin</title>
    <!-- Datatable -->
    <link href="vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
    <?php include 'include/css.php'; ?>
</head>
<body>

<!--*******************
    Preloader start
********************-->
<div id="preloader">
    <div class="sk-three-bounce">
        <div class="sk-child sk-bounce1"></div>
        <div class="sk-child sk-bounce2"></div>
        <div class="sk-child sk-bounce3"></div>
    </div>
</div>
<!--*******************
    Preloader end
********************-->

<!--**********************************
    Main wrapper start
***********************************-->
<div id="main-wrapper">

    <?php include 'include/header.php'; ?>

    <?php include 'include/nav.php'; ?>

    <!--**********************************
        Content body start
    ***********************************-->
    <div class="content-body">
        <!-- row -->
        <div class="container-fluid">
            <!-- Add Order -->
            <?php if (isset($_GET['promoId'])) { ?>
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Update Promo Code</h4>
                        </div>
                        <div class="card-body">
                            <div class="basic-form">
                                <form method="post" action="Update" enctype="multipart/form-data">

                                    <?php $data = $db_handle->runQuery("SELECT * FROM promo_code where id={$_GET['promoId']}"); ?>

                                    <input type="hidden" value="<?php echo $data[0]["id"]; ?>" name="id" required>
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <label>Coupon Name</label>
                                            <input type="text" class="form-control" placeholder="" name="coupon_name"
                                                   value="<?php echo $data[0]["coupon_name"] ?>"
                                                   required>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label>Coupon Code</label>
                                            <input type="text" class="form-control" placeholder="" name="coupon_code"
                                                   value="<?php echo $data[0]["code"] ?>"
                                                   required>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label>Select Promo Type *</label>
                                            <select class="default-select  form-control wide" name="coupon_type"
                                                    required>
                                                <option value="1" <?php echo ($data[0]["coupon_type"] == 1) ? "selected" : ""; ?>>
                                                    Persentage
                                                </option>
                                                <option value="0" <?php echo ($data[0]["coupon_type"] == 0) ? "selected" : ""; ?>>
                                                    Amount
                                                </option>
                                            </select>
                                        </div>

                                        <div class="form-group col-md-12">
                                            <label>Coupon Amount</label>
                                            <input type="text" class="form-control" placeholder="" name="coupon_amount"
                                                   value="<?php echo $data[0]["amount"] ?>"
                                                   required>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label>Start Date</label>
                                            <input type="date" class="form-control" placeholder="" name="start_date"
                                                   value="<?php echo $data[0]["start_date"] ?>"
                                                   required>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label>Expirey Date</label>
                                            <input type="date" class="form-control" placeholder="" name="expirey_date"
                                                   value="<?php echo $data[0]["expirey_date"] ?>"
                                                   required>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label>Coupon Description *</label>
                                            <textarea class="form-control" rows="4" id="comment"
                                                      name="coupon_description"
                                                      required><?php echo $data[0]["description"] ?></textarea>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label>Status *</label>
                                            <select class="default-select  form-control wide" name="status"
                                                    required>
                                                <option value="1" <?php echo ($data[0]["status"] == 1) ? "selected" : ""; ?>>
                                                    Active
                                                </option>
                                                <option value="0" <?php echo ($data[0]["status"] == 0) ? "selected" : ""; ?>>
                                                    Deactivate
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary w-50" name="update_promo_code">Submit
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } else { ?>
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Promo Code List</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example3" class="display min-w850">
                                    <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Promo Code Name</th>
                                        <th>Promo Code</th>
                                        <th>Discount Type</th>
                                        <th>Discount Amount</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $promo_data = $db_handle->runQuery("SELECT * FROM promo_code order by id desc");
                                    $row_count = $db_handle->numRows("SELECT * FROM promo_code order by id desc");

                                    for ($i = 0; $i < $row_count; $i++) {
                                        ?>
                                        <tr>
                                            <td><?php echo $i + 1; ?></td>
                                            <td><?php echo $promo_data[$i]["coupon_name"]; ?></td>
                                            <td><?php echo $promo_data[$i]["code"]; ?></td>
                                            <?php
                                            if ($promo_data[$i]["coupon_type"] == 1) {
                                                ?>
                                                <td>Persentage</td>
                                                <?php
                                            } else {
                                                ?>
                                                <td>Amount</td>
                                                <?php
                                            }
                                            ?>
                                            <td><?php echo $promo_data[$i]["amount"]; ?></td>
                                            <?php
                                            $date = date_create($promo_data[$i]["start_date"]);
                                            $date_formatted = date_format($date, "d F y, g:i A");
                                            ?>
                                            <td><?php echo $date_formatted; ?></td>
                                            <?php
                                            $date = date_create($promo_data[$i]["expirey_date"]);
                                            $date_formatted = date_format($date, "d F y, g:i A");
                                            ?>
                                            <td><?php echo $date_formatted; ?></td>
                                            <?php
                                            if ($promo_data[$i]["status"] == 1) {
                                                ?>
                                                <td>Active</td>
                                                <?php
                                            } else {
                                                ?>
                                                <td>Deactive</td>
                                                <?php
                                            }
                                            ?>
                                            <td>
                                                <div class="d-flex">
                                                    <a href="Promo-Code?promoId=<?php echo $promo_data[$i]["id"]; ?>"
                                                       class="btn btn-primary shadow btn-xs sharp mr-1"><i
                                                                class="fa fa-pencil"></i></a>
                                                    <a onclick="promoCodeDelete(<?php echo $promo_data[$i]["id"]; ?>);"
                                                       class="btn btn-danger shadow btn-xs sharp"><i
                                                                class="fa fa-trash"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
    <!--**********************************
        Content body end
    ***********************************-->

    <?php include 'include/footer.php'; ?>

</div>
<!--**********************************
    Main wrapper end
***********************************-->

<?php include 'include/js.php'; ?>
<script>
    function promoCodeDelete(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: 'get',
                    url: 'Delete',
                    data: {
                        promoCodeId: id
                    },
                    success: function (data) {
                        if (data.toString() === 'P') {
                            Swal.fire(
                                'Not Deleted!',
                                'Your have store in this category.',
                                'error'
                            ).then((result) => {
                                window.location = 'Promo-Code';
                            });
                        } else {
                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            ).then((result) => {
                                window.location = 'Promo-Code';
                            });
                        }
                    }
                });
            } else {
                Swal.fire(
                    'Cancelled!',
                    'Your Category is safe :)',
                    'error'
                ).then((result) => {
                    window.location = 'Promo-Code';
                });
            }
        })
    }
</script>
<!-- Datatable -->
<script src="vendor/datatables/js/jquery.dataTables.min.js"></script>
<script src="js/plugins-init/datatables.init.js"></script>
</body>
</html>
