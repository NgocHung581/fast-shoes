<?php
include_once('./partials-frontend/header.php');
include_once('./partials-frontend/check-login-user.php');
?>

<section class="order">
    <div class="container order__mobile">
        <div class="row">
            <div class="col-12 col-lg-8 ">
                <h2>Đơn hàng của bạn</h2>
                <div class="row py-3">
                    <?php
                    if (isset($_SESSION['order-user-id'])) {
                        $user_id =  $_SESSION['order-user-id'];

                        $sql2 = "SELECT * FROM tbl_user WHERE user_id = $user_id";
                        $res2 = mysqli_query($conn, $sql2);
                        $row2 = mysqli_fetch_assoc($res2);
                        $fullname = $row2['fullname'];
                        $username = $row2['username'];
                        $phone = $row2['phone'];
                    ?>
                    <div class="col-6">Họ và tên khách hàng: <span class="fw-bold"><?php echo $fullname; ?></span></div>
                    <div class="col-6 text-end">Ngày đặt hàng: <span class="fw-bold">
                            <?php
                                date_default_timezone_set('Asia/Ho_Chi_Minh');
                                $date = date('d/m/Y - H:i:s');
                                echo $date; ?></span>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th style="min-width: 265px;" class="text-center" colspan="3">Sản phẩm</th>
                                <th style="min-width: 86px;">Size</th>
                                <th style="min-width: 126px;">Đơn giá</th>
                                <th style="min-width: 88px;">Số lượng</th>
                                <th style="min-width: 126px;">Tạm tính</th>
                                <th style="min-width: 137px;">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $total_order = 0;
                            $sql = "SELECT * FROM tbl_cart WHERE user_id = $user_id";
                            $res = mysqli_query($conn, $sql);
                            if ($res == true) {
                                $count = mysqli_num_rows($res);
                                if ($count > 0) {
                                    while ($row = mysqli_fetch_assoc($res)) {
                                        $cart_id = $row['cart_id'];
                                        $product_image = $row['product_image'];
                                        $product_name = $row['product_name'];
                                        $product_size = $row['product_size'];
                                        $product_price = $row['product_price'];
                                        $product_quantity = $row['product_quantity'];
                                        $total_price = $row['total_price'];

                                        if ($total_price == 0) {
                                            $total_order += $product_price;
                                        } else {
                                            $total_order += $total_price;
                                        }
                            ?>
                            <tr>
                                <td colspan="3">
                                    <div class="row align-items-center">
                                        <div class="col-5">
                                            <img class="img-fluid"
                                                src="./assests/images/product/<?php echo $product_image; ?>" alt="" />
                                        </div>
                                        <div class="col-7">
                                            <p class="mb-0"><?php echo $product_name; ?></pc>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <form action="<?php echo SITEURL . "admin/manage-cart/update-cart.php" ?>"
                                        method="GET">
                                        <select name="size" class="form-select" aria-label="Default select example">
                                            <option <?php if ($product_size == 35) echo "selected"; ?> value="35">35
                                            </option>
                                            <option <?php if ($product_size == 36) echo "selected"; ?> value="36">36
                                            </option>
                                            <option <?php if ($product_size == 37) echo "selected"; ?> value="37">37
                                            </option>
                                            <option <?php if ($product_size == 38) echo "selected"; ?> value="38">38
                                            </option>
                                            <option <?php if ($product_size == 39) echo "selected"; ?> value="39">39
                                            </option>
                                            <option <?php if ($product_size == 40) echo "selected"; ?> value="40">40
                                            </option>
                                        </select>
                                </td>
                                <td><?php echo currency_format($product_price); ?></td>
                                <input type="hidden" name='page-order' value="order">
                                <input type="hidden" name='cart_id' value="<?php echo $cart_id; ?>">
                                <input type="hidden" name='price' value="<?php echo $product_price; ?>">
                                <td>
                                    <input class="quanlity form-control" type="number" min="1"
                                        value="<?php echo "$product_quantity"; ?>" name="quantity" />
                                </td>
                                <td><?php
                                                if ($total_price == 0) {
                                                    echo currency_format($product_price);
                                                } else {
                                                    echo currency_format($total_price);
                                                }
                                                ?></td>
                                <td><button type="submit" class="btn btn-update">Cập nhật</button>
                                </td>
                                </form>
                            </tr>
                            <?php
                                    }
                                }
                            }
                            ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="7"><strong class="text-uppercase">Tổng tiền</strong></td>
                                <td><strong><?php echo currency_format($total_order); ?></strong></td>
                            </tr>
                        </tfoot>
                    </table>

                </div>
            </div>
            <div class="col-12 col-lg-4 px-3 px-lg-4 line">
                <h2>Thông tin khách hàng</h2>
                <form action="" method="POST" id="form-order">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form__field" id="form__order-field">
                                <div class="form-group" id="form__order-group">
                                    <input disabled required="required" type="text" name="fullname"
                                        value="<?php echo $fullname ?>" id="form-username" class="form-username" />
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-lg-12">
                            <div class="form__field" id="form__order-field">
                                <div class="form-group" id="form__order-group">
                                    <input disabled value="<?php echo $username; ?>" required="required" type="text"
                                        name="email" id="form-tel" class="form-tel" />
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-lg-12">
                            <div class="form__field" id="form__order-field">
                                <div class="form-group" id="form__order-group">
                                    <input required="required" type="tel" name="tel" rules="required" id="form-tel"
                                        class="form-tel" value="<?php echo $phone; ?>" />
                                    <span class="form-label" id="form__order-label">Số điện thoại</span>
                                </div>
                                <div class="form-message"></div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form__field" id="form__order-field">
                                <div class="form-group" id="form__order-group">
                                    <input required="required" type="text" name="address" rules="required"
                                        id="form-address" class="form-address" />
                                    <span class="form-label" id="form__order-label">Địa chỉ</span>
                                </div>
                                <div class="form-message"></div>
                            </div>
                        </div>
                        <div class="col-7">
                            <a href="cart.php" class="btn btn-primary"><i class="fa fa-long-arrow-alt-left"></i> Trở
                                lại giỏ hàng</a>
                        </div>
                        <div class="col-5 text-end">

                            <button type="submit" name="submit" class="btn btn-primary">
                                Đặt hàng
                            </button>
                        </div>
                    </div>
                    <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                </form>
                <?php
                    }
            ?>
            </div>

        </div>

    </div>
