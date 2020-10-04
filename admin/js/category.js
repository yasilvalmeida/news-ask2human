$(() => {
  load();
});
load = () => {
  $("#category-content").html("<img src='../assets/img/loading.gif' />");
  var formData = new FormData();
  $.ajax({
    type: "POST",
    url: "ajax/category/load.php",
    data: formData,
    contentType: false,
    processData: false,
    cache: false,
    success: function (result) {
      try {
        if (result == null) return;
        $("#category-content").html(result);
      } catch (error) {
        console.log(error);
      }
    },
  });
};
update = (category) => {
  $("#category-update-id").val(category.id);
  $("#code").val(category.code);
  $("#name").val(category.name);
  $("#state").prop("checked", category.state == 1 ? true : false);
  $("#category-update-state").html("");
  $("#category-update-modal").modal("show");
};
category_update_async = () => {
  var formData = new FormData(),
    id,
    code,
    name,
    state;
  $("#category-update-form input").each(function (index) {
    var input = $(this);
    if (input.attr("id") == "name") name = input;
    else if (input.attr("id") == "category-update-id") id = input;
    else if (input.attr("id") == "code") code = input;
    else if (input.attr("id") == "state") state = input;
  });
  if (name.val() == "") {
    alert("The name of category must be filled.");
    name.focus();
    return;
  }
  formData.append("id", id.val());
  formData.append("name", name.val());
  formData.append("code", code.val());
  formData.append("state", state.is(':checked') ? 1 : 0);
  $("#category-update-state").html("<img src='../assets/img/loading.gif' />");
  $.ajax({
    type: "POST",
    url: "ajax/category/update.php",
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
        $("#category-update-form")[0].reset();
        $("#category-update-state").html("");
        $("#category-update-modal").modal("hide");
      } catch (error) {
        console.log(error);
      }
    },
  });
};
save = () => {
  $("#category-insert-modal").modal("show");
};
category_insert_async = () => {
  var formData = new FormData(),
    code,
    name,
    state;
  $("#category-insert-form input").each(function (index) {
    var input = $(this);
    if (input.attr("id") == "_name") name = input;
    else if (input.attr("id") == "_code") code = input;
    else if (input.attr("id") == "_state") state = input;
  });
  if (code.val() == "") {
    alert("The code of category must be filled.");
    code.focus();
    return;
  }
  if (name.val() == "") {
    alert("The name of category must be filled.");
    name.focus();
    return;
  }
  formData.append("name", name.val());
  formData.append("code", code.val());
  formData.append("state", state.is(':checked') ? 1 : 0);
  $("#category-insert-state").html("<img src='../assets/img/loading.gif' />");
  $.ajax({
    type: "POST",
    url: "ajax/category/insert.php",
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
        $("#category-insert-form")[0].reset();
        $("#category-insert-state").html("");
        $("#category-insert-modal").modal("hide");
      } catch (error) {
        console.log(error);
      }
    },
  });
};