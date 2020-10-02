var last_category = "all",
  country = "pt",
  region = "Lisboa";
$(() => {
  $.get(
    "https://ipinfo.io",
    (response) => {
      country = response.country;
      region = response.region;
      $("#all").html(region);
      loadNews();
    },
    "jsonp"
  );
});
loadNews = () => {
  loadByCategory(last_category);
};
loadByCategory = (category) => {
  $("#" + last_category).removeClass("active");
  $("#" + category).addClass("active");
  last_category = category;
  var formData = new FormData(),
    newsContent = $("#newsContent");
  formData.append("category", category.toLowerCase());
  formData.append("country", country.toLowerCase());
  newsContent.html("<img src='assets/img/loading.gif' />");
  $.ajax({
    type: "post",
    url: "ajax/news-loader.php",
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
            alert("No news for " + region);
          }
          var htmlContent = "";
          $.each(data.articles, (i, article) => {
            var title = article.title.substring(0, 50) + " ...",
              publishedAt = article.publishedAt
                .replace("T", " at ")
                .replace("Z", ""),
              source = article.source.name,
              urlToImage = article.urlToImage,
              url = article.url,
              description =
                description != null
                  ? article.description.substring(0, 350)
                  : "";
            if (urlToImage != null && description != null) {
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
