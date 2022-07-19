<?php
include('../partials/header.php');
?>

<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM tbl_user WHERE user_id = $id";
    $res = mysqli_query($conn, $sql);

    if ($res == true) {
        $count = mysqli_num_rows($res);
        if ($count == 1) {
            $row = mysqli_fetch_assoc($res);
            $fullname = $row['fullname'];
            $username = $row['username'];
        } else {
            header('location:' . SITEURL . 'admin/manage-admin/manage-admin.php');
        }
    }
} else {
    header('location:' . SITEURL . 'admin/manage-admin/manage-admin.php');
}
?>

<div class="main-content">
    <div class="container">
        <h1 class="mb-20">Thay đổi mật khẩu Admin</h1>

        <?php
        if (isset($_SESSION['no-match-password'])) {
            echo $_SESSION['no-match-password'];
            unset($_SESSION['no-match-password']);
        }
        ?>

        <form action="" class="w-50" method="POST">
            <div class="form-group row mb-10">
                <label for="fullname" class="col-4">Họ và tên:</label>
                <input type="text" name="fullname" id="fullname" class="col-8" disabled
                    value="<?php echo $fullname; ?>">
            </div>
            <div class="form-group row mb-10">
                <label for="username" class="col-4">Username:</label>
                <input type="text" name="username" id="username" class="col-8" disabled
                    value="<?php echo $username; ?>">
            </div>
            <div class="form-group row mb-10">
                <label for="current-password" class="col-4">Mật khẩu hiện tại:</label>
                <input type="password" name="current-password" id="current-password" class="col-8">
            </div>
            <div class="form-group row mb-10">
                <label for="new-password" class="col-4">Mật khẩu mới:</label>
                <input type="password" name="new-password" id="new-password" class="col-8">
            </div>
            <div class="form-group row mb-10">
                <label for="confirm-password" class="col-4">Nhập lại mật khẩu:</label>
                <input type="password" name="confirm-password" id="confirm-password" class="col-8">
            </div>
            <div class="row">
                <div class="col-12">
                    <button type="submit" name="submit" class="btn btn-success ">Thay đổi</button>
                </div>
            </div>
        </form>
    </div>
</div>

<?php
if (isset($_POST['submit'])) {
    $id = $_GET['id'];

    $currentPassword = md5($_POST['current-password']);
    $newPassword = md5($_POST['new-password']);
    $confirmPassword = md5($_POST['confirm-password']);

    $sql = "SELECT * FROM tbl_user 
    WHERE user_id = $id AND password = '$currentPassword'";

    $res = mysqli_query($conn, $sql);
    if ($res == true) {
        $count = mysqli_num_rows($res);
        if ($count == 1) {
            if ($newPassword === $confirmPassword) {
                $sql2 = "UPDATE tbl_user SET
                password = '$newPassword'
                WHERE user_id = $id
                ";

                $res2 = mysqli_query($conn, $sql2);

                if ($res2) {
                    $_SESSION['change-password'] = '<div class="text-primary mb-10">Thay đổi mật khẩu thành công.</div>';
?>
<script>
<?php echo ("location.href = '" . SITEURL . "admin/manage-admin/manage-admin.php';"); ?>
</script>
<?php
                } else {
                    $_SESSION['change-password'] = '<div class="text-danger mb-10">Thay đổi mật khẩu thất bại.</div>';
                ?>
<script>
<?php echo ("location.href = '" . SITEURL . "admin/manage-admin/manage-admin.php';"); ?>
</script>
<?php
                }
            } else {
                $_SESSION['no-match-password'] = '<div class="text-danger mb-10">Mật khẩu nhập lại không trùng khớp.</div>';
                ?>
<script>
<?php echo ("location.href = '" . SITEURL . "admin/manage-admin/changepassword-admin.php?id=" . $id . "';"); ?>
</script>
<?php
            }
        } else {
            $_SESSION['no-admin-found'] = '<div class="text-danger mb-10">Admin không tồn tại hoặc mật khẩu hiện tại chưa đúng.</div>';
            ?>
<script>
<?php echo ("location.href = '" . SITEURL . "admin/manage-admin/manage-admin.php';"); ?>
</script>
<?php
        }
    }
}
?>

<?php
include('../partials/footer.php');
?>