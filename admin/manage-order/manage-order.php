<?php
include('../partials/header.php');
?>

<div class="main-content">
    <div class="container">
        <h1 class="mb-20">Quản lý đơn hàng</h1>

        <table class="table align-middle table-striped">
            <thead class="table-info">
                <tr>
                    <th scope="col">STT</th>
                    <th scope="col">Ngày đặt</th>
                    <th scope="col">Trạng thái</th>
                    <th scope="col">Chi tiết đơn hàng</th>
                    <th scope="col">Tổng tiền</th>
                    <th scope="col">Mã khách hàng</th>
                    <th scope="col">Email</th>
                    <th scope="col">Số điện thoại</th>
                    <th scope="col">Địa chỉ</th>
                    <th scope="col">Hành động</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>20/7/2022</td>
                    <td class="text-primary">Đã đặt hàng</td>
                    <td class="text-decoration-underline text-primary align-middle" style="cursor: pointer;"
                        data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Ấn để xem
                        chi tiết
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Chi tiết đơn hàng</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <table class="table table-striped align-middle">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Tên sản phẩm</th>
                                                    <th scope="col">Hình ảnh</th>
                                                    <th scope="col">Đơn giá</th>
                                                    <th scope="col">Số lượng</th>
                                                    <th scope="col">Thành tiền</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th scope="row">1</th>
                                                    <td>Nike</td>
                                                    <td><img src="../../assests/images/product/nike.webp" alt=""
                                                            class="w-25 h-25"></td>
                                                    <td>1.200.000 VNĐ</td>
                                                    <td>1</td>
                                                    <td>1.200.000 VNĐ</td>
                                                </tr>

                                            </tbody>
                                            <tfoot>
                                                <td class="text-end text-danger fw-bold" colspan="6">Tổng tiền:
                                                    1.200.000 VNĐ</td>
                                            </tfoot>
                                        </table>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary"
                                            data-bs-dismiss="modal">Đóng</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td>2.000.000 VNĐ</td>
                    <td>KH1</td>
                    <td>email@gmail.com</td>
                    <td>012345789</td>
                    <td style="max-width: 270px">Thành phố hồ chí minh</td>
                    <td>
                        <a class="btn btn-primary" href="update-order.php">Cập nhật</a>
                    </td>
                </tr>

            </tbody>
        </table>
    </div>
</div>

<?php
include('../partials/footer.php');
?>