<div class="footer">
    <div class="container footer__content">
        <div class="footer__social">
            <a href="#" class="footer__social-link">
                <i class="fa-brands fa-facebook"></i>
            </a>
            <a href="#" class="footer__social-link">
                <i class="fa-brands fa-instagram"></i>
            </a>
            <a href="#" class="footer__social-link">
                <i class="fa-brands fa-telegram"></i>
            </a>
        </div>
        <div class="footer__copyright">
            2022 All rights reserved, Fast Shoes. Developed By -
            <a href="#">HPD</a>
        </div>
    </div>
</div>

<a href="#" class="go-to-top">
    <i class="fa-solid fa-arrow-up"></i>
</a>

<script src="./js/app.js"></script>
<script src="./js/swiper.min.js"></script>
<script>
var swiper = new Swiper(".swiper-container", {
    effect: "coverflow",
    grabCursor: true,
    centeredSlides: true,
    slidesPerView: "auto",
    coverflowEffect: {
        rotate: 0,
        stretch: 0,
        depth: 100,
        modifier: 5,
        slideShadows: true,
    },
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
    pagination: {
        el: ".swiper-pagination",
    },
    autoplay: {
        delay: 4000,

    },
});
</script>
</body>

</html>