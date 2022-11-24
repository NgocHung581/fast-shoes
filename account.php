<?php
include_once('./partials-frontend/header.php');
?>

<div class="accountPage">
    <div class="container mt-45">
        <h1>Thông tin tài khoản</h1>
        <div class="row">
            <div class="col-lg-4">
                <img src="./assests/images/user.png" alt="" />
                <input type="file">
            </div>
            <div class="col-lg-8">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="first_name" class="form-label">Họ</label>
                            <input type="text" name="first_name" id="first_name" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="last_name" class="form-label">Tên</label>
                            <input type="text" name="last_name" id="last_name" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Email</label>
                    <input type="email" class="form-control" name="" id="">
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div>
                            <label class="form-label">Giới tính</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" id="male" value="Nam">
                            <label class="form-check-label" for="male">Nam</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" id="famale" value="Nữ">
                            <label class="form-check-label" for="famale">Nữ</label>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="phone" class="form-label">Số điện thoại</label>
                            <input type="text" name="phone" id="phone" class="form-control">
                        </div>
                    </div>
                </div>
                <button class="btn btn-primary">Lưu</button>
            </div>
        </div>
    </div>
</div>

<?php
include_once('./partials-frontend/footer.php');
?>