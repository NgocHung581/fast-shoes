// Go to top
var btnGoToTop = document.querySelector(".go-to-top");

window.onscroll = function () {
  if (window.scrollY != 0) {
    btnGoToTop.style = "opacity: 1; pointer-events: unset;";
  } else {
    btnGoToTop.style = "opacity: 0; pointer-events: none;";
  }
};
