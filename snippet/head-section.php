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
    $stickyCount=count($stickyPosts);
    $selectedPosts=$headSectionQuery->posts;
    $stickyIDs=array();
    //remove repeat posts in $headSectionQuery and $stickyPosts
    if($stickyCount>0){
        for($i=0; $i<$stickyCount; $i++){
            array_splice($selectedPosts, 3, 0, array($stickyPosts[$i]['sticky_post']) ); 
        }
        for($i=0; $i<count($selectedPosts); $i++){
            for($j=$i+1; $j<count($selectedPosts); $j++){
                if($selectedPosts[$i]->ID==$selectedPosts[$j]->ID)
                    array_splice($selectedPosts, $j, 1 ); 
            }
        }
        for($i=0; $i<$stickyCount; $i++){
            $stickyIDs[$i]=$stickyPosts[$i]['sticky_post']->ID;
        }
    }
    $headSectionPostIds=array();
    for($i=0; $i<count($selectedPosts); $i++){
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
        echo '<a class="cover-img" style="background-image:url('."'".getThumbnailUrl( $post->ID, $coverSize )."'".');" href="'.get_permalink($post).'">';
            echo '<div class="info-container">';
                echo '<h4 class="title">'.$post->post_title.'</h4>';
                echo '<span class="date-info">'.timeElapsedString($post->post_date_gmt).'</span>';
            echo '</div>';
        echo '</a></div>';
    }
    $loopCount=0;
?>
    <div class="center">
        <div id="owl-head" class="owl-carousel owl-theme">
        <?php 
            for($loopCount; $loopCount<3; $loopCount++) echoBlock($selectedPosts[$loopCount], 'center-block', 'medium_large');
        ?>
        </div>
    </div>
    <div class="left">
    <?php 
        for($loopCount; $loopCount<6; $loopCount++) echoBlock($selectedPosts[$loopCount], 'left-block');
        
    ?>
    </div>
    <div class="right">
    <?php 
        for($loopCount; $loopCount<8; $loopCount++) echoBlock($selectedPosts[$loopCount], 'right-block');
        
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