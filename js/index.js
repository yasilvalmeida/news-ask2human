$(() => {
  getGoogleNews();
});
getGoogleNews = () => {
  var formData = new FormData(),
    button = $("#button"),
    newsContent = $("#newsContent");
  button.html("<img src='img/loading.gif' />");
  newsContent.html("");
  //formData.append("id", 1);
  $.ajax({
    type: "get",
    url: "ajax/news-loader.php",
    data: formData,
    contentType: false,
    processData: false,
    cache: false,
    success: function (result) {
      try {
        button.html(
          '<a href="javascript:checkPNR()" class="btn btn-primary">Check Status</a>'
        );
        var data = JSON.parse(result);
        if (data.status === "ok") {
          var htmlContent = "<ul>";
          $.each(data.articles, (i, article) => {
            var date = article.publishedAt.substring(0, 10);
            htmlContent +=
              "<li><a href='" +
              article.url +
              "' target='_blank'>" +
              date +
              " - " +
              article.title +
              "</a></li>";
          });
          htmlContent += "</ul>";
          newsContent.html(htmlContent);
        }
      } catch (error) {
        console.log(error);
      }
    },
  });
};
