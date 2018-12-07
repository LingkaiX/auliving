<?php get_header(); ?>
<aside class="gam-aulv aulv-lb">
    <!-- /21666183985/aulv/aulv-lb -->
    <div id='div-gpt-ad-1543362198289-0'>
    <script>
    googletag.cmd.push(function() { googletag.display('div-gpt-ad-1543362198289-0'); });
    </script>
    </div>
</aside>
<main class="container">
    <div class="item article">
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
                    <div class="featured-img" style="background-image:url('<?php echo getThumbnailUrl( null, 'medium_large' );?>');">
                    <!-- <div style="
                            position: absolute;
                            z-index: 2;
                            right: -3.75rem;
                            bottom: -1px;
                            left: -3.75rem;
                            height: 20%;
                            border: 0;
                            background: linear-gradient(to right top,#fff calc(50% - 1px),transparent 50%);
                        "></div>             -->
                    </div>
                <?php } ?>
                <!-- <div class="fb-outer">
                    <div class="fb-like" data-href="<?php echo get_the_permalink(); ?>"
                        data-layout="button_count" data-action="like" data-size="small" 
                        data-show-faces="true" data-share="true"></div>
                </div> -->
                <div class="<?php echo $isVideoPost?'with-video':'title-and-excerpt'; ?>">
                    <?php the_title('<h2 class="title">', '</h2>');?>
                    <div class="excerpt"><?php echo $post->post_excerpt; ?></div>
                </div>
                <div class="cate-and-date">
                    <?php echo getCategoryLinks($cates); ?>
                    <span class="post-date"><?php echo timeElapsedString($post->post_date_gmt); ?></span>
                </div>
            </section>
            <aside class="gam-aulv aulv-a1">
                <!-- /21666183985/aulv/aulv-a1 -->
                <div id='div-gpt-ad-1543361528497-0'>
                <script>
                googletag.cmd.push(function() { googletag.display('div-gpt-ad-1543361528497-0'); });
                </script>
                </div>
            </aside>
            <section class="content">
                <?php the_content(); ?>
            </section>
            <section class="footer">
            <div class="fb-outer">
                <div class="fb-like" data-href="<?php echo get_the_permalink(); ?>"
                    data-layout="button_count" data-action="like" data-size="large" 
                    data-show-faces="true" data-share="true"></div>
                </div>
                <?php include 'snippet/single-source-info.php'; ?>
                <div class="tag-links">
                    <?php
                        if(is_array($tags)&&sizeof($tags)>0)
                            foreach( $tags as $tag ) {
                                echo '<a class="tag-link" href="' . get_tag_link($tag->term_id) . '">' . $tag->name . '</a>';
                            }
                    ?>
                </div>
                <div class="aulv-a2-a3"><div class="aulv-a2-outer"><aside class="gam-aulv aulv-a2">
                        <!-- /21666183985/aulv/aulv-a2 -->
                        <div id='div-gpt-ad-1543362712099-0'>
                        <script>
                        googletag.cmd.push(function() { googletag.display('div-gpt-ad-1543362712099-0'); });
                        </script>
                        </div>
                    </aside></div>
                    <div class="aulv-a3-outer"><aside class="gam-aulv aulv-a3">
                        <!-- /21666183985/aulv/aulv-a3 -->
                        <div id='div-gpt-ad-1543362805047-0'>
                        <script>
                        googletag.cmd.push(function() { googletag.display('div-gpt-ad-1543362805047-0'); });
                        </script>
                        </div>
                </aside></div></div>
            </section>
            <?php comments_template(); ?>
        <?php endwhile; ?>
    </div>
    <div class="sidebar" >
        <?php include 'snippet/single-sidebar.php'; ?>
    </div>
    <script>
        // 处理视频Iframe适应窗口
        jQuery(document).ready(function($) {
            jQuery(".single-post main section.content iframe").each(function( index ) {
                var div = jQuery("<div>", {"style": "position:relative;padding-top:56.25%;"});
                var frame= jQuery(this).clone().css({"position":"absolute","top":0,"left":0,"width":"100%","height":"100%"});
                div = div.append(frame);
                jQuery(this).replaceWith(div);
            });
        });
    </script>
</main>
<?php include_once 'snippet/facebook-script.php'; ?>
<?php get_footer(); ?>