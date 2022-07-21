<?php
include('./config/constants.php');
?>

<?php
include('./partials-frontend/header.php');
?>

<div class="search">
    <div class="container">

        <?php

        if (isset($_GET['category_id'])) {
            $category_id = $_GET['category_id'];

            $sql = "SELECT category_name FROM tbl_category WHERE category_id = $category_id";

            $res = mysqli_query($conn, $sql);

            $row = mysqli_fetch_assoc($res);

            $category_name = $row['category_name'];
        } 
        else {
            ?>
            <script>
            <?php echo ("location.href = '" . SITEURL . ";"); ?>
            </script>   
            <?php        
        }

        ?>

        <h1 class="search__title">
            Sản phẩm từ danh mục <span>"<?php echo $category_name; ?>"</span>
        </h1>
    </div>
</div>

<div class="product">
    <div class="container">
        <div class="row gy-4">

            <?php

            $sql2 = "SELECT * FROM tbl_product WHERE category_id = $category_id";

            $res2 = mysqli_query($conn, $sql2);

            $count2 = mysqli_num_rows($res2);

            if ($count2 > 0) {
                while ($row2 = mysqli_fetch_assoc($res2)) {
                    $id = $row2['product_id'];
                    $name = $row2['product_name'];
                    $image_name = $row2['product_img'];
                    $price = $row2['product_price'];

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
                echo "<div class='text-danger'>Sản phẩm không có sẵn</div>";
            }
            ?>

        </div>
    </div>
</div>

<?php
include('./partials-frontend/footer.php');
?>