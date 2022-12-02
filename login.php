<?php
include_once('./config/constants.php');
include_once('./partials-frontend/functions.php');
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

<?php
if (isset($_SESSION['register'])) {
    renderToastMessage($_SESSION['register'], 5000);
    unset($_SESSION['register']);
}

if (isset($_SESSION['login-require'])) {
    renderToastMessage($_SESSION['login-require'], 3000, "danger");
    unset($_SESSION['login-require']);
}

if (isset($_SESSION['login-incorrect'])) {
    renderToastMessage($_SESSION['login-incorrect'], 3000, "danger");
    unset($_SESSION['login-incorrect']);
}

if (isset($_SESSION['change-password'])) {
    renderToastMessage($_SESSION['change-password'], 3000);
    unset($_SESSION['change-password']);
}

if (isset($_SESSION['failure-change-password'])) {
    renderToastMessage($_SESSION['failure-change-password'], 3000, "danger");
    unset($_SESSION['failure-change-password']);
}
?>

<body>
    <div class="login">
        <div class="container login__content">
            <form action="" method="POST" class="form">
                <h1 class="form-title text-center">Đăng nhập</h1>

                <div class="form__field">
                    <div class="form-group">
                        <input required="required" type="text" name="username" id="form-username"
                            class="form-username" />
                        <span class="form-label username">Tài khoản</span>
                    </div>
                </div>

                <div class="form__field">
                    <div class="form-group">
                        <input required="required" type="password" name="password" id="form-password"
                            class="form-password" />
                        <span class="form-label password">Mật khẩu</span>
                    </div>
                </div>

                <div class="form-btn">
                    <div class="inner"></div>
                    <button type="submit" name="submit" class="btn">Đăng nhập</button>
                </div>

                <div class="row mb-3">
                    <div class="col-6">
                        <a href="index.php" class="text-decoration-none link-primary"><i
                                class="fa-solid fa-arrow-left-long"></i>
                            Quay lại trang chủ</a>
                    </div>
                    <div class="col-6 text-end">
                        <a href="forget-password.php" class="text-decoration-none link-primary">Quên mật khẩu?</a>
                    </div>
                </div>

                <p class="form-register text-center">
                    Bạn chưa có tài khoản? <a href="register.php">Đăng ký</a>
                </p>
            </form>
        </div>
    </div>
    <script src="./js/app.js"></script>
</body>

</html>


<?php
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $sql = "SELECT * FROM tbl_user 
    WHERE username = '$username' AND password = '$password' AND verified_email= 'True'";

    $res = mysqli_query($conn, $sql);

    if ($res == true) {
        $count = mysqli_num_rows($res);

        if ($count == 1) {
            $row = mysqli_fetch_assoc($res);
            $fullname = $row['fullname'];
            $username = $row['username'];
            $id = $row['user_id'];
            $type = $row['type'];

            if ($type == 'user') {
                $_SESSION['user_id'] = $id;
                $_SESSION['username'] = $username;
                $_SESSION["user"] = "$fullname";
                header("location:" . SITEURL);
            }

            if ($type == 'admin') {
                $_SESSION['user_id'] = $id;
                $_SESSION['username'] = $username;
                $_SESSION['admin'] = "$fullname";
                header("location:" . SITEURL . "admin/manage-home/index.php");
            }
        } else {
            $_SESSION['login-incorrect'] = 'Sai thông tin hoặc chưa xác thực Email.';
            header("location:" . SITEURL . "login.php");
        }
    }
}
?>