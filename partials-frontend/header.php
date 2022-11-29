<?php
include_once('./config/constants.php');
include_once('convert-money.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="./assests/images/logo.png" type="image/x-icon" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
    <!-- swiperjs -->
    <link rel="stylesheet" href="./assests/css/swiper.min.css" />
    <link rel="stylesheet" href="./assests/css/style.css" />
    <link rel="stylesheet" href="./assests/css/home.css" />
    <link rel="stylesheet" href="./assests/css/product.css" />
    <link rel="stylesheet" href="./assests/css/category.css" />
    <link rel="stylesheet" href="./assests/css/contact.css" />
    <link rel="stylesheet" href="./assests/css/order-customer.css" />
    <link rel="stylesheet" href="./assests/css/cart.css" />
    <link rel="stylesheet" href="./assests/css/order.css" />
    <link rel="stylesheet" href="./assests/css/account.css" />
    <link rel="stylesheet" href="./assests/css/responsive.css" />
    <link rel="stylesheet" href="./assests/css/detail-page.css">

    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a81368914c.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <title>Fast Shoes</title>
</head>

<body>
    <?php
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
        $sql2 = "SELECT * FROM tbl_user WHERE user_id = $user_id";
        $res2 = mysqli_query($conn, $sql2);
        if ($res2 == true) {
            $count2 = mysqli_num_rows($res2);
            if ($count2 == 1) {
                $row = mysqli_fetch_assoc($res2);
                $fullname = $row['fullname'];
                $avatar = $row['avatar'];
            }
        }
    }
    ?>
    <div class="header">
        <div class="container header__content">
            <a href="index.php" class="header__logo">
                <img class="header__logo-img" src="./assests/images/logo-removebg.png" alt="Logo" />
            </a>

            <nav class="nav__bar">
                <ul class="header__navigation d-flex align-items-center">
                    <li>
                        <a href="index.php" <?= echoActiveClassIfRequestMatches("index") ?>
                            class="header__navigation-link">Trang chủ</a>
                    </li>
                    <li>
                        <a href="product.php" <?= echoActiveClassIfRequestMatches("product") ?>
                            class="header__navigation-link">Sản phẩm</a>
                    </li>
                    <li>
                        <a href="category.php" <?= echoActiveClassIfRequestMatches("category") ?>
                            class="header__navigation-link">Danh mục</a>
                    </li>
                    <li>
                        <a href="contact.php" <?= echoActiveClassIfRequestMatches("contact") ?>
                            class="header__navigation-link">Liên hệ</a>
                    </li>
                </ul>
            </nav>

            <?php
            function echoActiveClassIfRequestMatches($requestUri)
            {
                $current_file_name = basename($_SERVER['REQUEST_URI'], ".php");
                if ($current_file_name == $requestUri)
                    echo 'class="header__active"';
            }
            ?>

            <div class="header__options d-flex align-items-center">
                <div class="header__search">
                    <label for="header__search-toggle" class="header__search-label">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </label>
                    <input type="checkbox" id="header__search-toggle">
                    <form action="product-search.php" method="POST" class="header__search-box">
                        <div>
                            <input type="text" name="search" placeholder="Nhập sản phẩm cần tìm..." />
                            <button type="submit" name="submit">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </button>
                        </div>
                    </form>
                </div>
                <div class="header__access">
                    <?php
                    if (isset($_SESSION["user_id"])) {
                    ?>
                    <img src="<?php if ($avatar) {
                                        echo "./assests/images/user/$avatar";
                                    } else {
                                        echo './assests/images/user.png';
                                    } ?>" alt="" class="header__access-avatar" />
                    <div class="header__access-options">
                        <span><?php echo $_SESSION["user"]; ?></span>
                        <a href="account.php" class="header__options-item">
                            <i class="fa-solid fa-user me-1" style="width: 20px"></i>
                            <span>Tài khoản</span>
                        </a>
                        <a href="order-customer.php" class="header__options-item">
                            <i class="fa-solid fa-book-open me-1" style="width: 20px"></i>
                            <span>Xem đơn hàng</span>
                        </a>
                        <a href="logout.php" class="header__options-item">
                            <i class="fa-solid fa-arrow-right-from-bracket me-1" style="width: 20px"></i>
                            <span>Đăng xuất</span>
                        </a>

                    </div>
                    <?php
                    } else {
                    ?>
                    <a href="login.php" class="header__access-link">
                        <i class="fa-regular fa-circle-user"></i>
                    </a>
                    <?php
                    }
                    ?>
                </div>
                <div class="header__cart">
                    <form action="" method="post">
                        <button type="submit" name='view-cart-submit' class="header__cart-link">
                            <i class="fa-solid fa-cart-shopping"></i>
                            <span class="header__cart-quantity">
                                <?php
                                if (isset($_SESSION['user_id'])) {
                                    $customer_id = $_SESSION['user_id'];

                                    $sql1 = "SELECT * FROM tbl_cart WHERE user_id = $customer_id";
                                    $res1 = mysqli_query($conn, $sql1);
                                    if ($res1 == true) {
                                        $count = mysqli_num_rows($res1);
                                        echo $count;
                                    } else {
                                        echo 0;
                                    }
                                } else {
                                    echo 0;
                                }
                                ?>
                            </span>
                        </button>
                    </form>
                    <?php
                    if (isset($_POST['view-cart-submit'])) {
                        if (isset($_SESSION['user_id'])) {
                            $_SESSION['cart-user-id'] = $_SESSION['user_id'];
                        }
                    ?>
                    <script>
                    <?php echo ("location.href = '" . SITEURL . "cart.php';"); ?>
                    </script>
                    <?php
                    }
                    ?>


                    <?php
                    if (isset($_SESSION["user"])) {
                    ?>
                    <div class="header__cart-box">
                        <h3 class="header-cart-title">Sản phảm đã thêm vào giỏ</h3>
                        <ul class="header__cart-list">
                            <?php
                                if (isset($_SESSION['user_id'])) {
                                    $user_id = $_SESSION['user_id'];

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
                                        <p class="cart__item-price"><?php echo currency_format($product_price); ?></p>
                                    </div>
                                    <div class="cart__item-quantity">x <?php echo $product_quantity; ?></div>
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
                <label for="nav__mobile-input" class="d-md-none">
                    <i class="fa fa-bars nav__bar-btn"></i>
                </label>
            </div>

            <input type="checkbox" name="" id="nav__mobile-input">
            <label for="nav__mobile-input" class="nav__overlay"></label>
            <nav class="nav__bar-mobile">
                <div class="nav__mobile-close">
                    <?php
                    if (isset($_SESSION["user"])) {
                        echo '<span style="font-size:2rem" class="header__mobile-navigation-link">' . $_SESSION["user"] . '</span>';
                    } else {
                        echo '<a style="font-size:2rem" href="login.php" class="header__mobile-navigation-link">Đăng nhập</a>';
                    }
                    ?>
                    <label for="nav__mobile-input">
                        <i class="fa fa-times"></i>
                    </label>

                </div>
                <ul class="header__mobile-navigation">
                    <li class="header__mobile-navigation-item">
                        <i class="fa fa-home"></i>
                        <a href="index.php" class="header__mobile-navigation-link">Trang chủ</a>
                    </li>
                    <li class="header__mobile-navigation-item">
                        <i class="fa fa-shopping-cart"></i>
                        <a href="product.php" class="header__mobile-navigation-link">Sản phẩm</a>
                    </li>
                    <li class="header__mobile-navigation-item">
                        <i class="fa fa-list"></i>
                        <a href="category.php" class="header__mobile-navigation-link">Danh mục</a>
                    </li>
                    <li class="header__mobile-navigation-item">
                        <i class="fa fa-phone"></i>
                        <a href="contact.php" class="header__mobile-navigation-link">Liên hệ</a>
                    </li>
                    <?php
                    if (isset($_SESSION["user"])) {
                        echo '<li class="header__mobile-navigation-item">
                        <i class="fa fa-book-open"></i>
                        <a href="order-customer.php" class="header__mobile-navigation-link">Xem đơn hàng</a>
                    </li>
                    <li class="header__mobile-navigation-item">
                        <i class="fa fa-sign-out-alt"></i>
                        <a href="logout.php" class="header__mobile-navigation-link">Đăng xuất</a>
                    </li>';
                    }
                    ?>
                </ul>
            </nav>
        </div>
    </div>