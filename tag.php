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
        <button id="load-more-articles" data-offset="<?php echo get_option('posts_per_page', 10); ?>" data-nomore="<?php echo $wp_query->max_num_pages==1?'true':'false'; ?>" data-loading="false">
        <span class="loaded">更多文章<span></button>
    </div>
    </div>
    <div class="item right"></div>
</section>
<script>
    var variant = IsTCN ? "&variant=zh-tw" : "";
    var perPage=10;
    var queryUrl = "<?php echo home_url(); ?>" + "/wp-json/wp/v2/posts?tags="+<?php echo get_query_var('tag_id'); ?>+"&per_page=" + perPage + variant;
    jQuery(document).ready(function($){
        if(jQuery("#load-more-articles").data('nomore')){
            jQuery("#load-more-articles-outer").hide();
            jQuery("#load-more-articles").attr("disabled", true);
        }else{
            jQuery("#load-more-articles").click(function(){
                loadMoreArticles("#load-more-articles", "#more-articles-here", perPage, queryUrl, "<?php echo '加载中'; ?>", "<?php echo '更多文章'; ?>");
            });
        }
        jQuery(window).scroll(function(){
        　　var scrollTop = jQuery(this).scrollTop();
        　　var scrollHeight = jQuery(document).height();
        　　var windowHeight = jQuery(this).height();
        　　if(scrollTop + windowHeight == scrollHeight){
                if(!jQuery("#load-more-articles").data("nomore")&&parseInt(jQuery("#load-more-articles").data("offset"))<50)
                    loadMoreArticles("#load-more-articles", "#more-articles-here", perPage, queryUrl, "<?php echo '加载中'; ?>", "<?php echo '更多文章'; ?>");
        　  }
        });
    });
</script>
</main>
<?php get_footer(); ?>
