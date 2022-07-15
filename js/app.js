// Go to top
var btnGoToTop = document.querySelector(".go-to-top");

window.onscroll = function () {
  if (window.scrollY != 0) {
    btnGoToTop.style = "opacity: 1; pointer-events: unset;";
  } else {
    btnGoToTop.style = "opacity: 0; pointer-events: none;";
  }
};

// Slider
$(".owl-carousel").owlCarousel({
  loop: true,
  margin: 10,
  nav: false,
  dots: true,
  autoplay: true,
  responsive: {
    0: {
      items: 1,
    },
    600: {
      items: 1,
    },
    1024: {
      items: 1,
    },
  },
});
