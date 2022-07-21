<?php
include('../partials/header.php');
?>

<div class="main-content">
    <div class="container">
        <h1 class="mb-20">Quản lý liên hệ</h1>
        <table class="table align-middle">
            <thead class="table-info">
                <tr>
                    <th scope="col">STT</th>
                    <th scope="col">Họ và tên khách hàng</th>
                    <th scope="col">Email</th>
                    <th scope="col">Số diện thoại</th>
                    <th scope="col">Nội dung</th>
                    <th scope="col">Trạng thái</th>
                    <th scope="col">Hành động</th>
                </tr>
            </thead>
                
            <?php

                $sql = "SELECT * FROM tbl_contact";
                $res = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($res);
                $sn = 1;

                if ($count > 0) {
                    while ($row = mysqli_fetch_assoc($res)) {

                        $username = $row['contact_username'];
                        $email = $row['contact_email'];
                        $tel = $row['contact_tel'];
                        $description = $row['contact_description'];
                                                
                        ?>
                        <tbody>
                        <tr>
                            <td scope="row"><?php echo $sn++;?></td>
                            <td><?php echo $username;?></td>
                            <td><?php echo $email;?></td>
                            <td><?php echo $tel;?></td>
                            <td style="max-width: 570px;"><?php echo $description;?></td>
                            <td class="text-danger">Chưa phản hồi</td>
                            <td>
                                <a href="#" class="btn btn-primary">Cập nhật</a>
                            </td>
                        </tr>
                        </tbody>
                        <?php
                    }
                }
                else{
                    echo '<tr>
                    <td colspan="7">
                        <div class="text-danger">Không có liên hệ</div>
                    </td>
                </tr>';
                }
            ?>
        </table>
    </div>
</div>

<?php
include('../partials/footer.php');
?>