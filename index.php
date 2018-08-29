
<?php get_header(); ?>
<main>    
<?php 
    $stickyPosts = get_field( 'sticky_posts', 'category_'.get_category_by_slug( 'top' )->term_id );
    $headSectionQuery = new WP_Query( array( 'category_name' => 'top','posts_per_page' => 8 )  );
    include 'snippet/head-section.php';
    //print_r(get_taxonomy( 'top' ));
?>
<section class="first-section container">
    <div class="left post-list">
    <?php 
        $count=0;
        query_posts( array( 'post_type' => 'post', 'post__not_in' =>$headSectionPostIds ) );
        while (++$count<11&&have_posts()) : the_post();
            include 'snippet/listed-post.php';
        endwhile;
    ?>
    </div>
    <div class="right top-post-list-container">
        <?php include 'snippet/listed-post.php'; ?>
    </div>
</section>
<?php 
    $stickyColumns = get_field( 'sticky_columns', 'category_'.get_category_by_slug( 'top' )->term_id );
    include 'snippet/sticky-column-section.php';
?>
<section class="second-section container">
    <div class="left post-list">
    <?php 
        query_posts( array( 'post_type' => 'post', 'post__not_in' =>$headSectionPostIds ) );
        while (have_posts()) : the_post();
            include 'snippet/listed-post.php';
        endwhile;
    ?>
    </div>
    <div class="right"></div>
</section>
<section class="extended-section container">
    <div class="left">
        <div id="more-articles-here"></div>
        <button id="load-more-articles" data-offset="30" data-status="loaded">更多文章</button>
    </div>
    <div class="right"></div>
</section>

<div id="app-article-list" data-offset="1">
    <div class="linkToAuliving" v-for="result in results"  v-cloak>
        <a v-bind:href="result.link" target="_blank" rel="noopener nofollow">{{ decodeHtml(result.title.rendered) }}</a>
        <hr>
    </div>
</div>
<script>
    var isTCN=<?php echo isTCN()?'true':'false'; ?>;
    var postOffset=30;
    var postLoading=false;
    var noMorePost=false;
    function loadMoreArticles(){
        console.log(postLoading, postOffset);
        if(postLoading==false){
            postLoading=true;
            jQuery("#load-more-articles").text("loading");
            var perPage=10;
            var variant=isTCN?'&variant=zh-tw':'';
            var url="<?php echo home_url(); ?>"+"/wp-json/wp/v2/posts?offset="+postOffset+"&per_page="+perPage+"&exclude="+headSectionPostIds+variant;
            jQuery.getJSON( url, function( data ) {
                if(data.length > 0){
                    var posts = [];
                    jQuery.each( data, function( key, val ) {
                        var s=`<div class="listed-post"><a href="`+val.link+`">
                        <img width="320" height="180" src=`+val.cover_img+` class="cover-img wp-post-image">
                        </a><div class="post-info"><h4>`+val.title.rendered+`</h4><h6 class="sub-title">`+val.excerpt.rendered+`</h6><span>`+val.date_info+`</span></div></div>`;
                        posts.push(s);
                    });
                    jQuery("#more-articles-here" ).append(posts);
                    postOffset+=perPage;
                    jQuery("#load-more-articles").text('更多文章');
                }else{
                    jQuery("#load-more-articles").text('no more post');
                    jQuery("#load-more-articles").attr('disabled',true);
                    noMorePost=true;
                }
            }).fail(function() {
                jQuery("#load-more-articles").text( "error, try again" );
            }).always(function() {
                postLoading=false;
            });
        }
    }
    jQuery(document).ready(function($){
        jQuery("#load-more-articles").click(loadMoreArticles);
        jQuery(window).scroll(function(){
        　　var scrollTop = jQuery(this).scrollTop();
        　　var scrollHeight = jQuery(document).height();
        　　var windowHeight = jQuery(this).height();
            // if((scrollHeight+100+windowHeight)>=jQuery('#load-more-articles').offset().top){
        　　if(scrollTop + windowHeight == scrollHeight){
                console.log("已经到最底部了！");
                if(!noMorePost&&postOffset<50) loadMoreArticles();
        　  }
        });
    });
</script>
</main>
<?php get_footer(); ?>
