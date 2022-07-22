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
                                <th>Hủy đơn hàng</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($_SESSION['user_id'])) {
                                $user_id = $_SESSION['user_id'];

                                $sql = "SELECT * FROM tbl_order WHERE customer_id = $user_id";

                                $res = mysqli_query($conn, $sql);

                                if ($res == true) {
                                    $count = mysqli_num_rows($res);
                                    if ($count > 0) {
                                        while ($row = mysqli_fetch_assoc($res)) {
                                            $order_id = $row['order_id'];
                                            $order_date = $row['order_date'];
                                            $order_status = $row['order_status'];
                                            $total_price = $row['total_price'];

                                            $product_name = explode(',', $row['product_name']);
                                            $product_image = explode(',', $row['product_image']);
                                            $product_size = explode(',', $row['product_size']);
                                            $product_price = explode(',', $row['product_price']);

                                            $customer_fullname = $row['customer_fullname'];
                                            $customer_email = $row['customer_email'];
                                            $customer_phone = $row['customer_phone'];
                                            $customer_address = $row['customer_address'];
                                            $product_quantity = explode(',', $row['product_quantity']);
                                            $order_quantity = 0;
                                            foreach ($product_quantity as $item) {
                                                $order_quantity += $item;
                                            }
                            ?>

                            <tr>
                                <!-- Button trigger modal -->
                                <td data-toggle="modal" data-target="#<?php echo "DH" . $order_id; ?>"
                                    class="link-primary text-decoration-underline">
                                    <?php echo "DH" . $order_id; ?>
                                    <!-- Modal -->
                                    <div class="modal fade " id="<?php echo "DH" . $order_id; ?>" tabindex="-1"
                                        role="dialog" aria-labelledby="<?php echo "DH" . $order_id; ?>Title"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl"
                                            role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h2 class="modal-title" id="<?php echo "DH" . $order_id; ?>Title">
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
                                                                    <div class="col-12 col-xl-6 text-dark">
                                                                        Mã đơn hàng:
                                                                        <span
                                                                            class="fw-bold">DH<?php echo $order_id; ?></span>
                                                                    </div>
                                                                    <div class="col-12 col-xl-6 text-dark">
                                                                        Ngày đặt hàng:
                                                                        <span
                                                                            class="fw-bold"><?php echo $order_date; ?></span>
                                                                    </div>
                                                                    <div class="col-12 col-xl-6 text-dark">Khách hàng:
                                                                        <span
                                                                            class="fw-bold"><?php echo $customer_fullname; ?></span>
                                                                    </div>
                                                                    <div class="col-12 col-xl-6 text-dark">
                                                                        Số điện thoại:
                                                                        <span
                                                                            class="fw-bold"><?php echo $customer_phone; ?></span>
                                                                    </div>
                                                                    <div class="col-12 col-xl-6 text-dark">
                                                                        Email:
                                                                        <span
                                                                            class="fw-bold"><?php echo $customer_email; ?></span>
                                                                    </div>
                                                                    <div class="col-12 col-xl-6 text-dark">
                                                                        Địa chỉ:
                                                                        <span
                                                                            class="fw-bold"><?php echo $customer_address; ?></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 text-start">
                                                            <h3>Sản phẩm</h3>
                                                            <p style="font-size: 24px" class="text-dark">
                                                                Tổng tiền: <span
                                                                    class="fw-bold"><?php echo currency_format($total_price, " VND"); ?></span>
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
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <?php
                                                                                        for ($i = 0; $i <=  count($product_name) - 1; $i++) {
                                                                                        ?>
                                                                        <tr>
                                                                            <td colspan="3">
                                                                                <div
                                                                                    class="row align-items-center product">
                                                                                    <div class="col-5">
                                                                                        <img class="img-fluid"
                                                                                            src="./assests/images/product/<?php echo $product_image[$i]; ?>"
                                                                                            alt="" />
                                                                                    </div>
                                                                                    <div class="col-7">
                                                                                        <p class="mb-0">
                                                                                            <?php echo $product_name[$i]; ?>
                                                                                        </p>
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                            <td><?php echo $product_size[$i]; ?>
                                                                            </td>
                                                                            <td><?php echo currency_format($product_price[$i], " VND"); ?>
                                                                            </td>
                                                                            <td><?php echo $product_quantity[$i]; ?>
                                                                            </td>
                                                                            <td><?php echo currency_format($product_price[$i] * $product_quantity[$i], " VND"); ?>
                                                                            </td>
                                                                        </tr>
                                                                        <?php
                                                                                        }
                                                                                        ?>

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
                                <td><?php echo $order_date; ?></td>
                                <td><?php echo $order_quantity; ?></td>
                                <td><?php echo $order_status; ?></td>
                                <td>
                                    <?php
                                                    if ($order_status == "Đã đặt hàng") {
                                                    ?>
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
                                                    <form action="" method="post">
                                                        <button type="submit" name="cancel-submit"
                                                            class="btn btn-primary removeOrder">
                                                            Có
                                                        </button>
                                                    </form>

                                                    <?php
                                                                        if (isset($_POST['cancel-submit'])) {
                                                                            $sql6 = "UPDATE tbl_order SET order_status = 'Đã hủy' WHERE order_id = $order_id";
                                                                            $res6 = mysqli_query($conn, $sql6);
                                                                        }
                                                                        ?>

                                                    <button type="button" class="btn btn-primary" data-dismiss="modal">
                                                        Không
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                                    }
                                                    ?>

                                </td>
                            </tr>

                            <?php
                                        }
                                    } else {
                                        echo '<tr>
                                        <td colspan="5" class="text-danger">Bạn chưa có đơn hàng nào.</td>
                                        </tr>';
                                    }
                                }
                                ?>

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
                            <?php
                                $sql2 = "SELECT * FROM tbl_order WHERE customer_id = $user_id AND order_status = 'Đã đặt hàng'";

                                $res2 = mysqli_query($conn, $sql2);

                                if ($res2 == true) {
                                    $count2 = mysqli_num_rows($res2);
                                    if ($count2 > 0) {
                                        while ($row2 = mysqli_fetch_assoc($res2)) {
                                            $order_id = $row2['order_id'];
                                            $order_date = $row2['order_date'];
                                            $order_status = $row2['order_status'];
                                            $total_price = $row2['total_price'];

                                            $product_name = explode(',', $row2['product_name']);
                                            $product_image = explode(',', $row2['product_image']);
                                            $product_size = explode(',', $row2['product_size']);
                                            $product_price = explode(',', $row2['product_price']);

                                            $customer_fullname = $row2['customer_fullname'];
                                            $customer_email = $row2['customer_email'];
                                            $customer_phone = $row2['customer_phone'];
                                            $customer_address = $row2['customer_address'];
                                            $product_quantity = explode(',', $row2['product_quantity']);
                                            $order_quantity = 0;
                                            foreach ($product_quantity as $item) {
                                                $order_quantity += $item;
                                            }

                            ?>
                            <tr>
                                <!-- Button trigger modal -->
                                <td data-toggle="modal" data-target="#DH<?php echo "DH" . $order_id; ?>Order"
                                    class="link-primary text-decoration-underline">
                                    <?php echo "DH" . $order_id; ?>
                                    <!-- Modal -->
                                    <div class="modal fade" id="DH<?php echo "DH" . $order_id; ?>Order" tabindex="-1"
                                        role="dialog" aria-labelledby="DH<?php echo "DH" . $order_id; ?>OrderTitle"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl"
                                            role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h2 class="modal-title"
                                                        id="DH<?php echo "DH" . $order_id; ?>OrderTitle">
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
                                                                    <div class="col-12 col-xl-6 text-dark">
                                                                        Mã đơn hàng: <span
                                                                            class="fw-bold">DH<?php echo $order_id; ?></span>
                                                                    </div>
                                                                    <div class="col-12 col-xl-6 text-dark">
                                                                        Ngày đặt hàng: <span
                                                                            class="fw-bold"><?php echo $order_date; ?></span>
                                                                    </div>
                                                                    <div class="col-12 col-xl-6 text-dark">Khách hàng:
                                                                        <span
                                                                            class="fw-bold"><?php echo $customer_fullname; ?></span>
                                                                    </div>
                                                                    <div class="col-12 col-xl-6 text-dark">
                                                                        Số điện thoại: <span
                                                                            class="fw-bold"><?php echo $customer_phone; ?></span>
                                                                    </div>
                                                                    <div class="col-12 col-xl-6 text-dark">
                                                                        Email: <span
                                                                            class="fw-bold"><?php echo $customer_email; ?></span>
                                                                    </div>
                                                                    <div class="col-12 col-xl-6 text-dark">
                                                                        Địa chỉ: <span
                                                                            class="fw-bold"><?php echo $customer_address; ?></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 text-start">
                                                            <h3>Sản phẩm</h3>
                                                            <p style="font-size: 24px" class="text-dark">
                                                                Tổng tiền: <span
                                                                    class="fw-bold"><?php echo currency_format($total_price, " VND"); ?></span>
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
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <?php
                                                                                    for ($i = 0; $i <=  count($product_name) - 1; $i++) {
                                                                                    ?>
                                                                        <tr>
                                                                            <td colspan="3">
                                                                                <div
                                                                                    class="row align-items-center product">
                                                                                    <div class="col-5">
                                                                                        <img class="img-fluid"
                                                                                            src="./assests/images/product/<?php echo $product_image[$i]; ?>"
                                                                                            alt="" />
                                                                                    </div>
                                                                                    <div class="col-7">
                                                                                        <p class="mb-0">Nike</p>
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                            <td><?php echo $product_size[$i]; ?></td>
                                                                            <td><?php echo currency_format($product_price[$i], " VND"); ?>
                                                                            </td>
                                                                            <td><?php echo $product_quantity[$i]; ?>
                                                                            </td>
                                                                            <td><?php echo currency_format($product_price[$i] * $product_quantity[$i], " VND"); ?>
                                                                            </td>
                                                                        </tr>
                                                                        <?php
                                                                                    }
                                                                                    ?>
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
                                <td><?php echo $order_date; ?></td>
                                <td><?php echo $order_quantity; ?></td>
                                <td><?php echo $order_status; ?></td>
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
                                                    <form action="" method="post">
                                                        <button type="submit" name="cancel-submit"
                                                            class="btn btn-primary removeOrder">
                                                            Có
                                                        </button>
                                                    </form>

                                                    <?php
                                                                if (isset($_POST['cancel-submit'])) {
                                                                    $sql7 = "UPDATE tbl_order SET order_status = 'Đã hủy' WHERE order_id = $order_id";
                                                                    $res7 = mysqli_query($conn, $sql7);
                                                                }
                                                                ?>
                                                    <button type="button" class="btn btn-primary" data-dismiss="modal">
                                                        Không
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <?php
                                        }
                                    } else {
                                        echo '<tr>
                                        <td colspan="5" class="text-danger">Bạn chưa có đơn hàng nào.</td>
                                        </tr>';
                                    }
                                }
                            ?>



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
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $sql3 = "SELECT * FROM tbl_order WHERE customer_id = $user_id AND order_status = 'Đang giao hàng'";

                                $res3 = mysqli_query($conn, $sql3);

                                if ($res3 == true) {
                                    $count3 = mysqli_num_rows($res3);
                                    if ($count3 > 0) {
                                        while ($row3 = mysqli_fetch_assoc($res3)) {
                                            $order_id = $row3['order_id'];
                                            $order_date = $row3['order_date'];
                                            $order_status = $row3['order_status'];
                                            $total_price = $row3['total_price'];

                                            $product_name = explode(',', $row3['product_name']);
                                            $product_image = explode(',', $row3['product_image']);
                                            $product_size = explode(',', $row3['product_size']);
                                            $product_price = explode(',', $row3['product_price']);

                                            $customer_fullname = $row3['customer_fullname'];
                                            $customer_email = $row3['customer_email'];
                                            $customer_phone = $row3['customer_phone'];
                                            $customer_address = $row3['customer_address'];
                                            $product_quantity = explode(',', $row3['product_quantity']);
                                            $order_quantity = 0;
                                            foreach ($product_quantity as $item) {
                                                $order_quantity += $item;
                                            }
                            ?>
                            <tr>
                                <!-- Button trigger modal -->
                                <td class="link-primary text-decoration-underline" data-toggle="modal"
                                    data-target="#<?php echo "DH" . $order_id; ?>Delivery">
                                    <?php echo "DH" . $order_id; ?>
                                    <!-- Modal -->
                                    <div class="modal fade" id="<?php echo "DH" . $order_id; ?>Delivery" tabindex="-1"
                                        role="dialog" aria-labelledby="<?php echo "DH" . $order_id; ?>DeliveryTitle"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-scrollable modal-xl" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h2 class="modal-title"
                                                        id="<?php echo "DH" . $order_id; ?>DeliveryTitle">
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
                                                                    <div class="col-12 col-xl-6 text-dark">
                                                                        Mã đơn hàng: <span
                                                                            class="fw-bold">DH<?php echo $order_id; ?></span>
                                                                    </div>
                                                                    <div class="col-12 col-xl-6 text-dark">
                                                                        Ngày đặt hàng: <span
                                                                            class="fw-bold"><?php echo $order_date; ?></span>
                                                                    </div>
                                                                    <div class="col-12 col-xl-6 text-dark">Khách hàng:
                                                                        <span
                                                                            class="fw-bold"><?php echo $customer_fullname; ?></span>
                                                                    </div>
                                                                    <div class="col-12 col-xl-6 text-dark">
                                                                        Số điện thoại: <span
                                                                            class="fw-bold"><?php echo $customer_phone; ?></span>
                                                                    </div>
                                                                    <div class="col-12 col-xl-6 text-dark">
                                                                        Email: <span
                                                                            class="fw-bold"><?php echo $customer_email; ?></span>
                                                                    </div>
                                                                    <div class="col-12 col-xl-6 text-dark">
                                                                        Địa chỉ: <span
                                                                            class="fw-bold"><?php echo $customer_address; ?></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 text-start">
                                                            <h3>Sản phẩm</h3>
                                                            <p style="font-size: 24px" class="text-dark">
                                                                Tổng tiền: <span
                                                                    class="fw-bold"><?php echo currency_format($total_price, " VND"); ?></span>
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
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <?php
                                                                                    for ($i = 0; $i <=  count($product_name) - 1; $i++) {
                                                                                    ?>
                                                                        <tr>
                                                                            <td colspan="3">
                                                                                <div
                                                                                    class="row align-items-center product">
                                                                                    <div class="col-5">
                                                                                        <img class="img-fluid"
                                                                                            src="./assests/images/product/<?php echo $product_image[$i]; ?>"
                                                                                            alt="" />
                                                                                    </div>
                                                                                    <div class="col-7">
                                                                                        <p class="mb-0">Nike</p>
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                            <td><?php echo $product_size[$i]; ?></td>
                                                                            <td><?php echo currency_format($product_price[$i], " VND"); ?>
                                                                            </td>
                                                                            <td><?php echo $product_quantity[$i]; ?>
                                                                            </td>
                                                                            <td><?php echo currency_format($product_price[$i] * $product_quantity[$i], " VND"); ?>
                                                                            </td>
                                                                        </tr>
                                                                        <?php
                                                                                    }
                                                                                    ?>
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
                                <td><?php echo $order_date; ?></td>
                                <td><?php echo $order_quantity; ?></td>
                                <td><?php echo $order_status; ?></td>
                                <td></td>
                            </tr>
                            <?php

                                        }
                                    } else {
                                        echo '<tr>
                                        <td colspan="5" class="text-danger">Bạn chưa có đơn hàng nào.</td>
                                        </tr>';
                                    }
                                }
                            ?>

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
                            <?php
                                $sql4 = "SELECT * FROM tbl_order WHERE customer_id = $user_id AND order_status = 'Đã giao hàng'";

                                $res4 = mysqli_query($conn, $sql4);

                                if ($res4 == true) {
                                    $count4 = mysqli_num_rows($res4);
                                    if ($count4 > 0) {
                                        while ($row4 = mysqli_fetch_assoc($res4)) {
                                            $order_id = $row4['order_id'];
                                            $order_date = $row4['order_date'];
                                            $order_status = $row4['order_status'];
                                            $total_price = $row4['total_price'];

                                            $product_name = explode(',', $row4['product_name']);
                                            $product_image = explode(',', $row4['product_image']);
                                            $product_size = explode(',', $row4['product_size']);
                                            $product_price = explode(',', $row4['product_price']);

                                            $customer_fullname = $row4['customer_fullname'];
                                            $customer_email = $row4['customer_email'];
                                            $customer_phone = $row4['customer_phone'];
                                            $customer_address = $row4['customer_address'];
                                            $product_quantity = explode(',', $row4['product_quantity']);
                                            $order_quantity = 0;
                                            foreach ($product_quantity as $item) {
                                                $order_quantity += $item;
                                            }

                            ?>
                            <tr>
                                <td class="link-primary text-decoration-underline" data-bs-toggle="modal"
                                    data-bs-target="#<?php echo "DH" . $order_id; ?>Delivery">
                                    <?php echo "DH" . $order_id; ?>
                                    <!-- Button trigger modal -->


                                    <!-- Modal -->
                                    <div class="modal fade" id="<?php echo "DH" . $order_id; ?>Delivery" tabindex="-1">
                                        <div class="modal-dialog modal-dialog-scrollable modal-xl">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h2 class="modal-title"
                                                        id="<?php echo "DH" . $order_id; ?>DeliveryLabel">Chi tiết đơn
                                                        hàng
                                                    </h2>
                                                    <button type="button" class="btn-close"
                                                        data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-6 mb-3">
                                                            <div class="order__detail-customer text-start">
                                                                <h3>Thông tin khách hàng</h3>
                                                                <div class="row">
                                                                    <div class="col-12 col-xl-6 text-dark">
                                                                        Mã đơn hàng: <span
                                                                            class="fw-bold"><?php echo "DH" . $order_id; ?></span>
                                                                    </div>
                                                                    <div class="col-12 col-xl-6 text-dark">
                                                                        Ngày đặt hàng: <span
                                                                            class="fw-bold"><?php echo $order_date; ?></span>
                                                                    </div>
                                                                    <div class="col-12 col-xl-6 text-dark">Khách hàng:
                                                                        <span
                                                                            class="fw-bold"><?php echo $customer_fullname; ?></span>
                                                                    </div>
                                                                    <div class="col-12 col-xl-6 text-dark">
                                                                        Số điện thoại: <span
                                                                            class="fw-bold"><?php echo $customer_phone; ?></span>
                                                                    </div>
                                                                    <div class="col-12 col-xl-6 text-dark">
                                                                        Email: <span
                                                                            class="fw-bold"><?php echo $customer_email; ?></span>
                                                                    </div>
                                                                    <div class="col-12 col-xl-6 text-dark">
                                                                        Địa chỉ: <span
                                                                            class="fw-bold"><?php echo $customer_address; ?></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 text-start">
                                                            <h3>Sản phẩm</h3>
                                                            <p style="font-size: 24px" class="text-dark">
                                                                Tổng tiền: <span
                                                                    class="fw-bold"><?php echo currency_format($total_price, " VND"); ?></span>
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
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>

                                                                        <?php
                                                                                    for ($i = 0; $i <=  count($product_name) - 1; $i++) {
                                                                                    ?>
                                                                        <tr>
                                                                            <td colspan="3">
                                                                                <div
                                                                                    class="row align-items-center product">
                                                                                    <div class="col-5">
                                                                                        <img class="img-fluid"
                                                                                            src="./assests/images/product/<?php echo $product_image[$i]; ?>"
                                                                                            alt="" />
                                                                                    </div>
                                                                                    <div class="col-7">
                                                                                        <p class="mb-0">Nike</p>
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                            <td><?php echo $product_size[$i]; ?></td>
                                                                            <td><?php echo currency_format($product_price[$i], " VND"); ?>
                                                                            </td>
                                                                            <td><?php echo $product_quantity[$i]; ?>
                                                                            </td>
                                                                            <td><?php echo currency_format($product_price[$i] * $product_quantity[$i], " VND"); ?>
                                                                            </td>
                                                                        </tr>
                                                                        <?php
                                                                                    }
                                                                                    ?>

                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td><?php echo $order_date; ?></td>
                                <td><?php echo $order_quantity; ?></td>
                                <td><?php echo $order_status; ?></td>
                            </tr>
                            <?php
                                        }
                                    } else {
                                        echo '<tr>
                                        <td colspan="5" class="text-danger">Bạn chưa có đơn hàng nào.</td>
                                        </tr>';
                                    }
                                }
                            ?>
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
                            <?php
                                $sql5 = "SELECT * FROM tbl_order WHERE customer_id = $user_id AND order_status = 'Đã hủy'";

                                $res5 = mysqli_query($conn, $sql5);

                                if ($res5 == true) {
                                    $count5 = mysqli_num_rows($res5);
                                    if ($count5 > 0) {
                                        while ($row5 = mysqli_fetch_assoc($res5)) {
                                            $order_id = $row5['order_id'];
                                            $order_date = $row5['order_date'];
                                            $order_status = $row5['order_status'];
                                            $total_price = $row5['total_price'];

                                            $product_name = explode(',', $row5['product_name']);
                                            $product_image = explode(',', $row5['product_image']);
                                            $product_size = explode(',', $row5['product_size']);
                                            $product_price = explode(',', $row5['product_price']);

                                            $customer_fullname = $row5['customer_fullname'];
                                            $customer_email = $row5['customer_email'];
                                            $customer_phone = $row5['customer_phone'];
                                            $customer_address = $row5['customer_address'];
                                            $product_quantity = explode(',', $row5['product_quantity']);
                                            $order_quantity = 0;
                                            foreach ($product_quantity as $item) {
                                                $order_quantity += $item;
                                            }

                            ?>
                            <tr data-bs-toggle="modal" data-bs-target="#<?php echo "DH" . $order_id; ?>Cancel">
                                <td class="link-primary text-decoration-underline"><?php echo "DH" . $order_id; ?>
                                    <!-- Button trigger modal -->


                                    <!-- Modal -->
                                    <div class="modal fade" id="<?php echo "DH" . $order_id; ?>Cancel" tabindex="-1">
                                        <div class="modal-dialog modal-dialog-scrollable modal-xl">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h2 class="modal-title"
                                                        id="<?php echo "DH" . $order_id; ?>CancelLabel">Chi tiết đơn
                                                        hàng
                                                    </h2>
                                                    <button type="button" class="btn-close"
                                                        data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-6 mb-3">
                                                            <div class="order__detail-customer text-start">
                                                                <h3>Thông tin khách hàng</h3>
                                                                <div class="row">
                                                                    <div class="col-12 col-xl-6">
                                                                        Mã đơn hàng: <?php echo "DH" . $order_id; ?>
                                                                    </div>
                                                                    <div class="col-12 col-xl-6">
                                                                        Ngày đặt hàng: <span
                                                                            class="fw-bold"><?php echo $order_date; ?></span>
                                                                    </div>
                                                                    <div class="col-12 col-xl-6">Khách hàng: <span
                                                                            class="fw-bold"><?php echo $customer_fullname; ?></span>
                                                                    </div>
                                                                    <div class="col-12 col-xl-6">
                                                                        Số điện thoại: <span
                                                                            class="fw-bold"><?php echo $customer_phone; ?></span>
                                                                    </div>
                                                                    <div class="col-12 col-xl-6">
                                                                        Email: <span
                                                                            class="fw-bold"><?php echo $customer_email; ?></span>
                                                                    </div>
                                                                    <div class="col-12 col-xl-6">
                                                                        Địa chỉ: <span
                                                                            class="fw-bold"><?php echo $customer_address; ?></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 text-start">
                                                            <h3>Sản phẩm</h3>
                                                            <p style="font-size: 24px" class="text-dark">
                                                                Tổng tiền: <span
                                                                    class="fw-bold"><?php echo currency_format($total_price, " VND"); ?></span>
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
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>

                                                                        <?php
                                                                                    for ($i = 0; $i <=  count($product_name) - 1; $i++) {
                                                                                    ?>
                                                                        <tr>
                                                                            <td colspan="3">
                                                                                <div
                                                                                    class="row align-items-center product">
                                                                                    <div class="col-5">
                                                                                        <img class="img-fluid"
                                                                                            src="./assests/images/product/<?php echo $product_image[$i]; ?>"
                                                                                            alt="" />
                                                                                    </div>
                                                                                    <div class="col-7">
                                                                                        <p class="mb-0">Nike</p>
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                            <td><?php echo $product_size[$i]; ?></td>
                                                                            <td><?php echo currency_format($product_price[$i], " VND"); ?>
                                                                            </td>
                                                                            <td><?php echo $product_quantity[$i]; ?>
                                                                            </td>
                                                                            <td><?php echo currency_format($product_price[$i] * $product_quantity[$i], " VND"); ?>
                                                                            </td>
                                                                        </tr>
                                                                        <?php
                                                                                    }
                                                                                    ?>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td><?php echo $order_date; ?></td>
                                <td><?php echo $order_quantity; ?></td>
                                <td><?php echo $order_status; ?></td>
                            </tr>
                            <?php

                                        }
                                    } else {
                                        echo '<tr>
                                        <td colspan="5" class="text-danger">Bạn chưa có đơn hàng nào.</td>
                                        </tr>';
                                    }
                                }

                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php
                            }
        ?>
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