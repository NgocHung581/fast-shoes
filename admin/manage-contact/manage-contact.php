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
            <tbody>
                <tr>
                    <td scope="row">1</td>
                    <td>Huỳnh Ngọc Hùng</td>
                    <td>email@gmail.com</td>
                    <td>012345789</td>
                    <td style="max-width: 570px;">Đây là nội dung.</td>
                    <td class="text-danger">Chưa phản hồi</td>
                    <td>
                        <a href="#" class="btn btn-primary">Cập nhật</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<?php
include('../partials/footer.php');
?>