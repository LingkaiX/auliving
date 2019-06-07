
<?php get_header(); ?>
<main> 
<?php include 'snippet/side-ads.php';?>
<?php 
    $stickyPosts = get_field( 'sticky_posts', 'category_'.get_category_by_slug( 'top' )->term_id );
    $headSectionQuery = new WP_Query( array( 'category_name' => 'top','posts_per_page' => 8 )  );
    include 'snippet/head-section.php';
    //print_r(get_taxonomy( 'top' ));
?>
<section class="first-section container">
    <aside class="gam-aulv aulv-h1">
        <!-- /21666183985/aulv/aulv-h1 -->
        <div id='div-gpt-ad-1543362254773-0'>
        <script>
        googletag.cmd.push(function() { googletag.display('div-gpt-ad-1543362254773-0'); });
        </script>
        </div>
    </aside>
</section>

<section class="first-section container">
    <div class="item left post-list">
    <?php 
        $firstPage=5; //get_option('posts_per_page', 4);
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
    $stickyColumns = get_field( 'sticky_columns', 'category_'.get_category_by_slug( 'special-column' )->term_id );
    include 'snippet/sticky-column-section.php';
?>
<section class="second-section container">
    <div class="item left post-list">
    <?php 
        $secondPage=19;
        query_posts( array( 'post_type' => 'post', 'post__not_in' =>$headSectionPostIds, 'offset' => $firstPage, 'posts_per_page' => $secondPage ) );
        while (have_posts()) : the_post();
            include 'snippet/listed-post.php';
        endwhile;
    ?>
    </div>
    <div class="item right">
    <?php
        wp_nav_menu( array(
            'theme_location' => 'column-list',
            'menu_class'     => 'column-list',
            'container_class'=> 'column-list-container',
            'depth'          => 1
            ) );
    ?>
    </div>
</section>
<section class="extended-section container">
    <div class="item left">
        <div id="more-articles-here"></div>
    </div>
    <div class="item right"></div>
</section>
<div id="load-more-articles-outer">
    <button id="load-more-articles" data-offset="<?php echo ($firstPage+$secondPage); ?>" data-nomore="false" data-loading="false">
    <span class="loaded">更多文章<span></button>
</div>
<script>
    var variant = IsTCN ? "&variant=zh-tw" : "";
    var perPage=10;
    var queryUrl = "<?php echo home_url(); ?>" + "/wp-json/wp/v2/posts?per_page=" + perPage + "&exclude=" + headSectionPostIds + variant;
    jQuery(document).ready(function($){
        jQuery("#load-more-articles").click(function(){
            loadMoreArticles("#load-more-articles", "#more-articles-here", perPage, queryUrl, '<?php echo '加载中'; ?>', '<?php echo '更多文章'; ?>');
        });

        function loop() {
        　　var scrollTop = jQuery(this).scrollTop();
        　　var scrollHeight = jQuery(document).height();
        　　var windowHeight = jQuery(this).height();
        　　if(scrollTop + windowHeight +160 >= scrollHeight){
                if(!jQuery("#load-more-articles").data("nomore")&&parseInt(jQuery("#load-more-articles").data("offset"))<50)
                    loadMoreArticles("#load-more-articles", "#more-articles-here", perPage, queryUrl, '<?php echo '加载中'; ?>', '<?php echo '更多文章'; ?>');
                //console.log("yes!!!!!!!!!!!!")
            }else{
                //console.log("No")
            }
            requestAnimationFrame( loop );
        }
        loop();
        // var c=0;
        // function loop() {
        //     // Avoid calculations if not needed
        //     console.log(c)
        //     c++;
        //     requestAnimationFrame( loop );
        // }
        // loop();
    });

</script>
</main>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<?php get_footer(); ?>
