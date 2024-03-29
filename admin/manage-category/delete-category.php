<?php
include('../../config/constants.php');

if (isset($_GET['id']) and isset($_GET['img_name'])) {
    $id = $_GET['id'];
    $img_name = $_GET['img_name'];
    
    $sql_check = "SELECT category_id FROM tbl_product WHERE category_id = $id";
    $res_check = mysqli_query($conn, $sql_check);

    if ($res_check == true and mysqli_num_rows($res_check) > 0) {
        $_SESSION["delete"] = "<div class='text-danger'>Xóa danh mục thất bại do còn sản phẩm thuộc danh mục này.</div>";
        header("location:" . SITEURL . "admin/manage-category/manage-category.php");
    } 
    else {
        if ($img_name != "") {
            $path = "../../assests/images/category/" . $img_name;
            $remove = unlink($path);
    
            if ($remove == false) {
                $_SESSION["remove"] = "<div class='text-danger'>Không thể xóa hình ảnh danh mục.</div>";
                header("location:" . SITEURL . "admin/manage-category/manage-category.php");
                die();
            }
        }
    
        $sql = "DELETE FROM tbl_category WHERE category_id = $id";
        $res = mysqli_query($conn, $sql);
    
        if ($res == true) {
            $_SESSION["delete"] = "<div class='text-primary mb-10'>Xóa danh mục thành công.</div>";
            header("location:" . SITEURL . "admin/manage-category/manage-category.php");
        } 
        else {
            $_SESSION["delete"] = "<div class='text-danger'>Xóa danh mục thất bại.</div>";
            header("location:" . SITEURL . "admin/manage-category/manage-category.php");
        }
    }
      
} 
else {
    header("location:" . SITEURL . "admin/manage-category/manage-category.php");
}