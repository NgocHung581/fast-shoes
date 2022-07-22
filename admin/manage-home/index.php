<?php
include('../partials/header.php');
?>

<div class="main-content">
    <div class="container">
        <h1 class="mb-20">Dashboard</h1>

        <div class="row gy-4">
            <div class="col-3">
                <div class="dashboard__item bg-info text-center">
                    <h3
                        class="d-flex align-items-center justify-content-center h-50 border-bottom fs-2 text-danger fw-bold">
                        Sản phẩm</h3>
                    <span class="d-flex align-items-center justify-content-center h-50 fs-2">
                        <?php
                        $sql = "SELECT * FROM tbl_product";
                        $res = mysqli_query($conn, $sql);
                        echo $count = mysqli_num_rows($res);
                        ?>
                    </span>
                </div>
            </div>

            <div class="col-3">
                <div class="dashboard__item bg-info text-center">
                    <h3
                        class="d-flex align-items-center justify-content-center h-50 border-bottom fs-2 text-danger fw-bold">
                        Danh mục</h3>
                    <span class="d-flex align-items-center justify-content-center h-50 fs-2">
                        <?php
                        $sql2 = "SELECT * FROM tbl_category";
                        $res2 = mysqli_query($conn, $sql2);
                        echo $count2 = mysqli_num_rows($res2);
                        ?>
                    </span>
                </div>
            </div>

            <div class="col-3">
                <div class="dashboard__item bg-info text-center">
                    <h3
                        class="d-flex align-items-center justify-content-center h-50 border-bottom fs-2 text-danger fw-bold">
                        Khách hàng</h3>
                    <span class="d-flex align-items-center justify-content-center h-50 fs-2">
                        <?php
                        $sql3 = "SELECT * FROM tbl_user WHERE type = 'user'";
                        $res3 = mysqli_query($conn, $sql3);
                        echo $count3 = mysqli_num_rows($res3);
                        ?>
                    </span>
                </div>
            </div>

            <div class="col-3">
                <div class="dashboard__item bg-info text-center">
                    <h3
                        class="d-flex align-items-center justify-content-center h-50 border-bottom fs-2 text-danger fw-bold">
                        Admin</h3>
                    <span class="d-flex align-items-center justify-content-center h-50 fs-2">
                        <?php
                        $sql4 = "SELECT * FROM tbl_user WHERE type = 'admin'";
                        $res4 = mysqli_query($conn, $sql4);
                        echo $count4 = mysqli_num_rows($res4);
                        ?>
                    </span>
                </div>
            </div>

            <div class="col-3">
                <div class="dashboard__item bg-info text-center">
                    <h3
                        class="d-flex align-items-center justify-content-center h-50 border-bottom fs-2 text-danger fw-bold">
                        Thu nhập</h3>
                    <span class="d-flex align-items-center justify-content-center h-50 fs-2">
                        <?php
                        $total = 0;
                        $sql5 = "SELECT * FROM tbl_order WHERE order_status = 'Đã giao hàng'";
                        $res5 = mysqli_query($conn, $sql5);
                        $count5 = mysqli_num_rows($res5);
                        if ($count5 > 0) {
                            while ($row5 = mysqli_fetch_assoc($res5)) {
                                $total += $row5['total_price'];
                            }
                        } else {
                            echo "0 VND";
                        }
                        echo currency_format($total, " VND");
                        ?>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include('../partials/footer.php');
?>