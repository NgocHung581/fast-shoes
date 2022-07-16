<?php 
    include('../../config/constants.php')
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
    <link rel="stylesheet" href="../css/style.css" />
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
                    <a href="#" class="header__navigation-link header__navigation-link--active">Trang chủ</a>
                </li>
                <li class="header__navigation-item">
                    <a href="#" class="header__navigation-link">Sản phẩm</a>
                </li>
                <li class="header__navigation-item">
                    <a href="#" class="header__navigation-link">Danh mục</a>
                </li>
                <li class="header__navigation-item">
                    <a href="#" class="header__navigation-link">Admin</a>
                </li>
            </ul>
            <div class="header__options ">
                <div class="header__access d-flex align-items-center">
                    <a href="#" class="header__access-link">Đăng nhập</a>
                    <a href="#" class="header__access-link">Đăng xuất</a>
                </div>
            </div>
        </div>
    </div>