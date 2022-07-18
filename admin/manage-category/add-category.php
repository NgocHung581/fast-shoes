<?php 
include('../partials/header.php');
?>

<div class="main-content">
    <div class="container">
        <h1 class="mb-20">Thêm danh mục</h1>

        <?php
        if(isset($_SESSION["add"])){
            echo $_SESSION["add"];
            unset($_SESSION["add"]);
        }

        if(isset($_SESSION["upload"])){
            echo $_SESSION["upload"];
            unset($_SESSION["upload"]);
        }
        ?>

        <form action="" class="w-50" method="POST" enctype="multipart/form-data">
            <div class="form-group row mb-10">
                <label for="name" class="col-4">Tên danh mục:</label>
                <input type="text" name="name" placeholder="Tên danh mục" id="name" class="col-8">
            </div>
            <div class="form-group row mb-10">
                <label for="image" class="col-4">Chọn hình danh mục:</label>
                <input type="file" name="image" id="image" class="col-8">
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
            <div class="row">
                <div class="col-12">
                    <button type="submit" name="submit" class="btn btn-success">Thêm</button>
                </div>
            </div>
        </form>

        <?php

            if(isset($_POST['submit'])){
                $name= $_POST["name"];

                if(isset($_FILES["image"]["name"])){
                    $img_name = $_FILES["image"]["name"];

                    if($img_name != ""){
                        $ext = end(explode(".", $img_name));
                        $img_name = "Shoes_Category_".rand(000, 999).'.'.$ext;
                        $src_path = $_FILES["image"]["tmp_name"];
                        $dest_path = "../images/category/".$img_name;
                        $upload = move_uploaded_file($src_path, $dest_path);

                        if($upload==false){
                            $_SESSION["upload"] = "<div class='error'>Không thể tải lên hình ảnh</div>";
                            header("location:".SITEURL."admin/manage-category/manage-category.php");
                            die();
                        }
                    } else {
                        $img_name = "";
                    }
                } else{
                    $img_name = "";
                }
               
                if(isset($_POST["featured"])){
                    $featured = $_POST["featured"];
                } else{
                    $featured = "No";
                }

                if(isset($_POST["active"])){
                    $active = $_POST["active"];
                } else{
                    $active = "No";
                }
                
                $sql = "INSERT INTO tbl_category SET
                    category_name='$name',
                    category_img='$img_name',
                    category_featured='$featured',
                    category_active='$active'
                ";
              
                $res = mysqli_query($conn, $sql);

                if($res == true){
                    $_SESSION["add"] = "<div class='text-primary mb-10'>Thêm danh mục thành công.</div>";
                    header("location:".SITEURL."admin/manage-category/manage-category.php");
                }
                else{
                    $_SESSION["add"] = "<div class='text-danger'>Thêm danh mục thất bại.</div>";
                    header("location:".SITEURL."admin/manage-category/add-category.php");
                }
            }
        ?>
    </div>
</div>

<?php 
include('../partials/footer.php');
?>