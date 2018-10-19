import "./theme.scss";

window.loadMoreArticles = function(
  selector,
  pushTo,
  perPage,
  url,
  loadingString,
  moreString
) {
  var postOffset = parseInt(jQuery(selector).data("offset"));
  var postLoading = jQuery(selector).data("loading");
  var noMorePost = jQuery(selector).data("nomore");
  if (postLoading == false) {
    postLoading = true;
    jQuery(selector).data("loading", postLoading);
    jQuery(selector + " span")
      .text(loadingString)
      .removeClass("loaded")
      .addClass("loading");
    jQuery
      .getJSON(url + "&offset=" + postOffset, function(data) {
        if (data.length > 0) {
          var posts = [];
          jQuery.each(data, function(key, val) {
            var s = "";
            var isEditorsChoice = false;
            jQuery.each(val.categories, function(key, cate) {
              if (cate.slug == "choiceofeditor") isEditorsChoice = true;
            });
            s = isEditorsChoice
              ? '<div class="listed-post-special">'
              : '<div class="listed-post">';
            s +=
              '<a class="cover-img" href="' +
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
          jQuery(selector + " span")
            .text(moreString)
            .addClass("loaded")
            .removeClass("loading");
        }
        if (data.length < perPage) {
          jQuery(selector + "-outer").hide();
          jQuery(selector).attr("disabled", true);
          noMorePost = true;
        }
      })
      .fail(function() {
        jQuery(selector + " span")
          .text(moreString)
          .addClass("loaded")
          .removeClass("loading");
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
      header.css("top", h);
    }
  }
});
