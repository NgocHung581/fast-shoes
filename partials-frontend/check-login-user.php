<?php
if (!isset($_SESSION["user_id"])) {
    $_SESSION['login-require'] = 'Vui lòng đăng nhập để thực hiện thao tác.';
?>
<script>
<?php echo ("location.href = '" . SITEURL . "login.php';"); ?>
</script>
<?php
}