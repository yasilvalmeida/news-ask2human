var email = $("#email");
$(() => {
  updateTips = (tips, t) => {
    console.log(tips);
    console.log(t);
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
recover = () => {
  var bValid = true,
    tips = $("#recover_state");
  tips.removeClass("alert-danger");
  if (email.val() == "") {
    email.addClass("alert alert-danger");
    updateTips(tips, "The e-mail can't be empty.");
    email.focus();
  } else {
    bValid = bValid && checkLength(email, "email", 3, 80, tips);
    bValid =
      bValid &&
      checkRegexp(
        email,
        /^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i,
        "Please enter a valid e-mail for example: account@domain.com",
        tips
      );
    if (bValid) {
      recoverAsync();
    }
  }
};
recoverAsync = () => {
  var email = $("#email").val(),
    tips = $("#recover_state");
  tips.addClass("alert-light");
  tips.html("<img src='../assets/img/loading.gif' />");
  $.post(
    "ajax/recover.php",
    {
      email: email,
    },
    (data, status) => {
      if (status == "success") {
        try {
          console.log(data);
          var r = JSON.parse(data),
            result = parseInt(r.result),
            message = r.message;
          tips.html(message);
          if (result != NaN && result == 1) {
            setTimeout(() => {
              window.location.href = "index.php";
            }, 2000);
          }
        } catch (error) {
          updateTips(tips, error);
        }
      } else {
        updateTips(tips, data);
      }
    }
  );
};
