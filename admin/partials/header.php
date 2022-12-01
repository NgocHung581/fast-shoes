<?php
include('../../config/constants.php');
include('../../partials-frontend/convert-money.php');

if (!isset($_SESSION['admin'])) {
    header("location:" . SITEURL . "login.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="../../assests/images/logo.png" type="image/x-icon" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
    <link rel="stylesheet" href="../css/style.css" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <title>Fast Shoes</title>
</head>

<body>
    <div class="header">
        <div class="container header__content">
            <a href="#" class="header__logo">
                <img class="header__logo-img" src="../../assests/images/logo-removebg.png" alt="Logo" />
            </a>
            <ul class="header__navigation d-flex align-items-center">
                <li class="header__navigation-item">
                    <a href="../manage-home/index.php" <?= echoActiveClassIfRequestMatches("index") ?>
                        class="header__navigation-link">Trang chủ</a>
                </li>
                <li class="header__navigation-item">
                    <a href="../manage-product/manage-product.php"
                        <?= echoActiveClassIfRequestMatches("manage-product") ?> class="header__navigation-link">Sản
                        phẩm</a>
                </li>
                <li class="header__navigation-item">
                    <a href="../manage-category/manage-category.php"
                        <?= echoActiveClassIfRequestMatches("manage-category") ?> class="header__navigation-link">Danh
                        mục</a>
                </li>
                <li class="header__navigation-item">
                    <a href="../manage-admin/manage-admin.php" <?= echoActiveClassIfRequestMatches("manage-admin") ?>
                        class="header__navigation-link ">Admin</a>
                </li>
                <li class="header__navigation-item">
                    <a href="../manage-customer/manage-customer.php"
                        <?= echoActiveClassIfRequestMatches("manage-customer") ?> class="header__navigation-link">Khách
                        hàng</a>
                </li>
                <li class="header__navigation-item">
                    <a href="../manage-contact/manage-contact.php"
                        <?= echoActiveClassIfRequestMatches("manage-contact") ?> class="header__navigation-link">Liên
                        hệ</a>
                </li>
                <li class="header__navigation-item">
                    <a href="../manage-order/manage-order.php" <?= echoActiveClassIfRequestMatches("manage-order") ?>
                        class="header__navigation-link">Đơn hàng</a>
                </li>
            </ul>
            <?php

            function echoActiveClassIfRequestMatches($requestUri)
            {
                $current_file_name = basename($_SERVER['REQUEST_URI'], ".php");

                if ($current_file_name == $requestUri)
                    echo 'class="header__active"';
            }

            ?>
            <div class="header__options ">
                <div class="header__access d-flex align-items-center">
                    <a href="../../index.php" class="header__access-link">Xem cửa hàng</a>
                    <span class="header__access-link">
                        <?php
                        if (isset($_SESSION['admin'])) {
                            echo $_SESSION['admin'];
                        }
                        ?>
                    </span>
                    <a href="../../logout.php" class="header__access-link">Đăng xuất</a>
                </div>
            </div>
        </div>
    </div>