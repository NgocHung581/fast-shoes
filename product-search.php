<?php
include('./config/constants.php');
?>

<?php
include('./partials-frontend/header.php');
?>

<div class="search">
    <div class="container">

        <?php

        $search = $_POST['search'];
        
        if ($search == ""){

            ?>

            <script>
            <?php echo ("location.href = '" . SITEURL . "';"); ?>
            alert("Vui lòng nhập từ khóa tìm kiếm");
            </script>

            <?php

            die();
        }
        ?>
        <h1 class="search__title">
            Sản phẩm từ tìm kiếm <span>"<?php echo $search; ?>"</span>
        </h1>
    </div>
</div>

<div class="product">
    <div class="container">
        <div class="row gy-4">

            <?php

            $sql = "SELECT * FROM tbl_product WHERE product_name LIKE '%$search%'";

            $res = mysqli_query($conn, $sql);

            $count = mysqli_num_rows($res);

            if ($count > 0) {
                while ($row = mysqli_fetch_assoc($res)) {
                    $id = $row['product_id'];
                    $name = $row['product_name'];
                    $image_name = $row['product_img'];
                    $price = $row['product_price'];

            ?>

            <div class="col-3">
                <div class="product__item">
                    <div class="product__item-img">
                        <?php

                                if ($image_name == "") {
                                    echo "<div class='text-danger'>Hình ảnh không có sẵn</div>";
                                } else {
                                ?>
                        <img src="./assests/images/product/<?php echo $image_name; ?>" alt="" />
                        <?php
                                }

                                ?>
                    </div>
                    <div class="product__item-description">
                        <h3 class="product__item-name"><?php echo $name; ?></h3>
                        <div class="product__item-price">
                            <?php
                                    if (!function_exists('currency_format')) {
                                        function currency_format($number, $suffix = 'đ')
                                        {
                                            if (!empty($number)) {
                                                return number_format($number, 0, ',', '.') . "{$suffix}";
                                            }
                                        }
                                    }
                                    echo currency_format($price, " VND");
                                    ?>
                        </div>
                        <div class="product__item-rating">
                            <i class="fa-regular fa-star"></i>
                            <i class="fa-regular fa-star"></i>
                            <i class="fa-regular fa-star"></i>
                            <i class="fa-regular fa-star"></i>
                            <i class="fa-regular fa-star"></i>
                        </div>
                    </div>
                    <div class="product__item-buttons">
                        <form action="" method="post">
                            <input type="hidden" name="user_id" value="
                            <?php
                            if (isset($_SESSION['user_id'])) {
                                echo $_SESSION['user_id'];
                            }
                            ?>
                            ">
                            <input type="hidden" name="product_id" value="<?php echo $id ?>">
                            <button type="submit" name="cart-submit" class="btn btn-primary product__item-cart">
                                <i class="fa-solid fa-cart-plus"></i>
                            </button>
                        </form>

                        <a href="order.php" class="btn btn-primary product__item-order">
                            <i class="fa-solid fa-bag-shopping"></i>
                        </a>
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
include('./partials-frontend/footer.php');
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