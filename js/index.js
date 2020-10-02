var last_category = "all",
  country = "pt",
  region = "Lisboa",
  paginationIndex = 1,
  paginationItemPerIndex = 10;
$(() => {
  $.get(
    "https://ipinfo.io",
    (response) => {
      country = checkCountry(response.country);
      region = response.region;
      $("#all").html(
        "<a href='javascript:loadByCategory(\"" +
          last_category +
          "\")'>" +
          region +
          "</a>"
      );
      loadNews();
    },
    "jsonp"
  );
});
checkCountry = (country) => {
  //ae ar at au be bg br ca ch cn co cu cz de eg fr gb gr hk hu id ie il in it jp kr lt lv ma mx my ng nl no nz ph pl pt ro rs ru sa se sg si sk th tr tw ua us ve za
  if (country.toLowerCase() == "st") return "in";
  else return country;
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
  var formData = new FormData();
  formData.append("category", category.toLowerCase());
  formData.append("country", country.toLowerCase());
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
          total = data.articles.length;
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
    newsContent = $("#newsContent");
  formData.append("category", category.toLowerCase());
  formData.append("country", country.toLowerCase());
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
        var data = JSON.parse(result),
          total = data.articles.length,
          htmlContent = "";
        if (data.status === "ok") {
          if (total == 0) {
            newsContent.html("No news for " + region);
            alert("No news for " + region);
          }
          $.each(data.articles, (i, article) => {
            var title = article.title.substring(0, 50) + " ...",
              publishedAt = convertDate(article.publishedAt.split("T")[0]),
              source = article.source.name,
              urlToImage = article.urlToImage,
              url = article.url;
            if (urlToImage != null) {
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
            }
          });
          newsContent.html(htmlContent);
        } else {
          newsContent.html(data.resp);
        }
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
  }
};
loadAt = (num) => {
  paginationIndex = num;
  paginationDraw();
  loadByIndex(last_category);
};
loadNext = () => {
  if (paginationIndex < paginationGroup) {
    paginationIndex++;
    paginationDraw();
    loadByIndex(last_category);
  }
};
convertDate = (inputFormat) => {
  var date = inputFormat.split("-");
  return date[2] + "-" + date[1] + "-" + date[0];
};
