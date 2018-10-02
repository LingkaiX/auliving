import "./theme.scss";

window.loadMoreArticles = function(
  selector,
  pushTo,
  perPage = 10,
  url,
  loadingString,
  moreString
) {
  var postOffset = parseInt(jQuery(selector).data("offset"));
  var postLoading = jQuery(selector).data("loading");
  console.log(postLoading);
  var noMorePost = jQuery(selector).data("nomore");
  if (postLoading == false) {
    postLoading = true;
    jQuery(selector).data("loading", postLoading);
    jQuery(selector).text(loadingString);
    jQuery
      .getJSON(url + "&offset=" + postOffset, function(data) {
        if (data.length > 0) {
          var posts = [];
          jQuery.each(data, function(key, val) {
            var s =
              '<div class="listed-post"><a class="cover-img" href="' +
              val.link +
              '" style="background-image:url(' +
              "'" +
              val.cover_img +
              "'" +
              ');"><div class="post-info"><a href="' +
              val.link +
              '"><h4 class="title">' +
              val.title.rendered +
              '</h4></a><h6 class="sub-title">' +
              val.excerpt.rendered +
              '</h6><span class="date-info">' +
              val.date_info +
              "</span></div></div>";
            posts.push(s);
          });
          jQuery(pushTo).append(posts);
          postOffset += perPage;
          jQuery(selector).data("offset", postOffset);
          jQuery(selector).text(moreString);
        }
        if (data.length < perPage) {
          jQuery(selector + "-outer").hide();
          jQuery(selector).attr("disabled", true);
          noMorePost = true;
        }
      })
      .fail(function() {
        jQuery(selector).text(moreString);
      })
      .always(function() {
        postLoading = false;
        jQuery(selector).data("loading", postLoading);
        jQuery(selector).data("nomore", noMorePost);
      });
  }
};
jQuery(document).ready(function($) {
  jQuery("img").on("dragstart", function(event) {
    event.preventDefault();
  });

  var h = parseInt(jQuery("#wpadminbar").css("height"));
  if (h) {
    var header = jQuery(".body-header");
    if (header) {
      header.css("margin-top", h);
    }
  }
});
