<?php
include('../partials/header.php');
?>

<div class="main-content">
    <div class="container">
        <h1 class="mb-20">Quản lý sản phẩm</h1>
        <?php
        if (isset($_SESSION["add"])) {
            echo $_SESSION["add"];
            unset($_SESSION["add"]);
        }

        if (isset($_SESSION["remove"])) {
            echo $_SESSION["remove"];
            unset($_SESSION["remove"]);
        }

        if (isset($_SESSION["delete"])) {
            echo $_SESSION["delete"];
            unset($_SESSION["delete"]);
        }

        if (isset($_SESSION["no-product-found"])) {
            echo $_SESSION["no-product-found"];
            unset($_SESSION["no-product-found"]);
        }

        if (isset($_SESSION["update"])) {
            echo $_SESSION["update"];
            unset($_SESSION["update"]);
        }

        if (isset($_SESSION["upload"])) {
            echo $_SESSION["upload"];
            unset($_SESSION["upload"]);
        }

        if (isset($_SESSION["failed-remove"])) {
            echo $_SESSION["failed-remove"];
            unset($_SESSION["failed-remove"]);
        }
        ?>
        <a href="add-product.php" class="btn btn-success mb-20">Thêm sản phẩm</a>

        <table class="table table-striped align-middle">
            <thead class="table-info">
                <tr>
                    <th>STT</th>
                    <th>Tên sản phẩm</th>
                    <th>Danh mục</th>
                    <th>Hình ảnh sản phẩm</th>
                    <th>Giá tiền</th>
                    <th>Featured</th>
                    <th>Active</th>
                    <th>Slider</th>
                    <th>Hành động</th>
                </tr>
            </thead>


            <?php
            $sql = "SELECT * FROM tbl_product";

            $res = mysqli_query($conn, $sql);

            if ($res ==  true) {
                $count = mysqli_num_rows($res);
                $sn = 1;

                if ($count > 0) {
                    while ($row = mysqli_fetch_assoc($res)) {
                        $id = $row['product_id'];
                        $name = $row['product_name'];
                        $img_name = $row['product_img'];
                        $price = $row['product_price'];
                        $featured = $row['product_featured'];
                        $active = $row['product_active'];
                        $slider = $row['slider'];
                        $category_id = $row['category_id'];

                        // Get category_name                                           
                        $sql2 = "SELECT category_name FROM tbl_category WHERE category_id = $category_id";
                        $res2 = mysqli_query($conn, $sql2);
                        $row2 = mysqli_fetch_assoc($res2);
                        $category_name = $row2['category_name'];
                        
                        
            ?>
            <tr>
                <td><?php echo $sn++; ?></td>
                <td><?php echo $name; ?></td>
                <td><?php echo $category_name; ?></td>
                <td>
                    <?php
                                if ($img_name != "") {
                                ?>
                    <img src="../../assests/images/product/<?php echo $img_name; ?>" width="100px">
                    <?php
                                } else {
                                    echo "<div class='text-danger'>Hình ảnh chưa được thêm vào</div>";
                                }
                                ?>
                </td>
                <td>
                    <?php
                                if (!function_exists('currency_format')) {
                                    function currency_format($number, $suffix = 'đ')
                                    {
                                        if (!empty($number)) {
                                            return number_format($number, 0, ',', '.') . "{$suffix}";
                                        }
                                    }
                                }
                                echo currency_format($price, " VND");
                                ?>
                </td>
                <td><?php echo $featured; ?></td>
                <td><?php echo $active; ?></td>
                <td><?php echo $slider; ?></td>
                <td>
                    <a href="../manage-product/update-product.php?id=<?php echo $id; ?>" class="btn btn-primary">Cập
                        nhật</a>
                    <a href="../manage-product/delete-product.php?id=<?php echo $id; ?>&img_name=<?php echo $img_name; ?>"
                        class="btn btn-danger">Xóa</a>
                </td>
            </tr>
            <?php
                    }
                } else {
                    echo '<tr>
                    <td colspan="9">
                        <div class="text-danger text-center">Không có sản phẩm nào được thêm vào.</div>
                    </td>
                </tr>';
                }
            }
            ?>
        </table>
    </div>
</div>

<?php
include('../partials/footer.php');
?>