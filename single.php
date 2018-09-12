<?php get_header(); ?>
<aside class="gam-aulv aulv-lb">aulv-lb</aside>
<main class="container">
    <div class="article">
        <?php
            while (have_posts()) : the_post();
                $cates = get_the_category();
                $tags = get_the_tags();
                $author = $post->post_author;
                $postId=get_the_ID();
                //print_r($cates);
                $isVideoPost=isVideoPost($cates);
        ?>
            <section class="header">
                <?php 
                    if($isVideoPost){
                        include 'snippet/post-video.php';
                    }else{
                ?>
                    <div class="featured-img" style="background-image:url(<?php echo get_the_post_thumbnail_url( null, 'medium' );?>);"></div>
                <?php } ?>
                <div class="<?php echo $isVideoPost?'with-video':'title-and-excerpt'; ?>">
                    <?php the_title('<h2 class="title">', '</h2>');?>
                    <div class="excerpt"><?php echo $post->post_excerpt; ?></div>
                </div>
                <?php echo getCategoryLinks($cates); ?>
                <span><?php echo timeElapsedString($post->post_date_gmt); ?></span>
                <div style="float:right;margin-right:8px;">
                    <div class="fb-like" data-href="<?php echo get_the_permalink(); ?>"
                        data-layout="button_count" data-action="like" data-size="small" 
                        data-show-faces="true" data-share="true"></div>
                </div>
            </section>
            <aside class="gam-aulv aulv-a1">aulv-a1</aside>
            <section class="content">
                <?php the_content(); ?>
            </section>
            <section class="footer">
                <?php include 'snippet/single-source-info.php'; ?>
                <span class="tag-links">
                    <?php
                        if(is_array($tags)&&sizeof($tags)>0)
                            foreach( $tags as $tag ) {
                                echo '<a class="tag-link" href="' . get_tag_link($tag->term_id) . '">' . $tag->name . '</a>';
                            }
                    ?>
                </span>
                <div style="float:right;margin-right:8px;">
                    <div class="fb-like" data-href="<?php echo get_the_permalink(); ?>"
                        data-layout="button_count" data-action="like" data-size="small" 
                        data-show-faces="true" data-share="true"></div>
                </div>
                <div class="aulv-a2-a3"><div class="aulv-a2-outer"><aside class="gam-aulv aulv-a2">aulv-a2</aside></div>
                <div class="aulv-a3-outer"><aside class="gam-aulv aulv-a3">aulv-a3</aside></div></div>
            </section>
            <?php comments_template(); ?>
        <?php endwhile; ?>
    </div>
    <div class="sidebar" >
        <?php include 'snippet/single-sidebar.php'; ?>
    </div>
</main>
<?php include_once 'snippet/facebook-script.php'; ?>
<?php get_footer(); ?>