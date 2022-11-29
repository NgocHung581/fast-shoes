const sizes = document.querySelectorAll(".size");
const colors = document.querySelectorAll(".color");
const shoes = document.querySelectorAll(".shoe");
const gradients = document.querySelectorAll(".gradient");
const shoeBg = document.querySelector(".shoeBackground");

let prevColor = "blue";
let animationEnd = true;

function changeSize() {
  sizes.forEach((size) => size.classList.remove("active"));
  this.classList.add("active");
}

sizes.forEach((size) => size.addEventListener("click", changeSize));

let x = window.matchMedia("(max-width: 1000px)");

function changeHeight() {
  if (x.matches) {
    if (shoes[0]) {
      let shoeHeight = shoes[0].offsetHeight;
      if (shoeBg) {
        shoeBg.style.height = `${shoeHeight * 0.9}px`;
      }
    }
  } else {
    if (shoeBg) {
      shoeBg.style.height = "475px";
    }
  }
}

changeHeight();

window.addEventListener("resize", changeHeight);
