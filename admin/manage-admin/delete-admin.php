<?php 
    include('../../config/constants.php');

    if(isset($_GET['id'])) {
        $id = $_GET['id'];

        $sql = "DELETE FROM tbl_user WHERE user_id = $id";

        $res = mysqli_query($conn, $sql);

        if ($res == true) {
            $_SESSION['delete'] = '<div class="text-primary mb-10">Xoá admin thành công.</div>';
            header("location:".SITEURL."admin/manage-admin/manage-admin.php");
        } else {
            $_SESSION['delete'] = '<div class="text-danger">Xóa admin thất bại.</div>';
            header("location:".SITEURL."admin/manage-admin/manage-admin.php");
        }
    } else {
        header("location:".SITEURL."admin/manage-admin/manage-admin.php");
    }
?>