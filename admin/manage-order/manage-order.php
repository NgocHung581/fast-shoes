<?php
include('../partials/header.php');
?>

<div class="main-content">
    <div class="container">
        <h1 class="mb-20">Quản lý đơn hàng</h1>

        <?php
        if (isset($_SESSION['update'])) {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }
        ?>

        <table class="table align-middle table-striped">
            <thead class="table-info">
                <tr>
                    <th scope="col">STT</th>
                    <th scope="col">Mã đơn hàng</th>
                    <th scope="col">Chi tiết đơn hàng</th>
                    <th scope="col">Tổng tiền</th>
                    <th scope="col">Mã khách hàng</th>
                    <th scope="col">Email</th>
                    <th scope="col">Số điện thoại</th>
                    <th scope="col">Địa chỉ</th>
                    <th scope="col">Trạng thái</th>
                    <th scope="col">Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM tbl_order";

                $res = mysqli_query($conn, $sql);

                if ($res == true) {
                    $count = mysqli_num_rows($res);
                    $stt = 1;

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
                            $product_quantity = explode(',', $row['product_quantity']);

                            $customer_id = $row['customer_id'];
                            $customer_fullname = $row['customer_fullname'];
                            $customer_email = $row['customer_email'];
                            $customer_phone = $row['customer_phone'];
                            $customer_address = $row['customer_address'];
                ?>
                <tr>
                    <th scope="row"><?php echo $stt++; ?></th>
                    <td> <?php echo "DH" . $order_id; ?>
                    </td>
                    <td class="text-decoration-underline text-primary align-middle" style="cursor: pointer;"
                        data-bs-toggle="modal" data-bs-target="#<?php echo "DH" . $order_id; ?>">
                        Ấn để xem
                        chi tiết
                        <!-- Modal -->
                        <div class="modal fade" id="<?php echo "DH" . $order_id; ?>" tabindex="-1"
                            aria-labelledby="<?php echo "DH" . $order_id; ?>Label" aria-hidden="true">
                            <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title text-danger fs-2 fw-bold"
                                            id="<?php echo "DH" . $order_id; ?>Label">Chi tiết
                                            đơn
                                            hàng
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p class="text-dark">Mã đơn hàng: <span
                                                class="fw-bold"><?php echo "DH" . $order_id; ?></span></p>
                                        <p class="text-dark">Ngày đặt: <span
                                                class="fw-bold"><?php echo $order_date; ?></span></p>

                                        <table class="table table-striped align-middle">
                                            <thead class="table-info">
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
                                                <?php
                                                            for ($i = 0; $i <= count($product_name) - 1; $i++) {
                                                            ?>
                                                <tr>
                                                    <th scope="row"><?php echo $i + 1; ?></th>
                                                    <td><?php echo $product_name[$i]; ?></td>
                                                    <td><img src="../../assests/images/product/<?php echo $product_image[$i]; ?>"
                                                            alt="" class="w-25 h-25"></td>
                                                    <td><?php echo currency_format($product_price[$i], " VND"); ?></td>
                                                    <td><?php echo $product_quantity[$i]; ?>
                                                    </td>
                                                    <td><?php echo currency_format($product_price[$i] * $product_quantity[$i], " VND"); ?>
                                                    </td>
                                                </tr>
                                                <?php
                                                            }
                                                            ?>

                                            </tbody>
                                            <tfoot>
                                                <td class="text-end text-danger fw-bold" colspan="6">Tổng tiền:
                                                    <?php echo currency_format($total_price, " VND"); ?></td>
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
                    <td><?php echo currency_format($total_price, " VND"); ?></td>
                    <td>KH<?php echo $customer_id; ?></td>
                    <td><?php echo $customer_email; ?></td>
                    <td><?php echo $customer_phone; ?></td>
                    <td style="max-width: 270px"><?php echo $customer_address; ?></td>
                    <form action="<?php echo SITEURL . 'admin/manage-order/update-order.php' ?>" method="get">
                        <input type="hidden" name="order_id" value="<?php echo $order_id ?>">
                        <td>
                            <select <?php if ($order_status == 'Đang giao hàng' or $order_status == 'Đã giao hàng' or $order_status == 'Đã hủy') {
                                                    echo "disabled";
                                                } ?> class="form-select <?php if ($order_status == 'Đã đặt hàng') {
                                                                            echo 'text-primary';
                                                                        } elseif ($order_status == 'Đang giao hàng') {
                                                                            echo 'text-warning';
                                                                        } elseif ($order_status == 'Đã giao hàng') {
                                                                            echo 'text-success';
                                                                        } else {
                                                                            echo 'text-danger';
                                                                        } ?>" aria-label="Default select example"
                                name='order_status'>
                                <option value="Đã đặt hàng"><?php echo $order_status; ?></option>
                                <option value="Đang giao hàng">Đang giao hàng</option>
                            </select>
                        </td>
                        <td>
                            <?php
                                        if ($order_status == "Đã đặt hàng") {
                                            echo '<button type="submit" style="min-width: 110px;" class="btn btn-primary">Cập nhật</button>';
                                        }
                                        ?>
                        </td>
                    </form>
                </tr>
                <?php
                        }
                    } else {
                        echo '<tr>
                            <td colspan="10">Chưa có đơn hàng nào.</td>
                        </tr>';
                    }
                }

                ?>
            </tbody>
        </table>
    </div>
</div>

<?php
include('../partials/footer.php');
?>