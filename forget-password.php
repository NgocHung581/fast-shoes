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
    <link rel="stylesheet" href="./assests/css/style.css" />
    <link rel="stylesheet" href="./assests/css/login-register.css" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <title>Fast Shoes</title>
</head>

<?php
if (isset($_SESSION['user-not-found'])) {
    renderToastMessage($_SESSION['user-not-found'], 3000, "danger");
    unset($_SESSION['user-not-found']);
}

if (isset($_SESSION['check-email'])) {
    renderToastMessage($_SESSION['check-email'], 5000);
    unset($_SESSION['check-email']);
}
?>

<body>
    <div class="login">
        <div class="container login__content">
            <form action="" method="POST" class="form" id="form-forgetPassword">
                <h1 class="form-title text-center">Lấy lại mật khẩu</h1>
                <p class="text-danger">Nhập email của bạn và chúng tôi sẽ gửi bạn link để cập nhật mật khẩu.</p>
                <div class="form__field">
                    <div class="form-group">
                        <input required="required" type="email" rules="required|email" name="username"
                            class="form-username" />
                        <span class="form-label username">Email</span>
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
$isValid = false;
$username = "";
$fullname = "";
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $sql = "SELECT * FROM tbl_user WHERE username = '$username'";
    $res = mysqli_query($conn, $sql);
    if ($res == true) {
        $count = mysqli_num_rows($res);
        if ($count == 1) {
            $row = mysqli_fetch_assoc($res);
            $fullname = $row['fullname'];
            $isValid = true;
            $_SESSION["check-email"] = "Link đã được gửi tới email của bạn.<br>Vui lòng xem email để xác thực";
            header("location:" . SITEURL . "forget-password.php");
        } else {
            $isValid = false;
            $_SESSION["user-not-found"] = "Người dùng không tồn tại.";
            header("location:" . SITEURL . "forget-password.php");
        }
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
    $body .= "<p style='color: #000; font-size: 16px;'>Tài khoản Fast Shoes của bạn vừa được yêu cầu lấy lại mật khẩu.</p>";
    $body .= "<p style='color: #000; font-size: 16px;'>Nếu đây là bạn hãy nhấn vào đường link để thay đổi mật khẩu.</p>";

    $body .= "<form action='" . SITEURL . "change-password.php' method = 'POST'>
                            <input type='hidden' name='username' value='" . $username . "'/>
                            <button type='submit' name='change'  style='display:inline-block; color: #fff; background-color: #000080; padding: 16px; text-decoration: none; border-radius: 4px; cursor: pointer;'>Link xác nhận</button>
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

<?php
if (isset($_POST['reset'])) {
    $username_email = $_POST['username_email'];
    $newPassword = md5($_POST['newPassword']);
    $newPasswordConfirm = md5($_POST['newPasswordConfirm']);

    if ($newPassword === $newPasswordConfirm) {
        $sql = "UPDATE tbl_user SET
            password = '$newPassword'
            WHERE username = '$username_email'
            ";
        $res = mysqli_query($conn, $sql);
        if ($res == true) {
            $_SESSION['change-password'] = 'Thay đổi mật khẩu thành công.';
            header("location:" . SITEURL . "login.php");
        } else {
            $_SESSION['failure-change-password'] = 'Thay đổi mật khẩu không thành công.';
            header("location:" . SITEURL . "login.php");
        }
    } else {
        $_SESSION['failure-change-password'] = 'Mật khẩu nhập lại không trùng khớp.';
        header("location:" . SITEURL . "login.php");
    }
}
?>