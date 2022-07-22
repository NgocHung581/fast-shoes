<?php
include('../../config/constants.php');

if (isset($_GET['order_id']) and isset($_GET['order_status'])) {
    $order_id = $_GET['order_id'];
    $order_status = $_GET['order_status'];

    $sql = "UPDATE tbl_order SET order_status = '$order_status' WHERE order_id = $order_id";

    $res = mysqli_query($conn, $sql);

    if ($res == true) {
        $_SESSION['update'] = '<div class="text-primary mb-10">Cập nhật trạng thái đơn hàng thành công.</div>';
        header('location:' . SITEURL . 'admin/manage-order/manage-order.php');
    } else {
        $_SESSION['update'] = '<div class="text-danger mb-10">Cập nhật trạng thái đơn hàng thất bại.</div>';
        header('location:' . SITEURL . 'admin/manage-order/manage-order.php');
    }
}

if (isset($_GET['order_id']) and isset($_GET['cancel-submit'])) {
    $order_id = $_GET['order_id'];
    $sql = "UPDATE tbl_order SET order_status = 'Đã hủy' WHERE order_id = $order_id";

    $res = mysqli_query($conn, $sql);

    if ($res == true) {
        header('location:' . SITEURL . 'order-customer.php');
    } else {
        header('location:' . SITEURL . 'order-customer.php');
    }
}

if (isset($_GET['order_id']) and isset($_GET['confirm-submit'])) {
    $order_id = $_GET['order_id'];
    $sql = "UPDATE tbl_order SET order_status = 'Đã giao hàng' WHERE order_id = $order_id";

    $res = mysqli_query($conn, $sql);

    if ($res == true) {
        header('location:' . SITEURL . 'order-customer.php');
    } else {
        header('location:' . SITEURL . 'order-customer.php');
    }
}