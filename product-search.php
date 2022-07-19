<?php
include('./partials-frontend/header.php');
?>

<div class="search">
    <div class="container">
        <h1 class="search__title">
            Sản phẩm từ tìm kiếm <span>"Search"</span>
        </h1>
    </div>
</div>

<div class="product">
    <div class="container">
        <div class="row gy-4">
            <div class="col-3">
                <div class="product__item">
                    <div class="product__item-img">
                        <img src="./assests/images/product/nike.webp" alt="" />
                    </div>
                    <div class="product__item-description">
                        <h3 class="product__item-name">Item name</h3>
                        <div class="product__item-price">2.500.000 VNĐ</div>
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
        </div>
    </div>
</div>

<?php
include('./partials-frontend/footer.php');
?>