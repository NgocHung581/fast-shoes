<?php
include_once('./partials-frontend/header.php');
?>


<?php
include_once('./partials-frontend/footer.php');
?>

<?php
if (isset($_POST['like'])) {
    $product_id = $_POST['product_id'];
    $sql3 = "UPDATE tbl_product SET like_count = like_count + 1 WHERE product_id = $product_id";
    $res3 = mysqli_query($conn, $sql3);
    if ($res3) {
        echo "thanh cong";
    }
}
?>