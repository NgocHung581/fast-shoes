<?php
include_once('./partials-frontend/header.php');
include_once('./partials-frontend/check-login-user.php');
include_once('./partials-frontend/functions.php');
?>

<?php
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $sql = "SELECT * FROM tbl_user WHERE user_id = $user_id";
    $res = mysqli_query($conn, $sql);
    if ($res) {
        $count = mysqli_num_rows($res);
        if ($count == 1) {
            $row = mysqli_fetch_assoc($res);
            if ($row['product_like']) {
                $product_like = explode(',', $row['product_like']);
            } else {
                $product_like = [];
            }
        }
    }
}

if (isset($_POST['like'])) {
    $product_id = $_POST['product_id'];
    $existed = false;
    for ($i = 0; $i < count($product_like); $i++) {
        if ($product_like[$i] == $product_id) {
            $existed = true;
            break;
        } else {
            $existed = false;
        }
    }
    if ($existed) {
        array_splice($product_like, $i, 1);
        $sql3 = "UPDATE tbl_product SET like_count = like_count - 1 WHERE product_id = $product_id";
        $_SESSION['like-product'] = 'Bạn đã xóa 1 sản phẩm khỏi danh sách yêu thích';
    } else {
        array_push($product_like, $product_id);
        $sql3 = "UPDATE tbl_product SET like_count = like_count + 1 WHERE product_id = $product_id";
        $_SESSION['like-product'] = 'Bạn đã thêm 1 sản phẩm vào danh sách yêu thích';
    }

    $sql4 = "UPDATE tbl_user SET product_like = '" . implode(',', $product_like) . "' WHERE user_id = $user_id";

    $res3 = mysqli_query($conn, $sql3);
    $res4 = mysqli_query($conn, $sql4);
}
?>

<div class="product__like" style="margin-top: 100px; min-height: 75vh;">
    <div class="container">
        <h1 class="product__title">Các sản phẩm bạn đã yêu thích</h1>
        <div class="row gy-4">
            <?php
            $isEmpty = true;
            for ($i = 0; $i < count($product_like); $i++) {
                $sql5 = "SELECT * FROM tbl_product WHERE product_id = " . (int)$product_like[$i];
                $res5 = mysqli_query($conn, $sql5);
                if ($res5) {
                    $count5 = mysqli_num_rows($res5);
                    if ($count5 == 1) {
                        $isEmpty = false;
                        $row5 = mysqli_fetch_assoc($res5);
                        $id = $row5['product_id'];
                        $product_name = $row5['product_name'];
                        $image_name = $row5['product_img'];
                        $product_price = $row5['product_price'];
                        renderProduct($conn, $id, $product_name, $image_name, $product_price);
                    }
                }
            }
            if ($isEmpty) {
            ?>
            <div class="alert alert-primary" role="alert">
                <span>Chưa có sản phẩm yêu thích trong danh sách</span>
            </div>
            <?php
            }
            ?>
        </div>
    </div>

    <?php
    if (isset($_SESSION['like-product'])) {
        renderToastMessage($_SESSION['like-product']);
        unset($_SESSION['like-product']);
    }
    ?>
</div>

<?php
include_once('./partials-frontend/footer.php');
?>