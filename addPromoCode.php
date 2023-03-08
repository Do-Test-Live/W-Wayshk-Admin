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
    <title>Add Promo Code | Wayshk Admin</title>
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
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Add PromoCode</h4>
                        </div>
                        <div class="card-body">
                            <div class="basic-form">
                                <form action="Insert" method="post" enctype="multipart/form-data">
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <label>Coupon Name</label>
                                            <input type="text" class="form-control" placeholder="" name="coupon_name"
                                                   required>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label>Coupon Code</label>
                                            <input type="text" class="form-control" placeholder="" name="coupon_code"
                                                   required>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label>Select Promo Type *</label>
                                            <select class="form-control default-select" id="sel1"
                                                    name="promo_type" required>
                                                <option value="0">Amount</option>
                                                <option value="1">Persentage</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label>Coupon Amount</label>
                                            <input type="text" class="form-control" placeholder="" name="coupon_amount"
                                                   required>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label>Start Date</label>
                                            <input type="date" class="form-control" placeholder="" name="start_date"
                                                   required>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label>Expirey Date</label>
                                            <input type="date" class="form-control" placeholder="" name="expirey_date"
                                                   required>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label>Coupon Description *</label>
                                            <textarea class="form-control" rows="4" id="comment" name="coupon_description" required></textarea>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary w-50" name="add_promo_code">Submit
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
</body>
</html>
