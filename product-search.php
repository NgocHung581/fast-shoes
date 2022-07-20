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

            $search = $_POST['search'];

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
                        <a href="cart.php" class="btn btn-primary product__item-cart">
                            <i class="fa-solid fa-cart-plus"></i>
                        </a>
                        <a href="order.php" class="btn btn-primary product__item-order">
                            <i class="fa-solid fa-bag-shopping"></i>
                        </a>
                    </div>
                </div>
            </div>

            <?php
                }
            } else {
                echo "<div class='text-danger'>Không tìm thấy sản phẩm/div>";
            }
            ?>

        </div>
    </div>
</div>

<?php
include('./partials-frontend/footer.php');
?>