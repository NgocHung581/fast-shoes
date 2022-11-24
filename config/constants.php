<?php
session_start();
// 127.0.0.1:3300 này localhost của Dương xóa đá cm :)))
define('LOCALHOST', '127.0.0.1:3300');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'fast-shoes');

define('SITEURL', 'http://localhost/Shoes-Store/');

$conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD, DB_NAME);