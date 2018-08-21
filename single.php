<?php get_header(); ?>
<main class="container single-body">
    <div class="main-content" >
        <?php while (have_posts()) : the_post(); ?>
            <div class="title-section">
                <div class="featured-img"><?php echo get_the_post_thumbnail( null, 'full' );?></div>
                <div class="title">
                    <?php the_title('<h2>', '</h2>');?>
                </div>
            </div>
            <div class="post-meta-mobile">
                <?php
                    $color='rgba(204, 0, 51, 0.8)';
                    foreach(get_the_category() as $cate){
                        echo '<a class="cates" style="background-color:'.$color.';" href="'.get_category_link($cate->term_id).'">'.$cate->name.'</a>';
                        switch ($color) {
                            case 'rgba(0, 51, 102, 0.8)':
                                $color='rgba(204, 0, 51, 0.8)';
                                break;
                                    
                            default:
                                $color='rgba(0, 51, 102, 0.8)';
                                break;
                        }
                    }
                ?>
                <div class="post-date"><?php $post_date = get_the_date( 'Y年n月j日' ); echo $post_date;?></div> 
            </div>
            <div class="content">
                <div class="e1-desktop">
                    Ads code goes here
                </div>
                <div class="post-meta">
                    <div style="margin-bottom:5px;">
                        <?php
                            $color='rgba(204, 0, 51, 0.8)';
                            foreach(get_the_category() as $cate){
                                echo '<a class="cates" style="background-color:'.$color.';" href="'.get_category_link($cate->term_id).'">'.$cate->name.'</a>';
                                switch ($color) {
                                    case 'rgba(0, 51, 102, 0.8)':
                                        $color='rgba(204, 0, 51, 0.8)';
                                        break;
                                    
                                    default:
                                        $color='rgba(0, 51, 102, 0.8)';
                                        break;
                                }
                            }
                        ?>
                    </div>
                    <div class="post-date"><?php $post_date = get_the_date( 'Y年n月j日' ); echo $post_date;?></div>
                    <?php echo '<div class="fb-share-button" data-href="'.get_the_permalink().'" data-layout="button" data-size="small" data-mobile-iframe="true">'?>
                        <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fwww.auliving.com.au%2F&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Share</a>
                    </div>        
                </div>
                <div class="post-content">
                    <?php
                        // //Insert ads after second paragraph of single post content.
                        // add_filter( 'the_content', 'prefix_insert_post_ads' );
                        
                        // function prefix_insert_post_ads( $content ) {
                        //     $paraNum=1;

                        //     $ad_code = '<div class="e1-desktop">
                        //         Ads code goes here
                        //     </div>';
                        
                        //     if ( is_single() ) {
                        //         return prefix_insert_after_paragraph( $ad_code, $paraNum, $content );
                        //     }
                            
                        //     return $content;
                        // }
                        
                        // // Parent Function that makes the magic happen
                        // function prefix_insert_after_paragraph( $insertion, $paragraph_id, $content ) {
                        //     $closing_p = '</p>';
                        //     $paragraphs = explode( $closing_p, $content );
                        //     foreach ($paragraphs as $index => $paragraph) {
                        
                        //         if ( trim( $paragraph ) ) {
                        //             $paragraphs[$index] .= $closing_p;
                        //         }
                        
                        //         if ( $paragraph_id == $index + 1 ) {
                        //             $paragraphs[$index] .= $insertion;
                        //         }
                        //     }
                            
                        //     return implode( '', $paragraphs );
                        // }
                        the_content();
                    ?>
                </div>
            </div>
        <?php endwhile; ?>

        <div class="social-links">

        <div class="fb">
        <script src="http://connect.facebook.net/en_US/all.js#xfbml=1"></script>
        <script type="text/javascript">
        document.write('<fb:like layout="button_count" show_faces="false" width="100"></fb:like>')
        </script></div>
        <div class="tweet">
        <a href="http://twitter.com/share" data-url="<?php the_permalink(); ?>" class="twitter-share-button" data-count="horizontal">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script></div>

        </div>

    </div>
    <div class="sidebar" >
        <p>最新消息，俞琪终于找到了，新州警方刚刚公布了细节，她的尸体在Berowra附近的M1公路上被找到。</p>
            <p> </p> <p>信息刚刚公布，根据现场视频的显示，俞琪的尸体就被抛弃在公路旁边的树丛里。</p> 
            p style="text-align: center;">（图源：推特）</p>
            <p> </p>
    </div>
</main>
<?php get_footer(); ?>