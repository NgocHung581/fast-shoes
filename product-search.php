<?php
include_once('./partials-frontend/header.php');
include_once('./partials-frontend/functions.php');
?>

<div class="product">
    <div class="container">
        <?php
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

                    renderProduct($id, $name, $image_name, $price);
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