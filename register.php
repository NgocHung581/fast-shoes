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
            <form action="" method="POST" class="form" id="form-register">
                <h1 class="form-title text-center">Đăng ký</h1>

                <?php
                if (isset($_SESSION['pwd-not-match'])) {
                    echo $_SESSION['pwd-not-match'];
                    unset($_SESSION['pwd-not-match']);
                }

                if (isset($_SESSION['exists-user'])) {
                    echo $_SESSION['exists-user'];
                    unset($_SESSION['exists-user']);
                }
                ?>

                <div class="form__field">
                    <div class="form-group">
                        <input required="required" type="text" name="fullname" rules="required"
                            class="form__register-fullname" />
                        <span class="form-label">Họ tên</span>
                    </div>
                    <span class="form-message"></span>
                </div>
                <div class="form__field">
                    <div class="form-group">
                        <input required="required" type="text" name="username" rules="required|email"
                            class="form__register-email" />
                        <span class="form-label">Email</span>
                    </div>
                    <span class="form-message"></span>
                </div>
                <div class="form__field">
                    <div class="form-group">
                        <input required="required" type="password" name="password" rules="required|min:6"
                            class="form__register-password" />
                        <span class="form-label">Mật khẩu</span>
                    </div>
                    <span class="form-message"></span>
                </div>
                <div class="form__field">
                    <div class="form-group">
                        <input required="required" type="password" name="passwordConfirm" rules="required|matchPassword"
                            class="form__register-passwordConfirm" />
                        <span class="form-label">Nhập lại mật khẩu</span>
                    </div>
                    <span class="form-message"></span>
                </div>

                <div class="form-btn btn-register">
                    <div class="inner"></div>
                    <button type="submit" name="register" class="btn">Đăng ký</button>
                </div>

                <p class="form-register text-center">
                    Tôi đã có tài khoản? <a href="login.php">Đăng nhập</a>
                </p>
            </form>
        </div>
    </div>

    <script src="./js/app.js"></script>
</body>

</html>

<?php
if (isset($_POST['register'])) {
    $fullname = $_POST['fullname'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $passwordConfirm = md5($_POST['passwordConfirm']);

    $sql2 = "SELECT * FROM tbl_user WHERE type = 'user'";
    $res2 = mysqli_query($conn, $sql2);
    if ($res2 == true) {
        $count2 = mysqli_num_rows($res2);
        if ($count2 > 0) {
            while ($row2 = mysqli_fetch_assoc($res2)) {
                $usernameBD = $row2['username'];
                if ($username != $usernameBD) {
                    if ($password === $passwordConfirm) {
                        $sql = "INSERT INTO tbl_user SET
                      fullname = '$fullname',
                      username = '$username',
                      password = '$password'
                    ";
                        $res = mysqli_query($conn, $sql);

                        if ($res == true) {
                            $_SESSION['register'] = '<div class="text-primary">Đăng ký thành công.</div>';
                            header('location:' . SITEURL . 'login.php');
                        } else {
                            $_SESSION['register'] = '<div class="text-danger">Đăng ký thất bại.</div>';
                            header('location:' . SITEURL . 'login.php');
                        }
                    } else {
                        $_SESSION['pwd-not-match'] = '<div class="text-danger mb-10">Mật khẩu nhập lại không trùng khớp.</div>';
                        header('location:' . SITEURL . 'register.php');
                    }
                } else {
                    $_SESSION['exists-user'] = '<div class="text-danger mb-10">Tài khoản đã tồn tại.</div>';
                    header('location:' . SITEURL . 'register.php');
                }
            }
        }
    }
}
?>