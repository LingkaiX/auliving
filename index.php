<?php get_header(); ?>
<main>    
<?php 
    $stickyPosts = get_field( 'sticky_posts', 'category_'.get_category_by_slug( 'top' )->term_id );
    $headSectionQuery = new WP_Query( array( 'category_name' => 'top','posts_per_page' => 8 )  );
    include 'snippet/head-section.php';
    //print_r(get_taxonomy( 'top' ));
    echo home_url();
?>
<section class="first-section container">
    <div class="post-list">
    <?php 
        $count=0;
        query_posts( array( 'post_type' => 'post', 'post__not_in' =>$headSectionPostIds ) );
        while (have_posts()) : the_post();
            include 'snippet/listed-post.php';
        endwhile;
    ?>
    </div>
    <div class="hot-post-list">
111
    </div>
</section>
<section class="special-categories">
</section>
<section class="second-section container">
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
        function loadMoreArticles(){
            var perPage=1;
            var variant=isTCN?'&variant=zh-tw':'';
            var offset= jQuery("#load-more-articles").data("offset");
            var url="<?php echo home_url(); ?>"+"/wp-json/wp/v2/posts?offset="+offset+"&per_page="+perPage+"&exclude="+headSectionPostIds+variant;
            jQuery.getJSON( url, function( data ) {
                if(data){
                    var posts = [];
                    jQuery.each( data, function( key, val ) {
                        var s=`<div class="listed-post"><a href="`+val.link+`">
                        <img width="320" height="180" src=`+val.cover_img+` class="cover-img wp-post-image">
                        </a><div class="post-info"><h4>`+val.title.rendered+`</h4><h6 class="sub-title">`+val.excerpt.rendered+`</h6><span>`+val.date_info+`</span></div></div>`;
                        posts.push(s);
                    });
                    jQuery( "#more-articles-here" ).append(posts);  
                }else{
                    console.log('no more post');
                }
            }).fail(function() {
                console.log( "error, try again" );
            });
        }
        jQuery(document).ready(function($){
            loadMoreArticles();
            // var appArticleList = new Vue({
            //     el: '#app-article-list',
            //     data: {
            //         results: []
            //     },
            //     methods: {
            //         decodeHtml: function (html) {
            //             var txt = document.createElement("textarea");
            //             txt.innerHTML = html;
            //             return txt.value;
            //         },
            //     },
            //     mounted() {
            //         axios.get("http://localhost/wp-json/wp/v2/posts?offset=30&exclude="+headSectionPostIds+"&per_page=5").then(response => {this.results =response.data});          
            //     }
            // });
            // console.log($('#test111').offset());
            // $(window).scroll(function(){
            // 　　var scrollTop = $(this).scrollTop();
            // 　　var scrollHeight = $(document).height();
            // 　　var windowHeight = $(this).height();
            //     if((scrollHeight+100+windowHeight)>=$('#test111').offset().top){
            //         console.log('will display');
            //     }
            //     console.log($('#test111').scrollTop());
            // 　　if(scrollTop + windowHeight == scrollHeight){
            //         console.log("已经到最底部了！");
            //         var appArticleList = new Vue({
            //             el: '#app-article-list',
            //             data: {
            //                 results: []
            //             },
            //             methods: {
            //                 decodeHtml: function (html) {
            //                     var txt = document.createElement("textarea");
            //                     txt.innerHTML = html;
            //                     return txt.value;
            //                 },
            //             },
            //             mounted() {
            //                 axios.get("https://www.auliving.com.au/wp-json/wp/v2/posts?per_page=5").then(response => {this.results =response.data});          
            //             }
            //         });
            // 　  }
            // });
        });
    </script>
</main>
<?php get_footer(); ?>

<script src="https://cdn.jsdelivr.net/npm/vue@2.5.17/dist/vue.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>