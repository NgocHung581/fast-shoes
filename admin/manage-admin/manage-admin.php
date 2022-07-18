<?php 
include('../partials/header.php');
?>

<div class="main-content">
    <div class="container">
        <h1 class="mb-20">Quản lý người dùng</h1>

        <?php 
            if(isset($_SESSION['add'])) {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }

            if(isset($_SESSION['delete'])) {
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
            }

            if(isset($_SESSION['update'])) {
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }
        ?>

        <a href="add-admin.php" class="btn btn-success mb-20">Thêm admin</a>
        <table class="w-100">
            <tr>
                <th>STT</th>
                <th>Họ và tên</th>
                <th>Username</th>
                <th>Hành động</th>

                <?php 
                    $sql = "SELECT * FROM tbl_user WHERE type = 'admin'";

                    $res = mysqli_query($conn, $sql);

                    if($res == true) {
                        $count = mysqli_num_rows($res);
                        $stt = 1;

                        if($count > 0) {
                            while($row = mysqli_fetch_assoc($res)) {
                                $id = $row['user_id'];
                                $fullname = $row['fullname'];
                                $username = $row['username'];
                                $type = $row['type'];

                                echo '</tr> 
                                        <td>'.$stt++.'</td>
                                        <td>'.$fullname.'</td>
                                        <td>'.$username.'</td>
                                        <td>
                                            <a href="'.SITEURL.'admin/manage-admin/delete-admin.php?id='.$id.'" class="btn btn-danger">Xóa</a>
                                            <a href="'.SITEURL.'admin/manage-admin/update-admin.php?id='.$id.'" class="btn btn-primary">Cập nhật</a>
                                        </td>
                                    </tr>';
                            }
                        } else {
                            echo '</tr> 
                                    <td colspan="5"><div class="text-danger">Chưa có Admin nào được thêm vào.</div></td>
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