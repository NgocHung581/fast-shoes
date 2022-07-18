<?php 
include('../partials/header.php');
?>

<?php 
    if(isset($_POST['submit'])) {
        $fullname = $_POST['fullname'];
        $username = $_POST['username'];
        $password = md5($_POST['password']);

        $sql = "INSERT INTO tbl_user SET
            fullname = '$fullname',
            username = '$username',
            password = '$password',
            type = 'admin'
        ";


        $res = mysqli_query($conn, $sql);

        if ($res == true) {
            $_SESSION['add'] = '<div class="text-primary mb-10">Thêm Admin thành công.</div>';
            header("location:".SITEURL."admin/manage-admin/manage-admin.php");
        } else {
            $_SESSION['add'] = '<div class="text-danger">Thêm Admin thất bại.</div>';
            header("location:".SITEURL."admin/manage-admin/add-admin.php");
        }
    }
?>

<div class="main-content">
    <div class="container">
        <h1 class="mb-20">Thêm Admin</h1>

        <?php 
            if(isset($_SESSION['add'])) {

                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
        ?>

        <form action="" class="w-25" method="POST">
            <div class="form-group row mb-10">
                <label for="fullname" class="col-4">Họ và tên:</label>
                <input type="text" name="fullname" id="fullname" class="col-8">
            </div>
            <div class="form-group row mb-10">
                <label for="username" class="col-4">Username:</label>
                <input type="text" name="username" id="username" class="col-8">
            </div>
            <div class="form-group row mb-10">
                <label for="password" class="col-4">Mật khẩu:</label>
                <input type="password" name="password" id="password" class="col-8">
            </div>
            <div class="row">
                <div class="col-12 text-end">
                    <button type="submit" name="submit" class="btn btn-success">Thêm</button>
                </div>
            </div>
        </form>
    </div>
</div>

<?php
include('../partials/footer.php');
?>