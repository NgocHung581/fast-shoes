<?php 
include('../partials/header.php');
?>

<div class="main-content">
    <div class="container">

        <h1>Quản lý danh mục</h1>

        <br><br>
        
        <?php
             
            if(isset($_SESSION["add"])){

                echo $_SESSION["add"];

                unset($_SESSION["add"]);

            }

        ?>
    </div>
</div>

<?php 
include('../partials/footer.php');
?>