<div class="main-content">
    <div class="wrapper">

        <h1>Thêm danh mục</h1>

        <br><br>
        
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
       
        <br><br>

        <form action="" method="post" enctype="multipart/form-data">

            <table class="tbl-category">

                <tr>
                    <td>Tên danh mục: </td>
                    <td>
                        <input type="text" name="name" placeholder="Tên danh mục">
                    </td>
                </tr>

                <tr>
                    <td>Chọn hình danh mục: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="Yes">Yes
                        <input type="radio" name="featured" value="No">No
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="Yes">Yes
                        <input type="radio" name="active" value="No">No
                    </td>
                </tr>

                <tr>
                    <td>
                        <input class="btn-add-category" type="submit" name="submit" value="Thêm">
                    </td>
                </tr>

            </table>

        </form>

        <?php
        
            require("../config/constants.php");

            if(isset($_POST['submit'])){
                
                $name= $_POST["name"];

                if(isset($_FILES["image"]["name"])){

                    $img_name = $_FILES["image"]["name"];

                    $src_path = $_FILES["image"]["tmp_name"];

                    $dest_path = "../images/category/".$img_name;

                    $upload = move_uploaded_file($src_path, $dest_path);

                    if($upload==false){

                        $_SESSION["upload"] = "<div class='error'>Không thể tải lên hình ảnh</div>";

                        header("location:add-category.php");

                        die();

                    }
                }
                else{
                    $img_name = "";
                }
               
                if(isset($_POST["featured"])){
                    $featured = $_POST["featured"];
                }
                else{
                    $featured = "No";
                }

                if(isset($_POST["active"])){
                    $active = $_POST["active"];
                }
                else{
                    $active = "No";
                }
                
                $sql = "INSERT INTO tbl_category SET
                    category_name='$name',
                    category_img='$img_name',
                    category_featured='$featured',
                    category_active='$active'
                ";
              
                $res = mysqli_query($conn, $sql);

                if($res==true){

                    $_SESSION["add"] = "<div class='success'>Đã thêm danh mục thành công</div>";

                    header("location:manage-category.php");

                }
                else{

                    $_SESSION["add"] = "<div class='error'>Không thể thêm danh mục</div>";

                    header("location:add-category.php");

                }
            }

        ?>

    </div>
</div>

