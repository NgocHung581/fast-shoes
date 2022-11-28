<?php
include_once('./partials-frontend/header.php');
include_once('./partials-frontend/functions.php');
?>


<div class="product">
    <div class="container">
        <div class="row gy-4">
            <?php
            if (isset($_GET['category_id'])) {
                $category_id = $_GET['category_id'];
                $sql = "SELECT category_name FROM tbl_category WHERE category_id = $category_id";
                $res = mysqli_query($conn, $sql);
                if ($res == true) {
                    $row = mysqli_fetch_assoc($res);
                    $category_name = $row['category_name'];
                }
            } else {
            ?>
            <script>
            <?php echo ("location.href = '" . SITEURL . "'"); ?>
            </script>
            <?php
            }

            ?>
            <h1 class="search__title">
                Sản phẩm từ danh mục <span>"<?php echo $category_name; ?>"</span>
            </h1>
            <?php
            $sql2 = "SELECT * FROM tbl_product WHERE category_id = $category_id";
            $res2 = mysqli_query($conn, $sql2);
            $count2 = mysqli_num_rows($res2);
            if ($count2 > 0) {
                while ($row2 = mysqli_fetch_assoc($res2)) {
                    $id = $row2['product_id'];
                    $name = $row2['product_name'];
                    $image_name = $row2['product_img'];
                    $price = $row2['product_price'];

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
include_once('./partials-frontend/footer.php');
?>