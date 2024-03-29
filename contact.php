<?php
include_once('./partials-frontend/header.php');
?>

<section class="contact">
    <div class="contact__map">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d31353.488624554157!2d106.7057152!3d10.797056!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x317528f4a62fce9b%3A0xc99902aa1e26ef02!2zVHLGsOG7nW5nIMSQ4bqhaSBo4buNYyBWxINuIExhbmcgLSBDxqEgc-G7nyAz!5e0!3m2!1svi!2s!4v1657769598731!5m2!1svi!2s"
            width="100%" height="650" style="border: 0" allowfullscreen="" loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
    <div class="contact__content">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-5 mb-5">
                    <div class="contact__info">
                        <h2 style="font-weight: 600;">Thông tin liên hệ</h2>
                        <ul>
                            <li class="d-flex align-items-center">
                                <i class="fa fa-map-marker-alt"></i>

                                Hẻm 69/68 Đặng Thuỳ Trâm, Phường 13, Bình Thạnh, Thành phố
                                Hồ Chí Minh
                            </li>
                            <li class="d-flex align-items-center">
                                <i class="fa fa-envelope"></i>

                                <a href="mailto:fastshoes.hpdn@gmail.com">fastshoes.hpdn@gmail.com</a>
                            </li>
                            <li class="d-flex align-items-center">
                                <i class="fa fa-phone"></i>

                                <a href="tel:0123456789">0123456789</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-12 col-md-7">
                    <div class="contact__form">
                        <h2 style="font-weight: 600;">Gửi thắc mắc cho chúng tôi</h2>
                        <p>
                            Nếu bạn có thắc mắc gì, có thể gửi yêu cầu cho chúng tôi, và
                            chúng tôi sẽ liên lạc lại với bạn sớm nhất có thể .
                        </p>
                        <form action="" method="POST" id="form-contact">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form__field" id="form__contact-field">
                                        <div class="form-group" id="form__contact-group">
                                            <input required="required" type="text" name="username" rules="required" />
                                            <span class="form-label" id="form__contact-label">Tên của bạn</span>
                                        </div>
                                        <span class="form-message"></span>
                                    </div>
                                </div>
                                <div class="col-12 col-xl-6">
                                    <div class="form__field" id="form__contact-field">
                                        <div class="form-group" id="form__contact-group">
                                            <input required="required" type="email" name="email" rules="required|email"
                                                id="form-tel" class="form-tel" />
                                            <span class="form-label" id="form__contact-label">Email của bạn</span>
                                        </div>
                                        <span class="form-message"></span>
                                    </div>
                                </div>
                                <div class="col-12 col-xl-6">
                                    <div class="form__field" id="form__contact-field">
                                        <div class="form-group" id="form__contact-group">
                                            <input required="required" type="tel" name="tel" rules="required" />
                                            <span class="form-label" id="form__contact-label">Số điện thoại của
                                                bạn</span>
                                        </div>
                                        <span class="form-message"></span>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form__field" id="form__contact-field">
                                        <div class="form-group" id="form__contact-group">
                                            <textarea name="description" id="" cols="30" rows="10" class="form-control"
                                                rules="required" required="required"></textarea>
                                            <span style="top: 10%" class="form-label" id="form__contact-label">Nội
                                                dung</span>
                                        </div>
                                        <span class="form-message"></span>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" name="submit" class="btn btn-primary" style="margin-top: 15px">
                                Gửi
                            </button>
                        </form>

                        <?php
                        if (isset($_POST['submit'])) {
                            $username = $_POST['username'];
                            $email = $_POST['email'];
                            $tel = $_POST['tel'];
                            $description = $_POST['description'];

                            $sql = "INSERT INTO tbl_contact SET
                                        contact_username = '$username',
                                        contact_email = '$email',
                                        contact_tel = '$tel',
                                        contact_description = '$description'
                                        ";
                            $res = mysqli_query($conn, $sql);

                            if ($res == true) {
                        ?>
                        <script>
                        alert("Đã gửi liên hệ thành công")
                        </script>
                        <?php
                            } else {
                            ?>
                        <script>
                        alert("Không thể gửi liên hệ")
                        </script>
                        <?php
                            }
                        }
                        ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
include_once('./partials-frontend/footer.php');
?>