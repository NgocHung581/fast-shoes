<?php
include('../partials/header.php');
?>

<div class="main-content">
    <div class="container">
        <h1 class="mb-20">Thêm sản phẩm</h1>

        <?php
        if (isset($_SESSION["add"])) {
            echo $_SESSION["add"];
            unset($_SESSION["add"]);
        }

        if (isset($_SESSION["upload"])) {
            echo $_SESSION["upload"];
            unset($_SESSION["upload"]);
        }
        ?>

        <form action="" class="w-50" method="POST" enctype="multipart/form-data">
            <div class="form-group row mb-10">
                <label for="name" class="col-4">Tên sản phẩm:</label>
                <input type="text" name="name" placeholder="Tên sản phẩm" id="name" class="col-8">
            </div>
            <div class="form-group row mb-10">
                <label for="price" class="col-4">Giá tiền:</label>
                <input type="number" name="price" placeholder="Giá tiền" id="name" class="col-8">
            </div>
            <div class="form-group row mb-10">
                <label for="image" class="col-4">Chọn hình sản phẩm:</label>
                <input type="file" name="image" id="image" class="col-8">
            </div>
            <div class="form-group row mb-10">
                <label for="category" class="col-4">Danh mục:</label>
                <select name="category" class="col-8">
                    <?php
                    $sql = "SELECT * FROM tbl_category WHERE category_active='Yes'";
                    $res = mysqli_query($conn, $sql);
                    $count = mysqli_num_rows($res);
                    if ($count > 0) {
                        while ($row = mysqli_fetch_assoc($res)) {
                            $id = $row['category_id'];
                            $name = $row['category_name'];
                    ?>
                    <option value=<?php echo $id; ?>><?php echo $name; ?></option>
                    <?php
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="form-group row mb-10">
                <label class="col-4">Featured:</label>
                <div class="col-8">
                    <input type="radio" name="featured" value="Yes">Yes
                    <input type="radio" name="featured" value="No">No
                </div>
            </div>
            <div class="form-group row mb-10">
                <label class="col-4">Active:</label>
                <div class="col-8">
                    <input type="radio" name="active" value="Yes">Yes
                    <input type="radio" name="active" value="No">No
                </div>
            </div>
            <div class="form-group row mb-10">
                <label class="col-4">Slider:</label>
                <div class="col-8">
                    <input type="radio" name="slider" value="Yes">Yes
                    <input type="radio" name="slider" value="No">No
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <button type="submit" name="submit" class="btn btn-success">Thêm</button>
                </div>
            </div>
        </form>

        <?php

        if (isset($_POST['submit'])) {
            $name = $_POST["name"];
            $price = $_POST["price"];
            $category = $_POST["category"];

            if (isset($_FILES["image"]["name"])) {
                $img_name = $_FILES["image"]["name"];

                if ($img_name != "") {
                    $tmp = explode(".", $img_name);
                    $ext = end($tmp);
                    $img_name = "Product_Name_" . rand(000, 999) . '.' . $ext;
                    $src_path = $_FILES["image"]["tmp_name"];
                    $dest_path = "../../assests/images/product/" . $img_name;
                    $upload = move_uploaded_file($src_path, $dest_path);

                    if ($upload == false) {
                        $_SESSION["upload"] = "<div class='text-danger'>Không thể tải lên hình ảnh</div>";
                        header("location:" . SITEURL . "admin/manage-product/manage-product.php");
                        die();
                    }
                } else {
                    $img_name = "";
                }
            } else {
                $img_name = "";
            }

            if (isset($_POST["featured"])) {
                $featured = $_POST["featured"];
            } else {
                $featured = "No";
            }

            if (isset($_POST["active"])) {
                $active = $_POST["active"];
            } else {
                $active = "No";
            }

            if (isset($_POST["slider"])) {
                $slider = $_POST["slider"];
            } else {
                $slider = "No";
            }

            $sql2 = "INSERT INTO tbl_product SET
                    product_name='$name',
                    product_img='$img_name',
                    product_featured='$featured',
                    product_price='$price',
                    product_active='$active',
                    slider='$slider',
                    category_id ='$category'
                ";

            $res2 = mysqli_query($conn, $sql2);

            if ($res2 == true) {
                $_SESSION["add"] = "<div class='text-primary mb-10'>Thêm sản phẩm thành công.</div>";
        ?>
        <script>
        <?php echo ("location.href = '" . SITEURL . "admin/manage-product/manage-product.php';"); ?>
        </script>
        <?php
            } else {
                $_SESSION["add"] = "<div class='text-danger'>Thêm sản phẩm thất bại.</div>";
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