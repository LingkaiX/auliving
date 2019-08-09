<section class="comment-section">
    <div id="comment-form-template" style="display: none;">
        <form method="post" class="comment-form" action="<?php echo get_site_url().'/wp-json/wp/v2/comments'; echo isTCN()?'?variant=zh-tw':'';?>" onsubmit="return submitComment(this)">
            <div contenteditable="true" data-text="<?php echo '说点什么吧！'; ?>" class="textarea-mirror" id="textarea-mirror"></div>
            <textarea name="content" autocomplete="off" class="input-content"></textarea>
            <input type="text" name="author_name" placeholder="名字" autocomplete="off" maxlength="16" class="input-name">
            <input type="email" name="author_email" placeholder="邮箱" autocomplete="off" maxlength="48" class="input-email">

            <input type="hidden" name="post" value="<?php echo get_query_var('p',0); ?>">
            <input type="hidden" name="parent" value="0">
            <input type="hidden" name="meta[refer_info_name]" value="">
            <input type="hidden" name="meta[refer_info_id]" value="">
            <p class="notice"><a target="_blank" href="<?php echo getBaseUrl().'/comunity-policy' ; ?>">社区准则？</a></p>
            <p class="notice">欢迎网友畅所欲言、各抒己见，请理性交流、互相尊重，严禁互相恶意人身攻击、谩骂等，澳洲生活网保留删除脏话、侮辱等恶意留言的权利。</p>
            <button type="submit" class="search-submit">发表评论</button>
        </form>
    </div>
    <div id="comments-outer" data-offset=0 data-more=false>
        <div id="comments"></div>
        <div class="open-comments" onclick="openComments()"><?php echo "展开评论"; ?></div>
        <div disabled class="load-more-comments loaded" onclick="loadMoreComments()"><?php echo "更多评论"; ?></div>
    </div>
    <div id="comment-form"></div>
