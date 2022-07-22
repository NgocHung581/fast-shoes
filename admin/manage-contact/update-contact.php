<?php
include('../../config/constants.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "UPDATE tbl_contact SET
            contact_status = 'Đã phản hồi'
            WHERE contact_id = '$id'
            ";

    $res = mysqli_query($conn, $sql);

    if ($res == true) {
        $_SESSION["update"] = "<div class='text-primary mb-10'>Cập nhật liên hệ thành công.</div>";
        header("location:" . SITEURL . "admin/manage-contact/manage-contact.php");
    } else {
        $_SESSION["update"] = "<div class='text-danger'>Cập nhật liên hệ thất bại.</div>";
        header("location:" . SITEURL . "admin/manage-contact/manage-contact.php");
    }
} else {
    header("location:" . SITEURL . "admin/manage-contact/manage-contact.php");
}