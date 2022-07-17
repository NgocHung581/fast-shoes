<?php

    include('../../config/constants.php');

    if(isset($_GET['id']) AND isset($_GET['img_name'])){

        $id = $_GET['id'];

        $img_name = $_GET['img_name'];

        if($img_name != ""){
            
            $path = "../images/category/".$img_name;

            $remove = unlink($path);

            if($remove == false){

                $_SESSION["remove"] = "<div class='error'>Không thể xóa hình ảnh danh mục</div>";

                header("location:manage-category.php");

                die();

            }
        }
        
        $sql = "DELETE FROM tbl_category WHERE category_id = $id";

        $res = mysqli_query($conn, $sql);

        if($res == true){

            $_SESSION["delete"] = "<div class='success'>Đã xóa danh mục thành công</div>";

            header("location:manage-category.php");

        }
        else{
            
            $_SESSION["delete"] = "<div class='error'>Không thể xóa danh mục</div>";

            header("location:manage-category.php");

        }
    }
    else{

        header('location:manage-category.php');

    }  
?>
