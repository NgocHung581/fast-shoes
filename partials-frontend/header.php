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
    <link rel="stylesheet" href="./assests/css/responsive.css" />
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
            <nav class="nav__bar">
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
            </nav>

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
                    ?>
                    <div class="header__cart-box">
                        <h3 class="header-cart-title">Sản phảm đã thêm vào giỏ</h3>
                        <ul class="header__cart-list">
                            <?php
                                if (isset($_SESSION['user_id'])) {
                                    $user_id = $_SESSION['user_id'];
                                    $conn = mysqli_connect('localhost', 'root', '', 'fast-shoes');

                                    $sql = "SELECT * FROM tbl_cart WHERE user_id = $user_id";
                                    $res = mysqli_query($conn, $sql);

                                    $count = mysqli_num_rows($res);

                                    if ($count > 0) {
                                        while ($row = mysqli_fetch_assoc($res)) {
                                            $product_image = $row['product_image'];
                                            $product_name = $row['product_name'];
                                            $product_price = $row['product_price'];
                                            $product_quantity = $row['product_quantity'];
                                ?>
                            <li class="header__cart-item d-flex align-items-center">
                                <div class="cart__item-img">
                                    <img src="./assests/images/product/<?php echo $product_image ?>" alt="" />
                                </div>
                                <div class="cart__item-detail d-flex align-items-center justify-content-between">
                                    <div class="cart__item-description">
                                        <h3 class="cart__item-name"><?php echo $product_name ?></h3>
                                        <p class="cart__item-price"><?php
                                                                                    if (!function_exists('currency_format')) {
                                                                                        function currency_format($number, $suffix = 'đ')
                                                                                        {
                                                                                            if (!empty($number)) {
                                                                                                return number_format($number, 0, ',', '.') . "{$suffix}";
                                                                                            }
                                                                                        }
                                                                                    }
                                                                                    echo currency_format($product_price, " VND");
                                                                                    ?>
                                        </p>
                                    </div>
                                    <div class="cart__item-quantity">x <?php if ($product_quantity == 0) {
                                                                                            $product_quantity = 1;
                                                                                            echo $product_quantity;
                                                                                        } else {
                                                                                            echo $product_quantity;
                                                                                        } ?></div>
                                </div>
                            </li>
                            <?php

                                        }
                                    } else {
                                        ?>
                            <li class="header__cart-item d-flex align-items-center" style="height: unset">
                                <div class="cart__item-img" style="width: 100%">
                                    <img src="./assests/images/cart-empty.png" alt="" />
                                </div>
                            </li>
                            <?php
                                    }
                                }
                                ?>
                        </ul>
                        <p class="header-cart-description">
                            Nhấn vào giỏ hàng để xem chi tiết
                        </p>
                    </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
            <label for="nav__mobile-input" class="d-lg-none">
                <i class="fa fa-bars nav__bar-btn"></i>
            </label>
            <input type="checkbox" name="" id="nav__mobile-input">
            <label for="nav__mobile-input" class="nav__overlay"></label>
            <nav class="nav__bar-mobile">
                <div class="nav__mobile-close">
                    <a style="font-size:2rem" href="login.php" class="header__mobile-navigation-link">Đăng nhập</a>
                    <label for="nav__mobile-input">
                        <i class="fa fa-times"></i>
                    </label>

                </div>
                <ul class="header__mobile-navigation">
                    <li class="header__mobile-navigation-item">
                        <a href="index.php" class="header__mobile-navigation-link">Trang chủ</a>
                    </li>
                    <li class="header__mobile-navigation-item">
                        <a href="product.php" class="header__mobile-navigation-link">Sản phẩm</a>
                    </li>
                    <li class="header__mobile-navigation-item">
                        <a href="category.php" class="header__mobile-navigation-link">Danh mục</a>
                    </li>
                    <li class="header__mobile-navigation-item">
                        <a href="contact.php" class="header__mobile-navigation-link">Liên hệ</a>
                    </li>
                    <li class="header__mobile-navigation-item">
                        <a href="order-customer.php" class="header__mobile-navigation-link">Xem đơn hàng</a>
                    </li>
                    <li class="header__mobile-navigation-item">
                        <a href="login.php" class="header__mobile-navigation-link">Đăng xuất</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>