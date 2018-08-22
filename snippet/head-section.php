<?php
/* Need data: 
    WP_Query: headSectionQuery；
    Array<WP_Post>: stickyPosts;
*/
?>    
<section class="container head-section">
<?php 
    $loopCount=0;
    $topPosts=array($headSectionQuery->posts[3]->ID,$headSectionQuery->posts[4]->ID,$headSectionQuery->posts[5]->ID);
    echo '<div class="left">';

    echo '</div> <div class="center">';
    
    echo '</div> <div class="right">';

    echo '</div>';
    while ( $headSectionQuer->have_posts() ) {
        $loopCount++;
        if($stickyPosts){
            if($loopCount==4&&(count($stickyPosts)>0)){
                if(!in_array($stickyPosts[0]['sticky_post']->ID,$topPosts)){
                    //
                    continue;

                }else{

                }
            }
            if($loopCount==5&&(count($stickyPosts)>1)){

                continue;
            }
            if($loopCount==6&&(count($stickyPosts)>2)){

                continue;
            }
        }
        //center *3
        $headSectionQuer->the_post();
        echo '<li>' . get_the_title() . '</li>';
    }
?>
    <div class="left">
        <div class="b1" style="margin-bottom:10px;">【悉尼活动】悉尼婚礼展 时尚集市 悉尼茶节 悉尼皇家植物园花卉展</div>
        <div class="b1" style="margin-bottom:10px;">【悉尼活动】悉尼婚礼展 时尚集市 悉尼茶节 悉尼皇家植物园花卉展1</div>
        <div class="b1" style="height:120px;">【悉尼活动】悉尼婚礼展 时尚集市 悉尼茶节 悉尼皇家植物园花卉展</div>
    </div>
    <div class="center">
        <img src="https://xenforo.com/community/media/kingfish.2125/full" alt="" width="640" height="360" class="pic">
    </div>
    <div class="right">
        <div class="b2" style="margin-bottom:10px;">【悉尼活动】悉尼婚礼展 时尚集市 悉尼茶节 悉尼皇家植物园花卉展</div>
        <div class="b2">【悉尼活动】悉尼婚礼展 时尚集市 悉尼茶节 悉尼皇家植物园花卉展</div>
    </div>
</section>
<?php wp_reset_postdata(); ?>