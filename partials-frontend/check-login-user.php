<?php
if (!isset($_SESSION["user_id"])) {
    $_SESSION['login-require'] = '<div class="text-danger mb-10">Vui lòng đăng nhập để thực hiện thao tác.</div>';
?>
<script>
<?php echo ("location.href = '" . SITEURL . "login.php';"); ?>
</script>
<?php
}