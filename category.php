<?php
include_once('./partials-frontend/header.php');
?>

<div class="categoryPage">
    <div class="container">
        <h1 class="categoryPage__title">Danh mục tại cửa hàng</h1>
        <div class="row gy-4">
            <?php
            $sql = "SELECT * FROM tbl_category WHERE category_active = 'Yes'";
            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);
            if ($count > 0) {
                while ($row = mysqli_fetch_assoc($res)) {
                    $id = $row['category_id'];
                    $name = $row['category_name'];
                    $image_name = $row['category_img'];

            ?>
            <div class="col-6 col-lg-4 col-xl-3 mb-2">
                <a href="category-product.php?category_id=<?php echo $id; ?>" class="categoryPage__item">
                    <div class="categoryPage__item-img">
                        <?php
                                if ($image_name == "") {
                                    echo "<div class='text-danger'>Không tìm thấy hình ảnh</div>";
                                } else {
                                ?>
                        <img src="./assests/images/category/<?php echo $image_name; ?>" alt="" />
                        <?php
                                }
                                ?>
                    </div>
                    <div class="categoryPage__item-name"><?php echo $name; ?></div>
                </a>
            </div>
            <?php
                }
            } else {
                echo "<div class='text-danger'>Không tìm thấy danh mục</div>";
            }
            ?>
        </div>
    </div>
</div>
</div>
</div>
</div>

<?php
include_once('./partials-frontend/footer.php');
?>