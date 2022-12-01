<?php
include_once('./partials-frontend/header.php');
include_once('./partials-frontend/functions.php');
?>

<?php
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $sql = "SELECT * FROM tbl_user WHERE user_id = $user_id";
    $res = mysqli_query($conn, $sql);
    if ($res == true) {
        $count = mysqli_num_rows($res);
        if ($count == 1) {
            $row = mysqli_fetch_assoc($res);
            $fullname = $row['fullname'];
            $email = $row['username'];
            $gender = $row['gender'];
            $phone = $row['phone'];
            $avatar = $row['avatar'];
        }
    }
}
?>

<div class="accountPage">
    <div class="container">
        <h1 class="mb-3" style="color: var(--primary-color);">Thông tin tài khoản</h1>
        <form method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-lg-4 text-center">
                    <label class="form-label">Ảnh đại diện</label>
                    <div>
                        <div class="position-relative">
                            <label for="avatar">
                                <img src="<?php if ($avatar) {
                                                echo './assests/images/user/' . $avatar;
                                            } else {
                                                echo './assests/images/user.png';
                                            } ?>" alt="" class="accountPage__avatar" id="avatar-img" />
                            </label>
                            <label for="avatar" class="accountPage__avatar-btn">
                                <i class="fa-solid fa-pencil"></i>
                            </label>
                        </div>
                        <?php
                        if ($avatar) {
                        ?>
                        <div class="mt-3">
                            <form method="POST">
                                <button type="submit" name="delete-avatar" class="btn btn-danger">Xóa
                                    ảnh đại diện</button>
                            </form>
                        </div>
                        <?php
                        }
                        ?>
                    </div>
                    <input type="file" class="d-none" id="avatar" name="avatar">
                </div>
                <div class="col-lg-8">
                    <div class="row">
                        <div class="mb-3">
                            <label for="fullname" class="form-label">Họ và tên</label>
                            <input type="text" name="fullname" id="fullname" class="form-control"
                                value="<?php echo $fullname; ?>">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" readonly class="form-control" name="email" id="email"
                            value="<?php echo $email; ?>">
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div>
                                <label class="form-label">Giới tính</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" <?php if ($gender == "Nam") echo "checked"; ?>
                                    type="radio" name="gender" id="male" value="Nam">
                                <label class="form-check-label" for="male">Nam</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" <?php if ($gender == "Nữ") echo "checked"; ?>
                                    type="radio" name="gender" id="famale" value="Nữ">
                                <label class="form-check-label" for="famale">Nữ</label>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="phone" class="form-label">Số điện thoại</label>
                                <input type="text" name="phone" id="phone" class="form-control"
                                    value="<?php echo $phone; ?>">
                            </div>
                        </div>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Lưu</button>
                </div>
            </div>
        </form>
    </div>
    <?php
    if (isset($_SESSION['Update-account-success'])) {
        renderToastMessage($_SESSION['Update-account-success']);
        unset($_SESSION['Update-account-success']);
    }
    ?>
</div>

<script>
var avatarInput = document.getElementById('avatar')
var avatarImg = document.getElementById('avatar-img')

avatarInput.onchange = () => {
    avatarImg.src = URL.createObjectURL(avatarInput.files[0])
}
</script>

<?php
if (isset($_POST['submit'])) {
    $fullname_input = $_POST['fullname'];
    $gender_input = $_POST['gender'];
    $phone_input = $_POST['phone'];
    if (isset($_FILES["avatar"]['name'])) {
        $avatar_name = $_FILES["avatar"]['name'];
        if ($avatar_name != "") {
            $tmp = explode(".", $avatar_name);
            $ext = end($tmp);
            $avatar_name = "User_$user_id.$ext";
            $src_path = $_FILES["avatar"]["tmp_name"];
            $dest_path = "./assests/images/user/$avatar_name";
            $upload = move_uploaded_file($src_path, $dest_path);
            if ($upload == false) {
                $_SESSION["upload-avatar-failure"] = "Lỗi tải hình ảnh.";
                header("location:" . SITEURL . "/account.php");
                die();
            }
        } else {
            if (!$avatar) {
                $avatar_name = "";
            } else {
                $avatar_name = $avatar;
            }
        }
    } else {
        $avatar_name = "";
    }


    $sql2 = "UPDATE tbl_user SET
        fullname = '$fullname_input',
        gender = '$gender_input',
        phone = '$phone_input',
        avatar = '$avatar_name'
        WHERE user_id = $user_id
    ";
    $res2 = mysqli_query($conn, $sql2);
    if ($res2 == true) {
        $_SESSION["user"] = $fullname_input;
        $_SESSION['Update-account-success'] = "Cập nhật thành công.";
?>
<script>
<?php echo ("location.href = '" . SITEURL . "account.php';"); ?>
</script>
<?php
    }
} elseif (isset($_POST['delete-avatar'])) {
    $path = "./assests/images/user/$avatar";
    $remove = unlink($path);
    if ($remove == false) {
        $_SESSION["delete-avatar-failure"] = "Không thể xóa hình ảnh sản phẩm.";
        header("location:" . SITEURL . "/account.php");
        die();
    }
    $sql3 = "UPDATE tbl_user SET avatar = '' WHERE user_id = $user_id";
    $res3 = mysqli_query($conn, $sql3);
    if ($res3 == true) {
        $_SESSION['Update-account-success'] = "Xóa ảnh đại diện thành công.";
    ?>
<script>
<?php echo ("location.href = '" . SITEURL . "account.php';"); ?>
</script>
<?php
    }
}
?>

<?php
include_once('./partials-frontend/footer.php');
?>