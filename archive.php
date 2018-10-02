<?php get_header(); ?>
<main>
<section class="first-section container">
    <div class="item left">
    <?php
        if ( have_posts() ){
            while ( have_posts() ) : the_post();
                include 'snippet/listed-post.php';
            endwhile;
        }
    ?>
    </div>
    <div class="item right">
        <?php include 'snippet/top-post-list.php'; ?>
    </div>
</section>
<section class="extended-section container">
    <div class="item left">
    <div id="more-articles-here"></div>
    <div id="load-more-articles-outer">
        <button id="load-more-articles" data-offset="<?php echo get_option('posts_per_page', 10); ?>" data-nomore="<?php echo $wp_query->max_num_pages==1?'true':'false'; ?>" data-loading="false">更多文章</button>
    </div>
    </div>
    <div class="item right"></div>
</section>
<script>
<?php
    $termId=get_query_var('cat');
    $termChildren=get_term_children($termId, 'category' );
    if(!empty($termChildren)) {
        foreach($termChildren as $id) $termId=$termId.','.$id;
    }
?>
    var categories = '<?php echo $termId; ?>';
    var variant = IsTCN ? "&variant=zh-tw" : "";
    var perPage=10;
    var queryUrl = "<?php echo home_url(); ?>" + "/wp-json/wp/v2/posts?categories="+categories+"&per_page=" + perPage + variant;
    jQuery(document).ready(function($){
        if(jQuery("#load-more-articles").data('nomore')){
            jQuery("#load-more-articles-outer").hide();
            jQuery("#load-more-articles").attr("disabled", true);
        }else{
            jQuery("#load-more-articles").click(loadMoreArticles("#load-more-articles", "#more-articles-here", perPage, queryUrl, "<?php echo "走着"; ?>", "<?php echo "还有"; ?>"));
        }
        jQuery(window).scroll(function(){
        　　var scrollTop = jQuery(this).scrollTop();
        　　var scrollHeight = jQuery(document).height();
        　　var windowHeight = jQuery(this).height();
            // if((scrollHeight+100+windowHeight)>=jQuery('#load-more-articles').offset().top){
        　　if(scrollTop + windowHeight == scrollHeight){
                console.log("已经到最底部了！");
                if(!jQuery("#load-more-articles").data("nomore")&&parseInt(jQuery("#load-more-articles").data("offset"))<50)
                    loadMoreArticles("#load-more-articles", "#more-articles-here", perPage, queryUrl, "<?php echo "走着"; ?>", "<?php echo "还有"; ?>");
        　  }
        });
    });
</script>
</main>
<?php get_footer(); ?>
