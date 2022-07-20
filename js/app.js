// Go to top
var btnGoToTop = document.querySelector(".go-to-top");

window.onscroll = function () {
  if (window.scrollY != 0) {
    btnGoToTop.style = "opacity: 1; pointer-events: unset;";
  } else {
    btnGoToTop.style = "opacity: 0; pointer-events: none;";
  }
};

// Remove Item Cart
var removeItem = document.getElementsByClassName("remove");
for (var i = 0; i < removeItem.length; i++) {
  var button = removeItem[i];
  button.addEventListener("click", function (e) {
    var buttonClicked = e.target;
    buttonClicked.parentElement.parentElement.parentElement.parentElement.remove();
  });
}
//Remove Item Order
var removeItemOrder = document.getElementsByClassName("removeOrder");
for (var i = 0; i < removeItemOrder.length; i++) {
  var button = removeItemOrder[i];
  button.addEventListener("click", function (e) {
    var buttonClicked = e.target;
    buttonClicked.parentElement.parentElement.parentElement.parentElement.parentElement.parentElement.remove();
    var toRemove = document.querySelector(".modal-backdrop").remove();
  });
}

// Validation form
function Validate(formSelector) {
  function getParent(element, selector) {
    while (element.parentElement) {
      if (element.parentElement.matches(selector)) {
        return element.parentElement;
      }
      element = element.parentElement;
    }
  }

  var formRules = {};
  var validateRules = {
    required: function (value) {
      return value ? undefined : "Vui lòng nhập trường này.";
    },
    email: function (value) {
      const regex =
        /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
      return regex.test(value) ? undefined : "Trường này phải là email.";
    },
    min: function (min) {
      return function (value) {
        return value.length >= min
          ? undefined
          : `Vui lòng nhập ít nhất ${min} kí tự.`;
      };
    },
    matchPassword: function (value, password) {
      return value === password
        ? undefined
        : "Mật khẩu nhập lại không trùng khớp.";
    },
  };

  var formElement = document.querySelector(formSelector);

  if (formElement) {
    var inputs = formElement.querySelectorAll("[name][rules]");
    for (var input of inputs) {
      var rules = input.getAttribute("rules").split("|");

      for (var rule of rules) {
        var ruleHasValue = rule.includes(":");

        if (ruleHasValue) {
          var ruleInfo = rule.split(":");
          rule = ruleInfo[0];
        }

        var ruleFunction = validateRules[rule];

        if (ruleHasValue) {
          ruleFunction = validateRules[rule]([ruleInfo[1]]);
        }

        if (Array.isArray(formRules[input.name])) {
          formRules[input.name].push(ruleFunction);
        } else {
          formRules[input.name] = [ruleFunction];
        }
      }

      input.onblur = handleValidate;
      input.oninput = handleClearError;
    }

    function handleValidate(e) {
      var rules = formRules[e.target.name];
      var errorMessage;

      for (var rule of rules) {
        errorMessage = rule(e.target.value);
        if (rule.name === "matchPassword") {
          errorMessage = rule(
            e.target.value,
            formElement.querySelector("input[name=password]").value
          );
        }
        if (errorMessage) break;
      }

      var formField = getParent(e.target, ".form__field");
      if (formField) {
        if (errorMessage) {
          var formMessage = formField.querySelector(".form-message");

          if (formMessage) {
            formMessage.innerText = errorMessage;
            formMessage.classList.add("error");
          }
        }
      }

      return errorMessage;
    }

    function handleClearError(e) {
      var formField = getParent(e.target, ".form__field");
      if (formField) {
        var formMessage = formField.querySelector(".form-message");
        if (formMessage.classList.contains("error")) {
          formMessage.innerText = "";
          formMessage.classList.remove("error");
        }
      }
    }
  }
}

Validate("#form-register");
Validate("#form-contact");
Validate("#form-order");
Validate("#form-forgetPassword");
