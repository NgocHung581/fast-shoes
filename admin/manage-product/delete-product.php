<?php
include('../../config/constants.php');

if (isset($_GET['id']) and isset($_GET['img_name'])) {
    $id = $_GET['id'];
    $img_name = $_GET['img_name'];

    if ($img_name != "") {
        $path = "../../assests/images/product/" . $img_name;
        $remove = unlink($path);

        if ($remove == false) {
            $_SESSION["remove"] = "<div class='text-danger'>Không thể xóa hình ảnh sản phẩm.</div>";
            header("location:" . SITEURL . "admin/manage-product/manage-product.php");
            die();
        }
    }

    $sql = "DELETE FROM tbl_product WHERE product_id = $id";

    $res = mysqli_query($conn, $sql);

    if ($res == true) {
        $_SESSION["delete"] = "<div class='text-primary mb-10'>Xóa sản phẩm thành công.</div>";
        header("location:" . SITEURL . "admin/manage-product/manage-product.php");
    } else {
        $_SESSION["delete"] = "<div class='text-danger'>Xóa sản phẩm thất bại.</div>";
        header("location:" . SITEURL . "admin/manage-product/manage-product.php");
    }
} else {
    header("location:" . SITEURL . "admin/manage-product/manage-product.php");
}