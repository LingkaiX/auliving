<?php include 'top-post-list.php'; ?>
<?php
/* Need data: 
    $cates: Array<WP_Term>;
    $tags: Array<WP_Term>;
    $postId: Integer;
    $author: Integer;
*/
$cateIds=array();
$tagIds=array();
foreach($cates as $cate){
    if($cate->slug!="top"&&$cate->slug!="video")
    array_push($cateIds,$cate->term_id);
    
}
if(is_array($tags)&&sizeof($tags)>0)
    foreach( $tags as $tag ) {
        array_push($tagIds,$tag->term_id);
    }
$args = array(
    'post__not_in' => array($postId),
    'posts_per_page' => 9,
    'orderby' => 'date',
    'order'   => 'DESC',
    'tax_query' => array(
        'relation' => 'OR',
        array(
            'taxonomy' => 'category',
            'field' => 'term_id',
            'terms' => $cateIds,
            'include_children' => true 
        ),
        array(
            'taxonomy' => 'post_tag',
            'field' => 'term_id',
            'terms' => $tagIds,
        )
    )
);
$recommendedPostQuery = new WP_Query( $args);
if($recommendedPostQuery->post_count<9){
    $count=9-$recommendedPostQuery->post_count;
    $recommendedPostQuery2 = new WP_Query( array('posts_per_page' => $count, 'author' => $author, 'post__not_in' => array_merge(wp_list_pluck($recommendedPostQuery->posts, 'ID' ), array($postId))));
    $recommendedPostQuery->posts = array_merge($recommendedPostQuery->posts, $recommendedPostQuery2->posts );
    $recommendedPostQuery->post_count = $recommendedPostQuery->post_count + $recommendedPostQuery2->post_count;
}
?>
<section class="recommended-posts">
    <!-- <div class="head"><strong>相关推荐</strong></div> -->
    <aside class="aulv-s1-outer"><div class="gam-aulv aulv-s1">
        <!-- /21666183985/aulv/aulv-s1 -->
        <div id='div-gpt-ad-1540443641717-0'>
        <script>
        googletag.cmd.push(function() { googletag.display('div-gpt-ad-1540443641717-0'); });
        </script>
        </div>
    </div></aside>
    <?php
        $count=0;
        while ($recommendedPostQuery->have_posts()) : $recommendedPostQuery->the_post();
        $count++;
    ?>
        <div class="recommended-post">
            <a class="cover-img" href="<?php echo get_permalink() ?>" style="background-image:url('<?php echo getThumbnailUrl( null, 'thumbnail' );?>');"></a>
            <div class="title">
                <?php the_title('<h5><a href="'.get_the_permalink().'">', '</a></h5>'); ?>
                <span class="date-info"><?php echo timeElapsedString($post->post_date_gmt); ?></span>
            </div>   
        </div>
    <?php 
        if($count==3) echo '<aside class="aulv-s2-outer"><div class="gam-aulv aulv-s2">
                <!-- /21666183985/aulv/aulv-s2 -->
                <div id="div-gpt-ad-1540443704017-0">
                <script>
                googletag.cmd.push(function() { googletag.display("div-gpt-ad-1540443704017-0"); });
                </script>
                </div>
            </div></aside>';
        if($count==6) echo '<aside class="aulv-s3-outer"><div class="gam-aulv aulv-s3">
                <!-- /21666183985/aulv/aulv-s3 -->
                <div id="div-gpt-ad-1540443816830-0">
                <script>
                googletag.cmd.push(function() { googletag.display("div-gpt-ad-1540443816830-0"); });
                </script>
                </div>
            </div></aside>';
        endwhile;
        wp_reset_postdata();
    ?>

</section>