</section>
<script>
    var PostID=<?php echo get_query_var( 'p' ); ?>;
    var commentQueryUrl="<?php echo home_url(); ?>"+"/wp-json/wp/v2/comments?per_page=100&parent=0&order=asc&post="+PostID;
    if(IsTCN) commentQueryUrl=commentQueryUrl+"&variant=zh-tw";
    jQuery(document).ready(function($){
        jQuery.getJSON(commentQueryUrl, function(data){
            if(data.length > 0){
                printCommentHtml(data);
                jQuery("#comments-outer").data("offset", data.length);
                if(data.length == 100){
                    jQuery("#comments-outer").data("more", true);
                }
                if(jQuery("#comments").height()>800){
                    jQuery("#comments-outer").addClass("comments-close");
                }
            }else{
                jQuery("#comments-outer").addClass("comments-none");
            }

        }).fail(function() {
            console.log("Network error, pleae try again");
        }).always(function() {
        });
        if(getStorageItem("username")) jQuery("#comment-form-template").find(".input-name").val(getStorageItem("username"));
        if(getStorageItem("usermail")) jQuery("#comment-form-template").find(".input-email").val(getStorageItem("usermail"));
        initialNoticeHtml=jQuery("#comment-form-template").find(".notice").clone();
        jQuery("#comment-form").append(jQuery("#comment-form-template").find(".comment-form").clone());
    });
    function submitComment(form){
        if(jQuery(form).children(".input-name").val().length>32){
            jQuery(form).children(".notice").text("<?php echo "*你的名字太长啦！"; ?>");
            jQuery(form).children(".input-name").addClass("animate-shake").addClass("error-field");
            setTimeout(function(){ jQuery(form).children(".input-name").removeClass("animate-shake"); }, 2000);
            return false;
        }else{
            jQuery(form).children(".input-name").removeClass("error-field");
        }
        if(jQuery(form).children(".input-email").val().length>48){
            jQuery(form).children(".notice").text("<?php echo "*你的邮箱地址有点长啊"; ?>");
            jQuery(form).children(".input-email").addClass("animate-shake").addClass("error-field");
            setTimeout(function(){ jQuery(form).children(".input-email").removeClass("animate-shake"); }, 2000);
            return false;
        }else{
            jQuery(form).children(".input-email").removeClass("error-field");
        }
        var expiredDate=new Date();
        expiredDate.setDate(expiredDate.getDate()+30);
        if(jQuery(form).children(".input-name").val()){
            setStorageItem("username",jQuery(form).children(".input-name").val());
        }else{
            jQuery(form).children(".input-name").val("<?php echo "不知名网友"; ?>")
        }
        if(jQuery(form).children(".input-email").val()){
            setStorageItem("usermail",jQuery(form).children(".input-email").val());
        }else{
            jQuery(form).children(".input-email").val("who@im.com")
        }
        if(!validateEmail(jQuery(form).children(".input-email").val())){
            jQuery(form).children(".notice").text("<?php echo "*你的邮箱地址好像有点问题？"; ?>");
            jQuery(form).children(".input-email").addClass("animate-shake").addClass("error-field");
            setTimeout(function(){ jQuery(form).children(".input-email").removeClass("animate-shake"); }, 2000);
            return false;
        }
        var s=jQuery(form).children(".textarea-mirror").html();
        if(s.trim()==""){
            jQuery(form).children(".notice").text("<?php echo "*你想说点什么？"; ?>");
            jQuery(form).children(".textarea-mirror").addClass("animate-shake").addClass("error-field");
            setTimeout(function(){ jQuery(form).children(".textarea-mirror").removeClass("animate-shake"); }, 2000);
            return false;
        }else{
            jQuery(form).children(".textarea-mirror").removeClass("error-field");
        }
        if(s.length>1024){
            jQuery(form).children(".notice").text("<?php echo "*请请请长话短说啦"; ?>");
            jQuery(form).children(".textarea-mirror").addClass("animate-shake").addClass("error-field");
            setTimeout(function(){ jQuery(form).children(".textarea-mirror").removeClass("animate-shake"); }, 2000);
            return false;
        }else{
            jQuery(form).children(".textarea-mirror").removeClass("error-field");
        }
        jQuery(form).children(".notice").text("").append(initialNoticeHtml);
        //在这里转圈圈
        //console.log(s);
        if(s){
            s=s.replace("<div>", "\n");
            s=s.replace(new RegExp('<\/div><div>','gi'), "\n");
            //console.log(s);
            jQuery(form).children(".input-content").val(s);
            jQuery.post(jQuery(form).attr("action"), jQuery(form).serialize(), null,"json")
                .done(function(comment) {
                    //加入评论
                    if(comment.parent==0) var str='<div class="comment-and-subcomment animate-flash-out"><div id="comment-'+comment.id+'" class="comment normal-comment';
                    else var str='<div id="comment-'+comment.id+'" class="comment normal-comment subcomment animate-flash-out';
                    str+='"><img class="portrait" src='+comment.author_avatar_urls["96"]+'><div class="comment-content"><span class="author-name">'+comment.author_name+'</span><span class="date-info">'
                        +comment.date_info+'</span><div>'+comment.content.rendered+'</div><div class="thumb-up-and-down"><span id="thumbup-'+comment.id+'" onclick="thumbUpComment(this,'+comment.id
                        +')" class="thumb-up"><i class="far fa-thumbs-up"></i><em>0</em></span><span id="thumbdown-'+comment.id+'" onclick="thumbDownComment(this,'+comment.id
                        +')" class="thumb-down"><i class="far fa-thumbs-down"></i><em>0</em></span></div><div class="close-open"><button onclick="';
                    if(comment.parent==0) str+='openCommentForm('+comment.id+','+comment.id+')';
                    else str+='openCommentForm('+comment.id+','+comment.parent+",'"+comment.author_name+"')";
                    str+='"><?php echo "回复"; ?></button></div></div></div>';
                    //显示评论，关闭表格
                    if(comment.parent==0){
                        str+='</div>';
                        jQuery("#comments").append(str);
                        jQuery("#comment-form .input-content").val("");
                        jQuery("#comment-form .textarea-mirror").text("").html("");

                    }else{
                        jQuery("#comment-"+comment.parent).parent().append(str);
                        if(comment.meta.hasOwnProperty('refer_info')&&comment.meta.refer_info.hasOwnProperty('comment_id'))
                            jQuery("#comment-"+comment.meta.refer_info.comment_id+" .close-open button").trigger( "click" );
                        else jQuery("#comment-"+comment.parent+" .close-open button").trigger( "click" );
                    }
                    jQuery("#comments-outer").removeClass("comments-none");
                    //console.log( "second success",comment );
                })
                .fail(function() {
                    jQuery(form).children(".notice").text("<?php echo "*好像发生了一点错误？"; ?>");
                    //console.log( "error" );
                })
                .always(function() {
                    //停止转圈
                    //console.log( "finished" );
                });
        }
        return false;
    }
    function getStorageItem(key){
        if(window.localStorage){
            return window.localStorage.getItem(key);
        }else{
            return "";
        }
    }
    function setStorageItem(key, value){
        if(window.localStorage){
            window.localStorage.setItem(key, value);
            return true;
        }else{
            return false;
        }
    }
    function validateEmail(email) {
		var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,8})?$/;
		if (!emailReg.test( email ) || email == "") return false;
		    else return true;
	}

    function printCommentHtml(data) {
        var commentHtml="";
        jQuery.each(data, function(key, comment) {
            var thumbups=comment.meta.thumb_ups==""?"0":comment.meta.thumb_ups;
            var thumbdowns=comment.meta.thumb_downs==""?"0":comment.meta.thumb_downs;
            var thumbState=" normal-comment";
            if((thumbups-thumbdowns)>10) thumbState=" good-comment";
            else if((thumbups-thumbdowns)<-10) thumbState=" bad-comment";
            commentHtml=commentHtml+'<div class="comment-and-subcomment"><div id="comment-'+comment.id+'" class="comment'+thumbState+'"><img class="portrait" src='
                +comment.author_avatar_urls["96"]+'><div class="comment-content"><span class="author-name">'+comment.author_name+'</span><span class="date-info">'+comment.date_info+'</span><div>'
                +comment.content.rendered+'</div><div class="thumb-up-and-down"><span id="thumbup-'+comment.id+'" onclick="thumbUpComment(this,'+comment.id
                +')" class="thumb-up"><i class="far fa-thumbs-up"></i><em>'+thumbups+'</em></span><span id="thumbdown-'+comment.id+'" onclick="thumbDownComment(this,'+comment.id+')" class="thumb-down"><i class="far fa-thumbs-down"></i><em>'+thumbdowns
                +'</em></span></div><div class="close-open"><button onclick="openCommentForm('+comment.id+','+comment.id+')"><?php echo "回复"; ?></button></div></div></div>';
            jQuery.each(comment.children, function(key, subcomment) {
                var thumbups=subcomment.meta.thumb_ups==""?"0":subcomment.meta.thumb_ups;
                var thumbdowns=subcomment.meta.thumb_downs==""?"0":subcomment.meta.thumb_downs;
                var thumbState=" normal-comment";
                if((thumbups-thumbdowns)>10) thumbState=" good-comment";
                else if((thumbups-thumbdowns)<-10) thumbState=" bad-comment";
                var referHtml="";
                if(subcomment.meta.hasOwnProperty('refer_info')&&subcomment.meta.refer_info.hasOwnProperty('author_name')&&subcomment.meta.refer_info.hasOwnProperty('comment_id')){
                    referHtml='<span class="refered-author" onclick=getReferDetail('+subcomment.comment_ID+','+subcomment.meta.refer_info.comment_id+')>@'+subcomment.meta.refer_info.author_name+' </span>';
                }else{

                }
                commentHtml=commentHtml+'<div id="comment-'+subcomment.comment_ID+'" class="comment subcomment'+thumbState+'" data-parent="" data-commentid="" data-author=""><img class="portrait" src='
                    +subcomment.author_avatar_url+'><div class="comment-content"><span class="author-name">'+subcomment.comment_author+'</span><span class="date-info">'+subcomment.date_info+'</span><div>'
                    +referHtml+subcomment.comment_content+'</div><div class="thumb-up-and-down"><span id="thumbup-'+subcomment.comment_ID+'" onclick="thumbUpComment(this,'+subcomment.comment_ID
                    +')" class="thumb-up"><i class="far fa-thumbs-up"></i><em>'+thumbups+'</em></span><span id="thumbdown-'+subcomment.comment_ID+'" onclick="thumbDownComment(this,'+subcomment.comment_ID+')" class="thumb-down"><i class="far fa-thumbs-down"></i><em>'+thumbdowns
                    +'</em></span></div><div class="close-open"><button onclick="openCommentForm('+subcomment.comment_ID+','+comment.id+",'"+subcomment.comment_author+"')"+'"><?php echo "回复"; ?></button></div></div></div>';
            });
            commentHtml=commentHtml+"</div>";
        });

        var html=jQuery.parseHTML(commentHtml);
        var sUp=getStorageItem("thumbups");
        if(sUp){
            sUp=JSON.parse(sUp);
            sUp.forEach(function(value){
                jQuery(html).find("#thumbup-"+value).addClass("done");
            });
        }
        sDown=getStorageItem("thumbdowns");
        if(sDown){
            sDown=JSON.parse(sDown);
            sDown.forEach(function(value){
                jQuery(html).find("#thumbdown-"+value).addClass("done");
            });
        }
        jQuery("#comments").append(html);
    }
    function openCommentForm(cid, parent=0, referName=""){
        var form=jQuery("#comment-form-template").find(".comment-form").clone();
        if(parent){
            form.find("input[name='parent']").val(parent);
            if(parent!=0&&cid!=parent){
                form.find("input[name='meta[refer_info_name]']").val(referName);
                form.find("input[name='meta[refer_info_id]']").val(cid);
            }
        }
        jQuery("#comment-"+cid).children(".comment-content").append(form);
        if(referName) var button='<button onclick="closeCommentForm('+cid+','+parent+",'"+referName+"')"+'"><?php echo '取消'; ?></button>';
            else var button='<button onclick="closeCommentForm('+cid+','+parent+')"><?php echo '取消'; ?></button>';
        jQuery("#comment-"+cid).children(".comment-content").children(".close-open").children("button").replaceWith(button);
    }
    function closeCommentForm(cid, parent=0, referName=""){
        jQuery("#comment-"+cid).children(".comment-content").children(".comment-form").remove();
        if(referName) var button='<button onclick="openCommentForm('+cid+','+parent+",'"+referName+"')"+'"><?php echo '回复'; ?></button>';
            else var button='<button onclick="openCommentForm('+cid+','+parent+')"><?php echo '回复'; ?></button>';
        jQuery("#comment-"+cid).children(".comment-content").children(".close-open").children("button").replaceWith(button);
    }
    function thumbUpComment(e, commentID){
        if(!jQuery(e).hasClass("done")){
            jQuery.getJSON("<?php echo home_url(); ?>/wp-json/aulv/v1/comments/"+commentID+"/thumbup");
            jQuery(e).addClass("done");
            jQuery(e).children("em").text(parseInt(jQuery(e).children("em").text())+1);
            var s=getStorageItem("thumbups");
            if(s){
                s=JSON.parse(s);
                if(s.length>=100) s.spilce(0,1);
                console.log(s)
                s.push(commentID);
                setStorageItem("thumbups",JSON.stringify(s));
            }else{
                s=[commentID];
                setStorageItem("thumbups",JSON.stringify(s));
            }
        }
    }
    function thumbDownComment(e, commentID){
        if(!jQuery(e).hasClass("done")){
            jQuery.getJSON("<?php echo home_url(); ?>/wp-json/aulv/v1/comments/"+commentID+"/thumbdown");
            jQuery(e).addClass("done");
            jQuery(e).children("em").text(parseInt(jQuery(e).children("em").text())+1);
            var s=getStorageItem("thumbdowns");
            if(s){
                s=JSON.parse(s);
                if(s.length>=100) s.spilce(0,1);
                s.push(commentID);
                setStorageItem("thumbdowns",JSON.stringify(s));
            }else{
                s=[commentID];
                setStorageItem("thumbdowns",JSON.stringify(s));
            }
        }
    }
    function getReferDetail(clickedCommentId, referedCommentId){
        //TODO
    }
    function openComments(){
        if(jQuery("#comments-outer").data("offset")==100){
            jQuery("#comments-outer").addClass("comments-open").removeClass("comments-close");
        }
        else{
            jQuery("#comments-outer").removeClass("comments-close").height('auto');
        }
    }
    function loadMoreComments(){
        //jQuery("#comments-outer").data("offset", data.length);
        if(jQuery("#comments-outer").data("more")){
            jQuery("#comments-outer").data("more", false);
            jQuery("#comments-outer .load-more-comments").addClass("loading").removeClass('loaded');
            jQuery.getJSON(commentQueryUrl+"&offset="+jQuery("#comments-outer").data("offset"), function(data){
                if(data.length > 0){
                    printCommentHtml(data);
                    jQuery("#comments-outer").data("offset", jQuery("#comments-outer").data("offset")+data.length);
                    if(data.length == 100){
                        jQuery("#comments-outer").data("more", true);
                    }
                }
            }).fail(function() {
                console.log("Network error, pleae try again");
                jQuery("#comments-outer").data("more", true);

            }).always(function() {
                if(!jQuery("#comments-outer").data("more")) jQuery("#comments-outer .load-more-comments").hide();
                jQuery("#comments-outer .load-more-comments").removeClass("loading").addClass('loaded');
            });
        }
    }
</script>
