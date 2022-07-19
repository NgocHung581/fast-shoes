<?php
include('../partials/header.php');
?>

<div class="main-content">
    <div class="container">
        <h1 class="mb-20">Quản lý khách hàng</h1>

        <table class="table">
            <tr class="table-info">
                <th>STT</th>
                <th>Mã khách hàng</th>
                <th>Họ và tên</th>
                <th>Username</th>
                <th>Số lần mua tại cửa hàng</th>

                <?php
                $sql = "SELECT * FROM tbl_user WHERE type = 'user'";

                $res = mysqli_query($conn, $sql);

                if ($res == true) {
                    $count = mysqli_num_rows($res);
                    $stt = 1;

                    if ($count > 0) {
                        while ($row = mysqli_fetch_assoc($res)) {
                            $id = $row['user_id'];
                            $fullname = $row['fullname'];
                            $username = $row['username'];

                            echo '</tr> 
                                        <td>' . $stt++ . '</td>
                                        <td>KH' . $id . '</td>
                                        <td>' . $fullname . '</td>
                                        <td>' . $username . '</td>
                                        <td>2</td>
                                    </tr>';
                        }
                        echo '<tr class="table-info">
                            <td colspan="5"><div class="text-primary text-end fw-bold fs-4">Hiện tại đang có ' . $count . ' khách hàng</div></td>
                        </tr>';
                    } else {
                        echo '</tr> 
                                    <td colspan="5"><div class="text-danger">Chưa có khách hàng.</div></td>
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