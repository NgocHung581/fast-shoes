<?php
include('../../config/constants.php');

if (isset($_GET['cart_id']) and isset($_GET['price']) and isset($_GET['quantity'])) {
    echo $page = $_GET['page-order'];
    $cart_id = $_GET['cart_id'];
    $price = $_GET['price'];
    $quantity = $_GET['quantity'];
    $size = $_GET['size'];

    $sql = "UPDATE tbl_cart SET
        product_quantity = $quantity,
        product_size = $size,
        total_price = $quantity * $price
        WHERE cart_id = $cart_id
    ";

    $res = mysqli_query($conn, $sql);

    if ($res == true) {
        if ($page == 'order') {
            header("location:" . SITEURL . "order.php");
        } else {
            header("location:" . SITEURL . "cart.php");
        }
    }
}