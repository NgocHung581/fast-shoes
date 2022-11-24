<?php
include('./config/constants.php');
include('./partials-frontend/check-login-user.php');
?>

<?php
include('./partials-frontend/header.php');
?>

<section class="cart">
    <div class="container cart__container">
        <h2 class="mt-5 mb-4">Giỏ hàng của bạn</h2>
        <div class="row">
            <div class="col-12 col-lg-9">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th style="min-width: 265px;" class="text-center" colspan="3">Sản phẩm</th>
                                <th style="min-width: 86px;">Size</th>
                                <th style="min-width: 126px;">Đơn giá</th>
                                <th style="min-width: 88px;">Số lượng</th>
                                <th style="min-width: 126px;">Tạm tính</th>
                                <th style="min-width: 137px;">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($_SESSION['cart-user-id'])) {
                                $total = 0;

                                $user_id = $_SESSION['cart-user-id'];

                                $sql = "SELECT * FROM tbl_cart WHERE user_id = $user_id";
                                $sql2 = "DELETE FROM tbl_cart WHERE user_id = 0";

                                $res = mysqli_query($conn, $sql);
                                $res2 = mysqli_query($conn, $sql2);

                                if ($res == true) {
                                    $count = mysqli_num_rows($res);

                                    if ($count > 0) {
                                        while ($row = mysqli_fetch_assoc($res)) {
                                            $cartId = $row['cart_id'];
                                            $cartProductName = $row['product_name'];
                                            $cartProductImage = $row['product_image'];
                                            $cartProductPrice = $row['product_price'];
                                            $cartTotalPrice = $row['total_price'];
                                            $cartProductQuantity = $row['product_quantity'];
                                            $cartProductSize = $row['product_size'];

                                            if ($cartTotalPrice == 0) {
                                                $total += $cartProductPrice;
                                            } else {
                                                $total += $cartTotalPrice;
                                            }
                            ?>
                                            <tr>
                                                <td colspan="3">
                                                    <div class="row align-items-center">
                                                        <div class="col-2">
                                                            <a href="<?php echo SITEURL . "admin/manage-cart/delete-cart.php?id=" . $cartId . "" ?>" class="remove">
                                                                <i class="fa fa-times"></i>
                                                            </a>
                                                        </div>
                                                        <div class="col-4">
                                                            <img class="img-fluid" src="./assests/images/product/<?php echo $cartProductImage; ?>" alt="" />
                                                        </div>
                                                        <div class="col-6">
                                                            <p class="mb-0"><?php echo $cartProductName; ?></p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <form action="<?php
                                                                echo SITEURL . "admin/manage-cart/update-cart.php"
                                                                ?>" method="GET">
                                                    <td>
                                                        <select name="size" class="form-select" aria-label="Default select example">
                                                            <option <?php
                                                                    if ($cartProductSize == 0 or $cartProductSize == 35) {
                                                                        echo "selected";
                                                                    }
                                                                    ?> value="35">35</option>
                                                            <option <?php
                                                                    if ($cartProductSize == 36) {
                                                                        echo "selected";
                                                                    }
                                                                    ?> value="36">36</option>
                                                            <option <?php
                                                                    if ($cartProductSize == 37) {
                                                                        echo "selected";
                                                                    }
                                                                    ?> value="37">37</option>
                                                            <option <?php
                                                                    if ($cartProductSize == 38) {
                                                                        echo "selected";
                                                                    }
                                                                    ?> value="38">38</option>
                                                            <option <?php
                                                                    if ($cartProductSize == 39) {
                                                                        echo "selected";
                                                                    }
                                                                    ?> value="39">39</option>
                                                            <option <?php
                                                                    if ($cartProductSize == 40) {
                                                                        echo "selected";
                                                                    }
                                                                    ?> value="40">40</option>
                                                        </select>
                                                    </td>

                                                    <td><?php
                                                        echo currency_format($cartProductPrice, " VND");
                                                        ?>
                                                    </td>
                                                    <input type="hidden" name='cart_id' value="<?php echo $cartId; ?>">
                                                    <input type="hidden" name='price' value="<?php echo $cartProductPrice; ?>">
                                                    <td>
                                                        <input class="quanlity form-control" type="number" min="1" value="<?php if ($cartProductQuantity == 0) {
                                                                                                                                echo '1';
                                                                                                                            } else {
                                                                                                                                echo "$cartProductQuantity";
                                                                                                                            } ?>" name="quantity">
                                                    </td>
                                                    <td>
                                                        <?php
                                                        if ($cartTotalPrice == 0) {
                                                            echo currency_format($cartProductPrice, " VND");
                                                        } else {
                                                            echo currency_format($cartTotalPrice, " VND");
                                                        }
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <button type="submit" class="btn btn-update">Cập nhật</button>
                                                    </td>
                                                </form>
                                            </tr>
                                <?php
                                        }
                                    } else {
                                        echo "<td colspan='8' class='text-center'><div class='text-danger'>Giỏ hàng của bạn chưa có sản phẩm.</div></td>";
                                    }
                                }
                                ?>
                        </tbody>
                    </table>
                </div>
                <a href="product.php" class="d-none d-lg-block mt-4">
                    <button class="btn btn-primary comeback">
                        <i class="fa fa-long-arrow-alt-left"></i>
                        Tiếp tục xem sản phẩm
                    </button>
                </a>
            </div>

            <?php
                                if ($res == true) {
                                    $count = mysqli_num_rows($res);
                                    if ($count > 0) {
            ?>
                    <div class="col-12 col-sm-6 col-lg-3 mt-4 mt-lg-0">
                        <table class="table">
                            <thead>
                                <tr>

                                    <th scope="col" colspan="3">Cộng giỏ hàng</th>

                                </tr>
                            </thead>
                            <tbody>
                                <tr class="order__total">

                                    <td>Tổng</td>
                                    <td colspan="2">
                                        <?php
                                        echo currency_format($total, " VND");
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3">
                                        <form action="" method="post">
                                            <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                                            <button type="submit" name="order-submit" class="btn btn-primary w-100">
                                                Đặt hàng
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                    <?php
                                    }
                                }
                            }
                    ?>
                            </tbody>
                        </table>
                    </div>

        </div>
    </div>
</section>

<?php
include('./partials-frontend/footer.php');
?>

<?php
if (isset($_POST['order-submit'])) {
    $user_id = $_POST['user_id'];
    $_SESSION['order-user-id'] = $user_id;
?>
    <script>
        <?php echo ("location.href = '" . SITEURL . "order.php';"); ?>
    </script>
<?php
}
?>