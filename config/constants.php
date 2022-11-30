<?php
session_start();
// 127.0.0.1:3300 này localhost của Dương xóa đá cm :)))
define('LOCALHOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'fast-shoes');
define('SMTP_HOST', 'smtp.gmail.com');
define('SMTP_PORT', '465');
define('SMTP_UNAME', 'fastshoes.hpdn@gmail.com');
define('SMTP_PWORD', 'oamfrxplecehvvwb');

define('SITEURL', 'http://localhost:8080/fast-shoes/');

$conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD, DB_NAME);