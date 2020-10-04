$(() => {
  load();
});
load = () => {
  $("#country-content").html("<img src='../assets/img/loading.gif' />");
  var formData = new FormData();
  $.ajax({
    type: "POST",
    url: "ajax/country/load.php",
    data: formData,
    contentType: false,
    processData: false,
    cache: false,
    success: function (result) {
      try {
        if (result == null) return;
        $("#country-content").html(result);
      } catch (error) {
        console.log(error);
      }
    },
  });
};
update = (country) => {
  $("#country-update-id").val(country.id);
  $("#code").val(country.code);
  $("#name").val(country.name);
  $("#state").prop("checked", country.state == 1 ? true : false);
  $("#country-update-state").html("");
  $("#country-update-modal").modal("show");
};
country_update_async = () => {
  var formData = new FormData(),
    id,
    code,
    name,
    state;
  $("#country-update-form input").each(function (index) {
    var input = $(this);
    if (input.attr("id") == "name") name = input;
    else if (input.attr("id") == "country-update-id") id = input;
    else if (input.attr("id") == "code") code = input;
    else if (input.attr("id") == "state") state = input;
  });
  if (name.val() == "") {
    alert("The name of country must be filled.");
    name.focus();
    return;
  }
  formData.append("id", id.val());
  formData.append("name", name.val());
  formData.append("code", code.val());
  formData.append("state", state.is(':checked') ? 1 : 0);
  $("#country-update-state").html("<img src='../assets/img/loading.gif' />");
  $.ajax({
    type: "POST",
    url: "ajax/country/update.php",
    data: formData,
    contentType: false,
    processData: false,
    cache: false,
    success: function (result) {
      try {
        if (result == null) return;
        console.log(result);
        if (result == "1") toastr.success("Country was update successful");
        else toastr.error(result);
        load();
        $("#country-update-form")[0].reset();
        $("#country-update-state").html("");
        $("#country-update-modal").modal("hide");
      } catch (error) {
        console.log(error);
      }
    },
  });
};
save = () => {
  $("#country-insert-modal").modal("show");
};
country_insert_async = () => {
  var formData = new FormData(),
    code,
    name,
    state;
  $("#country-insert-form input").each(function (index) {
    var input = $(this);
    if (input.attr("id") == "_name") name = input;
    else if (input.attr("id") == "_code") code = input;
    else if (input.attr("id") == "_state") state = input;
  });
  if (code.val() == "") {
    alert("The code of country must be filled.");
    code.focus();
    return;
  }
  if (name.val() == "") {
    alert("The name of country must be filled.");
    name.focus();
    return;
  }
  formData.append("name", name.val());
  formData.append("code", code.val());
  formData.append("state", state.is(':checked') ? 1 : 0);
  $("#country-insert-state").html("<img src='../assets/img/loading.gif' />");
  $.ajax({
    type: "POST",
    url: "ajax/country/insert.php",
    data: formData,
    contentType: false,
    processData: false,
    cache: false,
    success: function (result) {
      try {
        if (result == null) return;
        console.log(result);
        if (result == "1") toastr.success("Country was inserted successful");
        else toastr.error(result);
        load();
        $("#country-insert-form")[0].reset();
        $("#country-insert-state").html("");
        $("#country-insert-modal").modal("hide");
      } catch (error) {
        console.log(error);
      }
    },
  });
};