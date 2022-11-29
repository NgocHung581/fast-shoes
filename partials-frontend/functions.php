<?php
function addToCart($conn)
{
    $user_id = $_POST['user_id'];
    $product_id = $_POST['product_id'];

    $sql_first = "SELECT * FROM tbl_product WHERE product_id = $product_id";
    $res_first = mysqli_query($conn, $sql_first);
    if ($res_first == true) {
        $count_first = mysqli_num_rows($res_first);
        if ($count_first == 1) {
            $row = mysqli_fetch_assoc($res_first);
            $product_name = $row['product_name'];
            $product_image = $row['product_img'];
            $product_price = $row['product_price'];

            $sql_second = "SELECT * FROM tbl_cart WHERE user_id = $user_id AND product_id = $product_id";
            $res_second = mysqli_query($conn, $sql_second);
            if ($res_second == true) {
                $count_second = mysqli_num_rows($res_second);
                if ($count_second > 0) {
                    $sql_third = "UPDATE tbl_cart SET product_quantity = product_quantity + 1 WHERE user_id = $user_id AND product_id = $product_id";
                } else {
                    $sql_third = "INSERT INTO tbl_cart SET
                                product_id = '$product_id',
                                product_name = '$product_name',
                                product_image = '$product_image',
                                product_price = '$product_price',
                                user_id = '$user_id'
                                ";
                }
            }
            $res_third = mysqli_query($conn, $sql_third);
            if ($res_third == true) {
                $_SESSION['cart-user-id'] = $user_id;
?>
<script>
<?php echo ("location.href = '" . SITEURL . "cart.php';"); ?>
</script>
<?php
            }
        }
    }
}

