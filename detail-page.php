<?php
if (isset($_GET['id'])) {
    $product_id = $_GET['id'];
?>

<?php
    include_once('./partials-frontend/header.php');
    include_once('./partials-frontend/functions.php');
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

            <img src="img/logo.png" alt="" class="logo">
            <img src="./assests/images/product/<?php echo $product_img; ?>" alt="" class="shoe show" color="blue">
        </div>
        <div class="info__detail">
            <div class="shoeName">
                <div>
                    <h1 class="big"><?php echo $product_name; ?></h1>
                    <span class="new">new</span>
                </div>
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
                <i class="fas fa-shopping-cart"></i> Thêm vào giỏ hàng
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

                                renderProduct($id, $name, $image_name, $price);
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