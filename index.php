<?php
include('./config/constants.php');
?>

<?php
include('./partials-frontend/header.php');
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
            <?php
                if(isset($_SESSION["comeback-home"])){
                    echo $_SESSION["comeback-home"];
                    unset($_SESSION["comeback-home"]);
                }
            ?>
        </div>
    </div>
</div>

<div class="slider mt-45">
    <div class="container slider__content">
        <div class="slider__list owl-carousel">
            <?php

            $sql_slider = "SELECT * FROM tbl_product WHERE slider = 'Yes' LIMIT 3";

            $res_slider = mysqli_query($conn, $sql_slider);

            $count_slider = mysqli_num_rows($res_slider);

            if ($count_slider > 0) {
                while ($row = mysqli_fetch_assoc($res_slider)) {
                    $product_name = $row['product_name'];
                    $product_img = $row['product_img'];
                    $product_id = $row['product_id'];

            ?>

            <div class="slider__item">
                <img src="./assests/images/product/<?php echo $product_img; ?>" alt="" />
                <h1><?php echo $product_name; ?></h1>
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

            <?php
                }
            } else {
                echo "<div class='text-danger'>Slider không có sẵn</div>";
            }
            ?>
        </div>
    </div>
</div>

<div class="about mt-45">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-6">
                <div class="about__description">
                    <h2 class="about__description-title">Giới thiệu</h2>
                    <p class="about__description-detail">
                        Được thành lập bởi Dương Hùng Phát vào năm 2022 với tinh thần mang đến các sản phẩm chất
                        lượng, cam kết uy tín và sự tín nhiệm cao nhất từ Khách hàng.
                        <br />
                        <br />
                        Địa chỉ: Hẻm 69/68 Đặng Thuỳ Trâm, Phường 13, Bình Thạnh, Thành
                        phố Hồ Chí Minh <br />
                        Điện thoại: 0123456789 <br />
                        Email: vlu@gmail.com
                    </p>
                </div>
            </div>
            <div class="col-12 col-md-6">

                <img class="img-fluid" src="./assests/images/logo.png" alt="" />

            </div>
        </div>
    </div>
</div>

<div class="favourite mt-45">
    <div class="container">
        <h2 class="favourite__title mt-45">Các sản phẩm nổi bật</h2>
        <div class="row gy-4">

            <?php

            $sql2 = "SELECT * FROM tbl_product WHERE product_featured = 'Yes' AND product_active = 'Yes' LIMIT 8";

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
                <div class="favourite__item">
                    <div class="favourite__item-img">
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
                    <div class="favourite__item-description">
                        <div class="favourite__item-name"><?php echo $name; ?></div>
                        <div class="favourite__item-price">
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
                    </div>
                    <div class="favourite__item-buttons">
                        <form action="" method="POST">
                            <input type="hidden" name="user_id" value="
                            <?php
                            if (isset($_SESSION['user_id'])) {
                                echo $_SESSION['user_id'];
                            }
                            ?>
                            ">
                            <input type="hidden" name="product_id" value="<?php echo $id ?>">
                            <button type="submit" name="cart-submit" class="btn btn-primary favourite__item-cart">
                                <i class="fa-solid fa-cart-plus"></i>
                            </button>
                        </form>
                        <form action="" method="POST">
                            <a href="order.php" class="btn btn-primary favourite__item-order">
                                <i class="fa-solid fa-bag-shopping"></i>
                            </a>
                        </form>

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

<div class="category mt-45">
    <div class="container">
        <h2 class="category__title">Danh mục nổi bật</h2>
        <div class="row">
            <?php

            $sql = "SELECT * FROM tbl_category WHERE category_featured = 'Yes' AND category_active = 'Yes' LIMIT 4";

            $res = mysqli_query($conn, $sql);

            $count = mysqli_num_rows($res);

            if ($count > 0) {
                while ($row = mysqli_fetch_assoc($res)) {
                    $id = $row['category_id'];
                    $name = $row['category_name'];
                    $image_name = $row['category_img'];

            ?>

            <div class="col-12 col-md-6 col-lg-4 mb-2">
                <a href="category-product.php?category_id=<?php echo $id; ?>" class="category__item">
                    <div class="category__item-img">

                        <?php

                                if ($image_name == "") {
                                    echo "<div class='text-danger'>Hình ảnh không có sẵn</div>";
                                } else {
                                ?>
                        <img src="./assests/images/category/<?php echo $image_name; ?>" alt="" />
                        <?php
                                }

                                ?>

                    </div>
                    <div class="category__item-name"><?php echo $name; ?></div>
                </a>
            </div>
            <?php
                }
            } else {
                echo "<div class='text-danger'>Danh mục không được thêm vào</div>";
            }
            ?>

        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="./js/owl.carousel.min.js"></script>
<script src="./js/carousel.js"></script>

<?php
include('./partials-frontend/footer.php');
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