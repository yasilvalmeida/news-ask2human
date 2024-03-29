var last_category = "all",
  country_code = "",
  country_name = "",
  country_flag = "",
  paginationIndex = 1,
  paginationItemPerIndex = 10,
  total = 0,
  countries = null,
  categories = null,
  short = 20,
  long = 50;
$(() => {
  loadCategories();
  loadCountries();
});
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
          country_code = country.code.toLowerCase();
          country_flag = country_code == "ch" ? "cn" : (country_code == "cn" ? "ch" : country_code);
          country_name = country.name;
          found = true;
        }
      });
      if (found) {
        $("#all").html(
          "<a href='javascript:loadByCategory(\"" +
            last_category +
            "\")'><img src='https://www.countryflags.io/" +
            country_flag +
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
  country_code = $("#country-select option:selected").val().toLowerCase();
  country_flag = country_code == "ch" ? "cn" : country_code;
  country_name = $("#country-select option:selected").text();
  $("#all").html(
    "<a href='javascript:loadByCategory(\"" +
      last_category +
      "\")'><img src='https://www.countryflags.io/" +
      country_flag +
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
        var data = JSON.parse(result);
        total = data.total;
        console.log(total);
        paginationDraw();
        loadByIndex(category);
      } catch (error) {
        console.log(error);
      }
    },
  });
};
paginationDraw = () => {
 $("#paginationContent").pagination({
      items: total,
      itemsOnPage: paginationItemPerIndex,
      displayedPages: 3,
      onPageClick: (pageNumber) => {
        paginationIndex = pageNumber;
        loadByIndex(last_category);
        goTop();
      }
  });
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
          var title = article.title.substring(0, 25),
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
subStringByCountryCode = (title) =>{
  if (country_code == "jp" || 
  country_code == "ch" || 
  country_code == "ru" || 
  country_code == "ae")
    return title.substring(0, 25)
  else 
    title.substring(0, 30); 
} 
convertDate = (inputFormat) => {
  var date = inputFormat.split("-");
  return date[2] + "-" + date[1] + "-" + date[0];
};
