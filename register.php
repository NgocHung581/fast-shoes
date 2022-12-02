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

<body>
    <div class="login">
        <div class="container login__content">
            <form action="" method="POST" class="form" id="form-register">
                <h1 class="form-title text-center">Đăng ký</h1>

                <?php
                if (isset($_SESSION['pwd-not-match'])) {
                    renderToastMessage($_SESSION['pwd-not-match'], 3000, "danger");
                    unset($_SESSION['pwd-not-match']);
                }

                if (isset($_SESSION['exists-user'])) {
                    renderToastMessage($_SESSION['exists-user'], 3000, "danger");
                    unset($_SESSION['exists-user']);
                }
                ?>

                <div class="form__field">
                    <div class="form-group">
                        <input type="text" required="required" name="fullname" rules="required"
                            class="form__register-fullname" />
                        <span class="form-label">Họ tên</span>
                    </div>
                    <span class="form-message"></span>
                </div>
                <div class="form__field">
                    <div class="form-group">
                        <input type="email" required="required" name="username" rules="required|email"
                            class="form__register-email" />
                        <span class="form-label">Email</span>
                    </div>
                    <span class="form-message"></span>
                </div>
                <div class="form__field">
                    <div class="form-group">
                        <input type="password" required="required" name="password" rules="required|min:6"
                            class="form__register-password" />
                        <span class="form-label">Mật khẩu</span>
                    </div>
                    <span class="form-message"></span>
                </div>
                <div class="form__field">
                    <div class="form-group">
                        <input type="password" required="required" name="passwordConfirm" rules="required|matchPassword"
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
$user_id = null;
$fullname = "";
$username = "";
$isValid = false;
if (isset($_POST['register'])) {
    $fullname = $_POST['fullname'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $passwordConfirm = md5($_POST['passwordConfirm']);

    $sql2 = "SELECT * FROM tbl_user";
    $res2 = mysqli_query($conn, $sql2);
    $userExists = false;
    if ($res2 == true) {
        $count2 = mysqli_num_rows($res2);
        if ($count2 > 0) {
            while ($row2 = mysqli_fetch_assoc($res2)) {
                $usernameBD = $row2['username'];
                if ($username == $usernameBD) {
                    $userExists = true;
                    $isValid = false;
                    break;
                }
            }
        } else {
            $userExists = false;
        }
    }

    if (!$userExists) {
        if ($password === $passwordConfirm) {
            $sql = "INSERT INTO tbl_user SET
          fullname = '$fullname',
          username = '$username',
          password = '$password'
        ";
            $res = mysqli_query($conn, $sql);
            echo $user_id = mysqli_insert_id($conn);

            if ($res == true) {
                $_SESSION['register'] = 'Đăng ký thành công.<br>Vui lòng kiểm tra Email để xác thực.';
                $isValid = true;
                header('location:' . SITEURL . 'login.php');
            } else {
                $_SESSION['register'] = '<div class="text-danger">Đăng ký thất bại.</div>';
                header('location:' . SITEURL . 'login.php');
            }
        } else {
            $_SESSION['pwd-not-match'] = 'Mật khẩu nhập lại không trùng khớp.';
            $isValid = false;
            header('location:' . SITEURL . 'register.php');
        }
    } else {
        $_SESSION['exists-user'] = 'Tài khoản đã tồn tại.';
        header('location:' . SITEURL . 'register.php');
    }
}
?>

<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require "vendor/phpmailer/phpmailer/src/phpmailer.php";
require "vendor/phpmailer/phpmailer/src/exception.php";
require "vendor/phpmailer/phpmailer/src/smtp.php";
require "vendor/autoload.php";

$mail = new PHPMailer;

try {
    $mail->CharSet = "UTF-8";
    $mail->SMTPDebug = 0;
    $mail->isSMTP();
    $mail->Host = SMTP_HOST;
    $mail->SMTPAuth = true;
    $mail->Username = SMTP_UNAME;
    $mail->Password = SMTP_PWORD;
    $mail->SMTPSecure = "ssl";
    $mail->Port = SMTP_PORT;

    $mail->setFrom(SMTP_UNAME, "Fast Shoes");
    $mail->addAddress($username, $fullname);
    $mail->addReplyTo(SMTP_UNAME);
    $mail->isHTML(true);

    $subject = "Xác nhận tài khoản";
    $mail->Subject = $subject;

    $body = "<h3 style='color: #000; font-size: 20px;'>Welcome to Fast Shoes!</h3>";
    $body .= "<p style='color: #000; font-size: 16px;'>Xin chào " . $fullname . "</p>";
    $body .= "<p style='color: #000; font-size: 16px;'>Tài khoản Fast Shoes của bạn vừa được tạo bởi email này </p>";
    $body .= "<p style='color: #000; font-size: 16px;'>Nếu đây là bạn hãy nhấn vào đường link để xác nhận: </p>";

    $body .= "<form action='" . SITEURL . "verified-email.php' method = 'POST'>
                            <input type='hidden' name='user_id' value='" . $user_id . "'/>
                            <button type='submit' name='verified'  style='display:inline-block; color: #fff; background-color: #000080; padding: 16px; text-decoration: none; border-radius: 4px; cursor: pointer;'>Link xác nhận</button>
                        </form>";

    $mail->Body = $body;
    if ($isValid) {
        $result = $mail->send();
        if (!$result) {
            $error = "Có lỗi xảy ra trong quá trình gửi mail";
        }
    }
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: ", $mail->ErrorInfo;
}
?>