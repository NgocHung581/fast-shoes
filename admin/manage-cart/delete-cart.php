<?php
include('../../config/constants.php');

if (isset($_GET['id'])) {
    $cart_id = $_GET['id'];

    $sql = "DELETE FROM tbl_cart WHERE cart_id = $cart_id";

    $res = mysqli_query($conn, $sql);

    if ($res == true) {
        header("location:" . SITEURL . "cart.php");
    } else {
        $_SESSION['fail-to-delete'] = '<div class="text-danger">Xóa sản phẩm không thành công.</div>';
        header("location:" . SITEURL . "cart.php");
    }
}