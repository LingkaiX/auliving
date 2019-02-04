<?php
/* 
Need data: 
    WP_Query: $headSectionQuery；
    Array<WP_Post>: $stickyPosts;
Output data:
    Array<Post_ID>: $headSectionPostIds;
    JS: Array<Post_ID>: headSectionPostIds;
*/
if(count($headSectionQuery->posts)>=8):?>    
<section class="container head-section">
<?php
    $stickyCount=countSafely($stickyPosts);
    $selectedPosts=$headSectionQuery->posts;
    // $stickyIDs=array();
    //remove repeat posts in $headSectionQuery and $stickyPosts
    if($stickyCount>0&&($stickyPosts[0]['sticky_post']!=null)){
        for($i=0; $i<$stickyCount; $i++){
            if($stickyPosts[$i]['sticky_post']!=null)
                array_splice($selectedPosts, 3, 0, array($stickyPosts[$i]['sticky_post']) ); 
        }
        for($i=0; $i<count($selectedPosts); $i++){
            for($j=$i+1; $j<count($selectedPosts); $j++){
                if($selectedPosts[$i]->ID==$selectedPosts[$j]->ID)
                    array_splice($selectedPosts, $j, 1 ); 
            }
        }
        // for($i=0; $i<$stickyCount; $i++){
        //     $stickyIDs[$i]=$stickyPosts[$i]['sticky_post']->ID;
        // }
    }
    $headSectionPostIds=array();
    for($i=0; $i<8; $i++){
        array_push($headSectionPostIds, $selectedPosts[$i]->ID);
    }
?>
<script>
    <?php echo "var headSectionPostIds = ". json_encode($headSectionPostIds) . ";\n"; ?>
    //console.log(headSectionPostIds.toString());
</script>
<?php
    function echoBlock($post, $classNames='', $coverSize='thumbnail', $isStickyPost=false){
        echo '<div class="block '.$classNames.'">';
        echo '<a class="cover-img" style="background-image:url('."'".getThumbnailUrl( $post->ID, $coverSize )."'".');" target="_blank" href="'.get_permalink($post).'">';
            echo '<div class="info-container">';
                echo '<h4 class="title">'.$post->post_title.'</h4>';
                //echo '<span class="date-info">'.timeElapsedString($post->post_date_gmt).'</span>';
            echo '</div>';
        echo '</a></div>';
    }
    function echoCenterBlock($post, $classNames='', $coverSize='thumbnail', $isStickyPost=false){
        echo '<div class="block '.$classNames.'">';
        echo '<a class="cover-img" style="background-image:url('."'".getThumbnailUrl( $post->ID, $coverSize )."'".');" target="_blank" href="'.get_permalink($post).'">';
            echo '<div class="info-container">';
                echo '<h3 class="center-title">'.$post->post_title.'</h3>';
                //echo '<span class="date-info">'.timeElapsedString($post->post_date_gmt).'</span>';
            echo '</div>';
        echo '</a></div>';
    }
    $loopCount=0;
?>
    <div class="center">
        <div id="owl-head" class="owl-carousel owl-theme">
        <?php 
            for($loopCount; $loopCount<3; $loopCount++) echoCenterBlock($selectedPosts[$loopCount], 'center-block', 'large');
        ?>
        </div>
    </div>
    <div class="right">
    <?php 
        for($loopCount; $loopCount<5; $loopCount++) echoBlock($selectedPosts[$loopCount], 'right-block', 'medium_large');  
    ?>
    </div>
    <div class="left">
    <?php 
        for($loopCount; $loopCount<8; $loopCount++) echoBlock($selectedPosts[$loopCount], 'left-block', 'medium_large');
        if($loopCount==8){
            echo '<div class="post-outer"><div class="listed-post">';
                echo '<a class="cover-img" target="_blank" href="'.get_permalink($selectedPosts[7]).'" style="background-image:url('."'".getThumbnailUrl( $selectedPosts[7]->ID, 'thumbnail' )."'".');"></a>';
                echo '<div class="post-info">';
                    echo '<a target="_blank" href="'.get_permalink($selectedPosts[7]).'"><h4 class="title">'.$selectedPosts[7]->post_title.'</h4></a>';
                    echo '<h6 class="sub-title">'.strip_tags($selectedPosts[7]->post_excerpt),'</h6>';
                    echo '<span class="date-info">'.timeElapsedString($selectedPosts[7]->post_date_gmt).'</span>';
                echo '</div>';
            echo '</div></div>';
        }
    ?>
    </div>
</section>
<?php endif; wp_reset_postdata(); ?>
<script>
    var owlHead
    jQuery(document).ready(function($){
        owlHead=jQuery('#owl-head');
        owlHead.owlCarousel({
            loop:true,
            margin:0,
            center:false,
            dots:true,
            items:1
        })
        setInterval(function(){ 
            owlHead.trigger('next.owl.carousel');
        }, 5000);
    });
</script>