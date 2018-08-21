<?php get_header(); ?>

<div id="fb-root"></div>
  <script>(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.0";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));</script>

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
                    <div style="display:block; margin-bottom: 2px;" class="post-date"><?php $post_date = get_the_date( 'Y年n月j日' ); echo $post_date;?></div>
                    <div style="display:block; height:18px;">
                    <div style="display:block; height:18px;"><?php echo '<div class="fb-like" data-href="'.get_the_permalink().'"
                        data-layout="button_count" 
                        data-action="like" 
                        data-size="small" 
                        data-show-faces="true" 
                        data-share="true">
                    </div>'?></div>
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
            <div id="fb-root"></div>
            <fb:like href="" send="true" layout="button_count" width="140" show_faces="true" font="arial">
                <script type="text/javascript">_ga.trackFacebook();</script>
            </fb:like>
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