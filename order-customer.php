<?php
include('./config/constants.php');
include('./partials-frontend/check-login-user.php');
?>

<?php
include('./partials-frontend/header.php');
?>

<section class="order__customer">
    <div class="container order__mobile">
        <h2>Đơn hàng của bạn</h2>
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="all-tab" data-toggle="tab" href="#all" role="tab" aria-controls="all"
                    aria-selected="true">Tất cả</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="order-tab" data-toggle="tab" href="#order" role="tab" aria-controls="order"
                    aria-selected="false">Đã đặt hàng</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="delivery-tab" data-toggle="tab" href="#delivery" role="tab"
                    aria-controls="delivery" aria-selected="false">Chờ giao hàng</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="receive-tab" data-toggle="tab" href="#receive" role="tab"
                    aria-controls="receive" aria-selected="false">Đã giao hàng</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="cancel-tab" data-toggle="tab" href="#cancel" role="tab" aria-controls="cancel"
                    aria-selected="false">Đã hủy</a>
            </li>
        </ul>
        <div class="tab-content content__tab" id="myTabContent">
            <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Mã đơn hàng</th>
                                <th>Ngày đặt</th>
                                <th>Số lượng sản phẩm</th>
                                <th>Trạng thái</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <!-- Button trigger modal -->
                                <td data-toggle="modal" data-target="#DH01234">
                                    DH01234
                                    <!-- Modal -->
                                    <div class="modal fade " id="DH01234" tabindex="-1" role="dialog"
                                        aria-labelledby="DH01234Title" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-scrollable modal-xl" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h2 class="modal-title" id="DH01234Title">
                                                        Chi tiết đơn hàng
                                                    </h2>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-6 mb-3">
                                                            <div class="order__detail-customer text-start">
                                                                <h3>Thông tin khách hàng</h3>
                                                                <div class="row">
                                                                    <div class="col-12 col-xl-6 ">
                                                                        Mã đơn hàng: ĐH01234
                                                                    </div>
                                                                    <div class="col-12 col-xl-6 ">
                                                                        Ngày đặt hàng: 17/07/2022
                                                                    </div>
                                                                    <div class="col-12 col-xl-6 ">Khách hàng: PHD</div>
                                                                    <div class="col-12 col-xl-6 ">
                                                                        Số điện thoại: 01234567
                                                                    </div>
                                                                    <div class="col-12 col-xl-6 ">
                                                                        Email: abc@gmail.com
                                                                    </div>
                                                                    <div class="col-12 col-xl-6 ">
                                                                        Địa chỉ: 68 Đặng Thùy Trâm
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 text-start">
                                                            <h3>Sản phẩm</h3>
                                                            <p style="font-size: 24px">
                                                                Tổng tiền: 1.200.000 <sup>₫</sup>
                                                            </p>
                                                            <div class="table-responsive">
                                                                <table class="table table-hover">
                                                                    <thead>
                                                                        <tr>
                                                                            <th class="text-center" colspan="3">
                                                                                Sản phẩm
                                                                            </th>
                                                                            <th>Size</th>
                                                                            <th>Giá tiền</th>
                                                                            <th>Số lượng</th>
                                                                            <th>Thành tiền</th>
                                                                            <th>Trạng thái</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td colspan="3">
                                                                                <div
                                                                                    class="row align-items-center product">
                                                                                    <div class="col-5">
                                                                                        <img class="img-fluid"
                                                                                            src="./assests/images/product/nike.webp"
                                                                                            alt="" />
                                                                                    </div>
                                                                                    <div class="col-7">
                                                                                        <p class="mb-0">Nike</p>
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                            <td>35</td>
                                                                            <td>1.200.000 <sup>₫</sup></td>
                                                                            <td>1</td>
                                                                            <td>1.200.000 <sup>₫</sup></td>
                                                                            <td>Đã đặt hàng</td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer"></div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>17/07/2022</td>
                                <td>1</td>
                                <td>Đã đặt hàng</td>
                                <td>
                                    <!-- Button trigger modal -->
                                    <i data-toggle="modal" data-target="#cancelModal" class="fa fa-times"></i>

                                    <!-- Modal -->
                                    <div class="modal fade" id="cancelModal" tabindex="-1" role="dialog"
                                        aria-labelledby="cancelModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-sm" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title" id="cancelModalLabel">
                                                        Hủy hóa đơn
                                                    </h4>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true"><i class="fa fa-times"></i></span>
                                                    </button>
                                                </div>
                                                <div class="modal-body text-start fw-bold">
                                                    Bạn có chắc hủy hóa đơn không?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-primary removeOrder">
                                                        Có
                                                    </button>
                                                    <button type="button" class="btn btn-primary" data-dismiss="modal">
                                                        Không
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <!-- Button trigger modal -->
                                <td data-toggle="modal" data-target="#DH04321">
                                    DH04321
                                    <!-- Modal -->
                                    <div class="modal fade" id="DH04321" tabindex="-1" role="dialog"
                                        aria-labelledby="DH04321Title" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-scrollable modal-xl" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h2 class="modal-title" id="DH04321Title">
                                                        Chi tiết đơn hàng
                                                    </h2>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-6 mb-3">
                                                            <div class="order__detail-customer text-start">
                                                                <h3>Thông tin khách hàng</h3>
                                                                <div class="row">
                                                                    <div class="col-12 col-xl-6">
                                                                        Mã đơn hàng: DH04321
                                                                    </div>
                                                                    <div class="col-12 col-xl-6">
                                                                        Ngày đặt hàng: 16/07/2022
                                                                    </div>
                                                                    <div class="col-12 col-xl-6">Khách hàng: DHP</div>
                                                                    <div class="col-12 col-xl-6">
                                                                        Số điện thoại: 0387482374
                                                                    </div>
                                                                    <div class="col-12 col-xl-6">
                                                                        Email: xyz@gmail.com
                                                                    </div>
                                                                    <div class="col-12 col-xl-6">
                                                                        Địa chỉ: 68 Đặng Thùy Trâm
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 text-start">
                                                            <h3>Sản phẩm</h3>
                                                            <p style="font-size: 24px">
                                                                Tổng tiền: 2.400.000 <sup>₫</sup>
                                                            </p>
                                                            <div class="table-responsive">
                                                                <table class="table table-hover">
                                                                    <thead>
                                                                        <tr>
                                                                            <th class="text-center" colspan="3">
                                                                                Sản phẩm
                                                                            </th>
                                                                            <th>Size</th>
                                                                            <th>Giá tiền</th>
                                                                            <th>Số lượng</th>
                                                                            <th>Thành tiền</th>
                                                                            <th>Trạng thái</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td colspan="3">
                                                                                <div
                                                                                    class="row align-items-center product">
                                                                                    <div class="col-5">
                                                                                        <img class="img-fluid"
                                                                                            src="./assests/images/product/nike.webp"
                                                                                            alt="" />
                                                                                    </div>
                                                                                    <div class="col-7">
                                                                                        <p class="mb-0">Nike</p>
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                            <td>35</td>
                                                                            <td>1.200.000 <sup>₫</sup></td>
                                                                            <td>1</td>
                                                                            <td>1.200.000 <sup>₫</sup></td>
                                                                            <td>Chờ giao hàng</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td colspan="3">
                                                                                <div
                                                                                    class="row align-items-center product">
                                                                                    <div class="col-5">
                                                                                        <img class="img-fluid"
                                                                                            src="./assests/images/product/nike.webp"
                                                                                            alt="" />
                                                                                    </div>
                                                                                    <div class="col-7">
                                                                                        <p class="mb-0">Adidas</p>
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                            <td>35</td>
                                                                            <td>1.200.000 <sup>₫</sup></td>
                                                                            <td>1</td>
                                                                            <td>1.200.000 <sup>₫</sup></td>
                                                                            <td>Chờ giao hàng</td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer"></div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>16/07/2022</td>
                                <td>2</td>
                                <td>Chờ giao hàng</td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane fade" id="order" role="tabpanel" aria-labelledby="order-tab">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Mã đơn hàng</th>
                                <th>Ngày đặt</th>
                                <th>Số lượng sản phẩm</th>
                                <th>Trạng thái</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <!-- Button trigger modal -->
                                <td data-toggle="modal" data-target="#DH01234Order">
                                    DH01234
                                    <!-- Modal -->
                                    <div class="modal fade" id="DH01234Order" tabindex="-1" role="dialog"
                                        aria-labelledby="DH01234OrderTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-scrollable modal-xl" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h2 class="modal-title" id="DH01234OrderTitle">
                                                        Chi tiết đơn hàng
                                                    </h2>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-6 mb-3">
                                                            <div class="order__detail-customer text-start">
                                                                <h3>Thông tin khách hàng</h3>
                                                                <div class="row">
                                                                    <div class="col-12 col-xl-6">
                                                                        Mã đơn hàng: ĐH01234
                                                                    </div>
                                                                    <div class="col-12 col-xl-6">
                                                                        Ngày đặt hàng: 17/07/2022
                                                                    </div>
                                                                    <div class="col-12 col-xl-6">Khách hàng: PHD</div>
                                                                    <div class="col-12 col-xl-6">
                                                                        Số điện thoại: 01234567
                                                                    </div>
                                                                    <div class="col-12 col-xl-6">
                                                                        Email: abc@gmail.com
                                                                    </div>
                                                                    <div class="col-12 col-xl-6">
                                                                        Địa chỉ: 68 Đặng Thùy Trâm
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 text-start">
                                                            <h3>Sản phẩm</h3>
                                                            <p style="font-size: 24px">
                                                                Tổng tiền: 1.200.000 <sup>₫</sup>
                                                            </p>
                                                            <div class="table-responsive">
                                                                <table class="table table-hover">
                                                                    <thead>
                                                                        <tr>
                                                                            <th class="text-center" colspan="3">
                                                                                Sản phẩm
                                                                            </th>
                                                                            <th>Size</th>
                                                                            <th>Giá tiền</th>
                                                                            <th>Số lượng</th>
                                                                            <th>Thành tiền</th>
                                                                            <th>Trạng thái</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td colspan="3">
                                                                                <div
                                                                                    class="row align-items-center product">
                                                                                    <div class="col-5">
                                                                                        <img class="img-fluid"
                                                                                            src="./assests/images/product/nike.webp"
                                                                                            alt="" />
                                                                                    </div>
                                                                                    <div class="col-7">
                                                                                        <p class="mb-0">Nike</p>
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                            <td>35</td>
                                                                            <td>1.200.000 <sup>₫</sup></td>
                                                                            <td>1</td>
                                                                            <td>1.200.000 <sup>₫</sup></td>
                                                                            <td>Đã đặt hàng</td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer"></div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>17/07/2022</td>
                                <td>1</td>
                                <td>Đã đặt hàng</td>
                                <td>
                                    <!-- Button trigger modal -->
                                    <i data-toggle="modal" data-target="#cancelModalOrder" class="fa fa-times"></i>

                                    <!-- Modal -->
                                    <div class="modal fade" id="cancelModalOrder" tabindex="-1" role="dialog"
                                        aria-labelledby="cancelModalOrderLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-sm" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title" id="cancelModalOrderLabel">
                                                        Hủy hóa đơn
                                                    </h4>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body text-start fw-bold">
                                                    Bạn có chắc hủy hóa đơn không?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-primary removeOrder">
                                                        Có
                                                    </button>
                                                    <button type="button" class="btn btn-primary" data-dismiss="modal">
                                                        Không
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane fade" id="delivery" role="tabpanel" aria-labelledby="delivery-tab">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Mã đơn hàng</th>
                                <th>Ngày đặt</th>
                                <th>Số lượng sản phẩm</th>
                                <th>Trạng thái</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <!-- Button trigger modal -->
                                <td data-toggle="modal" data-target="#DH04321Delivery">
                                    DH04321
                                    <!-- Modal -->
                                    <div class="modal fade" id="DH04321Delivery" tabindex="-1" role="dialog"
                                        aria-labelledby="DH04321DeliveryTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-scrollable modal-xl" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h2 class="modal-title" id="DH04321DeliveryTitle">
                                                        Chi tiết đơn hàng
                                                    </h2>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-6 mb-3">
                                                            <div class="order__detail-customer text-start">
                                                                <h3>Thông tin khách hàng</h3>
                                                                <div class="row">
                                                                    <div class="col-12 col-xl-6">
                                                                        Mã đơn hàng: DH04321
                                                                    </div>
                                                                    <div class="col-12 col-xl-6">
                                                                        Ngày đặt hàng: 16/07/2022
                                                                    </div>
                                                                    <div class="col-12 col-xl-6">Khách hàng: DHP</div>
                                                                    <div class="col-12 col-xl-6">
                                                                        Số điện thoại: 0387482374
                                                                    </div>
                                                                    <div class="col-12 col-xl-6">
                                                                        Email: xyz@gmail.com
                                                                    </div>
                                                                    <div class="col-12 col-xl-6">
                                                                        Địa chỉ: 68 Đặng Thùy Trâm
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 text-start">
                                                            <h3>Sản phẩm</h3>
                                                            <p style="font-size: 24px">
                                                                Tổng tiền: 2.400.000 <sup>₫</sup>
                                                            </p>
                                                            <div class="table-responsive">
                                                                <table class="table table-hover">
                                                                    <thead>
                                                                        <tr>
                                                                            <th class="text-center" colspan="3">
                                                                                Sản phẩm
                                                                            </th>
                                                                            <th>Size</th>
                                                                            <th>Giá tiền</th>
                                                                            <th>Số lượng</th>
                                                                            <th>Thành tiền</th>
                                                                            <th>Trạng thái</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td colspan="3">
                                                                                <div
                                                                                    class="row align-items-center product">
                                                                                    <div class="col-5">
                                                                                        <img class="img-fluid"
                                                                                            src="./assests/images/product/nike.webp"
                                                                                            alt="" />
                                                                                    </div>
                                                                                    <div class="col-7">
                                                                                        <p class="mb-0">Nike</p>
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                            <td>35</td>
                                                                            <td>1.200.000 <sup>₫</sup></td>
                                                                            <td>1</td>
                                                                            <td>1.200.000 <sup>₫</sup></td>
                                                                            <td>Chờ giao hàng</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td colspan="3">
                                                                                <div
                                                                                    class="row align-items-center product">
                                                                                    <div class="col-5">
                                                                                        <img class="img-fluid"
                                                                                            src="./assests/images/product/nike.webp"
                                                                                            alt="" />
                                                                                    </div>
                                                                                    <div class="col-7">
                                                                                        <p class="mb-0">Adidas</p>
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                            <td>35</td>
                                                                            <td>1.200.000 <sup>₫</sup></td>
                                                                            <td>1</td>
                                                                            <td>1.200.000 <sup>₫</sup></td>
                                                                            <td>Chờ giao hàng</td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer"></div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>16/07/2022</td>
                                <td>2</td>
                                <td>Chờ giao hàng</td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane fade" id="receive" role="tabpanel" aria-labelledby="receive-tab">
                <div class="midde__content">
                    <h3>Bạn vẫn chưa có đơn hàng</h3>
                    <a href="./product.html" class="btn btn-primary">Tiếp tục mua hàng</a>
                </div>
            </div>
            <div class="tab-pane fade" id="cancel" role="tabpanel" aria-labelledby="cancel-tab">
                <div class="midde__content">
                    <h3>Bạn vẫn chưa có đơn hàng</h3>
                    <a href="./product.html" class="btn btn-primary">Tiếp tục mua hàng</a>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
</script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
</script>

<?php
include('./partials-frontend/footer.php');
?>