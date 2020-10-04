var id, email, password;
html = "";
$(() => {
  id = $("#logged_id").val();
  email = $("#logged_email").val();
  password = $("#logged_password").val();
  $("#menu").html("<span><i class='fas fa-user'></i> " + email + "</span>");

  updateTips = (tips, t) => {
    tips.html(t).addClass("alert-danger");
    setTimeout(function () {
      tips.removeClass("alert-danger", 1500);
    }, 2000);
  };
  checkLength = (o, n, min, max, tips) => {
    if (o.val().length > max || o.val().length < min) {
      o.addClass("alert-danger");
      o.focus();
      updateTips(
        tips,
        "The lenght of " + n + " must be between " + min + " and " + max + "."
      );
      return false;
    } else {
      return true;
    }
  };
  checkRegexp = (o, regexp, n, tips) => {
    if (!regexp.test(o.val())) {
      o.addClass("alert-danger");
      o.focus();
      updateTips(tips, n);
      return false;
    } else {
      return true;
    }
  };
});
change = () => {
  $("#id").val(id);
  $("#email").val(email);
  $("#password").val(password);
  $("#changeModal").modal("show");
};
validate = () => {
  var bValid = true,
    tips = $("#change_state"),
    email = $("#email"),
    password = $("#password");
  if (email.val() == "") {
    tips.addClass("alert alert-danger");
    tips.html("The e-mail must be filled.");
    email.focus();
  } else if (password.val() == "") {
    tips.addClass("alert alert-danger");
    tips.html("The password must be filled.");
    password.focus();
  } else if (email.val() == password.val()) {
    tips.addClass("alert-danger");
    tips.html("The e-mail must be different of the password.");
    password.focus();
  } else {
    bValid = bValid && checkLength(email, "e-mail", 8, 80, tips);
    bValid =
      bValid &&
      checkRegexp(
        email,
        /^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i,
        "Please enter a valid e-mail for example: account@domain.com",
        tips
      );
    bValid = bValid && checkLength(password, "password", 6, 20, tips);
    bValid =
      bValid &&
      checkRegexp(
        password,
        /[0-9]/,
        "The password must contain at least one number.",
        tips
      );
    bValid =
      bValid &&
      checkRegexp(
        password,
        /[a-z]/,
        "The password must contain at least one lowercase lettter.",
        tips
      );
    bValid =
      bValid &&
      checkRegexp(
        password,
        /[A-Z]/,
        "The password must contain at least one uppercase lettter.",
        tips
      );
    bValid =
      bValid &&
      checkRegexp(
        password,
        /[@£€§#$%&*+-?!~^ºª]/,
        "The password must contain at least one special character, such as *, &, $, @ or #.",
        tips
      );
    if (bValid) {
      changeAsync();
    }
  }
};
changeAsync = () => {
  var id = $("#id").val(),
    email = $("#email").val(),
    password = $("#password").val(),
    tips = $("#change_state");
  tips.addClass("alert-light");
  tips.html("<img src='../assets/img/loading.gif' />");
  $.post(
    "ajax/change.php",
    {
      id: id,
      email: email,
      password: password,
    },
    (data, status) => {
      if (status == "success") {
        console.log(data);
        try {
          if (data == "1") {
            window.location.reload(false);
          }
        } catch (error) {
          tips.html(error);
        }
      } else {
        updateTips(tips, data);
      }
    }
  );
};
exit = () => {
  $("#logOutModal").modal("show");
};
exitAsync = () => {
  var tips = $("#exit_state");
  tips.html("<img src='../assets/img/loading.gif' />");
  $.post(
    "ajax/exit.php",
    {},
    function (data) {
      var result = parseInt(data.text);
      if (result > 0) {
        setTimeout(function () {
          document.location.reload(true);
        }, 100);
      } else {
        updateTips(tips, result);
      }
    },
    "json"
  );
};