</section>

<?php
include_once('./partials-frontend/footer.php');
?>

<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (isset($_POST['submit'])) {
    $order_date = $date;
    $order_status = "Đã đặt hàng";
    $product_name = [];
    $product_size = [];
    $product_image = [];
    $product_price = [];
    $product_quantity = [];
    $total_price = 0;

    $user_id = $_POST['user_id'];
    $customer_fullname = "$fullname";
    $customer_email = "$username";
    $customer_address = $_POST['address'];
    $customer_phone = $_POST['tel'];

    $sql3 = "SELECT * FROM tbl_cart WHERE user_id = $user_id";

    $res3 = mysqli_query($conn, $sql3);

    if ($res3 == true) {
        $count3 = mysqli_num_rows($res3);

        if ($count3 > 0) {
            while ($row = mysqli_fetch_assoc($res3)) {
                $cart_product_name = $row['product_name'];
                $cart_product_size = $row['product_size'];
                $cart_product_image = $row['product_image'];
                $cart_product_price = $row['product_price'];
                $cart_product_quantity = $row['product_quantity'];

                if ($cart_product_size == 0) {
                    $cart_product_size = 35;
                }

                if ($cart_product_quantity == 0) {
                    $cart_product_quantity = 1;
                }

                $total_price += ($cart_product_price * $cart_product_quantity);

                array_push($product_name, $cart_product_name);
                array_push($product_size, $cart_product_size);
                array_push($product_image, $cart_product_image);
                array_push($product_price, $cart_product_price);
                array_push($product_quantity, $cart_product_quantity);
            }
        }

        $sql4 = "INSERT INTO tbl_order SET
        order_date = '$order_date',
        order_status = '$order_status',
        product_name = '" . implode(',', $product_name) . "',
        product_image = '" . implode(',', $product_image) . "',
        product_size = '" . implode(',', $product_size) . "',
        product_price = '" . implode(',', $product_price) . "',
        product_quantity = '" . implode(',', $product_quantity) . "',
        total_price = $total_price,
        customer_id = $user_id,
        customer_fullname = '$customer_fullname',
        customer_email = '$customer_email',
        customer_phone = '$customer_phone',
        customer_address = '$customer_address'
        ";
        $res4 = mysqli_query($conn, $sql4);
        $order_id = mysqli_insert_id($conn);

        if ($res4 == true) {
            $sql5 = "DELETE FROM tbl_cart WHERE user_id = $user_id";
            $res5 = mysqli_query($conn, $sql5);

            // Gửi email khi đặt hàng thành công    

            require "vendor/phpmailer/phpmailer/src/phpmailer.php";
            require "vendor/phpmailer/phpmailer/src/exception.php";
            require "vendor/phpmailer/phpmailer/src/smtp.php";
            require "vendor/autoload.php";

            $mail = new PHPMailer;

            try {
                $mail->CharSet = "UTF-8";
                $mail->SMTPDebug = 0;
                $mail->isSMTP();
                $mail->Host = SMTP_HOST;
                $mail->SMTPAuth = true;
                $mail->Username = SMTP_UNAME;
                $mail->Password = SMTP_PWORD;
                $mail->SMTPSecure = "ssl";
                $mail->Port = SMTP_PORT;

                $mail->setFrom(SMTP_UNAME, "Fast Shoes");
                $mail->addAddress($customer_email, $customer_fullname);
                $mail->addReplyTo(SMTP_UNAME);
                $mail->isHTML(true);

                $subject = "Thông báo xác nhận đơn hàng #DH" . $order_id;
                $mail->Subject = $subject;

                $body = "<h3 style='color: #000; font-size: 20px;'>Welcome to Fast Shoes!</h3>";
                $body .= "<p style='color: #000; font-size: 16px;'>Xin chào " . $customer_fullname . ", chúng tôi đang chuẩn bị sản phẩm để gửi đi cho bạn.</p>";
                $body .= "<p style='color: #000; font-size: 16px;'>Chúng tôi sẽ liên lạc cho bạn qua số điện thoại " . $customer_phone . " trước khi đến nơi. Hàng sẽ được giao lại hoàn toàn miễn phí nếu bạn vắng nhà.</p>";
                $body .= "<p style='color: #000; font-size: 16px;'>Cảm ơn bạn đã đồng hành cùng Fast Shoes.</p>";
                $body .= "<a href='http://localhost/Shoes-Store/' style='display:inline-block; color: #fff; background-color: #000080; padding: 16px; text-decoration: none; border-radius: 4px;'>Đến cửa hàng</a>";
                $body .= "<h3 style='color: #000; font-size: 16px'>Thông tin đơn hàng!</h3>";
                $body .= "<table style='width: 50%; font-size: 16px'>
                            <tbody>";

                $sql_order_mail = "SELECT * FROM tbl_order WHERE order_id = $order_id";
                $res_order_mail = mysqli_query($conn, $sql_order_mail);
                if ($res_order_mail == true) {
                    $count_order_mail = mysqli_num_rows($res_order_mail);
                    if ($count_order_mail > 0) {
                        while ($row_order_mail = mysqli_fetch_assoc($res_order_mail)) {
                            $total_price_mail = $row_order_mail['total_price'];
                            $product_name_mail = explode(',', $row_order_mail['product_name']);
                            $product_image_mail = explode(',', $row_order_mail['product_image']);
                            $product_size_mail = explode(',', $row_order_mail['product_size']);
                            $product_price_mail = explode(',', $row_order_mail['product_price']);
                            $product_quantity_mail = explode(',', $row_order_mail['product_quantity']);

                            for ($i = 0; $i < count($product_name_mail); $i++) {

                                $img_path = "./assests/images/product/$product_image_mail[$i]";
                                $cid = md5($img_path);
                                $mail->AddEmbeddedImage($img_path, $cid);

                                $body .= "<tr style='display: flex; align-items: center; padding: 20px 10px;'>
                                            <td style='width: 100px'>
                                                <img src='cid:" . $cid . "' style='width: 100%;
                                                                            object-fit: cover;
                                                                            border: 1px solid #ccc;
                                                                            border-radius: 12px;'>
                                            </td>
                                            <td style='margin-left: 20px; width: 30%;'>
                                                <div style=''>
                                                    <strong>$product_name_mail[$i]</strong>
                                                    <strong> x $product_quantity_mail[$i]</strong>
                                                </div>
                                                <div>
                                                    Size: $product_size_mail[$i]
                                                </div>
                                            </td>
                                            <td style=''>
                                                <div>
                                                    <strong>" . currency_format($product_price_mail[$i]) . "</strong>
                                                </div>
                                            </td>
                                        </tr>
                                        <hr style='width: 70%; float: left;'>
                                        ";
                            }
                        }
                    }
                }
                $body .= "  </tbody>
                            <tfoot style='display: block;'>
                                <tr style='font-size: 20px;'>
                                    <td style='width: 370px;'><strong>Tổng tiền:</strong></td>
                                    <td>
                                        <strong>" . currency_format($total_price_mail) . "</strong>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>";

                $mail->Body = $body;
                $result = $mail->send();

                if (!$result) {
                    $error = "Có lỗi xảy ra trong quá trình gửi mail";
                }
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: ", $mail->ErrorInfo;
            }

?>
<script>
<?php echo ("location.href = '" . SITEURL . "order-customer.php';"); ?>
</script>
<?php
        }
    }
}
?>