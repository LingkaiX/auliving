parcelRequire=function(e,r,n,t){var i="function"==typeof parcelRequire&&parcelRequire,o="function"==typeof require&&require;function u(n,t){if(!r[n]){if(!e[n]){var f="function"==typeof parcelRequire&&parcelRequire;if(!t&&f)return f(n,!0);if(i)return i(n,!0);if(o&&"string"==typeof n)return o(n);var c=new Error("Cannot find module '"+n+"'");throw c.code="MODULE_NOT_FOUND",c}p.resolve=function(r){return e[n][1][r]||r};var l=r[n]=new u.Module(n);e[n][0].call(l.exports,p,l,l.exports,this)}return r[n].exports;function p(e){return u(p.resolve(e))}}u.isParcelRequire=!0,u.Module=function(e){this.id=e,this.bundle=u,this.exports={}},u.modules=e,u.cache=r,u.parent=i,u.register=function(r,n){e[r]=[function(e,r){r.exports=n},{}]};for(var f=0;f<n.length;f++)u(n[f]);if(n.length){var c=u(n[n.length-1]);"object"==typeof exports&&"undefined"!=typeof module?module.exports=c:"function"==typeof define&&define.amd?define(function(){return c}):t&&(this[t]=c)}return u}({"1ed9":[function(require,module,exports) {

},{}],"m3VC":[function(require,module,exports) {
"use strict";function e(){var e=window.navigator.userAgent,r=e.indexOf("MSIE ");if(r>0)return parseInt(e.substring(r+5,e.indexOf(".",r)),10);if(e.indexOf("Trident/")>0){var a=e.indexOf("rv:");return parseInt(e.substring(a+3,e.indexOf(".",a)),10)}return!1}require("./theme.scss"),window.loadMoreArticles=function(e,r,a,s,t,n){var i=parseInt(jQuery(e).data("offset")),o=jQuery(e).data("loading"),d=jQuery(e).data("nomore");0==o&&(o=!0,jQuery(e).data("loading",o),jQuery(e+" span").text(t).removeClass("loaded").addClass("loading"),jQuery.getJSON(s+"&offset="+i,function(s){if(s.length>0){var t=[];jQuery.each(s,function(e,r){var a="",s=!1;jQuery.each(r.categories,function(e,r){"choiceofeditor"==r.slug&&(s=!0)}),a=s?'<div class="listed-post-special">':'<div class="listed-post">',a+='<a class="cover-img" href="'+r.link+'" style="background-image:url(\''+r.cover_img+'\');"><div class="post-info"><a href="'+r.link+'"><h4 class="title">'+r.title.rendered+'</h4></a><h6 class="sub-title">'+r.excerpt.rendered+'</h6><span class="date-info">'+r.date_info+"</span></div></div>",t.push(a)}),jQuery(r).append(t),i+=a,jQuery(e).data("offset",i),jQuery(e+" span").text(n).addClass("loaded").removeClass("loading")}s.length<a&&(jQuery(e+"-outer").hide(),jQuery(e).attr("disabled",!0),d=!0)}).fail(function(){jQuery(e+" span").text(n).addClass("loaded").removeClass("loading")}).always(function(){o=!1,jQuery(e).data("loading",o),jQuery(e).data("nomore",d)}))},jQuery(document).ready(function(e){jQuery("img").on("dragstart",function(e){e.preventDefault()});var r=parseInt(jQuery("#wpadminbar").css("height"));if(r){var a=jQuery(".body-header");a&&a.css("top",r)}}),e()&&alert("Sorry, in order to provide a better browsing experience, our website no longer supports IE browsers. Please consider a modern browser, such as Chrome or Firefox. Thank you!");
},{"./theme.scss":"1ed9"}]},{},["m3VC"], null)
//# sourceMappingURL=/theme.map