function renderListOrder($conn, $user_id, $status = "")
{
    $where = "";
    if ($status) {
        $where .= " AND order_status = '$status'";
    }

    $sql_order = "SELECT * FROM tbl_order WHERE customer_id = $user_id" . $where;
    $res_order = mysqli_query($conn, $sql_order);
    if ($res_order == true) {
        $count_order = mysqli_num_rows($res_order);
        if ($count_order > 0) {
            while ($row_order = mysqli_fetch_assoc($res_order)) {
                $order_id = $row_order['order_id'];
                $order_date = $row_order['order_date'];
                $order_status = $row_order['order_status'];
                $total_price = $row_order['total_price'];

                $product_name = explode(',', $row_order['product_name']);
                $product_image = explode(',', $row_order['product_image']);
                $product_size = explode(',', $row_order['product_size']);
                $product_price = explode(',', $row_order['product_price']);

                $customer_fullname = $row_order['customer_fullname'];
                $customer_email = $row_order['customer_email'];
                $customer_phone = $row_order['customer_phone'];
                $customer_address = $row_order['customer_address'];
                $product_quantity = explode(',', $row_order['product_quantity']);
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
        <div class="modal fade" id="DH<?php echo "DH" . $order_id; ?>Order" tabindex="-1" role="dialog"
            aria-labelledby="DH<?php echo "DH" . $order_id; ?>OrderTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title" id="DH<?php echo "DH" . $order_id; ?>OrderTitle">
                            Chi tiết đơn hàng
                        </h2>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12 mb-3">
                                <div class="order__detail-customer text-start">
                                    <h3>Thông tin khách hàng</h3>
                                    <div class="row">
                                        <div class="col-12 col-lg-6 text-dark">
                                            Mã đơn hàng: <span class="fw-bold">DH<?php echo $order_id; ?></span>
                                        </div>
                                        <div class="col-12 col-lg-6 text-dark">
                                            Ngày đặt hàng: <span class="fw-bold"><?php echo $order_date; ?></span>
                                        </div>
                                        <div class="col-12 col-lg-6 text-dark">Khách hàng:
                                            <span class="fw-bold"><?php echo $customer_fullname; ?></span>
                                        </div>
                                        <div class="col-12 col-lg-6 text-dark">
                                            Số điện thoại: <span class="fw-bold"><?php echo $customer_phone; ?></span>
                                        </div>
                                        <div class="col-12 col-lg-6 text-dark">
                                            Email: <span class="fw-bold"><?php echo $customer_email; ?></span>
                                        </div>
                                        <div class="col-12 col-lg-6 text-dark">
                                            Địa chỉ: <span class="fw-bold"><?php echo $customer_address; ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 text-start">
                                <h3>Sản phẩm</h3>
                                <p style="font-size: 24px" class="text-dark">
                                    Tổng tiền: <span class="fw-bold"><?php echo currency_format($total_price); ?></span>
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
                                                    <div class="row align-items-center">
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
                                                <td><?php echo currency_format($product_price[$i]); ?>
                                                </td>
                                                <td><?php echo $product_quantity[$i]; ?>
                                                </td>
                                                <td><?php echo currency_format($product_price[$i] * $product_quantity[$i]); ?>
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
                        if ($status == "") {
                            if ($order_status == "Đang giao hàng") {
                        ?>
        <form action="<?php echo SITEURL . 'admin/manage-order/update-order.php'; ?>" method="get">
            <button class="btn btn-primary" type="submit" name="confirm-submit">Đã giao
                hàng</button>
            <input type="hidden" name="order_id" value="<?php echo $order_id; ?>">
        </form>
        <?php
                            }

                            if ($order_status == "Đã đặt hàng") {
                            ?>
        <!-- Button trigger modal -->
        <i data-toggle="modal" data-target="#cancelModal-<?php echo $order_id; ?>" class="fa fa-times"></i>

        <!-- Modal -->
        <div class="modal fade" id="cancelModal-<?php echo $order_id; ?>" tabindex="-1" role="dialog"
            aria-labelledby="cancelModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="cancelModalLabel">
                            Hủy hóa đơn
                        </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"><i class="fa fa-times"></i></span>
                        </button>
                    </div>
                    <div class="modal-body text-start fw-bold">
                        Bạn có chắc hủy hóa đơn không?
                    </div>
                    <div class="modal-footer">
                        <form action="<?php echo SITEURL . 'admin/manage-order/update-order.php'; ?>" method="GET">
                            <input type="hidden" name="order_id" value="<?php echo $order_id; ?>">
                            <button type="submit" name="cancel-submit" class="btn btn-primary removeOrder">
                                Có
                            </button>
                        </form>

                        <button type="button" class="btn btn-primary" data-dismiss="modal">
                            Không
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <?php
                            }
                        } elseif ($status == "Đã đặt hàng") {
                            ?>
        <!-- Button trigger modal -->
        <i data-toggle="modal" data-target="#cancelModalOrder-<?php echo $order_id; ?>" class="fa fa-times"></i>

        <!-- Modal -->
        <div class="modal fade" id="cancelModalOrder-<?php echo $order_id; ?>" tabindex="-1" role="dialog"
            aria-labelledby="cancelModalOrderLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="cancelModalOrderLabel">
                            Hủy hóa đơn
                        </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-start fw-bold">
                        Bạn có chắc hủy hóa đơn không?
                    </div>
                    <div class="modal-footer">
                        <form action="<?php echo SITEURL . 'admin/manage-order/update-order.php'; ?>" method="GET">
                            <input type="hidden" name="order_id" value="<?php echo $order_id; ?>">
                            <button type="submit" name="cancel-submit" class="btn btn-primary removeOrder">
                                Có
                            </button>
                        </form>


                        <button type="button" class="btn btn-primary" data-dismiss="modal">
                            Không
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <?php
                        } elseif ($status == "Đang giao hàng") {
                        ?>
        <form action="<?php echo SITEURL . 'admin/manage-order/update-order.php'; ?>" method="get">
            <button class="btn btn-primary" type="submit" name="confirm-submit">Đã giao
                hàng</button>
            <input type="hidden" name="order_id" value="<?php echo $order_id; ?>">
        </form>
        <?php
                        }
                        ?>
    </td>
</tr>
<?php
            }
        } else {
            echo '<tr><td colspan="5" class="text-danger">Bạn chưa có đơn hàng nào.</td></tr>';
        }
    }
}

function renderProduct($id, $name, $image_name, $price)
{
    ?>
<div class="col-6 col-lg-4 col-xl-3 mb-2">
    <div class="card text-center card__item" style="">
        <img class="img__product" src="./assests/images/product/<?php echo $image_name; ?>" alt="" />
        <div class="card-body card__content">
            <h1 class="card-title"><?php echo $name; ?></h1>
            <h3 class="card-text"><?php echo currency_format($price); ?></h3>
            <div class="menu__product">
                <form action="cart.php" method="POST">
                    <input type="hidden" name="user_id"
                        value="<?php if (isset($_SESSION['user_id'])) echo $_SESSION['user_id']; ?>">
                    <input type="hidden" name="product_id" value="<?php echo $id ?>">
                    <button type="submit" name="cart-submit" class="product_item add__cart">
                        <i class="fa fa-shopping-cart"></i>
                    </button>
                </form>

                <form action="detail-page.php" method="GET">
                    <input type="hidden" name="id" value="<?php echo $id ?>">
                    <button class="product_item view__detail" style="text-decoration: none">
                        <i class="fa fa-eye"></i>
                    </button>
                </form>
                <form action="product_liked.php" method="POST">
                    <input type="hidden" name="product_id" value="<?php echo $id ?>">
                    <button type="submit" name="like" class="product_item like__product">
                        <i class="fa fa-heart"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
}
?>