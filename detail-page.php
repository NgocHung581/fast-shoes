<?php
include_once('./partials-frontend/header.php');
?>

<div class="detail-page-container">
    <div class="card__detail">
        <div class="shoeBackground">
            <div class="gradients">
                <div class="gradient second" color="blue"></div>

            </div>
            <h1 class="nike">nike</h1>
            <img src="img/logo.png" alt="" class="logo">

            <img src="http://svcy3.myclass.vn/images/nike-adapt-bb.png" alt="" class="shoe show" color="blue">


        </div>
        <div class="info__detail">
            <div class="shoeName">
                <div>
                    <h1 class="big">Nike Zoom KD 12</h1>
                    <span class="new">new</span>
                </div>
                <h3 class="small">Men's running shoes</h3>
            </div>
            <div class="description">
                <h3 class="title">Product Info</h3>
                <p class="text">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                    Ipsum has been the industry's.</p>
            </div>

            <div class="size-container">
                <h3 class="title">size</h3>
                <div class="sizes">
                    <span class="size">37</span>
                    <span class="size">38</span>
                    <span class="size active">39</span>
                    <span class="size">40</span>
                    <span class="size">41</span>
                    <span class="size">42</span>
                </div>
            </div>

            <div class="price">
                <h1>12.000.000 VNĐ</h1>
            </div>
            <br>
            <a href="#" class="btn btn-primary"><i class="fas fa-shopping-cart"></i> Add to card</a>


        </div>
    </div>

</div>
<hr style="width: 50%; text-align: center;transform: translateX(50%)">
<div class="container">
    <div class="orther__product">
        <h1 class="text-center">Vì bạn đã xem Nike</h1>
        <div class="row gy-4">
            <?php
            $sql2 = "SELECT * FROM tbl_product WHERE product_featured = 'Yes' AND product_active = 'Yes' LIMIT 8";
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
                            <h3 class="card-text"><?php echo currency_format($price, " VND"); ?></h3>
                            <form action="" method="POST">
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

                                    <a class=" product_item view__detail" style="text-decoration: none"
                                        href="detail-page.php"><i class="fa fa-eye"></i></a>

                                    <button class="product_item like__product ">
                                        <i class="fa fa-heart"></i>
                                    </button>
                                </div>
                            </form>
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
include_once('./partials-frontend/footer.php');
?>