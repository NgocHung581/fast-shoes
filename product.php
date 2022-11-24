<?php
include_once('./partials-frontend/header.php');
?>

<div class="search">
    <div class="container">
        <div class="search__box">
            <form action="product-search.php" method="POST">
                <input type="search" name="search" class="search__box-input" placeholder="Nhập sản phẩm cần tìm..." />
                <button type="submit" name="submit" class="btn btn-primary">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </form>
        </div>
    </div>
</div>

<div class="product">
    <div class="container">
        <h1 class="product__title">Sản phẩm tại cửa hàng</h1>
        <div class="row gy-4">
            <?php

            $sql = "SELECT * FROM tbl_product WHERE product_active = 'Yes'";

            $res = mysqli_query($conn, $sql);

            $count = mysqli_num_rows($res);

            if ($count > 0) {
                while ($row = mysqli_fetch_assoc($res)) {
                    $id = $row['product_id'];
                    $name = $row['product_name'];
                    $image_name = $row['product_img'];
                    $price = $row['product_price'];

            ?>
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-2">
                <div class="card text-center card__item" style="width: 18rem;">
                    <img class="img__product" src="./assests/images/product/<?php echo $image_name; ?>" alt="" />
                    <div class="card-body card__content">
                        <h1 class="card-title"><?php echo $name; ?></h5>
                            <h3 class="card-text"><?php echo currency_format($price, " VND"); ?></h3>
                            <form action="" method="POST">
                                <input type="hidden" name="user_id" value="
                            <?php
                            if (isset($_SESSION['user_id'])) {
                                echo $_SESSION['user_id'];
                            }
                            ?>
                            ">
                                <input type="hidden" name="product_id" value="<?php echo $id ?>">
                                <button type="submit" name="cart-submit" class="btn btn-primary add__cart">
                                    <i class="fa-solid fa-cart-plus"></i> Thêm giỏ hàng
                                </button>
                                <button style="min-width: 185px;" class="btn btn-primary view__detail mt-2">
                                    <a style="text-decoration: none;color: #fff" href=""><i class="fa fa-book-open"></i>
                                        Xem chi tiết</a>
                                </button>
                            </form>
                    </div>
                </div>
            </div>

            <?php
                }
            } else {
                echo "<div class='text-danger'>Không tìm thấy sản phẩm</div>";
            }
            ?>

        </div>
    </div>
</div>

<?php
include_once('./partials-frontend/footer.php');
?>

<?php
if (isset($_POST['cart-submit'])) {
    $user_id = $_POST['user_id'];
    $product_id = $_POST['product_id'];

    $sql2 = "SELECT * FROM tbl_product WHERE product_id = $product_id";

    $res2 = mysqli_query($conn, $sql2);

    if ($res2 == true) {
        $count2 = mysqli_num_rows($res2);

        if ($count2 == 1) {
            $row = mysqli_fetch_assoc($res2);
            $product_name = $row['product_name'];
            $product_image = $row['product_img'];
            $product_price = $row['product_price'];

            $sql3 = "INSERT INTO tbl_cart SET
                                    product_name = '$product_name',
                                    product_image = '$product_image',
                                    product_price = '$product_price',
                                    user_id = '$user_id'
                                    ";

            $res3 = mysqli_query($conn, $sql3);

            if ($res3 == true) {
                $_SESSION['cart-user-id'] = $user_id;
?>
<script>
<?php echo ("location.href = '" . SITEURL . "cart.php';"); ?>
</script>
<?php
            }
        }
    }
}
?>