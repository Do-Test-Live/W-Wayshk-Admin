<?php
session_start();
require_once("include/dbController.php");
$db_handle = new DBController();

if (!isset($_SESSION["userid"])) {
    echo "<script>
                window.location.href='Login';
                </script>";
}

if (isset($_GET['catId'])) {
    $row = $db_handle->numRows("select * FROM `product` WHERE category_id='{$_GET['catId']}'");

    if ($row == 0) {
        $data = $db_handle->runQuery("select * FROM `category` WHERE id='{$_GET['catId']}'");
        unlink($data[0]['image']);
        $db_handle->insertQuery("delete from category where id=" . $_GET['catId'] . "");
        echo 'success';
    } else {
        echo 'P';
    }
}

if(isset($_GET['productId'])){
    $db_handle->insertQuery("delete from product where id=" . $_GET['productId'] . "");
    echo 'success';
}

