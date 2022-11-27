<?php
if (isset($_GET['id'])) {
    $product_id = $_GET['id'];
?>

<?php
    include_once('./partials-frontend/header.php');
    include_once('./partials-frontend/convert-money.php');
    ?>

<?php
    $sql = "SELECT * FROM tbl_product as P, tbl_category as C WHERE P.category_id = C.category_id AND product_id = $product_id";
    $res = mysqli_query($conn, $sql);
    if ($res == true) {
        $count = mysqli_num_rows($res);
        if ($count == 1) {
            $row = mysqli_fetch_assoc($res);
            $product_name = $row['product_name'];
            $product_img = $row['product_img'];
            $product_price = $row['product_price'];
            $category_id = $row['category_id'];
            $category_name = $row['category_name'];
    ?>
<div class="detail-page-container">
    <div class="card__detail">
        <div class="shoeBackground">
            <div class="gradients">
                <div class="gradient second" color="blue"></div>
            </div>
            <h1 class="nike">nike</h1>
            <img src="img/logo.png" alt="" class="logo">
            <img src="./assests/images/product/<?php echo $product_img; ?>" alt="" class="shoe show" color="blue">
        </div>
        <div class="info__detail">
            <div class="shoeName">
                <div>
                    <h1 class="big"><?php echo $product_name; ?></h1>
                    <span class="new">new</span>
                </div>
                <h3 class="small">Men's running shoes</h3>
            </div>
            <div class="description">
                <h3 class="title">Mô tả</h3>
                <p class="text">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                    Ipsum has been the industry's.</p>
            </div>

            <div class="size-container">
                <h3 class="title">size</h3>
                <div class="sizes">
                    <span class="size active">35</span>
                    <span class="size">36</span>
                    <span class="size">37</span>
                    <span class="size">38</span>
                    <span class="size">39</span>
                    <span class="size">40</span>
                </div>
            </div>

            <div class="price">
                <h1><?php echo currency_format($product_price); ?></h1>
            </div>
            <br>
            <a href="#" class="btn btn-primary">
                <i class="fas fa-shopping-cart"></i> Add to card
            </a>
        </div>
    </div>

</div>
<hr style="width: 50%; text-align: center;transform: translateX(50%)">

<div class="container">
    <div class="orther__product">
        <h1 class="text-center">Vì bạn đã xem <?php echo $category_name; ?></h1>
        <div class="row gy-4">
            <?php
                        $sql2 = "SELECT * FROM tbl_product WHERE category_id = $category_id AND product_id != $product_id LIMIT 4";
                        $res2 = mysqli_query($conn, $sql2);
                        $count2 = mysqli_num_rows($res2);
                        if ($count2 > 0) {
                            while ($row = mysqli_fetch_assoc($res2)) {
                                $id = $row['product_id'];
                                $name = $row['product_name'];
                                $image_name = $row['product_img'];
                                $price = $row['product_price'];
                        ?>
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-2">
                <div class="card text-center card__item" style="width: 18rem;">
                    <img class="img__product" src="./assests/images/product/<?php echo $image_name; ?>" alt="" />
                    <div class="card-body card__content">
                        <h1 class="card-title"><?php echo $name; ?></h5>
                            <h3 class="card-text"><?php echo currency_format($price); ?></h3>
                            <form action="index.php" method="POST">
                                <input type="hidden" name="user_id" value="
                            <?php
                                if (isset($_SESSION['user_id'])) {
                                    echo $_SESSION['user_id'];
                                }
                            ?>
                            ">
                                <input type="hidden" name="product_id" value="<?php echo $id ?>">
                                <div class="menu__product">
                                    <button type="submit" name="cart-submit" class="product_item add__cart">
                                        <i class="fa fa-shopping-cart"></i>
                                    </button>
                            </form>

                            <form action="detail-page.php" method="GET">
                                <input type="hidden" name="id" value="<?php echo $id ?>">
                                <button class="product_item view__detail" style="text-decoration: none">
                                    <i class="fa fa-eye"></i>
                                </button>
                            </form>

                            <form action="product_liked.php" method="POST">
                                <input type="hidden" name="product_id" value="<?php echo $id ?>">
                                <button type="submit" name="like" class="product_item like__product">
                                    <i class="fa fa-heart"></i>
                                </button>
                            </form>
                    </div>
                </div>
            </div>
        </div>

        <?php
                            }
                        } else {
                            echo "<div class='text-danger'>Sản phẩm không có sẵn</div>";
                        }
            ?>
    </div>
</div>
</div>
<?php
        } else {
        ?>
<script>
<?php echo ("location.href = '" . SITEURL . "'"); ?>
</script>
<?php
        }
    }
    ?>
<?php
    include_once('./partials-frontend/footer.php');
    ?>
<?php
} else {
    include_once('./config/constants.php');
?>
<script>
<?php echo ("location.href = '" . SITEURL . "'"); ?>
</script>
<?php
}