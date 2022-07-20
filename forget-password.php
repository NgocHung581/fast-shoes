<?php
include('./config/constants.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="./assests/images/logo.png" type="image/x-icon" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
    <link rel="stylesheet" href="./assests/css/style.css" />
    <link rel="stylesheet" href="./assests/css/login-register.css" />
    <title>Fast Shoes</title>
</head>

<body>
    <div class="login">
        <div class="container login__content">
            <form action="" method="POST" class="form" id="form-forgetPassword">
                <h1 class="form-title text-center">Lấy lại mật khẩu</h1>

                <div class="form__field">
                    <div class="form-group">
                        <input required="required" type="text" rules="required|email" name="username"
                            class="form-username" />
                        <span class="form-label username">Tài khoản</span>
                    </div>
                    <span class="form-message"></span>
                </div>

                <div class="form__field">
                    <div class="form-group">
                        <input required="required" type="password" rules="required|min:6" name="password"
                            class="form-password" />
                        <span class="form-label password">Mật khẩu mới</span>
                    </div>
                    <span class="form-message"></span>
                </div>

                <div class="form__field">
                    <div class="form-group">
                        <input required="required" type="password" rules="required|matchPassword" name="password"
                            class="form-password" />
                        <span class="form-label password">Nhập lại mật khẩu mới</span>
                    </div>
                    <span class="form-message"></span>
                </div>

                <div class="form-btn">
                    <div class="inner"></div>
                    <button type="submit" name="submit" class="btn">Xác nhận</button>
                </div>

                <div class="row mb-3">
                    <div class="col-12">
                        <a href="login.php" class="text-decoration-none link-primary"><i
                                class="fa-solid fa-arrow-left-long"></i>
                            Quay lại trang đăng nhập</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script src="./js/app.js"></script>
</body>

</html>

<?php
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $newPassword = md5($_POST['password']);

    $sql = "UPDATE tbl_user SET
        password = '$newPassword'
        WHERE username = '$username' AND type = 'user'
    ";

    $res = mysqli_query($conn, $sql);

    if ($res == true) {
        $_SESSION['change-password'] = '<div class="text-primary">Thay đổi mật khẩu thành công.</div>';
        header("location:" . SITEURL . "login.php");
    } else {
        $_SESSION['change-password'] = '<div class="text-danger">Thay đổi mật khẩu không thành công.</div>';
        header("location:" . SITEURL . "login.php");
    }
}
?>