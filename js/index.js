var last_category = "all",
  country_code = "",
  country_name = "",
  paginationIndex = 1,
  paginationItemPerIndex = 50,
  countries = null,
  categories = null;
$(() => {
  loadCategories();
  loadCountries();
});
contactUs = () => {
  goBottom();
};
goBottom = () => {
  window.scrollTo(0, document.body.scrollHeight);
};
goTop = () => {
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
};
loadCategories = () => {
  var formData = new FormData(),
    categoryContent = $("#categoryContent");
  categoryContent.html("<img src='assets/img/loading.gif' />");
  $.ajax({
    type: "post",
    url: "ajax/load-category.php",
    data: formData,
    contentType: false,
    processData: false,
    cache: false,
    success: function (result) {
      try {
        var data = JSON.parse(result),
          htmlCategory = "";
        categories = data.categories;
        $.each(data.categories, (i, category) => {
          if (category.code == "all") {
            htmlCategory +=
              "<span id='" +
              category.code +
              "' class='d-inline-block mx-3 py-1 position-relative' style='font-weight: bold;'><a href='javascript:loadByCategory(\"" +
              category.code +
              "\")'></a></span>";
          } else {
            htmlCategory +=
              "<span id='" +
              category.code +
              "' class='d-inline-block mx-3 py-1 position-relative' style='font-weight: bold;'><a href='javascript:loadByCategory(\"" +
              category.code +
              "\")'>" +
              category.name +
              "</a></span>";
          }
        });
        categoryContent.html(htmlCategory);
      } catch (error) {
        console.log(error);
      }
    },
  });
};
loadCountries = () => {
  var formData = new FormData(),
    countryContent = $("#countryContent");
  countryContent.html("<img src='assets/img/loading.gif' />");
  $.ajax({
    type: "post",
    url: "ajax/load-country.php",
    data: formData,
    contentType: false,
    processData: false,
    cache: false,
    success: function (result) {
      try {
        var data = JSON.parse(result),
          htmlCountry =
            "<select id='country-select' style='margin-left:10px;' class='form-control'>";
        countries = data.countries;
        $.each(data.countries, (i, country) => {
          htmlCountry +=
            '<option value="' +
            country.code +
            '">' +
            country.name +
            "</option>";
        });
        htmlCountry += "</select>";
        countryContent.html(htmlCountry);
        getUserCountry();
      } catch (error) {
        console.log(error);
      }
    },
  });
};
getUserCountry = () => {
  /*
  var countryCodeValueStored = getCookie(cookieName);
  // Check if this product was rated by some other client to add previous rating
  if (countryCodeValueStored) {
    delCookie(cookieName);
    setCookie(cookieName, cookieValueStored + ',' + logged_username);
  }
  else
    setCookie(cookieName, logged_username);
    */
  $.get(
    "https://ipinfo.io",
    (response) => {
      var found = false;
      $.each(countries, (i, country) => {
        if (response.country.toLowerCase() == country.code.toLowerCase()) {
          country_id = country.id;
          country_code = country.code;
          country_name = country.name;
          found = true;
        }
      });
      if (found) {
        alert(country_code);
        $("#all").html(
          "<a href='javascript:loadByCategory(\"" +
            last_category +
            "\")'><img src='https://www.countryflags.io/" +
            country_code +
            "/shiny/64.png' />" +
            country_name +
            "</a>"
        );
        loadNews();
      } else {
        $("#country-modal-paragraph").html(
          "We apologize for any inconvenience, but we are unable to provide news from <b>" +
            response.region +
            "</b>. Please choose another country in the drop down list."
        );
        $("#countryModal").modal("show");
      }
    },
    "jsonp"
  );
};
selectCountry = () => {
  country_code = $("#country-select option:selected").val();
  country_name = $("#country-select option:selected").text();
  $("#all").html(
    "<a href='javascript:loadByCategory(\"" +
      last_category +
      "\")'><img src='https://www.countryflags.io/" +
      country_code +
      "/shiny/64.png' />" +
      country_name +
      "</a>"
  );

  $("#countryModal").modal("hide");
  loadNews();
};
loadNews = () => {
  loadByCategory(last_category);
};
loadByCategory = (category) => {
  paginationIndex = 1;
  $("#" + last_category).removeClass("active");
  $("#" + category).addClass("active");
  last_category = category;
  computePageGroup(category);
};
computePageGroup = (category) => {
  var category_id = -1,
    country_id = -1;
  $.each(categories, (i, c) => {
    if (category == c.code) category_id = c.id;
  });
  $.each(countries, (i, c) => {
    if (country_code == c.code) country_id = c.id;
  });
  var formData = new FormData();
  formData.append("categoryId", category_id);
  formData.append("countryId", country_id);
  $.ajax({
    type: "post",
    url: "ajax/count-top-headline-news.php",
    data: formData,
    contentType: false,
    processData: false,
    cache: false,
    success: function (result) {
      try {
        var data = JSON.parse(result),
          total = data.total;
        //console.log(total);
        paginationGroup = Math.ceil(total / paginationItemPerIndex);
        paginationDraw();
        loadByIndex(category);
      } catch (error) {
        console.log(error);
      }
    },
  });
};
paginationDraw = () => {
  var htmlPagination =
    '<nav style="margin-left: 50px; margin-top: 20px"><ul class="pagination"><li class="page-item"><a class="page-link" href="javascript:loadPrev()" aria-label="Previous"><span aria-hidden="true"><i class="fas fa-arrow-alt-circle-left"></i></span></a></li>';
  for (var i = 1; i <= paginationGroup; i++) {
    if (paginationIndex == i)
      htmlPagination +=
        '<li class="page-item active"><a class="page-link" href="javascript:loadAt(' +
        i +
        ')">' +
        i +
        "</a></li>";
    else
      htmlPagination +=
        '<li class="page-item"><a class="page-link" href="javascript:loadAt(' +
        i +
        ')">' +
        i +
        "</a></li>";
  }
  htmlPagination +=
    '<li class="page-item"><a class="page-link" href="javascript:loadNext()" aria-label="Next"><span aria-hidden="true"><i class="fas fa-arrow-circle-right"></i></span></a></li></ul></nav>';
  $("#paginationContent").html(htmlPagination);
};
loadByIndex = (category) => {
  var formData = new FormData(),
    newsContent = $("#newsContent"),
    category_id = -1,
    country_id = -1;
  $.each(categories, (i, c) => {
    if (category == c.code) category_id = c.id;
  });
  $.each(countries, (i, c) => {
    if (country_code == c.code) country_id = c.id;
  });
  //alert(paginationIndex);
  formData.append("categoryId", category_id);
  formData.append("countryId", country_id);
  formData.append("paginationIndex", paginationIndex);
  formData.append("paginationItemPerIndex", paginationItemPerIndex);
  newsContent.html("<img src='assets/img/loading.gif' />");
  $.ajax({
    type: "post",
    url: "ajax/load-top-headline-news.php",
    data: formData,
    contentType: false,
    processData: false,
    cache: false,
    success: function (result) {
      try {
        var data = JSON.parse(result).articles,
          htmlContent = "";
        $.each(data, (i, article) => {
          var title = article.title,
            publishedAt = convertDate(article.date),
            source = article.source,
            urlToImage = article.image,
            url = article.url;
          htmlContent +=
            '<div class="col-md-6 col-lg-4 filtr-item" data-category="' +
            category +
            '"><div class="card border-dark"><div class="card-header bg-dark text-light"><h5 class="m-0">' +
            title +
            '</h5><h6 class="m-0">' +
            publishedAt +
            '</h6></div><img style="height: 230px" src="' +
            urlToImage +
            '" /><div style="padding-top: 0px; padding-left: 20px; padding-bottom: 0px;"><b>Source: </b>' +
            source +
            '</div><div class="d-flex card-footer"><a href="' +
            url +
            '" target="_blank" class="btn btn-dark btn-sm" type="button"><i class="fa fa-eye"></i>&nbsp;Read more</a></div></div></div>';
        });
        newsContent.html(htmlContent);
      } catch (error) {
        console.log(error);
      }
    },
  });
};
loadPrev = () => {
  if (paginationIndex > 1) {
    paginationIndex--;
    paginationDraw();
    loadByIndex(last_category);
    goTop();
  }
};
loadAt = (num) => {
  paginationIndex = num;
  paginationDraw();
  loadByIndex(last_category);
  goTop();
};
loadNext = () => {
  if (paginationIndex < paginationGroup) {
    paginationIndex++;
    paginationDraw();
    loadByIndex(last_category);
    goTop();
  }
};
convertDate = (inputFormat) => {
  var date = inputFormat.split("-");
  return date[2] + "-" + date[1] + "-" + date[0];
};
