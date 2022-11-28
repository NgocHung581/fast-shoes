<?php
include_once('./partials-frontend/header.php');
include_once('./partials-frontend/functions.php');
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
                $product_price = $row['product_price'];
        ?>
        <div class="swiper-slide">
            <img class="img-slide" src="./assests/images/product/<?php echo $product_img; ?>" alt="">
            <div class="info">
                <h1 style="color:var(--primary-color)"><?php echo $product_name; ?></h1>
                <p><?php echo currency_format($product_price); ?></p>
                <form action="cart.php" method="POST">
                    <input type="hidden" name="user_id"
                        value="<?php if (isset($_SESSION['user_id'])) echo $_SESSION['user_id']; ?>">
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

                    renderProduct($id, $name, $image_name, $price);
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