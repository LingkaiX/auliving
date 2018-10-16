
<?php get_header(); ?>
<main>    
<?php 
    $stickyPosts = get_field( 'sticky_posts', 'category_'.get_category_by_slug( 'top' )->term_id );
    $headSectionQuery = new WP_Query( array( 'category_name' => 'top','posts_per_page' => 8 )  );
    include 'snippet/head-section.php';
    //print_r(get_taxonomy( 'top' ));
?>
<aside class="gam-aulv aulv-h1">aulv-h1</aside>
<section class="first-section container">
    <div class="item left post-list">
    <?php 
        $firstPage=4; //get_option('posts_per_page', 4);
        query_posts( array( 'post_type' => 'post', 'post__not_in' =>$headSectionPostIds, 'posts_per_page' => $firstPage, 'ignore_sticky_posts' => true ) );
        while (have_posts()) : the_post();
            include 'snippet/listed-post.php';
        endwhile;
    ?>
    </div>
    <div class="item right top-post-list-container">
        <?php include 'snippet/top-post-list.php'; ?>
    </div>
</section>
<?php 
    $stickyColumns = get_field( 'sticky_columns', 'category_'.get_category_by_slug( 'top' )->term_id );
    include 'snippet/sticky-column-section.php';
?>
<section class="second-section container">
    <div class="item left post-list">
    <?php 
        $secondPage=20;
        query_posts( array( 'post_type' => 'post', 'post__not_in' =>$headSectionPostIds, 'offset' => $firstPage, 'posts_per_page' => $secondPage ) );
        while (have_posts()) : the_post();
            include 'snippet/listed-post.php';
        endwhile;
    ?>
    </div>
    <div class="item right"></div>
</section>
<section class="extended-section container">
    <div class="item left">
        <div id="more-articles-here"></div>
        <div id="load-more-articles-outer">
            <button id="load-more-articles" data-offset="<?php echo ($firstPage+$secondPage); ?>" data-nomore="false" data-loading="false">
            <span class="loaded">更多文章<span></button>
        </div>
    </div>
    <div class="item right"></div>
</section>
<script>
    var variant = IsTCN ? "&variant=zh-tw" : "";
    var perPage=10;
    var queryUrl = "<?php echo home_url(); ?>" + "/wp-json/wp/v2/posts?per_page=" + perPage + "&exclude=" + headSectionPostIds + variant;
    jQuery(document).ready(function($){
        jQuery("#load-more-articles").click(function(){
            loadMoreArticles("#load-more-articles", "#more-articles-here", perPage, queryUrl, '<?php echo '加载中'; ?>', '<?php echo '更多文章'; ?>');
        });

        jQuery(window).scroll(function(){
        　　var scrollTop = jQuery(this).scrollTop();
        　　var scrollHeight = jQuery(document).height();
        　　var windowHeight = jQuery(this).height();
        　　if(scrollTop + windowHeight == scrollHeight){
                if(!jQuery("#load-more-articles").data("nomore")&&parseInt(jQuery("#load-more-articles").data("offset"))<50)
                    loadMoreArticles("#load-more-articles", "#more-articles-here", perPage, queryUrl, '<?php echo '加载中'; ?>', '<?php echo '更多文章'; ?>');
        　  }
        });
    });
</script>
</main>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<?php get_footer(); ?>
