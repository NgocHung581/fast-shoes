<?php 
include('../partials/header.php');
?>

<div class="main-content">
    <div class="container">

        <br><br><br><br>

        <h1>Cập nhật danh mục</h1>

        <br><br>

        <?php

        if(isset($_GET['id'])){
            
            $id = $_GET['id'];

            $sql = "SELECT * FROM tbl_category WHERE category_id = $id";

            $res = mysqli_query($conn, $sql);

            $count = mysqli_num_rows($res);

            if($count == 1){
                
                $row = mysqli_fetch_assoc($res);

                $name = $row['category_name'];

                $current_image = $row['category_img'];

                $featured = $row['category_featured'];

                $active = $row['category_active'];

            }
            else{

                $_SESSION["no-category-found"] = "<div class='error'>Không thể tìm thấy danh mục</div>";

                header("location:manage-category.php");

            }
        }
        else{
            header('location:manage-category.php');
        }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">
                <tr>
                    <td>Tên danh mục: </td>
                    <td>
                        <input type="text" name="name" value="<?php echo $name;?>">
                    </td>
                </tr>

                <tr>
                    <td>Hình ảnh hiện tại: </td>
                    <td>
                        <?php

                            if($current_image != ""){

                                ?>

                        <img src="../images/category/<?php echo $current_image;?>" width="100px">

                        <?php

                            }
                            else{
                                echo "<div class='error'>Hình ảnh không được thêm vào</div>";
                            }
                            
                        ?>
                    </td>
                </tr>

                <tr>
                    <td>Hình ảnh mới: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td>
                        <input <?php if($featured == "Yes"){echo "checked";}?> type="radio" name="featured"
                            value="Yes">Yes
                        <input <?php if($featured == "No"){echo "checked";}?> type="radio" name="featured" value="No">No
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                        <input <?php if($active == "Yes"){echo "checked";}?> type="radio" name="active" value="Yes">Yes
                        <input <?php if($active == "No"){echo "checked";}?> type="radio" name="active" value="No">No
                    </td>
                </tr>

                <tr>
                    <td>
                        <input class="btn-secondary" type="submit" name="submit" value="Cập nhật danh mục">
                    </td>
                </tr>
            </table>

        </form>

        <?php
            if(isset($_POST['submit'])){
                
                $name = $_POST['name'];
                $featured = $_POST['featured'];
                $active = $_POST['active'];

                if(isset($_FILES['image']['name'])){

                    $img_name = $_FILES['image']['name'];

                    if($img_name != ""){
                        
                        $ext = end(explode(".", $img_name));

                        $img_name = "Shoes_Category_".rand(000, 999).'.'.$ext;

                        $src_path = $_FILES["image"]["tmp_name"];

                        $dest_path = "../images/category/".$img_name;

                        $upload = move_uploaded_file($src_path, $dest_path);

                        if($upload==false){

                            $_SESSION["upload"] = "<div class='error'>Không thể xoá hình ảnh hiện tại</div>";

                            header("location:".SITEURL."admin/manage-category/manage-category.php");

                            die();

                        }

                        if($current_image != ""){

                            $remove_path = "../images/category/".$current_image;

                            $remove = unlink($remove_path);
    
                            if($remove == false){
    
                                $_SESSION["failed-remove"] = "<div class='error'>Không thể tải lên hình ảnh</div>";
    
                                header("location:".SITEURL."admin/manage-category/manage-category.php");
    
                                die();
    
                            }
                        }
                        
                        else{

                        }
                    }
                    else{
                        $img_name = "";
                    }

                }
                else{

                }

                $new_sql = "UPDATE tbl_category SET
                            category_name = '$name',
                            category_img = '$img_name',
                            category_featured = '$featured',
                            category_active = '$active'
                            WHERE category_id = '$id'
                "; 

                $new_res = mysqli_query($conn, $new_sql);

                if($new_res == true){

                    $_SESSION["update"] = "<div class='success'>Cập nhật danh mục thành công</div>";

                    header("location:".SITEURL."admin/manage-category/manage-category.php");

                }
                else{
                    
                    $_SESSION["update"] = "<div class='error'>Không thể cập nhật danh mục</div>";

                    header("location:".SITEURL."admin/manage-category/manage-category.php");

                }
            }
        ?>

    </div>
</div>

<?php 
include('../partials/footer.php');
?>