<?php
include_once('./config/constants.php');
include_once('./partials-frontend/functions.php');
?>

<?php
$username = "";
if (isset($_POST['change'])) {
    $username = $_POST['username'];
} else {
    header("location:" . SITEURL);
}
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
    <link rel="stylesheet" href="./assests/css/style.css" />
    <link rel="stylesheet" href="./assests/css/login-register.css" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <title>Fast Shoes</title>
</head>

<body>
    <div class="login">
        <div class="container login__content">
            <form action="forget-password.php" class="form" method="POST" id="form-changePassword">
                <h1 class="form-title text-center">Lấy lại mật khẩu</h1>

                <div class="form__field">
                    <div class="form-group">
                        <input required="required" type="password" rules="required|min:6" name="newPassword"
                            class="form-password" />
                        <span class="form-label password">Mật khẩu mới</span>
                    </div>
                    <span class="form-message"></span>
                </div>

                <div class="form__field">
                    <div class="form-group">
                        <input required="required" type="password" rules="required|matchPassword"
                            name="newPasswordConfirm" class="form-password" />
                        <span class="form-label password">Nhập lại mật khẩu mới</span>
                    </div>
                    <span class="form-message"></span>
                </div>
                <input type="hidden" name="username_email" value="<?php echo $username; ?>">
                <div class="form-btn" style="margin-top: 50px;">
                    <div class="inner"></div>
                    <button type="submit" name="reset" class="btn">Cập nhật</button>
                </div>
            </form>
        </div>
    </div>

    <script src="./js/app.js"></script>
</body>

</html>