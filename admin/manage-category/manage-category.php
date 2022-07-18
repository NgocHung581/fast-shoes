<?php 
include('../partials/header.php');
?>

<div class="main-content">
    <div class="container">
        <h1>Quản lý danh mục</h1>
        <?php
             
            if(isset($_SESSION["add"])){

                echo $_SESSION["add"];

                unset($_SESSION["add"]);

            }

            if(isset($_SESSION["remove"])){

                echo $_SESSION["remove"];

                unset($_SESSION["remove"]);

            }

            if(isset($_SESSION["delete"])){

                echo $_SESSION["delete"];

                unset($_SESSION["delete"]);

            }

            if(isset($_SESSION["no-category-found"])){

                echo $_SESSION["no-category-found"];

                unset($_SESSION["no-category-found"]);

            }

            if(isset($_SESSION["update"])){
           
                echo $_SESSION["update"];

                unset($_SESSION["update"]);

            }

            if(isset($_SESSION["upload"])){
           
                echo $_SESSION["upload"];

                unset($_SESSION["upload"]);

            }

            if(isset($_SESSION["failed-remove"])){
           
                echo $_SESSION["failed-remove"];

                unset($_SESSION["failed-remove"]);

            }

        ?>

        <br><br>

        <a href="../manage-category/add-category.php" class="btn btn-success">Thêm danh mục</a>

        <br /><br /><br />

        <table class="w-100">

            <tr>
                <th>S.N.</th>
                <th>Tên danh mục</th>
                <th>Hình ảnh danh mục</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>

            <?php

                $sql = "SELECT * FROM tbl_category";
                
                $res = mysqli_query($conn, $sql);
                 
                $count = mysqli_num_rows($res);

                $sn = 1;

                if($count>0){

                    while($row=mysqli_fetch_assoc($res)){

                        $id = $row['category_id'];
                        $name = $row['category_name'];
                        $img_name = $row['category_img'];
                        $featured = $row['category_featured'];
                        $active = $row['category_active'];
                        
                        ?>

            <tr>

                <td><?php echo $sn++.".";?></td>

                <td><?php echo $name;?></td>

                <td>
                    <?php 
                                    if($img_name!=""){

                                        ?>

                    <img src="../images/category/<?php echo $img_name;?>" width="100px">


                    <?php

                                    }
                                    else{
                                        echo "<div class='error'>Hình ảnh không được thêm vào</div>";
                                    }
                                ?>
                </td>

                <td><?php echo $featured;?></td>

                <td><?php echo $active;?></td>

                <td>
                    <a href="../manage-category/update-category.php?id=<?php echo $id;?>" class="btn btn-primary">Cập
                        nhật
                        danh mục</a>
                    <a href="../manage-category/delete-category.php?id=<?php echo $id;?>&img_name=<?php echo $img_name;?>"
                        class="btn btn-danger">Xóa danh mục</a>
                </td>

            </tr>

            <?php

                    }
                }
                else{

                    ?>

            <tr>
                <td colspan="6">
                    <div class="error">Không có danh mục nào được thêm vào</div>
                </td>
            </tr>

            <?php
                }
                
            ?>

        </table>

    </div>
</div>

<?php 
include('../partials/footer.php');
?>