<?php
include_once('./partials-frontend/header.php');
?>

<div class="product">
    <div class="container">
        <?php
        $search = "";
        if (isset($_POST['search'])) {
            $search = $_POST['search'];
            if ($search == "") {
                $_SESSION["comeback-home"] = "<script>alert('Vui lòng nhập từ khóa tìm kiếm')</script>";
        ?>
        <script>
        <?php echo ("location.href = '" . SITEURL . "';"); ?>
        </script>
        <?php
            }
        }
        ?>
        <h1 class="search__title">
            Sản phẩm từ tìm kiếm "<?php echo $search; ?>"
        </h1>
        <div class="row gy-4">
            <?php
            $sql = "SELECT * FROM tbl_product WHERE product_name LIKE '%$search%'";
            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);
            if ($count > 0) {
                while ($row = mysqli_fetch_assoc($res)) {
                    $id = $row['product_id'];
                    $name = $row['product_name'];
                    $image_name = $row['product_img'];
                    $price = $row['product_price'];
            ?>
            <div class="col-6 col-md-4 col-lg-3">
                <div class="card text-center card__item" style="width: 18rem;">
                    <img class="img__product" src="./assests/images/product/<?php echo $image_name; ?>" alt="" />
                    <div class="card-body card__content">
                        <h1 class="card-title"><?php echo $name; ?></h5>
                            <h3 class="card-text"> <?php
                                                            if (!function_exists('currency_format')) {
                                                                function currency_format($number, $suffix = 'đ')
                                                                {
                                                                    if (!empty($number)) {
                                                                        return number_format($number, 0, ',', '.') . "{$suffix}";
                                                                    }
                                                                }
                                                            }
                                                            echo currency_format($price, " VND");
                                                            ?></h3>
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
                                    <button class="product_item view__detail ">
                                        <a class="view__detail__css" style="text-decoration: none" href=""><i
                                                class="fa fa-eye"></i></a>
                                    </button>
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
                echo "<div class='text-danger'>Không tìm thấy sản phẩm</div>";
            }
            ?>

        </div>
    </div>
</div>

<?php
include_once('./partials-frontend/footer.php');
?>


<?php
if (isset($_POST['cart-submit'])) {
    $user_id = $_POST['user_id'];
    $product_id = $_POST['product_id'];

    $sql2 = "SELECT * FROM tbl_product WHERE product_id = $product_id";

    $res2 = mysqli_query($conn, $sql2);

    if ($res2 == true) {
        $count2 = mysqli_num_rows($res2);

        if ($count2 == 1) {
            $row = mysqli_fetch_assoc($res2);
            $product_name = $row['product_name'];
            $product_image = $row['product_img'];
            $product_price = $row['product_price'];

            $sql3 = "INSERT INTO tbl_cart SET
                                    product_name = '$product_name',
                                    product_image = '$product_image',
                                    product_price = '$product_price',
                                    user_id = '$user_id'
                                    ";

            $res3 = mysqli_query($conn, $sql3);

            if ($res3 == true) {
                $_SESSION['cart-user-id'] = $user_id;
?>
<script>
<?php echo ("location.href = '" . SITEURL . "cart.php';"); ?>
</script>
<?php
            }
        }
    }
}
?>