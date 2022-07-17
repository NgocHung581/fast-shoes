// Go to top
var btnGoToTop = document.querySelector(".go-to-top");

window.onscroll = function () {
  if (window.scrollY != 0) {
    btnGoToTop.style = "opacity: 1; pointer-events: unset;";
  } else {
    btnGoToTop.style = "opacity: 0; pointer-events: none;";
  }
};

// Validation form
var btnRegister = document.querySelector(".btn-register");
var emailInput = document.querySelector(".form__register-email");
var passwordInput = document.querySelector(".form__register-password");
var passwordConfirmInput = document.querySelector(
  ".form__register-passwordConfirm"
);
var fullnameInput = document.querySelector(".form__register-fullname");

var message;

function checkEmail(input) {
  var parentElement = input.parentElement;
  const re =
    /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
  var message = re.test(input.value) ? "" : "Trường này phải là email.";
  parentElement.nextElementSibling.innerHTML = message;
}

function checkPasswordLength(input, min) {
  var parentElement = input.parentElement;

  if (input.value.length < min) {
    message = `Mật khẩu phải chứa ít nhất ${min} kí tự`;
  } else {
    message = "";
  }
  parentElement.nextElementSibling.innerHTML = message;
}

function checkMatchPassword(password, passwordConfirm) {
  var parentElement = passwordConfirm.parentElement;

  if (passwordConfirm.value !== password.value) {
    message = "Mật khẩu không trùng khớp.";
  } else {
    message = "";
  }
  parentElement.nextElementSibling.innerHTML = message;
}

function checkEmpty(input) {
  var parentElement = input.parentElement;

  console.log(input.value);
  if (input.value == "") {
    message = "Trường này không được để trống.";
    parentElement.nextElementSibling.innerHTML = message;
    return true;
  } else {
    message = "";
    parentElement.nextElementSibling.innerHTML = message;
    return false;
  }
}

btnRegister.onclick = function (e) {
  e.preventDefault();

  checkEmpty(fullnameInput);

  if (!checkEmpty(emailInput)) {
    checkEmail(emailInput);
  }

  if (!checkEmpty(passwordInput)) {
    checkPasswordLength(passwordInput, 6);
  }

  if (!checkEmpty(passwordConfirmInput)) {
    checkMatchPassword(passwordInput, passwordConfirmInput);
  }
};
