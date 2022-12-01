<?php
include_once('./config/constants.php');
?>

<link rel="stylesheet" href="./assests/css/style.css" />

<div class="verifyPage">
    <?php
    if (isset($_POST['verified'])) {
        $user_id = $_POST['user_id'];
        $sql = "UPDATE tbl_user SET verified_email='True' WHERE user_id = $user_id";
        $res = mysqli_query($conn, $sql);
        if ($res == true) {
    ?>
    <div class="verifyPage-content">
        <h1>Xin chào!</h1>
        <p>
            <strong>Bạn đã xác nhận Email thành công.</strong>
            <br>
            <br>
            Bạn đã có thể đăng nhập vào cửa hàng của chúng tôi ngay bây giờ.
        </p>
        <a href='login.php' class="btn btn-primary">Đăng nhập</a>
    </div>
    <?php
        }
    }
    ?>
</div>

<script>
if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
}
</script>