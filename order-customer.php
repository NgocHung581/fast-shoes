<?php
include_once('./partials-frontend/header.php');
include_once('./partials-frontend/functions.php');
include_once('./partials-frontend/check-login-user.php');
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
                    aria-controls="delivery" aria-selected="false">Đang giao hàng</a>
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
            <?php
            if (isset($_SESSION['user_id'])) {
                $user_id = $_SESSION['user_id'];
            ?>
            <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Mã đơn hàng</th>
                                <th>Ngày đặt</th>
                                <th>Số lượng sản phẩm</th>
                                <th>Trạng thái</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php renderListOrder($conn, $user_id); ?>
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
                                <th>Hủy đơn hàng</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php renderListOrder($conn, $user_id, "Đã đặt hàng"); ?>
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
                                <th>Xác nhận</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php renderListOrder($conn, $user_id, "Đang giao hàng"); ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane fade" id="receive" role="tabpanel" aria-labelledby="receive-tab">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Mã đơn hàng</th>
                                <th>Ngày đặt</th>
                                <th>Số lượng sản phẩm</th>
                                <th>Trạng thái</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php renderListOrder($conn, $user_id, "Đã giao hàng"); ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane fade" id="cancel" role="tabpanel" aria-labelledby="cancel-tab">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Mã đơn hàng</th>
                                <th>Ngày đặt</th>
                                <th>Số lượng sản phẩm</th>
                                <th>Trạng thái</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php renderListOrder($conn, $user_id, "Đã hủy"); ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php
            }
            ?>
        </div>
        <a href="index.php" class="btn btn-primary"><i class="fa-solid fa-arrow-left-long"></i> Trờ lại trang chủ</a>
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
include_once('./partials-frontend/footer.php');
?>