<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="./assests/images/logo.png" type="image/x-icon" />
    <link rel="stylesheet" href="./assests/css/carousel/owl.carousel.min.css" />
    <link rel="stylesheet" href="./assests/css/carousel/owl.theme.default.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
    <link rel="stylesheet" href="./assests/css/style.css" />
    <link rel="stylesheet" href="./assests/css/home.css" />
    <link rel="stylesheet" href="./assests/css/product.css" />
    <link rel="stylesheet" href="./assests/css/category.css" />
    <link rel="stylesheet" href="./assests/css/contact.css" />
    <link rel="stylesheet" href="./assests/css/order-customer.css" />
    <link rel="stylesheet" href="./assests/css/cart.css" />
    <link rel="stylesheet" href="./assests/css/order.css" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <title>Fast Shoes</title>
</head>

<body>
    <div class="header">
        <div class="container header__content">
            <a href="index.php" class="header__logo">
                <img class="header__logo-img" src="./assests/images/logo-removebg.png" alt="Logo" />
            </a>
            <ul class="header__navigation d-flex align-items-center">
                <li class="header__navigation-item">
                    <a href="index.php" class="header__navigation-link">Trang chủ</a>
                </li>
                <li class="header__navigation-item">
                    <a href="product.php" class="header__navigation-link">Sản phẩm</a>
                </li>
                <li class="header__navigation-item">
                    <a href="category.php" class="header__navigation-link">Danh mục</a>
                </li>
                <li class="header__navigation-item">
                    <a href="contact.php" class="header__navigation-link">Liên hệ</a>
                </li>
            </ul>
            <div class="header__options d-flex align-items-center">
                <div class="header__access">
                    <?php
                    if (isset($_SESSION["user"])) {
                        echo '<span class="header__access-link">' . $_SESSION["user"] . '</span>';
                        echo '<div class="header__access-options">
                        <a href="order-customer.php" class="header__options-item">Xem đơn hàng của bạn</a>
                        <a href="logout.php" class="header__options-item">Đăng xuất</a>
                    </div>';
                    } else {
                        echo '<a href="login.php" class="header__access-link">Đăng nhập</a>';
                    }
                    ?>
                </div>
                <div class="header__cart">
                    <a href="cart.php" class="header__cart-link">
                        <i class="fa-solid fa-cart-shopping"></i>
                        <span class="header__cart-quantity">0</span>
                    </a>
                    <?php
                    if (isset($_SESSION["user"])) {
                        echo '<div class="header__cart-box">
                        <h3 class="header-cart-title">Sản phảm đã thêm vào giỏ</h3>
                        <ul class="header__cart-list">
                            <li class="header__cart-item d-flex align-items-center">
                                <div class="cart__item-img">
                                    <img src="./assests/images/product/nike.webp" alt="" />
                                </div>
                                <div class="cart__item-detail d-flex align-items-center justify-content-between">
                                    <div class="cart__item-description">
                                        <h3 class="cart__item-name">Nike</h3>
                                        <p class="cart__item-price">2.050.000 VNĐ</p>
                                    </div>
                                    <div class="cart__item-quantity">x 1</div>
                                </div>
                            </li>
                        </ul>
                        <p class="header-cart-description">
                            Nhấn vào giỏ hàng để xem chi tiết
                        </p>
                    </div>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>