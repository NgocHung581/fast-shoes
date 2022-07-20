<?php
include('../partials/header.php');
?>

<div class="main-content">
    <div class="container">
        <h1 class="mb-20">Cập nhật sản phẩm</h1>
        <?php
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            $sql = "SELECT * FROM tbl_product WHERE product_id = $id";
            $res = mysqli_query($conn, $sql);

            if ($res == true) {
                $count = mysqli_num_rows($res);

                if ($count == 1) {
                    $row = mysqli_fetch_assoc($res);
                    $name = $row['product_name'];
                    $current_image = $row['product_img'];
                    $price = $row['product_price'];
                    $featured = $row['product_featured'];
                    $active = $row['product_active'];
                    $slider = $row['slider'];
                } else {
                    $_SESSION["no-product-found"] = "<div class='text-danger'>Không thể tìm thấy sản phẩm</div>";
                    header("location:" . SITEURL . "admin/manage-product/manage-product.php");
                }
            }
        } else {
            header("location:" . SITEURL . "admin/manage-product/manage-product.php");
        }
        ?>
        <form action="" class="w-50" method="POST" enctype="multipart/form-data">
            <div class="form-group row mb-10">
                <label for="name" class="col-4">Tên sản phẩm:</label>
                <input type="text" name="name" value="<?php echo $name; ?>" id="name" class="col-8">
            </div>
            <div class="form-group row mb-10">
                <label for="" class="col-4">Hình ảnh hiện tại:</label>
                <div class="col-8">
                    <?php
                    if ($current_image != "") {
                    ?>
                    <img src="../../assests/images/product/<?php echo $current_image; ?>" width="100px">
                    <?php
                    } else {
                        echo "<div class='text-danger'>Hình ảnh không được thêm vào</div>";
                    }
                    ?>
                </div>
            </div>
            <div class="form-group row mb-10">
                <label for="image" class="col-4">Hình ảnh mới:</label>
                <div class="col-8">
                    <input type="file" name="image" id="image">
                </div>
            </div>
            <div class="form-group row mb-10">
                <label for="price" class="col-4">Giá tiền:</label>
                <input type="number" name="price" value="<?php echo $price; ?>" id="price" class="col-8">
            </div>
            <div class="form-group row mb-10">
                <label for="" class="col-4">Featured:</label>
                <div class="col-8">
                    <input <?php if ($featured == "Yes") {
                                echo "checked";
                            } ?> type="radio" name="featured" value="Yes">Yes
                    <input <?php if ($featured == "No") {
                                echo "checked";
                            } ?> type="radio" name="featured" value="No">No
                </div>
            </div>
            <div class="form-group row mb-10">
                <label for="" class="col-4">Active:</label>
                <div class="col-8">
                    <input <?php if ($active == "Yes") {
                                echo "checked";
                            } ?> type="radio" name="active" value="Yes">Yes
                    <input <?php if ($active == "No") {
                                echo "checked";
                            } ?> type="radio" name="active" value="No">No
                </div>
            </div>
            <div class="form-group row mb-10">
                <label for="" class="col-4">Slider:</label>
                <div class="col-8">
                    <input <?php if ($slider == "Yes") {
                                echo "checked";
                            } ?> type="radio" name="slider" value="Yes">Yes
                    <input <?php if ($slider == "No") {
                                echo "checked";
                            } ?> type="radio" name="slider" value="No">No
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <input class="btn btn-success" type="submit" name="submit" value="Cập nhật">
                </div>
            </div>
        </form>
        <?php
        if (isset($_POST['submit'])) {
            $name = $_POST['name'];
            $price = $_POST['price'];
            $featured = $_POST['featured'];
            $active = $_POST['active'];
            $slider = $_POST['slider'];

            if (isset($_FILES['image']['name'])) {
                $img_name = $_FILES['image']['name'];

                if ($img_name != "") {
                    $tmp = explode(".", $img_name);
                    $ext = end($tmp);

                    $img_name = "Shoes_product_" . rand(000, 999) . '.' . $ext;

                    $src_path = $_FILES["image"]["tmp_name"];
                    $dest_path = "../../assests/images/product/" . $img_name;
                    $upload = move_uploaded_file($src_path, $dest_path);

                    if ($upload == false) {
                        $_SESSION["upload"] = "<div class='text-danger'>Không thể tải hình ảnh lên.</div>";
                        header("location:" . SITEURL . "admin/manage-product/manage-product.php");
                        die();
                    }

                    if ($current_image != "") {
                        $remove_path = "../../assests/images/product/" . $current_image;
                        $remove = unlink($remove_path);

                        if ($remove == false) {
                            $_SESSION["failed-remove"] = "<div class='text-danger mb-10'>Không thể xoá hình ảnh hiện tại.</div>";
                            header("location:" . SITEURL . "admin/manage-product/manage-product.php");
                            die();
                        }
                    }
                } else {
                    $img_name = "";
                }
            } else {
                $img_name = "";
            }

            $new_sql = "UPDATE tbl_product SET
                            product_name = '$name',
                            product_img = '$img_name',
                            product_price = '$price',
                            product_featured = '$featured',
                            product_active = '$active',
                            slider = '$slider'
                            WHERE product_id = '$id'
                ";

            $new_res = mysqli_query($conn, $new_sql);

            if ($new_res == true) {
                $_SESSION["update"] = "<div class='text-primary mb-10'>Cập nhật sản phẩm thành công.</div>";
        ?>
        <script>
        <?php echo ("location.href = '" . SITEURL . "admin/manage-product/manage-product.php';"); ?>
        </script>
        <?php
            } else {
                $_SESSION["update"] = "<div class='text-danger mb-10'>Cập nhật sản phẩm thất bại.</div>";
            ?>
        <script>
        <?php echo ("location.href = '" . SITEURL . "admin/manage-product/manage-product.php';"); ?>
        </script>
        <?php
            }
        }
        ?>
    </div>
</div>

<?php
include('../partials/footer.php');
?>