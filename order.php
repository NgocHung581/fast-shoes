<?php
include('./partials-frontend/header.php');
?>

<section class="order">
    <div class="container">
        <div class="row">
            <div class="col-5 px-5">
                <h2>Thông tin khách hàng</h2>
                <form action="" method="POST" id="form-order">
                    <div class="row">
                        <div class="col-12">
                            <div class="form__field" id="form__order-field">
                                <div class="form-group" id="form__order-group">
                                    <input required="required" type="text" name="username" rules="required"
                                        id="form-username" class="form-username" />
                                    <span class="form-label" id="form__order-label">Họ và tên</span>
                                </div>
                                <div class="form-message"></div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form__field" id="form__order-field">
                                <div class="form-group" id="form__order-group">
                                    <input required="required" type="text" name="email" rules="required|email"
                                        id="form-tel" class="form-tel" />
                                    <span class="form-label" id="form__order-label">Email</span>
                                </div>
                                <div class="form-message"></div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form__field" id="form__order-field">
                                <div class="form-group" id="form__order-group">
                                    <input required="required" type="tel" name="tel" rules="required" id="form-tel"
                                        class="form-tel" />
                                    <span class="form-label" id="form__order-label">Số điện thoại</span>
                                </div>
                                <div class="form-message"></div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form__field" id="form__order-field">
                                <div class="form-group" id="form__order-group">
                                    <input required="required" type="text" name="address" rules="required"
                                        id="form-address" class="form-address" />
                                    <span class="form-label" id="form__order-label">Địa chỉ</span>
                                </div>
                                <div class="form-message"></div>
                            </div>
                        </div>
                        <div class="col-6">
                            <a href="cart.php" class="btn btn-primary"><i class="fa fa-long-arrow-alt-left"></i> Trở
                                lại giỏ hàng</a>
                        </div>
                        <div class="col-6 text-end">

                            <button type="submit" class="btn btn-primary">
                                <a href="order-customer.php">Đặt hàng</a>
                            </button>

                        </div>
                    </div>
                </form>
            </div>
            <div class="col-7 line">
                <h2>Đơn hàng của bạn</h2>
                <div class="row py-3">
                    <div class="col-6">Mã đơn hàng: ĐH01234</div>
                    <div class="col-6 text-end">Ngày đặt hàng: 17/07/2022</div>
                </div>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th class="text-center" colspan="3">Sản phẩm</th>
                            <th>Size</th>
                            <th>Giá</th>
                            <th>Số lượng</th>
                            <th>Tạm tính</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="3">
                                <div class="row align-items-center product">

                                    <div class="col-5">
                                        <img class="img-fluid" src="./assests/images/product/nike.webp" alt="" />
                                    </div>
                                    <div class="col-7">
                                        <p class="mb-0">Nike</pc>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <select class="form-select" aria-label="Default select example">
                                    <option value="1">35</option>
                                    <option value="2">36</option>
                                    <option value="3">37</option>
                                    <option value="3">38</option>
                                    <option value="3">39</option>
                                    <option value="3">40</option>
                                </select>
                            </td>
                            <td>1.200.000 <sup>₫</sup></td>
                            <td>
                                <input class="quanlity" type="number" min="1" value="1" name="" id="" />
                            </td>
                            <td>1.200.000 <sup>₫</sup></td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <div class="row align-items-center product">

                                    <div class="col-5">
                                        <img class="img-fluid" src="./assests/images/product/nike.webp" alt="" />
                                    </div>
                                    <div class="col-7">
                                        <p class="mb-0">Nike</pc>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <select class="form-select" aria-label="Default select example">
                                    <option value="1">35</option>
                                    <option value="2">36</option>
                                    <option value="3">37</option>
                                    <option value="3">38</option>
                                    <option value="3">39</option>
                                    <option value="3">40</option>
                                </select>
                            </td>
                            <td>1.200.000 <sup>₫</sup></td>
                            <td>
                                <input class="quanlity" type="number" min="1" value="1" name="" id="" />
                            </td>
                            <td>1.200.000 <sup>₫</sup></td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <div class="row align-items-center product">

                                    <div class="col-5">
                                        <img class="img-fluid" src="./assests/images/product/nike.webp" alt="" />
                                    </div>
                                    <div class="col-7">
                                        <p class="mb-0">Nike</pc>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <select class="form-select" aria-label="Default select example">
                                    <option value="1">35</option>
                                    <option value="2">36</option>
                                    <option value="3">37</option>
                                    <option value="3">38</option>
                                    <option value="3">39</option>
                                    <option value="3">40</option>
                                </select>
                            </td>
                            <td>1.200.000 <sup>₫</sup></td>
                            <td>
                                <input class="quanlity" type="number" min="1" value="1" name="" id="" />
                            </td>
                            <td>1.200.000 <sup>₫</sup></td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <div class="row align-items-center product">

                                    <div class="col-5">
                                        <img class="img-fluid" src="./assests/images/product/nike.webp" alt="" />
                                    </div>
                                    <div class="col-7">
                                        <p class="mb-0">Nike</pc>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <select class="form-select" aria-label="Default select example">
                                    <option value="1">35</option>
                                    <option value="2">36</option>
                                    <option value="3">37</option>
                                    <option value="3">38</option>
                                    <option value="3">39</option>
                                    <option value="3">40</option>
                                </select>
                            </td>
                            <td>1.200.000 <sup>₫</sup></td>
                            <td>
                                <input class="quanlity" type="number" min="1" value="1" name="" id="" />
                            </td>
                            <td>1.200.000 <sup>₫</sup></td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <div class="row align-items-center product">

                                    <div class="col-5">
                                        <img class="img-fluid" src="./assests/images/product/nike.webp" alt="" />
                                    </div>
                                    <div class="col-7">
                                        <p class="mb-0">Nike</pc>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <select class="form-select" aria-label="Default select example">
                                    <option value="1">35</option>
                                    <option value="2">36</option>
                                    <option value="3">37</option>
                                    <option value="3">38</option>
                                    <option value="3">39</option>
                                    <option value="3">40</option>
                                </select>
                            </td>
                            <td>1.200.000 <sup>₫</sup></td>
                            <td>
                                <input class="quanlity" type="number" min="1" value="1" name="" id="" />
                            </td>
                            <td>1.200.000 <sup>₫</sup></td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <div class="row align-items-center product">

                                    <div class="col-5">
                                        <img class="img-fluid" src="./assests/images/product/nike.webp" alt="" />
                                    </div>
                                    <div class="col-7">
                                        <p class="mb-0">Nike</pc>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <select class="form-select" aria-label="Default select example">
                                    <option value="1">35</option>
                                    <option value="2">36</option>
                                    <option value="3">37</option>
                                    <option value="3">38</option>
                                    <option value="3">39</option>
                                    <option value="3">40</option>
                                </select>
                            </td>
                            <td>1.200.000 <sup>₫</sup></td>
                            <td>
                                <input class="quanlity" type="number" min="1" value="1" name="" id="" />
                            </td>
                            <td>1.200.000 <sup>₫</sup></td>
                        </tr>


                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="6">Tổng tiền</td>
                            <td>1.200.000 <sup>₫</sup></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

    </div>
</section>

<?php
include('./partials-frontend/footer.php');
?>