<?php
if (!isset($_SESSION["user"])) {
    $_SESSION['login-require'] = '<div class="text-danger mb-10">Vui lòng đăng nhập để thực hiện thao tác.</div>';
    header("location:" . SITEURL . "login.php");
}