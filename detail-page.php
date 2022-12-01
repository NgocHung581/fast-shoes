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
            $created_at = $row['created_at'];
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
                    <?php
                                $date1 = $created_at;
                                date_default_timezone_set('Asia/Ho_Chi_Minh');
                                $date2 = date("Y-m-d");
                                $timestamp1 = strtotime($date1);
                                $timestamp2 = strtotime($date2);
                                $difference = $timestamp2 - $timestamp1;
                                if ($difference <= 86400) {
                                ?>
                    <span class="new">new</span>
                    <?php
                                }
                                ?>
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
            <form action="cart.php" method="POST">
                <input type="hidden" name="user_id"
                    value="<?php if (isset($_SESSION['user_id'])) echo $_SESSION['user_id']; ?>">
                <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                <input type="hidden" name="size" id="size" value="35">
                <button type="submit" name="cart-submit" class="btn btn-primary">
                    <i class="fas fa-shopping-cart"></i> Thêm vào giỏ hàng
                </button>
            </form>
        </div>
    </div>
</div>

<script>
const sizeElements = document.getElementsByClassName('size')
const sizeValue = document.getElementById('size')
Array.prototype.forEach.call(sizeElements, size => {
    size.onclick = () => {
        sizeValue.value = size.textContent
    }
});
</script>

<hr style="width: 50%; text-align: center;transform: translateX(50%)">


<div class="container">
    <div class="comment py-5">

        <?php
                    $sql3 = "SELECT * FROM tbl_comment INNER JOIN tbl_product INNER JOIN tbl_user ON tbl_comment.product_id = tbl_product.product_id AND tbl_comment.username = tbl_user.username WHERE product_name LIKE '%$product_name%' ORDER BY comment_id DESC LIMIT 0,5";
                    $res3 = mysqli_query($conn, $sql3);
                    $count = mysqli_num_rows($res3);
                    ?>
        <h1 class="text-center">Bình luận(<?php echo $count ?>)</h1>
        <?php
                    if ($count > 0) {

                        while ($row = mysqli_fetch_array($res3)) {
                            $created_at = $row['created_at'];
                            $fullname = $row['fullname'];
                            $content = $row['content'];
                            $avatar = $row['avatar'];
                            $username = $row['username'];
                    ?>

        <div class="content__comment">

            <div class="header__content-comment d-flex align-items-center ">
                <img style="border-radius:50%" width="50" height="50" src="<?php if ($avatar) {
                                                                            echo "./assests/images/user/$avatar";
                                                                        } else {
                                                                            echo './assests/images/user.png';
                                                                        } ?>" alt="">
                <?php
                                    $name = $_SESSION['username'];
                                    if ($name == $username) {
                                        echo "<h3 style='margin-left: 10px;' class='mb-0 text-danger '>Bạn</h3>";
                                    } else {
                                        echo "<h3 style='margin-left: 10px;' class='mb-0'>$fullname</h3>";
                                    }

                                    ?>
            </div>
            <i style="font-size:0.875rem"><?php

                                                                echo get_time_ago(strtotime($created_at)) ?></i>
            <p><?php echo $content; ?></p>
        </div>

        <?php
                        }
                    } else {

                        echo "<div class='text-danger mb-3'>Bạn hãy là người bình luận đầu tiên!!</div>";
                    }
                    ?>
        <form action="" method="post">
            <input style="width: 50%;height: 42px;border-radius: 10px;padding: 0 10px" type="text" name="comment"
                placeholder="Hãy nhập bình luận của bạn">
            <button name="submit-comment" class="btn btn-primary" type="submit">Gửi</button>
        </form>

        <?php

                    if (isset($_SESSION['username'])) {
                        if (isset($_POST['submit-comment'])) {
                            $comment = $_POST['comment'];
                            $name = $_SESSION['username'];
                            date_default_timezone_set('Asia/Ho_Chi_Minh');
                            $date = date('Y-m-d');

                            $sql = "INSERT INTO tbl_comment(content,product_id,username,created_at) VALUES ('$comment',$product_id,'$name','$date')";
                            mysqli_query($conn, $sql);

                    ?>
        <script>
        <?php echo ("location.href = '" . SITEURL . "detail-page.php?id=$product_id'"); ?>
        </script>
        <?php
                        }
                    } else {
                        echo '<a style="font-size:2rem" href="login.php" class="header__mobile-navigation-link">Đăng nhập</a>';
                    }
                    ?>






    </div>
    <hr style="width: 50%; text-align: center;transform: translateX(50%)">
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

                                renderProduct($conn, $id, $name, $image_name, $price);
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