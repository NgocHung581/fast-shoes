<?php
include('./partials-frontend/header.php');
?>

<div class="search">
    <div class="container">
        <div class="search__box">
            <input type="text" class="search__box-input" placeholder="Nhập sản phẩm cần tìm..." />
            <a href="product-search.php" class="btn btn-primary">
                <i class="fa-solid fa-magnifying-glass"></i>
            </a>
        </div>
    </div>
</div>

<div class="slider mt-45">
    <div class="container slider__content">
        <div class="slider__list owl-carousel">
            <div class="slider__item">
                <img src="./assests/images/product/nike.webp" alt="" />
                <h1>Nike Air Force 1 '07</h1>
                <a href="cart.php" class="btn btn-primary">Thêm vào giỏ hàng</a>
            </div>
            <div class="slider__item">
                <img src="./assests/images/product/nike2.webp" alt="" />
                <h1>Nike Air Max Impact 3</h1>
                <a href="cart.php" class="btn btn-primary">Thêm vào giỏ hàng</a>
            </div>
        </div>
    </div>
</div>

<div class="about mt-45">
    <div class="container">
        <div class="row">
            <div class="col-6">
                <div class="about__description">
                    <h2 class="about__description-title">Giới thiệu</h2>
                    <p class="about__description-detail">
                        Được thành lập từ 2022, với tinh thần mang đến các sản phẩm chất
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
            <div class="col-6">
                <div class="about__img text-end">
                    <img src="./assests/images/logo.png" alt="" />
                </div>
            </div>
        </div>
    </div>
</div>

<div class="favourite mt-45">
    <div class="container">
        <h2 class="favourite__title mt-45">Các sản phẩm nổi bật</h2>
        <div class="row gy-4">
            <div class="col-3">
                <div class="favourite__item">
                    <div class="favourite__item-img">
                        <img src="./assests/images/product/nike.webp" alt="" />
                    </div>
                    <div class="favourite__item-description">
                        <div class="favourite__item-name">Item Name</div>
                        <div class="favourite__item-price">2.500.000 VNĐ</div>
                    </div>
                    <div class="favourite__item-buttons">
                        <a href="cart.php" class="btn btn-primary favourite__item-cart">
                            <i class="fa-solid fa-cart-plus"></i>
                        </a>
                        <a href="order.php" class="btn btn-primary favourite__item-order">
                            <i class="fa-solid fa-bag-shopping"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="category mt-45">
    <div class="container">
        <h2 class="category__title">Danh mục nổi bật</h2>
        <?php

            $sql = "SELECT * FROM tbl_category WHERE category_featured = 'Yes' AND category_active = 'Yes' LIMIT 3";
            
            $res = mysqli_query($conn, $sql);

            $count = mysqli_num_rows($res);

            if($count > 0){
                while($row = mysqli_fetch_assoc($res)){
                    $id = $row['category_id'];
                    $name = $row['category_name'];
                    $image_name = $row['category_img'];
                    $featured = $row['category_featured'];
                    $active = $row['category_active'];
                ?>

                <div class="row">
                    <div class="col-6"> 
                        <a href="category.php" class="category__item">
                            <div class="category__item-img">
                                <?php
                                    if($image_name == ""){
                                        echo "<div class='text-danger'>Hình ảnh không có sẵn</div>";
                                    }
                                    else{
                                        ?>
                                        <img src="./assests/images/category/<?php echo $image_name;?>" alt="" />
                                        <?php
                                    }
                                ?>
                            </div>
                            <div class="category__item-name"><?php echo $name;?></div>
                        </a>
                    </div>
                </div>

                <?php
                }
            }
            else{
                echo "<div class='text-danger'>Danh mục không được thêm vào</div>";
            }
        ?>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="./js/owl.carousel.min.js"></script>
<script src="./js/carousel.js"></script>

<?php
include('./partials-frontend/footer.php');
?>