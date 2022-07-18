<?php 
include('../partials/header.php');
?>


<?php 
    if(isset($_GET['id'])) {
        $id = $_GET['id'];
        
        $sql = "SELECT * FROM tbl_user WHERE user_id = $id";

        $res = mysqli_query($conn, $sql);

        if($res == true) {
            $count = mysqli_num_rows($res);
            if ($count == 1) {
                $row = mysqli_fetch_assoc($res);
                $fullname = $row['fullname'];
                $username = $row['username'];
            } else {
               header("location:".SITEURL."admin/manage-admin/manage-admin.php");
            }
        }

        if (isset($_POST['submit'])) {
            $fullname = $_POST['fullname'];
            $username = $_POST['username'];
            
            $sql2 = "UPDATE tbl_user SET
            fullname = '$fullname',
            username = '$username'
            WHERE user_id = $id
        ";

            $res2 = mysqli_query($conn, $sql2);

            if ($res2 == true) {
                $_SESSION['update'] = '<div class="text-primary mb-10">Cập nhật admin thành công.</div>';
                header("location:".SITEURL."admin/manage-admin/manage-admin.php");
            } else {
                $_SESSION['update'] = '<div class="text-danger">Cập nhật admin thất bại.</div>';
                header("location:".SITEURL."admin/manage-admin/manage-admin.php");
            }
            
        }
    } else {
       header("location:".SITEURL."admin/manage-admin/manage-admin.php");
    }
?>

<div class="main-content">
    <div class="container">
        <h1 class="mb-20">Cập nhật Admin</h1>

        <form action="" class="w-25" method="POST">
            <div class="form-group row mb-10">
                <label for="fullname" class="col-4">Họ và tên:</label>
                <input type="text" name="fullname" id="fullname" class="col-8" value="<?php echo $fullname;?>">
            </div>
            <div class="form-group row mb-10">
                <label for="username" class="col-4">Username:</label>
                <input type="text" name="username" id="username" class="col-8" value="<?php echo $username;?>">
            </div>
            <div class="row">
                <div class="col-12 text-end">
                    <button type="submit" name="submit" class="btn btn-success">Cập nhật</button>
                </div>
            </div>
        </form>
    </div>
</div>

<?php
include('../partials/footer.php');
?>