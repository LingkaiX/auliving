<?php get_header(); ?>
<main>
    <button onclick="jQuery('#comment-form').focus();">focus</button>
<header style="background-color:blue;height:200px">header</header>
<form method="post" id="comment-form" class="comment-form" action="http://localhost/wp-json/wp/v2/comments" onsubmit="return submitComment(this)" onfocus="console.log('focus',this);">
    <div contenteditable="true" class="textarea-mirror" id="textarea-mirror"></div>
    <textarea name="content" autocomplete="off" class="input-cotent"></textarea>
    <input type="text" name="author_name" placeholder="名字" autocomplete="off" value="不知名网友" class="input-name">
    <input type="text" name="author_email" placeholder="邮箱" autocomplete="off" value="who@im.com" class="input-email">

    <input type="hidden" name="post" value="854">
    <input type="hidden" name="parent" value="0">
    <input type="hidden" name="meta[refer_info_name]" value="aname">
    <input type="hidden" name="meta[refer_info_id]" value="2333">
    <button type="submit" class="search-submit">Reply</button>
</form>
<style>
    #mirror{
        width:300px;
    }
    .input-cotent,
    .input-name,
    .input-email{
        display:none;
    }
</style>
<script>
function submitComment(form){
    var s=jQuery(form).children(".textarea-mirror").html();
    if(s){
        var r=s.replace(new RegExp('<\/div><div>','gi'), "\n");
        jQuery("#ta").val(r);
        return true;
    }
    return false;
}



jQuery(document).ready(function($){
    jQuery("#mirror").bind('input', function(e){
        var s=jQuery(this).text()
        // jQuery("#mirror").html(s);
        console.log(s);
    })
});
function strip(html)
{
   var tmp = document.createElement("DIV");
   tmp.innerHTML = html;
   return tmp.textContent || tmp.innerText || "";
}
// jQuery(".comment-form").submit(function(e) {
//     var s=jQuery("#textarea-mirror").html();
//     if(s) var r=s.replace(new RegExp('<\/div><div>','gi'), "\n");
//     jQuery("#ta").val(r);
//     console.log(e)
//     return false;
// })
</script>

</main>
<?php get_footer(); ?>