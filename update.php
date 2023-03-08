<?php
session_start();
require_once("include/dbController.php");
$db_handle = new DBController();

date_default_timezone_set("Asia/Hong_Kong");

if (!isset($_SESSION["userid"])) {
    echo "<script>
                window.location.href='Login';
                </script>";
}

if (isset($_POST['updateCategory'])) {
    $id = $db_handle->checkValue($_POST['id']);
    $name = $db_handle->checkValue($_POST['c_name']);
    $status = $db_handle->checkValue($_POST['status']);
    $image = '';
    $query = '';
    if (!empty($_FILES['cat_image']['name'])) {
        $RandomAccountNumber = mt_rand(1, 99999);
        $file_name = $RandomAccountNumber . "_" . $_FILES['cat_image']['name'];
        $file_size = $_FILES['cat_image']['size'];
        $file_tmp = $_FILES['cat_image']['tmp_name'];

        $file_type = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        if ($file_type != "jpg" && $file_type != "png" && $file_type != "jpeg" && $file_type != "gif") {
            $image = '';
        } else {
            $data = $db_handle->runQuery("select * FROM `category` WHERE id='{$id}'");
            unlink($data[0]['image']);
            move_uploaded_file($file_tmp, "assets/cat_img/" . $file_name);
            $image = "assets/cat_img/" . $file_name;
            $query .= ",`image`='" . $image . "'";
        }
    }

    $data = $db_handle->insertQuery("update category set c_name='$name', status='$status'" . $query . " where id={$id}");
    echo "<script>
                document.cookie = 'alert = 3;';
                window.location.href='Category';
                </script>";


}


if (isset($_POST['updateProduct'])) {
    $id = $db_handle->checkValue($_POST['id']);
    $p_name = $db_handle->checkValue($_POST['p_name']);
    $product_code = $db_handle->checkValue($_POST['p_code']);
    $product_description = $db_handle->checkValue($_POST['product_description']);
    $product_category = $db_handle->checkValue($_POST['product_category']);
    $status = $db_handle->checkValue($_POST['status']);
    $product_price = $db_handle->checkValue($_POST['product_price']);

    $updated_at = date("Y-m-d H:i:s");

    $data = $db_handle->insertQuery("UPDATE `product` SET `category_id`='$product_category',`product_code`='$product_code',`p_name`='$p_name',`description`='$product_description',
                     `status`='$status',`updated_at`='$updated_at',`product_price`='$product_price' WHERE id={$id}");
    echo "<script>
                document.cookie = 'alert = 3;';
                window.location.href='Product';
                </script>";
}

if (isset($_POST['updateCourse'])) {
    $course_id = $db_handle->checkValue($_POST['id']);
    $course_name = $db_handle->checkValue($_POST['course_name']);
    $course_duration = $db_handle->checkValue($_POST['course_duration']);
    $course_price = $db_handle->checkValue($_POST['course_price']);
    $course_description = $db_handle->checkValue($_POST['course_description']);
    $status = $db_handle->checkValue($_POST['status']);
    $updated_at = date("Y-m-d H:i:s");
    $image = '';
    $query = '';
    if (!empty($_FILES['course_image']['name'])) {
        $RandomAccountNumber = mt_rand(1, 99999);
        $file_name = $RandomAccountNumber . "_" . $_FILES['course_image']['name'];
        $file_size = $_FILES['course_image']['size'];
        $file_tmp = $_FILES['course_image']['tmp_name'];

        $file_type = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        if ($file_type != "jpg" && $file_type != "png" && $file_type != "jpeg" && $file_type != "gif") {
            $image = '';
        } else {
            $data = $db_handle->runQuery("select * FROM `course` WHERE course_id='{$course_id}'");
            unlink($data[0]['course_image']);
            move_uploaded_file($file_tmp, "assets/course/" . $file_name);
            $image = "assets/course/" . $file_name;
            $query .= ",`course_image`='" . $image . "'";
        }
    }

    $data = $db_handle->insertQuery("UPDATE `course` SET `course_name`='$course_name',`course_duration`='$course_duration',`course_price`='$course_price',`course_description`='$course_description',`status`='$status',`updated_at`='$updated_at'" . $query . " WHERE course_id='{$course_id}'");
    echo "<script>
                document.cookie = 'alert = 3;';
                window.location.href='Course';
                </script>";
}


if (isset($_POST['update_promo_code'])) {
    $promo_id = $db_handle->checkValue($_POST['id']);
    $updated_at = date("Y-m-d H:i:s");
    $coupon_name = $db_handle->checkValue($_POST['coupon_name']);
    $coupon_code = $db_handle->checkValue($_POST['coupon_code']);
    $coupon_type = $db_handle->checkValue($_POST['coupon_type']);
    $coupon_amount = $db_handle->checkValue($_POST['coupon_amount']);
    $start_date = $db_handle->checkValue($_POST['start_date']);
    $expirey_date = $db_handle->checkValue($_POST['expirey_date']);
    $description = $db_handle->checkValue($_POST['description']);
    $status = $db_handle->checkValue($_POST['status']);

    $data = $db_handle->insertQuery("UPDATE `promo_code` SET `coupon_name`='$coupon_name',`description`='$description',`code`='$coupon_code',`coupon_type`='$coupon_type',`amount`='$coupon_amount',
                        `start_date`='$start_date',`expirey_date`='$expirey_date',`status`='$status',`updated_at`='$updated_at' WHERE id={$promo_id}");
    echo "<script>
                document.cookie = 'alert = 3;';
                window.location.href='Promo-Code';
                </script>";
}

if (isset($_POST['updateAdmin'])) {
    $id = $db_handle->checkValue($_POST['id']);
    $name = $db_handle->checkValue($_POST['name']);
    $email = $db_handle->checkValue($_POST['email']);
    $role = $db_handle->checkValue($_POST['role']);
    $password = $db_handle->checkValue($_POST['password']);
    $status = $db_handle->checkValue($_POST['status']);
    $image = '';
    $query = '';
    if (!empty($_FILES['image']['name'])) {
        $RandomAccountNumber = mt_rand(1, 99999);
        $file_name = $RandomAccountNumber . "_" . $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_tmp = $_FILES['image']['tmp_name'];

        $file_type = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        if ($file_type != "jpg" && $file_type != "png" && $file_type != "jpeg" && $file_type != "gif") {
            $image = '';
        } else {
            $data = $db_handle->runQuery("select * FROM `admin_login` WHERE id='{$id}'");
            unlink($data[0]['image']);
            move_uploaded_file($file_tmp, "assets/admin/" . $file_name);
            $image = "assets/admin/" . $file_name;
            $query .= ",`image`='" . $image . "'";
        }
    }

    $data = $db_handle->insertQuery("UPDATE `admin_login` SET `name`='$name',`email`='$email',`password`='$password',`role`='$role',`status`='$status'". $query ." WHERE id={$id}");
    echo "<script>
                document.cookie = 'alert = 3;';
                window.location.href='Admin';
                </script>";


}