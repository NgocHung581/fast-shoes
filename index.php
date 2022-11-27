<?php
include_once('./partials-frontend/header.php');
?>

<div class="swiper-container ">
    <div class="swiper-wrapper">
        <?php
        $sql_slider = "SELECT * FROM tbl_product WHERE slider = 'Yes' AND product_active = 'Yes'";
        $res_slider = mysqli_query($conn, $sql_slider);
        $count_slider = mysqli_num_rows($res_slider);
        if ($count_slider > 0) {
            while ($row = mysqli_fetch_assoc($res_slider)) {
                $product_name = $row['product_name'];
                $product_img = $row['product_img'];
                $product_id = $row['product_id'];
        ?>
        <div class="swiper-slide">
            <img class="img-slide" src="./assests/images/product/<?php echo $product_img; ?>" alt="">
            <div class="info">
                <h1 style="color:var(--primary-color)"><?php echo $product_name; ?></h1>
                <p>$350</p>
                <form action="" method="POST">
                    <input type="hidden" name="user_id" value="
        <?php
                if (isset($_SESSION['user_id'])) {
                    echo $_SESSION['user_id'];
                }
        ?>
        ">
                    <input type="hidden" name='product_id' value="<?php echo $product_id; ?>">
                    <button type="submit" name="cart-submit" class="btn btn-primary">Thêm vào giỏ hàng</button>
                </form>
            </div>
        </div>
        <?php
            }
        } else {
            echo "<div class='text-danger' style='text-align: center;'>Slider không có sẵn</div>";
        }
        ?>
    </div>
    <!-- Add Pagination -->
    <div class="swiper-pagination"></div>

    <div class="swiper-button-prev"></div>
    <div class="swiper-button-next"></div>


</div>

<div class="favourite mt-45">
    <div class="container">
        <h2 class="favourite__title mt-45">Các sản phẩm được yêu thích nhất</h2>
        <div class="row gy-4">
            <?php
            $sql2 = "SELECT * FROM tbl_product WHERE like_count > 0 ORDER BY like_count DESC LIMIT 8";
            $res2 = mysqli_query($conn, $sql2);
            $count2 = mysqli_num_rows($res2);
            if ($count2 > 0) {
                while ($row = mysqli_fetch_assoc($res2)) {
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
                            <form method="POST">
                                <input type="hidden" name="user_id" value="
                            <?php
                            if (isset($_SESSION['user_id'])) {
                                echo $_SESSION['user_id'];
                            }
                            ?>
                            ">
                                <input type="hidden" name="product_id" value="<?php echo $id ?>">
                                <div class="menu__product">
                                    <button type="submit" name="cart-submit" class="product_item add__cart">
                                        <i class="fa fa-shopping-cart"></i>
                                    </button>
                            </form>

                            <form action="detail-page.php" method="GET">
                                <input type="hidden" name="id" value="<?php echo $id ?>">
                                <button class="product_item view__detail" style="text-decoration: none">
                                    <i class="fa fa-eye"></i>
                                </button>
                            </form>
                            <form action="product_liked.php" method="POST">
                                <input type="hidden" name="product_id" value="<?php echo $id ?>">
                                <button type="submit" name="like" class="product_item like__product">
                                    <i class="fa fa-heart"></i>
                                </button>
                            </form>
                    </div>
                </div>
            </div>
        </div>

        <?php
                }
            } else {
                echo "<div class='text-danger'>Sản phẩm không có sẵn</div>";
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

    $sql = "SELECT * FROM tbl_product WHERE product_id = $product_id";
    $res = mysqli_query($conn, $sql);
    if ($res == true) {
        $count = mysqli_num_rows($res);
        if ($count == 1) {
            $row = mysqli_fetch_assoc($res);
            $product_name = $row['product_name'];
            $product_image = $row['product_img'];
            $product_price = $row['product_price'];
            $sql2 = "INSERT INTO tbl_cart SET
                                    product_name = '$product_name',
                                    product_image = '$product_image',
                                    product_price = '$product_price',
                                    user_id = '$user_id'
                                    ";
            $res2 = mysqli_query($conn, $sql2);
            if ($res2 == true) {
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