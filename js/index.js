var last_category = "all",
  country = "pt",
  region = "Lisboa";
$(() => {
  $.get(
    "https://ipinfo.io",
    (response) => {
      //country = response.country;
      //region = response.region;
      $("#all").html(region);
      loadNews();
    },
    "jsonp"
  );
});
loadNews = () => {
  if (last_category == "all") loadByCountry();
  else loadByCategory(category);
};
loadByCategory = (category) => {
  $("#" + last_category).removeClass("active");
  $("#" + category).addClass("active");
  last_category = category;
  var formData = new FormData(),
    newsContent = $("#newsContent");
  newsContent.html("<img src='assets/img/loading.gif' />");
  category = category.toLowerCase();
  formData.append("category", category);
  $.ajax({
    type: "post",
    url: "ajax/news-loader-by-category.php",
    data: formData,
    contentType: false,
    processData: false,
    cache: false,
    success: function (result) {
      try {
        var data = JSON.parse(result);
        if (data.status === "ok") {
          if (data.articles.length == 0) alert("No news for " + region);
          var htmlContent = "";
          $.each(data.articles, (i, article) => {
            var title = article.title.substring(0, 50) + " ...",
              publishedAt = article.publishedAt
                .replace("T", " at ")
                .replace("Z", ""),
              source = article.source.name,
              urlToImage =
                article.urlToImage != null
                  ? article.urlToImage
                  : "assets/img/ask2human%20news%20logo.png",
              url = article.url,
              description =
                article.description != null
                  ? article.description.substring(0, 350) + " ..."
                  : "No description for this news.";
            htmlContent +=
              '<div class="col-md-6 col-lg-4 filtr-item" data-category="' +
              category +
              '"><div class="card border-dark"><div class="card-header bg-dark text-light"><h5 class="m-0">' +
              title +
              '</h5><h6 class="m-0">' +
              publishedAt +
              '</h6></div><img height="100px" class="img-fluid card-img w-100 d-block rounded-0" src="' +
              urlToImage +
              '" /><div class="card-body"><p class="card-text">' +
              description +
              '</p><p class="card-text"><b>Source: </b>' +
              source +
              '</p></div><div class="d-flex card-footer"><a href="' +
              url +
              '" target="_blank" class="btn btn-dark btn-sm" type="button"><i class="fa fa-eye"></i>&nbsp;Read more</a></div></div></div>';
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
loadByCountry = () => {
  var formData = new FormData(),
    newsContent = $("#newsContent");
  newsContent.html("<img src='assets/img/loading.gif' />");
  formData.append("country", country.toLowerCase());
  $.ajax({
    type: "post",
    url: "ajax/news-loader-by-country.php",
    data: formData,
    contentType: false,
    processData: false,
    cache: false,
    success: function (result) {
      try {
        var data = JSON.parse(result);
        if (data.status === "ok") {
          if (data.articles.length == 0) {
            newsContent.html("No news for " + region);
            return;
          } else {
            var htmlContent = "";
            $.each(data.articles, (i, article) => {
              var title = article.title.substring(0, 50) + " ...",
                publishedAt = article.publishedAt
                  .replace("T", " at ")
                  .replace("Z", ""),
                source = article.source.name,
                urlToImage =
                  article.urlToImage != null
                    ? article.urlToImage
                    : "assets/img/ask2human%20news%20logo.png",
                url = article.url,
                description =
                  article.description != null
                    ? article.description.substring(0, 350) + " ..."
                    : "No description for this news.";
              htmlContent +=
                '<div class="col-md-6 col-lg-4 filtr-item" data-category="' +
                last_category +
                '"><div class="card border-dark"><div class="card-header bg-dark text-light"><h5 class="m-0">' +
                title +
                '</h5><h6 class="m-0">' +
                publishedAt +
                '</h6></div><img height="100px" class="img-fluid card-img w-100 d-block rounded-0" src="' +
                urlToImage +
                '" /><div class="card-body"><p class="card-text">' +
                description +
                '</p><p class="card-text"><b>Source: </b>' +
                source +
                '</p></div><div class="d-flex card-footer"><a href="' +
                url +
                '" target="_blank" class="btn btn-dark btn-sm" type="button"><i class="fa fa-eye"></i>&nbsp;Read more</a></div></div></div>';
            });
            newsContent.html(htmlContent);
          }
        } else {
          newsContent.html(data.resp);
        }
      } catch (error) {
        console.log(error);
      }
    },
  });
};
