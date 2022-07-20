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
            <form action="" method="POST" class="form">
                <h1 class="form-title text-center">Đăng nhập</h1>

                <?php
                if (isset($_SESSION['register'])) {
                    echo $_SESSION['register'];
                    unset($_SESSION['register']);
                }
                ?>

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
    WHERE username = '$username' AND password = '$password'";

    $res = mysqli_query($conn, $sql);

    if ($res == true) {
        $count = mysqli_num_rows($res);

        if ($count == 1) {
            $row = mysqli_fetch_assoc($res);
            $fullname = $row['fullname'];

            $_SESSION["user"] = "$fullname";
            $_SESSION['admin'] = "$fullname";
            header("location:" . SITEURL . "admin/manage-home/index.php");
        } else {
            $_SESSION['login-admin'] = "<div>Tài khoản hoặc mật khẩu không đúng.</div>";
            header("location:" . SITEURL . "login.php");
        }
    }
}
?>